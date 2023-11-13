@extends('layouts.app')

@section('breadcrumb')
<x-breadcrumb title="{{ __('Akun Officer') }}">
    <li class="breadcrumb-item">
        <a href="{{ route('semua_laporan.index') }}">{{ __('Laporan') }}</a>
    </li>
    <li class="breadcrumb-item">
        {{ __('Laporan Akun Officer') }}
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
                        <span>Laporan Akun Officer</span>
                    </div>
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Daftar Rekening</h3>
                        </div>
                        <!-- <div class="nk-block-head-content">
                            <input class="class form-control" type="text" name="daterange" value="01/01/2021 - 01/15/2021" />
                        </div> -->
                    </div>
                </div>
                <form>
                    <div class="card card-preview">

                        <input type="hidden" id="selectedAOValue" name="id">

                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-tools">
                                    <div class="row p-3">
                                        <div class="col-md-4">
                                            <select id="selectedAO" class="form-select form-select-sm" data-search="off" data-placeholder="Pilih AO" data-select2-id="1" tabindex="-1">
                                                <option value="" data-select2-id="1">Pilih AO</option>
                                                @foreach($officers as $ao)
                                                <option value="{{ $ao->id }}">{{ $ao->nama ?? '-'}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <select name="month" class="form-select form-select-sm" data-search="off" data-placeholder="Bulan" tabindex="-1">
                                                <option value="">Bulan</option>
                                                <option value="13">Hari Ini</option>
                                                @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}" {{ request()->query('month') == $i ? ' selected="selected"' : null }}>
                                                    {{ \Carbon\Carbon::create()->day(1)->month($i)->locale('id')->monthName }}
                                                    </option>
                                                    @endfor
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

            </div>

            @if($laporanrekbaruData)
            <div class="card card-preview">
                <div class="card-inner p-6">
                    <div class="card-head pb-2">
                        <h5 class="card-title">Rek. Simpanan</h5>
                    </div>
                    <table class="table table-bordered border-top mb-0" data-auto-responsive="false" data-searching="false" data-length-change="false">
                        <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col">
                                    <span class="sub-text">No</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text">No. Anggota</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text">No. Rekening</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text">Nama Anggota</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text">Nama Produk</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text">TGL. Buka</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text">Saldo</span>
                                </th>
                                <th claslass="sub-text">Status</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($laporanrekbaruData->simpananBiasa !== null)
                                @foreach($simpananBiasa as $i => $biasaData)
                                <tr>
                                    <td class="nk-tb-col pb-1" style="border: 0">
                                        <span class="sub-text">{{ $i + 1 }}</span>
                                    </td>
                                    <td class="nk-tb-col pb-1" style="border: 0">
                                        <span class="sub-text">{{ $biasaData->anggota->no_mitra ?? '' }}</span> <!-- // no akun -->
                                    </td>
                                    <td class="nk-tb-col pb-1" style="border: 0">
                                        <span class="sub-text">{{ $biasaData->no_akun ?? '-' }}</span> <!-- // nama penuh -->
                                    </td>
                                    <td class="nk-tb-col pb-1" style="border: 0">
                                        <span class="sub-text">{{ $biasaData->anggota->nama_pemohon ?? '-' }}</span> <!-- // no anggota -->
                                    </td>
                                    <td class="nk-tb-col pb-1" style="border: 0">
                                        <span class="sub-text">{{ $biasaData->produk->nama_simpanan ?? '-'}}</span> <!-- // saldo awal -->
                                    </td>
                                    <td class="nk-tb-col pb-1" style="border: 0">
                                        <span class="sub-text">{{ $biasaData->created_at->format('d-m-Y') ?? '' }}</span> <!-- // Mutasi debet -->
                                    </td>
                                    <td class="nk-tb-col pb-1" style="border: 0">
                                        <span class="sub-text">{{ number_format($biasaData->saldo ?? '0.00') }}</span> <!-- // Mutasi kredit -->
                                    </td>
                                    <td class="nk-tb-col pb-1" style="border: 0">
                                        {{-- <span class="sub-text">{{ $biasaData->status_aktif ?? '-'}}</span> <!-- // Status --> --}}

                                        @if($biasaData->status_aktif == 1)
                                            <span class="sub-text">Aktif</span>
                                        @else
                                            <span class="sub-text">Tidak Aktif</span>
                                        @endif <!-- // saldo akhir -->
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="nk-tb-col pb-1" style="border: 0; text-align: center;">
                                        <span class="sub-text">Tidak ada data</span>
                                    </td>
                                </tr>
                            @endif
                            
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card card-preview">
                <div class="card-inner p-6">
                    <div class="card-head pb-2">
                        <h5 class="card-title">Rek. Simpanan Berjangka</h5>
                    </div>
                    <table class="table table-bordered border-top mb-0" data-auto-responsive="false" data-searching="false" data-length-change="false">
                        <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col">
                                    <span class="sub-text">No</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text">No. Anggota</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text">No. Rekening</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text">Nama Anggota</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text">Nama Produk</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text">TGL. Buka</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text">TGL. Jatuh Tempo</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text">Saldo</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($laporanrekbaruData->simpananBerjangka))
                                @foreach($simpananBerjangka as $i => $simjakaData)
                                <tr>
                                    <td class="nk-tb-col pb-1" style="border: 0">
                                        <span class="sub-text">{{ $i + 1 }}</span>
                                    </td>
                                    <td class="nk-tb-col pb-1" style="border: 0">
                                        <span class="sub-text">{{ $simjakaData->anggota->no_mitra ?? '' }}</span> <!-- // no akun -->
                                    </td>
                                    <td class="nk-tb-col pb-1" style="border: 0">
                                        <span class="sub-text">{{ $biasaData->no_akun }}</span> <!-- // nama penuh -->
                                    </td>
                                    <td class="nk-tb-col pb-1" style="border: 0">
                                        <span class="sub-text">{{ $biasaData->anggota->nama_penuh ?? '' }}</span> <!-- // no anggota -->
                                    </td>
                                    <td class="nk-tb-col pb-1" style="border: 0">
                                        <span class="sub-text"></span> <!-- // saldo awal -->
                                    </td>
                                    <td class="nk-tb-col pb-1" style="border: 0">
                                        <span class="sub-text">{{ $biasaData->created_at->format('d-m-Y') ?? '' }}</span> <!-- // Mutasi debet -->
                                    </td>
                                    <td class="nk-tb-col pb-1" style="border: 0">
                                        <span class="sub-text">{{ $biasaData->saldo }}</span> <!-- // Mutasi kredit -->
                                    </td>
                                    <td class="nk-tb-col pb-1" style="border: 0">
                                        <span class="sub-text"></span> <!-- // saldo akhir -->
                                    </td>
                                </tr>
                                @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9" class="nk-tb-col pb-1" style="border: 0; text-align: center;">
                                                <span class="sub-text">Tidak ada data</span>
                                            </td>
                                        </tr>
                                    @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card card-preview">
                <div class="card-inner p-6">
                    <div class="card-head pb-2">
                        <h5 class="card-title">Rek. Pembiayaan</h5>
                    </div>
                    <table class="table table-bordered border-top mb-0" data-auto-responsive="false" data-searching="false" data-length-change="false">
                        <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col">
                                    <span class="sub-text">No</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text">No. Anggota</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text">No. Rekening</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text">Nama Anggota</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text">Nama Produk</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text">Jangka Waktu</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text">TGL. Akad</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text">TGL. Jatuh Tempo</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text">Jumlah Pembiayaan</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text">Outstanding</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span class="sub-text">Status</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($akunPembiayaan !== '')
                            @foreach($akunPembiayaan as $i => $biasaData)
                            <tr>
                                <td class="nk-tb-col pb-1" style="border: 0">
                                    <span class="sub-text">{{ $i + 1 }}</span>
                                </td>
                                <td class="nk-tb-col pb-1" style="border: 0">
                                    <span class="sub-text">{{ $biasaData->anggota->no_anggota ?? '' }}</span> <!-- // no akun -->
                                </td>
                                <td class="nk-tb-col pb-1" style="border: 0">
                                    <span class="sub-text">{{ $biasaData->no_akun }}</span> <!-- // nama penuh -->
                                </td>
                                <td class="nk-tb-col pb-1" style="border: 0">
                                    <span class="sub-text">{{ $biasaData->anggota->nama_penuh ?? '' }}</span> <!-- // no anggota -->
                                </td>
                                <td class="nk-tb-col pb-1" style="border: 0">
                                    <span class="sub-text"></span> <!-- // saldo awal -->
                                </td>
                                <td class="nk-tb-col pb-1" style="border: 0">
                                    <span class="sub-text">{{ $biasaData->created_at->format('d-m-Y') ?? '' }}</span> <!-- // Mutasi debet -->
                                </td>
                                <td class="nk-tb-col pb-1" style="border: 0">
                                    <span class="sub-text">{{ $biasaData->saldo }}</span> <!-- // Mutasi kredit -->
                                </td>
                                <td class="nk-tb-col pb-1" style="border: 0">
                                    <span class="sub-text"></span> <!-- // saldo akhir -->
                                </td>
                            </tr>
                            @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" class="nk-tb-col pb-1" style="border: 0; text-align: center;">
                                            <span class="sub-text">Tidak ada data</span>
                                        </td>
                                    </tr>
                                @endif
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
    $(document).ready(function() {

        $('#selectedAO').on('change', function() {

            let selectedAO = $(this).val();

            console.log("SELECTED AO : " + selectedAO);

            $('#selectedAOValue').val(selectedAO);

        });


    });

</script>
@endpush
