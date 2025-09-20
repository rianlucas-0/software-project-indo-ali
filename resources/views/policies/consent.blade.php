<x-guest-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <i class="fas fa-user-check text-blue-400 mr-3"></i>
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Termo de Consentimento') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 sm:p-8 bg-[#161B22] shadow-lg sm:rounded-xl border border-gray-800">
                <div class="max-w-4xl">
                    <header class="mb-8">
                        <h1 class="text-2xl font-bold text-white flex items-center">
                            <i class="fas fa-file-signature text-blue-400 mr-3"></i>
                            TERMO DE CONSENTIMENTO PARA TRATAMENTO DE DADOS PESSOAIS – "INDO ALI"
                        </h1>
                        <p class="text-gray-400 mt-2">Atualizado em: 20 de setembro de 2025</p>
                    </header>

                    <div class="text-gray-300 space-y-6">
                        <p>
                            Este Termo de Consentimento formaliza sua autorização expressa, livre, informada e
                            inequívoca para o tratamento de seus dados pessoais pelo Projeto "Indo Ali", em conformidade
                            com a Lei nº 13.709/2018 – Lei Geral de Proteção de Dados (LGPD).
                        </p>

                        <div class="bg-blue-900/20 border border-blue-800/50 rounded-lg p-4">
                            <i class="fas fa-info-circle text-blue-400 mr-2"></i>
                            Ao utilizar o Indo Ali, você concorda com os termos de consentimento aqui estabelecidos.
                        </div>

                        <div class="border-l-4 border-blue-500 pl-4">
                            <h2 class="text-xl font-semibold text-white mb-4">CLÁUSULA PRIMEIRA – DO OBJETO DO
                                CONSENTIMENTO E DOS DADOS TRATADOS</h2>
                            <p>O titular AUTORIZA o Projeto "Indo Ali" a tratar os seguintes dados pessoais:</p>
                            <ul class="list-disc pl-5 mt-2 space-y-2">
                                <li>Nome completo – para identificação do usuário no sistema.</li>
                                <li>E-mail – para autenticação, login e recuperação de senha.</li>
                                <li>Senha – armazenada de forma criptografada para acesso seguro.</li>
                                <li>Foto de perfil (opcional) – para personalização da conta.</li>
                                <li>Histórico de navegação e interações – para geração de recomendações personalizadas.
                                </li>
                            </ul>
                        </div>

                        <div class="border-l-4 border-blue-500 pl-4">
                            <h2 class="text-xl font-semibold text-white mb-4">CLÁUSULA SEGUNDA – DAS FINALIDADES DO
                                TRATAMENTO</h2>
                            <p>Os dados pessoais serão utilizados exclusivamente para:</p>
                            <ol class="list-decimal pl-5 mt-2 space-y-2">
                                <li>Permitir cadastro, login e recuperação de senha.</li>
                                <li>Personalizar recomendações de lugares com base nas preferências e histórico do
                                    usuário.</li>
                                <li>Exibir informações como nome e foto de perfil em comentários e avaliações.</li>
                                <li>Garantir a segurança do sistema, com logs de acesso para auditoria.</li>
                                <li>Possibilitar comunicação com o usuário para suporte e avisos.</li>
                            </ol>
                        </div>

                        <div class="border-l-4 border-blue-500 pl-4">
                            <h2 class="text-xl font-semibold text-white mb-4">CLÁUSULA TERCEIRA – DO NÃO
                                COMPARTILHAMENTO DE DADOS</h2>
                            <p>Os dados não serão compartilhados com terceiros sem consentimento expresso do titular,
                                exceto em casos de obrigação legal ou para suporte técnico sob contrato de
                                confidencialidade.</p>
                        </div>

                        <div class="border-l-4 border-blue-500 pl-4">
                            <h2 class="text-xl font-semibold text-white mb-4">CLÁUSULA QUARTA – DO CONTROLADOR E DPO
                            </h2>
                            <p>O titular terá acesso às informações de contato do Controlador e do Encarregado de Dados
                                (DPO), conforme exigido pelo art. 41 da LGPD.</p>
                        </div>

                        <div class="border-l-4 border-blue-500 pl-4">
                            <h2 class="text-xl font-semibold text-white mb-4">CLÁUSULA QUINTA – DA CONFORMIDADE COM A
                                LGPD</h2>
                            <p>O tratamento observará os princípios da LGPD. Medidas aplicadas incluem criptografia de
                                senhas, controle de acesso restrito, monitoramento de logs e plano de resposta a
                                incidentes.</p>
                        </div>

                        <div class="border-l-4 border-blue-500 pl-4">
                            <h2 class="text-xl font-semibold text-white mb-4">CLÁUSULA SEXTA – DOS DIREITOS DO TITULAR
                            </h2>
                            <p>O titular poderá, a qualquer momento, solicitar revogação do consentimento, exclusão da
                                conta, acesso ou atualização de dados, bem como informações sobre o tratamento.</p>
                        </div>

                        <div class="border-l-4 border-blue-500 pl-4">
                            <h2 class="text-xl font-semibold text-white mb-4">CLÁUSULA SÉTIMA – CANAL DE COMUNICAÇÃO
                            </h2>
                            <div class="mt-3 p-3 bg-[#0D1117] rounded border border-gray-700">
                                <p class="flex items-center">
                                    <i class="fas fa-envelope text-blue-400 mr-2"></i>
                                    <span class="text-white">E-mail:</span>
                                    <span class="ml-2">suporte@indoali.com</span>
                                </p>
                                <p class="flex items-center mt-2">
                                    <i class="fas fa-phone text-blue-400 mr-2"></i>
                                    <span class="text-white">Telefone:</span>
                                    <span class="ml-2">(XX) XXXX-XXXX</span>
                                </p>
                            </div>
                        </div>

                        <!-- Conteúdo anterior da página... -->

                        <div class="border-l-4 border-blue-500 pl-4">
                            <h2 class="text-xl font-semibold text-white mb-4">CLÁUSULA OITAVA – DO CONSENTIMENTO LIVRE
                            </h2>
                            <p>O titular confirma que o consentimento foi concedido de forma livre, sem coação, após
                                leitura e compreensão integral deste Termo.</p>
                        </div>

                        @auth
                        <div class="bg-green-900/20 border border-green-800/50 rounded-lg p-4 mt-6">
                            <i class="fas fa-check-circle text-green-400 mr-2"></i>
                            <span class="text-white font-medium">Consentimento Confirmado:</span>
                            Você aceitou este termo ao criar sua conta no Indo Ali.
                        </div>
                        @else
                        <div class="bg-blue-900/20 border border-blue-800/50 rounded-lg p-4 mt-6">
                            <i class="fas fa-info-circle text-blue-400 mr-2"></i>
                            <span class="text-white font-medium">Informação:</span>
                            O aceite deste termo é realizado durante o registro no sistema. É necessário aceitar os
                            termos para criar uma conta.
                        </div>
                        @endauth

                        <div class="mt-8 pt-6 border-t border-gray-800">
                            <p class="text-sm text-gray-500">
                                <i class="fas fa-clock mr-1"></i>
                                Última atualização: 20 de setembro de 2025
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>