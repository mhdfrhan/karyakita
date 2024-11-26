<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <section class="max-w-6xl mx-auto">
        <div class="flex flex-wrap -mx-5">
            <div class="w-full lg:w-1/3 px-5">
                <div class=" border-b border-neutral-300 pb-8 mb-8">
                    <div class="p-5 bg-indigo-500 rounded-xl shadow-xl shadow-indigo-200 relative overflow-hidden">
                        <div class="flex items-start gap-3">
                            <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-8 text-indigo-800">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-medium text-indigo-100">KaryaKita Balance</h2>
                                <h1 class="text-3xl font-semibold text-white">Rp.
                                    {{ number_format(auth()->user()->saldo, 0, ',', '.') }}</h1>
                            </div>
                        </div>
                        <div class="w-28 h-28 bg-indigo-400/20 z-0 rounded-full absolute -top-6 -right-6"></div>
                        <div class="w-24 h-24 bg-indigo-400/50 z-0 rounded-full absolute -top-6 -right-6"></div>
                        <div class="w-20 h-20 bg-indigo-400 z-10 rounded-full absolute -top-5 -right-5"></div>
                        <div class="mt-10">
                            <x-secondary-button class="w-full">Tarik Saldo</x-secondary-button>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-medium">Rekening Kamu</h3>
                    <div class="border border-neutral-300 rounded-xl p-5">
                        @if (auth()->user()->bankAccounts && auth()->user()->bankAccounts->count() > 0)
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium">{{ auth()->user()->bankAccounts->first()->bank_name }}</p>
                                        <p class="text-sm text-neutral-500">{{ auth()->user()->bankAccounts->first()->account_number }}</p>
                                    </div>
                                    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'edit-bank')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                            stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" 
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </x-primary-button>
                                </div>
                                <div>
                                    <p class="text-sm text-neutral-500">Atas Nama</p>
                                    <p>{{ auth()->user()->bankAccounts->first()->account_name }}</p>
                                </div>
                            </div>
                        @else
                            <div class="text-center">
                                <p class="mb-3 text-neutral-800 font-medium">Kamu belum memiliki rekening</p>
                                <x-primary-button class="inline-flex gap-1 items-center text-sm" x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-bank')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                        stroke-width="1.5" stroke="currentColor" class="size-5 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    Tambah Rekening
                                </x-primary-button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-2/3 px-5">
                <div>
                    <h3 class="text-xl font-semibold border-b border-neutral-200 pb-3">Riwayat Penarikan</h3>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>

<x-modal align="center" name="add-bank" :show="$errors->isNotEmpty()" focusable>
    <form method="post" class="p-6">
        <h2 class="text-lg font-medium">
            {{ __('Tambah Rekening Bank') }}
        </h2>

        <div class="mt-6">
            <x-input-label for="bank_name" value="{{ __('Nama Bank') }}" />
            <x-select-input id="bank_name" name="bank_name" class="mt-1 block w-full">
                <option value="">Pilih Bank</option>
                <option value="BCA">Bank BCA</option>
                <option value="BNI">Bank BNI</option>
                <option value="BRI">Bank BRI</option>
                <option value="Mandiri">Bank Mandiri</option>
            </x-select-input>
        </div>

        <div class="mt-6">
            <x-input-label for="account_number" value="{{ __('Nomor Rekening') }}" />
            <x-text-input id="account_number" name="account_number" type="number" class="mt-1 block w-full" />
        </div>

        <div class="mt-6">
            <x-input-label for="account_name" value="{{ __('Nama Pemilik Rekening') }}" />
            <x-text-input id="account_name" name="account_name" type="text" class="mt-1 block w-full" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Batal') }}
            </x-secondary-button>

            <x-primary-button class="ms-3">
                {{ __('Simpan') }}
            </x-primary-button>
        </div>
    </form>
</x-modal>
