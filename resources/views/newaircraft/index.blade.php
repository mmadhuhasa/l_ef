@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@push('js')
<script src="{{url('app/js/navlog/jquery.growl.js')}}"></script>
<script src="{{url('app/js/sweet-alert.js')}}"></script>
<script src="{{url('app/js/jquery.sweet-alert.init.js')}}"></script>
@endpush
@push('css')
<link rel="stylesheet" href="{{url('/app/css/components.css')}}"/>
<link rel="stylesheet" href="{{url('app/css/new_aircraft.css')}}" />
<link rel="stylesheet" href="{{url('/app/css/navlog/jquery.growl.css')}}"/>
<link rel="stylesheet" href="{{url('app/css/sweet-alert.css')}}" />
@endpush
<style type="text/css">
   input[type=file] {
      background:url("http://cdn4.iconfinder.com/data/icons/dellios_system_icons/png_128/arrow-up.png") !important;
   }
   .growl.growl-large {
     top: 175px !important;
     width: 400px !important;
     padding:10px 6px 10px 6px !important;
     margin: 15px !important;
     text-align:center!important;
     left: 450px;
    }
   .wtcat dd ul, .transmode dd ul{
        left: 1px !important;
        width: 131 !important;
   }
   .transmode dd ul {
        width: 106px !important; 
   }
.speed dd ul,.designation dd ul {
       width: 132px !important;
       height: 70px !important;
       overflow-y: unset !important;
        overflow: unset !important;
   }
 .speeddl dd ul li a:hover {
    background: -webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b))!important;
    color: #fff;
    font-weight: bold;
    cursor: pointer;
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
.popover {
    width: 270px !important;
 }   
