@extends('layouts.default')

@section('content')
<div class="sptb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="page-content page-success">
                            <div class="section-success" data-aos="zoom-in">
                                <div class="container">
                                    <div class="row align-items-center row-login justify-content-center">
                                        <div class="col-lg-6 text-center">
                                            <img src="{{ asset('assets/images/success.svg') }}" alt="" class="mb-4" />
                                            <h2 style="font-weight: bold;">
                                                Transaction Tidak berhasil
                                            </h2>
                                            <p>
                                                Transaksi tidak berhasil, silahkan coba lagi.
                                            </p>
                                            <div>
                                                <a href="/" class="btn btn-success w-50 mt-4" style="font-weight: bold;">
                                                    Home
                                                </a>
                                                <a href="{{ route('carts.e-commerce.index') }}" class="btn btn-light w-50 mt-2">
                                                    Belanja Lagi
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="center-block text-center">
                            {{ $products->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
