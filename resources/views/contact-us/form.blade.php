@extends('layouts.default')

@section('content')
<div>
    <div class="bannerimg cover-image bg-background3" data-image-src="{{ asset('assets/images/banners/banner2.jpg') }}" style="background: url({{ asset('assets/images/banners/banner2.jpg') }}) center center;">
        <div class="header-text mb-0">
            <div class="container">
                <div class="text-center text-white ">
                    <h1 class="">{{ __('Hubungi Kami') }}</h1>
                    <!-- <ol class="breadcrumb text-center">
                        <li class="breadcrumb-item"><a href="/">{{ __('Beranda') }}</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">{{ __('Hubungi Kami') }}</li>
                    </ol> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="sptb">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12 mx-auto d-block">
                @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ $message }}
                </div>
                @endif

                @if ($message = Session::get('error'))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ $message }}
                </div>
                @endif

                <form method="POST">
                    @csrf

                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="{{ __('Nama') }}" value="{{ old('name') }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="{{ __('Alamat Email') }}" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="6" placeholder="{{ __('Pesan') }}">{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="validation" name="validation">
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Kirim') }}</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="card mb-0">
                    <div class="card-body mb-0 p-1">
                        <div id="map" style="min-height: 365px; width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="sptb bg-white">
    <div class="container">
        <div class="section-title center-block text-center">
            <h1>{{ __('Informasi Kontak') }}</h1>
            <!-- <p>Mauris ut cursus nunc. Morbi eleifend, ligula at consectetur vehicula</p> -->
        </div>
        <div class="support">
            <div class="row text-white">
                <div class="col-xl-4 col-lg-12 col-md-12">
                    <div class="support-service bg-primary br-2 mb-4 mb-xl-0">
                        <i class="fa fa-phone"></i>
                        <h6>081214153534</h6>
                        <p>Hubungi Lewat Nomor Ini</p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-12 col-md-12">
                    <div class="support-service bg-secondary br-2 mb-4 mb-xl-0">
                        <i class="fa fa-clock-o"></i>
                        <h6>Senin-Sabtu(10:00-19:00)</h6>
                        <p>Waktu Bekerja</p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-12  col-md-12">
                    <div class="support-service bg-warning br-2">
                        <i class="fa fa-envelope-o"></i>
                        <h6>dekopinda@gmail.com</h6>
                        <p>Pelayanan Kami</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&callback=initMap" async defer></script>
<script>
$('#validation').parent().hide();

var geocoder;

var marker;

var map;

function initMap() {
    const center = {
        lat: {{ $kode_perusahaan->coordinates->getLat() ?? -6.229728 }},
        lng: {{ $kode_perusahaan->coordinates->getLng() ?? 106.6894312 }}
    }

    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 10,
        center: center,
    });

     marker = new google.maps.Marker({
        map: map,
        position: center,
    });
}
</script>
@endpush
