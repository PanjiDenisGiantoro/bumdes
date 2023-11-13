@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Persetujuan') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Informasi Persetujuan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('transaksi_keuangan.index') }}">{{ __('Keuangan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('persetujuan_keuangan.index') }}">{{ __('Persetujuan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Persetujuan') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Persetujuan') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($persetujuan_keuangan->id) ? route('persetujuan_keuangan.update', [$persetujuan_keuangan->id]) : route('persetujuan_keuangan.store') }}">

                    @if (!empty($persetujuan_keuangan->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                	<div class="row">
                                		<div class="col-md-3">
                                            <label class="control-label form-label" for="nama_persetujuan">{{ __('Nama') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                                value="{{!empty($persetujuan_keuangan->nama_persetujuan) ? $persetujuan_keuangan->nama_persetujuan : ''}}"
                                                id="nama_persetujuan"
                                                name="nama_persetujuan"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_persetujuan')])
                                                value="{{ old('nama_persetujuan') }}"
                                            />
                                            @error('nama_persetujuan')
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
                                            <label class="control-label form-label" for="id_jabatan">{{ __('Jabatan') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select name="id_jabatan" class="form-control select2" data-placeholder="{{ __('Pilih Jabatan') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Jabatan') }}</option>

                                                @foreach($pengguna as $kode)
                                                    <option value="{{$kode->id}}"@if(!empty($persetujuan_keuangan->id_jabatan) ? $persetujuan_keuangan->id_jabatan == $kode->id : '') selected @endif>{{$kode->nama_jabatan}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                    	<div class="col-md-3">
                                            <label class="control-label form-label" for="id_jabatan">{{ __('Modul') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select name="modul" class="form-control select2" data-placeholder="{{ __('Pilih Modul') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Modul') }}</option>
                                                <option value="penjualan"@if(!empty($persetujuan_keuangan->modul) ? $persetujuan_keuangan->modul == 'penjualan' : '') selected @endif >Penjualan</option>
                                                <option value="pembelian"@if(!empty($persetujuan_keuangan->modul) ? $persetujuan_keuangan->modul == 'pembelian' : '') selected @endif>Pembelian</option>
                                                <option value="kasir"@if(!empty($persetujuan_keuangan->modul) ? $persetujuan_keuangan->modul == 'kasir' : '') selected @endif>Kasir</option>
                                                <option value="teller"@if(!empty($persetujuan_keuangan->modul) ? $persetujuan_keuangan->modul == 'teller' : '') selected @endif>Teller</option>

                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="row">
                                    	<div class="col-md-3">
                                            <label class="control-label form-label" for="status">{{ __('Status') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" name="status_persetjuan" value="2" @if(!empty($persetujuan_keuangan->status_persetjuan) ? $persetujuan_keuangan->status_persetjuan  == 2 : '') checked @endif>&nbsp; <label>{{ __('Tidak Aktif') }}</label>&nbsp;
                                            <input type="radio" name="status_persetjuan"value="1" @if(!empty($persetujuan_keuangan->status_persetjuan) ? $persetujuan_keuangan->status_persetjuan  == 1 : '') checked @endif>&nbsp; <label>{{ __('Aktif') }}</label>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="card-footer border border-top-0 text-right">
                    	<a href="{{ route('persetujuan_keuangan.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($persetujuan_keuangan->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($persetujuan_keuangan->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
