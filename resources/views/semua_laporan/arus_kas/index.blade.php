@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Arus Kas') }}">
    	<li class="breadcrumb-item">
            <a href="{{ route('semua_laporan.index') }}">{{ __('Laporan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Arus Kas') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Arus Kas</h3>
                    <div class="card-options">
                        <div class="btn-group mr-2">
                        <form>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" name="datefilter" value="{{ request()->query('datefilter') }}" />
                                <div class="input-group-append">
                                    <button class="btn btn-white br-0 w-10" type="submit">
                                        <em class="fa fa-search"></em>
                                    </button>
                                    <div class="nk-block-head-content" style="margin-left: 20px">
                                        <div class="btn-group">
                                            <a class="btn btn-icon btn-outline-primary" target="_blank" href="">
                                                <em class="fa fa-file-pdf-o"></em>
                                            </a>
                                            <a class="btn btn-icon btn-outline-primary" target="_blank" href="">
                                                <em class="fa fa-file-excel-o"></em>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                             <!-- <a class="btn btn-primary fa fa-print" style="background-color: blue; margin-right: 7px">&nbsp; CETAK</a> -->
                            <!-- <a class="btn btn-primary" style="background-color: blue; margin-right: 7px" href="">
                                <i class="fa fa-print">&nbsp; CETAK</i>
                            </a> -->
                            <!-- <a class="btn btn-primary fa fa-file-pdf-o" style="background-color: red; margin-right: 7px">&nbsp; PDF</a> -->
                           <!--  <a class="btn btn-primary" style="background-color: red; margin-right: 7px" href="">
                                <i class="fa fa-file-pdf-o">&nbsp; PDF</i>
                            </a> -->
                            <!-- <a class="btn btn-primary fa fa-print" style="background-color: green; margin-right: 7px">&nbsp; EXCEL</a> -->
                            <!-- <a class="btn btn-primary" style="background-color: green;  margin-right:7px" href="">
                                <i class="fa fa-file-excel-o">&nbsp; EXCEL</i>
                            </a> -->
                           <!--  <a class="btn btn-primary" style="background-color: blue; margin-right: 7px" href="">
                                <i class="fa fa-print">&nbsp; Cetak</i>
                            </a>
                            <a class="btn btn-primary" style="background-color: red; margin-right: 7px" href="">
                                <i class="fa fa-file-pdf-o">&nbsp; PDF</i>
                            </a>
                            <a class="btn btn-primary" style="background-color: green;  margin-right:7px" href="">
                                <i class="fa fa-file-excel-o">&nbsp; EXCEL</i>
                            </a> -->
                        </div>

                        <!-- <a  style="background-color: blue" href="{{ route('ringkasan_kontak.create') }}">
                            <button class="btn btn-primary">Tambah Summary Batch</button>
                        </a> -->
                    </div>
                </div>
                <table class="table" style="width: 100%">
                    <thead class="thead-light">
                        <tr>
                            <th>
                                <span>Keterangan</span>
                            </th>
                            <th class="text-right">
                                <span>Jumlah</span>
                            </th>
                        </tr>
                        <tr>
                            <th  colspan="2">
                                <span>Arus Kas Dari Aktivitas Operasional</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th colspan="2">
                                Penerimaan
                            </th>
                        </tr>
                        <tr>
                            <th colspan="2">
                                Pengeluaran
                            </th>
                        </tr>
                    </tbody>
                    <thead class="thead-light">
                        <tr>
                            <th colspan="2">
                                <span>Arus Kas Dari Aktivitas Investasi</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                Penerimaan
                            </th>
                        </tr>
                        <tr>
                            <th>
                                Pengeluaran
                            </th>
                        </tr>
                    </tbody>
                    <thead class="thead-light">
                        <tr>
                            <th colspan="2">
                                <span>Arus Kas Dari Aktivitas Pendanaan</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                Penerimaan
                            </th>
                        </tr>
                        <tr>
                            <th>
                                Pengeluaran
                            </th>
                        </tr>
                    </tbody>
                    <thead class="thead-light">
                        <tr>
                            <th>
                                <span>Total Masuk/Keluar Kas</span>
                            </th>
                            <th>
                                <span></span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Total Masuk</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>Total Keluar</th>
                            <th></th>
                        </tr>
                    </tbody>
                    <thead class="thead-light">
                        <tr>
                            <th colspan="2">
                                <span>Saldo Kas (Awal)</span>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="2">
                                <span>Saldo Kas (Akhir)</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
                {{-- <div class="card-footer">

                </div> --}}
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

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

    </script>
@endpush
