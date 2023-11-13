@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Kolektibilitas') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Kolektibilitas') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Setting') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kolektibilitas.index') }}">{{ __('Kolektibilitas') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Kolektibilitas') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Kolektibilitas') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($kolektibilitas->id) ? route('kolektibilitas.update', [$kolektibilitas->id]) : route('kolektibilitas.store') }}">
                    @if (!empty($kolektibilitas->id))
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
                                                    <label class="control-label form-label" for="status_kolek">{{ __('Status Kolektibilitas') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input
                                                        value="{{$kolektibilitas->status_kolek ??''}}"

                                                        id="status_kolek"
                                                        name="status_kolek"
                                                        type="text"
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('status_kolek')])
                                                    />
                                                    @error('status_kolek')
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
                                            <label class="control-label form-label" for="dari_tunggakan">{{ __('Lama Tunggakan ( Hari )') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                value="{{$kolektibilitas->dari_tunggakan ??''}}"

                                                id="dari_tunggakan"
                                                name="dari_tunggakan"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('dari_tunggakan')])
                                            />
                                            @error('dari_tunggakan')
                                            <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-1">
                                            <label class="control-label form-label" for="sampai_tunggakan">{{ __('s/d') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                value="{{$kolektibilitas->sampai_tunggakan ??''}}"

                                                id="sampai_tunggakan"
                                                name="sampai_tunggakan"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('sampai_tunggakan')])
                                            />
                                            @error('sampai_tunggakan')
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
                        <a href="{{ route('kolektibilitas.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($kolektibilitas->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($kolektibilitas->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
