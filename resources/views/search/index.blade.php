<x-guest-layout>
    <div class="container mx-auto px-3 sm:px-4 py-6 sm:py-8 max-w-4xl">
        <x-search-bar></x-search-bar>

        <!-- Resultados -->
        <div class="flex justify-between items-center mb-4 sm:mb-6">
            <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white">Resultados da busca</h2>
            <span class="text-gray-600 dark:text-gray-400 text-xs sm:text-sm">{{ $locals->total() }} resultado(s)</span>
        </div>

        @if($locals->count())
        <div class="space-y-3 sm:space-y-4">
            @foreach($locals as $local)
            <a href="{{ route('localfull', $local->id) }}"
                class="block bg-white dark:bg-[#161B22] rounded-lg sm:rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 border border-gray-200 dark:border-gray-700 cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-400 group">

                <div class="flex flex-col sm:flex-row">
                    <!-- Imagem com proporção melhor para mobile -->
                    <div class="w-full h-40 sm:w-48 sm:h-48 flex-shrink-0 relative overflow-hidden">
                        <img src="img/{{ $local->firstImage }}" alt="{{ $local->title }}"
                            class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    </div>

                    <div class="p-3 sm:p-4 flex-1 flex flex-col min-w-0">
                        <div class="mb-2">
                            <div class="flex justify-between items-start gap-2">
                                <h3 class="font-bold text-gray-900 dark:text-white text-base sm:text-lg line-clamp-1 flex-1">
                                    {{ $local->title }}</h3>
                                <button class="favorite-btn flex-shrink-0 mt-1" data-location-id="{{ $local->id }}"
                                    tabindex="-1">
                                    <div
                                        class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-white/90 dark:bg-[#1E2229]/90 backdrop-blur-sm flex items-center justify-center hover:bg-gray-100 dark:hover:bg-[#1E2229] transition-all shadow-md group-hover:scale-110 border border-gray-300 dark:border-gray-700">
                                        <i class="far fa-heart text-gray-500 dark:text-gray-400 text-xs sm:text-sm"></i>
                                    </div>
                                </button>
                            </div>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                                <i class="fas fa-map-marker-alt text-xs mr-1"></i>
                                {{ $local->city }} - {{ $local->state }}
                            </p>
                        </div>

                        <div class="flex items-center gap-1 mb-2">
                            <div class="flex text-yellow-400 text-xs">
                                @php
                                $fullStars = floor($local->average_rating);
                                $halfStar = ($local->average_rating - $fullStars) >= 0.5 ? 1 : 0;
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
                            <span class="text-gray-600 dark:text-gray-400 text-xs">({{ number_format($local->average_rating, 1) }})</span>
                        </div>

                        @if($local->description)
                        <p class="text-gray-700 dark:text-gray-300 mb-2 line-clamp-2 text-xs sm:text-sm leading-relaxed">
                            {{ $local->description }}</p>
                        @endif

                        @if($local->opening_hours)
                        <div class="flex items-center gap-1 text-gray-600 dark:text-gray-400 mb-2 text-xs">
                            <i class="far fa-clock text-xs flex-shrink-0"></i>
                            <span class="line-clamp-1">{{ $local->opening_hours }}</span>
                        </div>
                        @endif

                        @if($local->features && count($local->features) > 0)
                        <div class="flex flex-wrap gap-1 mb-2">
                            @foreach(array_slice($local->features, 0, 2) as $feature)
                            <span class="px-1.5 py-0.5 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 rounded text-xs">
                                {{ $feature }}
                            </span>
                            @endforeach
                            @if(count($local->features) > 2)
                            <span class="px-1.5 py-0.5 bg-gray-200 dark:bg-gray-800 text-gray-600 dark:text-gray-400 rounded text-xs">
                                +{{ count($local->features) - 2 }}
                            </span>
                            @endif
                        </div>
                        @endif

                        <div
                            class="mt-auto flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 pt-2 border-t border-gray-300 dark:border-gray-800">
                            <div class="flex items-center gap-1">
                                @if($local->category)
                                <span
                                    class="px-2 py-0.5 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 rounded-full text-xs font-medium">
                                    {{ $local->category }}
                                </span>
                                @endif

                                @if($local->price_range)
                                <span class="text-yellow-500 text-xs">
                                    {{ str_repeat('$', $local->price_range) }}
                                </span>
                                @endif
                            </div>

                            <div
                                class="text-blue-600 dark:text-blue-400 text-xs font-medium group-hover:text-blue-500 dark:group-hover:text-blue-300 transition-colors self-end sm:self-auto">
                                Ver detalhes →
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <div class="mt-4 sm:mt-6">
            {{ $locals->withQueryString()->links() }}
        </div>
        @else
        <div class="text-center py-8 sm:py-12">
            <i class="fas fa-search text-gray-400 text-3xl sm:text-4xl mb-3 sm:mb-4"></i>
            <p class="text-gray-600 dark:text-gray-400 text-base sm:text-lg mb-2">Nenhum resultado encontrado</p>
            <p class="text-gray-500 text-xs sm:text-sm">Tente ajustar os termos da sua busca ou filtrar de forma
                diferente</p>
        </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const baseUrl = '{{ url("/") }}';
            const isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};

            if (isAuthenticated) {
                checkFavorites();
            }

            document.querySelectorAll('.favorite-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleFavorite(this);
                });
            });

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