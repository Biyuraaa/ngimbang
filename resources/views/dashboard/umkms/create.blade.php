@extends('layouts.app')
@section('content')
    <div class="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-emerald-50 py-4 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-4 sm:mb-8 overflow-x-auto" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 whitespace-nowrap">
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-home text-emerald-600 mr-2"></i>
                            <a href="{{ route('dashboard') }}"
                                class="text-emerald-600 hover:text-emerald-800 font-medium transition-colors duration-200">
                                Dashboard
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-emerald-300 mr-2"></i>
                            <a href="{{ route('umkms.index') }}"
                                class="text-emerald-600 hover:text-emerald-800 font-medium transition-colors duration-200">
                                UMKM
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-emerald-300 mr-2"></i>
                            <span class="text-emerald-800 font-medium">Tambah UMKM</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Header Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-4 sm:p-6 mb-4 sm:mb-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                    <div class="flex items-center space-x-4">
                        <div
                            class="bg-gradient-to-br from-emerald-500 to-green-600 p-3 rounded-xl shadow-lg shadow-emerald-200">
                            <i class="fas fa-store text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Tambah UMKM Baru</h2>
                            <p class="text-sm text-emerald-600">Tambahkan data UMKM baru ke sistem</p>
                        </div>
                    </div>

                    <a href="{{ route('umkms.index') }}"
                        class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium text-emerald-700 bg-emerald-100 hover:bg-emerald-200 transition-all duration-300">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>
            <!-- Form Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-4 sm:p-6">
                <form action="{{ route('umkms.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Basic Information -->
                    <div class="border-b border-emerald-100 pb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Dasar</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama UMKM</label>
                                <input type="text" name="name" id="name" required
                                    class="mt-1 block w-full rounded-lg border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                    value="{{ old('name') }}" placeholder="Masukkan nama UMKM">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="owner" class="block text-sm font-medium text-gray-700">Nama Pemilik</label>
                                <input type="text" name="owner" id="owner" required
                                    class="mt-1 block w-full rounded-lg border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                    value="{{ old('owner') }}" placeholder="Masukkan nama pemilik">
                                @error('owner')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" required
                                    class="mt-1 block w-full rounded-lg border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                    value="{{ old('email') }}" placeholder="Masukkan email">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                                <input type="tel" name="phone" id="phone"
                                    class="mt-1 block w-full rounded-lg border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                    value="{{ old('phone') }}" placeholder="Masukkan nomor telepon">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Detailed Information -->
                    <div class="space-y-6">
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi UMKM</label>
                            <textarea name="description" id="description" rows="4" required
                                class="mt-1 block w-full rounded-lg border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                placeholder="Masukkan deskripsi UMKM">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Alamat UMKM</label>
                            <textarea name="address" id="address" rows="3"
                                class="mt-1 block w-full rounded-lg border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                placeholder="Masukkan alamat UMKM">{{ old('address') }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Thumbnail Upload Section -->
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="bg-emerald-100 rounded-lg p-2">
                                    <i class="fas fa-image text-emerald-600 text-lg"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">Foto Galeri</h3>
                            </div>

                            <div class="w-full">
                                <div class="relative">
                                    <!-- Dropzone Area -->
                                    <div id="dropzone"
                                        class="relative w-full h-72 rounded-2xl border-2 border-dashed border-emerald-200 
                bg-emerald-50/50 hover:bg-emerald-50 transition-all duration-300 group">

                                        <!-- Hidden File Input -->
                                        <input type="file" name="thumbnail" id="thumbnail-input"
                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                            accept="image/png,image/jpeg,image/jpg">

                                        <!-- Image Preview -->
                                        <div class="absolute inset-0 w-full h-full">
                                            <img id="preview-image" src="#" alt="Preview"
                                                class="hidden w-full h-full object-cover rounded-2xl">
                                        </div>

                                        <!-- Upload Placeholder -->
                                        <div id="upload-placeholder"
                                            class="absolute inset-0 flex flex-col items-center justify-center">
                                            <!-- Icon Container -->
                                            <div
                                                class="bg-white p-4 rounded-full shadow-md mb-3 group-hover:scale-110 transition-transform duration-300">
                                                <i class="fas fa-cloud-upload-alt text-3xl text-emerald-500"></i>
                                            </div>
                                            <!-- Text Instructions -->
                                            <p class="text-sm font-medium text-emerald-800">
                                                Drag and drop gambar atau klik untuk memilih
                                            </p>
                                            <p class="text-xs text-emerald-600 mt-1">
                                                PNG, JPG atau JPEG (Maks. 2MB)
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- File Info and Remove Button -->
                                <div id="thumbnail-info" class="hidden mt-3">
                                    <div class="flex items-center justify-between bg-emerald-50 rounded-lg p-3">
                                        <div class="flex items-center">
                                            <i class="fas fa-image text-emerald-600 mr-2"></i>
                                            <span id="filename-display"
                                                class="text-sm text-emerald-700 truncate max-w-xs"></span>
                                        </div>
                                        <button type="button" id="remove-thumbnail"
                                            class="inline-flex items-center px-3 py-1 text-sm font-medium text-red-500 bg-white rounded-lg 
                    shadow-sm hover:bg-red-50 hover:text-red-600 transition-all duration-200">
                                            <i class="fas fa-trash-alt mr-1.5"></i>
                                            Hapus Foto
                                        </button>
                                    </div>
                                </div>

                                <!-- Error Message -->
                                @error('thumbnail')
                                    <p class="mt-2 text-sm text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-4">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 rounded-xl text-sm font-medium text-white
                            bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700
                            transition-all duration-300 hover:shadow-lg hover:shadow-emerald-200 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                            <i class="fas fa-save mr-2"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const dropzone = document.getElementById('dropzone');
            const thumbnailInput = document.getElementById('thumbnail-input');
            const previewImage = document.getElementById('preview-image');
            const uploadPlaceholder = document.getElementById('upload-placeholder');
            const thumbnailInfo = document.getElementById('thumbnail-info');
            const filenameDisplay = document.getElementById('filename-display');
            const removeButton = document.getElementById('remove-thumbnail');

            // File validation constants
            const MAX_FILE_SIZE = 2 * 1024 * 1024; // 2MB
            const ALLOWED_TYPES = ['image/jpeg', 'image/png', 'image/jpg'];

            // Prevent default drag behaviors
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, preventDefaults, false);
                document.body.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            // Highlight dropzone on drag
            ['dragenter', 'dragover'].forEach(eventName => {
                dropzone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                dropzone.classList.add('border-emerald-400', 'bg-emerald-100/50');
            }

            function unhighlight() {
                dropzone.classList.remove('border-emerald-400', 'bg-emerald-100/50');
            }

            // Handle dropped files
            dropzone.addEventListener('drop', (e) => {
                const files = e.dataTransfer.files;
                if (files.length) {
                    thumbnailInput.files = files;
                    handleFiles(files[0]);
                }
            });

            // Handle file input change
            thumbnailInput.addEventListener('change', function() {
                if (this.files.length) {
                    handleFiles(this.files[0]);
                }
            });

            // Process the file
            function handleFiles(file) {
                if (!validateFile(file)) return;

                const reader = new FileReader();
                reader.onload = (e) => {
                    showPreview(e.target.result, file.name);
                };
                reader.readAsDataURL(file);
            }

            // Validate file
            function validateFile(file) {
                // Check file type
                if (!ALLOWED_TYPES.includes(file.type)) {
                    showError('Hanya file PNG, JPG, atau JPEG yang diperbolehkan');
                    return false;
                }

                // Check file size
                if (file.size > MAX_FILE_SIZE) {
                    showError('Ukuran file tidak boleh lebih dari 2MB');
                    return false;
                }

                return true;
            }

            // Show error message
            function showError(message) {
                // You can implement a toast or alert here
                alert(message);
                resetInput();
            }

            // Show preview
            function showPreview(src, filename) {
                previewImage.src = src;
                previewImage.classList.remove('hidden');
                uploadPlaceholder.classList.add('hidden');
                thumbnailInfo.classList.remove('hidden');
                filenameDisplay.textContent = filename;
            }

            // Reset input
            function resetInput() {
                thumbnailInput.value = '';
                previewImage.src = '#';
                previewImage.classList.add('hidden');
                uploadPlaceholder.classList.remove('hidden');
                thumbnailInfo.classList.add('hidden');
            }

            // Handle remove button
            removeButton.addEventListener('click', resetInput);

            const galleryDropzone = document.getElementById('gallery-dropzone');
            const galleryInput = document.getElementById('gallery-input');
            const galleryPreview = document.getElementById('gallery-preview');

            // Constants
            const MAX_FILES = 10; // Maximum number of files allowed

            // Prevent default drag behaviors
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                galleryDropzone.addEventListener(eventName, preventDefaults, false);
            });

            // Highlight dropzone on drag
            ['dragenter', 'dragover'].forEach(eventName => {
                galleryDropzone.addEventListener(eventName, () => {
                    galleryDropzone.classList.add('border-emerald-400', 'bg-emerald-100/50');
                });
            });

            ['dragleave', 'drop'].forEach(eventName => {
                galleryDropzone.addEventListener(eventName, () => {
                    galleryDropzone.classList.remove('border-emerald-400', 'bg-emerald-100/50');
                });
            });

            // Handle dropped files
            galleryDropzone.addEventListener('drop', (e) => {
                const files = e.dataTransfer.files;
                handleGalleryFiles(Array.from(files));
            });

            // Handle file input change
            galleryInput.addEventListener('change', function() {
                handleGalleryFiles(Array.from(this.files));
            });

            // Process gallery files
            function handleGalleryFiles(files) {
                // Check total files
                const totalFiles = galleryPreview.children.length + files.length;
                if (totalFiles > MAX_FILES) {
                    showError(`Maksimal ${MAX_FILES} foto yang diperbolehkan`);
                    return;
                }

                files.forEach(file => {
                    if (validateFile(file)) {
                        addGalleryPreview(file);
                    }
                });
            }

            // Add preview for gallery image
            function addGalleryPreview(file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'relative group aspect-square';

                    previewItem.innerHTML = `
                <img src="${e.target.result}" class="w-full h-full object-cover rounded-lg" />
                <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 
                            transition-opacity duration-200 rounded-lg flex items-center justify-center">
                    <button type="button" class="text-white hover:text-red-400 transition-colors duration-200">
                        <i class="fas fa-trash-alt text-xl"></i>
                    </button>
                </div>
            `;

                    // Add remove functionality
                    const removeButton = previewItem.querySelector('button');
                    removeButton.addEventListener('click', () => {
                        previewItem.remove();
                        updateGalleryInput();
                    });

                    galleryPreview.appendChild(previewItem);
                    updateGalleryInput();
                };
                reader.readAsDataURL(file);
            }

            // Update hidden input with current files
            function updateGalleryInput() {
                // Implementation depends on how you want to handle the file data
                // This is a basic example that clears the input if no previews exist
                if (galleryPreview.children.length === 0) {
                    galleryInput.value = '';
                }
            }

            // Validate file
            function validateFile(file) {
                if (!ALLOWED_TYPES.includes(file.type)) {
                    showError('Hanya file PNG, JPG, atau JPEG yang diperbolehkan');
                    return false;
                }

                if (file.size > MAX_FILE_SIZE) {
                    showError('Ukuran file tidak boleh lebih dari 2MB');
                    return false;
                }

                return true;
            }

            // Show error message
            function showError(message) {
                alert(message); // You can replace this with a better error notification
            }
        });
    </script>
@endpush
