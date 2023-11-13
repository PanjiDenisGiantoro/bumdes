<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianPembayaranBody extends Model
{
    use HasFactory;
    public $guarded = ["id"];
    protected $table = 'pembelian_pembayaran_body';

}
