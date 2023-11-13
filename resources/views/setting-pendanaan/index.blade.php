@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Setting Pendana') }}">
         <!-- <li class="breadcrumb-item">
            <a href="{{ route('summary_batch.index') }}">{{ __('Setting Pendana') }}</a>
        </li> -->
        <li class="breadcrumb-item">
            {{ __('Setting Pendana') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                
                <div class="card-header justify-content-between">
                    <h3 class="card-title">Daftar Pendana</h3>
                    <div class="card-options">
                        <a href="{{ route('setting-pendanaan.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Pendana</a>
                    </div>
                </div>
                <!-- <div class="card-header">
                    <h3 class="card-title">&nbsp;</h3>
                    <div class="card-options">
                        <a  style="background-color: blue" href="{{ route('setting-pendanaan.create') }}">
                            <button class="btn btn-primary">Pendana Baru</button>
                        </a>
                    </div>
                    <h4>{{ __('Daftar Pendana') }}></h4>
                </div> -->
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>{{ __('No') }}</th>
                                <th>{{ __('Pendana') }}</th>
                                <th>{{ __('Kode Pendana') }}</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                         <tbody>
                         @foreach ($ListPendana as $i => $pendana)
                             <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $pendana->nama_pendana ?? '-' }}</td>
                                <td>{{ $pendana->kode_pendana ?? '-' }}</td>
                                <td class="actions">
                                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ route('setting-pendanaan.show', $pendana->id) }}"><i class="fa fa-eye"></i>&nbsp;&nbsp; Lihat </a></li>
                                        <li><a href="{{ route('setting-pendanaan.edit', $pendana->id) }}"><i class="fa fa-pencil"></i>&nbsp;&nbsp; Edit </a></li>
                                    </ul>
                                </td>
                                <!-- <td class="actions">
                                        <a class="btn btn-outline-primary" href="{{ route('setting-pendanaan.show', $pendana->id) }}">Lihat</a>
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ route('setting-pendanaan.edit', $pendana->id) }}">Edit</a></li>
                                        </ul>
                                </td> -->
                            </tr>
                             <div class="modal fade zoom" tabindex="-1" id="deleteonModal1{{$pendana->id}}">
                                 <div class="modal-dialog" role="document">
                                     <form action="{{route('setting-pendanaan.destroy',$pendana->id)}}" method="POST" class="d-inline">
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
                <br>
                <div class="card-footer">
                {{-- {{$batch->links()}}  --}}
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
