    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-emerald-50 via-teal-50 to-white">
        <!-- Decorative Background -->
        <div class="absolute inset-0">
            <div
                class="absolute inset-0 bg-[url('{{ asset('assets/images/hero.jpeg') }}')] bg-cover bg-center opacity-10">
            </div>
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 via-teal-500/10 to-green-500/10"></div>
        </div>

        <!-- Main Content -->
        <div class="relative">
            <div class="container mx-auto px-6 py-24 lg:py-32">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Text Content -->
                    <div class="space-y-9">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold" x-data="{
                            text: '',
                            textArray: [
                                'Selamat Datang di Desa Ngimbang',
                                'The Wonderful of Desa Ngimbang',
                                'Welcome to Desa Ngimbang',
                                'Explore Our Village'
                            ],
                            currentIndex: 0,
                            charIndex: 0,
                            isDeleting: false,
                            typeSpeed: 100,
                            deleteSpeed: 50,
                            pauseEnd: 2000,
                            pauseStart: 500
                        }"
                            x-init="$nextTick(() => {
                                function typeText() {
                                    const current = textArray[currentIndex];
                            
                                    if (!isDeleting) {
                                        text = current.substring(0, charIndex + 1);
                                        charIndex++;
                            
                                        if (charIndex === current.length) {
                                            isDeleting = true;
                                            setTimeout(typeText, pauseEnd);
                                            return;
                                        }
                                    } else {
                                        text = current.substring(0, charIndex - 1);
                                        charIndex--;
                            
                                        if (charIndex === 0) {
                                            isDeleting = false;
                                            currentIndex = (currentIndex + 1) % textArray.length;
                                            setTimeout(typeText, pauseStart);
                                            return;
                                        }
                                    }
                            
                                    setTimeout(typeText, isDeleting ? deleteSpeed : typeSpeed);
                                }
                            
                                typeText();
                            })">
                            <div class="relative inline-block">
                                <span
                                    class="bg-gradient-to-r from-emerald-600 to-green-600 bg-clip-text text-transparent whitespace-pre-line"
                                    x-text="text"></span>
                                <span class="absolute bottom-0 -right-2 animate-blink text-emerald-600"
                                    x-bind:style="{ 'left': text.length > 0 ? (text.split('\n').pop().length * 0.61) + 'em' : '0' }">|</span>
                            </div>
                        </h1>

                        <p class="text-green-700 text-lg md:text-xl leading-relaxed">
                            Temukan keindahan alam, budaya, dan potensi desa kami. Mari bersama membangun masa depan
                            yang
                            lebih baik untuk masyarakat desa.
                        </p>

                        <div class="flex flex-wrap gap-4">
                            <a href=""
                                class="inline-flex items-center gap-2 px-6 py-3 text-white bg-green-600 rounded-xl hover:bg-green-700 shadow-lg hover:shadow-xl transition-all duration-300">
                                <span>Jelajahi Desa</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </a>
                            <a href=""
                                class="inline-flex items-center gap-2 px-6 py-3 text-green-700 bg-white/80 backdrop-blur-sm rounded-xl hover:bg-white/90 shadow-lg hover:shadow-xl transition-all duration-300">
                                <span>Hubungi Kami</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Image/Stats Section -->
                    <div class="relative group">
                        <div
                            class="relative rounded-3xl overflow-hidden shadow-2xl transform transition-transform duration-500 hover:scale-[1.02]">
                            <img src="{{ asset('assets/images/hero.jpeg') }}" alt="Desa Ngimbang"
                                class="w-full aspect-[4/3] object-cover transform hover:scale-105 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent">
                            </div>

                            <!-- Stats -->
                            <div class="absolute bottom-0 left-0 right-0 p-8 backdrop-blur-sm bg-black/20">
                                <div class="grid grid-cols-3 gap-6">
                                    <div
                                        class="text-center transform hover:scale-110 transition-transform duration-300">
                                        <svg class="w-8 h-8 mx-auto mb-2 text-emerald-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                        <span class="block text-3xl font-bold text-white mb-1">2,500+</span>
                                        <span class="text-sm font-medium text-emerald-200">Penduduk</span>
                                    </div>
                                    <div
                                        class="text-center transform hover:scale-110 transition-transform duration-300">
                                        <svg class="w-8 h-8 mx-auto mb-2 text-emerald-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                            </path>
                                        </svg>
                                        <span class="block text-3xl font-bold text-white mb-1">15+</span>
                                        <span class="text-sm font-medium text-emerald-200">UMKM</span>
                                    </div>
                                    <div
                                        class="text-center transform hover:scale-110 transition-transform duration-300">
                                        <svg class="w-8 h-8 mx-auto mb-2 text-emerald-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span class="block text-3xl font-bold text-white mb-1">5+</span>
                                        <span class="text-sm font-medium text-emerald-200">Destinasi</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full h-12 md:h-16 lg:h-20" viewBox="0 0 1440 54" preserveAspectRatio="none"
                fill="url(#gradient-fill)">
                <defs>
                    <linearGradient id="gradient-fill" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" style="stop-color: rgb(255, 255, 255)" />
                        <stop offset="100%" style="stop-color: rgb(240, 253, 244)" />
                    </linearGradient>
                </defs>
                <path d="M1440 54V0C1252.89 32.4 1041.23 54 810 54C578.77 54 367.11 32.4 180 0H0V54H1440Z"></path>
            </svg>
        </div>
    </div>
    <style>
        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes gradientFlow {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .animate-blink {
            animation: blink 1s infinite;
        }

        .animate-fade-up {
            animation: fadeUp 0.8s ease-out forwards;
        }

        .gradient-animate {
            background-size: 200% auto;
            animation: gradientFlow 3s ease infinite;
        }
    </style>
