<a href="{{ route('localfull', $location->id) }}"
    class="bg-[#161B22] rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex flex-col relative group border border-gray-700 cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-400 md:hover:-translate-y-1">
    <!-- Botão de Favorito -->
    <button class="favorite-btn absolute top-3 right-3 z-10" data-location-id="{{ $location->id }}" tabindex="-1">
        <div
            class="w-8 h-8 rounded-full bg-[#1E2229]/90 backdrop-blur-sm flex items-center justify-center 
                    hover:bg-[#1E2229] transition-all shadow-md group-hover:scale-110 border border-gray-700">
            <i class="far fa-heart text-gray-400 text-sm"></i>
        </div>
    </button>

    <!-- Imagem -->
    <div class="aspect-square overflow-hidden">
        <img src="img/{{ $location->firstImage }}" alt="{{ $location->title }}"
            class="w-full h-full object-cover transition duration-500 md:group-hover:scale-110">
    </div>

    <!-- Conteúdo -->
    <div class="p-4 flex flex-col flex-1">
        <h3 class="font-bold text-white mb-1 line-clamp-1">{{ $location->title }}</h3>
        <p class="text-sm text-gray-400 mb-2">{{ $location->city }} - {{ $location->state }}</p>

        <!-- Avaliação -->
        <div class="flex text-yellow-400 text-xs mb-3">
            @php
            $fullStars = floor($location->average_rating); // quantidade de estrelas cheias
            $halfStar = ($location->average_rating - $fullStars) >= 0.5 ? 1 : 0; // estrela pela metade
            $emptyStars = 5 - $fullStars - $halfStar; // estrelas vazias
            @endphp

            {{-- Estrelas cheias --}}
            @for ($i = 0; $i < $fullStars; $i++) <i class="fas fa-star"></i>
                @endfor

                {{-- Estrela pela metade --}}
                @if ($halfStar)
                <i class="fas fa-star-half-alt"></i>
                @endif

                {{-- Estrelas vazias --}}
                @for ($i = 0; $i < $emptyStars; $i++) <i class="far fa-star"></i>
                    @endfor
        </div>
    </div>
</a>
