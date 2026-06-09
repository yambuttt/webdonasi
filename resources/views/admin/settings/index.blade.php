@extends('layouts.admin')

@section('title', 'Pengaturan Pembayaran Manual')

@section('content')
<div class="space-y-6 max-w-4xl">
    <!-- Header Page -->
    <div>
        <h1 class="text-2xl font-black text-charcoal tracking-tight">Pengaturan Pembayaran & Kontak</h1>
        <p class="text-xs text-slate-400 font-semibold mt-0.5">Konfigurasi rekening bank transfer manual, upload QRIS, dan nomor WhatsApp admin</p>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
    <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 text-xs font-bold rounded-2xl flex items-center space-x-2">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    @if($errors->any())
    <div class="p-4 bg-rose-50 border border-rose-100 text-rose-700 text-xs font-bold rounded-2xl space-y-1">
        <div class="flex items-center space-x-2">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Mohon koreksi kesalahan berikut:</span>
        </div>
        <ul class="list-disc pl-6 space-y-0.5">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="bg-white border border-slate-100 rounded-3xl shadow-sm overflow-hidden p-6 md:p-8 space-y-8">
        @csrf

        <!-- QRIS Setting Section -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start border-b border-slate-100 pb-8">
            <div class="md:col-span-4 space-y-1">
                <h3 class="text-sm font-extrabold text-charcoal uppercase tracking-wider">Metode Pembayaran QRIS</h3>
                <p class="text-[11px] text-slate-400 font-semibold leading-relaxed">Upload gambar barcode QRIS yang akan discan oleh donatur saat memilih metode pembayaran QRIS.</p>
            </div>
            
            <div class="md:col-span-8 space-y-4">
                <!-- Current QRIS Preview -->
                <div class="flex items-start space-x-4">
                    <div class="w-36 h-36 border border-slate-200 rounded-2xl overflow-hidden bg-slate-50 p-1 flex-shrink-0 shadow-inner">
                        <img id="qris-preview" src="{{ $settings['qris_image'] }}" alt="QRIS Preview" class="w-full h-full object-contain">
                    </div>
                    <div class="space-y-2">
                        <label for="qris_image" class="block text-xs font-bold text-charcoal">Upload Foto QRIS Baru</label>
                        <input type="file" name="qris_image" id="qris_image" onchange="previewImage(this)" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary/10 file:text-charcoal-light hover:file:bg-primary/20 file:cursor-pointer">
                        <span class="block text-[10px] text-slate-400 font-semibold">Format yang didukung: JPG, PNG, JPEG, SVG. Maks 2MB.</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bank Account Setting Section -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start border-b border-slate-100 pb-8">
            <div class="md:col-span-4 space-y-1">
                <h3 class="text-sm font-extrabold text-charcoal uppercase tracking-wider">Transfer Bank Manual</h3>
                <p class="text-[11px] text-slate-400 font-semibold leading-relaxed">Informasi rekening bank tujuan donatur saat melakukan pembayaran via transfer bank.</p>
            </div>
            
            <div class="md:col-span-8 space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label for="bank_name" class="text-xs font-bold text-charcoal">Nama Bank</label>
                        <input type="text" name="bank_name" id="bank_name" value="{{ old('bank_name', $settings['bank_name']) }}" placeholder="Contoh: NOBU BANK" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold placeholder-slate-400 focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                    </div>

                    <div class="space-y-1.5">
                        <label for="bank_account_number" class="text-xs font-bold text-charcoal">Nomor Rekening</label>
                        <input type="text" name="bank_account_number" id="bank_account_number" value="{{ old('bank_account_number', $settings['bank_account_number']) }}" placeholder="Contoh: 1031-0988-1234" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold placeholder-slate-400 focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label for="bank_account_name" class="text-xs font-bold text-charcoal">Nama Pemilik Rekening (Atas Nama)</label>
                    <input type="text" name="bank_account_name" id="bank_account_name" value="{{ old('bank_account_name', $settings['bank_account_name']) }}" placeholder="Contoh: Yayasan Pedulia" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold placeholder-slate-400 focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                </div>
            </div>
        </div>

        <!-- WhatsApp Setting Section -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
            <div class="md:col-span-4 space-y-1">
                <h3 class="text-sm font-extrabold text-charcoal uppercase tracking-wider">Kontak Konfirmasi WhatsApp</h3>
                <p class="text-[11px] text-slate-400 font-semibold leading-relaxed">Nomor WhatsApp Admin untuk menerima bukti transfer / scan QRIS manual langsung dari halaman invoice donatur.</p>
            </div>
            
            <div class="md:col-span-8 space-y-1.5">
                <label for="whatsapp_number" class="text-xs font-bold text-charcoal">Nomor WhatsApp Admin</label>
                <div class="relative">
                    <input type="text" name="whatsapp_number" id="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number']) }}" placeholder="Contoh: 6281234567890" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold placeholder-slate-400 focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                </div>
                <span class="block text-[10px] text-amber-600 font-semibold leading-normal">
                    * Catatan: Gunakan format angka penuh dengan kode negara di awal (contoh: <strong>6281234567890</strong>), hindari menggunakan tanda + atau spasi.
                </span>
            </div>
        </div>

        <!-- Pop-up Welcome Setting Section -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start border-t border-slate-100 pt-8">
            <div class="md:col-span-4 space-y-1">
                <h3 class="text-sm font-extrabold text-charcoal uppercase tracking-wider">Pop-up Selamat Datang</h3>
                <p class="text-[11px] text-slate-400 font-semibold leading-relaxed">Kelola pop-up promo/pengumuman yang muncul saat donatur pertama kali berkunjung ke beranda.</p>
            </div>
            
            <div class="md:col-span-8 space-y-6">
                <!-- Checkbox Active -->
                <div class="flex items-center space-x-3">
                    <input type="checkbox" name="popup_active" id="popup_active" value="1" {{ old('popup_active', $settings['popup_active']) === '1' ? 'checked' : '' }} class="h-4 w-4 text-primary border-slate-300 rounded focus:ring-primary">
                    <label for="popup_active" class="text-xs font-bold text-charcoal cursor-pointer">Aktifkan Pop-up Selamat Datang</label>
                </div>

                <!-- Popup Configuration (Only relevant if active) -->
                <div id="popup-config-container" class="space-y-4 pt-2 {{ old('popup_active', $settings['popup_active']) === '1' ? '' : 'hidden' }}">
                    <!-- Type Selection -->
                    <div class="space-y-1.5">
                        <label for="popup_type" class="text-xs font-bold text-charcoal">Tipe Konten Pop-up</label>
                        <select name="popup_type" id="popup_type" onchange="togglePopupTypeFields(this.value)" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                            <option value="custom_image" {{ old('popup_type', $settings['popup_type']) === 'custom_image' ? 'selected' : '' }}>Gambar Kustom</option>
                            <option value="campaign" {{ old('popup_type', $settings['popup_type']) === 'campaign' ? 'selected' : '' }}>Postingan Kampanye</option>
                            <option value="article" {{ old('popup_type', $settings['popup_type']) === 'article' ? 'selected' : '' }}>Artikel Edukasi</option>
                        </select>
                    </div>

                    <!-- Custom Image Fields -->
                    <div id="popup-custom-image-fields" class="space-y-4 popup-type-fields">
                        <div class="flex items-start space-x-4">
                            <div class="w-36 h-36 border border-slate-200 rounded-2xl overflow-hidden bg-slate-50 p-1 flex-shrink-0 shadow-inner flex items-center justify-center">
                                <img id="popup-image-preview" src="{{ $settings['popup_custom_image'] ?: '/images/hero.png' }}" alt="Popup Image Preview" class="w-full h-full object-contain">
                            </div>
                            <div class="space-y-2">
                                <label for="popup_custom_image" class="block text-xs font-bold text-charcoal">Upload Gambar Pop-up Kustom</label>
                                <input type="file" name="popup_custom_image" id="popup_custom_image" onchange="previewPopupImage(this)" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary/10 file:text-charcoal-light hover:file:bg-primary/20 file:cursor-pointer">
                                <span class="block text-[10px] text-slate-400 font-semibold">Format yang didukung: JPG, PNG, JPEG, SVG. Maks 2MB.</span>
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label for="popup_link" class="text-xs font-bold text-charcoal">URL Link Tujuan (Opsional)</label>
                            <input type="text" name="popup_link" id="popup_link" value="{{ old('popup_link', $settings['popup_link']) }}" placeholder="Contoh: https://pedulia.com/campaigns/target" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold placeholder-slate-400 focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                        </div>
                    </div>

                    <!-- Campaign Selection Fields -->
                    <div id="popup-campaign-fields" class="space-y-1.5 popup-type-fields hidden">
                        <label for="popup_campaign_id" class="text-xs font-bold text-charcoal">Pilih Kampanye</label>
                        <select name="popup_campaign_id" id="popup_campaign_id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                            <option value="">-- Pilih Kampanye --</option>
                            @foreach($campaigns as $camp)
                                <option value="{{ $camp->id }}" {{ old('popup_campaign_id', $settings['popup_campaign_id']) == $camp->id ? 'selected' : '' }}>{{ $camp->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Article Selection Fields -->
                    <div id="popup-article-fields" class="space-y-1.5 popup-type-fields hidden">
                        <label for="popup_article_id" class="text-xs font-bold text-charcoal">Pilih Artikel</label>
                        <select name="popup_article_id" id="popup_article_id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                            <option value="">-- Pilih Artikel --</option>
                            @foreach($articles as $art)
                                <option value="{{ $art->id }}" {{ old('popup_article_id', $settings['popup_article_id']) == $art->id ? 'selected' : '' }}>{{ $art->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Title & Description (Optional overrides) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label for="popup_title" class="text-xs font-bold text-charcoal">Judul Pop-up (Opsional)</label>
                            <input type="text" name="popup_title" id="popup_title" value="{{ old('popup_title', $settings['popup_title']) }}" placeholder="Contoh: Promo Ramadhan Berkah" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold placeholder-slate-400 focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                        </div>

                        <div class="space-y-1.5">
                            <label for="popup_description" class="text-xs font-bold text-charcoal">Deskripsi Pop-up (Opsional)</label>
                            <input type="text" name="popup_description" id="popup_description" value="{{ old('popup_description', $settings['popup_description']) }}" placeholder="Contoh: Dapatkan diskon/penyaluran berlipat" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold placeholder-slate-400 focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Slideshow Setting Section -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start border-t border-slate-100 pt-8">
            <div class="md:col-span-4 space-y-1">
                <h3 class="text-sm font-extrabold text-charcoal uppercase tracking-wider">Slideshow Halaman Donasi</h3>
                <p class="text-[11px] text-slate-400 font-semibold leading-relaxed">Pilih kampanye yang akan ditampilkan pada slideshow di bagian atas halaman daftar kampanye donasi.</p>
            </div>
            
            <div class="md:col-span-8 space-y-6">
                <!-- Source Selection -->
                <div class="space-y-1.5">
                    <label for="carousel_source" class="text-xs font-bold text-charcoal">Sumber Kampanye Slideshow</label>
                    <select name="carousel_source" id="carousel_source" onchange="toggleCarouselSourceFields(this.value)" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                        <option value="latest" {{ old('carousel_source', $settings['carousel_source']) === 'latest' ? 'selected' : '' }}>4 Kampanye Terbaru</option>
                        <option value="custom" {{ old('carousel_source', $settings['carousel_source']) === 'custom' ? 'selected' : '' }}>Pilihan Admin (Pilih Manual)</option>
                    </select>
                </div>

                <!-- Custom Campaigns Checklist (Show if source is custom) -->
                <div id="carousel-custom-fields" class="space-y-3 pt-2 {{ old('carousel_source', $settings['carousel_source']) === 'custom' ? '' : 'hidden' }}">
                    <label class="text-xs font-bold text-charcoal block">Pilih Kampanye yang Ditampilkan</label>
                    <div class="max-h-60 overflow-y-auto border border-slate-100 rounded-2xl p-4 bg-slate-50/50 space-y-3">
                        @foreach($campaigns as $camp)
                        <label class="flex items-center space-x-3.5 p-2 bg-white rounded-xl border border-slate-100 cursor-pointer hover:bg-slate-50/50 transition-all">
                            <input type="checkbox" name="carousel_campaign_ids[]" value="{{ $camp->id }}" 
                                {{ in_array($camp->id, old('carousel_campaign_ids', $settings['carousel_campaign_ids'] ?? [])) ? 'checked' : '' }}
                                class="h-4 w-4 text-primary border-slate-300 rounded focus:ring-primary">
                            @if($camp->thumbnail)
                                <img src="{{ $camp->thumbnail }}" alt="{{ $camp->title }}" class="w-12 h-8 object-cover rounded-lg border border-slate-100">
                            @endif
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-bold text-charcoal truncate">{{ $camp->title }}</p>
                                <p class="text-[10px] text-slate-400 font-semibold capitalize">{{ $camp->category }} &bull; Target: Rp {{ number_format($camp->target_amount, 0, ',', '.') }}</p>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    <span class="block text-[10px] text-slate-400 font-semibold leading-normal">
                        * Catatan: Anda dapat memilih beberapa kampanye. Kampanye yang tidak aktif (draft/completed) tidak akan ditampilkan di halaman depan publik.
                    </span>
                </div>
            </div>
        </div>

        <!-- Footer & Social Media Setting Section -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start border-t border-slate-100 pt-8">
            <div class="md:col-span-4 space-y-1">
                <h3 class="text-sm font-extrabold text-charcoal uppercase tracking-wider">Footer: Kontak & Sosial Media</h3>
                <p class="text-[11px] text-slate-400 font-semibold leading-relaxed">Konfigurasi informasi kontak dan maksimal 4 akun sosial media yang tampil pada bagian bawah (footer) website.</p>
            </div>
            
            <div class="md:col-span-8 space-y-6">
                <!-- Kontak & Bantuan -->
                <div class="space-y-4">
                    <h4 class="text-xs font-bold text-charcoal uppercase tracking-wider border-b border-slate-100 pb-2">Kontak & Bantuan</h4>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label for="contact_email" class="text-xs font-bold text-charcoal">Email Kontak</label>
                            <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $settings['contact_email']) }}" placeholder="Contoh: support@pedulia.com" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold placeholder-slate-400 focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                        </div>

                        <div class="space-y-1.5">
                            <label for="contact_phone" class="text-xs font-bold text-charcoal">Nomor Telepon Kontak</label>
                            <input type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', $settings['contact_phone']) }}" placeholder="Contoh: (021) 8293-1029" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold placeholder-slate-400 focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="contact_address" class="text-xs font-bold text-charcoal">Alamat Lengkap</label>
                        <input type="text" name="contact_address" id="contact_address" value="{{ old('contact_address', $settings['contact_address']) }}" placeholder="Contoh: Menteng, Jakarta Pusat, Indonesia" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold placeholder-slate-400 focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                    </div>
                </div>

                <!-- Ikuti Kami -->
                <div class="space-y-4 pt-2">
                    <h4 class="text-xs font-bold text-charcoal uppercase tracking-wider border-b border-slate-100 pb-2">Ikuti Kami (Sosial Media)</h4>
                    
                    <div class="space-y-4">
                        @foreach($settings['social_media'] as $index => $social)
                            <div class="p-4 bg-slate-50/50 border border-slate-100 rounded-2xl space-y-3">
                                <input type="hidden" name="socials[{{ $index }}][id]" value="{{ $social['id'] }}">
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        @if($social['id'] !== 'custom')
                                            <!-- Default SVG Icons for preview -->
                                            <div class="p-1.5 bg-slate-100 rounded-lg text-charcoal flex items-center justify-center">
                                                @if($social['id'] === 'facebook')
                                                    <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                                @elseif($social['id'] === 'twitter')
                                                    <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                                                @elseif($social['id'] === 'instagram')
                                                    <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204 0.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                                @endif
                                            </div>
                                            <span class="text-xs font-bold text-charcoal">{{ ucfirst($social['id']) }}</span>
                                            <input type="hidden" name="socials[{{ $index }}][name]" value="{{ ucfirst($social['id']) }}">
                                        @else
                                            <!-- Custom social slot icon and label -->
                                            <div class="flex items-center space-x-2">
                                                <div class="h-6 w-6 rounded-lg bg-slate-100 border border-slate-200 overflow-hidden flex items-center justify-center p-0.5">
                                                    @if($social['icon_custom_path'])
                                                        <img id="custom-social-preview" src="{{ $social['icon_custom_path'] }}" alt="Custom Icon Preview" class="w-full h-full object-contain">
                                                    @else
                                                        <span id="custom-social-placeholder" class="text-[9px] font-bold text-slate-400">Icon</span>
                                                    @endif
                                                </div>
                                                <input type="text" name="socials[{{ $index }}][name]" value="{{ old('socials.'.$index.'.name', $social['name']) }}" placeholder="Nama Sosmed (cth: TikTok)" class="px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-[10px] font-bold placeholder-slate-400 focus:outline-none focus:border-charcoal transition-all w-36">
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Display toggle -->
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" name="socials[{{ $index }}][is_active]" value="1" id="social-active-{{ $index }}" {{ old('socials.'.$index.'.is_active', $social['is_active']) ? 'checked' : '' }} class="h-4 w-4 text-primary border-slate-300 rounded focus:ring-primary">
                                        <label for="social-active-{{ $index }}" class="text-[10px] font-bold text-slate-500 cursor-pointer">Tampilkan</label>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-12 gap-3 items-center">
                                    <div class="md:col-span-8 space-y-1">
                                        <input type="text" name="socials[{{ $index }}][url]" value="{{ old('socials.'.$index.'.url', $social['url']) }}" placeholder="URL Profil Lengkap (contoh: https://instagram.com/pedulia)" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs font-semibold placeholder-slate-400 focus:outline-none focus:border-charcoal transition-all">
                                    </div>
                                    @if($social['id'] === 'custom')
                                        <div class="md:col-span-4">
                                            <input type="file" name="social_custom_icon" id="social_custom_icon" onchange="previewSocialIcon(this)" class="text-[10px] text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[9px] file:font-bold file:bg-primary/10 file:text-charcoal-light hover:file:bg-primary/20 file:cursor-pointer w-full">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="pt-6 border-t border-slate-100 flex items-center justify-end">
            <button type="submit" class="px-8 py-3.5 bg-primary text-charcoal font-bold rounded-xl text-xs shadow-[0_4px_12px_rgba(159,239,0,0.3)] hover:bg-primary-hover hover:shadow-[0_6px_16px_rgba(159,239,0,0.5)] transition-all cursor-pointer">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('qris-preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewPopupImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('popup-image-preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewSocialIcon(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                const previewEl = document.getElementById('custom-social-preview');
                if (previewEl) {
                    previewEl.src = e.target.result;
                } else {
                    const placeholder = document.getElementById('custom-social-placeholder');
                    if (placeholder) {
                        placeholder.outerHTML = `<img id="custom-social-preview" src="${e.target.result}" alt="Custom Icon Preview" class="w-full h-full object-contain">`;
                    }
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function toggleCarouselSourceFields(source) {
        var customFields = document.getElementById('carousel-custom-fields');
        if (customFields) {
            if (source === 'custom') {
                customFields.classList.remove('hidden');
            } else {
                customFields.classList.add('hidden');
            }
        }
    }

    function togglePopupTypeFields(type) {
        // Hide all
        document.querySelectorAll('.popup-type-fields').forEach(function(el) {
            el.classList.add('hidden');
        });

        // Show selected
        if (type === 'custom_image') {
            document.getElementById('popup-custom-image-fields').classList.remove('hidden');
        } else if (type === 'campaign') {
            document.getElementById('popup-campaign-fields').classList.remove('hidden');
        } else if (type === 'article') {
            document.getElementById('popup-article-fields').classList.remove('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Active checkbox toggle
        var activeCheckbox = document.getElementById('popup_active');
        var container = document.getElementById('popup-config-container');
        
        if (activeCheckbox && container) {
            activeCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    container.classList.remove('hidden');
                } else {
                    container.classList.add('hidden');
                }
            });
        }

        // Initialize type fields visibility
        var popupTypeSelect = document.getElementById('popup_type');
        if (popupTypeSelect) {
            togglePopupTypeFields(popupTypeSelect.value);
        }

        // Initialize carousel fields visibility
        var carouselSourceSelect = document.getElementById('carousel_source');
        if (carouselSourceSelect) {
            toggleCarouselSourceFields(carouselSourceSelect.value);
        }
    });
</script>
@endpush
