<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    use HasFactory;

    const TUNAI = 1;

    const NON_TUNAI = 0;

    protected $table = 'kasir';

    protected $guarded = ['id'];

    protected $casts = [
        'items' => 'array',
    ];
    public function getStatusAnggotaTextAttribute()
    {
        switch ($this->attributes['status_anggota']) {
            case '0':
                $id_status_keanggotaan = 'Non Anggota';
                break;

            case '1':
                $status_anggota = 'Anggota';
                break;
            default:
                $status_anggota = '-';
                break;
        }

        return $status_anggota;
    }
    public function anggota()
    {
        return $this->hasOne(Anggota::class, 'id', 'anggota_id');
    }

}
