<x-guest-layout>
    <body class="bg-[#0D1117] font-sans text-gray-600">
        <!-- Featured Locations -->
        <div class="container mx-auto px-4">
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 md:gap-6">
        <!-- All Cards -->
        @foreach ($local as $locations)
        <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg hover:-translate-y-1 transition flex flex-col">
            <div class="aspect-square overflow-hidden">

                <img src="img/{{ $locations->firstImage }}" alt="Local 1" class="w-full h-full object-cover hover:scale-105 transition duration-500">
            </div>
            <div class="p-4 flex flex-col justify-between flex-1">
                <h3 class="text-lg font-bold mb-1">{{$locations->title}}</h3>
                <p class="text-sm text-gray-500 mb-1">{{$locations->city}} - {{$locations->state}}</p>
                <div class="flex text-yellow-400 text-sm mb-2">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                    <i class="far fa-star"></i>
                </div>
                <a href="{{ route('localfull', $locations->id) }}" class="text-indigo-600 text-sm font-semibold hover:underline mt-auto">Ver mais →</a>
            </div>
        </div>
        @endforeach
    </div>
</div>

    </body>
</x-guest-layout>