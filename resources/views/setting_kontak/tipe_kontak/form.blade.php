@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Tipe Kontak') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __(' Tipe Kontak') }}">

        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
         <li class="breadcrumb-item">
            <a href="{{ route('tipe_kontak.index') }}">{{ __('Tipe Kontak') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ !empty($tipe_kontak->id) ? __('Edit Tipe Kontak') : __('Tambah Tipe Kontak') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ !empty($tipe_kontak->id) ? __('Edit Tipe Kontak') : __('Tambah Tipe Kontak') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($tipe_kontak->id) ? route('tipe_kontak.update', [$tipe_kontak->id]) : route('tipe_kontak.store') }}">

                    @if (!empty($tipe_kontak->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                                <div class="col-md-3">
                                                    <label class="control-label form-label" for="tipe_kontak">{{ __('Tipe Kontak') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input
                                                        value="{{!empty($tipe_kontak->tipe_kontak) ? $tipe_kontak->tipe_kontak : ''}}"
                                                        id="tipe_kontak"
                                                        name="tipe_kontak"
                                                        type="text"
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('tipe_kontak')])

                                                    />
                                                    @error('tipe_kontak')
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
                        <a href="{{ route('tipe_kontak.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($tipe_kontak->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($tipe_kontak->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
