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
            padding-top: 10px;
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
            text-align: right;
            padding-top: -50px;
            padding-right: 30px;
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
            <div class="containerpt">
                <h3 class="namapt">{{ $perusahan[0]->nama_perusahaan ?? '' }}</h3>
            </div>
            <h3 class="tajuk">Sales Order</h3>
            <div style="text-align: right; color: black; padding-top: 10px;">
                <table>
                    <tbody>
                        <tr>
                            <td style="width: 140px"></td>
                            <td style="width: 10px"></td>
                            <td style="width: 320px"></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <th></th>
                            <td></td>
                            <td></td>

                            <th>Referensi</th>
                            <td></td>
                            <td>{{ $penjualan->no_pesanan ?? '' }}</td>
                        </tr>

                        <tr>
                            <th></th>
                            <td></td>
                            <td></td>

                            <th>Tanggal</th>
                            <td></td>
                            <td>{{\Carbon\Carbon::parse($penjualan->tanggal ?? '')->format('d/m/Y') ?? ''}}</td>
                        </tr>

                        <tr>
                            <th></th>
                            <td></td>
                            <td></td>

                            <th>Tgl Jatuh Tempo</th>
                            <td></td>
{{--                            <td>{{ now()->setTimezone('Asia/Jakarta')->format('d:M:Y') }}</td>--}}
                        </tr>

                    </tbody>
                </table>
            </div>
            {{-- <h3 class="report-title"><strong>{{ $title ?? '' }}</strong></h3> --}}

        </div>

    </htmlpageheader>

    <sethtmlpageheader name="pageHeader" page="0" value="0" show-this-page="1" />

    <sethtmlpagefooter name="pageFooter" page="0" value="0" show-this-page="1" />

    <div class="container">
        <h3 class="koperasi-name">{{ $perusahan[0]->nama_perusahaan ?? '' }}</h3>
        <p class="koperasi-name">{{ $perusahan[0]->alamat_utama ?? '' }} </p>
        <p class="koperasi-name">Tel: {{ $perusahan[0]->no_telpon }} | E-mail: {{ $perusahan[0]->email_perusahaan ?? ''}} </p>
    </div>

@if($penjualan->anggota == 1)

<div class="containersub">
    <h3 class="koperasi-name">{{ $penjualan->anggotas->nama_pemohon ?? '' }}</h3>
    <p class="koperasi-name"> {{ $penjualan->alamat ?? '' }} </p>
    <p class="koperasi-name">Tel: {{ $penjualan->no_telepon ?? '' }} </p>
</div>
@else

    <div class="containersub">
        <h3 class="koperasi-name">{{ $penjualan->non_anggota?? '' }}</h3>
        <p class="koperasi-name"> {{ $penjualan->alamat ?? '' }} </p>
        <p class="koperasi-name">Tel: {{ $penjualan->no_telepon ?? '' }} </p>
    </div>

    @endif

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
        @foreach ($penjualanproduk as $pesananbodys => $data)
            <tr>
{{--                <td style="border: none">&nbsp; {{ $pesananbodys+1 }}</td>--}}
                <td style="border: none">
                    &nbsp; {{ $data->produk->nama_produk ?? ''}}
                </td>
                <td style="border: none">
                    &nbsp; {{ $data->qty ?? '' }}
                </td>
                <td style="border: none">
                    &nbsp; Rp {{ number_format($data->harga_produk) }}
                </td>
                <td style="border: none">
                    &nbsp; {{ $data->diskonproduk ?? '0'}}%
                </td>
                <td style="border: none">
                    &nbsp;
                    @if($data->total_ppn != '0')
                        <b>{{$data->pajak}} PPN</b>
                    @elseif($data->total_pph !='0')
                        <b> {{$data->pajak}} PPH</b>
                    @else
                        <b>0</b>
                    @endif
                </td>
                <td style="border: none">
                    &nbsp; Rp {{ number_format($data->total) }}
                </td>
            </tr>
        @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-admin">
        <table>
            <tbody>
                <tr>
                    <td style="width: 140px"></td>
                    <td style="width: 10px"></td>
                    <td style="width: 320px"></td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <th></th>
                    <td></td>
                    <td></td>

                    <th>Subtotal</th>
                    <td></td>
                    <td>Rp {{ number_format($penjualan->subtotal ?? '0') }}</td>
                </tr>

                 <tr>
                    <th></th>
                    <td></td>
                    <td></td>

                    <th>Diskon Per Item</th>
                    <td></td>
                    <td>Rp {{ number_format($penjualan->diskon_per_item ?? '0') }}</td>
                </tr>
                @if($penjualan->tipediskon == '1')
                  <tr>
                    <th></th>
                    <td></td>
                    <td></td>

                    <th>Diskon</th>
                    <td></td>
                    <td>Rp {{ number_format($penjualan->diskoncalculate ?? '0') }}</td>
                </tr>
                  @else
<tr>
                    <th></th>
                    <td></td>
                    <td></td>

                    <th>Diskon</th>
                    <td></td>
                    <td>Rp {{ number_format($penjualan->diskontotalruiah ?? '0') }}</td>
                </tr>
                    @endif
                 <tr>
                    <th></th>
                    <td></td>
                    <td></td>

                    <th>PPN</th>
                    <td></td>
                    <td>Rp {{ number_format($penjualan->PPN ?? '0') }}</td>
                </tr>
                 <tr>
                    <th></th>
                    <td></td>
                    <td></td>

                    <th>PPH</th>
                    <td></td>
                    <td>Rp {{ number_format($penjualan->PPH ?? '0') }}</td>
                </tr>
                 <tr>
                    <th></th>
                    <td></td>
                    <td></td>

                    <th>Biaya Pengiriman</th>
                    <td></td>
                    <td>Rp {{ number_format($penjualan->biaya_pengiriman ?? '0') }}</td>
                </tr>

                <tr>
                    <th></th>
                    <td></td>
                    <td></td>

                    <th style="font-size: 15px; color: black;">Total</th>
                    <td></td>
                    <td style="font-size: 15px; color: black;"><b>Rp {{ number_format($penjualan->total ?? '0') }}</b></td>
                </tr>

            </tbody>
        </table>

        <p style="color:black; padding-top: 30px;">Dengan Hormat</p>
        <p style="padding-top: 30px; color:black;font-size:10px;">{{ $perusahan[0]->nama_perusahaan ?? '' }}</p>
    </div>
</body>
</html>
