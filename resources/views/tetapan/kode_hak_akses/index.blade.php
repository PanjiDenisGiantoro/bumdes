@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Hak Akses') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Hak Akses') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Hak Akses') }}
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
                        <a style="background-color: blue" href="{{ route('kode_hak_akses.create') }}">
                            <button class="btn btn-primary">Tambah Hak Akses</button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th class="d-lg-none">&nbsp;</th>
                            <th>#</th>
                            <th>{{ __('Nama Hak Akses  ') }}</th>
                            <th>{{ __('Tindakan') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach ($KodePengguna as $i => $kode)
                                <td class="col-lg-none">{{ $KodePengguna->firstItem() + $i }}</td>
                                <td>{{$kode->name ?? ''}}</td>
                                <td class="actions">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Tindakan</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{route('kode_hak_akses.edit',$kode->id)}}"
                                                   class="dropdown-item fa fa-pencil" >&nbsp;Edit</a></li>
                                </td>
                             
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $KodePengguna->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

