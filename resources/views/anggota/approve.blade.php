@extends('dashboard')

@section('breadcrumb')
    <h3 class="card-header">Anggota</h3>
    <br>
    {{--    <x-breadcrumb title="{{ __('Informasi Pemohon Anggota') }}">--}}
    {{--        <li class="breadcrumb-item">--}}
    {{--            <a href="{{ route('anggota.index') }}">{{ __('Anggota') }}</a>--}}
    {{--        </li>--}}
    {{--        <li class="breadcrumb-item">--}}
    {{--            <a href="{{ route('anggota.index') }}">{{ __('Daftar Anggota') }}</a>--}}
    {{--        </li>--}}
    {{--        <li class="breadcrumb-item">--}}
    {{--            {{ __('Informasi Pemohon Anggota') }}</a>--}}
    {{--        </li>--}}
    {{--    </x-breadcrumb>--}}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card ">
                <h5 style="margin-left: 10px;margin-top: 10px">{{ __('Informasi Pemohon') }}</h5>

                <form method="POST" id="anggota_form" class="form-horizontal" action="{{ route('anggota.update_approve',$dataanggota->id) }}"enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="nama_pemohon">{{ __('Nama Lengkap') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                                value="{{!empty($dataanggota->nama_pemohon) ? $dataanggota->nama_pemohon : ''}}"

                                                disabled
                                                id="nama_pemohon"
                                                name="nama_pemohon"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_pemohon')])
                                                value="{{ old('nama_pemohon') }}"
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
                                            <label class="control-label form-label" for="id_status_keanggotaan">{{ __('Kategori Keanggotaan') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="id_status_keanggotaan" disabled class="form-control select2" data-placeholder="{{ __('Pilih Kategori Keanggotaan') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ $dataanggota->status_keanggotaans->status_keanggotaan ?? null }}</option>
                                                {{-- @foreach ($status as $id => $name)
                                                    <option value="{{$id}}" @if($dataanggota->status_keanggotan == $id)selected @endif>{{$name}}</option>
                                                @endforeach --}}

                                            </select>
                                            @error('status_keanggotaan')
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
                                            <label class="control-label form-label" for="email">{{ __('Email') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                value="{{!empty($dataanggota->email) ? $dataanggota->email : ''}}"
                                                disabled
                                                id="email"
                                                name="email"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('email')])
                                                value="{{ old('email') }}"
                                            />
                                            @error('email')
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
                                                disabled
                                                value="{{$dataanggota->no_mitra ??''}}"
                                                id="no_mitra"
                                                name="no_mitra"
                                                type="text"
                                                class="form-control"
                                            />
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
                                                disabled
                                                value="{{!empty($dataanggota->nik) ? $dataanggota->nik : ''}}"
                                                onkeypress="return isNumberKey(event)"
                                                id="nik"
                                                name="nik"
                                                type="text"
                                                class="form-control"
                                            /input>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="no_kk">{{ __('No. KK') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                value="{{!empty($dataanggota->no_kk) ? $dataanggota->no_kk : ''}}"
                                                onkeypress="return isNumberKey(event)"
                                                disabled
                                                id="no_kk"
                                                name="no_kk"
                                                type="text"
                                                class="form-control"
                                            />


                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="tanggal_lahir">{{ __('Tanggal Lahir') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                value="{{!empty($dataanggota->tanggal_lahir) ? $dataanggota->tanggal_lahir : ''}}"
                                                disabled

                                                id="tanggal_lahir"
                                                name="tanggal_lahir"
                                                type="date"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('tanggal_lahir')])
                                                value="{{ old('tanggal_lahir') }}"
                                            />
                                            @error('tanggal_lahir')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="tempat_lahir">{{ __('Tempat Lahir') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                value="{{!empty($dataanggota->tempat_lahir) ? $dataanggota->tempat_lahir : ''}}"
                                                disabled

                                                id="tempat_lahir"
                                                name="tempat_lahir"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('tempat_lahir')])

                                            />
                                            @error('tempat_lahir')
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
                                            <label class="control-label form-label" for="jenis_kelamin">{{ __('Jenis Kelamin') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="jenis_kelamin"disabled class="form-control select2" data-placeholder="{{ __('Pilih Jenis Kelamin') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Jenis Kelamin') }}</option>
                                                <option value="Pria" @if(!empty($dataanggota->jenis_kelamin) ? $dataanggota->jenis_kelamin == 'Pria' : '')selected @endif>{{ __('Pria') }}</option>
                                                <option value="Wanita"@if(!empty($dataanggota->jenis_kelamin) ? $dataanggota->jenis_kelamin == 'Wanita' : '')selected @endif>{{ __('Wanita') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="status_perkawinan">{{ __('Status Perkawinan') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="status_perkawinan" disabled class="form-control select2" data-placeholder="{{ __('Pilih Status Perkawinan') }}">
                                                <option value="">{{ __('Pilih Status Perkawinan') }}</option>
                                                <option value="lajang" @if(!empty($dataanggota->status_perkawinan) ? $dataanggota->status_perkawinan == 'lajang' : '')selected @endif>Lajang</option>
                                                <option value="kawin"@if(!empty($dataanggota->status_perkawinan) ? $dataanggota->status_perkawinan == 'kawin' : '')selected @endif>Kawin</option>
                                                <option value="Duda"@if(!empty($dataanggota->status_perkawinan) ? $dataanggota->status_perkawinan == 'Duda' : '')selected @endif>Duda</option>
                                                <option value="Cerai"@if(!empty($dataanggota->status_perkawinan) ? $dataanggota->status_perkawinan == 'Cerai' : '')selected @endif>Cerai</option>
                                            </select>
                                        </div>
                                        @error('batch')
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="pendidikan">{{ __('Pendidikan Terakhir') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="pendidikan" disabled class="form-control select2" data-placeholder="{{ __('Pilih Jenis Kelamin') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Pendidikan Terakhir') }}</option>
                                                @foreach ($pendidikan as $id => $name)
                                                    <option value="{{$id}}"@if($dataanggota->pendidikan == $id)selected @endif>{{$name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="pekerjaan">{{ __('Pekerjaan') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                value="{{!empty($dataanggota->pekerjaan) ? $dataanggota->pekerjaan : ''}}"
                                                id="pekerjaan"
                                                disabled
                                                name="pekerjaan"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('pekerjaan')])
                                                value="{{ old('pekerjaan') }}"
                                            />
                                            @error('pekerjaan')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
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

                            </div>
                        </div>
                        <hr>
                        <br>
                        <h3 class="card-title">{{ __('Informasi Kontak')}}</h3>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="nama_jalan">{{ __('Nama Jalan') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        value="{{$dataanggota->nama_jalan ??''}}"
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
                                    <label class="control-label form-label" for="no_rumah">{{ __('Nomor Rumah') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        value="{{$dataanggota->no_rumah ??''}}"
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

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="rtrw">{{ __('Nomor RT / RW') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        value="{{$dataanggota->rtrw ??''}}"
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
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="rtrw">{{ __('Provinsi') }}</label>
                                </div>
                                <div class="col-md-4">
                                    @php
                                        $provinces = new \App\Http\Controllers\SettingController();
                                        $provinces= $provinces->provinces();
                                    @endphp
                                    <select class="form-control" name="provinsi" id="provinsi" required disabled>
                                        <option>==Pilih Salah Satu==</option>
                                        @foreach ($provinces as $item)
                                            <option value="{{ $item->id }}" @if($dataanggota->provinsi ==$item->id)selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="kota">{{ __('Kabupaten / Kota ') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" name="kota" id="kota" required disabled>
                                        <option>{{ $dataanggota->city->name ?? '' }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="text"value="{{$dataanggota->provinsi}}" id="provinsi1" hidden>
                        <input type="text"value="{{$dataanggota->kota}}" id="kota1" hidden>
                        <input type="text"value="{{$dataanggota->kecamatan}}" id="kecamatan1"hidden>
                        <input type="text"value="{{$dataanggota->desa}}" id="desa1"hidden>


                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="kode_pos">{{ __('Kecamatan') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control" name="kecamatan" id="kecamatan" required disabled>
                                        <option>{{ $dataanggota->districts->name ?? '' }}</option>
                                    </select>                                            </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="bumdes">{{ __('Kelurahan / Desa') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" name="desa" id="desa" required disabled>
                                        <option>{{ $dataanggota->villages->name ?? '' }}</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="kode_pos">{{ __('Kode Pos') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="kode_pos" disabled onkeypress="return isNumberKey(event)"class="form-control" value="{{$dataanggota->kode_pos ?? ''}}">
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="bumdes">{{ __('Wilayah BUMDES') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="bumdes" disabled class="form-control" value="{{$dataanggota->bumdes ?? ''}}">

                                </div>

                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="no_hp">{{ __('No. Handphone') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        value="{{$dataanggota->no_hp ??''}}"
                                        id="no_hp"
                                        disabled
                                        name="no_hp"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('no_hp')])
                                        value="{{ old('no_hp') }}"
                                    />
                                    @error('no_hp')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="control-label form-label" for="no_telpon">{{ __('No. Telpon') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        value="{{$dataanggota->no_telpon ??''}}"
                                        disabled
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
                                </div>
                            </div>
                        </div>
                        <hr>
                        <br>
                        <h3 class="card-title">{{ __('Informasi Keluarga')}}</h3>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="nama_ibu">{{ __('Nama Ibu Kandung') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        value="{{$dataanggota->nama_ibu ??''}}"
                                        disabled
                                        id="nama_ibu"
                                        name="nama_ibu"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_ibu')])
                                        value="{{ old('nama_ibu') }}"
                                    />
                                    @error('nama_ibu')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="namasehubungkeluarga">{{ __('Nama Suami / Isteri / Orang Tua') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        value="{{$dataanggota->namasehubungkeluarga ??''}}"
                                        id="namasehubungkeluarga"
                                        disabled
                                        name="namasehubungkeluarga"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('namasehubungkeluarga')])
                                        value="{{ old('namasehubungkeluarga') }}"
                                    />
                                    @error('namasehubungkeluarga')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>

                            </div>
                            <br>
                            <div class="form-group clearfix">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="control-label form-label" for="nama_kerabat">{{ __('Nama Keluarga Tidak Serumah') }}</label>
                                    </div>
                                    <input type="text" value="{{$dataanggota->id}}" name="idd" hidden>

                                    <div class="col-md-4">
                                        <input
                                            value="{{$dataanggota->nama_kerabat ??''}}"
                                            disabled
                                            id="nama_kerabat"
                                            name="nama_kerabat"
                                            type="text"
                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_kerabat')])
                                            value="{{ old('nama_kerabat') }}"
                                        />
                                        @error('nama_kerabat')
                                        <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label form-label" for="no_telp_keluarga">{{ __('Nomor Telepon') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input
                                            value="{{$dataanggota->no_telp_keluarga ??''}}"
                                            disabled
                                            id="no_telp_keluarga"
                                            name="no_telp_keluarga"
                                            type="text"
                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('no_telp_keluarga')])
                                            value="{{ old('no_telp_keluarga') }}"
                                        />
                                        @error('no_telp_keluarga')
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
                                        <label class="control-label form-label" for="status_keluarga">{{ __('Status Dalam Keluarga') }}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="status_keluarga" disabled class="form-control select2" data-placeholder="{{ __('Pilih Jenis Kelamin') }}" data-minimum-results-for-search="Infinity">
                                            <option value=""></option>
                                            @foreach ($keluarga as $id => $name)
                                                <option value="{{$id}}" @if($id == $dataanggota->status_keluarga) selected @endif>{{$name}}</option>
                                            @endforeach
                                        </select>
                                        @error('status_keluarga')
                                        <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <div class="row">


                        </div>
                    </div>

                    <hr>
                    <br>
                    <h3 class="card-title" style="padding-left: 20px;">{{ __('Upload Dokumen')}}</h3>

                    <div class="form-group clearfix">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label" for="file_serfie" style="padding-left: 20px;">{{ __('Upload Foto Diri') }}</label>
                            </div>
                            <div class="col-md-8">
                                {{--                                                    <input type="file" class="form-control" id="file_serfie"name="file_serfie" aria-describedby="inputGroupFileAddon04" aria-label="Upload">--}}

                                <input type="hidden" disabled name="exists_file_serfie" id="exists_file_serfie" value="{{$file_foto[0] ?? ''}}">

                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"disabled name="file_serfie"onchange="showPreview(event);">
                                    <label class="custom-file-label" id="label_ktp">{{ isset($file_foto[0]) ?  str_replace("selfi/$dataanggota->id/", '', $file_foto[0]) : 'Pilih File' }}</label>
                                </div>
                            </div>
                            <div class="col-3">

                            </div>
                            <div class="col-8" style="padding-top:20px;">
                                @if(isset($file_foto[0]))
                                    <img id="file-ip-1-preview" width="250" height="200" src="{{ asset('storage/' . ($file_foto[0] ?? '')) }}">
                                @else
                                    <img id="file-ip-1-preview" width="250" height="200" src="https://i.ibb.co/LNgwbLy/default-placeholder.png">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label" for="file_ktp" style="padding-left: 20px;">{{ __('Upload KTP') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="hidden" name="exists_file_ktp" id="exists_file_ktp"disabled value="{{$file_ktp[0] ?? ''}}">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"disabled name="file_ktp"onchange="showPreview1(event);">
                                    <label class="custom-file-label" id="label_ktp2">{{ isset($file_ktp[0]) ?  str_replace("ktp/$dataanggota->id/", '', $file_ktp[0]) : 'Pilih File' }}</label>
                                </div>
                                {{--                                                <label class="custom-file-label" for="image">Upload Foto Selfie</label>--}}
                                {{--                                                <input type="file" name="file_ktp" id="file_ktp" onchange="showPreview1(event);">--}}
                                {{--                                                <input type="file" multiple="" class="custom-file-input" name="file_foto[]" id="file_foto">--}}
                                {{--                                                    <label class="custom-file-label" for="file_foto">Pilih File</label>--}}
                            </div>
                            <div class="col-3">

                            </div>
                            <div class="col-8" style="padding-top:20px;">
                                @if(isset($file_ktp[0]))
                                    <img id="file-ip-1-preview" width="250" height="200" src="{{ asset('storage/' . ($file_ktp[0] ?? '')) }}">
                                @else
                                    <img id="file-ip-1-preview" width="250" height="200" src="https://i.ibb.co/LNgwbLy/default-placeholder.png">
                                @endif

                            </div>
                        </div>
                    </div>

{{--                    <h3 class="card-title" style="padding-left: 20px;">{{ __('Status Keanggotaan')}}</h3>--}}

{{--                    <div class="form-group clearfix" style="padding-left: 20px;">--}}

{{--                        <div class="row">--}}
{{--                            <div class="col-md-6">--}}
{{--                                <label class="switch">--}}
{{--                                    <input type="checkbox" data-toggle="toggle" id="simpanan_ada_ao" name="ao"disabled--}}
{{--                                           data-on="Aktif" data-off="Tidak Aktif" data-onstyle="success" data-offstyle="dark"--}}
{{--                                           @if($dataanggota->status_aktif == 1) checked @endif>--}}
{{--                                    <span class="slider round" for="simpanan_ada_ao"--}}
{{--                                    ></span>--}}
{{--                                    <input type="text" id="smpn_adaAO_value" name="status_aktif" hidden value="{{$dataanggota->status_aktif}}">--}}

{{--                                </label>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
            </div>
            <input type="text" id="status_aktif" name="status_aktif" hidden>

            <div class="card-footer text-center">
{{--                button approve--}}
                <button type="submit" class="btn btn-success" id="btn_approve">Disetujui</button>
                <button type="submit" class="btn btn-warning" id="btn_reject">Ditolak</button>

                <a href="{{ route('anggota.index') }}" class="btn btn-primary" style="background-color: red;">{{ __('Kembali') }}</a>
                {{-- <a href="#"  data-toggle="modal" data-target="#confirmationModal"  id="submit_btn" class="btn btn-primary">{{ !empty($anggota->id) ? __('Perbaharui') : __('Kirim') }}</a> --}}
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

    <div class="modal fade zoom" tabindex="-1" id="deleteonModal">
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
                    <button type="submit" class="btn btn-md btn-primary" id="deleteBtn">
                        Lanjutkan
                    </button>
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
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script>
{{--        disable input --}}


$('#btn_approve').on('click', function (e) {
    e.preventDefault();
    $('#status_aktif').val('1');
    $('#anggota_form').submit();
});
$('#btn_reject').on('click', function (e) {
    e.preventDefault();
    $('#status_aktif').val('0');
    $('#anggota_form').submit();
});


$('#aktif').on('change', function () {
            if ($(this).prop("checked") == true) {
                $('#aktif_value').val('1');
                $('#aktif_label').html("Ya");
            } else if ($(this).prop("checked") == false) {
                $('#aktif_value').val('0');
                $('#aktif_label').html("Tidak");
            }
        });
    </script>
@endpush
