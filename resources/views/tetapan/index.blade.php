@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Pengaturan') }}">
{{--        <li class="breadcrumb-item">--}}
{{--            {{ __('Pengaturan') }}--}}
{{--        </li>--}}
    </x-breadcrumb>
@endsection

@section('content')
<style type="text/css">
    .mdi, .fa-xl{
        font-size: 50px;
    }
     .zmdi{
        font-size: 50px;
    }
    .fa-xl{
        padding:12px;
    }
    li.col-lg-3{
        margin-bottom: 50px;
    }
    /*.box{
        border:1px solid black;
    }*/
</style>
 <div class="container">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview wide-md mx-auto">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                        </div>
                    </div>
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"></h3>
                        </div>
                        <div class="nk-block-des">
                            <p class="lead">Utama</p>
                        </div>
                    </div>
                    <ul class="row g-gs preview-icon-svg">
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <div class="box">
                                @if(!empty($profil))
                                    <a href="{{ route('kode_perusahaan.edit',1) }}" class="w-100">

                                @else
                                    <a href="{{ route('kode_perusahaan.index') }}" class="w-100">
                                    @endif
                                <i class="fa fa-building fa-xl"></i>
                                <br>

                                <!-- <div class="preview-icon-wrap">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="">
                                        <rect x="5" y="5" width="53.97" height="69.95" rx="7" ry="7" fill="#e3e7fe"
                                            stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"></rect>

                                    </svg>
                                </div> -->
                                <span class="preview-icon-name">Profil Koperasi</span>
                            </a>
                            </div>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('pengurusan.index') }}"
                                class="w-100">
                                 <i class="mdi mdi-account-settings-variant"></i>
                                <br>
                                <span class="preview-icon-name"> Pengurusan</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('kode_pengguna.index') }}"
                               class="w-100">
                                <i class="fa fa-briefcase fa-xl"></i>
                                <br>
                                <span class="preview-icon-name"> Unit Kerja</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('kode_profil.index') }}"
                                class="w-100">
                                 <i class="mdi mdi-account-outline"></i>
                                <br>
                                <span class="preview-icon-name"> Pegawai</span>
                            </a>
                        </li>

{{--                        <li class="col-lg-3 col-6 col-sm-4 text-center">--}}
{{--                            <a href="{{ route('kode_sistem.index') }}" class="w-100">--}}
{{--                                 <i class="fa fa-cog fa-xl"></i>--}}
{{--                                <a href="{{route('googlemap.all')}}">sda</a>--}}
{{--                                <a href="{{route('googlemap.create')}}">sda</a>--}}
{{--                                <a href="{{route('googlemap.preview')}}">sda</a>--}}
{{--                                <br>--}}


