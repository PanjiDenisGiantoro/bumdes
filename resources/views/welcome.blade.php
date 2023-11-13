@extends('layouts.default')

@section('content')
<section>
    <div class="bannerimg cover-image bg-background3" data-image-src="{{ asset('assets/images/banners/gambar 4.jpeg') }}" style="background: url('{{ asset("assets/images/banners/gambar 4.jpeg") }}') center center;">
        <div class="header-text mb-0">
            <div class="container">
                <div class="text-center text-white ">
                    <h1>{{ __('DEWAN KOPERASI INDONESIA') }}</h1>
                    <!-- <ol class="breadcrumb text-center">
                        <li class="breadcrumb-item"><a href="/">{{ __('Beranda') }}</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">{{ __('Tentang Kami') }}</li>
                    </ol> -->
                </div>
            </div>
        </div>
    </div>
</section>

<section class="sptb">
    <div class="container">
        <div class="section-title center-block text-left">
{{--            <h1>{{ sprintf(__('Wilujeng Sumping  %s'), config('')) }}</h1>--}}
            <h1>{{ sprintf(__('Selamat Datang  %s'), config('')) }}</h1>
            <!-- <h4 class="leading-normal">Majority have suffered alteration in some form, by injected humor</h4> -->
{{--            <p class="leading-normal text-left" style="font-size: 1.25rem">Selamat Datang di Komunitas Koperasi Warung Negeri (Kowargi). Kowargi Sejahtera Indonesia. Merupakan koperasi yang dibentuk oleh kumpulan pedagang kecil dan pengusaha menengah dengan tujuan menyatukan visi ”Bersama Membangun Negeri “.</p>--}}
            <p class="leading-normal text-left" style="font-size: 1.25rem">Selamat Datang di Komunitas Dewan Koperasi Indonesia (DEKOPINDA). DEKOPINDA Merupakan koperasi yang dibentuk oleh kumpulan pedagang kecil dan pengusaha menengah dengan tujuan menyatukan visi ”Bersama Membangun Negeri “.</p>
{{--            <p class="leading-normal text-left" style="font-size: 1.25rem">Diinisiasi oleh 2 Kades di Kecamatan Dayeuhkolot yaitu Kades Desa Dayeuhkolot dan Desa Sukapura yang menginginkan produk lokal untuk masyarakat lokal sehingga swasembada desa terpenuhi guna “Bersama Memerangi Covid-19”. Kowargi terlahir melalui kerjasama synergi Desa Dayehkolot dan Sukapura bersama BUMDES masing-masing dan pengusaha lokal PT. Satoe Juara Nusantara sebagaimana dilansir dari Kowargipress.</p>--}}
            <p class="leading-normal text-left" style="font-size: 1.25rem">DEKOPINDA yang menginginkan produk lokal untuk masyarakat lokal sehingga swasembada desa terpenuhi guna “Bersama Memerangi Covid-19”. DEKOPINDA terlahir melalui kerjasama synergi bersama BUMDES masing-masing dan pengusaha lokal. </p>
            <p class="leading-normal text-left mb-0" style="font-size: 1.25rem">Mengantongi SK Kemenkum HAM dan nomor: AHU. 0005538.AH.01.26 Tahun 2020, DEKOPINDA merupakan Koperasi Konsumen Nasional.</p>
        </div>
    </div>
</section>

<section class="sptb bg-white">
    <div class="container">
        <div class="section-title center-block text-center">
            <h1>{{ __('Syarat Menjadi Anggota Warung Dewan Koperasi Indonesia?') }}</h1>
            <p></p>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="">
                    <div class="mb-lg-0 mb-4">
                        <div class="service-card text-center">
                            <div class="bg-secondary-transparent icon-bg icon-service text-pink">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="servic-data mt-3">
                                <h4 class="font-weight-semibold mb-2">Menjadi Anggota Dewan Koperasi Indonesia</h4>
                                <p class="text-muted mb-0"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="">
                    <div class="mb-lg-0 mb-4">
                        <div class="service-card text-center">
                            <div class="bg-purple-transparent icon-bg icon-service text-purple">
                                <i class="fa fa-pencil"></i>
                            </div>
                            <div class="servic-data mt-3">
                                <h4 class="font-weight-semibold mb-2">Memiliki KTP</h4>
                                <p class="text-muted mb-0"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="">
                    <div class="mb-sm-0 mb-4">
                        <div class="service-card text-center">
                            <div class="bg-warning-transparent icon-bg icon-service text-warning">
                                <i class="fa fa-bullhorn"></i>
                            </div>
                            <div class="servic-data mt-3">
                                <h4 class="font-weight-semibold mb-2">Memiliki Usaha Warung</h4>
                                <p class="text-muted mb-0"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="">
                    <div class="">
                        <div class="service-card text-center">
                            <div class="bg-secondary-transparent icon-bg icon-service text-pink">
                                <i class="fa fa-credit-card"></i>
                            </div>
                            <div class="servic-data mt-3">
                                <h4 class="font-weight-semibold mb-2">Memiliki Perangkat Android</h4>
                                <p class="text-muted mb-0"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="cover-image sptb bg-background-color" data-image-src="{{ asset('assets/images/banners/banner4.jpg') }}" style="background: url({{ asset('assets/images/banners/banner4.jpg') }}) center center;">
        <div class="content-text mb-0">
            <div class="container">
                <div class="text-center text-white ">
                   <!--  <h1 class="mb-2">Are you ready for the posting you ads on this Site?</h1>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p> -->
                    <!-- <div class="mt-5">
                        <a href="ad-posts.html" class="btn btn-secondary btn-pill">Free Post Ad</a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>

