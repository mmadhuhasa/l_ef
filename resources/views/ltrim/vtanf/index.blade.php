@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@push('css')
    <link rel="stylesheet" type="text/css" href="https://www.highcharts.com/samples/static/highslide.css" />
    <link href="{{url('app/css/ltrim/vtanf.css')}}" rel="stylesheet">
    <style>
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
          <!-- <div class="container ltim_container">
           <div class="row">
              <div class="col-md-12 ">
                 @if(Session::has('message'))
                  <p class="alert alert-danger" style="text-align: center;margin-bottom: 0;">
                     <ul>
                      @foreach(Session::get('message') as $msg)
                        <li>{{$msg}}</li>
                      @endforeach
                     </ul> 
                  </p>
                  @endif
               </div>   
           </div>
          </div> -->
         <div class="container ltim_container">
         @if($call_sign=="vtssf_new")
            <div class="col-md-12 p-lr-0"><p class="vtobr_heading" style="text-transform: uppercase;">VTSSF</p></div>
         @else
          <div class="col-md-12 p-lr-0"><p class="vtobr_heading" style="text-transform: uppercase;">{{$call_sign}}</p></div>
         @endif 
           <div class="ltrim_sec">
            @if($call_sign=='vtanf')
             <form action='{{url('loadtrim/vtanf')}}' method='POST' id="vtanfform">
            @elseif($call_sign=='vtavs')
             <form action='{{url('loadtrim/vtavs')}}' method='POST' id="vtavsform"> 
            @elseif($call_sign=='vtssf')
             <form action='{{url('loadtrim/vtssf')}}' method='POST' id="vtssfform">  
            @elseif($call_sign=='vtvrl')
              <form action='{{url('loadtrim/vtvrl')}}' method='POST' id="vtanfform">
            @elseif($call_sign=='vtnma')
              <form action='{{url('loadtrim/vtnma')}}' method='POST' id="relianceform">
            @elseif($call_sign=='vtnit')
              <form action='{{url('loadtrim/vtnit')}}' method='POST' id="relianceform"> 
            @elseif($call_sign=='vtssf_old')
             <form action='{{url('loadtrim/vtssf_old')}}' method='POST' id="vtssfform">    
            @elseif($call_sign=='vtkbn')
             <form action='{{url('loadtrim/vtkbn')}}' method='POST' id="vtssfform">     
            @endif       
                <div class="row">
                <input type="hidden" class="form-control" value="1" name="post">
                    <div class="col-md-12 ">
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control" id="callsign" placeholder="call sign" @if($call_sign=="vtssf_old") value="vtssf" @else value="{{$call_sign}}" @endif style="text-transform: uppercase;" readonly>
                                <label>call sign</label>
                            </div>
                        </div>
                        <div @if($call_sign=="vtssf" || $call_sign=="vtssf_old" || $call_sign=="vtkbn")  class="col-md-1 p-l-0" @else   class="col-md-2"  @endif >
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets" data-toggle="popover" data-placement="top" placeholder="from" value="{{ Session::get('from') }}" name="from" id="from" autocomplete="off" autocomplete="off">
                                <label>from</label>
                            </div>
                        </div>
                        <div @if($call_sign=="vtssf" || $call_sign=="vtssf_old" || $call_sign=="vtkbn")  class="col-md-1 p-l-0" @else   class="col-md-2"  @endif>
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets" data-toggle="popover" data-placement="top" placeholder="to"  value="{{ Session::get('to') }}" name="to" id='to' autocomplete="off" autocomplete="off">
                                <label>to</label>
                            </div>
                        </div>
                        {!! csrf_field() !!}
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control datepicker" value="{{ Session::get('date') }}" id="select_date" name="date" autocomplete="off" readonly>
                                <img class="ui-datepicker-trigger" src="{{url('media/ananth/images/calender-icon1.png')}}" alt="..." title="...">
                                <label>date</label>
                            </div>
                        </div>
                        
                         @if($call_sign=="vtnma")
                         <div class="col-md-2">
                            <div class="form-group dynamiclabel">
                                <select name="paxs" class="form-control" id="pax">
                                  <option value="">Select</option>
                                  <option value="1" @if(Session::get('pax_no')== '1') {{'selected'}} @endif>1</option>
                                  <option value="2" @if(Session::get('pax_no')== '2') {{'selected'}} @endif>2</option>
                                  <option value="3" @if(Session::get('pax_no')== '3') {{'selected'}} @endif>3</option>
                                  <option value="4" @if(Session::get('pax_no')== '4') {{'selected'}} @endif>4</option>
                                  <option value="5" @if(Session::get('pax_no')== '5') {{'selected'}} @endif>5</option>
                                </select>
                                <label for="pax">Pax</label>
                            </div>
                         </div>
                          @elseif($call_sign=="vtnit")
                          <div class="col-md-2">
                          <div class="form-group dynamiclabel">
                                <select name="paxs" class="form-control" id="pax">
                                  <option value="">Select</option>
                                  <option value="1" @if(Session::get('pax_no')== '1') {{'selected'}} @endif>1</option>
                                  <option value="2" @if(Session::get('pax_no')== '2') {{'selected'}} @endif>2</option>
                                  <option value="3" @if(Session::get('pax_no')== '3') {{'selected'}} @endif>3</option>
                                  <option value="4" @if(Session::get('pax_no')== '4') {{'selected'}} @endif>4</option>
                                  <option value="5" @if(Session::get('pax_no')== '5') {{'selected'}} @endif>5</option>
                                  <option value="6" @if(Session::get('pax_no')== '6') {{'selected'}} @endif>6</option>
                                  <option value="7" @if(Session::get('pax_no')== '7') {{'selected'}} @endif>7</option>
                                  <option value="8" @if(Session::get('pax_no')== '8') {{'selected'}} @endif>8</option>
                                </select>
                                <label for="pax">Pax</label>
                            </div>
                          </div>
                             @elseif($call_sign=="vtssf" || $call_sign=="vtssf_old")
                             <div class="col-md-3 p-lr-0">
                                <div class="form-group dynamiclabel"  style="font-size: 13px;line-height: 1;">
                                    <div class="col-md-4 p-r-0"><input type="checkbox" name="pax[0]" value="165" @if(Session::get('pax0')) {{ 'checked' }} @endif>PAX 1</div>
                                    <div class="col-md-4 p-r-0"><input type="checkbox" name="pax[1]" value="165" @if(Session::get('pax1')) {{ 'checked' }} @endif>PAX 2</div>
                                    <div class="col-md-4 p-r-0"><input type="checkbox" name="pax[2]" value="165" @if(Session::get('pax2')) {{ 'checked' }} @endif>PAX 3</div>
                                    <div class="col-md-4 p-r-0"><input type="checkbox" name="pax[3]" value="165" @if(Session::get('pax3')) {{ 'checked' }} @endif>PAX 4</div>
                                    <div class="col-md-4 p-r-0"><input type="checkbox" name="pax[4]" value="165" @if(Session::get('pax4')) {{ 'checked' }} @endif>PAX 5</div>
                                    <div class="col-md-4 p-r-0"><input type="checkbox" name="pax[5]" value="165" @if(Session::get('pax5')) {{ 'checked' }} @endif>PAX 6</div>
                                </div>
                             </div>
                            @elseif($call_sign=="vtkbn")
                            <div class="col-md-3 p-lr-0">
                               <div class="form-group dynamiclabel"  style="font-size: 13px;line-height: 1;">
                                   <div class="col-md-4 p-r-0"><input type="checkbox" name="pax[0]" value="230" @if(Session::get('pax0')) {{ 'checked' }} @endif>PAX 1</div>
                                   <div class="col-md-4 p-r-0"><input type="checkbox" name="pax[1]" value="228" @if(Session::get('pax1')) {{ 'checked' }} @endif>PAX 2</div>
                                   <div class="col-md-4 p-r-0"><input type="checkbox" name="pax[2]" value="281" @if(Session::get('pax2')) {{ 'checked' }} @endif>PAX 3</div>
                                   <div class="col-md-4 p-r-0"><input type="checkbox" name="pax[3]" value="281" @if(Session::get('pax3')) {{ 'checked' }} @endif>PAX 4</div>
                                   <div class="col-md-4 p-r-0"><input type="checkbox" name="pax[4]" value="309" @if(Session::get('pax4')) {{ 'checked' }} @endif>PAX 5</div>
                                   <div class="col-md-4 p-r-0"><input type="checkbox" name="pax[5]" value="309" @if(Session::get('pax5')) {{ 'checked' }} @endif>PAX 6</div>
                               </div>
                            </div> 
                          @elseif($call_sign=="vtavs")
                          <div class="col-md-2">
                          <div class="form-group dynamiclabel">
                                <select name="paxs" class="form-control" id="pax">
                                  <option value="">Select</option>
                                  <option value="1" @if(Session::get('pax_no')== '1') {{'selected'}} @endif>1</option>
                                  <option value="2" @if( Session::get('pax_no')== '2') {{'selected'}} @endif>2</option>
                                  <option value="3" @if( Session::get('pax_no')== '3') {{'selected'}} @endif>3</option>
                                  <option value="4" @if( Session::get('pax_no')== '4') {{'selected'}} @endif>4</option>
          
                                </select>
                                <label for="pax">Pax</label>
                            </div>
                          </div>
                           @else
                          <div class="col-md-2">
                          <div class="form-group dynamiclabel">
                                <select name="paxs" class="form-control" id="pax">
                                  <option value="">Select</option>
                                  <option value="1" @if(Session::get('pax_no')== '1') {{'selected'}} @endif>1</option>
                                  <option value="2" @if(Session::get('pax_no')== '2') {{'selected'}} @endif>2</option>
                                  <option value="3" @if(Session::get('pax_no')== '3') {{'selected'}} @endif>3</option>
                                  <option value="4" @if(Session::get('pax_no')== '4') {{'selected'}} @endif>4</option>
                                  <option value="5" @if(Session::get('pax_no')== '5') {{'selected'}} @endif>5</option>
                                  <option value="6" @if(Session::get('pax_no')== '6') {{'selected'}} @endif>6</option>
                                </select>
                                <label for="pax">Pax</label>
                            </div>
                          </div>
                          @endif   
                        
                        
                            @if($call_sign=="vtavs")
                            <div class="col-md-2">
                              <div class="form-group dynamiclabel">
                                <select name="aft_baggage_compt_weight" data-toggle="popover" data-placement="top" class="form-control" id="cargo">
                                  <option value="">Select</option>
                                  <option value="50" @if(Session::get('cargo')== '50') {{'selected'}} @endif>50</option>
                                  <option value="100" @if(Session::get('cargo')== '100') {{'selected'}} @endif>100</option>
                                </select>
                                <label for="cargo">Cargo</label>
                             </div>
                            </div>
                            @elseif($call_sign=="vtssf" || $call_sign=="vtssf_old" || $call_sign=="vtkbn")                            
                            <div class="col-md-3">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers" data-toggle="popover" data-placement="top" placeholder="Baggage (Nose)" name="baggage_nose" id='baggage_nose' autocomplete="off" value="{{ Session::get('baggage_nose') }}">
                                <label for="baggage_nose">Baggage (Nose)</label>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers" data-toggle="popover" data-placement="top" placeholder="Baggage (AFT Cabin)" name="baggage_aft_cabin" id='baggage_aft_cabin' autocomplete="off" value="{{ Session::get('baggage_aft_cabin') }}">
                                <label for="baggage_aft_cabin">Baggage (AFT Cabin)</label>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers" data-toggle="popover" data-placement="top" placeholder="Aft Fuselage Baggage-Forward" name="baggage_aft_cabin_fuselage_forward" id='baggage_aft_cabin_fuselage_forward' autocomplete="off" value="{{ Session::get('aft_fuselage_baggage_forward') }}">
                                <label for="baggage_aft_cabin_fuselage_forward">Aft Fuselage Baggage-Forward</label>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers" data-toggle="popover" data-placement="top" placeholder="Aft Fuselage Baggage-Aft" name="baggage_aft_cabin_fuselage" id='baggage_aft_cabin_fuselage' autocomplete="off" value="{{ Session::get('aft_fuselage_baggage_aft') }}">
                                <label for="baggage_aft_cabin_fuselage">Aft Fuselage Baggage-Aft</label>
                              </div>
                            </div>
                            
                            @else
                            <div class="col-md-2">
                             <div class="form-group dynamiclabel">
                                <input type="text" class="form-control numbers" data-toggle="popover" data-placement="top" placeholder="Cargo" name="aft_baggage_compt_weight" id='cargo_vrl' autocomplete="off" value="{{Session::get('cargo')}}" data-toggle="popover" data-placement="top">
                                <label for="cargo">Cargo</label>
                            </div>
                          </div>
                            @endif 

                        
                        <div class="col-md-4">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets_with_space" data-toggle="popover" data-placement="top" placeholder="pilot name" value="{{ Session::get('pilot') }}" name="pilot" id="pilot" style="text-transform: uppercase;" autocomplete="off">
                                <label>pilot name</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group dynamiclabel">
                                <input type="text" class="form-control alphabets_with_space" data-toggle="popover" data-placement="top" placeholder="co pilot name" value="{{ Session::get('co_pilot') }}" name="co_pilot" id="co_pilot" style="text-transform: uppercase;" autocomplete="off">
                                <label>Co pilot name</label>
                            </div>
                        </div>
                        <?php //dd($call_sign);?>
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel">
                                <input type="text" autocomplete="off" data-toggle="popover" data-placement="top" @if($call_sign=='vtanf'||$call_sign=='vtvrl') class="form-control take_off_fuel_roundoff_vtanf numbers" @elseif($call_sign=='vtavs') class="form-control take_off_fuel_roundoff_vtavs numbers" @elseif($call_sign=='vtssf' || $call_sign=="vtssf_old") class="form-control take_off_fuel_roundoff_vtssf numbers" @elseif($call_sign=='vtnma') class="form-control take_off_fuel_roundoff_vtnma numbers" @elseif($call_sign=='vtnit') class="form-control take_off_fuel_roundoff_vtnit numbers"  @else class="form-control numbers" @endif placeholder="Take off fuel" id="take_off_fuel" name="take_off_fuel" value="{{ Session::get('take_off_fuel') }}">
                                <label>Take off fuel</label>
                            </div>
                        </div>
                        @if($call_sign=='vtanf'|| $call_sign=='vtssf' || $call_sign=='vtavs' ||$call_sign=='vtvrl' || $call_sign=="vtssf_old"|| $call_sign=="vtkbn")
                        <div class="col-md-2">
                            <div class="form-group dynamiclabel">
                                <input type="text" autocomplete="off" data-toggle="popover" data-placement="top" @if($call_sign=='vtanf'|| $call_sign=='vtvrl') class="form-control landing_fuel_roundoff_vtanf numbers" @elseif($call_sign=='vtavs') class="form-control landing_fuel_roundoff_vtavs numbers" @elseif($call_sign=='vtssf' || $call_sign=="vtssf_new" || $call_sign=="vtkbn") class="form-control landing_fuel_roundoff_vtssf numbers" @else class="form-control landing_fuel_roundoff numbers" @endif placeholder="Landing Fuel"  id="landing_fuel"
                                name="landing_fuel" value="{{ Session::get('landing_fuel') }}">
                                <label>Landing Fuel</label>
                            </div>
                        </div>
                        @endif  
                       <div class="col-md-2">
                       <!--  <div class=""> -->
                            <button type="submit" class="form-control newbtnv1">Submit</button>
                            @if(Session::has('message'))
                            <div  @if($call_sign!='vtnma' && $call_sign!='vtnit') class="container ltim_container" @else class="container" @endif   style="margin-top: -8px;margin-left: -15px;font-weight: bold;color: red;">
                             <div class="row" @if($call_sign=='vtnma' || $call_sign=='vtnit') style="margin-left: -784px;" @endif>
                                <div class="col-md-12">
                                       <ul>
                                       <!-- <img src="{{url('media/images/loadtrim/warning.png')}}" style="height:30px"> -->
                                        @foreach(Session::get('message') as $msg)
                                          <li>{{$msg}}</li>
                                        @endforeach
                                       </ul> 
                                    
                                 </div>   
                             </div>
                            </div>
                             @endif
                     <!--    </div> -->
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
<script type="text/javascript">
  $("#select_date" ).datepicker({ 
      maxDate: '+4D',
    onSelect: function(dateText, inst) 
      { 
            $("#select_date").css("border", "1px solid #999");
                    }
      });
  $('document').ready(function(){
 var d="<?php echo Session::get('date')  ?>";
   if(d=="")
   $("#select_date").datepicker().datepicker("setDate", new Date());
   else
    $("#select_date").datepicker().datepicker("setDate",d);
});
 
</script>
@stop