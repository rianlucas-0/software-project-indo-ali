<x-auth-layout 
    authTitle="Vamos te colocar de volta no caminho"
    authMessage="Informe seu e-mail para enviarmos o link de redefinição e você voltar a explorar sem parar."
>
    <h2 class="text-gray-400 font-medium text-sm">VAMOS TE AJUDAR A VOLTAR AO CAMINHO</h2>
    <h3 class="text-white font-medium text-xl">Redefinição de Senha</h3>

    <div class="mb-4 mt-4 text-sm text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex justify-center mt-4">
            <x-primary-button class="justify-center">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>

</x-auth-layout>
