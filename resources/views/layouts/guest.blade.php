<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Indo Ali') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <header class="fixed top-0 left-0 right-0 z-50 bg-[#0D1117] shadow-md">
            <h1 class="text-white text-4xl font-semibold py-4 px-6">
                Indo Ali
            </h1>
            <div class="w-full border-t border-gray-600"></div>
        </header>

        <main class="pt-24 min-h-screen bg-[#0D1117] p-6">
            <div class="w-full">
                {{ $slot }}
            </div>
        </main>
    </body>
</html>
