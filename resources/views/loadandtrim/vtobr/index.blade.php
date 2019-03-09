@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@push('css')
<!-- <script src="{{url('app/js/highcharts/highcharts.js')}}"></script>
<script src="{{url('app/js/highcharts/data.js')}}"></script>
<script src="{{url('app/js/highcharts/exporting.js')}}"></script>
<script src="{{url('app/js/highcharts/offline-exporting.js')}}"></script>
<script src="{{url('app/js/highcharts/highslide-full.min.js')}}"></script>
<script src="{{url('app/js/highcharts/highslide.config.js')}}" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="{{url('app/js/highcharts/highslide.css')}}" /> -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://www.highcharts.com/samples/static/highslide-full.min.js"></script>
<script src="https://www.highcharts.com/samples/static/highslide.config.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="https://www.highcharts.com/samples/static/highslide.css" />
<link rel="stylesheet" type="text/css" href="{{url('app/css/loadandtrim/vtobr.css')}}">
<style type="text/css">
    .ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus{
            background: #F26232;
    background: #f1292b;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f1292b', endColorstr='#f37858');
    background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858));
    background: -moz-linear-gradient(top, #f1292b, #f37858);
    }
</style>
@endpush

@section('content')
<div id="page">
    @include('includes.new_header',[])
    <!-- @if(Session::has('message'))
     <div class="container cust-container">
           <div class="row">
              <div class="col-md-12 p-lr-0">
                  <p class="alert alert-danger" style="text-align: center;margin-bottom: 0;border-radius: 0"> <ul>
                      @foreach(Session::get('message') as $msg)
                        <li>{{$msg}}</li>
                      @endforeach
                     </ul> </p>
               </div>   
           </div>  
    </div>
    @endif  -->
    <div class="container cust-container">
        <div class="row ltrim_sec">
            <div class="col-md-12 p-lr-0"><p class="vtobr_heading">VTOBR</p></div>
            @if(isset($copypaste))
            <div class="col-md-12 p-lr-0">
                <form action="{{url('/vtobr')}}" method="post" id="calc_form">
                    {{ csrf_field() }}
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control" value="VTOBR" disabled>
                            <label>call sign</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control text-uppercase " name="from" placeholder="FROM" value="{{$from}}" disabled id="dept_aero">
                            <label>from</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control text-uppercase" name="to" placeholder="TO" value="{{$to}}" disabled id="dest_aero">
                            <label>to</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" id='select_date' class="form-control " name="date" placeholder="Date" disabled value="{{$date}}">
                            <label>date</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <div class="jump_box">
                                <label style="padding-right: 8px;">Jump</label>
                                <input type="radio" name="jump" value="165.35" @if(isset($jump_weight) && $jump_weight!==0)  {{ 'checked'}} @endif disabled> Yes 
                                <input type="radio" name="jump" value="0" @if(isset($jump_weight) && $jump_weight==0) {{'checked'}} @else @endif disabled> No
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text"  class="form-control" name="pax_count" placeholder="pax count" value="{{$pax_count}}" disabled>
                            <label>Pax Count</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control" placeholder="Baggage Fwd" name="baggage_fwd" value="{{(int)$baggage_fwd_weight}}" disabled>
                            <label>Baggage Fwd</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control" placeholder="Baggage Aft" name="baggage_aft" value="{{(int)$baggage_aft_weight}}" disabled>
                            <label>Baggage Aft</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control" placeholder="Fuel Wing Tank" name="fuel_wing_tank" value="{{(int)$fuel_wing_tank_weight}}"  disabled>               
                            <label>Fuel Wing Tank</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control" placeholder="Fuel Ventral Tank" name="fuel_ventral_tank" value="{{(int)$fuel_ventral_tank_weight}}"disabled>
                            <label>Fuel Ventral Tank</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control text-uppercase" placeholder="Pilot" name="pilot_name" value="{{$pilot}}" disabled>
                            <label>pilot</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control text-uppercase" placeholder="Co pilot" name="copilot_name" value="{{$copilot}}" disabled>
                            <label>co pilot</label>
                        </div>
                    </div>
                    @if(isset($from))
                    @else
                    <div class="col-md-2">
                        <div class="form-group">
                            <button type="submit" class="form-control newbtnv1">Submitdd</button>

                        </div>
                    </div>
                    @endif
                    <div class="col-md-2">
                        <div class="form-group">
                            @if(isset($fuel_wing_tank_weight))<a href="JavaScript:void(0);"><button type="button" class="form-control newbtnv1" id="download_pdf">Download PDF</button></a>@endif
                        </div>
                    </div>
                </form>
            </div>
            @else
            <div class="col-md-12 p-lr-0">
                <form action="{{url('loadtrim/vtobr')}}" method="post" id="calc_form" class="calc_form_validate">
                    {{ csrf_field() }}
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control" value="VTOBR" id="callsign" disabled>
                            <label>call sign</label>
                        </div>
                    </div>
                    <input type="hidden" name="copypaste" value="false"></input>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" data-toggle="popover" data-placement="top" class="form-control text-uppercase alphabets" name="from" placeholder="FROM" 
                            @if(isset($from)) value="{{$from}}" @else  value="{{ Session::get('from') }}" @endif id="dept_aero" autocomplete="off"/>
                            <label>from</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" data-toggle="popover" data-placement="top" class="form-control text-uppercase alphabets" name="to"
                            placeholder="TO"  @if(isset($to)) value="{{$to}}" @else  value="{{ Session::get('to') }}" @endif id="dest_aero" autocomplete="off">
                            <label>to</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" id='select_date' class="form-control datepicker" name="date" placeholder="Date" autocomplete="off"   value="{{ Session::get('date') }}">
                            <label>date</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <div class="jump_box">
                                <label style="padding-right: 8px;">Jump</label>
                                <input type="radio" name="jump"  class="jump" value="165.35" @if(isset($jump_weight) && $jump_weight!==0)  {{ 'checked'}} @elseif(Session::get('jump_weight')=='165.35') {{'checked'}} @endif> Yes 
                                <input type="radio" name="jump" value="0" class="jump" @if(isset($jump_weight) && $jump_weight==0) {{'checked'}} @elseif(Session::get('jump_weight')=='0') {{'checked'}} @endif> No
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control numbers" name="pax_count" data-toggle="popover" data-placement="top" placeholder="pax count"  @if(isset($pax_count)) value="{{$pax_count}}" @else  value="{{ Session::get('pax_no') }}" @endif id="pax_vtobr" autocomplete="off">
                            <label>Pax Count</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control numbers" data-toggle="popover" data-placement="top" placeholder="Baggage Fwd" name="baggage_fwd" 
                              @if(isset($baggage_fwd_weight)) value="{{(int)$baggage_fwd_weight}}" @else value="{{ Session::get('baggage_fwd_weight') }}" @endif id="baggage_fwd_vtobr" autocomplete="off"/>
                            <label>Baggage Fwd</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control numbers" data-toggle="popover" data-placement="top" placeholder="Baggage Aft" name="baggage_aft" 
                             @if(isset($baggage_fwd_weight)) value="{{(int)$baggage_aft_weight}}" @else value="{{ Session::get('baggage_aft_weight') }}" @endif id="baggage_aft_vtobr" autocomplete="off"/>
                            <label>Baggage Aft</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" data-toggle="popover" data-placement="top" class="form-control numbers" placeholder="Fuel Wing Tank" name="fuel_wing_tank" @if(isset($fuel_wing_tank_weight)) value="{{(int)$fuel_wing_tank_weight}}" @else value="{{ Session::get('fuel_wing_tank_weight') }}" @endif/ id="fuel_wing_tank_vtobr" autocomplete="off">  
                            <label>Fuel Wing Tank</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" data-toggle="popover" data-placement="top" class="form-control numbers" placeholder="Ventral Tank" name="fuel_ventral_tank"  @if(isset($fuel_ventral_tank_weight)) value="{{(int)$fuel_ventral_tank_weight}}" @else value="{{ Session::get('fuel_ventral_tank_weight') }}" @endif id="fuel_ventral_tank_vtobr" autocomplete="off"/>
                            <label>Fuel Ventral Tank</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group dynamiclabel">
                            <input type="text" data-toggle="popover" data-placement="top" class="form-control text-uppercase alphabets_with_space" placeholder="Pilot" name="pilot_name" @if(isset($pilot)) value="{{$pilot}}" @else value="{{ Session::get('pilot') }}" @endif id="pilot" autocomplete="off">
                            <label>pilot</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group dynamiclabel">
                            <input type="text" data-toggle="popover" data-placement="top" class="form-control text-uppercase alphabets_with_space" placeholder="Co pilot" name="copilot_name" @if(isset($copilot)) value="{{$copilot}}" @else value="{{ Session::get('co_pilot') }}" @endif id="co_pilot" autocomplete="off">
                            <label>co pilot</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <button type="submit" class="form-control newbtnv1">Submit</button>

                        </div>
                       
                    </div>
                     <div class="form-group">
                            @if(Session::has('message'))
                            <div class="container ltim_container" style="margin-top: -8px;margin-left: -15px;font-weight: bold;color: red;">
                             <div class="row">
                                <div class="col-md-12">
                                       <ul>
                                     <!--   <img src="{{url('media/images/loadtrim/warning.png')}}" style="height:25px"> -->
                                        @foreach(Session::get('message') as $msg)
                                          <li>{{$msg}}</li>
                                        @endforeach
                                       </ul> 
                                    
                                 </div>   
                             </div>
                            </div>
                             @endif
                        </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            @if(isset($fuel_wing_tank_weight))<a href="JavaScript:void(0);"><button type="button" class="form-control newbtnv1" id="download_pdf">Download PDF</button></a>@endif
                        </div>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>
    <script src="{{url('app/js/common/validation.js')}}" type="text/javascript"></script>
    <script>

 $(".datepicker").datepicker({
     minDate:0
 });
