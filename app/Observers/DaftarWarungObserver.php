<?php

namespace App\Observers;

use App\Models\Anggota;
use App\Models\DaftarWarung;
use Exception;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Support\Facades\Log;
use Spatie\Geocoder\Geocoder;

class DaftarWarungObserver
{
    /**
     * Handle the DaftarWarung "created" event.
     *
     * @param  \App\Models\DaftarWarung  $daftarWarung
     * @return void
     */
    public function created(DaftarWarung $daftarWarung)
    {
        if ($daftarWarung->tempat_sama) {
            $anggota = Anggota::find($daftarWarung->id_anggota);

            $daftarWarung->nama_jalan  = $anggota->nama_jalan;
            $daftarWarung->no_rumah    = $anggota->no_rumah;
            $daftarWarung->rtrw        = $anggota->rtrw;
            $daftarWarung->provinsi    = $anggota->provinsi;
            $daftarWarung->kota        = $anggota->kota;
            $daftarWarung->kecamatan   = $anggota->kecamatan;
            $daftarWarung->desa        = $anggota->desa;
            $daftarWarung->kodepos     = $anggota->kodepos;
            $daftarWarung->coordinates = $anggota->coordinates;

            $daftarWarung->saveQuietly();
        } else {
            $client   = new \GuzzleHttp\Client();

            $geocoder = new Geocoder($client);

            $geocoder->setApiKey(config('geocoder.key'));
            $geocoder->setCountry(config('geocoder.country', 'ID'));

            try {
                $results = $geocoder->getCoordinatesForAddress(\implode(', ', \array_filter([
                    $daftarWarung->villages->name  ?? \null,
                    $daftarWarung->city->name      ?? \null,
                    $daftarWarung->districts->name ?? \null,
                    $daftarWarung->province->name  ?? \null,
                ])));
    
                if (!empty($results)) {
                    $daftarWarung->coordinates = new Point($results['lat'], $results['lng']);
                    $daftarWarung->saveQuietly();
                }
            } catch (\Exception $e) {
                Log::debug($e);
            }
        }
    }

    /**
     * Handle the DaftarWarung "updated" event.
     *
     * @param  \App\Models\DaftarWarung  $daftarWarung
     * @return void
     */
    public function updated(DaftarWarung $daftarWarung)
    {
        try {
            if (
                $daftarWarung->wasChanged('provinsi')  ||
                $daftarWarung->wasChanged('kota')      ||
                $daftarWarung->wasChanged('kecamatan') ||
                $daftarWarung->wasChanged('desa')
            ) {
                $client   = new \GuzzleHttp\Client();

                $geocoder = new Geocoder($client);

                $geocoder->setApiKey(config('geocoder.key'));
                $geocoder->setCountry(config('geocoder.country', 'ID'));

                $results = $geocoder->getCoordinatesForAddress(\implode(', ', \array_filter([
                    $daftarWarung->villages->name  ?? \null,
                    $daftarWarung->city->name      ?? \null,
                    $daftarWarung->districts->name ?? \null,
                    $daftarWarung->province->name  ?? \null,
                ])));

                if (!empty($results)) {
                    $daftarWarung->coordinates = new Point($results['lat'], $results['lng']);
                    $daftarWarung->saveQuietly();
                }
            }
        } catch (Exception $e) {
            Log::debug($e);
        }
    }

    /**
     * Handle the DaftarWarung "deleted" event.
     *
     * @param  \App\Models\DaftarWarung  $daftarWarung
     * @return void
     */
    public function deleted(DaftarWarung $daftarWarung)
    {
        //
    }

    /**
     * Handle the DaftarWarung "restored" event.
     *
     * @param  \App\Models\DaftarWarung  $daftarWarung
     * @return void
     */
    public function restored(DaftarWarung $daftarWarung)
    {
        //
    }

    /**
     * Handle the DaftarWarung "force deleted" event.
     *
     * @param  \App\Models\DaftarWarung  $daftarWarung
     * @return void
     */
    public function forceDeleted(DaftarWarung $daftarWarung)
    {
        //
    }
}
