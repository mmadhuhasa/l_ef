@extends('layouts.lnt_layout',array('aircraft_callsign'=>'vtauv'))
@section('content')

<script src="https://code.highcharts.com/highcharts.js"></script>
<!--<script src="{{url('app/plugins/highcharts_4.2.5/highchart.js')}}"></script>-->
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script src="http://code.highcharts.com/modules/offline-exporting.js"></script>
<!--<script src="{{url('app/plugins/highcharts_4.2.5/exporting.js')}}"></script>-->
<!-- Additional files for the Highslide popup effect -->
<script src="https://www.highcharts.com/samples/static/highslide-full.min.js"></script>
<script src="https://www.highcharts.com/samples/static/highslide.config.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="https://www.highcharts.com/samples/static/highslide.css" />
<!--<script type="text/javascript" src="{{url('app/plugins/Highcharts-4.2.5/js/highcharts.js')}}"></script>-->
<style>
    .highcharts-container {
        /*background: url('http://localhost:8080/pvtflightnew/public/media/images/Load-Trim-Graph-2.png') top left no-repeat;*/
        /*background: url('media/images/lnt.png') top left no-repeat;*/
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
    /*        .highcharts-button,.highcharts-title{
		display: none;
	    }*/
</style>

<script>
    $(function () {

        var chart1 = new Highcharts.Chart({
            exporting: {
                chartOptions: {// specific options for the exported image
                    plotOptions: {
                        series: {
                            dataLabels: {
                                enabled: true
                            }
                        }
                    }
                },
                scale: 3,
                fallbackToExportServer: false
            },
            chart: {
                renderTo: 'Div1',
                width: 360,
                height: 510,
                events: {
                    load: function () {
                        this.renderer.image(base_url + '/media/images/lnt.png', 0, 0, 350, 500)
                                .add();

                    }
                }
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
                gridLineWidth: 0,
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
                {showInLegend: false,
                    name: 'ZFW',
                    type: 'spline',
                    color: '#00ff00',
                    "marker": {
                        "symbol": "circle"
                    },
//                        pointInterval: 1000,
                    data: [0, 0],
                },
                {showInLegend: false,
                    name: 'TOW',
                    type: 'spline',
                    color: 'gray',
                    "marker": {
                        "symbol": "circle"
                    },
//                        pointInterval: 1000,
                    data: [0, 0],
                },
                {showInLegend: false,
                    name: 'LW',
                    type: 'spline',
                    color: 'blue',
                    "marker": {
                        "symbol": "circle"
                    },
//                        pointInterval: 1000,
                    data: [0, 0],
                }
            ]
        });
    });
</script>

<div class="page">  
    @include('includes.new_header',[])
    <section>
        <div class="container">
            <div class="row">
                <div class="lt-sec">
                    <div class="col-xs-12 col-sm-12 col-md-12 lt-xs-pad-5">
                        <form name="lnt_form"  method="POST" role="form" id="lnt_form" class="lt-tc-form">
                            <div class="col-xs-12 col-sm-12 col-md-6 lt-pad-lr-0 lt-xs-pad-5">
                                <div class="lt-left-sec">
                                    <div class="col-xs-12 lt-pad-lr-0 lt-left-head">
                                        <div class="form-group lt-column-head-01">
                                            <span>ITEM</span>
                                        </div>
                                        <div class="form-group lt-column-head-02">
                                            <span>Weight (lbs)</span>
                                        </div>
                                        <div class="form-group lt-column-head-02">
                                            <span>ARM (Inches)</span>
                                        </div>
                                        <div class="form-group lt-column-head-02">
                                            <span>Moment/1000</span>
                                        </div>
                                    </div>
                                    <!-- <div class="col-xs-12 lt-pad-lr-0">
                                        <div class="form-group lt-column-1 ">
                                            <input type="text" class="form-control lt-fc-center" id="item2" value="PIC" disabled>
                                        </div>
                                        <div class="form-group lt-column-2">
                                            <input type="text" class="form-control lt-fc-center get_moment" id="weight2" value="170" readonly>
                                        </div>
                                        <div class="form-group lt-column-3">
                                            <input type="text" class="form-control lt-fc-center" id="arm2" value="255" readonly>
                                        </div>
                                        <div class="form-group lt-column-4">
                                            <input type="text" class="form-control lt-fc-center" id="moment2" value="43.35" readonly>
                                        </div>
                                        <div class="form-group lt-column-5">
                                            <input type="text" class="form-control lt-fc-center" id="cg2" value="36.42" readonly>
                                        </div> 
                                    </div>
                                    <div class="col-xs-12 lt-pad-lr-0">
                                        <div class="form-group lt-column-1 ">
                                            <input type="text" class="form-control lt-fc-center" id="item3" value="SIC" disabled>
                                        </div>
                                        <div class="form-group lt-column-2">
                                            <input type="text" class="form-control lt-fc-center get_moment" id="weight3" value="170" readonly>
                                        </div>
                                        <div class="form-group lt-column-3">
                                            <input type="text" class="form-control lt-fc-center" id="arm3" value="255" readonly>
                                        </div>
                                        <div class="form-group lt-column-4">
                                            <input type="text" class="form-control lt-fc-center" id="moment3" value="43.35" readonly>
                                        </div>
                                        <div class="form-group lt-column-5">
                                            <input type="text" class="form-control lt-fc-center" id="cg3" value="36.42" readonly>
                                        </div> 
                                    </div> -->
                                    <div class="pax_checkbox">
                                        <div class="col-xs-12 lt-pad-l-11">
                                            <div class="form-group lt-column-1 lt-box">
                                                <label class="lt-label-left" id="item5" name="item5">JUMP</label>
                                                <div class="lt-box-checkbox">
                                                    <label data-label="weight5" class="label_radio"><input type="checkbox" value="170" id="jump_yes" class="lt-jump-cb" name="jump"><span class="lt-radio-text"> Yes</span></label>
                                                    <label data-label="weight5"  class="label_radio"><input type="checkbox" value="" id="jump_no" class="lt-jump-cb" name="jump"><span class="lt-radio-text"> No</span></label>
                                                </div>
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center get_moment lt-wr" readonly="readonly" id="weight5" name="weight5" value="">
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center" id="arm5" name="arm5" value="290.00" readonly>
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center lt-wr" id="moment5" name="moment5" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 lt-pad-l-11">
                                            <div class="form-group lt-column-1 lt-box">
                                                <label class="lt-label-left" id="item6" name="item6">PAX 1</label>
                                                <div class="lt-box-checkbox-2">
                                                    <label data-label="weight6" class="label_radio"><input type="checkbox" name="pax1" id="pax1_1" value="170" class="lt-adult-cb1"><span class="lt-radio-text"> Adult</span></label>
                                                    <label data-label="weight6" class="label_radio"><input type="checkbox" name="pax1" id="pax1_2" value="77"  class="lt-adult-cb1"> <span class="lt-radio-text">Child</span></label>
                                                </div>
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center get_moment lt-wr" readonly="readonly" id="weight6" name="weight6" value="">
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center" id="arm6" name="arm6" value="376.00" readonly>
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center lt-wr" id="moment6" name="moment6" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 lt-pad-l-11">
                                            <div class="form-group lt-column-1 lt-box">
                                                <label class="lt-label-left" id="item7" name="item7">PAX 2</label>
                                                <div class="lt-box-checkbox-2">
                                                    <label class="label_radio" data-label="weight7"><input type="checkbox" name="pax2" id="pax2_1" value="170" class="lt-adult-cb2"><span class="lt-radio-text"> Adult</span></label>
                                                    <label class="label_radio" data-label="weight7"><input type="checkbox" name="pax2" id="pax2_2" value="77" class="lt-adult-cb2"><span class="lt-radio-text"> Child</span></label>
                                                </div>
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center get_moment lt-wr" readonly="readonly" id="weight7" name="weight7" value="">
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center" id="arm7" name="arm7" value="376.00" readonly>
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center lt-wr" id="moment7" name="moment7" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 lt-pad-l-11">
                                            <div class="form-group lt-column-1 lt-box">
                                                <label class="lt-label-left" id="item8" name="item8">PAX 3</label>
                                                <div class="lt-box-checkbox-2 lt-po-i">
                                                    <label class="label_radio" data-label="weight8"><input type="checkbox" name="pax3" id="pax3_1" value="170" class="lt-adult-cb3"><span class="lt-radio-text"> Adult</span></label>
                                                    <label class="label_radio" data-label="weight8"><input type="checkbox" name="pax3" id="pax3_2" value="77" class="lt-adult-cb3"><span class="lt-radio-text"> Child</span></label>
                                                    <label class="label_radio" data-label="weight8" style="display:block"><input name="pax3" id="pax3_3" value="192" type="checkbox"><span class="lt-radio-text"> Infant</span></label>
                                                </div>
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center get_moment lt-wr" readonly="readonly"  id="weight8" name="weight8" value="">
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center" id="arm8" name="arm8" value="424.00" readonly>
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center lt-wr" id="moment8" name="moment8" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 lt-pad-l-11">
                                            <div class="form-group lt-column-1 lt-box">
                                                <label class="lt-label-left" id="item9" name="item9">PAX 4</label>
                                                <div class="lt-box-checkbox-2">
                                                    <label class="label_radio" data-label="weight9"><input type="checkbox" name="pax4" id="pax4_1" value="170" class="lt-adult-cb4"><span class="lt-radio-text"> Adult </span></label>
                                                    <label class="label_radio" data-label="weight9"><input type="checkbox" name="pax4" id="pax4_2" value="77" class="lt-adult-cb4"><span class="lt-radio-text"> Child</span></label>
                                                </div>
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center get_moment lt-wr" readonly="readonly" id="weight9" name="weight9" value="">
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center" id="arm9" name="arm9" value="424.00" readonly>
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center lt-wr" id="moment9" name="moment9" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 lt-pad-l-11">
                                            <div class="form-group lt-column-1 lt-box">
                                                <label class="lt-label-left" id="item10" name="item10">PAX 5</label>
                                                <div class="lt-box-checkbox-2">
                                                    <label class="label_radio" data-label="weight10"><input type="checkbox" name="pax5" id="pax5_1" value="170" class="lt-adult-cb5"><span class="lt-radio-text"> Adult</span></label>
                                                    <label class="label_radio" data-label="weight10"><input type="checkbox" name="pax5" id="pax5_2" value="77" class="lt-adult-cb5"><span class="lt-radio-text"> Child</span></label>
                                                </div>
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center get_moment lt-wr" readonly="readonly" id="weight10" name="weight10" value="">
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center" id="arm10" name="arm10" value="460.00" readonly>
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center lt-wr" id="moment10" name="moment10" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 lt-pad-l-11">
                                            <div class="form-group lt-column-1 lt-box">
                                                <label class="lt-label-left" id="item11" name="item11">PAX 6</label>
                                                <div class="lt-box-checkbox-2 lt-po-i">
                                                    <label data-label="weight11" class="label_radio"><input type="checkbox" name="pax6" id="pax6_1" value="170" class="lt-adult-cb6"><span class="lt-radio-text"> Adult</span></label>
                                                    <label data-label="weight11" class="label_radio"><input type="checkbox" name="pax6" id="pax6_2" value="77" class="lt-adult-cb6"><span class="lt-radio-text"> Child</span></label>
                                                    <label data-label="weight11" class="label_radio" style="display:block"><input type="checkbox" value="192" id="pax6_3" name="pax6"><span class="lt-radio-text"> Infant</span></label>
                                                </div>
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center get_moment lt-wr" readonly="readonly" id="weight11" name="weight11" value="">
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center" id="arm11" name="arm11" value="470.00" readonly>
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center lt-wr" id="moment11" name="moment11" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 lt-pad-l-11">
                                            <div class="form-group lt-column-1 lt-box">
                                                <label class="lt-label-left" id="item12" name="item12">PAX 7</label>
                                                <div class="lt-box-checkbox-2">
                                                    <label class="label_radio" data-label="weight12"><input type="checkbox" name="pax7" id="pax7_1" value="170" class="lt-adult-cb7"><span class="lt-radio-text"> Adult</span></label>
                                                    <label class="label_radio" data-label="weight12"><input type="checkbox" name="pax7" id="pax7_2" value="77" class="lt-adult-cb7"><span class="lt-radio-text"> Child</span></label>
                                                </div>
                                            </div>
                                            <div class="form-group lt-column-02"> 
                                                <input type="text" class="form-control lt-fc-center get_moment lt-wr" readonly="readonly" id="weight12" name="weight12" value="">
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center" id="arm12" name="arm12" value="480.00" readonly>
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center lt-wr" id="moment12" name="moment12" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 lt-pad-l-11">
                                            <div class="form-group lt-column-1 lt-box">
                                                <label class="lt-label-left" id="item13" name="item13">PAX 8</label>
                                                <div class="lt-box-checkbox-2">
                                                    <label class="label_radio" data-label="weight13"><input type="checkbox" name="pax8" id="pax8_1" value="170" class="lt-adult-cb8"><span class="lt-radio-text"> Adult</span></label>
                                                    <label class="label_radio" data-label="weight13"><input type="checkbox" name="pax8" id="pax8_2" value="77" class="lt-adult-cb8"><span class="lt-radio-text"> Child</span></label>
                                                </div>
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center get_moment lt-wr" readonly="readonly" id="weight13" name="weight13" value="">
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center" id="arm13" name="arm13" value="500.00" readonly>
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center lt-wr" id="moment13" name="moment13" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 lt-pad-l-11">
                                            <div class="form-group lt-column-1 lt-box">
                                                <label class="lt-label-left" name="pax9" id="item14" name="item14">PAX 9</label>
                                                <div class="lt-box-checkbox-2">
                                                    <label class="label_radio" data-label="weight14"><input type="checkbox" name="pax9" id="pax9_1" value="170" class="lt-adult-cb9"><span class="lt-radio-text"> Adult</span></label>
                                                    <label class="label_radio" data-label="weight14"><input type="checkbox" name="pax9" id="pax9_2" value="77" class="lt-adult-cb9"><span class="lt-radio-text"> Child</span></label>
                                                </div>
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center get_moment lt-wr" readonly="readonly" id="weight14" name="weight14" value="">
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center" id="arm14" name="arm14" value="513.00" readonly>
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center lt-wr" id="moment14" name="moment14" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 lt-pad-l-11">
                                            <div class="form-group lt-column-1 lt-box">
                                                <label class="lt-label-left" id="item15" name="item15">PAX 10</label>
                                                <div class="lt-box-checkbox-2">
                                                    <label class="label_radio" data-label="weight15"><input type="checkbox" name="pax10" id="pax10_1" value="170" class="lt-adult-cb10"><span class="lt-radio-text"> Adult</span></label>
                                                    <label class="label_radio" data-label="weight15"><input type="checkbox" name="pax10" id="pax10_2" value="77" class="lt-adult-cb10"><span class="lt-radio-text"> Child</span></label>
                                                </div>
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center get_moment lt-wr" readonly="readonly" id="weight15" name="weight15" value="">
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center" id="arm15" name="arm15" value="520.00" readonly>
                                            </div>
                                            <div class="form-group lt-column-02">
                                                <input type="text" class="form-control lt-fc-center lt-wr" id="moment15" name="moment15" value="" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 lt-pad-l-11">
                                        <div class="form-group lt-column-001 ">
                                            <input type="text" class="form-control lt-fc-center" style="font-weight: bold" id="item16" name="item16" value="FC (MAX 25 lbs)" disabled>
                                        </div>

                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center get_moment numeric disable_paste max_value_valid2 bags_fc" onkeyup="this.value = minmax(this.value, 0, 25)" maxlength="2" max="25" id="weight16" name="fc" value="0">
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" id="arm16" name="arm16" value="295.00" readonly>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center lt-wr" id="moment16" name="moment16" value="" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 lt-pad-l-11">
                                        <div class="form-group lt-column-001 ">
                                            <input type="text" class="form-control lt-fc-center" style="font-weight: bold" id="item17" name="item17" value="BAGS (Max 350 lbs)" disabled>
                                        </div>

                                        <div class="form-group lt-column-02">
                                            <input type="text" min="20" max="350" maxlength="3" class="form-control lt-fc-center get_moment numeric disable_paste max_value_valid2 bags_fc" onkeyup="this.value = minmax(this.value, 0, 350)" id="weight17" name="bags" value="20" >
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" id="arm17" name="arm17" value="605.00" readonly>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center lt-wr" id="moment17" name="moment17" value="" readonly>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 lt-pad-l-11">
                                        <div class="form-group lt-column-001 ">
                                            <input type="text" class="form-control lt-fc-center" style="font-weight: bold" id="item18" name="item18" value="Take-Off Fuel" disabled>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center get_moment numeric disable_paste bags_fc" onkeyup="this.value = minmax(this.value, 0, 20000)" maxlength="5" id="weight18" name="take_off_fuel">
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" id="arm18" name="arm18" value="" readonly>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" id="moment18" name="moment18" value="" readonly>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 lt-pad-l-11">
                                        <div class="form-group lt-column-001 ">
                                            <input type="text" class="form-control lt-fc-center" style="font-weight: bold" id="item19" name="item19" value="Landing Fuel" disabled>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center get_moment numeric disable_paste bags_fc" maxlength="5" id="weight19" name="landing_fuel" value="">
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center get_moment" id="arm19" name="arm19" value="" readonly>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" id="moment19" name="moment19" value="" readonly>

                                        </div>

                                    </div>


				    <div class="lt-left-cal">
					<div class="col-xs-12">
					    <div class="form-group calc-btn" style="margin-left:36%">                                        
						<button  class="btn btn-calculate1 newbtn calculate_lnt w100" style="height:29px; padding:0px;font-size:12px" disabled="disabled">Calculate</button>
						<div class="lnt_loading2"></div>
					    </div>
					    <div class="form-group lt-column-5 save-print-btn" style="margin-top: 11px;margin-left: 69px;font-size: 14px">
						<a class="print-btn">PRINT</a>
					    </div>
					</div>
				    </div>
				</div>
                                <div class="lt-left-sec2">
                                    <div class="col-xs-12 lt-pad-lr-0 lt-left-head">
                                        <div class="form-group" style="padding:5px;margin-bottom:0">
                                            <span>VTNGS FLIGHT DETAILS</span>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 lt-pad-l-11">

                                        <div class="form-group lt-left-sec2-column1">
                                            <input type="text" autocomplete="off" data-url="{{url('/fpl/get_callsign_details')}}" value="{{ date('ymd') }}"  style="background: white; text-align:left;padding-left:25px;" class="form-control text-center font-bold from_date pointer" placeholder="Date of Flight" name="date_of_flight" id="date_of_flight" minlength="6" maxlength="6" tabindex="5" readonly>
                                        </div>

                                        <div class="form-group lt-left-sec2-column2">
                                            <input type="text" class="form-control lt-fc-center alphabets text_uppercase" id="departure_aerodrome" name="departure_aerodrome" minlength="4" maxlength="4" placeholder="FROM">
                                        </div>
                                        <div class="form-group lt-left-sec2-column2">
                                            <input type="text" class="form-control lt-fc-center alphabets text_uppercase" id="destination_aerodrome" name="destination_aerodrome" minlength="4" maxlength="4" placeholder="TO">
                                        </div>         
                                    </div>
                                    <div class="col-xs-12 lt-pad-l-11">
                                        <div class="form-group lt-left-sec2-column1">
                                            <input type="text" class="form-control lt-fc-center numeric" minlength="4" id="departure_time" name="departure_time" maxlength="4" placeholder="DEP TIME">
                                        </div>
                                        <div class="form-group lt-left-sec2-column2">
                                            <input type="text" class="form-control lt-fc-center alphabets text_uppercase" id="pilot_in_command" name="pilot_in_command" placeholder="PIC">
                                        </div>
                                        <div class="form-group lt-left-sec2-column2">
                                            <input type="text" class="form-control lt-fc-center alphabets text_uppercase" id="copilot" name="copilot" placeholder="CO PILOT">
                                        </div>         
                                    </div>
                                </div>
                            </div><!--End of left sec -->
                            <div class="col-xs-12 col-sm-12 col-md-6 norightpad">
                                <div class="lt-right-sec">
                                    <div class="col-xs-12 lt-pad-lr-0 lt-right-head">
                                        <div class="form-group lt-column-head-1">
                                            <span>ITEM</span>
                                        </div>
                                        <div class="form-group lt-column-head-2">
                                            <span>Weight (lbs)</span>
                                        </div>
                                        <div class="form-group lt-column-head-2">
                                            <span>ARM (Inches)</span>
                                        </div>
                                        <div class="form-group lt-column-head-2" style="margin-left:3px;">
                                            <span>Moment/1000</span>
                                        </div>
                                        <div class="form-group lt-column-head-2">
                                            <span>% MAC</span>
                                        </div>  
                                    </div>
                                    <div class="lt-pad-lr-8 lt-tc-form" >
                                        <div class="col-xs-12 lt-pad-lr-2">
                                            <div class="form-group lt-column-1">
                                                <input type="text" class="form-control lt-fc-center" style="font-weight: bold" id="item1" name="item1" value="C.E.W" disabled>
                                            </div>
                                            <div class="form-group lt-column-2">
                                                <input type="text" class="form-control lt-fc-center1 get_moment" value="26754.31" id="weight1" name="weight1" readonly>
                                            </div>
                                            <div class="form-group lt-column-3">
                                                <input type="text" class="form-control lt-fc-center1" id="arm1" name="arm1" value="523.46" readonly>
                                            </div>
                                            <div class="form-group lt-column-4">
                                                <input type="text" class="form-control lt-fc-center1" id="moment1" name="moment1"  value="14004.81" readonly>
                                            </div>
                                            <div class="form-group lt-column-5">
                                                <input type="text" class="form-control lt-fc-center1" id="cg1" name="cg1" value="38.25" readonly>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 lt-pad-lr-2">
                                            <div class="form-group lt-column-1 ">
                                                <input type="text" class="form-control lt-fc-center" style="font-weight: bold" value="D.O.W" id="item4" name="item4" disabled>
                                            </div>
                                            <div class="form-group lt-column-2">
                                                <input type="text" class="form-control lt-fc-center1 get_moment" id="weight4" name="weight4" value="27094.31" readonly>
                                            </div>
                                            <div class="form-group lt-column-3">
                                                <input type="text" class="form-control lt-fc-center1" id="arm4" name="arm4" value="520.09" readonly>
                                            </div>
                                            <div class="form-group lt-column-4">
                                                <input type="text" class="form-control lt-fc-center1" id="moment4" name="moment4" value="14091.51" readonly>
                                            </div>
                                            <div class="form-group lt-column-5">
                                                <input type="text" class="form-control lt-fc-center1" id="cg4" name="cg4" value="34.61" readonly>
                                            </div> 
                                        </div>

                                        <div id="zero_fuel_valid" class="col-xs-12 lt-pad-lr-2">
                                            <div class="form-group lt-column-1 ">
                                                <input type="text" class="form-control lt-fc-center lt-bg-grey" style="font-weight: bold" id="item20" name="item20" value="Zero Fuel Weight" disabled>
                                            </div>
                                            <div class="form-group lt-column-2">
                                                <input type="text" class="form-control lt-fc-center1 get_moment lt-bg-grey" id="weight20" name="zero_fuel_weight" value="27094" readonly>
                                            </div>
                                            <div class="form-group lt-column-3">
                                                <input type="text" class="form-control lt-fc-center1 lt-bg-grey" id="arm20" name="zero_fuel_arm" value="520.09" readonly>
                                            </div>
                                            <div class="form-group lt-column-4">
                                                <input type="text" class="form-control lt-fc-center1 lt-bg-grey" id="moment20" name="zero_fuel_moment" value="14091.51" readonly>
                                            </div>
                                            <div class="form-group lt-column-5">
                                                <input type="text" class="form-control lt-fc-center1 lt-bg-grey" id="cg20" name="zero_fuel_cg" value="34.61" readonly>
                                            </div>
                                        </div>

                                        <div id="take_off_valid" class="col-xs-12 lt-pad-lr-2">
                                            <div class="form-group lt-column-1 ">
                                                <input type="text" class="form-control lt-fc-center lt-bg-lgreen" id="item21" name="item21" style="font-weight: bold" value="Take Off Weight" disabled>
                                            </div>
                                            <div class="form-group lt-column-2">
                                                <input type="text" class="form-control lt-fc-center1 get_moment lt-bg-lgreen" id="weight21" name="take_off_fuel_weight" value="" readonly>
                                            </div>
                                            <div class="form-group lt-column-3">
                                                <input type="text" class="form-control lt-fc-center1 lt-bg-lgreen" id="arm21" name="take_off_fuel_arm" value="" readonly>
                                            </div>
                                            <div class="form-group lt-column-4">
                                                <input type="text" class="form-control lt-fc-center1 lt-bg-lgreen" id="moment21" name="take_off_fuel_moment" value="" readonly>
                                            </div>
                                            <div class="form-group lt-column-5">
                                                <input type="text" class="form-control lt-fc-center1 lt-bg-lgreen" data-url="{{url('postlnt/get_trim_setting')}}" id="cg21" name="take_off_fuel_cg" value="" readonly>
                                            </div>
                                        </div>

                                        <div id="landing_valid" class="col-xs-12 lt-pad-lr-2">
                                            <div class="form-group lt-column-1 ">
                                                <input type="text" class="form-control lt-fc-center lt-bg-skyblue" id="item22" name="item22" style="font-weight: bold" value="Landing Weight" disabled>
                                            </div>
                                            <div class="form-group lt-column-2">
                                                <input type="text" class="form-control lt-fc-center1 get_moment lt-bg-skyblue" id="weight22" name="landing_fuel_weight" value="" readonly>
                                            </div>
                                            <div class="form-group lt-column-3">
                                                <input type="text" class="form-control lt-fc-center1 lt-bg-skyblue" id="arm22" name="landing_fuel_arm" value="" readonly>
                                            </div>
                                            <div class="form-group lt-column-4">
                                                <input type="text" class="form-control lt-fc-center1 lt-bg-skyblue" id="moment22" name="landing_fuel_moment" value="" readonly>
                                            </div>
                                            <div class="form-group lt-column-5">
                                                <input type="text" class="form-control lt-fc-center1 lt-bg-skyblue" id="cg22" name="landing_fuel_cg" value="" readonly>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 lt-pad-lr-2">
                                            <div class="form-group lt-column-1">
                                                <input type="text" class="form-control lt-fc-center" id="item23" name="item23" style="font-weight: bold" value="Take Off Trim Setting ">
                                            </div>
                                            <div class="form-group lt-column-4">
                                                <input type="text" class="form-control lt-fc-center1 lt-wr" id="weight23" name="trim_setting" readonly>
                                            </div>
                                            <div class="form-group calc-btn">
                                                <!--<input type="button" value="Calculate">-->
                                                <button type="button" class="btn btn-calculate1 newbtn calculate_lnt w100" style="height:29px; padding:0px;font-size:12px" disabled="disabled">Calculate</button>
                                                <div class="lnt_loading2"></div>
                                            </div>

                                            <div class="form-group lt-column-5 save-print-btn" style="margin-top: 10px">
                                                <!--                                        <a class="save-btn">SAVE</a>-->
                                                <a class="print-btn save_lnt_data" data-url="{{url('/postlnt/save_lnt_data')}}"> PRINT </a>
                                                <!--<a class="print-btn " data-url="{{url('/postlnt/save_lnt_data')}}"> SAVE </a>-->
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="lt-right-sec pull-left">
                                    <div class="col-sm-4 col-md-3 p-0 text-center relative" style="padding-top:50px;">
                                        <!--<img class="p-t-20 p-b-20" style="padding-top:30px;" src="{{url('app/new_temp/images/flight-image.png')}}">-->
                                        <div class="aeroplane_div">
                                            <div class="aeroplane-image"><img src="{{url('media/images/flightseats/flight-image-with-no-seats.png')}}" ></div>
                                            <div class="seats relative">
                                                <ul class="airhoser-seat">
                                                    <li class="front_seatbg"><a><span class="front">J</span></a></li>
                                                </ul>
                                                <div class="clearfix"></div>                                            
                                                <ul class="rowposition">
                                                    <li class="back_seatbg"><a><span class="front">1</span></a></li>
                                                    <li class="back_seatbg"><a><span class="front">2</span></a></li>
                                                </ul>
                                                <div class="clearfix"></div> 
                                                <ul  class="rowposition">
                                                    <li class="front_seatbg"><a><span class="front">3</span></a></li>
                                                    <li class="front_seatbg"><a><span class="front">4</span></a></li>
                                                </ul>  
                                                <div class="clearfix"></div>                                          
                                                <ul class="rowposition">
                                                    <li class="back_seatbg"><a><span class="front">6</span></a></li>
                                                    <li class="back_seatbg"><a><span class="front">5</span></a></li>
                                                </ul>
                                                <div class="clearfix"></div>                                          
                                                <ul class="rowposition">
                                                    <li style="margin-top:0;margin-bottom:0;cursor: default;"></li>
                                                    <li class="rotate_seatbg"><a><span class="back">7</span></a></li>
                                                </ul>
                                                <div class="clearfix"></div>                                          
                                                <ul class="rowposition">
                                                    <li style="margin-top:0;margin-bottom:0;cursor: default;"></li>
                                                    <li class="rotate_seatbg"><a><span class="back">8</span></a></li>
                                                </ul>
                                                <div class="clearfix"></div>                                          
                                                <ul class="rowposition">
                                                    <li class="front_seatbg"><a><span class="back">9</span></a></li>
                                                    <li class="rotate_seatbg"><a><span class="back">10</span></a></li>
                                                </ul>
                                            </div>
                                        </div><!-- end of aeroplane -->
                                    </div>				
                                    <div class="col-sm-8 col-md-9 p-0">
                                        <div id="Div1" style="height:500px;width:100%; margin: 0 auto"></div>
                                        <!--					<div id="max_zero_fuel" class=""></div>
                                                                                <div id="max_takeoff_fuel" class=""></div>
                                                                                <div id="max_landing_fuel" class=""></div>-->
                                    </div>
                                </div>
                            </div><!--End of right sec -->
                            <!--Hidden fields-->
                            <input type="hidden" name="aircraft_callsign" id="aircraft_callsign" value="vtngs" />
                            <input type="hidden" name="current_date" id="current_date" value="{{date('ymd')}}" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('includes.new_footer',[])
</div>
@stop