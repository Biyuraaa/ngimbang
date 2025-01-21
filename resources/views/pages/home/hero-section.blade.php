<section x-data="heroSlider()" x-init="init()"
    class="relative min-h-screen flex items-center justify-center overflow-hidden" @mouseover="pauseAutoplay"
    @mouseleave="resumeAutoplay">

    {{-- Gradient Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-br from-emerald-900/80 via-blue-900/70 to-violet-900/80 z-10"></div>

    {{-- Background Slides --}}
    <div class="absolute inset-0">
        @foreach ($destinations as $index => $destination)
            <div x-show="currentSlide === {{ $index }}"
                x-transition:enter="transition-all duration-1000 ease-out transform"
                x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transition-all duration-1000 ease-out transform"
                x-transition:leave-start="translate-x-0 opacity-100"
                x-transition:leave-end="-translate-x-full opacity-0" class="absolute inset-0">
                <img src="{{ $destination['thumbnail'] ?? asset('assets/images/destinations/no-thumbnail.png') }}"
                    alt="{{ $destination['name'] }}"
                    class="w-full h-full object-cover transform transition-transform duration-[10000ms] scale-110"
                    :class="{ 'scale-100': currentSlide === {{ $index }} }">
            </div>
        @endforeach
    </div>
    {{-- Content Container --}}
    <div class="relative z-20 container mx-auto px-4">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header Text --}}
            <div class="space-y-4 sm:space-y-6 mb-8 sm:mb-12 animate-fade-up text-center">
                <p class="text-lg sm:text-xl text-emerald-300 font-medium tracking-wider uppercase">
                    Selamat Datang di
                </p>
                <h1
                    class="text-3xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-white tracking-tight leading-none">
                    Desa Ngimbang
                </h1>
            </div>

            {{-- Destination Content --}}
            @foreach ($destinations as $index => $destination)
                <div x-show="currentSlide === {{ $index }}"
                    x-transition:enter="transition-all duration-1000 delay-300"
                    x-transition:enter-start="opacity-0 translate-y-8"
                    x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition-all duration-500"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="space-y-4 sm:space-y-6 text-center">
                    <div class="flex items-center justify-center gap-2 text-yellow-400">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 {{ $i <= $destination['rating'] ? 'text-yellow-400' : 'text-gray-400' }}"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                        <span class="text-white ml-2">({{ $destination['reviews_count'] }} ulasan)</span>
                    </div>

                    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white drop-shadow-lg">
                        {{ $destination['name'] }}
                    </h2>
                    <p
                        class="text-lg sm:text-xl md:text-2xl text-white/90 font-medium max-w-3xl mx-auto leading-relaxed">
                        {{ $destination['description'] }}
                    </p>

                    <div class="pt-4">
                        <a href="{{ route('wisata.show', $destination['slug']) }}"
                            class="inline-flex items-center px-6 py-3 bg-emerald-600 hover:bg-emerald-500 text-white rounded-full transition-all duration-300 transform hover:-translate-y-1">
                            <span class="font-semibold">Lihat Detail</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach

            {{-- Navigation Controls --}}
            <div class="absolute inset-x-0 top-1/2 -translate-y-1/2 flex justify-between px-4 md:px-8 z-30">
                <button @click="prev" class="nav-button group" aria-label="Previous slide">
                    <svg class="w-6 h-6 text-white group-hover:scale-110 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button @click="next" class="nav-button group" aria-label="Next slide">
                    <svg class="w-6 h-6 text-white group-hover:scale-110 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            {{-- Progress Indicators --}}
            <div class="flex justify-center gap-3 mt-8">
                @foreach ($destinations as $index => $destination)
                    <button @click="goToSlide({{ $index }})"
                        class="h-2 transition-all duration-300 hover:bg-white/90 rounded-full"
                        :class="{
                            'w-8 bg-white': currentSlide === {{ $index }},
                            'w-2 bg-white/50': currentSlide !==
                                {{ $index }}
                        }"
                        aria-label="Go to slide {{ $index + 1 }}">
                    </button>
                @endforeach
            </div>

        </div>
    </div>
</section>

@push('styles')
    <style>
        .nav-button {
            @apply p-2 rounded-full bg-black/20 backdrop-blur-sm hover:bg-black/30 transition-all duration-300;
        }

        @keyframes fade-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-up {
            animation: fade-up 1s ease-out;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function heroSlider() {
            return {
                currentSlide: 0,
                autoplayInterval: null,
                intervalDuration: 6000,
                isPaused: false,

                init() {
                    this.startAutoplay();
                },

                startAutoplay() {
                    if (this.autoplayInterval) this.stopAutoplay();
                    this.autoplayInterval = setInterval(() => {
                        if (!this.isPaused) this.next();
                    }, this.intervalDuration);
                },

                stopAutoplay() {
                    if (this.autoplayInterval) {
                        clearInterval(this.autoplayInterval);
                        this.autoplayInterval = null;
                    }
                },

                pauseAutoplay() {
                    this.isPaused = true;
                },

                resumeAutoplay() {
                    this.isPaused = false;
                },

                goToSlide(index) {
                    this.currentSlide = index;
                    this.resetAutoplay();
                },

                prev() {
                    this.currentSlide = this.currentSlide === 0 ? {{ count($destinations) - 1 }} : this.currentSlide - 1;
                    this.resetAutoplay();
                },

                next() {
                    this.currentSlide = this.currentSlide === {{ count($destinations) - 1 }} ? 0 : this.currentSlide + 1;
                    this.resetAutoplay();
                },

                resetAutoplay() {
                    this.stopAutoplay();
                    this.startAutoplay();
                }
            };
        }
    </script>
@endpush
