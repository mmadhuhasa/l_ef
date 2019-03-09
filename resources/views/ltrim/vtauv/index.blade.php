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
.jump_box { font-size: 14px;
    border: 1px solid #999;
    padding-top: 8px;
    padding-left: 22px;
    border-radius: 4px;
    line-height: 1.2;
    width: 100%;
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    height: 34px;}
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
.p-rl-0{
  padding-right: 0;
  padding-left: 0;
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
    <div class="notify-bg-v"></div>
    @include('includes.new_header',[])
    <main>
        
         <div class="container ltim_container">
           <div class="ltrim_sec">
           <div class="row"><div class="col-md-12 p-lr-0"><p class="vtobr_heading" style="text-transform: uppercase;">{{$call_sign}}</p></div></div>
            <form action='{{url('loadtrim/vtauv')}}' method='POST' id="vtauvform">
                <div class="row">
                <input type="hidden" class="form-control" value="1" name="post">
                    <div class="col-md-12 p-lr-0">
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control" placeholder="call sign" id="callsign"  value="{{$call_sign}}" style="text-transform: uppercase;" readonly>
                                <label>call sign</label>
                            </div>
                        </div>
                        <div class="col-md-1 p-l-0">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets clear" placeholder="from" name="from" id="from" autocomplete="off" data-toggle="popover" data-placement="top" data-toggle="popover" data-placement="top" data-toggle="popover" data-placement="top" value="{{ Session::get('from') }}">
                                <label>from</label>
                            </div>
                        </div>
                        <div class="col-md-1 p-l-0">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets clear" placeholder="to"   name="to" id='to' autocomplete="off" data-toggle="popover" data-placement="top" data-toggle="popover" data-placement="top" data-toggle="popover" data-placement="top" value="{{ Session::get('to') }}">
                                <label>to</label>
                            </div>
                        </div>
                        {!! csrf_field() !!}
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control datepicker1 clear"  id="select_date" name="date" autocomplete="off" readonly>
                                <label>date</label>
                            </div>
                        </div>
                         <input type="hidden" class="form-control datepicker1 clear"  name="post" value='1'>
                        <div class="col-md-5" style="margin-bottom:15px;padding-right: 0;width:24%;margin-top: -6px;">                         
                            <div class="form-group dynamiclabel" style="font-size: 12px;line-height: 0;">
                                <div class="col-md-3 p-rl-0 "><input class="clear" style="padding-bottom: 10px;" type="checkbox" name="paxs[0]" value="170" @if(Session::get('pax0')) {{ 'checked' }} @endif >PAX 1</div>
                                <div class="col-md-3 p-rl-0 "><input class="clear" type="checkbox" name="paxs[1]" value="170" 
                                @if(Session::get('pax1')) {{ 'checked' }} @endif>PAX 2</div>
                                <div class="col-md-3 p-rl-0 "><input class="clear" type="checkbox" name="paxs[2]" value="170"
                                @if(Session::get('pax2')) {{ 'checked' }} @endif >PAX 3</div>
                                <div class="col-md-3 p-rl-0 "><input class="clear" type="checkbox" name="paxs[3]" value="170"
                                @if(Session::get('pax3')) {{ 'checked' }} @endif >PAX 4</div>
                                <div class="col-md-3 p-rl-0 "><input class="clear" type="checkbox" name="paxs[4]" value="170"
                                @if(Session::get('pax4')) {{ 'checked' }} @endif >PAX 5</div>
                                <div class="col-md-3 p-rl-0 "><input class="clear" type="checkbox" name="paxs[5]" value="170"
                                @if(Session::get('pax5')) {{ 'checked' }} @endif >PAX 6</div>
                                <div class="col-md-3 p-rl-0 "><input class="clear" type="checkbox" name="paxs[6]" value="170"
                                @if(Session::get('pax6')) {{ 'checked' }} @endif >PAX 7</div>
                                <div class="col-md-3 p-rl-0 "><input class="clear" type="checkbox" name="paxs[7]" value="170"
                                @if(Session::get('pax7')) {{ 'checked' }} @endif >PAX 8</div>
                                <div class="col-md-3 p-rl-0 "><input class="clear" type="checkbox" name="paxs[8]" value="170"
                                @if(Session::get('pax8')) {{ 'checked' }} @endif >PAX 9</div>
                                
                            </div>
                         </div>
                         <div class="col-md-3" style="margin-left: 8px;">
                             <div class="form-group">
                                 <div class="jump_box">
                                     <label style="padding-right: 8px;">Jump</label>
                                     <input type="radio" name="jump" value="170" class="jump" @if(Session::get('jump1')) {{ 'checked' }} @endif> Yes 
                                     <input type="radio" name="jump" value="0" class="jump" @if(Session::get('jump0')) {{ 'checked' }} @endif> No
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-3">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers_with_decimal clear" placeholder="Potable Water" name="portable_water" id='portable_water' autocomplete="off"  data-toggle="popover" data-placement="top" value="{{ Session::get('portable_water') }}">
                                <label for="portable_water">Potable Water</label>
                              </div>
                            </div>
                            <div class="col-md-3 p-l-0">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers_with_decimal clear" placeholder="Catering Allowance" name="catering_allowance" id='catering_allowance' autocomplete="off"  data-toggle="popover" data-placement="top" value="{{ Session::get('catering_allowance') }}">
                                <label for="catering_allowance">Catering Allowance</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers_with_decimal clear" placeholder="Toilet Charge" name="toilet_charge" id='toilet_charge' autocomplete="off"  data-toggle="popover" data-placement="top" value="{{ Session::get('toilet_charge') }}">
                                <label for="toilet_charge">Toilet Charge</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers_with_decimal clear" placeholder="Life Raft" name="life_raft" id='life_raft' autocomplete="off"  data-toggle="popover" data-placement="top" value="{{ Session::get('lift_raft') }}">
                                <label for="life_raft">Life Raft</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers clear" placeholder="Baggage" name="aft_baggage_compt_weight" id='baggage' autocomplete="off"  data-toggle="popover" data-placement="top" value="{{ Session::get('cargo') }}">
                                <label for="total_fuel">Baggage</label>
                              </div>
                            </div>
                            <div class="col-md-3 p-l-0">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers clear" placeholder="Take Off Fuel" name="take_off_fuel" id='take_off_fuel_vtauv' autocomplete="off"  data-toggle="popover" data-placement="top" value="{{ Session::get('take_off_fuel') }}">
                                <label for="total_fuel">Take Off Fuel</label>
                              </div>
                            </div>
                              <div class="col-md-3">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers clear" placeholder="Block Fuel" name="block_fuel" id='block_fuel' autocomplete="off"  data-toggle="popover" data-placement="top" value="{{ Session::get('block_fuel') }}">
                                <label for="block_fuel">Block Fuel</label>
                              </div>
                            </div>
                            
                        <div class="col-md-4" style="width:25%;">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets_with_space clear" placeholder="pilot name"  name="pilot" id="pilot" style="text-transform: uppercase;" autocomplete="off" data-toggle="popover" data-placement="top" data-toggle="popover" data-placement="top" value="{{ Session::get('pilot') }}">
                                <label>pilot name</label>
                            </div>
                        </div>
                        <div class="col-md-4" style="width:25%;">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets_with_space clear" placeholder="co pilot name"  name="co_pilot" id="co_pilot" style="text-transform: uppercase;" autocomplete="off" data-toggle="popover" data-placement="top" data-toggle="popover" data-placement="top" value="{{ Session::get('co_pilot') }}">
                                <label>Co pilot name</label>
                            </div>
                        </div>
                    <div class="col-md-12 p-lr-0">
                        <div class="col-md-2">  
                          <button type="submit" class="form-control newbtnv1">Submit</button></div>
                          @if(Session::has('message'))
                            <div class="container " style="margin-top: -8px;margin-left: -15px;font-weight: bold;color: red;">
                             <div class="row">
                              <!-- <div>
                                <img src="{{url('media/images/loadtrim/warning.png')}}" style="height:25px;">
                              </div> -->
                                <div class="col-md-12">
                                    <ul>
                                      @foreach(Session::get('message') as $msg)
                                            <li>{{$msg}}</li>
                                      @endforeach
                                    </ul> 
                                 </div>   
                             </div>
                            </div>
                             @endif
                        </div>
                    </div>
                    </div>
                </div>
               </form> 
             </div>
            </div>
           
    </main>
    @include('includes.new_footer',[])
</div>
<script src="{{url('app/js/common/validation.js')}}" type="text/javascript"></script>
<script>

$("#select_date" ).datepicker({ 
  minDate: 0,
  dateFormat: 'dd-M-yy',
  showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true,
  onSelect: function(dateText, inst) 
  { 
        $(".notify-bg-v").fadeOut(); 
        $("#select_date").css("border", "1px solid #999");
  }
});
$("#select_date,.ui-datepicker-trigger").click(function(){
  $(".notify-bg-v").fadeIn(); 
  $('.notify-bg-v').css('height',0);
  $('.notify-bg-v').css('height', $(document).height());
});

 // $("#select_date").datepicker().datepicker("setDate", new Date());
 var d="<?php echo Session::get('date')  ?>";
   if(d=="")
   $("#select_date").datepicker().datepicker("setDate", new Date());
   else
    $("#select_date").datepicker().datepicker("setDate",d);
   </script>
@stop