@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">Teller</h3>
    <br>
{{--    <x-breadcrumb title="{{ __('Transaksi') }}">--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('transaksi_keuangan.index') }}">{{ __('Keuangan') }}</a>--}}
{{--        </li>--}}
{{--        <li class="breadcrumb-item">--}}
{{--            {{ __('Transaksi') }}--}}
{{--        </li>--}}
{{--    </x-breadcrumb>--}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                    <form method="get"style="width: 50%;" >
                        <div class="input-group">
                            <input type="text" name="search" class="form-control d-inline" id="search" placeholder="Pencarian Transaksi" value="{{ request()->query('search', '') }}">
{{--                            <button class="btn btn-white" type="submit">--}}
{{--                                <em class="fa fa-search"></em>--}}
{{--                            </button>--}}
                            &nbsp;
                            {{-- <select name="status_aktif" class="form-control">
                                <option value="" >Status</option>
                                <option value="1" >Aktif</option>
                                <option value="0" >Tidak Aktif</option>
                            </select> --}}

                        </div>
                    </form>
                    <div class="card-options">
                        <a style="background-color: blue" href="{{ route('transaksi_keuangan.create') }}">
                            <button class="btn btn-primary">Tambah Transaksi</button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0" id="tables">
                        <thead>
                            <tr>
                                <!-- <th class="d-lg-none">&nbsp;</th> -->
                                <!-- <th>#</th> -->
                                <th>{{ __('No') }}</th>
                                <th>{{ __('Tanggal') }}</th>
                                <th>{{ __('Jurnal') }}</th>
                                <th>{{ __('Deskripsi') }}</th>
                                <th class="text-right">{{ __('Nominal') }}</th>
                                <th>{{ __('Pengguna') }}</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                         <tbody>
                            @foreach ($ledgers as $i => $ledger)
                                <tr>
                                    <td>{{ $ledgers->firstItem() + $i }}</td>
                                    <td>{{ date('d/m/Y',  strtotime($ledger->date)) }}</td>
                                    <td>{{ $ledger->journal_number }}</td>
                                    <td>{{ $ledger->description }}</td>
{{--                                    <td class="text-right">{{ number_format(abs($ledger->entries->pluck('amount')->avg()), 2) }}</td>--}}
                                    <td class="text-right">{{ !empty($ledger->nominal) ? number_format($ledger->nominal) : '-' }}</td>
                                    <td>{{ $ledger->creator->name ?? null }}</td>
                                    <td class="actions">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ route('transaksi_keuangan.show', $ledger) }}" ><i class="fa fa-eye"></i>&nbsp;&nbsp; Lihat </a></li>
                                        </ul>
                                    </td>
                                    <!-- <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-dribbble dropdown-toggle btn-sm" data-toggle="dropdown" title="Aksi">
                                                Tindakan
                                            </button>
                                            <div class="dropdown-menu">
                                                <li> <a href="{{ route('transaksi_keuangan.show', $ledger) }}" class="dropdown-item fa fa-eye" style="color: #fff; background-color: blue; font-size: 12px">&nbsp;Lihat</a></li>
                                            </div>
                                        </div>
                                    </td> -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{$ledgers->links()}}
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
                searchPlaceholder: "Cari Transaksi",
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
