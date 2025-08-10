<x-guest-layout>
    @props(['authTitle' => null, 'authMessage' => null, 'authImage' => null])

    <main class="min-h-screen">
        <div class="md:grid md:grid-cols-2 md:min-h-[calc(100vh-73px)]">
            <div class="hidden md:flex bg-gradient-to-br from-[#0D1117] to-[#161B22] items-center justify-center p-12 border-r border-gray-800">
                <div class="max-w-md mx-auto text-center">
                    <h1 class="text-4xl font-bold text-white mb-6">
                        {{ $authTitle ?? 'Bem-vindo' }}
                    </h1>
                    <p class="text-xl text-gray-300 mb-10">
                        {{ $authMessage ?? 'Acesse sua conta para continuar' }}
                    </p>
                    @isset($authImage)
                        {{ $authImage }}
                    @else
                        <img src="https://placehold.co/500x300/161B22/3B82F6?text=Indo+Ali" alt="Ilustração" class="rounded-xl shadow-2xl mx-auto">
                    @endisset
                </div>
            </div>

            <div class="p-5 md:px-12 md:flex md:items-center md:justify-center">
                <div class="w-full max-w-md md:py-12">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </main>
</x-guest-layout>