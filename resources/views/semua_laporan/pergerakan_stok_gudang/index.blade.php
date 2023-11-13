@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Pergerakan Stok Gudang') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('semua_laporan.index') }}">{{ __('Laporan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Pergerakan Stok Gudang') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title w-65" ><b>PERGERAKAN STOK GUDANG</b></h3>
                    <ul class="btn-toolbar">
                        <li>
                            <input class="class form-control "  type="text" name="datefilter" value="" width="100%" />
                        </li>
                        <li class="mr-3">
                            <button type="button" class="btn btn-white br-0 w-10"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </li>
                        <li class="mr-3">
                            <a href=""class="btn btn-outline-danger fa fa-file-pdf-o " ></a>
                        </li>
                        <li>
                            <a href=""class="btn btn-outline-success fa fa-file-excel-o " ></a>
                        </li>
                    </ul>

                </div>

                <div class="card-tools ">
                    <table class="table  table-vcenter  table-primary" >
                        <thead  class="bg-primary text-white">
                        <tr >

                            <th class="text-white">No</th>
                            <th class="text-white">Nama Produk</th>
                            <th class="text-white">Kode Produk</th>
                            <th class="text-white">Stok Gudang</th>
                            <th class="text-white">Gudang Temporary</th>
                            <th class="text-white">Gudang Utama</th>
                            <th class="text-white">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr style="border-top: none">
                            <th scope="row">1</th>
                            <th scope="row">Gula Merah</th>
                            <td>GM111</td>
                            <td>1200</td>
                            <td>1500</td>
                            <td>1500</td>
                            <td>1.600.000</td>
                        </tr>
                        <tr style="border-top: none">

                            <th scope="row">2</th>
                            <th scope="row">Gula Putih</th>
                            <td>GP178</td>
                            <td>7900</td>
                            <td>7200</td>
                            <td>7000</td>
                            <td>1.500.000</td>
                        </tr>
                        <tr bgcolor="white" style="height: 30%">
                            <th scope="row" colspan="4"><b>Total</b></th>
                            <th scope="row"><b>1700</b></th>
                            <th  scope="row"><strong>9400</strong></th>
                            <th><strong>11.000</strong></th>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">

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
