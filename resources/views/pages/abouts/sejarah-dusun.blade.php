@extends('layouts.guest')

@section('title', 'Sejarah Dusun Desa Ngimbang')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-green-50 to-white py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-8 sm:mb-16">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-green-800 mb-3 sm:mb-4">Sejarah Dusun</h1>
                <div class="h-1.5 w-24 sm:w-32 bg-green-600 mx-auto rounded-full mb-4 sm:mb-8"></div>
                <p class="text-base sm:text-lg text-green-700 max-w-2xl mx-auto px-4">
                    Mengenal asal-usul dan cerita sejarah dusun-dusun di Desa Ngimbang
                </p>
            </div>

            <!-- Quick Navigation -->
            <div class="flex flex-wrap justify-center gap-3 sm:gap-4 mb-8 sm:mb-16">
                @foreach (['Pagergunung', 'Kapru', 'Brumbung', 'Jantur', 'Brau'] as $dusun)
                    <a href="#{{ strtolower($dusun) }}"
                        class="px-4 sm:px-6 py-2 bg-white rounded-full shadow hover:shadow-lg transition-shadow duration-300 text-sm sm:text-base text-green-700 hover:bg-green-50">
                        {{ $dusun }}
                    </a>
                @endforeach
            </div>

            <!-- Timeline Container -->
            <div class="relative">
                <!-- Timeline line - hidden on mobile -->
                <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-green-200 hidden md:block"></div>

                <!-- Mobile timeline line -->
                <div class="absolute left-8 h-full w-1 bg-green-200 md:hidden"></div>

                <!-- Sections -->
                @php
                    $sections = [
                        [
                            'id' => 'pagergunung',
                            'title' => 'Dusun Pagergunung',
                            'icon' => 'fa-mountain',
                            'content' =>
                                'Dusun Pagergunung merupakan dusun tertua di Desa Ngimbang. Dusun ini ditemukan oleh seorang tokoh masyarakat yang bernama Mbah Pager. Dusun ini dulunya merupakan tempat perkebunan kopi yang luas. Namun, dikarenakan banyaknya warga yang meninggalkan dusun ini, perkebunan kopi tersebut ditinggalkan dan menjadi hutan belantara. Dusun Pagergunung juga memiliki keunikan yaitu adanya sebuah gua yang konon katanya merupakan tempat persembunyian para pejuang kemerdekaan pada masa penjajahan Belanda.',
                        ],
                        [
                            'id' => 'kapru',
                            'title' => 'Dusun Kapru',
                            'icon' => 'fa-cow',
                            'content' => 'Pada zaman dahulu, Dusun Kapru banyak dihuni oleh peternak sapi. Namun, dikisahkan mereka
                                sering kehilangan ternaknya dan pada akhirnya dibuatkan kandang-kandang ternak yang
                                digabungkan menjadi satu untuk mencegah kehilangan ternak lagi. Letaknya agak berjauhan dari
                                tempat tinggal mereka. Selain beternak, dikisahkan juga warga Kapru suka minum-minum dan di
                                daerah tersebut budaya minum serta tayub berkembang. Menurut folklor, kata “Kapru” ini
                                diambil dari bahasa Arab Kafaru atau Kafir yang berarti masyarakat Kapru ini sulit menerima
                                ajaran agama. Namun, ada sumber lain juga mengatakan bahwa nama Kapru tersebut diambil dari
                                bahasa Belanda.',
                        ],
                        [
                            'id' => 'brumbung',
                            'title' => 'Desa Brumbung',
                            'icon' => 'fa-wallet',
                            'content' => 'Dusun ini juga memiliki asal-usul yang mengatakan bahwa dulu ada sesosok Buta Nabru yang
                                pekerja keras. Yang kemudian sifatnya menurun pada masyarakat sekitar. Dusun Brumbung
                                berasal dari kata “Mubru” yang berarti kaya sekali. Hal ini dikarenakan rata-rata masyarakat
                                Dusun Brumbung memiliki perekonomian yang membumbung atau sangat berkecukupan karena
                                sifatnya yang pekerja keras.',
                        ],
                        [
                            'id' => 'jantur',
                            'title' => 'Dusun Jantur',
                            'icon' => 'fa-fist-raised',
                            'content' => 'Dusun Jantur memiliki cerita asal-usul dalam versi yang berbeda-beda. Dimana satu sumber
                                mengatakan bahwa kata “Jantur” ini berasal dari kegemaran masyarakatnya untuk berkelahi dan
                                adu kanoragan. Dan yang kalah akan di “Jantur”, yaitu digantung kakinya sehingga posisi
                                kepalanya di bawah. Namun, bila bersumber dari cerita sesepuh asli Dusun Jantur, “Jantur”
                                ini memang artinya digantung, namun dulu yang digantung adalah jangkrik. Karena dulu,
                                masyarakat Jantur suka bermusyawarah sambil mengadu hewan jangkrik tersebut.',
                        ],
                        [
                            'id' => 'brau',
                            'title' => 'Dusun Brau',
                            'icon' => 'fa-ship',
                            'content' => 'Dusun Brau menurut folklore yang beredar, ditemukan oleh seorang prajurit Pangeran Diponegoro
                                bernama Buyut Sarpin yang melarikan diri ke daerah Batu dari kejaran Belanda. Kemudian,
                                Buyut Sarpin dan rekannya menemukan sebuah tempat yang tepencil dan dikelilingi bukit yang
                                apabila dilihat dari atas bentuknya seperti perahu. Dari kata perahu tersebut untuk
                                memudahkan pelafalan maka masyarakat menyebutnya “Brau” atau “Mbrau”. Tempat itu
                                diperkirakan aman untuk bersembunyi dan pada akhirnya Buyut Sarpin menetap di daerah
                                tersebut. Namun, ada sumber lain yang menyebutkan jikalau Brau itu berasal dari bahasa kuno
                                masa Hindu-Buddha yang berarti posisi tangan Budha.',
                        ],
                    ];
                @endphp

                @foreach ($sections as $index => $section)
                    <section id="{{ $section['id'] }}"
                        class="relative mb-8 sm:mb-16 w-full md:w-[calc(50%-2rem)]
                        {{ $index % 2 == 0 ? 'md:mr-auto md:pl-0 pl-16' : 'md:ml-auto md:pr-0 pl-16' }}">
                        <div
                            class="bg-white rounded-lg sm:rounded-2xl shadow-md sm:shadow-xl p-6 sm:p-8 transform hover:scale-[1.01] sm:hover:scale-[1.02] transition-all duration-300">
                            <div class="flex items-center gap-3 sm:gap-4 mb-4 sm:mb-6">
                                <div
                                    class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-green-100 flex items-center justify-center">
                                    <i class="fas {{ $section['icon'] }} text-xl sm:text-2xl text-green-600"></i>
                                </div>
                                <h2 class="text-2xl sm:text-3xl font-bold text-green-800">{{ $section['title'] }}</h2>
                            </div>
                            <div class="prose prose-sm sm:prose-lg text-gray-600">
                                <p>{{ $section['content'] }}</p>
                            </div>
                        </div>

                        <!-- Timeline dots -->
                        <div
                            class="absolute {{ $index % 2 == 0 ? 'right-0 md:right-[-2rem]' : 'right-0 md:left-[-2rem]' }} top-8 w-4 h-4 sm:w-6 sm:h-6 rounded-full bg-green-600 border-4 border-white shadow hidden md:block">
                        </div>

                        <!-- Mobile timeline dot -->
                        <div
                            class="absolute left-6 top-8 w-4 h-4 rounded-full bg-green-600 border-4 border-white shadow md:hidden">
                        </div>
                    </section>
                @endforeach
            </div>
        </div>

        <!-- Scroll to Top Button - Responsive positioning -->
        <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
            class="fixed bottom-4 sm:bottom-8 right-4 sm:right-8 bg-green-600 text-white p-3 sm:p-4 rounded-full shadow-lg hover:bg-green-700
                   transition-colors duration-300 text-sm sm:text-base">
            <i class="fas fa-arrow-up"></i>
        </button>
    </div>

    <style>
        @media (max-width: 768px) {
            .prose {
                font-size: 0.95rem;
                line-height: 1.6;
            }

            .timeline-container {
                padding-left: 2rem;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .max-w-7xl {
                padding-left: 2rem;
                padding-right: 2rem;
            }
        }

        /* Smooth scroll behavior for anchor links */
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 2rem;
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }
        }

        /* Better touch targets for mobile */
        @media (max-width: 640px) {
            .quick-nav a {
                padding: 0.75rem 1rem;
            }
        }
    </style>
@endsection
