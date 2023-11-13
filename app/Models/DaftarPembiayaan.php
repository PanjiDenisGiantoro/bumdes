<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPembiayaan extends Model
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
        "tanggal_lahir" => "date",
    ];
    protected $table = 'daftar_pembiayaans';

    public $with = ['batchs'];

    
    const STATUS_PENDING = 'baru';
    const STATUS_APPROVED = 'disetujui';
    // const STATUS_ACTIVE = 'aktif';
    const STATUS_REJECTED = 'ditolak';


    public function anggota()
    {
        return $this->belongsTo(Anggota::class,'id_anggota','id');
    }

    public function daftarwarung()
    {
        return $this->hasOne(DaftarWarung::class,'id_anggota','id_anggota');
    }
    public function batchs()
    {
        // return $this->hasOne(SettingBatch::class,'summary_batch','batch');
        return $this->belongsTo(SummaryBatch::class, 'batch', 'id');
    }
    public function sumber_pendanaan()
    {
        return $this->hasOne(SumberPendanaan::class,'id','dana_peyaluran');
    }
    public function ledgers(){
        return $this->hasMany(LedgerEntry::class,'ledgerable_id','id');
    }
    public function rekenings(){
        return $this->hasOne(RekeningSimpanan::class,'id_anggota','anggota_id');

    }

    public function rekeningPenyaluranDana() {
        return $this->belongsTo(RekeningSimpanan::class, 'rekening_simpanan_dana_id');
    }
    public function rekeningPendanaan() {
        return $this->belongsTo(RekeningPendanaan::class, 'rekening_pendanaan_id');
    }


    public function scopeNonactive($query)
    {
        return $query->where('final_status','=',0);
    }


}
