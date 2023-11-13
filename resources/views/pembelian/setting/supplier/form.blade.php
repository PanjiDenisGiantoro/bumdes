@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Kontak') }}</h3>
<br>
<!-- <x-breadcrumb title="{{ !empty($supplier->id) ? __('Kontak') : __('Kontak') }}">
    <li class="breadcrumb-item">
        <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('pembelian.setting.supplier.index') }}">{{ __('Kontak') }}</a>
    </li>
    <li class="breadcrumb-item">
        {{ !empty($supplier->id) ? __('Edit Kontak') : __('Tambah Kontak') }}</a>
    </li>
</x-breadcrumb> -->
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 col-lg-10">
        <div class="card border-0 m-b-20">
            <h5 class="card-header">{{ !empty($supplier->id) ? __('Edit Kontak') : __('Tambah Kontak') }}</h5>

            <form method="POST" class="form-horizontal" action="{{ !empty($supplier->id) ? route('pembelian.setting.supplier.update', $supplier->id) : route('pembelian.setting.supplier.store') }}" enctype="multipart/form-data">

                @if (!empty($supplier->id))
                @method('PUT')
                @endif

                @csrf

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group clearfix">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="control-label form-label" for="">{{ __('Nama PIC') }}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input
                                               id="nama_pic" name="nama_pic" type="text"
                                               value="{{ !empty($supplier->nama_pic) ? $supplier->nama_pic : ''  }}"
                                            @class(['required', 'form-control' , 'is-invalid'=> $errors->has('nama_pic')])

                                        />
                                        @error('nama_pic')
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
                                        <label class="control-label form-label" for="">{{ __('Id Kontak') }}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input readonly value="{{ !empty($supplier->id_supplier) ? $supplier->id_supplier : 'IS-'.$code  }}" id="" name="id_supplier" type="text" @class(['required', 'form-control' , 'is-invalid'=> $errors->has('')])

                                        />
                                        @error('')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label form-label" for="tipe_kontak">{{ __('Tipe Kontak') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="id_tipe_supplier" class="form-control select2" data-placeholder="{{ __('Pilih Tipe Kontak') }}">
                                            <option value="">{{ __('Pilih Tipe Kontak') }}</option>

                                            @foreach ($TipeKontak as $id => $name)
                                                <option value="{{$id}}"@if(!empty($supplier->id_tipe_supplier) ? $supplier->id_tipe_supplier == $id : '')selected @endif>{{$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>



                            <div class="form-group clearfix">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="control-label form-label" for="">{{ __('Nama Perusahaan') }}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input value="{{ !empty($supplier->nama) ? $supplier->nama : '' }}"
                                               id="ss" name="nama" type="text"
                                            @class(['required', 'form-control' , 'is-invalid'=> $errors->has('nama')])

                                        />
                                        @error('nama')
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
                                        <label class="control-label form-label" for="">{{ __('Alamat Perusahaan') }}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input value="{{ !empty($supplier->alamat) ? $supplier->alamat : '' }}"
                                        id="ss" name="alamat" type="text"
                                        @class(['required', 'form-control' , 'is-invalid'=> $errors->has('alamat')])

                                        />
                                        {{-- <textarea name="alamat" id="alamat" cols="30" rows="10"
                                        @class(['required', 'form-control' , 'is-invalid'=> $errors->has('')])>
                                        {{ !empty($supplier->alamat) ? $supplier->alamat : '' }}
                                        </textarea> --}}
                                        @error('alamat')
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
                                        <label class="control-label form-label" for="">{{ __('No Telepon') }}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input value="{{ !empty($supplier->no_telepon) ? $supplier->no_telepon : '' }}"
                                        id="ss" name="no_telepon" type="text"
                                        onkeypress="return isNumberKey(event)"
                                        @class(['required', 'form-control' , 'is-invalid'=> $errors->has('no_telepon')])

                                        />
                                        @error('no_telepon')
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
                                        <label class="control-label form-label" for="">{{ __('No Hp') }}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input value="{{ !empty($supplier->no_hp) ? $supplier->no_hp : '' }}"
                                        id="ss" name="no_hp" type="text"
                                        onkeypress="return isNumberKey(event)"
                                        @class(['required', 'form-control' , 'is-invalid'=> $errors->has('no_hp')])
                                        />
                                        @error('no_hp')
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
                                        <label class="control-label form-label" for="npwp">{{ __('NPWP') }}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input
                                            value="{{!empty($supplier->npwp) ? $supplier->npwp : ''}}"

                                            id="npwp"
                                            name="npwp"
                                            type="text"
                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('npwp')])
                                            value="{{ old('nama_perusahaan') }}"
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
                                        <label class="form-label" for="">{{ __('Upload Logo / Foto Kontak') }}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="gambar"onchange="showPreview(event);">
                                            <label class="custom-file-label" id="label_gambar">Upload Logo / Foto Kontak</label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <center>
                                    <div class="col-md-4">
                                        <img id="file-ip-1-preview" width="250" height="200"src="{{asset('storage/' . ($gambar[0] ?? '')) }}">
                                        <br>
                                        <button type="button" class="btn btn-danger  fa fa-trash" onclick="deleteGambar()"></button>
                                    </div>
                                </center>
                            </div>




                        </div>
                    </div>
                    <br>
                    <h3 class="card-title">{{ __('Informasi Akun')}}</h3>

                    <div class="form-group clearfix">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="control-label form-label" for="gl_hutang">{{ __('Akun Hutang') }}</label>
                            </div>
                            <div class="col-md-9">
                                <select id="id_akun_hutang" name="id_akun_hutang" class="form-control select2" data-placeholder="{{ __('Pilih GL Hutang') }}">
                                    <option value="">{{ __('Pilih Akun Hutang') }}</option>
                                    @foreach ($akun as $akuns)
                                                <option value="{{$akuns->id}}"@if(!empty($supplier->id_akun_hutang) ? $supplier->id_akun_hutang == $akuns->id : '') selected @endif>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $akuns->depth) !!}{{ $akuns->kode }} &mdash; {{ $akuns->nama }}</option>

                                                @endforeach

                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="control-label form-label" for="gl_piutang">{{ __('Akun Piutang') }}</label>
                            </div>
                            <div class="col-md-9">
                                <select id="id_akun_piutang" name="id_akun_piutang" class="form-control select2" data-placeholder="{{ __('Pilih GL Piutang') }}">
                                    <option value="">{{ __('Pilih Akun Piutang') }}</option>
                                    @foreach ($akun as $akuns)
                                                <option value="{{$akuns->id}}"@if(!empty($supplier->id_akun_piutang) ? $supplier->id_akun_piutang == $akuns->id : '') selected @endif>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $akuns->depth) !!}{{ $akuns->kode }} &mdash; {{ $akuns->nama }}</option>

                                                @endforeach
                                </select>
                            </div>

                        </div>
                    </div>

                        </div>

                    <div class="card-footer border border-top-0 text-right">
                        <a href="{{ route('pembelian.setting.supplier.index') }}" class="btn btn-primary" style="background-color: red">{{ !empty($supplier->id) ? __('Kembali') : __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($supplier->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>

            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $('.select2').select2();

        function showPreview(event){
            if(event.target.files.length > 0){
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                document.getElementById('label_gambar').innerHTML = event.target.files[0].name
                preview.src = src;
                preview.style.display = "block";
            }
        }

        function deleteGambar() {

            var preview = document.getElementById("file-ip-1-preview");
            document.getElementById('label_gambar').innerHTML = "Pilih File"
            preview.src = null;
            document.getElementById('gambar').value = ''

        }
    </script>
@endpush
