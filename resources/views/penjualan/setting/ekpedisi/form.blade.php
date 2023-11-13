@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Ekspedisi') }}</h3>
<br>
<!-- <x-breadcrumb title="{{ __('Ekspedisi') }}">
    <li class="breadcrumb-item">
        <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('ekspedisi_penjualan.index') }}">{{ __('Ekspedisi') }}</a>
    </li>
    <li class="breadcrumb-item">
        {{ !empty($EkspedisiPenjualan->id) ? __('Edit Ekspedisi') : __('Tambah Ekspedisi') }}</a>
    </li>
</x-breadcrumb> -->
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 col-lg-10">
        <div class="card border-0 m-b-20">
            <h5 class="card-header">{{ !empty($EkspedisiPenjualan->id) ? __('Edit Ekspedisi') : __('Tambah Ekspedisi') }}</h5>

            <form method="POST" class="form-horizontal" action="{{ !empty($EkspedisiPenjualan->id) ? route('ekspedisi_penjualan.update', $EkspedisiPenjualan->id) : route('ekspedisi_penjualan.store') }}">

                @if (!empty($EkspedisiPenjualan->id))
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
                                        <label class="control-label form-label" for="nama_ekspedisi_penjualan">{{ __('Nama') }}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input value="{{ !empty($EkspedisiPenjualan->nama_ekspedisi_penjualan) ? $EkspedisiPenjualan->nama_ekspedisi_penjualan : '' }}"
                                        id="nama_ekspedisi_penjualan" name="nama_ekspedisi_penjualan" type="text"
                                        @class(['required', 'form-control' , 'is-invalid'=> $errors->has('nama_ekspedisi_penjualan')])

                                        />
                                        @error('nama_ekspedisi_penjualan')
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
                    <a href="{{ route('ekspedisi_penjualan.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($EkspedisiPenjualan->id) ? __('Kembali') : __('Kembali') }}</a>
                    <button type="submit" class="btn btn-primary">{{ !empty($EkspedisiPenjualan->id) ? __('Perbaharui') : __('Kirim') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
