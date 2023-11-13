@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Pembiayaan') }}">
        <li class="breadcrumb-item">
            {{ __('Pembiayaan') }}
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
                            <a class="btn btn-outline-secondary" href="">
                                <i class="fa fa-print"></i>
                            </a>
                            <a class="btn btn-outline-secondary" href="">
                                <i class="fa fa-file-pdf-o"></i>
                            </a>
                            <a class="btn btn-outline-secondary" href="">
                                <i class="fa fa-file-excel-o"></i>
                            </a>
                        </div>

                        <a class="btn btn-outline-primary" href="{{ route('pembiayaan.create') }}">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th class="d-lg-none">&nbsp;</th>
                                <th>#</th>
                                <th>{{ __('Tgl. Pengajuan') }}</th>
                                <th>{{ __('Tgl. Diluluskan') }}</th>
                                <th>{{ __('Batch') }}</th>
                                <th>{{ __('Nama') }}</th>
                                <th>{{ __('NIK') }}</th>
                                <th>{{ __('No. Rekening') }}</th>
                                <th>{{ __('Jangka Waktu') }}</th>
                                <th>{{ __('Tgl. Jatuh Tempo') }}</th>
                                <th>{{ __('Plafon') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembiayaans as $pembiayaan)
                            <tr>
                                <td class="col-lg-none"></td>
                                <td>{{ $pembiayaans->firstItem() }}</td>
                                <td></td>
                                <td></td>
                                <td>{{ $pembiayaan->batch }}</td>
                                <td>{{ $pembiayaan->warung->nama_pemohon }}</td>
                                <td>{{ $pembiayaan->warung->nik ?? '' }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
@endsection
