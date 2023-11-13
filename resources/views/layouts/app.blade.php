<!doctype html>
<html lang="{{ config('app.locale') }}" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="msapplication-TileColor" content="#0f75ff">
    <meta name="theme-color" content="#9d37f6">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

    <!-- Title -->
    <title>SMIK Serba Usaha</title>
    <link rel="stylesheet" href="{{ asset('assets/fonts/fonts/font-awesome.min.css') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/plugins/bootstrap-4.1.3/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Sidemenu Css -->
    <link href="{{ asset('assets/css/sidemenu.css') }}" rel="stylesheet" />

    <!-- Dashboard Css -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/admin-custom.css') }}" rel="stylesheet" />

    <!-- c3.js Charts Plugin -->
    <link href="{{ asset('assets/plugins/charts-c3/c3-chart.css') }}" rel="stylesheet" />



    <!-- Morris.js Charts Plugin -->
    <link href="{{ asset('assets/plugins/morris/morris.css') }}" rel="stylesheet" />

    <!-- P-scroll bar css-->

    <!-- P-scroll bar css-->
    <link href="{{ asset('assets/plugins/p-scrollbar/p-scrollbar.css') }}" rel="stylesheet" />

    <!---Font icons-->
    <link href="{{ asset('assets/plugins/iconfonts/plugin.css') }}" rel="stylesheet" />

    {{--        //googlemap--}}
    <link href="{{ asset('css/googlemap.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">


    {{--        lightbox--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- select2 -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    {{--        datatable--}}
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">


    <style>
        td.actions {
            white-space: nowrap;
        }

        .select2 {
            width:100%!important;
        } /* // Force Select2 to fix width - Arrave 18/2/22 */
    </style>

    @stack('css')
</head>

<body class="app sidebar-mini">
<div id="global-loader"><img src="{{ asset('assets/images/other/loader.svg') }}" class="loader-img floating" alt=""></div>
<div class="page">
    <div class="page-main">
        <div class="app-header1 header py-1 d-flex">
            <div class="container-fluid">
                <div class="d-flex">
                    <a class="header-brand" href="{{ route('dashboard') }}">
                        <img src="{{ asset('storage/perusahaan/1/logo_perusahaan') }}" style="width: 70px" class="header-brand-img" alt="logo" >
                    </a>

                    <a aria-label="{{ __('Sembunyikan Sidebar') }}" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>
                    <div class="header-navsearch d-flex mt-4">
                        <h5 class="card-title"> <b>SISTEM MANAJEMEN INFORMASI KOPERASI</b></h5>
                    </div>
                    <div class="d-flex order-lg-2 ml-auto">
                        <div class="dropdown d-none d-md-flex" >
                            <a  class="nav-link icon full-screen-link">
                                <i class="fe fe-maximize floating"  id="fullscreen-button"></i>
                            </a>
                        </div>


                        @auth
                            <div class="dropdown">
                                <a href="#" class="nav-link pr-0 leading-none user-img" data-toggle="dropdown">
                                    <img src="https://ui-avatars.com/api/?rounded=true&name={{ auth()->user()->name }}" alt="profile-img" class="avatar avatar-md brround">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
                                    <a class="dropdown-item" href="">
                                        <i class="dropdown-icon si si-user"></i> My Profile
                                    </a>
                                    {{-- <a class="dropdown-item" href="emailservices.html">
                                        <i class="dropdown-icon si si-envelope"></i> Inbox
                                    </a>
                                    <a class="dropdown-item" href="editprofile.html">
                                        <i class="dropdown-icon  si si-settings"></i> Account Settings
                                    </a> --}}
                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="dropdown-icon si si-power"></i> {{ __('Log keluar') }}
                                    </a>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar menu-->
        <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
        <aside class="app-sidebar doc-sidebar">
            @auth
                {{-- @if(auth()->user()->hasRole('Kasir') && auth()->user()->sub_branch_unit == null) --}}
                    {!!
        Menu::new()
            ->addClass('side-menu')
            ->add(
                \Spatie\Menu\Link::to(
                    route('dashboard'),
                    sprintf(
                        '<i class="side-menu__icon fa fa-tachometer"></i><span class="side-menu__label">%s</a>',
                        __('Dashboard')
                    )
                )
                ->addClass('side-menu__item')
            )

            ->add(
                \Spatie\Menu\Link::to(
                    route('anggota.index'),
                    sprintf(
                        '<i class="side-menu__icon fa fa-users"></i><span class="side-menu__label">%s</a>',
                        __('Daftar Anggota')
                    )
                )
                ->addClass('side-menu__item')
            )
               ->add(
                \Spatie\Menu\Link::to(
                    route('daftar_warung.index'),
                    sprintf(
                        '<i class="side-menu__icon fa fa-building"></i><span class="side-menu__label">%s</a>',
                        __('Daftar Usaha')
                    )
                )
                ->addClass('side-menu__item')
            )

              ->submenu(
                '<a href="#" class="side-menu__item" data-toggle="slide"><i class="side-menu__icon fa fa-credit-card"></i><span class="side-menu__label">' . __('Rekening') . '</span><i class="angle fa fa-angle-right"></i></a>',
                Menu::new()
                    ->addParentClass('slide')
                    ->addClass('slide-menu')
                    ->addItemClass('slide-item')
                    ->link(route('rekening-simpanan.index'), __('Simpanan'))
                    ->link(route('rekening.simjaka.index'), __('Simpanan Berjangka'))
                    ->link(route('rekening-pembiayaan.index'), __('Pembiayaan'))
            )
            ->submenu(
                '<a href="#" class="side-menu__item" data-toggle="slide"><i class="side-menu__icon fa fa-credit-card"></i><span class="side-menu__label">' . __(' Pemindahbukuan') . '</span><i class="angle fa fa-angle-right"></i></a>',
                Menu::new()
                    ->addParentClass('slide')
                    ->addClass('slide-menu')
                    ->addItemClass('slide-item')
                    ->link(route('pemindahbukuan.index'), __('Pemindahbukuan'))
                    ->link(route('pemindahbukuan.laporan'), __('Laporan'))
                    )
            ->submenu(
                '<a href="#" class="side-menu__item" data-toggle="slide"><i class="side-menu__icon fa fa-credit-card"></i><span class="side-menu__label">' . __('Bagi Hasil') . '</span><i class="angle fa fa-angle-right"></i></a>',
                Menu::new()
                    ->addParentClass('slide')
                    ->addClass('slide-menu')
                    ->addItemClass('slide-item')
                    ->link(route('bagi-hasil.simpanan.index'), __('Simpanan'))
                    ->link(route('simpanan_berjangka.index'), __('Simpanan- Berjangka'))
                    ->link(route('bagi-hasil.setting.index'), __('Setting'))
            )

            ->submenu(
                '<a href="#" class="side-menu__item" data-toggle="slide"><i class="side-menu__icon fa fa-print"></i><span class="side-menu__label">' . __('Teller') . '</span><i class="angle fa fa-angle-right"></i></a>',
                Menu::new()
                    ->addParentClass('slide')
                    ->addClass('slide-menu')
                    ->addItemClass('slide-item')
                    ->link(route('transaksi_keuangan.index'), __('Transaksi'))
                    ->link(route('denominasi.index'), __('Denominasi'))
            )

            ->submenu(
                '<a href="#" class="side-menu__item" data-toggle="slide"><i class="side-menu__icon fa fa-briefcase"></i><span class="side-menu__label">' . __('Penjualan') . '</span><i class="angle fa fa-angle-right"></i></a>',
                Menu::new()
                    ->addParentClass('slide')
                    ->addClass('slide-menu')
                    ->addItemClass('slide-item')
                    ->link(route('penjualan.index'), __('Penawaran'))
                    ->link(route('pemesanan_penjualan.index'), __('Pemesanan'))
                    ->link(route('pengiriman.index'), __('Pembayaran'))
                    ->link(route('penjualan.tagihan'), __('Tagihan'))
                     ->link(route('ringkasan-penjualan.index'), __('Ringkasan Penjualan'))
            )
            ->submenu(
                '<a href="#" class="side-menu__item" data-toggle="slide"><i class="side-menu__icon fa fa-cart-arrow-down"></i><span class="side-menu__label">' . __('Pembelian') . '</span><i class="angle fa fa-angle-right"></i></a>',
                Menu::new()
                    ->addParentClass('slide')
                    ->addClass('slide-menu')
                    ->addItemClass('slide-item')
                    ->link(route('pembelian.daftar-pembelian'), __('Daftar Pembelian'))
                    ->link(route('pembelian.pesanan.index'), __('Pesanan'))
                    ->link(route('pembelian.penerimaan.index'), __('Penerimaan'))
                    ->link(route('pembelian.pembayaran.index'), __('Pembayaran'))
                    ->link(route('ringkasan-pembelian.index'), __('Ringkasan Pembelian'))                                    )
                ->add(
                \Spatie\Menu\Link::to(
                    route('kasir.index'),
                    sprintf(
                        '<i class="side-menu__icon fa fa-shopping-basket"></i><span class="side-menu__label">%s</a>',
                        __('Kasir')
                    )
                )
                ->addClass('side-menu__item')
            )


            ->submenu(
                '<a href="#" class="side-menu__item" data-toggle="slide"><i class="side-menu__icon fa fa-money"></i><span class="side-menu__label">' . __('Keuangan') . '</span><i class="angle fa fa-angle-right"></i></a>',
                Menu::new()
                    ->addParentClass('slide')
                    ->addClass('slide-menu')
                    ->addItemClass('slide-item')
                    ->link(route('jurnal_keuangan.index'), __('Jurnal'))
                    ->link(route('biaya.index'), __('Biaya'))
                    ->link(route('biaya.index'), __('SHU'))
            )
              ->submenu(
                '<a href="#" class="side-menu__item" data-toggle="slide"><i class="side-menu__icon fa fa-th-large"></i><span class="side-menu__label">' . __(' Produk Usaha') . '</span><i class="angle fa fa-angle-right"></i></a>',
                Menu::new()
                    ->addParentClass('slide')
                    ->addClass('slide-menu')
                    ->addItemClass('slide-item')
                    ->link(route('daftar_produk.index'), __('Daftar Produk Usaha'))
                    ->link(route('daftar_produk.create'), __('Tambah Produk Usaha'))
            )
               ->submenu(
                '<a href="#" class="side-menu__item" data-toggle="slide"><i class="side-menu__icon fa fa-list"></i><span class="side-menu__label">' . __(' Inventori') . '</span><i class="angle fa fa-angle-right"></i></a>',
                Menu::new()
                    ->addParentClass('slide')
                    ->addClass('slide-menu')
                    ->addItemClass('slide-item')
                    ->link(route('daftar_inventori.index'), __('Daftar Inventori'))
                    ->link(route('daftar_inventori.create'), __('Transaksi Inventori'))
            )


              ->submenu(
                '<a href="#" class="side-menu__item" data-toggle="slide"><i class="side-menu__icon fa fa-briefcase"></i><span class="side-menu__label">' . __(' Aset Management') . '</span><i class="angle fa fa-angle-right"></i></a>',
                Menu::new()
                    ->addParentClass('slide')
                    ->addClass('slide-menu')
                    ->addItemClass('slide-item')
                    ->link(route('daftar_aset.index'), __('Daftar Aset'))
                    ->link(route('penyusutan_aset.index'), __('Penyusutan'))
                    ->link(route('pelepasan_aset_mgt.index'), __('Pelepasan'))
            )
               ->add(
                \Spatie\Menu\Link::to(
                    route('akun-officer.index'),
                    sprintf(
                        '<i class="side-menu__icon fa fa-briefcase"></i><span class="side-menu__label">%s</a>',
                        __('Akun Officer ')
                    )
                )
                ->addClass('side-menu__item')
            )
              ->add(
                \Spatie\Menu\Link::to(
                    route('semua_laporan.index'),
                    sprintf(
                        '<i class="side-menu__icon fa fa-book"></i><span class="side-menu__label">%s</a>',
                        __('Laporan')
                    )
                )
                ->addClass('side-menu__item')
            )
            ->add(
                \Spatie\Menu\Link::to(
                    route('tetapan.index'),
                    sprintf(
                        '<i class="side-menu__icon fa fa-gear"></i><span class="side-menu__label">%s</a>',
                        __('Pengaturan')
                    )
                )
                ->addClass('side-menu__item')
            )

            ->render()
    !!}

                {{-- @endif --}}


                @if(auth()->user()->hasRole('bank'))
                    {!!
                                                    Menu::new()
                                                        ->addClass('side-menu')
                                                        ->add(
                                                            \Spatie\Menu\Link::to(
                                                                route('dashboard'),
                                                                sprintf(
                                                                    '<i class="side-menu__icon fa fa-tachometer"></i><span class="side-menu__label">%s</a>',
                                                                    __('Dashboard')
                                                                )
                                                            )
                                                            ->addClass('side-menu__item')
                                                        )


                                                        ->submenu(
                                                            '<a href="#" class="side-menu__item" data-toggle="slide"><i class="side-menu__icon fa fa-money"></i><span class="side-menu__label">' . __('Penjualan') . '</span><i class="angle fa fa-angle-right"></i></a>',
                                                            Menu::new()
                                                                ->addParentClass('slide')
                                                                ->addClass('slide-menu')
                                                                ->addItemClass('slide-item')
                                                                ->link(route('penjualan.index'), __('Penawaran'))
                                                                ->link(route('pemesanan_penjualan.index'), __('Pemesanan'))
                                                                ->link(route('pengiriman.index'), __('Pembayaran'))
                                                                ->link("#", __('Tagihan'))
                                                                ->link(route('ringkasan-penjualan.index'), __('Ringkasan Penjualan'))
                                                        )
                                                        ->submenu(
                                                            '<a href="#" class="side-menu__item" data-toggle="slide"><i class="side-menu__icon fa fa-money"></i><span class="side-menu__label">' . __('Pembelian') . '</span><i class="angle fa fa-angle-right"></i></a>',
                                                            Menu::new()
                                                                ->addParentClass('slide')
                                                                ->addClass('slide-menu')
                                                                ->addItemClass('slide-item')
                                                                ->link(route('pembelian.daftar-pembelian'), __('Daftar Pembelian'))
                                                                ->link(route('pembelian.pesanan.index'), __('Pesanan'))
                                                                ->link(route('pembelian.penerimaan.index'), __('Penerimaan'))
                                                                ->link(route('pembelian.pembayaran.index'), __('Pembayaran'))
                                                        )
                                                        ->render()
                                                !!}
                @endif


                @if(auth()->user()->sub_branch_unit == 'pusat' && auth()->user()->hasRole('admin'))
                    {!!
       Menu::new()
           ->addClass('side-menu')
           ->add(
               \Spatie\Menu\Link::to(
                   route('dashboard'),
                   sprintf(
                       '<i class="side-menu__icon fa fa-tachometer"></i><span class="side-menu__label">%s</a>',
                       __('Dashboard')
                   )
               )
               ->addClass('side-menu__item')
           )

           ->add(
               \Spatie\Menu\Link::to(
                   route('anggota.index'),
                   sprintf(
                       '<i class="side-menu__icon fa fa-users"></i><span class="side-menu__label">%s</a>',
                       __('Daftar Anggota')
                   )
               )
               ->addClass('side-menu__item')
           )
              ->add(
               \Spatie\Menu\Link::to(
                   route('daftar_warung.index'),
                   sprintf(
                       '<i class="side-menu__icon fa fa-building"></i><span class="side-menu__label">%s</a>',
                       __('Daftar Usaha')
                   )
               )
               ->addClass('side-menu__item')
           )

             ->submenu(
               '<a href="#" class="side-menu__item" data-toggle="slide"><i class="side-menu__icon fa fa-credit-card"></i><span class="side-menu__label">' . __('Rekening') . '</span><i class="angle fa fa-angle-right"></i></a>',
               Menu::new()
                   ->addParentClass('slide')
                   ->addClass('slide-menu')
                   ->addItemClass('slide-item')
                   ->link(route('rekening-simpanan.index'), __('Simpanan'))
                   ->link(route('rekening.simjaka.index'), __('Simpanan Berjangka'))
                   ->link(route('rekening-pembiayaan.index'), __('Pembiayaan'))
                   ->link(route('rekening-pembiayaan.index'), __('Bagi Hasil'))
           )
             ->add(
               \Spatie\Menu\Link::to(
                   route('transaksi_keuangan.index'),
                   sprintf(
                       '<i class="side-menu__icon fa fa-print"></i><span class="side-menu__label">%s</a>',
                       __('Teller')
                   )
               )
               ->addClass('side-menu__item')
           )


           ->submenu(
               '<a href="#" class="side-menu__item" data-toggle="slide"><i class="side-menu__icon fa fa-briefcase"></i><span class="side-menu__label">' . __('Penjualan') . '</span><i class="angle fa fa-angle-right"></i></a>',
               Menu::new()
                   ->addParentClass('slide')
                   ->addClass('slide-menu')
                   ->addItemClass('slide-item')
                   ->link(route('penjualan.index'), __('Penawaran'))
                   ->link(route('pemesanan_penjualan.index'), __('Pemesanan'))
                   ->link(route('pengiriman.index'), __('Pembayaran'))
                   ->link(route('penjualan.tagihan'), __('Tagihan'))
                    ->link(route('ringkasan-penjualan.index'), __('Ringkasan Penjualan'))
           )
           ->submenu(
               '<a href="#" class="side-menu__item" data-toggle="slide"><i class="side-menu__icon fa fa-cart-arrow-down"></i><span class="side-menu__label">' . __('Pembelian') . '</span><i class="angle fa fa-angle-right"></i></a>',
               Menu::new()
                   ->addParentClass('slide')
                   ->addClass('slide-menu')
                   ->addItemClass('slide-item')
                   ->link(route('pembelian.daftar-pembelian'), __('Daftar Pembelian'))
                   ->link(route('pembelian.pesanan.index'), __('Pesanan'))
                   ->link(route('pembelian.penerimaan.index'), __('Penerimaan'))
                   ->link(route('pembelian.pembayaran.index'), __('Pembayaran'))
                   ->link(route('ringkasan-pembelian.index'), __('Ringkasan Pembelian'))                                    )
               ->add(
               \Spatie\Menu\Link::to(
                   route('kasir.index'),
                   sprintf(
                       '<i class="side-menu__icon fa fa-shopping-basket"></i><span class="side-menu__label">%s</a>',
                       __('Kasir')
                   )
               )
               ->addClass('side-menu__item')
           )


           ->submenu(
               '<a href="#" class="side-menu__item" data-toggle="slide"><i class="side-menu__icon fa fa-money"></i><span class="side-menu__label">' . __('Keuangan') . '</span><i class="angle fa fa-angle-right"></i></a>',
               Menu::new()
                   ->addParentClass('slide')
                   ->addClass('slide-menu')
                   ->addItemClass('slide-item')
                   ->link(route('jurnal_keuangan.index'), __('Jurnal'))
                   ->link(route('biaya.index'), __('Biaya'))
                   ->link(route('biaya.index'), __('SHU'))
           )

                ->add(
               \Spatie\Menu\Link::to(
                   route('daftar_produk.index'),
                   sprintf(
                       '<i class="side-menu__icon fa fa-th-large"></i><span class="side-menu__label">%s</a>',
                       __(' Produk')
                   )
               )
               ->addClass('side-menu__item')
           )
                   ->add(
               \Spatie\Menu\Link::to(
                   route('daftar_inventori.index'),
                   sprintf(
                       '<i class="side-menu__icon fa fa-list"></i><span class="side-menu__label">%s</a>',
                       __(' Inventori')
                   )
               )
               ->addClass('side-menu__item')
           )


             ->submenu(
               '<a href="#" class="side-menu__item" data-toggle="slide"><i class="side-menu__icon fa fa-briefcase"></i><span class="side-menu__label">' . __(' Aset Management') . '</span><i class="angle fa fa-angle-right"></i></a>',
               Menu::new()
                   ->addParentClass('slide')
                   ->addClass('slide-menu')
                   ->addItemClass('slide-item')
                   ->link(route('daftar_aset.index'), __('Daftar Aset'))
                   ->link(route('penyusutan_aset.index'), __('Penyusutan'))
                   ->link(route('pelepasan_aset_mgt.index'), __('Pelepasan'))
           )
              ->add(
               \Spatie\Menu\Link::to(
                   route('akun-officer.index'),
                   sprintf(
                       '<i class="side-menu__icon fa fa-briefcase"></i><span class="side-menu__label">%s</a>',
                       __('Akun Officer ')
                   )
               )
               ->addClass('side-menu__item')
           )
             ->add(
               \Spatie\Menu\Link::to(
                   route('semua_laporan.index'),
                   sprintf(
                       '<i class="side-menu__icon fa fa-book"></i><span class="side-menu__label">%s</a>',
                       __(' Laporan')
                   )
               )
               ->addClass('side-menu__item')
           )
           ->add(
               \Spatie\Menu\Link::to(
                   route('tetapan.index'),
                   sprintf(
                       '<i class="side-menu__icon fa fa-gear"></i><span class="side-menu__label">%s</a>',
                       __('Pengaturan')
                   )
               )
               ->addClass('side-menu__item')
           )

           ->render()
   !!}
                @endif

                @if(auth()->user()->sub_branch_unit == 'kantor' && auth()->user()->hasRole('admin'))
                    {!!
        Menu::new()
            ->addClass('side-menu')
            ->add(
                \Spatie\Menu\Link::to(
                    route('dashboard'),
                    sprintf(
                        '<i class="side-menu__icon fa fa-tachometer"></i><span class="side-menu__label">%s</a>',
                        __('Dashboard')
                    )
                )
                ->addClass('side-menu__item')
            )

            ->add(
                \Spatie\Menu\Link::to(
                    route('anggota.index'),
                    sprintf(
                        '<i class="side-menu__icon fa fa-users"></i><span class="side-menu__label">%s</a>',
                        __('Daftar Anggota')
                    )
                )
                ->addClass('side-menu__item')
            )
               ->add(
                \Spatie\Menu\Link::to(
                    route('daftar_warung.index'),
                    sprintf(
                        '<i class="side-menu__icon fa fa-building"></i><span class="side-menu__label">%s</a>',
                        __('Daftar Usaha')
                    )
                )
                ->addClass('side-menu__item')
            )
               ->submenu(
                        '<a href="#" class="side-menu__item" data-toggle="slide"><i class="side-menu__icon fa fa-shopping-bag"></i><span class="side-menu__label">' . __('Pendanaan') . '</span><i class="angle fa fa-angle-right"></i></a>',
                        Menu::new()
                            ->addParentClass('slide')
                            ->addClass('slide-menu')
                            ->addItemClass('slide-item')
                            ->link(route('daftar_pembiayaan.index'), __('Pengajuan Pendanaan'))
                            ->link(route('summary_batch.index'), __('Daftar Batch'))
                            ->link(route('rekening-pendanaan.index'), __('Rekening Pendanaan'))
                            ->link(route('setting-pendanaan.index'), __('Setting Pendanaan'))
                    )
            ->submenu(
                '<a href="#" class="side-menu__item" data-toggle="slide"><i class="side-menu__icon fa fa-credit-card"></i><span class="side-menu__label">' . __('Rekening') . '</span><i class="angle fa fa-angle-right"></i></a>',
                Menu::new()
                    ->addParentClass('slide')
                    ->addClass('slide-menu')
                    ->addItemClass('slide-item')
                    ->link(route('rekening-simpanan.index'), __('Simpanan'))
                    ->link(route('rekening.simjaka.index'), __('Simpanan Berjangka'))
                    ->link(route('rekening-pembiayaan.index'), __('Pembiayaan'))
            )



            ->submenu(
                '<a href="#" class="side-menu__item" data-toggle="slide"><i class="side-menu__icon fa fa-money"></i><span class="side-menu__label">' . __('Keuangan') . '</span><i class="angle fa fa-angle-right"></i></a>',
                Menu::new()
                    ->addParentClass('slide')
                    ->addClass('slide-menu')
                    ->addItemClass('slide-item')
                    ->link(route('transaksi_keuangan.index'), __('Transaksi'))
                    ->link(route('jurnal_keuangan.index'), __('Jurnal'))
            )

                 ->add(
                \Spatie\Menu\Link::to(
                    route('biaya.index'),
                    sprintf(
                        '<i class="side-menu__icon fa fa-calculator"></i><span class="side-menu__label">%s</a>',
                        __('Daftar Biaya')
                    )
                )
                ->addClass('side-menu__item')
            )

              ->submenu(
                '<a href="#" class="side-menu__item" data-toggle="slide"><i class="side-menu__icon fa fa-briefcase"></i><span class="side-menu__label">' . __(' Aset Management') . '</span><i class="angle fa fa-angle-right"></i></a>',
                Menu::new()
                    ->addParentClass('slide')
                    ->addClass('slide-menu')
                    ->addItemClass('slide-item')
                    ->link(route('daftar_aset.index'), __('Daftar Aset'))
                    ->link(route('penyusutan_aset.index'), __('Penyusutan'))
                    ->link(route('pelepasan_aset_mgt.index'), __('Pelepasan'))
            )
               ->add(
                \Spatie\Menu\Link::to(
                    route('akun-officer.index'),
                    sprintf(
                        '<i class="side-menu__icon fa fa-briefcase"></i><span class="side-menu__label">%s</a>',
                        __('Akun Officer')
                    )
                )
                ->addClass('side-menu__item')
            )
              ->add(
                \Spatie\Menu\Link::to(
                    route('semua_laporan.index'),
                    sprintf(
                        '<i class="side-menu__icon fa fa-book"></i><span class="side-menu__label">%s</a>',
                        __(' Laporan')
                    )
                )
                ->addClass('side-menu__item')
            )
            ->add(
                \Spatie\Menu\Link::to(
                    route('tetapan.index'),
                    sprintf(
                        '<i class="side-menu__icon fa fa-gear"></i><span class="side-menu__label">%s</a>',
                        __('Pengaturan')
                    )
                )
                ->addClass('side-menu__item')
            )

            ->render()
    !!}

                @endif

                @if(auth()->user()->sub_branch_unit == 'usaha' && auth()->user()->hasRole('admin'))
                    {!!
        Menu::new()
            ->addClass('side-menu')
            ->add(
                \Spatie\Menu\Link::to(
                    route('dashboard'),
                    sprintf(
                        '<i class="side-menu__icon fa fa-tachometer"></i><span class="side-menu__label">%s</a>',
                        __('Dashboard')
                    )
                )
                ->addClass('side-menu__item')
            )

            ->add(
                \Spatie\Menu\Link::to(
                    route('anggota.index'),
                    sprintf(
                        '<i class="side-menu__icon fa fa-users"></i><span class="side-menu__label">%s</a>',
                        __('Daftar Anggota')
                    )
                )
                ->addClass('side-menu__item')
            )
               ->add(
                \Spatie\Menu\Link::to(
                    route('daftar_warung.index'),
                    sprintf(
                        '<i class="side-menu__icon fa fa-building"></i><span class="side-menu__label">%s</a>',
                        __('Daftar Usaha')
                    )
                )
                ->addClass('side-menu__item')
            )


            ->submenu(
                '<a href="#" class="side-menu__item" data-toggle="slide"><i class="side-menu__icon fa fa-briefcase"></i><span class="side-menu__label">' . __('Penjualan') . '</span><i class="angle fa fa-angle-right"></i></a>',
                Menu::new()
                    ->addParentClass('slide')
                    ->addClass('slide-menu')
                    ->addItemClass('slide-item')
                    ->link(route('penjualan.index'), __('Penawaran'))
                    ->link(route('pemesanan_penjualan.index'), __('Pemesanan'))
                    ->link(route('pengiriman.index'), __('Pembayaran'))
                    ->link(route('penjualan.tagihan'), __('Tagihan'))
                     ->link(route('ringkasan-penjualan.index'), __('Ringkasan Penjualan'))
            )
            ->submenu(
                '<a href="#" class="side-menu__item" data-toggle="slide"><i class="side-menu__icon fa fa-cart-arrow-down"></i><span class="side-menu__label">' . __('Pembelian') . '</span><i class="angle fa fa-angle-right"></i></a>',
                Menu::new()
                    ->addParentClass('slide')
                    ->addClass('slide-menu')
                    ->addItemClass('slide-item')
                    ->link(route('pembelian.daftar-pembelian'), __('Daftar Pembelian'))
                    ->link(route('pembelian.pesanan.index'), __('Pesanan'))
                    ->link(route('pembelian.penerimaan.index'), __('Penerimaan'))
                    ->link(route('pembelian.pembayaran.index'), __('Pembayaran'))
                    ->link(route('ringkasan-pembelian.index'), __('Ringkasan Pembelian'))                                    )
                ->add(
                \Spatie\Menu\Link::to(
                    route('kasir.index'),
                    sprintf(
                        '<i class="side-menu__icon fa fa-shopping-basket"></i><span class="side-menu__label">%s</a>',
                        __('Kasir')
                    )
                )
                ->addClass('side-menu__item')
            )



                 ->add(
                \Spatie\Menu\Link::to(
                    route('daftar_produk.index'),
                    sprintf(
                        '<i class="side-menu__icon fa fa-th-large"></i><span class="side-menu__label">%s</a>',
                        __(' Produk')
                    )
                )
                ->addClass('side-menu__item')
            )

                    ->add(
                \Spatie\Menu\Link::to(
                    route('daftar_inventori.index'),
                    sprintf(
                        '<i class="side-menu__icon fa fa-list"></i><span class="side-menu__label">%s</a>',
                        __(' Inventori')
                    )
                )
                ->addClass('side-menu__item')
            )



              ->submenu(
                '<a href="#" class="side-menu__item" data-toggle="slide"><i class="side-menu__icon fa fa-briefcase"></i><span class="side-menu__label">' . __(' Aset Management') . '</span><i class="angle fa fa-angle-right"></i></a>',
                Menu::new()
                    ->addParentClass('slide')
                    ->addClass('slide-menu')
                    ->addItemClass('slide-item')
                    ->link(route('daftar_aset.index'), __('Daftar Aset'))
                    ->link(route('penyusutan_aset.index'), __('Penyusutan'))
                    ->link(route('pelepasan_aset_mgt.index'), __('Pelepasan'))
            )

              ->add(
                \Spatie\Menu\Link::to(
                    route('semua_laporan.index'),
                    sprintf(
                        '<i class="side-menu__icon fa fa-book"></i><span class="side-menu__label">%s</a>',
                        __(' Laporan')
                    )
                )
                ->addClass('side-menu__item')
            )
            ->add(
                \Spatie\Menu\Link::to(
                    route('tetapan.index'),
                    sprintf(
                        '<i class="side-menu__icon fa fa-gear"></i><span class="side-menu__label">%s</a>',
                        __('Pengaturan')
                    )
                )
                ->addClass('side-menu__item')
            )

            ->render()
    !!}

                @endif

            @endauth
        </aside>
        <div class="app-content my-3 my-md-5">
            <div class="side-app">
                @section('breadcrumb')
                @show
                {{--                        @if ($message = Session::get('success'))--}}
                {{--                            @component('bs::alert', ['type' => 'success', 'animated' => true, 'dismissible' => true, 'class' => ''])--}}
                {{--                                {{ $message }}--}}
                {{--                            @endcomponent--}}
                {{--                        @endif--}}

                {{--                        @if ($message = Session::get('error'))--}}
                {{--                            @component('bs::alert', ['type' => 'danger', 'animated' => true, 'dismissible' => true, 'class' => ''])--}}
                {{--                                {{ $message }}--}}
                {{--                            @endcomponent--}}
                {{--                        @endif--}}

                {{--                        @if ($message = Session::get('info'))--}}
                {{--                            @component('bs::alert', ['type' => 'info', 'animated' => true, 'dismissible' => true, 'class' => ''])--}}
                {{--                                {{ $message }}--}}
                {{--                            @endcomponent--}}
                {{--                        @endif--}}

                @yield('content')
            </div>
        </div>
    </div>

    <!--footer-->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-lg-12 col-sm-12 mt-3 mt-lg-0 text-center">
                    Copyright © {{ date('Y' )}} <a href="#">{{ config('app.name') }}</a>. All rights reserved.
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer-->
    <form class="d-none" id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
    </form>
</div>

<!-- Dashboard js -->
<script src="{{ asset('assets/js/vendors/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-4.1.3/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-4.1.3/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors/selectize.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors/jquery.tablesorter.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors/circle-progress.min.js') }}"></script>
<script src="{{ asset('assets/plugins/rating/jquery.rating-stars.js') }}"></script>


<script src="{{ asset('assets/plugins/chart/Chart.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/chart/utils.js') }}"></script>

<!--Morris.js Charts Plugin -->
<script src="{{ asset('assets/plugins/morris/raphael-min.js') }}"></script>
<script src="{{ asset('assets/plugins/morris/morris.js') }}"></script>

<!-- Fullside-menu Js-->
<script src="{{ asset('assets/plugins/toggle-sidebar/sidemenu.js') }}"></script>

<!-- P-scroll js-->
<script src="{{ asset('assets/plugins/p-scrollbar/p-scrollbar.js') }}"></script>
<script src="{{ asset('assets/plugins/p-scrollbar/p-scroll1.js') }}"></script>

<!--Counters -->
<script src="{{ asset('assets/plugins/counters/counterup.min.js') }}"></script>
<script src="{{ asset('assets/plugins/counters/waypoints.min.js') }}"></script>
<script src="{{ asset('assets/plugins/counters/numeric-counter.js') }}"></script>


<!-- Data tables -->
<script src="{{ asset('assets/plugins/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.j') }}"></script>

<!-- Custom Js-->
<script src="{{ asset('assets/js/admin-custom.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/jquery.flot.fillbetween.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('assets/plugins/echarts/echarts.js') }}"></script>
{{-- js maps--}}
<script src="{{ asset('js/googlemap.js') }}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/collect.js/4.29.0/collect.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
{{--        datatable--}}
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>


<!-- // Input Mask -Arrave -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7-beta.19/jquery.inputmask.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&callback=initMap" async defer></script>


<script src="{{ asset('assets/js/nioapp/nioapp.min.js') }}"></script>
<script>
    @if(Session::has('message'))

    swal('Berhasil!', '{{ Session::get('message') }}', 'success');
    @endif

    @if(Session::has('error'))
    swal('info!', '{{ Session::get('error') }}', 'error');
    @endif

    @if(Session::has('info'))
    swal('info!', '{{ Session::get('info') }}', 'info');

    @endif

    @if(Session::has('warning'))
    swal('warning!', '{{ Session::get('warning') }}', 'warning');

    @endif
</script>

{{--        krajee.js--}}

{{--        <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.6/js/fileinput.min.js"></script>--}}
{{--        <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.6/js/locales/LANG.js"></script>--}}
{{-- lightbox--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var data = (params) => {
        var query = {
            q: params.term,
            page: params.page || 1
        }

        return query;
    }

    var processPaginatedResults = (data, page) => {

        return {
            results: data && data.results ? data.results.data :data.data,
            pagination: {
                more: data.current_page < data.last_page
            },
        }
    }

    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }

    var processResults = (data) => {
        var options = [];

        for (const [key, value] of Object.entries(data)) {
            options.push({
                id: key,
                text: value,
            });
        }

        return {
            results: options
        };
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

@stack('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&callback=initMap" async defer></script>
{{--        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvu7DpLUaUdXskROiaAofFPOpN5hmsOro&callback=initMap" async defer></script>--}}
</body>
</html>
