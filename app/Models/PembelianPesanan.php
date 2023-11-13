<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianPesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan_pembelian';
    // protected $fillable = [
    //     'tanggal_pesanan', 'no_pesanan', 'supplier_id','termin_id','ekpedisi_id',
    //     'produk_id','tanggal_penerimaan', 'pajak','diskon', 'total_tertagih',
    //     'pajak_seluruh', 'total_seluruh', 'diskon_seluruh', 'subtotal',
    //     'kuantitas', 'status','total'
    // ];
    public $guarded = ["id"];


    public function produk()
    {
        return $this->belongsTo(DaftarProduk::class, 'produk_id', 'id');
    }

    public function termin()
    {
        return $this->belongsTo(TerminPenjualan::class, 'termin_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function ekpedisi()
    {
        return $this->belongsTo(Ekpedisi::class, 'ekpedisi_id', 'id');
    }

    public function pesananbody()
    {
        return $this->hasOne(PembelianPesananBody::class, 'pesanan_pembelian_id', 'id');
    }

    public function penerimaan()
    {
        return $this->hasOne(PembelianPenerimaan::class, 'pesananpembelian_id', 'id');
    }
}
