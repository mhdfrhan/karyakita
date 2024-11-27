<nav class="w-full bg-white py-5 relative z-[100] {{ request()->routeIs('dashboard') ? 'border-b' : '' }}"
    x-data="{
        open: window.innerWidth >= 1024,
        init() {
            window.addEventListener('resize', () => {
                this.open = window.innerWidth >= 1024;
            })
        }
    }">
    <div class="max-w-7xl mx-auto px-5">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="lg:mr-8">
                    {{-- logo --}}
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/img/logo.png') }}" class="h-10"
                            alt="{{ config('app.name', 'Laravel') }} Logo">
                    </a>
                </div>

                <ul x-cloak x-show="open" x-show="open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-4"
                    class="lg:relative inline-flex lg:items-center absolute top-full lg:top-auto lg:left-auto lg:right-auto bg-white left-0 right-0 py-6 lg:py-0 flex-col lg:flex-row z-50">

                    <li class="max-w-7xl mx-auto px-5 lg:px-0 lg:mx-0 lg:max-w-max">
                        <a href="{{ route('home') }}"
                            class="flex items-center justify-between {{ request()->routeIs('home') ? 'text-indigo-500 font-medium' : 'text-neutral-500' }} py-2 hover:bg-neutral-300/30 hover:px-3 hover:lg:px-4 lg:px-4 duration-300 rounded-lg active:lg:scale-90">
                            <div>
                                Beranda
                            </div>
                            <svg class="size-4 lg:hidden fill-neutral-500" xmlns="http://www.w3.org/2000/svg"
                                width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                                <path
                                    d="M200,64V168a8,8,0,0,1-16,0V83.31L69.66,197.66a8,8,0,0,1-11.32-11.32L172.69,72H88a8,8,0,0,1,0-16H192A8,8,0,0,1,200,64Z">
                                </path>
                            </svg>
                        </a>
                    </li>
                    @if (!request()->routeIs('dashboard'))
                        <li class="max-w-7xl mx-auto px-5 lg:px-0 lg:mx-0 lg:max-w-max">
                            <a href="{{ route('semua-produk') }}"
                                class="flex items-center justify-between {{ request()->routeIs('semua-produk') ? 'text-indigo-500 font-medium' : 'text-neutral-500' }} py-2 hover:bg-neutral-300/30 hover:px-3 hover:lg:px-4 lg:px-4 duration-300 rounded-lg active:lg:scale-90">
                                <div>
                                    Jelajahi Produk
                                </div>
                                <svg class="size-4 lg:hidden fill-neutral-500" xmlns="http://www.w3.org/2000/svg"
                                    width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                                    <path
                                        d="M200,64V168a8,8,0,0,1-16,0V83.31L69.66,197.66a8,8,0,0,1-11.32-11.32L172.69,72H88a8,8,0,0,1,0-16H192A8,8,0,0,1,200,64Z">
                                    </path>
                                </svg>
                            </a>
                        </li>
                    @endif

                    @if (request()->routeIs('dashboard'))
                        <li class="max-w-7xl mx-auto px-5 lg:px-0 lg:mx-0 lg:max-w-max">
                            <a href="{{ route('dashboard') }}"
                                class="flex items-center justify-between {{ request()->routeIs('dashboard') ? 'text-indigo-500 font-medium' : 'text-neutral-500' }} py-2 hover:bg-neutral-300/30 hover:px-3 hover:lg:px-4 lg:px-4 duration-300 rounded-lg active:lg:scale-90">
                                <div>
                                    Dashboard
                                </div>
                                <svg class="size-4 lg:hidden fill-neutral-500" xmlns="http://www.w3.org/2000/svg"
                                    width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                                    <path
                                        d="M200,64V168a8,8,0,0,1-16,0V83.31L69.66,197.66a8,8,0,0,1-11.32-11.32L172.69,72H88a8,8,0,0,1,0-16H192A8,8,0,0,1,200,64Z">
                                    </path>
                                </svg>
                            </a>
                        </li>
                    @endif

                    <li
                        class="lg:px-0 lg:mx-0 lg:max-w-max mt-4 border-t border-neutral-200 pt-4 lg:border-0 lg:pt-0 lg:mt-0">
                        <div class="max-w-7xl mx-auto px-5 ">
                            @php
                                $shop = null;
                                if (auth()->check()) {
                                    $shop = \App\Models\Shops::where('user_id', auth()->user()->id)->first();
                                }
                            @endphp
                            <a
                                href="{{ $shop ? route('dashboard') : (auth()->check() ? route('daftarToko') : route('login')) }}">
                                <x-primary-button
                                    class="inline-flex lg:hidden items-center gap-2 w-full justify-center text-sm">
                                    <svg class="size-4 fill-white" xmlns="http://www.w3.org/2000/svg" width="32"
                                        height="32" fill="#000000" viewBox="0 0 256 256">
                                        <path
                                            d="M232,96a7.89,7.89,0,0,0-.3-2.2L217.35,43.6A16.07,16.07,0,0,0,202,32H54A16.07,16.07,0,0,0,38.65,43.6L24.31,93.8A7.89,7.89,0,0,0,24,96h0v16a40,40,0,0,0,16,32v72a8,8,0,0,0,8,8H208a8,8,0,0,0,8-8V144a40,40,0,0,0,16-32V96ZM54,48H202l11.42,40H42.61Zm50,56h48v8a24,24,0,0,1-48,0Zm-16,0v8a24,24,0,0,1-35.12,21.26,7.88,7.88,0,0,0-1.82-1.06A24,24,0,0,1,40,112v-8ZM200,208H56V151.2a40.57,40.57,0,0,0,8,.8,40,40,0,0,0,32-16,40,40,0,0,0,64,0,40,40,0,0,0,32,16,40.57,40.57,0,0,0,8-.8Zm4.93-75.8a8.08,8.08,0,0,0-1.8,1.05A24,24,0,0,1,168,112v-8h48v8A24,24,0,0,1,204.93,132.2Z">
                                        </path>
                                    </svg>
                                    {{ $shop ? 'Kelola Toko' : 'Jadi Penjual' }}
                                </x-primary-button>
                            </a>
                        </div>
                    </li>

                </ul>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-4 border-r pr-3 border-neutral-300">
                    {{-- search --}}
                    <div class="relative" x-data="{ open: false }" @keydown.escape.window="open = false">
                        <button @click="open = !open">
                            <svg class="size-6 fill-neutral-500 hover:fill-indigo-500"
                                xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000"
                                viewBox="0 0 256 256">
                                <path
                                    d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z">
                                </path>
                            </svg>
                        </button>

                        {{-- backdrop --}}
                        <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="fixed inset-0 z-[200] bg-black/80 backdrop-blur-sm transition-opacity duration-300"
                            @click="open = false">
                        </div>

                        {{-- search panel --}}
                        <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-out duration-150"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="fixed z-[201] inset-0 flex items-center justify-center" x-trap.inert.noscroll="open">
                            <div class="bg-neutral-50 p-6 rounded-2xl w-full max-w-2xl mx-4">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-lg font-medium">Pencarian</h2>
                                    <button @click="open = false"
                                        class="text-neutral-800/60 hover:text-neutral-800 w-8 h-8 flex items-center justify-center rounded-full duration-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="relative">
                                    <x-text-input wire:model="search" autofocus />
                                    <button class="absolute right-3 top-1/2 -translate-y-1/2">
                                        <svg class="size-5 fill-neutral-500 hover:fill-indigo-500"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                            <path
                                                d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <livewire:home.components.produk-favorit>

                        <livewire:home.components.keranjang>

                </div>
                <div class="flex items-center gap-4">
                    <a
                        href="{{ $shop ? route('dashboard') : (auth()->check() ? route('daftarToko') : route('login')) }}">
                        <x-primary-button class="hidden lg:inline-flex items-center gap-2">
                            <svg class="size-5 fill-white" xmlns="http://www.w3.org/2000/svg" width="32"
                                height="32" fill="#000000" viewBox="0 0 256 256">
                                <path
                                    d="M232,96a7.89,7.89,0,0,0-.3-2.2L217.35,43.6A16.07,16.07,0,0,0,202,32H54A16.07,16.07,0,0,0,38.65,43.6L24.31,93.8A7.89,7.89,0,0,0,24,96h0v16a40,40,0,0,0,16,32v72a8,8,0,0,0,8,8H208a8,8,0,0,0,8-8V144a40,40,0,0,0,16-32V96ZM54,48H202l11.42,40H42.61Zm50,56h48v8a24,24,0,0,1-48,0Zm-16,0v8a24,24,0,0,1-35.12,21.26,7.88,7.88,0,0,0-1.82-1.06A24,24,0,0,1,40,112v-8ZM200,208H56V151.2a40.57,40.57,0,0,0,8,.8,40,40,0,0,0,32-16,40,40,0,0,0,64,0,40,40,0,0,0,32,16,40.57,40.57,0,0,0,8-.8Zm4.93-75.8a8.08,8.08,0,0,0-1.8,1.05A24,24,0,0,1,168,112v-8h48v8A24,24,0,0,1,204.93,132.2Z">
                                </path>
                            </svg>
                            {{ $shop ? 'Kelola Toko' : 'Jadi Penjual' }}
                        </x-primary-button>
                    </a>

                    <x-dropdown align="right" width="56">
                        <x-slot name="trigger">
                            <button>
                                <svg class="size-6 fill-neutral-500 hover:fill-indigo-500"
                                    xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000"
                                    viewBox="0 0 256 256">
                                    <path
                                        d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24ZM74.08,197.5a64,64,0,0,1,107.84,0,87.83,87.83,0,0,1-107.84,0ZM96,120a32,32,0,1,1,32,32A32,32,0,0,1,96,120Zm97.76,66.41a79.66,79.66,0,0,0-36.06-28.75,48,48,0,1,0-59.4,0,79.66,79.66,0,0,0-36.06,28.75,88,88,0,1,1,131.52,0Z">
                                    </path>
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div
                                class="flex items-center gap-2 border-b mb-2 pb-4 pt-2 border-neutral-200 overflow-hidden">
                                <div class="bg-neutral-200 rounded-full inline-flex shrink-0 w-12 h-12 ">
                                    @if (auth()->check())
                                        @if (auth()->user()->profile_image)
                                            <img src="{{ asset(auth()->user()->profile_image) }}"
                                                class="rounded-full" alt="Profile Image">
                                        @else
                                            @if (auth()->user()->gender == 'male')
                                                <img src="{{ asset('assets/img/default-person.webp') }}"
                                                    class="rounded-full" alt="Profile Image">
                                            @else
                                                <img src="{{ asset('assets/img/default-person-female.webp') }}"
                                                    class="rounded-full" alt="Profile Image">
                                            @endif
                                        @endif
                                    @else
                                        <img src="{{ asset('assets/img/default-person.webp') }}" class="rounded-full"
                                            alt="Profile Image">
                                    @endif
                                </div>
                                <div>
                                    @if (auth()->check())
                                        <p class="text-orange/80 text-sm">{{ auth()->user()->name }}</p>
                                        <p class="text-sm text-neutral-500 max-w-full text-wrap">
                                            {{ auth()->user()->email }}
                                        </p>
                                    @else
                                        <p class="text-orange/80 text-sm">Belum terdaftar</p>
                                        <p class="text-xs text-neutral-500 text-pretty">Kamu belum terdaftar nih,
                                            daftar dulu yuk
                                        </p>
                                    @endif

                                </div>
                            </div>
                            <div>
                                @if (auth()->check())
                                    <x-dropdown-link :href="route('home.dashboard', auth()->user()->username)" class="inline-flex items-center gap-3">
                                        <svg class="size-5 fill-neutral-500" xmlns="http://www.w3.org/2000/svg"
                                            width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                                            <path
                                                d="M100,116.43a8,8,0,0,0,4-6.93v-72A8,8,0,0,0,93.34,30,104.06,104.06,0,0,0,25.73,147a8,8,0,0,0,4.52,5.81,7.86,7.86,0,0,0,3.35.74,8,8,0,0,0,4-1.07ZM88,49.62v55.26L40.12,132.51C40,131,40,129.48,40,128A88.12,88.12,0,0,1,88,49.62ZM128,24a8,8,0,0,0-8,8v91.82L41.19,169.73a8,8,0,0,0-2.87,11A104,104,0,1,0,128,24Zm0,192a88.47,88.47,0,0,1-71.49-36.68l75.52-44a8,8,0,0,0,4-6.92V40.36A88,88,0,0,1,128,216Z">
                                            </path>
                                        </svg>
                                        {{ __('Dashboard') }}
                                    </x-dropdown-link>
                                    <livewire:logout>
                                    @else
                                        <x-dropdown-link :href="route('login')" class="inline-flex items-center gap-3">
                                            <svg class="size-5 fill-neutral-500" xmlns="http://www.w3.org/2000/svg"
                                                width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                                                <path
                                                    d="M141.66,133.66l-40,40a8,8,0,0,1-11.32-11.32L116.69,136H24a8,8,0,0,1,0-16h92.69L90.34,93.66a8,8,0,0,1,11.32-11.32l40,40A8,8,0,0,1,141.66,133.66ZM200,32H136a8,8,0,0,0,0,16h56V208H136a8,8,0,0,0,0,16h64a8,8,0,0,0,8-8V40A8,8,0,0,0,200,32Z">
                                                </path>
                                            </svg>
                                            {{ __('Login') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('register')" class="inline-flex items-center gap-3">
                                            <svg class="size-5 fill-neutral-500" xmlns="http://www.w3.org/2000/svg"
                                                width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                                                <path
                                                    d="M229.66,58.34l-32-32a8,8,0,0,0-11.32,0l-96,96A8,8,0,0,0,88,128v32a8,8,0,0,0,8,8h32a8,8,0,0,0,5.66-2.34l96-96A8,8,0,0,0,229.66,58.34ZM124.69,152H104V131.31l64-64L188.69,88ZM200,76.69,179.31,56,192,43.31,212.69,64ZM224,128v80a16,16,0,0,1-16,16H48a16,16,0,0,1-16-16V48A16,16,0,0,1,48,32h80a8,8,0,0,1,0,16H48V208H208V128a8,8,0,0,1,16,0Z">
                                                </path>
                                            </svg>
                                            {{ __('Register') }}
                                        </x-dropdown-link>
                                @endif
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
                <div class="lg:hidden">
                    <button @click="open = !open"
                        class="active:scale-90 duration-300  w-9 h-9 flex items-center justify-center bg-neutral-300/60 rounded-md">
                        <svg class="size-5 fill-neutral-700" xmlns="http://www.w3.org/2000/svg" width="32"
                            height="32" fill="#000000" viewBox="0 0 256 256">
                            <path
                                d="M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128ZM40,72H216a8,8,0,0,0,0-16H40a8,8,0,0,0,0,16ZM216,184H40a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

        </div>
    </div>
</nav>

@if (!request()->routeIs('dashboard'))
    <nav class="bg-white backdrop-blur-sm py-3 z-[99] transition-all duration-300 ease-in-out lg:sticky top-0 left-0 right-0"
        :class="{
            'lg:translate-y-6 lg:!w-auto lg:mx-auto lg:max-w-min lg:rounded-full lg:border lg:border-neutral-200 lg:px-4 lg:bg-white/90': isScrolled,
            'w-full border-y border-neutral-200/70': !isScrolled
        }"
        x-data="{
            isScrolled: false,
            init() {
                window.addEventListener('scroll', () => {
                    this.isScrolled = window.scrollY > 130;
                })
            }
        }">
        <div class="max-w-7xl mx-auto px-5">
            @php
                $kategori = App\Models\Categories::all();
            @endphp
            <div class="overflow-x-auto">
                <ul class="flex flex-nowrap min-w-max items-center gap-4 transition-transform duration-300"
                    :class="{ 'scale-100': isScrolled }">
                    {{-- kategori --}}
                    @foreach ($kategori as $k)
                        <li>
                            <a href="{{ route('detailKategori', $k->slug) }}"
                                class="text-sm transition-colors duration-200 text-neutral-500">
                                <span>{{ $k->name }}</span>
                            </a>
                        </li>
                    @endforeach
                    <li>
                        <a href="{{ route('detailKategori', 'jasa-profesional') }}"
                            class="text-sm transition-colors duration-200 text-neutral-500">
                            <span>Jasa Profesional</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endif
