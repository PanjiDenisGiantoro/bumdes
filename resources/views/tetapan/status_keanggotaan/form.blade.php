@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Kategori Keanggotaan') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Kategori Keanggotaan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('status_keanggotaan.index') }}">{{ __(' Kategori Keanggotaan') }}</a>
        </li>
        <li class="breadcrumb-item">
        {{ !empty($status_keanggotaan->id) ? __('Edit Kategori Keanggotaan') : __('Tambah Kategori Keanggotaan') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ !empty($status_keanggotaan->id) ? __('Edit Kategori Keanggotaan') : __('Tambah Kategori Keanggotaan') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($status_keanggotaan->id) ? route('status_keanggotaan.update', [$status_keanggotaan->id]) : route('status_keanggotaan.store') }}">

                    @if (!empty($status_keanggotaan->id))
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
                                            <label class="control-label form-label" for="kode_status_keanggotaan">{{ __('Kode Status Keanggotaan') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                                value="{{!empty($status_keanggotaan->kode_status_keanggotaan) ? $status_keanggotaan->kode_status_keanggotaan : ''}}"
                                                id="kode_status_keanggotaan"
                                                name="kode_status_keanggotaan"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('kode_status_keanggotaan')])
                                            />
                                            @error('kode_status_keanggotaan')
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
                                                    <label class="control-label form-label" for="status_keanggotaan">{{ __('Kategori Keanggotaan') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input
                                                        value="{{!empty($status_keanggotaan->status_keanggotaan) ? $status_keanggotaan->status_keanggotaan : ''}}"
                                                        id="status_keanggotaan"
                                                        name="status_keanggotaan"
                                                        type="text"
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('status_keanggotaan')])
                                                    />
                                                    @error('status_keanggotaan')
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
                        <a href="{{ route('status_keanggotaan.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($status_keanggotaan->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($status_keanggotaan->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
