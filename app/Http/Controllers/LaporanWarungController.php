<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\DaftarWarung;
use Illuminate\Http\Request;
use App\Models\KodePerusahaan;
use App\Exports\LaporanWarungExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class LaporanWarungController extends Controller
{
    public function index(Request $request)
    {

        $warung = false;
        $kodeKategori = false;
        
        // $warung = DaftarWarung::where('status_aktif', '=', 1)->get();
        // dd($warung);
        $kategori_warung = DaftarWarung::groupBy('status_aktif')->get();
        // dd($kategoriAnggota);
        if (!empty($request->status_aktif)){
            $warung = DaftarWarung::where('status_aktif', '=', $request->status_aktif)->get();
        }else{
            $warung = DaftarWarung::paginate(10);

        }

        $daftar_warungs = DaftarWarung::filter(request()->all())
            ->when(\in_array(Route::currentRouteName(), ['pages.daftar_warung.index', 'pages.daftar_warung.search']), function ($query) {
                $query->where('status_aktif', 1);
            })
            ->with('anggota.pembiayaan','status_keanggotaans')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        $daftar_warungs->map(function ($warung) {
            $warung->photo = collect(Storage::disk('public')->files('warung/' . $warung->id))->first();
        });

        $daftar_warung = DaftarWarung::all();
        $usaha  = KodePerusahaan::all();

        if ($request->query('export') == 'pdf') {
            $logo = '';
            if (\is_file( 'storage/perusahaan/1/logo_perusahaan' )) {
                $logo = 'data:image/png;base64,' . base64_encode(file_get_contents( 'storage/perusahaan/1/logo_perusahaan'));
            }

            $pdf = PDF::loadView('semua_laporan.detail_warung.cetak', ['logo' => $logo, 'daftar_warung' => $daftar_warung,'usaha' =>$usaha,],
            [],[
                'format' => 'A4-P',
                'title' => 'Laporan Detail Warung',
            ]);

            return $pdf->stream('Laporan Detail Warung.pdf', ['Attachment' => false]);
        }

        return view("semua_laporan.detail_warung.index",compact('daftar_warungs', 'kategori_warung'));
    }

    public function export()
	{
        $daftar_warung = DaftarWarung::all();
        // dd($anggotas[0]->no_mitra);
		return Excel::download(new LaporanWarungExport($daftar_warung), 'Laporan Warung.xlsx');
	}
}
