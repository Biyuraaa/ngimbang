@extends('layouts.guest')
@section('title', 'Register - Desa Gunung Sari')

@section('content')
    <div class="min-h-screen py-12 md:py-24 flex items-center justify-center relative overflow-hidden bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('assets/images/nature.jpeg') }}');">

        <!-- Overlay with gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-green-900/60 to-emerald-600/60 backdrop-blur-sm"></div>

        <!-- Animated leaves - Hidden on mobile for better performance -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden hidden md:block">
            @for ($i = 1; $i <= 10; $i++)
                <i
                    class="fas fa-leaf absolute animate-float-{{ $i }} text-2xl 
           {{ $i % 3 == 0 ? 'text-green-400/50' : ($i % 3 == 1 ? 'text-emerald-400/50' : 'text-lime-400/50') }}"></i>
            @endfor
        </div>

        <!-- Main card -->
        <div
            class="relative backdrop-blur-md bg-white/90 shadow-2xl rounded-2xl md:rounded-3xl p-4 md:p-8 w-full mx-4 md:max-w-md border border-white/20 ">
            <div class="text-center mb-6 md:mb-8">
                <div class="flex justify-center mb-4 md:mb-6">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo Desa"
                        class="w-16 h-16 md:w-24 md:h-24 animate-pulse-slow drop-shadow-lg">
                </div>
                <h1 class="text-3xl md:text-4xl font-bold text-green-800 mb-2 animate-fade-in-down">Daftar Akun</h1>
                <p class="text-sm md:text-base text-green-600 animate-fade-in-up">Buat akun untuk mengakses layanan Desa
                    Gunung Sari</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4 md:space-y-6">
                @csrf

                <div class="grid grid-cols-1 gap-4 md:gap-6">
                    <!-- Nama Lengkap -->
                    <div class="space-y-1 md:space-y-2">
                        <label for="name" class="block text-green-800 text-sm md:text-base font-medium">Nama
                            Lengkap</label>
                        <div class="relative group">
                            <span
                                class="absolute inset-y-0 left-3 flex items-center text-green-600 group-focus-within:text-green-800 transition-colors duration-200">
                                <i class="fas fa-user text-sm md:text-base"></i>
                            </span>
                            <input id="name" type="text" name="name" required autofocus
                                class="w-full pl-10 pr-4 py-2.5 md:py-3 text-sm md:text-base rounded-xl border-2 border-green-200/50 focus:ring-4 focus:ring-green-500/20 focus:border-green-500 bg-white/80 backdrop-blur-sm transition-all duration-300 group-hover:bg-white/95">
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="space-y-1 md:space-y-2">
                        <label for="email" class="block text-green-800 text-sm md:text-base font-medium">Email</label>
                        <div class="relative group">
                            <span
                                class="absolute inset-y-0 left-3 flex items-center text-green-600 group-focus-within:text-green-800 transition-colors duration-200">
                                <i class="fas fa-envelope text-sm md:text-base"></i>
                            </span>
                            <input id="email" type="email" name="email" required
                                class="w-full pl-10 pr-4 py-2.5 md:py-3 text-sm md:text-base rounded-xl border-2 border-green-200/50 focus:ring-4 focus:ring-green-500/20 focus:border-green-500 bg-white/80 backdrop-blur-sm transition-all duration-300 group-hover:bg-white/95">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="space-y-1 md:space-y-2">
                        <label for="password" class="block text-green-800 text-sm md:text-base font-medium">Password</label>
                        <div class="relative group">
                            <span
                                class="absolute inset-y-0 left-3 flex items-center text-green-600 group-focus-within:text-green-800 transition-colors duration-200">
                                <i class="fas fa-lock text-sm md:text-base"></i>
                            </span>
                            <input id="password" type="password" name="password" required
                                class="w-full pl-10 pr-4 py-2.5 md:py-3 text-sm md:text-base rounded-xl border-2 border-green-200/50 focus:ring-4 focus:ring-green-500/20 focus:border-green-500 bg-white/80 backdrop-blur-sm transition-all duration-300 group-hover:bg-white/95">
                        </div>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="space-y-1 md:space-y-2">
                        <label for="password_confirmation"
                            class="block text-green-800 text-sm md:text-base font-medium">Konfirmasi Password</label>
                        <div class="relative group">
                            <span
                                class="absolute inset-y-0 left-3 flex items-center text-green-600 group-focus-within:text-green-800 transition-colors duration-200">
                                <i class="fas fa-lock text-sm md:text-base"></i>
                            </span>
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                class="w-full pl-10 pr-4 py-2.5 md:py-3 text-sm md:text-base rounded-xl border-2 border-green-200/50 focus:ring-4 focus:ring-green-500/20 focus:border-green-500 bg-white/80 backdrop-blur-sm transition-all duration-300 group-hover:bg-white/95">
                        </div>
                    </div>
                </div>

                <!-- Terms -->
                <div class="flex items-center mt-4">
                    <input id="terms" type="checkbox" name="terms" required
                        class="w-4 h-4 text-emerald-600 border-emerald-300 rounded focus:ring-emerald-500 transition-all duration-300 hover:scale-110">
                    <label for="terms"
                        class="ml-2 text-xs md:text-sm text-emerald-700 hover:text-emerald-900 transition-all duration-300">
                        Saya setuju dengan <a href="#"
                            class="font-bold text-emerald-800 hover:text-emerald-900 transition-all duration-300 hover:underline">Syarat
                            dan Ketentuan</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 text-white font-semibold py-3 md:py-4 text-sm md:text-base rounded-xl transition-all duration-500 transform hover:scale-[1.02] active:scale-[0.98] hover:shadow-lg hover:shadow-emerald-500/25 focus:outline-none focus:ring-4 focus:ring-emerald-500/30">
                    Daftar
                </button>
            </form>

            <div class="text-center mt-6 md:mt-8">
                <p class="text-xs md:text-sm text-green-700">
                    Sudah memiliki akun?
                    <a href="{{ route('login') }}"
                        class="font-bold text-green-800 hover:text-green-900 transition duration-300 hover:underline">
                        Masuk
                    </a>
                </p>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg);
            }

            25% {
                transform: translate(10px, -10px) rotate(90deg);
            }

            50% {
                transform: translate(20px, -20px) rotate(180deg);
            }

            75% {
                transform: translate(10px, -10px) rotate(270deg);
            }
        }

        @keyframes pulse-slow {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.8;
                transform: scale(0.95);
            }
        }

        @keyframes fade-in-down {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fade-in-up {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-float-1 {
            animation: float 8s infinite;
            left: 5%;
            top: 10%;
        }

        .animate-float-2 {
            animation: float 9s infinite;
            left: 15%;
            top: 60%;
        }

        .animate-float-3 {
            animation: float 10s infinite;
            left: 25%;
            top: 30%;
        }

        .animate-float-4 {
            animation: float 11s infinite;
            left: 40%;
            top: 70%;
        }

        .animate-float-5 {
            animation: float 12s infinite;
            left: 55%;
            top: 20%;
        }

        .animate-float-6 {
            animation: float 13s infinite;
            left: 70%;
            top: 50%;
        }

        .animate-float-7 {
            animation: float 14s infinite;
            left: 80%;
            top: 25%;
        }

        .animate-float-8 {
            animation: float 15s infinite;
            left: 90%;
            top: 65%;
        }

        .animate-float-9 {
            animation: float 16s infinite;
            left: 45%;
            top: 85%;
        }

        .animate-float-10 {
            animation: float 17s infinite;
            left: 65%;
            top: 75%;
        }

        .animate-pulse-slow {
            animation: pulse-slow 3s infinite;
        }

        .animate-fade-in-down {
            animation: fade-in-down 0.5s ease-out;
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.5s ease-out;
        }
    </style>
@endpush
