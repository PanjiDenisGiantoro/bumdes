@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Pegawai') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Pegawai') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kode_profil.index') }}">{{ __('Pegawai') }}</a>
        </li>
        <li class="breadcrumb-item">
            @if(!empty($KodeProfil->id))
                {{ __('Edit Pegawai') }}
            @else
            {{ __('Tambah Pegawai') }}

            @endif
        </a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                                @if (!empty($KodeProfil->id))
                <h5 class="card-header">{{ __('Edit Pegawai') }}</h5>

@else
                <h5 class="card-header">{{ __('Tambah Pegawai') }}</h5>

@endif

                    <form method="POST" class="form-horizontal" action="{{ !empty($KodeProfil->id) ? route('kode_profil.update', [$KodeProfil->id]) : route('kode_profil.store') }}">

                    @if (!empty($KodeProfil->id))
                        @method('PUT')
                    @endif
                    @csrf

                    <input name="status" type="hidden" id="statusValue" value="{{ $KodeProfil->status ?? '1' }}">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="nama_pegawai">{{ __('Nama Pegawai') }}</label>
                                        </div>
                                        <div class="col-md-4">

                                            <input
                                                value="{{old('nama_pegawai'),$KodeProfil->nama_pegawai ??''}}"
                                            id="nama_pegawai"
                                            name="nama_pegawai"
                                            type="text"
                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_pegawai')])
                                            />
                                            @error('nama_pegawai')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                            </span>
                                             @enderror
                                        </div>

                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="nik">{{ __('NIK') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                value="{{old('nik'), $KodeProfil->nik ??''}}"
                                            id="nik"
                                                required
                                            onkeypress="return isNumberKey(event)"
                                                maxlength = "16"
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
                                                value="{{old('id_pengguna'),$KodeProfil->id_pengguna ??''}}"
                                                id="id_pengguna"
                                                name="id_pengguna"
                                                required
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
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="tanggal_daftar">{{ __('Tgl Daftar') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                value="{{$KodeProfil->tanggal_daftar ?? date('Y-m-d')}}"
                                                readonly
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
                                                        value="{{old('email_perusahaan'),$KodeProfil->email_perusahaan ??''}}"
                                                        id="email_perusahaan"
                                                        name="email_perusahaan"
                                                        required
                                                        type="email"

                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('email_perusahaan')])
                                                    />
                                                    @error('email_perusahaan')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ 'email Pengguna sudah tersedia' }}
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
                                                    value="{{old('no_hp'),$KodeProfil->no_hp ??''}}"
                                                    id="no_hp"
                                                    maxlength="14"
                                                    required
                                                    name="no_hp"
                                            onkeypress="return isNumberKey(event)"
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
                                            <label class="control-label form-label" for="Jabatan">{{ __('Unit Kerja') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="id_jabatan" id="id_jabatan" class="form-control select2" data-placeholder="Pilih Unit Kerja" required>
                                                <option></option>
                                                @if(!empty($KodeProfil))
                                                    @foreach($KodePengguna as $kode)
                                                        <option value="{{$kode->id}}"@if($KodeProfil->id_jabatan == $kode->id)selected @endif>{{$kode->nama_jabatan}}</option>
                                                    @endforeach
                                                @else
                                                    @foreach($KodePengguna as $kode)
                                                        <option value="{{$kode->id}}" >{{$kode->nama_jabatan}}</option>
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
                                <div class="form-group clearfix">
                                    <div class="row">
                                            <div class="col-md-2">
                                            <label class="control-label form-label" for="Jabatan">{{ __('Hak Akses') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="hak_akses" id="hak_akses" class="form-control select2" data-placeholder="Pilih Hak Akses" required>
                                                <option></option>
                                                @if(!empty($KodeProfil))
                                                    @foreach($roles as $kode)
                                                        <option value="{{$kode->id}}"@if($KodeProfil->hak_akses == $kode->id)selected @endif>{{$kode->name}}</option>
                                                    @endforeach
                                                @else
                                                    @foreach($roles as $kode)
                                                        <option value="{{$kode->name}}" >{{$kode->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('id_jabatan')
                                            <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                            @enderror
                                        </div>
                                            <div class="col-md-2">
                                                <label class="control-label form-label" for="no_hp">{{ __('Limit Transaksi') }}</label>
                                            </div>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control num2words" name="limit_transaksi" id="limit_transaksi" value="{{ $user->limit_transaksi ?? '' }}" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'">
                                                {{-- <input
                                                    value="{{old('limit_transaksi'),$KodeProfil->limit_transaksi ??''}}"
                                                    id="limit_transaksi"
                                                    required
                                                    name="limit_transaksi"
                                                    type="number"
                                                    data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'"
                                                    @class(['required', 'num2words', 'form-control', 'is-invalid' => $errors->has('limit_transaksi')])
                                                    value="{{ old('limit_transaksi') }}"
                                                /> --}}
                                                @error('limit_transaksi')
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
                                                <label class="control-label form-label" for="no_hp">{{ __('Akun Perkiraan') }}</label>
                                            </div>
                                            <div class="col-md-4">
                                                <select name="penampung_id" id="penampung_id" class="form-control select2" data-placeholder="Pilih Akun Perkiraan" required>
                                                <option></option>
                                                    @if(!empty($KodeProfil))
                                                        @foreach($akuns as $kode)
                                                            <option value="{{$kode->id}}"@if($akuns->penampung_id == $kode->id)selected @endif>{{$kode->nama}}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($akuns as $gl)
                                                            <option value="{{$gl->id}}">{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('id_jabatan')
                                                <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label form-label" for="no_hp">{{ __('Status') }}</label>
                                            </div>
                                            <div class="col-md-4">
                                                <div>
                                                    {{-- <input type="checkbox" class="custom-control-input" id="status" {{ !empty($user->id) ? ($user->status == '1' ? 'checked' : 'unchecked') : 'checked'}} /> --}}
                                                    <input type="checkbox" checked data-toggle="toggle" data-on="Aktif" data-off="Tidak Aktif" {{ !empty($KodeProfil->id) ? ($KodeProfil->status == '1' ? 'checked' : 'unchecked') : 'checked'}}>
                                                    {{-- <label class="custom-control-label" for="status" id="statusLabel">{{ !empty($user->id) ? ($user->status == '1' ? 'Aktif' : 'Tidak Aktif') : 'Aktif' }}</label> --}}
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border border-top-0 text-right">
                        <!-- <button type="submit" class="btn btn-primary">{{ !empty($tetapan->id) ? __('Perbaharui') : __('Ubah') }}</button> -->
                        <a href="{{ route('kode_profil.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($KodeProfil->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($KodeProfil->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src=”https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js”></script>
<script>
    $(document).ready(function() {
        $('select').select2();
        $(":input").inputmask();

        $('.num2words').each(function () {
            let inputval = $(this).val();

            if (!isNaN(inputval)) {
                $(this).parent().next().html($(this).num2words()[0].result);
            }
        });
        
    });

</script>
@endpush
