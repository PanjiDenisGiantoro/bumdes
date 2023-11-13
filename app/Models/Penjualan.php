<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualans';
    public $guarded = ["id"];
    protected $casts = [
        "tanggal_pengajuan" => "date",
        "tanggal_jatuh_tempo" => "datetime:d-m-Y",
    ];

    public function anggotas()
    {
        return $this->hasOne(Anggota::class,'id','id_pelanggan');
    }
    public function termins()
    {
        return $this->hasOne(TerminPenjualan::class,'id','id_termin');
    }
    public function pajak()
    {
        return $this->hasOne(TerminPenjualan::class,'id','id_termin');
    }

    public function penjualanbodies()
    {
        return $this->hasOne(PenjualanBody::class,'id_penjualan','id');
    }


}
