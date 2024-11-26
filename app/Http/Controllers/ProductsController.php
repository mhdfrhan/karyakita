<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Advertisements;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
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

    public function editProduk($slug)
    {
        $product = Products::where('slug', $slug)->first();
        if (!$product) return redirect(route('dashboard.produk'));

        return view('dashboard.edit-produk', [
            'title' => 'Edit Produk',
            'product' => $product
        ]);
    }

    public function bayar($slug) {
        $ads = Advertisements::where('invoice_number', $slug)->first();
        if($ads && $ads->status == 'active' && $ads->end_date < now()) {
            $ads->status = 'pending';
            $ads->save();
        }

        if (!$ads) {
            return redirect(route('dashboard.produk'));
        }

        return view('dashboard.bayar-produk', [
            'title' => 'Bayar Produk',
            'ads' => $ads
        ]);
    }
}
