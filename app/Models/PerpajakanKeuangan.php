<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerpajakanKeuangan extends Model
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

    public function warung()
    {
        return $this->belongsTo(Warung::class);
    }
    public function pajak_penjualan()
    {
        return $this->hasOne(AkunPerkiraan::class,'id','akun_pajak_penjualan');
    }
    public function pajak_pembelian()
    {
        return $this->hasOne(AkunPerkiraan::class,'id','akun_pajak_pembelian');
    }
}
