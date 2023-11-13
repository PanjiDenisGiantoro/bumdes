@extends('dashboard')

@section('breadcrumb')
    <h3 class="card-header">Anggota</h3>
    <br>
{{--    <x-breadcrumb title="{{ __('Informasi Pemohon Anggota') }}">--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('anggota.index') }}">{{ __('Anggota') }}</a>--}}
{{--        </li>--}}
{{--        <li class="breadcrumb-item">--}}
{{--            {{ __('Daftar Anggota') }}--}}
{{--        </li>--}}
{{--    </x-breadcrumb>--}}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">

                <h5 class="card-header">{{ __('Informasi Pemohon') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ route('anggota.store') }}" id="anggota_form" enctype="multipart/form-data">

                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                	<div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="nama_pemohon">{{ __('Nama Lengkap') }} <span class="text-red">*</span></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                            value="{{ old('nama_pemohon') }}"
                                                value="{{!empty($dataanggota->nama_pemohon) ? $dataanggota->nama_pemohon : ''}}"
                                                id="nama_pemohon"
                                                name="nama_pemohon"
                                                type="text"
                                                maxlength="50"
                                                class="form-control @error('nama_pemohon') is-invalid @enderror"
                                                value="{{ old('nama_pemohon') }}"
                                            />
                                            <span class="error" id="nama_error_text" style="display:none">Nama ini sudah terdaftar</span>

                                            @error('nama_pemohon')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>


                                    </div>

                                </div>
                                <div class="form-group ckearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="id_status_keanggotaan">{{ __('Kategori Keanggotaan') }}<span class="text-red">*</span></label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="id_status_keanggotaan" id="id_status_keanggotaan" class="form-control select2" data-placeholder="{{ __('Pilih Kategori Keanggotaan') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Kategori Keanggotaan') }}</option>
                                                @foreach ($status as $id => $name)
                                                    <option value="{{$id}}">{{$name}}</option>
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
                                            value="{{ old('email') }}"
                                                value="{{!empty($dataanggota->email) ? $dataanggota->email : ''}}"
                                                id="email"
                                                name="email"
                                                type="email"
                                                maxlength="50"
                                                required
                                                class="form-control @error('email') is-invalid @enderror"
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
                                            @if(!empty($dataanggota->no_mitra))
                                            <label class="control-label form-label" for="no_mitra">{{ __('No. Anggota') }}</label>
                                                @endif
                                        </div>
                                        <div class="col-md-3">
                                            @php
                                                if (!empty($auto->format_depan)) {
                                                    $format_depan =date($auto->format_depan).'-';
                                                } else {
                                                    $format_depan = '';
                                                }
                                                    if (!empty($auto->format_tengah)) {
                                                    $format_tengah = date($auto->format_tengah).'-';
                                                } else {
                                                    $format_tengah = '';
                                                }
                                                        if (!empty($auto->format_belakang)) {
                                                    $format_belakang = date($auto->format_belakang).'-';
                                                } else {
                                                    $format_belakang = '';
                                                }
                                                $no = $auto->head.'-'.$auto->kode_perusahaan.'-'.$auto->kode_cabang.'-'.$format_depan.$format_tengah.$format_belakang.sprintf("%04s", $count);
                                                 $text = str_replace(' ', '', $no);
                                            @endphp
                                            @if(!empty($dataanggota->no_mitra))
                                                <input
                                            value="{{ old('no_mitra') }}"

                                                    value="{{$dataanggota->no_mitra}}"
                                                    id="no_mitra"
                                                    name="no_mitra"
                                                    type="text"
                                                    class="form-control @error('no_mitra') is-invalid @enderror"
                                                    value="{{ old('no_mitra') }}"

                                                />
                                            @endif
                                            <span class="error" id="no_mitra_error_text" style="display:none">No Anggota ini sudah terdaftar</span>
                                            @error('no_mitra')
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
                                            <label class="control-label form-label" for="nik">{{ __('NIK') }}<span class="text-red">*</span></label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                            value="{{ old('nik') }}"

                                                value="{{!empty($dataanggota->nik) ? $dataanggota->nik : ''}}"
                                                onkeypress="return isNumberKey(event)"
                                                {{-- oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" --}}
                                                type = "text"
                                                maxlength = "16"
                                                {{-- minlength="16" --}}
                                                id="nik"
                                                name="nik"
                                                class="form-control @error('nik') is-invalid @enderror"
                                            />
                                            <span class="error" id="nik_error_text" style="display:none; color:red;">NIK ini sudah terdaftar</span>
                                            <span class="error" id="nik_kurang16" style="display:none; color:red;">NIK kurang dari 16</span>
                                            @error('NIK')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="no_kk">{{ __('No. KK') }}<span class="text-red">*</span></label>
                                        </div>
                                        <div class="col-md-3">
                                                <input
                                            value="{{ old('no_kk') }}"

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
                                                value="{{ old('tanggal_lahir') }}"

                                                id="tanggal_lahir"
                                                name="tanggal_lahir"
                                                type="date"
                                                min='1899-01-01' max='2000-13-13'
                                                @class(['required', 'form-control fc-datepicker', 'is-invalid' => $errors->has('tanggal_lahir')])
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
                                                value="{{ old('tempat_lahir') }}"

                                                id="tempat_lahir"
                                                name="tempat_lahir"
                                                type="text"
                                                maxlength="30"
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
                                                value="{{!empty($dataanggota->tempat_lahir) ? $dataanggota->tempat_lahir : ''}}"

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
                                                <option value="lajang" @if(!empty($dataanggota->status_perkawinan) ? $dataanggota->status_perkawinan == 'lajang' : '')selected @endif>Belum Menikah</option>
                                                <option value="kawin"@if(!empty($dataanggota->status_perkawinan) ? $dataanggota->status_perkawinan == 'kawin' : '')selected @endif>Menikah</option>
                                                <option value="Duda"@if(!empty($dataanggota->status_perkawinan) ? $dataanggota->status_perkawinan == 'Duda' : '')selected @endif>Duda</option>
                                                <option value="Cerai"@if(!empty($dataanggota->status_perkawinan) ? $dataanggota->status_perkawinan == 'Cerai' : '')selected @endif>Janda</option>
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
                                                        <option value="{{$id}}">{{$name}}</option>
                                                    @endforeach

                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="pekerjaan">{{ __('Pekerjaan') }}<span class="text-red">*</span></label>
                                        </div>
                                        <div class="col-md-3">
                                                <input
                                                value="{{ old('pekerjaan') }}"

                                                    value="{{!empty($dataanggota->pekerjaan) ? $dataanggota->pekerjaan : ''}}"
                                                    id="pekerjaan"
                                                    name="pekerjaan"
                                                    type="text"
                                                    maxlength="50"
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
                                                value="{{ old('nama_jalan') }}"

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
                                                value="{{ old('no_rumah') }}"

                                                    name="no_rumah"
                                                    type="text"
                                                    maxlength="15"
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
                                                <label class="control-label form-label" for="rtrw">{{ __('RT / RW') }}<span class="text-red">*</span></label>
                                            </div>
                                            <div class="col-md-4">
                                                <input
                                                value="{{ old('rtrw') }}"

                                                    value="{{$dataanggota->rtrw ??''}}"
                                                    data-inputmask="'mask': '999/999'"
                                                    {{-- data-inputmask="'mask': '999/999'" --}}
                                                    id="rtrw"
                                                    name="rtrw"
                                                    type="text"
                                                    placeholder="000/000"
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
                                    <select class="form-control select2" name="provinsi" id="provinsi" required>
                                        <option value="">==Pilih Salah Satu==</option>
                                        @foreach ($provinces as $item)
                                            <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="kota">{{ __('Kabupaten / Kota ') }}<span class="text-red">*</span></label>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control select2" name="kota" id="kota" required>
                                        <option value="">==Pilih Salah Satu==</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="control-label form-label" for="kode_pos">{{ __('Kecamatan') }}<span class="text-red">*</span></label>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control select2" name="kecamatan" id="kecamatan" required>
                                                    <option value="">==Pilih Salah Satu==</option>
                                                </select>                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label form-label" for="desa">{{ __('Kelurahan / Desa ') }}<span class="text-red">*</span></label>
                                            </div>
                                            <div class="col-md-3">
                                                <select class="form-control select2" name="desa" id="desa" required>
                                                    <option value="">==Pilih Salah Satu==</option>
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
                                                <input type="text" name="kode_pos" class="form-control" id="kode_pos" value="{{$dataanggota->kode_pos ?? ''}}"onkeypress="return isNumberKey(event)" maxlength = "5"

                                                value="{{ old('kode_pos') }}"
                                                >
                                            </div>
                                            <!-- <div class="col-md-2">
                                                <label class="control-label form-label" for="bumdes">{{ __('Wilayah BUMDES') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="bumdes" id="bumdes" class="form-control" maxmaxlength="30" >

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
                                                    onkeypress="return isNumberKey(event)"
                                                    id="no_hp"
                                                value="{{ old('no_hp') }}"

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
                                                <label class="control-label form-label" for="no_telpon">{{ __('No. Telepon') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input
                                                    value="{{$dataanggota->no_telpon ??''}}"
                                                    onkeypress="return isNumberKey(event)"
                                                        id="no_telpon"
                                                    name="no_telpon"
                                                value="{{ old('no_telpon') }}"

                                                    type="text"
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
                                    <br>
                                    <h3 class="card-title">{{ __('Informasi Keluarga')}}</h3>

                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="control-label form-label" for="nama_ibu">{{ __('Nama Ibu Kandung') }} <span class="text-red">*</span></label>
                                            </div>
                                            <div class="col-md-4">
                                                <input
                                                    value="{{$dataanggota->nama_ibu ??''}}"
                                                    id="nama_ibu"
                                                value="{{ old('nama_ibu') }}"

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
                                                value="{{ old('namasehubungkeluarga') }}"

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
                                                <label class="control-label form-label" for="nama_kerabat">{{ __('Nama Keluarga Tidak Serumah') }} <span class="text-red">*</span></label>
                                            </div>
                                            <div class="col-md-4">
                                                <input
                                                    value="{{$dataanggota->nama_kerabat ??''}}"

                                                    id="nama_kerabat"
                                                    name="nama_kerabat"
                                                value="{{ old('nama_kerabat') }}"

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
                                                value="{{ old('no_telp_keluarga') }}"

                                                    onkeypress="return isNumberKey(event)"
                                                    type="text"
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
                                                <select name="status_keluarga" id="status_keluarga" class="form-control select2" data-placeholder="{{ __('Pilih Status Keluarga') }}" data-minimum-results-for-search="Infinity">
                                                    <option value=""></option>
                                                    @foreach ($keluarga as $id => $name)
                                                        <option value="{{$id}}">{{$name}}</option>
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
                                    <br>
                                    <h3 class="card-title">{{ __('Upload Dokumen')}}  <span class="text-red" style="font-style: italic">( Max 1 MB )</span></h3>

                                    <div class="form-group clearfix">
                                        <div class="row">
                                        	<div class="col-md-3">
	                                            <label class="form-label" for="file_serfie">{{ __('Upload Foto ') }} <span style="font-size:12px">JPG / PNG</span> <span class="text-red">*</span></label>
	                                        </div>
	                                        <div class="col-md-9">
{{--                                                    <input type="file" class="form-control" id="file_serfie"name="file_serfie" aria-describedby="inputGroupFileAddon04" aria-label="Upload">--}}

                                                <div class="mb-4">
                                                   <input type="file" class="custom-file-input" name="file_serfie" id="file_serfie"onchange="showPreview(event);" >
                                                    <label class="custom-file-label" id="label_ktp" for="file_serfie">Pilih File</label>
                                                    <!-- <input class="form-control form-control-sm" id="formFileSm" name="file_serfie" type="file"onchange="showPreview(event);">
                                                    <label for="formFileSm" class="form-label"></label> -->
                                                </div>
                                            </div>
                                            <div class="col-3"></div>
                                            <div class="col-9">
                                                <img id="file-ip-1-preview" width="250" height="200" >
                                                <br>
                                                <a href="#" class="btn btn-outline-danger fa fa-trash" style="margin-bottom: 30px"  data-toggle="modal" data-target="#deleteonModal"  id="delete_btn"></a>

                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="file_ktp">{{ __('Upload KTP') }} <span style="font-size:12px">JPG / PNG</span> <span class="text-red">*</span></label>
                                            </div>
                                            <div class="col-md-9">
                                                    <input type="file" class="custom-file-input" name="file_ktp" id="file_ktp"onchange="showPreview1(event);" >
                                                    <label class="custom-file-label" id="label_ktp1" for="file_ktp">Pilih File</label>

                                            </div>
                                            <div class="col-3"></div>
                                            <div class="col-9">
                                                <img id="file-ip-1-preview1" width="250" height="200">
                                                <br>
                                                <a href="#" class="btn btn-outline-danger fa fa-trash" style="margin-bottom: 30px"  data-toggle="modal" data-target="#deleteonModal1"  id="delete_btn1"></a>

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
                                <div class="col-md-4">

                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-4">

                                </div>
                            </div>
                        </div>

{{--                        <h3 class="card-title">{{ __('Status Keanggotaan')}}</h3>--}}

{{--                        <div class="form-group clearfix">--}}

{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label class="switch">--}}
{{--                                        <input type="checkbox" data-toggle="toggle" id="simpanan_ada_ao" name="ao"--}}
{{--                                               data-on="Aktif" data-off="Tidak" data-onstyle="success" data-offstyle="dark"--}}
{{--                                               checked>--}}
{{--                                        <span class="slider round" for="simpanan_ada_ao"--}}
{{--                                        ></span>--}}
                                        <input type="text" hidden name="status_aktif" value="">

{{--                                    </label>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                        </div>--}}
                    </div>

                    <div class="card-footer border border-top-0 text-right">
                        <a href="{{ route('anggota.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Kembali') }}</a>
                        <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#confirmationModal"  id="submit_btn">{{ !empty($anggota->id) ? __('Perbaharui') : __('Kirim') }}</a>
                    </div>
                </form>
                </body>
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

    <div class="modal fade zoom" tabindex="-1" id="deleteonModal">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <center> <i class="fe fe-alert-circle fa-4x" style="color: red;"></i></center>
                    <br>
                    <center><h2>Notifikasi</h2></center>
                    <p style="text-align: center;font-size: 15px">Adakah Anda Ingin Melanjutkan Proses Ini ? </p>
                    <div class="text-center">
                        <a href="#" class="btn btn-md btn-primary mr-3" id="deleteBtn">
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
@endsection
@push('css')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
          rel="stylesheet">
@endpush

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="assets/plugins/input-mask/jquery.maskedinput.js"></script> --}}
    <script src=”https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js”></script>
    {{-- assets/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js --}}

    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#rtrw').inputmask('999/999');
        });
    </script>

    <script>

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
    document.getElementById("tanggal_lahir").setAttribute("max", today);

        $('.select2').select2({
            width: '100%'
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

    $('#nama_pemohon').on('focusout', function() {
        if ($('#nama_pemohon').val() == ''){
            Swal.fire({
                icon: 'error',
                text: 'Kolom Nama Pemohon harus diisi!',
            });
            return false;
        }
    });

    $('#no_mitra').on('focusout', function() {
        // console.log("Ajax triggered :" + $(this).val());
        if ($('#email').val() == '') {
            $('#no_mitra_error_text').show();
            $('#no_mitra').addClass("is-invalid");
        }else{
            $('#no_mitra_error_text').hide();
            $('#no_mitra').removeClass("is-invalid");
        }

        $.ajax({
            url: "{{ route('anggota.index') }}",
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {regMitra: $(this).val()},
            success: function(response) {

                if (response.results.length == 0) {

                    $('#no_mitra_error_text').hide();
                    $('#no_mitra').removeClass("is-invalid");

                } else {

                    $('#no_mitra_error_text').show();
                    $('#no_mitra').addClass("is-invalid");
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

    $('#smpn_adaAO_value').val('1');
    // $('#simpanan_ada_ao').on('change', function () {
    //     if ($(this).prop("checked") == true) {
    //         $('#smpn_adaAO_value').val('1');
    //         $('#simpanan_ada_aoLabel').html("Ya");
    //     } else if ($(this).prop("checked") == false) {
    //         $('#smpn_adaAO_value').val('0');
    //         $('#simpanan_ada_aoLabel').html("Tidak");
    //     }
    // });

    $('#confirmBtn').on('click', function() {
        var nama_pemohon = document.forms["anggota_form"]["nama_pemohon"];
        var id_status_keanggotaan = document.forms["anggota_form"]["id_status_keanggotaan"];
        var email = document.forms["anggota_form"]["email"];
        var nik = document.forms["anggota_form"]["nik"];
        var no_kk = document.forms["anggota_form"]["no_kk"];
        var tanggal_lahir = document.forms["anggota_form"]["tanggal_lahir"];
        var jenis_kelamin = document.forms["anggota_form"]["jenis_kelamin"];
        var status_perkawinan = document.forms["anggota_form"]["status_perkawinan"];
        var pendidikan = document.forms["anggota_form"]["pendidikan"];
        var pekerjaan = document.forms["anggota_form"]["pekerjaan"];
        var nama_ibu = document.forms["anggota_form"]["nama_ibu"];
        var nama_jalan = document.forms["anggota_form"]["nama_jalan"];
        var no_rumah = document.forms["anggota_form"]["no_rumah"];
        var rtrw = document.forms["anggota_form"]["rtrw"];
        var provinsi = document.forms["anggota_form"]["provinsi"];
        var no_hp = document.forms["anggota_form"]["no_hp"];
        var nama_kerabat = document.forms["anggota_form"]["nama_kerabat"];
        var no_telp_keluarga = document.forms["anggota_form"]["no_telp_keluarga"];
        var file_serfie = document.forms["anggota_form"]["file_serfie"];
        var file_ktp = document.forms["anggota_form"]["file_ktp"];
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

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
                text: 'Kolom NIK wajib diisi!',
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
                text: 'Kolom No. KK wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }

        if (tanggal_lahir.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Kolom Tanggal Lahir wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }
        if (tempat_lahir.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Kolom Tempat Lahir wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }
        if (jenis_kelamin.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Kolom Jenis Kelamin wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }
        if (pendidikan.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Kolom Pendidikan wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }
        if (status_perkawinan.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Kolom status perkawinan wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }
        if (pekerjaan.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Kolom pekerjaan wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }
        if (nama_jalan.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Kolom nama jalan wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }
        if (no_rumah.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Kolom No Rumah wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }
        if (rtrw.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Kolom Rt/Rw jalan wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }
        if (provinsi.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Kolom provinsi jalan wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }
        if (kota.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Kolom kota / Kabupaten wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }
        if (kecamatan.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Kolom kecamatan wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }
        if (desa.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Kolom  Kelurahan / Desa  wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }

        if (nama_ibu.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Kolom Nama Ibu wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }

        if (no_hp.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Kolom No Handphone wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }

        if (nama_kerabat.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Kolom Nama Keluarga tidak serumah wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }

        if (no_telp_keluarga.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Kolom No Telp Keluarga wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }

        if (no_telp_keluarga.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Kolom No Telp Keluarga wajib diisi!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }

        if (file_serfie.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Upload Foto wajib Input!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }

        if (file_ktp.value == "") {
            Swal.fire({
                icon: 'error',
                text: 'Upload Foto KTP wajib input!',
            });
            $('#confirmationModal').modal('hide');

            return false;
        }


        $('#anggota_form').submit();
    });

    $('#deleteBtn').on('click', function() {
        deleteGambar();
        $('#deleteonModal').modal('hide');
        Swal.fire({
            icon: 'success',
            text: 'Foto Diri Berhasil Terhapus!',
        });
        $('#delete_btn').hide();
        $('#file-ip-1-preview').hide();
        return false;
    });

    $('#deleteBtn1').on('click', function() {
        deleteGambar2();
        $('#deleteonModal1').modal('hide');
        Swal.fire({
            icon: 'success',
            text: 'Gambar KTP Berhasil Terhapus!',
        });
        $('#delete_btn1').hide();
        $('#file-ip-1-preview1').hide();
        return false;
    });

    $('#file-ip-1-preview').hide();
    $('#file-ip-1-preview1').hide();
    $('#delete_btn').hide();
    $('#delete_btn1').hide();
    function showPreview(event){
        console.log(event.target.files[0]);
        //if image size is less than 1 MB
        if(event.target.files[0].size < 1000000) {
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("file-ip-1-preview");
            document.getElementById('label_ktp').innerHTML = event.target.files[0].name
            preview.src = src;
            preview.style.display = "block";
            $('#delete_btn').show();
            $('#file-ip-1-preview').show();

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
            document.getElementById('label_ktp1').innerHTML = event.target.files[0].name
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

    function deleteGambar() {
        var preview = document.getElementById("file-ip-1-preview");
        document.getElementById('label_ktp').innerHTML = "Pilih File"
        preview.src = '';
        document.getElementById('file_serfie').value = ''
    }

    function deleteGambar2() {
        var preview = document.getElementById("file-ip-1-preview1");
        document.getElementById('label_ktp1').innerHTML = "Pilih File"
        preview.src = '';
        document.getElementById('file_ktp').value = ''
    }

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

    function openModal() {
        document.getElementById("myModal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }

    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        var captionText = document.getElementById("caption");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
        captionText.innerHTML = dots[slideIndex-1].alt;
    }
    </script>
@endpush
