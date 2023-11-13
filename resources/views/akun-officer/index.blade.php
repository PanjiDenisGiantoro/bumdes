@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">Akun Officer</h3>
    <br>
{{--    <x-breadcrumb title="{{ __('Akun Officer') }}">--}}
{{--        <li class="breadcrumb-item">--}}
{{--            {{ __('Akun Officer') }}--}}
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
                        <a class="btn btn-primary" href="{{ route('akun-officer.create') }}">
                            Register AO Baru
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
{{--                                <th>{{ __('No. Mitra / ID') }}</th>--}}
                                <th>{{ __('Nama') }}</th>
                                <th>{{ __('No. Telpon') }}</th>
                                <th>{{ __('Jenis AO') }}</th>
                                <th>{{ __('Penampung') }}</th>
                                <th>{{ __('Status AO') }}</th>
                                <th>{{ __('Tgl. Register') }}</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daftarAO as $i => $ao)
                            <tr>
                                <td>{{ $i + 1}}</td>
{{--                                <td>{{ $ao->no_id ?? '-' }}</td>--}}
                                <td>{{ $ao->nama ?? '-' }}</td>
                                <td>{{ $ao->no_hp ?? '-' }}</td>
                                <td>{{ $ao->jenis_ao ?? '-' }}</td>
                                <td>{{ $ao->penampung ?? '-' }}</td>
                                @if ($ao->status_ao == 0)
                                    <td>
										<span class="label label-pill label-danger">{{ $ao->status_text ?? '-' }}</span>
                                    </td>
                                @else
                                    <td>
                                        <span class="label label-pill label-success">{{ $ao->status_text ?? '-' }}</span>
                                    </td>
                                @endif
                                <td>{{ !empty($ao->created_at) ? $ao->created_at->format('d-m-Y') : '-' }}</td>
                                <td class="actions">
                                    <!-- <div class="btn-group"> -->
                                        <!-- <a class="btn btn-outline-primary" href="{{ route('akun-officer.show', [$ao->id])  }}">Lihat</a> -->
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ route('akun-officer.show', [$ao->id]) }}" ><i class="fa fa-eye"></i>&nbsp;&nbsp; Lihat</a></li>
                                            <li><a href="{{ route('akun-officer.edit', [$ao->id])  }}"><i class="fa fa-check-square-o"></i>&nbsp;&nbsp; Edit</a></li>
                                            <!-- <li class="divider"></li>
                                            <li><a href="#">Delete</a></li> -->
                                        </ul>
                                    <!-- </div> -->
                                </td>
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
