@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Pemetaan Akun') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Pemetaan Akun') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('transaksi_keuangan.index') }}">{{ __('Keuangan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Setting') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Pemetaan Akun') }}</a>
        </li> -->
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Produk') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($pemetaan_akun->id) ? route('pemetaan_akun.update', [$pemetaan_akun->id]) : route('pemetaan_akun.store') }}">

                    @if (!empty($pemetaan_akun->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">

                            </div>
                        </div>
                        <br>
                        <h3 class="card-title">{{ __('Pendanaan')}}</h3>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="pendanaan">{{ __('Pendanaan') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <select name="pendanaan" class="form-control select2" data-placeholder="{{ __('Pilih Pendanaan') }}" data-minimum-results-for-search="Infinity">
                                        <option value="">{{ __('Pilih Pendanaan') }}</option>
                                        @foreach($akun as $gl)
                                            <option value="{{$gl->id}}"@if(!empty($pemetaan_akun->id) ? $pemetaan_akun->pendanaan == $gl->id  : '')selected @endif >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        type="hidden"
                                        name="GL_pendanaan"
                                        value="off">
                                    <label class="switch">
                                        <input
                                            type="checkbox"
                                            data-toggle="toggle"
                                            id="aktif"
                                            name="GL_pendanaan"
                                            data-off="Debet"
                                            data-on="Kredit"
                                            data-on-label="test"
                                            data-onstyle="dark"
                                            data-offstyle="success"
                                            {{ !empty($pemetaan_akun->GL_pendanaan) && $pemetaan_akun->GL_pendanaan == 'on' ? 'checked' : null }}>
                                        <span class="round" for="aktif"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <br>
                        <h3 class="card-title">{{ __('Biaya')}}</h3>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="biaya_tunai">{{ __('Biaya Tunai') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <select name="biaya_tunai" class="form-control select2" data-placeholder="{{ __('Pilih Biaya Tunai') }}" data-minimum-results-for-search="Infinity">
                                        <option value="">{{ __('Pilih Biaya Tunai') }}</option>
                                        @foreach($akun as $gl)
                                            <option value="{{$gl->id}}"@if(!empty($pemetaan_akun->id) ? $pemetaan_akun->biaya_tunai == $gl->id  : '')selected @endif >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        type="hidden"
                                        name="GL_biaya_tunai"
                                        value="off">
                                    <label class="switch">
                                        <input
                                            type="checkbox"
                                            data-toggle="toggle"
                                            id="aktif"
                                            name="GL_biaya_tunai"
                                            data-off="Debet"
                                            data-on="Kredit"
                                            data-on-label="test"
                                            data-onstyle="dark"
                                            data-offstyle="success"
                                            {{ !empty($pemetaan_akun->GL_biaya_tunai) && $pemetaan_akun->GL_biaya_tunai == 'on' ? 'checked' : null }}>
                                        <span class="round" for="aktif"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="biaya_non_tunai">{{ __('Biaya Non Tunai') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <select name="biaya_non_tunai" class="form-control select2" data-placeholder="{{ __('Pilih Biaya Non Tunai') }}" data-minimum-results-for-search="Infinity">
                                        <option value="">{{ __('Pilih Biaya Non Tunai') }}</option>
                                        @foreach($akun as $gl)
                                            <option value="{{$gl->id}}"@if(!empty($pemetaan_akun->id) ? $pemetaan_akun->biaya_non_tunai == $gl->id  : '')selected @endif >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        type="hidden"
                                        name="GL_biaya_non_tunai"
                                        value="off">
                                    <label class="switch">
                                        <input
                                            type="checkbox"
                                            data-toggle="toggle"
                                            id="aktif"
                                            name="GL_biaya_non_tunai"
                                            data-off="Debet"
                                            data-on="Kredit"
                                            data-on-label="test"
                                            data-onstyle="dark"
                                            data-offstyle="success"
                                            {{ !empty($pemetaan_akun->GL_biaya_non_tunai) && $pemetaan_akun->GL_biaya_non_tunai == 'on' ? 'checked' : null }}>
                                        <span class="round" for="aktif"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <h3 class="card-title">{{ __('Penjualan')}}</h3>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="pendapatan_penjualan">{{ __('Pendapatan Penjualan') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <select name="pendapatan_penjualan" class="form-control select2" data-placeholder="{{ __('Pilih Pendapatan Penjualan') }}" data-minimum-results-for-search="Infinity">
                                        <option value="">{{ __('Pilih Pendapatan Penjualan') }}</option>
                                        @foreach($akun as $gl)
                                            <option value="{{$gl->id}}"@if(!empty($pemetaan_akun->id) ? $pemetaan_akun->pendapatan_penjualan == $gl->id  : '')selected @endif >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        type="hidden"
                                        name="GL_pendapatan_penjualan"
                                        value="off">
                                    <label class="switch">
                                        <input
                                            type="checkbox"
                                            data-toggle="toggle"
                                            id="aktif"
                                            name="GL_pendapatan_penjualan"
                                            data-off="Debet"
                                            data-on="Kredit"
                                            data-on-label="test"
                                            data-onstyle="dark"
                                            data-offstyle="success"
                                            {{ !empty($pemetaan_akun->GL_pendapatan_penjualan) && $pemetaan_akun->GL_pendapatan_penjualan == 'on' ? 'checked' : null }}>
                                        <span class="round" for="aktif"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="pembayaran_penjualan_cash">{{ __('Pembayaran Penjualan cash') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <select name="pembayaran_penjualan_cash" class="form-control select2" data-placeholder="{{ __('Pilih Penerimaan Penjualan cash') }}" data-minimum-results-for-search="Infinity">
                                        <option value="">{{ __('Pilih Penerimaan Penjualan cash') }}</option>
                                        @foreach($akun as $gl)
                                            <option value="{{$gl->id}}"@if(!empty($pemetaan_akun->id) ? $pemetaan_akun->pembayaran_penjualan_cash == $gl->id  : '')selected @endif >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        type="hidden"
                                        name="GL_pembayaran_penjualan_cash"
                                        value="off">
                                    <label class="switch">
                                        <input
                                            type="checkbox"
                                            data-toggle="toggle"
                                            id="aktif"
                                            name="GL_pembayaran_penjualan_cash"
                                            data-off="Debet"
                                            data-on="Kredit"
                                            data-on-label="test"
                                            data-onstyle="dark"
                                            data-offstyle="success"
                                            {{ !empty($pemetaan_akun->kredit) && $pemetaan_akun->kredit == 'on' ? 'checked' : null }}>
                                        <span class="round" for="aktif"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="pembayaran_penjualan_transfer">{{ __('Pembayaran Penjualan lewat Bank') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <select name="pembayaran_penjualan_transfer" class="form-control select2" data-placeholder="{{ __('Pilih Diskon Penjualan') }}" data-minimum-results-for-search="Infinity">
                                        <option value="">{{ __('Pilih Penerimaan Penjualan lewat Bank') }}</option>
                                        @foreach($akun as $gl)
                                            <option value="{{$gl->id}}"@if(!empty($pemetaan_akun->id) ? $pemetaan_akun->pembayaran_penjualan_transfer == $gl->id  : '')selected @endif >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        type="hidden"
                                        name="GL_pembayaran_penjualan_transfer"
                                        value="off">
                                    <label class="switch">
                                        <input
                                            type="checkbox"
                                            data-toggle="toggle"
                                            id="aktif"
                                            name="GL_pembayaran_penjualan_transfer"
                                            data-off="Debet"
                                            data-on="Kredit"
                                            data-on-label="test"
                                            data-onstyle="dark"
                                            data-offstyle="success"
                                            {{ !empty($pemetaan_akun->GL_pembayaran_penjualan_transfer) && $pemetaan_akun->GL_pembayaran_penjualan_transfer == 'on' ? 'checked' : null }}>
                                        <span class="round" for="aktif"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-3">
                                            <label class="control-label form-label" for="diskon_penjualan">{{ __('Diskon Penjualan') }}</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="diskon_penjualan" class="form-control select2" data-placeholder="{{ __('Pilih Diskon Penjualan') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Diskon Penjualan') }}</option>
                                                @foreach($akun as $gl)
                                                    <option value="{{$gl->id}}"@if(!empty($pemetaan_akun->id) ? $pemetaan_akun->diskon_penjualan == $gl->id  : '')selected @endif >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                            <div class="col-md-3">
                                                <input
                                                    type="hidden"
                                                    name="GL_diskon_penjualan"
                                                    value="off">
                                                <label class="switch">
                                                    <input
                                                        type="checkbox"
                                                        data-toggle="toggle"
                                                        id="aktif"
                                                        name="GL_diskon_penjualan"
                                                        data-off="Debet"
                                                        data-on="Kredit"
                                                        data-on-label="test"
                                                        data-onstyle="dark"
                                                        data-offstyle="success"
                                                        {{ !empty($pemetaan_akun->GL_diskon_penjualan) && $pemetaan_akun->GL_diskon_penjualan == 'on' ? 'checked' : null }}>
                                                    <span class="round" for="aktif"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-3">
                                            	<label class="control-label form-label" for="retur_penjualan">{{ __('Retur Penjualan') }}</label>
	                                        </div>
	                                        <div class="col-md-6">
	                                            <select name="retur_penjualan" class="form-control select2" data-placeholder="{{ __('Pilih Retur Penjualan') }}" data-minimum-results-for-search="Infinity">
	                                                <option value="">{{ __('Pilih Retur Penjualan') }}</option>
                                                    @foreach($akun as $gl)
                                                        <option value="{{$gl->id}}"@if(!empty($pemetaan_akun->id) ? $pemetaan_akun->retur_penjualan == $gl->id  : '')selected @endif >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                    @endforeach
	                                            </select>
	                                        </div>
                                            <div class="col-md-3">
                                                <input
                                                    type="hidden"
                                                    name="GL_retur_penjualan"
                                                    value="off">
                                                <label class="switch">
                                                    <input
                                                        type="checkbox"
                                                        data-toggle="toggle"
                                                        id="aktif"
                                                        name="GL_retur_penjualan"
                                                        data-off="Debet"
                                                        data-on="Kredit"
                                                        data-on-label="test"
                                                        data-onstyle="dark"
                                                        data-offstyle="success"
                                                        {{ !empty($pemetaan_akun->GL_retur_penjualan) && $pemetaan_akun->GL_retur_penjualan == 'on' ? 'checked' : null }}>
                                                    <span class="round" for="aktif"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <div class="row">
                                        	 <div class="col-md-3">
                                                <label class="control-label form-label" for="pengiriman_penjualan">{{ __('Pengiriman Penjualan') }}</label>
                                            </div>
                                            <div class="col-md-6">
                                                <select name="pengiriman_penjualan" class="form-control select2" data-placeholder="{{ __('Pilih Pengiriman Penjualan') }}" data-minimum-results-for-search="Infinity">
                                                    <option value="">{{ __('Pilih Pengiriman Penjualan') }}</option>
                                                    @foreach($akun as $gl)
                                                        <option value="{{$gl->id}}"@if(!empty($pemetaan_akun->id) ? $pemetaan_akun->pengiriman_penjualan == $gl->id  : '')selected @endif >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <input
                                                    type="hidden"
                                                    name="GL_pengiriman_penjualan"
                                                    value="off">
                                                <label class="switch">
                                                    <input
                                                        type="checkbox"
                                                        data-toggle="toggle"
                                                        id="aktif"
                                                        name="GL_pengiriman_penjualan"
                                                        data-off="Debet"
                                                        data-on="Kredit"
                                                        data-on-label="test"
                                                        data-onstyle="dark"
                                                        data-offstyle="success"
                                                        {{ !empty($pemetaan_akun->GL_pengiriman_penjualan) && $pemetaan_akun->GL_pengiriman_penjualan == 'on' ? 'checked' : null }}>
                                                    <span class="round" for="aktif"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-3">
                                           		 <label class="control-label form-label" for="pembayaran_dimuka">{{ __('Pembayaran Dimuka') }}</label>
	                                        </div>
	                                        <div class="col-md-6">
	                                            <select name="pembayaran_dimuka" class="form-control select2" data-placeholder="{{ __('Pilih Pembayaran Dimuka') }}" data-minimum-results-for-search="Infinity">
	                                                <option value="">{{ __('Pilih Pembayaran Dimuka') }}</option>
                                                    @foreach($akun as $gl)
                                                        <option value="{{$gl->id}}"@if(!empty($pemetaan_akun->id) ? $pemetaan_akun->pembayaran_dimuka == $gl->id  : '')selected @endif >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                    @endforeach
	                                            </select>
	                                        </div>
                                            <div class="col-md-3">
                                                <input
                                                    type="hidden"
                                                    name="GL_pembayaran_dimuka"
                                                    value="off">
                                                <label class="switch">
                                                    <input
                                                        type="checkbox"
                                                        data-toggle="toggle"
                                                        id="GL_pembayaran_dimuka"
                                                        name="GL_pembayaran_dimuka"
                                                        data-off="Debet"
                                                        data-on="Kredit"
                                                        data-on-label="test"
                                                        data-onstyle="dark"
                                                        data-offstyle="success"
                                                        {{ !empty($pemetaan_akun->GL_pembayaran_dimuka) && $pemetaan_akun->GL_pembayaran_dimuka == 'on' ? 'checked' : null }}>
                                                    <span class="round" for="aktif"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="row">
                                           <div class="col-md-3">
                                           		 <label class="control-label form-label" for="penjualan_belum_ditagih">{{ __('Penjualan Belum Ditagih') }}</label>
	                                        </div>
	                                        <div class="col-md-6">
	                                            <select name="penjualan_belum_ditagih" class="form-control select2" data-placeholder="{{ __('Pilih Penjualan Belum Ditagih') }}" data-minimum-results-for-search="Infinity">
	                                                <option value="">{{ __('Pilih Penjualan Belum Ditagih') }}</option>
                                                    @foreach($akun as $gl)
                                                        <option value="{{$gl->id}}"@if(!empty($pemetaan_akun->id) ? $pemetaan_akun->penjualan_belum_ditagih == $gl->id  : '')selected @endif >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                    @endforeach
	                                            </select>
	                                        </div>
                                            <div class="col-md-3">
                                                <input
                                                    type="hidden"
                                                    name="GL_penjualan_belum_ditagih"
                                                    value="off">
                                                <label class="switch">
                                                    <input
                                                        type="checkbox"
                                                        data-toggle="toggle"
                                                        id="GL_penjualan_belum_ditagih"
                                                        name="GL_penjualan_belum_ditagih"
                                                        data-off="Debet"
                                                        data-on="Kredit"
                                                        data-on-label="test"
                                                        data-onstyle="dark"
                                                        data-offstyle="success"
                                                        {{ !empty($pemetaan_akun->GL_penjualan_belum_ditagih) && $pemetaan_akun->GL_penjualan_belum_ditagih == 'on' ? 'checked' : null }}>
                                                    <span class="round" for="aktif"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="row">
                                           <div class="col-md-3">
                                           		 <label class="control-label form-label" for="piutang_belum_ditagih">{{ __('Piutang Belum Ditagih') }}</label>
	                                        </div>
	                                        <div class="col-md-6">
	                                            <select name="piutang_belum_ditagih" class="form-control select2" data-placeholder="{{ __('Pilih Piutang Belum Ditagih') }}" data-minimum-results-for-search="Infinity">
	                                                <option value="">{{ __('Pilih Piutang Belum Ditagih') }}</option>
                                                    @foreach($akun as $gl)
                                                        <option value="{{$gl->id}}"@if(!empty($pemetaan_akun->id) ? $pemetaan_akun->piutang_belum_ditagih == $gl->id  : '')selected @endif >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                    @endforeach
	                                            </select>
	                                        </div>
                                            <div class="col-md-3">
                                                <input
                                                    type="hidden"
                                                    name="GL_piutang_belum_ditagih"
                                                    value="off">
                                                <label class="switch">
                                                    <input
                                                        type="checkbox"
                                                        data-toggle="toggle"
                                                        id="GL_piutang_belum_ditagih"
                                                        name="GL_piutang_belum_ditagih"
                                                        data-off="Debet"
                                                        data-on="Kredit"
                                                        data-on-label="test"
                                                        data-onstyle="dark"
                                                        data-offstyle="success"
                                                        {{ !empty($pemetaan_akun->GL_piutang_belum_ditagih) && $pemetaan_akun->GL_piutang_belum_ditagih == 'on' ? 'checked' : null }}>
                                                    <span class="round" for="aktif"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="persediaan_produk">{{ __('Persediaan Produk') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <select name="persediaan_produk" class="form-control select2" data-placeholder="{{ __('Pilih Persediaan Produk') }}" data-minimum-results-for-search="Infinity">
                                        <option value="">{{ __('Pilih Persediaan Produk') }}</option>
                                        @foreach($akun as $gl)
                                            <option value="{{$gl->id}}"@if(!empty($pemetaan_akun->id) ? $pemetaan_akun->persediaan_produk == $gl->id  : '')selected @endif >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        type="hidden"
                                        name="GL_persediaan_produk"
                                        value="off">
                                    <label class="switch">
                                        <input
                                            type="checkbox"
                                            data-toggle="toggle"
                                            id="aktif"
                                            name="GL_persediaan_produk"
                                            data-off="Debet"
                                            data-on="Kredit"
                                            data-on-label="test"
                                            data-onstyle="dark"
                                            data-offstyle="success"
                                            {{ !empty($pemetaan_akun->GL_persediaan_produk) && $pemetaan_akun->GL_persediaan_produk == 'on' ? 'checked' : null }}>
                                        <span class="round" for="aktif"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                                    <br>
                        		<h3 class="card-title">{{ __('Pembelian')}}</h3>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="pembelian">{{ __('Pembelian') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <select name="pembelian" class="form-control select2" data-placeholder="{{ __('Pilih Pembelian') }}" data-minimum-results-for-search="Infinity">
                                        <option value="">{{ __('Pilih Pembelian') }}</option>
                                        @foreach($akun as $gl)
                                            <option value="{{$gl->id}}"@if(!empty($pemetaan_akun->id) ? $pemetaan_akun->pembelian == $gl->id  : '')selected @endif >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        type="hidden"
                                        name="GL_pembelian"
                                        value="off">
                                    <label class="switch">
                                        <input
                                            type="checkbox"
                                            data-toggle="toggle"
                                            id="aktif"
                                            name="GL_pembelian"
                                            data-off="Debet"
                                            data-on="Kredit"
                                            data-on-label="test"
                                            data-onstyle="dark"
                                            data-offstyle="success"
                                            {{ !empty($pemetaan_akun->GL_pembelian) && $pemetaan_akun->GL_pembelian == 'on' ? 'checked' : null }}>
                                        <span class="round" for="aktif"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="pembelian_cash">{{ __('Pembayaran Pembelian Cash') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <select name="pembayaran_pembelian_cash" class="form-control select2" data-placeholder="{{ __('Pilih Pembayaran Pembelian Cash') }}" data-minimum-results-for-search="Infinity">
                                        <option value="">{{ __('Pilih Pembayaran Pembelian Cash') }}</option>
                                        @foreach($akun as $gl)
                                            <option value="{{$gl->id}}"@if(!empty($pemetaan_akun->id) ? $pemetaan_akun->pembayaran_pembelian_cash == $gl->id  : '')selected @endif >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        type="hidden"
                                        name="GL_pembayaran_pembelian_cash"
                                        value="off">
                                    <label class="switch">
                                        <input
                                            type="checkbox"
                                            data-toggle="toggle"
                                            id="aktif"
                                            name="GL_pembayaran_pembelian_cash"
                                            data-off="Debet"
                                            data-on="Kredit"
                                            data-on-label="test"
                                            data-onstyle="dark"
                                            data-offstyle="success"
                                            {{ !empty($pemetaan_akun->GL_pembayaran_pembelian_cash) && $pemetaan_akun->GL_pembayaran_pembelian_cash == 'on' ? 'checked' : null }}>
                                        <span class="round" for="aktif"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="pembelian_transfer">{{ __('Pembayaran Pembelian Transfer') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <select name="pembayaran_pembelian_transfer" class="form-control select2" data-placeholder="{{ __('Pilih Pembelian') }}" data-minimum-results-for-search="Infinity">
                                        <option value="">{{ __('Pilih Pembayaran Pembelian Transfer' ) }}</option>
                                        @foreach($akun as $gl)
                                            <option value="{{$gl->id}}"@if(!empty($pemetaan_akun->id) ? $pemetaan_akun->pembayaran_pembelian_transfer == $gl->id  : '')selected @endif >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        type="hidden"
                                        name="GL_pembayaran_pembelian_transfer"
                                        value="off">
                                    <label class="switch">
                                        <input
                                            type="checkbox"
                                            data-toggle="toggle"
                                            id="aktif"
                                            name="GL_pembayaran_pembelian_transfer"
                                            data-off="Debet"
                                            data-on="Kredit"
                                            data-on-label="test"
                                            data-onstyle="dark"
                                            data-offstyle="success"
                                            {{ !empty($pemetaan_akun->GL_pembayaran_pembelian_transfer) && $pemetaan_akun->GL_pembayaran_pembelian_transfer == 'on' ? 'checked' : null }}>
                                        <span class="round" for="aktif"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-3">
                                            <label class="control-label form-label" for="pengiriman_pembelian">{{ __('Pengiriman Pembelian') }}</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="pengiriman_pembelian" class="form-control select2" data-placeholder="{{ __('Pilih Pengiriman Pembelian') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Pengiriman Pembelian') }}</option>
                                                @foreach($akun as $gl)
                                                    <option value="{{$gl->id}}"@if(!empty($pemetaan_akun->id) ? $pemetaan_akun->pengiriman_pembelian == $gl->id  : '')selected @endif >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                            <div class="col-md-3">
                                                <input
                                                    type="hidden"
                                                    name="GL_pengiriman_pembelian"
                                                    value="off">
                                                <label class="switch">
                                                    <input
                                                        type="checkbox"
                                                        data-toggle="toggle"
                                                        id="GL_pengiriman_pembelian"
                                                        name="GL_pengiriman_pembelian"
                                                        data-off="Debet"
                                                        data-on="Kredit"
                                                        data-on-label="test"
                                                        data-onstyle="dark"
                                                        data-offstyle="success"
                                                        {{ !empty($pemetaan_akun->GL_pengiriman_pembelian) && $pemetaan_akun->GL_pengiriman_pembelian == 'on' ? 'checked' : null }}>
                                                    <span class="round" for="aktif"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-3">
                                            	<label class="control-label form-label" for="uang_muka_pembelian">{{ __('Uang Muka Pembelian') }}</label>
	                                        </div>
	                                        <div class="col-md-6">
	                                            <select name="uang_muka_pembelian" class="form-control select2" data-placeholder="{{ __('Pilih Uang Muka Pembelian') }}" data-minimum-results-for-search="Infinity">
	                                                <option value="">{{ __('Pilih Uang Muka Pembelian') }}</option>
                                                    @foreach($akun as $gl)
                                                        <option value="{{$gl->id}}"@if(!empty($pemetaan_akun->id) ? $pemetaan_akun->uang_muka_pembelian == $gl->id  : '')selected @endif >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                    @endforeach
	                                            </select>
	                                        </div>
                                            <div class="col-md-3">
                                                <input
                                                    type="hidden"
                                                    name="GL_uang_muka_pembelian"
                                                    value="off">
                                                <label class="switch">
                                                    <input
                                                        type="checkbox"
                                                        data-toggle="toggle"
                                                        id="GL_uang_muka_pembelian"
                                                        name="GL_uang_muka_pembelian"
                                                        data-off="Debet"
                                                        data-on="Kredit"
                                                        data-on-label="test"
                                                        data-onstyle="dark"
                                                        data-offstyle="success"
                                                        {{ !empty($pemetaan_akun->GL_uang_muka_pembelian) && $pemetaan_akun->GL_uang_muka_pembelian == 'on' ? 'checked' : null }}>
                                                    <span class="round" for="aktif"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <div class="row">
                                        	 <div class="col-md-3">
                                                <label class="control-label form-label" for="hutang_belum_ditagih">{{ __('Hutang Belum Ditagih') }}</label>
                                            </div>
                                            <div class="col-md-6">
                                                <select name="hutang_belum_ditagih" class="form-control select2" data-placeholder="{{ __('Pilih Hutang Belum Ditagih') }}" data-minimum-results-for-search="Infinity">
                                                    <option value="">{{ __('Pilih Hutang Belum Ditagih') }}</option>
                                                    @foreach($akun as $gl)
                                                        <option value="{{$gl->id}}"@if(!empty($pemetaan_akun->id) ? $pemetaan_akun->hutang_belum_ditagih == $gl->id  : '')selected @endif >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <input
                                                    type="hidden"
                                                    name="GL_hutang_belum_ditagih"
                                                    value="off">
                                                <label class="switch">
                                                    <input
                                                        type="checkbox"
                                                        data-toggle="toggle"
                                                        id="GL_hutang_belum_ditagih"
                                                        name="GL_hutang_belum_ditagih"
                                                        data-off="Debet"
                                                        data-on="Kredit"
                                                        data-on-label="test"
                                                        data-onstyle="dark"
                                                        data-offstyle="success"
                                                        {{ !empty($pemetaan_akun->GL_hutang_belum_ditagih) && $pemetaan_akun->GL_hutang_belum_ditagih == 'on' ? 'checked' : null }}>
                                                    <span class="round" for="aktif"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="stok_beli">{{ __('Persediaan Penyesuaian Stok Pembelian') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <select name="persediaan_penyesuaian_stok_pembelian" class="form-control select2" data-placeholder="{{ __('Pilih Hutang Belum Ditagih') }}" data-minimum-results-for-search="Infinity">
                                        <option value="">{{ __('Pilih Persediaan Penyesuaian Stok Pembelian') }}</option>
                                        @foreach($akun as $gl)
                                            <option value="{{$gl->id}}"@if(!empty($pemetaan_akun->id) ? $pemetaan_akun->persediaan_penyesuaian_stok_pembelian == $gl->id  : '')selected @endif >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        type="hidden"
                                        name="GL_persediaan_penyesuaian_stok_pembelian"
                                        value="off">
                                    <label class="switch">
                                        <input
                                            type="checkbox"
                                            data-toggle="toggle"
                                            id="GL_persediaan_penyesuaian_stok_pembelian"
                                            name="GL_persediaan_penyesuaian_stok_pembelian"
                                            data-off="Debet"
                                            data-on="Kredit"
                                            data-on-label="test"
                                            data-onstyle="dark"
                                            data-offstyle="success"
                                            {{ !empty($pemetaan_akun->GL_persediaan_penyesuaian_stok_pembelian) && $pemetaan_akun->GL_persediaan_penyesuaian_stok_pembelian == 'on' ? 'checked' : null }}>
                                        <span class="round" for="aktif"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                                    <br>
                        	<h3 class="card-title">{{ __('Kontak')}}</h3>

                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-3">
                                            <label class="control-label form-label" for="piutang_usaha">{{ __('Piutang Usaha') }}</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="piutang_usaha" class="form-control select2" data-placeholder="{{ __('Pilih Piutang Usaha') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Piutang Usaha') }}</option>
                                                @foreach($akun as $gl)
                                                    <option value="{{$gl->id}}"@if(!empty($pemetaan_akun->id) ? $pemetaan_akun->piutang_usaha == $gl->id  : '')selected @endif >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                            <div class="col-md-3">
                                                <input
                                                    type="hidden"
                                                    name="GL_piutang_usaha"
                                                    value="off">
                                                <label class="switch">
                                                    <input
                                                        type="checkbox"
                                                        data-toggle="toggle"
                                                        id="GL_piutang_usaha"
                                                        name="GL_piutang_usaha"
                                                        data-off="Debet"
                                                        data-on="Kredit"
                                                        data-on-label="test"
                                                        data-onstyle="dark"
                                                        data-offstyle="success"
                                                        {{ !empty($pemetaan_akun->GL_piutang_usaha) && $pemetaan_akun->GL_piutang_usaha == 'on' ? 'checked' : null }}>
                                                    <span class="round" for="aktif"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-3">
                                            	<label class="control-label form-label" for="hutang_usaha">{{ __('Hutang Usaha') }}</label>
	                                        </div>
	                                        <div class="col-md-6">
	                                            <select name="hutang_usaha" class="form-control select2" data-placeholder="{{ __('Pilih Hutang Usaha') }}" data-minimum-results-for-search="Infinity">
	                                                <option value="">{{ __('Pilih Hutang Usaha') }}</option>
                                                    @foreach($akun as $gl)
                                                        <option value="{{$gl->id}}"@if(!empty($pemetaan_akun->id) ? $pemetaan_akun->hutang_usaha == $gl->id  : '')selected @endif >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                    @endforeach
	                                            </select>
	                                        </div>
                                            <div class="col-md-3">
                                                <input
                                                    type="hidden"
                                                    name="GL_hutang_usaha"
                                                    value="off">
                                                <label class="switch">
                                                    <input
                                                        type="checkbox"
                                                        data-toggle="toggle"
                                                        id="GL_hutang_usaha"
                                                        name="GL_hutang_usaha"
                                                        data-off="Debet"
                                                        data-on="Kredit"
                                                        data-on-label="test"
                                                        data-onstyle="dark"
                                                        data-offstyle="success"
                                                        {{ !empty($pemetaan_akun->GL_hutang_usaha) && $pemetaan_akun->GL_hutang_usaha == 'on' ? 'checked' : null }}>
                                                    <span class="round" for="aktif"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                        	<h3 class="card-title">{{ __('Lainnya')}}</h3>

                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-3">
                                            <label class="control-label form-label" for="ekuitas_saldo_awal">{{ __('Ekuitas Saldo Awal') }}</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="ekuitas_saldo_awal" class="form-control select2" data-placeholder="{{ __('Pilih Ekuitas Saldo Awal') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Ekuitas Saldo Awal') }}</option>
                                                @foreach($akun as $gl)
                                                    <option value="{{$gl->id}}"@if(!empty($pemetaan_akun->id) ? $pemetaan_akun->ekuitas_saldo_awal == $gl->id  : '')selected @endif >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                            <div class="col-md-3">
                                                <input
                                                    type="hidden"
                                                    name="GL_ekuitas_saldo_awal"
                                                    value="off">
                                                <label class="switch">
                                                    <input
                                                        type="checkbox"
                                                        data-toggle="toggle"
                                                        id="GL_ekuitas_saldo_awal"
                                                        name="GL_ekuitas_saldo_awal"
                                                        data-off="Debet"
                                                        data-on="Kredit"
                                                        data-on-label="test"
                                                        data-onstyle="dark"
                                                        data-offstyle="success"
                                                        {{ !empty($pemetaan_akun->GL_ekuitas_saldo_awal) && $pemetaan_akun->GL_ekuitas_saldo_awal == 'on' ? 'checked' : null }}>
                                                    <span class="round" for="aktif"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-3">
                                            	<label class="control-label form-label" for="aset_tetap">{{ __('Aset Tetap') }}</label>
	                                        </div>
	                                        <div class="col-md-6">
	                                            <select name="aset_Tetap" class="form-control select2" data-placeholder="{{ __('Pilih Aset Tetap') }}" data-minimum-results-for-search="Infinity">
	                                                <option value="">{{ __('Pilih Aset Tetap') }}</option>
                                                    @foreach($akun as $gl)
                                                        <option value="{{$gl->id}}"@if(!empty($pemetaan_akun->id) ? $pemetaan_akun->aset_Tetap == $gl->id  : '')selected @endif >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                    @endforeach
	                                            </select>
	                                        </div>
                                            <div class="col-md-3">
                                                <input
                                                    type="hidden"
                                                    name="GL_aset_Tetap"
                                                    value="off">
                                                <label class="switch">
                                                    <input
                                                        type="checkbox"
                                                        data-toggle="toggle"
                                                        id="GL_aset_Tetap"
                                                        name="GL_aset_Tetap"
                                                        data-off="Debet"
                                                        data-on="Kredit"
                                                        data-on-label="test"
                                                        data-onstyle="dark"
                                                        data-offstyle="success"
                                                        {{ !empty($pemetaan_akun->GL_aset_Tetap) && $pemetaan_akun->GL_aset_Tetap == 'on' ? 'checked' : null }}>
                                                    <span class="round" for="aktif"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <div class="row">
                                        	 <div class="col-md-3">
                                                <label class="control-label form-label" for="persedian_[enyesuaian_stok">{{ __('Persediaan Penyesuaian Stok') }}</label>
                                            </div>
                                            <div class="col-md-6">
                                                <select name="persediaan_penyesuaian_stok" class="form-control select2" data-placeholder="{{ __('Pilih Persediaan Penyesuaian Stok') }}" data-minimum-results-for-search="Infinity">
                                                    <option value="">{{ __('Pilih Persediaan Penyesuaian Stok') }}</option>
                                                    @foreach($akun as $gl)
                                                        <option value="{{$gl->id}}"@if(!empty($pemetaan_akun->id) ? $pemetaan_akun->persediaan_penyesuaian_stok == $gl->id  : '')selected @endif >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <input
                                                    type="hidden"
                                                    name="GL_persediaan_penyesuaian_stok"
                                                    value="off">
                                                <label class="switch">
                                                    <input
                                                        type="checkbox"
                                                        data-toggle="toggle"
                                                        id="GL_persediaan_penyesuaian_stok"
                                                        name="GL_persediaan_penyesuaian_stok"
                                                        data-off="Debet"
                                                        data-on="Kredit"
                                                        data-on-label="test"
                                                        data-onstyle="dark"
                                                        data-offstyle="success"
                                                        {{ !empty($pemetaan_akun->GL_persediaan_penyesuaian_stok) && $pemetaan_akun->GL_persediaan_penyesuaian_stok == 'on' ? 'checked' : null }}>
                                                    <span class="round" for="aktif"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                    </div>
                    <div class="card-footer border border-top-0 text-right">
                        <a href="{{ route('setting_keuangan.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($pemetaan_akun->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($pemetaan_akun->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
@endpush
