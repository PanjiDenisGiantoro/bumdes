@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Informasi Pendanaan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('daftar_pembiayaan.index') }}">{{ __('Pendanaan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('daftar_pembiayaan.index') }}">{{ __('Daftar Pendanaan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Informasi Pendanaan') }}</a>
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Informasi Pendanaan') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($daftar_pembiayaan->id) ? route('daftar_pembiayaan.update', [$daftar_pembiayaan->id]) : route('daftar_pembiayaan.store') }}"enctype="multipart/form-data">

                    @if (!empty($daftar_pembiayaan->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="nama_anggota">{{ __('Nama Anggota') }}</label>
                                        </div>
                                        <div class="col-md-9" >
                                            <select name="nama_anggota" disabled class="form-control select2" data-placeholder="{{ __('Pilih Nama Anggota') }}"id="nama_anggota">
                                                <option value="">{{ __('Pilih Nama Anggota') }}</option>
                                                @foreach ($anggota as $id => $name)
                                                    <option value="{{$id}}"@if($id == $daftar_pembiayaan->id_anggota)selected @endif>{{$name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="hasil_pengajuan">{{ __('Hasil Pengajuan') }}<span class="text-danger">*</span></label>

                                        </div>
                                        <div class="col-md-4">
                                            <select name="hasil_pengajuan" disabled id="hasil_pengajuan" class="form-control" disabled>
                                                <option value=""></option>
                                                <option value="tertunda"@if($daftar_pembiayaan->hasil_pengajuan == 'tertunda' ?? '') selected @endif>Tertunda</option>
                                                <option value="ditolak"@if($daftar_pembiayaan->hasil_pengajuan == 'ditolak' ?? '') selected @endif>Ditolak</option>
                                                <option value="diterima"@if($daftar_pembiayaan->hasil_pengajuan == 'diterima' ?? '') selected @endif>Diterima</option>
                                            </select>
                                            @error('hasil_pengajuan')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="tanggal_disetujui">{{ __('Tanggal Disetujui') }}<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                disabled
                                                value="{{$daftar_pembiayaan->tanggal_disetujui ?? ''}}"
                                                id="tanggal_disetujui"
                                                name="tanggal_disetujui"
                                                type="date"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('tanggal_disetujui')])
                                            />
                                            @error('tanggal_disetujui')
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
                                            <label class="control-label form-label" for="no_rekening">{{ __('No Rekening') }}<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                disabled
                                                value="{{$daftar_pembiayaan->no_rekening ?? ''}}"

                                                id="no_rekening"
                                                name="no_rekening"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('no_rekening')])
                                            />
                                            @error('norekening')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="plafon_disetujui">{{ __('Plafon Disetujui') }}<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                disabled
                                                value="{{number_format($daftar_pembiayaan->plafon_disetujui) ?? ''}}"
                                                id="plafon_disetujui"
                                                name="plafon_disetujui"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('plafon_disetujui')])
                                            />
                                            @error('plafon_disetujui')
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
                                            <label class="control-label form-label" for="dana_peyaluran">{{ __('Penyaluran Dana') }}<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-4">

                                            <select name="dana_peyaluran" id="dana_peyaluran" class="form-control"disabled>
                                                <option></option>
                                                @foreach($sumber_pendanaan as $sumber)
                                                    <option value="{{$sumber->id}}"@if($daftar_pembiayaan->dana_peyaluran == $sumber->id)selected @endif>{{$sumber->nama_sumber_pendanaan}}</option>
                                                @endforeach
                                            </select>

                                            @error('dana_peyaluran')
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
                                            <label class="control-label form-label" for="jangka_waktu">{{ __('Jangka Waktu') }}<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                value="{{$daftar_pembiayaan->jangka_waktu ?? ''}}"
                                                disabled
                                                id="jangka_waktu"
                                                name="jangka_waktu"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('jangka_waktu')])
                                            />

                                            @error('jangka_waktu')
                                            <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-1">
                                            <span>Bulan</span>

                                        </div>

                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="tanggal_jatuh_tempo">{{ __('Tanggal Jatuh Tempo') }}<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                value="{{$daftar_pembiayaan->tanggal_jatuh_tempo ?? ''}}"
                                                disabled
                                                id="tanggal_jatuh_tempo"
                                                name="tanggal_jatuh_tempo"
                                                type="date"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('tanggal_jatuh_tempo')])
                                            />

                                            @error('tanggal_jatuh_tempo')
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
                                            <label class="control-label form-label" for="angsuran_perbulan">{{ __('Angsuran Perbulan') }}<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                value="{{number_format($daftar_pembiayaan->angsuran_perbulan) ?? ''}}"
                                                disabled
                                                id="angsuran_perbulan"
                                                name="angsuran_perbulan"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('angsuran_perbulan')])
                                            />
                                            @error('angsuran_perbulan')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="tanggal_mulai_angsuran">{{ __('Tanggal Mulai Angsuran') }}<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                value="{{$daftar_pembiayaan->tanggal_mulai_angsuran ?? ''}}"
                                                disabled
                                                id="tanggal_mulai_angsuran"
                                                name="tanggal_mulai_angsuran"
                                                type="date"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('tanggal_mulai_angsuran')])
                                            />
                                            @error('tanggal_mulai_angsuran')
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
                        <!-- <h3 class="card-title">{{ __('Bukti')}}</h3>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="alamat">{{ __('Bukti Pembelian Barang') }}</label>

                                    <img id="gambar5" width="250" height="200"src="{{ asset('storage/' . ($bukti[0] ?? '')) }}">
                                </div>

                                <div class="col-md-1"></div>
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="alamat">{{ __('Analisa Keuangan') }}</label>

                                    <img id="gambar6" width="250" height="200"src="{{ asset('storage/' . ($buktianalisa[0] ?? '')) }}">
                                </div>
                            </div>
                        </div>
                        <br> -->
                        <h3 class="card-title">{{ __('Catatan Profil')}}</h3>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="lama_usaha">{{ __('Lama Usaha') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        value="{{$daftar_pembiayaan->lama_usaha ?? ''}}"
                                        disabled
                                        id="lama_usaha"
                                        name="lama_usaha"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('lama_usaha')])
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
                                    <label class="control-label form-label" for="usaha">{{ __('Pengelola') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <select name="pengelola" id="pengelola" class="form-control"disabled>
                                        <option value="sendiri"@if($daftar_pembiayaan->pengelola ?? '' == 'sendiri') selected @endif>Sendiri</option>
                                        <option value="karyawan"@if($daftar_pembiayaan->pengelola ?? ''== 'karyawan') selected @endif>Karyawan</option>
                                    </select>
                                    @error('pengelola')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <input type="text" value="BARU" name="status" hidden>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="usaha">{{ __('Usaha') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <select name="usaha" id="usaha" class="form-control"disabled>
                                        <option value="pokok"@if($daftar_pembiayaan->usaha ?? '' == 'pokok') selected @endif>Pokok</option>
                                        <option value="sampingan"@if($daftar_pembiayaan->usaha ?? '' == 'sampingan') selected @endif>Sampingan</option>
                                        <option value="pokoksampingan"@if($daftar_pembiayaan->usaha ?? '' == 'pokoksampingan') selected @endif>Pokok dan Sampingan</option>
                                    </select>
                                    @error('usaha')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="control-label form-label" for="lingkungan">{{ __('Lingkungan') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <select name="lingkungan" id="lingkungan" class="form-control"disabled>
                                        <option value="padat"@if($daftar_pembiayaan->lingkungan == 'padat') selected @endif>Padat</option>
                                        <option value="cluster"@if($daftar_pembiayaan->lingkungan == 'cluster') selected @endif>Cluster</option>
                                        <option value="tidakpadat"@if($daftar_pembiayaan->lingkungan == 'tidakpadat') selected @endif>Tidak Padat</option>
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
                                    <label class="control-label form-label" for="omset_harian">{{ __('Omset Harian') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        disabled
                                        value="{{number_format($daftar_pembiayaan->omset_harian) ?? ''}}"
                                        id="omset_harian"
                                        name="omset_harian"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('omset')])

                                    />
                                    @error('omset')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="control-label form-label" for="pengeluaran">{{ __('Pengeluaran') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        value="{{number_format($daftar_pembiayaan->pengeluaran) ?? ''}}"
                                        disabled
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
                                    <textarea type="text" name="" id="" cols="10" rows="5"disabled class="form-control">{{$daftar_pembiayaan->catatan ?? ''}}
                                    </textarea>
                                    @error('catatan')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>


                            </div>
                        </div>

                        <h3 class="card-title">{{ __('Informasi Pemohon')}}</h3>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="email">{{ __('Email') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <input
                                        value="{{$daftar_pembiayaan->anggota->email ?? ''}}"
                                        disabled
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
                                        disabled
                                        value="{{$daftar_pembiayaan->anggota->no_kk ?? ''}}"

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
                                        disabled
                                        value="{{$daftar_pembiayaan->anggota->tanggal_lahir ?? ''}}"

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
                                        disabled
                                        value="{{$daftar_pembiayaan->anggota->tempat_lahir ?? ''}}"

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
                                        disabled
                                        value="{{$daftar_pembiayaan->anggota->jenis_kelamin ?? ''}}"

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
                                        disabled
                                        value="{{$daftar_pembiayaan->anggota->status_perkawinan ?? ''}}"

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
                                        value="{{$id_anggota->kodependidikan->pendidikan ?? ''}}"
                                        disabled
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
                                    <label class="control-label form-label" for="pekerjaan">{{ __('pekerjaan') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        disabled
                                        value="{{$daftar_pembiayaan->anggota->pekerjaan ?? ''}}"

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
                                        disabled
                                        value="{{$daftar_pembiayaan->anggota->nama_jalan ?? ''}}"

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
                                        disabled
                                        value="{{$daftar_pembiayaan->anggota->no_rumah ?? ''}}"

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
                                        value="{{$daftar_pembiayaan->anggota->rtrw ?? ''}}"

                                        disabled
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
                                        disabled
                                        value="{{$id_anggota->province->name ?? ''}}"

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
                                        value="{{$id_anggota->regencies->name ?? ''}}"

                                        disabled
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
                                        disabled
                                        value="{{$id_anggota->districts->name ?? ''}}"
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

                                    <input type="text" class="form-control" id="desa" value="{{$id_anggota->villages->name ?? ''}}"
                                           disabled>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="kota">{{ __('Kode Pos') }}</label>
                                </div>
                                <div class="col-md-3">

                                    <input type="text" class="form-control" id="kode_pos"  value="{{$id_anggota->kode_pos ?? ''}}"
                                           disabled>
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
                                    <input type="text" class="form-control" disabled id="bumdes"  value="{{$daftar_pembiayaan->anggota->bumdes ?? ''}}">
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
                                        value="{{$daftar_pembiayaan->anggota->no_hp ?? ''}}"
                                        class="form-control"
                                        id="no_hp"
                                        type="text"
                                        disabled
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
                                        disabled
                                        class="form-control"
                                        value="{{$daftar_pembiayaan->anggota->no_telpon ?? ''}}"

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
                                        value="{{$id_anggota->statuskeluarga->status_dalam_keluarga ?? ''}}"

                                        disabled
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
                                        value="{{$daftar_pembiayaan->anggota->nama_ibu ?? ''}}"

                                        disabled
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
                                        value="{{$id_anggota->namasehubungkeluarga ?? ''}}"
                                        disabled
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
                                        value="{{$daftar_pembiayaan->anggota->no_telp_keluarga ?? ''}}"

                                        id="no_telp_keluarga"
                                        type="text"
                                        disabled
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
                                        value="{{$id_anggota->nama_kerabat ?? ''}}"

                                        disabled
                                        id="namasehubungkeluarga"
                                        type="text"
                                    />
                                    @error('kode_pos')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="">{{ __('No. Telepon') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        value="{{$daftar_pembiayaan->anggota->no_telp_keluarga ?? ''}}"

                                        id=""
                                        name=""
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('')])
                                    value="{{ old('') }}"
                                    disabled
                                    />
                                    @error('')
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
                                        <img id="file1" width="250" height="200"src="{{ asset('storage/' . ($file_foto[0] ?? '')) }}">
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-4">
                                        <img id="file2" width="250" height="200" src="{{ asset('storage/' . ($file_ktp[0] ?? '')) }}">
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
                                            value="{{$daftar_pembiayaan->daftarwarung->nama_warung ?? ''}}"
                                            id="nama_warung"
                                            type="text"
                                            disabled
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
                                            value="{{$daftar_pembiayaan->daftarwarung->nama_jalan ?? ''}}"

                                            disabled
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
                                            value="{{$daftar_pembiayaan->daftarwarung->no_rumah ?? ''}}"

                                            disabled
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
                                            value="{{$daftar_pembiayaan->daftarwarung->rtrw ?? ''}}"

                                            disabled
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
                                            value="{{$warung->province->name ?? ''}}"

                                            disabled
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
                                            value="{{$warung->regencies->name ?? ''}}"

                                            disabled
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
                                            value="{{$warung->districts->name ?? ''}}"

                                            disabled
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

                                        <input type="text" class="form-control" id="desa1" value="{{$warung->villages->name ?? ''}}"

                                               disabled>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label form-label" for="kota">{{ __('Kode Pos') }}</label>
                                    </div>
                                    <div class="col-md-3">

                                        <input type="text" class="form-control" id="kode_pos12" value="{{$warung->kodepos ?? ''}}"
                                               disabled>
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
                                                    disabled
                                                    id="profil_warung"
                                                    rows="5"
                                                    class="form-control"

                                                >{{$warung->profil_warung ?? ''}}
</textarea>
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
                                            disabled
                                            value="{{$warung->bidangusaha->bidang_usaha ?? ''}}"

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
                                            disabled
                                            value="{{$daftar_pembiayaan->daftarwarung->berdiri_sejak ?? ''}}"

                                            id="berdiri_sejak"
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

                                    <img id="gambar1" width="250" height="200"src="{{ asset('storage/' . ($file_warung[0] ?? '')) }}">
                                </div>

                                <div class="col-md-3">
                                    <label class="control-label form-label" for="alamat">{{ __('Foto Gambar Warung 2') }}</label>

                                    <img id="gambar2" width="250" height="200"src="{{ asset('storage/' . ($file_warung1[0] ?? '')) }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="alamat">{{ __('Foto Gambar Warung 3') }}</label>

                                    <img id="gambar3" width="250" height="200"src="{{ asset('storage/' . ($file_warung2[0] ?? '')) }}">
                                </div>

                                <div class="col-md-3">
                                    <label class="control-label form-label" for="alamat">{{ __('Foto Gambar Warung 4') }}</label>

                                    <img id="gambar4" width="250" height="200"src="{{ asset('storage/' . ($file_warung3[0] ?? '')) }}">
                                </div>
                            </div>

                        </div>
                        <br>




                        <div class="card-footer border border-top-0 text-right">
                            <a href="{{ route('daftar_pembiayaan.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Kembali') }}</a>
                            {{--                            <button type="submit" class="btn btn-primary">{{ !empty($anggota->id) ? __('Perbaharui') : __('Simpan') }}</button>--}}
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

    <script>
        function showPreview(event){
            if(event.target.files.length > 0){
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }
        function showPreview1(event){
            if(event.target.files.length > 0){
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview1");
                preview.src = src;
                preview.style.display = "block";
            }
        }
        $(document).ready(function() {
            $('#nama_anggota').on('change', function () {
                var countryID = $(this).val();
                if(countryID){
                    $.ajax({
                        type:"GET",
                        url: "{{route('getdatapembiayaan')}}?country_id=" + countryID,
                        success:function(res){
                            console.log(res['pendidikan']);
                            if(res){
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
                                $("#namasehubungankeluarga").empty();
                                $("#nama_kerabat").empty();
                                $("#no_telp_keluarga").empty();
                                $("#no_telp").empty();
                                $("#nama_warung").empty();
                                $("#profil_warung").empty();
                                $("#bidang_usaha").empty();
                                $("#berdiri_sejak").empty();
                                $.each(res,function(key,value){
                                    $("#nik").val(res.result.anggota.nik);
                                    $("#no_mitra").val(res.result.anggota.no_mitra);
                                    $("#email").val(res.result.anggota.email);
                                    $("#no_kk").val(res.result.anggota.no_kk);
                                    $("#tanggal_lahir").val(res.result.anggota.tanggal_lahir);
                                    $("#tempat_lahir").val(res.result.anggota.tempat_lahir);
                                    $("#jenis_kelamin").val(res.result.anggota.jenis_kelamin);
                                    $("#status_perkawinan").val(res.result.anggota.status_perkawinan);
                                    $("#pekerjaan").val(res.result.anggota.pekerjaan);
                                    $("#nama_jalan").val(res.result.anggota.nama_jalan);
                                    $("#no_rumah").val(res.result.anggota.no_rumah);
                                    $("#rtrw").val(res.result.anggota.rtrw);
                                    $("#provinsi").val(res.result.anggota.provinsi);
                                    $("#kota").val(res.result.anggota.kota);
                                    $("#kecamatan").val(res.result.anggota.kecamatan);
                                    $("#desa").val(res.result.anggota.desa);
                                    $("#kode_pos").val(res.result.anggota.kode_pos);
                                    $("#bumdes").val(res.result.anggota.bumdes);
                                    $("#no_hp").val(res.result.anggota.no_hp);
                                    $("#status_keluarga").val(res.result.anggota.status_keluarga);
                                    $("#nama_ibu").val(res.result.anggota.nama_ibu);
                                    $("#nama_kerabat").val(res.result.anggota.nama_kerabat);
                                    $("#pendidikan").val(res['pendidikan']);
                                    $("#no_telp_keluarga").val(res.result.anggota.no_telp_keluarga);
                                    $("#no_telp").val(res.result.anggota.no_telpon);
                                    $("#namasehubungankeluarga").val(res.result.anggota.namasehubungankeluarga);
                                    $("#nama_warung").val(res.result.nama_warung);
                                    $("#profil_warung").val(res.result.profil_warung);
                                    $("#bidang_usaha").val(res.result.bidang_usaha);
                                    $("#berdiri_sejak").val(res.result.berdiri_sejak);

                                    $('#file1').attr("src","{{asset('storage')}}"+"/"+res.gambar1);
                                    $('#file2').attr("src","{{asset('storage')}}"+"/"+res.gambar);
                                    $('#gambar1').attr("src","{{asset('storage')}}"+"/"+res.warung1);
                                    $('#gambar2').attr("src","{{asset('storage')}}"+"/"+res.warung2);
                                    $('#gambar3').attr("src","{{asset('storage')}}"+"/"+res.warung3);
                                    $('#gambar4').attr("src","{{asset('storage')}}"+"/"+res.warung4);
                                });

                            }else{
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
                                $("#nama_kerabat").empty();
                                $("#no_telp_keluarga").empty();
                                $("#pendidikan").empty();
                                $("#namasehubungankeluarga").empty();
                                $("#no_telp").empty();
                                $("#nama_warung").empty();
                                $("#profil_warung").empty();
                                $("#bidang_usaha").empty();
                                $("#berdiri_sejak").empty();
                            }
                        }
                    });
                }else{
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
                    $("#nama_kerabat").empty();
                    $("#no_telp_keluarga").empty();
                    $("#pendidikan").empty();
                    $("#namasehubungankeluarga").empty();
                    $("#no_telp").empty();
                    $("#nama_warung").empty();
                    $("#profil_warung").empty();
                    $("#bidang_usaha").empty();
                    $("#berdiri_sejak").empty();
                }
            });

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
