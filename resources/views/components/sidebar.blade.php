<div x-data="{ isSidebarOpen: false }" class="relative z-50">
    <!-- Mobile Menu Toggle Button -->
    <button @click="isSidebarOpen = !isSidebarOpen" aria-label="Toggle navigation menu"
        class="lg:hidden fixed top-4 left-4 z-50 p-2 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 transition-colors">
        <i class="fas" :class="isSidebarOpen ? 'fa-times' : 'fa-bars'"></i>
    </button>

    <aside
        class="fixed top-0 left-0 z-40 transition-all duration-300 transform h-screen
        backdrop-blur-xl border-r border-emerald-100 shadow-lg w-64 flex flex-col
        bg-gradient-to-b from-white/80 to-emerald-50/80"
        :class="isSidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">
        @php
            use Spatie\Permission\Models\Permission;

            $menuItems = [
                [
                    'route' => 'dashboard',
                    'label' => 'Dashboard',
                    'icon' => 'fas fa-leaf',
                    'permission' => 'view-dashboard',
                ],
                [
                    'route' => 'profile.index',
                    'label' => 'Profile',
                    'icon' => 'fas fa-user',
                    'permission' => 'view-profile',
                ],
                [
                    'route' => 'blogs.index',
                    'label' => 'Blog',
                    'icon' => 'fas fa-blog',
                    'permission' => 'view-blogs',
                ],
                [
                    'route' => 'events.index',
                    'label' => 'Event',
                    'icon' => 'fas fa-calendar-alt',
                    'permission' => 'view-events',
                ],
                [
                    'route' => 'destinations.index',
                    'label' => 'Wisata',
                    'icon' => 'fas fa-map-marked-alt',
                    'permission' => 'view-destinations',
                ],
                [
                    'route' => 'faqs.index',
                    'label' => 'FAQ',
                    'icon' => 'fas fa-question-circle',
                    'permission' => 'view-faqs',
                ],
            ];
        @endphp

        <!-- Profile Section -->
        <div
            class="flex-shrink-0 px-6 py-6 border-b border-emerald-100 bg-gradient-to-br from-emerald-600 via-green-700 to-emerald-800 relative overflow-hidden">
            <!-- Animated Nature Elements -->
            <div class="absolute inset-0 pointer-events-none opacity-10">
                <i class="fas fa-leaf absolute animate-float-1 text-white text-xl top-4 left-4"></i>
                <i class="fas fa-leaf absolute animate-float-2 text-white text-lg top-8 right-8"></i>
                <i class="fas fa-leaf absolute animate-float-3 text-white text-sm bottom-4 left-8"></i>
            </div>

            <div class="flex items-center space-x-4">
                <div class="relative group/profile flex-shrink-0">
                    @php
                        $name = Auth::user()->name;
                        $initials = collect(explode(' ', $name))
                            ->map(function ($segment) {
                                return strtoupper(substr($segment, 0, 1));
                            })
                            ->take(2)
                            ->join('');
                    @endphp

                    @if (Auth::user()->image)
                        <div class="relative overflow-hidden h-12 w-12 lg:h-16 lg:w-16 rounded-full">
                            <img class="h-full w-full object-cover ring-4 ring-emerald-400/20 transition-all duration-300 group-hover/profile:scale-110 group-hover/profile:ring-emerald-400/40"
                                src="{{ asset('storage/images/users/' . Auth::user()->image) }}"
                                alt="{{ Auth::user()->name }}">
                        </div>
                    @else
                        <div
                            class="h-12 w-12 lg:h-16 lg:w-16 rounded-full bg-emerald-500 flex items-center justify-center ring-4 ring-emerald-400/30 transition-all duration-300 group-hover/profile:ring-emerald-400/50">
                            <span class="text-base lg:text-lg font-medium text-white">{{ $initials }}</span>
                        </div>
                    @endif

                    <span
                        class="absolute bottom-1 right-1 w-3 h-3 lg:w-4 lg:h-4 bg-emerald-400 border-2 border-white rounded-full shadow-lg animate-pulse"></span>
                </div>

                <div class="flex flex-col min-w-0 flex-1">
                    <h2 class="text-lg lg:text-xl font-bold text-white truncate tracking-tight group/name relative"
                        title="{{ Auth::user()->name ?? 'User Name' }}">
                        {{ Auth::user()->name ?? 'User Name' }}
                        <span
                            class="absolute left-0 -bottom-8 hidden group-hover/name:block bg-emerald-900 text-white text-sm px-2 py-1 rounded whitespace-nowrap z-10">
                            {{ Auth::user()->name ?? 'User Name' }}
                        </span>
                    </h2>
                    <span class="text-xs lg:text-sm text-emerald-100 font-medium tracking-wide truncate">
                        {{ Auth::user()->getRoleNames()->first() ?? 'User' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav
            class="flex-1 px-2 lg:px-4 py-4 lg:py-6 space-y-1 lg:space-y-2 overflow-y-auto scrollbar-thin scrollbar-thumb-emerald-200 scrollbar-track-transparent hover:scrollbar-thumb-emerald-300">
            @foreach ($menuItems as $item)
                @can($item['permission'])
                    <a href="{{ route($item['route']) }}"
                        aria-current="{{ request()->routeIs($item['route']) ? 'page' : 'false' }}"
                        class="group flex items-center px-3 lg:px-4 py-2.5 lg:py-3.5 rounded-xl transition-all duration-300
                        {{ request()->routeIs($item['route'])
                            ? 'bg-gradient-to-r from-emerald-500 to-green-600 text-white shadow-lg shadow-emerald-500/30 scale-105'
                            : 'text-emerald-800 hover:bg-emerald-50 hover:text-emerald-600 hover:shadow-md hover:scale-[1.02]' }}">
                        <div class="relative">
                            <i class="{{ $item['icon'] }}"></i>
                            @if (request()->routeIs($item['route']))
                                <span
                                    class="absolute -right-1 -top-1 w-1.5 h-1.5 lg:w-2 lg:h-2 bg-white rounded-full"></span>
                            @endif
                        </div>
                        <span class="ml-3 lg:ml-4 font-semibold tracking-wide hidden sm:inline-block">
                            {{ $item['label'] }}
                        </span>
                    </a>
                @endcan
            @endforeach
        </nav>

        <!-- Logout Button -->
        <div class="flex-shrink-0 px-4 lg:px-6 py-4 lg:py-6 border-t border-emerald-100 bg-white/80 backdrop-blur-sm">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="group flex items-center justify-center w-full px-3 lg:px-4 py-2.5 lg:py-3.5 text-sm font-semibold text-white
                        bg-gradient-to-br from-emerald-600 via-green-700 to-emerald-800 rounded-xl
                        transition-all duration-300
                        hover:shadow-lg hover:shadow-emerald-500/30 hover:scale-[1.02]
                        focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2
                        active:scale-95">
                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-12" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    <span class="ml-2 tracking-wider hidden sm:inline-block">Sign Out</span>
                </button>
            </form>
        </div>
    </aside>
</div>


<style>
    @media (max-width: 640px) {
        .xs\:w-16 {
            width: 4rem;
        }
    }

    @keyframes float {
        0% {
            transform: translate(0, 0) rotate(0deg);
        }

        50% {
            transform: translate(10px, -10px) rotate(180deg);
        }

        100% {
            transform: translate(0, 0) rotate(360deg);
        }
    }

    .animate-float-1 {
        animation: float 8s infinite ease-in-out;
    }

    .animate-float-2 {
        animation: float 10s infinite ease-in-out;
    }

    .animate-float-3 {
        animation: float 12s infinite ease-in-out;
    }

    /* Custom Scrollbar Styling */
    .scrollbar-thin {
        scrollbar-width: thin;
    }

    .scrollbar-thin::-webkit-scrollbar {
        width: 6px;
    }

    .scrollbar-thin::-webkit-scrollbar-track {
        background: transparent;
    }

    .scrollbar-thin::-webkit-scrollbar-thumb {
        background-color: rgb(167 243 208);
        /* emerald-200 */
        border-radius: 20px;
    }

    .scrollbar-thin:hover::-webkit-scrollbar-thumb {
        background-color: rgb(110 231 183);
        /* emerald-300 */
    }

    @media (max-width: 1023px) {
        aside {
            width: 100%;
            max-width: 300px;
        }
    }
</style>
