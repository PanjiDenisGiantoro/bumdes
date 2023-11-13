@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Tagihan Supplier') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('semua_laporan.index') }}">{{ __('Laporan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tagihan Supplier') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title w-65" ><b>TAGIHAN SUPPLIER</b></h3>

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
                        </li>


                    </ul>
                </div>

                <div class="card-tools ">
                    <table class="table card-table table-vcenter text-nowrap table-primary" >
                        <thead  class="bg-primary text-white">
                        <tr >
                            <th class="text-white">No. Invoice</th>
                            <th class="text-white">Nama Supplier</th>
                            <th class="text-white">Tanggal Pemesanan</th>
{{--                            <th class="text-white">Tanggal Jatuh Tempo</th>--}}
                            <th class="text-white">Total Tagihan</th>
                            <th class="text-white">Dibayar</th>
                            <th class="text-white">Belum Dibayar</th>
                            <th class="text-white">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pembeliantagihan as $i => $pembelian)
                        <tr>
                            <th scope="row">{{$pembelian->no_pesanan ?? ''}}</th>
                            <td>{{$pembelian->supplier ?? ''}}</td>
                            <td>{{ date('d/m/Y', strtotime($pembelian->tanggal_penerimaan ?? '')) }}</td>
{{--                            <td></td>--}}
                            <td>{{number_format($pembelian->jumlah) ?? ''}}</td>
                            <td>{{number_format($pembelian->bayar) ?? ''}}</td>
                            <td>{{number_format($pembelian->sisa) ?? ''}}</td>
                            <td>{{$pembelian->status_pembayaran ?? ''}}</td>
                        </tr>

                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
{{--    <div class="row">--}}
{{--        <div class="col-md-12 col-lg-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    <h3 class="card-title w-65" ><b>DETAIL PEMBELIAN</b></h3>--}}

{{--                    <ul class="btn-toolbar">--}}
{{--                        <li>--}}
{{--                            <input class="class form-control "  type="text" name="datefilter" value="{{ request()->query('datefilter') }}" />--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <button type="button" class="btn btn-white br-0 w-10"><i class="fa fa-search" aria-hidden="true"></i></button>--}}
{{--                        </li>--}}

{{--                        <li class="btn-toolbar-sep"></li>--}}
{{--                        <li>--}}
{{--                        <li class="dropdown">--}}
{{--                            <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-toggle="dropdown">--}}
{{--                                <em class="icon ni ni-filter-alt"></em>--}}
{{--                            </a>--}}
{{--                            <div class="filter-wg dropdown-menu dropdown-menu-xl dropdown-menu-right">--}}
{{--                                <div class="dropdown-head">--}}
{{--                                    <span class="sub-title dropdown-title">Advance Filter</span>--}}
{{--                                    <div class="dropdown">--}}
{{--                                        <a href="#" class="link link-light">--}}
{{--                                            <em class="icon ni ni-more-h"></em>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="dropdown-body dropdown-body-rg">--}}
{{--                                    <div class="row gx-6 gy-4">--}}
{{--                                        <div class="col-12">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label class="overline-title overline-title-alt">Status</label>--}}
{{--                                                <select multiple class="form-select form-select-sm select2-hidden-accessible" name="state[]" data-allow-clear="true" data-tags="true" data-placeholder="Any status" data-multiple="true">--}}
{{--                                                    <option value="">Any Status</option>--}}
{{--                                                    --}}{{--                                                    @foreach ([0 => 'Dalam Proses', 'Disetujui', 'Ditolak'] as $i => $state)--}}
{{--                                                    --}}{{--                                                        <option value="{{ $i }}"{{ in_array($i, request()->query('state', [])) ? ' selected="selected"' : '' }}>{{ humanize($state) }}</option>--}}
{{--                                                    --}}{{--                                                    @endforeach--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-12">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <button type="submit" class="btn btn-secondary">Filter</button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}

{{--                        </li>--}}
{{--                        <li class="mr-3">--}}
{{--                            <a href=""class="btn btn-outline-danger fa fa-file-pdf-o " ></a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href=""class="btn btn-outline-success fa fa-file-excel-o " ></a>--}}
{{--                        </li>--}}
{{--                        <li class="dropdown">--}}
{{--                            <div class="btn-group">--}}
{{--                                --}}{{--                                <a href="{{ route('admin.anggota.index', ['state'=>request()->query('state', []), 'export' => 'xlsx']) }}" class="btn btn-icon btn-outline-primary" target="_blank">--}}
{{--                                <em class="icon ni ni-file-xls"></em>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </li>--}}


{{--                        </li>--}}


{{--                    </ul>--}}
{{--                </div>--}}

{{--                <div class="card-tools ">--}}
{{--                    <table class="datatable-init nowrap nk-tb-list nk-tb-ulist table card-table table-vcenter text-nowrap table-primary" data-auto-responsive="false" data-searching="false" data-length-change="false" data-sortable="false">--}}
{{--                        <thead  class="bg-primary text-white">--}}
{{--                        <tr>--}}
{{--                            <th class="text-white">#</th>--}}
{{--                            <th class="text-white">No.Tagihan</th>--}}
{{--                            <th class="text-white" >Tanggal Pemesanan</th>--}}
{{--                            <th class="text-white">Tanggal Jatuh Tempo</th>--}}
{{--                            <th class="text-white">Net</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        <tr>--}}
{{--                            <td class="bg-white nk-tb-col details-control"></td>--}}
{{--                            <td class="bg-white">PO8756</td>--}}
{{--                            <td class="bg-white">05/11/2021</td>--}}
{{--                            <td class="bg-white">15/12/2021</td>--}}
{{--                            <td class="bg-white">10.000.000</td>--}}
{{--                        </tr>--}}

{{--                        <tr class="hide">--}}
{{--                            <td colspan="6">--}}
{{--                                <table class="table card-table table-vcenter text-nowrap table-primary" style="width: 100%;" >--}}

{{--                                    <thead  class="bg-primary text-white">--}}
{{--                                    <tr >--}}
{{--                                        <th class="text-white">No.Tagihan</th>--}}
{{--                                        <th class="text-white" >Nama Supplier</th>--}}
{{--                                        <th class="text-white">Nama Perusahaan</th>--}}
{{--                                        <th class="text-white">Tanggal Pemesanan</th>--}}
{{--                                        <th class="text-white">Tanggal Jatuh Tempo</th>--}}
{{--                                        <th class="text-white">Status Pembayaran</th>--}}
{{--                                        <th class="text-white">Total Tagihan</th>--}}
{{--                                        <th class="text-white">Pembayaran Masuk</th>--}}
{{--                                        <th class="text-white">Sisa Pembayaran</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    <tr >--}}
{{--                                        <td >PO8756</td>--}}
{{--                                        <td >Resti</td>--}}
{{--                                        <td >PT.Madani</td>--}}
{{--                                        <td >05/10/2022</td>--}}
{{--                                        <td >05/12/2022</td>--}}
{{--                                        <td >Belum Dibayar</td>--}}
{{--                                        <td >10.000.000</td>--}}
{{--                                        <td >0</td>--}}
{{--                                        <td >10.000.000</td>--}}

{{--                                    </tr>--}}

{{--                                    </tbody>--}}
{{--                                    <tfoot>--}}

{{--                                    </tfoot>--}}
{{--                                </table>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        </tbody>--}}

{{--                    </table>--}}

{{--                </div>--}}
{{--                <div class="card-footer">--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <style>
        .hide {
            display: none;
        }
        td.details-control {
            background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
        }
    </style>

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

            $('table tbody').on('click', 'td.details-control', function () {
                var tr = $(this).parent().next();

                if (tr.hasClass('hide')) {
                    tr.removeClass('hide');
                } else {
                    tr.addClass('hide');
                }
            });
        });

    </script>
@endpush
