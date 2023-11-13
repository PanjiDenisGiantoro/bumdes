<html>
<head>
    <style>
        @page {
            header: html_pageHeader;
            footer: html_pageFooter;
            margin-top: 60mm;
            margin-bottom: 5%;
            margin-header: 5mm;
            margin-footer: 5mm;
        }

        .header-border {
            border-left: 1px solid #7a7a7a;
            border-right: 1px solid #7a7a7a;
            border-top: 1px solid #7a7a7a;
            height: 100%;
            display: flex;
            align-items: start;
            /* border-bottom: 1p x dashed #7a7a7a; */
            /* padding-bottom: 50px; */
            /* margin-bottom: 86px; */
        }

        .footer-border {
            border-left: 1px solid #7a7a7a;
            border-right: 1px solid #7a7a7a;
            /* border-top: 1px dashed #7a7a7a; */
            border-bottom: 1px solid #7a7a7a;
        }

        .report-title {
            text-align: center;
            font-size: 18px;
            margin-top: -170px;
            color: black;
        }

        .koperasi-name {
            padding-left: 1 px;
            padding-bottom: -15px;
            font-size: 11px;
            /* color: black; */
        }

        .koperasi-detail {
            padding-bottom: -15px;
            font-size: 10px;
        }

        ,

        .container {
            flex: 1;
            margin: 0 8px;
            display: flex;
            flex-direction: column;
            width: 33.33%;
        },

        .image-koperasi {
            margin-top: 10px;
        },

        .text-admin {
            text-align: right;
            padding-right: 50px;
        }

        body {
            display: block;
            margin: 0;
            font-family: Roboto, sans-serif, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
            font-size: .875rem;
            font-weight: 400;
            line-height: 1.65;
            color: #526484;
            text-align: left;
            background-color: #f5f6fa;
            min-width: 320px;
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

        .sub-title {
            color: #333;
            text-align: left;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            font-size: 11px;
            color: #333;
            /* border: 1px solid #666666; */
            padding: 7px;
            font-weight: bold;
            text-align: left;
            /* font-family: 'consolas'; */
        }

        td {
            font-size: 11px;
            /* border-bottom: 1px solid #666666; */
            padding: 1px;
            padding-bottom: 1px;
        }

    </style>
</head>

<body class="bg-white">
    <htmlpagefooter name="pageFooter">
        <table width="100%">
            <tr>
                <td width="50%" style="font-size: 12px;">{{ date('d-m-Y') }} - {{ now()->setTimezone('WIB')->format('H:i') }}</td>
                <td width="50%" style="text-align: right; font-size: 12px">{PAGENO}/{nbpg}</td>
            </tr>
        </table>
    </htmlpagefooter>

    <sethtmlpagefooter name="pageFooter" />

    <htmlpageheader name="pageHeader">
        <div class="header-border">
            <div class="container">
                <img class="image-koperasi" src="https://statik.tempo.co/data/2019/03/29/id_830337/830337_720.jpg" width="100" height="100">
                <h3 class="koperasi-name">{{ $perusahan[0]->nama_perusahaan ?? '' }}</h3>
                <p class="koperasi-name">{{ $perusahan[0]->alamat_utama ?? '' }} </p>
                <p class="koperasi-name">Tel: {{ $perusahan[0]->no_telpon }} | E-mail: {{ $perusahan[0]->email_perusahaan ?? ''}} </p>
            </div>
            {{-- <h3 class="report-title"><strong>{{ $title ?? '' }}</strong></h3> --}}
            <h5 class="report-title"><strong>{{ 'Invoice' }}</strong></h5>
        </div>

    </htmlpageheader>

    <sethtmlpageheader name="pageHeader" page="0" value="0" show-this-page="1" />

    <sethtmlpagefooter name="pageFooter" page="0" value="0" show-this-page="1" />

    <table class="top-table" style="border: none">
        <tbody>
            <tr>
                <td style="width: 140px"></td>
                <td style="width: 10px"></td>
                <td style="width: 320px"></td>

                <!--  <td></td>
                        <td style="width: 10px"></td>
                        <td></td> -->
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>

                <!-- <td></td>
                        <td></td>
                        <td></td> -->
            </tr>

            <tr>
                <th>Nama Pelanggan</th>
                <td>:</td>
                <td>{{ now()->setTimezone('Asia/Jakarta')->format('h:ia') }}</td>

                <th>No Pesanan</th>
                <td>:</td>
                <td>{{ now()->setTimezone('Asia/Jakarta')->format('h:ia') }}</td>
            </tr>
            <tr>
                <th>No Telepon</th>
                <td>:</td>
                <td>{{ now()->setTimezone('Asia/Jakarta')->format('h:ia') }}</td>

                <th>Tanggal Pemesanan</th>
                <td>:</td>
                <td>{{ now()->setTimezone('Asia/Jakarta')->format('h:ia') }}</td>
            </tr>

            <tr>
                <th>Alamat</th>
                <td>:</td>
                <td>{{ now()->setTimezone('Asia/Jakarta')->format('h:ia') }}</td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td>
                <td>
            </tr>
        </tbody>
    </table>
    <div style="height: 10px;">
    </div>
    <div class="struk-border">
        <table border="1" cellpadding="0" cellcollapse="collapse">
            <thead>
                <tr class="nk-tb-item nk-tb-head">
                    <th class="nk-tb-col">
                        <span class="sub-text">No</span>
                    </th>
                    <th class="nk-tb-col">
                        <span class="sub-text">Nama Barang</span>
                    </th>
                    <th class="nk-tb-col" style="white-space: nowrap;">
                        <span class="sub-text">QTY</span>
                    </th>
                    <th class="nk-tb-col" style="white-space: nowrap;">
                        <span class="sub-text">Harga</span>
                    </th>
                    <th class="nk-tb-col">
                        <span class="sub-text">Diskon</span>
                    </th>
                    <th class="nk-tb-col">
                        <span class="sub-text">Total</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @php $no=1; @endphp
                <tr class="nk-tb-item">
                    <td class="nk-tb-col">&nbsp; {{$no++}}</td>
                    <td class="nk-tb-col" style="white-space: normal;">&nbsp; 2332</td>
                    <td class="nk-tb-col text-center">&nbsp; Ade setiawan</td>
                    <td class="nk-tb-col" style="white-space: normal;">&nbsp; 989898</td>
                    <td class="nk-tb-col text-center">&nbsp; 2 Lapak</td>
                    <td class="nk-tb-col text-center">&nbsp; Rp. 1232323</td>
                </tr>
                <tr class="nk-tb-item">
                    <td rowspan="2" colspan="4"></td>
                </tr>
                <tr class="nk-tb-item">
                    <td class="nk-tb-col text-center">&nbsp; 2 Lapak</td>
                    <td class="nk-tb-col text-center">&nbsp; Rp. 1232323</td>
                </tr>
                <tr class="nk-tb-item">
                    <td rowspan="2" colspan="4"></td>
                </tr>
                <tr class="nk-tb-item">
                    <td class="nk-tb-col text-center">&nbsp; 2 Lapak</td>
                    <td class="nk-tb-col text-center">&nbsp; Rp. 1232323</td>
                </tr>
                <tr class="nk-tb-item">
                    <td rowspan="2" colspan="4"></td>
                </tr>
                <tr class="nk-tb-item">
                    <td class="nk-tb-col text-center">&nbsp; 2 Lapak</td>
                    <td class="nk-tb-col text-center">&nbsp; Rp. 1232323</td>
                </tr>
                <tr class="nk-tb-item">
                    <td rowspan="2" colspan="4"></td>
                </tr>
                <tr class="nk-tb-item">
                    <td class="nk-tb-col text-center">&nbsp; 2 Lapak</td>
                    <td class="nk-tb-col text-center">&nbsp; Rp. 1232323</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="text-admin">
        <h5>Koperasi Kowargi</h5>
        <h5 style="padding-top: 30px;">Admin</h5>
    </div>
</body>
</html>
