@extends('layouts.app')

@section('breadcrumb')
<x-breadcrumb title="{{ __('Setting Bagi Hasil') }}">
    <li class="breadcrumb-item">
        <a href="{{ route('tetapan.index') }}">{{ __('Setting') }}</a>
    </li>
    <li class="breadcrumb-item">
        {{ __('Setting Bagi Hasil') }}
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

            <div class="panel panel-primary">

                <div class="tab-menu-heading">
                    <div class="tabs-menu ">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            
                            @php
                                $tabs = ['Komponen Pembagi Bagi Hasil Simpanan', 'Komponen Pendapatan Untuk Bagi Hasil Simpanan'];
                            @endphp
                            @foreach ($tabs as $i => $tab)
                            <li class="nav-item">
                                <a class="nav-link {{ request()->query('tab', 0) == $i ? 'active' : '' }}" href="{{ url()->current() }}?tab={{ $i }}">
                                    {{ $tab }}
                                </a>
                            </li>
                            @endforeach

                            <!-- <li><a href="#tab1"class="active"  data-toggle="tab">Komponen Pembagi Bagi Hasil Simpanan</a></li>
                            <li><a href="#tab2" data-toggle="tab">Komponen Pendapatan Untuk Bagi Hasil Simpanan</a></li> -->
                        </ul>
                    </div>
                </div>

                <div class="panel-body tabs-menu-body">
                    <div class="tab-content">
                        <div class="tab-pane active " id="tab1">
                            <div class="row">
                                <div class="col-md-9 col-lg-9">
                                    <div class="form-group ml-4 mt-4">
                                        <!-- <h3>Komponen Pembagi Bagi Hasil Simpanan</h3> -->
                                        <h3>{{ $tabs[request()->query('tab', 0)] }}</h3>
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3 " style="float:right;" >
                                    <div class="form-group ml-10 mt-4">
                                        <div class="row gutters-xs">
                                            <div class="col-lg-10">
                                                <select class="form-control select2" name="month" disabled>
                                                    <option value="01" {{ $currentMonth == '1' ? 'selected' : '' }}>Januari</option>
                                                    <option value="02" {{ $currentMonth == '2' ? 'selected' : '' }}>Februari</option>
                                                    <option value="03" {{ $currentMonth == '3' ? 'selected' : '' }}>Maret</option>
                                                    <option value="04" {{ $currentMonth == '4' ? 'selected' : '' }}>April</option>
                                                    <option value="05" {{ $currentMonth == '5' ? 'selected' : '' }}>Mei</option>
                                                    <option value="06" {{ $currentMonth == '6' ? 'selected' : '' }}>Juni</option>
                                                    <option value="07" {{ $currentMonth == '7' ? 'selected' : '' }}>Juli</option>
                                                    <option value="08" {{ $currentMonth == '8' ? 'selected' : '' }}>Agustus</option>
                                                    <option value="09" {{ $currentMonth == '9' ? 'selected' : '' }}>September</option>
                                                    <option value="10" {{ $currentMonth == '10' ? 'selected' : '' }}>Oktober</option>
                                                    <option value="11" {{ $currentMonth == '11' ? 'selected' : '' }}>November</option>
                                                    <option value="12" {{ $currentMonth == '12' ? 'selected' : '' }}>Desember</option>
                                                </select>
                                            </div>
                                            <span class="col-auto">
                                                <!-- <button class="btn btn-secondary" type="button">Cari</button> -->
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#pembagibagihasil" type="button"><i class="fa fa-plus"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-border border-top mb-0">
                                        <thead>
                                            @if (request()->query('tab', 0) == 0)
                                            <tr>
                                                <th>PRODUK SIMPANAN</th>
                                                <th>SALDO</th>
                                                <th>SALDO RATA RATA</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                            @else 
                                            <tr>
                                                <th>AKAUN PENDAPATAN</th>
                                                <th>PENDAPATAN BULAN INI</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                            @endif
                                        </thead>
                                        <tbody>
                                            @foreach($componentList as $component)
                                                <tr>
                                                    <td>{{ $component->gl->kode }} &mdash; {{ $component->gl->nama }}</td>
                                                    @if (request()->query('tab', 0) == 0)
                                                    <td>{{ !empty($component->gl->saldo) ? ($component->gl->saldo == 0 ? '0.00' : number_format($component->gl->saldo)) : '0.00' }}</td>
                                                    <td>{{ !empty($component->saldo_rata_rata) ? ($component->saldo_rata_rata == 0 ? '0.00' : number_format($component->saldo_rata_rata)) : '0.00' }}</td>
                                                    @else
                                                    <td>{{ !empty($component->saldo) ? ($component->saldo == 0 ? '0.00' : number_format($component->saldo)) : '0.00' }}</td>
                                                    @endif
                                                    <td class="nk-tb-col nk-tb-col-tools">
                                                        <form action="{{ route('bagi-hasil.setting.destroy', $component->id) }}" method="POST" onsubmit="return confirm('Hapus {{ $component->gl->nama ?? '' }} ?')">
                                                            {{ method_field('DELETE') }}
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="btn btn-icon btn-outline-danger"><i class="fe fe-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td class="font-weight-bold">TOTAL </td>
                                                @if (request()->query('tab', 0) == 0)
                                                    <td class="font-weight-semibold">{{ 
                                                        number_format(
                                                            $componentList->reduce(function ($carry, $component) {
                                                                return $carry + $component->gl->saldo;
                                                            })
                                                        )
                                                    }}</td>

                                                @else

                                                    <td class="font-weight-semibold">{{ 
                                                        number_format(
                                                            $componentList->reduce(function ($carry, $component) {
                                                                return $carry + $component->saldo;
                                                            })
                                                        )
                                                    }}</td>

                                                @endif
                                                
                                <!-- <td>
                                </td> -->
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

<form method="POST" action="{{ route('bagi-hasil.setting.store') }}">
    @csrf
    <div class="modal fade" id="pembagibagihasil"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Register Komponen Pembagi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="jenis" value="{{ request()->query('tab', 0) }}" />
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">Akun GL/Buku Besar</label>
                            <select class="form-control select2" name="gl_id">
                                <option value="">Pilih Akun GL/Buku Besar</option>
                                @foreach($allGL as $item)
                                    <option value="{{ $item->id }}">{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $item->depth) !!}{{ $item->kode }} &mdash; {{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </div>
        </div>
    </div>
</form>





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

<script>
    // select2
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
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
