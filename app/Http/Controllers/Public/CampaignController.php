<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Setting;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * Display a listing of campaigns.
     */
    public function index(Request $request)
    {
        $carouselSource = Setting::get('carousel_source', 'latest');
        $carouselCampaigns = collect();

        if ($carouselSource === 'custom') {
            $carouselIds = json_decode(Setting::get('carousel_campaign_ids', '[]'), true);
            if (!empty($carouselIds)) {
                $carouselCampaigns = Campaign::whereIn('id', $carouselIds)
                    ->where('status', 'active')
                    ->get()
                    ->sortBy(function ($campaign) use ($carouselIds) {
                        return array_search($campaign->id, $carouselIds);
                    });
            }
        }

        if ($carouselCampaigns->isEmpty()) {
            $carouselCampaigns = Campaign::where('status', 'active')
                ->latest()
                ->take(4)
                ->get();
        }

        $campaigns = Campaign::where('status', 'active')
            ->latest()
            ->get();

        return view('campaigns.index', compact('carouselCampaigns', 'campaigns'));
    }

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
