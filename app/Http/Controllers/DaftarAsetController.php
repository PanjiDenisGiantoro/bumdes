<?php

namespace App\Http\Controllers;

use App\Models\AkunPerkiraan;
use App\Models\Aset;
use App\Models\DaftarAset;
use App\Models\DaftarProduk;
use App\Models\JenisTransaksi;
use App\Models\Kasir;
use App\Models\KasirBody;
use App\Models\KelompokAset;
use App\Models\Ledger;
use App\Models\PelepasanAsetMgt;
use App\Models\PemetaanAkun;
use Cknow\Money\Money;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DaftarAsetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $asets = Aset::paginate(10);

        return view("daftar_aset.index",compact('asets'));
         // \compact("daftar_asets"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelompokaset = KelompokAset::orderBy('kelompok_aset','ASC')->get();
        $akun = AkunPerkiraan::all();
        return view("daftar_aset.form",compact('kelompokaset','akun'));
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
            $aset =  Aset::create($request->all());
            $akun_produk = AkunPerkiraan::findOrFail($request->akun_aset_tetap);
            $jenis_transaksi = AkunPerkiraan::findOrFail($request->akun_kredit);
            $nominal = $request->biaya_akuisisi;

            $request->merge([
                'type'               => 'DA',
                'date'               => $request->tanggal_akuisisi,
                'nominal'            => $nominal,
                'teller_transaction' => 1,
                'description'        => 'Asset Management',
                'reference'        => 'Aset-'.$aset->nama_aset.'-'.$aset->nomor_aset,
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

            return redirect()->route('daftar_aset.index');
        } catch (\Exception $ex) {
            Log::debug($ex);

            DB::rollback();

            return redirect()
                ->route('daftar_aset.index')
                ->with('error', 'Transaksi gagal: ' . $ex->getMessage());
        }
        return redirect()
            ->route("daftar_aset.index")
            ->with("message",("Daftar Aset Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $daftar_aset = Aset::with('kelompokaset')->where('id',$id)->first();

        $kelompokaset = KelompokAset::orderBy('kelompok_aset','ASC')->get();
        return view("daftar_aset.show", \compact("daftar_aset",'kelompokaset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $akun = AkunPerkiraan::all();

        $daftar_aset = Aset::with('kelompokaset')->where('id',$id)->first();

        $kelompokaset = KelompokAset::orderBy('kelompok_aset','ASC')->get();
        return view("daftar_aset.form", \compact("daftar_aset",'kelompokaset','akun'));
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
        $daftar_aset = Aset::find($id);
        $daftar_aset->fill($request->all());

        $daftar_aset->save();

        return redirect()
            ->route("daftar_aset.index")
            ->with("message",("Perbaharui Daftar Aset Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $KategoriProduk = Aset::where('id',$id);
        $KategoriProduk->delete();
        return redirect()
            ->route("daftar_aset.index")
            ->with("success", __("Hapus Kode SKU Berhasil"));

    }
}
