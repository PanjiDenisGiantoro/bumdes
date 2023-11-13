@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Daftar Produk') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('produk-simpanan.index') }}">{{ __('Daftar Produk') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Daftar Produk Pembiayaan') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Register Produk Pembiayaan') }}</h5>

                <form id="pemb_form" name="pemb_form" autocomplete="off" method="POST" class="form-horizontal" action="{{ !empty($produk_pembiayaan->id) ? route('produk-pembiayaan.update', [$produk_pembiayaan->id]) : route('produk-pembiayaan.store') }}">

                    @if (!empty($produk_pembiayaan->id))
                        @method('PUT')
                    @endif

                    @csrf


                    <input type="hidden" id="status_value" name="status" value="{{ !empty($produk_pembiayaan->id) ? $produk_pembiayaan->status : 1 }}">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                	<div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="akad_pembiayaan">{{ __('Akad') }}</label>
                                            <select id="akad_pembiayaan" name="akad_pembiayaan" class="form-control select2" data-allow-clear="true" data-placeholder="Pilih akad..." data-minimum-results-for-search="Infinity">
                                                <option value=""></option>
                                                @foreach($akadList as $akad)
                                                    <option value="{{$akad->id}}" data-type="{{ $akad->jenis_akad }}" @if(!empty($produk_pembiayaan->id) ? $produk_pembiayaan->akad_pembiayaan == $akad->id : '')selected @endif>{{$akad->nama_akad}}</option>
                                                @endforeach
                                                <!-- <option value="mudharabah">Mudharabah</option>
                                                <option value="murabahah">Murabahah</option>
                                                <option value="musyarakah">Musyarakah</option>
                                                <option value="ijarah">Ijarah</option>
                                                <option value="imbt">IMBT</option>
                                                <option value="qard">Qard</option> -->
                                            </select>
                                        </div>
						           </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="kode_pembiayaan">{{ __('Kode Pembiayaan') }}</label>
                                            <input class="form-control input_field" id="kode_pembiayaan" name="kode_pembiayaan" type="text" placeholder="0012"
                                                value="{{ old('kode_pembiayaan', $produk_pembiayaan->kode_pembiayaan ?? '') }}" required>
                                        </div>
                                        <div class="col-md-9">
                                            <label class="control-label form-label" for="nama_pembiayaan">{{ __('Nama Pembiayaan') }}</label>
                                            <input class="form-control input_field" id="nama_pembiayaan" name="nama_pembiayaan" type="text" placeholder="Pembiayaan usaha.."
                                                value="{{ old('nama_pembiayaan', $produk_pembiayaan->nama_pembiayaan ?? '') }}" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="control-label form-label" for="minimal_pembiayaan">{{ __('Minimal Pembiayaan') }}</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input class="form-control nominal input_field" id="minimal_pembiayaan" name="minimal_pembiayaan" type="text" style="text-align: left"
                                                    value="{{ old('minimal_pembiayaan', $produk_pembiayaan->minimal_pembiayaan ?? '') }}" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label form-label" for="maksimal_pembiayaan">{{ __('Maksimal Pembiayaan') }}</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input class="form-control nominal input_field" id="maksimal_pembiayaan" name="maksimal_pembiayaan" type="text" style="text-align: left"
                                                    value="{{ old('maksimal_pembiayaan', $produk_pembiayaan->maksimal_pembiayaan ?? '') }}" required/>
                                            </div>
                                        </div>

                                        <div class="col-md-4 interest_field">
                                            <label class="control-label form-label" id="interest_label" for="interest">{{ __('Margin') }}</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                <input class="form-control input_field" id="interest" name="interest" type="text"  style="text-align: left"
                                                    value="{{ old('interest', $produk_pembiayaan->interest ?? '') }}" required/>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-4">
                                            <label class="control-label form-label" for="denda_keterlambatan">{{ __('Denda Keterlambatan') }}</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input class="form-control" id="denda_keterlambatan" name="denda_keterlambatan" type="text"  style="text-align: left"
                                                    value="{{ old('denda_keterlambatan', $produk_pembiayaan->denda_keterlambatan ?? '') }}"/>
                                            </div>
                                        </div> -->
                                        <div class="col-md-2 nisbah_field" style="display: none">
                                            <label class="control-label form-label" for="nisbah_anggota">{{ __('Nisbah Anggota') }}</label>
                                            <input class="form-control input_field" id="nisbah_anggota" name="nisbah_anggota" type="text" style="text-align: left"
                                                value="{{ old('nisbah_anggota', $produk_pembiayaan->nisbah_anggota ?? '') }}" value="0" required/>
                                        </div>
                                        <div class="col-md-2 nisbah_field" style="display: none">
                                            <label class="control-label form-label" for="nisbah_koperasi">{{ __('Nisbah Koperasi') }}</label>
                                            <input class="form-control input_field" id="nisbah_koperasi" name="nisbah_koperasi" type="text" style="text-align: left"
                                                value="{{ old('nisbah_koperasi', $produk_pembiayaan->nisbah_koperasi ?? '') }}" value="0" readonly/>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <h3 class="card-title">Informasi Lain -lain</h3>
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-label">Status Produk</div>
                                            <label class="custom-switch">
                                                <input type="checkbox" id="status_produk" class="custom-switch-input" {{ !empty($produk_pembiayaan) ? ($produk_pembiayaan->status == 1 ? 'checked' : 'unchecked') : 'checked' }}>
                                                <span class="custom-switch-indicator"></span>
                                                <span id="status_label" class="custom-switch-description">{{ !empty($produk_pembiayaan) ? ($produk_pembiayaan->status == 1 ? 'AKTIF' : 'TIDAK AKTIF') : 'AKTIF' }}</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <h3 class="card-title">Informasi Biaya Pembiayaan</h3>
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="control-label form-label" for="biaya_admin">{{ __('Biaya Admin') }}</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input class="form-control input_field" id="biaya_admin" name="biaya_admin" type="text" style="text-align: right"
                                                    value="{{ old('biaya_admin', $produk_pembiayaan->biaya_admin ?? '') }}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="form-label">GL</label>
                                                <select  class="form-control select2"  id="GL_biaya_admin" name="GL_biaya_admin" data-placeholder="GL.." data-allow-clear="true">
                                                    <option value="">&nbsp;</option>
                                                    @foreach($GLList as $gl)
                                                        <option value="{{$gl->id}}"@if(!empty($produk_pembiayaan->GL_biaya_admin) ? $produk_pembiayaan->GL_biaya_admin == $gl->id : '')selected @endif>{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                    @endforeach
                                                </select>
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
                                                <input class="form-control input_field" id="biaya_materai" name="biaya_materai" type="text" style="text-align: right"
                                                    value="{{ old('biaya_materai', $produk_pembiayaan->biaya_materai ?? '') }}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="form-label">GL</label>
                                            <select class="form-control select2" id="GL_biaya_materai" name="GL_biaya_materai" data-placeholder="GL.." data-allow-clear="true">
                                                <option value="">&nbsp;</option>
                                                @foreach($GLList as $gl)
                                                    <option value="{{$gl->id}}"@if(!empty($produk_pembiayaan->GL_biaya_materai) ? $produk_pembiayaan->GL_biaya_materai == $gl->id : '')selected @endif>{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="control-label form-label" for="biaya_asuransi">{{ __('Biaya Asuransi') }}</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input class="form-control input_field" id="biaya_asuransi" name="biaya_asuransi" type="text" style="text-align: right"
                                                    value="{{ old('biaya_asuransi', $produk_pembiayaan->biaya_asuransi ?? '') }}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="form-label">GL</label>
                                                <div class="form-control-select">
                                                    <select class="form-control" id="GL_biaya_asuransi" name="GL_biaya_asuransi" data-placeholder="GL.." data-allow-clear="true">
                                                    <option value="">&nbsp;</option>
                                                    @foreach($GLList as $gl)
                                                        <option value="{{$gl->id}}"@if(!empty($produk_pembiayaan->GL_biaya_asuransi) ? $produk_pembiayaan->GL_biaya_asuransi == $gl->id : '')selected @endif>{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="control-label form-label" for="biaya_lain_lain">{{ __('Biaya Lain Lain') }}</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input class="form-control input_field" id="biaya_lain_lain" name="biaya_lain_lain" type="text" style="text-align: right"
                                                    value="{{ old('biaya_lain_lain', $produk_pembiayaan->biaya_lain_lain ?? '') }}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="form-label">GL</label>
                                                <div class="form-control-select">
                                                    <select class="form-control" id="GL_biaya_lain_lain" name="GL_biaya_lain_lain" data-placeholder="GL.." data-allow-clear="true">
                                                        <option value="">&nbsp;</option>
                                                        @foreach($GLList as $gl)
                                                            <option value="{{$gl->id}}"@if(!empty($produk_pembiayaan->GL_biaya_penutupan_rekening) ? $produk_pembiayaan->GL_biaya_penutupan_rekening == $gl->id : '')selected @endif>{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                        @endforeach
                                                    </select>
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
                                                <label class="form-label">GL Produk Pembiayaan</label>
                                                <div class="form-control-select select2">
                                                    <select class="form-control" id="GL_produk_pembiayaan" name="GL_produk_pembiayaan"  data-placeholder="GL.." data-allow-clear="true" required>
                                                        <option value="">&nbsp;</option>
                                                        @foreach($GLList as $gl)
                                                            <option value="{{$gl->id}}"@if(!empty($produk_pembiayaan->GL_produk_pembiayaan) ? $produk_pembiayaan->GL_produk_pembiayaan == $gl->id : '')selected @endif>{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">GL Pend. Margin/Basil/Bonus</label>
                                                <div class="form-control-select select2" >
                                                    <select class="form-control" id="GL_basil" name="GL_basil" data-placeholder="GL.." data-allow-clear="true" required>
                                                        <option value="">&nbsp;</option>
                                                        @foreach($GLList as $gl)
                                                            <option value="{{$gl->id}}"@if(!empty($produk_pembiayaan->GL_basil) ? $produk_pembiayaan->GL_basil == $gl->id : '')selected @endif>{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row gl_ditangguhkan_field">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">GL Pend. Ditangguhkan</label>
                                                <div class="form-control-select" >
                                                    <select class="form-control select2" id="GL_ditangguhkan" name="GL_ditangguhkan" data-placeholder="GL.." data-allow-clear="true" required>
                                                        <option value="">&nbsp;</option>
                                                        @foreach($GLList as $gl)
                                                            <option value="{{$gl->id}}"@if(!empty($produk_pembiayaan->GL_ditangguhkan) ? $produk_pembiayaan->GL_ditangguhkan == $gl->id : '')selected @endif>{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">GL Infaq Denda</label>
                                                <div class="form-control-select" >
                                                    <select class="form-control select2" id="GL_infaq_denda" name="GL_infaq_denda" >
                                                        <option value="">&nbsp;</option>
                                                        @foreach($GLList as $gl)
                                                            <option value="{{$gl->id}}"@if(!empty($produk_pembiayaan->GL_infaq_denda) ? $produk_pembiayaan->GL_infaq_denda == $gl->id : '')selected @endif>{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border border-top-0 text-right">
                    	<a href="{{ route('produk-simpanan.index', ['pembiayaan']) }}"  class="btn btn-danger" >{{ __('Kembali') }}</a>
                        @if (!isset($viewMode))
                        <button type="submit" class="btn btn-primary">{{ !empty($produk_pembiayaan->id) ? __('Perbaharui') : __('Kirim') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7-beta.19/jquery.inputmask.min.js"></script>
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<script>

    $(document).ready(function () {
        $('select').select2();

        @if (isset($viewMode))
            // $('input').attr('readonly', 'readonly');
            $('.form-control').attr('disabled', 'disabled');
            // $('.form-select').select2({
            //     disabled: true,
            // });
        $('input[type=checkbox]').attr('disabled', 'disabled');

        @endif


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

        $('#akad_pembiayaan').on('change', function() {

            var selected = $(this).find('option:selected');
            var jenisAkad = selected.data('type');

            if ('{{ empty($produk_pembiayaan->id) }}') {
                clearAllField();
            }

            if (jenisAkad == 'mudharabah' || jenisAkad == 'musyarakah') {
                $('.nisbah_field').show(300);
                $('.interest_field').show(300);

                $('.gl_ditangguhkan_field').hide(200);

                $('#interest_label').html('Bagi Hasil')

                $("#nisbah_anggota").prop('required', true);
                $("#nisbah_koperasi").prop('required', true);
                $("#interest").prop('required', true);
                $("#GL_ditangguhkan").prop('required', false);


            } else if (jenisAkad == 'murabahah' || jenisAkad == 'ijarah' || jenisAkad == 'imbt') {
                $('.interest_field').show(300);

                $('.nisbah_field').hide(200);
                $('.gl_ditangguhkan_field').show(200);

                $('#interest_label').html('Margin')

                $("#nisbah_anggota").prop('required', false);
                $("#nisbah_koperasi").prop('required', false);
                $("#interest").prop('required', true);
                $("#GL_ditangguhkan").prop('required', true);


            } else if (jenisAkad == 'qard') {
                $('.nisbah_field').hide(200);
                $('.gl_ditangguhkan_field').hide(200);
                $('.interest_field').hide(300);

                $("#nisbah_anggota").prop('required', false);
                $("#nisbah_koperasi").prop('required', false);
                $("#interest").prop('required', false);
                $("#GL_ditangguhkan").prop('required', false);

            } else { // if tak select apa apa (default)
                $('.nisbah_field').show(300);
                $('.interest_field').show(300);
                $('.gl_ditangguhkan_field').show(300);


                $("#nisbah_anggota").prop('required', false);
                $("#nisbah_koperasi").prop('required', false);
                $("#interest").prop('required', false);
                $("#GL_ditangguhkan").prop('required', false);

                clearAllField();
            }

        });



        $('#nisbah_anggota').on('keyup', function() {
            let input = $(this).val();
            let side = 100 - input;
            if (input > 100) {
                let result = input.slice(0, 2);
                $('#nisbah_anggota').val(result);
                $('#nisbah_koperasi').val(100-result);
            } else if (input == '') {
                $('#nisbah_anggota').val(0);
                $('#nisbah_koperasi').val(100);
            } else {
                $('#nisbah_koperasi').val(side);
            }
        });



        $("#minimal_pembiayaan, #maksimal_pembiayaan, #biaya_admin, #biaya_materai, #biaya_asuransi, #biaya_lain_lain").inputmask('decimal', {
            'alias': 'numeric',
            'groupSeparator': ',',
            'autoGroup': true,
            'digits': 0,
            'radixPoint': ".",
            // 'digitsOptional': false,
            'allowMinus': false,
            'placeholder': '',
            'removeMaskOnSubmit': true
        });

        $("#interest").inputmask('decimal', {
            'alias': 'decimal',
            'groupSeparator': '.',
            'max': 100,
            'autoGroup': true,
            'digits': 2,
            // 'radixPoint': ",",
            // 'digitsOptional': false,
            'allowMinus': false,
            'placeholder': '',
            // 'removeMaskOnSubmit': true
        });

        function clearAllField() {
            console.log("Cleared all field");
            $('.input_field').val('');
            $("#GL_biaya_admin").val('').change();
            $("#GL_biaya_materai").val('').change();
            $("#GL_biaya_asuransi").val('').change();
            $("#GL_biaya_lain_lain").val('').change();
            $("#GL_produk_pembiayaan").val('').change();
            $("#GL_basil").val('').change();
            $("#GL_ditangguhkan").val('').change();
        }

    });

</script>

@if (!empty($produk_pembiayaan->id))
<script>

    $(document).ready(function () {
        console.log("triggered akad field changes");
        $('#akad_pembiayaan').trigger('change');
        $('#akad_pembiayaan').prop('disabled', true);
        $('#kode_pembiayaan').prop('readonly', true);
    });

</script>
@endif

@endpush
