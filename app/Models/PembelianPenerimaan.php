<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianPenerimaan extends Model
{
    use HasFactory;

    protected $table = 'pembelian_penerimaan';

    public $guarded = ["id"];

    public function pesanan()
    {
        return $this->belongsTo(PembelianPesanan::class, 'pesananpembelian_id', 'id');
    }

    public function pembelianbody()
    {
        return $this->hasOne(PembelianPesananBody::class,    'pesanan_pembelian_id', 'id');
    }

    public function supplier()
    {
        return $this->hasOne(Supplier::class, 'id');
    }

    public function produk()
    {
        return $this->belongsTo(DaftarProduk::class, 'produk_id', 'id');
    }

    public function termin()
    {
        return $this->belongsTo(TerminPenjualan::class, 'termin_pembayaran', 'id');
    }

    public function ekpedisi()
    {
        return $this->belongsTo(Ekpedisi::class, 'ekpedisi_id', 'id');
    }

    public function pembayaran()
    {
        return $this->hasOne(PembelianPembayaran::class, 'penerimaan_id', 'id');
    }
}
