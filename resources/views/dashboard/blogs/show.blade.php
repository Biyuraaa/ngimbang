@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-emerald-50 py-4 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb remains unchanged -->

            <!-- Header Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-4 sm:p-6 mb-4 sm:mb-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                    <div class="flex items-center space-x-4">
                        <div
                            class="bg-gradient-to-br from-emerald-500 to-green-600 p-3 rounded-xl shadow-lg shadow-emerald-200">
                            <i class="fas fa-newspaper text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">{{ $blog->title }}</h2>
                            <p class="text-sm text-emerald-600">Informasi lengkap Blog Desa Ngimbang</p>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('blogs.index') }}"
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
                        <div class="relative h-96">
                            <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{ $blog->title }}"
                                class="w-full h-full object-cover">
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4">
                                <h1 class="text-3xl font-bold text-white">{{ $blog->title }}</h1>
                            </div>
                        </div>
                    </div>

                    <!-- Excerpt -->
                    <div class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Ringkasan</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $blog->excerpt }}</p>
                    </div>

                    <!-- Content -->
                    <div class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Isi Blog</h3>
                        <div class="prose prose-emerald max-w-none">
                            {!! nl2br(e($blog->content)) !!}
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <!-- Blog Information -->
                    <div
                        class="bg-gradient-to-br from-white to-emerald-50/50 rounded-2xl shadow-sm border border-emerald-100 p-6 hover:shadow-md transition-all duration-300 relative overflow-hidden group">
                        <div
                            class="absolute -right-6 -top-6 opacity-5 transform rotate-12 transition-transform group-hover:rotate-45 duration-700">
                            <i class="fas fa-info-circle text-8xl text-emerald-900"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Informasi Blog</h3>
                        <div class="space-y-4">
                            <div class="p-4 rounded-xl bg-white/50 hover:bg-emerald-50/50 transition-all duration-300">
                                <div class="text-sm font-medium text-emerald-600 mb-2">Author</div>
                                <div class="text-gray-700 flex items-center">
                                    <i class="fas fa-user mr-2 text-emerald-500"></i>
                                    <span>{{ $blog->user->name }}</span>
                                </div>
                            </div>
                            <div class="p-4 rounded-xl bg-white/50 hover:bg-emerald-50/50 transition-all duration-300">
                                <div class="text-sm font-medium text-emerald-600 mb-2">Status</div>
                                <div class="text-gray-700 flex items-center">
                                    <i class="fas fa-check-circle mr-2 text-emerald-500"></i>
                                    <span class="capitalize">{{ $blog->status }}</span>
                                </div>
                            </div>
                            <div class="p-4 rounded-xl bg-white/50 hover:bg-emerald-50/50 transition-all duration-300">
                                <div class="text-sm font-medium text-emerald-600 mb-2">Tanggal Publikasi</div>
                                <div class="text-gray-700 flex items-center">
                                    <i class="fas fa-calendar-alt mr-2 text-emerald-500"></i>
                                    <span>{{ $blog->published_at ? $blog->published_at->format('d M Y, H:i') : 'Belum dipublikasi' }}</span>
                                </div>
                            </div>
                            <div class="p-4 rounded-xl bg-white/50 hover:bg-emerald-50/50 transition-all duration-300">
                                <div class="text-sm font-medium text-emerald-600 mb-2">Jumlah View</div>
                                <div class="text-gray-700 flex items-center">
                                    <i class="fas fa-eye mr-2 text-emerald-500"></i>
                                    <span>{{ $blog->view_count }}</span>
                                </div>
                            </div>
                            <div class="p-4 rounded-xl bg-white/50 hover:bg-emerald-50/50 transition-all duration-300">
                                <div class="text-sm font-medium text-emerald-600 mb-2">Tags</div>
                                <div class="flex flex-wrap gap-2">
                                    @forelse ($blog->tags as $tag)
                                        <span class="bg-emerald-100 text-emerald-600 px-2 py-1 rounded-full text-sm">
                                            {{ $tag->name }}
                                        </span>
                                    @empty
                                        <span class="text-gray-500">No tags</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Comments Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-6 mt-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Komentar</h3>
                    <span class="bg-emerald-100 text-emerald-600 px-3 py-1 rounded-full text-sm">
                        {{ $blog->comments->count() }} Komentar
                    </span>
                </div>

                <div class="space-y-4">
                    @forelse ($blog->comments as $comment)
                        <div class="p-4 rounded-xl bg-gray-50 hover:bg-emerald-50/50 transition-all duration-300">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center">
                                        <i class="fas fa-user text-emerald-600"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-medium text-gray-900">{{ $comment->user->name }}</p>
                                        <span
                                            class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="mt-1 text-gray-600">{{ $comment->content }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6 text-gray-500">
                            Belum ada komentar
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
