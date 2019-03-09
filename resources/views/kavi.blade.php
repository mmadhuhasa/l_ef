@extends('layouts.check_quick_plan_layout')
@section('content')
<style>
  .sec_container{
  width:850px;
  text-align: center;background: #ffffff;
  margin: 15px auto;
  box-shadow: 0 0 3px 1px #999999;
}
.new_heading{
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
.new_heading1{
    text-align: center;
    font-size: 12px;
    font-weight: bold;
    font-family: 'pt_sansregular', sans-serif;
    background: #a6a6a6;
    background: -moz-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
    background: -webkit-linear-gradient(left, #a6a6a6 0%, #9E9E9E 50%, rgba(166, 166, 166, 0.08) 100%);
    background: -o-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
    background: -ms-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
    background: linear-gradient(to right, hsla(0, 0%, 62%, 0) 0%, rgba(33, 33, 33, 0.15) 50%, rgba(166, 166, 166, 0) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6a6a6', endColorstr='#a6a6a6', GradientType=1 );
  }
input[type="text"],select {
    font-size: 14px;
    padding: 4px 0px 0px 0px;
    display: block;
    width: 100%;
    color: #000;
    border-left: 0px;
    border-right: 0px;
    border-top: 0px;
    border-color: #777;
    border-width: 1px;
    text-transform: uppercase;
}
.ltrim_sec div.dynamiclabel{
    display: block;
    position: relative;
    text-align: left;
    padding-right: 0px;  
}
.ltrim_sec div.dynamiclabel label{
    position: absolute;
    font-size: 12px;
    color:#f1292b ;
    font-weight:bold;      
    top: 7px;
    left:15px;          
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
    border-color:#f1292b ;
      outline: none;
}
.ltrim_sec div.dynamiclabel > *:not(:placeholder-shown) + label{
    opacity: 1;
    z-index:1;
    top: -7px;
    left:0px;
    text-transform: uppercase;
}
.ltrim_sec div.dynamiclabel > *:focus + label{
    opacity: 1;
    z-index:100;
    top: -7px;
    left:0px;
    text-transform: uppercase;
}
.ltrim_sec div.dynamiclabel [placeholder]::-webkit-input-placeholder {
    transition: opacity 0.4s 0.4s ease;
    text-align: left;
}
input::-webkit-input-placeholder {
    color: #000 !important;
    font-size: 12px!important;
    padding:0px;
    margin:0px; 
}
input:-moz-placeholder { /* Firefox 18- */
    color: #000 !important;
    font-size: 12px!important;  
}
input::-moz-placeholder {  /* Firefox 19+ */
    color: #000 !important;
    font-size: 12px!important;  
}
input:-ms-input-placeholder {  
    color: #000 !important;
    font-size: 12px!important;  
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
    border-bottom: 1px solid #ff0000 ;
}
.style_date{
    width: 15% !important;
    padding-right: 0px;
    margin-left: -17px;
}
.style_registration{
    width:12% !important;
    padding-right: 0px;
}
.style_departure{
  width:11%;
  padding-right: 0px;
}
.style_destination{
  width:12%;
  padding-right: 0px;

}
.style_departure_time{
  width:9%;
  padding-right: 0px;
}
.style_pax{
  width: 7%;
  color:#000;
  padding-right: 0px;
}
.style_load{
  width:8%;
  padding-right:0px;
}
.style_fuel{
  width:7%;
  padding-right: 0px;
}
.style_radio{
  width:7%;
  font-size: 13px;
  padding-right: 0px;
  padding-left: 0px;
  margin-top: -12px;
}
.wrapper-class input[type="radio"] {
  width: 15px;
}
.wrapper-class label {
  display: inline;
  margin-left: 5px;
  }
.style_pilot_in{
  width: 27%;
}
.style_mobile{
  width:24%;
  margin-left: -16px;
}
.style_co_pilot{
  width: 29%;
  margin-left: -18px;

}
.style_cabincrew{
  width: 23%;
  margin-left: -14px;
  padding-right:0px;
}
.style_remarks{
  width:85%;
}
.ui-datepicker-trigger{
  height:24px;
  top:0px;
  right:0px;
}
.sub_new_heading{
  margin-top:19px;
}
.sub_radio{
  padding-left: 13px;
}
.pilot_in_comm{
  margin-top: 19px;
}
.remarkes{
  margin-top: 19px;
}
.place_long{
  margin-top: 19px;
}
.pace_name{
  background: #eee;
}
.mfProgress:hover{
  font-weight:normal;
  color: #fff !important;
}
.input_blod{
  font-weight: bold;
}
.dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover{
    background:-webkit-gradient(linear, left top, left bottom, from(#f1292b ), to(#f37858 ));
 }
 .speed_drop{
     min-width: 92px;
 }
 .panel-default{
   margin-bottom:0px;
 }
 .panel-default>.panel-heading{
    color: #fff;
    background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
    padding:0px 0px;
 }
.panel-title{
  text-align:center;
}
 #accordion .panel-heading { padding: 0;}
#accordion .panel-title > a {
	display: block;
	padding: 0.4em 0.6em;
    outline: none;
    font-weight:bold;
    text-decoration: none;
}

#accordion .panel-title > a.accordion-toggle::before, #accordion a[data-toggle="collapse"]::before  {
    content:"\e113";
    float: left;
    font-family: 'Glyphicons Halflings';
	margin-right :1em;
}
#accordion .panel-title > a.accordion-toggle.collapsed::before, #accordion a.collapsed[data-toggle="collapse"]::before  {
    content:"\e114";
}
.panel-body{
  box-shadow: 3px 3px 12px 0px #999;
}
.panel-group .panel+.panel{
  margin-top: 0px;
}
.mfProgress.active.focus, .mfProgress.active:focus, .mfProgress.focus, .mfProgress:active.focus, .mfProgress:active:focus, .mfProgress:focus{
  color: #fff!important;
  background:-webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b))!important;
}
.dropdown dd ul{
    width: 92px;
    top:1px;
    height: 122px;
    overflow: hidden;
    padding: 0px;

}
#hour1, #hour2, #hour3,#hour4,#hour5,#hour6,#hour9{
    border-top: 0px;
    border-left: 0px;
    border-right: 0px;
    border-radius: 0px;
    box-shadow: none;
        z-index: 99;
        margin-bottom: 0;
}
.dropdown dt a span, .dropdowns dt a span, .speed dt a span, .level dt a span, .modhrs dt a span, .modmin dt a span, .nationality dt a span, .endhrs dt a span, .endmin dt a span, .flrules dt a span, .fltypes dt a span, .wtcat dt a span, .transmode dt a span, .tt-hrs dt a span, .tt-mins dt a span, .crfacility dt a span{
  font-size:14px;
}
.dropdown dd ul li a:hover, .dropdowns dd ul li a:hover, .speed dd ul li a:hover, .level dd ul li a:hover, .modhrs dd ul li a:hover, .modmin dd ul li a:hover, .endhrs dd ul li a:hover, .endmin dd ul li a:hover, .nationality dd ul li a:hover, .flrules dd ul li a:hover, .fltypes dd ul li a:hover, .wtcat dd ul li a:hover, .transmode dd ul li a:hover, .tt-hrs dd ul li a:hover, .tt-mins dd ul li a:hover, .crfacility dd ul li a:hover{
  background:-webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b))!important;
  color: #fff;
}
.title_navlog:hover{
  text-decoration: none;
}
</style>
<div class="page" id="app">  
    @include('includes.new_header',[])      
