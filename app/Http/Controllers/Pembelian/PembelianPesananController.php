<?php

namespace App\Http\Controllers\Pembelian;

use App\Models\Ekpedisi;
use App\Models\Pengiriman;
use App\Models\PenomoranAuto;
use App\Models\Supplier;
use PDF;
use App\Models\DaftarProduk;
use App\Models\SatuanProduk;
use Illuminate\Http\Request;
use App\Models\TerminPenjualan;
use App\Models\PembelianPesanan;
use App\Http\Controllers\Controller;
use App\Models\EkspedisiPenjualan;
use App\Models\KodePerusahaan;
use App\Models\PajakPemotongan;
use App\Models\PembelianPesananBody;

class PembelianPesananController extends Controller
{
    public function index(Request $request)
    {

        $pesanan = PembelianPesanan::orderBy('created_at', 'desc')->paginate(10);
        return view('pembelian.pesanan.index', [
            'pesanan' => $pesanan
        ]);
    }

    public function create()
    {
        $supplier = Supplier::all();
        $termin = TerminPenjualan::all();
        $ekpedisi = Ekpedisi::all();
        $produk = DaftarProduk::all();
        $pajak = PajakPemotongan::all();
        $code = PembelianPesanan::count()+1;
        $auto = PenomoranAuto::where('keterangan','=','pesanan pembelian')->first();
        $count = PembelianPesanan::count() + 1;

        // ddd($produk);
        return view('pembelian.pesanan.create' , [
            'supplier' => $supplier,
            'termin' => $termin,
            'auto' => $auto,
            'count' => $count,
            'ekpedisi' => $ekpedisi,
            'produk' => $produk,
            'code' => $code,
            'pajak' => $pajak,
        ]);
    }

    public function store(Request $request)
    {

        // ddd($request->all());

        $penjualan = PembelianPesanan::create($request->only(['tanggal_pesanan','no_pesanan','supplier_id','termin_id',
            'ekpedisi_id','tanggal_penerimaan','id_supplier', 'jumlah_tagihan']));

        for ($produk_id = 0; $produk_id < count($request->produk_id); $produk_id++) {
            $orderdetail = new PembelianPesananBody;
            $orderdetail->pesanan_pembelian_id = $penjualan->id;
            $orderdetail->produk_id = $request->produk_id[$produk_id];
            $orderdetail->kuantitas = $request->kuantitas[$produk_id];
            $orderdetail->pajak = $request->pajak[$produk_id] ?: 0;
            $orderdetail->pajaktype = $request->pajaktype[$produk_id] ?: 0;
            $orderdetail->diskon = $request->diskon[$produk_id] ?: 0;
            $orderdetail->harga_produk = $request->harga_produk[$produk_id] ?: 0;
            $orderdetail->total = $request->total_amount[$produk_id];
            $orderdetail->total_disk = $request->total_disk[$produk_id] ?: 0;
            $orderdetail->total_ppn = $request->total_pajak[$produk_id] ?: 0;
            $orderdetail->total_pph = $request->total_pajak_pph[$produk_id] ?: 0;
            $orderdetail->total_amount_all = $request->total_amount_all[$produk_id];
            $orderdetail->diskon_per_item = $request->diskon_per_item;
            $orderdetail->diskon_seluruh = $request->diskon_seluruh ?: 0;
            $orderdetail->diskon_seluruhpersen = $request->diskon_seluruhpersen;
            $orderdetail->diskon_calculate = $request->diskon_calculate ?: 0;
            $orderdetail->biaya_pengiriman = $request->biaya_pengiriman;
            $orderdetail->ppn = $request->ppn;
            $orderdetail->pph = $request->pph;
            $orderdetail->total_tertagih = $request->jumlah_tagihan;
            $orderdetail->subtotal = $request->subtotal;
            $orderdetail->type_diskon = $request->type_diskon ?: 1;
            $orderdetail->save();
        }
        // $data =  $request->all();
        // ddd($data);
        // $pesanan = PembelianPesanan::create([
        //     'tanggal_pesanan' => $request->tanggal_pesanan,
        //     'no_pesanan' => $request->no_pesanan,
        //     'supplier_id' => $request->supplier_id,
        //     'tanggal_penerimaan' => $request->tanggal_penerimaan,
        //     'termin_id' => $request->termin_id,
        //     'ekpedisi_id' => $request->ekpedisi_id
        // ]);
        // for($produk_id = 0; $produk_id < count($request->produk_id); $produk_id++){
        //     $pembelianpesanan = new PembelianPesanan;
        //     $pembelianpesanan->tanggal_pesanan = $request->tanggal_pesanan,
        // }
        // ddd($pesanan);
        return redirect()->route('pembelian.pesanan.index')->with("success", __("Tambah Pesanan berhasil"));
    }

    public function getDataSupplier(Request $request)
    {
        $suppliers = Supplier::where('id', $request->country_id)->orderBy('nama', 'asc')->first();
        // ddd($suppliers);
        return response()->json($suppliers);
    }

    public function getDataProduk(Request $request)
    {
        $produks = DaftarProduk::with('satuan')->where('id', $request->country_id)->orderBy('nama_produk', 'asc')->first();
        // ddd($produks);
        return response()->json($produks);
    }

    public function show(Request $request, $id)
    {
        if ($request->query('export') == 'pdf') {

            $perusahan = KodePerusahaan::all();
            $pesanan = PembelianPesanan::with('supplier')->find($id);
            $pesananbody = PembelianPesananBody::with('produk','pajaks')->where('pesanan_pembelian_id', $pesanan->id)->get();
            // ddd($pesananbody[0]->subtotal);
            // $pesanan = PembelianPesanan::find($id);
            // $pesananbody = PembelianPesananBody::where('pesanan_pembelian_id', $pesanan->id)->get();

            // $pdf = PDF::loadView('tenants.admin.retribusi.daftar.show_pdf');
            $pdf = PDF::loadView('pembelian.pesanan.show_pdf', [
                'perusahan' => $perusahan, 'pesanan' => $pesanan, 'pesananbody' => $pesananbody], [], [
                    'title' => 'Pruchase Order'
                ]

            );
            return $pdf->stream('PurchaseOrder.pdf');
        }

        $produk = DaftarProduk::with('satuan')->get();
        // ddd($produk);
        $pesanan = PembelianPesanan::find($id);
        $pesananbody = PembelianPesananBody::where('pesanan_pembelian_id', $pesanan->id)->get();
        // ddd($pesananbody);
        return view('pembelian.pesanan.show', [
            'pesanan' => $pesanan,
            'pesananbody' => $pesananbody,
            'produk' => $produk
        ]);
    }

}
