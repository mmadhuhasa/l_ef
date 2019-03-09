<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<!-- Additional files for the Highslide popup effect -->
<script src="https://www.highcharts.com/samples/static/highslide-full.min.js"></script>
<script src="https://www.highcharts.com/samples/static/highslide.config.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="https://www.highcharts.com/samples/static/highslide.css" />
<!--<script type="text/javascript" src="{{url('app/plugins/Highcharts-4.2.5/js/highcharts.js')}}"></script>-->
<style>
    .highcharts-container {
        /*background: url('http://localhost:8080/pvtflightnew/public/media/images/Load-Trim-Graph-2.png') top left no-repeat;*/
        background: url('media/images/lnt.png') top left no-repeat;
        background-size: 100% 100%;
        height: 500px !important;
        width:350px !important;
    }
    .highcharts-background{
        fill-opacity:0
    }
    .highcharts-grid{
        display:none;
    }
    .highcharts-legend{
        display: none;
    }
    .green{
        fill: green !important;
    }
    .red{
        fill: red !important;
    }
    .blue{
        fill: blue !important;
    }
    .highcharts-button,.highcharts-title{
        display: none;
    }
</style>


<script>
    $(function () {

        var lr_data = [
            [27, 30],
            [26.5, 32],
            [26.8, 38],
        ];
        var chart1 = new Highcharts.Chart({
            chart: {
                renderTo: 'Div1',
                width: 360,
                height: 510

            },
            credits: {
                enabled: false
            },
            title: {
                text: 'Load Trim Graph',
                x: -20 //center
            },
            xAxis: {
                lineColor: 'black',
//                    categories: [14,'15', '17', '19', '21', '23', '25', '27', '29', '31', '33', '35', '37', '39']
                min: 14,
                max: 40,
                tickInterval: 1,
                tickPositions: [14, 17, 19, 21, 23, 25, 27, 29, 31, 33, 35, 37, 39],
            },
            yAxis: {
                min: 26,
                max: 50,
                tickInterval: 2,
                lineWidth: 1,
                title: {
                    text: ''

                },
                plotLines: [{
                        value: 0,
                        width: 10,
                        color: '#808080'
                    }],
                labels: {
//                        format: '{value:.2f}'
                }
            },
            tooltip: {
                valueSuffix: ''
            },
            legend: {
                layout: 'horizontal',
                align: 'right',
                verticalAlign: 'top',
                borderWidth: 0
            },
//            tooltip: {
//                pointFormat: ' '
//            },

            plotOptions: {
                spline: {
                    marker: {
                        enabled: true
                    }
                }
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br>' + 'Fuel: ' + this.key + ', %MAC ' + this.y;
                }
            },
            series: [
                {
                    name: 'ZFW',
                    type: 'spline',
                    color: '#00ff00',
                    "marker": {
                        "symbol": "circle"
                    },
//                        pointInterval: 1000,
                    data: [0, 0],
                },
                {
                    name: 'TOW',
                    type: 'spline',
                    color: 'gray',
                    "marker": {
                        "symbol": "circle"
                    },
//                        pointInterval: 1000,
                    data: [0, 0],
                },
                {
                    name: 'LW',
                    type: 'spline',
                    color: 'blue',
                    "marker": {
                        "symbol": "circle"
                    },
//                        pointInterval: 1000,
                    data: [0, 0],
                }
//                    {
//                        name: 'Alt Fuel',
//                        type: 'spline',
//                        color: 'green',
////                        pointInterval: 1000,
//                        data: [
//                            [38.3, 26.8],
//                            [33, 27.2],
//                            [29, 28]
//
//                        ]
//                    }

            ]
        });
    });
</script>

<div class="lt-right-sec pull-left">
    <div class="col-sm-4 col-md-3 p-0 text-center relative" style="padding-top:50px;">
	<img class="p-t-20 p-b-20" style="padding-top:30px;" src="{{url('app/new_temp/images/flight-image.png')}}">
    </div>				
    <div class="col-sm-8 col-md-9 p-0">
	<div id="Div1" style="height:500px;width:100%; margin: 0 auto"></div>	
    </div>
</div>