@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Pengiriman Pembelian') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('semua_laporan.index') }}">{{ __('Laporan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Pengiriman Pembelian') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title w-65" ><b>PENGIRIMAN PEMBELIAN</b></h3>
                    <ul class="btn-toolbar">
                        <li>
                            <input class="class form-control "  type="text" name="datefilter" value="" />
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
                            <th class="text-white">Nama</th>
                            <th class="text-white">Nama Produk</th>
                            <th class="text-white">Qty</th>
                            <th class="text-white">Harga</th>
                            <th class="text-white">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr style="border-top: none">

                            <th scope="row">1</th>
                            <th scope="row">Panji Denis</th>
                            <td>Susu Bayi</td>
                            <td>100</td>
                            <td>1000</td>
                            <td>100.000</td>
                        </tr>
                        <tr style="border-top: none">

                            <th scope="row">2</th>
                            <th scope="row">Nizam Arif</th>
                            <td>Sun Kara</td>
                            <td>20</td>
                            <td>30.000</td>
                            <td>100.000</td>
                        </tr>

                        <tr bgcolor="white" style="height: 30%">
                            <th  colspan="3"></th>
                            <th scope="row"><b>Total</b></th>
                            <th  scope="row"><strong></strong></th>
                            <th><strong>Rp.200.000</strong></th>
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
