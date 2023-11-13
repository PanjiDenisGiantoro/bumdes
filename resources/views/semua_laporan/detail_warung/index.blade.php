@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Detail Warung') }}">
    	<li class="breadcrumb-item">
            <a href="{{ route('semua_laporan.index') }}">{{ __('Laporan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Detail Warung') }}
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
                                    <select id="kategori_anggota" class="form-control select2" name="status_aktif" tabindex="-1">
                                        <option value="">Kategori Anggota</option>
                                        @foreach ($kategori_warung as $k)
                                        <option value="{{ $k->status_aktif }}" {{ request()->query('status_aktif') == $k->status_aktif ? 'selected="selected"' : '' }}>{{ $k->status_aktif_text }}</option>
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
                        <a class="btn btn-primary" style="margin-right: 7px" href="{{ route('laporan-warung.index',array_merge(request()->query(), ['export' => 'pdf'])) }}" target="_blank">
                         {{-- <li><a href="{{ route('daftar_warung.show',array_merge(request()->query(), [$daftar_warung->id, 'export' => 'show'])) }}" ><i class="fa fa-eye"></i>&nbsp;&nbsp; Lihat </a></li> --}}
                        <i class="fa fa-print">&nbsp; Cetak</i>
                    </a>
                    <a class="btn btn-danger" style=" margin-right: 7px" href="">
                        {{-- <li><a href="{{ route('pemesanan_penjualan.show', array_merge(request()->query(), [$data->id ?? '', 'export' => 'pdf'])) }}" class="dropdown-item fa fa-file-pdf-o"  style="font-size: 12px" target="_blank">&nbsp;Cetak Invoice</a></li> --}}
                        <i class="fa fa-file-pdf-o">&nbsp; PDF</i>
                    </a>
                    <a class="btn btn-success" style="margin-right:7px" href="{{ route('laporan-warung.export') }}">
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
                                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th class="d-lg-none">&nbsp;</th>
                            <th>No</th>
                        <!-- <th>{{ __('No') }}</th> -->
                            <th>{{ __('Tanggal Register') }}</th>
                            <th>{{ __('No Anggota') }}</th>
                            <th>{{ __('Nama Lengkap') }}</th>
                            <th>{{ __('NIK') }}</th>
                            <th>{{ __('Provinsi') }}</th>
                            <th>{{ __('Bumdes') }}</th>
                            <th>{{ __('Nama Warung') }}</th>
                            <th>{{ __('Status Warung') }}</th>
{{--                            <th>{{ __('Profil Warong') }}</th>--}}
{{--                            <th>{{ __('Berita Acara') }}</th>--}}
                        <!-- <th>{{ __('Tgl. Jatuh Tempo') }}</th>
                                <th>{{ __('Plafon') }}</th> -->
{{--                            <th>{{ __('Tindakan') }}</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach ($daftar_warungs as $i => $daftar_warung)
                                <td class="col-lg-none">{{ $daftar_warungs->firstItem() + $i }}</td>
                                <td>{{\Carbon\Carbon::parse($daftar_warung->tanggal)->format('d/m/Y') ?? ''}}</td>
                                <td>{{ $daftar_warung->anggota->no_mitra ?? '' }}</td>
                                <td>{{ $daftar_warung->anggota->nama_pemohon ?? '' }}</td>
                                <td>{{ $daftar_warung->anggota->nik ?? '' }}</td>
                                <td>{{ $daftar_warung->alamat_sama ? ($daftar_warung->anggota->province ?? '') : ($daftar_warung->province->name ?? '') }}</td>
                                <td>{{ $daftar_warung->anggota->bumdes ?? '' }}</td>
                                <td>{{ $daftar_warung->nama_warung ?? ''}}</td>
                                <td>{{ $daftar_warung->status_aktif_text ?? ''}}</td>
{{--                                <td>--}}
{{--                                    <a href="{{ route('daftar_warung.show', array_merge(request()->query(), [$daftar_warung->id, $daftar_warung->nama_warung, 'export' => 'pdf'])) }}" target="_blank" class="btn btn-info fa fa-file-pdf-o"></a>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    @if ($daftar_warung->anggota->pembiayaan->count())--}}
{{--                                        <a href="{{ route('daftar_warung.show2', array_merge(request()->query(), [$daftar_warung->id, 'export' => 'pdf'])) }}" target="_blank" class="btn btn-info fa fa-file-pdf-o" style="background-color: orange"></a>--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                                <td class="actions">--}}
{{--                                    <a href="{{ route('daftar_warung.show',array_merge(request()->query(), [$daftar_warung->id, 'export' => 'show'])) }}" class="btn btn-primary fa fa-eye"></a>--}}
{{--                                    <a href="{{ route('daftar_warung.edit', $daftar_warung->id) }}" class="btn btn-success fa fa-pencil"></a>--}}
{{--                                </td>--}}
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
                <div class="card-footer">
                    {{ $daftar_warungs->links() }}
                </div>

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
