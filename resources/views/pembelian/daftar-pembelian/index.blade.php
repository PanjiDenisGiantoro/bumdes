@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header"> Daftar Pembelian</h3>

<br>
@endsection
{{--<x-breadcrumb title="{{ __('Daftar Pembelian') }}">--}}
{{--    <li class="breadcrumb-item">--}}
{{--        {{ __('Daftar Pembelian') }}--}}
{{--    </li>--}}
{{--</x-breadcrumb>--}}
{{--@endsection--}}

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header justify-content-between">
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Pesanan</th>
                                <th>Tanggal Pembelian</th>
                                <th>No Invoice</th>
                                <th>Supplier</th>
                                <th>Status Penerimaan</th>
                                <th>Status Pembayaran</th>
                                <th>Total</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembayaran as $pem => $data)
                                <tr>
                                <td>{{ $pembayaran->firstItem() + $pem }}</td>
                                <td>{{ $data->penerimaan->pesanan->no_pesanan ?? '' }}</td>
                                @if($data->penerimaan == null)
                                <td></td>
                                @else
                                <td>{{ date('d/m/Y',  strtotime($data->penerimaan->pesanan->tanggal_pesanan)) ?? '' }}</td>
                                @endif
                                <td>{{ $data->penerimaan->no_invoice ?? '' }}</td>
                                <td>{{ $data->penerimaan->pesanan->supplier->nama ?? '' }}</td>
                                <td>{{ $data->penerimaan->status ?? '' }}</td>
                                <td>{{ $data->penerimaan->status_pembayaran ?? '' }}</td>
                                @if($data->penerimaan == null)
                                <td></td>
                                @else
                                <td>Rp {{ number_format($data->penerimaan->jumlah_tagihan ?? '') }}</td>
                                @endif
                                <td>
                                    <a href="#" class="btn btn-warning " style="font-size: 12px">Pesanan</a>
                                    <a href="#" class="btn btn-success" style="font-size: 12px">VP</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="col-7 col-sm-12 col-md-9">
                        {{ $pembayaran->links() }} <br>
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
