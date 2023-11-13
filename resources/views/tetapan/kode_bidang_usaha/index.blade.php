@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Bidang Usaha') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Bidang Usaha') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Bidang Usaha') }}
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
                        <a style="background-color: blue" href="{{ route('kode_bidang_usaha.create') }}">
                            <button class="btn btn-primary">Tambah Bidang Usaha</button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th class="d-lg-none">&nbsp;</th>
                            <th>{{ __('No') }}</th>
                            <th>{{ __('Bidang Usaha') }}</th>
                            <th>{{ __('Tindakan') }}</th>
                            <!-- <th>&nbsp;</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach ($kodebidangusaha as $i => $kode)
                                <td class="col-lg-none">{{ $kodebidangusaha->firstItem() + $i }}</td>
                                <td>{{$kode->bidang_usaha ?? ''}}</td>
                                <td class="actions">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Tindakan</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{route('kode_bidang_usaha.edit',$kode->id)}}"
                                               class="dropdown-item fa fa-pencil">&nbsp;Edit</a></li>

                                            <li><a href="{{ '#' }}" class="delete-modal dropdown-item fa fa-trash" data-value="{{ $kode->id }}" data-toggle="modal" data-target="#deleteonModal1{{ $kode->id }}"><i class="fas fa-trash-alt"></i>&nbsp;Hapus</a></li>
                                            </ul>
                                    </td>
                                    <div class="modal fade zoom" tabindex="-1" id="deleteonModal1{{$kode->id}}">
                                        <div class="modal-dialog " role="document">
                                            <form action="{{route('kode_bidang_usaha.destroy',$kode->id)}}" method="POST" class="d-inline">
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
                        </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $kodebidangusaha->links() }}
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

