@extends('layouts.app')
@section('content')
    <div class="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-emerald-50 py-4 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
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
                            <i class="fas fa-chevron-right text-emerald-300 mx-2"></i>
                            <span class="text-emerald-800 font-medium">Galeri</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Header Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-4 sm:p-6 mb-4 sm:mb-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                    <div class="flex items-center space-x-4">
                        <div
                            class="bg-gradient-to-br from-emerald-500 to-green-600 p-3 rounded-xl shadow-lg shadow-emerald-200">
                            <i class="fas fa-images text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Daftar Galeri</h2>
                            <p class="text-sm text-emerald-600">Kelola Galeri di Kecamatan Ngimbang</p>
                        </div>
                    </div>

                    <a href="{{ route('galleries.create') }}"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 rounded-xl text-sm font-medium text-white
                    bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700
                    transition-all duration-300 hover:shadow-lg hover:shadow-emerald-200 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Galeri
                    </a>
                </div>
            </div>

            <!-- Table Section -->
            <div class="bg-white rounded-xl shadow-lg border-0 overflow-hidden">
                {{-- Card Header --}}
                <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-6 py-4">
                    <h2 class="text-white font-semibold text-xl">Daftar Galeri</h2>
                </div>

                {{-- Table Container --}}
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-emerald-50">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-emerald-700">
                                    Gambar
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-emerald-700">
                                    Nama
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-emerald-700">
                                    Deskripsi
                                </th>
                                <th class="px-6 py-4 text-right text-sm font-semibold text-emerald-700">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-emerald-100">
                            @forelse($galleries as $gallery)
                                <tr class="hover:bg-emerald-50/60 transition-all duration-200">
                                    <td class="px-6 py-4">
                                        <img src="{{ $gallery->image
                                            ? asset('storage/images/galleries/' . $gallery->image)
                                            : asset('assets/images/no_thumbnail.jpg') }}"
                                            alt="{{ $gallery->name }}" class="w-20 h-20 object-cover rounded-lg">
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-medium text-gray-900">{{ $gallery->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center text-gray-600">
                                            <span class="text-sm">{{ Str::limit($gallery->description, 100) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-3 py-2">
                                        <div class="flex justify-end items-center gap-2">
                                            <a href="{{ route('galleries.edit', $gallery) }}"
                                                class="inline-flex items-center px-2 py-1 text-sm rounded-lg text-orange-700 bg-orange-50 border border-orange-200 hover:bg-orange-100 transition-colors duration-200">
                                                <i class="fas fa-edit mr-1.5"></i>
                                                Edit
                                            </a>
                                            <form action="{{ route('galleries.destroy', $gallery) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus galeri ini?');"
                                                    class="inline-flex items-center px-2 py-1 text-sm rounded-lg text-red-700 bg-red-50 border border-red-200 hover:bg-red-100 transition-colors duration-200">
                                                    <i class="fas fa-trash mr-1.5"></i>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="bg-emerald-100 rounded-full p-4 mb-4">
                                                <i class="fas fa-images text-emerald-600 text-xl"></i>
                                            </div>
                                            <h3 class="text-emerald-800 font-medium mb-1">Belum ada data galeri</h3>
                                            <p class="text-emerald-600 text-sm">Silakan tambahkan galeri baru</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($galleries->hasPages())
                    <div class="px-6 py-4 border-t border-emerald-100">
                        {{ $galleries->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
