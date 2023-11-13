@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">Pelepasan Aset</h3>
    <br>
{{--    <x-breadcrumb title="{{ __('Pelepasan') }}">--}}
{{--    	<li class="breadcrumb-item">--}}
{{--            <a href="{{ route('daftar_aset.index') }}">{{ __('Aset Mgmt') }}</a>--}}
{{--        </li>--}}
{{--        <li class="breadcrumb-item">--}}
{{--            {{ __('Pelepasan') }}--}}
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

                        <a  style="background-color: blue" href="{{ route('pelepasan_aset_mgt.create') }}">
                            <button class="btn btn-primary">Transaksi Baru
                            </button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
{{--                                <th>{{ __('No Transaksi') }}</th>--}}
                                <th>{{ __('Tanggal Transaksi') }}</th>
                                <th>{{ __('Kelompok Aset') }}</th>
                                <th>{{ __('Nama Aset') }}</th>
                                <th>{{ __('Harga Jual') }}</th>
                                <th>{{ __('Tindakan') }}</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                         <tbody>
                         @foreach ($pelepasan_aset_mgts as $i => $kode)
                            <tr>

                                <td class="col-lg-none">{{ $pelepasan_aset_mgts->firstItem() + $i }}</td>
{{--                                <td>{{$kode->no_transaksi }}</td>--}}
                                <td>{{\Carbon\Carbon::parse($kode->tanggal_transaksi)->format('d/m/Y') ?? ''}}</td>
                                <td>{{$kode->aset->kelompokaset->kelompok_aset ?? ''}}</td>
                                <td>{{$kode->aset->nama_aset ?? ''}}</td>
                                <td>Rp.{{number_format($kode->harga_jual ?? ''),2}}</td>
                                <td class="actions">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-dribbble dropdown-toggle btn-sm" data-toggle="dropdown" title="Aksi">
                                            Tindakan
                                        </button>
                                        <div class="dropdown-menu">
                                            <form method="post" class="delete-form" data-route="{{route('pelepasan_aset_mgt.destroy',$kode->id)}}">
                                                <li> <a href="{{ route('pelepasan_aset_mgt.show',$kode->id) }}" class="dropdown-item fa fa-eye"></a></li>
                                                <li><a href="#" class="dropdown-item fa fa-pencil"></a></li>
                                                @method('delete')
                                                <li><button type="submit" class="dropdown-item  fa fa-trash"></button></li>
                                            </form>

                                        </div>
                                    </div>

                                 </td>

                            </tr>

                         @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $pelepasan_aset_mgts->links() }}

                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function () {

            $('.delete-form').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: $(this).data('route'),
                    data: {
                        '_method': 'delete'
                    },
                    success: function (response, textStatus, xhr) {
                        window.location = '/pelepasan_aset_mgt'

                    }
                });
            })
        });
    </script>
@endpush
