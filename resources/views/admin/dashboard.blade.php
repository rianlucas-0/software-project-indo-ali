<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4 px-2 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="bg-green-600/20 border border-green-500/30 text-green-400 px-4 py-3 rounded-lg mb-6 flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-600/20 border border-red-500/30 text-red-400 px-4 py-3 rounded-lg mb-6 flex items-center">
                <i class="fa-solid fa-circle-xmark m-2"></i>
                {{ session('error') }}
            </div>
        @endif
        <div class="max-w-7xl mx-auto">
            <div class="bg-[#161B22] shadow-lg rounded-xl overflow-hidden border border-gray-700 mb-6">
                <div class="p-4 sm:p-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-4">
                        <h1 class="text-xl sm:text-2xl font-bold text-white flex items-center">
                            <i class="fas fa-tachometer-alt text-blue-400 mr-2 text-sm sm:text-base"></i>
                            Admin Dashboard
                        </h1>
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('admin.addlocal') }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg flex items-center transition-colors text-sm sm:text-base">
                                <i class="fas fa-plus mr-2 text-xs sm:text-sm"></i> Adicionar Local
                            </a>
                            <a href="{{ route('admin.dashboard.export') }}" class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg flex items-center transition-colors text-sm sm:text-base">
                                <i class="fas fa-download mr-2 text-xs sm:text-sm"></i> Exportar Dados
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
                <div class="bg-[#161B22] p-4 rounded-xl border border-gray-700">
                    <div class="flex items-center">
                        <div class="rounded-lg bg-blue-500/20 p-3 mr-4">
                            <i class="fas fa-map-marker-alt text-blue-400"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Total de Locais</p>
                            <p class="text-xl font-bold text-white">{{ $totalLocals }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-[#161B22] p-4 rounded-xl border border-gray-700">
                    <div class="flex items-center">
                        <div class="rounded-lg bg-green-500/20 p-3 mr-4">
                            <i class="fas fa-check-circle text-green-400"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Ativos</p>
                            <p class="text-xl font-bold text-white">{{ $activeLocals }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-[#161B22] p-4 rounded-xl border border-gray-700">
                    <div class="flex items-center">
                        <div class="rounded-lg bg-red-500/20 p-3 mr-4">
                            <i class="fas fa-times-circle text-red-400"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Inativos</p>
                            <p class="text-xl font-bold text-white">{{ $inactiveLocals }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-[#161B22] p-4 rounded-xl border border-gray-700">
                    <div class="flex items-center">
                        <div class="rounded-lg bg-purple-500/20 p-3 mr-4">
                            <i class="fas fa-eye text-purple-400"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Visualizações (30d)</p>
                            <p class="text-xl font-bold text-white">{{ $totalViewsLast30 }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-[#161B22] p-4 rounded-xl border border-gray-700">
                    <div class="flex items-center">
                        <div class="rounded-lg bg-yellow-500/20 p-3 mr-4">
                            <i class="fas fa-heart text-yellow-400"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Favoritos</p>
                            <p class="text-xl font-bold text-white">{{ $totalFavorites }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-[#161B22] shadow-lg rounded-xl overflow-hidden border border-gray-700 mb-6">
                <div class="p-4 sm:p-6">
                    <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                        <i class="fas fa-chart-bar text-blue-400 mr-2"></i>
                        Métricas de Desempenho
                    </h3>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-1">
                            <h4 class="text-white font-medium mb-3 text-center">Visualizações (30 dias)</h4>
                            <div class="h-64">
                                <canvas id="viewsChart"></canvas>
                            </div>
                        </div>
                        
                        <div class="lg:col-span-1">
                            <h4 class="text-white font-medium mb-3 text-center">Favoritos por Local</h4>
                            <div class="h-64">
                                <canvas id="favoritesChart"></canvas>
                            </div>
                        </div>
                        
                        <div class="lg:col-span-1">
                            <h4 class="text-white font-medium mb-3 text-center">Avaliações Médias</h4>
                            <div class="h-64">
                                <canvas id="ratingsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-[#161B22] shadow-lg rounded-xl overflow-hidden border border-gray-700">
                <div class="p-4 sm:p-6">
                    <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                        <i class="fas fa-list text-blue-400 mr-2"></i>
                        Lista de Locais
                    </h3>
                    
                    <div class="overflow-x-auto hidden sm:block">
                        <table class="w-full bg-[#1E2229] rounded-lg overflow-hidden">
                            <thead class="bg-[#0D1117] text-gray-300">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Local</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Visualizações</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Favoritos</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Avaliação</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @foreach($labels as $index => $label)
                                <tr class="hover:bg-[#1E2229]/80 transition-colors">
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-blue-500/20 rounded-lg flex items-center justify-center mr-3">
                                                <i class="fas fa-map-marker-alt text-blue-400 text-sm"></i>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-white">{{ $label }}</div>
                                                <div class="text-xs text-gray-400">ID: {{ $index + 1 }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="text-sm text-white">{{ $viewsData[$index] ?? 0 }}</div>
                                        <div class="text-xs text-gray-400">últimos 30 dias</div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-white">{{ $favoritesData[$index] ?? 0 }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm text-white mr-2">{{ $avgRatingData[$index] ?? 0 }}</div>
                                            <div class="flex text-yellow-400">
                                                @for($i = 0; $i < 5; $i++)
                                                    @if($i < floor($avgRatingData[$index] ?? 0))
                                                        <i class="fas fa-star text-xs"></i>
                                                    @else
                                                        <i class="far fa-star text-xs"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        @if(($index % 3) == 0)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500/20 text-green-400">
                                                Ativo
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500/20 text-red-400">
                                                Inativo
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.updatelocal', $localIds[$index]) }}" class="text-blue-400 hover:text-white bg-blue-600/20 hover:bg-blue-600 px-2 py-1 rounded-md flex items-center transition-colors text-xs">
                                                <i class="fas fa-edit mr-1 text-xs"></i>
                                                <span>Editar</span>
                                            </a>
                                            <form action="{{ route('admin.deletelocal', $localIds[$index]) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este local?');" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-white bg-red-600/20 hover:bg-red-600 px-2 py-1 rounded-md flex items-center transition-colors text-xs">
                                                    <i class="fas fa-trash-alt mr-1 text-xs"></i>
                                                    <span>Excluir</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="space-y-3 sm:hidden">
                        @foreach($labels as $index => $label)
                        <div class="bg-[#1E2229] rounded-lg p-4 border border-gray-700">
                            <div class="flex justify-between items-start mb-2">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 bg-blue-500/20 rounded-lg flex items-center justify-center mr-2">
                                        <i class="fas fa-map-marker-alt text-blue-400 text-xs"></i>
                                    </div>
                                    <div>
                                        <div class="font-medium text-white text-sm">{{ $label }}</div>
                                        <div class="text-xs text-gray-400">ID: {{ $index + 1 }}</div>
                                    </div>
                                </div>
                                @if(($index % 3) == 0)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500/20 text-green-400">
                                        Ativo
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500/20 text-red-400">
                                        Inativo
                                    </span>
                                @endif
                            </div>
                            
                            <div class="grid grid-cols-2 gap-2 mb-3">
                                <div class="text-center p-2 bg-[#0D1117] rounded-lg">
                                    <div class="text-xs text-gray-400">Visualizações</div>
                                    <div class="text-white font-medium">{{ $viewsData[$index] ?? 0 }}</div>
                                </div>
                                <div class="text-center p-2 bg-[#0D1117] rounded-lg">
                                    <div class="text-xs text-gray-400">Favoritos</div>
                                    <div class="text-white font-medium">{{ $favoritesData[$index] ?? 0 }}</div>
                                </div>
                                <div class="text-center p-2 bg-[#0D1117] rounded-lg">
                                    <div class="text-xs text-gray-400">Avaliação</div>
                                    <div class="text-white font-medium">{{ $avgRatingData[$index] ?? 0 }}</div>
                                </div>
                                <div class="text-center p-2 bg-[#0D1117] rounded-lg">
                                    <div class="text-xs text-gray-400">Status</div>
                                    <div class="flex justify-center mt-1">
                                        @for($i = 0; $i < 5; $i++)
                                            @if($i < floor($avgRatingData[$index] ?? 0))
                                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                                            @else
                                                <i class="far fa-star text-yellow-400 text-xs"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.updatelocal', $localIds[$index]) }}" class="text-blue-400 hover:text-white bg-blue-600/20 hover:bg-blue-600 px-2 py-1 rounded-md flex items-center justify-center transition-colors text-xs flex-1">
                                    <i class="fas fa-edit mr-1 text-xs"></i>
                                    <span>Editar</span>
                                </a>
                                <form action="{{ route('admin.deletelocal', $localIds[$index]) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este local?');" style="display:inline;" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-white bg-red-600/20 hover:bg-red-600 px-2 py-1 rounded-md flex items-center justify-center transition-colors text-xs w-full">
                                        <i class="fas fa-trash-alt mr-1 text-xs"></i>
                                        <span>Excluir</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = {!! json_encode($labels) !!};
        const viewsData = {!! json_encode($viewsData) !!};
        const favoritesData = {!! json_encode($favoritesData) !!};
        const avgRatingData = {!! json_encode($avgRatingData) !!};

        Chart.defaults.color = '#9CA3AF';
        Chart.defaults.borderColor = '#374151';

        function makeBarChart(ctxId, label, data, background='rgba(59, 130, 246, 0.7)'){
            const ctx = document.getElementById(ctxId).getContext('2d');
            return new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        backgroundColor: background,
                        borderColor: 'rgba(255, 255, 255, 0.1)',
                        borderWidth: 1,
                        borderRadius: 6,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: { 
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(55, 65, 81, 0.5)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function(){
            makeBarChart('viewsChart', 'Visualizações (30d)', viewsData, 'rgba(16, 185, 129, 0.7)');
            makeBarChart('favoritesChart', 'Favoritos', favoritesData, 'rgba(239, 68, 68, 0.7)');
            makeBarChart('ratingsChart', 'Avaliação média', avgRatingData, 'rgba(139, 92, 246, 0.7)');
        });
    </script>
</x-guest-layout>