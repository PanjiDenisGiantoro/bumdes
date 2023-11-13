<?php

namespace App\Http\Controllers;

use App\Models\AkunPerkiraan;
use App\Models\BeratSatuan;
use App\Models\DaftarProduk;
use App\Models\GudangProduk;
use App\Models\KategoriProduk;
use App\Models\PenomoranAuto;
use App\Models\PerpajakanKeuangan;
use App\Models\SatuanProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class DaftarProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $daftar_produks = DaftarProduk::orderBy('created_at', 'DESC')->paginate(10);

        if (request()->ajax()) {
            if (!empty($request->draw)) {
                $daftar_produks = DaftarProduk::filter($request->all())
                    ->orderBy('created_at', 'DESC')
                    ->skip($request->start)
                    ->take($request->length)
                    ->get();

                return response()->json([
                    'draw'            => $request->draw,
                    'recordsTotal'    => DaftarProduk::select('count(*) as total')->count(),
                    'recordsFiltered' => DaftarProduk::count(),
                    'data'            => $daftar_produks,
                ]);
            }

            return response()->json($daftar_produks);
        }

        return view("daftar_produk.index",compact('daftar_produks'));
         // \compact("daftar_produks"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $pajak = PerpajakanKeuangan::pluck('nama_pajak', 'id');
        $kategori = KategoriProduk::pluck('kategori_produk', 'id');
        $satuan = SatuanProduk::pluck('satuan_produk', 'id');
        $gudang = GudangProduk::pluck('gudang_produk', 'id');
        $akun = AkunPerkiraan::where('kode','like','0%')->orderBy('_lft','ASC')->get();

        $berat = BeratSatuan::pluck('nama_berat_satuan', 'id');
        $auto = PenomoranAuto::where('keterangan','=','produk')->first();
        $count = DaftarProduk::count() + 1;

        return view("daftar_produk.form",compact('kategori','gudang','pajak','satuan','akun','berat','count','auto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge([
           'kode_produk'  => trim($request->kode_produk)
        ]);
        $produk =   DaftarProduk::create($request->all());
        $file = $request->file('gambar');
        if (!empty($file)) {
            Storage::disk('local')->makeDirectory('public/produk/'.$produk->id,0775,true);
            $destinationPath = storage_path('app/public/produk/'.$produk->id);
            Storage::makeDirectory($destinationPath);
            $extension = $file->getClientOriginalExtension();
            $filesname =$file->getClientOriginalName();
            $image_resize = Image::make($file->getRealPath());
            $image_resize->resize(500,300);
            $image_resize->save($destinationPath.'/'.$filesname,80);
        }
        return redirect()
            ->route("daftar_produk.index")
            ->with('message',("Produk Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function show(DaftarProduk $request,$id)
    {
        $daftar_produk = DaftarProduk::where('id',$id)->first();

        $gambar = Storage::disk('public')->files('produk/'.$id);
        $pajak = PerpajakanKeuangan::pluck('nama_pajak', 'id');
        $kategori = KategoriProduk::pluck('kategori_produk', 'id');
        $satuan = SatuanProduk::pluck('satuan_produk', 'id');
        $gudang = GudangProduk::pluck('gudang_produk', 'id');
        $berat = BeratSatuan::pluck('nama_berat_satuan', 'id');
        $akun = AkunPerkiraan::where('kode','like','0%')->orderBy('_lft','ASC')->get();
        return view("daftar_produk.show", \compact("daftar_produk",'berat','gambar','pajak','kategori','satuan','gudang','akun'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function edit(DaftarProduk $request,$id)
    {
        $daftar_produk = DaftarProduk::where('id',$id)->first();
        $pajak = PerpajakanKeuangan::pluck('nama_pajak', 'id');

        $kategori = KategoriProduk::pluck('kategori_produk', 'id');
        $satuan = SatuanProduk::pluck('satuan_produk', 'id');
        $gudang = GudangProduk::pluck('gudang_produk', 'id');
        $gambar = Storage::disk('public')->files('produk/'.$id);
        $akun = AkunPerkiraan::where('kode','like','0%')->orderBy('_lft','ASC')->get();
        $berat = BeratSatuan::pluck('nama_berat_satuan', 'id');

        return view("daftar_produk.edit", \compact("daftar_produk",'berat','kategori','satuan','pajak','gudang','gambar','akun'));
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
        $daftar_produk = DaftarProduk::find($id);

        $daftar_produk->fill($request->all());

        $daftar_produk->save();
        $file = $request->file('gambar');

        if(empty($file))
        {
            Storage::disk('public')->deleteDirectory('produk/' . $daftar_produk->id);
        }

        $files = \Illuminate\Support\Facades\Storage::files("produk/$id");
        if($request->file('gambar')) {
            $sd =  \Illuminate\Support\Facades\Storage::delete($files);
        }
        if (!empty($file)) {
            Storage::disk('local')->makeDirectory('public/produk/'.$daftar_produk->id,0775,true);
            $destinationPath = storage_path('app/public/produk/'.$daftar_produk->id);
            Storage::makeDirectory($destinationPath);
            $extension = $file->getClientOriginalExtension();
            $filesname =$file->getClientOriginalName();
            $image_resize = Image::make($file->getRealPath());
            $image_resize->resize(500,300);
            $image_resize->save($destinationPath.'/'.$filesname,80);
        }

        // foreach ($file as $i => $files) {
        //     if (!empty($files)) {
        //         if ($i == 0) {
        //             Storage::disk('public')->deleteDirectory("daftar_produk/{$id}");
        //             $files->storeAs("daftar_produk/{$id}", '' . $files->getClientOriginalName(), 'public');
        //         } else {
        //             Storage::disk('public')->deleteDirectory("daftar_produk{$i}/{$id}");
        //             $files->storeAs("daftar_produk{$i}/{$id}", '' . $files->getClientOriginalName(), 'public');
        //         }
        //     }
        // }
        return redirect()
            ->route("daftar_produk.index")
            ->with("message",("  Produk Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $KategoriProduk = DaftarProduk::where('id',$id);
        $KategoriProduk->delete();
        return redirect()
            ->route("daftar_produk.index")
            ->with("message",("  Produk Berhasil Terhapus"));
    }
}
