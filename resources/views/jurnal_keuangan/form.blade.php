@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Informasi Jurnal') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('transaksi_keuangan.index') }}">{{ __('Keuangan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('jurnal_keuangan.index') }}">{{ __('Jurnal') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Jurnal') }}</a>
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Jurnal') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ route('jurnal_keuangan.store') }}">

                    @csrf

                    <div class="card-body">

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="date">{{ __('Tanggal Transaksi') }}</label>
                                </div>
                                <div class="col-md-2">
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

                                <div class="col-md-1">
                                    <label class="control-label form-label" for="journal_no">{{ __('No Jurnal') }}</label>
                                </div>
                                <div class="col-md-2">
                                    <input 
                                        id="journal_no"
                                        name="journal_no" 
                                        type="number" 
                                        min="1"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('journal_no')]) 
                                        value="{{ old('journal_no', $jurnal_keuangan->journal_no ?? null) }}"
                                        placeholder="JN-{{ str_pad(($last->journal_no ?? 0) + 1, 4, 0, STR_PAD_LEFT) }}"
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
                                <div class="col-md-3">
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

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label" for="upload_jurnal">{{ __('Upload') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="file" multiple="" class="custom-file-input" name="upload_jurnal[]" id="upload_jurnal">
                                    <label class="custom-file-label" for="upload_jurnal" style="margin-left: 12px">Pilih File</label>
                                </div>
                            </div>
                        </div>

                        <div class="card card-bordered card-preview">
                            <table class="table table-orders" style="width: 100%">
                                <thead class="tb-odr-head">
                                    <tr class="tb-odr-item">
                                        <th class="tb-odr-item" style="width: 50%; max-width: 50%">
                                            <span>Akun GL</span>
                                        </th>
                                        <th class="tb-odr-item">
                                            <span>Debit</span>
                                        </th>
                                        <th class="tb-odr-item">
                                            <span>Kredit</span>
                                        </th>
                                        <th class="tb-odr-action">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody class="row-container">
                                    @if (!empty($jurnal_keuangan->entries))
                                        @foreach ($jurnal_keuangan->entries as $i => $entry)
                                            
                                            <tr class="nk-odr-head">
                                                <td class="tb-odr-item">
                                                    @if (!isset($readOnly))
                                                    <select 
                                                        class="form-select form-control" 
                                                        data-allow-clear="true" 
                                                        data-search="true" 
                                                        data-minimum-results-for-search="10" 
                                                        data-ajax--url="{{ route('akun_perkiraan.index') }}" 
                                                        data-ajax--data-type="json" 
                                                        name="entries[{{ $i + 1 }}][ledgerable_id]" 
                                                        data-row-num="{{ $i }}" 
                                                        required
                                                    >
                                                        <option>{{ $entry->ledgerable->nama ?? null }}</option>
                                                    </select>
                                                    @else
                                                    <input 
                                                        type="text" 
                                                        class="form-control" 
                                                        value="{{ $entry->ledgerable->nama ?? null }}" 
                                                        autocomplete="off" 
                                                    />
                                                    @endif
                                                </td>
                                                <td class="tb-odr-item">
                                                    <input 
                                                        type="text" 
                                                        class="form-control" 
                                                        name="entries[{{ $i }}][nominal_debet]" 
                                                        value="{{ $entry->debit ? $entry->amount : null }}" 
                                                        autocomplete="off" 
                                                        data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'" 
                                                    />
                                                </td>
                                                <td class="tb-odr-item">
                                                    <input 
                                                        type="text" 
                                                        class="form-control" 
                                                        name="entries[{{ $i }}][nominal_kredit]" 
                                                        value="{{ $entry->credit ? $entry->amount : null }}" 
                                                        autocomplete="off" 
                                                        data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'" 
                                                    />
                                                </td>
                                                @if (!isset($readOnly))
                                                <td class="nk-tb-col nk-tb-col-tools">
                                                    <button class="btn btn-outline-danger btn-block remove-line" type="button" style="visibility: hidden;">
                                                        <em class="icon ni ni-trash"></em>
                                                    </button>
                                                </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="nk-odr-head row-base idx">
                                            <td class="tb-odr-item">
                                                <select 
                                                    class="form-select form-control" 
                                                    data-allow-clear="true" 
                                                    data-search="true" 
                                                    data-minimum-results-for-search="10" 
                                                    data-ajax--url="{{ route('akun_perkiraan.index') }}" 
                                                    data-ajax--data-type="json" 
                                                    name="entries[{{ isset($i) ? $i + 1 : 0 }}][ledgerable_id]" 
                                                    data-placeholder="Pilih Akun GL" 
                                                    data-rownum="{{ isset($i) ? $i + 1 : 0 }}" 
                                                    required
                                                ></select>
                                            </td>
                                            <td class="tb-odr-item">
                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    name="entries[{{ isset($i) ? $i + 1 : 0 }}][nominal_debet]" 
                                                    autocomplete="off" 
                                                    data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'" 
                                                />
                                            </td>
                                                <td class="tb-odr-item">
                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    name="entries[{{ isset($i) ? $i + 1 : 0 }}][nominal_kredit]" 
                                                    autocomplete="off" 
                                                    data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'" 
                                                />
                                            </td>
                                            <td class="nk-tb-col nk-tb-col-tools">
                                                <button class="btn btn-outline-danger btn-block remove-line btn-remove" type="button">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                                <tfoot class="nk-odr-head">
                                    @if (!isset($readOnly))
                                    <tr>
                                        <td class="tb-odr-item" colspan="5">
                                            <button class="btn btn-outline-primary btn-block add-line" type="button">Tambah Baris</button>
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td class="tb-odr-item">
                                            <input type="text" readonly class="form-control-plaintext text-right" value="Total">
                                        </td>
                                        <td class="tb-odr-item">
                                            <input type="text" readonly class="form-control-plaintext text-right" id="debet" value="0.00" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'">
                                        </td>
                                        <td class="tb-odr-item">
                                            <input type="text" readonly class="form-control-plaintext text-right" id="kredit" value="0.00" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'">
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools">

                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
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
@if (isset($readOnly))
calculateTotal();
$('input,select,textarea').attr('disabled', true);
@endif

