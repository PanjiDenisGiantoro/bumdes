@extends('pengajuans.layouts_pengajuan.app')

@section('content')
{{--    @include('pengajuans.layouts_pengajuan.headers.cards')--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .kbw-signature { width: 100%; height: 200px;}
        #sig canvas{
            width: 100% !important;
            height: auto;
        }
    </style>
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0"></h6>
                        <br>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <br>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <div class="card-title">
                            <h3 class=" title-2">Biodata Diri</h3>
                        </div>
                        <div class="col-12">
                            <form action="{{route('pengajuan.store')}}" method="post"  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">NIK</label>
                                            <input type="text" name="nik"
                                                   @class(['form-control', 'is-invalid' => $errors->has('nik')])
                                            value="{{ old('nik') }}" >
                                            @error('nik')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nama</label>
                                            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tgl Lahir</label>
                                            <input type="date" name="tgl_lahir" class="form-control"value="{{ old('date') }}" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">No Telp</label>
                                            <input type="text" name="no_telp" class="form-control"value="{{ old('no_telp') }}" >
                                        </div>
                                    </div>
                                    {{--                                            textarea--}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Alamat</label>
                                            <textarea name="alamat" id="" cols="10" rows="3" class="form-control" ></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Bumdes</label>
                                            <input type="text" name="bumdes" class="form-control"value="{{ old('bumdes') }}" >
                                        </div>
                                    </div>

                                        <div class="col-md-4">
                                            @php
                                                $provinces = new \App\Http\Controllers\SettingController();
                                                $provinces= $provinces->provinces();
                                            @endphp
                                            <div class="form-group">

                                            <label class="control-label form-label" for="rtrw">{{ __('Provinsi') }}</label>

                                            <select class="form-control select2" name="provinsi" id="provinsi" required>
                                                <option value="">==Pilih Salah Satu==</option>
                                                @foreach ($provinces as $item)
                                                    <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <label class="control-label form-label" for="kota">{{ __('Kabupaten / Kota ') }}<span class="text-red">*</span></label>

                                            <select class="form-control select2" name="kota" id="kota" required>
                                                <option value="">==Pilih Salah Satu==</option>
                                            </select>
                                        </div>
                                        </div>

                                    <div class="col-md-4">
                                        <div class="form-group">

                                        <label class="control-label form-label" for="kode_pos">{{ __('Kecamatan') }}<span class="text-red">*</span></label>
                                        <select class="form-control select2" name="kecamatan" id="kecamatan" required>
                                            <option value="">==Pilih Salah Satu==</option>
                                        </select>
                                        </div>
                                        </div>

                                    <div class="col-md-4">
                                        <div class="form-group">

                                        <label class="control-label form-label" for="desa">{{ __('Kelurahan / Desa ') }}<span class="text-red">*</span></label>

                                        <select class="form-control select2" name="desa" id="desa" required>
                                            <option value="">==Pilih Salah Satu==</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label class="control-label form-label" for="kode_pos">{{ __('Kode Pos') }}<span class="text-red">*</span></label>
                                            <input type="text" class="form-control" name="kode_pos">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label class="control-label form-label" for="usaha">{{ __('Keterangan Usaha') }}</label>
                                            <input type="text" class="form-control" name="keterangan_usaha">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label class="control-label form-label" for="usaha">{{ __('Ibu Kandung') }}</label>
                                            <input type="text" class="form-control" name="ibu_kandung">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card-title">
                                            <h3 class=" title-2">Info Margin</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Plafon</label>
                                            <input  type="text" hidden name="plafon"  id="plafon" class="form-control " >
                                            <input type="text" name="plafon_text" id="plafon_text" class="form-control " >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Pendapatan</label>
                                            <input type="text"hidden name="pendapatan"  id="pendapatan" class="form-control" >
                                            <input type="text" name="pendapatan_text" id="pendapatan_text" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Pengeluaran</label>
                                            <input type="text"hidden name="pengeluaran"  id="pengeluaran" class="form-control" >
                                            <input type="text" name="pengeluaran_text" id="pengeluaran_text" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Durasi</label>
                                            <input type="text" name="margin" id="margin" hidden class="form-control" value="{{$margin->margin ?? ''}}">
                                            <select name="durasi" id="durasi" class="form-control">
                                                <option value=""></option>
                                                @foreach($durasi as $d)
                                                    <option value="{{$d->id}}" data-durasi="{{$d->durasi}}">{{$d->durasi}} Bulan</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{--                                            Button hitung--}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="button" id="hitung" class="btn btn-primary">Hitung </button> <span>Rasio {{$rasio->rasio ?? ''}} % & Margin {{$margin->margin ?? ''}} %</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="i">
                                        <div class="form-group">
                                            <label for="">Angsuran At-taqwa</label>
                                            <input type="text" name="angsuran" hidden id="angsuran" class="form-control"  readonly>
                                            <h5 id="angsuran_text"></h5>
                                            {{--                                            <input type="text" name="angsuran_text" id="angsuran_text" class="form-control"  readonly>--}}
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="ii">
                                        <div class="form-group">
                                            <label for="">total Pengeluaran</label>
                                            <input type="text" name="total_pengeluaran" hidden id="total_pengeluaran" class="form-control" readonly>
                                            <h5 id="total_pengeluaran_text"></h5>

                                            {{--                                            <input type="text" name="total_pengeluaran_text" id="total_pengeluaran_text" class="form-control" readonly>--}}
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="iii">
                                        <div class="form-group">
                                            <label for="">Sisa Dana</label>
                                            <input type="text" name="sisa_dana" hidden id="sisa_dana" class="form-control" readonly>
                                            <h5 id="sisa_dana_text"></h5>

                                            {{--                                            <input type="text" name="sisa_dana_text" id="sisa_dana_text" class="form-control" readonly>--}}
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="iiii">
                                        <div class="form-group">
                                            <label for="">Rasio</label>
                                            <input type="text" name="rasio" id="rasio" class="form-control" value="{{$rasio->rasio}}"  hidden readonly>
                                            <input type="text" name="rasio_keterangan" id="rasio_keterangan" class="form-control" readonly>
                                            <input type="text" name="status" id="status" class="form-control" readonly hidden >

                                        </div>
                                    </div>
{{--                                    <div class="col-md-8"></div>--}}
{{--                                    <div class="col-md-4" id="iiiiii">--}}
{{--                                        <label class="" for="">Tanda Tangan Online:</label>--}}
{{--                                        <br/>--}}
{{--                                        <div id="sig" ></div>--}}
{{--                                        <br/>--}}
{{--                                        <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>--}}
{{--                                        <textarea id="signature64" name="signed" style="display: none"></textarea>--}}
{{--                                    </div>--}}



                                    <div class="col-md-12">
                                        <div class="card-title">
                                            <h3 class=" title-2">Gambar Pribadi</h3>
                                        </div>
                                    </div>
{{--                                    <div class="col-md-6">--}}
{{--                                        <label class="form-label" for="file_ktp">{{ __('Upload KTP') }} </span></label>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <label class="form-label" for="file_selfi">{{ __('Upload Selfi') }} </span></label>--}}
{{--                                    </div>--}}
                                    <div class="col-md-6">
                                        <input type="file" class="custom-file-input" name="file_ktp" id="file_ktp"onchange="showPreview(event);" >
                                        <label class="custom-file-label" id="label_ktp" for="file_ktp">Pilih Gambar KTP</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="file" class="custom-file-input" name="file_serfie" id="file_serfie"onchange="showPreview1(event);" >
                                        <label class="custom-file-label" id="label_ktp1" for="file_ktp">Pilih Gambar Selfi</label>
                                    </div>
                                    <div class="col-md-6">
                                            <img id="file-ip-1-preview" width="250" height="200">
                                        <a href="#" class="btn btn-outline-warning fa fa-trash" style="margin-bottom: 30px"  data-toggle="modal" data-target="#deleteonModal"  id="delete_btn"></a>
                                    </div>
                                    <div class="col-md-6">
                                        <img id="file-ip-1-preview1" width="250" height="200">
                                        <a href="#" class="btn btn-outline-warning fa fa-trash" style="margin-bottom: 30px"  data-toggle="modal" data-target="#deleteonModal1"  id="delete_btn1"></a>
                                    </div>
                                    <br>
                                    <div class="col-md-12 mt-4">
                                        <div class="card-title">
                                            <h3 class=" title-2">Gambar Usaha</h3>
                                        </div>
                                    </div>

{{--                                        <div class="col-md-2">--}}
{{--                                            <label class="form-label" for="file_ktp">{{ __(' Gambar 1') }}</label>--}}
{{--                                        </div>--}}
                                        <div class="col-md-6">
                                            <input type="file" class="custom-file-input" name="file_ktpg" id="file_ktpg"
                                                   onchange="showPreviewg(event);">
                                            <label class="custom-file-label" id="label_ktpg" for="file_ktp">Gambar Usaha 1</label>
                                        </div>
{{--                                        <div class="col-md-2">--}}
{{--                                            <label class="form-label" for="file_fktp2">{{ __(' Gambar 2') }}</label>--}}
{{--                                        </div>--}}
                                        <div class="col-md-6">
                                            <input type="file" class="custom-file-input" name="file_fktp2" id="file_fktp2g"
                                                   onchange="showPreview2g(event);">
                                            <label class="custom-file-label" id="label_ktp2g" for="file_fktp2g">Gambar Usaha 2</label>
                                        </div>
                                    <div class="mt-5" ></div>
{{--                                        <div class="col-sm-2">--}}
{{--                                            <label class="form-label" for="file_fktp3">{{ __(' Gambar 3') }}</label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <input type="file" class="custom-file-input" name="file_fktp3" id="file_fktp3"--}}
{{--                                                   onchange="showPreview3(event);">--}}
{{--                                            <label class="custom-file-label" id="label_ktp3" for="file_fktp3">Gambar Usaha 3</label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-2">--}}
{{--                                            <label class="form-label" for="file_fktp4">{{ __(' Gambar 4') }}</label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <input type="file" class="custom-file-input" name="file_fktp4" id="file_fktp4"--}}
{{--                                                   onchange="showPreview4(event);">--}}
{{--                                            <label class="custom-file-label" id="label_ktp4" for="file_fktp4">Gambar Usaha 4</label>--}}
{{--                                        </div>--}}

                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <h5>Gambar 1</h5>

                                            <img id="file-ip-1-previewg" width="250" height="200" src="">
                                            <a href="#" class="btn btn-outline-danger fa fa-trash" style="margin-bottom: 30px"  data-toggle="modal" data-target="#deleteonModal1g"  id="delete_btn1"></a>


                                        </div>
                                        <div class="col-md-6">
                                            <h5>Gambar 2</h5>
                                            <img id="file-ip-1-preview2g" width="250" height="200" src="">
                                            <a href="#" class="btn btn-outline-danger fa fa-trash" style="margin-bottom: 30px"  data-toggle="modal" data-target="#deleteonModal2g"  id="delete_btn2"></a>

                                        </div>
{{--                                        <div class="col-md-3">--}}
{{--                                            <h5>Gambar 3</h5>--}}

{{--                                            <img id="file-ip-1-preview3" width="250" height="200" src="">--}}
{{--                                            <a href="#" class="btn btn-outline-danger fa fa-trash" style="margin-bottom: 30px"  data-toggle="modal" data-target="#deleteonModal3"  id="delete_btn3"></a>--}}


{{--                                        </div>--}}
{{--                                        <div class="col-md-3">--}}
{{--                                            <h5>Gambar 4</h5>--}}

{{--                                            <img id="file-ip-1-preview4" width="250" height="200">--}}
{{--                                            <a href="#" class="btn btn-outline-danger fa fa-trash" style="margin-bottom: 30px"  data-toggle="modal" data-target="#deleteonModal4"  id="delete_btn4"></a>--}}

{{--                                        </div>--}}
                                    </div>

                                    {{--                                            card title--}}



                                    <div class="col-md-12" id="iiiii">
                                        <div class="form-group text-center">
                                            <button class="btn btn-info btn-lg">Simpan</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade zoom" tabindex="-1" id="deleteonModal">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <center> <i class="fe fe-alert-circle fa-4x" style="color: red;"></i></center>
                    <br>
                    <center><h2>Notifikasi</h2></center>
                    <p style="text-align: center;font-size: 15px">Adakah Anda Ingin Melanjutkan Proses Ini ? </p>
                    <div class="text-center">
                        <a href="#" class="btn btn-md btn-primary mr-3" id="deleteBtn">
                            Lanjutkan
                        </a>
                        <a data-dismiss="modal" href="#" class="btn btn-md btn-danger">
                            Tidak
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade zoom" tabindex="-1" id="deleteonModal1">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <center> <i class="fe fe-alert-circle fa-4x" style="color: red;"></i></center>
                    <br>
                    <center><h2>Notifikasi</h2></center>
                    <p style="text-align: center;font-size: 15px">Adakah Anda Ingin Melanjutkan Proses Ini ? </p>
                    <div class="text-center">
                        <a href="#" class="btn btn-md btn-primary mr-3" id="deleteBtn1">
                            Lanjutkan
                        </a>
                        <a data-dismiss="modal" href="#" class="btn btn-md btn-danger">
                            Tidak
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    gambar usaha--}}
    <div class="modal fade zoom" tabindex="-1" id="deleteonModal1g">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Apakah Gambar Ini akan di Hapus?</p>
                    <button type="submit" class="btn btn-md btn-primary" id="deleteBtn1g">
                        Lanjutkan
                    </button>
                    <a data-dismiss="modal" href="#" class="btn btn-md btn-outline-danger">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade zoom" tabindex="-1" id="deleteonModal2g">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Apakah Gambar Ini akan di Hapus?</p>
                    <button type="submit" class="btn btn-md btn-primary" id="deleteBtn2g">
                        Lanjutkan
                    </button>
                    <a data-dismiss="modal" href="#" class="btn btn-md btn-outline-danger">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade zoom" tabindex="-1" id="deleteonModal3">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Apakah Gambar Ini akan di Hapus?</p>
                    <button type="submit" class="btn btn-md btn-primary" id="deleteBtn3">
                        Lanjutkan
                    </button>
                    <a data-dismiss="modal" href="#" class="btn btn-md btn-outline-danger">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade zoom" tabindex="-1" id="deleteonModal4">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Apakah Gambar Ini akan di Hapus?</p>
                    <button type="submit" class="btn btn-md btn-primary" id="deleteBtn4">
                        Lanjutkan
                    </button>
                    <a data-dismiss="modal" href="#" class="btn btn-md btn-outline-danger">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->

    @include('pengajuans.layouts_pengajuan.footers.auth')

@endsection
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
          rel="stylesheet">
    <link type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://keith-wood.name/css/jquery.signature.css">


@push('js')
    {{--    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>--}}
    {{--    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>--}}
    {{--cdn jquery  --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8-beta.17/inputmask.es6.js" integrity="sha512-G307IbFqmfwXgQa2Jbxp4+4HeTp++lVOXNsNadeRIVqBsltSJgpprtBaz2GTs8WBq+KfxUJwfTGSvGV/Xd5AnQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    {{--cdn input mask--}}
    <script src="https://keith-wood.name/js/jquery.signature.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script>
        $(document).ready(function () {
            var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
            $('#clear').click(function(e) {
                e.preventDefault();
                sig.signature('clear');
                $("#signature64").val('');
            });
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

        $('#provinsi').on('change', function () {
            onChangeSelect('{{ route("cities") }}', $(this).val(), 'kota');
        });
        $('#kota').on('change', function () {
            onChangeSelect('{{ route("districts") }}', $(this).val(), 'kecamatan');
        })
        $('#kecamatan').on('change', function () {
            onChangeSelect('{{ route("villages") }}', $(this).val(), 'desa');
        })
        $('#deleteBtn1g').on('click', function() {
            deleteGambarg();
            $('#deleteonModal1g').modal('hide');
            Swal.fire({
                icon: 'success',
                text: 'Gambar Warung 1 Berhasil Terhapus!',
            });
            return false;
        });

        $('#deleteBtn2g').on('click', function() {
            deleteGambar2g();
            $('#deleteonModal2g').modal('hide');
            Swal.fire({
                icon: 'success',
                text: 'Gambar Warung 2 Berhasil Terhapus!',
            });
            return false;
        });
        $('#deleteBtn3').on('click', function() {
            deleteGambar3();
            $('#deleteonModal3').modal('hide');
            Swal.fire({
                icon: 'success',
                text: 'Gambar Warung 3 Berhasil Terhapus!',
            });
            return false;
        });
        $('#deleteBtn4').on('click', function() {
            deleteGambar4();
            $('#deleteonModal4').modal('hide');
            Swal.fire({
                icon: 'success',
                text: 'Gambar Warung 4 Berhasil Terhapus!',
            });
            return false;
        });

        function showPreviewg(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-previewg");
                document.getElementById('label_ktpg').innerHTML = event.target.files[0].name
                preview.src = src;
                preview.style.display = "block";
            }
        }

        function showPreview2g(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview2g");
                document.getElementById('label_ktp2g').innerHTML = event.target.files[0].name
                preview.src = src;
                preview.style.display = "block";
            }
        }

        function showPreview3(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview3");
                document.getElementById('label_ktp3').innerHTML = event.target.files[0].name
                preview.src = src;
                preview.style.display = "block";
            }
        }

        function showPreview4(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview4");
                document.getElementById('label_ktp4').innerHTML = event.target.files[0].name
                preview.src = src;
                preview.style.display = "block";
            }
        }

        function deleteGambarg() {

            var preview = document.getElementById("file-ip-1-previewg");
            document.getElementById('label_ktpg').innerHTML = "Pilih File"
            preview.src = '';
            document.getElementById('file_ktp').value = ''

        }
        function deleteGambar2g() {

            var preview = document.getElementById("file-ip-1-preview2");
            document.getElementById('label_ktp2').innerHTML = "Pilih File"
            preview.src = null;
            document.getElementById('file_fktp2').value = ''

        }


        function deleteGambar3() {

            var preview = document.getElementById("file-ip-1-preview3");
            document.getElementById('label_ktp3').innerHTML = "Pilih File"
            preview.src = null;
            document.getElementById('file_fktp3').value = ''

        }

        function deleteGambar4() {

            var preview = document.getElementById("file-ip-1-preview4");
            document.getElementById('label_ktp4').innerHTML = "Pilih File"
            preview.src = null;
            document.getElementById('file_fktp4').value = ''

        }


        function showPreview(event){
            console.log(event.target.files[0]);
            //if image size is less than 1 MB
            if(event.target.files[0].size < 1000000) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                document.getElementById('label_ktp').innerHTML = event.target.files[0].name
                preview.src = src;
                preview.style.display = "block";
                $('#delete_btn').show();
                $('#file-ip-1-preview').show();

            }else{
                Swal.fire({
                    icon: 'error',
                    text: 'Ukuran Gambar Terlalu Besar!',
                });
            }

        }

        function showPreview1(event){

            if(event.target.files[0].size < 1000000) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview1");
                document.getElementById('label_ktp1').innerHTML = event.target.files[0].name
                preview.src = src;
                preview.style.display = "block";
                $('#delete_btn1').show();
                $('#file-ip-1-preview1').show();
            }else{
                Swal.fire({
                    icon: 'error',
                    text: 'Ukuran Gambar Terlalu Besar!',
                });
            }

        }
        $('#deleteBtn').on('click', function() {
            deleteGambar();
            $('#deleteonModal').modal('hide');
            Swal.fire({
                icon: 'success',
                text: 'Foto Diri Berhasil Terhapus!',
            });
            $('#delete_btn').hide();
            $('#file-ip-1-preview').hide();
            return false;
        });

        $('#deleteBtn1').on('click', function() {
            deleteGambar2();
            $('#deleteonModal1').modal('hide');
            Swal.fire({
                icon: 'success',
                text: 'Gambar KTP Berhasil Terhapus!',
            });
            $('#delete_btn1').hide();
            $('#file-ip-1-preview1').hide();
            return false;
        });

        function deleteGambar() {
            var preview = document.getElementById("file-ip-1-preview");
            document.getElementById('label_ktp').innerHTML = "Pilih File"
            preview.src = '';
            document.getElementById('file_serfie').value = ''
        }

        function deleteGambar2() {
            var preview = document.getElementById("file-ip-1-preview1");
            document.getElementById('label_ktp1').innerHTML = "Pilih File"
            preview.src = '';
            document.getElementById('file_ktp').value = ''
        }

    </script>

    <script>


        $('#i').hide();
        $('#ii').hide();
        $('#iiii').hide();
        $('#iii').hide();
        $('#iiiii').hide();
        $('#iiiiii').hide();

        $(document).ready(function(){
            $('#plafon_text').on('keyup',function(){
                $('#plafon_text').mask("#,##0", {reverse: true});
                test_value = $(this).val().replace(/[^0-9]+/g, "");
                $('#plafon').val(test_value)
            })
            $('#pendapatan_text').on('keyup',function(){
                $('#pendapatan_text').mask("#,##0", {reverse: true});
                test_value = $(this).val().replace(/[^0-9]+/g, "");
                $('#pendapatan').val(test_value)
            })
            $('#pengeluaran_text').on('keyup',function(){
                $('#pengeluaran_text').mask("#,##0", {reverse: true});
                test_value = $(this).val().replace(/[^0-9]+/g, "");
                $('#pengeluaran').val(test_value)
            })
            // $('.rupiah').inputmask('decimal', {allowMinus:false, autoGroup: true, groupSeparator: '.', rightAlign: false, autoUnmask: true, removeMaskOnSubmit: true});

            $('#hitung').click(function(){
                $('#i').show(200);
                $('#ii').show(200);
                $('#iii').show(200);
                $('#iiii').show(200);
                $('#iiiii').show(200);
                $('#iiiiii').show(200);


                var pendapatan = $('#pendapatan').val();
                var pengeluaran = $('#pengeluaran').val();
                var plafon = $('#plafon').val();
                var margin = $('#margin').val();
                var durasi = $('#durasi option:selected').attr('data-durasi');
                var setting_rasio = {{$rasio->rasio}};
                var angsuran = plafon * (margin/100) / durasi;
                var total_pengeluaran = pengeluaran * (margin/100) / durasi;
                var sisa_dana = pendapatan - total_pengeluaran;
                if(sisa_dana > pendapatan * (setting_rasio/100)){
                    $('#rasio_keterangan').val('Disetujui');
                    $('#status').val('Disetujui');
                }else{
                    $('#rasio_keterangan').val('Tidak Disetujui');
                    $('#status').val('Tidak Disetujui');
                }
                // var rasio = sisa_dana / plafon;
                console.log(angsuran);
                console.log(total_pengeluaran);
                console.log(sisa_dana);
                var angsuran_value = $('#angsuran').val(angsuran);
                var value_pengeluaran = new Intl.NumberFormat().format(angsuran);
                $('#angsuran_text').html(value_pengeluaran);

                var pengeluaran_total = $('#total_pengeluaran').val(total_pengeluaran);
                var value_pengeluaran = new Intl.NumberFormat().format(total_pengeluaran);
                $('#total_pengeluaran_text').html(value_pengeluaran);

                var dana =  $('#sisa_dana').val(sisa_dana);
                var tot = new Intl.NumberFormat().format(sisa_dana);
                $('#sisa_dana_text').html(tot);
            });
        });
    </script>
@endpush
