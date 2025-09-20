<footer class="bg-gray-950 text-white pt-12 pb-20 md:pt-16 md:pb-8">
    <div class="container mx-auto px-5 max-w-7xl">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 md:gap-10 mb-8 md:mb-10">
            <div class="md:col-span-2">
                <div class="flex items-center mb-4 md:mb-5">
                    <i class="fas fa-map-marker-alt text-indigo-500 text-xl md:text-2xl mr-3"></i>
                    <h3
                        class="text-xl md:text-2xl font-bold bg-gradient-to-r from-indigo-400 to-purple-500 bg-clip-text text-transparent">
                        Indo Ali</h3>
                </div>
                <p class="text-gray-400 mb-4 md:mb-6 leading-relaxed text-sm md:text-base">
                    O Indo Ali é sua plataforma digital para descobrir e explorar os melhores lugares da sua cidade.
                    Encontre restaurantes, bares e eventos com avaliações reais, fotos autênticas e recomendações
                    personalizadas.
                </p>
                <div class="flex gap-3 md:gap-4">
                    <a href="#"
                        class="w-8 h-8 md:w-10 md:h-10 bg-gray-800 rounded-full flex items-center justify-center text-white hover:bg-indigo-600 hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-indigo-500/30">
                        <i class="fab fa-x text-sm md:text-base"></i>
                    </a>
                    <a href="#"
                        class="w-8 h-8 md:w-10 md:h-10 bg-gray-800 rounded-full flex items-center justify-center text-white hover:bg-gray-700 hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-gray-500/30">
                        <i class="fab fa-github text-sm md:text-base"></i>
                    </a>
                    <a href="#"
                        class="w-8 h-8 md:w-10 md:h-10 bg-gray-800 rounded-full flex items-center justify-center text-white hover:bg-blue-600 hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-blue-500/30">
                        <i class="fab fa-linkedin-in text-sm md:text-base"></i>
                    </a>
                    <a href="#"
                        class="w-8 h-8 md:w-10 md:h-10 bg-gray-800 rounded-full flex items-center justify-center text-white hover:bg-pink-600 hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-pink-500/30">
                        <i class="fab fa-instagram text-sm md:text-base"></i>
                    </a>
                </div>
            </div>

            <div class="order-3 md:order-2 pt-6 md:pt-0 border-t md:border-t-0 border-gray-800">
                <h3
                    class="text-lg font-bold mb-4 md:mb-5 relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-10 after:h-0.5 after:bg-indigo-500">
                    Links Úteis</h3>
                <ul class="space-y-3">
                    <li><a href="/about" class="text-gray-400 hover:text-white transition flex items-center group">
                            <span
                                class="w-1 h-1 bg-gray-500 rounded-full mr-2 group-hover:bg-indigo-500 transition"></span>
                            Quem somos?
                        </a></li>
                    <li><a href="{{ route('policies.terms') }}" class="text-gray-400 hover:text-white transition flex items-center group">
                            <span
                                class="w-1 h-1 bg-gray-500 rounded-full mr-2 group-hover:bg-indigo-500 transition"></span>
                            Termos de uso
                        </a></li>
                    <li><a href="/partners" class="text-gray-400 hover:text-white transition flex items-center group">
                            <span
                                class="w-1 h-1 bg-gray-500 rounded-full mr-2 group-hover:bg-indigo-500 transition"></span>
                            Seja um parceiro
                        </a></li>
                    <li class="md:hidden"><a href="{{ route('policies.privacy') }}"
                            class="text-gray-400 hover:text-white transition flex items-center group">
                            <span
                                class="w-1 h-1 bg-gray-500 rounded-full mr-2 group-hover:bg-indigo-500 transition"></span>
                            Política de Privacidade
                        </a></li>
                    <li class="md:hidden"><a href="{{ route('policies.cookies') }}"
                            class="text-gray-400 hover:text-white transition flex items-center group">
                            <span
                                class="w-1 h-1 bg-gray-500 rounded-full mr-2 group-hover:bg-indigo-500 transition"></span>
                            Política de Cookies
                        </a></li>
                    <li class="md:hidden"><a href="{{ route('policies.consent') }}"
                            class="text-gray-400 hover:text-white transition flex items-center group">
                            <span
                                class="w-1 h-1 bg-gray-500 rounded-full mr-2 group-hover:bg-indigo-500 transition"></span>
                            Termo de Consentimento
                        </a></li>
                </ul>
            </div>

            <div class="order-4 md:order-3 pt-6 md:pt-0 border-t md:border-t-0 border-gray-800">
                <h3
                    class="text-lg font-bold mb-4 md:mb-5 relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-10 after:h-0.5 after:bg-indigo-500">
                    Contato</h3>
                <ul class="space-y-3">
                    <li class="text-gray-400 hover:text-white transition flex items-center">
                        <i class="fas fa-headset text-indigo-500 mr-3 text-sm md:text-base"></i>
                        Suporte
                    </li>
                    <li class="text-gray-400 hover:text-white transition flex items-center">
                        <i class="fas fa-envelope text-indigo-500 mr-3 text-sm md:text-base"></i>
                        contato@indoali.com
                    </li>
                    <li class="text-gray-400 hover:text-white transition flex items-center">
                        <i class="fas fa-map-marker-alt text-indigo-500 mr-3 text-sm md:text-base"></i>
                        Belo Horizonte, Brasil
                    </li>
                </ul>
            </div>
        </div>

        <div class="pt-6 md:pt-8 border-t border-gray-800 mt-6 md:mt-0">
            <div class="flex flex-col md:flex-row justify-between items-center gap-3 md:gap-4">
                <p class="text-gray-400 text-xs md:text-sm text-center md:text-left">
                    &copy; 2025 Indo Ali. Todos os direitos reservados.
                </p>
                <div class="hidden md:flex gap-4 md:gap-6">
                    <a href="{{ route('policies.privacy') }}" class="text-gray-400 hover:text-white text-sm transition">Política de
                        Privacidade</a>
                    <a href="{{ route('policies.cookies') }}" class="text-gray-400 hover:text-white text-sm transition">Política de Cookies</a>
                    <a href="{{ route('policies.consent') }}" class="text-gray-400 hover:text-white text-sm transition">Termo de Consentimento</a>
                </div>
            </div>
        </div>
    </div>
</footer>