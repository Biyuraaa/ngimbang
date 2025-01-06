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
                            <span class="text-emerald-800 font-medium">Profile</span>
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
                            <i class="fas fa-user text-white text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Profil Saya</h2>
                            <p class="text-sm text-emerald-600">
                                Lihat dan perbarui informasi profil Anda di sini.
                            </p>
                        </div>
                    </div>

                    <a href="{{ route('profile.edit') }}"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 rounded-xl text-sm font-medium text-white
                    bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700
                    transition-all duration-300 hover:shadow-lg hover:shadow-emerald-200 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Profile
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg border-0 overflow-hidden">
                <div class="p-6 sm:p-8">
                    <div class="flex flex-col md:flex-row">
                        <div class="md:w-1/3 mb-6 md:mb-0">
                            <div class="flex justify-center">
                                <div class="relative">
                                    @if (Auth::user()->avatar)
                                        <img src="{{ asset('storage/images/users/' . Auth::user()->avatar) }}"
                                            alt="{{ Auth::user()->name }}"
                                            class="rounded-full w-32 h-32 object-cover border-4 border-emerald-200">
                                    @else
                                        <div
                                            class="rounded-full w-32 h-32 bg-emerald-100 flex items-center justify-center border-4 border-emerald-200">
                                            <span
                                                class="text-4xl text-emerald-500">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="md:w-2/3 md:pl-8">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 mb-1">Nama Lengkap</h3>
                                    <p class="text-lg font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 mb-1">Email</h3>
                                    <p class="text-lg font-semibold text-gray-900">{{ Auth::user()->email }}</p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 mb-1">Nomor Telepon</h3>
                                    <p class="text-lg font-semibold text-gray-900">
                                        {{ Auth::user()->phone ?? 'Belum diatur' }}</p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 mb-1">Status Email</h3>
                                    <p class="text-lg font-semibold text-gray-900">
                                        @if (Auth::user()->email_verified_at)
                                            <span class="text-green-600">Terverifikasi</span>
                                        @else
                                            <span class="text-red-600">Belum Terverifikasi</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="mt-8 bg-white rounded-xl shadow-lg border-0 overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Alamat</h3>
                    <p class="text-gray-700">
                        {{ Auth::user()->address ?? 'Alamat belum diatur' }}
                    </p>
                </div>
            </div>

            <!-- Account Information -->
            <div class="mt-8 bg-white rounded-xl shadow-lg border-0 overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Akun</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-1">Tanggal Bergabung</h4>
                            <p class="text-base text-gray-900">{{ Auth::user()->created_at->format('d F Y') }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-1">Terakhir Diperbarui</h4>
                            <p class="text-base text-gray-900">{{ Auth::user()->updated_at->format('d F Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
