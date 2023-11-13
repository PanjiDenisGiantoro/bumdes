@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Penomoran') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Penomoran') }}">
        <li class="breadcrumb-item">
            {{ __('Penomoran') }}
        </li>
    </x-breadcrumb> -->
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

<div class="row row-deck">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
            <a href="{{ route('tetapan.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Kembali') }}</a>
                <!-- <div class="card-title">Penomoran Auto</div> -->

            </div>
            <div class="card-body">
               <table class="table table-striped table-bordered">
                   <thead>
                   <tr>
                       <th class="wd-15p">Nomor</th>
                       <th class="wd-20p">Modul</th>
                       <th class="wd-20p">Tindakan</th>
                   </tr>
                   </thead>
                   <tbody>
                   @foreach($penomoran as $nomor)
                       @php
                           if (!empty($nomor->format_depan)) {
                           $format_depan =date($nomor->format_depan).'-';
                       } else {
                           $format_depan = '';
                       }
                           if (!empty($nomor->format_tengah)) {
                           $format_tengah = date($nomor->format_tengah).'-';
                       } else {
                           $format_tengah = '';
                       }
                               if (!empty($nomor->format_belakang)) {
                           $format_belakang = date($nomor->format_belakang).'-';
                       } else {
                           $format_belakang = '';
                       }
                       $no = $nomor->head.'-'.$nomor->kode_perusahaan.'-'.$nomor->kode_cabang.'-'.'Id'.'_'.'Produk-'.$format_depan.$format_tengah.$format_belakang;
                       $no_anggota = $nomor->head.'-'.$nomor->kode_perusahaan.'-'.$nomor->kode_cabang.'-'.$format_depan.$format_tengah.$format_belakang;
                        $text = str_replace(' ', '', $no);
                       @endphp
                   <tr>
                       <td>{{$nomor->head ?? ''}}</td>
                       @if(($nomor->keterangan == 'simpanan') || ($nomor->keterangan == 'pembiayaan')||($nomor->keterangan == 'simpanan_berjangka'))
                           <td>{{$text}}Auto</td>
                       @elseif($nomor->keterangan == 'anggota')
                           <td>{{$no_anggota}}Auto</td>
                           @else
                           <td>{{$nomor->head ?? ''}} / {{ date($nomor->format_depan ?? '') }} / {{ date($nomor->format_tengah ?? '') }}  / {{ date($nomor->format_belakang ?? '') }}  /  Auto</td>
                       @endif
                       <td>{{$nomor->keterangan ?? ''}}</td>
                       <td><a href="{{route('penomoran.edit',$nomor->id)}}" class="btn btn-primary">Edit</a></td>
                   </tr>
                   @endforeach
                   </tbody>

               </table>
            </div>
        </div>
    </div>
</div>

@endsection
