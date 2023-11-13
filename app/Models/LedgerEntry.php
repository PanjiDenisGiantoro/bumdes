<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LedgerEntry extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'credit'     => 'boolean',
        'debit'      => 'boolean',
        'created_at' => 'datetime'
    ];

    /**
     * @var array
     */
    protected $table = 'ledger_entries';

    protected $guarded = ['id'];
//    protected $fillable = [
//        'ledger_id',
//        'reason',
//        'debit',
//        'credit',
//        'amount_currency',
//        'amount',
//        'current_balance_currency',
//        'current_balance',
//        'money_to',
//        'money_from',
//    ];

    /**
     * Get the ledgerable entity that the entry belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function ledgerable()
    {
        return $this->morphTo();
    }

    public function ledger()
    {
        return $this->belongsTo(Ledger::class, 'ledger_id');
    }
    public function rekenings()
    {
        return $this->hasOne(RekeningSimpanan::class,'id','ledgerable_id');
    }

}
