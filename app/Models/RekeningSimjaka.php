<?php

namespace App\Models;

use App\Facades\Ledger;
use App\Traits\Ledgerable;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class RekeningSimjaka extends Model
{
    use HasFactory, Ledgerable,Filterable;

    protected $table = 'rekening';


    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public $appends = ['saldo'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tanggal_aktif' => 'date',
        'tanggal_jatuh_tempo' => 'date',
    ];

    protected static function booted()
    {
        static::addGlobalScope('simjaka', function (Builder $builder) {
            $builder->where('rekening_type', '=', get_class());
        });

        static::addGlobalScope('simjaka_by_cabang', function (Builder $builder) {
            $builder->where('cabang_unit', '=', auth()->user()->cabang_unit);
        });

        static::creating(function ($simpanan) {
            $simpanan->rekening_type = get_class();
            $simpanan->cabang_unit = auth()->user()->cabang_unit;
        });
    }


    public function anggota() {
        return $this->belongsTo(Anggota::class);
    }

    public function akunOfficer() {
        return $this->belongsTo(AkunOfficer::class, 'ao_id', 'id');
    }

    public function produk() {
        return $this->belongsTo(produkRekeningSimpanan::class);
    }
    public function akads() {
        return $this->hasOne(Akad::class,'id','pilihan_akad');
    }
    public function tujuan_pengajuans() {
        return $this->hasOne(TujuanPengajuan::class,'id','tujuan_pengajuan');
    }
    public function sumber_danas() {
        return $this->hasOne(SumberDana::class,'id','sumber_dana');
    }
    public function rekening_basil() {
        // return $this->belongsTo(RekeningSimpanan::class, 'id', 'rek_transfer_basil');
        return $this->belongsTo(RekeningSimpanan::class, 'rek_transfer_basil', 'id');
    }
    public function ledger(){
        return $this->hasOne(LedgerEntry::class,'ledgerable_id','id');
    }

    public function debit($from, $amount, $amount_currency="UGX", $reason, $ledger)
    {
        $amount = $amount * -1;

        return Ledger::debit($this, $from, $amount, $amount_currency, $reason, $ledger);
    }
    public function credit($to, $amount, $amount_currency="UGX", $reason, $ledger)
    {
        $amount = $amount * -1;

        return Ledger::credit($this, $to, $amount, $amount_currency, $reason, $ledger);
    }

    public function getAroTextAttribute() {

        switch ($this->attributes['aro']){
            case '0' :
                return 'TIDAK';

            case '1' :
                return 'YA';

            default:
                return '-';
        }
    }

    public function getSaldoAttribute(){
        return $this->balance();
    }
}
