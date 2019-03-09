@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@push('js')
<script src="{{url('app/js/sweet-alert.js')}}"></script>
<script src="{{url('app/js/jquery.sweet-alert.init.js')}}"></script>
<script src="{{url('app/js/jquery.sticky.min.js')}}" type="text/javascript"></script>
@endpush
@push('css')
<link rel="stylesheet" href="{{url('app/css/sweet-alert.css')}}" />
@endpush

@section('content')
   <style>
       .mainrow{
          width: 1000px;
          margin: 0 auto;
          padding:15px 0px 10px 0px;
       }
       .fuelbillp{
          text-align: center;
          font-weight: bold;
          padding: 5px 0px 5px 0px; 
       }
       .fuelbillheading_wrapper{
          color: #fff;
          background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
          border-radius: 4px 4px 0px 0px;
       }
       .fuelbillbody{
           background:#fff;
       }
       .fuelbillmain_wrapper{
           padding: 0;
       }
       .firstrow{
           margin-top:10px;
           margin-bottom: 15px;
       }
       .callsign_wrapper{
           padding-left:0px;
           width: 12%;
       }
       .airportwrapper{
           padding-left:0px;
           width:35%;
       }
       .dynamiclabel label{
           font-size:11px;
           font-style:italic;
           color:#585858;
           font-weight:normal;
           margin-bottom: 0px;
       }
       .dateofflight_label{
           font-size:11px;
           font-style:italic;
           color:#585858;
           font-weight:normal;
           margin-bottom: 0;
       }
       .fuelagency_wrapper{
           padding-left:0px;
           width: 18%;
           margin-top: -5px;
       }
       .handling_wrapper{
           padding-left:0px;
           width:45%;
           padding-right:3px; 
       }
       .image_wrapper_first{
           position: absolute;
           left: 417px;
           top:0px;
           z-index: 1050;
       }
       .quantity_wrapper{
           width:17%;
           padding-left:10px;
       }
       .datepicker_wrapper1{
           width:18%;
           padding-right:0px;
       }
       .margin20{
          margin-top:22px; 
       }
       .time_wrapper{
          width:17%;
          padding-right: 0px;
          padding-left:15px;
       }
       .operator_wrapper{
          padding-left: 0px;
          padding-right: 0px;
          width:45%;
       }
       .eflightprice_wrapper{
          width:18%;
          padding-left:10px;
          padding-right:0;
       }
       .actualhandling_wrapper{
          width:16%;
          padding-left: 20px; 
       }
       .fuelamount_wrapper{
          width: 11%;
          padding-right: 0px;
          padding-left: 0px;
          margin-left: 33px;
       }
       .totalamount_wrapper{
          width: 11%;
          padding-right: 0px;
          padding-left: 0px;
          margin-left: 5px;
          margin-right: 25px; 
       }
       .btn_wrapper{
          margin-left:22px;
          margin-top:-8px;  
       }
       .btnwidth{
          width: 116px;
          height: 30px; 
       }
       .form-row .deskview .ui-datepicker-trigger {
          right: 10px;
          height: 21px;
          top: 6px;
        }
       .datepicker_wrapper1 .ui-datepicker-trigger {
            height:22px;
            right:0px;
            top:0px;
            position: absolute;
            z-index: 2;
            cursor: pointer;
        }
        .blling_flightdate,.checkin_flightdate,.checkout_flightdate {
            text-align:left;
            font-weight: normal;
            cursor: pointer;
        }
        .bold_placeholder::-webkit-input-placeholder {
           font-weight: bold;
        }
        .notify-bg-v{
            background: rgb(49, 39, 39)!important;
            position: absolute;
            width: 100%;
            display:block;
            z-index:9000;
            display: none;
            opacity: 0.5;
        }
        .hotelbillbody{
            margin: 0 auto;
        }
        .crewbody{
            margin: 0 auto;
        }
       /*tooltip*/
        .tooltip_month{
            position: absolute;top: -25px;left:60px;padding: 3px 11px;color: #eee;border-radius: 4px;visibility: hidden;font-size: 10px;font-weight: normal;
            box-shadow: 0 0 1px 1px #ccc;background: #333333;white-space: nowrap;z-index: 20}
        .tooltip_revise_dbl:hover .tooltip_tri_shape_valid, .tooltip_revise_dbl:hover .tooltip_revise_dbl_position_valid{visibility: hidden;}
        .tooltip_fixed_wing, .tooltip_heli, .tooltip_month, .tooltip_year, .tooltip_wx, .tooltip_tripkit {top:-31px;left:-55px;font-size: 12px;text-transform: uppercase;}
        .tooltip_tri_shape, .tooltip_tri_shape1, .tooltip_tri_shape2, .tooltip_tri_shape3, .tooltip_tri_shape4, .tooltip_tri_shape5, .tooltip_tri_shape6, .tooltip_tri_shape7, .tooltip_tri_shape8, .tooltip_tri_shape9, .tooltip_tri_shape10, .tooltip_tri_shape11, .tooltip_tri_shape12, .tooltip_tri_shape_valid, .tooltip_trishape_01, .tooltip_trishape_02, .tooltip_trishape_03, .tooltip_trishape_04, .tooltip_trishape_05, .tooltip_trishape_06 {
            width: 0;height: 0;border-left: 5px solid transparent;border-right: 5px solid transparent;border-top: 6px solid #333;position: absolute;top: -5px;right: 21px;z-index: 99999;visibility: hidden;}
        .tooltip_tri_shape3 {right:18px;}
        .tooltip_trishape_01, .tooltip_trishape_02, .tooltip_trishape_03, .tooltip_trishape_04, .tooltip_trishape_05, .tooltip_trishape_06 {
            right:25px;
        }
        .info_fuelbill_fuelagency:hover .tooltip_month {
            visibility: visible;
            left: -45px;
        }
        .info_fuelbill_fuelagency:hover .tooltip_trishape_03  {
            visibility: visible;
            left:18px;
        }
        .info_airporthandling_fuelagency:hover .tooltip_month {
            visibility: visible;
        }
        .info_airporthandling_fuelagency:hover .tooltip_trishape_03  {
            visibility: visible;
        }
        .info_hotelbill_fuelagency:hover .tooltip_month {
            visibility: visible;
        }
        .info_hotelbill_fuelagency:hover .tooltip_trishape_03  {
            visibility: visible;
        }
        /*tooltip*/
        .text_uppercase{
          text-transform: uppercase;
        } 
        .hide {
          display: none;
        }
        .billingtime_span_handling{
            position: absolute;
            font-size: 13px;
            color: #f1292b;
            font-weight: bold;
            top: -18px;
            left:0;
        }
        .billingtime_span{
            position: absolute;
            font-size: 13px;
            color: #f1292b;
            font-weight: bold;
            top: -18px;
            left:19px;
        }
        /*dropdown hpbp*/
        .dropdown2 dd, .dropdown2 dt, .dropdown2 ul { 
        margin:0px; 
      padding:0px; 
    }
        .dropdown2 dd { position:relative; }
        .dropdown2 a, .dropdown2 a:visited { color:#000; text-decoration:none; outline:none;}
        .dropdown2 a:hover {
      color: #fff;
        }
        .dropdown2 dt a:hover { color:#000;}
        .dropdown2 dt a {display:block;border:1px solid #999;border-left: 0;border-right: 0;border-top: 0;}
        .dropdown2 dt a span {cursor:pointer; display:block;padding: 8px 7px 0px 0px;font-size:13px;text-align: left;color:#555;}
        .dropdown2 dd ul {z-index: 1050;background:#fff none repeat scroll 0 0; color:#C5C0B0; display:none;border: 2px solid #ccc;
                          left:0px; padding:0px 0px; position:absolute; top:2px; width:auto; min-width:104px; list-style:none;text-align:center;}
        .dropdown2 span.value { display:none;}
        .dropdown2 dd ul li a { padding:0px; display:block;}
        .dropdown2 dd ul li a:hover { background:-webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858));}
        /*.flightdate,.checkin_flightdate,.checkout_flightdate*/
        .white_bg
        {
            background-color: white !important;
          }  
         .ui-datepicker-close{
             margin-left: 76% !important;
             margin-bottom: 1%;
         }
         .ui-priority-primary, .ui-widget-content .ui-priority-primary, .ui-widget-header .ui-priority-primary {
             margin-left: 1% ;
         } 
        /*dropdown hpbp*/
        .ui-autocomplete {
            width:17!important;
        }
        /*hover red move*/
        .ui-menu .ui-menu-item:hover{
        color:#fff;
        }
        .ui-menu .ui-menu-item{
        background:#fff;
        color:#000;
        border-bottom:0;
        border-top:0;
        }/*hover red move*/
        .popover-content{
         padding:2px;
        }
        .ui-priority-primary, .ui-widget-content .ui-priority-primary, .ui-widget-header .ui-priority-primary:hover{
        color:#454545;
        }
        .border_red{
        border-color: red !important;
       }

       .pointer{
        cursor: pointer;
       } 
@media screen and (min-width:1400px) and (max-width:1600px) {
       .choosemodel {
        width: 25%!important;
        height: 26%!important;
        }
        .ui-autocomplete {
            width:14%!important;
        }
        #sidebar {
            width: 540px !important;
        }
        .position_zoomin{
            left:60px!important;  
        }

}
.callsign::-webkit-input-placeholder {
    font-weight: bold;
}
.eflightprice_process::-webkit-input-placeholder {
    font-weight: bold;
}
.blling_flightdate::-webkit-input-placeholder {
    text-align:left;
    font-weight:bold;
}
.numbers_colon::-webkit-input-placeholder {
    text-align:left;
    font-weight:bold;
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
    top:30px;
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
    top:30px;
    left:0px;
    text-transform: uppercase;
    font-style: italic;
}
.ltrim_sec div.dynamiclabel > *:focus + label{
    opacity: 1;
    z-index:100;
    top:30px;
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
input::-webkit-input-placeholder {
    color: #555!important;
    font-size: 12px!important;
    padding:0px;
    margin:0px;
    text-align:left;
    font-weight:bold;
}
input:-moz-placeholder { /* Firefox 18- */
    color: #000 !important;
    font-size: 12px!important;
    text-align:left;  
}
input::-moz-placeholder {  /* Firefox 19+ */
    color: #000 !important;
    font-size: 12px!important;
    text-align:left;  
}
input:-ms-input-placeholder {  
    color: #000 !important;
    font-size: 12px!important;
    text-align:left;  
}
.ltrim_sec div.dynamiclabel [placeholder]:focus::-webkit-input-placeholder {
    transition: opacity 0.4s 0.4s ease;
    opacity: 0;
}
.ltrim_sec div.dynamiclabel .form-control {
    font-weight: bold;
    color: #333;
    border-left: 0px!important;
    border-right: 0px!important;
    border-top: 0px!important;
    box-shadow: none;
    border-radius: 0;
    text-align:left;
    padding:0;
    height:22px;
}
.ltrim_sec div.dynamiclabel .form-control:focus {
    border-bottom: 1px solid #ff0000 ;
}
.secondrow{
    margin-bottom:15px;  
}
.stuck {
    max-height: 100%;
    background-color: #fff;
    border-radius: 4px;
    overflow-y: auto;
    padding-left: 0;
    padding-right: 0;
    box-shadow:1px 1px 3px 1px #999999;
    font-family: Consolas, monaco, monospace;
}
/*.stuck p {
    margin: 10px;
}*/
.paymentnumber{
    text-align:center;
    color: #fff;
    font-weight: bold;
}
.companyname{
   text-align:center;
   color: #f1292b;
   font-weight: bold;
   font-size: 13px;
}
.totalrupees{
    text-align:center;
    color: #000;
    font-weight: bold;
    font-size: 20px;
}
.fuel_rupee{
    text-align:right;
}
.paddingzero{
    padding-left: 0;
    padding-right: 0;
    padding-top:8px;
    padding-bottom:5px;
    border-bottom: 1px solid #000;
}
.btn_side_input{
    font-size: 18px;
    font-weight: bold;
    width:74%;
    height: 100%;
    margin-left: 16%;
}
.odd_color{
    background:#eee;
}
.paddingzero_zero{
   padding-right:0;
   padding-left: 0;
}
.imagestyle{
  width:16px;
  cursor:pointer;
  position: absolute;
  top:7px;
  left: 88px;

}
.handlinginfo_image{
  width:16px;
  cursor: pointer;
  width:16px;
  cursor:pointer;
  position: absolute;
  top:0px;
  left:276px;
}
.remarks_wrapper{
   margin-bottom: 15px;
   padding-right: 0;
   width: 96%; 
}
.hidedivrs{
    visibility:hidden;
}
.border_bottom{
  border-bottom: 1px solid red !important;
}
/*loader*/
.overlay {
    background: #e9e9e9;
    display: none;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    opacity: 0.5;
    z-index: 1000;
}
.img_loader{
   position: fixed;left: 50%;top:50%; 
}
/*loader*/
.newbtnv1:hover{
 outline: none;   
}
/*sidebar*/
#sidebar{
float:right;
width:380px;
}
#sidebar .widget {
width:275px!important;
font-family: Consolas, monaco, monospace;
padding-left:0;
padding-right:0;
border-radius: 4px;
box-shadow: 1px 1px 3px 1px #999999;
 
}  
.sticky { 
background-color:#fff; 
color:#000;
}
#article {
padding-top:5px;
}
/*sidebar*/
.text_enter{
 text-align: right;
 padding-right: 0;   
}
.wrapper_margin{
 margin-top: 5px;   
}
.position_zoomin{
position:absolute;
left:30px;  
}
@media only screen and (min-width :1300px) and (max-width :1399px) {
#sidebar {
    width: 410px!important;
}
.paddingzero {
    padding-top: 3px!important;
    padding-bottom: 1px!important;
}
.position_zoomin{
    left:30px!important;  
}
}
.sweet-alert h2{
    font-size: 16px;
    color: #777;
    margin-bottom: 0;
    margin-bottom:0px;
}
.sweet-alert p{
    margin-top: 0px;
    color: #000;
    font-weight: bold;
}
  /*button shadow effect*/
    .btn-success {
        transition: all 0.25s ease;
        overflow: hidden;
        position: relative;
        display: inline-block;
        margin-bottom: 0;
        color: #fff;
        font-weight: 300;
        text-transform: uppercase;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        border: none;
        background: #F26232;
        background: linear-gradient(to top, #fa9b5b, #F26232);
        background: #f1292b;     
        background: -webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b));
        background: -moz-linear-gradient(top, #f37858, #f1292b);
        z-index: 3;
        border-radius:6px;

    }
    .btn-success:hover:before {
        visibility: visible;
        width: 200%;
        left: -46%;
    }
    .btn-success:before {
        -webkit-transition: all 0.35s ease;
        -moz-transition: all 0.35s ease;
        -o-transition: all 0.35s ease;
        transition: all 0.35s ease;
        -webkit-transform: skew(45deg, 0);
        -moz-transform: skew(45deg, 0);
        -ms-transform: skewX(45deg) skewY(0);
        -o-transform: skew(45deg, 0);
        transform: skew(45deg, 0);
        -webkit-backface-visibility: hidden;
        content: '';
        position: absolute;
        visibility: hidden;
        top: 0;
        left: 50%;
        width: 0;
        height: 100%;
        background: #333;
        z-index: -1;
        color: #fff;
    }
    .btn-success:hover {
        color: #ffffff;
    }
    .popover {
        width: 250px;
        background-color: #333;
        border: #eeeeee solid 2px;
        font-family: 'pt_sansregular';
        margin-top: 0px;
        text-align: center;
        color: white;
    }
    .popover-content{
        padding:2px;
    }
    /*button shadow effect*/
    .btn-default{
     float: left;
     margin-left:60px; 
    }
    .btn-success{
     float: right;
     margin-right:60px;     
    }
    h2 {
        line-height: 28px;
        text-transform: uppercase;
    }
    .fakeinput{
    display: block!important;
    border-left: 0;
    border-top: 0;
    border-right: 0;
    }
    .mini_input {
        width: 43px!important;
        font-size: 14px!important;
        font-weight: bold!important;
        border-right: 0;
        border-left: 0;
        border-top: 0;
        border-bottom: 1px solid #777;
    }
    /*.fakeinput *{font-weight:bold;}*/
    .mini_input:focus{
        outline:none!important;
    }
</style>
<div class="page" id="quick_app">
    <div class="notify-bg-v"></div>
    @include('includes.new_header',[])
     <div class="overlay">
        <img class="img_loader" src="../media/images/loader.gif"/>
    </div> 
    <div class="col-md-9 text_enter position_zoomin">
          <div style="margin-top:5px;width:100%;text-align:center;color: #f1292b;text-transform: uppercase" class="hide">
              <div class="success-left animated infinite zoomIn custdelay" id="success_lbl"  style="font-size: 10px;font-weight: bold;">
                  PLEASE ENTER CORRECT DETAILS
              </div>
          </div>
    </div>
    <script type="text/javascript" src="{{url('app/js/BuroRaDer.DateRangePicker.js')}}"></script>
        <?php
        $order_id = uniqid();
        $section_count=0;
        ?>
    

