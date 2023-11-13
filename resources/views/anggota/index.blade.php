@extends('layouts.app')
@section('breadcrumb')
    <h3 class="card-header">Daftar Anggota</h3>
    <br>
    {{--    <x-breadcrumb title="{{ __('Daftar Anggota') }}">--}}
    {{--        <li class="breadcrumb-item">--}}
    {{--            {{ __('Daftar Anggota') }}--}}
    {{--        </li>--}}
    {{--    </x-breadcrumb>--}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">&nbsp;</h3>

                    <form method="get"  style="width: 50%;"  >
                        <input type="text" name="search" class="form-control w-75 d-inline" id="search" placeholder="Carian Anggota">
                        {{--                            <button class="btn btn-white br-0 w-10" type="submit">--}}
                        {{--                                            <em class="fa fa-search"></em>--}}
                        {{--                            </button>--}}
                    </form>
                    <div class="card-options">

                        <a style="background-color: blue" href="{{ route('anggota.create') }}">
                            <button class="btn btn-primary">Daftar Anggota</button>
                        </a>

                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0 " id="tables">
                        <thead>
                        <tr>
                            <th>#</th>
                        <!-- <th>{{ __('No') }}</th> -->
                            <th>{{ __('Tgl. Register') }}</th>
                            <th>{{ __('No Anggota') }}</th>
                            <th>{{ __('Nama Anggota') }}</th>
                            <th>{{ __('NIK') }}</th>
                            <th>{{ __('Kategori') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Tindakan') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($Listanggota as $i => $anggotas)
                                <td class="col-lg-none">{{ $Listanggota->firstItem() + $i }}</td>
                                <td>{{\Carbon\Carbon::parse($anggotas->created_at)->format('d/m/Y') ?? ''}}</td>
                                <td>{{$anggotas->no_mitra ?? ''}}</td>
                                <td class="leading-tight">{{$anggotas->nama_pemohon ?? ''}}</td>
                                <td>{{$anggotas->nik ?? ''}}</td>
                                <td>{{$anggotas->status_keanggotaans->status_keanggotaan ?? ''}}</td>
                                @if ($anggotas->status_aktif == '1')
                                    <td>
                                        <span class="tag tag-green"> {{$anggotas->status_aktif_text ?? ''}}</span></td>

                                @elseif($anggotas->status_aktif == '0')
                                    <td>
                                        <span class="tag tag-red"> {{$anggotas->status_aktif_text ?? ''}}</span></td>

                                @elseif($anggotas->status_aktif == '2')
                                    <td>
                                        <span class="tag tag-teal"> {{$anggotas->status_aktif_text ?? ''}}</span></td>
                                @else
                                    <td>
                                        <span class="tag tag-yellow"> {{$anggotas->status_aktif_text ?? ''}}</span></td>
                                @endif
                                @if($anggotas->status_aktif == '1')
                                    <td class="actions">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                                data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ route('anggota.show',$anggotas->id) }}"><i
                                                        class="fa fa-eye"></i>&nbsp;&nbsp; Lihat</a></li>
                                            {{-- <li class="divider"></li> --}}
                                            <li><a href="{{ route('anggota.edit',$anggotas->id) }}"><i
                                                        class="fa fa-pencil"></i>&nbsp;&nbsp; Edit</a></li>
                                            <li>
                                                <a href="{{ route('anggota.show', array_merge(request()->query(), [$anggotas->id, $anggotas->nama_pemohon, 'export' => 'pdf'])) }}"
                                                   target="_blank"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;
                                                    Cetak</a></li>
                                            <li>
                                                <a href="{{ route('anggota.cetak',$anggotas->id) }}"
                                                   target="_blank"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;
                                                    Cetak Kartu</a></li>
                                            <li>
                                                <a href="{{ route('anggota.berhenti',$anggotas->id) }}"
                                                   ><i class="fa fa-eject"></i>&nbsp;&nbsp;
                                                    Berhenti</a></li>
                                        </ul>
                                    </td>
                                @elseif($anggotas->status_aktif == '0')
                                    <td class="actions">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                                data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            {{--                                                <li><a href="{{ route('anggota.approve',$anggotas->id) }}" ><i class="fa fa-check"></i>&nbsp;&nbsp; Persetujuan</a></li>--}}
                                            <li><a href="{{ route('anggota.show',$anggotas->id) }}"><i
                                                        class="fa fa-eye"></i>&nbsp;&nbsp; Lihat</a></li>
                                            {{-- <li class="divider"></li> --}}
{{--                                            <li><a href="{{ route('anggota.edit',$anggotas->id) }}"><i--}}
{{--                                                        class="fa fa-pencil"></i>&nbsp;&nbsp; Edit</a></li>--}}
{{--                                            <li>--}}
{{--                                                <a href="{{ route('anggota.show', array_merge(request()->query(), [$anggotas->id, $anggotas->nama_pemohon, 'export' => 'pdf'])) }}"--}}
{{--                                                   target="_blank"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;--}}
{{--                                                    Cetak</a></li>--}}
{{--                                            <li>--}}
{{--                                                <a href="{{ route('anggota.cetak',$anggotas->id) }}"--}}
{{--                                                   target="_blank"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;--}}
{{--                                                    Cetak Kartu</a></li>--}}
                                        </ul>
                                    </td>
                                @elseif($anggotas->status_aktif == '2')
                                    <td class="actions">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                                data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            {{--                                                <li><a href="{{ route('anggota.approve',$anggotas->id) }}" ><i class="fa fa-check"></i>&nbsp;&nbsp; Persetujuan</a></li>--}}
                                            <li><a href="{{ route('anggota.show',$anggotas->id) }}"><i
                                                        class="fa fa-eye"></i>&nbsp;&nbsp; Lihat</a></li>
                                            {{-- <li class="divider"></li> --}}

                                            {{--                                            <li>--}}
                                            {{--                                                <a href="{{ route('anggota.cetak',$anggotas->id) }}"--}}
                                            {{--                                                   target="_blank"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;--}}
                                            {{--                                                    Cetak Kartu</a></li>--}}
                                        </ul>
                                    </td>
                                @else
                                    <td class="actions">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                                data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ route('anggota.approve',$anggotas->id) }}"><i
                                                        class="fa fa-check"></i>&nbsp;&nbsp; Persetujuan</a></li>
                                            <li><a href="{{ route('anggota.show',$anggotas->id) }}"><i
                                                        class="fa fa-eye"></i>&nbsp;&nbsp; Lihat</a></li>
                                            {{-- <li class="divider"></li> --}}
                                            <li><a href="{{ route('anggota.edit',$anggotas->id) }}"><i
                                                        class="fa fa-pencil"></i>&nbsp;&nbsp; Edit</a></li>
                                            <li>
                                                <a href="{{ route('anggota.show', array_merge(request()->query(), [$anggotas->id, $anggotas->nama_pemohon, 'export' => 'pdf'])) }}"
                                                   target="_blank"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;
                                                    Cetak</a></li>

                                        </ul>
                                    </td>
                                @endif
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $Listanggota->links() }}
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
                searchPlaceholder: "Cari Anggota",
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
        });
        $('#search').keyup(function() {
            tables.search($(this).val()).draw(); // this  is for customized searchbox with datatable search feature.
        })
    </script>
    <script>
        $(document).ready(function () {

            $('.delete-form').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: $(this).data('route'),
                    data: {
                        '_method': 'delete'
                    },
                    success: function (response, textStatus, xhr) {
                        window.location = '/anggota'
                    }
                });
            })
        });
    </script>
@endpush

