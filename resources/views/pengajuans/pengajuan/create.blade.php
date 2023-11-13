@extends('pengajuans.layouts_pengajuan.app')

@section('content')
    @include('pengajuans.layouts_pengajuan.headers.cards')

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Tables</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{route('pengajuan.index')}}">Setting</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pengajuan</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                                                <div class="card-title">
                                                    <h3 class=" title-2">Biodata Diri</h3>
                                                </div>
                                <div class="col-12">
                                    <form action="" method="post">
                                        @csrf
                                        <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">NIK</label>
                                            <input type="text" name="nik" class="form-control" >
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nama</label>
                                            <input type="text" name="nama" class="form-control" >
                                        </div>
                                        </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="email" name="email" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Tgl Lahir</label>
                                                    <input type="date" name="tgl_lahir" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">No Telp</label>
                                                    <input type="text" name="no_telp" class="form-control" >
                                                </div>
                                            </div>
{{--                                            textarea--}}
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Alamat</label>
                                                    <textarea name="alamat" id="" cols="10" rows="3" class="form-control" ></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Bumdes</label>
                                                    <input type="text" name="bumdes" class="form-control" >
                                                </div>
                                            </div>


{{--                                            card title--}}
                                            <div class="col-md-12">
                                            <div class="card-title">
                                                <h3 class=" title-2">Info Margin</h3>
                                            </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Plafon</label>
                                                    <input hidden type="text" name="plafon"  id="plafon" class="form-control " >
                                                    <input type="text" name="plafon_text" id="plafon_text" class="form-control " >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Pendapatan</label>
                                                    <input type="text" name="pendapatan" hidden id="pendapatan" class="form-control" >
                                                    <input type="text" name="pendapatan_text" id="pendapatan_text" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Pengeluaran</label>
                                                    <input type="text" name="pengeluaran" hidden id="pengeluaran" class="form-control" >
                                                    <input type="text" name="pengeluaran_text" id="pengeluaran_text" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Margin</label>
                                                    <input type="text" name="margin" id="margin" hidden class="form-control" value="{{$margin->margin ?? ''}}">
                                                    <select name="durasi" id="durasi" class="form-control">
                                                        <option value=""></option>
                                                        @foreach($durasi as $d)
                                                            <option value="{{$d->id}}" data-durasi="{{$d->durasi}}">{{$d->durasi}} Bulan</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
{{--                                            Button hitung--}}
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <a href="#" id="hitung" class="btn btn-primary">Hitung </a> <span>Rasio {{$rasio->rasio ?? ''}} % & Margin {{$margin->margin ?? ''}}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Angsuran At-taqwa</label>
                                                    <input type="text" name="angsuran" hidden id="angsuran" class="form-control"  readonly>
                                                    <input type="text" name="angsuran_text" id="angsuran_text" class="form-control"  readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">total Pengeluaran</label>
                                                    <input type="text" name="total_pengeluaran" hidden id="total_pengeluaran" class="form-control" readonly>
                                                    <input type="text" name="total_pengeluaran_text" id="total_pengeluaran_text" class="form-control" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Sisa Dana</label>
                                                    <input type="text" name="sisa_dana" hidden id="sisa_dana" class="form-control" readonly>
                                                    <input type="text" name="sisa_dana_text" id="sisa_dana_text" class="form-control" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Rasio</label>
                                                    <input type="text" name="rasio" id="rasio" class="form-control" readonly>
                                                    <input type="text" name="status" id="status" class="form-control" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                        <div class="form-group text-center">
                                            <button class="btn btn-info btn-lg">Simpan</button>
                                        </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                    </div>

                    </div>
                    </div>


            </div>
        </div>
        <!-- Footer -->
    </div>

    @include('pengajuans.layouts_pengajuan.footers.auth')
@endsection

@push('js')
{{--    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>--}}
{{--    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>--}}
{{--cdn jquery  --}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8-beta.17/inputmask.es6.js" integrity="sha512-G307IbFqmfwXgQa2Jbxp4+4HeTp++lVOXNsNadeRIVqBsltSJgpprtBaz2GTs8WBq+KfxUJwfTGSvGV/Xd5AnQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}

{{--<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>--}}
{{--cdn input mask--}}

    <script>

        $(document).ready(function(){
            $('#plafon_text').on('keyup',function(){
                $('#plafon_text').mask("#,##0", {reverse: true});
                test_value = $(this).val().replace(/[^0-9]+/g, "");
                $('#plafon').val(test_value)
            })
            $('#pendapatan_text').on('keyup',function(){
                $('#pendapatan_text').mask("#,##0", {reverse: true});
                test_value = $(this).val().replace(/[^0-9]+/g, "");
                $('#pendapatan').val(test_value)
            })
            $('#pengeluaran_text').on('keyup',function(){
                $('#pengeluaran_text').mask("#,##0", {reverse: true});
                test_value = $(this).val().replace(/[^0-9]+/g, "");
                $('#pengeluaran').val(test_value)
            })
            // $('.rupiah').inputmask('decimal', {allowMinus:false, autoGroup: true, groupSeparator: '.', rightAlign: false, autoUnmask: true, removeMaskOnSubmit: true});

            $('#hitung').click(function(){
                var pendapatan = $('#pendapatan').val();
                var pengeluaran = $('#pengeluaran').val();
                var plafon = $('#plafon').val();
                var margin = $('#margin').val();
                // var durasi = $('#durasi').val();
                var durasi = $('#durasi').attr('durasi');
                alert(durasi);
                var setting_rasio = {{$rasio->rasio}};
                var angsuran = plafon * (margin/100) / durasi;
                var total_pengeluaran = pengeluaran * (margin/100) / durasi;
                var sisa_dana = pendapatan - total_pengeluaran;
                if(sisa_dana > pendapatan * (setting_rasio/100)){
                    $('#rasio').val('Disetujui');
                    $('#status').val('Disetujui');
                }else{
                    $('#rasio').val('Tidak Disetujui');
                    $('#status').val('Tidak Disetujui');
                }
                console.log(angsuran);
                console.log(total_pengeluaran);
              var angsuran_value  $('#angsuran').val(angsuran);
                var value_pengeluaran = new Intl.NumberFormat().format(angsuran_value);
                $('#angsuran_text').val(value_pengeluaran);

               var pengeluaran_total $('#total_pengeluaran').val(total_pengeluaran);
                var value_pengeluaran = new Intl.NumberFormat().format(pengeluaran_total);
                $('#total_pengeluaran_text').val(value_pengeluaran);

                var dana =  $('#sisa_dana').val(sisa_dana);
                var tot = new Intl.NumberFormat().format(dana);
                $('#sisa_dana_text').val(tot);
            });
        });
    </script>
@endpush
