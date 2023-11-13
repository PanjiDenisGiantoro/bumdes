<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\KodePerusahaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cabang = Cabang::paginate(10);
        return view("tetapan.cabang.index",compact('cabang'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $koperasi = KodePerusahaan::first();

//        num rows cabang
        $cabangfind = Cabang::count();
        return view("tetapan.cabang.form",compact('koperasi','cabangfind'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $count = Cabang::count('id') +1 ;
            $cabang=  Cabang::create($request->except('coordinates'));
            $admin = User::create([
                'name' => $cabang->nama_cabang,
                'email' => $cabang->email,
                'password' => bcrypt($cabang->kode_cabang),
                'cabang_unit' => $count,
                'sub_branch_unit' => $cabang->jenis_cabang,
            ]);
            $admin->assignRole('admin');
            DB::commit();
                   return redirect()->route('cabang.index')->with('message', 'Data berhasil disimpan');
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->route('cabang.index')
                ->with('error', 'Transaksi gagal: ' . $e->getMessage());
            // something went wrong
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cabang  $cabang
     * @return \Illuminate\Http\Response
     */
    public function show(Cabang $cabang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cabang  $cabang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cabangfind = Cabang::count();

        $cabang = Cabang::where('id',$id)->first();
        $daftar_warung = Cabang::leftJoin('indonesia_provinces', 'indonesia_provinces.id', '=', 'cabangs.provinsi')
            ->leftJoin('indonesia_cities', 'indonesia_cities.id', '=', 'cabangs.kota')
            ->leftJoin('indonesia_districts', 'indonesia_districts.id', '=', 'cabangs.kecamatan')
            ->leftJoin('indonesia_villages', 'indonesia_villages.id', '=', 'cabangs.desa')
            // ->where('daftar_warungs.ids', $id)
            ->select('indonesia_provinces.name as provinsi', 'indonesia_cities.name as ko', 'indonesia_districts.name as kec', 'indonesia_villages.name as des', 'cabangs.*')
            // ->first();
            ->findOrFail($id);


        return view("tetapan.cabang.edit", \compact('cabang','daftar_warung','cabangfind'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cabang  $cabang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cabang = Cabang::find($id);
        $cabang->update($request->except('coordinates'));
        return redirect()
            ->route('cabang.index')
            ->with("message",("Cabang Berhasil Terupdate"));
    }
    public function updatestatus( $id)
    {
        $cabang = Cabang::find($id);
        if ($cabang->status == 1) {
            $cabang->update(['status_cabang' => 0]);
        } else {
            $cabang->update(['status_cabang' => 1]);
        }
        return redirect()
            ->route('cabang.index')
            ->with("message",("Status Cabang Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cabang  $cabang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cabang $cabang,$id)
    {
        $cabang = Cabang::where('id',$id);
        $cabang->delete();
        return redirect()
            ->route("cabang.index")
            ->with("message",(" Cabang Berhasil Terhapus"));

    }
}
