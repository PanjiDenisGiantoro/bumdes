@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Detail Penjualan') }}">
    	<li class="breadcrumb-item">
            <a href="{{ route('semua_laporan.index') }}">{{ __('Laporan') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Detail Penjualan') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title w-65" ><b>DETAIL PENJUALAN</b></h3>
                    <ul class="btn-toolbar">
                        <li>
                              <input class="class form-control "  type="text" name="datefilter" value="{{ request()->query('datefilter') }}" />
                        </li>
                        <li>
                            <button type="button" class="btn btn-white br-0 w-10"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </li>

                        <li class="btn-toolbar-sep"></li>
                        <li>
                        <li class="dropdown">
                            <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-toggle="dropdown">
                                <em class="icon ni ni-filter-alt"></em>
                            </a>
                            <div class="filter-wg dropdown-menu dropdown-menu-xl dropdown-menu-right">
                                <div class="dropdown-head">
                                    <span class="sub-title dropdown-title">Advance Filter</span>
                                    <div class="dropdown">
                                        <a href="#" class="link link-light">
                                            <em class="icon ni ni-more-h"></em>
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown-body dropdown-body-rg">
                                    <div class="row gx-6 gy-4">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="overline-title overline-title-alt">Status</label>
                                                <select multiple class="form-select form-select-sm select2-hidden-accessible" name="state[]" data-allow-clear="true" data-tags="true" data-placeholder="Any status" data-multiple="true">
                                                     <option value="">Any Status</option>
                                                    {{--                                                    @foreach ([0 => 'Dalam Proses', 'Disetujui', 'Ditolak'] as $i => $state)--}}
                                                    {{--                                                        <option value="{{ $i }}"{{ in_array($i, request()->query('state', [])) ? ' selected="selected"' : '' }}>{{ humanize($state) }}</option>--}}
                                                    {{--                                                    @endforeach--}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-secondary">Filter</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </li>
                        <li class="mr-3">
                            <a href=""class="btn btn-outline-danger fa fa-file-pdf-o " ></a>
                        </li>
                        <li>
                            <a href=""class="btn btn-outline-success fa fa-file-excel-o " ></a>
                        </li>
                        <li class="dropdown">
                            <div class="btn-group">
                                {{--                                <a href="{{ route('admin.anggota.index', ['state'=>request()->query('state', []), 'export' => 'xlsx']) }}" class="btn btn-icon btn-outline-primary" target="_blank">--}}
                                <em class="icon ni ni-file-xls"></em>
                                </a>
                            </div>
                        </li>


                        </li>


                    </ul>
                </div>
               <div class="table-responsive">
                   <div class="col-12">
                       <table class=" table card-table table-vcenter text-nowrap table-primary" id="customers-table1"style="width: 100%">
                           <thead class="bg-primary text-white">
                           <tr>
                               <th class="text-white">+</th>
                               <th class="text-white">No Sales Order</th>
                               <th class="text-white">Tanggal Order</th>
                               <th class="text-white">Nama Penjual</th>
                               <th class="text-white">Total</th>
                           </tr>
                           </thead>
                       </table>
                   </div>
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
                <th class="text-white" >Kode </th>
                <th class="text-white">Nama Produk</th>
                <th class="text-white">Satuan</th>
                <th class="text-white">Qty</th>
                <th class="text-white">Harga</th>
                <th class="text-white">Diskon %</th>
                <th class="text-white">Pajak</th>
                <th class="text-white">Total</th>
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
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            ajax: '{{ route('detail_penjualan.create') }}',
            columns: [
                {
                    "className":      'details-control',

                    "data":           null,
                    "defaultContent": ''
                },
                { data: 'no_pengiriman', name: 'no_pengiriman' },
                { data: 'tanggal_pengiriman', name: 'tanggal_pengiriman' },
                { data: 'non_anggota', name: 'non_anggota' },
                { data: 'total', name: 'total' },
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
                    { data: 'kode_produk', name: 'kode_produk' },
                    { data: 'nama_produk', name: 'nama_produk'},
                    { data: 'satuan_produk', name: 'satuan_produk'},
                    { data: 'qty', name: 'qty'},
                    { data: 'harga_produk', name: 'harga_produk'},
                    { data: 'total_diskon', name: 'total_diskon'},
                    { data: 'nama_pajak', name: 'nama_pajak'},
                    { data: 'total_amount_all', name: 'total'},

                ]
            })
        }
    </script>
    @endpush
