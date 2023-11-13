@extends('pengajuans.layouts_pengajuan.app')

@section('content')
{{--    @include('pengajuans.layouts_pengajuan.headers.cards')--}}

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0"></h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <br>
                            <br>
                            <br>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
{{--                    <div class="card-header border-0">--}}
{{--                        <h3 class="mb-0">Pengajuan</h3>--}}
{{--                    </div>--}}
{{--                    button add--}}
                    <div class="card-header border-0">
                        <a href="{{route('pengajuan.create')}}" class="btn btn-primary">Tambah Pengajuan</a>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="table">
                            <thead class="thead-light">
                            </thead>
                            <tbody class="list">
                            <th>
                                <tr>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">No</span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">Tgl Pengajuan</span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">Nama</span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">No Telp</span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">Margin</span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">Pendapatan</span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">Status</span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">Tindakan</span>
                                            </div>
                                        </div>
                                    </th>

                            </tr>

                            </tbody>
                            @foreach($pengajuan as $i => $pengajuans)

                                <tr>
                                    <td>{{$pengajuan->firstItem() + $i}}</td>
                                    <td>{{ date('d/m/Y', strtotime($pengajuans->created_at)) }}</td>
                                    <td>{{$pengajuans->nama}}</td>
                                    <td>{{$pengajuans->no_telp ?? ''}}</td>
                                    <td>{{$pengajuans->margin}} %</td>
                                    <td>{{number_format($pengajuans->pendapatan) ?? ''}}</td>
                                    <td>@if($pengajuans->sisa_dana > $pengajuans->pendapatan * ($pengajuans->rasio/100))
                                            <span class="badge badge-success">Disetujui</span>
                                        @else
                                            <span class="badge badge-danger">Tidak Disetujui</span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item delete-modal " href="#" data-toggle="modal" data-value="{{ $pengajuans->id }}" data-target="#deleteonModal1{{$pengajuans->id}}">Hapus</a>
                                                <a class="dropdown-item" href="{{route('pengajuan.show',$pengajuans->id)}}">Lihat</a>

                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade zoom" tabindex="-1" id="deleteonModal1{{$pengajuans->id}}">
                                    <div class="modal-dialog " role="document">
                                        <form action="{{route('pengajuan.destroy',$pengajuans->id)}}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <center> <i class="fe fe-alert-circle fa-4x" style="color: red;"></i></center>
                                                    <br>
                                                    <center><h2>Notifikasi</h2></center>
                                                    <p style="text-align: center;font-size: 15px">Adakah Anda Ingin Melanjutkan Proses Ini ? </p>
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-md btn-primary mr-3" name="deleteBtn1">
                                                            &nbsp; Ya &nbsp;
                                                        </button>
                                                        <a data-dismiss="modal" href="#" class="btn btn-md btn-danger">
                                                            Tidak
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </table>
{{--                        paginate--}}
                        <div class="mt-4">
                            {{$pengajuan->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
    </div>

    @include('pengajuans.layouts_pengajuan.footers.auth')
@endsection

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@push('js')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    <script>
        $('#table').DataTable();
    </script>

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script type="text/javascript">
            $(document).ready(function (e) {
                $(document).on("click", ".delete-modal", function (e) {
                    var delete_id = $(this).attr('data-value');
                    $('button[name="deleteBtn1"]').val(delete_id);
                });
            });
        </script>
@endpush
