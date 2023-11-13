@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Template Notifikasi') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Template Notifikasi') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('template_notifikasi.index') }}">{{ __('Template Notifikasi') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Template Notifikasi') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Template Notifikasi') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($template_notifikasi->id) ? route('template_notifikasi.update', [$template_notifikasi->id]) : route('template_notifikasi.store') }}">

                    @if (!empty($template_notifikasi->id))
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
                                                    <label class="control-label form-label" for="template_notifikasi">{{ __('Template Notifikasi') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input
                                                        value="{{$template_notifikasi->template_notifikasi ??''}}"

                                                        id="template_notifikasi"
                                                        name="template_notifikasi"
                                                        type="text"
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('template_notifikasi')])
                                                    />
                                                    @error('template_notifikasi')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <!-- <div class="col-md-3"> -->
                                                <div class="col-md-3">
                                                        <label class="control-label form-label" for="keterangan_notifikasi">{{ __('Keterangan') }}</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <textarea
                                                            id="keterangan_notifikasi"
                                                            name="keterangan_notifikasi"
                                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('keterangan')])
                                                            rows="5"
                                                        >{{$template_notifikasi->keterangan_notifikasi ??''}}</textarea>
                                                        @error('keterangan_notifikasi')
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
                        <a href="{{ route('template_notifikasi.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($template_notifikasi->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($template_notifikasi->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
