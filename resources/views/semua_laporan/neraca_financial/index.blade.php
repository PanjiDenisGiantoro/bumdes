@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Neraca Saldo') }}">
    	<li class="breadcrumb-item">
            <a href="{{ route('semua_laporan.index') }}">{{ __('Laporan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Neraca Saldo') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Neraca Saldo') }}</h3>
                    
                    
                    <div class="card-options">
                        <div class="btn-group mr-2">
                        <form>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" name="datefilter" value="{{ request()->query('datefilter') }}" />
                                <div class="input-group-append">
                                    <button class="btn btn-white br-0 w-10" type="submit">
                                        <em class="fa fa-search"></em>
                                    </button>
                                    <div class="nk-block-head-content" style="margin-left: 20px">
                                        <div class="btn-group">
                                            <a class="btn btn-icon btn-outline-primary" target="_blank" href="">
                                                <em class="fa fa-file-pdf-o"></em>
                                            </a>
                                            <a class="btn btn-icon btn-outline-primary" target="_blank" href="">
                                                <em class="fa fa-file-excel-o"></em>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                             <!-- <a class="btn btn-primary fa fa-print" style="background-color: blue; margin-right: 7px">&nbsp; CETAK</a> -->
                            <!-- <a class="btn btn-primary" style="background-color: blue; margin-right: 7px" href="">
                                <i class="fa fa-print">&nbsp; CETAK</i>
                            </a> -->
                            <!-- <a class="btn btn-primary fa fa-file-pdf-o" style="background-color: red; margin-right: 7px">&nbsp; PDF</a> -->
                           <!--  <a class="btn btn-primary" style="background-color: red; margin-right: 7px" href="">
                                <i class="fa fa-file-pdf-o">&nbsp; PDF</i>
                            </a> -->
                            <!-- <a class="btn btn-primary fa fa-print" style="background-color: green; margin-right: 7px">&nbsp; EXCEL</a> -->
                            <!-- <a class="btn btn-primary" style="background-color: green;  margin-right:7px" href="">
                                <i class="fa fa-file-excel-o">&nbsp; EXCEL</i>
                            </a> -->
                           <!--  <a class="btn btn-primary" style="background-color: blue; margin-right: 7px" href="">
                                <i class="fa fa-print">&nbsp; Cetak</i>
                            </a>
                            <a class="btn btn-primary" style="background-color: red; margin-right: 7px" href="">
                                <i class="fa fa-file-pdf-o">&nbsp; PDF</i>
                            </a>
                            <a class="btn btn-primary" style="background-color: green;  margin-right:7px" href="">
                                <i class="fa fa-file-excel-o">&nbsp; EXCEL</i>
                            </a> -->
                        </div>

                        <!-- <a  style="background-color: blue" href="{{ route('ringkasan_kontak.create') }}">
                            <button class="btn btn-primary">Tambah Summary Batch</button>
                        </a> -->
                    </div>
                </div>
                <table class="table" style="width: 100%">
                    <thead class="thead-light">
                        <tr>
                            <th>
                                <span>Keterangan</span>
                            </th>
                            <th class="text-right">
                                <span>Saldo Awal</span>
                            </th>
                            <th class="text-right">
                                <span>Debet</span>
                            </th>
                            <th class="text-right">
                                <span>Kredit</span>
                            </th>
                            <th class="text-right">
                                <span>Saldo Akhir</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (['A', 'L', 'C', 'I', 'E'] as $type)
                        <tr class="thead-light">
                            <th colspan="5">
                                @switch($type)
                                    @case('C')
                                        Modal
                                        @break
                
                                    @case('A')
                                        Asset
                                        @break
                
                                    @case('L')
                                        Passiva Kewajiban
                                        @break
                
                                    @case('I')
                                        Pendapatan
                                        @break
                
                                    @case('E')
                                        Beban / Biaya
                                        @break
                
                                    @default
                                        Default
                                @endswitch
                            </th>
                        </tr>

                        @foreach ($$type as $t)
                            @foreach ($t->descendants as $item)
                                @if (!empty($item->_debit) || !empty($item->_credit) || !empty($item->_balance))
                                    <tr>
                                        <td>
                                            {!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $item->depth) !!}{{ $item->kode }} &mdash; {{ $item->nama }}
                                        </td>
                                        <td class="text-right">0.00</td>
                                        <td class="text-right">{{ number_format($item->_debit ?? 0, 2) }}</td>
                                        <td class="text-right">{{ number_format($item->_credit ?? 0, 2) }}</td>
                                        <td class="text-right">{{ number_format($item->_balance ?? 0, 2) }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                        
                        <tr class="table-active">
                            <td class="font-weight-bold text-uppercase">
                            @switch($type)
                                @case('C')
                                    Total Modal
                                    @break
            
                                @case('A')
                                    Total Asset / Aktiva
                                    @break
            
                                @case('L')
                                Total Passiva Kewajiban
                                    @break
            
                                @case('I')
                                Total Pendapatan
                                    @break
            
                                @case('E')
                                    Total Beban / Biaya
                                    @break
            
                                @default
                                    Default
                            @endswitch
                            </td>
                            <td class="font-weight-bold text-right">0.00</td>
                            <td class="font-weight-bold text-right">
                                {{ number_format(collect($$type)->pluck('_debit')->sum() ?? 0, 2) }}
                            </td>
                            <td class="font-weight-bold text-right">
                                {{ number_format(collect($$type[0])->pluck('_credit')->sum() ?? 0, 2) }}
                            </td>
                            <td class="font-weight-bold text-right">
                                {{ number_format(collect($$type[0])->pluck('_balance')->sum() ?? 0, 2) }}
                            </td>
                        </tr>            
                        @endforeach
                    </tbody>
                </table>
                {{-- <div class="card-footer">

                </div> --}}
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
