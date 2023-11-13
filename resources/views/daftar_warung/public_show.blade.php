@extends('layouts.default')

@section('content')
<section class="sptb">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-12">
                <div class="card overflow-hidden">
                    {{-- <div class="ribbon ribbon-top-right text-danger"><span class="bg-danger">featured</span></div> --}}
                    <div class="card-body h-100">
                        <div class="item-det mb-4">
                            <a href="#" class="text-dark"><h3 class="">{{ $daftar_warung->nama_warung ?? __('Tiada Nama') }}</h3></a>
                            <div class=" d-flex">
                                <ul class="d-flex mb-0">
                                    {{-- <li class="mr-5"><a href="#" class="icons"><i class="si si-briefcase text-muted mr-1"></i> {{ $event->event_type->name ?? '' }}</a></li> --}}
                                    <li class="mr-5"><a href="#" class="icons"><i class="si si-location-pin text-muted mr-1"></i> {{ $daftar_warung->province->name }} </a></li>
                                    {{-- <li class="mr-5"><a href="#" class="icons"><i class="si si-calendar text-muted mr-1"></i> </a></li> --}}
                                    {{-- <li class="mr-5"><a href="#" class="icons"><i class="si si-eye text-muted mr-1"></i> 765</a></li> --}}
                                </ul>
                            </div>
                        </div>
                        <div class="product-slider">
                            <div id="carousel" class="carousel slide" data-ride="carousel">
                                {{-- <div class="arrow-ribbon2 bg-primary">{{ $applicant->registration_type_id == 1 ? __('Company') : null }}{{ $applicant->registration_type_id == 2 ? __('Private Individual') : null }}</div> --}}
                                <div class="carousel-inner">
                                    {{-- @if (empty($applicant->images))
                                    <div class="carousel-item active">
                                        <img src="{{ !empty($applicant->logo) ? asset($applicant->getLogoPath(['height' => 222, 'width' => 373])) : (!empty(option('app_logo')) ? asset(option('app_logo')) : asset('images/logo.png')) }}" alt="img"> </div>
                                    </div>
                                    @endif --}}

                                    @if (!empty($daftar_warung->images) || $daftar_warung->images->count() > 0)
                                        @foreach ($daftar_warung->images as $i => $image)
                                            <div @class(['carousel-item', 'active' => $i == 0])>
                                                <img src="{{ asset('storage/' . $image) }}" />
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                                    <i class="fa fa-angle-left" ></i>
                                </a>
                                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                                    <i class="fa fa-angle-right" ></i>
                                </a>
                            </div>
                            <div class="clearfix">
                                @if (!empty($daftar_warung->images))
                                <!--Image-carousel-->
                                <div id="thumbcarousel" class="carousel slide" data-interval="false">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            @foreach ($daftar_warung->images as $i => $image)
                                                <div data-target="#carousel" data-slide-to="{{ $i }}" class="thumb"><img src="{{ asset('storage/' . $image) }}" alt="img"></div>
                                                {{-- <div data-target="#carousel" data-slide-to="1" class="thumb"><img src="{{ asset('themes/pinlist/images/locations/2.jpg') }}" alt="img"></div>
                                                <div data-target="#carousel" data-slide-to="2" class="thumb"><img src="{{ asset('themes/pinlist/images/locations/3.jpg') }}" alt="img"></div>
                                                <div data-target="#carousel" data-slide-to="3" class="thumb"><img src="{{ asset('themes/pinlist/images/locations/4.jpg') }}" alt="img"></div>
                                                <div data-target="#carousel" data-slide-to="4" class="thumb"><img src="{{ asset('themes/pinlist/images/locations/5.jpg') }}" alt="img"></div> --}}
                                            @endforeach
                                        </div>
                                        {{-- <div class="carousel-item">
                                            <div data-target="#carousel" data-slide-to="0" class="thumb"><img src="{{ asset('themes/pinlist/images/locations/6.jpg') }}" alt="img"></div>
                                            <div data-target="#carousel" data-slide-to="1" class="thumb"><img src="{{ asset('themes/pinlist/images/locations/1.jpg') }}" alt="img"></div>
                                            <div data-target="#carousel" data-slide-to="2" class="thumb"><img src="{{ asset('themes/pinlist/images/locations/2.jpg') }}" alt="img"></div>
                                            <div data-target="#carousel" data-slide-to="3" class="thumb"><img src="{{ asset('themes/pinlist/images/locations/3.jpg') }}" alt="img"></div>
                                            <div data-target="#carousel" data-slide-to="4" class="thumb"><img src="{{ asset('themes/pinlist/images/locations/4.jpg') }}" alt="img"></div>
                                        </div> --}}
                                    </div>
                                    <a class="carousel-control-prev" href="#thumbcarousel" role="button" data-slide="prev">
                                        <i class="fa fa-angle-left" ></i>
                                    </a>
                                    <a class="carousel-control-next" href="#thumbcarousel" role="button" data-slide="next">
                                        <i class="fa fa-angle-right" ></i>
                                    </a>
                                </div>
                                <!--/Image-carousel-->
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!--Description-->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Profil Warung') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <p>{{ $daftar_warung->profil_warung ?? '' }}</p>
                        </div>
                    </div>
                </div>
                <!--Description-->
            </div>
            <div class="col-xl-4 col-lg-4 col-md-12">
                <!--Right Side Section-->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $daftar_warung->nama_warung ?? 'Tiada Nama' }}</h3>
                    </div>
                    <div class="card-body item-user">
                        <div class="profile-pic mb-0">
                            {{-- <img src="{{ !empty($applicant->logo) ? asset($applicant->getLogoPath(['height' => 222, 'width' => 373])) : (!empty(option('app_logo')) ? asset(option('app_logo')) : asset('images/logo.png')) }}" class="brround avatar-xxl" alt="user"> --}}
                            <div class="">
                                {{-- <a href="#" class="text-dark"><h4 class="mt-3 mb-1 font-weight-semibold"></h4></a> --}}
                                {{-- <span class="text-gray">Pinlist Tourism Director</span><br> --}}
                                {{-- <span class="text-muted">{{ sprintf(__('Member Since %s'), !empty($applicant->moderated_at) ? $applicant->moderated_at->format('F Y') : null) }}</span> --}}
                                {{-- <span class="text-muted">{{ implode(', ', array_filter([$applicant->address ?? '', $applicant->postcode ?? '', $applicant->city ?? '', $applicant->district ?? '', $applicant->state_name ?? ''])) }}</span> --}}
                                {{-- <h6 class="mt-2 mb-0"><a href="#" class="btn btn-primary btn-sm">See All Tours</a></h6> --}}
                                {{ implode(', ', array_filter([
                                    $daftar_warung->no_rumah ?? '',
                                    $daftar_warung->nama_jalan ?? '',
                                    $daftar_warung->village->name ?? '',
                                    $daftar_warung->city->name ?? '',
                                    $daftar_warung->district->name ?? '',
                                    $daftar_warung->province->name ?? ''
                                ])) }}
                            </div>

                        </div>
                    </div>
                    <div class="card-body item-user">
                        <h4 class="mb-4">{{ __('Informasi Untuk Dihubungi') }}</h4>
                        <div>
                            {{-- <h6><span class="font-weight-semibold"><i class="fa fa-envelope mr-2 mb-2"></i></span><a href="#" class="text-body"> {{ $daftar_warung->email ?? '' }}</a></h6> --}}
                            <h6><span class="font-weight-semibold"><i class="fa fa-phone mr-2  mb-2"></i></span><a href="#" class="text-primary"> {{ $daftar_warung->anggota->no_hp ?? '' }}</a></h6>
                            <h6><span class="font-weight-semibold"><i class="fa fa-phone mr-2  mb-2"></i></span><a href="#" class="text-primary"> {{ $daftar_warung->anggota->no_telp_keluarga ?? '' }}</a></h6>
                            {{-- <h6><span class="font-weight-semibold"><i class="fa fa-link mr-2 "></i></span><a href="#" class="text-primary">{{ $daftar_warung->website ?? '' }}</a></h6> --}}
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Lokasi Peta') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="map-header">
                            <div class="map-header-layer" id="map2"></div>
                        </div>
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
var marker;

var map;

function initMap() {
    const center = {
        lat: {{ !empty($daftar_warung->coordinates) ? $daftar_warung->coordinates->getLat() : -6.229728 }},
        lng: {{ !empty($daftar_warung->coordinates) ? $daftar_warung->coordinates->getLng() : 106.6894312 }}
    }

    map = new google.maps.Map(document.getElementById("map2"), {
        zoom: 10,
        center: center,
    });

    map.setCenter(center);

    var marker = new google.maps.Marker({
        map: map,
        position: center
    });
}
</script>
@endpush
