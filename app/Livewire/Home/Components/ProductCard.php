<?php

namespace App\Livewire\Home\Components;

use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\ProductFavorites;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductCard extends Component
{
    #[Locked]
    public $produkId;

    public $image, $title, $rating, $price, $category, $slug, $categorySlug;

    public $viewType = 'grid';

    #[On('filterProduk')]
    public function updatedFilter($filters)
    {
         $this->viewType = $filters['viewType'];
    }
    public function render()
    {
        return view('livewire.home.components.product-card');
    }

    public function addToFavorite($produkId)
    {
        try {
            $id = decrypt($produkId);
        } catch (\Throwable $th) {
            $this->redirect(route('semua-produk'));
        }

        if (Auth::check()) {
            if (ProductFavorites::where('user_id', Auth::user()->id)->where('product_id', $id)->exists()) {
                $this->dispatch('notify', message: 'Produk sudah ada di favorit', type: 'warning');
                return;
            }
            ProductFavorites::create([
                'user_id' => Auth::user()->id,
                'product_id' => $id,
                'created_at' => now()
            ]);
            $this->dispatch('refreshFavorit');
            $this->dispatch('notify', message: 'Produk berhasil ditambahkan ke favorit', type: 'success');
        } else {
            $this->redirect(route('login'));
            return;
        }
    }

    public function addToCart($produkId)
    {
        try {
            $id = decrypt($produkId);
        } catch (\Throwable $th) {
            $this->redirect(route('semua-produk'));
        }

        if (!Auth::check()) {
            $this->redirect(route('login'));
            return;
        }

        $produk = Products::find($id);
        if (!$produk) {
            $this->dispatch('notify', message: 'Produk tidak ditemukan', type: 'error');
            return;
        }

        $existingCart = Orders::where('user_id', Auth::user()->id)
            ->where('payment_status', 'pending')
            ->first();

        if ($existingCart) {
            $existingCartItem = OrderItems::where('order_id', $existingCart->id)
                ->where('products_id', $produk->id)
                ->first();

            if ($existingCartItem) {
                $existingCartItem->update([
                    'quantity' => $existingCartItem->quantity + 1,
                    'price' => $produk->price * ($existingCartItem->quantity + 1)
                ]);

                $existingCart->update([
                    'total_amount' => OrderItems::where('order_id', $existingCart->id)
                        ->sum('price')
                ]);

                $this->dispatch('cartAdded');
                $this->dispatch('notify', message: 'Jumlah produk berhasil diupdate', type: 'success');
                return;
            }

            OrderItems::create([
                'order_id' => $existingCart->id,
                'products_id' => $produk->id,
                'quantity' => 1,
                'price' => $produk->price,
                'created_at' => now()
            ]);

            $existingCart->update([
                'total_amount' => OrderItems::where('order_id', $existingCart->id)
                    ->sum('price')
            ]);
        } else {
            $cart = Orders::create([
                'user_id' => Auth::user()->id,
                'total_amount' => $produk->price,
                'payment_status' => 'pending',
                'created_at' => now()
            ]);

            OrderItems::create([
                'order_id' => $cart->id,
                'products_id' => $produk->id,
                'quantity' => 1,
                'price' => $produk->price,
                'created_at' => now()
            ]);
        }

        $this->dispatch('cartAdded');
        $this->dispatch('notify', message: 'Produk berhasil ditambahkan ke keranjang', type: 'success');
    }
}