<?php

namespace App\Models\pengajuan;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\City;

class Pengajuan extends Model
{
    use HasFactory;
    protected $table = 'zpengajuans';
    protected $guarded = ['id'];


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
}
