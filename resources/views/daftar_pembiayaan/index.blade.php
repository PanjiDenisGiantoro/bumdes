@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Daftar Pendanaan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('daftar_pembiayaan.index') }}">{{ __('Pendanaan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Daftar Pendanaan') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">&nbsp;</h3>
                    <div class="card-options">
                        <div class="btn-group mr-2">
                        </div>

                        <a style="background-color: blue" href="{{ route('daftar_pembiayaan.create') }}">
                            <button class="btn btn-primary">Tambah  Pendanaan</button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table ">
                        <thead class="text-white">
                            <tr>
                                <th class="text-white bg-primary" colspan="8" style="text-align: center;font-size: 20px;">
                                    PENGAJUAN BARU
                                </th>
                                <th class="text-white bg-warning" colspan="5" style="text-align: center;font-size: 20px">
                                    PERSETUJUAN
                                </th>
                                <th class="text-white bg-info" colspan="4" style="text-align: center;font-size: 20px">
                                    PEMBIAYAAN
                                </th>
                            </tr>
                            <tr>
                                <th>No</th>
                                <th>{{ __('Tgl Pengajuan') }}</th>
                                <th>{{ __('Dana Penyaluran') }}</th>
                                <th>{{ __('Batch') }}</th>
                                <th>{{ __('Nama') }}</th>
                                <th>{{ __('NIK') }}</th>
                                <th>{{ __('No Anggota') }}</th>
                                <th>{{ __('Plafon Pengajuan') }}</th>
                                <th>{{ __('Status') }}</th>
                                <!-- <th>{{ __('Dana Penyaluran') }}</th> -->
                                <th>{{ __('Tgl. Persetujuan') }}</th>
                                <th>{{ __('Plafon Disetujui') }}</th>
                                <th>{{ __('No. Pendanaan') }}</th>
                                <th>{{ __('Jangka Waktu (bulan)') }}</th>
                                <th>{{ __('Tgl Mulai Angsuran') }}</th>
                                <th>{{ __('Tgl Jatuh Tempo') }}</th>
                                <th>{{ __('Angsuran Perbulan') }}</th>
                                <th style="text-align: center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daftar as $i => $daf)
                            <tr>
                                <td class="col-lg-none">{{ $daftar->firstItem() + $i }}</td>
                                <td>{{ $daf->created_at->format('d-m-Y') ?? '' }}</td> <!-- // Tanggal Pengajuan -->
                                <td>{{ $daf->batchs->pendana->nama_pendana ?? '-' }}</td> <!-- // Dana Penyaluran -->
                                <td>{{ $daf->batchs->batch ?? '' }}</td> <!-- // Batch -->
                                <td>{{ $daf->anggota->nama_pemohon ?? '' }}</td> <!-- // Nama -->
                                <td>{{ $daf->nik ?? '' }}</td> <!-- // NIK -->
                                <td>{{ $daf->no_mitra ?? '' }}</td> <!-- // No Anggota -->
                                <td>{{ !empty($daf->batchs->nominal_dana) ? number_format($daf->batchs->nominal_dana) : '' }}</td> <!-- // Plafon Pengajuan' -->
                                <td> <!-- // Status -->
                                    @if ($daf->status == \App\Models\DaftarPembiayaan::STATUS_PENDING)
                                        <span class="badge badge-warning mt-2">{{ $daf->status ?? '' }}</span>
                                    @elseif ($daf->status == \App\Models\DaftarPembiayaan::STATUS_APPROVED)
                                        <span class="badge badge-success mt-2">{{ $daf->status ?? '' }}</span>
                                    @elseif ($daf->status == \App\Models\DaftarPembiayaan::STATUS_REJECTED)
                                        <span class="badge badge-danger mt-2">{{ $daf->status ?? '' }}</span>
                                    @endif
                                </td>
                                <td>{{ !empty($daf->batchs->tanggal_kelulusan) ? $daf->batchs->tanggal_kelulusan->format('d-m-Y') : '-' }}</td> <!-- // Tanggal Persetujuan -->
                                <td>{{ !empty($daf->batchs->nominal_dana) ? number_format($daf->batchs->nominal_dana) : '' }}</td> <!-- // Plafon Pengajuan' -->
                                <td>{{ $daf->rekeningPendanaan->no_akun ?? ''}}</td> <!-- // No Pendanaan -->
                                <td>{{ $daf->batchs->jangka_waktu ?? ''}}</td> <!-- // Jangka Waktu -->
                                <td>{{ !empty($daf->batchs->tanggal_angsuran) ? $daf->batchs->tanggal_angsuran : '-' }}</td> <!-- // Tanggal Mulai Angsuran -->
                                <td>{{ !empty($daf->batchs->tanggal_jatuh_tempo) ? $daf->batchs->tanggal_jatuh_tempo->format('d-m-Y') : '-' }}</td> <!-- // Tanggal Jatuh Tempo -->
                                <td>{{ !empty($daf->batchs->angsuran_bulanan) ? number_format($daf->batchs->angsuran_bulanan) : '-' }}</td> <!-- // Angsuran Perbulan -->
                                <td class="actions"><!-- // Tindakan -->
                                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ route('daftar_pembiayaan.show',$daf->id) }}"><i class="fa fa-eye"></i>&nbsp;&nbsp; Lihat</a></li>
                                        <li><a href="{{ route('daftar_pembiayaan.edit',$daf->id) }}"><i class="fa fa-pencil"></i>&nbsp;&nbsp; Edit</a></li>
                                        <li><a href="{{ route('daftar_pembiayaan.cetak',$daf->id) }}"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp; Cetak</a></li>
                                    </ul>
                                </td>
                                <!-- <td class="actions"> 
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-dribbble dropdown-toggle btn-sm" data-toggle="dropdown" title="Aksi">
                                            Tindakan
                                        </button>
                                        <div class="dropdown-menu">
                                            <li><a href="{{ route('daftar_pembiayaan.showup',$daf->id) }}"
                                            class="dropdown-item  fa fa-address-book"
                                                >&nbsp;Rincian</a></li>
                                            <li><a href="{{ route('daftar_pembiayaan.show',$daf->id) }}"
                                            class="dropdown-item  fa fa-eye">&nbsp;Show</a></li>
                                            <li><a href="{{ route('daftar_pembiayaan.edit',$daf->id) }}"
                                                class="dropdown-item  fa fa-pencil">&nbsp;Edit</a></li>
                                            <li><a href="{{ route('daftar_pembiayaan.cetak',$daf->id) }}"
                                            class="dropdown-item  fa fa-file-pdf-o"
                                            target="_blank"
                                                >&nbsp;Cetak</a></li>
                                        </div>
                                    </div>
                                </td> -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $daftar->links() }}
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
@endsection
