@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Berat Satuan') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Berat Satuan') }}">
    <li class="breadcrumb-item">
            <a href="{{ route('daftar_produk.index') }}">{{ __('Produk') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kategori_produk.index') }}">{{ __('Berat Satuan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ !empty($BeratSatuan->id) ? __('Edit Berat Satuan') : __('Tambah Berat Satuan') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ !empty($BeratSatuan->id) ? __('Edit Berat Satuan') : __('Tambah Berat Satuan') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($BeratSatuan->id) ? route('berat_satuan.update', [$BeratSatuan->id]) : route('berat_satuan.store') }}">

                    @if (!empty($BeratSatuan->id))
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
                                            <label class="control-label form-label" for="nama_berat_satuan">{{ __('Berat Satuan') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                                value="{{!empty($BeratSatuan->nama_berat_satuan) ? $BeratSatuan->nama_berat_satuan : ''}}"

                                                id="nama_berat_satuan"
                                                name="nama_berat_satuan"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_berat_satuan')])
                                            />
                                            @error('nama_berat_satuan')
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
                        <a href="{{ route('berat_satuan.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($BeratSatuan->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($BeratSatuan->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
