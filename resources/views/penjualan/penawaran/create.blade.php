@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">Pemesanan</h3>
    <br>
{{--    <br xmlns="http://www.w3.org/1999/html">--}}
{{--    <x-breadcrumb title="{{ __('Informasi Pemesanan') }}">--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('pemesanan_penjualan.index') }}">{{ __('Pemesanan') }}</a>--}}
{{--        </li>--}}
{{--        <li class="breadcrumb-item">--}}
{{--            {{ __('Pemesanan') }}--}}
{{--        </li>--}}
{{--    </x-breadcrumb>--}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card m-b-20">
                <div class="card-header">
                    <h3 class="card-title">Tambah Pemesanan</h3>

                </div>
                <form method="post" action="{{route('pemesanan_penjualan.store')}}">
                    @csrf
                    <div class="card-body">

                    <div class="form-row">
                        <div class="form-group col-md-2">

                                <div class="form-group">
                                    <label class=" form-label" for="nama_jalan">{{ __('Penawaran') }}</label>
                                </div>

                                <div class="form-group">
                                        <input type="checkbox" id="simpanan_ada_ao" name="ao" data-toggle="toggle"
                                               data-on="Ada" data-off="Tidak Ada" data-onstyle="success"
                                               data-offstyle="dark"
                                               checked>
{{--                                    <label for="simpanan_ada_ao"--}}
{{--                                           id="simpanan_ada_aoLabel">Ya</label>--}}
                                </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-group"  id="penawarann">
                                <label class="form-label" for="exampleInputEmail1" id="penawaran_label">No Penawaran</label>
                                <select name="no_penawaran" id="penawaran" class="form-control select2">
                                    <option value="">Pilih No.Penawaran</option>
                                    @foreach($penjualan as $penjualans)
                                        <option value="{{$penjualans->id}}">{{$penjualans->no_pesanan}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                        </div>
                        <div class="form-group col-md-2 keanggotaan" >

                            <div class="form-group ">
                                <label class=" form-label" for="status_keanggotaans">{{ __('Status Keanggotaan') }}</label>
                            </div>
                            <div class="form-group">
                                <b class="status_keanggotaans"></b>
                            </div>

                        </div>

                        <input type="text" id="smpn_adaAO_value" name="ada_penawaran" hidden>

                        <div class="form-group col-md-3 stat">

                            <div class="form-group">
                                <label class=" form-label" for="nama_jalan">{{ __('Status Keanggotaan') }}</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="onanggota" class="onanggota" name="pelanggan" data-toggle="toggle"
                                       data-on="Anggota" data-off="Bukan Anggota" data-onstyle="success"
                                       data-offstyle="dark" checked>
                            </div>
                            <input type="text" id="onanggotavalue" name="pelanggan" hidden>
                        </div>
                        <div class="form-group col-md-6" id="i">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Nama</label>
                                <select id="pelanggan" name="pelangganpilih" class="form-control"
                                >
                                    <option value="">-- Pilih Nama --</option>
                                    @foreach ($anggota as $supp)
                                        <option value="{{ $supp->id }}">{{ $supp->nama_pemohon }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6" id="iii">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Nama</label>
                                <input type="text" name="id_pelanggan12" id="pelanggan1" class="form-control" readonly >
                                <input type="text" name="id_pelanggan" id="pelanggan1231" class="form-control" hidden >
                            </div>
                        </div>
                        <div class="form-grakadoup col-md-6" id="tel">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">No Telepon</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telp" readonly >
                            </div>
                        </div>
                        <div class="form-group col-md-6" id="al">
                            <div class="form-group" >
                                <label class="form-label" for="exampleInputEmail1"
                                       >Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" readonly >
                            </div>
                        </div>


                        <input type="text" hidden value="BARU" name="status">

                        <div class="form-group col-md-6">
                            <div class="form-group" >
                                <label class="form-label" for="exampleInputEmail1">Tanggal Pemesanan</label>
                                <input type="date" class="form-control" id="tanggal_penerimaan" name="tanggal_pemesanan">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group" >
                                <label class="form-label" for="exampleInputEmail1">No Pesanan</label>
                                <input type="text" class="form-control" id="no_pesanan" name="no_pemesanan"
                                       value="{{$auto->head??''}}/@if(empty($auto->format_depan))@else{{date($auto->format_depan)}}/@endif @if(empty($auto->format_tengah))@else{{date($auto->format_tengah)}}/@endif @if(empty($auto->format_belakang))@else{{date($auto->format_belakang)}}/@endif{{$count}}"
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
                                <input type="text" id="terminn" name="termin_pemesanan1"  class="form-control" readonly hidden>
                                <input type="text" id="terminn1" name="termin_pemesanan"  class="form-control" readonly >
{{--                                <input type="text" id="terminnn" name="terminnn"  class="form-control" hidden>--}}
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group" style="margin-right: 10px">
                                <label class="form-label" for="exampleInputEmail1">Reference</label>
                                <input type="text" class="form-control" id="reference" name="reference">
                            </div>
                        </div>

                    </div>
                        <input type="text" class="total1_back" hidden >

                        <div class="table-responsive">
                        <table class="table card-table table-center text-nowrap table-primary" width="100%" id="table">
                            <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-white" width="170px">Nama Produk</th>
                                <th class="text-white" width="110">Kode Produk</th>
                                <th class="text-white"width="90">satuan Produk</th>
                                <th class="text-white" width="90">qty</th>
                                <th class="text-white">harga</th>
                                <th class="text-white" width="90">diskon %</th>
                                <th class="text-white" width="130">Pajak</th>
                                <th class="text-white" width="150">total</th>
{{--                                <th class="text-white" width="90">total_pajak_pph</th>--}}
{{--                                <th class="text-white" width="90">pajaktype</th>--}}
{{--                                <th class="text-white" width="90">total_amount</th>--}}
{{--                                <th class="text-white" width="90">diskongrand</th>--}}
{{--                                <th class="text-white" width="90">total_amount_all</th>--}}
{{--                                <th class="text-white" width="90">total_sub</th>--}}
{{--                                <th class="text-white" width="90">total_disk</th>--}}
{{--                                <th class="text-white" width="90">Pajak</th>--}}
{{--                                <th class="text-white" >Termin</th>--}}
{{--                                <th class="text-white">Total</th>--}}
                                <th class="text-white"></th>

                            </tr>
                            </thead>
                            <tbody class="addMoreProduct">
                            </tbody>

                        </table>
                    </div>
                        <div class="">
                            <button type="button" class="btn btn-sm btn-success add_more">Tambah
                                Barang</button>
                        </div>

                        <div class="form-horizontal " id="moreTwo">
                            <div class="form-group " id="diskon_group">
                                <div class="row">
                                    <div class="col-md-9">
                                        <label style="float: right" class="form-label" id="examplenameInputname2">Sub Total</label>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-2">
                                        <input  type="number"  name="subtotal_produk"
                                                readonly  class="form-control total_subtotal_text" style="border: 0;font-size: 14px;font-weight: bold;text-align: right" id="total_subtotal_text" hidden>
                                        <b class="total_subtotal_text1 bg-white "  style="font-size: 14px;font-weight: bold;text-align: right;float: right">0</b>
                                    </div>
                                    <div class="row justify-content-end">
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
                                        <label style="float: right" class="form-label" id="examplenameInputname2">Diskon</label>
                                        <label class="switch"style="float: right">
                                            <input style="float: right" type="checkbox" data-size="sm" id="diskon2" name="diskon2"
                                                   data-toggle="toggle" data-on="%" data-off="RP" data-onstyle="success"
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
                                        <input type="number"   readonly id="diskontotalpersen1" class="form-control ml-2" style="border: 0;font-size: 14px;font-weight: bold;text-align: right;" hidden>
                                        <div class=""style="margin-left: 50px">
                                            {{--                                        <input type="number" readonly id="diskontotalpersen1_value" class="form-control" style="border: 0;font-size: 14px;font-weight: bold;">--}}
                                            <b class="diskontotalpersen1_value bg-white"  style="font-size: 14px;font-weight: bold;text-align: right;float: right" >0</b>
                                        </div>
                                        <input type="number" readonly id="diskontotal1" class="form-control" style="border: 0;font-size: 14px;font-weight: bold;text-align: right">
                                    </div>
                                    <div class="row justify-content-end">
                                        {{-- <h5><b class=>900</b></h5> --}}
                                    </div>
                                </div>
                            </div>
                            <input type="text" id="subtotal" name="subtotal" hidden>


                            <div class="form-group " id="diskon_group">
                                <div class="row">
                                    <div class="col-md-9">
                                        <label style="float: right" class="form-label" id="examplenameInputname2">PPN</label>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="PPN" id="ppn"hidden
                                               readonly  class="form-control" style="border: 0;font-size: 14px;font-weight: bold;text-align: right"  >
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
                                    <div class="col-md-2" style="float: right">
                                        <input type="number" name="PPH" id="pph" hidden
                                               readonly  class="form-control" style="border: 0;font-size: 14px;font-weight: bold;text-align: right">
                                        <span class="pph_value bg-white"  style="font-size: 14px;font-weight: bold;float: right;">(0)</span>
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
{{--                                        <input  type="text" name="biaya_pengiriman" id="paid_amount"--}}
{{--                                                class="form-control" style="border: 0;font-size: 14px;font-weight: bold;text-align: right">--}}
                                        <input  type="text" id="paid_amount_value"name="biaya_pengiriman" class="form-control ml-3"
                                                 style="font-size: 14px;font-weight: bold;text-align: right;margin-right: 4px">
                                        <input  type="text" id="paid_amount_value1"
                                                 style="font-size: 14px;font-weight: bold;text-align: right;border: 0;">
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
{{--                                        <input type="text" class="total1_back" hidden >--}}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-0 row justify-content-end">
                                <div class=" pull-right">
                                    <a href="{{ route('pemesanan_penjualan.index') }}" class="btn btn-danger">Batal</a>
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
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
          rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>


    <script>
        $('.select2').select2({
            tags: true,
            // placeholder: "Select an Option",
            allowClear: true,
            width: '100%'
        });
        $('#penawaran').on('change', function () {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    type: "GET",
                    url: "{{route('getdatapenawaran')}}?country_id=" + id,
                    success: function (res) {
                        if (res) {

                            $('#alamat').empty()
                            $('#no_telp').empty()
                            $('#terminn').empty()
                            // $('#terminnn').empty()
                            $('#terminn1').empty()
                            $('#pelanggan1').empty()

                            $("tbody").children().remove()
                            {{--                            var myOptions = `@foreach ($produk as $produks)<option data-harga="{{$produks->harga_anggota}}"data-produk="{{$produks->kode_produk}}"data-satuan="{{$produks->satuan->satuan_produk ?? ""}}"value="{{$produks->id}}">{{$produks->nama_produk}}</option>@endforeach`;--}}
                            $.each(res, function (i,key) {
                                console.log(res)
                                var name = res[i].id;
                                var name = res[i].produks.nama_produk;
                                var produk_idd = res[i].produks.id;
                                console.log(res[i].penjualan[0].total)
                                var totalallgrand1 = res[i].penjualan[0].total;
                                var anggo = res[i].penjualan[0].anggota;
                                if (anggo == 1){
                                    var anggota_html = 'Ya';
                                }else{
                                    var anggota_html = 'Tidak';
                                }
                                var pph = res[i].penjualan[0].PPH - 0;
                                var ppn = res[i].penjualan[0].PPN - 0;
                                var diskoncalculate = res[i].penjualan[0].diskoncalculate - 0;
                                var ppn_value = res[i].total_ppn - 0;
                                var pph_value = res[i].total_pph - 0;
                                var biaya_pengiriman = res[i].penjualan[0].biaya_pengiriman - 0;
                                var total_amount = res[i].total_amount;
                                var pajak_type = res[i].pajak_type;
                                var harga_produk = res[i].harga_produk;
                                var total_amount_all = res[i].total_amount_all;
                                var total_diskon = res[i].total_diskon -0;
                                var kodeproduk = res[i].produks.kode_produk;
                                var diskontotal = res[i].penjualan[0].diskontotal;
                                var total_diskon = res[i].total_diskon;
                                var harga_jual = res[i].harga_produk;
                                var diskonproduk = res[i].diskonproduk - 0;
                                var satuan = res[i].produks.satuan.satuan_produk;
                                if(res[i].id_terminproduk != 0){
                                    var termin = res[i].termins.nama_termin_penjualan;
                                }else{
                                    var termin = 0;
                                }
                                var totalproduk = res[i].totalproduk;
                                var total = res[i].totalproduk;

                                console.log(totall)
                                var alamat = res[i].penjualan[0].alamat;

                                var pel = res[i].penjualan[0].anggota;
                                console.log(res[i].penjualan[0])
                                if (pel != 0){
                                    var pel1 = res[i].penjualan[0].anggotas.nama_pemohon;
                                }else{
                                    var pel1 = res[i].penjualan[0].non_anggota;
                                }
                                var no_telepon = res[i].penjualan[0].no_telepon;
                                var anggot = res[i].penjualan[0].anggota;
                                var pengiriman = res[i].penjualan[0].biaya_pengiriman - 0;
                                var totalproduk = res[i].penjualan[0].total;
                                var pajako = res[i].pajak;
                                var termin21 = res[i].penjualan[0].id_termin - 0;
                                if (termin21 == ''){
                                    var termin21_value = '0';

                                }else{
                                    var termin21_value = res[i].penjualan[0].termins.nama_termin_penjualan;

                                }
                                var produk_id = res[i].produks.id;
                                var grandtotal = parseFloat(totall1) - parseFloat(pengiriman);
                                console.log(pengiriman,totalproduk,grandtotal)
                                console.log(res[i].penjualan[0].anggota)
                                $("#onanggotavalue").val(res[i].penjualan[0].anggota);
                                // var termin1 = res[i].termins.id;
                                // var termin2= res[i].termins.nama_termin_penjualan;
                                // console.log(termin2)
                                var totall = res[i].penjualan[0].subtotal;
                                var totall1 = res[i].penjualan[0].total;
                                $('.total_subtotal_text').val(totall)
                                $('.total_subtotal_text1').html(totall)
                                $('.diskon_per_item').val(total_diskon)
                                $('.diskon_per_item1').html(total_diskon)
                                $('#paid_amount').val(biaya_pengiriman)
                                $('#paid_amount_value').val(biaya_pengiriman)
                                $('.total1').val(res[i].penjualan[0].total+biaya_pengiriman)
                                $('.total1_value').html(res[i].penjualan[0].total+biaya_pengiriman)
                                $('#ppn').val(ppn)
                                $('.ppn_value').html(ppn)
                                $('#pph').val(pph)
                                $('.pph_value').html('('+pph+')')
                                $('.keanggotaan').show()
                                $('.status_keanggotaans').html(anggota_html)
                                $('#alamat').val(alamat)
                                $('#no_telp').val(no_telepon)
                                $('#terminn').val(termin21)
                                $('#terminn1').val(termin21_value)
                                $('#diskontotalpersen').val(diskontotal)
                                $('#diskontotalpersen1').val(diskoncalculate)
                                $('.diskontotalpersen1_value').html(diskoncalculate)
                                // $('#terminnn').val(termin1)
                                $('#paid_amount').val(pengiriman)
                                $('#pelanggan1').val(pel1)
                                $('#pelanggan1231').val(pel)
                                $('#balance').val(grandtotal)
                                var qty = res[i].qty;
                                var produk = $('.produk_id').html();
                                {{--var myOptions = `<option></option> @foreach ($produk as $produks)<option data-harga="{{$produks->harga_anggota}}"data-produk="{{$produks->kode_produk}}"data-satuan="{{$produks->satuan->satuan_produk ?? ""}}"value="{{$produks->id}}">{{$produks->nama_produk}}</option>@endforeach`;--}}
                                {{--console.log(myOptions)--}}

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
                                // console.log(myOptions)
                                var tr = $('<tr/>');
                                tr.append('<td><select class="form-control id_produk" name="id_produk[]" style="font-size: 13px;">' + myOptions + '</select>');
                                tr.append("</td>");
                                tr.append('<td><input readonly type="text" name="kode_produk[]" style="font-size: 13px;" id="kode_produk" value='+kodeproduk+' class="form-control kode_produk">');
                                tr.append("</td>");
                                tr.append('<td><input readonly type="text" name="satuan[]" id="satuan" style="font-size: 13px;" value='+satuan+' class="form-control satuan">');
                                tr.append("</td>");
                                tr.append('<td><input  type="text" name="qty[]" id="qty" style="font-size: 13px;" value='+qty+' class="form-control qty">');
                                tr.append("</td>");
                                tr.append('<td><input  type="text" name="harga[]" id="harga" style="font-size: 13px;" value='+harga_jual+' class="form-control harga">');
                                tr.append("</td>");
                                tr.append('<td><input  type="text" name="diskon[]" id="diskon" style="font-size: 13px;" value='+diskonproduk+' class="form-control diskon">');
                                tr.append("</td>");
                                // tr.append('<td ><input readonly type="text" name="termin1[]" id="termin" value='+termin+' class="form-control termin">');
                                // tr.append("</td>");
                                // tr.append('<td hidden><input readonly type="text" name="termin[]" id="termin" value='+termin1+' class="form-control termin">');
                                // tr.append("</td>");
                                tr.append('<td><select class="form-control pajak" name="pajak[]"style="font-size: 13px;">' + '<option value="0">Pilih</option>' + mypajak + '</select>');
                                tr.append("</td>");
                                tr.append('<td hidden><input readonly type="text" name="total_pajak[]"style="font-size: 13px;" id="total_pajak" value='+ppn_value+' class="form-control total_pajak">');
                                tr.append("</td>");
                                tr.append('<td hidden><input readonly type="text" name="total_pajak_pph[]" id="total_pajak_pph"style="font-size: 13px;" value='+pph_value+' class="form-control total_pajak_pph">');
                                tr.append("</td>");
                                tr.append('<td hidden><input readonly type="text" name="pajaktype[]" id="pajaktype" style="font-size: 13px;" value='+pajak_type+' class="form-control pajaktype">');
                                tr.append("</td>");
                                tr.append('<td  ><input readonly type="text" name="total_amount[]" id="total" value='+total_amount+' class="form-control total_amount">');
                                tr.append("</td>");
                                tr.append('<td hidden><input readonly type="text" name="diskongrand[]" id="diskongrand" value='+harga_produk+' class="form-control diskongrand">');
                                tr.append("</td>");
                                tr.append('<td hidden><input readonly type="text" name="total_amount_all[]" id="total_amount_all" value='+total_amount_all+' class="form-control total_amount_all">');
                                tr.append("</td>");
                                tr.append('<td hidden><input readonly type="text" name="total_sub[]"style="font-size: 13px;"  id="total_sub" value='+total_amount+' class="form-control total_sub">');
                                tr.append("</td>");
                                tr.append('<td hidden><input readonly type="text" name="total_disk[]"style="font-size: 13px;" id="total_disk" value='+total_diskon+' class="form-control total_disk">');
                                tr.append("</td>");
                                tr.append('<td> <a href="#" class="btn btn-sm btn-danger rounded-circle delete"><i class="fa fa-trash"></i></a>');
                                tr.append("</td>");

                                $("#table").append(tr);
                                EndAmount();
                                TotalSub();
                                TotalDiskon();
                                TotalPajak();
                                TotalPajakpph();
                                totalpajakpphandppn();
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
                    // $('#smpn_adaAO_value').val('1');
        $('#ddtermin').attr("readonly", true);
        $('#onanggota').attr("readonly", true);
        $('#penawarann').show();
        $('#smpn_adaAO_value').val('1');
        $('#pelanggan').attr("readonly", true);
        $('.stat').hide();
        $('.keanggotaan').hide();

        $('#simpanan_ada_ao').on('change', function () {
                        if ($(this).prop("checked") == true) {
                            $('#smpn_adaAO_value').val('1');
                            $('#simpanan_ada_aoLabel').html("Ya");
                            $('#pelanggan').attr("readonly", true);
                            $('#terminn').show();
                            $('#i').hide();
                            $('#penawarann').show();
                            $('#penawaran').show();
                            $('#iii').show();
                            $('.keanggotaan').hide();

                            $('#onanggota').attr("readonly", true);
                            $('#termin').hide();
                            $('.stat').hide();
                            $('#termin2').hide();
                            $('#termin3').show();

                            $('#penawaran').attr("readonly", false);

                        } else if ($(this).prop("checked") == false) {
                            $('#smpn_adaAO_value').val('0');
                            $('.stat').show();
                            $('.keanggotaan').hide();

                            $("tbody").children().remove()
                            $('#terminn').hide();
                            $('#termin').show();
                            $('#penawaran').val('');
                            $('#penawaran').hide();
                            $('#penawarann').hide();
                            $('#penawaran_label').hide();

                            $('#termin2').show();
                            $('#termin3').hide();
                            $('#i').show();
                            $('#iii').hide();

                            $('#onanggota').attr("readonly", false);
                            $('#simpanan_ada_aoLabel').html("Tidak");
                            $('#pelanggan').attr("readonly", false);
                            $('#termin').attr("readonly", false);
                            $('#penawaran').attr("readonly", true);
                        }
                    });

        $('#onanggota').on('change', function () {
            if ($(this).prop("checked") == true) {
                $('#onanggotavalue').val('1');
                $('#pelanggan').show();
                $('#iii').hide();
                $('#i').show();
                $('#pelanggan1').attr("readonly", true);
            } else if ($(this).prop("checked") == false) {
                $('#onanggotavalue').val('0');
                $('#pelanggan').hide();
                $('#iii').show();
                $('#i').hide();
                $('#pelanggan1').attr("readonly", false);
                $("#alamat").val('');
                $("#no_telp").val('');
            }
        });
                    $('.add_more').on('click', function () {
                        var product = $('.produk_id').html();
                        var termin = $('.termin').html();
                        var numberofrow = ($('.addMoreProduct tr').length - 0) + 1;
                        var myOptions = '<option data-harga="0" value="0"></option> @foreach ($produk as $produks)<option data-harga="{{$produks->harga_anggota}}"data-produk="{{$produks->kode_produk}}"data-satuan="{{$produks->satuan->satuan_produk ?? ''}}"value="{{$produks->id}}">{{$produks->nama_produk}}</option>@endforeach';
                        var pajak1 = '<option data-values="0"></option>  @foreach ($pajak as $p)<option value="{{$p->id}}"data-values="{{$p->tarif_persentase}}"data-pajak="{{$p->pemotongan}}">{{$p->nama_pajak}}</option>@endforeach';
                            var tr = '<tr>' +
                                '<td><select class="form-control id_produk" name="id_produk[]"style="font-size: 13px;">' + myOptions + '</select> </td>' +
                                '<td><input type="text" name="kode_produk[]" class="form-control kode_produk"style="font-size: 13px;"></td>' +
                                '<td><input type="text" name="satuan[]" class="form-control satuan"style="font-size: 13px;"></td>' +
                                '<td><input type="text" name="qty[]" class="form-control qty"style="font-size: 13px;"></td>' +
                                '<td><input type="text" name="harga[]" class="form-control harga"style="font-size: 13px;"></td>' +
                                '<td><input type="text" name="diskon[]" class="form-control diskon"style="font-size: 13px;"></td>' +
                                // '<td><input type="number" name="pajak[]" class="form-control pajak"></td>'+
                                '<td><select class="form-control pajak" name="pajak[]"style="font-size: 13px;">' + pajak1 + '</select></td>' +
                                '<td hidden><input type="number"  readonly name="total_pajak[]" class="form-control total_pajak"style="font-size: 13px"></td>' +
                                '<td hidden><input type="number"  readonly name="total_pajak_pph[]" class="form-control total_pajak_pph"style="font-size: 13px"></td>' +
                                '<td hidden><input type="number"  readonly name="pajaktype[]" class="form-control pajaktype"style="font-size: 13px"></td>' +
                                '<td hidden><input type="number"  readonly name="total_amount_all[]" class="form-control total_amount_all"style="font-size: 13px"></td>' +
                                '<td hidden><input type="number"  readonly name="total_sub[]" class="form-control total_sub"style="font-size: 13px"></td>' +
                                '<td hidden><input type="number"  readonly name="total_disk[]" class="form-control total_disk"style="font-size: 13px"></td>' +
                                '<td ><input type="number" readonly name="total_amount[]" class="form-control total_amount"style="font-size: 13px"></td>' +
                                '<td hidden><input type="number" readonly name="diskongrand[]" class="form-control diskongrand"style="font-size: 13px"></td>' +
                                '<td><a class="btn btn-danger btn-sm delete rounded-circle"><i class="fa fa-trash text-white"></i></a></td>';
                            $('.addMoreProduct').append(tr);


                    });


        $('.addMoreProduct').delegate('.qty','change',function (){
            var tr = $(this).parent().parent();
            var qty = tr.find('.qty').val();
            var id_produk = tr.find('.id_produk').val();
            $.ajax({
                url: "{{ route('penjualan.index') }}",
                method: 'GET',
                data: {qty: qty,produk_id:id_produk},
                success: function(response) {
                    console.log(response)
                    if (response.results== 'masih') {
                        tr.find('.id_produk').removeClass("is-invalid");
                    } else {
                        Swal.fire({
                            icon: 'error',
                            text: 'Stok Barang Tidak Mencukupi!',
                        });
                        tr.find('.qty').val('');
                        tr.find('.diskon').val('');
                        tr.find('.pajak').val('');
                        tr.find('.total_amount').val('');
                        tr.find('.total_pajak').val('');
                        tr.find('.total_pajak_pph').val('');
                        tr.find('.pajaktype').val('');
                        tr.find('.total_amount').val('');
                        tr.find('.diskongrand').val('');
                        tr.find('.total_amount_all').val('');
                        tr.find('.total_sub').val('');
                        tr.find('.total_disk').val('');
                        tr.find('.kode_produk').val('');
                        tr.find('.produk_id').val('');
                        tr.find('.satuan').val('');
                        tr.find('.harga').val('');
                        //trigger change
                        tr.find('.produk_id').trigger('change');
                        return false;
                        alert('')
                    }
                },
            });

        });
                        $('.addMoreProduct').delegate('.delete', 'click', function () {
                            var tr = $(this).parent().parent();
                            var price = tr.find('.produk_id option:selected').attr('data-harga');
                            var produk = tr.find('.produk_id option:selected').attr('data-produk');
                            var satuan = tr.find('.produk_id option:selected').attr('data-satuan');
                            var pajak = tr.find('.pajak option:selected').attr('data-values');
                            tr.find('.harga').val(price);
                            tr.find('.kode_produk').val(produk);
                            tr.find('.satuan').val(satuan);
                            var qty = tr.find('.qty').val() - 0;
                            var disc = tr.find('.diskon').val() - 0;
                            var price = tr.find('.harga').val() - 0;
                            var pajak = tr.find('.pajak').val() - 0;
                            var total_amount = (qty * price) - (((qty * price * disc) / 100) + ((qty * price * pajak) / 100));
                            var diskontotal = ((qty * price * disc) / 100);
                            var total_subtotal = (qty * price);
                            tr.find('.total_amount').val(total_amount);
                            tr.find('.total_disk').val(diskontotal);
                            tr.find('.total_sub').val(total_subtotal);
                            $(this).parent().parent().remove();
                            EndAmount();
                            TotalSub();
                            TotalDiskon();
                            TotalPajak();
                            TotalPajakpph();
                            totalpajakpphandppn();
                        });

        function TotalDiskon() {
            var total = 0;
            var tot = 0;
            $('.total_disk').each(function (i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            });
            $('#diskon_per_item').val(total);

            var tot = new Intl.NumberFormat().format(total);
            $('.diskon_per_item1').html(tot);
        }

        function totalpajakpphandppn(){
            var total = 0;
            var diskon = 0;
            var totaldiskon = 0;
            var totalreal = 0;
            var totalall = 0;

            var tot = 0;
            $('.total_amount').each(function (i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            });
            var totaldiskon = $('#diskontotalpersen').val();
            var diskon = parseFloat(totaldiskon);
            var totalreal = parseFloat(total);
            var totalall =(( diskon/ 100 )* totalreal );
            $('#diskontotalpersen1').val(totalall);

            var tot = new Intl.NumberFormat().format(totalall);
            $('.diskontotalpersen1_value').html(tot);
        }


        function TotalPajakpph() {
            var total = 0;
            var tot1 = 0;
            var tot = 0;
            $('.total_pajak_pph').each(function (i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            });
            if ( $('#diskontotalpersen').val() == ''){
                $('#pph').val(total);
                var tot = new Intl.NumberFormat().format(total);
                $('.pph_value').html('('+tot+')');
            }else{
                var totaldiskon = $('#diskontotalpersen').val();
                var totaldiskonvalue = $('#diskontotalpersen1').val();
                var diskon = parseFloat(totaldiskon);
                var value = parseFloat(totaldiskonvalue);
                var totalreal = parseFloat(total);
                var grand = totalreal - (( diskon/100 )*totalreal );

                $('#pph').val(grand);
                var tot1 = new Intl.NumberFormat().format(grand);

                $('.pph_value').html('('+tot1+')');

            }
        }
        function TotalPajak() {
            var total = 0;
            var totaldiskon = 0;
            var totaldiskonvalue = 0;
            var diskon = 0;
            var totalreal = 0;
            var grand = 0;
            var tot = 0;
            var tot1 = 0;
            var grand = 0;
            $('.total_pajak').each(function (i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            });

            if ($('#diskontotalpersen').val() == ''){
                $('#ppn').val(total);
                var tot = new Intl.NumberFormat().format(total);
                $('.ppn_value').html(tot);
            }else{
                var totaldiskon = $('#diskontotalpersen').val();
                var totaldiskonvalue = $('#diskontotalpersen1').val();
                var diskon = parseFloat(totaldiskon);
                var value = parseFloat(totaldiskonvalue);
                var totalreal = parseFloat(total);
                var grand = totalreal - (( diskon/100 )*totalreal );

                $('#ppn').val(grand);
                var tot1 = new Intl.NumberFormat().format(grand);
                $('.ppn_value').html(tot1);

            }
        }

        function TotalAmount() {
            var total = 0;
            var tot1 = 0;
            $('.total_amount_all').each(function (i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            });
            // $('.total').html(total);
            $('.total1').val(total);
            var tot1 = new Intl.NumberFormat().format(total);
            $('.total1_value').html(tot1);
            $('.total1_back').val(total);
            $('.totalgrand').val(total);
            $('#balance').val(total);

            $('#subtotal').val(total);
        }

        function TotalSub() {
            var total = 0;
            var test_value = 0;
            var tot = 0;
            $('.total_sub').each(function (i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            });
            $('.total_subtotal_text').val(total);
            var tot = new Intl.NumberFormat().format(total);
            $('.total_subtotal_text1').html(tot);

            // $('#subtotal').val(total);
        }
        function EndAmount() {
            var total = 0;
            var tot1 = 0;
            $('.total_amount_all').each(function (i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            });
            $('.total').html(total);
            $('.total1').val(total);
            var tot1 = new Intl.NumberFormat().format(total);
            $('.total1_value').html(tot1);
            $('.total1_back').val(total);
            $('.totalgrand').val(total);
            $('#subtotal').val(total);
            $('#balance').val(total);

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
                            var pajak = tr.find('.pajak option:selected').attr('data-values')- 0;
                            var biaya = $('#paid_amount').val() - 0;

                            var total_amount = biaya + ((quan * price) - (((quan * price * disc) / 100)));
                            tr.find('.total_amount').val(total_amount);
                            TotalAmount();
                        });
                        $('.addMoreProduct').delegate('.id_produk,.qty, .diskon, .pajak ,.harga,#paid_amount_value', 'keyup', function () {
                            // var pajak = 0;
                            var tr = $(this).parent().parent();
                            var pajaktype = tr.find('.pajak option:selected').attr('data-pajak');
                            var qty = tr.find('.qty').val() - 0;
                            var disc = tr.find('.diskon').val() - 0;
                            var price = tr.find('.harga').val() - 0;
                            var pajak = tr.find('.pajak option:selected').attr('data-values') - 0;
                            var biaya = $('#paid_amount_value').val() - 0;
                            var total_amount =((qty * price) - ((qty * price * disc) / 100));
                            var diskontotal = ((qty * price * disc) / 100);
                            var total_subtotal = (qty * price);
                            var totalproduk = ((pajak * ((qty * price) - ((qty * price * disc) / 100)) / 100));
                            if (pajaktype == '1') {
                                tr.find('.total_pajak').val(totalproduk);
                                tr.find('.total_pajak_pph').val(0);
                                var total_amount_all =(biaya +  ((qty * price) - ((qty * price * disc) / 100) + (pajak * ((qty * price) - ((qty * price * pajak) / 100)) / 100)));
                                // var total_amount_all = (biaya + ((qty * price) - ((qty * price * disc) / 100) + ((pajak * ((qty * price) - ((qty * price * disc) / 100)) / 100) - (diskongrand*(pajak * price) - (qty * price * disc)/100))/100)) ;
                            } else {
                                tr.find('.total_pajak_pph').val(totalproduk);
                                tr.find('.total_pajak').val(0);
                                var total_amount_all = biaya + ((qty * price) - ((qty * price * disc) / 100) - (pajak * ((qty * price) - ((qty * price * disc) / 100)) / 100)) ;
                            }
                            tr.find('.total_amount_all').val(total_amount_all);
                            tr.find('.total_amount').val(total_amount);
                            tr.find('.total_disk').val(diskontotal);
                            tr.find('.total_sub').val(total_subtotal);

                            TotalAmount();
                            TotalSub();
                            TotalAmount();
                            TotalDiskon();
                            TotalPajak();
                            totalpajakpphandppn();
                        });
                        $('.addMoreProduct').delegate('.id_produk,.qty, .diskon', 'keyup change', function () {
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


        $('.addMoreProduct').delegate('.qty,.diskon,.pajak,.harga,#paid_amount_value', 'keyup change', function () {
            // $('#diskontotalpersen').val('') ;
            // $('#diskontotalpersen1').val('') ;
            // $('#diskontotal1').val('') ;
            // $('#diskontotal').val('') ;


            var tr = $(this).parent().parent();
            var pajaktype = tr.find('.pajak option:selected').attr('data-pajak');
            var qty = tr.find('.qty').val() - 0;
            var disc = tr.find('.diskon').val() - 0;
            var price = tr.find('.harga').val() - 0;
            var pajak = tr.find('.pajak option:selected').attr('data-values')- 0;


            var totalamount = tr.find('.total_amount').val() - 0;
            var diskontotalpersen = $('#diskontotalpersen').val() - 0;
            var biaya = $('#paid_amount_value').val() - 0;
            var totalproduk = (pajak * ((qty * price) - ((qty * price * disc) / 100)) / 100);
            var total_amount = ((qty * price) - ((qty * price * disc) / 100));
            var diskontotal = ((qty * price * disc) / 100);
            var total_subtotal = (qty * price);
            if (pajaktype == '1') {
                tr.find('.total_pajak').val(totalproduk);
                tr.find('.total_pajak_pph').val(0);
                // var total_amount_all =(biaya +  ((qty * price) - ((qty * price * disc) / 100) + (pajak * ((qty * price) - ((qty * price * pajak) / 100)) / 100)));
                var total_amount_all = (biaya + ((qty * price) - ((qty * price * disc) / 100) + (pajak * ((qty * price) - ((qty * price * disc) / 100)) / 100)));
            } else {
                tr.find('.total_pajak_pph').val(totalproduk);
                tr.find('.total_pajak').val(0);
                var total_amount_all = (biaya + ((qty * price) - ((qty * price * disc) / 100) - (pajak * ((qty * price) - ((qty * price * disc) / 100)) / 100)));
            }
            tr.find('.total_amount_all').val(total_amount_all);
            tr.find('.total_amount').val(total_amount);
            tr.find('.total_disk').val(diskontotal);
            tr.find('.total_sub').val(total_subtotal);

            TotalSub();
            TotalAmount();
            TotalDiskon();
            TotalPajak();
            TotalPajakpph();
            totalpajakpphandppn();
        });

        $('#paid_amount').val(0);
        // $('#paid_amount_value1').val(0);
        $('#diskontotalpersen').val(0);

        $('#paid_amount_value').keyup(function () {
            if ($(this).val() == ''){
                $(this).val(0);
            }
            var total = $('.total1_back').val();
            var conver = parseFloat(total);
            if($('#paid_amount_value1').val() != '')
            {
                var tot =  parseFloat($('#paid_amount_value').val()) + parseFloat($('#paid_amount_value1').val());
            }else{
                var tot =  parseFloat($('#paid_amount_value').val()) +conver;
            }

            $('.total1').val(tot);
            $('#balance').val(tot);
            var tot1 = new Intl.NumberFormat().format(tot);
            $('.total1_value').html(tot1);
            // $('.total1_back').val(tot);
        })

        $('#diskontotal1').hide();
        $('#paid_amount_value1').hide();
        $('#diskontotal').hide();
        $('#diskonvalue').val('1');
        $('#diskon2').on('change', function () {

            if ($(this).prop("checked") == true) {
                $('#diskontotalpersen').val('') ;
                $('#diskontotalpersen1').val('') ;
                $('#diskontotal1').val('') ;
                $('#diskontotal').val('') ;
                $('#diskonvalue').val('1');
                $('#diskon2label').html(" % ");
                $('#diskontotal').hide();
                $('#diskontotal1').hide();
                $('#diskontotalpersen').show();
                $('#diskontotalpersen1').show();
                $('#diskontotalpersen1_value').show();


            } else if ($(this).prop("checked") == false) {
                $('#diskontotalpersen').val('') ;
                $('#diskontotalpersen1').val('') ;
                $('#diskontotal1').val('') ;
                $('#diskontotal').val('') ;
                $('#diskonvalue').val('0');
                $('#diskon2label').html("RP");
                $('#diskontotal').show();
                $('#diskontotal1').show();
                $('#diskontotalpersen').hide();
                // $('#diskontotalpersen1').hide();
                $('#diskontotalpersen1_value').hide();
            }
        });


        $('#diskontotalpersen').keyup(function () {
            // $('.diskontotalpersen1_value').show();
            if ($(this).val() == ''){
                $(this).val(0);
            }
            var total = $('.total1_back').val();
            var conver = parseFloat(total);
            var paid_amount1 = $('#diskontotalpersen').val();
            var grand =conver  -  (( paid_amount1*conver )/ 100 );

            if($('#paid_amount_value').val() == ''){
                var grand =conver  -  (( paid_amount1*conver )/ 100 );

            }else{
                var grand =conver  -  (( paid_amount1*conver )/ 100 );
            }

            // $('#balance').val(grand);
            $('.total1').val(grand);
            var tot1 = new Intl.NumberFormat().format(grand);
            $('.total1_value').html(tot1);
            $('#paid_amount_value1').val(grand);

            // $('#diskontotalpersen1').val(dis);
            totalpajakpphandppn();
            TotalPajak();
            TotalPajakpph();

        })
        $('#diskontotal').keyup(function () {

            $('.diskontotalpersen1_value').hide();
            var total = $('#balance').val();
            var conver = parseFloat(total);
            var paid_amount1 = $(this).val();
            console.log(total)
            console.log(paid_amount1)
            var tot = conver - paid_amount1;
            $('#balance').val(tot);
            $('.total1').val(tot);
            var tot1 = new Intl.NumberFormat().format(tot);
            $('.total1_value').html(tot1);
            $('#diskontotal').val(paid_amount1);
            $('#diskontotal1').val(paid_amount1);

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
