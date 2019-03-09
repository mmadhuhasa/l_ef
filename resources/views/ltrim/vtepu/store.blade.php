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
right: 24px;
}
#Div1{
margin-left: 120px;
}
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
                <form method="POST" action="{{url('loadtrim/vtepu')}}" id="add_vtbsl">
                     {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <p class="new_fpl_heading">VTEPU</p>
                        </div>
                        <input type="hidden" name="callsign" id="callsign" value="vtbsl">
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
                                    <input type="text" data-toggle="popover" data-placement="top" maxlength="2" autocomplete="off" class="alpha_numeric text-center font-bold text_uppercase form-control modtooltip numbers"  placeholder="Front Baggage" id="front_cargo" name="front_cargo" tabindex="1" value="{{$front_cargo['weight']}}">
                                    <label>Front Baggage</label>
                                </div>
                            </div>
                             <div class="col-sm-6 ltrim_sec" style="padding-left:5px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" data-toggle="popover" data-placement="top" maxlength="3" autocomplete="off" class="alpha_numeric text-center font-bold text_uppercase form-control modtooltip numbers"  placeholder="Rear Baggage" id="rear_cargo" name="rear_cargo" tabindex="1" value="{{$rear_cargo['weight']}}">
                                    <label style="left:10px;">Rear Baggage</label>
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
                                    <input type="text" data-toggle="popover" data-placement="top" maxlength="4" autocomplete="off" class="numbers  text-center font-bold text_uppercase form-control modtooltip"  placeholder="Remaining FUEL" id="landing_fuel" name="trip_fuel" tabindex="1"  @if($lessfuel_dest !="") value="{{$lessfuel_dest['weight']}}" @endif>
                                    <label style="left:10px;">Remaining FUEL</label>
                                </div>
                            </div>
                        </div><!--col-md-12 close here-->
                         <div class="col-md-12" style="margin-left:5px;padding-right:5px;">
                            <div class="col-sm-6 ltrim_sec" style="padding-left:30px;padding-right:15px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" autocomplete="off" value="{{$date}}" readonly='readonly' style="background: #eee; text-align:center;border-radius:4px;cursor:pointer;" class="form-control font-bold dateofflight_vtbsl" placeholder="Date of Flight" name="date" id="flight_date" data-toggle="popover" data-placement="top">
                                    <label style="left:30px;" class="flightdate_lable" id="flight_date_lbl">DATE OF FLIGHT</label>
                                </div>
                            </div>
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
                                <div class="col-md-4 p-r-0"><input id="pax5" type="checkbox" name="pax[4]" value="75"
                                @if($pax!='') @if($pax[4]['weight']!=0)  checked  @endif @endif><label for="pax5">PAX 5</label></div>
                                <div class="col-md-4 p-r-0"><input id="pax6" type="checkbox" name="pax[5]" value="75"
                                @if($pax!='') @if($pax[5]['weight']!=0)  checked  @endif @endif><label for="pax6">PAX 6</label></div>
                                <div class="col-md-4 p-r-0"><input id="pax7" type="checkbox" name="pax[6]" value="75"
                                @if($pax!='') @if($pax[6]['weight']!=0)  checked  @endif @endif><label for="pax7">PAX 7</label></div>
                               
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
    </main>
    <!-- <div class="container graph_container" style="margin-bottom:15px;">
           <div class="row">
               <div class="col-sm-8 col-md-12">
                   <div id="Div1"></div>                      
               </div>
           </div>
    </div>  -->
    <div class="container" style="background: #fff;margin-bottom: 15px;box-shadow: 0 3px 3px 1px #999999;">
       <img class="Airport_Authority_icon" src="{{url('media/images/loadtrim/vtepu/Airport-Authority.png')}}"/>
       <table>
          <tr>
             <th style="border:none;font-size:18px;">Weight and Balance</th>
          </tr>
       </table>
       <table style="margin-bottom:10px;">
          <tr>
             <th class="border_right0">Call Sign. VTEPU</th>
             <th class="center border_right0 border_left0">Registration No.</th>
             <th class="center border_left0">Date {{$date}}</th>
          </tr>
       </table>
       <table>
          <tr>
             <th colspan="4" class="center fontsize14" style="width:44%;">Passanger, Baggage, Cargo and Service Load</th>
             <th class="center fontsize14">REF</th>
             <th class="center fontsize14">ITEM</th>
             <th class="center fontsize14">WEIGHT <br>(Kg)</th>
             <th class="center fontsize14">MOMENT <br>(m Kg)</th>
             <th class="center fontsize14"></th>
          </tr>
          <tr>
             <td class="center font_weight fontsize14">ITEM</td>
             <td class="center font_weight fontsize14">ARM <br>(m)</td>
             <td class="center font_weight fontsize14">WEIGHT <br>(kg)</td>
             <td class="center font_weight fontsize14">MOMENT <br>(m Kg)</td>
             <td class="center font_weight fontsize14">1.</td>
             <td class="center font_weight fontsize14"><span>BASIC WEIGHT</span><br>(Ldg. Gaar Down)</td>
             <td class="center fontsize14 font_weight">{{$empty_weight['weight']}}</td>
             <td class="center fontsize14 font_weight">{{$empty_weight['mom']}}</td>
             <td rowspan="3" class="center fontsize14"></td>
          </tr>
          <tr>
             <td class="center border_bottom0 font_weight fontsize14">Seat - 1</td>
             <td class="center font_weight border_left0 border_bottom0 fontsize14 font_weight">@if($pax[0]['arm']!=0){{$pax[0]['arm']}} @endif</td>
             <td class="center border_left0 border_bottom0 fontsize14 font_weight">@if($pax[0]['weight']!=0){{$pax[0]['weight']}} @endif</td>
             <td class="center border_left0 border_bottom0 fontsize14 font_weight">@if($pax[0]['mom']!=0){{$pax[0]['mom']}} @endif</td>
             <td class="center font_weight fontsize14">2.</td>
             <td class="center fontsize14"><span class="font_weight">Pilots</span></td>
             <td class="center font_weight fontsize14">{{$pilot_co_pilot['weight']}}</td>
             <td class="center font_weight fontsize14">{{$pilot_co_pilot['mom']}}</td>
          
          </tr>
          <tr>
             <td class="center font_weight border_top0 border_bottom0 fontsize14">Seat - 2</td>
             <td class="center font_weight border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[1]['arm']!=0){{$pax[1]['arm']}} @endif</td>
             <td class="center border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[1]['weight']!=0){{$pax[1]['weight']}} @endif</td>
             <td class="center border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[1]['mom']!=0){{$pax[1]['mom']}} @endif</td>
             <td class="center font_weight fontsize14">3.</td>
             <td class="center fontsize14"><span class="font_weight">Total Payload</span></td>
             <td class="center font_weight fontsize14">{{$payload['weight']}}</td>
             <td class="center font_weight fontsize14">{{$payload['mom']}}</td>
          </tr>
          <tr>
             <td class="center font_weight border_top0 border_bottom0 fontsize14">Seat - 3</td>
             <td class="center font_weight border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[2]['arm']!=0){{$pax[2]['arm']}} @endif</td>
             <td class="center border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[2]['weight']!=0){{$pax[2]['weight']}} @endif</td>
             <td class="center border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[2]['mom']!=0){{$pax[2]['mom']}} @endif</td>
             <td class="center font_weight fontsize14">4.</td>
             <td class="center fontsize14"><span class="font_weight">Zero fuel weight <br>sub.Total <br>(Max.5590 kg)</span></td>
             <td class="center fontsize14 font_weight">{{$zfw['weight']}}</td>
             <td class="center fontsize14 font_weight">{{$zfw['mom']}}</td>
             <td class="center font_weight fontsize14">% MAC <br>{{$zfw['mac']}}</td>
          </tr>
          <tr>
             <td class="center font_weight border_top0 border_bottom0 fontsize14">Seat - 4</td>
             <td class="center font_weight border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[3]['arm']!=0){{$pax[3]['arm']}} @endif</td>
             <td class="center border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[3]['weight']!=0){{$pax[3]['weight']}} @endif</td>
             <td class="center border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[3]['mom']!=0){{$pax[3]['mom']}} @endif</td>
             <td class="center font_weight fontsize14">5.</td>
             <td class="center font_weight fontsize14"><span>Fuel</span> Loading</td>
             <td class="center fontsize14 font_weight">{{$fuel_loading['weight']}}</td>
             <td class="center fontsize14 font_weight">{{$fuel_loading['mom']}}</td>
             <td class="center fontsize14 font_weight">{{sprintf('%.0f', $fuel_loading['weight']*2.205)}}<br>Lbs</td>
          </tr>
          <tr>
             <td class="center font_weight border_top0 border_bottom0 fontsize14">Seat - 5</td>
             <td class="center font_weight border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[4]['arm']!=0){{$pax[4]['arm']}} @endif</td>
             <td class="center border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[4]['weight']!=0){{$pax[4]['weight']}} @endif</td>
             <td class="center border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[4]['mom']!=0){{$pax[4]['mom']}} @endif</td>
             <td class="center font_weight fontsize14">6.</td>
             <td class="center font_weight fontsize14"><span>Ramp weight</span><br><span>(Max. 6010 kg)</span></td>
             <td class="center fontsize14 font_weight">{{$ramp_weight['weight']}}</td>
             <td class="center fontsize14 font_weight">{{$ramp_weight['mom']}}</td>
             <td rowspan="3" class="center fontsize14 font_weight"></td>
          </tr>
          <tr>
             <td class="center font_weight border_top0 border_bottom0 fontsize14">Seat - 6</td>
             <td class="center font_weight border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[5]['arm']!=0){{$pax[5]['arm']}} @endif</td>
             <td class="center border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[5]['weight']!=0){{$pax[5]['weight']}} @endif</td>
             <td class="center border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[5]['mom']!=0){{$pax[5]['mom']}} @endif</td>
             <td rowspan="2" class="center font_weight fontsize14">7.</td>
             <td rowspan="2" class="center font_weight fontsize14"><span>Subtract Fuel for</span><br><span>Eng.Start, Taxi</span></td>
             <td rowspan="2" class="center font_weight fontsize14">-30</td>
             <td rowspan="2" class="center font_weight fontsize14">-238</td>
          
          </tr>
          <tr>
             <td class="center font_weight border_top0 border_bottom0 fontsize14">Seat - 7</td>
             <td class="center font_weight border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[6]['arm']!=0){{$pax[6]['arm']}} @endif</td>
             <td class="center border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[6]['weight']!=0){{$pax[6]['weight']}} @endif</td>
             <td class="center border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[6]['mom']!=0){{$pax[6]['mom']}} @endif</td>
          </tr>
          <tr>
             <td class="left font_weight fontsize14">Front Baggage <br> Compartment</td>
             <td class="center font_weight fontsize14">{{$front_cargo['arm']}}</td>
             <td class="center font_weight fontsize14">{{$front_cargo['weight']}}</td>
             <td class="center font_weight">{{$front_cargo['mom']}}</td>
             <td class="center font_weight fontsize14">8.</td>
             <td class="center font_weight fontsize14">Take off weight <br>(Max.5980 kg)</td>
             <td class="center fontsize14 font_weight">{{$tow['weight']}}</td>
             <td class="center fontsize14 font_weight">{{$tow['mom']}}</td>
             <td class="center font_weight fontsize14 font_weight">% MAC <br>{{$tow['mac']}}</td>
          </tr>
          <tr>
             <td class="left font_weight fontsize14">Rear Baggage <br> Compartment</td>
             <td class="center font_weight fontsize14">{{$rear_cargo['arm']}}</td>
             <td class="center font_weight fontsize14">{{$rear_cargo['weight']}}</td>
             <td class="center font_weight">{{$rear_cargo['mom']}}</td>
             <td class="center font_weight fontsize14">9.</td>
             <td class="center font_weight fontsize14">Subtract Fuel to<br>Destination</td>
             <td class="center fontsize14 font_weight">{{$lessfuel_dest['weight']}}</td>
             <td class="center fontsize14 font_weight">{{$lessfuel_dest['mom']}}</td>
             <td class="center font_weight fontsize14">{{sprintf('%.0f', $lessfuel_dest['weight']*2.205)}}<br>Lbs</td>
          </tr>
          <tr>
             <td class="left font_weight fontsize14">Total Payload</td>
             <td class="center fontsize14"></td>
             <td class="center fontsize14 font_weight">{{$payload['weight']}}</td>
             <td class="center fontsize14 font_weight" >{{$payload['mom']}}</td>
             <td class="center font_weight fontsize14">10.</td>
             <td class="center font_weight fontsize14">Landing Weight<br>(Max.5900 kg)</td>
             <td class="center fontsize14 font_weight">{{$landing['weight']}}</td>
             <td class="center fontsize14 font_weight">{{$landing['mom']}}</td>
             <td class="center font_weight fontsize14">% MAC <br>{{$landing['mac']}}</td>
          </tr>
          <tr>
             <td colspan="6" class="left font_weight fontsize14"><img src="{{url('media/images/loadtrim/vtepu/tdview_note2.png')}}"/></td>
             <td colspan="3" class="font_weight right" style="font-size:12px;"><img src="{{url('media/images/loadtrim/vtepu/vtepu_image.png')}}"/></td>
          </tr>
          <tr>
          <tr>
             <td colspan="5" class="left font_weight fontsize14 border_bottom0">Computed by <span style="border-bottom:1px solid black;"><span style="visibility:none;margin-left:2px;">{{$co_pilot}}</span></span></td>
             <td colspan="4" class="left fontsize14 border_bottom0 font_weight">Pilot {{$pilot}}</td>
          </tr>
          <tr>
             <td colspan="5" class="left font_weight fontsize14 border_top0" style="padding-top:25px;padding-left:100px;"><span style="padding-right:4px;">Signature</span><span style="border-bottom:1px solid black;"><span style="visibility:hidden;">dummy text of the printing and type</span></span></td>
             <td colspan="4" class="left fontsize14 border_top0 font_weight" style="padding-top:25px;padding-left:60px;"><span style="padding-right:4px;">Signature</span><span style="border-bottom:1px solid black;"><span style="visibility:hidden;margin-left:2px;">dummy text of the printing and type</span></span></td>
          </tr>
          </tr>
       </table>
       <table style="margin-top:10px;">
         <tr>
          <td colspan="2" class="noBorder left fontsize12 font_weight"><img src="{{url('media/images/loadtrim/vtepu/vtepu_last.png')}}"/></td>
         </tr>
         <tr>
          <td colspan="2" class="font_weight fontsize14 noBorder center">Weight and Balance Loading Form</td>
         </tr>
         <tr>
          <td colspan="2" class="font_weight fontsize14 noBorder left">Approved by the Director of Airworthiness, Delhi Region, New Delhi vide his letter<br>NO.AWI/F-APP/2373 dated 07/01/2003</td>
         </tr>
       </table>
       
       
    </div>
@include('includes.new_footer',[])
<script>
     $("#graph_pdf").click(function(){
          var url = "<?php echo URL::to('/'); ?>";
                     window.location = url + "/ltrimpdf/vtepu";   
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
    $(document).on("keypress","#max_zfw_mac,#take_off_mac,#landing_mac",function(e){
         var value=$(this).val();
         if(value!=''){
           var num_matches = value.split(".");
           if(e.which ==46 && num_matches.length>=2)
           return false;
        }
         if(((value.length==0||value.length == 1||value.length == 2) && e.which ==46)){
            return false;
          }
    });  
    $('#add_vtbsl').on('submit',function (event){
        var from= $("#from").val();
        var to=$("#to").val();
        var date_of_flight=$("#flight_date").val();
        var front_cargo=$("#front_cargo").val();
        var rear_cargo=$("#rear_cargo").val();
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
        if(front_cargo.length<2){
            errorPopover('#front_cargo','Min. 2 & Max. 2 Digits');
            bool=false;
        }
        else if(front_cargo % 10!=0 || front_cargo==0){
            console.log()
            console.log(front_cargo % 10)
            errorPopover('#front_cargo','Invalid value');
            bool=false;
        }
        else if(front_cargo>90)
        {
            errorPopover('#front_cargo','Max value is 90');
            bool=false;
        }

        if(rear_cargo.length<2){
            errorPopover('#rear_cargo','Min. 2 & Max. 3 Digits');
            bool=false;
        }
        else if(rear_cargo % 10!=0 || rear_cargo==0){
            errorPopover('#rear_cargo','Invalid value');
            bool=false;
        }
        else if(rear_cargo>150)
        {
            errorPopover('#rear_cargo','Max value is 150');
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

         if(take_off_fuel==""||take_off_fuel>1885||take_off_fuel==0){
            errorPopover('#take_off_fuel','Min value: 1 & Max value: 1885');
            bool=false;
        }
         if(landing_fuel==""||landing_fuel>1885||landing_fuel==0){
            errorPopover('#landing_fuel','Min value: 1 & Max value: 1885');
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

</script>
@stop