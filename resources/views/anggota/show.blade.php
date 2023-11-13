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

            /*border: 1px solid black;*/
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
                <h3 align="center">{{ $perusahan->nama_perusahaan }}</h3>
                <center><b>{{ $perusahan->alamat_utama }}
                </b></center>
                <center><a href="#"><i>{{ $perusahan->email_perusahaan }}</i></a> &nbsp; <a href="#"><i>{{$perusahaan->no_handphone ?? ''}}</i></a></center>
            </div>
            <div class="hr"></div>
            <div class="text">
                <div class="box-container5" style="width: 90%;">
                    <h3 style="font-size: 20px;text-align: center">Biodata Anggota</h3>
                    <div class="box-border5">
{{--                        <h3>  Informasi Anggota</h3>--}}
                    </div>
                </div>
            </div>
            <div class="top-table-text">
                <table>
                    <tbody>
                        <tr>
                            <td>{{ __('Tanggal Register') }}</td>
                            <td>:</td>
                            <td>{{\Carbon\Carbon::parse($dataanggota->created_at)->format('d/m/Y') ?? ''}}</td>
                        </tr>

                        <tr>
                            <td>{{ __('No. Anggota') }}</td>
                            <td>:</td>
                            <td>{{$dataanggota->no_mitra}}</td>
                        </tr>

                        <tr>
                            <td>{{ __('Nama Lengkap') }}</td>
                            <td>:</td>
                            <td>{{$dataanggota->nama_pemohon}}</td>
                        </tr>

                        <tr>
                            <td>{{ __('Jenis Kelamin') }}</td>
                            <td>:</td>
                            <td>{{$dataanggota->jenis_kelamin}}</td>
                        </tr>

                        <tr>
                            <td>{{ __('Email') }}</td>
                            <td>:</td>
                            <td>{{$dataanggota->email}}</td>
                        </tr>

                        <tr>
                            <td>{{ __('Tempat Lahir') }}</td>
                            <td>:</td>
                            <td>{{$dataanggota->tempat_lahir}}</td>
                        </tr>

                        <tr>
                            <td>{{ __('Tanggal Lahir') }}</td>
                            <td>:</td>
                            <td>{{\Carbon\Carbon::parse($dataanggota->tanggal_lahir)->format('d/m/Y') ?? ''}}</td>
                        </tr>

                        <tr>
                            <td>{{ __('Status Perkawinan') }}</td>
                            <td>:</td>
                            <td>{{$dataanggota->status_perkawinan}}</td>
                        </tr>

                        {{-- <tr>
                            <td>{{ __('Pendidikan Terakhir') }}</td>
                            <td>:</td>
                            <td>{{$dataanggota->status_perkawinan}}</td>
                        </tr> --}}

                        <tr>
                            <td>{{ __('Pekerjaan') }}</td>
                            <td>:</td>
                            <td>{{$dataanggota->pekerjaan}}</td>
                        </tr>

                        <tr>
                            <td>{{ __('NIK') }}</td>
                            <td>:</td>
                            <td>{{$dataanggota->nik}}</td>
                        </tr>

                        tr>
                            <td>{{ __('No KK') }}</td>
                            <td>:</td>
                            <td>{{$dataanggota->no_kk}}</td>
                        </tr>

                        <tr>
                            <td>{{ __('Alamat') }}</td>
                            <td>:</td>
                            <td>{!! wordwrap(implode(', ', array_filter([
                            $dataanggota->nama_jalan ?? '',
                            $dataanggota->villages->name ?? '',
                            $dataanggota->districts->name ?? '',
                            $dataanggota->city->name ?? '',
                            $dataanggota->province->name ?? ''
                        ])), 60, '<br>') !!}</td>
                        </tr>

                        <tr>
                            <td>{{ __('Kode Pos') }}</td>
                            <td>:</td>
                            <td>{{$dataanggota->kode_pos}}</td>
                        </tr>

                        <tr>
                            <td>{{ __('No. Hp / No Telepon') }}</td>
                            <td>:</td>
                            <td>{{$dataanggota->no_hp}} / {{ $dataanggota->no_no_telpon }}</td>
                        </tr>

                        <tr>
                            <td>{{ __('Bumdes') }}</td>
                            <td>:</td>
                            <td>{{$dataanggota->bumdes}}</td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- <div style="page-break-after: always;"></div> -->
            <h2>{{ __('DOKUMEN ANGGOTA') }}</h2>
            <table class="top-table-text3" width="100%">
                <tr>
                    <td>
                        <h2>Foto Diri</h2>
                        <div class="box-container">
                            <div class="box-border">
                                <img id="file-ip-1-preview" width="250" height="200"src="{{ asset('storage/' . ($file_foto[0] ?? '')) }}">
                            </div>
                        </div>
                    </td>
                    <td>
                        <h2>Foto KTP</h2>

                        <div class="box-container">
                            <div class="box-border">
                                <img id="file-ip-1-preview" width="250" height="200"src="{{ asset('storage/' . ($file_ktp[0] ?? '')) }}">
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="top-table-text2">
{{--                <p>“ Bersedia menjadi Mitra <b>KOWARGI Syariah Nusantara</b> Induk Jawa Barat dan siap mendukung program  </p>--}}
{{--                &nbsp; desa dalam ikut serta meningkatkan perputaran ekonomi lokal.”--}}
{{--                --}}
            </div>
        </div>
    </body>
</html>
