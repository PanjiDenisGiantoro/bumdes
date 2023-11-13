@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Kategori Produk') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Kategori Produk') }}">
    <li class="breadcrumb-item">
            <a href="{{ route('daftar_produk.index') }}">{{ __('Produk') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kategori_produk.index') }}">{{ __('Kategori Produk') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ !empty($kategori_produk->id) ? __('Edit Kategori Produk') : __('Tambah Kategori Produk') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ !empty($kategori_produk->id) ? __('Edit Kategori Produk') : __('Tambah Kategori Produk') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($kategori_produk->id) ? route('kategori_produk.update', [$kategori_produk->id]) : route('kategori_produk.store') }}">

                    @if (!empty($kategori_produk->id))
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
                                            <label class="control-label form-label" for="kategori_produk">{{ __('Kategori Produk') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                                value="{{!empty($kategori_produk->kategori_produk) ? $kategori_produk->kategori_produk : ''}}"

                                                id="kategori_produk"
                                                name="kategori_produk"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('kategori_produk')])
                                            />
                                            @error('kategori_produk')
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
                        <a href="{{ route('kategori_produk.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($kategori_produk->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($kategori_produk->id) ? __('Perbarui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
