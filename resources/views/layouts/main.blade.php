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
            <nav aria-label="Breadcrumb">
                <ol class="flex items-center space-x-4">
                    <li class="text-neutral-500 flex items-center">
                        <a href="{{ url('/') }}"
                            class="text-neutral-500 hover:text-neutral-900 capitalize">Home</a>
                    </li>
                    @foreach (request()->segments() as $index => $segment)
                        <li class="text-neutral-500 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" class="w-4 h-4 mr-2">
                                <rect width="256" height="256" fill="none" />
                                <polyline points="96 48 176 128 96 208" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="22" />
                            </svg>
                            <a href="{{ url()->current() }}"
                                class="{{ $loop->iteration == $loop->count ? 'text-black font-semibold' : 'text-neutral-500' }} hover:text-neutral-900 capitalize">
                                {{ str_replace('-', ' ', $segment) }}
                            </a>
                        </li>
                    @endforeach
                </ol>
            </nav>
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
