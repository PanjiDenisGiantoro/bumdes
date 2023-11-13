@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Unit Kerja') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Kode Unit Kerja') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Daftar Unit Kerja') }}</a>
        </li>
        <li class="breadcrumb-item">
            @if(!empty($KodePengguna->id))
                {{ __('Edit Unit Kerja') }}
            @else
            {{ __('Tambah Unit Kerja') }}
    
            @endif
        </a>

        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
            @if(!empty($KodePengguna->id))
            <h5 class="card-header">{{ __('Edit Unit Kerja') }}</h5>
            @else
            <h5 class="card-header">{{ __('Tambah Unit Kerja') }}</h5>
    
            @endif

                <form method="POST" class="form-horizontal" action="{{ !empty($KodePengguna->id) ? route('kode_pengguna.update', [$KodePengguna->id]) : route('kode_pengguna.store') }}">

                    @if (!empty($KodePengguna->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
{{--                                <div class="form-group clearfix">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-3">--}}
{{--                                            <label class="control-label form-label" for="">{{ __('Kode Unit Kerja') }}</label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-9">--}}
{{--                                            <input--}}
{{--                                                value="{{$KodePengguna->kode_jabatan ?? ''}}"--}}
{{--                                            id="kode_jabatan"--}}
{{--                                            name="kode_jabatan"--}}
{{--                                            type="text"--}}
{{--                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('kode_jabatan')])--}}

{{--                                            />--}}
{{--                                            @error('')--}}
{{--                                            <span class="invalid-feedback" role="alert">--}}
{{--                                                    {{ $message }}--}}
{{--                                            </span>--}}
{{--                                             @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <!-- <div class="col-md-3"> -->
                                                <div class="col-md-3">
                                                    <label class="control-label form-label" for="">{{ __('Nama Unit Kerja') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input
                                                        value="{{$KodePengguna->nama_jabatan ?? ''}}"
                                                        id="kode_jabatan"
                                                        name="nama_jabatan"
                                                        type="text"
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_jabatan')])
                                                        value="{{ old('') }}"
                                                    />
                                                    @error('')
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
                         <a href="{{ route('kode_pengguna.index') }}" class="btn btn-primary" style="background-color: red">{{  __('Kembali')  }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($KodePengguna->id) ? __('Perbarui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
