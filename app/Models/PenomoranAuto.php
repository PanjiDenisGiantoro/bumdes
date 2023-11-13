<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenomoranAuto extends Model
{
    use HasFactory;
    protected $table = 'penomoran_auto';
    public $guarded = ["id"];

    public function scopePembelian($query)
    {
        return $query->where('keterangan', '=','Pemesanan Pembelian');
    }
    public function scopePenjualan($query)
    {
        return $query->where('keterangan', '=','Pembayaran Penjualan');
    }
}
