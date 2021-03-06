@extends('layouts.check_quick_loadtrim_layout',array('1'=>'1'))
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
background:rgba(0,0,0,.6);
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
#Div1{
margin-left: 120px;
}
.dateofflight_vtbsl{
text-align:left!important;
}
.download-parent:hover .tooltip-download{
visibility: visible;
}
.tooltip-download {
visibility: hidden;
position: absolute;
background: #333;
color: #fff;
top: -22px;
right: 22%;
padding: 3px;
font-size: 10px;
border-radius: 3px;
cursor: default;
text-transform: uppercase;
}
.highcharts-background{
width:0;
}
.ltrim_sec div.dynamiclabel{
display: block;
position: relative;
text-align: left;
padding-right: 0px;  
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
left:0px;
text-transform: uppercase;
font-style: italic;
}
.ltrim_sec div.dynamiclabel > *:focus + label{
opacity: 1;
z-index:100;
top:40px;
left:0px;
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
.bold
{
 font-weight: bold;
}
</style>
@include('includes.new_header',[])
    <main>
        <div class="container" style="width:425px;">
            <div class="bg-white">
                <div class=" fpl_sec">
                <form method="POST" action="{{url('loadtrim/vtbsl')}}" id="add_vtbsl">
                     {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <p class="new_fpl_heading">VTBSL GRAPH</p>
                        </div>
                        <div class="col-md-12">
                            <div class="col-sm-4 ltrim_sec" style="padding-right: 5px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" data-toggle="popover" data-placement="top" data-toggle ="popover" data-placement="bottom" maxlength="4" autocomplete="off" class="alpha_numeric text-center font-bold text_uppercase form-control modtooltip alphabets"  placeholder="FROM" id="from" name="from" tabindex="1" value="{{$from}}">
                                    <label>FROM</label>
                                </div>
                            </div>
                            <div class="col-sm-4 ltrim_sec" style="padding-left: 5px;padding-right: 5px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" data-toggle="popover" data-placement="top" data-toggle ="popover" data-placement="bottom" maxlength="4" autocomplete="off" class="alpha_numeric text-center font-bold text_uppercase form-control modtooltip alphabets"  placeholder="TO" id="to" name="to" tabindex="1" value="{{$to}}">
                                    <label style="left:8px;">TO</label>
                                </div>
                            </div>
                            <div class="col-sm-4" style="padding-left:5px;">
                                <div class="form-row">
                                    <div class="form-search-row-left deskview">
                                        <div class="form-group">
                                            <div class="input-group" style="width:100%">
                                                <input type="text" autocomplete="off" value="{{$flight_date}}" style="background: #eee; text-align:center;border-radius:4px;cursor:pointer;" class="form-control font-bold dateofflight_vtbsl" placeholder="Date of Flight" name="flight_date" id="flight_date"  readonly="readonly">
                                                <label class="flightdate_lable" id="flight_date_lbl">DATE OF FLIGHT</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!--col-md-12 close here-->
                        <div class="col-md-12" style="padding-left: 35px;padding-right: 35px;">
                            <div class="col-sm-6 ltrim_sec" style="padding-right: 5px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" data-toggle="popover" data-placement="top" maxlength="5" autocomplete="off" class="alpha_numeric text-center font-bold text_uppercase form-control modtooltip numbers"  placeholder="MAX ZFW WT" id="max_zfw_cg" name="max_zfw_cg" tabindex="1" value="{{$max_zfw_cg}}">
                                    <label>MAX ZFW WT</label>
                                </div>
                            </div>
                            <div class="col-sm-6 ltrim_sec" style="padding-left:5px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" data-toggle="popover" data-placement="top" maxlength="6" autocomplete="off" class="numbers_dots text-center font-bold text_uppercase form-control modtooltip blur"  placeholder="MAX ZFW % C.G." id="max_zfw_mac" name="max_zfw_mac" tabindex="1" value="{{$max_zfw_mac}}">
                                    <label>MAX ZFW % C.G.</label>
                                </div>
                            </div>
                        </div><!--col-md-12 close here-->
                        <div class="col-md-12" style="padding-left: 35px;padding-right: 35px;">
                            <div class="col-sm-6 ltrim_sec" style="padding-right: 5px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" data-toggle="popover" data-placement="top" maxlength="5" autocomplete="off" class="alpha_numeric text-center font-bold text_uppercase form-control modtooltip numbers"  placeholder="TAKE OFF WT" id="take_off_cg" name="take_off_cg" tabindex="1" value="{{$take_off_cg}}">
                                    <label>TAKE OFF WT</label>
                                </div>
                            </div>
                            <div class="col-sm-6 ltrim_sec" style="padding-left:5px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" data-toggle="popover" data-placement="top" maxlength="6" autocomplete="off" class="numbers_dots text-center font-bold text_uppercase form-control modtooltip blur"  placeholder="TAKE OFF % C.G." id="take_off_mac" name="take_off_mac" tabindex="1" value="{{$take_off_mac}}">
                                    <label>TAKE OFF % C.G.</label>
                                </div>
                            </div>
                        </div><!--col-md-12 close here-->
                        <div class="col-md-12" style="padding-left: 35px;padding-right: 35px;">
                            <div class="col-sm-6 ltrim_sec" style="padding-right: 5px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" data-toggle="popover" data-placement="top" maxlength="5" autocomplete="off" class="alpha_numeric text-center font-bold text_uppercase form-control modtooltip numbers"  placeholder="LANDING WT" id="landing_cg" name="landing_cg" tabindex="1" value="{{$landing_cg}}">
                                    <label>LANDING WT</label>
                                </div>
                            </div>
                            <div class="col-sm-6 ltrim_sec" style="padding-left:5px;">
                                <div class="form-group dynamiclabel">
                                    <input type="text" data-toggle="popover" data-placement="top" maxlength="6" autocomplete="off" class="numbers_dots text-center font-bold text_uppercase form-control modtooltip blur"  placeholder="LANDING % C.G." id="landing_mac" name="landing_mac" tabindex="1" value="{{$landing_mac}}">
                                    <label>LANDING % C.G.</label>
                                </div>
                            </div>
                        </div><!--col-md-12 close here-->
                        <div class="col-md-12" style="text-align:center;">
                            <div class="col-md-3" style="width:20%;"></div>
                            <div class="col-md-12">
                                <button class="btn newbtnv1" id="" style="line-height:1;width:24%;float:left;margin-left:38%;" type="submit" name="">SUBMIT</button>
                                <div class="download_img download-parent" style="margin-top:5px;float:right;margin-right: 25%;">
                                    <a id="graph_print" href="javascript:void(0)"> <img src="{{url('media/images/download-all.png')}}" style=""></a>
                                    <div class="tooltip-download">Download</div>
                                </div>
                            </div>
                        </div>
                    </div>
                   </form>
                  </div>
                </div>
            </div>
        </div>
    </main>
    <div class="container graph_container">
           <div class="row">
               <!--<img id="graph_print" class="pull-right" src="{{url('media/images/download-all.png')}}" style="margin-top: 35px;cursor: pointer;margin-right: 11px;">
               <div class="download_text">Download</div>-->
               <div class="col-sm-8 col-md-12">
                   <div id="Div1"></div>                      
               </div>
           </div>
    </div>    
@include('includes.new_footer',[])
</div>
<script>
    $(document).ready(function () {
        $("#flight_date,.ui-datepicker-trigger").click(function () {
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
    $(document).on("blur",".blur",function(e){  
        var num_match = $(this).val().split(".");
        if($(this).val()!="" && num_match.length==1)
        {
            console.log("hello") 
            $(this).val($(this).val()+'.00');
        }
    });
    $(document).on("keyup","#from",function(e){  
        if($(this).val().length>=4){ 
        closePopover("#"+$(this).attr('id'));
        $("#to").focus();
        }
    });
    $(document).on("keyup","#to",function(e){  
        if($(this).val().length>=4){ 
        closePopover("#"+$(this).attr('id'));

        $(".notify-bg-v").fadeIn(); 
        $('.notify-bg-v').css('height',0);
        $('.notify-bg-v').css('height', $(document).height());
        // $('.notify-bg-v').css('height',0);
        $("#flight_date").focus();
        } 
    });
    $(document).on("keyup","#max_zfw_cg",function(e){  
        if($(this).val().length>=5){ 
        closePopover("#"+$(this).attr('id'));
        $("#max_zfw_mac").focus();
        }
    });
    $(document).on("keyup","#max_zfw_mac",function(e){  
        if($(this).val().length>=6){ 
        closePopover("#"+$(this).attr('id'));
        $("#take_off_cg").focus();
        }
    });

    $(document).on("keyup","#take_off_cg",function(e){  
        if($(this).val().length>=5){ 
        closePopover("#"+$(this).attr('id'));
        $("#take_off_mac").focus();
        }
    });
    $(document).on("keyup","#take_off_mac",function(e){  
        if($(this).val().length>=6){ 
        closePopover("#"+$(this).attr('id'));
        $("#landing_cg").focus();
        }
    });
    $(document).on("keyup","#landing_cg",function(e){  
        if($(this).val().length>=5){ 
        closePopover("#"+$(this).attr('id'));
        $("#landing_mac").focus();
        }
    });
    $(document).on("keyup","#landing_mac",function(e){  
        if($(this).val().length>=6){ 
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
       if (value.length == 0 && e.which !=118)
            return false;
       if (value.length == 1 && (e.which !=97 && e.which != 101 && e.which != 105 && e.which != 111))
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
        var max_zfw_cg=$("#max_zfw_cg").val();
        var max_zfw_mac=$("#max_zfw_mac").val();
        var take_off_cg=$("#take_off_cg").val();
        var take_off_mac=$("#take_off_mac").val();
        var landing_cg=$("#landing_cg").val();
        var landing_mac=$("#landing_mac").val();
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
        if(max_zfw_cg.length<5){
            errorPopover('#max_zfw_cg','Min. & Max. 5 Digits');
            bool=false;
        }
        else if(max_zfw_cg<13158 || max_zfw_cg>15000){
           errorPopover('#max_zfw_cg','Min Val is 13158 & Max. 15000');
            bool=false;
        }

        if(take_off_cg.length<5){
            errorPopover('#take_off_cg','Min. & Max. 5 Digits');
            bool=false;
        }
        else if(take_off_cg<13158 || take_off_cg>20000){
           errorPopover('#take_off_cg','Min Val is 13158 & Max. 20000');
            bool=false;
        }

        if(landing_cg.length<5){
            errorPopover('#landing_cg','Min. & Max. 5 digits');
            bool=false;
        }
        else if(landing_cg<13158 || landing_cg>18700){
           errorPopover('#landing_cg','Min Val is 13158 & Max. 18700');
            bool=false;
        }

        if(max_zfw_mac.length<6){
            errorPopover('#max_zfw_mac','Min. & Max. 6 Digits including Dot');
            bool=false;
        }
        else if(max_zfw_mac<328.57 || max_zfw_mac>329.89){
           errorPopover('#max_zfw_mac','Min Val is 328.57 & Max Val is 329.89');
            bool=false;
        }
        if(take_off_mac.length<6){
            errorPopover('#take_off_mac','Min. & Max. 6 Digits including Dot');
            bool=false;
        }
        else if(take_off_mac<328.21 || take_off_mac>329.76){
           errorPopover('#take_off_mac','Min Val is 328.21 & Max Val is 329.76');
            bool=false;
        }
        if(landing_mac.length<6){
            errorPopover('#landing_mac','Min. & Max. 6 digits including Dot');
            bool=false;
        }
        else if(landing_mac<328.24 || landing_mac>329.62){
           errorPopover('#landing_mac','Min Val is 328.24 & Max Val is 329.62');
            bool=false;
        } 
        if((landing_cg.length==5 &&  (landing_cg>=13158 &&  landing_cg<=18700) && take_off_cg.length==5 &&  (take_off_cg>=13158 &&  take_off_cg<=20000)) && (landing_cg>take_off_cg))
        {
            errorPopover('#landing_cg','LANDING WT cannot be more than TAKE OFF WT');
            bool=false;
        }
        console.log('bool='+bool);    
        if(bool==false)
           return false;    
       });
       $("#flight_date").datepicker({
            dateFormat: 'dd-M-yy',
            showOn: 'both', 
            buttonImage: base_url + '/media/ananth/images/calender-icon1.png', 
            buttonImageOnly: true,
            onSelect: function(selectedDate) 
            {  
              closePopover("#"+$(this).attr('id')); 
              $("#flight_date_lbl").removeClass('hide');
              $(".notify-bg-v").fadeOut(); 
              $("#max_zfw_cg").focus();
            }
        });
        $(function () {              
           var zero_fuel_data=[<?php echo $max_zfw_mac;?>,<?php echo $max_zfw_cg;?>];
            var zero_fuel_data_graph=[<?php echo $max_zfw_mac;?>,<?php echo $max_zfw_cg+200;?>];
           var take_off_data=[<?php echo $take_off_mac;?>,<?php echo $take_off_cg;?>];
           var take_off_data_graph=[<?php echo $take_off_mac;?>,<?php echo $take_off_cg+200;?>];
           var landing_data=[<?php echo $landing_mac; ?>,<?php echo $landing_cg ;?>];
           var landing_data_graph=[<?php echo $landing_mac; ?>,<?php echo $landing_cg+200 ;?>];
           var fromm="<?php echo $from;?>";
           var to="<?php echo $to;?>";
           var date="<?php echo $flight_date ?>";
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
                                <div style="border-top:1px solid black;width:99%;"></div>
                                <table style="width:110%;">
                                   <tr>
                                     <td style="width:25%;">SERIAL NUMBER: 560-5816</td>
                                     <td style="width:22%;">REGISTRATION: <span style="font-weight:bold;">VT-BSL</span></td>
                                     <td style="font-weight:bold;width:13%;">FROM: <span>${fromm}</span></td>
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
                           color: landing_fuel_color,
                           "marker": {
                               enabled: true,
                               "symbol": "triangle",
                               radius: 4
                           },
                            data: [landing_data],
                           dataLabels: {
                               enabled: true,
                               formatter: function () {
                               return  '<span class="bold">LAND C.G. ('+parseFloat(this.key).toFixed(1) + '/' + Math.round(this.y) + ')</span>';
                               },
                               style: {fontWeight: 'bold',fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '11px',color :'black'}
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
                       return   '<span class="bold">T.OFF C.G. ('+parseFloat(this.key).toFixed(1) + '/' + Math.round(this.y) + ')</span>';
                               },
                               style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '11px', fontWeight: 'bold',color :'black'},

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
                                 return   '<span  class="bold">ZFW C.G. ('+parseFloat(this.key).toFixed(1) + '/' + Math.round(this.y) + ')</span>';
                               },
                                style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '11px', fontWeight: 'bold',color :'black'},

                           }
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
                               return  'LAND C.G. ('+parseFloat(this.key).toFixed(1) + ' / ' + Math.round(this.y) + ')';
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
                   var date_of_flight="<?php echo $flight_date ?>";
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
               }); 
           });
</script>
@stop