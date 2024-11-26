<?php

namespace App\Livewire\Home\Components;

use App\Models\ProductFavorites;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ProdukFavorit extends Component
{
    public $totalFavorit = 0;

    public function mount()
    {
        if (Auth::check()) {
            $this->totalFavorit = ProductFavorites::where('user_id', Auth::user()->id)->count();
        } else {
            $this->totalFavorit = 0;
        }
    }
    
    #[On('refreshFavorit')]
    public function refreshFavorit()
    {
        if (Auth::check()) {
            $this->totalFavorit = ProductFavorites::where('user_id', Auth::user()->id)->count();
        } else {
            $this->totalFavorit = 0;
        }
    }

    public function render()
    {
        return view('livewire.home.components.produk-favorit');
    }
}
