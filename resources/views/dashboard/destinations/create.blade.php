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
                            <a href="{{ route('destinations.index') }}"
                                class="text-emerald-600 hover:text-emerald-800 font-medium transition-colors duration-200">
                                Wisata
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-emerald-300 mr-2"></i>
                            <span class="text-emerald-800 font-medium">Tambah Destination</span>
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
                            <i class="fas fa-map-marked-alt text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Add New Destination</h2>
                            <p class="text-sm text-emerald-600">Create a new tourist destination</p>
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
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <form action="{{ route('destinations.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name Field -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 transition duration-150 ease-in-out"
                                    required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status Field -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" id="status"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 transition duration-150 ease-in-out">
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published
                                    </option>
                                    <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived
                                    </option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 transition duration-150 ease-in-out"
                                    required>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone Field -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 transition duration-150 ease-in-out"
                                    required>
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Description Field -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 transition duration-150 ease-in-out"
                                required>{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address Field -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                            <input type="text" name="address" id="address" value="{{ old('address') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 transition duration-150 ease-in-out">
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Operating Hours -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="open_at" class="block text-sm font-medium text-gray-700">Opening Time</label>
                                <input type="time" name="open_at" id="open_at" value="{{ old('open_at') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 transition duration-150 ease-in-out">
                                @error('open_at')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="close_at" class="block text-sm font-medium text-gray-700">Closing Time</label>
                                <input type="time" name="close_at" id="close_at" value="{{ old('close_at') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 transition duration-150 ease-in-out">
                                @error('close_at')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Thumbnail Input Component -->
                        <div>
                            <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">Gambar
                                Wisata</label>
                            <div class="relative">
                                <!-- Hidden file input -->
                                <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="hidden"
                                    data-max-size="2048" required>

                                <!-- Drag and drop area -->
                                <div id="dropZone"
                                    class="border-2 border-dashed border-emerald-200 rounded-lg p-8 text-center cursor-pointer hover:border-emerald-400 transition-colors duration-200">
                                    <!-- Upload content -->
                                    <div id="dropZoneContent">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-emerald-500 mb-3"></i>
                                        <p class="text-sm text-gray-600">Drag and drop thumbnail di sini atau</p>
                                        <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG (Maks. 2MB)</p>
                                        <button type="button"
                                            class="mt-2 inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium text-white bg-emerald-500 hover:bg-emerald-600 focus:ring-2 focus:ring-emerald-300 transition-colors duration-200">
                                            <i class="fas fa-upload mr-2"></i>
                                            Pilih File
                                        </button>
                                    </div>

                                    <!-- Image preview -->
                                    <div id="imagePreview" class="hidden mt-4">
                                        <div class="relative max-w-sm mx-auto">
                                            <img src="#" alt="Preview"
                                                class="max-h-64 w-auto mx-auto rounded-lg shadow-sm">
                                            <button type="button" id="removeImage"
                                                class="mt-2 inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium text-red-700 bg-red-50 hover:bg-red-100 transition-colors duration-200">
                                                <i class="fas fa-times mr-1"></i>
                                                Hapus
                                            </button>
                                        </div>
                                        <p class="mt-2 text-sm text-gray-500 file-name"></p>
                                    </div>

                                    <!-- Loading state -->
                                    <div id="uploadLoading" class="hidden">
                                        <div
                                            class="animate-spin rounded-full h-10 w-10 border-b-2 border-emerald-500 mx-auto">
                                        </div>
                                        <p class="mt-2 text-sm text-gray-600">Memproses gambar...</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Error message -->
                            <div id="errorMessage" class="hidden mt-1 text-sm text-red-600"></div>
                            @error('thumbnail')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end pt-6">
                            <button type="submit"
                                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition duration-150 ease-in-out">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 -ml-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Create Destination
                            </button>
                        </div>
                    </form>
                </div>
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
            const dropZoneContent = document.getElementById('dropZoneContent');
            const uploadLoading = document.getElementById('uploadLoading');
            const previewImage = imagePreview.querySelector('img');
            const removeButton = document.getElementById('removeImage');
            const errorMessage = document.getElementById('errorMessage');
            const fileName = imagePreview.querySelector('.file-name');
            const maxFileSize = parseInt(fileInput.dataset.maxSize) * 1024; // Convert to KB

            // Prevent defaults for drag and drop events
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            // Handle drag states
            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => {
                    dropZone.classList.add('border-emerald-400', 'bg-emerald-50');
                });
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => {
                    dropZone.classList.remove('border-emerald-400', 'bg-emerald-50');
                });
            });

            // Handle file drop
            dropZone.addEventListener('drop', (e) => {
                const files = e.dataTransfer.files;
                handleFiles(files);
            });

            // Handle file selection via button
            dropZone.querySelector('button').addEventListener('click', () => {
                fileInput.click();
            });

            fileInput.addEventListener('change', function() {
                handleFiles(this.files);
            });

            function handleFiles(files) {
                if (files.length === 0) return;

                const file = files[0];

                // Validate file type
                if (!file.type.startsWith('image/')) {
                    showError('Hanya file gambar yang diperbolehkan (PNG, JPG, JPEG)');
                    return;
                }

                // Validate file size
                if (file.size > maxFileSize) {
                    showError(`Ukuran file terlalu besar. Maksimal ${maxFileSize/1024/1024}MB`);
                    return;
                }

                // Clear any existing errors
                hideError();

                // Show loading state
                showLoading();

                // Process image
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Create image to check dimensions
                    const img = new Image();
                    img.onload = function() {
                        // Hide loading state
                        hideLoading();

                        // Show preview
                        previewImage.src = e.target.result;
                        fileName.textContent = file.name;
                        dropZoneContent.classList.add('hidden');
                        imagePreview.classList.remove('hidden');
                    };
                    img.onerror = function() {
                        hideLoading();
                        showError('File gambar rusak atau tidak valid');
                    };
                    img.src = e.target.result;
                };
                reader.onerror = function() {
                    hideLoading();
                    showError('Gagal membaca file');
                };
                reader.readAsDataURL(file);
            }

            // Handle remove button
            removeButton.addEventListener('click', function() {
                fileInput.value = '';
                imagePreview.classList.add('hidden');
                dropZoneContent.classList.remove('hidden');
                hideError();
            });

            // Helper functions
            function showLoading() {
                uploadLoading.classList.remove('hidden');
                dropZoneContent.classList.add('hidden');
                imagePreview.classList.add('hidden');
            }

            function hideLoading() {
                uploadLoading.classList.add('hidden');
            }

            function showError(message) {
                errorMessage.textContent = message;
                errorMessage.classList.remove('hidden');
                fileInput.value = '';
            }

            function hideError() {
                errorMessage.textContent = '';
                errorMessage.classList.add('hidden');
            }
        });
    </script>
@endpush
