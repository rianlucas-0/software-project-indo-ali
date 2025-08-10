<x-auth-layout
    authTitle="Seu próximo destino começa aqui"
    authMessage="Crie sua conta e descubra lugares que combinam com o seu jeito de viver."
>
    <h2 class="text-gray-400 font-medium text-sm md:text-base">COMECE DE GRAÇA</h2>
    <h3 class="text-white font-medium text-xl md:text-2xl lg:text-3xl">Criar Nova Conta</h3>

            <div class="fflex flex-col mt-4 mb-4 md:mt-6 md:mb-6">
            <a class="text-sm text-gray-400 max-w-max md:text-base" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full md:mt-2" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4 md:mt-6">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full md:mt-2" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 md:mt-6">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full md:mt-2"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4 md:mt-6">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full md:mt-2"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Mudar para aceitar os termos -->
        <div class="block mt-4 md:mt-6">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded focus:ring-0 focus:ring-offset-0" name="remember">
                <span class="ms-2 text-sm text-gray-400 md:text-base">Eu concordo e aceito com os <span class="text-blue-500">termos de uso</span></span>
            </label>
        </div>

        <div class="mt-8 flex justify-center md:mt-10">
            <x-primary-button class="justify-center md:px-8 md:py-3 md:text-lg">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <div class="flex items-center justify-center mt-8 md:mt-10">
            <div class="flex-grow border-t border-gray-800"></div>
            <span class="mx-4 text-white font-normal text-sm md:text-base">Ou entrar com</span>
            <div class="flex-grow border-t border-gray-800"></div>
        </div>

        <div class="flex gap-4 justify-center mt-8 md:mt-10 md:gap-6">
            <!-- Google -->
            <a href="auth/google/redirect" class="flex items-center justify-center gap-2 w-[140px] h-[48px] bg-white text-[#3C4043] font-medium rounded-lg shadow hover:bg-gray-100 transition md:w-[160px] md:h-[52px]">
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