@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Bank') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Bank') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('bank.index') }}">{{ __('Bank') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Bank') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Bank') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($bank->id) ? route('bank.update', [$bank->id]) : route('bank.store') }}">

                    @if (!empty($bank->id))
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
                                                    <label class="control-label form-label" for="">{{ __('Kode Bank') }}</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input
                                                        value="{{!empty($bank->sandi_bank) ? $bank->sandi_bank : ''}}"
                                                        id="sandi_bank"
                                                        name="sandi_bank"
                                                        type="text"
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('sandi_bank')])
                                                        value="{{ old('sandi_bank') }}"
                                                    />
                                                    @error('sandi_bank')
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
                                            <label class="control-label form-label" for="">{{ __('Nama Bank') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                                value="{{!empty($bank->nama_bank) ? $bank->nama_bank : ''}}"
                                                id="nama_bank"
                                                name="nama_bank"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_bank')])
                                                value="{{ old('nama_bank') }}"
                                            />
                                            @error('nama_bank')
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
                        <a href="{{ route('bank.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($bank->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($bank->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
