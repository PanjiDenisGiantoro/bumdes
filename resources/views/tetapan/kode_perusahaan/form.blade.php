@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Profil Perusahaan') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Profil Perusahaan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kode_perusahaan.index') }}">{{ __('Profil Koperasi') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah  Profil Perusahaan') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Profil Koperasi') }}</h5>
                <form method="POST" class="form-horizontal" action="{{ !empty($kodeperusahaan->id) ? route('kode_perusahaan.update', [$kodeperusahaan->id]) : route('kode_perusahaan.store') }}" enctype="multipart/form-data">

                    @if (!empty($kodeperusahaan->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="nama_perusahaan">{{ __('Nama Koperasi') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                                value="{{$kodeperusahaan->nama_perusahaan ?? ''}}"
                                            id="nama_perusahaan"
                                            name="nama_perusahaan"
                                            type="text"
                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_perusahaan')])
                                            />
                                            @error('nama_perusahaan')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                            </span>
                                             @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="kode_perusahaan">{{ __('Kode Koperasi') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                                value="{{$kodeperusahaan->kode_perusahaan ?? ''}}"
                                                id="kode_perusahaan"
                                                name="kode_perusahaan"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('kode_perusahaan')])
                                            />
                                            @error('kode_perusahaan')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="kode_cabang">{{ __('Kode Cabang') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                                value="{{$kodeperusahaan->kode_cabang ?? ''}}"
                                                id="kode_cabang"
                                                name="kode_cabang"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('kode_cabang')])
                                            />
                                            @error('kode_cabang')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>



                                <div class="form-group clearfix">
                                    <div class="row">
                                        <!-- <div class="col-md-3"> -->
                                                <div class="col-md-3">
                                                    <label class="control-label form-label" for="email_perusahaan">{{ __('Email') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input
                                                        value="{{$kodeperusahaan->email_perusahaan ?? ''}}"
                                                        id="email_perusahaan"
                                                        name="email_perusahaan"
                                                        type="email"
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('email_perusahaan')])
                                                    />
                                                    @error('email_perusahaan')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="no_handphone">{{ __('No. Handphone') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                value="{{$kodeperusahaan->no_handphone ?? ''}}"

                                                id="no_handphone"
                                                name="no_handphone"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('no_handphone')])
                                            />
                                            @error('no_handphone')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-1">
                                                <label class="control-label form-label" for="no_telpon">{{ __('No. Telpon') }}</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input
                                                    value="{{$kodeperusahaan->no_telpon ?? ''}}"

                                                    id="no_telpon"
                                                    name="no_telpon"
                                                    type="text"
                                                    @class(['required', 'form-control', 'is-invalid' => $errors->has('no_telpon')])
                                                />
                                                @error('no_telpon')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="alamat_utama">{{ __('Alamat Utama') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea
                                                id="alamat_utama"
                                                name="alamat_utama"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('alamat_utama')])
                                                rows="5"
                                            >{{$kodeperusahaan->alamat_utama ?? ''}}</textarea>
                                            @error('alamat_utama')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-9 offset-md-3">
                                            <div id="map" style="height: 300px; width: 100%"></div>
                                            <input type="text" class="form-control" name="coordinates" value="{{ !empty($kodeperusahaan->coordinates) ? $kodeperusahaan->coordinates->getLat() : null }} {{ !empty($kodeperusahaan->coordinates) ? $kodeperusahaan->coordinates->getLng() : null }}" readonly />
                                        </div>
                                    </div>
                                </div>

{{--                                <div class="form-group clearfix">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-3">--}}
{{--                                            <label class="control-label form-label" for="alamat_penagihan">{{ __('Alamat Penagihan') }}</label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-9">--}}
{{--                                            <textarea--}}
{{--                                                id="alamat_penagihan"--}}
{{--                                                name="alamat_penagihan"--}}
{{--                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('alamat_penagihan')])--}}
{{--                                                rows="5"--}}
{{--                                            >{{$kodeperusahaan->alamat_penagihan ?? ''}}</textarea>--}}
{{--                                            @error('alamat_penagihan')--}}
{{--                                                <span class="invalid-feedback" role="alert">--}}
{{--                                                    {{ $message }}--}}
{{--                                                </span>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}


{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="npwp">{{ __('Nomor NPWP') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                value="{{$kodeperusahaan->npwp ?? ''}}"
                                                id="npwp"
                                                name="npwp"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('npwp')])
                                                value="{{ old('npwp') }}"
                                            />
                                            @error('npwp')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label" for="image">{{ __('Logo Koperasi') }}</label>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-input">
                                                    <input type="hidden" name="exists_file_image" id="exists_file_image" value="{{$image[0] ?? ''}}">

                                                <input type="file" name="image" id="image" onchange="showPreview(event);">
                                                <label class="custom-file-label" id="label_image" for="image">Logo Perusahaan</label>
                                            </div>
                                        </div>
                                        </div>
                            </div>
                                <br>
                                <div class="form-group clearfix">
                                    <div class="row">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-4">
                                            <img id="file-ip-1-preview" width="250" height="200"src="{{ asset('storage/'. ($logo_perusahaan[0] ?? '')) }}">
                                            <!-- <br>
                                            <button type="button" class="btn btn-danger  fa fa-trash" onclick="deleteGambar()"></button> -->

                                     </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="card-footer border border-top-0 text-right">
                        <a href="{{ route('tetapan.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($kodeperusahaan->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($kodeperusahaan->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        function showPreview(event){
            if(event.target.files.length > 0){
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                document.getElementById('label_image').innerHTML = event.target.files[0].name
                document.getElementById('exists_file_image').value = event.target.files[0].name
                preview.src = src;
                preview.style.display = "block";
            }
        }

        function deleteGambar() {

            var preview = document.getElementById("file-ip-1-preview");
            document.getElementById('label_image').innerHTML = "Pilih File"
            document.getElementById('exists_file_image').value = ""
            preview.src = '';
            document.getElementById('image').value = ''

        }

        var geocoder;

        var marker;

        var map;

        function initMap() {
            const center = {
                lat: {{ !empty($kodeperusahaan->coordinates) ? $kodeperusahaan->coordinates->getLat() : -6.229728 }},
                lng: {{ !empty($kodeperusahaan->coordinates) ? $kodeperusahaan->coordinates->getLng() : 106.6894312 }}
            }

            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10,
                center: center,
            });

            marker = new google.maps.Marker({
                map: map,
                position: center
            });
        }

        function codeAddress() {
            var address = $('#alamat_utama').val();
            geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'address': address + ' Indonesia' ,
            }, function (results, status) {
                if (status == 'OK') {
                    map.setCenter(results[0].geometry.location);
                    if (typeof marker == "undefined") {
                        marker = new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.location
                        });
                    } else {
                        marker.setPosition(results[0].geometry.location);
                    }

                    $('input[name="coordinates"]').val(results[0].geometry.location.lat() + ',' + results[0].geometry.location.lng());
                } else {
                    alert('Geocode was not successful for address ' + address + ' the following reason: ' + status);
                }
            });
        }

        $('#alamat_utama').on('blur', function () {
            codeAddress();
        });
    </script>
@endpush
