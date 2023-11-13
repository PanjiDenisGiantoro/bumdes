@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Rekening Simpanan') }}">
        <li class="breadcrumb-item">
            {{ __('Rekening Simpanan') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">&nbsp;</h3>
                    <form method="get" style="width: 50%;" >
                            <div class="input-group" >
                                <input type="text" name="search" class="form-control d-inline" id="search" placeholder="Cari No. Rekening" >
{{--                                <button class="btn btn-white" type="submit">--}}
{{--                                    <em class="fa fa-search"></em>--}}
{{--                                </button>--}}
                                &nbsp;
                                {{-- <select name="status_aktif" class="form-control">
                                    <option value="" >Status</option>
                                    <option value="1" >Aktif</option>
                                    <option value="0" >Tidak Aktif</option>
                                </select> --}}

                            </div>
                        </form>
                    <div class="card-options">

                        <a class="btn btn-primary" href="{{ route('rekening-simpanan.create') }}">
                          Tambah Rekening Simpanan
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0" id="tables">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Tgl Daftar') }}</th>
                                <th>{{ __('Anggota') }}</th>
                                <th>{{ __('No. Rekening') }}</th>
                                <th>{{ __('Produk') }}</th>
                                <th >{{ __('Saldo') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Tindakan') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($simpananList as $i => $simpanan)
                            <tr>
                                <td>{{ $simpananList->firstItem() + $i }}</td>
                                <td>
                                    {{ date('d/m/Y', strtotime($simpanan->created_at)) }}
                                </td>
                                <td>{{ $simpanan->anggota->nama_pemohon ?? '' }}</td>
                                <td>

                            @if($simpanan->status == \App\Models\RekeningPembiayaan::STATUS_PENDING  )
                            {{ '-' }}

                            @elseif ($simpanan->status == \App\Models\RekeningPembiayaan::STATUS_REJECTED )

                            {{ '-' }}

                            @else
                            {{ $simpanan->no_akun ?? '-' }}

                            @endif

                            </td>
                                <td>{{ $simpanan->produk->nama_simpanan ?? '-' }}</td>
                                {{-- <td>{{ $simpanan->akads->nama_akad ?? '-' }}</td> --}}
                                <td style="text-align: right;">{{ number_format($simpanan->balance()) ?? '0.00' }}</td>
                                {{-- <td>{{ $simpanan->status ?? '' }}</td> --}}
                                <td >
                                    @if ($simpanan->status == \App\Models\RekeningPembiayaan::STATUS_PENDING)
                                    <span class="tag tag-yellow">{{ ucfirst($simpanan->status) ?? '-' }}</span>
                                    @elseif ($simpanan->status == \App\Models\RekeningPembiayaan::STATUS_APPROVED)
                                    <span class="tag tag-indigo">{{ ucfirst($simpanan->status) ?? '-' }}</span>
                                    @elseif ($simpanan->status == \App\Models\RekeningPembiayaan::STATUS_ACTIVE)
                                    <span class="tag tag-green">{{ ucfirst($simpanan->status) ?? '-' }}</span>
                                    @else
                                    <span class="tag tag-red">{{ ucfirst($simpanan->status) ?? '-' }}</span>
                                    @endif
                                </td>

                                <td class="actions">
                                    <!-- <div class="btn-group"> -->
                                    @if($simpanan->status == 'baru')
                                        <button type="button" class="btn btn-outline-primary  dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">

                                            <li><a href="{{ route('rekening-simpanan.showTransaksi', $simpanan->id) }}" ><i class="fa fa-eye"></i>&nbsp;&nbsp; Lihat </a></li>
                                            {{-- <li class="divider"></li> --}}
                                            <li><a href="{{ route('rekening-simpanan.edit', $simpanan->id) }}" ><i class="fa fa-pencil"></i>&nbsp;&nbsp; Edit</a></li>
                                            <li><a  href="{{  route('rekening-simpanan.approve', $simpanan->id) }}" ><i class="fa fa-check-square-o"></i>&nbsp;&nbsp; Persetujuan</a></li>
                                        </ul>
                                    @else
                                        {{-- <a class="btn btn-primary pl-5 pr-5" href="{{ route('rekening-simpanan.showTransaksi', $simpanan->id) }}">Lihat</a> --}}
                                        <button type="button" class="btn btn-outline-primary  dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ route('rekening-simpanan.showTransaksi', $simpanan->id) }}"><i class="fa fa-eye"></i>&nbsp;&nbsp; Lihat </a></li>
                                        </ul>
                                    @endif
                                    <!-- </div> -->
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                {{$simpananList->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
      tables =  $('#tables').DataTable({
          //color blue table

          "dom": "lrtip" ,//to hide default searchbox but search feature is not disabled hence customised searchbox can be made.
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            //showing false
            "lengthChange": false,
            "filter": false,
            "ordering": false,
            "info": false,
            "searching": true,

            responsive: true,
            pagging: false,
            paginate : false,
            language: {
                searchPlaceholder: "Cari No.Rekening",
                "lengthMenu": "Menampilkan _MENU_ data",
                "zeroRecords": "Tidak ada data",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                "infoFiltered": "(disaring dari _MAX_ data keseluruhan)",
                "search": "",
                "processing": "Sedang memproses...",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
            //     search: "_INPUT_",
            //     searchPlaceholder: "Cari No. Rekening",
            //
            // }

        });
        $('#search').keyup(function() {
            tables.search($(this).val()).draw(); // this  is for customized searchbox with datatable search feature.
        })
    </script>
@endpush
