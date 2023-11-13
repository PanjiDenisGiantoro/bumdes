@extends('layouts.app')

@section('content')
    @php
        $arrProduk['chartproduk'] = rtrim($chartproduk,',');
    @endphp
<div class="row" style="margin-top: 20px">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kategori Anggota</h3>
            </div>
            <div class="card-body">
                <div id="piechart_3d"  style=" height: 440px;margin-top: -20px"></div>

                {{--                <div id="morrisBar8" class="chartmorris  dropshadow overflow-hidden"></div>--}}
                <br>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">5 Penjualan Produk Terlaris</h3>
            </div>
            <div class="card-body">
                <div id="piechart_3d_produk"  style="height: 450px;margin-top: -20px"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Rekening</h3>
            </div>
            <div class="card-body">
                <div id="grafik" height="400" width="600"></div>
                {{--                <div class="text-center mt-3">--}}
                {{--                    <span class="dot-label bg-primary"></span><span class="mr-3">Simpanan </span>--}}
                {{--                    <span class="dot-label bg-pink"></span><span class="mr-3">Berjangka</span>--}}
                {{--                    <span class="dot-label bg-pink"></span><span class="mr-3">Pembiayaan</span>--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card" style="height: 520px">
            <div class="card-header">
                <h3 class="card-title">Penjualan Dan Pembelian </h3>
            </div>
            <div class="card-body">
                <div id="graf"></div>
                <canvas id="lineChart1" class="dropshadow" ></canvas>

                {{--                <canvas id="canvas" height="280" width="600"></canvas>--}}
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    ( function ( $ ) {
        "use strict";
        /*---- morrisBar3----*/
        new Morris.Area({
            element: 'morrisBar3',
            behaveLikeLine: true,
            data: [
                {x: '2021', y: 66 },
                {x: '2022', y: 77 },

            ],
            xkey: 'x',
            ykeys: ['y'],
            lineColors: ['#6963ff','#ff2b88'],
            labels: ['Profits']
        });
    } )( jQuery );


</script>
<script>
    $(function() {

        // We use an inline data source in the example, usually data would
        // be fetched from a server

        var data = [],
            totalPoints = 300;

        function getRandomData() {

            if (data.length > 0)
                data = data.slice(1);

            // Do a random walk

            while (data.length < totalPoints) {

                var prev = data.length > 0 ? data[data.length - 1] : 50,
                    y = prev + Math.random() * 10 - 5;

                if (y < 0) {
                    y = 0;
                } else if (y > 100) {
                    y = 100;
                }

                data.push(y);
            }

            var res = [];
            for (var i = 0; i < data.length; ++i) {
                res.push([i, data[i]])
            }

            return res;
        }

        var updateInterval = 30;
        $("#updateInterval").val(updateInterval).change(function () {
            var v = $(this).val();
            if (v && !isNaN(+v)) {
                updateInterval = +v;
                if (updateInterval < 1) {
                    updateInterval = 1;
                } else if (updateInterval > 2000) {
                    updateInterval = 2000;
                }
                $(this).val("" + updateInterval);
            }
        });

        var plot = $.plot("#placeholder4", [ getRandomData() ], {
            series: {
                shadowSize: 0	// Drawing is faster without shadows
            },
            grid: {
                borderColor: "rgba(167, 180, 201,.1)",
            },
            colors: ["#ff2b88"],
            yaxis: {
                min: 0,
                max: 100,
                tickLength: 0
            },
            xaxis: {
                tickLength: 0,
                show: false
            }
        });

        function update() {
            plot.setData([getRandomData()]);
            plot.draw();
            setTimeout(update, updateInterval);
        }

        update();

    });
    $(function(e){

        var chartdata3 = [
            {
                name: 'Good',
                type: 'bar',
                stack: 'Stack',
                data: [20, 56, 18, 75, 65, 74, 78, 67, 84]
            },
            {
                name: 'Bad',
                type: 'bar',
                stack: 'Stack',
                data: [12, 14, 15, 50, 24, 24, 10, 20 ,30]
            }
        ];

        var option5 = {
            grid: {
                top: '6',
                right: '0',
                bottom: '17',
                left: '25',
            },
            tooltip: {
                show: true,
                showContent: true,
                alwaysShowContent: true,
                triggerOn: 'mousemove',
                trigger: 'axis',
                axisPointer:
                    {
                        label: {
                            show: false,
                        }
                    }

            },
            xAxis: {
                data: ['Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat'],
                axisLine: {
                    lineStyle: {
                        color: 'rgba(227, 237, 252,0.5)'
                    }
                },
                axisLabel: {
                    fontSize: 10,
                    color: '#a7b4c9'
                }
            },
            yAxis: {
                splitLine: {
                    lineStyle: {
                        color: 'rgba(227, 237, 252,0.5)'
                    }
                },
                axisLine: {
                    lineStyle: {
                        color: 'rgba(227, 237, 252,0.5)'
                    }
                },
                axisLabel: {
                    fontSize: 10,
                    color: '#a7b4c9'
                }
            },
            series: chartdata3,
            color:[ '#ff2b88', '#6963ff']
        };

        var chart5 = document.getElementById('echart5');
        var barChart5 = echarts.init(chart5);
        barChart5.setOption(option5);
    });

</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            <?php echo $chartstatus?>
        ]);

        var options = {
            title: '',
            is3D: true,
        //    pieHole: 0.4,
            chartArea: {
                left: "3%",
                top: "3%",
                height: "94%",
                width: "94%"
            }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
    }
