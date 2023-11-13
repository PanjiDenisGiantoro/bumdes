@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Laporan') }}">
        <li class="breadcrumb-item">
            {{ __('Laporan') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">&nbsp;{{ __('Laporan Keuangan') }}</h3>
            </div>
            <div class="card-body">
                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('neraca_financial.index') }}">
                    Neraca Saldo
                </a>

                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('neraca_akuntansi.index') }}">
                    Neraca
                </a>

                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('laba_rugi.index') }}">
                    Laba Rugi
                </a>

                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('arus_kas.index') }}">
                    Arus Kas
                </a>

                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('perubahan_modal.index') }}">
                    Perubahan Modal
                </a>

                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('jurnal_entry.index') }}">
                    Jurnal Listing
                </a>

                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('buku_besar.index') }}">
                    Buku Besar
                </a>

                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('ringkasan_bank.index') }}">
                    Ringkasan Bank
                </a>

                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('ringkasan_hutang_piutang.index') }}">
                    Ringkasan Hutang Piutang
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">&nbsp;{{ __('Laporan Biaya') }}</h3>
            </div>
            <div class="card-body">
                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('biaya_per_kontak.index') }}">
                    Biaya Per Kontak
                </a>

{{--                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('detail_klaim_biaya.index') }}">--}}
{{--                    Detail Klaim Biaya--}}
{{--                </a>--}}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">&nbsp;{{ __('Laporan Pajak') }}</h3>
            </div>
            <div class="card-body">
                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('pajak_penjualan.index') }}">
                    Pajak Penjualan
                </a>

{{--                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('pajak_pemotongan.index') }}">--}}
{{--                    Pajak Pemotongan--}}
{{--                </a>--}}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">&nbsp;{{ __('Laporan Inventori') }}</h3>
            </div>
            <div class="card-body">
                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('ringkasan_inventori.index') }}">
                    Ringkasan Inventori
                </a>

                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('pergerakan_stok_inventori.index') }}">
                    Pergerakan Stok Inventori
                </a>

{{--                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('ringkasan_stok_gudang.index') }}">--}}
{{--                    Ringkasan Stok Gudang--}}
{{--                </a>--}}

{{--                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('pergerakan_stok_gudang.index') }}">--}}
{{--                    Pergerakan Stok Gudang--}}
{{--                </a>--}}

{{--                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('laporan_produksi.index') }}">--}}
{{--                    Laporan Produksi--}}
{{--                </a>--}}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">&nbsp;{{ __('Laporan Aset Tetap') }}</h3>
            </div>
            <div class="card-body">
                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('ringkasan_aset_tetap.index') }}">
                    Ringkasan Aset Tetap
                </a>

{{--                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('detail_aset_tetap.index') }}">--}}
{{--                    Detail Aset Tetap--}}
{{--                </a>--}}

                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('pelepasan_aset.index') }}">
                    Pelepasan Aset
                </a>
            </div>
        </div>
    </div>
</div>

{{--<div class="row">--}}
{{--    <div class="col-md-12 col-lg-12">--}}
{{--        <div class="card">--}}
{{--            <div class="card-header">--}}
{{--                <h3 class="card-title">&nbsp;{{ __('Laporan Anggaran') }}</h3>--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('manajemen_anggaran.index') }}">--}}
{{--                    Manajemen Anggaran--}}
{{--                </a>--}}

{{--                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('anggaran_laba_rugi.index') }}">--}}
{{--                    Anggaran Laba Rugi--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">&nbsp;{{ __('Laporan Penjualan') }}</h3>
            </div>
            <div class="card-body">
                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('detail_penjualan.index') }}">
                    Detil Penjualan
                </a>

                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('umur_piutang.index') }}">
                    Umur Piutang
                </a>

                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('tagihan_pelanggan.index') }}">
                    Tagihan Pelanggan
                </a>

                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('pendapatan_per_pelanggan.index') }}">
                    Pendapatan Per Pelanggan
                </a>

                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('penjualan_per_produk.index') }}">
                    Penjualan Per Produk
                </a>

{{--                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('penjualan_per_sales_person.index') }}">--}}
{{--                    Penjualan Per Sales Person--}}
{{--                </a>--}}

{{--                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('pengiriman_penjualan.index') }}">--}}
{{--                    Pengiriman Penjualan--}}
{{--                </a>--}}


            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">&nbsp;{{ __('Laporan Pembelian') }}</h3>
            </div>
            <div class="card-body">
                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('detail_pembelian.index') }}">
                    Detil Pembelian
                </a>

                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('umur_hutang.index') }}">
                    Umur Hutang
                </a>

                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('tagihan_vendor.index') }}">
                    Tagihan Supplier
                </a>

                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('pembelian_per_produk.index') }}">
                    Pembelian Per Produk
                </a>

                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('pembelian_per_vendor.index') }}">
                    Pembelian Per Supplier
                </a>

{{--                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('pengiriman_pembelian.index') }}">--}}
{{--                    Pengiriman Pembelian--}}
{{--                </a>--}}
                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('ongkos_kirim_per_kiriman.index') }}">
                    Biaya Ekspedisi
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">&nbsp;{{ __('Laporan Keanggotaan') }}</h3>
            </div>
            <div class="card-body">
                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('laporan-keanggotaan.index') }}">
                    Detil Keanggotaan
                </a>
                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('laporan-anggota-product.index') }}">
                    Produk
                </a>
                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('laporan-warung.index') }}">
                    Detil Warung
                </a>

                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('laporan-pembiayaan.index') }}">
                    Detil Pendanaan
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">&nbsp;{{ __('Laporan Rekening Simpanan') }}</h3>
            </div>
            <div class="card-body">
                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('laporan-rekening-simpanan.produk') }}">
                    Produk
                </a>
                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('laporan-rekening-simpanan.rekening') }}">
                    Rekening
                </a>
                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('laporan-rekening-simpanan.bagi-hasil') }}">
                    Bagi Hasil
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">&nbsp;{{ __('Laporan Rekening Simpanan Berjangka') }}</h3>
            </div>
            <div class="card-body">
                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('laporan-rekening-simpanan-berjangka.produk') }}">
                    Produk
                </a>
                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('laporan-rekening-simpanan-berjangka.rekening') }}">
                    Rekening
                </a>
                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('laporan-rekening-simpanan-berjangka.bagi-hasil') }}">
                    Bagi Hasil
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">&nbsp;{{ __('Laporan Pembiayaan') }}</h3>
            </div>
            <div class="card-body">
                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('laporan-rekening-pembiayaan.produk') }}">
                    Produk
                </a>
                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('laporan-rekening-pembiayaan.rekening') }}">
                    Rekening
                </a>
                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('laporan-rekening-pembiayaan.kolekbilitas') }}">
                    Kolektibilitas
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">&nbsp;{{ __('Laporan AO') }}</h3>
            </div>
            <div class="card-body">
                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('laporan-ao-daftar-rekening') }}">
                    Daftar Rekening
                </a>
                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('laporan-ao.rekening-baru') }}">
                    Pembukaan Rekening Baru
                </a>
                <a class="btn btn-primary my-btn mb-2 mr-2" style="font-size: 15px; width: 250px" href="{{ route('laporan-ao.kolektibitas') }}">
                    Kolektibilitas
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
