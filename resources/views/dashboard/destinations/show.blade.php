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
                            <i class="fas fa-chevron-right text-emerald-300 mx-2"></i>
                            <a href="{{ route('destinations.index') }}"
                                class="text-emerald-600 hover:text-emerald-800 font-medium transition-colors duration-200">
                                Wisata
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-emerald-300 mx-2"></i>
                            <span class="text-emerald-800 font-medium">{{ $destination->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!--  Header Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-4 sm:p-6 mb-4 sm:mb-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                    <div class="flex items-center space-x-4">
                        <div
                            class="bg-gradient-to-br from-emerald-500 to-green-600 p-3 rounded-xl shadow-lg shadow-emerald-200">
                            <i class="fas fa-info-circle text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">{{ $destination->name }}</h2>
                            <p class="text-sm text-emerald-600">Informasi lengkap destinasi wisata di Desa Gunung Sari</p>
                        </div>
                    </div>
                    <div class="flex space-x-2">

                        <a href="{{ route('destinations.index') }}"
                            class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium text-emerald-700 bg-emerald-100 hover:bg-emerald-200 transition-all duration-300">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                        @if (Auth::user()->can('edit-destinations'))
                            <a href="{{ route('destinations.editAdmin') }}"
                                class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium text-white bg-emerald-500 hover:bg-emerald-600 transition-all duration-300">
                                <i class="fas fa-edit mr-2"></i>
                                Edit
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-emerald-100 overflow-hidden">
                    <div class="relative h-[480px]">
                        <img src="{{ $destination->thumbnail ? asset('storage/images/destinations/' . $destination->thumbnail) : asset('assets/images/no_thumbnail.jpg') }}"
                            alt="{{ $destination->name }}" class="w-full h-full object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6">
                            <h1 class="text-4xl font-bold text-white">{{ $destination->name }}</h1>
                        </div>
                    </div>
                </div>

                <!-- Gallery Section -->
                <div class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-6">
                    <!-- Header -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                        <div class="flex items-center space-x-3">
                            <div class="bg-gradient-to-br from-emerald-500 to-green-600 p-2 rounded-lg shadow-sm">
                                <i class="fas fa-images text-white"></i>
                            </div>
                            <h3 class="text-lg md:text-xl font-bold text-gray-800">Galeri Foto</h3>
                        </div>
                        <div class="flex gap-2">
                            <label for="gallery-upload"
                                class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium text-white bg-emerald-500 hover:bg-emerald-600 transition-all duration-300 cursor-pointer">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Foto
                            </label>
                            <button id="edit-gallery"
                                class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium text-emerald-700 bg-emerald-100 hover:bg-emerald-200 transition-all duration-300">
                                <i class="fas fa-edit mr-2"></i>
                                Edit Galeri
                            </button>
                        </div>
                    </div>

                    <!-- Hidden File Input -->
                    <form id="gallery-upload-form" class="hidden" enctype="multipart/form-data">
                        @csrf
                        <input type="file" id="gallery-upload" name="galleries[]" accept="image/*" class="hidden"
                            multiple>
                    </form>

                    @if ($destination->galleries->isEmpty())
                        <!-- Empty State -->
                        <div class="text-center py-12">
                            <div class="mb-4">
                                <i class="fas fa-images text-6xl text-emerald-200"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Foto</h3>
                            <p class="text-gray-500 mb-6">Tambahkan foto untuk menampilkan galeri wisata ini</p>
                            <label for="gallery-upload"
                                class="inline-flex items-center px-6 py-3 rounded-xl text-sm font-medium text-white 
                bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700
                transition-all duration-300 cursor-pointer shadow-sm hover:shadow-md">
                                <i class="fas fa-cloud-upload-alt mr-2"></i>
                                Upload Foto Pertama
                            </label>
                        </div>
                    @else
                        <!-- Gallery Grid -->
                        <div id="gallery-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                            @foreach ($destination->galleries as $gallery)
                                <div class="relative group" data-gallery-id="{{ $gallery->id }}">
                                    <img src="{{ asset('storage/' . $gallery->path) }}" alt="Gallery image"
                                        class="w-full aspect-square object-cover rounded-xl cursor-pointer hover:opacity-75 transition"
                                        onclick="openLightbox('{{ asset('storage/' . $gallery->path) }}')">
                                    <button
                                        class="delete-gallery-btn hidden absolute top-2 right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-600 transition-all duration-300">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Loading Indicator -->
                    <div id="gallery-loading"
                        class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                        <div class="bg-white p-4 rounded-xl">
                            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-emerald-500"></div>
                        </div>
                    </div>
                </div>

                <!--Main Section -->
                <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="space-y-6">
                        <!-- Location Info -->
                        <div
                            class="bg-gradient-to-br from-white to-emerald-50/50 rounded-2xl shadow-sm border border-emerald-100 p-6 hover:shadow-md transition-all duration-300 relative overflow-hidden group">
                            <!-- Decorative Element -->
                            <div
                                class="absolute -right-6 -top-6 opacity-5 transform rotate-12 transition-transform group-hover:rotate-45 duration-700">
                                <i class="fas fa-map-marked-alt text-8xl text-emerald-900"></i>
                            </div>
                            <!-- Section Header -->
                            <div class="flex items-center space-x-3 mb-6">
                                <div class="bg-gradient-to-br from-emerald-500 to-green-600 p-2 rounded-lg shadow-sm">
                                    <i class="fas fa-location-dot text-white"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">Informasi Lokasi</h3>
                            </div>

                            <!-- Info Items -->
                            <div class="space-y-6">
                                <!-- Address -->
                                <div
                                    class="group/item p-4 rounded-xl bg-white/50 hover:bg-emerald-50/50 transition-all duration-300">
                                    <div class="text-sm font-medium text-emerald-600 mb-2">Alamat</div>
                                    <div class="text-gray-700 flex items-center">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center mr-3 group-hover/item:bg-emerald-200 transition-colors duration-300">
                                            <i class="fas fa-map-marker-alt text-emerald-600"></i>
                                        </div>
                                        <span
                                            class="text-gray-800 ml-4">{{ $destination->address ?? 'Belum ada lokasi' }}</span>
                                    </div>
                                </div>
                                <!-- Operating Hours -->
                                <div
                                    class="group/item p-4 rounded-xl bg-white/50 hover:bg-emerald-50/50 transition-all duration-300">
                                    <div class="text-sm font-medium text-emerald-600 mb-2">Jam Operasional</div>
                                    <div class="text-gray-700 flex items-center">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center mr-3 group-hover/item:bg-emerald-200 transition-colors duration-300">
                                            <i class="fas fa-clock text-emerald-600"></i>
                                        </div>
                                        <span class="text-gray-800 ml-4">
                                            {{ \Carbon\Carbon::parse($destination->open_at)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($destination->close_at)->format('H:i') }}
                                            <span class="text-emerald-600 font-medium">WIB</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description Section -->
                    <div class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-6">
                        <!-- Section Header -->
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="bg-gradient-to-br from-emerald-500 to-green-600 p-2 rounded-lg shadow-sm">
                                <i class="fas fa-info-circle text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Tentang Wisata Ini</h3>
                        </div>
                        <!-- Description Content -->
                        <div class="prose prose-emerald max-w-none">
                            <p class="text-gray-600 leading-relaxed text-justify">
                                {{ $destination->description }}
                            </p>
                        </div>
                    </div>
                </section>

                <!-- Price Section -->
                <section
                    class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-4 md:p-6 hover:shadow-md transition-all duration-300">
                    <!-- Header Section -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                        <div class="flex items-center space-x-3">
                            <div class="bg-gradient-to-br from-emerald-500 to-green-600 p-2 rounded-lg shadow-sm">
                                <i class="fas fa-tag text-white"></i>
                            </div>
                            <h3 class="text-lg md:text-xl font-bold text-gray-800">Daftar Harga</h3>
                        </div>
                        @if (Auth::user()->can('create-prices'))
                            <a href="{{ route('destinations.prices.create') }}"
                                class="w-full md:w-auto inline-flex items-center justify-center px-4 py-2 rounded-xl text-sm font-medium text-white bg-emerald-500 hover:bg-emerald-600 transition-all duration-300">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Harga Tiket
                            </a>
                        @endif
                    </div>

                    <!-- Table Section - Hidden on Mobile -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tipe</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Deskripsi</th>
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
                                @forelse($destination->destinationPriceRules as $rule)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-emerald-600">
                                                {{ $rule->priceRuleType->name }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-500">{{ $rule->priceRuleType->description }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-semibold text-gray-900">Rp
                                                {{ number_format($rule->price, 0, ',', '.') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $rule->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ ucfirst($rule->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('destinations.prices.edit', $rule) }}"
                                                class="inline-flex items-center px-2 py-1 text-sm rounded-lg text-orange-700 bg-orange-50 border border-orange-200 hover:bg-orange-100 transition-colors duration-200">
                                                <i class="fas fa-edit mr-1.5"></i>
                                                Edit
                                            </a>
                                            <form action="{{ route('destinations.prices.destroy', $rule) }}"
                                                method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?');"
                                                    class="inline-flex items-center px-2 py-1 text-sm rounded-lg text-red-700 bg-red-50 border border-red-200 hover:bg-red-100 transition-colors duration-200">
                                                    <i class="fas fa-trash mr-1.5"></i>
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-sm text-gray-500 text-center">
                                            Belum ada harga yang ditentukan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Card View - Visible on Mobile -->
                    <div class="md:hidden space-y-4">
                        @forelse($destination->destinationPriceRules as $rule)
                            <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-medium text-emerald-600">{{ $rule->priceRuleType->name }}</h4>
                                        <p class="text-sm text-gray-500 mt-1">{{ $rule->priceRuleType->description }}</p>
                                    </div>
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full {{ $rule->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($rule->status) }}
                                    </span>
                                </div>

                                <div class="text-lg font-semibold text-gray-900">
                                    Rp {{ number_format($rule->price, 0, ',', '.') }}
                                </div>

                                <div class="flex flex-col gap-2">
                                    @if (Auth::user()->can('edit-prices'))
                                        <a href="{{ route('destinations.prices.edit', $rule) }}"
                                            class="inline-flex items-center justify-center px-4 py-2 rounded-xl text-sm font-medium text-white bg-emerald-500 hover:bg-emerald-600 transition-all duration-300">
                                            <i class="fas fa-edit mr-2"></i>
                                            Perbarui Harga
                                        </a>
                                    @endif
                                    @if (Auth::user()->can('delete-prices'))
                                        <form action="{{ route('destinations.prices.destroy', $rule) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus harga ini?');"
                                                class="w-full text-center px-4 py-2 rounded-xl text-sm font-medium text-red-600 bg-red-50 hover:bg-red-100 transition-all duration-300">
                                                <i class="fas fa-trash mr-2"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6 text-gray-500">
                                Belum ada harga yang ditentukan
                            </div>
                        @endforelse
                    </div>
                </section>

                <!-- Attractions Section -->
                <section
                    class="bg-gradient-to-br from-white to-emerald-50/50 rounded-2xl shadow-sm border border-emerald-100 p-6 hover:shadow-md transition-all duration-300 relative overflow-hidden group">
                    <!-- Decorative Elements -->
                    <div
                        class="absolute -right-6 -top-6 opacity-5 transform rotate-12 transition-transform group-hover:rotate-45 duration-700">
                        <i class="fas fa-puzzle-piece text-8xl text-emerald-900"></i>
                    </div>

                    <!-- Section Header -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                        <div class="flex items-center space-x-4">
                            <div
                                class="bg-gradient-to-br from-emerald-500 to-green-600 p-3 rounded-xl shadow-md transform transition-transform duration-300 hover:scale-105">
                                <i class="fas fa-puzzle-piece text-white text-xl"></i>
                            </div>
                            <h3
                                class="text-2xl font-bold bg-gradient-to-r from-emerald-600 to-green-600 bg-clip-text text-transparent">
                                Wahana
                            </h3>
                        </div>

                        @if (Auth::user()->can('create-attractions'))
                            <a href="{{ route('destinations.attractions.create') }}"
                                class="group w-full md:w-auto inline-flex items-center justify-center px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-emerald-500 to-green-500 hover:from-emerald-600 hover:to-green-600 shadow-sm hover:shadow-md transform hover:-translate-y-0.5 transition-all duration-200 ease-in-out">
                                <i class="fas fa-plus mr-2.5 group-hover:rotate-90 transition-transform duration-300"></i>
                                <span>Tambah Wahana</span>
                            </a>
                        @endif
                    </div>

                    <!-- Attractions List -->
                    <div class="space-y-8">
                        @forelse ($destination->attractions as $index => $attraction)
                            <div class="group/item">
                                <div
                                    class="flex flex-col md:flex-row {{ $index % 2 == 0 ? '' : 'md:flex-row-reverse' }} gap-6 bg-white/50 rounded-2xl p-4 hover:bg-emerald-50/30 transition-all duration-300">
                                    <div
                                        class="w-full md:w-2/5 lg:w-1/3 overflow-hidden rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 relative group/image">
                                        <div class="relative aspect-[3/3]">
                                            <img src="{{ $attraction->thumbnail ? asset('storage/images/destinations/attractions/' . $attraction->thumbnail) : asset('assets/images/no_thumbnail.jpg') }}"
                                                alt="{{ $attraction->name }}"
                                                class="w-full h-full object-fill transform transition-transform duration-500 ease-out group-hover/image:scale-110"
                                                onerror="this.src='{{ asset('assets/images/no-thumbnail.jpg') }}'"
                                                loading="lazy">

                                            <!-- Overlay Gradient -->
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover/image:opacity-100 transition-opacity duration-300">
                                            </div>

                                            <!-- Title Overlay -->
                                            <div
                                                class="absolute bottom-0 left-0 right-0 p-4 transform translate-y-full group-hover/image:translate-y-0 transition-transform duration-300">
                                                <h3 class="text-white font-semibold text-lg drop-shadow-md">
                                                    {{ $attraction->name }}
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="flex-1 flex flex-col justify-center {{ $index % 2 == 0 ? 'md:pl-2' : 'md:pr-2' }}">
                                        <div class="space-y-4">
                                            <div class="flex items-center justify-between space-x-2">
                                                <div class="flex items-center space-x-2 flex-grow">
                                                    <h4
                                                        class="text-xl font-semibold text-gray-900 group-hover/item:text-emerald-600 transition-colors duration-300">
                                                        {{ $attraction->name }}
                                                    </h4>
                                                    <div
                                                        class="h-px flex-1 bg-emerald-100 group-hover/item:bg-emerald-200 transition-colors duration-300">
                                                    </div>
                                                </div>
                                                @if (Auth::user()->can('edit-attractions'))
                                                    <a href="{{ route('destinations.attractions.edit', $attraction) }}"
                                                        class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium text-white bg-emerald-500 hover:bg-emerald-600 transition-colors duration-200 ease-in-out">
                                                        <i class="fas fa-edit mr-1.5"></i>
                                                        Edit
                                                    </a>
                                                @endif
                                            </div>
                                            @if ($attraction->description)
                                                <div
                                                    class="bg-white/50 rounded-lg p-4 group-hover/item:bg-white/80 transition-all duration-300">
                                                    <p class="text-gray-600 leading-relaxed">
                                                        {{ $attraction->description }}
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if (!$loop->last)
                                    <div class="h-px bg-emerald-100/50 my-8 w-1/2 mx-auto"></div>
                                @endif
                            </div>
                        @empty
                            <div class="text-center py-16 px-4">
                                <div class="max-w-md mx-auto">
                                    <div
                                        class="bg-emerald-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                                        <i class="fas fa-ticket-alt text-3xl text-emerald-400"></i>
                                    </div>
                                    <div class="bg-white/50 rounded-xl p-6">
                                        <h4 class="text-xl font-semibold text-gray-900 mb-3">Belum Ada Atraksi</h4>
                                        <p class="text-gray-500">Destinasi ini belum menambahkan atraksi atau fasilitas
                                            apapun. Silakan kembali lagi nanti untuk melihat pembaruan.</p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </section>

                <!-- Facilities Section -->
                <section
                    class="bg-gradient-to-br from-white to-emerald-50/50 rounded-2xl shadow-sm border border-emerald-100 p-6 hover:shadow-md transition-all duration-300 relative overflow-hidden group mt-6">
                    <!-- Decorative Elements -->
                    <div
                        class="absolute -right-6 -top-6 opacity-5 transform rotate-12 transition-transform group-hover:rotate-45 duration-700">
                        <i class="fas fa-cogs text-8xl text-emerald-900"></i>
                    </div>

                    <!-- Section Header -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                        <div class="flex items-center space-x-4">
                            <div
                                class="bg-gradient-to-br from-emerald-500 to-green-600 p-3 rounded-xl shadow-md transform transition-transform duration-300 hover:scale-105">
                                <i class="fas fa-cogs text-white text-xl"></i>
                            </div>
                            <h3
                                class="text-2xl font-bold bg-gradient-to-r from-emerald-600 to-green-600 bg-clip-text text-transparent">
                                Fasilitas
                            </h3>
                        </div>

                        @if (Auth::user()->can('create-facilities'))
                            <a href="{{ route('destinations.facilities.create') }}"
                                class="group w-full md:w-auto inline-flex items-center justify-center px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-emerald-500 to-green-500 hover:from-emerald-600 hover:to-green-600 shadow-sm hover:shadow-md transform hover:-translate-y-0.5 transition-all duration-200 ease-in-out">
                                <i class="fas fa-plus mr-2.5 group-hover:rotate-90 transition-transform duration-300"></i>
                                <span>Tambah Fasilitas</span>
                            </a>
                        @endif
                    </div>

                    <!-- Facilities Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Deskripsi</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kapasitas</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($destination->facilities as $facility)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $facility->name }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-500">
                                                {{ Str::limit($facility->description, 100) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $facility->capacity ?? 'N/A' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if (Auth::user()->can('edit-facilities'))
                                                <a href="{{ route('destinations.facilities.edit', $facility) }}"
                                                    class="inline-flex items-center px-2 py-1 text-sm rounded-lg text-orange-700 bg-orange-50 border border-orange-200 hover:bg-orange-100 transition-colors duration-200">
                                                    <i class="fas fa-edit mr-1.5"></i>
                                                    Edit
                                                </a>
                                            @endif
                                            @if (Auth::user()->can('delete-facilities'))
                                                <form action="{{ route('destinations.facilities.destroy', $facility) }}"
                                                    method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?');"
                                                        class="inline-flex items-center px-2 py-1 text-sm rounded-lg text-red-700 bg-red-50 border border-red-200 hover:bg-red-100 transition-colors duration-200">
                                                        <i class="fas fa-trash mr-1.5"></i>
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4"
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            Belum ada fasilitas yang ditambahkan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
                <!-- Reviews Section -->
                <section
                    class="bg-gradient-to-br from-white to-emerald-50/50 rounded-2xl shadow-sm border border-emerald-100 p-4 sm:p-6 hover:shadow-md transition-all duration-300">
                    <!-- Section Header -->
                    <div class="flex items-center space-x-3 mb-4 sm:mb-6">
                        <div class="bg-gradient-to-br from-emerald-500 to-green-600 p-2 rounded-lg shadow-sm">
                            <i class="fas fa-star text-white text-sm sm:text-base"></i>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold text-gray-800">Ulasan Pengunjung</h3>
                    </div>
                    <!-- Rating Statistics -->
                    <div
                        class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-8 mb-6 sm:mb-8 p-4 sm:p-6 bg-emerald-50/50 rounded-xl">
                        <div class="text-center mb-4 sm:mb-0 sm:mr-4">
                            <div
                                class="text-3xl sm:text-4xl font-bold bg-gradient-to-r from-emerald-600 to-green-600 bg-clip-text text-transparent">
                                {{ number_format($destination->averageRating(), 1) }}
                            </div>
                            <div class="text-xs sm:text-sm font-medium text-emerald-600">dari 5 bintang</div>
                            <div class="text-xs text-emerald-500 mt-1">{{ $destination->ratingCount() }} ulasan</div>
                        </div>

                        <div class="flex-1 space-y-2 w-full sm:w-auto">
                            @php
                                $distribution = $destination->getRatingDistribution();
                            @endphp
                            @foreach (range(5, 1) as $star)
                                @php
                                    $count = $distribution->where('score', $star)->first()?->count ?? 0;
                                    $percentage =
                                        $destination->ratingCount() > 0
                                            ? ($count / $destination->ratingCount()) * 100
                                            : 0;
                                @endphp
                                <div class="flex items-center group">
                                    <span
                                        class="text-xs sm:text-sm font-medium text-emerald-700 w-6 sm:w-8">{{ $star }}
                                        <i class="fas fa-star text-xs"></i></span>
                                    <div class="flex-1 h-2 sm:h-3 bg-emerald-100 rounded-full mx-2 overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-emerald-500 to-green-600 rounded-full transition-all duration-500 group-hover:shadow-lg"
                                            style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <span
                                        class="text-xs sm:text-sm text-emerald-600 w-8 sm:w-12">{{ $count }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Review List -->
                    <div class="space-y-4 sm:space-y-6">
                        @forelse ($destination->ratings()->with('user')->latest()->take(5)->get() as $rating)
                            <div
                                class="group p-3 sm:p-4 rounded-xl border border-emerald-50 hover:border-emerald-100 transition-all duration-300">
                                <div class="flex items-start space-x-3 sm:space-x-4">
                                    <div class="flex-shrink-0">
                                        @php
                                            $initials = collect(explode(' ', $rating->user->name))
                                                ->map(function ($segment) {
                                                    return strtoupper(substr($segment, 0, 1));
                                                })
                                                ->take(2)
                                                ->join('');
                                        @endphp
                                        <div
                                            class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center text-white font-medium text-xs sm:text-sm">
                                            {{ $initials }}
                                        </div>
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start mb-2">
                                            <div>
                                                <div
                                                    class="font-semibold text-gray-900 group-hover:text-emerald-700 transition-colors duration-300 text-sm sm:text-base truncate">
                                                    {{ $rating->user->name }}
                                                </div>
                                                <div class="flex items-center space-x-1 text-emerald-500">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i
                                                            class="fas fa-star {{ $i <= $rating->score ? 'text-emerald-500' : 'text-gray-200' }} text-xs sm:text-sm"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="text-xs sm:text-sm text-emerald-600 font-medium mt-1 sm:mt-0">
                                                {{ $rating->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                        @if ($rating->review)
                                            <p
                                                class="text-gray-600 leading-relaxed text-sm sm:text-base line-clamp-3 sm:line-clamp-none">
                                                {{ $rating->review }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-gray-500 py-4">
                                Belum ada ulasan untuk destinasi ini.
                            </div>
                        @endforelse
                    </div>

                    @if ($destination->ratings()->count() > 5)
                        <div class="mt-6 text-center">
                            <a href="{{ route('destination.reviews', $destination) }}"
                                class="inline-block px-4 py-2 bg-emerald-500 text-white rounded-full hover:bg-emerald-600 transition-colors duration-300 text-sm sm:text-base">
                                Lihat Semua Ulasan
                            </a>
                        </div>
                    @endif
                </section>

                <!-- Comments Section -->
                <section
                    class="bg-gradient-to-br from-white to-emerald-50/50 rounded-2xl shadow-sm border border-emerald-100 p-6 hover:shadow-md transition-all duration-300">
                    <!-- Section Header -->
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="bg-gradient-to-br from-emerald-500 to-green-600 p-2 rounded-lg shadow-sm">
                            <i class="fas fa-comments text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Komentar</h3>
                    </div>

                    <!-- Comments List -->
                    <div class="space-y-6">
                        @forelse ($destination->comments()->with('user')->latest()->get() as $comment)
                            <div
                                class="group p-4 rounded-xl border border-emerald-50 hover:border-emerald-100 transition-all duration-300">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0">
                                        @php
                                            $initials = collect(explode(' ', $comment->user->name))
                                                ->map(function ($segment) {
                                                    return strtoupper(substr($segment, 0, 1));
                                                })
                                                ->take(2)
                                                ->join('');
                                        @endphp
                                        <div
                                            class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center text-white font-medium text-sm">
                                            {{ $initials }}
                                        </div>
                                    </div>

                                    <div class="flex-1">
                                        <div class="flex justify-between items-start mb-2">
                                            <div
                                                class="font-semibold text-gray-900 group-hover:text-emerald-700 transition-colors duration-300">
                                                {{ $comment->user->name }}
                                            </div>
                                            <div class="text-sm text-emerald-600 font-medium">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                        <p class="text-gray-600 leading-relaxed">{{ $comment->content }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500">
                                <i class="fas fa-comments text-4xl mb-3 text-emerald-200"></i>
                                <p>Belum ada komentar</p>
                            </div>
                        @endforelse
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButton = document.getElementById('edit-gallery');
            const galleryUploadForm = document.getElementById('gallery-upload-form');
            const galleryUploadInput = document.getElementById('gallery-upload');
            const galleryPreview = document.getElementById('galleryPreview');
            const galleryGrid = document.getElementById('gallery-grid');
            const loadingIndicator = document.getElementById('gallery-loading');
            let isEditMode = false;

            // Toggle Edit Mode
            editButton.addEventListener('click', function() {
                isEditMode = !isEditMode;
                const deleteButtons = document.querySelectorAll('.delete-gallery-btn');

                deleteButtons.forEach(btn => {
                    btn.classList.toggle('hidden');
                });

                editButton.innerHTML = isEditMode ?
                    '<i class="fas fa-check mr-2"></i>Selesai' :
                    '<i class="fas fa-edit mr-2"></i>Edit Galeri';
            });

            // Handle File Selection
            galleryUploadInput.addEventListener('change', function(e) {
                galleryPreview.innerHTML = ''; // Clear previous previews
                const files = e.target.files;

                if (files.length > 10) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terlalu Banyak File',
                        text: 'Maksimal 10 foto yang dapat diunggah sekaligus.'
                    });
                    galleryUploadInput.value = '';
                    return;
                }

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    if (file.size > 2 * 1024 * 1024) {
                        Swal.fire({
                            icon: 'error',
                            title: 'File Terlalu Besar',
                            text: 'Ukuran file tidak boleh lebih dari 2MB.'
                        });
                        continue;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative';
                        div.innerHTML = `
                    <img src="${e.target.result}" class="w-full aspect-square object-cover rounded-xl">
                    <button type="button" class="remove-preview absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                        galleryPreview.appendChild(div);
                    }
                    reader.readAsDataURL(file);
                }
            });

            if (galleryPreview) {
                galleryPreview.addEventListener('click', function(e) {
                    if (e.target.closest('.remove-preview')) {
                        e.target.closest('.relative').remove();
                    }
                });
            }

            // Handle File Upload
            galleryUploadForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                loadingIndicator.classList.remove('hidden');

                const formData = new FormData(galleryUploadForm);

                try {
                    const response = await fetch('{{ route('destinations.galleries.store') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (!response.ok) throw new Error(data.message || 'Upload failed');

                    // Add new images to the grid
                    data.galleries.forEach(gallery => {
                        const newGalleryDiv = document.createElement('div');
                        newGalleryDiv.className = 'relative group';
                        newGalleryDiv.dataset.galleryId = gallery.id;

                        newGalleryDiv.innerHTML = `
                    <img src="${gallery.url}" 
                         alt="Gallery image"
                         class="w-full aspect-square object-cover rounded-xl cursor-pointer hover:opacity-75 transition"
                         onclick="openLightbox('${gallery.url}')">
                    <button class="delete-gallery-btn hidden absolute top-2 right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-600 transition-all duration-300">
                        <i class="fas fa-times"></i>
                    </button>
                `;

                        galleryGrid.appendChild(newGalleryDiv);
                    });

                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Foto berhasil ditambahkan ke galeri',
                        timer: 1500,
                        showConfirmButton: false
                    });

                    // Clear preview and form
                    galleryPreview.innerHTML = '';
                    galleryUploadForm.reset();

                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: error.message || 'Terjadi kesalahan saat mengunggah foto'
                    });
                } finally {
                    loadingIndicator.classList.add('hidden');
                }
            });

            if (!galleryGrid) return;

            galleryGrid.addEventListener('click', async function(e) {
                if (!e.target.closest('.delete-gallery-btn')) return;

                const galleryDiv = e.target.closest('[data-gallery-id]');
                if (!galleryDiv) return;

                const galleryId = galleryDiv.dataset.galleryId;

                try {
                    const result = await Swal.fire({
                        title: 'Hapus Foto?',
                        text: "Foto akan dihapus secara permanen",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    });

                    if (!result.isConfirmed) return;

                    if (loadingIndicator) {
                        loadingIndicator.classList.remove('hidden');
                    }

                    const response = await fetch(`/destinations/galleries/${galleryId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) throw new Error('Delete failed');

                    galleryDiv.remove();

                    await Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Foto berhasil dihapus',
                        timer: 1500,
                        showConfirmButton: false
                    });

                } catch (error) {
                    console.error('Delete error:', error);
                    await Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan saat menghapus foto'
                    });
                } finally {
                    if (loadingIndicator) {
                        loadingIndicator.classList.add('hidden');
                    }
                }
            });
        });
    </script>
@endpush
