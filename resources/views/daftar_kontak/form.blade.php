@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Pengajuan Kontak') }}">
    	<li class="breadcrumb-item">
            <a href="{{ route('daftar_kontak.index') }}">{{ __('Kontak') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('daftar_kontak.index') }}">{{ __('Daftar Kontak') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Pengajuan Kontak') }}</a>
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Register Kontak') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($daftar_kontak->id) ? route('daftar_kontak.update', [$daftar_kontak->id]) : route('daftar_kontak.store') }}">

                    @if (!empty($anggota->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                	<div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="nama_kontak">{{ __('Nama Kontak') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                value="{{!empty($daftar_kontak->nama_kontak) ? $daftar_kontak->nama_kontak : ''}}"

                                                id="nama_kontak"
                                                name="nama_kontak"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_kontak')])
                                                value="{{ old('nama_kontak') }}"
                                            />
                                            @error('nama_kontak')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="tipe_kontak">{{ __('Tipe Kontak') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="id_tipe_kontak" class="form-control select2" data-placeholder="{{ __('Pilih Tipe Kontak') }}">
                                                <option value="">{{ __('Pilih Tipe Kontak') }}</option>
                                                @foreach ($TipeKontak as $id => $name)
                                                    <option value="{{$id}}">{{$name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                            		 	<div class="col-md-3">
                                    		<label class="control-label form-label" for="nama_perusahaan">{{ __('Nama Perusahaan') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                                value="{{!empty($daftar_kontak->nama_perusahaan) ? $daftar_kontak->nama_perusahaan : ''}}"
                                                id="nama_perusahaan"
                                                name="nama_perusahaan"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_perusahaan')])
                                            />
                                            @error('nama_perusahaan')
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
                                                <label class="control-label form-label" for="alamat_perusahaan">{{ __('Alamat Penagihan') }}</label>
                                            </div>
                                            <div class="col-md-9">
                                                <textarea


                                                    id="alamat_perusahaan"
                                                    name="alamat_perusahaan"
                                                    @class(['required', 'form-control', 'is-invalid' => $errors->has('alamat_perusahaan')])
                                                    rows="5"
                                                >{{!empty($daftar_kontak->alamat_perusahaan) ? $daftar_kontak->alamat_perusahaan : ''}}</textarea>
                                                @error('alamat_perusahaan')
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
                                    		<label class="control-label form-label" for="npwp">{{ __('NPWP') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                                value="{{!empty($daftar_kontak->npwp) ? $daftar_kontak->npwp : ''}}"

                                                id="npwp"
                                                name="npwp"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('npwp')])
                                                value="{{ old('nama_perusahaan') }}"
                                            />
                                            @error('npwp')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

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
                                                <label class="control-label form-label" for="no_telp">{{ __('No. Telpon') }}</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input
                                                    value="{{!empty($daftar_kontak->no_telp) ? $daftar_kontak->no_telp : ''}}"

                                                    id="no_telp"
                                                    name="no_telp"
                                                    type="text"
                                                    @class(['required', 'form-control', 'is-invalid' => $errors->has('no_telpon')])
                                                    value="{{ old('no_telpon') }}"
                                                />
                                                @error('no_telpon')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        <div class="col-md-2">
                                                <label class="control-label form-label" for="no_hp">{{ __('No. Handphone') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input
                                                    value="{{!empty($daftar_kontak->no_hp) ? $daftar_kontak->no_hp : ''}}"

                                                    id="no_hp"
                                                    name="no_hp"
                                                    type="text"
                                                    @class(['required', 'form-control', 'is-invalid' => $errors->has('no_handphone')])
                                                    value="{{ old('no_hp') }}"
                                                />
                                                @error('no_hp')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
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
                        <br>
                        <h3 class="card-title">{{ __('Informasi Akun')}}</h3>

                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="control-label form-label" for="gl_hutang">{{ __('Akun Hutang') }}</label>
                                            </div>
                                            <div class="col-md-9">
                                                <select id="gl_hutang" name="gl_hutang" class="form-control select2" data-placeholder="{{ __('Pilih GL Hutang') }}">
                                                    <option value="">{{ __('Pilih Akun Hutang') }}</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="control-label form-label" for="gl_piutang">{{ __('Akun Piutang') }}</label>
                                            </div>
                                            <div class="col-md-9">
                                                <select id="gl_piutang" name="gl_piutang" class="form-control select2" data-placeholder="{{ __('Pilih GL Piutang') }}">
                                                    <option value="">{{ __('Pilih Akun Piutang') }}</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>


                    </div>
                    <div class="card-footer border border-top-0 text-right">
                        <a href="{{ route('daftar_kontak.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($anggota->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
