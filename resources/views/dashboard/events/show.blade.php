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
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-emerald-300 mr-2"></i>
                            <a href="{{ route('events.index') }}"
                                class="text-emerald-600 hover:text-emerald-800 font-medium transition-colors duration-200">
                                Events
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-emerald-300 mr-2"></i>
                            <span class="text-emerald-800 font-medium">{{ $event->title }}</span>
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
                            <i class="fas fa-calendar-alt text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">{{ $event->title }}</h2>
                            <p class="text-sm text-emerald-600">Informasi lengkap Event Desa Gunung Sari</p>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('events.index') }}"
                            class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium text-emerald-700 bg-emerald-100 hover:bg-emerald-200 transition-all duration-300">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <!-- Main Image and Title -->
                    <div class="bg-white rounded-2xl shadow-sm border border-emerald-100 overflow-hidden">
                        <div
                            class="relative w-full h-[300px] md:h-[400px] lg:h-[500px] overflow-hidden rounded-2xl shadow-lg">
                            <div class="absolute inset-0 bg-gray-200 animate-pulse" x-show="loading"></div>

                            @if ($event->thumbnail)
                                <img src="{{ asset('storage/images/events/' . $event->thumbnail) }}"
                                    alt="{{ $event->title }}"
                                    class="w-full h-full object-cover transition-transform duration-700 hover:scale-105"
                                    onload="this.parentElement.querySelector('.animate-pulse').style.display='none'"
                                    onerror="this.src='{{ asset('assets/images/no_thumbnail.jpg') }}'; this.onerror=null;">
                            @else
                                <img src="{{ asset('assets/images/no_thumbnail.jpg') }}"
                                    alt="Default thumbnail for {{ $event->title }}"
                                    class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                            @endif

                            <div
                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent p-6 md:p-8">
                                <div class="transform transition-all duration-500 translate-y-0 hover:-translate-y-2">
                                    <h1
                                        class="text-2xl md:text-3xl lg:text-4xl font-bold text-white tracking-tight leading-tight">
                                        {{ $event->title }}
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Event Details -->
                    <div class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Detail Event</h3>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-map-marker-alt text-emerald-500"></i>
                                <span class="text-gray-700">{{ $event->location }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-calendar text-emerald-500"></i>
                                <span class="text-gray-700">
                                    {{ $event->start_date ? \Carbon\Carbon::parse($event->start_date)->format('d M Y') : 'TBA' }}
                                    -
                                    {{ $event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('d M Y') : 'TBA' }}
                                </span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-clock text-emerald-500"></i>
                                <span class="text-gray-700">
                                    {{ $event->start_at ? \Carbon\Carbon::parse($event->start_at)->format('H:i') : 'TBA' }}
                                    -
                                    {{ $event->end_at ? \Carbon\Carbon::parse($event->end_at)->format('H:i') : 'TBA' }}
                                </span>
                            </div>
                            @if ($event->price)
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-tag text-emerald-500"></i>
                                    <span class="text-gray-700">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                                </div>
                            @endif
                            @if ($event->registration_url)
                                <div class="mt-4">
                                    <a href="{{ $event->registration_url }}" target="_blank"
                                        class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition-colors duration-300">
                                        <i class="fas fa-external-link-alt mr-2"></i>
                                        Daftar Sekarang
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Deskripsi Event</h3>
                        <div class="prose prose-emerald max-w-none">
                            {!! nl2br(e($event->description)) !!}
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Komentar</h3>
                        @if ($event->comments->count() > 0)
                            <div class="space-y-4">
                                @foreach ($event->comments as $comment)
                                    <div class="flex space-x-4">
                                        <div class="flex-shrink-0">
                                            <img class="h-10 w-10 rounded-full"
                                                src="{{ $comment->user->image ? asset('storage/' . $comment->user->image) : asset('images/default-avatar.png') }}"
                                                alt="{{ $comment->user->name }}">
                                        </div>
                                        <div class="flex-grow">
                                            <p class="text-sm font-medium text-gray-900">{{ $comment->user->name }}</p>
                                            <p class="mt-1 text-sm text-gray-700">{{ $comment->content }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-600">Belum ada komentar untuk event ini.</p>
                        @endif
                    </div>
                </div>

                <div class="space-y-6">
                    <!-- Event Information -->
                    <div
                        class="bg-gradient-to-br from-white to-emerald-50/50 rounded-2xl shadow-sm border border-emerald-100 p-6 hover:shadow-md transition-all duration-300 relative overflow-hidden group">
                        <div
                            class="absolute -right-6 -top-6 opacity-5 transform rotate-12 transition-transform group-hover:rotate-45 duration-700">
                            <i class="fas fa-info-circle text-8xl text-emerald-900"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Informasi Event</h3>
                        <div class="space-y-4">
                            <div class="p-4 rounded-xl bg-white/50 hover:bg-emerald-50/50 transition-all duration-300">
                                <div class="text-sm font-medium text-emerald-600 mb-2">Penyelenggara</div>
                                <div class="text-gray-700 flex items-center">
                                    <i class="fas fa-user mr-2 text-emerald-500"></i>
                                    <span>{{ $event->user->name }}</span>
                                </div>
                            </div>
                            <div class="p-4 rounded-xl bg-white/50 hover:bg-emerald-50/50 transition-all duration-300">
                                <div class="text-sm font-medium text-emerald-600 mb-2">Status</div>
                                <div class="text-gray-700 flex items-center">
                                    <i class="fas fa-check-circle mr-2 text-emerald-500"></i>
                                    <span class="capitalize">{{ $event->status }}</span>
                                </div>
                            </div>
                            <div class="p-4 rounded-xl bg-white/50 hover:bg-emerald-50/50 transition-all duration-300">
                                <div class="text-sm font-medium text-emerald-600 mb-2">Tanggal Publikasi</div>
                                <div class="text-gray-700 flex items-center">
                                    <i class="fas fa-calendar-alt mr-2 text-emerald-500"></i>
                                    <span>{{ $event->created_at ? $event->created_at->format('d M Y, H:i') : 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Related Events (placeholder) -->
                    <div class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Event Terkait</h3>
                        <p class="text-gray-600">Fitur akan segera hadir...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
