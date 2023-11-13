@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Kode Pekerjaan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Setting') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kode_pendidikan.index') }}">{{ __('Kode Pendidikan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Pekerjaan') }}</a>
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Pekerjaan') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($KodePendidikan->id) ? route('kode_pendidikan.update', [$KodePendidikan->id]) : route('kode_pendidikan.store') }}">

                    @if (!empty($KodePendidikan->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="">{{ __('Kode') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                                value="{{!empty($KodePendidikan->kode_pendidikan) ? $KodePendidikan->kode_pendidikan : ''}}"
                                                id="kode_pendidikan"
                                            name="kode_pendidikan"
                                            type="text"
                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('kode_pendidikan')])

                                            />
                                            @error('kode_pendidikan')
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
                                                    <label class="control-label form-label" for="pendidikan">{{ __('Pendidikan') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input
                                                        value="{{!empty($KodePendidikan->pendidikan) ? $KodePendidikan->pendidikan : ''}}"
                                                        id="pendidikan"
                                                        name="pendidikan"
                                                        type="text"
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('pendidikan')])
                                                    />
                                                    @error('pendidikan')
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
                        <button type="submit" class="btn btn-primary">{{ !empty($tetapan->id) ? __('Perbaharui') : __('Simpan') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
