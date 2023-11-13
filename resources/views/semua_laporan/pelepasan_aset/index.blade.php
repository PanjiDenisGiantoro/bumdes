@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Pelepasan Aset') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('semua_laporan.index') }}">{{ __('Laporan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Pelepasan Aset') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title w-65" ><b>PELEPASAN ASET</b></h3>
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
                            <th class="text-white">Nama Aset</th>
                            <th class="text-white">Kelompok Aset</th>
                            <th class="text-white">Nomor</th>
                            <th class="text-white">Tanggal Pelepasan</th>
                            <th class="text-white">Biaya Awal</th>
                            <th class="text-white">Akumulasi Penyusutan</th>
                            <th class="text-white">Nilai Buku</th>
                            <th class="text-white">Harga Jual</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $total=0;$biaya=0; @endphp
                        @foreach($pelepasan_aset_mgts as $i => $list)
                            <tr>
                                <td>{{ $pelepasan_aset_mgts->firstItem() + $i}}</td>
                                <td>{{ $list->aset->nama_aset ?? '' }}</td>
                                <td>{{ $list->aset->kelompokaset->kelompok_aset ?? '' }}</td>
                                <td>{{$list->no_transaksi ??''}}</td>
                                <td>{{\Carbon\Carbon::parse($list->tanggal_transaksi)->format('d/m/Y') ?? ''}}</td>
                                <td>{{$list->aset->biaya_akuisisi ?? ''}}</td>
                                <td>{{$list->aset->penyusutan_bulanan ?? ''}}</td>
                                <td>{{$list->aset->total_penyusutan ?? ''}}</td>
                                <td>Rp.{{number_format($list->harga_jual ?? ''),2}}</td>
                            </tr>
                            @php $total += $list->harga_jual; @endphp
                        @endforeach
                        <tr bgcolor="white" style="height: 30%">
                            <th scope="row" colspan="6"><b>Total</b></th>
                            <th scope="row"><b></b></th>
                            <th  scope="row"><strong></strong></th>
                            <th><strong>{{number_format($total)}}</strong></th>
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
