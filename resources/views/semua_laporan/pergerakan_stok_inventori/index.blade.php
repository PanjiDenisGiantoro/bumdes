@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Pergerakan Stok Inventory') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('semua_laporan.index') }}">{{ __('Laporan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Pergerakan Stok Inventory') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title w-65" ><b>PERGERAKAN STOK INVENTORY</b></h3>
                    <ul class="btn-toolbar">
                        <li>
                            <input class="class form-control "  type="text" name="datefilter" value="" width="100%" />
                        </li>
                        <li class="mr-3">
                            <button type="button" class="btn btn-white br-0 w-10"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </li>
                        <li class="mr-3">
                            <a href=""class="btn btn-outline-danger fa fa-file-pdf-o " ></a>
                        </li>
                        <li>
                            <a href=""class="btn btn-outline-success fa fa-file-excel-o " ></a>
                        </li>
                    </ul>

                </div>

                <div class="card-tools ">
                    <div class="table-responsive">
                        <div class="col-12">
                            <table class=" table card-table table-vcenter text-nowrap table-primary" id="customers-table1"style="width: 100%">
                                <thead class="bg-primary text-white">
                                <tr>

                                    <th class="text-white">+</th>
                                    <th class="text-white">Nama Produk</th>
                                    <th class="text-white">Harga Beli</th>
                                    <th class="text-white">Harga Jual</th>
                                        <th class="text-white">Satuan Masuk</th>
                                        <th class="text-white">Satuan Keluar</th>
                                        <th class="text-white">Stok</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>

    <style>
        .hide {
            display: none;
        }
        td.details-control {
            background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
        }
    </style>
@endsection
@push('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://datatables.yajrabox.com/js/handlebars.js"></script>

    <script>
        $(function() {
            $('input[name="datefilter"]').daterangepicker({
                opens: 'left',
                locale: {
                    format: 'DD/MM/YYYY',
                },
                ranges: {
                    'Hari Ini': [moment(), moment()],
                    'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
                    '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
                    'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
                    'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            });
        });

    </script>

    <script id="details-template" type="text/x-handlebars-template">
        @verbatim
        <div class="label label-info">id <b> {{ id }}</b></div>
        <table class="table card-table table-vcenter text-nowrap table-primary" style="width: 100%;" id="purchases-{{id}}">
            <thead class="bg-primary text-white">
            <tr>
                <th class="text-white">Tanggal</th>
                <th class="text-white">Transaksi</th>
                <th class="text-white">Deskripsi</th>
                <th class="text-white">Pergerakan Stok</th>
                <th class="text-white">Stok</th>
            </tr>
            </thead>
        </table>
        @endverbatim
    </script>

    <script>

        var template = Handlebars.compile($("#details-template").html());
        var table = $('#customers-table1').DataTable({
            processing: true,
            serverSide: true,
            //search non active
            searching: false,
            //paging right position
            paging: true,
            pagingType: "full_numbers",
            pageLength: 10,
            //order by created_at desc
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            ajax: '{{ route('pergerakan_stok_inventori.create') }}',
            columns: [
                {
                    "className":      'details-control',
                    "data":           null,
                    // order by tanggal_penerimaan desc
                    "orderable":      true,
                    "defaultContent": ''
                },
                { data: 'nama_produk', name: 'nama_produk' },
                { data: 'harga_beli', name: 'harga_beli' },
                { data: 'harga_anggota', name: 'harga_anggota' },
                { data: 'beli', name: 'beli' },
                { data: 'jual', name: 'jual' },
                { data: 'stok', name: 'stok' },
            ],
            order: [[1, 'asc']]
        });
        // Add event listener for opening and closing details
        $('#customers-table1 tbody').on('click','td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var tableId = 'purchases-' + row.data().id;
            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(template(row.data())).show();
                initTable(tableId, row.data());
                console.log(row.data());
                tr.addClass('shown');
                tr.next().find('td').addClass('no-padding bg-white');
            }
        });
        function initTable(tableId, data) {
            $('#' + tableId).DataTable({
                processing: true,
                "ordering": false,
                serverSide: true,
                ajax: data.details_url,
                columns: [
                    { data: 'created_at', name: 'created_at' },
                    { data: 'invoice', name: 'invoice'},
                    { data: 'supplier', name: 'supplier'},
                    { data: 'stok_bertambah', name: 'stok_bertambah'},
                    { data: 'stok', name: 'stok'},

                ]
            })
        }
    </script>
@endpush
