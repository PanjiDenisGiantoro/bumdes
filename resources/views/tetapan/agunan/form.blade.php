@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Agunan') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Agunan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('agunan.index') }}">{{ __('Agunan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Agunan') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Agunan') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($agunan->id) ? route('agunan.update', [$agunan->id]) : route('agunan.store') }}">
                    @if (!empty($agunan->id))
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
                                                    <label class="control-label form-label" for="nama_agunan">{{ __('Agunan') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input
                                                        value="{{$agunan->nama_agunan ??''}}"

                                                        id="nama_agunan"
                                                        name="nama_agunan"
                                                        type="text"
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_agunan')])
                                                    />
                                                    @error('nama_agunan')
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
                        <a href="{{ route('agunan.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($agunan->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($agunan->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
