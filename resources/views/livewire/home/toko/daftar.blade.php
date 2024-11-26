<div class="flex flex-wrap -mx-5">
    @include('components.alert')
    <div class="w-full lg:w-1/2 px-5 order-2 lg:order-1">
        <div class="bg-indigo-500 rounded-3xl shadow-2xl shadow-indigo-500/50 p-5 lg:p-10 text-white">
            <h1 class="text-2xl font-semibold max-w-sm">Isi informasi dibawah ini untuk membuat toko Anda</h1>
            <div class="mt-6">
                <form class="space-y-6" wire:submit.prevent="submit">
                    @if ($this->step == 1)
                        <div>
                            <x-input-label class="text-white">Nama Toko</x-input-label>
                            <x-text-input
                                class="mt-1 block w-full !border-indigo-300 focus:!border-indigo-100 focus:!ring-indigo-100"
                                type="text" wire:model.live='name' />
                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-300" />
                        </div>
                        <div>
                            <x-input-label class="text-white">URL Toko Kamu</x-input-label>
                            <div class="sm:flex items-center gap-2">
                                <p class="text-indigo-200">{{ env('APP_URL') }}/toko/</p>
                                <x-text-input
                                    class="mt-1 block w-full border-indigo-400/70 focus:border-indigo-100 focus:ring-indigo-100 cursor-not-allowed bg-indigo-400/70"
                                    type="text" disabled wire:model.live='url' />
                            </div>
                        </div>
                        <div>
                            <x-input-label class="text-white">Deskripsi Toko</x-input-label>
                            <x-textarea rows="5" wire:model='description'
                                placeholder="Tulis deskripsi toko kamu disini..."
                                class="mt-1 block w-full !border-indigo-300 focus:!border-indigo-100 focus:!ring-indigo-100 placeholder:text-indigo-300">
                            </x-textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2 text-red-300" />
                        </div>
                        <div>
                            <button type="button" wire:click="next"
                                class="w-full bg-white py-4 px-4 text-center rounded-full text-indigo-500 font-semibold hover:bg-indigo-50 duration-300 shadow-lg shadow-white/20 active:scale-95">
                                Selanjutnya
                                <svg class="inline-block ml-2 size-5 fill-indigo-500" xmlns="http://www.w3.org/2000/svg"
                                    width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                                    <path
                                        d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    @else
                        <div class="grid sm:grid-cols-2 gap-6">
                            <div>
                                <x-input-label class="text-white">Kota</x-input-label>
                                <x-text-input
                                    class="mt-1 block w-full !border-indigo-300 focus:!border-indigo-100 focus:!ring-indigo-100"
                                    type="text" wire:model.live='city' />
                                <x-input-error :messages="$errors->get('city')" class="mt-2 text-red-300" />
                            </div>
                            <div>
                                <x-input-label class="text-white">Negara</x-input-label>
                                <x-text-input
                                    class="mt-1 block w-full !border-indigo-300 focus:!border-indigo-100 focus:!ring-indigo-100"
                                    type="text" wire:model.live='country' />
                                <x-input-error :messages="$errors->get('country')" class="mt-2 text-red-300" />
                            </div>
                            <div>
                                <x-input-label class="text-white">Provinsi</x-input-label>
                                <x-text-input
                                    class="mt-1 block w-full !border-indigo-300 focus:!border-indigo-100 focus:!ring-indigo-100"
                                    type="text" wire:model.live='state' />
                                <x-input-error :messages="$errors->get('state')" class="mt-2 text-red-300" />
                            </div>
                            <div>
                                <x-input-label class="text-white">Kode Pos</x-input-label>
                                <x-text-input
                                    class="mt-1 block w-full !border-indigo-300 focus:!border-indigo-100 focus:!ring-indigo-100"
                                    type="number" wire:model.live='zip' />
                                <x-input-error :messages="$errors->get('zip')" class="mt-2 text-red-300" />
                            </div>
                        </div>
                        <div>
                            <x-input-label class="text-white">Alamat</x-input-label>
                            <x-textarea rows="5"
                                class="mt-1 block w-full !border-indigo-300 focus:!border-indigo-100 focus:!ring-indigo-100 placeholder:text-indigo-300"
                                wire:model='address' placeholder="Tulis alamat toko kamu disini...">
                            </x-textarea>
                            <x-input-error :messages="$errors->get('address')" class="mt-2 text-red-300" />
                        </div>
                        <div class="flex items-center gap-2 justify-end">
                            <button type="button" wire:click="prev"
                                class="border border-indigo-300 py-4 px-8 text-center rounded-full text-indigo-50 font-medium hover:border-indigo-100 duration-300 active:scale-95">
                                <svg class="inline-block mr-2 size-5 fill-indigo-50" xmlns="http://www.w3.org/2000/svg"
                                    width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                                    <path
                                        d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z">
                                    </path>
                                </svg>
                                Kembali
                            </button>
                            <button type="submit" wire:click="next"
                                class="bg-white py-4 px-14 text-center rounded-full text-indigo-500 font-medium hover:bg-indigo-50 duration-300 shadow-lg shadow-white/20 active:scale-95">
                                Submit
                            </button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <div class="w-full lg:w-1/2 px-5 mb-8 lg:mb-0 order-1 lg:order-2">
        <img src="{{ asset('assets/img/daftar-toko.png') }}" alt="Daftar Toko" class="mx-auto lg:ms-auto">
    </div>
</div>
