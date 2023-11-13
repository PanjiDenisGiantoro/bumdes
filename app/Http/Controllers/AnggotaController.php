<?php

namespace App\Http\Controllers;

use Image;
use App\Models\User;
use App\Models\Anggota;
use App\Models\Rekening;
use App\Models\Pengiriman;
use App\Models\LedgerEntry;
use Illuminate\Support\Str;
use App\Models\DaftarWarung;
use Illuminate\Http\Request;
use App\Models\PenomoranAuto;
use App\Models\KodePendidikan;
use App\Models\KodePerusahaan;
use App\Models\PengirimanBody;
use App\Models\KodeBidangUsaha;
use App\Models\RekeningSimpanan;
use App\Models\ProvinsiKabupaten;
use App\Models\StatusKeanggotaan;
use App\Models\KodeStatusKeluarga;
use App\Models\RekeningPembiayaan;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\ModelFilters\AnggotaFilter;
use App\Models\PembelianPembayaran;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $anggota = Anggota::filter($request->all())->with('status_keanggotaans')->orderBy('created_at', 'DESC')->get();
        $Listanggota = Anggota::filter($request->all())->with('status_keanggotaans')->orderBy('created_at', 'DESC')->paginate(10);

        if ($request->ajax()) {

            if ($request->query('id')) { // search user ID - Arrave
                $anggota = Anggota::filter($request->all())
                    ->with('rekenings.produk') // Consumed on selected user simjaka -Arrave
                    ->first();

                $anggotarekening = RekeningSimpanan::with('produk')->where('anggota_id',$request->id)->get();

                return response()->json(['results' => $anggota,'rekening' => $anggotarekening]);
            }
            if ($request->query('anggotaId')) { // consumed on pengajuan pendanaan

                $anggota = Anggota::with('kodependidikan', 'statuskeluarga', 'province', 'regencies', 'districts', 'villages')
                    ->where('id', $request->anggotaId)
                    ->first();

                $warung = DaftarWarung::where('id_anggota', '=', $request->anggotaId)
                    ->with('anggota', 'statusbangunan', 'province', 'regencies', 'districts', 'villages','bidangusaha')
                    ->first();

                if (!$warung) {
                    return response()->json([
                        'block' => 'tiada warung',
                    ]);
                }

                $pendidikan = $anggota['kodependidikan']['pendidikan'];
                $keluarga = $anggota['statuskeluarga']['status_dalam_keluarga'];
                $file_ktp = Storage::disk('public')->files('ktp/' . $warung->anggota->id);
                $file_foto = Storage::disk('public')->files('selfi/' . $warung->anggota->id);
                $warung1 = Storage::disk('public')->files('warung/' . $warung->id);
                $warung2 = Storage::disk('public')->files('warung1/' . $warung->id);
                $warung3 = Storage::disk('public')->files('warung2/' . $warung->id);
                $warung4 = Storage::disk('public')->files('warung3/' . $warung->id);

                $foto = $file_foto[0] ?? '';
                $foto1 = $file_ktp[0] ?? '';

                $warung1 = $warung1[0] ?? '';
                $warung2 = $warung2[0] ?? '';
                $warung3 = $warung3[0] ?? '';
                $warung4 = $warung4[0] ?? '';

                return response()->json([
                    // 'validate' => $validat,
                    'pendidikan' => $pendidikan,
                    'keluarga' => $keluarga,
                    'warung' => $warung,
                    'anggota' => $anggota,
                    'gambar' => $foto,
                    'gambar1' => $foto1,
                    'warung1' => $warung1,
                    'warung2' => $warung2,
                    'warung3' => $warung3,
                    'warung4' => $warung4,
                ]);
            }

            $anggota->map(function ($a, $i) {
                $a->text = $a->nama_pemohon;
            });
            return response()->json(['results' => $anggota]);
        }

        return view("anggota.index", compact('Listanggota'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

//        query anggota sum
        $terlaris = PengirimanBody::select(DB::raw('sum(qty) as kuantitas,id_produk,sum(total_amount) as total,nama_produk'))
            ->leftJoin('daftar_produks', 'daftar_produks.id', '=', 'pengiriman_bodies.id_produk')
//            ->whereYear('pengiriman_bodies.created_at', date('Y'))
            ->groupBy('id_produk')
            ->orderBy('kuantitas', 'DESC')
            ->limit(5);
        $anggota_sum = Anggota::select(DB::raw("count(*) as total"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('total');
//        ddd($anggota_sum);

        $status_anggota = DB::select(DB::raw("select count(*) as total,status_keanggotaan from anggotas
                            left join status_keanggotaan on anggotas.id_status_keanggotaan = status_keanggotaan.id
                            group by id_status_keanggotaan"));

        $chartstatus ="";
        foreach ($status_anggota as $key => $value) {
            $chartstatus.="['".$value->status_keanggotaan."',".$value->total."],";
        }
        $arr['chartstatus'] = rtrim($chartstatus,',');


//        query produk sum
        $produk = DB::select(DB::raw("select
  sum(qty) as kuantitas,
  id_produk,nama_produk
from
  `pengiriman_bodies`
  left join `daftar_produks` on `daftar_produks`.`id` = `pengiriman_bodies`.`id_produk`
group by
  `id_produk`
order by
  `kuantitas` desc
limit
  5"));

        $chartproduk ="";
        foreach ($produk as $key => $value) {
            $chartproduk.="['".$value->nama_produk."',".$value->kuantitas."],";
        }
        $arrProduk['chartproduk'] = rtrim($chartproduk,',');

//        pembelian dan penjualan
        $penjualan = Pengiriman::select(DB::raw("SUM(total) as count"))
            ->whereYear('created_at', date('Y'))
            ->orderBy("created_at")
            ->groupBy(DB::raw("month(created_at)"))
            ->get()->toArray();
        $penjualan = array_column($penjualan, 'count');

//        $penjualan = array_column($penjualan, 'count');
        $pembelian = PembelianPembayaran::select(DB::raw("SUM(jumlah_tagihan) as count"))
            ->whereYear('created_at', date('Y'))
            ->orderBy("created_at")
            ->groupBy(DB::raw("month(created_at)"))
            ->get()->toArray();
        $pembelian = array_column($pembelian, 'count');


//        $pembelian = array_column($pembelian, 'count');

//        rekening simpanan
        $simpanan = LedgerEntry::select(DB::raw("sum(current_balance) as jumlah"))
            ->where('ledgerable_type', '=', 'App\Models\RekeningSimpanan')
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('jumlah');

        $bulan = LedgerEntry::select(DB::raw("MONTHNAME(created_at) as bulan"))
            ->groupBy(DB::raw("MONTHNAME(created_at)"))
            ->pluck('bulan');
//        berjangka
        $berjangka = LedgerEntry::select(DB::raw("sum(current_balance) as jumlah"))
            ->where('ledgerable_type', '=', 'App\Models\RekeningSimpananBerjangka')
            ->whereMonth('created_at', '=', date('m'))
            ->orderBy("created_at")
            ->groupBy(DB::raw("Month(created_at)"))
            ->get()->toArray();
        $berjangka = array_column($berjangka, 'jumlah');
////        pembiayaan
        $pembiayaan = LedgerEntry::select(DB::raw("sum(current_balance) as jumlah"))
            ->where('ledgerable_type', '=', 'App\Models\RekeningPembiayaan')
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('jumlah');

        $pendidikan = KodePendidikan::pluck('pendidikan', 'id');
        $bidangusaha = KodeBidangUsaha::pluck('bidang_usaha', 'id');
        $keluarga = KodeStatusKeluarga::pluck('status_dalam_keluarga', 'id');
        $status = StatusKeanggotaan::pluck('status_keanggotaan', 'id');
        $auto = PenomoranAuto::where('keterangan','=','anggota')->first();
        $count = Anggota::count() + 1;
        return view("anggota.form",$arr, compact( 'terlaris','status_anggota','pendidikan', 'bidangusaha', 'keluarga','status','auto','count','chartproduk','chartstatus','anggota_sum','penjualan','pembelian','bulan','simpanan','pembiayaan'))
            ->with('berjangka',json_encode($berjangka,JSON_NUMERIC_CHECK))
            ->with('penjualan',json_encode($penjualan,JSON_NUMERIC_CHECK))
            ->with('pembelian',json_encode($pembelian,JSON_NUMERIC_CHECK));
        ;;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $count = Anggota::where('nik',$request->nik)
            ->count();
        if($count > 0){
            return redirect()->route('anggota.index')->with('error', 'NIK sudah terdaftar');
        }else{
          
            $auto = PenomoranAuto::where('keterangan','=','anggota')->first();
            $count = Anggota::count() + 1;
            if (!empty($auto->format_depan)) {
                $format_depan =date($auto->format_depan);
            } else {
                $format_depan = '';
            }
            if (!empty($auto->format_tengah)) {
                $format_tengah = date($auto->format_tengah);
            } else {
                $format_tengah = '';
            }
            if (!empty($auto->format_belakang)) {
                $format_belakang = date($auto->format_belakang);
            } else {
                $format_belakang = '';
            }
            $no = $auto->head.$auto->kode_perusahaan.$auto->kode_cabang.$request->id_status_keanggotaan.$format_depan.$format_tengah.$format_belakang.sprintf("%05s", $count);
            $text = str_replace(' ', '', $no);
            $request->merge([
                'no_mitra' => $text,
                'status_aktif' => '',
            ]);
            $anggota = Anggota::create($request->all());
            User::create([
                'name' => $request->nama_pemohon,
                'email' => $request->email,
                'password' =>Hash::make(Str::random(8)),
                'anggota_id' => $anggota->id,
            ]);

            $file = $request->file('file_ktp');
            if (!empty($file)) {
                $file->storeAs('ktp/' . $anggota->id, '' . $file->getClientOriginalName(), 'public');
            }

            $file_serfie = $request->file('file_serfie');
            if (!empty($file_serfie)) {
                $file_serfie->storeAs('selfi/' . $anggota->id, '' . $file_serfie->getClientOriginalName(), 'public');
            }

        
            return \redirect()
                ->route("anggota.index")
                ->with("message", "Pengajuan Anggota Berhasil");

            }

}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //

//        query anggota sum
        $terlaris = PengirimanBody::select(DB::raw('sum(qty) as kuantitas,id_produk,sum(total_amount) as total,nama_produk'))
            ->leftJoin('daftar_produks', 'daftar_produks.id', '=', 'pengiriman_bodies.id_produk')
//            ->whereYear('pengiriman_bodies.created_at', date('Y'))
            ->groupBy('id_produk')
            ->orderBy('kuantitas', 'DESC')
            ->limit(5);
        $anggota_sum = Anggota::select(DB::raw("count(*) as total"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('total');
//        ddd($anggota_sum);

        $status_anggota = DB::select(DB::raw("select count(*) as total,status_keanggotaan from anggotas
                            left join status_keanggotaan on anggotas.id_status_keanggotaan = status_keanggotaan.id
                            group by id_status_keanggotaan"));

        $chartstatus ="";
        foreach ($status_anggota as $key => $value) {
            $chartstatus.="['".$value->status_keanggotaan."',".$value->total."],";
        }
        $arr['chartstatus'] = rtrim($chartstatus,',');


//        query produk sum
        $produk = DB::select(DB::raw("select
  sum(qty) as kuantitas,
  id_produk,nama_produk
from
  `pengiriman_bodies`
  left join `daftar_produks` on `daftar_produks`.`id` = `pengiriman_bodies`.`id_produk`
group by
  `id_produk`
order by
  `kuantitas` desc
limit
  5"));

        $chartproduk ="";
        foreach ($produk as $key => $value) {
            $chartproduk.="['".$value->nama_produk."',".$value->kuantitas."],";
        }
        $arrProduk['chartproduk'] = rtrim($chartproduk,',');

//        pembelian dan penjualan
        $penjualan = Pengiriman::select(DB::raw("SUM(total) as count"))
            ->whereYear('created_at', date('Y'))
            ->orderBy("created_at")
            ->groupBy(DB::raw("month(created_at)"))
            ->get()->toArray();
        $penjualan = array_column($penjualan, 'count');

//        $penjualan = array_column($penjualan, 'count');
        $pembelian = PembelianPembayaran::select(DB::raw("SUM(jumlah_tagihan) as count"))
            ->whereYear('created_at', date('Y'))
            ->orderBy("created_at")
            ->groupBy(DB::raw("month(created_at)"))
            ->get()->toArray();
        $pembelian = array_column($pembelian, 'count');


//        $pembelian = array_column($pembelian, 'count');

//        rekening simpanan
        $simpanan = LedgerEntry::select(DB::raw("sum(current_balance) as jumlah"))
            ->where('ledgerable_type', '=', 'App\Models\RekeningSimpanan')
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('jumlah');

        $bulan = LedgerEntry::select(DB::raw("MONTHNAME(created_at) as bulan"))
            ->groupBy(DB::raw("MONTHNAME(created_at)"))
            ->pluck('bulan');
//        berjangka
        $berjangka = LedgerEntry::select(DB::raw("sum(current_balance) as jumlah"))
            ->where('ledgerable_type', '=', 'App\Models\RekeningSimpananBerjangka')
            ->whereMonth('created_at', '=', date('m'))
            ->orderBy("created_at")
            ->groupBy(DB::raw("Month(created_at)"))
            ->get()->toArray();
        $berjangka = array_column($berjangka, 'jumlah');
////        pembiayaan
        $pembiayaan = LedgerEntry::select(DB::raw("sum(current_balance) as jumlah"))
            ->where('ledgerable_type', '=', 'App\Models\RekeningPembiayaan')
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('jumlah');
        $file_ktp = Storage::disk('public')->files('ktp/'.$id);
        $file_foto = Storage::disk('public')->files('selfi/'.$id);
        $dataanggota = Anggota::where('id',$id)->first();
        $pendidikan = KodePendidikan::pluck('pendidikan', 'id');
        $bidangusaha = KodeBidangUsaha::pluck('bidang_usaha', 'id');
        $keluarga = KodeStatusKeluarga::pluck('status_dalam_keluarga', 'id');
        $status = StatusKeanggotaan::pluck('status_keanggotaan', 'id');
        $perusahan = KodePerusahaan::first();

        if ($request->query('export') == 'pdf') {
            $logo = '';
            if (\is_file( 'storage/perusahaan/1/logo_perusahaan' )) {
                $logo = 'data:image/png;base64,' . base64_encode(file_get_contents( 'storage/perusahaan/1/logo_perusahaan'));
            }

            // $file_foto = '';
            // if (is_file('storage/' . ($file_foto[0] ?? ''))) {
            //     $file_foto = 'data:image/png;base64,' . base64_encode(file_get_contents('storage/' . ($file_foto[0] ?? '')));
            // }

            // $file_ktp = '';
            // if (is_file('storage/' . ($file_ktp[0] ?? ''))) {
            //     $file_ktp = 'data:image/png;base64,' . base64_encode(file_get_contents('storage/' . ($file_ktp[0] ?? '')));
            // }



            $pdf = PDF::loadView('anggota.show', ['dataanggota' => $dataanggota, 'file_foto' => $file_foto,'file_ktp' => $file_ktp,'logo'=> $logo, 'perusahan' => $perusahan]);
            return $pdf->stream('anggota.pdf', ['Attachment' => false]);
        }
        // return view("anggota.show", \compact("dataanggota","file_foto","file_ktp"));
        $dataanggota = Anggota::where('id', $id)->with('status_keanggotaans')->first();
        return view("anggota.showup",$arr, \compact('terlaris',"dataanggota",'pendidikan', 'bidangusaha', 'keluarga','status', 'file_ktp', 'file_foto','anggota_sum','status_anggota','chartproduk','penjualan','pembelian','simpanan','bulan','pembiayaan'))
            ->with('berjangka',json_encode($berjangka,JSON_NUMERIC_CHECK))
            ->with('penjualan',json_encode($penjualan,JSON_NUMERIC_CHECK))
            ->with('pembelian',json_encode($pembelian,JSON_NUMERIC_CHECK));

;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Anggota $anggota, $id)
    {

//        query anggota sum
        $terlaris = PengirimanBody::select(DB::raw('sum(qty) as kuantitas,id_produk,sum(total_amount) as total,nama_produk'))
            ->leftJoin('daftar_produks', 'daftar_produks.id', '=', 'pengiriman_bodies.id_produk')
//            ->whereYear('pengiriman_bodies.created_at', date('Y'))
            ->groupBy('id_produk')
            ->orderBy('kuantitas', 'DESC')
            ->limit(5);
        $anggota_sum = Anggota::select(DB::raw("count(*) as total"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('total');
//        ddd($anggota_sum);

        $status_anggota = DB::select(DB::raw("select count(*) as total,status_keanggotaan from anggotas
                            left join status_keanggotaan on anggotas.id_status_keanggotaan = status_keanggotaan.id
                            group by id_status_keanggotaan"));

        $chartstatus ="";
        foreach ($status_anggota as $key => $value) {
            $chartstatus.="['".$value->status_keanggotaan."',".$value->total."],";
        }
        $arr['chartstatus'] = rtrim($chartstatus,',');


//        query produk sum
        $produk = DB::select(DB::raw("select
  sum(qty) as kuantitas,
  id_produk,nama_produk
from
  `pengiriman_bodies`
  left join `daftar_produks` on `daftar_produks`.`id` = `pengiriman_bodies`.`id_produk`
group by
  `id_produk`
order by
  `kuantitas` desc
limit
  5"));

        $chartproduk ="";
        foreach ($produk as $key => $value) {
            $chartproduk.="['".$value->nama_produk."',".$value->kuantitas."],";
        }
        $arrProduk['chartproduk'] = rtrim($chartproduk,',');

//        pembelian dan penjualan
        $penjualan = Pengiriman::select(DB::raw("SUM(total) as count"))
            ->whereYear('created_at', date('Y'))
            ->orderBy("created_at")
            ->groupBy(DB::raw("month(created_at)"))
            ->get()->toArray();
        $penjualan = array_column($penjualan, 'count');

//        $penjualan = array_column($penjualan, 'count');
        $pembelian = PembelianPembayaran::select(DB::raw("SUM(jumlah_tagihan) as count"))
            ->whereYear('created_at', date('Y'))
            ->orderBy("created_at")
            ->groupBy(DB::raw("month(created_at)"))
            ->get()->toArray();
        $pembelian = array_column($pembelian, 'count');


//        $pembelian = array_column($pembelian, 'count');

//        rekening simpanan
        $simpanan = LedgerEntry::select(DB::raw("sum(current_balance) as jumlah"))
            ->where('ledgerable_type', '=', 'App\Models\RekeningSimpanan')
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('jumlah');

        $bulan = LedgerEntry::select(DB::raw("MONTHNAME(created_at) as bulan"))
            ->groupBy(DB::raw("MONTHNAME(created_at)"))
            ->pluck('bulan');
//        berjangka
        $berjangka = LedgerEntry::select(DB::raw("sum(current_balance) as jumlah"))
            ->where('ledgerable_type', '=', 'App\Models\RekeningSimpananBerjangka')
            ->whereMonth('created_at', '=', date('m'))
            ->orderBy("created_at")
            ->groupBy(DB::raw("Month(created_at)"))
            ->get()->toArray();
        $berjangka = array_column($berjangka, 'jumlah');
////        pembiayaan
        $pembiayaan = LedgerEntry::select(DB::raw("sum(current_balance) as jumlah"))
            ->where('ledgerable_type', '=', 'App\Models\RekeningPembiayaan')
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('jumlah');

        $pendidikan = KodePendidikan::pluck('pendidikan', 'id');
        $bidangusaha = KodeBidangUsaha::pluck('bidang_usaha', 'id');

        $keluarga = KodeStatusKeluarga::pluck('status_dalam_keluarga', 'id');
        $status = StatusKeanggotaan::pluck('status_keanggotaan', 'id');
        $dataanggota = Anggota::where('id', $id)->first();
        // dd($dataanggota->id_status_keanggotaan);
        $file_ktp = Storage::disk('public')->files('ktp/'.$id);
        $file_foto = Storage::disk('public')->files('selfi/'.$id);
        return view("anggota.edit",$arr, \compact('terlaris',"dataanggota", 'pendidikan', 'bidangusaha', 'keluarga','status', 'file_foto', 'file_ktp','anggota_sum','status_anggota','chartproduk','penjualan','pembelian','simpanan','pembiayaan','bulan'))
            ->with('berjangka',json_encode($berjangka,JSON_NUMERIC_CHECK))
            ->with('penjualan',json_encode($penjualan,JSON_NUMERIC_CHECK))
            ->with('pembelian',json_encode($pembelian,JSON_NUMERIC_CHECK));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update_approve(Request $request, $id)
    {
        $anggota = Anggota::find($id);
        if ($request->status_aktif == '1')
        {
            $anggota->status_aktif = '1';
            $anggota->save();
            return redirect()->route('anggota.index')->with('message', 'Anggota berhasil Disetujui');
        }else{
            $anggota->status_aktif = '0';
            $anggota->save();
            return redirect()->route('anggota.index')->with('error', 'Anggota Ditolak');

        }
    }
    public function update_berhenti(Request $request, $id)
    {
        $anggota = Anggota::find($id);
        if ($request->status_aktif == '2')
        {
            $anggota->status_aktif = '2';
            $anggota->save();
            return redirect()->route('anggota.index')->with('message', 'Anggota berhasil Diberhentikan');
        }
    }

    public function update(Request $request, $id)
    {
        $anggota = Anggota::find($id);

        $auto = PenomoranAuto::where('keterangan','=','anggota')->first();
        $count = Anggota::count() + 1;
        if (!empty($auto->format_depan)) {
            $format_depan =date($auto->format_depan);
        } else {
            $format_depan = '';
        }
        if (!empty($auto->format_tengah)) {
            $format_tengah = date($auto->format_tengah);
        } else {
            $format_tengah = '';
        }
        if (!empty($auto->format_belakang)) {
            $format_belakang = date($auto->format_belakang);
        } else {
            $format_belakang = '';
        }
        $no = $auto->head.$auto->kode_perusahaan.$auto->kode_cabang.$request->id_status_keanggotaan.$format_depan.$format_tengah.$format_belakang.sprintf("%05s", $anggota->id);


        $request->merge([
            'no_mitra' => $no
        ]);
        $anggota->fill($request->all());
        $anggota->save();
        $file = $request->file('file_ktp');

        if(empty($request->exists_file_serfie))
        {
            Storage::disk('public')->deleteDirectory('selfi/' . $anggota->id);
        }

        if(empty($request->exists_file_ktp))
        {
            Storage::disk('public')->deleteDirectory('ktp/' . $anggota->id);
        }

        if (!empty($file)) {
            Storage::disk('public')->deleteDirectory('ktp/' . $anggota->id);
            $file->storeAs('ktp/' . $anggota->id, '' . $file->getClientOriginalName(), 'public');
        }

        $file_serfie = $request->file('file_serfie');
        if (!empty($file_serfie)) {
            Storage::disk('public')->deleteDirectory('selfi/' . $anggota->id);
            $file_serfie->storeAs('selfi/' . $anggota->id, '' . $file_serfie->getClientOriginalName(), 'public');
        }

        return redirect()
            ->route("anggota.index")
            ->with("message",("Perbarui Anggota Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anggota $anggota)
    {
        //
    }
    public function cetak($id)
    {
        $anggota = Anggota::find($id);
        return view('anggota.cetak', compact('anggota'));

    }
    public function berhenti($id)
    {
        $terlaris = PengirimanBody::select(DB::raw('sum(qty) as kuantitas,id_produk,sum(total_amount) as total,nama_produk'))
            ->leftJoin('daftar_produks', 'daftar_produks.id', '=', 'pengiriman_bodies.id_produk')
//            ->whereYear('pengiriman_bodies.created_at', date('Y'))
            ->groupBy('id_produk')
            ->orderBy('kuantitas', 'DESC')
            ->limit(5);
        $anggota_sum = Anggota::select(DB::raw("count(*) as total"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('total');
//        ddd($anggota_sum);

        $status_anggota = DB::select(DB::raw("select count(*) as total,status_keanggotaan from anggotas
                            left join status_keanggotaan on anggotas.id_status_keanggotaan = status_keanggotaan.id
                            group by id_status_keanggotaan"));

        $chartstatus ="";
        foreach ($status_anggota as $key => $value) {
            $chartstatus.="['".$value->status_keanggotaan."',".$value->total."],";
        }
        $arr['chartstatus'] = rtrim($chartstatus,',');


//        query produk sum
        $produk = DB::select(DB::raw("select
  sum(qty) as kuantitas,
  id_produk,nama_produk
from
  `pengiriman_bodies`
  left join `daftar_produks` on `daftar_produks`.`id` = `pengiriman_bodies`.`id_produk`
group by
  `id_produk`
order by
  `kuantitas` desc
limit
  5"));

        $chartproduk ="";
        foreach ($produk as $key => $value) {
            $chartproduk.="['".$value->nama_produk."',".$value->kuantitas."],";
        }
        $arrProduk['chartproduk'] = rtrim($chartproduk,',');

//        pembelian dan penjualan
        $penjualan = Pengiriman::select(DB::raw("SUM(total) as count"))
            ->whereYear('created_at', date('Y'))
            ->orderBy("created_at")
            ->groupBy(DB::raw("month(created_at)"))
            ->get()->toArray();
        $penjualan = array_column($penjualan, 'count');

//        $penjualan = array_column($penjualan, 'count');
        $pembelian = PembelianPembayaran::select(DB::raw("SUM(jumlah_tagihan) as count"))
            ->whereYear('created_at', date('Y'))
            ->orderBy("created_at")
            ->groupBy(DB::raw("month(created_at)"))
            ->get()->toArray();
        $pembelian = array_column($pembelian, 'count');


//        $pembelian = array_column($pembelian, 'count');

//        rekening simpanan
        $simpanan = LedgerEntry::select(DB::raw("sum(current_balance) as jumlah"))
            ->where('ledgerable_type', '=', 'App\Models\RekeningSimpanan')
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('jumlah');

        $bulan = LedgerEntry::select(DB::raw("MONTHNAME(created_at) as bulan"))
            ->groupBy(DB::raw("MONTHNAME(created_at)"))
            ->pluck('bulan');
//        berjangka
        $berjangka = LedgerEntry::select(DB::raw("sum(current_balance) as jumlah"))
            ->where('ledgerable_type', '=', 'App\Models\RekeningSimpananBerjangka')
            ->whereMonth('created_at', '=', date('m'))
            ->orderBy("created_at")
            ->groupBy(DB::raw("Month(created_at)"))
            ->get()->toArray();
        $berjangka = array_column($berjangka, 'jumlah');
////        pembiayaan
        $pembiayaan = LedgerEntry::select(DB::raw("sum(current_balance) as jumlah"))
            ->where('ledgerable_type', '=', 'App\Models\RekeningPembiayaan')
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('jumlah');
        $file_ktp = Storage::disk('public')->files('ktp/'.$id);
        $file_foto = Storage::disk('public')->files('selfi/'.$id);
        $dataanggota = Anggota::where('id',$id)->first();
        $pendidikan = KodePendidikan::pluck('pendidikan', 'id');
        $bidangusaha = KodeBidangUsaha::pluck('bidang_usaha', 'id');
        $keluarga = KodeStatusKeluarga::pluck('status_dalam_keluarga', 'id');
        $status = StatusKeanggotaan::pluck('status_keanggotaan', 'id');
        $perusahan = KodePerusahaan::first();

        // return view("anggota.show", \compact("dataanggota","file_foto","file_ktp"));
        $dataanggota = Anggota::where('id', $id)->with('status_keanggotaans')->first();
        return view("anggota.berhenti",$arr, \compact('terlaris',"dataanggota",'pendidikan', 'bidangusaha', 'keluarga','status', 'file_ktp', 'file_foto','anggota_sum','status_anggota','chartproduk','penjualan','pembelian','simpanan','bulan','pembiayaan'))
            ->with('berjangka',json_encode($berjangka,JSON_NUMERIC_CHECK))
            ->with('penjualan',json_encode($penjualan,JSON_NUMERIC_CHECK))
            ->with('pembelian',json_encode($pembelian,JSON_NUMERIC_CHECK));

    }
    public function approve($id,Request $request)
    {
        $terlaris = PengirimanBody::select(DB::raw('sum(qty) as kuantitas,id_produk,sum(total_amount) as total,nama_produk'))
            ->leftJoin('daftar_produks', 'daftar_produks.id', '=', 'pengiriman_bodies.id_produk')
//            ->whereYear('pengiriman_bodies.created_at', date('Y'))
            ->groupBy('id_produk')
            ->orderBy('kuantitas', 'DESC')
            ->limit(5);
        $anggota_sum = Anggota::select(DB::raw("count(*) as total"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('total');
//        ddd($anggota_sum);

        $status_anggota = DB::select(DB::raw("select count(*) as total,status_keanggotaan from anggotas
                            left join status_keanggotaan on anggotas.id_status_keanggotaan = status_keanggotaan.id
                            group by id_status_keanggotaan"));

        $chartstatus ="";
        foreach ($status_anggota as $key => $value) {
            $chartstatus.="['".$value->status_keanggotaan."',".$value->total."],";
        }
        $arr['chartstatus'] = rtrim($chartstatus,',');


//        query produk sum
        $produk = DB::select(DB::raw("select
  sum(qty) as kuantitas,
  id_produk,nama_produk
from
  `pengiriman_bodies`
  left join `daftar_produks` on `daftar_produks`.`id` = `pengiriman_bodies`.`id_produk`
group by
  `id_produk`
order by
  `kuantitas` desc
limit
  5"));

        $chartproduk ="";
        foreach ($produk as $key => $value) {
            $chartproduk.="['".$value->nama_produk."',".$value->kuantitas."],";
        }
        $arrProduk['chartproduk'] = rtrim($chartproduk,',');

//        pembelian dan penjualan
        $penjualan = Pengiriman::select(DB::raw("SUM(total) as count"))
            ->whereYear('created_at', date('Y'))
            ->orderBy("created_at")
            ->groupBy(DB::raw("month(created_at)"))
            ->get()->toArray();
        $penjualan = array_column($penjualan, 'count');

//        $penjualan = array_column($penjualan, 'count');
        $pembelian = PembelianPembayaran::select(DB::raw("SUM(jumlah_tagihan) as count"))
            ->whereYear('created_at', date('Y'))
            ->orderBy("created_at")
            ->groupBy(DB::raw("month(created_at)"))
            ->get()->toArray();
        $pembelian = array_column($pembelian, 'count');


//        $pembelian = array_column($pembelian, 'count');

//        rekening simpanan
        $simpanan = LedgerEntry::select(DB::raw("sum(current_balance) as jumlah"))
            ->where('ledgerable_type', '=', 'App\Models\RekeningSimpanan')
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('jumlah');

        $bulan = LedgerEntry::select(DB::raw("MONTHNAME(created_at) as bulan"))
            ->groupBy(DB::raw("MONTHNAME(created_at)"))
            ->pluck('bulan');
//        berjangka
        $berjangka = LedgerEntry::select(DB::raw("sum(current_balance) as jumlah"))
            ->where('ledgerable_type', '=', 'App\Models\RekeningSimpananBerjangka')
            ->whereMonth('created_at', '=', date('m'))
            ->orderBy("created_at")
            ->groupBy(DB::raw("Month(created_at)"))
            ->get()->toArray();
        $berjangka = array_column($berjangka, 'jumlah');
////        pembiayaan
        $pembiayaan = LedgerEntry::select(DB::raw("sum(current_balance) as jumlah"))
            ->where('ledgerable_type', '=', 'App\Models\RekeningPembiayaan')
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('jumlah');
        $file_ktp = Storage::disk('public')->files('ktp/'.$id);
        $file_foto = Storage::disk('public')->files('selfi/'.$id);
        $dataanggota = Anggota::where('id',$id)->first();
        $pendidikan = KodePendidikan::pluck('pendidikan', 'id');
        $bidangusaha = KodeBidangUsaha::pluck('bidang_usaha', 'id');
        $keluarga = KodeStatusKeluarga::pluck('status_dalam_keluarga', 'id');
        $status = StatusKeanggotaan::pluck('status_keanggotaan', 'id');
        $perusahan = KodePerusahaan::first();

        // return view("anggota.show", \compact("dataanggota","file_foto","file_ktp"));
        $dataanggota = Anggota::where('id', $id)->with('status_keanggotaans')->first();
        return view("anggota.approve",$arr, \compact('terlaris',"dataanggota",'pendidikan', 'bidangusaha', 'keluarga','status', 'file_ktp', 'file_foto','anggota_sum','status_anggota','chartproduk','penjualan','pembelian','simpanan','bulan','pembiayaan'))
            ->with('berjangka',json_encode($berjangka,JSON_NUMERIC_CHECK))
            ->with('penjualan',json_encode($penjualan,JSON_NUMERIC_CHECK))
            ->with('pembelian',json_encode($pembelian,JSON_NUMERIC_CHECK));


    }

     public function showPdf(Anggota $anggota, Request $request, $id)
    {
        $anggotas = Anggota::where('id', '=', $id)
            ->first();

        if ($request->query('export') == 'show') {

            $pdf = PDF::loadView('admin.anggota.show', ['data' => $anggotas, $id], [], []);
            return $pdf->stream('Laporan Rekening Anggota.pdf');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function anggota_pdf(Request $request)
    {
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];

        $pdf = PDF::loadView('myPDF', $data);
        return $pdf->download('itsolutionstuff.pdf');
    }

    public function destroyKtp(Anggota $anggota)
    {
        Storage::disk('public')->deleteDirectory('ktp/' . $anggota->id);

        return response()->json(['success' => 'true']);
    }

    public function destroyFoto(Anggota $anggota)
    {
        Storage::disk('public')->deleteDirectory('selfi/' . $anggota->id);

        return response()->json(['success' => 'true']);
    }
}
