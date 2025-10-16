<x-guest-layout>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    </head>
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <div class="swiper w-full rounded-2xl overflow-hidden shadow-lg">
                <div class="swiper-wrapper">
                    @foreach($local->take(5) as $carousel)
                    <div class="swiper-slide relative">
                        <img src="img/{{ $carousel->firstImage }}" alt="{{ $carousel->title }}" class="w-full h-64 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex flex-col justify-end p-6">
                            <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">{{ $carousel->title }}</h2>
                            <p class="text-lg text-blue-200 mb-2">{{ $carousel->city }} - {{ $carousel->state }}</p>
                            <span class="text-white text-base font-medium">{{ ['Explore lugares únicos!', 'Descubra experiências novas!', 'Encontre seu próximo destino!', 'Viva momentos inesquecíveis!', 'Conheça o melhor da sua cidade!'][$loop->index % 5] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <x-search-bar></x-search-bar>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-6">
            <!-- All Cards -->
            @foreach ($local as $locations)
            <a href="{{ route('localfull', $locations->id) }}"
                class="bg-[#161B22] rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex flex-col relative group border border-gray-700 cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-400 md:hover:-translate-y-1">
                <!-- Botão de Favorito -->
                <button class="favorite-btn absolute top-3 right-3 z-10" data-location-id="{{ $locations->id }}" tabindex="-1">
                    <div
                        class="w-8 h-8 rounded-full bg-[#1E2229]/90 backdrop-blur-sm flex items-center justify-center 
                                hover:bg-[#1E2229] transition-all shadow-md group-hover:scale-110 border border-gray-700">
                        <i class="far fa-heart text-gray-400 text-sm"></i>
                    </div>
                </button>

                <!-- Imagem -->
                <div class="aspect-square overflow-hidden">
                    <img src="img/{{ $locations->firstImage }}" alt="{{ $locations->title }}"
                        class="w-full h-full object-cover transition duration-500 md:group-hover:scale-110">
                </div>

                <!-- Conteúdo -->
                <div class="p-4 flex flex-col flex-1">
                    <h3 class="font-bold text-white mb-1 line-clamp-1">{{ $locations->title }}</h3>
                    <p class="text-sm text-gray-400 mb-2">{{ $locations->city }} - {{ $locations->state }}</p>

                    <!-- Avaliação -->
                    <div class="flex text-yellow-400 text-xs mb-3">
                        @php
                        $fullStars = floor($locations->average_rating); // quantidade de estrelas cheias
                        $halfStar = ($locations->average_rating - $fullStars) >= 0.5 ? 1 : 0; // estrela pela metade
                        $emptyStars = 5 - $fullStars - $halfStar; // estrelas vazias
                        @endphp

                        {{-- Estrelas cheias --}}
                        @for ($i = 0; $i < $fullStars; $i++) <i class="fas fa-star"></i>
                            @endfor

                            {{-- Estrela pela metade --}}
                            @if ($halfStar)
                            <i class="fas fa-star-half-alt"></i>
                            @endif

                            {{-- Estrelas vazias --}}
                            @for ($i = 0; $i < $emptyStars; $i++) <i class="far fa-star"></i>
                                @endfor
                    </div>
                </div>
            </a>
            @endforeach
        </div>
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