<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class ProdukRekeningPembiayaan extends Model
{
    use HasFactory, Filterable;
    protected $table = 'produk_rekening_pembiayaans';

    protected $guarded = [];


    protected $casts = [
        "biaya_admin" => "float",
        "biaya_materai" => "float",
        "biaya_asuransi" => "float",
        "biaya_lain_lain" => "float",
    ];


    const STATUS_INACTIVE = 0;

    const STATUS_ACTIVE = 1;


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
        return $this->hasOne(Akad::class,'id','akad_pembiayaan');
    }
    public function akun_perkiraans() {
        return $this->hasOne(AkunPerkiraan::class,'id','GL_produk_pembiayaan');
    }

}
