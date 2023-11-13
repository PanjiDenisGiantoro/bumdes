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

                        <input type="hidden" id="selectedProdukIDValue" name="simpananId" value="{{ request()->query('simpananId') }}">

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
                                                <select id="produkBerjangka" class="form-select form-select-sm" data-search="on" data-placeholder="Pilih Rekening" data-select2-id="1" tabindex="-1">
                                                    <option value="" data-select2-id="1">Pilih Rekening</option>
                                                    @foreach ($simpananBerjangka as $k)
                                                    <option value="{{ $k->id }}"{{ request()->query('simpananId') == $k->id ? ' selected' : '' }}>{{ $k->produk->nama_simpanan }} - {{ $k->anggota->nama_pemohon ?? '' }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <button id="searchNama_btn" class="btn btn-info">Cari</button>
                                            </div>
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

                       @if ($akunBerjangka)
                        <div class="card-inner">
                            <div class="container pt-6">
                                <div class="row justify-content-between">
                                    <div class="col-1">
                                    </div>
                                    <div class="col-4">
                                        Status Akun
                                    </div>
                                    <div class="col-4">
                                        {{ $akunBerjangka->status_aktif ?? '-' }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Nomor Rekening
                                    </div>
                                    <div class="col-4">
                                        {{ $akunBerjangka->no_akun ?? '-' }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Saldo
                                    </div>
                                    <div class="col-4">
                                        {{ number_format($akunBerjangka->balance()) ?? '0.00'  }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Nama Anggota
                                    </div>
                                    <div class="col-4">
                                        {{ $akunBerjangka->anggota->nama_pemohon ?? ''  }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Produk
                                    </div>
                                    <div class="col-4">
                                        {{ $akunBerjangka->produk->nama_simpanan ?? '-' }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Tanggal Buka
                                    </div>
                                    <div class="col-4">
                                        {{ date('d/m/Y', strtotime($akunBerjangka->created_at)) }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                            </div>
                        </div>
                        @endif
                    </div>

                    @if ($akunBerjangka)
                    <div class="card card-preview">
                        <div class="card-inner p-6">
                            <table class="table table-bordered border-top mb-0">
                                <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                        <th class="nk-tb-col">
                                            <span class="sub-text">#</span>
                                        </th>
                                        <th class="nk-tb-col">
                                            <span class="sub-text">Tanggal Pembagian</span>
                                        </th>
                                        <th class="nk-tb-col">
                                            <span class="sub-text">Pendapatan Bagi Hasil</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-bottom: 1px solid white; border-left: 1px solid white; border-right: 1px solid white;">
                                        <td class="nk-tb-col pb-1">
                                            <span class="sub-text">
                                            </span>
                                        </td>
                                        <td class="nk-tb-col text-right pb-1">
                                            <span class="sub-text">
                                            </span>
                                        </td>
                                        <td class="nk-tb-col text-right pb-1">
                                            <span class="sub-text">
                                            </span>
                                        </td>
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

            let selectedProduk = $(this).val();
            $('#selectedProdukIDValue').val(selectedProduk);

            console.log("selected :" + selectedProduk);
        });

    });


</script>
@endpush
