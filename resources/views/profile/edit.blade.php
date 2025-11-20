<x-guest-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <i class="fas fa-user-circle text-blue-500 dark:text-blue-400 mr-3"></i>
            <h2 class="font-semibold text-xl text-gray-900 dark:text-white leading-tight">
                {{ __('Perfil') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Informações do Perfil -->
            <section class="p-4 sm:p-8 bg-white dark:bg-[#161B22] shadow-lg sm:rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="max-w-xl">
                    <header class="flex items-center mb-6">
                        <i class="fas fa-user-edit text-blue-500 dark:text-blue-400 mr-3 text-xl"></i>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ __('Informações do Perfil') }}</h3>
                    </header>

                    <!-- Gerenciamento do Avatar -->
                    <div class="mb-6">
                        <x-input-label :value="__('Foto de Perfil')" class="text-gray-700 dark:text-gray-300 mb-2" />
                        <div class="flex items-start space-x-4">
                            <div class="flex flex-col items-center">
                                @if($user->avatar || $user->provider_avatar)
                                <img src="{{ $user->avatar ? asset('img/avatars/' . $user->avatar) : $user->provider_avatar }}"
                                    alt="Avatar"
                                    class="w-16 h-16 rounded-full object-cover border-2 border-gray-300 dark:border-gray-600 mb-2">

                                <!-- Remover avatar -->
                                <form method="POST" action="{{ route('profile.avatar.remove') }}">
                                    @csrf
                                    @method('POST')
                                    <button type="submit"
                                        class="text-xs text-red-600 dark:text-red-400 hover:text-red-500 dark:hover:text-red-300 transition-colors px-2 py-1 bg-red-100 dark:bg-red-900/20 rounded"
                                        onclick="return confirm('Tem certeza que deseja remover sua foto de perfil?')">
                                        <i class="fas fa-trash mr-1"></i> Remover foto
                                    </button>
                                </form>
                                @else
                                <div
                                    class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center border-2 border-gray-300 dark:border-gray-600 mb-2">
                                    <i class="fas fa-user text-gray-500 dark:text-gray-400 text-xl"></i>
                                </div>
                                @endif
                            </div>

                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2">
                                    <input id="avatar" name="avatar" type="file" class="block w-full text-sm text-gray-600 dark:text-gray-400
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-full file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-blue-600 file:text-white
                                        hover:file:bg-blue-700
                                        bg-white dark:bg-[#0D1117] rounded-lg border border-gray-300 dark:border-gray-700">

                                    <!-- Botão aplicar avatar -->
                                    <button type="button" id="apply-avatar-btn"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium opacity-50 cursor-not-allowed"
                                        disabled>
                                        <i class="fas fa-check mr-1"></i> Aplicar
                                    </button>
                                </div>

                                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />

                                @if($user->avatar)
                                <p class="text-xs text-green-600 dark:text-green-400 mt-1">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Avatar personalizado
                                </p>
                                @elseif($user->provider_avatar)
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                                    <i class="fab fa-{{ strtolower($user->provider_name) }} mr-1"></i>
                                    Avatar do {{ $user->provider_name }}
                                </p>
                                @endif

                                <!-- Preview do avatar -->
                                <div id="avatar-preview" class="mt-3 hidden">
                                    <p class="text-sm text-gray-700 dark:text-gray-300 mb-1">Pré-visualização:</p>
                                    <img id="avatar-preview-img"
                                        class="w-12 h-12 rounded-full border border-blue-500 dark:border-blue-400 object-cover">
                                </div>
                            </div>
                        </div>

                        <!-- Formulário oculto para atualização de avatar -->
                        <form id="avatar-form" method="POST" action="{{ route('profile.avatar.update') }}"
                            enctype="multipart/form-data" class="hidden">
                            @csrf
                            @method('PATCH')
                            <input type="file" name="avatar" id="avatar-hidden">
                        </form>
                    </div>

                    <!-- Formulário de atualização de informações básicas -->
                    <form id="profile-info-form" method="post" action="{{ route('profile.update') }}" class="space-y-6"
                        enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div>
                            <x-input-label for="name" :value="__('Nome')" class="text-gray-700 dark:text-gray-300" />
                            <x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" required
                                autofocus class="w-full bg-white dark:bg-[#0D1117] border-gray-300 dark:border-gray-700 text-black dark:text-white mt-1" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" class="text-gray-700 dark:text-gray-300" />
                            <x-text-input id="email" name="email" type="email" :value="old('email', $user->email)"
                                required class="w-full bg-white dark:bg-[#0D1117] border-gray-300 dark:border-gray-700 text-black dark:text-white mt-1" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700">
                                {{ __('Salvar') }}
                            </x-primary-button>

                            @if (session('status') === 'profile-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition
                                x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 dark:text-green-400">
                                {{ __('Salvo com sucesso.') }}
                            </p>
                            @endif

                            @if (session('status') === 'avatar-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition
                                x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 dark:text-green-400">
                                {{ __('Foto de perfil atualizada com sucesso.') }}
                            </p>
                            @endif

                            @if (session('status') === 'avatar-removed')
                            <p x-data="{ show: true }" x-show="show" x-transition
                                x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 dark:text-green-400">
                                {{ __('Foto de perfil removida com sucesso.') }}
                            </p>
                            @endif
                        </div>
                    </form>
                </div>
            </section>

            <!-- Atualização de Senha -->
            <section class="p-4 sm:p-8 bg-white dark:bg-[#161B22] shadow-lg sm:rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="max-w-xl">
                    <header class="flex items-center mb-6">
                        <i class="fas fa-lock text-blue-500 dark:text-blue-400 mr-3 text-xl"></i>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ __('Atualizar Senha') }}</h3>
                    </header>

                    <form id="password-form" method="post" action="{{ route('password.update') }}" class="space-y-6">
                        @csrf
                        @method('put')

                        @if($user->password)
                        <div>
                            <x-input-label for="current_password" :value="__('Senha Atual')" class="text-gray-700 dark:text-gray-300" />
                            <x-text-input id="current_password" name="current_password" type="password" required
                                class="w-full bg-white dark:bg-[#0D1117] border-gray-300 dark:border-gray-700 text-black dark:text-white mt-1" />
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </div>
                        @else
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4 mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-triangle text-yellow-600 dark:text-yellow-400 mr-2"></i>
                                <p class="text-yellow-700 dark:text-yellow-300 text-sm">
                                    {{ __('Sua conta foi criada com login social. Para definir uma senha, preencha os campos abaixo.') }}
                                </p>
                            </div>
                        </div>
                        @endif

                        <div>
                            <x-input-label for="password" :value="__('Nova Senha')" class="text-gray-700 dark:text-gray-300" />
                            <x-text-input id="password" name="password" type="password" required
                                class="w-full bg-white dark:bg-[#0D1117] border-gray-300 dark:border-gray-700 text-black dark:text-white mt-1" />
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirmar Nova Senha')"
                                class="text-gray-700 dark:text-gray-300" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                required class="w-full bg-white dark:bg-[#0D1117] border-gray-300 dark:border-gray-700 text-black dark:text-white mt-1" />
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')"
                                class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700">
                                {{ $user->password ? __('Atualizar Senha') : __('Definir Senha') }}
                            </x-primary-button>

                            @if (session('status') === 'password-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition
                                x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 dark:text-green-400">
                                {{ __('Senha atualizada com sucesso.') }}
                            </p>
                            @endif

                            @if (session('status') === 'password-set')
                            <p x-data="{ show: true }" x-show="show" x-transition
                                x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 dark:text-green-400">
                                {{ __('Senha definida com sucesso.') }}
                            </p>
                            @endif
                        </div>
                    </form>
                </div>
            </section>

            <!-- Exclusão de Conta -->
            <section class="p-4 sm:p-8 bg-white dark:bg-[#161B22] shadow-lg sm:rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="max-w-xl">
                    <header class="flex items-center mb-6">
                        <i class="fas fa-exclamation-triangle text-red-500 dark:text-red-400 mr-3 text-xl"></i>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ __('Deletar Conta') }}</h3>
                    </header>

                    <p class="text-gray-600 dark:text-gray-400 mb-6">
                        {{ __('Uma vez que sua conta for deletada, todos os seus recursos e dados serão permanentemente apagados. Antes de deletar sua conta, por favor baixe qualquer informação que você deseja manter.') }}
                    </p>

                    @if(!$user->password)
                    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-600 dark:text-red-400 mr-2"></i>
                            <p class="text-red-700 dark:text-red-300 text-sm">
                                {{ __('Para deletar sua conta, primeiro você precisa definir uma senha na seção "Atualizar Senha" acima.') }}
                            </p>
                        </div>
                    </div>
                    @endif

                    @if($user->password)
                    <form id="delete-account-form" method="post" action="{{ route('profile.destroy') }}"
                        class="space-y-6">
                        @csrf
                        @method('delete')

                        <div>
                            <x-input-label for="delete_password" :value="__('Confirme sua senha para deletar a conta')"
                                class="text-gray-700 dark:text-gray-300" />
                            <x-text-input id="delete_password" name="password" type="password" required
                                class="w-full bg-white dark:bg-[#0D1117] border-gray-300 dark:border-gray-700 text-black dark:text-white mt-1" />
                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                        </div>

                        <div class="flex justify-end">
                            <x-danger-button x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                                class="bg-red-600 hover:bg-red-700 dark:bg-red-600 dark:hover:bg-red-700">
                                {{ __('Deletar Conta') }}
                            </x-danger-button>
                        </div>
                    </form>
                    @else
                    <div class="flex justify-end">
                        <button type="button" 
                            class="px-4 py-2 bg-gray-400 dark:bg-gray-600 text-white rounded-lg cursor-not-allowed opacity-50"
                            disabled>
                            {{ __('Deletar Conta') }}
                        </button>
                    </div>
                    @endif
                </div>
            </section>
        </div>
    </div>

    <!-- Modal de Confirmação de Exclusão -->
    @if($user->password)
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="p-6 bg-white dark:bg-[#161B22] text-gray-900 dark:text-white">
            <h2 class="text-lg font-bold mb-4">{{ __('Tem certeza que deseja deletar sua conta?') }}</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-6">
                {{ __('Uma vez que sua conta for deletada, todos os seus recursos e dados serão permanentemente apagados. Por favor, digite sua senha para confirmar que deseja deletar permanentemente sua conta.') }}
            </p>

            <div class="mt-6 flex justify-end gap-4">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button form="delete-account-form">
                    {{ __('Deletar Conta') }}
                </x-danger-button>
            </div>
        </div>
    </x-modal>
    @endif

    <!-- Script: lógica de pré-visualização e envio do avatar -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const avatarInput = document.getElementById('avatar');
        const applyBtn = document.getElementById('apply-avatar-btn');
        const previewDiv = document.getElementById('avatar-preview');
        const previewImg = document.getElementById('avatar-preview-img');
        const hiddenInput = document.getElementById('avatar-hidden');
        const avatarForm = document.getElementById('avatar-form');

        // Ativa o botão e exibe a prévia ao selecionar um arquivo
        avatarInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                applyBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                applyBtn.classList.add('cursor-pointer', 'hover:bg-blue-700');
                applyBtn.disabled = false;

                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewDiv.classList.remove('hidden');
                }
                reader.readAsDataURL(this.files[0]);
            } else {
                applyBtn.classList.add('opacity-50', 'cursor-not-allowed');
                applyBtn.classList.remove('cursor-pointer', 'hover:bg-blue-700');
                applyBtn.disabled = true;
                previewDiv.classList.add('hidden');
            }
        });

        // Aplica o avatar selecionado
        applyBtn.addEventListener('click', function() {
            const fileInput = document.getElementById('avatar');

            if (fileInput.files.length === 0) {
                alert('Por favor, selecione uma imagem primeiro.');
                return;
            }

            if (confirm('Deseja aplicar esta imagem como sua foto de perfil?')) {
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(fileInput.files[0]);
                hiddenInput.files = dataTransfer.files;
                avatarForm.submit();
            }
        });

        @if(!$user->password)
        document.addEventListener('click', function(e) {
            if (e.target.closest('[x-on\\:click*="confirm-user-deletion"]')) {
                e.preventDefault();
                alert('Para deletar sua conta, primeiro você precisa definir uma senha na seção "Atualizar Senha".');
            }
        });
        @endif
    });
    </script>
</x-guest-layout>