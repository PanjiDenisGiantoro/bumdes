@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Rekening Pendanaan') }}">
        <li class="breadcrumb-item">
            {{ __('Rekening Pendanaan') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Rekening Pendanaan</h3>
                    <!-- <div class="card-options">
                        <a class="btn btn-primary" href="{{ route('rekening-pembiayaan.create') }}">
                          Tambah Rekening Pembiayaan
                        </a>
                    </div> -->
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('No. Rekening') }}</th>
                                <th>{{ __('Anggota') }}</th>
                                <th>{{ __('Pendana') }}</th>
                                <th>{{ __('Batch') }}</th>
                                <th>{{ __('Plafond') }}</th>
                                <th>{{ __('Jkt. Waktu') }}</th>
                                <th>{{ __('Sisa Pembiayaan') }}</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($daftarRekening as $i => $rekening)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $rekening->no_akun ?? '-'}}</td>
                                <td>{{ $rekening->anggota->nama_pemohon ?? '-' }}</td>
                                <td>{{ $rekening->pendanaan->pendana->nama_pendana ?? '-' }}</td>
                                <td>Batch {{ $rekening->pendanaan->batch ?? '-' }}</td>
                                <td>Rp {{ number_format($rekening->nilai_pembiayaan) ?? '-' }}</td>
                                <td>{{ $rekening->jangka_waktu ?? '-' }} Bulan</td>
                                <td> {{ !empty($rekening->saldo) ? 'Rp ' . number_format($rekening->saldo) : '-' }}</td>
                                <td class="actions">
                                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ route('rekening-pendanaan.show', [$rekening->id]) }}"><i class="fa fa-eye"></i>&nbsp;&nbsp; Lihat</a></li>
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
{{--                {{$simpananList->links()}}--}}
                </div>
            </div>
        </div>
    </div>
@endsection
