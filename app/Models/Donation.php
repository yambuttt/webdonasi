<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'campaign_id',
        'invoice_number',
        'donor_name',
        'donor_email',
        'nominal',
        'unique_code',
        'total_amount',
        'payment_method',
        'status',
        'comment',
        'is_comment_visible',
        'cashify_transaction_id',
        'cashify_qr_string',
    ];

    protected $casts = [
        'is_comment_visible' => 'boolean',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted()
    {
        static::updated(function ($donation) {
            if ($donation->wasChanged('status') && $donation->status === 'confirmed') {
                // 1. Increment the related campaign's current_amount
                $campaign = $donation->campaign;
                if ($campaign) {
                    $campaign->increment('current_amount', $donation->nominal);
                }

                // 2. Send the thank-you email
                try {
                    \Illuminate\Support\Facades\Mail::to($donation->donor_email)
                        ->send(new \App\Mail\DonationSuccessMail($donation));
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Failed to send donation thank you email: ' . $e->getMessage());
                }
            }
        });
    }

    /**
     * Get the campaign that owns the donation.
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
