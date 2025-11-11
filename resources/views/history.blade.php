<x-guest-layout>

    <body class="bg-white dark:bg-[#0D1117] font-sans text-gray-700 dark:text-gray-300 min-h-screen">
        <main class="max-w-7xl mx-auto px-4 py-8 md:py-12">

            <!-- Cabeçalho -->
            <div class="mb-6 flex justify-between items-center">
                <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('home') }}"
                    class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Voltar
                </a>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">Seu Histórico</h1>
            </div>

            <!-- Filtros e Ações -->
            <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">

                <!-- Dropdown de Filtro -->
                <div class="flex items-center gap-3">
                    <span class="text-gray-700 dark:text-gray-300">Filtrar por:</span>
                    <div class="relative">
                        <select onchange="window.location.href = '{{ route('history') }}?filter=' + this.value"
                            class="bg-white dark:bg-[#161B22] text-gray-900 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 pr-10 
                            focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none cursor-pointer">
                            <option value="all" {{ $filter == 'all'   ? 'selected' : '' }}>Todos os períodos</option>
                            <option value="week" {{ $filter == 'week'  ? 'selected' : '' }}>Última semana</option>
                            <option value="month" {{ $filter == 'month' ? 'selected' : '' }}>Último mês</option>
                            <option value="year" {{ $filter == 'year'  ? 'selected' : '' }}>Último ano</option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                        </div>
                    </div>
                </div>

                @if($history->count() > 0)
                <form action="{{ route('history.clear') }}" method="POST"
                    onsubmit="return confirm('Tem certeza que deseja limpar todo o histórico?')">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition flex items-center">
                        <i class="fas fa-trash mr-2"></i>
                        Limpar Tudo
                    </button>
                </form>
                @endif
            </div>

            <!-- Mensagens -->
            @if(session('success'))
            <div class="mb-6 bg-green-600 text-white p-4 rounded-lg shadow-md">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 bg-red-600 text-white p-4 rounded-lg shadow-md">
                {{ session('error') }}
            </div>
            @endif

            <!-- Conteúdo -->
            @if($history->count() > 0)

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-6">
                @foreach($history as $item)
                @if($item->location)
                <div class="relative group">
                    <a href="{{ route('localfull', $item->location->id) }}" class="block">
                        <div class="bg-white dark:bg-[#161B22] rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 hover:transform hover:scale-105 flex flex-col border border-gray-200 dark:border-gray-700">

                            <!-- Imagem -->
                            <div class="aspect-square overflow-hidden">
                                @php
                                $firstImage = 'default-image.jpg';
                                $images = $item->location->images;

                                if (is_string($images)) {
                                $decodedImages = json_decode($images, true);
                                if (is_array($decodedImages) && count($decodedImages) > 0) {
                                $firstImage = $decodedImages[0];
                                }
                                } elseif (is_array($images) && count($images) > 0) {
                                $firstImage = $images[0];
                                }
                                @endphp
                                <img src="{{ asset('img/' . $firstImage) }}" alt="{{ $item->location->title }}"
                                    class="w-full h-full object-cover transition duration-500">
                            </div>

                            <!-- Conteúdo -->
                            <div class="p-4 flex flex-col flex-1">
                                <h3 class="font-bold text-gray-900 dark:text-white mb-1 line-clamp-1">
                                    {{ $item->location->title }}
                                </h3>

                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                    {{ $item->location->city }} - {{ $item->location->state }}
                                </p>

                                <div class="mt-auto space-y-1 text-xs text-gray-500">
                                    <p><i class="fas fa-clock mr-1"></i> {{ $item->viewed_at->diffForHumans() }}</p>
                                    <p>Em: {{ $item->viewed_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    
                    <!-- Botão Remover -->
                    <form action="{{ route('history.remove', $item->id) }}" method="POST"
                        class="absolute top-3 right-3 z-10">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Remover este item do histórico?')" 
                            class="w-8 h-8 rounded-full bg-white/90 dark:bg-[#1E2229]/90 backdrop-blur-sm flex items-center justify-center hover:bg-red-100 dark:hover:bg-red-600/20 transition-all shadow-md group-hover:scale-110 border border-gray-300 dark:border-gray-700">
                            <i class="fas fa-times text-red-500 dark:text-red-400 text-sm"></i>
                        </button>
                    </form>
                </div>

                <!-- Card sem Local -->
                @else
                <div class="bg-white dark:bg-[#161B22] rounded-xl overflow-hidden shadow-md p-4 text-center relative border border-gray-200 dark:border-gray-700 hover:transform hover:scale-105 transition-all duration-300">
                    <!-- Botão Remover -->
                    <form action="{{ route('history.remove', $item->id) }}" method="POST"
                        class="absolute top-3 right-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Remover este item do histórico?')" 
                            class="w-8 h-8 rounded-full bg-white/90 dark:bg-[#1E2229]/90 backdrop-blur-sm flex items-center justify-center hover:bg-red-100 dark:hover:bg-red-600/20 transition-all shadow-md border border-gray-300 dark:border-gray-700">
                            <i class="fas fa-times text-red-500 dark:text-red-400 text-sm"></i>
                        </button>
                    </form>
                </div>
                @endif
                @endforeach
            </div>

            <!-- Paginação -->
            <div class="mt-8">
                {{ $history->appends(['filter' => $filter])->links() }}
            </div>
        <!-- Histórico Vazio -->
            @else
            <div class="text-center py-12">
                <i class="fas fa-history text-4xl text-gray-400 dark:text-gray-600 mb-4"></i>

                <h2 class="text-xl text-gray-600 dark:text-gray-400 mb-2">
                    @if($filter != 'all')
                    Nenhum local visualizado neste período
                    @else
                    Seu histórico está vazio
                    @endif
                </h2>

                <p class="text-gray-500">Os locais que você visualizar aparecerão aqui.</p>

                <a href="{{ route('home') }}" class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-lg 
                    font-medium transition">
                    <i class="fas fa-compass mr-2"></i>
                    Explorar locais
                </a>
            </div>
            @endif

        </main>
    </body>
</x-guest-layout>