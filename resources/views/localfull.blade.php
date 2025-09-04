<x-guest-layout>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
    </head>

    <main class="max-w-7xl mx-auto px-4 py-8 md:py-12">

        <!-- Botão Voltar -->
        <div class="mb-6">
            <a href="{{ url()->previous() }}"
                class="inline-flex items-center text-blue-400 hover:text-blue-300 transition">
                <i class="fas fa-arrow-left mr-2"></i> Voltar
            </a>
        </div>

        <!-- Cabeçalho do Local -->
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-2">{{ $local->title }}</h1>

            <div class="flex flex-col md:flex-row md:items-center gap-4 mb-4">
                <div class="flex items-center text-gray-400">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    <span>{{ $local->city }} - {{ $local->state }}</span>
                </div>
                
                <div class="flex items-center text-gray-400">
                    <i class="fas fa-user-circle mr-2"></i>
                    <span>Publicado por <span class="text-blue-400">{{ $local->user_name }}</span></span>
                </div>
            </div>

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex items-center">
                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                    <span class="font-medium text-gray-400">4.8</span>
                    <span class="text-gray-500 ml-1">(128)</span>
                </div>
                
                <!-- Botões de Ação -->
                <div class="flex items-center space-x-3 mt-4 md:mt-0">
                    <!-- Botão de Favorito -->
                    <button id="favorite-btn" data-location-id="{{ $local->id }}"
                        class="favorite-btn flex items-center px-4 py-2 rounded-lg transition 
                   {{ Auth::check() && $local->favorites()->where('user_id', Auth::id())->exists() ? 'bg-red-100 text-red-600' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                        <i
                            class="{{ Auth::check() && $local->favorites()->where('user_id', Auth::id())->exists() ? 'fas' : 'far' }} fa-heart mr-2"></i>
                        <span
                            id="favorite-text">{{ Auth::check() && $local->favorites()->where('user_id', Auth::id())->exists() ? 'Favoritado' : 'Favoritar' }}</span>
                    </button>

                    <!-- Botão de Compartilhar -->
                    <button id="share-btn"
                        class="flex items-center px-4 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 transition">
                        <i class="fas fa-share-alt mr-2"></i>
                        <span class=" sm:inline">Compartilhar</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Imagem em Destaque -->
        @if($local->images)
        <div class="mb-8 rounded-xl overflow-hidden shadow-2xl">
            <img src="{{ asset('img/' . $local->firstImage) }}" alt="{{ $local->title }}"
                class="w-full h-auto object-cover max-h-[600px]">
        </div>
        @endif

        <!-- Detalhes do Local -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Coluna Principal -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Descrição -->
                <div class="bg-[#161B22] rounded-xl p-6">
                    <h2 class="text-xl font-bold text-white mb-4">Descrição</h2>
                    <p class="text-gray-300 leading-relaxed">{{ $local->description }}</p>
                </div>

                @php
                $featuresMap = [
                'wifi' => ['icon' => 'fas fa-wifi', 'label' => 'Wi-Fi grátis'],
                'estacionamento' => ['icon' => 'fas fa-parking', 'label' => 'Estacionamento'],
                'acessivel' => ['icon' => 'fas fa-wheelchair', 'label' => 'Acessível'],
                'ar_condicionado' => ['icon' => 'fas fa-snowflake', 'label' => 'Ar Condicionado'],
                'academia' => ['icon' => 'fas fa-dumbbell', 'label' => 'Academia'],
                'piscina' => ['icon' => 'fas fa-swimming-pool', 'label' => 'Piscina'],
                'restaurante' => ['icon' => 'fas fa-utensils', 'label' => 'Restaurante'],
                ];
                @endphp

                <!-- Características -->
                <div class="bg-[#161B22] rounded-xl p-6">
                    <h2 class="text-xl font-bold text-white mb-4">Características</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($local->features as $featureKey)
                        @php
                        $feature = $featuresMap[$featureKey] ?? null;
                        @endphp
                        @if($feature)
                        <div class="flex items-center text-white">
                            <i class="{{ $feature['icon'] }} text-blue-400 mr-2"></i>
                            <span>{{ $feature['label'] }}</span>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>

                <div class="bg-[#161B22] rounded-xl p-6 lg:hidden">
                    <h2 class="text-xl font-bold text-white mb-4">Contato</h2>

                    <div class="space-y-4">
                        <div class="flex items-center">
                            <i class="fas fa-phone text-blue-400 mr-3 w-5"></i>
                            <span class="text-white">{{ $local->phone }}</span>
                        </div>

                        <div class="flex items-center">
                            <i class="fas fa-envelope text-blue-400 mr-3 w-5"></i>
                            <span
                                class="text-white">{{ str_replace(' ', '', strtolower($local->contact_email)) }}.com</span>
                        </div>

                        <div class="flex items-center">
                            <i class="fas fa-globe text-blue-400 mr-3 w-5"></i>
                            <span
                                class="text-white">www.{{ str_replace(' ', '', strtolower($local->title)) }}.com</span>
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
                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($local->address) }}, {{ $local->neighborhood }}, {{ $local->city }}-{{ $local->state }}, {{ $local->cep }}"
                            target="_blank"
                            class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-4 rounded-lg font-medium transition">
                            <i class="fas fa-map-marked-alt mr-2"></i> Ver no Mapa
                        </a>
                    </div>
                </div>

                <!-- Galeria -->
                <div class="bg-[#161B22] rounded-xl p-6">
                    <h2 class="text-xl font-bold text-white mb-4">Galeria</h2>
                    @if(count($local->images) > 0)
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($local->images as $image)
                        <a href="{{ asset('img/' . $image) }}" class="glightbox">
                            <div class="rounded-lg overflow-hidden cursor-pointer hover:opacity-90 transition">
                                <img src="{{ asset('img/' . $image) }}" alt="Imagem" class="w-full h-32 object-cover">
                            </div>
                        </a>
                        @endforeach
                    </div>
                    @else
                    <p class="text-gray-400">Nenhuma imagem disponível</p>
                    @endif
                </div>

                <!-- Avaliações -->
                <div class="bg-[#161B22] rounded-xl p-6">
                    <h2 class="text-2xl font-bold text-white mb-6">Avaliações</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        @for($i = 1; $i <= 2; $i++) <div class="bg-[#1E2229] rounded-lg p-5">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 rounded-full bg-gray-700 mr-3 overflow-hidden">
                                    <img src="https://i.pravatar.cc/100?img={{ $i+10 }}" alt="User"
                                        class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="font-medium text-white">Maria Silva</h4>
                                    <div class="flex items-center">
                                        @for($j = 1; $j <= 5; $j++) <i
                                            class="fas fa-star text-{{ $j <= 4 ? 'yellow-400' : 'gray-600' }} text-sm mr-1">
                                            </i>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-300">"Adorei a experiência neste local! O atendimento foi excelente e as
                                instalações são de primeira qualidade. Recomendo a todos!"</p>
                            <div class="mt-3 text-sm text-gray-500">Publicado em 15/06/2023</div>
                    </div>
                    @endfor
                </div>

                <button
                    class="w-full md:w-auto bg-transparent border border-blue-400 text-blue-400 hover:bg-blue-400 hover:text-white py-2 px-6 rounded-lg transition">
                    Carregar mais avaliações
                </button>
            </div>

        </div>

        <!-- Barra Lateral -->
        <div class="lg:col-span-1 space-y-6 hidden lg:block">

            <!-- Cartão de Contato -->
            <div class="bg-[#161B22] rounded-xl p-6">
                <h2 class="text-xl font-bold text-white mb-4">Contato</h2>

                <div class="space-y-4">
                    <div class="flex items-center">
                        <i class="fas fa-phone text-blue-400 mr-3 w-5"></i>
                        <span class="text-white">{{ $local->phone }}</span>
                    </div>

                    <div class="flex items-center">
                        <i class="fas fa-envelope text-blue-400 mr-3 w-5"></i>
                        <span
                            class="text-white">{{ str_replace(' ', '', strtolower($local->contact_email)) }}.com</span>
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
                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($local->address) }}, {{ $local->neighborhood }}, {{ $local->city }}-{{ $local->state }}, {{ $local->cep }}"
                        target="_blank"
                        class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-4 rounded-lg font-medium transition">
                        <i class="fas fa-map-marked-alt mr-2"></i> Ver no Mapa
                    </a>
                </div>
            </div>

            <!-- Locais Similares -->
            <div class="bg-[#161B22] rounded-xl p-6">
                <h2 class="text-xl font-bold text-white mb-4">Locais Similares</h2>

                <div class="space-y-4">
                    @for($i = 1; $i <= 3; $i++) <div class="flex items-center cursor-pointer group">
                        <div class="w-16 h-16 rounded-lg overflow-hidden mr-4">
                            <img src="https://placehold.co/100/161B22/3B82F6?text=Local+{{ $i }}"
                                alt="Local similar {{ $i }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition">
                        </div>
                        <div>
                            <h3 class="font-medium text-white group-hover:text-blue-400 transition">Local Similar
                                {{ $i }}</h3>
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

    </main>
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <script>
    const lightbox = GLightbox({
        touchNavigation: true,
        loop: true,
        autoplayVideos: false
    });
    document.addEventListener('DOMContentLoaded', function() {
        const baseUrl = '{{ url("/") }}';

        // Botão de Favorito
        const favoriteBtn = document.getElementById('favorite-btn');
        const favoriteText = document.getElementById('favorite-text');

        if (favoriteBtn) {
            favoriteBtn.addEventListener('click', async function() {
                if (!{{ Auth::check() ? 'true' : 'false' }}) {
                    window.location.href = '{{ route("login") }}';
                    return;
                }

                const locationId = this.getAttribute('data-location-id');
                const heartIcon = this.querySelector('i');

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

                        if (data.favorited) {
                            this.classList.add('bg-red-100', 'text-red-600');
                            this.classList.remove('bg-gray-700', 'text-gray-300', 'hover:bg-gray-600');
                            heartIcon.classList.remove('far');
                            heartIcon.classList.add('fas');
                            favoriteText.textContent = 'Favoritado';
                        } else {
                            this.classList.remove('bg-red-100', 'text-red-600');
                            this.classList.add('bg-gray-700', 'text-gray-300', 'hover:bg-gray-600');
                            heartIcon.classList.remove('fas');
                            heartIcon.classList.add('far');
                            favoriteText.textContent = 'Favoritar';
                        }
                    }
                } catch (error) {
                    console.error('Erro:', error);
                }
            });
        }

        // Botão de Compartilhar
        const shareBtn = document.getElementById('share-btn');

        if (shareBtn) {
            shareBtn.addEventListener('click', async function() {
                if (navigator.share) {
                    try {
                        await navigator.share({
                            title: '{{ $local->title }}',
                            text: 'Confira este local incrível: {{ $local->title }}',
                            url: window.location.href
                        });
                    } catch (error) {
                        copyToClipboard();
                    }
                } else {
                    copyToClipboard();
                }
            });

            function copyToClipboard() {
                const tempInput = document.createElement('input');
                tempInput.value = window.location.href;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);

                const originalText = shareBtn.querySelector('span').textContent;
                shareBtn.querySelector('span').textContent = 'Link copiado!';

                setTimeout(() => {
                    shareBtn.querySelector('span').textContent = originalText;
                }, 2000);
            }
        }
    });
    </script>
</x-guest-layout>