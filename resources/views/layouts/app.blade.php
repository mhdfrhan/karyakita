<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} | {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="font-sans antialiased bg-indigo-500">
    <div class="min-h-screen p-2">
        <livewire:layout.navigation />
        @include('home.partials.sidebar')

        <main class="bg-neutral-50 shadow shadow-neutral-300 min-h-screen xl:ml-[18rem] rounded-3xl m-2">
            @if (request()->routeIs('dashboard'))
                <div class="border-b border-neutral-300 p-4 sm:px-6 flex items-center justify-between gap-3">
                    <div>
                        @php
                            $shop = \App\Models\Shops::where('user_id', Auth::user()->id)
                                ->pluck('name')
                                ->first();
                        @endphp
                        <h3 class="text-xl font-bold capitalize leading-none">Halo, {{ $shop }}!</h3>
                        <p class="text-neutral-500">Disinilah tempat kamu mengelola jasa dan produk digital kamu</p>
                    </div>

                    <div class="flex items-center gap-3">
                        <p class="text-neutral-600 font-medium">{{ \Carbon\Carbon::now()->format('d M Y') }}</p>
                        <div class="flex items-center justify-center w-9 h-9 rounded-full bg-neutral-200/80">
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none" />
                                <rect x="40" y="40" width="176" height="176" rx="8" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <line x1="176" y1="24" x2="176" y2="56" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <line x1="80" y1="24" x2="80" y2="56" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <line x1="40" y1="88" x2="216" y2="88" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <circle cx="128" cy="132" r="12" />
                                <circle cx="172" cy="132" r="12" />
                                <circle cx="84" cy="172" r="12" />
                                <circle cx="128" cy="172" r="12" />
                                <circle cx="172" cy="172" r="12" />
                            </svg>
                        </div>
                    </div>
                </div>
            @else
                <div class="border-b border-neutral-300 p-4 sm:px-6 flex items-center print:hidden">
                    <button onclick="history.back()" class="border-r border-neutral-300 mr-4 pr-4">
                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                            <rect width="256" height="256" fill="none" />
                            <line x1="216" y1="128" x2="40" y2="128" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="16" />
                            <polyline points="112 56 40 128 112 200" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="24" />
                        </svg>
                    </button>

                    {{-- breadcrumb --}}
                    <nav aria-label="Breadcrumb">
                        <ol class="flex items-center space-x-4">
                            @foreach (request()->segments() as $index => $segment)
                                @if (request()->routeIs('editJasa') && $index == count(request()->segments()) - 1)
                                    @continue
                                @endif
                                <li class="text-neutral-500 flex items-center">
                                    @if ($index > 0)
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"
                                            class="w-4 h-4 mr-2">
                                            <rect width="256" height="256" fill="none" />
                                            <polyline points="96 48 176 128 96 208" fill="none"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="22" />
                                        </svg>
                                    @endif
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
            <div class="p-4 sm:p-6 lg:p-8">
                {{ $slot }}
            </div>
        </main>
    </div>

    @stack('scripts')
</body>

</html>
