@extends('layouts.guest')

@section('title', 'Galeri Desa Ngimbang')

@section('content')
    <main class="min-h-screen bg-gradient-to-b from-green-100 via-emerald-50/30 to-white">
        <section class="py-12 sm:py-16 lg:py-24 bg-gradient-to-b from-teal-50/70 to-white">
            <div class="px-4 sm:px-6 lg:px-8 mx-auto max-w-7xl">
                <!-- Header -->
                <div class="relative mb-12 sm:mb-16 lg:mb-20 overflow-hidden">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-5">
                        <div class="absolute inset-0 bg-gradient-to-r from-green-100 to-blue-100"></div>
                        <div class="absolute inset-y-0 left-0 w-1/2 bg-gradient-to-r from-green-50 to-transparent"></div>
                    </div>

                    <!-- Main Content -->
                    <div class="relative max-w-4xl mx-auto text-center px-4 py-8 sm:py-12">
                        <!-- Decorative Elements -->
                        <div class="absolute top-0 left-0 w-20 h-20 transform -translate-x-1/2 -translate-y-1/2">
                            <div class="w-full h-full animate-spin-slow">
                                <svg viewBox="0 0 100 100" class="w-full h-full fill-current text-green-100">
                                    <path d="M50 0 L100 50 L50 100 L0 50Z"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Title Container -->
                        <div class="relative inline-block group cursor-pointer">
                            <h2
                                class="text-3xl sm:text-4xl lg:text-5xl font-bold text-green-800 relative inline-block transition-transform duration-300 ease-out transform group-hover:scale-105">
                                Galeri Desa
                                <!-- Animated Underline -->
                                <div
                                    class="absolute -bottom-4 left-0 right-0 h-1.5 bg-gradient-to-r from-green-400 via-emerald-300 to-blue-400 rounded-full transform origin-left transition-all duration-500 ease-out group-hover:scale-x-110 group-hover:h-2">
                                </div>
                            </h2>

                            <!-- Enhanced Decorative Corners -->
                            <div
                                class="hidden sm:block absolute -top-6 -left-6 w-14 h-14 border-t-4 border-l-4 border-green-200 rounded-tl-lg opacity-0 group-hover:opacity-100 transition-all duration-500 ease-out transform group-hover:-translate-x-1 group-hover:-translate-y-1 group-hover:border-green-300">
                            </div>
                            <div
                                class="hidden sm:block absolute -bottom-6 -right-6 w-14 h-14 border-b-4 border-r-4 border-green-200 rounded-br-lg opacity-0 group-hover:opacity-100 transition-all duration-500 ease-out transform group-hover:translate-x-1 group-hover:translate-y-1 group-hover:border-green-300">
                            </div>
                        </div>

                        <!-- Subtitle with Enhanced Animation -->
                        <p
                            class="text-base sm:text-lg text-gray-600 mt-8 max-w-2xl mx-auto leading-relaxed opacity-0 animate-fade-in-up">
                            Keindahan dan keunikan Desa Ngimbang dalam jepretan gambar
                        </p>

                        <!-- Decorative Bottom Element -->
                        <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2">
                            <div
                                class="w-32 h-1 bg-gradient-to-r from-transparent via-green-200 to-transparent rounded-full">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gallery Grid Container -->
                <div class="py-8 px-4 mx-auto max-w-screen-2xl">
                    <!-- Gallery Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
                        @foreach ($galleries as $gallery)
                            <div class="group relative [perspective:1000px] hover:z-10 transition-all duration-300">
                                <div
                                    class="relative h-[300px] sm:h-[350px] lg:h-[400px] rounded-2xl transition-all duration-500 [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)] shadow-lg hover:shadow-2xl">
                                    <!-- Front Side -->
                                    <div class="absolute inset-0 overflow-hidden rounded-2xl">
                                        <!-- Image Container with Shimmer Loading Effect -->
                                        <div class="relative w-full h-full bg-gray-200 animate-pulse">
                                            <img src="{{ $gallery->image
                                                ? asset('storage/images/galleries/' . $gallery->image)
                                                : asset('assets/images/no_thumbnail.jpg') }}"
                                                alt="{{ $gallery->name }}"
                                                class="w-full h-full object-cover rounded-2xl transition-transform duration-700 group-hover:scale-110"
                                                onload="this.parentElement.classList.remove('animate-pulse', 'bg-gray-200')"
                                                loading="lazy">
                                            <!-- Enhanced Gradient Overlay -->
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl">
                                                <div
                                                    class="absolute bottom-6 left-6 right-6 space-y-3 transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                                                    <!-- Category Badge -->
                                                    <div class="flex items-center gap-2">
                                                        <span
                                                            class="px-4 py-1.5 text-sm text-white bg-green-600/90 rounded-full backdrop-blur-sm shadow-lg inline-flex items-center gap-2">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                            </svg>
                                                            Gallery
                                                        </span>
                                                        <span
                                                            class="text-sm text-white/80">{{ $gallery->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <!-- Title -->
                                                    <h3 class="text-xl font-bold text-white">
                                                        {{ $gallery->name }}
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Back Side -->
                                    <div
                                        class="absolute inset-0 h-full w-full rounded-2xl bg-gradient-to-br from-green-800 to-green-600 px-6 py-8 text-center text-white [transform:rotateY(180deg)] [backface-visibility:hidden] shadow-2xl">
                                        <div class="flex min-h-full flex-col items-center justify-center space-y-6">
                                            <!-- Back Title -->
                                            <h3 class="text-2xl font-bold mb-2">{{ $gallery->name }}</h3>

                                            <!-- Description with Fade-in Animation -->
                                            <p class="text-base text-gray-100 line-clamp-4">
                                                {{ $gallery->description }}
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Empty State -->
                    @if ($galleries->isEmpty())
                        <div class="flex flex-col items-center justify-center py-12 text-center">
                            <div class="w-24 h-24 mb-6 text-gray-300">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum ada galeri</h3>
                            <p class="text-gray-500">Galeri akan ditampilkan di sini setelah ditambahkan.</p>
                        </div>
                    @endif
                </div>

            </div>
        </section>

    </main>
@endsection

@push('styles')
    <style>
        @keyframes fade-in-up {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes spin-slow {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 1s ease-out forwards;
        }

        .animate-spin-slow {
            animation: spin-slow 20s linear infinite;
        }

        /* Custom Animation for Image Loading */
        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }

            100% {
                background-position: 1000px 0;
            }
        }

        .animate-pulse {
            background: linear-gradient(90deg, #f3f4f6 0%, #e5e7eb 50%, #f3f4f6 100%);
            background-size: 1000px 100%;
            animation: shimmer 2s infinite linear;
        }
    </style>
@endpush
