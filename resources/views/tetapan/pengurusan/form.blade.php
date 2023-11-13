@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Pengurusan') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Pengurusan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('status_keanggotaan.index') }}">{{ __(' Pengurusan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Edit Pengurusan') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Pengurusan') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($pengurusan->id) ? route('pengurusan.update', [$pengurusan->id]) : route('pengurusan.store') }}">

                    @if (!empty($pengurusan->id))
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
                                            <label class="control-label form-label" for="nama">{{ __('Nama Kepengurusan') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                                value="{{!empty($pengurusan->nama) ? $pengurusan->nama : ''}}"
                                                id="nama"
                                                name="nama"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('nama')])
                                            />
                                            @error('nama')
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
                                                    <label class="control-label form-label" for="jabatan">{{ __('Jabatan') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input
                                                        value="{{!empty($pengurusan->jabatan) ? $pengurusan->jabatan : ''}}"
                                                        id="jabatan"
                                                        name="jabatan"
                                                        type="text"
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('jabatan')])
                                                    />
                                                    @error('jabatan')
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
                        <a href="{{ route('pengurusan.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($pengurusan->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($pengurusan->id) ? __('Perbarui') : __('Simpan') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
