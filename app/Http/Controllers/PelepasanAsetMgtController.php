<?php

namespace App\Http\Controllers;

use App\Models\AkunPerkiraan;
use App\Models\Aset;
use App\Models\Ledger;
use App\Models\PelepasanAsetMgt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PelepasanAsetMgtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $pelepasan_aset_mgts = PelepasanAsetMgt::with('aset.kelompokaset')->paginate();

        return view("pelepasan_aset_mgt.index",compact('pelepasan_aset_mgts'));
         // \compact("pelepasan_aset_mgts"));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $akun = AkunPerkiraan::all();

        $aset = Aset::where('tanggal_jual','=','0')->orderBy('nama_aset','ASC')->get();
        return view("pelepasan_aset_mgt.form",compact('aset','akun'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = PelepasanAsetMgt::max('id') + 1;
        $request->merge([
            'no_transaksi' =>'PA-'.$data,
        ]);
        $pelepasan = PelepasanAsetMgt::create($request->all());
        Aset::where('id','=',$pelepasan->id_kelompok_aset)->update([
            'tanggal_jual' => '1'
        ]);

        DB::beginTransaction();

        try {
            $aset =  Aset::create($request->all());
            $akun_produk = AkunPerkiraan::findOrFail($request->akun_deposit_penjualan);
            $jenis_transaksi = AkunPerkiraan::findOrFail($request->akun_kerugian_penjualan);
            $nominal = $request->harga_jual;

            $request->merge([
                'type'               => 'DA',
                'date'               => $request->tanggal_transaksi,
                'nominal'            => $nominal,
                'teller_transaction' => 1,
                'description'        => 'Pelepasan Asset Management',
                'reference'        => 'Pelepasan Aset-'.$aset->nama_aset.'-'.$aset->nomor_aset,
            ]);
//
//            $request->merge([
//                'no_order' => trim($request->no_order)
//            ]);
            $ledger = Ledger::create($request->all());
            $entry = \App\Facades\Ledger::credit($jenis_transaksi, $akun_produk, $nominal, config('money.defaultCurrency'), $request->description, $ledger->id);
            $entry->ledger_id = $ledger->id;

            $entry->save();

            $entry = \App\Facades\Ledger::debit($akun_produk, $jenis_transaksi, $nominal, config('money.defaultCurrency'), $request->description, $ledger->id);
            $entry->ledger_id = $ledger->id;
            // $entry->no_rek = $rekening->no_akun;
            $entry->save();

            DB::commit();

            return redirect()->route('pelepasan_aset_mgt.index');
        } catch (\Exception $ex) {
            Log::debug($ex);

            DB::rollback();

            return redirect()
                ->route('pelepasan_aset_mgt.index')
                ->with('error', 'Transaksi gagal: ' . $ex->getMessage());
        }
        return redirect()
            ->route("pelepasan_aset_mgt.index")
            ->with("success", __("Pelepasan Aset Management Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function show(PelepasanAsetMgt $request,$id)
    {
        $pelepasan_aset_mgt = PelepasanAsetMgt::with('aset.kelompokaset')->where('id',$id)->first();
        return view("pelepasan_aset_mgt.show", \compact("pelepasan_aset_mgt"));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function edit(PelepasanAsetMgt $request,$id)
    {
        $pelepasan_aset_mgt = PelepasanAsetMgt::where('id',$id)->first();

        $aset = Aset::orderBy('nama_aset','ASC')->get();

        return view("pelepasan_aset_mgt.form", \compact("pelepasan_aset_mgt",'aset'));
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
        $pelepasan_aset_mgt = PelepasanAsetMgt::find($id);

        $pelepasan_aset_mgt->fill($request->all());

        $pelepasan_aset_mgt->save();

        return redirect()
            ->route("pelepasan_aset_mgt.index")
            ->with("success", __("Perbaharui Pelepasan Aset Management Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $bidangusaha = PelepasanAsetMgt::where('id',$id);
        $bidangusaha->delete();
        return redirect()
            ->route("pelepasan_aset_mgt.index")
            ->with("success", __("Hapus Tipe Kontak Berhasil"));
    }
}
