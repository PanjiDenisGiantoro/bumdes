<?php

namespace App\Observers;

use App\Models\Carts;
use App\Models\DaftarProduk;
use App\Models\KategoriProduk;
use Illuminate\Support\Facades\Log;

class CartObserver
{
    /**
     * Handle the Carts "created" event.
     *
     * @param  \App\Models\Carts  $carts
     * @return void
     */
    public function created(Carts $carts)
    {
        $product = DaftarProduk::where('id', $carts->product_id)->first();

        try {
            $calculatedPrice = (float)$product->harga_anggota * $carts->quantity;

            $carts->product_name = $product->nama_produk;
            $carts->image = $product->picturePath;
            $carts->price = $product->harga_anggota;
            $carts->total_price = $calculatedPrice;
            $carts->saveQuietly();

        } catch (\Exception $e) {
            Log::debug($e);
        }

    }

    /**
     * Handle the Carts "updated" event.
     *
     * @param  \App\Models\Carts  $carts
     * @return void
     */
    public function updated(Carts $carts)
    {
        try {
            $calculatedPrice = $carts->price * $carts->quantity;
            $carts->total_price = $calculatedPrice;
            $carts->saveQuietly();

        } catch (\Exception $e) {
            Log::debug($e);
        }
    }

    /**
     * Handle the Carts "deleted" event.
     *
     * @param  \App\Models\Carts  $carts
     * @return void
     */
    public function deleted(Carts $carts)
    {
        //
    }

    /**
     * Handle the Carts "restored" event.
     *
     * @param  \App\Models\Carts  $carts
     * @return void
     */
    public function restored(Carts $carts)
    {
        //
    }

    /**
     * Handle the Carts "force deleted" event.
     *
     * @param  \App\Models\Carts  $carts
     * @return void
     */
    public function forceDeleted(Carts $carts)
    {
        //
    }
}