<div class="container" style="margin: 10px auto;">
   <div class="row">
      <div class="panel-group" id="accordion_reg" role="tablist" aria-multiselectable="true" >
        <div class="panel panel-default"  data-slidecount="1">
            <div class="panel-heading" role="tab" id="heading_reg1">
               <h4 class="panel-title collapsed title_header" id="accord1" role="button" data-toggle="collapse" data-parent="#accordion_reg" href="#collapse_reg1" aria-expanded="false" aria-controls="collapse_reg1">
                  <a class="title_navlog">
                  NAV LOG 1
                  </a>
               </h4>
            </div>
            <div id="collapse_reg1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_reg1">
               <div class="panel-body">
                  <div class="col-md-12 sub_new_heading">
                     <div class="col-md-1" style="width:13%;margin-top: -2px;">
                            <div class="form-group">
                                <dl id="hour1" class="dropdown form-control validation_class_click select" style="height: 26px;padding:5px;"  data-toggle="popover
                                "  data-placement="top">
                                    <dt ><a >
                                            <span style="font-weight:normal;" id="no_of_flight1">SELECT</span>
                                        </a>
                                    </dt>
                                    <dd >
                                        <ul >
                                            <li><a>1</a></li>
                                            <li><a>2</a></li>
                                            <li><a>3</a></li>
                                            <li><a>4</a></li>
                                            <li><a>5</a></li>
                                            <li><a>6</a></li> 
                                        </ul>
                                    </dd>
                                </dl>
                            </div>
                     </div>
                      
                     <div class="col-md-1 style_date">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  flightdate_newbill_wrapper">
                              <input id="flight_date1" type="text" placeholder="FLIGHT DATE" name="flightdate" autocomplete="off" class="input_blod infocus outfocus ui-datepicker-trigger flightdate" readonly data-toggle="popover" data-placement="top" value="{{date('d-M-Y')}}">
                            
                              <label id="flightdate_lbl" style="display: none" >FLIGHT DATE</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-1 style_registration">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  operator_newbill_wrapper">
                              <input  class="input_blod infocus outfocus alphabets callsign" id="callsign1" type="text" placeholder="CALLSIGN" name="operator" autocomplete="off" maxlength="7" minlength="5" data-toggle="popover" data-placement="top">
                              <label id="operator_lbl"> CALLSIGN</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-1 style_departure">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel departure_newbill_wrapper">
                              <input class="input_blod infocus outfocus alphabets departure" id="departure1" type="text" placeholder="DEPARTURE" name="departure" autocomplete="off"  maxlength="4" minlength="4" data-toggle="popover" data-placement="top">
                              <label id="departure_lbl"> DEPARTURE</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-1 style_destination">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel destination_newbill_wrapper">
                              <input class="input_blod infocus outfocus alphabets destination" id="destination1" maxlength="4" minlength="4" type="text" placeholder="DESTINATION" name="destination" autocomplete="off" data-toggle="popover" data-placement="top">
                              <label id="destination_lbl" > DESTINATION</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-1 style_departure_time">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  departure_time_newbill_wrapper">
                              <input class="input_blod infocus outfocus numbers_colon departuretime" id="dept_time1" type="text" placeholder="DEP TIME" name="departure_time" autocomplete="off" maxlength="5" data-toggle="popover" data-placement="top">
                              <label id="departure_time_lbl"> DEP TIME</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-1 style_pax">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  pax_newbill_wrapper">
                              <input class="input_blod infocus outfocus numbers pax" id="pax1" type="text" placeholder="PAX" name="pax" autocomplete="off" minlength="1" maxlength="3" >
                              <label id="pax_lbl"> PAX</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-1 style_load">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  load_newbill_wrapper">
                              <input class="input_blod infocus outfocus numbers load" id="load1" type="text" placeholder="LOAD" name="load" autocomplete="off" minlength="1" maxlength="5">
                              <label id="load_lbl"> LOAD</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-1 style_fuel">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  fuel_newbill_wrapper">
                              <input class="input_blod infocus outfocus numbers fuel" minlength="3" maxlength="5" id="fuel1" type="text" placeholder="FUEL" name="fuel" autocomplete="off" minlength="3" maxlength="5">
                              <label id="fuel_lbl"> FUEL</label>
                           </div>
                        </div>
                     </div>
                     <div class="group col-md-1 amountmode_newbill_wrapper style_radio">
                        <div class="col-md-12 sub_radio"><label class="radio-inline">
                           <input class="input_blod" class="style_input_radio" type="radio" name="optradio" style="width:11px;margin-left: -14px;"><span style="font-size: 11px;font-weight: bold;">MIN</span>
                           </label>
                        </div>
                        <div class="col-md-12" style="margin-top: -2px;padding-left: 12px;"><label class="radio-inline">
                           <input class="input_blod" type="radio" name="optradio" style="width:11px;margin-left: -13px;"><span style="font-size: 11px;font-weight: bold;">MAX</span>
                           </label>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12 pilot_in_comm">
                     <div class="col-md-3 style_pilot_in">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  pilot_newbill_wrapper">
                              <input class="input_blod infocus outfocus pilot alphabets_with_space" id="pilot1" type="text" placeholder="PILOT IN COMMAND" name="pilot" autocomplete="off" data-toggle="popover" data-placement="top">
                              <label id="pilot_lbl"> PILOT IN COMMAND</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-2 style_mobile">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  mobile_newbill_wrapper">
                              <input class="input_blod infocus outfocus mobile numbers" id="mobile1" type="text" placeholder="MOBILE" name="mobile" autocomplete="off" maxlength="10" data-toggle="popover" data-placement="top">
                              <label id="operator_lbl"> MOBILE</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-2 style_co_pilot">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  copilot_newbill_wrapper">
                              <input class="input_blod infocus outfocus co_pilot alphabets_with_space" type="text" id="co_pilot1" placeholder="CO PILOT" name="copilot" autocomplete="off"  data-toggle="popover" data-placement="top">
                              <label id="copilot_lbl"> CO PILOT</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-2 style_cabincrew">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  cabincrew_newbill_wrapper">
                              <input class="input_blod infocus outfocus cabin_crew alphabets_with_space" type="text" id="cabin_crew1" placeholder="CABIN CREW" name="cabincrew" autocomplete="off" >
                              <label id="cabincrew_lbl"> CABIN CREW</label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12 remarkes">
                     <div class="col-md-10 style_remarks">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  remarks_newbill_wrapper">
                              <input class="input_blod infocus outfocus remarks alphabets_with_space" id="remarks1" type="text" placeholder="REMARKS" name="remarks" autocomplete="off">
                              <label id="remarks_lbl">REMARKS</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-2" style="margin-left: -30px;">
                        <button class="btn footer-send btn_send_f01 newbtn mfProgress newbtnv1" style="margin-top:-6px;width:115px !important;" type="submit"><span class="cnt" id="submit_lbl1">SUBMIT</span><span class="loader"></span><span class="msg"></span></button>
                     </div>
                  </div>
                  <div class="col-md-12 place_long">
                     <div class="col-md-3">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  operator_newbill_wrapper">
                              <input class="input_blod infocus outfocus pace_name dept_place" id="dept_place1" type="text" placeholder="DEP.ZZZZ PLACE NAME" name="operator" autocomplete="off" disabled>
                              <label id="operator_lbl">DEP.ZZZZ PLACE NAME</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  operator_newbill_wrapper">
                              <input class="input_blod infocus outfocus pace_name dept_lat" id="dept_lat1" type="text" placeholder="DEP.ZZZZ LAT.LONG" name="operator" autocomplete="off" style="background:#eee;" disabled>
                              <label id="operator_lbl"> DEP.ZZZZ LAT.LONG</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  operator_newbill_wrapper">
                              <input class="input_blod infocus outfocus dest_place" id="dest_place1" type="text" placeholder="DEST.ZZZZ PLACE NAME" name="operator" autocomplete="off" style="background:#eee;" disabled>
                              <label id="operator_lbl"> DEST.ZZZZ PLACE NAME</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  operator_newbill_wrapper">
                              <input class="input_blod infocus outfocus dest_lat" id="dest_lat1" type="text" placeholder="DEST.ZZZZ LAT.LONG" name="operator" autocomplete="off" style="background:#eee;" disabled>
                              <label id="operator_lbl"> DEST.ZZZZ LAT.LONG</label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12" style="margin-top:19px;">
                     <div class="col-md-12 new_heading1">ADDITIONAL INFO</div>
                  </div>
                  <div class="col-md-12 SPEED" style="margin-top:19px;">
                     <div class="col-md-3" style="width:20%;">
                         <div class="ltrim_sec">
                           <div class="group dynamiclabel  SPEEDr_newbill_wrapper">
                              <select id="SPEED_lbl1">
                                 <option value="">SPEED</option>
                                 <option value="100">100</option>
                                 <option value="200">200</option>
                                 <option value="300">300</option>
                                 <option value="400">400</option>
                                 <option value="500">500</option>
                                 <option value="600">600</option>
                              </select>
                           </div>
                        </div> 
                     </div>
                     <div class="col-md-2" style="width:11%;">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  level_newbill_wrapper">
                              <input class="input_blod infocus outfocus level1" id="level11" type="text" placeholder="LEVEL" name="level" autocomplete="off">
                              <label id="level_lbl"> LEVEL</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-7" style="width:69%">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  mainroute_newbill_wrapper">
                              <input class="input_blod infocus outfocus mainroute" id="mainroute1" type="text" placeholder="MAIN ROUTE" name="mainroute" autocomplete="off">
                              <label id="mainroute_lbl">MAIN ROUTE</label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12" style="margin-top:19px;">
                     <div class="col-md-3" style="width:20%;">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  alternate1_newbill_wrapper">
                              <input class="input_blod infocus outfocus alternate1" id="alternate11" type="text" placeholder="ALTERNATE 1" name="alternate1" autocomplete="off">
                              <label id="alternate1_lbl">ALTERNATE 1</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-2" style="width:11%;">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  level_newbill_wrapper">
                              <input class="input_blod infocus outfocus level2" id="level21" type="text" placeholder="LEVEL" name="level" autocomplete="off">
                              <label id="level_lbl"> LEVEL</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-7" style="width:69%">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  alternate1route_newbill_wrapper">
                              <input class="input_blod infocus outfocus alternate1route" id="alternate1route1" type="text" placeholder="ALTERNATE 1 ROUTE" name="alternate1route" autocomplete="off">
                              <label id="alternate1route_lbl">ALTERNATE 1 ROUTE</label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12" style="margin-top:19px;">
                     <div class="col-md-3" style="width:20%;">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  alternate2_newbill_wrapper">
                              <input class="input_blod infocus outfocus alternate2" id="alternate21" type="text" placeholder="ALTERNATE 2" name="alternate2" autocomplete="off">
                              <label id="alternate2_lbl">ALTERNATE 2</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-2" style="width:11%;">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  level_newbill_wrapper">
                              <input class="input_blod infocus outfocus level3" id="level31" type="text" placeholder="LEVEL" name="level" autocomplete="off">
                              <label id="LEVEL_lbl"> LEVEL</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-7" style="width:69%">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  alternate2route_newbill_wrapper">
                              <input class="input_blod infocus outfocus alternate2route" id="alternate2route1" type="text" placeholder="ALTERNATE 2 ROUTE" name="alternate2 route" autocomplete="off">
                              <label id="alternate2route_lbl">ALTERNATE 2 ROUTE</label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12" style="margin-top:19px;">
                     <div class="col-md-3" style="width:20%;">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  take_newbill_wrapper">
                              <input class="input_blod infocus outfocus take_off_alternate" id="take_off_alternate1" type="text" placeholder="TAKE OFF ALTERNATE" name="take" autocomplete="off">
                              <label id="take_lbl">TAKE OFF ALTERNATE</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-2" style="width:11%;">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  level_newbill_wrapper">
                              <input class="input_blod infocus outfocus level4" id="level41" type="text" placeholder="LEVEL" name="level" autocomplete="off">
                              <label id="level_lbl"> LEVEL</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-7" style="margin-bottom: 10px;width:69%;">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  takeoff_newbill_wrapper">
                              <input class="input_blod infocus outfocus takeoff_alternate_route" id="takeoff_alternate_route1" type="text" placeholder=" TAKE OFF ALTERNATE ROUTE" name="takeoff" autocomplete="off">
                              <label id="takeoff_lbl">TAKE OFF ALTERNATE ROUTE</label>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
 @include('includes.new_footer',[])
