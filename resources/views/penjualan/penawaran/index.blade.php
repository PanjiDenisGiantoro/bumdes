@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">Pemesanan</h3>
    <br>
{{--<br>--}}
{{--<x-breadcrumb title="{{ __(' Penjualan') }}">--}}

{{--    <li class="breadcrumb-item">--}}
{{--        {{ __('Pemesanan') }}--}}
{{--    </li>--}}
{{--</x-breadcrumb>--}}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            {{-- <div class="card-header">
                <h3 class="card-title">&nbsp;</h3>
                <div class="card-options">
                    <a style="background-color: blue" href="{{ route('tipe_kontak.create') }}">
            <button class="btn btn-primary">Tambah Tipe Kontak</button>
            </a>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header ">
                    <h3 class="card-title"></h3>
                    <form method="get"  style="width: 50%;">
                        <input type="text" name="search" class="form-control w-75 d-inline" id="search" placeholder="Carian Pemesanan Penjualan">
                        {{--                            <button class="btn btn-white br-0 w-10" type="submit">--}}
                        {{--                                            <em class="fa fa-search"></em>--}}
                        {{--                            </button>--}}
                    </form>
                    <div class="card-options">
{{--                        <a href="#" class="btn btn-success">Cetak</a>--}}
                        <a href="{{ route('pemesanan_penjualan.create') }}" class="btn btn-primary">Tambah</a>
                    </div>
                </div>
                    <table class="table card-table table-vcenter text-nowrap" id="tables">
                        <thead>
                            <tr>
                                <td>NO</td>
                                <th>Tanggal Pemesanan</th>
                                <th>No Pemesanan</th>
                                <th>Tgl. Penawaran</th>
                                <th>Nama Lengkap</th>
                                <th>Status</th>
                                <th>Termin</th>
                                <th>Total</th>
{{--                                <th>Invoice</th>--}}
{{--                                <th>Surat Jalan</th>--}}
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pemesanan as $termins => $data)
                                <tr>
                                 <td>{{ $pemesanan->firstItem() + $termins }}</td>
                                    <td>{{ date('d/m/Y', strtotime($data->tanggal_pemesanan   )) }}</td>
                                    <td>{{$data->no_pemesanan ??''}}</td>
                                    <td>{{\Carbon\Carbon::parse($data->penawaran->tanggal ?? '')->format('d/m/Y') ?? ''}}</td>
                                <td>{{$data->pelanggans->nama_pemohon ?? $data->non_anggota}}</td>
                                <td>@if($data->pelanggan =='1')Anggota @else Bukan Anggota @endif</td>
                                <td>{{$data->termins->nama_termin_penjualan ?? ''}}</td>
                                <td style="text-align: right;">Rp. {{ !empty($data->total) ? number_format($data->total) : '0.00' }}</td>
                                    <td class="actions">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li> <a href="{{route('pemesanan_penjualan.show',$data->id)}}" class="dropdown-item  fa fa-eye"  style="font-size: 12px">&nbsp;Lihat</a></li>
                                            @if(empty($data->pengirimans->id))
                                            @else
                                                <li><a href="{{ route('pemesanan_penjualan.show', array_merge(request()->query(), [$data->id ?? '', 'export' => 'pdf'])) }}" class="dropdown-item fa fa-file-pdf-o"  style="font-size: 12px" target="_blank">&nbsp;Cetak Invoice</a></li>
                                                <li><a href="{{ route('pemesanan_penjualan.show', array_merge(request()->query(), [$data->id ?? '', 'export_do' => 'pdf'])) }}" class="dropdown-item fa fa-file-pdf-o"  style="font-size: 12px" target="_blank">&nbsp;Cetak Surat Jalan</a></li>
                                            @endif

                                              </ul>
                                    </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            {{ $pemesanan->links() }}

                <!-- table-responsive -->
            </div>
            <!-- section-wrapper -->
        </div>

    </div>

</div>
</div>
</div>
@endsection
@push('css')
<link href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/jquery.dataTables.min.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
<link src="{{ asset('assets/plugins/datatable/jquery.dataTables.min.js') }}" rel="stylesheet" />
<link src="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.js') }}" rel="stylesheet" />
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
            searchPlaceholder: "Cari No.Rekening",
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
    });
    $('#search').keyup(function() {
        tables.search($(this).val()).draw(); // this  is for customized searchbox with datatable search feature.
    })
</script>
@endpush
