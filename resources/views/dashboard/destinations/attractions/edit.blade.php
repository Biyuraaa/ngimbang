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
                            <a href="{{ route('destinations.index') }}"
                                class="text-emerald-600 hover:text-emerald-800 font-medium transition-colors duration-200">
                                Destinasi
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-emerald-300 mx-2"></i>
                            <span class="text-emerald-800 font-medium">Edit Atraksi</span>
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
                            <i class="fas fa-edit text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Edit Atraksi</h2>
                            <p class="text-sm text-emerald-600">Edit informasi atraksi "{{ $attraction->name }}"</p>
                        </div>
                    </div>

                    <a href="{{ route('destinations.index') }}"
                        class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium text-emerald-700 bg-emerald-100
                    hover:bg-emerald-200 transition-all duration-300">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>

            <!-- Form Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-4 sm:p-6">
                <form action="{{ route('destinations.attractions.update', $attraction->id) }}" method="POST"
                    enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Name Input -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Atraksi</label>
                        <input type="text" name="name" id="name" required
                            class="mt-1 block w-full rounded-lg border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            value="{{ old('name', $attraction->name) }}" placeholder="Masukkan nama atraksi">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description Input -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" id="description" rows="4"
                            class="mt-1 block w-full rounded-lg border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            placeholder="Masukkan deskripsi atraksi">{{ old('description', $attraction->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price Input -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                        <div class="mt-1 relative rounded-lg shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">Rp</span>
                            </div>
                            <input type="number" name="price" id="price"
                                class="pl-10 block w-full rounded-lg border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                value="{{ old('price', $attraction->price) }}" placeholder="0" min="0"
                                step="1000">
                        </div>
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Thumbnail Input -->
                    <div>
                        <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">Gambar APBD</label>
                        <div class="relative">
                            <!-- Hidden file input -->
                            <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="hidden">

                            <!-- Drag and drop area -->
                            <div id="dropZone"
                                class="border-2 border-dashed border-emerald-200 rounded-lg p-8 text-center cursor-pointer
                                hover:border-emerald-400 transition-colors duration-200">
                                <!-- Current image preview -->
                                <div id="currentImage" class="{{ !$attraction->thumbnail ? 'hidden' : '' }}">
                                    <img src="{{ asset('storage/images/destinations/attractions/' . $attraction->thumbnail) }}"
                                        alt="Current APBD Image" class="max-h-64 mx-auto rounded-lg">
                                    <p class="mt-2 text-sm text-gray-500">Gambar saat ini</p>

                                    <button type="button" id="removeCurrentImage"
                                        class="mt-2 inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium text-red-700 bg-red-50
        hover:bg-red-100 transition-colors duration-200">
                                        <i class="fas fa-times mr-1"></i>
                                        Hapus
                                    </button>
                                </div>
                                <input type="hidden" name="remove_image" id="removeImageFlag" value="0">

                                <div id="dropZoneContent" class="{{ $attraction->thumbnail ? 'hidden' : '' }}">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-emerald-500 mb-3"></i>
                                    <p class="text-sm text-gray-600">Drag and drop gambar di sini atau</p>
                                    <button type="button"
                                        class="mt-2 inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium text-white
                                        bg-emerald-500 hover:bg-emerald-600 transition-colors duration-200">
                                        Pilih File
                                    </button>
                                </div>

                                <!-- New image preview container -->
                                <div id="imagePreview" class="hidden mt-4">
                                    <img src="#" alt="Preview" class="max-h-64 mx-auto rounded-lg">
                                    <button type="button" id="removeImage"
                                        class="mt-2 inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium text-red-700 bg-red-50
                                        hover:bg-red-100 transition-colors duration-200">
                                        <i class="fas fa-times mr-1"></i>
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                        @error('thumbnail')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 rounded-xl text-sm font-medium text-white
                        bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700
                        transition-all duration-300 hover:shadow-lg hover:shadow-emerald-200 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
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
            const dropZone = document.getElementById('dropZone');
            const fileInput = document.getElementById('thumbnail');
            const imagePreview = document.getElementById('imagePreview');
            const previewImage = imagePreview.querySelector('img');
            const dropZoneContent = document.getElementById('dropZoneContent');
            const removeButton = document.getElementById('removeImage');
            const currentImage = document.getElementById('currentImage');
            const removeCurrentImageButton = document.getElementById('removeCurrentImage');
            const removeImageFlag = document.getElementById('removeImageFlag');

            // Handle drag and drop
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, unhighlight, false);
            });

            function highlight(e) {
                dropZone.classList.add('border-emerald-400');
            }

            function unhighlight(e) {
                dropZone.classList.remove('border-emerald-400');
            }

            // Handle file drop
            dropZone.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                handleFiles(files);
            }

            // Handle file selection via button
            dropZone.querySelector('button').addEventListener('click', () => {
                fileInput.click();
            });

            fileInput.addEventListener('change', function() {
                handleFiles(this.files);
            });

            function handleFiles(files) {
                if (files.length > 0) {
                    const file = files[0];
                    if (file.type.startsWith('image/')) {
                        showPreview(file);
                    } else {
                        alert('Please upload an image file');
                    }
                }
            }

            function showPreview(file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    dropZoneContent.classList.add('hidden');
                    currentImage.classList.add('hidden');
                    imagePreview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }

            // Handle remove button
            removeButton.addEventListener('click', function() {
                fileInput.value = '';
                imagePreview.classList.add('hidden');
                if (removeImageFlag.value === '1') {
                    dropZoneContent.classList.remove('hidden');
                } else {
                    currentImage.classList.remove('hidden');
                }
            });

            removeCurrentImageButton.addEventListener('click', function() {
                currentImage.classList.add('hidden');
                dropZoneContent.classList.remove('hidden');
                removeImageFlag.value = '1'; // Set flag to indicate image should be removed
            });


        });
    </script>
@endpush
