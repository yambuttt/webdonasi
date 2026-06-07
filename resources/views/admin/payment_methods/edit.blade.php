@extends('layouts.admin')

@section('title', 'Edit Metode Pembayaran - Pedulia')

@section('content')
<div class="space-y-6 max-w-3xl">
    <!-- Header Page -->
    <div>
        <a href="{{ route('admin.payment-methods.index') }}" class="inline-flex items-center space-x-1.5 text-xs font-bold text-slate-400 hover:text-charcoal transition-colors mb-3">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Kembali ke Daftar</span>
        </a>
        <h1 class="text-2xl font-black text-charcoal tracking-tight">Edit Metode Pembayaran</h1>
        <p class="text-xs text-slate-400 font-semibold mt-0.5">Perbarui konfigurasi metode pembayaran donasi Anda</p>
    </div>

    <!-- Form Card -->
    <form action="{{ route('admin.payment-methods.update', $paymentMethod->id) }}" method="POST" enctype="multipart/form-data" class="bg-white border border-slate-100 rounded-3xl shadow-sm p-6 md:p-8 space-y-6">
        @csrf
        @method('PUT')

        @if($errors->any())
        <div class="p-4 bg-rose-50 border border-rose-100 text-rose-700 text-xs font-bold rounded-2xl space-y-1">
            <ul class="list-disc pl-6 space-y-0.5">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name Field -->
            <div class="space-y-2">
                <label for="name" class="block text-xs font-bold text-charcoal">Nama Metode Pembayaran (Wajib)</label>
                <input type="text" name="name" id="name" required value="{{ old('name', $paymentMethod->name) }}" placeholder="Contoh: QRIS GoPay, Bank Mandiri" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs font-bold placeholder-slate-400 focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
            </div>

            <!-- Type Selector -->
            <div class="space-y-2">
                <label for="type" class="block text-xs font-bold text-charcoal">Tipe Metode Pembayaran</label>
                <select name="type" id="type" onchange="toggleFields(this.value)" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs font-bold text-charcoal focus:outline-none focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                    <option value="qris" {{ old('type', $paymentMethod->type) === 'qris' ? 'selected' : '' }}>QRIS</option>
                    <option value="bank" {{ old('type', $paymentMethod->type) === 'bank' ? 'selected' : '' }}>Transfer Bank</option>
                </select>
            </div>
        </div>

        <!-- Logo Upload Field (Both) -->
        <div class="space-y-2.5 border-t border-slate-50 pt-5">
            <label class="block text-xs font-bold text-charcoal">Logo Metode Pembayaran (Opsional)</label>
            <div class="flex items-center space-x-4">
                <div class="w-20 h-14 border border-slate-200 rounded-xl overflow-hidden bg-slate-50 p-1 flex-shrink-0 flex items-center justify-center shadow-inner">
                    <img id="logo-preview" src="{{ $paymentMethod->logo }}" alt="Preview Logo" class="w-full h-full object-contain {{ $paymentMethod->logo ? '' : 'hidden' }}">
                    <span id="logo-placeholder" class="text-[9px] text-slate-400 font-extrabold uppercase text-center {{ $paymentMethod->logo ? 'hidden' : '' }}">No Logo</span>
                </div>
                <div class="space-y-1">
                    <input type="file" name="logo" id="logo" onchange="previewFile(this, 'logo-preview', 'logo-placeholder')" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary/10 file:text-charcoal-light hover:file:bg-primary/20 file:cursor-pointer">
                    <span class="block text-[10px] text-slate-400 font-semibold">Biarkan kosong jika tidak ingin mengubah logo saat ini.</span>
                </div>
            </div>
        </div>

        <!-- DYNAMIC FIELD: QRIS Fields -->
        <div id="qris-fields-container" class="space-y-2.5 border-t border-slate-50 pt-5">
            <label class="block text-xs font-bold text-charcoal">Gambar Barcode QRIS</label>
            <div class="flex items-center space-x-4">
                <div class="w-28 h-28 border border-slate-200 rounded-2xl overflow-hidden bg-slate-50 p-1 flex-shrink-0 flex items-center justify-center shadow-inner">
                    <img id="qris-preview" src="{{ $paymentMethod->qris_image }}" alt="Preview QRIS" class="w-full h-full object-contain {{ $paymentMethod->qris_image ? '' : 'hidden' }}">
                    <span id="qris-placeholder" class="text-[9px] text-slate-400 font-extrabold uppercase text-center {{ $paymentMethod->qris_image ? 'hidden' : '' }}">No Image</span>
                </div>
                <div class="space-y-1">
                    <input type="file" name="qris_image" id="qris_image" onchange="previewFile(this, 'qris-preview', 'qris-placeholder')" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary/10 file:text-charcoal-light hover:file:bg-primary/20 file:cursor-pointer">
                    <span class="block text-[10px] text-slate-400 font-semibold">Biarkan kosong jika tidak ingin mengubah gambar QRIS saat ini.</span>
                </div>
            </div>
        </div>

        <!-- DYNAMIC FIELD: Bank Fields -->
        <div id="bank-fields-container" class="space-y-5 border-t border-slate-50 pt-5 hidden">
            <h3 class="text-xs font-extrabold text-charcoal uppercase tracking-wider">Detail Rekening Penerima</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div class="space-y-2">
                    <label for="bank_name" class="block text-xs font-bold text-charcoal">Nama Bank (Wajib)</label>
                    <input type="text" name="bank_name" id="bank_name" value="{{ old('bank_name', $paymentMethod->bank_name) }}" placeholder="Contoh: BANK MANDIRI, BNI" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs font-bold placeholder-slate-400 focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                </div>

                <div class="space-y-2">
                    <label for="bank_account_number" class="block text-xs font-bold text-charcoal">Nomor Rekening (Wajib)</label>
                    <input type="text" name="bank_account_number" id="bank_account_number" value="{{ old('bank_account_number', $paymentMethod->bank_account_number) }}" placeholder="Contoh: 123-456-7890" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs font-bold placeholder-slate-400 focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                </div>

                <div class="space-y-2">
                    <label for="bank_account_name" class="block text-xs font-bold text-charcoal">Nama Pemilik Rekening (Wajib)</label>
                    <input type="text" name="bank_account_name" id="bank_account_name" value="{{ old('bank_account_name', $paymentMethod->bank_account_name) }}" placeholder="Contoh: Yayasan Pedulia" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs font-bold placeholder-slate-400 focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                </div>
            </div>
        </div>

        <!-- Status & Actions -->
        <div class="border-t border-slate-100 pt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center space-x-3">
                <input type="hidden" name="status" value="0">
                <input type="checkbox" name="status" id="status" value="1" {{ old('status', $paymentMethod->status) ? 'checked' : '' }} class="h-4.5 w-4.5 rounded border-slate-300 text-slate-900 focus:ring-slate-900 focus:ring-offset-0">
                <label for="status" class="text-xs font-bold text-charcoal cursor-pointer">Metode Pembayaran ini aktif</label>
            </div>
            
            <div class="flex items-center space-x-3.5">
                <a href="{{ route('admin.payment-methods.index') }}" class="px-5 py-3 bg-slate-100 hover:bg-slate-200 text-charcoal font-bold rounded-2xl text-xs transition-all text-center">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 bg-primary text-charcoal font-extrabold rounded-2xl text-xs shadow-[0_4px_12px_rgba(159,239,0,0.25)] hover:bg-primary-hover hover:scale-[1.02] active:scale-[0.98] transition-all cursor-pointer">
                    Simpan Perubahan
                </button>
            </div>
        </div>

    </form>
</div>

<script>
    function toggleFields(type) {
        const qrisContainer = document.getElementById('qris-fields-container');
        const bankContainer = document.getElementById('bank-fields-container');
        const bankNameInput = document.getElementById('bank_name');
        const bankNumberInput = document.getElementById('bank_account_number');
        const bankNameAccInput = document.getElementById('bank_account_name');

        if (type === 'qris') {
            qrisContainer.classList.remove('hidden');
            bankContainer.classList.add('hidden');
            bankNameInput.removeAttribute('required');
            bankNumberInput.removeAttribute('required');
            bankNameAccInput.removeAttribute('required');
        } else {
            qrisContainer.classList.add('hidden');
            bankContainer.classList.remove('hidden');
            bankNameInput.setAttribute('required', 'required');
            bankNumberInput.setAttribute('required', 'required');
            bankNameAccInput.setAttribute('required', 'required');
        }
    }

    function previewFile(input, previewId, placeholderId) {
        const preview = document.getElementById(previewId);
        const placeholder = document.getElementById(placeholderId);
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                if (placeholder) placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Set initial state
    document.addEventListener('DOMContentLoaded', () => {
        toggleFields(document.getElementById('type').value);
    });
</script>
@endsection
