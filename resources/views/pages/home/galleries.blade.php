<!-- Latest Galleries -->
<section class="relative py-24 bg-gradient-to-br from-purple-50 via-white to-pink-50">
    <!-- Decorative Background Elements -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full bg-purple-100 mix-blend-multiply filter blur-3xl">
        </div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 rounded-full bg-pink-100 mix-blend-multiply filter blur-3xl">
        </div>
    </div>

    <div class="container mx-auto px-4 relative">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-20">
            <div class="flex flex-col max-w-2xl">
                <div class="flex items-center gap-4 group mb-4">
                    <h2
                        class="text-4xl sm:text-5xl font-bold bg-gradient-to-r from-purple-700 to-pink-600 bg-clip-text text-transparent">
                        Galeri Terbaru
                        <div
                            class="h-1 bg-gradient-to-r from-purple-400 to-pink-400 transform origin-left transition-all duration-300 scale-x-0 group-hover:scale-x-100 mt-2">
                        </div>
                    </h2>
                </div>
                <p class="text-gray-600 text-lg ml-16">Lihat koleksi foto terbaru dari Desa Ngimbang</p>
            </div>

            @if ($latestGalleries->isNotEmpty())
                <a href="{{ route('galeri') }}"
                    class="group relative mt-8 sm:mt-0 inline-flex items-center px-8 py-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-full transition-all duration-300 hover:shadow-xl hover:shadow-purple-200/40 overflow-hidden">
                    <span
                        class="absolute inset-0 bg-gradient-to-r from-purple-700 to-pink-700 transform origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100"></span>
                    <span class="relative font-medium text-lg">Lihat Semua Galeri</span>
                    <svg class="w-6 h-6 ml-3 relative transform group-hover:translate-x-2 transition-transform duration-300"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            @endif
        </div>

        <!-- Galleries Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($latestGalleries->take(6) as $gallery)
                <div
                    class="group relative aspect-square overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500">
                    <img src="{{ $gallery->image ? asset('storage/images/galleries/' . $gallery->image) : asset('assets/images/no_thumbnail.jpg') }}"
                        alt="{{ $gallery->name }}"
                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">

                    <!-- Overlay -->
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <h4 class="text-white text-lg font-semibold mb-2">{{ $gallery->name }}</h4>
                            <p class="text-gray-200 text-sm line-clamp-2">{{ $gallery->description }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-2 md:col-span-3">
                    <div
                        class="bg-white rounded-3xl shadow-xl border border-purple-100 p-12 hover:shadow-2xl transition-all duration-500 group">
                        <div class="max-w-md mx-auto text-center">
                            <div class="mb-12 relative">
                                <div
                                    class="relative z-10 transform transition-transform group-hover:scale-110 duration-500">
                                    <i class="far fa-images text-8xl sm:text-9xl text-purple-600"></i>
                                </div>
                            </div>

                            <h3 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-6">
                                <span
                                    class="bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                                    Belum Ada Galeri
                                </span>
                            </h3>

                            <p class="text-gray-600 text-lg leading-relaxed mb-10">
                                Saat ini belum ada galeri yang tersedia.
                                <span class="block mt-4 text-base text-gray-500">
                                    Kembali lagi nanti untuk melihat koleksi foto terbaru dari kami.
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
