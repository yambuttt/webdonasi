@extends('layouts.admin')

@section('title', 'Buat Kampanye Baru - Pedulia')
@section('header-title', 'Buat Kampanye Baru')
@section('header-subtitle', 'Buat kampanye donasi baru dengan kustomisasi nominal & detail lengkap')

@section('header-actions')
    <a href="{{ route('admin.campaigns.index') }}" class="inline-flex items-center space-x-2 px-4.5 py-2.5 bg-white border border-slate-200 text-charcoal font-bold rounded-xl text-xs hover:bg-slate-50 transition-all cursor-pointer">
        <span>Batal & Kembali</span>
    </a>
@endsection

@push('styles')
    <!-- Quill editor styles -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
@endpush

@section('content')
    <form id="campaign-form" action="{{ route('admin.campaigns.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left: Fields & Editor (2 columns) -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Campaign Basic Info -->
                <div class="bg-white border border-slate-100 p-6 rounded-2xl shadow-sm space-y-4">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Informasi Dasar Kampanye</h3>
                    
                    <div class="space-y-2">
                        <label for="title" class="text-sm font-bold text-charcoal">Nama / Judul Kampanye</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="Contoh: Bantu Balita Gizi Buruk NTT" required class="w-full px-4 py-3 bg-slate-50 border @error('title') border-red-400 focus:border-red-500 focus:ring-red-500 @else border-slate-200 focus:border-charcoal focus:ring-charcoal @enderror rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:ring-1 transition-all">
                        @error('title')
                            <p class="text-xs text-red-500 font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="category" class="text-sm font-bold text-charcoal">Kategori</label>
                            <select id="category" name="category" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-charcoal focus:outline-none focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                                <option value="kesehatan" {{ old('category') === 'kesehatan' ? 'selected' : '' }}>Medis & Kesehatan</option>
                                <option value="bencana" {{ old('category') === 'bencana' ? 'selected' : '' }}>Bencana Alam</option>
                                <option value="pendidikan" {{ old('category') === 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                            </select>
                            @error('category')
                                <p class="text-xs text-red-500 font-bold mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="target_amount" class="text-sm font-bold text-charcoal">Nominal Target (Rp)</label>
                            <input type="number" id="target_amount" name="target_amount" value="{{ old('target_amount') }}" placeholder="Contoh: 50000000" required class="w-full px-4 py-3 bg-slate-50 border @error('target_amount') border-red-400 focus:border-red-500 focus:ring-red-500 @else border-slate-200 focus:border-charcoal focus:ring-charcoal @enderror rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:ring-1 transition-all">
                            @error('target_amount')
                                <p class="text-xs text-red-500 font-bold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Quill Description Editor -->
                <div class="bg-white border border-slate-100 p-6 rounded-2xl shadow-sm space-y-2">
                    <div class="flex justify-between items-center mb-1">
                        <label class="text-sm font-bold text-charcoal">Deskripsi Panjang Kampanye</label>
                        <span class="text-[10px] bg-slate-100 text-slate-500 px-2 py-0.5 rounded font-semibold uppercase tracking-wider">Editor WYSIWYG</span>
                    </div>
                    
                    <input type="hidden" name="description" id="description-input" value="{{ old('description') }}">

                    <div class="border border-slate-200 rounded-xl overflow-hidden">
                        <div id="editor" class="min-h-[350px] bg-slate-50/50 text-sm">
                            {!! old('description') !!}
                        </div>
                    </div>
                    @error('description')
                        <p class="text-xs text-red-500 font-bold mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Right: Configs & Nominal Options (1 column) -->
            <div class="space-y-6">
                
                <!-- Time Settings Card -->
                <div class="bg-white border border-slate-100 p-6 rounded-2xl shadow-sm space-y-4">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Durasi Penggalangan</h3>
                    
                    <div class="space-y-2">
                        <label for="days_remaining" class="text-xs font-bold text-charcoal">Sisa Hari Kampanye</label>
                        <input type="number" id="days_remaining" name="days_remaining" value="{{ old('days_remaining', 30) }}" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-charcoal focus:outline-none focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                        @error('days_remaining')
                            <p class="text-xs text-red-500 font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Custom Nominal Choices -->
                <div class="bg-white border border-slate-100 p-6 rounded-2xl shadow-sm space-y-4">
                    <div>
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Pilihan Nominal Donasi</h3>
                        <p class="text-[10px] text-slate-400 font-semibold mt-0.5">Tentukan opsi nominal yang siap diklik donatur</p>
                    </div>

                    <!-- Tags list showing current options -->
                    <div id="nominal-tags" class="flex flex-wrap gap-2 py-1">
                        <!-- Filled by JS -->
                    </div>

                    <!-- Input to add option -->
                    <div class="flex space-x-2">
                        <input type="number" id="nominal-input" placeholder="Contoh: 50000" class="flex-1 px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:outline-none focus:border-charcoal transition-all">
                        <button type="button" id="add-nominal-btn" class="px-4 py-2.5 bg-slate-950 text-white rounded-xl text-xs font-bold hover:bg-slate-800 transition-all cursor-pointer">Tambah</button>
                    </div>

                    <!-- Hidden inputs container for donation_options[] -->
                    <div id="nominal-hidden-inputs">
                        @if(old('donation_options'))
                            @foreach(old('donation_options') as $option)
                                <input type="hidden" name="donation_options[]" value="{{ $option }}">
                            @endforeach
                        @else
                            <!-- Defaults -->
                            <input type="hidden" name="donation_options[]" value="10000">
                            <input type="hidden" name="donation_options[]" value="25000">
                            <input type="hidden" name="donation_options[]" value="50000">
                            <input type="hidden" name="donation_options[]" value="100000">
                        @endif
                    </div>
                    @error('donation_options')
                        <p class="text-xs text-red-500 font-bold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Cover/Thumbnail uploader -->
                <div class="bg-white border border-slate-100 p-6 rounded-2xl shadow-sm space-y-4">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Gambar / Thumbnail</h3>
                    
                    <div id="thumbnail-preview-box" class="h-44 w-full bg-slate-50 border border-dashed border-slate-200 rounded-xl flex flex-col items-center justify-center text-slate-400 relative overflow-hidden group cursor-pointer">
                        <svg class="h-8 w-8 mb-2 group-hover:text-charcoal transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-xs font-bold">Pilih Cover Kampanye</span>
                        <span class="text-[9px] text-slate-400 font-semibold mt-0.5">JPEG, PNG, WEBP (Max. 2MB)</span>
                        
                        <img id="thumbnail-preview-img" class="absolute inset-0 w-full h-full object-cover hidden">
                    </div>

                    <div class="space-y-2">
                        <input type="file" id="thumbnail" name="thumbnail" accept="image/*" class="hidden">
                        <button type="button" id="thumbnail-btn" class="w-full py-2.5 bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition-all cursor-pointer">
                            Pilih File Gambar
                        </button>
                        @error('thumbnail')
                            <p class="text-xs text-red-500 font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Campaign -->
                <button type="submit" class="w-full py-4 bg-primary text-charcoal font-bold rounded-2xl text-sm shadow-[0_4px_14px_rgba(159,239,0,0.3)] hover:bg-primary-hover hover:shadow-[0_6px_20px_rgba(159,239,0,0.5)] transition-all duration-300 transform hover:-translate-y-0.5 cursor-pointer">
                    Buat Kampanye Sekarang
                </button>

            </div>

        </div>
    </form>
@endsection

@push('scripts')
    <!-- Quill Rich Text Editor Script -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        // Initialize Quill
        const quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Tulis deskripsi detail kampanye di sini...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link'],
                    ['clean']
                ]
            }
        });

        // Handle submission: bind Quill content to hidden form input
        const form = document.getElementById('campaign-form');
        form.addEventListener('submit', function(e) {
            const descriptionInput = document.getElementById('description-input');
            descriptionInput.value = quill.root.innerHTML;
            
            if (quill.getText().trim().length === 0) {
                descriptionInput.value = '';
            }
        });

        // Nominal options tagging manager
        const nominalInput = document.getElementById('nominal-input');
        const addNominalBtn = document.getElementById('add-nominal-btn');
        const nominalTagsContainer = document.getElementById('nominal-tags');
        const nominalHiddenContainer = document.getElementById('nominal-hidden-inputs');

        function formatRupiah(amount) {
            return 'Rp ' + parseInt(amount).toLocaleString('id-ID');
        }

        function renderNominalTags() {
            nominalTagsContainer.innerHTML = '';
            const inputs = nominalHiddenContainer.querySelectorAll('input[type="hidden"]');
            
            const values = [];
            inputs.forEach(input => {
                values.push(parseInt(input.value));
            });
            
            values.sort((a, b) => a - b);
            
            values.forEach(val => {
                const badge = document.createElement('div');
                badge.className = 'inline-flex items-center space-x-1.5 px-3 py-1 bg-slate-900 text-white rounded-full text-xs font-bold border border-slate-800 shadow-sm animate-fade-in-up';
                badge.innerHTML = `
                    <span>${formatRupiah(val)}</span>
                    <button type="button" class="text-slate-400 hover:text-red-400 focus:outline-none font-bold" onclick="removeNominalOption(${val})">
                        &times;
                    </button>
                `;
                nominalTagsContainer.appendChild(badge);
            });
        }

        window.removeNominalOption = function(val) {
            const input = nominalHiddenContainer.querySelector(`input[value="${val}"]`);
            if (input) {
                input.remove();
                renderNominalTags();
            }
        }

        addNominalBtn.addEventListener('click', function() {
            const val = parseInt(nominalInput.value);
            if (!val || val <= 0) return;
            
            const existing = nominalHiddenContainer.querySelector(`input[value="${val}"]`);
            if (existing) {
                nominalInput.value = '';
                return;
            }

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'donation_options[]';
            input.value = val;
            nominalHiddenContainer.appendChild(input);
            
            nominalInput.value = '';
            renderNominalTags();
        });

        nominalInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addNominalBtn.click();
            }
        });

        renderNominalTags();

        // Image preview
        const thumbnailInput = document.getElementById('thumbnail');
        const thumbnailBtn = document.getElementById('thumbnail-btn');
        const previewBox = document.getElementById('thumbnail-preview-box');
        const previewImg = document.getElementById('thumbnail-preview-img');

        thumbnailBtn.addEventListener('click', () => thumbnailInput.click());
        previewBox.addEventListener('click', () => thumbnailInput.click());

        thumbnailInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewImg.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
