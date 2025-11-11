<x-auth-layout
    authTitle="Vamos te colocar de volta no caminho"
    authMessage="Digite sua nova senha para continuar sua jornada sem interrupções."
>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-700 dark:text-gray-300" />
            <x-text-input id="email" class="block mt-1 w-full md:mt-2 bg-white dark:bg-[#0D1117] border-gray-300 dark:border-gray-700 text-black dark:text-white" 
                         type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 md:mt-6">
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300" />
            <x-text-input id="password" class="block mt-1 w-full md:mt-2 bg-white dark:bg-[#0D1117] border-gray-300 dark:border-gray-700 text-black dark:text-white" 
                         type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4 md:mt-6">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 dark:text-gray-300" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full md:mt-2 bg-white dark:bg-[#0D1117] border-gray-300 dark:border-gray-700 text-black dark:text-white"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4 md:mt-6">
            <x-primary-button class="md:px-6 md:py-2.5 md:text-base bg-blue-600 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700">
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-auth-layout>