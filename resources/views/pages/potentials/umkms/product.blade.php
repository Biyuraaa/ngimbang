@extends('layouts.guest')

@section('title', $umkm->name . ' - UMKM Desa Gunungsari')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-amber-50 via-orange-50/30 to-white">

        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="bg-white rounded-2xl shadow-lg border border-amber-100 overflow-hidden mb-12">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Image Gallery -->
                    <div class="p-6 lg:p-8">
                        <div class="relative aspect-square rounded-xl overflow-hidden mb-4 group">
                            <img src="{{ asset('storage/images/products/' . $product->thumbnail) }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                id="mainImage">
                        </div>

                        <!-- Thumbnail Gallery -->
                        <div class="grid grid-cols-4 gap-4">
                            @foreach ($product->galleries as $image)
                                <div
                                    class="aspect-square rounded-lg overflow-hidden border-2 border-transparent hover:border-amber-500 cursor-pointer transition-all duration-200 hover:scale-105">
                                    <img src="{{ asset('storage/' . $image->path) }}" alt="Product image"
                                        class="w-full h-full object-cover thumbnail-img"
                                        onclick="updateMainImage(this.src)">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="p-6 lg:p-8 bg-gradient-to-br from-amber-50/50 via-transparent to-transparent">
                        <div class="mb-6">
                            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>
                            <div class="flex items-center gap-4 mb-6">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-star text-amber-400"></i>
                                    <span class="font-medium">{{ number_format($product->ratings->avg('score'), 1) }}</span>
                                    <span class="text-gray-500">({{ $product->ratings->count() }} ulasan)</span>
                                </div>
                                <span class="text-gray-300">|</span>
                                <span class="text-gray-600">{{ $product->category->name }}</span>
                            </div>
                            <div
                                class="text-3xl font-bold bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent mb-4">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                        </div>

                        <div class="prose prose-amber mb-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi Produk</h3>
                            <p class="text-gray-600 whitespace-pre-line">{{ $product->description }}</p>
                        </div>

                        <!-- Marketplace Links -->
                        <div class="space-y-4 mb-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Beli di Marketplace</h3>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                @forelse($product->socialMedia as $socialMedia)
                                    <a href="{{ $socialMedia->url }}" target="_blank" rel="noopener noreferrer"
                                        class="flex items-center gap-3 p-4 rounded-xl border border-gray-100 hover:border-gray-200 
                       bg-white hover:bg-gray-50 transition-all duration-300 group">

                                        @switch(strtolower($socialMedia->socialMedia->platform))
                                            @case('shopee')
                                                <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-orange-50">
                                                    <i
                                                        class="fab fa-shopify text-orange-500 text-xl group-hover:scale-110 transition-transform"></i>
                                                </div>
                                                <div class="flex-grow">
                                                    <h4 class="font-medium text-gray-800">Shopee</h4>
                                                    <p class="text-sm text-gray-500">
                                                        {{ $socialMedia->username ?? 'Kunjungi Toko' }}</p>
                                                </div>
                                            @break

                                            @case('tokopedia')
                                                <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-green-50">
                                                    <i
                                                        class="fas fa-store text-green-500 text-xl group-hover:scale-110 transition-transform"></i>
                                                </div>
                                                <div class="flex-grow">
                                                    <h4 class="font-medium text-gray-800">Tokopedia</h4>
                                                    <p class="text-sm text-gray-500">
                                                        {{ $socialMedia->username ?? 'Kunjungi Toko' }}</p>
                                                </div>
                                            @break

                                            @case('bukalapak')
                                                <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-red-50">
                                                    <i
                                                        class="fas fa-shopping-bag text-red-500 text-xl group-hover:scale-110 transition-transform"></i>
                                                </div>
                                                <div class="flex-grow">
                                                    <h4 class="font-medium text-gray-800">Bukalapak</h4>
                                                    <p class="text-sm text-gray-500">
                                                        {{ $socialMedia->username ?? 'Kunjungi Toko' }}</p>
                                                </div>
                                            @break

                                            @default
                                                <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-gray-50">
                                                    <i
                                                        class="fas fa-shopping-cart text-gray-500 text-xl group-hover:scale-110 transition-transform"></i>
                                                </div>
                                                <div class="flex-grow">
                                                    <h4 class="font-medium text-gray-800">{{ $socialMedia->socialMedia->platform }}
                                                    </h4>
                                                    <p class="text-sm text-gray-500">
                                                        {{ $socialMedia->username ?? 'Kunjungi Toko' }}</p>
                                                </div>
                                        @endswitch
                                    </a>
                                    @empty
                                        <div class="col-span-full">
                                            <div class="text-center py-6 bg-gray-50 rounded-xl border border-gray-100">
                                                <p class="text-gray-500">Belum ada marketplace yang terhubung</p>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="bg-white rounded-2xl shadow-md p-8 my-12">
                    <!-- Rating Summary -->
                    <div class="grid md:grid-cols-2 gap-8 mb-8 pb-8 border-b border-gray-100">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 mb-4">Ulasan Pembeli</h2>
                            <div class="flex items-center gap-4">
                                <!-- Average Score -->
                                <div class="text-center">
                                    <div class="text-4xl font-bold text-gray-800">
                                        {{ number_format($product->ratings()->avg('score'), 1) }}
                                    </div>
                                    <div class="flex items-center gap-1 text-amber-400 my-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i
                                                class="fas fa-star {{ $i <= round($product->ratings()->avg('score')) ? 'text-amber-400' : 'text-gray-300' }}"></i>
                                        @endfor
                                    </div>
                                    <div class="text-sm text-gray-500">{{ $product->ratings()->count() }} ulasan</div>
                                </div>

                                <!-- Rating Distribution -->
                                <div class="flex-1">
                                    @for ($i = 5; $i >= 1; $i--)
                                        @php
                                            $count = $product->ratings()->where('score', $i)->count();
                                            $percentage =
                                                $product->ratings()->count() > 0
                                                    ? ($count / $product->ratings()->count()) * 100
                                                    : 0;
                                        @endphp
                                        <div class="flex items-center gap-2 text-sm mb-1">
                                            <div class="w-12">{{ $i }} <i class="fas fa-star text-amber-400"></i>
                                            </div>
                                            <div class="flex-1 h-2 bg-gray-100 rounded-full">
                                                <div class="h-2 bg-amber-400 rounded-full" style="width: {{ $percentage }}%">
                                                </div>
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
                                $userRating = $product->ratings()->where('user_id', auth()->id())->first();
                            @endphp
                            @if ($userRating)
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Ulasan Anda</h3>
                                    <div class="bg-amber-50 rounded-xl p-6">
                                        <div class="flex items-center gap-2 mb-4">
                                            <div class="flex items-center gap-1">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i
                                                        class="fas fa-star text-2xl {{ $i <= $userRating->score ? 'text-amber-400' : 'text-gray-300' }}"></i>
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
                                        <input type="hidden" name="rateable_type" value="{{ get_class($product) }}">
                                        <input type="hidden" name="rateable_id" value="{{ $product->id }}">

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
                                                class="w-full px-4 py-3 rounded-xl border @error('review') border-red-500 @else border-gray-200 @enderror focus:ring-2 focus:ring-amber-500 focus:border-amber-500"
                                                placeholder="Bagikan pengalaman Anda dengan produk ini...">{{ old('review') }}</textarea>
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
                                            class="w-full mt-3 px-6 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors">
                                            Kirim Ulasan
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @else
                            <div
                                class="bg-amber-50/80 backdrop-blur-sm rounded-xl p-8 text-center border border-gray-100 hover:border-amber-100 transition-colors">
                                <div class="mb-4">
                                    <i class="fas fa-lock text-amber-500 text-3xl"></i>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-2">Bagikan Pengalaman Anda</h4>
                                <p class="text-gray-600 mb-6">Login untuk memberikan ulasan dan berbagi pengalaman Anda dengan
                                    pembeli lainnya</p>
                                <div class="space-y-3">
                                    <a href="{{ route('login') }}"
                                        class="block w-full px-6 py-2.5 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transform hover:scale-[1.02] transition-all duration-200">
                                        <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                                    </a>
                                </div>
                            </div>
                        @endauth
                    </div>

                    <!-- Reviews List -->
                    <div class="space-y-6">
                        @forelse($product->ratings()->with('user')->latest()->take(5)->get() as $rating)
                            <div
                                class="group border-b border-gray-100 last:border-0 pb-6 hover:bg-amber-50/50 rounded-xl transition-colors p-4">
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
                                                                class="fas fa-star {{ $i <= $rating->score ? 'text-amber-400' : 'text-gray-200' }} text-sm"></i>
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
                                <p class="text-gray-500">Belum ada ulasan untuk produk ini.</p>
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
                            <h2 class="text-2xl font-bold text-gray-800">Ulasan & Diskusi Produk</h2>
                            <p class="text-gray-500 mt-1">{{ $product->comments->count() }} ulasan</p>
                        </div>
                    </div>

                    <!-- Comment Form -->
                    @auth
                        <div class="mb-8">
                            <form action="{{ route('comments.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="commentable_id" value="{{ $product->id }}">
                                <input type="hidden" name="commentable_type" value="App\Models\Product">
                                <div class="flex items-start gap-4">
                                    <div class="flex-1">
                                        <textarea name="content" rows="3"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-amber-500 focus:border-amber-500"
                                            placeholder="Bagikan pengalaman Anda dengan produk ini..."></textarea>
                                        <div class="flex justify-end mt-2">
                                            <button type="submit"
                                                class="px-6 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors">
                                                Kirim Ulasan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        <div
                            class="bg-gray-50/80 backdrop-blur-sm rounded-xl p-8 text-center border border-gray-100 hover:border-amber-100 transition-colors mb-8">
                            <div class="mb-4">
                                <i class="far fa-comment-dots text-amber-500 text-3xl"></i>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-800 mb-2">Bergabung dalam Diskusi Produk</h4>
                            <p class="text-gray-600 mb-6">Login untuk memberikan ulasan dan berbagi pengalaman Anda dengan
                                pembeli lainnya</p>
                            <div class="space-y-3">
                                <a href="{{ route('login') }}"
                                    class="block w-full px-6 py-2.5 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transform hover:scale-[1.02] transition-all duration-200">
                                    <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                                </a>
                            </div>
                        </div>
                    @endauth

                    <!-- Comments List -->
                    <div class="space-y-6">
                        @forelse($product->comments()->with('user')->latest()->take(5)->get() as $comment)
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
                                <p class="text-gray-500">Belum ada ulasan untuk produk ini.</p>
                                <p class="text-sm text-gray-400">Jadilah yang pertama memberikan ulasan!</p>
                            </div>
                        @endforelse
                    </div>
                </section>


            </div>
        </div>
    @endsection

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
