@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header"> Pembelian</h3>
    <br>
{{--<br>--}}
{{--<x-breadcrumb title="{{ __('Informasi Pesanan') }}">--}}
{{--    <li class="breadcrumb-item">--}}
{{--        <a href="{{ route('pembelian.setting') }}">{{ __('Setting') }}</a>--}}
{{--    </li>--}}
{{--    <li class="breadcrumb-item">--}}
{{--        {{ __('Informasi Pesanan') }}--}}
{{--    </li>--}}
{{--</x-breadcrumb>--}}
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card m-b-20">

            <div class="card-header">
                <h3 class="card-title">Informasi Pembelian Pesanan</h3>

            </div>
            <form action="{{ route('pembelian.pesanan.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Tanggal Pesanan</label>
                                <input type="date" value="{{ $pesanan->tanggal_pesanan ?? '' }}" disabled class="form-control" name="tanggal_pesanan" id="tanggal_pesanan">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">No Pesanan</label>
                                <input type="text" value="{{ $pesanan->no_pesanan ?? '' }}" name="no_pesanan" disabled class="form-control fc-datepicker" id="no_pesanan" placeholder="No Pesanan">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Supplier</label>
                                <input type="text" value="{{ $pesanan->supplier->nama ?? '' }}" name="no_pesanan" disabled class="form-control fc-datepicker" id="no_pesanan" placeholder="No Pesanan">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Id Supplier</label>
                                <input type="text" value="{{ $pesanan->supplier->id_supplier }}" class="form-control" id="id_supplier" disabled>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Tanggal Penerimaan</label>
                                <input type="date" value="{{ $pesanan->tanggal_pesanan }}" disabled class="form-control" id="tanggal_penerimaan" name="tanggal_penerimaan">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Termin</label>
                                <input type="text" value="{{ $pesanan->termin->nama_termin_penjualan }}" class="form-control" id="id_supplier" disabled>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Ekpedisi</label>
                                <input type="text" value="{{ $pesanan->ekpedisi->nama_ekspedisi_penjualan }}" class="form-control" id="id_supplier" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card m-b-20">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap table-primary" width="100%">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="text-white">No</th>
                                        <th class="text-white">Barang</th>
                                        <th class="text-white">Kode Barang</th>
                                        <th class="text-white">Kuantitas</th>
                                        <th class="text-white">Satuan</th>
                                        <th class="text-white">harga</th>
                                        <th class="text-white">diskon %</th>
                                        <th class="text-white">Pajak</th>
                                        <th class="text-white">Total</th>
                                        <th></th>
                                        {{-- <th class="text-white"><a href="#" class="btn btn-sm btn-success rounded-circle add_more"><i class="fa fa-plus"></i></a></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($pesananbody as $pesananbodys => $data)
                                    <tr>
                                        <td>{{ $pesananbodys+1 }}</td>
                                        <td>
                                            {{ $data->produk->nama_produk ?? ''}}
                                        </td>
                                        <td>
                                            {{ $data->produk->kode_produk ?? '' }}
                                        </td>
                                        <td>
                                            {{ $data->kuantitas ?? '' }}
                                        </td>
                                        <td>
                                            {{ $data->produk->satuan->satuan_produk ?? '' }}
                                        </td>
                                        <td>
                                            Rp {{ number_format($data->harga_produk) }}
                                        </td>
                                        <td>
                                            {{ $data->diskon ?? '0'}}%
                                        </td>
                                        <td>
                                            {{ $data->pajak ?? '0' }}%
                                        </td>
                                        <td>
                                            Rp {{ number_format($data->total) }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>

                        </div> <br>

                        <div class="form-horizontal mt-5" id="moreTwo">
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-10">
                                        <label style="padding-left:900px; padding-top:5px;" class="form-label subtotal" id="examplenameInputname2">Subtotal</label>
                                    </div>
                                    <div class="col-md-2">
                                                <h5><b class="total" style="padding-left:">Rp {{ number_format($data->subtotal ?? '0') }}</b></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-10">
                                        <label style="padding-left:900px; padding-top:5px;" class="form-label subtotal" id="examplenameInputname2">Diskon</label>
                                    </div>
                                    <div class="col-md-2">
                                                <h5><b class="total" style="padding-left:">Rp {{ $data->type_diskon ?? '0' == 1 ? number_format((($data->subtotal * $data->diskon_seluruh ) / 100)) : number_format($data->diskon_seluruhpersen ?? '0') }}</b></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-10">
                                        <label style="padding-left:900px; padding-top:5px;" class="form-label subtotal" id="examplenameInputname2">Pajak</label>
                                    </div>
                                    <div class="col-md-2">
                                                <h5><b class="total" style="padding-left:">Rp {{ number_format((($data->total_seluruh * $data->pajak_seluruh) / 100)) }}</b></h5>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-10">
                                        <label style="padding-left:900px; padding-top:5px;" class="form-label subtotal" id="examplenameInputname2">Total</label>
                                    </div>
                                    <div class="col-md-2">
                                                <h5><b class="total" style="padding-left:">Rp {{ number_format($data->total_seluruh ?? '') }}</b></h5>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-10">
                                        <label style="padding-left:900px; padding-top:5px;" class="form-label subtotal" id="examplenameInputname2">Total Seluruh</label>
                                    </div>
                                    <div class="col-md-2">
                                                <h5><b class="total" style="padding-left:">Rp {{ number_format($data->total_tertagih ?? '0') }}</b></h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>

    @endsection
    @push('css')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    @endpush
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    @endpush
