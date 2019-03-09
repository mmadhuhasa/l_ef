@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@push('css')
     <script src="{{url('app/js/highcharts/highcharts.js')}}"></script>
   <script src="{{url('app/js/highcharts/data.js')}}"></script>
    <script src="{{url('app/js/highcharts/exporting.js')}}"></script>
    <script src="{{url('app/js/highcharts/offline-exporting.js')}}"></script>
    <script src="{{url('app/js/highcharts/highslide-full.min.js')}}"></script>
    <script src="{{url('app/js/highcharts/highslide.config.js')}}" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="{{url('app/js/highcharts/highslide.css')}}" />
@endpush    
@section('content')
<style>
    .ltim_container {
      background: #fff;
      width:900px;
      margin: 15px auto;
    }
    .comp_name {
      font-size: 16px;  
      font-weight: bold;
      text-align: center;
      margin:10px;
    }
    .rcal_table1, .rcal_table2, .rcal_table3 {
        font-size: 14px;
    }
    .rcal_table2 {
        width: 70%;
        margin: 0 auto;
    }
    .rcal_table2 th,.rcal_table3 td, .rcal_table3 th{
        text-align: center;
        padding: 2px !important;
        border:1px solid black !important;
    }
    .rcal_table1 td, .rcal_table1 th, .rcal_table2 td {
        padding: 2px !important;
    }
    .rcal_table2 td {
        border:none !important;
    }
    .rcal_table2 td:first-child {
        text-align: right;
    }
    .comput_text{
        text-align: center;
        font-size: 15px;
        text-transform: uppercase;
        text-decoration: underline;
        font-weight: bold;
    }



        .download-parent {
    position: relative;
    width: auto;
    float: right;
    cursor: pointer;
    margin-right: 30px;
    margin-top: 10px;
  }
  .download-parent:hover .tooltip-download{
        visibility: visible;
    }
  .tooltip-download {
    visibility: hidden;
    position: absolute;
    left: 0px;
    background: #333;
    color: #fff;
    top: -25px;
    padding: 3px;
    font-size: 10px;
    border-radius: 3px;
    cursor: default;
    text-transform: uppercase;
}
       .ltim_container,.graph_container {
      background: #fff;
      width:900px;
      margin: 15px auto;
      padding-right: 0;
      padding-left: 0;
    }
    .ltrim_sec {
      padding-top: 30px;
    }
    .ui-datepicker-trigger {
      height: 24px;
      top:5px;
      right:6px;
    }
    .ltrim_sec .form-control {
      margin-bottom: 30px;
      z-index: 0;
    }
    /*        START OF  PLACEHOLDER STYLES*/
    .ltrim_sec .popupHeader {
        font-size: 14px;
    }
    .ltrim_sec div.dynamiclabel
    { 
        display: block;
        position: relative;
        text-align: left;
    }

    .ltrim_sec div.dynamiclabel label{
        position: absolute;
        color:#000;
        font-size:11px;
        font-weight:normal;
        background: transparent;
        /*            border: 1px solid #333;*/
        border-radius: 2px;
        -webkit-border-radius:2px;
        -moz-border-radius:2px;
        -khtml-border-radius:2px;
        -webkit-backface-visibility: hidden;
        top: 10px;           
        -moz-transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        -webkit-transition: all 0.6s ease-in-out; 
        -o-transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        opacity: 0;
        z-index: -1;
        line-height: 0px;
        white-space: nowrap;
    }
    .ltrim_sec div.dynamiclabel > *:focus{
        border-color:#f1292b;
    }
    .ltrim_sec div.dynamiclabel > *:not(:placeholder-shown) + label{
       opacity: 1;
        z-index:1;
        top: -10px;
        left:5px;
        text-transform: uppercase;
   }
    .ltrim_sec div.dynamiclabel > *:focus + label{
        opacity: 1;
        z-index:100;
        top: -10px;
        left:5px;
        text-transform: uppercase;
    }
    .ltrim_sec div.dynamiclabel [placeholder]::-webkit-input-placeholder {
        transition: opacity 0.4s 0.4s ease; 
        text-align: left;
    }
    .ltrim_sec div.dynamiclabel [placeholder]:focus::-webkit-input-placeholder {
        transition: opacity 0.4s 0.4s ease; 
        opacity: 0;
    }
    .ltrim_sec div.dynamiclabel .form-control {
        text-align: left;
        font-weight: bold;
        color: #333;
    }
    .ltrim_sec div.dynamiclabel .form-control:focus {
        border-bottom: 1px solid #ff0000;
    }
    .vtobr_heading {
    margin-bottom: 30px;
    text-align: center;
    padding: 7px 0;
    font-weight: 600;
    font-size: 15px;
    color: #fff;
    font-family: 'pt_sansregular', sans-serif;
    background: #a6a6a6;
    background: -moz-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
    background: -webkit-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
    background: -o-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
    background: -ms-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
    background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6a6a6', endColorstr='#a6a6a6', GradientType=1 );
}
.p-lr-0{
  padding-right: 0 !important;
  padding-left: 0;

}
#select_date.form-control[readonly]{
  background:none !important;
}
    /*        END OF PLACEHOLDER STYLES*/
    select.form-control {
    background-position: 95% !important;
}
</style>
<script type="text/javascript">
$(document).ready(function () {
     $("#select_date" ).datepicker({ 
      minDate: 0,
      dateFormat: 'dd-M-yy',
      onSelect: function(dateText, inst) 
      { 
            $("#select_date").css("border", "1px solid #999");
      }
    });

    $('#reset').click(function(){
     $('.clear').val('');
      });
  });
    </script>
