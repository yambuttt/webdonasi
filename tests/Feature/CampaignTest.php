<?php

namespace Tests\Feature;

use App\Models\Campaign;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CampaignTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_renders_and_shows_active_campaigns()
    {
        $campaign = Campaign::create([
            'title' => 'Test Campaign Active',
            'slug' => 'test-campaign-active',
            'thumbnail' => '/images/campaign_medical.png',
            'category' => 'kesehatan',
            'description' => 'Test Description content text',
            'target_amount' => 10000000,
            'current_amount' => 500000,
            'donation_options' => [10000, 20000],
            'status' => 'active',
            'days_remaining' => 10,
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Test Campaign Active');
    }

    public function test_campaign_detail_page_renders()
    {
        $campaign = Campaign::create([
            'title' => 'Detail Campaign View',
            'slug' => 'detail-campaign-view',
            'thumbnail' => '/images/campaign_medical.png',
            'category' => 'kesehatan',
            'description' => 'Detail Description content text',
            'target_amount' => 10000000,
            'current_amount' => 500000,
            'donation_options' => [10000, 25000],
            'status' => 'active',
            'days_remaining' => 10,
        ]);

        $response = $this->get('/campaigns/detail-campaign-view');
        $response->assertStatus(200);
        $response->assertSee('Detail Campaign View');
        $response->assertSee('Rp 25.000');
    }
}
