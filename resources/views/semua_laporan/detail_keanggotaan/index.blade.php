@extends('layouts.app')

@section('breadcrumb')
<x-breadcrumb title="{{ __('Detail Keanggotaan') }}">
    <li class="breadcrumb-item">
        <a href="{{ route('semua_laporan.index') }}">{{ __('Laporan') }}</a>
    </li>
    <li class="breadcrumb-item">
        {{ __('Detail Keanggotaan') }}
    </li>
</x-breadcrumb>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">&nbsp;</h3>
                <form method="get" >
                            <div class="row">
                                <div class="col-md-9">
                                    <input type="hidden" id="selectedAnggotaValue" name="id">
                                    <select id="kategori_anggota" class="form-control select2" name="id" tabindex="-1">
                                        <option value="">Kategori Anggota</option>
                                        @foreach ($kategoriAnggota as $k)
                                        <option value="{{ $k->id }}" {{ request()->query('id') == $k->id ? 'selected="selected"' : '' }}>{{ $k->status_keanggotaan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                    {{-- <div class="form-group"> --}}
                                    {{-- </div> --}}
                                <div class="col-md-2">
                                    <button id="search" class="btn btn-info">Cari</button>
                                </div>
                                </div>
                        </form>
                    <div class="card-options">
                        <a class="btn btn-primary" style="margin-right: 7px" href="{{ route('laporan-keanggotaan.index',array_merge(request()->query(), ['export' => 'pdf'])) }}" target="_blank">
                         {{-- <li><a href="{{ route('daftar_warung.show',array_merge(request()->query(), [$daftar_warung->id, 'export' => 'show'])) }}" ><i class="fa fa-eye"></i>&nbsp;&nbsp; Lihat </a></li> --}}
                        <i class="fa fa-print">&nbsp; Cetak</i>
                    </a>
                    <a class="btn btn-danger" style=" margin-right: 7px" href="">
                        {{-- <li><a href="{{ route('pemesanan_penjualan.show', array_merge(request()->query(), [$data->id ?? '', 'export' => 'pdf'])) }}" class="dropdown-item fa fa-file-pdf-o"  style="font-size: 12px" target="_blank">&nbsp;Cetak Invoice</a></li> --}}
                        <i class="fa fa-file-pdf-o">&nbsp; PDF</i>
                    </a>
                    <a class="btn btn-success" style="margin-right:7px" href="{{ route('laporan-keanggotaan.export') }}">
                        <i class="fa fa-file-excel-o">&nbsp; EXCEL</i>
                    </a>
                    {{-- <a href="{{ route('laporan.statusAnggota.show', [$kodeKategori, 'kodeKategori' => $kodeKategori, 'export' => 'pdf']) }}" class="btn btn-icon btn-outline-primary" target="_blank">--}}
                    {{-- <em class="icon ni ni-printer"></em>--}}
                    {{-- </a>--}}
                    {{-- <a href="{{ route('laporan.statusAnggota.show',  [$kodeKategori, 'kodeKategori' => $kodeKategori, 'export' => 'xlsx']) }}" class="btn btn-icon btn-outline-primary" target="_blank">--}}
                    {{-- <em class="icon ni ni-file-xls"></em>--}}
                    {{-- </a>--}}
                    </div>
            </div>

            @if($anggota)
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th class="d-lg-none">&nbsp;</th>
                            <th>No</th>
                            <th>{{ __('Nama Lengkap') }}</th>
                            <th>{{ __('No Anggota') }}</th>
                            <th>{{ __('NIK') }}</th>
                            {{-- <th>{{ __('BUMDES') }}</th> --}}
                            <th>{{ __('Tanggal Register') }}</th>
                            <th>{{ __('Kategori Keanggotaan') }}</th>
                            <th></th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($anggota as $i => $anggotas)
                        <tr>
                            <td class="col-lg-none">{{$anggota->firstItem() + $i}}</td>
                            <td>{{$anggotas->nama_pemohon ?? ''}}</td>
                            <td>{{ $anggotas->no_mitra }}</td>
                            <td>{{$anggotas->nik ?? ''}}</td>
                            {{-- <td>{{$anggotas->bumdes ?? ''}}</td> --}}
                            <td>{{\Carbon\Carbon::parse($anggotas->created_at)->format('d/m/Y') ?? ''}}</td>
                            <td>{{$anggotas->status_keanggotaans->status_keanggotaan ?? ''}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{$anggota->links()}}
            </div>
            @endif

        </div>
    </div>
</div>
@endsection

@push('scrips')

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    $(document).ready(function() {

        $('#search').on('click', function() {

            let selectedAnggota = $('#kategori_anggota').val();

            console.log(selectedAnggota)
            $('#selectedAnggotaValue').val(selectedAnggota);

            console.log("selected kategori : " + selectedAnggota);

        });

    });
</script>
    @endpush
