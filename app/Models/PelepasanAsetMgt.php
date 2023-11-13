<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelepasanAsetMgt extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    public $guarded = ["id"];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        "tanggal_pengajuan" => "date",
    ];
    protected $table = 'pelepasan_aset_mgts';


    public function warung()
    {
        return $this->belongsTo(Warung::class);
    }
    public function aset()
    {
        return $this->hasOne(Aset::class,'id','id_kelompok_aset');
    }
}
