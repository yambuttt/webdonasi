@extends('layouts.app')

@section('title', 'Pedulia - Hubungkan Kebaikan, Bantu Sesama')

@section('content')

        <!-- Hero Section -->
        <section class="relative pt-32 pb-20 lg:pt-40 lg:pb-32 overflow-hidden bg-gradient-to-b from-slate-50/50 via-white to-white">
            <!-- Decorative blur backdrops -->
            <div class="absolute top-20 right-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl -z-10 animate-pulse-slow"></div>
            <div class="absolute bottom-10 left-10 w-72 h-72 bg-slate-100 rounded-full blur-2xl -z-10"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                    <!-- Left Copy Column -->
                    <div class="lg:col-span-7 space-y-6 text-center lg:text-left animate-fade-in-up">
                        <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 bg-primary/15 text-charcoal rounded-full border border-primary/30 text-xs font-bold tracking-wide uppercase">
                            <span class="flex h-2 w-2 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-hover opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-hover"></span>
                            </span>
                            <span>Platform Donasi No. 1 Paling Transparan</span>
                        </div>
                        
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-charcoal leading-[1.1]">
                            Hubungkan Kebaikan, <br>
                            <span class="relative inline-block">
                                Hadirkan Harapan
                                <span class="absolute bottom-1 left-0 w-full h-3 bg-primary/30 -z-10 rounded-sm"></span>
                            </span>
                        </h1>
                        
                        <p class="text-lg text-charcoal-lighter max-w-2xl mx-auto lg:mx-0 leading-relaxed font-medium">
                            Pedulia adalah platform terpercaya yang menyalurkan 100% donasi Anda secara transparan. Bantu saudara kita yang membutuhkan bantuan medis, pendidikan, dan tanggap bencana.
                        </p>

                        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-4">
                            <a href="#kampanye" class="w-full sm:w-auto px-8 py-4 bg-primary text-charcoal text-center rounded-full font-extrabold text-base shadow-[0_6px_20px_rgba(159,239,0,0.35)] hover:bg-primary-hover hover:shadow-[0_8px_24px_rgba(159,239,0,0.5)] transition-all duration-300 transform hover:-translate-y-0.5">
                                Mulai Berdonasi
                            </a>
                            <a href="#cara-kerja" class="w-full sm:w-auto px-8 py-4 bg-white text-charcoal text-center rounded-full font-bold text-base border border-slate-200 hover:bg-slate-50 transition-all duration-300">
                                Pelajari Cara Kerja
                            </a>
                        </div>

                        <!-- Trust Metrics in Hero -->
                        <div class="grid grid-cols-3 gap-4 pt-8 border-t border-slate-100 max-w-lg mx-auto lg:mx-0 text-left">
                            <div>
                                <div class="text-2xl sm:text-3xl font-extrabold text-charcoal tracking-tight">Rp <span class="counter" data-target="15">0</span>M+</div>
                                <div class="text-xs font-semibold text-charcoal-lighter uppercase tracking-wider mt-1">Tersalurkan</div>
                            </div>
                            <div>
                                <div class="text-2xl sm:text-3xl font-extrabold text-charcoal tracking-tight"><span class="counter" data-target="240">0</span>rb+</div>
                                <div class="text-xs font-semibold text-charcoal-lighter uppercase tracking-wider mt-1">Orang Baik</div>
                            </div>
                            <div>
                                <div class="text-2xl sm:text-3xl font-extrabold text-charcoal tracking-tight"><span class="counter" data-target="99">0</span>.8%</div>
                                <div class="text-xs font-semibold text-charcoal-lighter uppercase tracking-wider mt-1">Amanah Sukses</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Visual Column -->
                    <div class="lg:col-span-5 relative flex justify-center lg:justify-end animate-fade-in-up delay-200">
                        <div class="relative w-full max-w-[420px] lg:max-w-none aspect-square lg:aspect-auto lg:h-[480px]">
                            <!-- Glow background circle -->
                            <div class="absolute -inset-4 bg-primary/20 rounded-2xl blur-xl opacity-75 -z-10 animate-pulse-slow"></div>
                            
                            <!-- Green framing lines -->
                            <div class="absolute -top-3 -left-3 w-16 h-16 border-t-4 border-l-4 border-primary rounded-tl-lg"></div>
                            <div class="absolute -bottom-3 -right-3 w-16 h-16 border-b-4 border-r-4 border-primary rounded-br-lg"></div>
                            
                            <!-- Hero Image -->
                            <img src="/images/hero.png" alt="Pedulia Donation" class="w-full h-full object-cover rounded-2xl shadow-2xl border border-slate-100 animate-float">
                            
                            <!-- Floating Card -->
                            <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-xl shadow-xl border border-slate-100 max-w-[210px] hidden sm:block animate-float" style="animation-delay: 2s;">
                                <div class="flex items-center space-x-3">
                                    <div class="p-2 bg-primary/20 text-charcoal rounded-lg">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-charcoal-lighter">Donatur Baru</p>
                                        <p class="text-sm font-extrabold text-charcoal">Rp 500.000</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section (Proof of Impact) -->
        <section class="py-12 bg-charcoal text-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-15">
                <!-- Soft grid layout -->
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100">
                    <defs>
                        <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#grid)" />
                </svg>
            </div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 md:gap-4 divide-y md:divide-y-0 md:divide-x divide-slate-800 text-center">
                    <div class="p-4">
                        <div class="text-3xl sm:text-4xl font-extrabold text-primary">12.500+</div>
                        <div class="text-sm font-medium text-slate-400 mt-2">Kampanye Berhasil</div>
                    </div>
                    <div class="p-4 md:pl-6">
                        <div class="text-3xl sm:text-4xl font-extrabold text-primary">Rp 15,2 M</div>
                        <div class="text-sm font-medium text-slate-400 mt-2">Total Donasi Terkumpul</div>
                    </div>
                    <div class="p-4 md:pl-6">
                        <div class="text-3xl sm:text-4xl font-extrabold text-primary">100%</div>
                        <div class="text-sm font-medium text-slate-400 mt-2">Laporan Audit Transparan</div>
                    </div>
                    <div class="p-4 md:pl-6">
                        <div class="text-3xl sm:text-4xl font-extrabold text-primary">5 Menit</div>
                        <div class="text-sm font-medium text-slate-400 mt-2">Rata-rata Pencairan Dana</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Campaigns Section -->
        <section id="kampanye" class="py-24 bg-slate-50/40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-16 reveal">
                    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-charcoal">
                        Pilih Kampanye Kebaikan
                    </h2>
                    <p class="mt-4 text-lg text-charcoal-lighter font-medium">
                        Donasi Anda disalurkan secara langsung ke penerima manfaat. Tinjau perkembangan kampanye secara real-time.
                    </p>
                    
                    <!-- Search and Filters -->
                    <div class="mt-8 flex flex-wrap justify-center gap-2">
                        <button onclick="filterCampaigns('semua')" class="filter-btn active px-5 py-2.5 rounded-full text-sm font-bold border transition-all duration-300">
                            Semua
                        </button>
                        <button onclick="filterCampaigns('kesehatan')" class="filter-btn px-5 py-2.5 rounded-full text-sm font-bold border transition-all duration-300">
                            Medis & Kesehatan
                        </button>
                        <button onclick="filterCampaigns('bencana')" class="filter-btn px-5 py-2.5 rounded-full text-sm font-bold border transition-all duration-300">
                            Bencana Alam
                        </button>
                        <button onclick="filterCampaigns('pendidikan')" class="filter-btn px-5 py-2.5 rounded-full text-sm font-bold border transition-all duration-300">
                            Pendidikan
                        </button>
                    </div>
                </div>

                <!-- Campaigns Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($campaigns as $campaign)
                    <article class="campaign-card reveal bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group" data-category="{{ $campaign->category }}">
                        <div class="relative aspect-video w-full overflow-hidden">
                            <img src="{{ $campaign->thumbnail }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <span class="absolute top-4 left-4 bg-white/95 text-charcoal text-xs font-bold px-3 py-1 rounded-full shadow-sm capitalize">
                                {{ $campaign->category === 'kesehatan' ? 'Kesehatan' : ($campaign->category === 'bencana' ? 'Bencana Alam' : 'Pendidikan') }}
                            </span>
                        </div>
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div class="space-y-3">
                                <h3 class="text-lg font-bold text-charcoal leading-snug hover:text-primary-dark transition-colors line-clamp-2">
                                    <a href="/campaigns/{{ $campaign->slug }}">{{ $campaign->title }}</a>
                                </h3>
                                <p class="text-xs font-semibold text-charcoal-lighter">Pedulia Foundation</p>
                                <p class="text-sm text-charcoal-lighter line-clamp-2">{!! strip_tags($campaign->description) !!}</p>
                            </div>
                            
                            <div class="mt-6 space-y-4">
                                <!-- Progress Bar -->
                                <div class="space-y-1.5">
                                    <div class="flex items-center justify-between text-xs font-bold text-charcoal">
                                        <span>Terkumpul: <span class="text-slate-900 font-extrabold">Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</span></span>
                                        <span class="text-primary-dark bg-primary/20 px-2 py-0.5 rounded-md">{{ $campaign->percentage }}%</span>
                                    </div>
                                    <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-primary rounded-full animate-pulse-slow" style="width: {{ $campaign->percentage }}%;"></div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between text-xs font-semibold text-charcoal-lighter pt-1 border-t border-slate-100">
                                    <span>Target: <span class="font-bold text-charcoal">Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</span></span>
                                    <span class="flex items-center gap-1">
                                        <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        {{ $campaign->days_remaining }} Hari Lagi
                                    </span>
                                </div>

                                <a href="/campaigns/{{ $campaign->slug }}" class="block w-full py-3 bg-primary/10 hover:bg-primary text-charcoal text-center rounded-xl text-sm font-extrabold transition-all duration-300">
                                    Donasi Sekarang
                                </a>
                            </div>
                        </div>
                    </article>
                    @empty
                    <div class="col-span-3 text-center py-12 text-slate-400 font-semibold text-sm">
                        Belum ada kampanye aktif saat ini.
                    </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- How it Works (Cara Kerja) Section -->
        <section id="cara-kerja" class="py-24 bg-white relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-20 reveal">
                    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-charcoal">
                        Cara Mudah Berdonasi di Pedulia
                    </h2>
                    <p class="mt-4 text-lg text-charcoal-lighter font-medium">
                        Hanya butuh tiga langkah mudah untuk menyalurkan berkat dan membantu mereka yang membutuhkan.
                    </p>
                </div>

                <!-- Steps Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative">
                    <!-- Line connecting steps (hidden on mobile) -->
                    <div class="hidden md:block absolute top-1/2 left-0 right-0 h-0.5 bg-slate-100 -translate-y-8 -z-10"></div>
                    
                    <!-- Step 1 -->
                    <div class="text-center space-y-4 reveal flex flex-col items-center">
                        <div class="h-16 w-16 rounded-2xl bg-primary text-charcoal flex items-center justify-center text-2xl font-extrabold shadow-[0_6px_20px_rgba(159,239,0,0.3)] hover:scale-105 transition-transform duration-300">
                            1
                        </div>
                        <h3 class="text-xl font-bold text-charcoal pt-2">Pilih Kampanye</h3>
                        <p class="text-sm text-charcoal-lighter leading-relaxed max-w-xs font-medium">
                            Jelajahi berbagai pilihan kampanye donasi medis, pendidikan, bencana alam, dan kemanusiaan yang terverifikasi.
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div class="text-center space-y-4 reveal flex flex-col items-center" style="animation-delay: 100ms;">
                        <div class="h-16 w-16 rounded-2xl bg-charcoal text-primary flex items-center justify-center text-2xl font-extrabold shadow-lg hover:scale-105 transition-transform duration-300">
                            2
                        </div>
                        <h3 class="text-xl font-bold text-charcoal pt-2">Isi Nominal & Bayar</h3>
                        <p class="text-sm text-charcoal-lighter leading-relaxed max-w-xs font-medium">
                            Tentukan nominal donasi yang ingin disalurkan dan lakukan pembayaran instan via Transfer Bank, QRIS, GOPAY, OVO, atau LinkAja.
                        </p>
                    </div>

                    <!-- Step 3 -->
                    <div class="text-center space-y-4 reveal flex flex-col items-center" style="animation-delay: 200ms;">
                        <div class="h-16 w-16 rounded-2xl bg-primary text-charcoal flex items-center justify-center text-2xl font-extrabold shadow-[0_6px_20px_rgba(159,239,0,0.3)] hover:scale-105 transition-transform duration-300">
                            3
                        </div>
                        <h3 class="text-xl font-bold text-charcoal pt-2">Dapatkan Laporan</h3>
                        <p class="text-sm text-charcoal-lighter leading-relaxed max-w-xs font-medium">
                            Kami mengirimkan laporan penyaluran donasi terperinci secara berkala langsung ke alamat email dan WhatsApp Anda.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Us (Mengapa Memilih Kami) Section -->
        <section id="keunggulan" class="py-24 bg-slate-50/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    
                    <!-- Left side: Illustration or feature grid -->
                    <div class="space-y-6 reveal">
                        <div class="inline-flex items-center space-x-2 px-3 py-1 bg-slate-100 text-charcoal rounded-full text-xs font-bold uppercase tracking-wider">
                            <span>Mengapa Memilih Kami</span>
                        </div>
                        <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-charcoal leading-tight">
                            Platform Donasi Modern yang Mengutamakan Transparansi
                        </h2>
                        <p class="text-lg text-charcoal-lighter font-medium">
                            Kami memastikan setiap rupiah yang Anda donasikan memberikan dampak nyata yang terdokumentasi dan terukur.
                        </p>

                        <!-- Advantage list -->
                        <div class="space-y-4 pt-4">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 p-1.5 bg-primary/20 text-charcoal rounded-lg mt-1">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                                <div>
                                    <h4 class="text-base font-bold text-charcoal">0% Biaya Potongan Admin Kategori Tertentu</h4>
                                    <p class="text-sm text-charcoal-lighter mt-0.5">Seluruh kampanye bencana alam dan medis darurat disalurkan 100% tanpa potongan apa pun.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 p-1.5 bg-primary/20 text-charcoal rounded-lg mt-1">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                                <div>
                                    <h4 class="text-base font-bold text-charcoal">Sistem Pelaporan Real-Time</h4>
                                    <p class="text-sm text-charcoal-lighter mt-0.5">Donatur dapat melacak riwayat pengeluaran dana kampanye secara instan melalui dasbor transparansi kami.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 p-1.5 bg-primary/20 text-charcoal rounded-lg mt-1">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                                <div>
                                    <h4 class="text-base font-bold text-charcoal">Pembayaran Terintegrasi & Cepat</h4>
                                    <p class="text-sm text-charcoal-lighter mt-0.5">Selesaikan transaksi donasi Anda dalam hitungan detik menggunakan berbagai pilihan e-wallet dan virtual account.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right side: Visual banner card with stats and glowing accents -->
                    <div class="relative flex justify-center lg:justify-end reveal" style="animation-delay: 200ms;">
                        <div class="w-full max-w-md bg-charcoal rounded-3xl p-8 text-white relative overflow-hidden shadow-2xl">
                            <!-- Background green glow -->
                            <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>
                            
                            <h3 class="text-2xl font-extrabold tracking-tight mb-6">Metrik Penyaluran Transparansi</h3>
                            
                            <div class="space-y-6">
                                <div>
                                    <div class="flex justify-between text-sm font-semibold text-slate-300 mb-2">
                                        <span>Medis & Pemulihan</span>
                                        <span class="text-primary font-bold">42%</span>
                                    </div>
                                    <div class="w-full h-2 bg-slate-800 rounded-full overflow-hidden">
                                        <div class="h-full bg-primary rounded-full" style="width: 42%;"></div>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex justify-between text-sm font-semibold text-slate-300 mb-2">
                                        <span>Bantuan Bencana</span>
                                        <span class="text-primary font-bold">35%</span>
                                    </div>
                                    <div class="w-full h-2 bg-slate-800 rounded-full overflow-hidden">
                                        <div class="h-full bg-primary rounded-full" style="width: 35%;"></div>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex justify-between text-sm font-semibold text-slate-300 mb-2">
                                        <span>Pendidikan & Beasiswa</span>
                                        <span class="text-primary font-bold">18%</span>
                                    </div>
                                    <div class="w-full h-2 bg-slate-800 rounded-full overflow-hidden">
                                        <div class="h-full bg-primary rounded-full" style="width: 18%;"></div>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex justify-between text-sm font-semibold text-slate-300 mb-2">
                                        <span>Pembangunan & Fasilitas</span>
                                        <span class="text-primary font-bold">5%</span>
                                    </div>
                                    <div class="w-full h-2 bg-slate-800 rounded-full overflow-hidden">
                                        <div class="h-full bg-primary rounded-full" style="width: 5%;"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 pt-6 border-t border-slate-800 flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="h-3 w-3 bg-primary rounded-full shadow-[0_0_8px_#9FEF00]"></div>
                                    <p class="text-xs font-semibold text-slate-400">Diaudit Berkala oleh KAP Independen</p>
                                </div>
                                <span class="text-xs bg-slate-800 text-slate-300 font-bold px-2.5 py-1 rounded">2026</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Testimonial Section -->
        <section id="testimoni" class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-20 reveal">
                    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-charcoal">
                        Cerita Dampak & Kebaikan Mereka
                    </h2>
                    <p class="mt-4 text-lg text-charcoal-lighter font-medium">
                        Dengar langsung cerita dari penerima manfaat dan donatur yang telah bergerak bersama Pedulia.
                    </p>
                </div>

                <!-- Testimonials Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Card 1 -->
                    <div class="reveal p-8 rounded-2xl border border-slate-100 shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                        <div class="space-y-4">
                            <!-- Rating -->
                            <div class="flex text-primary">
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                            </div>
                            <p class="text-sm text-charcoal-lighter italic leading-relaxed">
                                "Sangat terbantu dengan transparansi di Pedulia. Laporan penyaluran detail dikirim berkala lengkap dengan kuitansi dan dokumentasi foto medis anak kami."
                            </p>
                        </div>
                        <div class="mt-6 flex items-center space-x-3.5 pt-4 border-t border-slate-100">
                            <div class="h-10 w-10 rounded-full bg-slate-100 overflow-hidden">
                                <span class="h-full w-full flex items-center justify-center font-bold bg-primary/25 text-charcoal text-xs">BP</span>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-charcoal">Bapak Puji</h4>
                                <p class="text-xs font-semibold text-charcoal-lighter">Orangtua Penerima Manfaat</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="reveal p-8 rounded-2xl border border-slate-100 shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col justify-between" style="animation-delay: 100ms;">
                        <div class="space-y-4">
                            <!-- Rating -->
                            <div class="flex text-primary">
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                            </div>
                            <p class="text-sm text-charcoal-lighter italic leading-relaxed">
                                "Sistem donasi autodebet bulanannya sangat praktis. Saya bisa menyisihkan uang jajan setiap bulan untuk donasi pendidikan adik-adik di pelosok secara rutin."
                            </p>
                        </div>
                        <div class="mt-6 flex items-center space-x-3.5 pt-4 border-t border-slate-100">
                            <div class="h-10 w-10 rounded-full bg-slate-100 overflow-hidden">
                                <span class="h-full w-full flex items-center justify-center font-bold bg-primary/25 text-charcoal text-xs">AS</span>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-charcoal">Amelia Safitri</h4>
                                <p class="text-xs font-semibold text-charcoal-lighter">Donatur Rutin (Karyawan Swasta)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="reveal p-8 rounded-2xl border border-slate-100 shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col justify-between" style="animation-delay: 200ms;">
                        <div class="space-y-4">
                            <!-- Rating -->
                            <div class="flex text-primary">
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                            </div>
                            <p class="text-sm text-charcoal-lighter italic leading-relaxed">
                                "Sinergi yang luar biasa. Sebagai yayasan lokal, kampanye kami cepat terverifikasi dan dibantu publikasi yang luas oleh tim Pedulia hingga target dana tercapai."
                            </p>
                        </div>
                        <div class="mt-6 flex items-center space-x-3.5 pt-4 border-t border-slate-100">
                            <div class="h-10 w-10 rounded-full bg-slate-100 overflow-hidden">
                                <span class="h-full w-full flex items-center justify-center font-bold bg-primary/25 text-charcoal text-xs">HK</span>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-charcoal">Hendra Kurnia</h4>
                                <p class="text-xs font-semibold text-charcoal-lighter">Founder Komunitas Literasi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA / Campaign Banner Section -->
        <section class="py-20 bg-charcoal text-white relative overflow-hidden">
            <!-- Background effects -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-primary/10 rounded-full blur-3xl -z-10 animate-pulse-slow"></div>
            
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8 relative z-10 reveal">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight">
                    Mulai Langkah Kebaikan Pertama Anda Hari Ini
                </h2>
                <p class="text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed font-medium">
                    Setiap bantuan kecil dari Anda sangat berharga bagi masa depan dan kesembuhan mereka. Salurkan bantuan sekarang juga.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
                    <a href="#kampanye" class="w-full sm:w-auto px-8 py-4 bg-primary text-charcoal rounded-full font-extrabold text-base shadow-[0_6px_20px_rgba(159,239,0,0.35)] hover:bg-primary-hover hover:shadow-[0_8px_24px_rgba(159,239,0,0.5)] transition-all duration-300 transform hover:-translate-y-0.5">
                        Donasi Sekarang
                    </a>
                    <a href="#" class="w-full sm:w-auto px-8 py-4 bg-slate-800 text-white rounded-full font-bold text-base hover:bg-slate-700 transition-all duration-300">
                        Galang Dana Bersama Kami
                    </a>
                </div>
            </div>
        </section>

