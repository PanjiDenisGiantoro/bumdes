@extends('layouts.app')

@section('breadcrumb')
<x-breadcrumb title="{{ __('Detail Keanggotaan') }}">
    <li class="breadcrumb-item">
        <a href="{{ route('semua_laporan.index') }}">{{ __('Laporan') }}</a>
    </li>
    <li class="breadcrumb-item">
        {{ __('Detail Keanggotaan') }}
    </li>
</x-breadcrumb>
@endsection

@section('content')


<div class="container">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="components-preview wide-md mx-auto">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-head-sub">
                        <span>Laporan Anggota</span>
                    </div>
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Produk</h3>
                        </div>
                    </div>
                </div>
                <form>

                    <input type="hidden" id="selectedAnggotaValue" name="id">
                    <!-- <input type="hidden" id="anggotaSavingAccount" name="q"> -->
                    <!-- <input type="hidden" id="anggotaId" name="anggotaId"> -->

                    <div class="card card-preview">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-tools">
                                    <div class="form-inline flex-nowrap p-4">
                                        <div class="form-group col-md-6">
                                            <select id="nama_anggota" class="form-control select2" style="width: 50px;" data-search="on" data-placeholder="Pilih Anggota" data-select2-id="1" tabindex="-1">
                                                <option value="" data-select2-id="1">Pilih Anggota</option>
                                                @foreach ($namaAnggota as $k)
                                                <!-- <option value="{{ $k->nama_pemohon }}"{{ request()->query('nama') == $k->nama_pemohon ? ' selected="selected"' : '' }}>{{ $k->nama_penuh }} --- {{ $k->no_anggota }}</option> -->
                                                <option value="{{ $k->id }}" {{ request()->query('id') == $k->id ? ' selected="selected"' : '' }}>{{ $k->nama_pemohon }} --- {{ $k->no_mitra }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button id="searchNama_btn" class="btn btn-info">Cari</button>
                                        </div>
                                        {{-- <div class="btn-wrap"> --}}
                                        {{-- </div> --}}
                                        {{-- @if (request()->query('id'))
                                        <div class="btn-group">
                                            <a href="{{ route('laporan.produk.index', array_merge(request()->query(), [$id, 'export' => 'pdf'])) }}" class="btn btn-icon btn-outline-primary" target="_blank">
                                        <em class="icon ni ni-printer"></em>
                                        </a>
                                        <a href="{{ route('laporan.produk.index', array_merge(request()->query(),  [$id, 'export' => 'xlsx'])) }}" class="btn btn-icon btn-outline-primary" target="_blank">
                                            <em class="icon ni ni-file-xls"></em>
                                        </a>
                                    </div>
                                    @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($dataAnggota)
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered border-top mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Anggota</th>
                                        <th>No Anggota</th>
                                        <th>NIK</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $dataAnggota->nama_pemohon }}</td>
                                        <td>{{ $dataAnggota->no_mitra }}</td>
                                        <td>{{ $dataAnggota->nik }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

					
                    @endif
            </div>
            
            @if($rekeningSimpanan)
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Rekening Simpanan</div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered border-top mb-0" style="border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No Rekening</th>
                                    <th>TGL Buka</th>
                                    <th>Produk</th>
                                    <th>Saldo</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach($rekeningSimpanan as $index => $data)
                                <tr style="border-bottom: 1pt solid white;">
                                    <td class="pb-1">{{ $index + 1 }}</td>
                                    <td class="pb-1">{{ $data->no_akun ?? '' }}</td>
                                    <td class="pb-1">{{ date('d/m/Y', strtotime($data->created_at)) }}</td>
                                    <td class="pb-1">{{ $data->produk->nama_simpanan ?? '-' }}</td>
                                    <td class="pb-1">{{ number_format($data->balance()) ?? '0.00' }}</td>
                                    <td >
                                         @if ($data->status == \App\Models\RekeningPembiayaan::STATUS_PENDING)
                                        <span class="tag tag-yellow">{{ ucfirst($data->status) ?? '-' }}</span>
                                        @elseif ($data->status == \App\Models\RekeningPembiayaan::STATUS_APPROVED)
                                        <span class="tag tag-indigo">{{ ucfirst($data->status) ?? '-' }}</span>
                                        @elseif ($data->status == \App\Models\RekeningPembiayaan::STATUS_ACTIVE)
                                        <span class="tag tag-green">{{ ucfirst($data->status) ?? '-' }}</span>
                                        @else
                                        <span class="tag tag-red">{{ ucfirst($data->status) ?? '-' }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            @endif

            @if($rekeningBerjangka)
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Rekening Simpanan Berjangka</div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered border-top mb-0" style="border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No Bilyet/Rekening</th>
                                    <th>Produk</th>
                                    <th>JK Waktu</th>
                                    <th>TGL Jatuh Tempo</th>
                                    <th>Saldo</th>
                                    <th>Status Deposito</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($rekeningBerjangka as $index => $data)
                                <tr style="border-bottom: 1pt solid white;">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $date->no_akun ?? '-' }}</td>
                                    <td>{{ $date->produk->nama_simpanan ?? '-' }}</td>
                                    <td>{{ $rekening->jangka_waktu ?? '-' }} Bulan</td>
                                    <td>{{ Carbon\Carbon::parse($data->tanggal_jatuh_tempo)->format('d/m/Y') ?? '-'  }}</td>
                                    <td>{{ number_format($data->saldo) ?? '0.00' }}</td>
                                    <td>
                                         @if ($data->status == \App\Models\RekeningPembiayaan::STATUS_PENDING)
                                        <span class="tag tag-yellow">{{ ucfirst($data->status) ?? '-' }}</span></td>
                                        @elseif ($data->status == \App\Models\RekeningPembiayaan::STATUS_APPROVED)
                                        <span class="tag tag-indigo">{{ ucfirst($data->status) ?? '-' }}</span></td>
                                        @elseif ($data->status == \App\Models\RekeningPembiayaan::STATUS_ACTIVE)
                                        <span class="tag tag-green">{{ ucfirst($data->status) ?? '-' }}</span></td>
                                        @else
                                        <span class="tag tag-red">{{ ucfirst($data->status) ?? '-' }}</span></td>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            @endif

            @if($rekeningPembiayaan)
              <div class="card">
                <div class="card-header">
                    <div class="card-title">Rekening Pembiayaan</div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered border-top mb-0" style="border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No Rekening</th>
                                    <th>Produk</th>
                                    <th>TGL Akad</th>
                                    <th>TGL Jatuh Tempo</th>
                                    <th>Jangka Waktu</th>
                                    <th>Nominal Pembayaran</th>
									<th>Outstanding</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($rekeningPembiayaan as $index => $data)
                                <tr style="border-bottom: 1pt solid white;">
                                    <td class="nk-tb-col pb-1">{{ $index + 1 }}</td>
                                    <td class="nk-tb-col pb-1">{{ $data->no_akun ?? '-' }}</td>
                                    <td class="nk-tb-col pb-1">{{ $date->produk->nama_pembiayaan ?? '-' }}</td>
                                    <td>61</td>
                                    <td>{{ \Carbon\Carbon::parse($data->tanggal_persetujuan)->addMonths($data->jangka_waktu)->format('d/m/Y') ?? '-' }}</td>
                                    <td>{{ $data->jangka_waktu ?? '-' }}</td>
                                    <td>{{ !empty($data->harga_pokok) ? number_format($data->harga_pokok) : '0.00' }}</td>
									<td>0.00</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            @endif
            </form>
        </div>
    </div>
</div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/jquery.dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}"> --}}
@endpush


@push('scripts')
<script src="{{ asset('assets/plugins/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatable.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
{{-- <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/select2.js') }}"></script> --}}
<script>
    $('select').select2();
</script>
<script>

    $(document).ready(function() {

        $('#searchNama_btn').on('click', function() {

            let selectedAnggota = $('#nama_anggota').val();

            $('#selectedAnggotaValue').val(selectedAnggota);
            $('#anggotaSavingAccount').val(selectedAnggota);
            $('#anggotaId').val()

            console.log("selected kategori : " + selectedAnggota);

        });

    });

</script>
@endpush
