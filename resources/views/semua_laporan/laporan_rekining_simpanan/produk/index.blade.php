@extends('layouts.app')

@section('breadcrumb')
<x-breadcrumb title="{{ __('Detail Keanggotaan') }}">
    <li class="breadcrumb-item">
        <a href="{{ route('semua_laporan.index') }}">{{ __('Laporan') }}</a>
    </li>
    <li class="breadcrumb-item">
        {{ __('Detail Keanggotaan') }}
    </li>
</x-breadcrumb>
@endsection

@section('content')

<div class="container">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="components-preview wide-md mx-auto">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-head-sub">
                        <span>Laporan Simpanan</span>
                    </div>
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Rekening Simpanan</h3>
                        </div>
                        <!-- <div class="nk-block-head-content">
                            <input class="class form-control" type="text" name="daterange" value="01/01/2021 - 01/15/2021" />
                        </div> -->
                    </div>
                </div>
                <form>
                    <div class="card card-preview">

                        <input type="hidden" id="selectedProdukIDValue" name="produkId" value="{{ request()->query('produkId') }}">

                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-tools">
                                    <div class="row p-3">
                                            <div class="col-md-4">
                                                 <select name="month" class="form-select form-select-sm form-control" data-search="off" data-placeholder="Pilih Tanggal" tabindex="-1">
                                                    <option value="">Pilih Tanggal</option>
                                                    <option value="13">Hari ini</option>
                                                    @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}" {{ request()->query('month') == $i ? ' selected="selected"' : null }}>
                                                        {{ \Carbon\Carbon::create()->day(1)->month($i)->locale('id')->monthName }}
                                                    </option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <div class="col-sm-6">
                                                <select id="selectedSimpanan" class="form-select form-select-sm form-control" data-search="on" data-placeholder="Pilih Simpanan" data-select2-id="1" tabindex="-1">
                                                    <option value="">Pilih Simpanan</option>
                                                    {{-- <option value="" data-select2-id="1"></option> --}}
                                                        @foreach($senaraiSimpanan as $simpanan)
                                                            <option value="{{ $simpanan->id }}"{{ request()->query('produkId') == $simpanan->id ? ' selected="selected"' : '' }}>{{ $simpanan->nama_simpanan }}</option>
                                                        @endforeach
                                                            <option value="999" {{ request()->query('produkId') == '999' ? ' selected="selected"' : '' }}>Semua Simpanan</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <button id="searchNama_btn" class="btn btn-info">Cari</button>
                                            </div>
                                            {{-- @if (request()->query('produkId') && request()->query('produkId') != '999')
                                            <div class="btn-group">
                                                <a href="{{ route('laporan.simpanan.produk', [ 'produkId' => $produkId, 'datefilter' => request()->query('datefilter'), 'export' => 'pdf']) }}" class="btn btn-icon btn-outline-primary" target="_blank">
                                                    <em class="icon ni ni-printer"></em>
                                                </a>
                                                <a href="{{ route('laporan.simpanan.produk', [ 'produkId' => $produkId, 'datefilter' => request()->query('datefilter'), 'export' => 'xlsx']) }}" class="btn btn-icon btn-outline-primary" target="_blank">
                                                    <em class="icon ni ni-file-xls"></em>
                                                </a>
                                            </div>
                                            @endif --}}
                                            {{-- <div class="btn-group printReport">
                                                <a href="{{ route('laporan.simpanan.dataRekAnggota', ['simpananId' => $simpananId, 'export' => 'pdf', 'datefilter' => request()->query('datefilter')]) }}" class="btn btn-icon btn-outline-primary" target="_blank">
                                                    <em class="icon ni ni-printer"></em>
                                                </a>
                                                <a href="{{ route('laporan.simpanan.dataRekAnggota', ['simpananId' => $simpananId, 'export' => 'xlsx', 'datefilter' => request()->query('datefilter')]) }}" class="btn btn-icon btn-outline-primary" target="_blank">
                                                    <em class="icon ni ni-file-xls"></em>
                                                </a>
                                            </div> --}}
                                        </div>
                                    </div>
                            </div>
                        </div>

                       @php 
                            $calSaldo = 0;

                            foreach($simpananAnggota as $id => $data) {
                                $calSaldo += $data->lastEntry->current_balance ?? (!empty($data->entry->saldo->current_balance) ? (float)str_replace(',', '', $data->entry->saldo->current_balance) : 0);
                            }
                        @endphp
                       @if ($produkSimpanan)
                        <div class="card-inner">
                            <div class="container pt-6">
                                <div class="row justify-content-between">
                                    <div class="col-1">
                                    </div>
                                    <div class="col-4">
                                        Kode Produk
                                    </div>
                                    <div class="col-4">
                                        {{ $produkSimpanan->kode_simpanan ?? '-' }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Nama Produk
                                    </div>
                                    <div class="col-4">
                                        {{ $produkSimpanan->nama_simpanan ?? '-' }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Jenis Akad
                                    </div>
                                    <div class="col-4">
                                        {{ $produkSimpanan->kategori_produk ?? '-' }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Jumlah Rekening
                                    </div>
                                    <div class="col-4">
                                        {{ count($simpananAnggota) }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Jumlah Saldo
                                    </div>
                                    <div class="col-4 pb-5">
                                        {{ $calSaldo ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                <div class="card card-preview">
                        <div class="card-inner p-6">
                            <table class="table table-bordered border-top mb-0" data-auto-responsive="false" data-searching="false" data-length-change="false" data-sortable="false">
                                <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                        <th class="nk-tb-col">
                                            <span class="sub-text">#</span>
                                        </th>
                                        <th class="nk-tb-col">
                                            <span class="sub-text">Nama Anggota</span>
                                        </th>
                                        <!-- <th class="nk-tb-col">
                                            <span class="sub-text">No. Anggota</span>
                                        </th> -->
                                        <th class="nk-tb-col">
                                            <span class="sub-text">No. Rekening</span>
                                        </th>
                                        <th class="nk-tb-col">
                                            <span class="sub-text">Tgl. Buka</span>
                                        </th>
                                        <th class="nk-tb-col">
                                            <span class="sub-text text-right">Saldo</span>
                                        </th>
                                        <th class="nk-tb-col">
                                            <span class="sub-text text-right">Saldo Rata-rata</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($simpananAnggota as $index => $data)
                                    <tr>
                                        <td class="nk-tb-col" style="border: 0">
                                            <span class="sub-text">{{ $index+1 }}</span>
                                        </td>
                                        <td class="nk-tb-col pb-1" style="border: 0">
                                            <span class="sub-text">{{ $data->anggota->nama_pemohon ?? '' }}</span>
                                        </td>
                                        <td class="nk-tb-col" style="border: 0">
                                                <span class="sub-text">{{ $data->no_akun ?? '' }}</span>
                                                {{-- <a href="{{ route('admin.simpanan.show', $data->id ?? '' ) }}" target="_blank">{{ $data->no_akun }}</a> --}}
                                            </td>
                                        <td class="nk-tb-col pb-1" style="border: 0">
                                            <span class="sub-text">{{ $data->created_at ? $data->created_at->format('d/m/Y') : '-' }}</span>
                                        </td>
                                        <td class="nk-tb-col" style="border: 0">
                                            <span class="sub-text" style="text-align: right;">{{ !empty($data->lastEntry) ? number_format($data->lastEntry->current_balance, 2) : (!empty($data->entries->current_balance) ? $data->entries->current_balance : '0.00') }}</span>
                                            <!-- <span class="sub-text" style="text-align: right;">{{ !empty($data->lastEntry) ? '': 'ada' }}</span> -->
                                        </td>
                                        <td class="nk-tb-col" style="border: 0">
                                            <span class="sub-text" style="text-align: right;">{{ number_format($data->saldo_rata_rata, 2) }}</span>
                                        </td>
                                    </tr>
                                    {{-- <tr class="hide">
                                        <td></td>
                                        <td colspan="6">
                                            <table style="width: 100%;">
                                                <thead>
                                                    <tr class="nk-tb-item nk-tb-head">
                                                        <th class="nk-tb-col">
                                                            <span class="sub-text">#</span>
                                                        </th>
                                                        <th class="nk-tb-col">
                                                            <span class="sub-text">Tanggal</span>
                                                        </th>
                                                        <th class="nk-tb-col">
                                                            <span class="sub-text">No. Jurnal</span>
                                                        </th>
                                                        <th class="nk-tb-col">
                                                            <span class="sub-text">Keterangan</span>
                                                        </th>
                                                        <th class="nk-tb-col">
                                                            <span class="sub-text">Debet</span>
                                                        </th>
                                                        <th class="nk-tb-col">
                                                            <span class="sub-text">Kredit</span>
                                                        </th>
                                                        <th class="nk-tb-col">
                                                            <span class="sub-text">Saldo Harian</span>
                                                        </th>
                                                        <!-- <th class="nk-tb-col">
                                                            <span class="sub-text"></span>
                                                        </th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $saldo = 0;
                                                    $totalSaldo = [];
                                                    @endphp
                                                    @foreach ($data->entries as $i => $entry)

                                                    @php
                                                    if ($entry->credit) {
                                                        $saldo += $entry->amount;
                                                    } else {
                                                        $saldo -= $entry->amount;
                                                    }

                                                    $totalSaldo[] = $saldo;
                                                    @endphp

                                                    <tr class="nk-tb-item">
                                                        <td class="nk-tb-col">{{ $i + 1}}</td>
                                                        <td class="nk-tb-col">{{ !empty($entry->ledger->tanggal_transaksi) ? $entry->ledger->tanggal_transaksi->format('d/m/Y') : '' }}</td>
                                                        <td class="nk-tb-col">
                                                            <a href="{{ route('admin.keuangan.masukan-jurnal.show', $entry->ledger->id ?? '') }}" target="_blank">{{ $entry->ledger->no_jurnal ?? '' }}</a>
                                                        </td>
                                                        <td class="nk-tb-col">{{ $entry->reason }}</td>
                                                        <td class="nk-tb-col text-right">{{ $entry->debit ? number_format($entry->amount, 2) : '0.00' }}</td>
                                                        <td class="nk-tb-col text-right">{{ $entry->credit ? number_format($entry->amount, 2) : '0.00' }}</td>
                                                        <td class="nk-tb-col text-right">{{ number_format($entry->saldo_harian, 2) }}</td>
                                                        <!-- <td class="nk-tb-col">
                                                            <a href="{{ route('admin.transaksi.show', [$entry->transaction_id, 'export' => 'pdf']) }}" class="btn btn-icon btn-outline-primary" target="_blank">
                                                                <em class="icon ni ni-printer"></em>
                                                            </a>
                                                        </td> -->
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    
                                                </tfoot>
                                            </table>
                                        </td>
                                    </tr> --}}
                                    @endforeach
                                </tbody>
                                {{-- <tfoot>
                                    <tr>
                                        <th colspan="5" style="text-align: right"></th>
                                        <th>
                                            <span class="sub-text" style="text-align: right;">
                                            {{ number_format($calSaldo, 2) }}
                                            <!-- {{ 
                                                number_format(
                                                    $simpananAnggota
                                                    ->pluck('saldo')
                                                    ->reduce(function ($carry, $item) {

                                                        if ($item < 0) {
                                                            $temp = str_replace(',', '', $item);
                                                            return $carry + (float)$temp;
                                                        } else {
                                                            return $carry + (\Cknow\Money\Money::parse(config('money.defaultCurrency') . $item))->formatByDecimal();
                                                        }
                                                    }),
                                                    2
                                                )
                                            }} -->
                                            </span>
                                        </th>
                                        <th>
                                            <span class="sub-text" style="text-align: right;">
                                            {{ 
                                                number_format(
                                                    $simpananAnggota
                                                    ->pluck('saldo_rata_rata')
                                                    ->reduce(function ($carry, $item) {

                                                        if ($item < 0) {
                                                            $temp = str_replace(',', '', $item);
                                                            return $carry + (float)$temp;
                                                        } else {
                                                            return $carry + (\Cknow\Money\Money::parse(config('money.defaultCurrency') . $item))->formatByDecimal();
                                                        }
                                                    }),
                                                    2
                                                )
                                            }}
                                            </span>
                                        </th>
                                    </tr>
                                </tfoot> --}}
                            </table>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection



@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
    $('select').select2();
</script>
<script>

    $(document).ready(function() {

        $('#searchNama_btn').on('click', function() {

            let selectedAnggota = $('#nama_anggota').val();

            $('#selectedAnggotaValue').val(selectedAnggota);
            $('#anggotaSavingAccount').val(selectedAnggota);
            $('#anggotaId').val()

            console.log("selected kategori : " + selectedAnggota);

        });

    });

</script>
<script>
    $(function() {
        $('input[name="datefilter"]').daterangepicker({
            opens: 'left',
            locale: {
                format: 'DD/MM/YYYY',
            },
            ranges: {
            'Hari Ini': [moment(), moment()],
            'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
            '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
            'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
            'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        });
    });

    $(document).ready(function() {
        if ('{{ $produkSimpanan }}') {
            $('#info_card').show(300);
        } else if ('{{ $nominatifSimpanan }}'){
            $('#info_card').show(300);
        } else {
            $('#info_card').hide();
        }

        $('#selectedSimpanan').on('change', function () {
            let selectedSimpanan = $(this).val();
            let selectedText = $('#selectedSimpanan option:selected').text();
            $('#selectedProdukIDValue').val(selectedSimpanan);
            console.log("selected simpanan ID :" + selectedText);
        });

        $('table tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parent().next();

            if (tr.hasClass('hide')) {
                tr.removeClass('hide');
            } else {
                tr.addClass('hide');
            }
        });
    });

</script>
@endpush
