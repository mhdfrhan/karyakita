<x-offcanvas position="right" width="96">
    <x-slot name="trigger">
        <button class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 text-neutral-500 hover:text-indigo-500">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
            </svg>
            <div
                class="absolute -top-2 -right-2 h-4 w-4 rounded-full bg-indigo-500 text-[10px] text-white flex items-center justify-center">
                {{ $totalKeranjang }}
            </div>
        </button>
    </x-slot>

    <x-slot name="content">
        <div class="p-4 h-full flex flex-col">
            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Keranjang Belanja</h2>
                <button @click="open = false" class="text-neutral-800/60 hover:text-neutral-800">
                    <svg class="w-6 h-6 hover:rotate-180 duration-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Produk List dengan Scroll -->
            <div class="flex-1 overflow-y-auto space-y-4">
                @if (!empty($keranjang))
                    @foreach ($keranjang as $k)
                        <!-- product card -->
                        <div class="flex justify-between gap-4 py-4">
                            <img src="{{ asset($k->product->images->where('is_primary', true)->first()->image_path) }}"
                                class="size-20 object-cover rounded-md" alt="{{ $k->product->name }}" />
                            <div class="mr-auto flex flex-col gap-2">
                                <p class="text-sm font-bold leading-4 text-neutral-900 line-clamp-3">
                                    {{ $k->product->name }}
                                </p>
                                <p class="text-xs leading-4 text-neutral-500">{{ $k->product->subCategory->name }}</p>
                                <!-- counter -->
                                <div class="mt-auto flex flex-col gap-1">
                                    <label for="quantity" class="sr-only">quantity</label>
                                    <div class="flex items-center gap-2">
                                        <button type="button" wire:click="decrement({{ $k->id }})"
                                            class="flex h-6 items-center justify-center border border-neutral-300 rounded-md px-2 py-2 text-neutral-600 hover:opacity-75 focus-visible:z-10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0"
                                            aria-label="subtract">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                stroke="currentColor" fill="none" stroke-width="2.5" class="size-4"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                            </svg>
                                        </button>

                                        <p>x{{ $k->quantity }}</p>

                                        <button type="button" wire:click="increment({{ $k->id }})"
                                            class="flex h-6 items-center justify-center border-neutral-300 rounded-md px-2 py-2 text-neutral-600 hover:opacity-75 focus-visible:z-10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 border"
                                            aria-label="add">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                stroke="currentColor" fill="none" stroke-width="2.5" class="size-4"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="shrink-0">
                                <span class="sr-only">item price</span>
                                <p class="text-sm font-bold text-neutral-600">Rp.
                                    {{ number_format($k->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center mt-4 text-neutral-500">Keranjang Belanja Kosong</p>
                @endif
            </div>

            <!-- Elemen di Bawah -->
            <div class="mt-auto pt-4 border-t">
                <button class="w-full bg-indigo-500 text-white py-2 px-4 rounded hover:bg-indigo-600">
                    Checkout
                </button>
            </div>
        </div>
    </x-slot>

</x-offcanvas>
