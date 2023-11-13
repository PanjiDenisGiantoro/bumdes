@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Kode Kelompok') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Informasi Kode Kelompok') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('transaksi_keuangan.index') }}">{{ __('Keuangan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
         <li class="breadcrumb-item">
            <a href="{{ route('kode_kelompok.index') }}">{{ __('Kode Kelompok') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Kode Kelompok') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Kode Kelompok') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($kode_kelompok->id) ? route('kode_kelompok.update', [$kode_kelompok]) : route('kode_kelompok.store') }}">

                    @if (!empty($kode_kelompok->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                	<div class="row">
                                		<div class="col-md-3">
                                            <label class="control-label form-label" for="kode">{{ __('Kode') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                id="kode" kode
                                                name="kode"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('kode')])
                                                value="{{ old('kode', $kode_kelompok->kode ?? '') }}"
                                            />
                                            @error('nama_pemohon')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="jenis_akun">{{ __('Jenis Akun') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="jenis" class="form-control select2" data-placeholder="{{ __('Pilih Jenis') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">Pilih Jenis</option>
                                                @foreach (\App\Models\KodeKelompok::JENIS as $i => $jenis)
                                                    <option value="{{ $i }}"{!! old('jenis', $kode_kelompok->jenis ?? '') == $i ? ' selected' : '' !!}>{{ $jenis }}</option>
                                                @endforeach
                                            </select>
                                        </div>
						           </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                    	<div class="col-md-3">
                                            <label class="control-label form-label" for="nama">{{ __('Nama Kelompok') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                                id="nama"
                                                name="nama"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('nama')])
                                                value="{{ old('nama', $kode_kelompok->nama ?? '') }}"
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
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="keterangan">{{ __('Keterangan') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea
                                                id="keterangan"
                                                name="keterangan"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('keterangan')])
                                                rows="5"
                                            >{{ old('keterangan', $kode_kelompok->keterangan ?? '') }}</textarea>
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
                    	<a href="{{ route('kode_kelompok.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($kode_kelompok->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($kode_kelompok->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('select').select2();

    $('select[name="parent_id"]').on('change', function () {
        let kode  = $(this).select2('data')[0].element.dataset.kode;
        let jenis = $(this).select2('data')[0].element.dataset.jenis;

        $('select[name="jenis"]').val(jenis).trigger('change');

        if ($('#kode').val() == '') {
            $('#kode').val(kode + '.');

            $('#kode').focus();

            setTimeout(function () {
                $('#kode').focus();
            }, 300);
        }
    });
});
</script>
@endpush
