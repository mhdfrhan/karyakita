<?php

namespace App\Livewire\Home\Components;

use App\Models\OrderItems;
use App\Models\Orders;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Keranjang extends Component
{
    public $totalKeranjang = 0, $keranjang = [];

    public function mount()
    {
        if (Auth::check()) {
            $this->totalKeranjang = OrderItems::whereHas('order', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })->count();
        } else {
            $this->totalKeranjang = 0;
        }
    }

    #[On('cartAdded')]
    public function refreshKeranjang()
    {
        if (Auth::check()) {
            $this->totalKeranjang = OrderItems::whereHas('order', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })->count();
        } else {
            $this->totalKeranjang = 0;
        }
    }

    public function render()
    {
        if (Auth::check()) {
            $orderId = Orders::where('user_id', Auth::user()->id)->pluck('id')->first();
            if ($orderId == null) {
                return view('livewire.home.components.keranjang', [
                    'keranjang' => []
                ]);
            }
            $items = OrderItems::where('order_id', $orderId)->get();
            $this->keranjang = $items;
        } else {
            $items = [];
        }


        return view('livewire.home.components.keranjang', [
            'keranjang' => $this->keranjang
        ]);
    }

    public function increment($id)
    {
        $item = collect($this->keranjang)->where('id', $id)->first();

        $item->increment('quantity');
        $item->price = $item->product->price * $item->quantity;

        $item->save();
    }

    public function decrement($id)
    {
        $item = collect($this->keranjang)->where('id', $id)->first();

        if ($item->quantity > 1) {
            $item->decrement('quantity');
            $item->price = $item->product->price * $item->quantity;
            $item->save();
        } else {
            $item->delete();

            $order = Orders::where('user_id', Auth::user()->id)->first();

            if (OrderItems::where('order_id', $order->id)->count() === 0) {
                $order->delete();
            }

            $this->dispatch('cartAdded');
            $this->dispatch('notify', message: 'Produk berhasil dihapus dari keranjang', type: 'success');
        }
    }
}
