<x-guest-layout>
    <body class="bg-[#0D1117] font-sans text-gray-300">
        <main class="max-w-7xl mx-auto px-4 py-8 md:py-12">
            
            <!-- Botão Voltar -->
            <div class="mb-6">
                <a href="{{ url()->previous() }}" class="inline-flex items-center text-blue-400 hover:text-blue-300 transition">
                    <i class="fas fa-arrow-left mr-2"></i> Voltar
                </a>
            </div>

            <!-- Cabeçalho do Local -->
            <div class="mb-8">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-2">{{ $local->title }}</h1>
                
                <div class="flex items-center text-gray-400 mb-4">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    <span>{{ $local->city }} - {{ $local->state }}</span>
                </div>
                
                <div class="flex items-center">
                    <div class="flex items-center mr-6">
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <span class="font-medium text-gray-400">4.8</span>
                        <span class="text-gray-500 ml-1">(128)</span>
                    </div>
                    
                    <div class="flex items-center">
                        <i class="fas fa-user-circle text-gray-400 mr-2"></i>
                        <span class="text-gray-400">Publicado por <span class="text-blue-400">{{ $local->user_name }}</span></span>
                    </div>
                </div>
            </div>

            <!-- Imagem em Destaque -->
            @if($local->images)
                <div class="mb-8 rounded-xl overflow-hidden shadow-2xl">
                    <img src="{{ asset('img/' . $local->firstImage) }}" alt="{{ $local->title }}" class="w-full h-auto object-cover max-h-[600px]">
                </div>
            @endif

            <!-- Detalhes do Local -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Conteúdo Principal -->
                <div class="lg:col-span-2">
                    
                    <!-- Descrição -->
                    <div class="bg-[#161B22] rounded-xl p-6 mb-8">
                        <h2 class="text-xl font-bold text-white mb-4">Descrição</h2>
                        <p class="text-gray-300 leading-relaxed">{{ $local->description }}</p>
                    </div>

                    <!-- Características -->
                    <div class="bg-[#161B22] rounded-xl p-6 mb-8">
                        <h2 class="text-xl font-bold text-white mb-4">Características</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <div class="flex items-center text-white">
                                <i class="fas fa-wifi text-blue-400 mr-2"></i>
                                <span>Wi-Fi Grátis</span>
                            </div>
                            <div class="flex items-center text-white">
                                <i class="fas fa-parking text-blue-400 mr-2"></i>
                                <span>Estacionamento</span>
                            </div>
                            <div class="flex items-center text-white">
                                <i class="fas fa-utensils text-blue-400 mr-2"></i>
                                <span>Restaurante</span>
                            </div>
                            <div class="flex items-center text-white">
                                <i class="fas fa-swimming-pool text-blue-400 mr-2"></i>
                                <span>Piscina</span>
                            </div>
                            <div class="flex items-center text-white">
                                <i class="fas fa-snowflake text-blue-400 mr-2"></i>
                                <span>Ar Condicionado</span>
                            </div>
                            <div class="flex items-center text-white">
                                <i class="fas fa-dumbbell text-blue-400 mr-2"></i>
                                <span>Academia</span>
                            </div>
                        </div>
                    </div>

                    <!-- Galeria -->
                    <div class="bg-[#161B22] rounded-xl p-6">
                        <h2 class="text-xl font-bold text-white mb-4">Galeria</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @for($i = 1; $i <= 6; $i++)
                                <div class="rounded-lg overflow-hidden cursor-pointer hover:opacity-90 transition">
                                    <img src="https://placehold.co/300x200/161B22/3B82F6?text=Imagem+{{ $i }}" alt="Imagem {{ $i }}" class="w-full h-32 object-cover">
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <!-- Barra Lateral -->
                <div class="lg:col-span-1">
                    
                    <!-- Cartão de Contato -->
                    <div class="bg-[#161B22] rounded-xl p-6 top-4 mb-6">
                        <h2 class="text-xl font-bold text-white mb-4">Contato</h2>
                        
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <i class="fas fa-phone text-blue-400 mr-3 w-5"></i>
                                <span class="text-white">{{ $local->phone }}</span>
                            </div>
                            
                            <div class="flex items-center">
                                <i class="fas fa-envelope text-blue-400 mr-3 w-5"></i>
                                <span class="text-white">{{ str_replace(' ', '', strtolower($local->contact_email)) }}.com</span>
                            </div>
                            
                            <div class="flex items-center">
                                <i class="fas fa-globe text-blue-400 mr-3 w-5"></i>
                                <span class="text-white">www.{{ str_replace(' ', '', strtolower($local->title)) }}.com</span>
                            </div>
                        </div>

                        @if($local->formatted_working_hours)
                            <div class="flex items-start mt-4">
                                <i class="fas fa-clock text-blue-400 mr-3 w-5 mt-1"></i>
                                <div class="text-white">
                                    @foreach($local->formatted_working_hours as $hourInfo)
                                        <div>{{ $hourInfo }}</div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                        <div class="mt-6 pt-6 border-t border-gray-700">
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($local->address) }}, {{ $local->neighborhood }}, {{ $local->city }}-{{ $local->state }}, {{ $local->cep }}" target="_blank" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-4 rounded-lg font-medium transition">
                                <i class="fas fa-map-marked-alt mr-2"></i> Ver no Mapa
                            </a>
                        </div>
                    </div>

                    <!-- Locais Similares -->
                    <div class="bg-[#161B22] rounded-xl p-6">
                        <h2 class="text-xl font-bold text-white mb-4">Locais Similares</h2>
                        
                        <div class="space-y-4">
                            @for($i = 1; $i <= 3; $i++)
                                <div class="flex items-center cursor-pointer group">
                                    <div class="w-16 h-16 rounded-lg overflow-hidden mr-4">
                                        <img src="https://placehold.co/100/161B22/3B82F6?text=Local+{{ $i }}" alt="Local similar {{ $i }}" class="w-full h-full object-cover group-hover:scale-105 transition">
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-white group-hover:text-blue-400 transition">Local Similar {{ $i }}</h3>
                                        <div class="flex items-center text-sm text-gray-400">
                                            <i class="fas fa-map-marker-alt text-xs mr-1"></i>
                                            <span>Luanda</span>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção de Avaliações -->
            <div class="mt-12 bg-[#161B22] rounded-xl p-6">
                <h2 class="text-2xl font-bold text-white mb-6">Avaliações</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    @for($i = 1; $i <= 2; $i++)
                        <div class="bg-[#1E2229] rounded-lg p-5">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 rounded-full bg-gray-700 mr-3 overflow-hidden">
                                    <img src="https://i.pravatar.cc/100?img={{ $i+10 }}" alt="User" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="font-medium text-white">Maria Silva</h4>
                                    <div class="flex items-center">
                                        @for($j = 1; $j <= 5; $j++)
                                            <i class="fas fa-star text-{{ $j <= 4 ? 'yellow-400' : 'gray-600' }} text-sm mr-1"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-300">"Adorei a experiência neste local! O atendimento foi excelente e as instalações são de primeira qualidade. Recomendo a todos!"</p>
                            <div class="mt-3 text-sm text-gray-500">Publicado em 15/06/2023</div>
                        </div>
                    @endfor
                </div>

                <button class="w-full md:w-auto bg-transparent border border-blue-400 text-blue-400 hover:bg-blue-400 hover:text-white py-2 px-6 rounded-lg transition">
                    Carregar mais avaliações
                </button>
            </div>
        </main>
    </body>
</x-guest-layout>
