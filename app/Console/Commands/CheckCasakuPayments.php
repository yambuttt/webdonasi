<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\Donation;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

#[Signature('app:check-casaku-payments')]
#[Description('Check pending Casaku QRIS payments and update their status')]
class CheckCasakuPayments extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $licenseKey = config('services.casaku.license_key');
        if (!$licenseKey) {
            $this->error('Casaku license key is not configured.');
            return;
        }

        // Get pending donations with casaku_transaction_id created in last 30 minutes
        $pendingDonations = Donation::where('status', 'pending')
            ->whereNotNull('casaku_transaction_id')
            ->where('created_at', '>=', now()->subMinutes(30))
            ->get();

        if ($pendingDonations->isEmpty()) {
            $this->info('No pending Casaku donations to check.');
            return;
        }

        $this->info("Checking status for {$pendingDonations->count()} pending donation(s)...");

        foreach ($pendingDonations as $donation) {
            $this->comment("Checking Invoice #{$donation->invoice_number} (Transaction ID: {$donation->casaku_transaction_id})...");

            try {
                $response = Http::withoutVerifying()->withHeaders([
                    'x-license-key' => $licenseKey,
                    'content-type' => 'application/json',
                ])->post('https://api.casaku.id/api/generate/check-status', [
                    'transactionId' => $donation->casaku_transaction_id,
                ]);

                if ($response->successful()) {
                    $resData = $response->json();
                    if (isset($resData['status']) && $resData['status'] == 200 && isset($resData['data'])) {
                        $data = $resData['data'];
                        if (($data['status'] ?? '') === 'paid') {
                            $donation->update(['status' => 'confirmed']);
                            $this->info("Invoice #{$donation->invoice_number} successfully marked as PAID.");
                            Log::info("Casaku Scheduler: Invoice #{$donation->invoice_number} marked as PAID.");
                        } else {
                            $this->line("Invoice #{$donation->invoice_number} is still pending.");
                        }
                    } else {
                        $this->warn("Casaku API returned status: " . ($resData['status'] ?? 'unknown'));
                    }
                } else {
                    $this->error("Failed to check status for Invoice #{$donation->invoice_number}: " . $response->status());
                }
            } catch (\Exception $e) {
                $this->error("Exception while checking Invoice #{$donation->invoice_number}: " . $e->getMessage());
                Log::error("Casaku Scheduler Exception for #{$donation->invoice_number}: " . $e->getMessage());
            }

            // Expiration check: if still pending and older than 15 minutes, cancel it!
            if ($donation->fresh()->status === 'pending' && $donation->created_at->diffInMinutes(now()) >= 15) {
                $donation->update(['status' => 'cancelled']);
                $this->info("Invoice #{$donation->invoice_number} has EXPIRED and was marked as CANCELLED.");
                Log::info("Casaku Scheduler: Invoice #{$donation->invoice_number} expired and marked as CANCELLED.");
            }
        }

        $this->info('Finished checking Casaku payments.');
    }
}