{{--                                <span class="preview-icon-name">Kode Sistem</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                        <li class="col-lg-3 col-6 col-sm-4 text-center" hidden>
                            <a href="{{ route('kode_daftar_pengguna.index') }}" class="w-100">
                                 <i class="mdi mdi-account-multiple"></i>
                                <br>

                                <span class="preview-icon-name"> Pengguna</span>
                            </a>
                        </li>
                        <br>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('kode_hak_akses.index') }}" class="w-100">
                                 <i class="mdi mdi-xml"></i>
                                <br>
                                <!-- <div class="preview-icon-wrap">
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox=""><rect x="12" y="5" width="55" height="68" rx="6" ry="6" fill="#e3e7fe" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><path d="M78,15.8l-5.72,6.33L66.7,16l-5.33,5.91-5.82-6.46L49.67,22,44.13,15.8l-5.49,6.09L33,15.62,27.27,22l-6.16-6.83L21,15V79c0,3.33,2.43,6,5.43,6H72.57c3,0,5.43-2.69,5.43-6V15.76S77.94,15.79,78,15.8Z" fill="#fff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><circle cx="49.5" cy="35.5" r="2.5" fill="#c4cefe" stroke="#c4cefe" stroke-miterlimit="10" stroke-width="2"/><line x1="71" y1="50" x2="28" y2="49.86" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><line x1="71" y1="56" x2="28" y2="55.86" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><line x1="71" y1="61" x2="28" y2="60.86" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><line x1="28" y1="45" x2="38" y2="45" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><line x1="61" y1="45" x2="71" y2="45" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><line x1="28" y1="76" x2="41" y2="76" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><line x1="61" y1="76" x2="69" y2="76" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><line x1="59" y1="66" x2="69" y2="66" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                                </div> -->
                                <span class="preview-icon-name"> Hak Akses</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('status_keanggotaan.index') }}" class="w-100">
                                <i class="mdi fa fa-address-card"></i>
                                <br>
                                <!-- <div class="preview-icon-wrap">
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox=""><rect x="12" y="5" width="55" height="68" rx="6" ry="6" fill="#e3e7fe" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><path d="M78,15.8l-5.72,6.33L66.7,16l-5.33,5.91-5.82-6.46L49.67,22,44.13,15.8l-5.49,6.09L33,15.62,27.27,22l-6.16-6.83L21,15V79c0,3.33,2.43,6,5.43,6H72.57c3,0,5.43-2.69,5.43-6V15.76S77.94,15.79,78,15.8Z" fill="#fff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><circle cx="49.5" cy="35.5" r="2.5" fill="#c4cefe" stroke="#c4cefe" stroke-miterlimit="10" stroke-width="2"/><line x1="71" y1="50" x2="28" y2="49.86" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><line x1="71" y1="56" x2="28" y2="55.86" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><line x1="71" y1="61" x2="28" y2="60.86" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><line x1="28" y1="45" x2="38" y2="45" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><line x1="61" y1="45" x2="71" y2="45" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><line x1="28" y1="76" x2="41" y2="76" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><line x1="61" y1="76" x2="69" y2="76" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><line x1="59" y1="66" x2="69" y2="66" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                                </div> -->
                                <span class="preview-icon-name"> Kategori Keanggotaan</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('cabang.index') }}" class="w-100">
                                <i class="mdi fa fa-address-book"></i>
                                <br>
                                <!-- <div class="preview-icon-wrap">
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox=""><rect x="12" y="5" width="55" height="68" rx="6" ry="6" fill="#e3e7fe" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><path d="M78,15.8l-5.72,6.33L66.7,16l-5.33,5.91-5.82-6.46L49.67,22,44.13,15.8l-5.49,6.09L33,15.62,27.27,22l-6.16-6.83L21,15V79c0,3.33,2.43,6,5.43,6H72.57c3,0,5.43-2.69,5.43-6V15.76S77.94,15.79,78,15.8Z" fill="#fff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><circle cx="49.5" cy="35.5" r="2.5" fill="#c4cefe" stroke="#c4cefe" stroke-miterlimit="10" stroke-width="2"/><line x1="71" y1="50" x2="28" y2="49.86" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><line x1="71" y1="56" x2="28" y2="55.86" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><line x1="71" y1="61" x2="28" y2="60.86" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><line x1="28" y1="45" x2="38" y2="45" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><line x1="61" y1="45" x2="71" y2="45" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><line x1="28" y1="76" x2="41" y2="76" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><line x1="61" y1="76" x2="69" y2="76" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><line x1="59" y1="66" x2="69" y2="66" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                                </div> -->
                                <span class="preview-icon-name"> Cabang</span>
                            </a>
                        </li>

                    </ul>

                    <br>

                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"></h3>
                        </div>
                        <div class="nk-block-des">
                            <p class="lead">Kode</p>
                        </div>
                    </div>
                    <ul class="row g-gs preview-icon-svg">
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('kode_bidang_usaha.index') }}"
                                class="">
                                 <i class="fa fa-calculator fa-xl"></i>
                                <br>


                                <span class="preview-icon-name">Bidang Usaha</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('kode_status_bangunan.index') }}"
                                class="">
                                 <i class="fa fa-institution fa-xl"></i>
                                <br>

                                <span class="preview-icon-name">Status Bangunan</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('kode_status_keluarga.index') }}"
                                class="">
                                 <i class="fa fa-users fa-xl"></i>
                                <br>


                                <span class="preview-icon-name">Status Dalam Keluarga</span>
                            </a>
                        </li>

                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('kode_pendidikan.index') }}"
                                class="">
                                 <i class="fa fa-mortar-board fa-xl"></i>
                                <br>

                                <span class="preview-icon-name">Pendidikan</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('kode_status_pembiayaan.index') }}"
                                class="">
                                 <i class="fa fa-money fa-xl"></i>
                                <br>
                                <span class="preview-icon-name">Tipe Pendanaan</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('kelompok_aset.index') }}"
                               class="">
                                <i class="fa fa-cubes fa-xl"></i>
                                <br>
                                <span class="preview-icon-name">kelompok Aset</span>
                            </a>
                        </li>
                    </ul>
                    <br>
{{--                    <div class="nk-block-head">--}}
{{--                        <div class="nk-block-head-content">--}}
{{--                            <h3 class="nk-block-title page-title"></h3>--}}
{{--                        </div>--}}
{{--                        <div class="nk-block-des">--}}
{{--                            <p class="lead">Kontak</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <ul class="row g-gs preview-icon-svg">--}}

