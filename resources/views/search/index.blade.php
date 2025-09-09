<x-guest-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Barra de pesquisa compacta -->
        <div class="mb-8 bg-[#161B22] p-3 rounded-xl shadow-md border border-gray-700">
            <form action="{{ route('search.index') }}" method="GET">
                <!-- Linha principal com campo de busca e botões -->
                <div class="flex items-center gap-2">
                    <!-- Campo de pesquisa -->
                    <div class="flex-1 relative">
                        <input type="text" id="q" name="q" value="{{ request('q') }}" placeholder="Pesquisar..."
                            class="w-full pl-10 pr-4 py-2 text-sm rounded-lg bg-[#0D1117] text-white border border-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-search text-gray-400 text-sm"></i>
                        </div>
                    </div>

                    <!-- Botão de filtros -->
                    <div class="relative">
                        <button type="button" id="filters-toggle"
                            class="p-2 rounded-lg bg-[#0D1117] text-white border border-gray-600 hover:border-gray-500 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
                            <i class="fas fa-filter text-sm"></i>
                            @if(request('category') || request('state') || request('city') || request('features'))
                            <span
                                class="absolute -top-1 -right-1 bg-blue-600 text-xs rounded-full w-4 h-4 flex items-center justify-center">!</span>
                            @endif
                        </button>
                    </div>

                    <!-- Botão de busca -->
                    <button type="submit"
                        class="p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center justify-center">
                        <i class="fas fa-search text-sm"></i>
                    </button>
                </div>

                <!-- Painel de filtros (inicialmente oculto) -->
                <div id="filters-panel" class="mt-3 p-3 bg-[#0D1117] rounded-lg border border-gray-700 hidden">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                        <!-- Categoria -->
                        <div>
                            <label for="category" class="text-xs text-gray-400 mb-1 block">Categoria</label>
                            <div class="relative">
                                <select name="category" id="category"
                                    class="w-full px-2 py-1 text-xs rounded bg-[#161B22] text-white border border-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none appearance-none transition">
                                    <option value="">Todas</option>
                                    <option value="restaurante" @selected(request('category')=='restaurante' )>
                                        Restaurante</option>
                                    <option value="bar" @selected(request('category')=='bar' )>Bar</option>
                                    <option value="cafe" @selected(request('category')=='cafe' )>Café</option>
                                    <option value="hotel" @selected(request('category')=='hotel' )>Hotel</option>
                                    <option value="loja" @selected(request('category')=='loja' )>Loja</option>
                                    <option value="outro" @selected(request('category')=='outro' )>Outro</option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-1 text-gray-400">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Estado -->
                        <div>
                            <label for="state" class="text-xs text-gray-400 mb-1 block">Estado</label>
                            <div class="relative">
                                <select name="state" id="state"
                                    class="w-full px-2 py-1 text-xs rounded bg-[#161B22] text-white border border-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none appearance-none transition">
                                    <option value="">Todos</option>
                                    @foreach(['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO']
                                    as $uf)
                                    <option value="{{ $uf }}" @selected(request('state')==$uf)>{{ $uf }}</option>
                                    @endforeach
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-1 text-gray-400">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Cidade -->
                        <div>
                            <label for="city" class="text-xs text-gray-400 mb-1 block">Cidade</label>
                            <input type="text" id="city" name="city" value="{{ request('city') }}" placeholder="Cidade"
                                class="w-full px-2 py-1 text-xs rounded bg-[#161B22] text-white border border-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
                        </div>

                        <!-- Características -->
                        <div>
                            <label class="text-xs text-gray-400 mb-1 block">Características</label>
                            <div class="dropdown relative">
                                <button type="button"
                                    class="w-full px-2 py-1 text-xs rounded bg-[#161B22] text-left text-white border border-gray-600 hover:border-gray-500 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition flex items-center justify-between">
                                    <span><i class="fas fa-sliders-h text-xs"></i></span>
                                    <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                                </button>

                                <div
                                    class="dropdown-content mt-1 rounded bg-[#161B22] border border-gray-600 shadow-lg p-2 hidden absolute w-40 right-0 z-10">
                                    <div class="grid grid-cols-1 gap-1">
                                        <label
                                            class="flex items-center text-gray-300 hover:text-white cursor-pointer py-1 px-1 rounded hover:bg-gray-800 transition text-xs">
                                            <input type="checkbox" name="features[]" value="wifi"
                                                class="mr-1 rounded border-gray-600 text-blue-500 focus:ring-blue-500"
                                                @checked(in_array('wifi', request('features', [])))>
                                            <i class="fas fa-wifi mr-1 text-blue-400 text-xs"></i> Wi-Fi
                                        </label>
                                        <label
                                            class="flex items-center text-gray-300 hover:text-white cursor-pointer py-1 px-1 rounded hover:bg-gray-800 transition text-xs">
                                            <input type="checkbox" name="features[]" value="estacionamento"
                                                class="mr-1 rounded border-gray-600 text-blue-500 focus:ring-blue-500"
                                                @checked(in_array('estacionamento', request('features', [])))>
                                            <i class="fas fa-parking mr-1 text-blue-400 text-xs"></i> Estacionamento
                                        </label>
                                        <label
                                            class="flex items-center text-gray-300 hover:text-white cursor-pointer py-1 px-1 rounded hover:bg-gray-800 transition text-xs">
                                            <input type="checkbox" name="features[]" value="acessivel"
                                                class="mr-1 rounded border-gray-600 text-blue-500 focus:ring-blue-500"
                                                @checked(in_array('acessivel', request('features', [])))>
                                            <i class="fas fa-wheelchair mr-1 text-blue-400 text-xs"></i> Acessível
                                        </label>
                                        <label
                                            class="flex items-center text-gray-300 hover:text-white cursor-pointer py-1 px-1 rounded hover:bg-gray-800 transition text-xs">
                                            <input type="checkbox" name="features[]" value="ar_condicionado"
                                                class="mr-1 rounded border-gray-600 text-blue-500 focus:ring-blue-500"
                                                @checked(in_array('ar_condicionado', request('features', [])))>
                                            <i class="fas fa-fan mr-1 text-blue-400 text-xs"></i> Ar Condicionado
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filtros ativos -->
                    <div class="mt-2 pt-2 border-t border-gray-700">
                        <div class="text-xs text-gray-400 mb-1">Filtros ativos:</div>
                        <div id="active-filters" class="flex flex-wrap gap-1">
                            @if(request('category'))
                            <span class="bg-blue-900 text-blue-200 text-xs px-2 py-0.5 rounded-full">Categoria:
                                {{ request('category') }}</span>
                            @endif
                            @if(request('state'))
                            <span class="bg-blue-900 text-blue-200 text-xs px-2 py-0.5 rounded-full">Estado:
                                {{ request('state') }}</span>
                            @endif
                            @if(request('city'))
                            <span class="bg-blue-900 text-blue-200 text-xs px-2 py-0.5 rounded-full">Cidade:
                                {{ request('city') }}</span>
                            @endif
                            @if(request('features'))
                            @foreach(request('features') as $feature)
                            @php
                            $featureNames = [
                            'wifi' => 'Wi-Fi',
                            'estacionamento' => 'Estacionamento',
                            'acessivel' => 'Acessível',
                            'ar_condicionado' => 'Ar Condicionado'
                            ];
                            @endphp
                            @if(isset($featureNames[$feature]))
                            <span
                                class="bg-blue-900 text-blue-200 text-xs px-2 py-0.5 rounded-full">{{ $featureNames[$feature] }}</span>
                            @endif
                            @endforeach
                            @endif
                            @if(!request('category') && !request('state') && !request('city') && !request('features'))
                            <span class="text-gray-500 text-xs">Nenhum filtro aplicado</span>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Resultados -->
        <h2 class="text-xl font-bold text-white mb-6">Resultados da busca</h2>

        @if($locals->count())
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-6">
            @foreach($locals as $local)
            <div
                class="bg-[#161B22] rounded-xl overflow-hidden shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col relative group border border-gray-700">
                <!-- Botão de favorito -->
                <button class="favorite-btn absolute top-3 right-3 z-10" data-location-id="{{ $local->id }}">
                    <div
                        class="w-8 h-8 rounded-full bg-[#1E2229]/90 backdrop-blur-sm flex items-center justify-center hover:bg-[#1E2229] transition-all shadow-md group-hover:scale-110 border border-gray-700">
                        <i class="far fa-heart text-gray-400 text-sm"></i>
                    </div>
                </button>

                <!-- Imagem -->
                <div class="aspect-square overflow-hidden">
                    <img src="img/{{ $local->firstImage }}" alt="{{ $local->title }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
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

                    <!-- Link -->
                    <a href="{{ route('localfull', $local->id) }}"
                        class="text-blue-400 text-sm font-semibold hover:text-blue-300 transition mt-auto inline-flex items-center">
                        Ver detalhes →
                    </a>
                </div>
            </div>
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

        const filtersToggle = document.getElementById('filters-toggle');
        const filtersPanel = document.getElementById('filters-panel');
        const dropdownBtn = document.querySelector('.dropdown button');
        const dropdownContent = document.querySelector('.dropdown-content');
        const checkboxes = document.querySelectorAll('input[name="features[]"]');
        const selectedFeaturesContainer = document.getElementById('selected-features');

        if (filtersToggle && filtersPanel) {
            filtersToggle.addEventListener('click', function() {
                filtersPanel.classList.toggle('hidden');
            });
        }

        if (dropdownBtn && dropdownContent) {
            dropdownBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdownContent.classList.toggle('hidden');
            });
        }

        document.addEventListener('click', function(event) {
            if (dropdownContent && !event.target.closest('.dropdown')) {
                dropdownContent.classList.add('hidden');
            }
            if (filtersPanel && !event.target.closest('#filters-toggle') && !event.target.closest('#filters-panel')) {
                filtersPanel.classList.add('hidden');
            }
        });

        function updateSelectedFeatures() {
            if (selectedFeaturesContainer) {
                selectedFeaturesContainer.innerHTML = '';

                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const featureName = checkbox.parentElement.textContent.trim();
                        const featureValue = checkbox.value;

                        const pill = document.createElement('div');
                        pill.className = 'feature-pill bg-blue-900 text-blue-200 text-xs px-2 py-1 rounded-full flex items-center mt-2';
                        pill.innerHTML = `
                            <span>${featureName}</span>
                            <button type="button" class="ml-1 text-blue-400 hover:text-blue-300" data-value="${featureValue}">
                                <i class="fas fa-times"></i>
                            </button>
                        `;

                        selectedFeaturesContainer.appendChild(pill);
                    }
                });

                document.querySelectorAll('#selected-features button').forEach(button => {
                    button.addEventListener('click', function() {
                        const value = this.getAttribute('data-value');
                        const checkbox = document.querySelector(`input[value="${value}"]`);
                        if (checkbox) {
                            checkbox.checked = false;
                            updateSelectedFeatures();
                        }
                    });
                });
            }
        }

        if (checkboxes.length && selectedFeaturesContainer) {
            updateSelectedFeatures();
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSelectedFeatures);
            });
        }
    });
</script>

</x-guest-layout>