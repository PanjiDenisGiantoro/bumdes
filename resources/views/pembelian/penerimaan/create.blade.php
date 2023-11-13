@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header"> Pembelian</h3>
    <br>
{{--<br>--}}
{{--<x-breadcrumb title="{{ __('Penerimaan Pembelian') }}">--}}
{{--    <li class="breadcrumb-item">--}}
{{--        <a href="{{ route('pembelian.penerimaan.index') }}">{{ __('Penerimaan') }}</a>--}}
{{--    </li>--}}
{{--    <li class="breadcrumb-item">--}}
{{--        {{ __('Penerimaan Pembelian') }}--}}
{{--    </li>--}}
{{--</x-breadcrumb>--}}
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <form action="{{ route('pembelian.penerimaan.store') }}" method="POST">
        @csrf
            <div class="card m-b-20">
                <div class="card-header">
                    <h3 class="card-title">Informasi Penerimaan Pembelian</h3>

                </div>
                <div class="card-body">

                    <input type="text" name="pesananpembelian_id" id="pesananpembelian_id" hidden>
                    <input type="text" name="pesanan_pembelianbody_id" id="pesanan_pembelianbody_id" hidden>
                    <input type="text" name="termin_pembayaran" id="termin_pembayaran" hidden>


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">No Pesanan</label>
                                <select id="no_pesanan" class="form-control">
                                    <option value="">-- Pilih No Pesanan --</option>
                                    @foreach ($pesanan as $pes)
                                    <option value="{{ $pes->id }}">{{ $pes->no_pesanan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Tanggal Pesanan</label>
                                <input type="text" class="form-control" id="tanggal_pesanan" placeholder="First Name" disabled>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Supplier</label>
                                <input type="text" name="supplier" id="supplier" class="form-control" placeholder="Supplier" readonly>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Id Supplier</label>
                                <input type="text" class="form-control" id="id_supplier" placeholder="Id Supplier" disabled>
                            </div>
                        </div>
                        {{-- <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Tanggal Penerimaan</label>
                                <input type="text" class="form-control" id="tanggal_penerimaan" placeholder="Tanggal Pesanan" disabled>
                            </div>
                        </div> --}}
                        {{-- <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Tanggal Penerimaan</label>
                                <input type="text" class="form-control" id="tanggal_penerimaan" placeholder="Tanggal Pesanan" disabled>
                            </div>
                        </div> --}}
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Termin</label>
                                <input type="text" name="termin_pembayaran" id="termin" class="form-control" placeholder="Termin" disabled>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Ekpedisi</label>
                                <input type="text" name="" id="ekpedisi" class="form-control" placeholder="Ekpedisi" disabled>
                            </div>
                        </div>
                        {{-- <div class="form-group col-md-6">
                        </div> --}}
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Tanggal Penerimaan</label>
                                <input type="date" name="tanggal_penerimaan" class="form-control" placeholder=""required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">No invoice</label>
                                <input type="text" name="no_invoice"
                                       value="{{$auto->head??''}}/@if(empty($auto->format_depan))@else{{date($auto->format_depan)}}/@endif @if(empty($auto->format_tengah))@else{{date($auto->format_tengah)}}/@endif @if(empty($auto->format_belakang))@else{{date($auto->format_belakang)}}/@endif{{$count}}"
                                       class="form-control" id="no_invoice" placeholder="" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Status</label>
                                <select id="inputState" name="status" class="form-control"required>
                                    <option value="0">-- Status --</option>
                                    <option value="Terima">Terima</option>
                                    <option value="Sebagian">Sebagian</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">No Surat Jalan</label>
                                <input type="text" name="no_surat_jalan" class="form-control" id="name2" placeholder="" required>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div class="card m-b-20">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap table-primary" id="table">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="text-white" width="180">Barang</th>
                                    <th class="text-white"width="120">Kode Barang</th>
                                    <th class="text-white">Kuantitas</th>
                                    <th class="text-white"width="100">Satuan</th>
                                    <th class="text-white"width="190">Harga</th>
                                    <th class="text-white"width="100">Diskon</th>
                                    <th class="text-white"width="140">Pajak</th>
                                    <th class="text-white">Total Harga</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="addMoreProduct">

                            </tbody>
                        </table>
                    </div> <br>

                    {{-- <a class="btn btn-primary text-white" id="add_btn">Tambah Barang</a> --}}

                    <div class="form-horizontal " id="moreTwo">
                        <div class="form-group " id="diskon_group">
                            <div class="row">
                                <div class="col-md-9">
                                    <label style="float: right" class="form-label" id="examplenameInputname2">Sub Total</label>
                                </div>
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="subtotal_produk" readonly class="form-control total_subtotal_text" style="border: 0;font-size: 14px;font-weight: bold;text-align: right" id="total_subtotal_text" hidden>
                                    {{-- <input  type="text"--}}
                                    {{-- readonly  class="form-control total_subtotal_text1" style="border: 0;font-size: 14px;font-weight: bold;text-align: right" id="total_subtotal_text1">--}}
                                    <b class="total_subtotal_text1 bg-white " style="font-size: 14px;font-weight: bold;text-align: right;float: right">0</b>
                                </div>
                                <div class="row justify-content-end">
                                    {{-- <h5><b class=>900</b></h5> --}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group " id="diskon_group">
                            <div class="row">
                                <div class="col-md-9">
                                    <label style="float: right" class="form-label" id="examplenameInputname2">Diskon Per Item</label>
                                </div>
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="diskon_per_item" id="diskon_per_item" hidden readonly class="form-control diskon_per_item" style="border: 0;font-size: 14px;font-weight: bold;text-align: right">
                                    <b class="diskon_per_item1 bg-white" style="font-size: 14px;font-weight: bold;text-align: right;float: right">0</b>
                                </div>
                                <div class="row justify-content-end">
                                    {{-- <h5><b class=>900</b></h5> --}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group " id="diskon_group">
                            <div class="row">
                                <div class="col-md-9">
{{--                                    <label style="float: right" class="form-label" id="examplenameInputname2">Diskon</label>--}}
                                    <label class="switch" style="float: right">
                                        <input style="float: right" type="checkbox" data-size="sm" id="diskon2" name="diskon2" data-toggle="toggle" data-on="Diskon %" data-off="Diskon RP" data-onstyle="success" data-offstyle="dark" checked>
                                        {{-- <span class="slider round" for="diskon2"--}}
                                        {{-- ></span>--}}
                                    </label>
                                    <input type="text" id="diskonvalue" name="tipediskon" hidden>

                                </div>
                                <div class="col-md-1">
                                    <input type="number" name="diskontotalrupiah" id="diskontotal" class="form-control">
                                    <input type="number" name="diskontotal" id="diskontotalpersen" class="form-control diskontotalpersen">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" readonly id="diskontotalpersen1" class="form-control" style="border: 0;font-size: 14px;font-weight: bold;text-align: right;" hidden>
                                    <div class="" style="margin-left: 50px">
                                        {{-- <input type="number" readonly id="diskontotalpersen1_value" class="form-control" style="border: 0;font-size: 14px;font-weight: bold;">--}}
                                        <b class="diskontotalpersen1_value bg-white" style="font-size: 14px;font-weight: bold;text-align: right;float: right">0</b>
                                    </div>
                                    <input type="number" readonly id="diskontotal1" class="form-control" style="border: 0;font-size: 14px;font-weight: bold;text-align: right">
                                </div>
                                <div class="row justify-content-end">
                                    {{-- <h5><b class=>900</b></h5> --}}
                                </div>
                            </div>
                        </div>
                        <input type="text" id="subtotal" name="subtotal" hidden>


                        <div class="form-group " id="diskon_group">
                            <div class="row">
                                <div class="col-md-9">
                                    <label style="float: right" class="form-label" id="examplenameInputname2">PPN</label>
                                </div>
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="ppn" id="ppn"  readonly class="form-control" style="border: 0;font-size: 14px;font-weight: bold;text-align: right" hidden>
                                    {{-- <b class="ppn_value bg-white"  style="font-size: 14px;font-weight: bold;text-align: right;float: right">0</b>--}}
                                    <span class="ppn_value bg-white" style="font-size: 14px;font-weight: bold;text-align: right;float: right"></span>
                                </div>
                                <div class="row justify-content-end">
                                    {{-- <h5><b class=>900</b></h5> --}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group " id="diskon_group">
                            <div class="row">
                                <div class="col-md-9">
                                    <label style="float: right" class="form-label" id="examplenameInputname2">PPH</label>
                                </div>
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-2" style="float: right">
                                    <input type="number" name="pph" id="pph"  readonly class="form-control" style="border: 0;font-size: 14px;font-weight: bold;text-align: right"hidden>
                                    <span class="pph_value bg-white" style="font-size: 14px;font-weight: bold;float: right;">(0)</span>
                                </div>
                                <div class="row justify-content-end">
                                    {{-- <h5><b class=>900</b></h5> --}}
                                </div>
                            </div>
                        </div>


                        <div class="form-group " id="diskon_group">
                            <div class="row">
                                <div class="col-md-9">
                                    <label style="float: right" class="form-label" id="examplenameInputname2">Biaya Pengiriman</label>
                                </div>
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-2">
                                    {{-- <input  type="text" name="biaya_pengiriman" id="paid_amount"--}}
                                    {{-- class="form-control" style="border: 0;font-size: 14px;font-weight: bold;text-align: right">--}}
                                    <input height="30" type="text" class="form-control" id="paid_amount_value" name="biaya_pengiriman" style="font-size: 14px;text-align: right;border: 0;margin-left: 10px" readonly >
                                </div>
                                <div class="row justify-content-end">
                                    {{-- <h5><b class=>900</b></h5> --}}
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="form-group ">
                        <div class="row">
                            <div class="col-md-9">
                                <label style="float: right" class="form-label" id="examplenameInputname2">Jumlah Tagihan</label>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-2 ">
                                <b  class="total"hidden></b>
                                <input type="number" name="total_balance" id="balance" readonly  class="form-control" hidden>
                                <input  type="number" id="totalgrand" readonly class="form-control"hidden>
                                <input  type="text" class="total1 form-control" name="total" id="total" readonly style="border: 0;font-size: 14px;font-weight: bold;text-align: right"hidden>
                                <span class="total1_value bg-white" style="font-size: 14px;font-weight: bold;text-align: right;float: right">0</span>
                                <br>
                                <br>
                                <input type="text" name="jumlah_tagihan"  class="total1_back" hidden>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-0 row justify-content-end">
                        <div class=" pull-right">
                            <a href="{{ route('pemesanan_penjualan.index') }}" class="btn btn-danger">Batal</a>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </div>

                </div>

                {{-- <div class="card-body">

            </div> --}}

            </div>
        </form>
    </div>
</div>

@endsection
@push('css')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script>
    $('#no_pesanan').select2({
        minimumInputLength: 1
    }).change(function() {

        $('#tanggal_pesanan').val('').change();
        $('#supplier').val('').change();
        $('#id_supplier').val('').change();
        $('#tanggal_penerimaan').val('').change();
        $('#termin').val('').change();
        $('#ekpedisi').val('').change();

        var countryID = $(this).val();
        var idas = 1;
        if (countryID) {
            $.ajax({
                type: "GET"
                , url: "{{ route('pembelian.penerimaan.getdatapesananbody') }}?country_id=" + countryID
                , success: function(res) {
                    if (res) {
                        //console.log(res)
                        //let noNama = res.nama;
                        let pesananPembelianid = res[0].pesanan.id
                        let tanggalPesanan = res[0].pesanan.tanggal_pesanan;
                        let supplier = res[0].pesanan.supplier.nama;
                        let noIdSupplier = res[0].pesanan.id_supplier;
                        let penerimaan = res[0].tanggal_penerimaan;
                        let termin = res[0].pesanan.termin.nama_termin_penjualan
                        let terminid = res[0].pesanan.termin.id
                        let ekpedisi = res[0].pesanan.ekpedisi.nama_ekspedisi_penjualan
                        let tanggalPenerimaan = res[0].pesanan.tanggal_penerimaan

                        $('#pesananpembelian_id').val(pesananPembelianid)
                        $('#id_supplier').val(noIdSupplier);
                        $('#tanggal_pesanan').val(tanggalPesanan);
                        $('#supplier').val(supplier);
                        $('#tanggal_penerimaan').val(penerimaan);
                        $('#termin').val(termin);
                        $('#termin_pembayaran').val(terminid);
                        $('#ekpedisi').val(ekpedisi);
                        $('#tanggal_penerimaan').val(tanggalPenerimaan)

                        $.each(res, function(i) {
                            console.log(res)

                            let pesananPembelianBodyid = res[i].id
                            let produk_id = res[i].produk.id
                            let namaProduk = res[i].produk.nama_produk
                            let kodeProduk = res[i].produk.kode_produk
                            let kuantitas = res[i].kuantitas
                            let hargaJual = res[i].harga_produk
                            let diskonProduk = res[i].diskon;


                            let diskonSeluruh = res[i].diskon_seluruh;
                            let diskonSeluruhpersen = res[i].diskon_seluruhpersen;
                            let diskonPerItem = res[i].diskon_per_item
                            let pajakType = res[i].pajaktype;
                            let totalPPN = res[i].total_ppn - 0;
                            let totalPPH = res[i].total_pph - 0;
                            let pajakPPN = res[i].ppn - 0;
                            let pajakPPH = res[i].pph - 0;
                            let pajakSeluruh = res[i].pajak_seluruh;
                            let total_amount = res[i].total;
                            let biaya_pengiriman = res[i].biaya_pengiriman - 0;
                            let subtotal = res[i].subtotal
                            let totalProduk = res[i].total;
                            let totalSeluruh = res[i].total_seluruh;
                            let totalTertagih = res[i].total_tertagih;
                            let satuan = res[i].produk.satuan.satuan_produk;
                            let diskonCalculate = res[i].diskon_calculate;
                            let totalDisk = res[i].total_disk;
                            console.log(diskonCalculate)
                            let totalAmountAll = res[i].total_amount_all;

                            $('.total_subtotal_text').val(subtotal)
                            var fsubtotal = new Intl.NumberFormat().format(subtotal);
                            $('.total_subtotal_text1').html(fsubtotal)

                            $('.diskon_per_item').val(diskonPerItem)
                            var fdiskonPerItem = new Intl.NumberFormat().format(diskonPerItem);
                            $('.diskon_per_item1').html(fdiskonPerItem)

                            $('.diskontotalpersen').val(diskonSeluruh)

                            $('#paid_amount').val(biaya_pengiriman)
                            var fbiaya_pengiriman = new Intl.NumberFormat().format(biaya_pengiriman);
                            $('#paid_amount_value').val(biaya_pengiriman)

                            $('#ppn').val(pajakPPN)
                            var fpajakPPN = new Intl.NumberFormat().format(pajakPPN);
                            $('.ppn_value').html(fpajakPPN)

                            $('#pph').val(pajakPPH)
                            var fpajakPPH = new Intl.NumberFormat().format(pajakPPH);
                            $('.pph_value').html(fpajakPPH)

                            var ftotalTertagih = new Intl.NumberFormat().format(totalTertagih);
                            $('.total1_value').html(ftotalTertagih)

                            $('#diskontotalpersen1').val(diskonCalculate)

                            var fdiskonCalculate = new Intl.NumberFormat().format(diskonCalculate);
                            $('.diskontotalpersen1_value').html(fdiskonCalculate)

                            $('.total1_back').val(totalTertagih)
                            {{-- var ftotalTertagih = new Intl.NumberFormat().format(totalTertagih);
                            $('.total1_back').val(ftotalTertagih) --}}


                           let product = @php echo json_encode($produk_get); @endphp;
                                let myOptions = '';
                                product.forEach(value => {
                                    myOptions += `<option value="${value.id}" data-harga="${value.harga_beli}" data-produk="${value.kode_produk}"data-satuan="${value.satuan_produk}"`;
                                    if (value.id == res[i].produk.id) myOptions += `selected`;
                                    myOptions +=`>${value.nama_produk}</option>;`
                                });

                            var pajak1 = '<option></option>  @foreach ($pajak as $p)<option value="{{$p->id}}"data-values="{{$p->tarif_persentase}}"data-pajak="{{$p->pemotongan}}">{{$p->nama_pajak}}</option>@endforeach';

                                let pajak = @php echo json_encode($pajak);  @endphp;
                                console.log(pajak)
                                let mypajak = '';
                                pajak.forEach(value => {
                                    mypajak += `<option value="${value.id}" data-values="${value.tarif_persentase}" data-pajak="${value.pemotongan}"data-satuan="${value.satuan_produk}"`;
                                    if (value.id == pajakType ) mypajak += `selected`;
                                    mypajak +=`>${value.nama_pajak}</option>;`
                                })

                            $('#pesanan_pembelianbody_id').val(pesananPembelianBodyid)

                            var tr = $('<tr/>');
                            // tr.append('<td><select id="" class="form-control produk_id" name=produk_id'+produk_id+'>'+ myOptions +'</select>');
                            // tr.append("</td>");
                            tr.append('<td><select class="form-control produk_id" name="produk_id[]" style="font-size: 13px;"readonly>' + myOptions + '</select>');
                                tr.append("</td>");
                            tr.append('<td><input readonly type="text" name="kode_produk[]" id="kode_produk" value=' + kodeProduk + ' class="form-control kode_produk">');
                            tr.append("</td>");
                            tr.append('<td width="60"><input  type="number" name="kuantitas[]" id="kuantitas" value=' + kuantitas + ' class="form-control qty">');
                            tr.append("</td>");
                            tr.append('<td><input readonly type="text" name="satuan[]" id="satuan" value=' + satuan + ' class="form-control satuan">');
                            tr.append("</td>");
                            tr.append('<td><input  type="text" name="harga_produk[]" id="harga" value=' + hargaJual + ' class="form-control harga">');
                            tr.append("</td>");
                            tr.append('<td width="55"><input readonly type="text" name="diskon[]" id="diskon" value=' + diskonProduk + ' class="form-control diskon">');
                            tr.append("</td>");
                            tr.append('<td width="100"><select class="form-control pajak" name="pajak[]"style="font-size: 13px;" readonly>' + mypajak + '</select>');
                            tr.append("</td>");

                            tr.append('<td hidden><input readonly type="text" name="total_pajak[]"style="font-size: 13px;" id="total_pajak" value='+totalPPN+' class="form-control total_pajak">');
                            tr.append("</td>");
                            tr.append('<td hidden><input readonly type="text" name="total_pajak_pph[]" id="total_pajak_pph"style="font-size: 13px;" value='+totalPPH+' class="form-control total_pajak_pph">');
                            tr.append("</td>");
                            tr.append('<td><input readonly type="text" name="total_amount[]" id="total_amount" value=' + totalProduk + ' class="form-control total_amount">');
                            tr.append("</td>");
                            tr.append('<td hidden><input readonly type="text" name="pajaktype[]" id="pajaktype" style="font-size: 13px;" value='+pajakType+' class="form-control pajaktype">');
                            tr.append("</td>");
                            tr.append('<td hidden><input readonly type="text" name="total_amount_all[]" id="total_amount_all" value='+totalAmountAll+' class="form-control total_amount_all">');
                            tr.append("</td>");
                            tr.append('<td hidden><input readonly type="text" name="diskongrand[]" id="diskongrand" value='+hargaJual+' class="form-control diskongrand">');
                            tr.append("</td>");
                            tr.append('<td hidden><input readonly type="text" name="total_sub[]"style="font-size: 13px;"  id="total_sub" value='+total_amount+' class="form-control total_sub">');
                            tr.append("</td>");
                            tr.append('<td hidden><input readonly type="text" name="total_disk[]"style="font-size: 13px;" id="total_disk" value='+totalDisk+' class="form-control total_disk">');
                            tr.append("</td>");
                            tr.append('<td> <a href="#" class="btn btn-sm btn-danger rounded-circle delete"><i class="fa fa-trash"></i></a>');
                            tr.append("</td>");
                            $("#table").append(tr);
                        })

                    }


                }
            });
        }
    });


    $('#table').delegate('.delete', 'click', function() {
        $(this).parent().parent().remove();
        TotalSub();
        TotalDiskon();
    });

    $('#table').delegate('.delete', 'click', function() {
        $(this).parent().parent().remove();
    });


    function TotalAmount() {
        var total = 0;
        $('.total_amount').each(function(i, e) {
            var amount = $(this).val() - 0;
            total += amount;
        });
        $('.total').html(total);
        var tot1 = new Intl.NumberFormat().format(total);
        $('.total1_value').html(tot1);
        $('#total').val(total);
        $('total1').html(total);
        $('#subtotal').val(total);
    }

    function TotalSub() {
        var total = 0;
        var test_value = 0;
        var tot = 0;
        $('.total_sub').each(function(i, e) {
            var amount = $(this).val() - 0;
            total += amount;
        });
        $('.total_subtotal_text').val(total);
        console.log(total)
        var tot = new Intl.NumberFormat().format(total);
        $('.total_subtotal_text1').html(tot);

        // $('#subtotal').val(total);
    }

    function TotalDiskon() {
            var total = 0;
            var tot = 0;
            $('.total_disk').each(function(i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            });
            $('#diskon_per_item').val(total);

            var tot = new Intl.NumberFormat().format(total);
            $('.diskon_per_item1').html(tot);
        }

    function totalpajakpphandppn() {
            var total = 0;
            var diskon = 0;
            var totaldiskon = 0;
            var totalreal = 0;
            var totalall = 0;

            var tot = 0;
            $('.total_amount').each(function(i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            });
            var totaldiskon = $('#diskontotalpersen').val();
            var diskon = parseFloat(totaldiskon);
            var totalreal = parseFloat(total);
            var totalall = totalreal / diskon;
            $('#diskontotalpersen1').val(totalall);

            var tot = new Intl.NumberFormat().format(totalall);
            var tot2 = totalall
            $('.diskontotalpersen1_value').html(tot);
            $('.diskontotalpersen2_value').val(tot2);
            console.log(tot2)
        }

        function TotalPajakpph() {
            var total = 0;
            var tot1 = 0;
            var tot = 0;
            $('.total_pajak_pph').each(function (i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            });
            if ( $('#diskontotalpersen').val() == ''){
                $('#pph').val(total);
                var tot = new Intl.NumberFormat().format(total);
                $('.pph_value').html(tot);
            }else{
                var totaldiskon = $('#diskontotalpersen').val();
                var totaldiskonvalue = $('#diskontotalpersen1').val();
                var diskon = parseFloat(totaldiskon);
                var value = parseFloat(totaldiskonvalue);
                var totalreal = parseFloat(total);

                var grand = totalreal - ((totalreal * diskon )/100);
                $('#pph').val(grand);
                var tot1 = new Intl.NumberFormat().format(grand);
                // if (isNaN(tot1)){
                //
                // }
                $('.pph_value').html(tot1);

            }
        }

        function TotalPajak() {
            var total = 0;
            var totaldiskon = 0;
            var totaldiskonvalue = 0;
            var diskon = 0;
            var totalreal = 0;
            var grand = 0;
            var tot = 0;
            var tot1 = 0;
            var grand = 0;
            $('.total_pajak').each(function (i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            });

            if ($('#diskontotalpersen').val() == ''){
                $('#ppn').val(total);
                console.log(total)
                var tot = new Intl.NumberFormat().format(total);

                $('.ppn_value').html(tot);
            }else{
                console.log(total)

                var totaldiskon = $('#diskontotalpersen').val();
                var totaldiskonvalue = $('#diskontotalpersen1').val();
                var diskon = parseFloat(totaldiskon);
                var value = parseFloat(totaldiskonvalue);
                var totalreal = parseFloat(total);

                var grand = totalreal - ((totalreal * diskon )/100);
                console.log(grand)
                $('#ppn').val(grand);
                var tot1 = new Intl.NumberFormat().format(grand);
                $('.ppn_value').html(tot1);

            }
        }

        function EndAmount() {
            var total = 0;
            var tot1 = 0;
            $('.total_amount_all').each(function (i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            });
            $('.total').html(total);
            $('.total1').val(total);
            $('#balance').val(total);
            var tot1 = new Intl.NumberFormat().format(total);
            $('.total1_value').html(tot1);
            $('.total1_back').val(total);
            $('.totalgrand').val(total);
            $('#subtotal').val(total);
        }

        $('.addMoreProduct').delegate('.produk_id', 'change', function () {
                            var tr = $(this).parent().parent();
                            var price = tr.find('.produk_id option:selected').attr('data-harga');
                            var produk = tr.find('.produk_id option:selected').attr('data-produk');
                            var satuan = tr.find('.produk_id option:selected').attr('data-satuan');
                            // var pajak = tr.find('.pajak option:selected').val(10);
                            // tr.find('.pajak').val(pajak);
                            tr.find('.harga').val(price);
                            tr.find('.kode_produk').val(produk);
                            tr.find('.satuan').val(satuan);
                            var quan = tr.find('.qty').val() - 0;
                            var disc = tr.find('.diskon').val() - 0;
                            var price = tr.find('.harga').val() - 0;
                            var pajak = tr.find('.pajak option:selected').attr('data-values')- 0;
                            var biaya = $('#paid_amount').val() - 0;

                            var total_amount = biaya + ((quan * price) - (((quan * price * disc) / 100)));
                            tr.find('.total_amount').val(total_amount);
                            TotalAmount();
                        });
    $('.addMoreProduct').delegate('.qty, .diskon,.diskongrand, .pajak ,.harga', 'keyup change', function () {
            // var pajak = 0;
            // $('#diskontotalpersen').val('') ;
            // $('#diskontotalpersen1').val('') ;
            // $('#diskontotal1').val('') ;
            // $('#diskontotal').val('') ;

            var tr = $(this).parent().parent();
            var pajaktype = tr.find('.pajak option:selected').attr('data-pajak');
            var qty = tr.find('.qty').val() - 0;
            var disc = tr.find('.diskon').val() - 0;
            var price = tr.find('.harga').val() - 0;
            var pajak = tr.find('.pajak option:selected').attr('data-values')-0;
            var diskongrand = $('#diskontotalpersen').val() - 0;
            var biaya = $('#paid_amount').val() - 0;

            //console.log(diskongrand)
            // var total_amount =biaya +  ((qty * price) - (((qty * price * disc) / 100) + ((qty * price * pajak) / 100)));
            // var total_amount_all =biaya +  ((qty * price) - ((qty * price * disc) / 100) + (pajak * ((qty * price) - ((qty * price * pajak) / 100)) / 100));
            var total_amount =((qty * price) - ((qty * price * disc) / 100));
            var diskontotal = ((qty * price * disc) / 100);
            var total_subtotal = (qty * price);
            console.log(total_subtotal)
            var totalproduk = ((pajak * ((qty * price) - ((qty * price * disc) / 100)) / 100));

            if (pajaktype == '1') {
                tr.find('.total_pajak').val(totalproduk);
                tr.find('.total_pajak_pph').val(0);
                var total_amount_all =(biaya +  ((qty * price) - ((qty * price * disc) / 100) + (pajak * ((qty * price) - ((qty * price * pajak) / 100)) / 100)));
                // var total_amount_all = (biaya + ((qty * price) - ((qty * price * disc) / 100) + ((pajak * ((qty * price) - ((qty * price * disc) / 100)) / 100) - (diskongrand*(pajak * price) - (qty * price * disc)/100))/100)) ;
            } else {
                tr.find('.total_pajak_pph').val(totalproduk);
                tr.find('.total_pajak').val(0);
                var total_amount_all = biaya + ((qty * price) - ((qty * price * disc) / 100) - (pajak * ((qty * price) - ((qty * price * disc) / 100)) / 100)) ;
            }
            tr.find('.total_amount_all').val(total_amount_all);
            tr.find('.total_amount').val(total_amount);
            tr.find('.total_disk').val(diskontotal);
            tr.find('.total_sub').val(total_subtotal);
            TotalSub();
            TotalAmount();
            TotalDiskon();
            TotalPajak();
            totalpajakpphandppn();
        });

   $('.addMoreProduct').delegate('.qty, .diskon', 'keyup', function() {
           var tr = $(this).parent().parent();
            var qty = tr.find('.qty').val() - 0;
            var disc = tr.find('.diskon').val() - 0;
            var price = tr.find('.harga').val() - 0;
            // var total_amount = (qty * price) - ((qty * price * disc) / 100) ;
            // var total_amountt = total_amount  + (( total_amount * pajak )/ 100) ;
            var total_amount = (qty * price) - ((qty * price * disc) / 100);
            tr.find('.total_amount').val(total_amount);
            TotalAmount();
            $('#totall').hide();
        });

    $('.addMoreProduct').delegate('.qty,.diskon,.diskongrand,.pajak,.harga,#paid_amount_value', 'keyup change', function() {
            {{-- $('#diskontotalpersen').val('');
            $('#diskontotalpersen1').val('');
            $('#diskontotal1').val('');
            $('#diskontotal').val(''); --}}


            var tr = $(this).parent().parent();
            var pajaktype = tr.find('.pajak option:selected').attr('data-pajak');
            var qty = tr.find('.qty').val() - 0;
            var disc = tr.find('.diskon').val() - 0;
            var price = tr.find('.harga').val() - 0;
            //var pajak = tr.find('.pajak option:selected').val() - 0;
            var pajak = tr.find('.pajak option:selected').attr('data-values')-0;



            var totalamount = tr.find('.total_amount').val() - 0;
            var diskontotalpersen = $('#diskontotalpersen').val() - 0;
            var biaya = $('#paid_amount').val() - 0;
            var totalproduk = (pajak * ((qty * price) - ((qty * price * disc) / 100)) / 100);
            var total_amount = ((qty * price) - ((qty * price * disc) / 100));
            var diskontotal = ((qty * price * disc) / 100);
            var total_subtotal = (qty * price);
                            //console.log(diskontotal)

            if (pajaktype == '1') {
                tr.find('.total_pajak').val(totalproduk);
                tr.find('.total_pajak_pph').val(0);
                // var total_amount_all =(biaya +  ((qty * price) - ((qty * price * disc) / 100) + (pajak * ((qty * price) - ((qty * price * pajak) / 100)) / 100)));
                var total_amount_all = (biaya + ((qty * price) - ((qty * price * disc) / 100) + (pajak * ((qty * price) - ((qty * price * disc) / 100)) / 100)));
            } else {
                tr.find('.total_pajak_pph').val(totalproduk);
                tr.find('.total_pajak').val(0);
                var total_amount_all = (biaya + ((qty * price) - ((qty * price * disc) / 100) - (pajak * ((qty * price) - ((qty * price * disc) / 100)) / 100)));
            }
            tr.find('.total_amount_all').val(total_amount_all);
            tr.find('.total_amount').val(total_amount);
            tr.find('.total_disk').val(diskontotal);
            tr.find('.total_sub').val(total_subtotal);

            TotalSub();
            TotalAmount();
            TotalDiskon();
            TotalPajak();
            TotalPajakpph();
            totalpajakpphandppn();
        });

    $('#paid_amount').val(0);
        $('#diskontotalpersen1').val(0);

        $('#paid_amount_value').keyup(function() {
            if ($(this).val() == '') {
                $(this).val(0);
            }
            var total = $('#balance').val();
            var conver = parseFloat(total);
            var paid_amount = parseFloat($('#paid_amount').val());
            //console.log(conver)
            //console.log(paid_amount)
            var tot = conver + paid_amount;
            // $('#balance').val(tot);
            $('.total1').val(tot);
            $('.total').val(tot);
            var tot1 = new Intl.NumberFormat().format(tot);
            $('.total1_value').html(tot1);
            $('.total1_back').val(tot);
        })


        $('#diskontotal1').hide();
        $('#diskontotal').hide();
        $('#diskonvalue').val('1');
        $('#diskon2').on('change', function() {

            if ($(this).prop("checked") == true) {
                $('#diskontotalpersen').val('');
                $('#diskontotalpersen1').val('');
                $('#diskontotal1').val('');
                $('#diskontotal').val('');
                $('#diskonvalue').val('1');
                $('#diskon2label').html(" % ");
                $('#diskontotal').hide();
                $('#diskontotal1').hide();
                $('#diskontotalpersen').show();
                $('#diskontotalpersen1').show();
                $('#diskontotalpersen1_value').show();
                $('#diskontotalpersen2_value').show();


            } else if ($(this).prop("checked") == false) {
                $('#diskontotalpersen').val('');
                $('#diskontotalpersen1').val('');
                $('#diskontotal1').val('');
                $('#diskontotal').val('');
                $('#diskonvalue').val('0');
                $('#diskon2label').html("RP");
                $('#diskontotal').show();
                $('#diskontotal1').show();
                $('#diskontotalpersen').hide();
                $('#diskontotalpersen1').hide();
                //$('#diskontotalpersen1_value').hide();
                //$('#diskontotalpersen2_value').hide();
            }
        });

        // $('#diskontotalpersen').on('keyup',function(){
        //     test_value = $(this).val();
        //     $('.diskongrand').val(test_value)
        // })
        $('#diskontotalpersen').val(0);
        //$('.diskontotalpersen1_value').hide();
        //$('.diskontotalpersen2_value').hide();

        $('#diskontotalpersen').keyup(function() {
            $('.diskontotalpersen1_value').show();
            $('.diskontotalpersen2_value').show();

            var total = $('.total1_back').val();
            var conver = parseFloat(total);
            var paid_amount = $('#paid_amount').val();
            var conver1 = parseFloat(paid_amount);

            var paid_amount1 = $(this).val();
            var tot = conver - ((conver * paid_amount1) / 100);
            var dis = ((conver * paid_amount1) / 100);
            $('#balance').val(tot);
            // $('#balance').val(tot);
            $('.total1').val(tot);
            var tot1 = new Intl.NumberFormat().format(tot);
            $('.total1_value').html(tot1);

            // $('#diskontotalpersen1').val(dis);
            totalpajakpphandppn();
            TotalPajak();
            TotalPajakpph();

        })

        $('#diskontotal').on( 'keyup change' ,function () {

           //$('.diskontotalpersen1_value').hide();
            //$('.diskontotalpersen2_value').hide();
            var total = $('.total1_back').val();
            var conver = parseFloat(total);
            var paid_amount1 = $(this).val();
            console.log(total)
            console.log(paid_amount1)
            var tot = conver - paid_amount1;
            $('#balance').val(tot);
            $('.total1').val(tot);
            var tot1 = new Intl.NumberFormat().format(tot);
            $('.total1_value').html(tot1);
            $('#diskontotal').val(paid_amount1);
            $('#diskontotal1').val(paid_amount1);

        })

    $('#pajak_seluruhs').keyup(function() {
        var total = $('.total_seluruh').html();
        var conver = parseFloat(total);
        var pajakSeluruh = parseFloat($('#pajak_seluruhs').val());
        //console.log(pajakSeluruh)
        var tot = (conver + ((conver * pajakSeluruh) / 100))
        //console.log(tot)
        $('.jumlah_tagihan').html(tot);
        $('#jumlah_tagihan').val(tot);
    })



</script>
@endpush
