<!DOCTYPE html>
<html> <!-- Bagian halaman HTML yang akan konvert -->
<head>
    <meta charset='UTF-8'>
    <title>Cetak Kartu Anggota Koperasi</title>
</head>
<body style="font-family: arial;font-size: 12px;position:absolute;">
<?php
?>
<style>
    li{
        color: black;
    }
</style>
<div style='width: 750px;height: 243px;margin: 50px;background-image: url({{ asset("template.png")}}'>
    <p style="position: absolute; font-family: arial; font-size: 18px; color: black; padding-left: 100px;text-transform: uppercase; text-align: center;">
        <b>Pemerintah Provinsi</b></p>
    <p style="padding-left: 123px;padding-top: 80px; "><b>KARTU ANGGOTA</b></p>
    <table style="margin-top: -10px;padding-left: 30px; position: relative;font-family: arial;font-size: 11px;">
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{$anggota->nama_pemohon ?? ''}}</td>
        </tr>
        <tr>
            <td>No. Anggota</td>
            <td>:</td>
            <td>{{$anggota->no_mitra ?? ''}}</td>
        </tr>
        </tr>
        <tr>
            <td>Tempat Lahir</td>
            <td>:</td>
            <td>{{$anggota->tempat_lahir ?? ''}}</td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td>{{date('d-m-Y', strtotime($anggota->tgl_lahir ?? ''))}}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{$anggota->jenis_kelamin ?? ''}}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{$anggota->alamat ?? ''}}</td>
        </tr>

    </table>
    <p style="padding-left: 10px;font-size: 8px; font-family: arial;position: absolute;"></p>
    <p style="margin-top: -200px;padding-left: 480px;padding-top: 10px;"><b>TATA TERTIB KOPERASI</b><br>
    <ol style="padding-left: 400px;color: #FFFFFF; font-family: arial;font-size: 11px;text-align: justify;padding-right: 10px">
        <li>Anggota Diwajibkan Membayar iuran Setiap Bulannya</li>
        <li>Menggalang kesatuan kerukunan pelajar</li>
        <li>Belajar hidup berorganisasi untuk menyiapkan diri dalam mental, moral budi pekerti yang luhur, meningkatkan
            kecerdasan dan keterampilan
        </li>
        <li>Dapat menduduki fungsinya sebagai pewaris, penerus perjuangan bangsa dan pancasila yang penuh dengan kratif,
            aktif dan disiplin Nasional demi suksesnya program pendidikan sekolah
        </li>
    </ol>
    </p><br>
    <p style="position: absolute;padding-left: 550px;margin-top: -10px;font-size: 10px; font-family: arial;">

    </p>

    @php


        @endphp
    <br>
    <p style="position: absolute;padding-left: 550px;margin-top: -10px;font-size: 10px; font-family: arial;">Mengetahui,
        <br>Kepala Koperasi</p>
    {{--    <p style="position: absolute;padding-left: 550px;margin-top: 20px;font-size: 10px; font-family: arial;"><b><u>daas</u></b><br>NIP. safds</p>--}}
</div>

</body>
</html>

