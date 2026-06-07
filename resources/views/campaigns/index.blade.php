@extends('layouts.app')

@section('title', 'Pedulia - Daftar Kampanye Donasi')

@section('content')
<div class="py-12 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 space-y-12">
        
        <!-- Header Title / Intro -->
        <div class="text-center md:text-left max-w-3xl">
            <span class="inline-flex items-center space-x-2 px-3.5 py-1.5 bg-primary/15 text-charcoal rounded-full border border-primary/30 text-xs font-bold uppercase tracking-wide">
                <span>Daftar Kampanye Donasi</span>
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-charcoal leading-tight mt-3">
                Salurkan Donasi Anda dengan Aman & Transparan
            </h1>
            <p class="text-sm text-charcoal-lighter mt-2 font-medium leading-relaxed">
                Pilih aksi kebaikan yang ingin Anda dukung. Dapatkan laporan berkala secara transparan mengenai pemanfaatan dana donasi Anda.
            </p>
        </div>

        <!-- Slideshow/Carousel Header -->
        @if($carouselCampaigns->count() > 0)
        <div class="relative w-full h-[320px] md:h-[450px] lg:h-[480px] rounded-3xl overflow-hidden shadow-xl border border-slate-100 bg-slate-900 group" id="campaign-carousel">
            <!-- Slides Container -->
            <div class="relative w-full h-full">
                @foreach($carouselCampaigns as $index => $camp)
                <div class="carousel-slide absolute inset-0 w-full h-full transition-all duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100 pointer-events-auto active-slide' : 'opacity-0 pointer-events-none' }}" data-index="{{ $index }}">
                    <!-- Thumbnail Image -->
                    <img src="{{ $camp->thumbnail }}" alt="{{ $camp->title }}" class="absolute inset-0 w-full h-full object-cover">
                    <!-- Premium Dark Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/50 to-transparent"></div>
                    
                    <!-- Content Overlay -->
                    <div class="absolute bottom-0 left-0 right-0 p-6 sm:p-10 md:p-14 text-white space-y-4 max-w-4xl">
                        <span class="inline-flex items-center px-3 py-1 bg-primary text-charcoal rounded-full text-[10px] font-bold uppercase tracking-wider capitalize">
                            {{ $camp->category === 'kesehatan' ? 'Kesehatan' : ($camp->category === 'bencana' ? 'Bencana Alam' : 'Pendidikan') }}
                        </span>
                        <h2 class="text-lg sm:text-2xl md:text-3xl lg:text-4xl font-extrabold tracking-tight leading-tight text-white hover:text-primary transition-colors">
                            <a href="/campaigns/{{ $camp->slug }}">{{ $camp->title }}</a>
                        </h2>
                        
                        <!-- Mini Progress Info -->
                        <div class="max-w-md space-y-2 pt-1">
                            <div class="flex items-center justify-between text-xs font-bold">
                                <span>Terkumpul: <span class="text-primary">Rp {{ number_format($camp->current_amount, 0, ',', '.') }}</span></span>
                                <span class="text-primary-hover bg-primary/20 px-2 py-0.5 rounded">{{ $camp->percentage }}%</span>
                            </div>
                            <div class="w-full h-2 bg-white/20 rounded-full overflow-hidden border border-white/5">
                                <div class="h-full bg-primary rounded-full transition-all duration-500" style="width: {{ $camp->percentage }}%;"></div>
                            </div>
                        </div>

                        <!-- CTA Actions -->
                        <div class="pt-3 flex items-center space-x-3">
                            <a href="/campaigns/{{ $camp->slug }}" class="px-6 py-3 bg-primary text-charcoal rounded-full text-xs font-extrabold hover:bg-primary-hover shadow-lg hover:shadow-primary/25 transition-all transform hover:-translate-y-0.5">
                                Donasi Sekarang
                            </a>
                            <a href="/campaigns/{{ $camp->slug }}" class="px-6 py-3 bg-white/10 hover:bg-white/20 text-white rounded-full text-xs font-bold backdrop-blur-sm border border-white/10 hover:border-white/20 transition-all">
                                Pelajari Detail
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Navigation Controls (Left/Right Arrows) -->
            @if($carouselCampaigns->count() > 1)
            <button onclick="prevSlide()" class="absolute left-4 top-1/2 -translate-y-1/2 z-20 h-10 w-10 md:h-12 md:w-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center backdrop-blur-md border border-white/10 hover:border-white/20 transition-all opacity-0 group-hover:opacity-100 cursor-pointer focus:outline-none">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button onclick="nextSlide()" class="absolute right-4 top-1/2 -translate-y-1/2 z-20 h-10 w-10 md:h-12 md:w-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center backdrop-blur-md border border-white/10 hover:border-white/20 transition-all opacity-0 group-hover:opacity-100 cursor-pointer focus:outline-none">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Indicators (Dot Tabs) -->
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex space-x-2.5">
                @foreach($carouselCampaigns as $index => $camp)
                <button onclick="goToSlide({{ $index }})" class="carousel-dot h-2 w-2 rounded-full transition-all duration-300 cursor-pointer {{ $index === 0 ? 'bg-primary w-6' : 'bg-white/40 hover:bg-white/60' }}" id="dot-{{ $index }}"></button>
                @endforeach
            </div>
            @endif
        </div>
        @endif

        <!-- Campaigns Grid Section -->
        <section class="space-y-8 pt-4">
            <!-- Filter Tabs -->
            <div class="flex flex-wrap items-center justify-center md:justify-start gap-2 border-b border-slate-200/60 pb-6">
                <button onclick="filterCampaigns('semua')" class="filter-btn active px-5 py-2.5 rounded-full text-xs font-extrabold border transition-all duration-300">
                    Semua Kampanye
                </button>
                <button onclick="filterCampaigns('kesehatan')" class="filter-btn px-5 py-2.5 rounded-full text-xs font-extrabold border transition-all duration-300">
                    Medis & Kesehatan
                </button>
                <button onclick="filterCampaigns('bencana')" class="filter-btn px-5 py-2.5 rounded-full text-xs font-extrabold border transition-all duration-300">
                    Tanggap Bencana Alam
                </button>
                <button onclick="filterCampaigns('pendidikan')" class="filter-btn px-5 py-2.5 rounded-full text-xs font-extrabold border transition-all duration-300">
                    Pendidikan Anak
                </button>
            </div>

            <!-- Campaign Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($campaigns as $campaign)
                <article class="campaign-card bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group" data-category="{{ $campaign->category }}">
                    <div class="relative aspect-video w-full overflow-hidden">
                        <img src="{{ $campaign->thumbnail }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-4 left-4 bg-white/95 text-charcoal text-[10px] font-bold px-3 py-1 rounded-full shadow-sm capitalize border border-slate-100">
                            {{ $campaign->category === 'kesehatan' ? 'Kesehatan' : ($campaign->category === 'bencana' ? 'Bencana Alam' : 'Pendidikan') }}
                        </span>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                        <div class="space-y-3">
                            <h3 class="text-base font-extrabold text-charcoal leading-snug hover:text-primary-dark transition-colors line-clamp-2 min-h-[44px]">
                                <a href="/campaigns/{{ $campaign->slug }}">{{ $campaign->title }}</a>
                            </h3>
                            <p class="text-[11px] font-semibold text-slate-400">Pedulia Foundation</p>
                            <p class="text-xs text-charcoal-lighter line-clamp-3 leading-relaxed">{!! strip_tags($campaign->description) !!}</p>
                        </div>
                        
                        <div class="space-y-4 pt-2">
                            <!-- Progress Bar -->
                            <div class="space-y-1.5">
                                <div class="flex items-center justify-between text-[11px] font-bold text-charcoal">
                                    <span>Terkumpul: <span class="font-extrabold text-slate-900">Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</span></span>
                                    <span class="text-primary-dark bg-primary/20 px-2 py-0.5 rounded-md text-[10px]">{{ $campaign->percentage }}%</span>
                                </div>
                                <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-primary rounded-full" style="width: {{ $campaign->percentage }}%;"></div>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between text-[10px] font-semibold text-slate-400 pt-1 border-t border-slate-100">
                                <span>Target: <span class="font-bold text-charcoal">Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</span></span>
                                <span class="flex items-center gap-1">
                                    <svg class="h-3.5 w-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $campaign->days_remaining }} Hari Lagi
                                </span>
                            </div>

                            <a href="/campaigns/{{ $campaign->slug }}" class="block w-full py-3 bg-primary/10 hover:bg-primary text-charcoal hover:shadow-md hover:shadow-primary/15 text-center rounded-2xl text-xs font-extrabold transition-all duration-300">
                                Donasi Sekarang
                            </a>
                        </div>
                    </div>
                </article>
                @empty
                <div class="col-span-3 text-center py-16 text-slate-400 font-semibold text-xs space-y-2 bg-white border border-slate-100 rounded-3xl shadow-sm">
                    <span class="inline-block p-4 bg-slate-50 rounded-2xl text-slate-300">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    <p>Belum ada kampanye aktif saat ini.</p>
                </div>
                @endforelse
            </div>
        </section>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Slider state
    let currentSlideIndex = 0;
    const slides = document.querySelectorAll('.carousel-slide');
    const dots = document.querySelectorAll('.carousel-dot');
    const slideCount = slides.length;
    let carouselInterval;

    function showSlide(index) {
        if (slideCount === 0) return;

        // Wrap around
        if (index >= slideCount) {
            currentSlideIndex = 0;
        } else if (index < 0) {
            currentSlideIndex = slideCount - 1;
        } else {
            currentSlideIndex = index;
        }

        // Hide all slides and reset dot indicators
        slides.forEach((slide) => {
            slide.classList.remove('opacity-100', 'pointer-events-auto', 'active-slide');
            slide.classList.add('opacity-0', 'pointer-events-none');
        });
        dots.forEach((dot) => {
            dot.classList.remove('bg-primary', 'w-6');
            dot.classList.add('bg-white/40', 'hover:bg-white/60');
        });

        // Show active slide
        const activeSlide = slides[currentSlideIndex];
        if (activeSlide) {
            activeSlide.classList.remove('opacity-0', 'pointer-events-none');
            activeSlide.classList.add('opacity-100', 'pointer-events-auto', 'active-slide');
        }

        // Style active dot indicator
        const activeDot = document.getElementById(`dot-${currentSlideIndex}`);
        if (activeDot) {
            activeDot.classList.remove('bg-white/40', 'hover:bg-white/60');
            activeDot.classList.add('bg-primary', 'w-6');
        }
    }

    function nextSlide() {
        showSlide(currentSlideIndex + 1);
    }

    function prevSlide() {
        showSlide(currentSlideIndex - 1);
    }

    function goToSlide(index) {
        showSlide(index);
        resetCarouselTimer();
    }

    function startCarouselTimer() {
        if (slideCount > 1) {
            carouselInterval = setInterval(nextSlide, 5000); // Auto-advance every 5 seconds
        }
    }

    function stopCarouselTimer() {
        if (carouselInterval) {
            clearInterval(carouselInterval);
        }
    }

    function resetCarouselTimer() {
        stopCarouselTimer();
        startCarouselTimer();
    }

    // Category Filtering Tabs
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
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 50);
            } else {
                card.style.opacity = '0';
                card.style.transform = 'translateY(10px)';
                setTimeout(() => {
                    card.style.display = 'none';
                }, 300);
            }
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Set initial filter active styling
        const activeBtn = document.querySelector('.filter-btn.active');
        if (activeBtn) {
            activeBtn.classList.add('bg-primary', 'text-charcoal', 'border-primary');
        }

        // Initialize Carousel
        if (slideCount > 0) {
            showSlide(0);
            startCarouselTimer();

            // Pause on hover
            const carouselContainer = document.getElementById('campaign-carousel');
            if (carouselContainer) {
                carouselContainer.addEventListener('mouseenter', stopCarouselTimer);
                carouselContainer.addEventListener('mouseleave', startCarouselTimer);
            }
        }
    });
</script>

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
