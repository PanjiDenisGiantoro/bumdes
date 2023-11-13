<?php

namespace App\Http\Controllers;

use App\Models\AkunPerkiraan;
use App\Models\Anggota;
use App\Models\DaftarProduk;
use App\Models\Kasir;
use App\Models\KasirBody;
use App\Models\Ledger;
use App\Models\PemetaanAkun;
use App\Models\PenomoranAuto;
use Cknow\Money\Money;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KasirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kasir = Kasir::paginate(10);

        return view('kasir.index', compact('kasir'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($pembeli = 'anggota')
    {
        $auto = PenomoranAuto::where('keterangan','=','kasir')->first();
        $count = Kasir::count() + 1;
        $anggota = Anggota::orderBy('nama_pemohon','ASC')->get();
        $last = Ledger::with('entries.ledgerable')->where('type', 'CS')->orderBy('journal_no', 'DESC')->first();
        return view('kasir.create', compact('pembeli','anggota','last','auto','count'));
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

            $nominal = Money::parse(str_replace(',', '', $request->total), config('money.defaultCurrency'));

            $request->merge([
                'type'               => 'CS',
                'date'               => $request->tanggal,
                'nominal'            => $nominal->formatByDecimal(),
                'teller_transaction' => 1,
                'description'        => 'Kasir',
                'reference'        => 'Kasir',
            ]);

            $request->merge([
               'no_order' => trim($request->no_order)
            ]);
            $ledger = Ledger::create($request->all());
            if ($request->status_anggota == '1')
            {
                $request->merge([
                   'anggota_id' => $request->anggota_id_value
                ]);
            }else{
                $request->merge([
                    'anggota_id' => $request->anggota_id
                ]);
            }

            $kasir = Kasir::create($request->all());
            foreach ($request->items as $kasir_body)
            {
                KasirBody::create([
                    'id_kasir'=> $kasir->id,
                    'id_produk'=> $kasir_body['id_produk'],
                    'qty'=> $kasir_body['qty'],
                    'diskon'=> $kasir_body['diskon'],
                    'total'=> $kasir_body['total'],
                    'created_at'=> date('Y-m-d H:i:s'),
                ]);
            }
            foreach ($request->items as $item){
                DaftarProduk::where('id', $item['id_produk'])->decrement('stok', $item['qty']);
            }

            $pemetaanAkun = PemetaanAkun::first();
            if ($request->jenis_pembayaran == Kasir::TUNAI) {
                $akunPembayaran  = AkunPerkiraan::find($pemetaanAkun->pembayaran_penjualan_cash);
            } else {
                $akunPembayaran  = AkunPerkiraan::find($pemetaanAkun->pembayaran_penjualan_transfer);
            }

            $entry            = \App\Facades\Ledger::debit($akunPembayaran, null, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description,$ledger->id);
            $entry->ledger_id = $ledger->id;
            $entry->save();

            $akunPendapatan   = AkunPerkiraan::find($pemetaanAkun->pendapatan_penjualan);
            $entry            = \App\Facades\Ledger::credit($akunPendapatan, null, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description,$ledger->id);
            $entry->ledger_id = $ledger->id;
            $entry->save();

            if (!empty($request->diskon)) {
                $diskon           = Money::parse(str_replace(',', '', $request->diskon), config('money.defaultCurrency'));
                $akunDiskon       = AkunPerkiraan::find($pemetaanAkun->diskon_penjualan);
                $entry            = \App\Facades\Ledger::debit($akunDiskon, null, $diskon->formatByDecimal(), config('money.defaultCurrency'), $request->description,$ledger->id);
                $entry->ledger_id = $ledger->id;
                $entry->save();
            }

            $kasir->ledger_id = $ledger->id;
            $kasir->save();

            DB::commit();

            return redirect()->route('kasir.index');
        } catch (\Exception $ex) {
            Log::debug($ex);

            DB::rollback();

            return redirect()
                ->route('kasir.index')
                ->with('error', 'Transaksi gagal: ' . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ledger  $ledger
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kasirList = Kasir::with('anggota')->find($id);
        $kasirBodyList = KasirBody::with('produk')->where('id_kasir',$id)->paginate(10);
        return view('kasir.show',compact('kasirList','kasirBodyList'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ledger  $ledger
     * @return \Illuminate\Http\Response
     */
    public function edit(Ledger $ledger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ledger  $ledger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ledger $ledger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ledger  $ledger
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ledger $ledger)
    {
        //
    }
}
