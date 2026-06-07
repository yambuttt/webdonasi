<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\CampaignController as AdminCampaignController;
use App\Http\Controllers\Public\ArticleController as PublicArticleController;
use App\Http\Controllers\Public\CampaignController as PublicCampaignController;
use App\Models\Campaign;
use App\Models\Setting;
use App\Models\Article;

use App\Http\Controllers\Public\DonationController as PublicDonationController;
use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;

Route::get('/', function () {
    $campaigns = Campaign::where('status', 'active')
        ->latest()
        ->get();

    $popup = [
        'active' => Setting::get('popup_active', '0') === '1',
        'type' => Setting::get('popup_type', 'custom_image'),
        'custom_image' => Setting::get('popup_custom_image'),
        'link' => Setting::get('popup_link'),
        'title' => Setting::get('popup_title'),
        'description' => Setting::get('popup_description'),
        'data' => null,
    ];

    if ($popup['active']) {
        if ($popup['type'] === 'campaign') {
            $campaignId = Setting::get('popup_campaign_id');
            if ($campaignId) {
                $popup['data'] = Campaign::find($campaignId);
            }
        } elseif ($popup['type'] === 'article') {
            $articleId = Setting::get('popup_article_id');
            if ($articleId) {
                $popup['data'] = Article::find($articleId);
            }
        }
    }

    return view('welcome', compact('campaigns', 'popup'));
});

// Public Articles
Route::get('/articles', [PublicArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [PublicArticleController::class, 'show'])->name('articles.show');

// Public Campaigns
Route::get('/campaigns/{slug}', [PublicCampaignController::class, 'show'])->name('campaigns.show');
Route::post('/campaigns/{slug}/donate', [PublicDonationController::class, 'store'])->name('campaigns.donate');
Route::get('/donations/{invoice_number}', [PublicDonationController::class, 'show'])->name('donations.invoice');

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Admin protected routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Articles CRUD Resources
        Route::resource('articles', AdminArticleController::class);

        // Campaigns CRUD Resources
        Route::resource('campaigns', AdminCampaignController::class);

        // Donations Management
        Route::get('/donations', [AdminDonationController::class, 'index'])->name('donations.index');
        Route::post('/donations/{id}/confirm', [AdminDonationController::class, 'confirm'])->name('donations.confirm');
        Route::post('/donations/{id}/cancel', [AdminDonationController::class, 'cancel'])->name('donations.cancel');
        Route::post('/donations/{id}/toggle-comment', [AdminDonationController::class, 'toggleComment'])->name('donations.toggle-comment');

        // Settings Management
        Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
    });
});
