@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">Daftar Aset</h3>
    <br>
{{--    <x-breadcrumb title="{{ __('Informasi Aset') }}">--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('daftar_aset.index') }}">{{ __('Aset Mgmt.') }}</a>--}}
{{--        </li>--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('daftar_aset.index') }}">{{ __('Lihat Daftar Aset') }}</a>--}}
{{--        </li>--}}
{{--        <li class="breadcrumb-item">--}}
{{--            {{ __('Lihat Informasi Aset') }}</a>--}}
{{--        </li>--}}
{{--    </x-breadcrumb>--}}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Informasi Aset') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($daftar_aset->id) ? route('daftar_aset.update', [$daftar_aset->id]) : route('daftar_aset.store') }}">

                    @if (!empty($daftar_aset->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label" for="tanggal_input">Tanggal Input</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="tanggal_input" id="tanggal_input" disabled value="{{\Carbon\Carbon::parse($daftar_aset->created_at)->format('d/m/Y') ?? ''}}">
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="id_kode_kelompok_aset">{{ __('Nama Kelompok Aset') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="id_kode_kelompok_aset" id="id_kode_kelompok_aset"disabled class="form-control">
                                                @foreach($kelompokaset as $data)
                                                    <option value="{{$data->id}}"@if($daftar_aset->id ?? '' == $data->id)selected @endif>{{$data->kelompok_aset}}</option>
                                                @endforeach
                                            </select>
                                            @error('nama_aset')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="jumlah_aset">{{ __('Jumlah Aset') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                disabled
                                                value="{{$daftar_aset->jumlah_aset ?? ''}}"
                                                id="jumlah_aset"
                                                name="jumlah_aset"
                                                type="text"
                                                class="form-control"

                                            />
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="nama_aset">{{ __('Nama Aset') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                disabled
                                                value="{{$daftar_aset->nama_aset ?? ''}}"
                                                id="nama_aset"
                                                name="nama_aset"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_aset')])

                                            />
                                            @error('nama_aset')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="nomor_aset">{{ __('Nomor Aset') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                disabled
                                                value="{{$daftar_aset->nomor_aset ?? ''}}"
                                                id="nomor_aset"
                                                name="nomor_aset"
                                                type="text"
                                                class="form-control"

                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="tanggal_akuisisi">{{ __('Tanggal Akuisisi') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                value="{{$daftar_aset->tanggal_akuisisi ?? ''}}"
                                                disabled
                                                id="tanggal_akuisisi"
                                                name="tanggal_akuisisi"
                                                type="date"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('tanggal_akuisisi')])
                                            />
                                            @error('tanggal_akuisisi')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="biaya_akuisisi">{{ __('Biaya Akuisisi') }}</label>
                                        </div>
                                        <div class="col-md-3">

                                            <input type="text"disabled class="form-control" name="biaya_akuisisi" id="biaya_akuisisi" required value="{{ $daftar_aset->biaya_akuisisi ?? ''}}" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'"
                                                {{ !empty($daftar_aset->id) ? $daftar_aset->biaya_akuisisi== '1' ? 'disabled' : '' : '' }}>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="akun_aset_tetap">{{ __('Akun Aset Tetap') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select name="akun_aset_tetap" class="form-control select2" data-placeholder="{{ __('Pilih Akun Aset Tetap') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Akun Aset Tetap') }}</option>
                                            <!--  <option value="M">{{ __('Pria') }}</option>
                                                <option value="F">{{ __('Wanita') }}</option> -->
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            <!--  <div class="form-group clearfix">
                                    <div class="row">
                                    	<div class="col-md-3">
                                            <label class="control-label form-label" for="akun_aset_tetap">{{ __('Akun Aset Tetap') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select name="akun_aset_tetap" class="form-control select2" data-placeholder="{{ __('Pilih Akun Aset Tetap') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Akun Aset Tetap') }}</option>
                                                <option value="M">{{ __('Pria') }}</option>
                                                <option value="F">{{ __('Wanita') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="akun_kredit">{{ __('Akun Dikreditkan') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                                value="{{$daftar_aset->akun_kredit ?? ''}}"
                                                disabled
                                                id="akun_kredit"
                                                name="akun_kredit"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('akun_kredit')])
                                            value="{{ old('akun_kredit') }}"
                                            />
                                            @error('akun_kredit')
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
                                                    disabled
                                                    id="keterangan"
                                                    name="keterangan"
                                                    @class(['required', 'form-control', 'is-invalid' => $errors->has('keterangan')])
                                            rows="5"
                                            >{{$daftar_aset->keterangan ?? ''}}
                                            </textarea>
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
                        <br>
                        <h3 class="card-title">{{ __('Informasi Penyusutan')}}</h3>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="disusutkan">{{ __('Disusutkan') }}</label>
                                </div>
                                <div class="col-md-4" style="font-size: 15px">
                                    <input type="radio" name="disusutkan" value="1"@if($daftar_aset->disusutkan == '1')checked @endif disabled> Ya<br>
                                    <input type="radio" name="disusutkan" value="0"@if($daftar_aset->disusutkan == '0')checked @endif disabled> Tidak<br>
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="akun_beban_penyusutan">{{ __('Akun Beban Penyusutan') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <select name="akun_beban_penyusutan" disabled class="form-control select2" data-placeholder="{{ __('Pilih Akun Beban Penyusutan') }}" data-minimum-results-for-search="Infinity">
                                        <option value="">{{ __('Pilih Akun Beban Penyusutan') }}</option>
                                    <!--  <option value="M">{{ __('Pria') }}</option>
                                                    <option value="F">{{ __('Wanita') }}</option> -->
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="akun_akumulasi_penyusutan">{{ __('Akun Akumulasi Penyusutan') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <select name="akun_akumulasi_penyusutan" class="form-control select2" data-placeholder="{{ __('Pilih Akun Akumulasi Penyusutan') }}" data-minimum-results-for-search="Infinity">
                                        <option value="">{{ __('Pilih Akun Akumulasi Penyusutan') }}</option>
                                    <!--  <option value="M">{{ __('Pria') }}</option>
                                                    <option value="F">{{ __('Wanita') }}</option> -->
                                    </select>
                                </div>
                            <!-- <div class="col-md-3">
                                                <label class="control-label form-label" for="akun_pembelian">{{ __('Akun Pembelian') }}</label>
                                            </div>
                                            <div class="col-md-9">
                                                <select id="akun_pembelian" name="akun_pembelian" class="form-control select2" data-placeholder="{{ __('Pilih Akun Pembelian') }}">
                                                    <option value="">{{ __('Pilih Akun Pembelian') }}</option>
                                                </select>
                                            </div> -->
                            </div>
                        </div>

                        {{--                                    <div class="form-group clearfix">--}}
                        {{--                                        <div class="row">--}}
                        {{--                                             <div class="col-md-3">--}}
                        {{--                                                <label class="control-label form-label" for="masa_manfaat">{{ __('Masa Manfaat') }}</label>--}}
                        {{--                                            </div>--}}
                        {{--                                            <div class="col-md-4">--}}
                        {{--                                                <input--}}
                        {{--                                                    value="{{$daftar_aset->masa_manfaat ?? ''}}"--}}
                        {{--                                                    id="masa_manfaat"--}}
                        {{--                                                    name="masa_manfaat"--}}
                        {{--                                                    type="text"--}}
                        {{--                                                    @class(['required', 'form-control', 'is-invalid' => $errors->has('masa_manfaat')])--}}
                        {{--                                                    value="{{ old('masa_manfaat') }}"--}}
                        {{--                                                />--}}
                        {{--                                                @error('masa_manfaat')--}}
                        {{--                                                    <span class="invalid-feedback" role="alert">--}}
                        {{--                                                        {{ $message }}--}}
                        {{--                                                    </span>--}}
                        {{--                                                @enderror--}}
                        {{--                                            </div>--}}
                        {{--                                            <div class="col-md-2">--}}
                        {{--                                                <label class="control-label form-label" for="saldo_awal_akumulasi">{{ __('saldo Awal Akumulasi Penyusutan') }}</label>--}}
                        {{--                                            </div>--}}
                        {{--                                            <div class="col-md-3">--}}
                        {{--                                                <input--}}
                        {{--                                                    value="{{$daftar_aset->saldo_awal_akumulasi ?? ''}}"--}}

                        {{--                                                    id="saldo_awal_akumulasi"--}}
                        {{--                                                    name="saldo_awal_akumulasi"--}}
                        {{--                                                    type="text"--}}
                        {{--                                                    @class(['required', 'form-control', 'is-invalid' => $errors->has('saldo_awal_akumulasi')])--}}
                        {{--                                                    value="{{ old('saldo_awal_akumulasi') }}"--}}
                        {{--                                                />--}}
                        {{--                                                @error('saldo_awal_akumulasi')--}}
                        {{--                                                    <span class="invalid-feedback" role="alert">--}}
                        {{--                                                        {{ $message }}--}}
                        {{--                                                    </span>--}}
                        {{--                                                @enderror--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="nilai">{{ __('Masa Manfaat ( Bulan )') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        value="{{$daftar_aset->nilai ?? ''}}"
                                        disabled
                                        id="nilai"
                                        name="nilai"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('nilai')])
                                    value="{{ old('nilai') }}"
                                    />
                                    @error('nilai')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-2">

                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-4">
                                <div class="form-group" ><!-- //auto calculate -->
                                    <label class="form-label" for="akhir_masa_manfaat">Akhir Waktu Manfaat</label>
                                    <input type="text" class="form-control" id="akhir_masa_manfaat" value="{{$daftar_aset->akhir_masa_manfaat ?? ''}}" name="akhir_masa_manfaat" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group" ><!-- //auto calculate -->
                                    <label class="form-label" for="perbedaan_bulan">Perbedaan Bulan Semasa</label>
                                    <input type="text" class="form-control" name="perbedaan_bulan" id="perbedaan_bulan" value="{{$daftar_aset->perbedaan_bulan ?? ''}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-4">
                                <div class="form-group" >
                                    <label class="form-label" for="penyusutan_bulanan">Penyusutan Per Bulan</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-sign-idr"></em>
                                        </div>
                                        <input type="text" class="form-control" name="penyusutan_bulanan" id="penyusutan_bulanan" value="{{$daftar_aset->penyusutan_bulanan ?? ''}}"  data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group" >
                                    <label class="form-label" for="total_penyusutan">Total Akumulasi Susutan</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-sign-idr"></em>
                                        </div>
                                        <input type="text" class="form-control" value="{{$daftar_aset->total_penyusutan ?? ''}}" name="total_penyusutan" id="total_penyusutan" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group" >
                                    <label class="form-label" for="perkiraan_akhir_buku">Perkiraan akhir buku</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-sign-idr"></em>
                                        </div>
                                        <input type="text" class="form-control" value="{{$daftar_aset->perkiraan_akhir_buku ?? ''}}" name="perkiraan_akhir_buku" id="perkiraan_akhir_buku" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border border-top-0 text-right">
                        <a href="{{ route('daftar_aset.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Batal') }}</a>
                    <!-- <button type="{{ route('daftar_aset.index') }}" class="btn btn-primary" style="background-color: red"> Batal</button> -->
                        <button type="submit" class="btn btn-primary">{{ !empty($anggota->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
