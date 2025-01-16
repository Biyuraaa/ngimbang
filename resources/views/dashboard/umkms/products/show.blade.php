@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-emerald-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-4 md:mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center w-full overflow-hidden">
                    <li class="inline-flex items-center min-w-0">
                        <a href="{{ route('dashboard') }}"
                            class="text-sm md:text-base text-emerald-600 hover:text-emerald-800 transition-colors duration-200 whitespace-nowrap">
                            <i class="fas fa-home text-base md:text-lg"></i>
                            <span class="hidden md:inline ml-2">Dashboard</span>
                        </a>
                    </li>
                    <li class="min-w-0">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-emerald-300 mx-1 md:mx-2 text-sm md:text-base"></i>
                            <a href="{{ route('umkms.index') }}"
                                class="text-sm md:text-base text-emerald-600 hover:text-emerald-800 transition-colors duration-200 whitespace-nowrap">
                                <i class="fas fa-store md:hidden"></i>
                                <span class="hidden md:inline">UMKM</span>
                            </a>
                        </div>
                    </li>
                    @if (Auth::user()->hasRole('superadmin'))
                        <li class="min-w-0">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-emerald-300 mx-1 md:mx-2 text-sm md:text-base"></i>
                                <a href="{{ route('umkms.show', $product->umkm) }}"
                                    class="text-sm md:text-base text-emerald-600 hover:text-emerald-800 transition-colors duration-200 truncate">
                                    {{ $product->umkm->name }}
                                </a>
                            </div>
                        </li>
                    @endif
                    <li aria-current="page" class="min-w-0">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-emerald-300 mx-1 md:mx-2 text-sm md:text-base"></i>
                            <span
                                class="text-sm md:text-base text-emerald-800 font-medium truncate">{{ $product->name }}</span>
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
                            <i class="fas fa-box text-white text-xl md:text-2xl"></i>
                        </div>
                        <div class="flex-1 md:flex-none min-w-0">
                            <h1 class="text-xl md:text-2xl font-bold text-gray-900 truncate">{{ $product->name }}</h1>
                            <p class="text-emerald-600 text-sm md:text-base mt-0.5 md:mt-1">Detail produk dari
                                {{ $product->umkm->name }}</p>
                        </div>
                    </div>
                    @if (Auth::user()->hasRole('superadmin'))
                        <a href="{{ route('umkms.show', $product->umkm) }}"
                            class="w-full md:w-auto inline-flex items-center justify-center px-4 md:px-6 py-2.5 md:py-3 rounded-xl md:rounded-full text-sm font-medium text-emerald-700 bg-emerald-100 hover:bg-emerald-200 transition-all duration-300">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke UMKM
                        </a>
                    @else
                        <a href="{{ route('umkms.index') }}"
                            class="w-full md:w-auto inline-flex items-center justify-center px-4 md:px-6 py-2.5 md:py-3 rounded-xl md:rounded-full text-sm font-medium text-emerald-700 bg-emerald-100 hover:bg-emerald-200 transition-all duration-300">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke UMKM
                        </a>
                    @endif
                </div>
            </div>
            <!-- Main Content -->
            <div class="space-y-6">
                <!-- Main Product Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Left Column - Images -->
                    <div class="space-y-6">
                        <!-- Main Product Image -->
                        <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 overflow-hidden group">
                            <div class="relative aspect-square cursor-zoom-in overflow-hidden">
                                <img src="{{ asset('storage/images/products/' . $product->thumbnail) }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110">
                                <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity">
                                </div>
                            </div>
                        </div>

                        <!-- Product Gallery -->
                        <div
                            class="bg-gradient-to-br from-white to-emerald-50/50 rounded-2xl shadow-lg border border-emerald-100 p-6">
                            <!-- Header -->
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center space-x-3">
                                    <div class="bg-gradient-to-br from-emerald-500 to-green-600 p-3 rounded-lg shadow-md">
                                        <i class="fas fa-images text-white text-lg"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-800">Galeri Produk</h3>
                                </div>
                            </div>

                            <!-- Gallery Container -->
                            <div class="space-y-4">
                                <!-- Thumbnails Scroll -->
                                <div class="relative">
                                    <div class="overflow-x-auto hide-scrollbar">
                                        <div class="flex space-x-4 py-2">
                                            @foreach ($product->galleries as $gallery)
                                                <div
                                                    class="flex-none w-32 relative aspect-square cursor-pointer 
                        hover:opacity-75 transition duration-300">
                                                    <img src="{{ asset('storage/images/products/' . $gallery->path) }}"
                                                        alt="{{ $product->name }}"
                                                        class="w-full h-full object-cover rounded-lg shadow-sm"
                                                        onclick="showImage('{{ asset('storage/images/products/' . $gallery->path) }}')">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Product Info -->
                    <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-8">
                        <!-- Category & Status -->
                        <div class="flex items-center space-x-3 mb-6">
                            <span
                                class="px-4 py-1.5 text-sm font-semibold rounded-full text-white bg-emerald-500 shadow-sm">
                                {{ $product->category->name }}
                            </span>
                            <span
                                class="px-4 py-1.5 text-sm font-semibold rounded-full shadow-sm
                    {{ $product->status === 'published'
                        ? 'bg-green-500 text-white'
                        : ($product->status === 'draft'
                            ? 'bg-yellow-500 text-white'
                            : 'bg-red-500 text-white') }}">
                                {{ ucfirst($product->status) }}
                            </span>
                        </div>

                        <!-- Product Title -->
                        <h1 class="text-4xl font-bold text-gray-800 mb-6 leading-tight">{{ $product->name }}</h1>

                        <!-- Price -->
                        <div class="bg-emerald-50 rounded-xl p-6 mb-8">
                            <span class="text-sm text-emerald-600 font-medium block mb-2">Harga</span>
                            <div class="flex items-baseline space-x-2">
                                <span class="text-4xl font-bold text-emerald-600">Rp</span>
                                <span
                                    class="text-4xl font-bold text-emerald-600">{{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="space-y-6">
                            <div class="border-t border-gray-100 pt-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <i class="fas fa-info-circle text-emerald-500 mr-2"></i>
                                    Deskripsi Produk
                                </h3>
                                <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Marketplace Section -->
                <div
                    class="bg-gradient-to-br from-white to-emerald-50/50 rounded-2xl shadow-lg border border-emerald-100 p-8 hover:shadow-xl transition-all duration-300 relative overflow-hidden group">
                    <!-- Background Decoration -->
                    <div
                        class="absolute -right-6 -top-6 opacity-5 transform rotate-12 transition-transform group-hover:rotate-45 duration-700">
                        <i class="fas fa-shopping-cart text-9xl text-emerald-900"></i>
                    </div>

                    <!-- Section Header -->
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="bg-gradient-to-br from-emerald-500 to-green-600 p-3 rounded-xl shadow-md">
                            <i class="fas fa-shopping-cart text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">Beli di Marketplace</h3>
                            <p class="text-gray-500 text-sm mt-1">Pilih marketplace kesukaan Anda</p>
                        </div>
                    </div>

                    @php
                        $marketplaceData = [
                            'tokopedia' => ['color' => 'green-500', 'name' => 'Tokopedia'],
                            'shopee' => ['color' => 'orange-500', 'name' => 'Shopee'],
                            'bukalapak' => ['color' => 'red-500', 'name' => 'Bukalapak'],
                            'bli_bli' => ['color' => 'blue-500', 'name' => 'Blibli'],
                            'lazada' => ['color' => 'purple-500', 'name' => 'Lazada'],
                        ];
                        $hasMarketplace = collect(array_keys($marketplaceData))->some(
                            fn($marketplace) => !empty($product->$marketplace),
                        );
                    @endphp

                    @if ($hasMarketplace)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
                            @foreach ($marketplaceData as $key => $data)
                                @if ($product->$key)
                                    <a href="{{ $product->$key }}" target="_blank" rel="noopener noreferrer"
                                        class="group/item relative flex flex-col items-center p-6 rounded-xl bg-white hover:bg-{{ $data['color'] }}/5 border-2 border-{{ $data['color'] }}/20 hover:border-{{ $data['color'] }} transition-all duration-300">
                                        <div
                                            class="flex items-center justify-center w-12 h-12 rounded-full bg-{{ $data['color'] }}/10 mb-3">
                                            <i class="fa fa-shopping-bag text-{{ $data['color'] }} text-2xl"></i>
                                        </div>
                                        <span
                                            class="font-medium text-gray-700 group-hover/item:text-{{ $data['color'] }} transition-colors duration-300">
                                            {{ $data['name'] }}
                                        </span>
                                        <div
                                            class="absolute top-2 right-2 opacity-0 group-hover/item:opacity-100 transition-opacity">
                                            <i class="fas fa-external-link-alt text-{{ $data['color'] }} text-sm"></i>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="mb-6 transform transition-transform hover:scale-110 duration-300">
                                <i class="fas fa-store-alt-slash text-7xl text-emerald-200 animate-pulse"></i>
                            </div>
                            <h4 class="text-xl font-semibold text-gray-700 mb-3">Belum Ada Marketplace</h4>
                            <p class="text-gray-500 max-w-md mx-auto mb-6">
                                Produk ini belum tersedia di marketplace manapun.
                                Silakan hubungi penjual untuk informasi pembelian lebih lanjut.
                            </p>
                        </div>
                    @endif
                </div>


                @if (Auth::user()->hasRole('super-admin'))
                    <!-- UMKM Information -->
                    <div
                        class="bg-gradient-to-br from-white to-emerald-50/50 rounded-2xl shadow-sm border border-emerald-100 p-6 hover:shadow-md transition-all duration-300 relative overflow-hidden group">
                        <div
                            class="absolute -right-6 -top-6 opacity-5 transform rotate-12 transition-transform group-hover:rotate-45 duration-700">
                            <i class="fas fa-store text-8xl text-emerald-900"></i>
                        </div>
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="bg-gradient-to-br from-emerald-500 to-green-600 p-2 rounded-lg shadow-sm">
                                <i class="fas fa-shop text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Informasi UMKM</h3>
                        </div>
                        <div class="space-y-4">
                            <div
                                class="group/item p-4 rounded-xl bg-white/50 hover:bg-emerald-50/50 transition-all duration-300">
                                <div class="text-sm font-medium text-emerald-600 mb-2">Nama UMKM</div>
                                <div class="text-gray-700 flex items-center">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center mr-3 group-hover/item:bg-emerald-200 transition-colors duration-300">
                                        <i class="fas fa-store text-emerald-600"></i>
                                    </div>
                                    <span class="text-gray-800 ml-4">{{ $product->umkm->name }}</span>
                                </div>
                            </div>
                            <div
                                class="group/item p-4 rounded-xl bg-white/50 hover:bg-emerald-50/50 transition-all duration-300">
                                <div class="text-sm font-medium text-emerald-600 mb-2">Alamat</div>
                                <div class="text-gray-700 flex items-center">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center mr-3 group-hover/item:bg-emerald-200 transition-colors duration-300">
                                        <i class="fas fa-location-dot text-emerald-600"></i>
                                    </div>
                                    <span class="text-gray-800 ml-4">{{ $product->umkm->address }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Reviews Section -->
                <section
                    class="bg-gradient-to-br from-white to-emerald-50/50 rounded-2xl shadow-sm border border-emerald-100 p-4 sm:p-6 hover:shadow-md transition-all duration-300">
                    <!-- Section Header -->
                    <div class="flex items-center space-x-3 mb-4 sm:mb-6">
                        <div class="bg-gradient-to-br from-emerald-500 to-green-600 p-2 rounded-lg shadow-sm">
                            <i class="fas fa-star text-white text-sm sm:text-base"></i>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold text-gray-800">Ulasan Pengunjung</h3>
                    </div>
                    <!-- Rating Statistics -->
                    <div
                        class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-8 mb-6 sm:mb-8 p-4 sm:p-6 bg-emerald-50/50 rounded-xl">
                        <div class="text-center mb-4 sm:mb-0 sm:mr-4">
                            <div
                                class="text-3xl sm:text-4xl font-bold bg-gradient-to-r from-emerald-600 to-green-600 bg-clip-text text-transparent">
                                {{ number_format($product->averageRating(), 1) }}
                            </div>
                            <div class="text-xs sm:text-sm font-medium text-emerald-600">dari 5 bintang</div>
                            <div class="text-xs text-emerald-500 mt-1">{{ $product->ratingCount() }} ulasan</div>
                        </div>

                        <div class="flex-1 space-y-2 w-full sm:w-auto">
                            @php
                                $distribution = $product->getRatingDistribution();
                            @endphp
                            @foreach (range(5, 1) as $star)
                                @php
                                    $count = $distribution->where('score', $star)->first()?->count ?? 0;
                                    $percentage =
                                        $product->ratingCount() > 0 ? ($count / $product->ratingCount()) * 100 : 0;
                                @endphp
                                <div class="flex items-center group">
                                    <span
                                        class="text-xs sm:text-sm font-medium text-emerald-700 w-6 sm:w-8">{{ $star }}
                                        <i class="fas fa-star text-xs"></i></span>
                                    <div class="flex-1 h-2 sm:h-3 bg-emerald-100 rounded-full mx-2 overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-emerald-500 to-green-600 rounded-full transition-all duration-500 group-hover:shadow-lg"
                                            style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <span
                                        class="text-xs sm:text-sm text-emerald-600 w-8 sm:w-12">{{ $count }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Review List -->
                    <div class="space-y-4 sm:space-y-6">
                        @forelse ($product->ratings()->with('user')->latest()->take(5)->get() as $rating)
                            <div
                                class="group p-3 sm:p-4 rounded-xl border border-emerald-50 hover:border-emerald-100 transition-all duration-300">
                                <div class="flex items-start space-x-3 sm:space-x-4">
                                    <div class="flex-shrink-0">
                                        @php
                                            $initials = collect(explode(' ', $rating->user->name))
                                                ->map(function ($segment) {
                                                    return strtoupper(substr($segment, 0, 1));
                                                })
                                                ->take(2)
                                                ->join('');
                                        @endphp
                                        <div
                                            class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center text-white font-medium text-xs sm:text-sm">
                                            {{ $initials }}
                                        </div>
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start mb-2">
                                            <div>
                                                <div
                                                    class="font-semibold text-gray-900 group-hover:text-emerald-700 transition-colors duration-300 text-sm sm:text-base truncate">
                                                    {{ $rating->user->name }}
                                                </div>
                                                <div class="flex items-center space-x-1 text-emerald-500">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i
                                                            class="fas fa-star {{ $i <= $rating->score ? 'text-emerald-500' : 'text-gray-200' }} text-xs sm:text-sm"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="text-xs sm:text-sm text-emerald-600 font-medium mt-1 sm:mt-0">
                                                {{ $rating->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                        @if ($rating->review)
                                            <p
                                                class="text-gray-600 leading-relaxed text-sm sm:text-base line-clamp-3 sm:line-clamp-none">
                                                {{ $rating->review }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-gray-500 py-4">
                                Belum ada ulasan untuk produk ini.
                            </div>
                        @endforelse
                    </div>
                </section>

                <!-- Comments Section -->
                <div
                    class="bg-gradient-to-br from-white to-emerald-50/50 rounded-2xl shadow-sm border border-emerald-100 p-6 hover:shadow-md transition-all duration-300">
                    <!-- Section Header -->
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="bg-gradient-to-br from-emerald-500 to-green-600 p-2 rounded-lg shadow-sm">
                            <i class="fas fa-comments text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Komentar</h3>
                    </div>

                    <!-- Comments List -->
                    <div class="space-y-6">
                        @forelse ($product->comments()->with('user')->latest()->get() as $comment)
                            <div
                                class="group p-4 rounded-xl border border-emerald-50 hover:border-emerald-100 transition-all duration-300">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0">
                                        @php
                                            $initials = collect(explode(' ', $comment->user->name))
                                                ->map(function ($segment) {
                                                    return strtoupper(substr($segment, 0, 1));
                                                })
                                                ->take(2)
                                                ->join('');
                                        @endphp
                                        <div
                                            class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center text-white font-medium text-sm">
                                            {{ $initials }}
                                        </div>
                                    </div>

                                    <div class="flex-1">
                                        <div class="flex justify-between items-start mb-2">
                                            <div
                                                class="font-semibold text-gray-900 group-hover:text-emerald-700 transition-colors duration-300">
                                                {{ $comment->user->name }}
                                            </div>
                                            <div class="text-sm text-emerald-600 font-medium">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                        <p class="text-gray-600 leading-relaxed">{{ $comment->content }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500">
                                <i class="fas fa-comments text-4xl mb-3 text-emerald-200"></i>
                                <p>Belum ada komentar</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('styles')
    <style>
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
@endpush
