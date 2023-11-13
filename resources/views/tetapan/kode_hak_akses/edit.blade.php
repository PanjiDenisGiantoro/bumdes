@extends('layouts.app')

@section('breadcrumb')
<h3 class="card-header">{{ __('Hak Akses') }}</h3>
<br>
    <!-- <x-breadcrumb title="{{ __('Setting Hak Akses') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Pengaturan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('kode_hak_akses.index') }}">{{ __('Hak Akses') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Setting Hak Akses') }}</a>
        </li>
    </x-breadcrumb> -->
@endsection

@section('content')

    @php
        $rolePermissions = $permissions->toArray();
        $grouped = $permissions->groupBy(function ($item, $key) {
          return substr($item->name, 0, strpos($item->name, '.'));
        });

    @endphp
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card border-0 m-b-20">
                <h5 class="card-header">{{ __('Setting Hak Akses') }}</h5>

                <form method="POST" class="form-horizontal" action="{{ route('kode_hak_akses.update', $role->id)}}">

                    @if (!empty($role->id))
                        @method('PUT')
                    @endif

                    @csrf

                        <br>
                        <div class="card-body">
                            <div class="card-inner">
                                <input type="text" name="id" value="{{$role->id}}" hidden>
{{--                                    <h5>Anggota</h5>--}}
                                @foreach ($grouped as $title => $group)
                                    <h5 ><b>{{ ucwords($title) }}</b></h5>
                                    <div class="row">
{{--                                        foreach ($permissions as $role) {--}}
{{--                                        ddd($role->roles);--}}
{{--                                        }--}}
                                    @foreach ($group as $permission)
                                            @if (strpos($permission->name, 'setting') !== false ||strpos($permission->name, 'laporan') !== false)
                                            <div class="col-md-12">
                                                @else
                                                    <div class="col-md-2">
                                                    @endif
                                        <div class=" p-1"style="margin-left: -10px">
                                            <div class="custom-control custom-checkbox">
{{--                                                <option value="{{$gl->id}}"@if(!empty($produk_pembiayaan->GL_biaya_materai) ? $produk_pembiayaan->GL_biaya_materai == $gl->id : '')selected @endif>{{ $gl->kode }} &mdash; {{ $gl->nama }}</option>--}}

                                                <input type="checkbox" class="custom-control-input" name="permissions[]" value="{{ $permission->id }}" id="{{ $permission->name }}" @if(!empty($permission['roles'][0]) ? $permission['roles'][0]->pivot->permission_id == $permission->id : '' ) checked="checked" @endif>
                                                <label class="custom-control-label" for="{{ $permission->name }}">
                                                    {{ ucwords(str_replace([$title . '.', '-', '_'], ['', ' ', '/'], $permission->name)) }}
                                                </label>
                                            </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>
                                    <br>
                                @endforeach
                            </div>

                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title">&nbsp;</h5>
                                </div>

                                <div class="row g-4">

                                </div>
                            </div>
                        </div>
                    <div class="card-footer border border-top-0 text-right">
                        <a href="{{ route('kode_hak_akses.index') }}" class="btn btn-primary" style="background-color: red">{{ __('Kembali') }}</a>
                        <button type="submit" class="btn btn-primary">{{ !empty($role->id) ? __('Perbaharui') : __('Kirim') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
