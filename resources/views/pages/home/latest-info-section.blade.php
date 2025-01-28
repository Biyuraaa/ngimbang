<section class="py-16 sm:py-24 relative overflow-hidden bg-gradient-to-br from-green-50 via-white to-teal-50">
    <!-- Background Decorative Elements -->
    <div class="absolute inset-0 pointer-events-none">
        <div
            class="absolute top-0 left-0 w-72 h-72 bg-green-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob">
        </div>
        <div
            class="absolute top-0 right-0 w-72 h-72 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute -bottom-8 left-20 w-72 h-72 bg-teal-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000">
        </div>
    </div>

    <div class="container mx-auto px-4 relative">
        <!-- Improved Section Header -->
        <div class="max-w-4xl mx-auto text-center mb-16">
            <div class="relative inline-block group">
                <div class="absolute -top-8 left-1/2 transform -translate-x-1/2">
                    <svg class="w-16 h-16 text-green-200 rotate-12 group-hover:rotate-45 transition-transform duration-700"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 0L14.59 8.41L23 11L14.59 13.59L12 22L9.41 13.59L1 11L9.41 8.41L12 0Z" />
                    </svg>
                </div>
                <h2 class="text-4xl sm:text-5xl md:text-6xl font-bold text-gray-900 relative inline-block px-4">
                    <span class="relative z-10">Informasi Terbaru</span>
                    <div
                        class="absolute left-0 bottom-0 w-full h-3 bg-gradient-to-r from-green-300 via-emerald-300 to-teal-300 rounded-full transform origin-left transition-all duration-500 ease-out group-hover:scale-x-110 group-hover:h-4">
                    </div>
                </h2>
                <div
                    class="absolute -top-4 -left-4 w-12 h-12 border-t-4 border-l-4 border-green-400 rounded-tl-xl opacity-0 group-hover:opacity-100 transition-all duration-500 group-hover:-translate-x-2 group-hover:-translate-y-2">
                </div>
                <div
                    class="absolute -bottom-4 -right-4 w-12 h-12 border-b-4 border-r-4 border-green-400 rounded-br-xl opacity-0 group-hover:opacity-100 transition-all duration-500 group-hover:translate-x-2 group-hover:translate-y-2">
                </div>
            </div>
            <p
                class="mt-8 text-lg sm:text-xl text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-teal-600 font-medium max-w-2xl mx-auto">
                Informasi penting dan pengumuman terbaru seputar perkembangan dan kegiatan Desa Ngimbang
            </p>
            <div class="mt-8 flex justify-center">
                <div class="w-24 h-1 bg-gradient-to-r from-green-300 to-teal-300 rounded-full"></div>
            </div>
        </div>
    </div>
</section>

