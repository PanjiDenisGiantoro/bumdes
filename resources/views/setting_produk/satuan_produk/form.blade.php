@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Satuan Produk') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Satuan Produk') }}">
    <li class="breadcrumb-item">
            <a href="{{ route('daftar_produk.index') }}">{{ __('Produk') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('satuan_produk.index') }}">{{ __('Satuan Produk') }}</a>
        </li>
        <li class="breadcrumb-item">
        {{ !empty($satuan_produk->id) ? __('Edit Satuan Produk') : __('Tambah Satuan Produk') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ !empty($satuan_produk->id) ? __('Edit Satuan Produk') : __('Tambah Satuan Produk') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($satuan_produk->id) ? route('satuan_produk.update', [$satuan_produk->id]) : route('satuan_produk.store') }}">

                    @if (!empty($satuan_produk->id))
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
                                            <label class="control-label form-label" for="satuan_prduk">{{ __('Jenis Satuan') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                                value="{{!empty($satuan_produk->satuan_produk) ? $satuan_produk->satuan_produk : ''}}"

                                                id="satuan_produk"
                                                name="satuan_produk"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('satuan_produk')])
                                            />
                                            @error('satuan_produk')
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
                        <a href="{{ route('satuan_produk.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($satuan_produk->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($satuan_produk->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
