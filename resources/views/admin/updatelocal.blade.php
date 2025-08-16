<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('status'))
                    <div class="bg-green-400 alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="{{ route('admin.localupdate', $local->id) }}" method="post"
                        enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                            <input type="text" name="title" id="title" value="{{$local->title}}"
                                class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                            <textarea name="description" id="description" rows="4"
                                class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $local->description) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Imagens (Máx. 7)</label>

                            @php
                            $images = json_decode($local->images ?? '[]', true);
                            @endphp

                            <div class="mt-2 grid grid-cols-3 gap-2" id="existing-images">
                                @foreach($images as $index => $image)
                                <div class="relative group">
                                    <img src="{{ asset('img/' . $image) }}" alt="Imagem do local"
                                        class="w-full h-32 object-cover rounded border border-gray-200">
                                    <button type="button"
                                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"
                                        onclick="removeExistingImage(this, '{{ $image }}')">
                                        ×
                                    </button>
                                    <input type="hidden" name="existing_images[]" value="{{ $image }}">
                                </div>
                                @endforeach
                            </div>

                            <div id="image-preview" class="mt-2 grid grid-cols-3 gap-2"></div>

                            <input type="file" name="images[]" id="images" multiple
                                class="mt-1 block w-full text-sm text-gray-700" accept="image/*">

                            <input type="hidden" name="images_to_remove" id="images_to_remove" value="">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="cep" class="block text-sm font-medium text-gray-700">CEP</label>
                                <input type="text" name="cep" id="cep" value="{{$local->cep}}"
                                    class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm">
                            </div>

                            <div>
                                <label for="address_number"
                                    class="block text-sm font-medium text-gray-700">Número</label>
                                <input type="text" name="address_number" id="address_number"
                                    value="{{$local->address_number}}"
                                    class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm">
                            </div>

                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700">Rua</label>
                                <input type="text" name="address" id="address" value="{{$local->address}}"
                                    class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm">
                            </div>

                            <div>
                                <label for="neighborhood" class="block text-sm font-medium text-gray-700">Bairro</label>
                                <input type="text" name="neighborhood" id="neighborhood"
                                    value="{{$local->neighborhood}}"
                                    class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm">
                            </div>

                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700">Cidade</label>
                                <input type="text" name="city" id="city" value="{{$local->city}}"
                                    class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm">
                            </div>

                            <div>
                                <label for="state" class="block text-sm font-medium text-gray-700">Estado</label>
                                @php
                                $states = [
                                'AC' => 'Acre',
                                'AL' => 'Alagoas',
                                'AP' => 'Amapá',
                                'AM' => 'Amazonas',
                                'BA' => 'Bahia',
                                'CE' => 'Ceará',
                                'DF' => 'Distrito Federal',
                                'ES' => 'Espírito Santo',
                                'GO' => 'Goiás',
                                'MA' => 'Maranhão',
                                'MT' => 'Mato Grosso',
                                'MS' => 'Mato Grosso do Sul',
                                'MG' => 'Minas Gerais',
                                'PA' => 'Pará',
                                'PB' => 'Paraíba',
                                'PR' => 'Paraná',
                                'PE' => 'Pernambuco',
                                'PI' => 'Piauí',
                                'RJ' => 'Rio de Janeiro',
                                'RN' => 'Rio Grande do Norte',
                                'RS' => 'Rio Grande do Sul',
                                'RO' => 'Rondônia',
                                'RR' => 'Roraima',
                                'SC' => 'Santa Catarina',
                                'SP' => 'São Paulo',
                                'SE' => 'Sergipe',
                                'TO' => 'Tocantins'
                                ];
                                @endphp

                                <select name="state" id="state"
                                    class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm">
                                    <option value="">Selecione</option>
                                    @foreach($states as $abbr => $name)
                                    <option value="{{ $abbr }}" @if($local->state == $abbr) selected @endif>{{ $name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Telefone</label>
                                <input type="text" name="phone" id="phone" value="{{$local->phone}}"
                                    class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm">
                            </div>

                            <div class="sm:col-span-2">
                                <label for="contact_email" class="block text-sm font-medium text-gray-700">Email de
                                    contato</label>
                                <input type="text" name="contact_email" id="contact_email"
                                    value="{{$local->contact_email}}"
                                    class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm">
                            </div>

                            <div class="sm:col-span-2">
                                <label for="category" class="block text-sm font-medium text-gray-700">Categoria</label>
                                <select name="category" id="category" value="{{$local->category}}"
                                    class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm">
                                    <option value="restaurante">Restaurante</option>
                                    <option value="bar">Bar</option>
                                    <option value="cafe">Café</option>
                                    <option value="hotel">Hotel</option>
                                    <option value="loja">Loja</option>
                                    <option value="outro">Outro</option>
                                </select>
                            </div>

                            @php
                            $savedFeatures = json_decode($local->features ?? '[]', true);
                            @endphp

                            <div class="sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Características</label>
                                <div class="mt-2 space-y-2">
                                    <div class="flex items-center">
                                        <input type="checkbox" name="features[]" id="feature_wifi" value="wifi"
                                            @if(in_array('wifi', $savedFeatures)) checked @endif
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="feature_wifi" class="ml-2 block text-sm text-gray-700">Wi-Fi</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" name="features[]" id="feature_parking"
                                            value="estacionamento" @if(in_array('estacionamento', $savedFeatures))
                                            checked @endif
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="feature_parking"
                                            class="ml-2 block text-sm text-gray-700">Estacionamento</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" name="features[]" id="feature_accessible"
                                            value="acessivel" @if(in_array('acessivel', $savedFeatures)) checked @endif
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="feature_accessible"
                                            class="ml-2 block text-sm text-gray-700">Acessível</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" name="features[]" id="feature_air_conditioning"
                                            value="ar_condicionado" @if(in_array('ar_condicionado', $savedFeatures))
                                            checked @endif
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="feature_air_conditioning"
                                            class="ml-2 block text-sm text-gray-700">Ar Condicionado</label>
                                    </div>
                                </div>
                            </div>

                            @php
                            $savedWorkingHours = json_decode($local->working_hours ?? '{}', true);
                            $days = ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'];
                            @endphp

                            <div class="sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Horário de Funcionamento</label>
                                <div class="mt-2 space-y-2">
                                    @foreach($days as $day)
                                    @php
                                    $dayLower = strtolower($day);
                                    $isDayChecked = isset($savedWorkingHours[$dayLower]);
                                    $openingTime = $isDayChecked ? $savedWorkingHours[$dayLower]['opening'] : '';
                                    $closingTime = $isDayChecked ? $savedWorkingHours[$dayLower]['closing'] : '';
                                    @endphp
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" name="working_days[]" id="day_{{ $dayLower }}"
                                            value="{{ $dayLower }}" @if($isDayChecked) checked @endif
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded day-checkbox">
                                        <label for="day_{{ $dayLower }}"
                                            class="block text-sm text-gray-700">{{ $day }}</label>
                                        <input type="time" name="opening_time_{{ $dayLower }}"
                                            value="{{ $openingTime }}"
                                            class="border border-gray-300 rounded-md px-2 py-1 text-sm time-input">
                                        <span>às</span>
                                        <input type="time" name="closing_time_{{ $dayLower }}"
                                            value="{{ $closingTime }}"
                                            class="border border-gray-300 rounded-md px-2 py-1 text-sm time-input">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="pt-4">
                            <input type="submit" value="Adicionar local"
                                class="w-full sm:w-auto px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow-sm transition duration-200 cursor-pointer">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    function removeExistingImage(button, imagePath) {
        if (confirm('Tem certeza que deseja remover esta imagem?')) {
            const input = document.getElementById('images_to_remove');
            const removedArray = input.value ? input.value.split(',') : [];
            removedArray.push(imagePath);
            input.value = removedArray.join(',');
            button.closest('div.relative').remove();
        }
    }

    document.getElementById('images').addEventListener('change', function() {
        const preview = document.getElementById('image-preview');
        preview.innerHTML = '';

        for (const file of this.files) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative group';

                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full h-32 object-cover rounded border border-gray-200';

                const deleteBtn = document.createElement('button');
                deleteBtn.type = 'button';
                deleteBtn.className =
                    'absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity';
                deleteBtn.innerHTML = '×';
                deleteBtn.onclick = () => div.remove();

                div.appendChild(img);
                div.appendChild(deleteBtn);
                preview.appendChild(div);
            };
            reader.readAsDataURL(file);
        }
    });
    </script>

</x-app-layout>