</script>
<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            <?php echo $arrProduk['chartproduk']?>
        ]);

        var options = {
            title: '',
            pieHole: 0.4,
            chartArea: {
                left: "3%",
                top: "3%",
                height: "94%",
                width: "94%"
            }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_produk'));
        chart.draw(data, options);
    }
</script>
<script src="https://raw.githubusercontent.com/nnnick/Chart.js/master/dist/Chart.bundle.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script>
    var year = ['Jan','Feb','Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
    var data_simpanan = <?php echo $simpanan; ?>;
    var data_berjangka = <?php echo $berjangka; ?>;
    var data_pembiayaan = <?php echo $pembiayaan; ?>;


    var barChartData1 = {
        labels: year,
        datasets: [{
            label: 'Simpanan',
            backgroundColor: "rgba(220,220,110,0.5)",
            data: data_simpanan
        }, {
            label: 'Berjangka',
            backgroundColor: "rgba(110,187,205,0.5)",
            data: data_berjangka
        },
            {
                label: 'Pembiayaan',
                backgroundColor: "rgba(120,50,220,0.5)",
                data: data_pembiayaan
            }
        ]
    };


    window.onload = function() {
        var ctx = document.getElementById("canvas1").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData1,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        // borderColor: 'rgb(0, 255, 0)',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: ''
                }
            }
        });


    };
    $(function(e){

            var data_penjualan = <?php echo $penjualan; ?>;
            var data_pembelian = <?php echo $pembelian; ?>;
        var ctx = document.getElementById( "lineChart1" );

        var myChart = new Chart( ctx, {
            height: 500,
            type: 'bar',
            data: {
                labels: ["Pembelian dan Penjualan"],
                datasets: [
                    {
                        label: "Pembelian",
                        borderColor: "rgb(105, 99, 255)",
                        borderWidth: "5",
                        backgroundColor: "rgb(105, 99, 255, 0.8)",
                        data:data_pembelian ,
                    },
                    {
                        label: "Penjualan",
                        borderColor: "rgb(255,43,136)",
                        borderWidth: "5",
                        backgroundColor: "rgba(255,43,136, 0.8)",
                        pointHighlightStroke: "rgba(255,43,136, 1)",
                        data:  data_penjualan
                    }
                ]
            },
            options: {
                responsive: true,
                tooltips: {
                    mode: 'index',
                    intersect: false,

                },
                tooltips: {
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                }

            }
        } );
    });
</script>
    <script>
        var simpanan = <?php echo json_encode($simpanan); ?>;
        var pembiayaan = <?php echo json_encode($pembiayaan); ?>;
        var bulan = <?php echo json_encode($bulan); ?>;
        Highcharts.chart('grafik',{
            chart: {
                type: 'area'
            },
            title: {
                text: ''
            },
            xAxis: {
                categories: bulan
            },
            credits: {
                enabled: false
            },
            yAxis: {
                title: {
                    text: 'Jumlah'
                }
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series:[
                {
                    name: 'Simpanan',
                    data: simpanan
                },
                {
                    name: 'pembiayaan',
                    data: pembiayaan
                },
                {
                    name: 'berjangka',
                    data: [0,0]
                }
            ]
        })
    </script>

@endpush
