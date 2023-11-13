@extends('layouts.app')

@section('breadcrumb')
    <br>
    <x-breadcrumb title="{{ __('Setting') }}">
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
                            <h3 class="nk-block-title page-title mb-6">Menu Setting</h3>
                        </div>
                    </div>
                    <ul class="row g-gs preview-icon-svg">
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <div class="box">
                            <a href="{{ route('pembelian.setting.termin.index') }}" class="w-100">
                                <i class="fe fe-calendar fa-xl"></i><i class="far fa-calendar-alt"></i>
                                <br>
                                <span class="preview-icon-name">Termin</span>
                            </a>
                            </div>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('pembelian.setting.ekpedisi.index') }}"
                                class="w-100">
                                 <i class="fe fe-truck fa-xl"></i>
                                <br>
                                <span class="preview-icon-name">Ekpedisi</span>
                            </a>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('pembelian.setting.supplier.index') }}"
                                class="w-100">
                                 <i class="fe fe-package fa-xl"></i>
                                <br>
                                <span class="preview-icon-name">Supplier</span>
                            </a>
                        </li>
                       
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="container">
        <div class="row">
            <div class="col-md-2">
                <i class="mdi mdi-xml"></i>
                <label>Kode Perusahaan</label>
            </div>
        </div>
    </div> -->
@endsection
