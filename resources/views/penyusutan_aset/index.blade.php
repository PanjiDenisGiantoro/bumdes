@extends('layouts.app')

@section('breadcrumb')
   <h3 class="card-header">Penyusutan Aset</h3>
    <br>
{{--    <x-breadcrumb title="{{ __('Penyusutan') }}">--}}
{{--    	<li class="breadcrumb-item">--}}
{{--            <a href="{{ route('daftar_aset.index') }}">{{ __('Aset Mgmt.') }}</a>--}}
{{--        </li>--}}
{{--        <li class="breadcrumb-item">--}}
{{--            {{ __('Penyusutan') }}--}}
{{--        </li>--}}
{{--    </x-breadcrumb>--}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">&nbsp;</h3>
                    <div class="card-options">
{{--                        <a  style="background-color: blue" href="{{ route('penyusutan_aset.create') }}">--}}
{{--                            <button class="btn btn-primary">Jalankan Penyusutan</button>--}}
{{--                        </a>--}}
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th>{{ __('No') }}</th>
                            <th>{{ __('Kelompok Aset') }}</th>
                            <th>{{ __('Aset') }}</th>
                            <th>{{ __('Tgl Perolehan') }}</th>
                            <th>{{ __('Waktu Manfaat') }}</th>
                            <th>{{ __('Nilai Perolehan') }}</th>
                            <th>{{ __('Sisa Waktu Manfaat') }}</th>
                            <th>{{ __('Total Akumulasi') }}</th>
                            <th>{{ __('Nilai Buku') }}</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($asets as $i => $produk)
                            <tr>
                                <td>{{ $asets->firstItem() + $i }}</td>
                                <td>{{$produk->kelompokaset->kelompok_aset ?? ''}}</td>
                                <td>{{$produk->nama_aset ?? ''}}</td>
                                <td>{{\Carbon\Carbon::parse($produk->tanggal_akuisisi)->format('d/m/Y') ?? ''}}</td>
                                <td>{{$produk->nilai ?? ''}} Bulan</td>
                                <td>{{number_format($produk->biaya_akuisisi) ?? ''}}</td>
                                <td>{{$produk->perbedaan_bulan ?? ''}} Bulan</td>
                                <td>{{number_format($produk->total_penyusutan) ?? ''}}</td>
                                <td>{{number_format($produk->perkiraan_akhir_buku) ?? ''}}</td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
@endsection
