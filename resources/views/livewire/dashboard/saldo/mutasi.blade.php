<div>
    <div class="flex items-center justify-between gap-3 flex-wrap mb-8">
        <div>
            <h1 class="text-2xl font-medium">Daftar Mutasi</h1>
            <div class="relative">
                <x-text-input class="mt-4 block !py-2.5 !border-neutral-300 !pl-11" type="text"
                    placeholder="cari disini..." wire:model.live='search' />
                <div class="absolute top-1/2 -translate-y-1/2 left-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 text-neutral-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <div class="flex items-center justify-between gap-2 flex-wrap mb-8">
            <x-select-input wire:model.live="type" class="!inline-block !w-auto">
                <option value="all">Tipe Mutasi</option>
                <option value="add">Pemasukan</option>
                <option value="remove">Pengeluaran</option>
            </x-select-input>
            <div>
                <div class="flex items-center gap-3">
                    <div>
                        <span class="text-sm text-neutral-500">Dari</span>
                        <x-text-input type="date" wire:model.live="startDate"
                            class="!border-neutral-300 !rounded-lg !py-2" />
                    </div>
                    <div>
                        <span class="text-sm text-neutral-500">Sampai</span>
                        <x-text-input type="date" wire:model.live="endDate"
                            class="!border-neutral-300 !rounded-lg !py-2" />
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full overflow-x-auto">
            <div class="min-w-max w-full border border-neutral-300 rounded-xl">
                @empty(!$mutations->count())
                    <table class="w-full table table-auto">
                        <thead>
                            <tr>
                                <th class="text-left text-sm uppercase py-2 px-4">#</th>
                                <th class="text-left text-sm uppercase py-2 px-4">Tanggal</th>
                                <th class="text-left text-sm uppercase py-2 px-4">Keterangan</th>
                                <th class="text-left text-sm uppercase py-2 px-4">Tipe</th>
                                <th class="text-right text-sm uppercase py-2 px-4">Nominal</th>
                            </tr>
                        </thead>
                        <tbody class="border-t border-neutral-300">
                            @foreach ($mutations as $index => $mutation)
                                <tr class="border-b border-neutral-300 last:border-b-0">
                                    <td class="text-sm py-3 px-4 font-semibold">{{ $mutations->firstItem() + $index }}</td>
                                    <td class="text-sm py-3 px-4">{{ $mutation->created_at->translatedFormat('d M Y H:i') }}
                                    </td>
                                    <td class="text-sm py-3 px-4">
                                        <div class="max-w-md line-clamp-2">
                                            {{ $mutation->description }}
                                        </div>
                                    </td>
                                    <td class="text-sm py-3 px-4">
                                        @if ($mutation->type == 'add')
                                            <span class="text-xs py-1 px-2 bg-green-200 rounded-full text-green-800">
                                                Pemasukan
                                            </span>
                                        @else
                                            <span class="text-xs py-1 px-2 bg-red-200 rounded-full text-red-800">
                                                Pengeluaran
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-sm py-3 px-4 text-right">
                                        Rp {{ number_format($mutation->amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center py-2 text-neutral-500">Tidak ada data mutasi</div>
                @endempty
            </div>
        </div>

        @if ($mutations->hasPages())
            <div class="mt-4">
                {{ $mutations->links() }}
            </div>
        @endif
    </div>
</div>
