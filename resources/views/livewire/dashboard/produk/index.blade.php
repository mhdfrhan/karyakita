<div>
    @include('components.alert')
    <div class="flex items-center justify-between gap-3 flex-wrap mb-8">
        <div>
            <h1 class="text-2xl font-medium">Daftar Produk</h1>
            <div class="relative">
                <x-text-input class="mt-4 block !py-2.5 !border-neutral-300 !pl-11" type="text"
                    placeholder="cari produk disini..." wire:model.live='search' />
                <div class="absolute top-1/2 -translate-y-1/2 left-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 text-neutral-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
            </div>
        </div>
        <div>
            <a href="{{ route('tambahProduk') }}">
                <x-primary-button>Tambah Produk</x-primary-button>
            </a>
            <div class="mt-4">
                <x-select-input>
                    <option value="all">Semua Produk</option>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                    <option value="2">Draft</option>
                </x-select-input>
            </div>
        </div>
    </div>

    <div>
        <div class="w-full overflow-x-auto">
            <div class="min-w-max w-full border border-neutral-300 rounded-xl">
                @empty(!$produk->count())
                    <table class="w-full  table table-auto">
                        <thead>
                            <tr>
                                <th class="text-left text-sm uppercase py-2 px-4">#</th>
                                <th class="text-left text-sm uppercase py-2 px-4">Produk</th>
                                <th class="text-left text-sm uppercase py-2 px-4">Harga</th>
                                <th class="text-sm uppercase py-2 px-4 text-center">Penjualan</th>
                                <th class="text-sm uppercase py-2 px-4 text-center">Premium</th>
                                <th class="text-sm uppercase py-2 px-4 text-center">Status</th>
                                <th class="text-right text-sm uppercase py-2 px-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="border-t border-neutral-300">
                            @foreach ($produk as $index => $p)
                                <tr class="border-b border-neutral-300 last:border-b-0">
                                    <td class="text-sm py-3 px-4 font-semibold">{{ $produk->firstItem() + $index }}</td>
                                    <td class="text-sm py-3 px-4 inline-flex items-center gap-2">
                                        <img src="{{ asset($p->images->where('is_primary', 1)->pluck('image_path')->first()) }}"
                                            alt="{{ $p->name }}" class="aspect-video rounded-lg h-12" loading="lazy">
                                        <div>
                                            <span class="block">{{ $p->name }}</span>
                                            <span class="block text-xs text-neutral-500">{{ $p->category->name }}</span>
                                        </div>
                                    </td>
                                    <td class="text-sm py-3 px-4">Rp. {{ number_format($p->price) }}</td>
                                    <td class="text-sm py-3 px-4 text-center">{{ $p->sales->sum('quantity') }}</td>
                                    
                                    <td class="text-sm py-3 px-4 text-center">
                                        @if ($p->ads && $p->ads->first())
                                            @if ($p->ads->first()->status == 'active')
                                                @if ($p->ads->first()->end_date < now())
                                                    <span class="text-xs py-1 px-2 bg-red-200 rounded-full text-red-800">
                                                        Tidak Aktif
                                                    </span>
                                                    <a href="{{ route('editProduk', $p->slug) }}"
                                                        class="text-xs text-indigo-600 hover:underline block mt-1">
                                                        Perpanjang Sekarang
                                                    </a>
                                                @else
                                                    <span class="text-xs py-1 px-2 bg-green-200 rounded-full text-green-800">
                                                        Aktif
                                                    </span>
                                                    <span class="text-xs text-neutral-500 block mt-1">
                                                        Berakhir:
                                                        {{ \Carbon\Carbon::parse($p->ads->first()->end_date)->translatedFormat('d M Y') }}
                                                    </span>
                                                @endif
                                            @elseif ($p->ads->first()->status == 'pending')
                                                <span class="text-xs py-1 px-2 bg-red-200 rounded-full text-red-800">
                                                    Menunggu Pembayaran
                                                </span>
                                                <a href="{{ route('bayarProduk', strtolower($p->ads->first()->invoice_number)) }}"
                                                    class="text-xs text-indigo-600 hover:underline block mt-1">
                                                    Bayar Sekarang
                                                </a>
                                            @endif
                                        @else
                                            <span class="text-xs py-1 px-2 bg-red-200 rounded-full text-red-800">
                                                Tidak Aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-right py-3 px-4">
                                        <div class="flex items-center justify-end gap-2">
                                            {{-- edit --}}
                                            <a href="{{ route('editProduk', $p->slug) }}"
                                                class="hover:text-green-600 duration-1500">
                                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 256 256">
                                                    <rect width="256" height="256" fill="none" />
                                                    <path
                                                        d="M92.69,216H48a8,8,0,0,1-8-8V163.31a8,8,0,0,1,2.34-5.65L165.66,34.34a8,8,0,0,1,11.31,0L221.66,79a8,8,0,0,1,0,11.31L98.34,213.66A8,8,0,0,1,92.69,216Z"
                                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="16" />
                                                    <line x1="136" y1="64" x2="192" y2="120"
                                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="16" />
                                                </svg>
                                            </a>

                                            {{-- preview --}}
                                            <button type="button" class="hover:text-indigo-600 duration-1500">
                                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 256 256">
                                                    <rect width="256" height="256" fill="none" />
                                                    <path
                                                        d="M128,56C48,56,16,128,16,128s32,72,112,72,112-72,112-72S208,56,128,56Z"
                                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="16" />
                                                    <circle cx="128" cy="128" r="40" fill="none"
                                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="16" />
                                                </svg>
                                            </button>

                                            {{-- delete --}}
                                            <button type="button" class="hover:text-red-600 duration-1500"
                                                wire:click='setDelete("{{ $p->slug }}")' x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-product-deletion')">
                                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 256 256">
                                                    <rect width="256" height="256" fill="none" />
                                                    <line x1="216" y1="56" x2="40" y2="56"
                                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="16" />
                                                    <line x1="104" y1="104" x2="104" y2="168"
                                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="16" />
                                                    <line x1="152" y1="104" x2="152" y2="168"
                                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="16" />
                                                    <path d="M200,56V208a8,8,0,0,1-8,8H64a8,8,0,0,1-8-8V56" fill="none"
                                                        stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="16" />
                                                    <path d="M168,56V40a16,16,0,0,0-16-16H104A16,16,0,0,0,88,40V56"
                                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center py-2 text-neutral-500">Tidak ada produk</div>
                @endempty
            </div>
        </div>


        <div>
            {{ $produk->links('vendor.livewire.tailwind') }}
        </div>

        {{-- modal delete product --}}
        <x-modal align="center" maxWidth="lg" name="confirm-product-deletion" :show="$errors->isNotEmpty()" focusable>
            <form wire:submit="deleteProduct" class="p-6">

                <h2 class="text-lg font-medium text-gray-900">
                    Apakah kamu yakin ingin menghapus produk {{ $setDeleteName }}?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Ketika produk dihapus, semua data akan dihapus secara permanen. ') }}
                </p>

                <div class="mt-6">
                </div>

                <div class="mt-6 flex justify-end">
                    <x-border-button x-on:click="$dispatch('close')">
                        {{ __('Batal') }}
                    </x-border-button>

                    <x-danger-button class="ms-3">
                        {{ __('Hapus Produk') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    </div>
</div>
