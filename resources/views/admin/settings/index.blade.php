@extends('layouts.admin')

@section('title', 'Pengaturan Pembayaran Manual')

@section('content')
<div class="space-y-6 max-w-4xl">
    <!-- Header Page -->
    <div>
        <h1 class="text-2xl font-black text-charcoal tracking-tight">Pengaturan Pembayaran & Kontak</h1>
        <p class="text-xs text-slate-400 font-semibold mt-0.5">Konfigurasi rekening bank transfer manual, upload QRIS, dan nomor WhatsApp admin</p>
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

    @if($errors->any())
    <div class="p-4 bg-rose-50 border border-rose-100 text-rose-700 text-xs font-bold rounded-2xl space-y-1">
        <div class="flex items-center space-x-2">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Mohon koreksi kesalahan berikut:</span>
        </div>
        <ul class="list-disc pl-6 space-y-0.5">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="bg-white border border-slate-100 rounded-3xl shadow-sm overflow-hidden p-6 md:p-8 space-y-8">
        @csrf

        <!-- QRIS Setting Section -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start border-b border-slate-100 pb-8">
            <div class="md:col-span-4 space-y-1">
                <h3 class="text-sm font-extrabold text-charcoal uppercase tracking-wider">Metode Pembayaran QRIS</h3>
                <p class="text-[11px] text-slate-400 font-semibold leading-relaxed">Upload gambar barcode QRIS yang akan discan oleh donatur saat memilih metode pembayaran QRIS.</p>
            </div>
            
            <div class="md:col-span-8 space-y-4">
                <!-- Current QRIS Preview -->
                <div class="flex items-start space-x-4">
                    <div class="w-36 h-36 border border-slate-200 rounded-2xl overflow-hidden bg-slate-50 p-1 flex-shrink-0 shadow-inner">
                        <img id="qris-preview" src="{{ $settings['qris_image'] }}" alt="QRIS Preview" class="w-full h-full object-contain">
                    </div>
                    <div class="space-y-2">
                        <label for="qris_image" class="block text-xs font-bold text-charcoal">Upload Foto QRIS Baru</label>
                        <input type="file" name="qris_image" id="qris_image" onchange="previewImage(this)" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary/10 file:text-charcoal-light hover:file:bg-primary/20 file:cursor-pointer">
                        <span class="block text-[10px] text-slate-400 font-semibold">Format yang didukung: JPG, PNG, JPEG, SVG. Maks 2MB.</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bank Account Setting Section -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start border-b border-slate-100 pb-8">
            <div class="md:col-span-4 space-y-1">
                <h3 class="text-sm font-extrabold text-charcoal uppercase tracking-wider">Transfer Bank Manual</h3>
                <p class="text-[11px] text-slate-400 font-semibold leading-relaxed">Informasi rekening bank tujuan donatur saat melakukan pembayaran via transfer bank.</p>
            </div>
            
            <div class="md:col-span-8 space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label for="bank_name" class="text-xs font-bold text-charcoal">Nama Bank</label>
                        <input type="text" name="bank_name" id="bank_name" value="{{ old('bank_name', $settings['bank_name']) }}" placeholder="Contoh: NOBU BANK" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold placeholder-slate-400 focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                    </div>

                    <div class="space-y-1.5">
                        <label for="bank_account_number" class="text-xs font-bold text-charcoal">Nomor Rekening</label>
                        <input type="text" name="bank_account_number" id="bank_account_number" value="{{ old('bank_account_number', $settings['bank_account_number']) }}" placeholder="Contoh: 1031-0988-1234" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold placeholder-slate-400 focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label for="bank_account_name" class="text-xs font-bold text-charcoal">Nama Pemilik Rekening (Atas Nama)</label>
                    <input type="text" name="bank_account_name" id="bank_account_name" value="{{ old('bank_account_name', $settings['bank_account_name']) }}" placeholder="Contoh: Yayasan Pedulia" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold placeholder-slate-400 focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                </div>
            </div>
        </div>

        <!-- WhatsApp Setting Section -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
            <div class="md:col-span-4 space-y-1">
                <h3 class="text-sm font-extrabold text-charcoal uppercase tracking-wider">Kontak Konfirmasi WhatsApp</h3>
                <p class="text-[11px] text-slate-400 font-semibold leading-relaxed">Nomor WhatsApp Admin untuk menerima bukti transfer / scan QRIS manual langsung dari halaman invoice donatur.</p>
            </div>
            
            <div class="md:col-span-8 space-y-1.5">
                <label for="whatsapp_number" class="text-xs font-bold text-charcoal">Nomor WhatsApp Admin</label>
                <div class="relative">
                    <input type="text" name="whatsapp_number" id="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number']) }}" placeholder="Contoh: 6281234567890" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold placeholder-slate-400 focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                </div>
                <span class="block text-[10px] text-amber-600 font-semibold leading-normal">
                    * Catatan: Gunakan format angka penuh dengan kode negara di awal (contoh: <strong>6281234567890</strong>), hindari menggunakan tanda + atau spasi.
                </span>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="pt-6 border-t border-slate-100 flex items-center justify-end">
            <button type="submit" class="px-8 py-3.5 bg-primary text-charcoal font-bold rounded-xl text-xs shadow-[0_4px_12px_rgba(159,239,0,0.3)] hover:bg-primary-hover hover:shadow-[0_6px_16px_rgba(159,239,0,0.5)] transition-all cursor-pointer">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('qris-preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
