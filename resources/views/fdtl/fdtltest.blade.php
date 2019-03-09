@extends('layouts.check_quick_plan_layout')
@section('content')
<div class="page" id="app">  
    @include('includes.new_header',[])
<script>
$(document).ready(function () {
$(".v_notification").click(function () {
            $(".notify-bg-v").fadeIn();
            $('.notify-bg-v').css('height', $(document).height());
        });
        $(".notify-bg-v").click(function () {
            $(".notify-bg-v").fadeOut();
        });
$("#datepicker,#datepicker1,#datepicker2,#datepicker3,#datepicker4,#datepicker5,.ui-datepicker-trigger").click(function () {
		$(".notify-bg-v").fadeIn();
		$('.notify-bg-v').css('height', $(document).height());
	});
$('.navbar .dropdown').hover(function () {
 $(this).find('.dropdown-menu').first().stop(true, true).slideDown(500);
}, function () {
	$(this).find('.dropdown-menu').first().stop(true, true).slideUp(225)
});
//$("#datepicker" ).datepicker({ dateFormat: 'dd-M-y' });
//$( "#datepicker1" ).datepicker({ dateFormat: 'dd-M-y' });
//$( "#datepicker2" ).datepicker({ dateFormat: 'dd-M-y' });
//$( "#datepicker3" ).datepicker({ dateFormat: 'dd-M-y' });
//$( "#datepicker4" ).datepicker({ dateFormat: 'dd-M-y' });
//$( "#datepicker5" ).datepicker({ dateFormat: 'dd-M-y', onSelect: function() {        
//} });
//
 $(".datepicker1").datepicker({showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true, minDate: 0, showOtherMonths: true, selectOtherMonths: true,
        showAnim: "slide",
        dateFormat: 'yy-mm-dd',
        onSelect: function() {
            $(".notify-bg-v").fadeOut();
        }
    });
    $(".datepicker1").datepicker("option", "dateFormat", "dd-M-yy");
//
$("#arrhour").keyup(function(){
      var hr=$(this).val().length;
	  if(hr==2)
	  $("#arrmin").focus();
   });
 $("#dephour").keyup(function(){
      var hr=$(this).val().length;
	  if(hr==2)
	  $("#depmin").focus(); 
   });
   $("#callsign").keyup(function(){
      var hr=$(this).val().length;
	  if(hr==5)
	  $("#operator").focus();  
   });
   $("#type").keyup(function(){
      var hr=$(this).val().length;
	  if(hr==4)
	  $("#auw").focus();  
   });
   $("#auw").keyup(function(){
      var hr=$(this).val().length;
	  if(hr==8)
	  $("#from").focus();  
   });
   function blinker() {
	$('.blinking').fadeOut(10);
	$('.blinking').fadeIn(10);
    }
   setInterval(blinker, 10);  
});
$(document).ready(function(){
    $("a").tooltip();
});
$(function () {
    var availableTags = [
        "1",
        "2",
        "3",
        "4",
        "5",                
        "6"
    ];
    $("#onetosix").autocomplete({
        source: availableTags,
        minLength: 0
    }).focus(function(){            
       $(this).autocomplete('search', $(this).val())
     });
});
$(document).ready(function () {
$("#deptime").keyup(function()
  {
    var to_length=$(this).val().length;
    var to=$(this).val()+':';
    if(to_length==2)
    {
       $(this).val(to);
       $(this).focus();
    }
	if(to_length==5)
      $("#flytime").focus();
  });
   $("#deptime").keypress(function(){
  console.log($(this).val().length)
  if($(this).val().length>=5)
  {
  return false;
  }
  });
  });
</script>
<style>
.notify-bg-v{
	background:rgba(0,0,0,.8);
	position: absolute;
	width: 100%;
	display:block;
	height:100%;
	z-index:9000;
	display: none;}
.ui-datepicker-trigger {display:none;}
body {
  font-family: 'pt_sansregular', sans-serif;
  font-size: 13px;
  color: #f2f2f2;
  background-color: #f3f5f9;
}
a {
    text-decoration: none;
}
h2{
   line-height: 16px;
   font-weight:bold; 
}
a:hover {
    color: #000;
    text-decoration: none;
}
.dropdown-menu > li > a {
  padding: 5px 15px;
  font-weight: bold;
  color: #fff;
}

