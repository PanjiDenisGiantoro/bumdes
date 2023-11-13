@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Produk Rekening Pembiayaan') }}">
        <li class="breadcrumb-item">
            {{ __('Produk Rekening Pembiayaan') }}
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
                        <a class="btn btn-primary" href="{{ route('rekening-pembiayaan.create') }}">
                          Tambah Rekening Pembiayaan
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Anggota') }}</th>
                                <th>{{ __('No. Rekening') }}</th>
                                <th>{{ __('Produk') }}</th>
                                <th>{{ __('Akad') }}</th>
                                <th>{{ __('Saldo') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($simpananList as $i => $simpanan)
                            <tr>
                                <th>{{ $simpananList->firstItem() + $i }}</th>
                                @if(!empty($simpanan->status == 'disetujui'|| $simpanan->status == 'tidak_disetujui'||$simpanan->status == 'aktif'))
                                    <th><a href="{{route('rekening-simpanan.showTransaksi',$simpanan->id)}}" style="color: blue">{{ $simpanan->anggota->nama_pemohon ?? '' }}</a></th>
                                @else
                                    <th>{{ $simpanan->anggota->nama_pemohon ?? '' }}</th>
                                    @endif
                                @if(!empty($simpanan->status == 'disetujui'||$simpanan->status == 'aktif'))
                                    <th>{{ $simpanan->no_akun ?? '' }}</th>
                                @else
                                    <th></th>
                                    @endif
                                <th>{{ $simpanan->produk->nama_simpanan ?? '-' }}</th>
                                <th>{{ $simpanan->akads->nama_akad ?? '-' }}</th>
                                <th>{{ number_format($simpanan->balance(), 2) ?? null }}</th>
                                <th>{{$simpanan->status}}</th>
                                <td class="actions">
                                @if(!empty($simpanan->status == 'disetujui'|| $simpanan->status == 'tidak_disetujui'||$simpanan->status == 'aktif'))
                                    <a href="{{ route('rekening-simpanan.show', $simpanan->id) }}" class="btn btn-primary fa fa-eye"></a>
                                    @endif
                                    <a href="{{ route('rekening-simpanan.edit', $simpanan->id) }}" class="btn btn-success fa fa-pencil"></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
{{--                {{$simpananList->links()}}--}}
                </div>
            </div>
        </div>
    </div>
@endsection
