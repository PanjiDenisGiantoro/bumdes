@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header"> Denominasi</h3>
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
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h3 class="card-title">Daftar Denominasi</h3>
                    <div>
{{--                        <a href="#" class="btn btn-success">Cetak</a>--}}
                        <a href="{{ route('denominasi.tambah') }}" class="btn btn-primary">Tambah</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID Teller</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Jenis Transaksi</th>
                                <th>Total</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($denominasi as $i => $data)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $data->teller_id ?? '-' }}</td>
                                <td>{{ date('d/m/Y',  strtotime($data->created_at)) }}</td>
                                <td>{{ date('H:i',  strtotime($data->created_at)) }}</td>
                                <td>{{ $data->jenis_transaksi }}</td>
                                <td>{{ number_format($data->total_amount) }}</td>
                                <td class="actions">
                                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li> <a href="" class="dropdown-item fa fa-eye" style="font-size: 12px">&nbsp;Lihat</a></li>
                                        <li><a href="" class="dropdown-item fa fa-print" style="font-size: 12px" target="_blank">&nbsp;Cetak</a></li>

                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <div class="col-7 col-sm-12 col-md-9">
                        {{ $pesanan->links() }} <br>
                    </div> --}}
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

