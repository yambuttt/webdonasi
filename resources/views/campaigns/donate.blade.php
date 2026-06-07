@extends('layouts.app')

@section('title', 'Donasi - ' . $campaign->title . ' - Pedulia')

@section('content')
<div class="py-12 bg-slate-50 min-h-[80vh] flex items-center justify-center">
    <div class="max-w-2xl w-full mx-auto px-4 sm:px-6">
        
        <!-- Back navigation & Campaign info -->
        <div class="mb-6">
            <a href="{{ route('campaigns.show', $campaign->slug) }}" class="inline-flex items-center space-x-2 text-xs font-bold text-slate-500 hover:text-charcoal transition-colors mb-4">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali ke Detail Kampanye</span>
            </a>
            
            <div class="bg-white border border-slate-100 p-4 rounded-2xl shadow-sm flex items-center space-x-4">
                <img src="{{ $campaign->thumbnail }}" alt="{{ $campaign->title }}" class="w-16 h-16 object-cover rounded-xl flex-shrink-0">
                <div class="min-w-0 flex-1">
                    <span class="inline-block px-2.5 py-0.5 text-[9px] font-extrabold text-slate-500 bg-slate-50 border border-slate-100 rounded-md uppercase tracking-wider mb-1">Anda akan berdonasi untuk</span>
                    <h1 class="text-xs sm:text-sm font-extrabold text-charcoal truncate">{{ $campaign->title }}</h1>
                </div>
            </div>
        </div>

        <!-- Wizard Card -->
        <div class="bg-white border border-slate-100 p-6 sm:p-8 rounded-3xl shadow-lg relative overflow-hidden">
            <div class="absolute top-0 right-0 h-1.5 w-full bg-primary shadow-[0_2px_8px_rgba(159,239,0,0.5)]"></div>

            <!-- Step Progress Indicator -->
            <div class="mb-8 bg-slate-50 p-4 rounded-2xl border border-slate-100/50">
                <div class="flex items-center justify-between text-[10px] font-extrabold text-slate-400 uppercase tracking-wider mb-2">
                    <span id="step-title-text">Langkah 1 dari 3: Data Diri</span>
                    <span id="step-progress-text">33%</span>
                </div>
                <div class="w-full bg-slate-200/60 rounded-full h-1.5 overflow-hidden">
                    <div id="step-progress-bar" class="bg-primary h-full rounded-full transition-all duration-300 shadow-[0_0_8px_rgba(159,239,0,0.6)]" style="width: 33.33%;"></div>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('campaigns.donate', $campaign->slug) }}" method="POST" id="donation-form" class="space-y-6">
                @csrf
                
                <!-- STEP 1: IDENTITY -->
                <div id="step-content-1" class="step-pane space-y-5">
                    <div class="space-y-2">
                        <label for="donor_name" class="text-xs font-bold text-charcoal">Nama Donatur (Wajib)</label>
                        <input type="text" name="donor_name" id="donor_name" required placeholder="Nama lengkap Anda" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-xs font-bold placeholder-slate-400 focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                        <span class="text-[10px] text-red-500 font-bold hidden block" id="error-donor_name"></span>
                    </div>

                    <div class="space-y-2">
                        <label for="donor_email" class="text-xs font-bold text-charcoal">Email (Wajib)</label>
                        <input type="email" name="donor_email" id="donor_email" required placeholder="nama@email.com" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-xs font-bold placeholder-slate-400 focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                        <span class="text-[10px] text-red-500 font-bold hidden block" id="error-donor_email"></span>
                    </div>

                    <div class="space-y-2">
                        <label for="comment" class="text-xs font-bold text-charcoal">Pesan atau Doa Baik (Opsional)</label>
                        <textarea name="comment" id="comment" rows="4" placeholder="Tuliskan doa atau pesan dukungan Anda..." class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-xs font-bold placeholder-slate-400 focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all resize-none"></textarea>
                    </div>

                    <button type="button" onclick="goToStep(2)" class="w-full py-4 bg-primary text-charcoal font-extrabold rounded-2xl text-xs shadow-[0_4px_14px_rgba(159,239,0,0.3)] hover:bg-primary-hover transition-all duration-300 text-center cursor-pointer">
                        Lanjut Pilih Nominal
                    </button>
                </div>

                <!-- STEP 2: NOMINAL -->
                <div id="step-content-2" class="step-pane hidden space-y-5">
                    <div class="space-y-3">
                        <label class="text-xs font-bold text-charcoal block">Pilih Nominal Donasi</label>
                        @if($campaign->donation_options && count($campaign->donation_options) > 0)
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @foreach($campaign->donation_options as $option)
                            <button type="button" 
                                    onclick="selectNominal({{ $option }}, this)" 
                                    class="nominal-btn py-3.5 bg-slate-50 border border-slate-200 hover:border-charcoal hover:bg-white text-xs font-bold text-charcoal rounded-xl transition-all cursor-pointer text-center focus:outline-none">
                                Rp {{ number_format($option, 0, ',', '.') }}
                            </button>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    <div class="space-y-2">
                        <label for="custom-nominal" class="text-xs font-bold text-charcoal">Nominal Donasi Lainnya (Rp)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4.5 flex items-center text-xs font-bold text-slate-400">Rp</span>
                            <input type="number" name="nominal" id="custom-nominal" min="10000" placeholder="Minimal Rp 10.000" required class="w-full pl-11 pr-4.5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-xs font-bold placeholder-slate-400 focus:outline-none focus:bg-white focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                        </div>
                        <span class="text-[10px] text-red-500 font-bold hidden block" id="error-nominal"></span>
                    </div>

                    <div class="grid grid-cols-2 gap-4 pt-2">
                        <button type="button" onclick="goToStep(1)" class="py-3.5 bg-slate-100 hover:bg-slate-200 text-charcoal font-bold rounded-2xl text-xs transition-all text-center cursor-pointer">
                            Sebelumnya
                        </button>
                        <button type="button" onclick="goToStep(3)" class="py-3.5 bg-primary text-charcoal font-extrabold rounded-2xl text-xs shadow-[0_4px_12px_rgba(159,239,0,0.25)] hover:bg-primary-hover transition-all text-center cursor-pointer">
                            Lanjut
                        </button>
                    </div>
                </div>

                <!-- STEP 3: PAYMENT METHOD -->
                <div id="step-content-3" class="step-pane hidden space-y-5">
                    <div class="space-y-3">
                        <label class="text-xs font-bold text-charcoal block">Pilih Metode Pembayaran</label>
                        <div class="grid grid-cols-1 gap-3">
                            @foreach($paymentMethods as $index => $pm)
                            <label class="payment-card flex items-center justify-between p-4 bg-slate-50 border border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-100/50 hover:border-charcoal transition-all relative">
                                <div class="flex items-center space-x-3.5">
                                    <input type="radio" name="payment_method" value="{{ $pm->code }}" {{ $index === 0 ? 'checked' : '' }} class="payment-radio h-4 w-4 text-slate-900 border-slate-300 focus:ring-slate-900 focus:ring-offset-0">
                                    
                                    @if($pm->logo)
                                    <img src="{{ $pm->logo }}" alt="{{ $pm->name }}" class="h-6 w-auto object-contain flex-shrink-0 rounded">
                                    @endif
                                    
                                    <div class="flex flex-col">
                                        <span class="text-xs font-extrabold text-charcoal">{{ $pm->name }}</span>
                                        <span class="text-[9.5px] text-slate-400 font-bold mt-0.5">
                                            @if($pm->type === 'qris')
                                            Konfirmasi Instan 24 Jam
                                            @else
                                            Transfer ke Rekening {{ $pm->bank_name }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <svg class="h-4.5 w-4.5 text-slate-900 border border-slate-200 rounded-full p-0.5 bg-white shadow-sm flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 pt-2">
                        <button type="button" onclick="goToStep(2)" class="py-3.5 bg-slate-100 hover:bg-slate-200 text-charcoal font-bold rounded-2xl text-xs transition-all text-center cursor-pointer">
                            Sebelumnya
                        </button>
                        <button type="submit" class="py-3.5 bg-primary text-charcoal font-extrabold rounded-2xl text-xs shadow-[0_4px_14px_rgba(159,239,0,0.35)] hover:bg-primary-hover hover:shadow-[0_6px_20px_rgba(159,239,0,0.5)] transition-all duration-300 transform hover:-translate-y-0.5 text-center cursor-pointer">
                            Konfirmasi Donasi
                        </button>
                    </div>
                </div>

            </form>

            <!-- Trust Badge -->
            <div class="mt-6 pt-5 border-t border-slate-100 flex items-center space-x-2.5 text-[10px] text-slate-400 font-bold justify-center">
                <svg class="h-4 w-4 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                <span>Transaksi Terenkripsi & 100% Aman</span>
            </div>

        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    const customNominalInput = document.getElementById('custom-nominal');
    const nominalButtons = document.querySelectorAll('.nominal-btn');
    const form = document.getElementById('donation-form');

    // Multi-step state
    let currentStep = 1;

    function selectNominal(amount, btnElement) {
        customNominalInput.value = amount;
        
        // Add active classes to selected button
        nominalButtons.forEach(btn => {
            btn.classList.remove('bg-slate-950', 'text-white', 'border-slate-950');
            btn.classList.add('bg-slate-50', 'text-charcoal', 'border-slate-200');
        });

        // Find clicked button and style it active
        btnElement.classList.remove('bg-slate-50', 'text-charcoal', 'border-slate-200');
        btnElement.classList.add('bg-slate-950', 'text-white', 'border-slate-950');
        
        // Hide error
        document.getElementById('error-nominal').classList.add('hidden');
    }

    // Clear active button state if custom nominal changes manually
    customNominalInput.addEventListener('input', function() {
        nominalButtons.forEach(btn => {
            btn.classList.remove('bg-slate-950', 'text-white', 'border-slate-950');
            btn.classList.add('bg-slate-50', 'text-charcoal', 'border-slate-200');
        });
        if (parseInt(this.value) >= 10000) {
            document.getElementById('error-nominal').classList.add('hidden');
        }
    });

    // Step Validation and Navigation
    function validateStep(step) {
        let isValid = true;
        
        if (step === 1) {
            const nameInput = document.getElementById('donor_name');
            const emailInput = document.getElementById('donor_email');
            const nameError = document.getElementById('error-donor_name');
            const emailError = document.getElementById('error-donor_email');
            
            // Validate name
            if (!nameInput.value.trim()) {
                nameError.textContent = 'Nama wajib diisi.';
                nameError.classList.remove('hidden');
                nameInput.focus();
                isValid = false;
            } else {
                nameError.classList.add('hidden');
            }
            
            // Validate email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailInput.value.trim()) {
                emailError.textContent = 'Email wajib diisi.';
                emailError.classList.remove('hidden');
                if (isValid) emailInput.focus();
                isValid = false;
            } else if (!emailRegex.test(emailInput.value.trim())) {
                emailError.textContent = 'Format email tidak valid.';
                emailError.classList.remove('hidden');
                if (isValid) emailInput.focus();
                isValid = false;
            } else {
                emailError.classList.add('hidden');
            }
        } else if (step === 2) {
            const nominalVal = parseInt(customNominalInput.value);
            const nominalError = document.getElementById('error-nominal');
            
            if (isNaN(nominalVal) || nominalVal < 10000) {
                nominalError.textContent = 'Minimal donasi adalah Rp 10.000.';
                nominalError.classList.remove('hidden');
                customNominalInput.focus();
                isValid = false;
            } else {
                nominalError.classList.add('hidden');
            }
        }
        
        return isValid;
    }

    function goToStep(stepNum) {
        // If moving forward, validate current step first
        if (stepNum > currentStep) {
            if (!validateStep(currentStep)) {
                return;
            }
        }
        
        // Hide all steps
        document.querySelectorAll('.step-pane').forEach(pane => {
            pane.classList.add('hidden');
        });
        
        // Show target step
        document.getElementById(`step-content-${stepNum}`).classList.remove('hidden');
        currentStep = stepNum;
        
        // Update Step indicators
        const stepTitles = {
            1: 'Langkah 1 dari 3: Data Diri',
            2: 'Langkah 2 dari 3: Nominal Donasi',
            3: 'Langkah 3 dari 3: Metode Pembayaran'
        };
        const stepProgress = {
            1: '33.33%',
            2: '66.66%',
            3: '100%'
        };
        
        document.getElementById('step-title-text').textContent = stepTitles[stepNum];
        document.getElementById('step-progress-text').textContent = stepProgress[stepNum];
        document.getElementById('step-progress-bar').style.width = stepProgress[stepNum];
    }

    // Input error listener helper
    document.getElementById('donor_name').addEventListener('input', function() {
        if (this.value.trim()) {
            document.getElementById('error-donor_name').classList.add('hidden');
        }
    });
    document.getElementById('donor_email').addEventListener('input', function() {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (this.value.trim() && emailRegex.test(this.value.trim())) {
            document.getElementById('error-donor_email').classList.add('hidden');
        }
    });

    // Form submit final validation
    form.addEventListener('submit', function(e) {
        if (!validateStep(1) || !validateStep(2)) {
            e.preventDefault();
            if (!validateStep(1)) {
                goToStep(1);
            } else {
                goToStep(2);
            }
        }
    });
</script>

<style>
    .payment-card svg {
        display: none;
    }
    
    .payment-card:has(input:checked) {
        border-color: #0B0F19 !important;
        background-color: #ffffff !important;
        box-shadow: 0 4px 14px rgba(159, 239, 0, 0.1) !important;
    }
    
    .payment-card:has(input:checked) svg {
        display: block;
    }
</style>
@endpush
