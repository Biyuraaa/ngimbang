@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-emerald-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            @if (Auth::user()->hasRole('super-admin'))
                <nav class="flex mb-4 md:mb-8" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center w-full overflow-hidden">
                        <li class="inline-flex items-center min-w-0">
                            <a href="{{ route('dashboard') }}"
                                class="text-sm md:text-base text-emerald-600 hover:text-emerald-800 transition-colors duration-200 whitespace-nowrap">
                                <i class="fas fa-home text-base md:text-lg"></i>
                                <span class="hidden md:inline ml-2">Dashboard</span>
                            </a>
                        </li>
                        <li class="min-w-0">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-emerald-300 mx-1 md:mx-2 text-sm md:text-base"></i>
                                <a href="{{ route('umkms.index') }}"
                                    class="text-sm md:text-base text-emerald-600 hover:text-emerald-800 transition-colors duration-200 whitespace-nowrap">
                                    <i class="fas fa-store md:hidden"></i>
                                    <span class="hidden md:inline">UMKM</span>
                                </a>
                            </div>
                        </li>
                        <li aria-current="page" class="min-w-0">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-emerald-300 mx-1 md:mx-2 text-sm md:text-base"></i>
                                <span
                                    class="text-sm md:text-base text-emerald-800 font-medium truncate">{{ $umkm->name }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            @else
                <nav class="flex mb-4 md:mb-8" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center w-full overflow-hidden">
                        <li class="inline-flex items-center min-w-0">
                            <a href="{{ route('dashboard') }}"
                                class="text-sm md:text-base text-emerald-600 hover:text-emerald-800 transition-colors duration-200 whitespace-nowrap">
                                <i class="fas fa-home text-base md:text-lg"></i>
                                <span class="hidden md:inline ml-2">Dashboard</span>
                            </a>
                        </li>
                        <li aria-current="page" class="min-w-0">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-emerald-300 mx-1 md:mx-2 text-sm md:text-base"></i>
                                <span class="text-sm md:text-base text-emerald-800 font-medium truncate">UMKM</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            @endif
            <!-- Header Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-4 sm:p-6 mb-4 sm:mb-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                    <div class="flex items-center space-x-4">
                        <div
                            class="bg-gradient-to-br from-emerald-500 to-green-600 p-3 rounded-xl shadow-lg shadow-emerald-200">
                            <i class="fas fa-store text-white text-xl md:text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-xl md:text-2xl font-bold text-gray-900 truncate">{{ $umkm->name }}</h1>
                            @if (Auth::user()->hasRole('super-admin'))
                                <p class="text-sm text-emerald-600">Informasi lengkap UMKM Desa Gunungsari</p>
                            @else
                                <p class="text-sm text-emerald-600">Kelola UMKM Anda</p>
                            @endif
                        </div>
                    </div>
                    @if (Auth::user()->hasRole('super-admin'))
                        <a href="{{ route('umkms.index') }}"
                            class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 rounded-xl text-sm font-medium text-white
                    bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700
                    transition-all duration-300 hover:shadow-lg hover:shadow-emerald-200 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                    @else
                        <a href="{{ route('umkms.editAdmin') }}"
                            class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 rounded-xl text-sm font-medium text-white
                    bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700
                    transition-all duration-300 hover:shadow-lg hover:shadow-emerald-200 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                            <i class="fas fa-edit mr-2"></i>
                            Edit UMKM
                        </a>
                    @endif
                </div>
            </div>

            <!-- Main Content -->
            <div class="space-y-6">
                <!-- Info Cards Container -->
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-{{ auth()->user()->hasRole('super-admin') ? '3' : '2' }} gap-4 md:gap-6 lg:gap-8 p-4 md:p-6">
                    <!-- UMKM Info Card -->
                    <div
                        class="bg-white rounded-3xl shadow-lg border border-emerald-100 p-4 md:p-6 hover:shadow-xl transition-shadow duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center justify-between mb-4 md:mb-6">
                            <div class="flex items-center gap-3 md:gap-4">
                                <div class="p-2 md:p-3 bg-emerald-100 rounded-2xl">
                                    <i class="fas fa-store text-emerald-600 text-lg md:text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg md:text-xl font-semibold text-gray-900">Informasi UMKM</h3>
                                    <p class="text-xs md:text-sm text-gray-500">Detail informasi usaha</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-3 md:space-y-4">
                            <div
                                class="flex items-start group hover:bg-emerald-50 p-2 rounded-lg transition-colors duration-200">
                                <div class="flex-shrink-0 w-8 md:w-10 pt-1">
                                    <i class="fas fa-store text-emerald-500 text-base md:text-lg"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs md:text-sm text-gray-600">Nama UMKM</p>
                                    <p class="font-medium text-gray-900 text-sm md:text-base truncate">{{ $umkm->name }}
                                    </p>
                                </div>
                            </div>
                            <div
                                class="flex items-start group hover:bg-emerald-50 p-2 rounded-lg transition-colors duration-200">
                                <div class="flex-shrink-0 w-8 md:w-10 pt-1">
                                    <i class="fas fa-map-marker-alt text-emerald-500 text-base md:text-lg"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs md:text-sm text-gray-600">Alamat</p>
                                    <p class="font-medium text-gray-900 text-sm md:text-base line-clamp-2">
                                        {{ $umkm->address }}</p>
                                </div>
                            </div>
                            <div
                                class="flex items-start group hover:bg-emerald-50 p-2 rounded-lg transition-colors duration-200">
                                <div class="flex-shrink-0 w-8 md:w-10 pt-1">
                                    <i class="fas fa-info-circle text-emerald-500 text-base md:text-lg"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs md:text-sm text-gray-600">Deskripsi</p>
                                    <p class="font-medium text-gray-900 text-sm md:text-base line-clamp-3">
                                        {{ $umkm->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (auth()->user()->hasRole('super-admin'))
                        <!-- Owner Info Card -->
                        <div
                            class="bg-white rounded-3xl shadow-lg border border-emerald-100 p-4 md:p-6 hover:shadow-xl transition-shadow duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center justify-between mb-4 md:mb-6">
                                <div class="flex items-center gap-3 md:gap-4">
                                    <div class="p-2 md:p-3 bg-blue-100 rounded-2xl">
                                        <i class="fas fa-user text-blue-600 text-lg md:text-xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg md:text-xl font-semibold text-gray-900">Informasi Pemilik</h3>
                                        <p class="text-xs md:text-sm text-gray-500">Detail kontak pemilik UMKM</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 md:gap-4 mb-4 md:mb-6">
                                <img src="{{ $umkm->user->image ?? 'https://ui-avatars.com/api/?name=' . urlencode($umkm->user->name) }}"
                                    alt="{{ $umkm->user->name }}"
                                    class="w-14 h-14 md:w-16 md:h-16 rounded-full ring-4 ring-emerald-100 object-cover">
                                <div>
                                    <h3 class="text-base md:text-lg font-semibold text-gray-900">{{ $umkm->user->name }}
                                    </h3>
                                    <p class="text-xs md:text-sm text-gray-600">Pemilik UMKM</p>
                                </div>
                            </div>

                            <div class="space-y-2 md:space-y-3">
                                <div
                                    class="flex items-center p-2 md:p-3 rounded-xl bg-gray-50 hover:bg-emerald-50 transition-colors duration-200">
                                    <i class="fas fa-envelope text-emerald-500 text-base md:text-lg w-6 md:w-8"></i>
                                    <div class="ml-2 md:ml-3 min-w-0">
                                        <p class="text-xs md:text-sm text-gray-600">Email</p>
                                        <p class="font-medium text-gray-900 text-sm md:text-base truncate">
                                            {{ $umkm->user->email }}</p>
                                    </div>
                                </div>
                                <div
                                    class="flex items-center p-2 md:p-3 rounded-xl bg-gray-50 hover:bg-emerald-50 transition-colors duration-200">
                                    <i class="fas fa-phone text-emerald-500 text-base md:text-lg w-6 md:w-8"></i>
                                    <div class="ml-2 md:ml-3 min-w-0">
                                        <p class="text-xs md:text-sm text-gray-600">Nomor Telepon</p>
                                        <p class="font-medium text-gray-900 text-sm md:text-base truncate">
                                            {{ $umkm->user->phone }}</p>
                                    </div>
                                </div>
                                <div
                                    class="flex items-center p-2 md:p-3 rounded-xl bg-gray-50 hover:bg-emerald-50 transition-colors duration-200">
                                    <i class="fas fa-map-marker-alt text-emerald-500 text-base md:text-lg w-6 md:w-8"></i>
                                    <div class="ml-2 md:ml-3 min-w-0">
                                        <p class="text-xs md:text-sm text-gray-600">Alamat</p>
                                        <p class="font-medium text-gray-900 text-sm md:text-base line-clamp-2">
                                            {{ $umkm->user->address }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- Social Media Section -->
                    <div
                        class="bg-white rounded-3xl shadow-lg border border-emerald-100 p-4 md:p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <!-- Header Section -->
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                            <div class="flex items-center gap-3 md:gap-4">
                                <div class="p-2.5 md:p-3.5 bg-gradient-to-br from-purple-100 to-purple-200 rounded-2xl">
                                    <i class="fas fa-share-alt text-purple-600 text-xl md:text-2xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg md:text-xl font-bold text-gray-900">Media Sosial</h3>
                                    <p class="text-sm text-gray-600">Kelola platform sosial media UMKM</p>
                                </div>
                            </div>

                            @can('create-social_media')
                                <a href="{{ route('umkms.socialMedia.create') }}"
                                    class="group inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-medium text-white bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 transition-all duration-300 hover:shadow-lg hover:shadow-purple-200/50">
                                    <i class="fas fa-plus mr-2 group-hover:rotate-90 transition-transform duration-300"></i>
                                    <span>Tambah Media Sosial</span>
                                </a>
                            @endcan
                        </div>

                        <!-- Social Media List with Loading State -->
                        <div x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 500)">
                            <!-- Loading Skeleton -->
                            <div x-show="loading" class="space-y-4">
                                @for ($i = 0; $i < 3; $i++)
                                    <div class="animate-pulse rounded-xl bg-gray-100 p-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="h-12 w-12 rounded-full bg-gray-200"></div>
                                            <div class="flex-1 space-y-2">
                                                <div class="h-4 w-3/4 rounded bg-gray-200"></div>
                                                <div class="h-3 w-1/2 rounded bg-gray-200"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>

                            <!-- Social Media Content -->
                            <div x-show="!loading" x-transition>
                                @if ($umkm->socialMedia->count() > 0)
                                    <div class="space-y-4">
                                        @foreach ($umkm->socialMedia as $social)
                                            <div
                                                class="group relative overflow-hidden rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                                                <div
                                                    class="flex items-center justify-between p-4 bg-white hover:bg-gray-50/80 transition-colors duration-300">
                                                    <div class="flex items-center flex-grow">
                                                        <!-- Platform Icon with Dynamic Colors -->
                                                        @php
                                                            $platformColors = [
                                                                'facebook' => ['from-blue-400', 'to-blue-600'],
                                                                'instagram' => ['from-pink-500', 'to-purple-600'],
                                                                'twitter' => ['from-sky-400', 'to-sky-600'],
                                                                'youtube' => ['from-red-500', 'to-red-700'],
                                                                'tiktok' => ['from-gray-800', 'to-gray-900'],
                                                                'default' => ['from-purple-500', 'to-purple-700'],
                                                            ];
                                                            $colors =
                                                                $platformColors[
                                                                    strtolower($social->socialMedia->platform)
                                                                ] ?? $platformColors['default'];
                                                        @endphp
                                                        <div
                                                            class="w-12 h-12 flex-shrink-0 flex items-center justify-center rounded-xl bg-gradient-to-br {{ $colors[0] }} {{ $colors[1] }} text-white shadow-inner transform group-hover:scale-110 transition-transform duration-300">
                                                            <i
                                                                class="fab fa-{{ strtolower($social->socialMedia->platform) }} text-2xl"></i>
                                                        </div>

                                                        <!-- Platform Info -->
                                                        <div class="ml-4">
                                                            <span class="block text-gray-900 font-semibold text-base mb-1">
                                                                {{ $social->socialMedia->platform }}
                                                            </span>
                                                            <span
                                                                class="text-gray-600 text-sm">{{ '@' . $social->username }}</span>
                                                        </div>
                                                    </div>

                                                    <!-- Action Buttons with Tooltips -->
                                                    <div
                                                        class="flex items-center gap-2 md:opacity-0 group-hover:opacity-100 transition-all duration-300">
                                                        <a href="{{ $social->url }}" target="_blank"
                                                            class="p-2 text-purple-500 hover:text-purple-700 hover:bg-purple-50 rounded-lg transition-all duration-200"
                                                            data-tooltip="Kunjungi {{ $social->socialMedia->platform }}">
                                                            <i class="fas fa-external-link-alt"></i>
                                                        </a>

                                                        @can('edit-social_media')
                                                            <a href="{{ route('umkms.socialMedia.edit', $social) }}"
                                                                class="p-2 text-blue-500 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-all duration-200"
                                                                data-tooltip="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        @endcan

                                                        @can('delete-social_media')
                                                            <button type="button"
                                                                onclick="confirmDelete('{{ $social->id }}')"
                                                                class="p-2 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-all duration-200"
                                                                data-tooltip="Hapus">
                                                                <i class="fas fa-trash"></i>
                                                            </button>

                                                            <form id="delete-form-{{ $social->id }}"
                                                                action="{{ route('umkms.socialMedia.destroy', $social) }}"
                                                                method="POST" class="hidden">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <!-- Enhanced Empty State -->
                                    <div
                                        class="text-center py-12 bg-gradient-to-b from-purple-50/30 to-transparent rounded-xl">
                                        <div
                                            class="mb-6 bg-gradient-to-br from-purple-100 to-purple-200 w-20 h-20 mx-auto rounded-2xl flex items-center justify-center transform transition-transform hover:scale-110 duration-300">
                                            <i class="fas fa-share-alt text-purple-600 text-3xl"></i>
                                        </div>
                                        <h4 class="text-xl font-semibold text-gray-900 mb-3">Belum Ada Media Sosial</h4>
                                        <p class="text-gray-600 mb-8 max-w-md mx-auto">Tingkatkan jangkauan UMKM Anda
                                            dengan menambahkan tautan media sosial</p>
                                        @can('create-social_media')
                                            <a href="{{ route('umkms.socialMedia.create', $umkm) }}"
                                                class="inline-flex items-center px-6 py-3 rounded-xl text-sm font-medium text-white bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 transition-all duration-300 hover:shadow-lg hover:shadow-purple-200/50">
                                                <i class="fas fa-plus mr-2"></i>
                                                Tambah Media Sosial Pertama
                                            </a>
                                        @endcan
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Section -->
                <div class="bg-white rounded-3xl shadow-lg border border-emerald-100 p-8">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-900">Produk</h3>
                            <p class="text-sm text-gray-500 mt-1">Kelola daftar produk UMKM Anda</p>
                        </div>
                        @can('create-products')
                            <a href="{{ route('umkms.products.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                <i class="fas fa-plus mr-2"></i> Tambah Produk
                            </a>
                        @endcan
                    </div>

                    @if ($umkm->products->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nama Produk</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Kategori</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Harga</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($umkm->products as $product)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-12 w-12 flex-shrink-0">
                                                        @if ($product->thumbnail)
                                                            <img class="h-12 w-12 rounded-lg object-cover"
                                                                src="{{ asset('storage/images/products/' . $product->thumbnail) }}"
                                                                alt="{{ $product->name }}">
                                                        @else
                                                            <div
                                                                class="h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center">
                                                                <i class="fas fa-image text-gray-400"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ Str::limit($product->name, 30) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="text-sm text-gray-900">{{ $product->category->name }}</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="text-sm font-medium text-emerald-600">
                                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-3 py-1 text-xs font-medium rounded-full
                                    {{ $product->status === 'published'
                                        ? 'bg-green-100 text-green-800'
                                        : ($product->status === 'draft'
                                            ? 'bg-gray-100 text-gray-800'
                                            : 'bg-red-100 text-red-800') }}">
                                                    {{ ucfirst($product->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <div class="flex items-center space-x-3">
                                                    <!-- View Button -->
                                                    <a href="{{ route('umkms.products.show', $product->slug) }}"
                                                        class="group relative inline-flex items-center px-3 py-1 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100 transition-all duration-200"
                                                        data-tooltip="Lihat Detail">
                                                        <i class="fas fa-eye text-sm"></i>
                                                        <span class="ml-2 font-medium">Lihat</span>
                                                        <!-- Tooltip -->
                                                        <div
                                                            class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-3 py-1 text-xs text-white bg-gray-900 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap">
                                                            Lihat Detail
                                                            <div
                                                                class="absolute top-full left-1/2 transform -translate-x-1/2 -mt-2 border-4 border-transparent border-t-gray-900">
                                                            </div>
                                                        </div>
                                                    </a>

                                                    <!-- Edit Button -->
                                                    @can('edit-products')
                                                        <a href="{{ route('umkms.products.edit', $product->slug) }}"
                                                            class="group relative inline-flex items-center px-3 py-1 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all duration-200"
                                                            data-tooltip="Edit Produk">
                                                            <i class="fas fa-edit text-sm"></i>
                                                            <span class="ml-2 font-medium">Edit</span>
                                                            <!-- Tooltip -->
                                                            <div
                                                                class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-3 py-1 text-xs text-white bg-gray-900 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap">
                                                                Edit Produk
                                                                <div
                                                                    class="absolute top-full left-1/2 transform -translate-x-1/2 -mt-2 border-4 border-transparent border-t-gray-900">
                                                                </div>
                                                            </div>
                                                        </a>
                                                    @endcan

                                                    <!-- Delete Button (if needed) -->
                                                    @can('delete-products')
                                                        <button type="button" onclick="confirmDelete('{{ $product->id }}')"
                                                            class="group relative inline-flex items-center px-3 py-1 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all duration-200"
                                                            data-tooltip="Hapus Produk">
                                                            <i class="fas fa-trash-alt text-sm"></i>
                                                            <span class="ml-2 font-medium">Hapus</span>
                                                            <!-- Tooltip -->
                                                            <div
                                                                class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-3 py-1 text-xs text-white bg-gray-900 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap">
                                                                Hapus Produk
                                                                <div
                                                                    class="absolute top-full left-1/2 transform -translate-x-1/2 -mt-2 border-4 border-transparent border-t-gray-900">
                                                                </div>
                                                            </div>
                                                        </button>
                                                    @endcan
                                                </div>
                                            </td>

                                            <!-- Add this script if using delete functionality -->
                                            <script>
                                                function confirmDelete(productId) {
                                                    if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                                                        // Submit form or make AJAX call to delete
                                                        document.getElementById('delete-form-' + productId).submit();
                                                    }
                                                }
                                            </script>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div
                                class="bg-emerald-100 rounded-full p-4 w-16 h-16 mx-auto mb-6 flex items-center justify-center">
                                <i class="fas fa-box-open text-emerald-600 text-2xl"></i>
                            </div>
                            <h4 class="text-xl font-semibold text-gray-900 mb-2">Belum ada produk</h4>
                            <p class="text-gray-600 mb-6">UMKM ini belum memiliki produk yang ditampilkan</p>
                            @can('create-products')
                                <a href="{{ route('umkms.products.create') }}"
                                    class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                    <i class="fas fa-plus mr-2"></i> Tambah Produk Pertama
                                </a>
                            @endcan
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete(socialId) {
            if (confirm('Apakah Anda yakin ingin menghapus media sosial ini?')) {
                document.getElementById('delete-form-' + socialId).submit();
            }
        }
    </script>
@endpush

@push('styles')
    <style>
        [data-tooltip] {
            position: relative;
        }

        [data-tooltip]:hover:after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
            z-index: 10;
        }
    </style>
@endpush
