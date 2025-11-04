<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-white">
            {{ __('Informações do Perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Atualize as informações do seu perfil e endereço de e-mail.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nome')" class="text-gray-700 dark:text-gray-300" />
            <x-text-input id="name" name="name" type="text"
                class="mt-1 block w-full bg-white dark:bg-[#1E2229] border-gray-300 dark:border-gray-700 text-black dark:text-white focus:border-blue-500 focus:ring-blue-500 dark:focus:border-blue-400"
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-700 dark:text-gray-300" />
            <x-text-input id="email" name="email" type="email"
                class="mt-1 block w-full bg-white dark:bg-[#1E2229] border-gray-300 dark:border-gray-700 text-black dark:text-white focus:border-blue-500 focus:ring-blue-500 dark:focus:border-blue-400"
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-4 p-3 bg-gray-50 dark:bg-[#1E2229] rounded-lg border border-gray-300 dark:border-gray-700">
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    {{ __('Seu e-mail não está verificado.') }}

                    <button form="send-verification"
                        class="underline text-sm text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 rounded-md focus:outline-none">
                        {{ __('Clique aqui para reenviar o e-mail de verificação.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                    <i class="fas fa-check-circle mr-1"></i>
                    {{ __('Um novo link de verificação foi enviado para seu e-mail.') }}
                </p>
                @endif
            </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800">
                <i class="fas fa-save mr-2"></i>{{ __('Salvar') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-green-600 dark:text-green-400">
                <i class="fas fa-check-circle mr-1"></i>{{ __('Salvo.') }}
            </p>
            @endif
        </div>
    </form>
</section>