<x-guest-layout>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    </head>
    
    <div class="container mx-auto px-4 py-8">
        <section class="mb-6 sm:mb-8">
            <div class="swiper main-carousel w-full rounded-xl sm:rounded-2xl overflow-hidden shadow-xl">
                <div class="swiper-wrapper">
                    @foreach($mostPopular->take(5) as $carousel)
                    <div class="swiper-slide relative group">
                        <div class="relative w-full h-48 sm:h-64 md:h-72 lg:h-80 overflow-hidden">
                            <img src="img/{{ $carousel->firstImage }}" alt="{{ $carousel->title }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                        </div>
                        <div class="absolute inset-0 flex flex-col justify-end p-4 sm:p-6">
                            <div class="max-w-2xl">
                                <div class="flex flex-wrap gap-2 mb-2">
                                    <span class="px-2 py-1 bg-blue-600/90 text-white text-xs font-medium rounded-full">
                                        Destaque
                                    </span>
                                    @if($carousel->category)
                                    <span class="px-2 py-1 bg-green-600/90 text-white text-xs font-medium rounded-full">
                                        {{ $carousel->category }}
                                    </span>
                                    @endif
                                </div>
                                <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-white mb-2 leading-tight">
                                    {{ $carousel->title }}
                                </h2>
                                <p class="text-blue-200 text-xs sm:text-sm mb-2 flex items-center">
                                    <i class="fas fa-map-marker-alt mr-1 text-xs"></i>
                                    {{ $carousel->city }} - {{ $carousel->state }}
                                </p>
                                <div class="flex items-center gap-1 mb-2">
                                    <div class="flex text-yellow-400 text-xs">
                                        @php
                                        $fullStars = floor($carousel->average_rating);
                                        $halfStar = ($carousel->average_rating - $fullStars) >= 0.5 ? 1 : 0;
                                        $emptyStars = 5 - $fullStars - $halfStar;
                                        @endphp

                                        @for ($i = 0; $i < $fullStars; $i++) <i class="fas fa-star"></i>
                                            @endfor

                                            @if ($halfStar)
                                            <i class="fas fa-star-half-alt"></i>
                                            @endif

                                            @for ($i = 0; $i < $emptyStars; $i++) <i class="far fa-star"></i>
                                                @endfor
                                    </div>
                                    <span class="text-white text-xs">({{ number_format($carousel->average_rating, 1) }})</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination !bottom-2 sm:!bottom-4"></div>
            </div>
        </section>

        <x-search-bar></x-search-bar>

        <!-- Locais mais populares -->
        @if($mostPopular->count() > 0)
        <section class="mb-8 sm:mb-16">
            <div class="flex items-center justify-between mb-4 sm:mb-8">
                <div class="flex items-center">
                    <div class="w-8 h-8 sm:w-12 sm:h-12 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl sm:rounded-2xl flex items-center justify-center mr-3 sm:mr-4 shadow-lg">
                        <i class="fas fa-fire text-white text-sm sm:text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-lg sm:text-3xl font-bold text-gray-900 dark:text-white">Populares</h2>
                        <p class="text-gray-600 dark:text-gray-400 text-xs sm:text-base hidden sm:block">Os mais visitados esta semana</p>
                    </div>
                </div>
                <a href="{{ route('search.index') }}"
                    class="hidden sm:flex items-center text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 transition-colors font-medium group">
                    Explorar
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-6">
                @foreach($mostPopular->take(4) as $location)
                <div class="bg-white dark:bg-gray-800/50 backdrop-blur-sm rounded-xl sm:rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700/50 hover:border-gray-300 dark:hover:border-gray-500/50 transition-all duration-300 hover:transform hover:scale-105 shadow-lg dark:shadow-xl">
                    @include('components.location-card', ['location' => $location])
                </div>
                @endforeach
            </div>

            <div class="text-center mt-6 sm:mt-8">
                <a href="{{ route('search.index') }}"
                    class="inline-flex items-center justify-center px-4 py-2 sm:px-6 sm:py-3 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-lg sm:rounded-xl transition-all duration-300 transform hover:scale-105 text-sm sm:text-base">
                    <i class="fas fa-search mr-2 text-xs sm:text-sm"></i>
                    Explorar Locais
                </a>
            </div>
        </section>
        @endif

        <!-- Bem avaliados -->
        @if($bestRated->count() > 0)
        <section class="mb-8 sm:mb-16">
            <div class="flex items-center justify-between mb-4 sm:mb-8">
                <div class="flex items-center">
                    <div class="w-8 h-8 sm:w-12 sm:h-12 bg-gradient-to-br from-yellow-500 to-amber-500 rounded-xl sm:rounded-2xl flex items-center justify-center mr-3 sm:mr-4 shadow-lg">
                        <i class="fas fa-star text-white text-sm sm:text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-lg sm:text-3xl font-bold text-gray-900 dark:text-white">Melhores</h2>
                        <p class="text-gray-600 dark:text-gray-400 text-xs sm:text-base hidden sm:block">Excelência comprovada</p>
                    </div>
                </div>
                <a href="{{ route('search.index') }}"
                    class="hidden sm:flex items-center text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 transition-colors font-medium group">
                    Explorar
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-6">
                @foreach($bestRated->take(4) as $location)
                <div class="bg-white dark:bg-gray-800/50 backdrop-blur-sm rounded-xl sm:rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700/50 hover:border-gray-300 dark:hover:border-gray-500/50 transition-all duration-300 hover:transform hover:scale-105 shadow-lg dark:shadow-xl">
                    @include('components.location-card', ['location' => $location])
                </div>
                @endforeach
            </div>

            <div class="text-center mt-6 sm:mt-8">
                <a href="{{ route('search.index') }}"
                    class="inline-flex items-center justify-center px-4 py-2 sm:px-6 sm:py-3 bg-amber-600 hover:bg-amber-700 text-white font-medium rounded-lg sm:rounded-xl transition-all duration-300 transform hover:scale-105 text-sm sm:text-base">
                    <i class="fas fa-search mr-2 text-xs sm:text-sm"></i>
                    Explorar Locais
                </a>
            </div>
        </section>
        @endif

        <!-- Você pode gostar -->
        @if($recommendations->count() > 0)
        <section class="mb-8 sm:mb-16">
            <div class="flex items-center justify-between mb-4 sm:mb-8">
                <div class="flex items-center">
                    <div class="w-8 h-8 sm:w-12 sm:h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl sm:rounded-2xl flex items-center justify-center mr-3 sm:mr-4 shadow-lg">
                        <i class="fas fa-magic text-white text-sm sm:text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-lg sm:text-3xl font-bold text-gray-900 dark:text-white">Para Você</h2>
                        <p class="text-gray-600 dark:text-gray-400 text-xs sm:text-base hidden sm:block">Recomendados personalizados</p>
                    </div>
                </div>
                <a href="{{ route('search.index') }}"
                    class="hidden sm:flex items-center text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 transition-colors font-medium group">
                    Explorar
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-6">
                @foreach($recommendations->take(4) as $location)
                <div class="bg-white dark:bg-gray-800/50 backdrop-blur-sm rounded-xl sm:rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700/50 hover:border-gray-300 dark:hover:border-gray-500/50 transition-all duration-300 hover:transform hover:scale-105 shadow-lg dark:shadow-xl">
                    @include('components.location-card', ['location' => $location])
                </div>
                @endforeach
            </div>

            <div class="text-center mt-6 sm:mt-8">
                <a href="{{ route('search.index') }}"
                    class="inline-flex items-center justify-center px-4 py-2 sm:px-6 sm:py-3 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg sm:rounded-xl transition-all duration-300 transform hover:scale-105 text-sm sm:text-base">
                    <i class="fas fa-search mr-2 text-xs sm:text-sm"></i>
                    Explorar Locais
                </a>
            </div>
        </section>
        @endif

        <!-- Adicionados recentemente -->
        @if($recentlyAdded->count() > 0)
        <section class="mb-8 sm:mb-16">
            <div class="flex items-center justify-between mb-4 sm:mb-8">
                <div class="flex items-center">
                    <div class="w-8 h-8 sm:w-12 sm:h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl sm:rounded-2xl flex items-center justify-center mr-3 sm:mr-4 shadow-lg">
                        <i class="fas fa-clock text-white text-sm sm:text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-lg sm:text-3xl font-bold text-gray-900 dark:text-white">Novidades</h2>
                        <p class="text-gray-600 dark:text-gray-400 text-xs sm:text-base hidden sm:block">Locais recém-adicionados</p>
                    </div>
                </div>
                <a href="{{ route('search.index') }}"
                    class="hidden sm:flex items-center text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 transition-colors font-medium group">
                    Explorar
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-6">
                @foreach($recentlyAdded->take(4) as $location)
                <div class="bg-white dark:bg-gray-800/50 backdrop-blur-sm rounded-xl sm:rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700/50 hover:border-gray-300 dark:hover:border-gray-500/50 transition-all duration-300 hover:transform hover:scale-105 shadow-lg dark:shadow-xl">
                    @include('components.location-card', ['location' => $location])
                </div>
                @endforeach
            </div>

            <div class="text-center mt-6 sm:mt-8">
                <a href="{{ route('search.index') }}"
                    class="inline-flex items-center justify-center px-4 py-2 sm:px-6 sm:py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg sm:rounded-xl transition-all duration-300 transform hover:scale-105 text-sm sm:text-base">
                    <i class="fas fa-search mr-2 text-xs sm:text-sm"></i>
                    Explorar Locais
                </a>
            </div>
        </section>
        @endif

        <!-- Recomendações por categoria -->
        @if($categoryRecommendations->count() > 0)
        @foreach($categoryRecommendations as $category => $locations)
        @if($locations->count() > 0)
        <section class="mb-8 sm:mb-16">
            <div class="flex items-center justify-between mb-4 sm:mb-8">
                <div class="flex items-center">
                    <div class="w-8 h-8 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl sm:rounded-2xl flex items-center justify-center mr-3 sm:mr-4 shadow-lg">
                        <i class="fas fa-tag text-white text-sm sm:text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-lg sm:text-3xl font-bold text-gray-900 dark:text-white">
                            {{ \Illuminate\Support\Str::limit($category, 15) }}</h2>
                        <p class="text-gray-600 dark:text-gray-400 text-xs sm:text-base hidden sm:block">Destaques da categoria</p>
                    </div>
                </div>
                <a href="{{ route('search.index') }}?category={{ urlencode($category) }}"
                    class="hidden sm:flex items-center text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 transition-colors font-medium group">
                    Ver categoria
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-6">
                @foreach($locations->take(4) as $location)
                <div class="bg-white dark:bg-gray-800/50 backdrop-blur-sm rounded-xl sm:rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700/50 hover:border-gray-300 dark:hover:border-gray-500/50 transition-all duration-300 hover:transform hover:scale-105 shadow-lg dark:shadow-xl">
                    @include('components.location-card', ['location' => $location])
                </div>
                @endforeach
            </div>

            <div class="text-center mt-6 sm:mt-8">
                <a href="{{ route('search.index') }}?category={{ urlencode($category) }}"
                    class="inline-flex items-center justify-center px-4 py-2 sm:px-6 sm:py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg sm:rounded-xl transition-all duration-300 transform hover:scale-105 text-sm sm:text-base">
                    <i class="fas fa-tag mr-2 text-xs sm:text-sm"></i>
                    Ver {{ \Illuminate\Support\Str::limit($category, 12) }}
                </a>
            </div>
        </section>
        @endif
        @endforeach
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper('.swiper', {
            loop: true,
            autoplay: { delay: 3500, disableOnInteraction: false },
            pagination: { el: '.swiper-pagination', clickable: true },
            slidesPerView: 1,
            spaceBetween: 0,
            breakpoints: {
                640: { slidesPerView: 1 },
                768: { slidesPerView: 1 },
                1024: { slidesPerView: 1 }
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        const baseUrl = '{{ url("/") }}';
        const isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};

        // Executa a verificação de favoritos somente se o usuário estiver autenticado
        if (isAuthenticated) {
            checkFavorites();
        }

        // Adiciona evento de clique em todos os botões de favorito
        document.querySelectorAll('.favorite-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                toggleFavorite(this);
            });
        });

        // Verifica quais locais já estão favoritados pelo usuário
        async function checkFavorites() {
            const favoriteButtons = document.querySelectorAll('.favorite-btn');

            for (const btn of favoriteButtons) {
                const locationId = btn.getAttribute('data-location-id');

                try {
                    const response = await fetch(`${baseUrl}/favorites/check/${locationId}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    if (response.ok) {
                        const data = await response.json();
                        updateFavoriteIcon(btn, data.favorited);
                    }
                } catch (error) {
                    console.error('Erro ao verificar favorito:', error);
                }
            }
        }

        // Alterna o estado de favorito (adiciona/remove) no banco de dados
        async function toggleFavorite(btn) {
            if (!isAuthenticated) {
                window.location.href = '{{ route("login") }}';
                return;
            }

            const locationId = btn.getAttribute('data-location-id');

            try {
                const response = await fetch(`${baseUrl}/favorites/toggle/${locationId}`, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    updateFavoriteIcon(btn, data.favorited);
                }
            } catch (error) {
                console.error('Erro ao favoritar:', error);
            }
        }

        // Atualiza o ícone do coração de acordo com o estado atual (favoritado ou não)
        function updateFavoriteIcon(btn, isFavorited) {
            const heartIcon = btn.querySelector('i');

            if (isFavorited) {
                heartIcon.classList.replace('far', 'fas');
                heartIcon.classList.add('text-red-500');
            } else {
                heartIcon.classList.replace('fas', 'far');
                heartIcon.classList.remove('text-red-500');
            }
        }
    });
</script>

</x-guest-layout>