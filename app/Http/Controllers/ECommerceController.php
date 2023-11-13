<?php

namespace App\Http\Controllers;

use App\Models\DaftarProduk;
use Illuminate\Http\Request;

class ECommerceController extends Controller
{
    // public function index(Request $request)
    // {
    //     $products = DaftarProduk::orderBy('created_at', 'DESC')->paginate(10);

    //     return view('e_commerce/index', compact('products'));
    // }

    public function showProduct(DaftarProduk $product)
    {
        return view('e_commerce/show_product', compact('product'));
    }
}
