@extends('layouts.admin')

@section('title', 'Dasbor Admin - Pedulia')
@section('header-title', 'Selamat Datang Kembali, Admin!')
@section('header-subtitle', 'Ringkasan Operasional Kita')

@section('header-actions')
    <!-- Search Bar (Desktop) -->
    <div class="hidden sm:block relative">
        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </span>
        <input type="text" placeholder="Cari kampanye atau donatur..." class="w-56 pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs placeholder-slate-400 focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
    </div>

    <!-- Notification bell -->
    <button class="p-2 rounded-lg text-charcoal hover:bg-slate-50 focus:outline-none relative transition-colors">
        <svg class="h-5.5 w-5.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        <span class="absolute top-1.5 right-1.5 h-2 w-2 rounded-full bg-red-500 animate-ping"></span>
        <span class="absolute top-1.5 right-1.5 h-2 w-2 rounded-full bg-red-500"></span>
    </button>
    
    <hr class="h-6 border-l border-slate-200">

    <!-- Admin User Avatar Info -->
    <div class="flex items-center space-x-2.5">
        <div class="h-8 w-8 rounded-full bg-primary text-charcoal font-bold flex items-center justify-center text-xs">
            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}
        </div>
        <span class="hidden md:inline-block text-xs font-bold text-charcoal">{{ auth()->user()->name ?? 'Admin' }}</span>
    </div>
@endsection

