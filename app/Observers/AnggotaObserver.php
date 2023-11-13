<?php

namespace App\Observers;

use App\Models\Anggota;
use App\Models\DaftarWarung;
use Exception;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Support\Facades\Log;
use Spatie\Geocoder\Geocoder;

class AnggotaObserver
{
    /**
     * Handle the Anggota "created" event.
     *
     * @param  \App\Models\Anggota  $anggota
     * @return void
     */
    public function created(Anggota $anggota)
    {
        $client = new \GuzzleHttp\Client();

        $geocoder = new Geocoder($client);

        $geocoder->setApiKey(config('geocoder.key'));

        $geocoder->setCountry(config('geocoder.country', 'ID'));
        
        try {
            $results = $geocoder->getCoordinatesForAddress(\implode(', ', \array_filter([
                $anggota->villages->name  ?? \null,
                $anggota->city->name      ?? \null,
                $anggota->districts->name ?? \null,
                $anggota->province->name  ?? \null,
            ])));

            if (!empty($results)) {
                $anggota->coordinates = new Point($results['lat'], $results['lng']);
                $anggota->saveQuietly();
            }
        } catch (\Exception $e) {
            Log::debug($e);
        }
    }

    /**
     * Handle the Anggota "updated" event.
     *
     * @param  \App\Models\Anggota  $anggota
     * @return void
     */
    public function updated(Anggota $anggota)
    {
        try {
            if (
                $anggota->wasChanged('provinsi')  ||
                $anggota->wasChanged('kota')      ||
                $anggota->wasChanged('kecamatan') ||
                $anggota->wasChanged('desa')
            ) {
                $client = new \GuzzleHttp\Client();

                $geocoder = new Geocoder($client);

                $geocoder->setApiKey(config('geocoder.key'));

                $geocoder->setCountry(config('geocoder.country', 'ID'));

                $results = $geocoder->getCoordinatesForAddress(\implode(', ', \array_filter([
                    $anggota->villages->name  ?? \null,
                    $anggota->city->name      ?? \null,
                    $anggota->districts->name ?? \null,
                    $anggota->province->name  ?? \null,
                ])));

                if (!empty($results)) {
                    $anggota->coordinates = new Point($results['lat'], $results['lng']);
                    $anggota->saveQuietly();
                }
            }

            DaftarWarung::where('id_anggota', $anggota->id)
                ->where('tempat_sama', 1)
                ->update([
                    'nama_jalan'  => $anggota->nama_jalan ?? \null,
                    'no_rumah'    => $anggota->no_rumah ?? \null,
                    'rtrw'        => $anggota->rtrw ?? \null,
                    'provinsi'    => $anggota->provinsi ?? \null,
                    'kota'        => $anggota->kota ?? \null,
                    'kecamatan'   => $anggota->kecamatan ?? \null,
                    'desa'        => $anggota->desa ?? \null,
                    'kodepos'     => $anggota->kode_pos ?? \null,
                    'coordinates' => $anggota->coordinates ?? \null,
                ]);
        } catch (Exception $e) {
            Log::debug($e);
        }
    }

    /**
     * Handle the Anggota "deleted" event.
     *
     * @param  \App\Models\Anggota  $anggota
     * @return void
     */
    public function deleted(Anggota $anggota)
    {
        //
    }

    /**
     * Handle the Anggota "restored" event.
     *
     * @param  \App\Models\Anggota  $anggota
     * @return void
     */
    public function restored(Anggota $anggota)
    {
        //
    }

    /**
     * Handle the Anggota "force deleted" event.
     *
     * @param  \App\Models\Anggota  $anggota
     * @return void
     */
    public function forceDeleted(Anggota $anggota)
    {
        //
    }
}
