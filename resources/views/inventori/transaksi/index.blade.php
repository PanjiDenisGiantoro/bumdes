@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Informasi Transaksi') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('daftar_inventori.index') }}">{{ __('Inventori') }}</a>
        </li>
    	<!-- <li class="breadcrumb-item">
            <a href="">{{ __('Kontak') }}</a>
        </li> -->
        <li class="breadcrumb-item">
            {{ __('Informasi Transaksi') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Transaksi</h3>
                    <div class="card-options">
                        
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th class="d-lg-none">&nbsp;</th>
                            <th>{{ __('No') }}</th>
                            <th>{{ __('Tanggal') }}</th>
                            <th>{{ __('Tipe') }}</th>
                            <th>{{ __('Nomor') }}</th>
                            <th>{{ __('Reference') }}</th>
                            <th>{{ __('Debit') }}</th>
                            <th>{{ __('Kredit') }}</th>
                            <th>Tindakan</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <!-- <button class="btn btn-primary fa fa-eye"  style="background-color: blue; font-size: 12px"></button> -->
                                <a href="{{ route('daftar_inventori.show',1) }}" class="btn btn-primary fa fa-eye" style="background-color: blue; font-size: 12px"></a></td>
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
@endsection
