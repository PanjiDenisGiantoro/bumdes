<?php

namespace App\Exports;

use App\Models\DaftarWarung;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

// class LaporanWarungExport implements FromCollection
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//         return DaftarWarung::all();
//     }
// }

class LaporanWarungExport implements FromView, ShouldAutoSize
{
    public function __construct($daftar_warung)
    {
        $this->daftar_warung = $daftar_warung;
    }

    public function view(): View
    {
        // $batch = SummaryBatch::where('id', $id)
        //     ->with('pendana', 'produk_simpanan', 'coa_pembiayaan', 'pengajuan_pendanaan')
        //     ->first();
        return view('semua_laporan.detail_warung.index_xlsx', [
            'daftar_warung' => $this->daftar_warung
        ]);
    }
}

