@extends('layouts.check_quick_loadtrim_layout',array('1'=>'1'))
@push('css')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://www.highcharts.com/samples/static/highslide-full.min.js"></script>
<script src="https://www.highcharts.com/samples/static/highslide.config.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="https://www.highcharts.com/samples/static/highslide.css" />
@endpush  
@section('content')
<div class="page" id="quick_app">
<style>
.tooltip-download {
visibility: hidden;
position: absolute;
background: #333;
color: #fff;
top: -27px;
right: -42px;
padding: 3px;
font-size: 10px;
border-radius: 3px;
cursor: default;
text-transform: uppercase;
width: 100px;
z-index: 10000;
}
.new_fpl_heading,.search_heading {margin-bottom:20px;text-align: center;padding: 7px 0;font-weight: 600;font-size: 15px;color:#fff;
font-family:'pt_sansregular', sans-serif;background: #a6a6a6;
background: -moz-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
background: -webkit-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
background: -o-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
background: -ms-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6a6a6', endColorstr='#a6a6a6', GradientType=1 );
}
.search_heading {margin-bottom: 30px;text-transform: uppercase;}
.fpl_search_from_label, .fpl_search_to_label {position: absolute;top:-20px;left:26%;font-size: 13px;color:#222;}
.form-row .deskprocess {width: 43%;}
.form-row .form-search-row-right .ui-datepicker-trigger {height: 21px;top:6px;}
.from_dp_pos .ui-datepicker-trigger {right: 9px;height: 23.5px;top: 5px;}
.form-row .deskview .ui-datepicker-trigger {right: 10px;height: 21px;top: 6px;}
#date_of_flight {font-size: 13px; font-weight: normal;color: #222;background: white;text-align:left;padding-left:5px;border-radius:4px;}
.from_dp_pos {width: 100%;}
#from_date {text-align: left;font-size: 13px;font-weight: normal;color: #222;}
#to_date {padding-left: 5px;font-size:13px;font-weight: normal;color: #222;text-align: left;width: 137%;border-radius: 5px;}
/*model open padding right*/
.test[style] {
padding-right:0;
}
.test.modal-open {
overflow: auto;
}
/*model open padding right*/
.form-row .deskview {
width: 100%;
}
.notify-bg-v{
background:rgba(0,0,0,.4) !important;
position: absolute;
width: 100%;
display:block;
z-index:9000;
display: none;
}
.form-control[readonly] {
background-color: #fff !important;
opacity: 1;
}
.popover {
background-color: #333;
border:none!important;
font-family: 'pt_sansregular';
color: white;
}
.popover.top>.arrow:after{
border-top-color:#333;
}
.popover-content{
padding:2px;
}
.copy-row{
padding:0;   
}
.ltrim_sec div.dynamiclabel label{
position: absolute;
font-size:10px;
color:#555;
font-weight:normal;      
top: 31px;
left:15px;          
-moz-transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
-webkit-transition: all 0.6s ease-in-out;
-o-transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
opacity: 0;
z-index: -1;
line-height: 0px;
white-space: nowrap;
font-style: italic;
}
.ltrim_sec div.dynamiclabel > *:not(:placeholder-shown) + label{
opacity: 1;
z-index:1;
top:40px;
left:18px;
text-transform: uppercase;
font-style: italic;
}
.ltrim_sec div.dynamiclabel > *:focus + label{
opacity: 1;
z-index:100;
top:40px;
left:18px;
text-transform: uppercase;
font-style: italic;
}
.ltrim_sec div.dynamiclabel > *:focus{
border-color:#f1292b ;
outline: none;
}
.ltrim_sec div.dynamiclabel [placeholder]::-webkit-input-placeholder {
transition: opacity 0.4s 0.4s ease;
}
.flightdate_lable{
position: absolute;
font-size: 10px;
color: #555;
font-weight: normal;
transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
white-space: nowrap;
top:31px;
left:3px;
font-style:italic;  
}
.ui-datepicker-trigger{
height: 24px;
top: 5px;
right:22px;
}
/*#Div1{
margin-left: 120px;
}*/
table {
border-collapse: collapse;
width: 100%;
}
td, th {
border: 1px solid #000;
text-align: left;
padding:4px;
}
.center{
text-align:center;
}
.font_weight{
font-weight:bold;
}
.left{
text-align:left;
}
.right{
text-align:right;   
}
.border_right0{
border-right: 0!important;
}
.border_left0{
border-left: 0!important;
}
.border_top0{
border-top:0!important;
}
.border_bottom0{
border-bottom:0!important;
}
.border0{
border:none;
}
.fontsize14{
font-size:14px;
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
margin-right: 30px;
margin-top: 10px;
}
.graph_container {
width: 900px;
padding-left: 0;
border: none;
box-shadow: 0 3px 3px 1px #999999;
margin-bottom: 15px;
padding: 15px 0;
background: #fff;
}
.Airport_Authority_icon {
display: block;
margin-left: auto;
margin-right: auto;
}
.container{
width:800px;
margin:0 auto;
}
.fontsize12{
font-size:12px;
}
.noBorder{
border:0;
}
#Div1{
margin-left: 33px;
}
/*dropdown hover effect*/
.ui-menu .ui-menu-item:hover{
background:-webkit-gradient(linear, left top, left bottom, from(#f37858 ), to(#f1292b ))!important;
color:#fff;
}
.ui-menu .ui-menu-item{
background:#fff;
color:#000;
border-bottom:0;
border-top:0;
font-size:13px;
}
/*dropdown hover effect*/
.ui-menu{
width:12.5%!important;
}
@media screen and (min-width:1281px) and (max-width:1367px) {
  .ui-menu{
  width:11.5%!important;
  }
}
</style>
<div class="notify-bg-v"></div>
@include('includes.new_header',[])
    <main>
        <div class="container" style="width:425px;">
            <div class="bg-white">
                <div class="fpl_sec">
                <form method="POST" action="{{url('loadtrim/vtfiu')}}" id="add_vtfiu">
                     {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <p class="new_fpl_heading">VTFIU</p>
                        </div>
                        <input type="hidden" name="callsign" id="callsign" value="vtfiu">
                        <div class="col-md-12" style="padding-left: 35px;padding-right: 35px;">
                            <div class="col-sm-6 ltrim_sec" style="padding-right: 5px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" data-toggle="popover" data-placement="top" maxlength="4" autocomplete="off" class="alpha_numeric text-center font-bold text_uppercase form-control modtooltip alphabets"  placeholder="FROM" id="from" name="from" tabindex="1" value="{{$from}}">
                                    <label>FROM</label>
                                </div>
                            </div>
                            <div class="col-sm-6 ltrim_sec" style="padding-left:5px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" data-toggle="popover" data-placement="top" maxlength="4" autocomplete="off" class="alpha_numeric text-center font-bold text_uppercase form-control modtooltip alphabets"  placeholder="TO" id="to" name="to" tabindex="1" value="{{$to}}">
                                    <label style="left:8px;">TO</label>
                                </div>
                            </div>
                        </div> <!--col-md-12 close here-->
                        <div class="col-md-12" style="padding-left: 35px;padding-right: 35px;">
                            <div class="col-sm-6 ltrim_sec" style="padding-right: 5px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" data-toggle="popover" data-placement="top" maxlength="3" autocomplete="off" class="alpha_numeric text-center font-bold text_uppercase form-control modtooltip numbers"  placeholder="Front Baggage" id="cargo" name="cargo" tabindex="1" value="{{$cargo['weight']}}">
                                    <label>Baggage</label>
                                </div>
                            </div>
                             <div class="col-sm-6 ltrim_sec" style="padding-left:5px;padding-right:15px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" autocomplete="off" value="{{$date}}" readonly='readonly' style="background: #eee; text-align:center;border-radius:4px;cursor:pointer;" class="form-control font-bold dateofflight_vtbsl" placeholder="Date of Flight" name="date" id="flight_date" data-toggle="popover" data-placement="top">
                                    <label style="left:5px;" class="flightdate_lable" id="flight_date_lbl">DATE OF FLIGHT</label>
                                </div>
                            </div>
                          
                        </div><!--col-md-12 close here-->
                        <div class="col-md-12" style="padding-left: 35px;padding-right: 35px;">
                            <div class="col-sm-6 ltrim_sec" style="padding-right: 5px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" data-toggle="popover" data-placement="top" maxlength="25" autocomplete="off" class="alphabets_with_space  text-center font-bold text_uppercase form-control modtooltip"  placeholder="pilot name" id="pilot" name="pilot" tabindex="1" value="{{$pilot}}">
                                    <label>pilot name</label>
                                </div>
                            </div>
                            <div class="col-sm-6 ltrim_sec" style="padding-left:5px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" data-toggle="popover" data-placement="top" maxlength="25" autocomplete="off" class="alphabets_with_space text-center font-bold text_uppercase form-control modtooltip blur"  placeholder="Co pilot name" id="co_pilot" name="co_pilot" tabindex="1" value="{{$co_pilot}}">
                                    <label style="left:10px;">Co pilot name</label>
                                </div>
                            </div>
                        </div><!--col-md-12 close here-->
                        <div class="col-md-12" style="padding-left: 35px;padding-right: 35px;">
                            <div class="col-sm-6 ltrim_sec" style="padding-right: 5px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" data-toggle="popover" data-placement="top" maxlength="4" autocomplete="off" class="text-center font-bold text_uppercase form-control modtooltip numbers"  placeholder="Total Fuel" id="take_off_fuel" name="take_off_fuel" tabindex="1"  @if($fuel_loading !="") value="{{$fuel_loading['weight']}}" @endif>
                                    <label>Total Fuel</label>
                                </div>
                            </div>
                            <div class="col-sm-6 ltrim_sec" style="padding-left:5px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" data-toggle="popover" data-placement="top" maxlength="4" autocomplete="off" class="numbers  text-center font-bold text_uppercase form-control modtooltip"  placeholder="TRIP FUEL" id="landing_fuel" name="landing_fuel" tabindex="1"  @if($landing_fuel !="") value="{{$landing_fuel['weight']}}" @endif>
                                    <label style="left:10px;">Remaining FUEL</label>
                                </div>
                            </div>
                        </div><!--col-md-12 close here-->
                         <div class="col-md-12" style="margin-left:5px;margin-bottom:15px;padding-right:5px;">
                           
                        </div> 
                        <div class="col-md-12" style="margin-left:28px;margin-bottom:15px;">
                            <div class="form-group dynamiclabel" style="font-size: 13px;line-height: 1;">
                                <div class="col-md-4 p-r-0"><input id="pax1" type="checkbox" name="pax[0]" value="75"
                                @if($pax!='') @if($pax[0]['weight']!=0)  checked  @endif @endif  ><label for="pax1">PAX 1</label></div>
                                <div class="col-md-4 p-r-0"><input id="pax2" type="checkbox" name="pax[1]" value="75" @if($pax!='') @if($pax[1]['weight']!=0)  checked  @endif @endif ><label for="pax2">PAX 2</label></div>
                                <div class="col-md-4 p-r-0"><input id="pax3" type="checkbox" name="pax[2]" value="75"
                                @if($pax!='') @if($pax[2]['weight']!=0)  checked  @endif @endif><label for="pax3">PAX 3</label></div>
                                <div class="col-md-4 p-r-0"><input id="pax4" type="checkbox" name="pax[3]" value="75"
                                @if($pax!='') @if($pax[3]['weight']!=0)  checked  @endif @endif><label for="pax4">PAX 4</label></div>
                            </div>
                        </div>
                        <div class="col-md-12" style="text-align:center;">
                            <div class="download_img download-parent" style="margin-top:5px;float:left;margin-left:30%;margin-right:7%;">
                                 <a id="graph_pdf" href="javascript:void(0)"> <img src="{{url('media/images/download-all.png')}}"></a>
                                 <span class="tooltip-download">Download PDF</span>
                             </div>
                             <div><button class="btn newbtnv1" id="" style="line-height:1;width:24%;float:left;margin-right:5%;" type="submit" name="">SUBMIT</button></div>
                             <div class="download_img download-parent" style="margin-top:5px;float:left;">
                                 <a id="graph_print" href="javascript:void(0)"> <img src="{{url('media/images/download-all.png')}}"></a>
                                 <span class="tooltip-download">Download Graph</span>
                             </div>
                        </div>
                    </div>
                   </form>
                  </div>
                </div>
            </div><!--first close here-->
<div style="width:800px;background:#fff;margin:0 auto;margin-bottom:15px;box-shadow: 0 3px 3px 1px #999999;padding-left:30px;padding-right:30px;padding-top:30px;">
<table>
 <tr>
    <th style="padding:0;" class="center fontsize14"><img src="{{url('media/images/loadtrim/vtfiu/vtfiu.png')}}"/></th>
    <th colspan="3" style="font-size:18px;" class="center font_weight border_right0">LOAD & TRIM SHEET</th>
    <th class="center fontsize14 border_left0"><img src="{{url('media/images/loadtrim/vtfiu/b.PNG')}}"/></th>
</tr>
<tr>
    <td class="left fontsize14 border_right0 border_bottom0">SUPER KING AIR <span class="font_weight">B300</span></td>
    <td colspan="2" class="center border_right0 fontsize14 border_left0 border_bottom0">AIRCRAFT REGISTRATION: <span class="font_weight">VT-FIU</span></td>
    <td colspan="2" class="right fontsize14 border_left0 border_bottom0">AIRCRAFT SERIAL NO: <span class="font_weight">FL -478</span></td>
</tr>
</table>
 <table>
	  <tr>
  	   <th class="center">S/N</th>
  	   <th class="left">DESCRIPTION</th>
  	   <th class="center">WEIGHT (Kgs)</th>
  	   <th class="center">F.S. (in)</th>
  	   <th class="center">MOM/100 (kg-in)</th>
	  </tr>
	  <tr>
  	   <td class="center">1</td>
  	   <td class="left">Basic Empty Weight</td>
  	   <td class="center">{{$empty_weight['weight']}}</td>
  	   <td class="center">{{$empty_weight['arm']}}</td>
  	   <td class="center">{{$empty_weight['mom']}}</td>
	  </tr>
	  <tr>
  	   <td class="center">2</td>
  	   <td class="left">Pilot Seat</td>
  	   <td class="center">{{$pilot_co_pilot['weight']}}</td>
  	   <td class="center">{{$pilot_co_pilot['arm']}}</td>
  	   <td class="center">{{$pilot_co_pilot['mom']}}</td>
	  </tr>
	  <tr>
	     <td class="center">3</td>
	     <td class="left">Co-Pilot Seat</td>
	     <td class="center">{{$pilot_co_pilot['weight']}}</td>
	     <td class="center">{{$pilot_co_pilot['arm']}}</td>
	     <td class="center">{{$pilot_co_pilot['mom']}}</td>
	  </tr>
	  <tr>
	   <td class="center">4</td>
	   <td class="left">Passenger Seat 1 (cabin seat RH aft facing)</td>
	   <td class="center">@if($pax[0]['weight']!=0){{$pax[0]['weight']}} @endif</td>
	   <td class="center">@if($pax[0]['arm']!=0){{$pax[0]['arm']}} @endif</td>
	   <td class="center">@if($pax[0]['mom']!=0){{$pax[0]['mom']}} @endif</td>
	  </tr>
	  <tr>
	   <td class="center">5</td>
	   <td class="left">Passenger Seat 2 (cabin center seat LH fwd facing)</td>
	   <td class="center">@if($pax[1]['weight']!=0){{$pax[1]['weight']}} @endif</td>
     <td class="center">@if($pax[1]['arm']!=0){{$pax[1]['arm']}} @endif</td>
     <td class="center">@if($pax[1]['mom']!=0){{$pax[1]['mom']}} @endif</td>
	  </tr>
	  <tr>
	   <td class="center">6</td>
	   <td class="left">Passenger Seat 3 (cabin center seat RH fwd facing)</td>
	   <td class="center">@if($pax[2]['weight']!=0){{$pax[2]['weight']}} @endif</td>
     <td class="center">@if($pax[2]['arm']!=0){{$pax[2]['arm']}} @endif</td>
     <td class="center">@if($pax[2]['mom']!=0){{$pax[2]['mom']}} @endif</td>
	  </tr>
	  <tr>
	   <td class="center">7</td>
	   <td class="left">Passenger Seat 4 (cabin seat LH fwd facing)</td>
	   <td class="center">@if($pax[3]['weight']!=0){{$pax[3]['weight']}} @endif</td>
	   <td class="center">@if($pax[3]['arm']!=0){{$pax[3]['arm']}} @endif</td>
	   <td class="center">@if($pax[3]['mom']!=0){{$pax[3]['mom']}} @endif</td>
	  </tr>
	  <tr>
	   <td class="center">8</td>
	   <td class="left">Total Cabinet Content</td>
	   <td class="center"></td>
	   <td class="center">------</td>
	   <td class="center"></td>
	  </tr>
	  <tr>
	   <td class="center">9</td>
	   <td class="left">Baggage (Max. 181.44 Kgs)</td>
	   <td class="center">{{$cargo['weight']}}</td>
	   <td class="center">{{$cargo['arm']}}</td>
	   <td class="center">{{$cargo['mom']}}</td>
	  </tr>
	  <tr>
	   <td class="center">10</td>
	   <td>
	      <table>
		  <tr>
		  <th class="border0" style="padding:0px;">Subtotal - Zero Fuel Weight</th>
		  <th class="border0 right" style="padding:0px;">DO</th>
		  </tr>
		  <tr>
		  <th colspan="2" class="border0" style="padding-top: 10px;padding-right: 0;padding-left: 0;padding-bottom: 0;">NOT EXCEED 12,500 LBS (5,670 KGS)</th>
		  </tr>
		</table>
	   </td>
	   <td class="center font_weight">{{$zfw['weight']}}</td>
	   <td class="center font_weight">{{$zfw['arm']}}</td>
	   <td class="center font_weight">{{$zfw['mom']}}</td>
	  </tr>
	  <tr>
	   <td class="center">11</td>
	   <td class="left font_weight">Fuel (Max 1638 Kgs/ 3611 Lbs)<span style="font-weight:normal;padding-left:104px;">0 lbs</span></td>
	   <td class="center font_weight">{{$fuel_loading['weight']}}</td>
	   <td class="center font_weight"></td>
	   <td class="center font_weight">{{$fuel_loading['mom']}}</td>
	  </tr>
	  <tr>
	   <td class="center">12</td>
	   <td>
	      <table>
		  <tr>
		  <th class="border0" style="padding:0px;">Subtotal - Ramp Weight</th>
		  <th class="border0 right" style="padding:0px;">DO</th>
		  </tr>
		  <tr>
		  <th colspan="2" class="border0" style="padding-top: 10px;padding-right: 0;padding-left: 0;padding-bottom: 0;">NOT EXCEED 15,100 LBS (6,849 KGS)</th>
		  </tr>
		</table>
	   </td>
	   <td class="center font_weight">{{$ramp_weight['weight']}}</td>
	   <td class="center font_weight">{{$ramp_weight['arm']}}</td>
	   <td class="center font_weight">{{$ramp_weight['mom']}}</td>
	  </tr>
	  <tr>
	   <td class="center">13</td>
	   <td class="left font_weight">Less Fuel for Start, Taxi and Take off**</td>
	   <td class="center font_weight">{{$lessfuel_taxing['weight']}}</td>
	   <td class="center"></td>
	   <td class="center font_weight">{{$lessfuel_taxing['mom']}}</td>
	  </tr>
	  <tr>
	   <td class="center">14</td>
	   <td>
	      <table>
		  <tr>
		  <th class="border0" style="padding:0px;">Total Take-Off Weight</th>
		  <th class="border0 right" style="padding:0px;">DO</th>
		  </tr>
		  <tr>
		  <th colspan="2" class="border0" style="padding-top: 10px;padding-right: 0;padding-left: 0;padding-bottom: 0;">NOT EXCEED 15,000 LBS (6,804 KGS)</th>
		  </tr>
		</table>
	   </td>
	   <td class="center font_weight">{{$tow['weight']}}</td>
	   <td class="center font_weight">{{$tow['arm']}}</td>
	   <td class="center font_weight">{{$tow['mom']}}</td>
	  </tr>
	  <tr>
	   <td class="center"></td>
	   <td class="left font_weight"><span style="padding-left:50px;">C.G Computation =</span> <span style="border-bottom:1px solid #000;">Total Moment</span> X 100<br><span style="padding-left:203px;">Total Weight</span></td>
	   <td colspan="3" class="center"></td>
	  </tr>
	  <tr>
	   <td colspan="5">*Enter units based kg and kg-in</td>
	  </tr>
	  <tr>
	   <td colspan="5">**Fuel for start, taxi and take-off is normally 100 lbs (45 kg) at an average moment/100 off 227 lb.in (103 kg.in)</td>
	  </tr>
	  <tr>
	   <td colspan="5" class="center font_weight">LANDING WEIGHT DETERMINATION</td>
	  </tr>
	  <tr>
	   <td class="center">15</td>
	   <td class="left">Fuel Loading From Line 11</td>
	   <td class="center">{{$fuel_loading['weight']}}</td>
	   <td class="center"></td>
	   <td class="center"></td>
	  </tr>
	  <tr>
	   <td class="center">16</td>
	   <td class="left">Less Fuel Used To Destination (including fuel for start,<br>taxi and take-off)</td>
	   <td class="center"></td>
	   <td class="center"></td>
	   <td class="center"></td>
	  </tr>
	  <tr>
	   <td class="center">17</td>
	   <td class="left">Total Fuel Remaining (Moment/100 from Usable Fuel<br>Weight and Moment Table)</td>
	   <td class="center">{{$landing_fuel['weight']}}</td>
	   <td class="center"></td>
	   <td class="center">{{$landing_fuel['mom']}}</td>
	  </tr>
	  <tr>
	   <td class="center">18</td>
	   <td class="left">Zero Fuel Weight from Line 10</td>
	   <td class="center">{{$zfw['weight']}}</td>
	   <td class="center"></td>
	   <td class="center">{{$ramp_weight['mom']}}</td>
	  </tr>
	  <tr>
	   <td class="center">19</td>
	   <td class="left font_weight">Total Landing Weight (17 + 18)</td>
	   <td class="center font_weight">{{$landing['weight']}}</td>
	   <td class="center font_weight">{{$landing['arm']}}</td>
	   <td class="center font_weight">{{$landing['mom']}}</td>
	  </tr>
	  <tr>
	   <td colspan="5" class="center border_left0 border_right0">Note: Shaded areas in the above tables indicate values that are not required to arrive at final weight and balance</td>
	  </tr>
	  <tr>
	   <td colspan="5" class="center font_weight">CENTER OF GRAVITY LIMITS</td>
	  </tr>
	  <tr>
	   <td colspan="5">AFT LIMIT: 208.0 inches (5283 mm) at of the datum at all weights</td>
	  </tr>
	  <tr>
	   <td colspan="5">FORWARD LIMITS: 191.4 Inches (4861 mm) aft of the datum at 11,800 pounds (5352 kg) or less, with straight line<br>variation to 199.4 Inches (5064 mm) aft of the datum at 15,000 pounds (6804 kg).</td>
	  </tr>
	  <tr>
	   <td colspan="5">DATUM: The reference datum is located 83.5 Inches (2121 mm) forward of the center of the front jack point.</td>
	  </tr>
	  <tr>
	   <td colspan="5" class="center font_weight">CENTER OF GRAVITY LIMITS (LANDING GEAR DOWN)</td>
	  </tr>
	  <tr>
	   <td colspan="2" class="center font_weight">WEIGHT CONDITION</td>
	   <td colspan="2" class="center font_weight">FORWARD C.G LIMIT (IN)</td>
	   <td class="center font_weight">AFT C.G LIMIT (IN)</td>
	  </tr>
	  <tr>
	   <td colspan="2" class="left">15,000 LB (6804 KG) (MAXIMUM TAKE OFF OR LANDING)</td>
	   <td colspan="2" class="center">199.4</td>
	   <td class="center">208.0</td>
	  </tr>
	  <tr>
	   <td colspan="2" class="left">11,800 LB (5352 KG) OR LESS</td>
	   <td colspan="2" class="center">191.4</td>
	   <td class="center">208.0</td>
	  </tr>
	  <tr>
	   <td colspan="5">I certify that the aircraft has been satisfactorily loaded as per Airplane Flight Manual.</td>
	  </tr>
	  <tr>
	  <td colspan="2" class="border_right0">
	    <table>
		 <tr>
		   <td class="border0" style="width:55%;padding-right:0;padding-left:0;"><span>Signature of Pilot-in-command:</span></td>
		   <td style="width: 52%;" class="border_left0 border_right0 border_top0"><span class="font_weight">{{$pilot}}</span></td>
		   <td class="border0"></td>
		 </tr>
		</table>
	  </td>
	   <td colspan="3" class="">
	    <table>
		 <tr>
		   <td class="border0" style="width:51%;padding-right:0;padding-left:0;"><span>License No. CPL/ATPL:</span></td>
		   <td style="width:30%;" class="border_left0 border_right0 border_top0"><span class="font_weight">{{$co_pilot}}</span></td>
		   <td class="border0"></td>
		 </tr>
		</table>
	  </td>
	  </tr>
	  <tr>
	   <td colspan="2">Sector:<span class="font_weight">{{$from}}</span>-<span class="font_weight">{{$to}}</span></td>
	   <td colspan="3">Date: <span class="font_weight">{{$date}}</span></td>
	  </tr>
    </table>
	<table style="margin-top:20px;">
	<tr>
	 <td class="border0" colspan="4">Conversion Factors Used:</td>
	</tr>
	<tr>
	 <td class="border0">1 kg = 2.2046 lb</td>
	 <td class="border0">1 inch = 2.54 cm</td>
	 <td class="border0">1 Gallon = 3.785412 It</td>
	 <td class="border0">Fuel specific gravity = 0.803 kg/It</td>
	</tr>
	<tr>
	 <td colspan="3" class="font_weight border0">Approved by Dy. DGCA (NR) vide letter No. A7/FIU/1569</td>
	 <td class="border0 font_weight">Dated: 11-08-2017</td>
	</tr>
	<tr>
	 <td style="padding-bottom:20px;"colspan="4" class="border0">FLIGHT INSPECTION UNIT, AIRPORT AUTHORITY OF INDIA, SAFDARJUNG AIRPORT, NEW DELHI 110003</td>
	</tr>
	</table>
</div>
</main>
<div class="container graph_container" style="margin-bottom:15px;">
    <div class="row">
        <div class="col-sm-8 col-md-12">
            <div id="Div1"></div>                      
        </div>
    </div>
</div> 
@include('includes.new_footer',[])
<script>
     $("#graph_pdf").click(function(){
          var url = "<?php echo URL::to('/'); ?>";
                     window.location = url + "/ltrimpdf/vtfiu";   
     });
    $(document).ready(function () {
        $("#flight_date,.ui-datepicker-trigger").click(function () {
            console.log("hii");
            $(".notify-bg-v").fadeIn();
            $('.notify-bg-v').css('height',0);
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
    $(document).on("keyup","#from",function(e){  
        if($(this).val().length>=4){ 
        closePopover("#"+$(this).attr('id'));
        $("#to").focus();
        }
    });
    $(document).on("keypress",".alphabets_with_space",function(e){
         if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode==0)|| (e.charCode==32))
         return true;
         else
         return false; 
         });
    $(document).on("keyup","#to",function(e){  
        if($(this).val().length>=4){ 
        closePopover("#"+$(this).attr('id'));
        $("#cargo").focus();
        } 
    });
    $(document).on("keyup","#cargo",function(e){  
        if($(this).val().length>=2){ 
        closePopover("#"+$(this).attr('id'));
        }
    });
    $(document).on("keyup","#pilot,#co_pilot",function(e){  
        if($(this).val().length>=2){ 
        closePopover("#"+$(this).attr('id'));
        }
    });
    $(document).on("keyup","#take_off_fuel,#landing_fuel",function(e){  
        if($(this).val().length>=1){ 
        closePopover("#"+$(this).attr('id'));
        }
    });
    function errorPopover(id, message) {
        $(id).css({"border-color": "red"});
        $(id).attr('data-content', message);   
        $(id).popover( {trigger : 'hover'}); 
    }
    function closePopover(id) {
        $(id).popover('destroy');
        $(id).removeClass('border_red');
        $(id).css({"border-color": "#a6a6a6"});
        $(this).next().css('display','none');
    }
    $(document).on("keypress",".numbers",function(e){   
        if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 32 && e.charCode <= 47) || (e.charCode >= 58 && e.charCode <= 64) || (e.charCode >= 91 && e.charCode <= 96)|| (e.charCode >= 123 && e.charCode <= 127))
             return false;
               else
             return true;    
    });
    $(document).on("keypress",".numbers_dots",function(e){   
       if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 32 && e.charCode <= 45) || (e.charCode >= 58 && e.charCode <= 64) || (e.charCode >= 91 && e.charCode <= 96)|| (e.charCode >= 123 && e.charCode <= 127))
             return false;
    });
    $(document).on("keypress",".alphabets",function(e){
         if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode==0))
          return true;
        else
          return false; 
    });
    $(document).on("keypress","#from,#to",function(e){
       var value=$(this).val(); 
       if (value.length == 0 && (e.which !=118 && e.which !=86))
            return false;
       if (value.length == 1 && (e.which !=97 && e.which !=65 && e.which != 101 && e.which != 69 && e.which != 105 && e.which != 73 && e.which != 111 && e.which != 79))
           return false;
    });  
    $('#add_vtfiu').on('submit',function (event){
        var from= $("#from").val();
        var to=$("#to").val();
        var date_of_flight=$("#flight_date").val();
        var cargo=$("#cargo").val();
       
        var pilot=$("#pilot").val();
        var co_pilot=$("#co_pilot").val();
        var take_off_fuel=$("#take_off_fuel").val();
        var landing_fuel=$("#landing_fuel").val();
        var bool=true;
        if(from.length<4){
            errorPopover('#from','Min. & Max. 4 Characters');
            bool=false;
        }
        if(to.length<4){
            errorPopover('#to','Min. & Max. 4 Characters');
            bool=false;
        }
        if(date_of_flight==""){
            errorPopover('#flight_date','Enter Date of Flight');
            bool=false;
        }
        if(cargo.length<2){
            errorPopover('#cargo','Min. 2 & Max. 3 Digits');
            bool=false;
        }
        else if(cargo==0){
            errorPopover('#cargo','Invalid value');
            bool=false;
        }
        if(pilot.length<2){
            errorPopover('#pilot','Min. 2 & Max. 25 Characters');
            bool=false;
        }
        if(co_pilot.length<2){
            errorPopover('#co_pilot','Min. 2 & Max. 25 Characters');
            bool=false;
        }
        if(take_off_fuel==""||take_off_fuel>1638||take_off_fuel==0){
            errorPopover('#take_off_fuel','Min value: 1 & Max value: 1638');
            bool=false;
        }
        if(landing_fuel==""||landing_fuel>1638||landing_fuel==0){
            errorPopover('#landing_fuel','Min value: 1 & Max value: 1638');
            bool=false;
        }
        if(bool==false)
           return false;    
       });
       $("#flight_date").click(function(){
         $(".notify-bg-v").fadeIn(); 
         $('.notify-bg-v').css('height',0);
         $('.notify-bg-v').css('height', $(document).height());
       });
       $("#flight_date").datepicker({
            dateFormat: 'dd-M-yy',
            showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true,
            onSelect: function(selectedDate) 
            {  
              closePopover("#"+$(this).attr('id')); 
              $("#flight_date_lbl").removeClass('hide');
              $(".notify-bg-v").fadeOut(); 
              $("#pilot").focus();
            }
        });
        $("#pilot").autocomplete({
              minLength: 0,
              source: function (request, response) {
                  $.ajax({
                          url: base_url + "/pilot_autosuggest",
                          dataType:"json",
                          data:{'designation':1,'callsign': $("#callsign").val()},  
                          success: function(data)
                          {
                              response(data);
                          }});
              },
              select: function (event, ui) {
                  if ((ui.item.value == '') || (ui.item.value.length <= '1')) {
                      $("#pilot").attr('data-content', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
                      $("#pilot").css("border", "red solid 1px");
                  } else {
                      $('#pilot').popover('destroy');
                      $("#pilot").css("border", "lightgrey solid 1px");
                  }
              }
          }).click(function () {
              $(this).autocomplete('search', $(this).val());
          });
       $("#co_pilot").autocomplete({
              minLength: 0,
              source: function (request, response) {
                  $.ajax({
                          url: base_url + "/copilot_autosuggest",
                          dataType:"json",
                          data:{'designation':2,'callsign': $("#callsign").val()},  
                          success: function(data)
                          {
                              response(data);
                          }});
              },
              select: function (event, ui) {
                  if ((ui.item.value == '') || (ui.item.value.length <= '1')) {
                      $("#co_pilot").attr('data-content', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
                      $("#co_pilot").css("border", "red solid 1px");
                  } else {
                      $('#co_pilot').popover('destroy');
                      $("#co_pilot").css("border", "lightgrey solid 1px");
                  }

              }
          }).click(function () {
              $(this).autocomplete('search', $(this).val());
          });
          $(function () {              
             var zero_fuel_data=[<?php echo $zfw['arm'];?>,<?php echo $zfw['weight'];?>];
             console.log("zero_fuel_data="+zero_fuel_data);
             var zero_fuel_data_graph=[<?php echo $zfw['arm'];?>,<?php echo $zfw['weight']+200;?>];
             var take_off_data=[<?php echo $tow['arm'];?>,<?php echo $tow['weight'];?>];
             console.log('take_off_data='+take_off_data);
             var take_off_data_graph=[<?php echo $tow['arm'];?>,<?php echo $tow['weight']+200;?>];
             var landing_data=[<?php echo $landing['arm']; ?>,<?php echo $landing['weight'] ;?>];
             console.log('landing_data='+landing_data);
             var ramp_data=[<?php echo $ramp_weight['arm']; ?>,<?php echo $ramp_weight['weight'] ;?>];
             console.log('ramp_data='+ramp_data);
             var landing_data_graph=[<?php echo $landing['arm']; ?>,<?php echo $landing['weight']+200 ;?>];
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
                                     text: `
                                      <div style="font-size:12px;font-weight:bold;margin-left:-1px"> 
                                        ${fromm}-
                                        ${to}
                                      </div>
                                      <div style="font-size:12px;font-weight:bold;margin-top:3px;">
                                        ${date}
                                      </div>`
                                      ,
                                      useHTML: true,
                                      y: 35,
                                      align: 'left',
                                      x: 100,
                                 },
                                 subtitle: {
                                 },
                                 margin: 0,
                                 chart: {
                                     width: 745,
                                     height: 1053,
                                     spacingBottom: 82,
                                     spacingRight: 94,
                                     marginTop: 70,
                                     marginLeft: 138,
                                     events: {
                                         load: function () {

                                             this.renderer.image('https://www.eflight.aero/media/images/loadtrim/vtfiu/VTFIU_GRAPH.jpg', '0', '0', 745,1053)
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
                             marginTop: 61,
                             marginLeft: 139,
                             spacingRight: 93,
                             spacingBottom: 72,
                             events: {
                                 load: function () {
                                     this.renderer.image(base_url+'/media/images/loadtrim/vtfiu/VTFIU_GRAPH.jpg', '0', '0', 745, 923)
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
                            //lineColor: 'red',
                            min: 190,
                            max: 210,
                            tickInterval: 2,
                            tickPositions: [190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210],
                            tickPosition: 'inside',
                            tickLength: 2,
                            //tickColor:'blue',
                            //tickWidth:2,
                            labels: {
                                style: {
                                    color: 'black',
                                    fontSize: '12px'
                                },
                                // y: 13,
                                enabled: false
                            }
                         },
                         yAxis: {
                             lineColor: 'transparent',
                             //lineColor: 'red',
                             gridLineWidth: 0,
                             min: 4100,
                             max: 6800,
                             tickPositions: [4100,4200,4300,4400,4500,4600,4700,4800,4900,5000,5100,5200,5300,5400,5500,5600,5700,5800,5900,6000,6100,6200,6300,6400,6500,6600,6700,6800,6900],
                             tickLength: 2,
                             tickWidth:2,
                             //tickColor:'blue',
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
                                    radius: 5
                                },
                                 data: [landing_data],
                                dataLabels: {
                                    enabled: true,
                                    formatter: function () {
                                    return  'LAND C.G. ('+parseFloat(this.key).toFixed(2) + ' / ' + Math.round(this.y) + ')';
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
                                    enabled: true,
                                    "symbol": "circle",
                                    radius: 4
                                },
                                  data: [take_off_data],
                                dataLabels: {
                                     enabled: true,
                                    formatter: function () { 
                            return   'T.OFF C.G. ('+parseFloat(this.key).toFixed(2) + ' / ' + Math.round(this.y) + ')';
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
                                    enabled: true,
                                    "symbol": "square",
                                    radius: 4
                                },
                                  data: [zero_fuel_data],
                                dataLabels: {
                                    enabled: true,
                                    formatter: function () {
                                        
                                      return   'ZFW C.G. ('+parseFloat(this.key).toFixed(2) + ' / ' + Math.round(this.y) + ')';
                                    },
                                    style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '12px', fontWeight: 'bold'},

                                },

                            },
                            
                         ]
                     });
                      $('#graph_print').click(function (e) {
                            var departure_aerodrome="<?php echo $from;?>";
                            var destination_aerodrome="<?php echo $to;?>";
                            var date_of_flight="<?php echo $date ?>";
                            var chart = $('#Div1').highcharts();
                            var graph_name = 'GRAPH VTFIU' + ' '+departure_aerodrome + ' ' + destination_aerodrome + ' ' + date_of_flight;
                            if ($(this).hasClass('disabled')) {
                                e.preventDefault();
                                return false;
                            }

                             chart.exportChart({
                                 type: 'application/pdf',
                                 filename: graph_name,
                                 width: 595,
                                 height: 841,
                                 //marginTop: 500,
                                 events: {
                                     load: function () {
                                         this.renderer.image('https://www.eflight.aero/media/images/loadtrim/vtfiu/VTFIU_GRAPH.jpg', '0', '0', 595,841)
                                                 .add();
                                     }
                                 }
                             });
                            
                         }); 

                 });
</script>
@stop