@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Termin') }}</h3>
<br>
<!-- <x-breadcrumb title="{{ __('Termin ') }}">
    <li class="breadcrumb-item">
        <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
    </li>
    <li class="breadcrumb-item">
        {{ __(' Termin ') }}
    </li>
</x-breadcrumb> -->
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header justify-content-between">
                <a href="{{ route('tetapan.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Kembali') }}</a>
                    <a href="{{ route('setting_termin_penjualan.create') }}" class="btn btn-primary">Tambah Termin</a>
                </div>
                    <table class="table w-100 text-nowrap ml-3" >
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Termin</th>
                                <th>Hari</th>
                                <th class="actions">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($TerminPenjualan as $termins => $data)
                                <tr>
                                    <td>{{ $TerminPenjualan->firstItem() + $termins }}</td>
                                    <td>{{ $data->nama_termin_penjualan }}</td>
                                    <td>{{ $data->hari_termin_penjualan }}</td>
                                    <td class="actions">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Tindakan</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ route('setting_termin_penjualan.edit', $data->id) }}"
                                                       class="dropdown-item fa fa-pencil">&nbsp;Edit</a></li>
                                                <li><a href="{{ '#' }}" class="delete-modal dropdown-item fa fa-trash" data-value="{{ $data->id ?? ''}}" data-toggle="modal" data-target="#deleteonModal1{{ $data->id }}"><i class="fas fa-trash-alt"></i>&nbsp;Hapus</a></li>
                                      
</ul>
                                </td>
                                </tr>
                                <div class="modal fade zoom" tabindex="-1" id="deleteonModal1{{$data->id}}">
                                    <div class="modal-dialog " role="document">
                                      <form action="{{route('setting_termin_penjualan.destroy',$data->id)}}" method="POST" class="d-inline">
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
                            {{-- <tr>
                                <th>1</th>
                                <td>Joan Powell</td>
                                <td>Associate Developer</td>
                                <td>
                                    <a href="#" class="btn btn-info fa fa-pencil" style="font-size: 12px"></a>
                                    <a href="#" class="btn btn-danger fa fa-trash" style="font-size: 12px"></a>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                <br>
                    <div class="col-7 col-sm-12 col-md-9">
                                         {{ $TerminPenjualan->links() }}
                                    </div>
                </div>
                <!-- table-responsive -->
            </div>
            <!-- section-wrapper -->
            {{-- {{-- </div> --}}

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
