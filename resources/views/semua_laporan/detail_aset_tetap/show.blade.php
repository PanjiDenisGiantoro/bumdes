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
                <h4 class="pull-left"><b>Detais</b></h4>
                <div class="table-responsive">
                    <table class="table table-vcenter border-top w-50 mb-0">
                        <tbody>
                            <tr>
                                <td>Nama Aset</td>
                                <td>: Wisma Kantor BDG</td>
                            </tr>
                            <tr>
                                <td>Nomor</td>
                                <td>: FA/0001</td>
                            </tr>
                            <tr>
                                <td>Tanggal Pembelian</td>
                                <td>: 07/11/2021</td>
                            </tr>
                            <tr>
                                <td>Harga Beli</td>
                                <td>: Rp 9.900</td>
                            </tr>
                            <tr>
                                <td>Dikreditkan Dari Akun</td>
                                <td>: 3-30000 - Modal Saham</td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>: Wisma Kantor BGD</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h4 class="pull-left mt-6"><b>Penyusutan</b></h4>
                <div class="table-responsive">
                    <table class="table table-vcenter border-top w-50 mb-0">
                        <tbody>
                            <tr>
                                <td>Tanpa Penyusutan</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h4 class="pull-left mt-6"><b>Transaksi</b></h4>
                <div class="table-responsive">
                    <table class="table table-vcenter border-top w-50 mb-0">
                        <tbody>
                            <tr>
                                <td>Tanggal Pembelian</td>
                                <td>: 07/11/2021</td>
                            </tr>
                            <tr>
                                <td>Harga Beli</td>
                                <td>: Rp 9.900.000</td>
                            </tr>
                            <tr>
                                <td>Tanggal Pembelian</td>
                                <td>: Rp 9.900.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive mt-6">
                    <table class="table card-table table-vcenter text-nowrap table-primary">
                        <thead class="bg-primary text-white">
                            <tr >
                                <th class="text-white">Tanggal</th>
                                <th class="text-white">Reference</th>
                                <th class="text-white">Debit</th>
                                <th class="text-white">Kredit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>07/09/2021</td>
                                <td>07/11/2021</td>
                                <td>Rp 9.900.000</td>
                                <td>0</td>
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
