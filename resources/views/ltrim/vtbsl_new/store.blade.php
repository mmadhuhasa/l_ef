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
</style>
<div class="notify-bg-v"></div>
@include('includes.new_header',[])
    <main>
        <div class="container" style="width:425px;">
            <div class="bg-white">
                <div class="fpl_sec">
                <form method="POST" action="{{url('loadtrim/vtbsl_new')}}" id="add_vtbsl">
                     {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <p class="new_fpl_heading">VTBSL</p>
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
                                    <input type="text" data-toggle="popover" data-placement="top" maxlength="3" autocomplete="off" class="alpha_numeric text-center font-bold text_uppercase form-control modtooltip numbers"  placeholder="Refreshment Center" id="cargo" name="cargo" tabindex="1" @if($refreshment_center !="") value="{{$refreshment_center['weight']}}" @endif>
                                    <label>Refreshment Center</label>
                                </div>
                            </div>
                            <div class="col-sm-6 ltrim_sec" style="padding-left:5px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" autocomplete="off" value="{{$date}}" readonly='readonly' style="background: #eee; text-align:center;border-radius:4px;cursor:pointer;" class="form-control font-bold dateofflight_vtbsl" placeholder="Date of Flight" name="date" id="flight_date" data-toggle="popover" data-placement="top">
                                    <label style="left:10px;" class="flightdate_lable" id="flight_date_lbl">DATE OF FLIGHT</label>
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
                                    <input type="text" data-toggle="popover" data-placement="top" maxlength="4" autocomplete="off" class="text-center font-bold text_uppercase form-control modtooltip numbers"  placeholder="Computed Fuel" id="take_off_fuel" name="take_off_fuel" tabindex="1"  @if($fuel_loading !="") value="{{$fuel_loading['weight']}}" @endif>
                                    <label>Computed Fuel</label>
                                </div>
                            </div>
                            <div class="col-sm-6 ltrim_sec" style="padding-left:5px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" data-toggle="popover" data-placement="top" maxlength="4" autocomplete="off" class="numbers  text-center font-bold text_uppercase form-control modtooltip"  placeholder="TRIP FUEL" id="landing_fuel" name="trip_fuel" tabindex="1"  @if($lessfuel_dest !="") value="{{$lessfuel_dest['weight']}}" @endif>
                                    <label style="left:10px;">TRIP FUEL</label>
                                </div>
                            </div>
                        </div><!--col-md-12 close here-->
                        <div class="col-md-12" style="margin-left:28px;margin-bottom:15px;">
                            <div class="form-group dynamiclabel" style="font-size: 13px;line-height: 1;">
                                <div class="col-md-4 p-r-0"><input id="pax10" type="checkbox" name="pax[0]" value="165"
                                @if($pax!='') @if($pax[0]['weight']!=0)  checked  @endif @endif  ><label for="pax10">PAX 10</label></div>
                                <div class="col-md-4 p-r-0"><input id="pax3" type="checkbox" name="pax[1]" value="165" @if($pax!='') @if($pax[1]['weight']!=0)  checked  @endif @endif ><label for="pax3">PAX 3</label></div>
                                <div class="col-md-4 p-r-0"><input id="pax4" type="checkbox" name="pax[2]" value="165"
                                @if($pax!='') @if($pax[2]['weight']!=0)  checked  @endif @endif><label for="pax4">PAX 4</label></div>
                                <div class="col-md-4 p-r-0"><input id="pax5" type="checkbox" name="pax[3]" value="165"
                                @if($pax!='') @if($pax[3]['weight']!=0)  checked  @endif @endif><label for="pax5">PAX 5</label></div>
                                <div class="col-md-4 p-r-0"><input id="pax6" type="checkbox" name="pax[4]" value="165"
                                @if($pax!='') @if($pax[4]['weight']!=0)  checked  @endif @endif><label for="pax6">PAX 6</label></div>
                                <div class="col-md-4 p-r-0"><input id="pax7" type="checkbox" name="pax[5]" value="165"
                                @if($pax!='') @if($pax[5]['weight']!=0)  checked  @endif @endif><label for="pax7">PAX 7</label></div>
                                <div class="col-md-4 p-r-0"><input id="pax8" type="checkbox" name="pax[6]" value="165"
                                @if($pax!='') @if($pax[6]['weight']!=0)  checked  @endif @endif><label for="pax8">PAX 8</label></div>
                                <div class="col-md-4 p-r-0"><input id="pax9" type="checkbox" name="pax[7]" value="165"
                                 @if($pax!='') @if($pax[7]['weight']!=0)  checked  @endif @endif ><label for="pax9">SEAT AFT SFS</label></div>
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
            <div class="container" style="background:#fff;margin-top:10px;margin-bottom:15px;width:800px;box-shadow: 0 3px 3px 1px #999999;">
                <h5 style="text-align:center;text-decoration:underline;">Bhushan Aviation Limited</h5>
                <table>
                <tr>
                    <th style="border:none;">Aircraft Registration: VT-BSL</th>
                    <th style="border:none;text-align:right;">Aircraft S/N: 560-5816</th>
                </tr>
                </table>
                <h6 style="text-align:center;color:#595959;text-decoration:underline;">Loading Schedule Cessna Citation 560XL (Citation XLS)</h6>
                <table>
                <tr>
                    <th colspan="4" class="center fontsize14">PAYLOAD COMPUTATIONS</th>
                    <th class="center fontsize14">ITEM</th>
                    <th class="center fontsize14">WEIGHT <br>(POUNDS)</th>
                    <th class="center fontsize14">MOMENT/ <br>100</th>
                </tr>
                <tr>
                    <td class="center font_weight fontsize14">ITEM</td>
                    <td class="center font_weight fontsize14">ARM <br>(INCHES)</td>
                    <td class="center font_weight fontsize14">WEIGHT <br>(POUNDS)</td>
                    <td class="center font_weight v">MOMENT/ <br>100</td>
                    <td class="left fontsize14">1. <span class="font_weight">BASIC EMPTY WEIGHT</span><br>*BEW CG = 336.10</td>
                    <td class="center fontsize14">{{$empty_weight['weight']}}</td>
                    <td class="center fontsize14">{{$empty_weight['mom']}}</td>
                </tr>
                <tr>
                    <td class="left border_bottom0 fontsize14">PILOT</td>
                    <td class="center border_left0 border_bottom0 fontsize14">{{$pilot_co_pilot['arm']}}</td>
                    <td class="center border_left0 border_bottom0 fontsize14">{{$pilot_co_pilot['weight']}}</td>
                    <td class="center border_left0 border_bottom0 fontsize14">{{$pilot_co_pilot['mom']}}</td>
                    <td class="left fontsize14">2. <span class="font_weight">PAYLOAD</span></td>
                    <td class="center fontsize14">{{$payload['weight']}}</td>
                    <td class="center fontsize14">{{$payload['mom']}}</td>
                </tr>
                <tr>
                    <td class="left border_top0 border_bottom0 fontsize14">CO PILOT</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">{{$pilot_co_pilot['arm']}}</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">{{$pilot_co_pilot['weight']}}</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">{{$pilot_co_pilot['mom']}}</td>
                    <td class="left fontsize14">3. <span class="font_weight">ZERO FUEL WEIGHT </span> <span style="color:#595959;">(Do not</span> <br><span style="color:#595959;">exceed 15,100 lbs)</span></td>
                    <td class="center fontsize14">{{$zfw['weight']}}</td>
                    <td class="center fontsize14">{{$zfw['mom']}}</td>
                </tr>
                <tr>
                    <td class="left border_top0 border_bottom0 fontsize14">SEAT 10</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">{{$pax[0]['arm']}}</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">@if($pax[0]['weight']!=0){{$pax[0]['weight']}}@endif</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">{{$pax[0]['mom']}}</td>
                    <td colspan="4" class="center font_weight fontsize14">ZFW CG = {{$zfw['arm']}}</td>
                </tr>
                <tr>
                    <td class="left border_top0 border_bottom0 fontsize14">SEAT 3</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">{{$pax[1]['arm']}}</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">@if($pax[1]['weight']!=0){{$pax[1]['weight']}} @endif</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">{{$pax[1]['mom']}}</td>
                    <td class="left fontsize14">4. <span class="font_weight">FUEL</span> LOADING</td>
                    <td class="center fontsize14">{{$fuel_loading['weight']}}</td>
                    <td class="center fontsize14">{{$fuel_loading['mom']}}</td>
                </tr>
                <tr>
                    <td class="left border_top0 border_bottom0 fontsize14">SEAT 4</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">{{$pax[2]['arm']}}</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">@if($pax[2]['weight']!=0){{$pax[2]['weight']}} @endif</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">{{$pax[2]['mom']}}</td>
                    <td class="left fontsize14">5. <span class="font_weight">RAMP WEIGHT</span> <span style="color:#595959;">(Do not exceed</span> <br><span style="color:#595959;">20,400 lbs)</span></td>
                    <td class="center fontsize14">{{$ramp_weight['weight']}}</td>
                    <td class="center fontsize14">{{$ramp_weight['mom']}}</td>
                </tr>
                <tr>
                    <td class="left border_top0 border_bottom0 fontsize14">SEAT 5</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">{{$pax[3]['arm']}}</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">@if($pax[3]['weight']!=0){{$pax[3]['weight']}} @endif</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">{{$pax[3]['mom']}}</td>
                    <td colspan="4" class="center font_weight fontsize14">RAMP CG = {{$ramp_weight['arm']}}</td>
                </tr>
                <tr>
                    <td class="left border_top0 border_bottom0 fontsize14">SEAT 6</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">{{$pax[4]['arm']}}</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">@if($pax[4]['weight']!=0){{$pax[4]['weight']}} @endif</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">{{$pax[4]['mom']}}</td>
                    <td class="left fontsize14">6. LESS FUEL FOR TAXING</td>
                    <td class="center fontsize14">{{$lessfuel_taxing['weight']}}</td>
                    <td class="center fontsize14">{{$lessfuel_taxing['mom']}}</td>
                </tr>
                <tr>
                    <td class="left border_top0 border_bottom0 fontsize14">SEAT 7</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">{{$pax[5]['arm']}}</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">@if($pax[5]['weight']!=0){{$pax[5]['weight']}} @endif</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">{{$pax[5]['mom']}}</td>
                    <td class="left fontsize14">7. <span class="font_weight">TAKE OFF WEIGHT</span> <span style="color:#595959;">(Do not exceed</span> <br><span style="color:#595959;">20,200 lbs)</span></td>
                    <td class="center fontsize14">{{$tow['weight']}}</td>
                    <td class="center fontsize14">{{$tow['mom']}}</td>
                </tr>
                <tr>
                    <td class="left border_top0 border_bottom0 fontsize14">SEAT 8</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">{{$pax[6]['arm']}}</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">@if($pax[6]['weight']!=0){{$pax[6]['weight']}} @endif</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">{{$pax[6]['mom']}}</td>
                    <td colspan="4" class="center font_weight fontsize14">TAKE OFF CG = {{$tow['arm']}}</td>
                </tr>
                <tr>
                    <td class="left border_top0 border_bottom0 fontsize14">SEAT AFT SFS</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">{{$pax[7]['arm']}}</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">@if($pax[7]['weight']!=0){{$pax[7]['weight']}} @endif</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">{{$pax[7]['mom']}}</td>
                    <td class="left fontsize14">8. LESS FUEL TO DESTINATION</td>
                    <td class="center fontsize14">{{$lessfuel_dest['weight']}}</td>
                    <td class="center fontsize14">{{$lessfuel_dest['mom']}}</td>
                </tr>
                <tr>
                    <td class="left border_top0 border_bottom0 fontsize14">TAILCONE BAGGAGE <br><span style="font-size:12px;font-style:italic;color:#595959;font-weight:bold;">Do not exceed 700 lbs</span></td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">{{$cargo['arm']}}</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">{{$cargo['weight']}}</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">{{$cargo['mom']}}</td>
                    <td class="left fontsize14">9. <span class="font_weight">LANDING WEIGHT</span> <span style="color:#595959;">(Do not exceed</span><span style="color:#595959;">18,700 lbs)</span></td>
                    <td class="center fontsize14">{{$landing['weight']}}</td>
                    <td class="center fontsize14">{{$landing['mom']}}</td>
                </tr>
                <tr>
                    <td class="left border_top0 border_bottom0 fontsize14" style="font-size:12px;font-style:italic;color:#595959;font-weight:bold;"></td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14"></td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14"></td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14"></td>
                    <td colspan="4" class="center font_weight fontsize14">LANDING CG = {{$landing['arm']}}</td>
                </tr>
                <tr>
                    <td class="left border_top0 border_bottom0 fontsize14">LH REFRESHMENT <br>CENTER <br><span style="font-size:12px;font-style:italic;color:#595959;font-weight:bold;">Do not exceed 133 lbs</span></td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">{{$refreshment_center['arm']}}</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">{{$refreshment_center['weight']}}</td>
                    <td class="center border_left0 border_top0 border_bottom0 fontsize14">{{$refreshment_center['mom']}}</td>
                    <td colspan="4" class="center fontsize14" style="font-style:italic;color:#595959;">For MTOW - 20200 lbs (9162 kgs)<br>Fwd C.G Limit - 324.25 in, 21.3% MAC<br>Aft C.G Limit - 331.0 in, 29.3% MAC</td>
                </tr>
                <tr>
                    <td class="center border_top0 font_weight fontsize14">PAYLOAD</td>
                    <td class="center border_left0 border_top0 font_weight fontsize14"></td>
                    <td class="center border_left0 border_top0 font_weight fontsize14">{{$payload['weight']}}</td>
                    <td class="center border_left0 border_top0 font_weight fontsize14">{{$payload['mom']}}</td>
                    <td colspan="4" class="center fontsize14">CG PERCENT MAC = <span style="text-decoration:underline;">(TAKE OFF CG - 306.59) / 0.8223</span><br><span class="font_weight">CG % MAC = 
                    {{$cg_percent_mac}}</span></td>
                </tr>
                <tr>
                    <td colspan="7" class="center fontsize14">AIRPLANE CG =<span style="text-decoration:underline;">(MOMENT/100) </span>X 100<br><span>WEIGHT</span></td>
                </tr>
                <tr>
                    <td style="font-style:italic;text-decoration:underline;" class="font_weight center border_bottom0 fontsize14" colspan="7">Certification</td>
                </tr>
                <tr>
                    <td style="font-style:italic;" class="center border_top0 border_bottom0 fontsize14" colspan="7">It is certified that the airplane is satisfactorily loaded as per Airplane Flight Manual & the CG is within limits.</td>
                </tr>
                <tr>
                    <td class="left border_top0 font_weight border_right0 border_bottom0 fontsize14">PIC Name:</td>
                    <td class="border_left0 border_top0 font_weight border_right0 border_bottom0 fontsize14">{{$pilot}}</td>
                    <td class="center border_left0 border_top0 font_weight border_right0 border_bottom0 fontsize14"></td>
                    <td class="center border_left0 border_top0 font_weight border_right0 border_bottom0 fontsize14"></td>
                    <td colspan="4" class="border_top0 border_left0 border_bottom0 fontsize14"></td>
                </tr>
                <tr>
                    <td class="left border_top0 font_weight border_right0 border_bottom0 fontsize14">Signature of PIC:</td>
                    <td class="center border_left0 border_top0 font_weight border_right0 border_bottom0 fontsize14"></td>
                    <td class="center border_left0 border_top0 font_weight border_right0 border_bottom0 fontsize14"></td>
                    <td class="center border_left0 border_top0 font_weight border_right0 border_bottom0 fontsize14"></td>
                    <td colspan="4" class="border_top0 border_left0 border_bottom0 fontsize14"></td>
                </tr>
                <tr>
                    <td class="left border_top0 font_weight border_right0 fontsize14">License No.:</td>
                    <td class="border_left0 border_top0 font_weight border_right0 fontsize14">3110</td>
                    <td colspan="2" class="center border_left0 border_top0 font_weight border_right0 fontsize14">Date: {{$date}}</td>
                    <td colspan="3" class="center border_left0 border_top0 font_weight fontsize14">Sector: <span style="margin-left:25px;">{{$from}}-{{$to}}</span></td>
                </tr>
                </table>
                <table style="margin-top:10px;">
                <tr>
                    <td colspan="2" class="border0" style="font-size:13px;">Note: Conversion factor used 1kg = 2.2.46 lbs</td>
                </tr>
                <tr>
                    <td colspan="2" class="border0" style="font-size:13px;">Note: Decimals rounded off to nearest fig.</td>
                </tr>
                <tr>
                    <td class="border0" style="font-size:13px;">Wt of Adult Pax (male & female) = 165.34 lbs = 165 lbs</td>
                    <td class="border0 font_weight center" style="font-style:italic;font-size:14px;">Prepared by: Capt {{$pilot}}</td>
                </tr>
                <tr>
                    <td class="border0" style="font-size:13px;">Wt of Child pax (2-12 yrs) = 77.16 lb s= 77lbs</td>
                    <td class="border0 center font_weight" style="font-style:italic;font-size:14px;">PIC: ATPL 3110</td>
                </tr>
                <tr>
                    <td colspan="2" class="border0" style="font-size:13px;">Wt of Infant pax (less than 2yrs) = 22.04 lbs = 22 lbs</td>
                </tr>
                <tr>
                    <td colspan="2" class="border0 font_weight" style="font-size:13px;">Revision 02 dated Oct - 2013, Approved by O/o Deputy Director General of Civil Aviation (NR) Vide letter no</td>
                </tr>
                <tr>
                    <td colspan="2" class="border0 font_weight" style="font-size:13px;">F-Approval/BAL/2132 dated 02/10/2013</td>
                </tr>
                </table>    
           </div><!--table container close here-->
    </main>
    <div class="container graph_container" style="margin-bottom:15px;">
           <div class="row">
               <!--<img id="graph_print" class="pull-right" src="{{url('media/images/download-all.png')}}" style="margin-top: 35px;cursor: pointer;margin-right: 11px;">
               <div class="download_text">Download</div>-->
               <div class="col-sm-8 col-md-12">
                   <div id="Div1"></div>                      
               </div>
           </div>
    </div> 
@include('includes.new_footer',[])
<script>
     $("#graph_pdf").click(function(){
          var url = "<?php echo URL::to('/'); ?>";
                     window.location = url + "/ltrimpdf/vtbsl";   
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
        if(pilot.length<2){
            errorPopover('#pilot','Min. 2 & Max. 25 Characters');
            bool=false;
        }
        if(co_pilot.length<2){
            errorPopover('#co_pilot','Min. 2 & Max. 25 Characters');
            bool=false;
        }

        if(take_off_fuel==""||take_off_fuel>6790){
            errorPopover('#take_off_fuel','Max value is 6790');
            bool=false;
        }
        if(landing_fuel==""||landing_fuel>6790){
            errorPopover('#landing_fuel','Max value is 6790');
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
             console.log(zero_fuel_data);
             var zero_fuel_data_graph=[<?php echo $zfw['arm'];?>,<?php echo $zfw['weight']+200;?>];
             var take_off_data=[<?php echo $tow['arm'];?>,<?php echo $tow['weight'];?>];
             var take_off_data_graph=[<?php echo $tow['arm'];?>,<?php echo $tow['weight']+200;?>];
             var landing_data=[<?php echo $landing['arm']; ?>,<?php echo $landing['weight'] ;?>];
             var ramp_data=[<?php echo $ramp_weight['arm']; ?>,<?php echo $ramp_weight['weight'] ;?>];
             console.log('ramp_data'+ramp_data);
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
                                  text: `<img style="position:absolute;right:1%;top:-25px;"src="https://www.eflight.aero/media/images/loadtrim/vtbsl/VTBSL-GRAPH-LOGO.png"/>
                                  <div style="font-weight:bold;text-align:center;padding-left:15%;">WEIGHT AND <br>BALANCE DATA</div>
                                  <table style="width:110%;">
                                  <tr style="font-weight:bold;">
                                      <td style="width:40%;">MODEL 560XL (560-5501 AND ON)</td>
                                      
                                  </tr>
                                  </table>
                                  <div style="border-top:1px solid black;width:110%;"></div>
                                  <table style="width:110%;">
                                     <tr>
                                       <td style="width:30%;font-size:18px;">SERIAL NUMBER: 560-5816</td>
                                       <td style="width:26%;font-size:18px;">REGISTRATION: <span style="font-weight:bold;">VT-BSL</span></td>
                                       <td style="font-weight:bold;width:12%;">FROM: <span>${fromm}</span></td>
                                       <td style="font-weight:bold;width:12%;">TO: <span>${to}</span></td>
                                       <td style="font-weight:bold;">DATE: <span>${date}</span></td>
                                     </tr>
                                  </table>
                                  <div style="font-size:15px;color:#000;font-weight:bold;text-align:center;padding-left:7%;padding-top:15px;">CENTER OF GRAVITY LIMITS ENVELOPE GRAPH</div>`,

                                 useHTML: true,
                                 y:50,
                                 align: 'center',
                                 x:200,
                             },
                             subtitle: {
                             },
                             margin: 0,
                             chart: {
                                 /*  for graph pdf*/
                                 width: 900,
                                         height: 482,
                                 sourceWidth: 1380,
                                 sourceHeight: 1060,
                                 spacingBottom:379,
                                 spacingRight:412,
                                 marginTop:194,
                                 marginLeft:457,
                                 events: {
                                 load: function () {
                                 this.renderer.image('https://www.eflight.aero/media/images/loadtrim/vtbsl/vtbsl.png', '400', '180',601,601)
                                         .add();  
                                     }
                                 }
                             },
                   series: [
                          {
                             showInLegend: false,
                             name: 'LW',
                             type: 'scatter',
                             color: take_off_fuel_color,
                             "marker": {
                                 enabled: true,
                                 "symbol": "triangle",
                                 radius: 5
                             },
                               data: [landing_data],
                             dataLabels: {
                                 enabled: true,
                                 verticalAlign:'bottom',
                                 y:30,
                                 allowOverlap:1,
                                 //x:100,
                                 formatter: function () {
                                     
                                   return   'LAND C.G. ('+parseFloat(this.key).toFixed(2) + ' / ' + Math.round(this.y) + ')';
                                 },
                                 style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '15px', fontWeight: 'bold'},

                             },

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
                                 verticalAlign:'bottom',
                                 y:15,
                                 allowOverlap:1,
                                 x:100,
                                 formatter: function () {
                                     
                                   return   'ZFW C.G. ('+parseFloat(this.key).toFixed(2) + ' / ' + Math.round(this.y) + ')';
                                 },
                                 style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '15px', fontWeight: 'bold'},

                             },

                         },
                          {
                             showInLegend: false,
                             name: 'RAMP',
                             type: 'scatter',
                             color: take_off_fuel_color,
                             "marker": {
                                 enabled: true,
                                 "symbol": "diamond",
                                 radius: 5
                             },
                               data: [ramp_data],
                             dataLabels: {
                                 enabled: true,
                                 allowOverlap:1,
                                 // x:100,
                                 //verticalAlign:'bottom',
                                  //y:15,
                                 formatter: function () {
                                     
                                   return   'RAMP  C.G. ('+parseFloat(this.key).toFixed(2) + ' / ' + Math.round(this.y) + ')';
                                 },
                                 style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '15px', fontWeight: 'bold',top:'100px'},

                             },
                          
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
                                 verticalAlign:'bottom',
                                 y:15,
                                 x:100,
                                 allowOverlap:1,
                                 formatter: function () {
                                     
                                   return   'T.OFF C.G. ('+parseFloat(this.key).toFixed(2) + ' / ' + Math.round(this.y) + ')';
                                 },
                                 style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '15px', fontWeight: 'bold'},

                             },

                         },
                        
                       
                     ]
                         },

                         scale: 3,
                         fallbackToExportServer: false,
                     },
                     chart: {
                         width: 750,
                         height: 650,
                         marginTop: 20,
                         marginLeft: 158,
                         spacingRight:170,
                         spacingBottom: 143,
                         events: {
                             load: function () {
                                 this.renderer.image('https://www.eflight.aero/media/images/loadtrim/vtbsl/vtbsl.png', '110', '5', 500,601)
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
                         min: 316,
                         max: 340,
                         tickInterval: 2,
                         tickPositions: [316,318,320,322,324,326,328,330,332,334,336,338,340],
                         tickPosition: 'inside',
                         tickLength: 2,
                         // tickColor:'yellow',
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
                         //lineColor: 'red',
                         gridLineWidth: 0,
                         min: 10000,
                         max: 21000,
                         tickPositions: [10000,11000,12000,13000,14000,15000,16000,17000,18000,19000,20000,21000],
                         tickLength: 2,
                         tickWidth:2,
                         // tickColor:'yellow',
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
                                 return  'LAND C.G. ('+parseFloat(this.key).toFixed(2) + ' / ' + Math.round(this.y) + ')';
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
                                 enabled: false,
                                 formatter: function () {
                                     
                                   return   'ZFW C.G. ('+parseFloat(this.key).toFixed(2) + ' / ' + Math.round(this.y) + ')';
                                 },
                                 style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '15px', fontWeight: 'bold'},

                             },

                         },
                         {
                             showInLegend: false,
                             name: 'RAMP',
                             type: 'scatter',
                             color: take_off_fuel_color,
                             "marker": {
                                 enabled: true,
                                 "symbol": "diamond",
                                 radius: 5
                             },
                               data: [ramp_data],
                             dataLabels: {
                                 enabled: false,
                                 formatter: function () {
                                     
                                   return   'RAMP C.G. ('+parseFloat(this.key).toFixed(2) + ' / ' + Math.round(this.y) + ')';
                                 },
                                 style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '15px', fontWeight: 'bold'},

                             },
                          
                         },
                     ]
                 });
                $('#graph_print').click(function (e) {
                     var departure_aerodrome="<?php echo $from;?>";
                     var destination_aerodrome="<?php echo $to;?>";
                     var date_of_flight="<?php echo $date ?>";
                     var chart = $('#Div1').highcharts();
                     var graph_name = 'GRAPH VTBSL' + ' '+departure_aerodrome + ' ' + destination_aerodrome + ' ' + date_of_flight;
                     if ($(this).hasClass('disabled')) {
                         e.preventDefault();
                         return false;
                     }

                     chart.exportChart({
                         type: 'application/pdf',
                         filename: graph_name,
                         width: 600,  //portrait mode
                         height: 682, //portrait mode
                         sourceWidth: 1380,
                         sourceHeight: 1060,
                         spacingBottom:400,
                         spacingRight:105,
                         marginTop:215,
                         marginLeft:0,
                         events: {
                         load: function () {
                         this.renderer.image('https://www.eflight.aero/media/images/loadtrim/vtbsl/vtbsl.png', '780', '170',572,601)
                                 .add();  
                             }
                         }
                     });
                    //  setTimeout(function(){
                    //  var url = "<?php echo URL::to('/'); ?>";
                    //  window.location = url + "/ltrimpdf/vtbsl";
                    //  }, 5000)
                 }); 
             });
</script>
@stop