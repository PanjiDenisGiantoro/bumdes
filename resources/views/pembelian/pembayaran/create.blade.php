@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header"> Pembelian</h3>
    <br>
{{--<br>--}}
{{--<x-breadcrumb title="{{ __('Informasi Pembayaran') }}">--}}
{{--    <li class="breadcrumb-item">--}}
{{--        <a href="{{ route('pembelian.setting') }}">{{ __('Setting') }}</a>--}}
{{--    </li>--}}
{{--    <li class="breadcrumb-item">--}}
{{--        {{ __('Buat Pembayaran') }}--}}
{{--    </li>--}}
{{--</x-breadcrumb>--}}
@endsection

@section('content')

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header justify-content-between">
                <h3 class="card-title">Buat Pembayaran</h3>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Pesanan</th>
                            <th>Tanggal Pembelian</th>
                            <th>No Inbios</th>
                            <th>Supplier</th>
                            <th>Status Penerimaan</th>
                            <th>Status Pembayaran</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $penerimaan->pesanan->no_pesanan ??  ''}}</td>
                            <td>{{ date('d-M-Y', strtotime($penerimaan->pesanan->tanggal_pesanan ?? '')) }}</td>
                            <td>{{ $penerimaan->no_invoice ?? ''}}</td>
                            <td>{{ $penerimaan->pesanan->supplier->nama ?? ''}}</td>
                            <td>{{ $penerimaan->status ?? '' }}</td>
                            <td>{{ $penerimaan->status_pembayaran ?? '' }}</td>
                            <td>Rp {{ $penerimaan->jumlah_tagihan ?? '' }}</td>
                        </tr>
                    </tbody>
                </table>
                <br>
            </div>
            <!-- table-responsive -->
        </div>
        <!-- section-wrapper -->
    </div>

</div>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header justify-content-between">
                <h3 class="card-title">Informasi Pembayaran</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('pembelian.pembayaran.store') }}">
                <input type="text" name="penerimaan_id" value="{{ $penerimaan->id }}" id="" hidden>
                <input type="text" name="supplier" value="{{ $penerimaan->supplier }}" hidden >
                <input type="text" name="termin_pembayaran" value="{{ $penerimaan->termin_pembayaran }}" hidden >
                @csrf

                    <table class="table" hidden >
                        @foreach($penerimaan_body as $body)
                            <tr>
                                <td><input type="text"name="qty[]" value="{{$body->kuantitas}}"></td>
                                <td><input type="text" name="produk[]" value="{{$body->produk_id}}"></td>
                                <td><input type="text" name="stok[]" value="{{$body->stok}}"></td>
                            </tr>
                        @endforeach
                    </table>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label">Tanggal Pembayaran</label>
                            @if(!empty($pembayaran[0]->tanggal_pembayaran))
                                <input readonly type="date" value="{{ !empty($pembayaran[0]->tanggal_pembayaran) ? $pembayaran[0]->tanggal_pembayaran : '' }}" class="form-control" name="tanggal_pembayaran" placeholder="">
                            @else
                                <input type="date" class="form-control" name="tanggal_pembayaran" placeholder="">
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
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
                            </div>
                            <div class="col-md-6">
                                <label class="form-label label_bank" for="id_bank">Bank</label>
                                <select name="id_bank" id="id_bank" class="form-control select2" >
                                    @foreach($bank as $banks)
                                        <option value="{{$banks->id}}">{{$banks->nama_bank}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Jumlah Tagihan</label>
                            <h5 style="text-align:right"><b class="totala" id="jumlah_tagihana">Rp {{ number_format($penerimaan->jumlah_tagihan) }}</b></h5>
                            <h5 style="text-align:right"><b class="total" id="jumlah_tagihan" hidden>{{ $penerimaan->jumlah_tagihan }}</b></h5>
                            <input type="text" name="jumlah_tagihan" value="{{ $penerimaan->jumlah_tagihan }}" id="" hidden>
                            {{-- <input type="text" value="{{ $penerimaan->jumlah_tagihan }}" id="jumlah_tagihan"
                                style="text-align:right;" class="form-control total" name="jumlah_tagihan" placeholder="Jumlah Tagihan"> --}}
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jumlah Bayar</label>
                            @if(!empty($pembayaran[0]->jumlah_bayar))
                                <h5 style="text-align:right"><b class="totala" id="jumlah_tagihana">Rp {{ number_format($pembayaran[0]->jumlah_bayar) }}</b></h5>
                            @else
                                <input type="number" style="text-align:right" class="form-control" name="jumlah_bayar" id="jumlah_bayar" placeholder="Jumlah Bayar" required>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">Sisa Tagihan</label>
                            @if(!empty($pembayaran[0]->sisa_tagihan))
                                <h5 style="text-align:right"><b>Rp {{ number_format($penerimaan->sisa_tagihan)  }}</b></h5>
                            @else
                                <h5 style="text-align:right"><b class="sisa">0</b></h5>
                                <input type="text" name="sisa_tagihan" id="sisa_tagihan" hidden>
                                <input type="text" name="status_pembayaran" id="status_pembayaran" hidden>
                            @endif
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label class="form-label">Sisa Tagihan</label>--}}
{{--                            @if(!empty($pembayaran[0]->sisa_tagihan))--}}
{{--                                <h5 style="text-align:right"><b>Rp {{ number_format($penerimaan->sisa_tagihan)  }}</b></h5>--}}
{{--                            @else--}}
{{--                                <h5 style="text-align:right"><b class="sisa">0</b></h5>--}}
{{--                                <input type="text" name="sisa_tagihan" id="sisa_tagihan" hidden>--}}
{{--                                <input type="text" name="status_pembayaran" id="status_pembayaran" hidden>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label class="form-label">Akun Pembayaran</label>--}}
{{--                            @if(!empty($pembayaran[0]->akun_pembayaran))--}}
{{--                                <input class="form-control" readonly value="{{ $pembayaran[0]->akun_pembayaran }}">--}}
{{--                            @else--}}
{{--                            <select name="Jenis Pembayaran" id="" class="form-control">--}}
{{--                                <option value="">-- Pilih Akun --</option>--}}
{{--                                <option value="1">Dummy 1</option>--}}
{{--                                <option value="2">Dummy 2</option>--}}
{{--                            </select>--}}
{{--                            @endif--}}
{{--                        </div>--}}


                    </div>



                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="">Catatan</label>
                            @if(!empty($pembayaran[0]->catatan))
                                <input class="form-control" readonly value={{ $pembayaran[0]->catatan }}>
                            @else
                                <textarea class="form-control" name="catatan" rows="6" placeholder="Catatan.." required></textarea>
                            @endif
                        </div>
                    </div>
                </div>


                    <input type="text" value="{{$penerimaan->no_invoice}}" name="invoice" hidden>
                <div class="form-group mb-0 row justify-content-end">
                    <div class=" pull-right">
                        <a href="{{ route('pembelian.pesanan.index') }}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
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
        $('#jumlah_bayar').on('keyup', function() {
            var tagihan = $('.total').html();
            //console.log(tagihan)
            var conver = parseFloat(tagihan);
            //console.log(conver)
            var bayar = parseFloat($('#jumlah_bayar').val());
            //console.log(bayar)
            var tot = conver - bayar;
            //console.log(tot)
            $('.sisa').html(tot);
            $('#sisa_tagihan').val(tot)

            if($('#sisa_tagihan').val() == 0){
                $('#status_pembayaran').val('lunas')
            }else{
                $('#status_pembayaran').val('sebagian')
            }
        });
    </script>
@endpush
