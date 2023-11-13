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
            color: #526484;
            text-align: left;
            background-color: #f5f6fa;
            min-width: 320px;
        }
        table {
            /* border: none; */
            border-collapse: collapse;
            font-size: 8pt;
        }
        th, td {
            padding-left: 5px;
            padding-right: 5px;
            color: black;
        }
        th {
            border-top: 1px solid #000 !important;
            border-bottom: 1px solid #000 !important;
        }
        .bg-white {
            background-color: #fff !important;
        }
        .main-body {
            width: 100%;
            height: 100%;
            border-right: 1px solid #7a7a7a;
            border-left: 1px solid #7a7a7a;
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 20px;
        }
        .top-table {
            width: 100%;
        }
        .border-partial {
            border-right: 1px solid black;
            border-bottom: 1px dashed rgba(173, 173, 173, 0.99);
        }
        .border-thin {
            border-top: 1px solid rgba(173, 173, 173, 0.99) ;
            border-right: 1px solid rgba(173, 173, 173, 0.99);
            border-left: 1px solid rgba(173, 173, 173, 0.99);
            border-bottom: 1px solid rgba(173, 173, 173, 0.99);
            /* border-color: rgba(214, 214, 214, 0.99); */
        }
        .row-top-border {
            border-top: 1px solid #8f8f8f;
        }
        .title-text{
            font-size: 12px;
            margin-left: 5px;
        }
        </style>
    </head>

    <body class="bg-white">

        <div class="main-body">

            <table class="top-table">
                <tbody>
                    <tr>
                        <td style="width: 140px">KOPERASI KONSUMEN </td>
                        <td style="width: 10px"></td>
                        <td style="width: 320px"></td>

                        <td>KOWARGI SYARIAH NUSANTARA</td>
                        <td></td>
                        <!-- <td> {{ date('d-m-Y') }}</td>  -->

                    </tr>
                    <tr>
                        <td>KOWARGI SYARIAH NUSANTARA</td>
                        <td></td>
                       <!--
                        <td>No. Transaksi</td>
                        <td>:</td>
                        <td></td> -->
                    </tr>
                    <tr>
                        <!-- <td>Nama</td>
                        <td>:</td>
                        <td></td>

                        <td>Teller</td>
                        <td>:</td>
                        <td></td> -->

                    </tr>
                    <tr>
                        <td>Jl. Telekomunikasi No 1 Gedung Bandung Techno Park(BTP) Kav. B101</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>www.gerbangdesanusantara.id     www.dagangbareng.id</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <!-- <br> -->
            <!-- <h5 style="color:black;">Keterangan</h5> -->
            <table>
                <tr>
                    <td style="padding-top: -15px; font-family:'Courier New'"></td>
                </tr>
            </table>
            <br>

            <table class="table mb-0">
                <thead>
                <tr>
                    <th>{{ __('No') }}</th>
                    <th>{{ __('Nama') }}</th>
                    <th>{{ __('Tipe Kontak') }}</th>
                    <th>{{ __('Perusahaan') }}</th>
                    <th>{{ __('Alamat') }}</th>
                    <th>{{ __('No Telepon / HP') }}</th>
                    <th>{{ __('Hutang') }}</th>\
                    <th>{{ __('Piutang') }}</th>
                </tr>
                </thead>
                <tbody>
                @php $no=1;@endphp
                    <tr>
                        <td class="col-lg-none">{{$no++}}</td>
                        <td>{{$daftar_kontaks->nama_kontak}}</td>
                        <td>{{$daftar_kontaks->id_tipe_kontak}}</td>
                        <td>{{$daftar_kontaks->nama_perusahaan}}</td>
                        <td>{{$daftar_kontaks->alamat_perusahaan}}</td>
                        <td>{{$daftar_kontaks->no_telp}}</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </body>
</html>
