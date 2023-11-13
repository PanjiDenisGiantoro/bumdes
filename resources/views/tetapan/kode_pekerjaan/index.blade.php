@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Kode Pendidikan') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Setting') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Kode Pendidikan') }}
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

                        <a  style="background-color: blue" href="{{ route('kode_pendidikan.create') }}">
                            <button class="btn btn-primary">Tambah Pendidikan</button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>{{ __('No') }}</th>

                                <th>{{ __('Kode') }}</th>

                                <th>{{ __('Pendidikan') }}</th>

                                <th>{{ __('Tindakan') }}</th>
                                <!-- <th>&nbsp;</th> -->
                            </tr>
                        </thead>
                         <tbody>
                         @php $no = 1 ;@endphp
                         @foreach($KodePendidikan as $kode)
                            <tr>
                                <td class="col-lg-none">{{$no++}}</td>
                                <td>{{$kode->kode_pendidikan ?? ''}}</td>
                                <td>{{$kode->pendidikan ?? ''}}</td>
                                <td>
                                    <a href="{{route('kode_pendidikan.edit',$kode->id)}}" class="btn btn-primary"  style="background-color: blue">Edit</a>
                                    <form method="POST" class="btn btn-primary"  onsubmit="return confirm('Move data to trash?')" action="{{route('kode_pendidikan.destroy',$kode->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" value="DELETE" name="_method">
                                        <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                    </form>

                                </td>
                                <td></td>
                            </tr>
                         @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $KodePendidikan->links() }}
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
@endsection
