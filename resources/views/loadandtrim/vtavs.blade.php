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
        /*background: url('http://localhost:8080/pvtflightnew/public/media/images/Load-Trim-Graph-2.png') top left no-repeat;*/
        background: url('../media/images/lnt.png') top left no-repeat;
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

    .lt-left-cal {
        width: 100%;
        float: left;
        margin-top: 10px;
    }

    .vtavs-flight {
        padding-top: 20px;
    }

    .vtavs-graph {
        padding: 19px 0 0;
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

<div class="page">
    @include('includes.new_header',[])
    <section>
        <div class="container">
            <div class="row">
                <div class="lt-sec">
                    <div class="col-xs-12 col-sm-12 col-md-12 lt-xs-pad-5">

                        <div class="col-xs-12 col-sm-12 col-md-6 lt-pad-lr-0 lt-xs-pad-5">
                            <div class="lt-left-sec">
                                <form method="post" name="" id="" class="lt-tc-form">

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

                                    <!-- <div class="col-xs-12 lt-pad-l-11">
                                        <div class="form-group lt-column-1 lt-box">
                                            <label class="lt-label-left" id="item5">JUMP</label>
                                            <div class="lt-box-checkbox">
                                                <label data-label="weight5" class="label_radio"><input type="checkbox" value="170" id="jump_yes" class="lt-jump-cb" name="jump"><span class="lt-radio-text"> Yes</span></label>
                                                <label data-label="weight5"  class="label_radio"><input type="checkbox" value="" id="jump_no" class="lt-jump-cb" name="jump"><span class="lt-radio-text"> No</span></label>
                                            </div>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center get_moment lt-wr" readonly="readonly" id="weight5" value="">
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" id="arm5" value="290.00" readonly>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center lt-wr" id="moment5" value="" readonly>
                                        </div>
                                    </div> -->

                                    <div class="col-xs-12 lt-pad-l-11">
                                        <div class="form-group lt-column-1 lt-box">
                                            <label class="lt-label-left" id="item6">PAX 1</label>
                                            <div class="lt-box-checkbox-2">
                                                <label data-label="weight6" class="label_radio"><input type="checkbox" name="pax1" id="pax1_1" value="170" class="lt-adult-cb1"><span class="lt-radio-text"> Adult</span></label>
                                                <label data-label="weight6" class="label_radio"><input type="checkbox" name="pax1" id="pax1_2" value="77"  class="lt-adult-cb1"> <span class="lt-radio-text">Child</span></label>
                                            </div>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center get_moment lt-wr" readonly="readonly" id="weight6" value="">
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" id="arm6" value="170.71" readonly>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center lt-wr" id="moment6" value="" readonly>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 lt-pad-l-11">
                                        <div class="form-group lt-column-1 lt-box">
                                            <label class="lt-label-left" id="item7">PAX 2</label>
                                            <div class="lt-box-checkbox-2">
                                                <label class="label_radio" data-label="weight7"><input type="checkbox" name="pax2" id="pax2_1" value="170" class="lt-adult-cb2"><span class="lt-radio-text"> Adult</span></label>
                                                <label class="label_radio" data-label="weight7"><input type="checkbox" name="pax2" id="pax2_2" value="77" class="lt-adult-cb2"><span class="lt-radio-text"> Child</span></label>
                                            </div>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center get_moment lt-wr" readonly="readonly" id="weight7" value="">
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" id="arm7" value="170.71" readonly>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center lt-wr" id="moment7" value="" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 lt-pad-l-11">
                                        <div class="form-group lt-column-1 lt-box">
                                            <label class="lt-label-left" id="item8">PAX 3</label>
                                            <div class="lt-box-checkbox-2 lt-po-i" style="padding-top:8px">
                                                <label class="label_radio" data-label="weight8"><input type="checkbox" name="pax3" id="pax3_1" value="170" class="lt-adult-cb3"><span class="lt-radio-text"> Adult</span></label>
                                                <label class="label_radio" data-label="weight8"><input type="checkbox" name="pax3" id="pax3_2" value="77" class="lt-adult-cb3"><span class="lt-radio-text"> Child</span></label>
                                                <!-- <label class="label_radio" data-label="weight8" style="display:block"><input name="pax3" id="pax3_3" value="192" type="checkbox"><span class="lt-radio-text"> Infant</span></label> -->
                                            </div>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center get_moment lt-wr" readonly="readonly" id="weight8" value="">
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" id="arm8" value="220.94" readonly>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center lt-wr" id="moment8" value="" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 lt-pad-l-11">
                                        <div class="form-group lt-column-1 lt-box">
                                            <label class="lt-label-left" id="item9">PAX 4</label>
                                            <div class="lt-box-checkbox-2">
                                                <label class="label_radio" data-label="weight9"><input type="checkbox" name="pax4" id="pax4_1" value="170" class="lt-adult-cb4"><span class="lt-radio-text"> Adult </span></label>
                                                <label class="label_radio" data-label="weight9"><input type="checkbox" name="pax4" id="pax4_2" value="77" class="lt-adult-cb4"><span class="lt-radio-text"> Child</span></label>
                                            </div>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center get_moment lt-wr" readonly="readonly" id="weight9" value="">
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" id="arm9" value="220.94" readonly>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center lt-wr" id="moment9" value="" readonly>
                                        </div>
                                    </div>

                                    <!-- <div class="col-xs-12 lt-pad-l-11">
                                        <div class="form-group lt-column-1 lt-box">
                                            <label class="lt-label-left" id="item10">PAX 5</label>
                                            <div class="lt-box-checkbox-2">
                                                <label class="label_radio" data-label="weight10"><input type="checkbox" name="pax5" id="pax5_1" value="170" class="lt-adult-cb5"><span class="lt-radio-text"> Adult</span></label>
                                                <label class="label_radio" data-label="weight10"><input type="checkbox" name="pax5" id="pax5_2" value="77" class="lt-adult-cb5"><span class="lt-radio-text"> Child</span></label>
                                            </div>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center get_moment lt-wr" readonly="readonly" id="weight10" value="">
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" id="arm10" value="245.67" readonly>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center lt-wr" id="moment10" value="" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 lt-pad-l-11">
                                        <div class="form-group lt-column-1 lt-box">
                                            <label class="lt-label-left" id="item11">PAX 6</label>
                                            <div class="lt-box-checkbox-2 lt-po-i">
                                                <label data-label="weight11" class="label_radio"><input type="checkbox" name="pax6" id="pax6_1" value="170" class="lt-adult-cb6"><span class="lt-radio-text"> Adult</span></label>
                                                <label data-label="weight11" class="label_radio"><input type="checkbox" name="pax6" id="pax6_2" value="77" class="lt-adult-cb6"><span class="lt-radio-text"> Child</span></label>
                                                <label data-label="weight11" class="label_radio" style="display:block"><input type="checkbox" value="192" id="pax6_3" name="pax6"><span class="lt-radio-text"> Infant</span></label>
                                            </div>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center get_moment lt-wr" readonly="readonly"id="weight11" value="">
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" id="arm11" value="287.79" readonly>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center lt-wr" id="moment11" value="" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 lt-pad-l-11">
                                        <div class="form-group lt-column-1 lt-box">
                                            <label class="lt-label-left" id="item12">PAX 7</label>
                                            <div class="lt-box-checkbox-2">
                                                <label class="label_radio" data-label="weight12"><input type="checkbox" name="pax7" id="pax7_1" value="170" class="lt-adult-cb7"><span class="lt-radio-text"> Adult</span></label>
                                                <label class="label_radio" data-label="weight12"><input type="checkbox" name="pax7" id="pax7_2" value="77" class="lt-adult-cb7"><span class="lt-radio-text"> Child</span></label>
                                            </div>
                                        </div>
                                        <div class="form-group lt-column-02"> 
                                            <input type="text" class="form-control lt-fc-center get_moment lt-wr" readonly="readonly" id="weight12" value="">
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" id="arm12" value="287.79" readonly>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center lt-wr" id="moment12" value="" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 lt-pad-l-11">
                                        <div class="form-group lt-column-1 lt-box">
                                            <label class="lt-label-left" id="item13">PAX 8</label>
                                            <div class="lt-box-checkbox-2">
                                                <label class="label_radio" data-label="weight13"><input type="checkbox" name="pax8" id="pax8_1" value="170" class="lt-adult-cb8"><span class="lt-radio-text"> Adult</span></label>
                                                <label class="label_radio" data-label="weight13"><input type="checkbox" name="pax8" id="pax8_2" value="77" class="lt-adult-cb8"><span class="lt-radio-text"> Child</span></label>
                                            </div>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center get_moment lt-wr" readonly="readonly" id="weight13" value="">
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" id="arm13" value="318.11" readonly>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center lt-wr" id="moment13" value="" readonly>
                                        </div>
                                    </div> -->
                                    <!-- <div class="col-xs-12 lt-pad-l-11">
                                        <div class="form-group lt-column-1 lt-box">
                                            <label class="lt-label-left" name="pax9" id="item14">PAX 9</label>
                                            <div class="lt-box-checkbox-2">
                                                <label class="label_radio" data-label="weight14"><input type="checkbox" name="pax9" id="pax9_1" value="170" class="lt-adult-cb9"><span class="lt-radio-text"> Adult</span></label>
                                                <label class="label_radio" data-label="weight14"><input type="checkbox" name="pax9" id="pax9_2" value="77" class="lt-adult-cb9"><span class="lt-radio-text"> Child</span></label>
                                            </div>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center get_moment lt-wr" readonly="readonly" id="weight14" value="">
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" id="arm14" value="513.00" readonly>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center lt-wr" id="moment14" value="" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 lt-pad-l-11">
                                        <div class="form-group lt-column-1 lt-box">
                                            <label class="lt-label-left" id="item15">PAX 10</label>
                                            <div class="lt-box-checkbox-2">
                                                <label class="label_radio" data-label="weight15"><input type="checkbox" name="pax10" id="pax10_1" value="170" class="lt-adult-cb10"><span class="lt-radio-text"> Adult</span></label>
                                                <label class="label_radio" data-label="weight15"><input type="checkbox" name="pax10" id="pax10_2" value="77" class="lt-adult-cb10"><span class="lt-radio-text"> Child</span></label>
                                            </div>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center get_moment lt-wr" readonly="readonly" id="weight15" value="">
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" id="arm15" value="520.00" readonly>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center lt-wr" id="moment15" value="" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 lt-pad-l-11">
                                        <div class="form-group lt-column-001 ">
                                            <input type="text" class="form-control lt-fc-center" style="font-weight: bold" id="item16" value="FC (MAX 25 lbs)" disabled>
                                        </div>

                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center get_moment numeric disable_paste max_value_valid2 bags_fc" onkeyup="this.value = minmax(this.value, 0, 25)" maxlength="2" max="25" id="weight16" value="0">
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" id="arm16" value="295.00" readonly>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center lt-wr" id="moment16" value="" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 lt-pad-l-11">
                                        <div class="form-group lt-column-001 ">
                                            <input type="text" class="form-control lt-fc-center" style="font-weight: bold" id="item17" value="BAGS (Max 350 lbs)" disabled>
                                        </div>

                                        <div class="form-group lt-column-02">
                                            <input type="text" min="20" max="350" maxlength="3" class="form-control lt-fc-center get_moment numeric disable_paste max_value_valid2 bags_fc" onkeyup="this.value = minmax(this.value, 0, 350)" id="weight17" value="20" >
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" id="arm17" value="605.00" readonly>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center lt-wr" id="moment17" value="" readonly>
                                        </div>
                                    </div> -->
                                    <div class="col-xs-12 lt-pad-l-11">
                                        <div class="form-group lt-column-001 ">
                                            <input type="text" class="form-control lt-fc-center" style="font-weight: bold" value="Fwd,Baggage Compt(Max 66 lbs)" disabled>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" value="5" disabled>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" value="45.47" readonly>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" value="227.35" readonly>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 lt-pad-l-11">
                                        <div class="form-group lt-column-001 ">
                                            <input type="text" class="form-control lt-fc-center" style="font-weight: bold" value="Wardrobe/Refreshment Cabinet" disabled>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" value="10" disabled>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" value="143.46" readonly>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" value="1434.60" readonly>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 lt-pad-l-11">
                                        <div class="form-group lt-column-001 ">
                                            <input type="text" class="form-control lt-fc-center" style="font-weight: bold" value="Lavatory Cabinet (Max 353 Lbs)" disabled>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" value="10" disabled>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" value="249.76" readonly>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" value="2497.60" readonly>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 lt-pad-l-11">
                                        <div class="form-group lt-column-001 ">
                                            <input type="text" class="form-control lt-fc-center" style="font-weight: bold" value="Aft Baggage Compt(Max 353 lbs)" disabled>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" value="50" disabled>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" value="314.29" readonly>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" value="15714.50" readonly>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 lt-pad-l-11">
                                        <div class="form-group lt-column-001 ">
                                            <input type="text" class="form-control lt-fc-center" style="font-weight: bold" id="item18" value="Take-Off Fuel" disabled>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center get_moment numeric disable_paste bags_fc" onkeyup="this.value = minmax(this.value, 0, 20000)" maxlength="5" id="weight18">
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" id="arm18" value="" readonly>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" id="moment18" value="" readonly>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 lt-pad-l-11">
                                        <div class="form-group lt-column-001 ">
                                            <input type="text" class="form-control lt-fc-center" style="font-weight: bold" id="item19" value="Landing Fuel" disabled>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center get_moment numeric disable_paste bags_fc" maxlength="5" id="weight19" value="">
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center get_moment" id="arm19" value="" readonly>
                                        </div>
                                        <div class="form-group lt-column-02">
                                            <input type="text" class="form-control lt-fc-center" id="moment19" value="" readonly>

                                        </div>

                                    </div>


                                </form>        
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
                            <div class="lt-left-sec2">
                                <div class="col-xs-12 lt-pad-lr-0 lt-left-head">
                                    <div class="form-group" style="padding:5px;margin-bottom:0">
                                        <span>VTAVS FLIGHT DETAILS</span>
                                    </div>
                                </div>
                                <div class="col-xs-12 lt-pad-l-11">
                                    <div class="form-group lt-left-sec2-column1">
                                        <input type="text" class="form-control lt-fc-center" placeholder="FLIGHT DATE">
                                    </div>
                                    <div class="form-group lt-left-sec2-column2">
                                        <input type="text" class="form-control lt-fc-center" placeholder="FROM">
                                    </div>
                                    <div class="form-group lt-left-sec2-column2">
                                        <input type="text" class="form-control lt-fc-center" placeholder="TO">
                                    </div>         
                                </div>
                                <div class="col-xs-12 lt-pad-l-11">
                                    <div class="form-group lt-left-sec2-column1">
                                        <input type="text" class="form-control lt-fc-center" placeholder="DEP DATE">
                                    </div>
                                    <div class="form-group lt-left-sec2-column2">
                                        <input type="text" class="form-control lt-fc-center" placeholder="PIC">
                                    </div>
                                    <div class="form-group lt-left-sec2-column2">
                                        <input type="text" class="form-control lt-fc-center" placeholder="CO PILOT">
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
				    <!-- <div class="col-xs-12 lt-pad-lr-2">
					<div class="form-group lt-column-1">
					    <input type="text" class="form-control lt-fc-center" style="font-weight: bold" id="item1" value="C.E.W" disabled>
					</div>
					<div class="form-group lt-column-2">
					    <input type="text" class="form-control lt-fc-center1 get_moment" value="26754.31" id="weight1" readonly>
					</div>
					<div class="form-group lt-column-3">
					    <input type="text" class="form-control lt-fc-center1" id="arm1" value="523.46" readonly>
					</div>
					<div class="form-group lt-column-4">
					    <input type="text" class="form-control lt-fc-center1" id="moment1" value="14004.81" readonly>
					</div>
					<div class="form-group lt-column-5">
					    <input type="text" class="form-control lt-fc-center1" id="cg1" value="38.25" readonly>
					</div>
				    </div>
    
				    <div class="col-xs-12 lt-pad-lr-2">
					<div class="form-group lt-column-1 ">
					    <input type="text" class="form-control lt-fc-center" style="font-weight: bold" value="D.O.W" id="item4" disabled>
					</div>
					<div class="form-group lt-column-2">
					    <input type="text" class="form-control lt-fc-center1 get_moment" id="weight4" value="27094.31" readonly>
					</div>
					<div class="form-group lt-column-3">
					    <input type="text" class="form-control lt-fc-center1" id="arm4" value="520.09" readonly>
					</div>
					<div class="form-group lt-column-4">
					    <input type="text" class="form-control lt-fc-center1" id="moment4" value="14091.51" readonly>
					</div>
					<div class="form-group lt-column-5">
					    <input type="text" class="form-control lt-fc-center1" id="cg4" value="34.61" readonly>
					</div> 
				    </div> -->

				    <div class="col-xs-12 lt-pad-lr-2">
					<div class="form-group lt-column-1">
					    <input type="text" class="form-control lt-fc-center" style="font-weight: bold" value="Basic Empty Weight" disabled>
					</div>
					<div class="form-group lt-column-2">
					    <input type="text" class="form-control lt-fc-center1" value="7010.69" readonly>
					</div>
					<div class="form-group lt-column-3">
					    <input type="text" class="form-control lt-fc-center1" value="236.06" readonly>
					</div>
					<div class="form-group lt-column-4">
					    <input type="text" class="form-control lt-fc-center1" value="1654941.12" readonly>
					</div>
					<div class="form-group lt-column-5">
					    <input type="text" class="form-control lt-fc-center1" value="42 %" readonly>
					</div>
				    </div>

				    <div class="col-xs-12 lt-pad-lr-2">
					<div class="form-group lt-column-1">
					    <input type="text" class="form-control lt-fc-center" style="font-weight: bold" value="Pilot &amp; Co Pilot" disabled>
					</div>
					<div class="form-group lt-column-2">
					    <input type="text" class="form-control lt-fc-center1" value="375" readonly>
					</div>
					<div class="form-group lt-column-3">
					    <input type="text" class="form-control lt-fc-center1" value="115.16" readonly>
					</div>
					<div class="form-group lt-column-4">
					    <input type="text" class="form-control lt-fc-center1" value="43185" readonly>
					</div>
					<div class="form-group lt-column-5">
					    <input type="text" class="form-control lt-fc-center1" value="36 %" readonly>
					</div>
				    </div>

				    <div id="zero_fuel_valid" class="col-xs-12 lt-pad-lr-2">
					<div class="form-group lt-column-1 ">
					    <input type="text" class="form-control lt-fc-center lt-bg-grey" style="font-weight: bold" id="item20" value="Zero Fuel Weight" disabled>
					</div>
					<div class="form-group lt-column-2">
					    <input type="text" class="form-control lt-fc-center1 get_moment lt-bg-grey" id="weight20" value="27094" readonly>
					</div>
					<div class="form-group lt-column-3">
					    <input type="text" class="form-control lt-fc-center1 lt-bg-grey" id="arm20" value="520.09" readonly>
					</div>
					<div class="form-group lt-column-4">
					    <input type="text" class="form-control lt-fc-center1 lt-bg-grey" id="moment20" value="14091.51" readonly>
					</div>
					<div class="form-group lt-column-5">
					    <input type="text" class="form-control lt-fc-center1 lt-bg-grey" id="cg20" value="34.61" readonly>
					</div>
				    </div>

				    <div id="take_off_valid" class="col-xs-12 lt-pad-lr-2">
					<div class="form-group lt-column-1 ">
					    <input type="text" class="form-control lt-fc-center lt-bg-lgreen" id="item21" style="font-weight: bold" value="Take Off Weight" disabled>
					</div>
					<div class="form-group lt-column-2">
					    <input type="text" class="form-control lt-fc-center1 get_moment lt-bg-lgreen" id="weight21" value="" readonly>
					</div>
					<div class="form-group lt-column-3">
					    <input type="text" class="form-control lt-fc-center1 lt-bg-lgreen" id="arm21" value="" readonly>
					</div>
					<div class="form-group lt-column-4">
					    <input type="text" class="form-control lt-fc-center1 lt-bg-lgreen" id="moment21" value="" readonly>
					</div>
					<div class="form-group lt-column-5">
					    <input type="text" class="form-control lt-fc-center1 lt-bg-lgreen" data-url="{{url('postlnt/get_trim_setting')}}" name="" id="cg21" value="" readonly>
					</div>
				    </div>

				    <div id="landing_valid" class="col-xs-12 lt-pad-lr-2">
					<div class="form-group lt-column-1 ">
					    <input type="text" class="form-control lt-fc-center lt-bg-skyblue" id="item22" style="font-weight: bold" value="Landing Weight" disabled>
					</div>
					<div class="form-group lt-column-2">
					    <input type="text" class="form-control lt-fc-center1 get_moment lt-bg-skyblue" id="weight22" value="" readonly>
					</div>
					<div class="form-group lt-column-3">
					    <input type="text" class="form-control lt-fc-center1 lt-bg-skyblue" id="arm22" value="" readonly>
					</div>
					<div class="form-group lt-column-4">
					    <input type="text" class="form-control lt-fc-center1 lt-bg-skyblue" id="moment22" value="" readonly>
					</div>
					<div class="form-group lt-column-5">
					    <input type="text" class="form-control lt-fc-center1 lt-bg-skyblue" id="cg22" value="" readonly>
					</div>
				    </div>

				    <!-- <div class="col-xs-12 lt-pad-lr-2">
					<div class="form-group lt-column-1">
					    <input type="text" class="form-control lt-fc-center" id="item23" style="font-weight: bold" value="Take Off Trim Setting ">
					</div>
					<div class="form-group lt-column-4">
					    <input type="text" class="form-control lt-fc-center1 lt-wr" id="weight23" name="" readonly>
					</div>
					<div class="form-group calc-btn">
					    
					    <button  class="btn btn-calculate1 newbtn calculate_lnt w100" style="height:29px; padding:0px;font-size:12px" disabled="disabled">Calculate</button>
					<div class="lnt_loading2"></div>
					</div>
    
					<div class="form-group lt-column-5 save-print-btn" style="margin-top: 10px">
    
					    <a class="print-btn">PRINT</a>
					</div>
				    </div> -->

				</div>

                            </div>

                            <div class="lt-right-sec pull-left">

                                <!-- <div class="col-sm-4 col-md-3 p-0 text-center relative" style="padding-top:50px;">
                                    <img class="p-t-20 p-b-20" style="padding-top:30px;" src="{{url('app/new_temp/images/flight-image.png')}}">
				    
                                </div>
				
                                <div class="col-sm-8 col-md-9 p-0">
                                    <div id="Div1" style="height:500px;width:100%; margin: 0 auto"></div>
                    <div id="max_zero_fuel" class=""></div>
                    <div id="max_takeoff_fuel" class=""></div>
                    <div id="max_landing_fuel" class=""></div>
                                </div> -->

                                <div class="col-md-offset-1 col-md-10 vtavs-flight">
                                    <img src="{{url('/media/images/vtavs/vtavs-flight.png')}}">
                                </div>
                                <div class="col-md-12 pad-lr-0 vtavs-graph">
                                    <img src="{{url('/media/images/vtavs/vtavs-graph.png')}}">
                                </div>
                            </div>
                        </div><!--End of right sec -->


                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('includes.new_footer',[])
</div>
@stop