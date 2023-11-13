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
                <h5 class="card-header">{{ __('Tambah Akun Perkiraan') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ route('jurnal_keuangan.store') }}">

                    @csrf

                    <div class="card-body">
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-7">

                                </div>
                                {{-- button --}}


                                <div class="col-md-2">
                                    <label class="control-label form-label" for="date">{{ __('Kategori') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <select name="" id="kategori_utama" class="form-control">
                                        <option value="1">Kelompok</option>
                                        <option value="2">Akun Utama</option>
                                        <option value="3">Sub AKun</option>
                                        <option value="4">Sub Sub Akun</option>
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
                                    <label class="control-label form-label" for="date">{{ __('Kategori') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <select name="" id="kategori"class="form-control" >
                                        @foreach($kodes as $kode)
                                            <option value="">{{$kode->nama}}</option>
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
                                    <label class="control-label form-label" for="description">{{ __('Kelompok') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="kelompok">
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="description">{{ __('Akun Utama') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="akun_utama">
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="description">{{ __('Sub Akun') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="sub_akun">
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="description">{{ __('Sub Sub Akun') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control"id="subsubakun">
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="row">

                                <div class="col-md-2">
                                    <label class="control-label form-label" for="description">{{ __('Kategori') }}</label>
                                    <input type="text" class="form-control" id="kat">
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="description">{{ __('Kelompok') }}</label>
                                    <input type="text" class="form-control"id="kel">
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label form-label" for="description">{{ __('Akun Utama') }}</label>
                                    <input type="text" class="form-control"id="aku">
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="description">{{ __('Sub Akun') }}</label>
                                    <input type="text" class="form-control"id="subak">
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="description">{{ __('Sub Sub Akun') }}</label>
                                    <input type="text" class="form-control"id="subsub">
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-md-5">
                                <h2>{{ __('1-10000') }}</h2>
                                <input type="text" class="form-control"id="subsub" hidden>
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
@if (isset($readOnly))
calculateTotal();
$('input,select,textarea').attr('disabled', true);
@endif
document.getElementById("subsub").readOnly = false;
document.getElementById("subak").readOnly = false;
document.getElementById("sub_akun").readOnly = false;
document.getElementById("aku").readOnly = false;
document.getElementById("akun_utama").readOnly = false;
document.getElementById("subsubakun").readOnly = false;
$('#kategori_utama').on('change',function (){
   if($(this).val() == '1')
   {
       document.getElementById("subsub").readOnly = true;
       document.getElementById("subak").readOnly = true;
       document.getElementById("sub_akun").readOnly = true;
       document.getElementById("subsubakun").readOnly = true;
       document.getElementById("aku").readOnly = true;
       document.getElementById("akun_utama").readOnly = true;
   }else if ($(this).val() == '2')
   {
       document.getElementById("subsub").readOnly = true;
       document.getElementById("subak").readOnly = true;
       document.getElementById("sub_akun").readOnly = true;
       document.getElementById("subsubakun").readOnly = true;
       document.getElementById("akun_utama").readOnly = false;
       document.getElementById("aku").readOnly = false;


   }
   else if($(this).val() == '3')
   {
       document.getElementById("subsub").readOnly = true;
       document.getElementById("subak").readOnly = false;
       document.getElementById("sub_akun").readOnly = false;
       document.getElementById("subsubakun").readOnly = true;
       document.getElementById("akun_utama").readOnly = false;
       document.getElementById("aku").readOnly = false;


   }else{
       document.getElementById("subsub").readOnly = false;
       document.getElementById("subak").readOnly = false;
       document.getElementById("sub_akun").readOnly = false;
       document.getElementById("subsubakun").readOnly = false;
       document.getElementById("akun_utama").readOnly = false;
       document.getElementById("aku").readOnly = false;

   }
});
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
