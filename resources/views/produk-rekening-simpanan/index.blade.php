@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Produk Rekening Simpanan') }}">
          <li class="breadcrumb-item">
        <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
    </li>
        <li class="breadcrumb-item">
            {{ __('Produk Rek. Simpanan') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="panel panel-primary">

                    <div class="tab-menu-heading">
                        <div class="tabs-menu ">
                            <!-- Tabs -->
                            <ul class="nav panel-tabs">
                                <li class="">
                                    <a href="#tab1" class="active" data-toggle="tab">Simpanan</a>
                                </li>
                                <li><a href="#tab2" data-toggle="tab">Simpanan Berjangka</a></li>
                                <li><a href="#tab3" data-toggle="tab">Pembiayaan</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body tabs-menu-body">
                        <div class="tab-content">
                            <div class="tab-pane active " id="tab1">
                                <div class="card-header">
                                    <h3 class="card-title">&nbsp;</h3>
                                    <div class="card-options">
                                        <a class="btn btn-primary" href="{{ route('produk-simpanan.create') }}">
                                            Tambah Produk Simpanan
                                        </a>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('kode') }}</th>
                                            <th>{{ __('Akad') }}</th>
                                            <th>{{ __('Nama Simpanan') }}</th>
                                            <th>{{ __('Min Setoran') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('GL Produk') }}</th>
                                            <th>{{ __('Tindakan') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (!empty($produkSimpanans))
                                            @foreach ($produkSimpanans as $i => $produk)
                                                <tr>
                                                    <td>{{ $i+1 }}</td>
                                                    <td>{{ $produk->kode_simpanan ?? '-'}}</td>
                                                    <td>{{ $produk->akads->nama_akad ?? '-' }}</td>
                                                    <td>{{ $produk->nama_simpanan ?? '-' }}</td>
                                                    <td>{{ $produk->storan_minimal ?? '-' }}</td>
                                                    <td>{{ $produk->status_text }}</td>
                                                    <td>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $produk->akun_perkiraans->depth) !!}{{ $produk->akun_perkiraans->kode }} &mdash; {{ $produk->akun_perkiraans->nama }}</td>

                                                    <td class="actions">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Tindakan</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ route('produk-simpanan.show', $produk->id) }}"
                                                                       class="dropdown-item fa fa-eye">&nbsp;Lihat</a></li>
                                                                <li><a href="{{ route('produk-simpanan.edit', $produk->id) }}"
                                                                       class="dropdown-item fa fa-pencil">&nbsp;Edit</a></li>

</ul>
                                </td>

                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="tab-pane  " id="tab2">
                                <div class="card-header">
                                    <h3 class="card-title">&nbsp;</h3>
                                    <div class="card-options">
                                        <a class="btn btn-primary" href="{{ route('produk-simpanan-berjangka.create') }}">
                                            Tambah Produk Simpanan Berjangka
                                        </a>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('kode') }}</th>
                                            <th>{{ __('Akad') }}</th>
                                            <th>{{ __('Nama Simpanan Berjangka') }}</th>
                                            <th>{{ __('Jangka Waktu') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('GL Produk') }}</th>
                                            <th>{{ __('Tindakan') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (!empty($produkSimpananberjangkas))
                                            @foreach ($produkSimpananberjangkas as $i => $produkberjangka)
                                                <tr>
                                                    <td>{{ $i+1 }}</td>
                                                    <td>{{ $produkberjangka->kode_simpanan ?? '-'}}</td>
                                                    <td>{{ $produkberjangka->akads->nama_akad ?? '-' }}</td>
                                                    <td>{{ $produkberjangka->nama_simpanan ?? '-' }}</td>
                                                    <td>{{ $produkberjangka->jangka_waktu ?? '-' }} Bulan</td>
                                                    <td>{{ $produkberjangka->status_text }}</td>
                                                    <td>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $produkberjangka->akun_perkiraans->depth) !!}{{ $produkberjangka->akun_perkiraans->kode }} &mdash; {{ $produkberjangka->akun_perkiraans->nama }}</td>
                                                    <td class="actions">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Tindakan</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ route('produk-simpanan-berjangka.show', $produkberjangka->id) }}"
                                                                       class="dropdown-item fa fa-eye">&nbsp;Lihat</a></li>
                                                                <li><a href="{{ route('produk-simpanan-berjangka.edit', $produkberjangka->id) }}"
                                                                       class="dropdown-item fa fa-pencil">&nbsp;Edit</a></li>

</ul>
                                </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane " id="tab3">
                                <div class="card-header">
                                    <h3 class="card-title">&nbsp;</h3>
                                    <div class="card-options">
                                        <a class="btn btn-primary" href="{{ route('produk-pembiayaan.create') }}">
                                            Tambah Pembiayaan
                                        </a>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('kode') }}</th>
                                            <th>{{ __('Nama Pembiayaan') }}</th>
                                            <th>{{ __('Akad') }}</th>
                                            <th>{{ __('Maks. Pembiayaan') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('GL Produk') }}</th>
                                            <th>{{ __('Tindakan') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (!empty($produkpembiayaan))
                                            @foreach ($produkpembiayaan as $i => $produks)
                                            <tr>
                                                    <td>{{ $i + 1 }}</td>
                                                    <td>{{ $produks->kode_pembiayaan ?? '-'}}</td>
                                                    <td>{{ $produks->nama_pembiayaan ?? '-' }}</td>
                                                    <td>{{ $produks->akads->nama_akad ?? '-' }}</td>
                                                    <td>Rp. {{ !empty($produks->maksimal_pembiayaan) ? number_format($produks->maksimal_pembiayaan, 2) : '0.00'}}</td>
                                                    <td>{{ $produks->status_text }}</td>
                                                <td>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $produks->akun_perkiraans->depth) !!}{{ $produks->akun_perkiraans->kode }} &mdash; {{ $produks->akun_perkiraans->nama }}</td>

                                    <td class="actions">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Tindakan</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ route('produk-pembiayaan.show', $produks->id) }}"
                                                                       class="dropdown-item fa fa-eye">&nbsp;Lihat</a></li>
                                                                <li><a href="{{ route('produk-pembiayaan.edit', $produks->id) }}"
                                                                       class="dropdown-item fa fa-pencil">&nbsp;Edit</a></li>

</ul>
                                </td>

                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
