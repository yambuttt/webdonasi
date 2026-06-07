<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Support\Str;

#[Fillable([
    'title',
    'slug',
    'thumbnail',
    'category',
    'description',
    'target_amount',
    'current_amount',
    'donation_options',
    'status',
    'days_remaining'
])]
class Campaign extends Model
{
    use HasFactory;

    /**
     * Cast attributes to native types.
     */
    protected $casts = [
        'donation_options' => 'array',
        'target_amount' => 'integer',
        'current_amount' => 'integer',
        'days_remaining' => 'integer',
    ];

    /**
     * Accessor: Clean excerpt from HTML description.
     */
    public function getExcerptAttribute()
    {
        $cleanDesc = strip_tags($this->description);
        return Str::limit($cleanDesc, 120, '...');
    }

    /**
     * Accessor: Percentage of target reached.
     */
    public function getPercentageAttribute()
    {
        if ($this->target_amount <= 0) {
            return 0;
        }
        $percent = ($this->current_amount / $this->target_amount) * 100;
        return min(100, round($percent));
    }

    /**
     * Get all donations for the campaign.
     */
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
