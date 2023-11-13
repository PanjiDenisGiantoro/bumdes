<?php

namespace App\Http\Controllers;

use App\Models\AkunOfficer;
use App\Models\AkunPerkiraan;
use App\Models\Anggota;
use App\Models\KodeProfil;
use App\Models\User;
use Illuminate\Http\Request;

class AkunOfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $daftarAO = AkunOfficer::all();

        if ($request->ajax()) {

            $daftarAO->map(function ($a, $i) {
                // $a->text = 'AO ' . $a->jenis_ao. ' -' .$a->nama;
                $a->text = $a->nama;
            });
            return response()->json(['results' => $daftarAO]);
        }

        return view("akun-officer.index", compact('daftarAO'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $daftarAnggota = Anggota::all();
        // $daftarKaryawan = User::all();
        $daftarKaryawan = KodeProfil::all();
        $daftarCoa = AkunPerkiraan::all();

        return view("akun-officer.form", compact('daftarAnggota', 'daftarKaryawan', 'daftarCoa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->jenis_ao == 'agen') {
            $request->merge([
                'user_type' => 'App\Models\Anggota',
                'penampungan_type' => 'App\Models\RekeningSimpanan',
            ]);
        } else {
            $request->merge([
                'user_type' => 'App\Models\KodeProfil',
                'penampungan_type' => 'App\Models\AkunPerkiraan',
            ]);
        }

        AkunOfficer::create($request->except('_token'));
            
        return \redirect()
            ->route("akun-officer.index")
            ->with("message",("Akun Officer berhasil terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AkunOfficer  $akunOfficer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $officer = AkunOfficer::where('id', '=', $id)->first();

        $daftarAnggota = Anggota::all();
        $daftarKaryawan = KodeProfil::all();
        $daftarCoa = AkunPerkiraan::all();

        $viewMode = true;

        return view("akun-officer.form", compact('officer', 'daftarAnggota', 'daftarKaryawan', 'daftarCoa', 'viewMode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AkunOfficer  $akunOfficer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $officer = AkunOfficer::where('id', '=', $id)->first();

        $daftarAnggota = Anggota::all();
        $daftarKaryawan = KodeProfil::all();
        $daftarCoa = AkunPerkiraan::all();

        return view("akun-officer.form", compact('officer', 'daftarAnggota', 'daftarKaryawan', 'daftarCoa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AkunOfficer  $akunOfficer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dump($id);
        // dd($request->all());

        $ao = AkunOfficer::where('id', '=', $id)->first();
        $ao->update($request->only(['status_ao', 'status_apps', 'keterangan', 'penampungan_id']));
        
        return \redirect()
            ->route("akun-officer.index")
            ->with("message",("Akun Officer berhasil di edit"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AkunOfficer  $akunOfficer
     * @return \Illuminate\Http\Response
     */
    public function destroy(AkunOfficer $akunOfficer)
    {
        //
    }
}
