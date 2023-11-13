@extends('layouts.default')

@section('content')
<section>
    <div class="bannerimg cover-image bg-background3" data-image-src="{{ asset('assets/images/banners/gambar 4.jpeg') }}" style="background: url('{{ asset("assets/images/banners/gambar 6.png") }}') center center;">
        <div class="header-text mb-0">
            <div class="container">
                <div class="text-center text-white ">
                    <h1 class="">{{ __('Warung Kami') }}</h1>
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
            <!-- <div style="text-align:justify;width:75%; background-color:#ff9999; border:1px solid #000099; padding:8px;"><img src="gambar 5.jpeg" style="float:left; margin:0 8px 4px 0;"/>tulis teks disini</div> -->
{{--            <img src="gambar 6.png" style="float:left; width: 40%; margin:0 50px 4px 0;"><h2>Koperasi Warung Negeri (Kowargi)</h2>--}}
            <img src="gambar 6.png" style="float:left; width: 40%; margin:0 50px 4px 0;"><h2>Dewan Koperasi Indonesia  (DEKOPINDA)</h2>
            &nbsp;<p class="text-justify" style="font-size: 1.25rem; margin:0 8px 4px 0;">Dewan Koperasi Indonesia  merupakan koperasi Konsumen yang dibentuk oleh sekumpulan warung – warung kecil dalam menyatukan kekuatan dalam memulihkan ekonomi anggota pada khususnya dan masyarakat pada umumnya. Membuka toko sembako merupakan alternatif yang tepat kerana membuka usaha bisnis toko sembako adalah pilihan yang hampir tidak mengandung risiko tinggi, di karenakan kebutuhan akan bahan pokok atau sembako manusia akan semakin meningkat dan tidak pernah kurang.</p>
          </div>
    </div>
</section>
<section class="sptb">

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="section-title center-block text-center">
                <br>
                <h1>Testimonials</h1>
                <p></p>
            </div>
            <div id="myCarousel" class="owl-carousel testimonial-owl-carousel">
                <div class="item text-center">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-8 col-md-12 d-block mx-auto">
                                <div class="testimonia"> <div class="testimonia-img mx-auto mb-3"> <img src="assets/images/banners/orang 6.jpg" style="max-width: 150px" class="img-thumbnail rounded-circle alt=" alt="">
                                </div>
                                <p style="font-size: 20px"> <i class="fa fa-quote-left"></i> "Model yang sangat cocok untuk Kemandirian Desa dan UMKM Lokal dalam komunitas  Koperasi Konsumen Kowargi Sejahtera Indonesia.Perlu segera dijalankan di seluruh Wilayah Indonesia"</p>
                                <div class="testimonia-data">
                                    <h4 class="fs-20 mb-1">Drs. Budi Mustopo</h4>
                                    <h6 class="font-weight-bold blue-text ">Ka.Biro Penerangan Kementrian Koperasi</h6>
                                    <!-- <h6 class="fs-20 mb-1" style="font-size: 50px">Ka.Biro Penerangan Kementrian Koperasi</h6>  -->
                                    <div class="rating-stars">
                                        <input type="number" readonly="readonly" class="rating-value star" name="rating-stars-value" value="3">
                                        <div class="rating-stars-container">
                                            <div class="rating-star sm is--active">
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="rating-star sm is--active">
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="rating-star sm is--active">
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="rating-star sm">
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="rating-star sm">
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="col-xl-4 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="team-section text-center">
                <div class="team-img">
                    <img src="assets/images/banners/orang 7.jpg" style="max-width: 150px"  class="img-thumbnail rounded-circle alt=" alt="">
                </div>
                <h4 class="font-weight-bold dark-grey-text mt-4">Drs.Haris</h4>
                <h6 class="font-weight-bold blue-text ">Camat Dayeuhkolot</h6>
                <p class="font-weight-normal dark-grey-text" style="font-size: 20px">
                    <i class="fa fa-quote-left pr-2"></i>"Akibat Pandemik, Semua memang Berat, Namun Bersama Kita Hebat"
                </p>
                <div class="text-warning">
                    <i class="fa fa-star">
                    </i>
                    <i class="fa fa-star">
                    </i>
                    <i class="fa fa-star">
                    </i>
                    <i class="fa fa-star">
                    </i>
                    <i class="fa fa-star-half-full">
                    </i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-4 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="team-section text-center">
                <div class="team-img">
                    <img src="assets/images/banners/orang 8.jpg" style="max-width: 150px"  class="img-thumbnail rounded-circle alt=" alt="">
                </div>
                <h4 class="font-weight-bold dark-grey-text mt-4">Hot Asi</h4>
                <h6 class="font-weight-bold blue-text ">Direktur Duha Syariah Madani</h6>
                <p class="font-weight-normal dark-grey-text" style="font-size: 20px">
                    <i class="fa fa-quote-left pr-2"></i>
                    "Sudah waktunya keuangan Syariah digital memperkuat ekonomi Nasional"
                </p>
                <div class="text-warning">
                    <i class="fa fa-star">
                    </i>
                    <i class="fa fa-star">
                    </i>
                    <i class="fa fa-star">
                    </i>
                    <i class="fa fa-star">
                    </i>
                    <i class="fa fa-star">
                    </i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-4 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="team-section text-center">
                <div class="team-img">
                    <img src="assets/images/banners/orang 9.jpg" style="max-width: 150px"  class="img-thumbnail rounded-circle alt=" alt="">
                </div>
                <h4 class="font-weight-bold dark-grey-text mt-4">Lilis Kuraesin</h4>
                <h6 class="font-weight-bold blue-text ">Warung Lilis</h6>
                <p class="font-weight-normal dark-grey-text" style="font-size: 20px">
                    <i class="fa fa-quote-left pr-2"></i>
                Saya bisa fokus jualan dan nga perlu belanja keluar. Stok barang yang banyak dan ada juga tambahan vouchernya.
                </p>
                <div class="text-warning">
                    <i class="fa fa-star">
                    </i>
                    <i class="fa fa-star">
                    </i>
                    <i class="fa fa-star">
                    </i>
                    <i class="fa fa-star">
                    </i>
                    <i class="fa fa-star-o">
                    </i>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>

