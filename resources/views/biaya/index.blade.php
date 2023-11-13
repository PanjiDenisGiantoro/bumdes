@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Biaya') }}">
        <li class="breadcrumb-item">
            {{ request()->route()->getName() == 'jurnal_entry.index' ? __('Laporan') : __('Keuangan') }}
        </li>
        <!--  <li class="breadcrumb-item">
            <a href="{{ route('setting_produk.index') }}">{{ __('Keuangan') }}</a>
        </li> -->
        <li class="breadcrumb-item">
            {{ __('Biaya') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Biaya</h3>
                    <div class="card-options">
{{--                        @if (request()->route()->getName() != 'biaya.index')--}}
                        <a  style="background-color: blue" href="{{ route('biaya.create') }}">
                            <button class="btn btn-primary">Tambah Biaya</button>
                        </a>
{{--                        @endif--}}
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>{{ __('No') }}</th>
                                <th>{{ __('Tanggal') }}</th>
                                <th>{{ __('No Biaya') }}</th>
                                <th>{{ __('No Ref') }}</th>
                                <th>{{ __('Debet') }}</th>
                                <th>{{ __('Kredit') }}</th>
                                <th class="text-right">{{ __('Nominal') }}</th>
                                <th>{{ __('Pengguna') }}</th>
                                <th></th>
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
                                 <td class="text-right">Rp.{{$ledger->nominal}}</td>
                                 <td>{{ $ledger->creator->name ?? '' }}</td>
                                 <td>
                                     <div class="dropdown">
                                         <button type="button" class="btn btn-dribbble dropdown-toggle btn-sm" data-toggle="dropdown" title="Aksi">
                                             Tindakan
                                         </button>
                                         <div class="dropdown-menu">
                                             <li>  <a href="{{ route('biaya.show', $ledger) }}" class="dropdown-item fa fa-eye" style="color: #fff; background-color: blue; font-size: 12px">
                                                 &nbsp;Lihat</a></li>
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