@section('content')
    <!-- Overview Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5.5">
        
        <!-- Stat Card 1 -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Dana Terkumpul</span>
                <span class="p-2.5 rounded-xl bg-primary/10 text-charcoal-light">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
            </div>
            <div class="mt-4">
                <h3 class="text-2xl font-extrabold tracking-tight text-charcoal">{{ $stats['total_funds'] }}</h3>
                <span class="text-xs font-bold text-emerald-600 flex items-center mt-1">
                    <svg class="h-3 w-3 mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                    </svg>
                    {{ $stats['funds_growth'] }}
                </span>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kampanye Aktif</span>
                <span class="p-2.5 rounded-xl bg-blue-50 text-blue-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </span>
            </div>
            <div class="mt-4">
                <h3 class="text-2xl font-extrabold tracking-tight text-charcoal">{{ $stats['active_campaigns'] }}</h3>
                <span class="text-xs font-bold text-emerald-600 flex items-center mt-1">
                    <svg class="h-3 w-3 mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                    </svg>
                    {{ $stats['campaigns_growth'] }}
                </span>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <a href="{{ route('admin.donations.index', ['status' => 'pending']) }}" class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all flex flex-col justify-between relative overflow-hidden group">
            <div class="absolute top-0 right-0 h-1.5 w-full bg-amber-500"></div>
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider group-hover:text-charcoal transition-colors">Menunggu Verifikasi</span>
                <span class="p-2.5 rounded-xl bg-amber-50 text-amber-600 animate-pulse">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </span>
            </div>
            <div class="mt-4">
                <h3 class="text-2xl font-extrabold tracking-tight text-charcoal">{{ $stats['pending_verifications'] }}</h3>
                <span class="inline-flex items-center px-2 py-0.5 mt-1 bg-amber-50 text-amber-800 text-[10px] font-bold rounded border border-amber-200">
                    {{ $stats['verifications_badge'] }}
                </span>
            </div>
        </a>

        <!-- Stat Card 4 -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Donatur</span>
                <span class="p-2.5 rounded-xl bg-purple-50 text-purple-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </span>
            </div>
            <div class="mt-4">
                <h3 class="text-2xl font-extrabold tracking-tight text-charcoal">{{ $stats['total_donors'] }}</h3>
                <span class="text-xs font-bold text-slate-400 mt-1 block">
                    {{ $stats['donors_growth'] }}
                </span>
            </div>
        </div>

    </div>

    <!-- Split Layout: Campaigns and Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left: Recent Campaigns (8 columns) -->
        <div class="lg:col-span-8 bg-white border border-slate-100 rounded-2xl shadow-sm p-6 space-y-6">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-base font-bold text-charcoal tracking-tight">Daftar Kampanye Terbaru</h2>
                    <p class="text-xs text-slate-400 font-medium mt-0.5">Memantau target dan progress penggalangan dana</p>
                </div>
                <a href="{{ route('admin.campaigns.index') }}" class="px-3.5 py-1.5 border border-slate-200 hover:bg-slate-50 text-xs font-bold text-charcoal rounded-lg transition-colors cursor-pointer">
                    Lihat Semua
                </a>
            </div>

            <!-- Table Container -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-100 text-xs font-bold text-slate-400 uppercase tracking-wider">
                            <th class="pb-3.5 pl-2">Kampanye</th>
                            <th class="pb-3.5">Target</th>
                            <th class="pb-3.5">Progress</th>
                            <th class="pb-3.5">Status</th>
                            <th class="pb-3.5 text-right pr-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @foreach($recentCampaigns as $campaign)
                        <tr class="group hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 pl-2 pr-4 max-w-xs">
                                <div class="space-y-1">
                                    <p class="font-bold text-charcoal leading-tight truncate group-hover:text-primary-dark transition-colors">{{ $campaign['title'] }}</p>
                                    <span class="inline-block px-2 py-0.5 text-[10px] font-bold text-slate-500 bg-slate-100 rounded-md">{{ $campaign['category'] }}</span>
                                </div>
                            </td>
                            <td class="py-4 font-bold text-charcoal text-xs">
                                Rp {{ number_format($campaign['target'], 0, ',', '.') }}
                            </td>
                            <td class="py-4 w-40">
                                <div class="space-y-1">
                                    <div class="flex items-center justify-between text-xs font-semibold text-charcoal">
                                        <span>{{ $campaign['percentage'] }}%</span>
                                        <span class="text-[10px] text-slate-400">Rp {{ number_format($campaign['raised'], 0, ',', '.') }}</span>
                                    </div>
                                    <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                        <div class="bg-primary h-full rounded-full" style="width: {{ $campaign['percentage'] }}%"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4">
                                @if($campaign['status'] === 'Aktif')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">Aktif</span>
                                @elseif($campaign['status'] === 'Selesai')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">Selesai</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100 animate-pulse">Menunggu</span>
                                @endif
                            </td>
                            <td class="py-4 text-right pr-2">
                                <a href="{{ route('admin.campaigns.index') }}" class="p-1 text-slate-400 hover:text-charcoal rounded transition-colors" title="Edit Kampanye">
                                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right: Recent Activity feed (4 columns) -->
        <div class="lg:col-span-4 bg-white border border-slate-100 rounded-2xl shadow-sm p-6 space-y-6">
            <div>
                <h2 class="text-base font-bold text-charcoal tracking-tight">Aktivitas Donasi Terbaru</h2>
                <p class="text-xs text-slate-400 font-medium mt-0.5">Kontribusi langsung dari para donatur</p>
            </div>

            <!-- Activity Timeline list -->
            <div class="space-y-5">
                @foreach($recentDonations as $donation)
                <div class="flex items-start space-x-3.5">
                    <div class="mt-1 flex-shrink-0 h-8 w-8 rounded-full bg-primary/10 border border-primary/20 flex items-center justify-center text-primary">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-start">
                            <p class="text-xs font-bold text-charcoal truncate">{{ $donation['donor_name'] }}</p>
                            <span class="text-[10px] font-semibold text-slate-400 flex-shrink-0">{{ $donation['time'] }}</span>
                        </div>
                        <p class="text-[11px] text-slate-500 font-medium truncate mt-0.5">
                            Berdonasi <span class="font-bold text-charcoal">{{ $donation['amount'] }}</span> untuk <span class="text-primary-dark font-bold hover:underline cursor-pointer">{{ $donation['campaign'] }}</span>
                        </p>
                        <span class="inline-block mt-1 text-[9px] font-bold text-slate-400">{{ $donation['method'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>

            <hr class="border-slate-100">

            <div class="bg-slate-50 rounded-xl p-4 flex items-center justify-between border border-slate-100">
                <div>
                    <h4 class="text-xs font-bold text-charcoal">Unduh Laporan Harian</h4>
                    <p class="text-[10px] text-slate-400 font-semibold mt-0.5">Laporan Rekap Transaksi PDF/Excel</p>
                </div>
                <button class="p-2 bg-white border border-slate-200 hover:border-charcoal text-charcoal rounded-lg shadow-sm transition-all cursor-pointer">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                </button>
            </div>
        </div>

    </div>
@endsection
