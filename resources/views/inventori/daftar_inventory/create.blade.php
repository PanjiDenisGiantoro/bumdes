@extends('layouts.app')

@section('breadcrumb')
 <h3 class="card-header"> Inventori</h3>
    <br>
{{--    <x-breadcrumb title="{{ __('Daftar Inventori') }}">--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('daftar_inventori.index') }}">{{ __('Inventori') }}</a>--}}
{{--        </li>--}}
{{--    	<!-- <li class="breadcrumb-item">--}}
{{--            <a href="">{{ __('Kontak') }}</a>--}}
{{--        </li> -->--}}
{{--        <li class="breadcrumb-item">--}}
{{--            {{ __('Daftar Inventori') }}--}}
{{--        </li>--}}
{{--    </x-breadcrumb>--}}
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Transaksi </h3>

                    {{--                    button right--}}

                    <div class="card-options">
                        <form method="get" >
                            <div class="input-group">
                                <input type="text" name="search" class="form-control d-inline" id="search" placeholder="Pencarian Pergerakan " value="{{ request()->query('search', '') }}">
                                {{--                            <button class="btn btn-white" type="submit">--}}
                                {{--                                <em class="fa fa-search"></em>--}}
                                {{--                            </button>--}}
                                &nbsp;
                                {{-- <select name="status_aktif" class="form-control">
                                    <option value="" >Status</option>
                                    <option value="1" >Aktif</option>
                                    <option value="0" >Tidak Aktif</option>
                                </select> --}}

                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="table-responsive">
                        <table class="table mb-0" id="tables">
                            <thead>
                            <tr>
                                <th>{{ __('No') }}</th>
                                <th>{{ __('Tanggal') }}</th>
                                <th>Transaksi</th>
                                <th>Deskripsi</th>
                                <th>Pergerakan Stok</th>
                                <th>Stok</th>
{{--                                <th>Nilai</th>--}}
                                <th>Debet</th>
                                <th>Kredit</th>
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
{{--                                    <td>{{number_format($inven->total_harga) ?? ''}}</td>--}}
                                    <td>
                                        @if(substr($inven->invoice,0,1))
                                            <span >{{number_format($inven->total_harga)}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(substr($headpembelian->head,0,1))
                                            <span >{{number_format($inven->total_harga)}}</span>
                                        @endif
                                    </td>
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
@push('scripts')

    <script>
        tables =  $('#tables').DataTable({
            //color blue table

            "dom": "lrtip" ,//to hide default searchbox but search feature is not disabled hence customised searchbox can be made.
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            //showing false
            "lengthChange": false,
            "filter": false,
            "ordering": false,
            "info": false,
            "searching": true,

            responsive: true,
            pagging: false,
            paginate : false,
            language: {
                searchPlaceholder: "Cari Produk Usaha",
                "lengthMenu": "Menampilkan _MENU_ data",
                "zeroRecords": "Tidak ada data",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                "infoFiltered": "(disaring dari _MAX_ data keseluruhan)",
                "search": "",
                "processing": "Sedang memproses...",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
            //     search: "_INPUT_",
            //     searchPlaceholder: "Cari No. Rekening",
            //
            // }

        });
        $('#search').keyup(function() {
            tables.search($(this).val()).draw(); // this  is for customized searchbox with datatable search feature.
        })
    </script>
@endpush
