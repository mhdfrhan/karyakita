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

    <form wire:submit.prevent="submit" class="flex flex-wrap -mx-4">
        <div class="w-full lg:w-[60%] px-4">
            <div class="p-4 md:p-6 bg-white shadow-xl shadow-neutral-200 rounded-2xl">
                <div class="mb-6">
                    <h4 class="text-lg font-semibold">Informasi Jasa</h4>
                </div>

                <div class="grid sm:grid-cols-3 gap-6">
                    <div>
                        <x-input-label class="text-neutral-500">Tipe Kategori*</x-input-label>
                        <x-select-input wire:model.live='tipeKategori' class="!rounded-full !border-neutral-300">
                            <option value="">Pilih Tipe</option>
                            @foreach ($tipeKategoriList as $tk)
                                <option value="{{ $tk->uuid }}">{{ $tk->name }}</option>
                            @endforeach
                        </x-select-input>
                        <x-input-error :messages="$errors->get('tipeKategori')" class="mt-2 text-red-300" />
                    </div>
                    <div>
                        <x-input-label class="text-neutral-500">Kategori*</x-input-label>
                        <x-select-input wire:model.live='kategori' class="!rounded-full !border-neutral-300">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategoriList as $k)
                                <option value="{{ $k->uuid }}">{{ $k->name }}</option>
                            @endforeach
                        </x-select-input>
                        <x-input-error :messages="$errors->get('kategori')" class="mt-2 text-red-300" />
                    </div>
                    <div>
                        <x-input-label class="text-neutral-500">Sub Kategori*</x-input-label>
                        <x-select-input wire:model.live='subKategori' class="!rounded-full !border-neutral-300">
                            <option value="">Pilih Sub Kategori</option>
                            @foreach ($subKategoriList as $sk)
                                <option value="{{ $sk->uuid }}">{{ $sk->name }}</option>
                            @endforeach
                        </x-select-input>
                        <x-input-error :messages="$errors->get('subKategori')" class="mt-2 text-red-300" />
                    </div>
                </div>

                <div class="mt-6">
                    <x-input-label class="text-neutral-500">Judul Jasa*</x-input-label>
                    <x-text-input wire:model.live='title' class="border-neutral-300" maxlength="50" />
                    <div class="flex items-center justify-between gap-2">
                        <x-input-error :messages="$errors->get('title')" class="mt-2 text-red-300" />
                        <p class="text-sm text-neutral-400 text-right">{{ strlen($title) }}/50 Karakter. Minimal 10
                            karakter</p>
                    </div>
                </div>

                <div class="mt-6" wire:ignore>
                    <x-input-label class="text-neutral-500 mb-1">Deskripsi Jasa*</x-input-label>
                    <div id="{{ $qldeskripsi }}"></div>
                    <x-input-error :messages="$errors->get('description')" class="mt-2 text-red-300" />
                </div>

                <div class="mt-6">
                    <x-input-label class="text-neutral-500">Industri*</x-input-label>
                    <x-text-input wire:model.live='industry' class="border-neutral-300" maxlength="50" />
                    <x-input-error :messages="$errors->get('industry')" class="mt-2 text-red-300" />
                </div>

                <div class="mt-6 grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label class="text-neutral-500">Provinsi*</x-input-label>
                        <x-select-input wire:model.live='province' class="!rounded-full !border-neutral-300">
                            <option value="">Pilih Provinsi</option>
                            @foreach ($provinces as $prov)
                                <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                            @endforeach
                        </x-select-input>
                        <x-input-error :messages="$errors->get('province')" class="mt-2 text-red-300" />
                    </div>
                    <div>
                        <x-input-label class="text-neutral-500">Kota/Kabupaten*</x-input-label>
                        <x-select-input wire:model.live='city' class="!rounded-full !border-neutral-300"
                            wire:loading.class="cursor-not-allowed opacity-50" wire:target="province">
                            <option value="">Pilih Kota</option>
                            @foreach ($regencies as $regency)
                                <option value="{{ $regency->id }}">{{ $regency->name }}</option>
                            @endforeach
                        </x-select-input>
                        <x-input-error :messages="$errors->get('city')" class="mt-2 text-red-300" />
                    </div>
                </div>

                <div class="mt-6">
                    <div class="flex items-center justify-between mb-4">
                        <x-input-label class="text-neutral-500">Tahapan Kerja* (Maks. 10)</x-input-label>
                    </div>

                    <div class="space-y-4">
                        @foreach ($steps as $index => $step)
                            <div class="flex items-center gap-3">
                                <div class="flex-1">
                                    <x-input-label class="text-neutral-800">Tahap
                                        {{ $index + 1 }}{{ $index === 0 ? '*' : '' }}</x-input-label>
                                    <x-text-input wire:model.live="steps.{{ $index }}.title"
                                        class="border-neutral-300" placeholder="{{ $steps[$index]['placeholder'] }}" />
                                    <x-input-error :messages="$errors->get('steps.' . $index . '.title')" class="mt-1" />
                                </div>
                                @if ($index > 2)
                                    <button type="button" wire:click="removeStep({{ $index }})"
                                        class="text-red-500 hover:text-red-600 p-1.5 bg-neutral-100 rounded-full mt-6">
                                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
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
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="16" />
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    @if (count($steps) < 10)
                        <div class="mt-4 text-right">
                            <x-primary-button type="button" wire:click="addStep"
                                class="inline-flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Tambah Tahapan
                            </x-primary-button>
                        </div>
                    @endif
                </div>
            </div>

            <div class="p-4 md:p-6 bg-white shadow-xl shadow-neutral-200 rounded-2xl mt-6">
                <div>
                    <div class="mb-4">
                        <x-input-label class="text-neutral-500">Paket Jasa* (Min. 1, Maks. 3)</x-input-label>
                    </div>

                    <div class="space-y-4">
                        @foreach ($packages as $index => $package)
                            <div class="bg-neutral-50/50 p-4 rounded-xl border border-neutral-200"
                                wire:key="package-{{ $index }}">
                                <div class="flex items-center justify-between mb-4">
                                    <h6 class="font-medium">Paket {{ $index + 1 }}</h6>
                                    @if ($index > 0)
                                        <button type="button" wire:click="removePackage({{ $index }})"
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
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label class="text-neutral-500">Nama Paket</x-input-label>
                                        <x-text-input wire:model.live="packages.{{ $index }}.name"
                                            class="border-neutral-300" />
                                        <x-input-error :messages="$errors->get('packages.' . $index . '.name')" class="mt-1" />
                                    </div>
                                    <div>
                                        <x-input-label class="text-neutral-500">Harga</x-input-label>
                                        <x-text-input type="number"
                                            wire:model.live="packages.{{ $index }}.price"
                                            class="border-neutral-300" />
                                        <x-input-error :messages="$errors->get('packages.' . $index . '.price')" class="mt-1" />
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <x-input-label class="text-neutral-500">Deskripsi</x-input-label>
                                    <x-textarea rows="3"
                                        wire:model.live="packages.{{ $index }}.description"
                                        class="mt-1 block w-full border-neutral-300 placeholder:text-neutral-300">
                                    </x-textarea>
                                    <x-input-error :messages="$errors->get('packages.' . $index . '.description')" class="mt-1" />
                                </div>
                                <div class="mt-4 grid grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label class="text-neutral-500">Durasi Pengerjaan
                                            (Hari)
                                        </x-input-label>
                                        <x-text-input type="number"
                                            wire:model.live="packages.{{ $index }}.duration"
                                            class="border-neutral-300" />
                                        <x-input-error :messages="$errors->get('packages.' . $index . '.duration')" class="mt-1" />
                                    </div>
                                    @if ($isLongDistance)
                                        <div>
                                            <x-input-label class="text-neutral-500">Total Revisi</x-input-label>
                                            <x-text-input type="number"
                                                wire:model.live="packages.{{ $index }}.revision"
                                                class="border-neutral-300" />
                                            <x-input-error :messages="$errors->get('packages.' . $index . '.revision')" class="mt-1" />
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4 text-right">
                        @if (count($packages) < 3)
                            <x-primary-button type="button" wire:click="addPackage"
                                class="inline-flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Tambah Paket
                            </x-primary-button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-[40%] px-4">
            <div class=" sticky top-10">
                <div class="p-4 md:p-6 bg-white shadow-xl shadow-neutral-200 rounded-2xl">
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold">Gambar Jasa</h4>
                    </div>

                    <div class="border p-3 rounded-xl mb-4">
                        @foreach ($images as $index => $image)
                            <div
                                class="flex items-center justify-between gap-3 flex-wrap border-b mb-3 pb-3 last:border-b-0 last:mb-0 last:pb-0">
                                <div class="">
                                    <h3>Gambar {{ $index + 1 }}{{ $index === 0 ? '*' : '' }}</h3>
                                    @if ($image['preview'])
                                        <div class="flex items-center gap-3">
                                            <img src="{{ $image['preview'] }}" alt="Preview"
                                                class="aspect-video rounded-lg h-16">
                                            <div>
                                                <p>{{ $image['name'] }}</p>
                                                <p>{{ $this->formatSize($image['size']) }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="flex items-center gap-2">
                                    <input type="file" id="image-upload-{{ $index }}"
                                        wire:model="images.{{ $index }}.file"
                                        onchange="openCropper(event, {{ $index }})" class="hidden"
                                        accept="image/*">
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
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
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
                <div class="mt-6">
                    <x-primary-button type="submit" class="w-full">
                        {{ __('Tambah Jasa') }}
                    </x-primary-button>
                </div>
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

                quill.on('text-change', function() {
                    let value = document.getElementsByClassName('ql-editor')[0].innerHTML;
                    @this.set('description', value)
                });
            });
        </script>
    @endpush
</div>
