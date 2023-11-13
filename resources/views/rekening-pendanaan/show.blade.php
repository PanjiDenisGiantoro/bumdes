@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Rekening Pendanaan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('rekening-pendanaan.index') }}">{{ __('Rekening Pendanaan') }}</a>
        </li>
        <li class="breadcrumb-item">
                {{ __('Lihat Rekening Pendanaan') }}

        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Informasi Rekening Pendanaan') }}</h5>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered border-top mb-0 ">
                                <tr>
                                    <th width="20%">Nama</th>
                                    <td>{{ $rekening->anggota->nama_pemohon ?? '' }}</td>
                                    <th width="20%">No Mitra</th>
                                    <td>{{ $rekening->anggota->no_mitra ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>No. Rekening</th>
                                    <td>{{ $rekening->no_akun ?? '-'}}</td>
                                    <th>Jgk. Waktu</th>
                                    <td>{{ !empty($rekening->jangka_waktu) ? $rekening->jangka_waktu . ' Bulan' : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Sumber Dana</th>
                                    <td>{{ $rekening->pendanaan->pendana->nama_pendana ?? '-' }}</td>
                                    <th>Produk</th>
                                    <td>{{ $rekening->pendanaan->nama_pembiayaan ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>GL Rekening</th>
                                    <td colspan="3">{{ !empty($rekening->pendanaan->coa_pembiayaan) ? $rekening->pendanaan->coa_pembiayaan->kode .' - '. $rekening->pendanaan->coa_pembiayaan->nama : '-' }}</td>
                                </tr>
                            </table>
                            <br>
                            
                            <table class="table table-bordered border-top mb-0 ">
                                <tr>
                                    <th width="20%">Nilai Pembiayaan</th>
                                    <td>Rp {{ !empty($rekening->nilai_pengajuan) ? number_format($rekening->nilai_pengajuan) : '0.00' }}</td>
                                    <th width="20%">Bagi Hasil / Margin</th>
                                    <td>Rp {{ !empty($rekening->interest) ? number_format($rekening->interest) : '0.00' }}</td>
                                </tr>
                                <tr>
                                    <th>Total Pembiayaan</th>
                                    <td colspan="3">Rp {{ !empty($rekening->pendanaan->plafond_pembiayaan) ? number_format($rekening->pendanaan->plafond_pembiayaan) : '0.00' }}</td>
                                </tr>
                                <tr>
                                    <th>Angsuran Bulanan</th>
                                    <td colspan="3">Rp {{ !empty($rekening->pendanaan->angsuran_bulanan) ? number_format($rekening->pendanaan->angsuran_bulanan) : '0.00' }}</td>
                                </tr>
                            </table>
                            <br>
                            <table class="table table-bordered border-top mb-0 ">
                                <tr>
                                    <th>Sisa Pembiayaan</th>
                                    <th colspan="3">Rp {{ !empty($rekening->saldo) ? number_format($rekening->saldo) : '0.00' }}</th>
                                </tr>
                            </table>
                            <br>
                            
                            <a href="{{ route('rekening-pendanaan.index') }}" class="btn btn-outline-danger">
                                Kembali
                            </a>
                            <a href="{{ route('daftar_pembiayaan.show', $rekening->rek_transfer_basil ) }}" class="btn btn-outline-primary" target="_blank">
                                Lihat Informasi Pengajuan
                            </a>
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
                                <!-- <th class="text-right">Basil</th> -->
                                <th class="text-right">Total</th>
                                <th class="text-right">Oustanding</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rekening->entries as $i => $listLedger)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $listLedger->ledger->date ?? '' }}</td>
                                <td>{{ !empty($listLedger->ledger->journal_number) ? $listLedger->ledger->journal_number : '-'}}</td>
                                <td>{{ $listLedger->ledger->description ?? '-'}}</td>
                                <td class="text-right">{{ $listLedger->debit ? number_format(abs($listLedger->amount)) : '0.00' }}</td>
                                <td class="text-right">{{ $listLedger->credit ? number_format(abs($listLedger->amount)) : '0.00' }}</td>
                                <!-- <td class="text-right">{{ number_format($listLedger->ledger->margin) ?? '0.00' }}</td> -->
                                <td class="text-right">{{ number_format($listLedger->ledger->nominal) ?? '0.00' }}</td>
                                <td class="text-right">{{ number_format($listLedger->current_balance, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- <div class="card border-0">
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
            </div> -->



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


</script>

@endpush
