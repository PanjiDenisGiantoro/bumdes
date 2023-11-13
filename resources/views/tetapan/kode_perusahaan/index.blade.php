@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Profil Perusahaan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Profil Perusahaan') }}
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
                        <!-- <div class="btn-group mr-2">
                            <a class="btn btn-primary" style="background-color: blue; margin-right: 7px" href="">
                                <i class="fa fa-print">&nbsp; Cetak</i>
                            </a>
                            <a class="btn btn-primary" style="background-color: red; margin-right: 7px" href="">
                                <i class="fa fa-file-pdf-o">&nbsp; PDF</i>
                            </a>
                            <a class="btn btn-primary" style="background-color: green;  margin-right:7px" href="">
                                <i class="fa fa-file-excel-o">&nbsp; EXCEL</i>
                            </a>
                        </div> -->


                        @if(empty($kodeperusahaan[0]->id))

                        <a  style="background-color: blue" href="{{ route('kode_perusahaan.create') }}">
                            <button class="btn btn-primary">Tambah Profil Perusahaan</button>
                        </a>
                        @else

                        @endif
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th class="d-lg-none">&nbsp;</th>
                                <th>#</th>
                                <!-- <th>{{ __('No') }}</th> -->
                                <th>{{ __('Nama Perusahaan') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Nomor Handphone') }}</th>
                                <th>{{ __('Alamat Utama') }}</th>
{{--                                <th>{{ __('Alamat Penagihan') }}</th>--}}
{{--                                <th>{{ __('Nomor NPWP') }}</th>--}}
{{--                                <th>{{ __('Plafon') }}</th> -->--}}
                                <th>{{ __('Tindakan') }}</th>
                            </tr>
                        </thead>
                         <tbody>
                         @foreach($kodeperusahaan as $kode)
                            <tr>
                                <td class="col-lg-none"></td>
                                <td>{{$kode->nama_perusahaan ?? ''}}</td>
                                <td>{{$kode->email_perusahaan ?? ''}}</td>
                                <td>{{$kode->no_handphone ?? ''}}</td>
                                <td>{{$kode->alamat_utama ?? ''}}</td>
{{--                                <td>{{$kode->alamat_penagihan ?? ''}}</td>--}}
{{--                                <td>{{$kode->npwp ?? ''}}</td>--}}
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-dribbble dropdown-toggle btn-sm" data-toggle="dropdown" title="Aksi">
                                            Tindakan
                                        </button>
                                        <div class="dropdown-menu">
                                            <li><a href="{{route('kode_perusahaan.edit', [$kode->id])}}" class="dropdown-item fa fa-pencil"  style="background-color: blue"> &nbsp;Lihat</a></li>
                                        </div>
                                    </div>

                                </td>
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
