<x-guest-layout>
    <div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="flex items-center justify-center mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-sliders-h text-white text-xl"></i>
                    </div>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Minhas Preferências</h1>
                <p class="text-gray-600 dark:text-gray-400 text-lg">Personalize suas recomendações de locais</p>
            </div>

            @if(session('success'))
            <div class="mb-6 bg-green-100 dark:bg-green-600/20 border border-green-400 dark:border-green-500/30 text-green-700 dark:text-green-400 px-4 py-3 rounded-lg flex items-center shadow-lg">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('preferences.update') }}" class="space-y-8">
                @csrf
                @method('PATCH')

                <!-- Categorias Preferidas -->
                <div class="bg-white dark:bg-[#161B22] rounded-2xl p-6 border border-gray-200 dark:border-gray-700 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center mr-3 shadow-md">
                            <i class="fas fa-tags text-white text-sm"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Categorias Preferidas</h2>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Selecione suas categorias favoritas</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 max-h-96 overflow-y-auto p-2">
                        @php
                        $categories = [
                            'academia', 'bar', 'biblioteca', 'boliche', 'boate', 'cachoeira', 'cafe', 
                            'casa_shows', 'centro_cultural', 'centro_historico', 'cinema', 'clube_social',
                            'comida_asiatica', 'comida_tipica', 'comida_vegetariana', 'escape_room', 'escola',
                            'estadio', 'feira_livre', 'galeria_arte', 'hamburgueria', 'hotel', 'igreja_historica',
                            'jardim_botanico', 'karaoke', 'kart', 'loja', 'loja_artesanato', 'massagem', 'mirante',
                            'monumento', 'museu', 'padaria', 'parque', 'parque_ambiental', 'parque_aquatico',
                            'parque_diversoes', 'pet_shop', 'pizzaria', 'ponto_turistico', 'pousada', 'praca_esportes',
                            'praia', 'quadra_esportes', 'resort', 'restaurante', 'rua_famosa', 'shopping',
                            'sitio_arqueologico', 'sorveteria', 'spa', 'teatro', 'trilha', 'universidade', 
                            'zoo_aquario', 'outro'
                        ];
                        
                        $categoryLabels = [
                            'academia' => 'Academia', 'bar' => 'Bar', 'biblioteca' => 'Biblioteca',
                            'boliche' => 'Boliche', 'boate' => 'Boate', 'cachoeira' => 'Cachoeira',
                            'cafe' => 'Café', 'casa_shows' => 'Casa de Shows', 'centro_cultural' => 'Centro Cultural',
                            'centro_historico' => 'Centro Histórico', 'cinema' => 'Cinema', 'clube_social' => 'Clube Social',
                            'comida_asiatica' => 'Comida Asiática', 'comida_tipica' => 'Comida Típica',
                            'comida_vegetariana' => 'Comida Vegetariana', 'escape_room' => 'Escape Room', 'escola' => 'Escola',
                            'estadio' => 'Estádio', 'feira_livre' => 'Feira Livre', 'galeria_arte' => 'Galeria de Arte',
                            'hamburgueria' => 'Hamburgueria', 'hotel' => 'Hotel', 'igreja_historica' => 'Igreja Histórica',
                            'jardim_botanico' => 'Jardim Botânico', 'karaoke' => 'Karaokê', 'kart' => 'Kart',
                            'loja' => 'Loja', 'loja_artesanato' => 'Loja de Artesanato', 'massagem' => 'Massagem',
                            'mirante' => 'Mirante', 'monumento' => 'Monumento', 'museu' => 'Museu', 'padaria' => 'Padaria',
                            'parque' => 'Parque', 'parque_ambiental' => 'Parque Ambiental', 'parque_aquatico' => 'Parque Aquático',
                            'parque_diversoes' => 'Parque de Diversões', 'pet_shop' => 'Pet Shop', 'pizzaria' => 'Pizzaria',
                            'ponto_turistico' => 'Ponto Turístico', 'pousada' => 'Pousada', 'praca_esportes' => 'Praça de Esportes',
                            'praia' => 'Praia', 'quadra_esportes' => 'Quadra de Esportes', 'resort' => 'Resort',
                            'restaurante' => 'Restaurante', 'rua_famosa' => 'Rua Famosa', 'shopping' => 'Shopping',
                            'sitio_arqueologico' => 'Sítio Arqueológico', 'sorveteria' => 'Sorveteria', 'spa' => 'Spa',
                            'teatro' => 'Teatro', 'trilha' => 'Trilha', 'universidade' => 'Universidade',
                            'zoo_aquario' => 'Zoológico/Aquário', 'outro' => 'Outro'
                        ];
                        @endphp
                        
                        @foreach($categories as $category)
                        <label class="flex items-center p-3 bg-white dark:bg-[#0D1117] rounded-lg border border-gray-200 dark:border-gray-700 hover:border-blue-300 dark:hover:border-blue-500 transition-colors cursor-pointer">
                            <input type="checkbox" name="preferred_categories[]" value="{{ $category }}"
                                {{ in_array($category, $prefs->preferred_categories ?? []) ? 'checked' : '' }}
                                class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                            <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $categoryLabels[$category] ?? $category }}
                            </span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Características Desejadas -->
                <div class="bg-white dark:bg-[#161B22] rounded-2xl p-6 border border-gray-200 dark:border-gray-700 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center mr-3 shadow-md">
                            <i class="fas fa-star text-white text-sm"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Características Desejadas</h2>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Escolha as características que mais importam para você</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 max-h-96 overflow-y-auto p-2">
                        @php
                        $features = [
                            'acessivel', 'cartao_credito', 'reserva', 'ar_condicionado', 'aquecimento',
                            'fumodromo', 'playground', 'esportes', 'familia', 'ambiente_romantico', 'banheiro',
                            'bar', 'bebidas', 'cafe_manha', 'cafe_especial', 'camping', 'cardapio_infantil',
                            'cais_embarcacoes', 'tomadas', 'delivery', 'estacionamento', 'estacionamento_valet',
                            'fraldario', 'jogos', 'jardim', 'musica_ao_vivo', 'sem_gluten', 'opcoes_veganas',
                            'opcoes_vegetarianas', 'pet_friendly', 'piscina', 'cobertura', 'self_service',
                            'terraco', 'tv', 'vista_panoramica', 'wifi'
                        ];
                        
                        $featureLabels = [
                            'acessivel' => 'Acessível', 'cartao_credito' => 'Aceita Cartão', 
                            'reserva' => 'Aceita Reservas', 'ar_condicionado' => 'Ar Condicionado',
                            'aquecimento' => 'Aquecimento', 'fumodromo' => 'Área para Fumantes',
                            'playground' => 'Área de Playground', 'esportes' => 'Área de Esportes',
                            'familia' => 'Ambiente Familiar', 'ambiente_romantico' => 'Ambiente Romântico',
                            'banheiro' => 'Banheiro', 'bar' => 'Bar', 'bebidas' => 'Bebidas Alcoólicas',
                            'cafe_manha' => 'Café da Manhã', 'cafe_especial' => 'Café Especial',
                            'camping' => 'Camping', 'cardapio_infantil' => 'Cardápio Infantil',
                            'cais_embarcacoes' => 'Cais para Embarcações', 'tomadas' => 'Tomadas para Carregar',
                            'delivery' => 'Delivery', 'estacionamento' => 'Estacionamento',
                            'estacionamento_valet' => 'Estacionamento Valet', 'fraldario' => 'Fraldário',
                            'jogos' => 'Jogos/Entretenimento', 'jardim' => 'Jardim', 'musica_ao_vivo' => 'Música ao Vivo',
                            'sem_gluten' => 'Opções Sem Glúten', 'opcoes_veganas' => 'Opções Veganas',
                            'opcoes_vegetarianas' => 'Opções Vegetarianas', 'pet_friendly' => 'Pet Friendly',
                            'piscina' => 'Piscina', 'cobertura' => 'Rooftop', 'self_service' => 'Self Service',
                            'terraco' => 'Terraço', 'tv' => 'TV', 'vista_panoramica' => 'Vista Panorâmica',
                            'wifi' => 'Wi-Fi'
                        ];
                        @endphp
                        
                        @foreach($features as $feature)
                        <label class="flex items-center p-3 bg-white dark:bg-[#0D1117] rounded-lg border border-gray-200 dark:border-gray-700 hover:border-green-300 dark:hover:border-green-500 transition-colors cursor-pointer">
                            <input type="checkbox" name="preferred_features[]" value="{{ $feature }}"
                                {{ in_array($feature, $prefs->preferred_features ?? []) ? 'checked' : '' }}
                                class="rounded border-gray-300 dark:border-gray-600 text-green-500 focus:ring-green-500 dark:focus:ring-green-400 h-4 w-4">
                            <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $featureLabels[$feature] ?? $feature }}
                            </span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Estados de Interesse -->
                <div class="bg-white dark:bg-[#161B22] rounded-2xl p-6 border border-gray-200 dark:border-gray-700 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center mr-3 shadow-md">
                            <i class="fas fa-map-marker-alt text-white text-sm"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Estados de Interesse</h2>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Selecione os estados onde busca locais</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 max-h-96 overflow-y-auto p-2">
                        @php
                        $states = [
                            'AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 'AM' => 'Amazonas',
                            'BA' => 'Bahia', 'CE' => 'Ceará', 'DF' => 'Distrito Federal', 'ES' => 'Espírito Santo',
                            'GO' => 'Goiás', 'MA' => 'Maranhão', 'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul',
                            'MG' => 'Minas Gerais', 'PA' => 'Pará', 'PB' => 'Paraíba', 'PR' => 'Paraná',
                            'PE' => 'Pernambuco', 'PI' => 'Piauí', 'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte',
                            'RS' => 'Rio Grande do Sul', 'RO' => 'Rondônia', 'RR' => 'Roraima', 'SC' => 'Santa Catarina',
                            'SP' => 'São Paulo', 'SE' => 'Sergipe', 'TO' => 'Tocantins'
                        ];
                        @endphp
                        
                        @foreach($states as $code => $state)
                        <label class="flex items-center p-3 bg-white dark:bg-[#0D1117] rounded-lg border border-gray-200 dark:border-gray-700 hover:border-orange-300 dark:hover:border-orange-500 transition-colors cursor-pointer">
                            <input type="checkbox" name="preferred_state[]" value="{{ $code }}"
                                {{ in_array($code, $prefs->preferred_state ?? []) ? 'checked' : '' }}
                                class="rounded border-gray-300 dark:border-gray-600 text-orange-500 focus:ring-orange-500 dark:focus:ring-orange-400 h-4 w-4">
                            <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $state }}
                            </span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Faixa de Orçamento -->
                <div class="bg-white dark:bg-[#161B22] rounded-2xl p-6 border border-gray-200 dark:border-gray-700 shadow-lg">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mr-3 shadow-md">
                            <i class="fas fa-money-bill-wave text-white text-sm"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Faixa de Orçamento</h2>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Defina sua preferência de gastos</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        @php($ranges = ['low' => 'Baixo', 'medium' => 'Médio', 'high' => 'Alto'])
                        @foreach($ranges as $value => $label)
                        <label class="relative">
                            <input type="radio" name="budget_range" value="{{ $value }}"
                                {{ ($prefs->budget_range ?? 'medium') === $value ? 'checked' : '' }}
                                class="sr-only peer">
                            <div class="p-4 border-2 border-gray-200 dark:border-gray-700 rounded-xl cursor-pointer transition-all duration-200 peer-checked:border-purple-500 peer-checked:bg-purple-50 dark:peer-checked:bg-purple-600/20 peer-checked:shadow-lg hover:border-gray-300 dark:hover:border-gray-600 bg-white dark:bg-[#0D1117]">
                                <div class="text-center">
                                    <div class="text-lg font-semibold text-gray-900 dark:text-white peer-checked:text-purple-700 dark:peer-checked:text-purple-300">
                                        {{ $label }}
                                    </div>
                                    <div class="mt-1 flex justify-center">
                                        @if($value === 'low')
                                        <div class="flex space-x-1">
                                            <div class="w-2 h-6 bg-green-400 rounded"></div>
                                            <div class="w-2 h-4 bg-gray-300 dark:bg-gray-600 rounded"></div>
                                            <div class="w-2 h-2 bg-gray-300 dark:bg-gray-600 rounded"></div>
                                        </div>
                                        @elseif($value === 'medium')
                                        <div class="flex space-x-1">
                                            <div class="w-2 h-6 bg-yellow-400 rounded"></div>
                                            <div class="w-2 h-6 bg-yellow-400 rounded"></div>
                                            <div class="w-2 h-4 bg-gray-300 dark:bg-gray-600 rounded"></div>
                                        </div>
                                        @else
                                        <div class="flex space-x-1">
                                            <div class="w-2 h-6 bg-red-400 rounded"></div>
                                            <div class="w-2 h-6 bg-red-400 rounded"></div>
                                            <div class="w-2 h-6 bg-red-400 rounded"></div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Botões de Ação -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white font-semibold py-4 px-6 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-blue-600/25 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Salvar Preferências
                    </button>
                    
                    <a href="{{ url()->previous() }}"
                        class="flex-1 bg-gray-600 hover:bg-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600 text-white font-semibold py-4 px-6 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg flex items-center justify-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Voltar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* Custom scrollbar */
        .overflow-y-auto::-webkit-scrollbar {
            width: 6px;
        }
        
        .overflow-y-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }
        
        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        
        .dark .overflow-y-auto::-webkit-scrollbar-track {
            background: #1e293b;
        }
        
        .dark .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #475569;
        }
    </style>
</x-guest-layout>