@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Template SMS') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Template SMS') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('template_sms.index') }}">{{ __('Template SMS') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Template SMS') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Template SMS') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($template_sms->id) ? route('template_sms.update', [$template_sms->id]) : route('template_sms.store') }}">

                    @if (!empty($template_sms->id))
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
                                                    <label class="control-label form-label" for="template_sms">{{ __('Template SMS') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input
                                                        value="{{$template_sms->template_sms ??''}}"

                                                        id="template_sms"
                                                        name="template_sms"
                                                        type="text"
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('template_sms')])
                                                        value="{{ old('template_sms') }}"
                                                    />
                                                    @error('template_sms')
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
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <!-- <div class="col-md-3"> -->
                                                <div class="col-md-3">
                                                        <label class="control-label form-label" for="keterangan_sms">{{ __('Keterangan') }}</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <textarea
                                                            id="keterangan_sms"
                                                            name="keterangan_sms"
                                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('keterangan_sms')])
                                                            rows="5"
                                                        >{{$template_sms->keterangan_sms ??''}}</textarea>
                                                        @error('keterangan_sms')
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
                        <a href="{{ route('template_sms.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($template_sms->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($template_sms->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
