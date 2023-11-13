@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">Kasir</h3>
    <br>
{{--    <x-breadcrumb title="{{ __('Kasir') }}">--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('kasir.index') }}">{{ __('Kasir') }}</a>--}}
{{--        </li>--}}
{{--        <li class="breadcrumb-item">--}}
{{--            Kasir--}}
{{--        </li>--}}
{{--    </x-breadcrumb>--}}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                {{-- <div class="tabs-menu">
                    <ul class="nav panel-tabs">
                        <li class="">
                            <a href="{{ route('kasir.index') }}" @class(['active' => $pembeli == 'anggota'])>Anggota</a>
                        </li>
                        <li>
                            <a href="{{ route('kasir.index') }}/non-anggota" @class(['active' => $pembeli == 'non-anggota'])>Non Anggota</a>
                        </li>
                    </ul>
                </div> --}}
                <div class="card-options">
                    <a href="{{ route('kasir.create') }}" class="btn btn-primary">Buka Kasir</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th class="d-lg-none">&nbsp;</th>
                            <th>No. Order</th>
{{--                            <th>No. Invoice</th>--}}
{{--                            <th>Status Pesanan</th>--}}
{{--                            <th>Status Pembayaran</th>--}}
                            <th>Pembeli</th>
                            <th>Tanggal</th>
                            <th class="text-right">Subtotal</th>
                            <th class="text-right">Diskon</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kasir as $k)
                            <tr>
                                <td>{{$k->no_order}}</td>
{{--                                <td></td>--}}
{{--                                <td></td>--}}
{{--                                <td></td>--}}
                                <td>{{ $k->status_anggota ? 'Anggota' : 'Non Anggota' }}</td>
                                <td>{{\Carbon\Carbon::parse($k->tanggal)->format('d/m/Y') ?? ''}}</td>
                                <td class="text-right">{{ number_format($k->total + $k->diskon, 2) }}</td>
                                <td class="text-right">{{ number_format($k->diskon, 2) }}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-dribbble dropdown-toggle btn-sm" data-toggle="dropdown" title="Aksi">
                                            Tindakan
                                        </button>
                                        <div class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{route('kasir.show',$k->id)}}">
                                                <i class="fa fa-eye"></i>
                                            </a>&nbsp;Lihat</li>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $kasir->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endpush
