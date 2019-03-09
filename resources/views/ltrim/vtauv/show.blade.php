@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@push('css')
<link rel="stylesheet" type="text/css" href="{{url('app/css/ltrim/vtssf.css')}}">
<style>
.jump_box {font-size: 14px;border: 1px solid #999;padding-top: 8px;padding-left: 4px; border-radius: 4px;line-height: 1.2; width: 100%;box-shadow: inset 0 1px 1px rgba(0,0,0,.075);height: 34px;}
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


 	.cust-container{
 		width:930px;
 	  background: #fff;
      margin: 15px auto;
      padding: 15px;
      font-family:arial,sans-serif;
 	}
 	.sec_fly{
 		text-align: center;
 		font-size: 18px;
 		padding: 10px 0px;
 		text-transform: uppercase; 
 		font-weight: bold; 
 		padding-bottom: 0;
 		border: 2px solid #333;
 	}
 	.sec_shee{
 		padding-left: 86px;
 		font-size: 16px;
 		margin-top: 10px;
 		margin-bottom: 3px;

 	}
 	.p-lr-0{
 		padding-right: 0;
 		padding-left: 0;
 	}
 	.mar-lr{
 		margin-left: 0px;
 		margin-right: 0px;
 	}
 	.sec_air-cr>thead>tr>th{
 		border: 2px solid #333;
 		text-align: center;
     font-size: 13px;
      	}
    .sec_air-cr>tbody>tr>td{
      padding: 0px;
      font-size: 13px;
        border: 1px solid #333;
        text-align: center;
    }
    .sec_page div{
      font-size: 14px;
      border:1px solid #333;
      padding: 2px; 
    }
    .download-parent{
        position: relative;
            width: auto;
    float: right;
    cursor: pointer;
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
    left: -25px;
    background: #333;
    color: #fff;
    top: -28px;
    padding: 3px;
    font-size: 10px;
    border-radius: 3px;
    cursor: default;
    text-transform: uppercase;
</style>
@endpush

@section('content')
<div class="page">
<?php //var_dump($from);?>
    @include('includes.new_header',[])
    <main>
          <div class="container ltim_container">
          
           <div class="ltrim_sec">
           <div class="row"><div class="col-md-12 p-lr-0"><p class="vtobr_heading" style="text-transform: uppercase;">{{$call_sign}}</p></div></div>
            <form action='{{url('lnt/vtauv')}}' method='POST' id="vtauvform">
                <div class="row">
                <input type="hidden" class="form-control" value="1" name="post">
                    <div class="col-md-12 p-lr-0">
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control" placeholder="call sign" value="{{$call_sign}}" style="text-transform: uppercase;" readonly>
                                <label>call sign</label>
                            </div>
                        </div>
                        <div class="col-md-1 p-l-0">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets clear" placeholder="from" name="from" id="from" autocomplete="off" data-toggle="popover" data-placement="top" data-toggle="popover" data-placement="top" data-toggle="popover" data-placement="top" value="{{$from}}" disabled>
                                <label>from</label>
                            </div>
                        </div>
                        <div class="col-md-1 p-l-0">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets clear" placeholder="to"   name="to" id='to' autocomplete="off" data-toggle="popover" data-placement="top" data-toggle="popover" data-placement="top" data-toggle="popover" data-placement="top" value="{{$to}}" disabled>
                                <label>to</label>
                            </div>
                        </div>
                        {!! csrf_field() !!}
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control datepicker1 clear"  id="select_date" name="date" autocomplete="off" readonly value="{{$date}}">
                                <img class="ui-datepicker-trigger" src="{{url('media/ananth/images/calender-icon1.png')}}" alt="..." title="...">
                                <label>date</label>
                            </div>
                        </div>
                        <div class="col-md-5" style="margin-bottom:15px;padding-right: 0;width:25%;margin-top: -8px;">                         
                            <div class="form-group dynamiclabel" style="font-size: 12px;line-height: 0;">
                                <div class="col-md-4 p-r-0 "><input class="clear" type="checkbox" name="pax[0]" value="170" @if(array_key_exists("weight",$paxs[0])) {{'checked'}} @endif disabled>PAX 1</div>
                                <div class="col-md-4 p-r-0 "><input class="clear" type="checkbox" name="pax[1]" value="170"  @if(array_key_exists("weight",$paxs[1])) {{'checked'}} @endif disabled>PAX 2</div>
                                <div class="col-md-4 p-r-0 "><input class="clear" type="checkbox" name="pax[2]" value="170"  @if(array_key_exists("weight",$paxs[2])) {{'checked'}} @endif disabled>PAX 3</div>
                                <div class="col-md-4 p-r-0 "><input class="clear" type="checkbox" name="pax[3]" value="170"  @if(array_key_exists("weight",$paxs[3])) {{'checked'}} @endif disabled>PAX 4</div>
                                <div class="col-md-4 p-r-0 "><input class="clear" type="checkbox" name="pax[4]" value="170"  @if(array_key_exists("weight",$paxs[4])) {{'checked'}} @endif disabled>PAX 5</div>
                                <div class="col-md-4 p-r-0 "><input class="clear" type="checkbox" name="pax[5]" value="170"  @if(array_key_exists("weight",$paxs[5])) {{'checked'}} @endif disabled>PAX 6</div>
                                <div class="col-md-4 p-r-0 "><input class="clear" type="checkbox" name="pax[6]" value="170"  @if(array_key_exists("weight",$paxs[6])) {{'checked'}} @endif disabled>PAX 7</div>
                                <div class="col-md-4 p-r-0 "><input class="clear" type="checkbox" name="pax[7]" value="170"  @if(array_key_exists("weight",$paxs[7])) {{'checked'}} @endif disabled>PAX 8</div>
                                <div class="col-md-4 p-r-0 "><input class="clear" type="checkbox" name="pax[8]" value="170"  @if(array_key_exists("weight",$paxs[8])) {{'checked'}} @endif disabled>PAX 9</div>
                                
                            </div>
                         </div>
                         <div class="col-md-3">
                             <div class="form-group">
                                 <div class="jump_box">
                                     <label style="padding-right: 8px;">Jump</label>
                                     <input type="radio" name="jump" value="170" class="jump clear"  @if($jump['weight']=='170')) {{'checked'}} @endif disabled> Yes 
                                     <input type="radio" name="jump" value="0" class="jump clear"  @if($jump['weight']=='0') {{'checked'}} @endif disabled> No
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-3">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers_with_decimal clear" placeholder="Potable Water" name="portable_water" id='portable_water' autocomplete="off"  data-toggle="popover" data-placement="top" value="{{$potable_water['weight']}}" disabled>
                                <label for="portable_water">Potable Water</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers_with_decimal clear" placeholder="Catering Allowance" name="catering_allowance" id='catering_allowance' autocomplete="off"  data-toggle="popover" data-placement="top" value="{{$catering_allowance['weight']}}" disabled>
                                <label for="catering_allowance">Catering Allowance</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers_with_decimal clear" placeholder="Toilet Charge" name="toilet_charge" id='toilet_charge' autocomplete="off"  data-toggle="popover" data-placement="top" value="{{$toilet_charge['weight']}}" disabled>
                                <label for="toilet_charge">Toilet Charge</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers_with_decimal clear" placeholder="Life Raft" name="life_raft" id='life_raft' autocomplete="off"  data-toggle="popover" data-placement="top" value="{{$lift_raft['weight']}}" disabled>
                                <label for="life_raft">Life Raft</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers clear" placeholder="Baggage" name="baggage" id='baggage' autocomplete="off"  data-toggle="popover" data-placement="top" value="{{$baggage['weight']}}" disabled>
                                <label for="total_fuel">Baggage</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers clear" placeholder="Take Off Fuel" name="take_off_fuel" id='take_off_fuel_vtauv' autocomplete="off"  data-toggle="popover" data-placement="top" value="{{$take_off_fuel}}" disabled>
                                <label for="total_fuel">Take Off Fuel</label>
                              </div>
                            </div>
                              <div class="col-md-3">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers clear" placeholder="Block Fuel" name="block_fuel" id='block_fuel' autocomplete="off"  data-toggle="popover" data-placement="top" value="{{$block_fuel['weight']}}" disabled>
                                <label for="block_fuel">Block Fuel</label>
                              </div>
                            </div>
                            
                        <div class="col-md-4" style="width:25%;">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets_with_space clear" placeholder="pilot name"  name="pilot" id="pilot" style="text-transform: uppercase;" autocomplete="off" data-toggle="popover" data-placement="top" data-toggle="popover" data-placement="top" value="{{$pilot}}" disabled>
                                <label>pilot name</label>
                            </div>
                        </div>
                        <div class="col-md-4" style="width: 25%;">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets_with_space clear" placeholder="co pilot name"  name="co_pilot" id="co_pilot" style="text-transform: uppercase;" autocomplete="off" data-toggle="popover" data-placement="top" data-toggle="popover" data-placement="top" value="{{$co_pilot}}" disabled>
                                <label>Co pilot name</label>
                            </div>
                        </div>
                    <div class="col-md-12 p-lr-0">
                        <div class="col-md-2">  
                          <button type="submit" class="form-control newbtnv1">Submit</button></div>
                        </div>
                    </div>
                  </div>
                </div>
               </form> 
             </div>
            </div>
        <div class="container cust-container">
        <div class="download_img download-parent">
           <a href="{{url('ltrimpdf/vtauv')}}"> <img id="graph_print" class="pull-right" src="{{url('media/images/download-all.png')}}" style="cursor: pointer;margin-right: 11px;margin-bottom: 10px;"></a>
           <div class="tooltip-download">Download</div>
        </div>
        	<div class="row mar-lr">
        		<div class="col-md-12 sec_fly p-lr-0">
        			<p>FLY-BY-WIRE INTERNATIONAL PVT. LTD.</p>
        			<P class="sec_shee">LOAD AND TRIM SHEET</P>
        		</div>
        		<div class="col-md-12  p-lr-0">
   					<table class="table" style="margin-bottom: 0px;">
   						<tbody>
   							<tr style="font-size: 14px;">
   							<td><span style="font-weight: bold;">Aircraft Type:</span> CL 600-2B16(605) </td>
   							<td style="font-weight: bold;">AIRCRAFT REGN: VT-AUV</td>
   							<td style="font-weight: bold;">MSN: 5706 </td>
   							</tr>
   						</tbody>
   					</table>
   					
        		</div>
        		<div class="col-md-12 p-lr-0">
        			<table class="sec_air-cr table table-bordered" style="margin-bottom: 2px;">
        				<thead>
        				<tr style="background:#ccc;font-weight:bold;font-size: 14px;border-top: 2PX solid #333">
                        <th style="padding-left: 5px;padding-right: 5px;width:5% ">
                        </th>
                        <th style="text-align: center;width: 40%;">
                        ITEM
                        </th>
                        <th style="width: 20%;">WEIGHT (LBS)</th>
                        <th style="width: 10%;">ARM (INCH)</th>
                        <th style="width: 20%;">MOMENT/1000 (LBS.INCH)</th>
                         <th style="width: 5%;">CG</th>
                      </tr>
        				</thead>
                <tbody>
                  <tr>
                    <td style="padding:2px;font-weight: bold;">A</td>
                    <td style="text-align: left;padding:2px; ">BASIC EMPTY WEIGHT</td>
                    <td>{{sprintf('%.2f',$empty_weight['weight'])}}</td>
                    <td>{{sprintf('%.2f',$empty_weight['arm'])}}</td>
                    <td>{{$empty_weight['moment']}}</td>
                    <td style="border-bottom:0px;"></td>
                  </tr>
                  <tr>
                    <td style="padding:2px;font-weight: bold;">B</td>
                    <td style="text-align: left;padding:2px; "> CREW</td>
                    <td>{{sprintf('%.2f',$pilot_co_pilot['weight'])}}</td>
                    <td>{{sprintf('%.2f',$pilot_co_pilot['arm'])}}</td>
                    <td>{{$pilot_co_pilot['moment']}}</td>
                     <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="padding:2px;font-weight: bold;">C</td>
                    <td style="text-align: left;padding:2px; ">JUMP SEAT</td>
                    <td>{{sprintf('%.2f',$jump['weight'])}}</td>
                    <td>{{sprintf('%.2f',$jump['arm'])}}</td>
                    <td>{{sprintf('%.2f',$jump['moment'])}}</td>
                     <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr>
                  <tr >
                    <td style="padding:2px;font-weight: bold;">D</td>
                    <td style="text-align: left;padding:2px;font-weight: bold; ">Removable items</td>
                     <td style="background:#555 "></td>
                    <td style="background:#555 "></td>
                    <td style="background:#555 "></td>
                     <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">1</td>
                    <td style="text-align: left;padding:2px; ">POTABLE WATER (83.29 LBS MAX)</td>
                    <td>{{sprintf('%.2f',$potable_water['weight'])}}</td>
                    <td>{{sprintf('%.2f',$potable_water['arm'])}}</td>
                    <td>{{sprintf('%.2f',$potable_water['moment'])}}</td>
                     <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">2</td>
                    <td style="text-align: left;padding:2px; ">CATERING ALLOWANCE (175 LBS MAX)</td>
                    <td>{{sprintf('%.2f',$catering_allowance['weight'])}}</td>
                    <td>{{sprintf('%.2f',$catering_allowance['arm'])}}</td>
                    <td>{{sprintf('%.2f',$catering_allowance['moment'])}}</td>
                     <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">3</td>
                    <td style="text-align: left;padding:2px; ">TOILET CHARGE (18.52 LBS MAX)</td>
                    <td>{{sprintf('%.2f',$toilet_charge['weight'])}}</td>
                    <td>{{sprintf('%.2f',$toilet_charge['arm'])}}</td>
                    <td>{{sprintf('%.2f',$toilet_charge['moment'])}}</td>
                     <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">4</td>
                    <td style="text-align: left;padding:2px; ">LIFE RAFT (131.00 LBS, QTY 2)</td>
                    <td>{{sprintf('%.2f',$lift_raft['weight'])}}</td>
                    <td>{{sprintf('%.2f',$lift_raft['arm'])}}</td>
                    <td>{{sprintf('%.2f',$lift_raft['moment'])}}</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="padding:2px;font-weight: bold;">E</td>
                    <td style="text-align: left;padding:2px;font-weight: bold; ">DRY OPERATING WEIGHT</td>
                    <td>{{sprintf('%.2f',$dry_os['weight'])}}</td>
                    <td>{{sprintf('%.2f',$dry_os['arm'])}}</td>
                    <td>{{sprintf('%.2f',$dry_os['moment'])}}</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="padding:2px;font-weight: bold">F</td>
                    <td style="text-align: left;padding:2px;font-weight: bold ">Passengers</td>
                    <td style="background:#555 "></td>
                    <td style="background:#555 "></td>
                    <td style="background:#555 "></td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">1</td>
                    <td style="text-align: left;padding:2px; ">AFT FACING SEAT (SEAT #4)</td>
                    <td>@if(array_key_exists("weight",$paxs[0])) {{sprintf('%.0f',$paxs[0]['weight'])}} @else 0 @endif</td>
                    <td>{{sprintf('%.2f',$paxs[0]['arm'])}}</td>
                    <td>@if(array_key_exists("moment",$paxs[0])) {{sprintf('%.2f',$paxs[0]['moment'])}} @else 0 @endif</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">2</td>
                    <td style="text-align: left;padding:2px; ">AFT FACING SEAT (SEAT #5)</td>
                    <td>@if(array_key_exists("weight",$paxs[1])) {{sprintf('%.0f',$paxs[1]['weight'])}} @else 0 @endif</td>
                    <td>{{sprintf('%.2f',$paxs[1]['arm'])}}</td>
                    <td>@if(array_key_exists("moment",$paxs[8])) {{sprintf('%.2f',$paxs[1]['moment'])}} @else 0 @endif</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">3</td>
                    <td style="text-align: left;padding:2px; ">FWD FACING SEAT (SEAT #6)</td>
                    <td>@if(array_key_exists("weight",$paxs[2])) {{sprintf('%.0f',$paxs[2]['weight'])}} @else 0 @endif</td>
                    <td>{{sprintf('%.2f',$paxs[2]['arm'])}}</td>
                    <td>@if(array_key_exists("moment",$paxs[8])) {{sprintf('%.2f',$paxs[2]['moment'])}} @else 0 @endif</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">4</td>
                    <td style="text-align: left;padding:2px; ">FWD FACING SEAT (SEAT #7)</td>
                    <td>@if(array_key_exists("weight",$paxs[3])) {{sprintf('%.0f',$paxs[3]['weight'])}} @else 0 @endif</td>
                    <td>{{sprintf('%.2f',$paxs[3]['arm'])}}</td>
                    <td>@if(array_key_exists("moment",$paxs[8])) {{sprintf('%.2f',$paxs[3]['moment'])}} @else 0 @endif</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">5</td>
                    <td style="text-align: left;padding:2px; ">AFT FACING SEAT (SEAT #8)</td>
                    <td>@if(array_key_exists("weight",$paxs[4])) {{sprintf('%.0f',$paxs[4]['weight'])}} @else 0 @endif</td>
                    <td>{{sprintf('%.2f',$paxs[4]['arm'])}}</td>
                    <td>@if(array_key_exists("moment",$paxs[8])) {{sprintf('%.2f',$paxs[4]['moment'])}} @else 0 @endif</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">6</td>
                    <td style="text-align: left;padding:2px; ">FWD FACING SEAT (SEAT#9)</td>
                    <td>@if(array_key_exists("weight",$paxs[5])) {{sprintf('%.0f',$paxs[5]['weight'])}} @else 0 @endif</td>
                    <td>{{sprintf('%.2f',$paxs[5]['arm'])}}</td>
                    <td>@if(array_key_exists("moment",$paxs[8])) {{sprintf('%.2f',$paxs[5]['moment'])}} @else 0 @endif</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">7</td>
                    <td style="text-align: left;padding:2px; ">DIVAN SEAT (SEAT #10)</td>
                    <td>@if(array_key_exists("weight",$paxs[6])) {{sprintf('%.0f',$paxs[6]['weight'])}} @else 0 @endif</td>
                    <td>{{sprintf('%.2f',$paxs[6]['arm'])}}</td>
                    <td>@if(array_key_exists("moment",$paxs[8])) {{sprintf('%.2f',$paxs[6]['moment'])}} @else 0 @endif</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">8</td>
                    <td style="text-align: left;padding:2px; ">DIVAN SEAT (SEAT #11)</td>
                    <td>@if(array_key_exists("weight",$paxs[7])) {{sprintf('%.0f',$paxs[7]['weight'])}} @else 0 @endif</td>
                    <td>{{sprintf('%.2f',$paxs[7]['arm'])}}</td>
                    <td>@if(array_key_exists("moment",$paxs[8])) {{sprintf('%.2f',$paxs[7]['moment'])}} @else 0 @endif</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">9</td>
                    <td style="text-align: left;padding:2px; ">DIVAN SEAT (SEAT #12)</td>
                   <td>@if(array_key_exists("weight",$paxs[8])) {{sprintf('%.0f',$paxs[8]['weight'])}} @else 0 @endif</td>
                    <td>{{sprintf('%.2f',$paxs[8]['arm'])}}</td>
                    <td>@if(array_key_exists("moment",$paxs[8])) {{sprintf('%.2f',$paxs[8]['moment'])}} @else 0 @endif</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="padding:2px;font-weight: bold;">G</td>
                    <td style="text-align: left;padding:2px; ">BAGGAGE (MAX 900 LBS)</td>
                    <td>{{$baggage['weight']}}</td>
                    <td>{{$baggage['arm']}}</td>
                    <td>{{$baggage['moment']}}</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr>
                  <tr style="background: #ccc;font-weight: bold;font-style: italic; ">
                    <td style="padding:2px;">H</td>
                    <td style="text-align: left;padding:2px; ">Zero Fuel weight (32000lbs max) (A+B+C+D+E)</td>
                    <td>{{$zero_fuel_weight['weight']}}</td>
                    <td></td>
                    <td>{{$zero_fuel_weight['moment']}}</td>
                    <td style="border-bottom:0px;border-top: 0px;background:#fff;"></td>
                  </tr><tr>
                    <td style="padding:2px;"></td>
                    <td style="text-align: left;padding:2px; ">MAIN TANK</td>
                    <td>{{$tank['main_tank_weight']}}</td>
                    <td style="background: #555;"></td>
                    <td>{{$tank['main_tank_moment']}}</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="padding:2px;"></td>
                    <td style="text-align: left;padding:2px; ">AUX TANK</td>
                    <td>{{$tank['aux_tank_weight']}}</td>
                    <td style="background: #555;"></td>
                    <td>{{$tank['aux_tank_moment']}}</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="padding:2px;"></td>
                    <td style="text-align: left;padding:2px; ">TAIL TANK</td>
                    <td>{{$tank['tail_tank_weight']}}</td>
                    <td style="background: #555;"></td>
                    <td>{{$tank['tail_tank_moment']}}</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="padding:2px;font-weight: bold;">I</td>
                    <td style="text-align: left;padding:2px; ">TOTAL</td>
                    <td style="font-weight: bold;">{{$take_off_fuel}}</td>
                    <td style="background: #555;"></td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr>
                  <tr style="background: #ccc;font-weight: bold;font-style: italic;">
                    <td style="padding:2px;">J</td>
                    <td style="text-align: left;padding:2px; ">Ramp weight (48300 lbs max) (F + Fuel)</td>
                    <td>{{$ramp_weight['weight']}}</td>
                    <td></td>
                    <td>{{$ramp_weight['moment']}}</td>
                    <td style="border-bottom:0px;border-top: 0px;background: #fff;"></td>
                  </tr><tr>
                    <td style="padding:2px;font-weight: bold;">K</td>
                    <td style="text-align: left;padding:2px; ">Taxi-Out Fuel</td>
                    <td>{{$taxi_out_fuel['weight']}}</td>
                    <td style="background: #555;"></td>
                    <td>{{$taxi_out_fuel['moment']}}</td>
                    <td style="font-weight: bold;">CG</td>
                    
                  </tr>
                  <tr style="background: #ccc;font-weight: bold;font-style: italic;">
                    <td style="padding:2px;">L</td>
                    <td style="text-align: left;padding:2px;background: #fff; ">Take-off weight (48200 lbs max) (G - Taxi out Fuel)</td>
                   <td>{{$take_off_weight['weight']}}</td>
                    <td>{{$take_off_weight['arm']}}</td>
                    <td>{{$take_off_weight['moment']}}</td>
                    <td style="font-weight: bold;">{{$cg_tof_wt}}</td>

                  </tr><tr>
                    <td style="padding:2px;font-weight: bold;text-align:center; ">M</td>
                    <td style="text-align: left;padding:2px; ">Fuel  to Destination/ ApproachT</td>
                    <td>{{$block_fuel['weight']}}</td>
                    <td style="background: #555;"></td>
                    <td>{{$block_fuel['moment']}}</td> 
                    <td></td>
                  </tr>
                  <tr style="background: #ccc;font-weight: bold;font-style: italic;">
                    <td style="padding:2px;text-align:center; ">N</td>
                    <td style="text-align: left;padding:2px; ">Landing Weight (38000 lbs max)</td>
                     <td>{{$landing_weight['weight']}}</td>
                    <td>{{$landing_weight['arm']}}</td>
                    <td>{{$landing_weight['moment']}}</td>
                    <td style="font-weight: bold;">{{$cg_land_wt}}</td>
                  </tr><tr>
                    <td style="padding:2px;font-weight: bold;text-align:center; ">O</td>
                    <td style="text-align: left;padding:2px; ">Diversion Fuel</td>
                    <td>{{$diversion_fuel['weight']}}</td>
                    <td style="background: #555;"></td>
                    <td>{{$diversion_fuel['moment']}}</td>
                    <td style="border-bottom: 0px;"></td>
                  </tr>
                  <tr style="background: #ccc;font-weight: bold;">
                    <td style="padding:2px;font-style: italic;text-align:center; ">P</td>
                    <td style="text-align: left;padding:2px; ">Landing weight at alternate</td>
                    <td>{{$landing_fuel_alternate['weight']}}</td>
                    <td>{{$landing_fuel_alternate['arm']}}</td>
                    <td>{{$landing_fuel_alternate['moment']}}</td>
                    <td style="border-top: 0px;background: #fff;"></td>
                  </tr>
                </tbody>
        			</table>
        		</div>
            <div class="sec_page">
              <div class="col-md-12 p-lr-0" style="border-bottom:1px solid #333; ">
                <p>IT IS CERTIFIED THAT THE CG FALLS WITHIN THE ENVELOPE AS PER THE GRAPH IN CL-604 WEIGHT & BALANCE MANUAL FIGURE 5 ON PAGE NO.64.</p>
                <p>NO.64.
                   SIGNATURE OF THE PIC.____________________  ALTP NO. _______________________ DATE: ____________________________</p>
                </div>
                <div class="col-md-12 p-lr-0">
                  <p>* Note: Total Dry Operating Weight will vary as per the weight of person on Jump Seat,Catering Allowance and Life Raft on board    Note 2: Diversion Fuel should be taken as per CAR Section 8 Series Ó'Part-II   Note 3:  Std Wt of pax as per Op Manual Issue:1 Rev:0 dated 07.04.2015 are Crew: 187 lbs (85Kg), Adult Pax: 170 lbs (77Kg), Children (Age 2-12yrs): 77 lbs (35Kg),Infant< 2 Years 22 lbs(10 Kg)</p>
                </div>
            </div>
        	</div>
        </div>
    </main>
    @include('includes.new_footer',[])
</div>
<script src="{{url('app/js/common/validation.js')}}" type="text/javascript"></script>
<script type="text/javascript">
 $("#select_date" ).datepicker({ 
  minDate: 0,
  dateFormat: 'dd-M-yy',
  onSelect: function(dateText, inst) 
  { 
                    $("#select_date").css("border", "1px solid #999");
  }
});
  $('document').ready(function(){
    $('#reset').click(function(){
          $('.clear').val('');  
          $('.clear').prop('checked', false); 
        });
});
</script>
@stop