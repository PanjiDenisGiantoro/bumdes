@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Rekening Simpanan Berjangka') }}">
        <li class="breadcrumb-item">
            {{ __('Rekening Simpanan Berjangka') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">&nbsp;</h3>
                    <form method="get"  style="width: 50%;"  >
                            <input type="text" name="search" class="form-control w-75 d-inline" id="search" placeholder="Carian Simpanan Berjangka">
{{--                            <button class="btn btn-white br-0 w-10" type="submit">--}}
{{--                                            <em class="fa fa-search"></em>--}}
{{--                            </button>--}}
                        </form>
                    <div class="card-options">

                        <a class="btn btn-primary" href="{{ route('rekening.simjaka.create') }}">
                            Tambah Rekening Simjaka
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0" id="tables">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Tgl. Pengajuan') }}</th>
                                <th>{{ __('Nama Anggota') }}</th>
                                <th>{{ __('No. Rekening') }}</th>
                                <th>{{ __('Produk') }}</th>
                                <th>{{ __('Jk. Waktu') }}</th>
                                <th>{{ __('Tgl. Jth Tempo') }}</th>
                                <th>{{ __('Saldo') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($berjangka as $i => $rekening)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $rekening->created_at->format('d/m/Y') ?? '-' }}</td>
                                <td>{{ $rekening->anggota->nama_pemohon ?? '-' }}</td>
                                <td>{{ $rekening->no_akun ?? '-' }}</td>
                                <td>{{ $rekening->produk->nama_simpanan ?? '-' }}</td>
                                <!-- style align right -->
                                <!-- <td>{{ $rekening->tanggal_aktif ?? '-' }}</td> -->
                                <td>{{ $rekening->jangka_waktu ?? '-' }} Bulan</td>
{{--                                @if($rekening->status == \App\Models\RekeningPembiayaan::STATUS_ACTIVE)--}}
                                <td>{{ Carbon\Carbon::parse($rekening->tanggal_jatuh_tempo)->format('d/m/Y') ?? '-' }}</td>
{{--                                @else--}}
{{--                                    <td>-</td>--}}
{{--                                @endif--}}
                                <td style="text-align: right;">{{ number_format($rekening->saldo) ?? '0.00' }}</td>
                                {{-- <td>{{ $rekening->status ?? '-' }}</td> --}}
                                <td>
                                    @if ($rekening->status == \App\Models\RekeningPembiayaan::STATUS_PENDING)
                                    <span class="tag tag-yellow">{{ ucfirst($rekening->status) ?? '-' }}</span></td>
                                    @elseif ($rekening->status == \App\Models\RekeningPembiayaan::STATUS_APPROVED)
                                    <span class="tag tag-indigo">{{ ucfirst($rekening->status) ?? '-' }}</span></td>
                                    @elseif ($rekening->status == \App\Models\RekeningPembiayaan::STATUS_ACTIVE)
                                    <span class="tag tag-green">{{ ucfirst($rekening->status) ?? '-' }}</span></td>
                                    @else
                                    <span class="tag tag-red">{{ ucfirst($rekening->status) ?? '-' }}</span></td>
                                    @endif
                                <td class="actions">
                                    <!-- <div class="btn-group"> -->
                                     @if($rekening->status == 'baru')
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ route('rekening.simjaka.show', [$rekening->id]) }}" ><i class="fa fa-eye"></i>&nbsp;&nbsp; Lihat </a></li>
                                            {{-- <li class="divider"></li> --}}
                                            <li><a href="{{ route('rekening.simjaka.edit', [$rekening->id]) }}" ><i class="fa fa-pencil"></i>&nbsp;&nbsp; Edit</a></li>
                                            <li><a  href="{{ route('rekening.simjaka.approve', [$rekening->id]) }}" ><i class="fa fa-check-square-o"></i>&nbsp;&nbsp; Persetujuan</a></li>
                                        </ul>
                                    @else
                                        {{-- <a class="btn btn-outline-primary pl-5 pr-5" href="{{ route('rekening-simpanan.showTransaksi', $simpanan->id) }}">Lihat</a> --}}
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ route('rekening.simjaka.show', [$rekening->id]) }}"><i class="fa fa-eye"></i>&nbsp;&nbsp; Lihat </a></li>
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
        });
        $('#search').keyup(function() {
            tables.search($(this).val()).draw(); // this  is for customized searchbox with datatable search feature.
        })
    </script>
    @endpush
