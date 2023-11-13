<!doctype html>
<html lang="{{ config('app.locale') }}" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="msapplication-TileColor" content="#0f75ff">
    <meta name="theme-color" content="#9d37f6">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

    <!-- Title -->
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/fonts/fonts/font-awesome.min.css') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/plugins/bootstrap-4.1.3/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Sidemenu Css -->
    <link href="{{ asset('assets/css/sidemenu.css') }}" rel="stylesheet" />

    <!-- Dashboard css -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/admin-custom.css') }}" rel="stylesheet" />

    <!-- c3.js Charts Plugin -->
    <link href="{{ asset('assets/plugins/charts-c3/c3-chart.css') }}" rel="stylesheet" />

    <!---Font icons-->
    <link href="{{ asset('assets/plugins/iconfonts/plugin.css') }}" rel="stylesheet" />
</head>

<body>
    <div id="global-loader">
        <img src="{{ asset('assets/images/other/loader.svg') }}" class="loader-img floating" alt="">
    </div>

    <!--Page-->
    <div class="page ">
        <div class="page-content z-index-10">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-md-12 col-md-12 d-block mx-auto">
                        @if ($message = Session::get('error'))
                            @component('bs::alert', ['type' => 'danger', 'animated' => true, 'class' => ''])
                                {{ $message }}
                            @endcomponent
                         @endif

                        <div class="card mb-0">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('Log Masuk') }}</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="email" class="form-label text-dark">{{ __('Alamat email') }}</label>
                                        <input type="email" name="email" id="email" @class(['form-control', 'is-invalid' => $errors->has('email')]) placeholder="{{ __('Alamat email') }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                                            </div>
                                            <input name="password" type="password" value="" @class(['form-control', 'input', 'is-invalid' => $errors->has('password')]) id="password" placeholder="password" required="true" aria-label="password" aria-describedby="basic-addon1" />
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                            <div class="input-group-append">
                                                <span class="input-group-text" onclick="password_show_hide();">
                                                    <i class="fa fa-eye" id="show_eye"></i>
                                                    <i class="fa fa-eye-slash d-none" id="hide_eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                        {{-- <label for="password" class="form-label text-dark">{{ __('Password') }}</label>
                                        <input type="password" name="password" id="password" @class(['form-control', 'is-invalid' => $errors->has('password')]) placeholder="{{ __('Password') }}">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror --}}
                                    </div>

                                    <div class="form-group">
                                        <label class="custom-control custom-checkbox">
                                            <a href="{{ route('password.request') }}" class="float-right small text-dark mt-1">{{ __('Lupa password?') }}</a>
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label text-dark">{{ __('Ingat saya') }}</span>
                                        </label>
                                    </div>

                                    <div class="form-footer mt-2">
                                        <button type="submit" class="btn btn-primary btn-block">{{ __('Log Masuk') }}</button>
                                    </div>
                                    {{-- <div class="text-center  mt-3 text-dark">
                                        Don't have account yet? <a href="register.html">SignUp</a>
                                    </div> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <!-- P-scroll js-->
    <script src="{{ asset('assets/plugins/p-scrollbar/p-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/plugins/p-scrollbar/p-scroll1.js') }}"></script>

    <!-- Fullside-menu Js-->
    <script src="{{ asset('assets/plugins/toggle-sidebar/sidemenu.js') }}"></script>

    <!--Counters -->
    <script src="{{ asset('assets/plugins/counters/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/counters/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/counters/numeric-counter.js') }}"></script>

    <!-- Custom Js-->
    <script src="{{ asset('assets/js/admin-custom.js') }}"></script>
    <script>
        function password_show_hide() {
  var x = document.getElementById("password");
  var show_eye = document.getElementById("show_eye");
  var hide_eye = document.getElementById("hide_eye");
  hide_eye.classList.remove("d-none");
  if (x.type === "password") {
    x.type = "text";
    show_eye.style.display = "none";
    hide_eye.style.display = "block";
  } else {
    x.type = "password";
    show_eye.style.display = "block";
    hide_eye.style.display = "none";
  }
}
    </script>
</body>

</html>
