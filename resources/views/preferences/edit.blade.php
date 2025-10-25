<x-guest-layout>
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl text-white font-bold mb-6">Minhas Preferências</h1>

        @if(session('success'))
        <div class="mb-4 p-3 bg-green-900/50 border border-green-600 text-green-400 rounded-lg">
            {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('preferences.update') }}" class="space-y-6">
            @csrf
            @method('PATCH')

            <!-- Categorias Preferidas -->
            <div>
                <label class="block text-gray-300 mb-2 font-medium">Categorias Preferidas</label>
                <p class="text-sm text-gray-400 mb-3">Segure Ctrl (ou Cmd) para selecionar múltiplas opções</p>
                <select name="preferred_categories[]" multiple
                    class="w-full bg-[#0D1117] border border-gray-700 rounded-lg p-3 text-white focus:border-blue-500 focus:ring focus:ring-blue-500/20 transition-colors min-h-[120px]">
                    @php($categories = ['Restaurante','Café','Bar','Parque','Museu','Compras'])
                    @foreach($categories as $cat)
                    <option value="{{ $cat }}"
                        {{ in_array($cat, $prefs->preferred_categories ?? []) ? 'selected' : '' }}
                        class="p-2 hover:bg-gray-800">
                        {{ $cat }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Características Desejadas -->
            <div>
                <label class="block text-gray-300 mb-2 font-medium">Características Desejadas</label>
                <p class="text-sm text-gray-400 mb-3">Segure Ctrl (ou Cmd) para selecionar múltiplas opções</p>
                <select name="preferred_features[]" multiple
                    class="w-full bg-[#0D1117] border border-gray-700 rounded-lg p-3 text-white focus:border-blue-500 focus:ring focus:ring-blue-500/20 transition-colors min-h-[120px]">
                    @php($features = ['Wifi','Pet Friendly','Acessível','Ao ar livre','Música ao vivo'])
                    @foreach($features as $feat)
                    <option value="{{ $feat }}"
                        {{ in_array($feat, $prefs->preferred_features ?? []) ? 'selected' : '' }}
                        class="p-2 hover:bg-gray-800">
                        {{ $feat }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Cidades de Interesse -->
            <div>
                <label class="block text-gray-300 mb-2 font-medium">Cidades de Interesse</label>
                <p class="text-sm text-gray-400 mb-3">Segure Ctrl (ou Cmd) para selecionar múltiplas opções</p>
                <select name="preferred_state[]" multiple
                    class="w-full bg-[#0D1117] border border-gray-700 rounded-lg p-3 text-white focus:border-blue-500 focus:ring focus:ring-blue-500/20 transition-colors min-h-[120px]">
                    @php($cities = ['São Paulo','Rio de Janeiro'])
                    @foreach($cities as $city)
                    <option value="{{ $city }}" {{ in_array($city, $prefs->preferred_state ?? []) ? 'selected' : '' }}
                        class="p-2 hover:bg-gray-800">
                        {{ $city }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Faixa de Orçamento -->
            <div class="max-w-xs">
                <label class="block text-gray-300 mb-2 font-medium">Faixa de Orçamento</label>
                <select name="budget_range"
                    class="w-full bg-[#0D1117] border border-gray-700 rounded-lg p-3 text-white focus:border-blue-500 focus:ring focus:ring-blue-500/20 transition-colors">
                    @php($ranges = ['low' => 'Baixo', 'medium' => 'Médio', 'high' => 'Alto'])
                    @foreach($ranges as $value => $label)
                    <option value="{{ $value }}" {{ ($prefs->budget_range ?? '') === $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Botão de Submit -->
            <div class="pt-4">
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 rounded-lg text-white font-medium transition-colors duration-200 shadow-lg hover:shadow-blue-600/25">
                    Salvar Preferências
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>