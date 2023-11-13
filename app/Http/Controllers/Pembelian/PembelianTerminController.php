<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use App\Models\Termin;
use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;

class PembelianTerminController extends Controller
{
    public function index(Request $request)
    {
        $termin = Termin::orderBy('created_at', 'asc')->paginate(10);
        return view('pembelian.setting.termin.index', compact('termin'));
    }

    public function store(Request $request)
    {
        // Termin::updateOrCreate(['id' => $request->id],[
        //     'kode' => $request->kode,
        //     'hari' => $request->hari,
        // ]);

        $data = new Termin();
        $data->kode = $request->kode;
        $data->hari = $request->hari;
        $simpan = $data->save();

        return redirect()
        ->route('pembelian.setting.termin.index')
        ->with('success','Berhasil Membuat Termin');
    }

    public function create()
    {
        $termin = Termin::all();
        return view('pembelian.setting.termin.form', compact('termin'));
    }

    public function edit($id)
    {
        $termin = Termin::find($id);
        return view('pembelian.setting.termin.form',[
            'termin' => $termin,
            // ddd($termin[0]->kode)
        ]);
        
    }

    public function update(Request $request, Termin $termin)
    {
        $termin->fill($request->all());

        $termin->save();

        return redirect()
            ->route("pembelian.setting.termin.index")
            ->with("success", __("Perbaharui termin berjaya"));
    }

    public function destroy($id)
    {
        $data = Termin::find($id);
        $data->delete();

        return redirect()
        ->route('pembelian.setting.termin.index')
        ->with('success','Berhasil Membuat Termin');
    }
}
