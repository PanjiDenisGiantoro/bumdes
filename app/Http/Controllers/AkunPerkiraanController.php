<?php

namespace App\Http\Controllers;

use App\Models\AkunPerkiraan;
use App\Models\KodeKelompok;
use Illuminate\Http\Request;

class AkunPerkiraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kodes = KodeKelompok::whereNull('parent_id')->get();

        $kode = KodeKelompok::where('id', $request->descendant_of)->first();

        $akuns = collect();
        
        if(request()->ajax()) {
            $akuns = AkunPerkiraan::filter(request()->all())
                ->when(request()->ajax(), function ($query) {
                    $query->whereNotNull('parent_id');
                })
                ->withDepth()
                ->defaultOrder()
                ->paginate(request()->query('limit', 15));

            $akuns->map(function ($akun) {
                $akun->text = $akun->kode . ' - ' . $akun->nama;
                $akun->parent_id  = $akun->parent_id ?? 0;
            });

            return $akuns;
        }

        return view("setting_keuangan.akun_perkiraan.index", \compact("akuns", 'kodes', 'kode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kodes = KodeKelompok::whereNull('parent_id')->get();

        return view("setting_keuangan.akun_perkiraan.form", \compact("kodes"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AkunPerkiraan::create($request->all());

        return \redirect()
            ->route("akun_perkiraan.index")
            ->with("message",("Akun Perkiraan Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(AkunPerkiraan $akun_perkiraan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $akun_perkiraan = AkunPerkiraan::with([
            'ancestors' => function ($query) {
                $query->withDepth();
            },
        ])
        ->withDepth()
        ->findOrFail($id);

        $kodes = KodeKelompok::defaultOrder()->where('id', '!=', $akun_perkiraan->id)->get();

        return view("setting_keuangan.akun_perkiraan.form", \compact("akun_perkiraan", "kodes"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AkunPerkiraan $akun_perkiraan)
    {
        $akun_perkiraan->fill($request->all());

        $akun_perkiraan->save();

        return redirect()
            ->route("akun_perkiraan.index")
            ->with("message", (" Akun Perkiraan Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AkunPerkiraan::destroy($id);

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Akun Perkiraan Berhasil Terhapus',
            ]);
        }

        return redirect()
            ->route("akun_perkiraan.index")
            ->with("message",(" Akun Perkiraan Berhasil Terhapus"));
    }
}
