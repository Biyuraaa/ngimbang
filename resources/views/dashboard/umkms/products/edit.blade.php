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
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-emerald-300 mr-2"></i>
                            <a href="{{ route('umkms.show', $umkm) }}"
                                class="text-emerald-600 hover:text-emerald-800 font-medium transition-colors duration-200">
                                {{ $umkm->name }}
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-emerald-300 mr-2"></i>
                            <span class="text-emerald-800 font-medium">Edit {{ $product->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Form Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-4 sm:p-6">
                <form action="{{ route('umkms.products.update', [$umkm, $product]) }}" method="POST"
                    enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Name Input -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                        <input type="text" name="name" id="name" required
                            class="mt-1 block w-full rounded-lg border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            value="{{ old('name', $product->name) }}">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category Select -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="category_id" id="category_id" required
                            class="mt-1 block w-full rounded-lg border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description Input -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" id="description" rows="4" required
                            class="mt-1 block w-full rounded-lg border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">{{ old('description', $product->description) }}</textarea>
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
                            <input type="number" name="price" id="price" required
                                class="pl-12 block w-full rounded-lg border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                value="{{ old('price', $product->price) }}" min="0" step="0.01">
                        </div>
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Select -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" required
                            class="mt-1 block w-full rounded-lg border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                            <option value="draft" {{ old('status', $product->status) == 'draft' ? 'selected' : '' }}>
                                Draft
                            </option>
                            <option value="published"
                                {{ old('status', $product->status) == 'published' ? 'selected' : '' }}>
                                Published
                            </option>
                            <option value="archived" {{ old('status', $product->status) == 'archived' ? 'selected' : '' }}>
                                Archived
                            </option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-8">
                        {{-- Thumbnail Upload Section --}}
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="bg-emerald-100 rounded-lg p-2">
                                    <i class="fas fa-image text-emerald-600 text-lg"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">Foto Produk</h3>
                            </div>

                            <div class="w-full">
                                <div class="relative" x-data="thumbnailUpload()">
                                    {{-- Dropzone Area --}}
                                    <div class="relative w-full h-72 rounded-2xl border-2 border-dashed transition-all duration-300"
                                        :class="{
                                            'border-emerald-400 bg-emerald-100/50': isDragging,
                                            'border-emerald-200 bg-emerald-50/50 hover:bg-emerald-50': !isDragging
                                        }"
                                        @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false"
                                        @drop.prevent="handleThumbnailDrop($event)">
                                        {{-- Hidden File Input --}}
                                        <input type="file" name="thumbnail" id="thumbnail-input"
                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                            accept="image/png,image/jpeg,image/jpg" @change="handleThumbnailSelect($event)">

                                        {{-- Image Preview --}}
                                        <div class="absolute inset-0 w-full h-full">
                                            <img id="preview-image"
                                                :src="previewUrl ||
                                                    '{{ $product->thumbnail ? asset('storage/images/products/' . $product->thumbnail) : '#' }}'"
                                                alt="Preview" class="w-full h-full object-cover rounded-2xl"
                                                x-show="hasPreview">
                                        </div>

                                        {{-- Upload Placeholder --}}
                                        <div class="absolute inset-0 flex flex-col items-center justify-center"
                                            x-show="!hasPreview">
                                            <div
                                                class="bg-white p-4 rounded-full shadow-md mb-3 group-hover:scale-110 transition-transform duration-300">
                                                <i class="fas fa-cloud-upload-alt text-3xl text-emerald-500"></i>
                                            </div>
                                            <p class="text-sm font-medium text-emerald-800">
                                                Drag and drop gambar atau klik untuk memilih
                                            </p>
                                            <p class="text-xs text-emerald-600 mt-1">
                                                PNG, JPG atau JPEG (Maks. 2MB)
                                            </p>
                                        </div>
                                    </div>

                                    {{-- File Info and Remove Button --}}
                                    <div class="mt-3" x-show="hasPreview">
                                        <div class="flex items-center justify-between bg-emerald-50 rounded-lg p-3">
                                            <div class="flex items-center">
                                                <i class="fas fa-image text-emerald-600 mr-2"></i>
                                                <span class="text-sm text-emerald-700 truncate max-w-xs"
                                                    x-text="fileName"></span>
                                            </div>
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-1 text-sm font-medium text-red-500 bg-white rounded-lg shadow-sm hover:bg-red-50 hover:text-red-600 transition-all duration-200"
                                                @click="removeThumbnail">
                                                <i class="fas fa-trash-alt mr-1.5"></i>
                                                Hapus Foto
                                            </button>
                                        </div>
                                    </div>

                                    {{-- Error Message --}}
                                    <div class="mt-2 text-sm text-red-600" x-show="error">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        <span x-text="error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        function thumbnailUpload() {
            return {
                isDragging: false,
                hasPreview: {{ $product->thumbnail ? 'true' : 'false' }},
                fileName: '{{ $product->thumbnail ?? '' }}',
                previewUrl: null,
                error: null,

                validateFile(file) {
                    const maxSize = 2 * 1024 * 1024; // 2MB
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];

                    if (!allowedTypes.includes(file.type)) {
                        this.error = 'Hanya file PNG, JPG, atau JPEG yang diperbolehkan';
                        return false;
                    }

                    if (file.size > maxSize) {
                        this.error = 'Ukuran file tidak boleh lebih dari 2MB';
                        return false;
                    }

                    return true;
                },

                handleThumbnailSelect(event) {
                    const file = event.target.files[0];
                    if (file && this.validateFile(file)) {
                        this.previewFile(file);
                    }
                },

                handleThumbnailDrop(event) {
                    this.isDragging = false;
                    const file = event.dataTransfer.files[0];
                    if (file && this.validateFile(file)) {
                        this.previewFile(file);
                    }
                },

                previewFile(file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.previewUrl = e.target.result;
                        this.fileName = file.name;
                        this.hasPreview = true;
                        this.error = null;
                    };
                    reader.readAsDataURL(file);
                },

                removeThumbnail() {
                    this.previewUrl = null;
                    this.fileName = '';
                    this.hasPreview = false;
                    document.getElementById('thumbnail-input').value = '';
                }
            }
        }
    </script>
@endpush
