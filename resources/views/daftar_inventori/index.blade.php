@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Daftar Inventori') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('daftar_inventori.index') }}">{{ __('Inventori') }}</a>
        </li>
    	<!-- <li class="breadcrumb-item">
            <a href="">{{ __('Kontak') }}</a>
        </li> -->
        <li class="breadcrumb-item">
            {{ __('Daftar Inventori') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
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
                            <th>{{ __('Nama Produk') }}</th>
                            <th>{{ __(' Harga Beli') }}</th>
                            <th>{{ __('Harga Jual') }}</th>
                            <th>{{ __('Stok') }}</th>
                            <th>{{ __('Satuan Unit Masuk / Keluar') }}</th>
                            <th>{{ __('Keterangan') }}</th>
                            <th>Tindakan</th>
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
