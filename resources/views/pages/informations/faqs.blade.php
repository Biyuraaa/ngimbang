@extends('layouts.guest')
@section('title', 'FAQ - Frequently Asked Questions')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-emerald-50 via-emerald-50/50 to-white">
        <!-- Hero Section with Visual Elements -->
        <div
            class="relative bg-gradient-to-br from-emerald-600 via-emerald-500 to-green-600 pt-20 pb-32 lg:pb-40 overflow-hidden">
            <!--  Pattern -->
            <div class="absolute inset-0 opacity-15">
                <div class="absolute inset-0 pattern-grid"></div>
            </div>

            <!-- Main Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center">
                    <!-- Animated Icon -->
                    <div
                        class="mx-auto w-24 h-24 bg-gradient-to-br from-emerald-400 to-green-500 rounded-3xl flex items-center justify-center mb-8 transform hover:rotate-12 transition-all duration-500 shadow-lg hover:shadow-xl group cursor-pointer hover:scale-105">
                        <i
                            class="fas fa-question-circle text-5xl text-white group-hover:scale-110 transition-all duration-500"></i>
                    </div>

                    <!-- Title with Animation -->
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 tracking-tight animate-fade-in">
                        Frequently Asked Questions
                    </h1>

                    <!-- Subtitle -->
                    <p class="text-xl text-emerald-50 max-w-3xl mx-auto mb-12 leading-relaxed font-light">
                        Temukan jawaban untuk pertanyaan umum seputar layanan di Desa Ngimbang.
                        Kami siap membantu Anda menemukan informasi yang diperlukan.
                    </p>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32 -mt-16">
            <!-- FAQ Grid with  -->
            <div class="grid gap-8" x-data="{ activeFaq: null }">
                @forelse ($faqs as $index => $faq)
                    <!-- FAQ Item -->
                    <div x-data="{ open: false }"
                        @click="activeFaq = (activeFaq === {{ $index }}) ? null : {{ $index }}"
                        :class="{ 'ring-2 ring-emerald-500 ring-opacity-50': activeFaq === {{ $index }} }"
                        class="group bg-white/90 backdrop-blur-md rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 border border-emerald-100/50 cursor-pointer">
                        <!-- Question with Hover Effects -->
                        <div class="px-8 py-6 flex justify-between items-center">
                            <span
                                class="text-left font-medium text-gray-900 text-lg group-hover:text-emerald-700 transition-colors duration-300">
                                {{ $faq->question }}
                            </span>
                            <span class="ml-4 flex-shrink-0">
                                <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center transition-all duration-300"
                                    :class="{ 'bg-emerald-100 rotate-180': activeFaq === {{ $index }} }">
                                    <i class="fas fa-chevron-down text-emerald-600 transition-transform duration-300"
                                        :class="{ 'rotate-180': activeFaq === {{ $index }} }"></i>
                                </div>
                            </span>
                        </div>

                        <!-- Answer with Smooth Animation -->
                        <div x-show="activeFaq === {{ $index }}"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-4" class="px-8 pb-8">
                            <div class="pt-4 border-t border-emerald-100">
                                <p class="text-gray-600 text-lg leading-relaxed">
                                    {{ $faq->answer }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Empty State -->
                    <div
                        class="text-center py-24 bg-white/90 backdrop-blur-md rounded-3xl border border-emerald-100/50 shadow-sm">
                        <div
                            class="w-32 h-32 mx-auto bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-3xl flex items-center justify-center mb-8 transform hover:rotate-12 transition-all duration-500">
                            <i class="fas fa-seedling text-emerald-600 text-5xl"></i>
                        </div>
                        <h3 class="text-3xl font-medium text-gray-900 mb-4">Belum ada FAQ</h3>
                        <p class="text-gray-500 text-xl max-w-md mx-auto">FAQ akan segera ditambahkan untuk membantu Anda.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Animations */
        .pattern-grid {
            background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 24px 24px;
        }


        .animate-fade-in {
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('faqSearch', () => ({
                search: '',
                filterFaqs() {
                    const searchTerm = this.search.toLowerCase();
                    document.querySelectorAll('.faq-item').forEach(item => {
                        const question = item.querySelector('.faq-question').textContent
                            .toLowerCase();
                        const answer = item.querySelector('.faq-answer').textContent
                            .toLowerCase();

                        if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                }
            }));
        });
    </script>
@endpush
