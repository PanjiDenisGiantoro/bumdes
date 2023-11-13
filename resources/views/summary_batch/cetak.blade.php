<html>
<head>
    <style>

        body {
            display: block;
            margin: 0;
            font-family: Roboto,sans-serif,"Helvetica Neue",Arial,"Noto Sans",sans-serif;
            font-size: .875rem;
            font-weight: 400;
            line-height: 1.65;
            /*color: #526484;*/
            text-align: left;
            background-color: #f5f6fa;
            min-width: 320px;
        }

        .main-body {

            width: 820px;
            margin: auto;
        }

        a {
            color: blue;
        }

        h3, h4 {
            margin: 0;
            padding: 0;
        }

        h2 {

            font-size: 15px;
        }

        .bg-white {
            background-color: #fff !important;
        }
        .struk-border {
            /* border-top: 1px solid #666666; */
            /* border-right: 1px solid #666666;
            border-left: 1px solid #666666;
            height: 100%;
            padding: 10px;  */
        }
        .top-table {
            width: 100%;
            margin-top: 30px;

        }

        .top-table-text {
            /*border : 2px solid black;*/
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .top-table-text2 {
            font-size: 15px;
            margin-top: 15px;
            margin-bottom: 35px;
        }

        .box-container {

            display: inline-block;
        }

        .box-border {

            border: 1px solid black;
            padding: 10px;
        }

        .box-container5 {

            display: inline-block;
        }

        .box-border5 {

            /*border: 1px solid black;*/
            padding: 2px;
            padding-bottom: 5px;
        }


        td {
            padding: 5px;
            padding-bottom: 5px;
            font-size: 15px;
            line-height: 1.2;
        }

        .kop {

            background-repeat: no-repeat;
            background-position: left;
            background-size: 140px 75px;
            padding-top: 30px;
            padding-right: 50px;
            padding-bottom: 30px;
        }

        .row-top-border{
            border-top: 1px solid black;
        }

        .hr {

            height: 4px;
            background: black;
            margin-bottom: 10px;
            width: 86%;
        }

        .text {

            font-size: 15px;
        }
        table {
            border: none;
            border-collapse: collapse;
        }
    </style>
</head>

<body class="bg-white">

<div class="main-body">
    <div class="kop" style="background-image: url('{{ $logo }}')">
        <h3 align="center">KOPERASI KONSUMEN</h3>
        <h3 align="center">KOWARGI SYARIAH NUSANTARA</h3>
        <center><b>Jl. Telekomunikasi No 1 Gedung Bandung Techno Park(BTP) Kav. B101
            </b></center>
        <center><a href="#"><i>www.gerbangdesanusantara.id</i></a> &nbsp; <a href="#"><i>www.dagangbareng.id</i></a></center>
    </div>
    <div class="hr"></div>
    <div class="text">
        <div class="box-container5" style="width: 90%;">
            <h3 style="font-size: 20px;text-align: center">Informasi Pembiayaan</h3>
            <div class="box-border5">
                {{--                        <h3>  Informasi Anggota</h3>--}}
            </div>
        </div>
    </div>
    <div class="top-table-text">
        <table >
            <tbody>
            <tr>
                <td>{{ __('Status Pembiayaan') }}</td>
                <td>:</td>
                <td>{{$daftar_pembiayaan->hasil_pengajuan ?? '-'}}</td>
                <td>{{ __('Tanggal Disetujui') }}</td>
                <td>:</td>
                <td>{{\Carbon\Carbon::parse($daftar_pembiayaan->tanggal_disetujui ?? '')->format('d/m/Y') ?? ''}}</td>
            </tr>
            <tr>
                <td>{{ __('Tanggal Pengajuan') }}</td>
                <td>:</td>
                <td>{{\Carbon\Carbon::parse($daftar_pembiayaan->tanggal_permohonan ?? '')->format('d/m/Y') ?? ''}}</td>
                <td>{{ __('Tanggal Jatuh Tempo') }}</td>
                <td>:</td>
                <td>{{\Carbon\Carbon::parse($daftar_pembiayaan->tanggal_jatuh_tempo ?? '')->format('d/m/Y') ?? ''}}</td>
            </tr>

            <tr>
                <td>{{ __('Nama') }}</td>
                <td>:</td>
                <td>{{$daftar_pembiayaan->anggota->nama_pemohon ?? ''}}</td>
                <td>{{ __('No.Mitra') }}</td>
                <td>:</td>
                <td>{{$daftar_pembiayaan->no_mitra ?? ''}}</td>
            </tr>
            <tr>
                <td>{{ __('No. KTP') }}</td>
                <td>:</td>
                <td>{{$daftar_pembiayaan->anggota->nik ?? ''}}</td>
                <td>{{ __('Status Perkawinan') }}</td>
                <td>:</td>
                <td>{{$daftar_pembiayaan->anggota->status_perkawinan ?? ''}}</td>
            </tr>
            <tr>
                <td>{{ __('Tempat, Tgl Lahir') }}</td>
                <td>:</td>
                <td>{{$daftar_pembiayaan->anggota->tempat_lahir ?? ''}},{{\Carbon\Carbon::parse($daftar_pembiayaan->anggota->tanggal_lahir?? '')->format('d/m/Y') ?? ''}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>{{ __('No. Hp') }}</td>
                <td>:</td>
                <td>{{$daftar_pembiayaan->anggota->no_hp ?? ''}}</td>
            </tr>
            <tr>
                <td>{{ __('Jenis Kelamin') }}</td>
                <td>:</td>
                <td>{{$daftar_pembiayaan->anggota->jenis_kelamin ?? ''}}</td>
                <td>{{ __('Kontak Keluarga') }}</td>
                <td>:</td>
                <td>{{$daftar_pembiayaan->anggota->no_telp_keluarga ?? ''}}</td>
            </tr>
            <tr>
                <td>{{ __('Nama Jalan') }}</td>
                <td>:</td>
                <td>{{$daftar_pembiayaan->anggota->nama_jalan ?? ''}}</td>
                <td>{{ __('No. Rumah') }}</td>
                <td>:</td>
                <td>{{$daftar_pembiayaan->anggota->no_rumah ?? ''}}</td>
            </tr>
            <tr>
                <td>{{ __('No. RT/RW') }}</td>
                <td>:</td>
                <td>{{$daftar_pembiayaan->anggota->rtrw ?? ''}}</td>
                <td>{{ __('Provinsi') }}</td>
                <td>:</td>
                <td>{{strtolower($daftar_pembiayaan->anggota->province->name) ?? ''}}</td>
            </tr>
            <tr>
                <td>{{ __('Kota') }}</td>
                <td>:</td>
                <td>{{strtolower($daftar_pembiayaan->anggota->city->name) ?? ''}}</td>
                <td>{{ __('Kecamatan') }}</td>
                <td>:</td>
                <td>{{strtolower($daftar_pembiayaan->anggota->districts->name)?? ''}}</td>
            </tr>
            <tr>
                <td>{{ __('Desa') }}</td>
                <td>:</td>
                <td>{{strtolower($daftar_pembiayaan->anggota->villages->name) ?? ''}}</td>
                <td>{{ __('Kode Pos') }}</td>
                <td>:</td>
                <td>{{$daftar_pembiayaan->anggota->kode_pos ?? ''}}</td>
            </tr>
            <tr>
                <td>{{ __('No. Rekening') }}</td>
                <td>:</td>
                <td>{{$daftar_pembiayaan->no_rekening ?? ''}}</td>
                <td>{{ __('Jangka Waktu') }}</td>
                <td>:</td>
                <td>{{$daftar_pembiayaan->jangka_waktu ?? '-'}} Bulan</td>
            </tr>
            <tr>
                <td>{{ __('Plafon Pembiayaan') }}</td>
                <td>:</td>
                <td>{{number_format($daftar_pembiayaan->plafon_disetujui) ?? ''}}</td>
                <td>{{ __('Penyaluran Dana') }}</td>
                <td>:</td>
                <td>{{$daftar_pembiayaan->dana_peyaluran ?? '-'}}</td>
            </tr>
            <tr>
                <td>{{ __('Angsuran Pembiayaan') }}</td>
                <td>:</td>
                <td>{{number_format($daftar_pembiayaan->angsuran_perbulan) ?? ''}}</td>
                <td>{{ __('Tanggal Mulai Angsuran') }}</td>
                <td>:</td>
                <td>{{\Carbon\Carbon::parse($daftar_pembiayaan->tanggal_mulai_angsuran ?? '')->format('d/m/Y') ?? ''}}</td>
            </tr>

            </tbody>
        </table>
    </div>

    <!-- <div style="page-break-after: always;"></div> -->

</div>
</body>
</html>
