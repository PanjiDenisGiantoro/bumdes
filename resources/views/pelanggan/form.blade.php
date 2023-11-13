@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Pelanggan') }}">
        <li class="breadcrumb-item">
            {{ __('Pelanggan') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Pelanggan') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($pelanggan->id) ? route('pelanggan.update', [$pelanggan->id]) : route('pelanggan.store') }}">
                    @if (!empty($pelanggan->id))
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
                                                    <label class="control-label form-label" for="nama_agunan">{{ __('Nama Pelanggan') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input
                                                        value="{{$pelanggan->name ??''}}"

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
                        <a href="{{ route('agunan.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($pelanggan->id) ? __('Kembali') : __('Batal') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($pelanggan->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
