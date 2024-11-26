<x-main-layout>
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    @endpush

    @push('scripts')
        <script src="{{ asset('js/splide.min.js') }}"></script>
        <script
            src="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js">
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                function initSplide(selector, options, extensions = {}) {
                    const element = document.querySelector(selector);
                    if (element) {
                        return new Splide(element, options).mount(extensions);
                    }
                }

                const commonOptions = {
                    type: 'loop',
                    perMove: 1,
                    drag: false,
                    arrows: false,
                    gap: '0',
                    pagination: false,
                    focus: 'center',
                };

                initSplide('#karyakita-slider', {
                    ...commonOptions,
                    perPage: 12,
                    autoScroll: {
                        speed: 0.5,
                        pauseOnHover: false
                    },
                }, window.splide.Extensions);

                initSplide('#believe-slider', {
                    ...commonOptions,
                    perPage: 12,
                    autoScroll: {
                        speed: 0.2,
                        pauseOnHover: false
                    },
                }, window.splide.Extensions);

                initSplide('#testi1-slider', {
                    ...commonOptions,
                    perPage: 5,
                    autoScroll: {
                        speed: 0.2,
                        pauseOnHover: false
                    },
                }, window.splide.Extensions);

                initSplide('#testi2-slider', {
                    ...commonOptions,
                    perPage: 5,
                    autoScroll: {
                        speed: -0.2,
                        pauseOnHover: false
                    },
                }, window.splide.Extensions);

                initSplide('#popular-carousel', {
                    type: 'loop',
                    perPage: 2,
                    perMove: 1,
                    speed: 1000,
                    autoplay: true,
                    breakpoints: {
                        992: {
                            perPage: 2
                        },
                        640: {
                            perPage: 1
                        },
                    },
                });
            });
        </script>
    @endpush

    <x-slot name="title">{{ $title }}</x-slot>

    <section>
        <div class="max-w-7xl mx-auto px-5">
            <div class="flex flex-wrap -mx-5">
                <div class="w-full lg:w-[45%] px-5">
                    <div class="flex flex-col items-stretch h-full pt-12 lg:pt-20 pb-10">
                        <div>
                            <div
                                class="border border-neutral-300 rounded-full text-sm inline-block py-1 px-3 bg-neutral-100 mb-6">
                                Selamat Datang di KaryaKita.
                            </div>
                            <h1 class="text-3xl lg:text-5xl font-bold !leading-tight">Jadikan Karyamu Bermakna, Bersama
                                <span class="text-indigo-500">KaryaKita</span>
                            </h1>
                            <p class="text-neutral-500 2xl:text-lg mt-6">
                                Platform untuk menghubungkan kreator dan inovator dengan orang-orang yang siap
                                menghargai
                                karya
                                mereka.
                            </p>
                            <div class="mt-10">
                                <div class="flex flex-wrap  items-center gap-3">
                                    <a href="">
                                        <x-border-button>
                                            Tentang Kami
                                        </x-border-button>
                                    </a>
                                    <a href="">
                                        <x-primary-button>
                                            Jelajahi Sekarang
                                        </x-primary-button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="mt-8 lg:mt-auto">
                            <div class="flex flex-wrap -mx-4">
                                <div class="w-full sm:w-1/2 px-4 mb-4 lg:mb-0">
                                    <div class="bg-neutral-200/50 py-3 px-6 rounded-2xl flex items-center gap-4">
                                        <div
                                            class="w-11 flex items-center justify-center h-11 bg-indigo-500 rounded-full shrink-0">
                                            <svg class="size-6 fill-white" xmlns="http://www.w3.org/2000/svg"
                                                width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                                                <path
                                                    d="M215.79,118.17a8,8,0,0,0-5-5.66L153.18,90.9l14.66-73.33a8,8,0,0,0-13.69-7l-112,120a8,8,0,0,0,3,13l57.63,21.61L88.16,238.43a8,8,0,0,0,13.69,7l112-120A8,8,0,0,0,215.79,118.17ZM109.37,214l10.47-52.38a8,8,0,0,0-5-9.06L62,132.71l84.62-90.66L136.16,94.43a8,8,0,0,0,5,9.06l52.8,19.8Z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-medium !leading-tight">Produk yang berkualitas</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full sm:w-1/2 px-4">
                                    <div class="bg-neutral-200/50 py-3 px-6 rounded-2xl flex items-center gap-4">
                                        <div
                                            class="w-11 flex items-center justify-center h-11 bg-indigo-500 rounded-full shrink-0">
                                            <svg class="size-6 fill-white" xmlns="http://www.w3.org/2000/svg"
                                                width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                                                <path
                                                    d="M244.24,60a8,8,0,0,0-7.75-.4c-42.93,21-73.59,11.16-106,.78-34-10.89-69.25-22.14-117.95,1.64A8,8,0,0,0,8,69.24V189.17a8,8,0,0,0,11.51,7.19c42.93-21,73.59-11.16,106.05-.78,19.24,6.15,38.84,12.42,61,12.42,17.09,0,35.73-3.72,56.91-14.06a8,8,0,0,0,4.49-7.18V66.83A8,8,0,0,0,244.24,60ZM232,181.67c-40.6,18.17-70.25,8.69-101.56-1.32-19.24-6.15-38.84-12.42-61-12.42a122,122,0,0,0-45.4,9V74.33c40.6-18.17,70.25-8.69,101.56,1.32S189.14,96,232,79.09ZM128,96a32,32,0,1,0,32,32A32,32,0,0,0,128,96Zm0,48a16,16,0,1,1,16-16A16,16,0,0,1,128,144ZM56,96v48a8,8,0,0,1-16,0V96a8,8,0,1,1,16,0Zm144,64V112a8,8,0,1,1,16,0v48a8,8,0,1,1-16,0Z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-medium !leading-tight">Harga yang terjangkau</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-[55%] pl-5 relative hidden lg:block">
                    <div class="max-h-[750px] overflow-hidden relative">
                        <div class="w-full ">
                            <img src="{{ asset('assets/img/banner.png') }}" alt="Banner"
                                class="w-full slider-container min-h-max">
                        </div>
                        <div
                            class="absolute top-0 left-0 right-0 bg-gradient-to-b from-white to-transparent z-10 w-full h-20">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-white to-transparent z-10 w-full h-20">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-1 relative bg-indigo-500 mt-6">
        <div>
            <div>
                <div id="karyakita-slider" class="splide" aria-label="KaryaKita Slider">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <li class="splide__slide">
                                <div
                                    class="text-white font-bold text-2xl uppercase select-none inline-flex items-center">
                                    KARYAKITA
                                    <span class="text-white select-none inline-block mx-3">
                                        <svg class="size-8 fill-white" xmlns="http://www.w3.org/2000/svg" width="32"
                                            height="32" fill="#000000" viewBox="0 0 256 256">
                                            <path
                                                d="M214.86,180.12a8,8,0,0,1-11,2.74L136,142.13V216a8,8,0,0,1-16,0V142.13L52.12,182.86a8,8,0,1,1-8.23-13.72L112.45,128,43.89,86.86a8,8,0,1,1,8.23-13.72L120,113.87V40a8,8,0,0,1,16,0v73.87l67.88-40.73a8,8,0,1,1,8.23,13.72L143.55,128l68.56,41.14A8,8,0,0,1,214.86,180.12Z">
                                            </path>
                                        </svg>
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div
                    class="absolute left-0 bottom-0 top-0 bg-gradient-to-r from-indigo-500 via-indigo-500/70 to-transparent w-20 sm:w-32 lg:w-56 h-full">
                </div>
                <div
                    class="absolute right-0 bottom-0 top-0 bg-gradient-to-l from-indigo-500 via-indigo-500/70 to-transparent w-20 sm:w-32 lg:w-56 h-full">
                </div>
            </div>
        </div>
    </section>

    <section class="py-10 lg:py-20">
        <div class="max-w-7xl px-5 mx-auto">
            <div class="flex flex-wrap -m-8">
                <div class="w-full lg:w-1/2 p-8 flex items-stretch flex-col">
                    <div class="lg:max-w-lg">
                        <h2 class="mb-4 text-3xl lg:text-4xl font-semibold font-heading  -tracking-wide">
                            Tentang KaryaKita.</h2>
                        <p class="text-neutral-500 leading-relaxed">Lorem ipsum dolor, sit amet consectetur adipisicing
                            elit. Repellendus pariatur quae fugit aliquid nobis doloremque vitae aperiam, maiores ipsum
                            soluta eligendi tenetur, quam temporibus consequuntur ea? Ad, dolor! Iusto, natus?</p>
                    </div>
                    <div class="mt-6 lg:mt-auto">
                        <img class="h-52 object-cover object-bottom rounded-3xl w-full"
                            src="{{ asset('assets/img/about.jpeg') }}" alt="about" loading="lazy">
                    </div>
                </div>
                <div class="w-full lg:w-1/2 p-8">
                    <div class="flex flex-wrap">
                        <div class="w-full">
                            <div class="flex flex-wrap -m-7">
                                <div class="w-auto p-7">
                                    <div class="relative w-11 h-11 border border-neutral-200 rounded-full">
                                        <div
                                            class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                            <svg class="size-5 fill-indigo-600" xmlns="http://www.w3.org/2000/svg"
                                                width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                                                <path
                                                    d="M216,68H190.06A33.82,33.82,0,0,0,196,49.69,36.62,36.62,0,0,0,158.31,12,33.44,33.44,0,0,0,134,23.25a54.65,54.65,0,0,0-6,8.3,54.65,54.65,0,0,0-6-8.3A33.44,33.44,0,0,0,97.69,12,36.62,36.62,0,0,0,60,49.69,33.82,33.82,0,0,0,65.94,68H40A20,20,0,0,0,20,88v32a20,20,0,0,0,16,19.6V200a20,20,0,0,0,20,20H200a20,20,0,0,0,20-20V139.6A20,20,0,0,0,236,120V88A20,20,0,0,0,216,68Zm-4,48H140V92h72ZM152,39.17A9.59,9.59,0,0,1,159,36h.35A12.62,12.62,0,0,1,172,49,9.59,9.59,0,0,1,168.83,56c-6.9,6.12-18.25,9.26-27.63,10.76C142.7,57.42,145.84,46.07,152,39.17ZM87.7,39.7A12.8,12.8,0,0,1,96.61,36H97A9.59,9.59,0,0,1,104,39.17c6.12,6.9,9.26,18.24,10.75,27.61C105.45,65.27,94,62.13,87.17,56A9.59,9.59,0,0,1,84,49,12.72,12.72,0,0,1,87.7,39.7ZM44,92h72v24H44Zm16,48h56v56H60Zm80,56V140h56v56Z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="w-px h-28 bg-neutral-200 mx-auto"></div>
                                </div>
                                <div class="flex-1 p-4 lg:p-7">
                                    <div class="lg:max-w-sm pb-8">
                                        <h3 class="mb-2 text-xl font-medium leading-normal">Belanja Mudah</h3>
                                        <p class="text-neutral-600 text-sm sm:text-base lg:leading-relaxed">Lorem ipsum
                                            dolor sit
                                            amet, to the consectetur adipiscing elit. Volutpat tempor condim.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <div class="flex flex-wrap -m-7">
                                <div class="w-auto p-7">
                                    <div class="relative w-11 h-11 border border-neutral-200 rounded-full">
                                        <div
                                            class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                            <svg class="size-5 fill-indigo-600" xmlns="http://www.w3.org/2000/svg"
                                                width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                                                <path
                                                    d="M219.71,117.38a12,12,0,0,0-7.25-8.52L161.28,88.39l10.59-70.61a12,12,0,0,0-20.64-10l-112,120a12,12,0,0,0,4.31,19.33l51.18,20.47L84.13,238.22a12,12,0,0,0,20.64,10l112-120A12,12,0,0,0,219.71,117.38ZM113.6,203.55l6.27-41.77a12,12,0,0,0-7.41-12.92L68.74,131.37,142.4,52.45l-6.27,41.77a12,12,0,0,0,7.41,12.92l43.72,17.49Z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="w-px h-36 bg-neutral-200 mx-auto"></div>
                                </div>
                                <div class="flex-1 p-4 lg:p-7">
                                    <div class="lg:max-w-sm pb-8">
                                        <h3 class="mb-2 text-xl font-medium leading-normal">Produk
                                            Berkualitas</h3>
                                        <p class="text-neutral-600 text-sm sm:text-base lg:leading-relaxed">Lorem ipsum
                                            dolor sit
                                            amet, to the consectetur adipiscing elit. Volutpat tempor condimentum.
                                            Volutpat tempor condiment adipiscing.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <div class="flex flex-wrap -m-7">
                                <div class="w-auto p-7 ">
                                    <div class="relative w-11 h-11 border border-neutral-200 rounded-full">
                                        <div
                                            class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                            <svg class="size-5 fill-indigo-600" xmlns="http://www.w3.org/2000/svg"
                                                width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                                                <path
                                                    d="M246.36,56.55a12,12,0,0,0-11.63-.6c-41.48,20.29-71.4,10.71-103.07.56C98.48,45.89,60.88,33.85,10.73,58.37A12,12,0,0,0,4,69.16v120.1a12,12,0,0,0,17.27,10.79c41.48-20.29,71.4-10.71,103.07-.56,18.83,6,39.08,12.51,62.24,12.51,17.66,0,37-3.77,58.69-14.37A12,12,0,0,0,252,186.84V66.74A12,12,0,0,0,246.36,56.55ZM228,179.12c-38,16.16-66.41,7.07-96.34-2.51-18.83-6-39.08-12.52-62.24-12.52A124.86,124.86,0,0,0,28,171.24V76.88c38-16.16,66.41-7.08,96.34,2.51C153.6,88.76,186.29,99.23,228,84.76ZM128,96a32,32,0,1,0,32,32A32.06,32.06,0,0,0,128,96Zm0,40a8,8,0,1,1,8-8A8,8,0,0,1,128,136ZM64,100v40a12,12,0,1,1-24,0V100a12,12,0,1,1,24,0Zm128,56V116a12,12,0,1,1,24,0v40a12,12,0,1,1-24,0Z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1 p-4 lg:p-7">
                                    <div class="lg:max-w-sm">
                                        <h3 class="mb-2 text-xl font-medium leading-normal">Harga Terjangkau
                                        </h3>
                                        <p class="text-neutral-600 text-sm sm:text-base lg:leading-relaxed">Lorem ipsum
                                            dolor sit
                                            amet, to the consectetur adipiscing elit. Volutpat tempor condimentum. Lorem
                                            ipsum dolor sit amet.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-16 relative max-w-5xl mx-auto">
                <div class="flex items-center gap-3 justify-center">
                    <div>
                        <svg width="41" height="17" viewBox="0 0 41 17" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <mask id="mask0_99_10" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                                width="41" height="17">
                                <g clip-path="url(#clip0_99_10)">
                                    <mask id="mask1_99_10" style="mask-type:luminance" maskUnits="userSpaceOnUse"
                                        x="0" y="0" width="41" height="17">
                                        <path d="M0 0H41V17H0V0Z" fill="white" />
                                    </mask>
                                    <g mask="url(#mask1_99_10)">
                                        <path
                                            d="M11.916 11.6162C11.65 12.1822 11.34 12.7402 10.939 13.2202C10.534 13.6912 10.085 14.1352 9.56699 14.4702C8.54522 15.168 7.34825 15.5654 6.11199 15.6172C4.88599 15.6482 3.61599 15.3302 2.56199 14.5642C1.49999 13.8142 0.72499 12.6302 0.33099 11.3372C-0.46801 8.72415 0.20699 5.77715 1.78699 3.67815C2.58199 2.62515 3.60399 1.76515 4.76099 1.20715C5.34499 0.939152 5.94999 0.710152 6.58199 0.609152C6.89599 0.539152 7.20199 0.527152 7.51199 0.484152C7.82199 0.472152 8.13199 0.444152 8.44299 0.452152C10.928 0.487152 13.318 1.30915 15.467 2.50315C17.619 3.72215 19.52 5.39615 21.191 7.21515C22.884 9.01915 24.435 10.9372 26.176 12.6262C27.894 14.3402 29.876 15.7462 31.936 16.9962C30.8411 16.4893 29.7832 15.9062 28.77 15.2512C27.7374 14.5945 26.7532 13.8646 25.825 13.0672C23.968 11.4472 22.315 9.60015 20.597 7.87915C19.7485 7.02497 18.857 6.21459 17.926 5.45115C17.0082 4.7113 16.0252 4.05627 14.989 3.49415C12.939 2.38515 10.691 1.63915 8.43199 1.62715C8.15199 1.61515 7.86999 1.64315 7.58899 1.65115C7.31199 1.69015 7.02399 1.69815 6.76099 1.75715C6.22099 1.83915 5.69899 2.03215 5.19599 2.25615C4.69199 2.48815 4.22599 2.80615 3.77999 3.15615C3.34295 3.52456 2.94334 3.93522 2.58699 4.38215C1.15299 6.18915 0.53999 8.77215 1.14599 11.0622C1.44899 12.2022 2.08299 13.2282 2.96999 13.9312C3.41199 14.2812 3.91099 14.5602 4.44399 14.7412C4.97999 14.9212 5.53899 15.0112 6.10799 15.0392C7.26814 15.074 8.41484 14.783 9.41799 14.1992C10.438 13.6092 11.3 12.7012 11.913 11.6132L11.916 11.6162ZM15.12 0.0861519C15.653 -0.0628481 16.24 -0.0078481 16.78 0.161152C17.324 0.326152 17.835 0.589152 18.324 0.861152C19.309 1.41515 20.246 2.07115 21.122 2.79815C22.009 3.51815 22.83 4.31515 23.643 5.11615C24.446 5.92615 25.219 6.75915 26.004 7.57315C26.7632 8.3974 27.5479 9.19778 28.357 9.97315C29.1503 10.746 29.9849 11.4754 30.857 12.1582C32.597 13.4982 34.52 14.5752 36.669 15.0862C34.458 15.0702 32.276 14.1782 30.386 12.9252C29.426 12.3082 28.544 11.5732 27.682 10.8182C26.832 10.0522 26.03 9.23115 25.242 8.41015L22.928 5.91415C22.1687 5.08935 21.3878 4.28474 20.586 3.50115C19.7896 2.72932 18.9438 2.01013 18.054 1.34815C17.6238 1.00906 17.1632 0.710458 16.678 0.456152C16.196 0.216152 15.675 0.0511519 15.124 0.0751519L15.12 0.0861519ZM20.48 0.0551519C21.436 0.0951519 22.406 0.260152 23.33 0.645152C24.256 1.03415 25.088 1.63915 25.85 2.26415C26.632 2.86915 27.369 3.58015 28.065 4.28815C28.762 5.00315 29.419 5.73815 30.105 6.42515C31.4096 7.81385 32.9179 8.99604 34.578 9.93115C36.228 10.8582 38.015 11.5062 39.891 11.9392C37.971 11.9982 36.02 11.5812 34.221 10.7642C33.309 10.3557 32.4412 9.85508 31.631 9.27015C30.813 8.67715 30.058 7.99015 29.354 7.27415C27.956 5.82015 26.734 4.29115 25.314 2.97115C24.607 2.29515 23.914 1.64315 23.104 1.16315C22.304 0.664152 21.399 0.350152 20.48 0.0511519V0.0551519ZM26.646 0.0551519C27.346 0.0151519 28.066 0.193152 28.73 0.499152C29.0575 0.656291 29.3742 0.835018 29.678 1.03415L30.568 1.60715C31.178 1.99715 31.736 2.46015 32.298 2.91215C32.848 3.37215 33.374 3.85515 33.911 4.31215C34.969 5.24215 36.009 6.14615 37.176 6.83015C38.336 7.52215 39.603 8.01715 41.004 8.10015C39.643 8.51615 38.124 8.25315 36.811 7.66015C35.476 7.07815 34.291 6.17415 33.217 5.21915C32.145 4.25615 31.141 3.26215 30.087 2.35815C29.827 2.13815 29.529 1.89415 29.277 1.66215C29.0204 1.4302 28.7535 1.20998 28.477 1.00215C27.9274 0.585402 27.311 0.265168 26.654 0.0551519H26.646Z"
                                            fill="#242424" />
                                    </g>
                                </g>
                            </mask>
                            <g mask="url(#mask0_99_10)">
                                <rect width="41" height="17" fill="#A5B4FC" />
                            </g>
                            <defs>
                                <clipPath id="clip0_99_10">
                                    <rect width="41" height="17" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>

                    </div>
                    <h4 class="capitalize text-center text-lg font-medium text-neutral-800">Kami percaya pada</h4>
                    <div>
                        <svg width="41" height="17" viewBox="0 0 41 17" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <mask id="mask0_99_11" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                                width="41" height="17">
                                <g clip-path="url(#clip0_99_11)">
                                    <mask id="mask1_99_11" style="mask-type:luminance" maskUnits="userSpaceOnUse"
                                        x="0" y="0" width="41" height="17">
                                        <path d="M41 0H0V17H41V0Z" fill="white" />
                                    </mask>
                                    <g mask="url(#mask1_99_11)">
                                        <path
                                            d="M29.084 11.6162C29.35 12.1822 29.66 12.7402 30.061 13.2202C30.466 13.6912 30.915 14.1352 31.433 14.4702C32.4548 15.168 33.6518 15.5654 34.888 15.6172C36.114 15.6482 37.384 15.3302 38.438 14.5642C39.5 13.8142 40.275 12.6302 40.669 11.3372C41.468 8.72415 40.793 5.77715 39.213 3.67815C38.418 2.62515 37.396 1.76515 36.239 1.20715C35.655 0.939152 35.05 0.710152 34.418 0.609152C34.104 0.539152 33.798 0.527152 33.488 0.484152C33.178 0.472152 32.868 0.444152 32.557 0.452152C30.072 0.487152 27.682 1.30915 25.533 2.50315C23.381 3.72215 21.48 5.39615 19.809 7.21515C18.116 9.01915 16.565 10.9372 14.824 12.6262C13.106 14.3402 11.124 15.7462 9.06401 16.9962C10.1589 16.4893 11.2168 15.9062 12.23 15.2512C13.2626 14.5945 14.2468 13.8646 15.175 13.0672C17.032 11.4472 18.685 9.60015 20.403 7.87915C21.2515 7.02497 22.143 6.21459 23.074 5.45115C23.9918 4.7113 24.9748 4.05627 26.011 3.49415C28.061 2.38515 30.309 1.63915 32.568 1.62715C32.848 1.61515 33.13 1.64315 33.411 1.65115C33.688 1.69015 33.976 1.69815 34.239 1.75715C34.779 1.83915 35.301 2.03215 35.804 2.25615C36.308 2.48815 36.774 2.80615 37.22 3.15615C37.6571 3.52456 38.0567 3.93522 38.413 4.38215C39.847 6.18915 40.46 8.77215 39.854 11.0622C39.551 12.2022 38.917 13.2282 38.03 13.9312C37.588 14.2812 37.089 14.5602 36.556 14.7412C36.02 14.9212 35.461 15.0112 34.892 15.0392C33.7319 15.074 32.5852 14.783 31.582 14.1992C30.562 13.6092 29.7 12.7012 29.087 11.6132L29.084 11.6162ZM25.88 0.0861519C25.347 -0.0628481 24.76 -0.0078481 24.22 0.161152C23.676 0.326152 23.165 0.589152 22.676 0.861152C21.691 1.41515 20.754 2.07115 19.878 2.79815C18.991 3.51815 18.17 4.31515 17.357 5.11615C16.554 5.92615 15.781 6.75915 14.996 7.57315C14.2368 8.3974 13.4521 9.19778 12.643 9.97315C11.8497 10.746 11.0151 11.4754 10.143 12.1582C8.40301 13.4982 6.48001 14.5752 4.33101 15.0862C6.54201 15.0702 8.72401 14.1782 10.614 12.9252C11.574 12.3082 12.456 11.5732 13.318 10.8182C14.168 10.0522 14.97 9.23115 15.758 8.41015L18.072 5.91415C18.8313 5.08935 19.6122 4.28474 20.414 3.50115C21.2104 2.72932 22.0562 2.01013 22.946 1.34815C23.3762 1.00906 23.8368 0.710458 24.322 0.456152C24.804 0.216152 25.325 0.0511519 25.876 0.0751519L25.88 0.0861519ZM20.52 0.0551519C19.564 0.0951519 18.594 0.260152 17.67 0.645152C16.744 1.03415 15.912 1.63915 15.15 2.26415C14.368 2.86915 13.631 3.58015 12.935 4.28815C12.238 5.00315 11.581 5.73815 10.895 6.42515C9.5904 7.81385 8.08215 8.99604 6.42201 9.93115C4.77201 10.8582 2.98501 11.5062 1.10901 11.9392C3.02901 11.9982 4.98001 11.5812 6.77901 10.7642C7.69098 10.3557 8.55882 9.85508 9.36901 9.27015C10.187 8.67715 10.942 7.99015 11.646 7.27415C13.044 5.82015 14.266 4.29115 15.686 2.97115C16.393 2.29515 17.086 1.64315 17.896 1.16315C18.696 0.664152 19.601 0.350152 20.52 0.0511519V0.0551519ZM14.354 0.0551519C13.654 0.0151519 12.934 0.193152 12.27 0.499152C11.9425 0.656291 11.6258 0.835018 11.322 1.03415L10.432 1.60715C9.82201 1.99715 9.26401 2.46015 8.70201 2.91215C8.15201 3.37215 7.62601 3.85515 7.08901 4.31215C6.03101 5.24215 4.99101 6.14615 3.82401 6.83015C2.66401 7.52215 1.39701 8.01715 -0.00399017 8.10015C1.35701 8.51615 2.87601 8.25315 4.18901 7.66015C5.52401 7.07815 6.70901 6.17415 7.78301 5.21915C8.85501 4.25615 9.85901 3.26215 10.913 2.35815C11.173 2.13815 11.471 1.89415 11.723 1.66215C11.9796 1.4302 12.2465 1.20998 12.523 1.00215C13.0726 0.585402 13.689 0.265168 14.346 0.0551519H14.354Z"
                                            fill="#242424" />
                                    </g>
                                </g>
                            </mask>
                            <g mask="url(#mask0_99_11)">
                                <rect width="41" height="17" transform="matrix(-1 0 0 1 41 0)"
                                    fill="#A5B4FC" />
                            </g>
                            <defs>
                                <clipPath id="clip0_99_11">
                                    <rect width="41" height="17" fill="white"
                                        transform="matrix(-1 0 0 1 41 0)" />
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                </div>
                <div class="mt-8">
                    @php
                        $believe = [
                            'Kreatifitas',
                            'Inovasi',
                            'Kualitas',
                            'Kustomisasi',
                            'Inspirasi',
                            'Komitmen',
                            'Kerja Sama',
                            'Kepuasan',
                        ];
                    @endphp
                    <div id="believe-slider" class="splide" aria-label="Believe Slider">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach ($believe as $b)
                                    <li class="splide__slide px-2">
                                        <div
                                            class="border border-neutral-100 bg-neutral-200/50 py-2 px-6 rounded-full text-neutral-600/80">
                                            {{ $b }}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div
                        class="absolute left-0 bottom-0 top-0 bg-gradient-to-r from-white via-white/70 to-transparent w-20 sm:w-32 lg:w-56 h-full">
                    </div>
                    <div
                        class="absolute right-0 bottom-0 top-0 bg-gradient-to-l from-white via-white/70 to-transparent w-20 sm:w-32 lg:w-56 h-full">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="py-10 lg:py-20">
        <div class="max-w-7xl mx-auto px-5">
            <div class="text-center mb-8">
                <h1 class="text-3xl lg:text-4xl font-semibold">Kategori Terpopuler</h1>
                <p class="max-w-2xl mx-auto text-neutral-500 mt-4">Dengan karyakita kamu jadi lebih mudah untuk
                    menemukan jasa dan produk digital yang sesuai dengan tujuan kamu</p>
            </div>
            <div class="flex flex-wrap -m-4">
                <div class="w-full lg:w-1/3 p-4">
                    <div class="group">
                        <div class="relative overflow-hidden rounded-2xl mb-4" style="height:372px;">
                            <img class="rounded-2xl object-cover w-full h-full transform group-hover:scale-105 transition duration-200"
                                src="https://images.pexels.com/photos/56759/pexels-photo-56759.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                                alt="" loading="lazy">
                            <div
                                class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black via-black/70 h-40 flex items-center to-transparent w-full">
                                <div class="absolute bottom-8">
                                    <h2 class="text-2xl font-medium capitalize text-white">Desain Grafis</h2>
                                </div>
                            </div>
                            <div class="absolute bottom-4 right-4">
                                <a href="#"
                                    class="bg-indigo-500 rounded-full hover:bg-indigo-600 duration-300 text-white text-sm font-semibold h-16 w-16 flex items-center justify-center transition duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewbox="0 0 24 24" fill="none">
                                        <path
                                            d="M17.92 6.62C17.8185 6.37565 17.6243 6.18147 17.38 6.08C17.2598 6.02876 17.1307 6.00158 17 6H7C6.73478 6 6.48043 6.10536 6.29289 6.29289C6.10536 6.48043 6 6.73478 6 7C6 7.26522 6.10536 7.51957 6.29289 7.70711C6.48043 7.89464 6.73478 8 7 8H14.59L6.29 16.29C6.19627 16.383 6.12188 16.4936 6.07111 16.6154C6.02034 16.7373 5.9942 16.868 5.9942 17C5.9942 17.132 6.02034 17.2627 6.07111 17.3846C6.12188 17.5064 6.19627 17.617 6.29 17.71C6.38296 17.8037 6.49356 17.8781 6.61542 17.9289C6.73728 17.9797 6.86799 18.0058 7 18.0058C7.13201 18.0058 7.26272 17.9797 7.38458 17.9289C7.50644 17.8781 7.61704 17.8037 7.71 17.71L16 9.41V17C16 17.2652 16.1054 17.5196 16.2929 17.7071C16.4804 17.8946 16.7348 18 17 18C17.2652 18 17.5196 17.8946 17.7071 17.7071C17.8946 17.5196 18 17.2652 18 17V7C17.9984 6.86932 17.9712 6.74022 17.92 6.62Z"
                                            fill="white"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="group">
                        <div class="relative overflow-hidden rounded-2xl mb-4" style="height:372px;">
                            <img class="rounded-2xl object-cover w-full h-full transform group-hover:scale-105 transition duration-200"
                                src="https://images.pexels.com/photos/4164418/pexels-photo-4164418.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                                alt="" loading="lazy">
                            <div
                                class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black via-black/70 h-40 flex items-center to-transparent w-full">
                                <div class="absolute bottom-8">
                                    <h2 class="text-2xl font-medium capitalize text-white">Web & Aplikasi</h2>
                                </div>
                            </div>
                            <div class="absolute bottom-4 right-4">
                                <a href="#"
                                    class="bg-indigo-500 rounded-full hover:bg-indigo-600 duration-300 text-white text-sm font-semibold h-16 w-16 flex items-center justify-center transition duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewbox="0 0 24 24" fill="none">
                                        <path
                                            d="M17.92 6.62C17.8185 6.37565 17.6243 6.18147 17.38 6.08C17.2598 6.02876 17.1307 6.00158 17 6H7C6.73478 6 6.48043 6.10536 6.29289 6.29289C6.10536 6.48043 6 6.73478 6 7C6 7.26522 6.10536 7.51957 6.29289 7.70711C6.48043 7.89464 6.73478 8 7 8H14.59L6.29 16.29C6.19627 16.383 6.12188 16.4936 6.07111 16.6154C6.02034 16.7373 5.9942 16.868 5.9942 17C5.9942 17.132 6.02034 17.2627 6.07111 17.3846C6.12188 17.5064 6.19627 17.617 6.29 17.71C6.38296 17.8037 6.49356 17.8781 6.61542 17.9289C6.73728 17.9797 6.86799 18.0058 7 18.0058C7.13201 18.0058 7.26272 17.9797 7.38458 17.9289C7.50644 17.8781 7.61704 17.8037 7.71 17.71L16 9.41V17C16 17.2652 16.1054 17.5196 16.2929 17.7071C16.4804 17.8946 16.7348 18 17 18C17.2652 18 17.5196 17.8946 17.7071 17.7071C17.8946 17.5196 18 17.2652 18 17V7C17.9984 6.86932 17.9712 6.74022 17.92 6.62Z"
                                            fill="white"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-1/3 p-4">
                    <div class="group">
                        <div class="relative overflow-hidden rounded-2xl" style="height:760px;">
                            <img class="rounded-2xl object-cover w-full h-full transform group-hover:scale-105 transition duration-200"
                                src="https://images.pexels.com/photos/8871935/pexels-photo-8871935.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                                alt="" loading="lazy">
                            <div
                                class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black via-black/70 h-40 flex items-center to-transparent w-full">
                                <div class="absolute bottom-8">
                                    <h2 class="text-2xl font-medium capitalize text-white">Jasa Profesional</h2>
                                </div>
                            </div>
                            <div class="absolute bottom-4 right-4">
                                <a href="#"
                                    class="bg-indigo-500 rounded-full hover:bg-indigo-600 duration-300 text-white text-sm font-semibold h-16 w-16 flex items-center justify-center transition duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewbox="0 0 24 24" fill="none">
                                        <path
                                            d="M17.92 6.62C17.8185 6.37565 17.6243 6.18147 17.38 6.08C17.2598 6.02876 17.1307 6.00158 17 6H7C6.73478 6 6.48043 6.10536 6.29289 6.29289C6.10536 6.48043 6 6.73478 6 7C6 7.26522 6.10536 7.51957 6.29289 7.70711C6.48043 7.89464 6.73478 8 7 8H14.59L6.29 16.29C6.19627 16.383 6.12188 16.4936 6.07111 16.6154C6.02034 16.7373 5.9942 16.868 5.9942 17C5.9942 17.132 6.02034 17.2627 6.07111 17.3846C6.12188 17.5064 6.19627 17.617 6.29 17.71C6.38296 17.8037 6.49356 17.8781 6.61542 17.9289C6.73728 17.9797 6.86799 18.0058 7 18.0058C7.13201 18.0058 7.26272 17.9797 7.38458 17.9289C7.50644 17.8781 7.61704 17.8037 7.71 17.71L16 9.41V17C16 17.2652 16.1054 17.5196 16.2929 17.7071C16.4804 17.8946 16.7348 18 17 18C17.2652 18 17.5196 17.8946 17.7071 17.7071C17.8946 17.5196 18 17.2652 18 17V7C17.9984 6.86932 17.9712 6.74022 17.92 6.62Z"
                                            fill="white"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-1/3 p-4">
                    <div class="group">
                        <div class="relative overflow-hidden rounded-2xl mb-4" style="height:372px;">
                            <img class="rounded-2xl object-cover w-full h-full transform group-hover:scale-105 transition duration-200"
                                src="https://images.pexels.com/photos/4186912/pexels-photo-4186912.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                                alt="" loading="lazy">
                            <div
                                class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black via-black/70 h-40 flex items-center to-transparent w-full">
                                <div class="absolute bottom-8">
                                    <h2 class="text-2xl font-medium capitalize text-white">Produktivitas</h2>
                                </div>
                            </div>
                            <div class="absolute bottom-4 right-4">
                                <a href="#"
                                    class="bg-indigo-500 rounded-full hover:bg-indigo-600 duration-300 text-white text-sm font-semibold h-16 w-16 flex items-center justify-center transition duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewbox="0 0 24 24" fill="none">
                                        <path
                                            d="M17.92 6.62C17.8185 6.37565 17.6243 6.18147 17.38 6.08C17.2598 6.02876 17.1307 6.00158 17 6H7C6.73478 6 6.48043 6.10536 6.29289 6.29289C6.10536 6.48043 6 6.73478 6 7C6 7.26522 6.10536 7.51957 6.29289 7.70711C6.48043 7.89464 6.73478 8 7 8H14.59L6.29 16.29C6.19627 16.383 6.12188 16.4936 6.07111 16.6154C6.02034 16.7373 5.9942 16.868 5.9942 17C5.9942 17.132 6.02034 17.2627 6.07111 17.3846C6.12188 17.5064 6.19627 17.617 6.29 17.71C6.38296 17.8037 6.49356 17.8781 6.61542 17.9289C6.73728 17.9797 6.86799 18.0058 7 18.0058C7.13201 18.0058 7.26272 17.9797 7.38458 17.9289C7.50644 17.8781 7.61704 17.8037 7.71 17.71L16 9.41V17C16 17.2652 16.1054 17.5196 16.2929 17.7071C16.4804 17.8946 16.7348 18 17 18C17.2652 18 17.5196 17.8946 17.7071 17.7071C17.8946 17.5196 18 17.2652 18 17V7C17.9984 6.86932 17.9712 6.74022 17.92 6.62Z"
                                            fill="white"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="group">
                        <div class="relative overflow-hidden rounded-2xl mb-4" style="height:372px;">
                            <img class="rounded-2xl object-cover w-full h-full transform group-hover:scale-105 transition duration-200"
                                src="https://images.pexels.com/photos/5303549/pexels-photo-5303549.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                                alt="">
                            <div
                                class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black via-black/70 h-40 flex items-center to-transparent w-full">
                                <div class="absolute bottom-8">
                                    <h2 class="text-2xl font-medium capitalize text-white">Pendidikan</h2>
                                </div>
                            </div>
                            <div class="absolute bottom-4 right-4">
                                <a href="#"
                                    class="bg-indigo-500 rounded-full hover:bg-indigo-600 duration-300 text-white text-sm font-semibold h-16 w-16 flex items-center justify-center transition duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewbox="0 0 24 24" fill="none">
                                        <path
                                            d="M17.92 6.62C17.8185 6.37565 17.6243 6.18147 17.38 6.08C17.2598 6.02876 17.1307 6.00158 17 6H7C6.73478 6 6.48043 6.10536 6.29289 6.29289C6.10536 6.48043 6 6.73478 6 7C6 7.26522 6.10536 7.51957 6.29289 7.70711C6.48043 7.89464 6.73478 8 7 8H14.59L6.29 16.29C6.19627 16.383 6.12188 16.4936 6.07111 16.6154C6.02034 16.7373 5.9942 16.868 5.9942 17C5.9942 17.132 6.02034 17.2627 6.07111 17.3846C6.12188 17.5064 6.19627 17.617 6.29 17.71C6.38296 17.8037 6.49356 17.8781 6.61542 17.9289C6.73728 17.9797 6.86799 18.0058 7 18.0058C7.13201 18.0058 7.26272 17.9797 7.38458 17.9289C7.50644 17.8781 7.61704 17.8037 7.71 17.71L16 9.41V17C16 17.2652 16.1054 17.5196 16.2929 17.7071C16.4804 17.8946 16.7348 18 17 18C17.2652 18 17.5196 17.8946 17.7071 17.7071C17.8946 17.5196 18 17.2652 18 17V7C17.9984 6.86932 17.9712 6.74022 17.92 6.62Z"
                                            fill="white"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="py-10 lg:pt-14 lg:py-20">
        <div class="max-w-7xl mx-auto px-5">
            <div class="relative">
                <div class="text-center mb-10 lg:mb-14">
                    <h1 class="text-3xl lg:text-4xl font-semibold -tracking-wide">Yang Populer di KaryaKita</h1>
                </div>
                <div id="popular-carousel" class="splide" aria-label="Popular Carousel">
                    <div class="splide__track rounded-2xl overflow-hidden">
                        <ul class="splide__list">
                            @for ($i = 0; $i < 6; $i++)
                                <li class="splide__slide px-2">
                                    <img src="https://www.sribu.com/_next/image?url=https%3A%2F%2Fprod-sribu.sniag.upcloudobjects.com%2Fbanner%2Fa8035dae-b034-4c17-949f-19036074b934.webp&w=828&q=75"
                                        alt="" class="rounded-2xl">
                                </li>
                            @endfor
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-10 lg:pt-14 lg:py-20">
        <div class="max-w-7xl mx-auto px-5">
            <div class="text-center mb-10 lg:mb-14">
                <h1 class="text-3xl lg:text-4xl font-semibold -tracking-wide">Kategori Terpopuler</h1>
                <p class="max-w-xl mx-auto text-neutral-500 mt-4 lg:text-lg">Dengan karyakita kamu jadi lebih mudah
                    untuk
                    menemukan jasa dan produk digital yang sesuai dengan tujuan kamu</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <a href="#"
                    class="w-full bg-indigo-200/50 p-8 rounded-3xl relative hover:bg-indigo-200 duration-300 lg:mt-6">
                    <div>
                        <h1 class="text-6xl text-indigo-400/70 font-serif font-bold mb-4">01</h1>
                        <h3 class="font-medium text-2xl">Desain Grafis</h3>
                        <p class="text-neutral-700 mt-2 tracking-wide leading-relaxed sm:text-lg line-clamp-3">Lorem
                            ipsum dolor sit amet
                            consectetur adipisicing elit. Mollitia, optio.</p>
                    </div>
                    <div class="absolute top-8 right-8">
                        <svg class="size-12 fill-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"
                            focusable="false"
                            color="var(--token-342ca76b-3fbd-4ec1-b2bc-bd892795bf7e, rgb(79, 26, 239))">
                            <g color="var(--token-342ca76b-3fbd-4ec1-b2bc-bd892795bf7e, rgb(79, 26, 239))"
                                weight="light">
                                <path
                                    d="M224,26c-20.8,0-44.11,11.41-69.3,33.9C136.62,76.06,121,94.9,110.3,109A58,58,0,0,0,34,164c0,32.07-20.43,46.39-21.35,47A6,6,0,0,0,16,222H92a58,58,0,0,0,55-76.3c14.08-10.67,32.92-26.32,49.08-44.4C218.59,76.11,230,52.8,230,32A6,6,0,0,0,224,26ZM92,210H30.65C37.92,200.85,46,185.78,46,164a46,46,0,1,1,46,46Zm29.49-95.91c3.6-4.67,7.88-10,12.71-15.69a78.17,78.17,0,0,1,23.4,23.4c-5.67,4.83-11,9.11-15.69,12.71A58.38,58.38,0,0,0,121.49,114.09Zm45.2-.3a90.24,90.24,0,0,0-24.48-24.48C163.05,66.46,191,42,217.56,38.44,214,65,189.54,93,166.69,113.79Z">
                                </path>
                            </g>
                        </svg>
                    </div>
                </a>
                <a href="#"
                    class="w-full bg-indigo-200/50 p-8 rounded-3xl relative hover:bg-indigo-200 duration-300">
                    <div>
                        <h1 class="text-6xl text-indigo-400/70 font-serif font-bold mb-4">02</h1>
                        <h3 class="font-medium text-2xl">Web & Aplikasi</h3>
                        <p class="text-neutral-700 mt-2 tracking-wide leading-relaxed sm:text-lg line-clamp-3">Lorem
                            ipsum dolor sit amet
                            consectetur adipisicing elit. Mollitia, optio.</p>
                    </div>
                    <div class="absolute top-8 right-8">
                        <svg class="size-12 fill-indigo-400" xmlns="http://www.w3.org/2000/svg" width="32"
                            height="32" fill="#000000" viewBox="0 0 256 256">
                            <path
                                d="M69.12,94.15,28.5,128l40.62,33.85a8,8,0,1,1-10.24,12.29l-48-40a8,8,0,0,1,0-12.29l48-40a8,8,0,0,1,10.24,12.3Zm176,27.7-48-40a8,8,0,1,0-10.24,12.3L227.5,128l-40.62,33.85a8,8,0,1,0,10.24,12.29l48-40a8,8,0,0,0,0-12.29ZM162.73,32.48a8,8,0,0,0-10.25,4.79l-64,176a8,8,0,0,0,4.79,10.26A8.14,8.14,0,0,0,96,224a8,8,0,0,0,7.52-5.27l64-176A8,8,0,0,0,162.73,32.48Z">
                            </path>
                        </svg>
                    </div>
                </a>
                <a href="#"
                    class="w-full bg-indigo-200/50 p-8 rounded-3xl relative hover:bg-indigo-200 duration-300 lg:mt-6">
                    <div>
                        <h1 class="text-6xl text-indigo-400/70 font-serif font-bold mb-4">03</h1>
                        <h3 class="font-medium text-2xl">Produktivitas</h3>
                        <p class="text-neutral-700 mt-2 tracking-wide leading-relaxed sm:text-lg line-clamp-3">Lorem
                            ipsum dolor sit amet
                            consectetur adipisicing elit. Mollitia, optio.</p>
                    </div>
                    <div class="absolute top-8 right-8">
                        <svg class="size-12 fill-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"
                            focusable="false"
                            color="var(--token-342ca76b-3fbd-4ec1-b2bc-bd892795bf7e, rgb(79, 26, 239))">
                            <g color="var(--token-342ca76b-3fbd-4ec1-b2bc-bd892795bf7e, rgb(79, 26, 239))"
                                weight="light">
                                <path
                                    d="M219.44,146.2A94.66,94.66,0,0,0,173.92,86H240a6,6,0,0,0,0-12H157.4a30,30,0,0,0-58.8,0H16a6,6,0,0,0,0,12H82.08a94.66,94.66,0,0,0-45.52,60.2,30,30,0,1,0,12.09,1.08,82.53,82.53,0,0,1,51.4-56.39,30,30,0,0,0,55.9,0,82.53,82.53,0,0,1,51.4,56.39,30,30,0,1,0,12.09-1.08ZM58,176a18,18,0,1,1-18-18A18,18,0,0,1,58,176Zm70-78a18,18,0,1,1,18-18A18,18,0,0,1,128,98Zm88,96a18,18,0,1,1,18-18A18,18,0,0,1,216,194Z">
                                </path>
                            </g>
                        </svg>
                    </div>
                </a>
                <a href="#"
                    class="w-full bg-indigo-200/50 p-8 rounded-3xl relative hover:bg-indigo-200 duration-300 lg:mt-6">
                    <div>
                        <h1 class="text-6xl text-indigo-400/70 font-serif font-bold mb-4">04</h1>
                        <h3 class="font-medium text-2xl">Pendidikan</h3>
                        <p class="text-neutral-700 mt-2 tracking-wide leading-relaxed sm:text-lg line-clamp-3">Lorem
                            ipsum dolor sit amet
                            consectetur adipisicing elit. Mollitia, optio.</p>
                    </div>
                    <div class="absolute top-8 right-8">
                        <svg class="size-12 fill-indigo-400" xmlns="http://www.w3.org/2000/svg" width="32"
                            height="32" fill="#000000" viewBox="0 0 256 256">
                            <path
                                d="M251.76,88.94l-120-64a8,8,0,0,0-7.52,0l-120,64a8,8,0,0,0,0,14.12L32,117.87v48.42a15.91,15.91,0,0,0,4.06,10.65C49.16,191.53,78.51,216,128,216a130,130,0,0,0,48-8.76V240a8,8,0,0,0,16,0V199.51a115.63,115.63,0,0,0,27.94-22.57A15.91,15.91,0,0,0,224,166.29V117.87l27.76-14.81a8,8,0,0,0,0-14.12ZM128,200c-43.27,0-68.72-21.14-80-33.71V126.4l76.24,40.66a8,8,0,0,0,7.52,0L176,143.47v46.34C163.4,195.69,147.52,200,128,200Zm80-33.75a97.83,97.83,0,0,1-16,14.25V134.93l16-8.53ZM188,118.94l-.22-.13-56-29.87a8,8,0,0,0-7.52,14.12L171,128l-43,22.93L25,96,128,41.07,231,96Z">
                            </path>
                        </svg>
                    </div>
                </a>
                <a href="#"
                    class="w-full bg-indigo-200/50 p-8 rounded-3xl relative hover:bg-indigo-200 duration-300">
                    <div>
                        <h1 class="text-6xl text-indigo-400/70 font-serif font-bold mb-4">05</h1>
                        <h3 class="font-medium text-2xl">Jasa Profesional</h3>
                        <p class="text-neutral-700 mt-2 tracking-wide leading-relaxed sm:text-lg line-clamp-3">Lorem
                            ipsum dolor sit amet
                            consectetur adipisicing elit. Mollitia, optio.</p>
                    </div>
                    <div class="absolute top-8 right-8">
                        <svg class="size-12 fill-indigo-400" xmlns="http://www.w3.org/2000/svg" width="32"
                            height="32" fill="#000000" viewBox="0 0 256 256">
                            <path
                                d="M201.89,54.66A103.43,103.43,0,0,0,128.79,24H128A104,104,0,0,0,24,128v56a24,24,0,0,0,24,24H64a24,24,0,0,0,24-24V144a24,24,0,0,0-24-24H40.36A88.12,88.12,0,0,1,190.54,65.93,87.39,87.39,0,0,1,215.65,120H192a24,24,0,0,0-24,24v40a24,24,0,0,0,24,24h24a24,24,0,0,1-24,24H136a8,8,0,0,0,0,16h56a40,40,0,0,0,40-40V128A103.41,103.41,0,0,0,201.89,54.66ZM64,136a8,8,0,0,1,8,8v40a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V136Zm128,56a8,8,0,0,1-8-8V144a8,8,0,0,1,8-8h24v56Z">
                            </path>
                        </svg>
                    </div>
                </a>
                <a href="#"
                    class="w-full bg-indigo-200/50 p-8 rounded-2xl relative hover:bg-indigo-200 duration-300 lg:mt-6">
                    <div>
                        <h1 class="text-6xl text-indigo-400/70 font-serif font-bold mb-4">06</h1>
                        <h3 class="font-medium text-2xl">Konten Digital</h3>
                        <p class="text-neutral-700 mt-2 tracking-wide leading-relaxed sm:text-lg line-clamp-3">Lorem
                            ipsum dolor sit amet
                            consectetur adipisicing elit. Mollitia, optio.</p>
                    </div>
                    <div class="absolute top-8 right-8">
                        <svg class="size-12 fill-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"
                            focusable="false"
                            color="var(--token-342ca76b-3fbd-4ec1-b2bc-bd892795bf7e, rgb(79, 26, 239))">
                            <g color="var(--token-342ca76b-3fbd-4ec1-b2bc-bd892795bf7e, rgb(79, 26, 239))"
                                weight="light">
                                <path
                                    d="M229.66,187.13a78,78,0,0,0-61.5-112.71A78,78,0,1,0,26.34,139.13L18.47,166.7A12,12,0,0,0,33.3,181.53l27.57-7.87a78.25,78.25,0,0,0,26.94,7.9,78.05,78.05,0,0,0,107.32,40.1l27.57,7.87a12,12,0,0,0,14.83-14.83ZM61.53,161.23a5.82,5.82,0,0,0-1.65.23L30,170l8.53-29.87a6,6,0,0,0-.5-4.53A66,66,0,1,1,64.41,162,6.1,6.1,0,0,0,61.53,161.23Zm155.93,26.89L226,218l-29.87-8.53a6,6,0,0,0-4.53.5,66,66,0,0,1-90.48-28.15,77.92,77.92,0,0,0,71-94.68A66,66,0,0,1,218,183.59,6,6,0,0,0,217.46,188.12Z">
                                </path>
                            </g>
                        </svg>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section class="py-10 lg:pt-14 lg:py-20">
        <div class="max-w-7xl mx-auto px-5">
            <div class="mb-10 lg:mb-14">
                <div class="flex flex-wrap items-center justify-center lg:justify-between">
                    <div class="text-center lg:text-left max-w-xl mx-auto lg:mx-0">
                        <div class="border border-neutral-300 rounded-full text-sm inline-block py-1 px-3 mb-4">
                            Produk Teratas
                        </div>
                        <h1 class="text-3xl lg:text-4xl font-semibold -tracking-wide">Penjualan Terbaik di Bulan Ini
                        </h1>
                    </div>
                    <div class="text-center lg:text-right">
                        <p
                            class="max-w-lg mx-auto lg:mx-0 text-center lg:text-right text-neutral-500 mt-4 lg:text-lg mb-4">
                            Temukan produk dan jasa profesional
                            terbaik yang
                            sesuai dengan kebutuhanmu</p>
                        <a href="{{ route('semua-produk') }}">
                            <x-border-button class="inline-flex gap-2 items-center">
                                Belanja sekarang
                                <svg class="size-5 fill-indigo-600" xmlns="http://www.w3.org/2000/svg" width="32"
                                    height="32" fill="#000000" viewBox="0 0 256 256">
                                    <path
                                        d="M88,24V16a8,8,0,0,1,16,0v8a8,8,0,0,1-16,0ZM16,104h8a8,8,0,0,0,0-16H16a8,8,0,0,0,0,16ZM124.42,39.16a8,8,0,0,0,10.74-3.58l8-16a8,8,0,0,0-14.31-7.16l-8,16A8,8,0,0,0,124.42,39.16Zm-96,81.69-16,8a8,8,0,0,0,7.16,14.31l16-8a8,8,0,1,0-7.16-14.31ZM219.31,184a16,16,0,0,1,0,22.63l-12.68,12.68a16,16,0,0,1-22.63,0L132.7,168,115,214.09c0,.1-.08.21-.13.32a15.83,15.83,0,0,1-14.6,9.59l-.79,0a15.83,15.83,0,0,1-14.41-11L32.8,52.92A16,16,0,0,1,52.92,32.8L213,85.07a16,16,0,0,1,1.41,29.8l-.32.13L168,132.69ZM208,195.31,156.69,144h0a16,16,0,0,1,4.93-26l.32-.14,45.95-17.64L48,48l52.2,159.86,17.65-46c0-.11.08-.22.13-.33a16,16,0,0,1,11.69-9.34,16.72,16.72,0,0,1,3-.28,16,16,0,0,1,11.3,4.69L195.31,208Z">
                                    </path>
                                </svg>
                            </x-border-button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
                @foreach ($produk as $p)
                    <livewire:home.components.product-card produkId="{{ $p->id }}"
                        image="{{ asset($p->images->where('is_primary', true)->first()->image_path) }}"
                        title="{{ htmlspecialchars($p->name) }}" rating="4.8 (200)" price="{{ $p->price }}"
                        category="{{ $p->category ? $p->category->name : 'Kategori tidak tersedia' }}"
                        categorySlug="{{ $p->category ? $p->category->slug : '' }}" slug="{{ $p->slug }}"
                        lazy />
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-10 lg:pt-14 lg:py-20  relative">
        <div class="max-w-7xl mx-auto px-5">
            <div class="py-16 bg-indigo-200/70 px-8 rounded-3xl text-center relative overflow-hidden">
                <div class="flex flex-wrap items-center -mx-5">
                    <div class="w-full px-5">
                        <p class="text-indigo-600 bg-indigo-200 rounded-full px-3 py-1 inline-block">Kamu punya skill
                            dan ingin mempromosikan jasa? </p>
                        <h1 class="text-3xl lg:text-5xl font-semibold mt-2 !leading-tight ">Bergabung dengan Karyakita
                            dan tunjukkan
                            bakatmu kepada banyak orang!</h1>
                        <a href="" class="mt-8 inline-block">
                            <x-primary-button class="inline-flex gap-2 items-center">
                                <svg class="size-5 fill-white" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 256 256" focusable="false"
                                    color="var(--token-342ca76b-3fbd-4ec1-b2bc-bd892795bf7e, rgb(79, 26, 239))">
                                    <g color="var(--token-342ca76b-3fbd-4ec1-b2bc-bd892795bf7e, rgb(79, 26, 239))"
                                        weight="light">
                                        <path
                                            d="M224,26c-20.8,0-44.11,11.41-69.3,33.9C136.62,76.06,121,94.9,110.3,109A58,58,0,0,0,34,164c0,32.07-20.43,46.39-21.35,47A6,6,0,0,0,16,222H92a58,58,0,0,0,55-76.3c14.08-10.67,32.92-26.32,49.08-44.4C218.59,76.11,230,52.8,230,32A6,6,0,0,0,224,26ZM92,210H30.65C37.92,200.85,46,185.78,46,164a46,46,0,1,1,46,46Zm29.49-95.91c3.6-4.67,7.88-10,12.71-15.69a78.17,78.17,0,0,1,23.4,23.4c-5.67,4.83-11,9.11-15.69,12.71A58.38,58.38,0,0,0,121.49,114.09Zm45.2-.3a90.24,90.24,0,0,0-24.48-24.48C163.05,66.46,191,42,217.56,38.44,214,65,189.54,93,166.69,113.79Z">
                                        </path>
                                    </g>
                                </svg>
                                Daftar Sekarang
                            </x-primary-button>
                        </a>
                    </div>
                </div>
                <div class="absolute w-52 h-52 -top-20 -left-20 bg-indigo-200/70 rounded-full"></div>
                <div class="absolute w-52 h-52 -bottom-20 -right-20 bg-indigo-200/70 rounded-full"></div>
            </div>
        </div>
    </section>

    <section class="py-10 lg:pt-14 lg:py-20">
        <div class="max-w-7xl mx-auto px-5">
            <div class="mb-10 lg:mb-14">
                <div class="flex flex-wrap items-center justify-center lg:justify-between">
                    <div class="text-center lg:text-left order-2 lg:order-1">
                        <p
                            class="max-w-lg mx-auto lg:mx-0 text-center lg:text-left text-neutral-500 mt-4 lg:text-lg mb-4">
                            Butuh jasa professional untuk pekerjaanmu? Temukan jasa yang sesuai dengan kebutuhanmu di
                            Karyakita
                        </p>
                        <a href="#">
                            <x-border-button class="inline-flex gap-2 items-center">
                                Lihat semuanya
                                <svg class="size-5 fill-indigo-600" xmlns="http://www.w3.org/2000/svg" width="32"
                                    height="32" fill="#000000" viewBox="0 0 256 256">
                                    <path
                                        d="M88,24V16a8,8,0,0,1,16,0v8a8,8,0,0,1-16,0ZM16,104h8a8,8,0,0,0,0-16H16a8,8,0,0,0,0,16ZM124.42,39.16a8,8,0,0,0,10.74-3.58l8-16a8,8,0,0,0-14.31-7.16l-8,16A8,8,0,0,0,124.42,39.16Zm-96,81.69-16,8a8,8,0,0,0,7.16,14.31l16-8a8,8,0,1,0-7.16-14.31ZM219.31,184a16,16,0,0,1,0,22.63l-12.68,12.68a16,16,0,0,1-22.63,0L132.7,168,115,214.09c0,.1-.08.21-.13.32a15.83,15.83,0,0,1-14.6,9.59l-.79,0a15.83,15.83,0,0,1-14.41-11L32.8,52.92A16,16,0,0,1,52.92,32.8L213,85.07a16,16,0,0,1,1.41,29.8l-.32.13L168,132.69ZM208,195.31,156.69,144h0a16,16,0,0,1,4.93-26l.32-.14,45.95-17.64L48,48l52.2,159.86,17.65-46c0-.11.08-.22.13-.33a16,16,0,0,1,11.69-9.34,16.72,16.72,0,0,1,3-.28,16,16,0,0,1,11.3,4.69L195.31,208Z">
                                    </path>
                                </svg>
                            </x-border-button>
                        </a>
                    </div>
                    <div class="text-center lg:text-right max-w-xl mx-auto lg:mx-0 order-1 lg:order-2">
                        <div class="border border-neutral-300 rounded-full text-sm inline-block py-1 px-3 mb-4">
                            Jasa Terbaik
                        </div>
                        <h1 class="text-3xl lg:text-4xl font-semibold -tracking-wide">
                            Jasa Terpopuler yang ada di Karyakita
                        </h1>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                @for ($i = 0; $i < 6; $i++)
                    <x-product-card
                        image="https://cdn.dribbble.com/userupload/16547122/file/original-517193b05b0305a27dfc2c4c8e235eaa.png?resize=1504x1128"
                        title="Freelance Marketplace App" rating="4.8 (200)" price="250000" category="Aplikasi"
                        categorySlug="aplikasi" slug="freelance-marketplace-app" />
                @endfor
            </div>
        </div>
    </section>

    <section class="py-10 lg:pt-14 lg:py-20 relative">
        <div class="mb-10 lg:mb-14 text-center">
            <div class="border border-neutral-300 bg-neutral-100 rounded-full text-sm inline-block py-1 px-3 mb-4">
                Testimoni
            </div>
            <h1 class="text-3xl lg:text-4xl font-semibold -tracking-wide">Apa Kata Mereka?</h1>
        </div>
        <div>
            @php
                $testimoni1 = [
                    [
                        'tanggal' => '02 Januari 2024',
                        'pesan' =>
                            'KaryaKita telah mengubah cara saya berkolaborasi dengan kreator lain. Sangat memuaskan!',
                        'nama' => 'Rina S.',
                    ],
                    [
                        'tanggal' => '03 Januari 2024',
                        'pesan' => 'Saya menemukan banyak peluang baru di sini. Terima kasih KaryaKita!',
                        'nama' => 'Budi A.',
                    ],
                    [
                        'tanggal' => '04 Januari 2024',
                        'pesan' => 'Platform yang luar biasa! Sangat mudah digunakan dan banyak pilihan.',
                        'nama' => 'Siti M.',
                    ],
                    [
                        'tanggal' => '05 Januari 2024',
                        'pesan' => 'KaryaKita membantu saya menemukan klien yang tepat. Sangat direkomendasikan!',
                        'nama' => 'Andi P.',
                    ],
                    [
                        'tanggal' => '06 Januari 2024',
                        'pesan' => 'Saya sangat senang dengan hasil kerja sama di KaryaKita. Luar biasa!',
                        'nama' => 'Dewi L.',
                    ],
                    [
                        'tanggal' => '07 Januari 2024',
                        'pesan' => 'KaryaKita adalah tempat yang tepat untuk menampilkan karya saya. Terima kasih!',
                        'nama' => 'Fajar R.',
                    ],
                    [
                        'tanggal' => '08 Januari 2024',
                        'pesan' => 'Pengalaman yang menyenangkan! Saya mendapatkan banyak inspirasi di sini.',
                        'nama' => 'Lina T.',
                    ],
                ];

                $testimoni2 = [
                    [
                        'tanggal' => '09 Januari 2024',
                        'pesan' => 'KaryaKita membuat saya merasa dihargai sebagai kreator. Sangat berharga!',
                        'nama' => 'Eko W.',
                    ],
                    [
                        'tanggal' => '10 Januari 2024',
                        'pesan' => 'Saya menemukan banyak teman baru dan kolaborasi yang menarik di KaryaKita.',
                        'nama' => 'Nina H.',
                    ],
                    [
                        'tanggal' => '11 Januari 2024',
                        'pesan' => 'KaryaKita adalah platform yang sangat membantu untuk para kreator. Sukses selalu!',
                        'nama' => 'Rudi K.',
                    ],
                    [
                        'tanggal' => '12 Januari 2024',
                        'pesan' => 'Saya sangat puas dengan layanan yang diberikan. KaryaKita luar biasa!',
                        'nama' => 'Sari J.',
                    ],
                    [
                        'tanggal' => '13 Januari 2024',
                        'pesan' => 'KaryaKita membantu saya menemukan proyek yang sesuai dengan passion saya.',
                        'nama' => 'Toni S.',
                    ],
                    [
                        'tanggal' => '14 Januari 2024',
                        'pesan' => 'Saya sangat merekomendasikan KaryaKita kepada semua kreator di luar sana!',
                        'nama' => 'Wati Z.',
                    ],
                    [
                        'tanggal' => '15 Januari 2024',
                        'pesan' => 'KaryaKita adalah tempat yang tepat untuk berbagi dan belajar. Terima kasih!',
                        'nama' => 'Rizky A.',
                    ],
                    [
                        'tanggal' => '16 Januari 2024',
                        'pesan' => 'Saya merasa terinspirasi setiap kali menggunakan KaryaKita. Sangat menyenangkan!',
                        'nama' => 'Diana P.',
                    ],
                ];
            @endphp
            <div>
                <div id="testi1-slider" class="splide" aria-label="Testimonial 1 Slider">
                    <div class="splide__track items-stretch">
                        <ul class="splide__list flex items-stretch h-full">
                            @foreach ($testimoni1 as $testi)
                                <div class="splide__slide px-2 h-full">
                                    <div
                                        class="p-8 bg-neutral-100 border rounded-2xl w-full max-w-md flex flex-col justify-start gap-6 h-full">
                                        <div class="h-full">
                                            <p class="text-neutral-500 tracking-wide">{{ $testi['tanggal'] }}</p>
                                            <div class="mt-2 text-lg font-medium text-neutral-700 line-clamp-2">
                                                <p>{{ $testi['pesan'] }}</p>
                                            </div>
                                        </div>
                                        <div class="border-t pt-4">
                                            <div class="flex items-center gap-3">
                                                <img src="{{ asset('assets/img/default-person.webp') }}"
                                                    alt="" class="w-12 h-12 rounded-full">
                                                <h5 class="text-lg font-medium">{{ $testi['nama'] }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <div id="testi2-slider" class="splide" aria-label="Testimonial 2 Slider">
                    <div class="splide__track">
                        <ul class="splide__list items-stretch">
                            @foreach ($testimoni2 as $testi)
                                <div class="splide__slide px-2 h-full">
                                    <div
                                        class="p-8 bg-neutral-100 border rounded-2xl w-full max-w-md flex flex-col justify-start gap-6 h-max">
                                        <div class="">
                                            <p class="text-neutral-500 tracking-wide">{{ $testi['tanggal'] }}</p>
                                            <div class="mt-2 text-lg font-medium text-neutral-700 line-clamp-2">
                                                <p>{{ $testi['pesan'] }}</p>
                                            </div>
                                        </div>
                                        <div class="border-t pt-4">
                                            <div class="flex items-center gap-3">
                                                <img src="{{ asset('assets/img/default-person.webp') }}"
                                                    alt="" class="w-12 h-12 rounded-full">
                                                <h5 class="text-lg font-medium">{{ $testi['nama'] }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div
                class="absolute left-0 bottom-0 top-0 bg-gradient-to-r from-white via-white/70 to-transparent w-20 sm:w-32 lg:w-64 h-full">
            </div>
            <div
                class="absolute right-0 bottom-0 top-0 bg-gradient-to-l from-white via-white/70 to-transparent w-20 sm:w-32 lg:w-64 h-full">
            </div>
        </div>
    </section>

    <section class="py-10 lg:pt-14 lg:py-20 lg:pb-28">
        <div class="max-w-7xl mx-auto px-5">
            <div class="text-center mb-10 lg:mb-14">
                <h1 class="text-3xl lg:text-4xl font-semibold -tracking-wide">Artikel Terbaru</h1>
                <p class="max-w-xl mx-auto text-neutral-500 mt-4 lg:text-lg">Kami hadir untuk memudahkanmu dalam
                    mencari jasa dan produk digital yang sesuai dengan kebutuhanmu</p>
            </div>
            <div class="flex flex-wrap -mx-4">
                @php
                    $text = strip_tags(
                        'Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore eligendi maxime doloremque quas quae non corporis incidunt esse alias neque! Eum tempora molestiae quo, laudantium suscipit optio dolorem cum quae.',
                    );
                    $words = explode(' ', $text);
                    $limitedWords = array_slice($words, 0, 30);
                    $limitedText = implode(' ', $limitedWords);
                @endphp
                @for ($i = 0; $i < 3; $i++)
                    <x-article-card :image="'https://blog.sribu.com/wp-content/uploads/2024/10/pexels-ron-lach-9594428.jpg?fit=774%2C434&ssl=1'" :title="'Judul Artikel'" :created_at="'2023-08-01'" :categoryName="'Kategori'"
                        :categorySlug="'category-$i'" :slug="'article-$i'" :excerpt="$limitedText" />
                @endfor
            </div>
        </div>
    </section>
</x-main-layout>
