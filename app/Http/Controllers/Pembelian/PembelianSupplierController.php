<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use App\Models\AkunPerkiraan;
use App\Models\Supplier;
use App\Models\TipeKontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;


class PembelianSupplierController extends Controller
{
    public function index(Request $request)
    {
        $supplier = Supplier::orderBy('created_at', 'asc')->paginate(10);
        return view('pembelian.setting.supplier.index', compact('supplier'));
    }

    public function create()
    {
        $TipeKontak = TipeKontak::pluck('tipe_kontak', 'id');
        $akun = AkunPerkiraan::where('kode','like','0%')->orderBy('_lft','ASC')->get();

        $supplier = Supplier::all();
        $code = Supplier::count('id') +1;
        return view('pembelian.setting.supplier.form', compact('supplier', 'code','TipeKontak','akun'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'nama' => 'required|unique:supplier|max:255',
        ]);

//        $data = new Supplier();
//        $data->id_supplier = $request->id_supplier;
//        $data->nama = $request->nama;
//        $data->alamat = $request->alamat;
//        $data->no_telepon = $request->no_telepon;
//        $data->no_hp = $request->no_hp;
//        $data->id_tipe_supplier = $request->id_tipe_supplier;
//        $data->npwp = $request->npwp;
//        $data->id_akun_hutang = $request->id_akun_hutang;
//        $data->id_akun_piutang = $request->id_akun_piutang;
//        $simpan = $data->save();

        $supplier = Supplier::create($request->all());

        $file = $request->file('gambar');
        if (!empty($file)) {
            Storage::disk('local')->makeDirectory('public/supplier/'.$supplier->id,0775,true);
            $destinationPath = storage_path('app/public/supplier/'.$supplier->id);
            Storage::makeDirectory($destinationPath);
            $extension = $file->getClientOriginalExtension();
            $filesname =$file->getClientOriginalName();
            $image_resize = Image::make($file->getRealPath());
            $image_resize->resize(500,300);
            $image_resize->save($destinationPath.'/'.$filesname,80);
        }

        return redirect()
        ->route('pembelian.setting.supplier.index')
        ->with('message',' Kontak Berhasil Terdaftar');
    }

    public function edit($id)
    {
        $TipeKontak = TipeKontak::pluck('tipe_kontak', 'id');
        $akun = AkunPerkiraan::where('kode','like','0%')->orderBy('_lft','ASC')->get();
        $gambar = Storage::disk('public')->files('supplier/'.$id);

        $supplier = Supplier::find($id);
        return view('pembelian.setting.supplier.form',[
            'supplier' => $supplier,
            'akun' => $akun,
            'TipeKontak' => $TipeKontak,
            'gambar' => $gambar,
            // ddd($ekpedisi)
        ]);

    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);

        $supplier->fill($request->all());

        $supplier->save();
        // ddd($supplier);

        $file = $request->file('gambar');

        if(empty($request->exists_file_gambar))
        {
            Storage::disk('public')->deleteDirectory('supplier/' . $supplier->id);
        }

        $files = \Illuminate\Support\Facades\Storage::files("supplier/$id");
        if($request->file('gambar')) {
            $sd =  \Illuminate\Support\Facades\Storage::delete($files);
        }
        if (!empty($file)) {
            Storage::disk('local')->makeDirectory('public/supplier/'.$supplier->id,0775,true);
            $destinationPath = storage_path('app/public/supplier/'.$supplier->id);
            Storage::makeDirectory($destinationPath);
            $extension = $file->getClientOriginalExtension();
            $filesname =$file->getClientOriginalName();
            $image_resize = Image::make($file->getRealPath());
            $image_resize->resize(500,300);
            $image_resize->save($destinationPath.'/'.$filesname,80);
        }
        return redirect()
            ->route('pembelian.setting.supplier.index')
            ->with("message",(" Kontak Berhasil Terupdate"));
    }

    public function destroy($id)
    {
        $data = Supplier::where('id',$id);
        $data->delete();
        return redirect()
            ->route('pembelian.setting.supplier.index')
            ->with("message",(" Kontak Berhasil Terhapus"));

    }
}
