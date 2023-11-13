@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Akun Perkiraan') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Informasi Akun Perkiraan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('transaksi_keuangan.index') }}">{{ __('Keuangan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
         <li class="breadcrumb-item">
            <a href="{{ route('akun_perkiraan.index') }}">{{ __('Akun Perkiraan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Akun Perkiraan') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Akun Perkiraan') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($akun_perkiraan->id) ? route('akun_perkiraan.update', [$akun_perkiraan]) : route('akun_perkiraan.store') }}">

                    @if (!empty($akun_perkiraan->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <input type="hidden" name="parent_id" value="{{ $akun_perkiraan->parent_id ?? null }}" />
                                <input type="hidden" name="jenis" value="{{ $akun_perkiraan->jenis ?? null }}" />

                                <div class="form-group clearfix">
                                	<div class="row">
                                		<div class="col-md-3">
                                            <label class="control-label form-label" for="tahap">{{ __('Tahap') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select id="tahap" class="form-control select2" data-placeholder="{{ __('Pilih Tahap') }}" data-minimum-results-for-search="Infinity" required>
                                                <option value="-">Pilih Tahap</option>
                                                @foreach ([1 => 'Kelompok', 2 => 'Akun Utama', 3 => 'Sub Akun', 4 => 'Sub Sub Akun'] as $k => $v)
                                                    <option value="{{ $k }}"{{ !empty($akun_perkiraan->depth) && $akun_perkiraan->depth == $k ? ' selected' : null }}>{{ $v }}</option>
                                                @endforeach
                                            </select>
                                        </div>
						           </div>
                                </div>

                                <div class="form-group clearfix" style="display: none">
                                	<div class="row">
                                		<div class="col-md-3">
                                            <label class="control-label form-label" for="kelompok">{{ __('Kategori') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select id="kategori" class="form-control select2" data-placeholder="{{ __('Pilih Kategori') }}" data-minimum-results-for-search="Infinity" required>
                                                <option value="">Pilih Kategori</option>
                                                @foreach ($kodes as $kode)
                                                    <option
                                                        data-kode="{{ $kode->full_kode }}"
                                                        data-jenis="{{ $kode->jenis }}"
                                                        value="{{ $kode->id }}"
                                                        {{ !empty($akun_perkiraan->ancestors) && $akun_perkiraan->ancestors->filter(fn ($ancestor) => $ancestor->depth == 0)->first()->id == $kode->id ? ' selected' : null }}
                                                    >
                                                        {{ $kode->kode }} - {{ $kode->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
						           </div>
                                </div>

                                <div class="form-group clearfix" style="display: none">
                                	<div class="row">
                                		<div class="col-md-3">
                                            <label class="control-label form-label" for="kelompok">{{ __('Kelompok') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select id="kelompok" class="form-control select2" data-placeholder="{{ __('Pilih Kelompok') }}" data-minimum-results-for-search="Infinity">
                                                {{-- <option value="">Pilih Akun Utama</option> --}}
                                            </select>
                                        </div>
						           </div>
                                </div>

                                <div class="form-group clearfix" style="display: none">
                                	<div class="row">
                                		<div class="col-md-3">
                                            <label class="control-label form-label" for="akun_utama">{{ __('Akun Utama') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select id="akun_utama" class="form-control select2" data-placeholder="{{ __('Pilih Akun Utama') }}" data-minimum-results-for-search="Infinity">
                                                {{-- <option value="">Pilih Sub Akun</option> --}}
                                            </select>
                                        </div>
						           </div>
                                </div>

                                <div class="form-group clearfix" style="display: none">
                                	<div class="row">
                                		<div class="col-md-3">
                                            <label class="control-label form-label" for="sub_akun">{{ __('Sub Akun') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select id="sub_akun" class="form-control select2" data-placeholder="{{ __('Pilih Sub Akun') }}" data-minimum-results-for-search="Infinity">
                                                {{-- <option value="">Pilih Sub Sub Akun</option> --}}
                                            </select>
                                        </div>
						           </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="kode">{{ __('Kode') }}</label>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text kode">
                                                        {{ !empty($akun_perkiraan->ancestors) ? $akun_perkiraan->ancestors->sortByDesc('depth')->first()->kode : null }}.
                                                    </div>
                                                </div>
                                                <input
                                                    id="kode"
                                                    name="kode"
                                                    type="text"
                                                    @class(['required', 'form-control', 'inputmask', 'is-invalid' => $errors->has('kode')])
                                                    value="{{ old('kode', $akun_perkiraan->sub_kode ?? '') }}"
                                                    required
                                                />
                                            </div>
                                            @error('kode')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                    	<div class="col-md-2">
                                            <label class="control-label form-label" for="nama">{{ __('Nama') }}</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input
                                                id="nama" nama
                                                name="nama"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('nama')])
                                                value="{{ old('nama', $akun_perkiraan->nama ?? '') }}"
                                                required
                                            />
                                            @error('nama')
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
                                            <label class="control-label form-label" for="starting_balance">{{ __('Saldo Awal') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                id="starting_balance"
                                                name="starting_balance"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('starting_balance')])
                                                value="{{ old('starting_balance', $akun_perkiraan->starting_balance ?? '') }}"
                                            />
                                            @error('starting_balance')
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
                                            <label class="control-label form-label" for="keterangan">{{ __('Keterangan') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea
                                                id="keterangan"
                                                name="keterangan"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('keterangan')])
                                                rows="5"
                                            >{{ old('keterangan', $akun_perkiraan->keterangan ?? '') }}</textarea>
                                            @error('keterangan')
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
                                            <label class="control-label form-label" for="arus_kas">{{ __('Arus Kas Aktifitas') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="arus_kas" class="form-control select2" data-placeholder="{{ __('Pilih...') }}" data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih...') }}</option>
                                                <option value="operasi">1- Operasi</option>
                                                <option value="investasi">2- Investasi</option>
                                                <option value="pendanaan">3- Pendanaan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="card-footer border border-top-0 text-right">
                    	<a href="{{ route('akun_perkiraan.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($akun_perkiraan->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8-beta.7/jquery.inputmask.min.js" integrity="sha512-x3zoB6e8YsZipoDoCTClRYkEpqucilZ8IYsaJFE0XUtUJQdO7v2xFzvd1zQKrb3ParCNpvdAE0C85msCw3NrLA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
var kodes = [];

$(document).ready(function () {
    $('select.select2').select2();

    $('input.inputmask').inputmask('9');

    $('#tahap').on('change', function () {

        $('label[for="nama"]').html('Nama');

        if ($(this).select2('data')[0].id != '-') {
            $('label[for="nama"]').html($(this).select2('data')[0].text);
        }

        $('#kategori').val(null).trigger('change');

        $('input.inputmask').inputmask('9');

        switch (parseInt($(this).select2('data')[0].id)) {
            case 1:
                $('#kategori').parent().parent().parent().slideDown();

                $('#kelompok').parent().parent().parent().slideUp();
                $('#akun_utama').parent().parent().parent().slideUp();
                $('#sub_akun').parent().parent().parent().slideUp();
                break;

            case 2:
                $('#kategori').parent().parent().parent().slideDown();
                $('#kelompok').parent().parent().parent().slideDown();

                $('#akun_utama').parent().parent().parent().slideUp();
                $('#sub_akun').parent().parent().parent().slideUp();
                break;

            case 3:
                $('#kategori').parent().parent().parent().slideDown();
                $('#kelompok').parent().parent().parent().slideDown();
                $('#akun_utama').parent().parent().parent().slideDown();

                $('#sub_akun').parent().parent().parent().slideUp();

                $('input.inputmask').inputmask('99');
                break;

            case 3:
                $('#kategori').parent().parent().parent().slideDown();
                $('#kelompok').parent().parent().parent().slideDown();
                $('#akun_utama').parent().parent().parent().slideDown();
                $('#sub_akun').parent().parent().parent().slideDown();

                $('input.inputmask').inputmask('99');
                break;

            case 4:
                $('#kategori').parent().parent().parent().slideDown();
                $('#kelompok').parent().parent().parent().slideDown();
                $('#akun_utama').parent().parent().parent().slideDown();
                $('#sub_akun').parent().parent().parent().slideDown();

                $('input.inputmask').inputmask('99');
                break;

            default:
                $('#kategori').parent().parent().parent().slideUp();
                $('#kelompok').parent().parent().parent().slideUp();
                $('#akun_utama').parent().parent().parent().slideUp();
                $('#sub_akun').parent().parent().parent().slideUp();
        }
    });

    @if (!isset($akun_perkiraan))
    $('#kelompok').select2({
        ajax: {
            url: function () {
                var parent = $('#kategori').select2('data');

                if (! parent[0].id) {
                    return null;
                }

                return `{{ route('akun_perkiraan.index') }}?parent_id=${parent[0].id}`;
            },
            dataType: 'json',
            data: data,
            processResults: processPaginatedResults,
        }
    });

    $('#akun_utama').select2({
        ajax: {
            url: function () {
                var parent = $('#kelompok').select2('data');

                if (! parent[0].id) {
                    return null;
                }

                return `{{ route('akun_perkiraan.index') }}?parent_id=${parent[0].id}`;
            },
            dataType: 'json',
            data: data,
            processResults: processPaginatedResults,
        }
    });

    $('#sub_akun').select2({
        ajax: {
            url: function () {
                var parent = $('#akun_utama').select2('data');

                if (! parent[0].id) {
                    return null;
                }

                return `{{ route('akun_perkiraan.index') }}?parent_id=${parent[0].id}`;
            },
            dataType: 'json',
            data: data,
            processResults: processPaginatedResults,
        }
    });

    $('#kategori').on('change', function () {
        $('#kelompok').val(null).trigger('change');
    });

    $('#kelompok').on('change', function () {
        $('#akun_utama').val(null).trigger('change');
    });

    $('#akun_utama').on('change', function () {
        $('#sub_akun').val(null).trigger('change');
    });

    $('select.select2').on('change', function (e) {
        var selected = $(this).find('option:selected');

        var kode = $(selected[0]).text().trim().substring(0, 1);

        if ($(this).attr('id') != 'kategori' && $(this).select2('data')[0]) {
            kode = $(this).select2('data')[0].kode;
        }

        if (typeof kode != 'undefined' && kode != 'undefined' && kode != null && kode != '' && kode != 'P') {
            $('.kode').html(kode + '.');
        }

        $('input[name="parent_id"]').val(selected.val());

        $('input#kode').val(null).trigger('keyup');
    });

    $('input#kode').on('keyup', function () {
        var me = $(this);

        if ($('input[name="parent_id"]').val()) {
            $.ajax({
                url: `{{ route('akun_perkiraan.index') }}?parent_id=${$('input[name="parent_id"]').val()}&limit=100`,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success:function (response) {
                    kodes = [];

                    response.data.map(function (d) {
                        kodes.push(d.sub_kode);
                    });

                    me.removeClass('is-invalid');
                    me.parent().find('.invalid-feedback').remove();

                    if (kodes.includes(me.val().toString())) {
                        me.addClass('is-invalid');

                        me.parent().append(
                            `<div class="invalid-feedback">
                                Kode ini telah tersedia.
                            </div>`
                        );
                    }
                },
            });
        }
    });

    $('form.form-horizontal').on('submit', function (e) {
        if ($('div.invalid-feedback').length) {
            e.preventDefault();
        }
    });
    @else
        $('select.select2').attr('disabled', true);

        @php
            $akun = $akun_perkiraan->ancestors->filter(fn ($ancestor) => $ancestor->depth == 1)->first();
        @endphp

        @if (!empty($akun->id))
            var data = {
                id: {{ $akun->id }},
                text: '{{ $akun->kode }} - {{ $akun->nama }}'
            };

            var newOption = new Option(data.text, data.id, false, false);
            $('#kategori').append(newOption).trigger('change');
        @endif

        @php
            $akun = $akun_perkiraan->ancestors->filter(fn ($ancestor) => $ancestor->depth == 2)->first();
        @endphp

        @if (!empty($akun->id))
            var data = {
                id: {{ $akun->id }},
                text: '{{ $akun->kode }} - {{ $akun->nama }}'
            };

            var newOption = new Option(data.text, data.id, false, false);
            $('#kelompok').append(newOption).trigger('change');
        @endif

        @php
            $akun = $akun_perkiraan->ancestors->filter(fn ($ancestor) => $ancestor->depth == 3)->first();
        @endphp

        @if (!empty($akun->id))
            var data = {
                id: {{ $akun->id }},
                text: '{{ $akun->kode }} - {{ $akun->nama }}'
            };

            var newOption = new Option(data.text, data.id, false, false);
            $('#akun_utama').append(newOption).trigger('change');
        @endif
    @endif
});
</script>
@endpush
