<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TerminPenjualan extends Model
{
    use HasFactory;
    public $guarded = ["id"];
    protected $table = 'termin_penjualans';
    protected $fillable = [
        'kode_termin_penjualan', 'hari_termin_penjualan','nama_termin_penjualan'
    ];

    public function pesanan()
    {
        return $this->hasOne(PembelianPesanan::class, 'termin_id', 'id');
    }

    public function penerimaan()
    {
        return $this->hasOne(PembelianPenerimaan::class, 'termin_id', 'id');
    }

}
