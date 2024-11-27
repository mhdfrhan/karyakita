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
                    perMove: 1,
                    drag: true,
                    arrows: true,
                    pagination: false,
                    focus: 'center',
                };

                initSplide('#images-slider', {
                    ...commonOptions,
                    perPage: 2,
                    // gap: '0',
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

    <section class="pb-10 lg:pb-20" id="detail-produk">
        @include('components.alert')
        <div>
            <div class="max-w-7xl mx-auto px-5">
                <div class="mb-10">
                    <h1 class="text-3xl lg:text-4xl font-semibold">{{ $produk->name }} - {{ $produk->category->name }}
                    </h1>
                    <div class="mt-4">
                        <div class="inline-flex items-center gap-2">
                            <div class="inline-flex gap-1 items-center border-r border-neutral-300 pr-2 mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-5 text-yellow-500">
                                    <path fill-rule="evenodd"
                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="inline-block text-neutral-600">4.5</span>
                            </div>
                            <p class="text-neutral-600">{{ $produk->reviews()->count() }} Ulasan</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="images-slider" class="splide" aria-label="Popular Carousel">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($produk->images as $i => $image)
                            <li class="splide__slide px-2">
                                <img src="{{ asset($image->image_path) }}" alt="Gambar {{ $i + 1 }}"
                                    class="w-full rounded-2xl" loading="lazy">
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="border-b max-w-7xl mx-auto px-5">
                <div class="flex justify-between gap-5 py-10 flex-wrap">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="size-8 text-neutral-400/70 mx-auto">
                            <path fill-rule="evenodd"
                                d="M9 4.5a.75.75 0 0 1 .721.544l.813 2.846a3.75 3.75 0 0 0 2.576 2.576l2.846.813a.75.75 0 0 1 0 1.442l-2.846.813a3.75 3.75 0 0 0-2.576 2.576l-.813 2.846a.75.75 0 0 1-1.442 0l-.813-2.846a3.75 3.75 0 0 0-2.576-2.576l-2.846-.813a.75.75 0 0 1 0-1.442l2.846-.813A3.75 3.75 0 0 0 7.466 7.89l.813-2.846A.75.75 0 0 1 9 4.5ZM18 1.5a.75.75 0 0 1 .728.568l.258 1.036c.236.94.97 1.674 1.91 1.91l1.036.258a.75.75 0 0 1 0 1.456l-1.036.258c-.94.236-1.674.97-1.91 1.91l-.258 1.036a.75.75 0 0 1-1.456 0l-.258-1.036a2.625 2.625 0 0 0-1.91-1.91l-1.036-.258a.75.75 0 0 1 0-1.456l1.036-.258a2.625 2.625 0 0 0 1.91-1.91l.258-1.036A.75.75 0 0 1 18 1.5ZM16.5 15a.75.75 0 0 1 .712.513l.394 1.183c.15.447.5.799.948.948l1.183.395a.75.75 0 0 1 0 1.422l-1.183.395c-.447.15-.799.5-.948.948l-.395 1.183a.75.75 0 0 1-1.422 0l-.395-1.183a1.5 1.5 0 0 0-.948-.948l-1.183-.395a.75.75 0 0 1 0-1.422l1.183-.395c.447-.15.799-.5.948-.948l.395-1.183A.75.75 0 0 1 16.5 15Z"
                                clip-rule="evenodd" />
                        </svg>

                        <div class="text-center mt-3 font-medium">
                            <p>v{{ $produk->versions()->orderBy('created_at', 'desc')->first()->version }}</p>
                            <span class="block text-center mt-1 text-sm text-neutral-400">Versi Terbaru</span>
                        </div>
                    </div>

                    <div class="hidden sm:block">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="size-8 text-neutral-400/70 mx-auto">
                            <path fill-rule="evenodd"
                                d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 0 0 0-1.5h-3.75V6Z"
                                clip-rule="evenodd" />
                        </svg>
                        <div class="text-center mt-3 font-medium">
                            <p>{{ $produk->updated_at->diffForHumans() }}</p>
                            <span class="block text-center mt-1 text-sm text-neutral-400">Update</span>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="size-8 text-neutral-400/70 mx-auto">
                            <path
                                d="M15 3.75H9v16.5h6V3.75ZM16.5 20.25h3.375c1.035 0 1.875-.84 1.875-1.875V5.625c0-1.036-.84-1.875-1.875-1.875H16.5v16.5ZM4.125 3.75H7.5v16.5H4.125a1.875 1.875 0 0 1-1.875-1.875V5.625c0-1.036.84-1.875 1.875-1.875Z" />
                        </svg>
                        <div class="text-center mt-3 font-medium">
                            <p>{{ $produk->pages }}</p>
                            <span class="block text-center mt-1 text-sm text-neutral-400">Halaman</span>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="size-8 text-neutral-400/70 mx-auto">
                            <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                            <path fill-rule="evenodd"
                                d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                                clip-rule="evenodd" />
                        </svg>
                        <div class="text-center mt-3 font-medium">
                            <p>{{ $produk->views }}x</p>
                            <span class="block text-center mt-1 text-sm text-neutral-400">Dilihat</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto px-5 mt-10">
                <div class="flex flex-wrap -mx-5 divide-x divide-neutral-200">
                    <div class="w-full lg:w-3/4 lg:px-5">
                        <h2 class="text-xl font-semibold mb-4">Deskripsi</h2>
                        <div class="deskripsi-produk text-neutral-700 mb-8">
                            {!! $produk->description !!}
                        </div>
                        <div class="">
                            <h2 class="text-xl font-semibold mb-4">Fitur Produk</h2>
                            <div class="mt-4">
                                <div
                                    class="w-full divide-y divide-neutral-300 overflow-hidden rounded-lg border border-neutral-200 text-neutral-600">
                                    @foreach ($produk->features as $i => $feature)
                                        <div x-data="{ isExpanded: false }" class="divide-y divide-neutral-300">
                                            <button id="controlsAccordionItem{{ $i + 1 }}" type="button"
                                                class="flex w-full items-center justify-between gap-4 p-4 text-left"
                                                aria-controls="accordionItem{{ $i + 1 }}"
                                                @click="isExpanded = ! isExpanded"
                                                :class="isExpanded ? 'text-black font-medium' :
                                                    'text-neutral-600 font-medium'"
                                                :aria-expanded="isExpanded ? 'true' : 'false'">
                                                <span>{{ $feature->title }}</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="none" stroke-width="2" stroke="currentColor"
                                                    class="size-5 shrink-0 transition" aria-hidden="true"
                                                    :class="isExpanded ? 'rotate-180' : ''">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                            <div x-cloak x-show="isExpanded" id="accordionItem{{ $i + 1 }}"
                                                role="region"
                                                aria-labelledby="controlsAccordionItem{{ $i + 1 }}" x-collapse>
                                                <div class="p-4 text-sm sm:text-base text-pretty">
                                                    {{ $feature->description }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/4 lg:px-5">
                        <div class="space-y-8">
                            <div>
                                <h2 class="text-lg font-semibold mb-1">Kategori</h2>
                                <a href="{{ route('detailKategori', $produk->category->slug) }}"
                                    class="text-neutral-500/80 hover:text-indigo-500 duration-150">{{ $produk->category->name }}</a>
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold mb-1">Sub Kategori</h2>
                                <a href="{{ route('detailSubKategori', [$produk->category->slug, $produk->subCategory->slug]) }}"
                                    class="text-neutral-500/80 hover:text-indigo-500 duration-150">{{ $produk->subCategory->name }}</a>
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold mb-1">Harga</h2>
                                <p class="text-neutral-500/80">
                                    Rp. <span>{{ number_format($produk->price, 0, ',', '.') }}</span>
                                    <span
                                        class="line-through text-sm text-neutral-400">{{ number_format($produk->old_price, 0, ',', '.') }}</span>
                                    <span>({{ round((($produk->old_price - $produk->price) / $produk->old_price) * 100) }}%)</span>
                                </p>
                            </div>
                            <div>
                                @php
                                    $tagIds = explode(',', $produk->tags);
                                    $produkTags = \App\Models\ProductTags::whereIn('id', $tagIds)
                                        ->select(['name', 'slug'])
                                        ->get();
                                @endphp
                                <h2 class="text-lg font-semibold mb-1">Tags</h2>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($produkTags as $tag)
                                        <a href="{{ route('detailTag', $tag->slug) }}"
                                            class="bg-neutral-200 text-center rounded-md inline-block px-4 py-1 text-neutral-500 hover:bg-indigo-500 duration-150 hover:text-white capitalize">
                                            {{ $tag->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold mb-1">Bantuan</h2>
                                <ul class="space-y-1">
                                    <li>
                                        <a href="mailto:{{ $produk->shop->user->email }}"
                                            class="inline-flex items-center gap-3 text-neutral-500/80 hover:text-indigo-500 duration-150">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" class="size-5 shrink-0">
                                                <path
                                                    d="M3 4a2 2 0 0 0-2 2v1.161l8.441 4.221a1.25 1.25 0 0 0 1.118 0L19 7.162V6a2 2 0 0 0-2-2H3Z" />
                                                <path
                                                    d="m19 8.839-7.77 3.885a2.75 2.75 0 0 1-2.46 0L1 8.839V14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8.839Z" />
                                            </svg>
                                            Hubungi {{ $produk->shop->name }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href=""
                                            class="inline-flex items-center gap-3 text-neutral-500/80 hover:text-indigo-500 duration-150">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" class="size-5 shrink-0">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0ZM8.94 6.94a.75.75 0 1 1-1.061-1.061 3 3 0 1 1 2.871 5.026v.345a.75.75 0 0 1-1.5 0v-.5c0-.72.57-1.172 1.081-1.287A1.5 1.5 0 1 0 8.94 6.94ZM10 15a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Gimana cara beli produk ini?
                                        </a>
                                    </li>
                                    <li>
                                        <a href=""
                                            class="inline-flex items-center gap-3 text-neutral-500/80 hover:text-red-500 duration-150">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" class="size-5">
                                                <path
                                                    d="M13.92 3.845a19.362 19.362 0 0 1-6.3 1.98C6.765 5.942 5.89 6 5 6a4 4 0 0 0-.504 7.969 15.97 15.97 0 0 0 1.271 3.34c.397.771 1.342 1 2.05.59l.867-.5c.726-.419.94-1.32.588-2.02-.166-.331-.315-.666-.448-1.004 1.8.357 3.511.963 5.096 1.78A17.964 17.964 0 0 0 15 10c0-2.162-.381-4.235-1.08-6.155ZM15.243 3.097A19.456 19.456 0 0 1 16.5 10c0 2.43-.445 4.758-1.257 6.904l-.03.077a.75.75 0 0 0 1.401.537 20.903 20.903 0 0 0 1.312-5.745 2 2 0 0 0 0-3.546 20.902 20.902 0 0 0-1.312-5.745.75.75 0 0 0-1.4.537l.029.078Z" />
                                            </svg>
                                            Laporkan produk ini
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sticky bottom-0 bg-white py-4 mt-8 border-t border-neutral-200">
                <div class="max-w-7xl mx-auto px-5">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <div class="flex items-center gap-3">
                                <div>
                                    @if (optional($produk->shop->user)->profile_image)
                                        <img src="{{ asset($produk->shop->user->profile_image) }}"
                                            alt="{{ $produk->shop->name }}" class="rounded-full size-10"
                                            loading='lazy'>
                                    @else
                                        @if (auth()->user()->gender == 'male')
                                            <img src="{{ asset('assets/img/default-person.webp') }}"
                                                class="rounded-full size-10" alt="Profile Image" loading='lazy'>
                                        @else
                                            <img src="{{ asset('assets/img/default-person-female.webp') }}"
                                                class="rounded-full size-10" alt="Profile Image" loading='lazy'>
                                        @endif
                                    @endif
                                </div>
                                <div class="font-medium">
                                    <div>
                                        <p>{{ $produk->shop->name }}</p>
                                    </div>
                                    <div class="inline-flex items-center gap-2">
                                        @if ($produk->shop->user->last_seen >= now()->subMinutes(2))
                                            <div class="flex items-center gap-1">
                                                <span class="relative flex h-3 w-3">
                                                    <span
                                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-600 opacity-75"></span>
                                                    <span
                                                        class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                                                </span>
                                                <span class="block text-sm text-green-500">Online</span>
                                            </div>
                                        @else
                                            <span class="block text-sm text-neutral-400">Terakhir online
                                                {{ Carbon\Carbon::parse($produk->shop->user->last_seen)->diffForHumans() }}</span>
                                        @endif
                                        <span class="text-neutral-400">~</span>
                                        <a href=""
                                            class="inline-flex items-center gap-0.5 text-sm text-neutral-400 font-normal hover:underline">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                                            </svg>
                                            Chat toko
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <livewire:home.produk.keranjang-dan-beli :produk="$produk">
                    </div>
                </div>
            </div>
    </section>
</x-main-layout>
