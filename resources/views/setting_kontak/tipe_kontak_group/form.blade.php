@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Kode Tipe Kontak Group') }}">
        <!-- <li class="breadcrumb-item">
            <a href="{{ route('daftar_kontak.index') }}">{{ __('Kontak') }}</a>
        </li> -->
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Setting') }}</a>
        </li>
         <li class="breadcrumb-item">
            <a href="{{ route('tipe_kontak_group.index') }}">{{ __('Tipe Kontak Group') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Tipe Kontak Group') }}</a>
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Tipe Kontak Group') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($tipe_kontak_group->id) ? route('tipe_kontak_group.update', [$tipe_kontak_group->id]) : route('tipe_kontak_group.store') }}">

                    @if (!empty($tipe_kontak_group->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">


                                <div class="form-group clearfix">
                                    <div class="row">
                                        <!-- <div class="col-md-3"> -->
                                                <div class="col-md-3">
                                                    <label class="control-label form-label" for="tipe_kontak_group">{{ __('Nama Group') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input
                                                        value="{{!empty($tipe_kontak_group->tipe_kontak_group) ? $tipe_kontak_group->tipe_kontak_group : ''}}"
                                                        id="tipe_kontak_group"
                                                        name="tipe_kontak_group"
                                                        type="text"
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('tipe_kontak_group')])
                                                    />
                                                    @error('tipe_kontak_group')
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border border-top-0 text-right">
                        <a href="{{ route('tipe_kontak_group.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($tipe_kontak_group->id) ? __('Perbaharui') : __('Kirim') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($tipe_kontak_group->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
