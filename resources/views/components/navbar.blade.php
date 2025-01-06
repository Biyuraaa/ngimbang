<nav class="bg-gradient-to-r from-emerald-50 via-teal-50 to-green-50 backdrop-blur-sm bg-opacity-80 shadow-lg border-b border-gray-100/20 sticky top-0 z-[999]"
    x-data="{ isOpen: false, dropdowns: { about: false, potensi: false, informasi: false, kelembagaan: false } }">
    <div class="container mx-auto px-6 py-3">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-6">
                <a href="{{ route('home') }}" class="relative group py-2">
                    <div class="relative overflow-hidden transition-all duration-300 group-hover:scale-105">
                        <span
                            class="font-bold text-2xl md:text-3xl bg-gradient-to-r from-emerald-600 to-green-600 bg-clip-text text-transparent tracking-tight hover:tracking-wide transition-all duration-300">
                            Desa Ngimbang
                        </span>
                        <div
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-green-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300">
                        </div>
                    </div>
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button @click="isOpen = !isOpen" class="text-green-700 hover:text-green-900 focus:outline-none">
                    <svg class="h-6 w-6" x-show="!isOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg class="h-6 w-6" x-show="isOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Desktop Menu -->
            <ul class="hidden md:flex items-center space-x-6">
                @foreach ([['name' => 'Tentang Kami', 'route' => '#', 'items' => [['name' => 'Informasi Desa', 'route' => 'informasi-desa'], ['name' => 'Sejarah Desa', 'route' => ''], ['name' => 'Visi dan Misi', 'route' => '']]], ['name' => 'Potensi', 'route' => '#', 'items' => [['name' => 'UMKM', 'route' => '/umkm'], ['name' => 'Wisata', 'route' => '/wisata'], ['name' => 'Peternakan', 'route' => '/peternakan'], ['name' => 'Pertanian', 'route' => '/pertanian']]], ['name' => 'Informasi', 'route' => '#', 'items' => [['name' => 'Blog', 'route' => 'blog'], ['name' => 'Event', 'route' => 'event']]]] as $menu)
                    <li class="relative group" x-data="{ open: false }" @mouseenter="open = true"
                        @mouseleave="open = false">
                        <a href="{{ $menu['route'] }}"
                            class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-green-700 hover:text-green-900 font-medium transition-all duration-300 hover:bg-green-50/50">
                            <span>{{ $menu['name'] }}</span>
                            @if (isset($menu['items']))
                                <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            @endif
                        </a>

                        @if (isset($menu['items']))
                            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-1"
                                class="absolute left-0 mt-2 w-56 rounded-xl bg-white/90 backdrop-blur-lg shadow-lg border border-green-100/50 overflow-hidden"
                                style="display: none;">
                                <div class="py-2">
                                    @foreach ($menu['items'] as $item)
                                        <a href="{{ url($item['route']) }}"
                                            class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:text-green-700 hover:bg-green-50/50 transition-all duration-300">
                                            {{ $item['name'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </li>
                @endforeach

                @auth
                    <div class="flex items-center gap-3 pl-6 border-l border-green-200/50">
                        @if (Auth::user()->can('view-dashboard'))
                            <a href="{{ route('dashboard') }}"
                                class="group px-4 py-2.5 text-sm font-medium text-green-700 hover:text-green-800 bg-green-50/30 hover:bg-green-100/50 rounded-xl hover:shadow-sm transition-all duration-300 flex items-center gap-2">
                                <i class="fas fa-gauge-high transition-transform group-hover:rotate-12"></i>
                                <span>Dashboard</span>
                            </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="group px-4 py-2.5 text-sm font-medium text-red-600 hover:text-red-700 bg-red-50/30 hover:bg-red-100/50 rounded-xl hover:shadow-sm transition-all duration-300 flex items-center gap-2 border border-red-100/50 hover:border-red-200/50">
                                <i
                                    class="fas fa-arrow-right-from-bracket transition-transform group-hover:-translate-x-0.5"></i>
                                <span>Keluar</span>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex items-center gap-4 pl-4 border-l border-green-200">
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 text-sm font-medium text-green-700 hover:text-green-900 rounded-lg hover:bg-green-50/50 transition-all duration-300">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}"
                            class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 shadow-sm hover:shadow transition-all duration-300">
                            Daftar
                        </a>
                    </div>
                @endauth
            </ul>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden" x-show="isOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <!-- About Dropdown (Mobile) -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="w-full text-left block px-3 py-2 rounded-md text-base font-medium text-green-700 hover:text-green-900 hover:bg-green-50">
                        About
                        <svg class="float-right h-5 w-5" :class="{ 'rotate-180': open }"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" class="mt-2 space-y-2 px-4">
                        <a href="{{ route('informasi-desa') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-green-700 hover:text-green-900 hover:bg-green-50">Informasi
                            Desa</a>
                        <a href="{{ url('/sejarah-desa') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-green-700 hover:text-green-900 hover:bg-green-50">Sejarah
                            Desa</a>
                        <a href="{{ url('/visi-misi') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-green-700 hover:text-green-900 hover:bg-green-50">Visi
                            dan Misi</a>
                        <a href="{{ url('/sejarah-dusun') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-green-700 hover:text-green-900 hover:bg-green-50">Sejarah
                            Dusun</a>
                    </div>
                </div>

                <!-- Potensi Dropdown (Mobile) -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="w-full text-left block px-3 py-2 rounded-md text-base font-medium text-green-700 hover:text-green-900 hover:bg-green-50">
                        Potensi
                        <svg class="float-right h-5 w-5" :class="{ 'rotate-180': open }"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" class="mt-2 space-y-2 px-4">
                        <a href="{{ url('/umkm') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-green-700 hover:text-green-900 hover:bg-green-50">UMKM</a>
                        <a href="{{ url('/wisata') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-green-700 hover:text-green-900 hover:bg-green-50">Wisata</a>
                        <a href="{{ url('/kesenian') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-green-700 hover:text-green-900 hover:bg-green-50">Kesenian</a>
                        <a href="{{ url('/peternakan') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-green-700 hover:text-green-900 hover:bg-green-50">Peternakan</a>
                        <a href="{{ url('/pertanian') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-green-700 hover:text-green-900 hover:bg-green-50">Pertanian</a>
                    </div>
                </div>

                <!-- Informasi Dropdown (Mobile) -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="w-full text-left block px-3 py-2 rounded-md text-base font-medium text-green-700 hover:text-green-900 hover:bg-green-50">
                        Informasi
                        <svg class="float-right h-5 w-5" :class="{ 'rotate-180': open }"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" class="mt-2 space-y-2 px-4">
                        <a href="{{ url('/blog') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-green-700 hover:text-green-900 hover:bg-green-50">Blog</a>
                        <a href="{{ url('/event') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-green-700 hover:text-green-900 hover:bg-green-50">Event</a>
                        <a href="{{ url('/faq') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-green-700 hover:text-green-900 hover:bg-green-50">FAQ</a>

                    </div>
                </div>

                @auth
                    <a href="{{ route('dashboard') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-green-700 hover:text-green-900 hover:bg-green-50">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="block px-3 py-2">
                        @csrf
                        <button type="submit"
                            class="w-full text-left text-base font-medium text-red-700 hover:text-red-900">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-green-800 hover:text-green-900">Masuk</a>
                    <a href="{{ route('register') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-white bg-green-700 hover:bg-green-800">Daftar</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
