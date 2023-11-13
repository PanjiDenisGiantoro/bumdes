<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasirBody extends Model
{
    use HasFactory;
    protected $table = 'kasir_body';
    protected $guarded = ['id'];

    public function produk()
    {
        return $this->hasOne(DaftarProduk::class, 'id', 'id_produk');
    }

}
