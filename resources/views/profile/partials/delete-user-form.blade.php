<section class="space-y-6">
    <header>
        <div class="flex items-center">
            <i class="fas fa-exclamation-triangle text-red-500 dark:text-red-400 mr-3 text-xl"></i>
            <h2 class="text-lg font-medium text-gray-900 dark:text-white">
                {{ __('Excluir Conta') }}
            </h2>
        </div>

        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Após a exclusão, todos os dados serão permanentemente removidos. Recomendamos fazer backup das informações importantes antes de continuar.') }}
        </p>
    </header>

    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600 hover:bg-red-700 dark:bg-red-600 dark:hover:bg-red-700 focus:bg-red-700 active:bg-red-800">
        <i class="fas fa-trash-alt mr-2"></i>{{ __('Excluir Conta') }}
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}"
            class="p-6 bg-white dark:bg-[#161B22] border border-gray-300 dark:border-gray-700 rounded-lg">
            @csrf
            @method('delete')

            <div class="flex items-start">
                <i class="fas fa-exclamation-circle text-red-500 dark:text-red-400 mr-3 text-xl mt-1"></i>
                <div>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">
                        {{ __('Tem certeza que deseja excluir sua conta?') }}
                    </h2>

                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Esta ação não pode ser desfeita. Todos os dados serão permanentemente removidos. Digite sua senha para confirmar.') }}
                    </p>
                </div>
            </div>

            <div class="mt-6">
                <div class="relative">
                    <x-text-input id="password" name="password" type="password"
                        class="block w-full bg-white dark:bg-[#1E2229] border-gray-300 dark:border-gray-700 text-black dark:text-white focus:border-red-500 focus:ring-red-500 dark:focus:border-red-400 pl-10"
                        placeholder="{{ __('Digite sua senha') }}" />
                    <i class="fas fa-key absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-400"></i>
                </div>
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-red-600 dark:text-red-400" />
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <x-secondary-button x-on:click="$dispatch('close')"
                    class="bg-gray-600 hover:bg-gray-700 dark:bg-gray-600 dark:hover:bg-gray-700 focus:bg-gray-700">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="bg-red-600 hover:bg-red-700 dark:bg-red-600 dark:hover:bg-red-700 focus:bg-red-700">
                    <i class="fas fa-trash-alt mr-2"></i>{{ __('Excluir Permanentemente') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>