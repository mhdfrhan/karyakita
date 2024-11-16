<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <section>
        <div class="mb-8">
            <h1 class="text-2xl font-medium">Tambahkan Produk Baru</h1>
            <p class="max-w-lg text-neutral-500 mt-1">Untuk menambahkan produk baru, silahkan isi detail form dibawah ini
            </p>
        </div>

        <livewire:dashboard.produk.tambah>
    </section>
</x-app-layout>
