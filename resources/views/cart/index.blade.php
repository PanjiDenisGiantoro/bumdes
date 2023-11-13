@extends('layouts.default')

@section('content')

<div class="sptb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="item2-gl">
                            <h3>Home / Carts</h3>
                            <section class="store-cart">
                                <div class="container">
                                    <div class="row" data-aos="fade-up" data-aos-delay="100">
                                        <div class="col-12 table-responsive">
                                            <table class="table table-borderless table-cart">
                                                <thead>
                                                    <tr>
                                                        <td>Image</td>
                                                        <td>Name &amp; Seller</td>
                                                        <td>QTY</td>
                                                        <td>Price</td>
                                                        <td>Menu</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $totalPrice = 0 @endphp
                                                    @php $totalPricenonAnggota = 0 @endphp
                                                    @if ($cart) 
                                                        @foreach ($cart as $carts)

                                                    <tr>
                                                        <td style="width: 20%;">
                                                            {{-- @if($cart->product->galleries) --}}
                                                            <img style="width: 50%;" src="{{ $carts->product->picture_path ?? 'https://via.placeholder.com/420x320' }}" alt="" class="cart-image" />
                                                            {{-- @endif --}}
                                                        </td>
                                                        <td style="width: 27%;">
                                                            <div class="font-weight-semibold">{{ $carts->product->nama_produk ?? '' }}</div>
                                                            {{-- <div class="product-subtitle">makanan</div> --}}
                                                        </td>
                                                        <td style="width: 23%;">
                                                            <div class="product-title w-35">
                                                                <input type="number"readonly class="form-control" value="{{ $carts->qty ?? '0' }}">
                                                            </div>
                                                            <div class="product-subtitle">items</div>
                                                        </td>
                                                        <td style="width: 35%;">
                                                            <div class="product-title" id="harga-anggota" style="display: none;"><b>Harga Anggota</b> : Rp {{ number_format($carts->product->harga_anggota ?? '') }}</div>
                                                            <div class="product-subtitle" id="harga-bukan-anggota">Harga Bukan Anggota : Rp {{ number_format($carts->product->harga_bukan_anggota ?? '') }}</div>
                                                        </td>
                                                        <td style="width: 20%;">
                                                            <form action="{{ route('carts.hapus', $carts->id) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button class="btn btn-danger" type="submit">
                                                                Remove
                                                            </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @php $totalPrice += $carts->product->harga_anggota * $carts->qty @endphp
                                                    @php $totalPricenonAnggota += $carts->product->harga_bukan_anggota * $carts->qty @endphp
                                                    @endforeach
                                                    
                                                    @endif
                                                    
                                                </tbody>
                                            </table>
                                            {{-- <div class="col-8 col-md-3 pull-right">
                                                <a href="#" class="btn btn-success mt-6 pull-right px-4 btn-block">
                                                    <b>Checkout Now</b>
                                                </a>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="row" data-aos="fade-up" data-aos-delay="150">
                                        <div class="col-12">
                                            <hr />
                                        </div>
                                        <div class="col-11">
                                            <h2 class="mb-4">Informasi Pembeli</h2>
                                        </div>
                                        <div class="col-1">
                                        <input id="non-anggota" value="0" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="danger">
                                        <label for="non-anggota" id="non-anggota-label" class="form-check-label">Non-Anggota</label>
                                            {{-- <label class="switch">
                                                <input type="checkbox" id="simpanan_ada_ao" name="ao" unchecked>
                                                <span class="slider round" for="simpanan_ada_ao"></span>
                                            </label>
                                            <label for="simpanan_ada_ao" id="simpanan_ada_aoLabel">Tidak</label> --}}
                                        </div>
                                    </div>
                                    <form action="{{ route('carts.checkout') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    {{-- <input type="" name="total_price"> --}}
                                    <div class="row mb-2" data-aos="fade-up" id="input-non-anggota">
                                    <input type="hidden" name="pelanggan[]" value="0">
                                    <input type="hidden"  name="id_pelanggan" value="0">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address_one">Full Name</label>
                                                <input type="text" class="form-control" id="address_one" name="non_anggota" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address_two">No Telepon</label>
                                                <input type="number" class="form-control" id="address_two" name="no_telp[0]" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="country">Alamat</label>
                                                <input type="text" class="form-control" id="country" name="alamat[0]" />
                                            </div>
                                        </div>
                                        <div class="col-8 col-md-3">
                                            {{-- <form action="{{ route('carts.checkout') }}" method="POST">
                                                @csrf --}}
                                                {{-- <a href="#" class="btn btn-success mt-6 pull-right px-4 btn-block">
                                                    
                                                </a> --}}
                                        {{-- <input type="hidden" name="total_price" value="{{ $totalPrice ?? 0 }}">
                                        <input type="hidden" name="total_price_non" value="{{ $totalPricenonAnggota ?? 0 }}"> --}}

                                            {{-- </form> --}}
                                        </div>
                                    </div>
                                    <div class="row mb-2" id="input-anggota" style="display: none">
                                    <input type="hidden" name="pelanggan[]" value="1">
                                    <input type="hidden"  name="aktif_anggota" id="id_pelanggan">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address_one">No Anggota</label>
                                                <input type="text" class="form-control" id="no_anggota_id"  />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address_two">Nama Penuh</label>
                                                <input type="text" readonly class="form-control" id="nama_pemohon"  />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="country">Alamat</label>
                                                <input type="text" readonly class="form-control" id="nama_jalan" name="alamat[1]"  />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="country">No Telepon</label>
                                                <input type="number" readonly class="form-control" id="no_hp" name="no_telp[1]"  />
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="country">NIK</label>
                                                <input type="number" readonly class="form-control" id="idp" name="country"  />
                                            </div>
                                        </div> --}}
                                        
                                    </div>
                                    {{-- <button class="btn btn-success mt-6 pull-right px-4 btn-block" type="submit">
                                                    Checkout Nowas
                                                </button> --}}
                                    <div class="row mb-2" style="display: none;" id="totalAnggota">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="font-weight-semibold" style="font-size: 20px;">Total Pembelian Anggota</div>
                                                <div class="font-weight-semibold text-success" style="font-size: 20px;">Rp {{ number_format($totalPrice ?? 0) }}</div>
                                                <input hidden type="text" name="total_price" value="{{ $totalPrice ?? 0 }}">
                                            </div>
                                        </div>
                                        @if(empty($cart))

                                           @else
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <button class="btn btn-success mt-6 pull-right px-4 btn-block" type="submit">
                                                    Bayar Sekarang
                                                </button>
                                            </div>
                                        </div>
                                        @endif
                                       
                                    </div>

                                    <div class="row mb-2" id="totalNonAnggota">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="font-weight-semibold" style="font-size: 20px;">Total Pembelian Non-Anggota</div>
                                                <div class="font-weight-semibold text-success" style="font-size: 20px;">Rp {{ number_format($totalPricenonAnggota ?? 0) }}</div>
                                                <input type="text" hidden name="total_price_non" value="{{ $totalPricenonAnggota ?? 0 }}">
                                            </div>
                                        </div>
                                        @if(empty($cart))

                                           @else
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <button class="btn btn-success mt-6 pull-right px-4 btn-block" type="submit">
                                                    Bayar Sekarang
                                                </button>
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                    {{-- <div class="col-4" style="display: none;" id="totalAnggota">
                                        <div class="font-weight-semibold" style="font-size: 20px;">Total Pembelian Anggota</div>
                                        <div class="font-weight-semibold text-success" style="font-size: 20px;">Rp {{ number_format($totalPrice ?? 0) }}</div>
                                        <input type="hidden" name="total_price" value="{{ $totalPrice ?? 0 }}">
                                    </div>
                                    <div class="col-4 " id="totalNonAnggota">
                                        <div class="font-weight-semibold" style="font-size: 20px;">Total Pembelian Non Anggota</div>
                                        <div class="font-weight-semibold text-success" style="font-size: 20px;">Rp {{ number_format($totalPricenonAnggota ?? 0) }}</div>
                                        <input type="hidden" name="total_price" value="{{ $totalPricenonAnggota ?? 0 }}">
                                    </div> --}}
                            </form>
                                </div>
                            </section>
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
@push('css')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endpush

