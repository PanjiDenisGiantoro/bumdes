@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Ringkasan Kontak') }}">
    	<li class="breadcrumb-item">
            <a href="{{ route('ringkasan_kontak.index') }}">{{ __('Kontak') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Ringkasan Kontak') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">&nbsp;</h3>
                    <div class="card-options">
                        <div class="btn-group mr-2">
                             <!-- <a class="btn btn-primary fa fa-print" style="background-color: blue; margin-right: 7px">&nbsp; CETAK</a> -->
                            <!-- <a class="btn btn-primary" style="background-color: blue; margin-right: 7px" href="">
                                <i class="fa fa-print">&nbsp; CETAK</i>
                            </a> -->
                            <!-- <a class="btn btn-primary fa fa-file-pdf-o" style="background-color: red; margin-right: 7px">&nbsp; PDF</a> -->
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

                        <!-- <a  style="background-color: blue" href="{{ route('ringkasan_kontak.create') }}">
                            <button class="btn btn-primary">Tambah Summary Batch</button>
                        </a> -->
                    </div>
                </div>
<!--                 <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th class="d-lg-none">&nbsp;</th>
                                <th>No</th>
                                <th>{{ __('No Kumpulan') }}</th>
                                <th>{{ __('Bulan') }}</th>
                                <th>{{ __('Tanggal Pengajuan') }}</th>
                                <th>{{ __('Bilangan') }}</th>
                                <th></th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                         <tbody>
                            <tr>
                                <td class="col-lg-none"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><a href="{{ route('summary_batch.show',1) }}" class="btn btn-primary" style="background-color: blue">Lihat</a></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div> -->
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
@endsection
