@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Bidang Usaha') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Bidang Usaha') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kode_bidang_usaha.index') }}">{{ __('Bidang Usaha') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ !empty($KodeBidangUsaha->id) ? __('Edit Bidang Usaha') : __('Tambah Bidang Usaha') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ !empty($KodeBidangUsaha->id) ? __('Edit Bidang Usaha ') : __('Tambah Bidang Usaha') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($KodeBidangUsaha->id) ? route('kode_bidang_usaha.update', [$KodeBidangUsaha->id]) : route('kode_bidang_usaha.store') }}">

                    @if (!empty($KodeBidangUsaha->id))
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
                                                    <label class="control-label form-label" for="">{{ __('Bidang Usaha') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input
                                                        value="{{!empty($KodeBidangUsaha->bidang_usaha) ? $KodeBidangUsaha->bidang_usaha : ''}}"
                                                        id="bidang_usaha"
                                                        name="bidang_usaha"
                                                        type="text"
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('bidang_usaha')])
                                                        value="{{ old('bidang_usaha') }}"
                                                    />
                                                    @error('bidang_usaha')
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
                        <a href="{{ route('kode_bidang_usaha.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($KodeBidangUsaha->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($KodeBidangUsaha->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
