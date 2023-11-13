@extends('layouts.app')

@section('breadcrumb')
<x-breadcrumb title="{{ __('Pemindah Bukuan') }}">
    <li class="breadcrumb-item">
        {{ __('Pemindah Bukuan') }}
    </li>
</x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">


                <form method="POST" id="form_transaksi" class="form-horizontal"
                      action="{{route('pemindahbukuan.store')}}">
                    @csrf

                    <div class="card-body">
{{--                        card header--}}
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Rekening Pengirim') }}</h4>
                        </div>
                        <br>
                        <div class="row">
                            <form action="" method="post">
                            <div class="col-md-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group clearfix">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label class="control-label form-label" for="tanggal">{{ __('Tanggal Transaksi') }}</label>
                                                                                    <input type="date" name="date" class="form-control" required value="{{date('Y-m-d')}}">
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
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
                                            <select id="akun_id" name="akun" class="form-control select2" data-placeholder="Pilih Rekening.." data-allow-clear="true">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="no_rekening">{{ __('No. Rekening') }}</label>
                                            <input id="no_rekening" type="text" class="form-control" readonly />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="saldo">{{ __('Saldo') }}</label>
                                            <input id="saldo" type="text" class="form-control nominal" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>

                        </div>
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Rekening Penerima') }}</h3>
                    </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label form-label" for="anggota_id_penerima">{{ __('Nama') }}</label>
                                            <select id="anggota_id_penerima" name="penerima" class="form-control select2" data-placeholder="Pilih anggota.." data-allow-clear="true"  >
                                                <option value=""></option>
                                                @foreach ($anggota as $i => $nasabah)
                                                    <option value="{{ $nasabah->id }}" >{{ $nasabah->nama_pemohon ?? '-' }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="no_mitra_penerima">{{ __('No. Anggota') }}</label>
                                            <input id="no_mitra_penerima" type="text" class="form-control" readonly/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label form-label" for="akun_id_penerima">{{ __('Nama Akun') }}</label>
                                            <select id="akun_id_penerima" name="akun_id_penerima" class="form-control select2" data-placeholder="Pilih Rekening.." data-allow-clear="true">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="no_rekening_penerima">{{ __('No. Rekening Penerima') }}</label>
                                            <input id="no_rekening_penerima" type="text" class="form-control" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row g-4 pembiayaan" >
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-label" for="">Angsuran Pokok</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control num2words" id="angsuran_pokok" name="angsuran_pokok" autocomplete="off" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'" >
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-label" for="">Angsuran Margin/Bagi Hasil/Jasa</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control num2words" id="angsuran_margin" name="angsuran_margin" autocomplete="off" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'" >
                                    </div>
                                </div>
                            </div>

{{--                            <div class="col-lg-4">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-label" for="">Total Angsuran</label>--}}
{{--                                    <div class="form-control-wrap">--}}
{{--                                        <input type="text" class="form-control num2words" id="total" name="total_angsuran" autocomplete="off" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'" readonly>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Informasi Pemindah Bukuan') }}</h3>
                        </div>
                        <br>
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label form-label nom_value" for="akun_id_penerima">{{ __('Nominal') }}</label>
                                            <input id="nom" type="text" class="form-control nominal" name="nominal"
                                                   autocomplete="off"
                                                   data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'"
                                            />

                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="no_rekening_penerima">{{ __('Referensi') }}</label>
                                            <input id="reference"name="reference" type="text" class="form-control"  />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="no_rekening_penerima">{{ __('No Jurnal') }}</label>
                                            <input id="journal_no"name="journal_no" type="text" class="form-control"  placeholder="PB-{{ str_pad(($last ?? 0) + 1, 5, 0, STR_PAD_LEFT) }}"  readonly/>

                                        </div>
                                    </div>
                                </div>
                            </div>
{{--                            <div class="col-md-12">--}}
{{--                                <div class="form-group clearfix">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-12">--}}
{{--                                            <label class="control-label form-label" for="keterangan">{{ __('Keterangan') }}</label>--}}
{{--                                            <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>--}}

{{--                                        </div>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                        </div>
{{--                        button kirim--}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">{{ __('Kirim') }}</button>
                        </div>
                    </div>


            </div>


                </form>
            </div>
        </div>
    </div>



<!-- Modal -->
{{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Register Komponen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Akun GL/Buku Besar</label>
                        <select class="form-control" name="akun_gl_buku_besar">
                            <option value="">Pilih Akun GL/Buku Besar</option>
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                        </select>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Kirim</button>
            </div>
        </div>
    </div>
</div> --}}

@endsection

@push("css")
<link href="{{ asset('assets/plugins/tabs/style.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!---Tabs JS-->
<script src={{ asset('assets/js/tabs.js') }}></script>
<script src="{{ asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script>
{{--    select2--}}
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Pilih",
            allowClear: true
        });
    });

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
                    console.log(response);

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
                    //
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
$('#anggota_id_penerima').on('change', function () {
    clearRekeningData_penerima();

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

                    $('#no_mitra_penerima').val(anggota.no_mitra);

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
                    $('#akun_id_penerima').empty().select2({
                        data: availableRekening
                    })

                } else {
                    clearAnggotaInfo_penerima();
                    clearRekeningData();

                }
            }
        });
    } else {

        clearAnggotaInfo_penerima();
    }
});

