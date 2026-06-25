<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DonationController extends Controller
{
    /**
     * Show the form for creating a new donation.
     */
    public function create($slug)
    {
        $campaign = Campaign::where('slug', $slug)->where('status', 'active')->firstOrFail();
        $paymentMethods = \App\Models\PaymentMethod::where('status', true)->get();
        return view('campaigns.donate', compact('campaign', 'paymentMethods'));
    }

    /**
     * Store a newly created donation in storage.
     */
    public function store(Request $request, $slug)
    {
        $campaign = Campaign::where('slug', $slug)->firstOrFail();

        $request->validate([
            'nominal' => 'required|integer|min:1',
            'payment_method' => 'required|exists:payment_methods,code',
            'donor_name' => 'required|string|max:100',
            'donor_email' => 'required|email|max:100',
            'comment' => 'nullable|string|max:1000',
        ]);

        $nominal = $request->input('nominal');
        $paymentMethodCode = $request->input('payment_method');
        
        // Default manual unique code and total amount
        $uniqueCode = rand(100, 999);
        $totalAmount = $nominal + $uniqueCode;
        $casakuTransactionId = null;
        $casakuQrString = null;

        // If payment method is QRIS
        if ($paymentMethodCode === 'qris') {
            if (config('services.casaku.license_key') && config('services.casaku.qris_id')) {
                try {
                    $payload = [
                        'qr_id' => config('services.casaku.qris_id'),
                        'amount' => (int) $nominal,
                        'useUniqueCode' => true,
                        'packageIds' => ['com.bukalapak.mitra'],
                        'expiredInMinutes' => 15,
                        'qrType' => 'dynamic',
                        'paymentMethod' => 'qris',
                        'useQris' => true
                    ];

                    Log::info('Casaku Dynamic QRIS generation request', [
                        'url' => 'https://api.casaku.id/api/generate/v2/qris',
                        'headers' => [
                            'x-license-key' => config('services.casaku.license_key'),
                            'content-type' => 'application/json',
                        ],
                        'body' => $payload
                    ]);

                    $response = Http::withoutVerifying()->withHeaders([
                        'x-license-key' => config('services.casaku.license_key'),
                        'content-type' => 'application/json',
                    ])->post('https://api.casaku.id/api/generate/v2/qris', $payload);

                    if ($response->successful()) {
                        $resData = $response->json();
                        
                        Log::info('Casaku Dynamic QRIS generation response', [
                            'nominal' => $nominal,
                            'response' => $resData
                        ]);

                        if (isset($resData['status']) && $resData['status'] == 200 && isset($resData['data'])) {
                            $data = $resData['data'];
                            $casakuTransactionId = $data['transactionId'] ?? null;
                            $casakuQrString = $data['qr_string'] ?? null;
                            $totalAmount = $data['totalAmount'] ?? $totalAmount;
                            $uniqueCode = $data['uniqueNominal'] ?? $uniqueCode;
                        } else {
                            Log::warning('Casaku API returned non-200 status: ' . json_encode($resData));
                        }
                    } else {
                        Log::error('Casaku API returned error: ' . $response->status() . ' - ' . $response->body());
                    }
                } catch (\Exception $e) {
                    Log::error('Casaku API Exception: ' . $e->getMessage());
                }
            } else {
                // Kredensial tidak ada -> gunakan QRIS Dinamis Simulasi (Mock) untuk testing
                $casakuTransactionId = 'TX-SIMULATED-' . Str::random(10);
                // String QRIS standar industri (EMVCo) yang valid untuk dirender
                $casakuQrString = '00020101021226660014ID.CO.QRIS.WWW011893600002011122334402150001130241123450303UME5204599953033605802ID5916Pedulia Indonesia6009Jogyakarta6105551862070703A016304' . strtoupper(Str::random(4));
                $uniqueCode = rand(1, 999);
                $totalAmount = $nominal + $uniqueCode;
            }
        }

        // Generate unique invoice number
        $invoiceNumber = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(6));

        $donation = Donation::create([
            'campaign_id' => $campaign->id,
            'invoice_number' => $invoiceNumber,
            'donor_name' => $request->input('donor_name'),
            'donor_email' => $request->input('donor_email'),
            'nominal' => $nominal,
            'unique_code' => $uniqueCode,
            'total_amount' => $totalAmount,
            'payment_method' => $paymentMethodCode,
            'status' => 'pending',
            'comment' => $request->input('comment'),
            'is_comment_visible' => true,
            'casaku_transaction_id' => $casakuTransactionId,
            'casaku_qr_string' => $casakuQrString,
        ]);

        return redirect()->route('donations.invoice', $invoiceNumber);
    }

    /**
     * Display the donation invoice.
     */
    public function show($invoiceNumber)
    {
        $donation = Donation::with('campaign')->where('invoice_number', $invoiceNumber)->firstOrFail();
        $paymentMethod = \App\Models\PaymentMethod::where('code', $donation->payment_method)->first();
        return view('donations.invoice', compact('donation', 'paymentMethod'));
    }

    /**
     * Check payment status via AJAX.
     */
    public function checkStatus($invoiceNumber)
    {
        $donation = Donation::where('invoice_number', $invoiceNumber)->firstOrFail();

        if ($donation->status === 'confirmed') {
            return response()->json(['status' => 'confirmed']);
        }

        if ($donation->status === 'cancelled') {
            return response()->json(['status' => 'cancelled']);
        }

        if ($donation->status === 'pending' && $donation->casaku_transaction_id) {
            // Check if it is a simulated payment for local/sandbox testing when no real keys exist
            if (str_starts_with($donation->casaku_transaction_id, 'TX-SIMULATED-')) {
                if ($donation->created_at->diffInSeconds(now()) >= 12 || request()->has('manual_check')) {
                    $donation->update(['status' => 'confirmed']);
                    return response()->json(['status' => 'confirmed']);
                }
            }

            elseif (config('services.casaku.license_key')) {
                try {
                    $response = Http::withoutVerifying()->withHeaders([
                        'x-license-key' => config('services.casaku.license_key'),
                        'content-type' => 'application/json',
                    ])->post('https://api.casaku.id/api/generate/check-status', [
                        'transactionId' => $donation->casaku_transaction_id,
                    ]);

                    if ($response->successful()) {
                        $resData = $response->json();

                        Log::info('Casaku Check Status response', [
                            'invoice_number' => $donation->invoice_number,
                            'transaction_id' => $donation->casaku_transaction_id,
                            'response' => $resData
                        ]);

                        if (isset($resData['status']) && $resData['status'] == 200 && isset($resData['data'])) {
                            $data = $resData['data'];
                            if (($data['status'] ?? '') === 'paid') {
                                $donation->update(['status' => 'confirmed']);
                                return response()->json(['status' => 'confirmed']);
                            }
                        }
                    } else {
                        Log::warning('Casaku Check Status returned non-200', [
                            'invoice_number' => $donation->invoice_number,
                            'status' => $response->status(),
                            'body' => $response->body()
                        ]);
                    }
                } catch (\Exception $e) {
                    Log::error('Casaku Check Status Exception: ' . $e->getMessage());
                }
            }
        }

        // If it is still pending but older than 15 minutes, mark as cancelled/expired
        if ($donation->status === 'pending' && $donation->created_at->diffInMinutes(now()) >= 15) {
            $donation->update(['status' => 'cancelled']);
            return response()->json(['status' => 'cancelled']);
        }

        return response()->json(['status' => $donation->status]);
    }
}
