@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Pembelian Per Supplier') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('semua_laporan.index') }}">{{ __('Laporan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Pembelian Per Supplier') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title w-65" ><b>PEMBELIAN PER SUPPLIER</b></h3>

                    <ul class="btn-toolbar">
                        <li>
                            <input class="class form-control "  type="text" name="datefilter" value="{{ request()->query('datefilter') }}" />
                        </li>
                        <li>
                            <button type="button" class="btn btn-white br-0 w-10"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </li>

                        <li class="btn-toolbar-sep"></li>
                        <li>
                        <li class="dropdown">
                            <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-toggle="dropdown">
                                <em class="icon ni ni-filter-alt"></em>
                            </a>
                            <div class="filter-wg dropdown-menu dropdown-menu-xl dropdown-menu-right">
                                <div class="dropdown-head">
                                    <span class="sub-title dropdown-title">Advance Filter</span>
                                    <div class="dropdown">
                                        <a href="#" class="link link-light">
                                            <em class="icon ni ni-more-h"></em>
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown-body dropdown-body-rg">
                                    <div class="row gx-6 gy-4">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="overline-title overline-title-alt">Status</label>
                                                <select multiple class="form-select form-select-sm select2-hidden-accessible" name="state[]" data-allow-clear="true" data-tags="true" data-placeholder="Any status" data-multiple="true">
                                                    <option value="">Any Status</option>
                                                    {{--                                                    @foreach ([0 => 'Dalam Proses', 'Disetujui', 'Ditolak'] as $i => $state)--}}
                                                    {{--                                                        <option value="{{ $i }}"{{ in_array($i, request()->query('state', [])) ? ' selected="selected"' : '' }}>{{ humanize($state) }}</option>--}}
                                                    {{--                                                    @endforeach--}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-secondary">Filter</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </li>
                        <li class="mr-3">
                            <a href=""class="btn btn-outline-danger fa fa-file-pdf-o " ></a>
                        </li>
                        <li>
                            <a href=""class="btn btn-outline-success fa fa-file-excel-o " ></a>
                        </li>
                        <li class="dropdown">
                            <div class="btn-group">
                                {{--                                <a href="{{ route('admin.anggota.index', ['state'=>request()->query('state', []), 'export' => 'xlsx']) }}" class="btn btn-icon btn-outline-primary" target="_blank">--}}
                                <em class="icon ni ni-file-xls"></em>
                                </a>
                            </div>
                        </li>


                        </li>


                    </ul>
                </div>

                <div class="card-tools ">
                    <table class="table card-table table-vcenter text-nowrap table-primary" >
                        <thead  class="bg-primary text-white">
                        <tr >

                            <th class="text-white">No</th>
                            <th class="text-white">Kode Supplier</th>
                            <th class="text-white">Nama Supplier</th>
                            <th class="text-white">Total Transaksi</th>
                            <th class="text-white">Nilai Pembelian</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pembeliansupplier as $i =>$supplier)

                            <tr>
                                <td>{{$pembeliansupplier->firstItem() + $i}}</td>
                                <td>{{$supplier->id_supplier ??''}}</td>
                                <td>{{$supplier->supplier ?? ''}}</td>
                                <td>{{$supplier->jumlah ?? ''}}</td>
                                <td>{{number_format($supplier->tagihan) ?? ''}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
                <div class="card-footer">
                    {{$pembeliansupplier->links()}}
                </div>
            </div>
        </div>
    </div>
{{--    <div class="row">--}}
{{--        <div class="col-md-12 col-lg-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    <h3 class="card-title w-65" ><b>Tagihan</b></h3>--}}


{{--                </div>--}}

{{--                <div class="card-tools ">--}}
{{--                    <table class="table  table-vcenter  table-primary" >--}}
{{--                        <thead  class="bg-primary text-white">--}}
{{--                        <tr >--}}

{{--                            <th class="text-white">No</th>--}}
{{--                            <th class="text-white">No. Tagihan</th>--}}
{{--                            <th class="text-white">Supplier</th>--}}
{{--                            <th class="text-white">Tanggal Pemesanan</th>--}}
{{--                            <th class="text-white">Tanggal Jatuh Tempo</th>--}}
{{--                            <th class="text-white">Status Pembayaran</th>--}}
{{--                            <th class="text-white">Sisa Tagihan</th>--}}
{{--                            <th class="text-white">Total</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        <tr style="border-top: none">--}}

{{--                            <th scope="row">1</th>--}}
{{--                            <th scope="row">PO3456</th>--}}
{{--                            <td>Panji Denis</td>--}}
{{--                            <td>05/08/2021</td>--}}
{{--                            <td>05/10/2021</td>--}}
{{--                            <td>Belum Dibayar</td>--}}
{{--                            <td>5.000.000</td>--}}
{{--                            <td>10.000.000</td>--}}
{{--                        </tr>--}}
{{--                        <tr style="border-top: none">--}}

{{--                            <th scope="row">2</th>--}}
{{--                            <th scope="row">PO1234</th>--}}
{{--                            <td>Panji Denis</td>--}}
{{--                            <td>05/08/2021</td>--}}
{{--                            <td>05/10/2021</td>--}}
{{--                            <td>Belum Dibayar</td>--}}
{{--                            <td>600.000</td>--}}
{{--                            <td>600.000</td>--}}
{{--                        </tr>--}}


{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--                <div class="card-footer">--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

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
