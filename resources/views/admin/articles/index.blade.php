@extends('layouts.admin')

@section('title', 'Kelola Artikel - Pedulia')
@section('header-title', 'Kelola Artikel Edukasi')
@section('header-subtitle', 'Tulis informasi dan kabar terbaru')

@section('header-actions')
    <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center space-x-2 px-4.5 py-2.5 bg-primary text-charcoal font-bold rounded-xl text-xs shadow-[0_4px_12px_rgba(159,239,0,0.25)] hover:bg-primary-hover hover:shadow-[0_6px_16px_rgba(159,239,0,0.4)] transition-all cursor-pointer">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        <span>Tulis Artikel Baru</span>
    </a>
@endsection

@section('content')
    <!-- Data Table Panel -->
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 text-xs font-bold text-slate-400 uppercase tracking-wider">
                        <th class="pb-3.5 pl-2">Cover / Thumbnail</th>
                        <th class="pb-3.5">Judul Artikel</th>
                        <th class="pb-3.5">Penulis</th>
                        <th class="pb-3.5">Status</th>
                        <th class="pb-3.5">Tanggal Diterbitkan</th>
                        <th class="pb-3.5 text-right pr-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($articles as $article)
                    <tr class="group hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 pl-2">
                            <div class="h-12 w-20 bg-slate-100 rounded-lg overflow-hidden border border-slate-200 flex-shrink-0">
                                @if($article->thumbnail)
                                    <img src="{{ $article->thumbnail }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-400 text-xs font-bold uppercase">No Pic</div>
                                @endif
                            </div>
                        </td>
                        <td class="py-4 pr-4 font-bold text-charcoal leading-tight max-w-sm">
                            <span class="group-hover:text-primary-dark transition-colors">{{ $article->title }}</span>
                            <p class="text-[10px] text-slate-400 truncate font-medium mt-1">/articles/{{ $article->slug }}</p>
                        </td>
                        <td class="py-4 text-xs font-semibold text-charcoal">
                            {{ $article->author->name ?? 'Admin' }}
                        </td>
                        <td class="py-4">
                            @if($article->status === 'published')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">Diterbitkan</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">Draf</span>
                            @endif
                        </td>
                        <td class="py-4 text-xs font-semibold text-slate-400">
                            {{ $article->created_at->translatedFormat('d M Y, H:i') }}
                        </td>
                        <td class="py-4 text-right pr-2">
                            <div class="inline-flex items-center space-x-1.5">
                                <!-- Edit -->
                                <a href="{{ route('admin.articles.edit', $article->id) }}" class="p-1.5 text-slate-400 hover:text-charcoal hover:bg-slate-50 rounded-lg transition-all" title="Edit Artikel">
                                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <!-- Delete Form -->
                                <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all cursor-pointer" title="Hapus Artikel">
                                        <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-8 text-slate-400 font-semibold text-xs">
                            Belum ada artikel yang dibuat.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
