<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;
    public $guarded = ["id"];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        "tanggal_lahir" => "date",
    ];
    public function getDisusutkanTextAttribute()
    {
        switch ($this->attributes['disusutkan']) {
            case '0':
                $disusutkan = 'Tidak Disusutkan';
                break;

            case '1':
                $disusutkan = 'Disusutkan';
                break;
            default:
                $disusutkan = '-';
                break;
        }

        return $disusutkan;
    }
    public function kelompokaset()
    {
        return $this->hasOne(KelompokAset::class,'id','id_kode_kelompok_aset');
    }
    public function akun_perkiraan()
    {
        return $this->belongsTo(AkunPerkiraan::class, 'akun_aset_tetap');
    }
}
