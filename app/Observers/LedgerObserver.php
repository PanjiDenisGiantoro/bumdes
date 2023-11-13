<?php

namespace App\Observers;

use App\Models\Ledger;
use Illuminate\Support\Facades\Log;

class LedgerObserver
{
    /**
     * Handle the Ledger "created" event.
     *
     * @param  \App\Models\Ledger  $ledger
     * @return void
     */
    public function creating(Ledger $ledger)
    {    
        if (empty($ledger->journal_no)) {
            $ledger->journal_no = Ledger::where('type', $ledger->type)->max('journal_no') + 1;
        }
    }

    /**
     * Handle the Ledger "created" event.
     *
     * @param  \App\Models\Ledger  $ledger
     * @return void
     */
    public function created(Ledger $ledger)
    {
        // 
    }

    /**
     * Handle the Ledger "updated" event.
     *
     * @param  \App\Models\Ledger  $ledger
     * @return void
     */
    public function updated(Ledger $ledger)
    {
        //
    }

    /**
     * Handle the Ledger "deleted" event.
     *
     * @param  \App\Models\Ledger  $ledger
     * @return void
     */
    public function deleted(Ledger $ledger)
    {
        //
    }

    /**
     * Handle the Ledger "restored" event.
     *
     * @param  \App\Models\Ledger  $ledger
     * @return void
     */
    public function restored(Ledger $ledger)
    {
        //
    }

    /**
     * Handle the Ledger "force deleted" event.
     *
     * @param  \App\Models\Ledger  $ledger
     * @return void
     */
    public function forceDeleted(Ledger $ledger)
    {
        //
    }
}
