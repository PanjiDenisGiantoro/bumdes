@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Rekening Pembiayaan') }}">
        <li class="breadcrumb-item">
            {{ __('Rekening Pembiayaan') }}
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
                        <input type="text" name="search" class="form-control w-75 d-inline" id="search" placeholder="Carian Pembiayaan">
{{--                        <button class="btn btn-white " type="submit">--}}
{{--                            <em class="fa fa-search"></em>--}}
{{--                        </button>--}}
                    </form>

                    <div class="card-options">
                        <a class="btn btn-primary" href="{{ route('rekening-pembiayaan.create') }}">
                          Tambah Rekening Pembiayaan
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0" id="tables">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>

                                <th>{{ __('Tgl. Pengajuan') }}</th>
                                <th>{{ __('Nama Anggota') }}</th>
                                <th >{{ __('No. Rekening') }}</th>
                                <th>{{ __('Produk') }}</th>
                                <th>{{ __('Nilai Pembiayaan') }}</th>
                                <th>{{ __('Jkt. Waktu') }}</th>
{{--                                <th>{{ __('Tgl. Akad') }}</th>--}}
                                <th>{{ __('Tgl.Jth Tempo') }}</th>
                                <th>{{ __('Outstanding') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>&nbsp;</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rekening as $i => $rek)
                            <tr>
                                <td>{{ $i +1 }}</td>
                                <td>{{\Carbon\Carbon::parse($rek->created_at)->format('d/m/Y') ?? ''}}</td>
                                <td>{{ $rek->anggota->nama_pemohon ?? '-' }}</td>
                                <td>
                                    @if($rek->status == \App\Models\RekeningPembiayaan::STATUS_AKAD)

                                    {{ $rek->no_akun ?? '-' }}

                                    @else
                                        -
                                    @endif
                                </td>

                                <td>{{ $rek->produk->nama_pembiayaan ?? '-' }}</td>
                                <!-- <td>{{ !empty($rek->nilai_pengajuan) ? number_format($rek->nilai_pengajuan, 2) : '0.00' }}</td> -->
                                <td class="text-right">{{ !empty($rek->harga_pokok) ? number_format($rek->harga_pokok) : '0.00' }}</td>
                                <td>{{ $rek->jangka_waktu ?? '-' }} Bulan</td>
                                <td>
                                    @if($rek->status == \App\Models\RekeningPembiayaan::STATUS_AKAD)

                                        {{ \Carbon\Carbon::parse($rek->tanggal_persetujuan)->format('d/m/Y') ?? '-' }}

                                    @else
                                        -
                                    @endif
{{--                                <td>--}}
{{--                                    tanggal_persetujuan + jangka waktu--}}
{{--                                    @if($rek->status == \App\Models\RekeningPembiayaan::STATUS_AKAD)--}}

{{--                                        {{ \Carbon\Carbon::parse($rek->tanggal_persetujuan)->addMonths($rek->jangka_waktu)->format('d/m/Y') ?? '-' }}--}}

{{--                                    @else--}}
{{--                                        ---}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                                <td>{{ \Carbon\Carbon::parse($rek->tgl_tempo)->format('d/m/Y') ?? '-' }}</td>--}}
                                <td class="text-right">0.00</td>
                                <td>
                                    @if ($rek->status == \App\Models\RekeningPembiayaan::STATUS_PENDING)
                                    <span class="tag tag-yellow">{{ ucfirst($rek->status) ?? '-' }}</span></td>
                                    @elseif ($rek->status == \App\Models\RekeningPembiayaan::STATUS_APPROVED)
                                    <span class="tag tag-indigo">{{ ucfirst($rek->status) ?? '-' }}</span></td>
                                    @elseif ($rek->status == \App\Models\RekeningPembiayaan::STATUS_ACTIVE)
                                    <span class="tag tag-green">{{ ucfirst($rek->status) ?? '-' }}</span></td>
                                    @elseif ($rek->status == \App\Models\RekeningPembiayaan::STATUS_AKAD)
                                    <span class="tag tag-pink">{{ ucfirst($rek->status) ?? '-' }}</span></td>
                                    @else
                                    <span class="tag tag-red">{{ ucfirst($rek->status) ?? '-' }}</span></td>
                                    @endif
                                <td class="actions">

                                    @if($rek->status == 'baru')
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">

                                            <li><a href="{{ route('rekening-pembiayaan.show', [$rek->id]) }}" ><i class="fa fa-eye"></i>&nbsp;&nbsp; Lihat </a></li>
                                            {{-- <li class="divider"></li> --}}
                                            <li><a href="{{ route('rekening-pembiayaan.edit', [$rek->id]) }}" ><i class="fa fa-pencil"></i>&nbsp;&nbsp; Edit</a></li>
                                            <li><a  href="{{  route('rekening-pembiayaan.approve', [$rek->id]) }}" ><i class="fa fa-check-square-o"></i>&nbsp;&nbsp; Persetujuan</a></li>
                                        </ul>
                                    @elseif($rek->status == 'disetujui')
                                        {{-- <a class="btn btn-outline-primary pl-5 pr-5" href="{{ route('rekening-simpanan.showTransaksi', $simpanan->id) }}">Lihat</a> --}}
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ route('rekening-pembiayaan.show', [$rek->id]) }}"><i class="fa fa-eye"></i>&nbsp;&nbsp; Lihat </a></li>
                                            <li><a href="{{ route('rekening-pembiayaan.edit_persetujuan', [$rek->id]) }}"><i class="fa fa-eye"></i>&nbsp;&nbsp; Cetak Ol </a></li>
                                        </ul>
                                        @elseif($rek->status == 'aktif')

                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ route('rekening-pembiayaan.show', [$rek->id]) }}"><i class="fa fa-eye"></i>&nbsp;&nbsp; Lihat </a></li>
                                        </ul>

                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
{{--                {{$simpananList->links()}}--}}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
{{--   id=  tables datatable--}}
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
