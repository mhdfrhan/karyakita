<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <section>
        <livewire:dashboard.jasa.bayar :jasa="$service">
    </section>
</x-app-layout>
