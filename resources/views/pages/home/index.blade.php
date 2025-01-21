@extends('layouts.guest')
@section('title', 'Desa Ngimbang')
@section('content')
    @include('pages.home.hero-section')
    @include('pages.home.summary-section')
    @include('pages.home.latest-info-section')
    @include('pages.home.galleries')
@endsection

@push('styles')
    <style>
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        @keyframes pulse-slow {

            0%,
            100% {
                opacity: 0.3;
            }

            50% {
                opacity: 0.5;
            }
        }

        .animate-pulse-slow {
            animation: pulse-slow 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
@endpush
