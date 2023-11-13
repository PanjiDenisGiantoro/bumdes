@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Rekening Simpanan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('rekening-simpanan.index') }}">{{ __('Rekening Simpanan') }}</a>
        </li>
        <li class="breadcrumb-item">
            @if (!empty($rekening_simpanan->id))
                {{ __('Lihat Rekening Simpanan') }}

            @else
                {{ __('Daftar Rekening Simpanan') }}

            @endif

        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                @if (!empty($rekening_simpanan->id))
                    <h5 class="card-header">{{ __('Informasi Rekening Simpanan') }}</h5>

                @else
                    <h5 class="card-header">{{ __('Pengajuan Rekening Simpanan') }}</h5>

                @endif


                <form id="form_simpanan" autocomplete="off" method="POST" class="form-horizontal"
                      action="{{ !empty($rekening_simpanan->id) ? route('rekening-simpanan.update', [$rekening_simpanan]) : route('rekening-simpanan.store') }}">

                    @if (!empty($rekening_simpanan->id))
                        @method('PUT')
                    @endif

                    @csrf

                    {{-- <input type="text" name="no_akun" hidden--}}
                    {{-- value="{{$auto->head??''}}/@if(empty($auto->format_depan))@else{{date($auto->format_depan)}}/@endif @if(empty($auto->format_tengah))@else{{date($auto->format_tengah)}}/@endif @if(empty($auto->format_belakang))@else{{date($auto->format_belakang)}}/@endif{{$count}}"--}}
                    {{-- >--}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label class="control-label form-label"
                                                   for="anggota_id">{{ __('Nama Anggota') }}<span
                                                    class="text-danger">*</span>
                                            </label>
                                            @if(!empty($rekening_simpanan->id))
                                                <input type="text" class="form-control"
                                                       value="{{ $rekening_simpanan->anggota->nama_pemohon ?? '' }}"
                                                       readonly>
                                            @else
                                                <select id="anggota_id" name="anggota_id" class="form-control">
                                                    @if (!empty($anggotaList))
                                                        <option value="">Pilih anggota...</option>
                                                        @foreach ($anggotaList as $i => $anggota)
                                                            <option
                                                                value="{{ $anggota->id }}">{{ $anggota->nama_pemohon .' - '. $anggota->no_mitra ?? '-' }}</option>
                                                        @endforeach
                                                    @else
                                                        <option
                                                            value="{{ $rekening_
->id }}">{{ $rekening_simpanan->anggota->nama_pemohon }}</option>
                                                    @endif
                                                    @endif
                                                </select>
                                        </div>

                                        @if(!empty($rekening_simpanan->id))
                                            <div class="col-md-3">
                                                <label class="control-label form-label"
                                                       for="nik">{{ __('NIK') }}</label>
                                                <input id="nik" type="text" class="form-control" readonly
                                                       value="{{ $rekening_simpanan->anggota->nik }}"/>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label form-label"
                                                       for="no_anggota">{{ __('No. Anggota') }}</label>
                                                <input id="no_mitra" type="text" class="form-control"
                                                       value={{ $rekening_simpanan->anggota->no_mitra }} readonly/>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label form-label"
                                                       for="no_anggota">{{ __('Tgl Daftar') }}</label>
                                                <input type="text" class="form-control"
                                                       value="{{ date('d-m-Y', strtotime($rekening_simpanan->created_at)) }}"
                                                       readonly/>
                                            </div>
                                        @else
                                            <div class="col-md-4">
                                                <label class="control-label form-label"
                                                       for="nik">{{ __('NIK') }}</label>
                                                <input id="nik" type="text" class="form-control" readonly/>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="control-label form-label"
                                                       for="no_anggota">{{ __('No. Anggota') }}</label>
                                                <input id="no_mitra" type="text" class="form-control" readonly/>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label form-label" for="pilihan_akad">{{ __('Akad') }}
                                                <span class="text-danger">*</span></label>
                                            @if(!empty($rekening_simpanan->id))
                                                <input type="text" class="form-control"
                                                       value="{{$rekening_simpanan->akads->nama_akad ?? ''}}" readonly>
                                            @else
                                                <select id="pilihan_akad" name="pilihan_akad" class="form-control">
                                                    <option value="">Pilih akad...</option>
                                                    @foreach($akadList as $akad)
                                                        <option value="{{$akad->id}}">{{$akad->nama_akad}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label form-label" for="produk_id">{{ __('Produk') }}
                                                <span class="text-danger">*</span></label>
                                            @if(!empty($rekening_simpanan->id))
                                                <input type="text" class="form-control"
                                                       value="{{$rekening_simpanan->produk->nama_simpanan ?? ''}}"
                                                       readonly>
                                            @else
                                                <select id="produk_id" name="produk_id" class="form-control select2"
                                                        required {{ !empty($rekening_simpanan) ? 'disabled' : ''}}>
                                                    <option value="">Pilih produk...</option>
                                                    @if (!empty($produkList))
                                                        @foreach ($produkList as $i => $produk)
                                                            <option
                                                                value="{{ $produk->id }}">{{ $produk->nama_simpanan ?? '-' }}</option>
                                                        @endforeach
                                                    @endif
                                                    @endif

                                                </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                    {{-- @if (empty($rekening_simpanan->status_aktif == 'aktif' || 'tidak aktif')) --}}
                                    {{-- @if(empty($rekening_simpanan->status == 'disetujui')) --}}
                                    {{-- @if(empty($rekening_simpanan->id)) --}}
                                    <!-- <div class="col-md-6">
                                        <label class="control-label form-label" for="nilai_setoran">{{ __('Nilai Setoran') }}</label>
                                        <input id="nilai_setoran" type="text" class="form-control" name="nilai_setoran" required value="{{ $rekening_simpanan->nilai_setoran ?? '' }}">
                                    </div> -->
                                        {{-- @else
                                        @endif --}}
                                        {{-- <div class="col-md-6">
                                                <label class="control-label form-label" for="Nilai Setoran">{{ __('Nilai Setoran') }}</label> --}}
                                        {{-- <input type="text" name="nilai_setoran" id="nilai_setoran" class="form-control">--}}
                                        {{-- <input type="text" id="nilai_setoran" name="nilai_setoran" readonly class="form-control"required {{ !empty($rekening_pembiayaan) ? 'disabled' : ''}}>

                                    </div> --}}
                                        {{-- @endif --}}
                                    </div>
                                </div>


                                @if (Route::getCurrentRoute()->getName() == 'rekening-simpanan.approve')
                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="control-label form-label"
                                                       for="tujuan_pengajuan">{{ __('Tujuan Pengajuan') }}</label>
                                                <select id="tujuan_pengajuan" name="tujuan_pengajuan"
                                                        class="form-control select2" disabled>
                                                    <option value="">Pilih tujuan pengajuan...</option>
                                                    @foreach($tujuanList as $tujuan)
                                                        <option value="{{$tujuan->id}}"
                                                                @if(@!empty($rekening_simpanan->id) ? $tujuan->id == $rekening_simpanan->tujuan_pengajuan : '' )selected @endif>{{$tujuan->nama_tujuan_pengajuan}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="control-label form-label"
                                                       for="sumber_dana">{{ __('Sumber Dana') }}</label>
                                                <select id="sumber_dana" name="sumber_dana" class="form-control select2"
                                                        disabled>
                                                    <option value="">Pilih sumber dana...</option>
                                                    @foreach($sumber_dana as $sumber)
                                                        <option value="{{$sumber->id}}"
                                                                @if(@!empty($rekening_simpanan->id) ? $sumber->id == $rekening_simpanan->sumber_dana : '' )selected @endif>{{$sumber->nama_sumber_dana}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="control-label form-label"
                                                       for="tujuan_pengajuan">{{ __('Tujuan Pengajuan') }}<span
                                                        class="text-danger">*</span></label>
                                                <select id="tujuan_pengajuan" name="tujuan_pengajuan"
                                                        class="form-control select2">
                                                    <option value="">Pilih tujuan pengajuan...</option>
                                                    @foreach($tujuanList as $tujuan)
                                                        <option value="{{$tujuan->id}}"
                                                                @if(@!empty($rekening_simpanan->id) ? $tujuan->id == $rekening_simpanan->tujuan_pengajuan : '' )selected @endif>{{$tujuan->nama_tujuan_pengajuan}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="control-label form-label"
                                                       for="sumber_dana">{{ __('Sumber Dana') }}<span
                                                        class="text-danger">*</span></label>
                                                <select id="sumber_dana" name="sumber_dana"
                                                        class="form-control select2">
                                                    <option value="">Pilih sumber dana...</option>
                                                    @foreach($sumber_dana as $sumber)
                                                        <option value="{{$sumber->id}}"
                                                                @if(@!empty($rekening_simpanan->id) ? $sumber->id == $rekening_simpanan->sumber_dana : '' )selected @endif>{{$sumber->nama_sumber_dana}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label form-label" for="nilai_setoran">{{ __('Nilai Setoran') }}</label>
                                            <input id="nilai_setoran" type="text" class="form-control" name="nilai_setoran" required {{ !empty($rekening_simpanan) ? 'disabled' : ''}}>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label form-label" for="ao_id">{{ __('Akun Officer') }}</label>
                                            <select class="form-select" name="ao_id" id="ao_id" data-placeholder="Pilih AO.." data-minimum-results-for-search="10" data-allow-clear="true" data-search="true" data-ajax--url="{{ route('akun-officer.index') }}" data-ajax--data-type="json"
                                            {{ Route::getCurrentRoute()->getName() == 'rekening-simpanan.approve' ? 'disabled' : ''}}>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                @if(!empty($rekening_simpanan->id))
                                    <input hidden id="status_value" name="status"
                                           value=" {{ $rekening_simpanan->status}}">
                                @else
                                    <input hidden id="status_value" name="status" value="baru" hidden>
                                @endif
                                @if(!empty($rekening_simpanan->id ))

                                    <input id="status_value_aktif" hidden name="status_aktif"
                                           value="@if($rekening_simpanan->status_aktif != '')aktif @else tidak_aktif @endif">
                                @endif


                            </div>
                        </div>
                    </div>

                    @if (Route::getCurrentRoute()->getName() == 'rekening-simpanan.approve')
                        <div class="card-footer border border-top-0 text-center">
                            <button id="approve_btn" class="btn btn-success">{{ __('Disetujui ') }}</button>
                            <button id="reject_btn" class="btn btn-danger">{{ __('Ditolak ') }}</button>
                        </div>
                    @else
                        <div class="card-footer border border-top-0 text-right">
{{--                            button modal confirm--}}

                            <a href="{{ route('rekening-simpanan.index') }}"
                               class="btn btn-danger">{{ __('Kembali') }}</a>
                            @if(!isset($viewMode))
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmationModal">
                                    {{ __('Kirim') }}
                                </button>
{{--                                <button type="submit"--}}
{{--                                        class="btn btn-primary">{{ !empty($rekening_simpanan->id) ? __('Perbaharui') : __('Kirim') }}</button>--}}
                            @endif
                        </div>
                    @endif


                </form>
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

        </div>
    </div>
@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        {{-- select2 --}}


            $('select').select2();
        $('#anggota_id').on('change', function () {
            $.ajax({
                url: "{{ route('produk-simpanan-berjangka.index') }}",
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {id: $(this).val()},
                success: function (response) {
                    if (response) {
                        console.log(response.results);
                        $('#nik').val(response.results.nik);
                        $('#no_mitra').val(response.results.no_mitra);
                        {{-- $('#tgl_daftar').val(response.results.created_at); --}}
                    }
                },
            });
        });
        $('#pilihan_akad').on('change', function () {
            var akadId = $(this).val();
            if (akadId) {
                $.ajax({
                    url: "{{ route('produk-simpanan.index') }}",
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {id: $(this).val()},
                    success: function (response) {
                        console.log(response)
                        if (response) {
                            $('#produk_id').empty();
                            $('#nilai_setoran').val();
                            $('#produk_id').append('<option value="">Pilih</option>');
// options += '<option value="">&nbsp;</option>';
                            $.each(response, function (key, rekening) {
                                $('#produk_id').append('<option value="' + response[key].id + '">' + response[key].nama_simpanan + '</option>');
                            });
                        } else {
                            $('#produk_id').empty();
                            $('#pilihan_akad').empty();
                            $('#nilai_setoran').val();

                        }
                    },
                });
            } else {
                $('#produk_id').empty();
                $('#pilihan_akad').empty();
                $('#nilai_setoran').val();
            }
        });
        $('#produk_id').on('change', function () {
            var akadId = $(this).val();
            if (akadId) {
                $.ajax({
                    url: "{{ route('rekening-simpanan.getProduk') }}",
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {rekening: $(this).val()},
                    success: function (response) {
                        console.log(response)
                        if (response) {
                            $('#nilai_setoran').empty();

                            $.each(response, function (key, rekening) {

                                $('#nilai_setoran').val(response[key].storan_minimal);
                            });
                        } else {
                            $('#nilai_setoran').empty();
                        }
                    },
                });
            } else {
                $('#nilai_setoran').empty();

            }
        });

        $('#ao_id').on('change', function() {
            console.log("Selected AO :" + $(this).val());
        });


    </script>
    @if (!empty($rekening_simpanan) && $rekening_simpanan->anggota->id)
        <script>
            $(document).ready(function () {
                @if(isset($viewMode))
                // $('input').attr('readonly', 'readonly');
                $('.form-control').attr('disabled', 'disabled');

                $('#status').attr('disabled', 'disabled');
                $('#status_aktif').attr('disabled', 'disabled');


                // $('.form-select').select2({
                //     disabled: true,
                // });
                @endif

                let anggotaSelect = $('#anggota_id');
                let option = new Option('{{ $rekening_simpanan->anggota->nama_pemohon }}', '{{ $rekening_simpanan->anggota->id }}', true, true);
                anggotaSelect.append(option).trigger('change');
                anggotaSelect.trigger({
                    type: 'select2:select'
                    ,
                });
                let akadSelect = $('#pilihan_akad');
                let akadoption = new Option('{{ $rekening_simpanan->akads->nama_akad }}', '{{ $rekening_simpanan->akads->id }}', true, true);
                akadSelect.append(akadoption).trigger('change');
                akadSelect.trigger({
                    type: 'select2:select'
                    ,
                });
                let produkSelect = $('#produk_id');
                let Produkoption = new Option('{{ $rekening_simpanan->produk->nama_simpanan }}', '{{ $rekening_simpanan->produk->id }}', true, true);
                produkSelect.append(Produkoption).trigger('change');
                produkSelect.trigger({
                    type: 'select2:select'
                    ,
                });

                let AOSelect = $('#ao_id');
                let AoOption = new Option('{{ $rekening_simpanan->akunOfficer->nama ?? '' }}', '{{ $rekening_simpanan->akunOfficer->id ?? '' }}', true, true);
                AOSelect.append(AoOption).trigger('change');
                AOSelect.trigger({
                    type: 'select2:select',
                });


                $('#status').on('click', function () {
                    if ($(this).prop("checked") == true) {
                        $('#status_value').val('disetujui');
                        $('#status_label').text('DISETUJUI');

                    } else if ($(this).prop("checked") == false) {
                        $('#status_value').val('tidak_disetujui');
                        $('#status_label').text('TIDAK DISETUJUI');
                    }
                });

                $('#status_aktif').on('click', function () {
                    if ($(this).prop("checked") == true) {
                        $('#status_value_aktif').val('aktif');
                        $('#status_label_aktif').text('AKTIF');

                    } else if ($(this).prop("checked") == false) {
                        $('#status_value_aktif').val('tidak_aktif');
                        $('#status_label_aktif').text('TIDAK AKTIF');
                    }
                });

                $('#approve_btn').on('click', function (e) {
                    e.preventDefault();
                    $('#status_value').val('{{ \App\Models\RekeningSimpanan::STATUS_APPROVED }}');
                    $('#form_simpanan').submit();
                });
                $('#reject_btn').on('click', function (e) {
                    e.preventDefault();
                    $('#status_value').val('{{ \App\Models\RekeningSimpanan::STATUS_REJECTED }}');
                    $('#form_simpanan').submit();
                });


            });

            $('#confirmBtn').on('click', function() {
                var tujuan_pengajuan = document.forms["form_simpanan"]["tujuan_pengajuan"];
                var sumber_dana = document.forms["form_simpanan"]["sumber_dana"];

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

                $('#form_simpanan').submit();
            });
        </script>
    @else
        <script>
            $('#confirmBtn').on('click', function() {
                var anggota_id = document.forms["form_simpanan"]["anggota_id"];
                var pilihan_akad = document.forms["form_simpanan"]["pilihan_akad"];
                var produk_id = document.forms["form_simpanan"]["produk_id"];
                var tujuan_pengajuan = document.forms["form_simpanan"]["tujuan_pengajuan"];
                var sumber_dana = document.forms["form_simpanan"]["sumber_dana"];

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

                $('#form_simpanan').submit();
            });
        </script>
    @endif

        @endpush
