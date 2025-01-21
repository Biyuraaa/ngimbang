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
                            <a href="{{ route('events.index') }}"
                                class="text-emerald-600 hover:text-emerald-800 font-medium transition-colors duration-200">
                                Event
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-emerald-300 mr-2"></i>
                            <span class="text-emerald-800 font-medium">Edit {{ $event->title }}</span>
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
                            <i class="fas fa-mountain text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Edit Event</h2>
                            <p class="text-sm text-emerald-600">Ubah informasi Event di Desa Gunung Sari</p>
                        </div>
                    </div>

                    <a href="{{ route('events.index') }}"
                        class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium text-emerald-700 bg-emerald-100
                    hover:bg-emerald-200 transition-all duration-300">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>

            <!-- Form Section -->
            <div class="bg-white rounded-2xl shadow-md border border-emerald-100 p-6">
                <form action="{{ route('events.update', $event) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- Image Upload -->
                    <div class="w-full">
                        <label class="block text-base font-semibold text-gray-800 mb-3">Gambar Event</label>
                        <div class="relative">
                            <div
                                class="w-full h-72 rounded-2xl border-3 border-dashed border-emerald-200 bg-emerald-50/50 
                hover:bg-emerald-50 transition-colors duration-300 cursor-pointer">
                                <img id="image-preview"
                                    src="{{ $event->thumbnail ? asset('storage/images/events/' . $event->thumbnail) : '#' }}"
                                    alt="Preview"
                                    class="{{ $event->thumbnail ? '' : 'hidden' }} w-full h-full rounded-2xl object-cover">
                                <div id="upload-placeholder"
                                    class="{{ $event->thumbnail ? 'hidden' : '' }} absolute inset-0 flex flex-col items-center justify-center">
                                    <div class="bg-white p-4 rounded-full shadow-md mb-3">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-emerald-500"></i>
                                    </div>
                                    <p class="text-sm font-medium text-emerald-800">Drag and drop gambar atau klik untuk
                                        memilih</p>
                                    <p class="text-xs text-emerald-600 mt-1">PNG, JPG atau JPEG (Maks. 2MB)</p>
                                </div>
                            </div>
                            <input type="file" name="thumbnail" id="thumbnail"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                        </div>
                        @if ($event->thumbnail)
                            <div class="mt-2 flex items-center justify-between">
                                <p class="text-sm text-gray-500">
                                    <i class="fas fa-image mr-1"></i>
                                    {{ basename($event->thumbnail) }}
                                </p>
                                <button type="button" id="remove-image" class="text-sm text-red-500 hover:text-red-600">
                                    <i class="fas fa-trash-alt mr-1"></i>
                                    Hapus Gambar
                                </button>
                            </div>
                        @endif
                        @error('thumbnail')
                            <p class="mt-2 text-sm text-red-600">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Basic Information Section -->
                    <div class="border-t border-emerald-100 pt-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-6">Informasi Dasar</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Title Input -->
                            <div class="space-y-2">
                                <label for="title" class="block text-sm font-medium text-gray-700">Judul Event</label>
                                <input type="text" name="title" id="title" required
                                    class="block w-full rounded-xl border-emerald-200 shadow-sm focus:border-emerald-500 
                                           focus:ring focus:ring-emerald-200 focus:ring-opacity-50 transition-shadow duration-300"
                                    value="{{ old('title', $event->title) }}"
                                    placeholder="Contoh: Festival Budaya Desa Gunung Sari">
                                @error('title')
                                    <p class="text-sm text-red-600"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Location Input -->
                            <div class="space-y-2">
                                <label for="location" class="block text-sm font-medium text-gray-700">Lokasi</label>
                                <input type="text" name="location" id="location" required
                                    class="block w-full rounded-xl border-emerald-200 shadow-sm focus:border-emerald-500 
                                           focus:ring focus:ring-emerald-200 focus:ring-opacity-50 transition-shadow duration-300"
                                    value="{{ old('location', $event->location) }}"
                                    placeholder="Contoh: Balai Desa Gunung Sari">
                                @error('location')
                                    <p class="text-sm text-red-600"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Price Input -->
                            <div class="space-y-2">
                                <label for="price" class="block text-sm font-medium text-gray-700">Harga Tiket</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">Rp</span>
                                    </div>
                                    <input type="number" name="price" id="price"
                                        class="block w-full pl-12 rounded-xl border-emerald-200 shadow-sm focus:border-emerald-500 
                                               focus:ring focus:ring-emerald-200 focus:ring-opacity-50 transition-shadow duration-300"
                                        value="{{ old('price', $event->price) }}" placeholder="0">
                                </div>
                                @error('price')
                                    <p class="text-sm text-red-600"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Registration URL Input -->
                            <div class="space-y-2">
                                <label for="registration_url" class="block text-sm font-medium text-gray-700">URL
                                    Pendaftaran</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-link text-gray-400"></i>
                                    </div>
                                    <input type="url" name="registration_url" id="registration_url"
                                        class="block w-full pl-10 rounded-xl border-emerald-200 shadow-sm focus:border-emerald-500 
                                               focus:ring focus:ring-emerald-200 focus:ring-opacity-50 transition-shadow duration-300"
                                        value="{{ old('registration_url', $event->registration_url) }}"
                                        placeholder="https://example.com/register">
                                </div>
                                @error('registration_url')
                                    <p class="text-sm text-red-600"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Date & Time Section -->
                    <div class="border-t border-emerald-100 pt-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-6">Waktu Pelaksanaan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Start Date -->
                            <div class="space-y-2">
                                <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal
                                    Mulai</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="far fa-calendar text-gray-400"></i>
                                    </div>
                                    <input type="date" name="start_date" id="start_date" required
                                        class="block w-full pl-10 rounded-xl border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 transition-shadow duration-300"
                                        value="{{ old('start_date', $event->start_date ? $event->start_date->format('Y-m-d') : \Carbon\Carbon::now()->format('Y-m-d')) }}">
                                </div>
                                @error('start_date')
                                    <p class="text-sm text-red-600"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- End Date -->
                            <div class="space-y-2">
                                <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal
                                    Berakhir</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="far fa-calendar text-gray-400"></i>
                                    </div>
                                    <input type="date" name="end_date" id="end_date" required
                                        class="block w-full pl-10 rounded-xl border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 transition-shadow duration-300"
                                        value="{{ old('end_date', $event->end_date ? $event->end_date->format('Y-m-d') : \Carbon\Carbon::now()->format('Y-m-d')) }}">
                                </div>
                                @error('end_date')
                                    <p class="text-sm text-red-600"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Start Time -->
                            <div class="space-y-2">
                                <label for="start_at" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="far fa-clock text-gray-400"></i>
                                    </div>
                                    <input type="time" name="start_at" id="start_at" required
                                        class="block w-full pl-10 rounded-xl border-emerald-200 shadow-sm focus:border-emerald-500 
                   focus:ring focus:ring-emerald-200 focus:ring-opacity-50 transition-shadow duration-300"
                                        value="{{ old('start_at', \Carbon\Carbon::parse($event->start_at)->format('H:i')) }}">
                                </div>
                                @error('start_at')
                                    <p class="text-sm text-red-600"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- End Time -->
                            <div class="space-y-2">
                                <label for="end_at" class="block text-sm font-medium text-gray-700">Waktu
                                    Berakhir</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="far fa-clock text-gray-400"></i>
                                    </div>
                                    <input type="time" name="end_at" id="end_at" required
                                        class="block w-full pl-10 rounded-xl border-emerald-200 shadow-sm focus:border-emerald-500 
                   focus:ring focus:ring-emerald-200 focus:ring-opacity-50 transition-shadow duration-300"
                                        value="{{ old('end_at', \Carbon\Carbon::parse($event->end_at)->format('H:i')) }}">
                                </div>
                                @error('end_at')
                                    <p class="text-sm text-red-600"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Description Section -->
                    <div class="border-t border-emerald-100 pt-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-6">Deskripsi Event</h3>
                        <div class="space-y-2">
                            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi
                                Lengkap</label>
                            <textarea name="description" id="description" rows="6" required
                                class="block w-full rounded-xl border-emerald-200 shadow-sm focus:border-emerald-500 
                                       focus:ring focus:ring-emerald-200 focus:ring-opacity-50 transition-shadow duration-300"
                                placeholder="Jelaskan detail acara, termasuk rundown dan informasi penting lainnya">{{ old('description', $event->description) }}</textarea>
                            @error('description')
                                <p class="text-sm text-red-600"><i
                                        class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button Section -->
                    <div class="border-t border-emerald-100 pt-8 flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-8 py-3 rounded-xl text-base font-medium text-white
                                   bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700
                                   transition-all duration-300 shadow-md hover:shadow-lg hover:shadow-emerald-200/50 
                                   focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transform hover:-translate-y-0.5">
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
            const imageInput = document.getElementById('thumbnail');
            const imagePreview = document.getElementById('image-preview');
            const uploadPlaceholder = document.getElementById('upload-placeholder');
            const removeButton = document.getElementById('remove-image');

            // Remove image functionality
            if (removeButton) {
                removeButton.addEventListener('click', function() {
                    imagePreview.src = '#';
                    imagePreview.classList.add('hidden');
                    uploadPlaceholder.classList.remove('hidden');
                    imageInput.value = '';

                    // Add hidden input to mark image for deletion
                    const deleteInput = document.createElement('input');
                    deleteInput.type = 'hidden';
                    deleteInput.name = 'delete_image';
                    deleteInput.value = '1';
                    imageInput.parentNode.appendChild(deleteInput);
                });
            }

            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.classList.remove('hidden');
                        uploadPlaceholder.classList.add('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Drag and drop functionality
            const dropZone = document.querySelector('.border-dashed');

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
                dropZone.classList.add('bg-emerald-100');
            }

            function unhighlight(e) {
                dropZone.classList.remove('bg-emerald-100');
            }

            dropZone.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const file = dt.files[0];

                if (file && file.type.startsWith('image/')) {
                    imageInput.files = dt.files;
                    const event = new Event('change');
                    imageInput.dispatchEvent(event);
                }
            }

            // Date validation
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');

            startDateInput.addEventListener('change', function() {
                endDateInput.min = this.value;
            });

            endDateInput.addEventListener('change', function() {
                startDateInput.max = this.value;
            });
        });
    </script>
@endpush
