<?php

namespace App\Http\Controllers;

use App\Models\JenisTransaksi;
use Illuminate\Http\Request;

class JenisTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jenis_transaksi = JenisTransaksi::orderBy('created_at', 'DESC')->paginate(10);

        if ($request->ajax()) {

            if ($request->query('jenis')) {
                $transaksi = JenisTransaksi::where('macam_transaksi', '=', $request->query('jenis'))->get();
                return response()->json(['results' => $transaksi]);
            }

            $jenis_transaksi->map(function ($a, $i) {
                $a->text = $a->jenis_transaksi;
            });

            return response()->json(['results' => $jenis_transaksi]);
        }

        return view("setting_keuangan.jenis_transaksi.index",compact('jenis_transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("setting_keuangan.jenis_transaksi.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_transaksi' => 'required|unique:jenis_transaksis|max:255',
            'akun_id' => 'required',
        ]);

        JenisTransaksi::create($request->all());

        return \redirect()
            ->route("jenis_transaksi.index")
            ->with("message",(" Jenis Transaksi Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(JenisTransaksi $jenis_transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisTransaksi $request,$id)
    {
        $jenis_transaksi = JenisTransaksi::where('id',$id)->first();

        return view("setting_keuangan.jenis_transaksi.form", \compact("jenis_transaksi"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'akun_id' => 'required',
        ]);
        
        $jenis_transaksi = JenisTransaksi::find($id);

        $jenis_transaksi->fill($request->all());

        $jenis_transaksi->save();

        return redirect()
            ->route("jenis_transaksi.index")
            ->with("message", (" Jenis Transaksi Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $KategoriProduk = JenisTransaksi::where('id',$id);
        $KategoriProduk->delete();
        return redirect()
            ->route("jenis_transaksi.index")
            ->with("message",(" Jenis Transaksi Berhasil Terhapus"));
    }
}
