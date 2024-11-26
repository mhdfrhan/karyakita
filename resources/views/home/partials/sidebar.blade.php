<aside class="w-[18rem] h-svh bg-indigo-500 hidden xl:block fixed top-0 left-0 bottom-0 z-50 ">
    <!-- Logo -->
    <div class="shrink-0 flex items-center p-5">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/img/logo-white.png') }}" class="h-10"
                alt="{{ config('app.name', 'Laravel') }} Logo">
        </a>
    </div>

    <div class="h-[calc(100vh-5rem)] overflow-y-auto">
        <ul class="flex flex-col p-5 pt-2 space-y-1.5">
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
                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="16" />
                                    <circle cx="180" cy="132" r="12" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-indigo-100 leading-none">Saldo kamu</p>
                                <h6 class="text-lg text-white font-medium">Rp. 0</h6>
                            </div>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </div>
                    </div>
                </a>
            </div>

            <div class="text-indigo-200 pt-4">
                <p>Main menu</p>
            </div>

            <li>
                <x-nav-link class="inline-flex gap-3" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                    </svg>

                    {{ __('Dashboard') }}
                </x-nav-link>
            </li>
            <li>
                <div x-data="{ isExpanded: {{ request()->is('dashboard/produk*') ? 'true' : 'false' }} }" class="flex flex-col">
                    <button type="button" x-on:click="isExpanded = ! isExpanded" id="products-btn"
                        aria-controls="products" x-bind:aria-expanded="isExpanded ? 'true' : 'false'"
                        class="inline-flex items-center py-2.5 px-3 rounded-xl font-medium leading-5 gap-3 w-full focus:outline-none transition duration-150 ease-in-out"
                        x-bind:class="isExpanded ? 'text-black bg-white shadow-lg shadow-white/30' :
                            ' text-indigo-100 hover:bg-indigo-600 hover:text-white'">
                        <svg class="size-6 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                            <rect width="256" height="256" fill="none" />
                            <line x1="128" y1="129.09" x2="128" y2="231.97" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="16" />
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

            <li>
                <div x-data="{ isExpanded: {{ request()->is('dashboard/jasa*') ? 'true' : 'false' }} }" class="flex flex-col">
                    <button type="button" x-on:click="isExpanded = ! isExpanded" id="jasa-btn"
                        aria-controls="jasa" x-bind:aria-expanded="isExpanded ? 'true' : 'false'"
                        class="inline-flex items-center py-2.5 px-3 rounded-xl font-medium leading-5 gap-3 w-full focus:outline-none transition duration-150 ease-in-out"
                        x-bind:class="isExpanded ? 'text-black bg-white shadow-lg shadow-white/30' :
                            ' text-indigo-100 hover:bg-indigo-600 hover:text-white'">
                        <svg class="size-6 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                            <rect width="256" height="256" fill="none" />
                            <polyline points="200 152 160 192 96 176 40 136" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                            <polyline points="72.68 70.63 128 56 183.32 70.63" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                            <path
                                d="M34.37,60.42,8.85,111.48a8,8,0,0,0,3.57,10.73L40,136,72.68,70.63,45.11,56.85A8,8,0,0,0,34.37,60.42Z"
                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="16" />
                            <path
                                d="M216,136l27.58-13.79a8,8,0,0,0,3.57-10.73L221.63,60.42a8,8,0,0,0-10.74-3.57L183.32,70.63Z"
                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="16" />
                            <path
                                d="M184,72H144L98.34,116.29a8,8,0,0,0,1.38,12.42C117.23,139.9,141,139.13,160,120l40,32,16-16"
                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="16" />
                            <polyline points="124.06 216 82.34 205.57 56 186.75" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        </svg>
                        <span class="mr-auto text-left">Jasa Kamu</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            class="size-5 transition-transform shrink-0"
                            x-bind:class="isExpanded ? 'rotate-180' : 'rotate-0'" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <ul x-cloak x-collapse x-show="isExpanded" aria-labelledby="jasa-btn" id="jasa">
                        <li class="px-1 py-0.5 first:mt-2">
                            <a href="{{ route('dashboard.jasa') }}"
                                class="flex items-center rounded-lg gap-2 px-4 py-1.5 text-indigo-100 focus:outline-none duration-150 {{ request()->routeIs('dashboard.jasa') ? 'bg-indigo-600/60 text-white' : 'hover:bg-indigo-600/60 hover:text-white' }}">
                                Semua Jasa</a>
                        </li>
                        <li class="px-1 py-0.5 first:mt-2">
                            <a href="{{ route('tambahJasa') }}"
                                class="flex items-center rounded-lg gap-2 px-4 py-1.5 text-indigo-100 focus:outline-none duration-150 {{ request()->routeIs('tambahJasa') ? 'bg-indigo-600/60 text-white' : 'hover:bg-indigo-600/60 hover:text-white' }}">
                                Tambah Jasa</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <x-nav-link class="inline-flex gap-3" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.242 5.992h12m-12 6.003H20.24m-12 5.999h12M4.117 7.495v-3.75H2.99m1.125 3.75H2.99m1.125 0H5.24m-1.92 2.577a1.125 1.125 0 1 1 1.591 1.59l-1.83 1.83h2.16M2.99 15.745h1.125a1.125 1.125 0 0 1 0 2.25H3.74m0-.002h.375a1.125 1.125 0 0 1 0 2.25H2.99" />
                    </svg>

                    {{ __('Penjualan') }}
                </x-nav-link>
            </li>

            <li>
                <x-nav-link class="inline-flex gap-3" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                    </svg>

                    {{ __('Chat') }}
                </x-nav-link>
            </li>

            <div class="text-indigo-200 pb-0">
                <p>Informasi Saldo</p>
            </div>
            <li>
                <x-nav-link class="inline-flex gap-3" :href="route('mutasiSaldo')" :active="request()->routeIs('mutasiSaldo')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>

                    {{ __('Mutasi Saldo') }}
                </x-nav-link>
            </li>
            <li>
                <x-nav-link class="inline-flex gap-3" :href="route('penarikanSaldo')" :active="request()->routeIs('penarikanSaldo')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                    </svg>

                    {{ __('Penarikan Saldo') }}
                </x-nav-link>
            </li>

            <div class="text-indigo-200 pb-0">
                <p>Profil Saya</p>
            </div>
            <li>
                <x-nav-link class="inline-flex gap-3" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                    </svg>

                    {{ __('Profil Toko') }}
                </x-nav-link>
            </li>
            <li>
                <x-nav-link class="inline-flex gap-3" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                    {{ __('Profil Saya') }}
                </x-nav-link>
            </li>
        </ul>
    </div>
</aside>
