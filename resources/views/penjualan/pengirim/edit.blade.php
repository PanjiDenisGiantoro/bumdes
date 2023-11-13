@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">Pembayaran</h3>
    <br>
{{--<br>--}}
{{--<x-breadcrumb title="{{ __('Informasi Pembayaran') }}">--}}
{{--    <li class="breadcrumb-item">--}}
{{--        <a href="{{ route('pengiriman.index') }}">{{ __('Pengiriman') }}</a>--}}
{{--    </li>--}}
{{--    <li class="breadcrumb-item">--}}
{{--        {{ __('Pembayaran ') }}--}}
{{--    </li>--}}
{{--</x-breadcrumb>--}}
@endsection

@section('content')

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header justify-content-between">
                <h3 class="card-title"> Pembayaran</h3>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Pesanan Penjualan</th>
                            <th>Tanggal Penjualan</th>
{{--                            <th>No Invoice</th>--}}
                            <th>Nama</th>
{{--                            <th>Status Penjualan</th>--}}
                            <th>Status Pembayaran</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $pemesanan->no_pengiriman ??  ''}}</td>
                            <td>{{ date('d/m/Y', strtotime($pemesanan->created_at ?? '')) }}</td>
                            <td>{{ $pemesanan->non_anggota ?? ''}}</td>
                            <td>{{ $pemesanan->status_pembayaran_penjualan ?? '' }}</td>
                            <td>Rp {{ $pemesanan->total ?? '' }}</td>
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
                <form method="POST" action="{{ route('pengiriman.update',$pemesanan->id ) }}">
                <input type="text" name="id_bayar" value="{{ $pemesanan->id }}" hidden>
{{--                <input type="text" name="supplier" value="{{ $penerimaan->supplier }}" hidden >--}}
                    @method('PUT')

                    @csrf

                    <table class="table" hidden >
{{--                        @foreach($penerimaan_body as $body)--}}
{{--                            <tr>--}}
{{--                                <td><input type="text"name="qty[]" value="{{$body->kuantitas}}"></td>--}}
{{--                                <td><input type="text" name="produk[]" value="{{$body->produk_id}}"></td>--}}
{{--                                <td><input type="text" name="stok[]" value="{{$body->stok}}"></td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
                    </table>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label">Tanggal Pembayaran</label>
                            <h5 style="text-align:right"><b class="totala" id="jumlah_tagihana">{{ date('d/m/Y', strtotime($pemesanan->created_at ?? '')) }}</b></h5>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jumlah Tagihan</label>
                            <h5 style="text-align:right"><b class="totala" id="jumlah_tagihana">Rp {{ number_format($pemesanan->total) }}</b></h5>
                            <h5 style="text-align:right"><b class="total" id="jumlah_tagihan" hidden>{{ $pemesanan->total }}</b></h5>
                            <input type="text" name="jumlah_tagihan" value="{{ $pemesanan->total }}" id=""hidden >
{{--                             <input type="text" value="{{ $penerimaan->jumlah_tagihan }}" id="jumlah_tagihan"--}}
{{--                                style="text-align:right;" class="form-control total" name="jumlah_tagihan" placeholder="Jumlah Tagihan">--}}
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jumlah Bayar</label>
                            @if(!empty($pemesanan->bayar))
                                <h5 style="text-align:right"><b class="totala" id="jumlah_tagihana">Rp {{ number_format($pemesanan->bayar) }}</b></h5>
                            @else
                                <input type="number" style="text-align:right" class="form-control" name="jumlah_bayar" id="jumlah_bayar" placeholder="Jumlah Bayar" required>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">Sisa Tagihan</label>
                            @if(!empty($pemesanan->sisa_tagihan))
                                <h5 style="text-align:right"><b>Rp {{ number_format($pemesanan->sisa_tagihan)  }}</b></h5>
                                <input type="text" name="status_pembayaran" id="status_pembayaran" hidden >
                                <input type="text" name="sisa_tagihan" id="sisa_tagihan" value="{{$pemesanan->sisa_tagihan}}" hidden>
                            @else
                                <h5 style="text-align:right"><b class="sisa">0</b></h5>
                                <input type="text" name="sisa_tagihan" id="sisa_tagihan" hidden>
                                <input type="text" name="status_pembayaran" id="status_pembayaran" hidden>
                            @endif
                        </div>
                        <div class="fom-group">
                            <label class="form-label">Bayar sisa Tagihan</label>
                            <input class="form-control" id="bayar_again" name="bayar_sebagian">
                        </div>
                        <div class="fom-group">
                            <label class="form-label">sisa Tagihan</label>
                            <input class="form-control" name="sisa_bayar" id="total_bayar">
                        </div>
{{--                            @if(!empty($pembayaran[0]->akun_pembayaran))--}}
{{--                                <input class="form-control" readonly value="{{ $pembayaran[0]->akun_pembayaran }}">--}}
{{--                            @else--}}
{{--                            <select name="akun_pembayaran" id="" class="form-control">--}}
{{--                                <option value="">-- Pilih Akun --</option>--}}
{{--                                <option value="1">Dummy 1</option>--}}
{{--                                <option value="2">Dummy 2</option>--}}
{{--                            </select>--}}
{{--                            @endif--}}

                    </div>

                </div>
{{--                    <input type="text" value="{{$penerimaan->no_invoice}}" name="invoice" hidden>--}}
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

@push('scripts')
    <script>
        $('#bayar_again').on('keyup', function() {
            var tagihan = $('#sisa_tagihan').val();
            //console.log(tagihan)
            var conver = parseFloat(tagihan);
            //console.log(conver)
            var bayar = parseFloat($('#bayar_again').val());
            //console.log(bayar)
            var tot = conver - bayar;
            //console.log(tot)
            // $('.total_bayar').html(tot);
            $('#total_bayar').val(tot)
            if($('#total_bayar').val() == 0){
                $('#status_pembayaran').val('lunas')
            }else{
                $('#status_pembayaran').val('sebagian')
            }
        });
    </script>
@endpush
