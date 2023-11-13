@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">Pelepasan Aset</h3>
    <br>
{{--    <x-breadcrumb title="{{ __('Informasi Pelepasan Aset') }}">--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('daftar_aset.index') }}">{{ __('Aset Mgmt.') }}</a>--}}
{{--        </li>--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('pelepasan_aset_mgt.index') }}">{{ __('Pelepasan') }}</a>--}}
{{--        </li>--}}
{{--        <li class="breadcrumb-item">--}}
{{--            {{ __('Informasi Pelepasan Aset') }}</a>--}}
{{--        </li>--}}
{{--    </x-breadcrumb>--}}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Informasi Aset') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($pelepasan_aset_mgt->id) ? route('pelepasan_aset_mgt.update', [$pelepasan_aset_mgt->id]) : route('pelepasan_aset_mgt.store') }}">

                    @if (!empty($pelepasan_aset_mgt->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                	<div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="id_kelompok_aset">{{ __('Nama Aset') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="{{$pelepasan_aset_mgt->aset->nama_aset ?? ''}}">
                                            @error('id_kelompok_aset')
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
                                            <label class="control-label form-label" for="tanggal_transaksi">{{ __('Tanggal Transaksi') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                                id="tanggal_transaksi"
                                                name="tanggal_transaksi"
                                                type="date"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('tanggal_transaksi')])
                                                value="{{$pelepasan_aset_mgt->tanggal_transaksi ?? '' }}"
                                            />
                                            @error('tanggal_transaksi')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <!-- <div class="col-md-2">
                                            <label class="control-label form-label" for="kode_sku">{{ __('Kode SKU') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                id="kode_sku"
                                                name=""
                                                type="text"
                                                class="form-control"

                                            />
                                        </div> -->
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="dijual">{{ __('Dijual') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" readonly class="form-control" value="{{$pelepasan_aset_mgt->dijual}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="optional-form ">
                                	<div class="form-group clearfix">
	                                    <div class="row" id="harga_jual">
	                                    	<div class="col-md-3">
	                                            <label class="control-label form-label" for="harga_jual">{{ __('Harga Jual') }}</label>
	                                        </div>
	                                        <div class="col-md-9">
	                                            <input
                                                    readonly
	                                                id="harga_jual"
	                                                name="harga_jual"
	                                                type="text"
	                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('harga_jual')])
                                                value="{{$pelepasan_aset_mgt->harga_jual}}"
	                                            />
	                                            @error('harga_jual')
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
	                                            <label class="control-label form-label" for="akun_deposit_penjualan">{{ __('Akun Deposit Penjualan') }}</label>
	                                        </div>
	                                        <div class="col-md-9">
	                                            <input
                                                    readonly
	                                                id="akun_deposit_penjualan"
	                                                name="akun_deposit_penjualan"
	                                                type="text"
	                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('akun_deposit_penjualan')])
	                                                value="{{ old('akun_deposit_penjualan') }}"
	                                            />
	                                            @error('akun_deposit_penjualan')
	                                                <span class="invalid-feedback" role="alert">
	                                                    {{ $message }}
	                                                </span>
	                                            @enderror
	                                        </div>
	                                    </div>
	                                </div>
	                                <br>
	                                <div class="form-group clearfix">
	                                    <div class="row">
	                                    	<div class="col-md-3">
	                                            <label class="control-label form-label" for="akun_kerugian_penjualan">{{ __('Akun Kerugian Penjualan') }}</label>
	                                        </div>
	                                        <div class="col-md-9">
	                                            <input
	                                                id="akun_kerugian_penjualan"
	                                                name="akun_kerugian_penjualan"
	                                                type="text"
	                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('akun_kerugian_penjualan')])
	                                                value="{{ old('akun_kerugian_penjualan') }}"
	                                            />
	                                            @error('akun_kerugian_penjualan')
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
	                                            <label class="control-label form-label" for="keterangan">{{ __('Keterangan') }}</label>
	                                        </div>
	                                        <div class="col-md-9">
	                                            <textarea
                                                    readonly
	                                                id="keterangan"
	                                                name="keterangan"
	                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('keterangan')])
	                                                rows="5"
	                                            > {{$pelepasan_aset_mgt->keterangan}}
                                                </textarea>
	                                            @error('keterangan')
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
                    </div>
                    <div class="card-footer border border-top-0 text-right">
                    	 <a href="{{ route('pelepasan_aset_mgt.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Batal') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($anggota->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ url("/vendor/dashlite-template/demo1/src/assets/js/bundle.js?ver=2.2.0") }}"></script>
    <script src="{{ url("/vendor/dashlite-template/demo1/src/assets/js/scripts.js?ver=2.2.0") }}"></script>

@endsection
@push('scripts')

    @endpush
