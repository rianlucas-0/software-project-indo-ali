<x-auth-layout authTitle="Complete seu cadastro" authMessage="Para finalizar, aceite nossos termos de uso.">
    <h2 class="text-gray-400 font-medium text-sm md:text-base">COMPLETE SEU CADASTRO</h2>
    <h3 class="text-white font-medium text-xl md:text-2xl lg:text-3xl">Aceite os Termos</h3>

    <div class="bg-blue-900/20 border border-blue-800/50 rounded-lg p-4 mt-4 mb-6">
        <div class="flex items-center">
            @if(session('social_user')['provider'] === 'google')
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-6 h-6 mr-2">
            <span class="text-white">Cadastro via Google</span>
            @else
            <img src="https://www.svgrepo.com/show/452196/facebook-1.svg" alt="Facebook" class="w-6 h-6 mr-2">
            <span class="text-white">Cadastro via Facebook</span>
            @endif
        </div>
    </div>

    <form method="POST" action="{{ route('social.register.submit') }}">
        @csrf

        <div class="mb-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full md:mt-2 bg-gray-700" type="text" name="name"
                value="{{ session('social_user')['name'] }}" required readonly />
        </div>

        <div class="mb-6">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full md:mt-2 bg-gray-700" type="email" name="email"
                value="{{ session('social_user')['email'] }}" required readonly />
        </div>

        <div class="block mt-4 md:mt-6 p-4 bg-[#161B22] rounded-lg border border-gray-800 shadow-lg">
            <label for="terms_acceptance" class="inline-flex items-start">
                <input id="terms_acceptance" type="checkbox"
                    class="rounded focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-700 mt-1 bg-[#0D1117]"
                    name="terms_accepted" required>
                <span class="ms-2 text-sm text-gray-300 md:text-base">
                    Eu li e concordo com o
                    <button type="button" onclick="openModal('consent_modal')"
                        class="text-blue-400 hover:text-blue-300 hover:underline font-medium">
                        Termo de Consentimento
                    </button>
                    e os
                    <button type="button" onclick="openModal('terms_modal')"
                        class="text-blue-400 hover:text-blue-300 hover:underline font-medium">
                        Termos de Uso
                    </button>
                    do Projeto "Indo Ali"
                </span>
            </label>

            @error('terms_accepted')
            <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-8 flex justify-center md:mt-10">
            <x-primary-button class="justify-center md:px-8 md:py-3 md:text-lg">
                {{ __('Finalizar Cadastro') }}
            </x-primary-button>
        </div>
    </form>

    <div id="consent_modal"
        class="hidden fixed inset-0 bg-gray-900 bg-opacity-80 flex items-center justify-center z-50 p-4">
        <div
            class="bg-[#161B22] rounded-lg border border-gray-800 shadow-xl max-w-4xl w-full max-h-[90vh] overflow-hidden flex flex-col">
            <div class="flex justify-between items-center p-6 border-b border-gray-800">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-file-contract text-blue-400 mr-3"></i>
                    Termo de Consentimento - Indo Ali
                </h3>
                <button onclick="closeModal('consent_modal')" class="text-gray-400 hover:text-gray-200">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <div class="p-6 overflow-y-auto">
                <div class="text-gray-300">
                    <h3 class="text-lg font-semibold mb-4 text-center text-white">TERMO DE CONSENTIMENTO PARA TRATAMENTO
                        DE
                        DADOS PESSOAIS – "INDO ALI"</h3>
                    <p class="mb-4">Este Termo de Consentimento formaliza sua autorização expressa, livre, informada e
                        inequívoca para o tratamento de seus dados pessoais pelo Projeto "Indo Ali", em conformidade com
                        a
                        Lei nº 13.709/2018 – Lei Geral de Proteção de Dados (LGPD).</p>

                    <h4 class="font-semibold mt-6 mb-2 text-blue-400">CLÁUSULA PRIMEIRA – DO OBJETO DO CONSENTIMENTO E
                        DOS
                        DADOS TRATADOS</h4>
                    <p class="mb-3">O titular AUTORIZA o Projeto "Indo Ali" a tratar os seguintes dados pessoais:</p>
                    <ul class="list-disc pl-5 mb-3 space-y-1">
                        <li>Nome completo – para identificação do usuário no sistema.</li>
                        <li>E-mail – para autenticação, login e recuperação de senha.</li>
                        <li>Senha – armazenada de forma criptografada para acesso seguro.</li>
                        <li>Foto de perfil (opcional) – para personalização da conta.</li>
                        <li>Histórico de navegação e interações – para geração de recomendações personalizadas.</li>
                    </ul>

                    <h4 class="font-semibold mt-6 mb-2 text-blue-400">CLÁUSULA SEGUNDA – DAS FINALIDADES DO TRATAMENTO
                    </h4>
                    <p class="mb-3">Os dados pessoais serão utilizados exclusivamente para:</p>
                    <ol class="list-decimal pl-5 mb-3 space-y-1">
                        <li>Permitir cadastro, login e recuperação de senha.</li>
                        <li>Personalizar recomendações de lugares com base nas preferências e histórico do usuário.</li>
                        <li>Exibir informações como nome e foto de perfil em comentários e avaliações.</li>
                        <li>Garantir a segurança do sistema, com logs de acesso para auditoria.</li>
                        <li>Possibilitar comunicação com o usuário para suporte e avisos.</li>
                    </ol>

                    <h4 class="font-semibold mt-6 mb-2 text-blue-400">CLÁUSULA TERCEIRA – DO NÃO COMPARTILHAMENTO DE
                        DADOS
                    </h4>
                    <p class="mb-3">Os dados não serão compartilhados com terceiros sem consentimento expresso do
                        titular,
                        exceto em casos de obrigação legal ou para suporte técnico sob contrato de confidencialidade.
                    </p>

                    <h4 class="font-semibold mt-6 mb-2 text-blue-400">CLÁUSULA QUARTA – DO CONTROLADOR E DPO</h4>
                    <p class="mb-3">O titular terá acesso às informações de contato do Controlador e do Encarregado de
                        Dados
                        (DPO), conforme exigido pelo art. 41 da LGPD.</p>

                    <h4 class="font-semibold mt-6 mb-2 text-blue-400">CLÁUSULA QUINTA – DA CONFORMIDADE COM A LGPD</h4>
                    <p class="mb-3">O tratamento observará os princípios da LGPD. Medidas aplicadas incluem criptografia
                        de
                        senhas, controle de acesso restrito, monitoramento de logs e plano de resposta a incidentes.</p>

                    <h4 class="font-semibold mt-6 mb-2 text-blue-400">CLÁUSULA SEXTA – DOS DIREITOS DO TITULAR</h4>
                    <p class="mb-3">O titular poderá, a qualquer momento, solicitar revogação do consentimento, exclusão
                        da
                        conta, acesso ou atualização de dados, bem como informações sobre o tratamento.</p>

                    <h4 class="font-semibold mt-6 mb-2 text-blue-400">CLÁUSULA SÉTIMA – CANAL DE COMUNICAÇÃO</h4>
                    <p class="mb-3">E-mail: suporte@indoali.com<br>Telefone: (XX) XXXX-XXXX</p>

                    <h4 class="font-semibold mt-6 mb-2 text-blue-400">CLÁUSULA OITAVA – DO CONSENTIMENTO LIVRE</h4>
                    <p class="mb-6">O titular confirma que o consentimento foi concedido de forma livre, sem coação,
                        após
                        leitura e compreensão integral deste Termo.</p>
                </div>
            </div>

            <div class="flex justify-end p-6 border-t border-gray-800">
                <button onclick="closeModal('consent_modal')"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    Fechar
                </button>
            </div>
        </div>
    </div>

    <div id="terms_modal"
        class="hidden fixed inset-0 bg-gray-900 bg-opacity-80 flex items-center justify-center z-50 p-4">
        <div
            class="bg-[#161B22] rounded-lg border border-gray-800 shadow-xl max-w-4xl w-full max-h-[90vh] overflow-hidden flex flex-col">
            <div class="flex justify-between items-center p-6 border-b border-gray-800">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-file-alt text-blue-400 mr-3"></i>
                    Termos de Uso - Indo Ali
                </h3>
                <button onclick="closeModal('terms_modal')" class="text-gray-400 hover:text-gray-200">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <div class="p-6 overflow-y-auto">
                <div class="text-gray-300">
                    <h3 class="text-lg font-semibold mb-4 text-center text-white">TERMO DE USO DO SISTEMA "INDO ALI"
                    </h3>
                    <p class="mb-4">Este Termo de Uso ("Termo") é um acordo legal entre você, o(a) usuário(a) do
                        sistema, e
                        os desenvolvedores do Projeto "Indo Ali" (doravante denominado "Indo Ali" ou "Nós"), um sistema
                        pensado para conectar usuários a locais, restaurantes e eventos, com base em preferências
                        personalizadas. Ao acessar ou utilizar o "Indo Ali", você manifesta sua concordância integral
                        com
                        este Termo de Uso, com a Política de Privacidade e com a Lei Geral de Proteção de Dados Pessoais
                        (LGPD – Lei nº 13.709/2018). Se você não concordar com estes termos, não deverá utilizar o
                        sistema.
                    </p>

                    <h4 class="font-semibold mt-6 mb-2 text-blue-400">CLÁUSULA PRIMEIRA – DAS CONDIÇÕES GERAIS DE USO
                    </h4>
                    <p class="mb-3">O "Indo Ali" é destinado a usuários que buscam pesquisar, avaliar e comentar sobre
                        locais, bem como salvar favoritos e receber recomendações personalizadas.</p>

                    <h4 class="font-semibold mt-6 mb-2 text-blue-400">CLÁUSULA SEGUNDA – DA COLETA E USO DE DADOS
                        PESSOAIS
                    </h4>
                    <p class="mb-3">O usuário declara estar ciente da coleta e uso dos seguintes dados pelo "Indo Ali":
                    </p>
                    <ul class="list-disc pl-5 mb-3 space-y-1">
                        <li>Nome completo</li>
                        <li>E-mail</li>
                        <li>Localização aproximada (para recomendações)</li>
                        <li>Histórico de navegação no sistema</li>
                        <li>Preferências informadas em formulários</li>
                    </ul>

                    <h4 class="font-semibold mt-6 mb-2 text-blue-400">CLÁUSULA TERCEIRA – FINALIDADE DA COLETA</h4>
                    <ul class="list-disc pl-5 mb-3 space-y-1">
                        <li>Personalização das recomendações de locais</li>
                        <li>Exibição de informações relevantes para o usuário</li>
                        <li>Contato para suporte ou notificações importantes</li>
                        <li>Manutenção de histórico de comentários e avaliações</li>
                    </ul>

                    <h4 class="font-semibold mt-6 mb-2 text-blue-400">CLÁUSULA QUARTA – VEDAÇÕES DO USO</h4>
                    <ul class="list-disc pl-5 mb-3 space-y-1">
                        <li>Carregar conteúdo ilegal, difamatório, obsceno ou prejudicial</li>
                        <li>Acessar, alterar ou danificar contas de outros usuários</li>
                        <li>Violar direitos de propriedade intelectual ou outros direitos de terceiros</li>
                    </ul>

                    <h4 class="font-semibold mt-6 mb-2 text-blue-400">CLÁUSULA QUINTA – ACEITAÇÃO IMPLÍCITA</h4>
                    <p class="mb-3">O uso do Sistema "Indo Ali" implica em concordância integral e incondicional com
                        este
                        Termo de Uso.</p>

                    <h4 class="font-semibold mt-6 mb-2 text-blue-400">CLÁUSULA SEXTA – DA PROTEÇÃO DOS DADOS</h4>
                    <ul class="list-disc pl-5 mb-3 space-y-1">
                        <li>Criptografia dos arquivos armazenados</li>
                        <li>Banco de dados seguro, com autenticação robusta e acesso restrito</li>
                        <li>Políticas de segurança da informação e plano de resposta a incidentes</li>
                    </ul>

                    <h4 class="font-semibold mt-6 mb-2 text-blue-400">CLÁUSULA SÉTIMA – DO COMPARTILHAMENTO DE DADOS
                    </h4>
                    <ul class="list-disc pl-5 mb-3 space-y-1">
                        <li>Quando autorizado expressamente pelo titular</li>
                        <li>Mediante obrigação legal ou ordem judicial</li>
                        <li>Para auxílio técnico restrito e necessário</li>
                    </ul>

                    <h4 class="font-semibold mt-6 mb-2 text-blue-400">CLÁUSULA OITAVA – DOS DIREITOS DO TITULAR DOS
                        DADOS
                    </h4>
                    <ul class="list-disc pl-5 mb-3 space-y-1">
                        <li>Exclusão da conta e dos arquivos</li>
                        <li>Revogação do consentimento a qualquer momento</li>
                        <li>Solicitação de informações sobre o uso de seus dados</li>
                        <li>Canal de contato: dpo@indoali.com.br</li>
                    </ul>

                    <h4 class="font-semibold mt-6 mb-2 text-blue-400">CLÁUSULA NONA – DA IDENTIFICAÇÃO DO RESPONSÁVEL
                        PELO
                        TRATAMENTO DOS DADOS</h4>
                    <p class="mb-3">Projeto "Indo Ali" – Responsável pelo tratamento dos dados: Nome do Encarregado –
                        DPO –
                        CPF/Documento.</p>

                    <h4 class="font-semibold mt-6 mb-2 text-blue-400">CLÁUSULA DÉCIMA – DA RESPONSABILIDADE NA EXATIDÃO
                        DOS
                        DADOS</h4>
                    <p class="mb-3">O usuário é responsável pela veracidade e atualização dos dados fornecidos.</p>

                    <h4 class="font-semibold mt-6 mb-2 text-blue-400">CLÁUSULA DÉCIMA PRIMEIRA – DA TRANSPARÊNCIA</h4>
                    <p class="mb-3">Os direitos dos usuários serão atendidos em até 48 horas para confirmação e até 15
                        dias
                        para demandas complexas.</p>

                    <h4 class="font-semibold mt-6 mb-2 text-blue-400">CLÁUSULA DÉCIMA SEGUNDA – DADOS DE CRIANÇAS E
                        ADOLESCENTES</h4>
                    <p class="mb-3">O "Indo Ali" cumpre o art. 14 da LGPD e trata dados de crianças apenas mediante
                        consentimento de um dos responsáveis legais.</p>

                    <h4 class="font-semibold mt-6 mb-2 text-blue-400">CLÁUSULA DÉCIMA TERCEIRA – DISPOSIÇÕES GERAIS</h4>
                    <p class="mb-3">Este Termo pode ser atualizado periodicamente para refletir mudanças legais ou
                        operacionais. É regido pela legislação brasileira.</p>

                    <h4 class="font-semibold mt-6 mb-2 text-blue-400">CLÁUSULA DÉCIMA QUARTA – DO FORO</h4>
                    <p class="mb-6">Fica eleito o foro da comarca de Belo Horizonte/MG para dirimir eventuais
                        controvérsias.
                    </p>

                    <p class="text-sm italic text-gray-400 mb-6">Importante: O aceite eletrônico deste termo no site
                        "Indo
                        Ali" confirma o consentimento, nos termos da LGPD.</p>
                </div>
            </div>

            <div class="flex justify-end p-6 border-t border-gray-800">
                <button onclick="closeModal('terms_modal')"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    Fechar
                </button>
            </div>
        </div>
    </div>

    <script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal('consent_modal');
            closeModal('terms_modal');
        }
    });

    document.getElementById('consent_modal').addEventListener('click', function(e) {
        if (e.target.id === 'consent_modal') closeModal('consent_modal');
    });

    document.getElementById('terms_modal').addEventListener('click', function(e) {
        if (e.target.id === 'terms_modal') closeModal('terms_modal');
    });
    </script>
</x-auth-layout>