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
                            <h3 class="nk-block-title page-title">Kolekbilitas</h3>
                        </div>
                    </div>
                </div>
                <form>
                    <div class="card card-preview">

                        <input type="hidden" id="kesehatanIdValue" name="kesehatanId" value="{{ request()->query('kesehatanId') }}">

                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-tools">
                                    <div class="row p-3">
                                            <div class="col-sm-6">
                                                <select id="tingkatKesehatan" class="form-select form-control" data-search="on" tabindex="-1">
                                                    <option >-- Pilih Tingkat Kesehatan --</option>
                                                    @foreach($tingkatKesehatan as $i => $data)
                                                        <option value="{{ $data->id}}" {{ request()->query('kesehatanId') == $data->id ? ' selected="selected"' : '' }}>{{ $data->nama }}</option>
                                                    @endforeach
                                                    <option value="999" {{ request()->query('kesehatanId') == '999' ? ' selected="selected"' : '' }}>Semua Tingkat Kesehatan</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <button id="searchNama_btn" class="btn btn-info">Cari</button>
                                                <a class="btn btn-success" style="margin-right:7px" href="#">
                                                    <i class="fa fa-file-excel-o">&nbsp;</i>
                                                </a>
                                            </div>
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
                                        Status Akun
                                    </div>
                                    <div class="col-4">
                                        {{ $pembiayaan->status_aktif ?? '-' }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Nomor Rekening
                                    </div>
                                    <div class="col-4">
                                        {{ $pembiayaan->no_akun ?? '-' }}
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #f2f2f2; margin-top:10px; margin-left:100px; margin-right:100px;">
                                <div class="row justify-content-between">
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        Saldo
                                    </div>
                                    <div class="col-4">
                                        {{ number_format($pembiayaan->balance()) ?? '0.00'  }}
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
                            </div>
                        </div>
                        @endif
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7-beta.19/jquery.inputmask.min.js"></script>
<script>
$(document).ready(function () {
    $(":input").inputmask()
});
</script>
@section('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
    
    $('#tingkatKesehatan').on('change', function() {
        $('#kesehatanIdValue').val($(this).val());
    })

</script>
@endsection
@endsection
