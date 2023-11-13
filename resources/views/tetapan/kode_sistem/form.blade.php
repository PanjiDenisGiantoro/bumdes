@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Kode Sistem') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Setting') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kode_sistem.index') }}">{{ __('Kode Sistem') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Kode Sistem') }}</a>
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Kode Sistem') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($kode_sistem->id) ? route('kode_sistem.update', [$kode_sistem]) : route('kode_sistem.store') }}">

                    @if (!empty($kode_sistem->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                	<div class="row">
                                		<div class="col-md-3">
                                            <label class="control-label form-label" for="">{{ __('Bahasa') }}</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="" class="form-control select2" data-placeholder="{{ __('Pilih Jenis Kelamin') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Bahasa') }}</option>
                                                <option value="Indonesia">{{ __('Indonesia') }}</option>
                                                <option value="English">{{ __('English') }}</option>
                                                <option value="Malaysia">{{ __('Malaysia') }}</option>
                                            </select>
                                        </div>
                                 	</div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                            		 	<div class="col-md-3">
                                            <label class="control-label form-label" for="">{{ __('Pilih Zona Waktu') }}</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="" class="form-control select2" data-placeholder="{{ __('Pilih Jenis Kelamin') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Zona Waktu') }}</option>
                                                <option value="Indonesia">{{ __('Indonesia') }}</option>
                                                <option value="English">{{ __('English') }}</option>
                                                <option value="Malaysia">{{ __('Malaysia') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                    	<div class="col-md-3">
                                            <label class="control-label form-label" for="">{{ __('Format Tanggal') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input 
                                                id="" 
                                                name="" 
                                                type="date" 
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('')]) 
                                                value="{{ old('') }}"
                                            />
                                            @error('')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-1">
                                            <label class="control-label form-label" for="">{{ __('Format Waktu') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="" class="form-control select2" data-placeholder="{{ __('Pilih Jenis Kelamin') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Format Waktu') }}</option>
                                                <option value="23:59">{{ __('23:59') }}</option>
                                                <!-- <option value="English">{{ __('English') }}</option>
                                                <option value="Malaysia">{{ __('Malaysia') }}</option> -->
                                            </select>
                                        </div>
                                    	<!-- <div class="col-md-3">
                                            <label class="control-label form-label" for="tanggal_lahir">{{ __('Tanggal Lahir') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input 
                                                id="tanggal_lahir" 
                                                name="tanggal_lahir" 
                                                type="date" 
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('tanggal_lahir')]) 
                                                value="{{ old('tanggal_lahir') }}"
                                            />
                                            @error('tanggal_lahir')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="tempat_lahir">{{ __('Tempat Lahir') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input 
                                                id="tempat_lahir" 
                                                name="tempat_lahir" 
                                                type="text" 
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('tempat_lahir')]) 
                                                value="{{ old('tempat_lahir') }}"
                                            />
                                            @error('tempat_lahir')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div> -->
                                        <!-- <div class="col-md-3">
                                            <label class="control-label form-label" for="plafon">{{ __('Plafon') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input 
                                                id="plafon" 
                                                name="plafon" 
                                                type="text" 
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('plafon')]) 
                                                value="{{ old('plafon') }}"
                                            />
                                            @error('plafon')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div> -->
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                    	<div class="col-md-3">
                                            <label class="control-label form-label" for="">{{ __('Format Mata Uang') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="" class="form-control select2" data-placeholder="{{ __('Pilih Format Mata Uang') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Format Mata Uang') }}</option>
                                                <option value="Indonesia">{{ __('1.000.00') }}</option>
                                                <!-- <option value="English">{{ __('English') }}</option>
                                                <option value="Malaysia">{{ __('Malaysia') }}</option> -->
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <label class="control-label form-label" for="">{{ __('Mata Uang') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="" class="form-control select2" data-placeholder="{{ __('Pilih Jenis Mata Uang') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Jenis Mata Uang') }}</option>
                                                <option value="IDR (Rp) Indonesian Rupiah">{{ __('IDR (Rp) Indonesian Rupiah') }}</option>
                                                <!-- <option value="English">{{ __('English') }}</option>
                                                <option value="Malaysia">{{ __('Malaysia') }}</option> -->
                                            </select>
                                        </div>
                                    	<!-- <div class="col-md-3">
                                            <label class="control-label form-label" for="jenis_kelamin">{{ __('Jenis Kelamin') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="jenis_kelamin" class="form-control select2" data-placeholder="{{ __('Pilih Jenis Kelamin') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Jenis Kelamin') }}</option>
                                                <option value="M">{{ __('Pria') }}</option>
                                                <option value="F">{{ __('Wanita') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="status_perkawinan">{{ __('Status Perkawinan') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="status_perkawinan" class="form-control select2" data-placeholder="{{ __('Pilih Status Perkawinan') }}">
                                                <option value="">{{ __('Pilih Status Perkawinan') }}</option>
                                            </select>
                                        </div> -->
                                        <!-- <div class="col-md-3">
                                            <label class="control-label form-label" for="batch">{{ __('Batch') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input 
                                                id="batch" 
                                                name="batch" 
                                                type="text" 
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('batch')]) 
                                                value="{{ old('batch') }}"
                                            />
                                            @error('batch')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div> -->
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="row">
                                    	<div class="col-md-3">
                                            <label class="control-label form-label" for="">{{ __('Jumlah Angka Dibelakang Koma') }}</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="" class="form-control select2" data-placeholder="{{ __('Jumlah Angka Dibelakang Koma') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Jumlah Angka Dibelakang Koma') }}</option>
                                                <option value="0">{{ __('0') }}</option>
                                                <!-- <option value="English">{{ __('English') }}</option>
                                                <option value="Malaysia">{{ __('Malaysia') }}</option> -->
                                            </select>
                                        </div>
                                    	<!-- <div class="col-md-3">
                                            <label class="control-label form-label" for="jenis_kelamin">{{ __('Pendidikan Terakhir') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="jenis_kelamin" class="form-control select2" data-placeholder="{{ __('Pilih Jenis Kelamin') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Pendidikan Terakhir') }}</option>
                                                <option value="M">{{ __('Pria') }}</option>
                                                <option value="F">{{ __('Wanita') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="status_perkawinan">{{ __('Pekerjaan') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="status_perkawinan" class="form-control select2" data-placeholder="{{ __('Pilih Status Perkawinan') }}">
                                                <option value="">{{ __('Pilih Pekerjaan') }}</option>
                                            </select>
                                        </div> -->
                                        <!-- <div class="col-md-3">
                                            <label class="control-label form-label" for="batch">{{ __('Batch') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input 
                                                id="batch" 
                                                name="batch" 
                                                type="text" 
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('batch')]) 
                                                value="{{ old('batch') }}"
                                            />
                                            @error('batch')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div> -->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer border border-top-0 text-right">
                        <a href="{{ route('kode_sistem.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($anggota->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection