@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Pergerakan Stok') }}">
        <!-- <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Setting') }}</a>
        </li> -->
       <!--  <li class="breadcrumb-item">
            <a href="{{ route('template_wa.index') }}">{{ __('Pergerakan Stok') }}</a>
        </li> -->
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
                                            <label class="control-label form-label" for="">{{ __('Nama Produk') }}</label>
                                        </div>
                                        <div class="col-md-3">
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
                                        <div class="col-md-2">
                                            <label class="control-label form-label" for="no_aset">{{ __('Nama Gudang') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input 
                                                id="no_aset" 
                                                name="" 
                                                type="text"
                                                class="form-control"
                                                
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <!-- <div class="col-md-3"> -->
                                        <div class="col-md-3">
                                                <label class="control-label form-label" for="">{{ __('Kategori') }}</label>
                                        </div>
                                        <div class="col-md-3">
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

                                       	<div class="col-md-2">
                                            <label class="control-label form-label" for="no_aset">{{ __('Satuan Dasar') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input 
                                                id="no_aset" 
                                                name="" 
                                                type="text"
                                                class="form-control"
                                                
                                            />
                                        </div>
                                    </div>
                                </div>
	                            <div class="form-group clearfix">
	                                <div class="row">
	                                     <div class="col-md-3">
	                                        <label class="control-label form-label" for="">{{ __('Stok Akhir') }}</label>
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
	                                     <div class="col-md-3">
	                                        <label class="control-label form-label" for="">{{ __('Harga Beli') }}</label>
	                                    </div>
	                                    <div class="col-md-3">
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
	                                    <div class="col-md-2">
                                            <label class="control-label form-label" for="akun_pembelian">{{ __('Akun Pembelian') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input 
                                                id="akun_pembelian" 
                                                name="" 
                                                type="text"
                                                class="form-control"
                                                
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
	                                <div class="row">
	                                     <div class="col-md-3">
	                                        <label class="control-label form-label" for="">{{ __('Harga Jual') }}</label>
	                                    </div>
	                                    <div class="col-md-3">
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
	                                    <div class="col-md-2">
                                            <label class="control-label form-label" for="akun_penjualan">{{ __('Akun Penjualan') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input 
                                                id="akun_penjualan" 
                                                name="" 
                                                type="text"
                                                class="form-control"
                                                
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
	                                <div class="row">
	                                     <div class="col-md-3">
	                                        <label class="control-label form-label" for="">{{ __('Akun Inventori') }}</label>
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
								                </div>
								                <div class="table-responsive">
								                    <table class="table mb-0">
								                        <thead>
								                            <tr>
								                                <th class="d-lg-none">&nbsp;</th>
								                                <th></th>
								                                <th>{{ __('No') }}</th>
								                                <th>{{ __('Tanggal') }}</th>
								                                <th>{{ __('Transaksi') }}</th>
								                                <th>{{ __('Keterangan') }}</th>
								                                <th>{{ __('Pergerakan Stok') }}</th>
								                                <th>{{ __('Stok Akhir') }}</th>
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
								                                <td></td>
								                                <td>
								                                	<a href="{{ route('daftar_inventori.lihat',1) }}" class="btn btn-primary fa fa-eye" style="background-color: blue; font-size: 12px"></a></td>
								                                </td>
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