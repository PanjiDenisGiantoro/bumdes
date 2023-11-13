@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Pembiayaan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('pembiayaan.index') }}">{{ __('Pembiayaan') }}</a>
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Pengajuan Pembiayaan') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($pembiayaan->id) ? route('pembiayaan.update', [$pembiayaan]) : route('pembiayaan.store') }}">

                    @if (!empty($pembiayaan->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="tanggal_pengajuan">{{ __('Tanggal Pengajuan') }}</label>
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
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="">{{ __('Anggota') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control select2" data-placeholder="{{ __('Pilih Anggota') }}">
                                                <option>{{ __('Pilih Anggota') }}</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
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
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="nik">{{ __('NIK') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input 
                                                id="nik" 
                                                name="" 
                                                type="text"
                                                class="form-control"
                                                readonly
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
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
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
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
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer border border-top-0 text-right">
                        <button type="submit" class="btn btn-primary">{{ !empty($pembiayaan->id) ? __('Perbaharui') : __('Hantar') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection