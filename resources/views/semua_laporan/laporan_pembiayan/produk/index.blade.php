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
                        <span>Laporan Pembiayaan</span>
                    </div>
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Produk</h3>
                        </div>
                        <!-- <div class="nk-block-head-content">
                            <input class="class form-control" type="text" name="daterange" value="01/01/2021 - 01/15/2021" />
                        </div> -->
                    </div>
                </div>
                <form>
                    <div class="card card-preview">

                        <input type="hidden" id="selectedPembiayaanValue" name="produkId">

                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-tools">
                                    <div class="row p-3">
                                            <div class="col-sm-6">
                                                <select id="selectedPembiayaan" class="form-select form-select-sm" data-search="on" data-placeholder="Pilih Pembiayaan" data-select2-id="1" tabindex="-1">
                                                    <option value="" data-select2-id="1"></option>
                                                    @foreach($produkPembiayaan as $data)
                                                        <option value="{{ $data->id }}"{{ request()->query('produkId') == $data->id ? ' selected' : '' }}>{{ $data->nama_pembiayaan }}</option>
                                                    @endforeach
                                                    <option value="999"{{ request()->query('produkId') == 999 ? ' selected' : '' }}>Semua Produk</option>
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

                       @if ($pembiayaan)

                         {{-- @php
                            $tts = 0;
                            $jjs = 0;

                            $totalOutstanding = 0;
                            $totalHargaJual = 0;

                            foreach($anggotaPembiayaan as $index => $data) {
                                $totalOutstanding += $data->balance();
                                $totalHargaJual += (int)$data->harga_jual->formatByDecimal() ?? '';
                            }

                        @endphp --}}
                        <div class="card-inner">
                            <div class="container pt-6">
                                <div class="row justify-content-between">
                                    <div class="col-1">
                                    </div>
                                    <div class="col-4">
                                        Kode Produk
                                    </div>
                                    <div class="col-4">
                                        {{ $pembiayaan->kode_pembiayaan ?? '-' }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Nama Produk
                                    </div>
                                    <div class="col-4">
                                        {{ $pembiayaan->nama_pembiayaan ?? '-' }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Jenis Akad
                                    </div>
                                    <div class="col-4">
                                        {{ $pembiayaan->produk->nama_simpanan ?? '-' }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Jumlah Rekening
                                    </div>
                                    <div class="col-4">
                                        {{-- {{ number_format($pembiayaan->balance()) ?? '0.00'  }} --}}
                                        {{ count($anggotaPembiayaan) }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Jumlah Nilai Pembiayaan
                                    </div>
                                    <div class="col-4">
                                        {{ !empty($pembiayaan->nilai_pembiayaan) ? number_format($pembiayaan->nilai_pembiayaan) : '0.00' }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Jumlah Outstanding
                                    </div>
                                    <div class="col-4">
                                        {{ !empty($pembiayaan->saldo) ? number_format($pembiayaan->saldo + (!empty($pembiayaan->sisa_margin) ? $pembiayaan->sisa_margin : 0)) : (!empty($pembiayaan->sisa_margin) ? $pembiayaan->sisa_margin : 0) }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                            </div>
                        </div>
                        @endif
                    </div>

                    @if ($anggotaPembiayaan)
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
                                            <span class="sub-text">Nomor Rekening</span>
                                        </th>
                                        <th class="nk-tb-col">
                                            <span class="sub-text">Nama Anggota</span>
                                        </th>
                                        <th class="nk-tb-col">
                                            <span class="sub-text">Tanggal Akad</span>
                                        </th>
                                        <th class="nk-tb-col">
                                            <span class="sub-text text-right">Tanggal Jatuh Tempo</span>
                                        </th>
                                        <th class="nk-tb-col">
                                            <span class="sub-text text-right">Nilai Pembiayaan</span>
                                        </th>
                                        @if (isset($anggotaPembiayaan[0]->pilihan_akad) && ($anggotaPembiayaan[0]->pilihan_akad == '5' || $anggotaPembiayaan[0]->pilihan_akad == 'imbt'))
                                            <th class="nk-tb-col">
                                                <span class="sub-text text-right">Total Margin</span>
                                            </th>
                                            <th class="nk-tb-col">
                                                <span class="sub-text text-right">Outstanding</span>
                                            </th>
                                            <th class="nk-tb-col">
                                                <span class="sub-text text-right">Bagi Hasil Sudah Masuk</span>
                                            </th>
                                        @endif
                                        @if (isset($anggotaPembiayaan[0]->pilihan_akad) && ($anggotaPembiayaan[0]->pilihan_akad == '7' || $anggotaPembiayaan[0]->pilihan_akad == 'musyarakah'))
                                            <th class="nk-tb-col">
                                                <span class="sub-text text-right">Outstanding</span>
                                            </th>
                                            <th class="nk-tb-col">
                                                <span class="sub-text text-right">Bagi Hasil Sudah Masuk</span>
                                            </th>
                                            {{-- <th class="nk-tb-col">
                                                <span class="sub-text text-right">Bagi Hasil Sudah Masuk</span>
                                            </th> --}}
                                        @elseif (isset($anggotaPembiayaan[0]->pilihan_akad) && $anggotaPembiayaan[0]->pilihan_akad == 'qard')
                                            <th class="nk-tb-col">
                                                <span class="sub-text text-right">Outstanding</span>
                                            </th>
                                            <th class="nk-tb-col">
                                                <span class="sub-text text-right">Bagi Hasil Sudah Masuk</span>
                                            </th>
                                            {{-- <th class="nk-tb-col">
                                                <span class="sub-text text-right">Bagi Hasil Sudah Masuk</span>
                                            </th> --}}
                                        @elseif (isset($anggotaPembiayaan[0]->pilihan_akad) && $anggotaPembiayaan[0]->pilihan_akad == '6')
                                            <th class="nk-tb-col">
                                                <span class="sub-text text-right">Jasa</span>
                                            </th>
                                            <th class="nk-tb-col">
                                                <span class="sub-text text-right">Oustanding</span>
                                            </th>
                                            <th class="nk-tb-col">
                                                <span class="sub-text text-right">Jasa Yang Masuk</span>
                                            </th>
                                        @endif

                                        {{-- <th class="nk-tb-col">
                                            <span class="sub-text text-right">Bagi Hasil</span>
                                        </th>
                                        <th class="nk-tb-col">
                                            <span class="sub-text text-right">Outstanding</span>
                                        </th>
                                        <th class="nk-tb-col">
                                            <span class="sub-text text-right">Bagi Hasil Sudah Masuk</span>
                                        </th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @if (!empty($pembiayaan->entries)) --}}
                                    @foreach($anggotaPembiayaan as $index => $data)
                                    <tr>
                                        <td class="nk-tb-col details-control"></td>
                                        <td class="nk-tb-col">
                                            <span class="sub-text">{{ $index+1 }}</span>
                                        </td>
                                        <td class="nk-tb-col pb-1">
                                            <span class="sub-text">{{ $data->no_akun }}</span>
                                        </td>
                                        <td class="nk-tb-col">
                                            <span class="sub-text">{{ $data->anggota->nama_pemohon }}</span>
                                        </td>
                                        <td class="nk-tb-col pb-1">
                                            <span class="sub-text">{{ $data->created_at->format('d/m/Y') }}</span>
                                        </td>
                                        <td class="nk-tb-col">
                                            <span class="sub-text">{{ $data->tanggal_jatuh_tempo ? $data->tanggal_jatuh_tempo->format('d/m/Y') : '' }}</span>
                                        </td>
                                        <td class="nk-tb-col">
                                            <span class="sub-text"{{ number_format($data->nilai_pembiayaan ?? '0.00') }}></span>
                                        </td>
                                        <td class="nk-tb-col">
                                            <span class="sub-text">{{ ($data->margin ? number_format($data->margin->formatByDecimal()) : null) ?? ($data->ujrah ? number_format($data->ujrah->formatByDecimal()) : null) ?? ($data->fee ? number_format($data->fee->formatByDecimal()) : null) ?? ($data->bagi_hasil ? number_format($data->bagi_hasil->formatByDecimal()) : null) }}</span>
                                        </td>
                                        <td class="nk-tb-col">
                                            <span class="sub-text">{{ !empty($data->balance()) ? number_format($data->balance()) : '0.00' }}</span>
                                        </td>
                                        <td class="nk-tb-col pb-1"> <!-- // 8- margin/ujrah/bagi hasil Yang sudah dibayar  -->
                                            <span class="sub-text"></span>
                                        </td>
                                    </tr>
                                    @endforeach
                                    {{-- @endif --}}
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

        $('#selectedPembiayaan').on('change', function(){

            let selectedValue = $(this).val();

            $('#selectedPembiayaanValue').val(selectedValue);
        });

        {{-- @if (isset($pembiayaan->akad_pembiayaan))
            @switch (strtolower($pembiayaan->akad_pembiayaan))
                @case('mudharabah') //Mudharabah, Musyarakah & Qard sama
                    $($('.datatable-init').DataTable().columns(3).header()).html('<span class="sub-text">Tanggal Akad</span>');
                    $($('.datatable-init').DataTable().columns(4).header()).html('<span class="sub-text">Tanggal Jatuh Tempo</span>');
                    $($('.datatable-init').DataTable().columns(5).header()).html('<span class="sub-text">Nilai Pembiayaan</span>');
                    // $($('.datatable-init').DataTable().columns(6).header()).hide();
                    $($('.datatable-init').DataTable().columns(7).header()).html('<span class="sub-text">Outstanding</span>');
                    $($('.datatable-init').DataTable().columns(8).header()).html('<span class="sub-text">Bagi Hasil Sudah Masuk</span>');
                    // $($('.datatable-init').DataTable().columns(9).header()).html('<span class="sub-text">Bagi Hasil Sudah Masuk</span>');
                    @break

                @case('musyarakah')
                    $($('.datatable-init').DataTable().columns(3).header()).html('<span class="sub-text">Tanggal Akad</span>');
                    $($('.datatable-init').DataTable().columns(4).header()).html('<span class="sub-text">Tanggal Jatuh Tempo</span>');
                    $($('.datatable-init').DataTable().columns(5).header()).html('<span class="sub-text">Nilai Pembiayaan</span>');
                    // $($('.datatable-init').DataTable().columns(6).header()).hide();
                    $($('.datatable-init').DataTable().columns(7).header()).html('<span class="sub-text">Outstanding</span>');
                    $($('.datatable-init').DataTable().columns(8).header()).html('<span class="sub-text">Bagi Hasil Sudah Masuk</span>');
                    // $($('.datatable-init').DataTable().columns(9).header()).html('<span class="sub-text">Bagi Hasil Sudah Masuk</span>');
                    @break

                @case('qard')
                    $($('.datatable-init').DataTable().columns(3).header()).html('<span class="sub-text">Tanggal Akad</span>');
                    $($('.datatable-init').DataTable().columns(4).header()).html('<span class="sub-text">Tanggal Jatuh Tempo</span>');
                    $($('.datatable-init').DataTable().columns(5).header()).html('<span class="sub-text">Nilai Pembiayaan</span>');
                    // $($('.datatable-init').DataTable().columns(6).header()).hide();
                    $($('.datatable-init').DataTable().columns(7).header()).html('<span class="sub-text">Outstanding</span>');
                    $($('.datatable-init').DataTable().columns(8).header()).html('<span class="sub-text">Bagi Hasil Sudah Masuk</span>');
                    // $($('.datatable-init').DataTable().columns(9).header()).html('<span class="sub-text">Bagi Hasil Sudah Masuk</span>');
                    @break

                @case('murabahah') // Murabahah & IMBT Sama
                    $($('.datatable-init').DataTable().columns(3).header()).html('<span class="sub-text">Tanggal Akad</span>');
                    $($('.datatable-init').DataTable().columns(4).header()).html('<span class="sub-text">Tanggal Jatuh Tempo</span>');
                    $($('.datatable-init').DataTable().columns(5).header()).html('<span class="sub-text">Nilai Pembiayaan</span>');
                    $($('.datatable-init').DataTable().columns(6).header()).html('<span class="sub-text">Total Margin</span>');
                    $($('.datatable-init').DataTable().columns(7).header()).html('<span class="sub-text">Outstanding</span>');
                    $($('.datatable-init').DataTable().columns(8).header()).html('<span class="sub-text">Margin Sudah Masuk</span>'); //baki margin
                    // $($('.datatable-init').DataTable().columns(9).header()).html(); // margin dah bayar
                    @break

                @case('imbt')
                    $($('.datatable-init').DataTable().columns(3).header()).html('<span class="sub-text">Tanggal Akad</span>');
                    $($('.datatable-init').DataTable().columns(4).header()).html('<span class="sub-text">Tanggal Jatuh Tempo</span>');
                    $($('.datatable-init').DataTable().columns(5).header()).html('<span class="sub-text">Nilai Pembiayaan</span>');
                    $($('.datatable-init').DataTable().columns(6).header()).html('<span class="sub-text">Total Margin</span>');
                    $($('.datatable-init').DataTable().columns(7).header()).html('<span class="sub-text">Outstanding</span>');
                    $($('.datatable-init').DataTable().columns(8).header()).html('<span class="sub-text">Margin Sudah Masuk</span>'); //baki margin
                    // $($('.datatable-init').DataTable().columns(9).header()).html(); // margin dah bayar
                    @break

                @case('ijarah') // Ijarah sahaja
                    $($('.datatable-init').DataTable().columns(3).header()).html('<span class="sub-text">Tanggal Akad</span>');
                    $($('.datatable-init').DataTable().columns(4).header()).html('<span class="sub-text">Tanggal Jatuh Tempo</span>');
                    $($('.datatable-init').DataTable().columns(5).header()).html('<span class="sub-text">Nilai Pembiayaan</span>');
                    $($('.datatable-init').DataTable().columns(6).header()).html('<span class="sub-text">Jasa</span>');
                    $($('.datatable-init').DataTable().columns(7).header()).html('<span class="sub-text">Outstanding</span>');
                    $($('.datatable-init').DataTable().columns(8).header()).html('<span class="sub-text">Jasa Yang Masuk</span>');
                    // $($('.datatable-init').DataTable().columns(9).header()).html();
                    @break


                @default
                    //
            @endswitch
        @endif --}}
    });

</script>
@endpush
