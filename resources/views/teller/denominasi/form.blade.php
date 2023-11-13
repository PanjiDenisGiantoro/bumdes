@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header"> Denominasi</h3>
    <br>
{{--<br>--}}
{{--<x-breadcrumb title="{{ __('Informasi Pesanan') }}">--}}
{{--    <li class="breadcrumb-item">--}}
{{--        <a href="{{ route('pembelian.setting') }}">{{ __('Setting') }}</a>--}}
{{--    </li>--}}
{{--    <li class="breadcrumb-item">--}}
{{--        {{ __('Informasi Pesanan') }}--}}
{{--    </li>--}}
{{--</x-breadcrumb>--}}
@endsection

@section('content')
<div class="container">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="components-preview wide-md mx-auto">
                <div class="nk-block-head nk-block-head-sm">
                    <!-- <div class="nk-block-head-sub">
                        <span>Denominasi Kas</span>
                    </div> -->
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Alokasi Denominasi </h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li>
                                            {{-- <a href="" class="btn btn-icon btn-primary btn-add" data-toggle="modal" data-target="#modalForm">
                                                <em class="fa fa-plus"></em>
                                            </a> --}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            {{-- @if (!empty($assetData))
                <form id="denominasi_form" method="POST" action="{{ route('admin.kasir-denominasi.update', [$assetData->id]) }}">
                @method('PUT')
            @else --}}
                <form id="denominasi_form" method="POST" action="{{ route('denominasi.add') }}">
            {{-- @endif --}}
                    @csrf

                    {{-- <input type="hidden" id="total_amount" name="total_amount"> --}}
                
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <div class="card-head">
                                <!-- <h5 class="card-title">Alokasi Denominasi</h5> -->
                            </div>
                            <div class="row p-4">
                                <div class="col-lg-9">
                                    <div class="form-group" >
                                        <label class="form-label" for="lejer">GL Tujuan</label>
                                        <div class="form-control-wrap">
                                            <select class="form-control lejer" name="lejer" id="lejer">
                                                <option></option>
                                                {{-- @foreach ($akun as $i => $data)
                                                <option value="{{ $data->id }}"{{ !empty($assetData->lejer) && $assetData->lejer == $data->id ? ' selected="selected"' : '' }}> {{ $data->nama_account }}</option>
                                                @endforeach --}}
                                                @foreach ($akun as $gl)
                                                        <option value="{{$gl->id}}">{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $gl->depth) !!}{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group" >
                                        <label class="form-label" for="tanggal">Tanggal</label>
                                        <input type="text" class="form-control" id="tanggal" disabled value="{{ !empty($assetData) ? $assetData->created_at->format('d/m/Y') : date('d/m/Y') }} ">
                                    </div>
                                </div>
                            </div>
                            <div class="row px-4">
                                <div class="col-lg-4">
                                    <div class="form-group" >
                                        <label class="form-label" for="total_display">Nominal</label>
                                        <input type="text" class="form-control total" name="total_amount" id="total_display" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group" >
                                        <label class="form-label" for="jenis_alokasi">Jenis Transaksi</label>
                                        <div class="form-control-wrap">
                                            <select onchange="debitorkredit(this);" class="form-select form-control jenis-transaksi" name="jenis_transaksi" id="jenis_alokasi">
                                                <option></option>
                                                <option value="Penerimaan">Penerimaan</option>
                                                <option value="Pengeluaran">Pengeluaran</option>
                                            {{-- @foreach ($jenisAlokasi as $id => $data)
                                                <option value="{{ $data->id }}"{{ !empty($assetData) && $assetData->jenis_alokasi == $data->id ? ' selected' : '' }}> {{ $data->nama }} </option>
                                            @endforeach --}}
                                            </select>
                                            {{-- <div id="ifYes" style="display: none;"> --}}
                                                <input type="text" id="debitAs" name="jenis_operasi" value="debit" style="display: none;" /><br />
                                                <input type="text" id="kreditAs" name="jenis_operasi" value="kredit" style="display: none;"/><br />
                                            {{-- </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group" >
                                        <label class="form-label" for="id_teller">ID Teller</label>
                                        <input type="text" class="form-control" name="teller_id" id="id_teller" readonly value="{{ !empty($assetData) ? $assetData->creator->name : auth()->user()->name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row px-4">
                            
                                <div class="col-lg-8">
                                    <div class="form-group" >
                                        <label class="form-label" for="keterangan">Keterangan</label>
                                        <textarea type="text" class="form-control" name="keterangan" id="keterangan">{{ !empty($assetData) ? $assetData->keterangan : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-inner">
                            <div class="row px-4">
                                <!-- <div class="col-lg-2">
                                </div> -->
                                <div class="col-lg-10">
                                    <div class="card card-bordered">
                                        <table id="deno" class="table px-4 nowrap nk-tb-list nk-tb-ulist" data-auto-responsive="false" data-searching="false" data-paging="false">
                                            <thead>
                                                <tr class="nk-tb-item nk-tb-head">
                                                    <th class="nk-tb-col" data-num="true" >
                                                        <span class="sub-text">Nominal Denominasi</span>
                                                    </th>
                                                    <th class="nk-tb-col" data-sortable="false" >
                                                        <span class="sub-text text-center">Jumlah</span>
                                                    </th>
                                                    <th class="nk-tb-col" data-sortable="false" >
                                                        <span class="sub-text text-center">Total Nominal</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ([100, 200, 500, 1001, 1000, 2000, 5000, 10000, 20000, 50000, 75000, 100000] as $i => $deno)
                                                <tr class="nk-tb-item p-1">
                                                    {{-- <td class="nk-tb-col">{{ $deno }}</td> --}}
                                                    <td class="nk-tb-col">{{ $deno=='1001' ? '1000 Coin' : $deno }}</td>
                                                    <td class="nk-tb-col">
                                                        <div class="col-lg-12">
                                                            <input type="number" tabindex="{{ $i + 1 }}" min="0" class="form-control text-right" name="unit_{{ $deno }}" id="unit_{{ $deno }}" value="{{ !empty($assetData) ? $assetData->{"unit_$deno"} : '0' }}">
                                                        </div>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control text-right" name="value_{{ $deno }}" id="value_{{ $deno }}" value="{{ !empty($assetData) ? $assetData->{"value_$deno"} : '0' }}" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'" readonly>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                <tr class="nk-tb-item p-1">
                                                    <td class="nk-tb-col">Total</td>
                                                    <td class="nk-tb-col"></div>
                                                    <td class="nk-tb-col"> 
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control total" name="total_amount_display" id="total_amount_display" value="" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'" readonly>
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                </div>
                            </div>

                            <!-- <div class="row mt-4">
                                <div class="col-lg-12 text-left">
                                    <div class="form-group" >
                                        <a id="calculate_btn" href="#" class="btn btn-lg btn-primary">Kirim</a>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row mt-4 px-4">
                                <div class="col-lg-12 text-left">
                                    <div class="form-group" >
                                        <button id="modalStatement_btn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#denominasi_statement">Kirim</button>
                                        <!-- <button type="submit" class="btn btn-lg btn-primary">Kirim</button> -->
                                        <a href="{{ route('denominasi.index') }}" class="btn">
                                            Kembali
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- // Statement Modal -->
<div class="modal fade" tabindex="-1" id="denominasi_statement">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Denominasi Statement</h5>
            </div>
            <div class="modal-body">

                <div class="card card-bordered show-table">

                </div>

                <div class="row mt-4">
                    <div class="col-lg-12 text-right">
                        <div class="form-group" >
                            <button id="modalPasti_btn" type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#confirmationModal">Lanjutkan</button>
                            <!-- <button id="modalStatement_btn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#denominasi_statement">Modal Default</button> -->

                            <!-- <button type="submit" class="btn btn-lg btn-primary">Kirim</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- // Confirmation Modal -->
<div class="modal fade" tabindex="-1" id="confirmationModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <p> Anda yakin untuk register denominasi ini ?</p>
                
                <a href="#" class="btn btn-md btn-primary" id="confirmModal_submit_btn"> 
                    Lanjutkan
                </a>
                <a href="#" class="btn btn-md btn-outline-danger" id="confirmModal_cancel_btn"> 
                    Batal
                </a>
            </div>
            <div class="modal-footer bg-light">
                <!-- <a href="#" class="btn btn-lg btn-primary" id="confirmModal_submit_btn"> 
                    Pasti
                </a>
                <a href="#" class="btn btn-lg btn-outline-danger" id="confirmModal_cancel_btn"> 
                    Batal
                </a> -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7-beta.19/jquery.inputmask.min.js"></script>
<script>
    $(".lejer").select2({
        placeholder: "Pilih GL",
    });

    $(".jenis-transaksi").select2({
        placeholder: "Pilih Jenis Transaksi",
    });
</script>
<script>
    const formatter = new Intl.NumberFormat('MS', {
        minimumFractionDigits: 2,      
        maximumFractionDigits: 2,
    });

    function debitorkredit(that) {
        if (that.value == "Penerimaan") {
            document.getElementById("debitAs");
            $("#kreditAs").prop('disabled', true);

            $("#debitAs").prop('disabled', false);
            $("#debitAs").attr('hidden', true);
        } else {
            document.getElementById("kreditAs");
            $("#debitAs").prop('disabled', true);

            $("#kreditAs").prop('disabled', false);
            $("#kreditAs").attr('hidden', true);
        }
    }

    function sum() {
        var total = 0;
        $('#deno input[name^=value_]').each(function () {
            // console.log($(this).val().replace(/,/g, ''));
            
            total += parseInt($(this).val().replace(/,/g, ''));

            $('.total').val(total);
        })
    }

    $(document).ready(function () {
        sum();

        $('#deno input[name^=unit_]').on('keyup mouseup', function () {
            let deno = parseInt($(this).parent().parent().prev().html());

            let total = deno * parseInt($(this).val().replace(/,/g, ''));

            $('input[name=' + $(this).attr('name').replace('unit', 'value') + ']').val(total);

            sum();
        });

        $('input[name^=value_]').inputmask();

        $('.total').inputmask();

        $('#modalStatement_btn').on('click', function () {
            $('.show-table').empty();

            let tableCopy = $('table#deno').clone();

            tableCopy.appendTo('.show-table');

            $('.show-table input').attr('disabled', 'disabled');
            $('.show-table input').removeClass('form-control');
            $('.show-table input').addClass('form-control-plaintext');
        });

        $('#confirmModal_submit_btn').on('click', function() {
            $('#denominasi_form').submit();
        });

        $('#confirmModal_cancel_btn').on('click', function() {
            $('#confirmationModal').modal('hide');
        });
    });
</script>
@endpush

