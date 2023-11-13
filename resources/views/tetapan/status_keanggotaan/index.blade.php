@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Kategori Keanggotaan') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Kategori Keanggotaan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Kategori Keanggotaan') }}
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                <a href="{{ route('tetapan.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Kembali') }}</a>
                    <div class="card-options">
                        <!-- <div class="btn-group mr-2">
                            <a class="btn btn-primary" style="background-color: blue; margin-right: 7px" href="">
                                <i class="fa fa-print">&nbsp; Cetak</i>
                            </a>
                            <a class="btn btn-primary" style="background-color: red; margin-right: 7px" href="">
                                <i class="fa fa-file-pdf-o">&nbsp; PDF</i>
                            </a>
                            <a class="btn btn-primary" style="background-color: green;  margin-right:7px" href="">
                                <i class="fa fa-file-excel-o">&nbsp; EXCEL</i>
                            </a>
                        </div> -->

                        <a  style="background-color: blue" href="{{ route('status_keanggotaan.create') }}">
                            <button class="btn btn-primary">Tambah Kategori Keanggotaan</button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>{{ __('No') }}</th>

                                <th>{{ __('Kode Status Keanggotaan') }}</th>
                                <th>{{ __('Kategori Keanggotaan') }}</th>

                                <th>{{ __('Tindakan') }}</th>
                                <!-- <th>&nbsp;</th> -->
                            </tr>
                        </thead>
                         <tbody>
                         @php $no = 1 ;@endphp
                         @foreach($status_keanggotaan as $kode)
                            <tr>
                                <td class="col-lg-none">{{$no++}}</td>
                                <td>{{$kode->kode_status_keanggotaan ?? ''}}</td>
                                <td>{{$kode->status_keanggotaan ?? ''}}</td>
                                {{-- <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-dribbble dropdown-toggle btn-sm" data-toggle="dropdown" title="Aksi">
                                            Tindakan
                                        </button>
                                        <div class="dropdown-menu">
                                            <li><a href="{{route('status_keanggotaan.edit',$kode->id)}}"
                                                   class="dropdown-item fa fa-pencil" >&nbsp;Edit</a></li>
                                            <li><a href='#'
                                                   class="dropdown-item fa fa-trash" data-value="{{ $kode->id ?? '' }}" data-toggle="modal" data-target="#deleteonModal1{{$kode->id}}">&nbsp;Hapus</a></li>
                                        </div>
                                    </div>
                                    </td>
                                <td></td> --}}

                                <td class="actions">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Tindakan</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                        <li><a  href="{{ route('status_keanggotaan.edit',$kode->id) }}" ><i class="fa fa-pencil"></i>&nbsp;&nbsp; Edit</a></li>
                                            <li><a href="#" data-toggle="modal" data-target="#deleteonModal1{{$kode->id}}"><i class="fa fa-trash" data-value="{{ $kode->id ?? '' }}"></i>&nbsp;&nbsp; Hapus</a></li>
                          
</ul>
                                </td>

                            </tr>
                            <div class="modal fade zoom" tabindex="-1" id="deleteonModal1{{$kode->id}}">
                                <div class="modal-dialog" role="document">
                                    <form action="{{route('status_keanggotaan.destroy',$kode->id)}}" method="POST" class="d-inline">
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
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $status_keanggotaan->links() }}
                </div>

            </div>
        </div>
    </div>

@endsection

@push('scripts')
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
