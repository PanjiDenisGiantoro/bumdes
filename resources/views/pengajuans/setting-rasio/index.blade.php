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
                                <li class="breadcrumb-item"><a href="{{route('setting_rasio.index')}}">Setting</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Rasio</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-6 mb-5 mb-xl-0">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Rasio & Margin</h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
{{--                            <tr>--}}
{{--                                <th scope="col" class="sort" data-sort="name">Rasio</th>--}}
{{--                                <th scope="col"></th>--}}
{{--                            </tr>--}}
                            </thead>
                            <tbody class="list">
                            <th>
                                @foreach($rasio as $rasios)
                                <tr>
                                    <td class="budget">
                                        <span class="name">Rasio</span>
                                        <span class="value">{{$rasios->rasio ?? ''}} %</span>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="#editModal{{$rasios->id}}" data-toggle="modal">Edit</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                    <div class="modal fade" id="editModal<?php echo $rasios->id;?>" role="dialog">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2>Edit Rasio</h2>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <form class="form-horizontal" method="post" action="{{route('setting_rasio.store')}}">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            @csrf
{{--                                                            <input type="text" value="<?php echo $rasios->id;?>" name="id" hidden>--}}
                                                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                                                <label>Rasio</label>
                                                                <input type="text" placeholder="Tulis Rasio" name="rasio" class="form-control" value="{{$rasios->rasio ?? ''}}">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="id" value="{{$rasios->id}}">
                                                        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                                        <button type="submit" class="btn btn-success">Edit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </th>
                            <th>
                                @foreach($margin as $margins)
                                    <tr>
                                        <td class="budget">
                                            <span class="name">Margin</span>
                                            <span class="value">{{$margins->margin ?? ''}} %</span>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="#editModalmargin{{$margins->id}}" data-toggle="modal">Edit</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editModalmargin<?php echo $margins->id;?>" role="dialog">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2>Edit margin</h2>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <form class="form-horizontal" method="post" action="{{route('margin.store')}}">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            @csrf
                                                            {{--                                                            <input type="text" value="<?php echo $margins->id;?>" name="id" hidden>--}}
                                                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                                                <label>Margin</label>
                                                                <input type="text" placeholder="Tulis Margin" name="margin" class="form-control" value="{{$margins->margin ?? ''}}">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="id" value="{{$margins->id}}">
                                                        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                                        <button type="submit" class="btn btn-success">Edit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </th>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 mb-5 mb-xl-0">
                <div class="card">
                    <!-- Card header -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-header border-0">
                                <h3 class="mb-0">Durasi</h3>
                                {{--                        button right--}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-header border-0">
                                <a href="#addModal" data-toggle="modal" class="btn btn-primary float-right">Tambah</a>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="addModal" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2>Tambah Durasi</h2>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <form class="form-horizontal" method="post" action="{{route('durasi.store')}}">
                                    <div class="modal-body">
                                        <div class="row">
                                            @csrf
                                            {{--                                                            <input type="text" value="<?php echo $rasios->id;?>" name="id" hidden>--}}
                                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                                <label>Durasi (Bulan)</label>
                                                <input type="text" placeholder="Tulis Durasi" name="durasi" class="form-control" value="{{$durasis->durasi ?? ''}}">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                        <button type="submit" class="btn btn-success">Edit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">

                            {{--                            <tr>--}}
                            {{--                                <th scope="col" class="sort" data-sort="name">Rasio</th>--}}
                            {{--                                <th scope="col"></th>--}}
                            {{--                            </tr>--}}
                            </thead>
                            <tbody class="list">
                            <th>
                                @foreach($durasi as $durasis)
                                    <tr>
                                        <td class="budget">
                                            <span class="name">Durasi</span>
                                            <span class="value">{{$durasis->durasi ?? ''}} Bulan</span>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="#editModaldudrasi{{$durasis->id}}" data-toggle="modal">Edit</a>
                                                    <a class="dropdown-item" href="#delModal3{{$durasis->id}}" data-toggle="modal">Hapus</a>

                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="delModal3<?php echo $durasis->id;?>" role="dialog">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2>Hapus Durasi</h2>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <form class="form-horizontal" method="post" action="{{route('durasi.destroy',$durasis->id)}}">
                                                    @method('delete')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p>Anda yakin mau menghapus <b><?php echo  $durasis->durasi;?></b></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="id" value="<?php echo $durasis->id;?>">
                                                        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="editModaldudrasi<?php echo $durasis->id;?>" role="dialog">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2>Edit Durasi</h2>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <form class="form-horizontal" method="post" action="{{route('durasi.update',$durasis->id)}}">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            @method('PUT')
                                                            @csrf
                                                            {{--                                                            <input type="text" value="<?php echo $rasios->id;?>" name="id" hidden>--}}
                                                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                                                <label>Durasi (Bulan)</label>
                                                                <input type="text" placeholder="Tulis Durasi" name="durasi" class="form-control" value="{{$durasis->durasi ?? ''}}">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="id" value="{{$durasis->id}}">
                                                        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                                        <button type="submit" class="btn btn-success">Edit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </th>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->

@include('pengajuans.layouts_pengajuan.footers.auth')

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
