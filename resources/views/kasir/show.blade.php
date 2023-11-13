@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">Kasir</h3>
    <br>
{{--    <x-breadcrumb title="{{ __('Kasir') }}">--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('kasir.index') }}">{{ __('Kasir') }}</a>--}}
{{--        </li>--}}
{{--        <li class="breadcrumb-item">--}}
{{--            Kasir--}}
{{--        </li>--}}
{{--    </x-breadcrumb>--}}
@endsection

@section('content')
    <div class="side-app">
        <div class="row row-cards">

            <div class="col-lg-8">
                <div class="card m-b-20">
                    <div class="card-header ">
                        <div class="card-title">Produk List</div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive border-top">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Diskon</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($kasirBodyList as $i => $body)
                                <tr>
                                    <td>{{$kasirBodyList->firstItem() + $i}}</td>
                                    <td>{{$body->produk->nama_produk ?? ''}}</td>
                                    <td><span>{{number_format($body->produk->harga_anggota) ?? ''}}</span></td>
                                    <td>{{$body->qty ??''}} {{$body->produk->satuan->satuan_produk ?? ''}}</td>
                                    <td>{{number_format($body->diskon) ??''}}</td>
                                    <td><span>{{number_format($body->total) ?? ''}}</span></td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {{$kasirBodyList->links()}}
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card ">
                    <div class="card-header ">
                        <div class="card-title">Order Pembayaran</div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td><span>No.Order</span></td>
                                    <td class="text-right text-muted"><span>{{$kasirList->no_order ?? ''}}</span></td>
                                </tr>
                                <tr>
                                    <td><span>Status Anggota</span></td>
                                    <td class="text-right text-muted"><span>{{$kasirList->status_anggota_text}}</span></td>
                                </tr>
                                <tr>
                                    <td><span>Nama</span></td>
                                    <td class="text-right text-muted"><span>
                                            @if($kasirList->stataus_anggota == '0')
                                                {{$kasirList->anggota_id ?? ''}}
                                            @else
                                                {{$kasirList->anggota->nama_pemohon ?? ''}}
                                            @endif
                                        </span></td>
                                </tr>
                                <tr>
                                    <td><span>Order Total</span></td>
                                    <td><h4 class="price text-right mb-0">Rp. {{number_format($kasirList->total)}}</h4></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <form class="text-center">
                            <a href="{{route('kasir.index')}}" class="btn btn-danger mt-2 m-b-20">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
