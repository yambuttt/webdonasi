@extends('layouts.admin')

@section('title', 'Tulis Artikel Baru - Pedulia')
@section('header-title', 'Tulis Artikel Baru')
@section('header-subtitle', 'Tulis artikel edukasi dengan editor kaya fitur')

@section('header-actions')
    <a href="{{ route('admin.articles.index') }}" class="inline-flex items-center space-x-2 px-4.5 py-2.5 bg-white border border-slate-200 text-charcoal font-bold rounded-xl text-xs hover:bg-slate-50 transition-all cursor-pointer">
        <span>Batal & Kembali</span>
    </a>
@endsection

@push('styles')
    <!-- Quill editor styles -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
@endpush

@section('content')
    <form id="article-form" action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Side: Inputs & Rich Text Editor (2 columns) -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Article Title -->
                <div class="bg-white border border-slate-100 p-6 rounded-2xl shadow-sm space-y-2">
                    <label for="title" class="text-sm font-bold text-charcoal">Judul Artikel</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="Contoh: Pentingnya Transparansi Donasi Digital" required class="w-full px-4 py-3 bg-slate-50 border @error('title') border-red-400 focus:border-red-500 focus:ring-red-500 @else border-slate-200 focus:border-charcoal focus:ring-charcoal @enderror rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:ring-1 transition-all">
                    @error('title')
                        <p class="text-xs text-red-500 font-bold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content Rich Text Editor (Quill) -->
                <div class="bg-white border border-slate-100 p-6 rounded-2xl shadow-sm space-y-2">
                    <div class="flex justify-between items-center mb-1">
                        <label class="text-sm font-bold text-charcoal">Isi Konten Artikel</label>
                        <span class="text-[10px] bg-slate-100 text-slate-500 px-2 py-0.5 rounded font-semibold uppercase tracking-wider">Word-like Editor</span>
                    </div>
                    
                    <!-- Hidden input to send Quill HTML -->
                    <input type="hidden" name="content" id="content-input" value="{{ old('content') }}">

                    <!-- Quill Editor Container -->
                    <div class="border border-slate-200 rounded-xl overflow-hidden">
                        <div id="editor" class="min-h-[350px] bg-slate-50/50 text-sm">
                            {!! old('content') !!}
                        </div>
                    </div>
                    @error('content')
                        <p class="text-xs text-red-500 font-bold mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Right Side: Configs & Thumbnail (1 column) -->
            <div class="space-y-6">
                
                <!-- Status Setting Card -->
                <div class="bg-white border border-slate-100 p-6 rounded-2xl shadow-sm space-y-4">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Pengaturan Artikel</h3>
                    
                    <div class="space-y-2">
                        <label for="status" class="text-xs font-bold text-charcoal">Status Penerbitan</label>
                        <select id="status" name="status" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-charcoal focus:outline-none focus:border-charcoal focus:ring-1 focus:ring-charcoal transition-all">
                            <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Terbitkan Langsung</option>
                            <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Simpan Sebagai Draf</option>
                        </select>
                    </div>
                </div>

                <!-- Thumbnail Upload Preview Card -->
                <div class="bg-white border border-slate-100 p-6 rounded-2xl shadow-sm space-y-4">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Cover / Gambar Artikel</h3>
                    
                    <!-- Preview Container -->
                    <div id="thumbnail-preview-box" class="h-44 w-full bg-slate-50 border border-dashed border-slate-200 rounded-xl flex flex-col items-center justify-center text-slate-400 relative overflow-hidden group cursor-pointer">
                        <svg class="h-8 w-8 mb-2 group-hover:text-charcoal transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-xs font-bold">Pilih Gambar Sampul</span>
                        <span class="text-[9px] text-slate-400 font-semibold mt-0.5">JPEG, PNG, WEBP (Max. 2MB)</span>
                        
                        <!-- Dynamic Preview Image (Hidden initially) -->
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

                <!-- Submit Form Actions -->
                <button type="submit" class="w-full py-4 bg-primary text-charcoal font-bold rounded-2xl text-sm shadow-[0_4px_14px_rgba(159,239,0,0.3)] hover:bg-primary-hover hover:shadow-[0_6px_20px_rgba(159,239,0,0.5)] transition-all duration-300 transform hover:-translate-y-0.5 cursor-pointer">
                    Terbitkan Artikel
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
            placeholder: 'Tulis isi artikel Anda secara detail di sini...',
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
        const form = document.getElementById('article-form');
        form.addEventListener('submit', function(e) {
            const contentInput = document.getElementById('content-input');
            contentInput.value = quill.root.innerHTML;
            
            if (quill.getText().trim().length === 0) {
                contentInput.value = '';
            }
        });

        // Handle image upload interactive preview
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
