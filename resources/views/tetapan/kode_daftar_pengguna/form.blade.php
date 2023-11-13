@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Daftar Pengguna') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Setting') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kode_daftar_pengguna.index') }}">{{ __('Daftar Pengguna') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Daftar Pengguna') }}</a>
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Pengguna Baru') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($kode_daftar_pengguna->id) ? route('kode_daftar_pengguna.update', [$kode_daftar_pengguna]) : route('kode_daftar_pengguna.store') }}">

                    @if (!empty($kode_daftar_pengguna->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="">{{ __('Tarikh Daftar') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input 
                                            id="" 
                                            name="" 
                                            type="text" 
                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('')]) 
                                            value="{{ old('') }}"
                                            />
                                            @error('')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                            </span>
                                             @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <!-- <div class="col-md-3"> -->
                                                <div class="col-md-3">
                                                    <label class="control-label form-label" for="">{{ __('Nama') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input 
                                                        id="" 
                                                        name="" 
                                                        type="email" 
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('')]) 
                                                        value="{{ old('') }}"
                                                    />
                                                    @error('')
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

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="">{{ __('Jabatan') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input 
                                            id="" 
                                            name="" 
                                            type="text" 
                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('')]) 
                                            value="{{ old('') }}"
                                            />
                                            @error('')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                            </span>
                                             @enderror
                                        </div>
                                    </div>
                                </div>

                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-3">
                                            <label class="control-label form-label" for="email">{{ __('Email') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input 
                                            id="email" 
                                            name="email" 
                                            type="text" 
                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('email')]) 
                                            value="{{ old('email') }}"
                                            />
                                            @error('')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                            </span>
                                             @enderror
                                        </div>
                                            <!-- <div class="col-md-3">
                                                <label class="control-label form-label" for="">{{ __('ID Login') }}</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input 
                                                    id="" 
                                                    name="" 
                                                    type="text" 
                                                    @class(['required', 'form-control', 'is-invalid' => $errors->has('')]) 
                                                    value="{{ old('') }}"
                                                />
                                                @error('')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-3">
                                            <label class="control-label form-label" for="email">{{ __('No. Handphone') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input 
                                            id="email" 
                                            name="email" 
                                            type="text" 
                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('email')]) 
                                            value="{{ old('email') }}"
                                            />
                                            @error('')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                            </span>
                                             @enderror
                                        </div>
                                            <!-- <div class="col-md-3">
                                                <label class="control-label form-label" for="">{{ __('ID Login') }}</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input 
                                                    id="" 
                                                    name="" 
                                                    type="text" 
                                                    @class(['required', 'form-control', 'is-invalid' => $errors->has('')]) 
                                                    value="{{ old('') }}"
                                                />
                                                @error('')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div> -->
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border border-top-0 text-right">
                        <a href="{{ route('kode_daftar_pengguna.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($tetapan->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection