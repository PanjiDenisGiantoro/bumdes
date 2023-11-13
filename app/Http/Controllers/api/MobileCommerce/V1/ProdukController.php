<?php

namespace App\Http\Controllers\api\MobileCommerce\V1;

use App\Http\Controllers\Controller;
use App\Models\DaftarProduk;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // Add product based on category
        // based on user cabang

        $produk = DaftarProduk::select(
            'id', 
            'nama_produk', 
            'kode_produk', 
            'harga_anggota', 
            'stok'
        )->paginate(10);

        if ($produk) {
            return ResponseBuilder::success($produk);
        } else {
            return ResponseBuilder::error(404, null, [
                'message' => 'Product Empty',
            ]);
        }

    }

    public function productCategory(Request $request, $cat) {

        $product = DaftarProduk::where('id_kategori_produk', '=', $cat)->get();

        if ($product) {
            return ResponseBuilder::success($product);
        } else {
            return ResponseBuilder::error(404, null, [
                'message' => 'Error',
            ]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $produk = DaftarProduk::where('id', '=', $id)
            ->with('kategori', 'satuan', 'beratSatuan')
            ->first();

        if ($produk) {
            return ResponseBuilder::success($produk);
        } else {
            return ResponseBuilder::error(104, null, [
                'message' => 'Product not exist',
            ]);
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
