@extends('layouts.guest')

@section('title', 'Event Page Desa Ngimbang')

@section('content')
    <main class="min-h-screen bg-gradient-to-b from-green-50 via-emerald-50/30 to-white">
        <!-- Hero Section -->
        <section class="relative py-20 sm:py-24 lg:py-32 overflow-hidden">
            <!-- Enhanced Background -->
            <div class="absolute inset-0">
                <div class="absolute inset-0 bg-gradient-to-br from-green-50 via-emerald-50/80 to-blue-50/30"></div>
                <div class="absolute inset-0 bg-[url('/pattern.svg')] opacity-5"></div>

                <!-- Improved Decorative Elements -->
                <div
                    class="absolute top-0 right-0 w-2/5 h-2/5 bg-gradient-to-bl from-green-200/30 via-emerald-100/20 to-transparent rounded-bl-[100px] blur-3xl">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-2/5 h-2/5 bg-gradient-to-tr from-blue-100/30 via-green-100/20 to-transparent rounded-tr-[100px] blur-3xl">
                </div>

                <!-- Floating Shapes -->
                <div class="absolute top-20 left-10 w-20 h-20 border-4 border-green-200/30 rounded-2xl animate-float-slow">
                </div>
                <div
                    class="absolute bottom-20 right-10 w-16 h-16 border-4 border-blue-200/30 rounded-full animate-float-slow delay-200">
                </div>
            </div>
            <!-- Content Container -->
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto text-center">
                    <!-- Enhanced Title -->
                    <div class="relative inline-block group mb-8">
                        <span class="block text-green-600 font-medium mb-4 text-lg animate-fade-in">Selamat Datang di</span>
                        <h1
                            class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-green-600 via-emerald-500 to-green-600 tracking-tight mb-6">
                            Event Desa Ngimbang
                        </h1>

                        <!-- Animated Accent -->
                        <div
                            class="absolute -bottom-4 left-0 right-0 h-1.5 bg-gradient-to-r from-green-400 via-emerald-300 to-blue-400 rounded-full transform origin-left transition-all duration-500 ease-out group-hover:scale-x-110">
                        </div>
                    </div>

                    <!-- Enhanced Description -->
                    <p
                        class="text-lg sm:text-xl md:text-2xl text-gray-600 mt-8 max-w-3xl mx-auto leading-relaxed animate-fade-in-up">
                        Temukan dan ikuti berbagai kegiatan menarik di
                        <span class="text-green-600 font-semibold">Desa Ngimbang</span>
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
                            Event Populer
                        </h2>
                        <p class="text-gray-500 mt-1">Event Paling Banyak Diminati</p>
                    </div>
                </div>
                @if ($popularEvents->count() > 0)
                    <div class="grid sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-10">
                        @foreach ($popularEvents->take(2) as $event)
                            <article
                                class="group bg-white rounded-3xl shadow-md hover:shadow-2xl transition-all duration-700 overflow-hidden transform hover:-translate-y-2">
                                <!-- Image Container -->
                                <div class="relative aspect-[16/9]">
                                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                                        class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-in-out">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/60 to-transparent opacity-70 group-hover:opacity-75 transition-opacity duration-500">
                                    </div>

                                    <!-- Category & Stats -->
                                    <div class="absolute top-4 left-4 right-4 flex justify-between items-center">
                                        <span
                                            class="px-4 py-2 bg-green-500/90 backdrop-blur-sm text-white text-sm font-semibold rounded-full">
                                            {{ $event->category ?? 'Event' }}
                                        </span>
                                        <div class="flex items-center gap-3">
                                            <span
                                                class="px-3 py-1.5 bg-white/90 backdrop-blur-sm text-green-600 text-sm font-medium rounded-full flex items-center gap-1.5">
                                                <i class="fas fa-eye text-xs"></i>
                                                {{ $event->views_count ?? 0 }}
                                            </span>
                                            <span
                                                class="px-3 py-1.5 bg-white/90 backdrop-blur-sm text-green-600 text-sm font-medium rounded-full flex items-center gap-1.5">
                                                <i class="fas fa-comments text-xs"></i>
                                                {{ $event->comments_count }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="absolute bottom-0 left-0 right-0 p-8">
                                        <!-- Author Info -->
                                        <div class="flex items-center gap-4 mb-5">
                                            <img src="{{ $event->user->image ?? 'https://ui-avatars.com/api/?name=' . urlencode($event->user->name) }}"
                                                alt="{{ $event->user->name }}"
                                                class="w-12 h-12 rounded-full border-2 border-white/90 shadow-lg">
                                            <div class="text-white">
                                                <p class="text-base font-semibold">{{ $event->user->name }}</p>
                                                <p class="text-sm opacity-90">{{ $event->created_at->format('d M Y') }}</p>
                                            </div>
                                        </div>

                                        <!-- Event Info -->
                                        <h3
                                            class="text-2xl sm:text-3xl font-bold text-white mb-4 line-clamp-2 group-hover:text-green-400 transition-colors duration-300">
                                            {{ $event->title }}
                                        </h3>

                                        <!-- Event Schedule -->
                                        <div class="flex items-center gap-6 text-white/95 text-sm mb-5">
                                            <div class="flex items-center gap-2">
                                                <i class="fas fa-calendar-alt text-green-400"></i>
                                                <span>{{ $event->start_date }}</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <i class="fas fa-clock text-green-400"></i>
                                                <span>{{ $event->start_at }}</span>
                                            </div>
                                        </div>

                                        <a href="{{ route('event.show', $event->slug) }}"
                                            class="inline-flex items-center gap-2 px-6 py-2.5 bg-green-500 hover:bg-green-600 text-white rounded-full transition-all duration-300 text-sm font-semibold">
                                            <span>Selengkapnya</span>
                                            <i
                                                class="fas fa-arrow-right group-hover:translate-x-1.5 transition-transform duration-300"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-3xl shadow-lg border border-green-100 p-16">
                        <div class="max-w-md mx-auto text-center">
                            <div class="mb-8">
                                <div class="inline-flex items-center justify-center w-20 h-20 bg-green-50 rounded-full">
                                    <i class="fas fa-calendar text-5xl text-green-400"></i>
                                </div>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-3">Belum Ada Event Populer</h3>
                            <p class="text-gray-600 text-lg">Event populer akan muncul di sini setelah dibaca oleh
                                pengunjung.</p>
                        </div>
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
                            Event Terbaru
                        </h2>
                        <p class="text-gray-500 mt-1">Temukan event terbaru dari kami</p>
                    </div>
                </div>

                @if ($latestEvents->count() > 0)
                    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                        @foreach ($latestEvents as $event)
                            <article
                                class="group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-green-100 overflow-hidden">
                                <!-- Image Section -->
                                <div class="relative aspect-video overflow-hidden">
                                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent opacity-60 group-hover:opacity-70 transition-opacity">
                                    </div>

                                    <!-- Comment Count -->
                                    <div class="absolute top-4 right-4">
                                        <span
                                            class="px-3 py-1.5 bg-white/90 backdrop-blur-sm text-green-600 text-sm font-medium rounded-full flex items-center gap-1.5">
                                            <i class="fas fa-comments text-xs"></i>
                                            {{ $event->comments()->count() ?? 0 }}
                                        </span>
                                    </div>
                                </div>

                                <div class="p-6">
                                    <!-- Event Schedule -->
                                    <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                                        <div class="flex items-center gap-1.5">
                                            <i class="fas fa-clock text-green-500"></i>
                                            <span>{{ $event->start_at }}</span>
                                        </div>
                                        <div class="flex items-center gap-1.5">
                                            <i class="fas fa-map-marker-alt text-green-500"></i>
                                            <span class="line-clamp-1">{{ $event->location }}</span>
                                        </div>
                                    </div>

                                    <!-- Event Title -->
                                    <h3
                                        class="text-xl font-bold text-gray-800 mb-4 line-clamp-2 group-hover:text-green-600 transition-colors">
                                        {{ $event->title }}
                                    </h3>

                                    <!-- Author Info -->
                                    <div class="flex items-center gap-3 mb-6 pb-6 border-b border-gray-100">
                                        <img src="{{ $event->user->image ?? 'https://ui-avatars.com/api/?name=' . urlencode($event->user->name) }}"
                                            alt="{{ $event->user->name }}"
                                            class="w-10 h-10 rounded-full ring-2 ring-green-500/20">
                                        <div>
                                            <p class="text-sm font-medium text-gray-800">{{ $event->user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $event->created_at->format('d M Y') }}</p>
                                        </div>
                                    </div>

                                    <!-- CTA -->
                                    <a href="{{ route('event.show', $event->slug) }}"
                                        class="inline-flex items-center justify-center w-full px-6 py-3 bg-green-500 text-white rounded-xl hover:bg-green-600 transition-colors group/btn">
                                        <span class="font-medium">Lihat Detail</span>
                                        <i
                                            class="fas fa-arrow-right ml-2 transform group-hover/btn:translate-x-1 transition-transform"></i>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div
                        class="bg-white rounded-3xl shadow-lg border border-green-100/80 p-16 relative overflow-hidden group">

                        <div class="relative max-w-md mx-auto text-center">
                            <!-- Enhanced Icon -->
                            <div class="mb-8">
                                <div
                                    class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-green-100 to-emerald-50 rounded-full shadow-lg">
                                    <i class="fas fa-calendar-alt text-5xl text-green-500/90"></i>
                                </div>
                            </div>

                            <!-- Improved Content -->
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">Belum Ada Event Terbaru</h3>
                            <p class="text-gray-600 text-lg mb-8">Event terbaru akan segera hadir. Pantau terus untuk
                                mendapatkan informasi terkini!</p>
                        </div>
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
                                Semua Event</h2>
                            <p class="text-gray-500 mt-1">Jelajahi semua event dari kami</p>
                        </div>
                    </div>
                </div>

                @if ($events->count() > 0)
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                        @foreach ($events as $event)
                            <article
                                class="group bg-white rounded-2xl shadow-sm hover:shadow-xl overflow-hidden transform hover:-translate-y-1 transition-all duration-500 border border-gray-100">
                                <div class="relative aspect-[16/10] overflow-hidden">
                                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">

                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-60 group-hover:opacity-70 transition-opacity">
                                    </div>

                                    <div class="absolute bottom-4 left-4">
                                        <span
                                            class="text-sm text-white bg-green-600/90 px-3 py-1 rounded-full backdrop-blur-sm">
                                            {{ $event->created_at->format('d M Y') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="p-6">
                                    <div class="flex items-center gap-3 mb-4">
                                        <img src="{{ $event->user->image ?? 'https://ui-avatars.com/api/?name=' . urlencode($event->user->name) }}"
                                            alt="{{ $event->user->name }}"
                                            class="w-8 h-8 rounded-full ring-2 ring-green-50">
                                        <span class="text-sm text-gray-600">{{ $event->user->name }}</span>
                                    </div>


                                    <h3
                                        class="font-bold text-xl text-gray-900 group-hover:text-green-600 transition-colors duration-300 mb-3 line-clamp-2">
                                        {{ $event->title }}
                                    </h3>

                                    <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-3">
                                        {{ $event->description }}
                                    </p>

                                    <a href="{{ route('event.show', $event->slug) }}"
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
                        {{ $events->links() }}
                    </div>
                @else
                    <div class="bg-white rounded-3xl shadow-lg border border-green-100 p-16">
                        <div class="max-w-md mx-auto text-center">
                            <div class="mb-8">
                                <div class="inline-flex items-center justify-center w-20 h-20 bg-green-50 rounded-full">
                                    <i class="fas fa-calendar text-5xl text-green-400"></i>
                                </div>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-3">Belum Ada Event</h3>
                            <p class="text-gray-600 text-lg">Nantikan event menarik dari kami.</p>
                        </div>
                    </div>
                @endif
            </section>
        </div>
    </main>
@endsection

@push('styles')
    <style>
        @keyframes float-slow {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .animate-float-slow {
            animation: float-slow 6s infinite ease-in-out;
        }

        .animate-fade-in {
            animation: fade-in 1s ease-out;
        }

        .animate-fade-in-up {
            animation: fade-in-up 1s ease-out;
        }

        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush
