@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">Penawaran</h3>
    <br>
{{--<br>--}}
{{--<x-breadcrumb title="{{ __('Penjualan') }}">--}}

{{--    <li class="breadcrumb-item">--}}
{{--        {{ __('Penawaran') }}--}}
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
                    <form method="get"  style="width: 50%;"  >
                        <input type="text" name="search" class="form-control w-75 d-inline" id="search" placeholder="Carian Penawaran Penjualan">
                        {{--                            <button class="btn btn-white br-0 w-10" type="submit">--}}
                        {{--                                            <em class="fa fa-search"></em>--}}
                        {{--                            </button>--}}
                    </form>
                    <div class="card-options">
                        <a href="{{ route('penjualan.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Tambah</a>
                    </div>
                </div>
                    <table class="table card-table table-vcenter text-nowrap"  id="tables">
                        <thead>
                            <tr>
                                <td>No</td>
                                <th>Tgl. Penawaran</th>
                                <th>No Penawaran</th>
                                <th>Nama Pelanggan</th>
{{--                                <th>Tgl Jatuh Tempo</th>--}}
                                <th>Status</th>
                                <th>Termin</th>
                                <th>Total</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($penjualan as $termins => $data)

                            <tr>
                                <td>{{ $penjualan->firstItem() + $termins }}</td>
                                <td>{{\Carbon\Carbon::parse($data->tanggal)->format('d/m/Y') ?? ''}}</td>
                                <td>{{$data->no_pesanan ?? ''}}</td>
                                {{-- <td>{{ucfirst($data->anggotas->nama_pemohon ?? '') ?? ucfirst($data->non_anggota ?? '-')}}</td> --}}
                                @if ($data->anggotas)
                                <td>{{ucfirst($data->anggotas->nama_pemohon ?? '') ?? ucfirst($data->non_anggota ?? '-')}}</td>
                                @else
                                <td>{{ucfirst($data->non_anggota ?? '-')}}</td>
                                @endif
                                <td>@if($data->anggota == '1')Anggota @else Bukan Anggota @endif</td>
{{--                                <td>@if($data->tamat_tempoh != null ||$data->tamat_tempoh != '0') {{date('d/m/Y', strtotime($data->tamat_tempoh)) }} @else -  @endif</td>--}}
                                <td>{{$data->termins->nama_termin_penjualan ?? ''}}</td>
                                <td>Rp. {{number_format($data->total) ?? ''}}</td>
                                <td class="actions">
                                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">

                                        <li><a  href="{{ route('penjualan.show',$data->id) }}" ><i class="fa fa-pencil"></i>&nbsp;&nbsp; Lihat</a></li>
                                        <li><a href="{{ route('penjualan.show', array_merge(request()->query(), [$data->id, 'export' => 'pdf'])) }}" target="_blank" ><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp; Cetak</a></li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{ $penjualan->links() }}

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
