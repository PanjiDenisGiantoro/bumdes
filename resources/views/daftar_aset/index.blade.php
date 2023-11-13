@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">Daftar Aset</h3>
    <br>
{{--    <x-breadcrumb title="{{ __('Daftar Aset') }}">--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('daftar_aset.index') }}">{{ __('Aset Mgmt.') }}</a>--}}
{{--        </li>--}}
{{--    	<!-- <li class="breadcrumb-item">--}}
{{--            <a href="">{{ __('Kontak') }}</a>--}}
{{--        </li> -->--}}
{{--        <li class="breadcrumb-item">--}}
{{--            {{ __('Daftar Aset') }}--}}
{{--        </li>--}}
{{--    </x-breadcrumb>--}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">&nbsp;</h3>
                    <form method="get"style="width: 50%;" >
                        <div class="input-group">
                            <input type="text" name="search" class="form-control d-inline" id="search" placeholder="Pencarian Aset" value="{{ request()->query('search', '') }}">
                        </div>
                    </form>
                    <div class="card-options">

                        <a  style="background-color: blue" href="{{ route('daftar_aset.create') }}">
                            <button class="btn btn-primary">Tambah Daftar Aset</button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0" id="tables">
                        <thead>
                            <tr>
                                <th>{{ __('No') }}</th>
                                <th>{{ __('Kelompok Aset') }}</th>
                                <th>{{ __('Aset') }}</th>
                                <th>{{ __('Tgl Perolehan') }}</th>
                                <th>{{ __('Waktu Manfaat') }}</th>
                                <th>{{ __('Nilai Perolehan') }}</th>
                                <th>{{ __('Sisa Waktu Manfaat') }}</th>
                                <th>{{ __('Total Akumulasi') }}</th>
                                <th>{{ __('Nilai Buku') }}</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                         <tbody>
                         @foreach ($asets as $i => $produk)
                            <tr>
                                <td>{{ $asets->firstItem() + $i }}</td>
                                <td>{{$produk->kelompokaset->kelompok_aset ?? ''}}</td>
                                <td>{{$produk->nama_aset ?? ''}}</td>
                                <td>{{\Carbon\Carbon::parse($produk->tanggal_akuisisi)->format('d/m/Y') ?? ''}}</td>
                                <td>{{$produk->nilai ?? ''}}</td>
                                <td>Rp.{{number_format((float)$produk->biaya_akuisisi ?? ''),2}}</td>
                                <td>{{$produk->perbedaan_bulan ?? ''}} Bulan</td>
                                <td>Rp.{{number_format((float)$produk->total_penyusutan ?? ''),2}}</td>
                                <td>Rp.{{number_format((float)$produk->perkiraan_akhir_buku ?? ''),2}}</td>
                                <td class="actions">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle " data-toggle="dropdown" title="Aksi">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <form method="post" class="delete-form" data-route="{{route('daftar_aset.destroy',$produk->id)}}">
                                                <li><a href="{{ route('daftar_aset.show',$produk->id) }}" class="dropdown-item fa fa-eye">&nbsp;Lihat</a></li>
                                                <li><a href="{{ route('daftar_aset.edit',$produk->id) }}" class="dropdown-item fa fa-pencil">&nbsp;Edit</a></li>
                                                @method('delete')
                                                <li><button type="submit" class="dropdown-item  fa fa-trash">&nbsp;Hapus</button></li>
                                            </form>

                                        </div>
                                    </div>

                                  </td>
                            </tr>
                         @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $asets->links() }}

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {

            $('.delete-form').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: $(this).data('route'),
                    data: {
                        '_method': 'delete'
                    },
                    success: function (response, textStatus, xhr) {
                        window.location = '/daftar_aset'

                    }
                });
            })
        });
    </script>
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
                    searchPlaceholder: "Cari Aset",
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
