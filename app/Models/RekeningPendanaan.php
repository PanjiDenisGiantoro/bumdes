<?php

namespace App\Models;

use App\Facades\Ledger;
use App\Traits\Ledgerable;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekeningPendanaan extends Model
{
    use HasFactory,Filterable, Ledgerable;


    /**
     * TODO: NOTE ON PENGGUNAAN COLUMN TABLE
     * 
     * Column rek_transfer_basil digunakan untuk menyimpan id daftar_pembiayaan
     * Column produk_id digunakan untuk menyimpan id batch
     * 
     *  */

    protected $table = 'rekening';
    public $guarded = ["id"];
    public $appends = ['saldo'];

    protected static function booted()
    {
        static::addGlobalScope('pendanaan', function (Builder $builder) {
            $builder->where('rekening_type', '=', get_class());
        });
        
        static::addGlobalScope('pendanaan_by_cabang', function (Builder $builder) {
            $builder->where('cabang_unit', '=', auth()->user()->cabang_unit);
        });
        
        static::creating(function ($pendanaan) {
            $pendanaan->rekening_type = get_class();
            $pendanaan->cabang_unit = auth()->user()->cabang_unit;
        });
    }


    public function anggota() {
        return $this->belongsTo(Anggota::class);
    }
    public function pendanaan() {
        return $this->belongsTo(SummaryBatch::class, 'produk_id', 'id');
    }

    public function getSaldoAttribute(){
        return $this->balance();
    }

    public function pengajuanPendanaan() {
        return $this->belongsTo(DaftarPembiayaan::class, 'id', 'rekening_pendanaan_id');
    }
    
    public function debit($from, $amount, $amount_currency="UGX", $reason, $ledger_id)
    {
        // $amount = $amount * -1;
        return Ledger::debit($this, $from, $amount, $amount_currency, $reason, $ledger_id);
    }

    public function credit($to, $amount, $amount_currency="UGX", $reason, $ledger_id)
    {
        // $amount = $amount * -1;
        return Ledger::credit($this, $to, $amount, $amount_currency, $reason, $ledger_id);
    }
}
