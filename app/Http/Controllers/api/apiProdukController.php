<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DaftarProduk;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;

class apiProdukController extends Controller
{
    public function index($id)
    {
        return DaftarProduk::with('kategori')->where('id_kategori_produk',$id)->get();
    }
}
