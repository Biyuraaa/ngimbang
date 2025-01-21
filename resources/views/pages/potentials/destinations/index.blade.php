@extends('layouts.guest')

@section('title', 'Wisata Desa Ngimbang')

@section('content')
    <main class="min-h-screen bg-gradient-to-b from-green-100 via-emerald-50/30 to-white">
        <!-- Hero Section -->
        <section class="relative min-h-[70vh] flex items-center border-b border-green-100 overflow-hidden">
            <!-- Background Image & Overlay -->
            <div class="absolute inset-0">
                <img src="{{ asset('assets/images/wisata-hero.png') }}" alt="Wisata Gunung Sari"
                    class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-green-900/90 to-green-800/75"></div>
            </div>

            <!-- Content -->
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
                <div class="max-w-4xl">
                    <!-- Decorative Element -->
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm mb-6">
                        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                        <span class="text-green-100 text-sm font-medium">Jelajahi Destinasi Wisata</span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                        Temukan Keindahan<br>
                        <span class="text-green-400">Wisata Ngimbang</span>
                    </h1>

                    <!-- Description -->
                    <p class="text-green-100 text-lg md:text-xl mb-8 max-w-2xl leading-relaxed">
                        Nikmati keindahan alam dan budaya yang memukau di berbagai destinasi wisata Desa Ngimbang.
                        Pengalaman tak terlupakan menanti Anda!
                    </p>

                    <!-- CTA Button -->
                    <a href="#all-destinations"
                        class="inline-flex items-center px-6 py-3 bg-green-500 text-white rounded-full hover:bg-green-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <span class="mr-2">Jelajahi Sekarang</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>

                    <!-- Stats -->
                    <div class="flex justify-center items-center gap-4 sm:gap-8 mt-8 sm:mt-12">
                        <div class="text-center">
                            <div class="text-xl sm:text-3xl font-bold text-white mb-1">{{ $destinations->count() }}</div>
                            <div class="text-xs sm:text-base text-green-200">Destinasi</div>
                        </div>

                        <div class="text-center border-l border-green-200/20 pl-4 sm:pl-8">
                            <div class="text-xl sm:text-3xl font-bold text-white mb-1">4.8</div>
                            <div class="text-xs sm:text-base text-green-200">Rating</div>
                        </div>

                        <div class="text-center border-l border-green-200/20 pl-4 sm:pl-8">
                            <div class="text-xl sm:text-3xl font-bold text-white mb-1">1.2K</div>
                            <div class="text-xs sm:text-base text-green-200">Pengunjung</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Decorative Shapes -->
            <div class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-b from-transparent to-white"></div>
        </section>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Popular Destinations Section -->
            <section class="py-16 border-b border-green-100">
                <!-- Section Header -->
                <div class="flex items-center gap-4 group mb-12">
                    <div class="bg-green-100 p-3 rounded-xl group-hover:bg-green-200 transition-colors duration-300">
                        <i class="fas fa-star text-xl text-green-600"></i>
                    </div>
                    <div>
                        <h2
                            class="text-3xl font-bold text-gray-800 group-hover:text-green-600 transition-colors duration-300">
                            Destinasi Favorit
                        </h2>
                        <p class="text-gray-500 mt-1">Destinasi wisata dengan rating terbaik</p>
                    </div>
                </div>

                <!-- Popular Destinations Grid -->
                <div class="grid lg:grid-cols-3 gap-8">
                    @forelse ($popularDestinations as $destination)
                        <article
                            class="group bg-white rounded-2xl shadow-lg hover:shadow-xl overflow-hidden transform hover:-translate-y-1 transition-all duration-500">
                            <div class="relative w-full h-full overflow-hidden">
                                <img src="{{ $destination->thumbnail
                                    ? asset('storage/images/destinations/' . $destination->thumbnail)
                                    : asset('assets/images/no_thumbnail.jpg') }}"
                                    alt="{{ $destination->name }}" loading="lazy"
                                    onerror="this.onerror=null; this.src='{{ asset('assets/images/no_thumbnail.jpg') }}'"
                                    class="w-full h-full object-cover transition-all duration-700 ease-out group-hover:scale-110 group-hover:rotate-1 hover:shadow-lg"
                                    title="{{ $destination->name }}" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700">
                                </div>

                                <!-- Rating Badge -->
                                <div class="absolute top-4 right-4 flex gap-2">
                                    <div
                                        class="flex items-center gap-1 px-3 py-1.5 bg-white/90 rounded-full backdrop-blur-sm">
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <span class="text-gray-700 font-medium">
                                            {{ number_format($destination->average_rating, 0) }}
                                        </span>
                                    </div>
                                    <div
                                        class="flex items-center gap-1 px-3 py-1.5 bg-white/90 rounded-full backdrop-blur-sm">
                                        <i class="fas fa-comment text-green-500"></i>
                                        <span class="text-gray-700 font-medium">{{ $destination->ratings_count }}</span>
                                    </div>
                                </div>

                                <!-- Content Overlay -->
                                <div class="absolute bottom-0 left-0 right-0 p-6">
                                    <h3
                                        class="text-xl font-bold text-white mb-2 group-hover:text-green-400 transition-colors duration-300">
                                        {{ $destination->name }}
                                    </h3>
                                    <p class="text-gray-300 text-sm line-clamp-2 mb-4">
                                        {{ $destination->description }}
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center text-sm text-white/90">
                                            <i class="fas fa-clock mr-2"></i>
                                            <span>
                                                {{ \Carbon\Carbon::parse($destination->open_at)->format('H:i') }} -
                                                {{ \Carbon\Carbon::parse($destination->close_at)->format('H:i') }}
                                            </span>
                                        </div>
                                        <a href="{{ route('wisata.show', $destination->slug) }}"
                                            class="inline-flex items-center gap-2 text-green-400 hover:text-green-300 transition-colors">
                                            <span>Explore</span>
                                            <i
                                                class="fas fa-arrow-right group-hover:translate-x-1 transition-transform duration-300"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="lg:col-span-3">
                            <div class="text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-100">
                                <div
                                    class="bg-yellow-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-star text-2xl text-yellow-400"></i>
                                </div>
                                <h3 class="text-xl font-medium text-gray-900 mb-2">Belum Ada Destinasi Favorit</h3>
                                <p class="text-gray-500 mb-6 max-w-md mx-auto">
                                    Beri rating pada destinasi wisata yang kamu kunjungi untuk membantu pengunjung lainnya
                                </p>
                                <a href="#all-destinations"
                                    class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 text-white rounded-xl hover:bg-green-700 transition-all duration-200">
                                    <i class="fas fa-compass"></i>
                                    <span>Jelajahi Semua Destinasi</span>
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </section>

            <!-- Latest Destinations Section -->
            <section class="py-16">
                <!-- Section Header -->
                <div class="flex items-center gap-4 group mb-12">
                    <div class="bg-green-100 p-3 rounded-xl group-hover:bg-green-200 transition-colors duration-300">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                    </div>
                    <div>
                        <h2
                            class="text-3xl font-bold text-gray-800 group-hover:text-green-600 transition-colors duration-300">
                            Destinasi Terbaru
                        </h2>
                        <p class="text-gray-500 mt-1">Jelajahi destinasi wisata terbaru kami</p>
                    </div>
                </div>
                <!-- Latest Destinations Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($latestDestinations as $destination)
                        <article
                            class="group bg-white rounded-2xl shadow-sm hover:shadow-xl overflow-hidden transform hover:-translate-y-1 transition-all duration-500 border border-gray-100">
                            <!-- Image Section -->
                            <div class="relative aspect-[4/3] overflow-hidden">
                                <img src="{{ $destination->thumbnail
                                    ? asset('storage/images/destinations/' . $destination->thumbnail)
                                    : asset('assets/images/no_thumbnail.jpg') }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

                                <!-- Badges -->
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="px-3 py-1.5 bg-white/90 text-green-600 rounded-full text-sm font-medium backdrop-blur-sm">
                                        {{ \Carbon\Carbon::parse($destination->open_at)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($destination->close_at)->format('H:i') }}
                                    </span>
                                </div>

                                <div class="absolute top-4 right-4">
                                    <div
                                        class="flex items-center gap-1 px-2 py-1 bg-white/90 rounded-full backdrop-blur-sm">
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        <span class="text-gray-700 font-medium text-sm">
                                            {{ number_format($destination->average_rating, 0) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <h3
                                    class="text-xl font-bold text-gray-900 group-hover:text-green-600 transition-colors duration-300 mb-2">
                                    {{ $destination->name }}
                                </h3>
                                <p class="text-gray-600 text-sm line-clamp-2 mb-4">
                                    {{ $destination->description }}
                                </p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <i class="fas fa-map-marker-alt text-green-500 mr-2"></i>
                                        <span class="line-clamp-1">{{ $destination->address }}</span>
                                    </div>
                                    <a href="{{ route('wisata.show', $destination->slug) }}"
                                        class="inline-flex items-center gap-2 text-green-600 hover:text-green-700 font-medium transition-colors">
                                        <span>Explore</span>
                                        <i
                                            class="fas fa-arrow-right group-hover:translate-x-1 transition-transform duration-300"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="md:col-span-2 lg:col-span-3">
                            <div class="bg-white rounded-2xl shadow-lg border border-green-100 p-12">
                                <div class="max-w-md mx-auto text-center">
                                    <!-- Animated Icon -->
                                    <div class="mb-6 relative">
                                        <div class="absolute inset-0 bg-green-100/50 rounded-full animate-ping"></div>
                                        <div class="relative">
                                            <div
                                                class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mx-auto">
                                                <i class="fas fa-compass text-4xl text-green-400"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Destinasi Terbaru</h3>
                                    <p class="text-gray-600">Destinasi wisata terbaru akan segera hadir untuk Anda!</p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </section>

            <!-- All Destinations Section -->
            <section id="all-destinations" class="py-16 border-t border-green-100">
                <!-- Section Header -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-12">
                    <div class="flex items-center gap-4 group">
                        <div class="bg-green-100 p-3 rounded-xl group-hover:bg-green-200 transition-colors duration-300">
                            <i class="fas fa-compass text-xl text-green-600"></i>
                        </div>
                        <div>
                            <h2
                                class="text-3xl font-bold text-gray-800 group-hover:text-green-600 transition-colors duration-300">
                                Semua Destinasi
                            </h2>
                            <p class="text-gray-500 mt-1">Temukan destinasi wisata yang sesuai untukmu</p>
                        </div>
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    @forelse ($destinations as $destination)
                        <article
                            class="group bg-white rounded-xl shadow-sm hover:shadow-lg overflow-hidden transform hover:-translate-y-1 transition-all duration-500 border border-gray-100">
                            <!-- Image with Overlay -->
                            <div class="relative aspect-[3/2] overflow-hidden">
                                <img src="{{ $destination->thumbnail
                                    ? asset('storage/images/destinations/' . $destination->thumbnail)
                                    : asset('assets/images/no_thumbnail.jpg') }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

                                <!-- Rating Badge -->
                                <div class="absolute top-3 right-3 flex gap-2">
                                    <div
                                        class="flex items-center gap-1 px-2 py-1 bg-white/90 rounded-full text-sm backdrop-blur-sm">
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <span class="text-gray-700 font-medium">
                                            {{ number_format($destination->average_rating, 0) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-4">
                                <h3
                                    class="font-semibold text-gray-900 group-hover:text-green-600 transition-colors duration-300 mb-2">
                                    {{ $destination->name }}
                                </h3>

                                <div class="flex items-center text-sm text-gray-500 mb-3">
                                    <i class="fas fa-clock text-green-500 mr-2"></i>
                                    <span>
                                        {{ \Carbon\Carbon::parse($destination->open_at)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($destination->close_at)->format('H:i') }}
                                    </span>
                                </div>

                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <i class="fas fa-map-marker-alt text-green-500 mr-2"></i>
                                    <span class="line-clamp-1">{{ $destination->address }}</span>
                                </div>

                                <a href="{{ route('wisata.show', $destination->slug) }}"
                                    class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                    <span>Lihat Detail</span>
                                    <i
                                        class="fas fa-arrow-right group-hover:translate-x-1 transition-transform duration-300"></i>
                                </a>
                            </div>
                        </article>
                    @empty
                        <div class="sm:col-span-2 lg:col-span-4">
                            <div class="bg-white rounded-2xl shadow-lg border border-green-100 p-12">
                                <div class="max-w-md mx-auto text-center">
                                    <!-- Animated Icon -->
                                    <div class="mb-6">
                                        <div
                                            class="inline-flex items-center justify-center w-16 h-16 bg-green-50 rounded-full">
                                            <i class="fas fa-map-marked-alt text-4xl text-green-400"></i>
                                        </div>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Destinasi</h3>
                                    <p class="text-gray-600">Destinasi wisata akan segera hadir untuk Anda!</p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>


            </section>
        </div>
    </main>
@endsection