</div>
<script type="text/javascript">
 

  $(".select ul").click(function(){
     // $(".flightdate").datepicker("destroy");

     var id=$(this).parent().prev().find('span').attr('id');
     var no_of_flight=$("#"+id).text();
     var accordion="";
     var count=1;
     var accordion_length=1;
     var submit_lbl;
     if(no_of_flight>1)
       $("#submit_lbl1").html("NEXT");
     else
       $("#submit_lbl1").html("SUBMIT");
     for(var j=2; j<=6;j++)
     {    
         accordion_length++;
         console.log("no_of_flight="+no_of_flight)
         $("#accord"+accordion_length).remove();   
     }
     for(var i=1; i<=no_of_flight-1;i++)
     {
         if(i==no_of_flight-1)
           submit_lbl='SUBMIT';
         else
           submit_lbl='NEXT';
         count++; 
         accordion=accordion+`<div class="panel panel-default" id="accord${count}" data-slidecount="${count}">
            <div class="panel-heading" role="tab" id="heading_reg${count}">
               <h4 class="panel-title collapsed title_header" role="button" data-toggle="collapse" data-parent="#accordion_reg" href="#collapse_reg${count}" aria-expanded="false" aria-controls="collapse_reg${count}">
                  <a class="title_navlog">
                  NAV LOG ${count}
                  </a>
               </h4>
            </div>
            <div id="collapse_reg${count}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_reg${count}">
               <div class="panel-body">
                  <div class="col-md-12 sub_new_heading">
                     <div class="col-md-1" style="width:13%;margin-top: -2px;">
                            <div class="form-group">
                                <dl id="hour${count}" class="dropdown form-control validation_class_click select" style="height: 26px;padding:5px;"  data-toggle = "popover"  data-placement="top">
                                    <dt><a>
                                            <span style="font-weight:normal;" readonly id="no_of_flight${count}">SELECT</span>
                                        </a>
                                    </dt>
                                    <dd>
                                        <ul >
                                            <li><a>1</a></li>
                                            <li><a>2</a></li>
                                            <li><a>3</a></li>
                                            <li><a>4</a></li>
                                            <li><a>5</a></li>
                                            <li><a>6</a></li> 
                                        </ul>
                                    </dd>
                                </dl>
                            </div>
                     </div>
                     <div class="col-md-1 style_date">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  flightdate_newbill_wrapper">
                              <input id="flight_date${count}" type="text" placeholder="FLIGHT DATE" name="flightdate" autocomplete="off" class="input_blod infocus outfocus ui-datepicker-trigger flightdate" readonly data-toggle="popover" data-placement="top" value={{date('d-M-Y')}}>
                              <label id="flightdate_lbl" style="display: none" >FLIGHT DATE</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-1 style_registration">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  operator_newbill_wrapper">
                              <input  class="input_blod infocus outfocus alphabets callsign" id="callsign${count}" type="text" placeholder="CALLSIGN" name="operator" autocomplete="off" maxlength="7" minlength="5" data-toggle="popover" data-placement="top">
                              <label id="operator_lbl"> CALLSIGN</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-1 style_departure">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel departure_newbill_wrapper">
                              <input class="input_blod infocus outfocus alphabets departure" id="departure${count}" type="text" placeholder="DEPARTURE" name="departure" autocomplete="off"  maxlength="4" minlength="4" data-toggle="popover" data-placement="top">
                              <label id="departure_lbl"> DEPARTURE</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-1 style_destination">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel destination_newbill_wrapper">
                              <input class="input_blod infocus outfocus alphabets destination" id="destination${count}" maxlength="4" minlength="4" type="text" placeholder="DESTINATION" name="destination" autocomplete="off" data-toggle="popover" data-placement="top">
                              <label id="destination_lbl" > DESTINATION</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-1 style_departure_time">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  departure_time_newbill_wrapper">
                              <input class="input_blod infocus outfocus numbers_colon departuretime" id="dept_time${count}" type="text" placeholder="DEP TIME" name="departure_time" autocomplete="off" maxlength="5" data-toggle="popover" data-placement="top">
                              <label id="departure_time_lbl"> DEP TIME</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-1 style_pax">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  pax_newbill_wrapper">
                              <input class="input_blod infocus outfocus numbers pax" id="pax${count}" type="text" placeholder="PAX" name="pax" autocomplete="off" minlength="1" maxlength="3" >
                              <label id="pax_lbl"> PAX</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-1 style_load">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  load_newbill_wrapper">
                              <input class="input_blod infocus outfocus numbers load" id="load${count}" type="text" placeholder="LOAD" name="load" autocomplete="off" minlength="1" maxlength="5">
                              <label id="load_lbl"> LOAD</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-1 style_fuel">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  fuel_newbill_wrapper">
                              <input class="input_blod infocus outfocus numbers fuel" minlength="3" maxlength="5" id="fuel${count}" type="text" placeholder="FUEL" name="fuel" autocomplete="off" minlength="3" maxlength="5">
                              <label id="fuel_lbl"> FUEL</label>
                           </div>
                        </div>
                     </div>
                     <div class="group col-md-1 amountmode_newbill_wrapper style_radio">
                        <div class="col-md-12 sub_radio"><label class="radio-inline">
                           <input class="input_blod" class="style_input_radio" type="radio" name="optradio" style="width:11px;margin-left: -14px;"><span style="font-size: 11px;font-weight: bold;">MIN</span>
                           </label>
                        </div>
                        <div class="col-md-12" style="margin-top: -2px;padding-left: 12px;"><label class="radio-inline">
                           <input class="input_blod" type="radio" name="optradio" style="width:11px;margin-left: -13px;"><span style="font-size: 11px;font-weight: bold;">MAX</span>
                           </label>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12 pilot_in_comm">
                     <div class="col-md-3 style_pilot_in">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  pilot_newbill_wrapper">
                              <input class="input_blod infocus outfocus pilot alphabets_with_space" id="pilot${count}" type="text" placeholder="PILOT IN COMMAND" name="pilot" autocomplete="off" data-toggle="popover" data-placement="top">
                              <label id="pilot_lbl"> PILOT IN COMMAND</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-2 style_mobile">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  mobile_newbill_wrapper">
                              <input class="input_blod infocus outfocus mobile numbers" id="mobile${count}" type="text" placeholder="MOBILE" name="mobile" autocomplete="off" maxlength="10" data-toggle="popover" data-placement="top">
                              <label id="operator_lbl"> MOBILE</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-2 style_co_pilot">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  copilot_newbill_wrapper">
                              <input class="input_blod infocus outfocus co_pilot alphabets_with_space" type="text" id="co_pilot${count}" placeholder="CO PILOT" name="copilot" autocomplete="off"  data-toggle="popover" data-placement="top">
                              <label id="copilot_lbl"> CO PILOT</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-2 style_cabincrew">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  cabincrew_newbill_wrapper">
                              <input class="input_blod infocus outfocus cabin_crew alphabets_with_space" type="text" id="cabin_crew${count}" placeholder="CABIN CREW" name="cabincrew" autocomplete="off" >
                              <label id="cabincrew_lbl"> CABIN CREW</label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12 remarkes">
                     <div class="col-md-10 style_remarks">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  remarks_newbill_wrapper">
                              <input class="input_blod infocus outfocus remarks alphabets_with_space" id="remarks${count}" type="text" placeholder="REMARKS" name="remarks" autocomplete="off">
                              <label id="remarks_lbl">REMARKS</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-2" style="margin-left: -30px;">
                        <button class="btn footer-send btn_send_f01 newbtn mfProgress newbtnv1" style="margin-top:-6px;width:115px !important;" type="submit"><span class="cnt" id="submit_lbl${count}">${submit_lbl}</span><span class="loader"></span><span class="msg"></span></button>
                     </div>
                  </div>
                  <div class="col-md-12 place_long">
                     <div class="col-md-3">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  operator_newbill_wrapper">
                              <input class="input_blod infocus outfocus pace_name dept_place" id="dept_place${count}" type="text" placeholder="DEP.ZZZZ PLACE NAME" name="operator" autocomplete="off" disabled>
                              <label id="operator_lbl">DEP.ZZZZ PLACE NAME</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  operator_newbill_wrapper">
                              <input class="input_blod infocus outfocus pace_name dept_lat" id="dept_lat${count}" type="text" placeholder="DEP.ZZZZ LAT.LONG" name="operator" autocomplete="off" style="background:#eee;" disabled>
                              <label id="operator_lbl"> DEP.ZZZZ LAT.LONG</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  operator_newbill_wrapper">
                              <input class="input_blod infocus outfocus dest_place" id="dest_place${count}" type="text" placeholder="DEST.ZZZZ PLACE NAME" name="operator" autocomplete="off" style="background:#eee;" disabled>
                              <label id="operator_lbl"> DEST.ZZZZ PLACE NAME</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  operator_newbill_wrapper">
                              <input class="input_blod infocus outfocus dest_lat" id="dest_lat${count}" type="text" placeholder="DEST.ZZZZ LAT.LONG" name="operator" autocomplete="off" style="background:#eee;" disabled>
                              <label id="operator_lbl"> DEST.ZZZZ LAT.LONG</label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12" style="margin-top:19px;">
                     <div class="col-md-12 new_heading1">ADDITIONAL INFO</div>
                  </div>
                  <div class="col-md-12 SPEED" style="margin-top:19px;">
                     <div class="col-md-3" style="width:20%;">
                         <div class="ltrim_sec">
                           <div class="group dynamiclabel  SPEEDr_newbill_wrapper">
                              <select id="SPEED_lbl${count}">
                                 <option value="">SPEED</option>
                                 <option value="100">100</option>
                                 <option value="200">200</option>
                                 <option value="300">300</option>
                                 <option value="400">400</option>
                                 <option value="500">500</option>
                                 <option value="600">600</option>
                              </select>
                           </div>
                        </div> 
                     </div>
                     <div class="col-md-2" style="width:11%;">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  level_newbill_wrapper">
                              <input class="input_blod infocus outfocus level1" id="level1${count}" type="text" placeholder="LEVEL" name="level" autocomplete="off">
                              <label id="level_lbl"> LEVEL</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-7" style="width:69%">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  mainroute_newbill_wrapper">
                              <input class="input_blod infocus outfocus mainroute" id="mainroute${count}" type="text" placeholder="MAIN ROUTE" name="mainroute" autocomplete="off">
                              <label id="mainroute_lbl">MAIN ROUTE</label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12" style="margin-top:19px;">
                     <div class="col-md-3" style="width:20%;">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  alternate1_newbill_wrapper">
                              <input class="input_blod infocus outfocus alternate1" id="alternate1${count}" type="text" placeholder="ALTERNATE 1" name="alternate1" autocomplete="off">
                              <label id="alternate1_lbl">ALTERNATE 1</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-2" style="width:11%;">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  level_newbill_wrapper">
                              <input class="input_blod infocus outfocus level2" id="level2${count}" type="text" placeholder="LEVEL" name="level" autocomplete="off">
                              <label id="level_lbl"> LEVEL</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-7" style="width:69%">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  alternate1route_newbill_wrapper">
                              <input class="input_blod infocus outfocus alternate1route" id="alternate1route${count}" type="text" placeholder="ALTERNATE 1 ROUTE" name="alternate1route" autocomplete="off">
                              <label id="alternate1route_lbl">ALTERNATE 1 ROUTE</label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12" style="margin-top:19px;">
                     <div class="col-md-3" style="width:20%;">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  alternate2_newbill_wrapper">
                              <input class="input_blod infocus outfocus alternate2" id="alternate2${count}" type="text" placeholder="ALTERNATE 2" name="alternate2" autocomplete="off">
                              <label id="alternate2_lbl">ALTERNATE 2</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-2" style="width:11%;">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  level_newbill_wrapper">
                              <input class="input_blod infocus outfocus level3" id="level3${count}" type="text" placeholder="LEVEL" name="level" autocomplete="off">
                              <label id="LEVEL_lbl"> LEVEL</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-7" style="width:69%">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  alternate2route_newbill_wrapper">
                              <input class="input_blod infocus outfocus alternate2route" id="alternate2route${count}" type="text" placeholder="ALTERNATE 2 ROUTE" name="alternate2 route" autocomplete="off">
                              <label id="alternate2route_lbl">ALTERNATE 2 ROUTE</label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12" style="margin-top:19px;">
                     <div class="col-md-3" style="width:20%;">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  take_newbill_wrapper">
                              <input class="input_blod infocus outfocus take_off_alternate" id="take_off_alternate${count}" type="text" placeholder="TAKE OFF ALTERNATE" name="take" autocomplete="off">
                              <label id="take_lbl">TAKE OFF ALTERNATE</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-2" style="width:11%;">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  level_newbill_wrapper">
                              <input class="input_blod infocus outfocus level4" id="level4${count}" type="text" placeholder="LEVEL" name="level" autocomplete="off">
                              <label id="level_lbl"> LEVEL</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-7" style="margin-bottom: 10px;width:69%;">
                        <div class="ltrim_sec">
                           <div class="group dynamiclabel  takeoff_newbill_wrapper">
                              <input class="input_blod infocus outfocus takeoff_alternate_route" id="takeoff_alternate_route${count}" type="text" placeholder=" TAKE OFF ALTERNATE ROUTE" name="takeoff" autocomplete="off">
                              <label id="takeoff_lbl">TAKE OFF ALTERNATE ROUTE</label>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
          </div>`;
      }
     $("#accordion_reg").append(accordion);
     $(".flightdate").datepicker({
         dateFormat: 'd-M-yy',
         minDate: 0, 
         howOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true,
         onSelect: function(selectedDate) 
         {   
             $(".notify-bg-v").fadeOut();
         }
     });
  });
 function errorPopover(id, message) {
       $(id).css({"border-color": "red"});
       $(id).attr('data-content', message);   
   }
   function closePopover(id) {
       $(id).css({"border-color": "#a6a6a6"});
       $(this).next().css('display','none');
   }
  $(document).on("keyup",".callsign",function(e){  
      if($(this).val().length == 5 || $(this).val().length == 7)
      { 
          $(this).parents('.panel').find('.departure').focus();
          closePopover("#"+$(this).parents('.panel').find('.callsign').attr('id'));
      }  
  });
  $(document).on("keyup",".departure",function(e){    
      if($(this).val().length == 4)
      { 
          closePopover("#"+$(this).attr('id'));
          if($(this).val()=="ZZZZ")
          {
            $(this).parents('.panel').find('.dept_place').attr('disabled',false).focus();
            $(this).parents('.panel').find('.dept_lat').attr('disabled',false);
          }
          else
          {  
             $(this).parents('.panel').find('.dept_place').val('').attr('disabled',true)
             $(this).parents('.panel').find('.dept_lat').val('').attr('disabled',true) 
             $(this).parents('.panel').find('.destination').focus();
          }
      }  
  });
  $(document).on("keyup",".destination",function(e){   
      if($(this).val().length ==4)
      {   
          closePopover("#"+$(this).attr('id'));
          if($(this).val()=="ZZZZ")
          {
            $(this).parents('.panel').find('.dest_place').attr('disabled',false).focus();
            $(this).parents('.panel').find('.dest_lat').attr('disabled',false);
          }
          else
          { 
             $(this).parents('.panel').find('.dest_place').val('').attr('disabled',true)
             $(this).parents('.panel').find('.dest_lat').val('').attr('disabled',true) 
             $(this).parents('.panel').find('.departuretime').focus();
          }
      }  
  });
   $(document).on("keyup",".pax",function(e){ 
      if($(this).val().length ==3)
      {   
        $(this).parents('.panel').find('.load').focus();
      }  
  });
  $(document).on("keyup",".load",function(e){  
      if($(this).val().length ==5)
      {   
        $(this).parents('.panel').find('.fuel').focus();
      }  
  });
  $(document).on("change","input:radio",function(e){    
        $(this).parents('.style_radio').prev().find('.fuel').val('');
  });       
    $(document).on("blur",".fuel",function(e){  
      if($(this).val() !="")
      {
        $(this).parents('.style_fuel').next().find('input[name=optradio]').attr('checked',false);
      }
  });  
  $(document).on("keyup",".pilot",function(e){  
      if($(this).val().length>2)
      {   
          closePopover("#"+$(this).attr('id'));
      }  
  })     
   $(document).on("keyup",".mobile",function(e){
      if($(this).val().length==10)
      {   
          closePopover("#"+$(this).attr('id'));
      }  
  })     
  $(document).on("keyup",".co_pilot",function(e){
      if($(this).val().length>2)
      {   
          closePopover("#"+$(this).attr('id'));
      }  
  })     
  $(document).on("keypress",".alphabets",function(e)
  {
         if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode==0))
         return true;
         else
         return false; 
  });
  $(document).on("keypress",".alphabets_with_space",function(e){
          if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode==0)|| (e.charCode==32))
          return true;
          else
          return false; 
  });
  $(document).on("keypress",".numbers_colon",function(e){  
        if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 32 && e.charCode <= 47) || (e.charCode > 58 && e.charCode <= 64) || (e.charCode >= 91 && e.charCode <= 96)|| (e.charCode >= 123 && e.charCode <= 127))
        return false;
        else
        return true;    
 });
 $(document).on("keypress",".numbers",function(e){   
    if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 32 && e.charCode <= 47) || (e.charCode >= 58 && e.charCode <= 64) || (e.charCode >= 91 && e.charCode <= 96)|| (e.charCode >= 123 && e.charCode <= 127))
      return false;
        else
      return true;    
 });
 
  // $(".flightdate").datepicker({ 
  //       showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true,
  //    });
  // $(document).on("focus", ".flightdate", function(){
      //  $(this).datepicker({ 
    $(".flightdate").datepicker({
         dateFormat: 'd-M-yy',
         minDate: 0, 
         howOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true,
         onSelect: function(selectedDate) 
         {   
             $(".notify-bg-v").fadeOut();
         }
     });
  $('body').on('keyup', '.departuretime',function (){  
    var dep_time_length=$(this).val().length;
    if(dep_time_length==2 && event.keyCode!=8)
    {
      var dep_time=$(this).val().substring(0,2)+':';
       $(this).val(dep_time);  
    }
    if(dep_time_length==5)
     {
        closePopover("#"+$(this).attr('id'));
       $(this).parents('.panel').find('.pax').focus();
     }
  });
    $('body').on('focusin', '.infocus',function (){    
        if($(this).attr('id')=='flight_date')
          $(this).next().next().css('display','block');
        else  
        $(this).next().css('display','block');
    });
     $('body').on('focusout', '.outfocus',function (){      
        if($(this).attr('id')=='flight_date')
          $(this).next().next().css('display','none');
        else
        $(this).next().css('display','none');
    });
    $(".ui-datepicker-trigger").click(function () {
            $(".notify-bg-v").fadeIn();
            $('.notify-bg-v').css('height', $(document).height());
        });
