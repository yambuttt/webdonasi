<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'Pedulia - Hubungkan Kebaikan, Bantu Sesama')</title>
        
        <!-- Google Fonts: Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
    </head>
    <body class="bg-white text-charcoal font-sans antialiased overflow-x-hidden">

        <!-- Header / Navigation -->
        <header id="navbar" class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-100 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-20">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="/" class="flex items-center space-x-2.5 group">
                            <div class="relative flex items-center justify-center h-10 w-10 rounded-xl bg-slate-950 shadow-inner group-hover:scale-105 transition-transform duration-300">
                                <svg class="h-5.5 w-5.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="url(#logo-grad)"/>
                                    <defs>
                                        <linearGradient id="logo-grad" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" stop-color="#9FEF00" />
                                            <stop offset="100%" stop-color="#10B981" />
                                        </linearGradient>
                                    </defs>
                                </svg>
                                <span class="absolute -top-0.5 -right-0.5 h-2 w-2 rounded-full bg-primary animate-ping"></span>
                                <span class="absolute -top-0.5 -right-0.5 h-2 w-2 rounded-full bg-primary"></span>
                            </div>
                            <span class="text-2xl font-extrabold tracking-tight text-charcoal">
                                Peduli<span class="text-primary-hover">a</span>
                            </span>
                        </a>
                    </div>

                    <!-- Desktop Navigation Links -->
                    <nav class="hidden md:flex space-x-8 text-sm font-semibold text-charcoal-light">
                        <a href="{{ route('campaigns.index') }}" class="hover:text-charcoal transition-colors py-2 {{ request()->routeIs('campaigns.*') ? 'text-charcoal font-bold border-b-2 border-primary' : '' }}">Kampanye</a>
                        <a href="{{ route('articles.index') }}" class="hover:text-charcoal transition-colors py-2 {{ request()->routeIs('articles.*') ? 'text-charcoal font-bold border-b-2 border-primary' : '' }}">Artikel</a>
                        <a href="{{ request()->is('/') ? '#cara-kerja' : '/#cara-kerja' }}" class="hover:text-charcoal transition-colors py-2">Cara Kerja</a>
                        <a href="{{ request()->is('/') ? '#keunggulan' : '/#keunggulan' }}" class="hover:text-charcoal transition-colors py-2">Mengapa Kami</a>
                        <a href="{{ request()->is('/') ? '#testimoni' : '/#testimoni' }}" class="hover:text-charcoal transition-colors py-2">Testimoni</a>
                    </nav>
 
                    <!-- Desktop Actions -->
                    <div class="hidden md:flex items-center space-x-4">
                        @auth
                            @if(auth()->user()->isAdmin())
                                <a href="/admin/dashboard" class="px-5 py-2.5 bg-slate-950 text-white font-bold rounded-full text-xs hover:bg-slate-800 transition-all shadow-sm">Dasbor Admin</a>
                            @endif
                            <form action="/logout" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-sm font-semibold text-charcoal hover:text-red-500 transition-colors cursor-pointer bg-transparent border-0">Keluar</button>
                            </form>
                        @else
                            <a href="/login" class="text-sm font-semibold text-charcoal hover:text-charcoal-light transition-colors">Masuk</a>
                            <a href="{{ route('campaigns.index') }}" class="px-5 py-2.5 text-sm font-bold bg-primary text-charcoal rounded-full border border-primary hover:bg-primary-hover hover:border-primary-hover transition-all duration-300 shadow-[0_4px_14px_rgba(159,239,0,0.3)] hover:shadow-[0_6px_20px_rgba(159,239,0,0.55)]">
                                Donasi Sekarang
                            </a>
                        @endauth
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
                    <a href="{{ route('campaigns.index') }}" class="block px-3 py-2.5 rounded-md text-base font-semibold text-charcoal-light hover:bg-slate-50 hover:text-charcoal transition-colors {{ request()->routeIs('campaigns.*') ? 'text-charcoal font-bold' : '' }}">Kampanye</a>
                    <a href="{{ route('articles.index') }}" class="block px-3 py-2.5 rounded-md text-base font-semibold text-charcoal-light hover:bg-slate-50 hover:text-charcoal transition-colors">Artikel</a>
                    <a href="{{ request()->is('/') ? '#cara-kerja' : '/#cara-kerja' }}" class="block px-3 py-2.5 rounded-md text-base font-semibold text-charcoal-light hover:bg-slate-50 hover:text-charcoal transition-colors">Cara Kerja</a>
                    <a href="{{ request()->is('/') ? '#keunggulan' : '/#keunggulan' }}" class="block px-3 py-2.5 rounded-md text-base font-semibold text-charcoal-light hover:bg-slate-50 hover:text-charcoal transition-colors">Mengapa Kami</a>
                    <a href="{{ request()->is('/') ? '#testimoni' : '/#testimoni' }}" class="block px-3 py-2.5 rounded-md text-base font-semibold text-charcoal-light hover:bg-slate-50 hover:text-charcoal transition-colors">Testimoni</a>
                    <hr class="border-slate-100 my-2">
                    <div class="flex flex-col space-y-3 pt-2">
                        @auth
                            @if(auth()->user()->isAdmin())
                                <a href="/admin/dashboard" class="w-full text-center py-2.5 rounded-md text-base font-semibold text-white bg-slate-950 hover:bg-slate-800 transition-colors">Dasbor Admin</a>
                            @endif
                            <form action="/logout" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="w-full text-center py-2.5 rounded-md text-base font-semibold text-charcoal hover:bg-slate-50 transition-colors cursor-pointer bg-transparent border-0">Keluar</button>
                            </form>
                        @else
                            <a href="/login" class="w-full text-center py-2.5 rounded-md text-base font-semibold text-charcoal hover:bg-slate-50 transition-colors">Masuk</a>
                            <a href="{{ route('campaigns.index') }}" class="w-full text-center py-3 bg-primary text-charcoal rounded-full font-bold text-base shadow-[0_4px_12px_rgba(159,239,0,0.35)] transition-all">
                                Donasi Sekarang
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content Slot -->
        <main class="min-h-screen">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-slate-50 border-t border-slate-100 pt-16 pb-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-8 md:gap-12 pb-12 border-b border-slate-200">
                    <!-- Column 1: Brand -->
                    <div class="md:col-span-4 space-y-4">
                        <a href="/" class="flex items-center space-x-2.5 group">
                            <div class="relative flex items-center justify-center h-10 w-10 rounded-xl bg-slate-950 shadow-inner group-hover:scale-105 transition-transform duration-300">
                                <svg class="h-5.5 w-5.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="url(#logo-grad-footer)"/>
                                    <defs>
                                        <linearGradient id="logo-grad-footer" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" stop-color="#9FEF00" />
                                            <stop offset="100%" stop-color="#10B981" />
                                        </linearGradient>
                                    </defs>
                                </svg>
                                <span class="absolute -top-0.5 -right-0.5 h-2 w-2 rounded-full bg-primary animate-ping"></span>
                                <span class="absolute -top-0.5 -right-0.5 h-2 w-2 rounded-full bg-primary"></span>
                            </div>
                            <span class="text-2xl font-extrabold tracking-tight text-charcoal">
                                Peduli<span class="text-primary-hover">a</span>
                            </span>
                        </a>
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
                            <li><a href="{{ route('campaigns.index') }}" class="hover:text-charcoal transition-colors">Kampanye Pilihan</a></li>
                            <li><a href="{{ request()->is('/') ? '#cara-kerja' : '/#cara-kerja' }}" class="hover:text-charcoal transition-colors">Cara Kerja Donasi</a></li>
                            <li><a href="{{ request()->is('/') ? '#keunggulan' : '/#keunggulan' }}" class="hover:text-charcoal transition-colors">Keunggulan Platform</a></li>
                            <li><a href="{{ request()->is('/') ? '#testimoni' : '/#testimoni' }}" class="hover:text-charcoal transition-colors">Testimoni Sukses</a></li>
                        </ul>
                    </div>

                    <!-- Column 3: Contact -->
                    <div class="md:col-span-3 space-y-3">
                        <h4 class="text-sm font-bold text-charcoal uppercase tracking-wider">Kontak & Bantuan</h4>
                        <ul class="space-y-2 text-sm text-charcoal-lighter font-medium">
                            <li class="flex items-center gap-2">
                                <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                support@pedulia.com
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
                    <p>&copy; 2026 Pedulia. Hak Cipta Dilindungi.</p>
                    <div class="flex space-x-6 mt-4 sm:mt-0">
                        <a href="#" class="hover:text-charcoal transition-colors">Ketentuan Layanan</a>
                        <a href="#" class="hover:text-charcoal transition-colors">Kebijakan Privasi</a>
                        <a href="#" class="hover:text-charcoal transition-colors">Syarat & Ketentuan</a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Layout JS -->
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

            if (mobileMenuButton) {
                mobileMenuButton.addEventListener('click', function() {
                    const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
                    mobileMenuButton.setAttribute('aria-expanded', !isExpanded);
                    mobileMenu.classList.toggle('hidden');
                    
                    // Toggle hamburger and close SVG icons
                    hamburgerIcon.classList.toggle('hidden');
                    closeIcon.classList.toggle('hidden');
                });
            }

            // Auto-close mobile drawer when a link is clicked
            if (mobileMenu) {
                const mobileMenuLinks = mobileMenu.querySelectorAll('a');
                mobileMenuLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        mobileMenu.classList.add('hidden');
                        hamburgerIcon.classList.remove('hidden');
                        closeIcon.classList.add('hidden');
                        mobileMenuButton.setAttribute('aria-expanded', 'false');
                    });
                });
            }
        </script>
        @stack('scripts')
    </body>
</html>
