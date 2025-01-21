@extends('layouts.guest')

@section('title', $destination->name . ' - Wisata Desa Gunungsari')

@section('content')
    <main class="min-h-screen bg-gradient-to-b from-green-100 via-emerald-50/30 to-white">
        <!-- Hero Section -->
        <div class="relative h-[70vh] overflow-hidden">
            <!-- Background Image -->
            <div class="absolute inset-0">
                <img src="{{ $destination->thumbnail
                    ? asset('storage/images/destinations/' . $destination->thumbnail)
                    : asset('assets/images/no_thumbnail.jpg') }}"
                    class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-b from-black/70 to-black/30"></div>
            </div>

            <!-- Content -->
            <div class="relative h-full flex items-center justify-center">
                <div class="text-center text-white px-6 max-w-4xl">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 tracking-tight leading-tight">
                        {{ $destination->name }}
                    </h1>

                    <!-- Meta Info -->
                    <div class="flex flex-wrap items-center justify-center gap-6 text-sm md:text-base">
                        <!-- Rating -->
                        <div class="flex items-center gap-2">
                            <i class="fas fa-star text-yellow-400"></i>
                            <span>{{ number_format($destination->ratings()->avg('score'), 1) }}
                                <span class="text-gray-300">({{ $destination->ratings()->count() }} ulasan)</span>
                            </span>
                        </div>

                        <!-- Opening Hours -->
                        <div class="flex items-center gap-2">
                            <i class="far fa-clock text-emerald-400"></i>
                            <span>
                                {{ \Carbon\Carbon::parse($destination->open_at)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse($destination->close_at)->format('H:i') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-md p-6 sticky top-6">
                        <div class="border-b border-gray-100 pb-4 mb-6">
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">Harga Tiket</h2>
                            <p class="text-sm text-gray-500">Harga sudah termasuk semua fasilitas</p>
                        </div>

                        <div class="space-y-4 mb-6">
                            @foreach ($destination->destinationPriceRules as $priceRule)
                                <div
                                    class="flex justify-between items-center py-3 px-4 rounded-lg bg-gray-50 hover:bg-emerald-50 transition-colors">
                                    <div>
                                        <span class="text-gray-800 font-medium">{{ $priceRule->priceRuleType->name }}</span>
                                        @if ($priceRule->description)
                                            <p class="text-xs text-gray-500 mt-1">{{ $priceRule->description }}</p>
                                        @endif
                                    </div>
                                    <span class="font-bold text-emerald-600">
                                        Rp {{ number_format($priceRule->price, 0, ',', '.') }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        <!-- Notes -->
                        <div class="bg-emerald-50 rounded-xl p-4 mb-6">
                            <div class="flex items-start gap-3">
                                <i class="fas fa-info-circle text-emerald-500 mt-1"></i>
                                <div class="text-sm text-gray-600">
                                    <p class="font-medium text-gray-800 mb-1">Informasi Tiket:</p>
                                    <ul class="space-y-1 list-disc list-inside text-gray-600">
                                        <li>Harga untuk hari biasa (Senin-Jumat)</li>
                                        <li>Anak dibawah 3 tahun gratis</li>
                                        <li>Tiket berlaku untuk satu kali kunjungan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <section class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 sm:p-8 mb-12">
                <!-- Hero Section -->
                <div class="border-b border-gray-100 pb-8 mb-8">
                    <div class="flex flex-col lg:flex-row justify-between items-start gap-6">
                        <!-- Title and Description -->
                        <div class="flex-1">
                            <div class="flex items-center gap-4 mb-4">
                                <div
                                    class="bg-gradient-to-br from-emerald-500 to-green-600 p-3 rounded-xl shadow-lg shadow-emerald-200">
                                    <i class="fas fa-mountain text-white text-xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Tentang
                                        {{ $destination->name }}</h2>
                                    <p class="text-emerald-600 mt-1">Jelajahi keindahan wisata alam yang mempesona di Desa
                                        Gunungsari</p>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Info -->
                        <div class="flex flex-wrap gap-4">
                            <div class="inline-flex items-center px-4 py-2 rounded-xl bg-emerald-50 text-emerald-700">
                                <i class="fas fa-clock mr-2"></i>
                                <span>Buka 24 Jam</span>
                            </div>
                            <div class="inline-flex items-center px-4 py-2 rounded-xl bg-emerald-50 text-emerald-700">
                                <i class="fas fa-ticket-alt mr-2"></i>
                                <span>Tiket Masuk</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Description -->
                <div class="prose prose-emerald max-w-none mb-12">
                    <p class="text-gray-600 leading-relaxed text-lg">{{ $destination->description }}</p>
                </div>

                <!-- Facilities Section -->
                <div class="mb-12">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="p-3 rounded-xl bg-emerald-50">
                            <i class="fas fa-concierge-bell text-xl text-emerald-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Fasilitas Tersedia</h3>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($destination->facilities as $facility)
                            <div class="group hover:-translate-y-1 transition-all duration-300">
                                <div
                                    class="h-full bg-white p-6 rounded-2xl shadow-sm border border-gray-100 
                        hover:shadow-lg hover:border-emerald-100 transition-all duration-300">
                                    <div class="space-y-4">
                                        <!-- Facility Icon & Name -->
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-12 h-12 flex items-center justify-center rounded-xl 
                                    bg-emerald-50 text-emerald-600 group-hover:bg-emerald-100 
                                    transition-colors duration-300">
                                                <i class="fas fa-{{ $facility->icon ?? 'check' }} text-xl"></i>
                                            </div>
                                            <h4 class="text-lg font-semibold text-gray-800">{{ $facility->name }}</h4>
                                        </div>

                                        <!-- Description -->
                                        <p class="text-gray-600 leading-relaxed">{{ $facility->description }}</p>

                                        <!-- Metrics -->
                                        @if ($facility->quantity || $facility->capacity)
                                            <div class="flex flex-wrap items-center gap-3 pt-4 border-t border-gray-100">
                                                @if ($facility->quantity)
                                                    <span
                                                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg
                                            bg-gray-50 text-sm font-medium text-gray-700">
                                                        <i class="fas fa-cubes text-emerald-500"></i>
                                                        {{ $facility->quantity }} unit
                                                    </span>
                                                @endif
                                                @if ($facility->capacity)
                                                    <span
                                                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg
                                            bg-gray-50 text-sm font-medium text-gray-700">
                                                        <i class="fas fa-users text-emerald-500"></i>
                                                        {{ $facility->capacity }} orang
                                                    </span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full">
                                <div
                                    class="flex flex-col items-center justify-center gap-4 py-12 
                        bg-gradient-to-br from-gray-50 to-white rounded-2xl border-2 border-dashed border-gray-200">
                                    <div class="w-16 h-16 flex items-center justify-center rounded-full bg-gray-100">
                                        <i class="fas fa-inbox text-3xl text-gray-400"></i>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-gray-500 font-medium">Belum ada fasilitas yang tersedia</p>
                                        <p class="text-gray-400 text-sm mt-1">Fasilitas akan ditambahkan segera</p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Location Section -->
                <div class="bg-gray-50 rounded-2xl p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="p-3 rounded-xl bg-emerald-50">
                            <i class="fas fa-map-marked-alt text-xl text-emerald-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Lokasi</h3>
                    </div>

                    <div class="flex flex-col sm:flex-row items-start gap-6">
                        <div class="flex-1">
                            <div class="flex items-start gap-3 text-gray-600">
                                <i class="fas fa-map-marker-alt text-emerald-500 mt-1"></i>
                                <div>
                                    <p class="font-medium text-gray-800">Alamat Lengkap</p>
                                    <p class="mt-1">{{ $destination->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Attractions Sections -->
            <section class="space-y-8">
                <!-- Included Attractions -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 sm:p-8">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                        <div class="flex items-start gap-4">
                            <div
                                class="bg-gradient-to-br from-emerald-500 to-green-600 p-3 rounded-xl shadow-lg shadow-emerald-200">
                                <i class="fas fa-ticket-alt text-white text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">Wahana yang Tersedia</h2>
                                <p class="text-emerald-600 mt-1">Wahana yang dapat dinikmati setelah membeli tiket masuk
                                </p>
                            </div>
                        </div>
                        <div
                            class="inline-flex items-center px-4 py-2 bg-emerald-50 text-emerald-700 font-medium rounded-xl">
                            <i class="fas fa-check-circle mr-2"></i>
                            Termasuk Tiket Masuk
                        </div>
                    </div>

                    <div class="grid gap-6">
                        @foreach ($destination->attractions->filter(function ($attraction) {
            return is_null($attraction->price) || $attraction->price == 0;
        }) as $attraction)
                            <div class="group hover:-translate-y-1 transition-all duration-300">
                                <div
                                    class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300">
                                    <div class="flex flex-col sm:flex-row">
                                        <!-- Image -->
                                        <div class="relative sm:w-56 md:w-64 shrink-0">
                                            <img src="{{ $attraction->thumbnail ? asset('storage/' . $attraction->thumbnail) : asset('assets/images/not-found.png') }}"
                                                alt="{{ $attraction->name }}"
                                                class="w-full h-48 sm:h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                            <div
                                                class="absolute top-4 left-4 px-3 py-1.5 bg-emerald-500 text-white text-sm font-medium rounded-lg shadow-sm">
                                                <i class="fas fa-ticket-alt mr-1.5"></i>
                                                Termasuk
                                            </div>
                                        </div>

                                        <!-- Content -->
                                        <div class="flex-1 p-6">
                                            <h3 class="text-xl font-semibold text-gray-800 mb-3">{{ $attraction->name }}
                                            </h3>

                                            <div class="flex flex-wrap items-center gap-4 text-sm mb-4">
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-lg bg-gray-50 text-gray-700">
                                                    <i class="far fa-clock text-emerald-500 mr-2"></i>
                                                    {{ $attraction->duration ?? '30 min' }}
                                                </span>
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-lg bg-gray-50 text-gray-700">
                                                    <i class="fas fa-user-friends text-emerald-500 mr-2"></i>
                                                    {{ $attraction->capacity ?? '2-4 orang' }}
                                                </span>
                                            </div>

                                            <p class="text-gray-600 leading-relaxed">
                                                {{ Str::limit($attraction->description, 500) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Additional Attractions -->
                @if ($destination->attractions->where('price', '>', 0)->count() > 0)
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 sm:p-8">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                            <div class="flex items-start gap-4">
                                <div
                                    class="bg-gradient-to-br from-yellow-500 to-orange-500 p-3 rounded-xl shadow-lg shadow-yellow-200">
                                    <i class="fas fa-plus-circle text-white text-xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-800">Wahana Tambahan</h2>
                                    <p class="text-yellow-600 mt-1">Wahana dengan biaya tambahan</p>
                                </div>
                            </div>
                            <div
                                class="inline-flex items-center px-4 py-2 bg-yellow-50 text-yellow-700 font-medium rounded-xl">
                                <i class="fas fa-tag mr-2"></i>
                                Berbayar
                            </div>
                        </div>

                        <div class="grid gap-6">
                            @foreach ($destination->attractions->where('price', '>', 0) as $attraction)
                                <div class="group hover:-translate-y-1 transition-all duration-300">
                                    <div
                                        class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300">
                                        <div class="flex flex-col sm:flex-row">
                                            <!-- Image -->
                                            <div class="relative sm:w-56 md:w-64 shrink-0">
                                                <img src="{{ $attraction->thumbnail ? asset('storage/' . $attraction->thumbnail) : asset('assets/images/destination-not-found.png') }}"
                                                    alt="{{ $attraction->name }}"
                                                    class="w-full h-48 sm:h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                                <div
                                                    class="absolute top-4 left-4 px-3 py-1.5 bg-gradient-to-r from-yellow-500 to-orange-500 text-white text-sm font-medium rounded-lg shadow-sm">
                                                    Rp {{ number_format($attraction->price, 0, ',', '.') }}
                                                    <span class="text-xs">/orang</span>
                                                </div>
                                            </div>

                                            <!-- Content -->
                                            <div class="flex-1 p-6">
                                                <h3 class="text-xl font-semibold text-gray-800 mb-3">
                                                    {{ $attraction->name }}</h3>

                                                <div class="flex flex-wrap items-center gap-4 text-sm mb-4">
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-lg bg-gray-50 text-gray-700">
                                                        <i class="far fa-clock text-yellow-500 mr-2"></i>
                                                        {{ $attraction->duration ?? '30 min' }}
                                                    </span>
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-lg bg-gray-50 text-gray-700">
                                                        <i class="fas fa-user-friends text-yellow-500 mr-2"></i>
                                                        {{ $attraction->capacity ?? '2-4 orang' }}
                                                    </span>
                                                </div>

                                                <p class="text-gray-600 leading-relaxed mb-4">
                                                    {{ Str::limit($attraction->description, 500) }}
                                                </p>

                                                <button
                                                    class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium text-white
                                        bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600
                                        transition-all duration-300 hover:shadow-lg hover:shadow-yellow-200">
                                                    <i class="fas fa-ticket-alt mr-2"></i>
                                                    Pesan Tiket
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </section>

            <section class="bg-white rounded-2xl shadow-md p-8 my-12">
                <!-- Rating Summary -->
                <div class="grid md:grid-cols-2 gap-8 mb-8 pb-8 border-b border-gray-100">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Ulasan Pengunjung</h2>
                        <div class="flex items-center gap-4">
                            <!-- Average Score -->
                            <div class="text-center">
                                <div class="text-4xl font-bold text-gray-800">
                                    {{ number_format($destination->ratings()->avg('score'), 1) }}
                                </div>
                                <div class="flex items-center gap-1 text-yellow-400 my-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="fas fa-star {{ $i <= round($destination->ratings()->avg('score')) ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                    @endfor
                                </div>
                                <div class="text-sm text-gray-500">{{ $destination->ratings()->count() }} ulasan</div>
                            </div>

                            <!-- Rating Distribution -->
                            <div class="flex-1">
                                @for ($i = 5; $i >= 1; $i--)
                                    @php
                                        $count = $destination->ratings()->where('score', $i)->count();
                                        $percentage =
                                            $destination->ratings()->count() > 0
                                                ? ($count / $destination->ratings()->count()) * 100
                                                : 0;
                                    @endphp
                                    <div class="flex items-center gap-2 text-sm mb-1">
                                        <div class="w-12">{{ $i }} <i
                                                class="fas fa-star text-yellow-400"></i></div>
                                        <div class="flex-1 h-2 bg-gray-100 rounded-full">
                                            <div class="h-2 bg-yellow-400 rounded-full"
                                                style="width: {{ $percentage }}%"></div>
                                        </div>
                                        <div class="w-12 text-gray-500">{{ $count }}</div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <!-- Rating Form or User's Rating -->
                    @auth
                        @php
                            $userRating = $destination->ratings()->where('user_id', auth()->id())->first();
                        @endphp
                        @if ($userRating)
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Ulasan Anda</h3>
                                <div class="bg-gray-50 rounded-xl p-6">
                                    <div class="flex items-center gap-2 mb-4">
                                        <div class="flex items-center gap-1">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="fas fa-star text-2xl {{ $i <= $userRating->score ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                            @endfor
                                        </div>
                                        <span class="text-sm text-gray-500 ml-2">Rating Anda: {{ $userRating->score }}</span>
                                    </div>
                                    <p class="text-gray-600 mb-4">{{ $userRating->review }}</p>
                                    <p class="text-sm text-gray-500">Dikirim pada
                                        {{ $userRating->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        @else
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Berikan Ulasan Anda</h3>
                                <form action="{{ route('ratings.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="rateable_type" value="{{ get_class($destination) }}">
                                    <input type="hidden" name="rateable_id" value="{{ $destination->id }}">

                                    <!-- Star Rating Input -->
                                    <div class="flex flex-col gap-2 mb-4">
                                        <div class="flex items-center gap-2">
                                            <div class="flex items-center gap-1" id="starContainer">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <input type="radio" name="score" id="star{{ $i }}"
                                                        value="{{ $i }}" class="hidden peer star-input" required
                                                        {{ old('score') == $i ? 'checked' : '' }}>
                                                    <label for="star{{ $i }}"
                                                        class="cursor-pointer text-2xl text-gray-300 star-label"
                                                        data-rating="{{ $i }}">
                                                        <i class="fas fa-star"></i>
                                                    </label>
                                                @endfor
                                            </div>
                                            <span class="text-sm text-gray-500 ml-2">Pilih rating</span>
                                        </div>
                                        @error('score')
                                            <p class="text-red-500 text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Review Text -->
                                    <div class="mb-4">
                                        <textarea name="review" rows="3"
                                            class="w-full px-4 py-3 rounded-xl border @error('review') border-red-500 @else border-gray-200 @enderror focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                                            placeholder="Bagikan pengalaman Anda...">{{ old('review') }}</textarea>
                                        @error('review')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Session Messages -->
                                    @if (session('error'))
                                        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                                            <p class="text-red-600 text-sm">{{ session('error') }}</p>
                                        </div>
                                    @endif

                                    @if (session('success'))
                                        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                                            <p class="text-green-600 text-sm">{{ session('success') }}</p>
                                        </div>
                                    @endif

                                    <button type="submit"
                                        class="w-full mt-3 px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors">
                                        Kirim Ulasan
                                    </button>
                                </form>
                            </div>
                        @endif
                    @else
                        <div
                            class="bg-gray-50/80 backdrop-blur-sm rounded-xl p-8 text-center border border-gray-100 hover:border-emerald-100 transition-colors">
                            <div class="mb-4">
                                <i class="fas fa-lock text-emerald-500 text-3xl"></i>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-800 mb-2">Bagikan Pengalaman Anda</h4>
                            <p class="text-gray-600 mb-6">Login untuk memberikan ulasan dan berbagi pengalaman Anda dengan
                                pengunjung lainnya</p>
                            <div class="space-y-3">
                                <a href="{{ route('login') }}"
                                    class="block w-full px-6 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transform hover:scale-[1.02] transition-all duration-200">
                                    <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                                </a>
                            </div>
                        </div>
                    @endauth
                </div>

                <!-- Reviews List -->
                <div class="space-y-6">
                    @forelse($destination->ratings()->with('user')->latest()->take(5)->get() as $rating)
                        <div
                            class="group border-b border-gray-100 last:border-0 pb-6 hover:bg-gray-50/50 rounded-xl transition-colors p-4">
                            <div class="flex items-start gap-4">
                                <!-- Avatar -->
                                <img src="{{ $rating->user->image ?? 'https://ui-avatars.com/api/?name=' . urlencode($rating->user->name) }}"
                                    alt="{{ $rating->user->name }}" class="w-12 h-12 rounded-full ring-2 ring-gray-100">

                                <!-- Content -->
                                <div class="flex-1">
                                    <div class="flex items-start justify-between mb-2">
                                        <div>
                                            <h4 class="font-semibold text-gray-800">{{ $rating->user->name }}</h4>
                                            <div class="flex items-center gap-4 mt-1">
                                                <div class="flex items-center gap-1">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i
                                                            class="fas fa-star {{ $i <= $rating->score ? 'text-yellow-400' : 'text-gray-200' }} text-sm"></i>
                                                    @endfor
                                                </div>
                                                <span
                                                    class="text-sm text-gray-500">{{ $rating->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Review Text -->
                                    <p class="text-gray-600 leading-relaxed">{{ $rating->review }}</p>

                                    <!-- Review Metadata -->
                                    @if ($rating->user->reviews_count > 1)
                                        <div class="mt-3 flex items-center gap-2 text-xs text-gray-500">
                                            <i class="fas fa-pen-fancy"></i>
                                            <span>{{ $rating->user->reviews_count }} ulasan</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <div class="text-gray-400 mb-3">
                                <i class="far fa-star text-4xl"></i>
                            </div>
                            <p class="text-gray-500">Belum ada ulasan untuk destinasi ini.</p>
                            <p class="text-sm text-gray-400">Jadilah yang pertama memberikan ulasan!</p>
                        </div>
                    @endforelse
                </div>
            </section>

            <!-- Comments Section -->
            <section class="bg-white rounded-2xl shadow-md p-8">
                <!-- Header -->
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Komentar & Diskusi</h2>
                        <p class="text-gray-500 mt-1">{{ $destination->comments->count() }} komentar</p>
                    </div>
                </div>

                <!-- Comment Form -->
                @auth
                    <div class="mb-8">
                        <form action="{{ route('comments.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="commentable_id" value="{{ $destination->id }}">
                            <input type="hidden" name="commentable_type" value="App\Models\Destination">
                            <div class="flex items-start gap-4">
                                <div class="flex-1">
                                    <textarea name="content" rows="3"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                                        placeholder="Bagikan pengalaman Anda..."></textarea>
                                    <div class="flex justify-end mt-2">
                                        <button type="submit"
                                            class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors">
                                            Kirim Komentar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @else
                    <div
                        class="bg-gray-50/80 backdrop-blur-sm rounded-xl p-8 text-center border border-gray-100 hover:border-emerald-100 transition-colors mb-8">
                        <div class="mb-4">
                            <i class="far fa-comment-dots text-emerald-500 text-3xl"></i>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Bergabung dalam Diskusi</h4>
                        <p class="text-gray-600 mb-6">Login untuk memberikan komentar dan berbagi pendapat Anda dengan
                            pengunjung lainnya</p>
                        <div class="space-y-3">
                            <a href="{{ route('login') }}"
                                class="block w-full px-6 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transform hover:scale-[1.02] transition-all duration-200">
                                <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                            </a>
                        </div>
                    </div>
                @endauth

                <!-- Comments List -->
                <div class="space-y-6">
                    @forelse($destination->comments()->with('user')->latest()->take(5)->get() as $comment)
                        <div class="group border-b border-gray-100 last:border-0 pb-6">
                            <div class="flex items-start gap-4">
                                <img src="{{ $comment->user?->image ?? 'https://ui-avatars.com/api/?name=' . urlencode($comment->user?->name ?? 'Guest') }}"
                                    alt="{{ $comment->user?->name ?? 'Guest' }}" class="w-10 h-10 rounded-full">
                                <div class="flex-1">
                                    <div class="flex items-start justify-between mb-2">
                                        <div>
                                            <h4 class="font-semibold text-gray-800">
                                                {{ $comment->user?->name ?? 'Guest User' }}
                                            </h4>
                                            <span class="text-sm text-gray-500">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        @auth
                                            @if (auth()->id() === $comment->user_id)
                                                <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <button class="text-gray-400 hover:text-red-500">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            @endif
                                        @endauth
                                    </div>
                                    <p class="text-gray-600 mb-3">{{ $comment->content }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <div class="text-gray-400 mb-3">
                                <i class="far fa-comments text-4xl"></i>
                            </div>
                            <p class="text-gray-500">Belum ada komentar untuk destinasi ini.</p>
                            <p class="text-sm text-gray-400">Jadilah yang pertama memberikan komentar!</p>
                        </div>
                    @endforelse
                </div>
            </section>
        </div>
    </main>
@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const starContainer = document.getElementById('starContainer');
            const starLabels = document.querySelectorAll('.star-label');
            const starInputs = document.querySelectorAll('.star-input');

            // Function to update stars color
            function updateStars(selectedRating) {
                starLabels.forEach(label => {
                    const rating = parseInt(label.getAttribute('data-rating'));
                    if (rating <= selectedRating) {
                        label.classList.add('text-yellow-400');
                        label.classList.remove('text-gray-300');
                    } else {
                        label.classList.remove('text-yellow-400');
                        label.classList.add('text-gray-300');
                    }
                });
            }

            // Handle click events
            starLabels.forEach(label => {
                label.addEventListener('click', function() {
                    const rating = parseInt(this.getAttribute('data-rating'));
                    updateStars(rating);
                });

                // Optional: Handle hover effects
                label.addEventListener('mouseenter', function() {
                    const rating = parseInt(this.getAttribute('data-rating'));
                    updateStars(rating);
                });
            });

            // Optional: Reset stars when mouse leaves the container
            starContainer.addEventListener('mouseleave', function() {
                const checkedInput = document.querySelector('.star-input:checked');
                if (checkedInput) {
                    const rating = parseInt(checkedInput.value);
                    updateStars(rating);
                } else {
                    updateStars(0);
                }
            });
        });
    </script>
@endpush
