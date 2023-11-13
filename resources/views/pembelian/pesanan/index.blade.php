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
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h3 class="card-title">Pesanan</h3>
                    <div>
{{--                        <a href="#" class="btn btn-success">Cetak</a>--}}
                        <a href="{{ route('pembelian.pesanan.create') }}" class="btn btn-primary">Tambah</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pesanan</th>
                                <th>No Pesanan</th>
                                <th>Supplier</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanan as $pesanans => $data)
                            <tr>
                                <th>{{ $pesanan->firstItem() + $pesanans }}</th>
                                <td>{{ date('d/m/Y',  strtotime($data->tanggal_pesanan)) }}</td>
                                <td>{{ $data->no_pesanan }}</td>
                                <td>{{ $data->supplier->nama }}</td>
                                <td>{{ $data->status }}</td>
                                <td>Rp {{ number_format($data->pesananbody->total_tertagih ?? '0') }}</td>
                                <td class="actions">
                                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li> <a href="{{ route('pembelian.pesanan.show', $data->id) }}" class="dropdown-item fa fa-eye" style="font-size: 12px">&nbsp;Lihat</a></li>
                                        <li><a href="{{ route('pembelian.pesanan.show', [$data->id, 'export' => 'pdf']) }}" class="dropdown-item fa fa-print" style="font-size: 12px" target="_blank">&nbsp;Cetak</a></li>

                                    </ul>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="col-7 col-sm-12 col-md-9">
                        {{ $pesanan->links() }} <br>
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
