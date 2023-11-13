@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">Penawaran</h3>
    <br>
{{--    <br>--}}
{{--    <x-breadcrumb title="{{ __(' Penawaran') }}">--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('penjualan.index') }}">{{ __('Penawaran') }}</a>--}}
{{--        </li>--}}
{{--    </x-breadcrumb>--}}
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card m-b-20">

                <form method="post" action="">
                    @csrf

                    <div class="row p-5">
                        <div class="col-md-12 font-weight-bold pb-2">
                            {{-- <span>{{ __('Anggota') }}: {{ $penjualan->anggota == 1 ? 'Ya' : 'Tidak' }}</span> --}}
                            @if($penjualan->anggota == 1)
                                Anggota : <span class="badge badge-success">Aktif</span>
                            @else
                                Anggota : <span class="badge badge-warning">Belum Aktif</span>
                            @endif
                        </div>
                        <br>

                        <input type="text" id="smpn_adaAO_value" name="anggota" hidden value="{{ $penjualan->anggota ?? '' }}">

                        @if($penjualan->anggota == 1)
                            <div class="col-md-6" id="i">
                                <div class="form-group">
                                    <label class="form-label" for="exampleInputEmail1">Nama</label>
                                    @if($penjualan->id_pelanggan != '')
                                        <input type="text" value="{{ $penjualan->anggotas->nama_pemohon ?? '' }}" class="form-control" readonly>
                                    @elseif ($penjualan->id_pelanggan == '')
                                        <input type="text" value="{{ $penjualan->non_anggota ?? ' '}}" class="form-control" readonly>
                                    @else
                                        <input type="text" class="form-control" readonly>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6" id="tel">
                                <div class="form-group">
                                    <label class="form-label" for="exampleInputEmail1">No Telepon</label>
                                    <input type="text" class="form-control" id="no_telp" name="no_telepon" readonly value="{{ $penjualan->no_telepon ??'' }}">
                                </div>
                            </div>

                            <div class="col-md-6" id="al">
                                <div class="form-group">
                                    <label class="form-label" for="exampleInputEmail1">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" readonly value="{{ $penjualan->alamat ??'' }}">
                                </div>
                            </div>
                        @else
                            <div class="col-md-6" id="i">
                                <div class="form-group">
                                    <label class="form-label" for="exampleInputEmail1">Pelanggan</label>
                                    <input type="text" class="form-control" value="{{ $penjualan->non_anggota ?? '' }}">
                                </div>
                            </div>

                            <div class="col-md-6" id="tel">
                                <div class="form-group">
                                    <label class="form-label" for="exampleInputEmail1">No Telepon</label>
                                    <input type="text" class="form-control" id="no_telp" name="no_telepon" readonly value="{{ $penjualan->no_telepon ??'' }}">
                                </div>
                            </div>

                            <div class="col-md-6" id="al">
                                <div class="form-group">
                                    <label class="form-label" for="exampleInputEmail1">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" readonly value="{{ $penjualan->alamat ??'' }}">
                                </div>
                            </div>
                        @endif

                        <input type="text" hidden value="BARU" name="status">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Tanggal Penawaran</label>
                                <input type="date" class="form-control" id="tanggal_penerimaan" name="tanggal" value="{{ $penjualan->tanggal ??'' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">No Penawaran</label>
                                <input type="text" class="form-control" id="no_pesanan" name="no_pesanan" value="{{ $penjualan->no_pesanan ?? '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Termin</label>
                                <select id="inputState" class="form-control" name="id_termin" disabled>
                                    <option value="">-- Pilih Termin --</option>
                                    @foreach ($termin as $id => $name)
                                        <option value="{{ $id }}" @if($penjualan->id_termin == $id)selected @endif>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                        <table class="table card-table table-center text-nowrap table-primary">
                            <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-white" width="200">Nama Produk</th>
                                <th class="text-white" width="140">Kode</th>
                                <th class="text-white" width="100">satuan</th>
                                <th class="text-white" width="90">qty</th>
                                <th class="text-white" width="120">harga</th>
                                <th class="text-white" width="30">diskon %</th>
                                <th class="text-white" width="150">Pajak</th>
                                <th class="text-white" width="200">Total</th>
                            </tr>
                            </thead>
                            <tbody class="addMoreProduct">
                            @php $j=0;$k=0; @endphp

                            @foreach($penjualanproduk as $data)
                                <tr>
{{--                                    <td>1</td>--}}
                                    <td>
                                        <input type="text" value="{{$data->produks->nama_produk ?? ''}}"
                                               class="form-control" readonly style="font-size: 12px">
                                    </td>
                                    <td>
                                        <input type="text" name="kode_produk[]" id="kode_produk" style="font-size: 12px"
                                               class="form-control kode_produk" readonly
                                               value="{{$data->produks->kode_produk ?? ''}}">
                                    </td>
                                    <td>
                                        <input type="text" name="satuan[]" id="satuan" style="font-size: 12px"
                                               class="form-control satuan" readonly
                                               value="{{$data->produks->satuan->satuan_produk ?? ''}}">
                                    </td>
                                    <td>
                                        <input type="text" name="qty[]" id="qty" style="font-size: 12px"
                                               class="form-control qty" readonly value="{{$data->qty ?? ''}}">
                                    </td>
                                    <td width="300">
                                        <input type="text" name="harga[]" id="harga" style="font-size: 10px"
                                               class="form-control harga" readonly
                                               value="{{number_format($data->harga_produk) ?? ''}}">
                                    </td>
                                    <td>
                                        <input type="text" name="diskon[]" id="diskon" style="font-size: 10px"
                                               class="form-control diskon" readonly
                                               value="{{number_format($data->diskonproduk) ?? ''}}">

                                    </td>
                                    <td width="200">
                                        <select id="pajak" name="pajak[]" class="form-control pajak" disabled
                                                style="font-size: 12px">
                                            <option value="0">0</option>
                                            @foreach($pajak as $p)
                                                <option value="{{$p->id}}"@if($data->pajak == $p->id)selected @endif
                                                        >{{$p->nama_pajak}}</option>
                                            @endforeach
                                        </select>

                                        {{--                                    <input type="number" name="pajak[]" id="pajak" class="form-control pajak">--}}

                                    </td>
{{--                                    <td>--}}
{{--                                        <select id="termin" name="termin[]" style="font-size: 12px"--}}
{{--                                                class="form-control termin" readonly>--}}
{{--                                            <option></option>--}}
{{--                                            mn--}}
{{--                                            @foreach ($termin as $id => $name)--}}
{{--                                                <option value="{{$id}}"--}}
{{--                                                        @if($data->id_terminproduk ??'' == $id)selected @endif>{{$name}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </td>--}}
                                    <td>
                                        <input type="text" name="total_amount[]" style="font-size: 12px" id="total"
                                               class="form-control total_amount" value="{{number_format($data->totalproduk) ?? ''}}"
                                               readonly>
                                    </td>
{{--                                    <td>--}}
{{--                                        --}}{{--                                <a href="#" class="btn btn-sm btn-danger rounded-circle delete"><i class="fa fa-trash"></i></a>--}}
{{--                                    </td>--}}
                                </tr>

                                @php $j += $data->harga_produk;@endphp
                            @endforeach
                            </tbody>


                            <tr>
                                <td class="bg-white"></td>
                                <td class="bg-white"></td>
                                <td class="bg-white"></td>
                                <td class="bg-white"></td>
                                <td class="bg-white"></td>
                                <td class="bg-white"style="text-align:right;">subtotal</td>
                                <td class="bg-white"></td>

                                <td class="bg-white"style="text-align:right;"><b class="total">Rp.{{number_format($j,2)}}</b></td>

                            </tr>
                            <tr>
                                <td class="bg-white"></td>
                                <td class="bg-white"></td>
                                <td class="bg-white"></td>
                                <td class="bg-white"></td>
                                <td class="bg-white"></td>
                                <td class="bg-white"style="text-align:right;">Diskon Per Produk</td>
                                <td class="bg-white"></td>

                                <td class="bg-white"style="text-align:right;"><b class="total">Rp.{{number_format($penjualan->diskon_per_item,2)}}</b></td>

                            </tr>

                            <tr>
                                <td colspan="5" class="bg-white"></td>

                                <td class="bg-white">
                                    <div class="form-group" style="margin-left: 10px">
                                        <label for="">Diskon</label>
                                        <label class="switch">
                                            <input type="checkbox" data-size="sm" id="diskon2" name="diskon2" disabled
                                                   data-toggle="toggle" data-on="%" data-off="RP" data-onstyle="success"
                                                   data-offstyle="dark"
                                                   @if($penjualan->tipediskon == 1)checked @endif>


                                        </label>
                                        <input type="text" id="diskonvalue" name="tipediskon" hidden>
                                    </div>
                                </td>
                                <td class="bg-white">
                                    <div class="row">
                                        <div class="col-md-9">
                                            @if($penjualan->tipediskon == 1)
                                                <input type="number" readonly name="diskontotal" id="diskontotalpersen" style="font-size: 10px"
                                                       class="form-control" value="{{$penjualan->diskontotal ?? ''}}">
                                            @else
                                                <input type="number" readonly name="diskontotal" id="diskontotal"
                                                       class="form-control"
                                                       value=value="{{$penjualan->diskontotal ?? ''}}">
                                            @endif
                                        </div>
                                        <div class="col-md-3">
 <span for="diskon2"
       id="diskon2label">&nbsp;&nbsp;@if($penjualan->tipediskon == 1)% @else RP @endif</span>

                                        </div>

                                    </div>
                                </td>
                                <td class="bg-white"style="text-align:right;">
                                    @php
                                        if($penjualan->tipediskon == 1)
                                        {
                                      $ok =   ((($j - $penjualan->diskon_per_item) * $penjualan->diskontotal ?? '') /100);
                                        }else{
                                         $ok =    $penjualan->diskontotalrupiah ?? '';
                                        }
                                    @endphp
                                    {{--                                <input type="number" readonly id="diskontotalpersen1" class="form-control" value="{{ $ok }}">--}}
                                    <b>Rp.{{ number_format($ok,2) }}</b>

                                </td>

                            </tr>
                            <tr>
                                <td class="bg-white"></td>
                                <td class="bg-white"></td>
                                <td class="bg-white"></td>
                                <td class="bg-white"></td>
                                <td class="bg-white"></td>
                                <td class="bg-white"style="text-align:right;">PPN</td>
                                <td class="bg-white"></td>

                                <td class="bg-white"style="text-align:right;"><b class="total"style="text-align:right;">Rp.{{number_format($penjualan->PPN,2)}}</b></td>

                            </tr>
                            <tr>
                                <td class="bg-white"></td>
                                <td class="bg-white"></td>
                                <td class="bg-white"></td>
                                <td class="bg-white"></td>
                                <td class="bg-white"></td>
                                <td class="bg-white"style="text-align:right;">PPH</td>
                                <td class="bg-white"></td>

                                <td class="bg-white" style="text-align:right;"><b class="total"style="text-align:right;">Rp.({{number_format($penjualan->PPH,2)}})</b></td>

                            </tr>
                            <tr>
                                <td colspan="5" class="bg-white"></td>

                                <td class="bg-white"style="text-align:right;">Biaya Pengiriman</td>
                                <td class="bg-white"></td>

                                <td class="bg-white"><p style="text-align:right;"><b>Rp.{{number_format($penjualan->biaya_pengiriman,2)}}</b></p>
                                </td>

                            </tr>

                            <tr>
                                <td colspan="5" class="bg-white"></td>
                                <td class="bg-white"style="text-align:right;">Total</td>
                                <td class="bg-white"></td>

                                <td class="bg-white"style="text-align:right;">
                                    <b >Rp.{{number_format($penjualan->total ?? '',2)}}</b>
                                    {{--                                <input type="number" name="total" id="balance" readonly class="form-control" value="{{$penjualan->total ?? ''}}">--}}
                                    {{--                                <input type="text" class="total1" hidden>--}}
                                </td>

                            </tr>

                        </table>
                        <div class="float-right p-4">
                            <a href="{{route('penjualan.index')}}" class="btn btn-danger">Kembali</a>
                        </div>
                </form>

            </div>
        </div>
    </div>



@endsection
@push('css')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
          rel="stylesheet">
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <script>
        $('#simpanan_ada_ao').on('click', function () {
            if ($(this).prop("checked") == true) {
                $('#smpn_adaAO_value').val('1');
                $('#simpanan_ada_aoLabel').html("Ya");

            } else if ($(this).prop("checked") == false) {
                $('#smpn_adaAO_value').val('0');
                $('#simpanan_ada_aoLabel').html("Tidak");
            }
        });
    </script>
@endpush
