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
                            <h3 class="nk-block-title page-title">Kolekbilitas</h3>
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
                                                <select id="selectedSimpanan" name="id" class="form-select form-select-sm" data-search="on" data-placeholder="Daftar AO" tabindex="-1">
                                                    <option value="" data-select2-id="1"></option>
                                                    @foreach($daftarAO as $i => $ao)
                                                        <option value="{{ $ao->id}}" {{ request()->query('id') == $ao->id ? ' selected="selected"' : '' }}>{{ $ao->nama ?? '-'}}</option>
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

                       {{-- @if ($simpananAnggota)
                        <div class="card-inner">
                            <div class="container pt-6">
                                <div class="row justify-content-between">
                                    <div class="col-1">
                                    </div>
                                    <div class="col-4">
                                        Status Akun
                                    </div>
                                    <div class="col-4">
                                        {{ $simpananAnggota->status_aktif ?? '-' }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Nomor Rekening
                                    </div>
                                    <div class="col-4">
                                        {{ $simpananAnggota->no_akun ?? '-' }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Saldo
                                    </div>
                                    <div class="col-4">
                                        {{ number_format($simpananAnggota->balance()) ?? '0.00'  }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Nama Anggota
                                    </div>
                                    <div class="col-4">
                                        {{ $simpananAnggota->anggota->nama_pemohon ?? ''  }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Produk
                                    </div>
                                    <div class="col-4">
                                        {{ $simpananAnggota->produk->nama_simpanan ?? '-' }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Tanggal Buka
                                    </div>
                                    <div class="col-4">
                                        {{ date('d/m/Y', strtotime($simpananAnggota->created_at)) }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                            </div>
                        </div>
                        @endif --}}
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

        $('#selectedAO').on('change', function() {

            let selectedAO = $(this).val();

            console.log("SELECTED AO : " + selectedAO);

            $('#selectedAOValue').val(selectedAO);

        });


    });
    
</script>
@endpush
