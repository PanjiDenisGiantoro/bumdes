<?php

namespace App\Http\Controllers;

use App\Models\PerubahanModal;
use Illuminate\Http\Request;

class PerubahanModalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (empty($request->query('datefilter'))) {
            $request->merge([
                'datefilter' => implode(' - ', [
                    now()->startOfMonth()->format('d/m/Y'),
                    now()->endOfMonth()->format('d/m/Y'),
                ]),
            ]);
        }

        $dates = array_unique(explode(' - ', $request->query('datefilter')));

        

        return view("semua_laporan.perubahan_modal.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.perubahan_modal.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PerubahanModal::create($request->all());

        return \redirect()
            ->route("semua_laporan.perubahan_modal.index")
            ->with("success", __("Pengajuan Perubahan Modal Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(PerubahanModal $perubahan_modal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(PerubahanModal $perubahan_modal)
    {
        return view("perubahan_modal.form", \compact("perubahan_modal"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PerubahanModal $perubahan_modal)
    {
        $perubahan_modal->fill($request->all());

        $perubahan_modal->save();

        return redirect()
            ->route("perubahan_modal.index")
            ->with("success", __("Perbaharui Perubahan Modal Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PerubahanModal $perubahan_modal)
    {
        //
    }
}
