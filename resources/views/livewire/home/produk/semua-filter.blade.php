<div class="mb-8 flex flex-wrap items-center justify-between gap-3 gap-y-6">
    <div class="flex flex-wrap items-center gap-3">
        @php
            $kategoriList = App\Models\Categories::all();
        @endphp
        <label for="semua"
            class="bg-neutral-200/50 py-2 px-4 rounded-full text-neutral-500 hover:bg-neutral-200 duration-150 text-sm cursor-pointer {{ $kategori == 'semua' ? '!bg-indigo-500 text-white' : '' }}">
            <input type="radio" id="semua" name="kategori" wire:model.live='kategori' value="semua" class="hidden">
            <span>Semua</span>
        </label>
        @foreach ($kategoriList as $k)
            <label for="{{ $k->id }}"
                class="bg-neutral-200/50 py-2 px-4 rounded-full text-neutral-500 hover:bg-neutral-200 duration-150 text-sm cursor-pointer {{ $kategori == $k->id ? '!bg-indigo-500 text-white' : '' }}">
                <input type="radio" id="{{ $k->id }}" name="kategori" wire:model.live='kategori'
                    value="{{ $k->id }}" class="hidden">
                <span>{{ $k->name }}</span>
            </label>
        @endforeach
        
    </div>
    <div class="flex items-center gap-3">
        <div class="inline-flex items-center gap-2">
            <x-select-input wire:model.live='sortOrder'>
                <option value="terbaru">Terbaru</option>
                <option value="terlama">Terlama</option>
                <option value="terpopuler">Terpopuler</option>
                <option value="termurah">Termurah</option>
            </x-select-input>
        </div>
        <div class="inline-flex items-center gap-2">
            {{-- grid --}}
            <button wire:click="$set('viewType', 'grid')">
                <svg class="size-5 {{ $viewType === 'grid' ? 'fill-indigo-500' : '' }}"
                    xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000"
                    viewBox="0 0 256 256">
                    <path
                        d="M104,40H56A16,16,0,0,0,40,56v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,104,40Zm0,64H56V56h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,200,40Zm0,64H152V56h48v48Zm-96,32H56a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,104,136Zm0,64H56V152h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,200,136Zm0,64H152V152h48v48Z">
                    </path>
                </svg>
            </button>

            {{-- row --}}
            <button wire:click="$set('viewType', 'row')">
                <svg class="size-5 {{ $viewType === 'row' ? 'fill-indigo-500' : '' }}"
                    xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000"
                    viewBox="0 0 256 256">
                    <path
                        d="M208,136H48a16,16,0,0,0-16,16v40a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V152A16,16,0,0,0,208,136Zm0,56H48V152H208v40Zm0-144H48A16,16,0,0,0,32,64v40a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V64A16,16,0,0,0,208,48Zm0,56H48V64H208v40Z">
                    </path>
                </svg>
            </button>
        </div>
    </div>
</div>
