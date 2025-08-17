<x-guest-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-[#161B22] shadow-lg rounded-xl p-6 border border-gray-700">
                <div class="flex items-center mb-6">
                    <i class="fas fa-edit text-blue-400 mr-3 text-xl"></i>
                    <h2 class="text-xl font-semibold text-white">Editar local</h2>
                </div>

                @if(session('status'))
                <div
                    class="bg-green-600/20 border border-green-500/30 text-green-400 px-4 py-3 rounded-lg mb-6 flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('status') }}
                </div>
                @endif

                <form action="{{ route('admin.updatelocal', $local->id) }}" method="post" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="bg-[#1E2229] p-5 rounded-lg border border-gray-700">
                        <h3 class="text-lg font-medium text-white mb-4 flex items-center">
                            <i class="fas fa-info-circle text-blue-400 mr-2"></i>
                            Informações Básicas
                        </h3>

                        <div class="space-y-4">
                            <div>
                                <x-input-label for="title" :value="__('Título')" class="text-gray-300" />
                                <x-text-input id="title" name="title" type="text"
                                    value="{{ old('title', $local->title) }}"
                                    class="w-full bg-[#0D1117] border-gray-700" />
                            </div>

                            <div>
                                <x-input-label for="description" :value="__('Descrição')" class="text-gray-300" />
                                <textarea name="description" id="description" rows="4"
                                    class="w-full bg-[#0D1117] border-gray-700 text-white rounded-md focus:border-blue-500 focus:ring-blue-500">{{ old('description', $local->description) }}</textarea>
                            </div>

                            <div>
                                <x-input-label for="category" :value="__('Categoria')" class="text-gray-300" />
                                <select name="category" id="category"
                                    class="w-full bg-[#0D1117] border-gray-700 text-white rounded-md focus:border-blue-500 focus:ring-blue-500">
                                    <option value="restaurante"
                                        {{ $local->category == 'restaurante' ? 'selected' : '' }}>Restaurante</option>
                                    <option value="bar" {{ $local->category == 'bar' ? 'selected' : '' }}>Bar</option>
                                    <option value="cafe" {{ $local->category == 'cafe' ? 'selected' : '' }}>Café
                                    </option>
                                    <option value="hotel" {{ $local->category == 'hotel' ? 'selected' : '' }}>Hotel
                                    </option>
                                    <option value="loja" {{ $local->category == 'loja' ? 'selected' : '' }}>Loja
                                    </option>
                                    <option value="outro" {{ $local->category == 'outro' ? 'selected' : '' }}>Outro
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="bg-[#1E2229] p-5 rounded-lg border border-gray-700">
                        <h3 class="text-lg font-medium text-white mb-4 flex items-center">
                            <i class="fas fa-images text-blue-400 mr-2"></i>
                            Imagens (Máx. 7)
                        </h3>

                        @php
                        $images = json_decode($local->images ?? '[]', true);
                        @endphp

                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-4" id="existing-images">
                            @foreach($images as $image)
                            <div class="relative group overflow-hidden rounded-lg border border-gray-700">
                                <img src="{{ asset('img/' . $image) }}" class="w-full h-32 object-cover">
                                <button type="button" onclick="removeExistingImage(this, '{{ $image }}')"
                                    class="absolute top-2 right-2 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow-md">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                                <input type="hidden" name="existing_images[]" value="{{ $image }}">
                            </div>
                            @endforeach
                        </div>

                        <div id="image-preview" class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-4"></div>

                        <div class="flex items-center justify-center w-full">
                            <label for="images"
                                class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-600 rounded-lg cursor-pointer bg-[#0D1117] hover:border-blue-500 transition">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fas fa-cloud-upload-alt text-gray-400 text-2xl mb-2"></i>
                                    <p class="text-sm text-gray-400">Clique para adicionar mais imagens</p>
                                    <p class="text-xs text-gray-500 mt-1">PNG, JPG (Máx. 7 imagens no total)</p>
                                </div>
                                <input id="images" name="images[]" type="file" multiple class="hidden" accept="image/*">
                            </label>
                        </div>
                        <input type="hidden" name="images_to_remove" id="images_to_remove" value="">
                    </div>

                    <div class="bg-[#1E2229] p-5 rounded-lg border border-gray-700">
                        <h3 class="text-lg font-medium text-white mb-4 flex items-center">
                            <i class="fas fa-map-marked-alt text-blue-400 mr-2"></i>
                            Localização
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="cep" :value="__('CEP')" class="text-gray-300" />
                                <x-text-input id="cep" name="cep" type="text" value="{{ old('cep', $local->cep) }}"
                                    class="w-full bg-[#0D1117] border-gray-700" />
                            </div>

                            <div>
                                <x-input-label for="address_number" :value="__('Número')" class="text-gray-300" />
                                <x-text-input id="address_number" name="address_number" type="text"
                                    value="{{ old('address_number', $local->address_number) }}"
                                    class="w-full bg-[#0D1117] border-gray-700" />
                            </div>

                            <div class="sm:col-span-2">
                                <x-input-label for="address" :value="__('Rua')" class="text-gray-300" />
                                <x-text-input id="address" name="address" type="text"
                                    value="{{ old('address', $local->address) }}"
                                    class="w-full bg-[#0D1117] border-gray-700" />
                            </div>

                            <div>
                                <x-input-label for="neighborhood" :value="__('Bairro')" class="text-gray-300" />
                                <x-text-input id="neighborhood" name="neighborhood" type="text"
                                    value="{{ old('neighborhood', $local->neighborhood) }}"
                                    class="w-full bg-[#0D1117] border-gray-700" />
                            </div>

                            <div>
                                <x-input-label for="city" :value="__('Cidade')" class="text-gray-300" />
                                <x-text-input id="city" name="city" type="text" value="{{ old('city', $local->city) }}"
                                    class="w-full bg-[#0D1117] border-gray-700" />
                            </div>

                            <div>
                                <x-input-label for="state" :value="__('Estado')" class="text-gray-300" />
                                <select name="state" id="state"
                                    class="w-full bg-[#0D1117] border-gray-700 text-white rounded-md focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Selecione</option>
                                    <option value="AC" {{ $local->state == 'AC' ? 'selected' : '' }}>Acre</option>
                                    <option value="AL" {{ $local->state == 'AL' ? 'selected' : '' }}>Alagoas</option>
                                    <!-- Colocar todos os Estados depois -->
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="bg-[#1E2229] p-5 rounded-lg border border-gray-700">
                        <h3 class="text-lg font-medium text-white mb-4 flex items-center">
                            <i class="fas fa-phone-alt text-blue-400 mr-2"></i>
                            Contato
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="phone" :value="__('Telefone')" class="text-gray-300" />
                                <x-text-input id="phone" name="phone" type="text"
                                    value="{{ old('phone', $local->phone) }}"
                                    class="w-full bg-[#0D1117] border-gray-700" />
                            </div>

                            <div class="sm:col-span-2">
                                <x-input-label for="contact_email" :value="__('Email de contato')"
                                    class="text-gray-300" />
                                <x-text-input id="contact_email" name="contact_email" type="text"
                                    value="{{ old('contact_email', $local->contact_email) }}"
                                    class="w-full bg-[#0D1117] border-gray-700" />
                            </div>
                        </div>
                    </div>

                    <div class="bg-[#1E2229] p-5 rounded-lg border border-gray-700">
                        <h3 class="text-lg font-medium text-white mb-4 flex items-center">
                            <i class="fas fa-star text-blue-400 mr-2"></i>
                            Características
                        </h3>

                        @php
                        $features = [];
                        if (!empty($local->features)) {
                        if (is_array($local->features)) {
                        $features = $local->features;
                        } else {
                        $decoded = json_decode($local->features, true);
                        $features = is_array($decoded) ? $decoded : [];
                        }
                        }
                        @endphp

                        <div x-data="{ featuresOpen: false }" class="relative">
                            <button @click="featuresOpen = !featuresOpen" type="button"
                                class="w-full bg-[#0D1117] border border-gray-700 rounded-md px-4 py-2 text-left text-white focus:outline-none focus:ring-1 focus:ring-blue-500 flex justify-between items-center">
                                <span class="text-sm">Selecione as características</span>
                                <i :class="{'fa-chevron-down': !featuresOpen, 'fa-chevron-up': featuresOpen}"
                                    class="fas text-gray-400 ml-2"></i>
                            </button>

                            <div x-show="featuresOpen" @click.away="featuresOpen = false"
                                class="absolute z-10 mt-1 w-full bg-[#161B22] border border-gray-700 rounded-md shadow-lg py-1 max-h-60 overflow-auto">
                                <div class="space-y-2 p-2">
                                    @foreach([
                                    'wifi' => 'Wi-Fi',
                                    'estacionamento' => 'Estacionamento',
                                    'acessivel' => 'Acessível',
                                    'ar_condicionado' => 'Ar Condicionado'
                                    ] as $value => $label)
                                    <div class="flex items-center p-2 hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_{{ $value }}" name="features[]"
                                            value="{{ $value }}" {{ in_array($value, $features) ? 'checked' : '' }}
                                            class="rounded border-gray-600 text-blue-500 focus:ring-blue-500 h-4 w-4">
                                        <label for="feature_{{ $value }}"
                                            class="ml-2 text-sm text-gray-300">{{ $label }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 flex flex-wrap gap-2" id="selected-features">
                            @foreach($features as $feature)
                            @php
                            $featureLabels = [
                            'wifi' => 'Wi-Fi',
                            'estacionamento' => 'Estacionamento',
                            'acessivel' => 'Acessível',
                            'ar_condicionado' => 'Ar Condicionado'
                            ];
                            $label = $featureLabels[$feature] ?? $feature;
                            @endphp
                            <div class="bg-blue-600/20 text-blue-400 text-xs px-2 py-1 rounded-full flex items-center">
                                <span>{{ $label }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-[#1E2229] p-5 rounded-lg border border-gray-700">
                        <h3 class="text-lg font-medium text-white mb-4 flex items-center">
                            <i class="fas fa-clock text-blue-400 mr-2"></i>
                            Horário de Funcionamento
                        </h3>

                        @php
                        $workingHours = json_decode($local->working_hours ?? '{}', true);
                        @endphp

                        <div class="space-y-4">
                            @php $days = ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo']; @endphp
                            @foreach($days as $day)
                            @php
                            $dayLower = strtolower($day);
                            $isActive = isset($workingHours[$dayLower]);
                            $openingTime = $isActive ? $workingHours[$dayLower]['opening'] : '';
                            $closingTime = $isActive ? $workingHours[$dayLower]['closing'] : '';
                            @endphp
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <input type="checkbox" id="day_{{ $dayLower }}" name="working_days[]"
                                        value="{{ $dayLower }}" {{ $isActive ? 'checked' : '' }}
                                        class="rounded border-gray-600 text-blue-500 focus:ring-blue-500 h-4 w-4">
                                    <label for="day_{{ $dayLower }}"
                                        class="ml-2 text-sm text-gray-300">{{ $day }}</label>
                                </div>

                                <div class="flex items-center space-x-2 pl-6">
                                    <div class="flex-1">
                                        <x-input-label for="opening_time_{{ $dayLower }}" :value="__('Abertura')"
                                            class="sr-only" />
                                        <x-text-input type="time" name="opening_time_{{ $dayLower }}"
                                            value="{{ $openingTime }}"
                                            class="w-full bg-[#0D1117] border-gray-700 text-sm p-2" />
                                    </div>
                                    <span class="text-gray-400 text-xs">às</span>
                                    <div class="flex-1">
                                        <x-input-label for="closing_time_{{ $dayLower }}" :value="__('Fechamento')"
                                            class="sr-only" />
                                        <x-text-input type="time" name="closing_time_{{ $dayLower }}"
                                            value="{{ $closingTime }}"
                                            class="w-full bg-[#0D1117] border-gray-700 text-sm p-2" />
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <x-primary-button class="w-full justify-center bg-blue-600 hover:bg-blue-700">
                            <i class="fas fa-save mr-2"></i>
                            <span class="hidden sm:inline">Salvar</span>
                            <span class="sm:hidden">Salvar</span>
                        </x-primary-button>

                        <a href="{{ route('admin.all_local') }}" class="w-full">
                            <x-primary-button class="w-full justify-center bg-gray-600 hover:bg-gray-700">
                                <i class="fas fa-times mr-2"></i>
                                <span class="hidden sm:inline">Cancelar</span>
                                <span class="sm:hidden">Cancelar</span>
                            </x-primary-button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const imagesInput = document.getElementById('images');
        const preview = document.getElementById('image-preview');
        const maxImages = 7;
        const existingImages = document.querySelectorAll('#existing-images div').length;

        function createImagePreview(file, index) {
            const div = document.createElement('div');
            div.className = 'relative group overflow-hidden rounded-lg border border-gray-700';

            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.className = 'w-full h-32 object-cover';

            const deleteBtn = document.createElement('button');
            deleteBtn.type = 'button';
            deleteBtn.className =
                'absolute top-2 right-2 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow-md';
            deleteBtn.innerHTML = '<i class="fas fa-times text-xs"></i>';

            deleteBtn.addEventListener('click', () => {
                div.remove();
                const dt = new DataTransfer();
                Array.from(imagesInput.files).forEach((f, i) => {
                    if (i !== index) dt.items.add(f);
                });
                imagesInput.files = dt.files;
            });

            div.appendChild(img);
            div.appendChild(deleteBtn);
            preview.appendChild(div);
        }

        function canAddImages(newFilesCount) {
            const existingCount = existingImages + preview.children.length;
            return (existingCount + newFilesCount) <= maxImages;
        }

        imagesInput.addEventListener('change', () => {
            const files = Array.from(imagesInput.files);

            if (!canAddImages(files.length)) {
                alert(
                    `Você pode ter no máximo ${maxImages} imagens no total. Remova algumas imagens existentes primeiro.`
                );
                imagesInput.value = '';
                return;
            }

            files.forEach((file, index) => createImagePreview(file, index));
        });

        window.removeExistingImage = function(button, imagePath) {
            if (confirm('Tem certeza que deseja remover esta imagem?')) {
                const input = document.getElementById('images_to_remove');
                const removedArray = input.value ? input.value.split(',') : [];
                removedArray.push(imagePath);
                input.value = removedArray.join(',');
                button.closest('div').remove();
            }
        };

        const updateSelectedFeatures = () => {
            const container = document.getElementById('selected-features');
            container.innerHTML = '';

            document.querySelectorAll('input[name="features[]"]:checked').forEach(checkbox => {
                const label = document.querySelector(`label[for="${checkbox.id}"]`).textContent;
                const badge = document.createElement('div');
                badge.className =
                    'bg-blue-600/20 text-blue-400 text-xs px-2 py-1 rounded-full flex items-center';
                badge.innerHTML = `
                    <span>${label}</span>
                    <button type="button" data-id="${checkbox.id}" class="ml-1 text-blue-300 hover:text-blue-100">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                `;
                container.appendChild(badge);
            });
        };

        document.querySelectorAll('input[name="features[]"]').forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedFeatures);
        });

        document.addEventListener('click', function(e) {
            if (e.target.closest('button[data-id]')) {
                const checkboxId = e.target.closest('button').getAttribute('data-id');
                const checkbox = document.getElementById(checkboxId);
                if (checkbox) {
                    checkbox.checked = false;
                    updateSelectedFeatures();
                }
            }
        });

        updateSelectedFeatures();
    });
    </script>
</x-guest-layout>