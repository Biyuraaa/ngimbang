@extends('layouts.guest')

@section('title', 'Visi dan Misi Desa Ngimbang')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-green-50 to-white py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-8 sm:mb-16">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-green-800 mb-3 sm:mb-4">Visi dan Misi</h1>
                <div class="h-1.5 w-24 sm:w-32 bg-green-600 mx-auto rounded-full mb-4 sm:mb-8"></div>
                <p class="text-base sm:text-lg text-green-700 max-w-2xl mx-auto px-4 sm:px-0">
                    Arah dan tujuan pembangunan Kabupaten Lamongan menuju masa depan yang lebih baik
                </p>
            </div>

            <!-- Visi Section -->
            <div class="max-w-7xl mx-auto mb-8 sm:mb-16 px-4 sm:px-6">
                <div
                    class="bg-white rounded-xl sm:rounded-2xl shadow-lg sm:shadow-xl p-6 sm:p-8 transform hover:scale-[1.02] transition-transform duration-300">
                    <div class="flex items-center gap-3 sm:gap-4 mb-4 sm:mb-6">
                        <i class="fas fa-eye text-2xl sm:text-3xl text-green-600"></i>
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Visi</h2>
                    </div>
                    <p class="text-lg sm:text-xl text-gray-700 leading-relaxed italic">
                        "Terwujudnya Kejayaan Lamongan yang Berkeadilan"
                    </p>
                    <div class="mt-4 text-gray-600">
                        <p class="mb-3"><strong>Kejayaan Lamongan:</strong> adalah suatu kondisi terwujudnya Lamongan
                            sebagai kabupaten unggul dan maju, sejahtera lahir batin, terdepan dalam pembangunan
                            infrastruktur, ekonomi dan sumber daya manusia di Jawa Timur</p>
                        <p><strong>Berkeadilan:</strong> adalah suatu kondisi Lamongan yang semakin merata pelaksanaan
                            pembangunan dan kondisi sosial ekonomi masyarakatnya serta semakin menurun kondisi ketimpangan
                            antar wilayah. Berkeadilan juga bermakna keberpihakan untuk melindungi dan membina masyarakat
                            yang secara ekonomi dan sosial yang secara kategori memerlukan perhatian lebih dengan kehadiran
                            Pemerintah Daerah.</p>
                    </div>
                </div>
            </div>

            <!-- Misi Section -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg sm:shadow-xl p-6 sm:p-8">
                    <div class="flex items-center gap-3 sm:gap-4 mb-6 sm:mb-8">
                        <i class="fas fa-list-check text-2xl sm:text-3xl text-green-600"></i>
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Misi</h2>
                    </div>
                    <div class="grid gap-3 sm:gap-4">
                        @php
                            $missions = [
                                [
                                    'icon' => 'fa-chart-line',
                                    'text' =>
                                        'Mewujudkan kemandirian ekonomi daerah dengan mengoptimalkan berbagai potensi sektor unggulan, pengetahuan industri kecil dan menengah/UMKM, pengembangan pariwisata serta mendorong berkembangnya ekonomi kreatif (start up)',
                                ],
                                [
                                    'icon' => 'fa-user-graduate',
                                    'text' =>
                                        'Mencetak sumber daya manusia yang unggul, sehat jasmani dan rohani, produktif, daya saing dan berakhlaqul karimah dalam rangka menyambut revolusi industri 4.0',
                                ],
                                [
                                    'icon' => 'fa-road',
                                    'text' =>
                                        'Membangun infrastruktur yang mantap, merata dan berkeadilan dengan memperhatikan daya dukung serta kelestarian lingkungan',
                                ],
                                [
                                    'icon' => 'fa-hands-holding',
                                    'text' =>
                                        'Menciptakan kehidupan bermasyarakat yang religius, berbudaya, aman, tentram dalam relasi yang seimbang antara berbagai komponen dengan tidak meninggalkan kearifan lokal masyarakat dan stakeholder pembangunan',
                                ],
                                [
                                    'icon' => 'fa-balance-scale',
                                    'text' =>
                                        'Menghadirkan tata kelola pemerintah yang demokratis, transparan, akuntabel, berbasis digital dan bebas korupsi, dengan memberikan ruang yang luas bagi partisipasi masyarakat dalam proses perumusan hingga evaluasi kebijakan',
                                ],
                            ];
                        @endphp

                        @foreach ($missions as $index => $mission)
                            <div
                                class="flex items-start gap-3 sm:gap-4 p-3 sm:p-4 bg-green-50 rounded-lg sm:rounded-xl hover:bg-green-100 transition-colors duration-300">
                                <span class="font-bold text-green-600 mt-1">{{ $index + 1 }}</span>
                                <p class="text-sm sm:text-base text-gray-700">{{ $mission['text'] }}</p>
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
        @media (max-width: 640px) {
            .max-w-7xl {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }

        @media (min-width: 641px) and (max-width: 768px) {
            .max-w-7xl {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
        }

        @media (min-width: 769px) {
            .max-w-7xl {
                padding-left: 2rem;
                padding-right: 2rem;
            }
        }
    </style>
@endpush
