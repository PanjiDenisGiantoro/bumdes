<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengirimanBody extends Model
{
    use HasFactory;
    protected $table = 'pengiriman_bodies';
    public $guarded = ["id"];

    public function produk()
    {
        return $this->hasOne(DaftarProduk::class,'id','id_produk');
    }
    public function termins()
    {
        return $this->hasOne(TerminPenjualan::class,'id','termin');
    }
    public function pajaks()
    {
        return $this->hasOne(PerpajakanKeuangan::class,'id','pajak');
    }
}
