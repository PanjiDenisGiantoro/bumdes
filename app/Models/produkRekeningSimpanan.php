<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produkRekeningSimpanan extends Model
{
    use HasFactory;

    protected $table = 'produk_rekening_simpanans';

    protected $guarded = ['id'];


    const STATUS_INACTIVE = 0;

    const STATUS_ACTIVE = 1;


    public function scopeSimpananBiasa($query) {
        return $query->where('kategori_produk', '=', 'simpanan');
    }

    public function scopeSimpananBerjangka($query) {
        return $query->where('kategori_produk', '=', 'simpanan-berjangka');
    }

    public function getStatusTextAttribute() {

        switch ($this->attributes['status'])
        {
            case self::STATUS_ACTIVE:
                return 'Aktif';

            case self::STATUS_INACTIVE:
                return 'Tidak Aktif';

            default:
                return '-';
        }
    }
    public function akads() {
        return $this->hasOne(Akad::class,'id','akad_simpanan');
    }
    public function akun_perkiraans() {
        return $this->hasOne(AkunPerkiraan::class,'id','GL_produk_simpanan');
    }

}
