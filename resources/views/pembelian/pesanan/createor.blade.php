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
            <div class="card-body">

                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Tanggal Pesanan</label>
                                <input type="date" class="form-control" name="tanggal_pesanan" id="tanggal_pesanan">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">No Pesanan</label>
                                <input type="text" class="form-control fc-datepicker" id="no_pesanan" placeholder="No Pesanan">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Supplier</label>
                                <select id="supplier" class="form-control" required>
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
                                <input type="text" class="form-control" id="id_supplier" disabled>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Tanggal Penerimaan</label>
                                <input type="date" class="form-control" id="tanggal_penerimaan" name="tanggal_penerimaan">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Termin</label>
                                <select id="inputState" class="form-control" required>
                                    <option value="">-- Pilih Termin --</option>
                                    @foreach ($termin as $ter)
                                    <option value="{{ $ter->id }}">{{ $ter->kode }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Ekpedisi</label>
                                <select id="inputState" class="form-control">
                                    <option value="">-- Pilih Ekpedisi --</option>
                                    @foreach ($ekpedisi as $disi)
                                    <option value="{{ $disi->id }}">{{ $disi->kode }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


        </div>

        <div class="card m-b-20">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap table-primary">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-white">No</th>
                                <th class="text-white">Barang</th>
                                <th class="text-white">Kode Barang</th>
                                <th class="text-white">Kuantitas</th>
                                <th class="text-white">Satuan</th>
                                <th class="text-white">Harga</th>
                                <th class="text-white">Diskon</th>
                                <th class="text-white">Pajak</th>
                                <th class="text-white">Total Harga</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="addMoreProduct">
                            <tr>
                                <td>1</td>
                                <td>
                                    <select id="produks" class="form-control produk_id" name="produk_id" required width="70px;">
                                        <option value="">-- Produks --</option>
                                        @foreach ($produk as $data)
                                        <option value="{{ $data->id }}" data-harga="{{$data->harga_jual}}" data-kode-produk="{{ $data->kode_produk }}" data-satuan="{{ $data->satuan->satuan_produk ?? '' }}">{{ $data->nama_produk }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" class="form-control kodes_produks" style="width:80px" id="kode_produks" disabled></td>
                                <td><input type="number" style="width:80px;" name="qty[]" class="form-control qty"></td>
                                {{-- <td><input class="form-control qty" style="width:80px" id="qty" type="text"></td> --}}
                                <td><input class="form-control satuansa" style="width:80px" type="text" name="" id="satuans"></td>
                                <td><input class="form-control harga" type="number" style="width:140px" class="" name="" id="harga_juals"></td>
                                <td><input class="form-control" type="number" style="width:80px" class="" name=""></td>
                                <td><input class="form-control" type="number" style="width:100px" class="" name=""></td>
                                <td><input type="number" name="total_amount[]" id="total" class="form-control total_amount"></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div> <br>

                <button class="btn btn-primary" id="add_btn">Tambah Baris</button>


                <form class="form-horizontal mt-5">
                    <div class="form-group ">
                        <div class="row">
                            <div class="col-md-8">
                                <label style="padding-left:800px; padding-top:5px;" class="form-label subtotal" id="examplenameInputname2">Subtotal</label>
                            </div>
                            <div class="col-md-4">
                                <h5><b class="total"></b></h5>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row">
                            <div class="col-md-8">
                                <label style="padding-left:800px; padding-top:5px;" class="form-label" id="examplenameInputname2">Pajak</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="examplenameInputname3" placeholder="Pajak">
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row">
                            <div class="col-md-8">
                                <label style="padding-left:800px; padding-top:5px;" class="form-label" id="examplenameInputname2">Diskon</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="examplenameInputname3" placeholder="Diskon">
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row">
                            <div class="col-md-8">
                                <label style="padding-left:800px; padding-top:5px;" class="form-label" id="examplenameInputname2">Total</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="examplenameInputname3" placeholder="Total">
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row">
                            <div class="col-md-8">
                                <label style="padding-left:800px; padding-top:5px;" class="form-label" id="examplenameInputname2">Termasuk Pajak</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="examplenameInputname3" placeholder="Termasuk Pajak">
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row">
                            <div class="col-md-8">
                                <label style="padding-left:800px; padding-top:5px;" class="form-label" id="examplenameInputname2">Jumlah Tagihan</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="examplenameInputname3" placeholder="Jumlah Tagihan">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-0 row justify-content-end">
                        <div class=" pull-right">
                            <button type="submit" class="btn btn-danger">Batal</button>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- <div class="card-body">

            </div> --}}

        </div>

    </div>
</div>

@endsection
@push('scripts')
<script>
    $(document).ready(function() {

        $('#supplier').select2({
            minimumInputLength: 3
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


        $('#add_btn').on('click', function() {
            var product = $('.produk_id').html();
            var numberofrow = ($('.addMoreProduct tr').length - 0) + 1;
            var tr = '<tr><td class"no"">' + numberofrow + '</td>' +
                '<td><select style="width:220px;" class="form-control produk_id" name="produk_id[]">' + product + '</select> </td>' +
                '<td><input class="form-control kodes_produks" style="width:80px" type="text" id="kode_producks" disabled></td>' +
                '<td><input type="number" style="width:80px;" name="qty[]" class="form-control qty"></td>' +
                '<td><input class="form-control satuansa" style="width:80px" type="text" id="satuans"></td>' +
                '<td><input type="number" style="width:140px;" name="harga[]" class="form-control harga"></td>' +
                '<td><input type="number" style="width:80px;" name="diskon[]" class="form-control diskon"></td>' +
                '<td><input class="form-control" type="number" style="width:100px" class="" name=""></td>' +
                '<td><input type="number" name="total_amount[]" class="form-control total_amount"></td>' +
                '<td><a class="btn delete rounded-circle"><i class="fa fa-trash"></i></a></td>';
            $('.addMoreProduct').append(tr);
        });
        $('.addMoreProduct').delegate('.delete', 'click', function() {
            $(this).parent().parent().remove();
        });

        function TotalAmount() {
            var total = 0;
            $('.total_amount').each(function(i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            });
            $('.total').html(total);
            var formatermoney = total.toLocaleString('us', {
                minimumFractionDigits: 0
                , maximumFractionDigits: 2
            })
            $('.total').html(formatermoney);
        }
        $('.addMoreProduct').delegate('.produk_id', 'change', function() {
            var tr = $(this).parent().parent();
            var price = tr.find('.produk_id option:selected').attr('data-harga');
            var kodeProduk = tr.find('.produk_id option:selected').attr('data-kode-produk');
            var satuanProduk = tr.find('.produk_id option:selected').attr('data-satuan');

            tr.find('.kodes_produks').val(kodeProduk);
            tr.find('.satuansa').val(satuanProduk);
            tr.find('.harga').val(price);

            var quan = tr.find('.qty').val() - 0;
            var disc = tr.find('.diskon').val() - 0;
            var price = tr.find('.harga').val() - 0;
            var total_amount = (quan * price) - ((quan * price * disc) / 100);
            tr.find('.total_amount').val(total_amount);
            TotalAmount();
        });
        $('.addMoreProduct').delegate('.qty, .diskon', 'keyup', function() {
            var tr = $(this).parent().parent();
            var qty = tr.find('.qty').val() - 0;
            var disc = tr.find('.diskon').val() - 0;
            var price = tr.find('.harga').val() - 0;
            var total_amount = (qty * price) - ((qty * price * disc) / 100);
            tr.find('.total_amount').val(total_amount);
            TotalAmount();
        });
        $('#paid_amount').keyup(function() {
            var total = $('.total').html();
            var paid_amount = $(this).val();
            var tot = total - paid_amount;
            $('#balance').val(tot);
        })

        {
            {
                --$('#produks').select2({
                    minimumInputLength: 1
                }).change(function() {

                    $('#nama_produks').val('').change();
                    $('#kode_produks').val('').change();
                    $('#harga_juals').val('').change();
                    $('#satuans').val('').change();

                    var countryID = $(this).val();
                    var idas = 1;
                    if (countryID) {
                        $.ajax({
                            type: "GET"
                            , url: "{{ route('pembelian.pesanan.getdataproduk')  }}?country_id=" + countryID
                            , success: function(res) {
                                if (res) {
                                    console.log(res)
                                    let noNamaProduk = res.nama_produk;
                                    let KodeProduk = res.kode_produk;
                                    let HargaJual = res.harga_jual
                                    let Satuans = res.satuan.satuan_produk

                                    $('#nama_produks').val(noNamaProduk);
                                    $('#kode_produks').val(KodeProduk);
                                    $('#harga_juals').val(HargaJual);
                                    $('#satuans').val(Satuans);
                                }
                            }
                        });
                    }
                });
                --
            }
        }

    });

</script>
@endpush
