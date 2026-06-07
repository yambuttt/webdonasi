<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * Display the specified campaign.
     */
    public function show($slug)
    {
        $campaign = Campaign::where('slug', $slug)->firstOrFail();
        
        // Retrieve related active campaigns for recommendations
        $relatedCampaigns = Campaign::where('slug', '!=', $slug)
            ->where('status', 'active')
            ->latest()
            ->take(3)
            ->get();

        return view('campaigns.show', compact('campaign', 'relatedCampaigns'));
    }
}
