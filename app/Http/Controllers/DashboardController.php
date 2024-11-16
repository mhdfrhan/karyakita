<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Shops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'title' => 'Dashboard'
        ]);
    }

    public function produk()
    {
        return view('dashboard.produk', [
            'title' => 'Produk',
        ]);
    }

    public function tambahProduk()
    {
        return view('dashboard.tambah-produk', [
            'title' => 'Tambah Produk',
        ]);
    }
}
