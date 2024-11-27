<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Orders;
use App\Models\Products;
use App\Models\ProductTags;
use App\Models\ServiceCategories;
use App\Models\ServiceCategoriesType;
use App\Models\Shops;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        $produk = Products::with('sales')->select(['id', 'sub_category_id', 'name', 'price', 'slug'])->where('status', 'published')->where('admin_approved', true)->get();

        $produkTerlaris = $produk->sortByDesc(function ($item) {
            return $item->sales->sum('quantity');
        })->values();


        return view('home.index', [
            'title' => 'Home',
            'produk' => $produkTerlaris,
        ]);
    }

    public function detailProduk($slug)
    {
        $produk = Products::where('slug', $slug)->first();
        if (!$produk) return redirect(route('home'));

        // $produk->increment('views');

        return view('home.produk.detail', [
            'title' => 'Produk ' . $produk->name,
            'produk' => $produk
        ]);
    }

    public function detailKategori($slug)
    {
        if ($slug != 'jasa-profesional') {
            $kategori = Categories::where('slug', $slug)->first();
        } else {
            $kategori = ServiceCategoriesType::all();
        };
        return view('home.kategori.detail', [
            'title' => 'Kategori ' . ($slug != 'jasa-profesional' ? $kategori->name : 'Jasa Profesional'),
        ]);
    }

    public function detailSubKategori($slug1, $slug2)
    {
        $subKategori = Categories::where('slug', $slug1)->first();
        return view('home.kategori.sub-kategori.detail', [
            'title' => $subKategori->name,
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

    public function detailToko($slug)
    {
        $toko = Shops::where('slug', $slug)->first();
        if (!$toko) return redirect(route('home'));

        return view('home.toko.detail', [
            'title' => 'Toko ' . $toko->name,
            'toko' => $toko
        ]);
    }

    public function detailTag($slug)
    {
        $tag = ProductTags::where('slug', $slug)->first();
        return view('home.produk.tag.detail', [
            'title' => 'Tag ' . $slug,
        ]);
    }

    // public function checkoutProduk($invoicenumber)
    // {
    //     $order = Orders::where('invoice_number', $invoicenumber)->first();
    //     if (!$order) return redirect(route('home'));

    //     return view('home.produk.checkout', [
    //         'title' => 'Checkout Produk ',
    //     ]);
    // }

    public function checkoutProduk($invoicenumber)
    {
        // Ambil data order dari session
        $tempOrder = session()->get('temp_order');
        if (!session()->has('temp_order')) return redirect(route('home'));
        // dd($tempOrder['items']);

        return view('home.produk.checkout', [
            'title' => 'Checkout Produk',
            'order' => $tempOrder
        ]);
    }

    public function paymentProduk($invoicenumber)
    {
        $order = Orders::where('invoice_number', $invoicenumber)->where('payment_status', 'pending')->first();
        if (!$order) return redirect(route('home'));

        return view('home.produk.payment', [
            'title' => 'Pembayaran Produk ' . $invoicenumber,
            'order' => $order
        ]);
    }

    public function homeDashboard($username)
    {
        return view('home.dashboard.index', [
            'title' => 'Dashboard'
        ]);
    }
}