@endsection

@push('scripts')
        <!-- Inline JavaScript for Interactivity -->
        <script>
            // Stats Count-Up Animation
            const counters = document.querySelectorAll('.counter');
            const counterObserverOptions = {
                threshold: 0.5,
                rootMargin: "0px 0px -50px 0px"
            };

            const animateCounter = (counter) => {
                const target = +counter.getAttribute('data-target');
                let count = 0;
                const speed = target / 50; // Speed speed factor based on target size

                const updateCount = () => {
                    count += speed;
                    if (count < target) {
                        counter.innerText = Math.ceil(count);
                        setTimeout(updateCount, 20);
                    } else {
                        counter.innerText = target;
                    }
                };
                updateCount();
            };

            const counterObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        observer.unobserve(entry.target); // Run animation once
                    }
                });
            }, counterObserverOptions);

            counters.forEach(counter => counterObserver.observe(counter));

            // Campaign Category Filtering Tabs
            function filterCampaigns(category) {
                // Remove active styling from all filter buttons
                const buttons = document.querySelectorAll('.filter-btn');
                buttons.forEach(btn => btn.classList.remove('active', 'bg-primary', 'text-charcoal', 'border-primary'));
                
                // Find currently clicked button or default active button
                event.currentTarget.classList.add('active', 'bg-primary', 'text-charcoal', 'border-primary');

                // Get all cards and filter
                const cards = document.querySelectorAll('.campaign-card');
                cards.forEach(card => {
                    const cardCategory = card.getAttribute('data-category');
                    if (category === 'semua' || cardCategory === category) {
                        card.style.display = 'flex';
                        // Add fade-in animation trigger
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, 50);
                    } else {
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(10px)';
                        // Wait for transition before hiding display
                        setTimeout(() => {
                            card.style.display = 'none';
                        }, 300);
                    }
                });
            }

            // Scroll Reveal Animation (Intersection Observer)
            const revealElements = document.querySelectorAll('.reveal');
            const revealObserverOptions = {
                threshold: 0.1,
                rootMargin: "0px 0px -60px 0px"
            };

            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        // Optional: unobserve if we only want animations to trigger once on scroll down
                        observer.unobserve(entry.target);
                    }
                });
            }, revealObserverOptions);

            revealElements.forEach(element => revealObserver.observe(element));
            
            // Set initial inline styles for filter buttons
            document.addEventListener("DOMContentLoaded", function() {
                const activeBtn = document.querySelector('.filter-btn.active');
                if (activeBtn) {
                    activeBtn.classList.add('bg-primary', 'text-charcoal', 'border-primary');
                }
            });
        </script>

        <!-- Inline Styling helper for filter buttons -->
        <style>
            .filter-btn {
                background-color: transparent;
                border-color: #E2E8F0;
                color: #64748B;
            }
            .filter-btn:hover {
                background-color: #F8FAFC;
                color: #0B0F19;
                border-color: #CBD5E1;
            }
            .filter-btn.active {
                box-shadow: 0 4px 12px rgba(159,239,0,0.2);
            }
        </style>
@endpush
