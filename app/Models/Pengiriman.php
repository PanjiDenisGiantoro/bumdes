<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;
    protected $table = 'pengirimans';
    protected $casts = [
        'tgl_jatuh_tempo' => 'datetime:d-m-Y',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'tanggal_pengiriman',
    ];

    public $guarded = ["id"];
    
    public function pemesanans()
    {
        return $this->hasOne(PemesananPenjualan::class,'id','no_pemesanan');
    }
    public function pengirimanbody()
    {
        return $this->hasOne(PengirimanBody::class,'id_pemesanan','id');
    }
    public function pengirimanbodies()
    {
        // return $this->hasOne(PengirimanBody::class,'id_pengiriman','id');
        return $this->hasMany(PengirimanBody::class,'id_pengiriman','id');
    }
    public function pelanggans()
    {
        return $this->hasOne(Anggota::class,'id','id_pelanggan');
    }
    public function pelanggan_nama()
    {
        return $this->hasOne(Anggota::class,'id','non_anggota');
    }
    //relasi table pengirimans dengan termin
    public function termins()
    {
        return $this->hasOne(TerminPenjualan::class,'id','termin_pengiriman');
    }
    public function scopeLunas($query)
    {
        return $query->where('status_pembayaran_penjualan','!=','Lunas');
    }

    public function history()
    {
        return $this->hasMany(HistoryPenjualan::class,'id_pengiriman','id');
    }
}
