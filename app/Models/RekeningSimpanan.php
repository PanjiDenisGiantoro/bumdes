<?php

namespace App\Models;

use App\Facades\Ledger;
use App\Traits\Ledgerable;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekeningSimpanan extends Model
{
    use HasFactory,Filterable, Ledgerable;

    protected $table = 'rekening';

    public $guarded = ["id"];

    public $appends = ['saldo'];

    const STATUS_PENDING = 'baru';
    const STATUS_APPROVED = 'disetujui';
    const STATUS_ACTIVE = 'aktif';
    const STATUS_REJECTED = 'ditolak';


   protected static function booted()
   {
       static::addGlobalScope('simpanan', function (Builder $builder) {
           $builder->where('rekening_type', '=', get_class());
       });

    //    static::addGlobalScope('simpanan_by_cabang', function (Builder $builder) {
    //        $builder->where('cabang_unit', '=', auth()->user()->cabang_unit);
    //    });

       static::creating(function ($simpanan) {
           $simpanan->rekening_type = get_class();
           $simpanan->cabang_unit = auth()->user()->cabang_unit;
       });
   }

    public function getStatusTextAttribute()
    {
        switch ($this->attributes['status']) {
            case 'tidak_disetujui':
                $status = 'Tidak Disetujui';
                break;

            case 'disetujui':
                $status = 'Disetujui';
                break;
            default:
                $status = '-';
                break;
        }

        return $status;
    }
    public function anggota() {
        return $this->belongsTo(Anggota::class);
    }

    public function akunOfficer() {
        return $this->belongsTo(AkunOfficer::class, 'ao_id', 'id');
    }

    public function ledgerable()
    {
        return $this->morphTo();
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
    public function ledger(){
        return $this->hasOne(LedgerEntry::class,'ledgerable_id','id');
    }
    public function ledgers(){
        return $this->hasMany(LedgerEntry::class,'ledgerable_id','id');
    }

    // public function balance()
    // {
    //     return Ledger::balance($this) * -1;
    // }

    public function getSaldoAttribute()
    {
        return $this->balance();
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

}
