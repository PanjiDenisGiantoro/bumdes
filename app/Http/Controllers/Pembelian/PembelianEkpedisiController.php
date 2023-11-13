<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use App\Models\Ekpedisi;
use Illuminate\Http\Request;

class PembelianEkpedisiController extends Controller
{
    public function index(Request $request)
    {
        $ekpedisi = Ekpedisi::orderBy('created_at', 'asc')->paginate(10);
        return view('pembelian.setting.ekpedisi.index', compact('ekpedisi'));
    }

    public function store(Request $request)
    {
        // Termin::updateOrCreate(['id' => $request->id],[
        //     'kode' => $request->kode,
        //     'hari' => $request->hari,
        // ]);

        $data = new Ekpedisi();
        $data->kode = $request->kode;
        $data->nama = $request->nama;
        $simpan = $data->save();

        return redirect()
        ->route('pembelian.setting.ekpedisi.index')
        ->with('success','Berhasil Membuat Ekpedisi');
    }

    public function create()
    {
        $ekpedisi = Ekpedisi::all();
        return view('pembelian.setting.ekpedisi.form', compact('ekpedisi'));
    }

    public function edit($id)
    {
        $ekpedisi = Ekpedisi::find($id);
        return view('pembelian.setting.ekpedisi.form',[
            'ekpedisi' => $ekpedisi,
            // ddd($ekpedisi->kode)
        ]);
        
    }

    public function update(Request $request, Ekpedisi $ekpedisi)
    {
        $ekpedisi->fill($request->all());

        $ekpedisi->save();

        return redirect()
            ->route('pembelian.setting.ekpedisi.index')
            ->with("success", __("Perbaharui Ekpedisi berjaya"));
    }

    public function destroy($id)
    {
        $data = Ekpedisi::find($id);
        $data->delete();

        return redirect()
        ->route('pembelian.setting.ekpedisi.index')
        ->with('success','Berhasil Membuat Ekpedisi');
    }
}
