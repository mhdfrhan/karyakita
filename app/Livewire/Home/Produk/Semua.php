<?php

namespace App\Livewire\Home\Produk;

use App\Models\Products;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Semua extends Component
{
    use WithPagination;

    public $perPage = 9;
    public $viewType = 'grid';
    public $sortOrder = 'terbaru';
    public $kategori = 'semua';

    #[On('filterProduk')]
    public function filterProduk($filters)
    {
        $this->kategori = $filters['kategori'];
        $this->sortOrder = $filters['sortOrder'];
        $this->viewType = $filters['viewType'];

        $this->loadProducts();
    }

    public function render()
    {
        $produk = $this->loadProducts();

        return view('livewire.home.produk.semua', ['produk' => $produk]);
    }

    public function loadProducts()
    {
        $produkQuery = Products::query();

        if ($this->kategori && $this->kategori !== 'semua') {
            $produkQuery->where('category_id', $this->kategori);
        }

        // Sorting
        switch ($this->sortOrder) {
            case 'terbaru':
                $produkQuery->orderBy('created_at', 'desc');
                break;
            case 'terlama':
                $produkQuery->orderBy('created_at', 'asc');
                break;
            case 'termurah':
                $produkQuery->orderBy('price', 'asc');
                break;
            case 'terpopuler':
                $produkQuery->withSum('sales', 'quantity')
                    ->orderBy('sales_sum_quantity', 'desc');
                break;
        }

        // Tambahan filter
        $produkQuery->where('admin_approved', true);

        $produk = $produkQuery->paginate($this->perPage);

        return $produk;
    }

    public function loadMoreProducts()
    {
        $this->perPage += 6;
    }
}
