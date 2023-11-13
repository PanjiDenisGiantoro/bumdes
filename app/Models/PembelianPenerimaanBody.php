<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianPenerimaanBody extends Model
{
    use HasFactory;

    protected $table = 'pembelian_penerimaan_body';

    public $guarded = ["id"];

    public function produk()
    {
        return $this->belongsTo(DaftarProduk::class, 'produk_id', 'id');
    }

    public function satuan()
    {
        return $this->belongsTo(SatuanProduk::class, 'id_satuan', 'id');
    }
    public function pembelianpenerimaan()
    {
        return $this->belongsTo(PembelianPenerimaan::class, 'pembelian_penerimaan_id', 'id');
    }
}