@push('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script> --}}
    <script>
    $('#non-anggota').on('change', function() {
                console.log('clicked');
                var status1 = $(this).prop('checked') == false ? 0 : 1;
                if ($(this).prop("checked") == false) {

                    $('#non-anggota-label').html("non-anggota");
                    $('#input-non-anggota').show();
                    $('#totalNonAnggota').show();
                    $('#input-anggota').hide();
                    $('#input-anggota').attr('disabled', true);
                    
                    $('#totalNonAnggota').show();
                    $('#totalAnggota').hide();
                    $('#totalAnggota').attr('disabled', true);
                    
                    $('#harga-anggota').hide();
                    $('#harga-bukan-anggota').show();


                } else if ($(this).prop("checked") == true) {

                    $('#non-anggota-label').html("anggota");
                    $('#input-anggota').show();
                    $('#totalAnggota').show();
                    $('#input-non-anggota').hide();
                    $('#totalNonAnggota').attr('disabled', true);
                    $('#totalNonAnggota').hide();
                    $('#input-non-anggota').attr('disabled', true);
                    $('#harga-bukan-anggota').hide();
                    $('#harga-anggota').show();
                }
    });

    $('#no_anggota_id').on('keyup', function() {
        console.log("Keyup triggered");
        var no_anggota_id = $(this).val();
        $.ajax({
            url: "{{ route('carts.e-commerce.index') }}",
            type: "GET",
            data: {
                regMitra: no_anggota_id
            },
            success: function(data) {
                if (data.results != '') {
                    console.log(data.results);
                } else {
                    console.log("GA ADA USER");
                }
           
                $('#id_pelanggan').val(data.results[0].id);
                $('#nama_pemohon').val(data.results[0].nama_pemohon);
                $('#nama_jalan').val(data.results[0].nama_jalan);
                $('#no_hp').val(data.results[0].no_hp);
                $('#idp').val(data.results[0].nik);
            }
        });
    });
</script>
@endpush