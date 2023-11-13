@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Pegawai') }}</h3>
<br>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Lihat Pegawai') }}</h5>

                    <form method="POST" class="form-horizontal" action="{{ !empty($KodeProfil->id) ? route('kode_profil.update', [$KodeProfil->id]) : route('kode_profil.store') }}">

                    @if (!empty($KodeProfil->id))
                        @method('PUT')
                    @endif
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="nama_pegawai">{{ __('Nama') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                value="{{$KodeProfil->nama_pegawai ??''}}"
                                                readonly
                                            id="nama_pegawai"
                                            name="nama_pegawai"
                                            type="text"
                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_pegawai')])
                                            value="{{ old('nama_pegawai') }}"
                                            />
                                            @error('nama_pegawai')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                            </span>
                                             @enderror
                                        </div>

                                        <div class="col-md-1">
                                            <label class="control-label form-label" for="nik">{{ __('NIK') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                value="{{ $KodeProfil->nik ??''}}"
                                                readonly
                                            id="nik"
                                            name="nik"
                                            type="text"
                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('nik')])
                                            value="{{ old('nik') }}"
                                            />
                                            @error('nik')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                            </span>
                                             @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="id_pengguna">{{ __('ID Pegawai') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                            readonly
                                                value="{{$KodeProfil->id_pengguna ??''}}"
                                                id="id_pengguna"
                                                name="id_pengguna"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('id_pengguna')])
                                            value="{{ old('id_pengguna') }}"
                                            />
                                            @error('id_pengguna')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-1">
                                            <label class="control-label form-label" for="tanggal_daftar">{{ __('Tgl Daftar') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                            readonly
                                                value="{{$KodeProfil->tanggal_daftar ??''}}"
                                                id="tanggal_daftar"
                                                name="tanggal_daftar"
                                                type="date"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('tanggal_daftar')])
                                            value="{{ old('tanggal_daftar') }}"
                                            />
                                            @error('tanggal_daftar')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <!-- <div class="col-md-3"> -->
                                                <div class="col-md-2">
                                                    <label class="control-label form-label" for="email_perusahaan">{{ __('Email') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input
                                                    readonly
                                                        value="{{$KodeProfil->email_perusahaan ??''}}"
                                                        id="email_perusahaan"
                                                        name="email_perusahaan"
                                                        type="email"
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('email_pengguna')])
                                                    />
                                                    @error('email_pengguna')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>

                                        <!-- <div class="col-md-2">
                                            <label class="control-label form-label" for="no_mitra">{{ __('No. Mitra') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                id="no_mitra"
                                                name=""
                                                type="text"
                                                class="form-control"
                                                readonly
                                            />
                                        </div> -->
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-2">
                                                <label class="control-label form-label" for="no_hp">{{ __('No. Handphone') }}</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input
                                                readonly
                                                    value="{{$KodeProfil->no_hp ??''}}"
                                                    id="no_hp"
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
                                        <div class="col-md-1">
                                            <label class="control-label form-label" for="Jabatan">{{ __('Jabatan') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="id_jabatan" id="id_jabatan" class="form-control" disabled>
                                                <option></option>
                                                @if(!empty($KodeProfil))
                                                    @foreach($KodePengguna as $kode)
                                                        <option value="{{$kode->id}}"@if($KodeProfil->id_jabatan == $kode->id)selected @endif>{{$kode->nama_jabatan}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('id_jabatan')
                                            <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>



                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border border-top-0 text-right">
                        <!-- <button type="submit" class="btn btn-primary">{{ !empty($tetapan->id) ? __('Perbaharui') : __('Ubah') }}</button> -->
                        <a href="{{ route('kode_profil.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Kembali') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

