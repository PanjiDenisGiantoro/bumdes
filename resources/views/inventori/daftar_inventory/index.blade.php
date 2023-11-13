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
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Inventory</h3>

{{--                    button right--}}

                    <div class="card-options">
                        <form method="get" >
                            <div class="input-group">
                                <input type="text" name="search" class="form-control d-inline" id="search" placeholder="Pencarian Produk" value="{{ request()->query('search', '') }}">
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
                <div class="table-responsive">
                    <table class="table mb-0" id="tables">
                        <thead>
{{--                        <tr>--}}
{{--                            <th>{{ __('No') }}</th>--}}
{{--                            <th>{{ __('Nama Produk') }}</th>--}}
{{--                            <th>{{ __('Kode Produk') }}</th>--}}
{{--                            <th>Kode SKU</th>--}}
{{--                            <th>{{ __(' Harga Beli') }}</th>--}}
{{--                            <th>{{ __('Satuan Masuk') }}</th>--}}
{{--                            <th>{{ __('Satuan Keluar') }}</th>--}}
{{--                            <th>{{ __('Stok') }}</th>--}}
{{--                            <th>{{ __('Nilai') }}</th>--}}
{{--                            <th>Tindakan</th>--}}
{{--                        </tr>--}}


<tr>
    <th>{{ __('No') }}</th>
    <th>{{ __('Nama Produk') }}</th>
    <th>{{ __('Kode Produk') }}</th>
    {{--                            <th>Kode SKU</th>--}}
    <th>{{ __(' Harga Beli') }}</th>
    {{--                            <th>{{ __('Satuan Masuk') }}</th>--}}
    {{--                            <th>{{ __('Satuan Keluar') }}</th>--}}
    <th>{{ __('Stok') }}</th>
    <th>{{ __('Nilai') }}</th>
    <th>Tindakan</th>
</tr>
                        </thead>
                        <tbody>

                        @foreach($inventory as $i => $inven)
                        <tr>
                            <td>{{$inventory->firstItem() + $i }}</td>
                            <td>{{$inven->nama_produk ?? ''}}</td>
                            <td>{{$inven->kode_produk ?? ''}}</td>
                            <td>{{number_format($inven->harga_beli) ?? ''}}</td>
{{--                            <td>{{number_format($inven->harga_anggota) ?? ''}}</td>--}}
{{--                            <td>{{$inven->jual}}</td>--}}
{{--                            <td>{{$inven->beli}}</td>--}}
                            <td>{{$inven->stok}}</td>
                            <td>{{number_format($inven->harga_beli * $inven->stok)}}</td>
                            @if($inven->jual== '' &&$inven->beli == '')
                                <td >
                                    <div class="dropdown">

                                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ route('daftar_inventori.show',$inven->id) }}" ><i class="fa fa-eye"></i>&nbsp;&nbsp; Lihat</a></li>
                                      </ul>
                                    </div>

                                </td>

                            @else
                                <td>

                                    <div class="dropdown">

                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ route('daftar_inventori.show',$inven->id) }}" ><i class="fa fa-eye"></i>&nbsp;&nbsp; Lihat</a></li>
                                        </ul>
                                    </div>

                                </td>
                                @endif


                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{$inventory->links()}}
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