{{--                        <li class="col-lg-3 col-6 col-sm-4 text-center">--}}
{{--                            <a href="{{ route('tipe_kontak_group.index') }}"--}}
{{--                                class="w-100">--}}
{{--                                 <i class="fa fa-id-card fa-xl"></i>--}}
{{--                                <br>--}}

{{--                                <span class="preview-icon-name">Tipe Kode Group</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
                    <br>

                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"></h3>
                        </div>
                        <div class="nk-block-des">
                            <p class="lead">Keuangan</p>
                        </div>
                    </div>
                    <ul class="row g-gs preview-icon-svg">
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('akun_perkiraan.index') }}"
                                class="">
                                 <i class="fa fa-address-book fa-xl"></i>
                                <br>


                                <span class="preview-icon-name">Akun Perkiraan</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">

                            @if(!empty($pemetaan))
                                <a href="{{ route('pemetaan_akun.edit',1) }}" class="w-100">

                                    @else
                                        <a href="{{ route('pemetaan_akun.index') }}"
                                           class="">                                            @endif

                                 <i class="fa fa-close fa-xl"></i>
                                <br>

                                <span class="preview-icon-name">Pemetaan Akun</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('perpajakan_keuangan.index') }}"
                                class="">
                                 <i class="fa fa-credit-card fa-xl"></i>
                                <br>


                                <span class="preview-icon-name">Perpajakan</span>
                            </a>
                        </li>

                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('kode_kelompok.index') }}"
                                class="">
                                 <i class="fa fa-user-circle fa-xl"></i>
                                <br>

                                <span class="preview-icon-name">Kode Kelompok</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('jenis_transaksi.index') }}"
                                class="">
                                 <i class="fa fa-dollar fa-xl"></i>
                                <br>

                                <span class="preview-icon-name">Jenis Transaksi</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('persetujuan_keuangan.index') }}"
                                class="">
                                 <i class="fa fa-check-circle fa-xl"></i>
                                <br>


                                <span class="preview-icon-name">Persetujuan</span>
                            </a>
                        </li>

                    </ul>
                    <br>

                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"></h3>
                        </div>
                        <div class="nk-block-des">
                            <p class="lead">Kontak</p>
                        </div>
                    </div>
                    <ul class="row g-gs preview-icon-svg">
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('pembelian.setting.supplier.index') }}"
                               class="">
                                <br>
                                <i class="fe fe-package fa-xl" style="font-size: 50px;"></i>
                                <br>
                                <span class="preview-icon-name">Kontak</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <div class="box">
                                <a href="{{ route('tipe_kontak.index') }}" class="w-100">
                                    <i class="fa fa-address-card fa-xl"></i>
                                    <br>
                                    <span class="preview-icon-name">Tipe Kontak</span>
                                </a>
                            </div>
                        </li>
                    </ul>

                    <br>


                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"></h3>
                        </div>
                        <div class="nk-block-des">
                            <p class="lead">Produk</p>
                        </div>
                    </div>

                    <ul class="row g-gs preview-icon-svg">
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('kategori_produk.index') }}"
                                class="">
                                 <i class="fa fa-product-hunt fa-xl"></i>
                                <br>


                                <span class="preview-icon-name">Kategori Produk</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('satuan_produk.index') }}"
                                class="">
                                 <i class="mdi mdi-cube"></i>
                                <br>

                                <span class="preview-icon-name">Satuan</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('kode_sku.index') }}"
                                class="">
                                 <i class="fa fa-user fa-xl"></i>
                                <br>


                                <span class="preview-icon-name">Kode SKU</span>
                            </a>
                        </li>

                        <!-- <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('gudang_produk.index') }}"
                                class="">
                                 <i class="mdi mdi-garage"></i>
                                <br>

                                <span class="preview-icon-name">Gudang</span>
                            </a>
                        </li> -->
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('berat_satuan.index') }}"
                               class="">
                                <i class="mdi mdi-animation"></i>
                                <br>

                                <span class="preview-icon-name">Berat Satuan</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('setting_termin_penjualan.index') }}"
                                class="">
                                 <i class="fa fa-calendar fa-xl"></i>
                                <br>

                                <span class="preview-icon-name">Termin</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('ekspedisi_penjualan.index') }}"
                                class="">
                                 <i class="fa fa-truck fa-xl"></i>
                                <br>

                                <span class="preview-icon-name">Ekspedisi</span>
                            </a>
                        </li>

                    </ul>
                    <br>

                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"></h3>
                        </div>
                        <div class="nk-block-des">
                            <p class="lead">Rekening</p>
                        </div>
                    </div>
                    <ul class="row g-gs preview-icon-svg">
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('produk-simpanan.index') }}"class="">
                                <i class="mdi mdi-cube"></i>
                                <br>
                                <span class="preview-icon-name">Produk Rekening</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('akad.index') }}"class="">
                                <i class="mdi mdi-basket"></i>
                                <br>
                                <span class="preview-icon-name">Akad</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('tujuan_pengajuan.index') }}"class="">
                                <i class="mdi mdi-basket-fill"></i>
                                <br>
                                <span class="preview-icon-name">Tujuan Pengajuan</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('sumber_dana.index') }}"class="">
                                <i class="fa fa-modx fa-xl"></i>
                                <br>
                                <span class="preview-icon-name">Sumber Dana</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('sumber_pengembalian.index') }}"class="">
                                <i class="fa fa-road fa-xl"></i>
                                <br>
                                <span class="preview-icon-name">Sumber Pengembalian</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('agunan.index') }}"class="">
                                <i class="fa fa-upload fa-xl"></i>
                                <br>
                                <span class="preview-icon-name">Agunan</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('kolektibilitas.index') }}"class="">
                                <i class="fa fa-object-group fa-xl"></i>
                                <br>
                                <span class="preview-icon-name">Kolektibilitas</span>
                            </a>
                        </li>
                    </ul>
                    <br>
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"></h3>
                        </div>
                        <div class="nk-block-des">
                            <p class="lead">Pendanaan</p>
                        </div>
                    </div>
                    <ul class="row g-gs preview-icon-svg">
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('sumber_pendanaan.index') }}"
                               class="">
                                <i class="fa fa-cart-plus fa-xl"></i>
                                <br>
                                <span class="preview-icon-name">Sumber Pendanaan</span>
                            </a>
                        </li>
                    </ul>

                        <br>

                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"></h3>
                        </div>
                        <div class="nk-block-des">
                            <p class="lead">Bank</p>
                        </div>
                    </div>
                    <ul class="row g-gs preview-icon-svg">
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('bank.index') }}"
                               class="">
                                <i class="fa fa-cc-visa fa-xl"></i>
                                <br>
                                <span class="preview-icon-name">Bank</span>
                            </a>
                        </li>

                    </ul>
                        <br>

                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"></h3>
                        </div>
                        <div class="nk-block-des">
                            <p class="lead">Template</p>
                        </div>
                    </div>
                    <ul class="row g-gs preview-icon-svg">
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('template_wa.index') }}"
                                class="">
                                 <i class="fa fa-whatsapp fa-xl"></i>
                                <br>
                                <span class="preview-icon-name">Template Whatsapp</span>
                            </a>
                        </li>

                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('template_notifikasi.index') }}"
                                class="">
                                 <i class="fa fa-comment-o fa-xl"></i>
                                <br>

                                <span class="preview-icon-name">Template Notifikasi</span>
                            </a>
                        </li>

                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('template_email.index') }}"
                                class="">
                                 <i class="fa fa-envelope fa-xl"></i>
                                <br>


                                <span class="preview-icon-name">Template E-mail</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('template_sms.index') }}"
                                class="">
                                 <i class="fa fa-comments fa-xl"></i>
                                <br>

                                <span class="preview-icon-name">Template SMS</span>
                            </a>
                        </li>
                    </ul>

                    <br>

                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"></h3>
                        </div>
                        <div class="nk-block-des">
                            <p class="lead">Penomoran Otomatis</p>
                        </div>
                    </div>
                    <ul class="row g-gs preview-icon-svg">
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('penomoran.index') }}"
                               class="">
                                <i class="fa fa-slack fa-xl"></i>
                                <br>
                                <span class="preview-icon-name">Penomoran</span>
                            </a>
                        </li>

                    </ul>

                    <br>
                    <!-- // Arrave - 4-4-22 -->
                    <!-- <li class="col-lg-3 col-6 col-sm-4">
                        <form action="{{ route('import.index') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" />
                            <button type="submit" class="btn btn-primary btn-block">Upload</button>
                        </form>
                    </li> -->

                </div>
            </div>
        </div>
    </div>

@endsection
