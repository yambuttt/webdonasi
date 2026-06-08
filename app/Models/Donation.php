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
     * Get the campaign that owns the donation.
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
