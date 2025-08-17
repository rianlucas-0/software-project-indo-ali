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
            <!-- Seção de Informações do Perfil -->
            <section class="p-4 sm:p-8 bg-[#161B22] shadow-lg sm:rounded-xl border border-gray-800">
                <div class="max-w-xl">
                    <header class="flex items-center mb-6">
                        <i class="fas fa-user-edit text-blue-400 mr-3 text-xl"></i>
                        <h3 class="text-lg font-bold text-white">{{ __('Informações do Perfil') }}</h3>
                    </header>

                    <form id="profile-info-form" method="post" action="{{ route('profile.update') }}" class="space-y-6">
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
                        </div>
                    </form>
                </div>
            </section>

            <!-- Seção de Atualização de Senha -->
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

            <!-- Seção de Exclusão de Conta -->
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

    <!-- Modal de Confirmação -->
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
</x-guest-layout>