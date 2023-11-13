<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use App\Models\PembelianPembayaran;
use Illuminate\Http\Request;

class DaftarPembelianController extends Controller
{
    public function index()
    {
        $pembayaran = PembelianPembayaran::with('penerimaan.pesanan')->orderBy('created_at', 'asc')->paginate(10);
        return view('pembelian.daftar-pembelian.index', [
            'pembayaran' => $pembayaran,
        ]);
    }
}
