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
                            <i class="fas fa-chevron-right text-emerald-300 mr-2"></i>
                            <a href="{{ route('blogs.index') }}"
                                class="text-emerald-600 hover:text-emerald-800 font-medium transition-colors duration-200">
                                Blog
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-emerald-300 mr-2"></i>
                            <span class="text-emerald-800 font-medium">Edit Blog</span>
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
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Edit Blog</h2>
                            <p class="text-sm text-emerald-600">Edit blog di Desa Gunung Sari</p>
                        </div>
                    </div>

                    <a href="{{ route('blogs.index') }}"
                        class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium text-emerald-700 bg-emerald-100
                    hover:bg-emerald-200 transition-all duration-300">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>

            <!-- Form Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-4 sm:p-6">
                <form action="{{ route('blogs.update', $blog) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    @method('PUT')

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
                                        <img id="preview-image"
                                            src="{{ $blog->thumbnail ? asset('storage/images/blogs/' . $blog->thumbnail) : '#' }}"
                                            alt="Preview"
                                            class="{{ $blog->thumbnail ? '' : 'hidden' }} w-full h-full object-cover rounded-2xl">
                                    </div>

                                    <!-- Upload Placeholder -->
                                    <div id="upload-placeholder"
                                        class="{{ $blog->thumbnail ? 'hidden' : '' }} absolute inset-0 flex flex-col items-center justify-center">
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
                            <div id="thumbnail-info" class="{{ $blog->thumbnail ? '' : 'hidden' }} mt-3">
                                <div class="flex items-center justify-between bg-emerald-50 rounded-lg p-3">
                                    <div class="flex items-center">
                                        <i class="fas fa-image text-emerald-600 mr-2"></i>
                                        <span id="filename-display" class="text-sm text-emerald-700 truncate max-w-xs">
                                            {{ $blog->thumbnail ? basename($blog->thumbnail) : '' }}
                                        </span>
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


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Title Input -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Judul Blog</label>
                            <input type="text" name="title" id="title" required
                                class="mt-1 block w-full rounded-lg border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                value="{{ old('title', $blog->title) }}" placeholder="Masukkan Judul Blog">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status Input -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" required
                                class="mt-1 block w-full rounded-lg border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                <option value="draft" {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>
                                    Draft
                                </option>
                                <option value="published"
                                    {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="archived"
                                    {{ old('status', $blog->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Excerpt Input -->
                    <div>
                        <label for="excerpt" class="block text-sm font-medium text-gray-700">Ringkasan</label>
                        <textarea name="excerpt" id="excerpt" rows="3"
                            class="mt-1 block w-full rounded-lg border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            placeholder="Masukkan ringkasan blog">{{ old('excerpt', $blog->excerpt) }}</textarea>
                        @error('excerpt')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content Input -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700">Isi blog</label>
                        <textarea name="content" id="content" rows="10" required
                            class="mt-1 block w-full rounded-lg border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            placeholder="Masukkan isi blog">{{ old('content', $blog->content) }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tags Input -->
                    <div>
                        <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                        <input type="text" name="tags" id="tags"
                            placeholder="Tambahkan tags (maksimal 10 tags)"
                            class="tagify-input mt-1 block w-full rounded-lg border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            value="{{ old('tags', $blog->tags->pluck('name')->implode(',')) }}">
                        <p class="mt-1 text-xs text-gray-500">Pisahkan tag dengan koma atau tekan enter</p>
                        @error('tags')
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
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    <style>
        .tagify__dropdown {
            @apply bg-white border border-emerald-200 shadow-lg rounded-lg;
        }

        .tagify__dropdown__item {
            @apply px-4 py-2 hover:bg-emerald-50 cursor-pointer;
        }

        .tagify__tag {
            @apply bg-emerald-100 text-emerald-700;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
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
                alert(message);
                // Don't reset if there's an existing image
                if (!previewImage.src.includes('storage')) {
                    resetInput();
                }
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
            removeButton.addEventListener('click', function() {
                resetInput();
                // Add a hidden input to indicate image removal if needed
                const removeInput = document.createElement('input');
                removeInput.type = 'hidden';
                removeInput.name = 'remove_image';
                removeInput.value = '1';
                this.closest('form').appendChild(removeInput);
            });

            const input = document.querySelector('input[name=tags]');
            const tagify = new Tagify(input, {
                maxTags: 10,
                enforceWhitelist: false,
                dropdown: {
                    maxItems: 20,
                    enabled: 0,
                    closeOnSelect: false,
                    classname: 'tagify__dropdown',
                    searchKeys: ['value', 'searchBy']
                },
                templates: {
                    tag: function(tagData) {
                        return `
                    <tag title="${tagData.value}"
                        contenteditable="false"
                        spellcheck="false"
                        class="tagify__tag ${tagData.class ? tagData.class : ''}"
                        ${this.getAttributes(tagData)}>
                        <x title="remove tag" class="tagify__tag__removeBtn"></x>
                        <div>
                            <span class="tagify__tag-text">#${tagData.value}</span>
                        </div>
                    </tag>
                `;
                    }
                }
            });

            // Add existing tags as suggestions
            const suggestions = @json($tags ?? []);
            if (suggestions.length) {
                tagify.whitelist = suggestions.map(tag => ({
                    value: tag
                }));
            }
        });
    </script>
@endpush