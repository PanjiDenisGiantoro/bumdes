@extends('layouts.app')

@section('breadcrumb')
    <br>
    <x-breadcrumb title="{{ __('Informasi Pembayaran') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('pengiriman.index') }}">{{ __('Pembayaran') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Pembayaran') }}
        </li>
    </x-breadcrumb>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card m-b-20">
                <div class="card-header">
                    <h3 class="card-title">Tambah Pembayaran</h3>

                </div>
                <form method="post" action="{{route('pengiriman.store')}}">
                    @csrf
                    <div class="card-body">

                    <div class="form-row">

                        <div class="form-group col-md-4" id="penawarann">
                            <div class="form-group" >
                                <label class="form-label" for="exampleInputEmail1">No Pemesanan</label>
                                <select name="no_pemesanan" id="penawaran" class="form-control">
                                    <option></option>
                                    @foreach($penjualan as $penjualans)
                                        <option value="{{$penjualans->id}}">{{$penjualans->no_pemesanan}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4" id="penawarann1">
                            <div class="form-group" >
                                <label class="form-label" for="exampleInputEmail1">No Penawaran</label>
                                <input type="text" id="pembayar"  class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-1">
                        </div>
                        <input type="text" id="smpn_adaAO_value" name="ada_pemesanan" hidden>
                        <div class="form-group col-md-4">

                            <div class="form-group">
                                <label class=" form-label" for="nama_jalan">{{ __('Status Keanggotaan') }}</label>
                            </div>

                            <div class="form-group">
                                <b class="status_keanggotaans"></b>

                                {{--                                    <label for="simpanan_ada_ao"--}}
                                {{--                                           id="simpanan_ada_aoLabel">Ya</label>--}}
                            </div>
                            <input type="text" id="onanggotavalue" name="pelanggan" hidden>

                        </div>
                        <div class="form-group col-md-6" id="i">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Pelanggan</label>
                                <select id="pelanggan" name="pelangganpilih" class="form-control"
                                >
                                    <option value="">-- Pilih Pelanggan --</option>
                                    @foreach ($anggota as $supp)
                                        <option value="{{ $supp->id }}">{{ $supp->nama_pemohon }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6" id="iii">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Pelanggan</label>
                                <input type="text" name="id_pelanggan12" id="pelanggan1" class="form-control" >
                                <input type="text" name="id_pelanggan" id="pelanggan1231" class="form-control" hidden >
                            </div>
                        </div>
                        <div class="form-group col-md-6" id="tel">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">No Telepon</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telp" >
                            </div>
                        </div>
                        <div class="form-group col-md-6" id="al">
                            <div class="form-group" >
                                <label class="form-label" for="exampleInputEmail1"
                                       >Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" >
                            </div>
                        </div>


                        <input type="text" hidden value="BARU" name="status">

                        <div class="form-group col-md-6">
                            <div class="form-group" >
                                <label class="form-label" for="exampleInputEmail1">Tanggal Pembayaran</label>
                                <input type="date" class="form-control" id="tanggal_penerimaan" name="tanggal_pengiriman">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group" >
                                <label class="form-label" for="exampleInputEmail1">No Pembayaran</label>
                                <input type="text" class="form-control" id="no_pesanan" name="no_pengiriman"
                                       value="{{$auto->head??''}}/@if(empty($auto->format_depan))@else{{date($auto->format_depan)}}/@endif @if(empty($auto->format_tengah))@else{{date($auto->format_tengah)}}/@endif @if(empty($auto->format_belakang))@else{{date($auto->format_belakang)}}@endif{{$count}}"
                                       readonly>
                            </div>
                        </div>
                        <div class="form-group col-md-6"id="termin2">
                            <div class="form-group" >
                                <label class="form-label" for="exampleInputEmail1">Termin</label>
                                <select id="termin" class="form-control" name="id_termin">
                                    <option value="">-- Pilih Termin --</option>
                                    @foreach ($termin as $id => $name)
                                        <option value="{{$id}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6" id="termin3">
                            <div class="form-group" >
                                <label class="form-label" for="exampleInputEmail1">Termin</label>
                                <input type="text" id="terminn" name="termin_pemesanan1"  class="form-control" readonly>
                                <input type="text" id="terminn1" name="termin_pemesanan"  class="form-control" readonly hidden>
                                <input type="text" id="terminnn" name="terminnn"  class="form-control" hidden>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group" style="margin-right: 10px">
                                <label class="form-label" for="exampleInputEmail1">Reference</label>
                                <input type="text" class="form-control" id="reference" name="reference">
                            </div>
                        </div>

                    </div>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label" for="exampleInputEmail1">Jenis Pembayaran</label>
                                    <label class="switch">
                                        <input type="checkbox" data-size="sm" id="jenis_bayar"
                                               data-toggle="toggle" data-on="Tunai" data-off="Transfer Bank" data-onstyle="success"
                                               data-offstyle="dark"
                                               checked>
                                        <input type="text" id="value_bayar"name="jenis_bayar" hidden>
                                        {{--                                            <span class="slider round" for="diskon2"--}}
                                        {{--                                            ></span>--}}
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label label_bank" for="id_bank">Bank</label>
                                    <select name="id_bank" id="id_bank" class="form-control" >
                                    @foreach($bank as $banks)
                                            <option value="{{$banks->id}}">{{$banks->nama_bank}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    <div class="table-responsive">
                        <table class="table card-table table-center text-nowrap table-primary" width="100%" id="table">
                            <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-white" width="200">Nama Produk</th>
                                <th class="text-white" width="110">Kode Produk</th>
                                <th class="text-white">satuan Produk</th>
                                <th class="text-white" width="90">qty</th>
                                <th class="text-white">harga</th>
                                <th class="text-white" width="90">Diskon %</th>
                                <th class="text-white" width="90">Pajak</th>
                                <th class="text-white">Total</th>
{{--                                                                <th class="text-white" width="90">pajaktype</th>--}}
{{--                                                                <th class="text-white" width="90">total_amount</th>--}}
{{--                                                                <th class="text-white" width="90">diskongrand</th>--}}
{{--                                                                <th class="text-white" width="90">total_amount_all</th>--}}
{{--                                                                <th class="text-white" width="90">total_sub</th>--}}
{{--                                                                <th class="text-white" width="90">total_disk</th>--}}
{{--                                                                <th class="text-white" width="90">Pajak</th>--}}
{{--                                                                <th class="text-white">Total</th>--}}
                                <th class="text-white"></th>

                            </tr>
                            </thead>
                            <tbody class="addMoreProduct">
                            </tbody>
                        </table>
                    </div>

                        <div class="">
{{--                            <a href="#" class="btn btn-sm btn-success add_more">Tambah--}}
{{--                                Barang</a>--}}
                        </div>

                        <div class="form-horizontal " id="moreTwo">
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-9" style="margin-top:20px">
                                        <label style="float: right" class="form-label subtotal" id="examplenameInputname2">Subtotal</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row justify-content-between">
                                            <div></div>
                                            <div>
                                                    <input  type="number" hidden name="subtotal_produk"
                                                            readonly  class="form-control total_subtotal_text" style="border: 0;font-size: 14px;font-weight: bold;text-align: right" id="total_subtotal_text">
                                                    {{--                                    <input  type="text"--}}
                                                    {{--                                            readonly  class="form-control total_subtotal_text1" style="border: 0;font-size: 14px;font-weight: bold;text-align: right" id="total_subtotal_text1">--}}
                                                    <br><b class="total_subtotal_text1 bg-white"  style="font-size: 14px;font-weight: bold;text-align: right;">0</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group " id="diskon_group">
                                <div class="row">
                                    <div class="col-md-9">
                                        <label style="float: right" class="form-label" id="examplenameInputname2">Diskon Per Item</label>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="diskon_per_item" id="diskon_per_item"hidden
                                               readonly  class="form-control diskon_per_item" style="border: 0;font-size: 14px;font-weight: bold;text-align: right" >
                                        <b class="diskon_per_item1 bg-white"  style="font-size: 14px;font-weight: bold;text-align: right;float: right">0</b>
                                    </div>
                                    <div class="row justify-content-end">
                                        {{-- <h5><b class=>900</b></h5> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group " id="diskon_group">
                                <div class="row">
                                    <div class="col-md-9">
                                        <label class="switch"style="float: right">
                                            <input style="float: right" type="checkbox" data-size="sm" id="diskon2" name="diskon2"
                                                   data-toggle="toggle" data-on="Diskon %" data-off="Diskon RP" data-onstyle="success"
                                                   data-offstyle="dark"
                                                   checked>
                                            {{--                                            <span class="slider round" for="diskon2"--}}
                                            {{--                                            ></span>--}}
                                        </label>
                                        <input type="text" id="diskonvalue" name="tipediskon" hidden>

                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" name="diskontotalrupiah" id="diskontotal"
                                               class="form-control">
                                        <input type="text" name="diskontotal" id="diskontotalpersen"
                                               class="form-control diskontotalpersen">

                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" hidden readonly id="diskontotalpersen1" class="form-control" style="border: 0;font-size: 14px;font-weight: bold;text-align: right;">
                                        <div class=""style="margin-left: 50px">
                                            {{--                                        <input type="number" readonly id="diskontotalpersen1_value" class="form-control" style="border: 0;font-size: 14px;font-weight: bold;">--}}
                                            <b class="diskontotalpersen1_value bg-white"  style="font-size: 14px;font-weight: bold;text-align: right;float: right">0</b>
                                        </div>
                                        <input type="number" readonly id="diskontotal1" class="form-control" style="border: 0;font-size: 14px;font-weight: bold;text-align: right">


                                    </div>
                                    <div class="row justify-content-end">
                                        {{-- <h5><b class=>900</b></h5> --}}
                                    </div>
                                </div>
                            </div>
                            <input type="text" id="subtotal" name="subtotal"hidden >

                            <div class="form-group " id="diskon_group">
                                <div class="row">
                                    <div class="col-md-9">
                                        <label style="float: right" class="form-label" id="examplenameInputname2">PPN</label>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="PPN" id="ppn"
                                               readonly  class="form-control" style="border: 0;font-size: 14px;font-weight: bold;text-align: right" hidden >
                                        {{--                                    <b class="ppn_value bg-white"  style="font-size: 14px;font-weight: bold;text-align: right;float: right">0</b>--}}
                                        <span class="ppn_value bg-white"  style="font-size: 14px;font-weight: bold;text-align: right;float: right"></span>
                                    </div>
                                    <div class="row justify-content-end">
                                        {{-- <h5><b class=>900</b></h5> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group " id="diskon_group">
                                <div class="row">
                                    <div class="col-md-9">
                                        <label style="float: right" class="form-label" id="examplenameInputname2">PPH</label>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="PPH" id="pph" hidden
                                               readonly  class="form-control" style="border: 0;font-size: 14px;font-weight: bold;text-align: right">
                                        <b class="pph_value bg-white"  style="font-size: 14px;font-weight: bold;float: right;">0</b>
                                    </div>
                                    <div class="row justify-content-end">
                                        {{-- <h5><b class=>900</b></h5> --}}
                                    </div>
                                </div>
                            </div>


                            <div class="form-group " id="diskon_group">
                                <div class="row">
                                    <div class="col-md-9">
                                        <label style="float: right" class="form-label" id="examplenameInputname2">Biaya Pengiriman</label>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-2">
                                        <input  type="text" name="biaya_pengiriman" id="paid_amount" hidden
                                                class="form-control" style="border: 0;font-size: 14px;font-weight: bold;text-align: right">
                                        <input  type="text" id="paid_amount_value"
                                                class="form-control" style="font-size: 14px;font-weight: bold;text-align: right">
                                    </div>
                                    <div class="row justify-content-end">
                                        {{-- <h5><b class=>900</b></h5> --}}
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-9">
                                    <label style="float: right" class="form-label" id="examplenameInputname2">Jumlah Tagihan</label>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-2 ">
                                    <b hidden class="total"></b>
                                    <input  type="number" name="total_balance" id="balance" readonly hidden
                                            class="form-control">
                                    <input hidden  type="number" id="totalgrand" readonly class="form-control">
                                    <input hidden type="text" class="total1 form-control" name="total"readonly style="border: 0;font-size: 14px;font-weight: bold;text-align: right">
                                    <span class="total1_value bg-white"  style="font-size: 14px;font-weight: bold;text-align: right;float: right">0</span>
                                    <br>
                                    <br>
                                    <input type="text" class="total1_back" hidden >
                                </div>
                            </div>
                        </div>




{{--                        s--}}

                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-8">
                                    <label style="float: right" class="form-label" id="examplenameInputname2">Bayar</label>
                                </div>
                                <div class="col-md-2">  <h5><b class="balance mt-5"></b></h5>
                                    <h5><input type="text"  id="bayar" name="bayar"  class="bayar form-control" ></h5>
                                    <input type="text"  id="total1" name="bayar1"  class="total1 form-control" hidden ></div>
                                <div class="col-md-2 ">
                                    <h5><b class="balance mt-5"></b></h5>
                                    <h5><input type="text"  id="sisa_tagihan" name="sisa_tagihan" readonly class="sisa_tagihan form-control" placeholder="Sisa Tagihan" ></h5>
                                    <input type="text"  id="total1" name="sisa_tagihan1"  class="total1 form-control" hidden >
                                    <input type="text"  id="status_pembayaran" name="status_pembayaran_penjualan"  class="status_pembayaran form-control" hidden  >
                                </div>
                            </div>
                        </div>
                            <div class="form-group mb-0 row justify-content-end">
                                <div class=" pull-right">
                                    <a href="{{ route('pengiriman.index') }}" class="btn btn-danger">Batal</a>
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection


@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
          rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>

        $('#id_bank').hide(300);
        $('.label_bank').hide(300);
        $('#value_bayar').val('tunai');

            $('#jenis_bayar').on('change',function (){
                if ($(this).prop("checked") == false) {

                    $('#id_bank').show(300);
                    $('#value_bayar').val('non_tunai');

                    $('.label_bank').show(300);
                } else if ($(this).prop("checked") == true) {
                    $('#id_bank').hide(300);
                    $('.label_bank').hide(300);
                    $('#value_bayar').val('tunai');

                }
                });
        // $('#id_bank').select2();
        $('#penawaran').on('change', function () {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    type: "GET",
                    url: "{{route('getdatapemesanan')}}?country_id=" + id,
                    success: function (res) {
                        if (res) {

                            $('#alamat').empty()
                            $('#no_telp').empty()
                            $('#terminn').empty()
                            $('#terminnn').empty()
                            $('#terminn1').empty()
                            $('#pelanggan1').empty()
                            $("tbody").children().remove()

                            $.each(res, function (i) {
                                console.log(res)
                                var total = 0;

                                var name = res[i].id;
                                // var produk_id = res[i].produk_id;
                                var produk_id = res[i].produks.id;
                                var name = res[i].produks.nama_produk;
                                var kodeproduk = res[i].produks.kode_produk;
                                var harga_jual = res[i].produks.harga_anggota;
                                var diskonproduk = res[i].diskon;
                                var anggo = res[i].pemesanan[0].anggota;
                                if (anggo == 1){
                                    var anggota_html = 'Ya';
                                }else{
                                    var anggota_html = 'Tidak';
                                }
                                var satuan = res[i].produks.satuan.satuan_produk;
                                var pph = res[i].pemesanan[0].PPH - 0;
                                var no_penawaran = res[i].pemesanan[0].penawaran.no_pesanan;
                                var ppn = res[i].pemesanan[0].PPN - 0;
                                var ppn_value = res[i].total_ppn - 0;
                                var pph_value = res[i].total_pph - 0;
                                var biaya_pengiriman = res[i].pemesanan[0].biaya_pengiriman - 0;
                                var total_amount = res[i].total_amount;
                                var pajak_type = res[i].pajak_type;

                                var harga_produk = res[i].harga_produk;
                                var total_amount_all = res[i].total_amount_all;
                                var total_diskon = res[i].total_diskon -0;
                                var kodeproduk = res[i].produks.kode_produk;
                                var diskontotal = res[i].pemesanan[0].diskontotal;

                                var total_diskon = res[i].total_diskon;
                                var harga_jual = res[i].harga_produk;
                                var totalproduk = res[i].total;
                                var total = res[i].totalproduk;
                                var totall = res[i].pemesanan[0].subtotal;
                                var alamat = res[i].pemesanan[0].alamat;
                                var pajako = res[i].pajak;
                                var totalallgrand = res[i].pemesanan[0].total;

                                var pel = res[i].pemesanan[0].id_pelanggan;

                                if (pel != null){
                                   var pel1 = res[i].pemesanan[0].anggotas.nama_pemohon;
                                }else{
                                    var pel1 = res[i].pemesanan[0].non_anggota;
                                }
                                var termin2= res[i].pemesanan[0].termins.nama_termin_penjualan;
                                var termin21= res[i].pemesanan[0].termins.id;

                                var no_telepon = res[i].pemesanan[0].no_telp;
                                var anggot = res[i].pemesanan[0].anggota;
                                console.log(res[i].pemesanan[0].anggota)
                                if (anggot == '1'){
                                    $("#smpn_adaAO_value").val(1);
                                    $('.onanggota').prop("checked") == true
                                }else{
                                    $("#smpn_adaAO_value").val(0);
                                    $('.onanggota').prop("checked") == false
                                }

                                // var termin1 = res[i].terminss.id;
                                // console.log(termin2)
                                $('.total_subtotal_text').val(totall)
                                $('.total_subtotal_text1').html(totall)
                                $('.diskon_per_item').val(total_diskon)
                                $('.diskon_per_item1').html(total_diskon)
                                $('#paid_amount').val(biaya_pengiriman)
                                $('#paid_amount_value').val(biaya_pengiriman)
                                $('.total1').val(totalallgrand)
                                $('.diskontotalpersen').val(diskontotal)
                                $('.diskontotalpersen_value').html(diskontotal)

                                $('.total1_value').html(totalallgrand)
                                $('#ppn').val(ppn)
                                $('.ppn_value').html(ppn)
                                $('#pph').val(pph)
                                $('.pph_value').html('('+pph+')')
                                $('.status_keanggotaans').html(anggota_html)
                                $('#totall').val(totall)
                                $('#alamat').val(alamat)
                                $('#no_telp').val(no_telepon)
                                $('#terminn').val(termin2)
                                $('#terminn1').val(termin21)
                                $('#pembayar').val(no_penawaran)
                                // $('#terminnn').val(termin1)
                                $('#pelanggan1').val(pel1)
                                $('#onanggotavalue').val(res[i].pemesanan[0].pelanggan)
                                $('#paid_amount').val(res[i].pemesanan[0].biaya_pengiriman)
                                $('#pajak_seluruhs').val(res[i].pemesanan[0].pajaktotal)
                                $('#paj').val((totall * res[i].pemesanan[0].pajaktotal)/100)
                                $('#balance').val((parseFloat(res[i].pemesanan[0].total)  + parseFloat(res[i].pemesanan[0].biaya_pengiriman)) - (totall * res[i].pemesanan[0].pajaktotal)/100)
                                $('#pelanggan1231').val(pel)
                                $('#smpn_adaAO_value').val(1)
                                var qty = res[i].qty;
                                var produk = $('.produk_id').html();


                                let product = @php echo json_encode($produk_get); @endphp;
                                let myOptions = '';
                                product.forEach(value => {
                                    myOptions += `<option value="${value.id}" data-harga="${value.harga_anggota}" data-produk="${value.kode_produk}"data-satuan="${value.satuan_produk}"`;
                                    if (value.id == res[i].produks.id) myOptions += `selected`;
                                    myOptions +=`>${value.nama_produk}</option>;`
                                });
                                var pajak1 = '<option></option>  @foreach ($pajak as $p)<option value="{{$p->id}}"data-values="{{$p->tarif_persentase}}"data-pajak="{{$p->pemotongan}}">{{$p->nama_pajak}}</option>@endforeach';

                                let pajak = @php echo json_encode($pajak);  @endphp;
                                console.log(pajak)
                                let mypajak = '';
                                pajak.forEach(value => {
                                    mypajak += `<option value="${value.id}" data-values="${value.tarif_persentase}" data-pajak="${value.pemotongan}"data-satuan="${value.satuan_produk}"`;
                                    if (value.id == pajako ) mypajak += `selected`;
                                    mypajak +=`>${value.nama_pajak}</option>;`
                                })
{{--                                var myOptions = '<option></option> @foreach ($pro1duk as $produks)<option data-harga="{{$produks->harga_jual}}"data-produk="{{$produks->kode_produk}}"data-satuan="{{$produks->satuan->satuan_produk ?? ""}}"value="{{$produks->id}}" @if ($produks->id == produk_id)seleceted @endif>{{$produks->nama_produk}}</option>@endforeach';                                var myOptions = '<option></option> @foreach ($produk as $produks)<option data-harga="{{$produks->harga_jual}}"data-produk="{{$produks->kode_produk}}"data-satuan="{{$produks->satuan->satuan_produk ?? ''}}"value="{{$produks->id}}">{{$produks->nama_produk}}</option>@endforeach';--}}
                                    var tr = $('<tr/>');


                                tr.append('<td><select class="form-control id_produk" name="id_produk[]" style="font-size: 13px;">' + myOptions + '</select>');
                                tr.append("</td>");

                                    tr.append('<td><input readonly type="text" name="kode_produk[]" id="kode_produk" value='+kodeproduk+' class="form-control kode_produk">');
                                    tr.append("</td>");
                                    tr.append('<td><input readonly type="text" name="satuan[]" id="satuan" value='+satuan+' class="form-control satuan">');
                                    tr.append("</td>");
                                    tr.append('<td><input readonly type="text" name="qty[]" id="qty" value='+qty+' class="form-control qty">');
                                    tr.append("</td>");
                                    tr.append('<td><input readonly type="text" name="harga[]" id="harga" value='+harga_jual+' class="form-control harga">');
                                    tr.append("</td>");
                                    tr.append('<td><input readonly type="text" name="diskon[]" id="diskon" value='+diskonproduk+' class="form-control diskon">');
                                    tr.append("</td>");
                                tr.append('<td><select class="form-control pajak" name="pajak[]"style="font-size: 10px;">' + mypajak + '</select>');
                                tr.append("</td>");
                                tr.append('<td hidden><input readonly type="text" name="total_pajak[]" id="total_pajak" value='+ppn_value+' class="form-control total_pajak">');
                                tr.append("</td>");
                                tr.append('<td hidden><input readonly type="text" name="total_pajak_pph[]" id="total_pajak_pph" value='+pph_value+' class="form-control total_pajak_pph">');
                                tr.append("</td>");
                                tr.append('<td hidden><input readonly type="text" name="pajaktype[]" id="pajaktype" value='+pajak_type+' class="form-control pajaktype">');
                                tr.append("</td>");
                                tr.append('<td ><input readonly type="text" name="total_amount[]" id="total" value='+total_amount+' class="form-control total_amount">');
                                tr.append("</td>");
                                tr.append('<td hidden><input readonly type="text" name="diskongrand[]" id="diskongrand" value='+harga_produk+' class="form-control diskongrand">');
                                tr.append("</td>");
                                tr.append('<td hidden><input readonly type="text" name="total_amount_all[]" id="total_amount_all" value='+total_amount_all+' class="form-control total_amount_all">');
                                tr.append("</td>");
                                tr.append('<td hidden><input readonly type="text" name="total_sub[]" id="total_sub" value='+total_amount+' class="form-control total_sub">');
                                tr.append("</td>");
                                tr.append('<td hidden><input readonly type="text" name="total_disk[]" id="total_disk" value='+total_diskon+' class="form-control total_disk">');
                                tr.append("</td>");
                                tr.append('<td hidden><input readonly type="text" name="total_amount[]" id="total" value='+total_amount+' class="form-control total_amount">');
                                tr.append("</td>");

                                // tr.append('<td ><input readonly type="text" name="termin1[]" id="termin" value='+termin+' class="form-control termin">');
                                // tr.append("</td>");
                                // tr.append('<td hidden><input readonly type="text" name="termin[]" id="termin" value='+termin1+' class="form-control termin">');
                                // tr.append("</td>");

                                // tr.append('<td><input readonly type="text" name="total_amount[]" id="total_amount" value='+totalproduk+' class="form-control total_amount">');
                                //     tr.append("</td>");
                                   // tr.append('<td> <a href="#" class="btn btn-sm btn-danger rounded-circle delete"><i class="fa fa-trash"></i></a>');
                                   //  tr.append("</td>");
                                        $("#table").append(tr);
                                        });
                                    } else {

                            $("tbody").children().remove()
                                    }
                                }

                            });
                        } else {

                $("tbody").children().remove()
                        }
                    });

        $('#termin2').hide();
                    $('#i').hide();
                    $('#tel1').hide();
                    $('#al1').hide();
                    $('#smpn_adaAO_value').val('1');
        $('#ddtermin').attr("disabled", true);
        $('#onanggota').attr("disabled", true);
        $('#penawarann').show();

        $('#pelanggan').attr("disabled", true);
                 $('#simpanan_ada_ao').on('change', function () {
                        if ($(this).prop("checked") == true) {
                            $('#smpn_adaAO_value').val('1');
                            $('#simpanan_ada_aoLabel').html("Ya");
                            $('#pelanggan').attr("disabled", true);
                            $('#terminn').show();
                            $('#i').hide();
                            $('#penawarann').show();
                            $('#iii').show();
                            $('#onanggota').attr("disabled", true);

                            $('#termin').hide();
                            $('#termin2').hide();
                            $('#termin3').show();

                            $('#penawaran').attr("disabled", false);

                        } else if ($(this).prop("checked") == false) {
                            $('#smpn_adaAO_value').val('0');

                            $("tbody").children().remove()
                            $('#terminn').hide();
                            $('#termin').show();
                            $('#penawaran').val('');

                            $('#termin2').show();
                            $('#termin3').hide();
                            $('#i').show();
                            $('#iii').hide();

                            $('#onanggota').attr("disabled", false);
                            $('#simpanan_ada_aoLabel').html("Tidak");
                            $('#pelanggan').attr("disabled", false);
                            $('#termin').attr("disabled", false);
                            $('#penawaran').attr("disabled", true);


                        }
                    });

        $('#onanggota').on('change', function () {
            if ($(this).prop("checked") == true) {
                $('#onanggotavalue').val('1');

                $('#pelanggan').show();
                $('#iii').hide();
                $('#i').show();
                $('#pelanggan1').attr("disabled", true);


            } else if ($(this).prop("checked") == false) {
                $('#onanggotavalue').val('0');
                $('#pelanggan').hide();
                $('#iii').show();
                $('#i').hide();
                $('#pelanggan1').attr("disabled", false);
                $("#alamat").val('');
                $("#no_telp").val('');
            }
        });
                    $('.add_more').on('click', function () {
                        var product = $('.produk_id').html();
                        var termin = $('.termin').html();
                        var numberofrow = ($('.addMoreProduct tr').length - 0) + 1;
                        var myOptions = '<option></option> @foreach ($produk as $produks)<option data-harga="{{$produks->harga_anggota}}"data-produk="{{$produks->kode_produk}}"data-satuan="{{$produks->satuan->satuan_produk ?? ''}}"value="{{$produks->id}}">{{$produks->nama_produk}}</option>@endforeach';
                        var termin = '<option></option>  @foreach ($termin as $id => $name)<option value="{{$id}}">{{$name}}</option>@endforeach';
                            var tr = '<tr>' +
                                '<td><select class="form-control id_produk" name="id_produk[]">' + myOptions + '</select> </td>' +
                                '<td><input type="text" name="kode_produk[]" class="form-control kode_produk"></td>' +
                                '<td><input type="text" name="satuan[]" class="form-control satuan"></td>' +
                                '<td><input type="text" name="qty[]" class="form-control qty"></td>' +
                                '<td><input type="number" name="harga[]" class="form-control harga"></td>' +
                                '<td><input type="number" name="diskon[]" class="form-control diskon"></td>' +
                                // '<td><input type="number" name="pajak[]" class="form-control pajak"></td>'+
                                '<td><select class="form-control termin" name="termin[]">' + termin + '</select></td>' +
                                '<td><input type="number" name="total_amount[]" class="form-control total_amount"></td>' +
                                '<td><a class="btn btn-danger btn-sm delete rounded-circle"><i class="fa fa-trash"></i></a></td>';
                            $('.addMoreProduct').append(tr);

                    });

                        $('.addMoreProduct').delegate('.delete', 'click', function () {
                            var tr = $(this).parent().parent();
                            var price = tr.find('.produk_id option:selected').attr('data-harga');
                            var produk = tr.find('.produk_id option:selected').attr('data-produk');
                            var satuan = tr.find('.produk_id option:selected').attr('data-satuan');
                            tr.find('.harga').val(price);
                            tr.find('.kode_produk').val(produk);
                            tr.find('.satuan').val(satuan);
                            var qty = tr.find('.qty').val() - 0;
                            var disc = tr.find('.diskon').val() - 0;
                            var price = tr.find('.harga').val() - 0;
                            var total_amount = (qty * price) - ((qty * price * disc) / 100);
                            tr.find('.total_amount').val(total_amount);
                            $(this).parent().parent().remove();
                            EndAmount();
                        });

                        function TotalAmount() {
                            var total = 0;
                            $('.total_amount').each(function (i, e) {
                                var amount = $(this).val() - 0;
                                total += amount;
                            });
                            $('.total').html(total);
                            $('#totall').val(total);
                        }

                        function EndAmount() {
                            var total = 0;
                            $('.total_amount').each(function (i, e) {
                                var amount = $(this).val() - 0;
                                total += amount;
                            });
                            $('.total').html(total);
                            $('#totall').val(total);

                        }

                        $('.addMoreProduct').delegate('.id_produk', 'change', function () {
                            var tr = $(this).parent().parent();
                            var price = tr.find('.id_produk option:selected').attr('data-harga');
                            var produk = tr.find('.id_produk option:selected').attr('data-produk');
                            var satuan = tr.find('.id_produk option:selected').attr('data-satuan');
                            // var pajak = tr.find('.pajak option:selected').val(10);
                            // tr.find('.pajak').val(pajak);
                            tr.find('.harga').val(price);
                            tr.find('.kode_produk').val(produk);
                            tr.find('.satuan').val(satuan);
                            var quan = tr.find('.qty').val() - 0;
                            var disc = tr.find('.diskon').val() - 0;
                            var price = tr.find('.harga').val() - 0;
                            var total_amount = (qty * price) - ((qty * price * disc) / 100);
                            tr.find('.total_amount').val(total_amount);
                            TotalAmount();
                            $('#totall').hide();
                        });
                        $('.addMoreProduct').delegate('.qty, .diskon', 'keyup', function () {
                            // var pajak = 0;
                            var tr = $(this).parent().parent();
                            var qty = tr.find('.qty').val() - 0;
                            var disc = tr.find('.diskon').val() - 0;
                            var price = tr.find('.harga').val() - 0;

                            var total_amount = (qty * price) - ((qty * price * disc) / 100);
                            tr.find('.total_amount').val(total_amount);
                            TotalAmount();

                            $('#totall').hide();

                        });
                        $('.addMoreProduct').delegate('.qty, .diskon', 'change', function () {
                            var tr = $(this).parent().parent();
                            var qty = tr.find('.qty').val() - 0;
                            var disc = tr.find('.diskon').val() - 0;
                            var price = tr.find('.harga').val() - 0;
                            // var total_amount = (qty * price) - ((qty * price * disc) / 100) ;
                            // var total_amountt = total_amount  + (( total_amount * pajak )/ 100) ;
                            var total_amount = (qty * price) - ((qty * price * disc) / 100);
                            tr.find('.total_amount').val(total_amount);
                            TotalAmount();
                            $('#totall').hide();


                        });

                        $('#paid_amount').keyup(function () {
                            var total = $('#totall').val();
                            var conver = parseFloat(total);
                            var paid_amount = parseFloat($(this).val())
                            var tot = conver + paid_amount;
                            $('#balance').val(tot);
                            $('.total1').val(tot);
                        })
                        $('#diskontotal').hide();
                        $('#diskonvalue').val('1');
                        $('#diskon2').on('click', function () {
                            if ($(this).prop("checked") == true) {
                                $('#diskonvalue').val('1');
                                $('#diskon2label').html(" % ");
                                $('#diskontotal').hide();
                                $('#diskontotalpersen').show();
                            } else if ($(this).prop("checked") == false) {
                                $('#diskonvalue').val('0');
                                $('#diskon2label').html(" RP ");
                                $('#diskontotal').show();

                                $('#diskontotalpersen').hide();
                                $("#alamat").empty();
                                $("#no_telp").empty();
                            }
                        });


                        $('#pajak_seluruhs').keyup(function () {
                            var total = $('#totall').val();
                            var conver = parseFloat(total);
                            var paid_amount1 = $(this).val();
                            console.log(total)
                            console.log(paid_amount1)
                            var tot = (conver) - ((conver * paid_amount1) / 100);
                            var tot2 = ((conver * paid_amount1) / 100);
                            $('#balance').val(tot);
                            $('#paj').val(tot2)
                        })

        $('#bayar').keyup(function () {
            var total = $('.total1').val();
            var conver = parseFloat(total);
            var paid_amount1 = $(this).val();
            var tot = total - paid_amount1
            $('#sisa_tagihan').val(tot);

            if($('#sisa_tagihan').val() == '0')
            {
                $('#status_pembayaran').val('Lunas')
            }else{
                $('#status_pembayaran').val('Belum Lunas')
            }
        })
                        $('#diskontotal').keyup(function () {
                            var total = $('.total1').val();
                            var conver = parseFloat(total);
                            var paid_amount1 = $(this).val();
                            console.log(total)
                            console.log(paid_amount1)
                            var tot = conver - paid_amount1;
                            $('#balance').val(tot);
                        })

                        $('#pelanggan').on('change', function () {
                            var id = $(this).val();
                            if (id) {
                                $.ajax({
                                    type: "GET",
                                    url: "{{route('getdatapenjualan')}}?country_id=" + id,
                                    success: function (res) {
                                        if (res) {
                                            $("#alamat").empty();
                                            $("#no_telp").empty();
                                            $.each(res, function (key, value) {
                                                $("#alamat").val(res.nama_jalan + ' No.' + res.no_rumah + ' Rt/Rw ' + res.rtrw);
                                                $("#no_telp").val(res.no_telpon);
                                            });
                                        } else {
                                            $("#alamat").empty();
                                            $("#no_telp").empty();

                                        }
                                    }
                                });
                            } else {
                                $("#alamat").empty();
                                $("#no_telp").empty();
                            }
                        })
                    </script>
                @endpush
