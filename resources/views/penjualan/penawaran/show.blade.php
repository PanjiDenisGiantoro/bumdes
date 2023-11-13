@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">Pemesanan</h3>
    <br>
{{--    <br>--}}
{{--    <x-breadcrumb title="{{ __('Pemesanan') }}">--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('pemesanan_penjualan.index') }}">{{ __('Daftar Pemesanan') }}</a>--}}
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
                    <h3 class="card-title">Informasi Pemesanan</h3>

                </div>
                <form method="post" action="{{route('pemesanan_penjualan.store')}}">
                    @csrf
                    <div class="card-body">

                        <div class="form-row">
                            <div class="form-group col-md-2">

                                <div class="form-group">
                                    <label class=" form-label" for="nama_jalan">{{ __('Nomor Penawaran') }}</label>
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" id="simpanan_ada_ao" name="ao" data-toggle="toggle"
                                           data-on="Ada" data-off="Tidak Ada" data-onstyle="success"
                                           data-offstyle="dark"
                                         @if($enjualan->ada_penawaran ?? '' == 1) checked @endif disabled>

                                    {{--                                    <label for="simpanan_ada_ao"--}}
                                    {{--                                           id="simpanan_ada_aoLabel">Ya</label>--}}
                                </div>
                            </div>
                            <div class="form-group col-md-4" id="penawarann">
                                <div class="form-group" >
                                    <label class="form-label" for="exampleInputEmail1">No Penawaran</label>
                                    <select name="no_penawaran" id="penawaran" class="form-control" disabled>
                                        <option></option>
                                        @foreach($penjualan as $penjualans)
                                            <option value="{{$penjualans->id}}"@if($penjualans->id == $enjualan->no_penawaran ?? '') selected @endif >{{$penjualans->no_pesanan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                            </div>


                            <input type="text" id="smpn_adaAO_value" name="ada_penawaran" hidden>

{{--                            <div class="form-group col-md-2">--}}

{{--                                <div class="form-group">--}}
{{--                                    <label class=" form-label" for="nama_jalan">{{ __('Bukan Anggota') }}</label>--}}
{{--                                </div>--}}

{{--                                <div class="form-group">--}}
{{--                                    <input type="checkbox" id="onanggota" class="onanggota" name="pelanggan" data-toggle="toggle"--}}
{{--                                           data-on="Anggota" data-off="Bukan Anggota" data-onstyle="success"--}}
{{--                                           data-offstyle="dark"--}}
{{--                                           >--}}
                                    {{--                                    <label for="simpanan_ada_ao"--}}
                                    {{--                                           id="simpanan_ada_aoLabel">Ya</label>--}}
{{--                                </div>--}}
                                <input type="text" id="onanggotavalue" name="id_pelanggan" hidden>

{{--                            </div>--}}
                            <div class="form-group col-md-6" id="i">
                                <div class="form-group">
                                    <label class="form-label" for="exampleInputEmail1">Nama</label>
                                    <select id="pelanggan" name="pelanggan" class="form-control"
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
                                    <input type="text" name="id_pelanggan12" id="pelanggan1"readonly class="form-control" value="{{$enjualan->pelanggans->nama_pemohon ?? $enjualan->non_anggota }}">
                                    <input type="text" name="id_pelanggan" id="pelanggan1231" class="form-control" hidden >
                                </div>
                            </div>
                            <div class="form-group col-md-6" id="tel">
                                <div class="form-group">
                                    <label class="form-label" for="exampleInputEmail1">No Telepon</label>
                                    <input type="text" class="form-control" id="no_telp" name="no_telp"readonly value="{{$enjualan->no_telp ?? ''}}" >
                                </div>
                            </div>
                            <div class="form-group col-md-6" id="al">
                                <div class="form-group" >
                                    <label class="form-label" for="exampleInputEmail1"
                                    >Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" readonly value="{{$enjualan->alamat ?? ''}}">
                                </div>
                            </div>


                            <input type="text" hidden value="BARU" name="status">

                            <div class="form-group col-md-6">
                                <div class="form-group" >
                                    <label class="form-label" for="exampleInputEmail1">Tanggal Pemesanan</label>
                                    <input type="date" class="form-control" id="tanggal_penerimaan" name="tanggal_pemesanan"readonly value="{{$enjualan->tanggal_pemesanan ?? ''}}">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group" >
                                    <label class="form-label" for="exampleInputEmail1">No Pesanan</label>
                                    <input type="text" class="form-control" id="no_pesanan" name="no_pemesanan"
                                           value="{{$enjualan->no_pemesanan ?? ''}}" readonly>
                                </div>
                            </div>
{{--                            <div class="form-group col-md-6"id="termin2">--}}
{{--                                <div class="form-group" >--}}
{{--                                    <label class="form-label" for="exampleInputEmail1">Termin</label>--}}
{{--                                    <select id="termin" class="form-control" name="id_termin"readonly>--}}
{{--                                        <option value="">-- Pilih Termin --</option>--}}
{{--                                        @foreach ($termin as $id => $name)--}}
{{--                                            <option value="{{$id}}">{{$name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group col-md-6" id="termin3">--}}
{{--                                <div class="form-group" >--}}
{{--                                    <label class="form-label" for="exampleInputEmail1">Termin</label>--}}
{{--                                    <input type="text" id="terminn" name="termin_pemesanan"  class="form-control" readonly value="{{$enjualan->termins->nama_termin_penjualan ?? ''}}">--}}
{{--                                    <input type="text" id="terminnn" name="terminnn"  class="form-control" hidden>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="form-group col-md-6">
                                <div class="form-group" style="margin-right: 10px">
                                    <label class="form-label" for="exampleInputEmail1">Reference</label>
                                    <input type="text" class="form-control" id="reference" name="reference" value="{{$enjualan->reference}}" readonly>
                                </div>
                            </div>

                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-center text-nowrap table-primary" width="100%" id="table">
                                <thead class="bg-primary text-white">
                                <tr>
                                    <th class="text-white" width="170px">Nama Produk</th>
                                    <th class="text-white" width="110">Kode Produk</th>
                                    <th class="text-white">satuan Produk</th>
                                    <th class="text-white" width="90">qty</th>
                                    <th class="text-white">harga</th>
                                    <th class="text-white" width="90">diskon %</th>
                                    <th class="text-white">Total</th>
                                    <th class="text-white"></th>

                                </tr>
                                </thead>
                                <tbody class="addMoreProduct">
                                @php $j=0;$k=0; @endphp
                                @foreach($enjualanbody as $kode)
                                    <tr>
                                        <td>{{$kode->produks->nama_produk ?? ''}}</td>
                                        <td>{{$kode->produks->kode_produk  ?? ''}}</td>
                                        <td>{{$kode->produks->satuan->satuan_produk  ?? ''}}</td>
                                        <td>{{$kode->qty  ?? ''}}</td>
                                        <td>{{$kode->harga_produk  ?? ''}}</td>
                                        <td>{{$kode->diskon  ?? ''}} %</td>
                                        <td>{{$kode->total_amount  ?? ''}}</td>
                                    </tr>
                                    @php $j += $kode->total_ppn; $k +=$kode->total_pph@endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>

{{--                        <div class="">--}}
{{--                            <a href="#" class="btn btn-sm btn-success add_more">Tambah--}}
{{--                                Barang</a>--}}
{{--                        </div>--}}
                        <br>

                        <div class="form-horizontal " id="moreTwo">
                            <div class="form-group " id="pajak_seluruh">
                                <div class="row">
                                    <div class="col-md-9">
                                        <label style="float: right" class="form-label" id="examplenameInputname2">Sub Total</label>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-2">

                            <h5 style="font-size: 12px">Rp.{{number_format($enjualan->subtotal),2 ?? ''}}</h5>
                                </div>
                            </div>
                            </div>
                            <div class="form-group " id="pajak_seluruh">
                                <div class="row">
                                    <div class="col-md-9">
                                        <label style="float: right" class="form-label" id="examplenameInputname2">Diskon Per Produk</label>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-2">

                                        <h5 style="font-size: 12px">Rp.{{number_format($enjualan->diskon_per_item),2 ?? ''}}</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group " id="pajak_seluruh">
                                <div class="row">
                                    <div class="col-md-9">
                                        <label style="float: right" class="form-label" id="examplenameInputname2">Diskon </label>
                                    </div>
                                    <div class="col-md-1">
                                        <center> <h5 style="font-size: 12px;">{{number_format((float)$enjualan->diskontotal ?? ''),2}} %</h5></center>
                                        {{--                                        <input type="text" class="form-control pajak_seluruhs" name="pajaktotal" id="pajak_seluruhs" placeholder="Pajak" value="{{$enjualan->pajaktotal ?? ''}} %">--}}
                                    </div>
                                    <div class="col-md-2">
                                        @php $ok = $j + $k;
                                                $diskon = $ok;
                                                 @endphp
                                        {{--                                        <input type="text" class="form-control paj" name="paj" id="paj" placeholder="%" value="{{$ok}}">--}}
                                        <h5 style="font-size: 12px"> ( Rp.{{number_format((float)$diskon),2}} )</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group " id="pajak_seluruh">
                                <div class="row">
                                    <div class="col-md-9">
                                        <label style="float: right" class="form-label" id="examplenameInputname2">PPN</label>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-2">

                                        <h5 style="font-size: 12px">Rp.{{number_format($enjualan->PPN),2 ?? ''}}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group " id="pajak_seluruh">
                                <div class="row">
                                    <div class="col-md-9">
                                        <label style="float: right" class="form-label" id="examplenameInputname2">PPN</label>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-2">

                                        <h5 style="font-size: 12px">(Rp.{{number_format($enjualan->PPH),2 ?? ''}})</h5>
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
                                        <h5 style="font-size: 12px">Rp.{{$enjualan->biaya_pengiriman ?? ''}}</h5>
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
                                    <h5><b class="balance mt-5"></b></h5>
                                    <h5 style="font-size: 12px">Rp.{{number_format($enjualan->total ?? ''),2}}</h5>
                                    <input type="text"  id="total1" name="total1"  class="total1 form-control" hidden >
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0 row justify-content-end">
                            <div class=" pull-right">
                                <a href="{{ route('pemesanan_penjualan.index') }}" class="btn btn-danger">Kembali</a>
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

    <script>

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
                            $('#terminnn').empty()
                            $('#pelanggan1').empty()
                            $("tbody").children().remove()

                            $.each(res, function (i) {
                                console.log(res)
                                var name = res[i].id;
                                // var produk_id = res[i].produk_id;
                                var produk_id = res[i].produks.id;
                                var name = res[i].produks.nama_produk;
                                var kodeproduk = res[i].produks.kode_produk;
                                var harga_jual = res[i].produks.harga_jual;
                                var diskonproduk = res[i].diskonproduk;
                                var satuan = res[i].produks.satuan.satuan_produk;
                                // var te = res[i].termins.nama_termin_penjualan;
                                if(res[i].id_terminproduk != 0){
                                    var termin = res[i].termins.nama_termin_penjualan;
                                }else{
                                    var termin = 0;
                                }
                                var totalproduk = res[i].totalproduk;
                                var total = res[i].totalproduk;
                                var totall = res[i].penjualan[0].subtotal;
                                console.log(totall)
                                var alamat = res[i].penjualan[0].alamat;

                                var pel = res[i].penjualan[0].id_pelanggan;
                                if (pel != ''){
                                    var pel1 = res[i].penjualan[0].anggotas.nama_pemohon;
                                }else{
                                    var pel1 = res[i].penjualan[0].id_pelanggan;
                                }
                                var no_telepon = res[i].penjualan[0].no_telepon;
                                var anggot = res[i].penjualan[0].anggota;
                                console.log(res[i].penjualan[0].anggota)
                                if (anggot == '1'){
                                    $("#smpn_adaAO_value").val(1);
                                    $('.onanggota').prop("checked") == true
                                }else{
                                    $("#smpn_adaAO_value").val(0);
                                    $('.onanggota').prop("checked") == false
                                }
                                var termin1 = res[i].id_terminproduk;
                                var termin2= res[i].termins.nama_termin_penjualan;
                                console.log(termin2)
                                $('#totall').val(totall)
                                $('#alamat').val(alamat)
                                $('#no_telp').val(no_telepon)
                                $('#terminn').val(termin2)
                                $('#terminnn').val(termin1)
                                $('#pelanggan1').val(pel1)
                                $('#pelanggan1231').val(pel)
                                var qty = res[i].qty;
                                var produk = $('.produk_id').html();
                                {{--                                var myOptions = '<option></option> @foreach ($pro1duk as $produks)<option data-harga="{{$produks->harga_jual}}"data-produk="{{$produks->kode_produk}}"data-satuan="{{$produks->satuan->satuan_produk ?? ""}}"value="{{$produks->id}}" @if ($produks->id == produk_id)seleceted @endif>{{$produks->nama_produk}}</option>@endforeach';                                var myOptions = '<option></option> @foreach ($produk as $produks)<option data-harga="{{$produks->harga_jual}}"data-produk="{{$produks->kode_produk}}"data-satuan="{{$produks->satuan->satuan_produk ?? ''}}"value="{{$produks->id}}">{{$produks->nama_produk}}</option>@endforeach';--}}
                                var tr = $('<tr/>');

                                tr.append('<td hidden><input type="text" name="id_produk[]" id="id_produk" value='+produk_id+' class="form-control id_produk">');
                                tr.append("</td>");
                                tr.append('<td><input readonly type="text" name="name[]" id="name" value='+name+' class="form-control name">');
                                tr.append("</td>");
                                tr.append('<td><input readonly type="text" name="kode_produk[]" id="kode_produk" value='+kodeproduk+' class="form-control kode_produk">');
                                tr.append("</td>");
                                tr.append('<td><input readonly type="text" name="satuan[]" id="satuan" value='+satuan+' class="form-control satuan">');
                                tr.append("</td>");
                                tr.append('<td><input  type="text" name="qty[]" id="qty" value='+qty+' class="form-control qty">');
                                tr.append("</td>");
                                tr.append('<td><input  type="text" name="harga[]" id="harga" value='+harga_jual+' class="form-control harga">');
                                tr.append("</td>");
                                tr.append('<td><input readonly type="text" name="diskon[]" id="diskon" value='+diskonproduk+' class="form-control diskon">');
                                tr.append("</td>");
                                tr.append('<td><input readonly type="text" name="termin[]" id="termin" value='+termin+' class="form-control termin">');
                                tr.append("</td>");

                                tr.append('<td><input readonly type="text" name="total_amount[]" id="total_amount" value='+totalproduk+' class="form-control total_amount">');
                                tr.append("</td>");
                                tr.append('<td> <a href="#" class="btn btn-sm btn-danger rounded-circle delete"><i class="fa fa-trash"></i></a>');
                                tr.append("</td>");
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
        $('#onanggotavalue').val('1');

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
            var myOptions = '<option></option> @foreach ($produk as $produks)<option data-harga="{{$produks->harga_jual}}"data-produk="{{$produks->kode_produk}}"data-satuan="{{$produks->satuan->satuan_produk ?? ''}}"value="{{$produks->id}}">{{$produks->nama_produk}}</option>@endforeach';
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
        }

        function EndAmount() {
            var total = 0;
            $('.total_amount').each(function (i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            });
            $('.total').html(total);
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
            var total = $('#total1').val();
            var conver = parseFloat(total);
            var paid_amount1 = $(this).val();
            console.log(total)
            console.log(paid_amount1)
            var tot = (conver) - ((conver * paid_amount1) / 100);
            var tot2 = ((conver * paid_amount1) / 100);
            $('#balance').val(tot);
            $('#paj').val(tot2)
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