<!-- <section class="sptb bg-white">
    <div class="container">
        <div class="section-title center-block text-center">
            <h1>Bagaimana Cara</h1>
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
                                <h4 class="font-weight-semibold mb-2">Register</h4>
                                <p class="text-muted mb-0">Nam libero tempore, cum soluta nobis est eligendi cumque facere possimus</p>
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
                                <h4 class="font-weight-semibold mb-2">Create Account</h4>
                                <p class="text-muted mb-0">Nam libero tempore, cum soluta nobis est eligendi cumque facere possimus</p>
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
                                <h4 class="font-weight-semibold mb-2">Add Posts</h4>
                                <p class="text-muted mb-0">Nam libero tempore, cum soluta nobis est eligendi cumque facere possimus</p>
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
                                <h4 class="font-weight-semibold mb-2">Get Earnings</h4>
                                <p class="text-muted mb-0">Nam libero tempore, cum soluta nobis est eligendi cumque facere possimus</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- <section>
    <div class="cover-image sptb bg-background-color" data-image-src="{{ asset('assets/images/banners/banner4.jpg') }}" style="background: url({{ asset('assets/images/banners/banner4.jpg') }}) center center;">
        <div class="content-text mb-0">
            <div class="container">
                <div class="text-center text-white ">
                    <h1 class="mb-2">Are you ready for the posting you ads on this Site?</h1>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                    <div class="mt-5">
                        <a href="ad-posts.html" class="btn btn-secondary btn-pill">Free Post Ad</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- <section class="sptb">
    <div class="container">
        <div class="section-title center-block text-center">
            <h1>{{ __('Mengapa Memilih Kami?') }}</h1>
            <p>Mauris ut cursus nunc. Morbi eleifend, ligula at consectetur vehicula</p>
        </div>
        <div class="row ">
            <div class="col-md-6 col-lg-4 features">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="feature">
                            <div class="fa-stack fa-lg  fea-icon bg-success mb-3">
                                <i class="fa fa-bullhorn  text-white"></i>
                            </div>
                            <h3>Provide Free Ads</h3>
                            <p>our being able to do what we like best, every pleasure is to be welcomed and every pain.</p>
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
                            <h3>Best Ad Ratings</h3>
                            <p>our being able to do what we like best, every pleasure is to be welcomed and every pain.</p>
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
                            <h3>Provide Post Features</h3>
                            <p>our being able to do what we like best, every pleasure is to be welcomed and every pain.</p>
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
                            <h3>See  your Ad Progress</h3>
                            <p>our being able to do what we like best, every pleasure is to be welcomed and every pain.</p>
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
                            <h3>User Friendly</h3>
                            <p>our being able to do what we like best, every pleasure is to be welcomed and every pain.</p>
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
                            <h3>24/7 Support</h3>
                            <p>our being able to do what we like best, every pleasure is to be welcomed and every pain.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
 -->
<!-- <section class="sptb bg-white">
    <div class="container">
        <div class="statistics-info text-dark">
            <div class="row text-center">

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter-status mb-6 mb-lg-0">
                        <div class="counter-icon">
                            <i class="si si-people"></i>
                        </div>
                        <h5>Clients</h5>
                        <h2 class="counter mb-0">2569</h2>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter-status mb-6 mb-lg-0">
                        <div class="counter-icon">
                            <i class="si si-rocket"></i>
                        </div>
                        <h5>Total Sales</h5>
                        <h2 class="counter mb-0">1765</h2>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter-status mb-6 mb-sm-0">
                        <div class="counter-icon">
                            <i class="si si-docs"></i>
                        </div>
                        <h5>Total Projects</h5>
                        <h2 class="counter mb-0">846</h2>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter-status">
                        <div class="counter-icon">
                            <i class="si si-emotsmile"></i>
                        </div>
                        <h5>Happy Customers</h5>
                        <h2 class="counter mb-0">7253</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- <section class="sptb border-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-xl-6 col-md-12">
                <div class="sub-newsletter">
                    <h3 class="mb-2"><i class="fa fa-paper-plane-o mr-2"></i> Subscribe To Our Newsletter</h3>
                    <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                </div>
            </div>
            <div class="col-lg-5 col-xl-6 col-md-12">
                <div class="input-group sub-input mt-1">
                    <input type="text" class="form-control input-lg " placeholder="Enter your Email">
                    <div class="input-group-append ">
                        <button type="button" class="btn btn-primary btn-lg br-tr-7 br-br-7">
                            Subscribe
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
@endsection
