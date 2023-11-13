@extends('layouts.default')

@section('content')
<div class="sptb">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="single-productslide">
                        <div class="row no-gutter">
                            <div class="col-lg-6 border-end">
                                <div class="pb-0 image-zoom-container">
                                    <div class="show image-zoom" href="{{ $product->picture_path ?? 'https://via.placeholder.com/420x320' }}" style="position: relative">
                                        <img src="{{ $product->picture_path ?? 'https://via.placeholder.com/420x320' }}" alt="" id="show-img" style="width: 100%; height: 100%">
                                    </div>
                                    <div class="small-img">

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="product-gallery-data mb-0">
                                    <h3 class="mb-3 font-weight-semibold">
                                        {{ $product->nama_produk ?? null }}
                                    </h3>
                                    <div class="mb-3">
                                        <span class="font-weight-bold h1 text-danger">
                                            {{ number_format($product->harga_anggota ?? 0, 2) }}
                                        </span>
                                    </div>

                                    <p class="text-dark">
                                        {!! nl2br($product->keterangan ?? null) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection