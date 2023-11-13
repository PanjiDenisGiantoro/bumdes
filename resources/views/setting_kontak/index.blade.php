@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Setting') }}">
        <li class="breadcrumb-item">
           <a href="{{ route('daftar_kontak.index') }}">{{ __('Kontak') }}</a>
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
                            <p class="lead">Kontak</p>
                        </div>
                    </div>
                    <ul class="row g-gs preview-icon-svg">
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <div class="box">
                            <a href="{{ route('tipe_kontak.index') }}" class="w-100">
                                <i class="fa fa-address-book fa-xl"></i>
                                <br>

                                <!-- <div class="preview-icon-wrap">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="">
                                        <rect x="5" y="5" width="53.97" height="69.95" rx="7" ry="7" fill="#e3e7fe"
                                            stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"></rect>
                                        
                                    </svg>
                                </div> -->
                                <span class="preview-icon-name">Tipe Kontak</span>
                            </a>
                            </div>
                        </li>
                        <li class="col-lg-3 col-6 col-sm-4 text-center">
                            <a href="{{ route('tipe_kontak_group.index') }}"
                                class="w-100">
                                 <i class="mdi mdi-account-outline"></i>
                                <br>

                                <!-- <div class="preview-icon-wrap">
                                    <svg xmlns="mdi mdi-xml" viewBox="">
                                        <rect x="7" y="10" width="76" height="50" rx="7" ry="7" fill="#fff" stroke="#6576ff"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></rect>
                                        <rect x="32" y="69" width="28" height="7" rx="1.5" ry="1.5" fill="none"
                                            stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"></rect>
                                        <line x1="40" y1="60" x2="40" y2="69" fill="none" stroke="#6576ff"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                        <line x1="52" y1="60" x2="52" y2="69" fill="none" stroke="#6576ff"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                        <line x1="42" y1="24" x2="70" y2="24" fill="#c4cefe" stroke="#c4cefe"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                        <line x1="42" y1="30" x2="70" y2="30" fill="#c4cefe" stroke="#c4cefe"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                        <line x1="42" y1="36" x2="70" y2="36" fill="#c4cefe" stroke="#c4cefe"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                        <rect x="24" y="23" width="12" height="14" fill="none" stroke="#c4cefe"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></rect>
                                        <rect x="69" y="50" width="18" height="30" rx="3" ry="3" fill="#e3e7fe"
                                            stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"></rect>
                                        <line x1="78.09" y1="75.56" x2="78.09" y2="75.56" fill="none" stroke="#6576ff"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                        <rect x="3" y="46" width="24" height="34" rx="3" ry="3" fill="#e3e7fe"
                                            stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"></rect>
                                        <line x1="14.69" y1="76.66" x2="14.69" y2="76.66" fill="none" stroke="#6576ff"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                        <line x1="13.5" y1="49.5" x2="16.5" y2="49.5" fill="none" stroke="#6576ff"
                                            stroke-linecap="round" stroke-linejoin="round"></line>
                                        <line x1="3.5" y1="73.5" x2="26.5" y2="73.5" fill="none" stroke="#6576ff"
                                            stroke-linecap="round" stroke-linejoin="round"></line>
                                    </svg>
                                </div> -->
                                <span class="preview-icon-name">Tipe Kode Group</span>
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
