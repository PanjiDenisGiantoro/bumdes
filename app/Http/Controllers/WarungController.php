<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\DaftarPembiayaan;
use App\Models\DaftarWarung;
use App\Models\Warung;
use Illuminate\Http\Request;

class WarungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warungs = Warung::paginate();

        return view("warung.index", \compact("warungs"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("warung.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Warung::create($request->all());

        return redirect()
            ->route("warung.index")
            ->with("success", __("Daftar warung berjaya"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function show(Warung $warung)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function edit(Warung $warung)
    {
        return view("warung.form", \compact("warung"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warung $warung)
    {
        $warung->fill($request->all());

        $warung->save();

        return redirect()
            ->route("warung.index")
            ->with("success", __("Perbaharui warung berjaya"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warung $warung)
    {
        //
    }

    public function getdata(Request $request)
    {
        $anggota = Anggota::leftJoin('indonesia_provinces','indonesia_provinces.id','=','anggotas.provinsi')
        ->leftJoin('indonesia_cities','indonesia_cities.id','=','anggotas.kota')
        ->leftJoin('indonesia_districts','indonesia_districts.id','=','anggotas.kecamatan')
        ->leftJoin('indonesia_villages','indonesia_villages.id','=','anggotas.desa')
        ->where('anggotas.id',$request->country_id)
        ->select('indonesia_provinces.name as prov','indonesia_cities.name as ko','indonesia_districts.name as kec','indonesia_villages.name as des','anggotas.*')
        ->first();

        return response()->json($anggota);
    }

    public function getdatawarung(Request $request)
    {
        $anggota = DaftarWarung::join('indonesia_provinces','indonesia_provinces.id','=','daftar_warungs.provinsi')
            ->join('indonesia_cities','indonesia_cities.id','=','daftar_warungs.kota')
            ->join('indonesia_districts','indonesia_districts.id','=','daftar_warungs.kecamatan')
            ->join('indonesia_villages','indonesia_villages.id','=','daftar_warungs.desa')
            ->where('daftar_warungs.id',$request->country_id)
            ->select('indonesia_provinces.name as prov','indonesia_cities.name as ko','indonesia_districts.name as kec','indonesia_villages.name as des','daftar_warungs.*')
            ->first();

        return response()->json($anggota);
    }
    public function getdatapembiayaan(Request $request)
    {
        $pembiayaan = DaftarWarung::with('anggota')->where('nama_anggota',$request->country_id)->first();
        return response()->json($pembiayaan);
    }

}
