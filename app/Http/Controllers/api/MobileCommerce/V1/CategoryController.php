<?php

namespace App\Http\Controllers\api\MobileCommerce\V1;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use App\Models\PenjualanBody;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $category = KategoriProduk::withCount('produk')->get([
            'id',
            'kode_kategori_produk',
            'kategori_produk',
        ]);

        return ResponseBuilder::success($category);
    }

    public function categoryPopular(Request $request) {

        $products = PenjualanBody::with('produks')
            ->groupBy('category_id')
            ->select('produk_id', DB::raw('count(*) as total_pesanan'), DB::raw('sum(qty) as unit_terjual'))
            ->get();

        if ($products) {
            return ResponseBuilder::success($products);
        } else {
            return ResponseBuilder::error("empty");
        }

    }
}
