@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Pengajuan Pendanaan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('daftar_pembiayaan.index') }}">{{ __('Pendanaan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('daftar_pembiayaan.index') }}">{{ __('Daftar Pendanaan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Informasi Pendanaan') }}</a>
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Informasi Pendanaan') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ route('daftar_pembiayaan.store') }}" id="pembiayaan_form">


                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="nama_anggota">{{ __('Nama Anggota') }}<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-9">
                                            <select name="id_anggota" class="form-control select2" data-placeholder="{{ __('Pilih Nama Anggota') }}" id="nama_anggota">
                                                <option value="">{{ __('Pilih Nama Anggota') }}</option>
                                                @foreach ($anggota as $id => $name)
                                                    <option value="{{$id}}">{{$name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="nik">{{ __('NIK') }}<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                readonly
                                                id="nik"
                                                name="nik"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('nik')])
                                            />
                                            @error('nik')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="no_mitra">{{ __('No. Anggota') }}<span class="text-danger">*</span></label>
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
                                            <label class="control-label form-label" for="batch">{{ __('Batch') }}<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="batch" id="batch" class="form-control select2" data-placeholder="Pilih batch..." data-allow-clear="true">
                                                <option value=""></option>
                                                @foreach($batchs as $batch)
                                                    <option value="{{ $batch->id }}" data-batch="{{ $batch }}">{{ $batch->pendana->nama_pendana }} - {{ $batch->batch }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="tanggal_permohonan">{{ __('Tanggal Permohonan') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input id="tanggal_permohonan" name="tanggal_permohonan" type="text" class="form-control" readonly/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix batch_field" style="display: none">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="pendana">{{ __('Pendana') }}</label>
                                            <input id="pendana" name="pendana" type="text" class="form-control" disabled/>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="no_batch">{{ __('Batch') }}</label>
                                            <input id="no_batch" name="no_batch" type="text" class="form-control" disabled/>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="plafon_pengajuan">{{ __('Plafon Pengajuan') }}</label>
                                            <input id="plafon_pengajuan" name="plafon_pengajuan" type="text" class="form-control nominal" disabled/>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="jangka_waktu">{{ __('Jangka Waktu') }}</label>
                                            <input id="jangka_waktu" name="jangka_waktu" type="text" class="form-control" disabled/>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="plafon">{{ __('Sumber Pendanaan') }}<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-4">
                                            <input

                                                id="sumber_pendanaan"
                                                name=""
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('')])
                                            value="{{ old('') }}"
                                            />
                                            <input
                                                hidden
                                                id="bulan"
                                                name="GL_batch_pendanaan"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('GL_batch_pendanaan')])
                                                value="{{ old('GL_batch_pendanaan') }}"
                                            />
                                            @error('dana_peyaluran')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="plafon">{{ __('Plafon') }}<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="text"
                                                       @class(['required', 'form-control', 'is-invalid' => $errors->has('plafon_value')])
                                                       value="{{ old('plafon_value') }}"
                                                       style="text-align: right;"
                                                       id="plafon_value"
                                                       name="plafon_value"
                                                       aria-label="Amount (to the nearest dollar)">
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="plafon">{{ __('Plafon') }}<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                hidden
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
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <br>
                        <h3 class="card-title">{{ __('Catatan Profil')}}</h3>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="lama_usaha">{{ __('Lama Usaha') }}<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        id="lama_usaha"
                                        name="lama_usaha"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('lama_usaha')])
                                    value="{{ old('lama_usaha') }}"
                                    />

                                    @error('lama_usaha')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-1">
                                    <span>Tahun</span>

                                </div>

                                <div class="col-md-2">
                                    <label class="control-label form-label" for="usaha">{{ __('Pengelola') }}<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-3">
                                    <select name="pengelola" id="pengelola" class="form-control" data-placeholder="Pilih..">
                                        <option></option>
                                        <option value="sendiri">Sendiri</option>
                                        <option value="karyawan">Karyawan</option>
                                    </select>
                                    @error('pengelola')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- <input type="text" value="BARU" name="status" hidden> -->
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="usaha">{{ __('Usaha') }}<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-4">
                                    <select name="usaha" id="usaha" class="form-control select2" data-placeholder="Pilih..">
                                        <option></option>

                                        <option value="pokok">Pokok</option>
                                        <option value="sampingan">Sampingan</option>
                                        <option value="pokoksampingan">Pokok dan Sampingan</option>
                                    </select>
                                    @error('usaha')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="control-label form-label" for="lingkungan">{{ __('Lingkungan') }}<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-3">
                                    <select name="lingkungan" id="lingkungan" class="form-control select2" data-placeholder="Pilih..">
                                        <option></option>

                                        <option value="padat">Padat</option>
                                        <option value="cluster">Cluster</option>
                                        <option value="tidakpadat">Tidak Padat</option>
                                    </select>
                                    @error('lingkungan')
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
                                    <label class="control-label form-label" for="omset_harian">{{ __('Omset Harian') }}<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text"
                                               @class(['required', 'form-control', 'is-invalid' => $errors->has('omset_harian_value')])
                                        value="{{ old('omset_harian_value') }}"
                                        style="text-align: right;"
                                        id="omset_harian_value"
                                        name="omset_harian_value"
                                        aria-label="Amount (to the nearest dollar)">
                                    </div>
                                    <input
                                        hidden
                                        id="omset_harian"
                                        name="omset_harian"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('omset')])
                                    />
                                    @error('omset_harian')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="control-label form-label" for="pengeluaran">{{ __('Pengeluaran') }}<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text"
                                               @class(['required', 'form-control', 'is-invalid' => $errors->has('pengeluaran_value')])
                                        value="{{ old('pengeluaran_value') }}"
                                        style="text-align: right;"
                                        id="pengeluaran_value"
                                        name="pengeluaran_value"
                                        aria-label="Amount (to the nearest dollar)">
                                    </div>
                                    <input
                                        hidden
                                        id="pengeluaran"
                                        name="pengeluaran"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('pengeluaran')])
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
                                    <label class="control-label form-label" for="catatan">{{ __('Catatan') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <textarea type="text" onkeyup="cek()" name="catatan" id="catatan" cols="30" rows="5" class="form-control" ></textarea>
                                    <div id="notif"></div>
                                    @error('catatan')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>




                            </div>
                        </div>
                        <br>
                        <h3 class="card-title">{{ __('Informasi Pemohon')}}</h3>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="email">{{ __('Email') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <input
                                        readonly
                                        id="email"
                                        name="email"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('email')])
                                    />
                                    @error('email')
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
                                    <label class="control-label form-label" for="no_kk">{{ __('No. KK') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        readonly
                                        id="no_kk"
                                        name="no_kk"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('no_kk')])
                                    />
                                    @error('alamat')
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
                                    <label class="control-label form-label" for="tanggal_lahir">{{ __('Tanggal Lahir') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        readonly

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
                                         readonly
                                        id="tempat_lahir"
                                        name="tempat_lahir"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('tempat_lahir')])
                                    value="{{ old('tempat_lahir') }}"
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
                                    <input
                                        readonly
                                        id="jenis_kelamin"
                                        name="jenis_kelamin"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('jenis_kelamin')])
                                    />
                                    @error('kode_pos')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="status_perkawinan">{{ __('Status Perkawinan') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        readonly
                                        id="status_perkawinan"
                                        name="status_perkawinan"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('status_perkawinan')])
                                    />
                                    @error('status_perkawinan')
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
                                    <label class="control-label form-label" for="pendidikan">{{ __('Pendidikan Terakhir') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        readonly
                                        id="pendidikan"
                                        name="pendidikan"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('pendidikan')])
                                    />
                                    @error('kode_pos')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="pekerjaan">{{ __('Pekerjaan') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        readonly
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
                            </div>
                        </div>
                        <br>
                        <h3 class="card-title">{{ __('Informasi Kontak')}}</h3>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="nama_jalan">{{ __('Nama Jalan') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        readonly
                                        id="nama_jalan"
                                        name="nama_jalan"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_jalan')])
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
                                        readonly
                                        id="no_rumah"
                                        name="no_rumah"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('no_rumah')])
                                    />
                                    @error('alamat')
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
                                        readonly
                                        id="rtrw"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('kode_pos')])
                                    value="{{ old('kode_pos') }}"
                                    />
                                    @error('kode_pos')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="provinsi">{{ __('Provinsi') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        readonly
                                        id="provinsi"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('provinsi')])
                                    />
                                    @error('alamat')
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
                                    <label class="control-label form-label" for="kota">{{ __('Kota') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        readonly
                                        id="kota"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('kode_pos')])
                                    value="{{ old('kode_pos') }}"
                                    />
                                    @error('kode_pos')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="alamat">{{ __('Kecamatan') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        readonly
                                        id="kecamatan"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('alamat')])
                                    value="{{ old('alamat') }}"
                                    />
                                    @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="desa">{{ __('Desa') }}</label>
                                </div>
                                <div class="col-md-4">

                                    <input type="text" class="form-control" id="desa" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="kota">{{ __('Kode Pos') }}</label>
                                </div>
                                <div class="col-md-3">

                                    <input type="text" class="form-control" id="kode_pos" readonly>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="kota">{{ __('Wilayah BUMDES') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" readonly id="bumdes">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="no_hp">{{ __('No. Handphone') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        class="form-control"
                                        id="no_hp"
                                        type="text"
                                        readonly
                                    />
                                    @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="no_telp">{{ __('No. Telepon') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        readonly
                                        class="form-control"

                                        id="no_telp"
                                        type="text"
                                    />
                                    @error('alamat')
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
                                    <label class="control-label form-label" for="status_keluarga">{{ __('Status Dalam Keluarga') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        class="form-control"

                                        readonly
                                        id="status_keluarga"
                                        type="text"
                                    />
                                    @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="control-label form-label" for="nama_ibu">{{ __('Nama Ibu Kandung') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        class="form-control"

                                        readonly
                                        id="nama_ibu"
                                        type="text"
                                    />
                                    @error('alamat')
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
                                    <label class="control-label form-label" for="nama_kerabat">{{ __('Nama Suami/isteri/Orang tua') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        class="form-control"

                                        readonly
                                        id="nama_kerabat"
                                        type="text"
                                    />
                                    @error('kode_pos')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="no_telp_keluarga">{{ __('No. Telepon') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        class="form-control"

                                        id="no_telp_keluarga"
                                        type="text"
                                        readonly
                                    />
                                    @error('')
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
                                    <label class="control-label form-label" for="namasehubungkeluarga">{{ __('Nama keluarga tidak serumah') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        class="form-control"

                                        readonly
                                        id="namasehubungkeluarga"
                                        type="text"
                                    />
                                    @error('kode_pos')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>


                            </div>
                        </div>
                        <br>
                        <h3 class="card-title">{{ __('Dokumen Diri')}}</h3>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="control-label form-label" for="fotoanggota">{{ __('Foto Anggota') }}</label>
                                </div>
                                <div class="col-md-1"></div>

                                <div class="col-md-4">
                                    <label class="control-label form-label" for="fotoktp">{{ __('Foto KTP') }}</label>
                                </div>

                            </div>
                            <div class="form-group clearfix">
                                <div class="row">

                                    <div class="col-md-4">
                                        <img id="file1" width="250" height="200">
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-4">
                                        <img id="file2" width="250" height="200">
                                    </div>
                                </div>
                            </div>

                            <h3 class="card-title">{{ __('Informasi Warung')}}</h3>

                            <div class="form-group clearfix">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="control-label form-label" for="nama_warung">{{ __('Nama Warung') }}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input
                                            id="nama_warung"
                                            type="text"
                                            readonly
                                            class="form-control"

                                        />
                                        @error('kode_pos')
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
                                        <label class="control-label form-label" for="nama_jalan1">{{ __('Nama Jalan') }}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input
                                            readonly
                                            id="nama_jalan1"
                                            type="text"
                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_jalan')])
                                        />
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label form-label" for="no_rumah1">{{ __('Nomor Rumah') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input
                                            readonly
                                            id="no_rumah1"
                                            type="text"
                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('no_rumah')])
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group clearfix">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="control-label form-label" for="rtrw1">{{ __('Nomor RT / RW') }}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input
                                            readonly
                                            id="rtrw1"
                                            type="text"
                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('kode_pos')])
                                        />
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label form-label" for="provinsi1">{{ __('Provinsi') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input
                                            readonly
                                            id="provinsi1"
                                            type="text"
                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('provinsi')])
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="control-label form-label" for="kota1">{{ __('Kota') }}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input
                                            readonly
                                            id="kota1"
                                            type="text"
                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('kode_pos')])
                                        />
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label form-label" for="alamat1">{{ __('Kecamatan') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input
                                            readonly
                                            id="kecamatan1"
                                            type="text"
                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('alamat')])
                                        />
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group clearfix">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="control-label form-label" for="desa1">{{ __('Desa') }}</label>
                                    </div>
                                    <div class="col-md-4">

                                        <input type="text" class="form-control" id="desa1" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label form-label" for="kota">{{ __('Kode Pos') }}</label>
                                    </div>
                                    <div class="col-md-3">

                                        <input type="text" class="form-control" id="kode_pos12" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="control-label form-label" for="profil_warung">{{ __('Profil Warung') }}</label>
                                    </div>
                                    <div class="col-md-9">
                                                <textarea
                                                    readonly
                                                    id="profil_warung"
                                                    rows="5"
                                                    class="form-control"

                                                ></textarea>
                                        @error('profil_warung')
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
                                        <label class="control-label form-label" for="bidang_usaha">{{ __('Bidang Usaha') }}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input
                                            readonly
                                            id="bidang_usaha"
                                            type="text"
                                            class="form-control"
                                        />
                                        @error('kode_pos')
                                        <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label form-label" for="berdiri_sejak">{{ __('Berdiri Sejak') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input
                                            readonly
                                            id="berdiri_sejak"
                                            type="text"
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
                            <div class="form-group clearfix">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="control-label form-label" for="">{{ __('Peta') }}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div id="gmap" class="border" style="min-height: 300px"></div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <h3 class="card-title">{{ __('Foto Warung')}}</h3>

                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="alamat">{{ __('Foto Gambar Warung 1') }}</label>

                                    <img id="gambar1" width="250" height="200">
                                </div>

                                <div class="col-md-3">
                                    <label class="control-label form-label" for="alamat">{{ __('Foto Gambar Warung 2') }}</label>

                                    <img id="gambar2" width="250" height="200">
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="alamat">{{ __('Foto Gambar Warung 3') }}</label>

                                    <img id="gambar3" width="250" height="200">
                                </div>

                                <div class="col-md-3">
                                    <label class="control-label form-label" for="alamat">{{ __('Foto Gambar Warung 4') }}</label>

                                    <img id="gambar4" width="250" height="200">
                                </div>
                            </div>


                            <div class="card-footer border border-top-0 text-right">
                                <a href="{{ route('daftar_pembiayaan.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Batal') }}</a>
{{--                                <button type="submit" class="btn btn-primary">{{ !empty($anggota->id) ? __('Perbaharui') : __('Kirim') }}</button>--}}
                                <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#confirmationModal"  id="submit_btn">{{ !empty($anggota->id) ? __('Perbaharui') : __('Kirim') }}</a>
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
                                                <button type="submit" class="btn btn-md btn-primary mr-3" name="confirmBtn">
                                                    &nbsp; Ya &nbsp;
                                                </button>
                                                <a data-dismiss="modal" href="#" class="btn btn-md btn-danger">
                                                    Tidak
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>

    <script>
        $('select').select2();

        let tanggal_hari_ini = moment().format('DD/MM/YYYY');
        console.log("TANGGAL HARI INI : " + tanggal_hari_ini);
        $('#tanggal_permohonan').val(tanggal_hari_ini);

        $('#confirmBtn').on('click', function() {
            var nama_anggota = document.forms["pembiayaan_form"]["nama_anggota"];
            if (nama_anggota.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Nama wajib diisi!',
                });
                $('#confirmationModal').modal('hide');
                return false;
            }
            $('#pembiayaan_form').submit();
        });

        var target = document.getElementById("catatan");
        var batas_karakter = 300;
        function cek() {
            if (target.value.length >= batas_karakter) {
                // target.readOnly=true;
                document.getElementById("notif").style.color = "red";
                document.getElementById("notif").innerHTML = "Maksimal 300 Karakter !";
            } else {
                var jumlah_karakter = target.value.length;
                var sisa = batas_karakter - jumlah_karakter;
                document.getElementById("notif").innerHTML = sisa + " Karakter tersisa !";
            }
        }
        $('#pengeluaran_value').on('keyup',function(){
            $('#pengeluaran_value').mask("#,##0", {reverse: true});
            test_value = $(this).val().replace(/[^0-9]+/g, "");
            $('#pengeluaran').val(test_value)
        })
        $('#plafon_value').on('keyup',function(){
            $('#plafon_value').mask("#,##0", {reverse: true});
            test_value = $(this).val().replace(/[^0-9]+/g, "");
            $('#plafon').val(test_value)
        })
        $('#omset_harian_value').on('keyup',function(){
            $('#omset_harian_value').mask("#,##0", {reverse: true});
            test_value = $(this).val().replace(/[^0-9]+/g, "");
            $('#omset_harian').val(test_value)
        })
        
        $(document).ready(function() {
            $('#nama_anggota').on('change', function() {
                let selectedAnggota = $(this).val();
                console.log("SELECTED DATA : " + selectedAnggota)

                if (selectedAnggota) {
                    clearAllField();

                    $.ajax({
                        url: "{{ route('anggota.index') }}",
                        // url: "{{route('getdatapembiayaan')}}?country_id=" + selectedAnggota,
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        data: { anggotaId: selectedAnggota },
                        success: function(response) {

                            if (response != '') {

                                if (response.block) {
                                    Swal.fire({
                                        title: '<strong>Perhatian</strong>',
                                        html:
                                            'Silahkan Daftar<b> Warung</b>, ' +
                                            'Terlebih Dahulu',
                                        showCloseButton: true,
                                        showCancelButton: true,
                                        focusConfirm: false,
                                        confirmButtonText:
                                            '<a href="/daftar_warung/create" style="color: white" >Menuju Daftar Warung</a> ',
                                        confirmButtonAriaLabel: 'Thumbs up, great!',
                                        cancelButtonText:
                                            // 'Kembali',
                                            '<a href="/daftar_pembiayaan" style="color: white" >Kembali</a> ',
                                        cancelButtonAriaLabel: 'Thumbs down'
                                    });
                                }

                                console.log("response :" + JSON.stringify(response.regencies));

                                $("#nik").val(response.anggota.nik);
                                $("#no_mitra").val(response.anggota.no_mitra);
                                $("#email").val(response.anggota.email);
                                $("#no_kk").val(response.anggota.no_kk);
                                $("#tanggal_lahir").val(response.anggota.tanggal_lahir);
                                $("#tempat_lahir").val(response.anggota.tempat_lahir);
                                $("#jenis_kelamin").val(response.anggota.jenis_kelamin);
                                $("#status_perkawinan").val(response.anggota.status_perkawinan);
                                $("#pekerjaan").val(response.anggota.pekerjaan);
                                $("#nama_jalan").val(response.anggota.nama_jalan);
                                $("#no_rumah").val(response.anggota.no_rumah);
                                $("#rtrw").val(response.anggota.rtrw);
                                $("#provinsi").val(response.anggota.province.name);
                                $("#kota").val(response.anggota.regencies.name);
                                $("#kecamatan").val(response.anggota.districts.name);
                                $("#desa").val(response.anggota.villages.name);
                                $("#kode_pos").val(response.anggota.kode_pos);
                                $("#bumdes").val(response.anggota.bumdes);
                                $("#no_hp").val(response.anggota.no_hp);
                                $("#status_keluarga").val(response['keluarga']);
                                $("#nama_ibu").val(response.anggota.nama_ibu);
                                $("#nama_kerabat").val(response.anggota.namasehubungkeluarga);
                                $("#pendidikan").val(response['pendidikan']);
                                $("#no_telp_keluarga").val(response.anggota.no_telp_keluarga);
                                $("#no_telp").val(response.anggota.no_telpon);
                                $("#namasehubungkeluarga").val(response.anggota.nama_kerabat);
                                $("#nama_warung").val(response.warung.nama_warung);
                                $("#profil_warung").val(response.warung.profil_warung);
                                $("#bidang_usaha").val(response.warung.bidangusaha.bidang_usaha);
                                $("#berdiri_sejak").val(response.warung.berdiri_sejak);
                                $("#nama_jalan1").val(response.warung.nama_jalan);
                                $("#no_rumah1").val(response.warung.no_rumah);
                                $("#rtrw1").val(response.warung.rtrw);
                                $("#provinsi1").val(response.warung.province.name);
                                $("#kota1").val(response.warung.regencies.name);
                                $("#kecamatan1").val(response.warung.districts.name);
                                $("#desa1").val(response.warung.villages.name);
                                $("#kode_pos12").val(response.warung.kodepos);

                                
                                $('#file1').attr("src","{{asset('storage')}}"+"/"+response.gambar1);
                                $('#file2').attr("src","{{asset('storage')}}"+"/"+response.gambar);
                                $('#gambar1').attr("src","{{asset('storage')}}"+"/"+response.warung1);
                                $('#gambar2').attr("src","{{asset('storage')}}"+"/"+response.warung2);
                                $('#gambar3').attr("src","{{asset('storage')}}"+"/"+response.warung3);
                                $('#gambar4').attr("src","{{asset('storage')}}"+"/"+response.warung4);

                            } else {
                                console.log("Else empty");
                                // clearAllField();
                            }
                        },
                    });
                }
            });


            // $('#nama_anggota').select2().on('change', function () {
            //     var countryID = $(this).val();
            //     if(countryID){
            //         $.ajax({
            //             type:"GET",
            //             url: "{{route('getdatapembiayaan')}}?country_id=" + countryID,
            //             success:function(res){

            //                 var defaultValue = $("#nama_anggota option:selected").val();
            //                 // if(res.validate != 0)
            //                 // {
            //                 //     Swal.fire({
            //                 //         title: '<strong>Perhatian</strong>',
            //                 //         html:
            //                 //             'Data Pembiayaan Anda <b>Masih Aktif</b>, ',
            //                 //         showCloseButton: true,
            //                 //         showCancelButton: true,
            //                 //         focusConfirm: false,
            //                 //         confirmButtonText:
            //                 //             '<a href="/daftar_pembiayaan" style="color: white" >Menuju Daftar Pembiayaan</a> ',
            //                 //         confirmButtonAriaLabel: 'Thumbs up, great!',
            //                 //     });
            //                 //     return false;

            //                 // }
            //                 if(res){
            //                     $("#nik").empty();
            //                     defaultValue
            //                     $("#no_mitra").empty();
            //                     $("#email").empty();
            //                     $("#kode_pos").empty();
            //                     $("#no_kk").empty();
            //                     $("#tanggal_lahir").empty();
            //                     $("#tempat_lahir").empty();
            //                     $("#jenis_kelamin").empty();
            //                     $("#status_perkawinan").empty();
            //                     $("#pekerjaan").empty();
            //                     $("#nama_jalan").empty();
            //                     $("#no_rumah").empty();
            //                     $("#rtrw").empty();
            //                     $("#provinsi").empty();
            //                     $("#kota").empty();
            //                     $("#kecamatan").empty();
            //                     $("#desa").empty();
            //                     $("#kode_pos").empty();
            //                     $("#bumdes").empty();
            //                     $("#no_hp").empty();
            //                     $("#status_keluarga").empty();
            //                     $("#nama_ibu").empty();
            //                     $("#pendidikan").empty();
            //                     $("#namasehubungkeluarga").empty();
            //                     $("#nama_kerabat").empty();
            //                     $("#no_telp_keluarga").empty();
            //                     $("#no_telp").empty();
            //                     $("#nama_warung").empty();
            //                     $("#profil_warung").empty();
            //                     $("#bidang_usaha").empty();
            //                     $("#berdiri_sejak").empty();
            //                     $("#nama_jalan1").empty();
            //                     $("#no_rumah1").empty();
            //                     $("#rtrw1").empty();
            //                     $("#provinsi1").empty();
            //                     $("#kota1").empty();
            //                     $("#kecamatan1").empty();
            //                     $("#desa1").empty();
            //                     $("#kode_pos12").empty();
            //                     $.each(res,function(key,value){
            //                         $("#nik").val(res.result.anggota.nik);
            //                         $("#no_mitra").val(res.result.anggota.no_mitra);
            //                         $("#email").val(res.result.anggota.email);
            //                         $("#no_kk").val(res.result.anggota.no_kk);
            //                         $("#tanggal_lahir").val(res.result.anggota.tanggal_lahir);
            //                         $("#tempat_lahir").val(res.result.anggota.tempat_lahir);
            //                         $("#jenis_kelamin").val(res.result.anggota.jenis_kelamin);
            //                         $("#status_perkawinan").val(res.result.anggota.status_perkawinan);
            //                         $("#pekerjaan").val(res.result.anggota.pekerjaan);
            //                         $("#nama_jalan").val(res.result.anggota.nama_jalan);
            //                         $("#no_rumah").val(res.result.anggota.no_rumah);
            //                         $("#rtrw").val(res.result.anggota.rtrw);
            //                         $("#provinsi").val(res.anggota.province.name);
            //                         $("#kota").val(res.anggota.regencies.name);
            //                         $("#kecamatan").val(res.anggota.districts.name);
            //                         $("#desa").val(res.anggota.villages.name);
            //                         $("#kode_pos").val(res.result.anggota.kode_pos);
            //                         $("#bumdes").val(res.result.anggota.bumdes);
            //                         $("#no_hp").val(res.result.anggota.no_hp);
            //                         $("#status_keluarga").val(res['keluarga']);
            //                         $("#nama_ibu").val(res.result.anggota.nama_ibu);
            //                         $("#nama_kerabat").val(res.result.anggota.namasehubungkeluarga);
            //                         $("#pendidikan").val(res['pendidikan']);
            //                         $("#no_telp_keluarga").val(res.result.anggota.no_telp_keluarga);
            //                         $("#no_telp").val(res.result.anggota.no_telpon);
            //                         $("#namasehubungkeluarga").val(res.result.anggota.nama_kerabat);
            //                         $("#nama_warung").val(res.result.nama_warung);
            //                         $("#profil_warung").val(res.result.profil_warung);
            //                         $("#bidang_usaha").val(res.result.bidangusaha.bidang_usaha);
            //                         $("#berdiri_sejak").val(res.result.berdiri_sejak);
            //                         $("#nama_jalan1").val(res.result.nama_jalan);
            //                         $("#no_rumah1").val(res.result.no_rumah);
            //                         $("#rtrw1").val(res.result.rtrw);
            //                         $("#provinsi1").val(res.result.province.name);
            //                         $("#kota1").val(res.result.regencies.name);
            //                         $("#kecamatan1").val(res.result.districts.name);
            //                         $("#desa1").val(res.result.villages.name);
            //                         $("#kode_pos12").val(res.result.kodepos);

            //                         $('#file1').attr("src","{{asset('storage')}}"+"/"+res.gambar1);
            //                         $('#file2').attr("src","{{asset('storage')}}"+"/"+res.gambar);
            //                         $('#gambar1').attr("src","{{asset('storage')}}"+"/"+res.warung1);
            //                         $('#gambar2').attr("src","{{asset('storage')}}"+"/"+res.warung2);
            //                         $('#gambar3').attr("src","{{asset('storage')}}"+"/"+res.warung3);
            //                         $('#gambar4').attr("src","{{asset('storage')}}"+"/"+res.warung4);
            //                     });

            //                 }else{
            //                     defaultValue
            //                     $("#nik").empty();
            //                     $("#no_mitra").empty();
            //                     $("#email").empty();
            //                     $("#kode_pos").empty();
            //                     $("#no_kk").empty();
            //                     $("#tanggal_lahir").empty();
            //                     $("#tempat_lahir").empty();
            //                     $("#jenis_kelamin").empty();
            //                     $("#status_perkawinan").empty();
            //                     $("#pekerjaan").empty();
            //                     $("#nama_jalan").empty();
            //                     $("#no_rumah").empty();
            //                     $("#rtrw").empty();
            //                     $("#provinsi").empty();
            //                     $("#kota").empty();
            //                     $("#kecamatan").empty();
            //                     $("#desa").empty();
            //                     $("#kode_pos").empty();
            //                     $("#bumdes").empty();
            //                     $("#no_hp").empty();
            //                     $("#status_keluarga").empty();
            //                     $("#nama_ibu").empty();
            //                     $("#nama_kerabat").empty();
            //                     $("#no_telp_keluarga").empty();
            //                     $("#pendidikan").empty();
            //                     $("#namasehubungkeluarga").empty();
            //                     $("#no_telp").empty();
            //                     $("#nama_warung").empty();
            //                     $("#profil_warung").empty();
            //                     $("#bidang_usaha").empty();
            //                     $("#berdiri_sejak").empty();
            //                     $("#nama_jalan1").empty();
            //                     $("#no_rumah1").empty();
            //                     $("#rtrw1").empty();
            //                     $("#provinsi1").empty();
            //                     $("#kota1").empty();
            //                     $("#kecamatan1").empty();
            //                     $("#desa1").empty();
            //                     $("#kode_pos12").empty();
            //                 }
            //             },

            //             // error: function(xhr, status, error) {
            //             //     // $("#nama_anggota option:selected").val();
            //             //     // var defaultValue = $("#nama_anggota option:selected").val('');
            //             //     // swal.fire("Error!", 'Silahkan Daftar Warung Terlebih dahulu', "error");
            //             //     // $("#nama_anggota").val(defaultValue);
            //             //     Swal.fire({
            //             //         title: '<strong>Perhatian</strong>',
            //             //         html:
            //             //             'Silahkan Daftar<b> Warung</b>, ' +
            //             //             'Terlebih Dahulu',
            //             //         showCloseButton: true,
            //             //         showCancelButton: true,
            //             //         focusConfirm: false,
            //             //         confirmButtonText:
            //             //             '<a href="/daftar_warung/create" style="color: white" >Menuju Daftar Warung</a> ',
            //             //         confirmButtonAriaLabel: 'Thumbs up, great!',
            //             //         cancelButtonText:
            //             //             'Kembali',
            //             //         cancelButtonAriaLabel: 'Thumbs down'
            //             //     });
            //             //     return false;
            //             //     // window.location.href="/daftar_warung/create"
            //             // }
            //         });
            //     }else{

            //         defaultValue
            //         $("#nik").empty();
            //         $("#no_mitra").empty();
            //         $("#email").empty();
            //         $("#kode_pos").empty();
            //         $("#no_kk").empty();
            //         $("#tanggal_lahir").empty();
            //         $("#tempat_lahir").empty();
            //         $("#jenis_kelamin").empty();
            //         $("#status_perkawinan").empty();
            //         $("#pekerjaan").empty();
            //         $("#nama_jalan").empty();
            //         $("#no_rumah").empty();
            //         $("#rtrw").empty();
            //         $("#provinsi").empty();
            //         $("#kota").empty();
            //         $("#kecamatan").empty();
            //         $("#desa").empty();
            //         $("#kode_pos").empty();
            //         $("#bumdes").empty();
            //         $("#no_hp").empty();
            //         $("#status_keluarga").empty();
            //         $("#nama_ibu").empty();
            //         $("#nama_kerabat").empty();
            //         $("#no_telp_keluarga").empty();
            //         $("#pendidikan").empty();
            //         $("#namasehubungkeluarga").empty();
            //         $("#no_telp").empty();
            //         $("#nama_warung").empty();
            //         $("#profil_warung").empty();
            //         $("#bidang_usaha").empty();
            //         $("#berdiri_sejak").empty();
            //         $("#nama_jalan1").empty();
            //         $("#no_rumah1").empty();
            //         $("#rtrw1").empty();
            //         $("#provinsi1").empty();
            //         $("#kota1").empty();
            //         $("#kecamatan1").empty();
            //         $("#desa1").empty();
            //         $("#kode_pos12").empty();
            //     }
            // });

            $('#batch').on('change', function() {
                var selected = $(this).find('option:selected');
                var selBatch = selected.data('batch');

                if (selBatch) {
                    $('#pendana').val(selBatch.pendana.nama_pendana);
                    $('#no_batch').val(selBatch.batch);
                    $('#plafon_pengajuan').val(selBatch.nominal_dana);
                    $('#jangka_waktu').val(selBatch.jangka_waktu + ' Bulan');
                    $('.batch_field').show(300);
                } else {
                    $('.batch_field').hide(200);
                    $('#pendana').val('');
                    $('#no_batch').val('');
                    $('#plafon_pengajuan').val('');
                    $('#jangka_waktu').val('');
                }

                // $.ajax({
                //     url: "{{ route('daftar_pembiayaan.index') }}",
                //     method: 'GET',
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                //     },
                //     data: {regKtp: $(this).val()},
                //     success: function(response) {
                //         if (response) {
                //             console.log(response.results.sumber_pendanaans.id)
                //             let GL_batch = response.results.GL_batch_pendanaan;
                //             $('#bulan').val(GL_batch);
                //             $('#sumber_pendanaan').val(response.results.sumber_pendanaans.nama_sumber_pendanaan);
                //             $('#dana_peyaluran').val(response.results.sumber_pendanaans.id);
                //         }
                //     },
                // });
            });

            $(".nominal").inputmask('decimal', {
                'alias': 'numeric',
                'groupSeparator': ',',
                'autoGroup': true,
                'digits': 2,
                'radixPoint': ".",
                // 'digitsOptional': false,
                'allowMinus': false,
                'placeholder': '0.00',
                'rightAlign': false,
            });

            function clearAllField() {
                $("#nik").empty();
                $("#no_mitra").empty();
                $("#email").empty();
                $("#kode_pos").empty();
                $("#no_kk").empty();
                $("#tanggal_lahir").empty();
                $("#tempat_lahir").empty();
                $("#jenis_kelamin").empty();
                $("#status_perkawinan").empty();
                $("#pekerjaan").empty();
                $("#nama_jalan").empty();
                $("#no_rumah").empty();
                $("#rtrw").empty();
                $("#provinsi").empty();
                $("#kota").empty();
                $("#kecamatan").empty();
                $("#desa").empty();
                $("#kode_pos").empty();
                $("#bumdes").empty();
                $("#no_hp").empty();
                $("#status_keluarga").empty();
                $("#nama_ibu").empty();
                $("#pendidikan").empty();
                $("#namasehubungkeluarga").empty();
                $("#nama_kerabat").empty();
                $("#no_telp_keluarga").empty();
                $("#no_telp").empty();
                $("#nama_warung").empty();
                $("#profil_warung").empty();
                $("#bidang_usaha").empty();
                $("#berdiri_sejak").empty();
                $("#nama_jalan1").empty();
                $("#no_rumah1").empty();
                $("#rtrw1").empty();
                $("#provinsi1").empty();
                $("#kota1").empty();
                $("#kecamatan1").empty();
                $("#desa1").empty();
                $("#kode_pos12").empty();
            }


        });

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
            var address = $('#nama_jalan').val() + ' ' + ' ' + $('#provinsi').val();
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

        $('#nama_jalan,#kota,#provinsi,#kecamatan,#desa').on('change', function () {
            codeAddress();
        });

        $(document).ready(function() {
            if ($('input[name="coordinates"]').val() == '') {
                codeAddress();
            }
        });
    </script>

@endpush
