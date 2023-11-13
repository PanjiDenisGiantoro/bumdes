@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">Pembayaran</h3>
    <br>
{{--<br>--}}
{{--<x-breadcrumb title="{{ __(' Penjualan') }}">--}}

{{--    <li class="breadcrumb-item">--}}
{{--        {{ __('Penjualan') }}--}}
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
                <div class="card-header justify-content-between">
                    <h3 class="card-title"></h3>
                    <form method="get"  style="width: 50%;">
                        <input type="text" name="search" class="form-control w-75 d-inline" id="search" placeholder="Carian Pembayaran Penjualan">
                        {{--                            <button class="btn btn-white br-0 w-10" type="submit">--}}
                        {{--                                            <em class="fa fa-search"></em>--}}
                        {{--                            </button>--}}
                    </form>
                    <div class="card-options">
                    <a href="{{ route('pengiriman.create') }}" class="btn btn-primary">Tambah</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap" id="tables">
                        <thead>
                            <tr>
                                <td>NO</td>
                                <th>Tgl Pembayaran</th>
                                <th>No. Pembayaran</th>
                                <th>No. Pemesanan</th>
                                <th>Nama Pelanggan</th>
                                <th>Tgl Jatuh Tempo</th>
                                <th>Tagihan</th>
                                <th>Total</th>
                                <th>Tindakan</th>
{{--                                <th>&nbsp;</th>--}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pemesanan as $termins => $data)
                                <tr>
                                 <td>{{ $pemesanan->firstItem() + $termins }}</td>
                                    <td>{{\Carbon\Carbon::parse($data->tanggal_pengiriman ?? '')->format('d/m/Y') ?? ''}}</td>
                                    <td>{{$data->no_pengiriman ?? ''}}</td>
                                    <td>{{$data->pemesanans->no_pemesanan ?? ''}}</td>
                                    <td>{{$data->pelanggans->nama_pemohon ?? $data->non_anggota}}</td>
{{--                                 <td>{{\Carbon\Carbon::parse($data->penawaran->tanggal ?? '')->format('d/m/Y') ?? ''}}</td>--}}
{{--                                <td>{{$data->no_pemesanan ??''}}</td>--}}
{{--                                <td>{{\Carbon\Carbon::parse($data->tanggal_pemesanan ?? '')->format('d/m/Y') ?? ''}}</td>--}}
{{--                                <td>{{$data->pelanggans->nama_pemohon ?? $data->id_pelanggan}}</td>--}}
                                    @if($data->tgl_jatuh_tempo != null)
                                        <td>{{\Carbon\Carbon::parse($data->tgl_jatuh_tempo ?? '')->format('d/m/Y') ?? ''}}</td>
                                    @else
                                        <td> - </td>

                                    @endif
                                    @if($data->sisa_tagihan == 0)
                                        <td>Lunas</td>
                                    @else
                                        <td>Blm Lunas</td>
                                        @endif
                                    <td>Rp.{{number_format($data->total),2}}</td>
                                <td>
{{--                                	<a href="{{route('penjualan.edit',$data->id)}}" class="btn btn-danger fa fa-pencil"  style="font-size: 12px"></a>--}}
                                    @if($data->status_pembayaran_penjualan == 'Lunas')
                                        <a href="{{route('pengiriman.show',$data->id)}}" class="btn btn-success fa fa-eye" style="font-size: 12px"></a>
                                    @else
                                        <a href="{{route('pengiriman.edit',$data->id)}}" class="btn btn-danger fa fa-pencil"  style="font-size: 12px"></a>
                                    @endif
                                </td>

{{--                                        <td>--}}
{{--                                            <div class="dropdown">--}}

{{--                                                <div class="dropdown-menu">--}}
{{--                                                    <li><a href="{{ route('pemesanan_penjualan.show', array_merge(request()->query(), [$data->pemesanans->id ?? '', 'export' => 'pdf'])) }}" class="dropdown-item fa fa-file-pdf-o"  style="font-size: 12px" target="_blank">&nbsp;Cetak Invoice</a></li>--}}
{{--                                                    <li><a href="{{ route('pemesanan_penjualan.show', array_merge(request()->query(), [$data->pemesanans->id ?? '', 'export_do' => 'pdf'])) }}" class="dropdown-item fa fa-file-pdf-o"  style="font-size: 12px" target="_blank">&nbsp;Cetak Surat Jalan</a></li>--}}

{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

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
