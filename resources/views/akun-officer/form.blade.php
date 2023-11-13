@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">Akun Officer</h3>
    <br>
{{--    <x-breadcrumb title="{{ __('Akun Officer') }}">--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('akun-officer.index') }}">{{ __('Akun Officer') }}</a>--}}
{{--        </li>--}}
{{--        <li class="breadcrumb-item">--}}
{{--            @if (!empty($officer->id))--}}
{{--                {{ __('Lihat AO') }}--}}
{{--            @else--}}
{{--                {{ __('Register AO') }}--}}
{{--            @endif--}}

{{--        </li>--}}
{{--    </x-breadcrumb>--}}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                @if (!empty($officer->id))
                    <h5 class="card-header">{{ __('Informasi AO') }}</h5>
                @else
                    <h5 class="card-header">{{ __('Registrasi AO') }}</h5>
                @endif


                <form autocomplete="off" method="POST" class="form-horizontal" action="{{ !empty($officer->id) ? route('akun-officer.update', $officer->id) : route('akun-officer.store') }}">

                    @if (!empty($officer->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <input type="hidden" id="jenis_ao_value" name="jenis_ao" value="{{ !empty($officer->id) ? $officer->jenis_ao : '' }}">
                    <input type="hidden" id="status_ao_value" name="status_ao" value="{{ !empty($officer->id) ? $officer->status_ao : 1 }}">
                    <input type="hidden" id="status_apps_value" name="status_apps" value="{{ !empty($officer->id) ? $officer->status_apps : 1 }}">


                    <div class="card-body">

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="jenis_ao">{{ __('Jenis AO') }}</label>
                                    <select id="jenis_ao" name="jenis_ao" class="form-control select2" data-placeholder="Pilih..." {{ !empty($officer->id) ? 'disabled' : '' }}>
                                        <option value=""></option>
                                        <option value="agen" {{ !empty($officer->id) && $officer->jenis_ao == 'agen' ? 'selected' : '' }}>AO Agen</option>
                                        <option value="karyawan" {{ !empty($officer->id) && $officer->jenis_ao == 'karyawan' ? 'selected' : '' }}>AO Karyawan</option>
                                    </select>
                                </div>
                                <div class="col-md-6 anggota-component" style="display: none">
                                    <label class="control-label form-label" for="anggota_id">{{ __('Anggota') }}</label>
                                    <select id="anggota_id" name="user_id" class="form-control select2" data-placeholder="Pilih..." {{ !empty($officer->id) ? 'disabled' : '' }}>
                                        <option value=""></option>
                                        @foreach ($daftarAnggota as $i => $anggota)
                                        <option value="{{ $anggota->id }}" data-anggota="{{ $anggota }}"
                                            {{ !empty($officer->id) && $officer->user_id == $anggota->id ? 'selected' : '' }}>
                                                {{ $anggota->no_mitra }} - {{ $anggota->nama_pemohon }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 user-component" style="display: none">
                                    <label class="control-label form-label" for="karyawan_id">{{ __('Pegawai') }}</label>
                                    <select id="karyawan_id" name="user_id" class="form-control select2" data-placeholder="Pilih..." {{ !empty($officer->id) ? 'disabled' : '' }}>
                                        <option value=""></option>
                                        @foreach ($daftarKaryawan as $i => $karyawan)
                                            <option value="{{ $karyawan->id }}" data-karyawan="{{ $karyawan }}"
                                            {{ !empty($officer->id) && $officer->jenis_ao == 'karyawan' && $officer->user_id == $karyawan->id ? 'selected' : '' }}>
                                                {{ $karyawan->id_pengguna }} - {{ $karyawan->nama_pegawai }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 details-component" style="display: none">
                                    <label class="control-label form-label" for="nik">{{ __('NIK') }}</label>
                                    <input id="nik" type="text" class="form-control" readonly />
                                </div>
                            </div>
                        </div>

                        <div class="form-group clearfix details-component" style="display: none">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="no_telpon">{{ __('No. Telpon') }}</label>
                                    <input id="no_telpon" type="text" class="form-control" readonly/>
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label form-label" for="email">{{ __('Email') }}</label>
                                    <input id="email" type="text" class="form-control" readonly />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label form-label" for="alamat">{{ __('Alamat') }}</label>
                                    <input id="alamat" type="text" class="form-control" readonly/>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label form-label" for="keterangan">{{ __('Keterangan') }}</label>
                                    <textarea id="keterangan" name="keterangan" class="form-control" rows="3">{{ !empty($officer->id) ? $officer->keterangan : '-' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <br>
                        <br>
                        <h3 class="card-title">{{ __('Informasi Rekening')}}</h3>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div class="form-label">Status AO</div>
                                        <label class="custom-switch">
                                            <input type="checkbox" id="status_ao" class="custom-switch-input" {{ !empty($officer->id) ? ($officer->status_ao == 1 ? 'checked' : '') : 'checked' }}>
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description" id="label_status_ao">{{ !empty($officer->id) ? ($officer->status_ao == 1 ? 'AKTIF' : 'TIDAK AKTIF') : 'AKTIF' }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div class="form-label">Mobile Apps</div>
                                        <label class="custom-switch">
                                            <input type="checkbox" id="status_apps" class="custom-switch-input" checked="">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description" id="label_status_apps">AKTIF</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 user-component" style="display: none">
                                    <label class="control-label form-label" for="gl_penampung">{{ __('GL Penampungan AO') }}</label>
                                    <select id="gl_penampung" name="penampungan_id" class="form-control select2" data-placeholder="Pilih...">
                                        <option value=""></option>
                                        @foreach ($daftarCoa as $i => $coa)
                                        <option value="{{ $coa->id }}">{{ $coa->kode }} - {{ $coa->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 anggota-component" style="display: none">
                                    <label class="control-label form-label" for="rekening_penampung">{{ __('Rekening Penampungan AO') }}</label>
                                    <select id="rekening_penampung" name="penampungan_id" class="form-control select2" data-placeholder="Pilih...">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>





                    <div class="card-footer border border-top-0 text-right">
                    	<a href="{{ route('akun-officer.index') }}"  class="btn btn-danger" >{{ __('Kembali') }}</a>
                        @if(!isset($viewMode))
                            <button type="submit" class="btn btn-primary">{{ !empty($officer->id) ? __('Perbaharui') : __('Kirim') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

<script>
    $(document).ready(function() {
        $('select').select2();

        $('#jenis_ao').on('change', function() {
            clear();
            let jenis = $(this).val();
            if (jenis == 'agen') {
                $('.anggota-component').show(300);
                $('.details-component').show(300);
                $('#jenis_ao_value').val(jenis);

                $('#rekening_penampung').prop("disabled", false);
                $('#gl_penampung').prop("disabled", true);

                $('#anggota_id').prop("disabled", false);
                $('#karyawan_id').prop("disabled", true);

            } else {
                $('.user-component').show(300);
                $('.details-component').show(300);
                $('#jenis_ao_value').val(jenis);

                $('#rekening_penampung').prop("disabled", true);
                $('#gl_penampung').prop("disabled", false);

                $('#anggota_id').prop("disabled", true);
                $('#karyawan_id').prop("disabled", false);
            }
        });

        $('#anggota_id').on('change', function() {
            let anggota_id = $(this).val();
            if (anggota_id != '') {
                var selected = $(this).find('option:selected');
                var data_anggota = selected.data('anggota');

                $('#nik').val(data_anggota.nik);
                $('#no_telpon').val(data_anggota.no_hp);
                $('#alamat').val(data_anggota.no_rumah + ', ' + data_anggota.nama_jalan + ', ' + data_anggota.rtrw);
                $('#email').val(data_anggota.email);

                getRekening(data_anggota.id);
            } else {
                console.log("empty");
            }
        });

        $('#karyawan_id').on('change', function() {
            let karyawan = $(this).val();
            if (karyawan != '') {
                var selected = $(this).find('option:selected');
                var data_karyawan = selected.data('karyawan');

                $('#nik').val(data_karyawan.nik);
                $('#no_telpon').val(data_karyawan.no_hp);
                $('#alamat').val(data_karyawan.alamat);
                $('#email').val(data_karyawan.email_perusahaan);

            }
        });

        function getRekening(anggotaId) {
            $.ajax({
                url: "{{ route('rekening-simpanan.index') }}",
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: { anggota_id: anggotaId },
                success: function(response) {
                    if (response.results != '') {
                        let res = response.results.map((rekening, i) => {
                            return {
                                id: rekening.id,
                                text: rekening.no_akun + ' - ' + rekening.produk.nama_simpanan,
                                rekening: rekening
                            }
                        });

                        $('#rekening_penampung').empty().select2({
                            data: res,
                        });

                        $('#rekening_penampung').trigger('change');

                    } else {
                        console.log("Takda rekening");
                        $('#rekening_penampung').empty();
                    }
                }
            });
        }

        $("#status_ao").click(function() {
            if ($(this).prop("checked")) {
                $('#label_status_ao').html('AKTIF');
                $('#status_ao_value').val('1');
            } else {
                $('#label_status_ao').html('TIDAK AKTIF');
                $('#status_ao_value').val('0');
            }
        });

        $("#status_apps").click(function() {
            if ($(this).prop("checked")) {
                $('#label_status_apps').html('AKTIF');
                $('#status_apps_value').val('1');
            } else {
                $('#label_status_apps').html('TIDAK AKTIF');
                $('#status_apps_value').val('0');
            }
        });

        function clear() {
            $('.user-component').hide(200);
            $('.anggota-component').hide(200);
            $('.details-component').hide(200);

            $('#anggota_id').val(null).trigger('change');
            $('#karyawan_id').val(null).trigger('change');
            $('#gl_penampung').val(null).trigger('change');
            $('#rekening_penampung').val(null).trigger('change');

            $('#nik').val('');
            $('#no_telpon').val('');
            $('#alamat').val('');
            $('#email').val('');
            $('#keterangan').val('');
        }
    });
</script>

@if (!empty($officer->id))
<script>
    $(document).ready(function() {
        // $('#jenis_ao').trigger('change');
        if ('{{ $officer->jenis_ao }}' == 'agen') {
            $('.anggota-component').show(300);
            $('.details-component').show(300);
            // $('#jenis_ao_value').val(jenis);

            $('#rekening_penampung').prop("disabled", false);
            $('#gl_penampung').prop("disabled", true);

            // $('#anggota_id').prop("readonly", true);
            // $('#anggota_id').prop("disabled", false);
            // $('#karyawan_id').prop("disabled", true);

            $('#anggota_id').trigger('change');

        } else {
            $('.user-component').show(300);
            $('.details-component').show(300);
            // $('#jenis_ao_value').val(jenis);

            $('#rekening_penampung').prop("disabled", true);
            $('#gl_penampung').prop("disabled", false);

            // $('#anggota_id').prop("disabled", true);
            // $('#karyawan_id').prop("disabled", false);
            // $('#karyawan_id').prop("readonly", true);

            $('#karyawan_id').trigger('change');

        }


        if ('{{ isset($viewMode) }}') {
            console.log("VIEW MODE");
            $("#status_ao").prop('disabled', true);
            $("#status_apps").prop('disabled', true);
            $("#keterangan").prop('readonly', true);
            $("#gl_penampung").prop('disabled', true);
            $("#rekening_penampung").prop('disabled', true);
        }
    });



    // function reload(val) {
    //     if (val == 'agen') {
    //         $('#anggota_id').trigger('change');

    //     } else {
    //         $('#karyawan_id').trigger('change');

    //     }
    // }
</script>
@endif

@endpush
