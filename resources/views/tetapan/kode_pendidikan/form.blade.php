@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Pendidikan') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __(' Pendidikan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kode_pendidikan.index') }}">{{ __(' Pendidikan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ !empty($KodePendidikan->id) ? __('Edit Pendidikan') : __('Tambah Pendidikan') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ !empty($KodePendidikan->id) ? __('Edit Pendidikan') : __('Tambah Pendidikan') }}</h5>

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
                        <a href="{{ route('kode_pendidikan.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($KodePendidikan->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($KodePendidikan->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
