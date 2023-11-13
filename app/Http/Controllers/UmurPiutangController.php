<?php

namespace App\Http\Controllers;

use App\Models\PemesananPenjualan;
use App\Models\Pengiriman;
use App\Models\PengirimanBody;
use App\Models\Penjualan;
use App\Models\UmurPiutang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UmurPiutangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();
        $pengiriman = Pengiriman::with('termins')->where('status_pembayaran_penjualan', '=', 'Belum Lunas')->paginate(10);
        $jatuhtempo = Pengiriman::where('status_pembayaran_penjualan', '=', 'Belum Lunas')->with('history')->paginate();
        // dd($jatuhtempo);
        $history = DB::select('SELECT pengirimans.non_anggota,history_penjualan.total,
        SUM(IF( TIMESTAMPDIFF(day, history_penjualan.created_at  , CURDATE())  < 30, history_penjualan.bayar , 0)) AS kurang_satu_bulan,
            SUM(IF( TIMESTAMPDIFF(day, history_penjualan.created_at , CURDATE())  between 30 and 60, history_penjualan.bayar , 0)) AS satu_bulan,
              SUM(IF( TIMESTAMPDIFF(day, history_penjualan.created_at , CURDATE())  between 60 and 90, history_penjualan.bayar , 0)) AS dua_bulan,
                SUM(IF( TIMESTAMPDIFF(day, history_penjualan.created_at , CURDATE())  between 90 and 120, history_penjualan.bayar , 0)) AS tiga_bulan,
                SUM(IF( TIMESTAMPDIFF(day, history_penjualan.created_at , CURDATE())  > 120, history_penjualan.bayar , 0)) AS empat_bulan
    FROM history_penjualan
    left join pengirimans on pengirimans.id = history_penjualan.id_pengiriman
    GROUP BY non_anggota 
    ');

        // ->whereRaw(' STR_TO_DATE(tgl_jatuh_tempo, "%Y-%m-%d") <= "'.now().'"')
            // ->sum('sisa_tagihan');

        // $pengiriman = Penjualan::with('penjualanbodies')->get();
        // ddd($pengiriman);

        return view("semua_laporan.umur_piutang.index", compact('pengiriman', 'jatuhtempo','history'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.umur_piutang.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        UmurPiutang::create($request->all());

        return \redirect()
            ->route("semua_laporan.umur_piutang.index")
            ->with("success", __("Pengajuan Umur Piutang Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(UmurPiutang $umur_piutang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(UmurPiutang $umur_piutang)
    {
        return view("umur_piutang.form", \compact("umur_piutang"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UmurPiutang $umur_piutang)
    {
        $umur_piutang->fill($request->all());

        $umur_piutang->save();

        return redirect()
            ->route("umur_piutang.index")
            ->with("success", __("Perbaharui Umur Piutang Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(UmurPiutang $umur_piutang)
    {
        //
    }
}
