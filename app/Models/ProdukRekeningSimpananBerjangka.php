<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukRekeningSimpananBerjangka extends Model
{
    use HasFactory;

    protected $table = 'produk_rekening_simpanan_berjangkas';

    protected $guarded = [];

    const STATUS_INACTIVE = 0;

    const STATUS_ACTIVE = 1;


    public function getStatusTextAttribute()
    {

        switch ($this->attributes['status']) {
            case self::STATUS_ACTIVE:
                return 'Aktif';

            case self::STATUS_INACTIVE:
                return 'Tidak Aktif';

            default:
                return '-';
        }
    }
}
