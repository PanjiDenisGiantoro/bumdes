<?php

namespace App\Exports;

use App\Models\Anggota;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class LaporanKeangotaanExport implements FromView, ShouldAutoSize
{
    public function __construct($anggotas)
    {
        $this->anggotas = $anggotas;
    }

    public function view(): View
    {
        // $batch = SummaryBatch::where('id', $id)
        //     ->with('pendana', 'produk_simpanan', 'coa_pembiayaan', 'pengajuan_pendanaan')
        //     ->first();
        return view('semua_laporan.detail_keanggotaan.index_xls', [
            'anggotas' => $this->anggotas
        ]);
    }
}