<div class="page">
    @include('includes.new_header',[])
    <main>
           <div class="container ltim_container">

          <div class="col-md-12 p-lr-0"><p class="vtobr_heading" style="text-transform: uppercase;">{{$call_sign}}</p></div>
           <div class="ltrim_sec">
            <form action='{{url('loadtrim/vtnit')}}' method='POST' id="relianceform">
                <div class="row">
                <input type="hidden" class="form-control" value="1" name="post">
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control" placeholder="call sign" value="{{$call_sign}}" style="text-transform: uppercase;" readonly name="callsign" id="callsign">
                                <label>call sign</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets clear" placeholder="from" value="{{$from}}" name="from" id="from" autocomplete="off" data-placement="top" data-toggle="popover">
                                <label>from</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets clear" placeholder="to"  value="{{$to}}" name="to" id='to' autocomplete="off" data-placement="top" data-toggle="popover">
                                <label>to</label>
                            </div>
                        </div>
                        {!! csrf_field() !!}
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control clear" value="{{$date}}" id="select_date" name="date" autocomplete="off" data-placement="top" data-toggle="popover" readonly>
                                <img class="ui-datepicker-trigger" src="{{url('media/ananth/images/calender-icon1.png')}}" alt="..." title="...">
                                <label>date</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                         
                            <div class="form-group dynamiclabel">
                                <select name="paxs" class="form-control clear" id="pax" data-placement="top" data-toggle="popover">

                                  <option value="">Select</option>
                                  <option value="1" @if($pax_no== '1') {{'selected'}} @endif>1</option>
                                  <option value="2" @if($pax_no== '2') {{'selected'}}@endif>2</option>
                                  <option value="3" @if($pax_no== '3') {{'selected'}}@endif>3</option>
                                  <option value="4" @if($pax_no== '4') {{'selected'}}@endif>4</option>
                                  <option value="5" @if($pax_no== '5') {{'selected'}}@endif>5</option>
                                  <option value="6" @if($pax_no== '6') {{'selected'}}@endif>6</option>
                                  <option value="7" @if($pax_no== '7') {{'selected'}}@endif>7</option>
                                  <option value="8" @if($pax_no== '8') {{'selected'}}@endif>8</option>
                                </select>
                                <label for="pax">Pax</label>
                            </div>
                         </div>
                        <div class="col-md-2">
                             <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers clear" placeholder="Cargo" name="aft_baggage_compt_weight" id='cargo_vrl' value="{{$cargo['weight']}}" autocomplete="off" data-placement="top" data-toggle="popover">
                                <label for="cargo">Cargo</label>
                            </div>    
                        </div>
                        <div class="col-md-4">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets_with_space clear" placeholder="pilot name" value="{{$pilot}}" name="pilot" id="pilot" style="text-transform: uppercase;" autocomplete="off" data-placement="top" data-toggle="popover">
                                <label>pilot name</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets_with_space clear" placeholder="co pilot name" value="{{$co_pilot}}" name="co_pilot" id="co_pilot" style="text-transform: uppercase;" autocomplete="off" data-placement="top" data-toggle="popover">
                                <label>Co pilot name</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel clear">
                                <input type="text" class="form-control numbers clear take_off_fuel_roundoff_vtnit" placeholder="Take off fuel" value="{{$t_off_fuel}}" name="take_off_fuel" id="take_off_fuel" autocomplete="off" data-placement="top" data-toggle="popover"  >
                                <label>Take off fuel</label>
                            </div>
                        </div>
                    <div class="col-md-12 p-lr-0">
                        <div class="col-md-2">  
                          <button type="submit" class="form-control newbtnv1">Submit</button></div>
                           <div class="col-md-2 pull-right"> <button type="button" id="reset" class="form-control newbtnv1">Reset</button>
                        </div>
                    </div>
                    </div>
                </div>
               </form> 
             </div>
            </div>
        <div class="container ltim_container">
          <div class="download_img download-parent">
           <img id="graph_print" class="pull-right" src="{{url('media/images/download-all.png')}}" style="cursor: pointer;margin-right: 11px;">
           <div class="tooltip-download">Download</div>
           </div>
            <div class="table_section" style="padding: 0 15px 0 15px;">
                <p class="comp_name">Reliance Commercial Dealers Limited</p>
                <table class="table table-bordered rcal_table1">
                    <tr>
                        <td style="width: 20%;">Type of Helicoptor</td>
                        <td style="width:2%;" class="text-center">:</td>
                        <td style="width: 26%;">Sikorsky S 76C</td>
                        <td style="width: 20%;">Type of Engine</td>
                        <td style="width:2%;" class="text-center">:</td>
                        <td style="width: 26%;">Arriel 2S2 Engine</td>
                    </tr>
                    <tr>
                        <td>Registration No.</td>
                        <td class="text-center">:</td>
                        <td>VT-NIT</td>
                        <td>A/C Serial No.</td>
                        <td class="text-center">:</td>
                        <td>760770</td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td class="text-center">:</td>
                        <td>{{$date}}</td>
                        <td>Flight Sector</td>
                        <td class="text-center">:</td>
                        <td>{{$from}}-{{$to}}</td>
                    </tr>
                    <tr>
                        <td>OAT</td>
                        <td class="text-center">:</td>
                        <td>30</td>
                        <td>Pr Altitude</td>
                        <td class="text-center">:</td>
                        <td>28</td>
                    </tr>
                </table>
                <p class="comput_text">Computation</p>
                <table class="table rcal_table2">
                    <tr>
                        <td>a)</td>
                        <td>MAX TAKE OFF WEIGHT</td>
                        <td>:</td>
                        <td>11700 Lbs (5307 Kgs)</td>
                    </tr>
                    <tr>
                        <td>b)</td>
                        <td>DATUM</td>
                        <td>:</td>
                        <td>200 inches forward of the M/R centroid</td>
                    </tr>
                    <tr>
                        <td>c)</td>
                        <td>EMPTY WEIGHT</td>
                        <td>:</td>
                        <td>8303.00 Lbs</td>
                    </tr>
                    <tr>
                        <td>d)</td>
                        <td>EMPTY WEIGHT CG</td>
                        <td>:</td>
                        <td>207.52 Inches</td>
                    </tr>
                </table>
                <br>
                <table class="table table-bordered rcal_table3">
                    <tr>
                        <th style="width: 52%;">Description</th>
                        <th style="width: 16%;">Weight (Lbs)</th>
                        <th style="width: 16%;">Arm (Inch)</th>
                        <th style="width: 16%;">Moment (Lbs inch)</th>
                    </tr>
                    <tr>
                        <td>Basic Empty Weight</td>
                        <td>{{sprintf('%.2f',$empty_weight['weight'])}}</td>
                        <td>{{$empty_weight['arm']}}</td>
                        <td>{{sprintf('%.2f',$empty_weight['mom'])}}</td>
                    </tr>
                    <tr>
                        <td>Pilot</td>
                        <td>{{sprintf('%.2f',$pilot_co_pilot['weight'])}}</td>
                        <td>{{sprintf('%.2f',$pilot_co_pilot['arm'])}}</td>
                        <td>{{sprintf('%.2f',$pilot_co_pilot['mom'])}}</td>
                    </tr>
                    <tr>
                        <td>Co-Pilot</td>
                        <td>{{sprintf('%.2f',$pilot_co_pilot['weight'])}}</td>
                        <td>{{sprintf('%.2f',$pilot_co_pilot['arm'])}}</td>
                        <td>{{sprintf('%.2f',$pilot_co_pilot['mom'])}}</td>
                    </tr>
                    <tr>
                        <td>Aft Facing Passenger (4 Max)</td>
                        <td>{{sprintf('%.2f',$aft_sum_pax)}}</td>
                        <td>133.00</td>
                        <td>{{sprintf('%.2f',$aft_sum_mom)}}</td>
                    </tr>
                    <tr>
                        <td>Fwd Facing Passenger (4 Max)</td>
                        <td>{{sprintf('%.2f',$fwd_sum_pax)}}</td>
                        <td>203.00</td>
                        <td>{{sprintf('%.2f',$fwd_sum_mom)}}</td>
                    </tr>
                    <tr>
                        <td>Baggage Compartment (600 Lbs Max)</td>
                        <td>{{sprintf('%.2f',$cargo['weight'])}}</td>
                        <td>{{sprintf('%.2f',$cargo['arm'])}}</td>
                        <td>{{sprintf('%.2f',$cargo['mom'])}}</td>
                    </tr>
                    <tr>
                        <td>Fuel (1884 Lbs Max)</td>
                        <td>{{sprintf('%.2f',$take_off_fuel['weight'])}}</td>
                        <td>{{sprintf('%.2f',$take_off_fuel['arm'])}}</td>
                        <td>{{sprintf('%.2f',$take_off_fuel['momentum'])}}</td>
                    </tr>
                    <tr>
                        <td>TOTAL</td>
                        <td>{{sprintf('%.2f',$total_takeoff_weight['weight'])}}</td>
                        <td></td>
                        <td>{{sprintf('%.2f',$total_takeoff_weight['momentum'])}}</td>
                    </tr>
                </table>
                   <div style="margin-bottom: 15px;">
                       <span style="margin-top:5px;padding-right: 15px;">CG for the Flight : </span> <span style="border-bottom: 1px solid black;">{{sprintf('%.1f',$total_takeoff_weight['momentum'])}}</span> : <span style="padding-left:15px;">{{sprintf('%.2f',$total_takeoff_weight['arm'])}} Inches</span>
                       <p style="padding-left: 18%;">{{sprintf('%.1f',$total_takeoff_weight['weight'])}}</p>
                   </div>
            </div>
        </div>
        <div class="container graph_container">
                <div class="row">
                    <div class="col-sm-8 col-md-12">
                        <div id="Div1"></div>                      
                    </div>
                </div>
            </div>
    </main>
    @include('includes.new_footer',[])
