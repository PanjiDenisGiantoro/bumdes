@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Ringkasan Hutang Piutang') }}">
    	<li class="breadcrumb-item">
            <a href="{{ route('semua_laporan.index') }}">{{ __('Laporan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Ringkasan Hutang Piutang') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Hutang Piutang per Kontak</h3>
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
                <table class="table" style="width: 100%">
                    <thead class="thead-light">
                        <tr>
                            <th>
                                <span>Pelanggan</span>
                            </th>
                            <th>
                                <span>Perusahaan</span>
                            </th>
                            <th class="text-right">
                                <span>Hutang</span>
                            </th>
                            <th class="text-right">
                                <span>Piutang</span>
                            </th>
                            <th class="text-right">
                                <span>Net</span>
                            </th>
                        </tr>
                    </thead>
                    
                </table>
                {{-- <div class="card-footer">

                </div> --}}
            </div>
        </div>
    </div>
@endsection
