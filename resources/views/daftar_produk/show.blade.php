@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">{{ __('Produk Usaha') }}</h3>
    <br>
{{--    <x-breadcrumb title="{{ __('Informasi Produk') }}">--}}
{{--    <!-- <li class="breadcrumb-item">--}}
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
                <h5 class="card-header">{{ __('Lihat Produk') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ route('daftar_produk.update', [$daftar_produk->id])}}" enctype="multipart/form-data">
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
                                            <label class="control-label form-label" for="nama_produk">{{ __('Nama Produk') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                value="{{$daftar_produk->nama_produk ??''}}"

                                                disabled
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
                                            <label class="control-label form-label" for="kode_produk">{{ __('Kode Produk') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                value="{{$daftar_produk->kode_produk ??''}}"
                                                disabled
                                                id="kode_produk"
                                                name="kode_produk"
                                                type="text"
                                                class="form-control"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="id_kategori_produk">{{ __('Kategori') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="id_kategori_produk" class="form-control select2"disabled data-placeholder="{{ __('Pilih Kategori') }}" data-minimum-results-for-search="Infinity">
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
                                            <label class="control-label form-label" for="berat_satuan">{{ __('Berat Satuan') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="berat_satuan" class="form-control select2"disabled data-placeholder="{{ __('Pilih Berat Satuan') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Berat Satuan') }}</option>
                                                @foreach ($berat as $id => $name)
                                                    <option value="{{$id}}"@if($id == $daftar_produk->berat_satuan) selected @endif>{{$name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="id_satuan">{{ __('Satuan') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="id_satuan" class="form-control select2"disabled data-placeholder="{{ __('Pilih Satuan') }}" data-minimum-results-for-search="Infinity">
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
                                                disabled
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
                                <div class="col-md-3">
                                            <label class="control-label form-label" for="no_barcode">{{ __('No. Barcode') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                value="{{$daftar_produk->no_barcode ??''}}"
                                                disabled
                                                id="no_barcode"
                                                name="no_barcode"
                                                type="text"
                                                class="form-control"

                                            />
                                            {!! \Milon\Barcode\DNS1D::getBarcodeHTML($daftar_produk->no_barcode, 'I25+') !!}
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
                                            <label class="form-label" for="">{{ __('Upload Gambar Produk') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="custom-file">
                                                <input type="hidden" name="exists_file_gambar" id="exists_file_gambar" value="{{$gambar[0] ?? ''}}">
                                                <input type="file" disabled class="custom-file-input" name="gambar"onchange="showPreview(event);">
                                                <label class="custom-file-label"disabled id="label_gambar">{{ isset($gambar[0]) ?  str_replace("produk/$daftar_produk->id/", '', $gambar[0]) : 'Upload Gambar Produk' }}</label>
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
                                            <img id="file-ip-1-preview"disabled width="250" height="200"src="{{ asset('storage/' . ($gambar[0] ?? '')) }}">
                                            <br>
{{--                                            <button type="button"disabled class="btn btn-danger  fa fa-trash" onclick="deleteGambar()"></button>--}}
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
                                    <label class="control-label form-label" for="harga_beli">{{ __('Harga Beli') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <input
                                        value="{{number_format($daftar_produk->harga_beli),2 ??''}}"
                                        disabled
                                        id="harga_beli"
                                        name="harga_beli"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('harga_beli')])

                                    />
                                    @error('harga_beli')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>
                            <!-- <div class="col-md-2">
                                                <label class="control-label form-label" for="alamat">{{ __('Nomor Rumah') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input
                                                    id="alamat"
                                                    name="alamat"
                                                    type="text"
                                                    @class(['required', 'form-control', 'is-invalid' => $errors->has('alamat')])
                                                    value="{{ old('alamat') }}"
                                                />
                                                @error('alamat')
                                <span class="invalid-feedback" role="alert">
{{ $message }}
                                </span>
@enderror
                                </div> -->
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="akun_pembelian">{{ __('Akun Pembelian') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <select id="akun_pembelian" name="akun_pembelian"disabled class="form-control select2" data-placeholder="{{ __('Pilih Akun Pembelian') }}">
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
                                    <label class="control-label form-label" for="pajak_beli">{{ __('Pajak') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <select id="pajak_beli" name="pajak_pembelian"disabled class="form-control select2" data-placeholder="{{ __('Pilih Pajak') }}">
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
                                    <label class="control-label form-label" for="harga_anggota">{{ __('Harga Anggota') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        value="{{number_format($daftar_produk->harga_anggota ),2 ??''}}"
                                        disabled
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
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="pajak_penjualan">{{ __('Pajak') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <select id="pajak_penjualan" name="pajak_penjualan"disabled class="form-control select2" data-placeholder="{{ __('Pilih Pajak') }}">
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
{{--                                    <input--}}
{{--                                        value="{{number_format($daftar_produk->harga_bukan_anggota),2 ??''}}"--}}
{{--                                        disabled--}}
{{--                                        id="harga_bukan_anggota"--}}
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
{{--                        <div class="form-group clearfix">--}}
{{--                            <div class="row">--}}
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

{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="akun_penjualan">{{ __('Akun Penjualan') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <select id="akun_penjualan" name="akun_penjualan"disabled class="form-control select2" data-placeholder="{{ __('Pilih Akun Penjualan') }}">
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
                                    <label class="control-label form-label" for="inventori">{{ __('Inventori') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <select id="inventori" name="inventory"disabled class="form-control select2" data-placeholder="{{ __('Pilih Inventori') }}">
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
                                    <label class="control-label form-label" for="akun_tersedia">{{ __('Akun Tersedia') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <select id="akun_tersedia" name="akun_tersedia"disabled class="form-control select2" data-placeholder="{{ __('Pilih Akun Tersedia') }}">
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
                                    <label class="control-label form-label" for="stok">{{ __('Stok Tersedia') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <input
                                        value="{{number_format($daftar_produk->stok),2 ??''}}"
                                        disabled
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
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
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
@endpush
