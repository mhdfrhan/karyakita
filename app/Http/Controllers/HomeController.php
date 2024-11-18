<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Shops;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'title' => 'Home'
        ]);
    }

    public function semuaProduk()
    {
        return view('home.semua-produk', [
            'title' => 'Semua Produk'
        ]);
    }

    public function semuaJasa()
    {
        return view('home.semua-jasa', [
            'title' => 'Semua Jasa'
        ]);
    }

    public function faq()
    {
        return view('home.faq', [
            'title' => 'FAQ'
        ]);
    }

    public function daftarToko()
    {
        $toko = Shops::where('user_id', Auth::user()->id)->first();
        if ($toko != null) {
            return redirect(route('dashboard'));
        }

        return view('home.daftar-toko', [
            'title' => 'Daftar Toko'
        ]);
    }
}