</div>
<script src="{{url('app/js/common/validation.js')}}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function () {
 $(function () {                
var take_off_data=[<?php echo sprintf('%.2f',$total_takeoff_weight['arm']); ?>,<?php echo sprintf('%.2f',$total_takeoff_weight['weight']); ?>];
var fromm="<?php echo $from;?>";
var to="<?php echo $to;?>";
var date="<?php echo $date ?>";
var take_off_fuel_color = '#000';
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
                         text: `<div class="pdfsec" style="margin-top:0px;font-family: sans-serif;width:1500px; color:black;">
                                <p style="text-align: center;margin-bottom:10px;"><img src="http://demo.privateflight.co.in/media/images/lnt/vtnma/logo1.PNG" width="500px" height="120px"></p>
                                <p style="text-align: center;font-weight: bold;margin: 0;">Reliance Commercial Dealers Limited</p>
                                <p style="text-align: center;text-decoration: underline;font-weight: bold;margin:0;margin-top:5px;">LOAD AND TRIM SHEET</p>
                                <p style="text-align: center;margin-top:0px;margin-bottom:0px;">(Approved Vide DGCA Letter No. : A7/NIT/1503214 dated 11 June 2015)</p>
                                <table class="rcal_table1" style="width:26.5%;font-size:18px;border:1px solid black;border-collapse:collapse;display:inline-block;">
                    <tr>
                        <td style="width: 21%;border:1px solid black;border-collapse:collapse;">Type of Helicoptor</td>
                        <td style="width:4%;border:1px solid black;border-collapse:collapse; text-align:center;">:</td>
                        <td style="width: 25%;border:1px solid black;border-collapse:collapse;">Sikorsky S 76C</td>                        
                    </tr>
                    <tr>
                        <td style="border:1px solid black;border-collapse:collapse;">Registration No.</td>
                        <td style="border:1px solid black;border-collapse:collapse; text-align:center;">:</td>
                        <td style="border:1px solid black;border-collapse:collapse;">VT-NIT</td>                        
                    </tr>
                    <tr>
                        <td style="border:1px solid black;border-collapse:collapse;">Date</td>
                        <td style="border:1px solid black;border-collapse:collapse; text-align:center;">:</td>
                        <td style="border:1px solid black;border-collapse:collapse;">{{$date}}</td>                        
                    </tr>
                    <tr>
                        <td style="border:1px solid black;border-collapse:collapse;">OAT</td>
                        <td style="border:1px solid black;border-collapse:collapse; text-align:center;">:</td>
                        <td style="border:1px solid black;border-collapse:collapse;">30</td>                        
                    </tr>
                </table>
        <table class="rcal_table1" style="width:26.5%;font-size:18px;border:1px solid black;border-collapse:collapse;display:inline-block;margin-left:22px;">
                    <tr>                        
                        <td style="width: 21%;border:1px solid black;border-collapse:collapse;">Type of Engine</td>
                        <td style="width:4%;border:1px solid black;border-collapse:collapse; text-align:center;">:</td>
                        <td style="width: 25%;border:1px solid black;border-collapse:collapse;">Arriel 2S2 Engine</td>
                    </tr>
                    <tr>                        
                        <td style="border:1px solid black;border-collapse:collapse;">A/C Serial No.</td>
                        <td style="border:1px solid black;border-collapse:collapse; text-align:center;">:</td>
                        <td style="border:1px solid black;border-collapse:collapse;">760770</td>
                    </tr>
                    <tr>                       
                        <td style="border:1px solid black;border-collapse:collapse;">Flight Sector</td>
                        <td style="border:1px solid black;border-collapse:collapse;text-align:center;">:</td>
                        <td>{{$from}}-{{$to}}</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black;border-collapse:collapse;">Pr Altitude</td>
                        <td style="border:1px solid black;border-collapse:collapse; text-align:center;">:</td>
                        <td style="border:1px solid black;border-collapse:collapse;">28</td>
                    </tr>
                </table>
                <p style="text-align: center;text-transform: uppercase;text-decoration: underline;font-weight: bold;width:56%;margin-top:0;margin-bottom:0;"><b>Computation</0b></p>
                <table class="rcal_table2" style="width:60%;margin-left:90px;font-size:18px">
                    <tr>
                        <td style="text-align: right;">a)</td>
                        <td>MAX TAKE OFF WEIGHT</td>
                        <td>:</td>
                        <td>11700 Lbs (5307 Kgs)</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">b)</td>
                        <td>DATUM</td>
                        <td>:</td>
                        <td>200 inches forward of the M/R centroid</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">c)</td>
                        <td>EMPTY WEIGHT</td>
                        <td>:</td>
                        <td>8303.00 Lbs</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">d)</td>
                        <td>EMPTY WEIGHT CG</td>
                        <td>:</td>
                        <td>207.52 Inches</td>
                    </tr>
                </table>
                
                <table class="rcal_table3" style="border:1px solid #000;border-collapse: collapse;text-align: center;width:55%;font-size:18px;margin-bottom:0;">
                    <tr>
                        <th style="width: 44%;border:1px solid #000;border-collapse: collapse;">Description</th>
                        <th style="width: 14%;border:1px solid #000;border-collapse: collapse;">Weight (Lbs)</th>
                        <th style="width: 14%;border:1px solid #000;border-collapse: collapse;">Arm (Inch)</th>
                        <th style="width: 24%;border:1px solid #000;border-collapse: collapse;white-space:nowrap;">Moment (Lbs inch)</th>
                    </tr>
                    <tr>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">Basic Empty Weight</td>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">{{sprintf('%.2f',$empty_weight['weight'])}}</td>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">{{$empty_weight['arm']}}</td>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">{{sprintf('%.2f',$empty_weight['mom'])}}</td>
                    </tr>
                    <tr>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">Pilot</td>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">{{sprintf('%.2f',$pilot_co_pilot['weight'])}}</td>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">{{sprintf('%.2f',$pilot_co_pilot['arm'])}}</td>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">{{sprintf('%.2f',$pilot_co_pilot['mom'])}}</td>
                    </tr>
                    <tr>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">Co-Pilot</td>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">{{sprintf('%.2f',$pilot_co_pilot['weight'])}}</td>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">{{sprintf('%.2f',$pilot_co_pilot['arm'])}}</td>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">{{sprintf('%.2f',$pilot_co_pilot['mom'])}}</td>
                    </tr>
                    <tr>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">Aft Facing Passenger (4 Max)</td>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">{{sprintf('%.2f',$aft_sum_pax)}}</td>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">133.00</td>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">{{sprintf('%.2f',$aft_sum_mom)}}</td>
                    </tr>
                    <tr>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">Fwd Facing Passenger (4 Max)</td>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">{{sprintf('%.2f',$fwd_sum_pax)}}</td>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">203.00</td>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">{{sprintf('%.2f',$fwd_sum_mom)}}</td>
                    </tr>
                    <tr>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">Baggage Compartment (600 Lbs Max)</td>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">{{sprintf('%.2f',$cargo['weight'])}}</td>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">{{sprintf('%.2f',$cargo['arm'])}}</td>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">{{sprintf('%.2f',$cargo['mom'])}}</td>
                    </tr>
                    <tr>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">Fuel (1884 Lbs Max)</td>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">{{sprintf('%.2f',$take_off_fuel['weight'])}}</td>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">{{sprintf('%.2f',$take_off_fuel['arm'])}}</td>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">{{sprintf('%.2f',$take_off_fuel['momentum'])}}</td>
                    </tr>
                    <tr>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">TOTAL</td>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">{{sprintf('%.2f',$total_takeoff_weight['weight'])}}</td>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;"></td>
                        <td style="width: 17%;border:1px solid #000;border-collapse: collapse;">{{sprintf('%.2f',$total_takeoff_weight['momentum'])}}</td>
                    </tr>
                </table>
                  <p style="position: relative;font-weight: bold; padding-top:10px; padding-left: 15px;margin-top:5px;">CG for the Flight &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<span style="border-bottom: 1px solid #000;position: absolute;top:-2px;bottom-5px;">&nbsp; {{sprintf('%.1f',$total_takeoff_weight['momentum'])}}&nbsp;</span><span style="position: absolute;top:20px;left:18%;text-align:center">{{sprintf('%.1f',$total_takeoff_weight['weight'])}}</span><span style="padding-left: 160px;padding-right: 50px;">:</span><span style="padding-right: 50px;">{{sprintf('%.2f',$total_takeoff_weight['arm'])}}</span>Inches</p>
                  <p style="padding-left:25%;margin-top:0px;font-weight:normal">It is certified that the CG falls within allowable range as per RFM CG graph</p>
                  <p style="font-weight: bold;padding-top: 30px;padding-left: 15px;">Signature of PIC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<span>________________________</span><span style="padding-left: 30%;padding-right: 50px; ">Name & Licence No.</span>: <span>&nbsp; ________________________</span></p>
                     
                          <p style="margin-left:50px;font-size:14px;margin-bottom:0px;">
                          <span style="font-weight:bold;"> Note: </span> <span style="font-weight:normal;">Minimum standard weight as per CAR Section 2 Series X Part</span>
                          </p>
                          <p style="margin-left:50px;font-size:13px;margin-top:5px;font-weight:normal;">
                             <span>1.Adult Passenger (Both Male & Female): 75 (165 Lbs)</span>
                             <span style="margin-left:50px">2.Child (Between 2-12 years): 35 Kg (77 Lbs)</span>
                             <span style="margin-left:25px">3.Infant (Less than 2 years): 10Kg (22 Lbs)</span>
                          </p>
                      
                       <img style="position:absolute;bottom:-175px;left:50px" src="http://demo.privateflight.co.in/media/images/lnt/vtnma/pdfsign1.png" width="360px">
                       <img style="position:absolute;bottom:-130px;right:300px" src="http://demo.privateflight.co.in/media/images/lnt/vtnma/pdfsign2.png" width="470px">
             
                    </div>`,

                        useHTML: true,
                        y: 0,
                        align: 'center',
                        x: 0,
                    },
                    subtitle: {
                    },
                    margin: 0,
                    chart: {
                        sourceWidth: 1500,
                        sourceHeight: 1060,
                        marginTop: 220,
                        marginLeft: 975,
                        spacingRight:72,
                        spacingBottom: 438,
                        scale: 1,
                        events: {
                                 load: function () {
                    
                              this.renderer.image('http://demo.privateflight.co.in/media/images/lnt/vtnma/vtnma_graph.png', '900', '200', 575,490)
                                .add();
                            }
                        }
                    },
                    series: [
                        {
                            showInLegend: false,
                            name: 'TOW',
                            type: 'scatter',
                            color: take_off_fuel_color,
                            "marker": {
                                enabled: true,
                                "symbol": "triangle",
                                radius: 6
                            },
                              data: [take_off_data],
                            dataLabels: {
                                 enabled: false,
                                formatter: function () { 
                        return   'T.OFF C.G. ('+parseFloat(this.key).toFixed(1) + ' / ' + Math.round(this.y) + ')';
                                },
                                style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '12px', fontWeight: 'bold'},

                            }
                        },
            ]
                },

                scale: 3,
                fallbackToExportServer: false,
            },
            chart: {
                width: 800,
                height:431,
                marginTop: 17,
                marginLeft: 245,
                spacingRight:160,
                spacingBottom: 60,
                events: {
                    load: function () {
                        this.renderer.image('http://demo.privateflight.co.in/media/images/lnt/vtnma/vtnma_graph.png', '180', '0', 500, 431)
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
                min: 190,
                max: 212,
                tickInterval: 2,
                tickPositions: [190,192,194,196,198,200,202,204,206,208,210,212],
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
                min: 6500,
                max: 12000,
                tickPositions: [6500,7000,7500,8000,8500,9000,9500,10000,10500,11000,11500,12000],
                 tickLength: 0,
                 tickWidth:5,
                 tickColor:'blue',
                tickInterval: 500,
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
                enabled: true
            },
            series: [
                        {
                            showInLegend: false,
                            name: 'TOW',
                            type: 'scatter',
                            color: take_off_fuel_color,
                            "marker": {
                                enabled: true,
                                "symbol": "triangle",
                                radius: 6
                            },
                              data: [take_off_data],
                            dataLabels: {
                                 enabled: false,
                                formatter: function () { 
                        return   'T.OFF C.G. ('+parseFloat(this.key).toFixed(1) + ' / ' + Math.round(this.y) + ')';
                                },
                                style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '12px', fontWeight: 'bold'},

                            }
                        },
            ]
        });
       $('#graph_print').click(function (e) {
            var departure_aerodrome="<?php echo $from;?>";
            var destination_aerodrome="<?php echo $to;?>";
            var date_of_flight="<?php echo $date ?>";
            var chart = $('#Div1').highcharts();
            var graph_name = 'GRAPH VTNIT' + ' '+departure_aerodrome + ' ' + destination_aerodrome + '-' + date_of_flight;
            if ($(this).hasClass('disabled')) {
                e.preventDefault();
                return false;
            }

            chart.exportChart({
                type: 'application/pdf',
                filename: graph_name,
               sourceWidth: 1500,
                        sourceHeight: 1060,
                        marginTop: 23,
                        marginLeft: 194,
                        spacingRight:133,
                        spacingBottom: 80,
                        scale: 1,
                events: {
                    load: function () {
                           this.renderer.image('http://demo.privateflight.co.in/media/images/lnt/vtnma/vtnma_graph.png', '700', '50', 800,691)
                                .add();
                    }
                }

            });
        }); 
    });
        $("#from_date, #to_date,#date_of_flight,.ui-datepicker-trigger").click(function () {
            $(".notify-bg-v").fadeIn();
            $('.notify-bg-v').css('height', $(document).height());
        });
    });
    $(window).scroll(function () {
        if ($(this).scrollTop()) {
            $('#v_toTop').fadeIn();
        } else {
            $('#v_toTop').fadeOut();
        }
    });
    $("#v_toTop").click(function () {
        $("html, body").animate({scrollTop: 0}, 500);
    });
  </script>  
@stop