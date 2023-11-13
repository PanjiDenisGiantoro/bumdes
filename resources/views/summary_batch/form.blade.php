@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Register Batch Baru') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('summary_batch.index') }}">{{ __('Daftar Batch') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Batch Baru') }}</a>
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Informasi Batch Baru') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($summary_batch->id) ? route('summary_batch.update', [$summary_batch]) : route('summary_batch.store') }}">

                    @if (!empty($summary_batch->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group clearfix">
                                    <label class="control-label form-label" for="sumber_pendanaan">{{ __('Sumber Pendanaan') }}</label>
                                    <select id="sumber_pendanaan" name="sumber_pendanaan" class="form-select" data-placeholder="Pilih pendana...">
                                        <option value=""></option>
                                        @foreach($daftarPendana as $pendana)
                                        <option value="{{ $pendana->id }}">{{ $pendana->nama_pendana ?? '-' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                                
                            <div class="col-md-3">
                                <label class="form-label">No. Batch</label>
                                <input type="number" class="form-control" id="batch" name="batch" readonly>
                            </div>

                            
                            
                            <!-- <div class="col-3">
                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label form-label" for="no_batch">{{ __('Sumber Pendanaan') }}</label>
                                            <input id="sumber_pendanaan" name="sumber_pendanaan" type="text" class="form-control"/>
                                        </div>   
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">Dana Per Anggota</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control nominal" id="nominal_dana" name="nominal_dana" placeholder="500.000...">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Margin / Bagi Hasil (%)</label>
                                    <input type="number" id="interest_percentage" class="form-control" >
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Total Margin / Bagi Hasil</label>
                                    <input type="number" id="total_interest" name="interest" class="form-control" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Jangka Waktu (bulan)</label>
                                    <input type="number" class="form-control" id="jangka_waktu" name="jangka_waktu">
                                </div>
                            </div>
                        </div>
                        
                        <a id="hitung_pendanaan_btn" class="btn btn-outline-primary">{{ __('Hitung') }}</a>

                        <br>
                        <br>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">Plafond Pembiayaan</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="number" class="form-control nominal" id="plafond_pembiayaan" name="plafond_pembiayaan" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">Angsuran Pokok</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control nominal" id="angsuran_pokok" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Angsuran Margin</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control nominal" id="angsuran_margin" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Kewajiban Angsuran</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control nominal" id="kewajiban_angsuran" name="kewajiban_angsuran" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="form-group clearfix">
                            <h3 class="card-title">Rekening Penampung Pembiayaan</h3>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group clearfix">
                                        <label class="control-label form-label" for="gl_pembiayaan_pendanaan">{{ __('GL Pendanaan') }}</label>
                                        <select id="gl_pembiayaan_pendanaan" name="gl_pembiayaan_pendanaan" class="form-select" data-placeholder="Akun perkiraan...">
                                            <option value=""></option>
                                            @foreach($coaList as $coa)
                                            <option value="{{ $coa->id }}">{{ $coa->kode }} &mdash; {{ $coa->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="form-group clearfix">
                                        <label class="control-label form-label" for="nama_pembiayaan">{{ __('Nama Pembiayaan Pendanaan') }}</label>
                                        <input type="text" class="form-control" id="nama_pembiayaan" name="nama_pembiayaan" placeholder="">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group clearfix">
                                        <label class="control-label form-label" for="gl_pendapatan_koperasi">{{ __('GL Pendapatan Koperasi') }}</label>
                                        <select id="gl_pendapatan_koperasi" name="gl_pendapatan_koperasi" class="form-select" data-placeholder="Akun perkiraan...">
                                            <option value=""></option>
                                            @foreach($coaList as $coa)
                                            <option value="{{ $coa->id }}">{{ $coa->kode }} &mdash; {{ $coa->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="form-group clearfix">
                                        <label class="control-label form-label" for="biaya_pendapatan_koperasi">{{ __('Pendapatan Koperasi') }}</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="text" id="biaya_pendapatan_koperasi" name="biaya_pendapatan_koperasi" class="form-control nominal"> 
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-4">
                                </div> -->

                                <div class="col-3">
                                    <div class="form-group clearfix">
                                        <label class="control-label form-label" for="gl_admin_pendana">{{ __('GL Admin Pendana') }}</label>
                                        <select id="gl_admin_pendana" name="gl_admin_pendana" class="form-select" data-placeholder="Akun perkiraan...">
                                            <option value=""></option>
                                            @foreach($coaList as $coa)
                                            <option value="{{ $coa->id }}">{{ $coa->kode }} &mdash; {{ $coa->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="form-group clearfix">
                                        <label class="control-label form-label" for="biaya_admin_pendana">{{ __('Admin Pendana') }}</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="text" id="biaya_admin_pendana" name="biaya_admin_pendana" class="form-control nominal"> 
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-4">
                                </div> -->
                                
                                <div class="col-3">
                                    <div class="form-group clearfix">
                                        <label class="control-label form-label" for="gl_hutang_margin">{{ __('GL Titipan Pendana') }}</label>
                                        <select id="gl_hutang_margin" name="gl_hutang_margin" class="form-select" data-placeholder="Akun perkiraan...">
                                            <option value=""></option>
                                            @foreach($coaList as $coa)
                                            <option value="{{ $coa->id }}">{{ $coa->kode }} &mdash; {{ $coa->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="form-group clearfix">
                                        <label class="control-label form-label" for="biaya_hutang_margin">{{ __('Titipan Pendana') }}</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="text" id="biaya_hutang_margin" name="biaya_hutang_margin" class="form-control nominal"> 
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-4">
                                </div> -->
                            </div>

                            <br>
                            <h3 class="card-title">Rekening Penampung Simpanan</h3>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group clearfix">
                                        <label class="control-label form-label" for="rekening_simpanan_id">{{ __('Rekening Simpanan') }}</label>
                                        <select id="rekening_simpanan_id" name="rekening_simpanan_id" class="form-select" data-placeholder="Rekening simpanan...">
                                            <option value=""></option>
                                            @foreach($produkSimpanan as $simpanan)
                                            <option value="{{ $simpanan->id }}">{{ $simpanan->nama_simpanan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="col-6">
                                    <div class="form-group clearfix">
                                        <label class="control-label form-label" for="penampung_pembiayaan">{{ __('Rekening Pembiayaan') }}</label>
                                        <select id="penampung_pembiayaan" name="penampung_pembiayaan" class="form-select" data-placeholder="Rekening pembiayaan...">
                                            <option value=""></option>
                                            @foreach($produkPembiayaan as $pembiayaan)
                                            <option value="{{ $pembiayaan->id }}">{{ $pembiayaan->nama_pembiayaan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> -->
                            </div>
                            <br>
                            <br>
                        </div>
                     </div>
                    <div class="card-footer border border-top-0 text-right">
                        <a href="{{ route('summary_batch.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($anggota->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>

    $(document).ready(function() {

        $('select').select2();

        $(".nominal").inputmask('decimal', {
            'alias': 'numeric',
            'groupSeparator': ',',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ".",
            // 'digitsOptional': false,
            'allowMinus': false,
            'placeholder': '0.00',
            'rightAlign': false,
            'removeMaskOnSubmit': true,
            'onBeforeMask': function (value, opts) {
                return value;
            },
        });

        $('#interest_percentage').on('keyup change', function() {
            let input = $(this).val();
            // let side = 100 - input;
            if (input > 100) {
                let result = input.slice(0, 2);
                $('#interest_percentage').val(result);
            } else if (input < 0) {
                // let result = input.slice(0, 2);
                $('#interest_percentage').val(0);
                let result = input.slice(0, 1);
            }
        });


        $('#hitung_pendanaan_btn').on('click', function() {
            console.log("CLICKED");
            // $result = 

            let dana =  $('#nominal_dana').val().replace(/,/g, '');
            let margin = $('#interest_percentage').val();
            let jangka_waktu = $('#jangka_waktu').val();
            
            let totalMargin = dana * margin/100;

            console.log("Data :" + dana);
            console.log("margin :" + margin);
            console.log("jangka_waktu :" + jangka_waktu);
            console.log("plafond :" + totalMargin);
            
            $('#total_interest').val(totalMargin);
            $('#plafond_pembiayaan').val(parseFloat(dana) + parseFloat(totalMargin));

            $('#angsuran_pokok').val(parseFloat(dana) / parseFloat(jangka_waktu));
            $('#angsuran_margin').val(parseFloat(totalMargin) / parseFloat(jangka_waktu));
            $('#kewajiban_angsuran').val((parseFloat(dana) + parseFloat(totalMargin)) / parseFloat(jangka_waktu) );

        });


        $('#sumber_pendanaan').on('change', function() {
            let selected = $(this).val();
            if(selected) {
                $.ajax({
                    url: "{{ route('summary_batch.index') }}",
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: { id: selected },
                    success: function(response) {
                        if (response.results != '') {
                            $('#batch').val(response.results + 1);
                        }else{
                            $('#batch').val(1);
                        }
                    },
                });
            } else {
                $('#produk_id').empty();
                $('#pilihan_akad').empty();
                $('#nilai_setoran').val();
            }
        });

        // $(".nominal").inputmask('decimal', {
        //     'alias': 'numeric',
        //     'groupSeparator': ',',
        //     'autoGroup': true,
        //     'digits': 2,
        //     'radixPoint': ".",
        //     // 'digitsOptional': false,
        //     'allowMinus': false,
        //     'placeholder': '0.00',
        //     'rightAlign': false,
        // });


    })

</script>

@endpush
