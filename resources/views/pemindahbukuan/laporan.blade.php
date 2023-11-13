@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Laporan Pemindah Bukuan') }}">
        <li class="breadcrumb-item">
            Laporan Pemindah Bukuan
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th class="d-lg-none">&nbsp;</th>
                            <th>No</th>
                            {{--                            <th>No. Invoice</th>--}}
                            {{--                            <th>Status Pesanan</th>--}}
                            {{--                            <th>Status Pembayaran</th>--}}
                            <th>Tanggal </th>
                            <th>No Jurnal</th>
                            <th>Deskripsi</th>
                            <th>Nominal</th>
                            <th>User</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($ledgers as $i => $ledger)
                            <tr>
                                <td>{{ $ledgers->firstItem() + $i }}</td>
                                <td>{{ date('d/m/Y',  strtotime($ledger->date)) }}</td>
                                <td>{{ $ledger->journal_number }}</td>
                                <td>{{ $ledger->description }}</td>
                                {{--                                    <td class="text-right">{{ number_format(abs($ledger->entries->pluck('amount')->avg()), 2) }}</td>--}}
                                <td class="text-right">{{ !empty($ledger->nominal) ? number_format($ledger->nominal) : '-' }}</td>
                                <td>{{ $ledger->creator->name ?? null }}</td>
                                <td class="actions">
                                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ route('transaksi_keuangan.show', $ledger) }}" ><i class="fa fa-eye"></i>&nbsp;&nbsp; Lihat </a></li>
                                    </ul>
                                </td>
                            <!-- <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-dribbble dropdown-toggle btn-sm" data-toggle="dropdown" title="Aksi">
                                                Tindakan
                                            </button>
                                            <div class="dropdown-menu">
                                                <li> <a href="{{ route('transaksi_keuangan.show', $ledger) }}" class="dropdown-item fa fa-eye" style="color: #fff; background-color: blue; font-size: 12px">&nbsp;Lihat</a></li>
                                            </div>
                                        </div>
                                    </td> -->
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $ledgers->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endpush
