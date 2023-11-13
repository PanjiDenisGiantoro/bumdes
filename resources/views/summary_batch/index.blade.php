@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Daftar Batch') }}">
        <li class="breadcrumb-item">
            {{ __('Batch') }}
        </li>
    </x-breadcrumb>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">

                <div class="card-header justify-content-between">
                    <h3 class="card-title">Daftar Batch</h3>
                    <div class="card-options">
                        <a href="{{ route('summary_batch.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Batch</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th class="d-lg-none">&nbsp;</th>
                                <th>No</th>
                                <th>{{ __('Pendana') }}</th>
                                <th>{{ __('Batch') }}</th>
                                <th>{{ __('Plafond Anggota') }}</th>
                                <th>{{ __('Jangka Waktu') }}</th>
                                <th>{{ __('Jumlah Anggota') }}</th>
                                <th>{{ __('Jumlah Pengajuan') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($batches as $i => $batch)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $batch->pendana->nama_pendana ?? '-' }}</td>
                                <td>{{ $batch->batch ?? '-' }}</td>
                                <td>Rp {{ number_format($batch->nominal_dana) }}</td>
                                <td>{{ $batch->jangka_waktu }} Bulan</td>
                                <td>{{ $batch->pengajuan_pendanaan->count() }}</td>
                                <td>Rp
                                    {{ number_format($batch->pengajuan_pendanaan->reduce(function ($carry, $rek) {
                                        return $carry + $rek->batchs->nominal_dana;
                                    })) }}
                                </td>
                                <td>
                                    @if ($batch->status) 
										<span class="badge badge-pill badge-primary">{{ strtoupper($batch->status_text) }}</span>
                                    @else
										<span class="badge badge-pill badge-success">{{ strtoupper($batch->status_text) }}</span>
                                    @endif
                                    <!-- {{ $batch->status_text ?? '-' }} -->
                                </td>
                                <td class="actions">
                                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ route('summary_batch.show', $batch->id) }}"><i class="fa fa-eye"></i>&nbsp;&nbsp; Lihat</a></li>
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

{{--                    <tbody>
                         @php $no=1; @endphp
                         @foreach($group as $i => $ret)
                             <tr>
                                <td class="col-lg-none">{{$i}}</td>
                                <td>{{$ret[0]->batch ?? ''}}</td>
                                <td>{{\Carbon\Carbon::parse($ret[0]->tanggal_permohonan ?? '')->format('d M Y')}}</td>
                                <td>{{ $ret->round  ?? ''}} </td>
                                <td class="actions">
                                    @if($ret[0]->batchs->status ?? '' == 1)
                                        <button class="delete-modal  btn btn-warning">Selesai</button>
                                    @else
                                        <a href="{{ '#' }}" class="delete-modal  btn btn-danger" data-value="{{ $ret[0]->batch ?? '' }}" data-toggle="modal" data-target="#deleteonModal1{{$ret[0]->batch ?? ''}}">Buka</a>
                                        @endif
                                    <a href="{{ route('summary_batch.show',$ret[0]->batch ?? '') }}" class="btn btn-primary fa fa-eye" style="background-color: blue; font-size: 12px"></a>
                                </td>
                            </tr>
                             <div class="modal fade zoom" tabindex="-1" id="deleteonModal1{{$ret[0]->batch ?? '' }}">
                                 <div class="modal-dialog" role="document">
                                     <form action="{{ route('summary_batch.status',$ret[0]->batch ?? '')}}" method="GET" class="d-inline">
                                         @csrf

                                         <div class="modal-content">
                                             <div class="modal-body">
                                                 <center> <i class="fe fe-alert-circle fa-4x" style="color: red;"></i></center>
                                                 <br>
                                                 <center><h2>Notifikasi</h2></center>
                                                 <p style="text-align: center;font-size: 15px">Adakah Anda Ingin Melanjutkan Proses Ini ? </p>
                                                 <div class="text-center">
                                                     <button type="submit" class="btn btn-md btn-primary mr-3" name="deleteBtn1">
                                                         &nbsp; Ya &nbsp;
                                                     </button>
                                                     <a data-dismiss="modal" href="#" class="btn btn-md btn-danger">
                                                         Tidak
                                                     </a>
                                                 </div>
                                             </div>
                                         </div>
                                     </form>
                                 </div>
                             </div>
                             @endforeach
                        </tbody>--}}



                    </table>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(document).ready(function (e) {
            $(document).on("click", ".delete-modal", function (e) {
                var delete_id = $(this).attr('data-value');
                $('button[name="deleteBtn1"]').val(delete_id);
            });
        });
    </script>

@endpush

