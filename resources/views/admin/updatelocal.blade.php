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
            <form action="{{ route('admin.localupdate', $local->id) }}" method="post" enctype="multipart/form-data"  class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                    <input type="text" name="title" id="title" value="{{$local->title}}" class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                    <textarea name="description" id="description" rows="4" class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        {{$local->description}}
                    </textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Imagens (Máx. 7)</label>
                    <img src="{{asset('img/'.$local->images)}}" alt="">
                    <div id="image-preview" class="mt-2 grid grid-cols-3 gap-2"></div>
                    <input type="file" name="images[]" id="images" multiple class="mt-1 block w-full text-sm text-gray-700" accept="image/*">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="cep" class="block text-sm font-medium text-gray-700">CEP</label>
                        <input type="text" name="cep" id="cep" value="{{$local->cep}}" class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm">
                    </div>

                    <div>
                        <label for="address_number" class="block text-sm font-medium text-gray-700">Número</label>
                        <input type="text" name="address_number" id="address_number" value="{{$local->address_number}}" class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm">
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Rua</label>
                        <input type="text" name="address" id="address" value="{{$local->address}}" class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm">
                    </div>

                    <div>
                        <label for="neighborhood" class="block text-sm font-medium text-gray-700">Bairro</label>
                        <input type="text" name="neighborhood" id="neighborhood" value="{{$local->neighborhood}}" class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm">
                    </div>

                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700">Cidade</label>
                        <input type="text" name="city" id="city" value="{{$local->city}}" class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm">
                    </div>

                    <div>
                        <label for="state" class="block text-sm font-medium text-gray-700">Estado</label>
                        <select name="state" id="state" value="{{$local->state}}" class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm">
                            <option value="">Selecione</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Telefone</label>
                        <input type="text" name="phone" id="phone" value="{{$local->phone}}" class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="contact_email" class="block text-sm font-medium text-gray-700">Email de contato</label>
                        <input type="text" name="contact_email" id="contact_email" value="{{$local->contact_email}}" class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="category" class="block text-sm font-medium text-gray-700">Categoria</label>
                        <select name="category" id="category" value="{{$local->category}}" class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm">
                            <option value="restaurante">Restaurante</option>
                            <option value="bar">Bar</option>
                            <option value="cafe">Café</option>
                            <option value="hotel">Hotel</option>
                            <option value="loja">Loja</option>
                            <option value="outro">Outro</option>
                        </select>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Características</label>
                        <div class="mt-2 space-y-2">
                            
                            <div class="flex items-center">
                                <input type="checkbox" name="features[]" id="feature_wifi" value="wifi"class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="feature_wifi" class="ml-2 block text-sm text-gray-700">Wi-Fi</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="features[]" id="feature_parking" value="estacionamento" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="feature_parking" class="ml-2 block text-sm text-gray-700">Estacionamento</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="features[]" id="feature_accessible" value="acessivel" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="feature_accessible" class="ml-2 block text-sm text-gray-700">Acessível</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="features[]" id="feature_air_conditioning" value="ar_condicionado" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="feature_air_conditioning" class="ml-2 block text-sm text-gray-700">Ar Condicionado</label>
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Horário de Funcionamento</label>
                        <div class="mt-2 space-y-2">
                            @php $days = ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo']; @endphp
                            @foreach($days as $day)
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" name="working_days[]" id="day_{{ strtolower($day) }}" value="{{ strtolower($day) }}" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="day_{{ strtolower($day) }}" class="block text-sm text-gray-700">{{ $day }}</label>
                                <input type="time" name="opening_time_{{ strtolower($day) }}" class="border border-gray-300 rounded-md px-2 py-1 text-sm">
                                <span>às</span>
                                <input type="time" name="closing_time_{{ strtolower($day) }}" class="border border-gray-300 rounded-md px-2 py-1 text-sm">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <input type="submit" value="Adicionar local" class="w-full sm:w-auto px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow-sm transition duration-200 cursor-pointer">
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>