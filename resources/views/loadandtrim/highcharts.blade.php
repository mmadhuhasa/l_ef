@extends('layouts.lnt_layout',array('1'=>'1'))
@section('content')
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
	/*background: url(http://localhost:8080/pvtflightnew/public/media/images/Load-Trim-Graph-2.png) top left no-repeat;*/
	background: url('../media/images/Load-Trim-Graph-2.png') top left no-repeat;
	background-size: 100% 100%;
	height: 623px !important;
	width:589px !important;
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
</style>
<div class="page">
    <script>
        $(function () {

            $('path').addClass('green');

            var lr_data = [
                [27, 30],
                [26.5, 32],
                [26.8, 38],
            ];

            var zfg_x1 = 34.69; //34.69,29.02,27
            var zfg_y1 = 27.114;//27.114,28.964,30
            var zfg_x2 = 29.02;
            var zfg_y2 = 28.964;
            var zfg_x3 = 27;
            var zfg_y3 = 30;

            var zfg_color = '#2cc38a';

            var lr_data2 = [
                [zfg_x1, zfg_y1],
                [zfg_x2, zfg_y2],
                [zfg_x3, zfg_y3],
            ];
            console.log(lr_data)
            var chart1 = new Highcharts.Chart({
                chart: {
                    renderTo: 'Div1',
                    width: 600,
                    height: 625

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
                    tickPositions: [14, 15, 17, 19, 21, 23, 25, 27, 29, 31, 33, 35, 37, 39],
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
                plotOptions: {
                    spline: {
                        marker: {
                            enabled: true
                        }
                    }
                },
                series: [{
                        name: 'Fuel1',
                        type: 'spline',
                        color: 'blue',
//                        pointInterval: 1000,
                        data: lr_data,
                    }, {
                        name: 'ZFG',
                        type: 'spline',
                        color: zfg_color,
                        "marker": {
                            "symbol": "circle"
                        },
//                        pointInterval: 1000,
                        data: lr_data2}
//                    {
//                        name: 'Fuel2',
//                        type: 'scatter',
//                        color: 'gray',
////                        pointInterval: 1000,
//                        data: [lr_data[1]],
//                    },
//                    {
//                        name: 'Fuel3',
//                        type: 'scatter',
//                        color: 'blue',
////                        pointInterval: 1000,
//                        data: [lr_data[2]],
//                    }
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


            $("#update_lt").on('click', function () {
                var lr_data = [];
                var x_axis = $("#x-axis").val();
                var y_axis = $("#y-axis").val();
                var x_axis_array = x_axis.split(',');
                var y_axis_array = y_axis.split(',');
                for (var i = 0; i < x_axis_array.length; i++) {
                    x_axis_array[i] = parseFloat(x_axis_array[i])
                    y_axis_array[i] = parseFloat(y_axis_array[i])
                }


                var zfg_color = '#2cc38a';
                var lr_data2 = [];
                var zfg_x_axis = $("#zfg_x-axis").val();
                var zfg_y_axis = $("#zfg_y-axis").val();
                var zfg_x_axis_array = zfg_x_axis.split(',');
                var zfg_y_axis_array = zfg_y_axis.split(',');
                for (var i = 0; i < zfg_x_axis_array.length; i++) {
                    zfg_x_axis_array[i] = parseFloat(zfg_x_axis_array[i])
                    zfg_y_axis_array[i] = parseFloat(zfg_y_axis_array[i])
                }



                if (x_axis_array.length != y_axis_array.length) {
                    $("#error_message").removeClass('hide');
                    $("#error_message").html('Enter proper data');
                } else {
                    $("#error_message").addClass('hide');
                    $("#error_message").html('');
                }
                for (var i = 0; i < x_axis_array.length; i++) {
                    lr_data.push([x_axis_array[i], y_axis_array[i]]);
                }
                for (var i = 0; i < zfg_x_axis_array.length; i++) {
                    lr_data2.push([zfg_x_axis_array[i], zfg_y_axis_array[i]]);
                }
                console.log(lr_data)
                var chart1 = new Highcharts.Chart({
                    chart: {
                        renderTo: 'Div1',
                        width: 600,
                        height: 625

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
                        tickPositions: [14, 15, 17, 19, 21, 23, 25, 27, 29, 31, 33, 35, 37, 39]
                    },
                    yAxis: {
                        min: 26,
                        max: 50,
                        tickInterval: 2,
                        lineColor: 'black',
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
//                            format: '{value:.2f}'
                        }
                    },
                    tooltip: {
                        valueSuffix: ''
                    },
                    legend: {
                        layout: 'Vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        borderWidth: 0
                    },
                    plotOptions: {
                        spline: {
                            marker: {
                                enabled: true
                            }
                        }
                    },
                    series: [
//                    {
//                            name: 'Fuel',
//                            type: 'spline',
//                            color: 'blue',
////                        pointInterval: 1000,
//                            data: lr_data
//                        },
//                        {
//                            name: 'Alt Fuel',
//                            type: 'spline',
//                            color: 'green',
////                        pointInterval: 1000,
//                            data: [
//                                [38.3, 26.8],
//                                [33, 27.2],
//                                [29, 28]
//
//                            ]
//                        }
                        {
                            name: 'Fuel1',
                            type: 'spline',
                            color: 'blue',
//                        pointInterval: 1000,
                            data: lr_data,
                        }
                        , {
                            name: 'ZFG',
                            type: 'spline',
                            color: zfg_color,
                            "marker": {
                                "symbol": "circle"
                            },
//                        pointInterval: 1000,
                            data: lr_data2}
//                        {
//                            name: 'Fuel2',
//                            type: 'scatter',
//                            color: 'gray',
////                        pointInterval: 1000,
//                            data: [lr_data[1]],
//                        },
//                        {
//                            name: 'Fuel3',
//                            type: 'scatter',
//                            color: 'blue',
////                        pointInterval: 1000,
//                            data: [lr_data[2]],
//                        }

                    ]
                });
            });
        });
    </script>
    @include('includes.new_fpl_header',[])
    <main>
	<section class="bg-1 welcome weather-page">

	    <div class="container">
		<div class="row">
		    <div class="col-sm-9">
			<div id="Div1" style="height:625px;width:500px; margin: 0 auto"></div>
		    </div>
		    <div class="col-sm-3">
			<div class="row">
			    <div class="form-group">
				<div class="alert alert-danger hide" id="error_message"></div>
				<div class="col-sm-12">
				    <label for="">Main X-Axis</label>
				    <textarea cols="20" id="x-axis" rows="5"  class="w100">27,26.5,26.8</textarea>
				</div>
				<div class="col-sm-12">
				    <label for="">Main Y-Axis</label>
				    <textarea cols="20" id="y-axis" rows="5" class="w100">30,32,38</textarea>
				</div>
			    </div>
			</div>
			<div class="row">
			    <div class="form-group">
				<div class="alert alert-danger hide" id="error_message"></div>
				<div class="col-sm-12">
				    <label for="">ZFG X-Axis</label>
				    <textarea cols="20" id="zfg_x-axis" rows="5"  class="w100">34.69,29.02,27</textarea>
				</div>
				<div class="col-sm-12">
				    <label for="">ZFG Y-Axis</label>
				    <textarea cols="20" id="zfg_y-axis" rows="5" class="w100">27.114,28.964,30</textarea>
				</div>
			    </div>
			</div>
			<div class="row">
			    <div class="col-sm-3 col-sm-offset-3">
				<input type="button" id="update_lt" style="width: 96px !important;"  class="btn btn-danger form-control col-sm-1" name="x" value="submit">
			    </div>	
			</div>
		    </div>		  
		</div>
	    </div>

        </section>
    </main>   
    @include('includes.new_footer',[])
</div>
@stop