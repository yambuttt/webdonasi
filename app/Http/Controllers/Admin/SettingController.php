<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Display the settings management panel.
     */
    public function index()
    {
        $settings = [
            'qris_image' => Setting::get('qris_image', '/images/qris.png'),
            'bank_name' => Setting::get('bank_name', 'NOBU BANK'),
            'bank_account_number' => Setting::get('bank_account_number', '1031-0988-1234'),
            'bank_account_name' => Setting::get('bank_account_name', 'Yayasan Pedulia'),
            'whatsapp_number' => Setting::get('whatsapp_number', '6281234567890'),
            // Popup settings
            'popup_active' => Setting::get('popup_active', '0'),
            'popup_type' => Setting::get('popup_type', 'custom_image'),
            'popup_campaign_id' => Setting::get('popup_campaign_id'),
            'popup_article_id' => Setting::get('popup_article_id'),
            'popup_custom_image' => Setting::get('popup_custom_image'),
            'popup_link' => Setting::get('popup_link'),
            'popup_title' => Setting::get('popup_title'),
            'popup_description' => Setting::get('popup_description'),
            'carousel_source' => Setting::get('carousel_source', 'latest'),
            'carousel_campaign_ids' => json_decode(Setting::get('carousel_campaign_ids', '[]'), true),
        ];

        $campaigns = \App\Models\Campaign::latest()->get();
        $articles = \App\Models\Article::latest()->get();

        return view('admin.settings.index', compact('settings', 'campaigns', 'articles'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'qris_image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'bank_name' => 'required|string|max:100',
            'bank_account_number' => 'required|string|max:100',
            'bank_account_name' => 'required|string|max:150',
            'whatsapp_number' => 'required|string|max:30',
            // Popup validation
            'popup_active' => 'nullable|in:0,1',
            'popup_type' => 'required_if:popup_active,1|in:custom_image,campaign,article',
            'popup_campaign_id' => 'required_if:popup_type,campaign|nullable|exists:campaigns,id',
            'popup_article_id' => 'required_if:popup_type,article|nullable|exists:articles,id',
            'popup_custom_image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'popup_link' => 'nullable|url|max:255',
            'popup_title' => 'nullable|string|max:255',
            'popup_description' => 'nullable|string|max:1000',
            'carousel_source' => 'nullable|in:latest,custom',
            'carousel_campaign_ids' => 'required_if:carousel_source,custom|array',
            'carousel_campaign_ids.*' => 'exists:campaigns,id',
        ], [
            'qris_image.image' => 'File QRIS harus berupa gambar.',
            'qris_image.mimes' => 'Format gambar QRIS wajib jpeg, png, jpg, atau svg.',
            'qris_image.max' => 'Ukuran gambar QRIS tidak boleh melebihi 2MB.',
            'bank_name.required' => 'Nama bank wajib diisi.',
            'bank_account_number.required' => 'Nomor rekening wajib diisi.',
            'bank_account_name.required' => 'Nama pemilik rekening wajib diisi.',
            'whatsapp_number.required' => 'Nomor WhatsApp konfirmasi wajib diisi.',
            'popup_type.required_if' => 'Tipe pop-up wajib dipilih jika pop-up aktif.',
            'popup_campaign_id.required_if' => 'Kampanye wajib dipilih untuk tipe pop-up kampanye.',
            'popup_article_id.required_if' => 'Artikel wajib dipilih untuk tipe pop-up artikel.',
            'popup_custom_image.image' => 'File gambar pop-up harus berupa gambar.',
            'popup_custom_image.mimes' => 'Format gambar pop-up wajib jpeg, png, jpg, atau svg.',
            'popup_custom_image.max' => 'Ukuran gambar pop-up tidak boleh melebihi 2MB.',
            'popup_link.url' => 'Format link pop-up kustom harus berupa URL yang valid.',
            'carousel_campaign_ids.required_if' => 'Kampanye wajib dipilih jika sumber slideshow diatur ke Pilihan Admin.',
        ]);

        // Process QRIS Image upload if present
        if ($request->hasFile('qris_image')) {
            $file = $request->file('qris_image');
            $filename = 'qris_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            Setting::set('qris_image', '/images/' . $filename);
        }

        // Process Popup Image upload if present
        if ($request->hasFile('popup_custom_image')) {
            $file = $request->file('popup_custom_image');
            $filename = 'popup_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            Setting::set('popup_custom_image', '/images/' . $filename);
        }

        // Save other configurations
        Setting::set('bank_name', $request->input('bank_name'));
        Setting::set('bank_account_number', $request->input('bank_account_number'));
        Setting::set('bank_account_name', $request->input('bank_account_name'));
        
        // Clean whatsapp number (remove plus sign, spaces, dashes)
        $wa = preg_replace('/[^0-9]/', '', $request->input('whatsapp_number'));
        Setting::set('whatsapp_number', $wa);

        // Save popup configurations
        Setting::set('popup_active', $request->input('popup_active', '0'));
        Setting::set('popup_type', $request->input('popup_type'));
        Setting::set('popup_campaign_id', $request->input('popup_campaign_id'));
        Setting::set('popup_article_id', $request->input('popup_article_id'));
        Setting::set('popup_link', $request->input('popup_link'));
        Setting::set('popup_title', $request->input('popup_title'));
        Setting::set('popup_description', $request->input('popup_description'));
        
        // Save slideshow configurations
        if ($request->has('carousel_source')) {
            Setting::set('carousel_source', $request->input('carousel_source', 'latest'));
            if ($request->input('carousel_source') === 'custom') {
                Setting::set('carousel_campaign_ids', json_encode($request->input('carousel_campaign_ids', [])));
            } else {
                Setting::set('carousel_campaign_ids', json_encode([]));
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan sistem berhasil diperbarui.');
    }
}
