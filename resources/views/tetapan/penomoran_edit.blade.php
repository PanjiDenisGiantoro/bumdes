@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Penomoran') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Penomoran') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Setting') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ url('penomoran') }}">{{ __('Penomoran') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="#">{{ __('Penomoran') }}{{$edit->keterangan}}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Penomoran') }} {{$edit->keterangan}}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($edit->id) ? route('penomoran.update', [$edit->id]) : route('penomoran.store') }}">
                    @if (!empty($edit->id))
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
                                            <label class="control-label form-label" for="head">{{ __('Kode Penomoran') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                                value="{{$edit->head ??''}}"
                                                id="head"
                                                name="head"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('head')])
                                            />
                                            @error('head')
                                            <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                @if($edit->keterangan == 'anggota')

                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <!-- <div class="col-md-3"> -->
                                            <div class="col-md-3">
                                                <label class="control-label form-label" for="kode Perusahaan">{{ __('Kode Perusahaan') }}</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"value="{{$perusahaan->kode_perusahaan ?? ''}}"readonly name="kode_perusahaan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <!-- <div class="col-md-3"> -->
                                            <div class="col-md-3">
                                                <label class="control-label form-label" for="kode_cabang">{{ __('Kode Cabang') }}</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="{{$perusahaan->kode_cabang ?? ''}}" name="kode_cabang" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    @endif
                                @if($edit->keterangan == 'simpanan')

                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <!-- <div class="col-md-3"> -->
                                            <div class="col-md-3">
                                                <label class="control-label form-label" for="kode Perusahaan">{{ __('Kode Perusahaan') }}</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"value="{{$perusahaan->kode_perusahaan ?? ''}}"readonly name="kode_perusahaan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <!-- <div class="col-md-3"> -->
                                            <div class="col-md-3">
                                                <label class="control-label form-label" for="kode_cabang">{{ __('Kode Cabang') }}</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="{{$perusahaan->kode_cabang ?? ''}}" name="kode_cabang" readonly>
                                            </div>
                                        </div>
                                    </div>

                                @endif
                                @if($edit->keterangan == 'pembiayaan')

                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <!-- <div class="col-md-3"> -->
                                            <div class="col-md-3">
                                                <label class="control-label form-label" for="kode Perusahaan">{{ __('Kode Perusahaan') }}</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"value="{{$perusahaan->kode_perusahaan ?? ''}}"readonly name="kode_perusahaan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <!-- <div class="col-md-3"> -->
                                            <div class="col-md-3">
                                                <label class="control-label form-label" for="kode_cabang">{{ __('Kode Cabang') }}</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="{{$perusahaan->kode_cabang ?? ''}}" name="kode_cabang" readonly>
                                            </div>
                                        </div>
                                    </div>

                                @endif

                                @if($edit->keterangan == 'simpanan_berjangka')

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <!-- <div class="col-md-3"> -->
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="kode Perusahaan">{{ __('Kode Perusahaan') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control"value="{{$perusahaan->kode_perusahaan ?? ''}}"readonly name="kode_perusahaan">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <!-- <div class="col-md-3"> -->
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="kode_cabang">{{ __('Kode Cabang') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="{{$perusahaan->kode_cabang ?? ''}}" name="kode_cabang" readonly>
                                        </div>
                                    </div>
                                </div>

                                @endif

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <!-- <div class="col-md-3"> -->
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="format_depan">{{ __('Format Penomoran 1') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select name="format_depan" id="format_depan" class="form-control">
                                                <option value="">Pilih Jenis Penomoran</option>
                                                <option value="d"@if(!empty($edit->format_depan) ? $edit->format_depan == 'd' : '')selected @endif>Tanggal ( 01 - 31 )</option>
                                                <option value="m"@if(!empty($edit->format_depan) ? $edit->format_depan == 'm' : '')selected @endif>Bulan ( 1 - 12 )</option>
                                                <option value="M"@if(!empty($edit->format_depan) ? $edit->format_depan == 'M' : '')selected @endif>Bulan (JAN - DES )</option>
                                                <option value="Y"@if(!empty($edit->format_depan) ? $edit->format_depan == 'Y' : '')selected @endif>Tahun ( 2022 - 2025 )</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <!-- <div class="col-md-3"> -->
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="format_tengah">{{ __('Format Penomoran 2') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select name="format_tengah" id="format_tengah" class="form-control">
                                                <option value="">Pilih Jenis Penomoran</option>
                                                <option value="d"@if(!empty($edit->format_tengah) ? $edit->format_tengah == 'd' : '')selected @endif>Tanggal ( 01 - 31 )</option>
                                                <option value="m"@if(!empty($edit->format_tengah) ? $edit->format_tengah == 'm' : '')selected @endif>Bulan ( 1 - 12 )</option>
                                                <option value="M"@if(!empty($edit->format_tengah) ? $edit->format_tengah == 'M' : '')selected @endif>Bulan (JAN - DES )</option>
                                                <option value="Y"@if(!empty($edit->format_tengah) ? $edit->format_tengah == 'Y' : '')selected @endif>Tahun ( 2022 - 2025 )</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <!-- <div class="col-md-3"> -->
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="format_belakang">{{ __('Format Penomoran 3') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select name="format_belakang" id="format_belakang" class="form-control">
                                                <option value="">Pilih Jenis Penomoran</option>
                                                <option value="d"@if(!empty($edit->format_belakang) ? $edit->format_belakang == 'd' : '')selected @endif>Tanggal ( 01 - 31 )</option>
                                                <option value="m"@if(!empty($edit->format_belakang) ? $edit->format_belakang == 'm' : '')selected @endif>Bulan ( 1 - 12 )</option>
                                                <option value="M"@if(!empty($edit->format_belakang) ? $edit->format_belakang == 'M' : '')selected @endif>Bulan (JAN - DES )</option>
                                                <option value="Y"@if(!empty($edit->format_belakang) ? $edit->format_belakang == 'Y' : '')selected @endif>Tahun ( 2022 - 2025 )</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group clearfix">
                                    <div class="row">
                                        <!-- <div class="col-md-3"> -->
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="nama_agunan">{{ __('Output Nomor Auto') }}</label>
                                        </div>
                                        <div class="col-md-9">

                                            @php
                                                if (!empty($edit->format_depan)) {
                                                $format_depan =date($edit->format_depan).'-';
                                            } else {
                                                $format_depan = '';
                                            }
                                                if (!empty($edit->format_tengah)) {
                                                $format_tengah = date($edit->format_tengah).'-';
                                            } else {
                                                $format_tengah = '';
                                            }
                                                    if (!empty($edit->format_belakang)) {
                                                $format_belakang = date($edit->format_belakang).'-';
                                            } else {
                                                $format_belakang = '';
                                            }
                                            $no = $edit->head.'-'.$edit->kode_perusahaan.'-'.$edit->kode_cabang.'-'.$format_depan.$format_tengah.$format_belakang;
                                             $text = str_replace(' ', '', $no);
                                            @endphp
                                            @if($edit->keterangan == 'anggota')
                                            <input type="text" class="form-control" placeholder="Nomor Saat Ini" value="{{$text}}Auto">
                                            @elseif($edit->keterangan == 'simpanan' || $edit->keterangan == 'pembiayaan')
                                                @php
                                                    if (!empty($edit->format_depan)) {
                                                    $format_depan =date($edit->format_depan).'-';
                                                } else {
                                                    $format_depan = '';
                                                }
                                                    if (!empty($edit->format_tengah)) {
                                                    $format_tengah = date($edit->format_tengah).'-';
                                                } else {
                                                    $format_tengah = '';
                                                }
                                                        if (!empty($edit->format_belakang)) {
                                                    $format_belakang = date($edit->format_belakang).'-';
                                                } else {
                                                    $format_belakang = '';
                                                }
                                                $no = $edit->head.'-'.$edit->kode_perusahaan.'-'.$edit->kode_cabang.'-'.'Id'.'_'.'Produk-'.$format_depan.$format_tengah.$format_belakang;
                                                 $text = str_replace(' ', '', $no);
                                                @endphp
                                                <input type="text" class="form-control" placeholder="Nomor Saat Ini" value="{{$text}}Auto">

                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer border border-top-0 text-right">
                        <a href="{{ route('agunan.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($edit->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($edit->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
