<?php

namespace App\Http\Controllers;

use App\Models\AkunPerkiraan;
use App\Models\Anggota;
use App\Models\Bank;
use App\Models\DaftarProduk;
use App\Models\HistoryPenjualan;
use App\Models\JenisTransaksi;
use App\Models\Ledger;
use App\Models\PemesananPenjualan;
use App\Models\PemesananPenjualanBody;
use App\Models\PemetaanAkun;
use App\Models\Pengiriman;
use App\Models\PengirimanBody;
use App\Models\Penjualan;
use App\Models\PenjualanBody;
use App\Models\PenomoranAuto;
use App\Models\PerpajakanKeuangan;
use App\Models\RekeningSimpanan;
use App\Models\TerminPenjualan;
use Cknow\Money\Money;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $pemesanan = PemesananPenjualan::with('penawaran','pelanggans')->orderBy('created_at', 'DESC')->paginate(10);
        $pemesanan = Pengiriman::with('pemesanans')->orderBy('created_at', 'DESC')->paginate(10);

        return view('penjualan.pengirim.index',compact('pemesanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $penjualan = PemesananPenjualan::where('status_pemesanan','=','0')->get();
        $produk = DaftarProduk::with('satuan')->orderBy('nama_produk','ASC')->get();
        $anggota = Anggota::orderBy('nama_pemohon','ASC')->get();
        $produk_get = DB::table('daftar_produks')->join('satuan_produks','satuan_produks.id','=','daftar_produks.id_satuan')
            ->select('daftar_produks.id as id','daftar_produks.nama_produk','daftar_produks.kode_produk','satuan_produks.satuan_produk','daftar_produks.harga_anggota','daftar_produks.harga_bukan_anggota')
            ->get();
        $termin = TerminPenjualan::pluck('nama_termin_penjualan','id');
        $max = Pengiriman::all()->count() + 1;
        $pajak = PerpajakanKeuangan::all();
        $bank = Bank::all();
        $auto = PenomoranAuto::where('keterangan','=','Pembayaran Penjualan')->first();
        $count = Pengiriman::count() + 1;

        return view('penjualan.pengirim.create1',compact('auto','count','bank','pajak','produk','anggota','termin','max','penjualan','produk_get'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $anggota = Anggota::where('nama_pemohon',$request->id_pelanggan)->first();


        $last = Ledger::with('entries.ledgerable')->where('type', 'TN')->orderBy('journal_no', 'DESC')->first();

        $pendapatanPenjualan = PemetaanAkun::where('id','=',1)->first();
        $nominal = $request->total;
        $akun_produk     = AkunPerkiraan::findOrFail($pendapatanPenjualan->pendapatan_penjualan);

        $jenis_transaksi = AkunPerkiraan::findOrFail($pendapatanPenjualan->pembayaran_penjualan_cash);

        $jenis_transaksi_utang = AkunPerkiraan::findOrFail($pendapatanPenjualan->piutang_belum_ditagih);

        $jenis_transaksi_bank = AkunPerkiraan::findOrFail($pendapatanPenjualan->pembayaran_penjualan_transfer);

        $bank = Bank::find($request->id_bank);
        $jumlahterminhari = TerminPenjualan::where('id','=',$request->termin_pemesanan)->first();
        $convertinthari = (int)$jumlahterminhari->hari_termin_penjualan;
        $tanggal = date('Y-m-d', strtotime($request->tanggal_pengiriman. ' + '.$convertinthari.' days') ?? '0');
        // dd($tanggal);
//        if ($request->)
        if ($request->ada_pemesanan == 1) {
            $request->merge([
                'termin_pengiriman' => $request->termin_pemesanan,
                'non_anggota' => $request->id_pelanggan12,
                'tgl_jatuh_tempo' => $tanggal,
            ]);
            $penjualan = Pengiriman::create($request->all());
            PemesananPenjualan::where('id','=',$request->no_pemesanan)->update(['status_pemesanan'=>'1']);
        }else{
            if ($request->pelanggan == 1)
            {
                $request->merge([
                    'id_pelanggan' => $request->pelangganpilih,
                    'non_anggota' => $request->id_pelanggan12,
                    'tgl_jatuh_tempo' => $tanggal,
                ]);
                $penjualan =   Pengiriman::create($request->all());
            }else{

                $request->merge([
                    'id_pelanggan' => $request->id_pelanggan12,
                    'termin_pengiriman' =>$request->id_termin,
                    'non_anggota' => $request->id_pelanggan12,
                    'tgl_jatuh_tempo' => $tanggal,

                ]);
                $penjualan = Pengiriman::create($request->all());
            }
        }
        for ($id_produk = 0; $id_produk < count($request->id_produk); $id_produk++) {
            $produklist = DaftarProduk::where('id', $request->id_produk[$id_produk])->first();
            $orderdetail = new PengirimanBody;
            $orderdetail->id_pengiriman = $penjualan->id;
            $orderdetail->id_produk = $request->id_produk[$id_produk];
            $orderdetail->qty = $request->qty[$id_produk];
            $orderdetail->diskon = $request->diskon[$id_produk];
            $orderdetail->stok_berkurang =$produklist->stok - $request->qty[$id_produk];
            $orderdetail->harga_produk = $request->harga[$id_produk];
            $orderdetail->pajak = $request->pajak[$id_produk];
            $orderdetail->total_ppn = $request->total_pajak[$id_produk];
            $orderdetail->total_pph = $request->total_pajak_pph[$id_produk];
            $orderdetail->total_amount = $request->total_amount [$id_produk];
            $orderdetail->total_amount_all = $request->total_amount_all [$id_produk];
            $orderdetail->total_diskon = $request->total_disk [$id_produk];
            $orderdetail->total = $request->total_amount[$id_produk];
            $orderdetail->save();
        }

        for ($id_produk= 0; $id_produk < count($request->id_produk); $id_produk++){
            DaftarProduk::where('id', $request->id_produk[$id_produk])->decrement('stok', $request->qty[$id_produk]);
        }
        $umur_hutang = Pengiriman::where('id',$penjualan->id)->first();

         HistoryPenjualan::create([
            'id_pengiriman' => $penjualan->id,
            'non_anggota' => $umur_hutang->non_anggota,
            'total' => $umur_hutang->total,
            'bayar' => $umur_hutang->bayar,
            'created_at' => date('Y-m-d'),
             'umur' => $request->tanggal_pengiriman
         ]);

        if ($request->termin_pemesanan != '0'){

            if ($request->jenis_pembayaran == 'tunai')
            {

                DB::beginTransaction();

                try {
                    $request->merge([
                        'type'               => 'SO',
                        'nominal'            => $nominal,
                        'teller_transaction' => 1,
                        'date' => date('Y-m-d'),
                        'status' => 0,
                        'reference' => 'Penjualan',
                        'description' => 'Penjualan Termin No Pembayaran : '.$penjualan->no_pengiriman,
                        'created_at' => 1,
                        'updated_at' => 1,
                    ]);

                    $ledger = Ledger::create($request->all());


                    if ($pendapatanPenjualan->GL_pendapatan_penjualan == 'on') {
                        $entry = \App\Facades\Ledger::credit($jenis_transaksi,$akun_produk,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                        $entry = \App\Facades\Ledger::debit($akun_produk,$jenis_transaksi,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                    } else {
                        $entry = \App\Facades\Ledger::debit($jenis_transaksi,$akun_produk,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                        $entry = \App\Facades\Ledger::credit($akun_produk,$jenis_transaksi,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();
                    }

                    DB::commit();

                    return redirect()->route('pengiriman.index')->with("message",(" Pengiriman Berhasil Terdaftar"));

                } catch (\Exception $ex) {
                    Log::debug($ex);

                    DB::rollback();

                    return redirect()
                        ->route('pengiriman.index')
                        ->with('error', 'pemesanan penjualan gagal: ' . $ex->getMessage());
                }

            }elseif($request->jenis_pembayaran == 'transfer'){
                DB::beginTransaction();

                try {
                    $request->merge([
                        'type'               => 'SO',
                        'nominal'            => $nominal,
                        'teller_transaction' => 1,
                        'date' => date('Y-m-d'),
                        'status' => 0,
                        'reference' => 'Penjualan',
                        'description' => 'Penjualan Termin Lewat '.$bank->nama_bank .'No Pembayaran :  '.$penjualan->no_pengiriman,
                        'created_at' => 1,
                        'updated_at' => 1,
                    ]);

                    $ledger = Ledger::create($request->all());


                    if ($pendapatanPenjualan->GL_pendapatan_penjualan == 'on') {
                        $entry = \App\Facades\Ledger::credit($jenis_transaksi_bank,$akun_produk,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                        $entry = \App\Facades\Ledger::debit($akun_produk,$jenis_transaksi_bank,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                    } else {
                        $entry = \App\Facades\Ledger::debit($jenis_transaksi_bank,$akun_produk,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                        $entry = \App\Facades\Ledger::credit($akun_produk,$jenis_transaksi_bank,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();
                    }

                    DB::commit();

                    return redirect()->route('pengiriman.index')->with("message",(" pemesanan penjualan Berhasil Terdaftar"));

                } catch (\Exception $ex) {
                    Log::debug($ex);

                    DB::rollback();

                    return redirect()
                        ->route('pengiriman.index')
                        ->with('error', 'pemesanan penjualan gagal: ' . $ex->getMessage());
                }

            }elseif($request->jenis_pembayaran == 'rekening'){

                $rekening = RekeningSimpanan::where('anggota_id',$anggota->id)->first();
                $produkrekening = RekeningSimpanan::where('anggota_id',$anggota->id)->with('produk')->first();
                $akun_produk_rekening = AkunPerkiraan::findOrFail($produkrekening->produk->GL_produk_simpanan);
                if ($request->rekening == null)
                {
                }else{
                    if (!empty($request->rekening < $request->bayar)){
                        return redirect()->route('pengiriman.index')->with("error",(" Saldo Tidak Cukup"));
                    }
                }
                DB::beginTransaction();

                    $nominalrekening =  $request->rekenin - $nominal;
                try {


                    if ($pendapatanPenjualan->GL_pendapatan_penjualan == 'on') {
                        $request->merge([
                            'type'               => 'SO',
                            'nominal'            => $nominal,
                            'teller_transaction' => 1,
                            'date' => date('Y-m-d'),
                            'status' => 0,
                            'reference' => 'Penjualan',
                            'description' => 'Penjualan Termin Lewat Rekening'.$penjualan->id_pelanggan .'No Pembayaran :  '.$penjualan->no_pengiriman,
                            'created_at' => 1,
                            'updated_at' => 1,
                        ]);
                        $ledger = Ledger::create($request->all());

                        $entry = \App\Facades\Ledger::credit($jenis_transaksi_bank,$akun_produk,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                        $entry = \App\Facades\Ledger::debit($akun_produk,$jenis_transaksi_bank,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                        $entry = $rekening->debit(null, $nominalrekening, config('money.defaultCurrency'), $request->description, $ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();


                    } else {
                        $request->merge([
                            'type'               => 'SO',
                            'nominal'            => $nominal,
                            'teller_transaction' => 1,
                            'date' => date('Y-m-d'),
                            'status' => 0,
                            'reference' => 'Penjualan',
                            'description' => 'Penjualan Termin Lewat Rekening'.$penjualan->id_pelanggan .'No Pembayaran :  '.$penjualan->no_pengiriman,
                            'created_at' => 1,
                            'updated_at' => 1,
                        ]);
                        $ledger = Ledger::create($request->all());

                        $entry = \App\Facades\Ledger::debit($jenis_transaksi_bank,$akun_produk,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                        $entry = \App\Facades\Ledger::credit($akun_produk,$jenis_transaksi_bank,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                        $entry = $rekening->credit(null, $nominalrekening, config('money.defaultCurrency'), $request->description, $ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                    }


                    if ($pendapatanPenjualan->GL_pendapatan_penjualan == 'on') {
                        $request->merge([
                            'type'               => 'SO',
                            'nominal'            => $nominal,
                            'teller_transaction' => 1,
                            'date' => date('Y-m-d'),
                            'status' => 0,
                            'reference' => 'Penjualan',
                            'description' => ' Rekening'.$penjualan->id_pelanggan .'No Pembayaran :  '.$penjualan->no_pengiriman,
                            'created_at' => 1,
                            'updated_at' => 1,
                        ]);
                        $ledger = Ledger::create($request->all());

                        $entry = \App\Facades\Ledger::credit($jenis_transaksi_bank,$akun_produk_rekening,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                        $entry = \App\Facades\Ledger::debit($akun_produk_rekening,$jenis_transaksi_bank,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();



                    } else {
                        $request->merge([
                            'type'               => 'SO',
                            'nominal'            => $nominal,
                            'teller_transaction' => 1,
                            'date' => date('Y-m-d'),
                            'status' => 0,
                            'reference' => 'Penjualan',
                            'description' => ' Rekening'.$penjualan->id_pelanggan .'No Pembayaran :  '.$penjualan->no_pengiriman,
                            'created_at' => 1,
                            'updated_at' => 1,
                        ]);
                        $ledger = Ledger::create($request->all());

                        $entry = \App\Facades\Ledger::debit($jenis_transaksi_bank,$akun_produk_rekening,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                        $entry = \App\Facades\Ledger::credit($akun_produk_rekening,$jenis_transaksi_bank,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();


                    }

                    DB::commit();

                    return redirect()->route('pengiriman.index')->with("message",(" pemesanan penjualan Berhasil Terdaftar"));

                } catch (\Exception $ex) {
                    Log::debug($ex);

                    DB::rollback();

                    return redirect()
                        ->route('pengiriman.index')
                        ->with('error', 'pemesanan penjualan gagal: ' . $ex->getMessage());
                }

            }


        }else{
            if ($request->sisa_tagihan == '0')
            {
                if ($request->jenis_pembayaran == 'tunai')
                {

                    DB::beginTransaction();

                    try {
                        $request->merge([
                            'type'               => 'SO',
                            'nominal'            => $nominal,
                            'teller_transaction' => 1,
                            'date' => date('Y-m-d'),
                            'status' => 0,
                            'reference' => 'Penjualan',
                            'description' => 'Penjualan Tunai No Pembayaran : '.$penjualan->no_pengiriman,
                            'created_at' => 1,
                            'updated_at' => 1,
                        ]);

                        $ledger = Ledger::create($request->all());


                        if ($pendapatanPenjualan->GL_pendapatan_penjualan == 'on') {
                            $entry = \App\Facades\Ledger::credit($jenis_transaksi,$akun_produk,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();

                            $entry = \App\Facades\Ledger::debit($akun_produk,$jenis_transaksi,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();

                        } else {
                            $entry = \App\Facades\Ledger::debit($jenis_transaksi,$akun_produk,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();

                            $entry = \App\Facades\Ledger::credit($akun_produk,$jenis_transaksi,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();
                        }

                        DB::commit();

                        return redirect()->route('pengiriman.index')->with("message",(" pemesanan penjualan Berhasil Terdaftar"));

                    } catch (\Exception $ex) {
                        Log::debug($ex);

                        DB::rollback();

                        return redirect()
                            ->route('pengiriman.index')
                            ->with('error', 'pemesanan penjualan gagal: ' . $ex->getMessage());
                    }

                }elseif($request->jenis_pembayaran == 'transfer'){
                    DB::beginTransaction();

                    try {
                        $request->merge([
                            'type'               => 'SO',
                            'nominal'            => $nominal,
                            'teller_transaction' => 1,
                            'date' => date('Y-m-d'),
                            'status' => 0,
                            'reference' => 'Penjualan',
                            'description' => 'Penjualan Lewat '.$bank->nama_bank .'No Pembayaran :  '.$penjualan->no_pengiriman,
                            'created_at' => 1,
                            'updated_at' => 1,
                        ]);

                        $ledger = Ledger::create($request->all());


                        if ($pendapatanPenjualan->GL_pendapatan_penjualan == 'on') {
                            $entry = \App\Facades\Ledger::credit($jenis_transaksi_bank,$akun_produk,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();

                            $entry = \App\Facades\Ledger::debit($akun_produk,$jenis_transaksi_bank,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();

                        } else {
                            $entry = \App\Facades\Ledger::debit($jenis_transaksi_bank,$akun_produk,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();

                            $entry = \App\Facades\Ledger::credit($akun_produk,$jenis_transaksi_bank,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();
                        }

                        DB::commit();

                        return redirect()->route('pengiriman.index')->with("message",(" pemesanan penjualan Berhasil Terdaftar"));

                    } catch (\Exception $ex) {
                        Log::debug($ex);

                        DB::rollback();

                        return redirect()
                            ->route('pengiriman.index')
                            ->with('error', 'pemesanan penjualan gagal: ' . $ex->getMessage());
                    }

                }elseif($request->jenis_pembayaran == 'rekening'){

                    $rekening = RekeningSimpanan::where('anggota_id',$anggota->id)->first();
                    $produkrekening = RekeningSimpanan::where('anggota_id',$anggota->id)->with('produk')->first();
                    $akun_produk_rekening = AkunPerkiraan::findOrFail($produkrekening->produk->GL_produk_simpanan);
                    if ($request->rekening == null)
                    {
                    }else{
                        if (!empty($request->rekening < $request->bayar)){
                            return redirect()->route('pengiriman.index')->with("error",(" Saldo Tidak Cukup"));
                        }
                    }
                    DB::beginTransaction();

                    $nominalrekening =  $request->rekenin - $nominal;
                    try {


                        if ($pendapatanPenjualan->GL_pendapatan_penjualan == 'on') {
                            $request->merge([
                                'type'               => 'SO',
                                'nominal'            => $nominal,
                                'teller_transaction' => 1,
                                'date' => date('Y-m-d'),
                                'status' => 0,
                                'reference' => 'Penjualan',
                                'description' => 'Penjualan Termin Lewat Rekening'.$penjualan->id_pelanggan .'No Pembayaran :  '.$penjualan->no_pengiriman,
                                'created_at' => 1,
                                'updated_at' => 1,
                            ]);
                            $ledger = Ledger::create($request->all());

                            $entry = \App\Facades\Ledger::credit($jenis_transaksi_bank,$akun_produk,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();

                            $entry = \App\Facades\Ledger::debit($akun_produk,$jenis_transaksi_bank,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();

                            $entry = $rekening->debit(null, $nominalrekening, config('money.defaultCurrency'), $request->description, $ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();


                        } else {
                            $request->merge([
                                'type'               => 'SO',
                                'nominal'            => $nominal,
                                'teller_transaction' => 1,
                                'date' => date('Y-m-d'),
                                'status' => 0,
                                'reference' => 'Penjualan',
                                'description' => 'Penjualan Termin Lewat Rekening'.$penjualan->id_pelanggan .'No Pembayaran :  '.$penjualan->no_pengiriman,
                                'created_at' => 1,
                                'updated_at' => 1,
                            ]);
                            $ledger = Ledger::create($request->all());

                            $entry = \App\Facades\Ledger::debit($jenis_transaksi_bank,$akun_produk,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();

                            $entry = \App\Facades\Ledger::credit($akun_produk,$jenis_transaksi_bank,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();

                            $entry = $rekening->credit(null, $nominalrekening, config('money.defaultCurrency'), $request->description, $ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();

                        }


                        if ($pendapatanPenjualan->GL_pendapatan_penjualan == 'on') {
                            $request->merge([
                                'type'               => 'SO',
                                'nominal'            => $nominal,
                                'teller_transaction' => 1,
                                'date' => date('Y-m-d'),
                                'status' => 0,
                                'reference' => 'Penjualan',
                                'description' => ' Rekening'.$penjualan->id_pelanggan .'No Pembayaran :  '.$penjualan->no_pengiriman,
                                'created_at' => 1,
                                'updated_at' => 1,
                            ]);
                            $ledger = Ledger::create($request->all());

                            $entry = \App\Facades\Ledger::credit($jenis_transaksi_bank,$akun_produk_rekening,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();

                            $entry = \App\Facades\Ledger::debit($akun_produk_rekening,$jenis_transaksi_bank,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();



                        } else {
                            $request->merge([
                                'type'               => 'SO',
                                'nominal'            => $nominal,
                                'teller_transaction' => 1,
                                'date' => date('Y-m-d'),
                                'status' => 0,
                                'reference' => 'Penjualan',
                                'description' => ' Rekening'.$penjualan->id_pelanggan .'No Pembayaran :  '.$penjualan->no_pengiriman,
                                'created_at' => 1,
                                'updated_at' => 1,
                            ]);
                            $ledger = Ledger::create($request->all());

                            $entry = \App\Facades\Ledger::debit($jenis_transaksi_bank,$akun_produk_rekening,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();

                            $entry = \App\Facades\Ledger::credit($akun_produk_rekening,$jenis_transaksi_bank,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();


                        }

                        DB::commit();

                        return redirect()->route('pengiriman.index')->with("message",(" pemesanan penjualan Berhasil Terdaftar"));

                    } catch (\Exception $ex) {
                        Log::debug($ex);

                        DB::rollback();

                        return redirect()
                            ->route('pengiriman.index')
                            ->with('error', 'pemesanan penjualan gagal: ' . $ex->getMessage());
                    }

                }
            }else{
                if ($request->jenis_pembayaran == 'tunai')
                {

                    DB::beginTransaction();

                    try {
                        $request->merge([
                            'type'               => 'SO',
                            'nominal'            => $nominal,
                            'teller_transaction' => 1,
                            'date' => date('Y-m-d'),
                            'status' => 0,
                            'reference' => 'Penjualan',
                            'description' => 'Penjualan Sebagian Tunai No Pembayaran : '.$penjualan->no_pengiriman,
                            'created_at' => 1,
                            'updated_at' => 1,
                        ]);

                        $ledger = Ledger::create($request->all());


                        if ($pendapatanPenjualan->GL_pendapatan_penjualan == 'on') {
                            $entry = \App\Facades\Ledger::debit($jenis_transaksi,$akun_produk,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();

                            $entry = \App\Facades\Ledger::credit($akun_produk,$jenis_transaksi,$request->bayar,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();

                            $entry = \App\Facades\Ledger::credit($akun_produk,$jenis_transaksi_utang,$request->sisa_tagihan,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();

                        } else {
                            $entry = \App\Facades\Ledger::credit($jenis_transaksi,$akun_produk,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();

                            $entry = \App\Facades\Ledger::debit($akun_produk,$jenis_transaksi,$request->bayar,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();

                            $entry = \App\Facades\Ledger::debit($akun_produk,$jenis_transaksi_utang,$request->sisa_tagihan,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();
                        }

                        DB::commit();

                        return redirect()->route('pengiriman.index')->with("message",(" pemesanan penjualan Berhasil Terdaftar"));

                    } catch (\Exception $ex) {
                        Log::debug($ex);

                        DB::rollback();

                        return redirect()
                            ->route('pengiriman.index')
                            ->with('error', 'pemesanan penjualan gagal: ' . $ex->getMessage());
                    }
                }else{
                    DB::beginTransaction();

                    try {
                        $request->merge([
                            'type'               => 'SO',
                            'nominal'            => $nominal,
                            'teller_transaction' => 1,
                            'date' => date('Y-m-d'),
                            'status' => 0,
                            'reference' => 'Penjualan',
                            'description' => 'Penjualan Sebagian Lewat '.$bank->nama_bank .'No Pembayaran :  '.$penjualan->no_pengiriman,
                            'created_at' => 1,
                            'updated_at' => 1,
                        ]);

                        $ledger = Ledger::create($request->all());
                        if ($pendapatanPenjualan->GL_pendapatan_penjualan == 'on') {
                            $entry = \App\Facades\Ledger::debit($jenis_transaksi_bank,$akun_produk,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();

                            $entry = \App\Facades\Ledger::credit($akun_produk,$jenis_transaksi_bank,$request->bayar,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();

                            $entry = \App\Facades\Ledger::credit($akun_produk,$jenis_transaksi_utang,$request->sisa_tagihan,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();

                        } else {
                            $entry = \App\Facades\Ledger::credit($jenis_transaksi_bank,$akun_produk,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();

                            $entry = \App\Facades\Ledger::debit($akun_produk,$jenis_transaksi_bank,$request->bayar,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();

                            $entry = \App\Facades\Ledger::debit($akun_produk,$jenis_transaksi_utang,$request->sisa_tagihan,config('money.defaultCurrency'),'penjualan',$ledger->id);
                            $entry->ledger_id = $ledger->id;
                            $entry->save();
                        }


                        DB::commit();

                        return redirect()->route('pengiriman.index')->with("message",(" pemesanan penjualan Berhasil Terdaftar"));

                    } catch (\Exception $ex) {
                        Log::debug($ex);

                        DB::rollback();

                        return redirect()
                            ->route('pengiriman.index')
                            ->with('error', 'pemesanan penjualan gagal: ' . $ex->getMessage());
                    }

                }
            }
        }




//        return redirect()->route('pengiriman.index')->with("message",(" pemesanan penjualan Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penjualan = PemesananPenjualan::orderBy('no_pemesanan')->get();
        $produk = DaftarProduk::with('satuan')->orderBy('nama_produk','ASC')->get();
        $anggota = Anggota::orderBy('nama_pemohon','ASC')->get();
        $termin = TerminPenjualan::pluck('nama_termin_penjualan','id');
        $max = PemesananPenjualan::max('id') +1;
        $enjualan = Pengiriman::with('pemesanans.termins','pelanggans')->find($id);
        $enjualanbody = PengirimanBody::with('produk.satuan','termins','pajaks')->where('id_Pengiriman',$id)->get();

        return view('penjualan.pengirim.show',compact('enjualanbody','enjualan','produk','anggota','termin','max','penjualan'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pemesanan = Pengiriman::find($id);
        return view('penjualan.pengirim.edit',compact('pemesanan'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $penjualan_sebagian = Pengiriman::where('id',$request->id_bayar)->first();
        $penjualan_sebagian->update([
//            'jumlah_bayar' => $penjualan_sebagian->sisa_tagihan + $request->bayar_sebagian,
            'bayar' => $penjualan_sebagian->sisa_tagihan + $request->bayar_sebagian,
            'sisa_tagihan' => $penjualan_sebagian->sisa_tagihan - $request->bayar_sebagian,
        ]);
        $umur_hutang = Pengiriman::where('id',$request->id_bayar)->first();
        HistoryPenjualan::create([
            'id_pengiriman' => $request->id_bayar,
            'non_anggota' => $umur_hutang->non_anggota,
            'total' => $umur_hutang->total,
            'bayar' => $request->bayar_sebagian,
            'created_at' => date('Y-m-d'),
            'umur' => $request->tanggal_pengiriman
        ]);
        if ($penjualan_sebagian->sisa_tagihan == '0'){
            $update_sebagian_bayar = Pengiriman::where('id',$request->id_bayar)->first();
            $update_sebagian_bayar->update([
                'status_pembayaran_penjualan' => 'Lunas'
            ]);
        }
        return redirect()->route('pengiriman.index')->with("message",("Sisa Pembayaran berhasil Terupdate"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getdatapemesanan(Request $request)
    {
        $produk = PemesananPenjualanBody::with('produks.satuan','pemesanan.anggotas','terminss','pemesanan.penawaran','pemesanan.termins','pemesanan.rekenings')->where('id_pemesanan',$request->country_id)->get();

        return response()->json($produk);
    }
}
