<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EkspedisiPenjualan extends Model
{
    use HasFactory;
    public $guarded = ["id"];
    protected $table = 'ekspedisi_penjualans';
    protected $fillable = [
        'kode_ekspedisi_penjualan','nama_ekspedisi_penjualan',
    ];
}
