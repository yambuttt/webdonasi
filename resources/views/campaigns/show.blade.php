@extends('layouts.app')

@section('title', $campaign->title . ' - Pedulia')

@section('content')
<div class="py-12 bg-slate-50 pb-28 lg:pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb / Back Navigation -->
        <div class="mb-8 flex items-center justify-between">
            <a href="/" class="inline-flex items-center space-x-2 text-sm font-bold text-slate-500 hover:text-charcoal transition-colors">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali ke Beranda</span>
            </a>
            
            <span class="inline-block px-3 py-1 text-xs font-bold text-slate-500 bg-white border border-slate-200 rounded-full shadow-sm">
                Kategori: 
                <span class="text-charcoal-light font-extrabold capitalize">{{ $campaign->category === 'kesehatan' ? 'Kesehatan' : ($campaign->category === 'bencana' ? 'Bencana Alam' : 'Pendidikan') }}</span>
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Side: Campaign Media, Progress, and Long Description (8 columns) -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- Campaign Title Card -->
                <div class="space-y-4">
                    <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight text-charcoal leading-tight">
                        {{ $campaign->title }}
                    </h1>
                </div>

                <!-- Cover Image -->
                <div class="w-full aspect-[16/9] rounded-3xl overflow-hidden bg-slate-100 border border-slate-200 shadow-md">
                    <img src="{{ $campaign->thumbnail }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover">
                </div>

                <!-- Live Progress Card -->
                <div class="bg-white border border-slate-100 p-6 md:p-8 rounded-3xl shadow-sm space-y-6">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Dana Terkumpul</span>
                            <h2 class="text-3xl font-extrabold text-charcoal tracking-tight flex items-baseline">
                                Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}
                                <span class="text-sm font-semibold text-slate-400 ml-2">dari Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</span>
                            </h2>
                        </div>
                        <div class="md:text-right">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Sisa Hari</span>
                            <span class="inline-flex items-center px-3.5 py-1 bg-charcoal text-white rounded-full text-xs font-bold shadow-sm">
                                {{ $campaign->days_remaining }} Hari Lagi
                            </span>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="space-y-2">
                        <div class="w-full bg-slate-100 rounded-full h-3.5 overflow-hidden border border-slate-50">
                            <div class="bg-primary h-full rounded-full transition-all duration-1000 ease-out shadow-[0_0_12px_rgba(159,239,0,0.6)]" style="width: {{ $campaign->percentage }}%"></div>
                        </div>
                        <div class="flex justify-between items-center text-xs font-bold text-slate-500">
                            <span>Mencapai {{ $campaign->percentage }}% Target</span>
                            <span>{{ $campaign->days_remaining > 0 ? 'Kampanye Aktif' : 'Kampanye Selesai' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Long Rich-Text Description -->
                <div class="bg-white border border-slate-100 p-6 md:p-8 rounded-3xl shadow-sm space-y-6">
                    <div class="border-b border-slate-100 pb-4">
                        <h3 class="text-lg font-bold text-charcoal tracking-tight">Kisah Penggalangan Dana</h3>
                        <p class="text-xs text-slate-400 font-semibold mt-0.5">Detail kebutuhan dan informasi penyaluran dana bantuan</p>
                    </div>

                    <!-- Rich HTML Content -->
                    <div class="prose max-w-none text-charcoal text-sm leading-relaxed space-y-4">
                        {!! $campaign->description !!}
                    </div>
                </div>

                <!-- Comments / Prayers Section -->
                <div class="bg-white border border-slate-100 p-6 md:p-8 rounded-3xl shadow-sm space-y-6">
                    <div class="border-b border-slate-100 pb-4 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold text-charcoal tracking-tight">Doa-Doa Donatur</h3>
                            <p class="text-xs text-slate-400 font-semibold mt-0.5">Pesan tulus dan doa baik dari para donatur</p>
                        </div>
                        <span class="px-2.5 py-1 bg-primary/10 text-charcoal rounded-xl text-[10px] font-bold border border-primary/20">
                            {{ $campaign->donations()->where('status', 'confirmed')->where('is_comment_visible', true)->whereNotNull('comment')->count() }} Doa
                        </span>
                    </div>

                    <div class="space-y-4 max-h-[500px] overflow-y-auto pr-2 divide-y divide-slate-50">
                        @php
                            $comments = $campaign->donations()
                                ->where('status', 'confirmed')
                                ->where('is_comment_visible', true)
                                ->whereNotNull('comment')
                                ->latest()
                                ->get();
                        @endphp

                        @forelse($comments as $comment)
                            <div class="pt-4 first:pt-0 space-y-2">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-xs font-bold text-charcoal">{{ $comment->donor_name }}</p>
                                        <p class="text-[10px] text-slate-400 font-semibold mt-0.5">Berdonasi Rp {{ number_format($comment->nominal, 0, ',', '.') }}</p>
                                    </div>
                                    <span class="text-[9px] text-slate-400 font-semibold">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-xs text-slate-600 font-medium leading-relaxed italic bg-slate-50 p-3 rounded-2xl border border-slate-100/50">
                                    "{{ $comment->comment }}"
                                </p>
                            </div>
                        @empty
                            <div class="text-center py-8 space-y-2">
                                <span class="inline-block p-3 bg-slate-50 text-slate-400 rounded-2xl">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                </span>
                                <p class="text-xs font-bold text-slate-400">Belum ada doa yang tertulis. Salurkan donasi Anda dan kirim doa terbaik!</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

            <!-- Right Side: Interactive Donation Widget (4 columns) -->
            <div class="lg:col-span-4 lg:sticky lg:top-28 space-y-6">
                
                <!-- Donation Card -->
                <div class="bg-white border border-slate-100 p-6 rounded-3xl shadow-lg relative overflow-hidden">
                    <div class="absolute top-0 right-0 h-1.5 w-full bg-primary shadow-[0_2px_8px_rgba(159,239,0,0.5)]"></div>
                    
                    <div class="mb-5">
                        <h3 class="text-sm font-extrabold text-charcoal uppercase tracking-wider">Salurkan Kebaikan Anda</h3>
                        <p class="text-[11px] text-slate-400 font-semibold mt-0.5">Dukung kampanye ini dengan berdonasi secara aman dan transparan</p>
                    </div>

                    <!-- Action Button to Dedicated Page -->
                    <a href="{{ route('campaigns.donate.create', $campaign->slug) }}" 
                       class="block w-full py-4 bg-primary text-charcoal font-extrabold rounded-2xl text-xs sm:text-sm shadow-[0_4px_14px_rgba(159,239,0,0.3)] hover:bg-primary-hover hover:shadow-[0_6px_20px_rgba(159,239,0,0.5)] transition-all duration-300 transform hover:-translate-y-0.5 text-center cursor-pointer">
                        Donasi Sekarang
                    </a>

                    <!-- Trust Badge -->
                    <div class="mt-6 pt-5 border-t border-slate-100 flex items-center space-x-3 text-[10px] text-slate-400 font-semibold justify-center">
                        <svg class="h-4 w-4 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <span>Transaksi Terenkripsi & Dijamin 100% Aman</span>
                    </div>

                </div>

            </div>

        </div>

        <!-- Sticky Bottom Bar for Mobile -->
        <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-slate-200/80 p-4 z-40 lg:hidden flex items-center justify-between shadow-[0_-6px_24px_rgba(0,0,0,0.06)] animate-fade-in-up">
            <div class="flex-1 min-w-0 pr-4">
                <span class="text-[9px] font-extrabold text-slate-400 uppercase tracking-wider block mb-0.5">Dana Terkumpul</span>
                <span class="text-sm font-extrabold text-charcoal">Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</span>
            </div>
            <a href="{{ route('campaigns.donate.create', $campaign->slug) }}" class="px-6 py-3.5 bg-primary text-charcoal font-extrabold rounded-full text-xs shadow-[0_4px_12px_rgba(159,239,0,0.3)] hover:bg-primary-hover hover:scale-[1.02] active:scale-[0.98] transition-all cursor-pointer text-center">
                Donasi Sekarang
            </a>
        </div>

        </div>

        <!-- Related/Recommendations Campaigns Grid -->
        @if($relatedCampaigns->count() > 0)
        <div class="mt-16 pt-12 border-t border-slate-200/60 space-y-8">
            <div>
                <h3 class="text-xl font-bold text-charcoal tracking-tight">Kampanye Terkait Lainnya</h3>
                <p class="text-xs text-slate-400 font-semibold mt-0.5">Dukung aksi kebaikan lainnya yang membutuhkan uluran tangan Anda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($relatedCampaigns as $rel)
                <div class="bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <!-- Image Cover -->
                        <div class="aspect-[16/10] bg-slate-100 overflow-hidden relative">
                            <img src="{{ $rel->thumbnail }}" alt="{{ $rel->title }}" class="w-full h-full object-cover">
                            <span class="absolute top-4 left-4 inline-block px-2.5 py-1 text-[10px] font-extrabold text-charcoal bg-primary rounded-full uppercase tracking-wider shadow-md">
                                {{ $rel->category === 'kesehatan' ? 'Kesehatan' : ($rel->category === 'bencana' ? 'Bencana Alam' : 'Pendidikan') }}
                            </span>
                        </div>
                        
                        <!-- Content Card -->
                        <div class="p-6 space-y-4">
                            <h4 class="text-sm font-bold text-charcoal leading-snug line-clamp-2 min-h-[40px] hover:text-primary-dark transition-colors">
                                <a href="/campaigns/{{ $rel->slug }}">{{ $rel->title }}</a>
                            </h4>
                            
                            <!-- Progress slider -->
                            <div class="space-y-1">
                                <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                    <div class="bg-primary h-full rounded-full" style="width: {{ $rel->percentage }}%"></div>
                                </div>
                                <div class="flex items-center justify-between text-[10px] font-bold text-slate-500">
                                    <span>Terkumpul {{ $rel->percentage }}%</span>
                                    <span>{{ $rel->days_remaining }} Hari Lagi</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Link -->
                    <div class="p-6 pt-0">
                        <a href="/campaigns/{{ $rel->slug }}" class="block w-full py-2.5 bg-slate-50 hover:bg-primary hover:text-charcoal border border-slate-100 rounded-xl text-center text-xs font-bold text-slate-600 transition-all">
                            Lihat Detail Kampanye
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>
@endsection


