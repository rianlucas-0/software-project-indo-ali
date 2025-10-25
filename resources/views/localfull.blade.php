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
                    <span class="font-medium text-gray-400">Média de estrelas:
                        {{ number_format($local->average_rating, 1) }}</span>
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
                'acessivel' => ['icon' => 'fas fa-wheelchair', 'label' => 'Acessível'],
                'aquecimento' => ['icon' => 'fas fa-thermometer-full', 'label' => 'Aquecimento'],
                'ar_condicionado' => ['icon' => 'fas fa-snowflake', 'label' => 'Ar Condicionado'],
                'banheiro' => ['icon' => 'fas fa-restroom', 'label' => 'Banheiro'],
                'bar' => ['icon' => 'fas fa-glass-martini-alt', 'label' => 'Bar'],
                'bebidas' => ['icon' => 'fas fa-wine-bottle', 'label' => 'Bebidas Alcoólicas'],
                'cafe_especial' => ['icon' => 'fas fa-coffee', 'label' => 'Café Especial'],
                'cafe_manha' => ['icon' => 'fas fa-bacon', 'label' => 'Café da Manhã'],
                'cais_embarcacoes' => ['icon' => 'fas fa-ship', 'label' => 'Cais para Embarcações'],
                'camping' => ['icon' => 'fas fa-campground', 'label' => 'Camping'],
                'cardapio_infantil' => ['icon' => 'fas fa-child', 'label' => 'Cardápio Infantil'],
                'cartao_credito' => ['icon' => 'fas fa-credit-card', 'label' => 'Aceita Cartão'],
                'cobertura' => ['icon' => 'fas fa-building', 'label' => 'Rooftop'],
                'delivery' => ['icon' => 'fas fa-motorcycle', 'label' => 'Delivery'],
                'esportes' => ['icon' => 'fas fa-basketball-ball', 'label' => 'Área de Esportes'],
                'estacionamento' => ['icon' => 'fas fa-parking', 'label' => 'Estacionamento'],
                'estacionamento_valet' => ['icon' => 'fas fa-car', 'label' => 'Estacionamento Valet'],
                'familia' => ['icon' => 'fas fa-users', 'label' => 'Ambiente Familiar'],
                'fraldario' => ['icon' => 'fas fa-baby', 'label' => 'Fraldário'],
                'fumodromo' => ['icon' => 'fas fa-smoking', 'label' => 'Área para Fumantes'],
                'jardim' => ['icon' => 'fas fa-leaf', 'label' => 'Jardim'],
                'jogos' => ['icon' => 'fas fa-gamepad', 'label' => 'Jogos/Entretenimento'],
                'ambiente_romantico' => ['icon' => 'fas fa-heart', 'label' => 'Ambiente Romântico'],
                'musica_ao_vivo' => ['icon' => 'fas fa-music', 'label' => 'Música ao Vivo'],
                'opcoes_veganas' => ['icon' => 'fas fa-seedling', 'label' => 'Opções Veganas'],
                'opcoes_vegetarianas' => ['icon' => 'fas fa-carrot', 'label' => 'Opções Vegetarianas'],
                'pet_friendly' => ['icon' => 'fas fa-paw', 'label' => 'Pet Friendly'],
                'piscina' => ['icon' => 'fas fa-swimming-pool', 'label' => 'Piscina'],
                'playground' => ['icon' => 'fas fa-slide', 'label' => 'Área de Playground'],
                'reserva' => ['icon' => 'fas fa-calendar-check', 'label' => 'Aceita Reservas'],
                'self_service' => ['icon' => 'fas fa-utensils', 'label' => 'Self Service'],
                'sem_gluten' => ['icon' => 'fas fa-bread-slice', 'label' => 'Opções Sem Glúten'],
                'terraco' => ['icon' => 'fas fa-umbrella-beach', 'label' => 'Terraço'],
                'tomadas' => ['icon' => 'fas fa-plug', 'label' => 'Tomadas para Carregar'],
                'tv' => ['icon' => 'fas fa-tv', 'label' => 'TV'],
                'vista_panoramica' => ['icon' => 'fas fa-mountain', 'label' => 'Vista Panorâmica'],
                'wifi' => ['icon' => 'fas fa-wifi', 'label' => 'Wi-Fi grátis'],
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

                <!-- Sistema de Comentários -->
                <div class="bg-[#161B22] rounded-xl p-6 mt-6">
                    <h2 class="text-2xl font-bold text-white mb-6">Deixe seu Comentário</h2>

                    @auth
                    <form action="{{ route('comments.store', $local->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="rating" class="block text-white mb-2">Avaliação</label>
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++) <input type="radio" name="rating" value="{{ $i }}"
                                    id="rating{{ $i }}" class="hidden">
                                    <label for="rating{{ $i }}" class="text-2xl cursor-pointer">
                                        <i class="far fa-star text-yellow-400 hover:text-yellow-300"></i>
                                    </label>
                                    @endfor
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="content" class="block text-white mb-2">Seu comentário</label>
                            <textarea name="content" id="content" rows="4"
                                class="w-full bg-[#1E2229] border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-blue-400"
                                placeholder="Compartilhe sua experiência..." required></textarea>
                        </div>

                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition">
                            Enviar Comentário
                        </button>
                    </form>
                    @else
                    <div class="text-center py-8">
                        <p class="text-gray-400 mb-4">Faça login para deixar um comentário</p>
                        <a href="{{ route('login') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition">
                            Fazer Login
                        </a>
                    </div>
                    @endauth

                    <!-- Lista de Comentários -->
                    <div class="mt-8">
                        <h3 class="text-xl font-bold text-white mb-6">Comentários ({{ $local->comments->count() }})</h3>

                        @forelse($local->comments as $comment)
                        <div class="bg-[#1E2229] rounded-lg p-5 mb-4 relative">
                            <!-- Botão de deletar (apenas para dono do comentário ou admin) -->
                            @if(Auth::check() && (Auth::id() == $comment->user_id || Auth::user()->is_admin))
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                class="absolute top-4 right-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Tem certeza que deseja excluir este comentário?')"
                                    class="text-gray-400 hover:text-red-400 transition">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                            @endif

                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 rounded-full bg-gray-700 mr-3 overflow-hidden">
                                    <img src="{{ $comment->user->avatar ? asset('img/avatars/' . $comment->user->avatar) : $comment->user->provider_avatar }}"
                                        alt="{{ $comment->user->name }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="font-medium text-white">{{ $comment->user->name }}</h4>
                                    @if($comment->rating)
                                    <div class="flex items-center">
                                        @for($i = 1; $i <= 5; $i++) <i
                                            class="fas fa-star text-{{ $i <= $comment->rating ? 'yellow-400' : 'gray-600' }} text-sm mr-1">
                                            </i>
                                            @endfor
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <p class="text-gray-300">{{ $comment->content }}</p>
                            <div class="mt-3 text-sm text-gray-500">
                                Publicado em {{ $comment->created_at->format('d/m/Y') }}
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-400 text-center py-8">Nenhum comentário ainda. Seja o primeiro a comentar!
                        </p>
                        @endforelse
                    </div>
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

                <!-- Locais Similares -->
                <div class="bg-[#161B22] rounded-xl p-6">
                    <h2 class="text-xl font-bold text-white mb-4">Locais Similares</h2>
                    <div class="space-y-4">
                        @if(isset($similares) && $similares->count())
                            @foreach($similares as $sim)
                                <a href="{{ route('localfull', $sim->id) }}" class="flex items-center cursor-pointer group hover:bg-[#1E2229] rounded-lg p-2 transition">
                                    <div class="w-16 h-16 rounded-lg overflow-hidden mr-4">
                                        <img src="{{ asset('img/' . ($sim->images[0] ?? 'default.jpg')) }}" alt="{{ $sim->title }}" class="w-full h-full object-cover group-hover:scale-105 transition">
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-white group-hover:text-blue-400 transition">{{ $sim->title }}</h3>
                                        <div class="flex items-center text-sm text-gray-400">
                                            <i class="fas fa-map-marker-alt text-xs mr-1"></i>
                                            <span>{{ $sim->city }} - {{ $sim->state }}</span>
                                        </div>
                                        <div class="flex text-yellow-400 text-xs mt-1">
                                            @php
                                                $fullStars = floor($sim->average_rating);
                                                $halfStar = ($sim->average_rating - $fullStars) >= 0.5 ? 1 : 0;
                                                $emptyStars = 5 - $fullStars - $halfStar;
                                            @endphp
                                            @for ($i = 0; $i < $fullStars; $i++) <i class="fas fa-star"></i> @endfor
                                            @if ($halfStar)
                                                <i class="fas fa-star-half-alt"></i>
                                            @endif
                                            @for ($i = 0; $i < $emptyStars; $i++) <i class="far fa-star"></i> @endfor
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <p class="text-gray-400">Nenhum local similar encontrado.</p>
                        @endif
                    </div>
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
                if (!{{Auth::check() ? 'true' : 'false'}}) {
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
                            this.classList.remove('bg-gray-700', 'text-gray-300',
                                'hover:bg-gray-600');
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

    document.addEventListener('DOMContentLoaded', function() {
        // Interatividade das estrelas
        const stars = document.querySelectorAll('input[name="rating"]');
        stars.forEach(star => {
            star.addEventListener('change', function() {
                const rating = this.value;
                // Atualiza a visualização das estrelas
                document.querySelectorAll('label[for^="rating"] i').forEach((icon, index) => {
                    if (index < rating) {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                    } else {
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                    }
                });
            });
        });
    });
    </script>
</x-guest-layout>