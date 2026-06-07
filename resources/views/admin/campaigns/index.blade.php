@extends('layouts.admin')

@section('title', 'Kelola Kampanye - Pedulia')
@section('header-title', 'Kelola Kampanye Donasi')
@section('header-subtitle', 'Pantau, edit, dan buat kampanye penggalangan dana')

@section('header-actions')
    <a href="{{ route('admin.campaigns.create') }}" class="inline-flex items-center space-x-2 px-4.5 py-2.5 bg-primary text-charcoal font-bold rounded-xl text-xs shadow-[0_4px_12px_rgba(159,239,0,0.25)] hover:bg-primary-hover hover:shadow-[0_6px_16px_rgba(159,239,0,0.4)] transition-all cursor-pointer">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        <span>Buat Kampanye Baru</span>
    </a>
@endsection

@section('content')
    <!-- Data Table Panel -->
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 text-xs font-bold text-slate-400 uppercase tracking-wider">
                        <th class="pb-3.5 pl-2">Thumbnail</th>
                        <th class="pb-3.5">Judul Kampanye</th>
                        <th class="pb-3.5">Kategori</th>
                        <th class="pb-3.5">Progress Dana</th>
                        <th class="pb-3.5">Status</th>
                        <th class="pb-3.5">Sisa Hari</th>
                        <th class="pb-3.5 text-right pr-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($campaigns as $campaign)
                    <tr class="group hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 pl-2">
                            <div class="h-12 w-20 bg-slate-100 rounded-lg overflow-hidden border border-slate-200 flex-shrink-0">
                                @if($campaign->thumbnail)
                                    <img src="{{ $campaign->thumbnail }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-400 text-xs font-bold uppercase">No Thumbnail</div>
                                @endif
                            </div>
                        </td>
                        <td class="py-4 pr-4 font-bold text-charcoal leading-tight max-w-xs md:max-w-sm">
                            <span class="group-hover:text-primary-dark transition-colors">{{ $campaign->title }}</span>
                            <p class="text-[10px] text-slate-400 truncate font-medium mt-1">/campaigns/{{ $campaign->slug }}</p>
                        </td>
                        <td class="py-4">
                            <span class="inline-block px-2.5 py-0.5 text-[10px] font-bold text-slate-600 bg-slate-100 rounded-md">
                                @if($campaign->category === 'kesehatan')
                                    Kesehatan
                                @elseif($campaign->category === 'bencana')
                                    Bencana Alam
                                @else
                                    Pendidikan
                                @endif
                            </span>
                        </td>
                        <td class="py-4 w-48">
                            <div class="space-y-1">
                                <div class="flex items-center justify-between text-xs font-bold text-charcoal">
                                    <span>{{ $campaign->percentage }}%</span>
                                    <span class="text-[10px] text-slate-400 font-semibold">Rp {{ number_format($campaign->current_amount, 0, ',', '.') }} / {{ number_format($campaign->target_amount, 0, ',', '.') }}</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                    <div class="bg-primary h-full rounded-full" style="width: {{ $campaign->percentage }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4">
                            @if($campaign->status === 'active')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">Aktif</span>
                            @elseif($campaign->status === 'completed')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">Selesai</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">Draf</span>
                            @endif
                        </td>
                        <td class="py-4 text-xs font-bold text-charcoal">
                            {{ $campaign->days_remaining }} Hari
                        </td>
                        <td class="py-4 text-right pr-2">
                            <div class="inline-flex items-center space-x-1.5">
                                <!-- Edit -->
                                <a href="{{ route('admin.campaigns.edit', $campaign->id) }}" class="p-1.5 text-slate-400 hover:text-charcoal hover:bg-slate-50 rounded-lg transition-all" title="Edit Kampanye">
                                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <!-- Delete Form -->
                                <form action="{{ route('admin.campaigns.destroy', $campaign->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kampanye ini?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all cursor-pointer" title="Hapus Kampanye">
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
                        <td colspan="7" class="text-center py-8 text-slate-400 font-semibold text-xs">
                            Belum ada kampanye yang dibuat.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
