@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Termin') }}</h3>
<br>
<!-- <x-breadcrumb title="{{ __('Termin ') }}">
    <li class="breadcrumb-item">
        <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('setting_termin_penjualan.index') }}">{{ __('Termin ') }}</a>
    </li>
    <li class="breadcrumb-item">
        {{ !empty($TerminPenjualan->id) ? __('Edit Termin') : __('Tambah Termin') }}</a>
    </li>
</x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ !empty($TerminPenjualan->id) ? __('Edit Termin') : __('Tambah Termin') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($TerminPenjualan->id) ? route('setting_termin_penjualan.update', $TerminPenjualan->id) : route('setting_termin_penjualan.store') }}">

                    @if (!empty($TerminPenjualan->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="nama_termin_penjualan">{{ __('Nama Termin') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                                value="{{ !empty($TerminPenjualan->nama_termin_penjualan) ? $TerminPenjualan->nama_termin_penjualan : '' }}"
                                                id="nama_termin_penjualan"
                                                name="nama_termin_penjualan"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_termin_penjualan')])

                                            />
                                            @error('nama_termin_penjualan')
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
                                                    <label class="control-label form-label" for="hari_termin_penjualan">{{ __('Hari') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                            <input
                                                value="{{ !empty($TerminPenjualan->hari_termin_penjualan) ? $TerminPenjualan->hari_termin_penjualan : '' }}"
                                            id="hari_termin_penjualan"
                                            name="hari_termin_penjualan"
                                            type="number"
                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('hari_termin_penjualan')])

                                            />
                                            @error('hari_termin_penjualan')
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
                        <a href="{{ route('setting_termin_penjualan.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($TerminPenjualan->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($TerminPenjualan->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