<div id="wrapper" class="wrapper_margin">
    <div id="main">
      <div id="sidebar" class="row">
        <div  class="widget col-md-12" style="visibility: hidden;">
          <p>Static Widget</p>
        </div>
          <form method="post" id="billinfo" name="customerData" action="{{url('ccavenue/ccavRequestHandler')}}" > 
        <div  class="widget sticky col-md-12">
          <div class="col-md-12 paddingzero" style="    background: -webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b));">
                        <p class="paymentnumber">PAYMENT # <span>12345/17-18</span></p>
                    </div>
                    <div class="col-md-12 paddingzero odd_color">
                    <div class="col-md-5">
                        <p>1. FUEL</p>
                    </div>
                    <div class="col-md-7" style="padding-right:0;">
                        <div class="col-md-1 hidedivrs">
                        <p class="">Rs.</p>
                        </div>
                        <div class="col-md-8 paddingzero_zero">
                        <p class="fuel_rupee" id="fuel_amount">0.00</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 paddingzero">
                    <div class="col-md-5" style="padding-right:0;">
                        <p>2. HANDLING</p>
                    </div>
                    <div class="col-md-7" style="padding-right:0;">
                        <div class="col-md-1 hidedivrs">
                        <p class="">Rs.</p>
                        </div>
                        <div class="col-md-8 paddingzero_zero">
                        <p class="fuel_rupee" id="handling_amount">0.00</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 paddingzero odd_color">
                    <div class="col-md-5">
                        <p>3. HOTEL</p>
                    </div>
                    <div class="col-md-7" style="padding-right:0;">
                        <div class="col-md-1 hidedivrs">
                        <p class="">Rs.</p>
                        </div>
                        <div class="col-md-8 paddingzero_zero">
                        <p class="fuel_rupee" id="hotel_amount">0.00</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 paddingzero">
                    <div class="col-md-5">
                        <p>4. CAB</p>
                    </div>
                    <div class="col-md-7" style="padding-right:0;">
                        <div class="col-md-1 hidedivrs">
                        <p class="">Rs.</p>
                        </div>
                        <div class="col-md-8 paddingzero_zero">
                        <p class="fuel_rupee" id="crew_amount">0.00</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 paddingzero odd_color" style="border-bottom: 2px solid #000;">
                    <div class="col-md-5">
                        <p>5. MISC</p>
                    </div>
                    <div class="col-md-7" style="padding-right:0;">
                        <div class="col-md-1 hidedivrs">
                        <p class="">Rs.</p>
                        </div>
                        <div class="col-md-8 paddingzero_zero">
                        <p class="fuel_rupee" id="misc_amount">0.00</p>
                        </div>
                    </div>
                </div>
                
                <!-- <div class="col-md-12" style="margin: 4px 0px 4px 0px;">
                    <button class="btn newbtnv1 btn_side_input" type="submit" name="submit" disabled id="procees_btn">PROCESS PAYMENT</button>
                </div> -->
                <div class="col-md-12 paddingzero" style="border:none;padding-top:2px;">
                    <p class="totalrupees">TOTAL Rs. <span id="total_amount">0.00</span></p>
                </div>
                <div class="col-md-12 paddingzero" style="border:none;padding:0;">
                    <p class="companyname" id="words" style="text-transform: uppercase;"></p>
                </div>
                <input type="hidden" name="tid" id="tid" readonly />
                <input type="hidden" name="merchant_id" value="162926"/>
                <input type="hidden" name="order_id" value="{{$order_id}}"/>
                <input type="hidden" name="amount" value="1"/>
                <input type="hidden" name="currency" value="INR"/>
                <input type="hidden" name="redirect_url" value="{{url('ccavenue/ccavenue_response')}}"/>
                <input type="hidden" name="cancel_url" value="{{url('ccavenue/cancel_url')}}"/>
                <input type="hidden" name="language" value="EN"/>
                <input type="hidden" name="billing_name" value="Charli"/>
                <input type="hidden" name="billing_address" value="Room no 1101, near Railway station Ambad"/>
            </div>
        </form>
  </div>
</div> <!-- sidebar close here-->
            
<div id="article">     
    <div class="row mainrow">
      <div class="col-md-9" style="padding-left: 0;padding-right: 0;box-shadow: 0 3px 3px 1px #999999;">
       <form method="post" name="billing_process" action="{{url('ccavenue/ccavRequestHandler')}}" id="billing_process">
        @if($fuel == 'true')    
        <?php $section_count++;?>
        <div class="col-md-12 fuelbillmain_wrapper section{{$section_count}}" id="fuel_bill">
             <div class="col-md-12 fuelbillheading_wrapper" style="cursor: pointer;">
                  <p class="fuelbillp">FUEL BILL</p>
             </div>
             <div class="col-md-12 fuelbillbody" id="collapse_reg{{$section_count}}">
                    <div class="col-md-12 firstrow">

                      <div class="col-md-2 callsign_wrapper">
                          <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                             <input id="aircraft_callsign1" name="aircraft_callsign" minlength="5" maxlength="7" type="text" class="text-center font-bold text_uppercase form-control callsign special_symbols" placeholder="Call Sign" data-toggle="popover" data-placement="top" autocomplete="off">
                             <label id="callsign1_lbl"> CALL SIGN</label>
                         </div>
                        </div>
                      </div>

                      <div class="col-md-3 airportwrapper">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                            <input  type="text" id="airport1" name="airport" class="text-center font-bold text_uppercase form-control bold_placeholder airport alphabets" placeholder="Airport" data-toggle="popover" data-placement="top" maxlength="3" autocomplete="off">
                            <label>Airport</label>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-3 fuelagency_wrapper" id="sample_div">
                       <div class="ltrim_sec">
                        <div class="group dynamiclabel">
                            <dl id="sample" class="dropdown2" data-toggle="popover" data-placement="top">
                                <dt><a href="javascript:void(0)" id="sample_agency"><span id="fuelbill_fuelagency">FUEL AGENCY</span></a></dt>
                                <dd>
                                    <ul>
                                        <li><a href="javascript:void(0)">HP</a></li>
                                        <li><a href="javascript:void(0)">BP</a></li>
                                        <li><a href="javascript:void(0)">IOC</a></li>
                                        <li><a href="javascript:void(0)">RELIANCE</a></li>
                                        <li><a href="javascript:void(0)">SHELL</a></li>
                                    </ul>
                                </dd>
                            </dl>
                            <label style="margin-top: 5px;" class="hide" id="fuelbill_fuelagency_lbl">FUEL AGENCY</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-1 image_wrapper_first info_fuelbill_fuelagency">
                           <img style="width:16px;cursor:pointer;" src="{{url('media/images/payment/info_new.PNG')}}"/>
                           <span class="tooltip_month hide" id="fuel_agency_info" style="top: -72px;">FUEL AGENCY INFO</span>
                           <span class="tooltip_trishape_03 hide" id="fuel_agency_info_tri"></span>
                      </div>
                      <div class="col-md-3 fuelagency_wrapper hide" style="margin-top:0;" id="f_agency_div">
                       <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                                <input  type="text" id="f_agency" class="text-center font-bold form-control bold_placeholder " disabled>
                                <label id="callsign1_lbl">FUEL AGENCY INFO</label>
                            </div>
                        </div>
                      </div>

                      <div class="col-md-2 quantity_wrapper">
                        <div class="form-group">
                        <div class="ltrim_sec">
                             <div class="group dynamiclabel">
                                <input  type="text" name="quantity"  minlength="3" maxlength="5" id="quantity" class="text-center font-bold form-control bold_placeholder numeric fuelbill_calculation" placeholder="QTY (in Litres)" data-toggle="popover" data-placement="top" autocomplete="off">
                                <label>QTY (in Litres)</label>
                            </div>
                         </div>
                        </div>
                      </div>

                      <div class="col-md-3 eflightprice_wrapper">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                            <input id="eflight_price" name="eflight_price" type="text" class="text-center font-bold text_uppercase form-control number numbers_decimal fuelbill_calculation" placeholder="EFLIGHT PRICE" data-v-max="999999.99" data-m-dec="2" maxlength="9" data-toggle="popover" data-placement="top" autocomplete="off">
                            <label>EFLIGHT PRICE</label>
                            </div>
                         </div>
                      </div>
                    </div><!--first row close here-->
                    <div class="col-md-12 secondrow">
                       <div class="col-md-3 operator_wrapper">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                            <input id="operator1" name="operator" type="text" class="text-center font-bold text_uppercase form-control" placeholder="OPERATOR" autocomplete="off" disabled>
                            <label>OPERATOR</label>
                            </div>
                         </div>
                      </div>
                      <div class="col-md-3 datepicker_wrapper1">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                            <input  type="text" id="fuelbill_date_of_flight" name="date_of_flight" class="text-center font-bold text_uppercase form-control blling_flightdate white_bg"  readonly data-toggle="popover" placeholder="FLIGHT DATE" data-placement="top" autocomplete="off">
                            <label id="fuelbill_date_of_flight_lbl" class="hide"> FLIGHT DATE</label>
                            <p id="flight_date1_lbl" style="display: none"  class="top_level">FLIGHT DATE</p>
                           </div>
                         </div>
                      </div>
                       <div class="col-md-2 fakeinput_wrapper time_wrapper" style="padding-left:22px;">
                            <div class="ltrim_sec">
                                <div class="group dynamiclabel fakeinput">
                                    <input type="text" name="time" id="hhbill_time" maxlength="2" style="padding-left:19px;display:inline-block;" size="2" class="mini_input numeric 
                                    bill_time hhtime form-control" autocomplete="off" placeholder="HH" data-toggle="popover" data-placement="top" /><label>DEP TIME UTC</label><span id="bill_time_lbl" class="billingtime_span"></span><div style="display:inline-block;" class="slash">:</div><input style="padding-left:5px;display:inline-block" type="text" maxlength="2" size="2" class="mini_input numeric bill_time mmtime form-control" id="mmbill_time" placeholder="MM" autocomplete="off" data-toggle="popover" data-placement="top" />
                                </div>
                            </div>
                        </div>
                       
                      <div class="newbtnv1 b-radius-5 btn_wrapper">
                          <input  id="fuelbill_btn" class="btn btn_appearance btnwidth billing_btn pointer"  @if($fuel == 'true' && $handling  == 'false' && $hotel  == 'false' && $cab  == 'false' && $misc  == 'false') value="SUBMIT" data-value="SUBMIT" @else value="NEXT" data-value="NEXT" @endif type="button" data-section="{{$section_count}}" data-edit='2'>
                      </div>
                      
                    </div><!--secondrow close here-->
             </div><!--fuelbillbody close here-->
        </div>
        @endif  
        @if($handling == 'true')  
         <?php $section_count++;?>
        <div class="col-md-12 section{{$section_count}} fuelbillmain_wrapper @if($fuel == 'false' && $handling  == 'true') @else hide @endif" style="margin-top:2px;" id='airport_handing'>
             <div class="col-md-12 fuelbillheading_wrapper" style="cursor: pointer;">
                  <p class="fuelbillp">AIRPORT HANDLING</p>
             </div>
             <div class="col-md-12 fuelbillbody" id="collapse_reg{{$section_count}}">
                    <div class="col-md-12 firstrow" style="margin-bottom:35px;">

                     <div class="col-md-2 callsign_wrapper">
                          <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                             <input  type="text" id="aircraft_callsign2" class="text-center font-bold text_uppercase form-control callsign special_symbols" placeholder="Call Sign" data-toggle="popover" data-placement="top" autocomplete="off">
                             <label id="callsign1_lbl"> CALL SIGN</label>
                          </div>
                         </div>
                      </div>

                      <div class="col-md-3 airportwrapper" style="width: 33%;padding-right:0;">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                             <input  type="text" id="airport2" class="text-center font-bold text_uppercase form-control bold_placeholder airport alphabets" placeholder="Airport" data-toggle="popover" data-placement="top" maxlength="3" autocomplete="off">
                            <label>Airport</label>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-3 datepicker_wrapper1">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                            <input  type="text" class="text-center font-bold text_uppercase form-control white_bg" readonly id="airporthandling_date_of_flight_arrival" data-toggle="popover" data-placement="top" placeholder="ARR DATE" autocomplete="off" data-date-range-end="#airporthandling_date_of_flight_dept">
                            <label class="dateofflight_label hide" id="airporthandling_date_of_flight_arrival_lbl">ARR DATE</label>
                           </div>
                         </div>
                      </div>

                      <div class="col-md-3 datepicker_wrapper1">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                            <input  type="text" class="text-center font-bold text_uppercase form-control  white_bg" readonly id="airporthandling_date_of_flight_dept" data-toggle="popover" data-placement="top" placeholder="DEP DATE" autocomplete="off"  data-date-range-start="#airporthandling_date_of_flight_arrival">
                            <label class="dateofflight_label hide" id="airporthandling_date_of_flight_dept_lbl">DEP DATE</label>
                           </div>
                         </div>
                      </div>
                    
                      <div class="col-md-3 eflightprice_wrapper" style="width:19%;padding-left:20px;">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                            <input id="actual_bill1" name="eflight_price" type="text" class="text-center font-bold text_uppercase form-control number numbers_decimal fuelbill_calculation" placeholder="EFLIGHT PRICE" data-v-max="999999.99" data-m-dec="2" maxlength="9" data-toggle="popover" data-placement="top" autocomplete="off">
                            <label>EFLIGHT PRICE</label>
                            </div>
                         </div>
                      </div>

                    </div><!--first row close here-->
                    <div class="col-md-12 secondrow" style="margin-bottom:24px;">

                       <div class="col-md-3 handling_wrapper">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                             <input  type="text" class="text-center font-bold text_uppercase form-control bold_placeholder alphabets_numeric_with_space" placeholder="HANDLING AGENCY" maxlength="25" id="handling_agency" data-toggle="popover" data-placement="top" autocomplete="off" >
                            <label>HANDLING AGENCY</label>
                            <img class="handlinginfo_image" style="" src="{{url('media/images/payment/info_new.PNG')}}"/>
                            </div>
                         </div>
                      </div>
                      
                      <div class="col-md-2 time_wrapper">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                            <input type="text" maxlength="2" style="padding-left:19px;display:inline-block;" size="2" class="mini_input numbers_colon 
                            hhhandling_arrival_time form-control" name="hhhandling_arrival_time" id="hhhandling_arrival_time" autocomplete="off" placeholder="HH" data-toggle="popover" data-placement="top"/><label id="hhhandling_arrival_time_lbl">ARR TIME UTC</label><div style="display:inline-block;" class="slash" id="dept_slash">:</div><input style="padding-left:5px;display:inline-block" name="mmhandling_arrival_time" id="mmhandling_arrival_time"type="text" maxlength="2" size="2" class="mini_input numbers_colon mmhandling_arrival_time form-control" placeholder="MM" autocomplete="off" data-toggle="popover" data-placement="top" />
                            <span id="handling_arrival_time_lbl" class="billingtime_span"></span>
                          </div>
                         </div>  
                      </div>

                      <div class="col-md-2 time_wrapper" style="padding-left:22px;width:18%;">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                            <input type="text" maxlength="2" style="padding-left:19px;display:inline-block;" size="2" class="mini_input numbers_colon 
                            hhhandling_dept_time form-control" name="hhhandling_dept_time" id="hhhandling_dept_time" autocomplete="off" placeholder="HH" data-toggle="popover" data-placement="top"/><label id="hhhandling_arrival_time_lbl">DEP TIME UTC</label><div style="display:inline-block;" class="slash" id="dept_slash">:</div><input style="padding-left:5px;display:inline-block" name="mmhandling_dept_time" id="mmhandling_dept_time"type="text" maxlength="2" size="2" class="mini_input numbers_colon mmhandling_dept_time form-control" placeholder="MM" autocomplete="off" data-toggle="popover" data-placement="top" />
                            <span id="handling_dept_time_lbl" class="billingtime_span"></span>
                          </div>
                         </div>  
                      </div>

                      <div class="newbtnv1 b-radius-5 btn_wrapper">
                          <input  id="airporthandling_btn" class="btn btn_appearance btnwidth billing_btn pointer" 
                          <input  id="airporthandling_btn" class="btn btn_appearance btnwidth billing_btn pointer" @if(($fuel == 'false' && $handling  == 'true' && $hotel  == 'false' && $cab  == 'false' && $misc  == 'false')||($handling  == 'true' && $hotel  == 'false' && $cab  == 'false' && $misc  == 'false')) value="SUBMIT" data-value="SUBMIT"  @else value="NEXT" data-value="NEXT" @endif  type="button"  data-section="{{$section_count}}" data-edit='2'>
                      </div>
                    </div><!--secondrow close here-->
                    <div class="col-md-12 remarks_wrapper" style="margin-bottom:15px;">
                         <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                                <input  type="text" class="text-center font-bold text_uppercase form-control special_symbols1 remarks" placeholder="REMARKS" id="remarks" data-toggle="popover" data-placement="top" maxlength="150" autocomplete="off">
                                <label>REMARKS</label>
                            </div>
                         </div>
                    </div>
             </div><!--fuelbillbody close here-->
        </div>
        @endif
        @if($hotel == 'true') 
        <?php $section_count++;?>
        <div class="col-md-12 section{{$section_count}} fuelbillmain_wrapper @if($fuel == 'false' && $handling  == 'false' && $hotel  == 'true')  '' @else hide @endif" style="margin-top:2px;" id="hotel_bill">
             <div class="col-md-12 fuelbillheading_wrapper" style="cursor: pointer;">
                  <p class="fuelbillp">HOTEL BILL</p>
             </div>
             <div class="row hotelbillbody" id="collapse_reg{{$section_count}}">
             <div class="col-md-12 fuelbillbody hot_bill">
                    <div class="col-md-12 firstrow" style="margin-bottom:30px;">

                      <div class="col-md-3 handling_wrapper">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                             <input  type="text" class="text-center font-bold text_uppercase form-control alphabets_numeric_with_space hotel_name" placeholder="HOTEL NAME" data-toggle="popover" data-placement="top" id="hotel_name1"  maxlength="25" autocomplete="off">
                            <label>HOTEL NAME</label>
                            <img class="handlinginfo_image" style="" src="{{url('media/images/payment/info_new.PNG')}}"/>
                            </div>
                         </div>
                      </div>

                      <div class="col-md-3 datepicker_wrapper1">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                            <input  type="text" class="text-center font-bold text_uppercase form-control checkin_flightdate white_bg" readonly data-count="1" placeholder="CHECK IN" data-date-range-end="#checkout_flightdate1" id="checkin_flightdate1" autocomplete="off" data-toggle="popover" data-placement="top" >
                            <label class="dateofflight_label hide" id="checkin_flightdate1_lbl">CHECK IN</label>
                           </div>
                         </div>
                      </div>

                      <div class="col-md-3 datepicker_wrapper1">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                            <input  type="text" class="text-center font-bold text_uppercase form-control checkout_flightdate white_bg" readonly id="checkout_flightdate1" placeholder="CHECK OUT" data-date-range-start="#checkin_flightdate1" autocomplete="off" data-toggle="popover" data-placement="top" >
                            <label class="dateofflight_label hide" id="checkout_flightdate1_lbl">CHECK OUT</label>
                           </div>
                         </div>
                      </div>

                      <div class="col-md-3 eflightprice_wrapper" style="width:19%;padding-left:20px;">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                            <input id="hotelbill_actualbill1" name="eflight_price" type="text" class="text-center font-bold text_uppercase form-control number numbers_decimal fuelbill_calculation hotelbill_actualbill" placeholder="EFLIGHT PRICE" data-v-max="999999.99" data-m-dec="2" maxlength="9" data-toggle="popover" data-placement="top" autocomplete="off">
                            <label>EFLIGHT PRICE</label>
                            </div>
                         </div>
                      </div>

                    </div>

                    <div class="col-md-12 secondrow" style="margin-bottom:24px;">

                      <div class="col-md-3 handling_wrapper">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                             <input  type="text" class="text-center font-bold text_uppercase form-control guest alphabets_numeric_with_space hotelbill_guest" placeholder="GUEST NAME" id="hotelbill_guest1" maxlength="25" data-toggle="popover" data-placement="top" autocomplete="off">
                            <label>GUEST NAME</label>
                            <img class="handlinginfo_image hotelbill_add" data-count="1" src="{{url('media/images/payment/add_new.PNG')}}"/>
                            </div>
                         </div>
                      </div>

                      
                      <div class="col-md-2 time_wrapper">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                            <input type="text" maxlength="2" style="padding-left:19px;display:inline-block;" size="2" class="mini_input numbers_colon 
                            hhhotelbill_intime form-control" name="hhhotelbill_intime1" id="hhhotelbill_intime1" autocomplete="off" placeholder="HH" data-toggle="popover" data-placement="top" data-count="1"/><label id="hhhandling_arrival_time_lbl">IN TIME UTC</label><div style="display:inline-block;" class="slash" id="dept_slash">:</div><input style="padding-left:5px;display:inline-block" name="mmhandling_dept_time1" id="mmhotelbill_intime1"type="text" maxlength="2" size="2" class="mini_input numbers_colon mmhotelbill_intime form-control" placeholder="MM" autocomplete="off" data-toggle="popover" data-placement="top" data-count="1"/>
                            <span id="hotelbill_intime1_lbl" class="billingtime_span"></span>
                          </div>
                         </div>  
                      </div>

                      <div class="col-md-2 time_wrapper" style="padding-left:22px;width:18%;">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                            <input type="text" maxlength="2" style="padding-left:19px;display:inline-block;" size="2" class="mini_input numbers_colon 
                            hhhotelbill_outtime form-control" name="hhhotelbill_outtime1" id="hhhotelbill_outtime1" autocomplete="off" placeholder="HH" data-toggle="popover" data-placement="top" data-count="1"/><label id="hhhandling_arrival_time_lbl">OUT TIME UTC</label><div style="display:inline-block;" class="slash" id="dept_slash">:</div><input style="padding-left:5px;display:inline-block" name="mmhotelbill_outtime1" id="mmhotelbill_outtime1"type="text" maxlength="2" size="2" class="mini_input numbers_colon mmhotelbill_outtime form-control" placeholder="MM" autocomplete="off" data-toggle="popover" data-placement="top" data-count="1"/>
                            <span id="hotelbill_outtime1_lbl" class="billingtime_span"></span>
                          </div>
                         </div>  
                      </div>
                      <div class="newbtnv1 b-radius-5 btn_wrapper hotelbillbtn_wrapper" id="hotel_btn_div">
                         <input  id="hotel_btn"  class="btn btn_appearance btnwidth billing_btn pointer" type="button" data-section="{{$section_count}}" data-edit='2' @if(($fuel == 'false' && $handling  == 'false' && $hotel  == 'true' && $cab  == 'false' && $misc  == 'false')||($hotel  == 'true' && $cab  == 'false' && $misc  == 'false') ) value="SUBMIT" data-value="SUBMIT" @else value="NEXT" data-value="NEXT" @endif >
                      </div>
                    </div>
                    <div class="col-md-12 remarks_wrapper" style="margin-bottom:15px;">
                         <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                                <input  type="text" class="text-center font-bold text_uppercase form-control special_symbols1 remarks hotelbill_remarks" placeholder="REMARKS" id="hotelbill_remarks1" data-toggle="popover" data-placement="top" maxlength="150" autocomplete="off">
                                <label>REMARKS</label>
                            </div>
                         </div>
                    </div>

             </div>
            </div><!--row close here-->
            
        </div>
       @endif
       @if($cab == 'true')
        <?php $section_count++;?> 
        <div class="col-md-12 fuelbillmain_wrapper section{{$section_count}} @if($fuel == 'false' && $handling  == 'false' && $hotel  == 'false' && $cab  == 'true') @else hide @endif" style="margin-top:2px;" id="crew_transport">
             <div class="col-md-12 fuelbillheading_wrapper" style="cursor: pointer;">
                  <p class="fuelbillp">CREW TRANSPORT</p>
             </div>
             <div class="row crewbody" id="collapse_reg{{$section_count}}">
             <div class="col-md-12 fuelbillbody">
                    <div class="col-md-12 firstrow" style="margin-bottom:30px;">

                      <div class="col-md-3 handling_wrapper" style="width: 81%;">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                             <input  type="text" class="text-center font-bold text_uppercase form-control bold_placeholder cab_company alphabets_numeric_with_space" placeholder="CAB COMPANY NAME" id="cab_company1" maxlength="25" data-toggle="popover" data-placement="top" autocomplete="off">
                            <label>CAB COMPANY NAME</label>
                            </div>
                         </div>
                      </div>

                      <div class="col-md-3 eflightprice_wrapper" style="width:19%;padding-left:20px;">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                            <input id="cab_actualbill1" name="eflight_price" type="text" class="text-center font-bold text_uppercase form-control number numbers_decimal fuelbill_calculation crew_actualbill" placeholder="EFLIGHT PRICE" data-v-max="999999.99" data-m-dec="2" maxlength="9" data-toggle="popover" data-placement="top" autocomplete="off">
                            <label>EFLIGHT PRICE</label>
                            </div>
                         </div>
                      </div>

                    </div><!--first row close here-->
                    <div class="col-md-12 secondrow">
                        <div class="col-md-12 remarks_wrapper" style="margin-bottom:15px;padding-left:0;width: 80%;">
                            <div class="ltrim_sec">
                                <div class="group dynamiclabel">
                                    <input  type="text" class="text-center font-bold text_uppercase form-control special_symbols1 remarks crew_remarks" placeholder="REMARKS" id="crewtransport_remarks1" data-toggle="popover" data-placement="top" maxlength="150" autocomplete="off">
                                    <label>REMARKS</label>
                                </div>
                            </div>
                        </div>
                      <div class="newbtnv1 b-radius-5 btn_wrapper crewbtn_wrapper">
                         <input  id="cab_btn"  class="btn btn_appearance btnwidth billing_btn pointer" type="button"  data-section="{{$section_count}}" data-edit='2' @if(($fuel == 'false' && $handling  == 'false' && $hotel  == 'false' && $cab  == 'true' && $misc  == 'false')||($cab  == 'true' && $misc  == 'false')) value="SUBMIT"  data-value="SUBMIT" @else value="NEXT" data-value="NEXT" @endif>
                      </div>
                      <div class="col-md-12 text_enter">
                         
                            <div style="margin-top:5px;width:100%;text-align:center;color: #f1292b;text-transform: uppercase" class="hide">
                                <div class="success-left animated infinite zoomIn custdelay" id="cab_btn_lbl"  style="font-size: 10px;color: red;font-weight: bold;">
                                    PLEASE ENTER CORRECT DETAILS
                                </div>
                            </div>
                      </div>
                    </div><!--secondrow close here-->

             </div><!--fuelbillbody close here-->
            </div><!--row close here-->
        </div>   
        @endif
        @if($misc == 'true') 
         <?php $section_count++;?>  
        <div class="col-md-12 section{{$section_count}} fuelbillmain_wrapper @if($fuel == 'false' && $handling  == 'false' && $hotel  == 'false' && $cab  == 'false' && $misc  == 'true') @else hide @endif" style="margin-top:2px;" id="misc_bill">
             <div class="col-md-12 fuelbillheading_wrapper" style="cursor: pointer;">
                  <p class="fuelbillp">MISC BILL</p>
             </div>
             <div class="col-md-12 fuelbillbody miscbody" id="collapse_reg{{$section_count}}">
                    <div class="col-md-12 firstrow" style="margin-bottom:30px;">

                      
                      <div class="col-md-3 handling_wrapper" style="width: 81%;">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                             <input  type="text" class="text-center font-bold text_uppercase form-control bold_placeholder service_desc alphabets_numeric_with_space_hypen" placeholder="SERVICE DESCRIPTION" data-toggle="popover" data-placement="top"
                            maxlength="150" id="service_desc1" autocomplete="off">
                            <label>SERVICE DESCRIPTION</label>
                            </div>
                         </div>
                      </div>

                      <div class="col-md-3 eflightprice_wrapper" style="width:19%;padding-left:20px;">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                            <input id="misc_actual_bill1" name="eflight_price" type="text" class="text-center font-bold text_uppercase form-control number numbers_decimal fuelbill_calculation misc_actual_bill" placeholder="EFLIGHT PRICE" data-v-max="999999.99" data-m-dec="2" maxlength="9" data-toggle="popover" data-placement="top" autocomplete="off">
                            <label>EFLIGHT PRICE</label>
                            </div>
                         </div>
                      </div>

                    </div><!--first row close here-->
                    <div class="col-md-12 secondrow">
                       <div class="col-md-12 remarks_wrapper" style="margin-bottom:15px;padding-left:0;width: 80%;">
                            <div class="ltrim_sec">
                                <div class="group dynamiclabel">
                                    <input  type="text" class="text-center font-bold text_uppercase form-control special_symbols1 misc_remarks" placeholder="REMARKS" id="miscbill_remarks1" data-toggle="popover" data-placement="top" maxlength="150" autocomplete="off">
                                    <label>REMARKS</label>
                                </div>
                            </div>
                        </div>    
                      <div class="newbtnv1 b-radius-5 btn_wrapper miscbtn_wrapper">
                         <input type="button" id="misc_btn" class="btn btn_appearance btnwidth billing_btn" value="SUBMIT" data-value="SUBMIT" style="cursor: pointer;" data-section="{{$section_count}}" data-edit='2'>
                      </div>
                      <div class="col-md-12 text_enter">
                            <div style="margin-top:5px;width:100%;text-align:center;color: #f1292b;text-transform: uppercase" class="hide" >
                                <div class="success-left animated infinite zoomIn custdelay"  id="misc_btn_lbl" style="font-size: 10px;color: red;font-weight: bold;">
                                   PLEASE ENTER CORRECT DETAILS
                                </div>
                            </div>
                      </div>
                    </div>
             </div><!--fuelbillbody close here-->
        </div>
        
        @endif
        {{csrf_field()}}
       
       </form>
       </div>
     </div>
    </div> <!--article close here-->
  </div><!--main close here-->
