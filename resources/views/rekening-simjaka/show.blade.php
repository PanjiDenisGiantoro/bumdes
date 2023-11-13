@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Rekening Simpanan Berjangka') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('rekening.simjaka.index') }}">{{ __('Rekening Simpanan Berjangka') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Lihat') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Informasi Rekening Simpanan Berjangka') }}</h5>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered border-top mb-0 ">
                                <tr>
                                    <th width="20%">status</th>
                                    <th colspan="3">
                                    @if ($rekening->status == \App\Models\RekeningPembiayaan::STATUS_PENDING)
                                    <span class="tag tag-yellow">{{ ucfirst($rekening->status) ?? '-' }}</span></td>
                                    @elseif ($rekening->status == \App\Models\RekeningPembiayaan::STATUS_APPROVED)
                                    <span class="tag tag-indigo">{{ ucfirst($rekening->status) ?? '-' }}</span></td>
                                    @elseif ($rekening->status == \App\Models\RekeningPembiayaan::STATUS_ACTIVE)
                                    <span class="tag tag-green">{{ ucfirst($rekening->status) ?? '-' }}</span></td>
                                    @else
                                    <span class="tag tag-red">{{ ucfirst($rekening->status) ?? '-' }}</span></td>
                                    @endif
                                    </th>
                                </tr>
                                <tr>
                                    <th>Tanggal Pengajuan</th>
                                    <th width="32%">{{ $rekening->created_at->format('d/m/Y') ?? '-' }}</th>
                                    <th width="20%">Tanggal Disetujui</th>
                                    <th>{{ Carbon\Carbon::parse($rekening->moderated_at)->format('d/m/Y') ?? '-' }}</th>
                                </tr>
                                <tr>
                                    <th>Tanggal Aktif</th>
                                    <th>
                                        @if ($rekening->status == \App\Models\RekeningPembiayaan::STATUS_ACTIVE)
                                        {{ $rekening->tanggal_aktif->format('d/m/Y') ?? '' }}
                                    @endif
                                    </th>
                                    <th>Tanggal Jatuh Tempo</th>
                                    <th>
                                        @if ($rekening->status == \App\Models\RekeningPembiayaan::STATUS_ACTIVE)

                                        {{ Carbon\Carbon::parse($rekening->tanggal_jatuh_tempo)->format('d/m/Y') ?? '-' }}
                                    @endif
                                    </th>
                                </tr>
                            </table>
                            <br>
                            <table class="table table-bordered border-top mb-0 ">
                                <tr>
                                    <th width="20%">Nama</th>
                                    <td>{{ $rekening->anggota->nama_pemohon ?? '-' }}</td>
                                    <th width="20%">No Anggota</th>
                                    <td>{{$rekening->anggota->no_mitra ?? '-'}}</td>
                                </tr>
                                <tr>
                                    <th>Produk</th>
                                    <td>{{$rekening->produk->nama_simpanan ?? '-'}}</td>
                                    <th>Akad Produk</th>
                                    <td>{{$rekening->akads->nama_akad ?? '-'}}</td>
                                </tr>
                                <tr>
                                    <th>No. Rekening</th>
                                    <td>{{ $rekening->no_akun ?? '-'}}</td>
                                    <th>Jangka Waktu</th>
                                    <td>{{ !empty($rekening->jangka_waktu) ? $rekening->jangka_waktu : '-' }} Bulan</td>
                                </tr>
                                <tr>
                                    <th>Tujuan Pengajuan</th>
                                    <td>{{$rekening->tujuan_pengajuans->nama_tujuan_pengajuan ?? '-'}}</td>
                                    <th>Sumber Dana</th>
                                    <td>{{$rekening->sumber_danas->nama_sumber_dana ?? '-'}}</td>
                                </tr>
                                <tr>
                                    <th>Akun Officer</th>
                                    <td>{{ $rekening->akunOfficer->nama ?? '-' }}</td>
                                    <th>Nominal Pengajuan</th>
                                    <td>Rp {{ !empty($rekening->nilai_setoran) ? number_format($rekening->nilai_setoran) : '0.00'}}</td>
                                </tr>
                            </table>
                            
                            <br>
                            <table class="table table-bordered border-top mb-0 ">
                                <tr>
                                    <th>ARO</th>
                                    <td>{{ $rekening->aro_text }}</td>
                                    <th>Rek. Transfer Basil</th>
                                    <td>{{ $rekening->rekening_basil->no_akun ?? '' }} - {{ $rekening->rekening_basil->produk->nama_simpanan ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th width="20%">Nisbah Anggota</th>
                                    <td width="32%">{{ $rekening->nisbah_hasil_1 ?? '0'}} %</td>
                                    <th width="20%">Nisbah Koperasi</th>
                                    <td>{{ $rekening->nisbah_hasil_2 ?? '0' }} %</td>
                                </tr>
                            </table>


                            <br>
                            <table class="table table-bordered border-top mb-0 ">
                                <tr>
                                    <th width="20%">Saldo</th>
                                    <th colspan="3">Rp {{ !empty($rekening->saldo) ? number_format($rekening->saldo) : '0.00' }}</th>
                                </tr>
                            </table>
                            <br>
                            <a href="{{ route('rekening.simjaka.index') }}" class="btn btn-outline-danger">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card border-0">
                <div class="card-header">
                    <h3 class="card-title">Daftar Rincian</h3>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead >
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>No. Jurnal</th>
                                <th width="20%">Keterangan</th>
                                <th>Debet</th>
                                <th>Kredit</th>
                                <th>Saldo</th>
                                <!-- <th>Cetak</th> -->
                                <!-- <th>Oustanding</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total_debit = 0;
                                $total_kredit = 0;
                            @endphp
                            @foreach($rekening->entries as $i => $rek)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $rek->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $rek->ledger->journal_number ?? '-' }}</td>
                                    <td>{{ $rek->reason ?? '-' }}</td>
                                    <td class="text-right">{{ $rek->debit ? number_format(abs($rek->amount)) : '0.00' }}</td>
                                    <td class="text-right">{{ $rek->credit ? number_format(abs($rek->amount)) : '0.00' }}</td>
                                    <td class="text-right">{{ !empty($rek->current_balance) ? number_format($rek->current_balance) : '0.00' }}</td>
                                </tr>
                                @php
                                    $total_debit += $rek->debit ? abs($rek->amount) : 0;
                                    $total_kredit += $rek->credit ? abs($rek->amount) : 0;
                                @endphp
                            @endforeach
                            
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th>TOTAL</th>
                                <th class="text-right">{{ number_format($total_debit) }}</th>
                                <th class="text-right">{{ number_format($total_kredit) }}</th>
                                <td></td>
                                <!-- <td>{{ 
                                        number_format(
                                            $rekening->entries
                                            ->reduce(function ($carry, $entry) {
                                                if ($entry->credit) {
                                                    return $carry + $entry->amount;
                                                }
                                            })
                                        )
                                    }}
                                </td> -->
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

<script>

</script>

@endpush
