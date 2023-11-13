<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Ledger extends Model
{
    use HasFactory, Userstamps;

    /**
     * @var array
     */
    protected $fillable = [
        'type',
        'date',
        'journal_no',
        'reference',
        'description',
        'anggota_id',
        'akun',
        'jenis_transaksi',
        'dibayar_dari',
        'penerima',
        'jatuh_tempo',
        'termin',
        'bayar_value',
        'nominal',
        'margin'
    ];

    public function entries()
    {
        return $this->hasMany(LedgerEntry::class, 'ledger_id');
    }
    public function anggota()
    {
        return $this->hasOne(Anggota::class,'id', 'anggota_id');
    }
    public function jenis()
    {
        return $this->hasOne(JenisTransaksi::class,'id', 'jenis_transaksi');
    }
    public function akuns()
    {
        return $this->hasOne(AkunPerkiraan::class,'id', 'akun');
    }

    public function getJournalNumberAttribute()
    {
        if (!empty($this->attributes['type']) && !empty($this->attributes['journal_no']))
        return implode('-', [$this->attributes['type'], str_pad($this->attributes['journal_no'], 4, 0, STR_PAD_LEFT)]);
    }

}
