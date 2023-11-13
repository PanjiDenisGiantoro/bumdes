@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Template Whatsapp') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Template Whatsapp') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Setting') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('template_wa.index') }}">{{ __('Template Whatsapp') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Template Whatsapp') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Template Whatsapp') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($template_wa->id) ? route('template_wa.update', [$template_wa->id]) : route('template_wa.store') }}">
                    @if (!empty($template_wa->id))
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
                                                    <label class="control-label form-label" for="template_watsapp">{{ __('Template Whatsapp') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input
                                                        value="{{$template_wa->template_watsapp ??''}}"

                                                        id="template_watsapp"
                                                        name="template_watsapp"
                                                        type="text"
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('template_watsapp')])
                                                    />
                                                    @error('template_watsapp')
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
                                                        <label class="control-label form-label" for="keterangan_watsapp">{{ __('Keterangan') }}</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <textarea
                                                            id="keterangan_watsapp"
                                                            name="keterangan_watsapp"
                                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('keterangan_watsapp')])
                                                            rows="5"
                                                        > {{$template_wa->keterangan_watsapp ??''}} </textarea>
                                                        @error('keterangan')
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
                        <a href="{{ route('template_wa.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($template_wa->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($template_wa->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
