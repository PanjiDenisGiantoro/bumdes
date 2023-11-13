@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">Kasir</h3>
    <br>
{{--    <x-breadcrumb title="{{ __('Kasir Penjualan') }}">--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('kasir.index') }}">{{ __('Kasir') }}</a>--}}
{{--        </li>--}}
{{--        <li class="breadcrumb-item">--}}
{{--            {{ \Illuminate\Support\Str::headline($pembeli ?? '') }}</a>--}}
{{--        </li>--}}
{{--    </x-breadcrumb>--}}
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 col-lg-8">
        <form class="form-horizontal" method="post" action="{{ route('kasir.store') }}">

            @csrf
{{--            <input hidden type="text" name="no_order" value="CS-{{ str_pad(($last->journal_no ?? 0) + 1, 4, 0, STR_PAD_LEFT) }}">--}}
            <input hidden type="text" name="no_order" value="{{$auto->head??''}}/@if(empty($auto->format_depan))@else{{date($auto->format_depan)}}/@endif @if(empty($auto->format_tengah))@else{{date($auto->format_tengah)}}/@endif @if(empty($auto->format_belakang))@else{{date($auto->format_belakang)}}/@endif{{$count}}">

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Transaksi Penjualan</h2>
                </div>
                <div class="card-body p-0 pr-3">
                    <div class="row">
                        <div class="col-md-6 pl-6 pt-1">
                            <div class="form-group">
                                <div class="row pb-1">
                                    <div class="col-md-4">
                                        <label class="form-label">Tgl. Transaksi</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="date" name="tanggal" class="form-control" value="{{ now()->format('Y-m-d') }}">
                                    </div>
                                </div>

                                <div class="row pb-1">
                                    <div class="col-md-4">
                                        <label class="form-label">Status Pembeli</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="status_anggota" class="form-control" id="status_anggota" required>
                                            <option>Pilih Status</option>
                                            <option value="1">Anggota</option>
                                            <option value="0">Non Anggota</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label">&nbsp;</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="anggota_id_value" class="form-control anggota_id" id="anggota_id">
                                            <option value="">Pilih Anggota</option>
                                        @foreach($anggota as $anggotas)
                                                <option value="{{$anggotas->id}}">{{$anggotas->nama_pemohon}}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" class="form-control" name="anggota_id" id="anggota_non" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-4 text-right bg-light">
                            <h2 id="total">0.00</h2>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-transaksi mb-0">
                        <thead>
                            <th class="col-md-2 no-sort">Kode Produk</th>
                            <th class="col-md-2 no-sort">Nama Produk</th>
                            <th class="col-md-2 no-sort">Qty</th>
                            <th class="col-md-2 no-sort">Diskon</th>
                            <th class="col-md-2 no-sort">Total</th>
                            <th class="col-md-2 text-center no-sort">Hapus</th>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Sub Total</th>
                                <th class="text-right" id="sub-total">0.00</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="4">Diskon (-)</th>
                                <th class="text-right">
                                    <input type="text" name="diskon" class="form-control text-right" id="discount" value="0.00" readonly>
                                </th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="4">Total Pembelian</th>
                                <th class="text-right">
                                    <input type="text" name="total" class="form-control text-right" id="total" value="0.00" readonly>
                                </th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="card-footer text-right">
                    <a
                        href="{{ route('daftar_warung.index') }}"
                        class="btn btn-danger"
                    >
                        {{ __('Kembali') }}
                    </a>
                        <button
                            type="button"
                            class="btn btn-primary"
                            data-toggle="modal"
                            data-target="#paymentModal"
                        >
                            {{ __('Kirim') }}
                        </button>
                </div>
            </div>

            <div class="modal fade zoom" tabindex="-1" id="paymentModal">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pembayaran</h5>
                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                <em class="icon ni ni-cross"></em>
                            </a>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <div class="row pb-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Jenis Pembayaran</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="jenis_pembayaran" class="form-control" required>
                                                <option value="">Pilih Jenis Pembayaran</option>
                                                <option value="1">Tunai</option>
                                                <option value="0">Non Tunai</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row pb-6">
                                        <div class="col-md-4">
                                            <label class="form-label">Nama Akun</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="rekening_id" class="form-control"></select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row pb-3">
                                        <div class="col-md-4">
                                            <label class="form-label font-weight-bold">Total Pembelian</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input
                                                type="text"
                                                id="total"
                                                class="form-control text-right font-weight-bold"
                                                value="0.00"
                                                readonly
                                            >
                                        </div>
                                    </div>

                                    <div class="row pb-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Pembayaran</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input id="pembayaran" name="pembayaran" type="text" class="form-control text-right" value="" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="row pb-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Kembalian</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input id="kembalian" name="kembalian" type="text" class="form-control text-right" value="0.00" readonly>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                {{ __('Bayar') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-4 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Produk</h3>
                <div class="card-options">
                    <div class="input-group">
                        <input
                            id="search"
                            type="text"
                            class="form-control"
                            placeholder="Cari Produk"
                            aria-label="Cari Produk"
                            aria-describedby="button-search">
                        <div class="input-group-append">
                            <button
                                class="btn btn-outline-secondary"
                                type="submit"
                                id="button-search"
                            >
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-produk mb-0">
                    <thead>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th class="no-sort"></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script>
    $('#anggota_non').hide(300);
    $('#status_anggota').on('change',function (){
        if($(this).val() == '0'){
            $('#anggota_non').show(300);
            $('#anggota_id').next(".select2-container").hide(300);

        }else {
            $('#anggota_non').hide(300);
            $('#anggota_id').next(".select2-container").show(300);


        }
    })

    $('.anggota_id').select2({
        minimumInputLength: 1
    });
    let dataSet = [];

function getSum() {
    var arrayOfAmounts = $('.table-transaksi input[name$="total]"]').map(function (i, input) {
        return parseFloat($(input).val());
    }).toArray();

    var subTotal = 0;
    if (arrayOfAmounts.length) {
        var subTotal = arrayOfAmounts.reduce(function (val1, val2) {
            return val1 + val2;
        });
    }

    $('th#sub-total').html(subTotal.toFixed(2));

    var arrayOfDiscounts = $('.table-transaksi input[name$="diskon]"]').map(function (i, input) {
        return parseFloat($(input).val());
    }).toArray();

    var totalDiscount = 0;
    if (arrayOfDiscounts.length) {
        totalDiscount = arrayOfDiscounts.reduce(function (val1, val2) {
            return val1 + val2;
        });
    }

    $('th#discount').html(totalDiscount.toFixed(2));
    $('input#discount').val(totalDiscount.toFixed(2));

    $('th#total').html((subTotal - totalDiscount).toFixed(2));
    $('h2#total').html((subTotal - totalDiscount).toFixed(2));
    $('input#total').val((subTotal - totalDiscount).toFixed(2));
}

$(document).ready(function () {
    var produk = $('.table-produk').DataTable({
        dom: 'lrtip',
        info: false,
        autoWidth: false,
        lengthChange: false,
        searching: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('daftar_produk.index') }}",
        columns: [
            {
                data: "no_barcode"
            },
            {
                data: "nama_produk"
            },
            {
                data: "harga_anggota",
            },
            {
                render: function (data, type, row) {
                    return `<button
                        class="btn add-to-cart"
                        data-produk-id="${row.id}"
                        data-kode-produk="${row.no_barcode}"
                        data-nama-produk="${row.nama_produk}"
                        data-price="${row.harga_anggota}"
                    >
                        <i class="fa fa-plus"></i>
                    </button>`;
                },
            },
        ],
        columnDefs: [
            { targets: 'no-sort', orderable: false },
        ],
    });

    $('input#search').on('keyup', function () {
        produk.search($(this).val()).draw();
    });

    $('body').on('click', 'button.add-to-cart', function (e) {
        e.preventDefault();

        let totalRows = $('.table-transaksi tbody tr').length;

        let item = `<tr
            id="${$(this).data('produk-id')}"
            data-price="${$(this).data('price')}"
        >
            <td>${$(this).data('kode-produk')}</td>
            <td>
                ${$(this).data('nama-produk')}
            </td>
            <td hidden>
             <input
                    class="form-control
                    text-right id_produk"
                    name="items[${totalRows}][id_produk]"
                    type="text"
                    value="${$(this).data('produk-id')}"
                >
            </td>
            <td>
                <input
                    class="form-control
                    text-right qty"
                    name="items[${totalRows}][qty]"
                    type="number"
                    min="1"
                    value="1"
                >
            </td>
            <td>
                <input
                    class="form-control text-right discount"
                    name="items[${totalRows}][diskon]"
                    type="number"
                    min="0"
                    step="0.01"
                    value="0"
                >
            </td>
            <td>
                <input
                    class="form-control text-right amount"
                    name="items[${totalRows}][total]"
                    value="${$(this).data('price') * 1}"
                    readonly
                >
            </td>
            <td class="text-center">
                <button class="btn btn-danger remove-from-cart">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>`;

        if (totalRows == 0) {
            $('.table-transaksi tbody').append(item);
        } else {
            if ($(`.table-transaksi tbody tr#${$(this).data('produk-id')}`).length == 0) {
                $('.table-transaksi tbody').append(item);
            } else {
                var amount   = $(`.table-transaksi tbody tr#${$(this).data('produk-id')} input.amount`);
                var discount = $(`.table-transaksi tbody tr#${$(this).data('produk-id')} input.discount`);
                var qty      = $(`.table-transaksi tbody tr#${$(this).data('produk-id')} input.qty`);

                qty.val(parseInt(qty.val()) + 1);
                amount.val(parseFloat($(this).data('price')) * qty.val());
            }
        }

        getSum();
    });

    $('body').on('change keyup', 'input', function (e) {
        var id    = $(this).parent().parent().attr('id');
        var price = $(this).parent().parent().data('price');

        var amount   = $(`.table-transaksi tbody tr#${id} input.amount`);
        var discount = $(`.table-transaksi tbody tr#${id} input.discount`);
        var qty      = $(`.table-transaksi tbody tr#${id} input.qty`);

        amount.val(parseFloat(price) * qty.val());

        getSum();
    });

    $('body').on('click', 'button.remove-from-cart', function (e) {
        if (confirm('Hapus item ini?')) {
            $(this).parent().parent().remove();

            getSum();
        } else {
            e.preventDefault();
        }
    });

    $('#paymentModal').on('shown.bs.modal', function () {
        $('input#pembayaran').focus();
    });

    $('input#pembayaran').on('change keyup', function () {
        var total = parseFloat($('input#total').val());

        var bayar = parseFloat($(this).val());

        var kembalian = bayar - total;

        $('input#kembalian').val(kembalian.toFixed(2));
    });
});
</script>
@endpush
