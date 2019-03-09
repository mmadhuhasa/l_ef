<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
     <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>
    <script src="https://www.highcharts.com/samples/static/highslide-full.min.js"></script>
    <script src="https://www.highcharts.com/samples/static/highslide.config.js" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="https://www.highcharts.com/samples/static/highslide.css" />
     <link href="{{url('app/css/ltrim/style.css')}}" rel="stylesheet">

     <style>
        .main-container{
            width: 80%;
            margin: 0 auto;
        }
        .table{
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .cg-right{
                text-align: right;
            }
        .cg-value{
            text-align: left;
            padding-left: 2px;
        }  
        .zfw{
                width: auto;
    padding-right: 7px;
        } 
        .th-padd-tb-2{
                padding-top: 2px !important;
    padding-bottom: 2px !important;
        }
        .padd-l-5{
            padding-left: 5px;
        } 
        .padd-lr-25{
                padding-left: 25px;
    padding-right: 25px;
        }
        .width-auto{
                width: auto;
        }
        td,th{
            border: 1px solid #ddd;
            border-top: 1px solid #ddd;
            padding: 5px;
        }
        .highcharts-container {
        background-size: 100% 100%;
        height: 482px !important;
        width:900px !important;
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
    .highcharts-button{
        display: none;
    }
     .auto_caps{
            text-transform: uppercase;
        }
    a.disabled{color: grey;cursor: not-allowed !important}
    .save-print-btn{padding-left: 12px}
    .download-parent:hover .tooltip-download{
        visibility: visible;
    }
    .download-parent{
        position: relative;
            width: auto;
    float: right;
    cursor: pointer;
    }
    .tooltip-download{

        visibility: visible;
            position: absolute;
    left: -17px;
    background: #333;
    color: #fff;
    top: 20px;
    padding: 3px;
    font-size: 11px;
    border-radius: 3px;
    cursor: default;
    }
     </style>
</head>
<body>
     <div class="container">
        <div class="download-parent">
        <img id="graph_print" title='download' class="pull-right" src="{{url('media/images/download-all.png')}}">
        <span class="tooltip-download">Download</span>
        </div>
        <div class="row">
            <div class="col-md-4">
                <img src="{{url('media/turbo.png')}}" width="150" height="50" id="img_pro">
            </div>
            <div class="col-md-4 width-auto" id="heading">
                <p>TURBO AVIATION PVT LTD</p>
                <p>Load and Trim Sheet</p>
                <p>MODEL EMBRAER 500 - PHENOM 100</p>
            </div>
            <div class="col-md-offset-4">
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 t_bcol1 padd-l-5" >
                Registration: <span style="text-decoration: underline;">VT-AVS</span>
            </div>
            <div class="col-md-4 col-md-offset-1  t_bcol1 padd-lr-25" style="width:auto;">
                SERIAL NUMBER - 500000204
            </div>
            <div class="col-md-3  t_bcol1" style="text-transform: uppercase;    float: right;width: auto; padding-left: 5px;">
                DATE:{{ $date }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 t_bcol1 auto_caps padd-l-5">
                FROM: {{ $from}}
            </div>
            <div class="col-md-3 col-md-offset-1 t_bcol1 auto_caps padd-l-5">
            TO: {{ $to}}
            </div>
            <div class="col-md-6 ">
               
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 t_bcol1 auto_caps padd-l-5">
                PIC: {{ $pilot}}
            </div>
            <div class="col-md-3 ">

            </div>
            <div class="col-md-5  t_bcol1 auto_caps padd-l-5">
                CO PILOT : {{ $co_pilot}}
            </div>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead>
                    <th class="f_w th-padd-tb-2">Sl.</th>
                    <th class="f_w th-padd-tb-2">Details</th>
                    <th id="td_t" class="f_w th-padd-tb-2">Weight (lbs)</th>
                    <th id="td_t" class="f_w th-padd-tb-2">Arm (ln)</th>
                    <th id="td_t" class="f_w th-padd-tb-2">Moment (Wt X Arm)</th>
                </thead>
                <tbody class="b_col">
                    <tr>
                        <td>i)</td>
                        <td class="data_align">Empty Weight</td>
                        <td id="td_t">{{ $empty_weight['weight'] }}</td>
                        <td id="td_t">{{ $empty_weight['arm'] }}</td>
                        <td id="td_t">{{ round($empty_weight['weight']*$empty_weight['arm'],2) }}</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Pilot & Co Pilot</td>
                        <td id="td_t">{{ sprintf('%.2f',$pilot_co_pilot['weight']) }}</td>
                        <td id="td_t">{{ $pilot_co_pilot['arm'] }}</td>
                        <td id="td_t">{{sprintf('%.2f',  $pilot_co_pilot['weight']*$pilot_co_pilot['arm'])}}</td>
                    </tr>
                    @php
                       $pax_count = 1; $count=1;
                    @endphp
                    @foreach ($paxs as $pax)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>Pax {{ $pax_count++ }}</td>
                            <td id="td_t">@if(isset($pax['weight']))  {{ sprintf('%.2f',$pax['weight']) }} @else {{'0.00'}} @endif</td>
                            <td id="td_t">{{ $pax['arm'] }}</td>
                            <td id="td_t">@if(isset($pax['weight'])) {{ sprintf('%.2f', $pax['weight']*$pax['arm']) }} @else {{ '0.00'}} @endif</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>6</td>
                        <td>Fwd, Baggage Compt (Max 66 Lbs)</td>
                        <td id="td_t">{{ sprintf('%.2f',$fwd_baggege_compt['weight']) }}</td>
                        <td id="td_t">{{ $fwd_baggege_compt['arm'] }}</td>
                        <td id="td_t">{{ $fwd_baggege_compt['weight']*$fwd_baggege_compt['arm'] }}</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Wardrobe/ Refreshment Cabinet</td>
                        <td id="td_t">{{ sprintf('%.2f',$wardrobe_refreshment_cabinet['weight']) }}</td>
                        <td id="td_t">{{ $wardrobe_refreshment_cabinet['arm'] }}</td>
                        <td id="td_t">{{ 
                        sprintf('%.2f', $wardrobe_refreshment_cabinet['weight']*$wardrobe_refreshment_cabinet['arm']) }}</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Lavatory Cabinet (Max 353 Lbs)</td>
                        <td id="td_t">{{ sprintf('%.2f',$lavatory_cabinet['weight']) }}</td>
                        <td id="td_t">{{ $lavatory_cabinet['arm'] }}</td>
                        <td id="td_t">{{ sprintf('%.2f', $lavatory_cabinet['weight']*$lavatory_cabinet['arm']) }}</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Aft Baggage Compt (Max 353 Lbs)</td>
                        <td id="td_t">{{ sprintf('%.2f',$aft_baggage_compt['weight']) }}</td>
                        <td id="td_t">{{ $aft_baggage_compt['arm'] }}</td>
                        <td id="td_t">{{ sprintf('%.2f', $aft_baggage_compt['weight']*$aft_baggage_compt['arm']) }}</td>
                    </tr>
                    <tr> 
                        <td class="b_c">ii)</td>
                        <td class="f_w">Total Zero Fuel (i+1 to 9)</td>
                        <td class="f_w" id="td_t" >{{ $total_zero_fuel['weight'] }}</td>
                        <td class="f_w" id="td_t" >{{ sprintf('%.2f',$total_zero_fuel['arm']) }}</td>
                        <td class="f_w" id="td_t" >{{ sprintf('%.2f', $total_zero_fuel['momentum']) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="f_i">Max Zero Fuel Weight (8444 Lbs)</td>
                        <td colspan="2" class="f_b cg-right">ZFW CG % M.A.C = </td>
                        <td class="f_b cg-value">{{ sprintf('%.2f',$max_zero_fuel_weight) }}</td>
                    </tr>
                    <tr>
                        <td>iii)</td>
                        <td class=""><b>Take Off Fuel</b> <span>(Max. 2750 Lbs)</span></td>
                        <td class="f_a" id="td_t">{{ $take_off_fuel['weight'] }}</td>
                        <td id="td_t">{{ sprintf('%.2f',$take_off_fuel['arm']) }}</td>
                        <td id="td_t">{{ sprintf('%.2f',$take_off_fuel['momentum']) }}</td>
                    </tr>
                    <tr>
                        <td class="b_c">iv)</td>
                        <td class="f_w">Total Take Off Weight (ii+iii)</td>
                        <td class="f_w" id="td_t">{{ $total_take_off_weight['weight'] }}</td>
                        <td class="f_w" id="td_t">{{ sprintf('%.2f',$total_take_off_weight['arm']) }}</td>
                        <td class="f_w" id="td_t">{{ sprintf('%.2f',$total_take_off_weight['momentum']) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="f_i">Max Take Off Weight (10472 Lbs)</td>
                        <td colspan="2" class="f_b cg-right">TAKE OFF WT CG % M.A.C = </td>
                        <td class="f_b cg-value">{{ sprintf('%.2f',$max_take_off_weight) }}</td>
                    </tr>
                    <tr>
                        <td>v)</td>
                        <td class="f_a">Landing Fuel</td>
                        <td class="f_a" id="td_t">{{ $landing_fuel['weight']}}</td>
                        <td  id="td_t">{{  sprintf('%.2f',$landing_fuel['arm']) }}</td>
                        <td  id="td_t">{{  sprintf('%.2f',$landing_fuel['momentum']) }}</td>
                    </tr>
                    <tr>
                        <td class="b_c">vi)</td>
                        <td class="f_w">Total Landing Weight (ii+v)</td>
                        <td class="f_w" id="td_t">{{ sprintf('%.2f',$total_landing_weight['weight']) }}</td>
                        <td class="f_w" id="td_t">{{ sprintf('%.2f', $total_landing_weight['arm']) }}</td>
                        <td class="f_w" id="td_t">{{  sprintf('%.2f',$total_landing_weight['momentum']) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="f_i">Max Landing Weight (9766 Lbs)</td>
                        <td colspan="2" class="f_b cg-right">LANDING WT CG % M.A.C = </td>
                        <td class="f_b cg-value">{{ sprintf('%.2f',$max_landing_weight) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md-5 t_bcol1 zfw" >
                ZFW CG as % MAC = (Arm - 209.64) x 100 / 64.57
            </div>
        </div>
        <div class="row">
            <div class="col-md-1 note"> Note :</div>
            <div class="col-md-11 note">
                <ol>
                    <li> Maximum seating permissible is 04 PAX Lavatory not to be occupied.</li>
                    <li> PIC to brief the passenger occuping RH AFT FWD facing seat, which is next to exit about opening procedure of over wing exit.</li>
                    <li> Standard weight as per CAR section 2 series X part -ll follows- <br>Adult passanger (both male and female):165 lbs.Child (Between 2 years and 12 years age):77 lbs.and infant less than 2 years:22 lbs.</li>
                </ol>
            </div>
        </div>

        <p class="p">I certify that aircraft is properly loaded and CG is within limits as per AFM
        </p>
        <p class="p"><b>Signature of PIC:</b></p>
        <span class="p"><b>ATPL:</b></span>
        
    </div>
    <style>
    .graph_container {
        width: 900px;
        padding-left: 0;
        border: none;
    }
    #Div1 {
        width: 100%;
    }
    </style>
    <div class="container graph_container">
        <div class="row">
            <div class="col-sm-8 col-md-12 p-0">
                <div id="Div1"></div>                      
            </div>
        </div>
    </div>
    
</body>
    
 <script>
    $(function () {
            //                 $.ajax({
            //          url: "/ltrim_graph",
            //          dataType: 'json',
            //          headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            //         success: function (data, textStatus, jqXHR) {
            //             console.log(data);
            //              take_off_data=[data.max_zero_fuel_weight,data.total_take_off_weight.weight];
            //              landing_data=[data.max_landing_weight,data.total_landing_weight.weight];
            //              from=data.from;
            //              to=data.to;
            //              date=data.date;
            //         },
            //     async: false,
            //     error: function (jqXHR, textStatus, errorThrown) {

            //     }
            // });
console.log('landing_data');                
var landing_data=[<?php echo $max_landing_weight;?>,<?php echo $total_landing_weight['weight'];?>];
var landing_data1=[<?php echo $max_landing_weight;?>,<?php echo $total_landing_weight['weight']-200;?>];
var take_off_data=[<?php echo $max_zero_fuel_weight; ?>,<?php echo $total_take_off_weight['weight']; ?>];
var lr_data = [take_off_data,landing_data]; 
var fromm="<?php echo $from;?>";
var to="<?php echo $to;?>";
var date="<?php echo $date ?>";
console.log('take_off_data');
console.log(take_off_data); 
    var curve_color = '#000';
    var zero_fuel_color = 'darkgrey';
    var landing_fuel_color = '#000';
    var take_off_fuel_color = '#000';
    var zfg_color = '#2cc38a';  
        $("#Div1").highcharts({
            exporting: {
                allowHTML: true,
                chartOptions: {// specific options for the exported image
                    plotOptions: {
                        series: {
                            dataLabels: {
                                enabled: false
                            }
                        }
                    },
                    legend: {
                        enabled: true,
                        verticalAlign: 'bottom',
                        align: 'right',
                        y: 0
                    },
                    title: {
                         text: `<div class="col-md-3 col-md-offset-1  t_bcol1" style="text-transform:uppercase; margin-bottom: 10px;font-weight:bold;font-size: 37px;">${date}</div><div class="col-md-3 col-md-offset-1  t_bcol1" style="text-transform:uppercase;font-weight:bold;margin-bottom: 10px;font-size: 37px;">${fromm}-${to}</div>`,
                        useHTML: true,
                        y: 626,
                        align: 'center',
                        x: 1180,
                    },
                    subtitle: {
                    },
                    margin: 0,
                    chart: {
                        width: 2480,
                        height: 3508,
                        spacingBottom:1407,
                        spacingRight:205,
                        marginTop:1035,
                        marginLeft:405,
                        events: {
                             load: function () {
                    
                           this.renderer.image('https://www.eflight.aero/media/graph5.png', '0', '50', 2480, 3508)
                                .add();
                            }
                        }
                    },
                        series: [{
                    showInLegend: false,
                    name: 'ZFW',
                    type: 'spline',
                    color: curve_color,
                    "marker": {
                        "symbol": "circle"
                    },
                    lineWidth: 1.1,
                    data: lr_data
                },
                {
                    showInLegend: false,
                    name: 'LW',
                    type: 'scatter',
                    color: landing_fuel_color,
                    "marker": {
                        enabled: true,
                        "symbol": "circle",
                        radius: 10
                    },
                     data: [landing_data],
                    dataLabels: {
                        enabled: false,
                        formatter: function () {
                            return  parseFloat(this.key).toFixed(2) + ' (' + Math.round(this.y) + ' lbs)';
                        },
                        style: {fontFamily: '\'calibri\', sans-serif', lineHeight: '0px', fontSize: '30px', fontWeight: 'bold'}
                    }
                },
                {
                    showInLegend: false,
                    name: 'LW',
                    type: 'scatter',
                    color: landing_fuel_color,
                    "marker": {
                        enabled: false,
                        "symbol": "circle",
                        radius: 4
                    },
                     data: [landing_data1],
                    dataLabels: {
                        enabled: true,
                        formatter: function () {
                            return  parseFloat(this.key).toFixed(2) + ' (' + Math.round(this.y+200) + ' lbs)';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '30px', fontWeight: 'bold'}
                    }
                },
                {
                    showInLegend: false,
                    name: 'TOW',
                    type: 'scatter',
                    color: take_off_fuel_color,
                    "marker": {
                        "symbol": "triangle",
                        radius: 10
                    },
                       data: [take_off_data],
                     // data: [[10.00,7000.00]],
                    dataLabels: {
                        enabled: true,
                        formatter: function () {
                            
                          return   parseFloat(this.key).toFixed(2) + ' (' + Math.round(this.y) + ' lbs)';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '30px', fontWeight: 'bold'}
                    }
                },
            ]
                },
                scale: 3,
                fallbackToExportServer: false,
            },
            chart: {
                width: 900,
                height: 482,
                marginTop: 10,
                marginLeft: 130,
                spacingRight:52,
                spacingBottom: 60,
                events: {
                    load: function () {
                        this.renderer.image('https://www.eflight.aero/media/vt_avs.png', '-6.5', '0', 900, 482)
                                .add();

                    }
                }
            },
            credits: {
                enabled: false
            },
            navigation: {
                buttonOptions: {
                    enabled: false
                }
            },
            title: {
                showInLegend: false,
                text: '',
                x: -20 //center
            },
            xAxis: {
               
                lineColor: 'transparent',
                min: 10,
                max: 50,
                tickInterval: 10,
                tickPositions: [10,20,30,40,50],
                tickPosition: 'inside',
                tickLength: 0,
                tickColor:'blue',
                tickWidth:5,
                labels: {
                    style: {
                        color: '#0000',
                        fontSize: '12px'
                    },
                    // y: 13,
                    enabled: false
                }
            },
            yAxis: {
         
                lineColor: 'transparent',
                gridLineWidth: 0,
                min: 6200,
                max: 11000,
                tickPositions: [6200,6600,7000,7400,7800,8200,8600,9000,9400,9800,10200,10600,11000],
                 tickLength: 0,
                 tickWidth:5,
                 tickColor:'blue',
                tickInterval: 400,
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
                    // x: -10,
                    style: {
                        color: 'black',
                        fontSize: '12px'
                    },
                    enabled: false
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
                        enabled: false
                    }
                },
                series: {
                    states: {
                        hover: {
                            enabled: false
                        }
                    }
                }
            },
            tooltip: {
                enabled: false
            },
            series: [{
                    showInLegend: false,
                    name: 'ZFW',
                    type: 'spline',
                    color: curve_color,
                    "marker": {
                        "symbol": "circle"
                    },
                    lineWidth: 1.1,
                    data: lr_data
                },
                {
                    showInLegend: false,
                    name: 'LW',
                    type: 'scatter',
                    color: landing_fuel_color,
                    "marker": {
                        enabled: true,
                        "symbol": "circle",
                        radius: 4
                    },
                     data: [landing_data],
                    dataLabels: {
                        enabled: false,
                        formatter: function () {
                            console.log("ty",this);
                            return  parseFloat(this.key).toFixed(2) + ' (' + Math.round(this.y) + ' lbs)';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '9px', fontWeight: 'bold'}
                    }
                },
                {
                    showInLegend: false,
                    name: 'LW',
                    type: 'scatter',
                    color: landing_fuel_color,
                    "marker": {
                        enabled: false,
                        "symbol": "circle",
                        radius: 4
                    },
                     data: [landing_data1],
                    dataLabels: {
                        enabled: true,
                        formatter: function () {
                            return  parseFloat(this.key).toFixed(2) + ' (' + Math.round(this.y+200) + ' lbs)';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '9px', fontWeight: 'bold'}
                    }
                },
                {
                    showInLegend: false,
                    name: 'TOW',
                    type: 'scatter',
                    color: take_off_fuel_color,
                    "marker": {
                        "symbol": "triangle",
                        radius: 4
                    },
                       data: [take_off_data],
                     // data: [[10.00,7000.00]],
                    dataLabels: {
                        enabled: true,
                        formatter: function () {
                            
                          return   parseFloat(this.key).toFixed(2) + ' (' + Math.round(this.y) + ' lbs)';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '9px', fontWeight: 'bold'},

                    }
                },
            ]
        });
      /*  var chart1 = new Highcharts.Chart({
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
                width: 900,
                height: 482,
                marginTop: 0,
                marginRight: 0,
                spacingLeft: 0,
                spacingBottom: 0,
                events: {
                    load: function () {
                        this.renderer.image('media/lntt.png', '0', '0', 900, 482)
                                .add();

                    }
                }
            },
            credits: {
                enabled: false
            },
            title: {
              text: '',
              // text: 'Load && Trim Graph',
                x: -20 //center
            },
            xAxis: {
                gridLineWidth: 0,
                lineColor: 'red',
                min: 10,
                max: 50,
                tickInterval: 10,
                tickPositions: [10,20,30,40,50],
                tickLength: 0,
                 tickColor:'blue',
                tickWidth:5,
                labels: {
                    style: {
                        fontSize: '9px'
                    },
                    y: 5,
                    enabled: true
                }
            },
            yAxis: {
                lineColor: 'red',
                gridLineWidth: 0,
                min: 6200,
                max: 11000,
                tickInterval: 400,
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
                    style: {
                        fontSize: '9px',
                    },
                    x: -10,
                    enabled: true
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
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br>' + 'Fuel: ' + this.key + ', %MAC ' + this.y;
                }
            },
        }); */
                $('#graph_print').click(function (e) {

                    $.ajax({
                     url: "/ltrim_graph",
                     dataType: 'json',
                     success: function (data, textStatus, jqXHR) {
                        // aircraft_callsign=data.call_sign;
                         departure_aerodrome=data.from;
                         destination_aerodrome=data.to;
                         date_of_flight=data.date;
                     },
                    async: false,
                    error: function (jqXHR, textStatus, errorThrown) {
                    }
            });
            var chart = $('#Div1').highcharts();
            var graph_name = 'VT-AVS' + ' GRAPH for ' + '-' + departure_aerodrome + '-' + destination_aerodrome + ' on ' + date_of_flight;
            if ($(this).hasClass('disabled')) {
                console.log('hii');
                e.preventDefault();
                return false;
            }

            chart.exportChart({
                type: 'application/pdf',
                filename: graph_name,
                width: 600,
                height: 400,
                 marginTop: 118,
                events: {
                    load: function () {
                        this.renderer.image('https://www.eflight.aero/media/avs_graph.png', '0', '0', 600, 400)
                                .add();
                    }
                }
            });
            setTimeout(function(){
                var url="<?php echo URL::to('/');?>"; 
                 // window.location = "http://demo.privateflight.co.in/ltrimpdf";
                window.location = url+"/ltrimpdf/vtavs";
            },5000)
        }); 
    });
</script>

</html>