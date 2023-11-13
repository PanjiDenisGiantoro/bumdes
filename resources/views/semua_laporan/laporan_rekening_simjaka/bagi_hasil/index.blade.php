@extends('layouts.app')

@section('breadcrumb')
<x-breadcrumb title="{{ __('Detail Keanggotaan') }}">
    <li class="breadcrumb-item">
        <a href="{{ route('semua_laporan.index') }}">{{ __('Laporan') }}</a>
    </li>
    <li class="breadcrumb-item">
        {{ __('Detail Keanggotaan') }}
    </li>
</x-breadcrumb>
@endsection

@section('content')

<div class="container">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="components-preview wide-md mx-auto">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-head-sub">
                        <span>Laporan Simpanan</span>
                    </div>
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Laporan Distribusi Bagi Hasil</h3>
                        </div>
                    </div>
                </div>
                <form>
                    <div class="card card-preview">

                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-tools">
                                    <div class="row p-3">
                                            <div class="col-sm-6">
                                                <select name="month" class="form-select form-control" data-search="off" data-placeholder="Bulan" tabindex="-1">
                                                    <option value="">Bulan</option>
                                                    @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}" {{ request()->query('month') == $i ? ' selected="selected"' : null }}>
                                                        {{ \Carbon\Carbon::create()->day(1)->month($i)->locale('id')->monthName }}
                                                    </option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <button id="searchNama_btn" class="btn btn-info">Cari</button>
                                                <a class="btn btn-success" style="margin-right:7px" href="#">
                                                    <i class="fa fa-file-excel-o">&nbsp;</i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>

                       {{-- @if ($distribusiBagiHasil->count() > 0)
                    <div class="card-inner">
                        @include('tenants.admin.laporan_simpanan.bagi-hasil.index_xlsx')
                    </div>
                    @endif --}}
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7-beta.19/jquery.inputmask.min.js"></script>
<script>
$(document).ready(function () {
    $(":input").inputmask()
});
</script>
@endsection
