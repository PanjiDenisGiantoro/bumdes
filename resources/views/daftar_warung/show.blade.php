<html>
    <head>
    <style>

        body {
            display: block;
            margin: 0;
            margin-right:15px;
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
            font-size: 50px;
            /*border : 2px solid black;*/
            margin-top: 20px;
            margin-bottom: 40px;
        }

        .top-table-text2 {
            font-size: 15px;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .top-table-text3 {
            font-size: 15px;
            margin-top: 15px;
            margin-bottom: 30px;
        }

        .top-table-text4 {
            font-size: 15px;
            margin-top: 15px;
            margin-bottom: 10px;
        }

        .box-container {

            display: inline-block;
        }

        .box-border {
            border: 0px solid black;
            padding: 13px;
        }

        td {
            padding: 5px;
            padding-bottom: 5px;
            font-size: 13px;
            line-height: 1.2;

        }

        .kop {

            background-repeat: no-repeat;
            background-position: left;
            background-size: 140px 75px;
            padding-top: 20px;
            padding-bottom: 30px;
        }

        .row-top-border{
            border-top: 1px solid black;
        }

        .hr {

            height: 4px;
            background: black;
            margin-bottom: 10px;
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
                <h3 align="center">{{ $perusahan->nama_perusahaan }}</h3>
                {{-- <h4 align="center">KOWARGI SYARIAH NUSANTARA</h4> --}}
                <center><b>{{ $perusahan->alamat_utama }}
                </b></center>
                <center><a href="#"><i>{{ $perusahan->email_perusahaan }}</i></a> &nbsp; <a href="#"><i>www.dagangbareng.id</i></a></center>
            </div>
         <div class="hr"></div>
            <h3><center>BIODATA WARUNG</center></h3>
         <div class="text">
             <p>&nbsp; Yang Bertanda Tangan Dibawah Ini :</p>
         </div>
        <div class="top-table-text">
            <table>
                <tbody>
                    <tr>
                        <td>{{ __('Tanggal Register') }}</td>
                        <td>:</td>
                        <td>{{\Carbon\Carbon::parse($daftar_warung->created_at)->format('d/m/Y') ?? ''}}</td>
                    </tr>

                    <tr>
                        <td>{{ __('Nama Lengkap') }}</td>
                        <td>:</td>
                        <td>{{$daftar_warung->anggota->nama_pemohon ?? ''}}</td>
                    </tr>

                    <tr>
                        <td>{{ __('No. Anggota') }}</td>
                        <td>:</td>
                        <td>{{$daftar_warung->anggota->no_mitra ?? ''}}</td>
                    </tr>

                    <tr>
                        <td>{{ __('Tempat Lahir') }}</td>
                        <td>:</td>
                        <td>{{$daftar_warung->anggota->tempat_lahir ?? ''}}</td>
                    </tr>

                    <tr>
                        <td>{{ __('Tanggal Lahir') }}</td>
                        <td>:</td>
                        <td>{{\Carbon\Carbon::parse($daftar_warung->anggota->tanggal_lahir)->format('d/m/Y') ?? ''}}</td>
                    </tr>

                    <tr>
                        <td>{{ __('NIK') }}</td>
                        <td>:</td>
                        <td>{{$daftar_warung->nik ?? ''}}</td>
                    </tr>

                    <tr>
                        <td>{{ __('Alamat') }}</td>
                        <td>:</td>
                        <td>{!! $daftar_warung->tempat_sama ? wordwrap(implode(', ', array_filter([
                            $daftar_warung->anggota->nama_jalan ?? '',
                            $daftar_warung->anggota->villages->name ?? '',
                            $daftar_warung->anggota->districts->name ?? '',
                            $daftar_warung->anggota->city->name ?? '',
                            $daftar_warung->anggota->province->name ?? ''
                        ])), 60, '<br>') : wordwrap(implode(', ', array_filter([
                            $daftar_warung->nama_jalan ?? '',
                            $daftar_warung->villages->name ?? '',
                            $daftar_warung->districts->name ?? '',
                            $daftar_warung->city->name ?? '',
                            $daftar_warung->province->name ?? ''
                        ])), 60, '<br>') !!}</td>
                    </tr>

                    <tr>
                        <td>{{ __('No. Hp / WA') }}</td>
                        <td>:</td>
                        <td>{{$daftar_warung->anggota->no_hp ?? ''}}</td>
                    </tr>

                    <tr>
                        <td>{{ __('Bumdes') }}</td>
                        <td>:</td>
                        <td>{{$daftar_warung->anggota->bumdes ?? ''}}</td>
                    </tr>

                    <tr>
                        <td>{{ __('Nama Toko / Warung') }}</td>
                        <td>:</td>
                        <td>{{$daftar_warung->nama_warung ?? ''}}</td>
                    </tr>

                    <tr>
                        <td>{{ __('Bidang Usaha') }}</td>
                        <td>:</td>
                        <td>{{$daftar_warung->bidangusaha->bidang_usaha ?? ''}}</td>
                    </tr>

                    <tr>
                        <td>{{ __('Berdiri Sejak') }}</td>
                        <td>:</td>
                        <td>{{\Carbon\Carbon::parse($daftar_warung->berdiri_sejak)->format('d/m/Y') ?? ''}}</td>
                    </tr>

                    <tr>
                        <td>{{ __('Status Bangunan') }}</td>
                        <td>:</td>
                        <td>{{$daftar_warung->statusbangunans->status_bangunan ?? ''}}</td>
                    </tr>
                    <tr>
                        <td>{{ __('Lama Usaha') }} </td>
                        <td>:</td>
                        <td>{{$daftar_warung->daftarpembiayaan->lama_usaha ?? ''}} Tahun</td>
                    </tr>
                    <tr>
                        <td>{{ __('Pengelola') }}</td>
                        <td>:</td>
                        <td>{{$daftar_warung->daftarpembiayaan->pengelola ?? ''}}</td>
                    </tr>
                    <tr>
                        <td>{{ __('Usaha') }}</td>
                        <td>:</td>
                        <td>{{$daftar_warung->daftarpembiayaan->usaha ?? ''}}</td>
                    </tr>
                    <tr>
                        <td>{{ __('Lingkungan') }}</td>
                        <td>:</td>
                        <td>{{$daftar_warung->daftarpembiayaan->lingkungan ?? ''}}</td>
                    </tr>
                    <tr>
                        <td>{{ __('Omset Harian') }}</td>
                        <td>:</td>
                        <td>{{$daftar_warung->daftarpembiayaan->omset_harian ?? ''}}</td>
                    </tr>
                    <tr>
                        <td>{{ __('Catatan') }}</td>
                        <td>:</td>
                        <td>{{$daftar_warung->daftarpembiayaan->catatan ?? ''}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    <h2>{{ __('DOKUMEN ANGGOTA') }}</h2>
        <table class="top-table-text3" >

            <tr>
                <td>Foto Diri</td>
                <td>Foto KTP</td>
            </tr>
            <tr>
                <td>
                    <div class="box-border">
                        <img id="file-ip-1-preview" width="250" height="150"src="{{$file_foto}}">
                    </div>
                </td>
                <td>
                    <div class="box-border">
                        <img id="file-ip-1-preview" width="250" height="150"src="{{$file_ktp}}">
                    </div>
                </td>
            </tr>
        </table>

            <div style="page-break-after: always;"></div>

        <h2>{{ __('DOKUMEN FOTO WARUNG') }}</h2>
        <table class="top-table-text3" width="100%">
            <tr>
               <td width="250" height="150">
                    <b><p>Foto Warung 1</p></b>

                    <div class="box-container">
                        <div class="box-border">
                        </div>
                        <div class="box-border">
                            <img id="file-ip-1-preview" width="250" height="150" src="{{$daftar_warung->images[0]}}">
                        </div>
                    </div>
                </td>
                <td width="250" height="150">
                    <b><p>Foto Warung 2</p></b>

                    <div class="box-container">
                        <div class="box-border">
                        </div>
                        <div class="box-border">
                            <img id="file-ip-1-preview" width="250" height="150" src="{{$daftar_warung->images[1] }}">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <b><p>Foto Warung 3</p></b>

                    <div class="box-container">
                        <div class="box-border">
                        </div>
                        <div class="box-border">
                            <img id="file-ip-1-preview" width="250" height="150" src="{{$daftar_warung->images[2]}}">
                        </div>
                    </div>
                </td>
                <td>
                    <b><p>Foto Warung 4</p></b>
                    <div class="box-container">
                        <div class="box-border">
                        </div>
                        <div class="box-border">
                            <img id="file-ip-1-preview" width="250" height="150"src="{{$daftar_warung->images[3]}}">
                        </div>
                    </div>
                </td>
            </tr>
        </table>

                  <div style="page-break-after: always;"></div>
        <h3>{{ __('LOKASI TEMPAT') }}</h3>
            <table class="top-table-text3" width="100%">
                <tr>
                    <td>
                        @if(!empty($daftar_warung->coordinates))
                            <img style="border: 1px solid #000; height: 350px; width: 600px" src="https://maps.googleapis.com/maps/api/staticmap?format=jpg&center={{$daftar_warung->coordinates->getLat()}},{{$daftar_warung->coordinates->getLng()}}&zoom=13&size=600x350&maptype=roadmap&markers=color:blue|label:X|{{$daftar_warung->coordinates->getLat()}},{{$daftar_warung->coordinates->getLng()}}&key=AIzaSyBvu7DpLUaUdXskROiaAofFPOpN5hmsOro" />
                        @endif
                    </td>
                </tr>
            </table>
            <div class="top-table-text2">
                <p>“ Bersedia menjadi Mitra <b>KOWARGI Syariah Nusantara</b> Induk Jawa Barat dan siap mendukung </p>
                &nbsp; program desa dalam ikut serta meningkatkan perputaran ekonomi lokal.”
            </div>
        </div>

    </body>
</html>
