@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">Teller</h3>
    <br>
{{--    <x-breadcrumb title="{{ __('Transaksi') }}">--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('transaksi_keuangan.index') }}">{{ __('Keuangan') }}</a>--}}
{{--        </li>--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('transaksi_keuangan.index') }}">{{ __('Transaksi') }}</a>--}}
{{--        </li>--}}
{{--        <li class="breadcrumb-item">--}}
{{--            {{ __('Tambah Transaksi') }}</a>--}}
{{--        </li>--}}
{{--    </x-breadcrumb>--}}
@endsection

@section('content')
    <style>
        @page {
            header: html_pageHeader;
            footer: html_pageFooter;
            margin-top: 25mm;
            margin-bottom: 5%;
            margin-header: 5mm;
            margin-footer: 5mm;
        }

        .header-border {
            border-left: 1px solid #7a7a7a;
            border-right: 1px solid #7a7a7a;
            border-top: 1px solid #7a7a7a;
            /* border-bottom: 1px dashed #7a7a7a; */
            /* padding-bottom: 20px; */
            /* margin-bottom: 86px; */
        }

        .footer-border {
            /*border-left: 1px solid #7a7a7a;*/
            /*border-right: 1px solid #7a7a7a;*/
            /* border-top: 1px dashed #7a7a7a; */
            /*border-bottom: 1px solid #7a7a7a;*/
        }

        .report-title {
            text-align: center;
            /* color: #333; */
            /* font-size: 13px; */
            margin-top: 4px;
            padding-bottom: -15px;
        }

        .koperasi-name {
            text-align: center;
            padding-bottom: -15px;
            font-size: 11px;
        }

        .koperasi-detail {
            text-align: center;
            padding-bottom: -15px;
            font-size: 10px;
        }
    </style>
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">

                <form method="POST" id="form_transaksi" class="form-horizontal"
                      action="{{route('transaksi_keuangan.store') }}">

                    @csrf

                    <h6 class="card-header">{{ __('Rekening Anggota') }}</h6>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group clearfix">
                                	<div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label form-label" for="anggota_id">{{ __('Nama') }}</label>
                                            <select id="anggota_id" name="anggota_id" class="form-control select2" data-placeholder="Pilih anggota.." data-allow-clear="true" {{ !empty($rekening->id) ? 'disabled' : '' }} >
                                                <option value=""></option>
                                                @foreach ($anggota as $i => $nasabah)
                                                <option value="{{ $nasabah->id }}" >{{ $nasabah->nama_pemohon ?? '-' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="nik">{{ __('NIK') }}</label>
                                            <input id="nik" type="text" class="form-control" readonly />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="no_mitra">{{ __('No. Anggota') }}</label>
                                            <input id="no_mitra" type="text" class="form-control" readonly/>
                                        </div>
						           </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group clearfix">
                                	<div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label form-label" for="akun_id">{{ __('Nama Akun') }}</label>
                                            <select id="akun_id" name="akun_id" class="form-control select2" data-placeholder="Pilih Rekening.." data-allow-clear="true">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="no_rekening">{{ __('No. Rekening') }}</label>
                                            <input id="no_rekening" type="text" class="form-control" readonly />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="saldo">{{ __('Saldo') }}</label>
                                            <input id="saldo" type="text" class="form-control nominal" readonly/>
                                        </div>
						           </div>
                                </div>
                            </div>

                            <div class="col-md-12 pembiayaan_info_field" style="display: none">
                                <div class="form-group clearfix">
                                	<div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="angsuran_pokok">{{ __('Angsuran Pokok') }}</label>
                                            <input id="angsuran_pokok" type="text" class="form-control nominal" readonly />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="angsuran_margin">{{ __('Angsuran Margin/Basil') }}</label>
                                            <input id="angsuran_margin" type="text" class="form-control nominal" readonly />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="kewajiban_angsuran">{{ __('Total Angsuran') }}</label>
                                            <input id="kewajiban_angsuran" type="text" class="form-control nominal" readonly />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="sisa_pembiayaan">{{ __('Sisa Pembiayaan') }}</label>
                                            <input id="sisa_pembiayaan" type="text" class="form-control nominal" readonly/>
                                        </div>
						           </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h6 class="card-header">{{ __('Informasi Transaksi') }}</h6>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label"
                                                   for="jenis_transaksi">{{ __('Jenis Transaksi') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="jenis_transaksi" id="jenis_transaksi"
                                                    class="form-control select2"
                                                    data-placeholder="{{ __('Pilih Jenis Transaksi') }}"
                                                    data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Jenis Transaksi') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label"
                                                   for="date">{{ __('Tanggal Akuisisi') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                id="date"
                                                name="date"
                                                type="date"
                                                readonly
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('date')])
                                                value="{{ old('date', $transaksi_keuangan->date ?? date('Y-m-d')) }}"
                                            />
                                            @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label"
                                                   for="journal_no">{{ __('No Jurnal') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                id="journal_no"
                                                name="journal_no"
                                                type="number"
                                                min="1"
                                                readonly
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('journal_no')])
                                                value="{{ old('journal_no', $transaksi_keuangan->journal_no ?? null) }}"
                                                placeholder="TN-{{ str_pad(($last ?? 0) + 1, 5, 0, STR_PAD_LEFT) }}"
                                            />
                                            @error('journal_no')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label"
                                                   for="reference">{{ __('No Ref') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                id="reference"
                                                name="reference"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('reference')])
                                                value="{{ old('reference', $transaksi_keuangan->reference ?? null) }}"
                                            />
                                            @error('reference')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label"
                                                   for="description">{{ __('Keterangan') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea
                                                id="description"
                                                name="description"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('description')])
                                                rows="5"
                                                required
                                            >{{ old('description', $transaksi_keuangan->description ?? null) }}</textarea>
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 margin_pokok_field" style="display: none">
                                <!-- <input id="nominal_pokok_switch" name="nominal_pokok_switch" value="0" hidden> -->
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="pokok">{{ __('Pokok') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input id="pokok" name="pokok" type="text" class="form-control input_nominal"
                                                autocomplete="off"
                                                data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'"
                                            />
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="margin">{{ __('Margin') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input id="margin" name="margin" type="text" class="form-control input_nominal"
                                                autocomplete="off"
                                                data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="nominal">{{ __('Nominal') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                id="nominal"
                                                name="nominal"
                                                type="text"
                                                @class(['form-control', 'is-invalid' => $errors->has('nominal')])
                                                value="{{ old('nominal', !empty($transaksi_keuangan->entries) ?   number_format(abs($transaksi_keuangan->entries->pluck('amount')->avg()), 2)   : null) }}"
                                                autocomplete="off"
                                                data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'"
                                            />
                                            @error('nominal')
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

                    <div class="card-footer border-0 text-right">
                        <a href="{{ route('transaksi_keuangan.index') }}" class="btn btn-primary"
                           style="background-color: red">
                            {{ !isset($readOnly) ? __('Batal') : __('Kembali') }}
                        </a>
                        @if (!isset($readOnly))
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#confirmationModal"
                               id="submit_btn">{{ !empty($anggota->id) ? __('Perbaharui') : __('Kirim') }}</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade zoom" tabindex="-1" id="confirmationModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">


                    <center><b>{{$company->nama_perusahaan ?? ''}}</b></center>
                    <center>{{$company->alamat_utama ?? ''}}</center>
                    <center>Telp: {{$company->no_handphone ?? ''}} |
                        E:mail: {{$company->email_perusahaan ?? ''}}</center>

                    <br>
                    <center><b>STRUK</b></center>
                    <table style="width: 100%;" class="footer-border">
                        <tr>
                            <td><p class="no_rekening_label"></p></td>
                            <td><p class="tanggal"></p></td>
                        </tr>
                        <tr>
                            <td><p class="nama"></p></td>
                            <td><p class="no_jurnal">No. Transaksi
                                    :TN-{{ str_pad(($last ?? 0) + 1, 5, 0, STR_PAD_LEFT) }}</p></td>
                        </tr>
                        <tr>
                            <td><p class="nik"></p></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Keterangan : <textarea type="text" class="form-control keterangan"
                                                       style="border: none"></textarea></td>
                            <td></td>
                        </tr>

                    </table>
                    <table class="table">

                        <tr>
                            <th>No</th>
                            <th>No.Ref</th>
                            <th>Jumlah</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td><p class="no_reff"></p></td>
                            <td><p class="jumlah"></p></td>
                        </tr>
                    </table>


                </div>
                <div class="modal-footer">
                    <button class="btn btn-md btn-primary mr-3" id="confirmBtn">
                        Lanjutkan
                    </button>
                    <a data-dismiss="modal" href="#" class="btn btn-md btn-danger">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endpush

@push('scripts')
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7-beta.19/jquery.inputmask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>


        $(document).ready(function () {

            $('select').select2();

            // var globalAnggota = '';
            var namaAnggota = '';
            var globalRekening = '';
            var globalPembiayaan = '';
            var globalSelectedRekeningType = '';

            $('#nominal').on('keyup', function () {
                test_value = $(this).val();
                $('.jumlah').html(test_value)
            })
            $('#reference').on('keyup', function () {
                test_value = $(this).val();
                $('.no_reff').html(test_value)
            })
            $('#confirmBtn').on('click', function () {
                // console.log("Clicked modal confirm btn");
                $('#form_transaksi').submit();
            });
            $(':input').inputmask();


            $('#anggota_id').on('change', function () {
                clearRekeningData();
                var anggotaId = $(this).val();
                if (anggotaId) {
                    $.ajax({
                        url: "{{ route('transaksi_keuangan.index') }}",
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        data: {id: $(this).val()},
                        success: function (response) {
                            if (response) {
                                let anggota = response.results;
                                namaAnggota = response.results.nama_pemohon;

                                $('#nik').val(anggota.nik);
                                $('#no_mitra').val(anggota.no_mitra);

                                let group = [
                                    {text: 'Simpanan',          children: [] },
                                    {text: 'Simpanan Berjangka',children: [] },
                                    {text: 'Pembiayaan',        children: [] },
                                    {text: 'Pendanaan',         children: [] }
                                ]

                                if (anggota.rekenings != '') {
                                    $.each(anggota.rekenings, function (key, rekening) {
                                        group[0].children.push({
                                            id: rekening.id,
                                            text: rekening.no_akun + ' - ' + rekening.produk.nama_simpanan,
                                            data: rekening
                                        });
                                    });
                                }

                                if (anggota.rekening_simjaka != '') {
                                    $.each(anggota.rekening_simjaka, function (key, rekening) {
                                        group[1].children.push({
                                            id: rekening.id,
                                            text: rekening.no_akun + ' - ' + rekening.produk.nama_simpanan,
                                            data: rekening
                                        });
                                    });
                                }

                                if (anggota.rekening_pembiayaan != '') {
                                    $.each(anggota.rekening_pembiayaan, function (key, rekening) {
                                        group[2].children.push({
                                            id: rekening.id,
                                            text: rekening.no_akun + ' - ' + rekening.produk.nama_pembiayaan,
                                            data: rekening
                                        });
                                    });
                                }
                                if (anggota.rekening_pendanaan != '') {
                                    $.each(anggota.rekening_pendanaan, function (key, rekening) {
                                        group[3].children.push({
                                            id: rekening.id,
                                            text: rekening.no_akun + ' - ' + rekening.pendanaan.nama_pembiayaan,
                                            data: rekening
                                        });
                                    });
                                }
                                let availableRekening = jQuery.grep(group, function(value) {
                                    return value.children.length > 0;
                                });

                                availableRekening.unshift({
                                    id: '',
                                    text: '',
                                })
                                $('#akun_id').empty().select2({
                                    data: availableRekening
                                })

                            } else {
                                clearAnggotaInfo();
                            }
                        }
                    });
                } else {
                    clearAnggotaInfo();
                }
            });


            $('#akun_id').on('change', function() {

                clearRekeningData();

                let selected = $(this).select2('data');
                let selectedRekening = selected[0].data;
                globalRekening = selected[0].data;
                // console.log("Selected Rekening : " + JSON.stringify(selectedRekening));

                if (selectedRekening) {
                    $('#no_rekening').val(selectedRekening.no_akun);
                    $('#saldo').val(selectedRekening.saldo);

                    if (selectedRekening.rekening_type === 'App\\Models\\RekeningSimpanan') {
                        setJenisTransaksi('simpanan', selectedRekening.status);

                    } else if (selectedRekening.rekening_type === 'App\\Models\\RekeningSimjaka') {
                        setJenisTransaksi('simjaka', selectedRekening.status);

                    } else if (selectedRekening.rekening_type === 'App\\Models\\RekeningPembiayaan') {
                        setJenisTransaksi('pembiayaan', selectedRekening.status);

                        $('.pembiayaan_info_field').show(300);
                        $('#angsuran_pokok').val(selectedRekening.angsuran_pokok);
                        $('#angsuran_margin').val(selectedRekening.angsuran_margin);
                        $('#kewajiban_angsuran').val(selectedRekening.kewajiban_angsuran);
                        $('#sisa_pembiayaan').val(selectedRekening.saldo);

                    } else if (selectedRekening.rekening_type === 'App\\Models\\RekeningPendanaan') {
                        setJenisTransaksi('pendanaan', selectedRekening.status);

                        $('.pembiayaan_info_field').show(300);
                        $('#angsuran_pokok').val('-');
                        $('#angsuran_margin').val('-');
                        $('#kewajiban_angsuran').val(selectedRekening.pendanaan.angsuran_bulanan);
                        $('#sisa_pembiayaan').val(selectedRekening.saldo);
                    }
                } else {
                    clearRekeningData();
                }
            });


            $('#jenis_transaksi').on('change', function() {
                let temp = $(this).select2('data');

                let data = temp[0].transaksi;
                let namaProduk = '';

                if (data.macam_transaksi == 'simpanan' || data.macam_transaksi == 'simpananberjangka' || data.macam_transaksi == 'simjaka') {

                    $('.margin_pokok_field').hide(200);
                    $('#margin').val('');
                    $('#pokok').val('');
                    $('#nominal').prop('readonly', false);

                    namaProduk = globalRekening.produk.nama_simpanan ?? '';

                    if (globalRekening.status == 'disetujui') {
                        $('#nominal').val(globalRekening.nilai_setoran ?? 0);
                    }

                    $('#pokok, #margin').off();

                } else if (data.macam_transaksi == 'pendanaan') {

                    $('.margin_pokok_field').hide(200);
                    $('#margin').val('');
                    $('#pokok').val('');
                    $('#nominal').prop('readonly', false);
                    $('#nominal').val(globalRekening.pendanaan.angsuran_bulanan);

                    namaProduk = globalRekening.pendanaan.nama_pembiayaan ?? '';


                    $('#pokok, #margin').off();

                }else if (data.macam_transaksi == 'pembiayaan') {

                    if (data.kredit == 'on') {
                        // Pencairan Pembiayaan
                        $('.margin_pokok_field').hide(200);
                        $('#margin').val('');
                        $('#pokok').val('');
                        $('#nominal').prop('readonly', true);
                        $('#nominal').val(globalRekening.harga_pokok);

                        $('#pokok, #margin').off();

                    } else {
                        // Pembayaran Cicilan
                        $('.margin_pokok_field').show(200);
                        $('#margin').val(globalRekening.angsuran_margin);
                        $('#pokok').val(globalRekening.angsuran_pokok);
                        $('#nominal').val(globalRekening.kewajiban_angsuran);
                        $('#nominal').prop('readonly', true);

                        $('#pokok, #margin').on('change keyup', function () {
                            $('#nominal').val(parseFloat($('#pokok').inputmask("unmaskedvalue")) + parseFloat($('#margin').inputmask("unmaskedvalue")));
                        });
                    }

                    namaProduk = globalRekening.produk.nama_pembiayaan ?? '';

                }

                setDescription(data.jenis_transaksi, namaProduk);
                // $('#description').val(data.jenis_transaksi + '\n' + $('#description').val());
            });


            function setDescription(jenisTransaksi, produk) {
                $('#description').val('');

                let gen = jenisTransaksi + ' ' + produk + ' ' + globalRekening.no_akun + ' - ' + namaAnggota;
                $('#description').val(gen);
                $('.keterangan').val($('#description').val());
            }

            function setJenisTransaksi(type, status) {
                if (type) {
                    $.ajax({
                        url: "{{ route('jenis_transaksi.index') }}",
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        data: { jenis: type },
                        success: function (response) {

                            // TODO: Letak semua rekening control disini -Arrave
                            if (response.results) {
                                let setorTunaiSahaja = $.grep(response.results, function (element, index) {
                                    return element.kredit == 'off';
                                });
                                setorTunaiSahaja = setorTunaiSahaja.map((transaksi, i) => {
                                    return {
                                        id: transaksi.id,
                                        text: transaksi.jenis_transaksi,
                                        transaksi: transaksi
                                    }
                                });

                                // for dropping too
                                let tarikTunaiSahaja = $.grep(response.results, function (element, index) {
                                    return element.kredit == 'on';
                                });
                                tarikTunaiSahaja = tarikTunaiSahaja.map((transaksi, i) => {
                                    return {
                                        id: transaksi.id,
                                        text: transaksi.jenis_transaksi,
                                        transaksi: transaksi
                                    }
                                });

                                let semuaTransaksi = response.results.map((transaksi, i) => {
                                    return {
                                        id: transaksi.id,
                                        text: transaksi.jenis_transaksi,
                                        transaksi: transaksi
                                    }
                                });

                                // console.log("Transaksi Setor tunai sahaja :" + JSON.stringify(setorTunaiSahaja));
                                // console.log("tarikTunaiSahaja sahaja :" + JSON.stringify(tarikTunaiSahaja));
                                // console.log("semuaTransaksi sahaja :" + JSON.stringify(semuaTransaksi));

                                if (type == 'simpanan') {
                                    if (status == 'disetujui') {
                                        $('#jenis_transaksi').empty().select2({
                                            data: setorTunaiSahaja,
                                        });
                                        $('#jenis_transaksi').trigger('change');
                                    } else {
                                        $('#jenis_transaksi').empty().select2({
                                            data: semuaTransaksi,
                                        });
                                        $('#jenis_transaksi').trigger('change');
                                    }

                                } else if (type == 'simjaka') {
                                    if (status == 'disetujui') {
                                        $('#jenis_transaksi').empty().select2({
                                            data: setorTunaiSahaja,
                                        });
                                        $('#jenis_transaksi').trigger('change');
                                    } else {
                                        $('#jenis_transaksi').empty().select2({
                                            data: semuaTransaksi,
                                        });
                                        $('#jenis_transaksi').trigger('change');
                                    }

                                } else if (type == 'pembiayaan') {
                                    if (status == 'disetujui') {
                                        $('#jenis_transaksi').empty().select2({
                                            data: tarikTunaiSahaja, //dropping
                                        });
                                        $('#jenis_transaksi').trigger('change');
                                    } else {
                                        $('#jenis_transaksi').empty().select2({
                                            data: setorTunaiSahaja,
                                        });
                                        $('#jenis_transaksi').trigger('change');
                                    }

                                } else if (type == 'pendanaan') {
                                    if (status == 'disetujui') {
                                        $('#jenis_transaksi').empty().select2({
                                            data: tarikTunaiSahaja, //dropping
                                        });
                                        $('#jenis_transaksi').trigger('change');
                                    } else {
                                        $('#jenis_transaksi').empty().select2({
                                            data: setorTunaiSahaja,
                                        });
                                        $('#jenis_transaksi').trigger('change');
                                    }
                                }
                            } else {
                                return null;
                            }
                        }
                    });
                } else {
                    return null;
                }
            }

            function clearAnggotaInfo() {
                $('#nik').val('');
                $('#no_mitra').val('');
                $('#akun_id').empty();
            }

            function clearRekeningData() {
                $('.pembiayaan_info_field').hide(200);
                $('#angsuran_pokok').val('');
                $('#angsuran_margin').val('');
                $('#kewajiban_angsuran').val('');
                $('#sisa_pembiayaan').val('');
                $('#no_rekening').val('');
                $('#saldo').val('');

                $('#nominal').val(0);
            }


            $('.input_nominal').inputmask({
                min: 0,
                // max: infinite
            });

            $(".nominal").inputmask('decimal', {
                'alias': 'numeric',
                'groupSeparator': ',',
                'autoGroup': true,
                'digits': 2,
                'radixPoint': ".",
                // 'digitsOptional': false,
                'allowMinus': false,
                'placeholder': '0.00',
            });


        });
    </script>
@endpush
