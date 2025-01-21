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
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-emerald-300 mr-2"></i>
                            <span class="text-emerald-800 font-medium">FAQ</span>
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
                            <i class="fas fa-question-circle text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Daftar FAQ</h2>
                            <p class="text-sm text-emerald-600">Kelola FAQ di Kecamatan Ngimbang</p>
                        </div>
                    </div>

                    <a href="{{ route('faqs.create') }}"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 rounded-xl text-sm font-medium text-white
                    bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700
                    transition-all duration-300 hover:shadow-lg hover:shadow-emerald-200 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah FAQ
                    </a>
                </div>
            </div>

            <!-- Table Section -->
            <div class="bg-white rounded-xl shadow-lg border-0 overflow-hidden">
                {{-- Card Header --}}
                <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-6 py-4">
                    <h2 class="text-white font-semibold text-xl">Daftar FAQ</h2>
                </div>

                {{-- Table Container --}}
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-emerald-50">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-emerald-700">
                                    Pertanyaan
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-emerald-700">
                                    Jawaban
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-emerald-700">
                                    Status
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-emerald-700">
                                    Tanggal Dibuat
                                </th>
                                <th class="px-6 py-4 text-right text-sm font-semibold text-emerald-700">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-emerald-100">
                            @forelse($faqs as $faq)
                                <tr class="hover:bg-emerald-50/60 transition-all duration-200">
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-medium text-gray-900">{{ $faq->question }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center text-gray-600">
                                            <span class="text-sm">{{ Str::limit($faq->answer, 100) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            @if ($faq->status === 'published')
                                                <span
                                                    class="px-2 py-1 text-sm rounded-lg text-green-700 bg-green-50 border border-green-200">
                                                    Published
                                                </span>
                                            @else
                                                <span
                                                    class="px-2 py-1 text-sm rounded-lg text-gray-700 bg-gray-50 border border-gray-200">
                                                    Draft
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center text-gray-600">
                                            <span class="text-sm">
                                                {{ $faq->created_at->format('d M Y') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-3 py-2">
                                        <div class="flex justify-end items-center gap-2">
                                            <a href="{{ route('faqs.edit', $faq) }}"
                                                class="inline-flex items-center px-2 py-1 text-sm rounded-lg text-orange-700 bg-orange-50 border border-orange-200 hover:bg-orange-100 transition-colors duration-200">
                                                <i class="fas fa-edit mr-1.5"></i>
                                                Edit
                                            </a>
                                            <form action="{{ route('faqs.destroy', $faq) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?');"
                                                    class="inline-flex items-center px-2 py-1 text-sm rounded-lg text-red-700 bg-red-50 border border-red-200 hover:bg-red-100 transition-colors duration-200">
                                                    <i class="fas fa-trash mr-1.5"></i>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="bg-emerald-100 rounded-full p-4 mb-4">
                                                <i class="fas fa-question-circle text-emerald-600 text-xl"></i>
                                            </div>
                                            <h3 class="text-emerald-800 font-medium mb-1">Belum ada data FAQ</h3>
                                            <p class="text-emerald-600 text-sm">Silakan tambahkan FAQ baru</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($faqs->hasPages())
                    <div class="px-6 py-4 border-t border-emerald-100">
                        {{ $faqs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
