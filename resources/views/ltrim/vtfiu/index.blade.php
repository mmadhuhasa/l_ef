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
background:rgba(0,0,0,.4)!important;
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
            @if(Session::has('message'))
            <div  style="margin-top: 10px;margin-left: -15px;font-weight: bold;color: red;">
             <div class="row">
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
            <div class="bg-white">
                <div class=" fpl_sec">
                    
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
                                    <input type="text" data-toggle="popover" data-placement="top" maxlength="4" autocomplete="off" class="alpha_numeric text-center font-bold text_uppercase form-control modtooltip alphabets"  placeholder="FROM" id="from" name="from" tabindex="1" value="{{Session::get('vtfiu_data')['from']}}">
                                    <label>FROM</label>
                                </div>
                            </div>
                            <div class="col-sm-6 ltrim_sec" style="padding-left:5px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" data-toggle="popover" data-placement="top"  maxlength="4" autocomplete="off" class="alpha_numeric text-center font-bold text_uppercase form-control modtooltip alphabets"  placeholder="TO" id="to" name="to" tabindex="1" value="{{Session::get('vtfiu_data')['to']}}"> 
                                    <label style="left:8px;">TO</label>
                                </div>
                            </div>
                        </div> <!--col-md-12 close here-->
                        <div class="col-md-12" style="padding-left: 35px;padding-right: 35px;">
                            <div class="col-sm-6 ltrim_sec" style="padding-right: 5px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" data-toggle="popover" data-placement="top" maxlength="3" autocomplete="off" class="alpha_numeric text-center font-bold text_uppercase form-control modtooltip numbers"  placeholder="Baggage" id="cargo" name="cargo" tabindex="1" value="{{Session::get('vtfiu_data')['cargo']['weight']}}">
                                    <label>Baggage</label>
                                </div>
                            </div>
                             <div class="col-sm-6 ltrim_sec" style="padding-left:5px;padding-right:15px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" autocomplete="off" readonly='readonly' style="background: #eee; text-align:center;border-radius:4px;cursor:pointer;" class="form-control font-bold dateofflight_vtbsl" placeholder="Date of Flight" name="date" id="flight_date" data-toggle="popover" data-placement="top" value="{{Session::get('vtfiu_data')['date']}}">
                                    <label style="left:5px;" class="flightdate_lable hide" id="flight_date_lbl">DATE OF FLIGHT</label>
                                </div>
                            </div>
                           
                        </div><!--col-md-12 close here-->
                        <div class="col-md-12" style="padding-left: 35px;padding-right: 35px;">
                            <div class="col-sm-6 ltrim_sec" style="padding-right: 5px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" data-toggle="popover" data-placement="top" maxlength="25" autocomplete="off" class="alphabets_with_space  text-center font-bold text_uppercase form-control modtooltip"  placeholder="pilot name" id="pilot" name="pilot" tabindex="1" value="{{Session::get('vtfiu_data')['pilot']}}">
                                    <label>pilot name</label>
                                </div>
                            </div>
                            <div class="col-sm-6 ltrim_sec" style="padding-left:5px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" data-toggle="popover" data-placement="top" maxlength="25" autocomplete="off" class="alphabets_with_space text-center font-bold text_uppercase form-control modtooltip blur"  placeholder="Co pilot name" id="co_pilot" name="co_pilot" tabindex="1" value="{{Session::get('vtfiu_data')['co_pilot']}}">
                                    <label style="left:10px;">Co pilot name</label>
                                </div>
                            </div>
                        </div><!--col-md-12 close here-->
                        <div class="col-md-12" style="padding-left: 35px;padding-right: 35px;">
                            <div class="col-sm-6 ltrim_sec" style="padding-right: 5px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" data-toggle="popover" data-placement="top" maxlength="4" autocomplete="off" class="text-center font-bold text_uppercase form-control modtooltip numbers"  placeholder="Total Fuel" id="take_off_fuel" name="take_off_fuel" tabindex="1" value="{{Session::get('vtfiu_data')['fuel_loading']['weight']}}">
                                    <label>Total Fuel</label>
                                </div>
                            </div>
                            <div class="col-sm-6 ltrim_sec" style="padding-left:5px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" data-toggle="popover" data-placement="top" maxlength="4" autocomplete="off" class="numbers  text-center font-bold text_uppercase form-control modtooltip"  placeholder="Remaining FUEL" id="landing_fuel" name="landing_fuel" tabindex="1" value="{{Session::get('vtfiu_data')['landing_fuel']['weight']}}">
                                    <label style="left:10px;">Remaining FUEL</label>
                                </div>
                            </div>
                        </div><!--col-md-12 close here-->
                        <div class="col-md-12" style="margin-left:28px;margin-bottom:15px;">
                            <div class="form-group dynamiclabel" style="font-size: 13px;line-height: 1;">
                                <div class="col-md-4 p-r-0"><input type="checkbox" name="pax[0]" value="75"
                                 id="pax1" @if(Session::get('vtfiu_data')['pax'][0]['weight']!=0)  checked  @endif><label for="pax1">PAX 1</label></div>
                                <div class="col-md-4 p-r-0"><input id="pax2" type="checkbox" name="pax[1]" value="75" @if(Session::get('vtfiu_data')['pax'][1]['weight']!=0)  checked  @endif><label for="pax2">PAX 2</label></div>
                                <div class="col-md-4 p-r-0"><input id="pax3" type="checkbox" name="pax[2]" value="75" @if(Session::get('vtfiu_data')['pax'][2]['weight']!=0)  checked  @endif><label for="pax3">PAX 3</label></div>
                                <div class="col-md-4 p-r-0"><input id="pax4" type="checkbox" name="pax[3]" value="75" @if(Session::get('vtfiu_data')['pax'][3]['weight']!=0)  checked  @endif><label for="pax4">PAX 4</label></div>
                               
                               
                            </div>
                        </div> 
                       
                        <div class="col-md-12" style="text-align:center;">
                             <button class="btn newbtnv1" id="" style="line-height:1;width:24%;" type="submit" name="">SUBMIT</button>
                        </div>
                    </div>
                   </form>
                  </div>
                </div>
            </div><!--first close here-->
          
    </main>
@include('includes.new_footer',[])
<script>
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
              //$("#pilot").focus();
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