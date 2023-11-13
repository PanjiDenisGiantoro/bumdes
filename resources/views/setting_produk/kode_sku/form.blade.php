@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Kode SKU') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Kode SKU') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('daftar_produk.index') }}">{{ __('Produk') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kode_sku.index') }}">{{ __('Kode SKU') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ !empty($kode_sku->id) ? __('Edit Kode SKU') : __('Tambah Kode SKU') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ !empty($kode_sku->id) ? __('Edit Kode SKU') : __('Tambah Kode SKU') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($kode_sku->id) ? route('kode_sku.update', [$kode_sku->id]) : route('kode_sku.store') }}">

                    @if (!empty($kode_sku->id))
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
                                                    <label class="control-label form-label" for="sku">{{ __('Kode SKU') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input
                                                        value="{{!empty($kode_sku->sku) ? $kode_sku->sku : ''}}"
                                                        id="sku"
                                                        name="sku"
                                                        type="text"
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('sku')])
                                                    />
                                                    @error('sku')
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
                        <a href="{{ route('kode_sku.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($kode_sku->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($kode_sku->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
