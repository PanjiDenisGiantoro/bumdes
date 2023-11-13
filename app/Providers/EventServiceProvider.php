<?php

namespace App\Providers;

use App\Models\Anggota;
use App\Models\Carts;
use App\Models\DaftarWarung;
use App\Models\Ledger;
use App\Models\RekeningPendanaan;
use App\Observers\AnggotaObserver;
use App\Observers\CartObserver;
use App\Observers\DaftarWarungObserver;
use App\Observers\LedgerObserver;
use App\Observers\RekeningPendanaanObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [SendEmailVerificationNotification::class],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Anggota::observe(AnggotaObserver::class);
        DaftarWarung::observe(DaftarWarungObserver::class);
        Ledger::observe(LedgerObserver::class);
        RekeningPendanaan::observe(RekeningPendanaanObserver::class);
        Carts::observe(CartObserver::class);
    }
}
