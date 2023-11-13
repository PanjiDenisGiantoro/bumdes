@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Perpajakan') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Perpajakan') }}">
        <li class="breadcrumb-item">
            <a href="{{route('transaksi_keuangan.index')}}">{{ __('Keuangan') }}</a>
        </li>
        <li class="breadcrumb-item">
        </li>
         <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Perpajakan') }}
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

                        <a style="background-color: blue" href="{{ route('perpajakan_keuangan.create') }}">
                            <button class="btn btn-primary">Tambah Pajak</button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>{{ __('Nama Pajak') }}</th>
                            <th>{{ __('Tarif Persentase %') }}</th>
                            <th>{{ __('Akun Pajak Penjualan') }}</th>
                            <th>{{ __('Akun Pajak Pembelian') }}</th>
                            <th>{{ __('Pemotongan') }}</th>
                            <th>{{ __('Tindakan') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach ($pajak as $i => $kode)
                                <td class="col-lg-none">{{ $pajak->firstItem() + $i }}</td>
                                <td>{{$kode->nama_pajak ?? ''}}</td>
                                <td>{{$kode->tarif_persentase ?? ''}}</td>
                            <td>{{$kode->pajak_penjualan->nama ?? ''}}</td>
                            <td>{{$kode->pajak_pembelian->nama ?? ''}}</td>
                                @if($kode->pemotongan == 2)
                                    <td>Ya</td>
                                @else
                                    <td>Tidak</td>
                                @endif
                                <td class="actions">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Tindakan</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ route('perpajakan_keuangan.edit', $kode->id) }}"
                                                   class="dropdown-item fa fa-pencil">&nbsp;Edit</a></li>
                                            <li><a href="{{ '#' }}" class="delete-modal dropdown-item fa fa-trash" data-value="{{ $kode->id ?? ''}}" data-toggle="modal" data-target="#deleteonModal1{{ $kode->id }}"><i class="fas fa-trash-alt"></i>&nbsp;Hapus</a></li>
                                   
</ul>
                                </td>
                               
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $pajak->links() }}

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade zoom" tabindex="-1" id="deleteonModal1">
        <div class="modal-dialog " role="document">
            <form action="/perpajakan_keuangan/{{ $kode->id ?? '' }}" method="POST" class="d-inline">
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