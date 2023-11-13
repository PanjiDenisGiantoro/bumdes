@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">Penawaran</h3>
    <br>
{{--    <br>--}}
{{--    <x-breadcrumb title="{{ __('Informasi Penawaran') }}">--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('penjualan.index') }}">{{ __('Penawaran') }}</a>--}}
{{--        </li>--}}
{{--    </x-breadcrumb>--}}
@endsection

@section('content')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="card m-b-20">
                <div class="card-header">
                    <h3 class="card-title">Tambah Penawaran Penjualan</h3>

                </div>
                <form method="post" action="{{route('penjualan.store')}}">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="row" style="margin-left: 17px;margin-top: 15px">
                                <div class="form-group">
                                    <label class=" form-label" for="nama_jalan">{{ __('Anggota') }}</label>
                                </div>
                                <div class="form-group" style="margin-left: 10px">
                                    <label class="switch">
                                        <input type="checkbox" id="simpanan_ada_ao" name="ao"
                                               checked>
                                        <span class="slider round" for="simpanan_ada_ao"
                                        ></span>
                                    </label>
                                    <label for="simpanan_ada_ao"
                                           id="simpanan_ada_aoLabel">Ya</label>
                                </div>
                            </div>
                        </div>
                        <input type="text" id="smpn_adaAO_value" name="anggota" hidden>
                        <div class="form-group col-md-6" id="i">
                            <div class="form-group" style="margin-left: 10px">
                                <label class="form-label" for="exampleInputEmail1">Pelanggan</label>
                                <select id="pelanggan" name="id_pelanggan" class="form-control">
                                    <option value="">-- Pilih Pelanggan --</option>
                                    @foreach ($anggota as $supp)
                                        <option value="{{ $supp->id }}">{{ $supp->nama_pemohon }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6" id="ii">
                            <div class="form-group" style="margin-left: 10px">
                                <label class="form-label" for="exampleInputEmail1">Pelanggan</label>
                                <input type="text" name="pelanggan1" class="form-control">
                            </div>
                        </div>


                        <div class="form-group col-md-6" id="tel">
                            <div class="form-group" style="margin-right: 10px">
                                <label class="form-label" for="exampleInputEmail1">No Telepon</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telepon" readonly>
                            </div>
                        </div>
                        <div class="form-group col-md-6" id="tel1">
                            <div class="form-group" style="margin-right: 10px">
                                <label class="form-label" for="exampleInputEmail1">No Telepon</label>
                                <input type="text" class="form-control" id="no_telp1" name="no_telepon1">
                            </div>
                        </div>


                        <div class="form-group col-md-6" id="al">
                            <div class="form-group" style="margin-left: 10px">
                                <label class="form-label" for="exampleInputEmail1">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" readonly>
                            </div>
                        </div>


                        <input type="text" hidden value="BARU" name="status">
                        <div class="form-group col-md-6" id="al1">
                            <div class="form-group" style="margin-left: 10px">
                                <label class="form-label" for="exampleInputEmail1">Alamat</label>
                                <input type="text" class="form-control" id="alamat1" name="alamat1">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div class="form-group" style="margin-right: 10px">
                                <label class="form-label" for="exampleInputEmail1">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal_penerimaan" name="tanggal">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group" style="margin-left: 10px">
                                <label class="form-label" for="exampleInputEmail1">No Pesanan</label>
                                <input type="text" class="form-control" id="no_pesanan" name="no_pesanan" value="Q-{{$max}}" readonly>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group" style="margin-right: 10px">
                                <label class="form-label" for="exampleInputEmail1">Termin</label>
                                <select id="inputState" class="form-control" name="id_termin">
                                    <option value="">-- Pilih Termin --</option>
                                    @foreach ($termin as $id => $name)
                                        <option value="{{$id}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-center text-nowrap table-primary" width="100%"id="table">
                            <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-white" width="170px">Nama Produk</th>
                                <th class="text-white">Kode Produk</th>
                                <th class="text-white">satuan Produk</th>
                                <th class="text-white">qty</th>
                                <th class="text-white">harga</th>
                                <th class="text-white">diskon %</th>
                                <th class="text-white">Pajak</th>
                                <th class="text-white">Termin</th>
                                <th class="text-white">Total</th>
                                <th class="text-white"></th>

                            </tr>
                            </thead>
                            <tbody class="addMoreProduct">
                            <tr>
                                @php $no=1;$i=0; @endphp
                                @foreach($penjualanproduk as $data)
                                <td>
                                    <select name="produk_id[{{$i}}]" id="produk_id" class="form-control produk_id">
                                        <option value="">--pilih--</option>
                                        @foreach ($produk as $produks)
                                            <option data-harga="{{$produks->harga_jual}}"
                                                    data-produk="{{$produks->kode_produk}}"
                                                    data-satuan="{{$produks->satuan->satuan_produk ?? ''}}"
                                                    value="{{$produks->id}}"@if($produks->id == $data[$i]->produk_id)selected @endif>{{$produks->nama_produk}}</option>

                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="kode_produk[]" id="kode_produk"
                                           class="form-control kode_produk">
                                </td>
                                <td>
                                    <input type="text" name="satuan[]" id="satuan" class="form-control satuan">
                                </td>
                                <td>
                                    <input type="number" name="qty[]" id="qty" class="form-control qty">
                                </td>
                                <td>
                                    <input type="number" name="harga[]" id="harga" class="form-control harga">
                                </td>
                                <td>
                                    <input type="number" name="diskon[]" id="diskon" class="form-control diskon">

                                </td>
                                <td>
                                    <select id="pajak" name="pajak[]" class="form-control pajak">
                                        <option value="0"></option>
                                        <option value="10">PPn 10%</option>
                                        <option value="15">PPn 15%</option>
                                    </select>
                                    {{--                                    <input type="number" name="pajak[]" id="pajak" class="form-control pajak">--}}

                                </td>
                                <td>
                                    <select id="termin" name="termin[]" class="form-control termin">
                                        <option></option>
                                        mn
                                        @foreach ($termin as $id => $name)
                                            <option value="{{$id}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="total_amount[]" id="total"
                                           class="form-control total_amount">
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-danger rounded-circle delete"><i
                                            class="fa fa-trash"></i></a>
                                </td>
                            </tr>

                            @endforeach
                            </tbody>

                            <tr>
                                <td><a href="#" class="btn btn-sm btn-success rounded-circle add_more"><i
                                            class="fa fa-plus"></i></a></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>subtotal</td>
                                <td><b class="total"></b></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Biaya Pengiriman</td>
                                <td><input type="number" name="biaya_pengiriman" id="paid_amount" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="form-group" style="margin-left: 10px">
                                        <label for="">Diskon</label>
                                        <label class="switch">
                                            <input type="checkbox" id="diskon2" name="diskon2"
                                                   checked>
                                            <span class="slider round" for="diskon2"
                                            ></span>
                                        </label>
                                        <label for="diskon2"
                                               id="diskon2label">&nbsp;&nbsp;%</label>
                                        <input type="text" id="diskonvalue" name="tipediskon" hidden>

                                    </div>
                                    {{--                                <input type="checkbox" id="togglepajak"  data-toggle="toggle" data-on="On" data-off="Off" data-onstyle="success" data-offstyle="dark">--}}

                                </td>
                                <td>
                                    <input type="number" name="diskontotal" id="diskontotal" class="form-control">
                                    <input type="number" name="diskontotal" id="diskontotalpersen" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total</td>
                                <td>
                                    <input type="number" name="total" id="balance" readonly class="form-control">
                                    <input type="text" class="total1" hidden></input>
                                </td>
                            </tr>

                        </table>
                    </div>
                    <div class="float-right">
                        <a href="{{route('penjualan.index')}}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>

                </form>

            </div>
        </div>
    </div>



@endsection
@push('scripts')
    <script>
        {{--$(document).ready(function() {--}}
        {{--    var subcategory_id = "{{$penjualan->id}}";--}}

        {{--    $.ajax({--}}
        {{--        type: 'GET',--}}
        {{--        url:'{{route('getdataproduk')}}',--}}
        {{--        data: { get_param: subcategory_id },--}}
        {{--        dataType: 'json',--}}
        {{--        success: function (data) {--}}
        {{--            $.each(data, function(i) {--}}
        {{--                var name = data[i].id;--}}
        {{--                console.log("name:" + name);--}}
        {{--                var tr = $('<tr/>');--}}
        {{--                tr.append("<td>" + name + "</td>");--}}
        {{--                $("#table").append(tr);--}}
        {{--            });--}}
        {{--        }--}}
        {{--    });--}}


        {{--});--}}

        $('#ii').hide();
        $('#tel1').hide();
        $('#al1').hide();
        $('#smpn_adaAO_value').val('1');
        $('#simpanan_ada_ao').on('click', function () {
            if ($(this).prop("checked") == true) {
                $('#smpn_adaAO_value').val('1');
                $('#simpanan_ada_aoLabel').html("Ya");
                $('#ii').hide();
                $('#tel').show();
                $('#al').show();

                $('#tel1').hide();
                $('#al1').hide();
                $('#i').show();
            } else if ($(this).prop("checked") == false) {
                $('#smpn_adaAO_value').val('0');
                $('#simpanan_ada_aoLabel').html("Tidak");
                $('#ii').show();
                $('#tel1').show();
                $('#tel').hide();
                $('#al1').show();
                $('#i').hide();
                $('#al').hide();
            }
        });

        $('.add_more').on('click', function () {


            var product = $('.produk_id').html();
            var termin = $('.termin').html();
            var pajak = $('.pajak').html();
            var numberofrow = ($('.addMoreProduct tr').length - 0) + 1;
            var tr = '<tr>' +
                '<td><select class="form-control produk_id" name="produk_id[]">' + product + '</select> </td>' +
                '<td><input type="text" name="kode_produk[]" class="form-control kode_produk"></td>' +
                '<td><input type="text" name="satuan[]" class="form-control satuan"></td>' +
                '<td><input type="number" name="qty[]" class="form-control qty"></td>' +
                '<td><input type="number" name="harga[]" class="form-control harga"></td>' +
                '<td><input type="number" name="diskon[]" class="form-control diskon"></td>' +
                '<td><select class="form-control pajak" name="pajak[]">' + pajak + '</select></td>' +
                // '<td><input type="number" name="pajak[]" class="form-control pajak"></td>'+
                '<td><select class="form-control termin" name="termin[]">' + termin + '</select></td>' +
                '<td><input type="number" name="total_amount[]" class="form-control total_amount"></td>' +
                '<td><a class="btn btn-danger btn-sm delete rounded-circle"><i class="fa fa-trash"></i></a></td>';
            $('.addMoreProduct').append(tr);
        });

        $('.addMoreProduct').delegate('.delete','click',function (){
            var tr = $(this).parent().parent();
            var price = tr.find('.produk_id option:selected').attr('data-harga');
            var produk = tr.find('.produk_id option:selected').attr('data-produk');
            var satuan = tr.find('.produk_id option:selected').attr('data-satuan');
            var pajak = tr.find('.pajak option:selected').val(10);
            tr.find('.harga').val(price);
            tr.find('.kode_produk').val(produk);
            tr.find('.satuan').val(satuan);
            var qty = tr.find('.qty').val() - 0;
            var disc = tr.find('.diskon').val() - 0;
            var price = tr.find('.harga').val() - 0;
            var pajak = tr.find('.pajak').val() - 0;
            var total_amount = (qty * price) - (((qty * price * disc) / 100) + ((qty * price * pajak) / 100));
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
        function EndAmount(){
            var total = 0;
            $('.total_amount').each(function (i,e){
                var amount = $(this).val() - 0;
                total += amount;
            });
            $('.total').html(total);
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

            var total_amount = (qty * price) - (((qty * price * disc) / 100) + ((qty * price * pajak) / 100));
            tr.find('.total_amount').val(total_amount);
            TotalAmount();
        });
        $('.addMoreProduct').delegate('.qty, .diskon, .pajak', 'keyup', function () {
            // var pajak = 0;
            var tr = $(this).parent().parent();
            var qty = tr.find('.qty').val() - 0;
            var disc = tr.find('.diskon').val() - 0;
            var price = tr.find('.harga').val() - 0;
            var pajak = tr.find('.pajak').val() - 0;

            var total_amount = (qty * price) - (((qty * price * disc) / 100) + ((qty * price * pajak) / 100));
            tr.find('.total_amount').val(total_amount);
            TotalAmount();
        });
        $('.addMoreProduct').delegate('.qty,.diskon, .pajak', 'change', function () {
            var tr = $(this).parent().parent();
            var qty = tr.find('.qty').val() - 0;
            var disc = tr.find('.diskon').val() - 0;
            var price = tr.find('.harga').val() - 0;
            var pajak = tr.find('.pajak').val() - 0;
            // var total_amount = (qty * price) - ((qty * price * disc) / 100) ;
            // var total_amountt = total_amount  + (( total_amount * pajak )/ 100) ;
            var total_amount = (qty * price) - ((qty * price * disc) / 100) + (pajak * ((qty * price) - ((qty * price * disc) / 100)) / 100);
            tr.find('.total_amount').val(total_amount);
            TotalAmount();
        });

        $('#paid_amount').keyup(function () {
            var total = $('.total').html();
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
            }
        });


        $('#diskontotalpersen').keyup(function () {
            var total = $('.total1').val();
            var conver = parseFloat(total);
            var paid_amount1 = $(this).val();
            console.log(total)
            console.log(paid_amount1)
            var tot = (conver) - ((conver * paid_amount1) / 100);
            $('#balance').val(tot);
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
