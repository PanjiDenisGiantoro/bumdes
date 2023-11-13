@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Batch') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('summary_batch.index') }}">{{ __('Daftar Batch') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Informasi Batch') }}
        </li>
        {{--<li class="breadcrumb-item">
            {{ __('Batch') }} -@foreach($daftar as $daf) {{$daf[0]->batch}} @endforeach
        </li> --}}
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informasi Batch</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered border-top mb-0 ">
                                <tr>
                                    <th width="20%">Status</th>
                                    <!-- <td colspan="3" class="list-group-item-success">{{ $batch->pendana->nama_pendana }}</td> -->
                                    <td colspan="3">
                                        @if ($batch->status) 
                                            <span class="badge  badge-primary">{{ strtoupper($batch->status_text) }}</span>
                                        @else
                                            <span class="badge  badge-success">{{ strtoupper($batch->status_text) }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th width="20%">Pendana</th>
                                    <td width="40%">{{ $batch->pendana->nama_pendana }}</td>
                                    <th width="20%">Tanggal Dibuka</th>
                                    <td>{{ $batch->created_at->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Batch</th>
                                    <td>Batch {{ $batch->batch }}</td>
                                    <th>Tanggal Disetujui</th>
                                    <td>{{ !empty($batch->tanggal_kelulusan) ? $batch->tanggal_kelulusan->format('d-m-Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Dana Per Anggota</th>
                                    <td>Rp {{ number_format($batch->nominal_dana) }}</td>
                                    <th>Tanggal Jatuh Tempo</th>
                                    <td>{{ !empty($batch->tanggal_jatuh_tempo) ? $batch->tanggal_jatuh_tempo->format('d-m-Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Jangka Waktu</th>
                                    <td colspan='3'>{{ $batch->jangka_waktu }} Bulan</td>
                                </tr>
                                <tr>
                                    <th>Plafond Pembiayaan</th>
                                    <td>Rp {{ number_format($batch->plafond_pembiayaan) }}</td>
                                    <th>Total Margin</th>
                                    <td>Rp {{ number_format($batch->interest) }}</td>
                                </tr>
                                <tr>
                                    <th>Kewajiban Angsuran</th>
                                    <td colspan='3'>Rp {{ !empty($batch->angsuran_bulanan) ? number_format($batch->angsuran_bulanan) : '0.00' }}</td>
                                </tr>
                            </table>
                            <br>
                            <table class="table table-bordered border-top mb-0 ">
                                <tr>
                                    <th width="20%">Rekening Simpanan</th>
                                    <td>{{ $batch->produk_simpanan->nama_simpanan ?? '-' }}</td>
                                    <th width="20%">GL Rek. Simpanan</th>
                                    <td>{{ $batch->produk_simpanan->akun_perkiraans->kode ?? '-' }} - {{ $batch->produk_simpanan->akun_perkiraans->nama ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Rekening Pembiayaan</th>
                                    <td>{{ $batch->nama_pembiayaan }}</td>
                                    <th>GL Rek. Pembiayaan</th>
                                    <td>{{ $batch->coa_pembiayaan->kode ?? '-' }} - {{ $batch->coa_pembiayaan->nama ?? '-' }}</td>
                                </tr>
                            </table>
                            <br>
                            <br>
                            <table class="table table-bordered border-top mb-0 ">
                                <tr>
                                    <th width="20%">Bilangan Pengajuan</th>
                                    <td>{{ $batch->pengajuan_pendanaan->count() }} Pengajuan</td>
                                    <th width="22%">Total Amount Pengajuan</th>
                                    <td>Rp 
                                        {{ number_format($batch->pengajuan_pendanaan->reduce(function ($carry, $rek) {
                                            return $carry + $rek->batchs->nominal_dana;
                                        })) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Pengajuan Disetujui</th>
                                    <td>{{ $batch->approved }} Pengajuan</td>
                                    <th>Total Amount Disetujui</th>
                                    <td>Rp {{ !empty($batch->total_penyetujuan_dana) ? number_format($batch->total_penyetujuan_dana) : '0.00' }}</td>
                                </tr>
                            </table>
                            <br>
                            <br>
                            <br>
                            <!-- <a href="#" data-toggle="modal" data-target="#largeModal" class="btn btn-outline-success">Setuju Batch</a> -->
                            <a href="{{ route('summary_batch.index') }}" class="btn btn-outline-danger">
                                Kembali
                            </a>
                            @if (!$batch->status)
                                <a href="" data-toggle="modal" data-target="#approvalModal" class="btn btn-outline-success">Setuju Batch</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Pengajuan Anggota</h3>
                    <div class="card-options">
                    {{-- <a href="{{ route('summary_batch.export', [$batch->id]) }}" class="btn btn-outline-info">
                            <!-- <i class="fe fe-upload mr-2"></i>Cetak -->
                            <i class="fa fa-print mr-2"></i>Cetak Daftar Pengajuan
                        </a> --}}
                    @if($batch->pengajuan_pendanaan->count() > 0)
                        <a href="{{ route('summary_batch.export', [$batch->id]) }}" class="btn btn-outline-info">
                            <!-- <i class="fe fe-upload mr-2"></i>Cetak -->
                            <i class="fa fa-print mr-2"></i>Cetak Daftar Pengajuan Excel
                        </a>
                    @endif
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0" 
                        data-auto-responsive="true"
                        data-searching="true"
                        data-length-change="false"
                        data-paging="false"
                        data-info="false"
                        data-sort="false">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>{{ __('Nama') }}</th>
                                <th>{{ __('NIK') }}</th>
                                <th>{{ __('No Mitra') }}</th>
                                <th>{{ __('No Telepon') }}</th>
                                <th>{{ __('Wilayah Bumdes') }}</th>
                                <th>{{ __('Tempat') }}</th>
                                <th>{{ __('Keterangan Usaha') }}</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                            <tbody>
                            @foreach($batch->pengajuan_pendanaan as $i => $rekening)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $rekening->anggota->nama_pemohon ?? '-' }}</td>
                                <td>{{ $rekening->anggota->nik ?? '-' }}</td>
                                <td>{{ $rekening->anggota->no_mitra ?? '-' }}</td>
                                <td>{{ $rekening->anggota->no_hp ?? $rekening->anggota->no_telpon ?? '-' }}</td>
                                <td>{{ $rekening->anggota->bumdes ?? '-' }}</td>
                                <td>{{ $rekening->anggota->city->province_name ?? '-' }}</td>
                                <td>{{ $rekening->anggota->daftarwarung->bidangusaha->bidang_usaha ?? '-' }}</td>
                                <td>
                                  <a href="{{ route('daftar_pembiayaan.show', [$rekening->id]) }}" class="btn btn-outline-primary" target="_blank"><i class="fa fa-eye mr-2"></i>Lihat</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>


            

    </div>




    <!-- Approval Modal -->
    <div id="approvalModal" class="modal fade" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog col-lg-12" style="width: 90%" role="document">
            <div class="modal-content ">
                <div class="modal-header pd-x-20">
                    <h6 class="modal-title">Penyetujuan Dana Setiap Anggota</h6>
                    
                    <div class="card-options">
                        <div class="input-group">
                            <input id="modal_searchField" type="text" class="form-control form-control-sm" placeholder="KTP Anggota.." name="s">
                            <span class="input-group-btn ml-2">
                                <button class="btn btn-sm btn-primary" type="submit">
                                    <span class="fe fe-search"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-body pd-20">
                    <!-- <h5 class=" lh-3 mg-b-20"><a href="" class="font-weight-bold">Why We Use Electoral College, Not Popular Vote</a></h5>
                    <p class="">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. </p> -->

                <form id="approval_form" method="POST" class="form-horizontal" action="{{ route('summary_batch.approve', [$batch->id]) }}">
                    @method('PUT')
                    @csrf

                    <input type="text" hidden name="id" value="{{ $batch->id }}">
                    <input type="text" hidden name="rekening" id="approvalFormData">

                    <div class="table-responsive">
                        <table id="rekeningTableModal" class="table mb-0" 
                            data-auto-responsive="true"
                            data-searching="true"
                            data-length-change="false"
                            data-paging="false"
                            data-info="false"
                            data-sort="false">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>{{ __('Nama') }}</th>
                                    <th>{{ __('NIK') }}</th>
                                    <th>{{ __('No Mitra') }}</th>
                                    <th>{{ __('No Telepon') }}</th>
                                    <th>{{ __('Wilayah Bumdes') }}</th>
                                    <th>{{ __('Tempat') }}</th>
                                    <th>{{ __('Keterangan Usaha') }}</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                                <tbody>
                                @foreach($batch->pengajuan_pendanaan as $i => $rekening)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $rekening->anggota->nama_pemohon ?? '-' }}</td>
                                    <td>{{ $rekening->anggota->nik ?? '-' }}</td>
                                    <td>{{ $rekening->anggota->no_mitra ?? '-' }}</td>
                                    <td>{{ $rekening->anggota->no_hp ?? $rekening->anggota->no_telpon ?? '-' }}</td>
                                    <td>{{ $rekening->anggota->bumdes ?? '-' }}</td>
                                    <td>{{ $rekening->anggota->city->province_name ?? '-' }}</td>
                                    <td>{{ $rekening->anggota->daftarwarung->bidangusaha->bidang_usaha ?? '-' }}</td>
                                    <td>
                                        <label class="custom-switch">
                                            <input type="checkbox" class="custom-switch-input bg-azure" data-rekening="{{ $rekening->id }}" checked="">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description label" id="label_{{$rekening->id}}">DITERIMA</span>
                                        </label>
                                    {{--    <!-- <a href="{{ route('summary_batch.edit','$f->id') }}" class="btn btn-info fa fa-file-pdf-o"></a>
                                        <a href="{{ route('daftar_pembiayaan.edit','$f->id') }}" class="btn btn-danger fa fa-eye"></a> --> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
                    
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="button" id="approve_btn" class="btn btn-primary">Lanjut Penyetujuan</button>
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                    <button id="modal_closeBtn" type="button" class="btn btn-outline-danger">Cancel</button>
                </div>
            </div>
        </div><!-- modal-dialog -->
    </div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>

<script>


    var rekeningListApprovalOriginal = [];
    var rekeningListApproval = [];

    var totalPengajuanOri = '';
    
    $(document).ready(function() {
        
        // var totalPengajuan = {!! json_encode($batch->pengajuan_pendanaan->toArray()) !!};
        var totalPengajuan = {!! json_encode($batch->pengajuan_pendanaan) !!};
        totalPengajuanOri = totalPengajuan;

        $.each(totalPengajuan, function( index, value ) {
            rekeningListApprovalOriginal.push({
                id : value.id,
                approve : 1
            });
            rekeningListApproval.push({
                id : value.id,
                approve : 1
            });

            // totalPengajuan[index].push({
            //     approve : 1
            // })

        });



        var modalTable = $('#rekeningTableModal').dataTable({
            dom: 'lrt'
        });
        $("#modal_searchField").keyup(function() {
            modalTable.fnFilter(this.value);
        }); 

        
        $("input[type=checkbox]").click(function() {

            let selectedRekeningId = $(this).data('rekening');
            let target = '#label_' + selectedRekeningId;

            let val = '';
            if ($(this).prop("checked")) {
                val = '1';
                $(target).html('DITERIMA');

            } else {
                val = '0';
                $(target).html('DITOLAK');
            }
             

            for (let i = 0; i < rekeningListApproval.length; i++) {
                if (rekeningListApproval[i].id === selectedRekeningId) {
                    rekeningListApproval[i].approve = val;
                }
            }
        });

        $('#approve_btn').on('click', function() {
            Swal.fire({
                title: "Konfirmasi Penyetujuan",
                text: "Anda pasti mau konfirmasi dana anggota-anggota ini",
                icon: "success",
                showDenyButton: true,
                confirmButtonText: 'Lanjut',
                denyButtonText: "Cancel",

            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    
                    $('#approvalFormData').val(JSON.stringify(rekeningListApproval));
                    $('#approval_form').submit();
                    
                    // Swal.fire('Saved!', '', 'success')
                } else if (result.isDenied) {
                    // Swal.fire('not saved', '', 'info')
                }
            })
        });

        $('#modal_closeBtn').on('click', function() {
            $('input[type=checkbox]').prop('checked',true); 
            $('.label').html('DITERIMA');
            rekeningListApproval = rekeningListApprovalOriginal;
            $('#approvalModal').modal('toggle');
        });

        



    })

  
</script>
@endpush
