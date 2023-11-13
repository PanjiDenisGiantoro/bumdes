@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Gudang') }}">
        <!-- <li class="breadcrumb-item">
            <a href="{{ route('daftar_produk.index') }}">{{ __('Produk') }}</a>
        </li> -->
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Setting') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('gudang_produk.index') }}">{{ __('Gudang Produk') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Gudang') }}</a>
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Gudang') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($gudang_produk->id) ? route('gudang_produk.update', [$gudang_produk->id]) : route('gudang_produk.store') }}">

                    @if (!empty($gudang_produk->id))
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
                                                    <label class="control-label form-label" for="gudang_produk">{{ __('Nama Gudang') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input
                                                        value="{{!empty($gudang_produk->gudang_produk) ? $gudang_produk->gudang_produk : ''}}"

                                                        id="gudang_produk"
                                                        name="gudang_produk"
                                                        type="text"
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('gudang_produk')])
                                                    />
                                                    @error('kode_gudang_produk')
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
                        <a href="{{ route('gudang_produk.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($gudang_produk->id) ? __('Kembali') : __('Batal') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($gudang_produk->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
