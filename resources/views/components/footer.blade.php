<footer class="bg-gray-100 dark:bg-gray-950 text-gray-800 dark:text-white pt-12 pb-20 md:pt-16 md:pb-8">
    <div class="container mx-auto px-5 max-w-7xl">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 md:gap-10 mb-8 md:mb-10">
            <div class="md:col-span-2">
                <div class="flex items-center mb-4 md:mb-5">
                    <i class="fas fa-map-marker-alt text-indigo-500 text-xl md:text-2xl mr-3"></i>
                    <h3
                        class="text-xl md:text-2xl font-bold bg-gradient-to-r from-indigo-400 to-purple-500 bg-clip-text text-transparent">
                        Indo Ali
                    </h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400 mb-4 md:mb-6 leading-relaxed text-sm md:text-base">
                    O Indo Ali é sua plataforma digital para descobrir e explorar os melhores lugares da sua cidade.
                    Encontre restaurantes, bares e eventos com avaliações reais, fotos autênticas e recomendações
                    personalizadas.
                </p>
                <div class="flex gap-3 md:gap-4">
                    <a href="#"
                        class="w-8 h-8 md:w-10 md:h-10 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center text-gray-700 dark:text-white hover:bg-indigo-600 hover:text-white dark:hover:bg-indigo-600 hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-indigo-500/30">
                        <i class="fab fa-x text-sm md:text-base"></i>
                    </a>
                    <a href="#"
                        class="w-8 h-8 md:w-10 md:h-10 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center text-gray-700 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-gray-500/30">
                        <i class="fab fa-github text-sm md:text-base"></i>
                    </a>
                    <a href="#"
                        class="w-8 h-8 md:w-10 md:h-10 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center text-gray-700 dark:text-white hover:bg-blue-600 hover:text-white dark:hover:bg-blue-600 hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-blue-500/30">
                        <i class="fab fa-linkedin-in text-sm md:text-base"></i>
                    </a>
                    <a href="#"
                        class="w-8 h-8 md:w-10 md:h-10 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center text-gray-700 dark:text-white hover:bg-pink-600 hover:text-white dark:hover:bg-pink-600 hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-pink-500/30">
                        <i class="fab fa-instagram text-sm md:text-base"></i>
                    </a>
                </div>
            </div>

            <div class="order-3 md:order-2 pt-6 md:pt-0 border-t md:border-t-0 border-gray-300 dark:border-gray-800">
                <h3
                    class="text-lg font-bold mb-4 md:mb-5 relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-10 after:h-0.5 after:bg-indigo-500">
                    Links Úteis
                </h3>
                <ul class="space-y-3">
                    <li>
                        <a href="/about" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition flex items-center group">
                            <span
                                class="w-1 h-1 bg-gray-400 dark:bg-gray-500 rounded-full mr-2 group-hover:bg-indigo-500 transition"></span>
                            Quem somos?
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('policies.terms') }}"
                            class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition flex items-center group">
                            <span
                                class="w-1 h-1 bg-gray-400 dark:bg-gray-500 rounded-full mr-2 group-hover:bg-indigo-500 transition"></span>
                            Termos de uso
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('become-partner') }}"
                            class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition flex items-center group">
                            <span
                                class="w-1 h-1 bg-gray-400 dark:bg-gray-500 rounded-full mr-2 group-hover:bg-indigo-500 transition"></span>
                            Seja um parceiro
                        </a>
                    </li>
                    <li class="md:hidden">
                        <a href="{{ route('policies.privacy') }}"
                            class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition flex items-center group">
                            <span
                                class="w-1 h-1 bg-gray-400 dark:bg-gray-500 rounded-full mr-2 group-hover:bg-indigo-500 transition"></span>
                            Política de Privacidade
                        </a>
                    </li>
                    <li class="md:hidden">
                        <a href="{{ route('policies.cookies') }}"
                            class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition flex items-center group">
                            <span
                                class="w-1 h-1 bg-gray-400 dark:bg-gray-500 rounded-full mr-2 group-hover:bg-indigo-500 transition"></span>
                            Política de Cookies
                        </a>
                    </li>
                    <li class="md:hidden">
                        <a href="{{ route('policies.consent') }}"
                            class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition flex items-center group">
                            <span
                                class="w-1 h-1 bg-gray-400 dark:bg-gray-500 rounded-full mr-2 group-hover:bg-indigo-500 transition"></span>
                            Termo de Consentimento
                        </a>
                    </li>
                </ul>
            </div>

            <div class="order-4 md:order-3 pt-6 md:pt-0 border-t md:border-t-0 border-gray-300 dark:border-gray-800">
                <h3
                    class="text-lg font-bold mb-4 md:mb-5 relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-10 after:h-0.5 after:bg-indigo-500">
                    Contato
                </h3>
                <ul class="space-y-3">
                    <li class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition flex items-center cursor-pointer"
                        id="openSupportChat">
                        <i class="fas fa-headset text-indigo-500 mr-3 text-sm md:text-base"></i>
                        Suporte
                    </li>
                    <li class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition flex items-center">
                        <i class="fas fa-envelope text-indigo-500 mr-3 text-sm md:text-base"></i>
                        contato@indoali.com
                    </li>
                    <li class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition flex items-center">
                        <i class="fas fa-map-marker-alt text-indigo-500 mr-3 text-sm md:text-base"></i>
                        Belo Horizonte, Brasil
                    </li>
                </ul>
            </div>
        </div>

        <div class="pt-6 md:pt-8 border-t border-gray-300 dark:border-gray-800 mt-6 md:mt-0">
            <div class="flex flex-col md:flex-row justify-between items-center gap-3 md:gap-4">
                <p class="text-gray-600 dark:text-gray-400 text-xs md:text-sm text-center md:text-left">
                    &copy; 2025 Indo Ali. Todos os direitos reservados.
                </p>
                <div class="hidden md:flex gap-4 md:gap-6">
                    <a href="{{ route('policies.privacy') }}"
                        class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white text-sm transition">Política de Privacidade</a>
                    <a href="{{ route('policies.cookies') }}"
                        class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white text-sm transition">Política de Cookies</a>
                    <a href="{{ route('policies.consent') }}"
                        class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white text-sm transition">Termo de Consentimento</a>
                </div>
            </div>
        </div>
    </div>

    <div id="supportChatModal"
        class="fixed inset-0 md:inset-auto md:bottom-20 md:right-5 w-full md:w-96 bg-transparent z-50 hidden">
        <div class="fixed inset-0 bg-black bg-opacity-50 md:hidden" id="supportChatOverlay"></div>

        <!-- Modal -->
        <div
            class="fixed bottom-0 left-0 right-0 md:relative md:rounded-2xl bg-white dark:bg-[#161B22] border border-gray-300 dark:border-gray-700 shadow-2xl flex flex-col h-[85vh] md:h-[600px] md:max-h-[80vh] transform transition-transform duration-300">
            <!-- Cabeçalho -->
            <div class="flex items-center justify-between bg-indigo-600 text-white p-4 md:rounded-t-2xl">
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-full bg-indigo-400 flex items-center justify-center mr-3">
                        <i class="fas fa-headset text-sm"></i>
                    </div>
                    <div>
                        <span class="font-semibold text-sm md:text-base">Suporte Técnico</span>
                        <div class="text-xs text-indigo-200">Indo Ali</div>
                    </div>
                </div>
                <button id="closeSupportChat"
                    class="text-white hover:text-gray-200 transition p-2 rounded-full hover:bg-indigo-500 w-8 h-8 flex items-center justify-center">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Área de Conteúdo -->
            <div class="flex-1 flex flex-col overflow-hidden bg-gray-50 dark:bg-[#1E2229]">
                <!-- Mensagens -->
                <div class="flex-1 overflow-y-auto p-4 space-y-4">

                    <div class="flex justify-start">
                        <div class="bg-white dark:bg-[#161B22] rounded-2xl rounded-tl-none p-4 max-w-[85%] md:max-w-[80%]">
                            <div class="font-medium text-indigo-600 dark:text-indigo-400 text-sm mb-1">Suporte Indo Ali</div>
                            <div class="text-gray-700 dark:text-gray-300 text-sm">Olá! Como posso ajudá-lo hoje?</div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-[#161B22] rounded-2xl p-4">
                        <label for="supportTopic" class="block mb-3 font-medium text-sm text-gray-700 dark:text-gray-300">Selecione o
                            problema</label>
                        <select id="supportTopic"
                            class="w-full p-3 bg-gray-100 dark:bg-[#1E2229] border border-gray-300 dark:border-gray-700 rounded-lg text-sm text-gray-900 dark:text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
                            <option value="" class="text-gray-500">— Escolha um tópico —</option>
                            <option value="login" class="text-gray-900 dark:text-white">Problemas para entrar / login</option>
                            <option value="upload" class="text-gray-900 dark:text-white">Erro ao enviar fotos / upload</option>
                            <option value="bug_ui" class="text-gray-900 dark:text-white">Bug na interface</option>
                            <option value="perf" class="text-gray-900 dark:text-white">Site lento / performance</option>
                            <option value="account" class="text-gray-900 dark:text-white">Alterar dados / conta</option>
                            <option value="other" class="text-gray-900 dark:text-white">Outro problema técnico</option>
                        </select>
                    </div>

                    <div id="supportFollowup" class="space-y-4">
                        <div class="text-gray-500 text-sm italic text-center py-4">
                            Selecione um tópico para ver passos de solução rápida.
                        </div>
                    </div>
                </div>

                <div class="p-4 border-t border-gray-300 dark:border-gray-700 bg-white dark:bg-[#161B22]">
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button id="supportConfirm"
                            class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white py-3 px-4 rounded-lg text-sm font-medium transition disabled:bg-indigo-400 disabled:cursor-not-allowed flex items-center justify-center order-2 sm:order-1">
                            <i class="fas fa-lightbulb mr-2"></i>
                            Obter solução
                        </button>
                        <button id="supportHuman"
                            class="flex-1 bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600 text-gray-800 dark:text-white py-3 px-4 rounded-lg text-sm font-medium transition flex items-center justify-center order-1 sm:order-2">
                            <i class="fas fa-user mr-2"></i>
                            Falar com humano
                        </button>
                    </div>
                    <div id="supportNotice" class="mt-3 text-xs text-gray-500 text-center"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript mantido igual - não precisa de alterações -->
    <script>
document.addEventListener('DOMContentLoaded', () => {
    const openBtn = document.getElementById('openSupportChat');
    const modal = document.getElementById('supportChatModal');
    const overlay = document.getElementById('supportChatOverlay');
    const closeBtn = document.getElementById('closeSupportChat');
    const select = document.getElementById('supportTopic');
    const followup = document.getElementById('supportFollowup');
    const confirmBtn = document.getElementById('supportConfirm');
    const humanBtn = document.getElementById('supportHuman');
    const notice = document.getElementById('supportNotice');

    openBtn.addEventListener('click', () => {
        modal.classList.remove('hidden');
        select.value = '';
        followup.innerHTML =
            '<div class="text-gray-500 text-sm italic text-center py-4">Selecione um tópico para ver passos de solução rápida.</div>';
        confirmBtn.disabled = true;
        notice.textContent = '';
    });

    function closeChat() {
        modal.classList.add('hidden');
    }

    closeBtn.addEventListener('click', closeChat);
    overlay?.addEventListener('click', closeChat);

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeChat();
        }
    });

    const knowledge = {
        login: {
            answer: 'Problemas de login: escolha o cenário que corresponde ao seu caso.',
            followups: [{
                    id: 'wrong_pass',
                    text: 'Senha incorreta'
                },
                {
                    id: 'no_account',
                    text: 'Não lembro se tenho conta'
                },
                {
                    id: 'oauth',
                    text: 'Login com Google/Facebook não funciona'
                }
            ]
        },
        upload: {
            answer: 'Erro no upload de imagens: selecione o problema.',
            followups: [{
                    id: 'file_too_large',
                    text: 'Arquivo muito grande / limite'
                },
                {
                    id: 'replace',
                    text: 'Imagem é substituída / não salva'
                },
                {
                    id: 'format',
                    text: 'Formato não aceito (png/jpg)'
                }
            ]
        },
        bug_ui: {
            answer: 'Bug de interface: escolha a opção.',
            followups: [{
                    id: 'button',
                    text: 'Botão não responde'
                },
                {
                    id: 'layout',
                    text: 'Layout quebrado em mobile'
                },
                {
                    id: 'images',
                    text: 'Imagens não carregam'
                }
            ]
        },
        perf: {
            answer: 'Problemas de performance: descreva o que acontece.',
            followups: [{
                    id: 'slow_page',
                    text: 'Página demora para carregar'
                },
                {
                    id: 'timeout',
                    text: 'Operação timeouts / erro 504'
                },
                {
                    id: 'api',
                    text: 'Listas / busca demoram'
                }
            ]
        },
        account: {
            answer: 'Alteração ou recuperação de conta.',
            followups: [{
                    id: 'change_email',
                    text: 'Quero mudar e-mail'
                },
                {
                    id: 'reset_password',
                    text: 'Esqueci a senha (reset)'
                },
                {
                    id: 'delete_account',
                    text: 'Quero excluir minha conta'
                }
            ]
        },
        other: {
            answer: 'Explique rapidamente seu problema técnico.',
            followups: [{
                id: 'custom',
                text: 'Descrever problema'
            }]
        }
    };

    select.addEventListener('change', () => {
        const key = select.value;
        followup.innerHTML = '';
        confirmBtn.disabled = true;
        notice.textContent = '';

        if (!key) {
            followup.innerHTML =
                '<div class="text-gray-500 text-sm italic text-center py-4">Selecione um tópico para ver passos de solução rápida.</div>';
            return;
        }

        const node = knowledge[key];

        const assistantMsg = document.createElement('div');
        assistantMsg.className = 'flex justify-start';
        assistantMsg.innerHTML = `
                <div class="bg-white dark:bg-[#161B22] rounded-2xl rounded-tl-none p-4 max-w-[85%] md:max-w-[80%]">
                    <div class="font-medium text-indigo-600 dark:text-indigo-400 text-sm mb-1">Assistente</div>
                    <div class="text-gray-700 dark:text-gray-300 text-sm">${node.answer}</div>
                </div>
            `;
        followup.appendChild(assistantMsg);

        const optionsContainer = document.createElement('div');
        optionsContainer.className = 'space-y-2 mt-4';

        node.followups.forEach(f => {
            const button = document.createElement('button');
            button.type = 'button';
            button.className =
                'w-full text-left p-3 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-[#161B22] hover:bg-gray-100 dark:hover:bg-gray-800 text-sm text-gray-700 dark:text-gray-300 transition duration-200';
            button.dataset.id = f.id;
            button.textContent = f.text;
            optionsContainer.appendChild(button);

            button.addEventListener('click', () => {
                // Remove todas as seleções anteriores
                optionsContainer.querySelectorAll('button').forEach(btn => {
                    btn.classList.remove('border-indigo-500', 'bg-indigo-100', 'dark:bg-indigo-900/20', 'text-indigo-700', 'dark:text-white');
                });

                // Adiciona seleção atual
                button.classList.add('border-indigo-500', 'bg-indigo-100', 'dark:bg-indigo-900/20', 'text-indigo-700', 'dark:text-white');
                confirmBtn.disabled = false;
                confirmBtn.dataset.selected = JSON.stringify({
                    topic: key,
                    choice: f.id,
                    label: f.text
                });
            });
        });

        if (node.followups.some(f => f.id === 'custom')) {
            const textareaContainer = document.createElement('div');
            textareaContainer.className = 'mt-4';

            const textarea = document.createElement('textarea');
            textarea.id = 'supportCustomText';
            textarea.placeholder = 'Descreva o problema em detalhes...';
            textarea.className =
                'w-full p-3 bg-white dark:bg-[#161B22] border border-gray-300 dark:border-gray-700 rounded-lg text-sm text-gray-900 dark:text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition resize-none';
            textarea.rows = 4;
            textareaContainer.appendChild(textarea);

            optionsContainer.appendChild(textareaContainer);

            textarea.addEventListener('input', () => {
                const val = textarea.value.trim();
                if (val.length >= 10) {
                    confirmBtn.disabled = false;
                    confirmBtn.dataset.selected = JSON.stringify({
                        topic: key,
                        choice: 'custom',
                        label: val
                    });

                    // Remove seleção de botões quando textarea está preenchida
                    optionsContainer.querySelectorAll('button').forEach(btn => {
                        btn.classList.remove('border-indigo-500', 'bg-indigo-100', 'dark:bg-indigo-900/20', 'text-indigo-700', 'dark:text-white');
                    });
                } else {
                    confirmBtn.disabled = true;
                    delete confirmBtn.dataset.selected;
                }
            });
        }

        followup.appendChild(optionsContainer);

        followup.scrollTop = followup.scrollHeight;
    });

    function generateTechReply(sel) {
        if (!sel) return 'Não foi possível identificar o problema.';
        const {
            topic,
            choice,
            label
        } = sel;

        const responses = {
            login: {
                wrong_pass: '<div class="font-medium text-indigo-600 dark:text-indigo-400 mb-2">Senha incorreta</div><div class="text-sm text-gray-700 dark:text-gray-300">Tente redefinir a senha em "Esqueci minha senha". Se já redefiniu e não funciona, limpe cache/cookies ou tente usar outra aba anônima.</div>',
                no_account: '<div class="font-medium text-indigo-600 dark:text-indigo-400 mb-2">Conta não encontrada</div><div class="text-sm text-gray-700 dark:text-gray-300">Verifique se você cadastrou com o e-mail correto. Se quiser, podemos enviar um link para criar conta.</div>',
                oauth: '<div class="font-medium text-indigo-600 dark:text-indigo-400 mb-2">Login social</div><div class="text-sm text-gray-700 dark:text-gray-300">Confirme que a conta Google/Facebook está autenticada no navegador e que popups não estão bloqueados.</div>'
            },
            upload: {
                file_too_large: '<div class="font-medium text-indigo-600 dark:text-indigo-400 mb-2">Arquivo grande</div><div class="text-sm text-gray-700 dark:text-gray-300">Tente reduzir a resolução/qualidade ou enviar imagens abaixo de 5MB. Estamos planejando aumentar limite.</div>',
                replace: '<div class="font-medium text-indigo-600 dark:text-indigo-400 mb-2">Imagem substituída</div><div class="text-sm text-gray-700 dark:text-gray-300">Esse é um bug conhecido. Como solução alternativa, selecione múltiplas imagens ao mesmo tempo.</div>',
                format: '<div class="font-medium text-indigo-600 dark:text-indigo-400 mb-2">Formato</div><div class="text-sm text-gray-700 dark:text-gray-300">Aceitamos JPG e PNG. Converta para um desses formatos e tente novamente.</div>'
            },
            bug_ui: {
                button: '<div class="font-medium text-indigo-600 dark:text-indigo-400 mb-2">Botão não responde</div><div class="text-sm text-gray-700 dark:text-gray-300">Tente atualizar a página (Ctrl+F5). Se ocorrer apenas em mobile, informe o modelo e versão do navegador.</div>',
                layout: '<div class="font-medium text-indigo-600 dark:text-indigo-400 mb-2">Layout quebrado</div><div class="text-sm text-gray-700 dark:text-gray-300">Descreva o dispositivo e a resolução. Informe também se está em modo mobile/desktop.</div>',
                images: '<div class="font-medium text-indigo-600 dark:text-indigo-400 mb-2">Imagens não carregam</div><div class="text-sm text-gray-700 dark:text-gray-300">Verifique sua conexão. Se o problema persistir, vamos coletar logs e investigar.</div>'
            },
            perf: {
                slow_page: '<div class="font-medium text-indigo-600 dark:text-indigo-400 mb-2">Página lenta</div><div class="text-sm text-gray-700 dark:text-gray-300">Tente limpar cache. Se repetir, ao escalar iremos coletar tempo de carregamento e logs.</div>',
                timeout: '<div class="font-medium text-indigo-600 dark:text-indigo-400 mb-2">Timeout / 504</div><div class="text-sm text-gray-700 dark:text-gray-300">Isso indica problema no servidor backend. Iremos abrir ticket e investigar.</div>',
                api: '<div class="font-medium text-indigo-600 dark:text-indigo-400 mb-2">Busca lenta</div><div class="text-sm text-gray-700 dark:text-gray-300">Relate qual busca e filtros você utilizou; isso ajuda a replicar o problema.</div>'
            },
            account: {
                change_email: '<div class="font-medium text-indigo-600 dark:text-indigo-400 mb-2">Mudar e-mail</div><div class="text-sm text-gray-700 dark:text-gray-300">Você pode alterar no perfil. Se não conseguir, escalaremos para verificação manual.</div>',
                reset_password: '<div class="font-medium text-indigo-600 dark:text-indigo-400 mb-2">Redefinir senha</div><div class="text-sm text-gray-700 dark:text-gray-300">Clique em "Esqueci minha senha" e siga o e-mail. Se não chegar, verifique spam.</div>',
                delete_account: '<div class="font-medium text-indigo-600 dark:text-indigo-400 mb-2">Excluir conta</div><div class="text-sm text-gray-700 dark:text-gray-300">Envie confirmação por e-mail. Atenção: exclusão é irreversível.</div>'
            },
            other: {
                custom: `<div class="font-medium text-indigo-600 dark:text-indigo-400 mb-2">Recebemos sua descrição</div><div class="text-sm text-gray-700 dark:text-gray-300 mb-2">${escapeHtml(label)}</div><div class="text-xs text-gray-500">Se precisar de mais ajuda, clique em "Falar com humano".</div>`
            }
        };

        return responses[topic]?.[choice] ||
            'Não tenho solução rápida para isso. Por favor, fale com um atendente.';
    }

    function escapeHtml(unsafe) {
        return unsafe
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    confirmBtn.addEventListener('click', () => {
        if (!confirmBtn.dataset.selected) return;
        const sel = JSON.parse(confirmBtn.dataset.selected);

        const userMsg = document.createElement('div');
        userMsg.className = 'flex justify-end';
        userMsg.innerHTML = `
            <div class="bg-indigo-600 rounded-2xl rounded-tr-none p-4 max-w-[85%] md:max-w-[80%]">
                <div class="font-medium text-indigo-200 text-sm mb-1">Você</div>
                <div class="text-white text-sm">${sel.label}</div>
            </div>
        `;
        followup.appendChild(userMsg);

        const assistantMsg = document.createElement('div');
        assistantMsg.className = 'flex justify-start';
        assistantMsg.innerHTML = `
            <div class="bg-white dark:bg-[#161B22] rounded-2xl rounded-tl-none p-4 max-w-[85%] md:max-w-[80%]">
                <div class="font-medium text-indigo-600 dark:text-indigo-400 text-sm mb-1">Assistente</div>
                <div class="text-gray-700 dark:text-gray-300 text-sm">${generateTechReply(sel)}</div>
            </div>
        `;
        followup.appendChild(assistantMsg);

        confirmBtn.disabled = true;
        notice.textContent = 'Se precisar de ajuda humana, clique em "Falar com humano".';

        followup.scrollTop = followup.scrollHeight;
    });

    humanBtn.addEventListener('click', () => {
        humanBtn.disabled = true;
        humanBtn.innerHTML = '<i class="fas fa-check mr-2"></i> Email copiado!';
        humanBtn.classList.remove('bg-gray-300', 'dark:bg-gray-700', 'hover:bg-gray-400', 'dark:hover:bg-gray-600');
        humanBtn.classList.add('bg-green-600', 'cursor-default', 'text-white');

        const successMsg = document.createElement('div');
        successMsg.className = 'flex justify-start';
        successMsg.innerHTML = `
            <div class="bg-green-600 rounded-2xl rounded-tl-none p-4 max-w-[85%] md:max-w-[80%]">
                <div class="font-medium text-green-200 text-sm mb-1">Suporte Indo Ali</div>
                <div class="text-white text-sm">
                    Para falar com nosso atendimento humano, por favor envie um email para:
                    <div class="text-xs font-mono bg-black bg-opacity-30 p-2 rounded mt-1 text-center">12400629@aluno.cotemig.com.br</div>
                    <div class="text-xs mt-2">Nossa equipe responderá em até 24 horas úteis.</div>
                </div>
            </div>
        `;

        followup.appendChild(successMsg);

        // Copiar email para área de transferência
        navigator.clipboard.writeText('12400629@aluno.cotemig.com.br').then(() => {
            notice.textContent = 'Email copiado para sua área de transferência!';
        }).catch(err => {
            notice.textContent = 'Email: 12400629@aluno.cotemig.com.br';
            console.log('Falha ao copiar email: ', err);
        });

        followup.scrollTop = followup.scrollHeight;
    });

    let startY = 0;
    modal.addEventListener('touchstart', (e) => {
        startY = e.touches[0].clientY;
    }, {
        passive: true
    });

    modal.addEventListener('touchmove', (e) => {
        const currentY = e.touches[0].clientY;
        const diff = currentY - startY;
        if (diff > 50) {
            closeChat();
        }
    }, {
        passive: true
    });
});
</script>
</footer>