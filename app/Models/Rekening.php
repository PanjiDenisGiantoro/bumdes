<?php

namespace App\Models;

use App\Facades\Ledger;
use App\Traits\Ledgerable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory ,Ledgerable;
    protected $table = 'rekening';

    public $guarded = ["id"];

    public $appends = ['saldo'];

    public function anggota() {
        return $this->belongsTo(Anggota::class);
    }
    public function ledgerable()
    {
        return $this->morphTo();
    }
    public function produk() {
        return $this->belongsTo(produkRekeningSimpanan::class);
    }
    public function produk_pembiayaan() {
        return $this->hasOne(ProdukRekeningPembiayaan::class);
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
