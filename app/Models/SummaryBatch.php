<?php

namespace App\Models;

use Cknow\Money\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SummaryBatch extends Model
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
        'tanggal_kelulusan' => 'date',
        'tanggal_jatuh_tempo' => 'date'
        // 'plafond_pembiayaan' => MoneyCast::class,
        // 'interest' => MoneyCast::class,
    ];

    public $with = ['pendana'];
    public $appends = ['angsuran_bulanan'];


    public function getStatusTextAttribute()
    {
        switch ($this->attributes['status'])
        {
            case '0' :
                return ' Masih Aktif';

            case '1' :
                return 'Telah Disetujui';

            default:
                return '-';
        }
    }

    public function getTotalPenyetujuanDanaAttribute() {
        $setuju = $this->nominal_dana * $this->approved ?? 0;
        return $setuju;
    }

    public function getAngsuranBulananAttribute() {
        $angsuran = $this->plafond_pembiayaan / $this->jangka_waktu;
        return $angsuran;
    }

    public function getTanggalAngsuranAttribute() {
        $mulaiAngsuran = \Carbon\Carbon::parse($this->tanggal_kelulusan)->addMonths(1)->format('d-m-Y');
        return $mulaiAngsuran;
    }


    public function pendana() {
        return $this->belongsTo(SettingBatch::class, 'sumber_pendanaan');
    }

    public function produk_simpanan() {
        return $this->belongsTo(produkRekeningSimpanan::class, 'rekening_simpanan_id');
    }

    public function coa_pembiayaan() {
        return $this->belongsTo(AkunPerkiraan::class, 'gl_pembiayaan_pendanaan');
    }

    public function pengajuan_pendanaan() {
        return $this->hasMany(DaftarPembiayaan::class, 'batch', 'id');
    }
}
