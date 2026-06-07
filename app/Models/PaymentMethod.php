<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'name',
        'code',
        'type',
        'logo',
        'qris_image',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
