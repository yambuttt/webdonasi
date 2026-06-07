<?php

namespace Tests\Feature;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DonationFlowTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $campaign;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $this->campaign = Campaign::create([
            'title' => 'Bantu Pendidikan Anak Pelosok',
            'slug' => 'bantu-pendidikan-anak-pelosok',
            'thumbnail' => '/images/campaign_education.png',
            'category' => 'pendidikan',
            'description' => '<p>Deskripsi kampanye pendidikan.</p>',
            'target_amount' => 50000000,
            'current_amount' => 10000000,
            'donation_options' => [10000, 25000, 50000],
            'status' => 'active',
            'days_remaining' => 15,
        ]);
    }

    public function test_donor_can_create_donation_and_redirect_to_invoice()
    {
        $response = $this->post(route('campaigns.donate', $this->campaign->slug), [
            'donor_name' => 'Donatur Baik',
            'donor_email' => 'donor@test.com',
            'nominal' => 50000,
            'payment_method' => 'bank_nobu',
        ]);

        // Assert database record exists
        $donation = Donation::first();
        $this->assertNotNull($donation);
        $this->assertEquals('Donatur Baik', $donation->donor_name);
        $this->assertEquals(50000, $donation->nominal);
        $this->assertGreaterThanOrEqual(100, $donation->unique_code);
        $this->assertLessThanOrEqual(999, $donation->unique_code);
        $this->assertEquals(50000 + $donation->unique_code, $donation->total_amount);
        $this->assertEquals('pending', $donation->status);

        // Redirect assertion
        $response->assertRedirect(route('donations.invoice', $donation->invoice_number));
    }

    public function test_invoice_page_renders_successfully()
    {
        $donation = Donation::create([
            'campaign_id' => $this->campaign->id,
            'invoice_number' => 'INV-TEST-123456',
            'donor_name' => 'Hamba Allah',
            'donor_email' => 'hamba@test.com',
            'nominal' => 25000,
            'unique_code' => 324,
            'total_amount' => 25324,
            'payment_method' => 'qris',
            'status' => 'pending',
        ]);

        $response = $this->get(route('donations.invoice', $donation->invoice_number));
        $response->assertStatus(200);
        $response->assertSee('INV-TEST-123456');
        $response->assertSee('25.000');
        $response->assertSee('324');
    }

    public function test_admin_can_confirm_donation_and_increment_campaign_current_amount()
    {
        $donation = Donation::create([
            'campaign_id' => $this->campaign->id,
            'invoice_number' => 'INV-TEST-789012',
            'donor_name' => 'Hamba Allah',
            'donor_email' => 'hamba@test.com',
            'nominal' => 100000,
            'unique_code' => 150,
            'total_amount' => 100150,
            'payment_method' => 'bank_nobu',
            'status' => 'pending',
        ]);

        // Act as admin to hit confirmation endpoint
        $response = $this->actingAs($this->admin)
            ->post(route('admin.donations.confirm', $donation->id));

        $response->assertRedirect();
        
        // Assert donation status updated
        $donation->refresh();
        $this->assertEquals('confirmed', $donation->status);

        // Assert campaign amount increased by nominal (10000000 + 100000 = 10100000)
        $this->campaign->refresh();
        $this->assertEquals(10100000, $this->campaign->current_amount);
    }

    public function test_admin_can_access_settings_page()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.settings.index'));

        $response->assertStatus(200);
        $response->assertSee('Pengaturan Pembayaran');
    }

    public function test_admin_can_update_payment_settings()
    {
        $response = $this->actingAs($this->admin)
            ->post(route('admin.settings.update'), [
                'bank_name' => 'BANK NEGARA INDONESIA',
                'bank_account_number' => '9876-5432-10',
                'bank_account_name' => 'Yayasan Amal Bisa Kita',
                'whatsapp_number' => '6289999999999',
            ]);

        $response->assertRedirect(route('admin.settings.index'));
        $response->assertSessionHas('success');

        // Check model values are updated
        $this->assertEquals('BANK NEGARA INDONESIA', \App\Models\Setting::get('bank_name'));
        $this->assertEquals('9876-5432-10', \App\Models\Setting::get('bank_account_number'));
        $this->assertEquals('Yayasan Amal Bisa Kita', \App\Models\Setting::get('bank_account_name'));
        $this->assertEquals('6289999999999', \App\Models\Setting::get('whatsapp_number'));
    }

    public function test_public_invoice_uses_configured_settings()
    {
        // Seed customized settings first
        \App\Models\Setting::set('bank_name', 'MOCK BANK INDONESIA');
        \App\Models\Setting::set('bank_account_number', '123-456-789');
        \App\Models\Setting::set('bank_account_name', 'Bisa Kita Mock Account');
        \App\Models\Setting::set('whatsapp_number', '628111222333');

        $donation = Donation::create([
            'campaign_id' => $this->campaign->id,
            'invoice_number' => 'INV-MOCK-999',
            'donor_name' => 'John Doe',
            'donor_email' => 'john.doe@test.com',
            'nominal' => 45000,
            'unique_code' => 111,
            'total_amount' => 45111,
            'payment_method' => 'bank_nobu',
            'status' => 'pending',
        ]);

        $response = $this->get(route('donations.invoice', $donation->invoice_number));
        $response->assertStatus(200);
        $response->assertSee('MOCK BANK INDONESIA');
        $response->assertSee('123-456-789');
        $response->assertSee('Bisa Kita Mock Account');
        $response->assertSee('628111222333');
    }

    public function test_donor_name_and_email_are_required_for_donation()
    {
        $response = $this->post(route('campaigns.donate', $this->campaign->slug), [
            'nominal' => 50000,
            'payment_method' => 'bank_nobu',
        ]);

        $response->assertSessionHasErrors(['donor_name', 'donor_email']);
    }

    public function test_donation_comment_is_saved_and_displayed_on_campaign_after_admin_confirmation()
    {
        $response = $this->post(route('campaigns.donate', $this->campaign->slug), [
            'donor_name' => 'Orang Baik',
            'donor_email' => 'orang.baik@test.com',
            'nominal' => 50000,
            'payment_method' => 'bank_nobu',
            'comment' => 'Semoga barokah dan membantu sesame',
        ]);

        $donation = Donation::latest()->first();
        $this->assertEquals('Semoga barokah dan membantu sesame', $donation->comment);
        $this->assertTrue($donation->is_comment_visible);

        // Access campaign page, comment should not be displayed because status is still pending
        $campaignResponse = $this->get(route('campaigns.show', $this->campaign->slug));
        $campaignResponse->assertDontSee('Semoga barokah dan membantu sesame');

        // Confirm payment as admin
        $this->actingAs($this->admin)
            ->post(route('admin.donations.confirm', $donation->id));

        // Access campaign page again, comment should now be displayed
        $campaignResponse2 = $this->get(route('campaigns.show', $this->campaign->slug));
        $campaignResponse2->assertSee('Semoga barokah dan membantu sesame');
        $campaignResponse2->assertSee('Orang Baik');
    }

    public function test_admin_can_toggle_comment_visibility()
    {
        $donation = Donation::create([
            'campaign_id' => $this->campaign->id,
            'invoice_number' => 'INV-COMM-888',
            'donor_name' => 'Komentator Kasar',
            'donor_email' => 'kasar@test.com',
            'nominal' => 20000,
            'unique_code' => 101,
            'total_amount' => 20101,
            'payment_method' => 'qris',
            'status' => 'confirmed', // confirmed so it renders by default
            'comment' => 'Komentar tidak pantas di sini',
            'is_comment_visible' => true,
        ]);

        // Access campaign page, check it shows the comment
        $response1 = $this->get(route('campaigns.show', $this->campaign->slug));
        $response1->assertSee('Komentar tidak pantas di sini');

        // Toggle visibility to hidden as admin
        $responseToggle = $this->actingAs($this->admin)
            ->post(route('admin.donations.toggle-comment', $donation->id));
        
        $responseToggle->assertRedirect();
        
        $donation->refresh();
        $this->assertFalse($donation->is_comment_visible);

        // Access campaign page, comment should be gone
        $response2 = $this->get(route('campaigns.show', $this->campaign->slug));
        $response2->assertDontSee('Komentar tidak pantas di sini');
    }
}
