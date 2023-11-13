@extends('layouts.default')

@section('content')
    @php
        $provinces = new \App\Http\Controllers\SettingController();
        $provinces = $provinces->citiesJakarta();
    @endphp
    <section>
    <div class="banner-1 cover-image sptb-2 bg-background2" data-image-src="../assets/images/banners/business.jpg">
        <div class="header-text mb-0">
            <div class="container">
                <div class="text-center text-white ">
                    <h1 class="">{{ __('Warung Dewan Koperasi Indonesia  Pilihan Anda') }}</h1>
                    {{-- <p>It is a long established fact that a reader will be distracted by the readable content of a page.</p> --}}
                </div>
                <div class="row">
                    <div class="col-xl-8 col-lg-12 col-md-12 d-block mx-auto">
                        <div class="search-background">
                            <form class="form row no-gutters" action="{{ route('pages.daftar_warung.search') }}">
                                <div class="form-group  col-xl-6 col-lg-5 col-md-12 mb-0">
                                    <input type="text" name="q" class="form-control input-lg border-right-0" id="text" placeholder="{{ __('Cari') }}" value="{{ request()->query('q') }}">
                                </div>
                                <div class="form-group col-xl-4 col-lg-4 select2-lg  col-md-12 mb-0">
                                    <select name="provinsi" class="form-control select2-show-search border-bottom-0 w-100" data-placeholder="Select">
                                        <optgroup label="{{ __('Provinsi') }}">
                                            <option value="">{{ __('Semua Provinsi') }}</option>

                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->name }}"{!! is_array(request()->query('provinsi')) && in_array($province->name, request()->query('provinsi')) || request()->query('provinsi') == $province->name ? ' selected' : null !!}>{{ \Illuminate\Support\Str::title($province->name) }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="col-xl-2 col-lg-3 col-md-12 mb-0">
                                    <button type="submit" class="btn btn-lg btn-block btn-secondary">{{ __('Carian') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /header-text -->
    </div>
</section>

@if (\Illuminate\Support\Facades\Route::currentRouteName() == 'pages.daftar_warung.index')
<section class="sptb">
    <div class="container">
        <div class="section-title center-block text-center">
            <h1>{{ __('Warung Terbaru') }}</h1>
            {{-- <p>Mauris ut cursus nunc. Morbi eleifend, ligula at consectetur vehicula</p> --}}
        </div>
        <div id="feature-carousel" class="owl-carousel owl-carousel-icons">
            @foreach ($daftar_warungs as $warung)
            <div class="item">
                <div class="card mb-0">
                    {{-- <div class="arrow-ribbon bg-danger">Open</div> --}}
                    <div class="item-card7-imgs">
                        <a href=""></a>
                        <img src="{{ asset('storage/' . $warung->photo ?? '') }}" alt="img" class="cover-image" style="max-height: 200px; display: block; margin: auto; width: 100%;">
                    </div>
                    {{-- <div class="item-card7-overlaytext">
                        <a href="business.html" class="text-white"> Beauty & Spa </a>
                    </div> --}}
                    <div class="card-body">
                        <div class="item-card7-desc">
                            <div class="item-card7-text">
                                <a href="{{ route('pages.daftar_warung.show', $warung->id) }}" class="text-dark"><h4 class="font-weight-semibold">{{ $warung->nama_warung ?? __('Tiada Nama') }}&nbsp;</h4></a>
                            </div>
                            <ul class="d-flex">
                                <li class=""><a href="#" class="icons"><i class="si si-location-pin text-muted mr-1"></i> {{ $warung->province->name ?? ' ' }}</a></li>
                                {{-- <li><a href="#" class="icons"><i class="si si-event text-muted mr-1"></i>{{ $warung->created_at->format('d/m/Y') }}</a></li> --}}
                                <li class=""><a href="#" class="icons"><i class="si si-phone text-muted mr-1"></i> {{ $warung->anggota->no_hp ?? $warung->anggota->no_telpon ?? '' }}</a></li>
                            </ul>
                            {{-- <p class="mb-0" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis">{{ $warung->profil_warung }}&nbsp;</p> --}}
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="footerimg d-md-flex mt-0 mb-0">
                            <div class="d-flex footerimg-l mb-0">
                                <img src="{{ asset('assets/images/faces/female/18.jpg') }}" alt="image" class="avatar brround mr-2">
                                <h5 class="time-title text-muted p-0 leading-normal mt-2 mb-0">{{ $warung->anggota->nama_pemohon ?? '' }} <i class="si si-check text-success fs-12 ml-1" data-toggle="tooltip" data-placement="top" title="verified"></i></h5>
                            </div>
                            {{-- <div class="mt-2 footerimg-r ml-auto">
                                <a href="#" data-toggle="tooltip" data-placement="top" title="Comments"><span class="text-muted mr-2"><i class="fa fa-comment-o"></i> 16</span></a>
                                <a href="#" data-toggle="tooltip" data-placement="top" title="Views"><span class="text-muted"><i class="fa fa-eye"></i> 22</span></a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<section class="sptb">
    <div class="container">
        <div class="section-title center-block text-center">
            <h1>{{ __('Lokasi Warung Dinas Koperasi') }}</h1>
            {{-- <p>Mauris ut cursus nunc. Morbi eleifend, ligula at consectetur vehicula</p> --}}
        </div>
        <div class="row business-item">
            @foreach ($topProvinces as $province)
                @if (!empty($province->city->name))
                <div class="col-xl-4 col-md-12">
                    <div class="card overflow-hidden">
                        <div class="item-card">
                            <div class="item-card-desc">
                                <a href="{{ route('pages.daftar_warung.search', ['provinsi' => $province->city->name]) }}"></a>
                                <div class="item-card-img">
                                    <img src="https://maps.googleapis.com/maps/api/staticmap?key={{ env('GOOGLE_API_KEY') }}&center={{ str_replace(' ', '+', $province->city->name ?? '') }}+INDONESIA&size=187x156" alt="img" class="br-tr-7 br-tl-7">
                                </div>
                                <div class="item-card-text">
                                    <h4 class="mb-3">{{ $province->city->name ?? '' }}</h4>
                                    <button class="btn btn-secondary btn-pill">{{ $province->total ?? 0 }} Warung</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
@else
<section class="sptb">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-8 col-md-12">
                <!--Add lists-->
                <div class="card mb-lg-0">
                    <div class="card-body">
                        <div class="item2-gl ">
                            <div class="item2-gl-nav d-flex">
                                <ul class="nav item2-gl-menu ml-auto">
                                    <li class=""><a href="#tab-11" class="active show" data-toggle="tab" title="List style"><i class="fa fa-list"></i></a></li>
                                    <li><a href="#tab-12" data-toggle="tab" class="" title="Grid"><i class="fa fa-th"></i></a></li>
                                </ul>
                                <div class="d-flex">
                                    <label class="mr-2 mt-1 mb-sm-1" style="white-space: nowrap">{{ __('Susunan') }}:</label>
                                    <select name="item" class="form-control select-sm w-70">
                                        <option value="1">{{ __('Terkini') }}</option>
                                        <option value="2">{{ __('Paling Lama') }}</option>
                                        {{-- <option value="3">{{ __('Price:Low-to-High') }}</option>
                                        <option value="5">{{ __('Price:High-to-Low') }}</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-11">
                                    @foreach ($daftar_warungs as $b)
                                        <div class="card overflow-hidden">
                                            <div class="d-md-flex">
                                                <div class="item-card9-img">
                                                    {{-- <div class="arrow-ribbon bg-primary">Rent</div> --}}
                                                    <div class="item-card9-imgs">
                                                        <a href="{{ route('pages.daftar_warung.show', [$b->id]) }}"></a>
                                                        <img src="{{ asset('storage/' . $b->photo ?? '') }}" alt="img" class="cover-image">
                                                    </div>
                                                    {{-- <div class="item-card9-icons">
                                                        <a href="#" class="item-card9-icons1 wishlist"> <i class="fa fa fa-heart-o"></i></a>
                                                    </div> --}}
                                                </div>
                                                <div class="card border-0 mb-0">
                                                    <div class="card-body ">
                                                        <div class="item-card9">
                                                            {{-- <a href="#">RealEstate</a> --}}
                                                            <a href="{{ route('pages.daftar_warung.show', [$b->id]) }}" class="text-dark"><h4 class="font-weight-semibold mt-1">{{ $b->nama_warung ?? 'Tiada Nama' }}</h4></a>
                                                            <p class="mb-3 leading-tight">{{ $b->profil_warung }}</p>
                                                            <div class="item-card9-desc">
                                                                {{-- <a href="#" class="mr-4"><span class=""><i class="fa fa-briefcase text-muted mr-1"></i> {{ $b->registration_type_id == 1 ? __('Company') : null }}{{ $b->registration_type_id == 2 ? __('Private Individual') : null }}</span></a> --}}
                                                                {{-- <a href="#" class="mr-4"><span class=""><i class="fa fa-map-marker text-muted mr-1"></i> {{ $b->province->name ?? ' ' }}</span></a> --}}
                                                                {{-- <a href="#" class=""><span class=""><i class="fa fa-calendar-o text-muted mr-1"></i> {{ !empty($b->moderated_at) ? $b->moderated_at->format('d/m/Y') : null }}</span></a> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer pt-4 pb-4">
                                                        <div class="item-card9-footer d-flex">
                                                            <div class="item-card9-cost">
                                                                <a href="#" class="mr-4"><span class=""><i class="fa fa-map-marker text-muted mr-1"></i> {{ $b->province->name ?? ' ' }}</span></a>
                                                                {{-- <a href="#" class="mr-4"><span class="">{{ $b->registration_type_id == 1 ? __('Company') : null }}{{ $b->registration_type_id == 2 ? __('Private Individual') : null }}</span></a> --}}
                                                                {{-- <h4 class="text-dark font-weight-semibold mb-0 mt-0">RM{{ $b->fees }}</h4> --}}
                                                            </div>
                                                            {{-- <div class="ml-auto">
                                                                <div class="rating-stars block">
                                                                    <input type="number" readonly="readonly" class="rating-value star" name="rating-stars-value"  value="0">
                                                                    <div class="rating-stars-container">
                                                                        <div class="rating-star sm">
                                                                            <i class="fa fa-star-o"></i>
                                                                        </div>
                                                                        <div class="rating-star sm">
                                                                            <i class="fa fa-star-o"></i>
                                                                        </div>
                                                                        <div class="rating-star sm">
                                                                            <i class="fa fa-star-o"></i>
                                                                        </div>
                                                                        <div class="rating-star sm">
                                                                            <i class="fa fa-star-o"></i>
                                                                        </div>
                                                                        <div class="rating-star sm">
                                                                            <i class="fa fa-star-o"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="tab-pane" id="tab-12">
                                    <div class="row">
                                        @foreach ($daftar_warungs as $b)
                                            <div class="col-lg-6 col-md-12 col-xl-4">
                                                <div class="card overflow-hidden">
                                                    <div class="item-card9-img">
                                                        {{-- <div class="arrow-ribbon bg-primary">{{ $product->product_types }}</div> --}}
                                                        <div class="item-card9-imgs">
                                                            <a href="{{ route('pages.daftar_warung.show', [$b->id]) }}"></a>
                                                            <img src="{{ asset('storage/' . $b->photo ?? '') }}" alt="img" class="cover-image">
                                                        </div>
                                                        {{-- <div class="item-card9-icons">
                                                            <a href="#" class="item-card9-icons1 wishlist"> <i class="fa fa fa-heart-o"></i></a>
                                                        </div> --}}
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="item-card9">
                                                            {{-- <a href="#">RealEstate</a> --}}
                                                            <a href="{{ route('pages.daftar_warung.show', [$b->id]) }}" class="text-dark mt-2"><h4 class="font-weight-semibold mt-1">{{ $b->nama_warung ?? 'Tiada Nama' }}</h4></a>
                                                            {{-- <p class="mb-3 leading-tight">{{ implode(', ', array_filter([$b->address ?? '', $b->postcode ?? '', $b->city ?? '', $b->district ?? '', $b->state_name ?? ''])) }}</p> --}}
                                                            <p>{{ $b->profil_warung }}</p>
                                                            <div class="item-card9-desc">
                                                                {{-- <a href="#" class="mr-4"><span class=""><i class="fa fa-briefcase text-muted mr-1"></i> {{ $b->registration_type_id == 1 ? __('Company') : null }}{{ $b->registration_type_id == 2 ? __('Private Individual') : null }}</span></a> --}}
                                                                {{-- <a href="#" class="mr-4"><span class=""><i class="fa fa-map-marker text-muted mr-1"></i> {{ $b->province->name ?? ' ' }}</span></a> --}}
                                                                {{-- <a href="#" class=""><span class=""><i class="fa fa-calendar-o text-muted mr-1"></i> {{ !empty($b->closing_date) ? $b->closing_date->format('d/m/y') : null }}</span></a> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="item-card9-footer d-flex">
                                                            <div class="item-card9-cost">
                                                                <a href="#" class="mr-4"><span class=""><i class="fa fa-map-marker text-muted mr-1"></i> {{ $b->province->name ?? ' ' }}</span></a>
                                                                {{-- <h4 class="text-dark font-weight-semibold mb-0 mt-0">RM{{ $event->fees }}</h4> --}}
                                                                {{-- <a href="#" class="mr-4"><span class="">{{ $b->registration_type_id == 1 ? __('Company') : null }}{{ $b->registration_type_id == 2 ? __('Private Individual') : null }}</span></a> --}}
                                                            </div>
                                                            {{-- <div class="ml-auto">
                                                                <div class="rating-stars block" style="white-space: nowrap">
                                                                    <input type="number" readonly="readonly" class="rating-value star" name="rating-stars-value"  value="0">
                                                                    <div class="rating-stars-container">
                                                                        <div class="rating-star sm">
                                                                            <i class="fa fa-star-o"></i>
                                                                        </div>
                                                                        <div class="rating-star sm">
                                                                            <i class="fa fa-star-o"></i>
                                                                        </div>
                                                                        <div class="rating-star sm">
                                                                            <i class="fa fa-star-o"></i>
                                                                        </div>
                                                                        <div class="rating-star sm">
                                                                            <i class="fa fa-star-o"></i>
                                                                        </div>
                                                                        <div class="rating-star sm">
                                                                            <i class="fa fa-star-o"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="center-block text-center">
                            {{ $daftar_warungs->links() }}
                            {{-- <ul class="pagination mb-0">
                                <li class="page-item page-prev disabled">
                                    <a class="page-link" href="#" tabindex="-1">Prev</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item page-next">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul> --}}
                        </div>
                    </div>
                </div>
                <!--/Add lists-->
            </div>

            <!--Right Side Content-->
            <div class="col-xl-3 col-lg-4 col-md-12">
                <form action="{{ route('pages.daftar_warung.search') }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="input-group">
                                <input name="q" type="text" class="form-control br-tl-7 br-bl-7" placeholder="{{ __('Carian') }}" value="{{ request()->query('q') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary br-tr-7 br-br-7">
                                        {{ __('Carian') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Provinsi') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="" id="container">
                                <div class="filter-product-checkboxs">
{{--                                    @foreach ($provinces as $province)--}}
{{--                                        <label class="custom-control custom-checkbox mb-3">--}}
{{--                                            <input type="checkbox" class="custom-control-input" name="provinsi[]" value="{{ $province->name }}"{{ is_array(request()->query('provinsi')) && in_array($province->name, request()->query('provinsi')) || request()->query('provinsi') == $province->name ? ' checked' : null }}>--}}
{{--                                            <span class="custom-control-label">--}}
{{--                                                <a href="#" class="text-dark">{{ $province->name }}<!--span class="label label-secondary float-right">14</span--></a>--}}
{{--                                            </span>--}}
{{--                                        </label>--}}
{{--                                    @endforeach--}}

                                        <label class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" class="custom-control-input" name="provinsi[]" value="KABUPATEN ADM. KEP. SERIBU"{{ is_array(request()->query('provinsi')) && in_array('KABUPATEN ADM. KEP. SERIBU', request()->query('provinsi')) || request()->query('provinsi') == 'KABUPATEN ADM. KEP. SERIBU' ? ' checked' : null }}>
                                            <span class="custom-control-label">
                                                <a href="#" class="text-dark">KABUPATEN ADM. KEP. SERIBU<!--span class="label label-secondary float-right">14</span--></a>
                                            </span>
                                        </label>
                                        <label class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" class="custom-control-input" name="provinsi[]" value="KOTA ADM. JAKARTA PUSAT"{{ is_array(request()->query('provinsi')) && in_array('KOTA ADM. JAKARTA PUSAT', request()->query('provinsi')) || request()->query('provinsi') == 'KOTA ADM. JAKARTA PUSAT' ? ' checked' : null }}>
                                            <span class="custom-control-label">
                                                <a href="#" class="text-dark">KOTA ADM. JAKARTA PUSAT<!--span class="label label-secondary float-right">14</span--></a>
                                            </span>
                                        </label>
                                        <label class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" class="custom-control-input" name="provinsi[]" value="KOTA ADM. JAKARTA UTARA"{{ is_array(request()->query('provinsi')) && in_array('KOTA ADM. JAKARTA UTARA', request()->query('provinsi')) || request()->query('provinsi') == 'KOTA ADM. JAKARTA UTARA' ? ' checked' : null }}>
                                            <span class="custom-control-label">
                                                <a href="#" class="text-dark">KOTA ADM. JAKARTA UTARA<!--span class="label label-secondary float-right">14</span--></a>
                                            </span>
                                        </label>
                                        <label class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" class="custom-control-input" name="provinsi[]" value="KOTA ADM. JAKARTA BARAT"{{ is_array(request()->query('provinsi')) && in_array('KOTA ADM. JAKARTA BARAT', request()->query('provinsi')) || request()->query('provinsi') == 'KOTA ADM. JAKARTA BARAT' ? ' checked' : null }}>
                                            <span class="custom-control-label">
                                                <a href="#" class="text-dark">KOTA ADM. JAKARTA BARAT<!--span class="label label-secondary float-right">14</span--></a>
                                            </span>
                                        </label>
                                        <label class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" class="custom-control-input" name="provinsi[]" value="KOTA ADM. JAKARTA SELATAN"{{ is_array(request()->query('provinsi')) && in_array('KOTA ADM. JAKARTA SELATAN', request()->query('provinsi')) || request()->query('provinsi') == 'KOTA ADM. JAKARTA SELATAN' ? ' checked' : null }}>
                                            <span class="custom-control-label">
                                                <a href="#" class="text-dark">KOTA ADM. JAKARTA SELATAN<!--span class="label label-secondary float-right">14</span--></a>
                                            </span>
                                        </label>
                                        <label class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" class="custom-control-input" name="provinsi[]" value="KOTA ADM. JAKARTA TIMUR"{{ is_array(request()->query('provinsi')) && in_array('KOTA ADM. JAKARTA TIMUR', request()->query('provinsi')) || request()->query('provinsi') == 'KOTA ADM. JAKARTA TIMUR' ? ' checked' : null }}>
                                            <span class="custom-control-label">
                                                <a href="#" class="text-dark">KOTA ADM. JAKARTA TIMUR<!--span class="label label-secondary float-right">14</span--></a>
                                            </span>
                                        </label>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-secondary btn-block">{{ __('Search') }}</button>
                        </div>
                    </div>
                </form>
            <!--/Right Side Content-->
        </div>
    </div>
</section>
@endif
@endsection
