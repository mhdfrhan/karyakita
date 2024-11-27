<?php

namespace App\Livewire\Home\Produk;

use Livewire\Component;

class SemuaFilter extends Component
{
    public $viewType = 'grid';
    public $sortOrder = 'terbaru';
    public $kategori = 'semua';

    public function updated()
    {
        $this->dispatch('filterProduk', [
            'viewType' => $this->viewType,
            'sortOrder' => $this->sortOrder,
            'kategori' => (int)$this->kategori
        ]);
    }

    public function render()
    {
        return view('livewire.home.produk.semua-filter');
    }
}
