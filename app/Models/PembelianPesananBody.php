<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianPesananBody extends Model
{
    use HasFactory;
    protected $table = 'pesanan_pembelian_body';
    // protected $fillable = [
    //     'tanggal_pesanan', 'no_pesanan', 'supplier_id','termin_id','ekpedisi_id',
    //     'produk_id','tanggal_penerimaan', 'pajak','diskon', 'total_tertagih',
    //     'pajak_seluruh', 'total_seluruh', 'diskon_seluruh', 'subtotal',
    //     'kuantitas', 'status','total'
    // ];
    public $guarded = ["id"];

    public function pesanan()
    {
        return $this->belongsTo(PembelianPesanan::class, 'pesanan_pembelian_id', 'id');
    }

    public function produk()
    {
        return $this->belongsTo(DaftarProduk::class, 'produk_id', 'id');
    }
    public function termins()
    {
        return $this->hasOne(TerminPenjualan::class,'id','termin');
    }
    public function pajaks()
    {
        return $this->hasOne(PerpajakanKeuangan::class,'id','pajak');
    }

    public function satuan()
    {
        return $this->belongsTo(SatuanProduk::class, 'id_satuan', 'id');
    }
    public function penerimaan()
    {
        return $this->hasManyThrough(PembelianPesanan::class, PembelianPenerimaan::class);
    }
}
