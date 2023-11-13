@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Pergerakan Stok') }}">
        <!-- <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Setting') }}</a>
        </li> -->
        <li class="breadcrumb-item">
            <a href="{{ route('template_wa.index') }}">{{ __('Pergerakan Stok') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Lihat Pergerakan Stok') }}</a>
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Lihat Pergerakan Stok') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($daftar_inventori->id) ? route('daftar_inventori.update', [$daftar_inventori]) : route('daftar_inventori.store') }}">

                    @if (!empty($daftar_inventori->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="">{{ __('Nama Gudang') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input 
                                            id="" 
                                            name="" 
                                            type="text" 
                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('')]) 
                                            value="{{ old('') }}"
                                            />
                                            @error('')
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
                                                    <label class="control-label form-label" for="">{{ __('Total Produk') }}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input 
                                                        id="" 
                                                        name="" 
                                                        type="text" 
                                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('')]) 
                                                        value="{{ old('') }}"
                                                    />
                                                    @error('')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>

                                        <!-- <div class="col-md-2">
                                            <label class="control-label form-label" for="no_mitra">{{ __('No. Mitra') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input 
                                                id="no_mitra" 
                                                name="" 
                                                type="text"
                                                class="form-control"
                                                readonly
                                            />
                                        </div> -->
                                    </div>
                                </div>
	                            <div class="form-group clearfix">
	                                <div class="row">
		                                     <div class="col-md-3">
		                                        <label class="control-label form-label" for="">{{ __('Total Nilai Produk') }}</label>
		                                    </div>
		                                    <div class="col-md-9">
		                                        <input 
		                                            id="" 
		                                            name="" 
		                                            type="text" 
		                                            @class(['required', 'form-control', 'is-invalid' => $errors->has('')]) 
		                                            value="{{ old('') }}"
		                                        />
		                                        @error('')
		                                            <span class="invalid-feedback" role="alert">
		                                                {{ $message }}
		                                            </span>
		                                        @enderror
		                                    </div>
	                                    </div>
	                                </div>
	                                <br>
	                            <div class="form-group clearfix">
	                                <div class="row">
								        <div class="col-md-12 col-lg-12">
								            <div class="card">
								                <div class="card-header">
								                    <h3 class="card-title">&nbsp;</h3>
								                    <div class="card-options">
								                        <div class="btn-group mr-2">

								                        <!--  <a class="btn btn-primary fa fa-print" style="background-color: blue; margin-right: 7px">&nbsp; CETAK</a> -->
								                        <!-- <a class="btn btn-primary" style="background-color: blue; margin-right: 7px" href="">
								                            <i class="fa fa-print">&nbsp; CETAK</i>
								                        </a> -->
								                       <!--  <a class="btn btn-primary fa fa-file-pdf-o" style="background-color: red; margin-right: 7px">&nbsp; PDF</a> -->
								                       <!--  <a class="btn btn-primary" style="background-color: red; margin-right: 7px" href="">
								                            <i class="fa fa-file-pdf-o">&nbsp; PDF</i>
								                        </a> -->
								                        <!-- <a class="btn btn-primary fa fa-print" style="background-color: green; margin-right: 7px">&nbsp; EXCEL</a> -->
								                            <!-- <a class="btn btn-primary" style="background-color: green;  margin-right:7px" href="">
								                                <i class="fa fa-file-excel-o">&nbsp; EXCEL</i>
								                            </a> -->
								                           <!--  <a class="btn btn-primary" style="background-color: blue; margin-right: 7px" href="">
								                                <i class="fa fa-print">&nbsp; Cetak</i>
								                            </a>
								                            <a class="btn btn-primary" style="background-color: red; margin-right: 7px" href="">
								                                <i class="fa fa-file-pdf-o">&nbsp; PDF</i>
								                            </a>
								                            <a class="btn btn-primary" style="background-color: green;  margin-right:7px" href="">
								                                <i class="fa fa-file-excel-o">&nbsp; EXCEL</i>
								                            </a> -->
								                        </div>

								                       <!--  <a  style="background-color: blue" href="{{ route('daftar_aset.create') }}">
								                            <button class="btn btn-primary">Tambah Daftar Inventori</button>
								                        </a> -->
								                    </div>
								                </div>
								                <div class="table-responsive">
								                    <table class="table mb-0">
								                        <thead>
								                            <tr>
								                                <th class="d-lg-none">&nbsp;</th>
								                                <th></th>
								                                <th>{{ __('No') }}</th>
								                                <th>{{ __('Nama Produk') }}</th>
								                                <th>{{ __('Kode SKU') }}</th>
								                                <th>{{ __('Jumlah Barang') }}</th>
								                                <th>{{ __('Nilai Barang') }}</th>
								                                <th>{{ __('Tindakan') }}</th>
								                                <th>&nbsp;</th>
								                            </tr>
								                        </thead>
								                         <tbody>
								                            
								                            <tr>
								                                <td class="col-lg-none"> <input type="checkbox"></td>
								                                <td></td>
								                                <td></td>
								                                <td></td>
								                                <td></td>
								                                <td></td>
								                                <td>
								                                	<!-- <button class="btn btn-primary fa fa-eye"  style="background-color: blue; font-size: 12px"></button> -->
								                                	<a href="{{ route('daftar_inventori.show2',1) }}" class="btn btn-primary fa fa-eye" style="background-color: blue; font-size: 12px"></a></td>
								                                	<!-- <button class="btn btn-primary fa fa-trash"  style="background-color: red; font-size: 12px"></button> -->
								                                	<!-- <a href="{{ route('anggota.show',1) }}" class="btn btn-primary" style="background-color: blue">Cetak</a> -->
								                                </td>
								                                <!-- <td></td> -->
								                                <!-- <td></td>
								                                <td></td> -->
								                                <!-- <td></td>
								                                <td></td> -->
								                            </tr>
								                            
								                        </tbody>
								                    </table>
								                </div>
								                <div class="card-footer">

								                </div>
								            </div>
								        </div>
								    </div>
	                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="card-footer border border-top-0 text-right">
                        <a href="{{ route('template_wa.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Batal') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($tetapan->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div> -->
                </form>
            </div>
        </div>
    </div>
@endsection