var select2Options = {
    ajax: {
        dataType: 'json',
        data: data,
        processResults: function (data, page) {
            return { 
                results: data.data,
                pagination: {
                    more: data.current_page < data.last_page
                },
            }
        },
    },
}

function calculateTotal() {
    let debet = 0;
    let kredit = 0;

    $('input[name$="debet]"]').each(function (i, el) {
        let amount = parseFloat(el.value.replace(/[^0-9.-]+/g, ''));

        if (!isNaN(amount)) {
            debet += amount;
        }
    });

    $('#debet').val(debet);

    $('input[name$="kredit]"]').each(function (i, el) {
        let amount = parseFloat(el.value.replace(/[^0-9.-]+/g, ''));

        if (!isNaN(amount)) {
            kredit += amount;
        }
    });

    $('#kredit').val(kredit);
}

$(document).ready(function () {
    $(':input').inputmask();

    $('.form-select').select2(select2Options);

    $('.add-line').on('click', function (e) {
        e.preventDefault();

        $('.form-select').select2('destroy');

        let rowCount = $('table.table-orders tbody tr').length;

        let newRow = $('table.table-orders tbody tr:first-child').clone();

        // $('.form-select').select2('destroy');

        newRow.find('select,input').val('');
        
        newRow.find('select,input').removeAttr('disabled');

        newRow.find('select,input').attr('name', function (i, val) {
            return val.replace(0, rowCount);
        });

        newRow.appendTo('tbody');

        $('.form-select').select2(select2Options);

        $('select[name^="entries[' + rowCount + ']"]').val(null).trigger('change');

        $(':input').inputmask();
    });

    $('body').on('click', '.remove-line', function (e) {
        e.preventDefault();

        if (confirm('Buang baris?')) {
            $(this).parent().parent().remove();
        }

        calculateTotal();
    });

    $('body').on('keyup', 'input[type="text"]', function () {
        let name = $(this).attr('name');

        if (name.includes('debet')) {
            if ($(this).inputmask('unmaskedvalue') > 0) {
                $('input[name="' + name.replace('debet', 'kredit') + '"]').attr('disabled', 'disabled');
            } else {
                $('input[name="' + name.replace('debet', 'kredit') + '"]').removeAttr('disabled');
            }
        }

        if (name.includes('kredit')) {
            if ($(this).inputmask('unmaskedvalue') > 0) {
                $('input[name="' + name.replace('kredit', 'debet') + '"]').attr('disabled', 'disabled');
            } else {
                $('input[name="' + name.replace('kredit', 'debet') + '"]').removeAttr('disabled');
            }
        }

        calculateTotal();
    });

    $('form').on('submit', function (e) {
        var debet = $('#debet').val();
        var kredit = $('#kredit').val();

        if (debet != kredit) {
            Swal.fire({
                title: 'Kesalahan',
                text: 'Total debet & kredit tidak sama!',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            e.preventDefault();
        }
    });
});
</script>
@endpush