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
                                            <select name="id_kelompok_aset" id="id_kelompok_aset" class="form-control select2">
                                                <option value="">Pilih Aset</option>
                                                @foreach($aset as $asets)
                                                    <option value="{{$asets->id}}">{{$asets->nama_aset}}</option>
                                                    @endforeach
                                            </select>
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
                                                value="{{ old('tanggal_transaksi') }}"
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
                                            <select name="dijual" class="form-control select2" data-placeholder="{{ __('Pilih') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih') }}</option>
                                                <option value="1">{{ __('Ya') }}</option>
                                                <option value="0">{{ __('Tidak') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="optional-form d-none">
                                	<div class="form-group clearfix">
	                                    <div class="row" id="harga_jual">
	                                    	<div class="col-md-3">
	                                            <label class="control-label form-label" for="harga_jual">{{ __('Harga Jual') }}</label>
	                                        </div>
	                                        <div class="col-md-9">
	                                            <input
	                                                id="harga_jual"
	                                                name="harga_jual"
	                                                type="text"
	                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('harga_jual')])
	                                                value="{{ old('harga_jual') }}"
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
                                                <select name="akun_deposit_penjualan" class="form-control select2"
                                                        data-placeholder="{{ __('Pilih Akun Deposit Penjualan') }}"
                                                        data-minimum-results-for-search="Infinity">
                                                    <option value="">&nbsp;</option>
                                                    @foreach($akun as $gl)
                                                        <option value="{{$gl->id}}"
                                                                @if(!empty($produk_pembiayaan->akun_deposit_penjualan) ? $produk_pembiayaan->akun_deposit_penjualan == $gl->id : '')selected @endif>
                                                            {{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                    @endforeach
                                                </select>
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
                                                <select name="akun_kerugian_penjualan" class="form-control select2"
                                                        data-placeholder="{{ __('Pilih Akun Kerugian Penjualan') }}"
                                                        data-minimum-results-for-search="Infinity">
                                                    <option value="">&nbsp;</option>
                                                    @foreach($akun as $gl)
                                                        <option value="{{$gl->id}}"
                                                                @if(!empty($produk_pembiayaan->akun_kerugian_penjualan) ? $produk_pembiayaan->akun_kerugian_penjualan == $gl->id : '')selected @endif>
                                                            {{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                    @endforeach
                                                </select>
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
	                                                id="keterangan"
	                                                name="keterangan"
	                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('keterangan')])
	                                                rows="5"
	                                            >{{ old('nama_warung') }}</textarea>
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
        <script>
        $(document).ready(function () {
            $('select').select2();

            // $('.select2-ajax').select2({
            //     ajax: {
            //         url: function () {
            //             return $(this).data('ajax--url');
            //         },
            //         data: data,
            //         processResults: processResults,
            //     },
            // });


            $('select[name=dijual]').on('change', function() {
	            if ($(this).val() == '1') {
	                $('.optional-form').removeClass('d-none')
	            } else {
	                $('.optional-form').addClass('d-none')
	            }
        	});

		});
        </script>
    @endpush
