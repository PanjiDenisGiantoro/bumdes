<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\DaftarWarung;
use App\Models\KodeBidangUsaha;
use App\Models\KodePerusahaan;
use App\Models\KodeStatusBangunan;
use App\Models\StatusKeanggotaan;
use Barryvdh\DomPDF\Facade as PDF;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Image;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class DaftarWarungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftar_warungs = DaftarWarung::filter(request()->all())
            ->when(\in_array(Route::currentRouteName(), ['pages.daftar_warung.index', 'pages.daftar_warung.search']), function ($query) {
                $query->where('status_aktif', 1);
            })
            ->with('anggota.pembiayaan','status_keanggotaans')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        $daftar_warungs->map(function ($warung) {
            $warung->photo = collect(Storage::disk('public')->files('warung/' . $warung->id))->first();
        });

        if (Route::currentRouteName() == 'pages.daftar_warung.index' || Route::currentRouteName() == 'pages.daftar_warung.search') {
            $topProvinces = DaftarWarung::
                selectRaw('kota, count(*) as total')
                 ->where('wilayah',155)
                 ->orWhere('wilayah',156)
                 ->orWhere('wilayah',157)
                 ->orWhere('wilayah',158)
                 ->orWhere('wilayah',159)
                 ->orWhere('wilayah',160)
                ->groupBy('wilayah')
                ->with('city')
                ->get();

            return view('daftar_warung.public_index', \compact('daftar_warungs', 'topProvinces'));
        }

        return view("daftar_warung.index", \compact("daftar_warungs"));
        // // $daftar_warungs = DaftarWarung::paginate();

        // return view("daftar_warung.index");
        //  // \compact("daftar_warungs"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bidangusaha = KodeBidangUsaha::pluck('bidang_usaha', 'id');
        $status = StatusKeanggotaan::pluck('status_keanggotaan', 'id');
        $wilayah = DB::table('indonesia_cities')->where('province_code',31)->get();

        $anggota = Anggota::where('status_aktif','=','1')->pluck('nama_pemohon', 'id');
        $bangunan = KodeStatusBangunan::pluck('status_bangunan', 'id');
        return view("daftar_warung.form", compact('wilayah','anggota', 'status','bidangusaha', 'bangunan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $anggota = Anggota::find($request->id_anggota);
        $file_serfie[] = $request->file('file_ktp');
        $file_serfie[] = $request->file('file_fktp2');
        $file_serfie[] = $request->file('file_fktp3');
        $file_serfie[] = $request->file('file_fktp4');

        $ok = DaftarWarung::create($request->except('coordinates'));

        foreach ($file_serfie as $i => $file) {
            if (!empty($file)) {
                if ($i == 0) {
                    $file->storeAs("warung/{$ok->id}", '' . $file->getClientOriginalName(), 'public');
                    $file->storeAs("warung/0/{$ok->id}", '' . $file->getClientOriginalName(), 'public');
                } else {
                    $file->storeAs("warung{$i}/{$ok->id}", '' . $file->getClientOriginalName(), 'public');
                }
            }
        }

        return redirect()
            ->route("daftar_warung.index")
            ->with("message",("Daftar Warung Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $bidangusaha = KodeBidangUsaha::pluck('bidang_usaha', 'id');

        $anggota = Anggota::nonactive()->pluck('nama_pemohon', 'id');
        $bangunan = KodeStatusBangunan::pluck('status_bangunan', 'id');
        $status = StatusKeanggotaan::pluck('status_keanggotaan', 'id');
        $wilayah = DB::table('indonesia_cities')->where('province_code',31)->get();
        $daftar_warung = DaftarWarung::with('anggota')
            ->leftJoin('indonesia_provinces', 'indonesia_provinces.id', '=', 'daftar_warungs.provinsi')
            ->leftJoin('indonesia_cities', 'indonesia_cities.id', '=', 'daftar_warungs.kota')
            ->leftJoin('indonesia_districts', 'indonesia_districts.id', '=', 'daftar_warungs.kecamatan')
            ->leftJoin('indonesia_villages', 'indonesia_villages.id', '=', 'daftar_warungs.desa')
            // ->where('daftar_warungs.ids', $id)
            ->select('indonesia_provinces.name as prov', 'indonesia_cities.name as ko', 'indonesia_districts.name as kec', 'indonesia_villages.name as des', 'daftar_warungs.*')
            // ->first();
            ->findOrFail($id);

        $warung = Storage::disk('public')->files('warung/'.$id);
        $warung1 = Storage::disk('public')->files('warung1/'.$id);
        $warung2 = Storage::disk('public')->files('warung2/'.$id);
        $warung3 = Storage::disk('public')->files('warung3/'.$id);
        if (Route::currentRouteName() == 'pages.daftar_warung.show') {
            $daftar_warung->images = [
                collect(Storage::disk('public')->files('warung/' . $daftar_warung->id))->first(),
                collect(Storage::disk('public')->files('warung1/' . $daftar_warung->id))->first(),
                collect(Storage::disk('public')->files('warung2/' . $daftar_warung->id))->first(),
                collect(Storage::disk('public')->files('warung3/' . $daftar_warung->id))->first(),
            ];

            return view('daftar_warung.public_show', \compact('wilayah','daftar_warung'));
        }

        $id = $daftar_warung->id_anggota;

        $default = 'default/default.png';
        $file_ktp = Storage::disk('public')->files('ktp/'.$id);
        $file_foto = Storage::disk('public')->files('selfi/'.$id);

        $daftar_warung->images = [
            collect(Storage::disk('public')->files('warung/' . $daftar_warung->id))->first(),
            collect(Storage::disk('public')->files('warung1/' . $daftar_warung->id))->first(),
            collect(Storage::disk('public')->files('warung2/' . $daftar_warung->id))->first(),
            collect(Storage::disk('public')->files('warung3/' . $daftar_warung->id))->first(),
            collect(Storage::disk('public')->files('ktp/' . $daftar_warung->anggota->id))->first(),
            collect(Storage::disk('public')->files('selfi/' . $daftar_warung->anggota->id))->first(),
        ];

        if ($daftar_warung->images[0] == ''){
            $daftar_warung1 = collect(Storage::disk('public')->files('default/'))->first();
        }else{
            $daftar_warung1=   collect(Storage::disk('public')->files('warung/' . $daftar_warung->id))->first();
        }
        if ($daftar_warung->images[1] == ''){
            $daftar_warung2 = collect(Storage::disk('public')->files('default/'))->first();
        }else{
            $daftar_warung2=   collect(Storage::disk('public')->files('warung1/' . $daftar_warung->id))->first();
        }
        if ($daftar_warung->images[2] == ''){
            $daftar_warung3 = collect(Storage::disk('public')->files('default/'))->first();
        }else{
            $daftar_warung3=   collect(Storage::disk('public')->files('warung2/' . $daftar_warung->id))->first();
        }
        if ($daftar_warung->images[3] == ''){
            $daftar_warung4 = collect(Storage::disk('public')->files('default/'))->first();
        }else{
            $daftar_warung4=   collect(Storage::disk('public')->files('warung3/' . $daftar_warung->id))->first();
        }

        $daftar_warung->images = [
            is_file('storage/'.$daftar_warung1) ? 'data:image/png;base64,' . base64_encode(file_get_contents('storage/'.$daftar_warung1)) : null,
            is_file('storage/'.$daftar_warung2) ? 'data:image/png;base64,' . base64_encode(file_get_contents('storage/'.$daftar_warung2)) : null,
            is_file('storage/'.$daftar_warung3) ? 'data:image/png;base64,' . base64_encode(file_get_contents('storage/'.$daftar_warung3)) : null,
            is_file('storage/'.$daftar_warung4) ? 'data:image/png;base64,' . base64_encode(file_get_contents('storage/'.$daftar_warung4)) : null,
        ];

        $perusahan = KodePerusahaan::first();

        $logo = '';
        if (\is_file('storage/perusahaan/1/logo_perusahaan')) {
            $logo = 'data:image/png;base64,' . base64_encode(file_get_contents('storage/perusahaan/1/logo_perusahaan'));
        }

        if (!empty($file_foto[0])) {
            $file_foto = 'data:image/png;base64,' . base64_encode(file_get_contents('storage/' . $file_foto[0]));
        } else {
            $file_foto = '';
        }

        if (!empty($file_ktp[0])) {
            $file_ktp = 'data:image/png;base64,' . base64_encode(file_get_contents('storage/' . $file_ktp[0]));
        } else {
            $file_ktp = '';
        }

        if ($request->query('export') == 'show') {
            return view("daftar_warung.showup", \compact('wilayah', 'perusahan', "daftar_warung", 'status','bidangusaha', 'anggota', 'bangunan', 'warung', 'warung1', 'warung2', 'warung3'));
        }

        $pdf = PDF::loadView('daftar_warung.show', \compact("daftar_warung","file_foto","file_ktp","logo", 'perusahan'));
        return $pdf->stream('Laporan Daftar Warung.pdf');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */

    public function show2(Request $request,$id)
    {
        $wilayah = DB::table('indonesia_cities')->where('province_code',31)->get();

        $daftar_warung = DaftarWarung::with('anggota','daftarpembiayaan','bidangusaha','statusbangunans')->find($id);
        if (Route::currentRouteName() == 'pages.daftar_warung.show2') {
            $daftar_warung->images = [
                collect(Storage::disk('public')->files('warung/' . $daftar_warung->id))->first(),
                collect(Storage::disk('public')->files('warung1/' . $daftar_warung->id))->first(),
                collect(Storage::disk('public')->files('warung2/' . $daftar_warung->id))->first(),
                collect(Storage::disk('public')->files('warung3/' . $daftar_warung->id))->first(),
            ];

            return view('daftar_warung.public_show2', \compact('daftar_warung'));
        }

        $id = $daftar_warung->id_anggota;
        $file_ktp = Storage::disk('public')->files('ktp/'.$id);
        $file_foto = Storage::disk('public')->files('selfi/'.$id);

        $daftar_warung->images = [
            collect(Storage::disk('public')->files('warung/' . $daftar_warung->id))->first(),
            collect(Storage::disk('public')->files('warung1/' . $daftar_warung->id))->first(),
            collect(Storage::disk('public')->files('warung2/' . $daftar_warung->id))->first(),
            collect(Storage::disk('public')->files('warung3/' . $daftar_warung->id))->first(),
            collect(Storage::disk('public')->files('ktp/' . $daftar_warung->anggota->id))->first(),
            collect(Storage::disk('public')->files('selfi/' . $daftar_warung->anggota->id))->first(),
        ];

        if ($daftar_warung->images[0] == ''){
            $daftar_warung1 = collect(Storage::disk('public')->files('default/'))->first();
        }else{
            $daftar_warung1=   collect(Storage::disk('public')->files('warung/' . $daftar_warung->id))->first();
        }
        if ($daftar_warung->images[1] == ''){
            $daftar_warung2 = collect(Storage::disk('public')->files('default/'))->first();
        }else{
            $daftar_warung2=   collect(Storage::disk('public')->files('warung1/' . $daftar_warung->id))->first();
        }
        if ($daftar_warung->images[2] == ''){
            $daftar_warung3 = collect(Storage::disk('public')->files('default/'))->first();
        }else{
            $daftar_warung3=   collect(Storage::disk('public')->files('warung2/' . $daftar_warung->id))->first();
        }
        if ($daftar_warung->images[3] == ''){
            $daftar_warung4 = collect(Storage::disk('public')->files('default/'))->first();
        }else{
            $daftar_warung4=   collect(Storage::disk('public')->files('warung3/' . $daftar_warung->id))->first();
        }


        $daftar_warung->images = [
            is_file('storage/'.$daftar_warung1) ? 'data:image/png;base64,' . base64_encode(file_get_contents('storage/'.$daftar_warung1)) : null,
            is_file('storage/'.$daftar_warung2) ? 'data:image/png;base64,' . base64_encode(file_get_contents('storage/'.$daftar_warung2)) : null,
            is_file('storage/'.$daftar_warung3) ? 'data:image/png;base64,' . base64_encode(file_get_contents('storage/'.$daftar_warung3)) : null,
            is_file('storage/'.$daftar_warung4) ? 'data:image/png;base64,' . base64_encode(file_get_contents('storage/'.$daftar_warung4)) : null,
        ];

        $logo = 'data:image/png;base64,' . base64_encode(file_get_contents('ksn2.jpg'));

        if (!empty($file_foto[0])) {
            $file_foto = 'data:image/png;base64,' . base64_encode(file_get_contents('storage/' . $file_foto[0]));
        } else {
            $file_foto = '';
        }

        if (!empty($file_ktp[0])) {
            $file_ktp = 'data:image/png;base64,' . base64_encode(file_get_contents('storage/' . $file_ktp[0]));
        } else {
            $file_ktp = '';
        }
        $pdf = PDF::loadView('daftar_warung.show2', \compact('wilayah',"daftar_warung","file_foto","file_ktp","logo"));
        return $pdf->stream('LAporan PDF Daftar Warung.pdf');

        // $daftar_warung->images = $daf;

        // dd($daftar_warung->images[2]);

        // return view("daftar_warung.form", \compact("daftar_warung"));
        //
        // return view("daftar_warung.show", \compact("daftar_warung"));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */

    public function edit(DaftarWarung $request, $id)
    {
        // ddd($daftar_warung);
        // return view("daftar_warung.form", \compact("daftar_warung"));
        $bidangusaha = KodeBidangUsaha::pluck('bidang_usaha', 'id');
        $wilayah = DB::table('indonesia_cities')->where('province_code',31)->get();

        $anggota = Anggota::nonactive()->pluck('nama_pemohon', 'id');
        $bangunan = KodeStatusBangunan::pluck('status_bangunan', 'id');
        $status = StatusKeanggotaan::pluck('status_keanggotaan', 'id');
        $daftar_warung = DaftarWarung::with('anggota')
            ->leftJoin('indonesia_provinces', 'indonesia_provinces.id', '=', 'daftar_warungs.provinsi')
            ->leftJoin('indonesia_cities', 'indonesia_cities.id', '=', 'daftar_warungs.kota')
            ->leftJoin('indonesia_districts', 'indonesia_districts.id', '=', 'daftar_warungs.kecamatan')
            ->leftJoin('indonesia_villages', 'indonesia_villages.id', '=', 'daftar_warungs.desa')
            // ->where('daftar_warungs.ids', $id)
            ->select('indonesia_provinces.name as prov', 'indonesia_cities.name as ko', 'indonesia_districts.name as kec', 'indonesia_villages.name as des', 'daftar_warungs.*')
            // ->first();
            ->findOrFail($id);

        $warung = Storage::disk('public')->files('warung/'.$id);
        $warung1 = Storage::disk('public')->files('warung1/'.$id);
        $warung2 = Storage::disk('public')->files('warung2/'.$id);
        $warung3 = Storage::disk('public')->files('warung3/'.$id);


        return view("daftar_warung.edit", \compact('wilayah',"daftar_warung", 'status','bidangusaha', 'anggota', 'bangunan', 'warung', 'warung1', 'warung2', 'warung3'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $daftar_warung = DaftarWarung::find($id);
        $daftar_warung->fill($request->except('coordinates'));
        $daftar_warung->save();

        $file_serfie[] = $request->file('file_ktp');
        $file_serfie[] = $request->file('file_fktp2');
        $file_serfie[] = $request->file('file_fktp3');
        $file_serfie[] = $request->file('file_fktp4');

        if(empty($request->exists_file_ktp))
        {
            Storage::disk('public')->deleteDirectory('warung/' . $daftar_warung->id);
        }

        if(empty($request->exists_file_fktp2))
        {
            Storage::disk('public')->deleteDirectory('warung1/' . $daftar_warung->id);
        }

        if(empty($request->exists_file_fktp3))
        {
            Storage::disk('public')->deleteDirectory('warung2/' . $daftar_warung->id);
        }

        if(empty($request->exists_file_fktp4))
        {
            Storage::disk('public')->deleteDirectory('warung3/' . $daftar_warung->id);
        }

        foreach ($file_serfie as $i => $file) {
            if (!empty($file)) {
                if ($i == 0) {
                    Storage::disk('public')->deleteDirectory("warung/{$id}");
                    $file->storeAs("warung/{$id}", '' . $file->getClientOriginalName(), 'public');
                } else {
                    Storage::disk('public')->deleteDirectory("warung{$i}/{$id}");
                    $file->storeAs("warung{$i}/{$id}", '' . $file->getClientOriginalName(), 'public');
                }
            }
        }

        return redirect()
            ->route("daftar_warung.index")
            ->with("message",("Perbarui Daftar Warung Berhasil"));
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

    // public function showPdf(DaftarWarung $daftar_warung, Request $request, $id)
    // {
    //     $daftar_warung = Anggota::where('id', '=', $id)
    //         ->first();

    //     if ($request->query('export') == 'show') {

    //         $pdf = PDF::loadView('admin.daftar_warung.show', ['data' => $daftar_warung, $id], [], []);
    //         return $pdf->stream('Laporan Rekening Anggota.pdf');
    //     }

    // }
}
