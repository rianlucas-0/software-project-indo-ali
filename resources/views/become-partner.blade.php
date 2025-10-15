<x-guest-layout>
    <div class="min-h-screen bg-[#0D1117] py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-white mb-4">Seja um Parceiro</h1>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto">
                    Junte-se à nossa comunidade de administradores e ajude a compartilhar locais incríveis
                </p>
            </div>

            <!-- Benefits -->
            <div class="grid md:grid-cols-2 gap-8 mb-12">
                <!-- Card Benefits -->
                <div class="bg-[#161B22] rounded-xl p-6 border border-gray-700">
                    <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-crown text-yellow-400 mr-3"></i>
                        Vantagens de ser Parceiro
                    </h2>
                    
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <i class="fas fa-plus-circle text-blue-400 mt-1 mr-3"></i>
                            <div>
                                <h3 class="text-white font-semibold">Adicionar Locais</h3>
                                <p class="text-gray-400 text-sm">Cadastre novos locais para compartilhar com a comunidade</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <i class="fas fa-edit text-green-400 mt-1 mr-3"></i>
                            <div>
                                <h3 class="text-white font-semibold">Gerenciar Conteúdo</h3>
                                <p class="text-gray-400 text-sm">Edite e atualize informações dos locais existentes</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <i class="fas fa-chart-line text-purple-400 mt-1 mr-3"></i>
                            <div>
                                <h3 class="text-white font-semibold">Estatísticas</h3>
                                <p class="text-gray-400 text-sm">Acesse dados sobre visualizações e engajamento</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <i class="fas fa-users text-orange-400 mt-1 mr-3"></i>
                            <div>
                                <h3 class="text-white font-semibold">Comunidade</h3>
                                <p class="text-gray-400 text-sm">Faça parte do grupo exclusivo de administradores</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Requirements -->
                <div class="bg-[#161B22] rounded-xl p-6 border border-gray-700">
                    <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-check-circle text-green-400 mr-3"></i>
                        O Que Esperamos
                    </h2>
                    
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt text-red-400 mt-1 mr-3"></i>
                            <div>
                                <h3 class="text-white font-semibold">Conhecimento Local</h3>
                                <p class="text-gray-400 text-sm">Conheça bem os locais que pretende cadastrar</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <i class="fas fa-camera text-yellow-400 mt-1 mr-3"></i>
                            <div>
                                <h3 class="text-white font-semibold">Qualidade nas Fotos</h3>
                                <p class="text-gray-400 text-sm">Forneça imagens de boa qualidade dos locais</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-blue-400 mt-1 mr-3"></i>
                            <div>
                                <h3 class="text-white font-semibold">Informações Precisas</h3>
                                <p class="text-gray-400 text-sm">Descreva os locais com detalhes e precisão</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <i class="fas fa-heart text-pink-400 mt-1 mr-3"></i>
                            <div>
                                <h3 class="text-white font-semibold">Compromisso</h3>
                                <p class="text-gray-400 text-sm">Mantenha os locais atualizados regularmente</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Request Form -->
            @auth
                @if(Auth::user()->user_type === 'user')
                    <div class="bg-[#161B22] rounded-xl p-8 border border-gray-700">
                        <h2 class="text-2xl font-bold text-white mb-6 text-center">
                            Solicite Sua Parceria
                        </h2>

                        @if(session('success'))
                            <div class="bg-green-500/10 border border-green-500/50 text-green-400 px-4 py-3 rounded-lg mb-6">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-4 py-3 rounded-lg mb-6">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('request-partnership') }}" method="POST">
                            @csrf
                            
                            <div class="space-y-6">
                                <!-- Motivation -->
                                <div>
                                    <label for="motivation" class="block text-white font-semibold mb-2">
                                        Por que você quer ser um parceiro? *
                                    </label>
                                    <textarea 
                                        id="motivation" 
                                        name="motivation" 
                                        rows="5" 
                                        class="w-full bg-[#1E2229] border border-gray-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all"
                                        placeholder="Conte-nos sobre sua motivação para se tornar um administrador e como você pode contribuir com nossa comunidade..."
                                        required
                                    >{{ old('motivation') }}</textarea>
                                    @error('motivation')
                                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                    <p class="text-gray-400 text-sm mt-1">Mínimo de 50 caracteres</p>
                                </div>

                                <!-- Experience -->
                                <div>
                                    <label for="experience" class="block text-white font-semibold mb-2">
                                        Experiência ou Habilidades Relevantes
                                    </label>
                                    <textarea 
                                        id="experience" 
                                        name="experience" 
                                        rows="3" 
                                        class="w-full bg-[#1E2229] border border-gray-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all"
                                        placeholder="Possui experiência com turismo, fotografia, ou outras habilidades que possam ser úteis?"
                                    >{{ old('experience') }}</textarea>
                                    @error('experience')
                                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="text-center">
                                    <button 
                                        type="submit"
                                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition-all duration-300 transform hover:scale-105 focus:ring-4 focus:ring-blue-500/20"
                                    >
                                        <i class="fas fa-paper-plane mr-2"></i>
                                        Enviar Solicitação
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @else
                    <!-- Message for users who are already admin -->
                    <div class="bg-[#161B22] rounded-xl p-8 border border-green-700 text-center">
                        <i class="fas fa-check-circle text-green-400 text-5xl mb-4"></i>
                        <h2 class="text-2xl font-bold text-white mb-4">Você já é um Parceiro!</h2>
                        <p class="text-gray-400 mb-6">
                            Como administrador, você já tem acesso a todas as funcionalidades de parceiro.
                        </p>
                        <a 
                            href="{{ route('dashboard') }}" 
                            class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition-all"
                        >
                            <i class="fas fa-tachometer-alt mr-2"></i>
                            Ir para Dashboard
                        </a>
                    </div>
                @endif
            @else
                <!-- Message for non-logged users -->
                <div class="bg-[#161B22] rounded-xl p-8 border border-gray-700 text-center">
                    <i class="fas fa-user-lock text-yellow-400 text-5xl mb-4"></i>
                    <h2 class="text-2xl font-bold text-white mb-4">Faça Login Primeiro</h2>
                    <p class="text-gray-400 mb-6">
                        Você precisa estar logado para solicitar uma parceria.
                    </p>
                    <a 
                        href="{{ route('login') }}" 
                        class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-all mr-4"
                    >
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Fazer Login
                    </a>
                    <a 
                        href="{{ route('register') }}" 
                        class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition-all"
                    >
                        <i class="fas fa-user-plus mr-2"></i>
                        Criar Conta
                    </a>
                </div>
            @endauth

            <!-- FAQ -->
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-white text-center mb-8">Perguntas Frequentes</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-[#161B22] rounded-xl p-6 border border-gray-700">
                        <h3 class="text-white font-semibold mb-2">Quanto tempo leva para aprovar?</h3>
                        <p class="text-gray-400 text-sm">Analisamos as solicitações em até 48 horas úteis.</p>
                    </div>
                    <div class="bg-[#161B22] rounded-xl p-6 border border-gray-700">
                        <h3 class="text-white font-semibold mb-2">Há algum custo?</h3>
                        <p class="text-gray-400 text-sm">Não, ser parceiro é completamente gratuito.</p>
                    </div>
                    <div class="bg-[#161B22] rounded-xl p-6 border border-gray-700">
                        <h3 class="text-white font-semibold mb-2">Preciso ter muitos locais?</h3>
                        <p class="text-gray-400 text-sm">Qualidade é mais importante que quantidade.</p>
                    </div>
                    <div class="bg-[#161B22] rounded-xl p-6 border border-gray-700">
                        <h3 class="text-white font-semibold mb-2">Posso perder o status?</h3>
                        <p class="text-gray-400 text-sm">Sim, em caso de conteúdo inadequado ou inatividade.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>