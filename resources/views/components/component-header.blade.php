<header class="fixed top-0 left-0 right-0 z-50 bg-[#0D1117]/95 backdrop-blur-sm shadow-lg border-b border-gray-800/50"
    x-data="{ optionsOpen: false }" role="banner">
    <div class="max-w-screen-xl mx-auto flex items-center justify-between py-4 px-6">
        <a href="{{ route('home') }}"
            class="text-white text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent">
            Indo Ali
        </a>

        <nav class="hidden md:block">
            <ul class="flex space-x-6 text-white font-medium items-center">
                <li>
                    <a href="{{ route('home') }}"
                        class="hover:text-blue-400 transition-colors duration-200 flex items-center gap-1.5 group">
                        <span class="group-hover:translate-x-0.5 transition-transform">Início</span>
                        <i class="fas fa-home text-sm opacity-70"></i>
                    </a>
                </li>

                <li>
                    <a href="{{ route('search.index') }}"
                        class="hover:text-blue-400 transition-colors duration-200 flex items-center gap-1.5 group">
                        <span class="group-hover:translate-x-0.5 transition-transform">Buscar</span>
                        <i class="fas fa-search text-sm opacity-70"></i>
                    </a>
                </li>

                @auth
                <li>
                    <a href="{{ route('favorites.index') }}"
                        class="hover:text-blue-400 transition-colors duration-200 flex items-center gap-1.5 group">
                        <span class="group-hover:translate-x-0.5 transition-transform">Favoritos</span>
                        <i class="fas fa-heart text-sm opacity-70"></i>
                    </a>
                </li>
                @endauth

                <li class="relative">
                    <button @click="optionsOpen = !optionsOpen"
                        class="hover:text-blue-400 transition-colors duration-200 flex items-center gap-1.5 group">
                        <span class="group-hover:translate-x-0.5 transition-transform">Opções</span>
                        <i class="fas fa-cog text-sm opacity-70"></i>
                    </button>

                    <div x-show="optionsOpen" @click.away="optionsOpen = false"
                        class="absolute right-0 mt-2 w-48 bg-[#161B22] rounded-md shadow-lg py-1 border border-gray-700 z-50">
                        @auth
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm text-gray-300 hover:bg-[#1E2229] hover:text-white flex items-center">
                            <i class="fas fa-user-edit mr-2"></i> Perfil
                        </a>

                        <a href="{{ Auth::user()->user_type == 'admin' ? route('admin.dashboard') : route('dashboard') }}"
                            class="block px-4 py-2 text-sm text-gray-300 hover:bg-[#1E2229] hover:text-white flex items-center">
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                        </a>

                        <a href="{{ route('history') }}"
                            class="block px-4 py-2 text-sm text-gray-300 hover:bg-[#1E2229] hover:text-white flex items-center">
                            <i class="fas fa-history mr-2"></i> Histórico
                        </a>

                        @if(Auth::user()->user_type == 'admin')
                        <a href="{{ route('admin.addlocal') }}"
                            class="block px-4 py-2 text-sm text-gray-300 hover:bg-[#1E2229] hover:text-white flex items-center">
                            <i class="fas fa-plus-circle mr-2"></i> Adicionar Local
                        </a>
                        <a href="{{ route('admin.all_local') }}"
                            class="block px-4 py-2 text-sm text-gray-300 hover:bg-[#1E2229] hover:text-white flex items-center">
                            <i class="fas fa-map-marked-alt mr-2"></i> Seus Locais
                        </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-[#1E2229] hover:text-white flex items-center">
                                <i class="fas fa-sign-out-alt mr-2"></i> Sair
                            </button>
                        </form>
                        @else
                        <a href="{{ route('login') }}"
                            class="block px-4 py-2 text-sm text-gray-300 hover:bg-[#1E2229] hover:text-white flex items-center">
                            <i class="fas fa-sign-in-alt mr-2"></i> Entrar
                        </a>
                        @endauth
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</header>