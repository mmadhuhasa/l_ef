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
<link rel="stylesheet" type="text/css" href="{{url('app/css/ltrim/vtssf.css')}}">
<style type="text/css">
    .highcharts-container {
        margin: 0px auto;
        box-shadow: 0 0 3px 1px #999999;
        margin-bottom: 15px;
    }
    .bg_grey {background: #eee;}
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
.vtobr_heading{
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
</style>
@endpush
@section('content')
<div class="page">
    @include('includes.new_header',[])
    <main>
         <div class="container ltim_container">
           <div class="ltrim_sec">
           <div class="row"><div class="col-md-12 p-lr-0"><p class="vtobr_heading" style="text-transform: uppercase;">VTSSF</p></div></div>
            <form action='{{url('loadtrim/vtssf')}}' method='POST' id="vtssfform">
                <div class="row">
                <input type="hidden" class="form-control" value="1" name="post">
                    <div class="col-md-12 p-lr-0">
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control" id="callsign" placeholder="call sign" value="vtssf" style="text-transform: uppercase;" readonly>
                                <label>call sign</label>
                            </div>
                        </div>
                        <div class="col-md-1 p-l-0">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets clear dis" placeholder="from" value="{{$from}}" name="from" id="from" autocomplete="off" data-toggle="popover" data-placement="top" data-toggle="popover" data-placement="top" data-toggle="popover" data-placement="top" disabled="disabled">
                                <label>from</label>
                            </div>
                        </div>
                        <div class="col-md-1 p-l-0">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets clear dis" placeholder="to"  value="{{$to}}" name="to" id='to' autocomplete="off" data-toggle="popover" data-placement="top" data-toggle="popover" data-placement="top" data-toggle="popover" data-placement="top" disabled="disabled">
                                <label>to</label>
                            </div>
                        </div>
                        {!! csrf_field() !!}
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control datepicker1 clear" value="{{$date}}" id="select_date" name="date" autocomplete="off" disabled>
                                <img class="ui-datepicker-trigger" src="{{url('media/ananth/images/calender-icon1.png')}}" alt="..." title="...">
                                <label>date</label>
                            </div>
                        </div>
                        <div class="col-md-3">                         
                            <div class="form-group dynamiclabel" style="font-size: 12px;line-height: 0;">
                                <div class="col-md-4 p-r-0 "><input class="clear" type="checkbox" name="pax[0]" value="165"  @if(array_key_exists("calculate_wt",$paxs[0])) {{ 'checked' }} @endif disabled="disabled">PAX 1</div>
                                <div class="col-md-4 p-r-0 "><input class="clear" type="checkbox" name="pax[1]" value="165"  @if(array_key_exists("calculate_wt",$paxs[1])) {{ 'checked' }} @endif disabled="disabled">PAX 2</div>
                                <div class="col-md-4 p-r-0 "><input class="clear" type="checkbox" name="pax[2]" value="165"  @if(array_key_exists("calculate_wt",$paxs[2])) {{ 'checked' }} @endif disabled="disabled">PAX 3</div>
                                <div class="col-md-4 p-r-0 "><input class="clear" type="checkbox" name="pax[3]" value="165"  @if(array_key_exists("calculate_wt",$paxs[3])) {{ 'checked' }} @endif disabled="disabled">PAX 4</div>
                                <div class="col-md-4 p-r-0 "><input class="clear" type="checkbox" name="pax[4]" value="165"  @if(array_key_exists("calculate_wt",$paxs[4])) {{ 'checked' }} @endif disabled="disabled">PAX 5</div>
                                <div class="col-md-4 p-r-0 "><input class="clear" type="checkbox" name="pax[5]" value="165"  @if(array_key_exists("calculate_wt",$paxs[5])) {{ 'checked' }} @endif disabled="disabled">PAX 6</div>
                            </div>
                         </div>
                        <div class="col-md-3">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers clear dis" placeholder="Baggage (Nose)" name="baggage_nose" id='baggage_nose' autocomplete="off" value="{{$baggage_nose['weight']}}" data-toggle="popover" data-placement="top" disabled="disabled">
                                <label for="baggage_nose">Baggage (Nose)</label>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers clear dis" placeholder="Baggage (AFT Cabin)" name="baggage_aft_cabin" id='baggage_aft_cabin' autocomplete="off" value="{{$baggage_aft_cabin['weight']}}" data-toggle="popover" data-placement="top" disabled="disabled">
                                <label for="baggage_aft_cabin">Baggage (AFT Cabin)</label>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers clear dis" placeholder="Aft Fuselage Baggage-Forward" name="baggage_aft_cabin_fuselage_forward" id='baggage_aft_cabin_fuselage_forward' autocomplete="off" value="{{$aft_fuselage_baggage_forward['weight']}}" data-toggle="popover" data-placement="top" disabled="disabled">
                                <label for="baggage_aft_cabin_fuselage_forward">Aft Fuselage Baggage-Forward</label>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers clear dis" placeholder="Aft Fuselage Baggage-Aft" name="baggage_aft_cabin_fuselage" id='baggage_aft_cabin_fuselage' autocomplete="off" value="{{$aft_fuselage_baggage_aft['weight']}}" data-toggle="popover" data-placement="top" disabled="disabled">
                                <label for="baggage_aft_cabin_fuselage">Aft Fuselage Baggage-Aft</label>
                              </div>
                            </div>
                        <div class="col-md-4">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets_with_space dis" placeholder="pilot name" value="{{$pilot}}" name="pilot" id="pilot" style="text-transform: uppercase;" autocomplete="off" data-toggle="popover" data-placement="top" data-toggle="popover" data-placement="top" disabled="disable">
                                <label>pilot name</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets_with_space dis" placeholder="co pilot name" value="{{$co_pilot}}" name="co_pilot" id="co_pilot" style="text-transform: uppercase;" autocomplete="off" data-toggle="popover" data-placement="top" data-toggle="popover" data-placement="top" disabled="disable">
                                <label>Co pilot name</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel clear">
                                <input type="text" class="form-control take_off_fuel_roundoff_vtssf  numbers clear dis" placeholder="Take off fuel" value="{{$take_off_fuel['weight']-91}}" name="take_off_fuel" id="take_off_fuel" autocomplete="off" data-toggle="popover" data-placement="top" disabled="disabled">
                                <label>Take off fuel</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control landing_fuel_roundoff_vtssf  numbers clear dis" placeholder="Landing Fuel" value="{{$remaining_fuel['weight']}}" name="landing_fuel" id="landing_fuel" autocomplete="off" data-toggle="popover" data-placement="top" disabled="disabled">
                                <label>Landing Fuel</label>
                            </div>
                        </div>
                    <div class="col-md-12 p-lr-0">
                        <div class="col-md-2">  
                         </div>
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
                           <div class="col-md-2 pull-right"> 
                        </div>
                    </div>
                    </div>
                </div>
               </form> 
             </div>
            </div>
            <div class="container ltim_container" style="padding-bottom: 10px;">
            <div class="download_img">
           <img id="graph_print" class="pull-right" src="{{url('media/images/download-all.png')}}" style="margin-top: 35px;cursor: pointer;margin-right: 11px;">
           <div class="download_text">Download</div>
           </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                  <div class="container" style="font-family: arial,sans-serif;font-size: 12px;">
            <div class="row" style="clear: both;width:96%;">
                <div class="col-md-12">
                        <table style="margin-bottom:20px; border-spacing: 0;border:1px solid #000;border-collapse: collapse;width:100%;margin-top:50px;height:0%;font-size:12px;margin-bottom:20px;font-weight: bold;">
                        <tbody style="border:1px solid #000; spacingTop:300;">
                        <tr>
                            <td rowspan="5" style="border:1px solid #000;border-collapse:collapse;width:13%;padding-top:10px;padding-left:10px;">
                                 <img src="https://www.eflight.aero/media/images/loadtrim/vtssf/logo.png" width:80px; height="70px">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" style="border:1px solid #000;border-collapse:collapse;font-size:12px;">
                                 <P style="text-align: center;font-weight: bold;font-size: 14px;">LOAD & TRIM SHEET</P>
                            </td>
                        </tr>
                        <tr>
                            <td style="border:1px solid #000;border-collapse:collapse;width:10%;text-align:center;font-size:11px;padding:2px;">Type of Aircarft:</td>
                            <td style="border:1px solid #000;border-collapse:collapse;width:30%;font-size:11px;padding:2px;padding-left:3px;text-transform:uppercase;">Hawker Beechcraft Premier-1A model 390</td>
                            <td style="border:1px solid #000;border-collapse:collapse;width:5%;text-align:center;font-size:11px;padding:2px;">Date :</td>
                            <td style="border:1px solid #000;border-collapse:collapse;width:15%;font-size:11px;padding:2px;"> {{$date}}</td>
                            <td colspan="2" style="border:1px solid #000;border-collapse:collapse;text-align:center;font-size:11px;padding:2px;width:10%;"></td>
                        </tr>
                        <tr>
                            <td style="border:1px solid #000;border-collapse:collapse;font-size:11px;padding:2px;text-align:center;">Aircraft Regn : </td>
                            <td style="border:1px solid #000;border-collapse:collapse;font-size:11px;padding:2px;padding-left:6px;">VT-SSF</td>
                            <td style="border:1px solid #000;border-collapse:collapse;font-size:11px;padding:2px;text-align:center;">From:</td>
                            <td style="border:1px solid #000;border-collapse:collapse;font-size:11px;padding:2px;">{{$from}}</td>
                            <td style="border:1px solid #000;border-collapse:collapse;font-size:11px;padding:2px;padding-left:4px;width:5%;">To</td>
                            <td style="border:1px solid #000;border-collapse:collapse;font-size:11px;padding:2px;width:30%;"> {{$to}}</td>
                        </tr>
                        <tr>
                            <td style="border:1px solid #000;border-collapse:collapse;text-align:center;font-size:11px;">Serial No :</td>
                            <td style="border:1px solid #000;border-collapse:collapse;font-size:11px;padding-left:3px;">RB243</td>
                            <td style="border:1px solid #000;border-collapse:collapse;text-align:center;font-size:11px;">PIC : </td>
                            <td style="border:1px solid #000;border-collapse:collapse;font-size:11px;"> {{strtoupper($pilot)}}</td>
                            <td style="border:1px solid #000;border-collapse:collapse;font-size:11px;padding-left:4px;border-right:1px solid #000;width:7%;">Co-Pilot:</td>
                            <td style="border:1px solid #000;border-collapse:collapse;font-size:11px;padding:2px;"> {{strtoupper($co_pilot)}}</td>
                        </tr>
                        </tbody>
                        </table>
                        </div>
                    </div>
 
                    </div>
                    <div class="row" >
                        <div class="col-md-12">
                            <table class="main_table fullwidth" style="width: 900px;margin-left:13px;font-size: 11px;">
                                <thead>
                                    <tr>
                                        <th rowspan="2" style="vertical-align: middle;">SL.NO.</th>
                                        <th rowspan="2" style="width: 43%;border-right: 0;vertical-align: middle;">DETAILS</th>
                                        <th style="border-bottom: 0;">Weight</th>
                                        <th style="border-bottom: 0;">C.G (inch.)</th>
                                        <th style="width:16%;border-bottom: 0;border-right: 1px solid #333;">MOMENT</th>
                                    </tr>
                                    <tr>
                                    <th style="border-top:0;border-left:0; ">(W) (LBS.)</th>
                                        <th class="font-normal" style="border-top:0;"></th>
                                        <th class="font-normal" style="border-top:0;border-right: 1px solid #333;">(M)/100 (LB. IN)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td style="border-right:0;font-weight: bold; ">Basic Empty Weight</td>
                                        <td>{{$empty_weight['weight']}}</td>
                                        <td>{{$empty_weight['arm']}}</td>
                                        <td>{{sprintf('%.0f',$empty_weight['mom'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Pilot</td>
                                        <td>{{$pilot_co_pilot['weight']}}</td>
                                        <td>{{$pilot_co_pilot['arm']}}</td>
                                        <td>{{sprintf('%.0f',$pilot_co_pilot['mom'])}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Co-Pilot</td>
                                        <td>{{$pilot_co_pilot['weight']}}</td>
                                        <td>{{$pilot_co_pilot['arm']}}</td>
                                        <td>{{sprintf('%.0f',$pilot_co_pilot['mom'])}}</td>
                                      
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Provision/miscellaneous (max 105 lbs)</td>
                                        <td></td>
                                        <td>201</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td style="font-weight: bold;">Empty Operating Weight</td>
                                        <td>{{$empty_os['wt']}}</td>
                                        <td></td>
                                        <td>{{$empty_os['mom']}}</td>
                                      
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Seat 1 (LH Row 1, Aft Facing)</td>
                                         <td>@if(array_key_exists("calculate_wt",$paxs[0])) {{$paxs[0]['calculate_wt']}}@endif</td>
                                        <td>{{$paxs[0]['arm']}}</td>
                                        <td>@if(array_key_exists("calculate_mom",$paxs[0])) {{sprintf('%.0f',$paxs[0]['calculate_mom'])}} @else 0 @endif</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Seat 2 (RH Row 1, Aft Facing)</td>
                                         <td>@if(array_key_exists("calculate_wt",$paxs[1])) {{$paxs[1]['calculate_wt']}}@endif</td>
                                        <td>{{$paxs[1]['arm']}}</td>
                                        <td>@if(array_key_exists("calculate_mom",$paxs[1])) {{sprintf('%.0f',$paxs[1]['calculate_mom'])}} @else 0 @endif</td>
                                      
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>Seat 3 (LH Row 2, Fwd Facing)</td>
                                        <td>@if(array_key_exists("calculate_wt",$paxs[2])) {{$paxs[2]['calculate_wt']}}@endif</td>
                                        <td>{{$paxs[2]['arm']}}</td>
                                        <td>@if(array_key_exists("calculate_mom",$paxs[2])) {{sprintf('%.0f',$paxs[2]['calculate_mom'])}} @else 0 @endif</td>
                                      
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>Seat 4 (RH Row 2, Fwd Facing)</td>
                                        <td>@if(array_key_exists("calculate_wt",$paxs[3])) {{$paxs[3]['calculate_wt']}}@endif</td>
                                        <td>{{$paxs[3]['arm']}}</td>
                                        <td>@if(array_key_exists("calculate_mom",$paxs[3])) {{sprintf('%.0f',$paxs[3]['calculate_mom'])}} @else 0 @endif</td>
                                      
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>Seat 5 (LH Row 3, Fwd Facing)</td>
                                        <td>@if(array_key_exists("calculate_wt",$paxs[4])) {{$paxs[4]['calculate_wt']}}@endif</td>
                                        <td>{{$paxs[4]['arm']}}</td>
                                        <td>@if(array_key_exists("calculate_mom",$paxs[4])) {{sprintf('%.0f',$paxs[4]['calculate_mom'])}} @else 0 @endif</td>
                                     
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>Seat 6 (RH Row 3, Fwd Facing)</td>
                                         <td>@if(array_key_exists("calculate_wt",$paxs[5])) {{$paxs[5]['calculate_wt']}}@endif</td>
                                        <td>{{$paxs[5]['arm']}}</td>
                                        <td>@if(array_key_exists("calculate_mom",$paxs[5])) {{sprintf('%.0f',$paxs[5]['calculate_mom'])}} @else 0 @endif</td>
                                       
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>Baggage (Nose) Max 150 lbs</td>
                                        <td>{{$baggage_nose['weight']}}</td>
                                        <td>{{$baggage_nose['arm']}}</td>
                                        <td>{{sprintf('%.0f',$baggage_nose['mom'])}}</td>
                                       
                                    </tr>
                                    <tr>
                                        <td>13</td>
                                        <td>Baggage (AFT Cabin) Max 140 lbs</td>
                                        <td>{{$baggage_aft_cabin['weight']}}</td>
                                        <td>{{$baggage_aft_cabin['arm']}}</td>
                                        <td>{{sprintf('%.0f',$baggage_aft_cabin['mom'])}}</td>
                                       
                                    </tr>
                                    <tr>
                                        <td>14</td>
                                        <td>Aft Fuselage Baggage-Forward (Max 200 lb)</td>
                                        <td>{{$aft_fuselage_baggage_forward['weight']}}</td>
                                        <td>{{$aft_fuselage_baggage_forward['arm']}}</td>
                                        <td>{{sprintf('%.0f',$aft_fuselage_baggage_forward['mom'])}}</td>
                                       
                                    </tr>
                                    <tr>
                                        <td>15</td>
                                        <td>Aft Fuselage Baggage-Aft (Max 200 lb)</td>
                                        <td>{{$aft_fuselage_baggage_aft['weight']}}</td>
                                        <td>{{$aft_fuselage_baggage_aft['arm']}}</td>
                                        <td>{{sprintf('%.0f',$aft_fuselage_baggage_aft['mom'])}}</td>
                                       
                                    </tr>
                                    <tr style="font-weight: bold;">
                                        <td>16</td>
                                        <td class="font-bold">Total-Zero Fuel Weight (Not to Exceed 10,000 lbs)</td>
                                        <td>{{$zero_fuel_weight['weight']}}</td>
                                        <td>{{$zero_fuel_weight['arm']}}</td>
                                        <td>{{sprintf('%.0f',$zero_fuel_weight['momentum'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>17</td>
                                        <td>Fuel (Max usable 3670 lbs)</td>
                                        <td>{{$take_off_fuel['weight']}}</td>
                                        <td></td>
                                        <td>{{$take_off_fuel['momentum']}}</td>
                                       
                                    </tr>
                                    <tr style="font-weight: bold;">
                                        <td style="vertical-align:top">18</td>
                                        <td class="font-bold">Total Ramp Weight (Not to exceed 12,591 lbs)
                                        </td>
                                        <td>{{$ramp_weight['weight']}}</td>
                                        <td></td>
                                        <td>{{sprintf('%.0f',$ramp_weight['momentum'])}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>19</td>
                                        <td>Less Fuel for TakeOff and Taxi (91 Lbs)</td>
                                        <td >{{$less_fuel_start['weight']}}</td>
                                        <td></td>
                                        <td>{{$less_fuel_start['mom']}}</td>
                                       
                                    </tr>
                                    <tr style="font-weight: bold;">
                                        <td class="font-normal" style="vertical-align:top"><b>20</b></td>
                                        <td class="font-bold">Total Take Of (Not to exceed 12,500 lbs)
                                        <td >{{$total_takeoff_weight['weight']}}</td>
                                        <td >{{$total_takeoff_weight['arm']}}</td>
                                        <td >{{sprintf('%.0f',$total_takeoff_weight['momentum'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>21</td>
                                        <td>Total Anticipated Fuel Remaining at Landing (refre fuel Mom.Table)
                                        </td>
                                        <td>{{$remaining_fuel['weight']}}</td>
                                        <td></td>
                                         <td>{{$remaining_fuel['momentum']}}</td>
                                    </tr>
                                    <tr style="font-weight: bold;">
                                        <td>22</td>
                                        <td class="font-bold">Total Landing Weight (Not to exceed 11,500 lbs)
                                        <td >{{$total_landing_weight['weight']}}</td>
                                        <td>{{$total_landing_weight['arm']}}</td>
                                        <td >{{round($total_landing_weight['momentum'])}}</td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
           
    </main>
     <div class="container graph_container">
            <div class="row">
                <div class="col-sm-8 col-md-12">
                    <div id="Div1"></div>                      
                </div>
            </div>
     </div>
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
  // minDate: 0,
  dateFormat: 'dd-M-yy',
  maxDate: '+4D',
  onSelect: function(dateText, inst) 
  { 
                    $("#select_date").css("border", "1px solid #999");
  }
});
 $(document).ready(function () {
      $('#reset').click(function(){
            $(".clear,.newbtnv1,.dis").removeAttr("disabled");
            // $(".clear").removeAttr("readonly"); 
        });
        $(function () {              
var landing_data=[<?php echo $total_landing_weight['arm'];?>,<?php echo $total_landing_weight['weight'];?>];
var landing_data1=[<?php echo $total_landing_weight['arm'];?>,<?php echo $total_landing_weight['weight']-250;?>];
var landing_data_graph=[<?php echo $total_landing_weight['arm'];?>,<?php echo $total_landing_weight['weight']-300;?>];
var zero_fuel_weight=[<?php echo $zero_fuel_weight['arm'];?>,<?php echo $zero_fuel_weight['weight'];?>];
var zero_fuel_weight1=[<?php echo $zero_fuel_weight['arm'];?>,<?php echo $zero_fuel_weight['weight']-250;?>];
var zero_fuel_weight_graph=[<?php echo $zero_fuel_weight['arm'];?>,<?php echo $zero_fuel_weight['weight']-300;?>];
var take_off_data=[<?php echo $total_takeoff_weight['arm']; ?>,<?php echo $total_takeoff_weight['weight']; ?>];
var take_off_data1=[<?php echo $total_takeoff_weight['arm']; ?>,<?php echo $total_takeoff_weight['weight']-250; ?>];
var take_off_data_graph=[<?php echo $total_takeoff_weight['arm']; ?>,<?php echo $total_takeoff_weight['weight']-300; ?>];
var fromm="<?php echo $from;?>";
var to="<?php echo $to;?>";
var date="<?php echo $date ?>";
    var curve_color = '#000';
    var zero_fuel_color = 'darkgrey';
    var landing_fuel_color = '#000';
    var take_off_fuel_color = '#000';
    var zfg_color = '#2cc38a';  
    console.log('landing_data tri='+landing_data);
    console.log('take_off_data cir='+take_off_data);
    console.log('zero_fuel_weight squ='+zero_fuel_weight);
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
                         text: `<div class="container" style="font-family: arial,sans-serif;">
            <div class="row" style="clear: both;width:96%;">
                <div class="col-md-12">
                        <table style="margin-bottom:20px; border-spacing: 0;border:1px solid #000;border-collapse: collapse;width:100%;margin-top:-150px;height:0%;font-size:13px;margin-bottom:20px;margin-left:125px"">
                        <tbody style="border:1px solid #000; spacingTop:300;font-weight:bold">
                        <tr>
                            <td rowspan="5" style="border:1px solid #000;border-collapse:collapse;width:13%;padding-top:10px;padding-left:30px;">
                                 <img src="https://www.eflight.aero/media/images/loadtrim/vtssf/logo.png" width:80px; height="70px">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" style="border:1px solid #000;border-collapse:collapse;">
                                 <P style="text-align: center;font-weight: bold;font-size: 14px;">LOAD & TRIM SHEET</P>
                            </td>
                        </tr>
                        <tr>
                            <td style="border:1px solid #000;border-collapse:collapse;width:10%;text-align:center;font-size:13px;padding:2px;">Type of Aircarft:</td>
                            <td style="border:1px solid #000;border-collapse:collapse;width:27%;font-size:13px;padding:2px;padding-left:6px;text-transform:uppercase;">Hawker Beechcraft Premier-1A model 390</td>
                            <td style="border:1px solid #000;border-collapse:collapse;width:5%;text-align:center;font-size:13px;padding:2px;">Date :</td>
                            <td style="border:1px solid #000;border-collapse:collapse;width:20%;font-size:13px;padding:2px;"> {{$date}}</td>
                            <td colspan="2" style="border:1px solid #000;border-collapse:collapse;width20%;text-align:center;font-size:13px;padding:2px;"></td>
                        </tr>
                        <tr>
                            <td style="border:1px solid #000;border-collapse:collapse;font-size:13px;padding:2px;text-align:center;">Aircraft Regn : </td>
                            <td style="border:1px solid #000;border-collapse:collapse;font-size:13px;padding:2px;padding-left:6px;">VT-SSF</td>
                            <td style="border:1px solid #000;border-collapse:collapse;font-size:13px;padding:2px;text-align:center;">From:</td>
                            <td style="border:1px solid #000;border-collapse:collapse;font-size:13px;padding:2px;">{{$from}}</td>
                            <td style="border:1px solid #000;border-collapse:collapse;font-size:13px;padding:2px;padding-left:4px;width:5%;">To</td>
                            <td style="border:1px solid #000;border-collapse:collapse;font-size:13px;padding:2px;width:15%;"> {{$to}}</td>
                        </tr>
                        <tr>
                            <td style="border:1px solid #000;border-collapse:collapse;text-align:center;font-size:13px;padding:2px;line-height:1px;">Serial No :</td>
                            <td style="border:1px solid #000;border-collapse:collapse;font-size:13px;padding-left:6px;">RB243</td>
                            <td style="border:1px solid #000;border-collapse:collapse;text-align:center;font-size:13px;">PIC : </td>
                            <td style="border:1px solid #000;border-collapse:collapse;font-size:13px;"> {{strtoupper($pilot)}}</td>
                            <td style="border:1px solid #000;border-collapse:collapse;font-size:13px;padding-left:4px;border-right:1px solid #000;width:5%;">Co-Pilot:</td>
                            <td style="border:1px solid #000;border-collapse:collapse;font-size:13px;padding:2px;"> {{strtoupper($co_pilot)}}</td>
                        </tr>
                        </tbody>
                        </table>
                        </div>
                    </div>
                   
                    <div class="row" style="clear: both;">
                        <div style="width:100%;">
                        <div style=" width:58%;float:left;">
                            <table class="main_table fullwidth" style="border-spacing: 0;border-collapse: collapse;width: 90%;border:1px solid #000;margin:0px;padding:0px;margin-top:28px;margin-left:125px"">
                                <thead>
                                    <tr style="text-align: center;border-bottom: none;">
                                        <th rowspan="1" style="border-right:1px solid #000 ;border-collapse: collapse;border:0px solid #333;text-align: center;font-size:11px;width:8%;vertical-align:bottom;">SL.NO.</th>
                                        <th  style="border:1px solid #000;border-bottom: 0;border-collapse: collapse;border-left: 1px solid #333; border-right:0px;font-size:11px;text-align:center;vertical-align:bottom;padding-left:60px;padding-top:0px;">DETAILS</th>
                                        <th style="border-bottom: 0;border:1px solid #000;border-collapse: collapse;text-align: center;text-transform:uppercase;border-bottom:0px;font-size:11px;width:12%;padding-top:0px;">Weight</th>
                                        <th style="border-bottom: 0;border:1px solid #000;border-collapse: collapse;text-align: center; vertical-align:text-bottom;; border-bottom:0px;font-size:11px;width:12%;padding-top:10px;">C.G (inch)</th>
                                        <th style="border-bottom: 0;border-right: 1px solid #333;border:1px solid #000;border-collapse: collapse;text-align: center;text-transform:uppercase;border-bottom:0px;font-size:11px;width:15%;padding-top:0px;">MOMENT</th>
                                    </tr>
                                    <tr style="text-align: center;width:21%; border-bottom: none;">
                                    <th style="border-top:0;border-left:0;font-size:11px; "></th>
                                    <th style="border-top:0;border-left:1px solid #000;font-size:11px; "></th>
                                        <th class="font-normal" style="border-top:0;font-weight: normal;border:1px solid #000; border-top:0px; border-collapse: collapse;font-size:11px;">(W) (LBS.)</th>
                                        <th class="font-normal" style="border-top:0;font-weight: normal;border:1px solid #000; border-top:0px; border-collapse: collapse;font-size:11px;"></th>
                                        <th class="font-normal" style="border-top:0;border-right: 1px solid #333;font-weight: normal;border:1px solid #000; border-top:0px; border-collapse: collapse;font-size:11px;">(M)/100 (LB. IN)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="text-align: center;">
                                        <td style="border:1px solid #000;border-collapse: collapse;text-align:left;text-align:center;font-size:10px;padding-top:3px;padding-bottom:3px;">1</td>
                                        <td style="border:1px solid #000;border-right:0;border-collapse: collapse;text-align:left;font-weight:bold;padding-left:6px;font-size:10px;">Basic Empty Weight</td>
                                        <td style="border:1px solid #000;border-collapse: collapse;text-align:center;font-size:10px;">{{$empty_weight['weight']}}</td>
                         
                                        <td style="border:1px solid #000;border-collapse: collapse;font-size:10px;">{{$empty_weight['arm']}}</td>
                                        <td style="border:1px solid #000;border-collapse: collapse;text-align:center;font-size:10px;">{{sprintf('%.0f',$empty_weight['mom'])}}</td>
                                    </tr>
                                    <tr style="border:1px solid #000;border-collapse: collapse;text-align: center;padding:2px;  ">
                                        <td style="border:1px solid #000;border-collapse:collapse;font-size:10px;padding-top:3px;padding-bottom:3px;">2</td>
                                        <td style="text-align:left;border:1px solid #000;border-collapse;padding-left:6px;font-size:10px;">Pilot</td>
                                        
                                        <td style="border:1px solid #000;border-collapse: collapse;text-align:center;font-size:10px;">{{$pilot_co_pilot['weight']}}</td>
                                        <td style="border:1px solid #000;border-collapse:collapse;font-size:10px;">{{$pilot_co_pilot['arm']}}</td>
                                        <td style="border:1px solid #000;border-collapse:collapse;font-size:10px;">{{sprintf('%.0f',$pilot_co_pilot['mom'])}}</td>
                                    </tr>
                                    <tr style="border:1px solid #000;border-collapse: collapse;text-align: center;font-size:10px;padding:2px;  ">
                                        <td style="border:1px solid #000;border:1px solid #000;border-collapse;font-size:10px;padding-top:3px;padding-bottom:3px;">3</td>
                                        <td style="text-align:left;border:1px solid #000;border-collapse;padding-left:6px;font-size:10px;">Co-Pilot</td>
                                        
                                        <td style="border:1px solid #000;border-collapse: collapse;text-align:center;">{{$pilot_co_pilot['weight']}}</td>
                                        <td style="border:1px solid #000;border:1px solid #000;border-collapse;font-size:10px;">{{$pilot_co_pilot['arm']}}</td>
                                        <td style="border:1px solid #000;border:1px solid #000;border-collapse;font-size:10px;">{{sprintf('%.0f',$pilot_co_pilot['mom'])}}</td>
                                    </tr>
                                     <tr style="border:1px solid #000;border-collapse: collapse;text-align: center;font-size:10px;padding:2px;  ">
                                        <td style="border:1px solid #000;border:1px solid #000;border-collapse;font-size:10px;padding-top:3px;padding-bottom:3px;">4</td>
                                        <td style="text-align:left;border:1px solid #000;border-collapse;padding-left:6px;font-size:10px;">Provision/miscellaneous (max 105 lbs)</td>
                                        
                                        <td style="border:1px solid #000;border-collapse: collapse;text-align:center;"></td>
                                        <td style="border:1px solid #000;border:1px solid #000;border-collapse;font-size:10px;">201</td>
                                        <td style="border:1px solid #000;border:1px solid #000;border-collapse;font-size:10px;"></td>
                                    </tr>
                                    <tr style="border:1px solid #000;border-collapse: collapse;text-align: center; ">
                                        <td style="border:1px solid #000;border:1px solid #000;border-collapse;font-size:10px;padding-top:3px;padding-bottom:3px;">5</td>
                                        <td style="text-align:left;border:1px solid #000;border-collapse;padding-left:5px;font-weight:bold;font-size:10px;">Empty Operating Weight</td>
                                        <td style="border:1px solid #000;border:1px solid #000;border-collapse;font-size:10px;">{{$empty_os['wt']}}</td>
                                        <td style="border:1px solid #000;border:1px solid #000;border-collapse;font-size:10px;"></td>
                                      <td style="border:1px solid #000;border-collapse: collapse;text-align:center;font-size:10px;">{{sprintf('%.0f',$empty_os['mom'])}}</td>
                                    </tr>
                                    <tr style="border:1px solid #000;border-collapse: collapse;text-align: center;padding-left:6px;font-size:10px; ">
                                        <td style="border:1px solid #000;border-collapse;font-size:10px;padding-top:3px;padding-bottom:3px;">6</td>
                                        <td style="text-align:left;border:1px solid #000;border-collapse;font-size:10px;padding-left:6px;">Seat 1 (LH Row 1, Aft Facing)</td>
                                      
                                        <td style="border:1px solid #000;border-collapse;font-size:10px;">@if(array_key_exists("calculate_wt",$paxs[0])) {{$paxs[0]['calculate_wt']}}@endif</td>
                                        <td style="border:1px solid #000;border-collapse">{{$paxs[0]['arm']}}</td>
                                        <td style="border:1px solid #000;border-collapse">@if(array_key_exists("calculate_mom",$paxs[0])) {{sprintf('%.0f',$paxs[0]['calculate_mom'])}} @endif</td>
                                    </tr>
                                    <tr style="border:1px solid #000;border-collapse: collapse;text-align: center;font-size:10px; ">
                                        <td style="border:1px solid #000;border-collapse;padding-top:3px;padding-bottom:3px;">7</td>
                                        <td style="text-align:left;border:1px solid #000;border-collapse;padding-left:6px;">Seat 2 (RH Row 1, Aft Facing)</td>
                                       <td style="border:1px solid #000;border-collapse">@if(array_key_exists("calculate_wt",$paxs[1])) {{$paxs[1]['calculate_wt']}}@endif</td>
                                        <td style="border:1px solid #000;border-collapse">{{$paxs[1]['arm']}}</td>
                                        <td style="border:1px solid #000;border-collapse">@if(array_key_exists("calculate_mom",$paxs[1])) {{sprintf('%.0f',$paxs[1]['calculate_mom'])}}  @endif</td>                                        
                                    </tr>
                                    <tr style="border:1px solid #000;border-collapse: collapse;text-align: center;font-size:10px;">
                                        <td style="border:1px solid #000;border-collapse;padding-top:3px;padding-bottom:3px;">8</td>
                                        <td style="text-align:left;border:1px solid #000;border-collapse;padding-left:6px;">Seat 3 (LH Row 2, Fwd Facing)</td>
                                       <td style="border:1px solid #000;border-collapse">@if(array_key_exists("calculate_wt",$paxs[2])) {{$paxs[2]['calculate_wt']}}@endif</td>
                                        <td style="border:1px solid #000;border-collapse">{{$paxs[2]['arm']}}</td>
                                        <td style="border:1px solid #000;border-collapse">@if(array_key_exists("calculate_mom",$paxs[2])) {{sprintf('%.0f',$paxs[2]['calculate_mom'])}} @endif</td>                                      
                                    </tr>
                                    <tr style="border:1px solid #000;border-collapse: collapse;text-align: center;font-size:10px;">
                                        <td style="border:1px solid #000;border-collapse;padding-top:3px;padding-bottom:3px;">9</td>
                                        <td style="text-align:left;border:1px solid #000;border-collapse;padding-left:6px;">Seat 4 (RH Row 2, Fwd Facing)</td>
                                        <td style="border:1px solid #000;border-collapse">@if(array_key_exists("calculate_wt",$paxs[3])) {{$paxs[3]['calculate_wt']}}@endif</td>
                                        <td style="border:1px solid #000;border-collapse">{{$paxs[3]['arm']}}</td>
                                        <td style="border:1px solid #000;border-collapse">@if(array_key_exists("calculate_mom",$paxs[3])) {{sprintf('%.0f',$paxs[3]['calculate_mom'])}}  @endif</td>                                      
                                    </tr>
                                    <tr style="border:1px solid #000;border-collapse: collapse;text-align: center;font-size:10px; ">
                                        <td style="border:1px solid #000;border-collapse;padding-top:3px;padding-bottom:3px;">10</td>
                                        <td style="text-align:left;border:1px solid #000;border-collapse;padding-left:6px;">Seat 5 (LH Row 3, Fwd Facing)</td>
                                        <td style="border:1px solid #000;border-collapse">@if(array_key_exists("calculate_wt",$paxs[4])) {{$paxs[4]['calculate_wt']}}@endif</td>
                                        <td style="border:1px solid #000;border-collapse">{{$paxs[4]['arm']}}</td>
                                        <td style="border:1px solid #000;border-collapse">@if(array_key_exists("calculate_mom",$paxs[4])) {{sprintf('%.0f',$paxs[4]['calculate_mom'])}}  @endif</td>                                     
                                    </tr>
                                    <tr style="border:1px solid #000;border-collapse: collapse;text-align: center;font-size:10px;">
                                        <td style="border:1px solid #000;border-collapse;padding-top:3px;padding-bottom:3px;">11</td>
                                        <td style="text-align:left;border:1px solid #000;border-collapse;padding-left:6px;">Seat 6 (RH Row 3, Fwd Facing)</td>
                                         <td style="border:1px solid #000;border-collapse">@if(array_key_exists("calculate_wt",$paxs[5])) {{$paxs[5]['calculate_wt']}}@endif</td>
                                        <td style="border:1px solid #000;border-collapse">{{$paxs[5]['arm']}}</td>
                                        <td style="border:1px solid #000;border-collapse">@if(array_key_exists("calculate_mom",$paxs[5])) {{sprintf('%.0f',$paxs[5]['calculate_mom'])}}  @endif</td>
                                    </tr>
                                    <tr style="border:1px solid #000;border-collapse: collapse;text-align: center;font-size:10px;">
                                        <td style="border:1px solid #000;border-collapse;padding-top:3px;padding-bottom:3px;">12</td>
                                        <td style="text-align:left;border:1px solid #000;border-collapse;padding-left:6px;">Baggage (Nose) Max 150 lbs</td>
                                        <td style="border:1px solid #000;border-collapse">{{$baggage_nose['weight']}}</td>
                                        <td style="border:1px solid #000;border-collapse">{{$baggage_nose['arm']}}</td>
                                        <td style="border:1px solid #000;border-collapse">{{sprintf('%.0f',$baggage_nose['mom'])}}</td>
                                    </tr>
                                    <tr style="border:1px solid #000;border-collapse: collapse;text-align: center;font-size:10px; ">
                                        <td style="border:1px solid #000;border-collapse;padding-top:3px;padding-bottom:3px;">13</td>
                                        <td style="text-align:left;border:1px solid #000;border-collapse;padding-left:6px;">Baggage (AFT Cabin) Max 140 lbs</td>
                                        <td style="border:1px solid #000;border-collapse">{{$baggage_aft_cabin['weight']}}</td>
                                        <td style="border:1px solid #000;border-collapse">{{$baggage_aft_cabin['arm']}}</td>
                                        <td style="border:1px solid #000;border-collapse">{{sprintf('%.0f',$baggage_aft_cabin['mom'])}}</td>
                                    </tr>
                                    <tr style="border:1px solid #000;border-collapse: collapse;text-align: center;font-size:10px;">
                                        <td style="border:1px solid #000;border-collapse;padding-top:3px;padding-bottom:3px;">14</td>
                                        <td style="text-align:left;border:1px solid #000;border-collapse;padding-left:6px;">Aft Fuselage Baggage-Forward (Max 200 lbs)</td>
                                
                                        <td style="border:1px solid #000;border-collapse">{{$aft_fuselage_baggage_forward['weight']}}</td>
                                        <td style="border:1px solid #000;border-collapse">{{$aft_fuselage_baggage_forward['arm']}}</td>
                                        <td style="border:1px solid #000;border-collapse">{{sprintf('%.0f',$aft_fuselage_baggage_forward['mom'])}}</td>                                       
                                    </tr>
                                    <tr style="border:1px solid #000;border-collapse: collapse;text-align: center;font-size:10px; ">
                                        <td style="border:1px solid #000;border-collapse;padding-top:3px;padding-bottom:3px;">15</td>
                                        <td style="text-align:left;border:1px solid #000;border-collapse;padding-left:6px;">Aft Fuselage Baggage-Aft (Max 200 lbs)</td>
                                        
                                        <td style="border:1px solid #000;border-collapse">{{$aft_fuselage_baggage_aft['weight']}}</td>
                                        <td style="border:1px solid #000;border-collapse">{{$aft_fuselage_baggage_aft['arm']}}</td>
                                        <td style="border:1px solid #000;border-collapse">{{sprintf('%.0f',$aft_fuselage_baggage_aft['mom'])}}</td>
                                       
                                    </tr>
                                    
                                    <tr style="border:1px solid #000;border-collapse: collapse;text-align: center;font-size:12px; ">
                                        <td style="border:1px solid #000;border-collapse;padding-top:3px;padding-bottom:3px;font-weight:bold;font-size:12px;">16</td>
                                        <td style="text-align:left;border:1px solid #000;border-collapse;padding-left:6px;"><b>Total-Zero Fuel Weight (Not to Exceed 10,000 lbs)</b> 
                                        </td>
                                        <td style="border:1px solid #000;border-collapse;font-weight:bold;">{{$zero_fuel_weight['weight']}}</td>
                                        <td style="border:1px solid #000;border-collapse;font-weight:bold;">{{$zero_fuel_weight['arm']}}</td>
                                        <td style="border:1px solid #000;border-collapse;font-weight:bold;">{{sprintf('%.0f',$zero_fuel_weight['momentum'])}}</td>
                                       
                                    </tr>
                                    <tr style="text-align: center;font-size:12px;">
                                        <td style="vertical-align:top;border:1px solid #000;border-collapse;text-align:center;padding-top:3px;padding-bottom:3px;font-size:12px;">17</td>
                                        <td  style="text-align:left;border:1px solid #000;border-collapse;padding-left:6px;">Fuel (Max usable 3670 lbs)</td>
                                        <td style="border:1px solid #000;border-collapse">{{$take_off_fuel['weight']}}</td>
                                        <td style="border:1px solid #000;border-collapse"></td>
                                        <td style="border:1px solid #000;border-collapse">{{$take_off_fuel['momentum']}}</td>
                                        
                                    </tr>
                                    <tr text-align: center;font-size:12px;">
                                        <td style="border:1px solid #000;border-collapse;text-align:center;font-size:12px;padding-top:3px;padding-bottom:3px;font-weight:bold;">18</td>
                                        <td style="text-align:left;border:1px solid #000;border-collapse;padding-left:6px;font-size:12px;font-weight:bold;">Total Ramp Weight (Not to exceed 12,591 lbs) </td>
                                        <td style="border:1px solid #000;border-collapse:collapse;text-align:center;font-size:12px;font-weight:bold;">{{$ramp_weight['weight']}}</td>
                                        <td style="border:1px solid #000;border-collapse:collapse;text-align:center;font-size:12px;font-weight:bold;"></td>
                                        <td style="border:1px solid #000;border-collapse:collapse;text-align:center;font-size:12px;font-weight:bold;">{{sprintf('%.0f',$ramp_weight['momentum'])}}</td>
                            
                                    
                                    </tr>
                                     <tr style="border:1px solid #000;border-collapse: collapse;text-align: center;font-size:12px;">
                                        <td style="border:1px solid #000;border-collapse;text-align:center;padding-top:3px;padding-bottom:3px;font-size:12px;">19</td>

                                        <td style="text-align:left;border:1px solid #000;border-collapse;padding-left:6px;font-size:12px;"> Less Fuel for takeoff and Taxi (91 Lbs)
                                        </td>
                                        <td style="border:1px solid #000;border-collapse;text-align:center;font-size:12px;">{{$less_fuel_start['weight']}}</td>
                                        <td style="border:1px solid #000;border-collapse;font-size:12px;"></td>
                                        <td style="border:1px solid #000;border-collapse">{{$less_fuel_start['mom']}}</td>
                            
                                    </tr>
                                    <tr style="border:1px solid #000;border-collapse: collapse;text-align: center;font-size:12px;">
                                        <td style="border:1px solid #000;border-collapse;text-align:center;padding-top:3px;padding-bottom:3px;font-weight:bold;font-size:12px;">20</td>

                                        <td style="text-align:left;border:1px solid #000;border-collapse;padding-left:6px;font-size:10px;font-weight:bold;font-size:12px;">Total Take Of Weight (Not to exceed 12,500 lbs)
                                        </td>
                                        <td style="border:1px solid #000;border-collapse;text-align:center;font-size:10px;font-weight:bold;font-size:12px;">{{$total_takeoff_weight['weight']}}</td>
                                        <td style="border:1px solid #000;border-collapse;font-size:10px;font-weight:bold;font-size:12px;">{{$total_takeoff_weight['arm']}}</td>
                                        <td style="border:1px solid #000;border-collapse;font-weight:bold;font-size:12px;">{{sprintf('%.0f',$total_takeoff_weight['momentum'])}}</td>
                            
                                    </tr>
                                    <tr style="border:1px solid #000;border-collapse: collapse;text-align: center;font-size:12px;">
                                        <td style="border:1px solid #000;border-collapse:collapse;text-align:center;padding-top:5px;padding-bottom:5px;">21</td>
                                        <td class="font-bold" style="text-align:left;border:1px solid #000;border-collapse;padding-left:6px;">Total Anticipated Fuel Remaining at Landing (refer Fuel Mom.Table)
                                            </td>
                                        <td style="border:1px solid #000;border-collapse">{{$remaining_fuel['weight']}}</td>
                                        <td style="border:1px solid #000;border-collapse"></td>
                                        <td style="border:1px solid #000;border-collapse">{{$remaining_fuel['momentum']}}</td>
                                        
                                    </tr>
                                    
                                    <tr style="border:1px solid #000;border-collapse: collapse;text-align: center;font-size:12px;">
                                        <td style="border:1px solid #000;border-collapse:collapse;text-align:center;padding-top:3px;padding-bottom:3px;font-weight:bold;font-size:12px;">22</td>
                                        <td class="font-bold" style="font-weight: bold;text-align:left;border:1px solid #000;border-collapse;padding-left:6px;">Total Landing Weight (Not to Exceed 11,600 lbs)
                                            </td>
                                        <td style="border:1px solid #000;border-collapse;font-weight:bold;">{{$total_landing_weight['weight']}}</td>
                                        <td style="border:1px solid #000;border-collapse;font-weight:bold;">{{$total_landing_weight['arm']}}</td>
                                        <td style="border:1px solid #000;border-collapse;font-weight:bold;">{{round($total_landing_weight['momentum'])}}</td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                    <div style="width:45%;top:550px;left:855px;position:absolute;">
                                   
                                   <table border="1" style="border:1px solid #000;border-collapse:collapse;height:90px;font-size:11px;padding:10px;" >
                                       <tbody>
                                       <tr>
                                       <td rowspan="2" style="font-size:10px;border-left:0;border-right:0;border-collapse:collapse;padding-left:10px;padding:5px;font-weight:bold;">NOTE:</td>
                                       
                                       <td style="font-size:12px;text-align:justify;color:#000;border-bottom:0;border-left:1px solid #000;padding-top:10px;padding-bottom:10px;">
                                       <span style="padding-left:3px;">1.</span><span style="padding-left:10px;">Pilot in Command to brief the passenger occupying RH Forward Facing Seat which</span> <p style="margin:0px;padding-left:23px;padding-top:5px;">is next to the emergency exit about opening procedure of over wing exit.</p>
                                         
                                       </td>
                                       </tr>
                                       <tr>
                                       <td style="font-size:11px;text-align:justify;color:#000;border-top:0;border-left:1px solid #000;padding:5px;padding-bottom:10px;">
                                       
                                      <span style="padding-left:3px;"> 2.</span> <sapn style="padding-left:8px;">Standard Weight for passenger as per CAR Section 2, Series X,  Part II are as follows:</span><p style="margin:0px;padding-left:22px;padding-top:5px;padding-bottom:5px;">Adult Passenger (both Male and Female 165 lbs (75 Kg). Child Between 2 and 12 years</p> <p style="margin:0px;padding-left:22px;">age 77 lbs (35 kg ) and infant (Less than
                                           two years) 22 lbs (10 kg).</p>
                                       
                                       
                                       </td>
                                       </tr>
                                       
                                       </tbody>
                                   </table>
                               </div>
                               </div>

                       <div  style="clear:both;font-size:9px;width:57%;margin-top:0px;margin-left:125px">
                       <p style="font-weight:bold;color:#000;padding-top:10px;"><span>Note:Allowable Fwd C.G. up to 12,500 lbs=294,37, AFT C.G up to 10,000 lbs=303.97 inch,Aft C.G. up to 12,500 lbs=30014 inch</span>
                        <span style="position:absolute;top:-80px;left:910px;">
                          <img src="https://www.eflight.aero/media/images/loadtrim/vtssf/sign29_trans.png" style="height:100px">
                       </span>
                       </p>
                       <p>C.G of Flight in Inches=Total Moment/Total Weight x 100</p>
                       <p style="margin:0px;">The CG has been calculated as per Page No:6-14, SEC-6 of AFM dated 02-April-2008</p>
                       <p style="margin:0px;margin-bottom:20px;">The Aircraft has been loaded as per CG envelope on Page No:6-16, SEC-6 of AFM dated 02-april-2008</p>
                       <p style="padding-left:390px;">Signature</p>
                       <p style="margin-bottom:50px;">
                       <span>Date:</span><span style="padding-left:365px;">License No.</span>
                       </p>
                       <p><span>Approved vide DDG,Mumbai,Letter No. A7/SSF/1705/90 </span><span style="padding-left:105px;">Dated 11/10/17</span><span style="position:absolute;top:595px;left:660px;"><img src="https://www.eflight.aero/media/images/loadtrim/vtssf/vtssf_sign2.png" style="width:140px;height:110px;"></span>
                       <span style="position:absolute;top:692px;left:640px;"><img src="https://www.eflight.aero/media/images/loadtrim/vtssf/vtssf_capt.png" style="width:220px;height:auto;"></span>
                       </p>              
                    </div>`,

                        useHTML: true,
                        y: 200,
                        align: 'center',
                        x: -100,
                    },
                    subtitle: {
                    },
                    margin: 0,
                    chart: {
        
                        sourceWidth: 1380,
                        sourceHeight: 1060,
                        spacingBottom:400,
                        spacingRight:105,
                        marginTop:215,
                        marginLeft:853,
                        events: {
                        load: function () {
                        this.renderer.image('https://www.eflight.aero/media/images/loadtrim/vtssf/sai6.png', '780', '170',545,550)
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
                        radius: 3
                    },
                     data: [landing_data],
                    dataLabels: {
                        enabled: false,
                        formatter: function () {
                        return  'LAND C.G. ('+parseFloat(this.key).toFixed(1) + '/' + Math.round(this.y) + ')';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '15px', fontWeight: 'bold'}
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
                        radius: 3
                    },
                     data: [landing_data_graph],
                    dataLabels: {
                        enabled: true,
                        formatter: function () {
                return  'LAND C.G. ('+parseFloat(this.key).toFixed(1) + '/' + Math.round(this.y+300) + ')';
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
                        enabled: true,
                        "symbol": "circle",
                        radius: 3
                    },
                      data: [take_off_data],
                    dataLabels: {
                         enabled: false,
                        formatter: function () { 
                return   'T.OFF C.G. ('+parseFloat(this.key).toFixed(1) + ' / ' + Math.round(this.y) + ')';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '15px', fontWeight: 'bold'},

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
                        radius: 3
                    },
                      data: [take_off_data_graph],
                    dataLabels: {
                         enabled: true,
                        formatter: function () { 
                return   'T.OFF C.G. ('+parseFloat(this.key).toFixed(1) + '/' + Math.round(this.y+300) + ')';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '9px', fontWeight: 'bold'},

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
                        radius: 3
                    },
                      data: [zero_fuel_weight_graph],
                    dataLabels: {
                        enabled: true,
                        formatter: function () {
                            
                          return   'ZFW C.G. ('+parseFloat(this.key).toFixed(1) + '/' + Math.round(this.y+300) + ')';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '9px', fontWeight: 'bold'},

                    }
                },
                 {
                    showInLegend: false,
                    name: 'ZFW',
                    type: 'scatter',
                    color: take_off_fuel_color,
                    "marker": {
                        "symbol": "square",
                        radius: 3
                    },
                      data: [zero_fuel_weight],
                    dataLabels: {
                        enabled: false,
                        formatter: function () {
                            
                          return   'ZFW C.G. ('+parseFloat(this.key).toFixed(1) + '/' + Math.round(this.y) + ')';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '5px', fontWeight: 'bold'},

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
                marginTop: 67,
                marginLeft: 223,
                spacingRight:254,
                spacingBottom: 98,
                events: {
                    load: function () {
                        this.renderer.image('https://www.eflight.aero/media/images/loadtrim/vtssf/sai6.png', '142', '5', 600, 782)
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
               // lineColor: 'red',
                min: 290.00,
                max: 306.00,
                tickInterval: 2,
                tickPositions: [290.00,292.00,294.00,296.00,298.00,300.00,302.00,304.00,306.00],
                tickPosition: 'inside',
                tickLength: 2,
                // tickColor:'blue',
                tickWidth:2,
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
                 tickLength: 2,
                 tickWidth:2,
                // tickColor:'blue',
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
                        enabled: false,
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
                         enabled: false,
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
                        "symbol": "square",
                        radius: 4
                    },
                      data: [zero_fuel_weight1],
                    dataLabels: {
                        enabled: false,
                        formatter: function () {
                            
                          return   'ZFW C.G. ('+parseFloat(this.key).toFixed(1) + ' / ' + Math.round(this.y+150) + ')';
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
            var graph_name = 'LOAD TRIM VTSSF' + ' '+departure_aerodrome + ' ' + destination_aerodrome + ' ' + date_of_flight;
            if ($(this).hasClass('disabled')) {
                e.preventDefault();
                return false;
            }

            chart.exportChart({
                type: 'application/pdf',
                filename: graph_name,
                sourceWidth: 1370,
                sourceHeight: 1060,
                 marginTop: 0,
                 spacingTop:300,

                events: {
                    load: function () {
                                 this.renderer.image('https://www.eflight.aero/media/images/loadtrim/vtssf/sai6.png', '900', '200', 575,490)
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