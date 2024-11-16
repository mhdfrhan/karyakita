<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} | {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.cdnfonts.com/css/helvetica-neue-5" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://unpkg.com/kursor/dist/kursor.css"> --}}

    <link rel="shortcut icon" href="{{ asset('assets/img/logo-white.png') }}" type="image/x-icon">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
    @livewireStyles
</head>

<body class="font-sans antialiased">
    @include('home.partials.navbar')


    {{-- breadcrumb --}}
    @if (!request()->routeIs('home'))
        <div class="max-w-7xl mx-auto px-5 pt-6 pb-10">
            <div class="inline-flex items-center gap-3">
                <p><a href="{{ route('home') }}" class="hover:underline text-neutral-600">Home</a></p>
                <p>/</p>
                <p class="font-medium">{{ $title }}</p>
            </div>
        </div>
    @endif


    <main>
        {{ $slot }}
    </main>


    {{-- @include('home.partials.footer') --}}

    @stack('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/kursor"></script>
    <script>
        new kursor({
            type: 1,
            removeDefaultCursor: true,
            color: '#6366f1'
        })
    </script> --}}
    @livewireScripts
</body>

</html>
