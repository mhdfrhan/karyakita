@props(['image', 'title', 'rating', 'price', 'category', 'slug', 'categorySlug', 'listView' => 'grid'])

<div class="border rounded-3xl relative group {{ $listView == 'row' ? 'lg:flex gap-4' : '' }}">
    <img src="{{ $image }}"
        class="rounded-2xl {{ $listView == 'row' ? 'w-1/4' : 'w-full' }} aspect-video object-cover"
        alt="{{ $title }}" loading="lazy">
    <div class="p-4">
        <div class="{{ $listView != 'row' ? 'flex w-full' : '' }}">
            <div>
                <a href="{{ route('detailProduk', $slug) }}" class="hover:text-indigo-500 duration-300">
                    <h2 class="text-lg sm:text-xl font-medium line-clamp-2">{{ $title }}</h2>
                </a>
                <div class="mt-1 inline-flex items-center gap-2">
                    <svg class="size-4 fill-yellow-500" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                        fill="#000000" viewBox="0 0 256 256">
                        <path
                            d="M234.29,114.85l-45,38.83L203,211.75a16.4,16.4,0,0,1-24.5,17.82L128,198.49,77.47,229.57A16.4,16.4,0,0,1,53,211.75l13.76-58.07-45-38.83A16.46,16.46,0,0,1,31.08,86l59-4.76,22.76-55.08a16.36,16.36,0,0,1,30.27,0l22.75,55.08,59,4.76a16.46,16.46,0,0,1,9.37,28.86Z">
                        </path>
                    </svg>
                    <span class="text-neutral-400 inline-block">{{ $rating }}</span>
                </div>

            </div>
            <div class="flex-1 text-right">
                <p class="shrink-0 {{ $listView == 'row' ? 'mt-2' : '' }}"><span class="sm:text-lg text-neutral-800 text-right">Rp.
                        {{ number_format($price, 0, ',', '.') }}</span></p>

                <div class="flex items-center justify-end gap-2 mt-4">
                    <button
                        class="w-9 h-9 sm:w-12 sm:h-12 rounded-full border border-neutral-200 hover:bg-neutral-200 duration-150 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 sm:size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </button>
                    <button
                        class="w-9 h-9 sm:w-12 sm:h-12 rounded-full border border-indigo-500 bg-indigo-500 text-white duration-150 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 sm:size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('detailKategori', $categorySlug) }}"
        class="absolute top-4 right-4 py-1 font-medium px-2 bg-white/80 backdrop-blur-md rounded-full text-sm">
        {{ $category }}
    </a>

</div>
