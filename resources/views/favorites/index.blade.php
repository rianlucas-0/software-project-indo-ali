<x-guest-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-7xl mx-auto">
            <!-- Cabeçalho -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">Meus Locais Favoritos</h1>
                <p class="text-gray-400">Locais que você salvou para visitar depois</p>
            </div>

            <!-- Mensagem de sucesso -->
            @if(session('success'))
            <div class="bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-lg mb-6">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
            @endif

            @if($favorites->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-6">
                @foreach($favorites as $favoriteItem)
                @php
                $local = $favoriteItem->location;
                @endphp
                <div
                    class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col relative group">
                    <!-- Botão de Remover Favorito -->
                    <form action="{{ route('favorites.remove', $favoriteItem->id) }}" method="POST"
                        class="absolute top-3 right-3 z-10">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-8 h-8 rounded-full bg-white/90 backdrop-blur-sm flex items-center justify-center 
                                                hover:bg-red-100 transition-all shadow-md group-hover:scale-110"
                            onclick="return confirm('Remover dos favoritos?')">
                            <i class="fas fa-times text-red-500 text-sm"></i>
                        </button>
                    </form>

                    <!-- Imagem -->
                    <div class="aspect-square overflow-hidden">
                        <img src="{{ asset('img/' . $local->firstImage) }}" alt="{{ $local->title }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>

                    <!-- Conteúdo -->
                    <div class="p-4 flex flex-col flex-1">
                        <h3 class="font-bold text-gray-800 mb-1 line-clamp-1">{{ $local->title }}</h3>
                        <p class="text-sm text-gray-500 mb-2">{{ $local->city }} - {{ $local->state }}</p>

                        <!-- Avaliação -->
                        <div class="flex text-yellow-400 text-xs mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <i class="far fa-star"></i>
                        </div>

                        <!-- Link -->
                        <a href="{{ route('localfull', $local->id) }}"
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

            <!-- Paginação -->
            <div class="mt-8">
                {{ $favorites->links() }}
            </div>
            @else
            <!-- Estado vazio -->
            <div class="text-center py-16 bg-[#161B22] rounded-xl">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gray-800 flex items-center justify-center">
                    <i class="fas fa-heart text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Nenhum local favoritado</h3>
                <p class="text-gray-400 mb-4 text-sm">Você ainda não salvou nenhum local nos favoritos</p>
                <a href="{{ route('home') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition text-sm">
                    <i class="fas fa-search mr-2"></i>
                    Explorar locais
                </a>
            </div>
            @endif
        </div>
    </div>
</x-guest-layout>