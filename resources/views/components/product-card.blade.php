@props(['image', 'title', 'rating', 'price', 'category', 'slug', 'categorySlug'])

<div class="border rounded-3xl overflow-hidden relative group">
    <img src="{{ $image }}" class="rounded-2xl" alt="">
    <div class="p-4">
        <div class="flex items-start justify-between gap-4">
            <div>
                <a href="" class="hover:text-indigo-500 duration-300">
                    <h2 class="text-xl font-medium line-clamp-2">{{ $title }}</h2>
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
            <p class="shrink-0"><span class="text-lg text-neutral-800">Rp.
                    {{ number_format($price, 0, ',', '.') }}</span></p>
        </div>
    </div>
    <a href="{{ $categorySlug }}"
        class="absolute top-4 right-4 py-1 font-medium px-2 bg-white/80 backdrop-blur-md rounded-full text-sm">
        {{ $category }}
    </a>
</div>
