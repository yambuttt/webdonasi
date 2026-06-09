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
            // Footer contact & support settings
            'contact_email' => Setting::get('contact_email', 'support@pedulia.com'),
            'contact_phone' => Setting::get('contact_phone', '(021) 8293-1029'),
            'contact_address' => Setting::get('contact_address', 'Menteng, Jakarta Pusat, Indonesia'),
        ];

        // Retrieve social media settings
        $defaultSocials = [
            [
                'id' => 'facebook',
                'name' => 'Facebook',
                'url' => 'https://facebook.com',
                'is_active' => true,
                'icon_type' => 'default',
                'icon_default' => 'facebook',
                'icon_custom_path' => null
            ],
            [
                'id' => 'twitter',
                'name' => 'Twitter',
                'url' => 'https://twitter.com',
                'is_active' => true,
                'icon_type' => 'default',
                'icon_default' => 'twitter',
                'icon_custom_path' => null
            ],
            [
                'id' => 'instagram',
                'name' => 'Instagram',
                'url' => 'https://instagram.com',
                'is_active' => true,
                'icon_type' => 'default',
                'icon_default' => 'instagram',
                'icon_custom_path' => null
            ],
            [
                'id' => 'custom',
                'name' => '',
                'url' => '',
                'is_active' => false,
                'icon_type' => 'custom',
                'icon_default' => null,
                'icon_custom_path' => null
            ]
        ];

        $socialMediaJson = Setting::get('social_media');
        $socialMedia = $socialMediaJson ? json_decode($socialMediaJson, true) : $defaultSocials;

        if (!is_array($socialMedia) || count($socialMedia) < 4) {
            $socialMedia = is_array($socialMedia) ? array_values($socialMedia) : [];
            for ($i = count($socialMedia); $i < 4; $i++) {
                if ($i === 3) {
                    $socialMedia[$i] = [
                        'id' => 'custom',
                        'name' => '',
                        'url' => '',
                        'is_active' => false,
                        'icon_type' => 'custom',
                        'icon_default' => null,
                        'icon_custom_path' => null
                    ];
                } else {
                    $socialMedia[$i] = $defaultSocials[$i];
                }
            }
        }
        $settings['social_media'] = $socialMedia;

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
            // Footer validations
            'contact_email' => 'required|email|max:150',
            'contact_phone' => 'required|string|max:50',
            'contact_address' => 'required|string|max:255',
            'socials' => 'required|array|size:4',
            'socials.*.id' => 'required|string',
            'socials.*.name' => 'nullable|string|max:50',
            'socials.*.url' => 'nullable|url|max:255',
            'social_custom_icon' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:1024',
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
            'contact_email.required' => 'Email kontak wajib diisi.',
            'contact_email.email' => 'Format email kontak tidak valid.',
            'contact_phone.required' => 'Nomor telepon kontak wajib diisi.',
            'contact_address.required' => 'Alamat kontak wajib diisi.',
            'socials.*.url.url' => 'Format URL sosial media tidak valid.',
            'social_custom_icon.image' => 'File ikon harus berupa gambar.',
            'social_custom_icon.mimes' => 'Format ikon wajib jpeg, png, jpg, atau svg.',
            'social_custom_icon.max' => 'Ukuran ikon tidak boleh melebihi 1MB.',
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

        // Save footer contact details
        Setting::set('contact_email', $request->input('contact_email'));
        Setting::set('contact_phone', $request->input('contact_phone'));
        Setting::set('contact_address', $request->input('contact_address'));

        // Save social media configurations
        $existingSocialsJson = Setting::get('social_media');
        $existingSocials = $existingSocialsJson ? json_decode($existingSocialsJson, true) : [];

        $inputSocials = $request->input('socials');
        $processedSocials = [];

        foreach ($inputSocials as $social) {
            $id = $social['id'];
            $name = $social['name'] ?? '';
            $url = $social['url'] ?? '';
            $isActive = isset($social['is_active']) && ($social['is_active'] == '1' || $social['is_active'] == 'on');

            // Find existing to preserve custom icon path
            $existingItem = null;
            if (is_array($existingSocials)) {
                foreach ($existingSocials as $item) {
                    if (isset($item['id']) && $item['id'] === $id) {
                        $existingItem = $item;
                        break;
                    }
                }
            }

            $iconType = ($id === 'custom') ? 'custom' : 'default';
            $iconDefault = ($id !== 'custom') ? $id : null;
            $iconCustomPath = $existingItem ? ($existingItem['icon_custom_path'] ?? null) : null;

            // Handle custom icon upload for the 4th item
            if ($id === 'custom' && $request->hasFile('social_custom_icon')) {
                $file = $request->file('social_custom_icon');
                $filename = 'social_custom_' . time() . '.' . $file->getClientOriginalExtension();
                
                if (!file_exists(public_path('images/socials'))) {
                    mkdir(public_path('images/socials'), 0755, true);
                }
                
                $file->move(public_path('images/socials'), $filename);
                $iconCustomPath = '/images/socials/' . $filename;
            }

            // Fallback name for default platforms
            if ($id !== 'custom') {
                $name = ucfirst($id);
            }

            $processedSocials[] = [
                'id' => $id,
                'name' => $name,
                'url' => $url,
                'is_active' => $isActive,
                'icon_type' => $iconType,
                'icon_default' => $iconDefault,
                'icon_custom_path' => $iconCustomPath,
            ];
        }

        Setting::set('social_media', json_encode($processedSocials));

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan sistem berhasil diperbarui.');
    }
}
