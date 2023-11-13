@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Tagihan Pelanggan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('semua_laporan.index') }}">{{ __('Laporan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tagihan Pelanggan') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title w-65" ><b>TAGIHAN PELANGGAN</b></h3>

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

                            <th class="text-white">No</th>
                            <th class="text-white">No. Invoice</th>
                            <th class="text-white">Nama</th>
                            <th class="text-white">Nama Warung</th>
                            <th class="text-white">Tanggal Pemesanan</th>
                            <th class="text-white">Total Tagihan</th>
                            <th class="text-white">Dibayar</th>
                            <th class="text-white">Belum Dibayar</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($list as $i => $lists )
                                <tr>
                                    <td>{{$list->firstItem() +$i}}</td>
                                    <td>{{$lists->no_pengiriman ?? ''}}</td>
                                    <td>{{$lists->non_anggota ?? ''}}</td>
                                    <td>{{$lists->nama_warung ?? ''}}</td>
                                    <td >{{\Carbon\Carbon::parse($lists->tanggal_pengiriman)->format('d/m/Y') ?? ''}}</td>
                                    <td >{{number_format($lists->total ?? '')}}</td>
                                    <td >{{number_format($lists->bayar ?? '')}}</td>
                                    <td >{{number_format($lists->sisa_tagihan ?? '')}}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
                <div class="card-footer">
                    {{$list->links()}}
                </div>
            </div>
        </div>
    </div>
{{--    <div class="row">--}}
{{--        <div class="col-md-12 col-lg-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    <h3 class="card-title w-65" ><b>DETIL TAGIHAN PIUTANG</b></h3>--}}


{{--                </div>--}}

{{--                <div class="card-tools ">--}}
{{--                    <table class="table  table-vcenter  table-primary" >--}}
{{--                        <thead  class="bg-primary text-white">--}}
{{--                        <tr >--}}

{{--                            <th class="text-white">No</th>--}}
{{--                            <th class="text-white">Status Pembayaran</th>--}}
{{--                            <th class="text-white">Nama Produk</th>--}}
{{--                            <th class="text-white">Satuan</th>--}}
{{--                            <th class="text-white">Qty</th>--}}
{{--                            <th class="text-white">Harga</th>--}}
{{--                            <th class="text-white">Diskon %</th>--}}
{{--                            <th class="text-white">Pajak</th>--}}
{{--                            <th class="text-white">Total</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        <tr style="border-top: none">--}}

{{--                            <th scope="row">1</th>--}}
{{--                            <th scope="row" rowspan="2">Dibayar Sebagian</th>--}}
{{--                            <td>Gula Merah</td>--}}
{{--                            <td>1 Kg</td>--}}
{{--                            <td>50</td>--}}
{{--                            <td>Rp.10.000.000</td>--}}
{{--                            <td>0</td>--}}
{{--                            <td>0</td>--}}
{{--                            <td>Rp.10.000.000</td>--}}
{{--                        </tr>--}}
{{--                        <tr style="border-top: none">--}}

{{--                            <th scope="row">2</th>--}}
{{--                            <td>Gula Merah</td>--}}
{{--                            <td>1 Kg</td>--}}
{{--                            <td>50</td>--}}
{{--                            <td>Rp.10.000.000</td>--}}
{{--                            <td>0</td>--}}
{{--                            <td>0</td>--}}
{{--                            <td>Rp.10.000.000</td>--}}
{{--                        </tr>--}}
{{--                        <tr bgcolor="white" style="height: 30%">--}}
{{--                            <th  colspan="5"></th>--}}
{{--                            <th scope="row"><b>Sub Total</b></th>--}}
{{--                            <td></td>--}}
{{--                            <td></td>--}}
{{--                            <th><strong>Rp.10.000.000</strong></th>--}}
{{--                        </tr>--}}
{{--                        <tr bgcolor="white" style="height: 30%">--}}
{{--                            <th  colspan="5"></th>--}}
{{--                            <th scope="row"><b>Total Dibayar</b></th>--}}
{{--                            <td></td>--}}
{{--                            <td></td>--}}
{{--                            <th><strong>Rp.10.000.000</strong></th>--}}
{{--                        </tr>--}}
{{--                        <tr bgcolor="white">--}}
{{--                            <th  colspan="5"></th>--}}
{{--                            <th scope="row"><b>Sisa Tagihan</b></th>--}}
{{--                            <td></td>--}}
{{--                            <td></td>--}}
{{--                            <th><strong>Rp.20.000.000</strong></th>--}}
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
