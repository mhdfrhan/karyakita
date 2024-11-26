<?php

namespace App\Livewire\Home\Produk;

use App\Models\Products;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Pagination\LengthAwarePaginator;

class Semua extends Component
{
    public $perPage = 9;
    public $viewType = 'grid';
    public $sortOrder = 'terbaru';
    public $kategori = 'semua';

    #[On('filterProduk')]
    public function updateFilters($filters)
    {
        $this->kategori = $filters['kategori'];
        $this->sortOrder = $filters['sortOrder'];
        $this->viewType = $filters['viewType'];
    }

    public function render()
    {
        // Ambil produk dengan iklan dan tanpa iklan
        $produkQuery = Products::query();

        // Filter kategori
        if ($this->kategori !== 'semua') {
            $produkQuery->where('category_id', $this->kategori);
        }

        // Mengurutkan produk berdasarkan sortOrder
        if ($this->sortOrder === 'terbaru') {
            $produkQuery->orderBy('created_at', 'desc');
        } elseif ($this->sortOrder === 'terlama') {
            $produkQuery->orderBy('created_at', 'asc');
        } elseif ($this->sortOrder === 'termurah') {
            $produkQuery->orderBy('price', 'asc');
        } elseif ($this->sortOrder === 'terpopuler') {
            $produkQuery->withSum('sales', 'quantity')->orderBy('sales_sum_quantity', 'desc');
        }

        // Ambil data produk dan paginate
        $produk = $produkQuery->paginate($this->perPage);

        return view('livewire.home.produk.semua', ['produk' => $produk]);
    }

    public function loadMoreProducts()
    {
        if ($this->perPage >= Products::count()) {
            return;
        }
        $this->perPage += 6;
    }
}
