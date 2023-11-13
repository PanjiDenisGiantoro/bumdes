@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Sumber Dana') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Sumber Dana') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('sumber_dana.index') }}">{{ __('Sumber Dana') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Sumber Dana') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Sumber Dana') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($sumber_dana->id) ? route('sumber_dana.update', [$sumber_dana->id]) : route('sumber_dana.store') }}">

                    @if (!empty($sumber_dana->id))
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
                                                    <label class="control-label form-label" for="">{{ __('Nama Sumber Dana') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input
                                                        value="{{!empty($sumber_dana->nama_sumber_dana) ? $sumber_dana->nama_sumber_dana : ''}}"
                                                        id="nama_sumber_dana"
                                                        name="nama_sumber_dana"
                                                        type="text"
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_sumber_dana')])
                                                        value="{{ old('nama_sumber_dana') }}"
                                                    />
                                                    @error('nama_sumber_dana')
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
                        <a href="{{ route('sumber_dana.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($sumber_dana->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($sumber_dana->id) ? __('Perbarui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
