<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class KodeProfil extends Model
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

    protected static function booted()
    {
        static::addGlobalScope('pegawai_by_cabang', function (Builder $builder) {
            $builder->where('cabang_unit', '=', auth()->user()->cabang_unit);
        });

        static::creating(function ($pegawai) {
            $pegawai->cabang_unit = auth()->user()->cabang_unit;
        });
    }

    public function warung()
    {
        return $this->belongsTo(Warung::class);
    }
    public function profil()
    {
        return $this->hasOne(KodePengguna::class,'id','id_jabatan');
    }
}
