@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Neraca') }}">
    	<li class="breadcrumb-item">
            <a href="{{ route('semua_laporan.index') }}">{{ __('Laporan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Neraca') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Neraca</h3>
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
                        </div>
                    </div>
                </div>


                <div class="card-body"> 
                    <div class="row">
                        <table class="table" style="width: 50%">
                            <thead class="thead-light">
                                <tr>
                                    <th>
                                        <span>Keterangan</span>
                                    </th>
                                    <th class="text-right">
                                        <span>Nominal</span>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="2" style="width: 50%">Aktiva/Asset</th>
                                </tr>
                                @foreach($A[0]->descendants as $i => $data)
                                    @if (!empty($data->_balance))
                                    <tr> 
                                        <td>
                                            {!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $data->depth) !!}{{ $data->kode }} &mdash; {{ $data->nama }}
                                        </td>
                                        <td class="text-right">{{ number_format($data->_balance ?? 0, 2) }}</td>
                                    </tr>
                                    @endif
                                @endforeach
                                </thead>
                            <tbody>
                                <tr class="table-active">
                                    <td class="font-weight-bold text-uppercase">Total Aktiva/Aset</td>
                                    <td class="font-weight-bold text-right"></td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <table class="table" style="width: 50%">
                            <thead class="thead-light">
                                <tr>
                                    <th>
                                        <span>Keterangan</span>
                                    </th>
                                    <th class="text-right">
                                        <span>Nominal</span>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="2" style="width: 50%; min-width: 50%">Passiva/Kewajiban</th>
                                </tr>
                                @foreach($merged as $i => $data)
                                    @if (!empty($data->_balance))
                                    <tr> 
                                        <td>
                                            {!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $data->depth) !!}{{ $data->kode }} &mdash; {{ $data->nama }}
                                        </td>
                                        <td class="text-right">{{ number_format($data->_balance ?? 0, 2) }}</td>
                                    </tr>
                                    @endif
                                @endforeach
                                </thead>
                            <tbody>
                                <tr class="table-active">
                                    <td class="font-weight-bold text-uppercase">Total Passiva/Kewajiban</td>
                                    <td class="font-weight-bold text-right">0.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- 
                <table class="table" style="width: 100%">
                    <thead class="thead-light">
                        <tr>
                            <th>
                                <span>Keterangan</span>
                            </th>
                            <th class="text-right">
                                <span>Nominal</span>
                            </th>
                            <th>
                                <span>Keterangan</span>
                            </th>
                            <th class="text-right">
                                <span>Nominal</span>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="2" style="width: 50%">Aktiva/Asset</th>
                            <th colspan="2" style="width: 50%; min-width: 50%">Passiva/Kewajiban</th>
                        </tr>
                    --}}
                        
                       {{--  @for($i = 0; $i < $counter; $i++)
                            <tr>
                                @if (!empty($A[0]->descendants[$i]->_balance))
                                    <td>
                                        {!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $A[0]->descendants[$i]->depth) !!}{{ $A[0]->descendants[$i]->kode }} &mdash; {{ $A[0]->descendants[$i]->nama }}
                                    </td>
                                    <td class="text-right">{{ number_format($A[0]->descendants[$i]->_balance ?? 0, 2) }}</td>
                                @else 
                                    <td style="border: none; white-space: normal;">&nbsp;</td>
                                    <td style="border: none; white-space: normal;"></td>
                                @endif

                                
                                @if (!empty($merged[$i]->_balance))
                                    <td>
                                        {!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $merged[$i]->depth) !!}{{ $merged[$i]->kode }} &mdash; {{ $merged[$i]->nama }}
                                    </td>
                                    <td class="text-right">{{ number_format($merged[$i]->_balance ?? 0, 2) }}</td>
                                @endif

                            </tr>
                        @endfor
                        --}}


                        {{--
                        <tr>
                            @foreach($A as $i => $item)
                                @foreach ($item->descendants as $data)
                                    @if (!empty($data->_balance))
                                        <tr>
                                            <td>
                                                {!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $data->depth) !!}{{ $data->kode }} &mdash; {{ $data->nama }}
                                            </td>
                                            <td class="text-right">{{ number_format($data->_balance ?? 0, 2) }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tr>
                        --}}



                        {{--
                        @for($i = 0; $i < $count; $i++)
                            <tr>
                            @if(!empty($aktivas[$i]))
                                @foreach ($aktivas[$i]->descendants as $item)
                                    @if (!empty($item->balance()))
                                    <tr>
                                        <td style="width: 25%">
                                            <!-- {!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $item->depth) !!}{{ $item->kode }} &mdash; {{ $item->nama }} -->
                                            {{ $item->kode }} &mdash; {{ $item->nama }}
                                        </td>
                                        <td style="width: 25%" class="text-right">{{ number_format($item->balance() ?? 0, 2) }}</td>
                                    </tr>
                                    @endif
                                    <!-- <td style="width: 25%">sata</td>
                                    <td style="width: 25%; min-width: 50%">sata</td> -->
                                @endforeach
                            @else 
                                <td style="width: 25%">&nbsp;</td>
                                <td style="width: 25%; min-width: 50%">&nbsp;</td>
                            @endif

                            
                            @if(!empty($passivas[$i]))
                                @foreach ($passivas[$i]->descendants as $item)
                                    @if (!empty($item->balance()))
                                    <tr>
                                        <td style="width: 25%">
                                            <!-- {!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $item->depth) !!}{{ $item->kode }} &mdash; {{ $item->nama }} -->
                                            {{ $item->kode }} &mdash; {{ $item->nama }}
                                        </td>
                                        <td style="width: 25%" class="text-right">{{ number_format($item->balance() ?? 0, 2) }}</td>
                                    </tr>
                                    @endif
                                    <!-- <td style="width: 25%">sata</td>
                                    <td style="width: 25%; min-width: 50%">sata</td> -->
                                @endforeach
                            @else 
                                <td style="width: 25%">&nbsp;</td>
                                <td style="width: 25%; min-width: 50%">&nbsp;</td>
                            @endif
                            
                            </tr>
                        @endfor
                        --}}
                {{--
                    </thead>
                    <tbody>
                        <tr class="table-active">
                            <td class="font-weight-bold text-uppercase">Total Aktiva/Aset</td>
                            <td class="font-weight-bold text-right">0.00</td>
                            <td class="font-weight-bold text-uppercase">Total Passiva/Kewajiban</td>
                            <td class="font-weight-bold text-right">0.00</td>
                        </tr>
                    </tbody>
                </table> --}}
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
