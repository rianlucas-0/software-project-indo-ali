<section>
    <header>
        <div class="flex items-center mb-4">
            <i class="fas fa-lock text-blue-500 dark:text-blue-400 mr-3 text-xl"></i>
            <h2 class="text-lg font-medium text-gray-900 dark:text-white">
                {{ __('Atualizar Senha') }}
            </h2>
        </div>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Use uma senha longa e aleatória para manter sua conta segura.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Senha Atual')" class="text-gray-700 dark:text-gray-300" />
            <div class="relative mt-1">
                <x-text-input 
                    id="update_password_current_password" 
                    name="current_password" 
                    type="password" 
                    class="block w-full bg-white dark:bg-[#1E2229] border-gray-300 dark:border-gray-700 text-black dark:text-white focus:border-blue-500 focus:ring-blue-500 dark:focus:border-blue-400 pl-10"
                    autocomplete="current-password" 
                />
                <i class="fas fa-key absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-400"></i>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Nova Senha')" class="text-gray-700 dark:text-gray-300" />
            <div class="relative mt-1">
                <x-text-input 
                    id="update_password_password" 
                    name="password" 
                    type="password" 
                    class="block w-full bg-white dark:bg-[#1E2229] border-gray-300 dark:border-gray-700 text-black dark:text-white focus:border-blue-500 focus:ring-blue-500 dark:focus:border-blue-400 pl-10"
                    autocomplete="new-password" 
                />
                <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-400"></i>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmar Senha')" class="text-gray-700 dark:text-gray-300" />
            <div class="relative mt-1">
                <x-text-input 
                    id="update_password_password_confirmation" 
                    name="password_confirmation" 
                    type="password" 
                    class="block w-full bg-white dark:bg-[#1E2229] border-gray-300 dark:border-gray-700 text-black dark:text-white focus:border-blue-500 focus:ring-blue-500 dark:focus:border-blue-400 pl-10"
                    autocomplete="new-password" 
                />
                <i class="fas fa-lock-open absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-400"></i>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800">
                <i class="fas fa-save mr-2"></i>{{ __('Salvar') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400"
                >
                    <i class="fas fa-check-circle mr-1"></i>{{ __('Senha atualizada!') }}
                </p>
            @endif
        </div>
    </form>
</section>