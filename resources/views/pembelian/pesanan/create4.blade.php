@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header"> Pembelian</h3>
    <br>
{{--<br>--}}
{{--<x-breadcrumb title="{{ __('Informasi Pesanan') }}">--}}
{{--    <li class="breadcrumb-item">--}}
{{--        <a href="{{ route('pembelian.setting') }}">{{ __('Setting') }}</a>--}}
{{--    </li>--}}
{{--    <li class="breadcrumb-item">--}}
{{--        {{ __('Index Pesanan') }}--}}
{{--    </li>--}}
{{--</x-breadcrumb>--}}
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card m-b-20">

            <div class="card-header">
                <h3 class="card-title">Tambah Pesanan Pembelian</h3>

            </div>
            <form action="{{ route('pembelian.pesanan.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Tanggal Pesanan</label>
                                <input type="date" class="form-control" name="tanggal_pesanan" id="tanggal_pesanan" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">No Pesanan</label>
                                <input value="PO1{{ $code }}" type="text" name="no_pesanan" class="form-control fc-datepicker" id="no_pesanan" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Supplier</label>
                                <select id="supplier" name="supplier_id" class="form-control" required>
                                    <option value="">-- Pilih Supllier --</option>
                                    @foreach ($supplier as $supp)
                                    <option value="{{ $supp->id }}">{{ $supp->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Id Supplier</label>
                                <input type="text" name="id_supplier" class="form-control" id="id_supplier" readonly>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Tanggal Penerimaan</label>
                                <input type="date" class="form-control" id="tanggal_penerimaan" name="tanggal_penerimaan" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Termin</label>
                                <select id="inputState" name="termin_id" class="form-control" required>
                                    <option value="">-- Pilih Termin --</option>
                                    @foreach ($termin as $ter)
                                    <option value="{{ $ter->id }}">{{ $ter->nama_termin_penjualan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Ekpedisi</label>
                                <select id="inputState" name="ekpedisi_id" class="form-control" required>
                                    <option value="">-- Pilih Ekpedisi --</option>
                                    @foreach ($ekpedisi as $disi)
                                    <option value="{{ $disi->id }}">{{ $disi->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Termasuk Pajak</label>
                                <input type="checkbox" checked id="togglepajak" data-toggle="toggle" data-on="Ya" data-off="Tidak" data-onstyle="success" data-offstyle="dark">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card m-b-20">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table card-table table-center text-nowrap table-primary" width="100%">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="text-white" width="200">Nama Produk</th>
                                        <th class="text-white" width="140">Kode</th>
                                        <th class="text-white" width="100">satuan</th>
                                        <th class="text-white" width="90">qty</th>
                                        <th class="text-white" width="120">harga</th>
                                        <th class="text-white" width="90">diskon %</th>
                                        <th class="text-white" width="110">Pajak</th>
                                        {{-- <th class="text-white" width="110">Pajak type</th>--}}
                                        <th class="text-white" width="200">Total</th>
                                        {{-- <th class="text-white" width="200">Total pajak</th>--}}
                                        <th class="text-white"></th>


                                    </tr>
                                </thead>
                                <tbody class="addMoreProduct">
                                    <tr>
                                        <td>
                                            <select name="produk_id[]" id="produk_id" class="form-control produk_id">
                                                <option value="">--pilih--</option>
                                                @foreach ($produk as $produks)
                                                <option data-harga="{{$produks->harga_beli}}" data-produk="{{$produks->kode_produk}}" data-satuan="{{$produks->satuan->satuan_produk ?? ''}}" value="{{$produks->id}}">{{$produks->nama_produk}}</option>

                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="kode_produk[]" id="kode_produk" readonly class="form-control kode_produk" style="font-size: 12px">
                                        </td>
                                        <td>
                                            <input type="text" name="satuan[]" readonly id="satuan" class="form-control satuan" style="font-size: 12px">
                                        </td>
                                        <td>
                                            <input type="text" name="qty[]" id="qty" class="form-control qty" style="font-size: 12px">
                                        </td>
                                        <td>
                                            <input type="text" name="harga[]" id="harga" class="form-control harga" style="font-size: 12px">
                                        </td>
                                        <td>
                                            <input type="text" name="diskon[]" id="diskon" class="form-control diskon" style="font-size: 12px">

                                        </td>
                                        <td>
                                            <select id="pajak" name="pajak[]" class="form-control pajak" style="font-size: 12px">
                                                <option value="0">0</option>
                                                @foreach($pajak as $p)
                                                <option value="{{$p->tarif_persentase}}" data-pajak="{{$p->pemotongan}}">{{$p->nama_pajak}}</option>
                                                @endforeach
                                            </select>
                                            {{-- <input type="number" name="pajak[]" id="pajak" class="form-control pajak">--}}

                                        </td>
                                        <td hidden>
                                            <input type="number" name="total_pajak[]" id="total_pajak" readonly hidden class="form-control total_pajak" style="font-size: 12px">
                                        </td>
                                        <td hidden>
                                            <input type="number" name="total_pajak_pph[]" id="total_pajak_pph" readonly hidden class="form-control total_pajak_pph" style="font-size: 12px">
                                        </td>
                                        <td hidden>
                                            <input type="text" name="pajaktype[]" id="pajaktype" class="form-control pajaktype" style="font-size: 12px" hidden>
                                        </td>

                                        <td>
                                            <input type="number" name="total_amount[]" id="total" readonly class="form-control total_amount" style="font-size: 12px">
                                        </td>
                                        <td hidden>
                                            <input type="number" name="total_amount_all[]" id="total_amount_all" readonly class="form-control total_amount_all" style="font-size: 12px" hidden>
                                        </td>

                                        <td hidden>
                                            <input type="number" name="total_sub[]" id="total_sub" hidden readonly class="form-control total_sub" style="font-size: 12px">
                                        </td>
                                        <td hidden>
                                            <input type="number" name="total_disk[]" id="total_disk" readonly class="form-control total_disk" style="font-size: 12px" hidden>
                                        </td>

                                        <td>
                                            <a href="#" class="btn btn-sm btn-danger rounded-circle delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                </tbody>


                                <td class="bg-white"><a href="#" class="btn btn-sm btn-success add_more">Tambah
                                        Barang</a></td>
                                <td class="bg-white"></td>
                                <td class="bg-white"></td>
                                <td class="bg-white"></td>
                                <td class="bg-white"></td>
                                <td class="bg-white" style="text-align:right;">subtotal</td>
                                <td class="bg-white"></td>

                                <td class="bg-white"><input type="number" name="subtotal_produk" class="form-control total_subtotal_text" style="border: 0;font-size: 14px;font-weight: bold;text-align: right;">

                                <td class="bg-white"></td>
                                <td class="bg-white"></td>

                                </tr>

                                <tr>
                                    <td colspan="5" class="bg-white"></td>

                                    <td class="bg-white">Biaya Pengiriman</td>
                                    <td class="bg-white"></td>

                                    <td class="bg-white"><input type="number" name="biaya_pengiriman" id="paid_amount" class="form-control" style="border: 0;font-size: 14px;font-weight: bold;text-align: right;">
                                    </td>
                                    <td class="bg-white"></td>
                                    <td class="bg-white"></td>

                                </tr>

                                <input type="text" id="subtotal" name="subtotal" hidden>
                                <tr>
                                    <td colspan="5" class="bg-white"></td>

                                    <td class="bg-white">Diskon Per Item</td>
                                    <td class="bg-white"></td>

                                    <td class="bg-white"><input type="number" name="diskon_per_item" id="diskon_per_item" class="form-control" style="border: 0;font-size: 14px;font-weight: bold;text-align: right;">
                                    </td>
                                    <td class="bg-white"></td>
                                    <td class="bg-white"></td>

                                </tr>


                                <tr>
                                    <td colspan="5" class="bg-white"></td>

                                    <td class="bg-white" style="text-align:right;">PPN</td>
                                    <td class="bg-white"></td>

                                    <td class="bg-white"><input type="number" name="ppn" id="ppn" class="form-control" style="border: 0;font-size: 14px;font-weight: bold;text-align: right;">
                                    </td>
                                    <td class="bg-white"></td>
                                    <td class="bg-white"></td>

                                </tr>

                                <tr>
                                    <td colspan="5" class="bg-white"></td>

                                    <td class="bg-white" style="text-align:right;">PPH</td>
                                    <td class="bg-white"></td>

                                    <td class="bg-white" style="text-align: right; padding-right:35px;"><input type="number" name="PPH" id="pph"hidden
                                                                readonly  class="form-control" style="border: 0;font-size: 14px;font-weight: bold;text-align: right">
                                        (<span class="pph_value bg-white"  style="font-size: 14px;font-weight: bold;text-align: right;">0</span>)
                                    </td>
                                    <td class="bg-white"></td>
                                    <td class="bg-white"></td>
                                </tr>


                                <tr>
                                    <td colspan="5" class="bg-white"></td>

                                    <td class="bg-white">
                                        <div class="form-group" style="margin-left: 10px">
                                            <label for="">Diskon</label>
                                            <label class="switch">
                                                <input type="checkbox" data-size="sm" id="diskon2" name="diskon2" data-toggle="toggle" data-on="%" data-off="RP" data-onstyle="success" data-offstyle="dark" checked>
                                                {{-- <span class="slider round" for="diskon2"--}}
                                                {{-- ></span>--}}
                                            </label>
                                            <input type="text" id="diskonvalue" name="type_diskon" hidden>
                                        </div>

                                        {{-- <input type="checkbox" id="togglepajak"  data-toggle="toggle" data-on="On" data-off="Off" data-onstyle="success" data-offstyle="dark">--}}
                                    </td>
                                    <td class="bg-white">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <input type="text" name="diskontotalrupiah" id="diskontotal" class="form-control">
                                                <input type="text" name="diskontotal" id="diskontotalpersen" class="form-control diskontotalpersen">
                                            </div>
                                            <div class="col-md-3"><span for="diskon2" id="diskon2label">&nbsp;&nbsp;%</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="bg-white">
                                        <input type="number" readonly id="diskontotalpersen1" class="form-control">
                                        <input type="number" readonly id="diskontotal1" class="form-control">

                                    </td>
                                    <td class="bg-white"></td>
                                    <td class="bg-white"></td>

                                </tr>
                                <tr>
                                    <td colspan="5" class="bg-white"></td>
                                    <td class="bg-white" style="text-align:right;">Total</td>
                                    <td class="bg-white"></td>

                                    <td class="bg-white">

                                        <b hidden class="total"></b>
                                        <input hidden type="number" name="total_balance" id="balance" readonly class="form-control">
                                        <input hidden type="number" name="total" id="totalgrand" readonly class="form-control">
                                        <input type="text" class="total1 form-control" style="border: 0;font-size: 14px;font-weight: bold;text-align: right;">
                                        <input type="text" class="total1_back" hidden>
                                    </td>
                                    <td class="bg-white"></td>
                                    <td class="bg-white"></td>
                                </tr>

                            </table>
                        </div>

                        <div class="float-right">
                            <a href="{{route('penjualan.index')}}" class="btn btn-danger">Batal</a>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

    @endsection
    @push('css')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    @endpush
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script>
        $('.add_more').on('click', function () {

            var product = $('.produk_id').html();
            var termin = $('.termin').html();
            var pajak = $('.pajak').html();
            var numberofrow = ($('.addMoreProduct tr').length - 0) + 1;
            var tr = '<tr><td><select class="form-control produk_id" name="produk_id[]"style="font-size: 12px">' + product + '</select> </td>' +
                '<td><input type="text" name="kode_produk[]"readonly class="form-control kode_produk"style="font-size: 12px"></td>' +
                '<td><input type="text" name="satuan[]"readonly class="form-control satuan"style="font-size: 12px"></td>' +
                '<td><input type="text" name="qty[]" class="form-control qty"style="font-size: 12px"></td>' +
                '<td><input type="text" name="harga[]" class="form-control harga"style="font-size: 12px"></td>' +
                '<td><input type="text" name="diskon[]" class="form-control diskon"style="font-size: 12px"></td>' +
                '<td><select class="form-control pajak" name="pajak[]"style="font-size: 12px">' + pajak + '</select></td>' +
                // '<td><input type="number" name="pajak[]" class="form-control pajak"></td>'+
                '<td hidden><input type="number"  readonly name="total_pajak[]" class="form-control total_pajak"style="font-size: 12px"></td>' +
                '<td hidden><input type="number"  readonly name="total_pajak_pph[]" class="form-control total_pajak_pph"style="font-size: 12px"></td>' +
                '<td hidden><input type="number" hidden readonly name="pajaktype[]" class="form-control pajaktype"style="font-size: 12px"></td>' +
                '<td hidden><input type="number"  readonly name="total_amount_all[]" class="form-control total_amount_all"style="font-size: 12px"></td>' +
                '<td hidden><input type="number" hidden readonly name="total_sub[]" class="form-control total_sub"style="font-size: 12px"></td>' +
                '<td hidden><input type="number" hidden readonly name="total_disk[]" class="form-control total_disk"style="font-size: 12px"></td>' +
                '<td ><input type="number" readonly name="total_amount[]" class="form-control total_amount"style="font-size: 12px"></td>' +
                '<td hidden><input type="number" readonly name="diskongrand[]" class="form-control diskongrand"style="font-size: 12px"></td>' +

                '<td><a class="btn btn-danger btn-sm delete rounded-circle"><i class="fa fa-trash"></i></a></td>';
            $('.addMoreProduct').append(tr);
        });

        $('.addMoreProduct').delegate('.delete', 'click', function () {
            var tr = $(this).parent().parent();
            var price = tr.find('.produk_id option:selected').attr('data-harga');
            var produk = tr.find('.produk_id option:selected').attr('data-produk');
            var satuan = tr.find('.produk_id option:selected').attr('data-satuan');
            var pajak = tr.find('.pajak option:selected').val();
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

            $('.total_amount').each(function (i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            });

            var totaldiskon = $('#diskontotalpersen').val();
            var diskon = parseFloat(totaldiskon);
            var totalreal = parseFloat(total);

            var totalall = totalreal / diskon ;
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
                $('.pph_value').html(tot);
            }else{
                var totaldiskon = $('#diskontotalpersen').val();
                var totaldiskonvalue = $('#diskontotalpersen1').val();
                var diskon = parseFloat(totaldiskon);
                var value = parseFloat(totaldiskonvalue);
                var totalreal = parseFloat(total);

                var grand = totalreal - ((totalreal * diskon )/100);
                $('#pph').val(grand);
                var tot1 = new Intl.NumberFormat().format(grand);
                // if (isNaN(tot1)){
                //
                // }
                $('.pph_value').html(tot1);

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

                var grand = totalreal - ((totalreal * diskon )/100);
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
        }


        $('.addMoreProduct').delegate('.produk_id', 'change', function () {

            var tr = $(this).parent().parent();
            var price = tr.find('.produk_id option:selected').attr('data-harga');
            var produk = tr.find('.produk_id option:selected').attr('data-produk');
            var satuan = tr.find('.produk_id option:selected').attr('data-satuan');
            // var pajak = tr.find('.pajak option:selected').val(10);
            // tr.find('.pajak').val(pajak);
            tr.find('.harga').val(price);
            tr.find('.kode_produk').val(produk);
            tr.find('.satuan').val(satuan);

            var quan = tr.find('.qty').val() - 0;
            var disc = tr.find('.diskon').val() - 0;
            var price = tr.find('.harga').val() - 0;

            var pajak = tr.find('.pajak').val() - 0;
            var biaya = $('#paid_amount').val() - 0;

            // var total_amount =biaya + ((qty * price) - (((qty * price * disc) / 100) + ((qty * price * pajak) / 100)));
            var total_amount = biaya + ((quan * price) - (((quan * price * disc) / 100)));
            tr.find('.total_amount').val(total_amount);
            TotalAmount();
        });
        $('.addMoreProduct').delegate('.qty, .diskon,.diskongrand, .pajak ,.harga,#paid_amount', 'keyup', function () {
            // var pajak = 0;
            $('#diskontotalpersen').val('') ;
            $('#diskontotalpersen1').val('') ;
            $('#diskontotal1').val('') ;
            $('#diskontotal').val('') ;

            var tr = $(this).parent().parent();
            var pajaktype = tr.find('.pajak option:selected').attr('data-pajak');
            var qty = tr.find('.qty').val() - 0;
            var disc = tr.find('.diskon').val() - 0;
            var price = tr.find('.harga').val() - 0;
            var pajak = tr.find('.pajak').val() - 0;
            var diskongrand = $('#diskontotalpersen').val() - 0;
            var biaya = $('#paid_amount').val() - 0;

            console.log(diskongrand)
            // var total_amount =biaya +  ((qty * price) - (((qty * price * disc) / 100) + ((qty * price * pajak) / 100)));
            // var total_amount_all =biaya +  ((qty * price) - ((qty * price * disc) / 100) + (pajak * ((qty * price) - ((qty * price * pajak) / 100)) / 100));
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
            TotalSub();
            TotalAmount();
            TotalDiskon();
            TotalPajak();
            totalpajakpphandppn();
        });
        $('.addMoreProduct').delegate('.qty,.diskon,.diskongrand,.pajak,.harga', 'change', function () {
            $('#diskontotalpersen').val('') ;
            $('#diskontotalpersen1').val('') ;
            $('#diskontotal1').val('') ;
            $('#diskontotal').val('') ;


            var tr = $(this).parent().parent();
            var pajaktype = tr.find('.pajak option:selected').attr('data-pajak');
            var qty = tr.find('.qty').val() - 0;
            var disc = tr.find('.diskon').val() - 0;
            var price = tr.find('.harga').val() - 0;
            var pajak = tr.find('.pajak').val() - 0;


            var totalamount = tr.find('.total_amount').val() - 0;
            var diskontotalpersen = $('#diskontotalpersen').val() - 0;
            var biaya = $('#paid_amount').val() - 0;
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
        $('#diskontotalpersen1').val(0)

        $('#paid_amount').keyup(function () {


            if ($(this).val() == ''){
                $(this).val(0);
            }

            // $('#diskontotalpersen').val('0') ;
            // $('#diskontotalpersen1').val('0') ;
            // $('#diskontotal1').val('0') ;
            // $('#diskontotal').val('0') ;

            var total = $('.total').val();
            var conver = parseFloat(total);
            var paid_amount = parseFloat($(this).val())
            var tot = conver + paid_amount;
            // $('#balance').val(tot);
            $('.total1').val(tot);
            var tot1 = new Intl.NumberFormat().format(tot);
            $('.total1_value').html(tot1);
            $('.total1_back').val(tot);


        })
        $('#diskontotal1').hide();
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
                $('#diskontotalpersen1').hide();
                $('#diskontotalpersen1_value').hide();

            }
        });

        // $('#diskontotalpersen').on('keyup',function(){
        //     test_value = $(this).val();
        //     $('.diskongrand').val(test_value)
        // })
        $('#diskontotalpersen').keyup(function () {

            var total = $('.total1_back').val();
            var conver = parseFloat(total);
            var paid_amount = $('#paid_amount').val();
            var conver1 = parseFloat(paid_amount);

            var paid_amount1 = $(this).val();
            var tot = conver  - ((conver * paid_amount1) / 100);
            var dis = ((conver * paid_amount1) / 100);
            // $('#balance').val(tot);
            $('.total1').val(tot);
            var tot1 = new Intl.NumberFormat().format(tot);
            $('.total1_value').html(tot1);

            // $('#diskontotalpersen1').val(dis);
            totalpajakpphandppn();
            TotalPajak();
            TotalPajakpph();

        })
        $('#diskontotal').keyup(function () {
            var total = $('.total1_back').val();

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

        $('#supplier').select2({
                    //minimumInputLength: 3
                }).change(function() {

                    $('#id_supplier').val('').change();

                    var countryID = $(this).val();
                    var idas = 1;
                    if (countryID) {
                        $.ajax({
                            type: "GET"
                            , url: "{{ route('pembelian.pesanan.getdata') }}?country_id=" + countryID
                            , success: function(res) {
                                if (res) {
                                    console.log(res)
                                    let noNama = res.nama;
                                    let noIdSupplier = res.id_supplier;

                                    $('#id_supplier').val(noIdSupplier);
                                }
                            }
                        });
                    }
                });

    </script>
    @endpush
