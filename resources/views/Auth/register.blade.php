<x-auth-layout
    authTitle="Seu próximo destino começa aqui"
    authMessage="Crie sua conta e descubra lugares que combinam com o seu jeito de viver."
>
    <h2 class="text-gray-600 dark:text-gray-400 font-medium text-sm md:text-base">COMECE DE GRAÇA</h2>
    <h3 class="text-gray-900 dark:text-white font-medium text-xl md:text-2xl lg:text-3xl">Criar Nova Conta</h3>

    <div class="flex flex-col mt-4 mb-4 md:mt-6 md:mb-6">
        <a class="text-sm text-gray-600 dark:text-gray-400 max-w-max md:text-base" href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-gray-700 dark:text-gray-300" />
            <x-text-input id="name" class="block mt-1 w-full md:mt-2 bg-white dark:bg-[#0D1117] border-gray-300 dark:border-gray-700 text-black dark:text-white" 
                         type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4 md:mt-6">
            <x-input-label for="email" :value="__('Email')" class="text-gray-700 dark:text-gray-300" />
            <x-text-input id="email" class="block mt-1 w-full md:mt-2 bg-white dark:bg-[#0D1117] border-gray-300 dark:border-gray-700 text-black dark:text-white" 
                         type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 md:mt-6">
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300" />

            <x-text-input id="password" class="block mt-1 w-full md:mt-2 bg-white dark:bg-[#0D1117] border-gray-300 dark:border-gray-700 text-black dark:text-white"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

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

        <x-terms-consent />

        <div class="mt-8 flex justify-center md:mt-10">
            <x-primary-button class="justify-center md:px-8 md:py-3 md:text-lg bg-blue-600 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <div class="flex items-center justify-center mt-8 md:mt-10">
            <div class="flex-grow border-t border-gray-300 dark:border-gray-700"></div>
            <span class="mx-4 text-gray-700 dark:text-gray-300 font-normal text-sm md:text-base">Ou entrar com</span>
            <div class="flex-grow border-t border-gray-300 dark:border-gray-700"></div>
        </div>

        <div class="flex gap-4 justify-center mt-8 md:mt-10 md:gap-6">
            <!-- Google -->
            <a href="auth/google/redirect" class="flex items-center justify-center gap-2 w-[140px] h-[48px] bg-white text-[#3C4043] font-medium rounded-lg shadow hover:bg-gray-100 transition md:w-[160px] md:h-[52px] border border-gray-300 dark:border-gray-600">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-5 h-5 md:w-6 md:h-6">
                Google
            </a>

            <!-- Facebook -->
            <a href="auth/facebook/redirect" class="flex items-center justify-center gap-2 w-[140px] h-[48px] bg-blue-500 text-white font-medium rounded-lg shadow hover:bg-[#0e63d4] transition md:w-[160px] md:h-[52px]">
                <img src="https://www.svgrepo.com/show/452196/facebook-1.svg" alt="Facebook" class="w-5 h-5 md:w-6 md:h-6">
                Facebook
            </a>
        </div>
    </form>

</x-auth-layout>