</div><!--wrapper close here-->
@include('includes.new_footer',[])
     <!-- EDIT modal-->
     <div class="modal fade" id="edit_modal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
         <div class="modal-dialog modal-container" role="document">
             <header class="popupHeader">
                 <span class="header_title" id="billing_header"></span>
                 <span class="modal_close" data-dismiss="modal">
                     <i class="fa fa-times-circle"></i>
                 </span>
             </header>   
             <section class="popupBody">
                 <div class="modal-body" style="text-align: center;padding:15px;">
                     <div class="row">
                         <div class="col-md-12"> 
                             <p class="model_font"><span id="modal_message" class="modal_message">ARE YOU SURE TO EDIT <span id="billing_msg"></span></span></p>    
                         </div>
                     </div>
                     <div class="row" style="text-align:center;margin-top:20px">
                         <form action="#" id="" >
                            <div class="col-md-12">
                                <button type="button" class="btn_secondary newbtnv1 modal_btn_navlog"  style="width:25%;line-height:27px;" id="edit_yes" data-url="{{url('navlog_cancel')}}" data-value="">Yes</button>
                            </div>
                         </form>
                     </div>      
                 </div>
             </section>
         </div>
     </div>
     <!-- EDIT modal-->
</div>
<script>
 $(document).ready(function() {
    

     $("#aircraft_callsign1").on('keyup', function() {
        var aircraft_callsign = $(this).val().toUpperCase();
        var data_url = $(this).attr('data-url');
        var data = {
            'aircraft_callsign': aircraft_callsign, 
        };
        if (aircraft_callsign.length >= 5) {
            $.ajax({
                url: base_url + "/billing/callsign_operator",
                data: data,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data) {
                    $("#operator1").val(data.operator.toUpperCase());
                },
                error: function(data) {
                    //console.log(data);
                }
            })
        } 
    });
     $('.sticky').sticky( {topSpacing: 20} );
            $(".number").autoNumeric("init",{ aSep: ''});
            $(".dropdown2 dt a").click(function() {
                $(".dropdown2 dd ul").toggle();
            });      
            $(".dropdown2 dd ul li a").click(function() {
                var text = $(this).html();
                closePopover("#sample");
                $(".dropdown2 dt a span").html(text);
                $(".dropdown2 dd ul").hide();
                $('#quantity').focus();
                $("#fuelbill_fuelagency_lbl").removeClass('hide');
                $("#result").html("Selected value is: " + getSelectedValue("sample"));
            });
            function getSelectedValue(id) {
                return $("#" + id).find("dt a span.value").html();
            }
            $(document).bind('click', function(e) {
                var $clicked = $(e.target);
               
                if (! $clicked.parents().hasClass("dropdown2")){
                     $(".dropdown2 dd ul").hide();
                   } 
            });
        });
    Vue.http.headers.common['X-CSRF-TOKEN'] = $("meta[name=_token]").attr('content');
    new Vue({
        el: "#quick_app",
        data: {
                quantity:"",
                efl_price:"",
                fuel_amount:""
        },
        methods: {
            send_otp2: function (e) {
                e.preventDefault();
                var data_url = base_url + "/billing/send_otp";
                var formdata = $("#send_otp").serializeArray();
                var data = {};
                $(formdata).each(function (index, obj) {
                    data[obj.name] = obj.value;
                });
                $("#send_otp").attr("disabled", "disabled").css("cursor", "not-allowed");
                $(".success").html('<span><a style="color:red"><i class="fa fa-spinner fa-spin"></i></a> Please wait ...</span>');
                this.$http.post(data_url, data).then(function (data) {
                
                });
            },
            get_fuel_amount: function(e){
                
                if(e == 'e'){
                    if(this.quantity != ""){
                      $("#eflight_price").css("border", "lightgrey 1px solid");
                    }else{
                      $("#eflight_price").css("border", "#f1292b 1px solid");
                    }
                }else if(e == 'q'){
                    if(this.quantity != ""){
                    $("#quantity").css("border", "lightgrey 1px solid");
                    }else{
                     $("#quantity").css("border", "#f1292b 1px solid");
                    }
                }
                if(this.quantity != "" && this.efl_price != ""){
                   this.fuel_amount =  parseInt(this.quantity) * parseInt(this.efl_price);
              }
               this.total_fuel_amount(e)
            },
            total_fuel_amount: function(e){
                var fuel_amount    = 0;
                if(this.quantity != "" && this.efl_price != ""){
                   fuel_amount =  parseInt(this.quantity) * parseInt(this.efl_price);
              }
                var actual_bill1   = ($("#actual_bill1").val()) ? $("#actual_bill1").val() : '0';
                var actual_bill2   = ($("#actual_bill2").val()) ? $("#actual_bill2").val() : "0";
                var actual_bill3   = ($("#actual_bill3").val()) ? $("#actual_bill3").val() : "0";
                var actual_bill4   = ($("#actual_bill4").val()) ? $("#actual_bill4").val() : "0";
                
                if(actual_bill4 != "" && actual_bill4 != "0"){
                      var total =  parseInt(fuel_amount) + parseInt(actual_bill1) + parseInt(actual_bill2) + parseInt(actual_bill3) + parseInt(actual_bill4);
                      $("#total_amount4").val(total);
                      $("input[name='amount'").val(total);
                 }else if(actual_bill3 != "" && actual_bill3 != "0"){
                      var total =  parseInt(fuel_amount) + parseInt(actual_bill1) + parseInt(actual_bill2) + parseInt(actual_bill3);
                       $("#total_amount3").val(total);
                       $("input[name='amount'").val(total);
                 }else if(actual_bill2 != "" && actual_bill2 != "0"){
                      var total =  parseInt(fuel_amount) + parseInt(actual_bill1) + parseInt(actual_bill2);
                      $("#total_amount2").val(total);
                      $("input[name='amount'").val(total);
                }else if(actual_bill1 != ""  && actual_bill1 != "0"){
                      var total =  parseInt(fuel_amount) + parseInt(actual_bill1);
                      $("#total_amount1").val(total);
                      $("input[name='amount'").val(total);
                }else if(fuel_amount != ""){
                      var total =  parseInt(fuel_amount);
                      $("input[name='amount'").val(total);
                }  
            }
        }
    });
    var currentTime = new Date() 
    var minDate = new Date(currentTime.getFullYear(), currentTime.getMonth() -1, +1); //one day next before month
    var maxDate =  new Date(currentTime.getFullYear(), currentTime.getMonth() +2, +0); // one day before next month
    $(".blling_flightdate").datepicker({
            dateFormat: 'd-M-yy',
            minDate: minDate, 
            maxDate: maxDate, 
            showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true,
            onSelect: function(selectedDate) 
            {   
                closePopover("#"+$(this).attr('id'));
                $(".notify-bg-v").fadeOut();
                var dateid=$(this).attr('id');
                $("#"+dateid+'_lbl').removeClass('hide');
               if(dateid=='fuelbill_date_of_flight')
                 
                  $("#hhbill_time").focus();
                else if(dateid=='airporthandling_date_of_flight')
                 $("#handling_time").focus();
                else if(dateid=='cab_date_of_flight1')
                 $("#carno1").focus();

            }
    });
   
    $(".blling_flightdate,#checkin_flightdate1,#checkout_flightdate1,#airporthandling_date_of_flight_arrival,#airporthandling_date_of_flight_dept").click(function () {
        $(".notify-bg-v").fadeIn();
        $('.notify-bg-v').css('height',0);
        $('.notify-bg-v').css('height', $(document).height());
    });
    $("#checkout_flightdate1,#airporthandling_date_of_flight_dept").datepicker({ 
              dateFormat: 'd-M-yy',
              showMonthAfterYear: true,
              closeText: 'Clear',
              minDate: minDate, 
              maxDate: maxDate, 
    });  
    $("#checkin_flightdate1").datepicker({  
       dateFormat: 'd-M-yy',
       showMonthAfterYear: true,
       closeText: 'Clear',
       minDate: minDate, 
       showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true,
       maxDate: maxDate, 
       onSelect: function(selectedDate) 
       { 
          var data_id=$(this).attr('data-count'); 
          //alert(data_id);
          if($("#"+$(this).attr('id')).val()!=""){
          $("#"+$(this).attr('id')+'_lbl').removeClass('hide');
          closePopover("#"+$(this).attr('id'));
          }
          if($("#checkout_flightdate1").val()!=''){
            closePopover("#checkout_flightdate1");
             $('#checkout_flightdate1_lbl').removeClass('hide');
          }
          if($("#checkout_flightdate1").val()!="")
          {
              $(".notify-bg-v").fadeOut();
          }
           CheckHotelTime(data_id);
       }
     });
    $("#airporthandling_date_of_flight_arrival").datepicker({  
       dateFormat: 'd-M-yy',
       showMonthAfterYear: true,
       closeText: 'Clear',
       minDate: minDate, 
       showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true,
       maxDate: maxDate, 
       onSelect: function(selectedDate) 
       {  
          if($("#"+$(this).attr('id')).val()!=""){
           closePopover("#"+$(this).attr('id'));
           $("#"+$(this).attr('id')+'_lbl').removeClass('hide');
          }
          if($("#airporthandling_date_of_flight_dept").val()!=''){
            closePopover("#airporthandling_date_of_flight_dept");
            $("#airporthandling_date_of_flight_dept_lbl").removeClass('hide');
          }
          if($("#airporthandling_date_of_flight_dept").val()!="")
          {
              $(".notify-bg-v").fadeOut();
          }
          //console.log(selectedDate)
          CheckAirportTime($(this))
       }
     });
    $('#checkin_flightdate1,#airporthandling_date_of_flight_arrival').focusin(function(){  
        if($(this).val()=="")
          $(this).addClass('focusin');
         else
          $(this).removeClass('focusin');  
      });
    $('#checkin_flightdate1,#airporthandling_date_of_flight_arrival').focusout(function(){  
         $(this).removeClass('focusin');  
      });
     $("#checkin_flightdate1,#airporthandling_date_of_flight_arrival").click(function() {  
       $(this).focus();
     });
     $("#checkout_flightdate1,#airporthandling_date_of_flight_dept").bind("click focus", function() {
       $($(this).data("date-range-start")).click();
     });

    $('body').on('click','.ui-datepicker-trigger',function (){       
             $(".notify-bg-v").fadeIn();
             $('.notify-bg-v').css('height',0);
             $('.notify-bg-v').css('height', $(document).height());
    });
    $(".ui-datepicker-trigger").click(function(){
             $(".notify-bg-v").fadeIn();
             $('.notify-bg-v').css('height',0);
             $('.notify-bg-v').css('height', $(document).height());
    });
    $('body').on('click','.hotelbill_add',function(){
      if($('.hot_bill').length>=5)
        return false;

       var btn=$("#hotel_btn_div").clone(); 
       //var btn_lbl=$("#hotel_btn_lbl").parent().parent().clone(); 
     //  $("#hotel_btn_lbl").parent().parent().remove(); 
       $("#hotel_btn_div").remove();

       //console.log(btn);
       var count=parseInt($(this).attr('data-count'));
       var hotelbill_remarks_count=count+1;
       $(this).attr('data-count',hotelbill_remarks_count);  
       if($('.hot_bill').length<4) 
        var add=`<img class="handlinginfo_image hotelbill_add" data-count="${hotelbill_remarks_count}" src="{{url('media/images/payment/add_new.PNG')}}">`;
       else
        var add='';
        $(".hotelbillbody").append(`<div class="col-md-12 fuelbillbody hot_bill">
                    <div class="col-md-12 firstrow" style="margin-bottom:30px;">
                      <div class="col-md-3 handling_wrapper">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                             <input type="text" class="text-center font-bold text_uppercase form-control alphabets_numeric_with_space hotel_name" placeholder="HOTEL NAME" data-toggle="popover" data-placement="top" id="hotel_name${hotelbill_remarks_count}" maxlength="25" autocomplete="off" data-original-title="" title="">
                            <label>HOTEL NAME</label>
                            <img class="handlinginfo_image" style="" src="{{url('media/images/payment/info_new.PNG')}}">
                            </div>
                         </div>
                      </div>
                      <div class="col-md-3 datepicker_wrapper1">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                            <input  type="text" class="text-center font-bold text_uppercase form-control checkin_flightdate white_bg" readonly data-count="${hotelbill_remarks_count}" id="checkin_flightdate${hotelbill_remarks_count}" data-date-range-end="#checkout_flightdate${hotelbill_remarks_count}" autocomplete="off" data-toggle="popover" data-placement="top" data-id="${hotelbill_remarks_count}" placeholder="CHECK IN">
                            <label class="dateofflight_label hide" id="checkin_flightdate${hotelbill_remarks_count}_lbl">CHECK IN</label>
                           </div>
                         </div>
                      </div>
                      <div class="col-md-3 datepicker_wrapper1">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                            <input  type="text" class="text-center font-bold text_uppercase form-control checkout_flightdate white_bg"  readonly id="checkout_flightdate${hotelbill_remarks_count}" data-date-range-start="#checkin_flightdate${hotelbill_remarks_count}" autocomplete="off" data-toggle="popover" data-placement="top" placeholder="CHECK OUT">
                            <label class="dateofflight_label hide" id="checkout_flightdate${hotelbill_remarks_count}_lbl">CHECK OUT</label>
                           </div>
                         </div>
                      </div>
                      <div class="col-md-3 eflightprice_wrapper" style="width:19%;padding-left:20px;">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                            <input id="hotelbill_actualbill${hotelbill_remarks_count}" name="eflight_price" type="text" class="text-center font-bold text_uppercase form-control number numbers_decimal fuelbill_calculation hotelbill_actualbill" placeholder="EFLIGHT PRICE" data-v-max="999999.99" data-m-dec="2" maxlength="9" data-toggle="popover" data-placement="top" autocomplete="off" data-original-title="" title="">
                            <label>EFLIGHT PRICE</label>
                            </div>
                         </div>
                      </div>
                    </div>
                    <div class="col-md-12 secondrow" style="margin-bottom:24px;">
                      <div class="col-md-3 handling_wrapper">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                             <input type="text" class="text-center font-bold text_uppercase form-control guest alphabets_numeric_with_space hotelbill_guest" placeholder="GUEST NAME" id="hotelbill_guest${hotelbill_remarks_count}" maxlength="25" data-toggle="popover" data-placement="top" autocomplete="off" data-original-title="" title="">
                            <label>GUEST NAME</label>
                            ${add}
                            <img class="handlinginfo_image minus" data-count="${hotelbill_remarks_count}" style="top: -21px;" src="{{url('media/images/payment/remove.PNG')}}">
                            </div>
                         </div>
                      </div>
                      <div class="col-md-2 time_wrapper">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                            <input type="text" maxlength="2" style="padding-left:19px;display:inline-block;" size="2" class="mini_input numbers_colon 
                            hhhotelbill_intime form-control" name="hhhotelbill_intime${hotelbill_remarks_count}" id="hhhotelbill_intime${hotelbill_remarks_count}" autocomplete="off" placeholder="HH" data-toggle="popover" data-placement="top" data-count="${hotelbill_remarks_count}"/><label id="hhhandling_arrival_time_lbl">IN TIME UTC</label><div style="display:inline-block;" class="slash" id="dept_slash">:</div><input style="padding-left:5px;display:inline-block" name="mmhotelbill_intime${hotelbill_remarks_count}" id="mmhotelbill_intime${hotelbill_remarks_count}" type="text" maxlength="2" size="2" class="mini_input numbers_colon mmhotelbill_intime form-control" placeholder="MM" autocomplete="off" data-toggle="popover" data-placement="top" data-count="${hotelbill_remarks_count}"/>
                             <span id="hotelbill_intime${hotelbill_remarks_count}_lbl" class="billingtime_span"></span>
                          </div>
                         </div>  
                      </div>
                      <div class="col-md-2 time_wrapper" style="padding-left:22px;width:18%;">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                            <input type="text" maxlength="2" style="padding-left:19px;display:inline-block;" size="2" class="mini_input numbers_colon 
                            hhhotelbill_outtime form-control" name="hhhotelbill_outtime${hotelbill_remarks_count}" id="hhhotelbill_outtime${hotelbill_remarks_count}" autocomplete="off" placeholder="HH" data-toggle="popover" data-placement="top" data-count="${hotelbill_remarks_count}"/><label id="hhhandling_arrival_time_lbl">OUT TIME UTC</label><div style="display:inline-block;" class="slash" id="dept_slash">:</div><input style="padding-left:5px;display:inline-block" name="mmhotelbill_outtime${hotelbill_remarks_count}" id="mmhotelbill_outtime${hotelbill_remarks_count}"type="text" maxlength="2" size="2" class="mini_input numbers_colon mmhotelbill_outtime form-control" placeholder="MM" autocomplete="off" data-toggle="popover" data-placement="top" data-count="${hotelbill_remarks_count}"/>
                            <span id="hotelbill_outtime${hotelbill_remarks_count}_lbl" class="billingtime_span"></span>
                          </div>
                         </div>  
                      </div>
                     
                    </div>
                    <div class="col-md-12 remarks_wrapper" style="margin-bottom:15px;">
                         <div class="ltrim_sec">
                            <div class="group dynamiclabel">
                                <input type="text" class="text-center font-bold text_uppercase form-control special_symbols1 remarks hotelbill_remarks" placeholder="REMARKS" id="hotelbill_remarks${hotelbill_remarks_count}" data-toggle="popover" data-placement="top" maxlength="150" autocomplete="off" data-original-title="" title="">
                                <label>REMARKS</label>
                            </div>
                         </div>
                    </div>
             </div>`);
            btn.appendTo('#hotel_bill .secondrow:last');
            //btn_lbl.appendTo('#hotel_bill .secondrow:last');
             $("#checkin_flightdate"+hotelbill_remarks_count).click(function () {
                 $(".notify-bg-v").fadeIn();
                 $('.notify-bg-v').css('height',0);
                 $('.notify-bg-v').css('height', $(document).height());
             });
             $("#checkout_flightdate"+hotelbill_remarks_count).click(function () {
                 $(".notify-bg-v").fadeIn();
                 $('.notify-bg-v').css('height',0);
                 $('.notify-bg-v').css('height', $(document).height());
             });
             
             // $("#checkout_flightdate"+hotelbill_remarks_count).datepicker({ 

             //           showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true,
             // });  
             $("#checkin_flightdate"+hotelbill_remarks_count).datepicker({  
                dateFormat: 'd-M-yy',
                showMonthAfterYear: true,
                closeText: 'Clear',
                minDate: minDate, 
                showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true,
                maxDate: maxDate, 
                onSelect: function(selectedDate) 
                { 
                    var data_id=$(this).attr('data-count');
                   //.. console.log('data-id'+data_id);
                    if($("#"+$(this).attr('id')).val()!=""){
                             closePopover("#"+$(this).attr('id'));
                              $("#checkin_flightdate"+data_id+'_lbl').removeClass('hide');
                           }
                    if($("#checkout_flightdate"+data_id).val()!=''){
                             closePopover($("#checkout_flightdate"+data_id));
                             $("#checkout_flightdate"+data_id+'_lbl').removeClass('hide');
                    }
                    if($("#checkout_flightdate"+hotelbill_remarks_count).val()!="")
                    {
                       $(".notify-bg-v").fadeOut();
                    }
                    
                     CheckHotelTime(data_id);
                }
              });
             $(".ui-datepicker-trigger").click(function () {
                 $(".notify-bg-v").fadeIn();
                 $('.notify-bg-v').css('height',0);
                 $('.notify-bg-v').css('height', $(document).height());
             });
             $('#checkin_flightdate'+hotelbill_remarks_count).focusin(function(){  
                 if($(this).val()=="")
                   $(this).addClass('focusin');
                  else
                   $(this).removeClass('focusin');  
               });
             $('#checkin_flightdate'+hotelbill_remarks_count).focusout(function(){  
                  $(this).removeClass('focusin');  
               });
              $("#checkin_flightdate"+hotelbill_remarks_count).click(function() {  
                $(this).focus();
              });
              $("#checkout_flightdate"+hotelbill_remarks_count).bind("click focus", function() {
                $($(this).data("date-range-start")).click();
              });
              $(".number").autoNumeric("init",{ aSep: ''});
              calculation(); 
    });
    $(".crew_add").click(function(){
    var button_text=$("#cab_btn").val();
    $(".crewbtn_wrapper").remove();
    var count=parseInt($(this).attr('data-count'));
    var crewtransport_remarks_count=count+1;
    $(this).attr('data-count',crewtransport_remarks_count);
    if(button_text=='NEXT')
     button_type='button';
    else
      button_type='submit';
        $(".crewbody").append(`<div class="row" style="margin: 0 auto; width: 1000px;">
             <div class="col-md-12 fuelbillbody">
                    <div class="col-md-12 firstrow">
                      <div class="col-md-3 handling_wrapper margin20" style="width:32%;">
                        <div class="form-group">
                            <input  type="text" class="text-center font-bold text_uppercase form-control bold_placeholder cab_company alphabets_numeric_with_space" placeholder="CAB COMPANY NAME" id="cab_company${crewtransport_remarks_count}" maxlength="25" data-toggle="popover" data-placement="top" autocomplete="off">
                        </div>
                      </div>
                      
                      <div class="col-md-3 datepicker_wrapper1" style="padding-left:10px;">
                        <div class="form-group">
                            <label class="dateofflight_label" style="visibility: hidden;">CHECK OUT</label>
                            <input  type="text" class="text-center font-bold text_uppercase form-control blling_flightdate crew_flightdate white_bg" placeholder="DATE" readonly data-toggle="popover" data-placement="top" id="cab_date_of_flight${crewtransport_remarks_count}" data-count="${crewtransport_remarks_count}" autocomplete="off">
                        </div>
                      </div>
                      <div class="col-md-2 time_wrapper margin20" style="padding-left:0px;width:13%;padding-right:10px;">
                        <div class="form-group dynamiclabel">
                            <input  type="text" class="text-center font-bold text_uppercase form-control bold_placeholder card_no alphabets_numeric_with_space_hypen" placeholder="CAR NUMBER" maxlength="15" id="carno${crewtransport_remarks_count}" data-toggle="popover" data-placement="top" autocomplete="off">
                        </div>
                      </div>
                      <div class="col-md-2 time_wrapper margin20" style="padding-left:10px;">
                        <div class="form-group dynamiclabel">
                            <input  type="text" class="text-center font-bold text_uppercase form-control crew_actualbill number" data-v-max="999999.99" data-m-dec="2" maxlength="9" data-toggle="popover" data-placement="top" id="cab_actualbill${crewtransport_remarks_count}" autocomplete="off">
                            <label>ACTUAL BILL</label>
                        </div>
                      </div>
                      <div class="col-md-3 handling_wrapper margin20" style="width: 29%;padding-left:42px;">
                        <div class="form-group">
                            <input  type="text" class="text-center font-bold text_uppercase form-control bold_placeholder guest alphabets_numeric_with_space crew_guest" placeholder="GUEST NAME" id="crewtransport_guest${crewtransport_remarks_count}" maxlength="25" data-toggle="popover" data-placement="top" autocomplete="off">
                        </div>
                      </div>
                    </div><!--first row close here-->
                    <div class="col-md-12 secondrow">
                       <div class="col-md-3 operator_wrapper" style="width:59%;">
                        <div class="form-group dynamiclabel">
                            <input  type="text" class="text-center font-bold text_uppercase form-control special_symbols1 remarks crew_remarks" placeholder="REMARKS" data-toggle="popover" data-placement="top" id="crewtransport_remarks${crewtransport_remarks_count}" maxlength="150" autocomplete="off">
                        </div>
                      </div>
                      <div class="col-md-2 totalamount_wrapper" style="margin-left:20px;width: 10%;margin-right:4px;">
                        <div class="form-group dynamiclabel">
                            <input readonly="readonly"  type="text" id="crew_total_amount${crewtransport_remarks_count}" class="text-center font-bold text_uppercase form-control" placeholder="" autocomplete="off">
                            <label>TOTAL AMOUNT</label>
                        </div>
                      </div>
                      <div class="col-md-1 image_wrapper_first" style="margin-top:4px;">
                           <img style="cursor: pointer;" class="minus" src="{{url('media/images/payment/remove.PNG')}}"/>
                      </div>
                      <div class="newbtnv1 b-radius-5 btn_wrapper crewbtn_wrapper" style="margin-left:0;">
                         <input type="${button_text}" id="cab_btn" class="btn btn_appearance btnwidth billing_btn" value="${button_text}" style="cursor: pointer;">
                      </div>
                    </div><!--secondrow close here-->
             </div><!--fuelbillbody close here-->
             </div>`);
              $(".blling_flightdate").datepicker({
                      dateFormat: 'd-M-yy',
                      minDate: minDate, 
                      maxDate: maxDate, 
                      showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true,
                      onSelect: function(selectedDate) 
                      {   
                          closePopover("#"+$(this).attr('id'));
                          var crew_counter=parseInt($(this).attr('data-count'));
                          $('#carno'+crew_counter).focus()
                          $(".notify-bg-v").fadeOut();
                      }
              });
              $(".number").autoNumeric("init",{ aSep: ''});
              $(".blling_flightdate,.ui-datepicker-trigger").click(function () {
                  $(".notify-bg-v").fadeIn();
                  $('.notify-bg-v').css('height',0);
                  $('.notify-bg-v').css('height', $(document).height());
              });
              calculation(); 
    });
    $(".misc_add").click(function(){
    var button_text=$("#misc_btn").val();
    $(".miscbtn_wrapper").remove();
    var count=parseInt($(this).attr('data-count'));
    var misc_count=count+1;
    $(this).attr('data-count',misc_count);
        $(".miscbody").append(` <div class="col-md-12 firstrow">
                      <div class="col-md-3 handling_wrapper margin20" style="width:72%;padding-right: 10px;">
                        <div class="form-group">
                            <input  type="text" class="text-center font-bold text_uppercase form-control bold_placeholder service_desc alphabets_numeric_with_space_hypen" placeholder="SERVICE DESCRIPTION" data-toggle="popover" data-placement="top"
                            maxlength="150" id="service_desc${misc_count}" autocomplete="off">
                        </div>
                      </div>
                      <div class="col-md-3 datepicker_wrapper1" style="padding-left:30px;width: 17%;">
                        <div class="form-group">
                            <label class="dateofflight_label" style="visibility: hidden;">CHECK OUT</label>
                            <input  type="text" class="text-center font-bold text_uppercase form-control blling_flightdate misc_checkout white_bg" readonly data-toggle="popover" data-placement="top" placeholder="DATE" autocomplete="off" 
                            id="misc_date_of_flight${misc_count}">
                        </div>
                      </div>
                      <div class="col-md-2 time_wrapper margin20" style="padding-left:10px;">
                        <div class="form-group dynamiclabel">
                            <input id="misc_actual_bill${misc_count}"  type="text" class="text-center font-bold numeric form-control misc_actual_bill number" placeholder="" data-v-max="999999.99" data-m-dec="2" maxlength="9" data-toggle="popover" data-placement="top" autocomplete="off">
                            <label>ACTUAL BILL</label>
                        </div>
                      </div>
                    </div><!--first row close here-->
                    <div class="col-md-12 secondrow">
                       <div class="col-md-3 operator_wrapper" style="width:59%;">
                        <div class="form-group dynamiclabel">
                            <input  type="text" class="text-center font-bold text_uppercase form-control special_symbols1 remarks misc_remarks" placeholder="REMARKS" data-toggle="popover" data-placement="top" id="miscbill_remarks${misc_count}" maxlength="150" autocomplete="off">
                        </div>
                      </div>
                      <div class="col-md-2 totalamount_wrapper" style="margin-left:20px;width: 10%;margin-right:4px;">
                        <div class="form-group dynamiclabel">
                            <input readonly="readonly" id="misc_total_amount${misc_count}" name="total_amount4" type="text" class="text-center font-bold text_uppercase form-control" placeholder="" autocomplete="off">
                            <label>TOTAL AMOUNT</label>
                        </div>
                      </div>
                      <div class="col-md-1 image_wrapper_first" style="margin-top:4px;">
                           <img style="cursor: pointer;" class="minus" src="{{url('media/images/payment/remove.PNG')}}"/>
                      </div>
                      <div class="newbtnv1 b-radius-5 btn_wrapper miscbtn_wrapper" style="margin-left:0;">
                         <input type="submit" id="misc_btn" class="btn btn_appearance btnwidth billing_btn" value="CHECKOUT" style="cursor: pointer;">
                      </div>
                    </div>`);
              $(".blling_flightdate").datepicker({
                      dateFormat: 'd-M-yy',
                      minDate: minDate, 
                      maxDate: maxDate, 
                      showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true,
                      onSelect: function(selectedDate) 
                      {   
                          closePopover("#"+$(this).attr('id'));
                          var crew_counter=parseInt($(this).attr('data-count'));
                          $('#carno'+crew_counter).focus()
                          $(".notify-bg-v").fadeOut();
                      }
              });
              $(".number").autoNumeric("init",{ aSep: ''});
              $(".blling_flightdate,.ui-datepicker-trigger").click(function () {
                  $(".notify-bg-v").fadeIn();
                  $('.notify-bg-v').css('height',0);
                  $('.notify-bg-v').css('height', $(document).height());
              });
              calculation(); 
    });
    function errorPopover(id, message) {
          if(id=='#sample')
           $('#sample_agency').addClass('border_bottom');       
          else
            $(id).addClass('border_bottom');
          // $(id).addClass('border_red'); 
          $(id).attr('data-content', message);   
          $(id).popover( {trigger : 'hover'}); 
    }
   function closePopover(id) {
            if(id=='#sample')
              $('#sample_agency').removeClass('border_bottom');               
          
            $(id).popover('destroy');
            $(id).removeClass('border_bottom');
            $(id).css({"border-color": "#a6a6a6"});
            $(this).next().css('display','none');
   }
   $(document).on("blur",".callsign",function(e){ 
          if($(this).val().length <5){
            errorPopover("#"+$(this).attr('id'),"Min. 5 & Max. 7 Characters, Alphabets & Numbers allowed");
          }  
          else
            closePopover("#"+$(this).attr('id'));
      });
   $(document).on("keyup",".callsign",function(e){  
       if($(this).val().length == 5){ 
          var callsign_id=$(this).attr('id');
          if(callsign_id=='aircraft_callsign1')
            $('#airport1').focus();
          else
            $('#airport2').focus();
       }  
   });
   $(document).on("keypress",".special_symbols",function(e){
          if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 48 && e.charCode <= 57) ||(e.charCode==0))
          return true;
          else
          return false; 
   });
   $(document).on("keypress",".special_symbols1",function(e){
       if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 48 && e.charCode <= 57) || (e.charCode==32) ||(e.charCode==0) ||(e.charCode==47) ||(e.charCode==32))
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
   $(document).on("keypress",".alphabets_with_space",function(e){
           if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode==0)|| (e.charCode==32))
           return true;
           else
           return false; 
   });
    $(document).on("keypress",".alphabets_numeric_with_space",function(e){
           if ((e.charCode > 64 && e.charCode < 91) || (e.charCode >= 48 && e.charCode <= 57) || (e.charCode > 96 && e.charCode < 123) || (e.charCode==0)|| (e.charCode==32))
           return true;
           else
           return false; 
   });
    $(document).on("keypress",".alphabets_numeric_with_space_hypen",function(e){
           if ((e.charCode > 64 && e.charCode < 91) || (e.charCode >= 48 && e.charCode <= 57) || (e.charCode > 96 && e.charCode < 123) || (e.charCode==0)|| (e.charCode==32) || (e.charCode==95))
           return true;
           else
           return false; 
   });
   $(document).on("keypress",".numbers_decimal",function(e)     
     {
         if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 32 && e.charCode <46) || (e.charCode ==47) ||(e.charCode >= 58 && e.charCode <= 64) || (e.charCode >= 91 && e.charCode <= 96)|| (e.charCode >= 123 && e.charCode <= 127))
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
   $(document).on("keypress",".alphabets",function(e){
          if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode==0))
          return true;
          else
          return false; 
   });
   $(document).on("keyup",".airport",function(e){ 
       if($(this).val().length >=4){   
         closePopover("#"+$(this).attr('id'));
       }  
   });  
   $(document).on("blur",".airport",function(e){ 
       if($(this).val().length<4){   
         errorPopover("#"+$(this).attr('id'),"Please Select Airport");
       }  
   });
   $(document).on("keyup",".service_desc",function(e){ 
       if($(this).val().length >=3){   
         closePopover("#"+$(this).attr('id'));
       }  
   });  
   $(document).on("blur",".service_desc",function(e){ 
       if($(this).val().length<=2){   
         errorPopover("#"+$(this).attr('id'),"Min. 3 & Max. 150 Alphabets & Numbers allowed");
       }  
   });
   $(document).on("keyup",".misc_remarks",function(e){ 
       if($(this).val().length >=3 || $(this).val()==""){   
         closePopover("#"+$(this).attr('id'));
       }  
   });  
   $(document).on("blur",".misc_remarks",function(e){ 
       if($(this).val().length>=1 && $(this).val().length<3){   
         errorPopover("#"+$(this).attr('id'),"Min. 3 & Max. 150 Alphabets & Numbers allowed");
       }  
   });
   $(document).on("keyup",".number",function(e){ 
       if($(this).val().length >=2){   
         closePopover("#"+$(this).attr('id'));
       }  
   });  
   $(document).on("blur",".number",function(e){ 
       //console.log('blur');
       if($(this).val().length<5){   
         errorPopover("#"+$(this).attr('id'),"Min. 2 & Max. 6 digit allowed");
       }  
   });
   $(document).on("keyup","#quantity",function(e){ 
       if($(this).val().length ==3){
        $("#eflight_price").focus();
       }
       if($(this).val().length >=3){   
         closePopover("#"+$(this).attr('id'));
       }  
   });  
   $(document).on("blur","#quantity",function(e){ 
       if($(this).val().length<3){   
         errorPopover("#"+$(this).attr('id'),"Min. 3 &  Max. 5 digit allowed");
       }  
   });
    $(document).on("keyup",".card_no",function(e){ 
       if($(this).val().length >=7){   
         closePopover("#"+$(this).attr('id'));
       }  
   });  
   $(document).on("blur",".card_no",function(e){ 
       if($(this).val().length<7){   
         errorPopover("#"+$(this).attr('id')," Min. 7 & Max. 15 Alphabets & Numbers allowed");
       }  
   });
    $(document).on("keyup",".hotel_name",function(e){ 
       if($(this).val().length >=6){   
         closePopover("#"+$(this).attr('id'));
       }  
   });  
   $(document).on("blur",".hotel_name",function(e){ 
       if($(this).val().length<6){   
         errorPopover("#"+$(this).attr('id'),"Min. 6 & Max. 25 Alphabets & Numbers allowed");
       }  
   });
    $(document).on("keyup",".cab_company",function(e){ 
       if($(this).val().length >=6){   
         closePopover("#"+$(this).attr('id'));
       }  
   });  
   $(document).on("blur",".cab_company",function(e){ 
       if($(this).val().length<6){   
         errorPopover("#"+$(this).attr('id'),"Min. 6 & Max. 25 Alphabets & Numbers allowed");
       }  
   });
    $(document).on("keyup",".guest",function(e){ 
       if($(this).val().length >=6){   
         closePopover("#"+$(this).attr('id'));
       }  
   });  
   $(document).on("blur",".guest",function(e){ 
       if($(this).val().length<6){   
         errorPopover("#"+$(this).attr('id'),"Min. 6 & Max. 25 Alphabets & Numbers allowed");
       }  
   });
   $(document).on("keyup",".remarks",function(e){ 
       if($(this).val().length >=3 || $(this).val()==""){   
         closePopover("#"+$(this).attr('id'));
       }  
   });  
   $(document).on("blur",".remarks",function(e){ 
       if($(this).val().length>=1 && $(this).val().length<3){   
         errorPopover("#"+$(this).attr('id'),"Min. 3 & Max. 150 Alphabets & Numbers allowed");
       }  
   });

   $(document).on("keyup","#handling_agency",function(e){ 
       if($(this).val().length >=2){   
         closePopover("#"+$(this).attr('id'));
       }  
   });  
   $(document).on("blur","#handling_agency",function(e){ 
       if($(this).val().length<2){   
         errorPopover("#"+$(this).attr('id'),"Min. 2 & Max. 25 Alphabets & Numbers allowed");
       }  
   });
   $.ajax({
        url: "{{action('Payment\BillingController@AutoSuggest') }}",
        dataType:"json",  
        success: function(result)
        {
            $(".airport" ).autocomplete({
                source: result,
                selectFirst: true,
                minLength: 3,
                select: function (event, ui) 
                {
                    closePopover("#"+$(this).attr('id'));
                    var airport_id=$(this).attr('id');
                    // if(airport_id=='airport2')
                    //   $('#airporthandling_date_of_flight_arrival').focus();
                    $.ajax({
                         url: "{{action('Payment\BillingController@FuelAgencyInfo') }}",
                         dataType:"json",
                         context:this,
                         data:{airport_code:ui.item.value},  
                         success: function(result)
                         {
                             if(airport_id=='airport1'){
                              $('#fuel_agency_info').removeClass('hide');
                              $("#fuel_agency_info_tri").removeClass('hide');
                              $('#fuel_agency_info').html('BASIC PRICE : '+result.basic_price+"<br>"+'TAX : '+result.tax+' %'+"<br>"+'HP PRICE : '+result.hp_price+"<br>");
                            }
                         }});
                }
            });
        }});
   $('body').on('keyup', '.bill_time,.handling_arrival_time,.handling_dep_time,.mmhandling_arrival_time,.hhhandling_arrival_time,.mmhandling_dept_time,.hhhandling_dept_time,.hhhotelbill_intime,.mmhotelbill_intime,.hhhotelbill_outtime,.mmhotelbill_outtime',function (){  
            var hhbill_time=$("#hhbill_time").val();
            var mmbill_time=$("#mmbill_time").val();
            var hhhandling_arrival_time=$("#hhhandling_arrival_time").val();
            var mmhandling_arrival_time=$("#mmhandling_arrival_time").val();
            var hhhandling_dept_time=$("#hhhandling_dept_time").val();
            var mmhandling_dept_time=$("#mmhandling_dept_time").val();
            if($(this).attr('id')=="hhbill_time"||$(this).attr('id')=="mmbill_time"){
               if(hhbill_time.length==2 && $(this).attr('id')=="hhbill_time"){
                closePopover("#hhbill_time");
                $("#mmbill_time").focus();
               }
               if(mmbill_time.length==2 && $(this).attr('id')=="mmbill_time")
                closePopover("#mmbill_time");
               if(hhbill_time.length==2 && mmbill_time.length==2)
                 {
                      if(parseInt(hhbill_time)<=24 && parseInt(mmbill_time)<=60)
                      {
                        var time=calculate_ist(hhbill_time,mmbill_time)
                        $("#bill_time_lbl").html(time);
                      }
                     else
                       $("#bill_time_lbl").html("");
                 }
             }
            if($(this).attr('id')=="hhhandling_arrival_time"|| $(this).attr('id')=="mmhandling_arrival_time"){
              if(hhhandling_arrival_time.length==2 && $(this).attr('id')=="hhhandling_arrival_time"){
                closePopover("#hhhandling_arrival_time");
                 $("#mmhandling_arrival_time").focus();
              }
              if(mmhandling_arrival_time.length==2 && $(this).attr('id')=="mmhandling_arrival_time")
                closePopover("#mmhandling_arrival_time");
              if(hhhandling_arrival_time.length==2 && mmhandling_arrival_time.length==2)
                {
                     if(parseInt(hhhandling_arrival_time)<=24 && parseInt(mmhandling_arrival_time)<=60)
                     {
                       var time=calculate_ist(hhhandling_arrival_time,mmhandling_arrival_time)
                       $("#handling_arrival_time_lbl").html(time);
                     }
                    else
                      $("#handling_arrival_time_lbl").html("");
                      CheckAirportTime($(this))
                }
            }
            if($(this).attr('id')=="mmhandling_arrival_time"){
               if(mmhandling_arrival_time.length==2){
                 
                  $("#hhhandling_dept_time").focus();
               }
            }
            if($(this).attr('id')=="hhhandling_dept_time"|| $(this).attr('id')=="mmhandling_dept_time"){
              if(hhhandling_dept_time.length==2 && $(this).attr('id')=="hhhandling_dept_time")
                $("#mmhandling_dept_time").focus();
              if(mmhandling_dept_time.length==2 && $(this).attr('id')=="mmhandling_dept_time")
                $("#remarks").focus();
              if(hhhandling_dept_time.length==2 && mmhandling_dept_time.length==2)
                {
                     if(parseInt(hhhandling_arrival_time)<=24 && parseInt(mmhandling_arrival_time)<=60)
                     {
                       var time=calculate_ist(hhhandling_arrival_time,mmhandling_arrival_time)
                       $("#handling_dept_time_lbl").html(time);
                     }
                    else
                      $("#handling_dept_time_lbl").html("");
                      CheckAirportTime($(this))
                }
            } 

            if($(this).attr('id').match(/hhhotelbill_intime.*/)){
               var id =$(this).attr('data-count');
               //console.log(id);
               if($(this).val().length==2){
                closePopover("#hhhotelbill_intime"+id);
                CheckHotelTime(id);
                $("#mmhotelbill_intime"+id).focus();
              }
            }  
            if($(this).attr('id').match(/mmhotelbill_intime.*/)){
               var id =$(this).attr('data-count');
               if($(this).val().length==2){
                closePopover("#mmhotelbill_intime"+id);
                CheckHotelTime(id);
                $("#hhhotelbill_outtime"+id).focus();
               }
            }  
            if($(this).attr('id').match(/hhhotelbill_outtime.*/)){
               var id =$(this).attr('data-count');
               if($(this).val().length==2){
                closePopover("#hhhotelbill_outtime"+id);
                CheckHotelTime(id);
                $("#mmhotelbill_outtime"+id).focus();
               }
            }  
            if($(this).attr('id').match(/mmhotelbill_outtime.*/)){
               var id =$(this).attr('data-count');
               if($(this).val().length==2){
                closePopover("#mmhotelbill_outtime"+id);
                CheckHotelTime(id);
                $("#hotelbill_remarks"+id).focus();
               }
            }    
            if($(this).attr('id').match(/mmhotelbill_intime.*/)||$(this).attr('id').match(/hhhotelbill_intime.*/)){
              var id =$(this).attr('data-count');
              var hhhotelbill_intime= $("#hhhotelbill_intime"+id).val();
              var mmhotelbill_intime= $("#mmhotelbill_intime"+id).val();
              if(hhhotelbill_intime.length==2 && mmhotelbill_intime.length==2)
                {
                     if(parseInt(hhhotelbill_intime)<=24 && parseInt(mmhotelbill_intime)<=60)
                     {
                       var time=calculate_ist(hhhotelbill_intime,mmhotelbill_intime)
                       $("#hotelbill_intime"+id+"_lbl").html(time);
                     }
                    else
                      $("#hotelbill_intime"+id+"_lbl").html("");
                }
            }   
            if($(this).attr('id').match(/mmhotelbill_outtime.*/) || $(this).attr('id').match(/hhhotelbill_outtime.*/) ){
              var id =$(this).attr('data-count');
              var hhhotelbill_outtime= $("#hhhotelbill_outtime"+id).val();
              var mmhotelbill_outtime= $("#mmhotelbill_outtime"+id).val();
              if(hhhotelbill_outtime.length==2 && mmhotelbill_outtime.length==2)
                {
                     if(parseInt(hhhotelbill_outtime)<=24 && parseInt(mmhotelbill_outtime)<=60)
                     {
                       var time=calculate_ist(hhhotelbill_outtime,mmhotelbill_outtime)
                       $("#hotelbill_outtime"+id+"_lbl").html(time);
                     }
                    else
                      $("#hotelbill_outtime"+id+"_lbl").html("");
                }
            }    
    });
    function calculate_ist(hhhandling_arrival_time,mmhandling_arrival_time)
    {
          hr=parseInt(hhhandling_arrival_time)+5;
          min=parseInt(mmhandling_arrival_time)+30;
          if(min>=60){
             hr=hr+1;
             min=min-60;
          }
          if(hr>=24)
            hr=hr-24;
          if(min.toString().length==1)
                min='0'+min;
          if(hr.toString().length==1)
                hr='0'+hr;
        time=hr+" : "+min+" IST";
        return time;
    }
    $('body').on('keyup', '.time',function (){  
      var time_id=$(this).attr('id');
      var time_length=$(this).val().length;
      var time_split= $(this).val().replace(/\s/g, "").split(':');
      if(time_length==2 && event.keyCode!=8){
        var time=$(this).val().substring(0,2)+' : ';
         $(this).val(time);  
      }
      if(time_length==7){
        if(time_id=='handling_arrival_time')
          $("#handling_dept_time").focus();
        else if(time_id=='handling_dept_time')
          $("#remarks").focus();
        else if (time_id.match(/hotelbill_intime.*/)) {
           var out_timeid='hotelbill_outtime'+time_id.substring(16);
           $("#"+out_timeid).focus();
         }
        else if (time_id.match(/hotelbill_outtime.*/)) {
            var remarks_id='hotelbill_remarks'+time_id.substring(17);
            $("#"+remarks_id).focus();
        }

           if(parseInt(time_split[0])<=24 && parseInt(time_split[1])<=60)
           {
               hr=parseInt(time_split[0])+5;
               min=parseInt(time_split[1])+30;
               if(min>=60){
                  hr=hr+1;
                  min=min-60;
               }
               if(hr>=24)
                 hr=hr-24;
               if(min.toString().length==1)
                     min='0'+min;
               if(hr.toString().length==1)
                     hr='0'+hr;
             time=hr+" : "+min+" IST";
             $("#"+$(this).attr('id')+"_lbl").html(time);
           }
          else
          {
            $("#"+$(this).attr('id')+"_lbl").html("");
          }
          closePopover("#"+$(this).attr('id'));
          if($(this).attr('id')=='handling_dept_time'||$(this).attr('id')=='handling_arrival_time'){ 
            CheckAirportTime($(this))
          }
          else if (time_id.match(/hotelbill_outtime.*/)||time_id.match(/hotelbill_intime.*/)){
            var count=$(this).attr('data-count'); 
            CheckHotelTime(count);
          }
       }
       else
         $("#"+$(this).attr('id')+"_lbl").html("");
    });      
    function CheckAirportTime(thi){
         if($("#airporthandling_date_of_flight_arrival").val()!='' && $("#airporthandling_date_of_flight_dept").val()!=''  && $("#hhhandling_arrival_time").val().length==2 && $("#mmhandling_arrival_time").val().length==2 && $("#hhhandling_dept_time").val().length==2 && $("#mmhandling_dept_time").val().length==2)
            {
                var arrival_flightdate=new Date($('#airporthandling_date_of_flight_arrival').val());
                var arrival_day  = arrival_flightdate.getDate();
                var arrival_month= arrival_flightdate.getMonth();              
                var arrival_year = arrival_flightdate.getFullYear();
                var arrival_hr =parseInt($("#hhhandling_arrival_time").val());
                var arrival_min=parseInt($("#mmhandling_arrival_time").val());
                var arrival_date = new Date(arrival_year,arrival_month,arrival_day,arrival_hr,arrival_min,00,000);
                var arrival_time=arrival_date.getTime();

                var dept_flightdate=new Date($('#airporthandling_date_of_flight_dept').val());
                var dept_day  = dept_flightdate.getDate();
                var dept_month= dept_flightdate.getMonth();              
                var dept_year = dept_flightdate.getFullYear();
                var dept_hr =parseInt($("#hhhandling_dept_time").val());
                var dept_min=parseInt($("#mmhandling_dept_time").val());
                var dept_date = new Date(dept_year,dept_month,dept_day,dept_hr,dept_min,00,000);
                /*console.log($('#airporthandling_date_of_flight_arrival').val());
                console.log($('#airporthandling_date_of_flight_dept').val());
                console.log('arrival Flight date'+arrival_flightdate);
                console.log('dept Flight date'+dept_flightdate);
                console.log('arrival date'+arrival_date);
                console.log('dept date'+dept_date);*/
                var dept_time=dept_date.getTime();
                // console.log('dept_time'+dept_time);
                // console.log('arrival_min'+arrival_min);

                if(parseInt(dept_time)<parseInt(arrival_time))
                {
                      //console.log('true');
                      errorPopover("#mmhandling_dept_time",'Dept Time should be more than Arrival Time');
                      errorPopover("#hhhandling_dept_time",'Dept Time should be more than Arrival Time');
                }
                else
                {
                     console.log('false');
                     closePopover('#mmhandling_dept_time');
                     closePopover('#hhhandling_dept_time');
                }
            }    
    }
    function CheckHotelTime(cnt){
      var id=cnt;
      var hhcheckin_time=$("#hhhotelbill_intime"+id).val();
      var mmcheckin_time=$("#mmhotelbill_intime"+id).val();
      var hhcheckout_time=$("#hhhotelbill_outtime"+id).val();
      var mmcheckout_time=$("#mmhotelbill_outtime"+id).val();
       if($("#checkin_flightdate"+id).val()!='' && $("#checkin_flightdate"+id).val()!=''  && $("#hhhotelbill_intime"+id).val().length==2 && $("#mmhotelbill_intime"+id).val().length==2 && $("#hhhotelbill_outtime"+id).val().length==2 && $("#mmhotelbill_outtime"+id).val().length==2)
       {
            // var checkin_flightdate=$("#checkin_flightdate"+id).datepicker('getDate');
            // var checkout_flightdate=$("#checkout_flightdate"+id).datepicker('getDate');
            var checkin_flightdate=new Date($("#checkin_flightdate"+id).val());
            var checkout_flightdate=new Date($("#checkout_flightdate"+id).val());
            var checkin_day  = checkin_flightdate.getDate();
            var checkin_month= checkin_flightdate.getMonth();              
            var checkin_year = checkin_flightdate.getFullYear();
            var checkout_day  = checkout_flightdate.getDate();
            var checkout_month= checkout_flightdate.getMonth();              
            var checkout_year = checkout_flightdate.getFullYear();
            var checkin_date = new Date(checkin_year,checkin_month,checkin_day,hhcheckin_time,mmcheckin_time,00,000);
            var checkout_date = new Date(checkout_year,checkout_month,checkout_day,hhcheckout_time,mmcheckout_time,00,000);
            var checkin_time=checkin_date.getTime();
            var checkout_time=checkout_date.getTime();
               if(parseInt(checkout_time)<parseInt(checkin_time))
               {
                     errorPopover("#hhhotelbill_outtime"+id,'OUT Time cannot be less than IN Time');
                     errorPopover("#mmhotelbill_outtime"+id,'OUT Time cannot be less than IN Time');
                     bool=false;
                     
               }
               else
               {
                    closePopover('#hhhotelbill_outtime'+id);
                    closePopover('#mmhotelbill_outtime'+id);
               }
       } 
    }
    $(document).on("keypress",".hhtime",function(e){ 
       var time=$(this).val();
       var id=$(this).attr('data-id');
       var mmdeparturetime=$("#mmbill_time").val();

       if ((time.length == 0||time.length == 2) && ((e.which >=51 &&  e.which <= 57))){
          return false;
       }
       if (time.length == 1 && $(this).val().charAt(0)==2 && ((e.which >=52 &&  e.which <= 57))){
          return false;
       }
       if (time.length == 1 && mmdeparturetime=='00' && e.which==48 && time=='0'){
          return false;
       }
    }); 
    $(document).on("keypress",".mmtime",function(e){ 
       var time=$(this).val();
       var hhdeparturetime=$("#hhbill_time").val();

       if ((time.length == 0||time.length == 2) && ((e.which >=54 &&  e.which <= 57))|| (time.length == 3 && parseInt(hhdeparturetime)>=24 && (e.which >=49 &&  e.which <= 57) )){
          return false;
       }
       if (time.length == 1 && ((e.which >=49 &&  e.which <= 52)||(e.which >=54 &&  e.which <= 57) || (time=='0' && hhdeparturetime =='00' && hhdeparturetime !="" && e.which ==48) )){
          return false;
       }
    }); 
    $(document).on("keypress",".hhhandling_arrival_time",function(e){ 
       var time=$(this).val();
       var id=$(this).attr('data-id');
       var mmarrivaltime=$("#mmhandling_arrival_time").val();

       if ((time.length == 0||time.length == 2) && ((e.which >=51 &&  e.which <= 57))){
          return false;
       }
       if (time.length == 1 && $(this).val().charAt(0)==2 && ((e.which >=52 &&  e.which <= 57))){
          return false;
       }
       if (time.length == 1 && mmarrivaltime=='00' && e.which==48 && time=='0'){
          return false;
       }
    }); 
    $(document).on("keypress",".mmhandling_arrival_time",function(e){ 
       var time=$(this).val();
       var hharrivaltime=$("#hhhandling_arrival_time").val();

       if ((time.length == 0||time.length == 2) && ((e.which >=54 &&  e.which <= 57))|| (time.length == 3 && parseInt(hharrivaltime)>=24 && (e.which >=49 &&  e.which <= 57) )){
          return false;
       }
       if (time.length == 1 && ((e.which >=49 &&  e.which <= 52)||(e.which >=54 &&  e.which <= 57) || (time=='0' && hharrivaltime =='00' && hharrivaltime !="" && e.which ==48) )){
          return false;
       }
    }); 
    $(document).on("keypress",".hhhandling_dept_time",function(e){ 
       var time=$(this).val();
       var id=$(this).attr('data-id');
       var mmhandling_dept_time=$("#mmhandling_dept_time").val();

       if ((time.length == 0||time.length == 2) && ((e.which >=51 &&  e.which <= 57))){
          return false;
       }
       if (time.length == 1 && $(this).val().charAt(0)==2 && ((e.which >=52 &&  e.which <= 57))){
          return false;
       }
       if (time.length == 1 && mmhandling_dept_time=='00' && e.which==48 && time=='0'){
          return false;
       }
    }); 
    $(document).on("keypress",".mmhandling_dept_time",function(e){ 
       var time=$(this).val();
       var hhhandling_dept_time=$("#hhhandling_dept_time").val();

       if ((time.length == 0||time.length == 2) && ((e.which >=54 &&  e.which <= 57))|| (time.length == 3 && parseInt(hhhandling_dept_time)>=24 && (e.which >=49 &&  e.which <= 57) )){
          return false;
       }
       if (time.length == 1 && ((e.which >=49 &&  e.which <= 52)||(e.which >=54 &&  e.which <= 57) || (time=='0' && hhhandling_dept_time =='00' && hhhandling_dept_time !="" && e.which ==48) )){
          return false;
       }
    }); 
    $(document).on("keypress",".hhhotelbill_intime",function(e){ 
       var time=$(this).val();
       var id=$(this).attr('data-count');
       var mmhotelbill_intime=$("#mmhotelbill_intime"+id).val();

       if ((time.length == 0||time.length == 2) && ((e.which >=51 &&  e.which <= 57))){
          return false;
       }
       if (time.length == 1 && $(this).val().charAt(0)==2 && ((e.which >=52 &&  e.which <= 57))){
          return false;
       }
       if (time.length == 1 && mmhotelbill_intime=='00' && e.which==48 && time=='0'){
          return false;
       }
    }); 
    $(document).on("keypress",".mmhotelbill_intime",function(e){ 
       var time=$(this).val();
       var id=$(this).attr('data-count');
       var hhhotelbill_intime=$("#hhhotelbill_intime"+id).val();

       if ((time.length == 0||time.length == 2) && ((e.which >=54 &&  e.which <= 57))|| (time.length == 3 && parseInt(hhhotelbill_intime)>=24 && (e.which >=49 &&  e.which <= 57) )){
          return false;
       }
       if (time.length == 1 && ((e.which >=49 &&  e.which <= 52)||(e.which >=54 &&  e.which <= 57) || (time=='0' && hhhotelbill_intime =='00' && hhhotelbill_intime !="" && e.which ==48) )){
          return false;
       }
    }); 
    $(document).on("keypress",".hhhotelbill_outtime",function(e){ 
       var time=$(this).val();
       var id=$(this).attr('data-count');
       var mmhotelbill_outtime=$("#mmhotelbill_outtime"+id).val();

       if ((time.length == 0||time.length == 2) && ((e.which >=51 &&  e.which <= 57))){
          return false;
       }
       if (time.length == 1 && $(this).val().charAt(0)==2 && ((e.which >=52 &&  e.which <= 57))){
          return false;
       }
       if (time.length == 1 && mmhotelbill_outtime=='00' && e.which==48 && time=='0'){
          return false;
       }
    }); 
    $(document).on("keypress",".mmhotelbill_outtime ",function(e){ 
       var time=$(this).val();
       var id=$(this).attr('data-count');
       var hhhotelbill_outtime=$("#hhhotelbill_outtime"+id).val();

       if ((time.length == 0||time.length == 2) && ((e.which >=54 &&  e.which <= 57))|| (time.length == 3 && parseInt(hhhotelbill_outtime)>=24 && (e.which >=49 &&  e.which <= 57) )){
          return false;
       }
       if (time.length == 1 && ((e.which >=49 &&  e.which <= 52)||(e.which >=54 &&  e.which <= 57) || (time=='0' && hhhotelbill_outtime =='00' && hhhotelbill_outtime !="" && e.which ==48) )){
          return false;
       }
    }); 
    $(document).on("focusin",".hhhotelbill_intime,.mmhotelbill_intime,.hhhotelbill_outtime,.mmhotelbill_outtime,.hhhandling_dept_time,.mmhandling_dept_time,.hhhandling_arrival_time,.mmhandling_arrival_time,.mmtime,.hhtime",function(e){ 
         if($(this).val().length==2){
           $(this).select();
         }
     });
