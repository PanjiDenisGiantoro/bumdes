@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Tutup Buku') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('transaksi_keuangan.index') }}">{{ __('Keuangan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tutup Buku') }}
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
                            <a class="btn btn-primary fa fa-print" style="background-color: blue; margin-right: 7px">&nbsp; CETAK</a>
                            <!-- <a class="btn btn-primary" style="background-color: blue; margin-right: 7px" href="">
                                <i class="fa fa-print">&nbsp; CETAK</i>
                            </a> -->
                            <a class="btn btn-primary fa fa-file-pdf-o" style="background-color: red; margin-right: 7px">&nbsp; PDF</a>
                           <!--  <a class="btn btn-primary" style="background-color: red; margin-right: 7px" href="">
                                <i class="fa fa-file-pdf-o">&nbsp; PDF</i>
                            </a> -->
                            <a class="btn btn-primary fa fa-print" style="background-color: green; margin-right: 7px">&nbsp; EXCEL</a>
                            <!-- <a class="btn btn-primary" style="background-color: green;  margin-right:7px" href="">
                                <i class="fa fa-file-excel-o">&nbsp; EXCEL</i>
                            </a> -->
                        </div>

                        <a  style="background-color: blue" href="{{ route('tutup_buku.create') }}">
                            <button class="btn btn-primary">Tambah Tutup Buku</button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th class="d-lg-none">&nbsp;</th>
                                <th></th>
                                <th>{{ __('No') }}</th>
                                <th>&nbsp;</th>
                                <th>{{ __('Periode Mula') }}</th>
                                <th>&nbsp;</th>
                                <th>{{ __('Periode Akhir') }}</th>
                                <th>&nbsp;</th>
                                <th>{{ __('Laba Rugi') }}</th>
                                <th>&nbsp;</th>
                                <th>{{ __('Debit Tahun Ini') }}</th>
                                <th>&nbsp;</th>
                                <th>{{ __('Kredit Tahun Ini') }}</th>
                                <th>&nbsp;</th>
                                <!-- <th>{{ __('Tgl. Jatuh Tempo') }}</th>
                                <th>{{ __('Plafon') }}</th> -->
                                <th>{{ __('Tindakan') }}</th>
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
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                	<a href="{{ route('tutup_buku.show',1) }}"class="btn btn-primary fa fa-eye"  style="background-color: blue; font-size: 12px"></a>
                                	<button class="btn btn-primary fa fa-pencil"  style="background-color: green; font-size: 12px"></button>
                                	<!-- <a href="{{ route('anggota.show',1) }}" class="btn btn-primary" style="background-color: blue; font-size: 12px">Cetak</a> -->
                                    <button class="btn btn-primary fa fa-trash"  style="background-color: red; font-size: 12px"></button>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
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
@endsection