//     $( "#accordion_reg" ).accordion({
//   collapsible: true
// });
    $('body').on('click', '.btn_send_f01',function (){
 
        //$( "#accordion_reg" ).accordion( "option", "collapsible", true );

        var flight_date=$(this).parents('.panel').find('.flightdate').val();
        var callsign=$(this).parents('.panel').find('.callsign').val();
        var departure=$(this).parents('.panel').find('.departure').val();
        var destination=$(this).parents('.panel').find('.destination').val();
        var departuretime=$(this).parents('.panel').find('.departuretime').val();
        var pax=$(this).parents('.panel').find('.pax').val();
        var load=$(this).parents('.panel').find('.load').val();
        var fuel=$(this).parents('.panel').find('.fuel').val();
        var pilot=$(this).parents('.panel').find('.pilot').val();
        var mobile=$(this).parents('.panel').find('.mobile').val();
        var co_pilot=$(this).parents('.panel').find('.co_pilot').val();
        var cabin_crew=$(this).parents('.panel').find('.cabin_crew').val();
        var remarks=$(this).parents('.panel').find('.remarks').val();
        var dept_place=$(this).parents('.panel').find('.dept_place').val();
        var dept_lat=$(this).parents('.panel').find('.dept_lat').val();
        var dest_place=$(this).parents('.panel').find('.dest_place').val();
        var dest_lat=$(this).parents('.panel').find('.dest_lat').val();
        var level1=$(this).parents('.panel').find('.level1').val();
        var mainroute=$(this).parents('.panel').find('.mainroute').val();
        var alternate1=$(this).parents('.panel').find('.alternate1').val();
        var level2=$(this).parents('.panel').find('.level2').val();
        var alternate1route=$(this).parents('.panel').find('.alternate1route').val();
        var alternate2=$(this).parents('.panel').find('.alternate2').val();
        var level3=$(this).parents('.panel').find('.level3').val();
        var alternate2route=$(this).parents('.panel').find('.alternate2route').val();
        var take_off_alternate=$(this).parents('.panel').find('.take_off_alternate').val();
        var level4=$(this).parents('.panel').find('.level4').val();
        var takeoff_alternate_route=$(this).parents('.panel').find('.takeoff_alternate_route').val();
        console.log('flight_date='+flight_date+'callsign='+callsign+'departure='+departure+'destination='+destination+'departuretime='+departuretime+'pax='+pax+'load='+load+'fuel='+fuel+'pilot='+pilot+'mobile='+mobile+'co_pilot='+co_pilot+'cabin_crew='+cabin_crew+'remarks='+remarks+'dept_place='+dept_place+'dept_lat='+dept_lat+'dest_place='+dest_place+'dest_lat='+dest_lat+'level1='+level1+'mainroute='+mainroute+'alternate1='+alternate1+'level2='+level2+'alternate1route='+alternate1route+'alternate2='+alternate2+'level3='+level3+'alternate2route='+alternate2route+'level4='+level4+'takeoff_alternate_route='+takeoff_alternate_route);
        var bool=true;
        if(flight_date=="")
        {
            errorPopover('#'+$(this).parents('.panel').find('.flight_date').attr('id'));
            bool=false;
        }
        if(callsign=="" || callsign.length<5)
        {
            errorPopover('#'+$(this).parents('.panel').find('.callsign').attr('id'));
            bool=false;
        }
        if(departure=="" || departure.length<4)
        {
           
           console.log($(this).parents('.panel').find('.departure').attr('id'));
            errorPopover('#'+$(this).parents('.panel').find('.departure').attr('id'));
            bool=false;
        }
        if(destination=="" || destination.length<4)
        {
            errorPopover('#'+$(this).parents('.panel').find('.destination').attr('id'));
            bool=false;
        }
        if(departuretime=="")
        {
            errorPopover('#'+$(this).parents('.panel').find('.departuretime').attr('id'));
            bool=false;
        }
        if(pilot=="")
        {
            errorPopover('#'+$(this).parents('.panel').find('.pilot').attr('id'));
            bool=false;
        }
        if(mobile=="" || mobile.length !=10)
        {
            errorPopover('#'+$(this).parents('.panel').find('.mobile').attr('id'));
            bool=false;
        }
        if(co_pilot=="")
        {
            errorPopover('#'+$(this).parents('.panel').find('.co_pilot').attr('id'));
            bool=false;
        }
        if(bool==false)
           return false;  
         if(bool==true)
         {
            var $accord_count=$(this).parents('.panel').attr('data-slidecount');
            $("#accordion_reg").children(":last").trigger( "collapse" );
            //$('#accordion_reg #accord1'+$accord_count++).slideDown();
         }
    });
</script>
@stop
