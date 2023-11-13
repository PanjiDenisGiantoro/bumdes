<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanBody extends Model
{
    use HasFactory;
    protected $table = 'penjualan_bodies';
    public $guarded = ["id"];

    public function produks()
    {
        return $this->hasOne(DaftarProduk::class,'id','produk_id');
    }
    public function satuans()
    {
        return $this->belongsTo(SatuanProduk::class,'id','id_satuan');
    }
    public function termins()
    {
        return $this->belongsTo(TerminPenjualan::class,'id_terminproduk','id');
    }
    public function penjualan()
    {
        return $this->hasMany(Penjualan::class,'id','id_penjualan');
    }
    public function pajaks()
    {
        return $this->hasOne(PerpajakanKeuangan::class,'id','pajak');
    }

}
