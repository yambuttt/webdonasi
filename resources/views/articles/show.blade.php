@extends('layouts.app')

@section('title', $article->title . ' - Pedulia')

@push('styles')
        <!-- Rich Text Styling Helper -->
        <style>
            .article-body {
                font-family: 'Plus Jakarta Sans', sans-serif;
            }
            .article-body h2 {
                font-size: 1.5rem;
                font-weight: 800;
                color: #0f172a;
                margin-top: 2rem;
                margin-bottom: 0.8rem;
                line-height: 1.3;
            }
            .article-body h3 {
                font-size: 1.25rem;
                font-weight: 700;
                color: #0f172a;
                margin-top: 1.5rem;
                margin-bottom: 0.6rem;
                line-height: 1.3;
            }
            .article-body p {
                font-size: 0.95rem;
                line-height: 1.7;
                color: #334155;
                margin-bottom: 1.2rem;
            }
            .article-body ul {
                list-style-type: disc;
                padding-left: 1.5rem;
                margin-bottom: 1.2rem;
                font-size: 0.95rem;
                color: #334155;
            }
            .article-body ol {
                list-style-type: decimal;
                padding-left: 1.5rem;
                margin-bottom: 1.2rem;
                font-size: 0.95rem;
                color: #334155;
            }
            .article-body li {
                margin-bottom: 0.4rem;
            }
            .article-body blockquote {
                border-left: 4px solid #9FEF00;
                padding-left: 1rem;
                font-style: italic;
                margin-bottom: 1.2rem;
                color: #475569;
            }
            .article-body a {
                color: #0f172a;
                text-decoration: underline;
                font-weight: 700;
            }
            .article-body a:hover {
                color: #9FEF00;
            }
        </style>
@endpush

@section('content')
    <!-- Navbar spacer -->
    <div class="h-20"></div>

        <!-- Main Reading Section -->
        <main class="py-12 md:py-20 max-w-7xl mx-auto px-6 lg:px-8">
            
            <!-- Breadcrumbs / Back button -->
            <div class="mb-8">
                <a href="{{ route('articles.index') }}" class="inline-flex items-center space-x-2 text-xs font-bold text-slate-400 hover:text-charcoal transition-colors">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span>Kembali ke Daftar Artikel</span>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <!-- Left: Article Content Body (8 columns) -->
                <article class="lg:col-span-8 space-y-8">
                    
                    <!-- Title & Meta Header -->
                    <div class="space-y-4">
                        <span class="inline-flex items-center px-3 py-1 bg-primary/20 text-primary-dark text-xs font-extrabold rounded-full tracking-wider uppercase">Artikel</span>
                        <h1 class="text-3xl md:text-5xl font-extrabold text-charcoal leading-tight tracking-tight">
                            {{ $article->title }}
                        </h1>
                        <div class="flex items-center space-x-3 text-xs font-bold text-slate-400 border-b border-slate-100 pb-6">
                            <span>Oleh {{ $article->author->name ?? 'Admin Pedulia' }}</span>
                            <span>•</span>
                            <span>{{ $article->created_at->translatedFormat('d F Y') }}</span>
                        </div>
                    </div>

                    <!-- Aspect Ratio Image Banner -->
                    @if($article->thumbnail)
                    <div class="aspect-video w-full bg-slate-100 rounded-3xl overflow-hidden border border-slate-100">
                        <img src="{{ $article->thumbnail }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                    </div>
                    @endif

                    <!-- Rendered Rich Text Content -->
                    <div class="article-body">
                        {!! $article->content !!}
                    </div>

                </article>

                <!-- Right: Sidebar Details & Suggestions (4 columns) -->
                <aside class="lg:col-span-4 space-y-8">
                    
                    <!-- Author Information Widget -->
                    <div class="bg-slate-50 border border-slate-100 p-6 rounded-3xl space-y-3">
                        <h4 class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Penulis</h4>
                        <div class="flex items-center space-x-3">
                            <div class="h-10 w-10 bg-primary rounded-full flex items-center justify-center font-extrabold text-charcoal text-sm">
                                {{ strtoupper(substr($article->author->name ?? 'A', 0, 2)) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-charcoal">{{ $article->author->name ?? 'Admin Pedulia' }}</p>
                                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Verifikator Resmi</span>
                            </div>
                        </div>
                        <p class="text-xs text-slate-500 font-semibold leading-relaxed pt-1 border-t border-slate-200/50">
                            Menulis berita, panduan edukasi donasi digital, dan laporan hasil pembangunan infrastruktur sosial secara objektif.
                        </p>
                    </div>

                    <!-- Recent Articles Widget -->
                    <div class="bg-white border border-slate-100 p-6 rounded-3xl space-y-5">
                        <h4 class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Artikel Terkait Lainnya</h4>
                        
                        <div class="space-y-4">
                            @forelse($recentArticles as $recent)
                            <div class="flex items-start space-x-3 group">
                                <div class="h-12 w-20 bg-slate-100 rounded-lg overflow-hidden flex-shrink-0 border border-slate-200">
                                    @if($recent->thumbnail)
                                        <img src="{{ $recent->thumbnail }}" alt="{{ $recent->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <h5 class="text-xs font-bold text-charcoal leading-snug group-hover:text-primary-dark transition-colors line-clamp-2">
                                        <a href="{{ route('articles.show', $recent->slug) }}">{{ $recent->title }}</a>
                                    </h5>
                                    <span class="text-[9px] text-slate-400 font-semibold block mt-0.5">{{ $recent->created_at->translatedFormat('d M Y') }}</span>
                                </div>
                            </div>
                            @empty
                            <p class="text-xs text-slate-400 font-semibold">Tidak ada artikel terkait lainnya.</p>
                            @endforelse
                        </div>
                    </div>

                </aside>

            </div>

        </main>

@endsection
