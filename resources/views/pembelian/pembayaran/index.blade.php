@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header"> Pembelian</h3>
    <br>
{{--<br>--}}
{{--<x-breadcrumb title="{{ __('Informasi Pembayaran') }}">--}}
{{--    <li class="breadcrumb-item">--}}
{{--        <a href="{{ route('pembelian.setting') }}">{{ __('Setting') }}</a>--}}
{{--    </li>--}}
{{--    <li class="breadcrumb-item">--}}
{{--        {{ __('Daftar Pembayaran') }}--}}
{{--    </li>--}}
{{--</x-breadcrumb>--}}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            {{-- <div class="card-header">
                <h3 class="card-title">&nbsp;</h3>
                <div class="card-options">
                    <a style="background-color: blue" href="{{ route('tipe_kontak.create') }}">
            <button class="btn btn-primary">Tambah Tipe Kontak</button>
            </a>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h3 class="card-title">Daftar Pembayaran</h3>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Pesanan</th>
                                <th>Tanggal Pembelian</th>
                                <th>No Inbios</th>
                                <th>Supplier</th>
                                <th>Status Penerimaan</th>
                                <th>Status Pembayaran</th>
                                <th>Total</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($penerimaan as $peneris => $data)
                            <tr>
                                <th>{{ $penerimaan->firstItem() + $peneris }}</th>
                                <td>{{ $data->pesanan->no_pesanan ?? ''}}</td>
                                <td>{{ date('d/m/Y', strtotime($data->pesanan->tanggal_pesanan ?? '')) }}</td>
                                <td>{{ $data->no_invoice ?? ''}}</td>
                                <td>{{ $data->supplier ?? ''}}</td>
                                <td>{{ $data->status ?? '' }}</td>

                                <td>
                                {{-- if status_pembayaran == belum bayar then belum --}}
                                {{ $data->status_pembayaran ?? '' }}</td>
                                <td>{{ number_format($data->jumlah_tagihan ?? '') }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-dribbble dropdown-toggle btn-sm" data-toggle="dropdown" title="Cetak">
                                                Cetak & Lihat
                                            </button>
                                            <div class="dropdown-menu">
                                                @if($data->status_pembayaran == 'Lunas')
                                                    <li> <a href="{{ route('pembelian.pembayaran.show', $data->id) }}" class="dropdown-item fa fa-eye"  style=" font-size: 12px">&nbsp;Lihat</a></li>
                                                    <li><a href="{{ route('pembelian.pembayaran.show_pdf', $data->id) }}" class="dropdown-item fa fa-print" style="font-size: 12px" target="_blank">&nbsp;Cetak</a></li>

                                                    {{--                                                <a href="#" class="btn btn-success fa fa-print"  style="font-size: 12px"></a>--}}
                                                @else
                                                    @if($data->status_pembayaran == 'Belum bayar')
                                                        <li><a href="{{ route('pembelian.pembayaran.create', $data->id) }}" class="dropdown-item fa fa-cart-plus"  style="font-size: 12px">&nbsp;Tagihan</a></li>
                                                    @elseif($data->status_pembayaran == 'Belum Lunas')
                                                        <li><a href="{{ route('pembelian.pembayaran.edit', $data->id) }}" class="dropdown-item fa fa-cart-plus"  style=" font-size: 12px">&nbsp;Tagihan</a></li>
                                                    @endif

                                                @endif
                                            </div>
                                        </div>

                                	{{-- <a href="{{ route('pembelian.pembayaran.edit', $data->id) }}" class="btn btn-info fa fa-cart-plus"  style="font-size: 12px"></a> --}}

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="col-7 col-sm-12 col-md-9">
                        {{ $penerimaan->links() }} <br>
                    </div>
                </div>
                <!-- table-responsive -->
            </div>
            <!-- section-wrapper -->
        </div>

    </div>

</div>
</div>
</div>
@endsection
@push('css')
<link href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/jquery.dataTables.min.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
<link src="{{ asset('assets/plugins/datatable/jquery.dataTables.min.js') }}" rel="stylesheet" />
<link src="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.js') }}" rel="stylesheet" />
@endpush
