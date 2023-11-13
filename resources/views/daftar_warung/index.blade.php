@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">Daftar Usaha</h3>
    <br>
{{--    <x-breadcrumb title="{{ __('Daftar Usaha') }}">--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('daftar_warung.index') }}">{{ __('Usaha') }}</a>--}}
{{--        </li>--}}
{{--        <li class="breadcrumb-item">--}}
{{--            {{ __('Daftar Usaha') }}--}}
{{--        </li>--}}
{{--    </x-breadcrumb>--}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                    <form method="get" style="width: 50%;">
                            <div class="input-group" >
                                <input type="text" name="search" class="form-control d-inline" id="search" placeholder="Pencarian Usaha" value="{{ request()->query('search', '') }}">
                                <button class="btn btn-white" type="submit">
                                    <em class="fa fa-search"></em>
                                </button>
                                &nbsp;
                                {{-- <select name="status_aktif" class="form-control">
                                    <option value="" >Status</option>
                                    <option value="1" >Aktif</option>
                                    <option value="0" >Tidak Aktif</option>
                                </select> --}}

                            </div>
                        </form>

                        <div class="card-options">

                        <a href="{{ route('daftar_warung.create') }}">
                            <button class="btn btn-primary">Daftar Usaha</button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th class="d-lg-none">&nbsp;</th>
                            <th>No</th>
                        <!-- <th>{{ __('No') }}</th> -->
                            <th>{{ __('Tgl. Daftar') }}</th>
                            <th>{{ __('No. Anggota') }}</th>
                            <th>{{ __('Nama Anggota') }}</th>
                            <th>{{ __('Nama Usaha') }}</th>
                            {{-- <th>{{ __('NIK') }}</th> --}}
                            <!-- <th>{{ __('Provinsi') }}</th> -->
                            <!-- <th>{{ __('Bumdes') }}</th> -->
                            <th>{{ __('Status Usaha') }}</th>
                            <!-- <th>{{ __('Profil Warong') }}</th> -->
                            <!-- <th>{{ __('Berita Acara') }}</th> -->
                        <!-- <th>{{ __('Tgl. Jatuh Tempo') }}</th>
                                <th>{{ __('Plafon') }}</th> -->
                            <th>{{ __('Tindakan') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($daftar_warungs as $i => $daftar_warung)
                                <td class="col-lg-none">{{ $daftar_warungs->firstItem() + $i }}</td>
                                <td>{{\Carbon\Carbon::parse($daftar_warung->created_at)->format('d/m/Y') ?? ''}}</td>
                                <td>{{ $daftar_warung->anggota->no_mitra ?? '' }}</td>
                                <td>{{ $daftar_warung->anggota->nama_pemohon ?? '' }}</td>
                                <td>{{ $daftar_warung->nama_warung ?? ''}}</td>
                                {{-- <td>{{ $daftar_warung->anggota->nik ?? '' }}</td> --}}
                                <!-- <td>{{ $daftar_warung->alamat_sama ? ($daftar_warung->anggota->province ?? '') : ($daftar_warung->province->name ?? '') }}</td> -->
                                <!-- <td>{{ $daftar_warung->anggota->bumdes ?? '' }}</td> -->
                                <td>
                                    @if ($daftar_warung->status_aktif == 1)
                                    <span class="tag tag-green">Aktif</span></td>
                                    @else
                                    <span class="tag tag-red">Tidak Aktif</span></td>
                                    @endif
                                </td>
                                <!-- <td>
                                    <a href="{{ route('daftar_warung.show', array_merge(request()->query(), [$daftar_warung->id, $daftar_warung->nama_warung, 'export' => 'pdf'])) }}" target="_blank" class="btn btn-info fa fa-file-pdf-o"></a>
                                </td>
                                <td>
                                    @if ($daftar_warung->anggota->pembiayaan->count())
                                        <a href="{{ route('daftar_warung.show2', array_merge(request()->query(), [$daftar_warung->id, 'export' => 'pdf'])) }}" target="_blank" class="btn btn-info fa fa-file-pdf-o" style="background-color: orange"></a>
                                    @endif
                                </td> -->
                                <td class="actions">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">

                                            <li><a href="{{ route('daftar_warung.show',array_merge(request()->query(), [$daftar_warung->id, 'export' => 'show'])) }}" ><i class="fa fa-eye"></i>&nbsp;&nbsp; Lihat </a></li>
                                            {{-- <li class="divider"></li> --}}
                                            <li><a href="{{ route('daftar_warung.edit', $daftar_warung->id) }}" ><i class="fa fa-pencil"></i>&nbsp;&nbsp; Edit</a></li>
                                            {{-- <li><a  href="{{  route('rekening-simpanan.approve', $simpanan->id) }}" ><i class="fa fa-check-square-o"></i>&nbsp;&nbsp; Approve</a></li> --}}
                                        </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $daftar_warungs->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
