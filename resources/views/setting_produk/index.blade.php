@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Setting') }}">
        <li class="breadcrumb-item">
           <a href="{{ route('daftar_produk.index') }}">{{ __('Produk') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Setting') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
<style type="text/css">
    .mdi, .fa-xl{
        font-size: 50px;
    }
     .zmdi{
        font-size: 50px;
    }
    .fa-xl{
        padding:12px;
    }
    li.col-lg-3{
        margin-bottom: 50px;
    }
    /*.box{
        border:1px solid black;
    }*/
</style>
 <div class="container">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview wide-md mx-auto">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Settings</h3>
                        </div>
                    </div>
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"></h3>
                        </div>
                        <div class="nk-block-des">
                            <p class="lead">Produk</p>
                        </div>
                    </div>
                    <ul class="row g-gs preview-icon-svg">
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <div class="box">
                            <a href="{{ route('kategori_produk.index') }}" class="w-100">
                                <i class="fa fa-address-book fa-xl"></i>
                                <br>

                                <span class="preview-icon-name">Kategori Produk</span>
                            </a>
                            </div>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('satuan_produk.index') }}"
                                class="w-100">
                                 <i class="mdi mdi-account-outline"></i>
                                <br>

                                <span class="preview-icon-name">Satuan</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('kode_sku.index') }}"
                                class="w-100">
                                 <i class="mdi mdi-account-outline"></i>
                                <br>


                                <span class="preview-icon-name">Kode SKU</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('gudang_produk.index') }}"
                                class="w-100">
                                 <i class="mdi mdi-account-outline"></i>
                                <br>


                                <span class="preview-icon-name">Gudang</span>
                            </a>
                        </li>

                </div>
            </div>
        </div>
    </div>

@endsection
