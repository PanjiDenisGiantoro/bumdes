@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">{{ __('Produk Usaha') }}</h3>
    <br>
{{--    <x-breadcrumb title="{{ __('Informasi Produk') }}">--}}
{{--        <!-- <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('daftar_produk.index') }}">{{ __('Anggota') }}</a>--}}
{{--        </li>--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('daftar_produk.index') }}">{{ __('Daftar Anggota') }}</a>--}}
{{--        </li> -->--}}
{{--        <li class="breadcrumb-item">--}}
{{--            {{ __('Informasi Produk') }}</a>--}}
{{--        </li>--}}
{{--    </x-breadcrumb>--}}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Edit Produk') }}</h5>

                <form method="POST" id="produk_form" class="form-horizontal" action="{{ route('daftar_produk.update', [$daftar_produk->id])}}" enctype="multipart/form-data">
                    @csrf

                    @if (!empty($daftar_produk->id))
                        @method('PUT')
                    @endif

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                	<div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="nama_produk">{{ __('Nama Produk') }}<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                value="{{$daftar_produk->nama_produk ??''}}"
                                                id="nama_produk"
                                                name="nama_produk"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_produk')])
                                                value="{{ old('nama_produk') }}"
                                            />
                                            @error('nama_produk')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="kode_produk">{{ __('Kode Produk') }}<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                value="{{$daftar_produk->kode_produk ??''}}"
                                                id="kode_produk"
                                                name="kode_produk"
                                                type="text"
                                                class="form-control"
                                                readonly
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                            		 	<div class="col-md-3">
                                            <label class="control-label form-label" for="id_kategori_produk">{{ __('Kategori') }}<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="id_kategori_produk" class="form-control select2" data-placeholder="{{ __('Pilih Kategori') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Kategori') }}</option>
                                                @foreach ($kategori as $id => $name)
                                                    <option value="{{$id}}"@if($id == $daftar_produk->id_kategori_produk) selected @endif>{{$name}}</option>
                                                @endforeach
                                                </select>
                                        </div>
{{--                                        <div class="col-md-2">--}}
{{--                                            <label class="control-label form-label" for="kode_sku">{{ __('Kode SKU') }}</label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-3">--}}
{{--                                            <input--}}
{{--                                                value="{{$daftar_produk->kode_sku ??''}}"--}}

{{--                                                id="kode_sku"--}}
{{--                                                name="kode_sku"--}}
{{--                                                type="text"--}}
{{--                                                class="form-control"--}}

{{--                                            />--}}
{{--                                        </div>--}}
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="berat_satuan">{{ __('Berat Satuan') }}<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="berat_satuan" class="form-control select2" data-placeholder="{{ __('Pilih Berat Satuan') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Berat Satuan') }}</option>
                                                @foreach ($berat as $id => $name)
                                                    <option value="{{$id}}"@if($id == $daftar_produk->berat_satuan) selected @endif>{{$name}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="id_satuan">{{ __('Satuan') }}<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="id_satuan" class="form-control select2" data-placeholder="{{ __('Pilih Satuan') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Satuan') }}</option>
                                                @foreach ($satuan as $id => $name)
                                                    <option value="{{$id}}"@if($id == $daftar_produk->id_satuan) selected @endif>{{$name}}</option>
                                                @endforeach
                                            </select>
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
                                            >{{$daftar_produk->keterangan ??'' }}</textarea>
                                            @error('keterangan')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
{{--                                    	<div class="col-md-3">--}}
{{--                                            <label class="control-label form-label" for="id_gudang">{{ __('Gudang') }}</label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-4">--}}
{{--                                            <select name="id_gudang" class="form-control select2" data-placeholder="{{ __('Pilih Gudang') }}" data-minimum-results-for-search="Infinity">--}}
{{--                                                <option value="">{{ __('Pilih Gudang') }}</option>--}}
{{--                                                @foreach ($gudang as $id => $name)--}}
{{--                                                    <option value="{{$id}}"@if($id == $daftar_produk->id_gudang)selected @endif>{{$name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="no_barcode">{{ __('No. Barcode') }}<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                value="{{$daftar_produk->no_barcode ??''}}"

                                                id="no_barcode"
                                                name="no_barcode"
                                                type="text"
                                                class="form-control"

                                            />
                                        </div>
                                        <!-- <div class="col-md-3">
                                            <label class="control-label form-label" for="batch">{{ __('Batch') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                id="batch"
                                                name="batch"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('batch')])
                                                value="{{ old('batch') }}"
                                            />
                                            @error('batch')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div> -->
                                    </div>
                                </div>
                                <br>
                                <div class="form-group clearfix">
                                    <div class="row">
                                    	<div class="col-md-3">
                                            <label class="form-label" for="">{{ __('Upload Gambar Produk') }}<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="custom-file">
                                                <input type="hidden" name="exists_file_gambar" id="exists_file_gambar" value="{{$gambar[0] ?? ''}}">
                                                <input type="file" class="custom-file-input" name="gambar"onchange="showPreview(event);">
                                                <label class="custom-file-label" id="label_gambar">{{ isset($gambar[0]) ?  str_replace("produk/$daftar_produk->id/", '', $gambar[0]) : 'Upload Gambar Produk' }}</label>
                                            </div>
                                        </div>



                                        <!-- <div class="col-md-3">
                                            <label class="control-label form-label" for="batch">{{ __('Batch') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                id="batch"
                                                name="batch"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('batch')])
                                                value="{{ old('batch') }}"
                                            />
                                            @error('batch')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div> -->
                                    </div>
                                    <br>
                                    <center>
                                    <div class="col-md-4">
                                        <img id="file-ip-1-preview" width="250" height="200"src="{{ asset('storage/' . ($gambar[0] ?? '')) }}">
                                        <br>
                                        <button type="button" class="btn btn-danger  fa fa-trash" onclick="deleteGambar()"></button>
                                    </div>
                                    </center>
                                </div>

                            </div>
                        </div>
                        <br>
                        <h3 class="card-title">{{ __('Informasi Pembelian')}}</h3>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="harga_beli_amount">{{ __('Harga Beli') }}<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text"
                                               @class(['required', 'form-control', 'is-invalid' => $errors->has('harga_beli_amount')])
                                        value="{{number_format($daftar_produk->harga_beli) ??''}}"
                                        style="text-align: right;"
                                        id="harga_beli_amount"
                                        name="harga_beli_amount"
                                        aria-label="Amount (to the nearest dollar)">
                                    </div>
                                    @error('harga_beli_amount')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-9">
                                    <input
                                        hidden
                                        value="{{$daftar_produk->harga_beli ??''}}"
                                        id="harga_beli"
                                        name="harga_beli"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('harga_beli')])
                                    value="{{ old('harga_beli') }}"
                                    />
                                    @error('harga_beli')
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
                                                <label class="control-label form-label" for="akun_pembelian">{{ __('Akun Pembelian') }}<span
                                                        class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-9">
                                                <select id="akun_pembelian" name="akun_pembelian" class="form-control select2" data-placeholder="{{ __('Pilih Akun Pembelian') }}">
                                                    <option value="">{{ __('Pilih Akun Pembelian') }}</option>
                                                    @foreach ($akun as $gl)
                                                        <option value="{{$gl->id}}"@if($gl->id == $daftar_produk->akun_pembelian)selected @endif>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="control-label form-label" for="pajak_beli">{{ __('Pajak') }}<span
                                                        class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-9">
                                                <select id="pajak_beli" name="pajak_pembelian" class="form-control select2" data-placeholder="{{ __('Pilih Pajak') }}">
                                                    <option value="">{{ __('Pilih Pajak') }}</option>
                                                    @foreach ($pajak as $id => $name)
                                                        <option value="{{$id}}" @if($id == $daftar_produk->pajak_pembelian)selected @endif>{{$name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <h3 class="card-title">{{ __('Informasi Penjualan')}}</h3>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="harga_anggota">{{ __('Harga Anggota') }}<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text"
                                               @class(['required', 'form-control', 'is-invalid' => $errors->has('harga_anggota')])
                                        value="{{number_format($daftar_produk->harga_anggota )??''}}"
                                        style="text-align: right;"
                                        id="harga_anggota_amount"
                                        name="harga_anggota_amount"
                                        aria-label="Amount (to the nearest dollar)">

                                    </div>
                                    <input
                                        hidden
                                        id="harga_anggota"
                                        value="{{$daftar_produk->harga_anggota ??''}}"
                                        name="harga_anggota"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('harga_anggota')])
                                    value="{{ old('harga_anggota') }}"
                                    />
                                    @error('harga_anggota')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="pajak_penjualan">{{ __('Pajak') }}<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-3">
                                    <select id="pajak_penjualan" name="pajak_penjualan" class="form-control select2" data-placeholder="{{ __('Pilih Pajak') }}">
                                        <option value="">{{ __('Pilih Pajak') }}</option>
                                        @foreach ($pajak as $id => $name)
                                            <option value="{{$id}}" @if($id == $daftar_produk->pajak_penjualan)selected @endif>{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
{{--                                <div class="col-md-2">--}}
{{--                                    <label class="control-label form-label" for="harga_bukan_anggota">{{ __('Harga Bukan Anggota') }}</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-3">--}}
{{--                                    <div class="input-group mb-3">--}}
{{--                                        <div class="input-group-prepend">--}}
{{--                                            <span class="input-group-text">Rp.</span>--}}
{{--                                        </div>--}}
{{--                                        <input type="text"--}}
{{--                                               @class(['required', 'form-control', 'is-invalid' => $errors->has('harga_bukan_anggota')])--}}
{{--                                        value="{{number_format($daftar_produk->harga_bukan_anggota )??''}}"--}}
{{--                                        style="text-align: right;"--}}
{{--                                        id="harga_bukan_anggota_amount"--}}
{{--                                        name="harga_bukan_anggota_amount"--}}
{{--                                        aria-label="Amount (to the nearest dollar)">--}}
{{--                                    </div>--}}
{{--                                    <input--}}
{{--                                        hidden--}}
{{--                                        id="harga_bukan_anggota"--}}
{{--                                        value="{{$daftar_produk->harga_bukan_anggota ??''}}"--}}
{{--                                        name="harga_bukan_anggota"--}}
{{--                                        type="text"--}}
{{--                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('harga_bukan_anggota')])--}}
{{--                                    value="{{ old('harga_bukan_anggota') }}"--}}
{{--                                    />--}}
{{--                                    @error('harga_bukan_anggota')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                                        {{ $message }}--}}
{{--                                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
                            </div>
                        </div>

{{--                                    <div class="form-group clearfix">--}}
{{--                                        <div class="row">--}}
{{--                                        	<div class="col-md-3">--}}
{{--                                                <label class="control-label form-label" for="harga_jual">{{ __('Harga Jual') }}</label>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-4">--}}
{{--                                                <input--}}
{{--                                                    value="{{$daftar_produk->harga_jual ??''}}"--}}

{{--                                                    id="harga_jual"--}}
{{--                                                    name="harga_jual"--}}
{{--                                                    type="text"--}}
{{--                                                    @class(['required', 'form-control', 'is-invalid' => $errors->has('harga_jual')])--}}
{{--                                                    value="{{ old('harga_jual') }}"--}}
{{--                                                />--}}
{{--                                                @error('harga_jual')--}}
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
                                                <label class="control-label form-label" for="akun_penjualan">{{ __('Akun Penjualan') }}<span
                                                        class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-9">
                                                <select id="akun_penjualan" name="akun_penjualan" class="form-control select2" data-placeholder="{{ __('Pilih Akun Penjualan') }}">
                                                    <option value="">{{ __('Pilih Akun Penjualan') }}</option>
                                                    @foreach ($akun as $gl)
                                                        <option value="{{$gl->id}}"@if($gl->id == $daftar_produk->akun_penjualan)selected @endif>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- <div class="col-md-2">
                                                <label class="control-label form-label" for="harga_anggota">{{ __('Harga Anggota') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input
                                                    id="harga_anggota"
                                                    name="harga_anggota"
                                                    type="text"
                                                    @class(['required', 'form-control', 'is-invalid' => $errors->has('harga_anggota')])
                                                    value="{{ old('harga_anggota') }}"
                                                />
                                                @error('harga_anggota')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div> -->
                                        </div>
                                    </div>

                                    <br>
                                    <h3 class="card-title">{{ __('Informasi Inventori')}}</h3>

                                    <div class="form-group clearfix">
                                        <div class="row">
                                        	<div class="col-md-3">
                                                <label class="control-label form-label" for="inventori">{{ __('Inventori') }}<span
                                                        class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-9">
                                                <select id="inventori" name="inventory" class="form-control select2" data-placeholder="{{ __('Pilih Inventori') }}">
                                                    <option value="">{{ __('Pilih Inventori') }}</option>
                                                    <option value="1"@if($daftar_produk->inventory == 1) selected @endif>{{ __('Ya') }}</option>
                                                	<option value="0"@if($daftar_produk->inventory == 0) selected @endif>{{ __('Tidak') }}</option> -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <div class="row">
                                             <div class="col-md-3">
                                                <label class="control-label form-label" for="akun_tersedia">{{ __('Akun Tersedia') }}<span
                                                        class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-9">
                                                <select id="akun_tersedia" name="akun_tersedia" class="form-control select2" data-placeholder="{{ __('Pilih Akun Tersedia') }}">
                                                    <option value="">{{ __('Pilih Akun Tersedia') }}</option>
                                                    @foreach ($akun as $gl)
                                                        <option value="{{$gl->id}}"@if($gl->id == $daftar_produk->akun_tersedia)selected @endif>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                @endforeach
                                                    <!-- <option value="Ya">{{ __('Ya') }}</option>
                                                	<option value="Tidak">{{ __('Tidak') }}</option> -->
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="control-label form-label" for="stok">{{ __('Stok Tersedia') }}<span
                                                        class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-9">
                                                <input
                                                    value="{{$daftar_produk->stok ??''}}"

                                                    id="stok"
                                                    name="stok"
                                                    type="text"
                                                    @class(['required', 'form-control', 'is-invalid' => $errors->has('stok')])
                                                    value="{{ old('stok') }}"
                                                />
                                                @error('stok')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                    </div>
                    <div class="card-footer border border-top-0 text-right">
                         <a href="{{ route('daftar_produk.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Kembali') }}</a>
{{--                        <button type="submit" class="btn btn-primary">{{ !empty($daftar_produk->id) ? __('Perbaharui') : __('Kirim') }}</button>--}}
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmationModal">
                            {{ __('Kirim') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade zoom" tabindex="-1" id="confirmationModal">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <center> <i class="fe fe-alert-circle fa-4x" style="color: red;"></i></center>
                    <br>
                    <center><h2>Notifikasi</h2></center>
                    <p style="text-align: center;font-size: 15px">Adakah Anda Ingin Melanjutkan Proses Ini ? </p>
                    <div class="text-center">
                        <a href="#" class="btn btn-md btn-primary mr-3" id="confirmBtn">
                            Lanjutkan
                        </a>
                        <a data-dismiss="modal" href="#" class="btn btn-md btn-danger">
                            Tidak
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $('.select2').select2();

        $('#harga_beli_amount').on('keyup',function(){
            $('#harga_beli_amount').mask("#,##0", {reverse: true});
            test_value = $(this).val().replace(/[^0-9]+/g, "");
            $('#harga_beli').val(test_value)
        })
        $('#harga_anggota_amount').on('keyup',function(){
            $('#harga_anggota_amount').mask("#,##0", {reverse: true});
            test_value = $(this).val().replace(/[^0-9]+/g, "");
            $('#harga_anggota').val(test_value)
        })
        $('#harga_bukan_anggota_amount').on('keyup',function(){
            $('#harga_bukan_anggota_amount').mask("#,##0", {reverse: true});
            test_value = $(this).val().replace(/[^0-9]+/g, "");
            $('#harga_bukan_anggota').val(test_value)
        })
        function showPreview(event){
            if(event.target.files.length > 0){
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                document.getElementById('label_gambar').innerHTML = event.target.files[0].name
                document.getElementById('exists_file_gambar').value = event.target.files[0].name
                preview.src = src;
                preview.style.display = "block";
            }
        }

        function deleteGambar() {

            var preview = document.getElementById("file-ip-1-preview");
            document.getElementById('label_gambar').innerHTML = "Upload Gambar Produk"
            document.getElementById('exists_file_gambar').value = ""
            preview.src = '';

        }
    </script>
    <script>
        $('#confirmBtn').on('click', function() {
            var nama_produk = document.forms["produk_form"]["nama_produk"];
            var id_kategori_produk = document.forms["produk_form"]["id_kategori_produk"];
            var id_satuan = document.forms["produk_form"]["id_satuan"];
            var berat_satuan = document.forms["produk_form"]["berat_satuan"];
            var no_barcode = document.forms["produk_form"]["no_barcode"];
            var gambar = document.forms["produk_form"]["gambar"];
            var akun_pembelian = document.forms["produk_form"]["akun_pembelian"];
            var harga_beli_amount = document.forms["produk_form"]["harga_beli_amount"];
            var pajak_beli = document.forms["produk_form"]["pajak_beli"];
            var harga_anggota_amount = document.forms["produk_form"]["harga_anggota_amount"];
            var pajak_penjualan = document.forms["produk_form"]["pajak_penjualan"];
            var akun_penjualan = document.forms["produk_form"]["akun_penjualan"];
            var inventory = document.forms["produk_form"]["inventory"];
            var akun_tersedia = document.forms["produk_form"]["akun_tersedia"];
            var stok = document.forms["produk_form"]["stok"];



            if (stok.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Stok wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (akun_tersedia.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Akun Tersedia wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (inventory.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Inventory wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (akun_penjualan.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Akun Penjualan wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (pajak_penjualan.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Pajak Penjualan wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (harga_anggota_amount.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Harga Anggota wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (pajak_beli.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Pajak Beli wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (harga_beli_amount.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Harga Beli wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (akun_pembelian.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Akun Pembelian wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (gambar.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Gambar Produk wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }

            if (no_barcode.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom No Barcode Produk wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }

            if (berat_satuan.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Berat Satuan Produk wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (nama_produk.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Nama Produk wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (id_kategori_produk.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom kategori Produk wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (id_satuan.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Satuan wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }

            $('#produk_form').submit();
        });
    </script>
@endpush
