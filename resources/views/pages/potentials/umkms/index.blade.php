@extends('layouts.guest')

@section('title', 'UMKM Desa Ngimbang')

@section('content')
    <main class="min-h-screen bg-gradient-to-b from-amber-100 via-orange-50/30 to-white">
        <!-- Hero Section -->
        <section class="relative min-h-[70vh] flex items-center border-b border-amber-100 overflow-hidden">
            <!-- Background Image & Overlay -->
            <div class="absolute inset-0">
                <img src="{{ asset('assets/images/hero-umkm.png') }}" alt="UMKM Gunung Sari"
                    class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-amber-900/90 to-amber-800/75"></div>
                <div class="absolute inset-0 bg-[url('{{ asset('assets/images/batik-pattern.svg') }}')] opacity-10"></div>
            </div>

            <!-- Content -->
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
                <div class="max-w-4xl">
                    <!-- Decorative Element -->
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm mb-6">
                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                        <span class="text-amber-100 text-sm font-medium">Jelajahi UMKM Lokal</span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                        Dukung Kreativitas<br>
                        <span class="text-amber-400">UMKM Ngimbang</span>
                    </h1>

                    <!-- Description -->
                    <p class="text-amber-100 text-lg md:text-xl mb-8 max-w-2xl leading-relaxed">
                        Temukan keunikan produk lokal dan dukung pertumbuhan ekonomi Desa Ngimbang melalui UMKM kami.
                        Setiap pembelian membantu memajukan komunitas!
                    </p>

                    <!-- CTA Button -->
                    <a href="#all-umkm"
                        class="inline-flex items-center px-6 py-3 bg-amber-500 text-white rounded-full hover:bg-amber-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <span class="mr-2">Jelajahi UMKM</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>

                    <!-- Stats -->
                    <div class="flex justify-center items-center gap-4 sm:gap-8 mt-8 sm:mt-12">
                        <div class="text-center">
                            <div class="text-xl sm:text-3xl font-bold text-white mb-1">{{ $umkms->count() }}+</div>
                            <div class="text-xs sm:text-base text-amber-200">UMKM Aktif</div>
                        </div>

                        <div class="text-center border-l border-amber-200/20 pl-4 sm:pl-8">
                            <div class="text-xl sm:text-3xl font-bold text-white mb-1">100+</div>
                            <div class="text-xs sm:text-base text-amber-200">Produk Lokal</div>
                        </div>

                        <div class="text-center border-l border-amber-200/20 pl-4 sm:pl-8">
                            <div class="text-xl sm:text-3xl font-bold text-white mb-1">500+</div>
                            <div class="text-xs sm:text-base text-amber-200">Pelanggan Puas</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Decorative Shapes -->
            <div class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-b from-transparent to-white"></div>
        </section>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <section class="py-20 bg-gradient-to-br from-amber-50/50 via-orange-50/30 to-transparent">
                <div class="container mx-auto px-4">
                    <!--  Section Header -->
                    <div class="flex flex-col md:flex-row justify-between items-start mb-16">
                        <div class="max-w-2xl mb-8 md:mb-0">
                            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-100/50 mb-4">
                                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                                <span class="text-amber-700 text-sm font-medium">Baru Bergabung</span>
                            </div>
                            <h2 class="text-4xl font-bold text-gray-800 mb-4">UMKM Terbaru</h2>
                            <p class="text-gray-600 text-lg leading-relaxed">Temukan pelaku UMKM yang baru bergabung dan
                                mulai eksplorasi produk-produk unggulan mereka</p>
                        </div>
                    </div>

                    <!--  UMKM Grid -->
                    @if ($latestUMKMs->isNotEmpty())
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach ($latestUMKMs as $umkm)
                                <div
                                    class="group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-amber-100 overflow-hidden flex flex-col">
                                    <!--  Image Section -->
                                    <div class="relative h-56 overflow-hidden">
                                        <img src="{{ $umkm->thumbnail ? asset('storage/images/umkms/' . $umkm->thumbnail) : asset('assets/images/no_thumbnail.jpg') }}"
                                            alt="{{ $umkm->name }}"
                                            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-out">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent">
                                        </div>
                                        <div class="absolute bottom-4 left-4 right-4">
                                            <h3 class="text-xl font-bold text-white truncate">{{ $umkm->name }}</h3>
                                        </div>
                                    </div>

                                    <!--  Content Section -->
                                    <div class="p-6 flex-1 flex flex-col">
                                        <!-- Stats Row -->
                                        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100">
                                            <div class="flex items-center space-x-4">
                                                <div class="text-center">
                                                    <div class="text-2xl font-bold text-amber-600">
                                                        {{ $umkm->products()->count() }}</div>
                                                    <div class="text-xs text-gray-500">Produk</div>
                                                </div>
                                                @if ($umkm->ratings_avg_score)
                                                    <div class="text-center pl-4 border-l border-gray-200">
                                                        <div class="text-2xl font-bold text-amber-600">
                                                            {{ number_format($umkm->ratings_avg_score, 1) }}
                                                        </div>
                                                        <div class="text-xs text-gray-500">Rating</div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <p class="text-gray-600 mb-6 line-clamp-3">{{ $umkm->description }}</p>

                                        <!-- Footer -->
                                        <div class="mt-auto space-y-4">
                                            <div class="flex items-center text-gray-500">
                                                <i class="fas fa-map-marker-alt text-amber-500"></i>
                                                <span class="text-sm ml-2 truncate">{{ $umkm->address }}</span>
                                            </div>
                                            <a href="{{ route('umkm.show', $umkm->slug) }}"
                                                class="inline-flex items-center justify-center w-full px-4 py-3 bg-amber-50 text-amber-600 rounded-xl hover:bg-amber-100 font-semibold transition-all duration-300 group-hover:bg-amber-500 group-hover:text-white">
                                                <span>Kunjungi UMKM</span>
                                                <i
                                                    class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-12 rounded-2xl bg-white shadow-lg border border-amber-100">
                            <div class="max-w-md mx-auto text-center">
                                <!-- Animated Icon -->
                                <div class="mb-8 relative">
                                    <!-- Animation Ring -->
                                    <div class="absolute inset-0 rounded-full"></div>
                                    <div class="relative">
                                        <div class="w-20 h-20 flex items-center justify-center mx-auto mb-2">
                                            <i
                                                class="fas fa-store text-5xl text-amber-500 transform hover:scale-110 transition-transform"></i>
                                        </div>
                                        <div class="h-1 w-12 mx-auto  rounded-full">
                                        </div>
                                    </div>
                                </div>

                                <!-- Content -->
                                <h3 class="text-2xl font-bold text-gray-800 mb-3">
                                    Belum Ada UMKM Terpopuler
                                </h3>
                                <p class="text-gray-600 mb-8 leading-relaxed">
                                    Saat ini belum ada UMKM yang mendapatkan rating dan ulasan. Jadilah yang pertama
                                    memberikan ulasan!
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </section>

            <section class="py-20 bg-gradient-to-br from-transparent to-orange-50/30 via-amber-50/50">
                <div class="container mx-auto px-4">
                    <!-- Header -->
                    <div class="max-w-2xl mb-16">
                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-100/50 mb-4">
                            <i class="fas fa-award text-amber-500"></i>
                            <span class="text-amber-700 text-sm font-medium">Paling Diminati</span>
                        </div>
                        <h2 class="text-4xl font-bold text-gray-800 mb-4">UMKM Terpopuler</h2>
                        <p class="text-gray-600 text-lg">Temukan UMKM terbaik berdasarkan ulasan dan rating dari pelanggan
                            kami</p>
                    </div>

                    <!-- UMKM Cards -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        @if ($popularUMKMs->isEmpty())
                            <div class="lg:col-span-3">
                                <div class="bg-white rounded-2xl shadow-lg border border-amber-100 p-12">
                                    <div class="max-w-md mx-auto text-center">
                                        <div class="mb-6">
                                            <div
                                                class="inline-flex items-center justify-center w-16 h-16 bg-amber-50 rounded-full">
                                                <i class="fas fa-store text-4xl text-amber-300"></i>
                                            </div>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada UMKM Terpopuler</h3>
                                        <p class="text-gray-600">UMKM terpopuler akan muncul berdasarkan rating dan ulasan
                                            dari pengunjung.</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            @foreach ($popularUMKMs as $index => $umkm)
                                <div
                                    class="group relative bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-amber-100 overflow-hidden min-h-[32rem] flex flex-col">
                                    <div class="relative h-48 overflow-hidden">
                                        @if ($umkm->thumbnail)
                                            <img src="{{ asset('storage/images/umkms/' . $umkm->thumbnail) }}"
                                                alt="{{ $umkm->name }}"
                                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                        @else
                                            <img src="{{ asset('assets/images/no_thumbnail.jpg') }}"
                                                alt="{{ $umkm->name }}"
                                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                        @endif
                                        <!-- Overlay Gradient -->
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        </div>
                                    </div>
                                    <!-- Ranking Badge -->
                                    <div
                                        class="absolute top-4 right-4 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center border-2 border-amber-400 transform hover:scale-110 transition-transform">
                                        <span class="text-lg font-bold text-amber-600">#{{ $index + 1 }}</span>
                                    </div>

                                    <div class="p-8 flex flex-col flex-grow">
                                        <!-- Rating Display -->
                                        <div class="flex items-center justify-between mb-6">
                                            <div class="flex items-center gap-3">
                                                <div class="text-3xl font-bold text-amber-500">
                                                    {{ number_format($umkm->avg_rating, 1) }}
                                                </div>
                                                <div class="flex flex-col">
                                                    <div class="flex text-amber-400 mb-1">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i
                                                                class="fas fa-star {{ $i <= round($umkm->avg_rating) ? 'text-amber-400' : 'text-gray-200' }}"></i>
                                                        @endfor
                                                    </div>
                                                    <span class="text-sm text-gray-500">
                                                        {{ $umkm->rating_count }} ulasan
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- UMKM Info -->
                                        <div class="mb-8">
                                            <h3
                                                class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-amber-600 transition-colors line-clamp-1">
                                                {{ $umkm->name }}
                                            </h3>
                                            <div class="flex items-start text-gray-500 mb-2">
                                                <i class="fas fa-map-marker-alt text-amber-500 mr-2 mt-1"></i>
                                                <span class="text-sm line-clamp-2">{{ $umkm->address }}</span>
                                            </div>
                                        </div>

                                        <!-- Stats -->
                                        <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-gray-100">
                                            <div class="text-center p-4 bg-amber-50 rounded-xl">
                                                <div class="text-2xl font-bold text-amber-600">
                                                    {{ $umkm->products()->count() ?? 0 }}
                                                </div>
                                                <div class="text-sm text-gray-600">Produk</div>
                                            </div>
                                        </div>

                                        <!-- CTA -->
                                        <div class="mt-auto">
                                            <a href="{{ route('umkm.show', $umkm->slug) }}"
                                                class="inline-flex items-center justify-center w-full px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-500 text-white rounded-xl hover:from-amber-600 hover:to-orange-600 transition-all duration-300 transform group-hover:translate-y-0 translate-y-0 shadow-lg hover:shadow-amber-200/50">
                                                <span class="font-semibold">Kunjungi UMKM</span>
                                                <i
                                                    class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </section>


            <section id="all-umkm" class="py-20 bg-gradient-to-t from-orange-50/30 to-amber-50/50 via-white">
                <div class="container mx-auto px-4">
                    <div class="flex flex-col md:flex-row justify-between items-start mb-8">
                        <div class="max-w-2xl mb-8 md:mb-0">
                            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-100/50 mb-4">
                                <i class="fas fa-store text-amber-500"></i>
                                <span class="text-amber-700 text-sm font-medium ">Semua UMKM</span>
                            </div>
                            <h2 class="text-4xl font-bold text-gray-800 mb-4">Semua UMKM</h2>
                            <p class="text-gray-600 text-lg">Jelajahi lebih dari {{ $umkms->count() }} UMKM di Desa
                                Ngimbang</p>
                        </div>
                    </div>
                    <!-- UMKM Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                        @forelse ($umkms as $umkm)
                            <div
                                class="group relative bg-white rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-500 border border-amber-100/50 overflow-hidden hover:-translate-y-1">
                                <!-- Image -->
                                <div class="relative h-56 overflow-hidden">
                                    <img src="{{ $umkm->thumbnail ? asset('storage/images/umkms/' . $umkm->thumbnail) : asset('assets/images/no_thumbnail.jpg') }}"
                                        alt="{{ $umkm->name }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-all duration-700 ease-out">

                                    <!-- Gradient Overlay -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-60 group-hover:opacity-40 transition-opacity duration-500">
                                    </div>

                                    <!-- Rating Badge -->
                                    @if ($umkm->avg_rating)
                                        <div
                                            class="absolute top-4 right-4 bg-white/95 backdrop-blur-sm px-4 py-1.5 rounded-full flex items-center gap-1.5 shadow-lg transform -translate-y-1 group-hover:translate-y-0 transition-all duration-500">
                                            <i class="fas fa-star text-amber-500"></i>
                                            <span
                                                class="font-semibold text-gray-800">{{ number_format($umkm->avg_rating, 1) }}</span>
                                        </div>
                                    @endif

                                    <!-- Quick Info Overlay -->
                                    <div
                                        class="absolute bottom-4 left-4 right-4 transform translate-y-2 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-500">
                                        <div class="flex items-center gap-3">
                                            <span
                                                class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full text-xs font-medium text-gray-800">
                                                <i
                                                    class="fas fa-box text-amber-500 mr-1.5"></i>{{ $umkm->products()->count() }}
                                                Produk
                                            </span>
                                            <span
                                                class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full text-xs font-medium text-gray-800">
                                                <i
                                                    class="fas fa-star text-amber-500 mr-1.5"></i>{{ $umkm->rating_count ?? 0 }}
                                                Ulasan
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="p-6 space-y-4">
                                    <!-- Title & Description -->
                                    <div>
                                        <h3
                                            class="text-lg font-bold text-gray-800 group-hover:text-amber-600 transition-colors duration-300">
                                            {{ $umkm->name }}
                                        </h3>
                                        <p class="mt-2 text-sm text-gray-600 line-clamp-2">{{ $umkm->description }}</p>
                                    </div>

                                    <!-- Location & Action -->
                                    <div class="pt-4 border-t border-gray-100/80 flex items-center justify-between">
                                        <div
                                            class="flex items-center text-gray-500 group-hover:text-amber-600 transition-colors">
                                            <i class="fas fa-map-marker-alt mr-2"></i>
                                            <span class="text-sm truncate max-w-[150px]">{{ $umkm->address }}</span>
                                        </div>
                                        <a href="{{ route('umkm.show', $umkm->slug) }}"
                                            class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium text-amber-600 hover:text-white hover:bg-amber-600 transition-all duration-300 group-hover:shadow-md">
                                            <span>Detail</span>
                                            <i
                                                class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full">
                                <div class="bg-white rounded-2xl shadow-lg border border-amber-100 p-12">
                                    <div class="max-w-md mx-auto text-center">
                                        <div class="mb-6">
                                            <div
                                                class="inline-flex items-center justify-center w-16 h-16 bg-amber-50 rounded-full">
                                                <i class="fas fa-store text-4xl text-amber-300"></i>
                                            </div>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada UMKM</h3>
                                        <p class="text-gray-600">Jadilah yang pertama mendaftarkan UMKM Anda!</p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
