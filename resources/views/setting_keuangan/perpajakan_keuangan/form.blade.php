@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Perpajakan') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Informasi Perpajakan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('transaksi_keuangan.index') }}">{{ __('Keuangan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
         <li class="breadcrumb-item">
            <a href="{{ route('perpajakan_keuangan.index') }}">{{ __('Perpajakan Keuangan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Perpajakan') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Perpajakan') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($perpajakan_keuangan->id) ? route('perpajakan_keuangan.update', [$perpajakan_keuangan->id]) : route('perpajakan_keuangan.store') }}">

                    @if (!empty($perpajakan_keuangan->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                	<div class="row">
                                		<div class="col-md-3">
                                            <label class="control-label form-label" for="nama_pajak">{{ __('Nama Pajak') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                                value="{{!empty($perpajakan_keuangan->nama_pajak) ? $perpajakan_keuangan->nama_pajak : ''}}"

                                                id="nama_pajak" nama_pajak
                                                name="nama_pajak"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_pajak')])
                                                value="{{ old('nama_pajak') }}"
                                            />
                                            @error('nama_pemohon')
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
                                            <label class="control-label form-label" for="tarif_persentase">{{ __('Tarif Persentase') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                                value="{{!empty($perpajakan_keuangan->tarif_persentase) ? $perpajakan_keuangan->tarif_persentase : ''}}"
                                                id="tarif_persentase"
                                                name="tarif_persentase"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('tarif_persentase')])
                                                value="{{ old('tarif_persentase') }}"
                                            />
                                            @error('nama_pemohon')
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
                                            <label class="control-label form-label" for="akun_pajak_penjualan">{{ __('Akun Pajak Penjualan') }}</label>
                                        </div>
                                        <div class="col-md-9">

                                            <select name="akun_pajak_penjualan" id="akun_pajak_penjualan" class="form-control select2">
                                                <option>{{ __('Pilih Akun Pajak Penjualan') }}</option>
                                                @foreach ($akun as $akuns)
                                                    <option value="{{$akuns->id}}"@if(!empty($perpajakan_keuangan->akun_pajak_penjualan) ? $perpajakan_keuangan->akun_pajak_penjualan == $akuns->id : '') selected @endif>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $akuns->depth) !!}{{ $akuns->kode }} &mdash; {{ $akuns->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                    	<div class="col-md-3">
                                            <label class="control-label form-label" for="akun_pajak_pembelian">{{ __('Akun Pajak Pembelian') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select name="akun_pajak_pembelian" id="akun_pajak_pembelian" class="form-control  select2">
                                                <option>{{ __('Pilih Akun Pajak Pembelian') }}</option>
                                                @foreach ($akun as $akuns)
                                                <option value="{{$akuns->id}}"@if(!empty($perpajakan_keuangan->akun_pajak_pembelian) ? $perpajakan_keuangan->akun_pajak_pembelian == $akuns->id : '') selected @endif>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $akuns->depth) !!}{{ $akuns->kode }} &mdash; {{ $akuns->nama }}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="row">
                                    	<div class="col-md-3">
                                            <label class="control-label form-label" for="nama">{{ __('Pemotongan') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                           <input type="radio" name="pemotongan" value="2" @if(!empty($perpajakan_keuangan->pemotongan) ? $perpajakan_keuangan->pemotongan  == 2 : '') checked @endif>&nbsp; <label>{{ __('Ya') }}</label>&nbsp;
                                            <input type="radio" name="pemotongan"value="1" @if(!empty($perpajakan_keuangan->pemotongan) ? $perpajakan_keuangan->pemotongan  == 1 : '') checked @endif>&nbsp; <label>{{ __('Tidak') }}</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="card-footer border border-top-0 text-right">
                    	<a href="{{ route('perpajakan_keuangan.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($perpajakan_keuangan->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($perpajakan_keuangan->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

    <script>

// select2
$(document).ready(function() {
    $('.select2').select2();
});
        </script>
@endpush