@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Akad') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Akad') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('akad.index') }}">{{ __('Akad') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Akad') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Akad') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($akad->id) ? route('akad.update', [$akad->id]) : route('akad.store') }}">

                    @if (!empty($akad->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="">{{ __('Jenis Akad') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select id="jenis_akad" name="jenis_akad" type="text" class="form-control select2" data-allow-clear="true" data-placeholder="jenis akad..."
                                                value="{{!empty($akad->jenis_akad) ? $akad->jenis_akad : ''}}">
                                                <option value="">&nbsp;</option>
                                                <option value="ijarah" {{ !empty($akad->jenis_akad) && $akad->jenis_akad == 'ijarah' ? 'selected' : '' }}>Ijarah</option>
                                                <option value="mudharabah"  {{ !empty($akad->jenis_akad) && $akad->jenis_akad == 'mudharabah' ? 'selected' : '' }}>Mudharabah</option>
                                                <option value="murabahah"  {{ !empty($akad->jenis_akad) && $akad->jenis_akad == 'murabahah' ? 'selected' : '' }}>Murabahah</option>
                                                <option value="musyarakah"  {{ !empty($akad->jenis_akad) && $akad->jenis_akad == 'musyarakah' ? 'selected' : '' }}>Musyarakah</option>
                                                <option value="qard"  {{ !empty($akad->jenis_akad) && $akad->jenis_akad == 'qard' ? 'selected' : '' }}>Qard</option>
                                                <option value="wadiah"  {{ !empty($akad->jenis_akad) && $akad->jenis_akad == 'wadiah' ? 'selected' : '' }}>Wadiah</option>

                                                <!-- <option value="imbt"  {{ !empty($akad->jenis_akad) && $akad->jenis_akad == 'imbt' ? 'selected' : '' }}>IMBT</option> -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="">{{ __('Nama Akad') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                                value="{{!empty($akad->nama_akad) ? $akad->nama_akad : ''}}"
                                                id="nama_akad"
                                                name="nama_akad"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_akad')])
                                                value="{{ old('nama_akad') }}"
                                            />
                                            @error('nama_akad')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="">{{ __('Akun Rekening') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select id="tipe_akad" name="tipe_akad" type="text" class="form-control select2" data-allow-clear="true" data-placeholder="Akun Rekening..."
                                                    value="{{!empty($akad->tipe_akad) ? $akad->tipe_akad : ''}}">
                                                <option value="">&nbsp;</option>
                                                <option value="simpanan"  {{ !empty($akad->tipe_akad) && $akad->tipe_akad == 'simpanan' ? 'selected' : '' }}>Simpanan</option>
                                                <option value="simpanan_berjangka"  {{ !empty($akad->tipe_akad) && $akad->tipe_akad == 'simpanan_berjangka' ? 'selected' : '' }}>Simpanan Berjangka</option>
                                                <option value="pembiayaan"  {{ !empty($akad->tipe_akad) && $akad->tipe_akad == 'pembiayaan' ? 'selected' : '' }}>Pembiayaan</option>
                                            </select>
                                            @error('tipe_akad')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border border-top-0 text-right">
                        <a href="{{ route('akad.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($akad->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($akad->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
<script>
    $(document).ready(function(){
        $('select').select2();
    });


</script>
@endpush