$('body').on('click', '.billing_btn',function (event){

   function pay(section)
   {
     swal({
              title: $("#words").html(),
              text: "DO YOU WISH TO PROCEED TO PAY ?",
              type: "warning",
              showCancelButton: true,
              type: "success",
              confirmButtonText: 'YES',
              confirmButtonClass: 'btn-success waves-effect waves-light',
              cancelButtonText: "NO",
              closeOnConfirm: true,
              closeOnCancel: true
              },function (isConfirm) {
                 if (isConfirm) {
                   $("#billinfo").submit();
                 }
                 else
                 {
                   if(section=='fuel')
                     remaining_fuel();
                   else if(section=='handling')
                     remaining_handling();
                   else if(section=='hotel')
                     remaining_hotel();
                   else if(section=='cab')
                     remaining_cab();
                    else if(section=='misc')
                     remaining_misc();                   
                 }
              });

    }
     var button_text=$(this).val();
     var button_id=$(this).attr('id');
     var data_id=$(this).attr('data-id');
     var button_length =$('.billing_btn').map(function(){
             return this.id;
         }).get();
     var payment_btn_check=false;
     if(button_id=='fuelbill_btn'){
          var bool =true;
          var fuelbill_callsign=$("#aircraft_callsign1").val();
          var fuelbill_airport=$("#airport1").val();
          var fuelbill_operator=$("#operator1").val();
          var fuelbill_fuelagency=$("#fuelbill_fuelagency").text();
          var fuelbill_quantity=$("#quantity").val();
          var fuelbill_date_of_flight=$("#fuelbill_date_of_flight").val();
          var hhbill_time=$("#hhbill_time").val();
          var mmbill_time= $("#mmbill_time").val();
          
          var fuelbill_eflight_price=$("#eflight_price").val();
          if($(this).attr('data-edit')==1){
             $("#billing_header").html('EDIT FUEL BILL SECTION');
             $("#billing_msg").html(' FUEL BILL SECTION?');
             $('#edit_yes').attr('data-id','fuelbill_btn_edit');
             $("#edit_modal").modal('show');
             return false; 
          }
          if(fuelbill_callsign.length <5){
            errorPopover("#aircraft_callsign1","Min. 5 & Max. 7 Characters, Alphabets & Numbers allowed");
            bool=false;
          }  
          if(fuelbill_airport.length<4){   
            bool=false;
            errorPopover("#airport1","Please Select Airport");
          }
          if(fuelbill_fuelagency=='FUEL AGENCY'){   
             bool=false;
             errorPopover("#sample","Select Fuel Agency");
          }
          if(fuelbill_quantity.length<3 || fuelbill_quantity==0){   
             bool=false;
             errorPopover("#quantity","Min. 3 &  Max. 5 digit allowed");
          }
         
          if(fuelbill_date_of_flight==''){   
             bool=false;
             errorPopover("#fuelbill_date_of_flight","Select Date of Flight");
          }
          if(hhbill_time.length<2){  
            bool=false; 
            errorPopover("#hhbill_time","Please Enter Time");
          } 
          if(hhbill_time.length<2){  
            bool=false; 
            errorPopover("#mmbill_time","Please Enter Time");
          }  
          if(fuelbill_eflight_price.length<5||fuelbill_eflight_price==0){   
            errorPopover("#eflight_price","Min. 2 & Max. 6 digit allowed");
            bool=false;
          }  
          if(bool==false){
            $("#success_lbl").parent().removeClass('hide');
            hidemsg('success_lbl');
            return false;
            
          }
           if(button_text=='SUBMIT')
             pay('fuel');
           else
             remaining_fuel();

           function remaining_fuel()
            {
            $("#success_lbl").parent().addClass('hide');
            $('.overlay').css('height',0);
            $('.overlay').css('height', $(document).height());
            $(".overlay").show();
           setTimeout(function(){ 
                $("#aircraft_callsign1,#airport1,#quantity,#hhbill_time,#mmbill_time,#eflight_price,#aircraft_callsign2,#airport2").prop('readonly', true);
                $("#fuelbill_date_of_flight" ).datepicker( "option", "disabled", true );
                $("#fuelbill_date_of_flight").removeClass('white_bg');
                $("#aircraft_callsign2").val(fuelbill_callsign);
            
                $("#hhhandling_dept_time").val(hhbill_time).prop('readonly',true);
                $("#mmhandling_dept_time").val(mmbill_time).prop('readonly',true);
                $("#handling_dept_time_lbl").html($("#bill_time_lbl").html());
                $("#sample_div").hide();
                $("#f_agency").val($("#fuelbill_fuelagency").text());
                $("#f_agency_div").removeClass('hide');
                if($("#fuelbill_btn").val()=='NEXT' || $("#fuelbill_btn").val()=='SUBMIT')
                  $("#fuelbill_btn").val('EDIT');
                $("#fuelbill_btn").attr('data-edit',1);
                $("#airporthandling_date_of_flight_dept").val(fuelbill_date_of_flight);
                $("#airport2").val(fuelbill_airport);
                $("#operator2").val(fuelbill_operator);
                $(".overlay").hide();      
                var data_edit=$("#fuelbill_btn").attr('data-edit');
                if(data_edit==1){
                   var section=parseInt($("#fuelbill_btn").attr('data-section'));
                   var next_section=section+1;
                   if($('.section'+next_section).length>0)
                   {
                      $('.section'+next_section).removeClass('hide');
                      $("#collapse_reg"+section).hide(200);
                      $('#collapse_reg'+next_section).css('display','block');     
                   }
                 }
                  $.each(button_length,function(key,buttonid){
                      var dataedit=$("#"+buttonid).attr('data-edit');
                      if(dataedit==2 || dataedit==0){
                        payment_btn_check=true;
                        return false;
                      }  
                 });
                  $('[data-value="SUBMIT"]').prop('disabled',false);
                  //$("#procees_btn").prop('disabled',payment_btn_check);
              },1000);
          }
     }
     else if(button_id=='airporthandling_btn'){
          var bool =true;
          var handling_callsign=$("#aircraft_callsign2").val();
          var handling_airport=$("#airport2").val();
          var handling_agency=$("#handling_agency").val();
          var handling_date_of_flight_arrival=$("#airporthandling_date_of_flight_arrival").val();
          var handling_date_of_flight_dept=$("#airporthandling_date_of_flight_dept").val();
          var hhairport_handling_dept_time=$("#hhhandling_dept_time").val();
          var mmairport_handling_dept_time=$("#mmhandling_dept_time").val();
          var hhairport_handling_arrival_time=$("#hhhandling_arrival_time").val();  
          var mmairport_handling_arrival_time=$("#mmhandling_arrival_time").val(); 
          var handling_actual_bill1=$("#actual_bill1").val();
          var handling_remarks=$("#remarks").val();
          if($(this).attr('data-edit')==1){
             $("#billing_header").html('EDIT AIRPORT HANDLING SECTION');
             $("#billing_msg").html(' AIRPORT HANDLING SECTION?');
             $('#edit_yes').attr('data-id','airporthandling_btn_edit'); 
             $("#edit_modal").modal('show');
             return false;
          }
          if(handling_callsign.length <5){
            errorPopover("#aircraft_callsign2","Min. 5 & Max. 7 Characters, Alphabets & Numbers allowed");
            bool=false;
          }  
          if(handling_airport.length<4){   
            bool=false;
            errorPopover("#airport2","Min. 3 character allowed");
          }
          if(handling_agency.length<2){   
            bool=false;
            errorPopover("#handling_agency","Min. 3 character allowed");
          }
          if(handling_date_of_flight_arrival==''){   
             bool=false;
             errorPopover("#airporthandling_date_of_flight_arrival","Select Arrival Date of Flight");
          }
          if(handling_date_of_flight_dept==''){   
             bool=false;
             errorPopover("#airporthandling_date_of_flight_dept","Select Dept Date of Flight");
          }
          if(hhairport_handling_arrival_time.length<2){  
            bool=false; 
            errorPopover("#hhhandling_arrival_time","Please Enter Time");
          } 
          if(mmairport_handling_arrival_time.length<2){  
            bool=false; 
            errorPopover("#mmhandling_arrival_time","Please Enter Time");
          } 
          if(hhairport_handling_dept_time==""){  
            bool=false; 
            errorPopover("#hhhandling_dept_time","Please Enter Time");
          }  
           if(mmairport_handling_dept_time==""){  
            bool=false; 
            errorPopover("#mmhandling_dept_time","Please Enter Time");
          }  
          else if($("#airporthandling_date_of_flight_arrival").val()!='' && $("#airporthandling_date_of_flight_dept").val()!=''  && 
            $("#hhhandling_arrival_time").val().length==2 && $("#mmhandling_arrival_time").val().length==2 && $("#hhhandling_dept_time").val().length==2 && $("#mmhandling_dept_time").val().length==2)
             {
                 var arrival_flightdate=new Date($('#airporthandling_date_of_flight_arrival').val());
                 var arrival_day  = arrival_flightdate.getDate();
                 var arrival_month= arrival_flightdate.getMonth();              
                 var arrival_year = arrival_flightdate.getFullYear();
                 var arrival_hr =parseInt($("#hhhandling_arrival_time").val());
                 var arrival_min=parseInt($("#mmhandling_arrival_time").val());
                 var arrival_date = new Date(arrival_year,arrival_month,arrival_day,arrival_hr,arrival_min,00,000);
                 var arrival_time=arrival_date.getTime();

                 var dept_flightdate=new Date($('#airporthandling_date_of_flight_dept').val());
                 var dept_day  = dept_flightdate.getDate();
                 var dept_month= dept_flightdate.getMonth();              
                 var dept_year = dept_flightdate.getFullYear();
                 var dept_hr =parseInt($("#hhhandling_dept_time").val());
                 var dept_min=parseInt($("#mmhandling_dept_time").val());
                 var dept_date = new Date(dept_year,dept_month,dept_day,dept_hr,dept_min,00,000);
                 var dept_time=dept_date.getTime();
                 if(parseInt(dept_time)<parseInt(arrival_time))
                 {
                       errorPopover("#mmhandling_dept_time",'Dept Time should be more than Arrival Time');
                       errorPopover("#hhhandling_dept_time",'Dept Time should be more than Arrival Time');
                       bool=false;
                       
                 }
                 else
                 {
                      closePopover('#mmhandling_dept_time');
                      closePopover('#hhhandling_dept_time');
                 }
             }
          if(handling_actual_bill1.length<5){   
            bool=false;
            errorPopover("#actual_bill1","Min. 2 & Max. 6 digit allowed");
          }  
          if(handling_remarks.length>=1 && handling_remarks.length<2){ 
            bool=false;  
            errorPopover("#remarks","Min. 3 & Max. 150 Alphabets & Numbers allowed");
          }  
          if(bool==false){
            $("#success_lbl").parent().removeClass('hide');
            hidemsg('success_lbl');
            return false;
          }
          if(button_text=='SUBMIT')
             pay('handling');
           else
             remaining_handling();
          function remaining_handling()
          {
            $("#success_lbl").parent().addClass('hide');
            $('.overlay').css('height',0);
            $('.overlay').css('height', $(document).height());
            $(".overlay").show();
            setTimeout(function(){ 
                  $("#aircraft_callsign2,#airport2,#handling_agency,#hhhandling_arrival_time,#mmhandling_arrival_time,#hhhandling_dept_time,#mmhandling_dept_time,#actual_bill1,#remarks").prop('readonly', true);
                  $("#airporthandling_btn").attr('data-edit',1);
                  if($("#airporthandling_btn").val()=='NEXT'|| $("#airporthandling_btn").val()=='SUBMIT')
                    $("#airporthandling_btn").val('EDIT');
                  $("#airporthandling_date_of_flight_arrival,#airporthandling_date_of_flight_dept" ).datepicker( "option", "disabled", true );
                  $("#airporthandling_date_of_flight_arrival,#airporthandling_date_of_flight_dept").removeClass('white_bg');
                  $(".overlay").hide();      
                  var data_edit=$("#airporthandling_btn").attr('data-edit');
                  if(data_edit==1){
                  var section=parseInt($("#airporthandling_btn").attr('data-section'));
                  var next_section=section+1;
                  if($('.section'+next_section).length>0)
                    {
                      $('.section'+next_section).removeClass('hide');
                      $("#collapse_reg"+section).hide(200);
                      $('#collapse_reg'+next_section).css('display','block');     
                    }
                  }
                   $.each(button_length,function(key,buttonid){
                       var dataedit=$("#"+buttonid).attr('data-edit');
                       if(dataedit==2 || dataedit==0){
                         payment_btn_check=true;
                         return false;
                       }  
                  });
                   // $("#procees_btn").prop('disabled',payment_btn_check);
                   $('[data-value="SUBMIT"]').prop('disabled',false);
               },1000);  
            }      
     }
     else if(button_id=='hotel_btn'){
        var bool =true;
        var hotel_name_length =$('.hotel_name').map(function(){
              return this.id;
          }).get();
        var guest_name_length=$('.hotelbill_guest').map(function(){
              return this.id;
          }).get();
        var checkin_flightdate_length=$('.checkin_flightdate').map(function(){
              return this.id;
          }).get();
        var checkout_flightdate_length=$('.checkout_flightdate').map(function(){
              return this.id;
          }).get();
        var hotelbill_remarks_length=$('.hotelbill_remarks').map(function(){
              return this.id;
          }).get();
        var hotelbill_actualbill_length=$('.hotelbill_actualbill').map(function(){
              return this.id;
          }).get();
        var hhhotelbill_intime_length=$('.hhhotelbill_intime').map(function(){
              return this.id;
          }).get();
        var mmhotelbill_intime_length=$('.mmhotelbill_intime').map(function(){
              return this.id;
          }).get();
        var hhhotelbill_outtime_length=$('.hhhotelbill_outtime').map(function(){
              return this.id;
          }).get();
        var mmhotelbill_outtime_length=$('.mmhotelbill_outtime').map(function(){
              return this.id;
          }).get();
         if($(this).attr('data-edit')==1){
            $("#billing_header").html('EDIT HOTEL BILL SECTION');
            $("#billing_msg").html(' HOTEL BILL SECTION?');
            $('#edit_yes').attr('data-id','hotel_btn_edit'); 
            $("#edit_modal").modal('show');
            return false;
         }
         $.each(hotel_name_length,function(key,hotelnameid){
               var hotel_name=$("#"+hotelnameid).val();
               if(hotel_name.length<6){
                 errorPopover("#"+hotelnameid,"Min. 6 & Max. 25 Alphabets & Numbers allowed");
                 bool =false;
               }
         });
         $.each(guest_name_length,function(key,guestid){
               var guest_name=$("#"+guestid).val();
               if(guest_name.length<6){
                 errorPopover("#"+guestid,"Min. 6 & Max. 25 Alphabets & Numbers allowed");
                 bool =false;
               }
         });
         $.each(checkin_flightdate_length,function(key,checkinid){
               var checkin=$("#"+checkinid).val();
               if(checkin==""){
                 errorPopover("#"+checkinid,"Enter Check In Date");
               }  
         });
         $.each(hhhotelbill_intime_length,function(key,hhcheckintimeid){
               var hhcheckintime=$("#"+hhcheckintimeid).val();
               if(hhcheckintime.length<2){
                 errorPopover("#"+hhcheckintimeid,"Enter Time");
                 bool =false;
               }
         });
         $.each(mmhotelbill_intime_length,function(key,mmcheckintimeid){
               var mmcheckintime=$("#"+mmcheckintimeid).val();
               if(mmcheckintime.length<2){
                 errorPopover("#"+mmcheckintimeid,"Enter Time");
                 bool =false;
               }
         });
         $.each(hhhotelbill_outtime_length,function(key,hhcheckoutimeid){
               var hhcheckoutime=$("#"+hhcheckoutimeid).val();
               if(hhcheckoutime.length<2){
                 errorPopover("#"+hhcheckoutimeid,"Enter Time");
                 bool =false;
               }
         });
         $.each(mmhotelbill_outtime_length,function(key,mmcheckoutimeid){
               var mmcheckouttime=$("#"+mmcheckoutimeid).val();
               if(mmcheckouttime.length<2){
                 errorPopover("#"+mmcheckoutimeid,"Enter Time");
                 bool =false;
               }
         });
         // $.each(hotelbill_intime_length,function(key,checkintimeid){
         //       var count=checkintimeid.substr(16);
         //       var checkintime=$("#"+checkintimeid).val();
         //       var checkin_split= $("#"+checkintimeid).val().replace(/\s/g, "").split(':');
         //       var checkin_time=$("#"+checkintimeid).val().replace(/\s/g, "");
         //       if(checkintime==""){
         //         errorPopover("#"+checkintimeid,"Enter Time");
         //         bool =false;
         //       }
         //       else if((checkin_time!="" && checkin_time.length<5)||(checkin_time.length==5 && checkin_split[0]>24) ||(checkin_time.length==5 && (checkin_split[1]>60||checkin_time.charAt(2) !=":"||checkin_time.match(/:/gi).length>1 )))
         //       {
         //          bool=false;
         //          errorPopover('#'+checkinid,"Invalid Time");
         //       }
         // });
         $.each(checkout_flightdate_length,function(key,checkoutid){
               var checkout=$("#"+checkoutid).val();
               if(checkout==""){
                 errorPopover("#"+checkoutid,"Enter Check Out Date");
                 bool =false;
               }
         });
          $.each(mmhotelbill_outtime_length,function(key,checkouttimeid){
               var id=checkouttimeid.substr(19);
               
               var hhcheckin_time=$("#hhhotelbill_intime"+id).val();
               var mmcheckin_time=$("#mmhotelbill_intime"+id).val();
               var hhcheckout_time=$("#hhhotelbill_outtime"+id).val();
               var mmcheckout_time=$("#mmhotelbill_outtime"+id).val();
                if($("#checkin_flightdate"+id).val()!='' && $("#checkin_flightdate"+id).val()!=''  && hhcheckin_time.length==2 && mmcheckin_time.length==2 && hhcheckout_time.length==2 && mmcheckout_time.length==2)
                {
                     var checkin_flightdate=new Date($("#checkin_flightdate"+id).val());
                     var checkout_flightdate=new Date($("#checkout_flightdate"+id).val());
                     //console.log('id ='+id);
                     //console.log('checkin_flightdate'+checkin_flightdate);
                     //console.log('checkout_flightdate'+checkout_flightdate);
                     var checkin_day  = checkin_flightdate.getDate();
                     var checkin_month= checkin_flightdate.getMonth();              
                     var checkin_year = checkin_flightdate.getFullYear();
                     var checkout_day  = checkout_flightdate.getDate();
                     var checkout_month= checkout_flightdate.getMonth();              
                     var checkout_year = checkout_flightdate.getFullYear();
                     var checkin_date = new Date(checkin_year,checkin_month,checkin_day,hhcheckin_time,mmcheckin_time,00,000);
                     var checkout_date = new Date(checkout_year,checkout_month,checkout_day,hhcheckout_time,mmcheckout_time,00,000);
                     var checkin_time=checkin_date.getTime();
                     var checkout_time=checkout_date.getTime();
                        if(parseInt(checkout_time)<parseInt(checkin_time))
                        {
                              errorPopover("#hhhotelbill_outtime"+id,'OUT Time cannot be less than IN Time');
                              errorPopover("#mmhotelbill_outtime"+id,'OUT Time cannot be less than IN Time');
                              bool=false;
                              
                        }
                        else
                        {
                             closePopover('#hhhotelbill_outtime'+id);
                             closePopover('#mmhotelbill_outtime'+id);
                        }
                } 
         });

         $.each(hotelbill_remarks_length,function(key,remarksid){
               var remarks=$("#"+remarksid).val();
               if(remarks.length>=1 && remarks.length<3){
                 errorPopover("#"+remarksid,"Min. 3 & Max. 150 Alphabets & Numbers allowed");
                 bool =false;
               }
         });
         $.each(hotelbill_actualbill_length,function(key,actualbillid){
               var actualbill=$("#"+actualbillid).val();
               if(actualbill.length<5){
                 errorPopover("#"+actualbillid,"Min. 2 & Max. 6 digit allowed");
                 bool =false;
               }
         });
        if(bool==false){
            $("#success_lbl").parent().removeClass('hide');
            hidemsg('success_lbl');
            return false;
         }
          if(button_text=='SUBMIT')
             pay('hotel');
           else
             remaining_hotel();
           function remaining_hotel()
           {
             $("#success_lbl").parent().addClass('hide');
             $('.overlay').css('height',0);
             $('.overlay').css('height', $(document).height());
             $(".overlay").show();
            setTimeout(function(){ 
                  $(".hotel_name,.hotelbill_remarks,.hotelbill_actualbill,.hotelbill_guest,.hhhotelbill_intime,.hhhotelbill_outtime,.mmhotelbill_intime,.mmhotelbill_outtime").prop('readonly', true);
                  $(".checkout_flightdate").prop('disabled', true);
                  $("#hotel_btn").attr('data-edit',1);
                  $("#hotel_icon").css('display','none');
                  if($("#hotel_btn").val()=='NEXT'|| $("#hotel_btn").val()=='SUBMIT')
                    $("#hotel_btn").val('EDIT');
                  $(".checkin_flightdate,.checkout_flightdate").datepicker( "option","disabled",true);
                  $(".checkin_flightdate,.checkout_flightdate").removeClass('white_bg');
                  $(".overlay").hide();      
                  $('.handlinginfo_image').addClass('hide');
                  var data_edit=$("#hotel_btn").attr('data-edit');
                  if(data_edit==1){
                    var section=parseInt($("#hotel_btn").attr('data-section'));
                    var next_section=section+1;
                    if($('.section'+next_section).length>0)
                    {
                      $('.section'+next_section).removeClass('hide');
                      $("#collapse_reg"+section).hide(200);
                      $('#collapse_reg'+next_section).css('display','block');     
                    } 
                  }
                   $.each(button_length,function(key,buttonid){
                       var dataedit=$("#"+buttonid).attr('data-edit');
                       if(dataedit==2 || dataedit==0){
                         payment_btn_check=true;
                         return false;
                       }  
                  });
                   //$("#procees_btn").prop('disabled',payment_btn_check);
                   $('[data-value="SUBMIT"]').prop('disabled',false);
               },1000);  
             }
     }
     else if(button_id=='cab_btn')
     {
       var bool =true;
       var cab_company_length=parseInt($(".cab_company").length);
       var cab_actualbill_length=parseInt($(".crew_actualbill").length);
       var crew_remarks_length=parseInt($(".crew_remarks").length);
       var i;
       if($(this).attr('data-edit')==1){
          $("#billing_header").html('EDIT CREW BILL SECTION');
          $("#billing_msg").html(' CREW BILL SECTION?');
          $('#edit_yes').attr('data-id','cab_btn_edit'); 
          $("#edit_modal").modal('show');
          return false;
       }
       for(i=1;i<=cab_company_length;i++)
       {
           var cab_company=$("#cab_company"+i).val();
           if(cab_company.length<6){
             errorPopover("#cab_company"+i,"Min. 6 & Max. 25 Alphabets & Numbers allowed");
             bool =false;
           }
       }
       for(i=1;i<=cab_actualbill_length;i++)
       {
           var cab_actualbill=$("#cab_actualbill"+i).val();
           if(cab_actualbill.length<5){
             errorPopover("#cab_actualbill"+i,"Min. 2 & Max. 6 digit allowed");
             bool =false;
           }
       }
       for(i=1;i<=crew_remarks_length;i++)
       {
           var crew_remarks=$("#crewtransport_remarks"+i).val();
           if(crew_remarks.length>=1 && crew_remarks.length<3){
             errorPopover("#crewtransport_remarks"+i,"Min. 3 & Max. 150 Alphabets & Numbers allowed");
             bool =false;
           }
       } 
       if(bool==false){
           $("#success_lbl").parent().removeClass('hide');
           hidemsg('success_lbl');
           return false;
         }   
         if(button_text=='SUBMIT')
            pay('cab');
          else
            remaining_cab();
          function remaining_cab(){
          $("#success_lbl").parent().addClass('hide'); 
          $('.overlay').css('height',0);
          $('.overlay').css('height', $(document).height());
          $(".overlay").show();
          setTimeout(function(){ 
            $(".cab_company,.crew_actualbill,.crew_remarks,#cab_btn").prop('readonly', true);
            if($("#cab_btn").val()=='NEXT'|| $("#cab_btn").val()=='SUBMIT')
              $("#cab_btn").val('EDIT');
            $(".crew_flightdate").datepicker( "option", "disabled", true );
            $(".crew_flightdate").removeClass('white_bg');
            $("#crew_icon").css('display','none');
            $("#cab_btn").attr('data-edit',1);
            $(".overlay").hide();      
            var data_edit=$("#cab_btn").attr('data-edit');
            if(data_edit==1){
               var section=parseInt($("#cab_btn").attr('data-section'));
               var next_section=section+1;
               if($('.section'+next_section).length>0)
               {
                  $('.section'+next_section).removeClass('hide');
                  $("#collapse_reg"+section).hide(200);
                  $('#collapse_reg'+next_section).css('display','block');     
               }
             }
             $.each(button_length,function(key,buttonid){
                 var dataedit=$("#"+buttonid).attr('data-edit');
                 if(dataedit==2 || dataedit==0){
                   payment_btn_check=true;
                   return false;
                 }  
            });
             $('[data-value="SUBMIT"]').prop('disabled',false);
             //$("#procees_btn").prop('disabled',payment_btn_check);
          },1000); 
        }
     }
     else if(button_id=='misc_btn'){
         var bool =true;
         var misc_service_desc_length=parseInt($(".service_desc").length);
         var misc_checkout_length=parseInt($(".misc_checkout").length);
         var misc_actual_bill_length=parseInt($(".misc_actual_bill").length);
         var misc_remarks_length=parseInt($(".misc_remarks").length);
         var i;
         if($(this).attr('data-edit')==1){
            $("#billing_header").html('EDIT MISC BILL SECTION');
            $("#billing_msg").html(' MISC BILL SECTION?');
            $('#edit_yes').attr('data-id','misc_btn_edit'); 
            $("#edit_modal").modal('show');
            return false;
         }
         for(i=1;i<=misc_service_desc_length;i++)
         {
             var misc_service_desc=$("#service_desc"+i).val();
             if(misc_service_desc.length<3){
               errorPopover("#service_desc"+i,"Min. 3 & Max. 150 Alphabets & Numbers allowed");
               bool =false;
             }
         }
         for(i=1;i<=misc_checkout_length;i++)
         {
             var misc_date_of_flight=$("#misc_date_of_flight"+i).val();
             if(misc_date_of_flight==""){
               errorPopover("#misc_date_of_flight"+i,"Enter Date");
               bool =false;
             }
         }
         for(i=1;i<=misc_actual_bill_length;i++)
         {
             var misc_actual_bill=$("#misc_actual_bill"+i).val();
             if(misc_actual_bill.length<5){
               errorPopover("#misc_actual_bill"+i,"Min. 2 & Max. 6 digit allowed");
               bool =false;
             }
         }
         for(i=1;i<=misc_remarks_length;i++)
         {
             var miscbill_remarks=$("#miscbill_remarks"+i).val();
             if(miscbill_remarks.length>=1 && miscbill_remarks.length<3){
               errorPopover("#miscbill_remarks"+i,"Min. 3 & Max. 150 Alphabets & Numbers allowed");
               bool =false;
             }
         } 
         if(bool==false){
            $("#success_lbl").parent().removeClass('hide');
            hidemsg('success_lbl');
            return false;
         }
         if(button_text=='SUBMIT')
            pay('misc');
          else
            remaining_misc();
          function remaining_misc()
          {
          $("#success_lbl").parent().addClass('hide'); 
          $('.overlay').css('height',0);
          $('.overlay').css('height', $(document).height());
          $(".overlay").show();
          setTimeout(function(){ 
             $(".service_desc,.misc_actual_bill,.misc_remarks").prop('readonly', true);
             $(".misc_checkout").datepicker( "option", "disabled", true );
             $(".misc_checkout").removeClass('white_bg');
             $("#misc_btn").attr('data-edit',1);
             if($("#misc_btn").val()=='NEXT'|| $("#misc_btn").val()=='SUBMIT')
               $("#misc_btn").val('EDIT');
             $(".overlay").hide();      
             var data_edit=$("#misc_btn").attr('data-edit');
             if(data_edit==1){
                var section=parseInt($("#misc_btn").attr('data-section'));
                var next_section=section+1;
                if($('.section'+next_section).length>0)
                {
                   $('.section'+next_section).removeClass('hide');
                   $("#collapse_reg"+section).hide(200);
                   $('#collapse_reg'+next_section).css('display','block');     
                }
              }
               $.each(button_length,function(key,buttonid){
                   var dataedit=$("#"+buttonid).attr('data-edit');
                   if(dataedit==2 || dataedit==0){
                     payment_btn_check=true;
                     return false;
                   }  
              });
               //$("#procees_btn").prop('disabled',payment_btn_check);
               $('[data-value="SUBMIT"]').prop('disabled',false);
           },1000); 
         }
     }   
  });
