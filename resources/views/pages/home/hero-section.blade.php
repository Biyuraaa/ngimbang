<section x-data="heroSlider()" x-init="init()"
    class="relative min-h-screen flex items-center justify-center overflow-hidden" @mouseover="stopAutoplay"
    @mouseleave="startAutoplay">
    {{-- Gradient Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-br from-emerald-900/80 via-blue-900/70 to-violet-900/80 z-10"></div>

    {{-- Slider Images with Improved Transitions --}}
    <div class="absolute inset-0">
        @foreach ($destinations as $index => $slide)
            <div x-show="currentSlide === {{ $index }}"
                x-transition:enter="transition-all duration-1000 ease-out transform"
                x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transition-all duration-1000 ease-out transform"
                x-transition:leave-start="translate-x-0 opacity-100"
                x-transition:leave-end="-translate-x-full opacity-0" class="absolute inset-0">
                <img src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}"
                    class="w-full h-full object-cover transform transition-transform duration-[10000ms] scale-110"
                    :class="{ 'scale-100': currentSlide === {{ $index }} }">
            </div>
        @endforeach
    </div>

    {{-- Content Container --}}
    <div class="relative z-20 container mx-auto px-4 text-center">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Welcome Text with Animation --}}
            <div class="space-y-4 sm:space-y-6 mb-8 sm:mb-12 animate-fade-up">
                <p class="text-lg sm:text-xl text-emerald-300 font-medium tracking-wider uppercase">
                    Selamat Datang di
                </p>
                <h1
                    class="text-3xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-white tracking-tight leading-none">
                    Desa Wisata Gunungsari
                </h1>
            </div>

            {{-- Slide Content --}}
            @foreach ($destinations as $index => $destination)
                <div x-show="currentSlide === {{ $index }}"
                    x-transition:enter="transition-all duration-1000 delay-300"
                    x-transition:enter-start="opacity-0 translate-y-8"
                    x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition-all duration-500"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="space-y-4 sm:space-y-8">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white drop-shadow-lg">
                        {{ $destination->title }}
                    </h2>
                    <p
                        class="text-lg sm:text-xl md:text-2xl text-white/90 font-medium max-w-3xl mx-auto leading-relaxed">
                        {{ $destination->description }}
                    </p>
                </div>
            @endforeach

            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row justify-center items-stretch gap-4 sm:gap-6 mt-8 sm:mt-12">
                <a href=""
                    class="group w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-4 bg-emerald-600 hover:bg-emerald-500 text-white rounded-full transition-all duration-300 flex items-center justify-center gap-3 transform hover:-translate-y-1 hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5 group-hover:animate-bounce"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                    <span class="text-sm sm:text-base font-bold">Jelajahi Wisata</span>
                </a>
                <a href=""
                    class="group w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-4 bg-white/10 backdrop-blur-sm hover:bg-white/20 text-white rounded-full transition-all duration-300 flex items-center justify-center gap-3 border-2 border-white/30 transform hover:-translate-y-1 hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4 sm:w-5 sm:h-5 group-hover:rotate-12 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span class="text-sm sm:text-base font-bold">Produk Lokal</span>
                </a>
            </div>
        </div>
    </div>

    {{--  Navigation Controls --}}
    <div class="absolute inset-x-0 top-1/2 -translate-y-1/2 flex justify-between px-4 md:px-8 z-30">
        <button @click="prev()"
            class="p-2 rounded-full bg-black/20 backdrop-blur-sm hover:bg-black/30 transition-all duration-300 transform hover:scale-110"
            aria-label="Previous slide">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button @click="next()"
            class="p-2 rounded-full bg-black/20 backdrop-blur-sm hover:bg-black/30 transition-all duration-300 transform hover:scale-110"
            aria-label="Next slide">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>

    {{-- Progress Indicators --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex gap-3 z-30">
        @foreach ($destinations as $index => $destination)
            <button @click="currentSlide = {{ $index }}"
                :class="{
                    'w-8 bg-white': currentSlide === {{ $index }},
                    'w-2 bg-white/50': currentSlide !==
                        {{ $index }}
                }"
                class="h-2 rounded-full transition-all duration-300 hover:bg-white/90"
                aria-label="Go to slide {{ $index + 1 }}"></button>
        @endforeach
    </div>
</section>

@push('styles')
    <style>
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
                destinations: @json($destinations),
                currentSlide: 0,
                autoplayInterval: null,
                intervalDuration: 6000,
                init() {
                    this.startAutoplay();
                },

                startAutoplay() {
                    this.autoplayInterval = setInterval(() => {
                        this.next();
                    }, this.intervalDuration);
                },

                stopAutoplay() {
                    clearInterval(this.autoplayInterval);
                },

                prev() {
                    this.currentSlide = this.currentSlide === 0 ? this.destinations.length - 1 : this.currentSlide - 1;
                    this.resetAutoplay();
                },

                next() {
                    this.currentSlide = this.currentSlide === this.destinations.length - 1 ? 0 : this.currentSlide + 1;
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
