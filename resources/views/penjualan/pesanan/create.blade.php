@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">Penawaran</h3>
    <br>
{{--    <br>--}}
{{--    <x-breadcrumb title="{{ __(' Penawaran') }}">--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('penjualan.index') }}">{{ __('Penawaran') }}</a>--}}
{{--        </li>--}}
{{--        --}}{{-- <li class="breadcrumb-item">--}}
{{--            {{ __('Penawaran') }}--}}
{{--        </li> --}}
{{--    </x-breadcrumb>--}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card m-b-20">
                <div class="card-header">
                    <h3 class="card-title">Tambah Penawaran Penjualan</h3>

                </div>
                <form method="post" action="{{route('penjualan.store')}}">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="row" style="margin-left: 17px;margin-top: 15px">
                                <div class="form-group">
                                    <label class=" form-label" for="nama_jalan">{{ __('Status Anggota') }}</label>
                                </div>
                                <div class="form-group" >
                                    <label class="switch">
                                        <input type="checkbox" data-toggle="toggle" id="simpanan_ada_ao" name="ao"
                                               data-size="sm"
                                               data-on="Anggota" data-off="Bukan Anggota" data-onstyle="success"
                                               data-offstyle="dark"
                                               checked>
                                        <span class="slider round" for="simpanan_ada_ao"
                                        ></span>
                                    </label>
                                    {{--                                    <label for="simpanan_ada_ao"--}}
                                    {{--                                           id="simpanan_ada_aoLabel">Ya</label>--}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group" style="margin-left: 10px">
                                <label class="form-label" for="exampleInputEmail1">No Penawaran</label>
                                <input type="text" class="form-control" id="no_pesanan" name="no_pesanan"
                                       value="{{$auto->head??''}}/@if(empty($auto->format_depan))@else{{date($auto->format_depan)}}/@endif @if(empty($auto->format_tengah))@else{{date($auto->format_tengah)}}/@endif @if(empty($auto->format_belakang))@else{{date($auto->format_belakang)}}/@endif{{$count}}"
                                       readonly>
                            </div>
                        </div>
                        <input type="text" id="smpn_adaAO_value" name="anggota" hidden>
                        <div class="form-group col-md-6">
                            <div class="form-group" style="margin-right: 10px">
                                <label class="form-label" for="exampleInputEmail1">Tanggal Penawaran</label>
                                <input type="date" class="form-control" id="tanggal_penerimaan" name="tanggal" required>
                            </div>
                        </div>

                        <div class="form-group col-md-6" id="i">
                            <div class="form-group" style="margin-left: 10px">
                                <label class="form-label" for="exampleInputEmail1">Nama</label>
                                <select id="pelanggan" name="id_pelanggan" class="form-control select2" style="font-size: 12px">
                                    <option value="">-- Pilih Nama --</option>
                                    @foreach ($anggota as $supp)
                                        <option value="{{ $supp->id }}">{{ $supp->nama_pemohon }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6" id="ii">
                            <div class="form-group" style="margin-left: 10px">
                                <label class="form-label" for="exampleInputEmail1">Pelanggan</label>
                                <input type="text" name="pelanggan1" class="form-control" >
                            </div>
                        </div>


                        <div class="form-group col-md-6" id="tel">
                            <div class="form-group" style="margin-right: 10px">
                                <label class="form-label" for="exampleInputEmail1">No Telepon</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telepon" readonly>
                            </div>
                        </div>
                        <div class="form-group col-md-6" id="tel1">
                            <div class="form-group" style="margin-right: 10px">
                                <label class="form-label" for="exampleInputEmail1">No Telepon</label>
                                <input type="text" class="form-control" id="no_telp1" name="no_telepon1">
                            </div>
                        </div>


                        <div class="form-group col-md-6" id="al">
                            <div class="form-group" style="margin-left: 10px">
                                <label class="form-label" for="exampleInputEmail1">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" readonly>
                            </div>
                        </div>


                        <input type="text" hidden value="BARU" name="status">
                        <div class="form-group col-md-6" id="al1">
                            <div class="form-group" style="margin-left: 10px">
                                <label class="form-label" for="exampleInputEmail1">Alamat</label>
                                <input type="text" class="form-control" id="alamat1" name="alamat1">
                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <div class="form-group" style="margin-right: 10px">
                                <label class="form-label" for="exampleInputEmail1">Termin</label>
                                <select id="inputState" class="form-control" name="id_termin" required>
                                    <option value="">-- Pilih Termin --</option>
                                    @foreach ($termin as $id => $name)
                                        <option value="{{$id}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>


                    <div class="card m-b-20">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table card-table table-center text-nowrap table-primary">
                                    <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="text-white">Nama Produk</th>
                                        <th class="text-white">Kode</th>
                                        <th class="text-white">satuan</th>
                                        <th class="text-white">qty</th>
                                        <th class="text-white">harga</th>
                                        <th class="text-white">diskon%</th>
                                        <th class="text-white">Pajak</th>
                                        {{--                                <th class="text-white" width="110">Pajak type</th>--}}
                                        <th class="text-white">Total</th>
                                        {{--                                <th class="text-white" width="200">Total pajak</th>--}}
                                        <th class="text-white"></th>

                                    </tr>
                                    </thead>
                                    <tbody class="addMoreProduct">
                                    <tr>
                                        <td style="width:20%">
                                            <select name="produk_id[]" id="produk_id" required
                                                    class="form-control produk_id select2" style="font-size: 13px;">
                                                <option value="">--pilih--</option>
                                                @foreach ($produk as $produks)
                                                    <option data-harga="{{$produks->harga_anggota}}"
                                                            data-non="{{$produks->harga_bukan_anggota}}"
                                                            data-produk="{{$produks->kode_produk}}"
                                                            data-satuan="{{$produks->satuan->satuan_produk ?? ''}}"
                                                            value="{{$produks->id}}">{{$produks->nama_produk}}</option>

                                                @endforeach
                                            </select>
                                        </td>
                                        <td style="width:20%">
                                            <input type="text" name="kode_produk[]" id="kode_produk" readonly
                                                   class="form-control kode_produk" style="font-size: 12px">
                                        </td>
                                        <td style="width:10%">
                                            <input type="text" name="satuan[]" readonly id="satuan"
                                                   class="form-control satuan"
                                                   style="font-size: 12px">
                                        </td>
                                        <td style="width:7%">
                                            <input type="text" name="qty[]" id="qty" required class="form-control qty"
                                                   style="font-size: 12px">
                                        </td>
                                        <td style="width:10%">
                                            <input type="text" name="harga[]" id="harga"
                                                   class="form-control harga rupiah"
                                                   style="font-size: 12px;text-align: right">
                                        </td>
                                        <td style="width:4% ;">
                                            <input type="text" name="diskon[]" id="diskon"
                                                   class="form-control diskon rupiah "
                                                   style="width: 80px;margin-left: 30px">

                                        </td>
                                        <td style="width:10%">
                                            <select id="pajak" name="pajak[]" class="form-control pajak"
                                                    style="font-size: 12px">
                                                <option value="0" data-paj="0">0</option>
                                                @foreach($pajak as $p)
                                                    <option value="{{$p->id}}"
                                                            data-paj="{{$p->tarif_persentase}}"
                                                            data-pajak="{{$p->pemotongan}}">{{$p->nama_pajak}}</option>
                                                @endforeach
                                            </select>
                                            {{--                                    <input type="number" name="pajak[]" id="pajak" class="form-control pajak">--}}
                                        </td>
                                        <td hidden>
                                            <input type="number" name="total_pajak[]" id="total_pajak" readonly
                                                   class="form-control total_pajak" style="font-size: 12px">
                                        </td>
                                        <td hidden>
                                            <input type="number" name="total_pajak_pph[]" id="total_pajak_pph" readonly
                                                   class="form-control total_pajak_pph" style="font-size: 12px">
                                        </td>

                                        <td hidden>
                                            <input type="text" name="pajaktype[]" id="pajaktype"
                                                   class="form-control pajaktype"
                                                   style="font-size: 12px" hidden>
                                        </td>

                                        <td style="width:20%">
                                            <input type="text" name="total_amount[]" id="total" readonly
                                                   class="form-control total_amount rupiah"
                                                   style="font-size: 12px;text-align: right;">
                                        </td>
                                        <td hidden>
                                            <input type="number" name="diskongrand[]" id="diskongrand" readonly
                                                   class="form-control diskongrand" style="font-size: 12px">
                                        </td>
                                        <td hidden>
                                            <input type="number" name="total_amount_all[]" id="total_amount_all"
                                                   readonly
                                                   class="form-control total_amount_all" style="font-size: 12px">
                                        </td>

                                        <td hidden>
                                            <input type="number" name="total_sub[]" id="total_sub" hidden readonly
                                                   class="form-control total_sub" style="font-size: 12px">
                                        </td>
                                        <td hidden>
                                            <input type="number" name="total_disk[]" id="total_disk" readonly
                                                   class="form-control total_disk" style="font-size: 12px" hidden>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tr>
                                        <td class="bg-white">
                                            <button type="button" class="btn btn-sm btn-success add_more">Tambah
                                                Barang
                                            </button>
                                        </td>
                                        <td colspan="8" class="bg-white"></td>
                                    </tr>
                                    {{--                                    <tr>--}}
                                    {{--                                        <td class="bg-white">--}}
                                    {{--                                            <button type="button" class="btn btn-sm btn-success add_more">Tambah--}}
                                    {{--                                                Barang--}}
                                    {{--                                            </button>--}}
                                    {{--                                        </td>--}}
                                    {{--                                        <td class="bg-white"></td>--}}
                                    {{--                                        <td class="bg-white"></td>--}}
                                    {{--                                        <td class="bg-white"></td>--}}
                                    {{--                                        <td class="bg-white"></td>--}}
                                    {{--                                        <td class="bg-white" style="text-align:right;">Subtotal</td>--}}
                                    {{--                                        <td class="bg-white"></td>--}}

                                    {{--                                        <td class="bg-white">--}}
                                    {{--                                            <input type="number" hidden name="subtotal"--}}
                                    {{--                                                   readonly class="form-control total_subtotal_text"--}}
                                    {{--                                                   style="border: 0;font-size: 14px;font-weight: bold;text-align: right"--}}
                                    {{--                                                   id="total_subtotal_text">--}}
                                    {{--                                            <b class="total_subtotal_text1 bg-white"--}}
                                    {{--                                               style="font-size: 14px;font-weight: bold;text-align: right;float: right">0</b>--}}
                                    {{--                                        <td class="bg-white"></td>--}}
                                    {{--                                        <td class="bg-white"></td>--}}

                                    {{--                                    </tr>--}}
                                    {{--                                    <tr>--}}
                                    {{--                                        <td colspan="5" class="bg-white"></td>--}}

                                    {{--                                        <td class="bg-white">Diskon Per Item</td>--}}
                                    {{--                                        <td class="bg-white"></td>--}}

                                    {{--                                        <td class="bg-white">--}}
                                    {{--                                            <input type="number" name="diskon_per_item" id="diskon_per_item" hidden--}}
                                    {{--                                                   readonly class="form-control"--}}
                                    {{--                                                   style="border: 0;font-size: 14px;font-weight: bold;text-align: right">--}}
                                    {{--                                            <b class="diskon_per_item1 bg-white"--}}
                                    {{--                                               style="font-size: 14px;font-weight: bold;text-align: right;float: right">0</b>--}}
                                    {{--                                        </td>--}}
                                    {{--                                        <td class="bg-white"></td>--}}
                                    {{--                                        <td class="bg-white"></td>--}}
                                    {{--                                    </tr>--}}
                                    {{--                                    <tr>--}}
                                    {{--                                        <td colspan="5" class="bg-white"></td>--}}

                                    {{--                                        <td class="bg-white">--}}
                                    {{--                                            <div class="form-group" style="margin-left: 10px">--}}
                                    {{--                                                <label for="">Diskon</label>--}}
                                    {{--                                                <label class="switch">--}}
                                    {{--                                                    <input type="checkbox" data-size="sm" id="diskon2" name="diskon2"--}}
                                    {{--                                                           data-toggle="toggle" data-on="%" data-off="RP"--}}
                                    {{--                                                           data-onstyle="success"--}}
                                    {{--                                                           data-offstyle="dark"--}}
                                    {{--                                                           checked>--}}
                                    {{--                                                </label>--}}
                                    {{--                                                <input type="text" id="diskonvalue" name="tipediskon" hidden>--}}
                                    {{--                                            </div>--}}

                                    {{--                                        </td>--}}
                                    {{--                                                                            <td class="bg-white">--}}
                                    {{--                                                                                <div class="row">--}}
                                    {{--                                                                                    <div class="col-md-9">--}}
                                    {{--                                                                                        <input type="text" name="diskontotalrupiah" id="diskontotal"--}}
                                    {{--                                                                                               class="form-control">--}}
                                    {{--                                                                                        <input type="text" name="diskontotal" id="diskontotalpersen"--}}
                                    {{--                                                                                               class="form-control diskontotalpersen">--}}
                                    {{--                                                                                    </div>--}}
                                    {{--                                                                                    <div class="col-md-3"><span for="diskon2" id="diskon2label">&nbsp;&nbsp;%</span>--}}
                                    {{--                                                                                    </div>--}}
                                    {{--                                                                                </div>--}}
                                    {{--                                                                            </td>--}}
                                    {{--                                        <td class="bg-white" style="text-align: right;">--}}
                                    {{--                                            <input type="number" hidden readonly id="diskontotalpersen1"--}}
                                    {{--                                                   name="diskoncalculate" class="form-control"--}}
                                    {{--                                                   style="border: 0;font-size: 14px;font-weight: bold;text-align: right;">--}}
                                    {{--                                            <div class="" style="margin-left: 50px">--}}
                                    {{--                                                --}}{{--                                        <input type="number" readonly id="diskontotalpersen1_value" class="form-control" style="border: 0;font-size: 14px;font-weight: bold;">--}}
                                    {{--                                                <b class="diskontotalpersen1_value bg-white"--}}
                                    {{--                                                   style="font-size: 14px;font-weight: bold;text-align: right;float: right">0</b>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <input type="number" readonly id="diskontotal1" class="form-control"--}}
                                    {{--                                                   style="border: 0;font-size: 14px;font-weight: bold;text-align: right">--}}

                                    {{--                                        </td>--}}
                                    {{--                                        <td class="bg-white"></td>--}}
                                    {{--                                        <td class="bg-white"></td>--}}

                                    {{--                                    </tr>--}}

                                    {{--                                    <input type="text" id="subtotal" hidden>--}}

                                    {{--                                    <tr>--}}
                                    {{--                                        <td colspan="5" class="bg-white"></td>--}}

                                    {{--                                        <td class="bg-white" style="text-align:right;">PPN</td>--}}
                                    {{--                                        <td class="bg-white"></td>--}}

                                    {{--                                        <td class="bg-white">--}}
                                    {{--                                            <input type="number" name="PPN" id="ppn"--}}
                                    {{--                                                   readonly class="form-control"--}}
                                    {{--                                                   style="border: 0;font-size: 14px;font-weight: bold;text-align: right"--}}
                                    {{--                                                   hidden>--}}
                                    {{--                                            <span class="ppn_value bg-white"--}}
                                    {{--                                                  style="font-size: 14px;font-weight: bold;text-align: right;float: right"></span>--}}
                                    {{--                                        </td>--}}
                                    {{--                                        <td class="bg-white"></td>--}}
                                    {{--                                        <td class="bg-white"></td>--}}

                                    {{--                                    </tr>--}}

                                    {{--                                    <tr>--}}
                                    {{--                                        <td colspan="5" class="bg-white"></td>--}}

                                    {{--                                        <td class="bg-white" style="text-align:right;">PPH</td>--}}
                                    {{--                                        <td class="bg-white"></td>--}}

                                    {{--                                        <td class="bg-white" style="text-align: right;">--}}
                                    {{--                                            <input type="number" name="PPH" id="pph" hidden--}}
                                    {{--                                                   readonly class="form-control"--}}
                                    {{--                                                   style="border: 0;font-size: 14px;font-weight: bold;text-align: right">--}}
                                    {{--                                            (<span class="pph_value bg-white"--}}
                                    {{--                                                   style="font-size: 14px;font-weight: bold;text-align: right;">0</span>)--}}
                                    {{--                                        </td>--}}
                                    {{--                                        <td class="bg-white"></td>--}}
                                    {{--                                        <td class="bg-white"></td>--}}

                                    {{--                                    </tr>--}}


                                    {{--                                    <tr>--}}
                                    {{--                                        <td colspan="5" class="bg-white"></td>--}}

                                    {{--                                        <td class="bg-white">Biaya Pengiriman</td>--}}
                                    {{--                                        <td class="bg-white"></td>--}}

                                    {{--                                        <td class="bg-white" style="float: right">--}}
                                    {{--                                            <input type="text" id="paid_amount" hidden--}}
                                    {{--                                                   class="form-control"--}}
                                    {{--                                                   style="border: 0;font-size: 14px;font-weight: bold;text-align: right">--}}
                                    {{--                                            <input type="text" id="paid_amount_value" name="biaya_pengiriman"--}}
                                    {{--                                                   class="form-control"--}}
                                    {{--                                                   style="font-size: 14px;font-weight: bold;text-align: right">--}}
                                    {{--                                        </td>--}}
                                    {{--                                        <td class="bg-white"></td>--}}
                                    {{--                                        <td class="bg-white"></td>--}}

                                    {{--                                    </tr>--}}
                                    {{--                                    <tr>--}}
                                    {{--                                        <td colspan="5" class="bg-white"></td>--}}
                                    {{--                                        <td class="bg-white" style="text-align:right;">Total</td>--}}
                                    {{--                                        <td class="bg-white"></td>--}}

                                    {{--                                        <td class="bg-white">--}}
                                    {{--                                            <b hidden class="total"></b>--}}
                                    {{--                                            <input hidden type="number" name="total_balance" id="balance" readonly--}}
                                    {{--                                                   class="form-control">--}}
                                    {{--                                            <input hidden type="number" id="totalgrand" readonly class="form-control">--}}
                                    {{--                                            <input hidden type="text" class="total1 form-control" name="total" readonly--}}
                                    {{--                                                   style="border: 0;font-size: 14px;font-weight: bold;text-align: right">--}}
                                    {{--                                            <span class="total1_value bg-white"--}}
                                    {{--                                                  style="font-size: 14px;font-weight: bold;text-align: right;float: right">0</span>--}}
                                    {{--                                            <br>--}}
                                    {{--                                            <br>--}}
                                    {{--                                            <input type="text" class="total1_back" hidden>--}}
                                    {{--                                        </td>--}}
                                    {{--                                        <td class="bg-white"></td>--}}
                                    {{--                                        <td class="bg-white"></td>--}}
                                    {{--                                    </tr>--}}

                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <h5>Subtotal<b
                                            class="total_subtotal_text1 bg-white"
                                            style="font-size: 14px;font-weight: bold;text-align: right;float: right">0</b>
                                    </h5>
                                    <input type="number" hidden name="subtotal"
                                           readonly class="form-control total_subtotal_text"
                                           style="border: 0;font-size: 14px;font-weight: bold;text-align: right"
                                           id="total_subtotal_text">

                                </div>
                                <div class="col-md-8">
                                </div>
                                <div class="col-md-4">
                                    <h5>Diskon Per Item
                                        <input type="number" name="diskon_per_item" id="diskon_per_item" hidden
                                               readonly class="form-control"
                                               style="border: 0;font-size: 14px;font-weight: bold;text-align: right">
                                         <b class="diskon_per_item1 bg-white"
                                             style="font-size: 14px;font-weight: bold;text-align: right;float: right">
                                            0 </b>
                                    </h5>
                                </div>
                                <div class="col-md-8">
                                </div>
                                <div class="col-md-1">
                                    <h5>
                                        <label class="switch">
                                            <input type="checkbox" data-size="sm" id="diskon2" name="diskon2"
                                                   data-toggle="toggle" data-on="Diskon %" data-off="Diskon RP"
                                                   data-onstyle="success"
                                                   data-offstyle="dark"
                                                   checked>
                                        </label>
                                    </h5>
                                </div>
                                <div class="col-md-1  ">
                                    <input type="text" name="diskontotalrupiah" id="diskontotal"
                                           class="form-control" style="float: right;text-align: right;">
                                    <input type="text" name="diskontotal" id="diskontotalpersen"
                                           class=" diskontotalpersen form-control"
                                           style="float: right;text-align: right">
                                    <input type="text" id="diskonvalue" name="tipediskon" hidden>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" hidden readonly id="diskontotalpersen1"
                                           name="diskoncalculate" class=""
                                           style="border: 0;font-size: 14px;font-weight: bold;text-align: right;float: right">
                                    <input type="number" readonly id="diskontotalpersen1_value" class=""
                                           style="border: 0;font-size: 14px;font-weight: bold;float: right">
                                    <b class="diskontotalpersen1_value bg-white"
                                       style="font-size: 14px;font-weight: bold;text-align: right;float: right">0</b>
                                    <input type="number" readonly id="diskontotal1" class=""
                                           style="border: 0;font-size: 14px;font-weight: bold;text-align: right;float: right">
                                </div>
                                <input type="text" id="subtotal" hidden>

                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <h5>PPN
                                        <input type="number" name="PPN" id="ppn"
                                               readonly class="form-control"
                                               style="border: 0;font-size: 14px;font-weight: bold;text-align: right"
                                               hidden>
                                        <span class="ppn_value bg-white"
                                              style="font-size: 14px;font-weight: bold;text-align: right;float: right"></span>
                                    </h5>
                                </div>
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <h5>PPH
                                        <input type="number" name="PPH" id="pph" hidden
                                               readonly class="form-control"
                                               style="border: 0;font-size: 14px;font-weight: bold;text-align: right">
                                        <span class="pph_value bg-white"
                                              style="font-size: 14px;font-weight: bold;text-align: right;float: right">0</span>

                                    </h5>
                                </div>
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <h5>Biaya Pengiriman
                                        <input type="text" id="paid_amount" hidden
                                               class="form-control"
                                               style="border: 0;font-size: 14px;font-weight: bold;text-align: right;border: none">
                                        <input type="text" id="paid_amount_value" name="biaya_pengiriman"
                                               class=""
                                               style="font-size: 14px;font-weight: bold;text-align: right;float: right;border: none">
                                    </h5>
                                </div>
                                <div class="col-md-8">
                                </div>
                                <div class="col-md-4">
                                    <h5> Total
                                    <input hidden type="number" name="total_balance" id="balance" readonly
                                           class="form-control">
                                    <input hidden type="number" id="totalgrand" readonly class="form-control">
                                    <input hidden type="text" class="total1 form-control" name="total" readonly
                                           style="border: 0;font-size: 14px;font-weight: bold;text-align: right">
                                    <span class="total1_value bg-white"
                                          style="font-size: 14px;font-weight: bold;text-align: right;float: right">0</span>
                                     <input type="text" class="total1_back" hidden>

                                    </h5>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="float-right">
                        <a href="{{route('penjualan.index')}}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
            </div>
        </div>
    </div>

    </form>
    </div>

    </div>


@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
          rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>



    <script>

        $('.select2').select2({
            tags: true,
            // placeholder: "Select an Option",
            allowClear: true,
            width: '100%'
        });
        $('#ii').hide();
        $('#tel1').hide();
        $('#al1').hide();
        $('#smpn_adaAO_value').val('1');
        $('#simpanan_ada_ao').on('change', function () {
            if ($(this).prop("checked") == true) {
                $('#smpn_adaAO_value').val('1');
                $('#simpanan_ada_aoLabel').html("Ya");
                $('#ii').hide();
                $('#tel').show();
                $('#al').show();
                $('#tel1').hide();
                $('#al1').hide();
                $('#i').show();
            } else if ($(this).prop("checked") == false) {
                $('#smpn_adaAO_value').val('0');
                $('#simpanan_ada_aoLabel').html("Tidak");
                $('#ii').show();
                $('#tel1').show();
                $('#tel').hide();
                $('#al1').show();
                $('#i').hide();
                $('#al').hide();
            }
        });

        $('.add_more').on('click', function () {
            var product = $('.produk_id').html();
            var termin = $('.termin').html();
            var pajak = $('.pajak').html();
            var numberofrow = ($('.addMoreProduct tr').length - 0) + 1;
            var tr = '<tr><td><select class="form-control produk_id select2" required name="produk_id[]"style="font-size: 12px">' + product + '</select> </td>' +
                '<td><input type="text" name="kode_produk[]"readonly class="form-control kode_produk"style="font-size: 12px"></td>' +
                '<td><input type="text" name="satuan[]"readonly class="form-control satuan"style="font-size: 12px"></td>' +
                '<td><input type="text" name="qty[]"required class="form-control qty"style="font-size: 12px"></td>' +
                '<td><input type="text"  name="harga[]" class="form-control harga rupiah1"style="font-size: 12px;text-align: right"></td>' +
                '<td><input type="text" name="diskon[]" class="form-control diskon rupiah1"style="width: 80px;margin-left: 30px;font-size: 12px"></td>' +
                '<td><select class="form-control pajak" name="pajak[]"style="font-size: 12px">' + pajak + '</select></td>' +
                // '<td><input type="number" name="pajak[]" class="form-control pajak"></td>'+
                '<td hidden><input type="number" hidden readonly name="total_pajak[]" class="form-control total_pajak"style="font-size: 12px"></td>' +
                '<td hidden><input type="number" hidden readonly name="total_pajak_pph[]" class="form-control total_pajak_pph"style="font-size: 12px"></td>' +
                '<td hidden><input type="number" hidden readonly name="pajaktype[]" class="form-control pajaktype"style="font-size: 12px"></td>' +
                '<td hidden><input type="number" hidden readonly name="total_amount_all[]" class="form-control total_amount_all"style="font-size: 12px"></td>' +
                '<td hidden><input type="number" hidden readonly name="total_sub[]" class="form-control total_sub"style="font-size: 12px"></td>' +
                '<td hidden><input type="number" hidden readonly name="total_disk[]" class="form-control total_disk"style="font-size: 12px"></td>' +
                '<td ><input type="text"  readonly name="total_amount[]" class="form-control total_amount rupiah"style="font-size: 12px;text-align: right"></td>' +
                '<td hidden><input type="number" hidden readonly name="diskongrand[]" class="form-control diskongrand"style="font-size: 12px"></td>' +

                '<td><a class="btn btn-danger btn-sm delete rounded-circle"><i class="fa fa-trash"></i></a></td>';
            //select2 class addMoreProduct
            selectRefresh();
            $('.addMoreProduct').append(tr,selectRefresh());
        }, selectRefresh());
        $('.rupiah').inputmask('decimal', {
            allowMinus: false,
            autoGroup: true,
            groupSeparator: '.',
            rightAlign: false,
            autoUnmask: true,
            removeMaskOnSubmit: true
        });
        function selectRefresh() {
            $('.select2').select2({
                tags: true,
                // placeholder: "Pilih Produk",
                allowClear: true,
                width: '100%'
            });
        }
        $('.addMoreProduct').delegate('.qty', 'change', function () {
            var tr = $(this).parent().parent();
            var qty = tr.find('.qty').val();
            var produk_id = tr.find('.produk_id').val();
            $.ajax({
                url: "{{ route('penjualan.index') }}",
                method: 'GET',
                data: {qty: qty, produk_id: produk_id},
                success: function (response) {
                    console.log(response)
                    if (response.results == 'masih') {
                        tr.find('.produk_id').removeClass("is-invalid");
                    } else {
                        Swal.fire({
                            icon: 'error',
                            text: 'Stok Barang Tidak Mencukupi!',
                        });
                        tr.find('.qty').val('');
                        tr.find('.diskon').val('');
                        tr.find('.pajak').val('');
                        tr.find('.total_amount').val('');
                        tr.find('.total_pajak').val('');
                        tr.find('.total_pajak_pph').val('');
                        tr.find('.pajaktype').val('');
                        tr.find('.total_amount').val('');
                        tr.find('.diskongrand').val('');
                        tr.find('.total_amount_all').val('');
                        tr.find('.total_sub').val('');
                        tr.find('.total_disk').val('');
                        tr.find('.kode_produk').val('');
                        tr.find('.produk_id').val('');
                        tr.find('.satuan').val('');
                        tr.find('.harga').val('');
                        //trigger change
                        tr.find('.produk_id').trigger('change');
                        return false;
                        alert('')
                    }
                },
            });

        });

        $('.addMoreProduct').delegate('.delete', 'click', function () {
            var tr = $(this).parent().parent();
            if ($('#smpn_adaAO_value').val() == 1) {
                var price = tr.find('.produk_id option:selected').attr('data-harga');
            } else {
                var price = tr.find('.produk_id option:selected').attr('data-non');
            }
            var produk = tr.find('.produk_id option:selected').attr('data-produk');
            var satuan = tr.find('.produk_id option:selected').attr('data-satuan');
            var pajak = tr.find('.pajak option:selected').attr('data-paj');
            ;
            tr.find('.harga').val(price);
            tr.find('.kode_produk').val(produk);
            tr.find('.satuan').val(satuan);
            var qty = tr.find('.qty').val() - 0;
            var disc = tr.find('.diskon').val() - 0;
            var price = tr.find('.harga').val() - 0;
            var pajak = tr.find('.pajak').val() - 0;
            var total_amount = (qty * price) - (((qty * price * disc) / 100) + ((qty * price * pajak) / 100));
            var diskontotal = ((qty * price * disc) / 100);
            var total_subtotal = (qty * price);
            tr.find('.total_amount').val(total_amount);
            tr.find('.total_disk').val(diskontotal);
            tr.find('.total_sub').val(total_subtotal);
            $(this).parent().parent().remove();
            EndAmount();
            TotalSub();
            TotalDiskon();
            TotalPajak();
            TotalPajakpph();
            totalpajakpphandppn();
        });


        function TotalDiskon() {
            var total = 0;
            var tot = 0;
            $('.total_disk').each(function (i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            });
            $('#diskon_per_item').val(total);

            var tot = new Intl.NumberFormat().format(total);
            $('.diskon_per_item1').html('('+tot+')');
        }

        function totalpajakpphandppn() {
            var total = 0;
            var diskon = 0;
            var totaldiskon = 0;
            var totalreal = 0;
            var totalall = 0;

            var tot = 0;
            $('.total_amount').each(function (i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            });
            var totaldiskon = $('#diskontotalpersen').val();
            var diskon = parseFloat(totaldiskon);
            var totalreal = parseFloat(total);
            // var totalall = totalreal / diskon ;
            var totalall = ((diskon / 100) * totalreal);
            $('#diskontotalpersen1').val(totalall);

            var tot = new Intl.NumberFormat().format(totalall);
            $('.diskontotalpersen1_value').html(tot);
        }


        function TotalPajakpph() {
            var total = 0;
            var tot1 = 0;
            var tot = 0;
            $('.total_pajak_pph').each(function (i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            });
            if ($('#diskontotalpersen').val() == '') {
                $('#pph').val(total);
                var tot = new Intl.NumberFormat().format(total);
                $('.pph_value').html(tot);
            } else {
                var totaldiskon = $('#diskontotalpersen').val();
                var totaldiskonvalue = $('#diskontotalpersen1').val();
                var diskon = parseFloat(totaldiskon);
                var value = parseFloat(totaldiskonvalue);
                var totalreal = parseFloat(total);
                var grand = totalreal - ((totalreal * diskon) / 100);
                $('#pph').val(grand);
                var tot1 = new Intl.NumberFormat().format(grand);
                // if (isNaN(tot1)){
                //
                // }
                $('.pph_value').html('('+tot1+')');
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

            if ($('#diskontotalpersen').val() == '') {
                $('#ppn').val(total);
                var tot = new Intl.NumberFormat().format(total);
                $('.ppn_value').html(tot);
            } else {
                var totaldiskon = $('#diskontotalpersen').val();
                var totaldiskonvalue = $('#diskontotalpersen1').val();
                var diskon = parseFloat(totaldiskon);
                var value = parseFloat(totaldiskonvalue);
                var totalreal = parseFloat(total);

                var grand = totalreal - ((totalreal * diskon) / 100);
                $('#ppn').val(grand);
                var tot1 = new Intl.NumberFormat().format(grand);
                $('.ppn_value').html(tot1);

            }
        }

        function TotalAmount() {
            var total = 0;
            var tot1 = 0;
            $('.total_amount_all').each(function (i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            });
            // $('.total').html(total);
            $('.total1').val(total);
            var tot1 = new Intl.NumberFormat().format(total);
            $('.total1_value').html(tot1);
            $('.total1_back').val(total);
            $('#balance').val(total);
            $('.totalgrand').val(total);
            $('#subtotal').val(total);
        }

        function TotalSub() {
            var total = 0;
            var test_value = 0;
            var tot = 0;
            $('.total_sub').each(function (i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            });
            $('.total_subtotal_text').val(total);
            var tot = new Intl.NumberFormat().format(total);
            $('.total_subtotal_text1').html(tot);

            // $('#subtotal').val(total);
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


        $('.addMoreProduct').delegate('.produk_id', ' change', function () {

            var tr = $(this).parent().parent();
            if ($('#smpn_adaAO_value').val() == 1) {
                var price = tr.find('.produk_id option:selected').attr('data-harga');
            } else {
                var price = tr.find('.produk_id option:selected').attr('data-non');
            }
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

            var pajak = tr.find('.pajak').val() - 0;
            var biaya = $('#paid_amount').val() - 0;

            // var total_amount =biaya + ((qty * price) - (((qty * pric e * disc) / 100) + ((qty * price * pajak) / 100)));
            var total_amount = ((quan * price) - (((quan * price * disc) / 100)));
            tr.find('.total_amount').val(total_amount);
            TotalAmount();

            $('#diskontotalpersen').val('0');
            $('#diskontotal').val('0');
        });
        $('.addMoreProduct').delegate('.produk_id,.qty, .diskon,.diskongrand, .pajak ,.harga', 'keyup change', function () {
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
            var pajak = tr.find('.pajak option:selected').attr('data-paj') - 0;
            var diskongrand = $('#diskontotalpersen').val() - 0;
            var biaya = $('#paid_amount').val() - 0;

            // var total_amount =biaya +  ((qty * price) - (((qty * price * disc) / 100) + ((qty * price * pajak) / 100)));
            // var total_amount_all =biaya +  ((qty * price) - ((qty * price * disc) / 100) + (pajak * ((qty * price) - ((qty * price * pajak) / 100)) / 100));
            var total_amount = ((qty * price) - ((qty * price * disc) / 100));
            var diskontotal = ((qty * price * disc) / 100);
            var total_subtotal = (qty * price);
            var totalproduk = ((pajak * ((qty * price) - ((qty * price * disc) / 100)) / 100));

            if (pajaktype == '1') {
                tr.find('.total_pajak').val(totalproduk);
                tr.find('.total_pajak_pph').val(0);
                var total_amount_all = (biaya + ((qty * price) - ((qty * price * disc) / 100) + (pajak * ((qty * price) - ((qty * price * pajak) / 100)) / 100)));
                // var total_amount_all = (biaya + ((qty * price) - ((qty * price * disc) / 100) + ((pajak * ((qty * price) - ((qty * price * disc) / 100)) / 100) - (diskongrand*(pajak * price) - (qty * price * disc)/100))/100)) ;
            } else {
                tr.find('.total_pajak_pph').val(totalproduk);
                tr.find('.total_pajak').val(0);
                var total_amount_all = biaya + ((qty * price) - ((qty * price * disc) / 100) - (pajak * ((qty * price) - ((qty * price * disc) / 100)) / 100));
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

            $('#diskontotalpersen').val('0');
            $('#diskontotal').val('0');
        });
        $('.addMoreProduct').delegate('.produk_id,.qty,.diskon,.pajak,.harga', 'keyup change', function () {
            // $('#diskontotalpersen').val('') ;
            // $('#diskontotalpersen1').val('') ;
            // $('#diskontotal1').val('') ;
            // $('#diskontotal').val('') ;



            var tr = $(this).parent().parent();
            var pajaktype = tr.find('.pajak option:selected').attr('data-pajak');
            var qty = tr.find('.qty').val() - 0;
            var disc = tr.find('.diskon').val() - 0;
            var price = tr.find('.harga').val() - 0;
            var pajak = tr.find('.pajak option:selected').attr('data-paj') - 0;


            var totalamount = tr.find('.total_amount').val() - 0;
            var diskontotalpersen = $('#diskontotalpersen').val() - 0;
            var biaya = $('#paid_amount').val() - 0;
            var totalproduk = (pajak * ((qty * price) - ((qty * price * disc) / 100)) / 100);
            var total_amount = ((qty * price) - ((qty * price * disc) / 100));
            var diskontotal = ((qty * price * disc) / 100);
            var total_subtotal = (qty * price);
            if (pajaktype == '1') {
                tr.find('.total_pajak').val(totalproduk);
                tr.find('.total_pajak_pph').val(0);
                // var total_amount_all =(biaya +  ((qty * price) - ((qty * price * disc) / 100) + (pajak * ((qty * price) - ((qty * price * pajak) / 100)) / 100)));
                var total_amount_all = (biaya + ((qty * price) - ((qty * price * disc) / 100) + (pajak * ((qty * price) - ((qty * price * disc) / 100)) / 100)));
            } else {
                tr.find('.total_pajak_ppn').val(totalproduk);
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

            $('#diskontotalpersen').val('0');
            $('#diskontotal').val('0');

        });

        $('#paid_amount').val(0);
        $('#diskontotalpersen1').val(0);

        $('#paid_amount_value').keyup(function () {
            if ($(this).val() == '') {
                $(this).val(0);
            }
            var total = $('#balance').val();
            var conver = parseFloat(total);
            var paid_amount = parseFloat($('#paid_amount_value').val());

            var tot = conver + paid_amount;
            // $('#balance').val(tot);
            $('.total1').val(tot);
            var tot1 = new Intl.NumberFormat().format(tot);
            $('.total1_value').html(tot1);
            $('.total1_back').val(tot);
        })

        $('#diskontotal1').hide();
        $('#diskontotal').hide();
        $('#diskonvalue').val('1');
        $('#diskon2').on('change', function () {

            if ($(this).prop("checked") == true) {
                // $('#diskontotalpersen').val('') ;
                // $('#diskontotalpersen1').val('') ;
                // $('#diskontotal1').val('') ;
                // $('#diskontotal').val('') ;
                $('#diskonvalue').val('1');
                $('#diskon2label').html(" % ");
                $('#diskontotal').hide();
                $('#diskontotal1').hide();
                $('#diskontotalpersen').show();
                $('#diskontotalpersen1').show();
                $('#diskontotalpersen1_value').show();


            } else if ($(this).prop("checked") == false) {
                // $('#diskontotalpersen').val('') ;
                // $('#diskontotalpersen1').val('') ;
                // $('#diskontotal1').val('') ;
                // $('#diskontotal').val('') ;
                $('#diskonvalue').val('0');
                $('#diskon2label').html("RP");
                $('#diskontotal').show();
                $('#diskontotal1').show();
                $('#diskontotalpersen').hide();
                $('#diskontotalpersen1').hide();
                $('#diskontotalpersen1_value').hide();

            }
        });

        // $('#diskontotalpersen').on('keyup',function(){
        //     test_value = $(this).val();
        //     $('.diskongrand').val(test_value)
        // })
        $('#diskontotalpersen').val(0);
        $('.diskontotalpersen1_value').hide();

        $('#diskontotalpersen').keyup(function () {
            $('#diskontotal').val('0');
            $('.diskontotalpersen1_value').show();
            $('#diskontotalpersen1_value').hide()
            var total = $('.total1_back').val();
            var conver = parseFloat(total);
            var paid_amount = $('#paid_amount_value').val();
            var conver1 = parseFloat(paid_amount);
            var paid_amount1 = $(this).val();
            var tot = conver - (paid_amount1 * conver / 100);

            var dis = ((conver * paid_amount1) / 100);
            $('#balance').val(tot);
            $('.total1').val(tot);
            var tot1 = new Intl.NumberFormat().format(tot);
            $('.total1_value').html(tot1);

            // $('#diskontotalpersen1').val(dis);
            totalpajakpphandppn();
            TotalPajak();
            TotalPajakpph();

        })
        $('#diskontotal').keyup(function () {

            $('#diskontotalpersen').val('0');
            $('.diskontotalpersen1_value').hide();
            var total = $('.total1_back').val();
            var conver = parseFloat(total);
            var paid_amount1 = $(this).val();

            var tot = conver - paid_amount1;
            $('#balance').val(tot);
            $('.total1').val(tot);
            var tot1 = new Intl.NumberFormat().format(tot);
            $('.total1_value').html(tot1);
            $('#diskontotal').val(paid_amount1);
            $('#diskontotal1').val(paid_amount1);

        })

        $('#pelanggan').on('change', function () {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    type: "GET",
                    url: "{{route('getdatapenjualan')}}?country_id=" + id,
                    success: function (res) {
                        if (res) {
                            $("#alamat").empty();
                            $("#no_telp").empty();
                            $.each(res, function (key, value) {
                                $("#alamat").val(res.nama_jalan + ' No.' + res.no_rumah + ' Rt/Rw ' + res.rtrw);
                                $("#no_telp").val(res.no_telpon);
                            });
                        } else {
                            $("#alamat").empty();
                            $("#no_telp").empty();

                        }
                    }
                });
            } else {
                $("#alamat").empty();
                $("#no_telp").empty();
            }
        })


    </script>
@endpush
