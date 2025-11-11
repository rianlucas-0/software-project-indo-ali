<x-guest-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-8 sm:mb-12">
            <div class="flex items-center justify-center mb-4">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-2xl flex items-center justify-center shadow-2xl">
                    <i class="fas fa-magic text-white text-2xl"></i>
                </div>
            </div>
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-3">
                Recomendações Para Você
            </h1>
            <p class="text-gray-600 dark:text-gray-400 text-lg max-w-2xl mx-auto">
                Locais personalizados baseados nas suas preferências, histórico e comportamento
            </p>
            
            <!-- Contador e informações -->
            <div class="mt-6 flex flex-wrap justify-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                <div class="flex items-center">
                    <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>
                    {{ $totalCount }} locais recomendados
                </div>
                <div class="flex items-center">
                    <i class="fas fa-star mr-2 text-yellow-500"></i>
                    Baseado nas suas preferências
                </div>
                <div class="flex items-center">
                    <i class="fas fa-history mr-2 text-indigo-500"></i>
                    E seu histórico de visualizações
                </div>
            </div>
        </div>

        <!-- Filtros e Ordenação -->
        <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 p-6 bg-white dark:bg-gray-800/50 rounded-2xl border border-gray-200 dark:border-gray-700/50 shadow-lg">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-xl flex items-center justify-center mr-3 shadow-md">
                    <i class="fas fa-filter text-white text-sm"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 dark:text-white">Filtrar Recomendações</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Ordenados por relevância personalizada</p>
                </div>
            </div>
            
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('preferences.edit') }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all duration-300 transform hover:scale-105 text-sm">
                    <i class="fas fa-sliders-h mr-2"></i>
                    Ajustar Preferências
                </a>
                
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-all duration-300 text-sm">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Voltar para Home
                </a>
            </div>
        </div>

        <!-- Grid de Recomendações -->
        @if($recommendations->count() > 0)
        <section class="mb-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
                @foreach($recommendations as $location)
                <div class="bg-white dark:bg-gray-800/50 backdrop-blur-sm rounded-xl sm:rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700/50 hover:border-blue-300 dark:hover:border-indigo-500/50 transition-all duration-300 hover:transform hover:scale-105 shadow-lg dark:shadow-xl group">
                    @include('components.location-card', ['location' => $location])
                </div>
                @endforeach
            </div>

            <!-- Paginação -->
            <div class="mt-12">
                {{ $recommendations->links() }}
            </div>
        </section>

        <!-- Empty State para última página -->
        @elseif($recommendations->count() === 0 && $recommendations->currentPage() > 1)
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-2xl">
                <i class="fas fa-flag text-white text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">
                Fim das Recomendações
            </h3>
            <p class="text-gray-600 dark:text-gray-400 mb-8 max-w-md mx-auto">
                Você visualizou todas as suas recomendações personalizadas. 
                Que tal ajustar suas preferências para descobrir mais locais?
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ $recommendations->url(1) }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Voltar ao Início
                </a>
                <a href="{{ route('preferences.edit') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-xl transition-all duration-300">
                    <i class="fas fa-sliders-h mr-2"></i>
                    Ajustar Preferências
                </a>
            </div>
        </div>
        @endif

        <!-- Empty State para nenhuma recomendação -->
        @if($recommendations->count() === 0 && $recommendations->currentPage() === 1)
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-2xl">
                <i class="fas fa-search text-white text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">
                Nenhuma Recomendação Encontrada
            </h3>
            <p class="text-gray-600 dark:text-gray-400 mb-8 max-w-md mx-auto">
                Não encontramos recomendações personalizadas para você no momento. 
                Isso pode acontecer se você ainda não definiu preferências ou se não há locais que correspondam aos seus interesses.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('preferences.edit') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-sliders-h mr-2"></i>
                    Configurar Preferências
                </a>
                <a href="{{ route('search.index') }}" 
                   class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl transition-all duration-300">
                    <i class="fas fa-compass mr-2"></i>
                    Explorar Todos os Locais
                </a>
            </div>
        </div>
        @endif

        @if($recommendations->count() > 0)
        <div class="mt-12 text-center">
            <div class="bg-gradient-to-br from-blue-500/10 to-indigo-500/10 dark:from-blue-500/5 dark:to-indigo-500/5 rounded-2xl p-8 backdrop-blur-sm border border-blue-200/20 dark:border-indigo-500/20">
                <h3 class="text-2xl font-bold mb-3 text-gray-900 dark:text-white">Quer recomendações melhores?</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-6 max-w-md mx-auto leading-relaxed">
                    Personalize suas preferências para receber recomendações mais precisas e alinhadas com seus gostos.
                </p>
                <a href="{{ route('preferences.edit') }}" 
                class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 dark:bg-indigo-600 dark:hover:bg-indigo-700 text-white font-bold rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                    <i class="fas fa-sliders-h mr-2"></i>
                    Otimizar Minhas Recomendações
                </a>
            </div>
        </div>
        @endif
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const baseUrl = '{{ url("/") }}';
        const isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};

        // Sistema de favoritos (mesmo da home)
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

    <style>
    /* Estilização personalizada para a paginação */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
    }
    
    .pagination .page-item .page-link {
        padding: 0.5rem 1rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        color: #6b7280;
        transition: all 0.3s ease;
    }
    
    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #3b82f6, #6366f1);
        border-color: #3b82f6;
        color: white;
    }
    
    .pagination .page-item:not(.active) .page-link:hover {
        background-color: #f3f4f6;
        border-color: #d1d5db;
        color: #374151;
    }
    
    .dark .pagination .page-item .page-link {
        border-color: #4b5563;
        color: #9ca3af;
        background-color: #1f2937;
    }
    
    .dark .pagination .page-item:not(.active) .page-link:hover {
        background-color: #374151;
        border-color: #6b7280;
        color: #e5e7eb;
    }
    </style>
</x-guest-layout>