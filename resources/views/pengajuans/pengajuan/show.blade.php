@extends('pengajuans.layouts_pengajuan.app')

@section('content')
    @include('pengajuans.layouts_pengajuan.headers.cards')

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Tables</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{route('pengajuan.index')}}">Setting</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pengajuan</li>
                            </ol>
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
                            <form action="" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">NIK</label>
                                            <input type="text" name="nik" class="form-control" value="{{$pengajuan->nik }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nama</label>
                                            <input type="text" name="nama" class="form-control" value="{{$pengajuan->nama }}"disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" name="email" class="form-control"  value="{{$pengajuan->email }}"disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tgl Lahir</label>
                                            <input type="date" name="tgl_lahir" class="form-control"  value="{{$pengajuan->tgl_lahir }}"disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">No Telp</label>
                                            <input type="text" name="no_telp" class="form-control"  value="{{$pengajuan->no_telp }}"disabled>
                                        </div>
                                    </div>
                                    {{--                                            textarea--}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Alamat</label>
                                            <textarea name="alamat" id="" cols="10" rows="3" class="form-control" disabled>{{$pengajuan->alamat }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="">Bumdes</label>
                                            <input type="text" name="bumdes" class="form-control"value="{{$pengajuan->bumdes }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        @php
                                            $provinces = new \App\Http\Controllers\SettingController();
                                            $provinces= $provinces->provinces();
                                        @endphp
                                        <div class="form-group">

                                            <label class="control-label form-label" for="rtrw">{{ __('Provinsi') }}</label>

                                            <select class="form-control select2" name="provinsi" id="provinsi" required disabled>
                                                <option value="">==Pilih Salah Satu==</option>
                                                @foreach ($provinces as $item)
                                                    <option value="{{ $item->id ?? '' }}"@if($pengajuan->provinsi == $item->id)selected @endif>{{ $item->name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label form-label" for="kota">{{ __('Kabupaten / Kota ') }}<span class="text-red">*</span></label>

                                            <select class="form-control select2" name="kota" id="kota" required disabled>
                                                @if (!empty($pengajuan->city))
                                                    <option value="{{ $pengajuan->city->id }}">{{ $pengajuan->city->name }}</option>
                                                @endif                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label class="control-label form-label" for="kode_pos">{{ __('Kecamatan') }}<span class="text-red">*</span></label>
                                            <select class="form-control select2" name="kecamatan" id="kecamatan" required disabled>
                                                <option value="">==Pilih Salah Satu==</option>
                                                @if (!empty($pengajuan->kecamatan))
                                                    <option value="{{ $pengajuan->districts->id }}">{{ $pengajuan->kecamatan }}</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label class="control-label form-label" for="desa">{{ __('Kelurahan / Desa ') }}<span class="text-red">*</span></label>

                                            <select class="form-control select2" name="desa" id="desa" required disabled>
                                                @if (!empty($pengajuan->villages))
                                                    <option value="{{ $pengajuan->villages->id }}">{{ $pengajuan->villages->name }}</option>
                                                @endif                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label class="control-label form-label" for="kode_pos">{{ __('Kode Pos') }}<span class="text-red">*</span></label>
                                            <input type="text" class="form-control" name="kode_pos" value="{{$pengajuan->kode_pos ?? ''}}"disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label class="control-label form-label" for="usaha">{{ __('Keterangan Usaha') }}</label>
                                            <input type="text" class="form-control" name="keterangan_usaha" value="{{$pengajuan->keterangan_usaha ?? ''}}"disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label class="control-label form-label" for="usaha">{{ __('Ibu Kandung') }}</label>
                                            <input type="text" class="form-control" name="ibu_kandung" value="{{$pengajuan->ibu_kandung  ?? ''}}"disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="card-title">
                                            <h3 class=" title-2">Gambar Pribadi</h3>
                                        </div>
                                    </div>
                                                                        <div class="col-md-6">
                                                                            <label class="form-label" for="file_ktp">{{ __('Upload KTP') }} </span></label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="form-label" for="file_selfi">{{ __('Upload Selfi') }} </span></label>
                                                                        </div>
                                    <div class="col-md-6">
                                        <input type="file" class="custom-file-input" name="file_ktp" id="file_ktp"onchange="showPreview(event);" value="{{$file_ktp[0] }}"disabled>
                                        <label class="custom-file-label" id="label_ktp" for="file_ktp">{{ isset($file_ktp[0]) ?  str_replace("selfi/$pengajuan->id/", '', $file_ktp[0]) : 'Pilih File' }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="file" class="custom-file-input" name="file_serfie" id="file_serfie"onchange="showPreview1(event);" value="{{$file_foto[0] }}"disabled>
                                        <label class="custom-file-label" id="label_ktp1" for="file_ktp">{{ isset($file_foto[0]) ?  str_replace("selfi/$pengajuan->id/", '', $file_foto[0]) : 'Pilih File' }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <img id="file-ip-1-preview" width="250" height="200"src="{{ asset('storage/' . ($file_ktp[0] ?? '')) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <img id="file-ip-1-preview1" width="250" height="200" src="{{ asset('storage/' . ($file_foto[0] ?? '')) }}">
                                    </div>
                                    <br>
                                    <div class="col-md-12 mt-4">
                                        <div class="card-title">
                                            <h3 class=" title-2">Gambar Usaha</h3>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <input type="file" class="custom-file-input" name="file_ktpg" id="file_ktpg"disabled
                                               onchange="showPreviewg(event);">
                                        <label class="custom-file-label" id="label_ktpg" for="file_ktp">Gambar Usaha 1</label>
                                    </div>

                                    <div class="col-md-6">
                                        <input type="file" class="custom-file-input" name="file_fktp2" id="file_fktp2g"disabled
                                               onchange="showPreview2g(event);">
                                        <label class="custom-file-label" id="label_ktp2g" for="file_fktp2g">Gambar Usaha 2</label>
                                    </div>
                                    <div class="mt-5" ></div>



{{--                                    <div class="row mt-4">--}}
                                        <div class="col-md-6">
                                            <h5>Gambar 1</h5>

                                            <img id="file-ip-1-previewg" width="250" height="200" src=" {{ asset('storage/' . ($warung[0]  ?? '')) }}">


                                        </div>
                                        <div class="col-md-6">
                                            <h5>Gambar 2</h5>
                                            <img id="file-ip-1-preview2g" width="250" height="200" src=" {{ asset('storage/' . ($warung1[0] ?? '')) }}">

                                        </div>
                                    </div>

{{--                                    --}}{{--                                            card title--}}

                                    <div class="col-md-12">
                                        <div class="card-title">
                                            <h3 class=" title-2">Info Margin</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Plafon</label>
                                            <input hidden type="text" name="plafon"  id="plafon" class="form-control " >
                                            <input type="text" name="plafon_text" id="plafon_text" class="form-control" readonly value="{{number_format($pengajuan->plafon) }}">
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Pendapatan</label>
                                            <input type="text" name="pendapatan" hidden id="pendapatan" class="form-control" >
                                            <input type="text" name="pendapatan_text" id="pendapatan_text" class="form-control" readonly value="{{number_format($pengajuan->pendapatan) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Pengeluaran</label>
                                            <input type="text" name="pengeluaran" hidden id="pengeluaran" class="form-control" >
                                            <input type="text" name="pengeluaran_text" id="pengeluaran_text" class="form-control"readonly value="{{number_format($pengajuan->pengeluaran) }}" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Margin</label>
                                            <input type="text" name="margin" id="margin" hidden class="form-control" value="{{$margin->margin }}">
                                            <select name="durasi" id="durasi" disabled class="form-control">
                                                @foreach($durasi as $d)
                                                    <option value="{{$d->id}}"@if(!empty($pengajuan->id) ? $pengajuan->margin == $d->id : '')selected @endif>{{$d->durasi}} Bulan</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <a href="#" id="hitung" class="btn btn-primary">Hitung </a> <span>Rasio {{$rasio->rasio}} % & Margin {{$margin->margin }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Angsuran</label>

                                            <input type="text" name="angsuran_text" id="angsuran_text" class="form-control"  value="{{round($pengajuan->angsuran ?? '')}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">total Pengeluaran</label>
                                            <input type="text" name="total_pengeluaran" hidden id="total_pengeluaran" class="form-control" readonly>
                                            <input type="text" name="total_pengeluaran_text" id="total_pengeluaran_text" class="form-control" value="{{$pengajuan->total_pengeluaran}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Sisa Dana</label>
                                            <input type="text" name="sisa_dana" hidden id="sisa_dana" class="form-control" readonly>
                                            <input type="text" name="sisa_dana_text" id="sisa_dana_text" class="form-control" readonly value="{{$pengajuan->sisa_dana}}">
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Rasio {{$pengajuan->rasio}}</label>
                                            @php
                                                if($pengajuan->sisa_dana > $pengajuan->pendapatan * ($pengajuan->rasio/100)){
                                                $setuju = 'Setuju';
                                            }else{

                                                $setuju = 'Tidak Setuju';
                                            }
                                            @endphp
                                            <input type="text" name="rasio" id="rasio" class="form-control" value="{{$setuju}}" readonly>
                                        </div>
                                    </div>
{{--                                    <div class="col-md-10" id="iiiiii">--}}
{{--                                        <label class="" for="">Signature:</label>--}}
{{--                                        <br/>--}}
{{--                                        <div id="sig" ></div>--}}
{{--                                        <br/>--}}
{{--                                        <img src="{{ asset('storage/' . ($ok )) }}" alt="">--}}
{{--                                        <textarea id="signature64" name="signed" style="display: none"></textarea>--}}
{{--                                    </div>--}}

                                    <div class="col-md-12">
                                        <div class="form-group text-center">
                                            <a href="{{route('pengajuan.index')}}" class="btn btn-info btn-lg">Kembali</a>
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
    <!-- Footer -->
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
    @include('pengajuans.layouts_pengajuan.footers.auth')
@endsection

@push('js')
    {{--    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>--}}
    {{--    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>--}}
    {{--cdn jquery  --}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8-beta.17/inputmask.es6.js" integrity="sha512-G307IbFqmfwXgQa2Jbxp4+4HeTp++lVOXNsNadeRIVqBsltSJgpprtBaz2GTs8WBq+KfxUJwfTGSvGV/Xd5AnQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}

    {{--<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>--}}
    {{--cdn input mask--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <script>



        $(document).ready(function(){
            // $('.rupiah').inputmask('decimal', {allowMinus:false, autoGroup: true, groupSeparator: '.', rightAlign: false, autoUnmask: true, removeMaskOnSubmit: true});

            $('#hitung').click(function(){
                var pendapatan = $('#pendapatan').val();
                var pengeluaran = $('#pengeluaran').val();
                var plafon = $('#plafon').val();
                var margin = $('#margin').val();
                var durasi = $('#durasi').val();
                var setting_rasio = {{$rasio->rasio}};
                var angsuran = plafon * (margin/100) / 12;
                var total_pengeluaran = pengeluaran * (margin/100) / 12;
                var sisa_dana = pendapatan - total_pengeluaran;
                if(sisa_dana > pendapatan * (setting_rasio/100)){
                    $('#rasio').val('Disetujui');
                }else{
                    $('#rasio').val('Tidak Disetujui');
                }
                // var rasio = sisa_dana / plafon;
                console.log(angsuran);
                console.log(total_pengeluaran);
                var angsuran_value  $('#angsuran').val(angsuran);
                var value_pengeluaran = new Intl.NumberFormat().format(angsuran_value);
                $('#angsuran_text').val(value_pengeluaran);

                var pengeluaran_total $('#total_pengeluaran').val(total_pengeluaran);
                var value_pengeluaran = new Intl.NumberFormat().format(pengeluaran_total);
                $('#total_pengeluaran_text').val(value_pengeluaran);

                var dana =  $('#sisa_dana').val(sisa_dana);
                var tot = new Intl.NumberFormat().format(dana);
                $('#sisa_dana_text').val(tot);
            });
        });
    </script>
@endpush
