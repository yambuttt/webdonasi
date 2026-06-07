<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    /**
     * Store a newly created donation in storage.
     */
    public function store(Request $request, $slug)
    {
        $campaign = Campaign::where('slug', $slug)->firstOrFail();

        $request->validate([
            'nominal' => 'required|integer|min:10000',
            'payment_method' => 'required|in:qris,bank_nobu',
            'donor_name' => 'required|string|max:100',
            'donor_email' => 'required|email|max:100',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Generate random 3-digit unique code
        $uniqueCode = rand(100, 999);
        
        $nominal = $request->input('nominal');
        $totalAmount = $nominal + $uniqueCode;
        
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
            'payment_method' => $request->input('payment_method'),
            'status' => 'pending',
            'comment' => $request->input('comment'),
            'is_comment_visible' => true,
        ]);

        return redirect()->route('donations.invoice', $invoiceNumber);
    }

    /**
     * Display the donation invoice.
     */
    public function show($invoiceNumber)
    {
        $donation = Donation::with('campaign')->where('invoice_number', $invoiceNumber)->firstOrFail();
        return view('donations.invoice', compact('donation'));
    }
}
