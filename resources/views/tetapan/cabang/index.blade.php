@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Cabang') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Cabang') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Cabang') }}
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                <a href="{{ route('tetapan.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Kembali') }}</a>
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



                        <a  style="background-color: blue" href="{{ route('cabang.create') }}">
                            <button class="btn btn-primary">Tambah Cabang</button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th class="d-lg-none">&nbsp;</th>
                                <th>#</th>
                                <!-- <th>{{ __('No') }}</th> -->
                                <!-- <th>{{ __('Kode Koperasi') }}</th>s -->
                                <th>{{ __('Kode Cabang') }}</th>
                                <th>{{ __('Nama Cabang') }}</th>
                                <th>{{ __('Jenis Cabang') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Nomor Handphone') }}</th>
                                <th>{{ __('PIC') }}</th>
                                <th>{{ __('Tanggal Operasi') }}</th>
                                <th> Tindakan</th>
                            </tr>
                        </thead>
                         <tbody>
                         @foreach($cabang as $i => $kode)
                            <tr>
                                <td class="col-lg-none">{{$cabang->firstItem() + $i}}</td>
                                <!-- <td>{{$kode->kode_koperasi ?? ''}}</td> -->
                                <td>{{$kode->kode_cabang ?? ''}}</td>
                                <td>{{$kode->nama_cabang ?? ''}}</td>
                                <td>{{$kode->jenis_cabang ?? ''}}</td>
                                <td>{{$kode->email ?? ''}}</td>
                                <td>{{$kode->no_telp ?? ''}}</td>
                                <td>{{$kode->pic ?? ''}}</td>
                                <td>
                                    {{date('d/m/Y', strtotime($kode->tanggal_operasi))}}
                                </td>
{{--                                <td>@if($kode->status_cabang == 0)Tidak Aktif @else Aktif @endif</td>--}}

                                <td class="actions">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Tindakan</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{route('cabang.edit', [$kode->id])}}" class="dropdown-item fa fa-pencil" >&nbsp;Edit</a></li>
{{--                                            <li><a href="{{route('cabang.updatestatus', [$kode->id])}}" class="dropdown-item btn btn-@if($kode->status_cabang == 0) @else  @endif fa @if($kode->status_cabang == 0)fa-times-circle @else fa-check @endif">Disetujui</a></li>--}}

                                </td>
                              
                            </tr>
                         @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{$cabang->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
