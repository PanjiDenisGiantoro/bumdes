<?php

namespace App\Http\Controllers;

use App\Models\KodeHakAkses;
use App\Models\KodePerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

use File;

class KodePerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $kodeperusahaan = KodePerusahaan::paginate();

        return view("tetapan.kode_perusahaan.index",compact('kodeperusahaan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.kode_perusahaan.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $kode_perusahaan=  KodePerusahaan::create($request->except('coordinates'));
        Storage::disk('public')->deleteDirectory('perusahaan/' . $kode_perusahaan->id);
        $file_serfie = $request->file('image');
        $imagefile = '122.png';
        $anggota_id = 1;
//        $kode_perusahaan = KodePerusahaan::find($kode_perusahaan->id);
        if ($request->image == ''){
            return redirect()
                ->back()
                ->with("message",("Profil Perusahaan Berhasil Terdaftar"));
        }
        Storage::disk('local')->makeDirectory('public/perusahaan/'.$kode_perusahaan->id,0775,true);
        $destinationPath = storage_path('app/public/perusahaan/'.$kode_perusahaan->id);
        // dd($destinationPath);
        Storage::makeDirectory($destinationPath);
        // dd($file_serfie->getRealPath());
        $image_resize = Image::make($file_serfie->getRealPath());
        $image_resize->resize(500,300);
        $image_resize->save($destinationPath.'/'. 'logo_perusahaan',80);
        return \redirect()
            ->route("kode_perusahaan.edit",$kode_perusahaan->id)
            ->with("message", ("Profil Perusahaan Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(KodePerusahaan $kode_perusahaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(KodePerusahaan $request,$id)
    {
        $kodeperusahaan = KodePerusahaan::where('id',$id)->first();

        $foto_perusahaan = $kodeperusahaan->image ?? '';
        // dd($foto_perusahaan);
        $logo_perusahaan = Storage::disk('public')->files('perusahaan/'.$id);
        // $logo = str_replace('perusahaan/1/', '', $logo_perusahaan);
        // dd($nama_foto);

        // dd($foto_perusahaan);
        // dd($nama_foto[0]);

        return view("tetapan.kode_perusahaan.form", \compact('kodeperusahaan', 'logo_perusahaan', 'foto_perusahaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $foto_perusahaan = Storage::disk('public')->files('perusahaan/'.$id);
        // dd($foto_perusahaan[0]);


        $file_serfie = $request->file('image');
        // dd($file_serfie->getClientOriginalName());
//        $imagefile = $file_serfie->getClientOriginalName();
        // dd($imagefile);

        $kode_perusahaan = KodePerusahaan::find($id);
        // dd($kode_perusahaan);
        $kode_perusahaan->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'email_perusahaan' => $request->email_perusahaan,
            'no_handphone' => $request->no_handphone,
            'no_telpon' => $request->no_telpon,
            'alamat_utama' => $request->alamat_utama,
            'alamat_penagihan' => $request->alamat_penagihan,
            'npwp' => $request->npwp,
            'kode_cabang' => $request->kode_cabang,
            'kode_perusahaan' => $request->kode_perusahaan,
            'npwp' => $request->npwp,
            'image' =>'',
        ]);
        // dd($request->all());
        if ($request->image == ''){
            return redirect()
                ->back()
                ->with("message",("Profil Perusahaan Berhasil Terupdate"));
        }
       if(!empty($request->exists_file_image))
        {
            Storage::disk('public')->deleteDirectory('perusahaan/' . $kode_perusahaan->id);
        }

        Storage::disk('local')->makeDirectory('public/perusahaan/'.$id,0775,true);
        $destinationPath = storage_path('app/public/perusahaan/'.$id);
        // dd($destinationPath);
        Storage::makeDirectory($destinationPath);
        // dd($file_serfie->getRealPath());
        $image_resize = Image::make($file_serfie->getRealPath());
        $image_resize->resize(500,300);
        $image_resize->save($destinationPath.'/'. 'logo_perusahaan',80);
        return redirect()
            ->back()
            ->with("message",(" Profil Perusahaan Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(KodePerusahaan $kode_perusahaan)
    {
        //
    }
}
