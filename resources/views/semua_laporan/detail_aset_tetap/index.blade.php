@extends('layouts.app')

@section('breadcrumb')
<x-breadcrumb title="{{ __('Detail Aset Tetap') }}">
    <li class="breadcrumb-item">
        <a href="{{ route('semua_laporan.index') }}">{{ __('Laporan') }}</a>
    </li>
    <li class="breadcrumb-item">
        {{ __('Detail Aset Tetap') }}
    </li>
</x-breadcrumb>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title w-65"><b>DETAIL ASET TETAP</b></h3>
                <ul class="btn-toolbar">
                    <li>
                        <input class="class form-control " type="text" name="datefilter" value="" width="100%" />
                    </li>
                    <li class="mr-3">
                        <button type="button" class="btn btn-white br-0 w-10"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </li>
                    <li class="mr-3">
                        <a href="" class="btn btn-outline-danger fa fa-file-pdf-o "></a>
                    </li>
                    <li>
                        <a href="" class="btn btn-outline-success fa fa-file-excel-o "></a>
                    </li>
                </ul>

            </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered border-top mb-0">
                            <thead class="bg-primary">
                                <tr>
                                    <th style="color: white">No</th>
                                    <th style="color: white">Nama Aset</th>
                                    <th style="color: white">referensi</th>
                                    <th style="color: white">Tanggal Pembelian</th>
                                    <th style="color: white">Harga Pembelian</th>
                                    <th style="color: white">Penyusutan</th>
                                    <th style="color: white">Nilai Buku</th>
                                    <th style="color: white">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Colin Carr</td>
                                    <td>Accountant</td>
                                    <td>colin@gmail.com</td>
                                    <td>Harga Pembelian</td>
                                    <td>Penyusutan</td>
                                    <td>Nilai Buku</td>
                                    <td>
                                        <a href="{{ route('detail_aset_tetap.show') }}" class="btn btn-outline-primary fa fa-eye"></a>
                                        {{-- <a href="" class="btn btn-danger fa fa-trash"></a> --}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
    $(function() {
        $('input[name="datefilter"]').daterangepicker({
            opens: 'left'
            , locale: {
                format: 'DD/MM/YYYY'
            , }
            , ranges: {
                'Hari Ini': [moment(), moment()]
                , 'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')]
                , '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()]
                , '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()]
                , 'Bulan Ini': [moment().startOf('month'), moment().endOf('month')]
                , 'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        });
    });

</script>
@endpush
