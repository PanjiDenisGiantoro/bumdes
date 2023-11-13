@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __(' Kas Arus Aktivitas') }}">
        <!-- <li class="breadcrumb-item">
            <a href="{{route('transaksi_keuangan.index')}}">{{ __('Keuangan') }}</a>
        </li> -->
         <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Setting') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __(' Kas Arus Aktivitas') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">&nbsp;</h3>
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

                        <a  style="background-color: blue" href="{{ route('kode_kas_arus_aktivitas.create') }}">
                            <button class="btn btn-primary">Tambah  Kas Arus Aktivitas</button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th class="d-lg-none">&nbsp;</th>
                                <th></th>
                                <th>{{ __('No') }}</th>
                                <th>&nbsp;</th>
                                <th>{{ __('Kode Arus Kas Aktivitas') }}</th>
                                <th>&nbsp;</th>
                                <th>{{ __('Keterangan') }}</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th></th>
                                <th>{{ __('Tindakan') }}</th>
                                <!-- <th>&nbsp;</th> -->
                            </tr>
                        </thead>
                         <tbody>
                         <tr>
{{--                             @foreach ($agunan as $i => $kode)--}}
{{--                                 <td class="col-lg-none">{{ $agunan->firstItem() + $i }}</td>--}}
{{--                                 <td>{{$kode->nama_agunan ?? ''}}</td>--}}
{{--                                 <td class="action">--}}
{{--                                     <a href="{{route('agunan.edit',$kode->id)}}"--}}
{{--                                        class="btn btn-primary fa fa-pencil" style="background-color: blue"></a>--}}
{{--                                     <a href="{{ '#' }}" class="delete-modal btn btn-danger fa fa-trash" data-value="{{ $kode->id ?? '' }}" data-toggle="modal" data-target="#deleteonModal1{{$kode->id}}"><i class="fas fa-trash-alt" style="color:white"></i></a>--}}
{{--                                 </td>--}}
{{--                         </tr>--}}
{{--                         <div class="modal fade zoom" tabindex="-1" id="deleteonModal1{{$kode->id}}">--}}
{{--                             <div class="modal-dialog" role="document">--}}
{{--                                 <form action="{{route('kode_kas_arus_aktivitas.destroy',$kode->id)}}" method="POST" class="d-inline">--}}
{{--                                     @method('delete')--}}
{{--                                     @csrf--}}
{{--                                     <div class="modal-content">--}}
{{--                                         <div class="modal-body">--}}
{{--                                             <center> <i class="fe fe-alert-circle fa-4x" style="color: red;"></i></center>--}}
{{--                                             <br>--}}
{{--                                             <center><h2>Notifikasi</h2></center>--}}
{{--                                             <p style="text-align: center;font-size: 15px">Adakah Anda Ingin Melanjutkan Proses Ini ? </p>--}}
{{--                                             <div class="text-center">--}}
{{--                                                 <button type="submit" class="btn btn-md btn-primary mr-3" name="deleteBtn1">--}}
{{--                                                     &nbsp; Ya &nbsp;--}}
{{--                                                 </button>--}}
{{--                                                 <a data-dismiss="modal" href="#" class="btn btn-md btn-danger">--}}
{{--                                                     Tidak--}}
{{--                                                 </a>--}}
{{--                                             </div>--}}
{{--                                         </div>--}}
{{--                                     </div>--}}
{{--                                 </form>--}}
{{--                             </div>--}}
{{--                         </div>--}}
{{--                         @endforeach--}}
                        </tbody>
                    </table>
                </div>
                <br>

                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
@endsection
