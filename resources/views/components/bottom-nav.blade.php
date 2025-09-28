<nav
    class="fixed bottom-0 left-0 right-0 z-40 bg-[#0D1117] border-t border-gray-700 flex justify-around py-2 text-white md:hidden">
    <a href="{{ route('home') }}" class="flex flex-col items-center text-sm hover:text-blue-400 transition-colors px-2">
        <i class="fas fa-home text-lg mb-1"></i>
        <span class="text-xs">Início</span>
    </a>

    <a href="{{ route('search.index') }}"
        class="flex flex-col items-center text-sm hover:text-blue-400 transition-colors px-2">
        <i class="fas fa-search text-lg mb-1"></i>
        <span class="text-xs">Buscar</span>
    </a>

    @auth
    <a href="{{ route('favorites.index') }}"
        class="flex flex-col items-center text-sm hover:text-blue-400 transition-colors px-2">
        <i class="fas fa-heart text-lg mb-1"></i>
        <span class="text-xs">Favoritos</span>
    </a>
    @endauth

    <div class="relative" x-data="{ optionsOpen: false }">
        <button @click="optionsOpen = !optionsOpen"
            class="flex flex-col items-center text-sm hover:text-blue-400 transition-colors px-2">
            <i class="fas fa-cog text-lg mb-1"></i>
            <span class="text-xs">Opções</span>
        </button>

        <div x-show="optionsOpen" @click.away="optionsOpen = false"
            x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-3 w-48 bg-[#161B22] rounded-lg shadow-xl border border-gray-700 py-1 z-50">

            @auth
            <a href="{{ route('profile.edit') }}"
                class="block px-4 py-2 text-sm text-gray-300 hover:bg-[#1E2229] hover:text-white flex items-center">
                <i class="fas fa-user-edit mr-2 text-blue-400"></i> Perfil
            </a>

            @if(Auth::user()->user_type === 'admin')
            <a href="{{ route('admin.dashboard') }}"
                class="block px-4 py-2 text-sm text-gray-300 hover:bg-[#1E2229] hover:text-white flex items-center">
                <i class="fas fa-tachometer-alt mr-2 text-blue-400"></i> Dashboard
            </a>
            @endif

            <a href="{{ route('history') }}"
                class="block px-4 py-2 text-sm text-gray-300 hover:bg-[#1E2229] hover:text-white flex items-center">
                <i class="fas fa-history mr-2 text-blue-400"></i> Histórico
            </a>

            @if(Auth::user()->user_type == 'admin')
            <a href="{{ route('admin.addlocal') }}"
                class="block px-4 py-2 text-sm text-gray-300 hover:bg-[#1E2229] hover:text-white flex items-center">
                <i class="fas fa-plus-circle mr-2 text-blue-400"></i> Adicionar Local
            </a>
            <a href="{{ route('admin.all_local') }}"
                class="block px-4 py-2 text-sm text-gray-300 hover:bg-[#1E2229] hover:text-white flex items-center">
                <i class="fas fa-map-marked-alt mr-2 text-blue-400"></i> Seus Locais
            </a>
            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="block w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-[#1E2229] hover:text-white flex items-center">
                    <i class="fas fa-sign-out-alt mr-2 text-blue-400"></i> Sair
                </button>
            </form>
            @else
            <a href="{{ route('login') }}"
                class="block px-4 py-2 text-sm text-gray-300 hover:bg-[#1E2229] hover:text-white flex items-center">
                <i class="fas fa-sign-in-alt mr-2 text-blue-400"></i> Entrar
            </a>
            @endauth
        </div>
    </div>
</nav>