<header
    class="sticky top-0 z-40 flex h-16 w-full border-b border-emerald-100 bg-white/80 backdrop-blur-xl transition-all 
    ">
    <!-- Animated Nature Elements -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <i class="fas fa-leaf absolute animate-float-1 text-emerald-400/30 text-xl top-2 left-1/4"></i>
        <i class="fas fa-leaf absolute animate-float-2 text-green-400/30 text-lg top-4 right-1/3"></i>
        <i class="fas fa-leaf absolute animate-float-3 text-lime-400/30 text-sm bottom-2 right-1/4"></i>
    </div>

    <div class="flex flex-1 items-center justify-between px-4 sm:px-6">
        <!-- Left: Brand -->
        <div class="flex items-center space-x-2 sm:space-x-4 group/brand">
            <div class="relative hidden sm:block">
                <div
                    class="absolute inset-0 bg-emerald-500/20 rounded-full blur-xl group-hover/brand:blur-2xl 
                    transition-all duration-300 opacity-0 group-hover/brand:opacity-100">
                </div>
            </div>
            <div class="flex flex-col">
                <span
                    class="text-lg sm:text-xl font-bold tracking-tight transition-all duration-300 
                    bg-gradient-to-r from-emerald-600 via-green-700 to-emerald-800 bg-clip-text text-transparent 
                    group-hover/brand:tracking-normal">
                    Desa Ngimbang
                </span>
                <span class="text-xs text-emerald-600/80 font-medium hidden sm:inline-block">Sistem Informasi
                    Desa</span>
            </div>
        </div>

        <!-- Right: Utilities -->
        <div class="flex items-center space-x-2 sm:space-x-4">
            <button class="p-2 text-emerald-600 hover:text-emerald-800 transition-colors duration-300">
                <i class="fas fa-bell text-lg"></i>
            </button>
            <button class="p-2 text-emerald-600 hover:text-emerald-800 transition-colors duration-300">
                <i class="fas fa-cog text-lg animate-slow-spin"></i>
            </button>
        </div>
    </div>
</header>

<style>
    @keyframes slow-spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .animate-slow-spin {
        animation: slow-spin 8s linear infinite;
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
</style>
