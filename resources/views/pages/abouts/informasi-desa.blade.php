@extends('layouts.guest')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-green-50 to-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-4xl mx-auto py-8 sm:py-12 lg:py-16">
                    <!-- Decorative Element -->
                    <div class="mb-6 inline-flex items-center justify-center">
                        <div class="w-20 h-20 relative">
                            <div class="absolute inset-0 bg-green-200/50 rounded-full"></div>
                            <div
                                class="relative flex items-center justify-center w-full h-full bg-gradient-to-br from-green-100 to-green-200 rounded-full">
                                <i class="fas fa-leaf text-3xl text-green-600"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-green-800 mb-4 lg:mb-6">
                        Informasi Desa
                    </h1>

                    <!-- Divider -->
                    <div class="flex items-center justify-center gap-2 mb-6 lg:mb-8">
                        <div class="h-1 w-8 bg-green-300 rounded-full"></div>
                        <div class="h-1.5 w-16 bg-green-500 rounded-full"></div>
                        <div class="h-1 w-8 bg-green-300 rounded-full"></div>
                    </div>

                    <!-- Description -->
                    <p class="text-base sm:text-lg text-green-700 max-w-2xl mx-auto leading-relaxed">
                        Informasi terkait kondisi geografis, pembagian dusun, tata guna lahan, topografi, demografi, dan
                        lainnya
                    </p>
                </div>
            </div>
            <!-- Geografis Section -->
            <section class="px-4 md:px-6 lg:px-8 mb-12">
                {{-- Header --}}
                <div class="flex flex-col mb-8">
                    <div class="flex items-center gap-4">
                        <i class="fas fa-map-marked-alt text-2xl md:text-3xl text-green-600"></i>
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Kondisi Geografis</h2>
                    </div>
                    <div class="h-1 w-24 bg-blue-500 rounded mt-2"></div>
                </div>

                {{-- Cards Container --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6 lg:gap-8">
                    {{-- Karakteristik Wilayah Card --}}
                    <div
                        class="bg-gradient-to-br from-white to-gray-50 p-4 md:p-6 lg:p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center mb-4 md:mb-6">
                            <i class="fas fa-mountain text-xl md:text-2xl text-green-600 mr-3 md:mr-4"></i>
                            <h3 class="text-xl md:text-2xl font-bold text-gray-800">Karakteristik Wilayah</h3>
                        </div>
                        <div class="space-y-3 md:space-y-4">
                            @php
                                $karakteristik = [
                                    ['icon' => 'cloud-rain', 'label' => 'Curah Hujan', 'value' => '30 mm'],
                                    ['icon' => 'calendar-alt', 'label' => 'Jumlah Bulan Hujan', 'value' => '5 Bulan'],
                                    ['icon' => 'temperature-high', 'label' => 'Suhu Rata-rata', 'value' => '18-25°C'],
                                    ['icon' => 'mountain', 'label' => 'Ketinggian', 'value' => '1000 dpl'],
                                ];
                            @endphp

                            @foreach ($karakteristik as $item)
                                <div
                                    class="flex items-center p-2 md:p-3 bg-white rounded-lg hover:bg-blue-50 transition-colors">
                                    <i class="fas fa-{{ $item['icon'] }} w-6 md:w-8 text-blue-500 text-sm md:text-base"></i>
                                    <span
                                        class="font-semibold w-32 md:w-48 text-sm md:text-base">{{ $item['label'] }}</span>
                                    <span class="text-gray-700 text-sm md:text-base">{{ $item['value'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Batas Wilayah Card --}}
                    <div
                        class="bg-gradient-to-br from-white to-gray-50 p-4 md:p-6 lg:p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center mb-4 md:mb-6">
                            <i class="fas fa-map-marker-alt text-xl md:text-2xl text-green-600 mr-3 md:mr-4"></i>
                            <h3 class="text-xl md:text-2xl font-bold text-gray-800">Batas Wilayah</h3>
                        </div>
                        <div class="space-y-3 md:space-y-4">
                            @php
                                $batasWilayah = [
                                    [
                                        'icon' => 'arrow-up',
                                        'label' => 'Utara',
                                        'value' => 'Desa Punten, Kec Bumiaji Kota Batu',
                                    ],
                                    [
                                        'icon' => 'arrow-right',
                                        'label' => 'Timur',
                                        'value' => 'Desa Sidomulyo, Kec Batu Kota Batu',
                                    ],
                                    [
                                        'icon' => 'arrow-down',
                                        'label' => 'Selatan',
                                        'value' => 'Desa Sumberejo, Kec Batu Kota Batu',
                                    ],
                                    [
                                        'icon' => 'arrow-left',
                                        'label' => 'Barat',
                                        'value' => 'Desa Pandesari, Kec Pujon Kab Malang',
                                    ],
                                    [
                                        'icon' => 'vector-square',
                                        'label' => 'Luas Wilayah',
                                        'value' => '318,833 Ha (4.106 Km²)',
                                    ],
                                ];
                            @endphp

                            @foreach ($batasWilayah as $item)
                                <div
                                    class="flex flex-col md:flex-row items-start md:items-center p-2 md:p-3 bg-white rounded-lg hover:bg-blue-50 transition-colors">
                                    <div class="flex items-center mb-1 md:mb-0">
                                        <i
                                            class="fas fa-{{ $item['icon'] }} w-6 md:w-8 text-blue-500 text-sm md:text-base"></i>
                                        <span
                                            class="font-semibold w-24 md:w-32 text-sm md:text-base">{{ $item['label'] }}</span>
                                    </div>
                                    <span
                                        class="text-gray-700 text-sm md:text-base pl-8 md:pl-0">{{ $item['value'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <!-- Dusun Section -->
            <section class="px-4 py-8 md:py-12">
                <div class="container mx-auto">
                    <!-- Header -->
                    <div class="flex flex-col mb-8 md:mb-12">
                        <div class="flex items-center gap-4">
                            <i class="fas fa-home text-2xl md:text-3xl text-green-600"></i>
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Pembagian Dusun</h2>
                        </div>
                        <div class="h-1 w-24 bg-blue-500 rounded mt-2"></div>
                    </div>

                    <!-- Grid Container -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 md:gap-6 lg:gap-8">
                        <!-- Pagergunung Card -->
                        <div
                            class="group bg-gradient-to-br from-blue-50 via-white to-blue-50 p-6 md:p-8 rounded-xl md:rounded-2xl 
                shadow-md hover:shadow-xl transition-all duration-300 ease-in-out 
                transform hover:scale-102 border border-blue-100/20 text-center">
                            <div class="relative flex justify-center">
                                <i
                                    class="fas fa-landmark text-4xl md:text-5xl text-green-600 mb-4 md:mb-6 
                        transition-transform duration-300 group-hover:scale-110"></i>
                                <div
                                    class="absolute -inset-1 bg-blue-500/10 rounded-full blur opacity-0 
                        group-hover:opacity-100 transition-opacity">
                                </div>
                            </div>
                            <h3 class="font-bold text-lg md:text-xl text-gray-800 mb-2">Pagergunung</h3>
                            <p class="text-gray-600 text-sm">250 Kepala Keluarga</p>
                        </div>

                        <!-- Kapru Card -->
                        <div
                            class="group bg-gradient-to-br from-blue-50 via-white to-blue-50 p-6 md:p-8 rounded-xl md:rounded-2xl 
                shadow-md hover:shadow-xl transition-all duration-300 ease-in-out 
                transform hover:scale-102 border border-blue-100/20 text-center">
                            <div class="relative flex justify-center">
                                <i
                                    class="fas fa-house-user text-4xl md:text-5xl text-green-600 mb-4 md:mb-6 
                        transition-transform duration-300 group-hover:scale-110"></i>
                                <div
                                    class="absolute -inset-1 bg-blue-500/10 rounded-full blur opacity-0 
                        group-hover:opacity-100 transition-opacity">
                                </div>
                            </div>
                            <h3 class="font-bold text-lg md:text-xl text-gray-800 mb-2">Kapru</h3>
                            <p class="text-gray-600 text-sm">180 Kepala Keluarga</p>
                        </div>

                        <!-- Brumbung Card -->
                        <div
                            class="group bg-gradient-to-br from-blue-50 via-white to-blue-50 p-6 md:p-8 rounded-xl md:rounded-2xl 
                shadow-md hover:shadow-xl transition-all duration-300 ease-in-out 
                transform hover:scale-102 border border-blue-100/20 text-center">
                            <div class="relative flex justify-center">
                                <i
                                    class="fas fa-city text-4xl md:text-5xl text-green-600 mb-4 md:mb-6 
                        transition-transform duration-300 group-hover:scale-110"></i>
                                <div
                                    class="absolute -inset-1 bg-blue-500/10 rounded-full blur opacity-0 
                        group-hover:opacity-100 transition-opacity">
                                </div>
                            </div>
                            <h3 class="font-bold text-lg md:text-xl text-gray-800 mb-2">Brumbung</h3>
                            <p class="text-gray-600 text-sm">200 Kepala Keluarga</p>
                        </div>

                        <!-- Jantur Card -->
                        <div
                            class="group bg-gradient-to-br from-blue-50 via-white to-blue-50 p-6 md:p-8 rounded-xl md:rounded-2xl 
                shadow-md hover:shadow-xl transition-all duration-300 ease-in-out 
                transform hover:scale-102 border border-blue-100/20 text-center">
                            <div class="relative flex justify-center">
                                <i
                                    class="fas fa-building text-4xl md:text-5xl text-green-600 mb-4 md:mb-6 
                        transition-transform duration-300 group-hover:scale-110"></i>
                                <div
                                    class="absolute -inset-1 bg-blue-500/10 rounded-full blur opacity-0 
                        group-hover:opacity-100 transition-opacity">
                                </div>
                            </div>
                            <h3 class="font-bold text-lg md:text-xl text-gray-800 mb-2">Jantur</h3>
                            <p class="text-gray-600 text-sm">160 Kepala Keluarga</p>
                        </div>

                        <!-- Brau Card -->
                        <div
                            class="group bg-gradient-to-br from-blue-50 via-white to-blue-50 p-6 md:p-8 rounded-xl md:rounded-2xl 
                shadow-md hover:shadow-xl transition-all duration-300 ease-in-out 
                transform hover:scale-102 border border-blue-100/20 text-center">
                            <div class="relative flex justify-center">
                                <i
                                    class="fas fa-house-chimney text-4xl md:text-5xl text-green-600 mb-4 md:mb-6 
                        transition-transform duration-300 group-hover:scale-110"></i>
                                <div
                                    class="absolute -inset-1 bg-blue-500/10 rounded-full blur opacity-0 
                        group-hover:opacity-100 transition-opacity">
                                </div>
                            </div>
                            <h3 class="font-bold text-lg md:text-xl text-gray-800 mb-2">Brau</h3>
                            <p class="text-gray-600 text-sm">190 Kepala Keluarga</p>
                        </div>
                    </div>
                </div>
            </section>

            @php
                $landUseData = [
                    ['id' => 1, 'category' => 'Hutan Produksi', 'area' => 3244, 'icon' => 'fa-tree'],
                    ['id' => 2, 'category' => 'Tanah Penduduk (Tegal)', 'area' => 134.385, 'icon' => 'fa-users'],
                    ['id' => 3, 'category' => 'Irigasi Semi Teknis', 'area' => 6, 'icon' => 'fa-tint'],
                    ['id' => 4, 'category' => 'Pemukiman', 'area' => 65.433, 'icon' => 'fa-home'],
                    ['id' => 5, 'category' => 'Jalan', 'area' => 5, 'icon' => 'fa-road'],
                    ['id' => 6, 'category' => 'Lapangan', 'area' => 1.122, 'icon' => 'fa-futbol'],
                    ['id' => 7, 'category' => 'Tanah Kas Desa', 'area' => 6.916, 'icon' => 'fa-landmark'],
                    ['id' => 8, 'category' => 'Tanah Perkantoran', 'area' => 0.701, 'icon' => 'fa-building'],
                    ['id' => 9, 'category' => 'Kegiatan Lainnya', 'area' => 0.823, 'icon' => 'fa-briefcase'],
                ];

                $totalArea = array_sum(array_column($landUseData, 'area'));
            @endphp

            <section class="py-8 md:py-12 lg:py-16 bg-gradient-to-br from-white to-green-50">
                <div class="container mx-auto px-4 md:px-6">
                    {{-- Header --}}
                    <div class="flex flex-col mb-6 md:mb-8">
                        <div class="flex items-center gap-3 md:gap-4">
                            <i class="fas fa-layer-group text-2xl md:text-3xl text-green-600"></i>
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Tata Guna Tanah</h2>
                        </div>
                        <div class="h-1 w-16 md:w-24 bg-blue-500 rounded mt-2"></div>
                    </div>

                    {{-- Cards Grid --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                        @foreach ($landUseData as $item)
                            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1"
                                x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
                                <div class="p-4 md:p-6">
                                    <div class="flex items-center mb-3 md:mb-4">
                                        <div class="w-12 md:w-14">
                                            <i class="fas {{ $item['icon'] }} text-2xl md:text-3xl text-green-600"
                                                :class="{ 'animate-bounce': hover }"></i>
                                        </div>
                                        <h3 class="text-lg md:text-xl font-semibold text-gray-800 flex-1">
                                            {{ $item['category'] }}
                                        </h3>
                                    </div>
                                    <div class="flex items-baseline">
                                        <p class="text-2xl md:text-3xl font-bold text-green-600">
                                            {{ number_format($item['area'], 3, ',', '.') }}
                                        </p>
                                        <span class="ml-1 text-lg md:text-xl font-medium text-green-600">ha</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Total Area Summary --}}
                    <div class="mt-8 md:mt-12 text-center bg-white rounded-xl shadow-md p-6 max-w-2xl mx-auto">
                        <p class="text-xl md:text-2xl font-semibold text-gray-800">Total Luas Wilayah:</p>
                        <div class="flex items-baseline justify-center mt-2">
                            <p class="text-3xl md:text-4xl font-bold text-green-600">
                                {{ number_format($totalArea, 3, ',', '.') }}
                            </p>
                            <span class="ml-1 text-xl md:text-2xl font-medium text-green-600">ha</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Topografi Section -->
            <section class="w-full px-4 md:px-6 lg:px-8 mb-12">
                <div class="flex flex-col mb-8">
                    <div class="flex items-center gap-4">
                        <i class="fas fa-mountain text-2xl md:text-3xl text-green-600"></i>
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Topografi</h2>
                    </div>
                    <div class="h-1 w-16 md:w-24 bg-blue-500 rounded mt-2"></div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6 lg:gap-8">
                    <!-- Karakteristik Topografi -->
                    <div
                        class="bg-gradient-to-br from-white to-gray-50 p-4 sm:p-6 md:p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center mb-4 md:mb-6">
                            <i class="fas fa-layer-group text-xl md:text-2xl text-green-600 mr-3 md:mr-4"></i>
                            <h3 class="text-xl md:text-2xl font-bold text-gray-800">Karakteristik Topografi</h3>
                        </div>
                        <div class="space-y-3 md:space-y-4">
                            <div
                                class="flex flex-col sm:flex-row items-start sm:items-center p-3 bg-white rounded-lg hover:bg-blue-50 transition-colors">
                                <i class="fas fa-mountain w-8 text-blue-500 mb-2 sm:mb-0"></i>
                                <span class="font-semibold w-full sm:w-32 mb-1 sm:mb-0">Bentang Wilayah</span>
                                <span class="text-gray-700">Berbukit (Perbukitan/Pegunungan)</span>
                            </div>
                            <div
                                class="flex flex-col sm:flex-row items-start sm:items-center p-3 bg-white rounded-lg hover:bg-blue-50 transition-colors">
                                <i class="fas fa-fill-drip w-8 text-blue-500 mb-2 sm:mb-0"></i>
                                <span class="font-semibold w-full sm:w-32 mb-1 sm:mb-0">Warna Tanah</span>
                                <span class="text-gray-700">Cokelat</span>
                            </div>
                            <div
                                class="flex flex-col sm:flex-row items-start sm:items-center p-3 bg-white rounded-lg hover:bg-blue-50 transition-colors">
                                <i class="fas fa-seedling w-8 text-blue-500 mb-2 sm:mb-0"></i>
                                <span class="font-semibold w-full sm:w-32 mb-1 sm:mb-0">Tekstur Tanah</span>
                                <span class="text-gray-700">Gembur dan Subur</span>
                            </div>
                        </div>
                    </div>

                    <!-- Orbitrasi/Jarak -->
                    <div
                        class="bg-gradient-to-br from-white to-gray-50 p-4 sm:p-6 md:p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center mb-4 md:mb-6">
                            <i class="fas fa-route text-xl md:text-2xl text-green-600 mr-3 md:mr-4"></i>
                            <h3 class="text-xl md:text-2xl font-bold text-gray-800">Orbitrasi (Jarak)</h3>
                        </div>
                        <div class="space-y-3 md:space-y-4">
                            <div
                                class="flex flex-col sm:flex-row items-start sm:items-center p-3 bg-white rounded-lg hover:bg-blue-50 transition-colors">
                                <i class="fas fa-building w-8 text-blue-500 mb-2 sm:mb-0"></i>
                                <span class="font-semibold w-full sm:w-48 mb-1 sm:mb-0">Jarak ke Kecamatan</span>
                                <span class="text-gray-700">3 Km</span>
                            </div>
                            <div
                                class="flex flex-col sm:flex-row items-start sm:items-center p-3 bg-white rounded-lg hover:bg-blue-50 transition-colors">
                                <i class="fas fa-city w-8 text-blue-500 mb-2 sm:mb-0"></i>
                                <span class="font-semibold w-full sm:w-48 mb-1 sm:mb-0">Jarak ke Kota Batu</span>
                                <span class="text-gray-700">50 Km</span>
                            </div>
                            <div
                                class="flex flex-col sm:flex-row items-start sm:items-center p-3 bg-white rounded-lg hover:bg-blue-50 transition-colors">
                                <i class="fas fa-map-marked-alt w-8 text-blue-500 mb-2 sm:mb-0"></i>
                                <span class="font-semibold w-full sm:w-48 mb-1 sm:mb-0">Jarak ke Provinsi</span>
                                <span class="text-gray-700">113 Km</span>
                            </div>
                            <div
                                class="flex flex-col sm:flex-row items-start sm:items-center p-3 bg-white rounded-lg hover:bg-blue-50 transition-colors">
                                <i class="fas fa-bus w-8 text-blue-500 mb-2 sm:mb-0"></i>
                                <span class="font-semibold w-full sm:w-48 mb-1 sm:mb-0">Transportasi Umum</span>
                                <span class="text-gray-700">Mikrolet</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Demografi Section -->
            <section class="px-4 md:px-6 lg:px-8 mb-8 md:mb-12">
                {{-- Header --}}
                <div class="flex flex-col mb-6 md:mb-8">
                    <div class="flex items-center gap-3 md:gap-4">
                        <i class="fas fa-users text-2xl md:text-3xl text-green-600"></i>
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Demografi</h2>
                    </div>
                    <div class="h-1 w-16 md:w-24 bg-blue-500 rounded mt-2"></div>
                </div>

                {{-- Main Content Card --}}
                <div
                    class="bg-gradient-to-br from-white to-blue-50 p-4 md:p-6 lg:p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex flex-col lg:flex-row gap-6 md:gap-8">
                        {{-- Content Section --}}
                        <div class="space-y-4 md:space-y-6">
                            {{-- Description --}}
                            <p class="text-sm md:text-base text-gray-700 leading-relaxed">
                                Berdasarkan data administrasi pemerintah Desa tahun 2023, jumlah penduduk Desa Gunungsari
                                adalah
                                terdiri dari 2.264 KK, dengan jumlah total 7.240 Jiwa, dengan Rincian 3.649 Laki-laki dan
                                3.591
                                perempuan. Berdasarkan data kependudukan dapat dilihat bahwa 70% penduduk Desa Bumiaji masih
                                berusia produktif sehingga ini menjadi modal berharga bagi peningkatan pembangunan di Desa.
                            </p>

                            {{-- Statistics Grid --}}
                            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-2 xl:grid-cols-4 gap-3 md:gap-4">
                                @php
                                    $stats = [
                                        ['label' => 'Total KK', 'value' => '2,264'],
                                        ['label' => 'Total Penduduk', 'value' => '7,240'],
                                        ['label' => 'Laki-laki', 'value' => '3,649'],
                                        ['label' => 'Perempuan', 'value' => '3,591'],
                                    ];
                                @endphp

                                @foreach ($stats as $stat)
                                    <div
                                        class="bg-white p-3 md:p-4 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5">
                                        <p class="text-xs md:text-sm text-gray-600">{{ $stat['label'] }}</p>
                                        <p class="text-xl md:text-2xl font-bold text-blue-600">{{ $stat['value'] }}</p>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Productive Age Indicator --}}
                            <div
                                class="bg-white p-3 md:p-4 rounded-lg shadow-sm hover:shadow-md transition-all duration-300">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm md:text-base text-gray-600">Penduduk Usia Produktif</span>
                                    <span class="text-sm md:text-base font-bold text-green-600">70%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2 md:h-3">
                                    <div class="bg-blue-600 h-2 md:h-3 rounded-full transition-all duration-1000"
                                        style="width: 70%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            @php
                $populationData = [
                    ['dusun' => 'Pagergunung', 'male' => 957, 'female' => 920, 'total' => 1877],
                    ['dusun' => 'Kapru', 'male' => 1226, 'female' => 1250, 'total' => 2476],
                    ['dusun' => 'Brumbung', 'male' => 333, 'female' => 342, 'total' => 675],
                    ['dusun' => 'Jantur', 'male' => 699, 'female' => 648, 'total' => 1347],
                    ['dusun' => 'Brau', 'male' => 257, 'female' => 237, 'total' => 494],
                ];

                $marriageData = [
                    [
                        'dusun' => 'Pagergunung',
                        'single' => 711,
                        'divorced_alive' => 54,
                        'divorced_dead' => 130,
                        'married' => 982,
                        'total' => 1877,
                    ],
                    [
                        'dusun' => 'Kapru',
                        'single' => 905,
                        'divorced_alive' => 45,
                        'divorced_dead' => 182,
                        'married' => 1344,
                        'total' => 2476,
                    ],
                    [
                        'dusun' => 'Brumbung',
                        'single' => 214,
                        'divorced_alive' => 11,
                        'divorced_dead' => 52,
                        'married' => 398,
                        'total' => 675,
                    ],
                    [
                        'dusun' => 'Jantur',
                        'single' => 511,
                        'divorced_alive' => 24,
                        'divorced_dead' => 73,
                        'married' => 739,
                        'total' => 1347,
                    ],
                    [
                        'dusun' => 'Brau',
                        'single' => 169,
                        'divorced_alive' => 6,
                        'divorced_dead' => 25,
                        'married' => 294,
                        'total' => 494,
                    ],
                ];

                $religionData = [
                    [
                        'dusun' => 'Pagergunung',
                        'islam' => 1869,
                        'catholic' => 4,
                        'christian' => 4,
                        'buddha' => 0,
                        'hindu' => 0,
                        'konghucu' => 0,
                        'total' => 1877,
                    ],
                    [
                        'dusun' => 'Kapru',
                        'islam' => 2472,
                        'catholic' => 0,
                        'christian' => 4,
                        'buddha' => 0,
                        'hindu' => 0,
                        'konghucu' => 0,
                        'total' => 2476,
                    ],
                    [
                        'dusun' => 'Brumbung',
                        'islam' => 669,
                        'catholic' => 0,
                        'christian' => 6,
                        'buddha' => 0,
                        'hindu' => 0,
                        'konghucu' => 0,
                        'total' => 675,
                    ],
                    [
                        'dusun' => 'Jantur',
                        'islam' => 1347,
                        'catholic' => 0,
                        'christian' => 0,
                        'buddha' => 0,
                        'hindu' => 0,
                        'konghucu' => 0,
                        'total' => 1347,
                    ],
                    [
                        'dusun' => 'Brau',
                        'islam' => 494,
                        'catholic' => 0,
                        'christian' => 0,
                        'buddha' => 0,
                        'hindu' => 0,
                        'konghucu' => 0,
                        'total' => 494,
                    ],
                ];

                $educationData = [
                    ['level' => 'Tidak / Belum Sekolah', 'total' => 1101],
                    ['level' => 'Belum Tamat SD / Sederajat', 'total' => 932],
                    ['level' => 'SD / Sederajat', 'total' => 2572],
                    ['level' => 'SMP / Sederajat', 'total' => 1200],
                    ['level' => 'SMA / Sederajat', 'total' => 1193],
                    ['level' => 'D1 / Sederajat', 'total' => 42],
                    ['level' => 'D2 / Sederajat', 'total' => 29],
                    ['level' => 'S1 / Sederajat', 'total' => 160],
                    ['level' => 'S2 / Sederajat', 'total' => 10],
                    ['level' => 'S3 / Sederajat', 'total' => 1],
                ];
            @endphp

            <section class="px-4 md:px-6 lg:px-8 mb-12" x-data="{ activeTab: 'population' }">
                {{-- Header --}}
                <div class="flex flex-col mb-8">
                    <div class="flex items-center gap-4">
                        <i class="fas fa-table text-3xl md:text-4xl text-green-600"></i>
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Data Kependudukan</h2>
                    </div>
                    <div class="h-1 w-32 bg-green-600 rounded mt-3"></div>
                </div>

                {{-- Tabs --}}
                <div class="flex flex-wrap gap-3 mb-8">
                    @php
                        $tabs = [
                            'population' => ['icon' => 'fas fa-users', 'text' => 'Jumlah Penduduk'],
                            'marriage' => ['icon' => 'fas fa-ring', 'text' => 'Status Perkawinan'],
                            'religion' => ['icon' => 'fas fa-mosque', 'text' => 'Agama'],
                            'education' => ['icon' => 'fas fa-graduation-cap', 'text' => 'Pendidikan'],
                        ];
                    @endphp

                    @foreach ($tabs as $key => $tab)
                        <button @click="activeTab = '{{ $key }}'"
                            :class="{ 'bg-green-600 text-white ring-2 ring-green-300': activeTab === '{{ $key }}', 'bg-white text-gray-700 hover:bg-gray-50': activeTab !== '{{ $key }}' }"
                            class="px-5 py-2.5 rounded-lg font-medium shadow-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <div class="flex items-center gap-2">
                                <i class="{{ $tab['icon'] }} w-5 h-5"></i>
                                <span>{{ $tab['text'] }}</span>
                            </div>
                        </button>
                    @endforeach
                </div>

                {{-- Tables --}}
                <div class="bg-white rounded-xl shadow-lg p-4 md:p-6 overflow-x-auto">
                    {{-- Population Table --}}
                    <table class="w-full" x-show.transition.opacity="activeTab === 'population'">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Dusun</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Laki-laki</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Perempuan</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($populationData as $data)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-sm text-gray-900">{{ $data['dusun'] }}</td>
                                    <td class="px-4 py-3 text-sm text-center text-gray-900">
                                        {{ number_format($data['male']) }}</td>
                                    <td class="px-4 py-3 text-sm text-center text-gray-900">
                                        {{ number_format($data['female']) }}</td>
                                    <td class="px-4 py-3 text-sm text-center font-medium text-green-600">
                                        {{ number_format($data['total']) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Total</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-900">
                                    {{ number_format(array_sum(array_column($populationData, 'male'))) }}
                                </th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-900">
                                    {{ number_format(array_sum(array_column($populationData, 'female'))) }}
                                </th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-green-600">
                                    {{ number_format(array_sum(array_column($populationData, 'total'))) }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>

                    {{-- Marriage Table --}}
                    <table class="w-full" x-show.transition.opacity="activeTab === 'marriage'">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Dusun</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Belum Kawin</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Cerai Hidup</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Cerai Mati</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Kawin</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($marriageData as $data)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-sm text-gray-900">{{ $data['dusun'] }}</td>
                                    <td class="px-4 py-3 text-sm text-center text-gray-900">
                                        {{ number_format($data['single']) }}</td>
                                    <td class="px-4 py-3 text-sm text-center text-gray-900">
                                        {{ number_format($data['divorced_alive']) }}</td>
                                    <td class="px-4 py-3 text-sm text-center text-gray-900">
                                        {{ number_format($data['divorced_dead']) }}</td>
                                    <td class="px-4 py-3 text-sm text-center text-gray-900">
                                        {{ number_format($data['married']) }}</td>
                                    <td class="px-4 py-3 text-sm text-center font-medium text-green-600">
                                        {{ number_format($data['total']) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Total</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-900">
                                    {{ number_format(array_sum(array_column($marriageData, 'single'))) }}
                                </th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-900">
                                    {{ number_format(array_sum(array_column($marriageData, 'divorced_alive'))) }}
                                </th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-900">
                                    {{ number_format(array_sum(array_column($marriageData, 'divorced_dead'))) }}
                                </th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-900">
                                    {{ number_format(array_sum(array_column($marriageData, 'married'))) }}
                                </th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-green-600">
                                    {{ number_format(array_sum(array_column($marriageData, 'total'))) }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>

                    {{-- Religion Table --}}
                    <table class="w-full" x-show.transition.opacity="activeTab === 'religion'">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Dusun</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Islam</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Katolik</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Kristen</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Buddha</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Hindu</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Konghucu</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($religionData as $data)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-sm text-gray-900">{{ $data['dusun'] }}</td>
                                    <td class="px-4 py-3 text-sm text-center text-gray-900">
                                        {{ number_format($data['islam']) }}</td>
                                    <td class="px-4 py-3 text-sm text-center text-gray-900">
                                        {{ number_format($data['catholic']) }}</td>
                                    <td class="px-4 py-3 text-sm text-center text-gray-900">
                                        {{ number_format($data['christian']) }}</td>
                                    <td class="px-4 py-3 text-sm text-center text-gray-900">
                                        {{ number_format($data['buddha']) }}</td>
                                    <td class="px-4 py-3 text-sm text-center text-gray-900">
                                        {{ number_format($data['hindu']) }}</td>
                                    <td class="px-4 py-3 text-sm text-center text-gray-900">
                                        {{ number_format($data['konghucu']) }}</td>
                                    <td class="px-4 py-3 text-sm text-center font-medium text-green-600">
                                        {{ number_format($data['total']) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Total</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-900">
                                    {{ number_format(array_sum(array_column($religionData, 'islam'))) }}
                                </th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-900">
                                    {{ number_format(array_sum(array_column($religionData, 'catholic'))) }}
                                </th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-900">
                                    {{ number_format(array_sum(array_column($religionData, 'christian'))) }}
                                </th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-900">
                                    {{ number_format(array_sum(array_column($religionData, 'buddha'))) }}
                                </th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-900">
                                    {{ number_format(array_sum(array_column($religionData, 'hindu'))) }}
                                </th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-900">
                                    {{ number_format(array_sum(array_column($religionData, 'konghucu'))) }}
                                </th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-green-600">
                                    {{ number_format(array_sum(array_column($religionData, 'total'))) }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>

                    {{-- Education Table --}}
                    <table class="w-full" x-show.transition.opacity="activeTab === 'education'">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Tingkat Pendidikan</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($educationData as $data)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-sm text-gray-900">{{ $data['level'] }}</td>
                                    <td class="px-4 py-3 text-sm text-center font-medium text-green-600">
                                        {{ number_format($data['total']) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Total</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-green-600">
                                    {{ number_format(array_sum(array_column($educationData, 'total'))) }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </section>
        </div>
    </div>
@endsection
