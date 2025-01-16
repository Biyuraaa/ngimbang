@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-emerald-50 py-4 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Enhanced Breadcrumb -->
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
                            <i class="fas fa-chevron-right text-emerald-300 mx-2"></i>
                            <a href="{{ route('umkms.index') }}"
                                class="text-emerald-600 hover:text-emerald-800 font-medium transition-colors duration-200">
                                UMKM
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-emerald-300 mx-2"></i>
                            <span class="text-emerald-800 font-medium">Edit UMKM</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Enhanced Header Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-4 sm:p-6 mb-4 sm:mb-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                    <div class="flex items-center space-x-4">
                        <div
                            class="bg-gradient-to-br from-emerald-500 to-green-600 p-3 rounded-xl shadow-lg shadow-emerald-200">
                            <i class="fas fa-store text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Edit UMKM</h2>
                            <p class="text-sm text-emerald-600">Update informasi UMKM Anda</p>
                        </div>
                    </div>

                    <a href="{{ route('umkms.index') }}"
                        class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium text-emerald-700 bg-emerald-100
                        hover:bg-emerald-200 transition-all duration-300">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>

            <!-- Main Form Section -->
            <div class="space-y-6">
                <form action="{{ route('umkms.updateAdmin') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- UMKM Information Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-4 sm:p-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="bg-emerald-100 rounded-lg p-2">
                                <i class="fas fa-info-circle text-emerald-600 text-lg"></i>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-900">Informasi UMKM</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama UMKM</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-store text-gray-400"></i>
                                    </div>
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name', $umkm->name) }}"
                                        class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                                        placeholder="Masukkan nama UMKM">
                                </div>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-phone text-gray-400"></i>
                                    </div>
                                    <input type="tel" name="phone" id="phone"
                                        value="{{ old('phone', $umkm->phone) }}"
                                        class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                                        placeholder="081234567890">
                                </div>
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-map-marker-alt text-gray-400"></i>
                                    </div>
                                    <textarea name="address" id="address" rows="2"
                                        class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                                        placeholder="Masukkan alamat lengkap UMKM">{{ old('address', $umkm->address) }}</textarea>
                                </div>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi
                                    UMKM</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute top-3 left-3 flex items-start pointer-events-none">
                                        <i class="fas fa-align-left text-gray-400"></i>
                                    </div>
                                    <textarea name="description" id="description" rows="4"
                                        class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                                        placeholder="Deskripsikan UMKM Anda secara detail">{{ old('description', $umkm->description) }}</textarea>
                                </div>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Thumbnail Upload Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-4 sm:p-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="bg-emerald-100 rounded-lg p-2">
                                <i class="fas fa-image text-emerald-600 text-lg"></i>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-900">Thumbnail UMKM</h2>
                        </div>

                        <div class="w-full">
                            <div class="relative">
                                <div id="dropzone"
                                    class="w-full h-72 rounded-2xl border-3 border-dashed border-emerald-200 bg-emerald-50/50 
                hover:bg-emerald-50 transition-all duration-300 cursor-pointer overflow-hidden group">
                                    <img id="thumbnail-preview"
                                        src="{{ $umkm->thumbnail ? asset('storage/' . $umkm->thumbnail) : '#' }}"
                                        alt="Preview"
                                        class="{{ $umkm->thumbnail ? '' : 'hidden' }} w-full h-full rounded-2xl object-cover 
                    group-hover:opacity-75 transition-opacity duration-300">
                                    <div id="upload-placeholder"
                                        class="{{ $umkm->thumbnail ? 'hidden' : '' }} absolute inset-0 flex flex-col items-center justify-center">
                                        <div class="bg-white p-4 rounded-full shadow-md mb-3">
                                            <i class="fas fa-cloud-upload-alt text-3xl text-emerald-500"></i>
                                        </div>
                                        <p class="text-sm font-medium text-emerald-800">Drag and drop gambar atau klik
                                            untuk memilih</p>
                                        <p class="text-xs text-emerald-600 mt-1">PNG, JPG atau JPEG (Maks. 2MB)</p>
                                    </div>
                                </div>
                                <input type="file" name="thumbnail" id="thumbnail-input"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                    accept="image/png,image/jpeg,image/jpg">
                            </div>
                            @if ($umkm->thumbnail)
                                <div class="mt-3 flex items-center justify-between bg-emerald-50 rounded-lg p-3">
                                    <p class="text-sm text-emerald-700">
                                        <i class="fas fa-image mr-2"></i>
                                        {{ basename($umkm->thumbnail) }}
                                    </p>
                                    <button type="button" id="remove-thumbnail"
                                        class="text-sm text-red-500 hover:text-red-600 bg-white px-3 py-1 rounded-lg 
                    shadow-sm hover:shadow transition-all duration-200">
                                        <i class="fas fa-trash-alt mr-1"></i>
                                        Hapus Thumbnail
                                    </button>
                                </div>
                            @endif
                            <input type="hidden" name="delete_thumbnail" id="delete-thumbnail-input" value="0">
                            @error('thumbnail')
                                <p class="mt-2 text-sm text-red-600">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 rounded-xl text-sm font-medium text-white
                            bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700
                            transition-all duration-300 hover:shadow-lg hover:shadow-emerald-200 transform hover:scale-[1.02]">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Perubahan
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
            const thumbnailInput = document.getElementById('thumbnail-input');
            const thumbnailPreview = document.getElementById('thumbnail-preview');
            const uploadPlaceholder = document.getElementById('upload-placeholder');
            const removeButton = document.getElementById('remove-thumbnail');
            const deleteThumbnailInput = document.getElementById('delete-thumbnail-input');
            const dropZone = document.getElementById('dropzone');

            // Thumbnail preview function
            function handleThumbnailChange(file) {
                if (file && file.type.match('image.*')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        thumbnailPreview.src = e.target.result;
                        thumbnailPreview.classList.remove('hidden');
                        uploadPlaceholder.classList.add('hidden');
                        deleteThumbnailInput.value = '0';
                    }
                    reader.readAsDataURL(file);
                }
            }

            // Handle file input change
            thumbnailInput.addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                    handleThumbnailChange(this.files[0]);
                }
            });

            // Remove thumbnail functionality
            if (removeButton) {
                removeButton.addEventListener('click', function() {
                    thumbnailPreview.src = '#';
                    thumbnailPreview.classList.add('hidden');
                    uploadPlaceholder.classList.remove('hidden');
                    thumbnailInput.value = '';
                    deleteThumbnailInput.value = '1';
                });
            }

            // Drag and drop functionality
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            // Highlight drop zone
            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, function() {
                    dropZone.classList.add('border-emerald-400', 'bg-emerald-100');
                });
            });

            // Remove highlight
            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, function() {
                    dropZone.classList.remove('border-emerald-400', 'bg-emerald-100');
                });
            });

            // Handle file drop
            dropZone.addEventListener('drop', function(e) {
                const dt = e.dataTransfer;
                const file = dt.files[0];

                if (file && file.type.match('image.*')) {
                    thumbnailInput.files = dt.files;
                    handleThumbnailChange(file);
                }
            });
        });
    </script>
@endpush
