<nav class="fixed bottom-0 left-0 right-0 z-40 bg-[#0D1117] border-t border-gray-700 flex justify-around py-2 text-white md:hidden">
    <a href="{{ route('home') }}" class="flex flex-col items-center text-sm hover:text-blue-500 transition-colors">
        <i class="fas fa-home-alt text-lg mb-1"></i>
        Início
    </a>

    <a href="#" class="flex flex-col items-center text-sm hover:text-blue-500 transition-colors">
        <i class="fas fa-search text-lg mb-1"></i>
        Buscar
    </a>

    @auth
    <a href="#" class="flex flex-col items-center text-sm hover:text-blue-500 transition-colors">
        <i class="fas fa-heart text-lg mb-1"></i>
        Favoritos
    </a>
    @endauth

    @guest
    <a href="{{ route('login') }}" class="flex flex-col items-center text-sm hover:text-blue-500 transition-colors">
        <i class="fas fa-cog text-lg mb-1"></i>
        Opções
    </a>
    @else
    <a href="#" class="flex flex-col items-center text-sm hover:text-blue-500 transition-colors">
        <i class="fas fa-cog text-lg mb-1"></i>
        Opções
    </a>
    @endguest
</nav>