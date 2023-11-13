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

        .alamat-tajuk {
            font-size: 12px;
            text-align: center;
            padding-top: -11px;
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


        .kop {

            background-repeat: no-repeat;
            background-position: left;
            width: 20%;
            padding-left: 10px;
            padding-top: -70px;
        },

         .hr {

            height: 2px;
            background: black;
            margin-bottom: 10px;
            margin-top: 10px;

            width: 100%;
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
            <h2 class="tajuk">{{ $perusahan[0]->nama_perusahaan }}</h2>
            <p class="alamat-tajuk">{{ $perusahan[0]->alamat_utama }}</p>
            <div class="alamat-tajuk">
                <a href="#"><i>{{ $perusahan[0]->email_perusahaan }}</i></a> &nbsp;
            </div>
            <img class="kop" src="storage/perusahaan/1/logo_perusahaan" alt="">
            <div class="hr"></div>

            <h2 class="tajuk" style="padding-top:20px;">Invoice Penjualan</h2>
            <br>

            <div style="text-align: right; color: black; margin-left: 10px;">

                <table  style="width:100%;" >
                    <tbody>
                    <tr>
                        <td rowspan="4" >

                            <p  style="font-weight: bold">{{ $penjualan->anggotas->nama_pemohon ?? $penjualan->non_anggota ?? '' }}</p>
                                <p>{{ $penjualan->alamat ?? '' }}  </p>
                                <p>Tel: {{ $penjualan->no_telepon ?? '' }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td  style="font-weight: bold">Referensi</td>
                        <td>{{ $penjualan->no_pesanan ?? '' }}</td>
                    </tr>
                    <tr>
                        <td  style="font-weight: bold">Tanggal</td>
                        <td>{{\Carbon\Carbon::parse($pesanan->tanggal ?? '')->format('d/m/Y') ?? ''}}</td>
                    </tr>
                    <tr>
                        <td  style="font-weight: bold">Tanggal Jatuh Tempo</td>
                        <td>{{ $penjualan->tanggal_jatuh_tempo ?? '' }}</td>
                    </tr>

                    </tbody>
                </table>

                {{-- <table  style="width:100%;" >
                    <tbody>
                     @if($penjualan->anggota == 1)

                        <tr>
                            <td rowspan="4" >
                                <p  style="font-weight: bold">{{ $penjualan->anggotas->nama_pemohon ?? '' }}</p>
                                <p>{{ $penjualan->alamat ?? '' }}  </p>
                                <p>Tel: {{ $penjualan->no_telepon ?? '' }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td  style="font-weight: bold; padding-right: 20px;">Referensi</td>
                            <td>{{ $penjualan->no_pesanan ?? '' }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td><td  style="font-weight: bold">Tanggal</td>
                            <td>{{\Carbon\Carbon::parse($penjualan->tanggal ?? '')->format('d/m/Y') ?? ''}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td><td  style="font-weight: bold">Tanggal Jatuh Tempo</td>
                            <td>asdasd</td>
                        </tr>
                        <tr></tr>
                    @else
                        <tr>
                            <td rowspan="4" >
                                <p  style="font-weight: bold">{{ $penjualan->non_anggota ?? '' }}</p>
                                <p>{{ $penjualan->alamat ?? '' }}  </p>
                                <p>Tel: {{ $penjualan->no_telepon ?? '' }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td  style="font-weight: bold">Referensi</td>
                            <td>{{ $penjualan->no_pesanan ?? '' }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td  style="font-weight: bold">Tanggal</td>
                            <td>{{\Carbon\Carbon::parse($penjualan->tanggal ?? '')->format('d/m/Y') ?? ''}}</td>
                        </tr>

                    @endif



                    </tbody>
                </table> --}}


                <br>
            </div>
            {{-- <h3 class="report-title"><strong>{{ $title ?? '' }}</strong></h3> --}}

        </div>

    </htmlpageheader>

<br>
<div class="struk-border" style="padding-top: 140px;">
    <table border="0" cellpadding="0" cellcollapse="collapse">
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
                <span class="sub-text">Diskon</span>
            </th>
            <th class="nk-tb-col bg-navy"style="color: white;width:120px">
                <span class="sub-text">Pajak</span>
            </th>
            <th class="nk-tb-col bg-navy"style="color: white">
                <span class="sub-text">Total</span>
            </th>
        </tr>
        </thead>
        <tbody>
        @php $no=1; @endphp
        @foreach ($penjualanproduk as $pesananbodys => $data)
            <tr >
                <td style="border-bottom:1px solid black;">
                    &nbsp; {{ $data->produks->nama_produk ?? ''}}
                </td>
                <td style="border-bottom:1px solid black;">
                    &nbsp; {{ $data->qty ?? '' }}
                </td>
                <td style="border-bottom:1px solid black;">
                    &nbsp; Rp {{ number_format($data->harga_produk) }}
                </td>
                <td style="border-bottom:1px solid black;">
                    &nbsp; {{ $data->diskonproduk ?? '0'}}%
                </td>
                <td style="border-bottom:1px solid black;">
                    @if($data->total_ppn != '0')
                        {{$data->pajaks->tarif_persentase ?? ''}} PPN
                    @elseif($data->total_pph !='0')
                         {{$data->pajaks->tarif_persentase ?? ''}} PPH
                    @else
                        <b>0</b>
                    @endif
                </td>
                <td style="border-bottom:1px solid black;">
                    &nbsp; Rp {{ number_format($data->total_amount) }}
                </td>
            </tr>
        @endforeach
        </tbody>
        <tr >
            <td ></td>
            <td ></td>
            <td ></td>
            <td ></td>
            <td ></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-weight:bold">Subtotal</td>
            <td style="font-weight:bold">Rp {{ number_format($penjualan->subtotal ?? '0') }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-weight:bold">Diskon Per Item</td>
            <td style="font-weight:bold">Rp {{ number_format($penjualan->diskon_per_item ?? '0') }}</td>
        </tr>
        @if($penjualan->tipediskon == '1')
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="font-weight:bold">Diskon</td>
                <td style="font-weight:bold">Rp {{ number_format($penjualan->diskoncalculate ?? '0') }}</td>
            </tr>
        @else
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="font-weight:bold">Diskon</td>
                <td style="font-weight:bold">Rp {{ number_format($penjualan->diskontotalruiah ?? '0') }}</td>
            </tr>
        @endif
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-weight:bold">PPN</td>
            <td style="font-weight:bold">Rp {{ number_format($penjualan->PPN ?? '0') }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-weight:bold">PPH</td>
            <td style="font-weight:bold">Rp {{ number_format($penjualan->PPH ?? '0') }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-weight:bold">Biaya Pengiriman</td>
            <td style="font-weight:bold">Rp {{ number_format($penjualan->biaya_pengiriman ?? '0') }}</td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-size: 15px; color: black;"><b>Total</b></td>
            <td style="font-size: 15px; color: black;"><b>Rp {{ number_format($penjualan->total ?? '0') }}</b></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-size: 15px; color: black;"><b>Sisa Tagihan</b></td>
            <td style="font-size: 15px; color: black;"><b>Rp {{ number_format($tagihan->sisa_tagihan ?? '0') }}</b></td>
        </tr>

    </table>
</div>
<div class="">
    <p style="color:black; padding-top: 30px;text-align: right;margin-right:20px">Dengan Hormat</p>
    <p style="padding-top: 30px; color:black;font-size:10px;text-align: right;margin-right: 25px">{{ $perusahan[0]->nama_perusahaan ?? '' }}</p>
</div>
</body>
</html>
