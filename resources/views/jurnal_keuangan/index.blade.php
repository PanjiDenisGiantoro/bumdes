@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Jurnal') }}">
        <li class="breadcrumb-item">
            {{ request()->route()->getName() == 'jurnal_entry.index' ? __('Laporan') : __('Keuangan') }}
        </li>
        <!--  <li class="breadcrumb-item">
            <a href="{{ route('setting_produk.index') }}">{{ __('Keuangan') }}</a>
        </li> -->
        <li class="breadcrumb-item">
            {{ __('Jurnal') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Jurnal</h3>
                    <div class="card-options">
                        <!-- <div class="btn-group mr-2">
                            <a class="btn btn-primary" style="background-color: blue; margin-right: 7px" href="">
                                <i class="fa fa-print">&nbsp; Cetak</i>
                            </a>
                            <a class="btn btn-primary" style="background-color: red; margin-right: 7px" href="">
                                <i class="fa fa-file-pdf-o">&nbsp; PDF</i>
                            </a>
                            <a class="btn btn-primary" style="background-color: green;  margin-right:7px" href="">
                                <i class="fa fa-file-excel-o">&nbsp; EXCEL</i>
                            </a>
                        </div> -->

                        @if (request()->route()->getName() != 'jurnal_entry.index')
                        <a  style="background-color: blue" href="{{ route('jurnal_keuangan.create') }}">
                            <button class="btn btn-primary">Tambah Jurnal</button>
                        </a>
                        @endif
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th class="d-lg-none">&nbsp;</th>
                                <th>{{ __('No') }}</th>
                                <th>{{ __('Tanggal') }}</th>
                                <th>{{ __('No Jurnal') }}</th>
                                <th>{{ __('No Ref') }}</th>
                                <th>{{ __('Debet') }}</th>
                                <th>{{ __('Kredit') }}</th>
                                <th class="text-right">{{ __('Nominal') }}</th>
                                <th>{{ __('Pengguna') }}</th>
                                <th>{{ __('Tindakan') }}</th>
                                <!-- <th>&nbsp;</th> -->
                            </tr>
                        </thead>
                         <tbody>
                            @foreach ($ledgers as $i => $ledger)
                                <tr>
                                    {{-- <td class="col-lg-none"></td> --}}
                                    <td>{{ $ledgers->firstItem() + $i }}</td>
                                    <td>{{ date('d/m/Y',  strtotime($ledger->date)) }}</td>
                                    <td>{{ $ledger->journal_number }}</td>
                                    <td>{{ $ledger->reference }}</td>
                                    <td>
                                        {{
                                            $ledger
                                                ->entries
                                                ->filter(function ($entry) {
                                                    return $entry->debit;
                                                })
                                                ->pluck('ledgerable.nama')
                                                ->join(', ')
                                        }}
                                    </td>
                                    <td>
                                        {{
                                            $ledger
                                                ->entries
                                                ->filter(function ($entry) {
                                                    return $entry->credit;
                                                })
                                                ->pluck('ledgerable.nama')
                                                ->join(', ')
                                        }}
                                    </td>
                                    <td class="text-right">{{ number_format($ledger->entries->pluck('amount')->avg(), 2) }}</td>
                                    <td>{{ $ledger->creator->name ?? '' }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-dribbble dropdown-toggle btn-sm" data-toggle="dropdown" title="Aksi">
                                                Tindakan
                                            </button>
                                            <div class="dropdown-menu">
                                                <li><a href="{{ route('jurnal_keuangan.show', $ledger) }}" class="dropdown-item fa fa-eye"> &nbsp;Lihat</a></li>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{$ledgers->links()}}

                </div>
            </div>
        </div>
    </div>
@endsection
