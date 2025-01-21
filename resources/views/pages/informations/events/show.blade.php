@extends('layouts.guest')

@section('title', $event->title . ' - Event Desa Ngimbang')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-green-50 via-emerald-50 to-white">
        <!-- Hero Section -->
        <div class="relative h-[70vh] overflow-hidden">
            <div class="absolute inset-0">
                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                    class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-b from-black/60 to-black/20"></div>
            </div>
            <div class="relative h-full flex items-center justify-center">
                <div class="text-center text-white px-6 max-w-4xl">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 tracking-tight leading-tight">
                        {{ $event->title }}
                    </h1>

                    <!-- Meta info  -->
                    <div class="flex items-center justify-center space-x-6 text-sm md:text-base">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $event->start_date }} - {{ $event->end_date }}
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $event->start_at }} - {{ $event->end_at }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Improved Main Content -->
        <article class="max-w-4xl mx-auto px-4 py-12">
            <!-- Event Info -->
            <div
                class="flex flex-col md:flex-row items-start justify-between mb-12 p-8 bg-white rounded-2xl shadow-lg transform -mt-20 relative z-10">
                <div class="flex items-center space-x-4 mb-4 md:mb-0">
                    <img src="{{ $event->user->image ?? 'https://ui-avatars.com/api/?name=' . urlencode($event->user->name) }}"
                        alt="{{ $event->user->name }}" class="w-16 h-16 rounded-full ring-4 ring-green-50">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900">{{ $event->user->name }}</h3>
                        <p class="text-green-600 font-medium">Event Organizer</p>
                    </div>
                </div>
                <div class="flex flex-col items-end">
                    <div class="text-right mb-2">
                        <p class="text-sm text-gray-500">Location</p>
                        <p class="font-medium text-gray-800">{{ $event->location }}</p>
                    </div>
                    @if ($event->price)
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Price</p>
                            <p class="font-medium text-gray-800">Rp {{ number_format($event->price, 0, ',', '.') }}</p>
                        </div>
                    @else
                        <p class="font-medium text-green-600">Free Event</p>
                    @endif
                </div>
            </div>

            <!-- Content -->
            <div class="prose prose-green lg:prose-lg max-w-none">
                <div class="text-xl text-gray-600 mb-12 font-medium italic border-l-4 border-green-500 pl-6 py-2">
                    {{ $event->description }}
                </div>

                <div class="space-y-8">
                    @foreach (explode("\n", $event->description) as $paragraph)
                        @if (!empty(trim($paragraph)))
                            <p class="text-gray-800 leading-relaxed">
                                {{ $paragraph }}
                            </p>
                        @endif
                    @endforeach
                </div>

                @if ($event->registration_url)
                    <div class="mt-12 text-center">
                        <a href="{{ $event->registration_url }}" target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Register for this event
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 -mr-1 h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </article>

        <!-- Comments Section -->
        <div
            class="max-w-4xl mx-auto px-4 py-12 sm:py-16 bg-gradient-to-b from-green-50/50 to-white rounded-t-3xl shadow-inner">
            <!-- Section Header -->
            <div class="flex items-center gap-4 group mb-10">
                <div class="bg-green-100 p-3 rounded-xl group-hover:bg-green-200 transition-colors duration-300">
                    <i class="fas fa-comments text-xl text-green-600"></i>
                </div>
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 group-hover:text-green-600 transition-colors">
                        Discussion <span class="text-green-600">({{ $event->comments->count() }})</span>
                    </h2>
                    <p class="text-gray-500 text-sm mt-1">Join the conversation</p>
                </div>
            </div>

            @auth
                <!-- Comment Form -->
                <form action="{{ route('comments.store') }}" method="POST"
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-12">
                    @csrf
                    <input type="hidden" name="commentable_id" value="{{ $event->id }}">
                    <input type="hidden" name="commentable_type" value="App\Models\Event">

                    <div class="flex items-start gap-4 mb-4">
                        <img src="{{ auth()->user()->image ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                            alt="Your avatar" class="w-10 h-10 rounded-full">
                        <div class="flex-1">
                            <textarea id="content" name="content" rows="3" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none"
                                placeholder="Share your thoughts about this event..."></textarea>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-2.5 bg-green-600 text-white rounded-xl hover:bg-green-700 transition-all duration-200 transform hover:-translate-y-0.5">
                            <span>Post Comment</span>
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            @else
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center mb-12">
                    <div class="bg-green-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-lock text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-medium text-gray-900 mb-2">Join the discussion</h3>
                    <p class="text-gray-600 mb-6">Sign in to share your thoughts and interact with other readers</p>
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center gap-2 px-6 py-2.5 bg-green-600 text-white rounded-xl hover:bg-green-700 transition-all duration-200 transform hover:-translate-y-0.5">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Log In to Comment</span>
                    </a>
                </div>
            @endauth

            <!-- Comments List -->
            <div class="space-y-6">
                @forelse($event->comments()->latest()->get() as $comment)
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <img src="{{ $comment->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) }}"
                                alt="{{ $comment->user->name }}" class="w-10 h-10 rounded-full ring-2 ring-green-50">
                        </div>
                        <div class="flex-grow">
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-2">
                                        <span class="font-semibold text-gray-900">{{ $comment->user->name }}</span>
                                        @if ($comment->user_id === $event->user_id)
                                            <span
                                                class="text-xs px-2 py-0.5 bg-green-100 text-green-600 rounded-full">Organizer</span>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <p class="text-gray-800 leading-relaxed">{{ $comment->content }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 bg-white rounded-2xl shadow-sm border border-gray-100">
                        <div class="bg-green-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-comments text-2xl text-green-600"></i>
                        </div>
                        <h3 class="text-xl font-medium text-gray-900 mb-2">No comments yet</h3>
                        <p class="text-gray-600">Be the first to share your thoughts about this event!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @if ($event->status === 'published')
        @push('scripts')
            <script>
                // Increment view count
                fetch(`/api/events/{{ $event->id }}/view`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
            </script>
        @endpush
    @endif
@endsection
