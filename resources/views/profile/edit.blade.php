<x-guest-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <i class="fas fa-user-circle text-blue-400 mr-3"></i>
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Perfil') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Informações do Perfil -->
            <section class="p-4 sm:p-8 bg-[#161B22] shadow-lg sm:rounded-xl border border-gray-800">
                <div class="max-w-xl">
                    <header class="flex items-center mb-6">
                        <i class="fas fa-user-edit text-blue-400 mr-3 text-xl"></i>
                        <h3 class="text-lg font-bold text-white">{{ __('Informações do Perfil') }}</h3>
                    </header>

                    <!-- Gerenciamento do Avatar -->
                    <div class="mb-6">
                        <x-input-label :value="__('Foto de Perfil')" class="text-gray-300 mb-2" />
                        <div class="flex items-start space-x-4">
                            <div class="flex flex-col items-center">
                                @if($user->avatar || $user->provider_avatar)
                                <img src="{{ $user->avatar ? asset('img/avatars/' . $user->avatar) : $user->provider_avatar }}"
                                    alt="Avatar"
                                    class="w-16 h-16 rounded-full object-cover border-2 border-gray-600 mb-2">

                                <!-- Remover avatar -->
                                <form method="POST" action="{{ route('profile.avatar.remove') }}">
                                    @csrf
                                    @method('POST')
                                    <button type="submit"
                                        class="text-xs text-red-400 hover:text-red-300 transition-colors px-2 py-1 bg-red-900/20 rounded"
                                        onclick="return confirm('Tem certeza que deseja remover sua foto de perfil?')">
                                        <i class="fas fa-trash mr-1"></i> Remover foto
                                    </button>
                                </form>
                                @else
                                <div
                                    class="w-16 h-16 rounded-full bg-gray-700 flex items-center justify-center border-2 border-gray-600 mb-2">
                                    <i class="fas fa-user text-gray-400 text-xl"></i>
                                </div>
                                @endif
                            </div>

                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2">
                                    <input id="avatar" name="avatar" type="file" class="block w-full text-sm text-gray-400
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-full file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-blue-600 file:text-white
                                        hover:file:bg-blue-700
                                        bg-[#0D1117] rounded-lg">

                                    <!-- Botão aplicar avatar -->
                                    <button type="button" id="apply-avatar-btn"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium opacity-50 cursor-not-allowed"
                                        disabled>
                                        <i class="fas fa-check mr-1"></i> Aplicar
                                    </button>
                                </div>

                                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />

                                @if($user->avatar)
                                <p class="text-xs text-green-400 mt-1">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Avatar personalizado
                                </p>
                                @elseif($user->provider_avatar)
                                <p class="text-xs text-gray-400 mt-1">
                                    <i class="fab fa-{{ strtolower($user->provider_name) }} mr-1"></i>
                                    Avatar do {{ $user->provider_name }}
                                </p>
                                @endif

                                <!-- Preview do avatar -->
                                <div id="avatar-preview" class="mt-3 hidden">
                                    <p class="text-sm text-gray-300 mb-1">Pré-visualização:</p>
                                    <img id="avatar-preview-img"
                                        class="w-12 h-12 rounded-full border border-blue-400 object-cover">
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
                            <x-input-label for="name" :value="__('Nome')" class="text-gray-300" />
                            <x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" required
                                autofocus class="w-full bg-[#0D1117] border-gray-700 mt-1" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
                            <x-text-input id="email" name="email" type="email" :value="old('email', $user->email)"
                                required class="w-full bg-[#0D1117] border-gray-700 mt-1" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button class="bg-blue-600 hover:bg-blue-700">
                                {{ __('Salvar') }}
                            </x-primary-button>

                            @if (session('status') === 'profile-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition
                                x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-400">
                                {{ __('Salvo com sucesso.') }}
                            </p>
                            @endif

                            @if (session('status') === 'avatar-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition
                                x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-400">
                                {{ __('Foto de perfil atualizada com sucesso.') }}
                            </p>
                            @endif

                            @if (session('status') === 'avatar-removed')
                            <p x-data="{ show: true }" x-show="show" x-transition
                                x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-400">
                                {{ __('Foto de perfil removida com sucesso.') }}
                            </p>
                            @endif
                        </div>
                    </form>
                </div>
            </section>

            <!-- Atualização de Senha -->
            <section class="p-4 sm:p-8 bg-[#161B22] shadow-lg sm:rounded-xl border border-gray-800">
                <div class="max-w-xl">
                    <header class="flex items-center mb-6">
                        <i class="fas fa-lock text-blue-400 mr-3 text-xl"></i>
                        <h3 class="text-lg font-bold text-white">{{ __('Atualizar Senha') }}</h3>
                    </header>

                    <form id="password-form" method="post" action="{{ route('password.update') }}" class="space-y-6">
                        @csrf
                        @method('put')

                        <div>
                            <x-input-label for="current_password" :value="__('Senha Atual')" class="text-gray-300" />
                            <x-text-input id="current_password" name="current_password" type="password" required
                                class="w-full bg-[#0D1117] border-gray-700 mt-1" />
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="password" :value="__('Nova Senha')" class="text-gray-300" />
                            <x-text-input id="password" name="password" type="password" required
                                class="w-full bg-[#0D1117] border-gray-700 mt-1" />
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirmar Nova Senha')"
                                class="text-gray-300" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                required class="w-full bg-[#0D1117] border-gray-700 mt-1" />
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')"
                                class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button class="bg-blue-600 hover:bg-blue-700">
                                {{ __('Atualizar Senha') }}
                            </x-primary-button>

                            @if (session('status') === 'password-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition
                                x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-400">
                                {{ __('Senha atualizada com sucesso.') }}
                            </p>
                            @endif
                        </div>
                    </form>
                </div>
            </section>

            <!-- Exclusão de Conta -->
            <section class="p-4 sm:p-8 bg-[#161B22] shadow-lg sm:rounded-xl border border-gray-800">
                <div class="max-w-xl">
                    <header class="flex items-center mb-6">
                        <i class="fas fa-exclamation-triangle text-red-400 mr-3 text-xl"></i>
                        <h3 class="text-lg font-bold text-white">{{ __('Deletar Conta') }}</h3>
                    </header>

                    <p class="text-gray-400 mb-6">
                        {{ __('Uma vez que sua conta for deletada, todos os seus recursos e dados serão permanentemente apagados. Antes de deletar sua conta, por favor baixe qualquer informação que você deseja manter.') }}
                    </p>

                    <form id="delete-account-form" method="post" action="{{ route('profile.destroy') }}"
                        class="space-y-6">
                        @csrf
                        @method('delete')

                        <div>
                            <x-input-label for="password" :value="__('Confirme sua senha para deletar a conta')"
                                class="text-gray-300" />
                            <x-text-input id="password" name="password" type="password" required
                                class="w-full bg-[#0D1117] border-gray-700 mt-1" />
                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                        </div>

                        <div class="flex justify-end">
                            <x-danger-button x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                                class="bg-red-600 hover:bg-red-700">
                                {{ __('Deletar Conta') }}
                            </x-danger-button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <!-- Modal de Confirmação de Exclusão -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="p-6 bg-[#161B22] text-white">
            <h2 class="text-lg font-bold mb-4">{{ __('Tem certeza que deseja deletar sua conta?') }}</h2>
            <p class="text-gray-400 mb-6">
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
    });
    </script>
</x-guest-layout>