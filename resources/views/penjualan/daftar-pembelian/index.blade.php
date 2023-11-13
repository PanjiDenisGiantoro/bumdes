@extends('layouts.app')

@section('breadcrumb')
<br>
<x-breadcrumb title="{{ __('Daftar Pembeliaan') }}">
    <li class="breadcrumb-item">
        {{ __('Daftar Pembeliaan') }}
    </li>
</x-breadcrumb>
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
                    {{-- <h3 class="card-title">List Pembelian</h3> --}}
                    {{-- <a href="#" class="btn btn-primary">Tambah</a> --}}
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
                            <tr>
                                <th>1</th>
                                <td>2</td>
                                <td>12-mar-2021</td>
                                <td>bca123</td>
                                <td>JKI</td>
                                <td>Pending</td>
                                <td>Success</td>
                                <td>50000</td>
                                <td>
                                    <a href="#" class="btn btn-warning " style="font-size: 12px">Pesanan</a>
                                    <a href="#" class="btn btn-success" style="font-size: 12px">VP</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
