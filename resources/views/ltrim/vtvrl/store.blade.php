@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@push('css')
    <script src="{{url('app/js/highcharts/highcharts.js')}}"></script>
    <script src="{{url('app/js/highcharts/data.js')}}"></script>
    <script src="{{url('app/js/highcharts/exporting.js')}}"></script>
    <script src="{{url('app/js/highcharts/offline-exporting.js')}}"></script>
    <script src="{{url('app/js/highcharts/highslide-full.min.js')}}"></script>
    <script src="{{url('app/js/highcharts/highslide.config.js')}}" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="{{url('app/js/highcharts/highslide.css')}}" />
    <link href="{{url('app/css/ltrim/vtvrl.css')}}" rel="stylesheet">
    <style>
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
    left: -25px;
    background: #333;
    color: #fff;
    top: 5px;
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
select.form-control {
    background-position: 95% !important;
}
    /*        END OF PLACEHOLDER STYLES*/
    .pos-rel {
    position: relative;
}
.seat1, .seat2, .seat3, .seat4, .seat5, .seat6, .seat1_selected, .seat2_selected, .seat3_selected, .seat4_selected, .seat5_selected, .seat6_selected {
    position: absolute;
    background: url(../media/images/lnt/vtssf/vtssf_seat.png)center top no-repeat;
    width: 35px;
    height: 32px;
}
.seat1, .seat2, .seat3, .seat4, .seat5, .seat6 {
    background-position: 0px 0px; 
}
.seat1_selected, .seat2_selected, .seat3_selected, .seat4_selected, .seat5_selected, .seat6_selected {background-position: 0px -32px;}
.seat1, .seat1_selected {top: 48px;left: 302px;}
.seat2, .seat2_selected {top: 10px;left: 302px;}
.seat3, .seat3_selected {top: 48px;left: 365px;transform: rotate(180deg);}
.seat4, .seat4_selected {top: 10px;left: 365px;transform: rotate(180deg);}
.seat5, .seat5_selected {top: 48px;left: 419px;transform: rotate(180deg);}
.seat6, .seat6_selected {top: 10px;left: 419px;transform: rotate(180deg);}
.seat_no1 {width: 11px;height: 11px;background: #000;border-radius: 50%;color: #fff;font-size: 9px;line-height: 1.4;text-align: left;padding-left: 3px;position: absolute;top: 59px;left: 338px;}
.seat_no2 {width: 11px;height: 11px;background: #000;border-radius: 50%;color: #fff;font-size: 9px;line-height: 1.4;text-align: left;padding-left: 3px;position: absolute;top: 20px;left: 338px;}
.seat_no3 {width: 11px;height: 11px;background: #000;border-radius: 50%;color: #fff;font-size: 9px;line-height: 1.4;text-align: left;padding-left: 3px;position: absolute;top: 59px;left: 352px;}
.seat_no4 {width: 11px;height: 11px;background: #000;border-radius: 50%;color: #fff;font-size: 9px;line-height: 1.4;text-align: left;padding-left: 3px;position: absolute;top: 20px;left: 352px;}
.seat_no5 {width: 11px;height: 11px;background: #000;border-radius: 50%;color: #fff;font-size: 9px;line-height: 1.4;text-align: left;padding-left: 3px;position: absolute;top: 59px;left: 404px;}
.seat_no6 {width: 11px;height: 11px;background: #000;border-radius: 50%;color: #fff;font-size: 9px;line-height: 1.4;text-align: left;padding-left: 3px;position: absolute;top: 20px;left: 404px;}
 #select_date.form-control[readonly]{
  background:none !important;
} 
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
<div class="page">
    @include('includes.new_header',[])
    <main>
         <div class="container ltim_container">
         <div class="col-md-12 p-lr-0"><p class="vtobr_heading" style="text-transform: uppercase;">{{$call_sign}}</p></div>
           <div class="ltrim_sec">
            <form action='{{url('loadtrim/vtvrl')}}' method='POST' id="vtanfform">
                <div class="row">
                <input type="hidden" class="form-control" value="1" name="post">
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control" id="callsign" placeholder="call sign" value="{{$call_sign}}" style="text-transform: uppercase;" readonly>
                                <label>call sign</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets clear" placeholder="from" value="{{$from}}" name="from" id="from" autocomplete="off" data-toggle="popover" data-placement="top">
                                <label>from</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets clear" placeholder="to"  value="{{$to}}" name="to" id='to' autocomplete="off" data-toggle="popover" data-placement="top">
                                <label>to</label>
                            </div>
                        </div>
                        {!! csrf_field() !!}
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control datepicker1 clear" value="{{$date}}" id="select_date" name="date" autocomplete="off" readonly>
                                <img class="ui-datepicker-trigger" src="{{url('media/ananth/images/calender-icon1.png')}}" alt="..." title="..." >
                                <label>date</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                         
                            <div class="form-group dynamiclabel">
                                <select name="paxs" class="form-control clear" id="pax">

                                  <option value="">Select</option>
                          <option value="1" @if($pax_no== '1') {{'selected'}} @endif>1</option>
                                  <option value="2" @if($pax_no== '2') {{'selected'}}@endif>2</option>
                                  <option value="3" @if($pax_no== '3') {{'selected'}}@endif>3</option>
                                  <option value="4" @if($pax_no== '4') {{'selected'}}@endif>4</option>
                                  <option value="5" @if($pax_no== '5') {{'selected'}}@endif>5</option>
                                  <option value="6" @if($pax_no== '6') {{'selected'}}@endif>6</option>
                                </select>
                                <label for="pax">Pax</label>
                            </div>
                         </div>
                        <div class="col-md-2">
                             <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers clear" placeholder="Cargo" name="aft_baggage_compt_weight" id='cargo_vrl' value="{{$cargo['weight']}}" autocomplete="off" data-toggle="popover" data-placement="top">
                                <label for="cargo">Cargo</label>
                            </div>  
                        </div>
                        <div class="col-md-4">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets_with_space clear" placeholder="pilot name" value="{{$pilot}}" name="pilot" id="pilot" style="text-transform: uppercase;" autocomplete="off" data-toggle="popover" data-placement="top">
                                <label>pilot name</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets_with_space clear" placeholder="co pilot name" value="{{$co_pilot}}" name="co_pilot" id="co_pilot" style="text-transform: uppercase;" autocomplete="off" data-toggle="popover" data-placement="top">
                                <label>Co pilot name</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control take_off_fuel_roundoff_vtanf numbers clear" placeholder="Take off fuel" value="{{$t_off_fuel}}" name="take_off_fuel" id="take_off_fuel" autocomplete="off" data-toggle="popover" data-placement="top">
                                <label>Take off fuel</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control landing_fuel_roundoff_vtanf numbers clear" placeholder="Landing Fuel" value="{{$remaining_fuel['weight']}}" name="landing_fuel" id="landing_fuel" autocomplete="off" data-toggle="popover" data-placement="top">
                                <label>Landing Fuel</label>
                            </div>
                        </div>
                       <div class="col-md-12 p-lr-0">
                        <div class="col-md-2">  
                          <button type="submit" class="form-control newbtnv1">Submit</button></div>
                          <div class="col-md-8 text-center pos-rel" style="margin-bottom:15px;">
                              <img src="{{url('media/images/lnt/vtssf/flight_empty.png')}}" style="padding-left:20px;">
                              <div class="seat1 seat @if(array_key_exists("calculate_wt",$paxs[0])) seat1_selected @endif"></div>
                              <div class="seat_no1">1</div>
                              <div class="seat2 seat @if(array_key_exists("calculate_wt",$paxs[1])) seat2_selected @endif"></div>
                              <div class="seat_no2">2</div>
                              <div class="seat3 seat @if(array_key_exists("calculate_wt",$paxs[2])) seat3_selected @endif"></div>
                              <div class="seat_no3">3</div>
                              <div class="seat4 seat @if(array_key_exists("calculate_wt",$paxs[3])) seat4_selected @endif"></div>
                              <div class="seat_no4">4</div>
                              <div class="seat5 seat @if(array_key_exists("calculate_wt",$paxs[4])) seat5_selected @endif"></div>
                              <div class="seat_no5">5</div>
                              <div class="seat6 seat @if(array_key_exists("calculate_wt",$paxs[5])) seat6_selected @endif"></div>
                              <div class="seat_no6">6</div>
                          </div>
                           <div class="col-md-2 pull-right"> <button  id="reset" class="form-control newbtnv1">Reset</button>
                        </div>
                    </div>
                    </div>
                </div>
               </form> 
             </div>
            </div> 
      <div class="container sec_container">
     <div class="download_img download-parent">
           <img id="graph_print" class="pull-right" src="{{url('media/images/download-all.png')}}" style="margin-top: 35px;cursor: pointer;margin-right: 11px;">
           <div class="tooltip-download">Download</div>
           </div>
          <div class="col-md-12 p-lr-0">
              <p class="sec_vrl">
              <span style="display: inline-block;border-bottom:1px solid #333;margin:0 auto; ">
              VRL LOGISTICS LIMITED (AVIATION DIVISION)
              </span>
              </p> 
              <p class="sec_air">
              Aircraft Type : Premier 1 A (VT-VRL)                               
                </p> <br><br> 
                <div class="col-md-6 p-lr-0">
                <p style="font-size: 13px;padding-bottom: 15px;">
                From : <span style="text-transform: uppercase;">{{$from}}</span>
                </p>
                </div>
                <div class="col-md-6 p-lr-0">
                <p style="text-align: right;font-size: 13px;padding-bottom: 15px;padding-right:70px; ">
                TO : <span style="padding-left:20px;text-transform: uppercase;">{{$to}}</span>
                </p> 
                </div>                                        
          </div>
          <div class="col-md-12 sec_wei  p-lr-0">
              <p class="sec_wei1">WEIGHT AND BALANCE LOADING FORM</p>
              <table class="sec_ser table table-bordered">
                  <thead>
                      <tr>
                          <td colspan="3">
                          <span style="width: 40%;display: inline-block;text-align: left;border-right: 1px solid #333;">SERIAL NO :  
                          <span style="border-bottom:1px solid #333;">RB 219</span></span>
                          <span style="width: 50%;display: inline-block;text-align: center;">REGISTRATION NO: <span style="border-bottom:1px solid #333;">  VT-VRL</span></span>
                          </td>
                          
                          <td style="text-align: left;">DATE:</td>
                          <td colspan="2" style="text-transform: uppercase;">{{$date}}</td>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                        <td style="text-align: left;padding-left: 5px;padding-right: 5px;">
                        LINE
                        </td>
                        <td style="text-align: center;">
                        ITEM
                        </td>
                        <td>WEIGHT (LB)</td>
                        <td>C.G(IN)</td>
                        <td>MOM/100 (LB-IN)</td>
                      </tr>
                      <tr>
                        <td >1</td>
                        <td>Basic Empty Weight</td>
                        <td>{{$empty_weight['weight']}}</td>
                        <td>{{sprintf('%.2f',$empty_weight['arm'])}}</td>
                        <td>{{sprintf('%.2f',$empty_weight['mom'])}}</td>
                      </tr>
                      <tr>
                        <td >2</td>
                        <td>Pilot and Co Pilot</td>
                        <td>{{$pilot_co_pilot['weight']}}</td>
                        <td>{{$pilot_co_pilot['arm']}}</td>
                        <td>{{$pilot_co_pilot['mom']}}</td>
                      </tr>
                      <tr style="font-weight: bold;font-size: 14px;border:2px solid #333;">
                        <td style="font-size: 14px;" >
                        4
                        </td>
                        <td style="font-size: 14px;text-align: center;">
                        OPERATING WEIGHT
                        </td>
                        <td style="font-size: 14px;">
                        {{$empty_os['wt']}}
                        </td>
                        <td style="font-size: 14px;">
                        {{$empty_os['arm']}}
                        </td>
                        <td style="font-size: 14px;">
                        {{$empty_os['mom']}}
                        </td>
                      </tr>
                      <tr>
                        <td >5</td>
                        <td style="text-align: center;">
                        Passengers
                        </td>
                        <td></td>
                                        
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td ></td>
                        <td>Forward RH Aft Facing </td>
                        <td>@if(array_key_exists("calculate_wt",$paxs[0])) {{sprintf('%.2f',$paxs[0]['calculate_wt'])}} @else 0.00 @endif</td>
                        <td>{{$paxs[0]['arm']}}</td>
                        <td>@if(array_key_exists("calculate_mom",$paxs[0])) {{sprintf('%.2f',$paxs[0]['calculate_mom'])}} @else 0.00 @endif</td>
                      </tr>
                      <tr>
                        <td ></td>
                        <td>Forward LH Aft Facing  </td>
                        <td>@if(array_key_exists("calculate_wt",$paxs[1])) {{sprintf('%.2f',$paxs[1]['calculate_wt'])}} @else 0.00 @endif</td>
                        <td>{{$paxs[1]['arm']}}</td>
                        <td>@if(array_key_exists("calculate_mom",$paxs[1])) {{sprintf('%.2f',$paxs[1]['calculate_mom'])}} @else 0.00 @endif</td>
                      </tr>
                      <tr>
                        <td ></td>
                        <td>Center, Forward Facing  </td>
                        <td>@if(array_key_exists("calculate_wt",$paxs[2])) {{sprintf('%.2f',$paxs[2]['calculate_wt'])}} @else 0.00 @endif</td>
                        <td>{{$paxs[2]['arm']}}</td>
                        <td>@if(array_key_exists("calculate_mom",$paxs[2])) {{sprintf('%.2f',$paxs[2]['calculate_mom'])}} @else 0.00 @endif</td>
                      </tr>
                      <tr>
                        <td ></td>
                        <td>Center, Forward Facing  </td>
                        <td>@if(array_key_exists("calculate_wt",$paxs[3])) {{sprintf('%.2f',$paxs[3]['calculate_wt'])}} @else 0.00 @endif</td>
                        <td>{{$paxs[3]['arm']}}</td>
                        <td>@if(array_key_exists("calculate_mom",$paxs[3])) {{sprintf('%.2f',$paxs[3]['calculate_mom'])}} @else 0.00 @endif</td>
                      </tr>
                      <tr>
                        <td ></td>
                        <td>Aft, Forward Facing  </td>
                        <td>@if(array_key_exists("calculate_wt",$paxs[4])) {{sprintf('%.2f',$paxs[4]['calculate_wt'])}} @else 0.00 @endif</td>
                        <td>{{$paxs[4]['arm']}}</td>
                        <td>@if(array_key_exists("calculate_mom",$paxs[4])) {{sprintf('%.2f',$paxs[4]['calculate_mom'])}} @else 0.00 @endif</td>
                      </tr>
                      <tr>
                        <td ></td>
                        <td>Aft, Forward Facing  </td>
                        <td>@if(array_key_exists("calculate_wt",$paxs[5])) {{sprintf('%.2f',$paxs[5]['calculate_wt'])}} @else 0.00 @endif</td>
                        <td>{{$paxs[5]['arm']}}</td>
                         <td>@if(array_key_exists("calculate_mom",$paxs[5])) {{sprintf('%.2f',$paxs[5]['calculate_mom'])}} @else 0.00 @endif</td>
                      </tr>
                      <tr>
                        <td >6</td>
                        <td style="text-align: center;">
                        Baggage
                        </td>
                        <td>0</td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td ></td>
                        <td>Nose</td>
                        <td>0</td>
                        <td>100</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td ></td>
                        <td>Aft, Cabin</td>
                        <td>0</td>
                        <td>330</td>
                        <td>0.00</td>
                      </tr>
                      <tr>
                        <td ></td>
                        <td>Aft, Fuselage</td>
                        <td>{{$cargo['weight']}}</td>
                        <td>{{$cargo['arm']}}</td>
                        <td>{{sprintf('%.2f',$cargo['mom'])}}</td>
                      </tr>
                      <tr>
                        <td>7</td>
                        <td>Cabinet Contents</td>
                        <td>0</td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr style="font-weight: bold;font-size: 14px;border:2px solid #333;">
                        <td style="font-size: 14px;">8</td>
                        <td style="font-size: 14px;">
                        ZERO FUEL WEIGHT(DO NOT EXCEED 10000 LBS/4536 KGS)</td>
                        <td style="font-size: 14px;">{{sprintf('%.2f',$zero_fuel_weight['weight'])}}</td>
                        <td style="font-size: 14px;">{{sprintf('%.2f',$zero_fuel_weight['arm'])}}</td>
                        <td style="font-size: 14px;">{{sprintf('%.2f',$zero_fuel_weight['momentum'])}}</td>
                      </tr>
                      <tr>
                        <td >9</td>
                        <td>Fuel @ 6.7lb/Gal</td>
                        <td>{{$take_off_fuel['weight']}}</td>
                        <td></td>
                        <td>{{$take_off_fuel['momentum']}}</td>
                      </tr>
                      <tr style="font-weight: bold;font-size: 14px;border:2px solid #333;">
                        <td style="font-size: 14px;">10</td>
                        <td style="font-size: 14px;">RAMP WEIGHT ( DO NOT EXCEED 12591 LBS/)</td>
                        <td style="font-size: 14px;">{{sprintf('%.2f',$ramp_weight['weight'])}}</td>
                        <td style="font-size: 14px;">{{sprintf('%.2f',$ramp_weight['arm'])}}</td>
                        <td style="font-size: 14px;">{{sprintf('%.2f',$ramp_weight['momentum'])}}</td>
                      </tr>
                       <tr>
                        <td >11</td>
                        <td>Less Fuel for Start, Taxi and Take Off</td>
                        <td>{{$less_fuel_start['weight']}}</td>
                        <td></td>
                        <td>{{$less_fuel_start['mom']}}</td>
                      </tr>
                       <tr style="font-weight: bold;font-size: 14px;bold;border:2px solid #333;">
                        <td style="font-size: 14px;">12</td>
                        <td style="font-size: 14px;">TAKE OFF WEIGHT ( DO NOT EXCEED 12500 LBS/5670KGS)</td>
                        <td style="font-size: 14px;">{{sprintf('%.2f',$total_takeoff_weight['weight'])}}</td>
                        <td style="font-size: 14px;">{{sprintf('%.2f',$total_takeoff_weight['arm'])}}</td>
                        <td style="font-size: 14px;">{{sprintf('%.2f',$total_takeoff_weight['momentum'])}}</td>
                      </tr>
                      <tr>
                        <td >13</td>
                        <td>Total Fuel from Line 9</td>
                        <td>{{$take_off_fuel['weight']}}</td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td >14</td>
                        <td>Less Fuel used to Destination including Start, Taxi and Take Off</td>
                        <td>{{$lessfuel_dest['weight']}}</td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td >15</td>
                        <td>Total fuel remaining</td>
                        <td>{{$remaining_fuel['weight']}}</td>
                        <td></td>
                        <td>{{sprintf('%.2f',$remaining_fuel['momentum'])}}</td>
                      </tr>
                       <tr>
                        <td >16</td>
                        <td>ZERO FUEL WEIGHT from Line 8</td>
                        <td>{{sprintf('%.2f',$zero_fuel_weight['weight'])}}</td>
                        <td>{{sprintf('%.2f',$zero_fuel_weight['arm'])}}</td>
                        <td>{{sprintf('%.2f',$zero_fuel_weight['momentum'])}}</td>
                      </tr>
                       <tr>
                        <td >17</td>
                        <td>Add fuel remaining from Line 15</td>
                        <td>{{$remaining_fuel['weight']}}</td>
                        <td></td>
                        <td>{{sprintf('%.2f',$remaining_fuel['momentum'])}}</td>
                      </tr>
                      <tr style="font-weight: bold;border:2px solid #333;">
                        <td style="font-size: 14px;">18</td>
                        <td style="font-size: 14px;">LANDING WEIGHT (DO NOT EXCEED 11600 LBS/5261.76 KGS)</td>
                        <td style="font-size: 14px;">{{sprintf('%.2f',$total_landing_weight['weight'])}}</td>
                        <td style="font-size: 14px;">{{sprintf('%.2f',$total_landing_weight['arm'])}}</td>
                        <td style="font-size: 14px;">{{sprintf('%.2f',$total_landing_weight['momentum'])}}</td>
                      </tr>
                  </tbody>
              </table>
             
          </div><br>
          <div class="col-md-12">
              <p>
                  <span style="font-size: 12px;">Note 1</span>
                  <span style="border-bottom:1px solid #333;font-size: 12px;font-weight: bold"> Passenger Weights</span>
              </p>
             <p> 
             <span class="sec_wt">Wt of each Adult Pax</span> 
              <span class="sec_wt1">  
              75Kgs=165.34 lbs
              </span></p>
              <p> 
              <span class="sec_wt">Wt of each Child Pax (2yrs to 12 yrs)</span> 
              <span class="sec_wt2"> 35Kgs=77.14 Lb</span></p>
            <p>
            <span class="sec_wt">Wt of each infant (Less than 2yrs)</span>  <span class="sec_wt3">10Kgs=22.04 Lbs</span></p><br>
            <p style="font-size: 12px;">Note 2 CG in Inches = (MOMENT  ÷ WEIGHT) X 100</p><br>
            <p style="text-align: right;font-size: 12px;"><span style="padding-right: 20px;">Captain :</span> <span style="font-weight: bold;">Capt TM Gopal</span></p>
            <p style="text-align: right;font-size: 12px;"><span style="padding-right: 20px;">ATPL/CPL :</span> <span style="font-weight: bold;">ATPL-2925</span></p><br>
            <p style="text-align: center;font-size: 12px;padding-bottom: 15px;">Approval No : A7-VRL/398 Dated : 28th Feb 2013</p>
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
<script>
$("#pax").change(function()
{
  var i;var j=1;
  
  $(".seat").each(function(){
        $(this).removeClass("seat"+j+"_selected");
        j++;
    });
  for(i=1;i<=$(this).val();i++)
  {
      $(".seat"+i).addClass("seat"+i+"_selected")
  } 
   
});
$("#select_date" ).datepicker({ 
  minDate: 0,
  dateFormat: 'dd-M-yy',
  onSelect: function(dateText, inst) 
  { 
                    $("#select_date").css("border", "1px solid #999");
  }
});
  $(document).ready(function () {
  $('#reset').click(function(){
    var j=1;
  
     $('.clear').val('');
     $(".seat").each(function(){
        $(this).removeClass("seat"+j+"_selected");
        j++;
    });
  });
        $(function () {             
var landing_data=[<?php echo $total_landing_weight['arm'];?>,<?php echo $total_landing_weight['weight'];?>];
var landing_data1=[<?php echo $total_landing_weight['arm'];?>,<?php echo $total_landing_weight['weight']-250;?>];
var landing_data_graph=[<?php echo $total_landing_weight['arm'];?>,<?php echo $total_landing_weight['weight']-150;?>];
var zero_fuel_weight=[<?php echo $zero_fuel_weight['arm'];?>,<?php echo $zero_fuel_weight['weight'];?>];
var zero_fuel_weight1=[<?php echo $zero_fuel_weight['arm'];?>,<?php echo $zero_fuel_weight['weight']-250;?>];
var zero_fuel_weight_graph=[<?php echo $zero_fuel_weight['arm'];?>,<?php echo $zero_fuel_weight['weight']-150;?>];
var take_off_data=[<?php echo $total_takeoff_weight['arm']; ?>,<?php echo $total_takeoff_weight['weight']; ?>];
var take_off_data1=[<?php echo $total_takeoff_weight['arm']; ?>,<?php echo $total_takeoff_weight['weight']-250; ?>];
var take_off_data_graph=[<?php echo $total_takeoff_weight['arm']; ?>,<?php echo $total_takeoff_weight['weight']-150; ?>];

console.log(landing_data);
var fromm="<?php echo $from;?>";
var to="<?php echo $to;?>";
var date="<?php echo $date ?>";
console.log(zero_fuel_weight);
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
                         text: `<div  style="text-transform:uppercase; margin-bottom: 10px;font-weight:bold;font-size: 37px;position: absolute;top:450px;left:-675px;">Date : ${date}</div><div  style="text-transform:uppercase;font-weight:bold;margin-bottom: 10px;font-size: 37px;position: absolute;top:450px;left:600px;">Sector : ${fromm}-${to}</div>`,

                        useHTML: true,
                        y: 0,
                        align: 'center',
                        x: 0,
                    },
                    subtitle: {
                    },
                    margin: 0,
                    chart: {
                        width: 2480,
                        height: 3508,
                        spacingBottom:775,
                        spacingRight:400,
                        marginTop:635,
                        marginLeft:515,
                        events: {
                             load: function () {
                    
                           this.renderer.image('http://demo.privateflight.co.in/media/images/loadtrim/vtvrl_graph1.png', '0', '50', 2480, 3508)
                                .add();
                            }
                        }
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
                        radius: 13
                    },
                     data: [landing_data],
                    dataLabels: {
                        enabled: false,
                        formatter: function () {
                        return  'LAND C.G. ('+parseFloat(this.key).toFixed(1) + '/' + Math.round(this.y) + ')';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '35px', fontWeight: 'bold'}
                    }
                },
                {
                    showInLegend: false,
                    name: 'LW',
                    type: 'scatter',
                    color: landing_fuel_color,
                    "marker": {
                        enabled: false,
                        "symbol": "triangle",
                        radius: 13
                    },
                     data: [landing_data_graph],
                    dataLabels: {
                        enabled: true,
                        formatter: function () {
                return  'LAND C.G. ('+parseFloat(this.key).toFixed(1) + '/' + Math.round(this.y+150) + ')';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '35px', fontWeight: 'bold'}
                    }
                },
                {
                    showInLegend: false,
                    name: 'TOW',
                    type: 'scatter',
                    color: take_off_fuel_color,
                    "marker": {
                        enabled: true,
                        "symbol": "circle",
                        radius: 12
                    },
                      data: [take_off_data],
                    dataLabels: {
                         enabled: false,
                        formatter: function () { 
                return   'T.OFF C.G. ('+parseFloat(this.key).toFixed(1) + ' / ' + Math.round(this.y) + ')';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '35px', fontWeight: 'bold'},

                    }
                },
                {
                    showInLegend: false,
                    name: 'TOW',
                    type: 'scatter',
                    color: take_off_fuel_color,
                    "marker": {
                        enabled: false,
                        "symbol": "circle",
                        radius: 12
                    },
                      data: [take_off_data_graph],
                    dataLabels: {
                         enabled: true,
                        formatter: function () { 
                return   'T.OFF C.G. ('+parseFloat(this.key).toFixed(1) + '/' + Math.round(this.y+150) + ')';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '35px', fontWeight: 'bold'},

                    }
                },
                {
                    showInLegend: false,
                    name: 'ZFW',
                    type: 'scatter',
                    color: take_off_fuel_color,
                    "marker": {
                        enabled: false,
                        "symbol": "circle",
                        radius: 12
                    },
                      data: [zero_fuel_weight_graph],
                    dataLabels: {
                        enabled: true,
                        formatter: function () {
                            
                          return   'ZFW C.G. ('+parseFloat(this.key).toFixed(1) + '/' + Math.round(this.y+150) + ')';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '35px', fontWeight: 'bold'},

                    }
                },
                 {
                    showInLegend: false,
                    name: 'ZFW',
                    type: 'scatter',
                    color: take_off_fuel_color,
                    "marker": {
                        "symbol": "square",
                        radius: 10
                    },
                      data: [zero_fuel_weight],
                    dataLabels: {
                        enabled: false,
                        formatter: function () {
                            
                          return   'ZFW C.G. ('+parseFloat(this.key).toFixed(1) + '/' + Math.round(this.y) + ')';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '35px', fontWeight: 'bold'},

                    }
                },
              
            ]
                },

                scale: 3,
                fallbackToExportServer: false,
            },
            chart: {
                width: 885,
                height: 800,
                marginTop: 70,
                marginLeft: 210,
                spacingRight:190,
                spacingBottom: 80,
                events: {
                    load: function () {
                        this.renderer.image('http://demo.privateflight.co.in/media/images/loadtrim/vtssf/vtssf.png', '115', '0', 600, 782)
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
                min: 290.00,
                max: 306.00,
                tickInterval: 2,
                tickPositions: [290.00,292.00,294.00,296.00,298.00,300.00,302.00,304.00,306.00],
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
                min: 7000,
                max: 13000,
                tickPositions: [7000,7500,8000,8500,9000,9500,10000,10500,11000,11500,12000,12500,13000],
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
                    name: 'LW',
                    type: 'scatter',
                    color: landing_fuel_color,
                    "marker": {
                        enabled: true,
                        "symbol": "triangle",
                        radius: 5
                    },
                     data: [landing_data],
                    dataLabels: {
                        enabled: false,
                        formatter: function () {
                        return  'LAND C.G. ('+parseFloat(this.key).toFixed(1) + ' / ' + Math.round(this.y) + ')';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '12px', fontWeight: 'bold'}
                    }
                },
                {
                    showInLegend: false,
                    name: 'LW',
                    type: 'scatter',
                    color: landing_fuel_color,
                    "marker": {
                        enabled: false,
                        "symbol": "triangle",
                        radius: 4
                    },
                     data: [landing_data1],
                    dataLabels: {
                        enabled: true,
                        formatter: function () {
                return  'LAND C.G. ('+parseFloat(this.key).toFixed(1) + ' / ' + Math.round(this.y+250) + ')';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '12px', fontWeight: 'bold'}
                    }
                },
                {
                    showInLegend: false,
                    name: 'TOW',
                    type: 'scatter',
                    color: take_off_fuel_color,
                    "marker": {
                        enabled: true,
                        "symbol": "circle",
                        radius: 4
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
                {
                    showInLegend: false,
                    name: 'TOW',
                    type: 'scatter',
                    color: take_off_fuel_color,
                    "marker": {
                        enabled: false,
                        "symbol": "circle",
                        radius: 4
                    },
                      data: [take_off_data1],
                    dataLabels: {
                         enabled: true,
                        formatter: function () { 
                return   'T.OFF C.G. ('+parseFloat(this.key).toFixed(1) + ' / ' + Math.round(this.y+250) + ')';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '12px', fontWeight: 'bold'},

                    }
                },
                {
                    showInLegend: false,
                    name: 'ZFW',
                    type: 'scatter',
                    color: take_off_fuel_color,
                    "marker": {
                        enabled: false,
                        "symbol": "circle",
                        radius: 4
                    },
                      data: [zero_fuel_weight1],
                    dataLabels: {
                        enabled: true,
                        formatter: function () {
                            
                          return   'ZFW C.G. ('+parseFloat(this.key).toFixed(1) + ' / ' + Math.round(this.y+250) + ')';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '12px', fontWeight: 'bold'},

                    }
                },
                 {
                    showInLegend: false,
                    name: 'ZFW',
                    type: 'scatter',
                    color: take_off_fuel_color,
                    "marker": {
                        "symbol": "square",
                        radius: 4
                    },
                      data: [zero_fuel_weight],
                    dataLabels: {
                        enabled: false,
                        formatter: function () {
                            
                          return   'ZFW C.G. ('+parseFloat(this.key).toFixed(1) + ' / ' + Math.round(this.y) + ')';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '15px', fontWeight: 'bold'},

                    }
                },
            ]
        });
       $('#graph_print').click(function (e) {
            var departure_aerodrome="<?php echo $from;?>";
            var destination_aerodrome="<?php echo $to;?>";
            var date_of_flight="<?php echo $date ?>";
            var chart = $('#Div1').highcharts();
            var graph_name = 'GRAPH VTVRL' + ' '+departure_aerodrome + ' ' + destination_aerodrome + '-' + date_of_flight;
            if ($(this).hasClass('disabled')) {
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
                        this.renderer.image('http://demo.privateflight.co.in/media/avs_graph.png', '0', '0', 600, 400)
                                .add();
                    }
                }
            });
            setTimeout(function(){
                var url="<?php echo URL::to('/');?>"; 
                window.location = url+"/ltrimpdf/vtvrl";
            },5000)
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