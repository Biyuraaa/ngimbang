@extends('layouts.guest')
@section('title', 'Login - Desa Gunung Sari')

@section('content')
    <div class="min-h-screen py-12 flex items-center justify-center relative overflow-hidden bg-cover bg-center bg-no-repeat bg-fixed"
        style="background-image: url('{{ asset('assets/images/nature.jpeg') }}');">

        <!-- Enhanced overlay with multiple gradients -->
        <div
            class="absolute inset-0 bg-gradient-to-br from-green-900/70 via-emerald-800/60 to-emerald-600/50 backdrop-blur-sm">
        </div>

        <!-- Improved animated leaves with more variety -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            @for ($i = 1; $i <= 15; $i++)
                <i class="fas fa-leaf absolute animate-float-{{ $i }} text-{{ rand(1, 3) }}xl 
                {{ ['text-green-400/40', 'text-emerald-400/40', 'text-lime-400/40', 'text-teal-400/40'][array_rand(['text-green-400/40', 'text-emerald-400/40', 'text-lime-400/40', 'text-teal-400/40'])] }}"
                    style="left: {{ rand(0, 100) }}%; top: {{ rand(-20, 100) }}%; animation-delay: {{ $i * 0.3 }}s;">
                </i>
            @endfor
        </div>

        <!-- Enhanced card design -->
        <div
            class="relative backdrop-blur-md bg-white/95 shadow-2xl rounded-3xl p-8 max-w-md w-full mx-4 
        border border-white/30
        hover:shadow-emerald-500/20 hover:border-emerald-200/50">

            <!-- Logo and welcome text with enhanced animations -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-6 relative">
                    <div class="absolute inset-0 bg-emerald-500/20 rounded-full blur-xl animate-pulse"></div>
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo Desa"
                        class="w-24 h-24 relative z-10 drop-shadow-2xl transform hover:scale-105 transition-all duration-500">
                </div>
                <h1
                    class="text-4xl font-bold bg-gradient-to-r from-green-800 to-emerald-600 bg-clip-text text-transparent mb-2 animate-fade-in-down">
                    Selamat Datang
                </h1>
                <p class="text-emerald-600 animate-fade-in-up">Masuk untuk mengakses layanan Desa Gunung Sari</p>
            </div>

            <!-- Enhanced form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <!-- Email field with enhanced styling -->
                <div class="space-y-2 transform transition-all duration-300 hover:translate-x-1">
                    <label for="email" class="block text-green-800 font-medium">Email</label>
                    <div class="relative group">
                        <span
                            class="absolute inset-y-0 left-3 flex items-center text-green-600 group-focus-within:text-green-800 
                        transition-colors duration-300 group-hover:scale-110">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input id="email" type="email" name="email" required autofocus
                            class="w-full pl-10 pr-4 py-3 rounded-xl border-2 border-green-200/50 focus:ring-4 
                        focus:ring-green-500/20 focus:border-green-500 bg-white/80 backdrop-blur-sm 
                        transition-all duration-300 group-hover:bg-white/95">
                    </div>
                </div>

                <!-- Password field with enhanced styling -->
                <div x-data="{ showPassword: false }" class="space-y-2 transform transition-all duration-300 hover:translate-x-1">
                    <label for="password" class="block text-green-800 font-medium">Password</label>
                    <div class="relative group">
                        <span
                            class="absolute inset-y-0 left-3 flex items-center text-green-600 group-focus-within:text-green-800 
                        transition-colors duration-300 group-hover:scale-110">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required
                            class="w-full pl-10 pr-12 py-3 rounded-xl border-2 border-green-200/50 focus:ring-4 
                        focus:ring-green-500/20 focus:border-green-500 bg-white/80 backdrop-blur-sm 
                        transition-all duration-300 group-hover:bg-white/95">
                        <button type="button" @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-3 flex items-center text-green-600 hover:text-green-800 
                        transition-all duration-300 hover:scale-110">
                            <i class="fas" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                </div>

                <!-- Enhanced remember me and forgot password section -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="w-4 h-4 text-emerald-600 border-emerald-300 rounded focus:ring-emerald-500 
                        transition-all duration-300 hover:scale-110">
                        <label for="remember_me"
                            class="ml-2 text-sm text-emerald-700 hover:text-emerald-900 
                        transition-all duration-300">
                            Ingat Saya
                        </label>
                    </div>
                    <a href="{{ route('password.request') }}"
                        class="text-sm text-emerald-600 hover:text-emerald-800 transition-all duration-300 
                    hover:underline hover:translate-x-1 inline-block">
                        Lupa Password?
                    </a>
                </div>

                <!-- Enhanced submit button -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 text-white font-semibold 
                py-4 rounded-xl transition-all duration-500 transform hover:scale-[1.02] active:scale-[0.98] 
                hover:shadow-lg hover:shadow-emerald-500/25 focus:outline-none focus:ring-4 focus:ring-emerald-500/30
                relative overflow-hidden group">
                    <span
                        class="absolute inset-0 bg-gradient-to-r from-emerald-400 to-green-400 opacity-0 
                    group-hover:opacity-20 transition-opacity duration-500"></span>
                    Masuk
                </button>
            </form>

            <!-- Enhanced register link -->
            <div class="text-center mt-8">
                <p class="text-sm text-emerald-700">
                    Belum memiliki akun?
                    <a href="{{ route('register') }}"
                        class="font-bold text-emerald-800 hover:text-emerald-900 transition-all duration-300 
                    hover:underline relative inline-block group">
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-emerald-600 transform scale-x-0 
                        group-hover:scale-x-100 transition-transform duration-300"></span>
                        Daftar Sekarang
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
