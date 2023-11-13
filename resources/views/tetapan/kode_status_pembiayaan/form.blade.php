@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Tipe Pendanaan') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __(' Tipe Pendanaan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kode_status_pembiayaan.index') }}">{{ __(' Tipe Pendanaan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ !empty($KodeStatusPembiayaan->id) ? __('Edit Tipe Pendanaan') : __('Tambah Tipe Pendanaan') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ !empty($KodeStatusPembiayaan->id) ? __('Edit Tipe Pendanaan') : __('Tambah Tipe Pendanaan') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($KodeStatusPembiayaan->id) ? route('kode_status_pembiayaan.update', [$KodeStatusPembiayaan->id]) : route('kode_status_pembiayaan.store') }}">

                    @if (!empty($KodeStatusPembiayaan->id))
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
                                                    <label class="control-label form-label" for="kode_status_pembiayaan">{{ __('Tipe Pendanaan') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input
                                                        value="{{!empty($KodeStatusPembiayaan->status_pembiayaan) ? $KodeStatusPembiayaan->status_pembiayaan : ''}}"

                                                        id="status_pembiayaan"
                                                        name="status_pembiayaan"
                                                        type="text"
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('status_pembiayaan')])
                                                    />
                                                    @error('status_pembiayaan')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>

                                        <!-- <div class="col-md-2">
                                            <label class="control-label form-label" for="no_mitra">{{ __('No. Mitra') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                id="no_mitra"
                                                name=""
                                                type="text"
                                                class="form-control"
                                                readonly
                                            />
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border border-top-0 text-right">
                        <a href="{{ route('kode_status_pembiayaan.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($KodeStatusPembiayaan->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($KodeStatusPembiayaan->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
