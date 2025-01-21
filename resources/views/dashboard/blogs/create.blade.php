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
                            <span class="text-emerald-800 font-medium">Tambah Blog</span>
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
                            <i class="fas fa-blog text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Tambah Blog Baru</h2>
                            <p class="text-sm text-emerald-600">Tambahkan blog baru di Desa Gunung Sari</p>
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
                <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Thumbnail Preview -->
                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Gambar Blog
                        </label>
                        <div class="mt-1 relative">
                            <div
                                class="w-full h-64 rounded-xl border-2 border-dashed border-emerald-200 bg-emerald-50 flex items-center justify-center">
                                <img id="image-preview" src="#" alt="Image Preview"
                                    class="hidden max-h-full rounded-lg object-cover">
                                <div id="upload-placeholder" class="text-center">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-emerald-400 mb-2"></i>
                                    <p class="text-sm text-emerald-600">Klik untuk memilih gambar atau drag and drop</p>
                                </div>
                            </div>
                            <input type="file" name="thumbnail" id="thumbnail"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*" required>
                        </div>
                        @error('thumbnail')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name Input -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Judul Blog</label>
                            <input type="text" name="title" id="title" required
                                class="mt-1 block w-full rounded-lg border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                value="{{ old('title') }}" placeholder="Masukkan Judul Blog">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" required
                                class="mt-1 block w-full rounded-lg border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
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

                    </div>
                    <div>
                        <label for="excerpt" class="block text-sm font-medium text-gray-700">Ringkasan</label>
                        <textarea name="excerpt" id="excerpt" rows="3"
                            class="mt-1 block w-full rounded-lg border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            placeholder="Masukkan ringkasan blog">{{ old('excerpt') }}</textarea>
                        @error('excerpt')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content Input -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700">Isi blog</label>
                        <textarea name="content" id="content" rows="10" required
                            class="mt-1 block w-full rounded-lg border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            placeholder="Masukkan isi blog">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tags Input -->
                    <div>
                        <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                        <input type="text" name="tags" id="tags" placeholder="Tambahkan tags (maksimal 10 tags)"
                            class="tagify-input mt-1 block w-full rounded-lg border-emerald-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
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
                            Simpan
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
        document.getElementById('thumbnail').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('image-preview');
                    const placeholder = document.getElementById('upload-placeholder');
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
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
