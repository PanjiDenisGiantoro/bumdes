@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Informasi Kode Kas Arus Aktivitas') }}">
        <!-- <li class="breadcrumb-item">
            <a href="{{ route('transaksi_keuangan.index') }}">{{ __('Keuangan') }}</a>
        </li> -->
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Setting') }}</a>
        </li>
         <li class="breadcrumb-item">
            <a href="{{ route('kode_kas_arus_aktivitas.index') }}">{{ __('Kode Kas Arus Aktivitas') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Kode Kas Arus Aktivitas') }}</a>
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Kode Kas Arus Aktivitas') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($kode_kas_arus_aktivitas->id) ? route('kode_kas_arus_aktivitas.update', [$kode_kas_arus_aktivitas]) : route('kode_kas_arus_aktivitas.store') }}">

                    @if (!empty($kode_kas_arus_aktivitas->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                    	<div class="col-md-3">
                                            <label class="control-label form-label" for="arus_kas_aktifitas">{{ __('Arus Kas Aktifitas') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="kode_arus_kas_aktifitas" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="row">
                                    	<div class="col-md-3">
                                                <label class="control-label form-label" for="keterangan">{{ __('Keterangan') }}</label>
                                            </div>
                                            <div class="col-md-9">
                                                <textarea
                                                    id="keterangan"
                                                    name="keterangan"
                                                    @class(['required', 'form-control', 'is-invalid' => $errors->has('keterangan')])
                                                    rows="5"
                                                >{{ old('nama_warung') }}</textarea>
                                                @error('keterangan')
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
                    	<a href="{{ route('kode_kas_arus_aktivitas.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Batal') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($kode_kas_arus_aktivitas->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
