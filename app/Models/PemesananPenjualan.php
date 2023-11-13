<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananPenjualan extends Model
{
    use HasFactory;
    protected $table = 'pemesanan_penjualans';
    public $guarded = ["id"];
    protected $casts = [
        'tgl_jatuh_tempo' => 'date',
    ];

    public function penawaran()
    {
        return $this->hasOne(Penjualan::class,'id','no_penawaran');
    }
    public function pemesanans()
    {
        return $this->hasOne(PemesananPenjualanBody::class,'id_pemesanan','id');
    }
    public function pelanggans()
    {
        return $this->hasOne(Anggota::class,'id','id_pelanggan');
    }
    public function anggotas()
    {
        return $this->hasOne(Anggota::class,'id','id_pelanggan');
    }
    public function termins()
    {
        return $this->hasOne(TerminPenjualan::class,'id','termin_pemesanan');
    }
    public function pengirimans()
    {
        return $this->hasOne(Pengiriman::class,'no_pemesanan','id');
    }
    public function rekenings()
    {
        return $this->hasOne(RekeningSimpanan::class,'anggota_id','id_pelanggan');
    }

}
