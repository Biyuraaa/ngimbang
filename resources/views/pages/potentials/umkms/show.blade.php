@extends('layouts.guest')

@section('title', $umkm->name . ' - UMKM Desa Gunungsari')

@section('content')
    <main class="min-h-screen bg-gradient-to-b from-amber-50 via-orange-50/30 to-white">
        <!-- Hero Section -->
        <div class="relative h-[70vh] overflow-hidden">
            <!-- Background Image -->
            <div class="absolute inset-0">
                @if ($umkm->thumbnail)
                    <img src="{{ asset('storage/images/umkms/' . $umkm->thumbnail) }}" alt="{{ $umkm->name }}"
                        class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                @else
                    <img src="{{ asset('assets/images/no_thumbnail.jpg') }}" alt="{{ $umkm->name }}"
                        class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                @endif
                <div class="absolute inset-0 bg-gradient-to-b from-black/70 to-black/30"></div>
            </div>

            <!-- Content -->
            <div class="relative h-full flex items-center justify-center">
                <div class="text-center text-white px-6 max-w-4xl">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 tracking-tight leading-tight">
                        {{ $umkm->name }}
                    </h1>

                    <!-- Meta Info -->
                    <div class="flex flex-wrap items-center justify-center gap-6 text-sm md:text-base">
                        <!-- Owner -->
                        <div class="flex items-center gap-2">
                            <i class="fas fa-user text-orange-400"></i>
                            <span>{{ $umkm->owner }}</span>
                        </div>

                        <!-- Address -->
                        <div class="flex items-center gap-2">
                            <i class="fas fa-map-marker-alt text-orange-400"></i>
                            <span>{{ $umkm->address }}</span>
                        </div>

                        <!-- Social Media -->
                        <div class="flex items-center gap-4">
                            @foreach ($umkm->socialMedia as $social)
                                <a href="{{ $social->socialMedia->url }}" target="_blank"
                                    class="text-white hover:text-orange-400 transition-colors">
                                    <i class="fab fa-{{ strtolower($social->platform) }}"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- UMKM Description -->
            <section class="mb-16">
                <!-- Hero Section -->
                <div
                    class="relative mb-8 bg-gradient-to-r from-amber-500 to-orange-600 rounded-3xl p-8 text-white overflow-hidden">
                    <div class="absolute inset-0 bg-black/10"></div>
                    <div class="relative z-10">
                        <h1 class="text-4xl font-bold mb-4">{{ $umkm->name }}</h1>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-map-marker-alt"></i>
                            <span class="text-sm opacity-90">{{ $umkm->address }}</span>
                        </div>
                    </div>
                </div>

                <!-- Main Content Grid with improved spacing and responsive design -->
                <div class="container mx-auto px-4 py-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Main Content Area -->
                        <div class="lg:col-span-2 space-y-8">
                            <!-- Profile Card -->
                            <div
                                class="bg-white rounded-2xl shadow-lg border border-amber-100 overflow-hidden transform transition-all duration-300 hover:shadow-xl">
                                <!-- Enhanced Header -->
                                <div class="border-b border-amber-100 bg-gradient-to-r from-amber-50 to-amber-100/30">
                                    <div class="p-8">
                                        <div celass="flex flex-col md:flex-row md:items-center justify-between gap-6">
                                            <div class="flex items-center space-x-5">
                                                <!-- Added Avatar -->
                                                <div
                                                    class="w-16 h-16 bg-amber-200 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-user text-2xl text-amber-600"></i>
                                                </div>
                                                <div>
                                                    <h2 class="text-2xl font-bold text-gray-800">{{ $umkm->owner }}</h2>
                                                    <p class="text-md text-gray-600">Pemilik UMKM</p>
                                                </div>
                                            </div>
                                            <!-- Enhanced Stats -->
                                            <div
                                                class="bg-white/50 backdrop-blur-sm px-6 py-3 rounded-xl border border-amber-100">
                                                <div class="text-3xl font-bold text-amber-600">
                                                    {{ $umkm->products()->count() }}</div>
                                                <div class="text-sm font-medium text-gray-600">Total Produk</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Enhanced Content -->
                                <div class="p-8 space-y-8">
                                    <!-- Description Section -->
                                    <div class="space-y-4">
                                        <h3 class="text-xl font-semibold text-gray-800 flex items-center gap-3">
                                            <i class="fas fa-store text-amber-500"></i>
                                            Tentang UMKM
                                        </h3>
                                        <div class="bg-amber-50/50 rounded-xl p-6 border border-amber-100">
                                            <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                                                {{ $umkm->description }}</p>
                                        </div>
                                    </div>

                                    <!-- Address Section -->
                                    <div
                                        class="flex items-start space-x-4 bg-gray-50 rounded-xl p-6 border border-gray-100">
                                        <i class="fas fa-map-marker-alt text-amber-500 text-xl mt-1"></i>
                                        <div>
                                            <h4 class="font-medium text-gray-800 mb-2">Alamat</h4>
                                            <p class="text-gray-600">{{ $umkm->address }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Enhanced Contact Card -->
                            <div
                                class="bg-white rounded-2xl shadow-lg border border-amber-100 overflow-hidden transform transition-all duration-300 hover:shadow-xl">
                                <div class="border-b border-amber-100 bg-gradient-to-r from-amber-50 to-amber-100/30 p-6">
                                    <h3 class="text-xl font-semibold text-gray-800 flex items-center gap-3">
                                        <i class="fas fa-address-book text-amber-500"></i>
                                        Kontak
                                    </h3>
                                </div>

                                <div class="p-6 space-y-4">
                                    @if ($umkm->phone)
                                        <a href="tel:{{ $umkm->phone }}"
                                            class="flex items-center space-x-4 p-4 rounded-xl hover:bg-amber-50 transition-all duration-300 group border border-transparent hover:border-amber-200">
                                            <div
                                                class="bg-amber-100 p-3 rounded-full group-hover:bg-amber-200 transition-all duration-300">
                                                <i
                                                    class="fas fa-phone text-amber-600 group-hover:scale-110 transform transition-all"></i>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="text-sm font-medium text-amber-800">Telepon</span>
                                                <span class="text-gray-600">{{ $umkm->phone }}</span>
                                            </div>
                                        </a>
                                    @endif

                                    @foreach ($umkm->socialMedia as $social)
                                        <a href="{{ $social->url }}" target="_blank"
                                            class="flex items-center space-x-4 p-4 rounded-xl hover:bg-amber-50 transition-all duration-300 group border border-transparent hover:border-amber-200">
                                            <div
                                                class="bg-amber-100 p-3 rounded-full group-hover:bg-amber-200 transition-all duration-300">
                                                <i
                                                    class="fab fa-{{ strtolower($social->socialMedia->platform) }} text-amber-600 group-hover:scale-110 transform transition-all"></i>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="text-sm font-medium text-amber-800">
                                                    {{ $social->socialMedia->platform }}
                                                </span>
                                                <span class="text-gray-600">{{ $social->username }}</span>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Featured Products -->
            <section class="mb-20">
                <!-- Section Header -->
                <div class="bg-gradient-to-r from-amber-50 to-transparent rounded-2xl p-8 mb-10">
                    <div class="flex items-center gap-4">
                        <div class="flex flex-col items-center">
                            <div class="h-12 w-1.5 bg-gradient-to-b from-amber-400 to-orange-600 rounded-full"></div>
                            <div class="h-3 w-3 bg-amber-400 rounded-full mt-1 animate-bounce"></div>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold text-gray-800 mb-2">Produk Unggulan</h2>
                            <p class="text-gray-600">Koleksi produk terbaik dari {{ $umkm->name }}</p>
                        </div>
                    </div>
                </div>

                @if ($featuredProducts->isEmpty())
                    <div class="bg-white rounded-2xl shadow-lg border border-amber-100 p-16">
                        <div class="max-w-md mx-auto text-center">
                            <div class="mb-8">
                                <div class="inline-flex items-center justify-center w-20 h-20 bg-amber-50 rounded-full">
                                    <i class="fas fa-box-open text-5xl text-amber-300"></i>
                                </div>
                            </div>
                            <h3 class="text-2xl font-semibold text-gray-800 mb-3">Belum Ada Produk</h3>
                            <p class="text-gray-600 leading-relaxed">UMKM ini belum menambahkan produk unggulan ke koleksi
                                mereka.</p>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($featuredProducts as $product)
                            <div
                                class="group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-amber-100 overflow-hidden">
                                <!-- Image Container -->
                                <div class="relative aspect-[5/4] overflow-hidden">
                                    <img src="{{ asset('storage/images/products/' . $product->thumbnail) }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-in-out">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <div class="absolute bottom-0 left-0 right-0 p-6">
                                            <p
                                                class="text-white text-sm line-clamp-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-100">
                                                {{ $product->description }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Category Badge -->
                                    <div class="absolute top-4 left-4">
                                        <span
                                            class="px-4 py-2 bg-white/95 backdrop-blur-sm text-amber-600 text-sm font-medium rounded-full shadow-sm border border-amber-100/30">
                                            {{ $product->category->name }}
                                        </span>
                                    </div>

                                    @if ($product->ratings_avg_score)
                                        <!-- Rating Badge -->
                                        <div class="absolute top-4 right-4">
                                            <div
                                                class="flex items-center gap-1.5 px-3 py-2 bg-white/95 backdrop-blur-sm rounded-full shadow-sm border border-amber-100/30">
                                                <i class="fas fa-star text-amber-400"></i>
                                                <span class="text-sm font-medium text-gray-800">
                                                    {{ number_format($product->ratings_avg_score, 1) }}
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Content -->
                                <div class="p-6">
                                    <h3
                                        class="text-xl font-bold text-gray-800 mb-3 group-hover:text-amber-600 transition-colors">
                                        {{ $product->name }}
                                    </h3>

                                    <div class="flex items-center justify-between">
                                        <div class="flex flex-col">
                                            <span class="text-sm text-gray-500 mb-1">Harga</span>
                                            <span
                                                class="text-2xl font-bold bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </span>
                                        </div>
                                        <a href="{{ route('umkm.product.show', [$umkm->slug, $product->slug]) }}"
                                            class="relative inline-flex items-center px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-xl overflow-hidden shadow-lg hover:shadow-amber-200/50 transition-all duration-300 group/btn">
                                            <span class="relative z-10">Detail</span>
                                            <i
                                                class="fas fa-arrow-right ml-2 relative z-10 group-hover/btn:translate-x-1 transition-transform"></i>
                                            <div
                                                class="absolute inset-0 bg-gradient-to-r from-orange-600 to-amber-500 opacity-0 group-hover/btn:opacity-100 transition-opacity duration-300">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </section>

            <!-- All Products -->
            <section class="mb-20">
                <div class="bg-gradient-to-r from-amber-50 to-transparent rounded-2xl p-6 mb-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="flex items-start gap-4 mb-4 md:mb-0">
                            <div class="flex flex-col items-center">
                                <div class="h-12 w-1.5 bg-gradient-to-b from-amber-400 to-orange-600 rounded-full"></div>
                                <div class="h-3 w-3 bg-amber-400 rounded-full mt-1 animate-bounce"></div>
                            </div>
                            <div>
                                <h2 class="text-3xl font-bold text-gray-800 mb-2">Semua Produk</h2>
                                <p class="text-gray-600">
                                    Jelajahi
                                    <span class="font-medium text-amber-600">
                                        {{ $umkm->products->count() }}
                                    </span>
                                    koleksi produk dari {{ $umkm->name }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div
                                class="inline-flex items-center px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-amber-100">
                                <i class="fas fa-th-large text-amber-500 mr-2"></i>
                                <span class="font-medium text-gray-700">{{ $umkm->products->count() }}
                                    Produk</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($umkm->products as $product)
                        <div
                            class="group bg-white rounded-xl shadow-md hover:shadow-xl border border-amber-100/50 overflow-hidden transition-all duration-300">
                            <!-- Image Container -->
                            <div class="relative aspect-square overflow-hidden">
                                <img src="{{ asset('storage/images/products/' . $product->thumbnail) }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                                @if ($product->ratings_avg_score)
                                    <div class="absolute top-3 right-3">
                                        <div class="flex items-center gap-1 px-2 py-1 bg-white/90 rounded-lg text-sm">
                                            <i class="fas fa-star text-amber-400"></i>
                                            <span
                                                class="font-medium text-gray-800">{{ number_format($product->ratings_avg_score, 1) }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="p-4">
                                <div class="mb-3">
                                    <span class="text-xs font-medium text-amber-600 bg-amber-50 px-2 py-1 rounded-md">
                                        {{ $product->category->name }}
                                    </span>
                                </div>
                                <h3
                                    class="text-lg font-semibold text-gray-800 mb-2 group-hover:text-amber-600 transition-colors">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    {{ $product->description }}
                                </p>
                                <div class="flex items-center justify-between">
                                    <span
                                        class="text-lg font-bold bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                    <a href="{{ route('umkm.product.show', [$umkm->slug, $product->slug]) }}"
                                        class="inline-flex items-center px-3 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm rounded-lg transition-colors">
                                        <span>Detail</span>
                                        <i class="fas fa-chevron-right ml-1.5 text-xs"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

        </div>
    </main>
@endsection
