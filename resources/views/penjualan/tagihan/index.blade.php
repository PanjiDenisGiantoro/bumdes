@extends('layouts.app')

@section('breadcrumb')
<br>
<x-breadcrumb title="{{ __(' Tagihan') }}">

    <li class="breadcrumb-item">
        {{ __('Tagihan') }}
    </li>
</x-breadcrumb>
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
                <div class="card-header justify-content-between">
                    <h3 class="card-title"></h3>
                    <form method="get"  style="width: 50%;">
                        <input type="text" name="search" class="form-control w-75 d-inline" id="search" placeholder="Carian Tagihan">

                        {{--                            <button class="btn btn-white br-0 w-10" type="submit">--}}
                        {{--                                            <em class="fa fa-search"></em>--}}
                        {{--                            </button>--}}
                    </form>
                    <div class="card-options">

                    </div>
{{--                    <div>--}}
{{--                        <a href="#" class="btn btn-success">Cetak</a>--}}
{{--                        <a href="{{ route('pengiriman.create') }}" class="btn btn-primary">Tambah</a>--}}
{{--                    </div>--}}
                </div>
                    <table class="table card-table table-vcenter text-nowrap" id="tables">
                        <thead>
                            <tr>
                                <td>No</td>
                                <th>No. Invoice</th>
                                <th>Referensi</th>
                                <th>Tanggal Pemesanan</th>
                                <th>No Pemesanan</th>
                                <th>Nama Pelanggan</th>
                                <th>Status</th>
                                <th>Tgl Jatuh Tempo</th>
                                <th>Sisa Tagihan</th>
                                <th>Total</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tagihan as $termins => $data)
                                <tr>
                                 <td>{{ $tagihan->firstItem() + $termins }}</td>
                                    <td>{{$data->no_pengiriman ?? ''}}</td>
                                    <td>{{$data->reference ?? ''}}</td>
                                    <td>{{\Carbon\Carbon::parse($data->pemesanans->tanggal_pemesanan ?? '')->format('d/m/Y') ?? ''}}</td>
                                    <td>{{$data->pemesanans->no_pemesanan ?? ''}}</td>
                                    <td>{{$data->pelanggans->nama_pemohon ?? $data->non_anggota}}</td>
{{--                                 <td>{{\Carbon\Carbon::parse($data->penawaran->tanggal ?? '')->format('d/m/Y') ?? ''}}</td>--}}
{{--                                <td>{{$data->no_pemesanan ??''}}</td>--}}
{{--                                <td>{{\Carbon\Carbon::parse($data->tanggal_pemesanan ?? '')->format('d/m/Y') ?? ''}}</td>--}}
{{--                                <td>{{$data->pelanggans->nama_pemohon ?? $data->id_pelanggan}}</td>--}}
                                <td>{{$data->status}}</td>
                                    <td></td>
                                    @if($data->sisa_tagihan == 0)
                                        <td>Lunas</td>
                                    @else
                                        <td>Blm Lunas</td>
                                        @endif
                                    <td>Rp.{{number_format($data->total),2}}</td>
                                <td>
{{--                                	<a href="{{route('penjualan.edit',$data->id)}}" class="btn btn-danger fa fa-pencil"  style="font-size: 12px"></a>--}}
                                    @if($data->status_pembayaran_penjualan == 'Lunas')
                                        <a href="{{route('pengiriman.show',$data->id)}}" class="btn btn-success fa fa-eye"  style="font-size: 12px"></a>
                                    @else
                                        <a href="{{route('pengiriman.edit',$data->id)}}" class="btn btn-danger fa fa-pencil"  style="font-size: 12px"></a>

                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

            {{ $tagihan->links() }}

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
