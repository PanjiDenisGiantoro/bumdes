@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Cabang') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Cabang') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('cabang.index') }}">{{ __('Cabang') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Edit  Cabang') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Edit Cabang') }}</h5>
                <form method="POST" class="form-horizontal" action="{{ !empty($cabang->id) ? route('cabang.update', [$cabang->id]) : route('cabang.store') }}" enctype="multipart/form-data">

                    @if (!empty($cabang->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="kode_koperasi">{{ __('Kode Perusahaan') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input
                                                value="{{$cabang->kode_koperasi ?? ''}}"
                                                readonly
                                                id="kode_koperasi"
                                                name="kode_koperasi"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('kode_koperasi')])
                                            />
                                            @error('kode_koperasi')
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
                                            <label class="control-label form-label" for="nama_cabang">{{ __('Nama Cabang') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                value="{{$cabang->nama_cabang ?? ''}}"
                                                id="nama_cabang"
                                                name="nama_cabang"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_cabang')])
                                            />
                                            @error('nama_cabang')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="kode_cabang">{{ __('Kode Cabang') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                value="{{$cabang->kode_cabang ?? ''}}"
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
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="jenis_cabang">{{ __('Jenis Cabang') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            @if($cabangfind == 0)
                                                <select name="jenis_cabang" id="" class="form-control select2"readonly>
                                                    <option value="pusat">Kantor Pusat</option>
                                                </select>
                                            @else
                                                @if($cabang->kode_koperasi == '001')
                                                    <select name="jenis_cabang" id="" class="form-control select2" readonly>
                                                        <option value="pusat">Kantor Pusat</option>
                                                    </select>
                                                @else
                                                    <select name="jenis_cabang" id="" class="form-control select2">
                                                        <option value="kantor"@if(!empty($cabang->jenis_cabang) ? $cabang->jenis_cabang == 'kantor' : '') selected @endif>Kantor Cabang</option>
                                                        <option value="usaha"@if(!empty($cabang->jenis_cabang) ? $cabang->jenis_cabang == 'usaha' : '') selected @endif>Unit Usaha</option>
                                                    </select>

                                                @endif
                                            @endif

{{--                                            <input--}}
{{--                                                value="{{$cabang->jenis_cabang ?? ''}}"--}}
{{--                                                id="jenis_cabang"--}}
{{--                                                name="jenis_cabang"--}}
{{--                                                type="text"--}}
{{--                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('jenis_cabang')])--}}
{{--                                            />--}}
                                            @error('jenis_cabang')
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
                                            <label class="control-label form-label" for="email">{{ __('Email') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                value="{{$cabang->email ?? ''}}"
                                                id="email"
                                                name="email"
                                                type="email"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('email')])
                                            />
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="no_telp">{{ __('No. Handphone') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                value="{{$cabang->no_telp ?? ''}}"

                                                id="no_telp"
                                                name="no_telp"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('no_telp')])
                                            />
                                            @error('no_telp')
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
                                            <label class="control-label form-label" for="pic">{{ __('Manager Cabang') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                value="{{$cabang->pic ?? ''}}"
                                                id="pic"
                                                name="pic"
                                                type="pic"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('pic')])
                                            />
                                            @error('pic')
                                            <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="tanggal_operasi">{{ __('Tanggal Operasi') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                value="{{$cabang->tanggal_operasi ?? ''}}"

                                                id="tanggal_operasi"
                                                name="tanggal_operasi"
                                                type="date"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('tanggal_operasi')])
                                            />
                                            @error('tanggal_operasi')
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
                                            <label class="control-label form-label" for="alamat_cabang">{{ __('Alamat') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea
                                                id="alamat_cabang"
                                                name="alamat_cabang"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('alamat_cabang')])
                                                rows="5"
                                            >{{$cabang->alamat_cabang ?? ''}}</textarea>
                                            @error('alamat_cabang')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix" id="iii">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="Provinsi">{{ __('Provinsi') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            @php
                                                $provinces = new \App\Http\Controllers\SettingController();
                                                $provinces = $provinces->provinces();
                                            @endphp
                                            <select class="form-control" name="provinsi" id="provinsi" required>
                                                <option value="">==Pilih Salah Satu==</option>
                                                @foreach ($provinces as $item)
                                                    <option value="{{ $item->id }}" @if (!empty($cabang->provinsi) && $cabang->provinsi == $item->id)selected @endif>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="text"value="{{ $daftar_warung->provinsi ?? '' }}" id="provinsi1" hidden>
                                        <input type="text"value="{{ $daftar_warung->kota ?? '' }}" id="kota1" hidden>
                                        <input type="text"value="{{ $daftar_warung->kecamatan ?? '' }}" id="kecamatan1"hidden>
                                        <input type="text"value="{{ $daftar_warung->desa ?? '' }}" id="desa1"hidden>

                                        <input type="text" value="{{ $daftar_warung->id ?? '' }}" name="idd" hidden >

                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="kota">{{ __('Kabupaten/Kota') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            @php
                                                $cities = \Indonesia::findProvince($cabang->provinsi, ['cities']);

                                                if (!empty($cities)) {
                                                    $cities = $cities->cities->pluck('name', 'id');
                                                } else {
                                                    $cities = collect();
                                                }
                                            @endphp
                                            <select class="form-control" name="kota" id="kota" required>
                                                <option value="">==Pilih Salah Satu==</option>
                                                @foreach ($cities as $id => $city)
                                                    <option value="{{ $id }}" @if (!empty($cabang->kota) && $cabang->kota == $id)selected @endif>{{ $city }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix" id="iiii">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="kode_pos">{{ __('Kecamatan') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            @php
                                                $districts = \Indonesia::findCity($cabang->kota, ['districts']);

                                                if (!empty($districts->districts)) {
                                                    $districts = $districts->districts->pluck('name', 'id');
                                                } else {
                                                    $districts = collect();
                                                }
                                            @endphp
                                            <select class="form-control" name="kecamatan" id="kecamatan" required>
                                                <option value="">==Pilih Salah Satu==</option>
                                                @foreach ($districts as $id => $district)
                                                    <option value="{{ $id }}" @if (!empty($cabang->kecamatan) && $cabang->kecamatan == $id)selected @endif>{{ $district }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="bumdes">{{ __('Kelurahan/Desa') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            @php
                                                $villages = \Indonesia::findDistrict($cabang->kecamatan, ['villages']);
                                                if (!empty($villages->villages)) {
                                                    $villages = $villages->villages->pluck('name', 'id');
                                                } else {
                                                    $villages = collect();
                                                }
                                            @endphp
                                            <select class="form-control" name="desa" id="desa" required>
                                                <option value="">==Pilih Salah Satu==</option>
                                                @foreach ($villages as $id => $village)
                                                    <option value="{{ $id }}" @if (!empty($cabang->desa) && $cabang->desa == $id)selected @endif>{{ $village }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="">Peta</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div id="gmap" class="border" style="min-height: 300px"></div>
                                            <input type="text" class="form-control" name="coordinates" readonly/>

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
                                {{--                                            >{{$cabang->alamat_penagihan ?? ''}}</textarea>--}}
                                {{--                                            @error('alamat_penagihan')--}}
                                {{--                                                <span class="invalid-feedback" role="alert">--}}
                                {{--                                                    {{ $message }}--}}
                                {{--                                                </span>--}}
                                {{--                                            @enderror--}}
                                {{--                                        </div>--}}


                                {{--                                    </div>--}}
                                {{--                                </div>--}}


                                <br>
                            </div>
                        </div>
                        <div class="card-footer border border-top-0 text-right">
                            <a href="{{ route('tetapan.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($cabang->id) ? __('Kembali') : __('Kembali') }}</a>
                            <button type="submit" class="btn btn-primary">{{ !empty($cabang->id) ? __('Perbaharui') : __('Kirim') }}</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        $('.select2').select2({
            width: '100%'
        });
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
                lat: {{ !empty($cabang->coordinates) ? $cabang->coordinates->getLat() : -6.229728 }},
                lng: {{ !empty($cabang->coordinates) ? $cabang->coordinates->getLng() : 106.6894312 }}
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

        function onChangeSelect(url, id, name) {
            // send ajax request to get the cities of the selected province and append to the select tag
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    id: id
                },
                success: function (data) {
                    $('#' + name).empty();
                    $('#' + name).append('<option value="">==Pilih Salah Satu==</option>');

                    $.each(data, function (key, value) {
                        $('#' + name).append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }

        $(function () {
            $('#provinsi').on('change', function () {
                onChangeSelect('{{ route("cities") }}', $(this).val(), 'kota');
            });
            $('#kota').on('change', function () {
                onChangeSelect('{{ route("districts") }}', $(this).val(), 'kecamatan');
            })
            $('#kecamatan').on('change', function () {
                onChangeSelect('{{ route("villages") }}', $(this).val(), 'desa');
            })
        });


    </script>
    <script>
        var geocoder;

        var marker;

        var map;

        function initMap() {
            const center = {
                lat: -6.229728,
                lng: 106.6894312
            }

            map = new google.maps.Map(document.getElementById("gmap"), {
                zoom: 10,
                center: center,
            });
        }

        function codeAddress() {
            var address = $('#desa option:selected').text() + ' ' + $('#kecamatan option:selected').text() + ' ' + $('#kota option:selected').text() + ' ' + $('#provinsi option:selected').text();

            geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'address': address + ' Indonesia',
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

        $('#kota,#provinsi,#kecamatan,#desa').on('change', function () {
            codeAddress();
        });
    </script>
@endpush
