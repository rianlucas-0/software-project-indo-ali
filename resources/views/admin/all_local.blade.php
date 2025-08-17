<x-guest-layout>
    <div class="py-4 px-2 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="bg-[#161B22] shadow-lg rounded-xl overflow-hidden border border-gray-700">
                <div class="p-4 sm:p-6">
                    <div class="flex flex-col justify-between items-start gap-3 mb-4">
                        <h1 class="text-xl sm:text-2xl font-bold text-white flex items-center">
                            <i class="fas fa-map-marker-alt text-blue-400 mr-2 text-sm sm:text-base"></i>
                            Gerenciamento de Locais
                        </h1>
                        <a href="{{ route('admin.addlocal') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg flex items-center transition-colors text-sm sm:text-base w-full sm:w-auto justify-center">
                            <i class="fas fa-plus mr-2 text-xs sm:text-sm"></i> Adicionar Local
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full bg-[#1E2229] rounded-lg overflow-hidden hidden sm:table">
                            <thead class="bg-[#0D1117] text-gray-300">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">ID</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Título
                                    </th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider hidden md:table-cell">
                                        Descrição</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Imagem
                                    </th>
                                    <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Ações
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @foreach($local as $locations)
                                <tr class="hover:bg-[#1E2229]/80 transition-colors">
                                    <td
                                        class="px-4 py-3 whitespace-nowrap text-xs sm:text-sm font-medium text-gray-300">
                                        {{ $locations->id }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-xs sm:text-sm text-gray-300">
                                        {{ $locations->title }}</td>
                                    <td class="px-4 py-3 text-xs sm:text-sm text-gray-400 hidden md:table-cell">
                                        {{ Str::limit($locations->description, 50) }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <img class="w-12 h-12 sm:w-16 sm:h-16 object-cover rounded-md border border-gray-600"
                                            src="{{ asset('img/'.$locations->first_image) }}"
                                            alt="{{ $locations->title }}">
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-xs sm:text-sm font-medium">
                                        <div class="flex flex-wrap gap-1 sm:gap-2">
                                            <a href="{{ route('admin.updatelocal', $locations->id) }}"
                                                class="text-blue-400 hover:text-white bg-blue-600/20 hover:bg-blue-600 px-2 py-1 sm:px-3 sm:py-2 rounded-md flex items-center justify-center transition-colors text-xs sm:text-sm w-16 sm:w-24">
                                                <i class="fas fa-edit mr-1 sm:mr-2 text-xs"></i>
                                                <span>Editar</span>
                                            </a>
                                            <form action="" method="POST"
                                                onsubmit="return confirm('Tem certeza que deseja excluir este local?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-400 hover:text-white bg-red-600/20 hover:bg-red-600 px-2 py-1 sm:px-3 sm:py-2 rounded-md flex items-center justify-center transition-colors text-xs sm:text-sm w-16 sm:w-24">
                                                    <i class="fas fa-trash-alt mr-1 sm:mr-2 text-xs"></i>
                                                    <span>Excluir</span>
                                                </button>
                                            </form>
                                            <button onclick="alert('Funcionalidade de PDF será implementada aqui')"
                                                class="text-green-400 hover:text-white bg-green-600/20 hover:bg-green-600 px-2 py-1 sm:px-3 sm:py-2 rounded-md flex items-center justify-center transition-colors text-xs sm:text-sm w-16 sm:w-24">
                                                <i class="fas fa-file-pdf mr-1 sm:mr-2 text-xs"></i>
                                                <span>PDF</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="space-y-3 sm:hidden">
                            @foreach($local as $locations)
                            <div class="bg-[#1E2229] rounded-lg p-4 border border-gray-700">
                                <div class="flex items-start gap-3">
                                    <img class="w-16 h-16 object-cover rounded-md border border-gray-600"
                                        src="{{ asset('img/'.$locations->first_image) }}" alt="{{ $locations->title }}">
                                    <div class="flex-1">
                                        <div class="font-medium text-white">{{ $locations->title }}</div>
                                        <div class="text-xs text-gray-400 mt-1">ID: {{ $locations->id }}</div>
                                        <div class="text-xs text-gray-400 line-clamp-2 mt-1">
                                            {{ Str::limit($locations->description, 60) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-wrap gap-2 mt-3">
                                    <a href="{{ route('admin.updatelocal', $locations->id) }}"
                                        class="text-blue-400 hover:text-white bg-blue-600/20 hover:bg-blue-600 px-3 py-1 rounded-md flex items-center justify-center transition-colors text-xs flex-1">
                                        <i class="fas fa-edit mr-1 text-xs"></i>
                                        <span>Editar</span>
                                    </a>
                                    <form action="" method="POST" class="flex-1"
                                        onsubmit="return confirm('Tem certeza que deseja excluir este local?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-full text-red-400 hover:text-white bg-red-600/20 hover:bg-red-600 px-3 py-1 rounded-md flex items-center justify-center transition-colors text-xs">
                                            <i class="fas fa-trash-alt mr-1 text-xs"></i>
                                            <span>Excluir</span>
                                        </button>
                                    </form>
                                    <button onclick="alert('Funcionalidade de PDF será implementada aqui')"
                                        class="text-green-400 hover:text-white bg-green-600/20 hover:bg-green-600 px-3 py-1 rounded-md flex items-center justify-center transition-colors text-xs flex-1">
                                        <i class="fas fa-file-pdf mr-1 text-xs"></i>
                                        <span>PDF</span>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    @if($local->isEmpty())
                    <div class="text-center py-6 text-gray-400">
                        <i class="fas fa-map-marked-alt text-3xl mb-3 text-gray-600"></i>
                        <p class="text-sm sm:text-base">Nenhum local encontrado</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>