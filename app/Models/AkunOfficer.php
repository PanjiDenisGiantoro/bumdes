<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AkunOfficer extends Model
{
    use HasFactory;

    
    const TYPE_BIASA = 'simpanan';

    const TYPE_BERJANGKA = 'berjangka';
    const TYPE_PEMBIAYAAN = 'berjangka';

    public $guarded = [];

    protected static function booted(){
        static::addGlobalScope('active_ao', function (Builder $builder) {
            $builder->where('status_ao', '=', '1');
        });
    }
    
//
//    public function getNoIdAttribute() {
//
//        $profile = $this->user_type::where('id', '=', $this->user_id)->first();
//        return $profile->no_mitra ?? $profile->id_pengguna;
//    }

    public function getNamaAttribute() {

        $profile = $this->user_type::where('id', '=', $this->user_id)->first();
        return $profile->nama_pemohon ?? $profile->nama_pegawai;
    }

    public function getNoHpAttribute() {

        $profile = $this->user_type::where('id', '=', $this->user_id)->first();
        return $profile->no_hp ?? $profile->no_telpon ?? $profile->no_telp;
    }

    public function getPenampungAttribute() {

        $penampung = $this->penampungan_type::where('id', '=', $this->penampungan_id)->first();
        if ($penampung->produk != '') {
            return $penampung->no_akun . ' - ' . $penampung->produk->nama_simpanan;
        } else {
            return $penampung->kode . ' - ' . $penampung->nama;
        }
    }

    // public function getKeteranganAttribute() {

    // }

    public function getStatusTextAttribute() {

        switch ($this->attributes['status_ao'])
        {
            case '0' :
                return 'Tidak Aktif';

            case '1' :
                return 'Aktif';

            default:
                return 'Aktif';
        }
    }



    public function user() {

        if ($this->user_type === 'App\Models\Anggota'){
            return $this->belongsTo(Anggota::class, 'user_id');

        } else if ($this->user_type === 'App\Models\KodeProfil'){
            return $this->belongsTo(KodeProfil::class, 'user_id');
        }
    }

    public function simpananBiasa() {
        return $this->hasMany(RekeningSimpanan::class, 'ao_id', 'id');
    }

    public function simpananBerjangka() {
        return $this->hasMany(RekeningSimjaka::class, 'ao_id', 'id');
    }
    
    public function pembiayaan() {
        return $this->hasMany(RekeningPembiayaan::class, 'ao_id', 'id');
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('penampungan_type', '=', $type);
    }

}
