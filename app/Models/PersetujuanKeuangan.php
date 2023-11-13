<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersetujuanKeuangan extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    public $guarded = ["id"];
    protected $table = 'persetujuan_keuangans';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        "tanggal_pengajuan" => "date",
    ];


    public function getStatusPersetjuanTextAttribute()
    {
        switch ($this->attributes['status_persetjuan']) {
            case '2':
                $status_persetjuan = 'Tidak Aktif';
                break;

            case '1':
                $status_persetjuan = 'Aktif';
                break;
            default:
                $status_persetjuan = '-';
                break;
        }

        return $status_persetjuan;
    }
    public function warung()
    {
        return $this->belongsTo(Warung::class);
    }
    public function penggunas()
    {
        return $this->hasOne(KodePengguna::class,'id','id_jabatan');
    }
}
