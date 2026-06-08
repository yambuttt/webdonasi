@extends('layouts.app')

@section('title', 'Invoice Pembayaran Donasi - Pedulia')

@section('content')
<div class="py-12 bg-slate-50 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">
        
        <!-- Status Notification Box -->
        <div class="bg-white border border-slate-100 rounded-3xl shadow-sm p-6 md:p-8 text-center space-y-6">
            
            @if($donation->status === 'pending')
            <div id="payment-status-checker" class="p-4 bg-sky-50/70 border border-sky-100 text-sky-700 text-xs font-bold rounded-2xl flex items-center justify-center space-x-2.5 shadow-sm">
                <svg class="animate-spin h-4 w-4 text-sky-600 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="text-left leading-relaxed">Sistem memantau pembayaran Anda secara otomatis. Halaman ini akan diperbarui ketika pembayaran terdeteksi.</span>
            </div>
            @endif

            <!-- Invoice Header -->
            <div class="border-b border-slate-100 pb-5 space-y-2">
                <span class="inline-flex items-center px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                    @if($donation->status === 'pending') bg-amber-50 text-amber-600 border border-amber-100
                    @elseif($donation->status === 'confirmed') bg-emerald-50 text-emerald-600 border border-emerald-100
                    @else bg-rose-50 text-rose-600 border border-rose-100 @endif">
                    Status: {{ $donation->status === 'pending' ? 'Menunggu Pembayaran' : ($donation->status === 'confirmed' ? 'Pembayaran Diterima' : 'Dibatalkan') }}
                </span>
                
                <h1 class="text-xl font-extrabold text-charcoal">Invoice #{{ $donation->invoice_number }}</h1>
                <p class="text-xs text-slate-400 font-semibold">Dibuat pada {{ $donation->created_at->setTimezone('Asia/Jakarta')->format('d M Y - H:i') }} WIB</p>
            </div>

            <!-- Payment Amount Highlight -->
            <div class="py-4 bg-slate-50 rounded-2xl border border-slate-100 space-y-2">
                @if($donation->status === 'pending')
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Jumlah yang Wajib Ditransfer</span>
                    <div class="text-3xl md:text-4xl font-extrabold text-charcoal tracking-tight flex justify-center items-baseline">
                        Rp {{ number_format(floor($donation->total_amount / 1000), 0, ',', '.') }}<span class="text-primary-dark font-black underline decoration-primary decoration-4">{{ sprintf('%03d', $donation->unique_code) }}</span>
                    </div>
                    <p class="text-[11px] text-amber-600 font-bold px-4 leading-relaxed">
                        <svg class="h-3.5 w-3.5 inline mr-1 -mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        PENTING: Transfer tepat sampai 3 digit terakhir agar donasi terverifikasi otomatis / manual dengan cepat!
                    </p>
                @else
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Donasi Terbayar</span>
                    <div class="text-3xl md:text-4xl font-extrabold text-emerald-600 tracking-tight flex justify-center items-baseline">
                        Rp {{ number_format($donation->total_amount, 0, ',', '.') }}
                    </div>
                    <p class="text-[11px] text-emerald-600 font-bold px-4 leading-relaxed">
                        <svg class="h-3.5 w-3.5 inline mr-1 -mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Donasi berhasil diverifikasi dan masuk ke kas kampanye.
                    </p>
                @endif
            </div>

            <!-- Payment instructions based on method -->
            @if($donation->status === 'pending')
            <div class="space-y-4">
                <h3 class="text-sm font-extrabold text-charcoal uppercase tracking-wider text-left border-b border-slate-100 pb-2">Instruksi Pembayaran</h3>
                
                @if(($paymentMethod && $paymentMethod->type === 'qris') || $donation->payment_method === 'qris')
                    <!-- QRIS Instructions -->
                    <div class="flex flex-col items-center space-y-4">
                        <div class="relative w-80 h-80 mx-auto select-none bg-white rounded-3xl p-1 shadow-md border border-slate-100 flex items-center justify-center">
                            <!-- Background Template -->
                            <img src="{{ asset('images/qris_template.png') }}" alt="QRIS Template" class="w-full h-full object-contain rounded-2xl">
                            <!-- QR Code Overlayed in the center -->
                            <div class="absolute inset-0 flex items-center justify-center" style="transform: translateY(-2.5%);">
                                <div class="w-[43%] h-[43%] bg-white flex items-center justify-center p-0.5">
                                    @if($donation->cashify_qr_string)
                                        <img src="https://larabert-qrgen.hf.space/v1/create-qr-code?size=300x300&style=2&color=000000&data={{ urlencode($donation->cashify_qr_string) }}" alt="QRIS Barcode Dinamis" class="w-full h-full object-contain">
                                    @else
                                        <img src="{{ $paymentMethod ? $paymentMethod->qris_image : App\Models\Setting::get('qris_image', '/images/qris.png') }}" alt="QRIS Barcode" class="w-full h-full object-contain">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="text-left text-xs font-semibold text-slate-500 leading-relaxed space-y-2 max-w-md">
                            @if($donation->cashify_qr_string)
                                <p class="font-bold text-charcoal text-center text-sm">Scan QRIS Dinamis Pedulia</p>
                            @else
                                <p class="font-bold text-charcoal text-center text-sm">Scan QRIS {{ $paymentMethod ? $paymentMethod->name : 'Pedulia' }}</p>
                            @endif
                            <ol class="list-decimal pl-5 space-y-1">
                                <li>Buka aplikasi dompet digital Anda (GoPay, OVO, Dana, LinkAja, ShopeePay, BCA Mobile, dll).</li>
                                <li>Pilih menu scan/bayar lalu scan barcode di atas.</li>
                                <li>Masukkan nominal transfer persis senilai <strong class="text-charcoal font-black">Rp {{ number_format($donation->total_amount, 0, ',', '.') }}</strong>.</li>
                                <li>Selesaikan transaksi pembayaran Anda.</li>
                            </ol>
                        </div>
                    </div>
                @else
                    <!-- Transfer Bank Instructions -->
                    <div class="space-y-4 text-left">
                        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 space-y-3">
                            <div class="flex justify-between items-center text-xs border-b border-slate-200/50 pb-2">
                                <span class="text-slate-400 font-bold">Bank Penerima</span>
                                <span class="text-charcoal font-black uppercase text-sm">{{ $paymentMethod ? $paymentMethod->bank_name : App\Models\Setting::get('bank_name', 'NOBU BANK') }}</span>
                            </div>
                            <div class="flex justify-between items-center text-xs border-b border-slate-200/50 pb-2">
                                <span class="text-slate-400 font-bold">Nomor Rekening</span>
                                <div class="flex items-center space-x-2">
                                    <span class="text-charcoal font-black text-sm tracking-wider">{{ $paymentMethod ? $paymentMethod->bank_account_number : App\Models\Setting::get('bank_account_number', '1031-0988-1234') }}</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-center text-xs pb-1">
                                <span class="text-slate-400 font-bold">Nama Rekening</span>
                                <span class="text-charcoal font-black text-sm">{{ $paymentMethod ? $paymentMethod->bank_account_name : App\Models\Setting::get('bank_account_name', 'Yayasan Pedulia') }}</span>
                            </div>
                        </div>

                        <div class="text-xs font-semibold text-slate-500 leading-relaxed space-y-2">
                            <p class="font-bold text-charcoal">Petunjuk Transfer Bank:</p>
                            <ol class="list-decimal pl-5 space-y-1">
                                <li>Lakukan transfer ATM, Mobile Banking, atau Internet Banking ke rekening {{ $paymentMethod ? $paymentMethod->bank_name : App\Models\Setting::get('bank_name', 'NOBU BANK') }} di atas.</li>
                                <li>Pastikan jumlah transfer sama persis dengan nominal wajib transfer: <strong class="text-charcoal font-black text-sm">Rp {{ number_format($donation->total_amount, 0, ',', '.') }}</strong>.</li>
                                <li>Simpan bukti transfer sebagai bukti sah pembayaran Anda.</li>
                            </ol>
                        </div>
                    </div>
                @endif
            </div>
            @else
            <!-- Success Thank You Alert Box -->
            <div class="p-6 bg-emerald-50 border border-emerald-100 rounded-3xl text-center space-y-4 shadow-sm">
                <div class="w-16 h-16 bg-emerald-500 rounded-full flex items-center justify-center mx-auto text-white shadow-lg shadow-emerald-500/20">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="space-y-1.5">
                    <h3 class="text-base font-extrabold text-charcoal">Terima Kasih Atas Kepedulian Anda!</h3>
                    <p class="text-xs text-slate-500 font-medium leading-relaxed max-w-md mx-auto">Donasi Anda telah kami terima secara penuh dan sah. Dana donasi akan segera disalurkan ke penerima manfaat program kampanye ini.</p>
                </div>
            </div>
            @endif

            <!-- Donation Details Table -->
            <div class="space-y-3 text-left">
                <h3 class="text-sm font-extrabold text-charcoal uppercase tracking-wider border-b border-slate-100 pb-2">Detail Donatur & Kampanye</h3>
                <div class="bg-white rounded-2xl border border-slate-100 p-5 space-y-3 text-xs">
                    <div class="flex justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-400 font-semibold">Kampanye Pilihan:</span>
                        <span class="text-charcoal font-bold text-right max-w-[200px] md:max-w-none">{{ $donation->campaign->title }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-400 font-semibold">Nama Donatur:</span>
                        <span class="text-charcoal font-bold">{{ $donation->donor_name }}</span>
                    </div>
                    @if($donation->donor_email)
                    <div class="flex justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-400 font-semibold">Kontak Donatur:</span>
                        <span class="text-charcoal font-bold">{{ $donation->donor_email }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-400 font-semibold">Nominal Pokok Donasi:</span>
                        <span class="text-charcoal font-bold">Rp {{ number_format($donation->nominal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-400 font-semibold">Kode Unik:</span>
                        <span class="text-primary-dark font-extrabold">+Rp {{ $donation->unique_code }}</span>
                    </div>
                    <div class="flex justify-between py-1">
                        <span class="text-slate-400 font-bold">Metode Pembayaran:</span>
                        <span class="text-charcoal font-extrabold bg-slate-100 px-2 py-0.5 rounded text-[10px]">{{ $paymentMethod ? $paymentMethod->name : ($donation->payment_method === 'qris' ? 'QRIS Statis' : 'Transfer Bank') }}</span>
                    </div>
                </div>
            </div>

            <!-- Footer Action Buttons -->
            <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/" class="w-full sm:w-auto px-8 py-3.5 bg-slate-100 hover:bg-slate-200 text-charcoal font-bold rounded-2xl text-xs text-center transition-all cursor-pointer">
                    Kembali ke Beranda
                </a>
                
                @if($donation->status === 'pending')
                <button id="btn-check-payment"
                        class="w-full sm:w-auto px-8 py-3.5 bg-primary hover:bg-primary-hover text-charcoal font-bold rounded-2xl text-xs text-center shadow-[0_4px_12px_rgba(159,239,0,0.3)] hover:shadow-[0_6px_16px_rgba(159,239,0,0.5)] transition-all cursor-pointer flex items-center justify-center space-x-2">
                    <svg id="btn-check-spinner" class="animate-spin -ml-1 mr-2 h-4 w-4 text-charcoal hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Cek Status Pembayaran</span>
                </button>

                <a href="https://wa.me/{{ App\Models\Setting::get('whatsapp_number', '6281234567890') }}?text=Halo%20Admin%20Pedulia%2C%20saya%20ingin%20konfirmasi%20pembayaran%20donasi%20dengan%20Invoice%20%23{{ $donation->invoice_number }}%20sebesar%20Rp%20{{ number_format($donation->total_amount, 0, ',', '.') }}." 
                   target="_blank"
                   class="w-full sm:w-auto px-8 py-3.5 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-2xl text-xs text-center shadow-[0_4px_12px_rgba(16,185,129,0.3)] transition-all cursor-pointer flex items-center justify-center space-x-2">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.513 2.262 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.455L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.885-6.966C16.59 1.977 14.113.953 11.49.953c-5.44 0-9.866 4.372-9.87 9.802 0 1.763.486 3.486 1.408 5.016l-.997 3.642 3.734-.969c1.5.819 3.013 1.25 4.882 1.252zm11.026-7.502c-.3-.15-1.772-.875-2.046-.975-.276-.1-.477-.15-.677.15-.2.3-.777.975-.952 1.175-.177.2-.352.225-.652.075-.3-.15-1.264-.467-2.408-1.488-.89-.793-1.49-1.773-1.665-2.075-.175-.3-.019-.462.13-.611.135-.133.3-.35.45-.525.15-.175.2-.3.3-.5.1-.2.05-.375-.025-.525-.075-.15-.677-1.625-.927-2.225-.244-.589-.492-.51-.677-.52l-.577-.01c-.2-.008-.525.067-.8.367-.275.3-1.05 1.026-1.05 2.5 0 1.475 1.075 2.9 1.225 3.1.15.2 2.11 3.22 5.116 4.522.714.31 1.272.496 1.707.635.717.228 1.37.195 1.885.118.574-.086 1.772-.725 2.022-1.425.25-.7.25-1.3 0-1.425-.075-.125-.275-.2-.575-.35z"/>
                    </svg>
                    <span>Konfirmasi via WhatsApp</span>
                </a>
                @endif
            </div>

        </div>

    </div>
</div>

@if($donation->status === 'pending')
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkStatusUrl = "{{ route('donations.status', $donation->invoice_number) }}";
        const btnCheck = document.getElementById('btn-check-payment');
        const btnSpinner = document.getElementById('btn-check-spinner');
        
        let pollingInterval = setInterval(checkPaymentStatus, 4000);

        function checkPaymentStatus(isManual = false) {
            if (isManual) {
                if (btnCheck) btnCheck.disabled = true;
                if (btnSpinner) btnSpinner.classList.remove('hidden');
            }

            let url = checkStatusUrl;
            if (isManual) {
                url += '?manual_check=1';
            }

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (isManual) {
                        if (btnCheck) btnCheck.disabled = false;
                        if (btnSpinner) btnSpinner.classList.add('hidden');
                    }

                    if (data.status === 'confirmed') {
                        clearInterval(pollingInterval);
                        alert('Pembayaran donasi sukses diterima! Terima kasih.');
                        window.location.reload();
                    } else if (data.status === 'cancelled') {
                        clearInterval(pollingInterval);
                        alert('Waktu pembayaran donasi telah habis (Expired). Silakan buat donasi baru.');
                        window.location.reload();
                    } else if (isManual && data.status === 'pending') {
                        alert('Pembayaran belum terdeteksi. Silakan transfer nominal yang sesuai atau tunggu beberapa saat lagi jika Anda sudah membayar.');
                    }
                })
                .catch(error => {
                    console.error('Error checking status:', error);
                    if (isManual) {
                        if (btnCheck) btnCheck.disabled = false;
                        if (btnSpinner) btnSpinner.classList.add('hidden');
                        alert('Terjadi kesalahan saat memeriksa pembayaran. Silakan coba lagi.');
                    }
                });
        }

        if (btnCheck) {
            btnCheck.addEventListener('click', function(e) {
                e.preventDefault();
                checkPaymentStatus(true);
            });
        }
    });
</script>
@endpush
@endif
@endsection
