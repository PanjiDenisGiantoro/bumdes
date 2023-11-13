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
                            <h3 class="nk-block-title page-title">Rekening</h3>
                        </div>
                        <!-- <div class="nk-block-head-content">
                            <input class="class form-control" type="text" name="daterange" value="01/01/2021 - 01/15/2021" />
                        </div> -->
                    </div>
                </div>
                <form>
                    <div class="card card-preview">

                        <input type="hidden" id="selectedAnggotaValue" name="pembiayaanId" value="{{ request()->query('simpananId') }}" >

                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-tools">
                                    <div class="row p-3">
                                            <div class="col-sm-6">
                                                <select id="selectedAnggota" class="form-select form-select-sm" data-search="on" data-placeholder="Pilih Rekening" data-select2-id="1" tabindex="-1">
                                                    <option value="" data-select2-id="1"></option>
                                                    @foreach($anggota as $data)
                                                        <option value="{{ $data->id }}"{{ request()->query('pembiayaanId') == $data->id ? ' selected="selected"' : '' }}>{{ $data->produk->nama_pembiayaan }} - {{ $data->anggota->nama_pemohon ?? '' }}</option>
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

                       @if ($pembiayaan)
                        <div class="card-inner">
                            <div class="container pt-6">
                                <div class="row justify-content-between">
                                    <div class="col-1">
                                    </div>
                                    <div class="col-4">
                                        Status
                                    </div>
                                    <div class="col-4">
                                        {{ $pembiayaan->status_aktif ?? '-' }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Nama Anggota
                                    </div>
                                    <div class="col-4">
                                        {{ $pembiayaan->anggota->nama_pemohon ?? ''  }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Produk
                                    </div>
                                    <div class="col-4">
                                        {{ $pembiayaan->produk->nama_simpanan ?? '-' }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Nilai Pembiayaan
                                    </div>
                                    <div class="col-4">
                                        {{ number_format($pembiayaan->balance()) ?? '0.00'  }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Tanggal Akad
                                    </div>
                                    <div class="col-4">
                                        {{ date('d/m/Y', strtotime($pembiayaan->created_at)) }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Tanggal Pencairan
                                    </div>
                                    <div class="col-4">
                                        {{ date('d/m/Y', strtotime($pembiayaan->created_at)) }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Tanggal Jatuh Tempo
                                    </div>
                                    <div class="col-4">
                                        {{ date('d/m/Y', strtotime($pembiayaan->tanggal_jatuh_tempo ?? '-') ?? '-') }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- @if ($akunBerjangka) --}}
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
                                            <span class="sub-text">Tanggal</span>
                                        </th>
                                        <th class="nk-tb-col">
                                            <span class="sub-text">Sisa</span>
                                        </th>
                                        <th class="nk-tb-col">
                                            <span class="sub-text">Pokok</span>
                                        </th>
                                        <th class="nk-tb-col">
                                            <span class="sub-text text-right">Margin</span>
                                        </th>
                                        <th class="nk-tb-col">
                                            <span class="sub-text text-right">Jumlah</span>
                                        </th>
                                        <th class="nk-tb-col">
                                            <span class="sub-text text-right">No. Struk</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($pembiayaan->entries))
                                    @foreach($pembiayaan->entries as $index => $data)
                                    <tr>
                                        <td class="nk-tb-col details-control"></td>
                                        <td class="nk-tb-col">
                                            <span class="sub-text">{{ $index+1 }}</span>
                                        </td>
                                        <td class="nk-tb-col pb-1">
                                            <span class="sub-text">{{ date('d/m/Y', strtotime($data->date)) ?? '' }}</span>
                                        </td>
                                        <td class="nk-tb-col">
                                        </td>
                                        <td class="nk-tb-col pb-1">
                                            <span class="sub-text">{{ !empty($data->saldo) ? number_format($data->saldo) : '0.00' }}</span>
                                        </td>
                                        <td class="nk-tb-col">
                                            <span class="sub-text" style="text-align: right;">{{ !empty($data->interest) ? number_format($data->interest) : '0.00' }}</span>
                                        </td>
                                        <td class="nk-tb-col">
                                            <span class="sub-text" style="text-align: right;"></span>
                                        </td>
                                        <td class="nk-tb-col">
                                            <span class="sub-text" style="text-align: right;">{{ $data->ledger->no_jurnal ?? '' }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- @endif --}}
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

        $('#selectedAnggota').on('change', function() {

            let selectedAnggota = $(this).val();

            $('#selectedAnggotaValue').val(selectedAnggota);
            console.log("selected Anggota :" + selectedAnggota);
        });

    });

</script>
@endpush
