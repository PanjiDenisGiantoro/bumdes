@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Daftar Kontak') }}">
    	<li class="breadcrumb-item">
            <a href="">{{ __('Kontak') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Daftar Kontak') }}
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
                        <div class="btn-group mr-2">

                         <a class="btn btn-primary fa fa-print" style="background-color: blue; margin-right: 7px">&nbsp; CETAK</a>
                        <!-- <a class="btn btn-primary" style="background-color: blue; margin-right: 7px" href="">
                            <i class="fa fa-print">&nbsp; CETAK</i>
                        </a> -->
                        <a class="btn btn-primary fa fa-file-pdf-o" style="background-color: red; margin-right: 7px">&nbsp; PDF</a>
                       <!--  <a class="btn btn-primary" style="background-color: red; margin-right: 7px" href="">
                            <i class="fa fa-file-pdf-o">&nbsp; PDF</i>
                        </a> -->
                        <a class="btn btn-primary fa fa-print" style="background-color: green; margin-right: 7px">&nbsp; EXCEL</a>
                            <!-- <a class="btn btn-primary" style="background-color: green;  margin-right:7px" href="">
                                <i class="fa fa-file-excel-o">&nbsp; EXCEL</i>
                            </a> -->
                           <!--  <a class="btn btn-primary" style="background-color: blue; margin-right: 7px" href="">
                                <i class="fa fa-print">&nbsp; Cetak</i>
                            </a>
                            <a class="btn btn-primary" style="background-color: red; margin-right: 7px" href="">
                                <i class="fa fa-file-pdf-o">&nbsp; PDF</i>
                            </a>
                            <a class="btn btn-primary" style="background-color: green;  margin-right:7px" href="">
                                <i class="fa fa-file-excel-o">&nbsp; EXCEL</i>
                            </a> -->
                        </div>

                        <a  style="background-color: blue" href="{{ route('daftar_kontak.create') }}">
                            <button class="btn btn-primary">Tambah Daftar Kontak</button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>{{ __('No') }}</th>
                                <th>{{ __('Nama') }}</th>
                                <th>{{ __('Tipe Kontak') }}</th>
                                <th>{{ __('Perusahaan') }}</th>
                                <th>{{ __('Alamat') }}</th>
                                <th>{{ __('No Telepon / HP') }}</th>
                                <th>{{ __('Hutang') }}</th>\
                                <th>{{ __('Piutang') }}</th>
                                <th>{{ __('Tindakan') }}</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                         <tbody>
                         @php $no=1;@endphp
                            @foreach($daftar_kontaks as $index)
                            <tr>
                                <td class="col-lg-none">{{$no++}}</td>
                                <td>{{$index->nama_kontak ?? ''}}</td>
                                <td>{{$index->tipekontak->tipe_kontak ?? ''}}</td>
                                <td>{{$index->nama_perusahaan ?? ''}}</td>
                                <td>{{$index->alamat_perusahaan ?? ''}}</td>
                                <td>{{$index->no_telp ?? ''}} / {{$index->no_hp ?? ''}}</td>
                                <td></td>
                                <td></td>
                                <td  class="actions">
                                        <a href="{{ route('daftar_kontak.show',$index->id) }}" class="btn btn-primary fa fa-eye"></a>
                                        <a href="{{ route('daftar_kontak.edit',$index->id) }}" class="btn btn-success fa fa-pencil"></a>
                                        <button type="button" class="btn btn-danger fa fa-trash"  id="deletekontak" data-toggle="modal" data-id="{{$index->id}}" data-target="#exampleModal"></button>

                                    </form>
  </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $daftar_kontaks->links() }}
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $('body').on('click', '#deletekontak', function (event) {
            event.preventDefault();
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Apakah Anda Yakin Hapus Data Ini?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: `Ya`,
                cancelButtonText: "Tidak",
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: "{{url('/daftar_kontak')}}/" + id,
                        // url: $(this).data('route'),
                        data: {
                            _method: 'delete', _token: CSRF_TOKEN
                        },
                        // dataType: 'JSON',
                        success: function (results) {
                            // Swal.fire('Berhasil Terhapus!', '', 'success')
                            let timerInterval
                            Swal.fire({
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                    const b = Swal.getHtmlContainer().querySelector('b')
                                    timerInterval = setInterval(() => {
                                        b.textContent = Swal.getTimerLeft()
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            })
                            window.location.reload(true)
                            Swal.fire('Data Berhasil Terhapus', '', 'success')


                        }

                    })


                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })
        });

    </script>
@endpush
