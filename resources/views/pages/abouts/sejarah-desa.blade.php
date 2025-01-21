@extends('layouts.guest')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-green-50 to-white py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section - Improved Mobile Spacing -->
            <div class="text-center mb-8 md:mb-16">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-green-800 mb-3 md:mb-4">Sejarah Desa Ngimbang
                </h1>
                <div class="h-1 md:h-1.5 w-24 md:w-32 bg-green-600 mx-auto rounded-full mb-4 md:mb-8"></div>
                <div class="max-w-3xl mx-auto px-4">
                    <p class="text-base md:text-lg text-green-700 max-w-2xl mx-auto">Perjalanan sejarah panjang dari masa ke
                        masa yang
                        membentuk identitas dan warisan budaya daerah ini.</p>
                </div>
            </div>

            <!-- Main Content - Improved Spacing and Readability -->
            <div class="max-w-4xl mx-auto space-y-6 md:space-y-12">
                <!-- Introduction Section -->
                <div
                    class="bg-parchment bg-opacity-90 rounded-xl md:rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                    <div class="p-6 md:p-8 lg:p-10">
                        <h2 class="text-2xl md:text-3xl font-bold text-green-800 mb-4 md:mb-6 font-serif">Perjalanan Sejarah
                            Batu</h2>
                        <div class="space-y-4 text-sm md:text-base">
                            <p class="text-green-700 leading-relaxed">
                                Kendati daerah Batu telah meniti perjalanan sejarah yang amat panjang, sedari Masa Bercocok
                                Tanam dan Masa Perundagian di Zaman Prasejarah, memasuki Masa Hindu-Buddha, berlanjut ke
                                Masa
                                Perkembangan Islam, melintasi Masa Kolonial hingga sampai Masa Kemerdekaan RI sekarang.
                            </p>
                            <p class="text-green-700 leading-relaxed">
                                Perlu disadari bahwa sekecil apapun peninggalan budaya pada masa lampau, memiliki arti
                                penting
                                dalam memahami perjalanan sejarah suatu daerah.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Prasasti Section - Improved Grid Layout -->
                <div class="bg-green-200 rounded-xl md:rounded-2xl shadow-lg p-6 md:p-8 lg:p-10">
                    <h3 class="text-xl md:text-2xl font-semibold text-green-800 mb-4 md:mb-6 flex items-center font-serif">
                        <span class="inline-block w-1.5 md:w-2 h-6 md:h-8 bg-green-600 rounded-full mr-3 md:mr-4"></span>
                        Prasasti Bersejarah
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
                        <div
                            class="bg-parchment rounded-lg md:rounded-xl p-4 md:p-6 shadow-md hover:shadow-lg transition-shadow duration-300">
                            <h4 class="text-lg md:text-xl font-semibold text-green-700 mb-2 md:mb-3 font-serif">Prasasti
                                Sangguran</h4>
                            <p class="text-sm md:text-base text-green-600">Ditemukan pada 928 Masehi, merupakan sumber
                                sejarah "internal" Batu
                                yang penting karena berasal langsung dari daerah Batu.</p>
                        </div>
                        <div
                            class="bg-parchment rounded-lg md:rounded-xl p-4 md:p-6 shadow-md hover:shadow-lg transition-shadow duration-300">
                            <h4 class="text-lg md:text-xl font-semibold text-green-700 mb-2 md:mb-3 font-serif">Prasasti
                                Jiyu</h4>
                            <p class="text-sm md:text-base text-green-600">Ditemukan pada 1486 Masehi, menyebutkan Desa
                                Perdikan Batu melalui
                                kata "deseng Batu" (desa di Batu).</p>
                        </div>
                    </div>
                </div>

                <!-- Timeline Sections - Improved Accordion -->
                <div class="space-y-4 md:space-y-8">
                    <!-- Hindu-Buddha Era -->
                    <div x-data="{ open: false }" class="bg-parchment rounded-xl md:rounded-2xl shadow-lg overflow-hidden">
                        <div @click="open = !open" class="p-6 md:p-8 lg:p-10 cursor-pointer">
                            <h3
                                class="text-xl md:text-2xl font-semibold text-green-800 mb-2 flex items-center justify-between font-serif">
                                <span>Batu pada Masa Hindu-Buddha</span>
                                <svg :class="{ 'rotate-180': open }"
                                    class="w-5 h-5 md:w-6 md:h-6 transform transition-transform duration-200" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </h3>
                        </div>
                        <div x-show="open" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="px-6 md:px-8 lg:px-10 pb-6 md:pb-8 lg:pb-10">
                            <div class="prose max-w-none text-sm md:text-base text-green-700 space-y-4">
                                <p>Berdasarkan bukti artefaktual dan tekstual, wilayah Batu telah menjadi tempat hunian
                                    sejak Zaman Prasejarah, khususnya pada Masa Bercocok Tanam.</p>
                                <p>Desa-desa di Batu, seperti Sangguran, Batwan, dan Deseng Batu, dikenal memiliki status
                                    "Desa Perdikan" atau "Sima".</p>
                            </div>
                        </div>
                    </div>

                    <!-- Islamic Era - Similar Pattern -->
                    <div x-data="{ open: false }" class="bg-parchment rounded-xl md:rounded-2xl shadow-lg overflow-hidden">
                        <div @click="open = !open" class="p-6 md:p-8 lg:p-10 cursor-pointer">
                            <h3
                                class="text-xl md:text-2xl font-semibold text-green-800 mb-2 flex items-center justify-between font-serif">
                                <span>Batu pada Masa Perkembangan Islam</span>
                                <svg :class="{ 'rotate-180': open }"
                                    class="w-5 h-5 md:w-6 md:h-6 transform transition-transform duration-200" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </h3>
                        </div>
                        <div x-show="open" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="px-6 md:px-8 lg:px-10 pb-6 md:pb-8 lg:pb-10">
                            <div class="prose max-w-none text-sm md:text-base text-green-700">
                                <p>Pada Masa Perkembangan Islam, sekitar abad XVIII hingga XIX, Batu menjadi wilayah penting
                                    untuk penyebaran agama Islam. Tokoh seperti <strong>Mbah Batu</strong> dan
                                    <strong>Bambang Selo Utomo</strong> dianggap berperan penting dalam menyebarkan Islam.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Village History -->
                    <div x-data="{ open: false }" class="bg-parchment rounded-xl md:rounded-2xl shadow-lg overflow-hidden">
                        <div @click="open = !open" class="p-6 md:p-8 lg:p-10 cursor-pointer">
                            <h3
                                class="text-xl md:text-2xl font-semibold text-green-800 mb-2 flex items-center justify-between font-serif">
                                <span>Sejarah Desa Ngimbang</span>
                                <svg :class="{ 'rotate-180': open }"
                                    class="w-5 h-5 md:w-6 md:h-6 transform transition-transform duration-200" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </h3>
                        </div>
                        <div x-show="open" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="px-6 md:px-8 lg:px-10 pb-6 md:pb-8 lg:pb-10">
                            <div class="prose max-w-none text-sm md:text-base text-green-700">
                                <p>Desa Ngimbang, menurut folklor, pertama kali dihuni oleh K.H. Anwar Mukmin, atau lebih
                                    dikenal sebagai <strong>Buyut Sarpin</strong>, seorang pendatang dari Ponorogo, sekitar
                                    tahun 1745 M.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Village Leaders - Improved Card Layout -->
                <div class="bg-green-100 rounded-xl md:rounded-2xl shadow-lg p-6 md:p-8 lg:p-10 mt-6 md:mt-8">
                    <h3 class="text-xl md:text-2xl font-semibold text-green-800 mb-4 md:mb-6 flex items-center font-serif">
                        <span class="inline-block w-1.5 md:w-2 h-6 md:h-8 bg-green-600 rounded-full mr-3 md:mr-4"></span>
                        Nama-Nama Pemimpin Desa Ngimbang
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6">
                        @foreach ($leaders as $leader)
                            <div
                                class="bg-parchment rounded-lg md:rounded-xl p-4 md:p-6 shadow-md hover:shadow-lg transition-shadow duration-300">
                                <h4 class="text-base md:text-lg font-semibold text-green-700 mb-2 font-serif">
                                    {{ $leader['name'] }}</h4>
                                <p class="text-xs md:text-sm text-green-600">{{ $leader['period'] }}</p>
                                <p class="text-xs md:text-sm text-green-500">{{ $leader['location'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .bg-parchment {
            background-color: #bbf7d0;
            background-image: url("data:image/svg+xml,%3Csvg width='52' height='26' viewBox='0 0 52 26' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23d2b48c' fill-opacity='0.1'%3E%3Cpath d='M10 10c0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6h2c0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4v2c-3.314 0-6-2.686-6-6 0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6 0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6 0-2.21-1.79-4-4-4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        @media (max-width: 640px) {
            .prose {
                font-size: 0.875rem;
                line-height: 1.6;
            }

            .prose p {
                margin-top: 0.75em;
                margin-bottom: 0.75em;
            }

            .prose strong {
                font-weight: 600;
            }
        }

        @media (max-width: 480px) {
            .timeline-content {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .leader-card {
                padding: 0.75rem;
            }

            .section-title {
                font-size: 1.25rem;
                line-height: 1.75rem;
            }
        }

        /* Enhanced touch interactions for mobile */
        @media (hover: none) and (pointer: coarse) {
            .accordion-trigger {
                min-height: 48px;
                /* Ensure touch target size */
                padding: 0.75rem;
            }

            .card-hover {
                transition: transform 0.2s ease;
            }

            .card-hover:active {
                transform: scale(0.98);
            }
        }

        /* Improved readability on small screens */
        @media (max-width: 360px) {
            .text-content {
                font-size: 0.8125rem;
                line-height: 1.5;
            }

            .card-title {
                font-size: 1rem;
                line-height: 1.4;
            }

            .card-subtitle {
                font-size: 0.75rem;
                line-height: 1.3;
            }
        }

        /* Better spacing for different screen heights */
        @media (max-height: 700px) {
            .section-spacing {
                margin-top: 1rem;
                margin-bottom: 1rem;
            }

            .content-padding {
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
            }
        }

        /* Optimize background pattern for mobile */
        @media (max-width: 480px) {
            .bg-parchment {
                background-size: 26px 13px;
            }
        }

        /* Improve scrolling performance */
        @media (pointer: coarse) {
            .smooth-scroll {
                scroll-behavior: auto;
            }
        }

        /* Enhanced accessibility for mobile */
        @media (max-width: 640px) {
            .interactive-element {
                cursor: pointer;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            }

            .interactive-element:active {
                background-color: rgba(0, 0, 0, 0.05);
            }
        }
    </style>
@endpush
