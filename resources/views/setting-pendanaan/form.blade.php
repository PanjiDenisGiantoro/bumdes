@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Informasi Batch') }}">
        <!-- <li class="breadcrumb-item">
            <a href="{{ route('transaksi_keuangan.index') }}">{{ __('Keuangan') }}</a>
        </li> -->
        <li class="breadcrumb-item">
            <a href="{{ route('summary_batch.index') }}">{{ __('Summary Batch') }}</a>
        </li>
         <li class="breadcrumb-item">
            <a href="{{ route('setting-pendanaan.index') }}">{{ __('Setting Batch') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Tambah Batch') }}</a>
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Tambah Batch') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ !empty($pendana->id) ? route('setting-pendanaan.update', [$pendana->id]) : route('setting-pendanaan.store') }}">

                    @if (!empty($pendana->id))
                        @method('PUT')
                    @endif

                    @csrf

                    <div class="card-body">
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="form-label">Kode Pendana</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="kode_pendana" name="kode_pendana" placeholder="Kode pendana..." value="{{ !empty($pendana) ? $pendana->kode_pendana : '' }}" 
                                        {{ isset($viewMode) || !empty($pendana) ? 'readonly' : ''}}>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="form-label">Nama Pendana</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="nama_pendana" name="nama_pendana" placeholder="Nama pendana..." value="{{ !empty($pendana) ? $pendana->nama_pendana : '' }}"
                                    {{ isset($viewMode) ? 'readonly' : ''}}>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border border-top-0 text-right">
                    	<a href="{{ route('setting-pendanaan.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Batal') }}</a>
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


        $('#kode_pendana').on('change keyup', function() {
            var text = $(this).val();
            var textLength = $(this).val().length;

            $(this).val(text.replace(/[^0-9]/g, ''));

            if(textLength > 3){
                let result = text.substr(0, 3);
                $(this).val(result);
            }
        });
    })

</script>
@endpush
