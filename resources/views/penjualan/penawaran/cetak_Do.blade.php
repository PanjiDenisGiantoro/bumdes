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
        .bg-navy  { background-color: navy }

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
            text-align: right;
            padding-right: 20px;
            font-size: 18px;
            margin-top: -106px;
            color: #3A6BBA;
        }

        .koperasi-name {
            padding-left: 8px;
            padding-bottom: -15px;
            font-size: 11px;
            /* color: black; */
        }

        .koperasi-detail {
            padding-bottom: -15px;
            font-size: 10px;
        }

        .container {
            flex: 1;
            margin: 0 8px;
            display: flex;
            flex-direction: column;
            width: 42%;
            padding-top: -10px;
        }

        ,

        .containersub {
            margin: 0 8px;
            padding-top: -60px;
            text-align: right;
            padding-right: 15px;
        }

        ,

        .containerpt {
            flex: 1;
            margin: 0 8px;
            display: flex;
            flex-direction: column;
            width: 33.33%;
            padding-top: 55px;
        }

        ,

        .orderpur {
            flex: 1;
            margin: 0 8px;
            display: flex;
            flex-direction: column;
            text-align: right;
            padding-top: -60px;
            padding-right: 8px;
            line-height: 80%;

        }

        .image-koperasi {
            margin-top: 10px;
        }

        ,

        .text-admin {
            text-align: right;
            padding-right: 35px;
            padding-top: 3px;
        }

        ,

        .top-table {
            width: 100%;
            margin-right: 20px;
            margin-left: 10px;
        }

        .namapt {
            color: #3A6BBA;
            padding-left: 8px;
            padding-top: -55px;
        }

        ,

        .tajuk {
            color: #3A6BBA;
            text-align: center;
            /*margin-top: 20px;*/
            /*padding-right: 30px;*/
        }

        ,

        .referensi {
            color: black;
            font-size: 12px;
        }

        ,

        .tanggals {
            color: black;
            font-size: 12px;
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
            padding-top: 15px;
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
        <h2 class="tajuk">Invoice Penjualan Delivery Order</h2>
        {{--        <div style="margin-left: 10px;">--}}
        {{--            <img src="{{ public_path('ksn2.jpg') }}"style="margin-left: 10px;">--}}

        {{--        </div>--}}
        <br>
        <div style="text-align: right; color: black; margin-left: 10px;">

            <table  style="width:100%;" >
                <tbody>
                <tr>
                    <td rowspan="4" >

                        <p style="font-weight: bold">{{ $perusahan[0]->nama_perusahaan ?? '' }}</p>
                        <p>{{ $perusahan[0]->alamat_utama ?? '' }} </p>
                        <p>Tel: {{ $perusahan[0]->no_telpon }} | E-mail: {{ $perusahan[0]->email_perusahaan ?? ''}}  </p>
                    </td>
                </tr>
                <tr>
                    <td  style="font-weight: bold">Referensi</td>
                    <td>{{ $penjualan->no_pemesanan ?? '' }}</td>
                </tr>
                <tr>
                    <td  style="font-weight: bold">Tanggal</td>
                    <td>{{\Carbon\Carbon::parse($penjualan->tanggal ?? '')->format('d/m/Y') ?? ''}}</td>
                </tr>
                <tr>
                    <td  style="font-weight: bold">Tanggal Jatuh Tempo</td>
                    <td></td>
                </tr>

                </tbody>
            </table>


            <br>
            <table  style="width:100%;" >
                <tbody>

                @if($penjualan->anggota == 1)

                    <tr>
                        <td rowspan="4" >
                            <p  style="font-weight: bold">{{ $penjualan->anggotas->nama_pemohon ?? '' }}</p>
                            <p>{{ $penjualan->alamat ?? '' }}  </p>
                            <p>Tel: {{ $penjualan->no_telepon ?? '' }}</p>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td rowspan="4" >
                            <p  style="font-weight: bold">{{ $penjualan->non_anggota ?? '' }}</p>
                            <p>{{ $penjualan->alamat ?? '' }}  </p>
                            <p>Tel: {{ $penjualan->no_telepon ?? '' }}</p>
                        </td>
                    </tr>


                @endif

                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>

                </tbody>
            </table>
        </div>
        {{-- <h3 class="report-title"><strong>{{ $title ?? '' }}</strong></h3> --}}

    </div>

</htmlpageheader>
<br>
<div class="struk-border">
    <table border="1" cellpadding="0" cellcollapse="collapse">
        <thead>
        <tr class="nk-tb-item ">
            <th class="nk-tb-col bg-navy" style="color: white">
                <span class="sub-text">Nama Barang</span>
            </th>
            <th class="nk-tb-col bg-navy " style="color: white">
                <span class="sub-text">QTY</span>
            </th>
            <th class="nk-tb-col bg-navy" style="color: white">
                <span class="sub-text">Harga</span>
            </th>
            <th class="nk-tb-col bg-navy" style="color: white">
                <span class="sub-text">Satuan</span>
            </th>
            <th class="nk-tb-col bg-navy"style="color: white">
                <span class="sub-text">Kategeri</span>
            </th>
            <th class="nk-tb-col bg-navy"style="color: white">
                <span class="sub-text">Kode Produk</span>
            </th>
        </tr>
        </thead>
        <tbody>
        @php $no=1; @endphp
        @foreach ($penjualanproduk as $pesananbodys => $data)
            <tr>
                <td style="border: none">
                    &nbsp; {{ $data->produks->nama_produk ?? ''}}
                </td>
                <td style="border: none">
                    &nbsp; {{ $data->qty ?? '' }}
                </td>
                <td style="border: none">
                    &nbsp; Rp {{ number_format($data->harga_produk) }}
                </td>
                <td style="border: none">
                    &nbsp; {{ $data->produks->satuan->satuan_produk ?? ''}}
                </td>
                <td style="border: none">
                   {{$data->produks->kategoris->kategori_produk}}
                </td>
                <td style="border: none">
                    &nbsp;{{$data->produks->kode_produk}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="text-admin">

    <p style="color:black; padding-top: 30px;">Dengan Hormat</p>
    <p style="padding-top: 30px; color:black;font-size:10px;">{{ $perusahan[0]->nama_perusahaan ?? '' }}</p>
</div>
</body>
</html>
