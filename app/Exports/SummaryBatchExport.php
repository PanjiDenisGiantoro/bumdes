<?php

namespace App\Exports;

use App\Models\SummaryBatch;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SummaryBatchExport implements FromView, ShouldAutoSize
{
    public function __construct($sumary)
    {
        $this->sumary = $sumary;
    }

    public function view(): View
    {
        // $batch = SummaryBatch::where('id', $id)
        //     ->with('pendana', 'produk_simpanan', 'coa_pembiayaan', 'pengajuan_pendanaan')
        //     ->first();
        return view('summary_batch.index_xlsx', [
            'sumary' => $this->sumary
        ]);
    }
}
