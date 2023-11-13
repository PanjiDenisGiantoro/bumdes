@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Status Bangunan') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Status Bangunan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kode_status_bangunan.index') }}">{{ __('Status Bangunan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ !empty($KodeStatusBangunan->id) ? __('Edit Status Bangunan') : __('Tambah Status Bangunan') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ !empty($KodeStatusBangunan->id) ? __('Edit Status Bangunan') : __('Tambah Status Bangunan') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($KodeStatusBangunan->id) ? route('kode_status_bangunan.update', [$KodeStatusBangunan->id]) : route('kode_status_bangunan.store') }}">

                    @if (!empty($KodeStatusBangunan->id))
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
                                                    <label class="control-label form-label" for="">{{ __('Status Bangunan') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input
                                                        value="{{!empty($KodeStatusBangunan->status_bangunan) ? $KodeStatusBangunan->status_bangunan : ''}}"
                                                        id="status_bangunan"
                                                        name="status_bangunan"
                                                        type="text"
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('status_bangunan')])
                                                        value="{{ old('status_bangunan') }}"
                                                    />
                                                    @error('status_bangunan')
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
                        <a href="{{ route('kode_status_bangunan.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($KodeStatusBangunan->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($KodeStatusBangunan->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