$('#akun_id').on('change', function() {

    clearRekeningData();

    let selected = $(this).select2('data');
    let selectedRekening = selected[0].data;
    globalRekening = selected[0].data;
    console.log("Selected Rekening : " + JSON.stringify(selectedRekening));

    console.log(selectedRekening)

    if (selectedRekening) {
        $('#no_rekening').val(selectedRekening.no_akun);
        $('#saldo').val(selectedRekening.saldo);


        // $('#description').val('Pemindah bukuan dari ' + selectedRekening. + ' ke ' + namaAnggota_penerima);
    } else {
        clearRekeningData();
    }
});



$('.pembiayaan').hide();
$('#akun_id_penerima').on('change', function() {
    // clearRekeningData_penerima();
    let selected = $(this).select2('data');
    let selectedRekening = selected[0].data;
    globalRekening = selected[0].data;
    console.log(selectedRekening)
    if (selectedRekening.rekening_type == 'App\\Models\\RekeningSimpanan') {
        $('#no_rekening_penerima').val(selectedRekening.no_akun);
        // $('#saldo').val(selectedRekening.saldo);
        $('.pembiayaan_').hide(200);
        $('#nom').show();
        $('.nom_value').show();
    }else if(selectedRekening.rekening_type == 'App\\Models\\RekeningPembiayaan'){
        $('#no_rekening_penerima').val(selectedRekening.no_akun);
        $('#angsuran_pokok').val(selectedRekening.angsuran_pokok);
        $('#angsuran_margin').val(selectedRekening.angsuran_margin);
        // var total = selectedRekening.angsuran_pokok + selectedRekening.angsuran_margin;
        // $('#total').val(total);
        $('.pembiayaan').show(400);
        $('#nom').val('');
        $('#nom').hide();
        $('.nom_value').hide();
    }else{
        $('#no_rekening_penerima').val(selectedRekening.no_akun);
        $('#nom').val(selectedRekening.nominal);
        $('.nom_value').show();
        $('.pembiayaan_').hide(200);
    }
});





function clearAnggotaInfo() {
    $('#no_mitra').val('');
    $('#akun_id').empty();
}
function clearAnggotaInfo_penerima() {
    $('#no_mitra_penerima').val('');
    $('#akun_id_penerima').empty();
}

function clearRekeningData() {
    // $('.pembiayaan_info_field').hide(200);
    // $('#angsuran_pokok').val('');
    // $('#angsuran_margin').val('');
    $('#kewajiban_angsuran').val('');
    $('#sisa_pembiayaan').val('');
    $('#no_rekening').val('');
    $('#saldo').val('');
}

function clearRekeningData_penerima() {
    $('#no_rekening_penerima').val('');
        $('#angsuran_pokok').val('');
        $('#angsuran_margin').val('');
        $('.pembiayaan').hide(400)

}

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
$("#angsuran_pokok").inputmask('decimal', {
    'alias': 'numeric',
    'groupSeparator': ',',
    'autoGroup': true,
    'digits': 2,
    'radixPoint': ".",
    // 'digitsOptional': false,
    'allowMinus': false,
    'placeholder': '0.00',
});

$("#angsuran_margin").inputmask('decimal', {
    'alias': 'numeric',
    'groupSeparator': ',',
    'autoGroup': true,
    'digits': 2,
    'radixPoint': ".",
    // 'digitsOptional': false,
    'allowMinus': false,
    'placeholder': '0.00',
});



</script>

@endpush