<section class="sptb">
    <div class="container">
        <div class="section-title center-block text-center">
            <h1>{{ __('Mengapa Anda Memilih Dinas Koperasi Serba Usaha ?') }}</h1>
            <!-- <p>Mauris ut cursus nunc. Morbi eleifend, ligula at consectetur vehicula</p> -->
        </div>
        <div class="row ">
            <div class="col-md-6 col-lg-4 features">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="feature">
                            <div class="fa-stack fa-lg  fea-icon bg-success mb-3">
                                <i class="fa fa-bullhorn  text-white"></i>
                            </div>
                            <h3>STOK LEBIH DEKAT</h3>
                            <p>Synergi BUMDES memberikan pelayanan CEPAT kepada Warung Desa</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 features">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="feature">
                            <div class="fa-stack fa-lg  fea-icon bg-primary mb-3">
                                <i class="fa fa-heart  text-white"></i>
                            </div>
                            <h3>PESAN ANTAR</h3>
                            <p>Kemudahan PESAN dan ANTAR dalam area desa.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 features">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="feature">
                            <div class="fa-stack fa-lg  fea-icon bg-secondary mb-3">
                                <i class="fa fa-bookmark  text-white"></i>
                            </div>
                            <h3>LOKAL</h3>
                            <p>Produsen Lokal yang membuat produk Lokal Berdaya Saing</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 features">
                <div class="card mb-lg-0">
                    <div class="card-body text-center">
                        <div class="feature">
                            <div class="fa-stack fa-lg  fea-icon bg-warning mb-3">
                                <i class="fa fa-line-chart   text-white"></i>
                            </div>
                            <h3>BERKEMBANG DALAM PERUBAHAN</h3>
                            <p>Berkembang dalam NEW NORMAL</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 features">
                <div class="card mb-lg-0 mb-md-0">
                    <div class="card-body text-center">
                        <div class="feature">
                            <div class="fa-stack fa-lg  fea-icon bg-danger mb-3">
                                <i class="fa fa-handshake-o   text-white"></i>
                            </div>
                            <h3>BERKEMBANG DENGAN IDE MASYARAKAT</h3>
                            <p>Selalu Terbangun oleh ide anggota</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 features">
                <div class="card mb-0">
                    <div class="card-body text-center">
                        <div class="feature">
                            <div class="fa-stack fa-lg  fea-icon bg-info mb-3">
                                <i class="fa fa-phone  text-white"></i>
                            </div>
                            <h3>Untung Bersama Bangkit Sejahtera</h3>
                            <p>Untung dalam kebersamaan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="sptb bg-white">
    <div class="container">
        <div class="statistics-info text-dark">
            <div class="row text-center">

                <div class="col-lg-3 col-md-6 col-sm-6 d-flex justify-content-center" style="margin: auto">
                    <div class="counter-status mb-6 mb-lg-0">
                        <div class="counter-icon">
                            <i class="si si-people"></i>
                        </div>
                        <h5>Warung Kecil</h5>
                        <h2 class="counter mb-0">1200+</h2>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 d-flex justify-content-center" style="margin: auto;">
                    <div class="counter-status mb-6 mb-lg-0">
                        <div class="counter-icon">
                            <i class="si si-rocket"></i>
                        </div>
                        <h5>Bumdes</h5>
                        <h2 class="counter mb-0">25+</h2>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 d-flex justify-content-center" style="margin: auto;">
                    <div class="counter-status mb-6 mb-sm-0">
                        <div class="counter-icon">
                            <i class="si si-docs"></i>
                        </div>
                        <h5>Desa On Progress</h5>
                        <h2 class="counter mb-0">500+</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="sptb border-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-xl-6 col-md-12">
                <div class="sub-newsletter">
                    <!-- <h3 class="mb-2"><i class="fa fa-paper-plane-o mr-2"></i> Subscribe To Our Newsletter</h3>
                    <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p> -->
                </div>
            </div>
            <div class="col-lg-5 col-xl-6 col-md-12">
               <!--  <div class="input-group sub-input mt-1">
                    <input type="text" class="form-control input-lg " placeholder="Enter your Email">
                    <div class="input-group-append ">
                        <button type="button" class="btn btn-primary btn-lg br-tr-7 br-br-7">
                            Subscribe
                        </button>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>
@endsection
