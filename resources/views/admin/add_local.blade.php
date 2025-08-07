<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(Auth::check() && Auth::user()->user_type == 'admin')
            {{ __('Admin Dashboard') }}
            @else
            {{ __('Admin Dashboard') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Adicionar novo local</h2>
                @if(session('status'))
                    <div class="bg-green-400 alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            <form action="{{route('admin.createlocal')}}" method="post" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                    <input type="text" name="title" id="title" placeholder="Ex: Restaurante da Maria" class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                    <textarea name="description" id="description" rows="4" placeholder="Fale um pouco sobre o local..." class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Imagem</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-700">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="cep" class="block text-sm font-medium text-gray-700">CEP</label>
                        <input type="text" name="cep" id="cep" placeholder="Ex: 30140-071" class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm">
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Rua</label>
                        <input type="text" name="address" id="address" class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm">
                    </div>

                    <div>
                        <label for="neighborhood" class="block text-sm font-medium text-gray-700">Bairro</label>
                        <input type="text" name="neighborhood" id="neighborhood" class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm">
                    </div>

                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700">Cidade</label>
                        <input type="text" name="city" id="city" class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm">
                    </div>

                    <div>
                        <label for="state" class="block text-sm font-medium text-gray-700">Estado</label>
                        <input type="text" name="state" id="state" class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Telefone</label>
                        <input type="text" name="phone" id="phone" class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="contact_email" class="block text-sm font-medium text-gray-700">Email de contato</label>
                        <input type="text" name="contact_email" id="contact_email" class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm">
                    </div>
                </div>

                <div class="pt-4">
                    <input type="submit" value="Adicionar local" class="w-full sm:w-auto px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow-sm transition duration-200 cursor-pointer">
                </div>
            </form>
        </div>
    </div>
</div>

</x-app-layout>