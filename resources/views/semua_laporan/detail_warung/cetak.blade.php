<html>
<head>
    <style>
        @page {
            header: pageHeader;
            footer: pageFooter;
            margin-top: 60mm;
            margin-bottom: 5%;
            margin-header: 5mm;
            margin-footer: 5mm;
        }

        .bg-navy  { background-color: grey }

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

        
        

        .kop {

            background-repeat: no-repeat;
            background-position: left;
            width: 20%;
            padding-left: 10px;
            padding-top: -70px;
        },

         .hr {
            
            height: 1px;
            background: grey;
            margin-bottom: 10px;
            margin-top: 10px;
             
            width: 100%;
        }

    #customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border-bottom: none;
  border-right: 1px solid #ddd;  
  padding: 8px;
}


#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #b5b5b5;
  color: white;
}

body {
  padding: 1rem;
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
            <h2 class="tajuk">{{ $usaha[0]->nama_perusahaan }}</h2>
            <p class="alamat-tajuk">{{ $usaha[0]->alamat_utama }}</p>
            <div class="alamat-tajuk">
                <a href="#"><i>{{ $usaha[0]->email_perusahaan }}</i></a> &nbsp; <a href="#"><i>www.dagangbareng.id</i></a>
            </div>
            <img class="kop" src="storage/perusahaan/1/logo_perusahaan" alt="">
            <div class="hr"></div>
        
            <h2 class="tajuk" style="padding-top:20px;">Laporan Detail Warung</h2>
            <br>

            <div style="text-align: right; color: black; margin-left: 10px;">


                <br>
            </div>
            {{-- <h3 class="report-title"><strong>{{ $title ?? '' }}</strong></h3> --}}

        </div>

    </htmlpageheader>

<br>
<div class="struk-border" style="padding-top: 40px;">
    {{-- @include('report-layout', ['title' => 'Laporan Detail Keanggotaan']) --}}
    <table id="customers">
    <tr>
        <th>No</th>
        <th>Tanggal Register</th>
        <th>No Anggota</th>
        <th>Nama Lengkap</th>
        <th>NIK</th>
        <th>Provinsi</th>
        <th>BUMDES</th>
        <th>Nama Warung</th>
        <th>Status Warung</th>
    </tr>
    @foreach($daftar_warung as $i => $data)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{\Carbon\Carbon::parse($data->tanggal)->format('d/m/Y') ?? '-'}}</td>
            <td>{{ $data->anggota->no_mitra ?? '-' }}</td>
            <td>{{ $data->anggota->nama_pemohon ?? '-' }}</td>
            <td>{{ "'" . $data->anggota->nik ?? '-' }}</td>
            <td>{{ $data->alamat_sama ? ($data->anggota->province ?? '-') : ($data->province->name ?? '-') }}</td>
            <td>{{ $data->anggota->bumdes ?? '-' }}</td>
            <td>{{ $data->nama_warung ?? '-'}}</td>
            <td>{{ $data->status_aktif_text ?? '-'}}</td>
       </tr>
    @endforeach
    </table>
</div>
</body>
</html>
