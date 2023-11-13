@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Jenis Transaksi') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Jenis Transaksi') }}">
        <li class="breadcrumb-item">
            <a href="{{route('transaksi_keuangan.index')}}">{{ __('Keuangan') }}</a>
        </li>
         <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Jenis Transaksi') }}
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

                        <a  style="background-color: blue" href="{{ route('jenis_transaksi.create') }}">
                            <button class="btn btn-primary">Tambah Jenis Transaksi</button>
                        </a>
                    </div>
                    <!-- <h4><b>{{ __('Jenis Transaksi') }}</b></h4> -->
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>

                            <tr>
                                <th>{{ __('No') }}</th>
                                <th>{{ __('Nama Transaksi') }}</th>
                                <th>{{ __('Jenis Transaksi') }}</th>
                                <th>{{ __('Akun') }}</th>
                                <th>{{ __('Kredit') }}</th>
                                <th>{{ __('Keterangan') }}</th>
                                <th>{{ __('Tindakan') }}</th>
                            </tr>
                        </thead>
                         <tbody>
                         @foreach ($jenis_transaksi as $i => $kode)

                             <tr>
                                <td>{{$jenis_transaksi->firstItem() + $i}}</td>
                                <td>{{$kode->jenis_transaksi ?? ''}}</td>
                                <td>{{$kode->macam_transaksi ?? ''}}</td>
                                <td>{{$kode->akun_perkiraan->nama ?? ''}}</td>
                                <td>{{$kode->kredit == 'on' ? 'Kredit' : 'Debet'}}</td>
                                <td>{{$kode->keterangan ??''}}</td>
                                <td class="actions">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Tindakan</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ route('jenis_transaksi.edit', $kode->id) }}"
                                                   class="dropdown-item fa fa-pencil">&nbsp;Edit</a></li>
                                            <li><a href="{{ '#' }}" class="delete-modal dropdown-item fa fa-trash" data-value="{{ $kode->id ?? ''}}" data-toggle="modal" data-target="#deleteonModal1{{ $kode->id }}"><i class="fas fa-trash-alt"></i>&nbsp;Hapus</a></li>
                                     
</ul>
                                </td>
                            </tr>
                             <div class="modal fade zoom" tabindex="-1" id="deleteonModal1{{$kode->id}}">
                                 <div class="modal-dialog" role="document">
                                     <form action="{{route('jenis_transaksi.destroy',$kode->id)}}" method="POST" class="d-inline">
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

                </div>
            </div>
        </div>
    </div>
@endsection
