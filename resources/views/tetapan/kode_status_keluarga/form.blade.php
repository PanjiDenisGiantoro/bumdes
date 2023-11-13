@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Status Dalam Keluarga') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __(' Status Dalam Keluarga') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kode_status_keluarga.index') }}">{{ __(' Status Dalam Keluarga') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ !empty($KodeStatusKeluarga->id) ? __('Edit Status Dalam Keluarga') : __('Tambah Status Dalam Keluarga') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ !empty($KodeStatusKeluarga->id) ? __('Edit Status Dalam Keluarga') : __('Tambah Status Dalam Keluarga') }}</h5>
                <form method="POST" class="form-horizontal" action="{{ !empty($KodeStatusKeluarga->id) ? route('kode_status_keluarga.update', [$KodeStatusKeluarga->id]) : route('kode_status_keluarga.store') }}">
                    @if (!empty($KodeStatusKeluarga->id))
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
                                                    <label class="control-label form-label" for="">{{ __('Status Dalam Keluarga') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input
                                                        value="{{!empty($KodeStatusKeluarga->status_dalam_keluarga) ? $KodeStatusKeluarga->status_dalam_keluarga : ''}}"
                                                        id="status_dalam_keluarga"
                                                        name="status_dalam_keluarga"
                                                        type="text"
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('status_dalam_keluarga')])
                                                        value="{{ old('status_dalam_keluarga') }}"
                                                    />
                                                    @error('status_dalam_keluarga')
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
                        <a href="{{ route('kode_status_keluarga.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($KodeStatusKeluarga->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($KodeStatusKeluarga->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
