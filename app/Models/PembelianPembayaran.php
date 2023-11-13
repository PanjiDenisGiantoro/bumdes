<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianPembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembelian_pembayaran';

    public $guarded = ["id"];

    public function penerimaan()
    {
        return $this->hasOne(PembelianPenerimaan::class, 'id', 'penerimaan_id');
    }
    
    public function supplier()
    {
        return $this->hasOne(Supplier::class, 'nama','supplier');
    }

    public function termins()
    {
        return $this->hasOne(TerminPenjualan::class,'id','termin_pembayaran');
    }

}
