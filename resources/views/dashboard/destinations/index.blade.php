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
                            <i class="fas fa-chevron-right text-emerald-300 mx-2"></i>
                            <span class="text-emerald-800 font-medium">Wisata</span>
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
                            <i class="fas fa-mountain text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Daftar Wisata</h2>
                            <p class="text-sm text-emerald-600">Kelola destinasi wisata di Desa Gunung Sari</p>
                        </div>
                    </div>

                    <a href="{{ route('destinations.create') }}"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 rounded-xl text-sm font-medium text-white
                    bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700
                    transition-all duration-300 hover:shadow-lg hover:shadow-emerald-200 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Wisata
                    </a>
                </div>
            </div>

            <!--   Section -->
            <div class="bg-white rounded-xl shadow-lg border-0 overflow-hidden">
                {{-- Card Header --}}
                <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-6 py-4">
                    <h2 class="text-white font-semibold text-xl">Daftar Destinasi Wisata</h2>
                </div>

                {{-- Table Container --}}
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-emerald-50">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-emerald-700">
                                    Nama Wisata
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-emerald-700">
                                    Alamat
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-emerald-700">
                                    Jam Operasional
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-emerald-700">
                                    Status
                                </th>
                                @if (Auth::user()->hasRole('destination-owner') || Auth::user()->hasRole('super-admin'))
                                    <th class="px-6 py-4 text-right text-sm font-semibold text-emerald-700">
                                        Aksi
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-emerald-100">
                            @forelse($destinations as $destination)
                                <tr class="hover:bg-emerald-50/60 transition-all duration-200">
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-medium text-gray-900">{{ $destination->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-map-marker-alt text-emerald-500 mr-2"></i>
                                            <span class="text-sm text-gray-600">
                                                {{ $destination->address ? \Illuminate\Support\Str::limit($destination->address, 50) : 'Alamat belum ditambahkan' }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-clock text-emerald-500 mr-2"></i>
                                            <span class="text-sm">
                                                {{ \Carbon\Carbon::parse($destination->open_at)->format('H:i') }} -
                                                {{ \Carbon\Carbon::parse($destination->close_at)->format('H:i') }} WIB
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            @if ($destination->status)
                                                <span @class([
                                                    'px-2.5 py-0.5 text-xs font-medium rounded-full',
                                                    'bg-green-100 text-green-700' => $destination->status === 'active',
                                                    'bg-yellow-100 text-yellow-700' => $destination->status === 'pending',
                                                    'bg-red-100 text-red-700' => $destination->status === 'inactive',
                                                ])>
                                                    <i @class([
                                                        'fas fa-circle text-xs mr-1',
                                                        'text-green-500' => $destination->status === 'active',
                                                        'text-yellow-500' => $destination->status === 'pending',
                                                        'text-red-500' => $destination->status === 'inactive',
                                                    ])></i>
                                                    {{ ucfirst($destination->status ?? 'Status belum diatur') }}
                                                </span>
                                            @else
                                                <span
                                                    class="px-2.5 py-0.5 text-xs font-medium rounded-full bg-gray-100 text-gray-700">
                                                    <i class="fas fa-circle text-gray-500 text-xs mr-1"></i>
                                                    Status belum diatur
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    @if (Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('destination-owner'))
                                        <td class="px-3 py-2">
                                            <div class="flex justify-end items-center gap-2">
                                                <a href="{{ route('destinations.show', $destination) }}"
                                                    class="inline-flex items-center px-2 py-1 text-sm rounded-lg text-emerald-700 bg-emerald-50 border border-emerald-200 hover:bg-emerald-100 transition-colors duration-200">
                                                    <i class="fas fa-eye mr-1.5"></i>
                                                    Lihat
                                                </a>
                                                @if (Auth::user()->hasRole('destination-owner'))
                                                    <a href="{{ route('destinations.edit', $destination) }}"
                                                        class="inline-flex items-center px-2 py-1 text-sm rounded-lg text-orange-700 bg-orange-50 border border-orange-200 hover:bg-orange-100 transition-colors duration-200">
                                                        <i class="fas fa-edit mr-1.5"></i>
                                                        Edit
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ Auth::user()->hasRole('super-admin') ? '5' : '4' }}" class="px-6 py-8">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="bg-emerald-100 rounded-full p-4 mb-4">
                                                <i class="fas fa-mountain text-emerald-600 text-xl"></i>
                                            </div>
                                            <h3 class="text-emerald-800 font-medium mb-1">Belum ada data wisata</h3>
                                            <p class="text-emerald-600 text-sm">Silakan tambahkan destinasi wisata baru</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($destinations->hasPages())
                    <div class="px-6 py-4 border-t border-emerald-100">
                        {{ $destinations->links() }}
                    </div>
                @endif
            </div>


        </div>
    </div>
@endsection