$(function () {
   
    var d="<?php echo Session::get('date')  ?>";
    var d1="<?php echo $date  ?>";
   if(d!="")
   $("#select_date").datepicker().datepicker("setDate",d);
   else if(d1!="")
   $("#select_date").datepicker().datepicker("setDate",d);
   else
    $("#select_date").datepicker().datepicker("setDate",new Date());
    var plot_data = [<?php
                        if (isset($cg)) {
                            echo $cg;
                        }
                        ?>,<?php
                        if (isset($take_off_weight)) {
                            echo $take_off_weight;
                        }
                        ?>];
    var landing_fuel_color = '#000';
    $("#graph").highcharts({
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
                    text: ``,
                            useHTML: true,
                    y: 626,
                    align: 'center',
                    x: 1180,
                },
                subtitle: {
                },
                margin: 0,
                chart: {
                    width: 745,
                    height: 1053,
                    spacingBottom: 245,
                    spacingRight: 111,
                    marginTop: 214,
                    marginLeft: 166,
                    events: {
                        load: function () {

                            this.renderer.image('https://www.eflight.aero/media/images/lnt/vtobr/VTOBR-PDFGRAPH.png', '0', '0', 745,1053)
                                    .add();
                        }
                    }
                },
            },
            scale: 3,
            fallbackToExportServer: false,
        },
        chart: {
            width: 745,
            height: 923,
            marginTop: 55,
            marginLeft: 93,
            spacingRight: 23,
            spacingBottom: 64,
            events: {
                load: function () {
                    this.renderer.image(base_url+'/media/images/lnt/vtobr/graph.png', '0', '0', 745, 923)
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
            min: -0.3,
            max: 1.4,
            tickInterval: 0.1,
            tickPositions: [-0.3, -0.2, -0.1, 0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1.0, 1.1, 1.2, 1.3, 1.4],
            tickPosition: 'inside',
            tickLength: 0,
            tickColor: 'blue',
            tickWidth: 5,
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
            min: 13000,
            max: 29000,
            tickPositions: [13000, 14000, 15000, 16000, 17000, 18000, 19000, 20000, 21000, 22000, 23000, 24000, 25000, 26000, 27000, 28000, 29000],
            tickLength: 0,
            tickWidth: 5,
            tickColor: 'blue',
            tickInterval: 1000,
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
        series: [
            {
                showInLegend: false,
                name: 'LW',
                type: 'scatter',
                color: landing_fuel_color,
                "marker": {
                    enabled: true,
                    "symbol": "triangle",
                    radius: 4
                },
                data: [plot_data],
                dataLabels: {
                    enabled: true,
                    formatter: function () {

                        return  '(' + parseFloat(this.key).toFixed(2) + ',' + Math.round(this.y) + ' lbs)';
                    },
                    style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '12px', fontWeight: 'bold', background: 'white'}
                }
            }
        ]
    });
     $('#download_pdf').click(function (e) {
            var departure_aerodrome = $("#dept_aero").val().toUpperCase();
            var destination_aerodrome =$("#dest_aero").val().toUpperCase();
            var date_of_flight = $("#select_date").val();
            var chart = $('#graph').highcharts();
            var graph_name = 'GRAPH VTOBR' + ' '+departure_aerodrome + ' ' + destination_aerodrome + '-' + date_of_flight;
            if ($(this).hasClass('disabled')) {
                e.preventDefault();
                return false;
            }

            chart.exportChart({
                type: 'application/pdf',
                filename: graph_name,
                width: 595,
                height: 841,
                 marginTop: 0,
                events: {
                    load: function () {
                        this.renderer.image('https://www.eflight.aero/media/images/lnt/vtobr/VTOBR-PDFGRAPH.png', '0', '0', 595,841)
                                .add();
                    }
                }
            });
            setTimeout(function(){
                var url="<?php echo URL::to('/');?>"; 
                window.location = url+"/vtobrpdf";
            },5000)
        }); 


});
    </script>
    @include('includes.new_footer',[])
</div>
@stop