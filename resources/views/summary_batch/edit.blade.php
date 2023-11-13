@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Batch 1') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('summary_batch.index') }}">{{ __('Pembiayaan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('summary_batch.index') }}">{{ __('Summary Batch') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Informasi Summary Batch 1') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Informasi Pengajuan Baru') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($summary_batch->id) ? route('summary_batch.update', [$summary_batch]) : route('summary_batch.store') }}">

                    @if (!empty($summary_batch->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                	<div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="status">{{ __('Status') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                                id="status"
                                                name="status"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('status')])
                                                value="{{ old('status') }}"
                                                readonly
                                            />
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <!-- <div class="col-md-2">
                                            <label class="control-label form-label" for="no_mitra">{{ __('No. Mitra') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                id="no_mitra"
                                                name=""
                                                type="text"
                                                class="form-control"
                                                readonly
                                            />
                                        </div> -->
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-md-3">
                                        	<div class="col-md-3">
                                                <label class="control-label form-label" for="nama_pemohon">{{ __('Nama Pemohon') }}</label>
                                            </div>
                                            <label class="control-label form-label" for="tanggal_pengajuan">{{ __('Tanggal Pengajuan') }}</label>
                                        </div>
                                        	 <div class="col-md-9">
                                                <input
                                                    id="nama_pemohon"
                                                    name="nama_pemohon"
                                                    type="text"
                                                    @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_pemohon')])
                                                    value="{{ old('nama_pemohon') }}"
                                                />
                                                @error('nama_pemohon')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        <div class="col-md-3">
                                            <input
                                                id="tanggal_pengajuan"
                                                name="tanggal_pengajuan"
                                                type="date"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('tanggal_pengajuan')])
                                                value="{{ old('tanggal_pengajuan') }}"
                                            />
                                            @error('tanggal_pengajuan')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div> -->
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                            		 	<div class="col-md-3">
                                            <label class="control-label form-label" for="tanggal_lahir">{{ __('Tanggal Pengajuan') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                id="tanggal_lahir"
                                                name="tanggal_lahir"
                                                type="date"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('tanggal_lahir')])
                                                value="{{ old('tanggal_lahir') }}"
                                                readonly
                                            />
                                            @error('tanggal_lahir')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="nama">{{ __('Batch') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                id="nama"
                                                name=""
                                                type="text"
                                                class="form-control"
                                                readonly
                                            /input>
                                        </div>
                                        <!-- <div class="col-md-3">
                                            <label class="control-label form-label" for="">{{ __('Anggota') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control select2" data-placeholder="{{ __('Pilih Anggota') }}">
                                                <option>{{ __('Pilih Anggota') }}</option>
                                            </select>
                                        </div> -->

                                        <!-- <div class="col-md-2">
                                            <label class="control-label form-label" for="no_mitra">{{ __('No. Mitra') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                id="no_mitra"
                                                name=""
                                                type="text"
                                                class="form-control"
                                                readonly
                                            />
                                        </div> -->
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="nama">{{ __('Nama') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                id="nama"
                                                name="nama"
                                                type="text"
                                                class="form-control"
                                                readonly=""
                                            /input>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="nik">{{ __('NIK') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                id="nik"
                                                name="nik"
                                                type="text"
                                                class="form-control"
                                                readonly=""

                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="nama">{{ __('No. Mitra') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                id="nama"
                                                name="nama"
                                                type="text"
                                                class="form-control"
                                                readonly
                                            /input>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="platfon_pengajuan">{{ __('Platfon Pengajuan') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                id="platfon_pengajuan"
                                                name="platfon_pengajuan"
                                                type="date"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('platfon_pengajuan')])
                                                value="{{ old('platfon_pengajuan') }}"
                                                readonly
                                            />
                                            @error('platfon_pengajuan')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <h3 class="card-title">{{ __('Kelulusan')}}</h3>

                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-3">
                                            <label class="control-label form-label" for="tanggal_pengajuan">{{ __('Tanggal Kelulusan') }}</label>
	                                        </div>
	                                        <div class="col-md-4">
	                                            <input
	                                                id="tanggal_pengajuan"
	                                                name="tanggal_pengajuan"
	                                                type="date"
	                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('tanggal_pengajuan')])
	                                                value="{{ old('tanggal_pengajuan') }}"
	                                                readonly
	                                            />
	                                            @error('tanggal_pengajuan')
	                                                <span class="invalid-feedback" role="alert">
	                                                    {{ $message }}
	                                                </span>
	                                            @enderror
	                                        </div>
                                            <div class="col-md-2">
                                                <label class="control-label form-label" for="status_kelulusan">{{ __('Status') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input
                                                    id="status_kelulusan"
                                                    name="status_kelulusan"
                                                    type="text"
                                                    @class(['required', 'form-control', 'is-invalid' => $errors->has('status_kelulusan')])
                                                    value="{{ old('status_kelulusan') }}"
                                                    readonly
                                                />
                                                @error('status_kelulusan')
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
                                                <label class="control-label form-label" for="no_rekening">{{ __('No. Rekening') }}</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input
                                                    id="no_rekening"
                                                    name="no_rekening"
                                                    type="text"
                                                    @class(['required', 'form-control', 'is-invalid' => $errors->has('no_rekening')])
                                                    value="{{ old('no_rekening') }}"
                                                    readonly
                                                />
                                                @error('no_rekening')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label form-label" for="plafon_diluluskan">{{ __('Platfon Diluluskan') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input
                                                    id="plafon_diluluskan"
                                                    name="plafon_diluluskan"
                                                    type="text"
                                                    @class(['required', 'form-control', 'is-invalid' => $errors->has('plafon_diluluskan')])
                                                    value="{{ old('plafon_diluluskan') }}"
                                                    readonly
                                                />
                                                @error('plafon_diluluskan')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <h3 class="card-title">{{ __('Pembiayaan')}}</h3>

                                    <div class="form-group clearfix">
                                        <div class="row">
                                        	<div class="col-md-3">
                                            	<label class="control-label form-label" for="jangka_waktu">{{ __('Jangka Waktu') }}</label>
	                                        </div>
	                                        <div class="col-md-4">
	                                            <input
	                                                id="jangka_waktu"
	                                                name="jangka_waktu"
	                                                type="date"
	                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('jangka_waktu')])
	                                                value="{{ old('jangka_waktu') }}"
	                                                readonly
	                                            />
	                                            @error('jangka_waktu')
	                                                <span class="invalid-feedback" role="alert">
	                                                    {{ $message }}
	                                                </span>
	                                            @enderror
	                                        </div>
	                                        <div class="col-md-2">
                                            	<label class="control-label form-label" for="tanggal_jatuh_tempo">{{ __('Tanggal Jatuh Tempo') }}</label>
	                                        </div>
	                                        <div class="col-md-3">
	                                            <input
	                                                id="tanggal_jatuh_tempo"
	                                                name="tanggal_jatuh_tempo"
	                                                type="date"
	                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('tanggal_jatuh_tempo')])
	                                                value="{{ old('tanggal_jatuh_tempo') }}"
	                                                readonly
	                                            />
	                                            @error('tanggal_jatuh_tempo')
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
                                                <label class="control-label form-label" for="angsuran_perbulan">{{ __('Angsuran Perbulan') }}</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input
                                                    id="angsuran_perbulan"
                                                    name="angsuran_perbulan"
                                                    type="text"
                                                    @class(['required', 'form-control', 'is-invalid' => $errors->has('angsuran_perbulan')])
                                                    value="{{ old('angsuran_perbulan') }}"
                                                    readonly
                                                />
                                                @error('angsuran_perbulan')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                            	<label class="control-label form-label" for="tanggal_angsuran">{{ __('Tanggal Mula Angsuran') }}</label>
	                                        </div>
	                                        <div class="col-md-3">
	                                            <input
	                                                id="tanggal_angsuran"
	                                                name="tanggal_angsuran"
	                                                type="date"
	                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('tanggal_angsuran')])
	                                                value="{{ old('tanggal_angsuran') }}"
	                                                readonly
	                                            />
	                                            @error('tanggal_angsuran')
	                                                <span class="invalid-feedback" role="alert">
	                                                    {{ $message }}
	                                                </span>
	                                            @enderror
	                                        </div>
                                        </div>
                                    </div>

                    </div>
                    <div class="card-footer border border-top-0 text-right">
                        <a href="{{ route('summary_batch.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Kembali') }}</a>
                        <!-- <button type="submit" class="btn btn-primary">{{ !empty($anggota->id) ? __('Perbaharui') : __('Simpan') }}</button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
