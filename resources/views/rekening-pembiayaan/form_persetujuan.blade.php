@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Rekening Pembiayaan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('rekening-pembiayaan.index') }}">{{ __('Rekening Pembiayaan') }}</a>
        </li>
        <li class="breadcrumb-item">
            @if (!empty($rekening->id))
                {{ __('Lihat Rekening Pembiayaan') }}
            @else
                {{ __('Daftar Rekening Pembiayaan') }}
            @endif
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
                    <h5 class="card-header">{{ __('Pendaftaran Rekening Pembiayaan') }}</h5>

                    @endif


                <form id="form_pembiayaan" autocomplete="off" method="POST" class="form-horizontal" action="{{ route('rekening-pembiayaan.update_letter',$rekening->id)}}">

                    @if (!empty($rekening->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label form-label" for="anggota_id">{{ __('Tanggal Pengajuan') }}</label>
                                            <input type="date" class="form-control" name="tanggal_pengajuan" id="tanggal_pengajuan" value="{{date('Y-m-d')}}" >

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                	<div class="row">

                                        <div class="col-md-6">
                                            <label class="control-label form-label" for="anggota_id">{{ __('Nama Anggota') }}</label>
                                            <select id="anggota_id" name="anggota_id" class="form-select" {{!empty($rekening) ? 'disabled' : ''}} {{empty($anggotaList) ? 'disabled' : '' }} required>
                                                @if (!empty($anggotaList))
                                                    <option value="">Pilih anggota...</option>
                                                    @foreach ($anggotaList as $i => $anggota)
                                                        <option value="{{ $anggota->id }}">{{ $anggota->nama_pemohon ?? '-' }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="no_anggota">{{ __('No. Anggota') }}</label>
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
                                            <select id="pilihan_akad" name="pilihan_akad" class="form-select" data-allow-clear="true" data-minimum-results-for-search="Infinity" data-placeholder="Pilih akad..." {{ !empty($rekening) ? 'disabled' : ''}} required>
                                                <option value="">&nbsp;</option>
                                                @foreach($akadList as $akad)
                                                    <option value="{{$akad->id}}" data-type="{{ $akad->jenis_akad }}" {!! !empty($rekening->pilihan_akad) && $rekening->pilihan_akad == $akad->id ? 'selected="selected"' : '' !!}>{{ $akad->nama_akad }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label form-label" for="produk_id">{{ __('Produk') }}</label>
                                            <select id="produk_id" name="produk_id" class="form-control select2"  {{ !empty($rekening) ? 'disabled' : ''}} required data-placeholder="Pilih produk...">
                                                <option value="">&nbsp;</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label form-label" for="nilai_pengajuan">{{ __('Nilai Pengajuan') }}</label>
                                            <input type="text" id="nilai_pengajuan" name="nilai_pengajuan" class="form-control" required {{ !empty($rekening) ? 'disabled' : ''}}>
                                        </div>
                                    </div>
                                </div> -->



                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label form-label" for="tujuan_pengajuan">{{ __('Tujuan Pengajuan') }}</label>
                                            <select id="tujuan_pengajuan" name="tujuan_pengajuan" class="form-select" data-placeholder="Pilih tujuan..." data-allow-clear="true" required>
                                                <option value="">&nbsp;</option>
                                                @foreach($tujuan as $data)
                                                    <option value="{{$data->id}}">{{$data->nama_tujuan_pengajuan}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label form-label" for="sumber_dana">{{ __('Sumber Pengembalian') }}</label>
                                            <select id="sumber_dana" name="sumber_dana" class="form-control select2" data-placeholder="Pilih sumber..." data-allow-clear="true" required>
                                                <option value="">&nbsp;</option>
                                                @foreach($sumber_dana as $sumber)
                                                    <option value="{{$sumber->id}}">{{$sumber->nama_sumber_dana}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                    <input hidden id="status_value" name="status" hidden>

                                <div id="perhitungan_section" class="form-group clearfix pt-5" style="display: none">
                                    <div class="border pt-0">
                                        <h5 class="card-header bg-azure">{{ __('Perhitungan Pembiayaan') }}</h5>
                                        <div class="card-body mt-3 b-0 mb-0">

                                            <div class="form-group clearfix">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="control-label form-label" for="nilai_pengajuan">{{ __('Nilai Pembiayaan') }}</label>
                                                        <input type="text" id="nilai_pengajuan" name="nilai_pengajuan" class="form-control nominal" required>
                                                    </div>
                                                    <div class="col-3 uang_muka_field">
                                                        <label class="control-label form-label" for="uang_muka">{{ __('Uang Muka') }}</label>
                                                        <input type="text" id="uang_muka" name="uang_muka" class="form-control nominal" value="1" >
                                                    </div>
                                                    <div class="col-3 harga_akhir_field">
                                                        <label class="control-label form-label" for="harga_akhir">{{ __('Harga Pembiayaan Akhir') }}</label>
                                                        <input type="text" id="harga_akhir" class="form-control nominal" readonly>
                                                    </div>
                                                    <div class="col-3 nisbah_field" style="display: none">
                                                        <label class="control-label form-label" for="nisbah_anggota">{{ __('Nisbah Anggota') }}</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                            <input type="number" id="nisbah_anggota" name="nisbah_anggota" class="form-control" >
                                                        </div>
                                                    </div>
                                                    <div class="col-3 nisbah_field" style="display: none">
                                                        <label class="control-label form-label" for="nisbah_koperasi">{{ __('Nisbah Koperasi') }}</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                            <input type="text" id="nisbah_koperasi" name="nisbah_koperasi" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group clearfix">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label class="control-label form-label" for="jangka_waktu">{{ __('Jangka Waktu') }} ( Bulan )</label>
                                                        <input type="text" id="jangka_waktu" name="jangka_waktu" class="form-control nominal" required>
                                                    </div>
                                                    <div class="col-3 margin_percentage_field">
                                                        <label class="control-label form-label" for="margin_percentage">{{ __('Margin Perbulan') }}</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                            <input type="text" id="margin_percentage" name="interest_percentage" class="form-control persentase" value="00" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-3 margin_bulanan_field">
                                                        <label class="control-label form-label" for="margin_bulanan">{{ __('Margin Bulanan') }}</label>
                                                        <input type="text" id="margin_bulanan" class="form-control nominal" readonly>
                                                    </div>
                                                    <div class="col-3 total_margin_field">
                                                        <label class="control-label form-label" for="total_margin">{{ __('Total Margin') }}</label>
                                                        <input type="text" id="total_margin" name="interest" class="form-control nominal" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <ul class="list-inline mb-0">
                                                <li class="previous list-inline-item">
													<a id="hitung_btn" class="btn btn-primary" style="color:white" >Hitung</a>
													<a id="reset_btn" class="btn btn-danger" style="color:white" >Reset</a>
                                                </li>
                                            </ul>

                                            <div class="form-group clearfix mt-5">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <label class="control-label form-label" for="harga_jual">{{ __('Harga Jual') }}</label>
                                                        <input type="text" id="harga_jual" name="nilai_pembiayaan" class="form-control nominal" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <label class="control-label form-label" for="kewajiban_angsuran">{{ __('kewajiban Angsuran') }}</label>
                                                        <input type="text" id="kewajiban_angsuran" class="form-control nominal" readonly>
                                                    </div>
                                                    <div class="col-4">
                                                        <label class="control-label form-label" for="angsuran_pokok">{{ __('Angsuran Pokok') }}</label>
                                                        <input type="text" id="angsuran_pokok" class="form-control nominal" readonly>
                                                    </div>
                                                    <div class="col-4 angsuran_margin_field">
                                                        <label class="control-label form-label" for="angsuran_margin">{{ __('Angsuran Margin/Basil/Jasa') }}</label>
                                                        <input type="text" id="angsuran_margin" class="form-control nominal" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix form-group">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <label for="">Angsuran Auto Debet Simpanan </label>
                                            <select name="angsuran_auto_debet_simpanan" id="angsuran_auto_debet_simpanan" class="form-control" placeholder="Pilih Angsuran Auto Debet Simpanan...">

                                                <option value="">Pilih angsuran auto debet simpanan</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @if (Route::getCurrentRoute()->getName() == 'rekening-pembiayaan.edit_persetujuan')
                            <div class="card-footer border border-top-0 text-left">
                                <label for="">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control" placeholder="Keterangan"></textarea>
                            </div>
                            <div class="card-footer border border-top-0 text-center">
                        <button id="approve_btn" class="btn btn-success">{{ __('Disetujui ') }}</button>
                    	<button id="reject_btn"  class="btn btn-danger" >{{ __('Batal ') }}</button>
                    	<button id="reject_btn"  class="btn btn-warning" >{{ __('Cetak Offering Letter ') }}</button>
                    </div>
                @else
                    <div class="card-footer border border-top-0 text-right">
                    	<a href="{{ route('rekening-pembiayaan.index') }}"  class="btn btn-danger" >{{ __('Kembali') }}</a>
                        @if(!isset($viewMode))
                        <a id="triggerModal_btn" class="btn btn-primary" style="color: white">{{ !empty($rekening_pembiayaan->id) ? __('Perbaharui') : __('Kirim') }}</a>
                        @endif
                    </div>
                @endif
                </form>
            </div>
        </div>
    </div>


    <!-- // Jadwal Angsuran Modal -->
    <div class="modal fade" tabindex="-1" id="jadwalModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header pd-x-20">
                    <h6 class="modal-title">Simulasi Angsuran</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-body-md">
                    <div class="nk-tnx-details">
                        <div class="table-responsive border ">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label"><strong>Nama Pengaju</strong></label>
                                        <span class="caption-text" id="modal_anggota">xxxxx</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label"><strong>NIK</strong></label>
                                        <label class="form-label" id="modal_nik">-</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label"><strong>Tgl. Pengajuan</strong></label>
                                        <label class="form-label" id="modal_tgl_pengajuan">-</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label"><strong>Produk</strong></label>
                                        <label class="form-label" id="modal_produk">-</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label"><strong>Akad Pembiayaan</strong></label>
                                        <label class="form-label" id="modal_akad_pembiayaan">-</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label"><strong>Jgk. Waktu</strong></label>
                                        <label class="form-label" id="modal_jgk_waktu">-</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label"><strong>Total Pembiayaan</strong></label>
                                        <label class="form-label" id="modal_total_pembiayaan">-</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label"><strong>Total Pengajuan</strong></label>
                                        <label class="form-label" id="modal_total_pengajuan">-</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label"><strong>Total Biaya</strong></label>
                                        <label class="form-label" id="modal_total_biaya">-</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="nk-modal-head mt-sm-5 mt-4 mb-0">
                            <h5 class="title">Jadwal Angsuran</h5>
                        </div>
                        <div class="row gy-3">
                            <div class="col-lg-12">
                                <div class="invoice-bills">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                        <table id="modal_jadwalAngsuranTable" class="datatable table table-striped nk-tb-list" data-auto-responsive="false" data-searching="false" data-length-change="false">
                                        </table>
                                        <!-- <a href="#" class="btn btn-lg btn-primary" id="jadwalModal_kirim_btn">
                                            Kirim Permohonan
                                        </a>
                                        <a href="#" class="btn btn-lg btn-danger" id="jadwalModal_tutup_btn">
                                            Tutup
                                        </a> -->
                                        <a id="jadwalModal_kirim_btn"  class="btn btn-primary mb-5" style="color: white">{{ __('Kirim Permohonan') }}</a>
                                        <a id="jadwalModal_cancel_btn" class="btn btn-danger mb-5" style="color: red">{{ __('Tutup') }}</a>
                                    </div>
                                </div>
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
                    <p> Apakah anda yakin untuk register pembiayaan ini?</p>

                    <a href="#" class="btn btn-md btn-primary" id="confirmModal_submit_btn">
                        Lanjutkan
                    </a>
                    <a href="#" class="btn btn-md btn-danger" id="confirmModal_cancel_btn">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }

    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("tanggal_pengajuan").setAttribute("max", today);

    var jenisAkadGlobal = '';
    var jadwalAngsuranTable = [];
    var jadwalTable;
    // var jadwalMode;
    var jadwalMode = 'mudharabah';

    let tanggal_hari_ini = moment().format('DD-MM-YYYY');

    const formatter = new Intl.NumberFormat('MS', {
        // style: 'decimal',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    });
    $(document).ready(function(){
        $('select').select2();

        $('#anggota_id').on('change', function() {
            $.ajax({
                url: "{{ route('produk-simpanan-berjangka.index') }}",
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

            var akadId = $(this).val();
            var selected = $(this).find('option:selected');
            var jenisAkad = selected.data('type');
            jenisAkadGlobal = jenisAkad;

            if(akadId) {
                $.ajax({
                    url: "{{ route('produk-pembiayaan.index') }}",
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: { id: akadId,
                        anggota_id : $('#anggota_id').val() },
                    success: function(response) {
                        if (response.result != '') {
                            $('#produk_id').empty();
                            $('#nilai_setoran').val();

                            let res = response.result.map((produk, i) => {
                                return {
                                    id: produk.id,
                                    text: produk.nama_pembiayaan,
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
                            $('#produk_id').empty();
                            $('#produk_id').append('<option value="">&nbsp;</option>').change();
                            $('#nilai_setoran').val();
                        }
                    },
                });
                // controlAkadFormField(jenisAkad);

            }else{
                $('#produk_id').empty();
                $('#produk_id').append('<option value="">&nbsp;</option>').change();
                $('#nilai_setoran').val();
                $('#perhitungan_section').hide(200);

            }
        });


        $('#produk_id').on('change', function() {
            let data = $(this).select2('data');
            if (data[0].produk) {
                let dataProduk = data[0].produk;
                controlAkadFormField(jenisAkadGlobal);

                if (dataProduk.interest) {
                    $("#margin_percentage").val(dataProduk.interest);
                }
                if (dataProduk.nisbah_anggota) {
                    $("#nisbah_anggota").val(dataProduk.nisbah_anggota).trigger("keyup");
                }

            } else {
                console.log("Tidak ada data");
            }

        });


        $('#hitung_btn').on('click', function() {
            let nilaiPembiayaan = $('#nilai_pengajuan').inputmask('unmaskedvalue');
            let uangMuka = $('#uang_muka').inputmask('unmaskedvalue');
            let jangkaWaktu = $('#jangka_waktu').val();
            let marginPercentage = $('#margin_percentage').val();

            // if (jenisAkadGlobal == 'mudharabah' || jenisAkadGlobal == 'qard' ||  jenisAkadGlobal == 'musyarakah' ||
            //     jenisAkadGlobal == 'imbt') {

                let hargaAkhirPembiayaan = parseFloat(nilaiPembiayaan) - parseFloat(uangMuka);
                let marginBulanan = hargaAkhirPembiayaan * (parseFloat(marginPercentage)/100);
                let totalMargin = marginBulanan * jangkaWaktu;
                let hargaJual = hargaAkhirPembiayaan + totalMargin;
                let angsuranPokok = hargaAkhirPembiayaan / jangkaWaktu;
                let angsuranMargin = totalMargin / jangkaWaktu;
                let totalAngsuran = angsuranPokok + angsuranMargin;

                $('#harga_akhir').val(hargaAkhirPembiayaan);
                $('#margin_bulanan').val(marginBulanan);
                $('#total_margin').val(totalMargin);
                $('#harga_jual').val(hargaJual);
                $('#kewajiban_angsuran').val(totalAngsuran);
                $('#angsuran_pokok').val(angsuranPokok);
                $('#angsuran_margin').val(angsuranMargin);
                // console.log("Harga Akhir pembiaaan : " + hargaAkhirPembiayaan);
                // console.log("marginBulanan : " + marginBulanan);
                // console.log("totalMargin : " + totalMargin);
                // console.log("hargaJual : " + hargaJual);
                // console.log("angsuranPokok : " + angsuranPokok);
                // console.log("angsuranMargin : " + angsuranMargin);
                // console.log("totalAngsuran : " + totalAngsuran);

            // } else if (jenisAkadGlobal == 'murabahah' || jenisAkadGlobal == 'ijarah') {

            //     let hargaAkhirPembiayaan = parseFloat(nilaiPembiayaan) - parseFloat(uangMuka);
            //     let marginBulanan = hargaAkhirPembiayaan * (parseFloat(marginPercentage)/100);
            //     let totalMargin = marginBulanan * jangkaWaktu;
            //     let hargaJual = hargaAkhirPembiayaan + totalMargin;
            //     let angsuranPokok = hargaAkhirPembiayaan / jangkaWaktu;
            //     let angsuranMargin = totalMargin / jangkaWaktu;
            //     let totalAngsuran = angsuranPokok + angsuranMargin;

            //     $('#harga_akhir').val(hargaAkhirPembiayaan);
            //     $('#margin_bulanan').val(marginBulanan);
            //     $('#total_margin').val(totalMargin);
            //     $('#harga_jual').val(hargaJual);
            //     $('#kewajiban_angsuran').val(totalAngsuran);
            //     $('#angsuran_pokok').val(angsuranPokok);
            //     $('#angsuran_margin').val(angsuranMargin);

            // }
        })
        $('#reset_btn').on('click', function() {
            resetField();
        });


        $('#triggerModal_btn').on('click', function(e) {
            // NOTE Anchor : manual form validity
            var form = document.querySelector('form')
            let proceed = form.reportValidity();

            // Proceed generate jadwal angsuran after all checking is complete
            if (proceed) {
                generateJadwalAngsuran();
            }
        });


        // Clear jadwal everytime close
        $('#jadwalModal').on('hidden.bs.modal', function() {
            jadwalTable.destroy();
            $('#modal_jadwalAngsuranTable').empty();
        });
        $('#jadwalModal_kirim_btn').on('click', function() {
            $('#confirmationModal').modal('show');
        });
        $('#jadwalModal_cancel_btn').on('click', function() {
            $('#jadwalModal').modal('hide');
        });


        // Confirmation modal submit button
        $('#confirmModal_submit_btn').on('click', function() {
            $('#form_pembiayaan').submit();
            console.log('form submitted');
        });
        // Confirmation modal cancel button
        $('#confirmModal_cancel_btn').on('click', function() {
            $('#confirmationModal').modal('hide');
        });


        $('#approve_btn').on('click', function(e) {
            e.preventDefault();
            $('#status_value').val('{{ \App\Models\RekeningPembiayaan::STATUS_AKAD }}');
            $('#form_pembiayaan').submit();
        });
        $('#reject_btn').on('click', function(e) {
            e.preventDefault();
            $('#status_value').val('{{ \App\Models\RekeningPembiayaan::STATUS_REJECTED }}');
            $('#form_pembiayaan').submit();
        });



        $(".nominal").inputmask('decimal', {
            'alias': 'numeric',
            'groupSeparator': ',',
            'autoGroup': true,
            'digits': 2,
            // 'radixPoint': "",
            // 'digitsOptional': false,
            'allowMinus': false,
            'placeholder': '0.00',
            'removeMaskOnSubmit': true,
            'onBeforeMask': function (value, opts) {
                return value;
            },
        });

        $(".persentase").inputmask('decimal', {
            'alias': 'decimal',
            'groupSeparator': '.',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ".",
        });

        $('#margin_percentage').on('keyup change', function() {
            let input = $(this).val();

            if (input > 100) {
                let result = input.slice(0, 2);
                $('#margin_percentage').val(result);
            }
        });

        $('#nisbah_anggota').on('keyup change', function() {
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

        $('#uang_muka, #margin_percentage').inputmask({
            min: 0,
            digit: 0,
            alias: 'decimal',
            groupSeparator: '.',
            autoGroup: true,

        });
    });


    function controlAkadFormField(selectedAkad) {

        if ('{{ empty($rekening->id) }}') {
            resetField();
        }

        $('#perhitungan_section').hide(200);
        $('#perhitungan_section').show(300);

        if (selectedAkad == 'murabahah' || selectedAkad == 'imbt') {

            $('.uang_muka_field').show(300);
            $('.nisbah_field').hide(200)

            $("label[for='nilai_pengajuan']").text('Harga Pokok');

            $('.harga_akhir_field').show(300);
            $("label[for='harga_akhir']").text('Harga Pokok Setelah  Uang Muka');

            $('.margin_percentage_field').show(300);
            $("label[for='margin_percentage']").text('Margin Perbulan');

            $('.margin_bulanan_field').show(300);
            $("label[for='margin_bulanan']").text('Margin Bulanan');

            $('.total_margin_field').show(300);
            $("label[for='total_margin']").text('Total Margin');

            //
            $("label[for='harga_jual']").text('Harga Jual');
            $('.angsuran_margin_field').show(300);



        } else if (selectedAkad == 'mudharabah' || selectedAkad == 'musyarakah') {

            $("label[for='nilai_pengajuan']").text('Nilai Pembiayaan');

            $('.uang_muka_field').hide(200);
            $('.harga_akhir_field').hide(200);
            $('.nisbah_field').show(300)

            $('.margin_percentage_field').show(300);
            $("label[for='margin_percentage']").text('Basil Perbulan');

            $('.margin_bulanan_field').show(300);
            $("label[for='margin_bulanan']").text('Basil Bulanan');

            $('.total_margin_field').show(300);
            $("label[for='total_margin']").text('Total Basil');

            //
            $("label[for='harga_jual']").text('Total Pembiayaan');
            $('.angsuran_margin_field').show(300);



        } else if (selectedAkad == 'ijarah') {

            $("label[for='nilai_pengajuan']").text('Aktiva Sewa');
            $('.uang_muka_field').hide(200);
            $('.harga_akhir_field').hide(200);
            $('.nisbah_field').hide(200)

            $('.margin_percentage_field').show(300);
            $("label[for='margin_percentage']").text('Ujrah/Jasa Perbulan');

            $('.margin_bulanan_field').show(300);
            $("label[for='margin_bulanan']").text('Ujrah/Jasa Bulanan');

            $('.total_margin_field').show(300);
            $("label[for='total_margin']").text('Total Ujrah/Jasa');

            //
            $("label[for='harga_jual']").text('Harga Sewa');
            $('.angsuran_margin_field').show(300);

        } else if (selectedAkad == 'qard') {

            $("label[for='nilai_pengajuan']").text('Nilai Pembiayaan');
            $('.uang_muka_field').hide(200);
            $('.harga_akhir_field').hide(200);
            $('.nisbah_field').hide(200)
            $('.margin_percentage_field').hide(200);
            $('.margin_bulanan_field').hide(200);
            $('.total_margin_field').hide(200);
            $('.angsuran_margin_field').hide(200);

        } else {
            console.log("Cannot get akad value");
            // $('#perhitungan_section').hide(200);
        }

    }


    function generateJadwalAngsuran() {
        jadwalAngsuranTable = [];

        let jangkaWaktu = $('#jangka_waktu').val();
        let totalPokok = parseFloat($('#harga_akhir').val().replace(/,/g, ""));
        let totalMargin = parseFloat($('#total_margin').val().replace(/,/g, ""));
        let totalPembiayaan = parseFloat($('#harga_jual').val().replace(/,/g, ""));

        let angsuranPokok = parseFloat(totalPokok / jangkaWaktu);
        let angsuranMargin = parseFloat(totalMargin / jangkaWaktu);
        let angsuranBulanan = parseFloat(totalPembiayaan / jangkaWaktu);

        var outstanding = totalPembiayaan;
        var sisaPokok = totalPokok;
        var sisaMargin = totalMargin;
        for (var i = 0; i < jangkaWaktu; i++) {

            outstanding -= angsuranBulanan;
            sisaPokok -= angsuranPokok;
            sisaMargin -= angsuranMargin;

            jadwalAngsuranTable.push({
                'bulan': parseInt(i) + 1,
                'tanggalAngsuran': moment().add(i + 1, 'months').format('DD-MM-YYYY'),
                'angsuranPokok': angsuranPokok,
                'angsuranMargin': angsuranMargin,
                'angsuranBulanan': angsuranBulanan,
                'sisaPokok': sisaPokok,
                'sisaMargin': sisaMargin,
                'outstanding': outstanding
            });
        }

        const tres = {
            'bulan': 0,
            'tanggalAngsuran': 0,
            'angsuranPokok': 0,
            'angsuranMargin': 0,
            'angsuranBulanan': angsuranBulanan,
            'sisaPokok': totalPokok,
            'sisaMargin': totalMargin,
            'outstanding': totalPembiayaan
        }
        jadwalAngsuranTable.unshift(tres);

        displayJadwalAngsuran();
    }

    function displayJadwalAngsuran() {
        $('#modal_anggota').html($('#anggota_id').find(":selected").text());
        $('#modal_nik').html($('#nik').val());
        $('#modal_tgl_pengajuan').html(tanggal_hari_ini);
        $('#modal_produk').html($('#produk_id').find(":selected").text());
        $('#modal_akad_pembiayaan').html($('#pilihan_akad').find(":selected").text());
        $('#modal_jgk_waktu').html($('#jangka_waktu').val() + ' Bulan');
        $('#modal_total_pembiayaan').html('Rp. ' + $('#harga_jual').val());
        $('#modal_total_pengajuan').html('Rp. ' + $('#nilai_pengajuan').val());
        $('#modal_total_biaya').html('Rp. 0.00');

        if ( $.fn.dataTable.isDataTable( '#modal_jadwalAngsuranTable' ) ) {
            console.log("Re initiate datable")

            jadwalTable = $('#modal_jadwalAngsuranTable').DataTable();
            $('#jadwalModal').modal('show');

        } else {
            console.log("init new datable");

            if (jadwalMode == 'mudharabah') {
                // Mudharabah and Musyarakah will enter here
                jadwalTable = $('#modal_jadwalAngsuranTable').DataTable({
                    "autoWidth": false,
                    "paging": false,
                    data: jadwalAngsuranTable,
                    columns: [
                        { title: 'Angsuran Ke', data: 'bulan'},
                        { title: 'Tanggal Angsuran', data: 'tanggalAngsuran'},
                        { title: 'Angsuran Pokok', data: 'angsuranPokok', render: function (cell, row) {
                            return formatter.format(cell)}
                        },
                        { title: 'Angsuran Bagi Hasil', data: 'angsuranMargin', render: function (cell, row) {
                            return formatter.format(cell)}
                        },
                        { title: 'Total Angsuran', data: 'angsuranBulanan', render: function (cell, row) {
                            return formatter.format(cell)}
                        },
                        { title: 'Sisa Pokok', data: 'sisaPokok', render: function (cell, row) {
                            return formatter.format(cell)}
                        },
                        { title: 'Sisa Bagi Hasil', data: 'sisaMargin', render: function (cell, row) {
                            return formatter.format(cell)}
                        },
                    ],
                });

                $('#jadwalModal').modal('show');

            } else if (jadwalMode == 'qard') {

                jadwalTable = $('#modal_jadwalAngsuranTable').DataTable({
                    "autoWidth": false,
                    "paging": false,
                    data: jadwalAngsuranTable,
                    columns: [
                        { title: 'Angsuran Ke', data: 'angsuranKe'},
                        { title: 'Tanggal Angsuran', data: 'tanggalAngsuran'},
                        { title: 'Angsuran Pokok', data: 'angsuranPokok', render: function (cell, row) {
                            return formatter.format(cell)}
                        },
                        { title: 'Angsuran Fee', data: 'angsuranFee', render: function (cell, row) {
                            return formatter.format(cell)}
                        },
                        { title: 'Total Angsuran', data: 'totalAngsuran', render: function (cell, row) {
                            return formatter.format(cell)}
                        },
                        { title: 'Sisa Pokok', data: 'sisaPokok', render: function (cell, row) {
                            return formatter.format(cell)}
                        },
                        { title: 'Sisa Fee', data: 'sisaFee', render: function (cell, row) {
                            return formatter.format(cell)}
                        },
                    ],
                });

                $('#jadwalModal').modal('show');

            } else if (jadwalMode == 'murabahah') {
                // Murabahah, Ijarah & IMBT will enter here
                jadwalTable = $('#modal_jadwalAngsuranTable').DataTable({
                    "autoWidth": false,
                    "paging": false,
                    data: jadwalAngsuranTable,
                    columns: [
                        { title: 'Angsuran Ke', data: 'angsuranKe'},
                        { title: 'Tanggal Angsuran', data: 'tanggalAngsuran'},
                        { title: 'Jumlah Angsuran', data: 'jumlahAngsuran', render: function (cell, row) {
                            return formatter.format(cell)}
                        },
                        { title: 'Sisa Pembiayaan', data: 'sisaPembiayaan', render: function (cell, row) {
                            return formatter.format(cell)}
                        },
                    ],
                });
                $('#jadwalModal').modal('show');
            }
        }
    }


    function resetField() {
        $('#nilai_pengajuan').val('');
        $('#uang_muka').val('');
        $('#harga_akhir').val('');
        $('#jangka_waktu').val('');
        $('#margin_percentage').val('');
        $('#margin_bulanan').val('');
        $('#total_margin').val('');
        $('#harga_jual').val('');
        $('#kewajiban_angsuran').val('');
        $('#angsuran_pokok').val('');
        $('#angsuran_margin').val('');
    }




</script>
@if (!empty($rekening) && $rekening->anggota->id)
<script>
    $(document).ready(function () {

        var jenisAkad = '';

        @if (isset($viewMode))
        // $('input').attr('readonly', 'readonly');
        $('.form-control').attr('disabled', 'disabled');
        $('#status').attr('disabled', 'disabled');
        // $('.form-select').select2({
        //     disabled: true,
        // });
        @endif

        // Load anggota name
        let anggotaSelect = $('#anggota_id');
        let option = new Option('{{ $rekening->anggota->nama_pemohon }}', '{{ $rekening->anggota->id }}', true, true);
        anggotaSelect.append(option).trigger('change');
        anggotaSelect.trigger({
            type: 'select2:select',
        });

        // let produkSelect = $('#produk_id');
        // let produkOption = new Option('{{ $rekening->produk->nama_pembiayaan }}', '{{ $rekening->produk->id }}', true, true);
        // produkSelect.append(produkOption).trigger('change');
        // produkSelect.trigger({
        //     type: 'select2:select',
        // });

        let sumberSelect = $('#sumber_dana');
        let sumberoption = new Option('{{ $rekening->sumber_danas->nama_sumber_dana }}', '{{ $rekening->sumber_danas->id }}', true, true);
        sumberSelect.append(sumberoption).trigger('change');
        sumberSelect.trigger({
            type: 'select2:select',
        });

        let tujuanSelect = $('#tujuan_pengajuan');
        let tujuanOption = new Option('{{ $rekening->tujuan_pengajuans->nama_tujuan_pengajuan }}', '{{ $rekening->tujuan_pengajuans->id }}', true, true);
        tujuanSelect.append(tujuanOption).trigger('change');
        tujuanSelect.trigger({
            type: 'select2:select',
        });

        $('#nilai_pengajuan').val(parseFloat('{{ $rekening->nilai_pengajuan }}'));

        $('#pilihan_akad').trigger('change');
        var selected = $('#pilihan_akad').find('option:selected');
        var jenisAkad = selected.data('type');

        var fieldRow = {!! $rekening->toJson() !!};
        $.each(fieldRow, function (index, value) {
            if (value != null ) {
                let target = $('#' + index);

                if (value && value.formatted) {
                    value = value.formatted;
                }

                target.val(value);

                // // Special case:
                if (index == 'interest') {
                    $('#total_margin').val(value);
                }
                if (index == 'interest_percentage') {
                    $('#margin_percentage').val(value);
                }
            }
        });
        $('#hitung_btn').click();
    });

    // Trigger when finish retrieve ajax to fill in rekening information - Arrave
    $( document ).ajaxStop(function() {


        // var selected = $('#pilihan_akad').find('option:selected');
        // var jenisAkad = selected.data('type');

        // if (jenisAkad == 'murabahah' || jenisAkad == 'ijarah') {

        //     let totalMargin = parseFloat($('#total_margin').val().replace(/,/g, ""));
        //     // console.log("Total Margin : " + totalMargin);

        //     let nilaiPembiayaan = parseFloat($('#nilai_pengajuan').val().replace(/,/g, ""));
        //     // console.log("Total nilaiPembiayaan : " + nilaiPembiayaan);

        //     let uangMuka = parseFloat($('#uang_muka').val().replace(/,/g, ""));
        //     // console.log("Total uangMuka : " + uangMuka);

        //     // let hargaAkhir =
        //     // $('#margin_percentage').val((totalMargin*100)/parseFloat($('#harga_akhir')/)


        // } else if (jenisAkad == 'mudharabah' || jenisAkad == 'qard') {

        // }

    });


</script>
@endif

@endpush
