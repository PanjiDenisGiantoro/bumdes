@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Laba Rugi') }}">
    	<li class="breadcrumb-item">
            <a href="{{ route('semua_laporan.index') }}">{{ __('Laporan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Laba Rugi') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Laba Rugi</h3>
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

                        <!-- <a  style="background-color: blue" href="{{ route('ringkasan_kontak.create') }}">
                            <button class="btn btn-primary">Tambah Summary Batch</button>
                        </a> -->
                    </div>
                </div>
                <table class="table" style="width: 100%">
                    <thead class="thead-light">
                        <tr>
                            <th>
                                <span>Keterangan Akun</span>
                            </th>
                            <th class="text-right">
                                <span>Bulan Ini</span>
                            </th>
                            <th class="text-right">
                                <span>Akumulasi/Year to Date</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th colspan="3">PENDAPATAN</th>
                        </tr>

                        @foreach ($pendapatan as $p)
                            @foreach ($p->descendants as $item)
                                @if (!empty($item->_month) || !empty($item->_year))
                                    <tr>
                                        <td>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $item->depth) !!}{{ $item->kode }} &mdash; {{ $item->nama }}</td>
                                        <td class="text-right">
                                            {{ number_format($item->_month ?? 0, 2) }}
                                        </td>
                                        <td class="text-right">
                                            {{ number_format($item->_year ?? 0, 2) }}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach

                        <tr class="table-active">
                            <td class="font-weight-bold text-uppercase">Total Pendapatan</td>
                            <td class="font-weight-bold text-right">
                                {{ number_format($pendapatan->_month ?? 0, 2) }}
                            </td>
                            <td class="font-weight-bold text-right">
                                {{ number_format($pendapatan->_year ?? 0, 2) }}
                            </td>
                        </tr>
                
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                
                        <tr>
                            <th colspan="3">BIAYA</th>
                        </tr>

                        @foreach ($biaya as $b)
                            @foreach ($b->descendants as $item)
                                @if (!empty($item->_month) || !empty($item->_year))
                                    <tr>
                                        <td>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $item->depth) !!}{{ $item->kode }} &mdash; {{ $item->nama }}</td>
                                        <td class="text-right">
                                            {{ number_format($item->_month ?? 0, 2) }}
                                        </td>
                                        <td class="text-right">
                                            {{ number_format($item->_year ?? 0, 2) }}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach

                        <tr class="table-active">
                            <td class="font-weight-bold text-uppercase">Total Biaya</td>
                            <td class="font-weight-bold text-right">
                                {{ number_format($biaya->_month ?? 0, 2) }}
                            </td>
                            <td class="font-weight-bold text-right">
                                {{ number_format($biaya->_year ?? 0, 2) }}
                            </td>
                        </tr>
                
                        <tr class="table-dark">
                            <td class="font-weight-bold text-uppercase">Laba / Rugi</td>
                            <td class="font-weight-bold text-right">
                                {{ number_format(($pendapatan->_month - $biaya->_month) ?? 0, 2) }}
                            </td>
                            <td class="font-weight-bold text-right">
                                {{ number_format(($pendapatan->_year - $biaya->_year) ?? 0, 2) }}
                            </td>
                        </tr>

                    </tbody>
                </table>
                {{-- <div class="card-footer">

                </div> --}}
            </div>
        </div>
    </div>
@endsection
