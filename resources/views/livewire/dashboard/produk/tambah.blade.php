<div>
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/cropper.min.css') }}">
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
    <form class="flex flex-wrap -mx-4">
        <div class="w-full lg:w-1/2 px-4">
            <div class="p-4 md:p-6 bg-white shadow-2xl shadow-neutral-200 rounded-2xl">
                <div class="mb-6">
                    <h4 class="text-lg font-semibold">Informasi Produk</h4>
                </div>
                <div class="grid sm:grid-cols-2 gap-6">
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
                            @foreach ($subKategoriList as $k)
                                <option value="{{ $k->uuid }}">{{ $k->name }}</option>
                            @endforeach
                        </x-select-input>
                        <x-input-error :messages="$errors->get('subKategori')" class="mt-2 text-red-300" />
                    </div>
                </div>
                <div class="mt-6 ">
                    <x-input-label class="text-neutral-500">Nama Produk*</x-input-label>
                    <x-text-input wire:model.live='nama' class="border-neutral-300" maxlength="50" />
                    <div class="flex items-center justify-between gap-2">
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-300" />
                        <p class="text-sm text-neutral-400 text-right">{{ strlen($nama) }}/50 Karakter. Minimal 10
                            karakter</p>
                    </div>
                </div>
                <div class="mt-6" wire:ignore>
                    <x-input-label class="text-neutral-500 mb-1">Deskripsi Produk*</x-input-label>
                    <div id="{{ $qldeskripsi }}"></div>
                </div>
                <div class="mt-6 flex items-center -mx-3">
                    <div class="w-full md:w-3/4 md:px-3">
                        <x-input-label class="text-neutral-500">Preview URL (Optional)</x-input-label>
                        <x-text-input wire:model.live='preview' class="border-neutral-300" />
                    </div>
                    <div class="w-full md:w-1/4 md:px-3">
                        <x-input-label class="text-neutral-500">Jumlah Halaman*</x-input-label>
                        <x-text-input wire:model.live='halaman' class="border-neutral-300" />
                    </div>
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
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
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
                                            class="border-neutral-300" />
                                        <x-input-error :messages="$errors->get('features.' . $index . '.title')" class="mt-1" />
                                    </div>
                                    <div>
                                        <x-input-label class="text-neutral-500">Deskripsi</x-input-label>
                                        <x-textarea rows="3"
                                            wire:model.live="features.{{ $index }}.description"
                                            class="mt-1 block w-full border-neutral-300 placeholder:text-neutral-300">
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

                <div class="border p-3 rounded-xl">

                    @foreach ($images as $index => $image)

                        <div class="flex items-center justify-between gap-3 flex-wrap border-b mb-3 pb-3 last:border-b-0 last:mb-0 last:pb-0">

                            <div class="flex items-center gap-4">

                                <h3>Gambar {{ $index + 1 }}{{ $index === 0 ? '*' : '' }}</h3>

                                @if ($image['preview'])

                                    <img src="{{ $image['preview'] }}" alt="Preview" class="image-preview">

                                @endif

                            </div>

                            <div class="flex items-center gap-2">

                                <input type="file" id="image-upload-{{ $index }}"

                                    wire:model="images.{{ $index }}.file" onchange="openCropper(event, {{ $index }})"

                                    class="hidden" accept="image/*">

                                <x-border-button type="button"

                                    onclick="document.getElementById('image-upload-{{ $index }}').click()">

                                    {{ $image['preview'] ? 'Ubah' : 'Unggah' }}

                                </x-border-button>

                                @if ($image['preview'] && $index > 0)

                                    <button type="button" wire:click="removeImage({{ $index }})"

                                        class="text-red-500 hover:text-red-600">

                                        <!-- Icon SVG -->

                                    </button>

                                @endif

                            </div>

                        </div>

                    @endforeach


                    @if (count($images) < 10)

                        <div class="mt-4 text-right">

                            <x-primary-button type="button" wire:click="addImage"

                                class="inline-flex items-center gap-2">

                                <!-- Icon SVG -->

                                Tambah Gambar

                            </x-primary-button>

                        </div>

                    @endif

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
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
        <script src="{{ asset('js/cropper.min.js') }}"></script>
        <script>

            let cropper;

            let currentIndex; // Menyimpan index gambar yang sedang di-crop


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

                        aspectRatio: 1,

                        viewMode: 1,

                    });


                    currentIndex = index; // Simpan index gambar yang sedang di-crop

                    document.getElementById('cropModal').classList.remove('hidden');

                };


                reader.readAsDataURL(file);

            };


            const cropImage = () => {

                const canvas = cropper.getCroppedCanvas();

                canvas.toBlob((blob) => {

                    const file = new File([blob], 'cropped.jpg', {

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

                    @this.set('deskripsi', value)

                });

            });

        </script>
    @endpush
</div>
