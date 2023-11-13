@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Ringkasan Aset Tetap') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('semua_laporan.index') }}">{{ __('Laporan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Ringkasan Aset Tetap') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title w-65" ><b>RINGKASAN ASET TETAP</b></h3>
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

                            <th class="text-white">Nama Aset</th>
                            <th class="text-white">Nomor</th>
                            <th class="text-white">Tanggal Pembelian</th>
                            <th class="text-white">Harga Pembelian</th>
                            <th class="text-white">Penyusutan</th>
{{--                            <th class="text-white">Nilai Buku</th>--}}
                        </tr>
                        </thead>
                        @php $no=1;$total=0; @endphp
                        @foreach($aset as $i => $lists)
                        <tr>
                            <th colspan="7" style="border-top: none;"><b>{{$lists[0]->akun_perkiraan->nama ?? ''}}</b></th>
                        </tr>
                        <tbody>

                            <tr>
                            <td>{{$lists[0]->nama_aset ?? ''}}</td>
                            <td>{{$lists[0]->nomor_aset ?? ''}}</td>
                            <td >{{\Carbon\Carbon::parse($lists[0]->tanggal_akuisisi)->format('d/m/Y') ?? ''}}</td>
                            <td >{{number_format($lists[0]->biaya_akuisisi ?? '')}}</td>
                            <td >{{$list[0]->disusutkan_text ?? ''}}</td>
                        </tr>
                            @php $total += $lists->amount ; @endphp
                        @endforeach
                        <tr bgcolor="white" style="height: 30%">
                            <th scope="row" colspan="3"><b>Total</b></th>
                            <th scope="row"><b>{{number_format($total) ?? ''}}</b></th>
                            <th  scope="row"></th>
                            <th  scope="row"></th>
{{--                            <th><strong>529.000.000</strong></th>--}}
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
