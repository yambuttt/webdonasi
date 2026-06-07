@extends('layouts.admin')

@section('title', 'Kelola Metode Pembayaran - Pedulia')

@section('content')
<div class="space-y-6">
    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-charcoal tracking-tight">Metode Pembayaran</h1>
            <p class="text-xs text-slate-400 font-semibold mt-0.5">Kelola opsi pembayaran yang tersedia bagi donatur (QRIS, Transfer Bank, dll)</p>
        </div>
        <a href="{{ route('admin.payment-methods.create') }}" class="inline-flex items-center space-x-2 px-5 py-3 bg-primary text-charcoal font-extrabold rounded-2xl text-xs shadow-[0_4px_14px_rgba(159,239,0,0.3)] hover:bg-primary-hover hover:scale-[1.02] active:scale-[0.98] transition-all cursor-pointer">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>
            <span>Tambah Metode Pembayaran</span>
        </a>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
    <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 text-xs font-bold rounded-2xl flex items-center space-x-2">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <!-- Table Card -->
    <div class="bg-white border border-slate-100 rounded-3xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/75 border-b border-slate-100 text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">
                        <th class="py-4.5 px-6">Logo</th>
                        <th class="py-4.5 px-6">Nama Metode</th>
                        <th class="py-4.5 px-6">Tipe</th>
                        <th class="py-4.5 px-6">Detail / Tujuan</th>
                        <th class="py-4.5 px-6">Status</th>
                        <th class="py-4.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs font-bold text-charcoal">
                    @forelse($paymentMethods as $pm)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-4.5 px-6">
                            @if($pm->logo)
                            <img src="{{ $pm->logo }}" alt="{{ $pm->name }}" class="w-12 h-8 object-contain rounded border border-slate-200 p-0.5 bg-white">
                            @else
                            <div class="w-12 h-8 rounded border border-slate-100 bg-slate-50 flex items-center justify-center text-[9px] text-slate-400 font-extrabold uppercase">
                                No Logo
                            </div>
                            @endif
                        </td>
                        <td class="py-4.5 px-6 font-extrabold text-slate-900">
                            {{ $pm->name }}
                        </td>
                        <td class="py-4.5 px-6">
                            <span class="inline-block px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase {{ $pm->type === 'qris' ? 'bg-indigo-50 text-indigo-700 border border-indigo-100' : 'bg-emerald-50 text-emerald-700 border border-emerald-100' }}">
                                {{ $pm->type === 'qris' ? 'QRIS' : 'Bank Transfer' }}
                            </span>
                        </td>
                        <td class="py-4.5 px-6">
                            @if($pm->type === 'qris')
                                @if($pm->qris_image)
                                <a href="{{ $pm->qris_image }}" target="_blank" class="inline-flex items-center space-x-1 text-primary-hover hover:underline font-bold text-xs">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>Lihat Gambar QRIS</span>
                                </a>
                                @else
                                <span class="text-slate-400">Gambar QRIS tidak diset</span>
                                @endif
                            @else
                            <div class="flex flex-col space-y-0.5 text-[11px] font-semibold text-slate-500">
                                <div><span class="font-extrabold text-charcoal">Bank:</span> {{ $pm->bank_name }}</div>
                                <div><span class="font-extrabold text-charcoal">Rek:</span> {{ $pm->bank_account_number }}</div>
                                <div><span class="font-extrabold text-charcoal">A/N:</span> {{ $pm->bank_account_name }}</div>
                            </div>
                            @endif
                        </td>
                        <td class="py-4.5 px-6">
                            <span class="inline-block h-2 w-2 rounded-full {{ $pm->status ? 'bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.6)]' : 'bg-rose-400' }} mr-1.5"></span>
                            <span class="font-extrabold text-[11px] uppercase {{ $pm->status ? 'text-emerald-600' : 'text-slate-400' }}">
                                {{ $pm->status ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="py-4.5 px-6 text-right">
                            <div class="flex items-center justify-end space-x-2.5">
                                <a href="{{ route('admin.payment-methods.edit', $pm->id) }}" class="p-2 border border-slate-200 text-slate-400 hover:text-slate-700 hover:border-slate-400 rounded-xl transition-all cursor-pointer">
                                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.payment-methods.destroy', $pm->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus metode pembayaran ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 border border-slate-200 text-slate-400 hover:text-rose-600 hover:border-rose-300 rounded-xl transition-all cursor-pointer">
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
                        <td colspan="6" class="py-12 px-6 text-center text-slate-400">
                            Belum ada metode pembayaran yang dikonfigurasi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
