@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Sumber Pengembalian') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Sumber Pengembalian') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('sumber_pengembalian.index') }}">{{ __('Sumber Pengembalian') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Sumber Pengembalian') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Sumber Pengembalian') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($sumber_pengembalian->id) ? route('sumber_pengembalian.update', [$sumber_pengembalian->id]) : route('sumber_pengembalian.store') }}">
                    @if (!empty($sumber_pengembalian->id))
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
                                                    <label class="control-label form-label" for="nama_sumber_pengembalian">{{ __('Sumber Pengembalian') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input
                                                        value="{{$sumber_pengembalian->nama_sumber_pengembalian ??''}}"

                                                        id="nama_sumber_pengembalian"
                                                        name="nama_sumber_pengembalian"
                                                        type="text"
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_sumber_pengembalian')])
                                                    />
                                                    @error('nama_sumber_pengembalian')
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
                        <a href="{{ route('sumber_pengembalian.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($sumber_pengembalian->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($sumber_pengembalian->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
