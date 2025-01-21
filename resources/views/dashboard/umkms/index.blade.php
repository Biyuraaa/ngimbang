@extends('layouts.app')
@section('content')
    <div class="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-emerald-50 py-4 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!--  Breadcrumb -->
            <nav class="flex mb-4 sm:mb-8 overflow-x-auto" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 whitespace-nowrap">
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-home text-emerald-600 mr-2"></i>
                            <a href="{{ route('dashboard') }}"
                                class="text-emerald-600 hover:text-emerald-800 font-medium transition-colors duration-200">
                                Dashboard
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-emerald-300 mr-2"></i>
                            <span class="text-emerald-800 font-medium">UMKM</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!--  Header Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-4 sm:p-6 mb-4 sm:mb-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                    <div class="flex items-center space-x-4">
                        <div
                            class="bg-gradient-to-br from-emerald-500 to-green-600 p-3 rounded-xl shadow-lg shadow-emerald-200">
                            <i class="fas fa-store text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Daftar UMKM</h2>
                            <p class="text-sm text-emerald-600">Kelola UMKM di Desa Gunung Sari</p>
                        </div>
                    </div>

                    <a href="{{ route('umkms.create') }}"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 rounded-xl text-sm font-medium text-white
                    bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700
                    transition-all duration-300 hover:shadow-lg hover:shadow-emerald-200 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah UMKM
                    </a>
                </div>
            </div>

            <!--  Table Section -->
            <div class="bg-white rounded-xl shadow-lg border-0 overflow-hidden">
                {{-- Card Header --}}
                <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-6 py-4">
                    <h2 class="text-white font-semibold text-xl">Daftar UMKM</h2>
                </div>

                {{-- Table Container --}}
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-emerald-50">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-emerald-700">
                                    Nama UMKM
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-emerald-700">
                                    Alamat
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-emerald-700">
                                    Pemilik
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-emerald-700">
                                    Kontak
                                </th>
                                <th class="px-6 py-4 text-right text-sm font-semibold text-emerald-700">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-emerald-100">
                            @forelse($umkms as $umkm)
                                <tr class="hover:bg-emerald-50/60 transition-all duration-200">
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-medium text-gray-900">{{ $umkm->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center text-gray-600">
                                            <span class="text-sm text-gray-600">
                                                {{ $umkm->address ? \Illuminate\Support\Str::limit($umkm->address, 50) : 'Alamat belum ditambahkan' }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center text-gray-600">
                                            <span class="text-sm">{{ $umkm->owner }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center text-gray-600">
                                            <span class="text-sm">{{ $umkm->phone }}</span>
                                        </div>
                                    </td>
                                    <td class="px-3 py-2">
                                        <div class="flex justify-end items-center gap-2">
                                            <a href="{{ route('umkms.show', $umkm) }}"
                                                class="inline-flex items-center px-2 py-1 text-sm rounded-lg text-emerald-700 bg-emerald-50 border border-emerald-200 hover:bg-emerald-100 transition-colors duration-200">
                                                <i class="fas fa-eye mr-1.5"></i>
                                                Lihat
                                            </a>
                                            <form action="{{ route('umkms.destroy', $umkm) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center px-2 py-1 text-sm rounded-lg text-red-700 bg-red-50 border border-red-200 hover:bg-red-100 transition-colors duration-200"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash-alt mr-1.5"></i>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center px-8 py-16"> <!-- Added colspan and centered -->
                                        <div class="flex flex-col items-center justify-center space-y-6 animate-fadeIn">
                                            <!-- Icon Container with Animation -->
                                            <div class="relative">
                                                <div
                                                    class="absolute inset-0 bg-emerald-200 rounded-full blur-lg opacity-50">
                                                </div>
                                                <div
                                                    class="relative bg-gradient-to-br from-emerald-100 to-emerald-50 rounded-full p-6 shadow-lg transform transition-all duration-300 hover:scale-110">
                                                    <i class="fas fa-store text-emerald-600 text-3xl"></i>
                                                </div>
                                            </div>

                                            <!-- Text Content -->
                                            <div class="text-center space-y-2">
                                                <h3 class="text-xl font-semibold text-emerald-800">Belum ada data UMKM</h3>
                                                <p class="text-emerald-600">Mulai tambahkan UMKM pertama Anda</p>
                                            </div>

                                            <!-- Call to Action Button -->
                                            <a href="{{ route('umkms.create') }}"
                                                class="inline-flex items-center px-6 py-3 bg-emerald-600 text-white rounded-lg shadow-md hover:bg-emerald-700 transition-colors duration-200 space-x-2 group">
                                                <i
                                                    class="fas fa-plus group-hover:rotate-90 transition-transform duration-200"></i>
                                                <span>Tambah UMKM</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($umkms->hasPages())
                    <div class="px-6 py-4 border-t border-emerald-100">
                        {{ $umkms->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
