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
                            <h3 class="nk-block-title page-title">Rekening Simpanan Berjangka</h3>
                        </div>
                        <!-- <div class="nk-block-head-content">
                            <input class="class form-control" type="text" name="daterange" value="01/01/2021 - 01/15/2021" />
                        </div> -->
                    </div>
                </div>
                <form>
                    <div class="card card-preview">

                        <input type="hidden" id="selectedProdukIDValue" name="produkId">

                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-tools">
                                    <div class="row p-3">
                                        <div class="col-md-4">
                                            <select name="month" class="reksim" data-search="off" data-placeholder="Pilih Tanggal" tabindex="-1">
                                                <option value="">Pilih Tanggal</option>
                                                <option value="13">Hari Ini</option>
                                                @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}" {{ request()->query('month') == $i ? ' selected="selected"' : null }}>
                                                    {{ \Carbon\Carbon::create()->day(1)->month($i)->locale('id')->monthName }}
                                                </option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <select id="produkBerjangka" class="form-select form-select-sm" data-search="on" data-placeholder="Pilih Simpanan" data-select2-id="1" tabindex="-1">
                                                <option value="" data-select2-id="1">Pilih Produk</option>
                                                @foreach ($senaraiBerjangka as $k)
                                                <option value="{{ $k->id }}" {{ request()->query('produkId') == $k->id ? ' selected="selected"' : '' }}>{{ $k->akad_simpanan }} - {{ $k->nama_simpanan }}</option>
                                                @endforeach
                                                <option value="999" {{ request()->query('produkId') == '999' ? ' selected="selected"' : '' }}>Semua Produk</option>
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

            @if ($berjangka)
            <div class="card-inner">
                <div class="container pt-6">
                    <div class="row justify-content-between">
                        <div class="col-1">
                        </div>
                        <div class="col-4">
                            Kode Produk
                        </div>
                        <div class="col-4">
                            {{ $berjangka->kode_simpanan ?? '-' }}
                        </div>
                    </div>
                    <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                    <div class="row justify-content-between">
                        <div class="col-1"></div>
                        <div class="col-4">
                            Nama Produk
                        </div>
                        <div class="col-4">
                            {{ $berjangka->nama_simpanan ?? '-' }}
                        </div>
                    </div>
                    <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                    <div class="row justify-content-between">
                        <div class="col-1"></div>
                        <div class="col-4">
                            Jenis Akad
                        </div>
                        <div class="col-4">
                            {{ $berjangka->kategori_produk ?? '-' }}
                        </div>
                    </div>
                    <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                    <div class="row justify-content-between">
                        <div class="col-1"></div>
                        <div class="col-4">
                            Jumlah Rekening
                        </div>
                        <div class="col-4">
                            {{ count($anggotaBerjangka) }}
                        </div>
                    </div>
                    <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                    <div class="row justify-content-between">
                        <div class="col-1"></div>
                        <div class="col-4">
                            Jumlah Saldo
                        </div>
                        <div class="col-4 pb-5">
                            {{
                            number_format(
                                $anggotaBerjangka
                                ->pluck('saldo')
                                ->reduce(function ($carry, $item) {
                                    return $carry + (\Cknow\Money\Money::parse(config('money.defaultCurrency') . $item))->formatByDecimal();
                                }),
                                2
                            )
                        }}
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        @if ($anggotaBerjangka)
            <div class="card card-preview">
                <div class="card-inner table-responsive">
                    <table class="table nowrap nk-tb-list nk-tb-ulist" data-auto-responsive="false" data-searching="false" data-length-change="false" data-sortable="false">
                        <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col">
                                    <span class="sub-text"></span>
                                </th>
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
                                    <span class="sub-text">Tgl. Akad</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text text-right">Tgl. Jatuh Tempo</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text text-right">Saldo</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text text-right">Status</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text text-right">Deposito</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($anggotaBerjangka as $index => $data)
                            <tr>
                                <td class="nk-tb-col details-control"></td>
                                <td class="nk-tb-col">
                                    <span class="sub-text">{{ $index+1 }}</span>
                                </td>
                                <td class="nk-tb-col pb-1">
                                    <span class="sub-text">{{ $data->anggota->nama_pemohon ?? '' }}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="sub-text">{{ $data->no_akun ?? '' }}</span>
                                    {{-- <a href="{{ route('admin.simpanan.show', $data->id ?? '' ) }}" target="_blank">{{ $data->no_akun }}</a> --}}
                                </td>
                                <td class="nk-tb-col pb-1">
                                    <span class="sub-text">{{ $data->created_at ? $data->created_at->format('d/m/Y') : '-' }}</span>
                                </td>
                                <td class="nk-tb-col pb-1">
                                    <span class="sub-text">{{ date('d/m/Y', strtotime($data->tanggal_jatuh_tempo)) }}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="sub-text" style="text-align: right;">{{ !empty($data->lastEntry) ? number_format($data->lastEntry->current_balance, 2) : (!empty($data->entries->current_balance) ? $data->entries->current_balance : '0.00') }}</span>
                                    <!-- <span class="sub-text" style="text-align: right;">{{ !empty($data->lastEntry) ? '': 'ada' }}</span> -->
                                </td>
                                <td class="nk-tb-col">
                                    <span class="sub-text" style="text-align: right;">{{ $data->status_aktif }}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <span class="sub-text" style="text-align: right;">?</span>
                                </td>
                            </tr>
                    @endforeach
                            <tr>
                                <th style="text-align: left"></th>
                                <th style="text-align: left">TOTAL</th>
                                <th colspan="3" style="text-align: right"></th>
                                <th></th>
                                <th>{{ number_format(
                                            $anggotaBerjangka
                                            ->pluck('saldo')
                                            ->reduce(function ($carry, $item) {
                                                return $carry + (\Cknow\Money\Money::parse(config('money.defaultCurrency') . $item))->formatByDecimal();
                                            }),
                                            2
                                        )
                                    }}
                                </th>
                            </tr>
                    </tbody>
                    </table>
                </div>
            </div>
        @endif
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

        $('#produkBerjangka').on('change', function() {

            let selectedBerjangka = $(this).val();

            $('#selectedProdukIDValue').val(selectedBerjangka);
            console.log("seletted produk berjangka : " + selectedBerjangka);

        });

    });

</script>

@endpush
