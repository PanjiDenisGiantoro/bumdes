@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Daftar Produk') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('rekening-simpanan.index') }}">{{ __('Rekening Simpanan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Daftar Rekening Pembiayaan') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                @if (!empty($rekening_pembiayaan->id))
                    <h5 class="card-header">{{ __('Informasi Rekening Pembiayaan') }}</h5>

                @else
                    <h5 class="card-header">{{ __('Pengajuan Rekening Pembiayaan') }}</h5>

                    @endif


                <form autocomplete="off" method="POST" class="form-horizontal" action="{{ !empty($rekening_pembiayaan->id) ? route('rekening-pembiayaan.update', [$rekening_pembiayaan]) : route('rekening-pembiayaan.store') }}">

                    @if (!empty($rekening_pembiayaan->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                	<div class="row">
                                        <div class="col-md-7">
                                            <label class="control-label form-label" for="anggota_id">{{ __('Anggota') }}</label>
                                            <select id="anggota_id" name="anggota_id" class="form-select" {{!empty($rekening_pembiayaan) ? 'disabled' : ''}} {{empty($anggotaList) ? 'disabled' : '' }}>
                                                @if (!empty($anggotaList))
                                                    <option value="">pilih anggota...</option>
                                                    @foreach ($anggotaList as $i => $anggota)
                                                        <option value="{{ $anggota->id }}" >{{ $anggota->nama_pemohon ?? '-' }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="no_anggota">{{ __('No. Mitra') }}</label>
                                            <input id="no_mitra" type="text" class="form-control" readonly/>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="nik">{{ __('NIK') }}</label>
                                            <input id="nik" type="text" class="form-control" readonly />
                                        </div>
						           </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label form-label" for="pilihan_akad">{{ __('Akad') }}</label>
                                            <select id="pilihan_akad" name="pilihan_akad" class="form-select" data-minimum-results-for-search="Infinity" {{ !empty($rekening_pembiayaan) ? 'disabled' : ''}}>
                                                <option value="">&nbsp;</option>
                                                <option value="mudharabah">Mudharabah</option>
                                                <option value="murabahah">Murabahah</option>
                                                <option value="musyarakah">Musyarakah</option>
                                                <option value="ijarah">Ijarah</option>
                                                <option value="imbt">IMBT</option>
                                                <option value="qard">Qard</option>
                                                <!-- @foreach($akadList as $akad) -->
                                                    <!-- <option value="{{$akad->id}}">{{$akad->nama_akad}}</option> -->
                                                <!-- @endforeach -->
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label form-label" for="produk_id">{{ __('Produk') }}</label>
                                            <select id="produk_id" name="produk_id" class="form-control select2" required {{ !empty($rekening_pembiayaan) ? 'disabled' : ''}}>
                                                <option value="">&nbsp;</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label form-label" for="nilai_pengajuan">{{ __('Nilai Pengajuan') }}</label>
                                            <input type="text" id="nilai_pengajuan" name="nilai_pengajuan" class="form-control" required {{ !empty($rekening_pembiayaan) ? 'disabled' : ''}}>
                                        </div>
                                    </div>
                                </div>



                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label form-label" for="nama_sumber_pengembalian">{{ __('Sumber Pengembalian') }}</label>
                                            <select id="nama_sumber_pengembalian" name="nama_sumber_pengembalian" class="form-select">
                                                <option value="">&nbsp;</option>
                                                @foreach($pengembalian as $tujuan)
                                                    <option value="{{$tujuan->id}}">{{$tujuan->nama_sumber_pengembalian}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label form-label" for="sumber_dana">{{ __('Sumber Dana') }}</label>
                                            <select id="sumber_dana" name="sumber_dana" class="form-control select2">
                                                <option value="">&nbsp;</option>
                                                @foreach($sumber_dana as $sumber)
                                                    <option value="{{$sumber->id}}">{{$sumber->nama_sumber_dana}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                @if(!empty($rekening_pembiayaan->id))
                                    <input  id="status_value" name="status" value=" {{ $rekening_pembiayaan->status}}" hidden>
                                @else
                                    <input hidden id="status_value" name="status" value="baru"hidden>
                                    @endif
                                @if(!empty($rekening_pembiayaan->id ))

                                <input  id="status_value_aktif" name="status_aktif"hidden value="@if($rekening_pembiayaan->status_aktif != '')aktif @else tidak_aktif @endif">
                                @endif



                            @if(!empty($rekening_pembiayaan->id))
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-label">Status Pengajuan Rekening</div>
                                            <label class="custom-switch">
                                                <input type="checkbox" id="status"  class="custom-switch-input" @if(!empty($rekening_pembiayaan)) {{ $rekening_pembiayaan->status == 'disetujui' ? 'checked' : null }} @endif  >
                                                <span class="custom-switch-indicator"></span>
                                                <span id="status_label" class="custom-switch-description">@if(!empty($rekening_pembiayaan)) {{ $rekening_pembiayaan->status == 'disetujui' ? 'DISETUJUI' : 'TIDAK DISETUJUI' }}  @endif</span>
                                            </label>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-label">Status Aktif Rekening</div>
                                            <label class="custom-switch">
                                                <input type="checkbox" id="status_aktif"  class="custom-switch-input" @if(!empty($rekening_pembiayaan)) {{ $rekening_pembiayaan->status_aktif == 1 ? 'checked' : null }} @endif>
                                                <span class="custom-switch-indicator"></span>
                                                <span id="status_label_aktif" class="custom-switch-description">@if(!empty($rekening_pembiayaan)) {{ $rekening_pembiayaan->status_aktif == 1 ? 'AKTIF' : 'TIDAK AKTIF' }}  @endif</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-footer border border-top-0 text-right">
                    	<a href="{{ route('rekening-pembiayaan.index') }}"  class="btn btn-danger" >{{ __('Kembali') }}</a>
                        @if(!isset($viewMode))
                            <button class="btn btn-primary">{{ !empty($rekening_pembiayaan->id) ? __('Perbaharui') : __('Kirim') }}</button>
                            @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

<script>
    $('#anggota_id').on('change', function() {
        $.ajax({
            url: "{{ route('rekening-simpanan.index') }}",
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {id: $(this).val()},
            success: function(response) {
                if (response) {
                    console.log(response.results)
                    $('#nik').val(response.results.nik);
                    $('#no_mitra').val(response.results.no_mitra);
                }
            },
        });
    });
    $('#pilihan_akad').on('change', function() {
        $.ajax({
            url: "{{ route('produk-simpanan.index') }}",
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {id: $(this).val()},
            success: function(response) {
                if (response) {
                    $('#produk_id').val(response.results.id);
                    $('#produk_id').append('<option hidden>Pilih</option>');
                    $.each(response, function(key, course){
                        console.log(key,course)

                        $('#produk_id').append('<option value="'+ course.id +'">' + course.nama_simpanan+ '</option>');
                    });
                }
            },
        });
    });

</script>
@if (!empty($rekening_simpanan) && $rekening_simpanan->anggota->id)
<!-- <script>
    $(document).ready(function () {
        @if (isset($viewMode))
        // $('input').attr('readonly', 'readonly');
        $('.form-control').attr('disabled', 'disabled');
        $('#status').attr('disabled', 'disabled');
        // $('.form-select').select2({
        //     disabled: true,
        // });
        @endif

        let anggotaSelect = $('#anggota_id');
        let option = new Option('{{ $rekening_simpanan->anggota->nama_pemohon }}', '{{ $rekening_simpanan->anggota->id }}', true, true);
        anggotaSelect.append(option).trigger('change');
        anggotaSelect.trigger({
            type: 'select2:select',
        });
        let akadSelect = $('#pilihan_akad');
        let akadoption = new Option('{{ $rekening_simpanan->akads->nama_akad }}', '{{ $rekening_simpanan->akads->id }}', true, true);
        akadSelect.append(akadoption).trigger('change');
        akadSelect.trigger({
            type: 'select2:select',
        });
        let produkSelect = $('#produk_id');
        let Produkoption = new Option('{{ $rekening_simpanan->akads->nama_akad }}', '{{ $rekening_simpanan->akads->id }}', true, true);
        akadSelect.append(akadoption).trigger('change');
        akadSelect.trigger({
            type: 'select2:select',
        });
        let tujuanSelect = $('#tujuan_pengajuan');
        let tujuanoption = new Option('{{ $rekening_simpanan->tujuan_pengajuans->nama_tujuan_pengajuan }}', '{{ $rekening_simpanan->tujuan_pengajuans->id }}', true, true);
        tujuanSelect.append(tujuanoption).trigger('change');
        tujuanSelect.trigger({
            type: 'select2:select',
        });
        let sumberSelect = $('#sumber_dana');
        let sumberoption = new Option('{{ $rekening_simpanan->sumber_danas->nama_sumber_dana }}', '{{ $rekening_simpanan->sumber_danas->id }}', true, true);
        sumberSelect.append(sumberoption).trigger('change');
        sumberSelect.trigger({
            type: 'select2:select',
        });
        $('#status').on('click', function() {
            if ($(this).prop("checked") == true) {
                $('#status_value').val('disetujui');
                $('#status_label').text('DISETUJUI');

            } else if ($(this).prop("checked") == false) {
                $('#status_value').val('tidak_disetujui');
                $('#status_label').text('TIDAK DISETUJUI');
            }
        });

    });

</script> -->
@endif

@endpush
