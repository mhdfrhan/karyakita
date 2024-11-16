<aside class="w-[18rem] h-screen bg-indigo-500 hidden xl:block fixed top-0 left-0 bottom-0 z-50 ">
    <!-- Logo -->
    <div class="shrink-0 flex items-center p-5">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/img/logo-white.png') }}" class="h-10"
                alt="{{ config('app.name', 'Laravel') }} Logo">
        </a>
    </div>
    <div class="p-5 text-indigo-200 pb-0">
        <p>Main menu</p>
    </div>
    <ul class="flex flex-col p-5 pt-2 space-y-3 min-h-screen">
        <li>
            <x-nav-link class="inline-flex gap-3" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                </svg>

                {{ __('Dashboard') }}
            </x-nav-link>
        </li>
        <li>
            <div x-data="{ isExpanded: {{ request()->is('dashboard/produk*') ? 'true' : 'false' }} }" class="flex flex-col">
                <button type="button" x-on:click="isExpanded = ! isExpanded" id="products-btn" aria-controls="products"
                    x-bind:aria-expanded="isExpanded ? 'true' : 'false'"
                    class="inline-flex items-center py-2.5 px-3 rounded-xl font-medium leading-5 gap-3 w-full focus:outline-none transition duration-150 ease-in-out"
                    x-bind:class="isExpanded ? 'text-black bg-white shadow-lg shadow-white/30' :
                        ' text-indigo-100 hover:bg-indigo-600 hover:text-white'">
                    <svg class="size-6 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <line x1="128" y1="129.09" x2="128" y2="231.97" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <polyline points="32.7 76.92 128 129.08 223.3 76.92" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <path
                            d="M219.84,182.84l-88,48.18a8,8,0,0,1-7.68,0l-88-48.18a8,8,0,0,1-4.16-7V80.18a8,8,0,0,1,4.16-7l88-48.18a8,8,0,0,1,7.68,0l88,48.18a8,8,0,0,1,4.16,7v95.64A8,8,0,0,1,219.84,182.84Z"
                            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="16" />
                        <polyline points="81.56 48.31 176 100 176 152" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    </svg>
                    <span class="mr-auto text-left">Produk</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="size-5 transition-transform shrink-0"
                        x-bind:class="isExpanded ? 'rotate-180' : 'rotate-0'" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <ul x-cloak x-collapse x-show="isExpanded" aria-labelledby="products-btn" id="products">
                    <li class="px-1 py-0.5 first:mt-2">
                        <a href="{{ route('dashboard.produk') }}"
                            class="flex items-center rounded-lg gap-2 px-4 py-1.5 text-indigo-100 focus:outline-none duration-150 {{ request()->routeIs('dashboard.produk') ? 'bg-indigo-600/60 text-white' : 'hover:bg-indigo-600/60 hover:text-white' }}">
                            Semua Produk</a>
                    </li>
                    <li class="px-1 py-0.5 first:mt-2">
                        <a href="{{ route('tambahProduk') }}"
                            class="flex items-center rounded-lg gap-2 px-4 py-1.5 text-indigo-100 focus:outline-none duration-150 {{ request()->routeIs('tambahProduk') ? 'bg-indigo-600/60 text-white' : 'hover:bg-indigo-600/60 hover:text-white' }}">
                            Tambah Produk</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
    <div class="absolute bottom-0 w-full p-5">
        <div class="bg-indigo-400 text-white p-4 rounded-xl">
            @php
                $shop = \App\Models\Shops::where('user_id', Auth::user()->id)
                    ->pluck('name')
                    ->first();
            @endphp
            <h5 class="font-medium line-clamp-2 capitalize">Halo, {{ $shop }}</h5>
            <a href="" class="block mt-2 bg-indigo-600/80 p-3 rounded-lg">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center size-11 bg-indigo-500 rounded-md shrink-0">
                            <svg class="size-7 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none" />
                                <path
                                    d="M40,56V184a16,16,0,0,0,16,16H216a8,8,0,0,0,8-8V80a8,8,0,0,0-8-8H56A16,16,0,0,1,40,56h0A16,16,0,0,1,56,40H192"
                                    fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <circle cx="180" cy="132" r="12" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-indigo-100 leading-none">Saldo kamu</p>
                            <h6 class="text-lg text-white font-medium">Rp. 0</h6>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>
                </div>
            </a>
        </div>
    </div>
</aside>
