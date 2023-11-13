@extends('layouts.app')

@section('breadcrumb')
<x-breadcrumb title="{{ __('Tambah Ekpedisi') }}">
    <li class="breadcrumb-item">
        <a href="{{ route('tetapan.index') }}">{{ __('Setting') }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('pembelian.setting.ekpedisi.index') }}">{{ __('Ekpedisi') }}</a>
    </li>
    <li class="breadcrumb-item">
        {{ __('Tambah Ekpedisi') }}</a>
    </li>
</x-breadcrumb>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 col-lg-10">
        <div class="card border-0 m-b-20">
            <h5 class="card-header">{{ __('Tambah Ekpedisi') }}</h5>

            <form method="POST" class="form-horizontal" action="{{ !empty($ekpedisi->id) ? route('pembelian.setting.ekpedisi.update', $ekpedisi->id) : route('pembelian.setting.ekpedisi.store') }}">

                @if (!empty($ekpedisi->id))
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
                                        <input value="{{ !empty($ekpedisi->kode) ? $ekpedisi->kode : '' }}" id="" name="kode" type="text" @class(['required', 'form-control' , 'is-invalid'=> $errors->has('')])

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
                                        <input value="{{ !empty($ekpedisi->nama) ? $ekpedisi->nama : '' }}" 
                                        id="ss" name="nama" type="text" 
                                        @class(['required', 'form-control' , 'is-invalid'=> $errors->has('')])

                                        />
                                        @error('')
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
                    <a href="{{ route('pembelian.setting.ekpedisi.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Kembali') }}</a>
                    <button type="submit" class="btn btn-primary">{{ !empty($ekpedisi->id) ? __('Perbaharui') : __('Kirim') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