.group {
position: relative;
margin-bottom: 15px;
}
input {
font-size:14px;
padding: 4px 10px 4px 0px;
color: #000;
border-left: 0px;
border-right: 0px;
border-top: 0px;
border-color: #777;
border-width: 1px;
FONT-WEIGHT: bold;
background: #fff;
text-transform:uppercase;
}
input:focus {
outline: none;
border-color:#f1292b;
border-width:1px;
}
.fdtllabel {
color: #000;
font-size: 12px;
font-weight: normal;
position: absolute;
left: 14px;
top:12px;
pointer-events: none;
transition: 0.2s ease all;
-moz-transition: 0.2s ease all;
-webkit-transition: 0.2s ease all;
}
input:focus ~ .fdtllabel, input:valid ~ .fdtllabel {
top: -14px;
font-size: 12px;
color:#f1292b;
font-weight:bold;
}
.billing{
text-align: center;
padding: 5px 0px 5px 0px;
background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
box-shadow: 0 1px 2px 3px #999999;
margin-bottom: 3px;
}
.text_billing{
padding:5px 0;
font-weight: 600;
font-size: 15px;
margin:0px;
}
.text_billing:hover{
cursor:pointer;
text-decoration:underline;
}
.content{
padding:15px;
}
.btn-search{
transition: all 0.25s ease;
overflow: hidden;
position: relative;
display: inline-block;
margin-bottom: 0;
color: #fff;
font-size: 14px;
line-height: 22px;
font-weight: 300;
text-transform: uppercase;
text-align: center;
vertical-align: middle;
cursor: pointer;
border: none;
background: #F26232;
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f37858', endColorstr='#f1292b');
background: -webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b));
z-index: 3;
border-radius: 4px;
width: 38px;
line-height: 18px;
margin-top: 2px;
}
.btn-search:hover:before {
visibility: visible;
width: 200%;
left: -46%;
}
.btn-search:before {
-webkit-transition: all 0.35s ease;
-moz-transition: all 0.35s ease;
-o-transition: all 0.35s ease;
transition: all 0.35s ease;
-webkit-transform: skew(45deg,0);
-moz-transform: skew(45deg,0);
-ms-transform: skewX(45deg) skewY(0);
-o-transform: skew(45deg,0);
transform: skew(45deg,0);
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
color:#fff;
}
.btn:hover, .btn:focus, .btn.focus{
color:#fff;
}
.bar{
font-size: 11px;
color: #0089cf;
text-transform: uppercase;
font-style: italic;
}
/*.navbar-default {
border-color: #e7e7e7;
background: -webkit-gradient(linear, left top, left bottom, from(#00b9f5), to(#0089cf));
}
.navbar-default .navbar-nav > li > a {
color: #fff;
font-size: 15px;
font-weight: bold;
}
.dropdown-menu{
min-width: 125px;
left:-1px;
background: -webkit-gradient(linear, left top, left bottom, from(#00b9f5), to(#0089cf));
padding: 0px 0px 0px 0px;
}
.navbar-nav {
margin-left:12%;
}
.navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus {
background-color: #dcdcdc;
}
.dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus, .dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus{
filter: none;
background-color:#dcdcdc;
color: #0089cf;
font-weight: bold;
text-decoration: underline;
font-size: 14px;
display:block;
}
.navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus {
    color: #333;
    background-color: #dcdcdc!important;
}
.dropdown-menu > li > a:hover,
.dropdown-menu > li > a:focus,
.dropdown-menu > .active > a,
.dropdown-menu > .active > a:hover,
.dropdown-menu > .active > a:focus {
  background-image: none;
  filter: none;
  background-color: #4c5566;
  color: #fff;
}
.dropdown-submenu:hover > a,
.dropdown-submenu:focus > a {
  background-color: #4c5566;
  color: #fff;
}*/
input:placeholder{
color:red;
}
::-webkit-input-placeholder { /* Chrome */
  color: #777!important;
  font-weight:normal;
  text-align:left;
}
:-ms-input-placeholder { /* IE 10+ */
  color: #777!important;
}
::-moz-placeholder { /* Firefox 19+ */
  color: #777!important;
  opacity: 1;
}
:-moz-placeholder { /* Firefox 4 - 18 */
  color: #777!important;
  opacity: 1;
}
.arrdate{
visibility: hidden;
}
.arrdate:focus{
 visibility:visible;
top: -14px;
font-size: 12px;
color:#f1292b;
font-weight:bold;
}
.form-control{
    height: 31px!important;
}
table caption {
	padding: .5em 0;
}
@media screen and (max-width: 767px) {
  table caption {
    border-bottom: 1px solid #ddd;
  }
}
.p {
  text-align: center;
  padding-top: 140px;
  font-size: 14px;
}
.table-hover > tbody > tr:hover {
  background-color: #fff;
}
.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td{
color:#000;
font-size: 13px;
padding: 5px;
}
.table-responsive{
/*box-shadow: 0 1px 2px 2px #999999;*/
border-radius:4px;
margin-top: 0px;
}
.ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight{
background: #f1292b;
color: #fff;
text-align: center;
font-weight: bold;

}font-size: 16px;margin-top: 3px;
.ui-datepicker td span, .ui-datepicker td a:hover{
background-color:#333;
color:#fff;
text-align:center;
font-weight:bold;
}
.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-button.ui-state-active:hover{
border: 1px solid #3c3c3c;
background: #3c3c3c;
font-weight: bold;
color: #fff;
text-align: center;
}
.ui-widget-header .ui-icon:hover{
    background-image: url(../images/ui-icons_444444_256x240.png);
}
.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-button.ui-state-active:hover{
text-align:center;
}
/* blink */
.blink {
	-webkit-animation: blink .75s linear infinite;
	-moz-animation: blink .75s linear infinite;
	-ms-animation: blink .75s linear infinite;
	-o-animation: blink .75s linear infinite;
	 animation: blink .80s linear infinite;
	 font-size:13px;
    color:#f1292b;
	font-weight:bold;
	top: -14px;
}
@-webkit-keyframes blink {
	0% { opacity: 1; }
	50% { opacity: 1; }
	50.01% { opacity: 0; }
	100% { opacity: 0; }
}
@-moz-keyframes blink {
	0% { opacity: 1; }
	50% { opacity: 1; }
	50.01% { opacity: 0; }
	100% { opacity: 0; }
}
@-ms-keyframes blink {
	0% { opacity: 1; }
	50% { opacity: 1; }
	50.01% { opacity: 0; }
	100% { opacity: 0; }
}
@-o-keyframes blink {
	0% { opacity: 1; }
	50% { opacity: 1; }
	50.01% { opacity: 0; }
	100% { opacity: 0; }
}
@keyframes blink {
	0% { opacity: 1; }
	50% { opacity: 1; }
	50.01% { opacity: 0; }
	100% { opacity: 0; }
}
/* blink */
.ui-datepicker td span, .ui-datepicker td a{
text-align:center;
}
.red-tooltip + .tooltip > .tooltip-inner {
background-color: #000;color:#fff;
}
.table-bordered{
width:65%;
margin-bottom: 10px;
}
.ui-menu .ui-menu-item-wrapper:hover{
border:none;
text-align:center;
background-color: #f1292b!important;
color: #f9f9f9;
font-weight: bold;
transition:0.3s;
-webkit-transition: 0.3s;
-moz-transition:0.3s;
-o-transition: 0.3s;
}
.ui-menu .ui-menu-item-wrapper:visited{
border:none;
text-align:center;
background-color: #f1292b!important;
color: #f9f9f9;
font-weight: bold;
transition:0.3s;
-webkit-transition: 0.3s;
-moz-transition:0.3s;
-o-transition: 0.3s;
}
.ui-menu .ui-menu-item-wrapper{
font-weight: bold;
text-align:center;
}
.ui-menu .ui-state-focus,
.ui-menu .ui-state-active {
	margin: 0px!important;
}
.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-button.ui-state-active:hover{
background:#444!important;
color:#fff;
text-align:center;
border:none;
}
html .ui-button.ui-state-disabled:hover,
html .ui-button.ui-state-disabled:active {
	border: 1px solid #c5c5c5;
	background: #e9e9e9!important;
	font-weight: normal;
	color: #454545;
}
.ui-state-highlight,
.ui-widget-content .ui-state-highlight,
.ui-widget-header .ui-state-highlight {
	border: none!important;
	background: #f1292b!important;
	color: #fff;
}
.ui-state-default, .ui-widget-content .ui-state-default:hover{
background: #777;
color: #fff;
}
.ui-widget-header{
color: #fff;
font-weight: bold;
font-size: 14px;
text-transform: uppercase;
}
.ui-datepicker .ui-datepicker-prev{
    background-color: #e9e9e9!important;
    cursor: pointer;
}
.ui-datepicker .ui-datepicker-next{
background-color: #e9e9e9!important;
    cursor: pointer;
}
.ui-datepicker .ui-datepicker-header{
    background-color: #777!important;
}
.table-bordered{
    border-width: 3px;
    border-style: ridge;
	border-color: grey;
}
.ui-datepicker .ui-datepicker-prev{
left:1px!important;
top:2px!important;
}
.ui-datepicker .ui-datepicker-next{
right:2px!important;
top:2px!important;
}
.panel{
margin-bottom:2px!important;
}
.panel-default>.panel-heading{
color: #e9e9e9;;
cursor:pointer;
background: -webkit-linear-gradient(top, #4c4c4c 8%,#4c4c4c 8%,#595959 17%,#666666 28%,#474747 39%,#2c2c2c 50%,#000000 51%,#111111 60%,#2b2b2b 76%,#1c1c1c 91%,#131313 100%);
}
.panel-default>.panel-heading:hover{
background: -webkit-radial-gradient(center, ellipse cover, rgba(0,0,0,0.65) 0%,rgba(0,0,0,0) 100%); /* Chrome10-25,Safari5.1-6 */
color:#222;
}
.panel-default>.panel-heading+.panel-collapse>.panel-body{
padding:0;
box-shadow: 3px 3px 12px 0px #999;
}
.panel-heading{
padding: 5px 15px;
border-radius: 5px;
}
.panel-default{
border:none;
}
</style>
<div class="notify-bg-v"></div>
<div class="container" id="faqAccordion" style="width:900px;margin-top:15px;">
		<div class="panel panel-default ">
            <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question0">
                <span class="text_billing">FDTL TEST</span>
            </div>
            <div id="question0" style="background-color:white;" class="panel-collapse collapse in" style="height: 0px;">
                <div class="panel-body">
                    <div class="content">
            <div class="group col-md-4" style="width:13%;margin-left:23px;margin-top: 15px;">
                <input style="width:100%;display:block;" id="callsign" name="callsign" type="text" required>
                <span class="bar"></span>
                <label class="fdtllabel">CALL SIGN</label>
            </div>
            <div class="group col-md-8" style="width:13%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="noofflights" id="onetosix" id="operator" type="text" required>
                <span class="bar"></span>
                <label class="fdtllabel">No. of FLIGHTS</label>
            </div>
			<div class="group col-md-3" style="width:15%;margin-top: 15px;">
                <input class="datepicker1" style="width:100%;display:block;" onkeydown="return false" name="flightdate" id="datepicker" type="text" required="">
                <span class="bar"></span>
                <label class="fdtllabel">FLIGHT DATE</label>
            </div>
			<!--4-->
			<div class="group col-md-3" style="width:13%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="from" id="type" type="text" required>
                <span class="bar"></span>
                <label class="fdtllabel">FROM</label>
            </div>
            <div class="group col-md-3" style="width:13%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="to" id="auw" type="text" required>
                <span class="bar"></span>
                <label class="fdtllabel">TO</label>
            </div>
			<div class="group col-md-3" style="width:15%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="DEP. TIME (IST)" id="deptime" type="text" required>
                <label class="fdtllabel">DEP. TIME (IST)</label>
            </div>
			<div class="group col-md-3" style="width:15%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="FLYING TIME" id="flytime" type="text" required>
                <label class="fdtllabel">FLYING TIME</label>
            </div>
			<div class="col-md-12" style="margin-bottom:7px;">
            <div class="group col-md-3" style="margin-left: 117px;width:27%;">
                <input style="width:100%;background-color: #e9e9e9;display:block;" name="depzzzzname"  disabled="disabled" type="text" required>
                <label class="fdtllabel" style="margin-left: 5px;">DEP. ZZZZ NAME</label>
            </div>
            <div class="group col-md-3" style="width:27%;">
                <input style="width:100%;background-color: #e9e9e9;display:block;" disabled="disabled" type="text" required>
                <label class="fdtllabel" style="margin-left: 5px;">DEST. ZZZZ NAME</label>
            </div>
			<div class="group col-md-3" style="width:250px;padding-right: 0px;">
				 <button style="font-weight:bold;z-index:0;width:45%;" type="button" class="btn btn-search"><span>CALCULATE</span></button>
				 <a href="#"><img style="width:30px;margin-top:2px;margin-left:49px;" src="{{url('media/images/fdtl/delete.png')}}"/></a>
			</div>
			</div>
		</div>
        </div>
        </div>
        </div>  <!-- close one-->
		<div class="panel panel-default ">
            <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question1">
                <span class="text_billing">FIXED WING <span style="margin-left:3px;">DOMESTIC FLIGHT # 1</span></span>
            </div>
            <div id="question1" class="panel-collapse collapse" style="height: 0px;">
                <div class="panel-body">
                    <div class="content">
            <div class="group col-md-4" style="width:13%;margin-left:23px;margin-top: 15px;">
                <input style="width:100%;display:block;" id="callsign" name="callsign" type="text" required>
                <label class="fdtllabel">CALL SIGN</label>
            </div>
            <div class="group col-md-8" style="width:13%;margin-top: 15px;">
                <input style="width:100%;display:block;"  name="noofflights" id="onetosix" id="operator" type="text" required>
                <label class="fdtllabel">No. of FLIGHTS</label>
            </div>
			<div class="group col-md-3" style="width:15%;margin-top: 15px;">
                <input class="datepicker1" style="width:100%;display:block;" onkeydown="return false" name="flightdate" id="datepicker1" type="text" required="">
                <label class="fdtllabel">FLIGHT DATE</label>
            </div>
			<!--4-->
			<div class="group col-md-3" style="width:13%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="from" id="type" type="text" required>
                <label class="fdtllabel">FROM</label>
            </div>
            <div class="group col-md-3" style="width:13%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="to" id="auw" type="text" required>
                <label class="fdtllabel">TO</label>
            </div>
			<div class="group col-md-3" style="width:15%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="DEP. TIME (IST)" id="deptime" type="text" required>
                <label class="fdtllabel">DEP. TIME (IST)</label>
            </div>
			<div class="group col-md-3" style="width:15%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="FLYING TIME" id="flytime" type="text" required>
                <label class="fdtllabel">FLYING TIME</label>
            </div>
			<div class="col-md-12" style="margin-bottom:7px;">
            <div class="group col-md-3" style="margin-left: 117px;width:27%;">
                <input style="width:100%;background-color: #e9e9e9;display:block;" name="depzzzzname"  disabled="disabled" type="text" required>
                <label class="fdtllabel" style="margin-left: 5px;">DEP. ZZZZ NAME</label>
            </div>
            <div class="group col-md-3" style="width:27%;">
                <input style="width:100%;background-color: #e9e9e9;display:block;" disabled="disabled" type="text" required>
                <label class="fdtllabel" style="margin-left: 5px;">DEST. ZZZZ NAME</label>
            </div>
			<div class="group col-md-3" style="width:250px;padding-right: 0px;">
				 <button style="font-weight:bold;z-index:0;width:45%;" type="button" class="btn btn-search"><span>EDIT</span></button>
				<a href="#"><img style="width:30px;margin-top:2px;margin-left:49px;" src="{{url('media/images/fdtl/delete.png')}}"/></a>
			</div>
			</div>
		</div>
		<div class="col-md-12" style="background: #fff;box-shadow: inset 0 20px 20px -20px #999999;">
		    <div class="col-md-12" style="margin-top:25px;">
				<div style="position: absolute;left:366px;"><a data-toggle="tooltip" data-placement="top" title="" data-original-title="DAY FLIGHT"><img href="#" style="width:40px;margin-top:3px;" src="{{url('media/images/fdtl/sun1.png')}}"/></a></div>
				<div style="position: absolute;left:432px;margin-top:1px;"><a data-toggle="tooltip" data-placement="top" title="" data-original-title="NIGHT FLIGHT"><img href="#" style="width:40px;margin-top:3px;" src="{{url('media/images/fdtl/moon1.png')}}"/></a></div>
	            <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="DAY FLIGHT" class="red-tooltip" style="position: absolute;left:384px;top:-16px;color:#f6913d;font-weight: bold;font-size:15px;">1</a>
	           <a href="#" data-toggle="tooltip" data-placement="right" title="" data-original-title="NIGHT FLIGHT" class="red-tooltip" style="position: absolute;left:450px;top:-16px;color:#a0a0a0;font-weight: bold;font-size:15px;;">0</a>				
			</div>
			 <div class="col-md-12" style="display:none;">
			    <img style="width:30px;margin-top:-4px;margin-left:290px;float:left;" src="{{url('media/images/fdtl/thumbs-up.png')}}" />
				<h2 style="font-size:16px;color:#000;margin-left:5px;float:left;margin-top:10px;">FIXED WING <span style="margin-left:5px;">DOMESTIC FLIGHT # 1</span></h2>
			</div>
			<div class="col-md-12" style="margin-top:40px;">
			    <img style="width:30px;margin-top:-4px;margin-left:28%;float:left;" src="{{url('media/images/fdtl/thumbs-up.png')}}"/>
				<h2 style="font-size:16px;color:#000;margin-left:5px;float:left;margin-top:10px;">FIXED WING <span style="margin-left:5px;">INTERNATIONAL FLIGHT # 1</span></h2>
			</div>
				<div class="container"style="width:600px;">
				  <div class="row">
					<div class="col-xs-12">
					  <div class="table-responsive">
						<table style="margin-left:107px;" class="table table-bordered table-hover">
						  <tbody>
							<tr>
							 <td style="width:100px;">SPLIT DUTY</td>
							 <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="SPLIT DUTY" class="red-tooltip na_hove" >NA</a></td>
							  <td><span style="margin-left:5px;font-size:13px;width:130px;">WOCL</span></td>
							  <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="WOCL" class="red-tooltip na_hove" >NA</a></td>
							</tr>
							<tr>
							  <td style="width:100px;">REPORT TIME</td>
							  <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="REPORT TIME" class="red-tooltip" >23:55</a></td>
							  <td><span style="margin-left:5px;font-size:13px;width:130px;">DUTY END TIME</span></td>
							  <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="DUTY END TIME" class="red-tooltip" >01:30</a></td>
							</tr>
							<tr>
							 <td style="width:100px;">FLIGHT TIME</td>
							 <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="FLIGHT TIME" class="red-tooltip" >01:55</a></td>
							  <td><span style="margin-left:5px;font-size:13px;width:130px;">FLIGHT DUTY PERIOD</span></td>
							  <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="FLIGHT DUTY PERIOD" class="red-tooltip" >02:55</a></td>
							</tr>
							
							<tr>
							<td style="font-weight:bold;width:100px;font-size:14px;background:#e9e9e9;">TOTAL FT</td>
							 <td style="width:60px;text-align:center;font-weight:bold;font-size:14px;background:#e9e9e9;"><a href="#" data-toggle="tooltip" style="color:#000;" data-placement="top" title="" data-original-title="FLIGHT TIME" class="red-tooltip" >01:55</a></td>
							  <td style="background:#e9e9e9;"><span style="margin-left:5px;font-size:13px;font-weight:bold;font-size:14px;width:130px;">TOTAL FDP</span></td>
							  <td style="font-weight:bold;font-size:14px;font-weight:bold;width:60px;text-align:center;background:#e9e9e9;"><a href="#" data-toggle="tooltip" style="color:#000;" data-placement="top" title="" data-original-title="TOTAL FDP" class="red-tooltip" >02:55</a></td>
							</tr>
						  </tbody>
						</table>
					  </div><!--end of .table-responsive-->  
					</div>
				  </div>
				</div>
            </div>
                </div>
            </div>
        </div>  <!-- close two-->
		<div class="panel panel-default ">
            <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question2">
                <span class="text_billing">FIXED WING <span style="margin-left:3px;">INTERNATIONAL FLIGHT # 1</span></span>
            </div>
            <div id="question2" class="panel-collapse collapse" style="height: 0px;">
                <div class="panel-body">
                    <div class="content">
            <div class="group col-md-4" style="width:13%;margin-left:23px;margin-top: 15px;">
                <input style="width:100%;display:block;" id="callsign" name="callsign" type="text" required>
                <label class="fdtllabel">CALL SIGN</label>
            </div>
            <div class="group col-md-8" style="width:13%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="noofflights" id="onetosix" id="operator" type="text" required>
                <label class="fdtllabel">No. of FLIGHTS</label>
            </div>
			<div class="group col-md-3" style="width:15%;margin-top: 15px;">
                <input class="datepicker1" style="width:100%;display:block;" onkeydown="return false" name="flightdate" id="datepicker2" type="text" required="">
                <label class="fdtllabel">FLIGHT DATE</label>
            </div>
			<!--4-->
			<div class="group col-md-3" style="width:13%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="from" id="type" type="text" required>
                <label class="fdtllabel">FROM</label>
            </div>
            <div class="group col-md-3" style="width:13%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="to" id="auw" type="text" required>
                <label class="fdtllabel">TO</label>
            </div>
			<div class="group col-md-3" style="width:15%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="DEP. TIME (IST)" id="deptime" type="text" required>
                <label class="fdtllabel">DEP. TIME (IST)</label>
            </div>
			<div class="group col-md-3" style="width:15%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="FLYING TIME" id="flytime" type="text" required>
                <label class="fdtllabel">FLYING TIME</label>
            </div>
			<div class="col-md-12" style="margin-bottom:7px;">
            <div class="group col-md-3" style="margin-left: 117px;width:27%;">
                <input style="width:100%;display:block;background-color: #e9e9e9;" name="depzzzzname"  disabled="disabled" type="text" required>
                <label class="fdtllabel" style="margin-left: 5px;">DEP. ZZZZ NAME</label>
            </div>
            <div class="group col-md-3" style="width:27%;">
                <input style="width:100%;display:block;background-color: #e9e9e9;" disabled="disabled" type="text" required>
                <label class="fdtllabel" style="margin-left: 5px;">DEST. ZZZZ NAME</label>
            </div>
			<div class="group col-md-3" style="width:250px;padding-right: 0px;">
				 <button style="font-weight:bold;z-index:0;width:45%;" type="button" class="btn btn-search"><span>EDIT</span></button>
				 <a href="#"><img style="width:30px;margin-top:2px;margin-left:49px;" src="{{url('media/images/fdtl/delete.png')}}"/></a>
			</div>
			</div>
		</div>
		<div class="col-md-12" style="background: #fff;box-shadow: inset 0 20px 20px -20px #999999;">
		    <div class="col-md-12" style="margin-top:25px;">
				<div style="position: absolute;left:366px;"><a data-toggle="tooltip" data-placement="top" title="" data-original-title="DAY FLIGHT"><img href="#" style="width:40px;margin-top:3px;" src="{{url('media/images/fdtl/sun1.png')}}"/></a></div>
				<div style="position: absolute;left:432px;margin-top:1px;"><a data-toggle="tooltip" data-placement="top" title="" data-original-title="NIGHT FLIGHT"><img href="#" style="width:40px;margin-top:3px;" src="{{url('media/images/fdtl/moon1.png')}}"/></a></div>
	            <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="DAY FLIGHT" class="red-tooltip" style="position: absolute;left:384px;top:-16px;color:#f6913d;font-weight: bold;font-size:15px;">1</a>
	           <a href="#" data-toggle="tooltip" data-placement="right" title="" data-original-title="NIGHT FLIGHT" class="red-tooltip" style="position: absolute;left:450px;top:-16px;color:#a0a0a0;font-weight: bold;font-size:15px;;">0</a>				
			</div>
			 <div class="col-md-12" style="display:none;">
			    <img style="width:30px;margin-top:-4px;margin-left:290px;float:left;" src="{{url('media/images/fdtl/thumbs-up.png')}}"/>
				<h2 style="font-size:16px;color:#000;margin-left:5px;float:left;margin-top:10px;">FIXED WING <span style="margin-left:5px;">DOMESTIC FLIGHT # 1</span></h2>
			</div>
			<div class="col-md-12" style="margin-top:40px;">
			    <img style="width:30px;margin-top:-4px;margin-left:28%;float:left;" src="{{url('media/images/fdtl/thumbs-up.png')}}"/>
				<h2 style="font-size:16px;color:#000;margin-left:5px;float:left;margin-top:10px;">FIXED WING <span style="margin-left:5px;">INTERNATIONAL FLIGHT # 1</span></h2>
			</div>
				<div class="container"style="width:600px;">
				  <div class="row">
					<div class="col-xs-12">
					  <div class="table-responsive">
						<table style="margin-left:107px;" class="table table-bordered table-hover">
						  <tbody>
							<tr>
							 <td style="width:100px;">SPLIT DUTY</td>
							 <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="SPLIT DUTY" class="red-tooltip na_hove" >NA</a></td>
							  <td><span style="margin-left:5px;font-size:13px;width:130px;">WOCL</span></td>
							  <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="WOCL" class="red-tooltip na_hove" >NA</a></td>
							</tr>
							<tr>
							  <td style="width:100px;">REPORT TIME</td>
							  <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="REPORT TIME" class="red-tooltip" >23:55</a></td>
							  <td><span style="margin-left:5px;font-size:13px;width:130px;">DUTY END TIME</span></td>
							  <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="DUTY END TIME" class="red-tooltip" >01:30</a></td>
							</tr>
							<tr>
							 <td style="width:100px;">FLIGHT TIME</td>
							 <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="FLIGHT TIME" class="red-tooltip" >01:55</a></td>
							  <td><span style="margin-left:5px;font-size:13px;width:130px;">FLIGHT DUTY PERIOD</span></td>
							  <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="FLIGHT DUTY PERIOD" class="red-tooltip" >02:55</a></td>
							</tr>
							<tr>
							<td style="font-weight:bold;width:100px;font-size:14px;background:#e9e9e9;">TOTAL FT</td>
							 <td style="width:60px;text-align:center;font-weight:bold;font-size:14px;background:#e9e9e9;"><a href="#" data-toggle="tooltip" style="color:#000;" data-placement="top" title="" data-original-title="FLIGHT TIME" class="red-tooltip" >01:55</a></td>
							  <td style="background:#e9e9e9;"><span style="margin-left:5px;font-size:13px;font-weight:bold;font-size:14px;width:130px;">TOTAL FDP</span></td>
							  <td style="font-weight:bold;font-size:14px;font-weight:bold;width:60px;text-align:center;background:#e9e9e9;"><a href="#" data-toggle="tooltip" style="color:#000;" data-placement="top" title="" data-original-title="TOTAL FDP" class="red-tooltip" >02:55</a></td>
							</tr>
						  </tbody>
						</table>
					  </div><!--end of .table-responsive-->  
					</div>
				  </div>
				</div>
            </div>
                </div>
            </div>
        </div>  <!-- close three-->
		<div class="panel panel-default ">
            <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question3">
                <span class="text_billing">FIXED WING <span style="margin-left:3px;">DOMESTIC FLIGHT # 1</span></span>
            </div>
            <div id="question3" class="panel-collapse collapse" style="height: 0px;">
                <div class="panel-body">
                    <div class="content">
            <div class="group col-md-4" style="width:13%;margin-left:23px;margin-top: 15px;">
                <input style="width:100%;display:block;" id="callsign" name="callsign" type="text" required>
                <label class="fdtllabel">CALL SIGN</label>
            </div>
            <div class="group col-md-8" style="width:13%;margin-top: 15px;">
                <input style="width:100%;display:block;"  name="noofflights" id="onetosix" id="operator" type="text" required>
                <label class="fdtllabel">No. of FLIGHTS</label>
            </div>
			<div class="group col-md-3" style="width:15%;margin-top: 15px;">
                <input class="datepicker1" style="width:100%;display:block;" onkeydown="return false" name="flightdate" id="datepicker3" type="text" required="">
                <label class="fdtllabel">FLIGHT DATE</label>
            </div>
			<!--4-->
			<div class="group col-md-3" style="width:13%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="from" id="type" type="text" required>
                <label class="fdtllabel">FROM</label>
            </div>
            <div class="group col-md-3" style="width:13%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="to" id="auw" type="text" required>
                <label class="fdtllabel">TO</label>
            </div>
			<div class="group col-md-3" style="width:15%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="DEP. TIME (IST)" id="deptime" type="text" required>
                <label class="fdtllabel">DEP. TIME (IST)</label>
            </div>
			<div class="group col-md-3" style="width:15%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="FLYING TIME" id="flytime" type="text" required>
                <label class="fdtllabel">FLYING TIME</label>
            </div>
			<div class="col-md-12" style="margin-bottom:7px;">
            <div class="group col-md-3" style="margin-left: 117px;width:27%;">
                <input style="width:100%;display:block;background-color: #e9e9e9;" name="depzzzzname"  disabled="disabled" type="text" required>
                <label class="fdtllabel" style="margin-left: 5px;">DEP. ZZZZ NAME</label>
            </div>
            <div class="group col-md-3" style="width:27%;">
                <input style="width:100%;display:block;background-color: #e9e9e9;" disabled="disabled" type="text" required>
                <label class="fdtllabel" style="margin-left: 5px;">DEST. ZZZZ NAME</label>
            </div>
			<div class="group col-md-3" style="width:250px;padding-right: 0px;">
				 <button style="font-weight:bold;z-index:0;width:45%;" type="button" class="btn btn-search"><span>EDIT</span></button>
				 <a href="#"><img style="width:30px;margin-top:2px;margin-left:49px;" src="{{url('media/images/fdtl/delete.png')}}"/></a>
			</div>
			</div>
		</div>
		<div class="col-md-12" style="background: #fff;box-shadow: inset 0 20px 20px -20px #999999;">
		    <div class="col-md-12" style="margin-top:25px;">
				<div style="position: absolute;left:366px;"><a data-toggle="tooltip" data-placement="top" title="" data-original-title="DAY FLIGHT"><img href="#" style="width:40px;margin-top:3px;" src="{{url('media/images/fdtl/sun1.png')}}"/></a></div>
				<div style="position: absolute;left:432px;margin-top:1px;"><a data-toggle="tooltip" data-placement="top" title="" data-original-title="NIGHT FLIGHT"><img href="#" style="width:40px;margin-top:3px;" src="{{url('media/images/fdtl/moon1.png')}}"/></a></div>
	            <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="DAY FLIGHT" class="red-tooltip" style="position: absolute;left:384px;top:-16px;color:#f6913d;font-weight: bold;font-size:15px;">1</a>
	           <a href="#" data-toggle="tooltip" data-placement="right" title="" data-original-title="NIGHT FLIGHT" class="red-tooltip" style="position: absolute;left:450px;top:-16px;color:#a0a0a0;font-weight: bold;font-size:15px;;">0</a>				
			</div>
			 <div class="col-md-12" style="display:none;">
			    <img style="width:30px;margin-top:-4px;margin-left:290px;float:left;" src="{{url('media/images/fdtl/thumbs-up.png')}}"/>
				<h2 style="font-size:16px;color:#000;margin-left:5px;float:left;margin-top:10px;">FIXED WING <span style="margin-left:5px;">DOMESTIC FLIGHT # 1</span></h2>
			</div>
			<div class="col-md-12" style="margin-top:40px;">
			    <img style="width:30px;margin-top:-4px;margin-left:28%;float:left;" src="{{url('media/images/fdtl/thumbs-up.png')}}"/>
				<h2 style="font-size:16px;color:#000;margin-left:5px;float:left;margin-top:10px;">FIXED WING <span style="margin-left:5px;">INTERNATIONAL FLIGHT # 1</span></h2>
			</div>
				<div class="container"style="width:600px;">
				  <div class="row">
					<div class="col-xs-12">
					  <div class="table-responsive">
						<table style="margin-left:107px;" class="table table-bordered table-hover">
						  <tbody>
							<tr>
							 <td style="width:100px;">SPLIT DUTY</td>
							 <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="SPLIT DUTY" class="red-tooltip na_hove" >NA</a></td>
							  <td><span style="margin-left:5px;font-size:13px;width:130px;">WOCL</span></td>
							  <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="WOCL" class="red-tooltip na_hove" >NA</a></td>
							</tr>
							<tr>
							  <td style="width:100px;">REPORT TIME</td>
							  <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="REPORT TIME" class="red-tooltip" >23:55</a></td>
							  <td><span style="margin-left:5px;font-size:13px;width:130px;">DUTY END TIME</span></td>
							  <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="DUTY END TIME" class="red-tooltip" >01:30</a></td>
							</tr>
							<tr>
							 <td style="width:100px;">FLIGHT TIME</td>
							 <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="FLIGHT TIME" class="red-tooltip" >01:55</a></td>
							  <td><span style="margin-left:5px;font-size:13px;width:130px;">FLIGHT DUTY PERIOD</span></td>
							  <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="FLIGHT DUTY PERIOD" class="red-tooltip" >02:55</a></td>
							</tr>
							<tr>
							<td style="font-weight:bold;width:100px;font-size:14px;background:#e9e9e9;">TOTAL FT</td>
							 <td style="width:60px;text-align:center;font-weight:bold;font-size:14px;background:#e9e9e9;"><a href="#" data-toggle="tooltip" style="color:#000;" data-placement="top" title="" data-original-title="FLIGHT TIME" class="red-tooltip" >01:55</a></td>
							  <td style="background:#e9e9e9;"><span style="margin-left:5px;font-size:13px;font-weight:bold;font-size:14px;width:130px;">TOTAL FDP</span></td>
							  <td style="font-weight:bold;font-size:14px;font-weight:bold;width:60px;text-align:center;background:#e9e9e9;"><a href="#" data-toggle="tooltip" style="color:#000;" data-placement="top" title="" data-original-title="TOTAL FDP" class="red-tooltip" >02:55</a></td>
							</tr>
						  </tbody>
						</table>
					  </div><!--end of .table-responsive-->  
					</div>
				  </div>
				</div>
            </div>
                </div>
            </div>
        </div>  <!-- close four-->
		<div class="panel panel-default ">
            <div class="panel-heading accordion-toggle collapsed question-toggle" style="background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858));
             " data-toggle="collapse" data-parent="#faqAccordion" data-target="#question4">
                <span class="text_billing">FIXED WING <span style="margin-left:3px;">INTERNATIONAL FLIGHT # 1</span></span>
            </div>
            <div id="question4" class="panel-collapse collapse" style="height: 0px;">
                <div class="panel-body">
                    <div class="content">
            <div class="group col-md-4" style="width:13%;margin-left:23px;margin-top: 15px;">
                <input style="width:100%;display:block;" id="callsign" name="callsign" type="text" required>
                <label class="fdtllabel">CALL SIGN</label>
            </div>
            <div class="group col-md-8" style="width:13%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="noofflights" id="onetosix" id="operator" type="text" required>
                <label class="fdtllabel">No. of FLIGHTS</label>
            </div>
			<div class="group col-md-3" style="width:15%;margin-top: 15px;">
                <input class="datepicker1" style="width:100%;display:block;" onkeydown="return false" name="flightdate" id="datepicker4" type="text" required="">
                <label class="fdtllabel">FLIGHT DATE</label>
            </div>
			<!--4-->
			<div class="group col-md-3" style="width:13%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="from" id="type" type="text" required>
                <label class="fdtllabel">FROM</label>
            </div>
            <div class="group col-md-3" style="width:13%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="to" id="auw" type="text" required>
                <label class="fdtllabel">TO</label>
            </div>
			<div class="group col-md-3" style="width:15%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="DEP. TIME (IST)" id="deptime" type="text" required>
                <label class="fdtllabel">DEP. TIME (IST)</label>
            </div>
			<div class="group col-md-3" style="width:15%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="FLYING TIME" id="flytime" type="text" required>
                <label class="fdtllabel">FLYING TIME</label>
            </div>
			<div class="col-md-12" style="margin-bottom:7px;">
            <div class="group col-md-3" style="margin-left: 117px;width:27%;">
                <input style="width:100%;display:block;background-color: #e9e9e9;" name="depzzzzname"  disabled="disabled" type="text" required>
                <label class="fdtllabel" style="margin-left: 5px;">DEP. ZZZZ NAME</label>
            </div>
            <div class="group col-md-3" style="width:27%;">
                <input style="width:100%;display:block;background-color: #e9e9e9;" disabled="disabled" type="text" required>
                <label class="fdtllabel" style="margin-left: 5px;">DEST. ZZZZ NAME</label>
            </div>
			<div class="group col-md-3" style="width:250px;padding-right: 0px;">
				 <button style="font-weight:bold;z-index:0;width:45%;" type="button" class="btn btn-search"><span>EDIT</span></button>
				<a href="#"><img style="width:30px;margin-top:2px;margin-left:49px;" src="{{url('media/images/fdtl/delete.png')}}"/></a>
			</div>
			</div>
		</div>
		<div class="col-md-12" style="background: #fff;box-shadow: inset 0 20px 20px -20px #999999;">
		    <div class="col-md-12" style="margin-top:25px;">
				<div style="position: absolute;left:366px;"><a data-toggle="tooltip" data-placement="top" title="" data-original-title="DAY FLIGHT"><img href="#" style="width:40px;margin-top:3px;" src="{{url('media/images/fdtl/sun1.png')}}"/></a></div>
				<div style="position: absolute;left:432px;margin-top:1px;"><a data-toggle="tooltip" data-placement="top" title="" data-original-title="NIGHT FLIGHT"><img href="#" style="width:40px;margin-top:3px;" src="{{url('media/images/fdtl/moon1.png')}}"/></a></div>
	            <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="DAY FLIGHT" class="red-tooltip" style="position: absolute;left:384px;top:-16px;color:#f6913d;font-weight: bold;font-size:15px;">1</a>
	           <a href="#" data-toggle="tooltip" data-placement="right" title="" data-original-title="NIGHT FLIGHT" class="red-tooltip" style="position: absolute;left:450px;top:-16px;color:#a0a0a0;font-weight: bold;font-size:15px;;">0</a>				
			</div>
			 <div class="col-md-12" style="display:none;">
			    <img style="width:30px;margin-top:-4px;margin-left:290px;float:left;" src="{{url('media/images/fdtl/thumbs-up.png')}}"/>
				<h2 style="font-size:16px;color:#000;margin-left:5px;float:left;margin-top:10px;">FIXED WING <span style="margin-left:5px;">DOMESTIC FLIGHT # 1</span></h2>
			</div>
			<div class="col-md-12" style="margin-top:40px;">
			    <img style="width:30px;margin-top:-4px;margin-left:28%;float:left;" src="{{url('media/images/fdtl/thumbs-up.png')}}"/>
				<h2 style="font-size:16px;color:#000;margin-left:5px;float:left;margin-top:10px;">FIXED WING <span style="margin-left:5px;">INTERNATIONAL FLIGHT # 1</span></h2>
			</div>
				<div class="container"style="width:600px;">
				  <div class="row">
					<div class="col-xs-12">
					  <div class="table-responsive">
						<table style="margin-left:107px;" class="table table-bordered table-hover">
						  <tbody>
							<tr>
							 <td style="width:100px;">SPLIT DUTY</td>
							 <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="SPLIT DUTY" class="red-tooltip na_hove" >NA</a></td>
							  <td><span style="margin-left:5px;font-size:13px;width:130px;">WOCL</span></td>
							  <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="WOCL" class="red-tooltip na_hove" >NA</a></td>
							</tr>
							<tr>
							  <td style="width:100px;">REPORT TIME</td>
							  <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="REPORT TIME" class="red-tooltip" >23:55</a></td>
							  <td><span style="margin-left:5px;font-size:13px;width:130px;">DUTY END TIME</span></td>
							  <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="DUTY END TIME" class="red-tooltip" >01:30</a></td>
							</tr>
							<tr>
							 <td style="width:100px;">FLIGHT TIME</td>
							 <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="FLIGHT TIME" class="red-tooltip" >01:55</a></td>
							  <td><span style="margin-left:5px;font-size:13px;width:130px;">FLIGHT DUTY PERIOD</span></td>
							  <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="FLIGHT DUTY PERIOD" class="red-tooltip" >02:55</a></td>
							</tr>
							
							<tr>
							<td style="font-weight:bold;width:100px;font-size:14px;background:#e9e9e9;">TOTAL FT</td>
							 <td style="width:60px;text-align:center;font-weight:bold;font-size:14px;background:#e9e9e9;"><a href="#" data-toggle="tooltip" style="color:#000;" data-placement="top" title="" data-original-title="FLIGHT TIME" class="red-tooltip" >01:55</a></td>
							  <td style="background:#e9e9e9;"><span style="margin-left:5px;font-size:13px;font-weight:bold;font-size:14px;width:130px;">TOTAL FDP</span></td>
							  <td style="font-weight:bold;font-size:14px;font-weight:bold;width:60px;text-align:center;background:#e9e9e9;"><a href="#" data-toggle="tooltip" style="color:#000;" data-placement="top" title="" data-original-title="TOTAL FDP" class="red-tooltip" >02:55</a></td>
							</tr>
						  </tbody>
						</table>
					  </div><!--end of .table-responsive-->  
					</div>
				  </div>
				</div>
            </div>
                </div>
            </div>
        </div>  <!-- close five-->
		<div class="panel panel-default ">
            <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question5">
                <span class="text_billing">FIXED WING <span style="margin-left:3px;">DOMESTIC FLIGHT # 1</span></span>
            </div>
            <div id="question5" class="panel-collapse collapse" style="height: 0px;">
                <div class="panel-body">
                    <div class="content">
            <div class="group col-md-4" style="width:13%;margin-left:23px;margin-top: 15px;">
                <input style="width:100%;display:block;" id="callsign" name="callsign" type="text" required>
                <label class="fdtllabel">CALL SIGN</label>
            </div>
            <div class="group col-md-8" style="width:13%;margin-top: 15px;">
                <input style="width:100%;display:block;"  name="noofflights" id="onetosix" id="operator" type="text" required>
                <label class="fdtllabel">No. of FLIGHTS</label>
            </div>
			<div class="group col-md-3" style="width:15%;margin-top: 15px;">
                <input class="datepicker1" style="width:100%;display:block;" onkeydown="return false" name="flightdate" id="datepicker5" type="text" required="">
                <label class="fdtllabel">FLIGHT DATE</label>
            </div>
			<div class="group col-md-3" style="width:13%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="from" id="type" type="text" required>
                <label class="fdtllabel">FROM</label>
            </div>
            <div class="group col-md-3" style="width:13%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="to" id="auw" type="text" required>
                <label class="fdtllabel">TO</label>
            </div>
			<div class="group col-md-3" style="width:15%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="DEP. TIME (IST)" id="deptime" type="text" required>
                <label class="fdtllabel">DEP. TIME (IST)</label>
            </div>
			<div class="group col-md-3" style="width:15%;margin-top: 15px;">
                <input style="width:100%;display:block;" name="FLYING TIME" id="flytime" type="text" required>
                <label class="fdtllabel">FLYING TIME</label>
            </div>
			<div class="col-md-12" style="margin-bottom:7px;">
            <div class="group col-md-3" style="margin-left: 117px;width:27%;">
                <input style="width:100%;display:block;background-color: #e9e9e9;" name="depzzzzname"  disabled="disabled" type="text" required>
                <label class="fdtllabel" style="margin-left: 5px;">DEP. ZZZZ NAME</label>
            </div>
            <div class="group col-md-3" style="width:27%;">
                <input style="width:100%;display:block;background-color: #e9e9e9;" disabled="disabled" type="text" required>
                <label class="fdtllabel" style="margin-left: 5px;">DEST. ZZZZ NAME</label>
            </div>
			<div class="group col-md-3" style="width:250px;padding-right: 0px;">
				 <button style="font-weight:bold;z-index:0;width:45%;" type="button" class="btn btn-search"><span>EDIT</span></button>
				 <a href="#"><img style="width:30px;margin-top:2px;margin-left:49px;" src="{{url('media/images/fdtl/delete.png')}}"/></a>
			</div>
			</div>
		</div>
		<div class="col-md-12" style="background: #fff;box-shadow: inset 0 20px 20px -20px #999999;">
		    <div class="col-md-12" style="margin-top:25px;">
				<div style="position: absolute;left:366px;"><a data-toggle="tooltip" data-placement="top" title="" data-original-title="DAY FLIGHT"><img href="#" style="width:40px;margin-top:3px;" src="{{url('media/images/fdtl/sun1.png')}}"/></a></div>
				<div style="position: absolute;left:432px;margin-top:1px;"><a data-toggle="tooltip" data-placement="top" title="" data-original-title="NIGHT FLIGHT"><img href="#" style="width:40px;margin-top:3px;" src="{{url('media/images/fdtl/moon1.png')}}"/></a></div>
	            <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="DAY FLIGHT" class="red-tooltip" style="position: absolute;left:384px;top:-16px;color:#f6913d;font-weight: bold;font-size:15px;">1</a>
	           <a href="#" data-toggle="tooltip" data-placement="right" title="" data-original-title="NIGHT FLIGHT" class="red-tooltip" style="position: absolute;left:450px;top:-16px;color:#a0a0a0;font-weight: bold;font-size:15px;;">0</a>				
			</div>
			 <div class="col-md-12" style="display:none;">
			    <img style="width:30px;margin-top:-4px;margin-left:290px;float:left;" src="{{url('media/images/fdtl/thumbs-up.png')}}"/>
				<h2 style="font-size:16px;color:#000;margin-left:5px;float:left;margin-top:10px;">FIXED WING <span style="margin-left:5px;">DOMESTIC FLIGHT # 1</span></h2>
			</div>
			<div class="col-md-12" style="margin-top:40px;">
			    <img style="width:30px;margin-top:-4px;margin-left:28%;float:left;" src="{{url('media/images/fdtl/thumbs-up.png')}}"/>
				<h2 style="font-size:16px;color:#000;margin-left:5px;float:left;margin-top:10px;">FIXED WING <span style="margin-left:5px;">INTERNATIONAL FLIGHT # 1</span></h2>
			</div>
				<div class="container"style="width:600px;">
				  <div class="row">
					<div class="col-xs-12">
					  <div class="table-responsive">
						<table style="margin-left:107px;" class="table table-bordered table-hover">
						  <tbody>
							<tr>
							 <td style="width:100px;">SPLIT DUTY</td>
							 <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="SPLIT DUTY" class="red-tooltip na_hove" >NA</a></td>
							  <td><span style="margin-left:5px;font-size:13px;width:130px;">WOCL</span></td>
							  <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="WOCL" class="red-tooltip na_hove" >NA</a></td>
							</tr>
							<tr>
							  <td style="width:100px;">REPORT TIME</td>
							  <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="REPORT TIME" class="red-tooltip" >23:55</a></td>
							  <td><span style="margin-left:5px;font-size:13px;width:130px;">DUTY END TIME</span></td>
							  <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="DUTY END TIME" class="red-tooltip" >01:30</a></td>
							</tr>
							<tr>
							 <td style="width:100px;">FLIGHT TIME</td>
							 <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="FLIGHT TIME" class="red-tooltip" >01:55</a></td>
							  <td><span style="margin-left:5px;font-size:13px;width:130px;">FLIGHT DUTY PERIOD</span></td>
							  <td style="width:60px;text-align:center;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="FLIGHT DUTY PERIOD" class="red-tooltip" >02:55</a></td>
							</tr>
							<tr>
							<td style="font-weight:bold;width:100px;font-size:14px;background:#e9e9e9;">TOTAL FT</td>
							 <td style="width:60px;text-align:center;font-weight:bold;font-size:14px;background:#e9e9e9;"><a href="#" data-toggle="tooltip" style="color:#000;" data-placement="top" title="" data-original-title="FLIGHT TIME" class="red-tooltip" >01:55</a></td>
							  <td style="background:#e9e9e9;"><span style="margin-left:5px;font-size:13px;font-weight:bold;font-size:14px;width:130px;">TOTAL FDP</span></td>
							  <td style="font-weight:bold;font-size:14px;font-weight:bold;width:60px;text-align:center;background:#e9e9e9;"><a href="#" data-toggle="tooltip" style="color:#000;" data-placement="top" title="" data-original-title="TOTAL FDP" class="red-tooltip" >02:55</a></td>
							</tr>
						  </tbody>
						</table>
					  </div><!--end of .table-responsive-->  
					</div>
				  </div>
				</div>
            </div>
                </div>
            </div>
        </div>  <!-- close six-->
</div> <!--faqAccordion close -->
</div> <!--container close here-->
    @include('includes.new_footer',[])
</div>
@stop