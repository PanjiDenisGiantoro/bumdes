@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">Daftar Usaha</h3>
    <br>
{{--    <x-breadcrumb title="{{ __('Informasi Usaha') }}">--}}

{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('daftar_warung.index') }}">{{ __('Daftar Usaha') }}</a>--}}
{{--        </li>--}}
{{--        <li class="breadcrumb-item">--}}
{{--            {{ __('Tambah Informasi Usaha') }}</a>--}}
{{--        </li>--}}
{{--    </x-breadcrumb>--}}
@endsection

@section('content')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>

    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">

                <form method="POST" id="warung_form" class="form-horizontal" action="{{ !empty($daftar_warung->id) ? route('daftar_warung.update', [$daftar_warung->id]) : route('daftar_warung.create') }}"enctype="multipart/form-data">
                    @csrf

                    @if (!empty($daftar_warung->id))
                        @method('PUT')
                    @endif


                    <div class="card-body">

                <h4 ><b>{{ __('Daftar Usaha') }}</b></h4>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="id_anggota">{{ __('Nama Anggota') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="id_anggota" class="form-control select2"  id="nama_anggota" data-placeholder="{{ __('Pilih  Nama Anggota') }}" disabled>
                                                <option value="{{ $daftar_warung->id_anggota }}">{{ $daftar_warung->anggota->nama_pemohon ?? ' ' }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="tanggal_lahir">{{ __('Tanggal Lahir') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                value="{{ date('d-m-Y', strtotime($daftar_warung->anggota->tanggal_lahir)) }}"
                                                id="tanggal_lahir"
                                                name="tanggal_lahir"
                                                type="text"
                                                maxlength="10"
                                                style="width: 95%"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('tanggal_lahir')])
                                            readonly
                                            />
                                            @error('tanggal_lahir')
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
                                            <label class="control-label form-label" for="nik">{{ __('NIK') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                readonly
                                                value="{{ $daftar_warung->anggota->nik ??'' }}"
                                                id="nik"
                                                name="nik"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('nik')])
                                            value="{{ old('nik') }}"
                                            />
                                            @error('nama_pemohon')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="no_mitra">{{ __('No. Anggota') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                value="{{ $daftar_warung->anggota->no_mitra ??'' }}"
                                                id="no_mitra"
                                                name="no_mitra"
                                                type="text"
                                                class="form-control"
                                                readonly
                                            />
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group clearfix" >
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="nama_jalan1">{{ __('Nama Jalan') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                readonly
                                                value="{{ $daftar_warung->anggota->nama_jalan ??'' }}"
                                                id="nama_jalan1"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_jalan')])
                                            value="{{ old('nama_jalan') }}"
                                            />
                                            @error('alamat')
                                            <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="no_rumah1">{{ __('Nomor') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                readonly
                                                value="{{$daftar_warung->anggota->no_rumah ??''}}"

                                                id="no_rumah1"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('no_rumah')])
                                            />
                                            @error('no_rumah')
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
                                            <label class="control-label form-label" for="rtrw">{{ __('RT/RW') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                readonly
                                                value="{{$daftar_warung->anggota->rtrw ??''}}"

                                                id="rtrw1"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('rtrw')])
                                            value="{{ old('rtrw') }}"
                                            />
                                            @error('rtrw')
                                            <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="kode pos">{{ __('Kode Pos') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                readonly
                                                value="{{$daftar_warung->anggota->kode_pos ??''}}"
                                                onkeypress="return isNumberKey(event)"
                                                id="rtrw1"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('rtrw')])
                                            value="{{ old('rtrw') }}"
                                            />
                                            @error('rtrw')
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
                                            <label class="control-label form-label" for="provinsi1">{{ __('provinsi') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                readonly
                                                value="{{$daftar_warung->anggota->province->name ??''}}"

                                                id="provinsi1"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('rtrw')])
                                            value="{{ old('rtrw') }}"
                                            />
                                            @error('rtrw')
                                            <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="kota1">{{ __('Kabupaten/Kota') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                id="kota1"
                                                readonly
                                                value="{{$daftar_warung->anggota->city->name ??''}}"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('rtrw')])
                                            value="{{ old('rtrw') }}"
                                            />
                                            @error('rtrw')
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
                                            <label class="control-label form-label" for="Kecamatan">{{ __('Kecamatan') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                readonly
                                                value="{{$daftar_warung->anggota->districts->name ?? ''}}"

                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('rtrw')])
                                            value="{{ old('rtrw') }}"
                                            />
                                            @error('rtrw')
                                            <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="D">{{ __('Kelurahan/Desa') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                readonly
                                                value="{{$daftar_warung->anggota->villages->name ??''}}"
                                                id="D"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('rtrw')])
                                            value="{{ old('rtrw') }}"
                                            />
                                            @error('rtrw')
                                            <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                            @enderror
                                        </div>


                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="row">

                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="nama_warung">{{ __('Nama Usaha') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        value="{{$daftar_warung->nama_warung ??''}}"

                                        disabled
                                        id="nama_warung"
                                        name="nama_warung"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_warung')])
                                    value="{{ old('nama_warung') }}"
                                    />
                                    @error('nama_pemohon')
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
                                    <label class="control-label form-label" for="nama_jalan">{{ __('Alamat Usaha sama dengan Anggota') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <label class="switch">
                                        <input type="checkbox"id="simpanan_ada_ao" name="ao"disabled
                                               @if(!empty($daftar_warung->tempat_sama) && $daftar_warung->tempat_sama == 1)checked @endif>
                                        <span class="slider round"for="simpanan_ada_ao"
                                        ></span>
                                    </label>
                                    <label  for="simpanan_ada_ao"
                                            id="simpanan_ada_aoLabel">@if (!empty($daftar_warung->tempat_sama) && $daftar_warung->tempat_sama == 1)Ya @else Tidak @endif</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix" id="i">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="nama_jalan">{{ __('Nama Jalan') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        value="{{$daftar_warung->nama_jalan ??''}}"
                                        disabled
                                        id="nama_jalan"
                                        name="nama_jalan"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_jalan')])
                                    value="{{ old('nama_jalan') }}"
                                    />
                                    @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="no_rumah">{{ __('Nomor') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        value="{{$daftar_warung->no_rumah ??''}}"
                                        disabled
                                        id="no_rumah"
                                        name="no_rumah"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('no_rumah')])
                                    value="{{ old('no_rumah') }}"
                                    />
                                    @error('no_rumah')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <input type="text" id="smpn_adaAO_value"name="tempat_sama" hidden value="{{ $daftar_warung->tempat_sama ?? '' }}">

                        <div class="form-group clearfix" id="ii">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="rtrw">{{ __('RT/RW') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        value="{{$daftar_warung->rtrw ??''}}"
                                        disabled
                                        id="rtrw"
                                        name="rtrw"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('rtrw')])
                                    value="{{ old('rtrw') }}"
                                    />
                                    @error('rtrw')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="form-group clearfix" id="iii">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="Provinsi">{{ __('Provinsi') }}</label>
                                </div>
                                <div class="col-md-4">
                                    @php
                                        $provinces = new \App\Http\Controllers\SettingController();
                                        $provinces = $provinces->provinces();
                                    @endphp
                                    <select class="form-control" name="provinsi" id="provinsi" required disabled>
                                        <option value="">==Pilih Salah Satu==</option>
                                        @foreach ($provinces as $item)
                                            <option value="{{ $item->id }}" @if (!empty($daftar_warung->provinsi) && $daftar_warung->provinsi == $item->id)selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="kota">{{ __('Kabupaten/Kota') }}</label>
                                </div>
                                <div class="col-md-3">
                                    @php
                                        $cities = \Indonesia::findProvince($daftar_warung->provinsi, ['cities'])->cities->pluck('name', 'id');
                                    @endphp
                                    <select class="form-control" name="kota" id="kota" required disabled>
                                        <option value="">==Pilih Salah Satu==</option>
                                        @foreach ($cities as $id => $city)
                                            <option value="{{ $id }}" @if (!empty($daftar_warung->kota) && $daftar_warung->kota == $id)selected @endif>{{ $city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="text"value="{{ $daftar_warung->provinsi ?? '' }}" id="provinsi1" hidden>
                        <input type="text"value="{{ $daftar_warung->kota ?? '' }}" id="kota1" hidden>
                        <input type="text"value="{{ $daftar_warung->kecamatan ?? '' }}" id="kecamatan1"hidden>
                        <input type="text"value="{{ $daftar_warung->desa ?? '' }}" id="desa1"hidden>

                        <input type="text" value="{{ $daftar_warung->id ?? '' }}" name="idd" hidden >

                        <div class="form-group clearfix" id="iiii">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="kode_pos">{{ __('Kecamatan') }}</label>
                                </div>
                                <div class="col-md-4">
                                   @php
                                        $districts = \Indonesia::findCity($daftar_warung->kota, ['districts']);

                                        if (!empty($districts->districts)) {
                                            $districts = $districts->districts->pluck('name', 'id');
                                        } else {
                                            $districts = collect();
                                        }
                                    @endphp
                                    <select class="form-control" name="kecamatan" id="kecamatan" required>
                                        <option value="">==Pilih Salah Satu==</option>
                                        @foreach ($districts as $id => $district)
                                            <option value="{{ $id }}" @if (!empty($daftar_warung->kecamatan) && $daftar_warung->kecamatan == $id)selected @endif>{{ $district }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="bumdes">{{ __('Kelurahan/Desa') }}</label>
                                </div>
                                <div class="col-md-3">
                                   @php
                                        $villages = \Indonesia::findDistrict($daftar_warung->kecamatan, ['villages']);

                                        if (!empty($villages->villages)) {
                                            $villages = $villages->villages->pluck('name', 'id');
                                        } else {
                                            $villages = collect();
                                        }
                                    @endphp
                                    <select class="form-control" name="desa" id="desa" required>
                                        <option value="">==Pilih Salah Satu==</option>
                                        @foreach ($villages as $id => $village)
                                            <option value="{{ $id }}" @if (!empty($daftar_warung->desa) && $daftar_warung->desa == $id)selected @endif>{{ $village }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="form-group clearfix" id="iiiiii">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="kodepos">{{ __('Kode Pos') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" disabled onkeypress="return isNumberKey(event)"  name="kodepos" class="form-control" value="{{ $daftar_warung->kodepos ?? '' }}"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            {{-- <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="Wilayah">{{ __('Wilayah') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <select name="wilayah" id="wilayah"class="form-control">
                                        @foreach ($wilayah as $wilayahs)
                                            <option value="{{ $wilayahs->id }}" @if (!empty($daftar_warung->wilayah) && $daftar_warung->wilayah == $wilayahs->id)selected @endif>{{ $wilayahs->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                        </div>
                        <div class="form-group clearfix" id="iiiii">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="bidang_usaha">{{ __('Bidang Usaha') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <select id="bidang_usaha" name="bidang_usaha"disabled class="form-control select2" data-placeholder="{{ __('Pilih Bidang Usaha') }}">
                                        <option value="">{{ __('Pilih Bidang Usaha') }}</option>
                                        @foreach ($bidangusaha as $id => $name)
                                            <option value="{{$id}}"@if($id == $daftar_warung->bidang_usaha)selected @endif>{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="berdiri_sejak">{{ __('Berdiri Sejak') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        placeholder="dd-mm-yyyy"
                                        min="1997-01-01" max="2030-12-31"
                                        value="{{ $daftar_warung->berdiri_sejak ?? '' }}"
                                        disabled
                                        id="berdiri_sejak"
                                        name="berdiri_sejak"
                                        type="date"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('berdiri_sejak')])
                                    value="{{ old('berdiri_sejak') }}"
                                    />
                                    @error('berdiri_sejak')
                                    <span class="invalid-feedback" role="alert">
	                                                    {{ $message }}
	                                                </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="form-group clearfix" id="iq">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="status_bangunan">{{ __('Status Bangunan') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <select name="status_bangunan" class="form-control" id="status_bangunan" disabled>
                                        @foreach ($bangunan as $id => $name)
                                            <option></option>
                                            <option value="{{$id}}"@if($id == $daftar_warung->status_bangunan) selected @endif>{{$name}}</option>
                                        @endforeach
                                    </select>
                                    @error('status_bangunan')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>


                            <!-- <div class="col-md-2">
                                                <label class="control-label form-label" for="no_telpon">{{ __('No. Telpon') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input
                                                    id="no_telpon"
                                                    name="no_telpon"
                                                    type="text"
                                                    @class(['required', 'form-control', 'is-invalid' => $errors->has('no_telpon')])
                                                    value="{{ old('no_telpon') }}"
                                                />
                                                @error('no_telpon')
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
                                            <label class="control-label form-label"
                                                   for="pendapatan1">{{ __('Pendapatan (Bulan)') }}<span class="text-red">*</span></label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                            readonly
                                                value="{{$daftar_warung->pendapatan ??''}}"
                                                id="pendapatan1"
                                                name="pendapatan"
                                                type="text"
                                                @class(['form-control nominal', 'is-invalid' => $errors->has('pendapatan')])
                                            value="{{ old('pendapatan') }}"
                                            />
                                            @error('pendapatan')
                                            <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label"
                                                   for="pengeluaran1">{{ __('Pengeluaran (Bulan)') }}<span class="text-red">*</span></label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                            readonly
                                                value="{{$daftar_warung->pengeluaran ??''}}"
                                                id="pengeluaran1"
                                                name="pengeluaran"
                                                type="text"
                                                @class(['form-control nominal', 'is-invalid' => $errors->has('pengeluaran')])
                                            />
                                            @error('pengeluaran')
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
                                    <label class="control-label form-label" for="profil_warung">{{ __('Profil Usaha') }}</label>
                                </div>
                                <div class="col-md-9">
                                                <textarea
                                                    placeholder="Profil Usaha"
                                                    disabled
                                                    onkeyup="cek()"
                                                    id="profil_warung"
                                                    name="profil_warung"
                                                    @class(['required', 'form-control', 'is-invalid' => $errors->has('profil_warung')])
                                    rows="5"
                                    >{{$daftar_warung->profil_warung ??'' }}</textarea>
                                    @error('profil_warung')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                    <div id="notif"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="">{{ __('Peta') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <div id="gmap" class="border" style="min-height: 300px"></div>
                                    <input class="form-control" type="text" name="coordinates" value="{{ !empty($daftar_warung->coordinates) ? $daftar_warung->coordinates->getLat() : null }} {{ !empty($daftar_warung->coordinates) ? $daftar_warung->coordinates->getLng() : null }}" readonly />
                                </div>
                            </div>
                        </div>
                        <br>

                        <br>
                        <h3 class="card-title">{{ __('Upload Gambar Usaha')}}</h3>
                        <input type="date" id="datenow" value="{{date('Y-m-d')}}" hidden>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label" for="file_ktp">{{ __('  Usaha 1') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="hidden" name="exists_file_ktp" id="exists_file_ktp" value="{{$warung[0] ?? ''}}">
                                    <input type="file"disabled class="custom-file-input" name="file_ktp" id="file_ktp"onchange="showPreview(event);">
                                    <label class="custom-file-label" for="file_ktp">Pilih File</label>
                                    <label class="custom-file-label" id="label_ktp" for="file_ktp">{{ isset($warung[0]) ?  str_replace("warung/$daftar_warung->id/", '', $warung[0]) : 'Pilih File' }}</label>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label" for="file_fktp2">{{ __('  Usaha 2') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="hidden" name="exists_file_fktp2" id="exists_file_fktp2" value="{{$warung1[0] ?? ''}}">
                                    <input type="file"disabled class="custom-file-input" name="file_fktp2" id="file_fktp2"onchange="showPreview2(event);">
                                    <label class="custom-file-label" for="file_fktp2">Pilih File</label>
                                    <label class="custom-file-label" id="label_ktp2" for="file_fktp2">{{ isset($warung1[0]) ?  str_replace("warung1/$daftar_warung->id/", '', $warung1[0]) : 'Pilih File' }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label" for="file_fktp3">{{ __('  Usaha 3') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="hidden" name="exists_file_fktp3" id="exists_file_fktp3" value="{{$warung2[0] ?? ''}}">
                                    <input type="file"disabled class="custom-file-input" name="file_fktp3" id="file_fktp3"onchange="showPreview3(event);">
                                    <label class="custom-file-label" for="file_fktp3">Pilih File</label>
                                    <label class="custom-file-label" id="label_ktp3" for="file_fktp3">{{ isset($warung2[0]) ?  str_replace("warung2/$daftar_warung->id/", '', $warung2[0]) : 'Pilih File' }}</label>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label" for="file_fktp4">{{ __('  Usaha 4') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="hidden" name="exists_file_fktp4" id="exists_file_fktp4" value="{{$warung3[0] ?? ''}}">
                                    <input type="file"disabled class="custom-file-input" name="file_fktp4" id="file_fktp4"onchange="showPreview4(event);">
                                     <label class="custom-file-label" for="file_fktp4">Pilih File</label>
                                    <label class="custom-file-label" id="label_ktp4" for="file_fktp4">{{ isset($warung3[0]) ?  str_replace("warung3/$daftar_warung->id/", '', $warung3[0]) : 'Pilih File' }}</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Gambar 1</h5>

                                    <img id="file-ip-1-preview" width="250" height="200" src="{{ asset('storage/'. ($warung[0] ?? '')) }}">
                                    <br>

                                </div>
                                <div class="col-md-3">
                                    <h5>Gambar 2</h5>
                                    <img id="file-ip-1-preview2" width="250" height="200" src="{{ asset('storage/'. ($warung1[0] ?? '')) }}">
                                    <br>

                                </div>
                                <div class="col-md-3">
                                    <h5>Gambar 3</h5>

                                    <img id="file-ip-1-preview3" width="250" height="200" src="{{ asset('storage/'. ($warung2[0] ?? '')) }}">
                                    <br>


                                </div>
                                <div class="col-md-3">
                                    <h5>Gambar 4</h5>

                                    <img id="file-ip-1-preview4" width="250" height="200"src="{{ asset('storage/'. ($warung3[0] ?? '')) }}">
                                    <br>

                                </div>
                            </div>
                        </div>
                        <h3 class="card-title">{{ __('Status Aktif')}}</h3>

                        <div class="form-group clearfix">

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="switch">
                                        <input type="checkbox" data-toggle="toggle" id="aktif" name="ao"
                                               data-on="Aktif" data-off="Tidak" data-onstyle="success" data-offstyle="dark"
                                               @if($daftar_warung->status_aktif == 1) checked @endif disabled>
                                        <span class=" round" for="aktif_label"
                                        ></span>
                                        <input type="text" id="aktif_value" name="status_aktif" value="{{$daftar_warung->status_aktif}}">
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer border border-top-0 text-right">
                        <a href="{{ route('daftar_warung.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Kembali') }}</a>
                        {{-- <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#confirmationModal"  id="submit_btn">{{ !empty($anggota->id) ? __('Perbaharui') : __('Kirim') }}</a> --}}

                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade zoom" tabindex="-1" id="confirmationModal">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin ingin melanjutkan proses ini?</p>

                    <a href="#" class="btn btn-md btn-primary" id="confirmBtn">
                        Lanjutkan
                    </a>
                    <a data-dismiss="modal" href="#" class="btn btn-md btn-outline-danger">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade zoom" tabindex="-1" id="deleteonModal1">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Apakah Gambar Ini akan di Hapus?</p>
                    <button type="submit" class="btn btn-md btn-primary" id="deleteBtn1">
                        Lanjutkan
                    </button>
                    <a data-dismiss="modal" href="#" class="btn btn-md btn-outline-danger">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade zoom" tabindex="-1" id="deleteonModal2">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Apakah Gambar Ini akan di Hapus?</p>
                    <button type="submit" class="btn btn-md btn-primary" id="deleteBtn2">
                        Lanjutkan
                    </button>
                    <a data-dismiss="modal" href="#" class="btn btn-md btn-outline-danger">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade zoom" tabindex="-1" id="deleteonModal3">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Apakah Gambar Ini akan di Hapus?</p>
                    <button type="submit" class="btn btn-md btn-primary" id="deleteBtn3">
                        Lanjutkan
                    </button>
                    <a data-dismiss="modal" href="#" class="btn btn-md btn-outline-danger">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade zoom" tabindex="-1" id="deleteonModal4">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Apakah Gambar Ini akan di Hapus?</p>
                    <button type="submit" class="btn btn-md btn-primary" id="deleteBtn4">
                        Lanjutkan
                    </button>
                    <a data-dismiss="modal" href="#" class="btn btn-md btn-outline-danger">
                        Batal
                    </a>
                </div>
            </div>
        </div>
@endsection

        @push('css')
            <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
                  rel="stylesheet">
        @endpush
@push('scripts')
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <script>
        $('#aktif').on('change', function () {
            if ($(this).prop("checked") == true) {
                $('#aktif_value').val('1');
                $('#aktif_label').html("Ya");
            } else if ($(this).prop("checked") == false) {
                $('#aktif_value').val('0');
                $('#aktif_label').html("Tidak");
            }
        });
        $('#deleteBtn1').on('click', function() {
            deleteGambar();
            $('#deleteonModal1').modal('hide');
            Swal.fire({
                icon: 'success',
                text: 'Gambar Usaha 1 Berhasil Terhapus!',
            });
            return false;
        });

        $('#deleteBtn2').on('click', function() {
            deleteGambar2();
            $('#deleteonModal2').modal('hide');
            Swal.fire({
                icon: 'success',
                text: 'Gambar Usaha 2 Berhasil Terhapus!',
            });
            return false;
        });
        $('#deleteBtn3').on('click', function() {
            deleteGambar3();
            $('#deleteonModal3').modal('hide');
            Swal.fire({
                icon: 'success',
                text: 'Gambar Usaha 3 Berhasil Terhapus!',
            });
            return false;
        });
        $('#deleteBtn4').on('click', function() {
            deleteGambar4();
            $('#deleteonModal4').modal('hide');
            Swal.fire({
                icon: 'success',
                text: 'Gambar Usaha 4 Berhasil Terhapus!',
            });
            return false;
        });

        $('#confirmBtn').on('click', function() {
            $('#warung_form').submit();
        });

        onclick="deleteGambar4()"
        $(document).ready(function() {
            // get_data_edit();
            $('#provinsi').change(function () {
                var id = $(this).val();
                var subcategory_id = "{{ $daftar_warung->kota ?? '' }}";
                $.ajax({
                    url: "{{route('cities')}}",
                    method: "get",
                    data: {id: id},
                    async: true,
                    dataType: 'json',
                    success: function (data) {

                        $('select[name="kota"]').empty();
                        $.each(data, function (key, value) {
                            if (subcategory_id == key) {
                                $('select[name="kota"]').append('<option value="' + key + '" selected>' + value + '</option>').trigger('change');
                            } else {
                                $('select[name="kota"]').append('<option value="' + key + '">' + value + '</option>');
                            }

                        });


                    }
                });
                return false;
            });
            $('#kota').change(function () {
                var id = $('#kota1').val();
                var subcategory_id = "{{ $daftar_warung->kecamatan ?? '' }}";
                $.ajax({
                    url: "{{route('districts')}}",
                    method: "get",
                    data: {id: id},
                    async: true,
                    dataType: 'json',
                    success: function (data) {

                        $('select[name="kecamatan"]').empty();
                        $.each(data, function (key, value) {
                            if (subcategory_id == key) {
                                $('select[name="kecamatan"]').append('<option value="' + key + '" selected>' + value + '</option>').trigger('change');
                            } else {
                                $('select[name="kecamatan"]').append('<option value="' + key + '">' + value + '</option>');
                            }

                        });


                    }
                });
                return false;
            });
            $('#kecamatan').change(function () {
                var id = $(this).val();
                var subcategory_id = "{{ $daftar_warung->kecamatan ?? '' }}";
                $.ajax({
                    url: "{{route('villages')}}",
                    method: "get",
                    data: {id: id},
                    async: true,
                    dataType: 'json',
                    success: function (data) {

                        $('select[name="desa"]').empty();
                        $.each(data, function (key, value) {
                            if (subcategory_id == key) {
                                $('select[name="desa"]').append('<option value="' + key + '" selected>' + value + '</option>').trigger('change');
                            } else {
                                $('select[name="desa"]').append('<option value="' + key + '">' + value + '</option>');
                            }

                        });


                    }
                });
                return false;
            });
            function get_data_edit(){
                var product_id = $('[name="idd"]').val();
                $.ajax({
                    url : "{{route('getdatawarung')}}",
                    method : "get",
                    data :{country_id :product_id},
                    async : true,
                    dataType : 'json',
                    success : function(data){
                        $.each(data, function(i, item){
                            console.log(data)
                            $('[name="provinsi"]').val(data.provinsi).trigger('change');
                            $('[name="kota"]').val(data.kota).trigger('change');
                            $('[name="desa"]').val(data.desa).trigger('change');
                            $('[name="kecamatan"]').val(data.kecamatan).trigger('change');
                        });
                    }

                });
            }
        });

        function onChangeSelect(url, id, name) {
            // send ajax request to get the cities of the selected province and append to the select tag
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    id: id
                },
                success: function (data) {
                    $('#' + name).empty();
                    $('#' + name).append('<option value="">==Pilih Salah Satu==</option>');

                    $.each(data, function (key, value) {
                        $('#' + name).append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }
        $(function () {
            $('#provinsi').on('change', function () {
                onChangeSelect('{{ route("cities") }}', $(this).val(), 'kota');
            });
            $('#kota').on('change', function () {
                onChangeSelect('{{ route("districts") }}', $(this).val(), 'kecamatan');
            })
            $('#kecamatan').on('change', function () {
                onChangeSelect('{{ route("villages") }}', $(this).val(), 'desa');
            })
        });

        let o = $('#smpn_adaAO_value').val();
        if (o == 1){
            $('#i').hide();
            $('#ii').hide();
            $('#iii').hide();
            $('#iiii').hide();
            $('#iiiiii').hide();
            $('#iq').hide();
        }else{
            $('#i').show();
            $('#ii').show();
            $('#iii').show();
            $('#iiii').show();
            $('#iiiiii').show();
            $('#iq').show();
        }
        function showPreview(event){
            if(event.target.files.length > 0){
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                document.getElementById('label_ktp').innerHTML = event.target.files[0].name
                preview.src = src;
                preview.style.display = "block";
            }
        }
        function showPreview2(event){
            if(event.target.files.length > 0){
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview2");
                document.getElementById('label_ktp2').innerHTML = event.target.files[0].name
                preview.src = src;
                preview.style.display = "block";
            }
        }
        function showPreview3(event){
            if(event.target.files.length > 0){
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview3");
                document.getElementById('label_ktp3').innerHTML = event.target.files[0].name
                preview.src = src;
                preview.style.display = "block";
            }
        }
        function showPreview4(event){
            if(event.target.files.length > 0){
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview4");
                document.getElementById('label_ktp4').innerHTML = event.target.files[0].name
                preview.src = src;
                preview.style.display = "block";
            }
        }

        function deleteGambar() {

            var preview = document.getElementById("file-ip-1-preview");
            document.getElementById('label_ktp').innerHTML = "Pilih File"
            document.getElementById('exists_file_ktp').value = ""
            document.getElementById('file_ktp').value = ""

            preview.src = '';

        }

        function deleteGambar2() {

            var preview = document.getElementById("file-ip-1-preview2");
            document.getElementById('label_ktp2').innerHTML = "Pilih File"
            document.getElementById('exists_file_fktp2').value = ""
            document.getElementById('file_fktp2').value = ""

            preview.src = '';

        }

        function deleteGambar3() {

            var preview = document.getElementById("file-ip-1-preview3");
            document.getElementById('label_ktp3').innerHTML = "Pilih File"
            document.getElementById('exists_file_fktp3').value = ""
            document.getElementById('file_fktp3').value = ""
            preview.src = '';

        }

         function deleteGambar4() {

            var preview = document.getElementById("file-ip-1-preview4");
            document.getElementById('label_ktp4').innerHTML = "Pilih File"
            document.getElementById('exists_file_fktp4').value = ""
            document.getElementById('file_fktp4').value = ""
            preview.src = '';

        }

        $('#simpanan_ada_ao').on('click', function() {
            if ($(this).prop("checked") == true) {
                $('#smpn_adaAO_value').val('1');
                $('#simpanan_ada_aoLabel').html("Ya");
                $('#i').hide();
                $('#ii').hide();
                $('#iii').hide();
                $('#iiii').hide();
                $('#iiiiii').hide();
                $('#iq').hide();


            } else if ($(this).prop("checked") == false) {

                $('#smpn_adaAO_value').val('0');
                $('#simpanan_ada_aoLabel').html("Tidak");
                $('#i').show();
                $('#ii').show();
                $('#iii').show();
                $('#iiii').show();
                $('#iiiiii').show();
                $('#iq').show();
            }
        });

        $('#nama_anggota').select2({
            // minimumInputLength: 3
        }).change(function (){
            var countryID = $(this).val();
            var date = $('#datenow').val();
            if(countryID){
                $.ajax({
                    type:"GET",
                    url:"{{route('getdata')}}?country_id="+countryID,
                    success:function(res){
                        if(res){
                            $("#nik").empty();
                            $("#tanggal").empty();
                            $("#no_mitra").empty();
                            $("#rtrw1").empty();
                            $("#no_rumah1").empty();
                            $("#nama_jalan1").empty();
                            $.each(res,function(key,value){
                                $('#nik').val(res.nik);
                                $('#tanggal').val(date);
                                $('#no_mitra').val(res.no_mitra);
                                $("#rtrw1").val(res.rtrw);
                                $("#no_rumah1").val(res.no_rumah);
                                $("#nama_jalan1").val(res.nama_jalan);

                                // $("#nik").append('<option value="'+value.idd+'">'+value.no_anggota+'</option>');
                                // $("#tanggal").append('<option value="'+value.idd+'">'+value.no_ktp+'</option>');
                                // $("#no_mitra").append('<option value="'+value.idd+'">'+value.nama_simpanan+'</option>');
                            });
                            {{--$('#tanggal_pengajuan').val("{{ date('d-m-Y')}}");--}}
                        }else{
                            $("#nik").empty();
                            $("#tanggal").empty();
                            $("#no_mitra").empty();
                            $("#rtrw1").empty();
                            $("#no_rumah1").empty();
                            $("#nama_jalan1").empty();
                        }
                    }
                });
            }else{
                $("#nik").empty();
                $("#tanggal").empty();
                $("#no_mitra").empty();
                $("#rtrw1").empty();
                $("#no_rumah1").empty();
                $("#nama_jalan1").empty();
            }
        });
        var target=document.getElementById("profil_warung");
        var batas_karakter=500;
        function cek(){
            if(target.value.length >= batas_karakter ){
                // target.readOnly=true;
                document.getElementById("notif").style.color="red";
                document.getElementById("notif").innerHTML="Maksimal 100 Karakter !";
            }
            else{
                var jumlah_karakter=target.value.length;
                var sisa=batas_karakter-jumlah_karakter;
                document.getElementById("notif").innerHTML=sisa+" Karakter tersisa !";
            }
        }
    </script>

<script>
var geocoder;

var marker;

var map;

function initMap() {
    const center = {
        lat: -6.229728,
        lng: 106.6894312
    }

    map = new google.maps.Map(document.getElementById("gmap"), {
        zoom: 10,
        center: center,
    });

    @if (!empty($daftar_warung->coordinates))
    map.setCenter({
        lat: {{ $daftar_warung->coordinates->getLat() }},
        lng: {{ $daftar_warung->coordinates->getLng() }}
    });

    var marker = new google.maps.Marker({
        map: map,
        position: {
            lat: {{ $daftar_warung->coordinates->getLat() }},
            lng: {{ $daftar_warung->coordinates->getLng() }}
        }
    });
    @endif
}

function codeAddress() {
    var address = $('#nama_jalan').val() + ' ' + $('#kota option:selected').text() + ' ' + $('#provinsi option:selected').text();
    if ($('#simpanan_ada_ao').prop("checked") == true) {
        address = $('#nama_jalan1').val() + ' ' + $('#kota1').val() + ' ' + $('#provinsi1').val();
    }

    geocoder = new google.maps.Geocoder();
    geocoder.geocode({
        'address': address + ' Indonesia' ,
    }, function (results, status) {
        if (status == 'OK') {
            map.setCenter(results[0].geometry.location);
            if (typeof marker == "undefined") {
                marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
            } else {
                marker.setPosition(results[0].geometry.location);
            }

            $('input[name="coordinates"]').val(results[0].geometry.location.lat() + ',' + results[0].geometry.location.lng());
        } else {
            alert('Geocode was not successful for address ' + address + ' the following reason: ' + status);
        }
    });
}

$('#simpanan_ada_ao').on('click', function () {
    codeAddress();
});

$('#nama_jalan,#kota,#provinsi,#nama_jalan1,#kota1,#provinsi1,#kecamatan11,#desa11,#kecamatan,#desa').on('change', function () {
    codeAddress();
});

$(document).ready(function() {
    if ($('input[name="coordinates"]').val() == '') {
        codeAddress();
    }
});
</script>
@endpush
