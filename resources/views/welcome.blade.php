<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bisa Kita - Hubungkan Kebaikan, Bantu Sesama</title>
        
        <!-- Google Fonts: Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-white text-charcoal font-sans antialiased overflow-x-hidden">

        <!-- Header / Navigation -->
        <header id="navbar" class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-100 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-20">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="#" class="flex items-center space-x-2">
                            <span class="text-2xl font-extrabold tracking-tight text-charcoal flex items-center">
                                Bisa<span class="text-charcoal-light font-medium">Kita</span>
                                <span class="h-2.5 w-2.5 rounded-full bg-primary ml-1 shadow-[0_0_8px_rgba(159,239,0,0.8)]"></span>
                            </span>
                        </a>
                    </div>

                    <!-- Desktop Navigation Links -->
                    <nav class="hidden md:flex space-x-8 text-sm font-semibold text-charcoal-light">
                        <a href="#kampanye" class="hover:text-charcoal transition-colors py-2">Kampanye</a>
                        <a href="#cara-kerja" class="hover:text-charcoal transition-colors py-2">Cara Kerja</a>
                        <a href="#keunggulan" class="hover:text-charcoal transition-colors py-2">Mengapa Kami</a>
                        <a href="#testimoni" class="hover:text-charcoal transition-colors py-2">Testimoni</a>
                    </nav>

                    <!-- Desktop Actions -->
                    <div class="hidden md:flex items-center space-x-4">
                        <a href="#" class="text-sm font-semibold text-charcoal hover:text-charcoal-light transition-colors">Masuk</a>
                        <a href="#kampanye" class="px-5 py-2.5 text-sm font-bold bg-primary text-charcoal rounded-full border border-primary hover:bg-primary-hover hover:border-primary-hover transition-all duration-300 shadow-[0_4px_14px_rgba(159,239,0,0.3)] hover:shadow-[0_6px_20px_rgba(159,239,0,0.55)]">
                            Donasi Sekarang
                        </a>
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="md:hidden flex items-center">
                        <button id="mobile-menu-button" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-charcoal hover:bg-slate-50 focus:outline-none transition-colors" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Buka menu utama</span>
                            <svg class="h-6 w-6 block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" id="hamburger-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg class="h-6 w-6 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" id="close-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation Drawer -->
            <div id="mobile-menu" class="hidden md:hidden bg-white border-b border-slate-100 transition-all duration-300">
                <div class="px-4 pt-2 pb-6 space-y-3 sm:px-6">
                    <a href="#kampanye" class="block px-3 py-2.5 rounded-md text-base font-semibold text-charcoal-light hover:bg-slate-50 hover:text-charcoal transition-colors">Kampanye</a>
                    <a href="#cara-kerja" class="block px-3 py-2.5 rounded-md text-base font-semibold text-charcoal-light hover:bg-slate-50 hover:text-charcoal transition-colors">Cara Kerja</a>
                    <a href="#keunggulan" class="block px-3 py-2.5 rounded-md text-base font-semibold text-charcoal-light hover:bg-slate-50 hover:text-charcoal transition-colors">Mengapa Kami</a>
                    <a href="#testimoni" class="block px-3 py-2.5 rounded-md text-base font-semibold text-charcoal-light hover:bg-slate-50 hover:text-charcoal transition-colors">Testimoni</a>
                    <hr class="border-slate-100 my-2">
                    <div class="flex flex-col space-y-3 pt-2">
                        <a href="#" class="w-full text-center py-2.5 rounded-md text-base font-semibold text-charcoal hover:bg-slate-50 transition-colors">Masuk</a>
                        <a href="#kampanye" class="w-full text-center py-3 bg-primary text-charcoal rounded-full font-bold text-base shadow-[0_4px_12px_rgba(159,239,0,0.35)] transition-all">
                            Donasi Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </header>

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
                            Bisa Kita adalah platform terpercaya yang menyalurkan 100% donasi Anda secara transparan. Bantu saudara kita yang membutuhkan bantuan medis, pendidikan, dan tanggap bencana.
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
                            <img src="/images/hero.png" alt="Bisa Kita Donation" class="w-full h-full object-cover rounded-2xl shadow-2xl border border-slate-100 animate-float">
                            
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
                    <!-- Campaign 1: Kesehatan -->
                    <article class="campaign-card reveal bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group" data-category="kesehatan">
                        <div class="relative aspect-video w-full overflow-hidden">
                            <img src="/images/campaign_medical.png" alt="Peduli Gizi Buruk" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <span class="absolute top-4 left-4 bg-white/95 text-charcoal text-xs font-bold px-3 py-1 rounded-full shadow-sm">Kesehatan</span>
                        </div>
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div class="space-y-3">
                                <h3 class="text-lg font-bold text-charcoal leading-snug hover:text-primary-dark transition-colors">
                                    <a href="#">Bantu Balita Gizi Buruk di Desa Pelosok Pulih Kembali</a>
                                </h3>
                                <p class="text-xs font-semibold text-charcoal-lighter">Yayasan Peduli Anak Indonesia</p>
                                <p class="text-sm text-charcoal-lighter line-clamp-2">Puluhan balita di pelosok NTT mengalami gizi buruk. Mari bantu pemenuhan nutrisi dan vitamin mereka.</p>
                            </div>
                            
                            <div class="mt-6 space-y-4">
                                <!-- Progress Bar -->
                                <div class="space-y-1.5">
                                    <div class="flex items-center justify-between text-xs font-bold text-charcoal">
                                        <span>Terkumpul: <span class="text-slate-900 font-extrabold">Rp 32.500.000</span></span>
                                        <span class="text-primary-dark bg-primary/20 px-2 py-0.5 rounded-md">65%</span>
                                    </div>
                                    <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-primary rounded-full animate-pulse-slow" style="width: 65%;"></div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between text-xs font-semibold text-charcoal-lighter pt-1 border-t border-slate-100">
                                    <span>Target: <span class="font-bold text-charcoal">Rp 50.000.000</span></span>
                                    <span class="flex items-center gap-1">
                                        <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        12 Hari Lagi
                                    </span>
                                </div>

                                <a href="#" class="block w-full py-3 bg-primary/10 hover:bg-primary text-charcoal text-center rounded-xl text-sm font-extrabold transition-all duration-300">
                                    Donasi Sekarang
                                </a>
                            </div>
                        </div>
                    </article>

                    <!-- Campaign 2: Bencana -->
                    <article class="campaign-card reveal bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group" data-category="bencana" style="animation-delay: 100ms;">
                        <div class="relative aspect-video w-full overflow-hidden">
                            <img src="/images/campaign_disaster.png" alt="Tanggap Bencana Banjir" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <span class="absolute top-4 left-4 bg-white/95 text-charcoal text-xs font-bold px-3 py-1 rounded-full shadow-sm">Bencana Alam</span>
                        </div>
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div class="space-y-3">
                                <h3 class="text-lg font-bold text-charcoal leading-snug hover:text-primary-dark transition-colors">
                                    <a href="#">Tanggap Darurat Banjir Bandang: Salurkan Makanan & Pakaian</a>
                                </h3>
                                <p class="text-xs font-semibold text-charcoal-lighter">Relawan Kemanusiaan Bersama</p>
                                <p class="text-sm text-charcoal-lighter line-clamp-2">Banjir bandang merendam ratusan rumah warga. Kebutuhan mendesak: obat-obatan, selimut, dan makanan siap saji.</p>
                            </div>
                            
                            <div class="mt-6 space-y-4">
                                <!-- Progress Bar -->
                                <div class="space-y-1.5">
                                    <div class="flex items-center justify-between text-xs font-bold text-charcoal">
                                        <span>Terkumpul: <span class="text-slate-900 font-extrabold">Rp 88.200.000</span></span>
                                        <span class="text-primary-dark bg-primary/20 px-2 py-0.5 rounded-md">88%</span>
                                    </div>
                                    <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-primary rounded-full animate-pulse-slow" style="width: 88%;"></div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between text-xs font-semibold text-charcoal-lighter pt-1 border-t border-slate-100">
                                    <span>Target: <span class="font-bold text-charcoal">Rp 100.000.000</span></span>
                                    <span class="flex items-center gap-1">
                                        <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        3 Hari Lagi
                                    </span>
                                </div>

                                <a href="#" class="block w-full py-3 bg-primary/10 hover:bg-primary text-charcoal text-center rounded-xl text-sm font-extrabold transition-all duration-300">
                                    Donasi Sekarang
                                </a>
                            </div>
                        </div>
                    </article>

                    <!-- Campaign 3: Pendidikan -->
                    <article class="campaign-card reveal bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group" data-category="pendidikan" style="animation-delay: 200ms;">
                        <div class="relative aspect-video w-full overflow-hidden">
                            <img src="/images/campaign_education.png" alt="Buku Anak Pelosok" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <span class="absolute top-4 left-4 bg-white/95 text-charcoal text-xs font-bold px-3 py-1 rounded-full shadow-sm">Pendidikan</span>
                        </div>
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div class="space-y-3">
                                <h3 class="text-lg font-bold text-charcoal leading-snug hover:text-primary-dark transition-colors">
                                    <a href="#">Penyediaan Paket Buku dan Alat Tulis untuk Anak Pelosok</a>
                                </h3>
                                <p class="text-xs font-semibold text-charcoal-lighter">Gerakan Literasi Bangsa</p>
                                <p class="text-sm text-charcoal-lighter line-clamp-2">Mari bantu anak-anak di pulau terluar mendapatkan akses buku bacaan dan buku pelajaran yang layak.</p>
                            </div>
                            
                            <div class="mt-6 space-y-4">
                                <!-- Progress Bar -->
                                <div class="space-y-1.5">
                                    <div class="flex items-center justify-between text-xs font-bold text-charcoal">
                                        <span>Terkumpul: <span class="text-slate-900 font-extrabold">Rp 11.250.000</span></span>
                                        <span class="text-primary-dark bg-primary/20 px-2 py-0.5 rounded-md">45%</span>
                                    </div>
                                    <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-primary rounded-full animate-pulse-slow" style="width: 45%;"></div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between text-xs font-semibold text-charcoal-lighter pt-1 border-t border-slate-100">
                                    <span>Target: <span class="font-bold text-charcoal">Rp 25.000.000</span></span>
                                    <span class="flex items-center gap-1">
                                        <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        25 Hari Lagi
                                    </span>
                                </div>

                                <a href="#" class="block w-full py-3 bg-primary/10 hover:bg-primary text-charcoal text-center rounded-xl text-sm font-extrabold transition-all duration-300">
                                    Donasi Sekarang
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <!-- How it Works (Cara Kerja) Section -->
        <section id="cara-kerja" class="py-24 bg-white relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-20 reveal">
                    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-charcoal">
                        Cara Mudah Berdonasi di Bisa Kita
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
                        Dengar langsung cerita dari penerima manfaat dan donatur yang telah bergerak bersama Bisa Kita.
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
                                "Sangat terbantu dengan transparansi di Bisa Kita. Laporan penyaluran detail dikirim berkala lengkap dengan kuitansi dan dokumentasi foto medis anak kami."
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
                                "Sinergi yang luar biasa. Sebagai yayasan lokal, kampanye kami cepat terverifikasi dan dibantu publikasi yang luas oleh tim Bisa Kita hingga target dana tercapai."
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

        <!-- Footer -->
        <footer class="bg-slate-50 border-t border-slate-100 pt-16 pb-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-8 md:gap-12 pb-12 border-b border-slate-200">
                    <!-- Column 1: Brand -->
                    <div class="md:col-span-4 space-y-4">
                        <span class="text-2xl font-extrabold tracking-tight text-charcoal flex items-center">
                            Bisa<span class="text-charcoal-light font-medium">Kita</span>
                            <span class="h-2.5 w-2.5 rounded-full bg-primary ml-1 shadow-[0_0_8px_rgba(159,239,0,0.8)]"></span>
                        </span>
                        <p class="text-sm text-charcoal-lighter leading-relaxed font-medium">
                            Platform penggalangan dana dan donasi online berizin resmi, amanah, transparan, dan terpercaya di Indonesia.
                        </p>
                        <p class="text-xs text-charcoal-lighter">
                            Izin Kemenkes RI No: PSDBS-102/2026<br>
                            Izin Kemsos RI No: 342/LAL/2026
                        </p>
                    </div>

                    <!-- Column 2: Links -->
                    <div class="md:col-span-3 space-y-3">
                        <h4 class="text-sm font-bold text-charcoal uppercase tracking-wider">Navigasi</h4>
                        <ul class="space-y-2 text-sm text-charcoal-lighter font-medium">
                            <li><a href="#kampanye" class="hover:text-charcoal transition-colors">Kampanye Pilihan</a></li>
                            <li><a href="#cara-kerja" class="hover:text-charcoal transition-colors">Cara Kerja Donasi</a></li>
                            <li><a href="#keunggulan" class="hover:text-charcoal transition-colors">Keunggulan Platform</a></li>
                            <li><a href="#testimoni" class="hover:text-charcoal transition-colors">Testimoni Sukses</a></li>
                        </ul>
                    </div>

                    <!-- Column 3: Contact -->
                    <div class="md:col-span-3 space-y-3">
                        <h4 class="text-sm font-bold text-charcoal uppercase tracking-wider">Kontak & Bantuan</h4>
                        <ul class="space-y-2 text-sm text-charcoal-lighter font-medium">
                            <li class="flex items-center gap-2">
                                <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                support@bisakita.com
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                (021) 8293-1029
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                Menteng, Jakarta Pusat, Indonesia
                            </li>
                        </ul>
                    </div>

                    <!-- Column 4: Newsletter -->
                    <div class="md:col-span-2 space-y-3">
                        <h4 class="text-sm font-bold text-charcoal uppercase tracking-wider">Ikuti Kami</h4>
                        <div class="flex space-x-3.5 pt-1">
                            <a href="#" class="p-2 bg-slate-200 hover:bg-primary text-charcoal rounded-full transition-colors">
                                <svg class="h-4.5 w-4.5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                            <a href="#" class="p-2 bg-slate-200 hover:bg-primary text-charcoal rounded-full transition-colors">
                                <svg class="h-4.5 w-4.5 fill-current" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </a>
                            <a href="#" class="p-2 bg-slate-200 hover:bg-primary text-charcoal rounded-full transition-colors">
                                <svg class="h-4.5 w-4.5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-charcoal-lighter font-medium">
                    <p>&copy; 2026 Bisa Kita. Hak Cipta Dilindungi.</p>
                    <div class="flex space-x-6 mt-4 sm:mt-0">
                        <a href="#" class="hover:text-charcoal transition-colors">Ketentuan Layanan</a>
                        <a href="#" class="hover:text-charcoal transition-colors">Kebijakan Privasi</a>
                        <a href="#" class="hover:text-charcoal transition-colors">Syarat & Ketentuan</a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Inline JavaScript for Interactivity -->
        <script>
            // Sticky Navbar & Shadow Effects
            window.addEventListener('scroll', function() {
                const navbar = document.getElementById('navbar');
                if (window.scrollY > 20) {
                    navbar.classList.add('shadow-md', 'py-1');
                    navbar.classList.remove('py-0');
                } else {
                    navbar.classList.remove('shadow-md', 'py-1');
                }
            });

            // Mobile Menu Open/Close Drawer Toggle
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const hamburgerIcon = document.getElementById('hamburger-icon');
            const closeIcon = document.getElementById('close-icon');

            mobileMenuButton.addEventListener('click', function() {
                const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
                mobileMenuButton.setAttribute('aria-expanded', !isExpanded);
                mobileMenu.classList.toggle('hidden');
                
                // Toggle hamburger and close SVG icons
                hamburgerIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            });

            // Auto-close mobile drawer when a link is clicked
            const mobileMenuLinks = mobileMenu.querySelectorAll('a');
            mobileMenuLinks.forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                    hamburgerIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                    mobileMenuButton.setAttribute('aria-expanded', 'false');
                });
            });

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
    </body>
</html>
