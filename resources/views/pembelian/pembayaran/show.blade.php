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
                @csrf
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label">Tanggal Pembayaran</label>
                            <input readonly type="date" value="{{ !empty($pembayaran[0]->tanggal_pembayaran) ? $pembayaran[0]->tanggal_pembayaran : '' }}" class="form-control" name="tanggal_pembayaran" placeholder="">
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
                                <h5 style="text-align:right"><b class="totala" id="jumlah_tagihana">Rp {{ number_format($pembayaran->jumlah_bayar) }}</b></h5>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Sisa Tagihan</label>
                            @if(!empty($pembayaran[0]->sisa_tagihan))
                                <h5 style="text-align:right"><b>Rp {{ number_format($penerimaan->sisa_tagihan)  }}</b></h5>
                            @else
                                <h5 style="text-align:right"><b class="sisa">0</b></h5>
                                <input type="text" name="sisa_tagihan" id="sisa_tagihan" hidden>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">Akun Pembayaran</label>
                            @if(!empty($pembayaran[0]->akun_pembayaran))
                                <input class="form-control" readonly value="{{ $pembayaran[0]->akun_pembayaran }}">
                            @else
                            <select name="akun_pembayaran" id="" class="form-control">
                                <option value="">-- Pilih Akun --</option>
                                <option value="1">Dummy 1</option>
                                <option value="2">Dummy 2</option>
                            </select>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status Pembayaran</label>
                            @if($penerimaan->status_pembayaran == 'Belum bayar')
                                <select name="status_pembayaran" id="" class="form-control">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Lunas">Lunas</option>
                                    <option value="Sebagian">Sebagian</option>
                                </select>
                            @else($penerimaan->status_pembayaran == 'Belum bayar')
                                <input class="form-control" readonly value="{{ $penerimaan->status_pembayaran }}">
                            @endif
                        </div>
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
                <div class="form-group mb-0 row justify-content-end">
                    <div class=" pull-right">
                        <a href="{{ route('pembelian.pesanan.index') }}" class="btn btn-primary">Kembali</a>
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
        });
    </script>
@endpush
