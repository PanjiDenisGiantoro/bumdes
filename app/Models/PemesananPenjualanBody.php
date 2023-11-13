<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananPenjualanBody extends Model
{
    use HasFactory;
    protected $table = 'pemesanan_penjualan_bodies';
    public $guarded = ["id"];

    public function produks()
    {
        return $this->hasOne(DaftarProduk::class,'id','id_produk');
    }
    public function termins()
    {
        return $this->hasOne(TerminPenjualan::class,'id','termin_pemesanan');
    }
    public function satuans()
    {
        return $this->belongsTo(SatuanProduk::class,'id','id_satuan');
    }
    public function terminss()
    {
        return $this->hasOne(TerminPenjualan::class,'id','termin');
    }
    public function pemesanan()
    {
        return $this->hasMany(PemesananPenjualan::class,'id','id_pemesanan');
    }
    public function pajaks()
    {
        return $this->hasOne(PerpajakanKeuangan::class,'id','pajak');
    }



}
