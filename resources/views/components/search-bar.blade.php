<!-- Barra de pesquisa compacta -->
<div class="mb-8 bg-[#161B22] p-3 rounded-xl shadow-md border border-gray-700 relative z-30">
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
                            @foreach([
                            'academia' => 'Academia',
                            'bar' => 'Bar',
                            'biblioteca' => 'Biblioteca',
                            'boliche' => 'Boliche',
                            'boate' => 'Boate',
                            'cachoeira' => 'Cachoeira',
                            'cafe' => 'Café',
                            'casa_shows' => 'Casa de Shows',
                            'centro_cultural' => 'Centro Cultural',
                            'centro_historico' => 'Centro Histórico',
                            'cinema' => 'Cinema',
                            'clube_social' => 'Clube Social',
                            'comida_asiatica' => 'Comida Asiática',
                            'comida_tipica' => 'Comida Típica',
                            'comida_vegetariana' => 'Comida Vegetariana',
                            'escape_room' => 'Escape Room',
                            'escola' => 'Escola',
                            'estadio' => 'Estádio',
                            'feira_livre' => 'Feira Livre',
                            'galeria_arte' => 'Galeria de Arte',
                            'hamburgueria' => 'Hamburgueria',
                            'hotel' => 'Hotel',
                            'igreja_historica' => 'Igreja Histórica',
                            'jardim_botanico' => 'Jardim Botânico',
                            'karaoke' => 'Karaokê',
                            'kart' => 'Kart',
                            'loja' => 'Loja',
                            'loja_artesanato' => 'Loja de Artesanato',
                            'massagem' => 'Massagem',
                            'mirante' => 'Mirante',
                            'monumento' => 'Monumento',
                            'museu' => 'Museu',
                            'padaria' => 'Padaria',
                            'parque' => 'Parque',
                            'parque_ambiental' => 'Parque Ambiental',
                            'parque_aquatico' => 'Parque Aquático',
                            'parque_diversoes' => 'Parque de Diversões',
                            'pet_shop' => 'Pet Shop',
                            'pizzaria' => 'Pizzaria',
                            'ponto_turistico' => 'Ponto Turístico',
                            'pousada' => 'Pousada',
                            'praca_esportes' => 'Praça de Esportes',
                            'praia' => 'Praia',
                            'quadra_esportes' => 'Quadra de Esportes',
                            'resort' => 'Resort',
                            'restaurante' => 'Restaurante',
                            'rua_famosa' => 'Rua Famosa',
                            'shopping' => 'Shopping',
                            'sitio_arqueologico' => 'Sítio Arqueológico',
                            'sorveteria' => 'Sorveteria',
                            'spa' => 'Spa',
                            'teatro' => 'Teatro',
                            'trilha' => 'Trilha',
                            'universidade' => 'Universidade',
                            'vista_panoramica' => 'Vista Panorâmica',
                            'zoo_aquario' => 'Zoológico/Aquário',
                            'outro' => 'Outro'
                            ] as $value => $label)
                            <option value="{{ $value }}" @selected(request('category')==$value)>{{ $label }}
                            </option>
                            @endforeach
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
                            class="dropdown-content mt-1 rounded bg-[#161B22] border border-gray-600 shadow-lg p-2 hidden absolute w-48 right-0 z-10 max-h-60 overflow-y-auto">
                            <div class="grid grid-cols-1 gap-1">
                                @foreach([
                                'acessivel' => ['icon' => 'fas fa-wheelchair', 'label' => 'Acessível'],
                                'aquecimento' => ['icon' => 'fas fa-thermometer-full', 'label' =>
                                'Aquecimento'],
                                'ar_condicionado' => ['icon' => 'fas fa-snowflake', 'label' => 'Ar
                                Condicionado'],
                                'banheiro' => ['icon' => 'fas fa-restroom', 'label' => 'Banheiro'],
                                'bar' => ['icon' => 'fas fa-glass-martini-alt', 'label' => 'Bar'],
                                'bebidas' => ['icon' => 'fas fa-wine-bottle', 'label' => 'Bebidas Alcoólicas'],
                                'cafe_especial' => ['icon' => 'fas fa-coffee', 'label' => 'Café Especial'],
                                'cafe_manha' => ['icon' => 'fas fa-bacon', 'label' => 'Café da Manhã'],
                                'cais_embarcacoes' => ['icon' => 'fas fa-ship', 'label' => 'Cais para
                                Embarcações'],
                                'camping' => ['icon' => 'fas fa-campground', 'label' => 'Camping'],
                                'cardapio_infantil' => ['icon' => 'fas fa-child', 'label' => 'Cardápio
                                Infantil'],
                                'cartao_credito' => ['icon' => 'fas fa-credit-card', 'label' => 'Aceita
                                Cartão'],
                                'cobertura' => ['icon' => 'fas fa-building', 'label' => 'Rooftop'],
                                'delivery' => ['icon' => 'fas fa-motorcycle', 'label' => 'Delivery'],
                                'esportes' => ['icon' => 'fas fa-basketball-ball', 'label' => 'Área de
                                Esportes'],
                                'estacionamento' => ['icon' => 'fas fa-parking', 'label' => 'Estacionamento'],
                                'estacionamento_valet' => ['icon' => 'fas fa-car', 'label' => 'Estacionamento
                                Valet'],
                                'familia' => ['icon' => 'fas fa-users', 'label' => 'Ambiente Familiar'],
                                'fraldario' => ['icon' => 'fas fa-baby', 'label' => 'Fraldário'],
                                'fumodromo' => ['icon' => 'fas fa-smoking', 'label' => 'Área para Fumantes'],
                                'jardim' => ['icon' => 'fas fa-leaf', 'label' => 'Jardim'],
                                'jogos' => ['icon' => 'fas fa-gamepad', 'label' => 'Jogos/Entretenimento'],
                                'ambiente_romantico' => ['icon' => 'fas fa-heart', 'label' => 'Ambiente
                                Romântico'],
                                'musica_ao_vivo' => ['icon' => 'fas fa-music', 'label' => 'Música ao Vivo'],
                                'opcoes_veganas' => ['icon' => 'fas fa-seedling', 'label' => 'Opções Veganas'],
                                'opcoes_vegetarianas' => ['icon' => 'fas fa-carrot', 'label' => 'Opções
                                Vegetarianas'],
                                'pet_friendly' => ['icon' => 'fas fa-paw', 'label' => 'Pet Friendly'],
                                'piscina' => ['icon' => 'fas fa-swimming-pool', 'label' => 'Piscina'],
                                'playground' => ['icon' => 'fas fa-slide', 'label' => 'Área de Playground'],
                                'reserva' => ['icon' => 'fas fa-calendar-check', 'label' => 'Aceita Reservas'],
                                'self_service' => ['icon' => 'fas fa-utensils', 'label' => 'Self Service'],
                                'sem_gluten' => ['icon' => 'fas fa-bread-slice', 'label' => 'Opções Sem
                                Glúten'],
                                'terraco' => ['icon' => 'fas fa-umbrella-beach', 'label' => 'Terraço'],
                                'tomadas' => ['icon' => 'fas fa-plug', 'label' => 'Tomadas para Carregar'],
                                'tv' => ['icon' => 'fas fa-tv', 'label' => 'TV'],
                                'vista_panoramica' => ['icon' => 'fas fa-mountain', 'label' => 'Vista
                                Panorâmica'],
                                'wifi' => ['icon' => 'fas fa-wifi', 'label' => 'Wi-Fi']
                                ] as $value => $feature)
                                <label
                                    class="flex items-center text-gray-300 hover:text-white cursor-pointer py-1 px-1 rounded hover:bg-gray-800 transition text-xs">
                                    <input type="checkbox" name="features[]" value="{{ $value }}"
                                        class="mr-1 rounded border-gray-600 text-blue-500 focus:ring-blue-500"
                                        @checked(in_array($value, request('features', [])))>
                                    <i class="{{ $feature['icon'] }} mr-1 text-blue-400 text-xs"></i>
                                    {{ $feature['label'] }}
                                </label>
                                @endforeach
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
                    @php
                    $categoryLabels = [
                    'academia' => 'Academia',
                    'bar' => 'Bar',
                    'biblioteca' => 'Biblioteca',
                    'boliche' => 'Boliche',
                    'boate' => 'Boate',
                    'cachoeira' => 'Cachoeira',
                    'cafe' => 'Café',
                    'casa_shows' => 'Casa de Shows',
                    'centro_cultural' => 'Centro Cultural',
                    'centro_historico' => 'Centro Histórico',
                    'cinema' => 'Cinema',
                    'clube_social' => 'Clube Social',
                    'comida_asiatica' => 'Comida Asiática',
                    'comida_tipica' => 'Comida Típica',
                    'comida_vegetariana' => 'Comida Vegetariana',
                    'escape_room' => 'Escape Room',
                    'escola' => 'Escola',
                    'estadio' => 'Estádio',
                    'feira_livre' => 'Feira Livre',
                    'galeria_arte' => 'Galeria de Arte',
                    'hamburgueria' => 'Hamburgueria',
                    'hotel' => 'Hotel',
                    'igreja_historica' => 'Igreja Histórica',
                    'jardim_botanico' => 'Jardim Botânico',
                    'karaoke' => 'Karaokê',
                    'kart' => 'Kart',
                    'loja' => 'Loja',
                    'loja_artesanato' => 'Loja de Artesanato',
                    'massagem' => 'Massagem',
                    'mirante' => 'Mirante',
                    'monumento' => 'Monumento',
                    'museu' => 'Museu',
                    'padaria' => 'Padaria',
                    'parque' => 'Parque',
                    'parque_ambiental' => 'Parque Ambiental',
                    'parque_aquatico' => 'Parque Aquático',
                    'parque_diversoes' => 'Parque de Diversões',
                    'pet_shop' => 'Pet Shop',
                    'pizzaria' => 'Pizzaria',
                    'ponto_turistico' => 'Ponto Turístico',
                    'pousada' => 'Pousada',
                    'praca_esportes' => 'Praça de Esportes',
                    'praia' => 'Praia',
                    'quadra_esportes' => 'Quadra de Esportes',
                    'resort' => 'Resort',
                    'restaurante' => 'Restaurante',
                    'rua_famosa' => 'Rua Famosa',
                    'shopping' => 'Shopping',
                    'sitio_arqueologico' => 'Sítio Arqueológico',
                    'sorveteria' => 'Sorveteria',
                    'spa' => 'Spa',
                    'teatro' => 'Teatro',
                    'trilha' => 'Trilha',
                    'universidade' => 'Universidade',
                    'vista_panoramica' => 'Vista Panorâmica',
                    'zoo_aquario' => 'Zoológico/Aquário',
                    'outro' => 'Outro'
                    ];
                    @endphp
                    <span class="bg-blue-900 text-blue-200 text-xs px-2 py-0.5 rounded-full">Categoria:
                        {{ $categoryLabels[request('category')] ?? request('category') }}</span>
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
                    'acessivel' => 'Acessível',
                    'aquecimento' => 'Aquecimento',
                    'ar_condicionado' => 'Ar Condicionado',
                    'banheiro' => 'Banheiro',
                    'bar' => 'Bar',
                    'bebidas' => 'Bebidas Alcoólicas',
                    'cafe_especial' => 'Café Especial',
                    'cafe_manha' => 'Café da Manhã',
                    'cais_embarcacoes' => 'Cais para Embarcações',
                    'camping' => 'Camping',
                    'cardapio_infantil' => 'Cardápio Infantil',
                    'cartao_credito' => 'Aceita Cartão',
                    'cobertura' => 'Rooftop',
                    'delivery' => 'Delivery',
                    'esportes' => 'Área de Esportes',
                    'estacionamento' => 'Estacionamento',
                    'estacionamento_valet' => 'Estacionamento Valet',
                    'familia' => 'Ambiente Familiar',
                    'fraldario' => 'Fraldário',
                    'fumodromo' => 'Área para Fumantes',
                    'jardim' => 'Jardim',
                    'jogos' => 'Jogos/Entretenimento',
                    'ambiente_romantico' => 'Ambiente Romântico',
                    'musica_ao_vivo' => 'Música ao Vivo',
                    'opcoes_veganas' => 'Opções Veganas',
                    'opcoes_vegetarianas' => 'Opções Vegetarianas',
                    'pet_friendly' => 'Pet Friendly',
                    'piscina' => 'Piscina',
                    'playground' => 'Área de Playground',
                    'reserva' => 'Aceita Reservas',
                    'self_service' => 'Self Service',
                    'sem_gluten' => 'Opções Sem Glúten',
                    'terraco' => 'Terraço',
                    'tomadas' => 'Tomadas para Carregar',
                    'tv' => 'TV',
                    'vista_panoramica' => 'Vista Panorâmica',
                    'wifi' => 'Wi-Fi'
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

    <script>
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
    </script>