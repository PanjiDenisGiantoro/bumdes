
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-TileColor" content="#0f75ff">
        <meta name="theme-color" content="#2ddcd3">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="description" content="Directory, Classifieds and Jobs Listing">
        <meta name="author" content="sprukotechnologies">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="keywords" content="classifieds,real estate,education online classess,jobs,business directory,coupons,cars,e-commerce,market place,auctions,tours & travels,domain marketPlace,books listing,doctors listing,rating & reviews,iCO list,wedding,knowledge base,softwares,video listing,booking html template,bootstrap 4 html template,buy templates,directory listing html template,html and css website templates,html app template,html5 web templates,modern html templates,premium bootstrap templates,responsive ui,html template,html5 template,ecommerce html template,directory listing html template,html css js templates,search html template,best ui kits,bootstrap 4 ui kit,bootstrap kit,css ui kit,flat ui kit,html ui kit,kit ui,multipurpose website ui kit,ui kit template,uikit css,web ui kit,website ui kit,wireframe kit,wireframe ui kit,bootstrap ui kit,dashboard ui kit,flat ui,flat ui design,uikit">
        <link rel="icon" href="favicon.ico" type="image/x-icon"/>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

        <!-- Title -->
        <title>SMIK Serba Usaha</title>

        <!-- Bootstrap Css -->
        <link href="{{ asset('assets/plugins/bootstrap-4.1.3/css/bootstrap.min.css') }}" rel="stylesheet" />

        <!-- Dashboard Css -->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />

        <!-- Font-awesome  Css -->
        <link href="{{ asset('assets/fonts/fonts/font-awesome.min.css') }}" rel="stylesheet">

        <!--Horizontal Menu-->
        <link href="{{ asset('assets/plugins/Horizontal2/Horizontal-menu/dropdown-effects/fade-down.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/Horizontal2/Horizontal-menu/color-skins/color.css') }}" rel="stylesheet" />

        <!--Select2 Plugin -->
        <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

        <!-- Cookie css -->
        <link href="{{ asset('assets/plugins/cookie/cookie.css') }}" rel="stylesheet">

        <!-- Owl Theme css-->
        <link href="{{ asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />

        <!-- Custom scroll bar css-->
        <link href="{{ asset('assets/plugins/scroll-bar/jquery.mCustomScrollbar.css') }}" rel="stylesheet" />

        <!--Font icons-->
        <link href="{{ asset('assets/plugins/iconfonts/plugin.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/iconfonts/icons.css') }}" rel="stylesheet">
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

        <style>
        .nowrap {
            white-space: nowrap;
        }
        .card-badge {
            display: inline-block;
            min-width: 2em;
            padding: 0.3em;
            border-radius: 50%;
            font-size: 10px;
            text-align: center;
            background : #29a867;
            color: #fefefe;
            margin-left: -10px;
        }
        </style>

        @stack('css')

    </head>

    <body>
        <!--Loader-->
        <div id="global-loader"><img src="{{ asset('assets/images/other/loader.svg') }}" class="loader-img floating" alt=""></div>

        <!--Topbar-->
        <div class="header-main">
            <div class="top-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-sm-4 col-7">
                            <div class="top-bar-left d-flex">
                                <div class="clearfix">
                                    <ul class="socials">
                                        <li>
                                            <a class="social-icon text-dark" href="https://www.facebook.com"><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a class="social-icon text-dark" href="https://www.facebook.com"><i class="fa fa-twitter"></i></a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="clearfix">

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-sm-8 col-5">
                            <div class="top-bar-right">
                                <ul class="custom">
                                    @guest
                                    <li>
                                        <a href="" class="text-dark"><i class="fa fa-user mr-1"></i> <span>{{ __('Register') }}</span></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('login') }}" class="text-dark"><i class="fa fa-sign-in mr-1"></i> <span>{{ __('Login') }}</span></a>
                                    </li>
                                    @endguest

                                    @auth
                                    <li>
                                        <a href="{{ route('dashboard') }}" class="text-dark"><i class="fa fa-home mr-1"></i> <span>{{ __('Dashboard') }}</span></a>
                                    </li>
                                    @endauth
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Header -->
            <div class="sticky">
                <div class="horizontal-header clearfix ">
                    <div class="container">
                        <a id="horizontal-navtoggle" class="animated-arrow"><span></span></a>
                        <span class="smllogo"><img src="{{ asset('storage/perusahaan/1/122.png') }}" alt="" style="height: 35px" /></span>
                        {{-- <a href="tel:245-6325-3256" class="callusbtn"><i class="fa fa-phone" aria-hidden="true"></i></a> --}}
                    </div>
                </div>
            </div>
            <!-- Mobile Header -->

            <div>
                <div class="horizontal-main clearfix">
                    <div class="horizontal-mainwrapper container clearfix">
                        <div class="desktoplogo">
                            <a href="/"><img src="{{ asset('storage/perusahaan/1/logo_perusahaan') }}" alt="" style="height: 60px; width: 99px"></a>
                        </div>
                        <!--Nav-->
                        <nav class="horizontalMenu clearfix d-md-flex">
                            <ul class="horizontalMenu-list">
                                <li aria-haspopup="true"><a href="/" @class(['active' => request()->is('/')])>{{ __('Beranda') }}</a></li>
                                <li aria-haspopup="true"><a href="/warung-kami" @class(['active' => request()->is('/warung-kami')])>{{ __('Warung Kami') }}</a></li>
                                <li aria-haspopup="true"><a href="{{ route('pages.daftar_warung.index') }}" @class(['active' => request()->is('daftar-warung*')])>{{ __('Daftar Warung') }}</a></li>
                                <li aria-haspopup="true"><a href="{{ route('carts.e-commerce.index') }}" @class(['active' => request()->is('e-commerce*')])>{{ __('E-Commerce') }}</a></li>
                                <li aria-haspopup="true"><a href="/contact-us" @class(['active' => request()->is('/contact-us')])>{{ __('Hubungi Kami') }}</a></li>
                                {{-- <li aria-haspopup="true" class="d-lg-none mt-5 pb-5 mt-lg-0">
                                    <span><a class="btn btn-secondary" href="#">{{ __('Daftar') }}</a></span>
                                </li> --}}
                                <li aria-haspopup="true" class="mt-0 d-none d-lg-block ">
                                    {{-- <span><a class="btn btn-secondary" href="#">{{ __('Daftar') }}</a></span> --}}
                                    <a href="{{ route('carts.list') }}" class="nav-link d-inline-block">
                                        @php
                                            $token = $token = csrf_token();
                                            $carts = \App\Models\Carts::where('token', '=', $token)->count();
                                        @endphp
                                        @if($carts > 0)
                                            <img src="/assets/images/icon-cart-filled.svg" alt="" />
                                            <div class="card-badge">{{ $carts }}</div>
                                        @else
                                            <img src="/assets/images/icon-cart-empty.svg" alt="" />
                                        @endif
                                    </a>
                                </li>
                            </ul>
                            @guest
                            <ul class="mb-0">
                                {{-- <li aria-haspopup="true" class="mt-5 d-none d-lg-block ">
                                    <span><a class="btn btn-secondary" href="#">{{ __('Daftar') }}</a></span>
                                </li> --}}

                                {{-- <li class="nav-item">
                                    <a href="{{ route('carts.list') }}" class="nav-link d-inline-block mt-2">
                                        @php
                                            $carts = \App\Models\Carts::all()->count();
                                        @endphp
                                        @if($carts > 0)
                                            <img src="/assets/images/icon-cart-filled.svg" alt="" />
                                            <div class="card-badge">{{ $carts }}</div>
                                        @else
                                            <img src="/assets/images/icon-cart-empty.svg" alt="" />
                                        @endif
                                    </a>
                                </li> --}}
                            </ul>
                            @endguest
                        </nav>
                        <!--Nav-->
                    </div>
                </div>
            </div>
        </div>

        @yield('content')

        <!--Footer Section-->
        <section>
            <footer class="bg-dark text-white">
                <div class="footer-main">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <h6>{{ __('Tentang Kami') }}</h6>
{{--                                <p>Program Warung Kowargi Merupakan program yang terinspirasi dari sekumpulan masyarakat dan warung Retail Kecil yang ingin Bangkit dan turut serta dalam Pemulihan Ekonomi Nasional(PEN)</p>--}}
                                <p>Program Warung Dinas Koperasi Merupakan program yang terinspirasi dari sekumpulan masyarakat dan warung Retail Kecil yang ingin Bangkit dan turut serta dalam Pemulihan Ekonomi Nasional(PEN)</p>
                                {{-- \App\Models\Page::whereSlug('partial:footer')->first()->body ?? '{{ partial:footer }}' --}
                                {{-- <ul class="list-unstyled mb-0">
                                    <li><a href="#">Company</a></li>
                                    <li><a href="#">Colleges</a></li>
                                    <li><a href="#">Hospital</a></li>
                                    <li><a href="#">Factories</a></li>
                                </ul> --}}
                            </div>
                            {{-- <div class="col-lg-2 col-md-12">
                                <h6>Classifieds</h6>
                                <ul class="list-unstyled mb-0">
                                    <li><a href="#">Real Estate</a></li>
                                    <li><a href="#">Computer</a></li>
                                    <li><a href="#">Clothing</a></li>
                                    <li><a href="#">Jobs</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-2 col-md-12">
                                <h6>Resources</h6>
                                <ul class="list-unstyled mb-0">
                                    <li><a href="#">Support</a></li>
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="#">Terms of Service</a></li>
                                    <li><a href="#">Contact Details</a></li>
                                </ul>
                            </div> --}}
                            <div class="col-lg-3 col-md-12">
                                <h6>{{ __('Hubungi Kami') }}</h6>
{{--                                <p>Bandung Techno ParkJl Telkomunikasi No 1 Bandung 081214153534 kowargisyariahnusantara@gmail.com</p>--}}
                                <p>Bogor No 1 Bogor 081214153534 Dekopinda@gmail.com</p>
                                <ul class="list-unstyled mb-0">
                                    {{-- <li><a href="#">{{ implode(', ', [option('address'), option('postcode'), option('state'), option('country')]) }}</a></li>
                                    <li><a href="#">{!! !empty(option('phone')) ? sprintf('%s: <span>%s</span><br>', __('Phone'), option('phone')) : '' !!}</a></li>
                                    <li><a href="#">{!! !empty(option('fax')) ? sprintf('%s: <span>%s</span><br>', __('Fax'), option('fax')) : '' !!}</a></li>
                                    <li><a href="#">{!! !empty(option('email')) ? sprintf('%s: <span>%s</span><br>', __('Email'), '<a href="mailto:' . option('email') . '">' . option('email')) . '</a>' : '' !!}</a></li> --}}
                                </ul>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <h6>{{ __('Mitra Kerja Sama') }}</h6>
                                <ul class="payments mb-0">
                                <li>
                                   <img src="logoaction.jpg" style="max-width: 80px"  alt="">
                                </li>
                                <li>
                                    <img src="desatech.jpg" style="max-width: 80px"alt="">
                                </li>
                                </ul>
                            </div>
                            <!-- <div class="col-lg-3 col-md-12">
                                <h6 class="mb-2">{{ __('Subscribe') }}</h6>
                                <div class="input-group">
                                    <input type="text" class="form-control br-tl-7 br-bl-7" placeholder="{{ __('Email') }}">
                                    <div class="input-group-append">

                                        <ul class="payments mb-0">
                                            <li>
                                               <img src="assets/images/banners/logo.jpeg" style="max-width: 70px"  alt="">
                                            </li>
                                            <li>
                                                <img src="assets/images/banners/logo 2.jpg" style="max-width: 70px"alt="">
                                            </li>
                                            <li>
                                                <a href="javascript:;" class="payments-icon"><i class="fa fa-credit-card-alt" aria-hidden="true"></i></a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" class="payments-icon"><i class="fa fa-cc-mastercard" aria-hidden="true"></i></a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" class="payments-icon"><i class="fa fa-cc-paypal" aria-hidden="true"></i></a>
                                            </li>
                                        </ul>
                                        <button type="button" class="btn btn-primary br-tr-7 br-br-7">
                                            {{ __('Subscribe') }}
                                        </button>
                                    </div>
                                </div> -->
                               <!--  <h6 class="mb-2 mt-5">{{ __('Kerja Sama') }}</h6>
                                <ul class="payments mb-0">
                                    <li>
                                       <img src="assets/images/banners/logo.jpeg" style="max-width: 70px"  alt="">
                                    </li>
                                    <li>
                                        <img src="assets/images/banners/logo 2.jpg" style="max-width: 70px"alt="">
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="payments-icon"><i class="fa fa-credit-card-alt" aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="payments-icon"><i class="fa fa-cc-mastercard" aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="payments-icon"><i class="fa fa-cc-paypal" aria-hidden="true"></i></a>
                                    </li>
                                </ul> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-dark text-white p-0">
                    <div class="container">
                        <div class="row d-flex">
                            <div class="col-lg-8 col-sm-12  mt-2 mb-2 text-left ">
                                {{ __('Copyright') }} © {{ date('Y') }} <a href="#" class="fs-14 text-primary"></a>. {{ __('All Rights Reserved.') }}
                            </div>
                            <div class="col-lg-4 col-sm-12 ml-auto mb-2 mt-2">
                                <ul class="social mb-0">
                                    <li>
                                        <a class="social-icon" href="https://www.facebook.com"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a class="social-icon" href="https://www.facebook.com"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    {{-- <li>
                                        <a class="social-icon" href=""><i class="fa fa-rss"></i></a>
                                    </li>
                                    <li>
                                        <a class="social-icon" href=""><i class="fa fa-youtube"></i></a>
                                    </li>
                                    <li>
                                        <a class="social-icon" href=""><i class="fa fa-linkedin"></i></a>
                                    </li>
                                    <li>
                                        <a class="social-icon" href=""><i class="fa fa-google-plus"></i></a>
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-dark text-white p-0 border-top">
                    <div class="container">
                        <div class="p-2 text-center footer-links">
                            {{-- <a href="#" class="btn btn-link">{{ __('How It Works') }}</a>
                            <a href="{{ route('page.show', ['about-us']) }}" class="btn btn-link">{{ __('About Us') }}</a>
                            <a href="{{ route('register') }}" class="btn btn-link">{{ __('Pricing') }}</a>
                            {{-- <a href="#" class="btn btn-link">{{ __('Ads Categories') }}</a> --}}
                            {{-- <a href="{{ route('page.show', ['privacy-policy']) }}" class="btn btn-link">{{ __('Privacy Policy') }}</a>
                            <a href="#" class="btn btn-link">{{ __('Terms Of Conditions') }}</a> --}}
                            {{-- <a href="#" class="btn btn-link">{{ __('Blog') }}</a> --}}
                            {{-- <a href="#" class="btn btn-link">{{ __('Contact Us') }}</a> --}}
                            {{-- <a href="#" class="btn btn-link">{{ __('Premium Ad') }}</a> --}}
                        </div>
                    </div>
                </div>
            </footer>
        </section>
        <!--Footer Section-->

        <!-- Back to top -->
        <a href="#top" id="back-to-top" ><i class="fa fa-rocket"></i></a>

        <!-- JQuery js-->
        <script src="{{ asset('assets/js/vendors/jquery-3.2.1.min.js') }}"></script>
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

        <!-- Bootstrap js -->
        <script src="{{ asset('assets/plugins/bootstrap-4.1.3/popper.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap-4.1.3/js/bootstrap.min.js') }}"></script>

        <!--JQuery Sparkline Js-->
        <script src="{{ asset('assets/js/vendors/jquery.sparkline.min.js') }}"></script>

        <!-- Circle Progress Js-->
        <script src="{{ asset('assets/js/vendors/circle-progress.min.js') }}"></script>

        <!-- Star Rating Js-->
        <script src="{{ asset('assets/plugins/rating/jquery.rating-stars.js') }}"></script>

        <!--Owl Carousel js -->
        <script src="{{ asset('assets/plugins/owl-carousel/owl.carousel.js') }}"></script>

        <!--Horizontal Menu-->
        <script src="{{ asset('assets/plugins/Horizontal2/Horizontal-menu/horizontal.js') }}"></script>

        <!--Counters -->
        <script src="{{ asset('assets/plugins/counters/counterup.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/counters/waypoints.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/counters/numeric-counter.js') }}"></script>
        <script src="{{ asset('assets/jquery.inputmask.bundle.js') }}"></script>
        <script src="{{ asset('assets/input-mask/jquery.inputmask.js') }}"></script>
        <!--JQuery TouchSwipe js-->
        <script src="{{ asset('assets/js/jquery.touchSwipe.min.js') }}"></script>

        <!--Select2 js -->
        <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/js/select2.js') }}"></script>

        <!-- Cookie js -->
        {{-- <script src="{{ asset('assets/plugins/cookie/jquery.ihavecookies.js') }}"></script> --}}
        <script src="{{ asset('assets/plugins/cookie/cookie.js') }}"></script>

        <!-- Count Down-->
        <script src="{{ asset('assets/plugins/count-down/jquery.lwtCountdown-1.0.js') }}"></script>

        <!-- Custom scroll bar Js-->
        <script src="{{ asset('assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js') }}"></script>

        <!-- sticky Js-->
        <script src="{{ asset('assets/js/sticky.js') }}"></script>
        <script src="{{ asset('assets/js/custom-sticky.js') }}"></script>


        <!-- Swipe Js-->
        <script src="{{ asset('assets/js/swipe.js') }}"></script>

        <!-- Custom Js-->
        <script src="{{ asset('assets/js/custom.js') }}"></script>
        <script src="{{ asset('assets/js/custom2.js') }}"></script>

        @stack('scripts')
    </body>
</html>