$(document).on("blur",".time",function(e){ 
       var id=$(this).attr('id');
       var dept_time_split   = $(this).val().replace(/\s/g, "").split(':');
       var dept_time=$(this).val().replace(/\s/g, "");
       if($(this).val()==""){  
           errorPopover("#"+$(this).attr('id'),"Please Enter Time");
       }  
       else if((dept_time!="" && dept_time.length<5)||(dept_time.length==5 && dept_time_split[0]>24) ||(dept_time.length==5 && dept_time_split[1]>60||dept_time.charAt(2) !=":"||dept_time.match(/:/gi).length>1 ))
       {
          errorPopover('#'+$(this).attr('id'),"Invalid Time");
       }
  });  
$('body').on('click', '.fuelbillheading_wrapper', function(e){
            var id = $(this).next().attr('id');
            $(this).next().toggle(200);
            for(k = 1; k <= 6; k++){
            var accordid = 'collapse_reg' + k;
            if (id == accordid)
                    continue;
            $("#collapse_reg" + k).hide(200);
            }
    });
$(document).on("keyup",".fuelbill_calculation,#actual_bill1,.hotelbill_actualbill,.crew_actualbill,.misc_actual_bill,#quantity",function(e){
    calculation(); 
});
function calculation()
{
  var qty=parseInt($('#quantity').val());
  var eflight_price=parseFloat($('#eflight_price').val());
  var actual_bill1=parseFloat($('#actual_bill1').val());
  var crew_actualbill_length=parseInt($(".crew_actualbill").length);
  var misc_actualbill_length=parseInt($(".misc_actual_bill").length);
  var hotelbill_actualbill_length = $('.hotelbill_actualbill').map(function(){
      return this.id;
  }).get();
  var zero=0;
  var sum=0.00;
  var total_amt=0.00;
  var i,j,k;
  if(qty!="" && eflight_price!="")
     {
            var fuel_amt=eflight_price*qty;
            if(isNaN(fuel_amt)){
             $("#fuel_amount").html(zero.toFixed(2)); 
            }
            else 
            {  
             total_amt=total_amt+fuel_amt;
             $("#fuel_amount").html(total_amt.toFixed(2));
            }
     }
   if(actual_bill1!="")
    {
        if(isNaN(actual_bill1))
          actual_bill1=0.00;
        total_amt=total_amt+actual_bill1;
        $("#handling_amount").html(actual_bill1.toFixed(2));      
    }
    $.each(hotelbill_actualbill_length,function(key,hotelid){
       var hotelbill_actualbill=parseFloat($("#"+hotelid).val());
       if(isNaN(hotelbill_actualbill))
             hotelbill_actualbill=0.00;
        sum=sum+hotelbill_actualbill;
       $("#hotel_amount").html(sum.toFixed(2));
    });
    total_amt=total_amt+sum;
    for(j=1;j<=crew_actualbill_length;j++)
    {
        var crew_actualbill=parseFloat($("#cab_actualbill"+j).val());
        if(isNaN(crew_actualbill))
              crew_actualbill=0.00;
        total_amt=total_amt+crew_actualbill;
       $("#crew_amount").html(crew_actualbill.toFixed(2));
    }
    for(k=1;k<=misc_actualbill_length;k++)
    {
        var misc_actualbill=parseFloat($("#misc_actual_bill"+k).val());
        if(isNaN(misc_actualbill))
              misc_actualbill=0.00;
        total_amt=total_amt+misc_actualbill;
        $("#misc_amount").html(misc_actualbill.toFixed(2));
    }
    $("#total_amount").html(total_amt.toFixed(2)); 
    $("input[name='amount'").val(total_amt.toFixed(2));
    $.ajax({
             url: "{{action('Payment\BillingController@AmountInWords') }}",
             dataType:"json",
             context:this,
             data:{number:total_amt},  
             success: function(result)
             {
                $("#words").html(result.words);
             }
          });
}
$('body').on('click','.minus',function(){
   var btn=$("#hotel_btn_div").clone(); 
    $(this).parent().parent().parent().parent().parent().remove();
   if($("#hotel_btn").length==0){
   btn.appendTo('#hotel_bill .secondrow:last');
   }
   calculation();
})
$("#edit_yes").click(function(){
   var id=$(this).attr('data-id');
   if(id=="fuelbill_btn_edit"){
         
        $("#aircraft_callsign1,#airport1,#quantity,#hhbill_time,#mmbill_time,#eflight_price").prop('readonly', false);
        $("#fuelbill_date_of_flight" ).datepicker( "option", "disabled", false );

        $("#fuelbill_date_of_flight").addClass('white_bg');
        $("#sample_div").show();
        $("#fuelbill_btn").val($("#fuelbill_btn").attr('data-value'));
        $("#f_agency_div").addClass('hide');
        $("#fuelbill_btn").attr('data-edit',0);
        var val=$("#fuelbill_btn").attr('data-value');
        if(val!='SUBMIT')
          $('[data-value="SUBMIT"]').prop('disabled',true);
  
   }
   else if(id=="airporthandling_btn_edit"){
        $("#handling_agency,#handling_time,#actual_bill1,#remarks,#hhhandling_arrival_time,#mmhandling_arrival_time").prop('readonly', false);
        if($("#fuel_bill").length==0)
        {
           $("#aircraft_callsign2,#airport2,#mmhandling_arrival_time,#hhhandling_dept_time,#mmhandling_dept_time").prop('readonly', false);
        }
        $("#airporthandling_date_of_flight_arrival" ).datepicker( "option", "disabled", false );
        $("#airporthandling_date_of_flight_dept").prop('disabled', false);
        $(".ui-datepicker-trigger").click(function(){
                 $(".notify-bg-v").fadeIn();
                 $('.notify-bg-v').css('height',0);
                 $('.notify-bg-v').css('height', $(document).height());
        });
       // $("#airporthandling_btn_edit").val($("#airporthandling_btn_edit").attr('data-value'));
        $("#airporthandling_date_of_flight_arrival,#airporthandling_date_of_flight_dept").addClass('white_bg');
        $("#airporthandling_btn").attr('data-edit',0);
        $("#airporthandling_btn").val($("#airporthandling_btn").attr('data-value'));
        var val=$("#airporthandling_btn").attr('data-value');
        if(val!='SUBMIT')
          $('[data-value="SUBMIT"]').prop('disabled',true);
   }
  else if(id=="cab_btn_edit"){
        $("#cab_btn").val($("#cab_btn").attr('data-value'));
        $(".cab_company,.card_no,.crew_actualbill,.crew_guest,.crew_remarks,#cab_btn").prop('readonly', false);
        $(".crew_flightdate").datepicker( "option", "disabled", false );
        $(".crew_flightdate").addClass('white_bg');
        $("#cab_btn").attr('data-edit',0);
        var val=$("#cab_btn").attr('data-value');
        if(val!='SUBMIT')
          $('[data-value="SUBMIT"]').prop('disabled',true);

   }
   else if(id=="hotel_btn_edit"){
        $(".hotel_name,.hotelbill_remarks,.hotelbill_actualbill,.hotelbill_guest,.hhhotelbill_intime,.hhhotelbill_outtime,.mmhotelbill_intime,.mmhotelbill_outtime").prop('readonly', false);
        $('.handlinginfo_image').removeClass('hide');
        $(".checkout_flightdate").prop('disabled', false);
        $(".checkin_flightdate").datepicker( "option","disabled",false);
        $(".ui-datepicker-trigger").click(function(){
                 $(".notify-bg-v").fadeIn();
                 $('.notify-bg-v').css('height',0);
                 $('.notify-bg-v').css('height', $(document).height());
        });
        $(".checkin_flightdate,.checkout_flightdate").addClass('white_bg');
        $("#hotel_btn").attr('data-edit',0);
        $("#hotel_btn").val($("#hotel_btn").attr('data-value'));
        var val=$("#hotel_btn").attr('data-value');
        if(val!='SUBMIT')
          $('[data-value="SUBMIT"]').prop('disabled',true);
   }
   else if(id=="misc_btn_edit"){
        $(".service_desc,.misc_actual_bill,.misc_remarks").prop('readonly',false);
        $(".misc_checkout").datepicker( "option", "disabled",false);
        $(".misc_checkout").removeClass('white_bg');
        $("#misc_btn").attr('data-edit',0);
        $("#misc_btn").val($("#misc_btn").attr('data-value'));
        var val=$("#misc_btn").attr('data-value');
        if(val!='SUBMIT')
          $('[data-value="SUBMIT"]').prop('disabled',true);
   }
   $('#edit_modal').modal('hide');
});
function hidemsg(id) {
    setTimeout(function(){ 
        $("#"+id).parent().addClass('hide');
    },5000);
}
</script>
@stop