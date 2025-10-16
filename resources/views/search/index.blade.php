<x-guest-layout>
    <div class="container mx-auto px-4 py-8">
        <x-search-bar></x-search-bar>

        <!-- Resultados -->
        <h2 class="text-xl font-bold text-white mb-6">Resultados da busca</h2>

        @if($locals->count())
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-6">
            @foreach($locals as $local)
            <a href="{{ route('localfull', $local->id) }}"
                class="bg-[#161B22] rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex flex-col relative group border border-gray-700 cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-400 md:hover:-translate-y-1">
                <!-- Botão de favorito -->
                <button class="favorite-btn absolute top-3 right-3 z-10" data-location-id="{{ $local->id }}" tabindex="-1">
                    <div
                        class="w-8 h-8 rounded-full bg-[#1E2229]/90 backdrop-blur-sm flex items-center justify-center hover:bg-[#1E2229] transition-all shadow-md group-hover:scale-110 border border-gray-700">
                        <i class="far fa-heart text-gray-400 text-sm"></i>
                    </div>
                </button>

                <!-- Imagem -->
                <div class="aspect-square overflow-hidden">
                    <img src="img/{{ $local->firstImage }}" alt="{{ $local->title }}"
                        class="w-full h-full object-cover transition duration-500 md:group-hover:scale-110">
                </div>

                <!-- Conteúdo -->
                <div class="p-4 flex flex-col flex-1">
                    <h3 class="font-bold text-white mb-1 line-clamp-1">{{ $local->title }}</h3>
                    <p class="text-sm text-gray-400 mb-2">{{ $local->city }} - {{ $local->state }}</p>

                    <!-- Avaliação -->
                    <div class="flex text-yellow-400 text-xs mb-3">
                        @php
                        $fullStars = floor($local->average_rating);
                        $halfStar = ($local->average_rating - $fullStars) >= 0.5 ? 1 : 0;
                        $emptyStars = 5 - $fullStars - $halfStar;
                        @endphp
                        @for($i=0; $i<$fullStars; $i++) <i class="fas fa-star"></i>@endfor
                        @if($halfStar) <i class="fas fa-star-half-alt"></i>@endif
                        @for($i=0; $i<$emptyStars; $i++) <i class="far fa-star"></i>@endfor
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $locals->withQueryString()->links() }}
        </div>
        @else
        <p class="text-gray-400">Nenhum resultado encontrado.</p>
        @endif
    </div>

    <script>
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