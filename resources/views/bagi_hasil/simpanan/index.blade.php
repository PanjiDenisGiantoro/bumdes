@extends('layouts.app')

@section('breadcrumb')
<x-breadcrumb title="{{ __('Proses Distribusi Bagi Hasil Simpanan') }}">
    <li class="breadcrumb-item">
        <a href="{{ route('semua_laporan.index') }}">{{ __('Laporan') }}</a>
    </li>
    <li class="breadcrumb-item">
        {{ __('Detail Aset Tetap') }}
    </li>
</x-breadcrumb>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title w-65"><b>PROSES DISTIRBUSI BAGI HASIL SIMPANAN BERJANGKA</b></h3>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="form-group ml-4 mt-4">
                        <div class="row gutters-xs">
                            <div class="col">
                                <select class="form-control" name="akun_gl_buku_besar">
                                    <option value="">Pilih Bulan</option>
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                </select>
                            </div>
                            <span class="col-auto">
                                <button class="btn btn-secondary" type="button">Cari</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-border border-top mb-0">
                        <thead>
                            <tr>
                                <th>PRODUK SIMPANAN</th>
                                <th>SALDO RATA RATA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-weight-bold">TOTAL SALDO RATA RATA SIMPANAN</td>
                                <td class="font-weight-semibold">0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push("css")
<link href="{{ asset('assets/plugins/tabs/style.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!---Tabs JS-->
<script src={{ asset('assets/js/tabs.js') }}></script>
<script src="{{ asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

{{-- <script>
    $(function() {
        $('input[name="datefilter"]').daterangepicker({
            opens: 'left'
            , locale: {
                format: 'DD/MM/YYYY'
            , }
            , ranges: {
                'Hari Ini': [moment(), moment()]
                , 'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')]
                , '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()]
                , '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()]
                , 'Bulan Ini': [moment().startOf('month'), moment().endOf('month')]
                , 'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        });
    });

</script> --}}
@endpush
