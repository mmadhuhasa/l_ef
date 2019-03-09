@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@push('css')
     <script src="{{url('app/js/highcharts/highcharts.js')}}"></script>
   <script src="{{url('app/js/highcharts/data.js')}}"></script>
    <script src="{{url('app/js/highcharts/exporting.js')}}"></script>
    <script src="{{url('app/js/highcharts/offline-exporting.js')}}"></script>
    <script src="{{url('app/js/highcharts/highslide-full.min.js')}}"></script>
    <script src="{{url('app/js/highcharts/highslide.config.js')}}" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="{{url('app/js/highcharts/highslide.css')}}" />
<link rel="stylesheet" type="text/css" href="{{url('app/css/ltrim/vtssf.css')}}">
<style type="text/css">

    .highcharts-container {
        margin: 0px auto;
        box-shadow: 0 0 3px 1px #999999;
        margin-bottom: 15px;
    }
    .bg_grey {background: #eee;}
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
select.form-control {
    background-position: 95% !important;
}
.newbtnv1 {
    z-index: 0 !important;
}
.p-lr-0{
  padding-right: 0 !important;
  padding-left: 0 !important;
}
.ltrim_sec .form-group{
    margin-bottom: 30px;
}
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
          
           <div class="ltrim_sec">
           <div class="row"><div class="col-md-12 p-lr-0"><p class="vtobr_heading" style="text-transform: uppercase;">{{$call_sign}}</p></div></div>
            <form action='{{url('loadtrim/vtssf_old')}}' method='POST' id="vtssfform">
                <div class="row">
                <input type="hidden" class="form-control" value="1" name="post">
                    <div class="col-md-12 p-lr-0">
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control" id="callsign" placeholder="call sign" value="{{$call_sign}}" style="text-transform: uppercase;" readonly>
                                <label>call sign</label>
                            </div>
                        </div>
                        <div class="col-md-1 p-l-0">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets clear" placeholder="from" value="{{$from}}" name="from" id="from" autocomplete="off" data-toggle="popover" data-placement="top" data-toggle="popover" data-placement="top" data-toggle="popover" data-placement="top">
                                <label>from</label>
                            </div>
                        </div>
                        <div class="col-md-1 p-l-0">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets clear" placeholder="to"  value="{{$to}}" name="to" id='to' autocomplete="off" data-toggle="popover" data-placement="top" data-toggle="popover" data-placement="top" data-toggle="popover" data-placement="top">
                                <label>to</label>
                            </div>
                        </div>
                        {!! csrf_field() !!}
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control datepicker1 clear" value="{{$date}}" id="select_date" name="date" autocomplete="off" readonly>
                                <img class="ui-datepicker-trigger" src="{{url('media/ananth/images/calender-icon1.png')}}" alt="..." title="...">
                                <label>date</label>
                            </div>
                        </div>
                        <div class="col-md-3">                         
                            <div class="form-group dynamiclabel" style="font-size: 12px;line-height: 0;">
                                <div class="col-md-4 p-r-0 "><input class="clear" type="checkbox" name="pax[0]" value="165"  @if(array_key_exists("calculate_wt",$paxs[0])) {{ 'checked' }} @endif >PAX 1</div>
                                <div class="col-md-4 p-r-0 "><input class="clear" type="checkbox" name="pax[1]" value="165"  @if(array_key_exists("calculate_wt",$paxs[1])) {{ 'checked' }} @endif>PAX 2</div>
                                <div class="col-md-4 p-r-0 "><input class="clear" type="checkbox" name="pax[2]" value="165"  @if(array_key_exists("calculate_wt",$paxs[2])) {{ 'checked' }} @endif>PAX 3</div>
                                <div class="col-md-4 p-r-0 "><input class="clear" type="checkbox" name="pax[3]" value="165"  @if(array_key_exists("calculate_wt",$paxs[3])) {{ 'checked' }} @endif>PAX 4</div>
                                <div class="col-md-4 p-r-0 "><input class="clear" type="checkbox" name="pax[4]" value="165"  @if(array_key_exists("calculate_wt",$paxs[4])) {{ 'checked' }} @endif>PAX 5</div>
                                <div class="col-md-4 p-r-0 "><input class="clear" type="checkbox" name="pax[5]" value="165"  @if(array_key_exists("calculate_wt",$paxs[5])) {{ 'checked' }} @endif>PAX 6</div>
                            </div>
                         </div>
                        <div class="col-md-3">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers clear" placeholder="Baggage (Nose)" name="baggage_nose" id='baggage_nose' autocomplete="off" value="{{$baggage_nose['weight']}}" data-toggle="popover" data-placement="top">
                                <label for="baggage_nose">Baggage (Nose)</label>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers clear" placeholder="Baggage (AFT Cabin)" name="baggage_aft_cabin" id='baggage_aft_cabin' autocomplete="off" value="{{$baggage_aft_cabin['weight']}}" data-toggle="popover" data-placement="top">
                                <label for="baggage_aft_cabin">Baggage (AFT Cabin)</label>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers clear" placeholder="Aft Fuselage Baggage-Forward" name="baggage_aft_cabin_fuselage_forward" id='baggage_aft_cabin_fuselage_forward' autocomplete="off" value="{{$aft_fuselage_baggage_forward['weight']}}" data-toggle="popover" data-placement="top">
                                <label for="baggage_aft_cabin_fuselage_forward">Aft Fuselage Baggage-Forward</label>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers clear" placeholder="Aft Fuselage Baggage-Aft" name="baggage_aft_cabin_fuselage" id='baggage_aft_cabin_fuselage' autocomplete="off" value="{{$aft_fuselage_baggage_aft['weight']}}" data-toggle="popover" data-placement="top">
                                <label for="baggage_aft_cabin_fuselage">Aft Fuselage Baggage-Aft</label>
                              </div>
                            </div>
                        <div class="col-md-4">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets_with_space clear" placeholder="pilot name" value="{{$pilot}}" name="pilot" id="pilot" style="text-transform: uppercase;" autocomplete="off" data-toggle="popover" data-placement="top" data-toggle="popover" data-placement="top">
                                <label>pilot name</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets_with_space clear" placeholder="co pilot name" value="{{$co_pilot}}" name="co_pilot" id="co_pilot" style="text-transform: uppercase;" autocomplete="off" data-toggle="popover" data-placement="top" data-toggle="popover" data-placement="top">
                                <label>Co pilot name</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel clear">
                                <input type="text" class="form-control take_off_fuel_roundoff_vtssf  numbers clear" placeholder="Take off fuel" value="{{$take_off_fuel['weight']-91}}" name="take_off_fuel" id="take_off_fuel" autocomplete="off" data-toggle="popover" data-placement="top">
                                <label>Take off fuel</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control landing_fuel_roundoff_vtssf  numbers clear" placeholder="Landing Fuel" value="{{$remaining_fuel['weight']}}" name="landing_fuel" id="landing_fuel" autocomplete="off" data-toggle="popover" data-placement="top">
                                <label>Landing Fuel</label>
                            </div>
                        </div>
                    <div class="col-md-12 p-lr-0">
                        <div class="col-md-2">  
                          <button type="submit" class="form-control newbtnv1">Submit</button></div>
                          <div class="col-md-8 text-center pos-rel " style="margin-bottom:15px;">
                              <img src="{{url('media/images/lnt/vtssf/flight_empty.png')}}">
                              <div class="seat1 @if(array_key_exists("calculate_wt",$paxs[0])) seat1_selected @endif"></div>
                              <div class="seat_no1">1</div>
                              <div class="seat2  @if(array_key_exists("calculate_wt",$paxs[1])) seat2_selected @endif"></div>
                              <div class="seat_no2">2</div>
                              <div class="seat3 @if(array_key_exists("calculate_wt",$paxs[2])) seat3_selected @endif"></div>
                              <div class="seat_no3">3</div>
                              <div class="seat4 @if(array_key_exists("calculate_wt",$paxs[3])) seat4_selected @endif"></div>
                              <div class="seat_no4">4</div>
                              <div class="seat5 @if(array_key_exists("calculate_wt",$paxs[4])) seat5_selected @endif"></div>
                              <div class="seat_no5">5</div>
                              <div class="seat6 @if(array_key_exists("calculate_wt",$paxs[5])) seat6_selected @endif"></div>
                              <div class="seat_no6">6</div>
                          </div>
                           <div class="col-md-2 pull-right"> <button type="button"  id="reset" class="form-control newbtnv1">Reset</button>
                        </div>
                    </div>
                    </div>
                </div>
               </form> 
             </div>
            </div>
            <div class="container ltim_container">
            <div class="download_img">
           <img id="graph_print" class="pull-right" src="{{url('media/images/download-all.png')}}" style="margin-top: 35px;cursor: pointer;margin-right: 11px;">
           <div class="download_text">Download</div>
           </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4"><img class="logo" src="{{url('media/images/loadtrim/vtssf/logo.png')}}"></div>
                        <div class="col-md-4"><div class="heading"><p>SimmSamm Airways Pvt. Ltd.</p><p>Load & Trim Sheet</p></div></div>
                    </div>
                    <div class="row p-t-15">
                        <div class="col-md-8"><p>Aircraft Type : <b>Hawker Beechcraft Corp. 390 (Premier 1A)</b></p></div>
                        <div class="col-md-4 text-right"><p>Regn. No.  : <b>VT-SSF</b></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="head_table">
                                <thead>
                                    <tr>
                                        <th class="border-black p-l-5"><span style="text-transform: uppercase;">{{$date}}</span></th>
                                        <th></th>
                                        <th class="border-black p-l-5">From : <span style="text-transform: uppercase;">{{$from}}</span></th>
                                        <th></th>
                                        <th class="border-black p-l-5">To : <span style="text-transform: uppercase;">{{$to}}</span></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="pic_table fullwidth">
                                <thead>
                                    <tr>
                                        <th class="border-black p-l-5" style="width: 51.1%;">Capt :  <span style="text-transform: uppercase;">{{$pilot}}</span></th>
                                        <th class="border-black p-l-5" >Co-Pilot : <span style="text-transform: uppercase;">{{$co_pilot}}</span></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="main_table fullwidth">
                                <thead>
                                    <tr class="bg_grey">
                                        <th rowspan="2">S/N</th>
                                        <th rowspan="2">Item</th>
                                        <th>Weight</th>
                                        <th>Arm</th>
                                        <th>Mom/100</th>
                                        <th class="font-normal f-13" colspan="2">To be filled by PIC</th>
                                    </tr>
                                    <tr class="bg_grey">
                                        <th class="font-normal">(lbs)</th>
                                        <th class="font-normal">(in)</th>
                                        <th class="font-normal">(lbs.in)</th>
                                        <th>Wt (lbs)</th>
                                        <th>Mom/100</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Basic Empty Weight</td>
                                        <td>{{$empty_weight['weight']}}</td>
                                        <td>{{$empty_weight['arm']}}</td>
                                        <td>{{sprintf('%.0f',$empty_weight['mom'])}}</td>
                                        <td>{{$empty_weight['weight']}}</td>
                                        <td>{{sprintf('%.0f',$empty_weight['mom'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Pilot</td>
                                        <td>{{$pilot_co_pilot['weight']}}</td>
                                        <td>{{$pilot_co_pilot['arm']}}</td>
                                        <td>{{sprintf('%.0f',$pilot_co_pilot['mom'])}}</td>
                                        <td>{{$pilot_co_pilot['weight']}}</td>
                                        <td>{{sprintf('%.0f',$pilot_co_pilot['mom'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Co-Pilot</td>
                                        <td>{{$pilot_co_pilot['weight']}}</td>
                                        <td>{{$pilot_co_pilot['arm']}}</td>
                                        <td>{{sprintf('%.0f',$pilot_co_pilot['mom'])}}</td>
                                        <td>{{$pilot_co_pilot['weight']}}</td>
                                        <td>{{sprintf('%.0f',$pilot_co_pilot['mom'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Provisions / Misc.</td>
                                        <td></td>
                                        <td></td>
                                        <td>{{$provision}}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Empty Operating Weight</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="bg_grey" class="bg_grey"><b>{{$empty_os['wt']}}</b></td>
                                        <td class="bg_grey" class="bg_grey"><b>{{sprintf('%.0f',$empty_os['mom'])}}</b></td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Seat 1 (LH Row 1, Aft Facing)</td>
                                        <td>{{$paxs[0]['show_off_weight']}}</td>
                                        <td>{{$paxs[0]['arm']}}</td>
                                        <td>{{$paxs[0]['show_off_mom']}}</td>
                                        <td>@if(array_key_exists("calculate_wt",$paxs[0])) {{$paxs[0]['calculate_wt']}}@endif</td>
                                        <td>@if(array_key_exists("calculate_mom",$paxs[0])) {{sprintf('%.0f',$paxs[0]['calculate_mom'])}} @else 0 @endif</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Seat 2 (RH Row 1, Aft Facing)</td>
                                        <td>{{$paxs[1]['show_off_weight']}}</td>
                                        <td>{{$paxs[1]['arm']}}</td>
                                        <td>{{$paxs[1]['show_off_mom']}}</td>
                                        <td>@if(array_key_exists("calculate_wt",$paxs[1])) {{$paxs[1]['calculate_wt']}}@endif</td>
                                        <td>@if(array_key_exists("calculate_mom",$paxs[1])) {{sprintf('%.0f',$paxs[1]['calculate_mom'])}} @else 0 @endif</td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>Seat 3 (LH Row 2, Fwd Facing)</td>
                                        <td>{{$paxs[2]['show_off_weight']}}</td>
                                        <td>{{$paxs[2]['arm']}}</td>
                                        <td>{{$paxs[2]['show_off_mom']}}</td>
                                        <td>@if(array_key_exists("calculate_wt",$paxs[2])) {{$paxs[2]['calculate_wt']}}@endif</td>
                                        <td>@if(array_key_exists("calculate_mom",$paxs[2])) {{sprintf('%.0f',$paxs[2]['calculate_mom'])}} @else 0 @endif</td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>Seat 4 (LH Row 2, Fwd Facing)</td>
                                        <td>{{$paxs[3]['show_off_weight']}}</td>
                                        <td>{{$paxs[3]['arm']}}</td>
                                        <td>{{$paxs[3]['show_off_mom']}}</td>
                                        <td>@if(array_key_exists("calculate_wt",$paxs[3])) {{$paxs[3]['calculate_wt']}}@endif</td>
                                        <td>@if(array_key_exists("calculate_mom",$paxs[3])) {{sprintf('%.0f',$paxs[3]['calculate_mom'])}} @else 0 @endif</td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>Seat 5 (LH Row 3, Fwd Facing)</td>
                                        <td>{{$paxs[4]['show_off_weight']}}</td>
                                        <td>{{$paxs[4]['arm']}}</td>
                                        <td>{{$paxs[4]['show_off_mom']}}</td>
                                        <td>@if(array_key_exists("calculate_wt",$paxs[4])) {{$paxs[4]['calculate_wt']}} @endif</td>
                                        <td>@if(array_key_exists("calculate_mom",$paxs[4])) {{sprintf('%.0f',$paxs[4]['calculate_mom'])}} @else 0 @endif</td>
                                    </tr>   
                                    <tr>
                                        <td>11</td>
                                        <td>Seat 6 (RH Row 3, Fwd Facing)</td>
                                        <td>{{$paxs[5]['show_off_weight']}}</td>
                                        <td>{{$paxs[5]['arm']}}</td>
                                        <td>{{$paxs[5]['show_off_mom']}}</td>
                                        <td>@if(array_key_exists("calculate_wt",$paxs[5])) {{$paxs[5]['calculate_wt']}}@endif</td>
                                        <td>@if(array_key_exists("calculate_mom",$paxs[5])) {{sprintf('%.0f',$paxs[5]['calculate_mom'])}} @else 0
                                         @endif</td>
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>Baggage (Nose) Max 150 lbs</td>
                                        <td></td>
                                        <td>{{$baggage_nose['arm']}}</td>
                                        <td></td>
                                        <td>{{$baggage_nose['weight']}}</td>
                                        <td>{{sprintf('%.0f',$baggage_nose['mom'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>13</td>
                                        <td>Baggage (AFT Cabin) Max 140 lbs</td>
                                        <td></td>
                                        <td>{{$baggage_aft_cabin['arm']}}</td>
                                        <td></td>
                                        <td>{{$baggage_aft_cabin['weight']}}</td>
                                        <td>{{sprintf('%.0f',$baggage_aft_cabin['mom'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>14</td>
                                        <td>Aft Fuselage Baggage-Forward (Max 200 lb)</td>
                                        <td></td>
                                        <td>{{$aft_fuselage_baggage_forward['arm']}}</td>
                                        <td></td>
                                        <td>{{$aft_fuselage_baggage_forward['weight']}}</td>
                                        <td>{{sprintf('%.0f',$aft_fuselage_baggage_forward['mom'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>15</td>
                                        <td>Aft Fuselage Baggage-Aft (Max 200 lb)</td>
                                        <td></td>
                                        <td>{{$aft_fuselage_baggage_aft['arm']}}</td>
                                        <td></td>
                                        <td>{{$aft_fuselage_baggage_aft['weight']}}</td>
                                        <td>{{sprintf('%.0f',$aft_fuselage_baggage_aft['mom'])}}</td>
                                    </tr>
                                    <tr class="font-bold">
                                        <td class="font-normal bg_grey" style="vertical-align:top">16</td>
                                        <td class="bg_grey">Zero Fuel Weight<br> (Do Not Exceed 10,000 lbs)</td>
                                        <td></td>
                                        <td class="bg_grey">{{$zero_fuel_weight['arm']}}</td>
                                        <td></td>
                                        <td class="bg_grey">{{$zero_fuel_weight['weight']}}</td>
                                        <td class="font-normal bg_grey">{{sprintf('%.0f',$zero_fuel_weight['momentum'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>17</td>
                                        <td>Take Off Fuel <b>(Max Usable 3670 lbs)</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>{{$take_off_fuel['weight']}}</b></td>
                                        <td>{{$take_off_fuel['momentum']}}</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:top">18</td>
                                        <td>Ramp Weight<br><b>(Do Not Exceed 12,591 lbs)</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{$ramp_weight['weight']}}</td>
                                        <td>{{sprintf('%.0f',$ramp_weight['momentum'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>19</td>
                                        <td>Less Fuel for Start and Taxi</td>
                                        <td>{{$less_fuel_start['weight']}}</td>
                                        <td></td>
                                        <td>{{$less_fuel_start['mom']}}</td>
                                        <td>{{$less_fuel_start['weight']}}</td>
                                        <td>{{$less_fuel_start['mom']}}</td>
                                    </tr>
                                    <tr class="font-bold">
                                        <td class="font-normal bg_grey" style="vertical-align:top">20</td>
                                        <td  class="bg_grey">Total Take Off Weight<br> (Do Not Exceed 12,500 lbs)</td>
                                        <td></td>
                                        <td class="bg_grey">{{$total_takeoff_weight['arm']}}</td>
                                        <td></td>
                                        <td class="bg_grey">{{$total_takeoff_weight['weight']}}</td>
                                        <td class="font-normal bg_grey">{{sprintf('%.0f',$total_takeoff_weight['momentum'])}}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="6" class="text-center"><b>Landing Weight Determination</b></td>
                                    </tr>
                                    <tr>
                                        <td>21</td>
                                        <td>Zero Fuel Weight from Line 16</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{$zero_fuel_weight['weight']}}</td>
                                        <td>{{sprintf('%.0f',$zero_fuel_weight['momentum'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>22</td>
                                        <td>Total Anticipated Landing Fuel Remaining</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>{{$remaining_fuel['weight']}}</b></td>
                                        <td>{{$remaining_fuel['momentum']}}</td>
                                    </tr>
                                    <tr class="font-bold">
                                        <td class="font-normal bg_grey" style="vertical-align:top">23</td>
                                        <td class="bg_grey">Total Landing Weight<br> (Do Not Exceed 11,600 lbs)</td>
                                        <td></td>
                                        <td class="bg_grey">{{$total_landing_weight['arm']}}</td>
                                        <td></td>
                                        <td class="bg_grey">{{$total_landing_weight['weight']}}</td>
                                        <td class="font-normal bg_grey">{{round($total_landing_weight['momentum'])}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row p-tb-15">
                        <div class="col-md-12"><p><i># For C.G. Limit Ref C.G. envelope on AFM, Section 6 - Weight & Balance, Page 6-16 on reverse</p></i></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-offset-1 col-md-11"><p class="p-l-15"><i>Total Moment</i></p></div>
                            <div class="col-md-5 p-l-0"><p><i>C.G. of Flight = &nbsp; ---------------&nbsp; x 100 = </i></p></div><div class="col-md-7"><p><i>inch</i></p></div>
                            <div class="col-md-offset-1 col-md-11"><p class="p-l-15"><i>Total Weight</i></p></div>
                        </div>
                    </div>
                    <div class="row p-t-15">
                        <div class="col-md-12">
                            <p><i>Allowable Fwd C.G. up to 12,500 lbs = 294.37 inch ; AFT CG up to 10,000 lbs = 303.97 inch ; Aft C.G. up to</i></p>
                            <p><i>12,500 lbs = 300.14 inch</i></p>
                        </div>
                    </div>
                    <div class="row p-tb-15">
                        <div class="col-md-12"><p>It is certified that C.G. falls within the limits.</p></div>
                    </div>
                    <div class="row p-b-30">
                        <div class="col-md-9"><b>Date: <span style="text-transform: uppercase;">{{$date}}</b></span></div>
                        <div class="col-md-3"><b>Signature of PIC :</b></div>
                        <div class="col-md-offset-9 col-md-3"><b>License No :</b></div>
                        <div class="col-md-9"><p>Approved vide DDG, Mumbai. Letter No. A-7/SSF/1800</p></div>
                        <div class="col-md-3"><p class="">Dated : <span style="text-transform: uppercase;">01-JUL-2013</span></p></div>
                    </div>
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
<script>
 $("input[name='pax[0]']").change(function() 
 {
        if($(this).is(':checked')) {
           $('.seat1').addClass('seat1_selected ')  
        }
        else
             $('.seat1').removeClass('seat1_selected')  
}); 
 $("input[name='pax[1]']").change(function() 
 {
        console.log("Ss");
        if($(this).is(':checked')) {
           $('.seat2').addClass('seat2_selected ')  
        }
        else
           $('.seat2').removeClass('seat2_selected')  
}); 
 $("input[name='pax[2]']").change(function() 
 {
        console.log("Ss");
        if($(this).is(':checked')) {
           $('.seat3').addClass('seat3_selected ')  
        }
        else
           $('.seat3').removeClass('seat3_selected')  
}); 
 $("input[name='pax[3]']").change(function() 
 {
        console.log("Ss");
        if($(this).is(':checked')) {
           $('.seat4').addClass('seat4_selected ')  
        }
        else
           $('.seat4').removeClass('seat4_selected')  
}); 
 $("input[name='pax[4]']").change(function() 
 {
        console.log("Ss");
        if($(this).is(':checked')) {
           $('.seat5').addClass('seat5_selected ')  
        }
        else
             $('.seat5').removeClass('seat5_selected')  
}); 
 $("input[name='pax[5]']").change(function() 
 {
        if($(this).is(':checked')) {
           $('.seat6').addClass('seat6_selected ')  
        }
        else
           $('.seat6').removeClass('seat6_selected')  
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
          $('.clear').val('');
          $('.seat6').removeClass('seat6_selected');  
          $('.seat5').removeClass('seat5_selected');  
          $('.seat4').removeClass('seat4_selected');  
          $('.seat3').removeClass('seat3_selected');  
          $('.seat2').removeClass('seat2_selected');  
          $('.seat1').removeClass('seat1_selected');  
          $('.clear').prop('checked', false); 
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
var fromm="<?php echo $from;?>";
var to="<?php echo $to;?>";
var date="<?php echo $date ?>";
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
                    
                           this.renderer.image('https://www.eflight.aero/media/images/loadtrim/vtssf/vtssf1.png', '0', '50', 2480, 3508)
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
                width: 930,
                height: 800,
                marginTop: 70,
                marginLeft: 210,
                spacingRight:235,
                spacingBottom: 80,
                events: {
                    load: function () {
                        this.renderer.image('https://www.eflight.aero/media/images/loadtrim/vtssf/vtssf.png', '115', '0', 600, 782)
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
            var graph_name = 'GRAPH VTSSF' + ' '+departure_aerodrome + ' ' + destination_aerodrome + '-' + date_of_flight;
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
                        this.renderer.image('https://www.eflight.aero/media/avs_graph.png', '0', '0', 600, 400)
                                .add();
                    }
                }
            });
            setTimeout(function(){
                var url="<?php echo URL::to('/');?>"; 
                window.location = url+"/ltrimpdf/vtssf";
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