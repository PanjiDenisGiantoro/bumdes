@extends('dashboard')

@section('breadcrumb')
    <h3 class="card-header">Anggota</h3>
    <br>
{{--    <x-breadcrumb title="{{ __('Informasi Pemohon Anggota') }}">--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('anggota.index') }}">{{ __('Anggota') }}</a>--}}
{{--        </li>--}}
{{--        <li class="breadcrumb-item">--}}
{{--           {{ __('Edit Anggota') }}--}}
{{--        </li>--}}
{{--    </x-breadcrumb>--}}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card ">
                <h5 style="margin-left: 10px;margin-top: 10px">{{ __('Informasi Pemohon') }}</h5>

                <form method="POST" id="anggota_form" class="form-horizontal" action="{{ route('anggota.update',$dataanggota->id) }}"enctype="multipart/form-data">

                   @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="nama_pemohon">{{ __('Nama Lengkap') }}<span class="text-red">*</span></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                                value="{{!empty($dataanggota->nama_pemohon) ? $dataanggota->nama_pemohon : ''}}"
                                                id="nama_pemohon"
                                                name="nama_pemohon"
                                                type="text"
                                                maxlength="50"
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
                                            <select name="id_status_keanggotaan" class="form-control select2" data-placeholder="{{ __('Pilih Kategori Keanggotaan') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Kategori Keanggotaan') }}</option>
                                                @foreach ($status as $id => $name)
                                                    <option value="{{$id}}" @if($dataanggota->id_status_keanggotaan == $id)selected @endif>{{$name}}</option>
                                                @endforeach

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

                                                id="email"
                                                name="email"
                                                type="email"
                                                maxlength="50"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('email')])
                                            value="{{ old('email') }}"
                                            />
                                            <span class="error" id="email_error_text" style="display:none">Email ini sudah terdaftar / Kosong</span>
                                            <span class="error" id="email_error_text_match" style="display:none; color:red;">Email ini tidak valid</span>

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
                                                value="{{$dataanggota->no_mitra ??''}}"
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
                                            <label class="control-label form-label" for="nik">{{ __('NIK') }}<span class="text-red">*</span></label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                value="{{!empty($dataanggota->nik) ? $dataanggota->nik : ''}}"
                                                onkeypress="return isNumberKey(event)"
                                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                type = "text"
                                                maxlength = "16"
                                                id="nik"
                                                name="nik"
                                                class="form-control"
                                            />
                                            <span class="error" id="nik_error_text" style="display:none; color:red;">NIK ini sudah terdaftar</span>
                                            <span class="error" id="nik_kurang16" style="display:none; color:red;">NIK kurang dari 16</span>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="no_kk">{{ __('No. KK') }}<span class="text-red">*</span></label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                value="{{!empty($dataanggota->no_kk) ? $dataanggota->no_kk : ''}}"
                                                onkeypress="return isNumberKey(event)"
                                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                id="no_kk"
                                                maxlength = "16"
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
                                            <label class="control-label form-label" for="tanggal_lahir">{{ __('Tanggal Lahir') }}<span class="text-red">*</span></label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                value="{{!empty($dataanggota->tanggal_lahir) ? $dataanggota->tanggal_lahir : ''}}"

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
                                            <label class="control-label form-label" for="tempat_lahir">{{ __('Tempat Lahir') }}<span class="text-red">*</span></label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                value="{{!empty($dataanggota->tempat_lahir) ? $dataanggota->tempat_lahir : ''}}"

                                                id="tempat_lahir"
                                                name="tempat_lahir"
                                                type="text"
                                                maxlength="35"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('tempat_lahir')])

                                            />
                                            @error('tempat_lahir')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    <!-- <div class="col-md-3">
                                            <label class="control-label form-label" for="plafon">{{ __('Plafon') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                id="plafon"
                                                name="plafon"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('plafon')])
                                                value="{{ old('plafon') }}"
                                            />
                                            @error('plafon')
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
                                            <label class="control-label form-label" for="jenis_kelamin">{{ __('Jenis Kelamin') }}<span class="text-red">*</span></label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control select2" data-placeholder="{{ __('Pilih Jenis Kelamin') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Jenis Kelamin') }}</option>
                                                <option value="Pria" @if(!empty($dataanggota->jenis_kelamin) ? $dataanggota->jenis_kelamin == 'Pria' : '')selected @endif>{{ __('Pria') }}</option>
                                                <option value="Wanita"@if(!empty($dataanggota->jenis_kelamin) ? $dataanggota->jenis_kelamin == 'Wanita' : '')selected @endif>{{ __('Wanita') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="status_perkawinan">{{ __('Status Perkawinan') }}<span class="text-red">*</span></label>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="status_perkawinan" id="status_perkawinan" class="form-control select2" data-placeholder="{{ __('Pilih Status Perkawinan') }}">
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
                                            <label class="control-label form-label" for="pendidikan">{{ __('Pendidikan Terakhir') }}<span class="text-red">*</span></label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="pendidikan" id="pendidikan" class="form-control select2" data-placeholder="{{ __('Pilih Jenis Pendidikan') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Pendidikan Terakhir') }}</option>
                                                @foreach ($pendidikan as $id => $name)
                                                    <option value="{{$id}}"@if($dataanggota->pendidikan == $id)selected @endif>{{$name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="pekerjaan">{{ __('Pekerjaan') }}<span class="text-red">*</span></label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                value="{{!empty($dataanggota->pekerjaan) ? $dataanggota->pekerjaan : ''}}"
                                                id="pekerjaan"
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
                                    <label class="control-label form-label" for="nama_jalan">{{ __('Nama Jalan') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        value="{{$dataanggota->nama_jalan ??''}}"
                                        id="nama_jalan"
                                        name="nama_jalan"
                                        type="text"
                                        maxlength="100"
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
                                    <label class="control-label form-label" for="no_rumah">{{ __('Nomor Rumah') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        value="{{$dataanggota->no_rumah ??''}}"

                                        id="no_rumah"
                                        name="no_rumah"
                                        type="text"
                                        maxlength="20"
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
                                    <label class="control-label form-label" for="rtrw">{{ __('Nomor RT / RW') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        value="{{$dataanggota->rtrw ??''}}"

                                        id="rtrw"
                                        name="rtrw"
                                        type="text"
                                        maxlength="6"
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
                                    <label class="control-label form-label" for="rtrw">{{ __('Provinsi') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-md-4">
                                    @php
                                        $provinces = new \App\Http\Controllers\SettingController();
                                        $provinces = $provinces->provinces();
                                    @endphp
                                    <select class="form-select form-control" name="provinsi" id="provinsi" data-placeholder="Pilih Salah Satu" data-allow-clear="true" required>
                                        {{-- <option value="">==Pilih Salah Satu==</option> --}}
                                        @foreach ($provinces as $item)
                                            <option value="{{ $item->id }}" @if($dataanggota->provinsi == $item->id)selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="kota">{{ __('Kabupaten / Kota ') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" name="kota" id="kota" data-placeholder="Pilih Salah Satu" data-allow-clear="true" required>
                                        {{-- <option value="">==Pilih Salah Satu==</option> --}}
                                        @if (!empty($dataanggota->city))
                                            <option value="{{ $dataanggota->city->id }}">{{ $dataanggota->city->name }}</option>
                                        @endif
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
                                    <label class="control-label form-label" for="kode_pos">{{ __('Kecamatan') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select form-control" name="kecamatan" id="kecamatan" data-placeholder="Pilih Salah Satu" data-allow-clear="true" required>
                                        {{-- <option value="">==Pilih Salah Satu==</option> --}}
                                        @if (!empty($dataanggota->districts))
                                            <option value="{{ $dataanggota->districts->id }}">{{ $dataanggota->districts->name }}</option>
                                        @endif
                                    </select>                                            </div>
                                <!-- <div class="col-md-2">
                                    <label class="control-label form-label" for="bumdes">{{ __('Kelurahan / Desa') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select form-control" name="desa" id="desa" data-placeholder="Pilih Salah Satu" data-allow-clear="true" required>
                                        {{-- <option value="">==Pilih Salah Satu==</option> --}}
                                        @if (!empty($dataanggota->villages))
                                            <option value="{{ $dataanggota->villages->id }}">{{ $dataanggota->villages->name }}</option>
                                        @endif
                                    </select>
                                </div> -->

                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="kode_pos">{{ __('Kode Pos') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="kode_pos"  onkeypress="return isNumberKey(event)"class="form-control" maxlength="5" value="{{$dataanggota->kode_pos ?? ''}}">
                                </div>
                                <!-- <div class="col-md-2">
                                    <label class="control-label form-label" for="bumdes">{{ __('Wilayah BUMDES') }}</label>
                                </div> -->
                                <!-- <div class="col-md-3">
                                    <input type="text" name="bumdes" class="form-control" value="{{$dataanggota->bumdes ?? ''}}">

                                </div> -->

                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="no_hp">{{ __('No. Handphone') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        value="{{$dataanggota->no_hp ??''}}"
                                        id="no_hp"
                                        onkeypress="return isNumberKey(event)"
                                        name="no_hp"
                                        type="text"
                                        maxlength="15"
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

                                        id="no_telpon"
                                        name="no_telpon"
                                        type="text"
                                        onkeypress="return isNumberKey(event)"
                                        maxlength="15"
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
                                    <label class="control-label form-label" for="nama_ibu">{{ __('Nama Ibu Kandung') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        value="{{$dataanggota->nama_ibu ??''}}"
                                        id="nama_ibu"
                                        name="nama_ibu"
                                        type="text"
                                        maxlength="50"
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
                                        name="namasehubungkeluarga"
                                        type="text"
                                        maxlength="50"
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
                        </div>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="nama_kerabat">{{ __('Nama Keluarga Tidak Serumah') }}<span class="text-red">*</span></label>
                                </div>
                                <input type="text" value="{{$dataanggota->id}}" name="idd" hidden>

                                <div class="col-md-4">
                                    <input
                                        value="{{$dataanggota->nama_kerabat ??''}}"

                                        id="nama_kerabat"
                                        name="nama_kerabat"
                                        type="text"
                                        maxlength="50"
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
                                    <label class="control-label form-label" for="no_telp_keluarga">{{ __('Nomor Telepon') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        value="{{$dataanggota->no_telp_keluarga ??''}}"

                                        id="no_telp_keluarga"
                                        name="no_telp_keluarga"
                                        type="text"
                                        onkeypress="return isNumberKey(event)"
                                        maxlength="15"
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
                                    <select name="status_keluarga"  class="form-control select2" data-placeholder="{{ __('Pilih Jenis Kelamin') }}" data-minimum-results-for-search="Infinity">
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
                        <hr>
                        <br>
                        <h3 class="card-title">{{ __('Upload Dokumen')}}<span class="text-red" style="font-style: italic">( Max 1 MB )</span></h3>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label" for="file_serfie">{{ __('Upload Foto Diri') }} <span style="font-size:12px">JPG / PNG</span></label>
                                </div>
                                <div class="col-md-9">
                                    {{--                                                    <input type="file" class="form-control" id="file_serfie"name="file_serfie" aria-describedby="inputGroupFileAddon04" aria-label="Upload">--}}

                                    <input type="hidden" name="exists_file_serfie" id="exists_file_serfie" value="{{$file_foto[0] ?? ''}}">

                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"  name="file_serfie"onchange="showPreview(event);">
                                        <label class="custom-file-label " style="border: none" id="label_ktp">{{ isset($file_foto[0]) ?  str_replace("selfi/$dataanggota->id/", '', $file_foto[0]) : 'Pilih File' }}</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                </div>
                                <div class="col-9">
                                        <img id="file-ip-1-preview" width="250" height="200"src="{{ asset('storage/' . ($file_foto[0] ?? '')) }}">
                                        <a href="{{ route('anggota.destroyFoto', $dataanggota) }}" class="btn btn-outline-danger fa fa-trash" style="margin-bottom: 30px"  data-toggle="modal" data-target="#deleteonModal"  id="delete_btn"></a>
                                </div>

                                <br>
                                <div class="col-md-3">
                                    <label class="form-label" for="file_ktp">{{ __('Upload KTP') }} <span style="font-size:12px">JPG / PNG</span></label>
                                </div>
                                <div class="col-md-9">
                                    <input type="hidden" name="exists_file_ktp" id="exists_file_ktp" value="{{$file_ktp[0] ?? ''}}">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="file_ktp"onchange="showPreview1(event);">
                                        <label class="custom-file-label" id="label_ktp2">{{ isset($file_ktp[0]) ?  str_replace("ktp/$dataanggota->id/", '', $file_ktp[0]) : 'Pilih File' }}</label>
                                    </div>
                                    </div>
                                <div class="col-3"></div>
                                <div class="col-9">
                                        <img id="file-ip-1-preview1" width="250" height="200"src="{{ asset('storage/' . ($file_ktp[0] ?? '')) }}">
                                        <a href="{{ route('anggota.destroyKtp', $dataanggota) }}" class="btn btn-outline-danger fa fa-trash" style="margin-bottom: 30px"  data-toggle="modal" data-target="#deleteonModal1"  id="delete_btn1"></a>
                                </div>
                            </div>
                            <div class="data-item">


                                <div class="data-col">
                                </div>

                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">

                                </div>

                                <div class="col-md-1"></div>

                            </div>
                        </div>
{{--                        <h3 class="card-title">{{ __('Status Keanggotaan')}}</h3>--}}

{{--                        <div class="form-group clearfix">--}}

{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label class="switch">--}}
{{--                                        <input type="checkbox" data-toggle="toggle" id="simpanan_ada_ao" name="ao"--}}
{{--                                               data-on="Aktif" data-off="Tidak Aktif" data-onstyle="success" data-offstyle="dark"--}}
{{--                                               @if($dataanggota->status_aktif == 1) checked @endif>--}}
{{--                                        <span class="slider round" for="simpanan_ada_ao"--}}
{{--                                        ></span>--}}
{{--                                        <input type="text" id="smpn_adaAO_value" name="status_aktif" hidden value="{{$dataanggota->status_aktif}}">--}}

{{--                                    </label>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                    <div class="card-footer border border-top-0 text-right">
                         <a href="{{ route('anggota.index') }}" class="btn btn-primary" style="background-color: red; ">{{ __('Kembali') }}</a>
                        <a href="#"  data-toggle="modal" data-target="#confirmationModal"  id="submit_btn" class="btn btn-primary">{{ __('Perbarui')  }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

{{--    <div class="modal fade zoom" tabindex="-1" id="confirmationModal">--}}
{{--        <div class="modal-dialog " role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-body">--}}
{{--                    <center> <i class="fe fe-alert-circle fa-4x" style="color: red;"></i></center>--}}
{{--                    <br>--}}
{{--                    <center><h2>Notifikasi</h2></center>--}}
{{--                    <p style="text-align: center;font-size: 15px">Adakah Anda Ingin Melanjutkan Proses Ini ? </p>--}}
{{--                    <div class="text-center">--}}
{{--                        <a href="#" class="btn btn-md btn-primary mr-3" id="confirmBtn">--}}
{{--                            Lanjutkan--}}
{{--                        </a>--}}
{{--                        <a data-dismiss="modal" href="#" class="btn btn-md btn-danger">--}}
{{--                            Tidak--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

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
    <div class="modal fade zoom" tabindex="-1" id="deleteonModal">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <center> <i class="fe fe-alert-circle fa-4x" style="color: red;"></i></center>
                    <br>
                    <center><h2>Notifikasi</h2></center>
                    <p style="text-align: center;font-size: 15px">Adakah Anda Ingin Melanjutkan Proses Ini ? </p>
                    <div class="text-center">
                        <button type="submit" class="btn btn-md btn-primary mr-3" id="deleteBtn">
                            Lanjutkan
                        </button>
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
                        <button type="submit" class="btn btn-md btn-primary mr-3" id="deleteBtn1">
                            Lanjutkan
                        </button>
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
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $('#nama_pemohon').on('focusout', function() {
            if ($('#nama_pemohon').val() == ''){
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Nama Pemohon harus diisi!',
                });
                return false;
            }
        });

        $('#simpanan_ada_ao').on('change', function () {
            if ($(this).prop("checked") == true) {
                $('#smpn_adaAO_value').val('1');
                $('#simpanan_ada_aoLabel').html("Ya");
            } else if ($(this).prop("checked") == false) {
                $('#smpn_adaAO_value').val('0');
                $('#simpanan_ada_aoLabel').html("Tidak");
            }
        });

        $('#nik').on('focusout', function() {
            console.log("Ajax triggered :" + $(this).val().length);

            if($('#nik').val().length < 16){
                $('#nik_kurang16').show();
                $('#nik').addClass("is-invalid");
            }else{
                $('#nik_kurang16').hide();
                $('#nik').removeClass("is-invalid");
            }

            if ($('#nik').val() == '') {
                $('#nik_error_text').show();
                $('#nik').addClass("is-invalid");
            }else{
                $('#nik_error_text').hide();
                $('#nik').removeClass("is-invalid");
            }

            $.ajax({
                url: "{{ route('anggota.index') }}",
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {regNik: $(this).val()},
                success: function(response) {
                    if (response.results.length == 0) {
                        $('#nik_error_text').hide();
                        $('#nik').removeClass("is-invalid");
                    } else {
                        $('#nik_error_text').show();
                        $('#nik').addClass("is-invalid");
                    }
                },
            });
        });

        $('#email').on('focusout', function() {
        // console.log("Ajax triggered :" + $(this).val());
        if ($('#email').val() == '') {
            $('#email_error_text').show();
            $('#email').addClass("is-invalid");
        }else{
            $('#email_error_text').hide();
            $('#email').removeClass("is-invalid");
        }

        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if($('#email').val().match(mailformat)){
            $('#email_error_text_match').hide();
            $('#email').removeClass("is-invalid");
        }else{
            $('#email_error_text_match').show();
            $('#email').addClass("is-invalid");
        }

        $.ajax({
            url: "{{ route('anggota.index') }}",
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {regEmail: $(this).val()},
            success: function(response) {

                console.log(response.results.length)
                if (response.results.length == 0) {

                    $('#email_error_text').hide();
                    $('#email').removeClass("is-invalid");
                } else {

                    $('#email_error_text').show();
                    $('#email').addClass("is-invalid");
                }
            },
        });
    });

        function showPreview(event){

            if(event.target.files[0].size < 1000000) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                document.getElementById('label_ktp').innerHTML = event.target.files[0].name
                preview.src = src;
                preview.style.display = "block";
                $('#delete_btn1').show();
                $('#file-ip-1-preview1').show();
            }else{
                Swal.fire({
                    icon: 'error',
                    text: 'Ukuran Gambar Terlalu Besar!',
                });
            }
        }

        function showPreview1(event){
            if(event.target.files[0].size < 1000000) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview1");
                document.getElementById('label_ktp2').innerHTML = event.target.files[0].name
                preview.src = src;
                preview.style.display = "block";
                $('#delete_btn1').show();
                $('#file-ip-1-preview1').show();
            }else{
                Swal.fire({
                    icon: 'error',
                    text: 'Ukuran Gambar Terlalu Besar!',
                });
            }
        }
        $('#confirmBtn').on('click', function() {
            var nama_pemohon = document.forms["anggota_form"]["nama_pemohon"];
            // var id_status_keanggotaan = document.forms["anggota_form"]["id_status_keanggotaan"];
            var id_status_keanggotaan = document.forms["anggota_form"]["id_status_keanggotaan"];
            var email = document.forms["anggota_form"]["email"];
            var no_mitra = document.forms["anggota_form"]["no_mitra"];
            var nik = document.forms["anggota_form"]["nik"];
            var no_kk = document.forms["anggota_form"]["no_kk"];
            var tanggal_lahir = document.forms["anggota_form"]["tanggal_lahir"];
            var tempat_lahir = document.forms["anggota_form"]["tempat_lahir"];
            var jenis_kelamin = document.forms["anggota_form"]["jenis_kelamin"];
            var pendidikan = document.forms["anggota_form"]["pendidikan"];
            var status_perkawinan = document.forms["anggota_form"]["status_perkawinan"];
            var pekerjaan = document.forms["anggota_form"]["pekerjaan"];
            var nama_jalan = document.forms["anggota_form"]["nama_jalan"];
            var no_rumah = document.forms["anggota_form"]["no_rumah"];
            var rtrw = document.forms["anggota_form"]["rtrw"];
            var provinsi = document.forms["anggota_form"]["provinsi"];
            var no_hp = document.forms["anggota_form"]["no_hp"];
            var nama_kerabat = document.forms["anggota_form"]["nama_kerabat"];
            var no_telp_keluarga = document.forms["anggota_form"]["no_telp_keluarga"];
            var kota = document.forms["anggota_form"]["kota"];
            var kecamatan = document.forms["anggota_form"]["kecamatan"];
            var desa = document.forms["anggota_form"]["desa"];
            var kode_pos = document.forms["anggota_form"]["kode_pos"];
            var nama_ibu = document.forms["anggota_form"]["nama_ibu"];
            var file_serfie = document.forms["anggota_form"]["file_serfie"];
           var file_ktp = document.forms["anggota_form"]["file_ktp"];

            if (nama_pemohon.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Nama wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }

            if (id_status_keanggotaan.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Select Kategori Keanggotaan wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }

            if (nik.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom NIK diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }

            if(nik.value.length < 16){
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom NIK harus 16 digit!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }

            if (no_kk.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom No KK diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }

            if (tanggal_lahir.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Tanggal Lahir diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (tempat_lahir.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Tempat Lahir diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (jenis_kelamin.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Jenis Kelamin diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (pendidikan.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Pendidikan diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (status_perkawinan.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom status perkawinan diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (pekerjaan.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom pekerjaan diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (nama_jalan.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom nama jalan diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (no_rumah.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom No Rumah diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (rtrw.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Rt/Rw jalan diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (provinsi.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom provinsi jalan diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (kota.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom kota diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (kecamatan.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom kecamatan diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            // if (desa.value == "") {
            //     Swal.fire({
            //         icon: 'error',
            //         text: 'Kolom desa diisi!',
            //     });
            //     $('#confirmationModal').modal('hide');

            //     return false;
            // }

            if (nama_ibu.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Nama Ibu diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }

            if (no_hp.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom No HP diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }

            if (nama_kerabat.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Nama Kerabat diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }

            if (no_telp_keluarga.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Hubungan Kerabat diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
        //     if (file_serfie.value == "") {
        //     Swal.fire({
        //         icon: 'error',
        //         text: 'Upload Foto wajib Input!',
        //     });
        //     $('#confirmationModal').modal('hide');

        //     return false;
        // }

        // if (file_ktp.value == "") {
        //     Swal.fire({
        //         icon: 'error',
        //         text: 'Upload Foto KTP wajib input!',
        //     });
        //     $('#confirmationModal').modal('hide');

        //     return false;
        // }


            $('#anggota_form').submit();
        });

        $(document).ready(function() {
            $('select#provinsi').select2();

            $('select#kota').select2({
                ajax: {
                    url: function () {
                        return '{{ route("cities") }}?id=' + $('select#provinsi').val();
                    },
                    dataType: 'json',
                    processResults: processResults,
                },
            });

            $('select#kecamatan').select2({
                ajax: {
                    url: function () {
                        return '{{ route("districts") }}?id=' + $('select#kota').val();
                    },
                    dataType: 'json',
                    processResults: processResults,
                },
            });

            $('select#desa').select2({
                ajax: {
                    url: function () {
                        return '{{ route("villages") }}?id=' + $('select#kecamatan').val();
                    },
                    dataType: 'json',
                    processResults: processResults,
                },
            });

            $('button#deleteBtn').on('click', function (e) {
                var url = $('a#delete_btn').attr('href');

                $.ajax({
                    url: url,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                });

                window.location.reload();

            });

            $('button#deleteBtn1').on('click', function (e) {
                var url = $('a#delete_btn1').attr('href');

                $.ajax({
                    url: url,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                });

                window.location.reload();
            });
        });
    </script>
@endpush

