<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Termin extends Model
{
    use HasFactory;

    protected $table = 'termin';
    protected $fillable = [
        'kode', 'hari'
    ];

    public function pesanan()
    {
        return $this->hasOne(PembelianPesanan::class, 'termin_id', 'id');
    }
}
