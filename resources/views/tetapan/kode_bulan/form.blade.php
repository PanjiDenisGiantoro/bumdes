@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Kode Bulan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Setting') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kode_bulan.index') }}">{{ __('Kode Bulan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Bulan') }}</a>
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Bulan') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($kode_bulan->id) ? route('kode_bulan.update', [$kode_bulan]) : route('kode_bulan.store') }}">

                    @if (!empty($kode_bulan->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="">{{ __('Kode') }}</label>
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
                                                    <label class="control-label form-label" for="">{{ __('Bulan') }}</label>
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
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border border-top-0 text-right">
                        <a href="{{ route('kode_bulan.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($tetapan->id) ? __('Perbaharui') : __('Simpan') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection