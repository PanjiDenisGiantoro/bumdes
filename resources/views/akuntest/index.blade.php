@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Jurnal') }}">
        <li class="breadcrumb-item">
            {{ request()->route()->getName() == 'jurnal_entry.index' ? __('Laporan') : __('Keuangan') }}
        </li>
        <!--  <li class="breadcrumb-item">
            <a href="{{ route('setting_produk.index') }}">{{ __('Keuangan') }}</a>
        </li> -->
        <li class="breadcrumb-item">
            {{ __('Jurnal') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Jurnal</h3>
                    <div class="card-options">
                        <!-- <div class="btn-group mr-2">
                            <a class="btn btn-primary" style="background-color: blue; margin-right: 7px" href="">
                                <i class="fa fa-print">&nbsp; Cetak</i>
                            </a>
                            <a class="btn btn-primary" style="background-color: red; margin-right: 7px" href="">
                                <i class="fa fa-file-pdf-o">&nbsp; PDF</i>
                            </a>
                            <a class="btn btn-primary" style="background-color: green;  margin-right:7px" href="">
                                <i class="fa fa-file-excel-o">&nbsp; EXCEL</i>
                            </a>
                        </div> -->


                    </div>
                </div>
                <div class="row">
                    <div class="form-group clearfix">
                    <div class="col-md-6">
                        <label for="" class="form-control">Akun Perkiraan</label>
                        <input type="text" class="form-control" >
                    </div>
                </div>
                </div>


            </div>
        </div>
    </div>
@endsection
