<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'Admin Panel - Pedulia')</title>
        
        <!-- Google Fonts: Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
    </head>
    <body class="bg-slate-50 text-charcoal font-sans antialiased min-h-screen flex">

        <!-- Left Sidebar (Desktop: Static, Mobile: Floating Drawer) -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 bg-slate-950 text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col justify-between border-r border-slate-900 shadow-xl">
            <div>
                <!-- Brand logo header -->
                <div class="h-20 flex items-center px-6 border-b border-slate-900 justify-between">
                    <a href="/admin/dashboard" class="flex items-center space-x-2.5 group">
                        <div class="relative flex items-center justify-center h-10 w-10 rounded-xl bg-slate-900 border border-slate-800 shadow-inner group-hover:scale-105 transition-transform duration-300">
                            <svg class="h-5.5 w-5.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="url(#logo-grad-admin)"/>
                                <defs>
                                    <linearGradient id="logo-grad-admin" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" stop-color="#9FEF00" />
                                        <stop offset="100%" stop-color="#10B981" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg font-extrabold tracking-tight text-white leading-none">
                                Peduli<span class="text-primary">a</span>
                            </span>
                            <span class="text-[9px] font-bold text-primary tracking-widest uppercase mt-1">Admin Panel</span>
                        </div>
                    </a>
                    <!-- Close menu button (Mobile only) -->
                    <button id="sidebar-close" class="lg:hidden p-1 rounded-md text-slate-400 hover:text-white hover:bg-slate-900 focus:outline-none transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Navigation items -->
                <nav class="p-4 space-y-1.5">
                    <a href="/admin/dashboard" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-bold {{ request()->is('admin/dashboard') ? 'bg-primary/10 text-primary border border-primary/20' : 'text-slate-400 hover:text-white hover:bg-slate-900 border border-transparent' }} transition-all">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z" />
                        </svg>
                        <span>Ringkasan Dasbor</span>
                    </a>
                    <a href="{{ route('admin.campaigns.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-bold {{ request()->is('admin/campaigns*') ? 'bg-primary/10 text-primary border border-primary/20' : 'text-slate-400 hover:text-white hover:bg-slate-900 border border-transparent' }} transition-all">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <span>Kelola Kampanye</span>
                    </a>
                    <a href="{{ route('admin.donations.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-bold {{ request()->is('admin/donations*') ? 'bg-primary/10 text-primary border border-primary/20' : 'text-slate-400 hover:text-white hover:bg-slate-900 border border-transparent' }} transition-all">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span>Kelola Donasi</span>
                    </a>
                    <a href="{{ route('admin.articles.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-bold {{ request()->is('admin/articles*') ? 'bg-primary/10 text-primary border border-primary/20' : 'text-slate-400 hover:text-white hover:bg-slate-900 border border-transparent' }} transition-all">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 4a2 2 0 00-2-2m2 2a2 2 0 012 2v7a2 2 0 01-2 2h-2m-6 0h-2" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h6M7 12h4" />
                        </svg>
                        <span>Kelola Artikel</span>
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-bold {{ request()->is('admin/settings*') ? 'bg-primary/10 text-primary border border-primary/20' : 'text-slate-400 hover:text-white hover:bg-slate-900 border border-transparent' }} transition-all">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Pengaturan</span>
                    </a>
                </nav>
            </div>

            <!-- Sidebar Bottom: Admin Identity & Sign Out -->
            <div class="p-4 border-t border-slate-900 bg-slate-950">
                <div class="flex items-center space-x-3 mb-4.5 px-2">
                    <div class="h-9 w-9 rounded-full bg-primary/20 border border-primary/40 flex items-center justify-center font-extrabold text-primary text-sm">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="text-xs font-bold text-white truncate">{{ auth()->user()->name ?? 'Admin' }}</span>
                        <span class="text-[10px] text-slate-400 truncate">{{ auth()->user()->email ?? 'admin@email.com' }}</span>
                    </div>
                </div>
                
                <!-- Sign Out Form Button -->
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center space-x-2 px-4 py-2.5 bg-slate-900 border border-slate-800 hover:border-red-900 hover:text-red-400 rounded-xl text-xs font-bold text-slate-300 transition-all cursor-pointer">
                        <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Keluar Sesi</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Sidebar Overlay (Mobile only) -->
        <div id="sidebar-overlay" class="fixed inset-0 z-30 bg-black/50 hidden lg:hidden"></div>

        <!-- Main Content Wrapper -->
        <div class="flex-1 lg:pl-64 flex flex-col min-h-screen">
            
            <!-- Top Navbar Header -->
            <header class="h-20 bg-white border-b border-slate-100 flex items-center justify-between px-6 md:px-8 relative sticky top-0 z-20">
                <div class="flex items-center space-x-4">
                    <!-- Hamburger toggle (Mobile only) -->
                    <button id="sidebar-open" class="lg:hidden p-2 rounded-lg text-charcoal hover:bg-slate-50 focus:outline-none transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <div>
                        <h1 class="text-lg font-bold text-charcoal tracking-tight">@yield('header-title', 'Selamat Datang Kembali!')</h1>
                        <p class="text-[11px] text-slate-400 font-semibold uppercase tracking-wider">@yield('header-subtitle', 'Operasional Kita')</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    @yield('header-actions')
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 p-6 md:p-8 space-y-6 max-w-[1600px] mx-auto w-full">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="h-16 border-t border-slate-100 bg-white flex items-center justify-between px-8 text-xs text-slate-400 font-semibold mt-auto">
                <p>&copy; 2026 Pedulia Admin Panel. Hak Cipta Dilindungi.</p>
            </footer>
        </div>

        <!-- Layout JS -->
        <script>
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const sidebarOpenBtn = document.getElementById('sidebar-open');
            const sidebarCloseBtn = document.getElementById('sidebar-close');

            function toggleSidebar() {
                sidebar.classList.toggle('-translate-x-full');
                sidebarOverlay.classList.toggle('hidden');
            }

            if (sidebarOpenBtn) sidebarOpenBtn.addEventListener('click', toggleSidebar);
            if (sidebarCloseBtn) sidebarCloseBtn.addEventListener('click', toggleSidebar);
            if (sidebarOverlay) sidebarOverlay.addEventListener('click', toggleSidebar);
        </script>
        @stack('scripts')
    </body>
</html>
