<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0 px-5 bg-white">
            {{-- <div>
                <a href="/" wire:navigate>
                    <img src="{{ asset('assets/img/logo.png') }}" alt="{{ config('app.name', 'Laravel') }} Logo" class="h-20 mb-6 mx-auto">
                </a>
            </div> --}}
            
            <div class="w-full {{ request()->routeIs('login') ? 'sm:max-w-lg' : 'sm:max-w-2xl' }} mt-6 px-8 py-6  shadow-xl shadow-neutral-200 overflow-hidden rounded-xl">
                {{ $slot }}
            </div>
        </div>

        @include('components.alert')
    </body>
</html>