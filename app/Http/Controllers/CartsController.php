<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Carts;
use App\Models\DaftarProduk;
use App\Models\Pengiriman;
use App\Models\PengirimanBody;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;

class CartsController extends Controller
{
    public function index(Request $request)
    {
        $anggota = Anggota::filter($request->all())->orderBy('created_at', 'DESC')->get();

        
        if ($request->ajax()) {

            $anggota = Anggota::filter($request->all())->get();
            
            // $anggota->map(function ($a, $i) {
            //     $a->text = $a->nama_pemohon;
            // });

            return response()->json(['results' => $anggota]);
        }

        $products = DaftarProduk::orderBy('created_at', 'DESC')->paginate(10);
        // ddd($products);

        return view('e_commerce/index', compact('products'));
    }

    public function list(Request $request)
    {
        $token = csrf_token(); //unique setiap laptop

        $list = Carts::first();
        // $list = Carts::where('token', '=', $token)->get();
        $cart = false;
        // dd($list);

        if ($list) {
            $cart = Carts::where('token',$token)->orderBy('created_at', 'DESC')->groupBy('produks_id')
            ->paginate(10);
            // dd($cart);
        }
        
        // ddd($cart);

        return view('cart.index', compact('cart'));
    }

    public function getDataAnggota(Request $request)
    {
        $anggotas = Anggota::where('id', $request->id)->orderBy('no_mitra', 'asc')->first();
        return response()->json($anggotas);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->merge([
            'token' => $request->_token
        ]);

        $list = Carts::where('produks_id',$request->produks_id)->count();
        $qty = Carts::where('produks_id',$request->produks_id)->first();
        if($list > 0) {
            Carts::where('produks_id',$request->produks_id)->update([
                'qty' => $qty->qty + 1
            ]);
        }else{
            Carts::create($request->all());
        }
      
        return redirect()->route('carts.list');
        // return response()->json([
        //     'message' => 'Successfully added to cart',
        //     'cart' => $cart
        // ], 200);
    }
    // {
    //     $data = [
    //         'produks_id' => $id,
    //     ];

    //     Carts::create($data);
    //     return redirect()->route('carts.index');
    //     // return view('cart.index');
    // }

    public function delete($id)
    {
        Carts::destroy($id);
        return back()->with('success', 'Hapus data cart berhasil');
    }

    public function add(Request $request)
    {
        
      $cart = Carts::where('token', $request->_token)->get();
      

      $count = Pengiriman::count() + 1;
     if($request->non_anggota != null) {

        // ddd($request->all());
        $transaksi = Pengiriman::create([
            'non_anggota' => $request->non_anggota,
            'no_telp' => $request->no_telp[0],
            'alamat'    => $request->alamat[0],
            'total'     => $request->total_price_non,
            'status_pembayaran_penjualan'     => 'Lunas',
            'total' => $request->total_price_non,
            'bayar' => $request->total_price_non,
            'sisa_tagihan' => '0',
            'tanggal_pengiriman' => date('Y-m-d'),
            'status' => 'BARU',
            'ada_pemesanan' => '0',
            'no_pemesanan' => '0',
            'pelanggan' => $request->pelanggan[0], // 0 = non anggota, 1 = anggota
            'no_pengiriman' => 'CM-'.$count,
            'id_pelanggan' => $request->id_pelanggan[0],
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        ddd($transaksi);

        foreach ($cart as $c) {
            $produk = DaftarProduk::where('id', $c->produks_id)->first();
            $produk->stok = $produk->stok - $c->qty;
            $produk->save();
            PengirimanBody::create([
                'pengiriman_id' => $transaksi->id,
                'produks_id' => $c->produks_id,
                'qty' => $c->qty,
                'harga_produk' => $produk->harga_bukan_anggota,
                'total_amount' => $request->total_price_non,
                'total_amount_all' => $request->total_price_non,
                'total' => $request->total_price_non,
                'created_at' => date('Y-m-d H:i:s'),
                'stok_berkurang'=>  $produk->stok - $c->qty,
            ]);
        }
        // ddd($transaksi);

     }else{

        $anggota = Anggota::where('id', $request->aktif_anggota)->first();

        $transaksi = Pengiriman::create([
            'non_anggota' => $anggota->nama_pemohon,
            'id_pelanggan' => $anggota->id,
            'no_telp' => $request->no_telp[1],
            'alamat'    => $request->alamat[1],
            'total'     => $request->total_price,
            'status_pembayaran_penjualan'     => 'Lunas',
            'total' => $request->total_price,
            'bayar' => $request->total_price,
            'sisa_tagihan' => '0',
            'tanggal_pengiriman' => date('Y-m-d'),
            'status' => 'BARU',
            'ada_pemesanan' => '0',
            'no_pemesanan' => '0',
            'pelanggan' => $request->pelanggan[1], // 0 = non anggota, 1 = anggota
            'no_pengiriman' => 'CM-'.$count,
            'created_at' => date('Y-m-d H:i:s'),
        ]);


        foreach ($cart as $c) {
            $produk = DaftarProduk::where('id', $c->produks_id)->first();
            $produk->stok = $produk->stok - $c->qty;
            $produk->save();
            PengirimanBody::create([
                'pengiriman_id' => $transaksi->id,
                'produks_id' => $c->produks_id,
                'qty' => $c->qty,
                'harga_produk' => $produk->harga_anggota,
                'total_amount' => $request->total_price,
                'total_amount_all' => $request->total_price,
                'total' => $request->total_price_non,
                'created_at' => date('Y-m-d H:i:s'),
                'stok_berkurang'=>  $produk->stok - $c->qty,
            ]);
        }
     }

        
        

        
        // konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // $anggota = Anggota::where('id', $request->aktif_anggota)->first();
        // ddd($anggota);

        if ($request->id_pelanggan == 0) {
            $params = array(
                'transaction_details' => array(
                    'order_id' => $transaksi->no_pengiriman,
                    'gross_amount' => $request->total_price_non,
                ),
                'customer_details' => array(
                    'first_name' => $request->non_anggota,
                    // 'last_name' => 'pratama',
                    'email' => $request->email,
                    'phone' => $request->no_telp[0],
                ),
                'vtweb' => [],
            );
        } else {
            $params = array(
                'transaction_details' => array(
                    'order_id' => $transaksi->no_pengiriman,
                    'gross_amount' => $request->total_price,
                ),
                'customer_details' => array(
                    'first_name' => $anggota->nama_pemohon,
                    // 'last_name' => $request->nama_penerima,
                    'email' => $anggota->email,
                    'phone' => $request->no_telp[1],
                ),
                'vtweb' => [],
            );
        }

        Carts::where('token', $request->_token)->delete();

        try {
            // Get Snap Payment Page URL
            $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
            // ddd($paymentUrl);
            // Redirect to Snap Payment Page
            // header('Location: ' . $paymentUrl);
            return redirect($paymentUrl);
          }
          catch (\Exception $e) {
            echo $e->getMessage();
          }

        // return view('cart.success', );
    }

}
