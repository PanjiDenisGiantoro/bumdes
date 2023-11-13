@extends('layouts.app')

@section('breadcrumb')
<x-breadcrumb title="{{ __('Informasi Termin') }}">
    <li class="breadcrumb-item">
        <a href="{{ route('tetapan.index') }}">{{ __('Setting') }}</a>
    </li>
    <li class="breadcrumb-item">
        {{ __('Index Termin') }}
    </li>
</x-breadcrumb>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h3 class="card-title">Termin</h3>
                    <a href="{{ route('pembelian.setting.termin.create') }}" class="btn btn-primary">Tambah</a>
                </div>
                <div class="table-responsive">
                    <table class="table w-100 text-nowrap ml-3" id="crudTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Hari</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($termin as $termins => $data)
                                <tr>
                                    <td>{{ $termin->firstItem() + $termins }}</td>
                                    <td>{{ $data->kode }}</td>
                                    <td>{{ $data->hari }}</td>
                                    <td class="row">
                                        <a href="{{ route('pembelian.setting.termin.edit', $data->id) }}" class="btn btn-info fa fa-pencil"> </a>
                                        <form action="{{ route('pembelian.setting.termin.destroy', $data->id) }}"  method="POST">
                                        @csrf
                                        @method('DELETE')
                                            <button type="submit" class="btn btn-danger fa fa-trash"></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            {{-- <tr>
                                <th>1</th>
                                <td>Joan Powell</td>
                                <td>Associate Developer</td>
                                <td>
                                    <a href="#" class="btn btn-info fa fa-pencil" style="font-size: 12px"></a>
                                    <a href="#" class="btn btn-danger fa fa-trash" style="font-size: 12px"></a>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table><br>
                    <div class="col-7 col-sm-12 col-md-9">
                                         {{ $termin->links() }} 
                                    </div> 
                </div>
                <!-- table-responsive -->
            </div>
            <!-- section-wrapper -->
            {{-- {{-- </div> --}}

        </div>

    </div>
</div>
</div>
@endsection
