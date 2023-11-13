@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header"> Pembelian</h3>
    <br>
{{--<br>--}}
{{--<x-breadcrumb title="{{ __('Informasi Penerimaan') }}">--}}
{{--    <li class="breadcrumb-item">--}}
{{--        <a href="{{ route('pembelian.setting') }}">{{ __('Setting') }}</a>--}}
{{--    </li>--}}
{{--    <li class="breadcrumb-item">--}}
{{--        {{ __('Penerimaan') }}--}}
{{--    </li>--}}
{{--</x-breadcrumb>--}}
@endsection

@section('content')

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h3 class="card-title"></h3>
                    <div>
{{--                        <a href="#" class="btn btn-success">Cetak</a>--}}
                        <a href="{{ route('pembelian.penerimaan.create') }}" class="btn btn-primary">Tambah</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
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
                                        <th>Tanggal Penerimaan</th>
                                        <th>Ref</th>
                                        <th>Total</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($penerimaan as $penew => $data)
                                    <tr>
                                        <td>{{ $penerimaan->firstItem() + $penew }}</td>
                                        <td>{{ date('d/m/Y',  strtotime($data->pesanan->tanggal_pesanan ?? '')) ?? '' }}</td>
                                        <td>{{ $data->pesanan->no_pesanan ?? '' }}</td>
                                        <td>{{ $data->supplier ?? '' }}</td>
                                        <td>{{ $data->status }}</td>
                                        <td>{{ $data->pesanan->jumlah_tagihan ?? ''}}</td>
                                        <td>{{ $data->tanggal_penerimaan }}</td>
                                        <td>{{ $data->no_invoice }}</td>
                                        <td>Rp {{ number_format($data->jumlah_tagihan ?? '0') }}</td>
                                        <td class="row ">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-dribbble dropdown-toggle btn-sm" data-toggle="dropdown" title="Cetak">
                                                    Cetak
                                                </button>
                                                <div class="dropdown-menu">
                                                   <li> <a href="{{ route('pembelian.penerimaan.show', $data->id) }}" class="dropdown-item fa fa-eye" style="font-size: 12px">&nbsp;Lihat</a></li>
                                                    <li><a href="#" class="dropdown-item fa fa-print" style="font-size: 12px">&nbsp;Cetak</a></li>

                                                </div>
                                            </div>
                                             </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="col-7 col-sm-12 col-md-9">
                                {{ $penerimaan->links() }} <br>
                            </div>
                        </div>
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


@push('scripts')
    <script>
        $('.swal-confirm').click(function(e) {

            id = e.target.dataset.id;

            swal({
            title: 'Yakin mau dihapus?',
            text: "Data yang dihapus tidak bisa dikembalikan",
            type: "warning",
            customClass: 'swal-height',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, delete',
            }).then((result) => {
            if (result) {
                $(`#delete${id}`).submit();
            }
            })
        })
    </script>
@endpush
