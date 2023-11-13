<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\City;

class Anggota extends Model
{
    use HasFactory,Filterable;


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

    protected static function booted(){
        if (!empty(auth()->user())) {
            static::addGlobalScope('warung_by_cabang', function (Builder $builder) {
                $builder->where('cabang_unit', '=', auth()->user()->cabang_unit)
                    ->where('sub_branch_unit', '=', auth()->user()->sub_branch_unit);
            });
        }else{

        }

        static::creating(function ($anggota) {
            $anggota->cabang_unit = auth()->user()->cabang_unit;
        });
    }

    public function getStatusAktifTextAttribute()
    {
        switch ($this->attributes['status_aktif']) {
            case '2':
                $status_aktif = 'Berhenti';
                break;

            case '0':
                $status_aktif = 'Tidak Aktif';
                break;

            case '1':
                $status_aktif = 'Aktif';
                break;
            default:
                $status_aktif = 'Baru';
                break;
        }

        return $status_aktif;
    }
    public function getStatusKeanggotaanTextAttribute()
    {
        switch ($this->attributes['id_status_keanggotaan']) {
            case '0':
                $id_status_keanggotaan = 'Tidak Aktif';
                break;

            case '1':
                $status_aktif = 'Aktif';
                break;
            default:
                $status_aktif = '-';
                break;
        }

        return $status_aktif;
    }
    public function warung()
    {
        return $this->belongsTo(Warung::class);
    }

    public function pembiayaan()
    {
        return $this->hasMany(DaftarPembiayaan::class, 'id_anggota');
    }


    public function daftarwarung()
    {
        return $this->hasOne(DaftarWarung::class, 'id_anggota', 'id');
    }

    public function kodependidikan()
    {
        return $this->hasOne(KodePendidikan::class, 'id', 'pendidikan');

    }

    public function statuskeluarga()
    {
        return $this->hasOne(KodeStatusKeluarga::class, 'id', 'status_keluarga');
    }

    public function regencies()
    {
        return $this->hasOne(Regency::class, 'id', 'kota');
    }

    public function districts()
    {
        return $this->hasOne(District::class, 'id', 'kecamatan');
    }

    public function villages()
    {
        return $this->hasOne(Village::class, 'id', 'desa');
    }

    public function province()
    {
        return $this->hasOne(Province::class, 'id', 'provinsi');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'kota');
    }

    public function status_keanggotaans()
    {
        return $this->hasOne(StatusKeanggotaan::class, 'id', 'id_status_keanggotaan');

    }
    public function scopeNonactive($query)
    {
        return $query->where('id_status_keanggotaan','=','0');
    }
    public function status_rekening()
    {
        return $this->hasOne(RekeningSimpanan::class, 'anggota_id', 'id');
    }
    public function rekenings()
    {
        return $this->hasMany(RekeningSimpanan::class, 'anggota_id', 'id');
    }
    public function rekeningSimjaka()
    {
        return $this->hasMany(RekeningSimjaka::class, 'anggota_id', 'id');
    }
    public function rekeningPendanaan()
    {
        return $this->hasMany(RekeningPendanaan::class, 'anggota_id', 'id');
    }
    public function rekeningPembiayaan() {
        return $this->hasMany(RekeningPembiayaan::class, 'anggota_id', 'id');
    }
}
