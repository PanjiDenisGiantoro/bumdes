@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Ringkasan Inventory') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('semua_laporan.index') }}">{{ __('Laporan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Ringkasan Inventory') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title w-65" ><b>RINGKASAN INVENTORY</b></h3>
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
                            <th class="text-white">Qty</th>
                            <th class="text-white">Harga Beli</th>
                            <th class="text-white">Nilai Produk</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $total_nilai=0;$total_qty=0; @endphp
                        @foreach($inventory as $i =>$lists)
                            @if($lists->total > 0)
                                <tr>
                                    <td>{{$inventory->firstItem() + $i}}</td>
                                    <td>{{$lists->nama_produk ?? ''}}</td>
                                    <td>{{$lists->kode_produk ?? ''}}</td>
                                    <td>{{$lists->total ?? ''}}</td>
                                    <td>{{number_format($lists->harga_beli) ?? ''}}</td>
                                    <td>{{number_format($lists->total * $lists->harga_beli) ?? ''}}</td>
                                </tr>
                                @php $total_nilai += $lists->total * $lists->harga_beli; @endphp
                                @php $total_qty += $lists->total; @endphp
                                @else
                       @endif
                        @endforeach
                        <tr>
                            <td colspan="3" class="text-center"><b>Total</b></td>
                            <td>{{$total_qty ?? ''}}</td>
                            <td></td>
                            <td>{{number_format($total_nilai) ?? ''}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                {{$inventory->links()}}
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
