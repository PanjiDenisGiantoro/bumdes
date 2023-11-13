@extends('layouts.app')

@section('breadcrumb')
<br>
<x-breadcrumb title="{{ __('Informasi Ekspedisi') }}">
    <li class="breadcrumb-item">
        <a href="{{ route('tetapan.index') }}">{{ __('Setting') }}</a>
    </li>
    <li class="breadcrumb-item">
        {{ __('Index Ekspedisi') }}
    </li>
</x-breadcrumb>
@endsection

@section('content')

<div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h3 class="card-title">Ekspedisi</h3>
                    <a href="{{ route('pembelian.setting.ekpedisi.create') }}" class="btn btn-primary">Tambah</a>
                </div>
                <div class="table-responsive">
                    <table class="table w-100 text-nowrap ml-3" id="crudTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($ekpedisi as $ekpedisis => $data)
                                <tr>
                                    <td>{{ $ekpedisi->firstItem() + $ekpedisis }}</td>
                                    <td>{{ $data->kode }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td class="row">
                                        <a href="{{ route('pembelian.setting.ekpedisi.edit', $data->id) }}" class="btn btn-info fa fa-pencil"> </a>
                                        <form action="{{ route('pembelian.setting.ekpedisi.destroy', $data->id) }}"  method="POST">
                                        @csrf
                                        @method('DELETE')
                                            <button type="submit" class="btn btn-danger fa fa-trash"></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><br>
                    <div class="col-7 col-sm-12 col-md-9">
                                         {{ $ekpedisi->links() }} 
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
