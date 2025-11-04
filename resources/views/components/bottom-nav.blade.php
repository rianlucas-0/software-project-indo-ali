<nav
    class="fixed bottom-0 left-0 right-0 z-40 bg-white dark:bg-[#0D1117] border-t border-gray-200 dark:border-gray-700 flex justify-around py-2 text-gray-700 dark:text-white md:hidden">
    <a href="{{ route('home') }}" class="flex flex-col items-center text-sm hover:text-blue-600 dark:hover:text-blue-400 transition-colors px-2">
        <i class="fas fa-home text-lg mb-1"></i>
        <span class="text-xs">Início</span>
    </a>

    <a href="{{ route('search.index') }}"
        class="flex flex-col items-center text-sm hover:text-blue-600 dark:hover:text-blue-400 transition-colors px-2">
        <i class="fas fa-search text-lg mb-1"></i>
        <span class="text-xs">Buscar</span>
    </a>

    @auth
    <a href="{{ route('favorites.index') }}"
        class="flex flex-col items-center text-sm hover:text-blue-600 dark:hover:text-blue-400 transition-colors px-2">
        <i class="fas fa-heart text-lg mb-1"></i>
        <span class="text-xs">Favoritos</span>
    </a>
    @endauth

    <div class="relative" x-data="{ optionsOpen: false }">
        <button @click="optionsOpen = !optionsOpen"
            class="flex flex-col items-center text-sm hover:text-blue-600 dark:hover:text-blue-400 transition-colors px-2">
            <i class="fas fa-cog text-lg mb-1"></i>
            <span class="text-xs">Opções</span>
        </button>

        <div x-show="optionsOpen" @click.away="optionsOpen = false"
            x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-3 w-48 bg-white dark:bg-[#161B22] rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 py-1 z-50">

            @auth
            <a href="{{ route('profile.edit') }}"
                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#1E2229] hover:text-gray-900 dark:hover:text-white flex items-center">
                <i class="fas fa-user-edit mr-2 text-blue-500 dark:text-blue-400"></i> Perfil
            </a>

            @if(Auth::user()->user_type === 'admin')
            <a href="{{ route('admin.dashboard') }}"
                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#1E2229] hover:text-gray-900 dark:hover:text-white flex items-center">
                <i class="fas fa-tachometer-alt mr-2 text-blue-500 dark:text-blue-400"></i> Dashboard
            </a>
            @endif

            <a href="{{ route('preferences.edit') }}"
                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#1E2229] hover:text-gray-900 dark:hover:text-white flex items-center">
                <i class="fas fa-sliders-h mr-2 text-blue-500 dark:text-blue-400"></i> Preferências
            </a>

            <a href="{{ route('history') }}"
                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#1E2229] hover:text-gray-900 dark:hover:text-white flex items-center">
                <i class="fas fa-history mr-2 text-blue-500 dark:text-blue-400"></i> Histórico
            </a>

            @if(Auth::user()->user_type == 'admin')
            <a href="{{ route('admin.addlocal') }}"
                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#1E2229] hover:text-gray-900 dark:hover:text-white flex items-center">
                <i class="fas fa-plus-circle mr-2 text-blue-500 dark:text-blue-400"></i> Adicionar Local
            </a>
            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#1E2229] hover:text-gray-900 dark:hover:text-white flex items-center">
                    <i class="fas fa-sign-out-alt mr-2 text-blue-500 dark:text-blue-400"></i> Sair
                </button>
            </form>
            @else
            <a href="{{ route('login') }}"
                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#1E2229] hover:text-gray-900 dark:hover:text-white flex items-center">
                <i class="fas fa-sign-in-alt mr-2 text-blue-500 dark:text-blue-400"></i> Entrar
            </a>
            @endauth

            {{-- Separador --}}
            <div class="border-t border-gray-300 dark:border-gray-700 my-1"></div>

            {{-- Botão de troca de tema --}}
            <button
                @click="$store.theme.toggle(); optionsOpen = false"
                class="w-full text-left px-4 py-2 text-sm flex items-center gap-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] text-gray-700 dark:text-gray-300 transition-colors"
                aria-label="Alternar tema"
            >
                <!-- ícone: mostra lua quando estiver em dark, mostra sol quando em light -->
                <span x-show="$store.theme.current === 'dark'" x-cloak class="flex items-center gap-2">
                    <!-- Sol para modo escuro (quando quer mudar para claro) -->
                    <div class="w-4 h-4 flex items-center justify-center">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 17C14.7614 17 17 14.7614 17 12C17 9.23858 14.7614 7 12 7C9.23858 7 7 9.23858 7 12C7 14.7614 9.23858 17 12 17Z" 
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 1V3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 21V23" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4.22 4.22L5.64 5.64" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M18.36 18.36L19.78 19.78" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M1 12H3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M21 12H23" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4.22 19.78L5.64 18.36" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M18.36 5.64L19.78 4.22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    Mudar para claro
                </span>

                <span x-show="$store.theme.current === 'light'" x-cloak class="flex items-center gap-2">
                    <!-- Lua para modo claro (quando quer mudar para escuro) -->
                    <div class="w-4 h-4 flex items-center justify-center">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" 
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="currentColor"/>
                        </svg>
                    </div>
                    Mudar para escuro
                </span>
            </button>
        </div>
    </div>
</nav>