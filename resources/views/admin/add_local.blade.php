<x-guest-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white dark:bg-[#161B22] shadow-lg rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center mb-6">
                    <i class="fas fa-plus-circle text-blue-500 dark:text-blue-400 mr-3 text-xl"></i>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Adicionar novo local</h2>
                </div>

                @if(session('status'))
                <div class="bg-green-100 dark:bg-green-600/20 border border-green-400 dark:border-green-500/30 text-green-700 dark:text-green-400 px-4 py-3 rounded-lg mb-6 flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('status') }}
                </div>
                @endif

                <form action="{{route('admin.createlocal')}}" method="post" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Informações Básicas -->
                    <div class="bg-gray-50 dark:bg-[#1E2229] p-5 rounded-lg border border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 flex items-center">
                            <i class="fas fa-info-circle text-blue-500 dark:text-blue-400 mr-2"></i>
                            Informações Básicas
                        </h3>

                        <div class="space-y-4">
                            <div>
                                <x-input-label for="title" :value="__('Título')" class="text-gray-700 dark:text-gray-300" />
                                <x-text-input id="title" name="title" type="text" placeholder="Ex: Restaurante da Maria" 
                                    class="w-full bg-white dark:bg-[#0D1117] border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white" />
                            </div>

                            <div>
                                <x-input-label for="description" :value="__('Descrição')" class="text-gray-700 dark:text-gray-300" />
                                <textarea name="description" id="description" rows="4" placeholder="Fale um pouco sobre o local..."
                                    class="w-full bg-white dark:bg-[#0D1117] border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white rounded-md focus:border-blue-500 focus:ring-blue-500 dark:focus:border-blue-400 dark:focus:ring-blue-400"></textarea>
                            </div>

                            <div>
                                <x-input-label for="category" :value="__('Categoria')" class="text-gray-700 dark:text-gray-300" />
                                <select name="category" id="category"
                                    class="w-full bg-white dark:bg-[#0D1117] border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white rounded-md focus:border-blue-500 focus:ring-blue-500 dark:focus:border-blue-400 dark:focus:ring-blue-400">
                                    <option value="academia">Academia</option>
                                    <option value="bar">Bar</option>
                                    <option value="biblioteca">Biblioteca</option>
                                    <option value="boliche">Boliche</option>
                                    <option value="boate">Boate</option>
                                    <option value="cachoeira">Cachoeira</option>
                                    <option value="cafe">Café</option>
                                    <option value="casa_shows">Casa de Shows</option>
                                    <option value="centro_cultural">Centro Cultural</option>
                                    <option value="centro_historico">Centro Histórico</option>
                                    <option value="cinema">Cinema</option>
                                    <option value="clube_social">Clube Social</option>
                                    <option value="comida_asiatica">Comida Asiática</option>
                                    <option value="comida_tipica">Comida Típica</option>
                                    <option value="comida_vegetariana">Comida Vegetariana</option>
                                    <option value="escape_room">Escape Room</option>
                                    <option value="escola">Escola</option>
                                    <option value="estadio">Estádio</option>
                                    <option value="feira_livre">Feira Livre</option>
                                    <option value="galeria_arte">Galeria de Arte</option>
                                    <option value="hamburgueria">Hamburgueria</option>
                                    <option value="hotel">Hotel</option>
                                    <option value="igreja_historica">Igreja Histórica</option>
                                    <option value="jardim_botanico">Jardim Botânico</option>
                                    <option value="karaoke">Karaokê</option>
                                    <option value="kart">Kart</option>
                                    <option value="loja">Loja</option>
                                    <option value="loja_artesanato">Loja de Artesanato</option>
                                    <option value="massagem">Massagem</option>
                                    <option value="mirante">Mirante</option>
                                    <option value="monumento">Monumento</option>
                                    <option value="museu">Museu</option>
                                    <option value="padaria">Padaria</option>
                                    <option value="parque">Parque</option>
                                    <option value="parque_ambiental">Parque Ambiental</option>
                                    <option value="parque_aquatico">Parque Aquático</option>
                                    <option value="parque_diversoes">Parque de Diversões</option>
                                    <option value="pet_shop">Pet Shop</option>
                                    <option value="pizzaria">Pizzaria</option>
                                    <option value="ponto_turistico">Ponto Turístico</option>
                                    <option value="pousada">Pousada</option>
                                    <option value="praca_esportes">Praça de Esportes</option>
                                    <option value="praia">Praia</option>
                                    <option value="quadra_esportes">Quadra de Esportes</option>
                                    <option value="resort">Resort</option>
                                    <option value="restaurante">Restaurante</option>
                                    <option value="rua_famosa">Rua Famosa</option>
                                    <option value="shopping">Shopping</option>
                                    <option value="sitio_arqueologico">Sítio Arqueológico</option>
                                    <option value="sorveteria">Sorveteria</option>
                                    <option value="spa">Spa</option>
                                    <option value="teatro">Teatro</option>
                                    <option value="trilha">Trilha</option>
                                    <option value="universidade">Universidade</option>
                                    <option value="zoo_aquario">Zoológico/Aquário</option>
                                    <option value="outro">Outro</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Imagens -->
                    <div class="bg-gray-50 dark:bg-[#1E2229] p-5 rounded-lg border border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 flex items-center">
                            <i class="fas fa-images text-blue-500 dark:text-blue-400 mr-2"></i>
                            Imagens (Máx. 7)
                        </h3>

                        <div id="image-preview" class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-4"></div>

                        <div class="flex items-center justify-center w-full">
                            <label for="images"
                                class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer bg-white dark:bg-[#0D1117] hover:border-blue-500 dark:hover:border-blue-400 transition">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fas fa-cloud-upload-alt text-gray-400 dark:text-gray-500 text-2xl mb-2"></i>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Clique para enviar imagens</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">PNG, JPG (Máx. 7 imagens)</p>
                                </div>
                                <input id="images" name="images[]" type="file" multiple class="hidden" accept="image/*">
                            </label>
                        </div>
                    </div>

                    <!-- Localização -->
                    <div class="bg-gray-50 dark:bg-[#1E2229] p-5 rounded-lg border border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 flex items-center">
                            <i class="fas fa-map-marked-alt text-blue-500 dark:text-blue-400 mr-2"></i>
                            Localização
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="cep" :value="__('CEP')" class="text-gray-700 dark:text-gray-300" />
                                <x-text-input id="cep" name="cep" type="text" placeholder="Ex: 30140-071"
                                    class="w-full bg-white dark:bg-[#0D1117] border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white" />
                            </div>

                            <div>
                                <x-input-label for="address_number" :value="__('Número')" class="text-gray-700 dark:text-gray-300" />
                                <x-text-input id="address_number" name="address_number" type="text" placeholder="Número do local"
                                    class="w-full bg-white dark:bg-[#0D1117] border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white" />
                            </div>

                            <div class="sm:col-span-2">
                                <x-input-label for="address" :value="__('Rua')" class="text-gray-700 dark:text-gray-300" />
                                <x-text-input id="address" name="address" type="text"
                                    class="w-full bg-white dark:bg-[#0D1117] border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white" />
                            </div>

                            <div>
                                <x-input-label for="neighborhood" :value="__('Bairro')" class="text-gray-700 dark:text-gray-300" />
                                <x-text-input id="neighborhood" name="neighborhood" type="text"
                                    class="w-full bg-white dark:bg-[#0D1117] border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white" />
                            </div>

                            <div>
                                <x-input-label for="city" :value="__('Cidade')" class="text-gray-700 dark:text-gray-300" />
                                <x-text-input id="city" name="city" type="text"
                                    class="w-full bg-white dark:bg-[#0D1117] border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white" />
                            </div>

                            <div>
                                <x-input-label for="state" :value="__('Estado')" class="text-gray-700 dark:text-gray-300" />
                                <select name="state" id="state"
                                    class="w-full bg-white dark:bg-[#0D1117] border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white rounded-md focus:border-blue-500 focus:ring-blue-500 dark:focus:border-blue-400 dark:focus:ring-blue-400">
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
                        </div>
                    </div>

                    <!-- Contato -->
                    <div class="bg-gray-50 dark:bg-[#1E2229] p-5 rounded-lg border border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 flex items-center">
                            <i class="fas fa-phone-alt text-blue-500 dark:text-blue-400 mr-2"></i>
                            Contato
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="phone" :value="__('Telefone')" class="text-gray-700 dark:text-gray-300" />
                                <x-text-input id="phone" name="phone" type="text"
                                    class="w-full bg-white dark:bg-[#0D1117] border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white" />
                            </div>

                            <div class="sm:col-span-2">
                                <x-input-label for="contact_email" :value="__('Email de contato')" class="text-gray-700 dark:text-gray-300" />
                                <x-text-input id="contact_email" name="contact_email" type="text"
                                    class="w-full bg-white dark:bg-[#0D1117] border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white" />
                            </div>
                        </div>
                    </div>

                    <!-- Características -->
                    <div class="bg-gray-50 dark:bg-[#1E2229] p-5 rounded-lg border border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 flex items-center">
                            <i class="fas fa-star text-blue-500 dark:text-blue-400 mr-2"></i>
                            Características
                        </h3>

                        <div x-data="{ featuresOpen: false }" class="relative">
                            <button @click="featuresOpen = !featuresOpen" type="button"
                                class="w-full bg-white dark:bg-[#0D1117] border border-gray-300 dark:border-gray-700 rounded-md px-4 py-2 text-left text-gray-900 dark:text-white focus:outline-none focus:ring-1 focus:ring-blue-500 dark:focus:ring-blue-400 flex justify-between items-center">
                                <span class="text-sm">Selecione as características</span>
                                <i :class="{'fa-chevron-down': !featuresOpen, 'fa-chevron-up': featuresOpen}"
                                    class="fas text-gray-500 dark:text-gray-400 ml-2"></i>
                            </button>

                            <div x-show="featuresOpen" @click.away="featuresOpen = false"
                                class="absolute z-10 mt-1 w-full bg-white dark:bg-[#161B22] border border-gray-300 dark:border-gray-700 rounded-md shadow-lg py-1 max-h-60 overflow-auto">
                                <div class="space-y-2 p-2">
                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_accessible" name="features[]" value="acessivel"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_accessible" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Acessível</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_credit_card" name="features[]" value="cartao_credito"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_credit_card" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Aceita Cartão</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_reservation" name="features[]" value="reserva"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_reservation" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Aceita Reservas</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_air_conditioning" name="features[]" value="ar_condicionado"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_air_conditioning" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Ar Condicionado</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_heating" name="features[]" value="aquecimento"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_heating" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Aquecimento</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_smoking_area" name="features[]" value="fumodromo"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_smoking_area" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Área para Fumantes</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_playground" name="features[]" value="playground"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_playground" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Área de Playground</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_family" name="features[]" value="familia"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_family" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Ambiente Familiar</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_romantic" name="features[]" value="ambiente_romantico"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_romantic" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Ambiente Romântico</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_restroom" name="features[]" value="banheiro"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_restroom" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Banheiro</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_bar" name="features[]" value="bar"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_bar" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Bar</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_boat_dock" name="features[]" value="cais_embarcacoes"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_boat_dock" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Cais para Embarcações</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_charging" name="features[]" value="tomadas"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_charging" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Tomadas para Carregar</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_delivery" name="features[]" value="delivery"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_delivery" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Delivery</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_drinks" name="features[]" value="bebidas"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_drinks" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Bebidas Alcoólicas</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_breakfast" name="features[]" value="cafe_manha"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_breakfast" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Café da Manhã</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_coffee" name="features[]" value="cafe_especial"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_coffee" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Café Especial</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_camping" name="features[]" value="camping"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_camping" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Camping</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_kids_menu" name="features[]" value="cardapio_infantil"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_kids_menu" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Cardápio Infantil</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_pool" name="features[]" value="piscina"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_pool" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Piscina</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_changing_table" name="features[]" value="fraldario"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_changing_table" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Fraldário</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_games" name="features[]" value="jogos"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_games" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Jogos/Entretenimento</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_garden" name="features[]" value="jardim"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_garden" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Jardim</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_live_music" name="features[]" value="musica_ao_vivo"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_live_music" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Música ao Vivo</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_gluten_free" name="features[]" value="sem_gluten"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_gluten_free" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Opções Sem Glúten</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_vegan" name="features[]" value="opcoes_veganas"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_vegan" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Opções Veganas</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_vegetarian" name="features[]" value="opcoes_vegetarianas"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_vegetarian" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Opções Vegetarianas</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_pet_friendly" name="features[]" value="pet_friendly"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_pet_friendly" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Pet Friendly</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_parking" name="features[]" value="estacionamento"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_parking" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Estacionamento</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_valet" name="features[]" value="estacionamento_valet"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_valet" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Estacionamento Valet</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_rooftop" name="features[]" value="cobertura"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_rooftop" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Rooftop</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_self_service" name="features[]" value="self_service"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_self_service" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Self Service</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_sports" name="features[]" value="esportes"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_sports" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Área de Esportes</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_terrace" name="features[]" value="terraco"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_terrace" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Terraço</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_tv" name="features[]" value="tv"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_tv" class="ml-2 text-sm text-gray-700 dark:text-gray-300">TV</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_view" name="features[]" value="vista_panoramica"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_view" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Vista Panorâmica</label>
                                    </div>

                                    <div class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-[#1E2229] rounded">
                                        <input type="checkbox" id="feature_wifi" name="features[]" value="wifi"
                                            class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                        <label for="feature_wifi" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Wi-Fi</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 flex flex-wrap gap-2" id="selected-features">
                            <!-- O Javascript vai preencher dinamicamente aqui -->
                        </div>
                    </div>

                    <!-- Horário de Funcionamento -->
                    <div class="bg-gray-50 dark:bg-[#1E2229] p-5 rounded-lg border border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 flex items-center">
                            <i class="fas fa-clock text-blue-500 dark:text-blue-400 mr-2"></i>
                            Horário de Funcionamento
                        </h3>

                        <div class="space-y-4">
                            @php $days = ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo']; @endphp
                            @foreach($days as $day)
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <input type="checkbox" id="day_{{ strtolower($day) }}" name="working_days[]" value="{{ strtolower($day) }}"
                                        class="rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 h-4 w-4">
                                    <label for="day_{{ strtolower($day) }}" class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ $day }}</label>
                                </div>

                                <div class="flex items-center space-x-2 pl-6">
                                    <div class="flex-1">
                                        <x-input-label for="opening_time_{{ strtolower($day) }}" :value="__('Abertura')" class="sr-only" />
                                        <x-text-input type="time" name="opening_time_{{ strtolower($day) }}"
                                            class="w-full bg-white dark:bg-[#0D1117] border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white text-sm p-2" />
                                    </div>
                                    <span class="text-gray-500 dark:text-gray-400 text-xs">às</span>
                                    <div class="flex-1">
                                        <x-input-label for="closing_time_{{ strtolower($day) }}" :value="__('Fechamento')" class="sr-only" />
                                        <x-text-input type="time" name="closing_time_{{ strtolower($day) }}"
                                            class="w-full bg-white dark:bg-[#0D1117] border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white text-sm p-2" />
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-4">
                        <x-primary-button class="w-full justify-center bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white">
                            <i class="fas fa-plus-circle mr-2"></i>
                            Adicionar local
                        </x-primary-button>
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

        function clearPreview() {
            preview.innerHTML = '';
        }

        function createImagePreview(file, index) {
            const div = document.createElement('div');
            div.className = 'relative group overflow-hidden rounded-lg border border-gray-300 dark:border-gray-700';

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
            const existingCount = preview.children.length;
            return (existingCount + newFilesCount) <= maxImages;
        }

        imagesInput.addEventListener('change', () => {
            const files = Array.from(imagesInput.files);

            if (!canAddImages(files.length)) {
                alert(`Você pode adicionar no máximo ${maxImages} imagens.`);
                imagesInput.value = '';
                return;
            }

            files.forEach((file, index) => createImagePreview(file, index));
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const updateSelectedFeatures = () => {
            const container = document.getElementById('selected-features');
            container.innerHTML = '';

            document.querySelectorAll('input[name="features[]"]:checked').forEach(checkbox => {
                const label = document.querySelector(`label[for="${checkbox.id}"]`).textContent;
                const badge = document.createElement('div');
                badge.className =
                    'bg-blue-100 dark:bg-blue-600/20 text-blue-800 dark:text-blue-400 text-xs px-2 py-1 rounded-full flex items-center';
                badge.innerHTML = `
                    <span>${label}</span>
                    <button type="button" data-id="${checkbox.id}" class="ml-1 text-blue-600 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-100">
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