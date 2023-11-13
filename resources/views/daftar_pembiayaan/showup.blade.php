@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Informasi Pendanaan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('daftar_pembiayaan.index') }}">{{ __('Pendanaan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('daftar_pembiayaan.index') }}">{{ __('Daftar Pendanaan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Informasi Pendanaan') }}</a>
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Informasi Pendanaan') }}</h5>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered border-top mb-0 ">

                                    <tr>
                                        <th>status</th>
                                        <th colspan="5">{{$daftar_pembiayaan->hasil_pengajuan ?? $daftar_pembiayaan->status}}</th>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Pengajuan</th>
                                        <td>@if(empty($daftar_pembiayaan->tanggal_permohonan))-  @else {{\Carbon\Carbon::parse($daftar_pembiayaan->tanggal_permohonan)->format('d/m/Y')}} @endif</td>
                                        <th>Tanggal Disetujui</th>
                                        <td>@if(empty($daftar_pembiayaan->tanggal_disetujui)) - @else {{\Carbon\Carbon::parse($daftar_pembiayaan->tanggal_disetujui)->format('d/m/Y')}} @endif</td>
                                        <th>Mulai Angsuran</th>
                                        <td>@if(empty($daftar_pembiayaan->tanggal_mulai_angsuran)) - @else {{\Carbon\Carbon::parse($daftar_pembiayaan->tanggal_mulai_angsuran)->format('d/m/Y')}} @endif</td>
                                    </tr>
                                </table>
                                <br>
                                <table class="table table-bordered border-top mb-0 ">

                                    <tr>
                                        <th>Nama</th>
                                        <td>{{$id_anggota->nama_pemohon ?? ''}}</td>
                                        <th>No Ktp</th>
                                        <td>{{$id_anggota->nik ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>No. Rekening</th>
                                        <td>{{$daftar_pembiayaan->no_rekening ?? ''}}</td>
                                        <th>Jangka Waktu</th>
                                        <td>{{$daftar_pembiayaan->jangka_waktu ?? ''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Batch</th>
                                        <td>{{$daftar_pembiayaan->batch ?? ''}}</td>
                                        <th>Penyaluran Dana</th>
                                        <td>{{$daftar_pembiayaan->sumber_pendanaan->nama_sumber_pendanaan ?? ''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Angsuran Pembiayaan</th>
                                        <td>{{number_format($daftar_pembiayaan->angsuran_perbulan) ?? ''}}</td>
                                        <th>Tanggal Jatuh Tempo</th>
                                        <td>@if(empty($daftar_pembiayaan->tanggal_jatuh_tempo)) - @else {{\Carbon\Carbon::parse($daftar_pembiayaan->tanggal_jatuh_tempo)->format('d/m/Y')}} @endif</td>
                                    </tr>

                                </table>

                                <br>
{{--                                <h5>Daftar Rincian</h5>--}}
{{--                                <table class="table table-bordered border-top mb-0 ">--}}

{{--                                    <tr>--}}
{{--                                        <th>#</th>--}}
{{--                                        <th>Tanggal </th>--}}
{{--                                        <th>No Jurnal</th>--}}
{{--                                        <th>Keterangan</th>--}}
{{--                                        <th class="text-right">Debit</th>--}}
{{--                                        <th class="text-right">Kredit</th>--}}
{{--                                        <th class="text-right">Saldo</th>--}}
{{--                                        <th>&nbsp;</th>--}}
{{--                                    </tr>--}}

{{--                                    @foreach($users as $i => $list)--}}
{{--                                        @php $no=1; @endphp--}}
{{--                                        @foreach($list->ledgers as $listLedger)--}}
{{--                                            <tr>--}}
{{--                                                <td>{{$no++}}</td>--}}
{{--                                                <td>{{$listLedger->ledger->date ?? ''}}</td>--}}
{{--                                                <td>{{$listLedger->ledger->journal_number}}</td>--}}
{{--                                                <td>{{ $listLedger->ledger->description }}</td>--}}
{{--                                                <td class="text-right">{{ $listLedger->debit ? number_format(abs($listLedger->amount), 2) : '0.00' }}</td>--}}
{{--                                                <td class="text-right">{{ $listLedger->credit ? number_format(abs($listLedger->amount), 2) : '0.00' }}</td>--}}
{{--                                                <td class="text-right">{{ number_format($listLedger->current_balance, 2) }}</td>--}}
{{--                                                --}}{{--                                        @if(substr($listLedger->ledger->journal_number))--}}
{{--                                                <td>--}}
{{--                                                    @if(substr($listLedger->ledger->journal_number,0,2) == 'TN')--}}
{{--                                                        <a href="{{route('transaksi_keuangan.show',$listLedger->ledger->id)}}" class="btn btn-outline-info"><i class="fa fa-print"></i></a>--}}

{{--                                                    @else--}}
{{--                                                        <a href="{{route('jurnal_keuangan.show',$listLedger->ledger->id)}}" class="btn btn-outline-info"><i class="fa fa-print"></i></a>--}}

{{--                                                    @endif--}}
{{--                                                </td>--}}

{{--                                            </tr>--}}
{{--                                        @endforeach--}}
{{--                                    @endforeach--}}


{{--                                </table>--}}

                                <h5>Daftar Rincian</h5>
                                <table class="table table-bordered border-top mb-0 ">

                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal </th>
                                        <th>No Jurnal</th>
                                        <th>Keterangan</th>
                                        <th>Debit</th>
                                        <th>Kredit</th>
                                        <th>Saldo</th>
                                        <th>&nbsp;</th>
                                    </tr>

                                    <tr>
                                        <td>1</td>
                                        <td>12/12/2022</td>
                                        <td>TXN-12121</td>
                                        <td>Setor Tunai - simpanan wajib</td>
                                        <td>0.00</td>
                                        <td>50.000</td>
                                        <td>250.000</td>
                                        <td><button class="btn btn-outline-info"><i class="fa fa-print"></i></button></td>
                                    </tr>


                                </table>


                                <div class="card-footer border border-top-0 text-right">
                            <a href="{{ route('daftar_pembiayaan.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Kembali') }}</a>
                            {{--                            <button type="submit" class="btn btn-primary">{{ !empty($anggota->id) ? __('Perbaharui') : __('Simpan') }}</button>--}}
                        </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

    <script>
        function showPreview(event){
            if(event.target.files.length > 0){
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }
        function showPreview1(event){
            if(event.target.files.length > 0){
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview1");
                preview.src = src;
                preview.style.display = "block";
            }
        }
        $(document).ready(function() {
            $('#nama_anggota').on('change', function () {
                var countryID = $(this).val();
                if(countryID){
                    $.ajax({
                        type:"GET",
                        url: "{{route('getdatapembiayaan')}}?country_id=" + countryID,
                        success:function(res){
                            console.log(res['pendidikan']);
                            if(res){
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
                                $.each(res,function(key,value){
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

                                    $('#file1').attr("src","{{asset('storage')}}"+"/"+res.gambar1);
                                    $('#file2').attr("src","{{asset('storage')}}"+"/"+res.gambar);
                                    $('#gambar1').attr("src","{{asset('storage')}}"+"/"+res.warung1);
                                    $('#gambar2').attr("src","{{asset('storage')}}"+"/"+res.warung2);
                                    $('#gambar3').attr("src","{{asset('storage')}}"+"/"+res.warung3);
                                    $('#gambar4').attr("src","{{asset('storage')}}"+"/"+res.warung4);
                                });

                            }else{
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
                }else{
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
