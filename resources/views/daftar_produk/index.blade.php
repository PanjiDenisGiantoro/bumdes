@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">{{ __('Produk Usaha') }}</h3>
    <br>
{{--    <x-breadcrumb title="{{ __('Produk Usaha') }}">--}}
{{--    	<li class="breadcrumb-item">--}}
{{--            <a href="{{ route('daftar_produk.index') }}">{{ __('Produk') }}</a>--}}
{{--        </li>--}}
{{--        <li class="breadcrumb-item">--}}
{{--            {{ __('Daftar Produk') }}--}}
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
                            <input type="text" name="search" class="form-control d-inline" id="search" placeholder="Pencarian Produk Usaha" value="{{ request()->query('search', '') }}">
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
                    <div class="card-options">
                        <div class="btn-group mr-2">

                        </div>

                        <a  style="background-color: blue" href="{{ route('daftar_produk.create') }}">
                            <button class="btn btn-primary">Tambah Produk</button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0" id="tables_produk">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Nama Produk') }}</th>
                            <th>{{ __('Kode Produk') }}</th>
                            <th>{{ __('Kategori') }}</th>
                            <th>{{ __('Harga Beli') }}</th>
                            <th>{{ __('Harga Jual Anggota') }}</th>
                            <th>{{ __('Tindakan') }}</th>
{{--                            <th>{{ __('Tindakan') }}</th>--}}
                        </tr>

                        </thead>
                         <tbody>
                            <tr>
                                @foreach ($daftar_produks as $i => $produk)
                                    <td class="col-lg-none">{{ $daftar_produks->firstItem() + $i }}</td>
                                    <td>{{ $produk->nama_produk ?? '' }}</td>
                                    <td>{{ $produk->kode_produk ?? '' }}</td>
                                <td>{{ $produk->kategori->kategori_produk ?? '' }}</td>
                                <td>{{ number_format($produk->harga_beli)  ?? ''}}</td>
                                <td>{{ number_format($produk->harga_anggota ) ?? '' }}</td>

                                <td class="actions">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Tindakan</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">

                                        <li><a href="{{ route('daftar_produk.show',$produk->id) }}" class="dropdown-item fa fa-eye">&nbsp;Lihat</a></li>
                                            <li><a href="{{ route('daftar_produk.edit',$produk->id) }}" class="dropdown-item fa fa-pencil">&nbsp;Edit</a></li>
                                            <li><a href="{{ '#' }}" class="delete-modal dropdown-item fa fa-trash" data-value="{{ $produk->id }}" data-toggle="modal" data-target="#deleteonModal1{{$produk->id}}"><i class="fas fa-trash-alt" style="color:white"></i>&nbsp;Hapus</a></li>

                                        </ul>
                                </td>
                            </tr>

                        <div class="modal fade zoom" id="deleteonModal1{{$produk->id}}">
                                <div class="modal-dialog modal-sm" role="document">
                                    <form action="{{route('daftar_produk.destroy',$produk->id)}}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi</h5>
                                                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                    <em class="icon ni ni-cross"></em>
                                                </a>
                                            </div>
                                            <div class="modal-body">

                                                <p>Apakah Proses Ini Akan Dilanjutkan?</p>
                                                <button type="submit" class="btn btn-md btn-primary" name="deleteBtn1">
                                                    Lanjutkan
                                                </button>
                                                <a data-dismiss="modal" href="#" class="btn btn-md btn-outline-danger">
                                                    Batal
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                         </tbody>

                    </table>



                </div>
                <div class="card-footer">
                    {{ $daftar_produks->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        tables =  $('#tables_produk').DataTable({
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
            "ordering": true,
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
            //     search: "_INPUT_",
            //     searchPlaceholder: "Cari No. Rekening",
            //
            // }

        });
        $('#search').keyup(function() {
            tables.search($(this).val()).draw(); // this  is for customized searchbox with datatable search feature.
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function (e) {
            $(document).on("click", ".delete-modal", function (e) {
                var delete_id = $(this).attr('data-value');
                $('button[name="deleteBtn1"]').val(delete_id);
            });
        });
    </script>

@endpush

