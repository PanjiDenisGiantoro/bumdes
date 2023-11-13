@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Detail Pendanaan') }}">
    	<li class="breadcrumb-item">
            <a href="{{ route('semua_laporan.index') }}">{{ __('Laporan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Detail Pendanaan') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">&nbsp;</h3>
                    <div class="card">
                        <div class="btn-group mr-2">
                            <div class="form-inline">
                                <form>

                                <div class="form-group">
                                    <input type="hidden" id="selectedAnggotaValue" name="id">
                                    <select id="kategori_anggota" class="form-control select2" name="id" tabindex="-1">
                                        <option value="">Kategori Pengajuan</option>
                                        <option value="">Ditolak</option>
                                        <option value="">Ditunda</option>
                                        <option value="">Diterima</option>

                                    </select>
                                    <div class="form-group ml-5">
                                        <button id="search" class="btn  btn-info">Cari</button>
                                    </div>
                                </div>

                                </form>

                                <div class="btn-group ml-5">
                                    <a class="btn btn-primary" style="background-color: blue; margin-right: 7px" href="">
                                        <i class="fa fa-print">&nbsp; Cetak</i>
                                    </a>
                                    <a class="btn btn-primary" style="background-color: red; margin-right: 7px" href="">
                                        <i class="fa fa-file-pdf-o">&nbsp; PDF</i>
                                    </a>
                                    <a class="btn btn-primary" style="background-color: green;  margin-right:7px" href="">
                                        <i class="fa fa-file-excel-o">&nbsp; EXCEL</i>
                                    </a>
{{--                                    <a href="{{ route('laporan.statusAnggota.show', [$kodeKategori, 'kodeKategori' => $kodeKategori, 'export' => 'pdf']) }}" class="btn btn-icon btn-outline-primary" target="_blank">--}}
{{--                                        <em class="icon ni ni-printer"></em>--}}
{{--                                    </a>--}}
{{--                                    <a href="{{ route('laporan.statusAnggota.show',  [$kodeKategori, 'kodeKategori' => $kodeKategori, 'export' => 'xlsx']) }}" class="btn btn-icon btn-outline-primary" target="_blank">--}}
{{--                                        <em class="icon ni ni-file-xls"></em>--}}
{{--                                    </a>--}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table ">
                        <thead class=" text-white">
                        <tr>
                            <th class="text-white bg-primary" colspan="9" style="text-align: center;font-size: 20px;">
                                PENGAJUAN BARU
                            </th>
                            <th class="text-white bg-warning" colspan="4" style="text-align: center;font-size: 20px">
                                PERSETUJUAN
                            </th>
                            <th class="text-white bg-info" colspan="7" style="text-align: center;font-size: 20px">
                                PEMBIAYAAN
                            </th>
                        </tr>
                        <tr>
                            <th>No</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Tanggal Pengajuan') }}</th>
                            <th>{{ __('Batch') }}</th>
                            <th>{{ __('Nama') }}</th>
                            <th>{{ __('NIK') }}</th>
                            <th>{{ __('No Mitra') }}</th>
                            <th>{{ __('Plafon Pengajuan') }}</th>
                            <th>{{ __('Dana Penyaluran') }}</th>
                            <th>{{ __('Tanggal Persetujuan') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Nomor Rekening') }}</th>
                            <th>{{ __('Plafon Disetujui') }}</th>
                            <th>{{ __('Jangka Waktu') }}</th>
                            <th>{{ __('Tanggal Jatuh Tempo') }}</th>
                            <th>{{ __('Angsuran Perbulan') }}</th>
                            <th>{{ __('Tanggal Mulai Angsuran') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach ($daftar as $i => $daf)
                                <td class="col-lg-none">{{ $daftar->firstItem() + $i }}</td>
                                <td>{{$daf->status ?? ''}}</td>
                                <td>{{\Carbon\Carbon::parse($daf->tanggal_permohonan)->format('d/m/Y') ?? ''}}</td>
                                <td>{{$daf->batch ?? ''}}</td>
                                <td>{{$daf->anggota->nama_pemohon ?? ''}}</td>
                                <td>{{$daf->nik ?? ''}}</td>
                                <td>{{$daf->no_mitra ?? ''}}</td>
                                <td>{{number_format($daf->plafon) ?? ''}}</td>
                                <td>{{$daf->sumber_pendanaan->nama_sumber_pendanaan ?? ''}}</td>
                                <td> @if(empty($daf->tanggal_disetujui))  @else {{\Carbon\Carbon::parse($daf->tanggal_disetujui)->format('d/m/Y')}} @endif</td>
                                @if(!empty($daf->hasil_pengajuan == 'diterima'))
                                    <td ><a href="" class="btn btn-success">{{ucfirst($daf->hasil_pengajuan) ?? ''}}</a></td>
                                @elseif(!empty($daf->hasil_pengajuan == 'tertunda'))
                                    <td ><a href="" class="btn btn-yellow">{{ucfirst($daf->hasil_pengajuan) ?? ''}}</a></td>
                                @elseif(!empty($daf->hasil_pengajuan == 'ditolak'))
                                    <td ><a href="" class="btn btn-red">{{ucfirst($daf->hasil_pengajuan) ?? ''}}</a></td>
                                @else
                                    <td></td>
                                @endif

                                <td>{{$daf->no_rekening ?? ''}}</td>
                                <td>@if(!empty($daf->plafon_disetujui)){{number_format($daf->plafon_disetujui) ?? ''}}@endif</td>
                                <td>{{$daf->jangka_waktu ?? ''}}</td>
                                <td>@if(empty($daf->tanggal_jatuh_tempo))  @else {{\Carbon\Carbon::parse($daf->tanggal_jatuh_tempo)->format('d/m/Y')}} @endif</td>
                                <td>@if(!empty($daf->angsuran_perbulan)){{number_format($daf->angsuran_perbulan) ?? ''}}@endif</td>
                                <td>@if(empty($daf->tanggal_mulai_angsuran))  @else {{\Carbon\Carbon::parse($daf->tanggal_mulai_angsuran)->format('d/m/Y')}} @endif</td>

                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="card-footer">
                    {{ $daftar->links() }}
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

@endpush
