@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">Teller</h3>
    <br>
{{--<x-breadcrumb title="{{ __('Transaksi') }}">--}}
{{--    <li class="breadcrumb-item">--}}
{{--        <a href="{{ route('rekening-simpanan.index') }}">{{ __('Keuangan') }}</a>--}}
{{--    </li>--}}
{{--    <li class="breadcrumb-item">--}}
{{--        {{ __('Transaksi') }}--}}

{{--    </li>--}}
{{--</x-breadcrumb>--}}
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 col-lg-10">
        <div class="card border-0 m-b-20">
            <h5 class="card-header">{{ __('Rekening Anggota') }}</h5>

            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <br>
                        <table class="table table-bordered border-top mb-0 ">

                            <tr>
                                <th>Tanggal Transaksi</th>
                                <td>{{ date('d/m/Y', strtotime($transaksi_keuangan->date)) }}</td>
                                <th>No Jurnal</th>
                                <td>{{ $transaksi_keuangan->journal_number }}</td>
                            </tr>
                            <tr>
                                <th>No Rekening</th>
                                <td>{{$simpananAkun->akads->nama_akad ?? ''}}</td>
                                <th>No Referensi</th>
                                <td>{{$transaksi_keuangan->reference ?? ''}}</td>
                            </tr>

                            <tr>
                                <th>Nilai Transaksi</th>
                                <td>{{ number_format($transaksi_keuangan->nominal ?? '', 2)}}</td>
                                <th>Waktu Transaksi</th>
                                {{-- @if(!empty($simpananAkun->ledger->amount)) --}}
                                <td>{{ $transaksi_keuangan->created_at }}</td>
                                {{-- @else --}}
                                {{-- <td></td> --}}

                                {{-- @endif --}}
                            </tr>

                            {{-- <tr>
                                <th>Tujuan Pengajuan</th>
                                <td>{{$simpananAkun->tujuan_pengajuans->nama_tujuan_pengajuan ?? ''}}</td>
                                <th>Sumber Dana</th>
                                <td>{{$simpananAkun->sumber_danas->nama_sumber_dana ?? ''}}</td>
                            </tr> --}}

                        </table>
                        <br>


                    </div>
                </div>
                    <div class="data-item " style="float:right;">

                        <a href="{{ url()->previous() }}" class="btn btn-danger">
                            Kembali
                        </a>
                    </div>
            </div>
        </div>

        {{-- <div class="card border-0">
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
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                @foreach($transaksiList as $i => $list)
                @php $no=1; @endphp
                @foreach($list->ledgers as $listLedger)
                <tr>
                    <td>{{$no++}}</td>
        <td>{{$listLedger->ledger->date ?? ''}}</td>
        <td>{{$listLedger->ledger->journal_number}}</td>
        <td>{{ $listLedger->ledger->description }}</td>
        <td class="text-right">{{ $listLedger->debit ? number_format(abs($listLedger->amount), 2) : '0.00' }}</td>
        <td class="text-right">{{ $listLedger->credit ? number_format(abs($listLedger->amount), 2) : '0.00' }}</td>
        <td class="text-right">{{ number_format($listLedger->current_balance, 2) }}</td>
        <td>
            @if(substr($listLedger->ledger->journal_number,0,2) == 'TN')
            <a href="{{route('transaksi_keuangan.show',$listLedger->ledger->id)}}" class="btn btn-outline-info"><i class="fa fa-print"></i></a>

            @else
            <a href="{{route('jurnal_keuangan.show',$listLedger->ledger->id)}}" class="btn btn-outline-info"><i class="fa fa-print"></i></a>

            @endif
        </td>

        </tr>
        @endforeach
        @endforeach


        </table>


        <div class="card-footer border border-top-0 text-right">
            <a href="{{ route('rekening-simpanan.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Kembali') }}</a>
        </div>
        <div>

        </div> --}}
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
