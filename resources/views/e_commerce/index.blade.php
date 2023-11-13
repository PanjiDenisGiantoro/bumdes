@extends('layouts.default')

@section('content')
<div class="sptb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="item2-gl">
                            <h3>List Produk</h3>
                            <div class="item2-gl-nav d-flex">
                                <h6 class="mb-0 mt-2"></h6>
                                <ul class="nav item2-gl-menu ms-auto">
                                    <li>
                                        <a href="#tab-list" data-toggle="tab">
                                            <i class="fa fa-list"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab-grid" data-toggle="tab">
                                            <i class="fa fa-th"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-list">
                                    @foreach ($products as $product)
                                        <div class="card overflow-hidden">
                                            <div class="d-md-flex">
                                                <div class="item-card9-img">
                                                    {{-- <div class="arrow-ribbon bg-primary"></div> --}}
                                                    <div class="item-card9-imgs">
                                                        <a href="{{ route('pages.e-commerce.products.show', $product) }}"></a>
                                                        <img src="{{ $product->picture_path ?? 'https://via.placeholder.com/420x320' }}" alt="img" class="cover-image">
                                                    </div>
                                                    {{-- <div class="item-card9-icons">
                                                        <a href="" class="item-card9-icons1 wishlist">
                                                            <i class="fa fa-heart-o"></i>
                                                        </a>
                                                    </div> --}}
                                                </div>
                                                <div class="card border-0 mb-0">
                                                    <div class="card-body">
                                                        <div class="item-card9">
                                                            <a href="">{{ $product->kategori->kategori_produk ?? null }}</a>
                                                            <a href="{{ route('pages.e-commerce.products.show', $product) }}" class="text-dark">
                                                                <h4 class="font-weight-semibold mt-1">
                                                                    {{ $product->nama_produk ?? null }}
                                                                </h4>
                                                            </a>
                                                            <p class="mb-0 leading-tight">{{ $product->keterangan ?? null }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer pt-4 pb-4">
                                                        <div class="item-card9-footer d-flex">
                                                            <form action="{{ route('carts.addToCart') }}" method="POST">
                                                            <div class="item-card9-cost">
                                                                <h4 class="text-dark font-weight-semibold mb-0 mt-0">
                                                                    Harga Anggota : Rp.{{ number_format($product->harga_anggota ?? 0, 2) }}

                                                                </h4>
                                                                <h4 class="text-dark font-weight-semibold mb-0 mt-2">
                                                                    Harga Bukan Anggota : Rp.{{ number_format($product->harga_bukan_anggota ?? 0, 2) }}

                                                                </h4>
                                                                <div class="mt-4">
                                                                    <h4>Kuantitas</h4>
                                                                    <input type="number" name="qty" id="qty" class="form-control" value="1">
                                                                </div>
                                                                        @csrf
                                                                        <input type="number" hidden name="produks_id" id="produks_id" value="{{ $product->id }}">
                                                                        <button type="submit" class="btn btn-success btn-sm mt-4 mb-4">
                                                                            <i class="fa fa-shopping-cart"></i>
                                                                            Add to Cart
                                                                        </button>
                                                                    {{-- <a href="{{ route('carts.index') }}" class="btn btn-success btn-sm mt-4 mb-4" style="text-align: right"><i class="fa fa-shopping-cart"></i> Add to cart</a> --}}
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="tab-pane" id="tab-grid">
                                    <div class="row">
                                        @foreach ($products as $product)
                                            <div class="col-lg-6 col-md-12 col-xl-4">
                                                <div class="card overflow-hidden">
                                                    <div class="item-card9-img">
                                                        {{-- <div class="arrow-ribbon bg-primary"></div> --}}
                                                        <div class="item-card9-imgs">
                                                            <a href="{{ route('pages.e-commerce.products.show', $product) }}"></a>
                                                            <img src="{{ $product->picture_path ?? 'https://via.placeholder.com/420x320' }}" alt="img" class="cover-image">
                                                        </div>
                                                        {{-- <div class="item-card9-icons">
                                                            <a href="" class="item-card9-icons1 wishlist">
                                                                <i class="fa fa-heart-o"></i>
                                                            </a>
                                                        </div> --}}
                                                    </div>
                                                    <div class="card border-0 mb-0">
                                                        <div class="card-body">
                                                            <div class="item-card9">
                                                                <a href="">{{ $product->kategori->kategori_produk ?? null }}</a>
                                                                <a href="{{ route('pages.e-commerce.products.show', $product) }}" class="text-dark">
                                                                    <h4 class="font-weight-semibold mt-1">
                                                                        {{ $product->nama_produk ?? null }}
                                                                    </h4>
                                                                </a>
                                                                <p class="mb-0 leading-tight">{{ $product->keterangan ?? null }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer pt-4 pb-4">
                                                            <div class="item-card9-footer d-flex">
                                                                <div class="item-card9-cost">
                                                                    <h4 class="text-dark font-weight-semibold mb-0 mt-0">
                                                                        Rp.{{ number_format($product->harga_anggota ?? 0, 2) }}
                                                                    </h4>
                                                                    <a href="javascript:void(0)" class="btn btn-success btn-sm mt-4 mb-4"><i class="fa fa-shopping-cart"></i> Pesan </a>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="center-block text-center">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
      </script>
@endpush