.top {
    margin-bottom: 5px;
}
.ui-autocomplete{
    width: 198px !important;
}
.ui-menu-item{
    font-size: 13px;
}
.custom-file-input::-webkit-file-upload-button {
  visibility: hidden;
}
.custom-file-input::before {
  content: 'Select some files';
  display: inline-block;
  background: -webkit-linear-gradient(top, #f9f9f9, #e3e3e3);
  border: 1px solid #999;
  border-radius: 3px;
  padding: 5px 8px;
  outline: none;
  white-space: nowrap;
  -webkit-user-select: none;
  cursor: pointer;
  text-shadow: 1px 1px #fff;
  font-weight: 700;
  font-size: 10pt;
}
.custom-file-input:hover::before {
  border-color: black;
}
.custom-file-input:active::before {
  background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
}
/*loader*/
#loading-img {
background: url(../media/images/loader.gif) center center no-repeat;
z-index: 20;
position: fixed;
width: 100px;
left: 50%;
margin-left: -50px;
margin-top: -50px;
}
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
.sweet-alert h2{
    color: #777;
    font-size: 15px;
    margin-bottom: 25px;
}
.sweet-alert p {
    font-size: 22px;
    line-height: 22px;
    color: #000;
    font-weight: bold;
    margin-bottom: 30px;
}
.sweet-alert .icon.success{
    margin-bottom: 30px;   
}
.btn-default:hover {
    color: #333 !important;
    background-color: #e6e6e6 !important;
    border-color: #adadad !important;
}
.btn-default{
    float: left;
    margin-left: 25px; 
    color: #333 !important;
    background-color: white !important;
}
.btn-success{
    float: right;
    margin-right: 25px;     
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
    color: #ffffff !important;
    /*border-color: none !important;*/
}
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
    border: none !important;
    background: #F26232;
    background: linear-gradient(to top, #fa9b5b, #F26232) !important;
    background: #f1292b;     
    background: -webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b)) !important;
    background: -moz-linear-gradient(top, #f37858, #f1292b) !important;
    z-index: 3;
    border-radius:6px;

}
.text-muted {
    color: #777 !important;
}
.ui-menu .ui-menu-item {
   font-weight: bold !important;
}
.test[style] {
padding-right:0;
}
.test.modal-open {
overflow: auto;
}
/*loader*/
</style>
@section('content')
<div id="page">
    @include('includes.new_header',[])
    <div class="overlay">
        <div id="loading-img"></div>
    </div> 
    <div class="container" style="margin: 10px auto;">
        <div class="boxContainer">
            <div class="topBrder"></div>
             <form id="new_aircraft" >
                <div class="contentBlock">                
                    <div class="row">
                        <div class="col-md-2 col-sm-2 col-xs-6 colPadFix">
                            <div class="ltrim_sec">
                                <div class="group dynamiclabel operator_newbill_wrapper">
                                    <input  class="input_blod  border_red disable special_symbols required" id="callsign" type="text" placeholder="CALLSIGN" name="callsign" autocomplete="off"  data-toggle="popover" data-placement="top" minlength="5" maxlength="5">
                                    <label id=""> CALLSIGN</label>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-4 col-sm-2 col-xs-6 colPadFix clsOperator">
                            <div class="ltrim_sec">
                                <div class="group dynamiclabel  operator_newbill_wrapper">
                                    <input  class="input_blod  border_red disable alpha_num_space required" id="operator" type="text" placeholder="OPERATOR" name="operator" autocomplete="off"  data-toggle="popover" data-placement="top" minlength="7" maxlength="30">
                                    <label id=""> OPERATOR</label>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-2 col-sm-2 col-xs-12 colPadFix clsTypAir">
                            <div class="ltrim_sec">
                                <div class="group dynamiclabel  operator_newbill_wrapper">
                                    <input  class="input_blod special_symbols border_red disable required" id="aircrafttype" type="text" placeholder="TYPE OF AIRCRAFT" name="aircrafttype" autocomplete="off" maxlength="3"  data-toggle="popover" data-placement="top">
                                    <label id=""> TYPE OF AIRCRAFT</label>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-2 col-sm-2 col-xs-4 colPadFix">
                            <div class="ltrim_sec">
                                <div class="group dynamiclabel  operator_newbill_wrapper">
                                    <input  class="input_blod  border_red disable alpha_num_space_hypen required" id="engine_type" type="text" placeholder="ENGINE TYPE" name="engine_type" autocomplete="off" maxlength="16" minlength="2" data-toggle="popover" data-placement="top">
                                    <label id=""> ENGINE TYPE</label>
                                </div>
                            </div>
                        </div>
                        <div class="group col-md-1 col-sm-1 col-xs-2 amountmode_newbill_wrapper style_radio yesNoRadio" id="weight_div">
                            <div class="radio radio-custom radio_mobile">
                                <input type="radio" name="weight" id="radio11" value="1" class="disable">
                                <label for="radio11" class="red_color radio_mobile_lbl">
                                    KGS
                                </label>
                            </div>
                            <div class="radio radio-custom radio_mobile minRD">
                                <input type="radio" name="weight" id="radio21" value="2" class="disable">
                                <label for="radio21" class="red_color radio_mobile_lbl">
                                    LBS
                                </label>
                            </div>
                        </div> 
                        <div class="col-md-1 col-sm-2 col-xs-6 colPadFix">
                            <div class="ltrim_sec">
                                <div class="group dynamiclabel  operator_newbill_wrapper">
                                    <input  class="input_blod  border_red disable numbers required" id="pax" type="text" placeholder="MAX PAX" name="pax" autocomplete="off" data-toggle="popover" data-placement="top" maxlength="2" minlength="1">
                                    <label id="">MAX PAX</label>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-1 col-sm-2 col-xs-6 colPadFix">
                            <div class="ltrim_sec">
                                <div class="group dynamiclabel operator_newbill_wrapper">
                                    <input  class="input_blod  border_red disable numbers required" id="max_fl" type="text" placeholder="MAX FL" name="max_fl" autocomplete="off" maxlength="3" minlength="3" data-toggle="popover" data-placement="top">
                                    <label id="">MAX FL</label>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-1 col-sm-2 col-xs-6 colPadFix">
                            <div class="ltrim_sec">
                                <div class="group dynamiclabel operator_newbill_wrapper">
                                    <input  class="input_blod  border_red disable numbers required" id="max_fuel" type="text" placeholder="MAX FUEL" name="max_fuel" autocomplete="off" minlength="4" maxlength="5" data-toggle="popover" data-placement="top">
                                    <label id="">MAX FUEL</label>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-1 col-sm-2 col-xs-6 colPadFix clsTaxi">
                            <div class="ltrim_sec">
                                <div class="group dynamiclabel operator_newbill_wrapper">
                                    <input  class="input_blod numbers border_red disable required" id="taxi_fuel" type="text" placeholder="TAXI FUEL" name="taxi_fuel" autocomplete="off" maxlength="3" data-toggle="popover" data-placement="top" minlength="2">
                                    <label id="">TAXI FUEL</label>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-2 col-sm-2 col-xs-6 colPadFix minClear maxWid115">
                            <div class="ltrim_sec">
                                <div class="group dynamiclabel  operator_newbill_wrapper">
                                    <input  class="input_blod border_red disable numbers required" id="tow" type="text" placeholder="MAX TAKE OFF WT" name="tow" autocomplete="off" minlength="4" maxlength="5" data-toggle="popover" data-placement="top">
                                    <label id="">MAX TAKE OFF WT</label>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-2 col-sm-2 col-xs-6 colPadFix maxWid115">
                            <div class="ltrim_sec">
                                <div class="group dynamiclabel  operator_newbill_wrapper">
                                    <input  class="input_blod border_red disable numbers required" id="lw" type="text" placeholder="MAX LANDING WT" name="lw" autocomplete="off"  minlength="4" maxlength="5" data-toggle="popover" data-placement="top">
                                    <label id="">MAX LANDING WT</label>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-2 col-sm-2 col-xs-6 colPadFix clsMaxZero">
                            <div class="ltrim_sec">
                                <div class="group dynamiclabel  operator_newbill_wrapper">
                                    <input  class="input_blod numbers border_red disable required" id="zfw" type="text" placeholder="MAX ZERO FUEL WT" name="zfw" autocomplete="off" minlength="4" maxlength="5" data-toggle="popover" data-placement="top">
                                    <label id="">MAX ZERO FUEL WT</label>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-2 col-sm-2 col-xs-6 colPadFix clsInclPilots">
                            <div class="ltrim_sec">
                                <div class="group dynamiclabel  operator_newbill_wrapper">
                                    <input  class="input_blod border_red disable numbers required" id="basic_wt" type="text" placeholder="BASIC WT" name="basic_wt" autocomplete="off" data-toggle="popover" data-placement="top" minlength="4" maxlength="5" >
                                    <label id="">BASIC WT</label>
                                    <div class="clsInpts">(Incl Pilots)</div>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-2 col-sm-2 col-xs-6 colPadFix clsEquipments">
                            <div class="ltrim_sec">
                                <div class="group dynamiclabel  operator_newbill_wrapper">
                                    <input  class="input_blod special_symbols border_red disable required" id="equipments" type="text" placeholder="EQUIPMENTS" name="equipments" autocomplete="off" data-toggle="popover" data-placement="top" maxlength="16" minlength="2">
                                    <label id="">EQUIPMENTS</label>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-1 col-sm-2 col-xs-3 colPadFix clsHolding">
                            <div class="ltrim_sec">
                                <div class="group dynamiclabel  operator_newbill_wrapper">
                                    <input  class="input_blod special_symbols border_red disable required" id="holding" type="text" placeholder="HOLDING" name="holding" autocomplete="off" maxlength="" data-toggle="popover" data-placement="top" disabled>
                                    <label id=""> HOLDING</label>
                                </div>
                            </div>
                        </div> 
                        <div class="group col-md-2 col-sm-3 col-xs-3 style_radio clsMins minsRadio" id="holding_div">
                            <div class="radio radio-custom radio_mobile">
                                <input type="radio" name="holding" id="radio132" value="1" class="disable">
                                <label for="radio132">
                                    30 Mins
                                </label>
                            </div>
                            <div class="radio radio-custom radio_mobile minRD">
                                <input type="radio" name="holding" id="radio133" value="2" class="disable">
                                <label for="radio133">
                                    45 Mins
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-6 colPadFix clsTransponder selContainer">
                            <div class="ltrim_sec">
                                <div class="group dynamiclabel  operator_newbill_wrapper">
                                    <dl id="mode" class="transmode form-control border_red required" data-toggle="popover" data-placement="top">
                                        <dt><a><span id="transponder_value">Transponder</span></a></dt>
                                          <dd>
                                            <ul style="display: none;">
                                                <li class="transponder"><a>A</a></li>
                                                <li class="transponder"><a>C</a></li>
                                                <li class="transponder"><a>E</a></li>
                                                <li class="transponder"><a>H</a></li>
                                                <li class="transponder"><a>L</a></li>
                                                <li class="transponder"><a>N</a></li>
                                                <li class="transponder"><a>S</a></li>
                                            </ul>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-2 col-sm-2 col-xs-6 colPadFix clsPbn">
                            <div class="ltrim_sec">
                                <div class="group dynamiclabel  operator_newbill_wrapper">
                                    <input  class="input_blod  disable special_symbols" id="pbn" type="text" placeholder="PBN" name="pbn" autocomplete="off" maxlength="20" minlength="2" data-toggle="popover" data-placement="top" disabled>
                                    <label id=""> PBN</label>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-2 col-sm-2 col-xs-6 colPadFix clsNavFld">
                            <div class="ltrim_sec">
                                <div class="group dynamiclabel  operator_newbill_wrapper">
                                    <input  class="input_blod disable alphabets_numbers_with_space" id="nav" type="text" placeholder="NAV" name="nav" autocomplete="off" minlength="1" data-toggle="popover" data-placement="top" maxlength="16">
                                    <label id=""> NAV</label>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-2 col-sm-2 col-xs-4 colPadFix clsCreditAAi">
                            <div class="ltrim_sec">
                                <div class="group dynamiclabel  operator_newbill_wrapper">
                                    <input class="input_blod special_symbols border_red disable required" id="credit_aai" type="text" placeholder="CREDIT WITH AAI" name="" autocomplete="off" maxlength="" data-toggle="popover" data-placement="top" data-original-title="" title="" disabled>
                                    <label id="">Credit with AAI</label>
                                </div>
                            </div>
                        </div>
                        <div class="group col-md-1 col-sm-2 col-xs-2 style_radio clsYesNo yesNoRadio" id="credit_aai_div">
                            <div class="radio radio-custom radio_mobile">
                                <input type="radio" name="credit_aai" id="radio12" value="1" class="disable">
                                <label for="radio12">
                                    YES
                                </label>
                            </div>
                            <div class="radio radio-custom radio_mobile minRD">
                                <input type="radio" name="credit_aai" id="radio22" value="2" class="disable">
                                <label for="radio22">
                                    NO
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-12 colPadFix minWid200 clsAirColMar">
                            <div class="ltrim_sec">
                                <div class="group dynamiclabel  operator_newbill_wrapper">
                                    <input  class="input_blod  border_red disable required" id="aircraftcolor" type="text" placeholder="AIRCRAFT COLOR MARKINGS" name="aircraftcolor" autocomplete="off" minlength="3" maxlength="35" data-toggle="popover" data-placement="top">
                                    <label id="">AIRCRAFT COLOR MARKINGS</label>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="row mt20 rowFix">
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="ltrim_sec">
                                <div class="form-group fileUploadBtn">
                                    <label for="" id="latestFplCopy_lbl">LATEST FPL COPY</label>
                                    <input  type="file" class="form-control-file custom-file-input" id="latestFplCopy" name="latestFplCopy">
                                    <span class="button">upload</span>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="ltrim_sec">
                                <div class="form-group fileUploadBtn">
                                    <label for="" id="latestLoadTrim_lbl">LATEST LOAD TRIM SHEET</label>
                                    <input type="file" class="form-control-file custom-file-input" id="latestLoadTrim" name="latestLoadTrim">
                                    <span>upload</span>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="ltrim_sec">
                                <div class="form-group fileUploadBtn">
                                    <label for="" id="previousNavLog_lbl">PREVIOUS COMPANY NAV LOG</label>
                                    <input type="file" class="form-control-file custom-file-input" id="previousNavLog" name="previousNavLog">
                                    <span>upload</span>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="ltrim_sec">
                                <div class="form-group fileUploadBtn">
                                    <label for="" id="companyFuelPolicy_lbl">COMPANY FUEL POLICY</label>
                                    <input type="file" class="form-control-file custom-file-input" id="companyFuelPolicy" name="companyFuelPolicy">
                                    <span>upload</span>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="row mt20 rowFix checkRowFont allCaps">
                        <div class="col-md-3 col-sm-3 col-xs-12" id="radio_div">
                            <div class="ltrim_sec">
                                <div class="checkBoxGroup emergencyRadio">
                                    <p class="red_color" id="emergency_radio_lbl">EMERGENCY RADIO</p>
                                    <div class="checkbox checkbox-custom ">
                                        <input id="checkbox1" type="checkbox" name="emergency_radio[]" value="Uhf">
                                        <label for="checkbox1">
                                            UHF
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-custom ">
                                        <input id="checkbox2" type="checkbox" name="emergency_radio[]" value="Vhf">
                                        <label for="checkbox2">
                                            VHF
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-custom ">
                                        <input id="checkbox3" type="checkbox" name="emergency_radio[]" value="Elba">
                                        <label for="checkbox3">
                                            ELBA
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-3 col-sm-3 col-xs-12" id="survial_equipment_div">
                            <div class="ltrim_sec">
                                <div class="checkBoxGroup">
                                    <p>SURVIVAL EQUIPMENT</p>
                                    <div class="checkbox checkbox-custom ">
                                        <input id="checkbox12" type="checkbox" name="survial_equipment[]" value="Polar">
                                        <label for="checkbox12">
                                        Polar
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-custom ">
                                        <input id="checkbox22" type="checkbox" name="survial_equipment[]" value="Desert">
                                        <label for="checkbox22">
                                        Desert
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-custom ">
                                        <input id="checkbox32" type="checkbox" name="survial_equipment[]" value="Maritime">
                                        <label for="checkbox32">
                                        Maritime
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-custom ">
                                        <input id="checkbox42" type="checkbox" name="survial_equipment[]" value="Jungle">
                                        <label for="checkbox42">
                                        Jungle
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-3 col-sm-3 col-xs-12 " id="jacket_div">
                            <div class="ltrim_sec">
                                <div class="checkBoxGroup">
                                    <p>JACKET</p>
                                    <div class="checkbox checkbox-custom">
                                        <input id="checkbox13" type="checkbox" name="jacket[]" value="Light">
                                        <label for="checkbox13">
                                        Light
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-custom">
                                        <input id="checkbox23" type="checkbox" name="jacket[]" value="Floures">
                                        <label for="checkbox23">
                                        Floures
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-custom">
                                        <input id="checkbox33" type="checkbox" name="jacket[]" value="UHF">
                                        <label for="checkbox33">
                                        UHF
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-custom">
                                        <input id="checkbox43" type="checkbox" name="jacket[]" value="VHF">
                                        <label for="checkbox43">
                                        VHF
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-3 col-sm-3 col-xs-12 clsDinghies">
                            <div class="ltrim_sec">
                                <div class="checkBoxGroup">
                                    <p>DINGHIES</p>
                                        <div class="col-md-6 col-sm-5 col-xs-6 colPadFix pt0">
                                            <div class="group dynamiclabel operator_newbill_wrapper">
                                                <input  class="checkRowFont input_blod numbers disable" id="dinghies_no" type="text" placeholder="No." name="dinghies_no" autocomplete="off" maxlength="2" minlength="2" data-toggle="popover" data-placement="top">
                                                <label id=""> No.</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-5 col-xs-6 colPadFix pt0 pr0">
                                            <div class="group dynamiclabel  operator_newbill_wrapper">
                                                <input  class="checkRowFont input_blod numbers disable" id="dinghies_capacity" type="text" placeholder="Capacity" name="dinghies_capacity" autocomplete="off" maxlength="2" minlength="2" data-toggle="popover" data-placement="top">
                                                <label id=""> Capacity</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-5 col-xs-6 colPadFix pt8 ">
                                            <div class="checkbox checkbox-custom ">
                                                <input id="checkbox51" type="checkbox" name="cover" value="1">
                                                <label for="checkbox51" id="cover_checkbox_lbl">
                                                Cover
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-5 col-xs-6 colPadFix selContainer pt8 pr0">
                                            <div class="ltrim_sec">
                                                <div class="group dynamiclabel  operator_newbill_wrapper">
                                                  <dl id="dinghies_color_dl" class="form-control fltypes" required="" data-toggle="popover" data-placement="top" data-original-title="">
                                                         <dt><a><span id="dinghies_color">Color</span></a></dt>
                                                        <dd>
                                                            <ul style="display: none;" class="clsDD">
                                                                <li class="flight_type"><a>RED</a></li>
                                                                <li class="flight_type"><a>ORANGE</a></li>
                                                            </ul>    
                                                        </dd>
                                                  </dl>
                                                </div>
                                            </div>
                                        </div> 
                                </div>
                            </div>
                        </div> 
                    </div>           
                <div class="row pdRt80px mt0">
                    <div class="col-md-3 col-sm-3 col-xs-12 colPadFix">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel operator_newbill_wrapper">
                                <input  class="input_blod  border_red disable alphabets_with_space required crew_dynamic" id="ops_manager" type="text" placeholder="OPS MANAGER NAME" name="ops_manager" autocomplete="off" maxlength="30" minlength="3" data-toggle="popover" data-placement="top">
                                <label id=""> OPS MANAGER NAME</label>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-2 col-sm-2 col-xs-6 colPadFix">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel  operator_newbill_wrapper">
                                <input  class="input_blod  border_red disable numbers required mobile_dynamic" id="mobile" type="text" placeholder="MOBILE NUMBER" name="ops_mobile" autocomplete="off"  data-toggle="popover" data-placement="top" maxlength="10">
                                <label id=""> MOBILE NUMBER</label>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-4 col-sm-4 col-xs-5 colPadFix">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel  operator_newbill_wrapper">
                                <input  class="input_blod  border_red disable email_range required email_dynamic" id="email" type="text" placeholder="EMAIL ID" name="ops_email_id" autocomplete="off" maxlength="30" data-toggle="popover" data-placement="top" style="text-transform: none">
                                <label id=""> EMAIL ID </label>
                            </div>
                        </div>
                    </div> 
                </div>        
                <div class="row pdRt80px mt0">
                    <div class="col-md-3 col-sm-3 col-xs-6 colPadFix">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel operator_newbill_wrapper">
                                <input  class="input_blod  border_red disable alphabets_with_space required crew_dynamic" id="crew1" type="text" placeholder="CREW or OPS STAFF NAME" name="crew[]" autocomplete="off" minlength="3" maxlength="30" data-toggle="popover" data-placement="top">
                                <label id=""> CREW or OPS STAFF NAME</label>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-2 col-sm-2 col-xs-6 colPadFix">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel  operator_newbill_wrapper">
                                <input  class="input_blod  border_red disable numbers required mobile_dynamic" id="mobile1" type="text" placeholder="MOBILE NUMBER" name="mobile[]" autocomplete="off" maxlength="10" data-toggle="popover" data-placement="top">
                                <label id=""> MOBILE NUMBER</label>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-4 col-sm-4 col-xs-6 colPadFix">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel  operator_newbill_wrapper">
                                <input class="input_blod  border_red disable email_range required email_dynamic" id="email1" type="text" placeholder="EMAIL ID" name="email[]" autocomplete="off" maxlength="30" data-toggle="popover" data-placement="top" style="text-transform: none">
                                <label id=""> EMAIL ID </label>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-2 col-sm-2 col-xs-5 colPadFix">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel selContainer operator_newbill_wrapper">
                               <dl id="designation_div1" class="speed form-control border required" required="" data-toggle="popover" data-placement="top" >
                                   <dt><a><span id="designation1">DESIGNATION</span></a></dt>
                                   <dd>
                                       <ul style="display: none;">
                                           <li class="weight_category"><a>PILOT</a></li>
                                           <li class="weight_category"><a>CO-PILOT</a></li>
                                           <li class="weight_category"><a>OPS STAFF</a></li>
                                       </ul>
                                   </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>        
                <div class="row pdRt80px mt0">
                    <div class="col-md-3 col-sm-3 col-xs-6 colPadFix">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel operator_newbill_wrapper">
                                <input  class="input_blod  border_red disable alphabets_with_space required crew_dynamic" id="crew2" type="text" placeholder="CREW or OPS STAFF NAME" name="crew[]" autocomplete="off" maxlength="30" minlength="3" data-toggle="popover" data-placement="top">
                                <label id=""> CREW or OPS STAFF NAME</label>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-2 col-sm-2 col-xs-6 colPadFix">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel  operator_newbill_wrapper">
                                <input  class="input_blod  border_red disable numbers required mobile_dynamic" id="mobile2" type="text" placeholder="MOBILE NUMBER" name="mobile[]" autocomplete="off" maxlength="10" data-toggle="popover" data-placement="top" >
                                <label id=""> MOBILE NUMBER</label>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-4 col-sm-4 col-xs-6 colPadFix">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel  operator_newbill_wrapper">
                                <input  class="input_blod  border_red disable email_range required email_dynamic" id="email2" type="text" placeholder="EMAIL ID" name="email[]" autocomplete="off" maxlength="30" data-toggle="popover" data-placement="top" style="text-transform: none">
                                <label id=""> EMAIL ID </label>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-2 col-sm-2 col-xs-5 colPadFix">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel selContainer operator_newbill_wrapper">
                               <dl id="designation_div2" class="wtcat form-control border required" required="" data-toggle="popover" data-placement="top"  aria-describedby="popover674111">
                                   <dt><a><span id="designation2">DESIGNATION</span></a></dt>
                                   <dd>
                                       <ul style="display: none;">
                                           <li class="weight_category"><a>PILOT</a></li>
                                           <li class="weight_category"><a>CO-PILOT</a></li>
                                           <li class="weight_category"><a>OPS STAFF</a></li>
                                       </ul>
                                   </dd>
                                </dl>
                    
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-1 colPadFix mt5">
                        <i class="fa fa-plus plus-icon ng-scope" id="plus-icon"></i>
                    </div>
                </div>
                <div id="dynamic"></div>
                <div class="row subBtnFixCont">
                    <div class="pull-right subBtnFix">
                        <button data-parent="" aria-expanded="true" aria-controls="collapse_reg2" class="btn newbtnv1" id="submit" type="submit" name="submit" disabled>SUBMIT</button>
                    </div>
                </div>
            </div>
          </form>
        </div>
    </div>
    @include('includes.new_footer',[])
    <div id="newaircraft_modal" class="modal fade" style="display:none;" >
        <div class="modal-dialog modal-container">
        <header class="popupHeader"> <span class="header_title">ALERT</span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>

        <section class="popupBody modal-body">

            <div class="user_login">
            <div class="row">
                <span class="fpl_loader"></span>
                <p style="width:98%;text-align: center;padding:15px;font-size:16px;" id="msg">
                
                </p>
            </div>
            </div>
        </section>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function () {

            $('#newaircraft_modal').on('show.bs.modal', function (e) {
                $('body').addClass('test');
            });
            $(document).on('click','.transmode dd ul li a',function(){
                    var text = $(this).html();
                    $("#pbn").focus();
                    $(".transmode dt a span").html("<b>"+text+"</b>");
                    $(".transmode dd ul").hide();
                     validation();
                });
            $(document).on('click','.fltypes dd ul li a',function(){
                    var text = $(this).html();
                    $("#ops_manager").focus();
                    var cover_length=$('input[name="cover"]:checked').length;
                    if(cover_length==0 && $("#dinghies_color").text()!='Color')
                      $("#cover_checkbox_lbl").addClass('red_color');

                    $(".fltypes dt a span").html("<b>"+text+"</b>");
                    $(".fltypes dd ul").hide();
                     validation();
                });
            $(document).on('click','.speed dd ul li a',function(){
                    var text = $(this).html();
                    $(".speed dt a span").html("<b>"+text+"</b>");
                    $(".speed dd ul").hide();
                     validation();
                     $("#crew2").focus();
               });
            $(document).on('click','.wtcat dt a',function(){
                   $(".endhrs dd ul").toggle();
               });
            $(document).on('click','.wtcat dd ul li a',function(){
                    var text = $(this).html();
                    $(".wtcat dt a span").html("<b>"+text+"</b>");
                    $(".wtcat dd ul").hide();
                     validation();
                     $("#crew3").focus();
              });
           $(document).bind('click', function(e) {
                   var $clicked = $(e.target);
                   if (! $clicked.parents().hasClass("dd"))
                     $(".dd dd ul").hide();
           });
           $("#callsign").keypress(function(e){
               var callsign=$(this).val();
               if(callsign.length==0 && e.charCode!=86 && e.charCode!=118)
                  return false;
               if(callsign.length==1 && e.charCode!=84 && e.charCode!=116)
                  return false; 
           });
       function errorPopover(id, message) {
           $(id).css({"border-color": "red"});
           $(id).attr('data-content', message);   
           $(id).popover( {trigger : 'hover'}); 
       }
       function closePopover(id) {
           $(id).popover('destroy');
           $(id).removeClass('border_red');
           $(id).removeClass('border').addClass('border_gray');
           $(id).css({"border-color": "#a6a6a6"});
           $(this).next().css('display','none');
       }
       $(document).on("keypress",".special_symbols",function(e){
                    if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 48 && e.charCode <= 57) ||(e.charCode==0))
                    return true;
                    else
                    return false; 
             });
       $(document).on("keypress",".email_range",function(e){
                    if ((e.charCode >= 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode==46)|| (e.charCode >= 48 && e.charCode <= 57) ||(e.charCode==0))
                    return true;
                    else
                    return false; 
             });
       $(document).on("keypress",".numbers",function(e){   
               if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 32 && e.charCode <= 47) || (e.charCode >= 58 && e.charCode <= 64) || (e.charCode >= 91 && e.charCode <= 96)|| (e.charCode >= 123 && e.charCode <= 127))
                 return false;
                   else
                 return true;    
            });
        $(document).on("keypress",".alphabets_numbers_with_space",function(e){
                 if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 48 && e.charCode <= 57) ||(e.charCode==0)||(e.charCode==32))
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
        $(document).on("keypress",".alpha_num_space",function(e){
                 if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 48 && e.charCode <= 57) || (e.charCode==32) ||(e.charCode==0))
                    return true;
                    else
                    return false; 
          });
        $(document).on("keypress",".alpha_num_space_hypen",function(e){
                 if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 48 && e.charCode <= 57) || (e.charCode==32) ||(e.charCode==0) ||(e.charCode==45) ||(e.charCode==32))
                    return true;
                    else
                    return false; 
         });
          is_duplicate_callsign=false;
          $("#callsign").keyup(function(){
          var callsign=$("#callsign").val();
          if(callsign.length>=5){
               closePopover('#callsign');
               $.ajax({
                       url: '/newaircraft_callsign_check',
                       data: {'callsign':$("#callsign").val()},
                       async: false,
                       success: function(data)
                       {  
                           if(data.callsign_count>0){
                               is_duplicate_callsign=true;
                               errorPopover('#callsign','AIRCRAFT DETAILS FOR THIS CALL SIGN ALREADY EXISTS IN OUR RECORD');
                           }
                           else{
                               is_duplicate_callsign=false;
                               closePopover('#callsign');
                           }
                       }
                 }); 

               $("#operator").focus();
          }
        });    
        $("#callsign").blur(function(){
             var callsign=$("#callsign").val();
             if(callsign.length>=5 )
               closePopover('#callsign');  
             else
                errorPopover('#callsign','MIN. 5 & MAX. 5 CHARACTERS, ONLY ALPHABETS & NUMBERS ALLOWED');
             
             if(is_duplicate_callsign==true)
                errorPopover('#callsign','AIRCRAFT DETAILS FOR THIS CALL SIGN ALREADY EXISTS IN OUR RECORD');
        });
        $("#operator").keyup(function(){
         var operator=$("#operator").val();
         if(operator.length>=7)
           closePopover('#operator');

          if(operator.length==30)
            $("#aircrafttype").focus();
            
        });    
        $("#operator").blur(function(){
            var operator=$("#operator").val();
             if(operator.length>=7)
               closePopover('#operator');
             else
               errorPopover('#operator','MIN. 7 & MAX. 30 CHARACTERS, ONLY ALPHABETS & NUMBERS ALLOWED');
        });   
        $("#aircrafttype").blur(function(){
            var aircraft_type=$("#aircrafttype").val();
            if(aircraft_type.length>3)
              closePopover('#aircrafttype');
            else
              errorPopover('#aircrafttype','SELECT AIRCRAFT TYPE');
        });
        $("#engine_type").keyup(function(){
         var engine_type=$("#engine_type").val();
         if(engine_type.length>=2)
           closePopover('#engine_type');
        });   
        $("#engine_type").blur(function(){
            var engine_type=$("#engine_type").val();
            if(engine_type.length>=2)
              closePopover('#engine_type');
            else
              errorPopover('#engine_type','MIN. 2 & MAX. 15 CHARACTERS, ONLY ALPHABETS,NUMBERS, SPACE & HYPEN ALLOWED');
        });
        $("#pax").keyup(function(){
          var pax=$("#pax").val();
          if(pax.length>=1)
            closePopover('#pax');
          
          if(pax.length==2){
            $("#max_fl").focus();
           }
        });    
        $("#pax").blur(function(){
            var pax=$("#pax").val();
            if(pax.length>=1)
              closePopover('#pax');
            else
              errorPopover('#pax','MIN. 1 & MAX. 50 PAX ALLOWED');
        });
        $("#max_fl").keyup(function(){
           var max_fl=$("#max_fl").val();
           if(max_fl.length>=3)
             closePopover("#max_fl");

           if(max_fl.length==3)
             $("#max_fuel").focus();
        });    
        $("#max_fl").blur(function(){
           var max_fl=$("#max_fl").val();
           if(max_fl.length>=3)
             closePopover("#max_fl");
           else
             errorPopover('#max_fl','MIN. 3 & MAX. 3 DIGITS ALLOWED');
        });
        $("#max_fuel").keyup(function(){
           var max_fuel=$("#max_fuel").val(); 
           if(max_fuel.length>=4)
             closePopover("#max_fuel");  

            if(max_fuel.length==5)
              $("#taxi_fuel").focus();
        });    
        $("#max_fuel").blur(function(){
           var max_fuel=$("#max_fuel").val(); 
           if(max_fuel.length>=4)
             closePopover("#max_fuel");            
           else
             errorPopover('#max_fuel','MIN. 4 & MAX. 5 DIGITS ALLOWED');  
        });
        $("#taxi_fuel").keyup(function(){
          var taxi_fuel=$("#taxi_fuel").val();
          if(taxi_fuel.length>=2)
            closePopover("#taxi_fuel");  

           if(taxi_fuel.length==3)
             $("#tow").focus();
        });    
        $("#taxi_fuel").blur(function(){
            var taxi_fuel=$("#taxi_fuel").val();
            if(taxi_fuel.length>=2)
              closePopover("#taxi_fuel");          
            else
              errorPopover('#taxi_fuel','MIN. 2 & MAX. 3 DIGITS ALLOWED');
        });
        $("#tow").keyup(function(){
           var tow=$("#tow").val();
           if(tow.length>=4)
             closePopover("#tow"); 

           if(tow.length==5)
             $("#lw").focus();
        });    
        $("#tow").blur(function(){
           var tow=$("#tow").val();
           var lw=$("#lw").val();
           if(tow.length>=4)
             closePopover("#tow");          
           else
             errorPopover('#tow','MIN. 4 & MAX. 5 DIGITS ALLOWED');

           if(lw.length>=4 && tow.length>=4 && parseInt(lw)>parseInt(tow))
             errorPopover('#lw',"LANDING WT CAN'T BE MORE THAN TOW");
           else if(lw.length>=4 && tow.length>=4 && parseInt(lw)<parseInt(tow))
             closePopover("#lw");

        });
        $("#lw").keyup(function(){
          var lw=$("#lw").val();
          if(lw.length>=4)
            closePopover("#lw");

           if(lw.length==5)
             $("#zfw").focus();
        });    
        $("#lw").blur(function(){
           var lw=$("#lw").val();
           var tow=$("#tow").val();
           if(lw.length>=4)
             closePopover("#lw");
           else
             errorPopover('#lw','MAX. 4 & MAX. 5 DIGITS ALLOWED');
          
          if(lw.length>=4 && tow.length>=4 && parseInt(lw)>parseInt(tow))
             errorPopover('#lw',"LANDING WT CAN'T BE MORE THAN TOW");
          else if(lw.length>=4 && tow.length>=4 && parseInt(lw)<parseInt(tow))
             closePopover("#lw");
        });
        $("#zfw").keyup(function(){
           var zfw=$("#zfw").val();
           if(zfw.length>=4)
             closePopover('#zfw');  


            if(zfw.length==5)
              $("#basic_wt").focus();
        });    
        $("#zfw").blur(function(){
          var basic_wt=$("#basic_wt").val();  
          var zfw=$("#zfw").val();
          if(zfw.length>=4)
            closePopover('#zfw');  
          else
            errorPopover('#zfw','MIN. 4 & MAX. 5 DIGITS ALLOWED');

          if(basic_wt.length>=4 && zfw.length>=4 && parseInt(basic_wt)>parseInt(zfw))
            errorPopover('#basic_wt',"BASIC WT CAN'T BE MORE THAN ZERO FUEL WEIGHT");
          else if(basic_wt.length>=4 && zfw.length>=4 && parseInt(basic_wt)<parseInt(zfw))
            closePopover("#basic_wt");
        });
        $("#basic_wt").keyup(function(){
           var basic_wt=$("#basic_wt").val();
           if(basic_wt.length>=4)
               closePopover('#basic_wt');

           if(basic_wt.length==5)
             $("#equipments").focus();
        });    
        $("#basic_wt").blur(function(){
           var basic_wt=$("#basic_wt").val();
           var zfw=$("#zfw").val();
           if(basic_wt.length>=4)
               closePopover('#basic_wt');
           else
              errorPopover('#basic_wt','Min. 4 & Max. 5 Digits allowed');
           if(basic_wt.length>=4 && zfw.length>=4 && parseInt(basic_wt)>parseInt(zfw))
             errorPopover('#basic_wt',"BASIC WT CAN'T BE MORE THAN ZERO FUEL WEIGHT");
           else if(basic_wt.length>=4 && zfw.length>=4 && parseInt(basic_wt)<parseInt(zfw))
             closePopover("#basic_wt");
        });
        $("#equipments").keyup(function(){
          var equipments=$("#equipments").val();
          if(equipments.length>=2)
              closePopover('#equipments');

          var smallr = equipments.search("r");
          var smallR = equipments.search("R");
          if(smallr!=-1 || smallR!=-1)
            $('#pbn').removeAttr("disabled").addClass('border_red');
          else{  
             $('#pbn').prop("disabled",true).removeClass('border_red').val('');
             $("#pbn").css('border-color','#777'); 
             closePopover("#pbn");
            }  
        });    
        $("#equipments").blur(function(){
          var equipments=$("#equipments").val();
          if(equipments.length>=2)
              closePopover('#equipments');
          else
              errorPopover('#equipments','MIN. 1 & MAX. 32 CHARACTERS, ONLY ALPHABETS & NUMBERS ALLOWED');
        });
        $("#pbn").keyup(function(){
           var pbn=$("#pbn").val();
           if(pbn.length>=2)
              closePopover('#pbn'); 

           if(pbn.length==20)
             $("#nav").focus();
        });    
        $("#pbn").blur(function(){
           var pbn=$("#pbn").val();
           if(pbn.length>=2)
             closePopover('#pbn');  
           else
             errorPopover('#pbn','MIN. 2 & MAX. 20 CHARACTERS, ONLY ALPHABETS & NUMBERS ALLOWED');
        });
        $("#aircraftcolor").keyup(function(){
           var aircraft_color=$("#aircraftcolor").val();
           if(aircraft_color.length>=3)
               closePopover("#aircraftcolor");   
        });    
        $("#aircraftcolor").blur(function(){
           var aircraft_color=$("#aircraftcolor").val();
           if(aircraft_color.length>=3)
               closePopover("#aircraftcolor");   
           else
               errorPopover('#aircraftcolor','MIN. 3 & MAX. 35 CHARACTERS ALLOWED');  
        });
        mobile_dynamic_array = ['mobile','mobile1','mobile2'];
        email_dynamic_array =  ['email','email1','email2'];
        crew_dynamic_array =   ['ops_manager','crew1','crew2'];
        $("#dinghies_no").keyup(function(){
              var dinghies_no=$("#dinghies_no").val();
              if((dinghies_no!="" && dinghies_no.length>=2)||(dinghies_no=="")){
                   $("#dinghies_capacity").focus();   
                   closePopover("#dinghies_no");
              }
              if(dinghies_no==""){
                closePopover("#dinghies_no");
                closePopover("#dinghies_capacity");
              }
        });    
        $("#dinghies_no").blur(function(){
             var dinghies_no=$("#dinghies_no").val();
             if((dinghies_no!="" && dinghies_no.length>=2)||(dinghies_no==""))
                 closePopover("#dinghies_no");
             else if(dinghies_no!="" && dinghies_no.length<=2)
                 errorPopover('#dinghies_no','NUMBER SHOULD CONTAINS 2 DIGITS');
        });
        $("#dinghies_capacity").keyup(function(){
           var dinghies_no=$("#dinghies_no").val(); 
           var dinghies_capacity=$("#dinghies_capacity").val();
           if((dinghies_capacity!="" && dinghies_capacity.length>=2)||(dinghies_capacity=="" && dinghies_no=="")){
               closePopover("#dinghies_capacity");   
           }
           if(dinghies_capacity=="" && dinghies_no==""){
             closePopover("#dinghies_no");
             closePopover("#dinghies_capacity");
           }
        });    
        $("#dinghies_capacity").blur(function(){
            var dinghies_capacity=$("#dinghies_capacity").val();
            var dinghies_no=$("#dinghies_no").val();
            if((dinghies_capacity!="" && dinghies_capacity.length>=2)||(dinghies_capacity=="" && dinghies_no=="")){
                closePopover("#dinghies_capacity");   
            }
            else if(dinghies_capacity!="" && dinghies_capacity.length<2)
                errorPopover('#dinghies_capacity','CAPACITY SHOULD CONTAINS 2 DIGITS');
        });
        is_name_duplicate=false;
        var name_dup=[];
        $(document).on('keyup','.crew_dynamic',function(){
           // name_dup=[];
          var crew_id=$(this).attr('id');
          var ops_manager=$("#"+crew_id).val();
          if(ops_manager.length>=3)
             closePopover("#"+crew_id); 
          

          var next_id=crew_id.substr(4,1);
          if($(this).val().length==30)
            $("#mobile"+next_id).focus();

            for(var i=0;i<crew_dynamic_array.length;i++){
               var crw_dup=false;
               var crw=$("#"+crew_dynamic_array[i]).val();

               if(crw.length>=3){
                   for(var j=0;j<crew_dynamic_array.length;j++){
                       if(j==i)
                           continue;
                       var next_crw=$("#"+crew_dynamic_array[j]).val();
                       if(next_crw.length>=3){
                           if(crw==next_crw){
                               crw_dup=true;
                               break;
                           }
                       }
                   }
                   if(crw_dup==false){
                       closePopover("#"+crew_dynamic_array[i]);
                   }
               }
            } 
               name_dup=[];
            var crew_id=$(this).attr('id');  
            var ops_manager=$("#"+crew_id).val();
            if(ops_manager.length<3)
                errorPopover('#'+crew_id,'MIN. 3 & MAX. 30 CHRACTERS, ONLY ALPHABETS & NUMBERS ALLOWED');
            else
                 closePopover("#"+crew_id);
             $.each(crew_dynamic_array,function(key,val){
                var crw_id=val;
                if($("#"+crw_id).val().length>=3){
                    name_dup.push($("#"+crw_id).val().toUpperCase());
                 }
                 if((crw_id!=crew_id)&&(ops_manager==$("#"+crw_id).val())&&(ops_manager.length>=3) &&($("#"+crw_id).val().length>=3)){
                     errorPopover("#"+crew_id,"NAME CAN'T BE DUPLICATE");
                   }
              });
              is_name_duplicate = countDuplicates(name_dup);
              validation(); 
        });    
     /*   $(document).on('blur','.crew_dynamic',function(){
             name_dup=[];
          var crew_id=$(this).attr('id');  
          var ops_manager=$("#"+crew_id).val();
          if(ops_manager.length>=3)
             closePopover("#"+crew_id);
          else
            errorPopover('#'+crew_id,'MIN. 3 & MAX. 30 CHRACTERS, ONLY ALPHABETS & NUMBERS ALLOWED');

           $.each(crew_dynamic_array,function(key,val){
              var crw_id=val;
              if($("#"+crw_id).val().length>=3){
                  name_dup.push($("#"+crw_id).val().toUpperCase());
               }
               if((crw_id!=crew_id)&&(ops_manager==$("#"+crw_id).val())&&(ops_manager.length>=3) &&($("#"+crw_id).val().length>=3)){
                   errorPopover("#"+crew_id,"NAME CAN'T BE DUPLICATE");
                 }
            });
            is_name_duplicate = countDuplicates(name_dup);
            validation();  
        });*/
       $(document).on('keyup','.mobile_dynamic',function(){
         var mobile_id=$(this).attr('id');
         var mobile=$("#"+mobile_id).val();
         if(mobile.length==10)
           closePopover("#"+mobile_id); 

         var next_id=mobile_id.substr(6,1);
         if($(this).val().length==10)
           $("#email"+next_id).focus();

        });
       is_mobile_duplicate=false;
       var mobile_dup=[]; 
        $(document).on('blur','.mobile_dynamic',function(){
            mobile_dup=[];
            var mobile_id=$(this).attr('id');
            var mobile=$("#"+mobile_id).val();
            if(mobile.length==10)
              closePopover("#"+mobile_id);
            else
              errorPopover('#'+mobile_id,'MIN. & MAX. 10 DIGITS ALLOWED');  

            $.each(mobile_dynamic_array,function(key,val){
                var mob_id=val;
                if($("#"+mob_id).val().length==10){
                    mobile_dup.push($("#"+mob_id).val());
                 }
                 
                if((mob_id!=mobile_id)&&(mobile==$("#"+mob_id).val())&&(mobile.length==10) &&($("#"+mob_id).val().length==10)){
                    errorPopover("#"+mobile_id,"MOBILE NUMBER CAN'T BE DUPLICATE");
                }
             });
            is_mobile_duplicate = countDuplicates(mobile_dup);
            validation();
            for(var i=0;i<mobile_dynamic_array.length;i++){
                var m_dup=false;
                var mob=$("#"+mobile_dynamic_array[i]).val();
                if(mob.length==10){
                    for(var j=0;j<mobile_dynamic_array.length;j++){
                        if(j==i)
                            continue;
                        var next_mob=$("#"+mobile_dynamic_array[j]).val();
                        if(next_mob.length==10){
                            if(mob==next_mob){
                                m_dup=true;
                                break;
                            }
                        }
                    }
                    if(m_dup==false){
                        closePopover("#"+mobile_dynamic_array[i]);
                    }
                }
             }
        });
        is_email_duplicate=false;
        var email_dup=[];    
        $(document).on('keyup','.email_dynamic',function(){   
          //email_dup=[]; 
            var email_id=$(this).attr('id');
            var email=$("#"+email_id).val();
             if (validateEmail(email))
                closePopover("#"+email_id);
               
              for(var i=0;i<email_dynamic_array.length;i++){
                 var e_dup=false;
                 var emai=$("#"+email_dynamic_array[i]).val();

                 if(validateEmail(emai)){
                     for(var j=0;j<email_dynamic_array.length;j++){
                         if(j==i)
                             continue;
                         var next_email=$("#"+email_dynamic_array[j]).val();
                         if(validateEmail(next_email)){
                             if(emai==next_email){
                                 e_dup=true;
                                 break;
                             }
                         }
                     }
                     if(e_dup==false){
                         closePopover("#"+email_dynamic_array[i]);
                     }
                 }
              }
              email_dup=[]; 
              var email_id=$(this).attr('id');
              var email=$("#"+email_id).val();
              if(email!=""){
                 if (validateEmail(email))
                    closePopover("#"+email_id);
                  else
                     errorPopover('#'+email_id,'INVALID EMAIL');
              }
              else
                  errorPopover('#'+email_id,'EMAIL IS REQUIRED');

              $.each(email_dynamic_array,function(key,val){
                 var e_id=val;
                 if($("#"+e_id).val()!="" && validateEmail(email)){
                     email_dup.push($("#"+e_id).val());
                  }
                 if((e_id!=email_id)&&(email==$("#"+e_id).val())&&(validateEmail(email)) &&($("#"+e_id).val())){
                   errorPopover("#"+email_id,"EMAIL CAN'T BE DUPLICATE");
                 }
              });
              is_email_duplicate = countDuplicates(email_dup);
              validation(); 

        });
       /* $(document).on('blur','.email_dynamic',function(){
           email_dup=[]; 
           var email_id=$(this).attr('id');
           var email=$("#"+email_id).val();
           if(email!=""){
              if (validateEmail(email))
                 closePopover("#"+email_id);
               else
                  errorPopover('#'+email_id,'INVALID EMAIL');
           }
           else
               errorPopover('#'+email_id,'EMAIL IS REQUIRED');

           $.each(email_dynamic_array,function(key,val){
              var e_id=val;
              if($("#"+e_id).val()!="" && validateEmail(email)){
                  email_dup.push($("#"+e_id).val());
               }
              if((e_id!=email_id)&&(email==$("#"+e_id).val())&&(validateEmail(email)) &&($("#"+e_id).val())){
                errorPopover("#"+email_id,"EMAIL CAN'T BE DUPLICATE");
              }
           });
           is_email_duplicate = countDuplicates(email_dup);
           validation();
        });*/
        function countDuplicates(original) {
          let counts = {},
            duplicate = 0;
          original.forEach(function(x) {
            counts[x] = (counts[x] || 0) + 1;
          });

          for (var key in counts) {
            if (counts.hasOwnProperty(key)) {
              counts[key] > 1 ? duplicate++ : duplicate;
            }
          }
          if(duplicate==0)
            return false;
          else
            return true;  
        }
        $('INPUT[type="file"]').change(function () {
            var ext = this.value.match(/\.(.+)$/)[1];
            var file = this.files[0];
            var size = file.size;
            var name = file.name;
            var id=$(this).attr('id');
            if(ext!='xlsx' && ext!='pdf' && ext!='jpg' && ext!='jpeg' && ext!='png' && ext!='gif' && ext!='docx'){
                alert('THIS IS NOT AN ALLOWED FILE TYPE.');
                    this.value = '';
            }
            else if(size>2000000){
                 alert('MAX ALLOWED FILE SIZE IS 2MB');
                    this.value = '';
            }
            else
                 $("#"+id+"_lbl").html("<b>"+name+"</b>");
        });
        $("#pax").keypress(function(e){
            var pax_value=$(this).val();
            var pax_length=$(this).val().length;
            var current_value=e.which;
            if(pax_length==0 && current_value>53)
                return false;
            if((pax_length==1 && pax_value==0 && current_value==48)|| (pax_length==1 && pax_value==5 && current_value>48))
                return false;
        });
        $("#max_fl").keypress(function(e){
            var max_fl_value=$(this).val();
            var max_fl_length=$(this).val().length;
            var current_value=e.which;
            
            if((max_fl_length==0  && current_value>=54))
                return false; 
            if((max_fl_length==1 && max_fl_value==0 && current_value==48)||(max_fl_length==1 && max_fl_value==5 && current_value>=50)){
                return false;
            }
            if((max_fl_length==2 && max_fl_value==00 && current_value==48)|| (max_fl_length==2 && max_fl_value==51 && current_value>48))
                return false;
        });
        $("#max_fuel").keypress(function(e){
            var max_fuel_value=$(this).val();
            var max_fuel_length=$(this).val().length;
            var current_value=e.which;
             if((max_fuel_length==0  && current_value>=53))
                return false;
             if(max_fuel_length==1 && max_fuel_value==0 && current_value==48){
                return false;
            }    
             if((max_fuel_length==4 && max_fuel_value==0000 && current_value==48))
                return false;
        });    
        $("#taxi_fuel").keypress(function(e){
            var taxi_fuel_value=$(this).val();
            var taxi_fuel_length=$(this).val().length;
            var current_value=e.which;
            
            if((taxi_fuel_length==0  && current_value>=54))
                return false; 
            if((taxi_fuel_length==1 && taxi_fuel_value==0 && current_value==48)||(taxi_fuel_length==1 && taxi_fuel_value==5 && current_value>=50))
                return false;
            if((taxi_fuel_length==2 && taxi_fuel_value==00 && current_value==48)|| (taxi_fuel_length==2 && taxi_fuel_value==51 && current_value>48))
                return false;
        });
        $("#tow,#lw,#zfw,#basic_wt").keypress(function(e){
           var value=$(this).val();
           var length=$(this).val().length;
           var current_value=e.which;
            if(length==1 && value==0 && current_value==48){
               return false;
           }
        });
        var row_count=2;
        $(document).on('click','.fa-minus',function(){
           var dynamic_id="dynamic"+$(this).attr('data-count');
           $("#"+dynamic_id).remove();
        });    
        $("#plus-icon").on('click',function(){
            if($(".dynamic_row").length>7)
                return false;
           
            $('#submit').prop("disabled",true); 
            row_count++;
            var html=`<div class="row pdRt80px selContainer mt0 dynamic_row" id="dynamic${row_count}" data-count="${row_count}">
                    <div class="col-md-3 col-sm-3 col-xs-6 colPadFix">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel operator_newbill_wrapper">
                                <input class="input_blod alphabets_with_space border_red disable required crew_dynamic" id="crew${row_count}" type="text" placeholder="CREW or OPS STAFF NAME" name="crew[]" autocomplete="off" maxlength="30" minlength="3" data-toggle="popover" data-placement="top" data-original-title="" title="">
                                <label id="">CREW or OPS STAFF NAME</label>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-2 col-sm-2 col-xs-6 colPadFix">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel  operator_newbill_wrapper">
                                <input class="input_blod border_red disable numbers required mobile_dynamic" id="mobile${row_count}" type="text" placeholder="MOBILE NUMBER" name="mobile[]" autocomplete="off" maxlength="10" data-toggle="popover" data-placement="top" data-original-title="" title="">
                                <label id=""> MOBILE NUMBER</label>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-4 col-sm-4 col-xs-6 colPadFix">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel  operator_newbill_wrapper">
                                <input  class="input_blod  border_red disable email_range required email_dynamic" id="email${row_count}" type="text" placeholder="EMAIL ID" name="email[]" autocomplete="off" maxlength="30" data-toggle="popover" data-placement="top" style="text-transform: none">
                                <label id=""> EMAIL ID </label>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-2 col-sm-2 col-xs-5 colPadFix">
                        <div class="ltrim_sec">
                            <div class="group dynamiclabel selContainer  operator_newbill_wrapper">
                               <dl id="designation_div${row_count}" class="dd${row_count} designation2 form-control validation_class_click border required1 flight_no"  data-toggle="popover" data-placement="top">
                                   <dt><a><span id="designation${row_count}">DESIGNATION</span></a></dt>
                                   <dd>
                                       <ul style="display: none;">
                                           <li class="weight_category"><a>PILOT</a></li>
                                           <li class="weight_category"><a>CO-PILOT</a></li>
                                           <li class="weight_category"><a>OPS STAFF</a></li>
                                       </ul>
                                   </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                  <div class="col-md-1 col-sm-1 col-xs-1 colPadFix mt5">
                      <i class="fa fa-minus plus-icon ng-scope " id="minus-icon" data-count="${row_count}"></i> 
                  </div>
                </div>
                `;
              $("#dynamic").append(html);
              var class_name= 'dd'+row_count; 
              $(document).on('click','.'+class_name+'  dt a',function(){
                     $(".flight_no dd ul").hide();
                     $("."+class_name+" dd ul").toggle();
                  });
              $(document).on('click','.'+class_name+' dd ul li a',function(){
                      var text = $(this).html();
                      $("."+class_name+" dt a span").html("<b>"+text+"</b>");
                      $("."+class_name+" dd ul").hide();
                       validation();
                       var next_id=parseInt(class_name.substr(2,1))+1;
                       $("#crew"+next_id).focus();
             });

             $(document).bind('click', function(e) {
                 var $clicked = $(e.target);
                 if (!$clicked.parents().hasClass("flight_no")) $(".flight_no dd ul").hide();
             }); 
            mobile_dynamic_array.push(`mobile${row_count}`);
            email_dynamic_array.push(`email${row_count}`);
            crew_dynamic_array.push(`crew${row_count}`);
        });
        $(document).on('keyup',"input",function(){
             validation();
        })
        function validation(){
          var callsign=$("#callsign").val();
          var is_callsign=false;
          if(callsign.length>=5){
            is_callsign=true;
          }  
          else{
            is_callsign=false;
          }
          var operator=$("#operator").val();
          var is_operator=false;
          if(operator.length>=7){
            is_operator=true;
          }
          else{
            is_operator=false;
           }
          var aircraft_type=$("#aircrafttype").val();
          var is_aircraft_type=false;
          if(aircraft_type.length>3){
            is_aircraft_type=true;
           } 
          else{
            is_aircraft_type=false;
           }
          var engine_type=$("#engine_type").val();
          var is_engine_type=false;
          if(engine_type.length>=2){
            is_engine_type=true;
          }
          else{
            is_engine_type=false;
           }

          var weight=$("input[type='radio'][name='weight']:checked").val();
          var is_weight=false;
          if(weight!=undefined){
           is_weight=true;
           $("#weight_div").removeClass('border').addClass('border_gray');
          }
          else
            is_weight=false;

          var pax=$("#pax").val();
          var is_pax=false;
          if(pax.length>=1){
            is_pax=true;
          }  
          else{
            is_pax=false;
          }
          var max_fl=$("#max_fl").val();
          var is_max_fl=false;
          if(max_fl.length>=3){
            is_max_fl=true;
          }  
          else{
            is_max_fl=false;
          }          
          var max_fuel=$("#max_fuel").val();
          var is_max_fuel=false;
          if(max_fuel.length>=4){
            is_max_fuel=true;           
          }
          else{
            is_max_fuel=false;
          }  
          var taxi_fuel=$("#taxi_fuel").val();
          var is_taxi_fuel=false;
          if(taxi_fuel.length>=2){
            is_taxi_fuel=true;        
           } 
          else{
            is_taxi_fuel=false;
          } 
          var tow=$("#tow").val();
          var is_tow=false;
          if(tow.length>=4){
            is_tow=true;     
          }  
          else{
            is_tow=false;
          }
          var lw=$("#lw").val();
          var is_lw=false;
          if(lw.length>=4){
            is_lw=true;
          }  
          else{
            is_lw=false;
          }
          if(lw.length>=4 && tow.length>=4 && parseInt(lw)>parseInt(tow))
            is_lw=false;

          var zfw=$("#zfw").val();
          var is_zfw=false;
          if(zfw.length>=4){
            is_zfw=true;
          }  
          else{
            is_zfw=false;
          }
          var basic_wt=$("#basic_wt").val();
          var is_basic_wt=false;
          if(basic_wt.length>=4){
              is_basic_wt=true;
           }
          else{
            is_basic_wt=false;
           }
          if(basic_wt.length>=4 && zfw.length>=4 && parseInt(basic_wt)>parseInt(zfw))
             is_basic_wt=false;

          var equipments=$("#equipments").val();
          var is_equipments=false;
          if(equipments.length>=2){
              is_equipments=true;
           } 
          else{
              is_equipments=false;
          } 
          var holding=$("input[type='radio'][name='holding']:checked").val();
          var is_holding=false;
          if(holding!=undefined){
            is_holding=true;
            closePopover('#holding');

          }
          else{
            is_holding=false;
           }  
          var transponder=$("#transponder_value").text();
          var is_transponder=false;
          if(transponder!="Transponder"){
            is_transponder=true;
            closePopover('#mode');
           }
          else
            is_transponder=false;

          var pbn=$("#pbn").val();
          var is_pbn=true;
          if($('#pbn').prop('disabled')==false){
              if(pbn.length>=2){
                is_pbn=true;
              }  
              else{
                is_pbn=false;
              }
          }
          var credit_aai=$("input[type='radio'][name='credit_aai']:checked").val();
          var is_credit_aai=false;
          if(credit_aai!=undefined){
           is_credit_aai=true;
           closePopover('#credit_aai');
          }
          else
            is_credit_aai=false;

          var aircraft_color=$("#aircraftcolor").val();
          var is_aircraft_color=false;
          if(aircraft_color.length>=3){
              is_aircraft_color=true;
          }    
          else{
              is_aircraft_color=false;
           } 
         var emergency_radio= $('input[name="emergency_radio[]"]:checked').length;
         var is_emergency_radio=false; 
         if(emergency_radio>0){
           is_emergency_radio=true;
           $("#radio_div").removeClass('border').addClass('border_gray');
           $("#emergency_radio_lbl").removeClass('red_color');
         }
         else{
           is_emergency_radio=false;
           $("#emergency_radio_lbl").addClass('red_color');
          }  
         var dinghies_no=$("#dinghies_no").val();
         var is_dinghies_no=true;
         if((dinghies_no!="" && dinghies_no.length>=2)||(dinghies_no=="")){
             is_dinghies_no=true;
         }    
         else if(dinghies_no!="" && dinghies_no.length<=2){
             is_dinghies_no=false;
          }
        var dinghies_capacity=$("#dinghies_capacity").val();
        var is_dinghies_capacity=true;
        if((dinghies_capacity!="" && dinghies_capacity.length>=2)||(dinghies_capacity=="")){
            is_dinghies_capacity=true;
        }    
        else if(dinghies_capacity!="" && dinghies_capacity.length<2){
            is_dinghies_capacity=false;
         }
         var dinghies_color=$("#dinghies_color").text();
         var is_dinghies_color=true;
         if(dinghies_color!='Color' && dinghies_color!='COLOR'){
             is_dinghies_color=true;
            $("#dinghies_color_dl").removeClass('border_red');
         }    
         // else if(dinghies_color=="Color"){
         //     is_dinghies_color=false;
         //     errorPopover('#dinghies_color','Select color');
         //  }  
        if(dinghies_no.length==2 && dinghies_capacity==''){
            is_dinghies_capacity=false;
            errorPopover('#dinghies_capacity','CAPACITY SHOULD CONTAINS 2 DIGITS');
        }
        if(dinghies_capacity.length==2 && dinghies_no==''){
            is_dinghies_no=false;
            errorPopover('#dinghies_no','NUMBER SHOULD CONTAINS 2 DIGITS');
        }

        var dinghies_cover=$('input[name="cover"]:checked').length;
        var is_dinghies_cover=true;
        if(dinghies_cover==1 && dinghies_color=='Color'){
           is_dinghies_color=false;
           $("#dinghies_color_dl").addClass('border_red');
        }
         if(dinghies_cover==0 && dinghies_color=='Color'){
            is_dinghies_cover=true;
         }
         if(dinghies_cover==1 && dinghies_color!='Color'){
            is_dinghies_cover=true;
         }
         if(dinghies_cover==0 && dinghies_color!='Color'){
            is_dinghies_cover=false;
         }
         var ops_manager=$("#ops_manager").val();
         var is_ops_manager=false;
         if(ops_manager.length>=3){
            is_ops_manager=true;
         }
         else{
           is_ops_manager=false;
         }
         var mobile=$("#mobile").val();
         var is_mobile=false;
         if(mobile.length==10){
           is_mobile=true;
         }  
         else{
           is_mobile=false;
         }
         var email=$("#email").val();
         var is_email=false;
         if(email!=""){
            if (validateEmail(email)){ 
               is_email=true;
              }
             else{
                is_email=false;
               }
         }
         else{
             is_email=false;
         }

         idArray = []; 
        idArray.push({'id':1,'crew':false,'mobile':false,'email':false,'designation':false});
        idArray.push({'id':2,'crew':false,'mobile':false,'email':false,'designation':false}); 
        $('.dynamic_row').each(function () {
            idArray.push({'id':$(this).attr('data-count'),'crew':false,'mobile':false,'email':false,'designation':false});
        });
        for(var i=0;i<idArray.length;i++){   
            var id=idArray[i].id;
            var crew=$("#crew"+id).val();
            if(crew.length>=3){
              idArray[i].crew=true;
            }
            else{
              idArray[i].crew=false;
            }
            var mobile=$("#mobile"+id).val();
            if(mobile.length==10){
              idArray[i].mobile=true;
            }
            else{
              idArray[i].mobile=false;
            }
            var designation_text=$("#designation"+id).html();
            if(designation_text!='DESIGNATION'){
               idArray[i].designation=true;
               closePopover('#designation_div'+id);
            }
            else{
               idArray[i].designation=false;
            } 
            var dynamic_email=$("#email"+id).val();
            if(dynamic_email!=""){
               if (validateEmail(dynamic_email)){ 
                  idArray[i].email=true;
                 }
                else{
                   idArray[i].email=false;
                  }
            }
            else{
                idArray[i].email=false;
            }

         }   
        for(var j=0;j<idArray.length;j++){   
            var crew_boolean=false;            
            if(idArray[j].crew==true)
                crew_boolean=true;
            else
                break; 
        }    
          for(var k=0;k<idArray.length;k++){   
              var mobile_boolean=false;            
              if(idArray[k].mobile==true)
                  mobile_boolean=true;
              else
                  break; 
          } 
          for(var l=0;l<idArray.length;l++){   
              var mail_boolean=false;            
              if(idArray[l].email==true)
                  mail_boolean=true;
              else
                  break; 
          }
          for(var m=0;m<idArray.length;m++){   
              var designation_boolean=false;            
              if(idArray[m].designation==true)
                  designation_boolean=true;
              else
                  break; 
          }
          console.log("is_callsign="+is_callsign);
          console.log("is_operator="+is_operator); 
          console.log("is_aircraft_type="+is_aircraft_type);
          console.log("is_engine_type="+is_engine_type); 
          console.log("is_weight="+is_weight);
          console.log("is_pax="+is_pax); 
          console.log("is_max_fl="+is_max_fl); 
          console.log("is_max_fuel="+is_max_fuel); 
          console.log("is_taxi_fuel="+is_taxi_fuel); 
          console.log("is_tow="+is_tow); 
          console.log("is_lw="+is_lw); 
          console.log("is_zfw="+is_zfw); 
          console.log("is_basic_wt="+is_basic_wt); 
          console.log("is_equipments="+is_equipments); 
          console.log("is_holding="+is_holding); 
          console.log("is_transponder="+is_transponder); 
          console.log("is_pbn="+is_pbn); 
          console.log("is_credit_aai="+is_credit_aai); 
          console.log("is_aircraft_color="+is_aircraft_color); 
          console.log("is_emergency_radio="+is_emergency_radio); 
          console.log("is_ops_manager="+is_ops_manager); 
          console.log("is_mobile="+is_mobile); 
          console.log("is_dinghies_no="+is_dinghies_no);
          console.log("is_dinghies_capacity="+is_dinghies_capacity);
          console.log("is_dinghies_color="+is_dinghies_color);
          console.log("is_dinghies_cover="+is_dinghies_cover)
          console.log("is_email"+is_email);
          console.log("crew_boolean="+crew_boolean); 
          console.log(idArray);
          console.log("mobile_boolean="+mobile_boolean);
          console.log(idArray);
          console.log("mail_boolean="+mail_boolean); 
          console.log(idArray);
          console.log("desination_boolean="+designation_boolean); 
          console.log('is_email_duplicate='+is_email_duplicate);
          console.log('email_dup duplicate array',email_dup);
          console.log('is_mobile_duplicate='+is_mobile_duplicate);
          console.log('mobile duplicate array',mobile_dup);
          console.log('is_name_duplicate='+is_name_duplicate);
          console.log('name duplicate array',name_dup);
          console.log('is_duplicate_callsign',is_duplicate_callsign);
          if(is_callsign==true && is_duplicate_callsign==false && is_operator==true && is_aircraft_type==true && is_engine_type==true && is_weight==true && is_pax==true && is_max_fl==true && is_max_fuel==true && is_taxi_fuel==true && is_tow==true && is_lw==true && is_zfw==true && is_basic_wt==true && is_equipments==true && is_holding==true && is_pbn==true && is_credit_aai==true && is_aircraft_color==true && is_emergency_radio==true && is_ops_manager==true && is_mobile==true && crew_boolean==true && mobile_boolean==true && mail_boolean==true && is_transponder==true && designation_boolean==true && is_email==true && is_dinghies_no==true && is_dinghies_capacity==true && is_dinghies_color==true && is_dinghies_cover==true && is_email_duplicate==false && is_mobile_duplicate==false && is_name_duplicate==false){
               $('#submit').removeAttr("disabled");
            }
           else if(is_callsign==false || is_duplicate_callsign==true||is_operator==false || is_aircraft_type==false || is_engine_type==false || is_weight==false || is_pax==false || is_max_fl==false || is_max_fuel==false || is_taxi_fuel==false || is_tow==false || is_lw==false || is_zfw==false || is_basic_wt==false || is_equipments==false || is_holding==false || is_pbn==false || is_credit_aai==false || is_aircraft_color==false ||is_emergency_radio==false || is_ops_manager==false || is_mobile==false || crew_boolean==false || mobile_boolean==false || mail_boolean==false || is_transponder==false || designation_boolean==false || is_email==false || is_dinghies_no==false || is_dinghies_capacity==false || is_dinghies_color==false || is_dinghies_cover==false || is_email_duplicate==true || is_mobile_duplicate==true|| is_name_duplicate==true)
             $('#submit').prop("disabled",true); 
        }
        function validateEmail(email) {
          // var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
           var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
          return re.test(email);
        }
         $('input:radio[name=weight]').change(function () {
               $(".radio_mobile_lbl").removeClass('red_color');
               $("#pax").focus();
         }); 
         $('input:radio[name=credit_aai]').change(function () {
               $("#aircraftcolor").focus();
         });
         $('input:checkbox[name=cover]').change(function () {
            var cover_length=$('input[name="cover"]:checked').length;
            if(cover_length==0 && $("#dinghies_color").text()!='Color')
              $("#cover_checkbox_lbl").addClass('red_color');
            else
              $("#cover_checkbox_lbl").removeClass('red_color');  
         });  
         $(document).on('change',"input:radio,:checkbox",function(){
            validation();
          });
        $("#new_aircraft").submit(function(event){
                event.preventDefault();
            swal({
                title: "NEW AIRCRAFT DETAILS ENTERED CORRECTLY",
                text: "DO YOU WISH TO PROCEED ?",
                type: "warning",
                showCancelButton: true,
                type: "success",
                confirmButtonText: 'YES',
                confirmButtonClass: 'btn-success waves-effect waves-light',
                cancelButtonText: "NO",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                     $('#submit').prop("disabled",true);
                     $('.overlay').css('height',0);
                     $('.overlay').css('height', $(document).height());
                     $(".overlay").show();
                    var form = $('#new_aircraft')[0]; 
                    var formData = new FormData(form);
                    var transponder=$("#transponder_value").text();
                    var dinghies_color=$("#dinghies_color").text();
                    formData.append("dinghies_color",dinghies_color);
                    for(var z=0;z<idArray.length;z++){
                        var id_no=idArray[z].id;
                        formData.append("designation"+z,$("#designation"+id_no).text());
                    }              
                    $.ajax({
                        url: '/newaircraft',
                        data: formData,
                        type: 'POST',
                        contentType: false,
                        processData: false, 
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        success: function(data)
                        {   
                           $(".overlay").fadeOut();
                           $("html, body").animate({ scrollTop: 0 }, "slow"); 
                           if(data.callsign_count==1){
                             $.growl({title: '', location: 'tc', size: 'large', message: 'AIRCRAFT DETAILS FOR THIS CALL SIGN ALREADY EXISTS IN OUR WEBSITE, SUBMIT NEW CALL SIGN'});
                           }
                           else{
                               setTimeout(function(){   
                                var callsign=$("#callsign").val();
                                $('#new_aircraft')[0].reset();
                                $("#latestFplCopy_lbl").html('LATEST FPL COPY');
                                $("#latestLoadTrim_lbl").html('LATEST LOAD TRIM SHEET');
                                $("#previousNavLog_lbl").html('PREVIOUS COMPANY NAV LOG');
                                $("#companyFuelPolicy_lbl").html('COMPANY FUEL POLICY');
                                $("#dynamic3,#dynamic4,#dynamic5,#dynamic6,#dynamic7,#dynamic8,#dynamic9").remove();
                                $(".required").addClass('border_red');
                                $(".required1").addClass('border');
                                $("#emergency_radio_lbl,.radio_mobile_lbl").addClass('red_color')
                                $("#transponder_value").text('Transponder');
                                $("#designation1,#designation2").text('DESIGNATION');
                                $("#cover_checkbox_lbl").removeClass('red_color');
                                $("#dinghies_color").text('Color')
                                mobile_dup=[];
                                email_dup=[];
                                name_dup=[];
                                 $.growl({title: '', location: 'tc', size: 'large', message: callsign.toUpperCase()+' AIRCRAFT DETAILS SUBMITTED SUCCESSFULLY'});
                               },1000);
                          }
                        }
                    });
                  }
            });            
        });
        $.ajax({
        url: '/newaircraft_autosuggest',
        dataType:"json",  
        success: function(result)
        {
            $("#aircrafttype").autocomplete({
                source: result,
                selectFirst: true,
                minLength: 2,
                close: function (event, ui) 
                {
                    closePopover("#aircrafttype");
                },   
                select: function (event, ui) 
                {
                    validation();
                    $("#engine_type").focus();
                }
                 
            });
        }}); 
  
     });    
</script>
@stop
