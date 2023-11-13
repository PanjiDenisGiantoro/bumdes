@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Pelanggan') }}">

        <li class="breadcrumb-item">
            {{ __('Pelanggan') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">&nbsp;</h3>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th class="d-lg-none">&nbsp;</th>
                            <th>{{ __('No') }}</th>
                            <th>{{ __('Nama Pelanggan') }}</th>
                            <th>{{ __('Username') }}</th>
                            <th>{{ __('Email') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach ($pelanggan as $i => $kode)
                                <td class="col-lg-none">{{ $pelanggan->firstItem() + $i }}</td>
                                <td>{{$kode->name ?? ''}}</td>
                                <td>{{$kode->username ?? ''}}</td>
                                <td>{{$kode->email ?? ''}}</td>
{{--                                <td class="action">--}}
{{--                                        <a href="{{route('pelanggan.edit',$kode->id)}}"--}}
{{--                                           class="btn btn-primary fa fa-pencil" style="background-color: blue"></a>--}}
{{--                                    <a href="{{ '#' }}" class="delete-modal btn btn-danger fa fa-trash" data-value="{{ $kode->id ?? '' }}" data-toggle="modal" data-target="#deleteonModal1{{$kode->id}}"><i class="fas fa-trash-alt" style="color:white"></i></a>--}}
{{--                                </td>--}}
                        </tr>
{{--                        <div class="modal fade zoom" tabindex="-1" id="deleteonModal1{{$kode->id}}">--}}
{{--                            <div class="modal-dialog" role="document">--}}
{{--                                <form action="{{route('pelanggan.destroy',$kode->id)}}" method="POST" class="d-inline">--}}
{{--                                    @method('delete')--}}
{{--                                    @csrf--}}
{{--                                    <div class="modal-content">--}}
{{--                                        <div class="modal-body">--}}
{{--                                            <center> <i class="fe fe-alert-circle fa-4x" style="color: red;"></i></center>--}}
{{--                                            <br>--}}
{{--                                            <center><h2>Notifikasi</h2></center>--}}
{{--                                            <p style="text-align: center;font-size: 15px">Adakah Anda Ingin Melanjutkan Proses Ini ? </p>--}}
{{--                                            <div class="text-center">--}}
{{--                                                <button type="submit" class="btn btn-md btn-primary mr-3" name="deleteBtn1">--}}
{{--                                                    &nbsp; Ya &nbsp;--}}
{{--                                                </button>--}}
{{--                                                <a data-dismiss="modal" href="#" class="btn btn-md btn-danger">--}}
{{--                                                    Tidak--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $pelanggan->links() }}
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
