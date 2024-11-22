<?php

namespace App\Livewire\Dashboard\Produk;

use App\Models\Products;
use App\Models\ProductVersion;
use App\Models\Shops;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[Url(as: 'nama')] 
    public $search = "";
    
    public $setDeleteName = "", $setDeleteId;

    public function render()
    {
        $shop = Shops::where('user_id', Auth::id())->first();

        if ($shop == null) {
            return redirect(route('daftarToko'));
        }

        $produk = $shop->products()->where('name', 'like', '%' . $this->search . '%')
        ->latest()
        ->paginate(8)
        ->onEachSide(1);


        return view('livewire.dashboard.produk.index', [
            'produk' => $produk
        ]);
    }

    public function setDelete($slug)
    {
        $produk = Products::where('slug', $slug)->first();

        if (!$produk) {
            return redirect(route('dashboard'));
        }

        $this->setDeleteName = $produk->name;
        $this->setDeleteId = $produk->id;
    }

    public function deleteProduct() {
        $produk = Products::where('id', $this->setDeleteId)->first();

        if (!$produk) {
            return redirect(route('dashboard'));
        }

        // hapus gambar
        foreach ($produk->images as $image) {
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
            $image->delete();
        }

        foreach ($produk->versions as $version) {
            if (Storage::disk('public')->exists($version->file_path)) {
                Storage::disk('public')->delete($version->file_path);
            }
            $version->delete();
        }

        $produk->delete();
        $this->dispatch('close-modal', 'confirm-product-deletion');
        $this->dispatch('notify', message: 'Produk berhasil dihapus!', type: 'success');
    }

    // public function placeholder()
    // {
    //     return <<<'HTML'
    //     <div>
    //         <!-- Loading spinner... -->
    //         loading...
    //     </div>
    //     HTML;
    // }
}
