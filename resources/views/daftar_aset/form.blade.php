@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">Daftar Aset</h3>
    <br>
{{--    <x-breadcrumb title="{{ __('Informasi Aset') }}">--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('daftar_aset.index') }}">{{ __('Aset Mgmt.') }}</a>--}}
{{--        </li>--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('daftar_aset.index') }}">{{ __('Daftar Aset') }}</a>--}}
{{--        </li>--}}
{{--        <li class="breadcrumb-item">--}}
{{--            {{ __('Tambah Informasi Aset') }}</a>--}}
{{--        </li>--}}
{{--    </x-breadcrumb>--}}
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Informasi Aset') }}</h5>

                <form method="POST" class="form-horizontal"
                      action="{{ !empty($daftar_aset->id) ? route('daftar_aset.update', [$daftar_aset->id]) : route('daftar_aset.store') }}">

                    @if (!empty($daftar_aset->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label" for="tanggal_input">Tanggal Input</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="tanggal_input"
                                                   id="tanggal_input" disabled
                                                   value="{{ !empty($assetData) ? $assetData->created_at : '' }}">
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label"
                                                   for="id_kode_kelompok_aset">{{ __('Nama Kelompok Aset') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="id_kode_kelompok_aset" id="id_kode_kelompok_aset"
                                                    class="form-control">
                                                @foreach($kelompokaset as $data)
                                                    <option value="{{$data->id}}"
                                                            @if($daftar_aset->id ?? '' == $data->id)selected @endif>{{$data->kelompok_aset}}</option>
                                                @endforeach
                                            </select>
                                            @error('nama_aset')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label"
                                                   for="jumlah_aset">{{ __('Jumlah Aset') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                value="{{$daftar_aset->jumlah_aset ?? ''}}"
                                                id="jumlah_aset"
                                                name="jumlah_aset"
                                                type="text"
                                                class="form-control"

                                            />
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label"
                                                   for="nama_aset">{{ __('Nama Aset') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                value="{{$daftar_aset->nama_aset ?? ''}}"
                                                id="nama_aset"
                                                name="nama_aset"
                                                type="text"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('nama_aset')])

                                            />
                                            @error('nama_aset')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label"
                                                   for="nomor_aset">{{ __('Nomor Aset') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input
                                                value="{{$daftar_aset->nomor_aset ?? ''}}"
                                                id="nomor_aset"
                                                name="nomor_aset"
                                                type="text"
                                                class="form-control"

                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label"
                                                   for="tanggal_akuisisi">{{ __('Tanggal Akuisisi') }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input
                                                value="{{$daftar_aset->tanggal_akuisisi ?? ''}}"

                                                id="tanggal_akuisisi"
                                                name="tanggal_akuisisi"
                                                type="date"
                                                @class(['required', 'form-control', 'is-invalid' => $errors->has('tanggal_akuisisi')])
                                            />
                                            @error('tanggal_akuisisi')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label form-label"
                                                   for="biaya_akuisisi">{{ __('Biaya Akuisisi') }}</label>
                                        </div>
                                        <div class="col-md-3">

                                            <input type="text" class="form-control rupiah" name="biaya_akuisisi"
                                                   id="biaya_akuisisi" required
                                                   value="{{ $daftar_aset->biaya_akuisisi ?? ''}}"
                                                   data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'"
                                                {{ !empty($daftar_aset->id) ? $daftar_aset->biaya_akuisisi== '1' ? 'disabled' : '' : '' }}>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label"
                                                   for="akun_aset_tetap">{{ __('Akun Aset Tetap') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select name="akun_aset_tetap" class="form-control select2"
                                                    data-placeholder="{{ __('Pilih Akun Aset Tetap') }}"
                                                    data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Akun Aset Tetap') }}</option>
                                                @foreach($akun as $akuns)
                                                    <option value="{{$akuns->id}}"
                                                            @if(!empty($daftar_aset->id) ? $akuns->id == $daftar_aset->akun_aset_tetap : '' )selected @endif>
                                                        {!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $akuns->depth) !!}{{ $akuns->kode }} &mdash; {{ $akuns->nama }}</option>
                                                @endforeach
                                                >
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label"
                                                   for="akun_kredit">{{ __('Akun Dikreditkan') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select name="akun_kredit" class="form-control select2"
                                                    data-placeholder="{{ __('Pilih Akun Dikreditkan') }}"
                                                    data-minimum-results-for-search="Infinity">
                                                <option value="">{{ __('Pilih Akun Dikreditkan') }}</option>
                                                @foreach($akun as $akuns)
                                                    <option value="{{$akuns->id}}"
                                                            @if(!empty($daftar_aset->id) ? $akuns->id == $daftar_aset->akun_kredit : '' )selected @endif>
                                                        {!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $akuns->depth) !!}{{ $akuns->kode }} &mdash; {{ $akuns->nama }}</option>
                                                @endforeach
                                                @error('akun_kredit')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>





                        <h3 class="card-title">{{ __('Informasi Penyusutan')}}</h3>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label"
                                           for="disusutkan">{{ __('Disusutkan') }}</label>
                                </div>
                                <div class="col-md-4" style="font-size: 15px">
                                    <input type="radio" name="disusutkan" value="1"
                                           @if(!empty($daftar_aset->id) ? $daftar_aset->disusutkan == '1' : '')checked @endif>
                                    Disusutkan <br>
                                    <input type="radio" name="disusutkan" value="0"
                                           @if(!empty($daftar_aset->id) ? $daftar_aset->disusutkan == '0' : '')checked @endif>
                                    Tidak Disusutkan<br>
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label"
                                           for="nilai">{{ __('Keterangan') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <textarea
                                        id="keterangan"
                                        name="keterangan"
                                        class="required form-control"
                                        rows="10"
                                        cols="30"
                                        placeholder="Keterangan"
                                        required>{{$daftar_aset->keterangan ?? ''}}</textarea>
                                    @error('nilai')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label"
                                           for="akun_beban_penyusutan">{{ __('Akun Beban Penyusutan') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <select name="akun_beban_penyusutan" class="form-control select2"
                                            data-placeholder="{{ __('Pilih Akun Beban Penyusutan') }}"
                                            data-minimum-results-for-search="Infinity">
                                        <option value="">{{ __('Pilih Akun Beban Penyusutan') }}</option>
                                        {{--                                                    <option value="">&nbsp;</option>--}}
                                        @foreach($akun as $gl)
                                            <option value="{{$gl->id}}"
                                                    @if(!empty($produk_pembiayaan->akun_beban_penyusutan) ? $produk_pembiayaan->akun_beban_penyusutan == $gl->id : '')selected @endif>
                                                {{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label"
                                           for="akun_akumulasi_penyusutan">{{ __('Akun Akumulasi Penyusutan') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <select name="akun_akumulasi_penyusutan" class="form-control select2"
                                            data-placeholder="{{ __('Pilih Akun Akumulasi Penyusutan') }}"
                                            data-minimum-results-for-search="Infinity">
                                        {{--                                                    <option value="">{{ __('Pilih Akun Akumulasi Penyusutan') }}</option>--}}
                                        <option value="">&nbsp;</option>
                                        @foreach($akun as $gl)
                                            <option value="{{$gl->id}}"
                                                    @if(!empty($produk_pembiayaan->akun_akumulasi_penyusutan) ? $produk_pembiayaan->akun_akumulasi_penyusutan == $gl->id : '')selected @endif>
                                                {{ $gl->kode }} &mdash; {{ $gl->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>



                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label form-label"
                                           for="nilai">{{ __('Masa Manfaat ( Bulan )') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input
                                        value="{{$daftar_aset->nilai ?? ''}}"

                                        id="nilai"
                                        name="nilai"
                                        type="text"
                                        @class(['required', 'form-control', 'is-invalid' => $errors->has('nilai')])
                                        value="{{ old('nilai') }}"
                                    />
                                    @error('nilai')
                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <a id="calculate_btn" class="btn btn-outline-primary btns">Hitung</a>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-4">
                                <div class="form-group"><!-- //auto calculate -->
                                    <label class="form-label" for="akhir_masa_manfaat">Akhir Waktu Manfaat</label>
                                    <input type="text" class="form-control" id="akhir_masa_manfaat"
                                           value="{{$daftar_aset->akhir_masa_manfaat ?? ''}}" name="akhir_masa_manfaat"
                                           readonly>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group"><!-- //auto calculate -->
                                    <label class="form-label" for="perbedaan_bulan">Perbedaan Bulan Semasa</label>
                                    <input type="text" class="form-control" name="perbedaan_bulan" id="perbedaan_bulan"
                                           value="{{$daftar_aset->perbedaan_bulan ?? ''}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-label" for="penyusutan_bulanan">Penyusutan Per Bulan</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-sign-idr"></em>
                                        </div>
                                        <input type="text" class="form-control" name="penyusutan_bulanan"
                                               id="penyusutan_bulanan"
                                               value="{{$daftar_aset->penyusutan_bulanan ?? ''}}"
                                               data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'"
                                               readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-label" for="total_penyusutan">Total Akumulasi Susutan</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-sign-idr"></em>
                                        </div>
                                        <input type="text" class="form-control"
                                               value="{{$daftar_aset->total_penyusutan ?? ''}}" name="total_penyusutan"
                                               id="total_penyusutan"
                                               data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'"
                                               readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-label" for="perkiraan_akhir_buku">Perkiraan akhir buku</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-sign-idr"></em>
                                        </div>
                                        <input type="text" class="form-control"
                                               value="{{$daftar_aset->perkiraan_akhir_buku ?? ''}}"
                                               name="perkiraan_akhir_buku" id="perkiraan_akhir_buku"
                                               data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'"
                                               readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border border-top-0 text-right">
                        <a href="{{ route('daftar_aset.index') }}" class="btn btn-primary"
                           style="background-color: red">{{ __('Batal') }}</a>
                    <!-- <button type="{{ route('daftar_aset.index') }}" class="btn btn-primary" style="background-color: red"> Batal</button> -->
                        <button type="submit"
                                class="btn btn-primary">{{ !empty($anggota->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7-beta.19/jquery.inputmask.min.js"></script>
    <script>
        // $('.rupiah').inputmask('decimal', {
        //     allowMinus: false,
        //     autoGroup: true,
        //     groupSeparator: '.',
        //     rightAlign: false,
        //     autoUnmask: true,
        //     removeMaskOnSubmit: true
        // });
        $('select').select2();

        var category = null;
        $("input[name='disusutkan']").change(function () {
            category = this.value;
            if (category == '0') {
                $('#calculate_btn').hide();
                $('#nilai').attr('disabled', 'disabled');
            }
            if (category == '1') {
                $('#calculate_btn').show();
                $('#nilai').removeAttr('disabled');
            }
        });
        let tanggal_hari_ini = moment().format('DD-MM-YYYY');
        const formatter = new Intl.NumberFormat('MS', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        });

        $(document).ready(function () {
            $('#tanggal_input').val(tanggal_hari_ini);

            $('#calculate_btn').on('click', function () {
                let tanggal_perolehan = $('#tanggal_akuisisi').val();

                var format_one = moment(tanggal_perolehan).format('DD-MM-YYYY');

                let tanggal_perolehan_convert = moment(format_one, 'DD-MM-YYYY');// TODO: Anchor: convert date format
                console.log(tanggal_perolehan_convert)

                let taksiranMasa = $('#nilai').val();
                let taksiranMasaAltered = parseInt(taksiranMasa) + 1;

                let akhirManfaat = moment(tanggal_perolehan_convert).add(taksiranMasaAltered, 'months').format('DD-MM-YYYY'); // Add 1 bulan for every akhirmanfaat
                $('#akhir_masa_manfaat').val(akhirManfaat);
                $('#akhirMasaManfaat_value').val(akhirManfaat);


                console.log("-----------------------");
                console.log("Tanggal Perolehan : " + format_one);
                console.log("Tanggal Perolehan convert : " + tanggal_perolehan_convert);
                console.log("-----------------------");
                console.log("Entered Taksiran Masa : " + taksiranMasa);
                console.log("Entered Taksiran Masa Altered: " + taksiranMasaAltered);
                console.log("-----------------------");
                console.log("Akhir masa manfaat : " + akhirManfaat);

                // calculate susutan bulanan
                // let hargaPerolehan = $('#biaya_akuisisi').val().replace(/,/g, "");
                let hargaPerolehan = $('#biaya_akuisisi').val();
                let susutanBulanan = hargaPerolehan / taksiranMasa;
                $('#penyusutan_bulanan').val(susutanBulanan);
                $('#penyusutanBulanan_value').val(susutanBulanan);
                // console.log("-----------------------");
                // console.log("Harga Perolehan : " + hargaPerolehanTemp);
                console.log("-----------------------");
                console.log("Susutan bulanan : " + formatter.format(susutanBulanan));

                let startOfMonth = moment(tanggal_perolehan_convert).startOf('month').format('DD-MM-YYYY');
                console.log("startOfMonth : " + startOfMonth);

                let perolehanStartOfMonth = moment(tanggal_perolehan_convert).startOf('month');
                let diffOfMonth = moment().diff(moment(perolehanStartOfMonth), 'months', true);
                let monthDifference = Math.floor(diffOfMonth);
                console.log("Perbezaan bulan : " + monthDifference);
                $('#perbedaan_bulan').val(monthDifference);

                let jumlahSusutan = monthDifference * susutanBulanan;
                $('#total_penyusutan').val(jumlahSusutan);
                $('#totalPenyusutan_value').val(jumlahSusutan);
                let akhirbuku = hargaPerolehan - jumlahSusutan;
                $('#perkiraan_akhir_buku').val(akhirbuku);
                $('#perkiraanAkhirBuku_value').val(akhirbuku);
            });


        });
    </script>


@endpush
