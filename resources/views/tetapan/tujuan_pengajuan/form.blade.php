@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Tujuan Pengajuan') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Tujuan Pengajuan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('tujuan_pengajuan.index') }}">{{ __('Tujuan Pengajuan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Tujuan Pengajuan') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Tujuan Pengajuan') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($tujuan_pengajuan->id) ? route('tujuan_pengajuan.update', [$tujuan_pengajuan->id]) : route('tujuan_pengajuan.store') }}">

                    @if (!empty($tujuan_pengajuan->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <!-- <div class="col-md-3"> -->
                                                <div class="col-md-3">
                                                    <label class="control-label form-label" for="">{{ __('Tujuan Pengajuan') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input
                                                        value="{{!empty($tujuan_pengajuan->nama_tujuan_pengajuan) ? $tujuan_pengajuan->nama_tujuan_pengajuan : ''}}"
                                                        id="nama_tujuan_pengajuan"
                                                        name="nama_tujuan_pengajuan"
                                                        type="text"
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_tujuan_pengajuan')])
                                                        value="{{ old('nama_tujuan_pengajuan') }}"
                                                    />
                                                    @error('nama_tujuan_pengajuan')
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
                        <a href="{{ route('tujuan_pengajuan.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($tujuan_pengajuan->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($tujuan_pengajuan->id) ? __('Perbarui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
