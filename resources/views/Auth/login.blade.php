<x-guest-layout>
    <h2 class="text-gray-400 font-medium text-sm">HORA DE IR MAIS LONGE</h2>
    <h3 class="text-white font-medium text-xl">Login</h3>

        <div class="flex flex-col mt-4 mb-4">
            @if (Route::has('register'))
                <a
                    href="{{ route('register') }}"
                    class="text-sm text-gray-400 max-w-max">
                    Não tem uma conta? <span class="text-blue-500">Criar conta</span>
                </a>
            @endif
        </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded focus:ring-0 focus:ring-offset-0" name="remember">
                <span class="ms-2 text-sm text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex flex-col mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-400 max-w-max" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="mt-8 flex justify-center">
            <x-primary-button class="justify-center">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="flex items-center justify-center mt-8">
            <div class="flex-grow border-t border-gray-800"></div>
            <span class="mx-4 text-white font-normal text-sm">Ou entrar com</span>
            <div class="flex-grow border-t border-gray-800"></div>
        </div>

        <div class="flex gap-4 justify-center mt-8">
            <!-- Google -->
            <a href="auth/google/redirect" class="flex items-center justify-center gap-2 w-[140px] h-[48px] bg-white text-[#3C4043] font-medium rounded-lg shadow hover:bg-gray-100 transition">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-5 h-5">
                Google
            </a>

            <!-- Facebook -->
            <a href="auth/facebook/redirect" class="flex items-center justify-center gap-2 w-[140px] h-[48px] bg-blue-500 text-white font-medium rounded-lg shadow hover:bg-[#0e63d4] transition">
                <img src="https://www.svgrepo.com/show/452196/facebook-1.svg" alt="Facebook" class="w-5 h-5">
                Facebook
            </a>
        </div>
    </form>

</x-guest-layout>
