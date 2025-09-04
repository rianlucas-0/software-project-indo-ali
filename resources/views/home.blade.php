<x-guest-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-6">
        <!-- All Cards -->    
        @foreach ($local as $locations)
            <div
                class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col relative group">
                <!-- Botão de Favorito -->
                <button class="favorite-btn absolute top-3 right-3 z-10" data-location-id="{{ $locations->id }}">
                    <div class="w-8 h-8 rounded-full bg-white/90 backdrop-blur-sm flex items-center justify-center 
                                hover:bg-white transition-all shadow-md group-hover:scale-110">
                        <i class="far fa-heart text-gray-600 text-sm"></i>
                    </div>
                </button>

                <!-- Imagem -->
                <div class="aspect-square overflow-hidden">
                    <img src="img/{{ $locations->firstImage }}" alt="{{ $locations->title }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </div>

                <!-- Conteúdo -->
                <div class="p-4 flex flex-col flex-1">
                    <h3 class="font-bold text-gray-800 mb-1 line-clamp-1">{{ $locations->title }}</h3>
                    <p class="text-sm text-gray-500 mb-2">{{ $locations->city }} - {{ $locations->state }}</p>

                    <!-- Avaliação -->
                    <div class="flex text-yellow-400 text-xs mb-3">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <i class="far fa-star"></i>
                    </div>

                    <!-- Link -->
                    <a href="{{ route('localfull', $locations->id) }}"
                        class="text-indigo-600 text-sm font-semibold hover:underline mt-auto inline-flex items-center">
                        Ver detalhes
                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
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