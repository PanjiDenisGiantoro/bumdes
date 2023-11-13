@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header"> Pembelian</h3>
    <br>
{{--<br>--}}
{{--<x-breadcrumb title="{{ __('Informasi Pesanan') }}">--}}
{{--    <li class="breadcrumb-item">--}}
{{--        <a href="{{ route('pembelian.setting') }}">{{ __('Setting') }}</a>--}}
{{--    </li>--}}
{{--    <li class="breadcrumb-item">--}}
{{--        {{ __('Index Pesanan') }}--}}
{{--    </li>--}}
{{--</x-breadcrumb>--}}
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card m-b-20">
            <div class="card-header">
                <h3 class="card-title">Tambah Pesanan Pembelian</h3>

            </div>
            <div class="card-body">

                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Tanggal Pesanan</label>
                                <input type="date" class="form-control" name="tanggal_pesanan" id="tanggal_pesanan">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">No Pesanan</label>
                                <input type="text" class="form-control fc-datepicker" id="no_pesanan" placeholder="No Pesanan">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Supplier</label>
                                <select id="supplier" class="form-control" required>
                                    <option value="">-- Pilih Supllier --</option>
                                    @foreach ($supplier as $supp)
                                    <option value="{{ $supp->id }}">{{ $supp->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Id Supplier</label>
                                <input type="text" class="form-control" id="id_supplier" disabled>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Tanggal Penerimaan</label>
                                <input type="date" class="form-control" id="tanggal_penerimaan" name="tanggal_penerimaan">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Termin</label>
                                <select id="inputState" class="form-control" required>
                                    <option value="">-- Pilih Termin --</option>
                                    @foreach ($termin as $ter)
                                    <option value="{{ $ter->id }}">{{ $ter->kode }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Ekpedisi</label>
                                <select id="inputState" class="form-control">
                                    <option value="">-- Pilih Ekpedisi --</option>
                                    @foreach ($ekpedisi as $disi)
                                    <option value="{{ $disi->id }}">{{ $disi->kode }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


        </div>

        <div class="card m-b-20">
            <div class="card-body">
                <div class="form-group col-md-6">
                    <label class="form-label">Separated inputs</label>
                    <div class="row gutters-xs">
                        <div class="col">
                            <select id="produks" class="form-control" required>
                                    <option value="">-- Pilih Produks --</option>
                                    @foreach ($produk as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_produk }}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap table-primary">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-white">No</th>
                                <th class="text-white">Barang</th>
                                <th class="text-white">Kode Barang</th>
                                <th class="text-white">Kuantitas</th>
                                <th class="text-white">Satuan</th>
                                <th class="text-white">Harga</th>
                                <th class="text-white">Diskon</th>
                                <th class="text-white">Pajak</th>
                                <th class="text-white">Total Harga</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <td><input type="text" name="" id="nama_produks" disabled></td>
                                <td><input type="text" name="" id="kode_produks" disabled></td>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                                <td><input type="text" name="" id="harga_juals" disabled></td>
                                <td></td>
                                <td></td>
                                <td><input type="text"></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <form class="form-horizontal mt-5">
                    <div class="form-group ">
                        <div class="row">
                            <div class="col-md-8">
                                <label style="padding-left:800px; padding-top:5px;" class="form-label" id="examplenameInputname2">Subtotal</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="examplenameInputname3" placeholder="Subtotal">
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row">
                            <div class="col-md-8">
                                <label style="padding-left:800px; padding-top:5px;" class="form-label" id="examplenameInputname2">Pajak</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="examplenameInputname3" placeholder="Pajak">
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row">
                            <div class="col-md-8">
                                <label style="padding-left:800px; padding-top:5px;" class="form-label" id="examplenameInputname2">Diskon</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="examplenameInputname3" placeholder="Diskon">
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row">
                            <div class="col-md-8">
                                <label style="padding-left:800px; padding-top:5px;" class="form-label" id="examplenameInputname2">Total</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="examplenameInputname3" placeholder="Total">
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row">
                            <div class="col-md-8">
                                <label style="padding-left:800px; padding-top:5px;" class="form-label" id="examplenameInputname2">Termasuk Pajak</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="examplenameInputname3" placeholder="Termasuk Pajak">
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row">
                            <div class="col-md-8">
                                <label style="padding-left:800px; padding-top:5px;" class="form-label" id="examplenameInputname2">Jumlah Tagihan</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="examplenameInputname3" placeholder="Jumlah Tagihan">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-0 row justify-content-end">
                        <div class=" pull-right">
                            <button type="submit" class="btn btn-danger">Batal</button>
                            <button type="submit" class="btn btn-primary">Hantar</button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- <div class="card-body">

            </div> --}}

        </div>

    </div>
</div>

@endsection
@push('scripts')
<script>
    $(document).ready(function() {

        $('#supplier').select2({
            //minimumInputLength: 3
        }).change(function() {

            $('#id_supplier').val('').change();

            var countryID = $(this).val();
            var idas = 1;
            if (countryID) {
                $.ajax({
                    type: "GET"
                    , url: "{{ route('pembelian.pesanan.getdata') }}?country_id=" + countryID
                    , success: function(res) {
                        if (res) {
                            console.log(res)
                            let noNama = res.nama;
                            let noIdSupplier = res.id_supplier;

                            $('#id_supplier').val(noIdSupplier);
                        }
                    }
                });
            }
        });

        $('#produks').select2({
            //minimumInputLength: 3
        }).change(function() {

            $('#nama_produks').val('').change();
            $('#kode_produks').val('').change();
            $('#harga_juals').val('').change();

            var countryID = $(this).val();
            var idas = 1;
            if (countryID) {
                $.ajax({
                    type: "GET"
                    , url: "{{ route('pembelian.pesanan.getdataproduk')  }}?country_id=" + countryID
                    , success: function(res) {
                        if (res) {
                            console.log(res)
                            let noNamaProduk = res.nama_produk;
                            let KodeProduk = res.kode_produk;
                            let HargaJual = res.harga_jual

                            $('#nama_produks').val(noNamaProduk);
                            $('#kode_produks').val(KodeProduk);
                            $('#harga_juals').val(HargaJual);
                        }
                    }
                });
            }
        });

    });

</script>
@endpush
