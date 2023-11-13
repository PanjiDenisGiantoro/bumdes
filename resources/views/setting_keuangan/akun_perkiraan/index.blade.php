@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Akun Perkiraan') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Akun Perkiraan') }}">
        <li class="breadcrumb-item">
            <a href="{{route('transaksi_keuangan.index')}}">{{ __('Keuangan') }}</a>
        </li>
         <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Akun Perkiraan') }}
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                <a href="{{ route('tetapan.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Kembali') }}</a>&nbsp;&nbsp;&nbsp;
                    <div class="dropdown">
                        <button 
                            class="btn dropdown-toggle" 
                            type="button" 
                            id="dropdownMenuButton" 
                            data-toggle="dropdown" 
                            aria-expanded="false"
                        >
                            {{ $kode->nama ?? 'Semua Kelompok' }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('akun_perkiraan.index') }}">Pilih Kelompok</a>
                            @foreach ($kodes as $kode)
                                <a 
                                    class="dropdown-item" 
                                    href="{{ route('akun_perkiraan.index') }}?descendant_of={{ $kode->id }}"
                                >
                                    {{ $kode->nama }}
                                </a>
                            @endforeach
                        </div>
                      </div>
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

                        <a  style="background-color: blue" href="{{ route('akun_perkiraan.create') }}">
                            <button class="btn btn-primary">Tambah Akun Perkiraan</button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="d-lg-none">&nbsp;</th>
                                <th>{{ __('Nama Akun') }}</th>
                                <th class="text-right">{{ __('Saldo') }}</th>
                                <th>{{ __('Keterangan') }}</th>
                                <th class="text-right">{{ __('Tindakan') }}</th>
                            </tr>
                        </thead>
                         <tbody>
                            {{-- @foreach ($akuns as $i => $akun)
                            <tr>
                                <td class="d-lg-none">{{ $akuns->firstItem() + $i }}</td>
                                <td>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $akun->depth) !!}{{ $akun->kode }} &mdash; {{ $akun->nama }}</td>
                                <td class="text-right">{{ number_format($akun->balance(), 2) }}</td>
                                <td>{{ $akun->keterangan }}</td>
                                <td class="actions">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Tindakan</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                    @if (!empty($akun->parent_id))
                                            <li>
                                            <a href="{{ route('akun_perkiraan.edit', $akun) }}" class="dropdown-item fa fa-pencil" style="background-color: green; font-size: 12px">&nbsp;Edit</a>
                                            </li>
                                            <li>
                                            <a href="{{ route('akun_perkiraan.destroy', $akun) }}" class="dropdown-item fa fa-trash" style="background-color: red; font-size: 12px" data-id="{{ $akun->id }}" data-name="{{ $akun->kode }} - {{ $akun->nama }}">&nbsp;Hapus</a>
                                            </li>
                                    @endif
</ul>
                                </td>
                            </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
                {{-- <div class="card-footer">
                    {{ $akuns->withQueryString()->links() }}
                </div> --}}
            </div>
        </div>
    </div>
@endsection

@push('css')
<link href="https://cdn.jsdelivr.net/npm/jquery-treegrid@0.3.0/css/jquery.treegrid.css" rel="stylesheet">
<link href="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.css" rel="stylesheet">
<style>
.fixed-table-toolbar {
    display: none;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-treegrid@0.3.0/js/jquery.treegrid.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.19.1/dist/extensions/treegrid/bootstrap-table-treegrid.min.js"></script>
<script>
    var $table = $('table.table');

    $(document).ready(function () {
        $('body').on('click', 'a.fa-trash', function (e) {
            e.preventDefault();
            
            var me = $(this);

            if (confirm('Hapus ' + me.data('name') + '?')) {
                $.ajax({
                    url: '{{ route('akun_perkiraan.index') }}/' + me.data('id'),
                    method: 'POST',
                    data: {
                        _method: 'DELETE',
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
                            me.parent().parent().children().slideUp();
                        }
                    }
                });
            }
        });

        $table.bootstrapTable({
            // url: '{{ route('akun_perkiraan.index') }}',
            ajax: function (params) {
                var url = '{{ route('akun_perkiraan.index') }}?descendant_of={{ request()->query('descendant_of') }}&limit=1000';

                $.get(url + '&' + $.param(params.data)).then(function (res) {
                    params.success(res.data)
                });
            },
            treeEnable: true,
            idField: 'id',
            parentIdField: 'parent_id',
            rootParentId: {{ request()->query('descendant_of', 0) }},
            treeShowField: 'text',
            showColumns: true,
            columns: [
                {
                    field: 'id',
                },
                {
                    field: 'text',
                },
                {
                    field: 'saldo',
                    formatter: function (value, row, index) {
                        return value.toFixed(2);
                    }
                },
                {
                    field: 'keterangan',
                },
                {
                    field: 'id',
                    formatter: function (value, row, index) {
                        if (parseInt(row.parent_id) > 0) {
                            return `
                                <a href="{{ route('akun_perkiraan.index') }}/${value}/edit" class="btn btn-primary fa fa-pencil" style="background-color: green; font-size: 12px"></a>
                                <a class="btn btn-primary fa fa-trash" style="color: #fff; background-color: red; font-size: 12px" data-id="${value}" data-name="${row.text}"></a>
                            `;
                        }

                        return null;
                    }
                },
            ],
            onPostBody: function() {
                var columns = $table.bootstrapTable('getOptions').columns;

                // if (columns && columns[0][1].visible) {
                    $table.treegrid({
                        treeColumn: 1,
                        onChange: function() {
                            $table.bootstrapTable('resetView')
                        }
                    });
                // }
            },
            loadingTemplate: function (message) {
                return '<i class="fa fa-spinner fa-spin fa-fw fa-2x"></i>';
            }
        });
    });
</script>
@endpush