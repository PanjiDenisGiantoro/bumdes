@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Daftar Warung') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('warung.index') }}">{{ __('Daftar Warung') }}</a>
        </li>
    </x-breadcrumb>

@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                {{-- <h5 class="card-header">Basic Wizard</h5> --}}
                <form method="POST" class="form-horizontal" action="{{ !empty($warung->id) ? route('warung.update', [$warung]) : route('warung.store') }}">

                    @if (!empty($warung->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body p-0">
                        <div id="basicwizard" class="border pt-0">
                            <ul class="nav nav-tabs nav-justified navtab-wizard bg-muted">
                                <li class="nav-item">
                                    <a href="#informasi-pemohon" data-toggle="tab" class="nav-link font-bold active">
                                        {{ __('Informasi Pemohon') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#informasi-warung" data-toggle="tab" class="nav-link font-bold">
                                        {{ __('Informasi Warung') }}
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content card-body mt-3 b-0 mb-0">
                                <div class="tab-pane m-t-10 fade show active" id="informasi-pemohon">
                                    <h3 class="card-title">{{ __('Informasi Pemohon')}}</h3>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group clearfix">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label class="control-label form-label" for="nama_pemohon">{{ __('Nama Pemohon') }}</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input 
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
                                                        <label class="control-label form-label" for="email_pemohon">{{ __('Email Pemohon') }}</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input 
                                                            id="email_pemohon" 
                                                            name="email_pemohon" 
                                                            type="email" 
                                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('email_pemohon')]) 
                                                            value="{{ old('email_pemohon') }}"
                                                        />
                                                        @error('email_pemohon')
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
                                                    <div class="col-md-3">
                                                        <input 
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

                                                    <div class="col-md-3">
                                                        <label class="control-label form-label" for="no_kk">{{ __('No. KK') }}</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input 
                                                            id="no_kk" 
                                                            name="no_kk" 
                                                            type="text" 
                                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('no_kk')]) 
                                                            value="{{ old('no_kk') }}"
                                                        />
                                                        @error('no_kk')
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
                                                    <div class="col-md-3">
                                                        <input 
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

                                                    <div class="col-md-3">
                                                        <label class="control-label form-label" for="tempat_lahir">{{ __('Tempat Lahir') }}</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input 
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
                                                    <div class="col-md-3">
                                                        <select name="jenis_kelamin" class="form-control select2" data-placeholder="{{ __('Pilih Jenis Kelamin') }}" data-minimum-results-for-search="Infinity">
                                                            <option value="">{{ __('Pilih Jenis Kelamin') }}</option>
                                                            <option value="M">{{ __('Pria') }}</option>
                                                            <option value="F">{{ __('Wanita') }}</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label class="control-label form-label" for="status_perkawinan">{{ __('Status Perkawinan') }}</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <select name="status_perkawinan" class="form-control select2" data-placeholder="{{ __('Pilih Status Perkawinan') }}">
                                                            <option value="">{{ __('Pilih Status Perkawinan') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <h3 class="card-title">{{ __('Informasi Kontak')}}</h3>

                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="control-label form-label" for="alamat">{{ __('Alamat') }}</label>
                                            </div>
                                            <div class="col-md-9">
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
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="control-label form-label" for="kode_pos">{{ __('Kode Pos') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input 
                                                    id="kode_pos" 
                                                    name="kode_pos" 
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
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="control-label form-label" for="kota">{{ __('Kota') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <select id="kota" name="kota" class="form-control select2" data-placeholder="{{ __('Pilih Kota') }}">
                                                    <option value="">{{ __('Pilih Kota') }}</option>
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="control-label form-label" for="provinsi">{{ __('Provinsi') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <select id="provinsi" name="provinsi" class="form-control select2" data-placeholder="{{ __('Pilih Provinsi') }}">
                                                    <option value="">{{ __('Pilih Provinsi') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="control-label form-label" for="no_handphone">{{ __('No. Handphone') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input 
                                                    id="no_handphone" 
                                                    name="no_handphone" 
                                                    type="text" 
                                                    @class(['required', 'form-control', 'is-invalid' => $errors->has('no_handphone')]) 
                                                    value="{{ old('no_handphone') }}"
                                                />
                                                @error('no_handphone')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-3">
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
                                            </div>
                                        </div>
                                    </div>

                                    <h3 class="card-title">{{ __('Informasi Keluarga')}}</h3>
                                </div>
                                <div class="tab-pane m-t-10 fade" id="informasi-warung">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group clearfix">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label class="control-label form-label" for="nama_warung">{{ __('Nama Warung') }}</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input 
                                                            id="nama_warung" 
                                                            name="nama_warung" 
                                                            type="text" 
                                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_warung')]) 
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
                                                        <label class="control-label form-label" for="profil_warung">{{ __('Profil Warung') }}</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <textarea
                                                            id="profil_warung" 
                                                            name="profil_warung" 
                                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('profil_warung')])
                                                            rows="5"
                                                        >{{ old('nama_warung') }}</textarea>
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
                                                    <div class="col-md-3">
                                                        <input 
                                                            id="bidang_usaha" 
                                                            name="bidang_usaha" 
                                                            type="text" 
                                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('bidang_usaha')]) 
                                                            value="{{ old('bidang_usaha') }}"
                                                        />
                                                        @error('bidang_usaha')
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
                                                        <label class="control-label form-label" for="berdiri_sejak">{{ __('Berdiri Sejak') }}</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input 
                                                            id="berdiri_sejak" 
                                                            name="berdiri_sejak" 
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
                                                        <label class="control-label form-label" for="status_bangunan">{{ __('Status Bangunan') }}</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input 
                                                            id="status_bangunan" 
                                                            name="status_bangunan" 
                                                            type="text" 
                                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('status_bangunan')]) 
                                                            value="{{ old('status_bangunan') }}"
                                                        />
                                                        @error('status_bangunan')
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border border-top-0 text-right">
                        <button type="submit" class="btn btn-primary">{{ !empty($warung->id) ? __('Perbaharui') : __('Hantar') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <!-- forn-wizard css-->
    <link href="{{ asset('assets/plugins/forn-wizard/css/material-bootstrap-wizard.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/forn-wizard/css/demo.css') }}" rel="stylesheet" />

    <!-- select2 Plugin -->
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

    <style>
    select {
        border: 1px solid #e8ebf3 !important;
    }
    .select2-container {
        width: 100% !important;
    }
    </style>
@endpush

@push('scripts')
    <!-- Form wizard js -->
    <script src="{{ asset('assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/wizard.js') }}"></script>

    <!--Select2 js -->
    <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>

    <script>
    $('select.select2').select2();

    $('select#kota').select2({
        ajax: {
            url: 'https://kodepos.vercel.app/search',
            data: function (params) {
                var query = {
                    q: $('#kode_pos').val(),
                }

                return query;
            },
            processResults: function (data) {
                const city = collect(data.data)
                    .map(item => {
                        item.id   = item.city;
                        item.text = item.city;

                        return item;
                    })
                    .unique('city')

                return {
                    results: city.items,
                }
            }
        },
    });

    $('select#provinsi').select2({
        ajax: {
            url: 'https://kodepos.vercel.app/search',
            data: function (params) {
                var query = {
                    q: $('#kode_pos').val(),
                }

                return query;
            },
            processResults: function (data) {
                const province = collect(data.data)
                    .map(item => {
                        item.id   = item.province;
                        item.text = item.province;

                        return item;
                    })
                    .unique('province')

                return {
                    results: province.items,
                }
            }
        },
    });
    </script>
@endpush
