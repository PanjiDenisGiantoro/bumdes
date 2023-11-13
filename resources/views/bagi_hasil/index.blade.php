@extends('layouts.app')

@section('breadcrumb')
<x-breadcrumb title="{{ __('Detail Aset Tetap') }}">
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
                <h3 class="card-title w-65"><b>Settings</b></h3>
            </div>

            <div class="card-body p-6">
                <div class="panel panel-primary">
                    <div class=" tab-menu-heading">
                        <div class="tabs-menu1 ">
                            <!-- Tabs -->
                            <ul class="nav panel-tabs">
                                <li class=""><a href="#tab5" class="active" data-toggle="tab">Komponen Pembagi Bagi Hasil</a></li>
                                <li><a href="#tab6" data-toggle="tab">Komponen Pendapatan Untuk Bagi Hasil</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body tabs-menu-body">

                        {{-- Komponen Pembagi Bagi Hasil --}}

                        <div class="tab-content">
                            <div class="tab-pane active " id="tab5">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            {{-- <h4>Komponen Pembagi Bagi Hasil</h4> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12 col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <div class="row gutters-xs">
                                                                <div class="col-md-6"></div>
                                                                <div class="col-md-3">
                                                                    <select class="form-control">
                                                                        <option>-- Pilih --</option>
                                                                        <option>das1</option>
                                                                        <option>das2</option>
                                                                        <option>das3</option>
                                                                    </select>
                                                                </div>
                                                                <button class="btn btn-secondary mr-1" type="button"><i class="fe fe-search"></i></button>
                                                                <span class="col-auto">
                                                                    <button type="button" class="btn btn-icon btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fe fe-plus"></i></button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="">Komponen Pembagi Bagi Hasil</label>
                                                        <input type="text" class="form-control" name="komponen_pembagi_bagi_hasil"readonly>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th class="font-weight-bold w-40">Akun Simpanan</th>
                                                <th class="font-weight-bold">Saldo</th>
                                                <th class="font-weight-bold">Saldo Rata Rata</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row">1</td>
                                                <td>Amy Bond</td>
                                                <td>Developer</td>
                                                <td>
                                                    <button type="button" class="btn btn-icon btn-danger"><i class="fe fe-trash"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">2</td>
                                                <td>Elizabeth McLean</td>
                                                <td>Tester</td>
                                                <td>
                                                    <button type="button" class="btn btn-icon btn-danger"><i class="fe fe-trash"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">3</td>
                                                <td>Diana Wilkins</td>
                                                <td>Designer</td>
                                                <td>
                                                    <button type="button" class="btn btn-icon btn-danger"><i class="fe fe-trash"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Total</td>
                                                <td class="font-weight-semibold">11,000,000</td>
                                                <td class="font-weight-semibold">11,234,000</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Komponen Pendapatan Untuk Bagi Hasil --}}

                            <div class="tab-pane " id="tab6">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            {{-- <h4>Komponen Pembagi Bagi Hasil</h4> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12 col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <div class="row gutters-xs">
                                                                <div class="col-md-6"></div>
                                                                <div class="col-md-3">
                                                                    <select class="form-control">
                                                                        <option>-- Pilih --</option>
                                                                        <option>das1</option>
                                                                        <option>das2</option>
                                                                        <option>das3</option>
                                                                    </select>
                                                                </div>
                                                                <button class="btn btn-secondary mr-1" type="button"><i class="fe fe-search"></i></button>
                                                                <span class="col-auto">
                                                                    <button type="button" class="btn btn-icon btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fe fe-plus"></i></button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="">Komponen Pembagi Bagi Hasil</label>
                                                        <input type="text" class="form-control" name="komponen_pembagi_bagi_hasil"readonly>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-border border-top mb-0">
                                        <thead>
                                            <tr>
                                                <th class="font-weight-bold w-40">Akun Pendapatan</th>
                                                <th class="font-weight-bold">Pendapatan Bulan Ini</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row">1</td>
                                                <td>Developer</td>
                                                <td>
                                                    <button type="button" class="btn btn-icon btn-danger"><i class="fe fe-trash"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">2</td>
                                                <td>Tester</td>
                                                <td>
                                                    <button type="button" class="btn btn-icon btn-danger"><i class="fe fe-trash"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Total</td>
                                                <td class="font-weight-semibold">11,000,000</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Register Komponen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Akun GL/Buku Besar</label>
                        <select class="form-control" name="akun_gl_buku_besar">
                            <option value="">Pilih Akun GL/Buku Besar</option>
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                        </select>
                        {{-- <input type="text" class="form-control" id="recipient-name"> --}}
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Kirim</button>
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
