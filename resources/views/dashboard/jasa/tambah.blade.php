<x-app-layout>
   <x-slot name="title">{{ $title }}</x-slot>

   <section>
      <div class="mb-8">
          <h1 class="text-2xl font-medium">Tambahkan Jasa Baru</h1>
          <p class="max-w-lg text-neutral-500 mt-1">Untuk menambahkan jasa baru, silahkan isi detail form dibawah ini
          </p>
      </div>

      <livewire:dashboard.jasa.tambah>
  </section>
</x-app-layout>