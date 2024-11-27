<x-main-layout>
    @include('components.alert')
    <x-slot name="title">{{ $title }}</x-slot>

    <section class="pb-10 lg:pb-20">
        <div class="max-w-7xl mx-auto px-5">
            <div class="border rounded-2xl p-4">
                <div class="flex flex-wrap justify-between items-center gap-3">
                    <div
                        class="bg-gradient-to-br from-indigo-500 to-indigo-400 text-white rounded-lg px-4 inline-block py-1">
                        #
                        {{ $order['invoice_number'] }}
                    </div>
                    <div>
                        <h5 class="font-medium text-lg text-right inline-flex gap-2 items-center">
                            Rp. {{ number_format($order['total_amount'], 0, ',', '.') }}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                            </svg>
                        </h5>
                    </div>
                </div>
                <div class="mt-6  flex flex-wrap -mx-4">
                    @foreach ($order['items'] as $item)
                        @php
                            $productId = \App\Models\Products::where('id', $item['products_id'])
                                ->pluck('id')
                                ->first();
                            $image = \App\Models\ProductImages::where('products_id', $productId)
                                ->where('is_primary', true)
                                ->pluck('image_path')
                                ->first();
                        @endphp
                        <div class="w-full md:w-1/2 md:px-4">
                            <div class="flex gap-3 h-full">
                                <img src="{{ asset($image) }}" alt="{{ $item['name'] }}" class="max-h-28 rounded-xl"
                                    loading='lazy'>
                                <div class="h-full flex flex-col py-2">
                                    <h4 class="font-medium text-xl line-clamp-2">{{ $item['name'] }}</h4>
                                    <p class="text-neutral-500 mt-1">qty: x{{ $item['quantity'] }}</p>
                                    <p class="text-neutral-800 text-lg mt-auto">Rp.
                                        {{ number_format($item['price'], 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class=" bg-neutral-200/50 rounded-2xl">
                    <livewire:home.produk.checkout :order="$order">
                </div>
            </div>
        </div>
    </section>
</x-main-layout>
