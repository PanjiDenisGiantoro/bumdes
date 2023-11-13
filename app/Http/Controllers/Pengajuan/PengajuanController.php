<?php

namespace App\Http\Controllers\Pengajuan;

use App\Http\Controllers\Controller;
use App\Models\pengajuan\durasi;
use App\Models\pengajuan\Margin;
use App\Models\pengajuan\Pengajuan;
use App\Models\pengajuan\SettingRasio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Image;
use function redirect;
use function storage_path;
use function view;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengajuan = Pengajuan::orderBy('created_at', 'desc')->paginate(10);
        return view('pengajuans.pengajuan.index', compact('pengajuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rasio = SettingRasio::first();
        $margin = Margin::first();
        $durasi = durasi::get();
        return view('pengajuans.pengajuan.create1', compact('rasio','margin','durasi'));
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
            'nik' => 'required|unique:pengajuans',
        ]);
            $pengajuan = Pengajuan::create($request->all());
            $file = $request->file('file_ktp');
            if (!empty($file)) {
                $file->storeAs('ktp_pengajuan/' . $pengajuan->id, '' . $file->getClientOriginalName(), 'public');
            }
            $file_serfie = $request->file('file_serfie');
            if (!empty($file_serfie)) {
                $file_serfie->storeAs('selfi_pengajuan/' . $pengajuan->id, '' . $file_serfie->getClientOriginalName(), 'public');
            }
            $file = $request->file('file_ktpg');
            if (!empty($file)) {
                Storage::disk('local')->makeDirectory('public/warung0_pengajuan/'.$pengajuan->id,0775,true);
                $destinationPath = storage_path('app/public/warung0_pengajuan/'.$pengajuan->id);
                Storage::makeDirectory($destinationPath);
                $extension = $file->getClientOriginalExtension();
                $filesname =$file->getClientOriginalName();
                $image_resize = Image::make($file->getRealPath());
                $image_resize->resize(500,300);
                $image_resize->save($destinationPath.'/'.$filesname,80);
            }
            $file1 = $request->file('file_fktp2');
            if (!empty($file1)) {
                Storage::disk('local')->makeDirectory('public/warung1_pengajuan/'.$pengajuan->id,0775,true);
                $destinationPath = storage_path('app/public/warung1_pengajuan/'.$pengajuan->id);
                Storage::makeDirectory($destinationPath);
                $extension = $file1->getClientOriginalExtension();
                $filesname =$file1->getClientOriginalName();
                $image_resize = Image::make($file1->getRealPath());
                $image_resize->resize(500,300);
                $image_resize->save($destinationPath.'/'.$filesname,80);
            }
//            $file2 = $request->file('file_fktp3');
//            if (!empty($file2)) {
//                Storage::disk('local')->makeDirectory('public/warung2_pengajuan/'.$pengajuan->id,0775,true);
//                $destinationPath = storage_path('app/public/warung2_pengajuan/'.$pengajuan->id);
//                Storage::makeDirectory($destinationPath);
//                $extension = $file2->getClientOriginalExtension();
//                $filesname =$file2->getClientOriginalName();
//                $image_resize = Image::make($file2->getRealPath());
//                $image_resize->resize(500,300);
//                $image_resize->save($destinationPath.'/'.$filesname,80);
//            }
//            $file3 = $request->file('file_fktp4');
//            if (!empty($file3)) {
//                Storage::disk('local')->makeDirectory('public/warung3_pengajuan/'.$pengajuan->id,0775,true);
//                $destinationPath = storage_path('app/public/warung3_Pengajuan/'.$pengajuan->id);
//                Storage::makeDirectory($destinationPath);
//                $extension = $file3->getClientOriginalExtension();
//                $filesname =$file3->getClientOriginalName();
//                $image_resize = Image::make($file3->getRealPath());
//                $image_resize->resize(500,300);
//                $image_resize->save($destinationPath.'/'.$filesname,80);
//            }
//            $folderPath = public_path('upload/');
//            Storage::disk('local')->makeDirectory('public/ttd/'.$pengajuan->id,0775,true);
//            $destinationPath = storage_path('app/public/ttd/'.$pengajuan->id);
//
//            $image_parts = explode(";base64,", $request->signed);
//
//            $image_type_aux = explode("image/", $image_parts[0]);
//
//            $image_type = $image_type_aux[1];
//
//            $image_base64 = base64_decode($image_parts[1]);
//
//            $file = $destinationPath.'.'.$image_type;
//            file_put_contents($file, $image_base64);
            return redirect()->route('pengajuan.index')
                ->with('success', 'Pengajuan berhasil ditambahkan');

            // all good
        }


            // Commit Transaction
            // Semua proses benar

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pengajuan\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengajuan $pengajuan,$id)
    {
        $pengajuan = Pengajuan::find($id);
        $rasio = SettingRasio::first();
        $margin = Margin::first();
        $durasi = durasi::all();
        $file_ktp = Storage::disk('public')->files('ktp_pengajuan/'.$id);
        $file_foto = Storage::disk('public')->files('selfi_pengajuan/'.$id);

        if ($file_ktp == null)
        {
            $file_ktp = 'kosong';
        }
        else
        {
            $file_ktp = Storage::disk('public')->files('ktp_pengajuan/'.$id);
        }
        if ($file_foto == null)
        {
            $file_foto = 'kosong';
        }
        else
        {
            $file_foto = Storage::disk('public')->files('selfi_pengajuan/'.$id);
        }


        $warung = Storage::disk('public')->files('warung0_pengajuan/'.$id);
        $warung1 = Storage::disk('public')->files('warung1_pengajuan/'.$id);
        $warung2 = Storage::disk('public')->files('warung2_pengajuan/'.$id);
        $warung3 = Storage::disk('public')->files('warung3_pengajuan/'.$id);
  if ($warung == null)
        {
            $warung = 'kosong';
        }
        else
        {
            $warung = Storage::disk('public')->files('warung0_pengajuan/'.$id);
        }
        if ($warung1 == null)
        {
            $warung1 = 'kosong';
        }
        else
        {
            $warung1 = Storage::disk('public')->files('warung1_pengajuan/'.$id);
        }
        if ($warung2 == null)
        {
            $warung2 = 'kosong';
        }
        else
        {
            $warung2 = Storage::disk('public')->files('warung2_pengajuan/'.$id);
        }
        if ($warung3 == null)
        {
            $warung3 = 'kosong';
        }
        else
        {
            $warung3 = Storage::disk('public')->files('warung3_pengajuan/'.$id);
        }

//
//        $ttd = Storage::disk('public')->files('ttd');
//        $ok = $ttd[0];
        return view('pengajuans.pengajuan.show', compact('pengajuan','rasio','margin','durasi','file_ktp','file_foto','warung','warung1','warung2','warung3'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pengajuan\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pengajuan\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pengajuan\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kode_pendidikan = Pengajuan::where('id',$id);
        $kode_pendidikan->delete();
        return redirect()
            ->route("pengajuan.index")
            ->with("success",(" Pengajuan Berhasil Terhapus"));
    }
}
