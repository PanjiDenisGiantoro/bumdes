@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Template Email') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Template Email') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('template_email.index') }}">{{ __('Template Email') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Template Email') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Template Email') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($template_email->id) ? route('template_email.update', [$template_email->id]) : route('template_email.store') }}">

                    @if (!empty($template_email->id))
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
                                                    <label class="control-label form-label" for="template_email">{{ __('Template Email') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input
                                                        value="{{$template_email->template_email ??''}}"

                                                        id="template_email"
                                                        name="template_email"
                                                        type="text"
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('template_email')])
                                                    />
                                                    @error('template_email')
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
                                                        <label class="control-label form-label" for="keterangan_email">{{ __('Keterangan') }}</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <textarea
                                                            id="keterangan_email"
                                                            name="keterangan_email"
                                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('keterangan')])
                                                            rows="5"
                                                        >{{$template_email->keterangan_email ??''}}</textarea>
                                                        @error('keterangan_email')
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
                        <a href="{{ route('template_email.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($template_email->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($template_email->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
