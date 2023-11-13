<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\RingkasanAsetTetap;
use Illuminate\Http\Request;

class RingkasanAsetTetapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        $list =Aset::with('kelompokaset','akun_perkiraan')->paginate(10);
        $aset = $list->groupBy('akun_aset_tetap');
        foreach($aset as $i => $data) {
            $total = 0;
            $round = 0;
            foreach($data as $r => $amount) {
                $total += $amount['biaya_akuisisi'];
                $round += 1;
            }
            $aset[$i]->amount = $total;
            $aset[$i]->round = $round;
        }
//        ddd($aset);
        return view("semua_laporan.ringkasan_aset_tetap.index",compact('list','aset'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.ringkasan_aset_tetap.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RingkasanAsetTetap::create($request->all());

        return \redirect()
            ->route("semua_laporan.ringkasan_aset_tetap.index")
            ->with("success", __("Pengajuan Ringkasan Aset Tetap Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(RingkasanAsetTetap $ringkasan_aset_tetap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(RingkasanAsetTetap $ringkasan_aset_tetap)
    {
        return view("ringkasan_aset_tetap.form", \compact("ringkasan_aset_tetap"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RingkasanAsetTetap $ringkasan_aset_tetap)
    {
        $ringkasan_aset_tetap->fill($request->all());

        $ringkasan_aset_tetap->save();

        return redirect()
            ->route("ringkasan_aset_tetap.index")
            ->with("success", __("Perbaharui Ringkasan Aset Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(RingkasanAsetTetap $ringkasan_aset_tetap)
    {
        //
    }
}
