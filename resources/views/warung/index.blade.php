@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Daftar Warung') }}">
        <li class="breadcrumb-item">
            {{ __('Daftar Warung') }}
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

                        <a class="btn btn-outline-primary" href="{{ route('warung.create') }}">
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
                                <th>{{ __('No. Mitra') }}</th>
                                <th>{{ __('Nama Lengkap') }}</th>
                                <th>{{ __('NIK') }}</th>
                                <th>{{ __('Pembiayaan/Investor') }}</th>
                                <th>{{ __('No. Telpon/HP') }}</th>
                                <th>{{ __('Nama Suami/Isteri') }}</th>
                                <th>{{ __('NIK') }}</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($warungs as $warung)
                            <tr>
                                <td class="d-lg-none"></td>
                                <td>{{ $warungs->firstItem() }}</td>
                                <td></td>
                                <td>{{ $warung->nama_pemohon }}</td>
                                <td>{{ $warung->nik ?? '' }}</td>
                                <td></td>
                                <td>{{ implode('/', array_filter([$warung->no_handphone ?? '', $warung->no_telpon ?? ''])) }}</td>
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
