@extends('layouts.app')

@section('title', 'Artikel & Kabar Terbaru - Pedulia')

@section('content')
    <!-- Navbar spacer -->
    <div class="h-20"></div>

        <!-- Section: Title Hero Header -->
        <section class="bg-slate-50 py-16 md:py-20 border-b border-slate-100">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center space-y-4">
                <span class="inline-flex items-center px-3 py-1 bg-primary/20 text-primary-dark text-xs font-extrabold rounded-full tracking-wider uppercase">Artikel & Kabar</span>
                <h1 class="text-3xl md:text-5xl font-extrabold text-charcoal tracking-tight max-w-2xl mx-auto leading-tight">
                    Menginspirasi & Membagi Kebaikan Bersama
                </h1>
                <p class="text-sm md:text-base text-slate-500 font-semibold max-w-xl mx-auto">
                    Ketahui tips menggalang dana, transparansi penyaluran bantuan, serta cerita-cerita perubahan nyata dari lapangan.
                </p>
            </div>
        </section>

        <!-- Section: Article Grid List -->
        <section class="py-16 md:py-24">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-12">
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($articles as $article)
                    <article class="bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                        <div>
                            <!-- Aspect ratio 16:9 thumbnail cover -->
                            <div class="aspect-video w-full bg-slate-100 overflow-hidden relative border-b border-slate-50">
                                @if($article->thumbnail)
                                    <img src="{{ $article->thumbnail }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-400 bg-slate-100 text-xs font-bold">Pedulia</div>
                                @endif
                                <span class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-2.5 py-1 text-[10px] font-extrabold text-charcoal uppercase tracking-wider rounded-md">Informasi</span>
                            </div>

                            <!-- Content Info -->
                            <div class="p-6.5 space-y-3">
                                <div class="flex items-center space-x-3 text-slate-400 text-xs font-bold">
                                    <span>{{ $article->author->name ?? 'Admin' }}</span>
                                    <span>•</span>
                                    <span>{{ $article->created_at->translatedFormat('d M Y') }}</span>
                                </div>
                                <h3 class="text-lg font-extrabold text-charcoal leading-snug group-hover:text-primary-dark transition-colors">
                                    <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                                </h3>
                                <p class="text-xs text-slate-500 font-medium leading-relaxed">
                                    {{ $article->excerpt }}
                                </p>
                            </div>
                        </div>

                        <!-- Read Link Button -->
                        <div class="px-6.5 pb-6.5 pt-2">
                            <a href="{{ route('articles.show', $article->slug) }}" class="inline-flex items-center space-x-1 text-xs font-extrabold text-primary-dark group-hover:underline">
                                <span>Baca Selengkapnya</span>
                                <svg class="h-3.5 w-3.5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </article>
                    @empty
                    <div class="col-span-full text-center py-16 text-slate-400 font-bold text-sm">
                        Belum ada artikel yang dipublikasikan.
                    </div>
                    @endforelse
                </div>

                <!-- Custom Pagination Links -->
                @if($articles->hasPages())
                <div class="pt-10 flex justify-center border-t border-slate-100">
                    {{ $articles->links() }}
                </div>
                @endif

            </div>
        </section>

@endsection
