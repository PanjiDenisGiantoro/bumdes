@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb title="{{ __('Ringkasan Pembelian') }}">
        <li class="breadcrumb-item">
            <a href="{{ route('tetapan.index') }}">{{ __('Setting') }}</a>
        </li>
        <li class="breadcrumb-item">
            {{ __('Ringkasan Pembelian') }}
        </li>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="card-title">
        {{-- <h3>Tagihan Pembelian</h3> --}}
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="pe-7s-users fs-40 text-primary"></i>
                    </div>
                    <h4>Menunggu Pembayaran </h4>
                    <h2 class="counter mb-0">{{ number_format($menunggupembayaran + $sisa_tagihan) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="pe-7s-refresh-2 fs-40 text-primary"></i>
                    </div>
                    <h4>Jatuh Tempo</h4>
                    <h2 class="counter mb-0">{{ number_format($jatuhtempo + $belumbayar) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="pe-7s-mail fs-40 text-primary"></i>
                    </div>
                    <h4>Penjualan Semua Produk</h4>
                    <h2 class="counter mb-0">{{ number_format($totalpesanan) }}</h2>
                </div>
            </div>
        </div>

    </div>
{{--    <div class="card-title">--}}
{{--        <h3>Pemesanan & Pengiriman</h3>--}}
{{--    </div>--}}
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="pe-7s-users fs-40 text-primary"></i>
                    </div>
                    <h4>Pengiriman Belum Selesai</h4>
                    <h2 class="counter mb-0">{{number_format($bayarbelumselesai)}}</h2>
                </div>
            </div>
        </div>


        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="pe-7s-mail fs-40 text-primary"></i>
                    </div>
                    <h4>Penawaran Disetujui</h4>
                    <h2 class="counter mb-0">{{$menunggupembayaran}}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4>Pembelian Per Produk</h4>
                    <canvas id="myChart" width="300" height="300"></canvas>

                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4>Pembelian Per Pelanggan</h4>
                    <canvas id="myChart_pelanggan" width="300" height="300"></canvas>

                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4>Pembayaran di Terima</h4>
                    <div id="barchart" style="width:100%;max-width:100%"></div>

                </div>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [
                    @foreach($penjualanperproduk as $p)
                        '{{ $p->produk->nama_produk }}',
                    @endforeach
                ],
                datasets: [{
                    label: '# of Votes',
                    data: [
                        @foreach($jumlahqty as $p)
                            '{{ $p->jumlah }}',
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132)',
                        'rgba(54, 162, 235)',
                        'rgba(255, 206, 86)',
                        'rgba(75, 192, 192)',
                        'rgba(153, 102, 255)',
                        'rgba(255, 159, 64)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132)',
                        'rgba(54, 162, 235)',
                        'rgba(255, 206, 86)',
                        'rgba(75, 192, 192)',
                        'rgba(153, 102, 255)',
                        'rgba(255, 159, 64)'
                    ],
                    borderWidth: 1
                }]
            },

        });


    </script>
    <script>
        const ctxPelanggan = document.getElementById('myChart_pelanggan').getContext('2d');
        const myChart_pelanggan = new Chart(ctxPelanggan, {
            type: 'doughnut',
            data: {
                labels: [
                    @foreach($supplierdata as $p)
                        '{{ $p->supplier }}',
                    @endforeach
                ],
                datasets: [{
                    label: '# of Votes',
                    data: [
                        @foreach($supplierdata as $p)
                            '{{ $p->total }}',
                        @endforeach
                    ],
                    backgroundColor: [

                        'rgba(75, 192, 192)',
                        'rgba(153, 102, 255)',
                        'rgba(255, 159, 64)',
                        'rgba(255, 99, 132)',
                        'rgba(54, 162, 235)',
                        'rgba(255, 206, 86)',
                    ],
                    borderColor: [

                        'rgba(75, 192, 192)',
                        'rgba(153, 102, 255)',
                        'rgba(255, 159, 64)',
                        'rgba(255, 99, 132)',
                        'rgba(54, 162, 235)',
                        'rgba(255, 206, 86)',
                    ],
                    borderWidth: 1
                }]
            },

        });


    </script>
{{--    <script>--}}
{{--        var xValues = ['Januari','Februari','Maret','April','Mei','Juni',"Juli",'Agustus','September','Oktober','November','Desember'];--}}
{{--        var yValues = [7,8,8,9,9,9,10,11,14,14,13,15];--}}

{{--        new Chart("barchart", {--}}
{{--            type: "line",--}}
{{--            data: {--}}

{{--                labels: xValues,--}}
{{--                datasets: [{--}}
{{--                    label: 'Pembayaran',--}}
{{--                    fill: false,--}}
{{--                    lineTension: 0,--}}
{{--                    backgroundColor: "rgba(0,0,255,1.0)",--}}
{{--                    borderColor: "rgba(0,0,255,0.1)",--}}
{{--                    data: yValues--}}
{{--                }]--}}
{{--            },--}}
{{--            options: {--}}
{{--                legend: {display: false},--}}
{{--                scales: {--}}
{{--                    yAxes: [{ticks: {min: 6, max:16}}],--}}
{{--                }--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
    <script>
        var xValues = <?php echo json_encode($total) ?>;
        var yValues = <?php echo json_encode($bulan) ?>;

        Highcharts.chart('barchart', {
            title : {
                text : 'Grafik Pembelian'
            },
            xAxis : {
                categories : yValues
            },yAxis : {
                title : {
                    text : 'Total Pembelian'
                }
            },plotOptions : {
                series : {
                    allowPointSelect : true
                }
            },series : [
                {
                    name : 'Total Pembelian',
                    data : xValues
                }
            ]
        });
        // new Chart("barchart", {
        //     type: "line",
        //     data: {
        //
        //         labels: xValues,
        //         datasets: [{
        //             label: 'Pembayaran',
        //             fill: false,
        //             lineTension: 0,
        //             backgroundColor: "rgba(0,0,255,1.0)",
        //             borderColor: "rgba(0,0,255,0.1)",
        //             data: yValues
        //         }]
        //     },
        //     options: {
        //         legend: {display: false},
        //         scales: {
        //             yAxes: [{ticks: {min: 6, max:16}}],
        //         }
        //     }
        // });
    </script>


@endpush
