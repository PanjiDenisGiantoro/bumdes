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
                <div class="card-body">
                    <h5><b>{{ __('Daftar Usaha') }}</b></h5>

                </div>

                <form method="POST" class="form-horizontal" id="warung_form"
                      action="{{ !empty($daftar_warung->id) ? route('daftar_warung.update', [$daftar_warung->id]) : route('daftar_warung.store') }}"
                      enctype="multipart/form-data">
                    @if (!empty($daftar_warung->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label"
                                                   for="id_anggota">{{ __('Nama Anggota') }}<span class="text-red">*</span></label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="id_anggota" class="form-control " id="nama_anggota"
                                                    data-placeholder="{{ __('Pilih  Nama Anggota') }}">
                                                <option value="">{{ __('Pilih Nama Anggota') }}</option>
                                                @foreach ($anggota as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label"
                                                   for="tanggal_lahir">{{ __('Tanggal Lahir') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                id="tanggal_lahir"
                                                name="tanggal_lahir"
                                                type="date"
                                                maxlength="10"
                                                style="width: 95%"
                                                @class(['form-control', 'is-invalid' => $errors->has('tanggal_lahir')])
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
                                                id="nik"
                                                name="nik"
                                                type="text"
                                                @class(['form-control', 'is-invalid' => $errors->has('nik')])
                                            value="{{ old('nik') }}"
                                            />
                                            @error('nama_pemohon')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label"
                                                   for="no_mitra">{{ __('No. Anggota') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                id="no_mitra"
                                                name="no_mitra"
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
                                            <label class="control-label form-label"
                                                   for="nama_jalan1">{{ __('Nama Jalan') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                readonly
                                                value="{{$dataanggota->nama_jalan ??''}}"
                                                id="nama_jalan1"
                                                name="nama_jalan"
                                                type="text"
                                                @class(['form-control', 'is-invalid' => $errors->has('nama_jalan')])
                                            value="{{ old('nama_jalan') }}"
                                            />
                                            @error('alamat')
                                            <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label"
                                                   for="no_rumah1">{{ __('No. Rumah') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                value="{{$dataanggota->no_rumah ??''}}"
                                                readonly
                                                id="no_rumah1"
                                                name="no_rumah"
                                                type="text"
                                                @class(['form-control', 'is-invalid' => $errors->has('no_rumah')])
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
                                            <label class="control-label form-label"
                                                   for="rtrw">{{ __('No. RT / RW') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                value="{{$dataanggota->rtrw ??''}}"
                                                readonly
                                                id="rtrw1"
                                                name="rtrw"
                                                type="text"
                                                @class(['form-control', 'is-invalid' => $errors->has('rtrw')])
                                            value="{{ old('rtrw') }}"
                                            />
                                            @error('rtrw')
                                            <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label"
                                                   for="kodepos12">{{ __('Kode pos') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                readonly
                                                id="kodepos12"
                                                type="text"
                                                @class(['form-control', 'is-invalid' => $errors->has('kodepos12')])
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
                                            <label class="control-label form-label"
                                                   for="provinsi">{{ __('Provinsi') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            @php
                                                $provinces = new \App\Http\Controllers\SettingController();
                                                $provinces= $provinces->provinces();
                                            @endphp
                                            <input type="text" id="provinsi11" class="form-control" readonly>

                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="kota">{{ __('Kabupaten / Kota') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" id="kota11" class="form-control" readonly>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label"
                                                   for="kecamatan">{{ __('Kecamatan') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" id="kecamatan11" class="form-control" readonly>

                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="desa">{{ __('Kelurahan / Desa') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" id="desa11" class="form-control" readonly>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <hr>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label"
                                           for="nama_warung">{{ __('Nama Usaha') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-md-9">
                                    <input
                                        id="nama_warung"
                                        name="nama_warung"
                                        type="text"
                                        @class(['form-control', 'is-invalid' => $errors->has('nama_warung')])
                                    value="{{ old('nama_warung') }}"
                                    />
                                    @error('nama_warung')
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
                                    <label class="control-label form-label"
                                           for="nama_jalan">{{ __('Alamat Usaha sama dengan Anggota') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <label class="switch">
                                        <input type="checkbox" id="simpanan_ada_ao" name="ao"
                                               unchecked>
                                        <span class="slider round" for="simpanan_ada_ao"
                                        ></span>
                                    </label>
                                    <label for="simpanan_ada_ao"
                                           id="simpanan_ada_aoLabel">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix" id="i">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label"
                                           for="nama_jalan">{{ __('Nama Jalan') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        value="{{$dataanggota->nama_jalan ??''}}"
                                        id="nama_jalan"
                                        name="nama_jalan"
                                        type="text"
                                        @class(['form-control', 'is-invalid' => $errors->has('nama_jalan')])
                                    value="{{ old('nama_jalan') }}"
                                    />
                                    @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label"
                                           for="no_rumah">{{ __('Nomor') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        value="{{$dataanggota->no_rumah ??''}}"

                                        id="no_rumah"
                                        name="no_rumah"
                                        type="text"
                                        @class(['form-control', 'is-invalid' => $errors->has('no_rumah')])
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
                        <input type="text" id="smpn_adaAO_value" name="tempat_sama" hidden>

                        <div class="form-group clearfix" id="ii">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="rtrw">{{ __('Nomor RT / RW') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        value="{{$dataanggota->rtrw ??''}}"

                                        id="rtrw"
                                        name="rtrw"
                                        type="text"
                                        @class(['form-control', 'is-invalid' => $errors->has('rtrw')])
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
                                    <label class="control-label form-label" for="provinsi">{{ __('Provinsi') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-md-4">
                                    @php
                                        $provinces = new \App\Http\Controllers\SettingController();
                                        $provinces= $provinces->provinces();
                                    @endphp
                                    <select class="form-control" name="provinsi" id="provinsi">
                                    <option value="">==Pilih Salah Satu==</option>
                                    @foreach ($provinces as $item)
                                        <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                                        @endforeach
                                        </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="kota">{{ __('Kota') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" name="kota" id="kota"
                                    <option value="">==Pilih Salah Satu==</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix" id="iiii">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label"
                                           for="kecamatan">{{ __('Kecamatan') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control" name="kecamatan" id="kecamatan"
                                    <option value="">==Pilih Salah Satu==</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="desa">{{ __('Desa') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" name="desa" id="desa"
                                    <option value="">==Pilih Salah Satu==</option>
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
                                    <input type="text" name="kodepos" onkeypress="return isNumberKey(event)" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="wilayah">{{ __('Wilayah') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <select name="wilayah" id="wilayah" class="form-control" >
                                        <option value="">Pilih Wilayah</option>
                                        @foreach($wilayah as $wilayahs)
                                            <option value="{{$wilayahs->id}}">{{$wilayahs->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group clearfix" id="iiiii">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label"
                                           for="bidang_usaha">{{ __('Bidang Usaha') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-md-4">
                                    <select id="bidang_usaha" name="bidang_usaha" class="form-control select2"
                                            data-placeholder="{{ __('Pilih Bidang Usaha') }}">
                                        <option value="">{{ __('Pilih Bidang Usaha') }}</option>
                                        @foreach ($bidangusaha as $id => $name)
                                            <option value="{{$id}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label"
                                           for="berdiri_sejak">{{ __('Berdiri Sejak') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        id="berdiri_sejak"
                                        name="berdiri_sejak"
                                        type="date"
                                        @class(['form-control', 'is-invalid' => $errors->has('berdiri_sejak')])
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
                                    <label class="control-label form-label"
                                           for="status_bangunan">{{ __('Status Bangunan') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-md-9">
                                    <select name="status_bangunan" class="form-control" id="status_bangunan">
                                        <option>Pilih Status Bangunan</option>
                                        @foreach ($bangunan as $id => $name)
                                            <option value="{{$id}}">{{$name}}</option>
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
                                                    @class(['form-control', 'is-invalid' => $errors->has('no_telpon')])
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
                                                value="{{$dataanggota->pendapatan ??''}}"
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
                                                value="{{$dataanggota->no_rumah ??''}}"
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
                                    <label class="control-label form-label"
                                           for="profil_warung">{{ __('Profil Usaha') }}</label>
                                </div>
                                <div class="col-md-9">
                                                <textarea
                                                    placeholder="Profil Usaha"
                                                    onkeyup="cek()"
                                                    id="profil_warung"
                                                    name="profil_warung"
                                                    @class(['form-control', 'is-invalid' =>
                                    $errors->has('profil_warung')])
                                    rows="5"
                                    >{{ old('nama_warung') }}</textarea>
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
                                    <input type="text" class="form-control" name="coordinates" readonly/>
                                    {{--                                                <x-map-location-all/>--}}
                                </div>
                            </div>
                        </div>
                        <br>

                        <br>
                        <h3 class="card-title">{{ __('Upload Gambar Usaha')}}  <span style="font-size:12px">JPG / PNG</span></h3>
                        <input type="date" id="datenow" value="{{date('Y-m-d')}}" hidden>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="form-label" for="file_ktp">{{ __(' Gambar 1') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-md-4">
                                    <input type="file" class="custom-file-input" name="file_ktp" id="file_ktp"
                                           onchange="showPreview(event);">
                                    <label class="custom-file-label" id="label_ktp" for="file_ktp">Pilih File</label>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label" for="file_fktp2">{{ __(' Gambar 2') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-md-4">
                                    <input type="file" class="custom-file-input" name="file_fktp2" id="file_fktp2"
                                           onchange="showPreview2(event);">
                                    <label class="custom-file-label" id="label_ktp2" for="file_fktp2">Pilih File</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label class="form-label" for="file_fktp3">{{ __(' Gambar 3') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="file" class="custom-file-input" name="file_fktp3" id="file_fktp3"
                                           onchange="showPreview3(event);">
                                    <label class="custom-file-label" id="label_ktp3" for="file_fktp3">Pilih File</label>
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" for="file_fktp4">{{ __(' Gambar 4') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="file" class="custom-file-input" name="file_fktp4" id="file_fktp4"
                                           onchange="showPreview4(event);">
                                    <label class="custom-file-label" id="label_ktp4" for="file_fktp4">Pilih File</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Gambar 1</h5>

                                    <img id="file-ip-1-preview" width="250" height="200" src="https://i.ibb.co/LNgwbLy/default-placeholder.png">
                                    <a href="#" class="btn btn-outline-danger fa fa-trash" style="margin-bottom: 30px"  data-toggle="modal" data-target="#deleteonModal1"  id="delete_btn1"></a>


                                </div>
                                <div class="col-md-3">
                                    <h5>Gambar 2</h5>
                                    <img id="file-ip-1-preview2" width="250" height="200" src="https://i.ibb.co/LNgwbLy/default-placeholder.png">
                                    <a href="#" class="btn btn-outline-danger fa fa-trash" style="margin-bottom: 30px"  data-toggle="modal" data-target="#deleteonModal2"  id="delete_btn2"></a>

                                </div>
                                <div class="col-md-3">
                                    <h5>Gambar 3</h5>

                                    <img id="file-ip-1-preview3" width="250" height="200" src="https://i.ibb.co/LNgwbLy/default-placeholder.png">
                                    <a href="#" class="btn btn-outline-danger fa fa-trash" style="margin-bottom: 30px"  data-toggle="modal" data-target="#deleteonModal3"  id="delete_btn3"></a>


                                </div>
                                <div class="col-md-3">
                                    <h5>Gambar 4</h5>

                                    <img id="file-ip-1-preview4" width="250" height="200" src="https://i.ibb.co/LNgwbLy/default-placeholder.png">
                                    <a href="#" class="btn btn-outline-danger fa fa-trash" style="margin-bottom: 35px"  data-toggle="modal" data-target="#deleteonModal4"  id="delete_btn4"></a>

                                </div>
                            </div>
                        </div>
                        <h3 class="card-title" hidden>{{ __('Status Usaha')}}</h3>

                        <div class="form-group clearfix" hidden>

                            <div class="row" hidden>
                                <div class="col-md-6">
                                    <label class="switch">
                                        <input type="checkbox" data-toggle="toggle" id="aktif" name="ao"
                                               data-on="Aktif" data-off="Tidak" data-onstyle="success" data-offstyle="dark"
                                               checked>
                                        <span class=" round" for="aktif_label"
                                        ></span>
                                        <input type="text" id="aktif_value" name="status_aktif"  hidden>

                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer border border-top-0 text-right">
                        {{-- <button id="button_1" value="val_1" name="but1"class="btn btn-primary">{{ !empty($anggota->id) ? __('Perbaharui') : __('Hantar') }}</button> --}}

                        <a href="{{ route('daftar_warung.index') }}" class="btn btn-primary"
                           style="background-color: red">{{ __('Kembali') }}</a>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#confirmationModal"
                           id="submit_btn">{{ !empty($daftar_warung->id) ? __('Perbaharui') : __('Kirim') }}</a>
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




    <div class="modal fade zoom" tabindex="-1" id="deleteonModal1">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <center> <i class="fe fe-alert-circle fa-4x" style="color: red;"></i></center>
                    <br>
                    <center><h2>Notifikasi</h2></center>
                    <p style="text-align: center;font-size: 15px">Adakah Anda Ingin Melanjutkan Proses Ini ? </p>
                    <div class="text-center">
                        <a href="#" class="btn btn-md btn-primary mr-3" id="deleteBtn1">
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


    <div class="modal fade zoom" tabindex="-1" id="deleteonModal2">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <center> <i class="fe fe-alert-circle fa-4x" style="color: red;"></i></center>
                    <br>
                    <center><h2>Notifikasi</h2></center>
                    <p style="text-align: center;font-size: 15px">Adakah Anda Ingin Melanjutkan Proses Ini ? </p>
                    <div class="text-center">
                        <a href="#" class="btn btn-md btn-primary mr-3" id="deleteBtn2">
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


    <div class="modal fade zoom" tabindex="-1" id="deleteonModal3">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <center> <i class="fe fe-alert-circle fa-4x" style="color: red;"></i></center>
                    <br>
                    <center><h2>Notifikasi</h2></center>
                    <p style="text-align: center;font-size: 15px">Adakah Anda Ingin Melanjutkan Proses Ini ? </p>
                    <div class="text-center">
                        <a href="#" class="btn btn-md btn-primary mr-3" id="deleteBtn3">
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


    <div class="modal fade zoom" tabindex="-1" id="deleteonModal4">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <center> <i class="fe fe-alert-circle fa-4x" style="color: red;"></i></center>
                    <br>
                    <center><h2>Notifikasi</h2></center>
                    <p style="text-align: center;font-size: 15px">Adakah Anda Ingin Melanjutkan Proses Ini ? </p>
                    <div class="text-center">
                        <a href="#" class="btn btn-md btn-primary mr-3" id="deleteonModal4">
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

@push('css')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
          rel="stylesheet">
@endpush

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7-beta.19/jquery.inputmask.min.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>


    <!-- {{--    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCX1mc2qS4h4ZdoDaZw5kV2YiGKwTe8KAg&libraries=places" type="text/javascript"></script>--}}
    {{--    <script>--}}
    {{--        var map = new google.map.Marker(document.getElementById('gmap'),{--}}
    {{--         center:{--}}
    {{--         lat:27.72,--}}
    {{--         lng:83.38--}}
    {{--         },--}}
    {{--         zoom:15--}}
    {{--         });--}}
    {{--    </script>--}}
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8mATLbEbF2RnahGnx4aT20fGH0xAfPE0&libraries=places" type="text/javascript"></script> --}} -->
    <script>


$(".nominal").inputmask('decimal', {
                'alias': 'numeric',
                'groupSeparator': ',',
                'autoGroup': true,
                'digits': 2,
                'radixPoint': ".",
                // 'digitsOptional': false,
                'allowMinus': false,
                'placeholder': '0.00',
            });


    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
    dd = '0' + dd
    }
    if (mm < 10) {
    mm = '0' + mm
    }

    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("berdiri_sejak").setAttribute("max", today);

        $('#aktif_value').val('1');
        $('#aktif').on('change', function () {
            if ($(this).prop("checked") == true) {
                $('#aktif_value').val('1');
                $('#aktif_label').html("Ya");
            } else if ($(this).prop("checked") == false) {
                $('#aktif_value').val('0');
                $('#aktif_label').html("Tidak");
            }
        });
        $('#confirmBtn').on('click', function () {
        var id_anggota = document.forms["warung_form"]["id_anggota"];
        var nama_warung = document.forms["warung_form"]["nama_warung"];
        var nama_jalan = document.forms["warung_form"]["nama_jalan"];
        var no_rumah = document.forms["warung_form"]["no_rumah"];
        var rtrw = document.forms["warung_form"]["rtrw"];
        var kota = document.forms["warung_form"]["kota"];
        var kecamatan = document.forms["warung_form"]["kecamatan"];
        var desa = document.forms["warung_form"]["desa"];
        var bidang_usaha = document.forms["warung_form"]["bidang_usaha"];
        var berdiri_sejak = document.forms["warung_form"]["berdiri_sejak"];
        var status_bangunan = document.forms["warung_form"]["status_bangunan"];
        var pendapatan1 = document.forms["warung_form"]["pendapatan1"];
        var file_ktp = document.forms["warung_form"]["file_ktp"];
        var file_fktp2 = document.forms["warung_form"]["file_fktp2"];
        var file_fktp3 = document.forms["warung_form"]["file_fktp3"];
        var file_fktp4 = document.forms["warung_form"]["file_fktp4"];




        if (file_ktp.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Gambar Usaha wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }

        if (file_fktp2.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Gambar Usaha wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }

        if (file_fktp3.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Gambar Usaha wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }

        if (file_fktp4.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Gambar Usaha wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }
        if (id_anggota.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Kolom Anggota wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }

        if (nama_warung.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Kolom Nama Usaha wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }

        // if (nama_jalan.value == "") {
        //     Swal.fire({
        //         icon: 'error',
        //         text: 'Kolom Nama Jalan wajib diisi!',
        //     });
        //     $('#confirmationModal').modal('hide');

        //     return false;
        // }
        // if (no_rumah.value == "") {
        //     Swal.fire({
        //         icon: 'error',
        //         text: 'Kolom No Jalan wajib diisi!',
        //     });
        //     $('#confirmationModal').modal('hide');

        //     return false;
        // }
        // if (rtrw.value == "") {
        //     Swal.fire({
        //         icon: 'error',
        //         text: 'Kolom RT RW wajib diisi!',
        //     });
        //     $('#confirmationModal').modal('hide');

        //     return false;
        // }
        // if (kota.value == "") {
        //     Swal.fire({
        //         icon: 'error',
        //         text: 'Kolom Kota wajib diisi!',
        //     });
        //     $('#confirmationModal').modal('hide');

        //     return false;
        // }
        // if (kecamatan.value == "") {
        //     Swal.fire({
        //         icon: 'error',
        //         text: 'Kolom Nama Kecamatan wajib diisi!',
        //     });
        //     $('#confirmationModal').modal('hide');

        //     return false;
        // }
        // if (desa.value == "") {
        //     Swal.fire({
        //         icon: 'error',
        //         text: 'Kolom Nama Desa wajib diisi!',
        //     });
        //     $('#confirmationModal').modal('hide');

        //     return false;
        // }
        if (bidang_usaha.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Kolom Bidang Usaha wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }
        if (berdiri_sejak.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Kolom Berdiri Sejak wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }

        if (pendapatan1.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Kolom Pendapatan wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }
        if (pengeluaran1.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Kolom pengeluaran wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }

            $('#warung_form').submit();
        });

        $('#deleteBtn1').on('click', function() {
            deleteGambar();
            $('#deleteonModal1').modal('hide');
            Swal.fire({
                icon: 'success',
                text: 'Gambar Warung 1 Berhasil Terhapus!',
            });
            return false;
        });

        $('#deleteBtn2').on('click', function() {
            deleteGambar2();
            $('#deleteonModal2').modal('hide');
            Swal.fire({
                icon: 'success',
                text: 'Gambar Warung 2 Berhasil Terhapus!',
            });
            return false;
        });
        $('#deleteBtn3').on('click', function() {
            deleteGambar3();
            $('#deleteonModal3').modal('hide');
            Swal.fire({
                icon: 'success',
                text: 'Gambar Warung 3 Berhasil Terhapus!',
            });
            return false;
        });
        $('#deleteBtn4').on('click', function() {
            deleteGambar4();
            $('#deleteonModal4').modal('hide');
            Swal.fire({
                icon: 'success',
                text: 'Gambar Warung 4 Berhasil Terhapus!',
            });
            return false;
        });

        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                document.getElementById('label_ktp').innerHTML = event.target.files[0].name
                preview.src = src;
                preview.style.display = "block";
            }
        }

        function showPreview2(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview2");
                document.getElementById('label_ktp2').innerHTML = event.target.files[0].name
                preview.src = src;
                preview.style.display = "block";
            }
        }

        function showPreview3(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview3");
                document.getElementById('label_ktp3').innerHTML = event.target.files[0].name
                preview.src = src;
                preview.style.display = "block";
            }
        }

        function showPreview4(event) {
            if (event.target.files.length > 0) {
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
            preview.src = 'https://i.ibb.co/LNgwbLy/default-placeholder.png';
            document.getElementById('file_ktp').value = ''

        }
        function deleteGambar2() {

            var preview = document.getElementById("file-ip-1-preview2");
            document.getElementById('label_ktp2').innerHTML = "Pilih File"
            preview.src = 'https://i.ibb.co/LNgwbLy/default-placeholder.png';
            document.getElementById('file_fktp2').value = ''

        }


        function deleteGambar3() {

            var preview = document.getElementById("file-ip-1-preview3");
            document.getElementById('label_ktp3').innerHTML = "Pilih File"
            preview.src = 'https://i.ibb.co/LNgwbLy/default-placeholder.png';
            document.getElementById('file_fktp3').value = ''

        }

        function deleteGambar4() {

            var preview = document.getElementById("file-ip-1-preview4");
            document.getElementById('label_ktp4').innerHTML = "Pilih File"
            preview.src = 'https://i.ibb.co/LNgwbLy/default-placeholder.png';
            document.getElementById('file_fktp4').value = ''

        }

        $('#smpn_adaAO_value').val('0');

        $('#simpanan_ada_ao').on('click', function () {
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


        $('#nama_anggota').select2({
            // minimumInputLength: 3
        }).change(function () {
            var countryID = $(this).val();
            var date = $('#datenow').val();
            if (countryID) {
                $.ajax({
                    type: "GET",
                    url: "{{route('getdata')}}?country_id=" + countryID,
                    success: function (res) {
                        if (res) {
                            $("#nik").empty();
                            $("#tanggal").empty();
                            $("#tanggal_lahir").empty();
                            $("#no_mitra").empty();
                            $("#rtrw1").empty();
                            $("#no_rumah1").empty();
                            $("#nama_jalan1").empty();
                            $("#provinsi11").empty();
                            $("#kodepos12").empty();
                            $("#kota11").empty();
                            $("#kecamatan11").empty();
                            $("#desa11").empty();
                            $("#pendapatan1").empty();
                            $("#pengeluaran1").empty();
                            $.each(res, function (key, value) {
                                $('#nik').val(res.nik);
                                $('#tanggal').val(date);
                                $('#tanggal_lahir').val(res.tanggal_lahir);
                                $('#no_mitra').val(res.no_mitra);
                                $("#rtrw1").val(res.rtrw);
                                $("#no_rumah1").val(res.no_rumah);
                                $("#nama_jalan1").val(res.nama_jalan);
                                $("#provinsi11").val(res.prov);
                                $("#kota11").val(res.ko);
                                $("#kecamatan11").val(res.kec);
                                $("#desa11").val(res.des);
                                $("#kodepos12").val(res.kode_pos);
                                $("#pendapatan1").val(res.pendapatan);
                                $("#pengeluaran1").val(res.pengeluaran);
                                // $("#nik").append('<option value="'+value.idd+'">'+value.no_anggota+'</option>');
                                // $("#tanggal").append('<option value="'+value.idd+'">'+value.no_ktp+'</option>');
                                // $("#no_mitra").append('<option value="'+value.idd+'">'+value.nama_simpanan+'</option>');
                            });
                            {{--$('#tanggal_pengajuan').val("{{ date('d-m-Y')}}");--}}
                        } else {
                            $("#kota11").empty();
                            $("#kodepos12").empty();
                            $("#kecamatan11").empty();
                            $("#desa11").empty();
                            $("#provinsi11").empty();
                            $("#nik").empty();
                            $("#tanggal").empty();
                            $("#no_mitra").empty();
                            $("#rtrw1").empty();
                            $("#no_rumah1").empty();
                            $("#nama_jalan1").empty();
                            $("#pendapatan1").empty();
                            $("#pengeluaran1").empty();
                        }
                    }
                });
            } else {
                $("#nik").empty();
                $("#tanggal").empty();
                $("#no_mitra").empty();
            }
        });
        var target = document.getElementById("profil_warung");
        var batas_karakter = 500;

        function cek() {
            if (target.value.length >= batas_karakter) {
                // target.readOnly=true;
                document.getElementById("notif").style.color = "red";
                document.getElementById("notif").innerHTML = "Maksimal 500 Karakter !";
            } else {
                var jumlah_karakter = target.value.length;
                var sisa = batas_karakter - jumlah_karakter;
                document.getElementById("notif").innerHTML = sisa + " Karakter tersisa !";
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
        }

        function codeAddress() {
            var address = $('#nama_jalan').val() + ' ' + $('#desa option:selected').text() + ' ' + $('#kecamatan option:selected').text() + ' ' + $('#kota option:selected').text() + ' ' + $('#provinsi option:selected').text();
            if ($('#simpanan_ada_ao').prop("checked") == true) {
                address = $('#nama_jalan1').val() + ' ' + $('#desa11').val() + $('#kecamatan11').val() + ' ' + $('#kota1').val() + ' ' + $('#provinsi1').val();
            }

            geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'address': address + ' Indonesia',
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

        $('#nama_jalan,#kota,#provinsi,#nama_jalan1,#kota1,#provinsi1,#kecamatan11,#desa11,#kecamatan,#desa').on('change', function () {
            codeAddress();
        });
    </script>
@endpush
