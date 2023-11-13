@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Rekening Simpanan Berjangka') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('rekening.simjaka.index') }}">{{ __('Rekening Simpanan Berjangka') }}</a>
        </li>
        <li class="breadcrumb-item">
            @if (!empty($rekening->id))
                {{ __('Lihat Rekening Simpanan Berjangka') }}
            @else
                {{ __('Tambah Rekening Simpanan Berjangka') }}
            @endif
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                @if (!empty($rekening->id))
                    <h5 class="card-header">{{ __('Informasi Rekening Simpanan Berjangka') }}</h5>
                @else
                    <h5 class="card-header">{{ __('Pengajuan Rekening Simpanan Berjangka') }}</h5>
                @endif

                <form id="form_simjaka"  autocomplete="off" method="POST" class="form-horizontal" action="{{ !empty($rekening->id) ? route('rekening.simjaka.update', [$rekening]) : route('rekening.simjaka.store') }}">
                    @if (!empty($rekening->id))
                        @method('PUT')
                    @endif

                    <input id="aro_value" name="aro" value="1" hidden>

                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                	<div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label form-label" for="anggota_id">{{ __('Nama Anggota') }}<span
                                                    class="text-danger">*</span></label>
                                            <select id="anggota_id" name="anggota_id" class="form-control select2" data-placeholder="Pilih nama anggota.." data-allow-clear="true" {{ !empty($rekening->id) ? 'disabled' : '' }} >
                                                <option value="">Pilih Nama Anggota</option>
                                                @foreach ($daftarAnggota as $i => $anggota)
                                                <option value="{{ $anggota->id }}" {{ !empty($rekening->id) && $rekening->anggota->id == $anggota->id ? 'selected' : '' }} >{{ $anggota->nama_pemohon ?? '-' }}</option>
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

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label form-label" for="pilihan_akad">{{ __('Akad') }}<span
                                                    class="text-danger">*</span></label>
                                            <select id="pilihan_akad" name="pilihan_akad" class="form-control select2" data-placeholder="Pilih akad..." {{ !empty($rekening) ? 'disabled' : ''}}>
                                                <option value="">Pilih Akad</option>
                                                @foreach($akadList as $akad)
                                                    <option value="{{$akad->id}}" {{ !empty($rekening->id) && $rekening->pilihan_akad == $akad->id ? 'selected' : '' }}>{{ $akad->nama_akad }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label form-label" for="produk_id">{{ __('Produk') }}<span
                                                    class="text-danger">*</span></label>
                                            <select id="produk_id" name="produk_id" class="form-control select2" data-placeholder="Pilih produk..."  {{ !empty($rekening) ? 'disabled' : ''}} required>
                                                <option value="">Pilih Produk</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                @if (Route::getCurrentRoute()->getName() == 'rekening.simjaka.approve')
                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-6" >
                                                <label class="control-label form-label" for="Nilai Setoran">{{ __('Nilai Setoran') }}</label>
                                                <input type="text" id="nilai_setoran" name="nilai_setoran" class="form-control nominal" {{ empty($rekening) ? 'readonly' : '' }} disabled>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="control-label form-label" for="nisbah_anggota">{{ __('Nisbah Anggota') }} (%)</label>
                                                <input type="text" id="nisbah_anggota" name="nisbah_hasil_1" class="form-control"   onkeypress="return isNumberKey(event)"disabled
                                                >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="control-label form-label" for="nisbah_koperasi">{{ __('Nisbah Koperasi') }} (%)</label>
                                                <input type="text" id="nisbah_koperasi" name="nisbah_hasil_2" readonly class="form-control"disabled
                                                       onkeypress="return isNumberKey(event)"
                                                >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="control-label form-label" for="tanggal_mulai">{{ __('Tanggal Mulai') }}</label>
                                                <input class="form-control" id="tanggal_mulai"disabled name="tanggal_aktif" type="date" {{ !empty($rekening) ? 'readonly' : 'readonly'}} value="{{!empty($rekening->tanggal_mulai) ? $rekening->tanggal_mulai : ''}}"/>
                                            </div>
                                            <div class="col-md-4    ">
                                                <label class="control-label form-label" for="jangka_waktu">{{ __('Jangka Waktu (bulan)') }}</label>
                                                <input type="text" id="jangka_waktu"disabled name="jangka_waktu" readonly class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="control-label form-label" for="tanggal_jatuh_tempo">{{ __('Tanggal Jatuh Tempo') }}</label>
                                                <input type="date" id="tanggal_jatuh_tempo"disabled name="tanggal_jatuh_tempo" readonly class="form-control" {{ !empty($rekening) ? '' : 'readonly'}} value="{{ !empty($rekening->tanggal_jatuh_tempo) ?  date('d/m/y', strtotime($rekening->tanggal_jatuh_tempo)) : ''}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="control-label form-label" for="rekening_basil">{{ __('Rek. Pencairan/Penerima Bagi Hasil') }}</label>
                                                <select id="rekening_basil" name="rek_transfer_basil" class="form-control select2"disabled data-placeholder="Pilih pencairan / penerima bagi hasil..." data-allow-clear="true">
                                                    <option value=""></option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-label">ARO</div>
                                                <label class="custom-switch">
                                                    <input type="checkbox" id="aro_switch" class="custom-switch-input" disabled {{ !empty($rekening) ? ($rekening->aro == 1 ? 'checked' : 'unchecked') : 'unchecked' }} >
                                                    <span class="custom-switch-indicator"></span>
                                                    <span id="aro_label" class="custom-switch-description">{{ !empty($rekening) ? ($rekening->aro == 1 ? 'YA' : 'TIDAK') : 'TIDAK' }}</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                @else
                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-6" hidden>
                                                <label class="control-label form-label" for="Nilai Setoran">{{ __('Nilai Setoran') }}</label>
                                                <input type="text" id="nilai_setoran" name="nilai_setoran" class="form-control nominal" {{ empty($rekening) ? 'readonly' : '' }}>
                                            </div>
                                            <div class="col-md-4    ">
                                                <label class="control-label form-label" for="jangka_waktu">{{ __('Jangka Waktu (bulan)') }}</label>
                                                <input type="text" id="jangka_waktu" name="jangka_waktu" readonly class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="control-label form-label" for="nisbah_anggota">{{ __('Nisbah Anggota') }} (%)</label>
                                                <input type="text" id="nisbah_anggota" name="nisbah_hasil_1" class="form-control"   onkeypress="return isNumberKey(event)"
                                                >
                                            </div>
                                            <div class="col-md-4">
                                                <label class="control-label form-label" for="nisbah_koperasi">{{ __('Nisbah Koperasi') }} (%)</label>
                                                <input type="text" id="nisbah_koperasi" name="nisbah_hasil_2" readonly class="form-control"
                                                       onkeypress="return isNumberKey(event)"
                                                >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="control-label form-label" for="tanggal_mulai">{{ __('Tanggal Mulai') }}</label>
                                                <input class="form-control" id="tanggal_mulai" name="tanggal_aktif" type="date" {{ !empty($rekening) ? 'readonly' : 'readonly'}} value="{{!empty($rekening->tanggal_mulai) ? $rekening->tanggal_mulai : ''}}"/>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="control-label form-label" for="tanggal_jatuh_tempo">{{ __('Tanggal Jatuh Tempo') }}</label>
                                                <input type="date" id="tanggal_jatuh_tempo" name="tanggal_jatuh_tempo" readonly class="form-control" {{ !empty($rekening) ? '' : 'readonly'}} value="{{ !empty($rekening->tanggal_jatuh_tempo) ?  date('d/m/y', strtotime($rekening->tanggal_jatuh_tempo)) : ''}}">
                                            </div>

                                                    <div class="col-md-4">
                                                        <label class="control-label form-label" for="ao_id">{{ __('Akun Officer') }}</label>
                                                        <select class="form-select" name="ao_id" id="ao_id" data-placeholder="Pilih AO.." data-minimum-results-for-search="10" data-allow-clear="true" data-search="true" data-ajax--url="{{ route('akun-officer.index') }}" data-ajax--data-type="json"
                                                            {{ Route::getCurrentRoute()->getName() == 'rekening.simjaka.approve' ? 'disabled' : ''}}>
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="control-label form-label" for="rekening_basil">{{ __('Rek. Pencairan/Penerima Bagi Hasil') }}</label>
                                                <select id="rekening_basil" name="rek_transfer_basil" class="form-control select2" data-placeholder="Pilih pencairan / penerima bagi hasil..." data-allow-clear="true">
{{--                                                    <option value=""></option>--}}
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-label">ARO</div>
                                                <label class="custom-switch">
                                                    <input type="checkbox" id="aro_switch" class="custom-switch-input" {{ !empty($rekening) ? ($rekening->aro == 1 ? 'checked' : 'unchecked') : 'checked' }}>
                                                    <span class="custom-switch-indicator"></span>
                                                    <span id="aro_label" class="custom-switch-description">{{ !empty($rekening) ? ($rekening->aro == 1 ? 'YA' : 'TIDAK') : 'YA' }}</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @endif


                                @if (Route::getCurrentRoute()->getName() == 'rekening.simjaka.approve')

                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="control-label form-label" for="tujuan_pengajuan">{{ __('Tujuan Pengajuan') }}</label>
                                                <select id="tujuan_pengajuan" name="tujuan_pengajuan" class="form-control select2" data-placeholder="Pilih tujuan pengajuan..." disabled>
                                                    <option value=""></option>
                                                    @foreach($tujuanList as $tujuan)
                                                        <option value="{{$tujuan->id}}" {{ !empty($rekening->id) && $rekening->tujuan_pengajuan == $tujuan->id ? 'selected' : '' }}>{{$tujuan->nama_tujuan_pengajuan}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="control-label form-label" for="sumber_dana">{{ __('Sumber Dana') }}</label>
                                                <select id="sumber_dana" name="sumber_dana" class="form-control select2" data-placeholder="Pilih sumber dana..."disabled>
                                                    <option value=""></option>
                                                    @foreach($sumberDana as $sumber)
                                                        <option value="{{$sumber->id}}" {{ !empty($rekening->id) && $rekening->sumber_dana == $sumber->id ? 'selected' : '' }} >{{$sumber->nama_sumber_dana}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="control-label form-label" for="tujuan_pengajuan">{{ __('Tujuan Pengajuan') }}<span
                                                        class="text-danger">*</span></label>
                                                <select id="tujuan_pengajuan" name="tujuan_pengajuan" class="form-control select2" data-placeholder="Pilih tujuan pengajuan...">
                                                    <option value=""></option>
                                                    @foreach($tujuanList as $tujuan)
                                                        <option value="{{$tujuan->id}}" {{ !empty($rekening->id) && $rekening->tujuan_pengajuan == $tujuan->id ? 'selected' : '' }}>{{$tujuan->nama_tujuan_pengajuan}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="control-label form-label" for="sumber_dana">{{ __('Sumber Dana') }}<span
                                                        class="text-danger">*</span></label>
                                                <select id="sumber_dana" name="sumber_dana" class="form-control select2" data-placeholder="Pilih sumber dana...">
                                                    <option value=""></option>
                                                    @foreach($sumberDana as $sumber)
                                                        <option value="{{$sumber->id}}" {{ !empty($rekening->id) && $rekening->sumber_dana == $sumber->id ? 'selected' : '' }} >{{$sumber->nama_sumber_dana}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @endif


                            </div>
                        </div>
                    </div>

                    @if(!empty($rekening->id))
                        <input id="status_value" name="status" value="{{ $rekening->status }}" hidden>
                    @endif

                    @if (Route::getCurrentRoute()->getName() == 'rekening.simjaka.approve')
                    <div class="card-footer border border-top-0 text-center">
                        <button id="approve_btn" class="btn btn-success">{{ __('Setujui Pengajuan') }}</button>
                    	<button id="reject_btn"  class="btn btn-danger" >{{ __('Tolak Pengajuan') }}</button>
                    </div>
                    @else
                    <div class="card-footer border border-top-0 text-right">
                    	<a href="{{ route('rekening.simjaka.index') }}"  class="btn btn-danger" >{{ __('Kembali') }}</a>
                        @if(!isset($viewMode))
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmationModal">
                                {{ __('Kirim') }}
                            </button>
                        @endif
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade zoom" tabindex="-1" id="confirmationModal">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <center> <i class="fe fe-alert-circle fa-4x" style="color: red;"></i></center>
                    <br>
                    <center><h2>Notifikasi</h2></center>
                    <p style="text-align: center;font-size: 15px">Adakah Anda Ingin Melanjutkan Proses Ini ? </p>
                    <div class="text-center">
                        <a href="#" class="btn btn-md btn-primary mr-3" id="confirmBtn">
                            Lanjutkan
                        </a>
                        <a data-dismiss="modal" href="#" class="btn btn-md btn-danger">
                            Tidak
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>

</script>


@if (!empty($rekening->id))
<script>

    function clearField() {
        console.log("Cleared Data ");
        $('#produk_id').empty();
        $('#nilai_setoran').val('');
        $('#tanggal_mulai').val('');
        $('#jangka_waktu').val('');
        $('#tanggal_jatuh_tempo').val('');

        // $('#tujuan_pengajuan').val(null).trigger('change');
        // $('#sumber_dana').val(null).trigger('change');
        $('#rekening_basil').val(null).trigger('change');
    }
    $(document).ready(function() {

        $('#confirmBtn').on('click', function() {
            var anggota_id = document.forms["form_simjaka"]["anggota_id"];
            var pilihan_akad = document.forms["form_simjaka"]["pilihan_akad"];
            var produk_id = document.forms["form_simjaka"]["produk_id"];
            var tujuan_pengajuan = document.forms["form_simjaka"]["tujuan_pengajuan"];
            var sumber_dana = document.forms["form_simjaka"]["sumber_dana"];

            if (anggota_id.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Anggota wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (pilihan_akad.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Akad wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (produk_id.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Produk wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (tujuan_pengajuan.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Tujuan Pengajuan wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (sumber_dana.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Sumber Dana wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }

            $('#form_simjaka').submit();
        });
        $('#anggota_id').trigger('change');

        // load produk name
        let produkSelect = $('#produk_id');
        let prodOption = new Option('{{ $rekening->produk->nama_simpanan ?? '' }}', '{{ $rekening->produk->id ?? '' }}', true, true);
        produkSelect.append(prodOption);

        let rekSelect = $('#rekening_basil');
        let rekOption = new Option('{{ $rekening->rekening_basil->no_akun ?? '' }} - {{ $rekening->rekening_basil->produk->nama_simpanan ?? '' }}', '{{ $rekening->rek_transfer_basil ?? '' }}', true);
        rekSelect.append(rekOption);


        let AOSelect = $('#ao_id');
        let AoOption = new Option('{{ $rekening->akunOfficer->nama ?? '' }}', '{{ $rekening->akunOfficer->id ?? '' }}', true, true);
        AOSelect.append(AoOption).trigger('change');
        // AOSelect.trigger({
        //     type: 'select2:select',
        // });

        $('#nilai_setoran').val('{{ $rekening->nilai_setoran }}');
        $('#nisbah_anggota').val('{{ $rekening->nisbah_hasil_1 ?? 0}}');
        $('#nisbah_koperasi').val('{{ $rekening->nisbah_hasil_2 ?? 0}}');
        $('#tanggal_mulai').val('{{ date("Y-m-d", strtotime($rekening->tanggal_aktif))  }}');
        $('#jangka_waktu').val('{{ $rekening->jangka_waktu }}');
        $('#tanggal_jatuh_tempo').val('{{ date('Y-m-d', strtotime($rekening->tanggal_jatuh_tempo) ) }}');
        $('#rekening_basil').val('{{ $rekening->rek_transfer_basil}}');

        // $('#tanggal_mulai').on('change', function() {
        //     let val = $(this).val();
        //     let myMomentObject = moment(val, 'YYYY-MM-DD');
        //     let tanggal_jatuh_tempo = myMomentObject.add('{{ $rekening->jangka_waktu }}', 'months');
        //     $('#tanggal_jatuh_tempo').val(tanggal_jatuh_tempo.format('YYYY-MM-DD'));
        // });

    });

    function clearField() {
        console.log("Cleared Data ");
        $('#produk_id').empty();
        $('#nilai_setoran').val('');
        $('#tanggal_mulai').val('');
        $('#jangka_waktu').val('');
        $('#tanggal_jatuh_tempo').val('');

        // $('#tujuan_pengajuan').val(null).trigger('change');
        // $('#sumber_dana').val(null).trigger('change');
        $('#rekening_basil').val(null).trigger('change');
    }


</script>
@else
    <script>
        $('#confirmBtn').on('click', function() {
            var anggota_id = document.forms["form_simjaka"]["anggota_id"];
            var pilihan_akad = document.forms["form_simjaka"]["pilihan_akad"];
            var produk_id = document.forms["form_simjaka"]["produk_id"];
            var tujuan_pengajuan = document.forms["form_simjaka"]["tujuan_pengajuan"];
            var sumber_dana = document.forms["form_simjaka"]["sumber_dana"];

            if (anggota_id.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Anggota wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (pilihan_akad.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Akad wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (produk_id.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Produk wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (tujuan_pengajuan.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Tujuan Pengajuan wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }
            if (sumber_dana.value == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Kolom Sumber Dana wajib diisi!',
                });
                $('#confirmationModal').modal('hide');

                return false;
            }

            $('#form_simjaka').submit();
        });
        $('#anggota_id').on('change', function() {
            clearField();


            if ($(this).val() != '') {
                $.ajax({
                    url: "{{ route('anggota.index') }}",
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: { id: $(this).val() },
                    success: function(response) {
                        console.log(response)
                        if (response.results != '') {
                            $('#nik').val(response.results.nik);
                            $('#no_mitra').val(response.results.no_mitra);



                            //dropdown rekening
                            $('#rekening_basil').html('');
                            $('#rekening_basil').append('<option value=""></option>');
                            $.each(response.rekening, function(key, value) {
                                $('#rekening_basil').append('<option value="' + value.id + '">' + value.no_akun + ' - ' + value.produk.nama_simpanan + '</option>');
                            });
                            let res = response.results.rekenings.map((rekening, i) => {
                                if (rekening.status == 'aktif') {
                                    return {
                                        id: rekening.id,
                                        text: rekening.no_akun + " - " + rekening.produk.nama_simpanan,
                                        rekening: rekening
                                    }
                                }
                            });
                            let emptyData = [{
                                'id': '0',
                                'text': 'tidak ada rekening',
                                'rekening': ''
                            }]

                        }
                    },
                });
            }

        });

        let tanggal_hari_ini = moment().format('YYYY-MM-DD');
        $(document).ready(function() {
            $('select').select2();


            $('#pilihan_akad').on('change', function() {
                clearField();

                var akadId = $(this).val();
                var anggotaId = $('#anggota_id').val();
                if(akadId) {
                    $.ajax({
                        url: "{{ route('produk-simpanan-berjangka.index') }}",
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        data: { akad_id: $(this).val(),
                            anggota_id: $('#anggota_id').val() },
                        success: function(response) {
                            console.log(response);
                            if (response.results != '') {

                                let res = response.results.map((produk, i) => {
                                    return {
                                        id: produk.id,
                                        text: produk.nama_simpanan,
                                        produk: produk
                                    }
                                });

                                let emptyData = [{
                                    'id': '0',
                                    'text': 'tidak ada produk',
                                    'produk': ''
                                }]
                                if (jQuery.isEmptyObject(res)) {
                                    // Assign fake data if produk not exist
                                    // this is needed to avoid error - Arrave 2/2/21
                                    $('#produk_id').empty().select2({
                                        data: emptyData,
                                    });
                                    $('#produk_id').trigger('change');

                                } else {
                                    $('#produk_id').empty().select2({
                                        data: res,
                                    });
                                    $('#produk_id').trigger('change');
                                }
                            }else{
                                // console.log("DATA TAKDA");
                            }
                            if(response.simpanan != ''){
                                let res = response.simpanan.map((simpanan, i) => {
                                    return {
                                        id: simpanan.id,
                                        text: simpanan.no_akun + " - " + simpanan.produk.nama_simpanan,
                                        simpanan: simpanan
                                    }
                                });
                                $('#rekening_basil').empty().select2({
                                    data: res,
                                });
                                $('#rekening_basil').trigger('change');


                            }
                        },
                    });
                }else{
                    $('#produk_id').empty();
                    $('#pilihan_akad').empty();
                    $('#nilai_setoran').val();
                }
            });

            $('#produk_id').on('change', function() {
                let data = $(this).select2('data');

                $('#nilai_setoran').val(data[0].produk.storan_minimal);
                $('#nisbah_koperasi').val(data[0].produk.nisbah_koperasi ?? 0);
                $('#nisbah_anggota').val(data[0].produk.nisbah_anggota ?? 0);
                $('#jangka_waktu').val(data[0].produk.jangka_waktu);

                let tanggal_buka = moment(tanggal_hari_ini, 'YYYY-MM-DD');
                let tanggal_jatuh_tempo = tanggal_buka.add(parseInt(data[0].produk.jangka_waktu), 'months');
                $('#tanggal_mulai').val(moment().format('YYYY-MM-DD'));
                console.log(tanggal_jatuh_tempo)
                $('#tanggal_jatuh_tempo').val(tanggal_jatuh_tempo.format('YYYY-MM-DD'));
            });

            $('#aro_switch').on('click', function() {
                if ($(this).prop("checked") == true) {
                    $('#aro_value').val('1');
                    $('#aro_label').text('YA');
                    console.log("status aro : " + $('#aro_value').val());

                } else if ($(this).prop("checked") == false) {
                    $('#aro_value').val('0');
                    $('#aro_label').text('TIDAK');
                    console.log("status aro : " + $('#aro_value').val());
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

            $('#approve_btn').on('click', function(e) {
                e.preventDefault();
                $('#status_value').val('{{ \App\Models\RekeningSimpanan::STATUS_APPROVED }}');
                $('#form_simjaka').submit();
            });
            $('#reject_btn').on('click', function(e) {
                e.preventDefault();
                $('#status_value').val('{{ \App\Models\RekeningSimpanan::STATUS_REJECTED }}');
                $('#form_simjaka').submit();
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
                'removeMaskOnSubmit': true,
                'rightAlign': false,
            });




        });
        console.log("Cleared Data ");
        $('#produk_id').empty();
        $('#nilai_setoran').val('');
        $('#tanggal_mulai').val('');
        $('#jangka_waktu').val('');
        $('#tanggal_jatuh_tempo').val('');
        // $('#tujuan_pengajuan').val(null).trigger('change');
        // $('#sumber_dana').val(null).trigger('change');
        $('#rekening_basil').val(null).trigger('change');

        function clearField() {
            console.log("Cleared Data ");
            $('#produk_id').empty();
            $('#nilai_setoran').val('');
            $('#tanggal_mulai').val('');
            $('#jangka_waktu').val('');
            $('#tanggal_jatuh_tempo').val('');

            // $('#tujuan_pengajuan').val(null).trigger('change');
            // $('#sumber_dana').val(null).trigger('change');
            $('#rekening_basil').val(null).trigger('change');
        }
    </script>
@endif

@endpush
