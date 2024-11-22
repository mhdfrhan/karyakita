<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <section>
        <livewire:dashboard.produk.bayar :ads="$ads">
    </section>
</x-app-layout>
