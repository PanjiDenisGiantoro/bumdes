@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Daftar Produk') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('produk-simpanan.index') }}">{{ __('Daftar Produk') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Daftar Produk Simpanan ') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Register Produk Simpanan') }}</h5>

                <form autocomplete="off" method="POST" class="form-horizontal" action="{{ !empty($produk_simpanan->id) ? route('produk-simpanan.update', [$produk_simpanan]) : route('produk-simpanan.store') }}">

                    @if (!empty($produk_simpanan->id))
                        @method('PUT')
                    @endif

                    @csrf


                    <input type="hidden" id="status_value" name="status" value="{{ !empty($produk_simpanan->id) ? $produk_simpanan->status : 1 }}">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                	<div class="row">
                                        <div class="col-md-4">
                                            <label class="control-label form-label" for="akad_simpanan">{{ __('Akad') }}</label>
                                            <select name="akad_simpanan" class="form-control " data-minimum-results-for-search="Infinity">
                                                <option value="">Pilih Akad</option>

                                                @foreach($akadList as $akad)
                                                    <option value="{{$akad->id}}"@if(!empty($produk_simpanan->id) ? $produk_simpanan->akad_simpanan == $akad->id : '')selected @endif>{{$akad->nama_akad}}</option>
                                                @endforeach
                                            </select>
                                        </div>
						           </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label class="control-label form-label" for="nama_simpanan">{{ __('Nama Simpanan') }}</label>
                                            <input id="nama_simpanan" nama_simpanan name="nama_simpanan" type="text" placeholder="Simpanan Modalisasi"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_simpanan')])
                                                value="{{ old('nama_simpanan', $produk_simpanan->nama_simpanan ?? '') }}"
                                            />
                                            @error('nama_simpanan')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label form-label" for="kode_simpanan">{{ __('Kode Simpanan') }}</label>
                                            <input
                                                value="{{ old('kode_simpanan', $produk_simpanan->kode_simpanan ?? '') }}"

                                                id="kode_simpanan"
                                                name="kode_simpanan"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('kode_simpanan')])
                                            />
                                            @error('kode_simpanan')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="control-label form-label" for="storan_minimal">{{ __('Min. Setoran Awal') }}</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="text"
                                                       @class(['required', 'form-control', 'is-invalid' => $errors->has('storan_minimal')])
                                                       value="{{old('storan_minimal',!empty($produk_simpanan->storan_minimal) ? number_format($produk_simpanan->storan_minimal) : '')}}"
                                                       style="text-align: right;"
                                                       id="storan_minimal_value"
                                                       name=""
                                                       aria-label="Amount (to the nearest dollar)">
                                            </div>
                                            <input
                                                hidden
                                                id="storan_minimal" storan_minimal
                                                name="storan_minimal"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('storan_minimal')])
                                                value="{{ old('storan_minimal', $produk_simpanan->storan_minimal ?? '') }}"
                                            />
                                            @error('storan_minimal')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label form-label" for="storan_selanjut">{{ __('Min. Setoran Selanjut') }}</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="text"
                                                       @class(['required', 'form-control', 'is-invalid' => $errors->has('storan_selanjut')])
                                                       value="{{old('storan_selanjut',!empty($produk_simpanan->storan_selanjut) ? number_format($produk_simpanan->storan_selanjut) : '')}}"
                                                       style="text-align: right;"
                                                       id="storan_selanjut_value"
                                                       name=""
                                                       aria-label="Amount (to the nearest dollar)">
                                            </div>
                                            <input
                                                hidden
                                                id="storan_selanjut" storan_selanjut
                                                name="storan_selanjut"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('storan_selanjut')])
                                                value="{{ old('storan_selanjut', $produk_simpanan->storan_selanjut ?? '') }}"
                                            />
                                            @error('storan_selanjut')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label form-label" for="saldo_mengendap">{{ __('Saldo Mengendap') }}</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="text"
                                                       @class(['required', 'form-control', 'is-invalid' => $errors->has('saldo_mengendap')])
                                                       value="{{old('saldo_mengendap',!empty($produk_simpanan->saldo_mengendap) ? number_format($produk_simpanan->saldo_mengendap) : '')}}"
                                                       style="text-align: right;"
                                                       id="saldo_mengendap_value"
                                                       name=""
                                                       aria-label="Amount (to the nearest dollar)">
                                            </div>
                                            <input

                                                hidden
                                                id="saldo_mengendap" saldo_mengendap
                                                name="saldo_mengendap"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('saldo_mengendap')])
                                                value="{{ old('saldo_mengendap', $produk_simpanan->saldo_mengendap ?? '') }}"
                                            />
                                            @error('saldo_mengendap')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="control-label form-label" for="penalti">{{ __('Penalti') }}</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="text"
                                                       @class(['required', 'form-control', 'is-invalid' => $errors->has('penalti')])
                                                       value="{{old('penalti',!empty($produk_simpanan->penalti) ? number_format($produk_simpanan->penalti) : '')}}"
                                                       style="text-align: right;"
                                                       id="penalti_value"
                                                       name=""
                                                       aria-label="Amount (to the nearest dollar)">
                                            </div>
                                            <input
                                                hidden
                                                id="penalti" penalti
                                                name="penalti"
                                                type="penalti"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('penalti')])
                                                value="{{ old('penalti', $produk_simpanan->penalti ?? '') }}"

                                            />
                                            @error('kode')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <h3 class="card-title">Informasi Biaya Simpanan</h3>
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="control-label form-label" for="biaya_admin">{{ __('Biaya Admin') }}</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="text"
                                                       @class(['required', 'form-control', 'is-invalid' => $errors->has('biaya_admin')])
                                                       value="{{old('biaya_admin',!empty($produk_simpanan->biaya_admin) ? number_format($produk_simpanan->biaya_admin) : '')}}"
                                                       style="text-align: right;"
                                                       id="biaya_admin_value"
                                                       name=""
                                                       aria-label="Amount (to the nearest dollar)">
                                            </div>
                                            <input
                                                hidden
                                                id="biaya_admin"
                                                name="biaya_admin"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('biaya_admin')])
                                                value="{{ old('biaya_admin', $produk_simpanan->biaya_admin ?? '') }}"
                                            />
                                            @error('biaya_admin')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="form-label">GL</label>
                                                <div class="form-control-select">
                                                    <select class="form-control select" id="GL_biaya_admin" name="GL_biaya_admin">
                                                        <option>Pilih Akun</option>
                                                        @foreach($GLList as $gl)
                                                            <option value="{{$gl->id}}"@if(!empty($produk_simpanan->GL_biaya_admin) ? $produk_simpanan->GL_biaya_admin == $gl->id : '')selected @endif>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="control-label form-label" for="biaya_materai">{{ __('Biaya Materai') }}</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="text"
                                                       @class(['required', 'form-control', 'is-invalid' => $errors->has('biaya_materai')])
                                                       value="{{old('biaya_materai',!empty($produk_simpanan->biaya_materai) ? number_format($produk_simpanan->biaya_materai) : '')}}"
                                                       style="text-align: right;"
                                                       id="biaya_materai_value"
                                                       name=""
                                                       aria-label="Amount (to the nearest dollar)">
                                            </div>
                                            <input
                                                hidden
                                                id="biaya_materai"
                                                name="biaya_materai"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('biaya_materai')])
                                                value="{{ old('biaya_materai', $produk_simpanan->biaya_materai ?? '') }}"
                                            />
                                            @error('biaya_materai')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="form-label">GL</label>
                                                <div class="form-control-select">
                                                    <select class="form-control" id="GL_biaya_materai" name="GL_biaya_materai">
                                                        <option>Pilih Akun</option>
                                                         @foreach($GLList as $gl)
                                                            <option value="{{$gl->id}}"@if(!empty($produk_simpanan->GL_biaya_materai) ? $produk_simpanan->GL_biaya_materai == $gl->id : '')selected @endif>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="control-label form-label" for="biaya_registrasi">{{ __('Biaya Registrasi') }}</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="text"
                                                       @class(['required', 'form-control', 'is-invalid' => $errors->has('biaya_registrasi')])
                                                       value="{{old('biaya_registrasi',!empty($produk_simpanan->biaya_registrasi) ? number_format($produk_simpanan->biaya_registrasi) : '')}}"
                                                       style="text-align: right;"
                                                       id="biaya_registrasi_value"
                                                       name=""
                                                       aria-label="Amount (to the nearest dollar)">
                                            </div>
                                            <input
                                                hidden
                                                id="biaya_registrasi"
                                                name="biaya_registrasi"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('biaya_registrasi')])
                                                value="{{ old('biaya_registrasi', $produk_simpanan->biaya_registrasi ?? '') }}"
                                            />
                                            @error('biaya_registrasi')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="form-label">GL</label>
                                                <div class="form-control-select">
                                                    <select class="form-control" id="GL_biaya_registrasi" name="GL_biaya_registrasi">
                                                        <option>Pilih Akun</option>
                                                        @foreach($GLList as $gl)
                                                            <option value="{{$gl->id}}"@if(!empty($produk_simpanan->GL_biaya_registrasi) ? $produk_simpanan->GL_biaya_registrasi == $gl->id : '')selected @endif>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="control-label form-label" for="biaya_asuransi">{{ __('Biaya Asuransi') }}</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="text"
                                                       @class(['required', 'form-control', 'is-invalid' => $errors->has('biaya_asuransi')])
                                                       value="{{old('biaya_asuransi',!empty($produk_simpanan->biaya_asuransi) ? number_format($produk_simpanan->biaya_asuransi) : '')}}"
                                                       style="text-align: right;"
                                                       id="biaya_asuransi_value"
                                                       name=""
                                                       aria-label="Amount (to the nearest dollar)">
                                            </div>
                                            <input
                                                hidden
                                                id="biaya_asuransi"
                                                name="biaya_asuransi"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('biaya_asuransi')])
                                                value="{{ old('biaya_asuransi', $produk_simpanan->biaya_asuransi ?? '') }}"
                                            />
                                            @error('biaya_asuransi')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="form-label">GL</label>
                                                <div class="form-control-select">
                                                    <select class="form-control" id="GL_biaya_asuransi" name="GL_biaya_asuransi">
                                                        <option>Pilih Akun</option>
                                                        @foreach($GLList as $gl)
                                                            <option value="{{$gl->id}}"@if(!empty($produk_simpanan->GL_biaya_asuransi) ? $produk_simpanan->GL_biaya_asuransi == $gl->id : '')selected @endif>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="control-label form-label" for="biaya_penutupan_rekening">{{ __('Biaya Penutupan Rekening') }}</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="text"
                                                       @class(['required', 'form-control', 'is-invalid' => $errors->has('biaya_penutupan_rekening')])
                                                       value="{{old('biaya_penutupan_rekening',!empty($produk_simpanan->biaya_penutupan_rekening) ? number_format($produk_simpanan->biaya_penutupan_rekening) : '')}}"
                                                       style="text-align: right;"
                                                       id="biaya_penutupan_rekening_value"
                                                       name=""
                                                       aria-label="Amount (to the nearest dollar)">
                                            </div>
                                            <input
                                                hidden
                                                id="biaya_penutupan_rekening"
                                                name="biaya_penutupan_rekening"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('biaya_penutupan_rekening')])
                                                value="{{ old('biaya_penutupan_rekening', $produk_simpanan->biaya_penutupan_rekening ?? '') }}"
                                            />
                                            @error('biaya_penutupan_rekening')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="form-label">GL</label>
                                                <div class="form-control-select">
                                                    <select class="form-control" id="GL_biaya_penutupan_rekening" name="GL_biaya_penutupan_rekening">
                                                        <option>Pilih Akun</option>
                                                        @foreach($GLList as $gl)
                                                            <option value="{{$gl->id}}"@if(!empty($produk_simpanan->GL_biaya_penutupan_rekening) ? $produk_simpanan->GL_biaya_penutupan_rekening == $gl->id : '')selected @endif>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="control-label form-label" for="biaya_transfer_luar">{{ __('Biaya Transfer Luar Instansi') }}</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="text"
                                                       @class(['required', 'form-control', 'is-invalid' => $errors->has('biaya_transfer_luar')])
                                                       value="{{old('biaya_transfer_luar',!empty($produk_simpanan->biaya_transfer_luar) ? number_format($produk_simpanan->biaya_transfer_luar) : '')}}"
                                                       style="text-align: right;"
                                                       id="biaya_transfer_luar_value"
                                                       name=""
                                                       aria-label="Amount (to the nearest dollar)">
                                            </div>
                                            <input
                                                hidden
                                                id="biaya_transfer_luar"
                                                name="biaya_transfer_luar"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('biaya_transfer_luar')])
                                                value="{{ old('biaya_transfer_luar', $produk_simpanan->biaya_transfer_luar ?? '') }}"
                                            />
                                            @error('biaya_transfer_luar')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="form-label">GL</label>
                                                <div class="form-control-select">
                                                    <select class="form-control" id="GL_biaya_transfer_luar" name="GL_biaya_transfer_luar">
                                                        <option>Pilih Akun</option>
                                                        @foreach($GLList as $gl)
                                                            <option value="{{$gl->id}}"@if(!empty($produk_simpanan->GL_biaya_transfer_luar) ? $produk_simpanan->GL_biaya_transfer_luar == $gl->id : '')selected @endif>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <h3 class="card-title">Informasi Lain -lain</h3>
                                <div class="form-group clearfix">
                                    <div class="row">
{{--                                        <div class="col-md-4">--}}
{{--                                            <div class="form-label">BOLEH TRANSFER</div>--}}
{{--                                            <label class="custom-switch">--}}
{{--                                                <input type="checkbox" id="status_produk" class="custom-switch-input" {{ !empty($produk_simpanan) ? ($produk_simpanan->status == 1 ? 'checked' : 'unchecked') : 'checked' }}>--}}
{{--                                                <span class="custom-switch-indicator"></span>--}}
{{--                                                <span id="status_label" class="custom-switch-description">{{ !empty($produk_simpanan) ? ($produk_simpanan->status == 1 ? 'AKTIF' : 'TIDAK AKTIF') : 'AKTIF' }}</span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
                                        <div class="col-md-6">
                                            <div class="form-label">SHU</div>
                                            <label class="custom-switch">
                                                <input type="checkbox" id="status_produk" class="custom-switch-input" {{ !empty($produk_simpanan) ? ($produk_simpanan->status == 1 ? 'checked' : 'unchecked') : 'checked' }}>
                                                <span class="custom-switch-indicator"></span>
                                                <span id="status_label" class="custom-switch-description">{{ !empty($produk_simpanan) ? ($produk_simpanan->status == 1 ? 'AKTIF' : 'TIDAK AKTIF') : 'AKTIF' }}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-label">STATUS PRODUK</div>
                                            <label class="custom-switch">
                                                <input type="checkbox" id="status_produk" class="custom-switch-input" {{ !empty($produk_simpanan) ? ($produk_simpanan->status == 1 ? 'checked' : 'unchecked') : 'checked' }}>
                                                <span class="custom-switch-indicator"></span>
                                                <span id="status_label" class="custom-switch-description">{{ !empty($produk_simpanan) ? ($produk_simpanan->status == 1 ? 'AKTIF' : 'TIDAK AKTIF') : 'AKTIF' }}</span>
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-label">ADA AO</div>
                                            <label class="custom-switch">
                                                <input type="checkbox" id="ada_ao" class="custom-switch-input" {{ !empty($produk_simpanan) ? ($produk_simpanan->status == 1 ? 'checked' : 'unchecked') : 'checked' }}>
                                                <span class="custom-switch-indicator"></span>
                                                <span id="status_label" class="custom-switch-description">{{ !empty($produk_simpanan) ? ($produk_simpanan->status == 1 ? 'AKTIF' : 'TIDAK AKTIF') : 'AKTIF' }}</span>
                                            </label>
                                        </div>
{{--                                        <div class="col-md-4">--}}
{{--                                            <div class="form-label">LOCK REKENING</div>--}}
{{--                                            <label class="custom-switch">--}}
{{--                                                <input type="checkbox" id="lock_rekening" class="custom-switch-input" {{ !empty($produk_simpanan) ? ($produk_simpanan->lock_rekening == 1 ? 'checked' : 'unchecked') : 'checked' }}>--}}
{{--                                                <span class="custom-switch-indicator"></span>--}}
{{--                                                <span id="lock_rekening_label" class="custom-switch-description">{{ !empty($produk_simpanan) ? ($produk_simpanan->lock_rekening == 1 ? 'AKTIF' : 'TIDAK AKTIF') : 'AKTIF' }}</span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
                                        <div class="col-md-6">
                                            <div class="form-label">Bagi Hasil</div>
                                            <label class="custom-switch">
                                                <input type="checkbox" id="bagi_hasil" class="custom-switch-input"  >
                                                <span class="custom-switch-indicator"></span>
                                                <span id="status_bagi_hasil_label" class="custom-switch-description">TIDAK AKTIF</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row g-4">
                                        <div class="col-lg-5">

                                        </div>
                                        <div class="col-lg-3" id="nisbah_koperasi_field">
                                            <div class="form-group">
                                                <label class="form-label" for="nisbah_hasil_1">Nisbah Koperasi</label>
                                                <div class="form-control-wrap">
                                                    <input type="number" class="form-control" min="1" max="100" name="nisbah_koperasi" id="nisbah_koperasi"
                                                           onKeyUp="if(this.value>100){this.value='100';}else if(this.value<0){this.value='0';}"
                                                           value="{{ $simpanan->nisbah_koperasi ?? '' }}"
                                                           maxlength = "3" max="100"
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3" id="nisbah_anggota_field">
                                            <div class="form-group">
                                                <label class="form-label" for="nisbah_hasil_2">Nisbah Anggota</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="nisbah_anggota" id="nisbah_anggota" value="{{ $simpanan->nisbah_anggota ?? '' }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>





                                <br>
                                <h3 class="card-title">Kode Buku Besar</h3>
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">GL Produk Simpanan</label>
                                                <div class="form-control-select">
                                                    <select class="form-control" id="GL_produk_simpanan" name="GL_produk_simpanan">
                                                        <option>Pilih Akun</option>
                                                        @foreach($GLList as $gl)
                                                            <option value="{{$gl->id}}"@if(!empty($produk_simpanan->GL_produk_simpanan) ? $produk_simpanan->GL_produk_simpanan == $gl->id : '')selected @endif>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="form-label">GL PPH</label>
                                                <div class="form-control-select">
                                                    <select class="form-control" id="GL_titipan_pph" name="GL_titipan_pph">
                                                        <option>Pilih Akun</option>
                                                         @foreach($GLList as $gl)
                                                            <option value="{{$gl->id}}"@if(!empty($produk_simpanan->GL_titipan_pph) ? $produk_simpanan->GL_titipan_pph == $gl->id : '')selected @endif>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">PPH dari Basil</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp.</span>
                                                    </div>
                                                    <input type="text"
                                                           @class(['required', 'form-control', 'is-invalid' => $errors->has('pph_basil')])
                                                           value="{{old('pph_basil',!empty($produk_simpanan->pph_basil) ? number_format($produk_simpanan->pph_basil) : '')}}"
                                                           style="text-align: right;"
                                                           id="pph_basil_value"
                                                           name=""
                                                           aria-label="Amount (to the nearest dollar)">
                                                </div>
                                                <input
                                                    hidden
                                                    id="pph_basil"
                                                    type="text"
                                                    name="pph_basil"
                                                    @class(['required', 'form-control', 'is-invalid' => $errors->has('pph_basil')])
                                                    value="{{ old('pph_basil', $produk_simpanan->pph_basil ?? '') }}"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="form-label">GL Zakat Simpanan</label>
                                                <div class="form-control-select">
                                                    <select class="form-control" id="GL_titipan_zakat" name="GL_titipan_zakat">
                                                        <option>Pilih Akun</option>
                                                         @foreach($GLList as $gl)
                                                            <option value="{{$gl->id}}"@if(!empty($produk_simpanan->GL_titipan_zakat) ? $produk_simpanan->GL_titipan_zakat == $gl->id : '')selected @endif>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Zakat dari Basil</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp.</span>
                                                    </div>
                                                    <input type="text"
                                                           @class(['required', 'form-control', 'is-invalid' => $errors->has('zakat_basil')])
                                                           value="{{old('zakat_basil',!empty($produk_simpanan->zakat_basil) ? number_format($produk_simpanan->zakat_basil) : '')}}"
                                                           style="text-align: right;"
                                                           id="zakat_basil_value"
                                                           name=""
                                                           aria-label="Amount (to the nearest dollar)">
                                                </div>
                                                <input
                                                    hidden
                                                    id="zakat_basil"
                                                    name="zakat_basil"
                                                    type="text"
                                                    @class(['required', 'form-control', 'is-invalid' => $errors->has('zakat_basil')])
                                                    value="{{ old('zakat_basil', $produk_simpanan->zakat_basil ?? '') }}"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">GL Beban Bagi Hasil/Bonus</label>
                                                <div class="form-control-select" >
                                                    <select class="form-control" id="GL_beban_bagi_hasil" name="GL_beban_bagi_hasil" >
                                                        <option>Pilih Akun</option>
                                                        @foreach($GLList as $gl)
                                                            <option value="{{$gl->id}}"@if(!empty($produk_simpanan->GL_beban_bagi_hasil) ? $produk_simpanan->GL_beban_bagi_hasil == $gl->id : '')selected @endif>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border border-top-0 text-right">
                    	<a href="{{ route('produk-simpanan.index') }}"  class="btn btn-danger" >{{ __('Kembali') }}</a>
                        @if (!isset($viewMode))
                        <button type="submit" class="btn btn-primary">{{ !empty($produk_simpanan->id) ? __('Perbaharui') : __('Kirim') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
    <script>


    $(document).ready(function () {

        @if (isset($viewMode))
        $('input').attr('readonly', 'readonly');
        $('.form-control').attr('disabled', 'disabled');
        $('input[type=checkbox]').attr('disabled', 'disabled');
        $('.form-select').select2({
            disabled: true,
        });
        @endif
        $('select').select2();

        $('#storan_minimal_value').on('keyup',function(){
            $('#storan_minimal_value').mask("#,##0", {reverse: true});
            test_value = $(this).val().replace(/[^0-9]+/g, "");
            $('#storan_minimal').val(test_value)
        })
        $('#storan_selanjut_value').on('keyup',function(){
            $('#storan_selanjut_value').mask("#,##0", {reverse: true});
            test_value = $(this).val().replace(/[^0-9]+/g, "");
            $('#storan_selanjut').val(test_value)
        })
        $('#saldo_mengendap_value').on('keyup',function(){
            $('#saldo_mengendap_value').mask("#,##0", {reverse: true});
            test_value = $(this).val().replace(/[^0-9]+/g, "");
            $('#saldo_mengendap').val(test_value)
        })
        $('#penalti_value').on('keyup',function(){
            $('#penalti_value').mask("#,##0", {reverse: true});
            test_value = $(this).val().replace(/[^0-9]+/g, "");
            $('#penalti').val(test_value)
        })
        $('#biaya_admin_value').on('keyup',function(){
            $('#biaya_admin_value').mask("#,##0", {reverse: true});
            test_value = $(this).val().replace(/[^0-9]+/g, "");
            $('#biaya_admin').val(test_value)
        })
        $('#biaya_materai_value').on('keyup',function(){
            $('#biaya_materai_value').mask("#,##0", {reverse: true});
            test_value = $(this).val().replace(/[^0-9]+/g, "");
            $('#biaya_materai').val(test_value)
        })
        $('#biaya_registrasi_value').on('keyup',function(){
            $('#biaya_registrasi_value').mask("#,##0", {reverse: true});
            test_value = $(this).val().replace(/[^0-9]+/g, "");
            $('#biaya_registrasi').val(test_value)
        })
        $('#biaya_asuransi_value').on('keyup',function(){
            $('#biaya_asuransi_value').mask("#,##0", {reverse: true});
            test_value = $(this).val().replace(/[^0-9]+/g, "");
            $('#biaya_asuransi').val(test_value)
        })
        $('#biaya_penutupan_rekening_value').on('keyup',function(){
            $('#biaya_penutupan_rekening_value').mask("#,##0", {reverse: true});
            test_value = $(this).val().replace(/[^0-9]+/g, "");
            $('#biaya_penutupan_rekening').val(test_value)
        })
        $('#biaya_transfer_luar_value').on('keyup',function(){
            $('#biaya_transfer_luar_value').mask("#,##0", {reverse: true});
            test_value = $(this).val().replace(/[^0-9]+/g, "");
            $('#biaya_transfer_luar').val(test_value)
        })
        $('#pph_basil_value').on('keyup',function(){
            $('#pph_basil_value').mask("#,##0", {reverse: true});
            test_value = $(this).val().replace(/[^0-9]+/g, "");
            $('#pph_basil').val(test_value)
        })
        $('#zakat_basil_value').on('keyup',function(){
            $('#zakat_basil_value').mask("#,##0", {reverse: true});
            test_value = $(this).val().replace(/[^0-9]+/g, "");
            $('#zakat_basil').val(test_value)
        })
        $('#status_produk').on('click', function() {
            if ($(this).prop("checked") == true) {
                $('#status_value').val('1');
                $('#status_label').text('AKTIF');
                console.log("status produk : " + $('#status_value').val());

            } else if ($(this).prop("checked") == false) {
                $('#status_value').val('0');
                $('#status_label').text('TIDAK AKTIF');
                console.log("status produk : " + $('#status_value').val());
            }
        });
        $('#nisbah_koperasi_field').hide(100);
        $('#nisbah_anggota_field').hide(100);
        $('#bagi_hasil').on('click', function() {
            if ($(this).prop("checked") == true) {
                $('#status_bagi_hasil').val('1');
                $('#status_bagi_hasil_label').text('AKTIF');
                $('#nisbah_koperasi_field').show(100);
                $('#nisbah_anggota_field').show(100);
                console.log("status bagi hasil : " + $('#status_bagi_hasil').val());

            } else if ($(this).prop("checked") == false) {
                $('#status_bagi_hasil').val('0');
                $('#status_bagi_hasil_label').text('TIDAK AKTIF');
                $('#nisbah_koperasi_field').hide(100);
                $('#nisbah_anggota_field').hide(100);
                console.log("status bagi hasil : " + $('#status_bagi_hasil').val());
            }
        });

        $('#nisbah_koperasi').on('keyup',function () {

            let nisbah_koperasi = $(this).val();
            let hasil = 100 - nisbah_koperasi;
            $('#nisbah_anggota').val(hasil);

        });
    });
</script>
@endpush
