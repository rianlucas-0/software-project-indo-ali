<header class="fixed top-0 left-0 right-0 z-50 bg-[#0D1117] shadow-md" role="banner">
    <div class="flex items-center justify-between py-4 px-6">
        <h1 class="text-white text-4xl font-semibold">
            {{ $title ?? 'Indo Ali' }}
        </h1>

        @if (request()->routeIs('home'))
            @if (Route::has('login'))
                @auth
                    @if (auth()->user()->user_type == 'admin')
                        <a
                            href="{{ url('/dashboard') }}"
                            class="px-5 py-1.5 text-white font-medium hover:text-blue-400 transition-colors duration-200 rounded-lg text-sm"
                        >
                            Dashboard
                        </a>
                    @endif
                @else
                    <a
                        href="{{ route('login') }}"
                        class="px-5 py-1.5 text-white font-medium hover:text-blue-400 transition-colors duration-200 rounded-lg text-sm"
                    >
                        Entrar
                    </a>
                @endauth
            @endif
        @endif
    </div>

    <div class="w-full border-t border-gray-600"></div>
</header>
