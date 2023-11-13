@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Rekening Pembiayaan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('rekening-pembiayaan.index') }}">{{ __('Rekening Pembiayaan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Lihat Rekening Pembiayaan') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Informasi Rekening Pembiayaan') }}</h5>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered border-top mb-0 ">
                                <tr>
                                    <th width="20%">status</th>
                                    <th>
                                        @if ($rekening->status == \App\Models\RekeningPembiayaan::STATUS_PENDING)
                                            <span class="badge badge-warning">{{ strtoupper($rekening->status) ?? '-' }}</span>
                                        @elseif ($rekening->status == \App\Models\RekeningPembiayaan::STATUS_APPROVED)
                                            <span class="badge badge-primary">{{ strtoupper($rekening->status) ?? '-' }}</span>
                                        @elseif ($rekening->status == \App\Models\RekeningPembiayaan::STATUS_ACTIVE)
                                            <span class="badge badge-success">{{ strtoupper($rekening->status) ?? '-' }}</span>
                                        @elseif ($rekening->status == \App\Models\RekeningPembiayaan::STATUS_REJECTED)
                                            <span class="badge badge-danger">{{ strtoupper($rekening->status) ?? '-' }}</span>
                                        @elseif ($rekening->status == \App\Models\RekeningPembiayaan::STATUS_AKAD)
                                            <span class="badge badge-pink">{{ strtoupper($rekening->status) ?? '-' }}</span>
                                        @endif
                                    </th>
                                    <th width="20%">Tingkat Kesehatan</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th>Tanggal Pengajuan</th>
                                    <th>{{ $rekening->created_at->format('d-m-Y') ?? '-' }}</th>
                                    <th>Tanggal Disetujui</th>
                                    <th>{{ $rekening->updated_at->format('d-m-Y') ?? '-' }}</th>
                                </tr>
                                <tr>
                                    <th>Tanggal Aktif</th>
                                    <th>{{ !empty($rekening->tanggal_aktif) ? $rekening->tanggal_aktif->format('d-m-Y') : '-' }}</th>
                                    <th>Tanggal Jatuh Tempo</th>
                                    <th>
{{--                                        tanggal_persetujuan + jangka waktu--}}
                                        {{ \Carbon\Carbon::parse($rekening->tanggal_persetujuan)->addMonths($rekening->jangka_waktu)->format('d/m/Y') ?? '-' }}
                                </tr>
                            </table>
                            <br>
                            <table class="table table-bordered border-top mb-0 ">
                                <tr>
                                    <th width="22%">Nama</th>
                                    <td>{{$rekening->anggota->nama_pemohon ?? ''}}</td>
                                    <th width="22%">No Mitra</th>
                                    <td>{{$rekening->anggota->no_mitra ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>Akad Produk</th>
                                    <td>{{$rekening->akads->nama_akad ?? ''}}</td>
                                    <th>Produk</th>
                                    <td>{{$rekening->produk->nama_pembiayaan ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>No. Rekening</th>
                                    <td>{{ $rekening->no_akun ?? '-'}}</td>
                                    <th>Jgk. Waktu</th>
                                    <td>{{ !empty($rekening->jangka_waktu) ? $rekening->jangka_waktu . ' Bulan' : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Tujuan Pengajuan</th>
                                    <td>{{$rekening->tujuan_pengajuans->nama_tujuan_pengajuan ?? ''}}</td>
                                    <th>Sumber Dana</th>
                                    <td>{{$rekening->sumber_danas->nama_sumber_dana ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>Akun Officer</th>
                                    <td colspan="3">{{ $rekening->akunOfficer->nama ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Rekening Autodebet</th>
                                    <td colspan="3">{{ $rekening->rekAutodebet->no_akun ?? '-' }} - {{ $rekening->rekAutodebet->produk->nama_simpanan ?? '-' }}</td>
                                </tr>
                            </table>
                            <br>

                            <table class="table table-bordered border-top mb-0 ">
                                <tr>
                                    <th width="22%">Amount Pengajuan</th>
                                    <td>{{ !empty($rekening->nilai_pengajuan) ? number_format($rekening->nilai_pengajuan) : '0.00' }}</td>
                                    <th width="22%">Uang Muka</th>
                                    <td>{{ !empty($rekening->uang_muka) ? number_format($rekening->uang_muka) : '0.00' }}</td>
                                </tr>
                                <tr>
                                    <th>Harga Pokok / Nilai Pembiayaan</th>
                                    <td>{{ !empty($rekening->harga_pokok) ? number_format($rekening->harga_pokok) : '0.00' }}</td>
                                    <th>Bagi Hasil / Margin</th>
                                    <td>{{ !empty($rekening->interest) ? number_format($rekening->interest) : '0.00' }}</td>
                                </tr>
                                <tr>
                                    <th>Total Pembiayaan</th>
                                    <td colspan="3">{{ !empty($rekening->nilai_pembiayaan) ? number_format($rekening->nilai_pembiayaan) : '0.00' }}</td>
                                </tr>
                            </table>
                            <br>
                            <br>
                            <table class="table table-bordered border-top mb-0 ">
                                <tr>
                                    <th>Sisa Pokok</th>
                                    <th>{{ !empty($rekening->saldo) ? number_format($rekening->saldo) : '0.00' }}</td>
                                    <th>Sisa Margin</th>
                                    <th>{{ !empty($rekening->sisa_margin) ? number_format($rekening->sisa_margin) : '0.00' }}</td>
                                    <th>Outstanding</th>
                                    <th>{{ !empty($rekening->outstanding) ? number_format($rekening->outstanding) : '0.00' }}</th>
                                </tr>
                            </table>
                            <br>
                            <br>
                            <!-- <table class="table table-bordered border-top mb-0 ">
                                <tr>
                                    <th width="22%">Biaya Admin</th>
                              <td>{{ number_format($rekening->biaya_admin, 2) }}</td>
                                    <th width="22%">Biaya Materai</th>
                                      <td>{{ number_format($rekening->biaya_materai, 2) ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>Biaya Asuransi</th>
                               <td>{{ number_format($rekening->biaya_asuransi, 2) }}</td>
                                    <th>Biaya Lain-lain</th>
                                    <td>0.00</td>
                                </tr>
                            </table> -->
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
                                <th>No. Struk</th>
                                <th width="20%">Keterangan</th>
                                <th class="text-right">Debet</th>
                                <th class="text-right">Kredit</th>
                                <th class="text-right">Margin / Basil</th>
                                <th class="text-right">Total Angs</th>
                                @if ($rekening->akads->jenis_akad == 'mudharabah' || $rekening->akads->jenis_akad == 'musyarakah' || $rekening->akads->jenis_akad == 'qard')
                                <!-- // Mudharbaah -->
                                <th class="text-right">Sisa Pokok</th>
                                @else
                                <!-- // Murabahah -->
                                <th class="text-right">Outstanding</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rekening->entries as $i => $entry)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $entry->ledger->date ?? '' }}</td>
                                <td>{{ !empty($entry->ledger->journal_number) ? $entry->ledger->journal_number : '-'}}</td>
                                <td>{{ $entry->ledger->description ?? '-'}}</td>
                                <td class="text-right">{{ $entry->debit ? number_format(abs($entry->amount)) : '0.00' }}</td>
                                <td class="text-right">{{ $entry->credit ? number_format(abs($entry->amount)) : '0.00' }}</td>
                                <td class="text-right">{{ number_format($entry->ledger->margin) }}</td>
                                <td class="text-right">{{ number_format($entry->ledger->nominal) }}</td>
                                <td class="text-right">{{ number_format($entry->current_balance) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card border-0">
                <div class="card-header">
                    <h3 class="card-title">Jadwal Angsuran</h3>
                </div>
                <div class="table-responsive">
                    <table
                        id="jadwalAngsuranTable"
                        class="table table-hover table-striped"
                        data-auto-responsive="true"
                        data-searching="false"
                        data-length-change="false"
                        data-paging="false"
                        data-info="false"
                        data-sort="false"
                        style="border-top: 1px solid #dbdfea"
                    >
                    </table>
                </div>
            </div>



        </div>
    </div>
@endsection
@push('scripts')

<script>
    // function showPreview(event){
    //     if(event.target.files.length > 0){
    //         var src = URL.createObjectURL(event.target.files[0]);
    //         var preview = document.getElementById("file-ip-1-preview");
    //         preview.src = src;
    //         preview.style.display = "block";
    //     }
    // }
    // function showPreview1(event){
    //     if(event.target.files.length > 0){
    //         var src = URL.createObjectURL(event.target.files[0]);
    //         var preview = document.getElementById("file-ip-1-preview1");
    //         preview.src = src;
    //         preview.style.display = "block";
    //     }
    // }

    $(document).ready(function () {
        $('#jadwalAngsuranTable').DataTable({
            data: {!! json_encode($rekening->jadwal) !!},
            columns: [
                { title: 'No.',                  data: 'no',             className: 'nk-tb-col' },
                { title: 'Tgl. Angsuran',     data: 'tanggalAngsuran',className: 'nk-tb-col' },
                { title: 'Angsuran Pokok',       data: 'angsuranPokok',  className: 'nk-tb-col text-right', render: $.fn.dataTable.render.number(",", ".", 2), },
                { title: 'Angsuran Margin/Hasil',data: 'angsuranMargin',  className: 'nk-tb-col text-right', render: $.fn.dataTable.render.number(",", ".", 2) },
                { title: 'Kewajiban Angsuran',   data: 'angsuranBulanan',  className: 'nk-tb-col text-right', render: $.fn.dataTable.render.number(",", ".", 2) },
                { title: 'Sisa Pokok',           data: 'sisaPokok',      className: 'nk-tb-col text-right', render: $.fn.dataTable.render.number(",", ".", 2) },
                { title: 'Sisa Margin',           data: 'sisaMargin',      className: 'nk-tb-col text-right', render: $.fn.dataTable.render.number(",", ".", 2) },
                { title: 'Outstanding',          data: 'oustanding',     className: 'nk-tb-col text-right', render: $.fn.dataTable.render.number(",", ".", 2) },
            ],
        });

    });

</script>

@endpush
