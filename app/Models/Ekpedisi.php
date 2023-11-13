<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekpedisi extends Model
{
    use HasFactory;

    protected $table = 'ekspedisi_penjualans';
    protected $fillable = [
        'kode','nama',
    ];

    public function pesanan()
    {
        return $this->hasOne(PembelianPesanan::class, 'ekpedisi_id', 'id');
    }
}
