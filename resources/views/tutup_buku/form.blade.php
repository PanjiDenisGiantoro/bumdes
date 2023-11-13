@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Tutup Buku') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('transaksi_keuangan.index') }}">{{ __('Keuangan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('tutup_buku.index') }}">{{ __('Tutup Buku') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Tutup Buku') }}</a>
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Pilih Periode Tutup Buku') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($tutup_buku->id) ? route('tutup_buku.update', [$tutup_buku]) : route('tutup_buku.store') }}">

                    @if (!empty($tutup_buku->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                	<div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="dari_tanggal">{{ __('Dari Tanggal') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input 
                                                id="dari_tanggal" 
                                                name="dari_tanggal" 
                                                type="date" 
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('dari_tanggal')]) 
                                                value="{{ old('dari_tanggal') }}"
                                            />
                                            @error('dari_tanggal')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="sampai_tanggal">{{ __('Sampai Tanggal') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input 
                                                id="sampai_tanggal" 
                                                name="sampai_tanggal" 
                                                type="date" 
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('sampai_tanggal')]) 
                                                value="{{ old('sampai_tanggal') }}"
                                            />
                                            @error('sampai_tanggal')
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
                        <a href="{{ route('tutup_buku.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Batal') }}</a>
                        <!-- <button type="{{ route('daftar_aset.index') }}" class="btn btn-primary" style="background-color: red"> Batal</button> -->
                        <button type="submit" class="btn btn-primary">{{ !empty($anggota->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection