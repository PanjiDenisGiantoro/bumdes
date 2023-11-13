@extends('layouts.app')

@section('breadcrumb')
    <h3 class="card-header">Ringkasan Penjualan</h3>
    <br>
{{--    <x-breadcrumb title="{{ __('Ringkasan Penjualan') }}">--}}
{{--        <li class="breadcrumb-item">--}}
{{--            <a href="{{ route('tetapan.index') }}">{{ __('Setting') }}</a>--}}
{{--        </li>--}}
{{--        <li class="breadcrumb-item">--}}
{{--            {{ __('Ringkasan Penjualan') }}--}}
{{--        </li>--}}
{{--    </x-breadcrumb>--}}
@endsection

@section('content')
    <div class="card-title">
        {{-- <h3>Tagihan Penjualan</h3> --}}
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="pe-7s-users fs-40 text-primary"></i>
                    </div>
                    <h4>Menunggu Pembayaran </h4>
                    <h2 class="counter mb-0"> {{ number_format($pemesanan + $sisatagihan) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="pe-7s-refresh-2 fs-40 text-primary"></i>
                    </div>
                    <h4>Jatuh Tempo Pembayaran</h4>
                    <h2 class="counter mb-0"> {{ number_format($jatuhtempo) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="pe-7s-mail fs-40 text-primary"></i>
                    </div>
                    <h4>Penjualan Semua Produksi </h4>
                    <h2 class="counter mb-0">{{ number_format($jumlahproduk) }}</h2>
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
                    <h4>Pembayaran Belum Selesai</h4>
                    <h2 class="counter mb-0">{{ number_format($totalseluruh) }}</h2>
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
                    <h2 class="counter mb-0">{{number_format($penawarandisetujui)}}</h2>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4>Penjualan Per Produk</h4>
                    <canvas id="myChart" width="300" height="300"></canvas>

                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4>Penjualan Per Anggota dan Non Anggota</h4>
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
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [
                      @foreach($cek as $p)
                            '{{ $p->nama_produk }}',
                        @endforeach
                ],
                datasets: [{
                    label: '# of Votes',
                    data: [

                        @foreach($cek as $p)
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
                labels: ['non anggota', 'anggota'],
                datasets: [{
                    label: '# of Votes',
                    data: [
                        @foreach ($hitunganggota as $f)
                        '{{ $f->total ?? '' }}',
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
        var xValues = <?php echo json_encode($total) ?>;
        var yValues = <?php echo json_encode($bulan) ?>;

        Highcharts.chart('barchart', {
            title : {
                text : 'Grafik Penjualan'
            },
            xAxis : {
                categories : yValues
            },yAxis : {
                title : {
                    text : 'Total Penjualan'
                }
            },plotOptions : {
                series : {
                    allowPointSelect : true
                }
            },series : [
                {
                    name : 'Total Penjualan',
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
