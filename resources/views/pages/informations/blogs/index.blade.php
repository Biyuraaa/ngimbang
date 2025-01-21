@extends('layouts.guest')

@section('title', 'Blog Page Desa Ngimbang')

@section('content')
    <main class="min-h-screen bg-gradient-to-b from-green-50 via-emerald-50/30 to-white">
        <!-- Hero Section -->
        <section class="relative py-16 sm:py-20 lg:py-28 overflow-hidden border-b border-green-100">
            <!-- Layered Background -->
            <div class="absolute inset-0">
                <!-- Primary Background -->
                <div class="absolute inset-0 bg-gradient-to-br from-green-50 via-green-100/70 to-emerald-100/50"></div>
                <!-- Animated Pattern Overlay -->
                <div class="absolute inset-0 bg-green-900/5 pattern-dots animate-pulse"></div>
                <!-- Decorative Elements -->
                <div
                    class="absolute top-0 right-0 w-1/3 h-1/3 bg-gradient-to-br from-green-200/30 to-transparent rounded-bl-[120px] blur-xl animate-float">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-1/4 h-1/4 bg-gradient-to-tr from-emerald-200/30 to-transparent rounded-tr-[100px] blur-lg animate-float-delayed">
                </div>
                <!-- Additional Decorative Circles -->
                <div class="absolute top-1/4 left-1/6 w-24 h-24 bg-green-200/20 rounded-full blur-xl animate-pulse"></div>
                <div
                    class="absolute bottom-1/3 right-1/6 w-32 h-32 bg-emerald-200/20 rounded-full blur-xl animate-pulse-delayed">
                </div>
            </div>

            <!-- Content Container with Spacing -->
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto text-center">
                    <!-- Title Container -->
                    <div class="relative inline-block group mb-8 sm:mb-10">
                        <!-- Pre-title -->
                        <div class="mb-4 opacity-0 transform -translate-y-4 animate-fade-in-down">
                            <span
                                class="inline-block px-4 py-1.5 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                                Berita & Informasi Terkini
                            </span>
                        </div>

                        <!-- Main Title with Animation -->
                        <h1
                            class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-green-800 tracking-tight relative z-10 opacity-0 transform -translate-y-4 animate-fade-in-down animation-delay-150">
                            Blog Desa Ngimbang
                        </h1>

                        <!-- Animated Underline -->
                        <div class="absolute -bottom-4 left-0 right-0 h-1.5 sm:h-2">
                            <div
                                class="h-full bg-gradient-to-r from-green-400 via-emerald-300 to-blue-400 rounded-full transform origin-left transition-all duration-500 ease-out group-hover:scale-x-110 group-hover:h-2.5 animate-shimmer">
                            </div>
                        </div>

                        <!-- Decorative Corners -->
                        <div
                            class="hidden sm:block absolute -top-4 -left-4 w-14 h-14 border-t-4 border-l-4 border-green-300 rounded-tl-2xl opacity-0 group-hover:opacity-100 transition-all duration-500 transform group-hover:-translate-x-2 group-hover:-translate-y-2 group-hover:rotate-6">
                        </div>
                        <div
                            class="hidden sm:block absolute -bottom-4 -right-4 w-14 h-14 border-b-4 border-r-4 border-green-300 rounded-br-2xl opacity-0 group-hover:opacity-100 transition-all duration-500 transform group-hover:translate-x-2 group-hover:translate-y-2 group-hover:-rotate-6">
                        </div>
                    </div>

                    <!-- Description with Animation -->
                    <p
                        class="text-base sm:text-lg md:text-xl text-gray-600 mt-8 sm:mt-10 max-w-2xl mx-auto leading-relaxed opacity-0 transform -translate-y-4 animate-fade-in-down animation-delay-300">
                        Jelajahi berbagai artikel menarik tentang kehidupan dan perkembangan
                        <span class="text-green-600 font-medium relative inline-block group">
                            Desa Ngimbang
                            <span
                                class="absolute bottom-0 left-0 w-full h-0.5 bg-green-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                        </span>
                    </p>

                </div>
            </div>
        </section>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Popular Posts - Featured Layout -->
            <section class="py-8 sm:py-12 md:py-16">
                <div class="flex items-center gap-4 group mb-12">
                    <div class="bg-green-100 p-3 rounded-xl group-hover:bg-green-200 transition-colors duration-300">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                    </div>
                    <div>
                        <h2
                            class="text-3xl font-bold text-gray-800 group-hover:text-green-600 transition-colors duration-300">
                            Artikel Populer
                        </h2>
                        <p class="text-gray-500 mt-1">Artikel paling banyak dibaca</p>
                    </div>
                </div>

                @if ($popularBlogs->count() > 0)
                    <div class="grid sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 lg:gap-8">
                        @foreach ($popularBlogs->take(2) as $blog)
                            <article
                                class="group bg-white rounded-xl sm:rounded-2xl shadow-lg hover:shadow-xl transition-all duration-500 overflow-hidden transform hover:-translate-y-1">
                                <div class="relative aspect-[16/9] sm:aspect-video">
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-transparent opacity-70 group-hover:opacity-80 transition-opacity">
                                    </div>
                                    <div class="absolute top-2 sm:top-4 right-2 sm:right-4 flex gap-2">
                                        <span
                                            class="bg-white/90 backdrop-blur-sm px-2 sm:px-3 py-1 sm:py-1.5 rounded-full text-xs sm:text-sm font-medium text-green-600 flex items-center gap-1">
                                            <i class="fas fa-eye text-xs"></i>
                                            {{ number_format($blog->view_count) }}
                                        </span>
                                    </div>
                                    <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-6">
                                        <div class="flex items-center gap-2 sm:gap-3 mb-3 sm:mb-4">
                                            <img src="{{ $blog->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($blog->user->name) }}"
                                                alt="{{ $blog->user->name }}"
                                                class="w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-white">
                                            <div class="text-white/90">
                                                <p class="text-xs sm:text-sm font-medium">{{ $blog->user->name }}</p>
                                                <p class="text-xs opacity-75">{{ $blog->created_at->format('d M Y') }}</p>
                                            </div>
                                        </div>

                                        <h3
                                            class="text-xl sm:text-2xl font-bold text-white mb-2 sm:mb-3 line-clamp-2 group-hover:text-green-400 transition-colors duration-300">
                                            {{ $blog->title }}
                                        </h3>

                                        <p
                                            class="text-gray-200 text-sm sm:text-base line-clamp-2 mb-3 sm:mb-4 hidden sm:block">
                                            {{ $blog->excerpt }}
                                        </p>

                                        @if ($blog->tags->count() > 0)
                                            <div class="flex flex-wrap gap-1.5 sm:gap-2 mb-3 sm:mb-4">
                                                @foreach ($blog->tags->take(2) as $tag)
                                                    <span
                                                        class="text-xs px-2 py-0.5 sm:px-2.5 sm:py-1 bg-white/20 backdrop-blur-sm rounded-full text-white">
                                                        #{{ $tag->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif

                                        <a href="{{ route('blog.show', $blog->slug) }}"
                                            class="inline-flex items-center gap-1.5 sm:gap-2 text-green-400 hover:text-green-300 transition-colors duration-300 text-sm sm:text-base">
                                            <span>Baca selengkapnya</span>
                                            <i
                                                class="fas fa-arrow-right group-hover:translate-x-1 transition-transform duration-300"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-2xl shadow-sm p-8 text-center">
                        <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-newspaper text-2xl text-green-600"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Belum ada artikel populer</h3>
                        <p class="text-gray-500 mt-2">Artikel populer akan muncul di sini setelah dibaca oleh pengunjung.
                        </p>
                    </div>
                @endif
            </section>

            <!-- Latest Posts - Grid Layout -->
            <section class="py-8 sm:py-12 md:py-16 border-t border-green-100">
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
                            Artikel Terbaru
                        </h2>
                        <p class="text-gray-500 mt-1">Temukan tulisan terbaru dari kami</p>
                    </div>
                </div>

                @if ($latestBlogs->count() > 0)
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($latestBlogs as $blog)
                            <article
                                class="group bg-white rounded-2xl shadow-md hover:shadow-xl overflow-hidden transform hover:-translate-y-1 transition-all duration-500">
                                <div class="relative aspect-[16/10] overflow-hidden">
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">

                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-60 group-hover:opacity-70 transition-opacity">
                                    </div>

                                    <!-- View Count -->
                                    <div class="absolute top-4 right-4">
                                        <span
                                            class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-medium text-green-600">
                                            <i class="fas fa-eye mr-1"></i>{{ number_format($blog->view_count) }} views
                                        </span>
                                    </div>
                                </div>

                                <div class="p-6">
                                    <!-- Author Info -->
                                    <div class="flex items-center gap-3 mb-4">
                                        <img src="{{ $blog->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($blog->user->name) }}"
                                            alt="{{ $blog->user->name }}"
                                            class="w-10 h-10 rounded-full ring-2 ring-green-50">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $blog->user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $blog->created_at->format('d M Y') }}</p>
                                        </div>
                                    </div>

                                    <!-- Tags -->
                                    @if ($blog->tags->count() > 0)
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            @foreach ($blog->tags->take(3) as $tag)
                                                <span
                                                    class="text-xs px-2 py-1 bg-green-50 text-green-600 rounded-full hover:bg-green-100 transition-colors">
                                                    #{{ $tag->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif

                                    <!-- Title and Excerpt -->
                                    <h3
                                        class="font-bold text-xl text-gray-900 group-hover:text-green-600 transition-colors duration-300 mb-3 line-clamp-2">
                                        {{ $blog->title }}
                                    </h3>

                                    <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-3">
                                        {{ $blog->excerpt }}
                                    </p>

                                    <!-- Read More Link -->
                                    <a href="{{ route('blog.show', $blog->slug) }}"
                                        class="inline-flex items-center gap-2 text-green-600 hover:text-green-700 font-medium transition-colors">
                                        <span>Baca selengkapnya</span>
                                        <i
                                            class="fas fa-arrow-right group-hover:translate-x-1 transition-transform duration-300"></i>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-newspaper text-2xl text-green-600"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Belum ada artikel</h3>
                        <p class="text-gray-500 mt-2">Artikel terbaru akan muncul di sini.</p>
                    </div>
                @endif
            </section>


            <!-- All Posts Section -->
            <section class="py-8 sm:py-12 md:py-16 border-t border-green-100">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-12">
                    <div class="flex items-center gap-4 group">
                        <div class="bg-green-100 p-3 rounded-xl group-hover:bg-green-200 transition-colors duration-300">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <div>
                            <h2
                                class="text-3xl font-bold text-gray-800 group-hover:text-green-600 transition-colors duration-300">
                                Semua Artikel</h2>
                            <p class="text-gray-500 mt-1">Jelajahi semua artikel dari kami</p>
                        </div>
                    </div>
                </div>

                @if ($blogs->count() > 0)
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                        @foreach ($blogs as $blog)
                            <article
                                class="group bg-white rounded-2xl shadow-sm hover:shadow-xl overflow-hidden transform hover:-translate-y-1 transition-all duration-500 border border-gray-100">
                                <div class="relative aspect-[16/10] overflow-hidden">
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">

                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-60 group-hover:opacity-70 transition-opacity">
                                    </div>

                                    <div class="absolute top-4 left-4 right-4 flex justify-between items-center">
                                        <span
                                            class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-medium text-gray-600">
                                            <i class="far fa-eye mr-1"></i>{{ number_format($blog->view_count) }}
                                            views
                                        </span>
                                    </div>

                                    <div class="absolute bottom-4 left-4">
                                        <span
                                            class="text-sm text-white bg-green-600/90 px-3 py-1 rounded-full backdrop-blur-sm">
                                            {{ $blog->created_at->format('d M Y') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="p-6">
                                    <div class="flex items-center gap-3 mb-4">
                                        <img src="{{ $blog->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($blog->user->name) }}"
                                            alt="{{ $blog->user->name }}"
                                            class="w-8 h-8 rounded-full ring-2 ring-green-50">
                                        <span class="text-sm text-gray-600">{{ $blog->user->name }}</span>
                                    </div>

                                    @if ($blog->tags->count() > 0)
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            @foreach ($blog->tags->take(3) as $tag)
                                                <span class="text-xs px-2 py-1 bg-green-50 text-green-600 rounded-full">
                                                    #{{ $tag->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif

                                    <h3
                                        class="font-bold text-xl text-gray-900 group-hover:text-green-600 transition-colors duration-300 mb-3 line-clamp-2">
                                        {{ $blog->title }}
                                    </h3>

                                    <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-3">
                                        {{ $blog->excerpt }}
                                    </p>

                                    <a href="{{ route('blog.show', $blog->slug) }}"
                                        class="inline-flex items-center gap-2 text-green-600 hover:text-green-700 font-medium transition-colors">
                                        Baca selengkapnya
                                        <i
                                            class="fas fa-arrow-right group-hover:translate-x-1 transition-transform duration-300"></i>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12 flex justify-center">
                        {{ $blogs->links() }}
                    </div>
                @else
                    <div class="text-center py-12 bg-white rounded-2xl shadow-sm border border-gray-100">
                        <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-newspaper text-2xl text-green-600"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Belum ada artikel</h3>
                        <p class="text-gray-500 mt-2">Nantikan artikel menarik dari kami.</p>
                    </div>
                @endif
            </section>
        </div>
    </main>
@endsection

@push('styles')
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -200% center;
            }

            100% {
                background-position: 200% center;
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-float-delayed {
            animation: float 6s ease-in-out infinite;
            animation-delay: 2s;
        }

        .animate-fade-in-down {
            animation: fadeInDown 1s ease-out forwards;
        }

        .animate-shimmer {
            background-size: 200% auto;
            animation: shimmer 3s linear infinite;
        }

        .animation-delay-150 {
            animation-delay: 150ms;
        }

        .animation-delay-300 {
            animation-delay: 300ms;
        }

        .animation-delay-450 {
            animation-delay: 450ms;
        }

        @keyframes fadeInDown {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush
