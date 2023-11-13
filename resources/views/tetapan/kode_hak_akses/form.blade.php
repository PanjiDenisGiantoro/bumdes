@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Hak Akses') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Hak Akses') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kode_hak_akses.index') }}">{{ __('Hak Akses') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Hak Akses') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Hak Akses') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($kode_hak_akses->id) ? route('kode_hak_akses.update', [$kode_hak_akses]) : route('kode_hak_akses.store') }}">

                    @if (!empty($kode_hak_akses->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="control-label form-label" for="nama_perusahaan">{{ __('Nama Hak Akses') }}</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input
                                                id="nama_perusahaan"
                                                type="text"
                                                name="name"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_perusahaan')])
                                                />
                                                @error('nama_perusahaan')
                                                <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border border-top-0 text-right">
                        <a href="{{ route('kode_hak_akses.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($tetapan->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
