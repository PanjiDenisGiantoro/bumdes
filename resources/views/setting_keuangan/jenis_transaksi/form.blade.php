@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Jenis Transaksi') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Informasi Jenis Transaksi') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('transaksi_keuangan.index') }}">{{ __('Keuangan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
         <li class="breadcrumb-item">
            <a href="{{ route('jenis_transaksi.index') }}">{{ __('Jenis Transaksi') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Jenis Transaksi') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Jenis Transaksi') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($jenis_transaksi->id) ? route('jenis_transaksi.update', [$jenis_transaksi->id]) : route('jenis_transaksi.store') }}">

                    @if (!empty($jenis_transaksi->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                    	<div class="col-md-3">
                                            <label class="control-label form-label" for="jenis_transaksi">{{ __('Nama Transaksi') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input value="{{ !empty($jenis_transaksi->jenis_transaksi) ? $jenis_transaksi->jenis_transaksi : '' }}"
                                                id="jenis_transaksi"
                                                name="jenis_transaksi"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('jenis_transaksi')])
                                                value="{{ old('jenis_transaksi') }}"
                                            />
                                            @error('jenis_transaksi')
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
                                            <label class="control-label form-label" for="macam_transaksi">{{ __('Jenis Transaksi') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="macam_transaksi" id="macam_Transaksi" class="form-control ">
                                                <option>Pilih</option>
                                                <option value="simpanan"@if(!empty($jenis_transaksi->macam_transaksi) ? $jenis_transaksi->macam_transaksi == 'simpanan' : '')selected @endif>Simpanan</option>
                                                <option value="simjaka"@if(!empty($jenis_transaksi->macam_transaksi) ? $jenis_transaksi->macam_transaksi == 'simjaka' : '')selected @endif>Simpanan Berjangka</option>
                                                <option value="pembiayaan"@if(!empty($jenis_transaksi->macam_transaksi) ? $jenis_transaksi->macam_transaksi == 'pembiayaan' : '')selected @endif>Pembiayaan</option>
                                                <option value="pendanaan"@if(!empty($jenis_transaksi->macam_transaksi) ? $jenis_transaksi->macam_transaksi == 'pendanaan' : '')selected @endif>Pendanaan</option>
                                                <option value="transaksilain"@if(!empty($jenis_transaksi->macam_transaksi) ? $jenis_transaksi->macam_transaksi == 'transaksilain' : '')selected @endif>Transaksi Lainnya</option>
                                            </select>

                                            @error('macam_transaksi')
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
                                            <label class="control-label form-label" for="akun_id">{{ __('Akun') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select
                                                name="akun_id"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('akun_id')])
                                                data-placeholder="{{ __('Pilih Akun') }}"
                                                data-minimum-results-for-search="Infinity"
                                                data-ajax--url="{{ route('akun_perkiraan.index') }}"
                                            >
                                                <option value="">{{ __('Pilih Akun') }}</option>
                                                @if (!empty($jenis_transaksi->akun_perkiraan) && $jenis_transaksi->akun_perkiraan)
                                                    <option value="{{ $jenis_transaksi->akun_perkiraan->id }}" selected>{{ $jenis_transaksi->akun_perkiraan->nama }}</option>
                                                @endif
                                            </select>
                                            @error('akun_id')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <input
                                                    type="hidden"
                                                    name="kredit"
                                                    value="off">
                                            <label class="switch">
                                                <input
                                                    type="checkbox"
                                                    data-toggle="toggle"
                                                    id="aktif"
                                                    name="kredit"
                                                    data-off="Debet"
                                                    data-on="Kredit"
                                                    data-on-label="test"
                                                    data-onstyle="dark"
                                                    data-offstyle="success"
                                                    {{ !empty($jenis_transaksi->kredit) && $jenis_transaksi->kredit == 'on' ? 'checked' : null }}>
                                                <span class="round" for="aktif"></span>
                                            </label>
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
                                                >{{ !empty($jenis_transaksi->keterangan) ? $jenis_transaksi->keterangan : '' }}</textarea>
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
                    <div class="card-footer border border-top-0 text-right">
                    	<a href="{{ route('jenis_transaksi.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($jenis_transaksi->id) ? __('Perbaharui') : __('Kirim') }}</button>
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
<script>
$(document).ready(function () {
    $('select[name="akun_id"]').select2({
        ajax: {
            url: function () {
                return "{{ route('akun_perkiraan.index') }}";
            },
            dataType: 'json',
            data: data,
            processResults: function (data) {
                return {
                    results: data.data,
                    pagination: {
                        more: data.current_page < data.last_page
                    },
                }
            },
        },
    });
});
</script>
@endpush
