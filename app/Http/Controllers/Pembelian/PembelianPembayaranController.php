<?php

namespace App\Http\Controllers\Pembelian;

use App\Models\AkunPerkiraan;
use App\Models\Bank;
use App\Models\Historypembelian;
use App\Models\HistoryPenjualan;
use PDF;
use App\Models\DaftarProduk;
use App\Models\KodePerusahaan;
use App\Models\Ledger;
use App\Models\PembelianPembayaranBody;
use App\Models\PemetaanAkun;
use App\Models\PerpajakanKeuangan;
use App\Models\SisaBayar;
use Illuminate\Http\Request;
use App\Models\PembelianPembayaran;
use App\Models\PembelianPenerimaan;
use App\Http\Controllers\Controller;
use App\Models\PembelianPenerimaanBody;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PembelianPembayaranController extends Controller
{
    public function index()
    {

        $penerimaan = PembelianPenerimaan::with('pembayaran')->orderBy('created_at', 'DESC')->paginate(10);
        $pembayaran = PembelianPembayaran::orderBy('created_at', 'DESC')->paginate(10);
        return view('pembelian.pembayaran.index',[
        'penerimaan' => $penerimaan,
        'pembayaran' => $pembayaran
        ]);
    }

    public function create($id)
    {
        $pajak = PerpajakanKeuangan::all();
        $bank = Bank::all();
        $penerimaan = PembelianPenerimaan::find($id);
        $pembayaran = PembelianPembayaran::where('penerimaan_id', $penerimaan->id)->get();
        $penerimaan_body = PembelianPenerimaanBody::where('pembelian_penerimaan_id', $penerimaan->id)->get();
    //    ddd($penerimaan);
        return view('pembelian.pembayaran.create', [
            'penerimaan' => $penerimaan,
            'pembayaran' => $pembayaran,
            'pajak' =>$pajak,
            'bank' =>$bank,
            'penerimaan_body' => $penerimaan_body,

            //ddd($pembayaran[0]->tanggal_pembayaran)
        ]);
    }
    public function edit($id)
    {

        $penerimaan = PembelianPenerimaan::with('pembayaran')->find($id);
//        $sisaBayar = SisaBayar::where('id_pemesanan',$id)->get();
        $pembayaran = PembelianPembayaran::where('penerimaan_id', $penerimaan->id)->get();
        $penerimaan_body = PembelianPenerimaanBody::where('pembelian_penerimaan_id', $penerimaan->id)->get();
//        ddd($sisaBayar);
        return view('pembelian.pembayaran.edit', [
            'penerimaan' => $penerimaan,
            'pembayaran' => $pembayaran,
            'penerimaan_body' => $penerimaan_body,
//            'sisaBayar' =>$sisaBayar,

            //ddd($pembayaran[0]->tanggal_pembayaran)
        ]);
    }


    public function store(Request $request)
    {

        // ddd($request->all());

        $last = Ledger::with('entries.ledgerable')->where('type', 'TN')->orderBy('journal_no', 'DESC')->first();

        $pendapatanPenjualan = PemetaanAkun::where('id','=',1)->first();
        $nominal = $request->jumlah_tagihan;
        $akun_produk     = AkunPerkiraan::findOrFail($pendapatanPenjualan->pembelian);

        $jenis_transaksi = AkunPerkiraan::findOrFail($pendapatanPenjualan->pembayaran_pembelian_cash);

        $jenis_transaksi_utang = AkunPerkiraan::findOrFail($pendapatanPenjualan->hutang_belum_ditagih);

        $jenis_transaksi_bank = AkunPerkiraan::findOrFail($pendapatanPenjualan->pembayaran_pembelian_transfer);

        $bank = Bank::find($request->id_bank);

        $pembayaran =  PembelianPembayaran::create([
            'penerimaan_id' => $request->penerimaan_id,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'jumlah_tagihan' => $request->jumlah_tagihan,
            'jumlah_bayar' => $request->jumlah_bayar,
            'sisa_tagihan' => $request->sisa_tagihan,
            'akun_pembayaran' => 1,
            'catatan' => $request->catatan,
            'invoice' => $request->invoice,
            'supplier' => $request->supplier,
            'termin_pembayaran' => $request->termin_pembayaran,
        ]);


        $listpembelian = PembelianPembayaran::where('penerimaan_id',$pembayaran->penerimaan_id)->first();
        if ($listpembelian->sisa_tagihan == '0'){
            PembelianPenerimaan::where('id','=',$pembayaran->penerimaan_id)->update([
                'status_pembayaran' => 'Lunas',
            ]);
        }else{
            PembelianPenerimaan::where('id','=',$pembayaran->penerimaan_id)->update([
                'status_pembayaran' => 'Belum Lunas',
            ]);
        }
//        historypembelian
        Historypembelian::create([
            'id_pembayaran' => $pembayaran->id,
            'non_anggota' => $pembayaran->supplier,
            'total' => $pembayaran->jumlah_tagihan,
            'bayar' => $request->jumlah_bayar,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        for ($produk = 0; $produk < count($request->produk); $produk++) {
            $produklist = DaftarProduk::where('id', $request->produk[$produk])->first();
            $orderdetail = new PembelianPembayaranBody();
            $orderdetail->id_pembelian_pembayaran = $pembayaran->id;
            $orderdetail->produk =  $request->produk[$produk];
            $orderdetail->qty =  $request->qty[$produk];
            $orderdetail->stok = $produklist->stok +  $request->qty[$produk];
            $orderdetail->save();
        }
        for ($produk= 0; $produk < count($request->produk); $produk++){
            DaftarProduk::where('id', $request->produk[$produk])->increment('stok', $request->qty[$produk]);
        }

        if ($request->sisa_tagihan == '0')
        {

            if ($request->jenis_bayar == 'tunai')
            {

                DB::beginTransaction();

                try {
                    $request->merge([
                        'type'               => 'PO',
                        'nominal'            => $nominal,
                        'teller_transaction' => 1,
                        'date' => date('Y-m-d'),
                        'status' => 0,
                        'reference' => 'Pembelian',
                        'description' => 'Pembelian Tunai No Pembayaran : '.$pembayaran->invoice,
                        'created_at' => 1,
                        'updated_at' => 1,
                    ]);

                    $ledger = Ledger::create($request->all());


                    if ($pendapatanPenjualan->GL_pendapatan_penjualan == 'on') {
                        $entry = \App\Facades\Ledger::debit($jenis_transaksi,$akun_produk,$nominal,config('money.defaultCurrency'),'pembelian',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                        $entry = \App\Facades\Ledger::credit($akun_produk,$jenis_transaksi,$nominal,config('money.defaultCurrency'),'pembelian',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                    } else {
                        $entry = \App\Facades\Ledger::credit($jenis_transaksi,$akun_produk,$nominal,config('money.defaultCurrency'),'pembelian',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                        $entry = \App\Facades\Ledger::debit($akun_produk,$jenis_transaksi,$nominal,config('money.defaultCurrency'),'pembelian',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();
                    }

                    DB::commit();

                    return redirect()->route('pembelian.pembayaran.index')->with("message",(" pembayaran pembelian Berhasil Terdaftar"));

                } catch (\Exception $ex) {
                    Log::debug($ex);

                    DB::rollback();

                    return redirect()
                        ->route('pembelian.pembayaran.index')
                        ->with('error', 'pembayaran pembelian gagal: ' . $ex->getMessage());
                }

            }else{
                DB::beginTransaction();

                try {
                    $request->merge([
                        'type'               => 'PO',
                        'nominal'            => $nominal,
                        'teller_transaction' => 1,
                        'date' => date('Y-m-d'),
                        'status' => 0,
                        'reference' => 'Pembelian',
                        'description' => 'Pembelian Lewat '.$bank->nama_bank .'No Pembayaran :  '.$pembayaran->invoice,
                        'created_at' => 1,
                        'updated_at' => 1,
                    ]);

                    $ledger = Ledger::create($request->all());


                    if ($pendapatanPenjualan->GL_pendapatan_pembelian == 'on') {
                        $entry = \App\Facades\Ledger::debit($jenis_transaksi_bank,$akun_produk,$nominal,config('money.defaultCurrency'),'pembelian',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                        $entry = \App\Facades\Ledger::credit($akun_produk,$jenis_transaksi_bank,$nominal,config('money.defaultCurrency'),'pembelian',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                    } else {
                        $entry = \App\Facades\Ledger::credit($jenis_transaksi_bank,$akun_produk,$nominal,config('money.defaultCurrency'),'pembelian',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                        $entry = \App\Facades\Ledger::debit($akun_produk,$jenis_transaksi_bank,$nominal,config('money.defaultCurrency'),'pembelian',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();
                    }

                    DB::commit();

                    return redirect()->route('pembelian.pembayaran.index')->with("message",(" pembayaran pembelian Berhasil Terdaftar"));

                } catch (\Exception $ex) {
                    Log::debug($ex);

                    DB::rollback();

                    return redirect()
                        ->route('pembelian.pembayaran.index')
                        ->with('error', 'pembayaran pembelian gagal: ' . $ex->getMessage());
                }

            }
        }else{
            if ($request->jenis_bayar == 'tunai')
            {

                DB::beginTransaction();

                try {
                    $request->merge([
                        'type'               => 'PO',
                        'nominal'            => $nominal,
                        'teller_transaction' => 1,
                        'date' => date('Y-m-d'),
                        'status' => 0,
                        'reference' => 'Pembelian',
                        'description' => 'Pembelian Tunai Sebagian No Pembayaran : '.$pembayaran->invoice,
                        'created_at' => 1,
                        'updated_at' => 1,
                    ]);

                    $ledger = Ledger::create($request->all());


                    if ($pendapatanPenjualan->GL_pendapatan_penjualan == 'on') {
                        $entry = \App\Facades\Ledger::credit($jenis_transaksi,$akun_produk,$nominal,config('money.defaultCurrency'),'pembelian',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                        $entry = \App\Facades\Ledger::debit($akun_produk,$jenis_transaksi,$request->jumlah_bayar,config('money.defaultCurrency'),'pembelian',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                        $entry = \App\Facades\Ledger::debit($akun_produk,$jenis_transaksi_utang,$request->sisa_tagihan,config('money.defaultCurrency'),'penjualan',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                    } else {
                        $entry = \App\Facades\Ledger::debit($jenis_transaksi,$akun_produk,$nominal,config('money.defaultCurrency'),'penjualan',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                        $entry = \App\Facades\Ledger::credit($akun_produk,$jenis_transaksi,$request->jumlah_bayar,config('money.defaultCurrency'),'penjualan',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                        $entry = \App\Facades\Ledger::credit($akun_produk,$jenis_transaksi_utang,$request->sisa_tagihan,config('money.defaultCurrency'),'penjualan',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();
                    }

                    DB::commit();

                    return redirect()->route('pembelian.pembayaran.index')->with("message",(" pembayaran pembelian Berhasil Terdaftar"));

                } catch (\Exception $ex) {
                    Log::debug($ex);

                    DB::rollback();

                    return redirect()
                        ->route('pembelian.pembayaran.index')
                        ->with('error', 'pembayaran pembelian gagal: ' . $ex->getMessage());
                }

            }else{
                DB::beginTransaction();

                try {
                    $request->merge([
                        'type'               => 'PO',
                        'nominal'            => $nominal,
                        'teller_transaction' => 1,
                        'date' => date('Y-m-d'),
                        'status' => 0,
                        'reference' => 'Pembelian',
                        'description' => 'Pembelian Sebagian Lewat '.$bank->nama_bank .'No Pembayaran :  '.$pembayaran->invoice,
                        'created_at' => 1,
                        'updated_at' => 1,
                    ]);

                    $ledger = Ledger::create($request->all());


                    if ($pendapatanPenjualan->GL_pendapatan_penjualan == 'on') {
                        $entry = \App\Facades\Ledger::credit($jenis_transaksi_bank,$akun_produk,$nominal,config('money.defaultCurrency'),'pembelian',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                        $entry = \App\Facades\Ledger::debit($akun_produk,$jenis_transaksi_bank,$request->jumlah_bayar,config('money.defaultCurrency'),'pembelian',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                        $entry = \App\Facades\Ledger::debit($akun_produk,$jenis_transaksi_utang,$request->sisa_tagihan,config('money.defaultCurrency'),'pembelian',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                    } else {
                        $entry = \App\Facades\Ledger::debit($jenis_transaksi_bank,$akun_produk,$nominal,config('money.defaultCurrency'),'pembelian',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                        $entry = \App\Facades\Ledger::credit($akun_produk,$jenis_transaksi_bank,$request->jumlah_bayar,config('money.defaultCurrency'),'pembelian',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();

                        $entry = \App\Facades\Ledger::credit($akun_produk,$jenis_transaksi_utang,$request->sisa_tagihan,config('money.defaultCurrency'),'pembelian',$ledger->id);
                        $entry->ledger_id = $ledger->id;
                        $entry->save();
                    }


                    DB::commit();

                    return redirect()->route('pembelian.pembayaran.index')->with("message",(" pembayaran pembelian Berhasil Terdaftar"));

                } catch (\Exception $ex) {
                    Log::debug($ex);

                    DB::rollback();

                    return redirect()
                        ->route('pengiriman.index')
                        ->with('error', 'pembayaran pembelian gagal: ' . $ex->getMessage());
                }

            }
        }

        $saem = PembelianPenerimaan::where('id','=',$request->penerimaan_id)->update(['status_pembayaran'=> $request->status_pembayaran]);
        return redirect()->route('pembelian.pembayaran.index')->with("message",(" Pembayaran berhasil Terdaftar"));
    }
    public function store_sebagian(Request $request)
    {

        $sebagian_bayar = PembelianPembayaran::where('penerimaan_id',$request->id_pemesanan)->first();
        $sebagian_bayar->update([
            'jumlah_bayar' => $sebagian_bayar->jumlah_bayar + $request->bayar_sebagian,
            'sisa_tagihan' => $sebagian_bayar->sisa_tagihan - $request->bayar_sebagian,
        ]);
        if ($sebagian_bayar->sisa_tagihan == '0'){
            $update_sebagian_bayar = PembelianPenerimaan::find($request->id_pemesanan);
            $update_sebagian_bayar->update([
                'status_pembayaran' => 'Lunas'
            ]);
            Historypembelian::create([
                'id_pembayaran' => $sebagian_bayar->id,
                'non_anggota' => $sebagian_bayar->supplier,
                'total' => $sebagian_bayar->jumlah_tagihan,
                'bayar' => $request->bayar_sebagian,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
        return redirect()->route('pembelian.pembayaran.index')->with("message",("Sisa Pembayaran berhasil Terupdate"));

    }

    public function show(Request $request,$id)
    {
        $produk = DaftarProduk::with('satuan')->get();
        // ddd($produk);
        $penerimaan = PembelianPenerimaan::find($id);
        $sisaBayar = SisaBayar::where('id_pemesanan',$id);

        $penerimaanbody = PembelianPenerimaanBody::where('pembelian_penerimaan_id', $penerimaan->id)->get();
        $pembayaran = PembelianPembayaran::with('penerimaan')->where('penerimaan_id', $penerimaan->id)->first();
        $perusahan = KodePerusahaan::all();


        return view('pembelian.pembayaran.show', [
            'penerimaan' => $penerimaan,
            'penerimaanbody' => $penerimaanbody,
            'produk' => $produk,
            'pembayaran' => $pembayaran,

        ]);
    }
    public function show_pdf(Request $request,$id)
    {
        $produk = DaftarProduk::with('satuan')->get();
        $penerimaan = PembelianPenerimaan::find($id);
        $sisaBayar = SisaBayar::where('id_pemesanan',$id);

        $penerimaanbody = PembelianPenerimaanBody::where('pembelian_penerimaan_id', $penerimaan->id)->get();
        $pembayaran = PembelianPembayaran::with('penerimaan','supplier')->where('penerimaan_id', $penerimaan->id)->first();
        $perusahan = KodePerusahaan::all();

//        ddd($pembayaran);
            $pdf = PDF::loadView('pembelian.pembayaran.show_pdf1', [
                'perusahan' => $perusahan, 'pesanan' => $pembayaran, 'pesananbody' => $penerimaanbody], [], [
                    'title' => 'Pruchase Order'
                ]
            );
        return $pdf->stream('PurchaseOrder.pdf');


    }
}
