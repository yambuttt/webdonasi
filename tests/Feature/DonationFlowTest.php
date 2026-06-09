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
        \Illuminate\Support\Facades\Mail::fake();

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

        // Assert that the email was sent
        \Illuminate\Support\Facades\Mail::assertSent(\App\Mail\DonationSuccessMail::class, function ($mail) use ($donation) {
            return $mail->hasTo($donation->donor_email) && $mail->donation->id === $donation->id;
        });
    }

    public function test_admin_can_confirm_cancelled_donation()
    {
        \Illuminate\Support\Facades\Mail::fake();

        $donation = Donation::create([
            'campaign_id' => $this->campaign->id,
            'invoice_number' => 'INV-TEST-CANCELLED-CONFIRM',
            'donor_name' => 'Hamba Allah',
            'donor_email' => 'hamba@test.com',
            'nominal' => 100000,
            'unique_code' => 150,
            'total_amount' => 100150,
            'payment_method' => 'bank_nobu',
            'status' => 'cancelled',
        ]);

        // Act as admin to hit confirmation endpoint
        $response = $this->actingAs($this->admin)
            ->post(route('admin.donations.confirm', $donation->id));

        $response->assertRedirect();
        
        // Assert donation status updated to confirmed
        $donation->refresh();
        $this->assertEquals('confirmed', $donation->status);

        // Assert campaign amount increased by nominal (10000000 + 100000 = 10100000)
        $this->campaign->refresh();
        $this->assertEquals(10100000, $this->campaign->current_amount);

        // Assert that the email was sent
        \Illuminate\Support\Facades\Mail::assertSent(\App\Mail\DonationSuccessMail::class, function ($mail) use ($donation) {
            return $mail->hasTo($donation->donor_email) && $mail->donation->id === $donation->id;
        });
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
                'bank_account_name' => 'Yayasan Amal Pedulia',
                'whatsapp_number' => '6289999999999',
                'contact_email' => 'support@pedulia.com',
                'contact_phone' => '(021) 8293-1029',
                'contact_address' => 'Menteng, Jakarta Pusat, Indonesia',
                'socials' => [
                    ['id' => 'facebook', 'name' => 'Facebook', 'url' => 'https://facebook.com', 'is_active' => '1'],
                    ['id' => 'twitter', 'name' => 'Twitter', 'url' => 'https://twitter.com', 'is_active' => '1'],
                    ['id' => 'instagram', 'name' => 'Instagram', 'url' => 'https://instagram.com', 'is_active' => '1'],
                    ['id' => 'custom', 'name' => '', 'url' => '', 'is_active' => '0'],
                ]
            ]);

        $response->assertRedirect(route('admin.settings.index'));
        $response->assertSessionHas('success');

        // Check model values are updated
        $this->assertEquals('BANK NEGARA INDONESIA', \App\Models\Setting::get('bank_name'));
        $this->assertEquals('9876-5432-10', \App\Models\Setting::get('bank_account_number'));
        $this->assertEquals('Yayasan Amal Pedulia', \App\Models\Setting::get('bank_account_name'));
        $this->assertEquals('6289999999999', \App\Models\Setting::get('whatsapp_number'));
    }

    public function test_public_invoice_uses_configured_settings()
    {
        // Seed customized settings first
        \App\Models\Setting::set('bank_name', 'MOCK BANK INDONESIA');
        \App\Models\Setting::set('bank_account_number', '123-456-789');
        \App\Models\Setting::set('bank_account_name', 'Pedulia Mock Account');
        \App\Models\Setting::set('whatsapp_number', '628111222333');

        // Update payment method in DB as well to reflect customized bank details
        $pm = \App\Models\PaymentMethod::where('code', 'bank_nobu')->first();
        if ($pm) {
            $pm->update([
                'bank_name' => 'MOCK BANK INDONESIA',
                'bank_account_number' => '123-456-789',
                'bank_account_name' => 'Pedulia Mock Account',
            ]);
        }

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
        $response->assertSee('Pedulia Mock Account');
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

    public function test_admin_can_update_popup_settings()
    {
        $response = $this->actingAs($this->admin)
            ->post(route('admin.settings.update'), [
                'bank_name' => 'BANK NEGARA INDONESIA',
                'bank_account_number' => '9876-5432-10',
                'bank_account_name' => 'Yayasan Amal Pedulia',
                'whatsapp_number' => '6289999999999',
                'popup_active' => '1',
                'popup_type' => 'campaign',
                'popup_campaign_id' => $this->campaign->id,
                'popup_title' => 'Pop-up Test Kampanye',
                'popup_description' => 'Deskripsi kampanye uji coba',
                'contact_email' => 'support@pedulia.com',
                'contact_phone' => '(021) 8293-1029',
                'contact_address' => 'Menteng, Jakarta Pusat, Indonesia',
                'socials' => [
                    ['id' => 'facebook', 'name' => 'Facebook', 'url' => 'https://facebook.com', 'is_active' => '1'],
                    ['id' => 'twitter', 'name' => 'Twitter', 'url' => 'https://twitter.com', 'is_active' => '1'],
                    ['id' => 'instagram', 'name' => 'Instagram', 'url' => 'https://instagram.com', 'is_active' => '1'],
                    ['id' => 'custom', 'name' => '', 'url' => '', 'is_active' => '0'],
                ]
            ]);

        $response->assertRedirect(route('admin.settings.index'));
        $response->assertSessionHas('success');

        $this->assertEquals('1', \App\Models\Setting::get('popup_active'));
        $this->assertEquals('campaign', \App\Models\Setting::get('popup_type'));
        $this->assertEquals($this->campaign->id, \App\Models\Setting::get('popup_campaign_id'));
        $this->assertEquals('Pop-up Test Kampanye', \App\Models\Setting::get('popup_title'));
        $this->assertEquals('Deskripsi kampanye uji coba', \App\Models\Setting::get('popup_description'));
    }

    public function test_welcome_popup_renders_on_homepage()
    {
        \App\Models\Setting::set('popup_active', '1');
        \App\Models\Setting::set('popup_type', 'campaign');
        \App\Models\Setting::set('popup_campaign_id', $this->campaign->id);
        \App\Models\Setting::set('popup_title', 'Donasi Pendidikan');

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Donasi Pendidikan');
        $response->assertSee($this->campaign->title);
    }

    public function test_public_campaigns_page_renders_successfully()
    {
        $response = $this->get(route('campaigns.index'));
        $response->assertStatus(200);
        $response->assertSee($this->campaign->title);
        $response->assertSee('Daftar Kampanye Donasi');
    }

    public function test_admin_can_update_carousel_settings()
    {
        $campaign2 = Campaign::create([
            'title' => 'Bantu Korban Banjir Bandang',
            'slug' => 'bantu-korban-banjir-bandang',
            'thumbnail' => '/images/campaign_flood.png',
            'category' => 'bencana',
            'description' => '<p>Deskripsi kampanye bencana alam.</p>',
            'target_amount' => 100000000,
            'current_amount' => 0,
            'donation_options' => [20000, 50000],
            'status' => 'active',
            'days_remaining' => 25,
        ]);

        $response = $this->actingAs($this->admin)
            ->post(route('admin.settings.update'), [
                'bank_name' => 'BANK NEGARA INDONESIA',
                'bank_account_number' => '9876-5432-10',
                'bank_account_name' => 'Yayasan Amal Pedulia',
                'whatsapp_number' => '6289999999999',
                'carousel_source' => 'custom',
                'carousel_campaign_ids' => [$this->campaign->id, $campaign2->id],
                'contact_email' => 'support@pedulia.com',
                'contact_phone' => '(021) 8293-1029',
                'contact_address' => 'Menteng, Jakarta Pusat, Indonesia',
                'socials' => [
                    ['id' => 'facebook', 'name' => 'Facebook', 'url' => 'https://facebook.com', 'is_active' => '1'],
                    ['id' => 'twitter', 'name' => 'Twitter', 'url' => 'https://twitter.com', 'is_active' => '1'],
                    ['id' => 'instagram', 'name' => 'Instagram', 'url' => 'https://instagram.com', 'is_active' => '1'],
                    ['id' => 'custom', 'name' => '', 'url' => '', 'is_active' => '0'],
                ]
            ]);

        $response->assertRedirect(route('admin.settings.index'));
        $response->assertSessionHas('success');

        $this->assertEquals('custom', \App\Models\Setting::get('carousel_source'));
        
        $savedIds = json_decode(\App\Models\Setting::get('carousel_campaign_ids'), true);
        $this->assertContains($this->campaign->id, $savedIds);
        $this->assertContains($campaign2->id, $savedIds);
    }

    public function test_donor_can_access_dedicated_donation_page()
    {
        $response = $this->get(route('campaigns.donate.create', $this->campaign->slug));
        $response->assertStatus(200);
        $response->assertSee('Anda akan berdonasi untuk');
        $response->assertSee($this->campaign->title);
        $response->assertSee('Nama Donatur (Wajib)');
    }

    public function test_admin_can_access_payment_methods_index()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.payment-methods.index'));

        $response->assertStatus(200);
        $response->assertSee('Metode Pembayaran');
        $response->assertSee('QRIS (GoPay, OVO, Dana, LinkAja)');
    }

    public function test_admin_can_create_bank_payment_method()
    {
        $response = $this->actingAs($this->admin)
            ->post(route('admin.payment-methods.store'), [
                'name' => 'Bank Mandiri Syariah',
                'type' => 'bank',
                'bank_name' => 'BANK MANDIRI SYARIAH',
                'bank_account_number' => '700-1122-3344',
                'bank_account_name' => 'Pedulia Syariah',
                'status' => '1',
            ]);

        $response->assertRedirect(route('admin.payment-methods.index'));
        $this->assertDatabaseHas('payment_methods', [
            'name' => 'Bank Mandiri Syariah',
            'bank_name' => 'BANK MANDIRI SYARIAH',
            'bank_account_number' => '700-1122-3344',
        ]);
    }

    public function test_admin_can_edit_payment_method()
    {
        $pm = \App\Models\PaymentMethod::where('code', 'qris')->first();
        $this->assertNotNull($pm);

        $response = $this->actingAs($this->admin)
            ->put(route('admin.payment-methods.update', $pm->id), [
                'name' => 'QRIS Gopay & ShopeePay',
                'type' => 'qris',
                'status' => '1',
            ]);

        $response->assertRedirect(route('admin.payment-methods.index'));
        $pm->refresh();
        $this->assertEquals('QRIS Gopay & ShopeePay', $pm->name);
    }

    public function test_admin_can_delete_payment_method()
    {
        $pm = \App\Models\PaymentMethod::create([
            'name' => 'Temp Bank',
            'code' => 'temp-bank',
            'type' => 'bank',
            'bank_name' => 'TEMP',
            'bank_account_number' => '123',
            'bank_account_name' => 'TEMP',
        ]);

        $response = $this->actingAs($this->admin)
            ->delete(route('admin.payment-methods.destroy', $pm->id));

        $response->assertRedirect(route('admin.payment-methods.index'));
        $this->assertDatabaseMissing('payment_methods', ['id' => $pm->id]);
    }

    public function test_donor_can_create_qris_donation_with_cashify()
    {
        // Mock config keys
        config(['services.cashify.license_key' => 'test_license_key']);
        config(['services.cashify.qris_id' => 'test_qris_id']);

        \Illuminate\Support\Facades\Http::fake([
            'https://cashify.my.id/api/generate/v2/qris' => \Illuminate\Support\Facades\Http::response([
                'status' => 200,
                'data' => [
                    'transactionId' => 'TX-CASHIFY-12345',
                    'qr_string' => 'mock_qr_string',
                    'totalAmount' => 50123,
                    'uniqueNominal' => 123
                ]
            ])
        ]);

        $response = $this->post(route('campaigns.donate', $this->campaign->slug), [
            'donor_name' => 'Donatur QRIS',
            'donor_email' => 'qris@test.com',
            'nominal' => 50000,
            'payment_method' => 'qris',
        ]);

        $donation = Donation::where('donor_email', 'qris@test.com')->first();
        $this->assertNotNull($donation);
        $this->assertEquals('TX-CASHIFY-12345', $donation->cashify_transaction_id);
        $this->assertEquals('mock_qr_string', $donation->cashify_qr_string);
        $this->assertEquals(50123, $donation->total_amount);
        $this->assertEquals(123, $donation->unique_code);

        $response->assertRedirect(route('donations.invoice', $donation->invoice_number));
    }

    public function test_check_status_via_ajax_calls_cashify_and_updates_donation()
    {
        \Illuminate\Support\Facades\Mail::fake();
        config(['services.cashify.license_key' => 'test_license_key']);

        $donation = Donation::create([
            'campaign_id' => $this->campaign->id,
            'invoice_number' => 'INV-CASH-888',
            'donor_name' => 'Hamba Allah',
            'donor_email' => 'hamba@test.com',
            'nominal' => 20000,
            'unique_code' => 123,
            'total_amount' => 20123,
            'payment_method' => 'qris',
            'status' => 'pending',
            'cashify_transaction_id' => 'TX-PENDING-111',
        ]);

        \Illuminate\Support\Facades\Http::fake([
            'https://cashify.my.id/api/generate/check-status' => \Illuminate\Support\Facades\Http::response([
                'status' => 200,
                'data' => [
                    'status' => 'paid',
                ]
            ])
        ]);

        $response = $this->get(route('donations.status', $donation->invoice_number));
        $response->assertStatus(200);
        $response->assertJson(['status' => 'confirmed']);

        $donation->refresh();
        $this->assertEquals('confirmed', $donation->status);

        // Assert campaign amount increased by nominal (10000000 + 20000 = 10020000)
        $this->campaign->refresh();
        $this->assertEquals(10020000, $this->campaign->current_amount);

        // Assert that the email was sent
        \Illuminate\Support\Facades\Mail::assertSent(\App\Mail\DonationSuccessMail::class, function ($mail) use ($donation) {
            return $mail->hasTo($donation->donor_email) && $mail->donation->id === $donation->id;
        });
    }

    public function test_check_cashify_payments_background_command()
    {
        \Illuminate\Support\Facades\Mail::fake();
        config(['services.cashify.license_key' => 'test_license_key']);

        $donation = Donation::create([
            'campaign_id' => $this->campaign->id,
            'invoice_number' => 'INV-CRON-777',
            'donor_name' => 'Hamba Allah',
            'donor_email' => 'hamba@test.com',
            'nominal' => 30000,
            'unique_code' => 456,
            'total_amount' => 30456,
            'payment_method' => 'qris',
            'status' => 'pending',
            'cashify_transaction_id' => 'TX-CRON-222',
        ]);

        \Illuminate\Support\Facades\Http::fake([
            'https://cashify.my.id/api/generate/check-status' => \Illuminate\Support\Facades\Http::response([
                'status' => 200,
                'data' => [
                    'status' => 'paid',
                ]
            ])
        ]);

        $this->artisan('app:check-cashify-payments')
            ->expectsOutput("Checking status for 1 pending donation(s)...")
            ->expectsOutput("Invoice #INV-CRON-777 successfully marked as PAID.")
            ->assertExitCode(0);

        $donation->refresh();
        $this->assertEquals('confirmed', $donation->status);

        // Assert campaign amount increased by nominal (10000000 + 30000 = 10030000)
        $this->campaign->refresh();
        $this->assertEquals(10030000, $this->campaign->current_amount);

        // Assert that the email was sent
        \Illuminate\Support\Facades\Mail::assertSent(\App\Mail\DonationSuccessMail::class, function ($mail) use ($donation) {
            return $mail->hasTo($donation->donor_email) && $mail->donation->id === $donation->id;
        });
    }

    public function test_expired_donation_is_cancelled_via_ajax_check()
    {
        $donation = Donation::create([
            'campaign_id' => $this->campaign->id,
            'invoice_number' => 'INV-EXPIRED-AJAX',
            'donor_name' => 'Expired Donor',
            'donor_email' => 'expired@test.com',
            'nominal' => 20000,
            'unique_code' => 123,
            'total_amount' => 20123,
            'payment_method' => 'qris',
            'status' => 'pending',
        ]);

        \Illuminate\Support\Facades\DB::table('donations')
            ->where('id', $donation->id)
            ->update(['created_at' => now()->subMinutes(16)]);

        $response = $this->get(route('donations.status', $donation->invoice_number));
        $response->assertStatus(200);
        $response->assertJson(['status' => 'cancelled']);

        $donation->refresh();
        $this->assertEquals('cancelled', $donation->status);
    }

    public function test_expired_donation_is_cancelled_via_background_command()
    {
        config(['services.cashify.license_key' => 'test_license_key']);

        $donation = Donation::create([
            'campaign_id' => $this->campaign->id,
            'invoice_number' => 'INV-EXPIRED-CRON',
            'donor_name' => 'Expired Donor 2',
            'donor_email' => 'expired2@test.com',
            'nominal' => 30000,
            'unique_code' => 456,
            'total_amount' => 30456,
            'payment_method' => 'qris',
            'status' => 'pending',
            'cashify_transaction_id' => 'TX-CRON-EXP',
        ]);

        \Illuminate\Support\Facades\DB::table('donations')
            ->where('id', $donation->id)
            ->update(['created_at' => now()->subMinutes(16)]);

        \Illuminate\Support\Facades\Http::fake([
            'https://cashify.my.id/api/generate/check-status' => \Illuminate\Support\Facades\Http::response([
                'status' => 200,
                'data' => [
                    'status' => 'pending',
                ]
            ])
        ]);

        $this->artisan('app:check-cashify-payments')
            ->expectsOutput("Checking status for 1 pending donation(s)...")
            ->expectsOutput("Invoice #INV-EXPIRED-CRON is still pending.")
            ->expectsOutput("Invoice #INV-EXPIRED-CRON has EXPIRED and was marked as CANCELLED.")
            ->assertExitCode(0);

        $donation->refresh();
        $this->assertEquals('cancelled', $donation->status);
    }

    public function test_admin_can_update_footer_contacts_and_social_media()
    {
        $payload = [
            'bank_name' => 'NOBU BANK',
            'bank_account_number' => '1031-0988-1234',
            'bank_account_name' => 'Yayasan Pedulia',
            'whatsapp_number' => '6281234567890',
            'popup_active' => '0',
            'popup_type' => 'custom_image',
            'carousel_source' => 'latest',
            
            // Footer contact & support
            'contact_email' => 'custom-support@pedulia.org',
            'contact_phone' => '0899-999-999',
            'contact_address' => 'Sudirman, Jakarta Selatan, Indonesia',
            
            // Socials payload
            'socials' => [
                [
                    'id' => 'facebook',
                    'name' => 'Facebook',
                    'url' => 'https://facebook.com/pedulia.new',
                    'is_active' => '1',
                ],
                [
                    'id' => 'twitter',
                    'name' => 'Twitter',
                    'url' => 'https://twitter.com/pedulia.new',
                    'is_active' => '1',
                ],
                [
                    'id' => 'instagram',
                    'name' => 'Instagram',
                    'url' => 'https://instagram.com/pedulia.new',
                    'is_active' => '0', // Disabled
                ],
                [
                    'id' => 'custom',
                    'name' => 'YouTube',
                    'url' => 'https://youtube.com/c/pedulia',
                    'is_active' => '1', // Custom enabled
                ],
            ]
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.settings.update'), $payload);

        $response->assertRedirect();
        
        $this->assertEquals('custom-support@pedulia.org', \App\Models\Setting::get('contact_email'));
        $this->assertEquals('0899-999-999', \App\Models\Setting::get('contact_phone'));
        $this->assertEquals('Sudirman, Jakarta Selatan, Indonesia', \App\Models\Setting::get('contact_address'));

        $socials = json_decode(\App\Models\Setting::get('social_media'), true);
        $this->assertCount(4, $socials);
        $this->assertEquals('facebook', $socials[0]['id']);
        $this->assertTrue($socials[0]['is_active']);
        $this->assertEquals('https://facebook.com/pedulia.new', $socials[0]['url']);
        
        $this->assertFalse($socials[2]['is_active']); // Instagram should be inactive
        
        $this->assertEquals('custom', $socials[3]['id']);
        $this->assertEquals('YouTube', $socials[3]['name']);
        $this->assertTrue($socials[3]['is_active']);
    }

    public function test_public_footer_renders_dynamic_contacts_and_social_media()
    {
        \App\Models\Setting::set('contact_email', 'dynamic-footer-email@test.com');
        \App\Models\Setting::set('contact_phone', '(021) 9999-8888');
        \App\Models\Setting::set('contact_address', 'Kebagusan Raya, Jakarta Selatan');

        $socialMedia = [
            [
                'id' => 'facebook',
                'name' => 'Facebook',
                'url' => 'https://facebook.com/active-fb',
                'is_active' => true,
                'icon_type' => 'default',
                'icon_default' => 'facebook',
                'icon_custom_path' => null
            ],
            [
                'id' => 'twitter',
                'name' => 'Twitter',
                'url' => 'https://twitter.com/active-tw',
                'is_active' => true,
                'icon_type' => 'default',
                'icon_default' => 'twitter',
                'icon_custom_path' => null
            ],
            [
                'id' => 'instagram',
                'name' => 'Instagram',
                'url' => 'https://instagram.com/inactive-ig',
                'is_active' => false, // Disabled
                'icon_type' => 'default',
                'icon_default' => 'instagram',
                'icon_custom_path' => null
            ],
            [
                'id' => 'custom',
                'name' => 'TikTok',
                'url' => 'https://tiktok.com/@active-custom',
                'is_active' => true,
                'icon_type' => 'custom',
                'icon_default' => null,
                'icon_custom_path' => '/images/socials/custom_tiktok.png'
            ]
        ];
        \App\Models\Setting::set('social_media', json_encode($socialMedia));

        $response = $this->get('/');
        $response->assertStatus(200);

        // Assert Contacts are present
        $response->assertSee('dynamic-footer-email@test.com');
        $response->assertSee('(021) 9999-8888');
        $response->assertSee('Kebagusan Raya, Jakarta Selatan');

        // Assert Social links are present
        $response->assertSee('https://facebook.com/active-fb');
        $response->assertSee('https://twitter.com/active-tw');
        $response->assertDontSee('https://instagram.com/inactive-ig');
        $response->assertSee('https://tiktok.com/@active-custom');
        $response->assertSee('/images/socials/custom_tiktok.png');
    }
}

