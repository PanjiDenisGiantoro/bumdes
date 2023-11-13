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



    {{-- <form action="{{route('order.store')}}" method="post" > --}}
        @csrf
    <div class="row">

            <div class="col-md-9">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left">Orders</h4>

                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-left" width="100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th width="170px">Nama Produk</th>
                                <th>qty</th>
                                <th>harga</th>
                                <th>diskon %</th>
                                <th>Total</th>
                                <th><a href="#" class="btn btn-sm btn-success rounded-circle add_more"><i class="fa fa-plus"></i></a></th>

                            </tr>
                            </thead>
                            <tbody class="addMoreProduct">
                            <tr>
                                <td>1</td>
                                <td>
                                    <select name="produk_id[]" id="produk_id" class="form-control produk_id">
                                        <option value="">--pilih--</option>
                                           @foreach ($produk as $data)
                                    <option value="{{ $data->id }}" data-harga="{{$data->harga_jual}}">{{ $data->nama_produk }}</option>
                                    @endforeach
                                    </select>
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
                                    <input type="number" name="total_amount[]" id="total" class="form-control total_amount">
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-danger rounded-circle delete"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            </tbody>
                            <tr>
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
                                <td>payment</td>
                                <td><input type="number" name="paid_amount" id="paid_amount" class="form-control"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>return change</td>
                                <td><input type="number" name="balance" id="balance" readonly class="form-control"></td>
                            </tr>

                        </table>

                    </div>
                </div>
                </div>
            </div>
    </div>
        </div>
        <div class="col-md-3">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5><b class="total">0.00</b></h5>
                </div>
                <div class="card-body">
                        <div class="form-group">
                            <label for="">nama customer</label>
                                <select name="customer" id="customer" class="form-control">
                                    <option value="">--pilih--</option>
                                    {{-- @foreach($customer as $cus)
                                        <option value="{{$cus->id}}">{{$cus->namaCustomer}}</option>
                                    @endforeach --}}
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="notelp">no telp</label>
                            <select name="notelp" id="notelp" class="form-control notelp"></select>
                        </div>
                    <div class="form-group">
                        <label for="alamat">alamat</label>
                        <select name="alamat" id="alamat" class="form-control alamat"></select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-primary" type="submit">save</button>

                    </div>
                    </div>
            </div>
            </div>
            </div>
            </div>
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
    $('.add_more').on('click',function (){
        var product = $('.produk_id').html();
        var numberofrow = ($('.addMoreProduct tr').length - 0) + 1;
        var tr = '<tr><td class"no"">' + numberofrow + '</td>' +
            '<td><select class="form-control produk_id" name="produk_id[]">'+ product + '</select> </td>'+
            '<td><input type="number" name="qty[]" class="form-control qty"></td>'+
            '<td><input type="number" name="harga[]" class="form-control harga"></td>'+
            '<td><input type="number" name="diskon[]" class="form-control diskon"></td>'+
            '<td><input type="number" name="total_amount[]" class="form-control total_amount"></td>'+
            '<td><a class="btn btn-danger btn-sm delete rounded-circle"><i class="fa fa-times-circle"></i></a></td>';
        $('.addMoreProduct').append(tr);
    });
    $('.addMoreProduct').delegate('.delete','click',function (){
        $(this).parent().parent().remove();
    });
    function TotalAmount(){
        var total = 0;
        $('.total_amount').each(function (i,e){
            var amount = $(this).val() - 0;
            total += amount;
        });
        $('.total').html(total);
    }
    $('.addMoreProduct').delegate('.produk_id','change',function (){
        var tr = $(this).parent().parent();
        var price = tr.find('.produk_id option:selected').attr('data-harga');
        tr.find('.harga').val(price);
        var quan = tr.find('.qty').val() - 0;
        var disc = tr.find('.diskon').val() - 0;
        var price = tr.find('.harga').val() - 0;
        var total_amount = (quan * price) - ((quan * price * disc) / 100);
        tr.find('.total_amount').val(total_amount);
        TotalAmount();
    });
    $('.addMoreProduct').delegate('.qty, .diskon','keyup',function (){
        var tr = $(this).parent().parent();
        var qty = tr.find('.qty').val() - 0;
        var disc = tr.find('.diskon').val() - 0;
        var price = tr.find('.harga').val() - 0;
        var total_amount = (qty * price) - ((qty * price * disc) / 100);
        tr.find('.total_amount').val(total_amount);
        TotalAmount();
    });
    $('#paid_amount').keyup(function (){
        var total = $('.total').html();
        var paid_amount = $(this).val();
        var tot = total- paid_amount;
        $('#balance').val(tot);
    })
    {{-- $('#customer').change(function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:"GET",
                url:"{{url('getService')}}?country_id="+countryID,
                success:function(res){
                    if(res){
                        $("#notelp").empty();
                        $("#alamat").empty();
                        $.each(res,function(key,value){
                            $("#notelp").append('<option value="'+value.notelp+'">'+value.notelp+'</option>');
                            $("#alamat").append('<option value="'+value.alamat+'">'+value.alamat+'</option>');
                        });
                    }else{
                        $("#notelp").empty();
                        $("#alamat").empty();
                    }
                }
            });
        }else{
            $("#nama").empty();
            $("#harga").empty();
        }
    }); --}}
</script>
@endpush
