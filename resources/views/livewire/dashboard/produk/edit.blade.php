<div>
    @include('components.alert')
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/cropper.css') }}">
        <style>
            .image-preview {
                width: 150px;
                height: 150px;
                object-fit: cover;
                border-radius: 8px;
            }

            .modal-content {
                background: white;
                padding: 20px;
                border-radius: 12px;
                width: 90%;
                max-width: 600px;
                max-height: 90vh;
                overflow-y: auto;
            }
        </style>
    @endpush


    <div class="mb-8 p-6 bg-white shadow-xl shadow-neutral-200 rounded-2xl">
        <div class="flex items-center justify-between gap-3 flex-wrap">
            <h3 class="text-lg font-semibold">Status Produk</h3>
            <p class="text-neutral-500 text-sm">Dibuat pada {{ $produk->created_at->format('d M Y') }}</p>
        </div>
        <div class="mt-4">
            <div class="flex justify-between gap-3">
                <div>
                    <p class="text-neutral-500 text-sm">Status</p>
                    @if ($produk->admin_approved == 0)
                        <div class="bg-orange-200 text-orange-800 mt-1 px-2 py-1 rounded-lg text-xs">
                            Menunggu Persetujuan Admin
                        </div>
                    @elseif($produk->admin_approved == -1)
                        <div class="bg-red-200 text-red-800 mt-1 px-2 py-1 rounded-lg text-xs">
                            Produkmu ditolak oleh Admin
                        </div>
                    @else
                        <div class="bg-green-200 text-green-800 mt-1 px-2 py-1 rounded-lg text-xs inline-block">
                            Publish
                        </div>

                        <div class="mt-2">
                            <p class="text-neutral-500 text-sm">Iklan Produk</p>
                            @if ($produk->ads && $produk->ads->first())
                                @if ($produk->ads->first()->status == 'active')
                                    @if ($produk->ads->first()->end_date < now())
                                        <div
                                            class="bg-red-200 text-red-800 mt-1 px-2 py-1 rounded-lg text-xs  inline-block">
                                            Tidak Aktif
                                        </div>
                                    @else
                                        <div
                                            class="bg-green-200 text-green-800 mt-1 px-2 py-1 rounded-lg text-xs inline-block">
                                            Aktif sampai
                                            {{ \Carbon\Carbon::parse($produk->ads->first()->end_date)->translatedFormat('d M Y') }}
                                        </div>
                                    @endif
                                @elseif ($produk->ads->first()->status == 'pending')
                                    <div class="bg-red-200 text-red-800 mt-1 px-2 py-1 rounded-lg text-xs">
                                        Menunggu Pembayaran
                                    </div>
                                    <a href="{{ route('bayarProduk', strtolower($produk->ads->first()->invoice_number)) }}"
                                        class="text-xs text-indigo-600 hover:underline block mt-1">
                                        Bayar Sekarang
                                    </a>
                                @endif
                            @else
                                <div class="bg-red-200 text-red-800 mt-1 px-2 py-1 rounded-lg text-xs inline-block">
                                    Tidak ada iklan
                                </div>
                            @endif
                        </div>
                    @endif

                    @if ($produk->admin_approved == -1)
                        <p class="text-neutral-500 text-sm mt-4">Pesan dari Admin</p>
                        <div class="mt-1">
                            <p class="text-sm">{{ $produk->admin_note }}</p>
                        </div>
                    @endif
                </div>
                <div>
                    <div class="text-center">
                        <p class="text-neutral-500 text-sm">Kategori</p>
                        <p class="text-sm">{{ $produk->category->name }}</p>
                    </div>
                    <div class="mt-2 text-center">
                        <p class="text-neutral-500 text-sm">Sub Kategori</p>
                        <p class="text-sm">{{ $produk->subCategory->name }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="mb-2">
                        <p class="text-neutral-500 text-sm">Jumlah terjual</p>
                        <p class="text-sm">{{ $produk->sales->sum('quantity') }}</p>
                    </div>
                    <div>
                        <p class="text-neutral-500 text-sm">Total Pendapatan</p>
                        <p class="text-sm">Rp {{ number_format($produk->sales->sum('price')) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (
        !$produk->ads ||
            !$produk->ads->first() ||
            $produk->ads->first()->status == 'pending' ||
            $produk->ads->first()->end_date < now())
        <div class="mb-8 text-right">
            <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'buy-product-ads')">
                @if ($produk->ads && $produk->ads->first())
                    @if ($produk->ads->first()->end_date < now())
                        Perpanjang Iklan
                    @endif
                @else
                    Iklankan Produkmu
                @endif
            </x-primary-button>
        </div>

        <x-modal align="center" maxWidth="5xl" name="buy-product-ads" :show="$errors->isNotEmpty()" focusable>
            <form wire:submit.prevent="submitPayment" class="p-6">

                <h2 class="text-lg font-medium text-neutral-900">
                    {{ __('Pilih Paket Iklan Untuk Produk Kamu') }}
                </h2>

                <p class="mt-1 text-sm text-neutral-600">
                    {{ __('Harga setiap iklan bervariasi, mulai dari Rp. 30.000/15 hari. Silahkan pilih paket pembayaran dibawah ini') }}
                </p>

                <div class="mt-6 flex justify-between -mx-2">
                    <div class="w-1/3 px-2">
                        <label
                            class="p-4 border rounded-2xl has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-500 has-[:checked]:text-white duration-150 block cursor-pointer">
                            <input type="radio" id="15days" class="sr-only peer" name="service-price"
                                value="15" wire:model.live='productAds'>
                            <h3 class="text-lg font-semibold text-center mb-4">Paket 15 Hari</h3>
                            <div>
                                <h1 class="text-center text-2xl font-semibold">Rp. 30.000</h1>
                            </div>
                        </label>
                    </div>
                    <div class="w-1/3 px-2">
                        <label
                            class="p-4 border rounded-2xl has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-500 has-[:checked]:text-white duration-150 block cursor-pointer">
                            <input type="radio" id="20days" class="sr-only peer" name="service-price"
                                value="20" wire:model.live='productAds'>
                            <h3 class="text-lg font-semibold text-center mb-4">Paket 20 Hari</h3>
                            <div>
                                <h1 class="text-center text-2xl font-semibold">Rp. 50.000</h1>
                            </div>
                        </label>
                    </div>
                    <div class="w-1/3 px-2">

                        <label
                            class="p-4 border rounded-2xl has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-500 has-[:checked]:text-white duration-150 block cursor-pointer">
                            <input type="radio" id="1month" class="sr-only peer" name="service-price"
                                value="30" wire:model.live='productAds'>
                            <h3 class="text-lg font-semibold text-center mb-4">Paket 1 Bulan</h3>
                            <div>
                                <h1 class="text-center text-2xl font-semibold">Rp. 75.000</h1>
                            </div>
                        </label>
                    </div>
                </div>

                <x-input-error :messages="$errors->get('productAds')" class="mt-2 text-red-300" />


                <div class="mt-6 flex justify-end">
                    <x-border-button x-on:click="$dispatch('close')">
                        {{ __('Batal') }}
                    </x-border-button>

                    <x-primary-button class="ms-3">
                        {{ __('Bayar sekarang') }}
                    </x-primary-button>
                </div>
            </form>
        </x-modal>
    @endif

    <form wire:submit.prevent="submit" class="flex flex-wrap -mx-4">
        <div class="w-full lg:w-1/2 px-4">
            <div class="p-4 md:p-6 bg-white shadow-2xl shadow-neutral-200 rounded-2xl">
                <div class="mb-6">
                    <h4 class="text-lg font-semibold">Informasi Produk</h4>
                </div>
                <div class="grid sm:grid-cols-2 gap-6">
                    <div>
                        <x-input-label class="text-neutral-500">Kategori*</x-input-label>
                        <x-select-input wire:model.live='kategori' class="!rounded-full !border-neutral-300"
                            :disabled="!$this->isProductApproved()">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategoriList as $k)
                                <option value="{{ $k->uuid }}">{{ $k->name }}</option>
                            @endforeach
                        </x-select-input>
                        <x-input-error :messages="$errors->get('kategori')" class="mt-2 text-red-300" />
                    </div>
                    <div>
                        <x-input-label class="text-neutral-500">Sub Kategori*</x-input-label>
                        <x-select-input wire:model.live='subKategori' class="!rounded-full !border-neutral-300"
                            :disabled="!$this->isProductApproved()">
                            <option value="">Pilih Sub Kategori</option>
                            @foreach ($subKategoriList as $k)
                                <option value="{{ $k->uuid }}">{{ $k->name }}</option>
                            @endforeach
                        </x-select-input>
                        <x-input-error :messages="$errors->get('subKategori')" class="mt-2 text-red-300" />
                    </div>
                </div>
                <div class="mt-6 ">
                    <x-input-label class="text-neutral-500">Nama Produk*</x-input-label>
                    <x-text-input wire:model.live='nama' class="border-neutral-300" maxlength="50"
                        :disabled="!$this->isProductApproved()" />
                    <div class="flex items-center justify-between gap-2">
                        <x-input-error :messages="$errors->get('nama')" class="mt-2 text-red-300" />
                        <p class="text-sm text-neutral-400 text-right">{{ strlen($nama) }}/50 Karakter. Minimal 10
                            karakter</p>
                    </div>
                </div>
                <div class="mt-6" wire:ignore>
                    <x-input-label class="text-neutral-500 mb-1">Deskripsi Produk*</x-input-label>
                    <div id="{{ $qldeskripsi }}">{!! $value !!}</div>
                </div>
                <div class="mt-6 flex items-center -mx-3">
                    <div class="w-full md:w-3/4 md:px-3">
                        <x-input-label class="text-neutral-500">Preview URL (Optional)</x-input-label>
                        <x-text-input wire:model.live='preview' class="border-neutral-300" :disabled="!$this->isProductApproved()" />
                    </div>
                    <div class="w-full md:w-1/4 md:px-3">
                        <x-input-label class="text-neutral-500">Jumlah Halaman*</x-input-label>
                        <x-text-input wire:model.live='halaman' class="border-neutral-300" :disabled="!$this->isProductApproved()" />
                    </div>
                </div>
                <div class="mt-6">
                    <x-input-label class="text-neutral-500">Tags*</x-input-label>
                    <div class="relative">
                        <x-text-input wire:model.live='tagInput' wire:keydown.enter.prevent="addTag"
                            wire:keydown.comma.prevent="addTag" class="border-neutral-300"
                            placeholder="Ketik tag dan tekan enter untuk menambahkan tag" :disabled="!$this->isProductApproved()" />

                        <div class="mt-2 flex flex-wrap gap-2">
                            @foreach ($tags as $index => $tag)
                                <span
                                    class="inline-flex items-center gap-1 bg-indigo-100 text-indigo-700 rounded-full px-3 py-1 text-sm">
                                    {{ $tag }}
                                    <button type="button" wire:click="removeTag({{ $index }})"
                                        class="text-indigo-700 hover:text-indigo-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('tags')" class="mt-2 text-red-300" />
                </div>
                <div class="mt-6">
                    <div class="mb-4 text-sm text-neutral-500">
                        <p>Versi sebelumnya</p>
                        <ul class="list-disc list-inside">
                            @foreach ($produk->versions as $index => $version)
                                <li>{{ $version->version }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <x-input-label class="text-neutral-500">Versi Produk Baru*</x-input-label>
                    <x-text-input type="number" wire:model.live='version' class="border-neutral-300 max-w-32"
                        :disabled="!$this->isProductApproved()" />
                    <small class="text-sm text-neutral-400">Contoh:
                        {{ $produk->versions->last()->version + 1 }}.0</small>
                    <x-input-error :messages="$errors->get('version')" class="mt-2 text-red-300" />
                </div>
            </div>
            <div class="p-4 md:p-6 bg-white shadow-2xl shadow-neutral-200 rounded-2xl mt-6">
                <div>
                    <div class="mb-4">
                        <x-input-label class="text-neutral-500">Fitur Produk* (Min. 3, Maks. 5)</x-input-label>
                    </div>

                    <div class="space-y-4">
                        @foreach ($features as $index => $feature)
                            <div class="bg-neutral-50/50 p-4 rounded-xl border border-neutral-200"
                                wire:key="feature-{{ $index }}">
                                <div class="flex items-center justify-between mb-4">
                                    <h6 class="font-medium">Fitur {{ $index + 1 }}</h6>
                                    @if ($index > 0)
                                        <button type="button" wire:click="removeFeature({{ $index }})"
                                            class="text-red-500 hover:text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                                <div>
                                    <div class="mb-2">
                                        <x-input-label class="text-neutral-500">Judul</x-input-label>
                                        <x-text-input wire:model.live="features.{{ $index }}.title"
                                            class="border-neutral-300" :disabled="!$this->isProductApproved()" />
                                        <x-input-error :messages="$errors->get('features.' . $index . '.title')" class="mt-1" />
                                    </div>
                                    <div>
                                        <x-input-label class="text-neutral-500">Deskripsi</x-input-label>
                                        <x-textarea rows="3"
                                            wire:model.live="features.{{ $index }}.description"
                                            class="mt-1 block w-full border-neutral-300 placeholder:text-neutral-300"
                                            :disabled="!$this->isProductApproved()">
                                        </x-textarea>
                                        <x-input-error :messages="$errors->get('features.' . $index . '.description')" class="mt-1" />
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4 text-right">
                        @if (count($features) < 5)
                            <x-primary-button type="button" wire:click="addFeature"
                                class="inline-flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Tambah Fitur
                            </x-primary-button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full lg:w-1/2 px-4">
            <div class="p-4 md:p-6 bg-white shadow-2xl shadow-neutral-200 rounded-2xl">
                <div class="mb-6">
                    <h4 class="text-lg font-semibold">Gambar Produk</h4>
                </div>

                <div class="border p-3 rounded-xl mb-4">
                    @foreach ($images as $index => $image)
                        <div
                            class="flex items-center justify-between gap-3 border-b mb-3 pb-3 last:border-b-0 last:mb-0 last:pb-0">
                            <div>
                                <h3>Gambar {{ $index + 1 }}{{ $index === 0 ? '*' : '' }}</h3>
                                @if ($image['preview'])
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $image['preview'] }}" alt="Preview"
                                            class="aspect-video rounded-lg h-16">
                                        <div class="text-pretty">
                                            <p>{{ $image['name'] }}</p>
                                            <p>{{ $this->formatSize($image['size']) }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="flex items-center gap-2 bg-white pl-4">
                                <input type="file" id="image-upload-{{ $index }}"
                                    wire:model="images.{{ $index }}.file"
                                    onchange="openCropper(event, {{ $index }})" class="hidden"
                                    accept="image/*" @if (!$this->isProductApproved()) disabled @endif>
                                @if ($this->isProductApproved())
                                    <div class="flex items-center gap-2">
                                        @if ($image['preview'])
                                            <button type="button" wire:click="removeImage({{ $index }})"
                                                class="text-red-500 hover:text-red-600 p-1.5 bg-neutral-100 rounded-full">
                                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 256 256">
                                                    <rect width="256" height="256" fill="none" />
                                                    <line x1="216" y1="56" x2="40"
                                                        y2="56" fill="none" stroke="currentColor"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="16" />
                                                    <line x1="104" y1="104" x2="104"
                                                        y2="168" fill="none" stroke="currentColor"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="16" />
                                                    <line x1="152" y1="104" x2="152"
                                                        y2="168" fill="none" stroke="currentColor"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="16" />
                                                    <path d="M200,56V208a8,8,0,0,1-8,8H64a8,8,0,0,1-8-8V56"
                                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="16" />
                                                    <path d="M168,56V40a16,16,0,0,0-16-16H104A16,16,0,0,0,88,40V56"
                                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="16" />
                                                </svg>
                                            </button>
                                        @endif


                                        <x-border-button type="button"
                                            onclick="document.getElementById('image-upload-{{ $index }}').click()">
                                            {{ $image['preview'] ? 'Ubah' : 'Unggah' }}
                                        </x-border-button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    @if (count($images) < 10)
                        <div class="mt-4 text-right">
                            <x-primary-button type="button" wire:click="addImage"
                                class="inline-flex items-center gap-2">
                                Tambah Gambar
                            </x-primary-button>
                        </div>
                    @endif
                </div>

                <div class="border p-3 rounded-xl">
                    <div class="flex items-center gap-1 text-orange-400 text-sm border-b pb-3 mb-3">
                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                        </svg>
                        <p class="tracking-wide">Ketentuan Gambar</p>
                    </div>
                    <ul class="ml-4 list-decimal text-xs text-neutral-400">
                        <li>Unggah minimal 1 gambar terbaik yang berhubungan dengan produk yang Anda tawarkan.</li>
                        <li>Ukuran gambar tidak boleh lebih besar dari 2MB.</li>
                        <li>Format gambar yang diizinkan: JPEG, PNG, dan JPG.</li>
                    </ul>
                </div>
            </div>
            <div class="p-4 md:p-6 bg-white shadow-2xl shadow-neutral-200 rounded-2xl mt-6">
                <div class="mb-6">
                    <h4 class="text-lg font-semibold">Harga Produk</h4>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-full">
                        <x-input-label class="text-neutral-500">Harga Sebelum Diskon*</x-input-label>
                        <x-text-input type="number" wire:model.live='oldprice' class="border-neutral-300"
                            :disabled="!$this->isProductApproved()" />
                        <x-input-error :messages="$errors->get('oldprice')" class="mt-2 text-red-300" />
                    </div>
                    <div class="w-full">
                        <x-input-label class="text-neutral-500">Harga Setelah Diskon*</x-input-label>
                        <x-text-input type="number" wire:model.live='price' class="border-neutral-300"
                            :disabled="!$this->isProductApproved()" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2 text-red-300" />
                    </div>
                </div>
            </div>
            <div class="p-4 md:p-6 bg-white shadow-2xl shadow-neutral-200 rounded-2xl mt-6">
                <div class="mb-6">
                    <h4 class="text-lg font-semibold">Upload File Produk</h4>
                </div>
                <div>
                    @if ($produk->admin_approved > 0)
                        <x-input-label class="text-neutral-500">Pilih File</x-input-label>
                        <div id="upload-area"
                            class="flex w-full max-w-xl text-center flex-col gap-1 group rounded-xl {{ $uploadFile ? '' : 'cursor-not-allowed bg-red-200/60' }}">
                            <div
                                class="flex w-full flex-col items-center justify-center gap-2 rounded-xl border-[1.5px] border-dashed p-8">
                                <label
                                    class="font-medium text-neutral-700 {{ $uploadFile ? 'cursor-pointer hover:underline ' : 'cursor-not-allowed' }}">
                                    <input type="file" class="sr-only" id="file-input" accept=".zip,.rar,.7z"
                                        {{ $uploadFile ? '' : 'disabled' }} />
                                    Browse
                                </label>
                                <span class="text-neutral-500">atau drag and drop disini</span>
                                <small class="text-neutral-400">Zip, rar, 7z</small>
                            </div>
                        </div>
                    @else
                        @if ($produk->admin_approved == 0)
                            <p class="text-neutral-400">Produk belum disetujui oleh admin</p>
                        @elseif($produk->admin_approved == -1)
                            <p class="text-neutral-400">Produk ditolak oleh admin</p>
                        @endif
                    @endif
                    <div id="upload-progress" class="mt-2" style="display: none;">
                        <div class="bg-neutral-200 rounded-full h-2.5">
                            <div id="progress-bar" class="bg-indigo-500 h-2.5 rounded-full" style="width: 0%;"></div>
                        </div>
                        <p id="progress-text" class="text-sm text-neutral-500 mt-1">0% Terunggah</p>
                    </div>
                </div>
                <div class="border p-3 rounded-xl mt-4">
                    <div class="flex items-center gap-1 text-orange-400 text-sm border-b pb-3 mb-3">
                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                        </svg>
                        <p class="tracking-wide">Ketentuan File Produk</p>
                    </div>
                    <ul class="ml-4 list-decimal text-xs text-neutral-400">
                        <li>File sudah harus dikompress sebelum diunggah dalam bentuk zip.</li>
                        <li>Ukuran file tidak boleh lebih besar dari 500MB.</li>
                        <li>Jika ukuran lebih dari 500MB, mohon diunggah menggunakan link platform pihak ketiga (Google
                            Drive, Mediafire, dll).</li>
                    </ul>
                </div>
            </div>

            <div class="mt-6">
                <x-primary-button type="{{ !$this->isProductApproved() ? 'button' : 'submit' }}"
                    class="w-full {{ !$this->isProductApproved() ? 'bg-indigo-500/60 cursor-not-allowed hover:bg-indigo-500/60 focus:!scale-100' : '' }}">
                    {{ __('Update Produk') }}
                </x-primary-button>
            </div>
        </div>
    </form>
    <!-- Modified Cropper Modal -->
    <div id="cropModal"
        class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center hidden"
        wire:ignore>
        <div class="bg-white p-4 rounded-lg max-w-xl max-h-[50vh] overflow-auto">
            <h1 class="dashboard-title mb-4">{{ __('Crop Image') }}</h1>
            <div class="mb-4">
                <img id="cropImage" src="" alt="Gambar untuk dipotong">
            </div>
            <div class="flex justify-end gap-3">
                <button class="ml-2 bg-rose-200 text-rose-800 px-4 py-2 rounded-lg" onclick="closeCropModal()">
                    {{ __('Cancel') }}
                </button>
                <button class="bg-blue-600 shadow-lg shadow-blue-600/30 text-white px-4 py-2 rounded-lg"
                    onclick="cropImage()">
                    {{ __('Crop & Save') }}
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
        <script src="{{ asset('js/cropper.min.js') }}"></script>
        <script>
            let cropper;
            let currentIndex;
            let currentFileName;

            const openCropper = (event, index) => {
                const file = event.target.files[0];
                const reader = new FileReader();

                reader.onload = (e) => {
                    const image = document.getElementById('cropImage');
                    image.src = e.target.result;

                    if (cropper) {
                        cropper.destroy();
                    }

                    cropper = new Cropper(image, {
                        aspectRatio: 16 / 9,
                        viewMode: 1,
                    });

                    currentIndex = index;
                    currentFileName = file.name;
                    document.getElementById('cropModal').classList.remove('hidden');
                };

                reader.readAsDataURL(file);
            };

            const cropImage = () => {
                const canvas = cropper.getCroppedCanvas();

                canvas.toBlob((blob) => {
                    const originalNameWithoutExtension = currentFileName.split('.').slice(0, -1).join('.');
                    const croppedFileName = `${originalNameWithoutExtension}.jpg`;

                    const file = new File([blob], croppedFileName, {
                        type: 'image/jpeg'
                    });

                    @this.upload('images.' + currentIndex + '.file', file, (uploadedFilename) => {
                        // Update preview setelah berhasil diunggah
                        @this.set('images.' + currentIndex + '.preview', URL.createObjectURL(file));
                        document.getElementById('cropModal').classList.add('hidden');
                    }, () => {
                        // Error callback
                    }, (event) => {
                        // Progress callback
                    });
                }, 'image/jpeg');
            };

            const closeCropModal = () => {
                document.getElementById('cropModal').classList.add('hidden');
            };

            document.addEventListener('DOMContentLoaded', () => {
                const quill = new Quill('#{{ $qldeskripsi }}', {
                    theme: 'snow'
                });

                const isApproved = {{ $produk->admin_approved }};
                quill.enable(isApproved > 0);

                quill.on('text-change', function() {
                    let value = document.getElementsByClassName('ql-editor')[0].innerHTML;
                    @this.set('deskripsi', value)
                });
            });

            var r = new Resumable({
                target: '{{ route('produk.upload') }}',
                query: {
                    _token: '{{ csrf_token() }}'
                },
                // chunkSize: 1 * 1024 * 1024, // 1MB
                // simultaneousUploads: 1,
                fileType: ['zip', 'rar', '7z'],
                testChunks: false,
                // throttleProgress: 1000,
                throttleProgressCallback: 1,
                // forceChunkSize: true,
                headers: {
                    'Accept': 'application/json'
                }
            });

            r.assignBrowse(document.getElementById('file-input'));
            r.on('fileAdded', function(file) {
                document.getElementById('upload-progress').style.display = 'block';
                r.upload();
            });

            r.on('fileProgress', function(file) {
                var progress = Math.floor(file.progress() * 100);
                document.getElementById('progress-bar').style.width = progress + '%';
                document.getElementById('progress-text').innerText = progress + '% Terunggah';
            });

            r.on('fileSuccess', function(file, response) {
                console.log('File uploaded successfully:', response);
                // Lakukan tindakan setelah upload berhasil
                try {
                    response = JSON.parse(response);
                    @this.dispatch('notify', {
                        message: 'Upload file berhasil',
                        type: 'success'
                    });
                } catch (e) {
                    console.error('Parsing error:', e);
                }
            });

            r.on('fileError', function(file, response) {
                console.error('File upload failed:', response);
                try {
                    response = JSON.parse(response);
                    @this.dispatch('notify', {
                        message: "Terjadi kesalahan saat mengunggah file, silahkan refresh halaman ini",
                        type: 'error'
                    });
                } catch (e) {
                    console.error('Parsing error:', e);
                }
            });
        </script>
    @endpush
</div>
