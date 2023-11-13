@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header"> Inventori</h3>
    <br>

{{--    <x-breadcrumb title="{{ __('Informasi Pergerakan Stok') }} -  {{$daftar_inventory_pemebelian[0]->nama_produk}}">--}}
{{--        <!-- <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('tetapan.index') }}">{{ __('Setting') }}</a>--}}
{{--        </li> -->--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('daftar_inventori.index') }}">{{ __('Inventori') }}</a>--}}
{{--        </li>--}}
{{--        <li class="breadcrumb-item">--}}
{{--            {{ __('Informasi Pergerakan Stok') }}</a>--}}
{{--        </li>--}}
{{--    </x-breadcrumb>--}}
@endsection

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informasi Inventory Produk : {{$daftar_inventory_pemebelian[0]->nama_produk ?? '-'}}</h3>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"></h3>
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-md-12">
                            <div class="card ">
                                <div class="card-body text-center">
                                    <div class="counter-status dash3-counter">
                                        <div class="counter-icon bg-primary text-primary">
                                            <h3 class="text-white">{{$produk->stok ?? ''}}</h3>
                                        </div>
                                        <h5>Stok</h5>
                                        <h2 class="counter">{{$produk->stok * $produk->harga_beli ?? ''}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12">
                            <div class="card ">
                                <div class="card-body text-center">
                                    <div class="counter-status dash3-counter">
                                        <div class="counter-icon bg-success text-success">
                                            <h3 class="text-white">{{$penjualan_body->qty ?? ''}}</h3>
                                        </div>
                                        <h5>Penjualan</h5>
                                        <h2 class="counter">{{$penjualan->total}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12">
                            <div class="card ">
                                <div class="card-body text-center">
                                    <div class="counter-status dash3-counter">
                                        <div class="counter-icon bg-warning text-warning">
                                            <h3 class="text-white">{{$pembelian->qty_stok ?? ''}}</h3>
                                        </div>
                                        <h5>Pembelian</h5>
                                        <h2 class="counter">{{$pembelian->total_stok}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12">
                            <div class="card ">
                                <div class="card-body text-center">
                                    <div class="counter-status dash3-counter">
{{--                                        image --}}

                                            <img src="{{ asset('storage/' . ($gambar[0] ?? 'https://i.ibb.co/LNgwbLy/default-placeholder.png')) }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="card-footer">
{{--                        table--}}
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                <tr>
                                    <th colspan="4 "><h5 style="font-weight: bold" >Informasi Produk</h5></th>
                                </tr>
                                <tr>
                                    <th width="28%">Kode Produk</th>
                                    <td>{{$produk->kode_produk ?? ''}}</td>
                                    <th>Kategori</th>
                                    <td>{{$produk->kategoris->kategori_produk ?? ''}}</td>

                                </tr>
                                <tr>
                                    <th width="28%">Barcode</th>
                                    <td>{{$produk->no_barcode ?? ''}}</td>
                                    <th>Satuan</th>
                                    <td>{{$produk->satuan->satuan_produk ?? ''}}</td>
                                </tr>

                                <tr>
                                    <th width="28%">Harga Beli</th>
                                    <td>{{number_format($produk->harga_beli )?? ''}}</td>
                                    <th>Pajak Pembelian</th>
                                    <td>{{$produk->pajakbeli->nama_pajak ?? ''}}</td>

                                </tr>

                                <tr>
                                    <th width="28%">Harga Jual</th>
                                    <td>{{number_format($produk->harga_anggota )?? ''}}</td>
                                    <th>Pajak Penjualan</th>
                                    <td>{{$produk->pajakjual->nama_pajak ?? ''}}</td>

                                </tr>
                            </table>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pergerakan Stok</h3>
                </div>
                <div class="panel panel-primary">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                        <tr>
                                            <th class="d-lg-none">&nbsp;</th>
                                            <th>{{ __('No') }}</th>
                                            <th>{{ __('Tanggal') }}</th>

                                            <th>Transaksi</th>
                                            <th>Deskripsi</th>
                                            <th>Pergerakan Stok</th>
                                            <th>Stok</th>
                                            <th>Tindakan</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($daftar_inventory_pemebelian as $i=> $inven)
                                            <tr>
                                                <td>{{$daftar_inventory_pemebelian->firstItem()+ $i}}</td>
                                                <td>{{\Carbon\Carbon::parse($inven->created_at)->format('d/m/Y') ?? ''}}</td>
                                                <td>@if(substr($inven->invoice,0,1) ==  substr($headpembelian->head,0,1))
                                                    Tagihan Pembelian
                                                    @else
                                                    Tagihan Penjualan
                                                    @endif
                                                </td>
                                                <td>{{$inven->invoice ?? ''}} -  {{$inven->supplier ?? ''}} </td>
                                                <td >@if(substr($inven->invoice,0,1) == substr($headpembelian->head,0,1))
                                                        <span style="color: green">+{{$inven->qty}}</span>
                                                    @else
                                                        <span style="color: red">-{{$inven->qty}}</span>
                                                    @endif</td>
                                                <td>{{$inven->stok ?? ''}}</td>
                                                @if(substr($inven->invoice,0,1) ==  substr($headpembelian->head,0,1))
                                                    <td class="actions">
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                                                <span class="caret"></span>
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <li> <a href="{{route('pembelian.pembayaran.show',$inven->id)}}" ><i class="fa fa-eye"></i>&nbsp;Lihat</a></li>
                                                            </div>
                                                        </div>
                                                       </td>
                                                @else
                                                    <td class="actions">
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                                                <span class="caret"></span>
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <li><a href="{{route('pengiriman.show',$inven->id)}}" ><i class="fa fa-eye"></i>&nbsp;Lihat</a></li>
                                                            </div>
                                                        </div>
                                                        </td>
                                                @endif
                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                    <div class="card-footer">
                        {{$daftar_inventory_pemebelian->links()}}
                    </div>
                            </div>

                        </div>
                    </div>
                </div>



@endsection
