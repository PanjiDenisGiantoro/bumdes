@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Informasi Biaya') }}">

        <li class="breadcrumb-item">
            <a href="{{ route('biaya.index') }}">{{ __('Biaya') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Biaya') }}</a>
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Biaya') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ route('biaya.store') }}">

                    @csrf

                    <div class="card-body">
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="anggota_id">Nama Anggota</label>
                                </div>
                                <div class="col-md-3">
                                    <select name="anggota_id" id="anggota_id" class="form-control select2">
                                            <option value="">Pilih Anggota</option>
                                        @foreach($anggota as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_pemohon }}</option>
                                        @endforeach
                                    </select>
                                    @error('date')
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
                                    <label class="control-label form-label" for="date">Tanggal Transaksi</label>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        id="date"
                                        name="date"
                                        type="date"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('date')])
                                        value="{{ old('date', $jurnal_keuangan->date ?? date('Y-m-d')) }}"
                                    />
                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="jenis_transaksi">Jenis Pembayaran</label>
                                </div>
                                <div class="col-md-4">
                                    <select name="jenis_transaksi" id="jenis_transaksi" class="form-control">
                                        <option value="">Pilih</option>
                                        <option data-biaya="1" value="{{$pemetaan->biaya_tunai}}" @if(!empty($jenis_transaksi->jenis_transaksi) ? $jenis_transaksi->jenis_transaksi == $pemetaan->biaya_tunai : '')selected @endif >Tunai</option>
                                        <option data-biaya="2" value="{{$pemetaan->biaya_non_tunai}}" @if(!empty($jenis_transaksi->jenis_transaksi) ? $jenis_transaksi->jenis_transaksi == $pemetaan->biaya_non_tunai : '')selected @endif>Non Tunai</option>
                                    </select>

                                </div>

                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="row">
                            <div class="col-md-3">
                                <label class="control-label form-label" for="nominal">{{ __('Nominal') }}</label>
                            </div>
                            <div class="col-md-3">
                                @if(!empty($jurnal_keuangan))

                                <input type="text" name="nominal" class="form-control" value="{{ old('nominal',number_format($jurnal_keuangan->nominal) ?? null) }}">
                                @else
                                    <input
                                        id="nominal"
                                        name="nominal"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('nominal')])
                                        autocomplete="off"
                                        required
                                        data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'"
                                        value="{{ old('nominal') }}"
                                    />

                                    @endif
                                @error('dibayar_dari')
                                <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                @enderror
                            </div>

                                <div class="col-md-1">
                                    <label class="control-label form-label" for="journal_no">{{ __('No Biaya') }}</label>
                                </div>
                                <div class="col-md-2">
                                    <input
                                        readonly
                                        id="journal_no"
                                        name="journal_no"
                                        type="text"
                                        min="1"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('journal_no')])
                                        value="{{ old('journal_no', $jurnal_keuangan->journal_no ?? null) }}"
                                        placeholder="BN-{{ str_pad(($last->journal_no ?? 0) + 1, 4, 0, STR_PAD_LEFT) }}"
                                    />
                                    @error('journal_no')
                                    <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-1">
                                    <label class="control-label form-label" for="reference">{{ __('No Ref') }}</label>
                                </div>
                                <div class="col-md-2">
                                    <input
                                        id="reference"
                                        name="reference"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('reference')])
                                        value="{{ old('reference', $jurnal_keuangan->reference ?? null) }}"
                                    />
                                    @error('reference')
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
                                    <label class="control-label form-label" for="akun">{{ __('GL') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <select name="akun" id="akun" class="form-control select2">
                                        <option>Pilih</option>
                                        @foreach($akun as $akuns)
                                            <option value="{{$akuns->id}}"@if(!empty($jurnal_keuangan->id) ? $akuns->id == $jurnal_keuangan->akun : '' )selected @endif>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $akuns->depth) !!}{{ $akuns->kode }} &mdash; {{ $akuns->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('akun')
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
                                    <label class="control-label form-label" for="description">{{ __('Keterangan') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <textarea
                                        id="description"
                                        name="description"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('description')])
                                        rows="5"
                                        required
                                    >{{ old('description', $jurnal_keuangan->description ?? null) }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="card-footer border-0 text-right">
                    	<a href="{{ route('jurnal_keuangan.index') }}" class="btn btn-primary" style="background-color: red">
                            {{ !isset($readOnly) ? __('Batal') : __('Kembali') }}
                        </a>
                        @if (!isset($readOnly))
                            <button type="submit" class="btn btn-primary">{{ !empty($anggota->id) ? __('Perbaharui') : __('Kirim') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
.row-container tr.idx:first-child button.btn-remove {
    display: none;
}
</style>
@endpush

@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7-beta.19/jquery.inputmask.min.js"></script>
<script>
@if (isset($readOnly) == 'true')
calculateTotal();
$('input,select,textarea').attr('readonly', true);
@endif
$('#bayar_value').val('0');
$(':input').inputmask();
$('#anggota_id').select2();


// $('#bayar').on('click', function () {
//     if ($(this).prop("checked") == true) {
//         $('#bayar_value').val('1');
//     } else if ($(this).prop("checked") == false) {
//         $('#bayar_value').val('0');
//     }
// });



    // $('#jenis_transaksi').on('change', function() {
        // console.log($('#jenis_transaksi').attr('data-biaya'));
        // if ($(this).attr('data-biaya').val() == 1) {
        //     $('#bayar_value').val('1');
        //     $('#termin_label').show(200);
        //     $('#termin').show(200);
        //     $('#jatuh_label').show(200);
        //     $('#jatuh_tempo').show(200);
        // } else if ($(this).prop("checked") == false) {
        //     $('#bayar_value').val('0');
        //
        //     $('#termin_label').hide(200);
        //     $('#termin').hide(200);
        //     $('#jatuh_label').hide(200);
        //     $('#jatuh_tempo').hide(200);
        // }
// });
</script>
@endpush
