<header class="fixed top-0 left-0 right-0 z-50 bg-[#0D1117]/95 backdrop-blur-sm shadow-lg border-b border-gray-800/50" role="banner">
    <div class="max-w-screen-xl mx-auto flex items-center justify-between py-4 px-6">
        <h1 class="text-white text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent">
            {{ $title ?? 'Indo Ali' }}
        </h1>

        @if (request()->routeIs('home') && Route::has('login'))
        <nav class="hidden md:block p-3">
            <ul class="flex space-x-6 text-white font-medium items-center">
                @auth
                @else
                    <li>
                        <a 
                            href="{{ route('login') }}" 
                            class="px-5 py-2 hover:text-white transition-all duration-300 border border-blue-500/30 rounded-lg bg-blue-500/10 hover:bg-blue-500/20 hover:shadow-blue-500/10 hover:shadow-sm"
                        >
                            Entrar
                        </a>
                    </li>
                @endauth
                <li>
                    <a href="#" class="hover:text-blue-400 transition-colors duration-200 flex items-center gap-1.5 group">
                        <span class="group-hover:translate-x-0.5 transition-transform">Início</span>
                        <i class="fas fa-home text-sm opacity-70"></i>
                    </a>
                </li>
                <li>
                    <a href="#" class="hover:text-blue-400 transition-colors duration-200 flex items-center gap-1.5 group">
                        <span class="group-hover:translate-x-0.5 transition-transform">Buscar</span>
                        <i class="fas fa-search text-sm opacity-70"></i>
                    </a>
                </li>
                @auth
                    <li>
                        <a href="#" class="hover:text-blue-400 transition-colors duration-200 flex items-center gap-1.5 group">
                            <span class="group-hover:translate-x-0.5 transition-transform">Favoritos</span>
                            <i class="fas fa-heart text-sm opacity-70"></i>
                        </a>
                    </li>
                @endauth
                <li>
                    <a 
                        href="{{ auth()->check() ? '#' : route('login') }}" 
                        class="hover:text-blue-400 transition-colors duration-200 flex items-center gap-1.5 group"
                    >
                        <span class="group-hover:translate-x-0.5 transition-transform">Opções</span>
                        <i class="fas fa-cog text-sm opacity-70"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <nav class="block md:hidden p-3">
            <ul class="flex space-x-4 text-white font-medium justify-end items-center">
                @auth
                @else
                    <li>
                        <a href="{{ route('login') }}" class="px-3 py-1.5 hover:text-white transition-all duration-300 border border-blue-500/30 rounded-lg bg-blue-500/10 hover:bg-blue-500/20">
                            Entrar
                        </a>
                    </li>
                @endauth
            </ul>
        </nav>
        @endif
    </div>
</header>