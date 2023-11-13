@extends('layouts.app')

@section('breadcrumb')
<x-breadcrumb title="{{ __('Rekening Simpanan') }}">
    <li class="breadcrumb-item">
        <a href="{{ route('rekening-simpanan.index') }}">{{ __('Rekening Simpanan') }}</a>
    </li>
    <li class="breadcrumb-item">
        @if(!empty($simpananAkun->id))
        {{ __('Lihat Rekening Simpanan') }}
        @else
        {{ __('Tambah Rekening Simpanan') }}
        @endif
    </li>
</x-breadcrumb>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 col-lg-10">
        <div class="card border-0 m-b-20">
            <h5 class="card-header">{{ __('Informasi Rekening Simpanan') }}</h5>

            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered border-top mb-0 ">
                            <tr>
                                <th>Status</th>
                                <td>  @if ($simpananAkun->status == \App\Models\RekeningPembiayaan::STATUS_PENDING)
                                    <span class="tag tag-yellow">{{ ucfirst($simpananAkun->status) ?? '-' }}</span>
                                    @elseif ($simpananAkun->status == \App\Models\RekeningPembiayaan::STATUS_APPROVED)
                                    <span class="tag tag-indigo">{{ ucfirst($simpananAkun->status) ?? '-' }}</span>
                                    @elseif ($simpananAkun->status == \App\Models\RekeningPembiayaan::STATUS_ACTIVE)
                                    <span class="tag tag-green">{{ ucfirst($simpananAkun->status) ?? '-' }}</span>
                                    @else
                                    <span class="tag tag-red">{{ ucfirst($simpananAkun->status) ?? '-' }}</span>
                                    @endif</td>
                                <th>Tanggal Daftar</th>
                                <td>{{date('d/m/Y', strtotime($simpananAkun->created_at) ?? '') ?? '' }}</td>
                            </tr>
                        </table>
                        <br>
                        <table class="table table-bordered border-top mb-0 ">

                            <tr>
                                <th>Nama Anggota</th>
                                <td>{{$simpananAkun->anggota->nama_pemohon ?? ''}}</td>
                                <th>No Anggota</th>
                                <td>{{$simpananAkun->anggota->no_mitra ?? ''}}</td>
                            </tr>
                            <tr>
                                <th>Akad Produk</th>
                                <td>{{$simpananAkun->akads->nama_akad ?? ''}}</td>
                                <th>Nama Produk</th>
                                <td>{{$simpananAkun->produk->nama_simpanan ?? ''}}</td>
                            </tr>


                            <tr>
                                <th>Tujuan Pengajuan</th>
                                <td>{{$simpananAkun->tujuan_pengajuans->nama_tujuan_pengajuan ?? ''}}</td>
                                <th>Sumber Dana</th>
                                <td>{{$simpananAkun->sumber_danas->nama_sumber_dana ?? ''}}</td>
                            </tr>

                            <tr>
                                <th >Akun Officer</th>
                                <td colspan='3'>{{ $simpananAkun->akunOfficer->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th >No. Rekening</th>
                                <td colspan='3'>{{$simpananAkun->no_akun ?? ''}}</td>
                                <!-- <th>Pengajuan Setoran</th>
                                <td></td> -->

                                 {{-- @if(!empty($simpananAkun->ledger->amount))
                                <td>{{ number_format($simpananAkun->nilai_setoran) }}</td>
                                @else
                                <td></td>

                                @endif --}}
                            </tr>

                        </table>
                        <br>
                        <table class="table table-bordered border-top mb-0 ">

                            <tr>
                                <th width="200">Saldo</th>
                                @if(!empty($simpananAkun->ledger->amount))
                                <th colspan="3">{{number_format($simpananAkun->balance()) ?? ''}}</th>
                                @else
                                <th colspan="3">{{ $simpananAkun->balance() }}</th>
                                @endif

                            </tr>

                        </table>

                        <br>
                        <a href="{{ route('rekening-simpanan.index') }}" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0">
                <div class="card-header">
                    <h3 class="card-title">Daftar Rincian</h3>
                </div>
                                <table class="table card-table table-vcenter text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal </th>
                                            <th>No Jurnal</th>
                                            <th>Keterangan</th>
                                            <th class="text-right">Debit</th>
                                            <th class="text-right">Kredit</th>
                                            <th class="text-right">Saldo</th>
                                            <!-- <th>&nbsp;</th> -->
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
                                {{--
                                    @php
                                        $total_debit = 0;
                                        $total_kredit = 0;
                                        $total_saldo = 0;
                                    @endphp
                                    @foreach($transaksiList as $i => $list)
                                        @php $no=1;$total=0; @endphp
                                        @foreach($list->ledgers as $listLedger)
                                        <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{ $listLedger->ledger->date ?? '' }}</td>
                                        <td>{{$listLedger->ledger->journal_number ?? '' }}</td>
                                        <td>{{ $listLedger->ledger->description ?? '' }}</td>
                                        <td class="text-right">{{ $listLedger->debit ? number_format(abs($listLedger->amount), 2) : '0.00' }}</td>
                                        <td class="text-right">{{ $listLedger->credit ? number_format(abs($listLedger->amount), 2) : '0.00' }}</td>
                                        <td class="text-right">{{ number_format($listLedger->current_balance, 2) }}</td>
                                        @if(substr($listLedger->ledger->journal_number))
                                        <td>
                                          @if(substr($listLedger->ledger->journal_number,0,2) == 'TN')
                                                <a href="{{route('transaksi_keuangan.show',$listLedger->ledger->id)}}" class="btn btn-outline-info"><i class="fa fa-print"></i></a>

                                            @else
                                                <a href="{{route('jurnal_keuangan.show',$listLedger->ledger->id)}}" class="btn btn-outline-info"><i class="fa fa-print"></i></a>

                                               @endif
                                        </td>

                                    </tr>
                                    @php
                                        $total_debit += $listLedger->debit ? abs($listLedger->amount) : '0.00';
                                        $total_kredit += $listLedger->credit ? abs($listLedger->amount) : '0.00';
                                    @endphp
                                    @endforeach
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th>Total</th>
                                        <td class="text-right">{{ number_format($total_debit) }}</td>
                                        <td class="text-right">{{ number_format($total_kredit   ) }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                                --}}


                        {{-- <div class="card-footer border border-top-0 text-right">
                            <a href="{{ route('rekening-simpanan.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Kembali') }}</a> --}}
                            {{--                            <button type="submit" class="btn btn-primary">{{ !empty($anggota->id) ? __('Perbaharui') : __('Simpan') }}</button>--}}
                        {{-- </div> --}}
        <div>

    </div>
</div>

            @endsection
            @push('scripts')

            <script>
                function showPreview(event) {
                    if (event.target.files.length > 0) {
                        var src = URL.createObjectURL(event.target.files[0]);
                        var preview = document.getElementById("file-ip-1-preview");
                        preview.src = src;
                        preview.style.display = "block";
                    }
                }

                function showPreview1(event) {
                    if (event.target.files.length > 0) {
                        var src = URL.createObjectURL(event.target.files[0]);
                        var preview = document.getElementById("file-ip-1-preview1");
                        preview.src = src;
                        preview.style.display = "block";
                    }
                }
                $(document).ready(function() {
                    $('#nama_anggota').on('change', function() {
                        var countryID = $(this).val();
                        if (countryID) {
                            $.ajax({
                                type: "GET"
                                , url: "{{route('getdatapembiayaan')}}?country_id=" + countryID
                                , success: function(res) {
                                    console.log(res['pendidikan']);
                                    if (res) {
                                        $("#nik").empty();
                                        $("#no_mitra").empty();
                                        $("#email").empty();
                                        $("#kode_pos").empty();
                                        $("#no_kk").empty();
                                        $("#tanggal_lahir").empty();
                                        $("#tempat_lahir").empty();
                                        $("#jenis_kelamin").empty();
                                        $("#status_perkawinan").empty();
                                        $("#pekerjaan").empty();
                                        $("#nama_jalan").empty();
                                        $("#no_rumah").empty();
                                        $("#rtrw").empty();
                                        $("#provinsi").empty();
                                        $("#kota").empty();
                                        $("#kecamatan").empty();
                                        $("#desa").empty();
                                        $("#kode_pos").empty();
                                        $("#bumdes").empty();
                                        $("#no_hp").empty();
                                        $("#status_keluarga").empty();
                                        $("#nama_ibu").empty();
                                        $("#pendidikan").empty();
                                        $("#namasehubungankeluarga").empty();
                                        $("#nama_kerabat").empty();
                                        $("#no_telp_keluarga").empty();
                                        $("#no_telp").empty();
                                        $("#nama_warung").empty();
                                        $("#profil_warung").empty();
                                        $("#bidang_usaha").empty();
                                        $("#berdiri_sejak").empty();
                                        $.each(res, function(key, value) {
                                            $("#nik").val(res.result.anggota.nik);
                                            $("#no_mitra").val(res.result.anggota.no_mitra);
                                            $("#email").val(res.result.anggota.email);
                                            $("#no_kk").val(res.result.anggota.no_kk);
                                            $("#tanggal_lahir").val(res.result.anggota.tanggal_lahir);
                                            $("#tempat_lahir").val(res.result.anggota.tempat_lahir);
                                            $("#jenis_kelamin").val(res.result.anggota.jenis_kelamin);
                                            $("#status_perkawinan").val(res.result.anggota.status_perkawinan);
                                            $("#pekerjaan").val(res.result.anggota.pekerjaan);
                                            $("#nama_jalan").val(res.result.anggota.nama_jalan);
                                            $("#no_rumah").val(res.result.anggota.no_rumah);
                                            $("#rtrw").val(res.result.anggota.rtrw);
                                            $("#provinsi").val(res.result.anggota.provinsi);
                                            $("#kota").val(res.result.anggota.kota);
                                            $("#kecamatan").val(res.result.anggota.kecamatan);
                                            $("#desa").val(res.result.anggota.desa);
                                            $("#kode_pos").val(res.result.anggota.kode_pos);
                                            $("#bumdes").val(res.result.anggota.bumdes);
                                            $("#no_hp").val(res.result.anggota.no_hp);
                                            $("#status_keluarga").val(res.result.anggota.status_keluarga);
                                            $("#nama_ibu").val(res.result.anggota.nama_ibu);
                                            $("#nama_kerabat").val(res.result.anggota.nama_kerabat);
                                            $("#pendidikan").val(res['pendidikan']);
                                            $("#no_telp_keluarga").val(res.result.anggota.no_telp_keluarga);
                                            $("#no_telp").val(res.result.anggota.no_telpon);
                                            $("#namasehubungankeluarga").val(res.result.anggota.namasehubungankeluarga);
                                            $("#nama_warung").val(res.result.nama_warung);
                                            $("#profil_warung").val(res.result.profil_warung);
                                            $("#bidang_usaha").val(res.result.bidang_usaha);
                                            $("#berdiri_sejak").val(res.result.berdiri_sejak);

                                            $('#file1').attr("src", "{{asset('storage')}}" + "/" + res.gambar1);
                                            $('#file2').attr("src", "{{asset('storage')}}" + "/" + res.gambar);
                                            $('#gambar1').attr("src", "{{asset('storage')}}" + "/" + res.warung1);
                                            $('#gambar2').attr("src", "{{asset('storage')}}" + "/" + res.warung2);
                                            $('#gambar3').attr("src", "{{asset('storage')}}" + "/" + res.warung3);
                                            $('#gambar4').attr("src", "{{asset('storage')}}" + "/" + res.warung4);
                                        });

                                    } else {
                                        $("#nik").empty();
                                        $("#no_mitra").empty();
                                        $("#email").empty();
                                        $("#kode_pos").empty();
                                        $("#no_kk").empty();
                                        $("#tanggal_lahir").empty();
                                        $("#tempat_lahir").empty();
                                        $("#jenis_kelamin").empty();
                                        $("#status_perkawinan").empty();
                                        $("#pekerjaan").empty();
                                        $("#nama_jalan").empty();
                                        $("#no_rumah").empty();
                                        $("#rtrw").empty();
                                        $("#provinsi").empty();
                                        $("#kota").empty();
                                        $("#kecamatan").empty();
                                        $("#desa").empty();
                                        $("#kode_pos").empty();
                                        $("#bumdes").empty();
                                        $("#no_hp").empty();
                                        $("#status_keluarga").empty();
                                        $("#nama_ibu").empty();
                                        $("#nama_kerabat").empty();
                                        $("#no_telp_keluarga").empty();
                                        $("#pendidikan").empty();
                                        $("#namasehubungankeluarga").empty();
                                        $("#no_telp").empty();
                                        $("#nama_warung").empty();
                                        $("#profil_warung").empty();
                                        $("#bidang_usaha").empty();
                                        $("#berdiri_sejak").empty();
                                    }
                                }
                            });
                        } else {
                            $("#nik").empty();
                            $("#no_mitra").empty();
                            $("#email").empty();
                            $("#kode_pos").empty();
                            $("#no_kk").empty();
                            $("#tanggal_lahir").empty();
                            $("#tempat_lahir").empty();
                            $("#jenis_kelamin").empty();
                            $("#status_perkawinan").empty();
                            $("#pekerjaan").empty();
                            $("#nama_jalan").empty();
                            $("#no_rumah").empty();
                            $("#rtrw").empty();
                            $("#provinsi").empty();
                            $("#kota").empty();
                            $("#kecamatan").empty();
                            $("#desa").empty();
                            $("#kode_pos").empty();
                            $("#bumdes").empty();
                            $("#no_hp").empty();
                            $("#status_keluarga").empty();
                            $("#nama_ibu").empty();
                            $("#nama_kerabat").empty();
                            $("#no_telp_keluarga").empty();
                            $("#pendidikan").empty();
                            $("#namasehubungankeluarga").empty();
                            $("#no_telp").empty();
                            $("#nama_warung").empty();
                            $("#profil_warung").empty();
                            $("#bidang_usaha").empty();
                            $("#berdiri_sejak").empty();
                        }
                    });

                });

            </script>

            @endpush
