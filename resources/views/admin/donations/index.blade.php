@extends('layouts.admin')

@section('title', 'Kelola Transaksi Donasi')

@section('content')
<div class="space-y-6">
    <!-- Header Page -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-charcoal tracking-tight">Kelola Transaksi Donasi</h1>
            <p class="text-xs text-slate-400 font-semibold mt-0.5">Konfirmasi manual donasi masuk dari QRIS dan Transfer Bank</p>
        </div>
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

    @if(session('error'))
    <div class="p-4 bg-rose-50 border border-rose-100 text-rose-700 text-xs font-bold rounded-2xl flex items-center space-x-2">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('error') }}</span>
    </div>
    @endif

    <!-- Filters Status Tabs -->
    <div class="flex items-center space-x-1 overflow-x-auto bg-white border border-slate-100 p-1 rounded-2xl shadow-sm max-w-md">
        <a href="{{ route('admin.donations.index') }}" 
           class="px-4 py-2 text-xs font-bold rounded-xl transition-all cursor-pointer whitespace-nowrap {{ !$status ? 'bg-charcoal text-white shadow-sm' : 'text-slate-500 hover:text-charcoal' }}">
            Semua
        </a>
        <a href="{{ route('admin.donations.index', ['status' => 'pending']) }}" 
           class="px-4 py-2 text-xs font-bold rounded-xl transition-all cursor-pointer whitespace-nowrap {{ $status === 'pending' ? 'bg-charcoal text-white shadow-sm' : 'text-slate-500 hover:text-charcoal' }}">
            Pending
        </a>
        <a href="{{ route('admin.donations.index', ['status' => 'confirmed']) }}" 
           class="px-4 py-2 text-xs font-bold rounded-xl transition-all cursor-pointer whitespace-nowrap {{ $status === 'confirmed' ? 'bg-charcoal text-white shadow-sm' : 'text-slate-500 hover:text-charcoal' }}">
            Dikonfirmasi
        </a>
        <a href="{{ route('admin.donations.index', ['status' => 'cancelled']) }}" 
           class="px-4 py-2 text-xs font-bold rounded-xl transition-all cursor-pointer whitespace-nowrap {{ $status === 'cancelled' ? 'bg-charcoal text-white shadow-sm' : 'text-slate-500 hover:text-charcoal' }}">
            Dibatalkan
        </a>
    </div>

    <!-- Table Card -->
    <div class="bg-white border border-slate-100 rounded-3xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100 text-left">
                <thead class="bg-slate-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-xs font-extrabold text-slate-500 uppercase tracking-wider">Invoice / Tanggal</th>
                        <th scope="col" class="px-6 py-4 text-xs font-extrabold text-slate-500 uppercase tracking-wider">Kampanye</th>
                        <th scope="col" class="px-6 py-4 text-xs font-extrabold text-slate-500 uppercase tracking-wider">Donatur</th>
                        <th scope="col" class="px-6 py-4 text-xs font-extrabold text-slate-500 uppercase tracking-wider">Total Transfer</th>
                        <th scope="col" class="px-6 py-4 text-xs font-extrabold text-slate-500 uppercase tracking-wider">Metode</th>
                        <th scope="col" class="px-6 py-4 text-xs font-extrabold text-slate-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-4 text-xs font-extrabold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($donations as $don)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <!-- Invoice & Date -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-xs font-bold text-charcoal">{{ $don->invoice_number }}</div>
                            <div class="text-[10px] text-slate-400 font-semibold mt-0.5">{{ $don->created_at->setTimezone('Asia/Jakarta')->format('d M Y - H:i') }} WIB</div>
                        </td>
                        <!-- Campaign -->
                        <td class="px-6 py-4">
                            <div class="text-xs font-bold text-charcoal line-clamp-2 max-w-xs">{{ $don->campaign->title }}</div>
                        </td>
                        <!-- Donor Info -->
                        <td class="px-6 py-4">
                            <div class="text-xs font-bold text-charcoal">{{ $don->donor_name }}</div>
                            @if($don->donor_email)
                            <div class="text-[10px] text-slate-400 font-semibold mt-0.5">{{ $don->donor_email }}</div>
                            @endif
                            @if($don->comment)
                            <div class="mt-2 p-2 bg-slate-50 border border-slate-200/60 rounded-xl max-w-xs text-[10px] font-medium text-slate-600">
                                <span class="font-extrabold block text-slate-400 uppercase text-[8px] tracking-wider mb-0.5">Pesan/Doa:</span>
                                <span class="italic">"{{ $don->comment }}"</span>
                                
                                <div class="mt-1.5 flex items-center justify-between border-t border-slate-200/40 pt-1.5">
                                    <span class="text-[8px] font-bold text-slate-400 flex items-center">
                                        Status: 
                                        @if($don->is_comment_visible)
                                            <span class="text-emerald-600 ml-1">Tampil</span>
                                        @else
                                            <span class="text-rose-600 ml-1">Tersembunyi</span>
                                        @endif
                                    </span>
                                    <form action="{{ route('admin.donations.toggle-comment', $don->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-1.5 py-0.5 bg-white border border-slate-200 hover:bg-slate-100 text-charcoal font-bold rounded text-[8px] cursor-pointer transition-colors">
                                            {{ $don->is_comment_visible ? 'Sembunyikan' : 'Tampilkan' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endif
                        </td>
                        <!-- Total Amount & Breakdown -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-xs font-extrabold text-charcoal">Rp {{ number_format($don->total_amount, 0, ',', '.') }}</div>
                            <div class="text-[10px] text-slate-400 font-semibold mt-0.5">
                                Rp {{ number_format($don->nominal, 0, ',', '.') }} + <span class="text-primary-dark font-bold">{{ $don->unique_code }}</span>
                            </div>
                        </td>
                        <!-- Payment Method -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-block px-2.5 py-0.5 bg-slate-100 border border-slate-200 text-slate-600 rounded text-[10px] font-bold uppercase">
                                {{ $don->payment_method === 'qris' ? 'QRIS' : 'Bank Nobu' }}
                            </span>
                        </td>
                        <!-- Status Badge -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider
                                @if($don->status === 'pending') bg-amber-50 text-amber-600 border border-amber-100
                                @elseif($don->status === 'confirmed') bg-emerald-50 text-emerald-600 border border-emerald-100
                                @else bg-rose-50 text-rose-600 border border-rose-100 @endif">
                                {{ $don->status === 'pending' ? 'Pending' : ($don->status === 'confirmed' ? 'Diterima' : 'Batal') }}
                            </span>
                        </td>
                        <!-- Actions -->
                        <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                            @if($don->status === 'pending')
                            <div class="flex items-center justify-end space-x-2">
                                <!-- Confirm Form -->
                                <form action="{{ route('admin.donations.confirm', $don->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengonfirmasi pembayaran donasi ini?');">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 bg-primary hover:bg-primary-hover text-charcoal font-bold rounded-lg text-[10px] cursor-pointer transition-colors shadow-sm">
                                        Konfirmasi
                                    </button>
                                </form>
                                <!-- Cancel Form -->
                                <form action="{{ route('admin.donations.cancel', $don->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan transaksi donasi ini?');">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-rose-600 font-bold rounded-lg text-[10px] cursor-pointer transition-colors">
                                        Batalkan
                                    </button>
                                </form>
                            </div>
                            @elseif($don->status === 'cancelled')
                            <div class="flex items-center justify-end">
                                <!-- Confirm Form (For cancelled/expired items that were actually paid) -->
                                <form action="{{ route('admin.donations.confirm', $don->id) }}" method="POST" onsubmit="return confirm('Donasi ini sudah dibatalkan/expired. Apakah Anda yakin ingin tetap mengonfirmasi pembayaran donasi ini?');">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 bg-primary hover:bg-primary-hover text-charcoal font-bold rounded-lg text-[10px] cursor-pointer transition-colors shadow-sm">
                                        Konfirmasi
                                    </button>
                                </form>
                            </div>
                            @else
                            <span class="text-[10px] text-slate-400 font-semibold">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-xs font-semibold text-slate-400">
                            Tidak ada data transaksi donasi ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($donations->hasPages())
        <div class="bg-slate-50 px-6 py-4 border-t border-slate-100">
            {{ $donations->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