<!-- Event Section -->
<section class="relative py-32 bg-gradient-to-br from-green-50 via-white to-teal-50 overflow-hidden">
    <!-- Decorative Elements -->
    <div class="absolute inset-0 opacity-30">
        <div
            class="absolute top-20 left-20 w-72 h-72 bg-green-200 rounded-full mix-blend-multiply filter blur-xl animate-blob">
        </div>
        <div
            class="absolute top-40 right-20 w-72 h-72 bg-teal-200 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute bottom-20 left-1/2 w-72 h-72 bg-blue-100 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-4000">
        </div>
    </div>

    <div class="container mx-auto px-4 relative">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-20">
            <div class="flex flex-col max-w-2xl">
                <div class="flex items-center gap-4 group mb-4">
                    <div class="relative">
                        <div
                            class="absolute inset-0 bg-green-200 rounded-lg blur group-hover:bg-green-300 transition-colors duration-300">
                        </div>
                        <i
                            class="fas fa-calendar-star text-4xl sm:text-5xl text-green-600 relative z-10 p-3 transform group-hover:scale-110 transition-all duration-300"></i>
                    </div>
                    <h2
                        class="text-4xl sm:text-5xl font-bold bg-gradient-to-r from-green-700 to-teal-600 bg-clip-text text-transparent">
                        Event Terbaru
                        <div
                            class="h-1 bg-gradient-to-r from-green-400 to-teal-400 transform origin-left transition-all duration-300 scale-x-0 group-hover:scale-x-100 mt-2">
                        </div>
                    </h2>
                </div>
                <p class="text-gray-600 text-lg ml-16">Temukan berbagai kegiatan menarik di Desa Ngimbang</p>
            </div>

            @if ($latestEvents->isNotEmpty())
                <a href="{{ route('event') }}"
                    class="group relative mt-8 sm:mt-0 inline-flex items-center px-8 py-4 bg-gradient-to-r from-green-600 to-teal-600 text-white rounded-full transition-all duration-300 hover:shadow-xl hover:shadow-green-200/40 overflow-hidden">
                    <span
                        class="absolute inset-0 bg-gradient-to-r from-green-700 to-teal-700 transform origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100"></span>
                    <span class="relative font-medium text-lg">Lihat Semua Event</span>
                    <svg class="w-6 h-6 ml-3 relative transform group-hover:translate-x-2 transition-transform duration-300"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            @endif
        </div>

        <!-- Events Grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">
            @if ($latestEvents->isEmpty())
                <div class="sm:col-span-2 lg:col-span-3">
                    <div
                        class="bg-white rounded-3xl shadow-xl border border-green-100 p-12 hover:shadow-2xl transition-all duration-500 group">
                        <div class="max-w-md mx-auto text-center">
                            <div class="mb-12 relative">
                                <div
                                    class="relative z-10 transform transition-transform group-hover:scale-110 duration-500">
                                    <i class="far fa-calendar-alt text-8xl sm:text-9xl text-green-600"></i>
                                </div>
                            </div>

                            <h3 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-6">
                                <span class="bg-gradient-to-r from-green-600 to-teal-600 bg-clip-text text-transparent">
                                    Belum Ada Event Terbaru
                                </span>
                            </h3>

                            <p class="text-gray-600 text-lg leading-relaxed mb-10">
                                Nantikan event-event menarik dari Desa Ngimbang yang akan datang!
                                <span class="block mt-4 text-base text-gray-500">
                                    Kami sedang menyiapkan berbagai kegiatan yang bermanfaat untuk masyarakat.
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            @else
                @foreach ($latestEvents as $event)
                    <article
                        class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl overflow-hidden transform hover:-translate-y-2 transition-all duration-500">
                        <!-- Image Container -->
                        <div class="relative aspect-[16/9] overflow-hidden">
                            <img src="{{ asset('storage/' . $event['image']) }}" alt="{{ $event['title'] }}"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            <!-- Enhanced Gradient Overlay -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent opacity-60 group-hover:opacity-70 transition-opacity">
                            </div>

                            <!-- Date and Type Badge -->
                            <div class="absolute bottom-6 left-6 right-6 flex justify-between items-center gap-4">
                                <span
                                    class="px-6 py-2 bg-white/95 backdrop-blur-sm text-green-700 rounded-full text-sm font-medium shadow-lg transform group-hover:scale-105 transition-transform">
                                    {{ $event['date'] }}
                                </span>
                                @if (isset($event['type']))
                                    <span
                                        class="px-6 py-2 bg-black/60 backdrop-blur-sm text-white rounded-full text-sm font-medium transform group-hover:scale-105 transition-transform">
                                        {{ $event['type'] }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-8">
                            <h4
                                class="text-2xl font-bold text-gray-900 group-hover:text-green-700 transition-colors duration-300 mb-4 line-clamp-2">
                                {{ $event['title'] }}
                            </h4>
                            <p class="text-gray-600 leading-relaxed mb-8 line-clamp-3">
                                {{ $event['description'] }}
                            </p>
                            <div class="pt-6 border-t border-gray-100">
                                <a href="{{ route('event.show', $event['slug']) }}"
                                    class="inline-flex items-center text-green-600 font-medium hover:text-green-800 transition-colors group">
                                    <span class="text-lg">Baca Selengkapnya</span>
                                    <svg class="w-5 h-5 ml-3 transform group-hover:translate-x-2 transition-transform duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            @endif
        </div>
    </div>
</section>

<!-- Latest Blog Posts -->
<section class="relative py-24 bg-gradient-to-br from-green-50 via-white to-teal-50">
    <!-- Decorative Background Elements -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full bg-teal-100 mix-blend-multiply filter blur-3xl">
        </div>
        <div
            class="absolute -bottom-40 -left-40 w-96 h-96 rounded-full bg-green-100 mix-blend-multiply filter blur-3xl">
        </div>
    </div>

    <div class="container mx-auto px-4 relative">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-20">
            <div class="flex flex-col max-w-2xl">
                <div class="flex items-center gap-4 group mb-4">
                    <div class="relative">
                        <div
                            class="absolute inset-0 bg-green-200 rounded-lg blur group-hover:bg-green-300 transition-colors duration-300">
                        </div>
                        <i
                            class="fas fa-calendar-star text-4xl sm:text-5xl text-green-600 relative z-10 p-3 transform group-hover:scale-110 transition-all duration-300"></i>
                    </div>
                    <h2
                        class="text-4xl sm:text-5xl font-bold bg-gradient-to-r from-green-700 to-teal-600 bg-clip-text text-transparent">
                        Blog Terbaru
                        <div
                            class="h-1 bg-gradient-to-r from-green-400 to-teal-400 transform origin-left transition-all duration-300 scale-x-0 group-hover:scale-x-100 mt-2">
                        </div>
                    </h2>
                </div>
                <p class="text-gray-600 text-lg ml-16">Baca berbagai informasi menarik seputar Desa Ngimbang</p>
            </div>

            @if ($latestBlogs->isNotEmpty())
                <a href="{{ route('event') }}"
                    class="group relative mt-8 sm:mt-0 inline-flex items-center px-8 py-4 bg-gradient-to-r from-green-600 to-teal-600 text-white rounded-full transition-all duration-300 hover:shadow-xl hover:shadow-green-200/40 overflow-hidden">
                    <span
                        class="absolute inset-0 bg-gradient-to-r from-green-700 to-teal-700 transform origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100"></span>
                    <span class="relative font-medium text-lg">Lihat Semua Event</span>
                    <svg class="w-6 h-6 ml-3 relative transform group-hover:translate-x-2 transition-transform duration-300"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            @endif
        </div>

        <!-- Blog Grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse ($latestBlogs as $blog)
                <article
                    class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl overflow-hidden transform hover:-translate-y-2 transition-all duration-500">
                    <!-- Image Container -->
                    <div class="relative aspect-[16/9] overflow-hidden">
                        <img src="{{ $blog->thumbnail ? asset('storage/images/blogs/' . $blog->thumbnail) : asset('assets/images/no_thumbnail.png') }}"
                            alt="{{ $blog->title }}"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent opacity-60 group-hover:opacity-70 transition-opacity">
                        </div>

                        <!-- Date Badge -->
                        <div class="absolute bottom-6 left-6">
                            <span
                                class="px-6 py-2 bg-white/95 backdrop-blur-sm text-green-700 rounded-full text-sm font-medium shadow-lg transform group-hover:scale-105 transition-transform">
                                {{ $blog->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-8">
                        <h4
                            class="text-2xl font-bold text-gray-900 group-hover:text-green-700 transition-colors duration-300 mb-4 line-clamp-2">
                            {{ $blog->title }}
                        </h4>
                        <p class="text-gray-600 leading-relaxed mb-8 line-clamp-3">
                            {{ $blog->excerpt }}
                        </p>
                        <div class="pt-6 border-t border-gray-100">
                            <a href="{{ route('blog.show', $blog->slug) }}"
                                class="inline-flex items-center text-green-600 font-medium hover:text-green-800 transition-colors group">
                                <span class="text-lg">Baca selengkapnya</span>
                                <svg class="w-5 h-5 ml-3 transform group-hover:translate-x-2 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="sm:col-span-2 lg:col-span-3">
                    <div
                        class="bg-white rounded-3xl shadow-xl border border-green-100 p-12 hover:shadow-2xl transition-all duration-500 group">
                        <div class="max-w-md mx-auto text-center">
                            <div class="mb-12 relative">
                                <div
                                    class="relative z-10 transform transition-transform group-hover:scale-110 duration-500">
                                    <i class="far fa-newspaper text-8xl sm:text-9xl text-green-600"></i>
                                </div>
                            </div>

                            <h3 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-6">
                                <span
                                    class="bg-gradient-to-r from-green-600 to-teal-600 bg-clip-text text-transparent">
                                    Belum Ada Blog
                                </span>
                            </h3>

                            <p class="text-gray-600 text-lg leading-relaxed mb-10">
                                Saat ini belum ada blog yang tersedia.
                                <span class="block mt-4 text-base text-gray-500">
                                    Kembali lagi nanti untuk melihat konten terbaru dari kami.
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
