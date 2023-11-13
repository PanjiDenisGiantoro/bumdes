@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Kelompok Aset') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Kelompok Aset') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kelompok_aset.index') }}">{{ __('Kelompok Aset') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ !empty($template_wa->id) ? __('Edit Kelompok Aset') : __('Tambah Kelompok Aset') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ !empty($template_wa->id) ? __('Edit Kelompok Aset') : __('Tambah Kelompok Aset') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($template_wa->id) ? route('kelompok_aset.update', [$template_wa->id]) : route('kelompok_aset.store') }}">

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
                                                    <label class="control-label form-label" for="kelompok_aset">{{ __('Kelompok Asset') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input
                                                        value="{{$template_wa->kelompok_aset ??''}}"
                                                        id="kelompok_aset"
                                                        name="kelompok_aset"
                                                        type="text"
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('kelompok_aset')])
                                                    />
                                                    @error('kelompok_aset')
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
                                                        <label class="control-label form-label" for="keterangan">{{ __('Keterangan') }}</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <textarea
                                                            id="keterangan"
                                                            name="keterangan"
                                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('keterangan')])
                                                            rows="5"
                                                        > {{$template_wa->keterangan ??''}} </textarea>
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
                        <a href="{{ route('kelompok_aset.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($template_wa->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($template_wa->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
