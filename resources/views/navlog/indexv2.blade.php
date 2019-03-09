@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@section('content')
<link rel="stylesheet" href="{{url('app/css/navlog/navlog.css')}}">
<script src="{{url('app/js/navlog/angular.min.js')}}"></script>
<script src="{{url('app/js/navlog/moment.min.js')}}"></script>
<script src="{{url('app/js/navlog/jquery.redirect.js')}}"></script>
<script src="{{url('app/js/navlog/navlogv2.js')}}"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

<style>
    .m-tb-20 {
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .nlg_process_btn {
        line-height: 0;
    }
    .ng-binding{
      /* color: red; */
    }
    .social-stat .fa {
        font: 400 22px/35px "FontAwesome";
    }
    .container-short-fpl .nlg_process_btn:hover {
    transition: 0.25s all ease;
    webkit-transition: 0.25s all ease;
    }
    @media only screen and (max-width: 767px) and (min-width: 320px) {
        .container-fluid {
            margin-top: 56px;
        }
    }

    /* css */
.bodyContainer {
    font: normal 13px/16px Courier New;
    margin: 40px;
    border:2px dashed black;
    padding: 15px;
    color:#666666;
    max-width:900px;
    margin: 15px auto;
    background: #fff;
}
strong {
    color:#000;
}
.heading-strip{
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
}
h1 {
    font-size: 130%;
    text-align: center;
    padding: 5px 0 20px 0;
    color:#000;
}
h1 span {
    display: inline-block;
    padding-bottom: 3px;
    border-bottom: 2px solid black;
    font-weight: bold;
    color:#000;
}
h2 {
    font-size: 120%;
    text-align: center;
    padding: 5px 0;
    color:#000;
}
.seperator {
    border-top:1px dashed #000;
    padding: 15px 0;
}
.bdbtm {
    border-bottom:1px solid #999999;
}
td {
    padding:2px 0;
}
.container-short-fpl{
  width:1000px !important; 
}
    /*wend*/
</style>
<div class="page"  ng-app="navlog" ng-controller="navlogv2Ctrl">  
    @include('includes.new_header',[])
    @include('includes.navlog_modal',[])
    <main id="navlog-main" >
        <section  ng-if="!submitNavlog">
        <!-- <div class="row" style="box-shadow: 0 3px 3px 1px #999999;"> -->
              
            <!-- <div class="dt_loading"><i style="width:100%;text-align:center;margin-top:20px;color:#f1292b" class="fa-2x fa fa-spinner fa-spin"></i></div> -->
            
        <!-- </div> -->
            <div class="container container-short-fpl m-tb-20" style="background: #fff;padding-top: 10px;padding-bottom: 20px;border-radius: 4px;border:1px solid #bbb;">
            <div class="row col-md-12 p-lr-0" style="width:100%;float:left">
                    <div class="q_filter">
                            <div class="col-sm-2 col-xs-6 col-md-3 xs-p-lr-5 callsign_wrapper">
                                <div class="form-group">
                                    <input ng-model="navlogv2.callsign_real" type="text" data-toggle ="popover" data-placement="bottom"  minlength="5" maxlength="7" autocomplete="off"  class="alpha_numeric text-center font-bold text_uppercase form-control modtooltip borderclass"  placeholder="Call Sign" id="aircraft_callsign2" name="aircraft_callsign2" tabindex="1">
                                </div>
                            </div>
                            <div class="col-sm-2 col-xs-6 col-md-3 depaero_wrapper_mobile depstatns xs-p-lr-5 paddingleft10 depaero_wrapper">
                                <div class="form-group">
                                    <input ng-model="navlogv2.pilot" data-toggle ="popover" data-placement="bottom" id="pilot" type="text" class="form-control text_uppercase alphabets font-bold stations borderclass" id="departure_aerodrome2" minlength="2" maxlength="25"  name="departure_aerodrome2" placeholder="PILOT NAME">
                                </div>
                            </div>
                            <div class="col-sm-2 col-xs-6 col-md-3 depaero_wrapper_mobile depstatns xs-p-lr-5 paddingleft10 depaero_wrapper">
                                <div class="form-group">
                                    <input ng-model="navlogv2.pilot_mobile" type="text" data-toggle ="popover" data-placement="bottom" id="pilot_mobile" class="form-control text_uppercase alphabets font-bold stations borderclass" id="departure_aerodrome2" minlength="10" maxlength="10"  name="departure_aerodrome2" placeholder="PILOT MOBILE">
                                </div>
                            </div>
                            <div class="col-sm-2 col-xs-6 col-md-3 depaero_wrapper_mobile depstatns xs-p-lr-5 paddingleft10 depaero_wrapper">
                                <div class="form-group">
                                    <input ng-model="navlogv2.copilot" type="text" data-toggle ="popover" data-placement="bottom" id="copilot" class="form-control text_uppercase alphabets font-bold stations borderclass" id="departure_aerodrome2" minlength="2" maxlength="25"  name="departure_aerodrome2" placeholder="CO PILOT NAME">
                                </div>
                            </div>
                            <div class="col-sm-2 col-xs-6 col-md-3 depaero_wrapper_mobile depstatns xs-p-lr-5 paddingleft10 depaero_wrapper">
                                <div class="form-group">
                                    <input ng-model="navlogv2.copilot_mobile" data-toggle ="popover" data-placement="bottom" id="copilot_mobile" type="text" class="form-control text_uppercase alphabets font-bold stations borderclass" id="departure_aerodrome2" minlength="2" maxlength="10"  name="departure_aerodrome2" placeholder="CO PILOT MOBILE">
                                </div>
                            </div>
                         
                            <button  class="newbtnv1 b-radius-5 btn nlg_process_btn" ng-click="next()">Next</button>
                            <div class="col-sm-8 col-xs-8 col-md-8 depaero_wrapper_mobile  xs-p-lr-5 paddingleft10 depaero_wrapper">
                                <div class="form-group">  
                                <input ng-model="navlogv2.remarks"  type="text" autocomplete="off"  class="form-control text-center font-bold text_uppercase validation_class route_allowed_chars" name="remarks" id="remarks" value="{{ (isset($remarks)) ?  $remarks: "" }}" placeholder="Remarks" data-toggle="popover" data-placement="bottom" maxlength="149" minlength="3" data-original-title="" title="">
                                </div>
                            </div>


                    </div>
                </div>
              <div class="row col-md-12 p-lr-0 heading-strip">
                  PASTE MAIN NAV LOG
              </div>
                <form >
                    <textarea ng-disabled="!submitBasicFields" ng-paste="onPaste($event)"  id="navlog" onfocus="this.placeholder = ''" onblur="this.placeholder = 'PASTE MAIN NAV LOG'" data-toggle="popover" data-placement="top" rows="14"  cols="100" ng-model="navlogv2.text" placeholder="PASTE MAIN NAV LOG"></textarea>
                </form>
                <div class="col-sm-2 col-xs-6 col-md-3 depaero_wrapper_mobile depstatns xs-p-lr-5 paddingleft10 depaero_wrapper">
                                <div class="form-group">
                                    <input ng-model="navlogv2.minFuel" type="text" class="form-control text_uppercase alphabets font-bold stations borderclass" id="departure_aerodrome2" minlength="5" maxlength="5" ng-disabled="disableMinMax"  name="departure_aerodrome2" placeholder="MIN FUEL">
                                </div>
                            </div>
                            <div class="col-sm-2 col-xs-6 col-md-3 depaero_wrapper_mobile depstatns xs-p-lr-5 paddingleft10 depaero_wrapper">
                                <div class="form-group">  
                                    <input ng-model="navlogv2.maxFuel" type="text" class="form-control text_uppercase alphabets font-bold stations borderclass" id="departure_aerodrome2" minlength="5" maxlength="5" ng-disabled="disableMinMax" name="departure_aerodrome2" placeholder="MAX FUEL">
                                </div>
                            </div>
                    <button  class="newbtnv1 b-radius-5 btn nlg_process_btn" ng-click="process()">Next</button>

                <div class="row col-md-12 p-lr-0 heading-strip">
                    PASTE ALTN NAV LOG
                </div>
                <div >
                    <textarea ng-disabled="!enableALtn" id="altnnavlog" onfocus="this.placeholder = ''" onblur="this.placeholder = 'PASTE ALTN NAV LOG'" data-toggle="popover" data-placement="top" rows="14"  cols="100" ng-model="navlogv2Altn.text" placeholder="PASTE ALTN NAV LOG"></textarea>
                    <button  class="newbtnv1 b-radius-5 btn nlg_process_btn" ng-click="final()">Process</button>
                </div>
            </div>
        </section>
        <section>



        @include('navlog.fpl_preview',[]);















       <!-- html for pdf -->

       <div id="exportthis" style="display:none;">

    <div class="bodyContainer">
        <h1><u>NAV LOG</u></h1>
        <div class="seperator">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="left" valign="top"><strong ng-bind="navlogv2.callsign"></strong><span class="lightFont">(CHALLENGER
                            350 - JUPITER CAPITAL PVT LTD)</span></td>
                </tr>
                <tr>
                    <td align="left" valign="top">
                        <strong ng-bind="navlogv2.depAerodrome">VOBG (HAL BANGALORE)</strong>
                        <span>to</span>
                        <strong ng-bind="navlogv2.destAerodrome">VABB MUMBAI</strong>
                        <strong>(</strong>
                        <span ng-bind="navlogv2.distance">479NM</span>
                        <strong>)</strong>
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top"><strong>FLIGHT DATE: </strong><strong ng-bind="navlogv2.date_of_flight">23-Oct-2018</strong></td>
                </tr>
                <tr>
                    <td align="left" valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="left" valign="top" style="width:50%;"><strong><span>DEPARTURE: </span> <span
                                            ng-bind="navlogv2.etd">0625 UTC</span></strong>(<span ng-bind="navlogv2.etd_ist"></span>)</td>
                                <td align="right" valign="top"><strong>ARRIVAL: <span ng-bind="navlogv2.ete"> 1hr
                                            13mins </span></strong><span class="lightFont">(<span ng-bind="navlogv2.eta"></span>)</span></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top"><strong>ROUTE: FL <span ng-bind="navlogv2.fLevel[0]"></span> </strong><strong
                            ng-bind="navlogv2.route"> BIA W56N AGELA MOLGO1D</strong></td>
                </tr>
            </table>
        </div>
        <div class="seperator">
            <div>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="50%" align="left" valign="top">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="left" valign="top">SPEED: <span ng-bind="navlogv2.tas_ext"></span> (<span
                                            ng-bind="navlogv2.tas[0]"></span> Kts)</td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">AVG WIND: <span ng-bind="navlogv2.avgWind"></span> 
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">TOP OF CLIMB TEMP: <span ng-bind="navlogv2.climbTemp"></span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td width="50%" align="right" valign="top">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="right" valign="top">CLIMB: <span ng-bind="navlogv2.climb"></span> </td>
                                </tr>
                                <tr>
                                    <td align="right" valign="top">DESCENT: <span ng-bind="navlogv2.descent"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right" valign="top">AVG. ISA: <span ng-bind="navlogv2.isa"></span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
            <div>
                <div align="center">
                    <h2><strong align="center"><u>FUEL DETAILS</u></strong></h2>
                </div>
            </div>
            <div>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="50%" align="left" valign="top"><strong>FUEL ON BOARD: <span ng-bind="navlogv2.blockFuel">
                                </span> Lbs </strong>  <br />
                            <strong>TRIP FUEL: <span ng-bind="navlogv2.flightFuel">2914 </span>Lbs</strong></td>
                        <td width="50%" align="right" valign="top"> TAKE OFF FUEL:<span ng-bind="navlogv2.blockFuel-navlogv2.taxiFuel"></span>
                            Lbs<br>
                            LANDING FUEL:<span ng-bind="navlogv2.landingFuel"> </span> lbs</td>
                    </tr>
                </table>
            </div>
            <div>
                <div align="center">
                    <h2><strong align="center"><u>PLAN DETAILS</u></strong></h2>
                </div>
            </div>
            <div>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="40%" align="left" valign="top">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="54%" align="left" valign="top">&nbsp;</td>
                                    <td width="4%" align="center" valign="top">&nbsp;</td>
                                    <td width="17%" align="left" valign="top">TIME</td>
                                    <td width="25%" align="right" valign="top">FUEL</td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">TAXI</td>
                                    <td align="left" valign="top">:</td>
                                    <td align="left" valign="top">0:10</td>
                                    <td align="right" valign="top" ng-bind="navlogv2.taxiFuel">350</td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">TRIP</td>
                                    <td align="left" valign="top">:</td>
                                    <td align="left" valign="top" ng-bind="navlogv2.tripTime">1:13</td>
                                    <td align="right" valign="top" ng-bind="navlogv2.tripFuel">2564</td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">CONTINGENCY 5%</td>
                                    <td align="left" valign="top">:</td>
                                    <td align="left" valign="top">0:05</td>
                                    <td align="right" valign="top" ng-bind="navlogv2.contingency">150</td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">DEST ALTERNATE</td>
                                    <td align="left" valign="top">:</td>
                                    <td align="left" valign="top" ng-bind="navlogv2Altn.ete">0:47</td>
                                    <td align="right" valign="top" ng-bind="navlogv2.altnFuel">1707</td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">RESERVE FUEL</td>
                                    <td align="left" valign="top">:</td>
                                    <td align="left" valign="top">0:30</td>
                                    <td align="right" valign="top" ng-bind="navlogv2.reserveFuel">800</td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">ADDITIONAL</td>
                                    <td align="left" valign="top">:</td>
                                    <td align="left" valign="top" ng-bind="navlogv2.extraTime">3:44</td>
                                    <td align="right" valign="top" ng-bind="navlogv2.extraFuel-navlogv2.contingency">4429</td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" class="seperator">TOTAL</td>
                                    <td align="left" valign="top" class="seperator">:</td>
                                    <td align="left" valign="top" class="seperator" ng-bind="navlogv2.totalTime">6:29</td>
                                    <td align="right" valign="top" class="seperator" ng-bind="navlogv2.totalFuel">10000</td>
                                </tr>
                            </table>
                        </td>
                        <td>&nbsp;</td>
                        <td width="50%" align="left" valign="top">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="left" valign="top">
                                        <table width="80%" border="0" align="right" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="27%" align="left" valign="top">&nbsp;</td>
                                                <td width="3%" align="left" valign="top">&nbsp;</td>
                                                <td width="20%" align="left" valign="top">&nbsp;</td>
                                                <td width="50%" align="left" valign="top">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top">BASIC WT</td>
                                                <td align="left" valign="top">:</td>
                                                <td align="left" valign="top" ng-bind="navlogv2.zfw-navlogv2.load">24650</td>
                                                <td align="left" valign="top">LOAD: <span ng-bind="navlogv2.load">190</span></td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top">ZERO FUEL</td>
                                                <td align="left" valign="top">:</td>
                                                <td align="left" valign="top" ng-bind="navlogv2.zfw">24840</td>
                                                <td align="left" valign="top">(MAX 28200)</td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top">T.OFF WT</td>
                                                <td align="left" valign="top">:</td>
                                                <td align="left" valign="top" ng-bind="navlogv2.tow">34490</td>
                                                <td align="left" valign="top">(MAX 40600)</td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top">LAND WT</td>
                                                <td align="left" valign="top">:</td>
                                                <td align="left" valign="top" ng-bind="navlogv2.elw">31926</td>
                                                <td align="left" valign="top">(MAX 34150)</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        <p>&nbsp;</p>
                                        <p>ALTN: <span ng-bind="navlogv2.altnAirport"></span><br>
                                            ALTN ROUTE: <span ng-bind="navlogv2Altn.fLevel[0]"></span> <span ng-bind="navlogv2.altnRoute"></span>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="seperator">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="50%" align="left" valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td colspan="6" align="left" valign="top">
                                    <div align="center"><strong><u>ACTUALS</u></strong></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="101" align="left" valign="bottom">CHOCKS ON</td>
                                <td width="10" align="left" valign="bottom">:</td>
                                <td width="162" align="left" valign="bottom" class="bdbtm">&nbsp;</td>
                                <td width="20" align="left" valign="bottom"></td>
                                <td width="86" align="left" valign="bottom">LANDING</td>
                                <td width="14" align="left" valign="bottom">:</td>
                                <td width="212" align="left" valign="bottom" class="bdbtm">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="101" align="left" valign="bottom">CHOCKS OFF</td>
                                <td width="10" align="left" valign="bottom">:</td>
                                <td width="162" align="left" valign="bottom" class="bdbtm">&nbsp;</td>
                                <td width="20" align="left" valign="bottom"></td>
                                <td width="86" align="left" valign="bottom">AIRBORNE</td>
                                <td width="14" align="left" valign="bottom">:</td>
                                <td width="212" align="left" valign="bottom" class="bdbtm">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="101" align="left" valign="bottom">BLOCK TIME</td>
                                <td width="10" align="left" valign="bottom">:</td>
                                <td width="162" align="left" valign="bottom" class="bdbtm">&nbsp;</td>
                                <td width="20" align="left" valign="bottom"></td>
                                <td width="86" align="left" valign="bottom">FLT TIME</td>
                                <td width="14" align="left" valign="bottom">:</td>
                                <td width="212" align="left" valign="bottom" class="bdbtm">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="101" align="left" valign="bottom">BLOCK FUEL</td>
                                <td width="10" align="left" valign="bottom">:</td>
                                <td width="162" align="left" valign="bottom" class="bdbtm">&nbsp;</td>
                                <td width="20" align="left" valign="bottom"></td>
                                <td width="86" align="left" valign="bottom">FIC-ADC</td>
                                <td width="14" align="left" valign="bottom">:</td>
                                <td width="212" align="left" valign="bottom" class="bdbtm">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                    <td align="left" valign="top">&nbsp;</td>
                    <td width="40%" align="left" valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td colspan="2" align="left" valign="top">
                                    <div align="center"><strong><u>V SPEED</u></strong></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="50%" align="left" valign="top">V1:</td>
                                <td width="50%" align="left" valign="top">Vr:</td>
                            </tr>
                            <tr>
                                <td width="50%" align="left" valign="top">V2:</td>
                                <td width="50%" align="left" valign="top">Vt:</td>
                            </tr>
                            <tr>
                                <td width="50%" align="left" valign="top">Vref:</td>
                                <td width="50%" align="left" valign="top">Vga:</td>
                            </tr>
                            <tr>
                                <td align="left" valign="top">Vt:</td>
                                <td align="left" valign="top">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <div class="seperator">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                </tr>

                <tr>
                    <td align="left" valign="top" class="">
                        <div align="center">I CERTIFY THAT ALL MY LICENSES, RATINGS ETC ARE CURRENT/ VALID AND I AM<br>
                            LEGALLY/ MEDICALLY FIT FOR OPERATING THIS FLIGHT. </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="64%" align="left" valign="top">PIC:<br>
                                    FO:</td>
                                <td width="36%" align="right" valign="bottom">(PILOT SIGNATURE)</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">ATC CLEARANCE:</td>
                </tr>
                <tr>
                    <td align="left" valign="top">DEP ATIS:</td>
                </tr>
                <tr>
                    <td align="left" valign="top">ARR ATIS:</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- second -->
    <div class="bodyContainer">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td align="left" valign="top">
                    <p align="center"><strong>MAIN ROUTE NAV LOG</strong></p>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top">
                    <table class="bdDataTable" border="0" cellspacing="0" cellpadding="0" width="100%">
                        <tr>
                            <td width="102" valign="bottom"></td>
                            <td width="60" valign="bottom"></td>
                            <td width="36" valign="bottom"></td>
                            <td width="35" valign="bottom"></td>
                            <td width="37" valign="bottom"></td>
                            <td width="54" valign="bottom"></td>
                            <td width="30" valign="bottom"></td>
                            <td width="60" colspan="2" valign="bottom">
                                <p align="center"><strong>SPD KT</strong></p>
                            </td>
                            <td width="60" colspan="2" valign="bottom">
                                <p align="center"><strong>DIST NM</strong></p>
                            </td>
                            <td width="78" colspan="2" valign="bottom">
                                <p align="center"><strong>FUEL LB</strong></p>
                            </td>
                            <td width="30" valign="bottom"></td>
                            <td width="114" colspan="3" valign="bottom">
                                <p align="center"><strong>TIME</strong></p>
                            </td>
                            <td width="30" valign="bottom"></td>
                        </tr>
                        <tr>
                            <td width="102" valign="bottom">
                                <p align="center"><strong>WAYPOINT</strong></p>
                            </td>
                            <td width="60" valign="bottom">
                                <p align="center"><strong>AIRWAY</strong></p>
                            </td>
                            <td width="36" valign="bottom">
                                <p align="center"><strong>HDG</strong></p>
                            </td>
                            <td width="35" valign="bottom">
                                <p align="center"><strong>CRS</strong></p>
                            </td>
                            <td width="37" valign="bottom">
                                <p align="center"><strong>ALT</strong></p>
                            </td>
                            <td width="54" valign="bottom">
                                <p align="center"><strong>WIND</strong></p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center"><strong>ISA</strong></p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center"><strong>TAS</strong></p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center"><strong>GS</strong></p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center"><strong>LEG</strong></p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center"><strong>REM</strong></p>
                            </td>
                            <td width="42" valign="bottom">
                                <p align="center"><strong>USED</strong></p>
                            </td>
                            <td width="36" valign="bottom">
                                <p align="center"><strong>REM</strong></p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center"><strong>ACT</strong></p>
                            </td>
                            <td width="42" valign="bottom">
                                <p align="center"><strong>LEG</strong></p>
                            </td>
                            <td width="36" valign="bottom">
                                <p align="center"><strong>REM</strong></p>
                            </td>
                            <td width="36" valign="bottom">
                                <p align="center"><strong>ETE</strong></p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center"><strong>ACT</strong></p>
                            </td>
                        </tr>
                        <tr ng-repeat="item in navlogv2.formattedRoute">
                            <td width="102" valign="bottom">
                                <p align="center" ng-bind="item.Waypoint">VOBG</p>
                            </td>
                            <td width="60" valign="bottom" ng-bind="item.Airway"></td>
                            <td width="36" valign="bottom">
                                <p align="center" ng-bind="item.HDG">-</p>
                            </td>
                            <td width="35" valign="bottom">
                                <p align="center" ng-bind="item.CRS">-</p>
                            </td>
                            <td width="37" valign="bottom">
                                <p align="center" ng-bind="item.ALT">2912</p>
                            </td>
                            <td width="54" valign="bottom">
                                <p align="center" ng-bind="item['DIR/SPD']">74/11</p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center" ng-bind="item.ISA">+16</p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center" ng-bind="item.TAS">0</p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center" ng-bind="item.GS">0</p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center" ng-bind="item.LEG">-</p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center" ng-bind="item.REM">479</p>
                            </td>
                            <td width="42" valign="bottom">
                                <p align="center" ng-bind="item.USED">350</p>
                            </td>
                            <td width="36" valign="bottom">
                                <p align="center" ng-bind="item.REM_1">9650</p>
                            </td>
                            <td width="30" valign="bottom"></td>
                            <td width="42" valign="bottom">
                                <p align="center" ng-bind="item.ACT">-</p>
                            </td>
                            <td width="36" valign="bottom">
                                <p align="center" ng-bind="item.REM_2">1:13</p>
                            </td>
                            <td width="36" valign="bottom">
                                <p align="center" ng-bind="item.ETE">-</p>
                            </td>
                            <td width="30" valign="bottom"></td>
                        </tr>
                        <!--           <tr>
            <td width="102" valign="bottom"><p align="center">VOBG</p></td>
            <td width="60" valign="bottom"></td>
            <td width="36" valign="bottom"><p align="center">-</p></td>
            <td width="35" valign="bottom"><p align="center">-</p></td>
            <td width="37" valign="bottom"><p align="center">2912</p></td>
            <td width="54" valign="bottom"><p align="center">74/11</p></td>
            <td width="30" valign="bottom"><p align="center">+16</p></td>
            <td width="30" valign="bottom"><p align="center">0</p></td>
            <td width="30" valign="bottom"><p align="center">0</p></td>
            <td width="30" valign="bottom"><p align="center">-</p></td>
            <td width="30" valign="bottom"><p align="center">479</p></td>
            <td width="42" valign="bottom"><p align="center">350</p></td>
            <td width="36" valign="bottom"><p align="center">9650</p></td>
            <td width="30" valign="bottom"></td>
            <td width="42" valign="bottom"><p align="center">-</p></td>
            <td width="36" valign="bottom"><p align="center">1:13</p></td>
            <td width="36" valign="bottom"><p align="center">-</p></td>
            <td width="30" valign="bottom"></td>
          </tr> -->
                        <!--    <tr>
            <td width="102" valign="bottom"><p align="center">BIA<br>
              BENGALURU 116.8</p></td>
            <td width="60" valign="bottom"><p align="center">DCT</p></td>
            <td width="36" valign="bottom"><p align="center">017</p></td>
            <td width="35" valign="bottom"><p align="center">016</p></td>
            <td width="37" valign="bottom"><p align="center">162</p></td>
            <td width="54" valign="bottom"><p align="center">H6</p></td>
            <td width="30" valign="bottom"><p align="center">+15</p></td>
            <td width="30" valign="bottom"><p align="center">297</p></td>
            <td width="30" valign="bottom"><p align="center">291</p></td>
            <td width="30" valign="bottom"><p align="center">16</p></td>
            <td width="30" valign="bottom"><p align="center">463</p></td>
            <td width="42" valign="bottom"><p align="center">618</p></td>
            <td width="36" valign="bottom"><p align="center">9382</p></td>
            <td width="30" valign="bottom"></td>
            <td width="42" valign="bottom"><p align="center">0:03</p></td>
            <td width="36" valign="bottom"><p align="center">1:10</p></td>
            <td width="36" valign="bottom"><p align="center">0:03</p></td>
            <td width="30" valign="bottom"></td>
          </tr>
          <tr>
            <td width="102" valign="bottom"><p align="center">-TOC-</p></td>
            <td width="60" valign="bottom"><p align="center">W56N</p></td>
            <td width="36" valign="bottom"><p align="center">337</p></td>
            <td width="35" valign="bottom"><p align="center">337</p></td>
            <td width="37" valign="bottom"><p align="center">400</p></td>
            <td width="54" valign="bottom"><p align="center">T1</p></td>
            <td width="30" valign="bottom"><p align="center">+12</p></td>
            <td width="30" valign="bottom"><p align="center">399</p></td>
            <td width="30" valign="bottom"><p align="center">399</p></td>
            <td width="30" valign="bottom"><p align="center">75</p></td>
            <td width="30" valign="bottom"><p align="center">388</p></td>
            <td width="42" valign="bottom"><p align="center">1211</p></td>
            <td width="36" valign="bottom"><p align="center">8789</p></td>
            <td width="30" valign="bottom"></td>
            <td width="42" valign="bottom"><p align="center">0:11</p></td>
            <td width="36" valign="bottom"><p align="center">0:59</p></td>
            <td width="36" valign="bottom"><p align="center">0:14</p></td>
            <td width="30" valign="bottom"></td>
          </tr>
          <tr>
            <td width="102" valign="bottom"><p align="center">OPAMO</p></td>
            <td width="60" valign="bottom"><p align="center">W56N</p></td>
            <td width="36" valign="bottom"><p align="center">337</p></td>
            <td width="35" valign="bottom"><p align="center">337</p></td>
            <td width="37" valign="bottom"><p align="center">400</p></td>
            <td width="54" valign="bottom"><p align="center">T9</p></td>
            <td width="30" valign="bottom"><p align="center">-1</p></td>
            <td width="30" valign="bottom"><p align="center">467</p></td>
            <td width="30" valign="bottom"><p align="center">476</p></td>
            <td width="30" valign="bottom"><p align="center">16</p></td>
            <td width="30" valign="bottom"><p align="center">372</p></td>
            <td width="42" valign="bottom"><p align="center">1263</p></td>
            <td width="36" valign="bottom"><p align="center">8737</p></td>
            <td width="30" valign="bottom"></td>
            <td width="42" valign="bottom"><p align="center">0:02</p></td>
            <td width="36" valign="bottom"><p align="center">0:57</p></td>
            <td width="36" valign="bottom"><p align="center">0:16</p></td>
            <td width="30" valign="bottom"></td>
          </tr>
          <tr>
            <td width="102" valign="bottom"><p align="center">BBI<br>
              BELLARY 112.8</p></td>
            <td width="60" valign="bottom"><p align="center">W56N</p></td>
            <td width="36" valign="bottom"><p align="center">339</p></td>
            <td width="35" valign="bottom"><p align="center">341</p></td>
            <td width="37" valign="bottom"><p align="center">400</p></td>
            <td width="54" valign="bottom"><p align="center">T7</p></td>
            <td width="30" valign="bottom"><p align="center">-1</p></td>
            <td width="30" valign="bottom"><p align="center">467</p></td>
            <td width="30" valign="bottom"><p align="center">474</p></td>
            <td width="30" valign="bottom"><p align="center">36</p></td>
            <td width="30" valign="bottom"><p align="center">336</p></td>
            <td width="42" valign="bottom"><p align="center">1388</p></td>
            <td width="36" valign="bottom"><p align="center">8612</p></td>
            <td width="30" valign="bottom"></td>
            <td width="42" valign="bottom"><p align="center">0:05</p></td>
            <td width="36" valign="bottom"><p align="center">0:52</p></td>
            <td width="36" valign="bottom"><p align="center">0:21</p></td>
            <td width="30" valign="bottom"></td>
          </tr>
          <tr>
            <td width="102" valign="bottom"><p align="center">ALGIR</p></td>
            <td width="60" valign="bottom"><p align="center">W56N</p></td>
            <td width="36" valign="bottom"><p align="center">314</p></td>
            <td width="35" valign="bottom"><p align="center">317</p></td>
            <td width="37" valign="bottom"><p align="center">400</p></td>
            <td width="54" valign="bottom"><p align="center">H4</p></td>
            <td width="30" valign="bottom"><p align="center">-1</p></td>
            <td width="30" valign="bottom"><p align="center">467</p></td>
            <td width="30" valign="bottom"><p align="center">463</p></td>
            <td width="30" valign="bottom"><p align="center">73</p></td>
            <td width="30" valign="bottom"><p align="center">263</p></td>
            <td width="42" valign="bottom"><p align="center">1645</p></td>
            <td width="36" valign="bottom"><p align="center">8355</p></td>
            <td width="30" valign="bottom"></td>
            <td width="42" valign="bottom"><p align="center">0:09</p></td>
            <td width="36" valign="bottom"><p align="center">0:43</p></td>
            <td width="36" valign="bottom"><p align="center">0:30</p></td>
            <td width="30" valign="bottom"></td>
          </tr>
          <tr>
            <td width="102" valign="bottom"><p align="center">AGELA</p></td>
            <td width="60" valign="bottom"><p align="center">W56N</p></td>
            <td width="36" valign="bottom"><p align="center">315</p></td>
            <td width="35" valign="bottom"><p align="center">318</p></td>
            <td width="37" valign="bottom"><p align="center">400</p></td>
            <td width="54" valign="bottom"><p align="center">H9</p></td>
            <td width="30" valign="bottom"><p align="center">-1</p></td>
            <td width="30" valign="bottom"><p align="center">467</p></td>
            <td width="30" valign="bottom"><p align="center">458</p></td>
            <td width="30" valign="bottom"><p align="center">46</p></td>
            <td width="30" valign="bottom"><p align="center">217</p></td>
            <td width="42" valign="bottom"><p align="center">1807</p></td>
            <td width="36" valign="bottom"><p align="center">8193</p></td>
            <td width="30" valign="bottom"></td>
            <td width="42" valign="bottom"><p align="center">0:06</p></td>
            <td width="36" valign="bottom"><p align="center">0:37</p></td>
            <td width="36" valign="bottom"><p align="center">0:36</p></td>
            <td width="30" valign="bottom"></td>
          </tr>
          <tr>
            <td width="102" valign="bottom"><p align="center">100-MOLGO</p></td>
            <td width="60" valign="bottom"><p align="center">MOLGO1D</p></td>
            <td width="36" valign="bottom"><p align="center">305</p></td>
            <td width="35" valign="bottom"><p align="center">309</p></td>
            <td width="37" valign="bottom"><p align="center">400</p></td>
            <td width="54" valign="bottom"><p align="center">H22</p></td>
            <td width="30" valign="bottom"><p align="center">-1</p></td>
            <td width="30" valign="bottom"><p align="center">467</p></td>
            <td width="30" valign="bottom"><p align="center">445</p></td>
            <td width="30" valign="bottom"><p align="center">51</p></td>
            <td width="30" valign="bottom"><p align="center">166</p></td>
            <td width="42" valign="bottom"><p align="center">1993</p></td>
            <td width="36" valign="bottom"><p align="center">8007</p></td>
            <td width="30" valign="bottom"></td>
            <td width="42" valign="bottom"><p align="center">0:07</p></td>
            <td width="36" valign="bottom"><p align="center">0:30</p></td>
            <td width="36" valign="bottom"><p align="center">0:43</p></td>
            <td width="30" valign="bottom"></td>
          </tr>
          <tr>
            <td width="102" valign="bottom"><p align="center">-TOD-</p></td>
            <td width="60" valign="bottom"><p align="center">MOLGO1D</p></td>
            <td width="36" valign="bottom"><p align="center">305</p></td>
            <td width="35" valign="bottom"><p align="center">309</p></td>
            <td width="37" valign="bottom"><p align="center">400</p></td>
            <td width="54" valign="bottom"><p align="center">H24</p></td>
            <td width="30" valign="bottom"><p align="center">-1</p></td>
            <td width="30" valign="bottom"><p align="center">467</p></td>
            <td width="30" valign="bottom"><p align="center">443</p></td>
            <td width="30" valign="bottom"><p align="center">82</p></td>
            <td width="30" valign="bottom"><p align="center">84</p></td>
            <td width="42" valign="bottom"><p align="center">2293</p></td>
            <td width="36" valign="bottom"><p align="center">7707</p></td>
            <td width="30" valign="bottom"></td>
            <td width="42" valign="bottom"><p align="center">0:11</p></td>
            <td width="36" valign="bottom"><p align="center">0:19</p></td>
            <td width="36" valign="bottom"><p align="center">0:54</p></td>
            <td width="30" valign="bottom"></td>
          </tr>
          <tr>
            <td width="102" valign="bottom"><p align="center">VABB</p></td>
            <td width="60" valign="bottom"><p align="center">MOLGO1D</p></td>
            <td width="36" valign="bottom"><p align="center">320</p></td>
            <td width="35" valign="bottom"><p align="center">322</p></td>
            <td width="37" valign="bottom"><p align="center">40</p></td>
            <td width="54" valign="bottom"><p align="center">295/12</p></td>
            <td width="30" valign="bottom"><p align="center">+12</p></td>
            <td width="30" valign="bottom"><p align="center">271</p></td>
            <td width="30" valign="bottom"><p align="center">261</p></td>
            <td width="30" valign="bottom"><p align="center">84</p></td>
            <td width="30" valign="bottom"><p align="center">-</p></td>
            <td width="42" valign="bottom"><p align="center">2914</p></td>
            <td width="36" valign="bottom"><p align="center">7086</p></td>
            <td width="30" valign="bottom"></td>
            <td width="42" valign="bottom"><p align="center">0:19</p></td>
            <td width="36" valign="bottom"><p align="center">-</p></td>
            <td width="36" valign="bottom"><p align="center">1:13</p></td>
            <td width="30" valign="bottom"></td>
          </tr> -->
                    </table>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" valign="top">
                    <p align="center"><strong>ALTERNATE NAV LOG to <span ng-bind="navlogv2.altnAirport"> </span></strong></p>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="bdDataTable">
                        <tr ng-repeat="item in navlogv2Altn.formattedRoute">
                            <td width="102" valign="bottom">
                                <p align="center" ng-bind="item.Waypoint">VOBG</p>
                            </td>
                            <td width="60" valign="bottom" ng-bind="item.Airway"></td>
                            <td width="36" valign="bottom">
                                <p align="center" ng-bind="item.HDG">-</p>
                            </td>
                            <td width="35" valign="bottom">
                                <p align="center" ng-bind="item.CRS">-</p>
                            </td>
                            <td width="37" valign="bottom">
                                <p align="center" ng-bind="item.ALT">2912</p>
                            </td>
                            <td width="54" valign="bottom">
                                <p align="center" ng-bind="item['DIR/SPD']">74/11</p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center" ng-bind="item.ISA">+16</p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center" ng-bind="item.TAS">0</p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center" ng-bind="item.GS">0</p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center" ng-bind="item.LEG">-</p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center" ng-bind="item.REM">479</p>
                            </td>
                            <td width="42" valign="bottom">
                                <p align="center" ng-bind="item.USED">350</p>
                            </td>
                            <td width="36" valign="bottom">
                                <p align="center" ng-bind="item.REM_1">9650</p>
                            </td>
                            <td width="30" valign="bottom"></td>
                            <td width="42" valign="bottom">
                                <p align="center" ng-bind="item.ACT">-</p>
                            </td>
                            <td width="36" valign="bottom">
                                <p align="center" ng-bind="item.REM_2">1:13</p>
                            </td>
                            <td width="36" valign="bottom">
                                <p align="center" ng-bind="item.ETE">-</p>
                            </td>
                            <td width="30" valign="bottom"></td>
                        </tr>
                        <tr>
                            <td width="102" valign="bottom">
                                <p align="center">-TOC-</p>
                            </td>
                            <td width="60" valign="bottom">
                                <p align="center">DCT</p>
                            </td>
                            <td width="36" valign="bottom">
                                <p align="center">357</p>
                            </td>
                            <td width="35" valign="bottom">
                                <p align="center">357</p>
                            </td>
                            <td width="37" valign="bottom">
                                <p align="center">200</p>
                            </td>
                            <td width="54" valign="bottom"></td>
                            <td width="30" valign="bottom">
                                <p align="center">+15</p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center">297</p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center">293</p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center">-</p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center">216</p>
                            </td>
                            <td width="42" valign="bottom">
                                <p align="center">367</p>
                            </td>
                            <td width="36" valign="bottom">
                                <p align="center">6718</p>
                            </td>
                            <td width="30" valign="bottom"></td>
                            <td width="42" valign="bottom">
                                <p align="center">-</p>
                            </td>
                            <td width="36" valign="bottom">
                                <p align="center">0:38</p>
                            </td>
                            <td width="36" valign="bottom">
                                <p align="center">-</p>
                            </td>
                            <td width="30" valign="bottom"></td>
                        </tr>
                        <tr>
                            <td width="102" valign="bottom">
                                <p align="center">-TOD-</p>
                            </td>
                            <td width="60" valign="bottom">
                                <p align="center">DCT</p>
                            </td>
                            <td width="36" valign="bottom">
                                <p align="center">357</p>
                            </td>
                            <td width="35" valign="bottom">
                                <p align="center">357</p>
                            </td>
                            <td width="37" valign="bottom">
                                <p align="center">200</p>
                            </td>
                            <td width="54" valign="bottom">
                                <p align="center">H6</p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center">+14</p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center">423</p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center">417</p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center">173</p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center">43</p>
                            </td>
                            <td width="42" valign="bottom">
                                <p align="center">1342</p>
                            </td>
                            <td width="36" valign="bottom">
                                <p align="center">5743</p>
                            </td>
                            <td width="30" valign="bottom"></td>
                            <td width="42" valign="bottom">
                                <p align="center">0:25</p>
                            </td>
                            <td width="36" valign="bottom">
                                <p align="center">0:13</p>
                            </td>
                            <td width="36" valign="bottom">
                                <p align="center">0:25</p>
                            </td>
                            <td width="30" valign="bottom"></td>
                        </tr>
                        <tr>
                            <td width="102" valign="bottom">
                                <p align="center">VAAH</p>
                            </td>
                            <td width="60" valign="bottom">
                                <p align="center">DCT</p>
                            </td>
                            <td width="36" valign="bottom">
                                <p align="center">357</p>
                            </td>
                            <td width="35" valign="bottom">
                                <p align="center">357</p>
                            </td>
                            <td width="37" valign="bottom">
                                <p align="center">189</p>
                            </td>
                            <td width="54" valign="bottom">
                                <p align="center">293/11</p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center">+14</p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center">193</p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center">189</p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center">43</p>
                            </td>
                            <td width="30" valign="bottom">
                                <p align="center">-</p>
                            </td>
                            <td width="42" valign="bottom">
                                <p align="center">1826</p>
                            </td>
                            <td width="36" valign="bottom">
                                <p align="center">5259</p>
                            </td>
                            <td width="30" valign="bottom"></td>
                            <td width="42" valign="bottom">
                                <p align="center">0:13</p>
                            </td>
                            <td width="36" valign="bottom">
                                <p align="center">-</p>
                            </td>
                            <td width="36" valign="bottom">
                                <p align="center">0:38</p>
                            </td>
                            <td width="30" valign="bottom"></td>
                        </tr>
                    </table>
                    <p>&nbsp;</p>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top">
                    <table border="0" cellspacing="0" cellpadding="0" width="100%">
                        <tr>
                            <td valign="bottom">
                                <p><strong>Airport</strong></p>
                            </td>
                            <td valign="bottom">
                                <p align="center"><strong>WX</strong></p>
                            </td>
                            <td valign="bottom">
                                <p align="center"><strong>TWR</strong></p>
                            </td>
                            <td valign="bottom">
                                <p align="center"><strong>CLR</strong></p>
                            </td>
                            <td valign="bottom">
                                <p align="center"><strong>GND</strong></p>
                            </td>
                            <td valign="bottom">
                                <p align="center"><strong>ELEV</strong></p>
                            </td>
                            <td colspan="2" valign="bottom">
                                <p align="right"><strong>LONGEST RWY</strong></p>
                            </td>
                        </tr>
                        <tr ng-repeat="item in navlogv2.airportListArr track by $index " ng-if="$index!=0">
                            <td valign="bottom">
                                <p ng-bind="item.Airport">VOBG</p>
                            </td>
                            <td valign="bottom">
                                <p align="center" ng-bind="item.WX">128.25</p>
                            </td>
                            <td valign="bottom">
                                <p align="center" ng-bind="item['TWR/CTAF']">123.5</p>
                            </td>
                            <td valign="bottom">
                                <p align="center" ng-bind="item.CLR">N/A</p>
                            </td>
                            <td valign="bottom">
                                <p align="center" ng-bind="item.GND">N/A</p>
                            </td>
                            <td valign="bottom">
                                <p align="center" ng-bind="item.ELEV">2912</p>
                            </td>
                            <td valign="bottom">
                                <p align="center" ng-bind="item['LONGEST RWY']">09 / 27</p>
                            </td>
                            <td valign="bottom">
                                <p align="center" ng-bind="item['default']">10846 ft</p>
                            </td>
                        </tr>
                        <!--  <tr>
          <td valign="bottom"><p>VOBG</p></td>
          <td valign="bottom"><p align="center">128.25</p></td>
          <td valign="bottom"><p align="center">123.5</p></td>
          <td valign="bottom"><p align="center">N/A</p></td>
          <td valign="bottom"><p align="center">N/A</p></td>
          <td valign="bottom"><p align="center">2912</p></td>
          <td valign="bottom"><p align="center">09 / 27</p></td>
          <td valign="bottom"><p align="center">10846 ft</p></td>
        </tr>
        <tr>
          <td valign="bottom"><p>VABB</p></td>
          <td valign="bottom"><p align="center">126.4</p></td>
          <td valign="bottom"><p align="center">122.5</p></td>
          <td valign="bottom"><p align="center">121.85</p></td>
          <td valign="bottom"><p align="center">121.9</p></td>
          <td valign="bottom"><p align="center">      40</p></td>
          <td valign="bottom"><p align="center">09 / 27</p></td>
          <td valign="bottom"><p align="center">11312 ft</p></td>
        </tr>
        <tr>
          <td valign="bottom"><p>VAAH</p></td>
          <td valign="bottom"><p align="center">126.8</p></td>
          <td valign="bottom"><p align="center">119.6</p></td>
          <td valign="bottom"><p align="center">N/A</p></td>
          <td valign="bottom"><p align="center">N/A</p></td>
          <td valign="bottom"><p align="center">     189</p></td>
          <td valign="bottom"><p align="center">05 / 23</p></td>
          <td valign="bottom"><p align="center">11499 ft</p></td>
        </tr> -->
                    </table>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" valign="top">
                    <p>&nbsp;</p>
                    <div align="center">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="bdDataTable">
                            <tr>
                                <td rowspan="2" valign="bottom">
                                    <p><strong>Winds Aloft</strong><strong> </strong></p>
                                </td>
                                <td colspan="2" valign="bottom">
                                    <p align="center"><strong>FL</strong><strong> 360 (ISA: -56°C)</strong></p>
                                </td>
                                <td colspan="2" valign="bottom">
                                    <p align="center"><strong>FL</strong><strong> 380 (ISA: -56°C)</strong></p>
                                </td>
                                <td colspan="2" valign="bottom">
                                    <p align="center"><strong>FL</strong><strong> 400 (ISA: -56°C)</strong></p>
                                </td>
                                <td colspan="2" valign="bottom">
                                    <p align="center"><strong>FL </strong><strong>430 (ISA: -56°C)</strong></p>
                                </td>
                                <td colspan="2" valign="bottom">
                                    <p align="center"><strong>FL</strong><strong> 450 (ISA: -56°C)</strong></p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="bottom">
                                    <p><strong>WIND (COMP)</strong></p>
                                </td>
                                <td valign="bottom">
                                    <p align="right"><strong>ISA</strong></p>
                                </td>
                                <td valign="bottom">
                                    <p><strong>WIND (COMP)</strong></p>
                                </td>
                                <td valign="bottom">
                                    <p align="right"><strong>ISA</strong></p>
                                </td>
                                <td valign="bottom">
                                    <p><strong>WIND (COMP)</strong></p>
                                </td>
                                <td valign="bottom">
                                    <p align="right"><strong>ISA</strong></p>
                                </td>
                                <td valign="bottom">
                                    <p><strong>WIND (COMP)</strong></p>
                                </td>
                                <td valign="bottom">
                                    <p align="right"><strong>ISA</strong></p>
                                </td>
                                <td valign="bottom">
                                    <p><strong>WIND (COMP)</strong></p>
                                </td>
                                <td valign="bottom">
                                    <p align="right"><strong>ISA</strong></p>
                                </td>
                            </tr>
                            <tr ng-repeat="item in navlogv2.windListArr" ng-if="item.isa5">
                                <td valign="bottom" class="noBtBorder">
                                    <p ng-bind="item.airport">BIA</p>
                                </td>
                                <td valign="bottom" class="noBtBorder">
                                    <p ng-bind="item.wind1">214/011 (T11)</p>
                                </td>
                                <td valign="bottom" class="noBtBorder">
                                    <p ng-bind="item.isa1" align="center">+9</p>
                                </td>
                                <td valign="bottom" class="noBtBorder">
                                    <p ng-bind="item.wind2">188/017 (T17)</p>
                                </td>
                                <td valign="bottom" class="noBtBorder">
                                    <p ng-bind="item.isa2" align="center">+2</p>
                                </td>
                                <td valign="bottom" class="noBtBorder">
                                    <p ng-bind="item.wind3">188/017 (T17)</p>
                                </td>
                                <td valign="bottom" class="noBtBorder">
                                    <p ng-bind="item.isa3" align="center">+2</p>
                                </td>
                                <td valign="bottom" class="noBtBorder">
                                    <p ng-bind="item.wind4">186/012 (T11)</p>
                                </td>
                                <td valign="bottom" class="noBtBorder">
                                    <p ng-bind="item.isa4" align="center">-6</p>
                                </td>
                                <td valign="bottom" class="noBtBorder">
                                    <p ng-bind="item.wind5">188/008 (T7)</p>
                                </td>
                                <td valign="bottom" class="noBtBorder">
                                    <p ng-bind="item.isa5" align="center">-12</p>
                                </td>
                            </tr>
                            <!--  <tr>
              <td valign="bottom" class="noBtBorder"><p>-TOC-</p></td>
              <td valign="bottom" class="noBtBorder"><p>225/015 (T5)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">+9</p></td>
              <td valign="bottom" class="noBtBorder"><p>209/018 (T10)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">+1</p></td>
              <td valign="bottom" class="noBtBorder"><p>209/018 (T10)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">+1</p></td>
              <td valign="bottom" class="noBtBorder"><p>222/014 (T6)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">-6</p></td>
              <td valign="bottom" class="noBtBorder"><p>240/012 (T1)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">-12</p></td>
            </tr>
            <tr>
              <td valign="bottom" class="noBtBorder"><p>OPAMO</p></td>
              <td valign="bottom" class="noBtBorder"><p>238/018 (T2)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">+9</p></td>
              <td valign="bottom" class="noBtBorder"><p>227/023 (T7)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">+1</p></td>
              <td valign="bottom" class="noBtBorder"><p>227/023 (T7)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">+1</p></td>
              <td valign="bottom" class="noBtBorder"><p>236/020 (T3)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">-6</p></td>
              <td valign="bottom" class="noBtBorder"><p>247/018 (H1)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">-12</p></td>
            </tr>
            <tr>
              <td valign="bottom" class="noBtBorder"><p>BBI</p></td>
              <td valign="bottom" class="noBtBorder"><p>238/018 (T3)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">+9</p></td>
              <td valign="bottom" class="noBtBorder"><p>227/023 (T8)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">+1</p></td>
              <td valign="bottom" class="noBtBorder"><p>227/023 (T8)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">+1</p></td>
              <td valign="bottom" class="noBtBorder"><p>236/020 (T4)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">-6</p></td>
              <td valign="bottom" class="noBtBorder"><p>247/018 (T1)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">-12</p></td>
            </tr>
            <tr>
              <td valign="bottom" class="noBtBorder"><p>ALGIR</p></td>
              <td valign="bottom" class="noBtBorder"><p>250/025 (H11)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">+9</p></td>
              <td valign="bottom" class="noBtBorder"><p>243/030 (H10)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">+1</p></td>
              <td valign="bottom" class="noBtBorder"><p>243/030 (H10)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">+1</p></td>
              <td valign="bottom" class="noBtBorder"><p>248/026 (H10)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">-6</p></td>
              <td valign="bottom" class="noBtBorder"><p>254/024 (H12)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">-12</p></td>
            </tr>
            <tr>
              <td valign="bottom" class="noBtBorder"><p>AGELA</p></td>
              <td valign="bottom" class="noBtBorder"><p>260/027 (H15)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">+8</p></td>
              <td valign="bottom" class="noBtBorder"><p>256/034 (H17)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">+1</p></td>
              <td valign="bottom" class="noBtBorder"><p>256/034 (H17)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">+1</p></td>
              <td valign="bottom" class="noBtBorder"><p>259/033 (H18)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">-6</p></td>
              <td valign="bottom" class="noBtBorder"><p>262/032 (H18)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">-12</p></td>
            </tr>
            <tr>
              <td valign="bottom" class="noBtBorder"><p>100-MOLGO</p></td>
              <td valign="bottom" class="noBtBorder"><p>260/027 (H19)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">+8</p></td>
              <td valign="bottom" class="noBtBorder"><p>256/034 (H22)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">+1</p></td>
              <td valign="bottom" class="noBtBorder"><p>256/034 (H22)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">+1</p></td>
              <td valign="bottom" class="noBtBorder"><p>259/033 (H22)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">-6</p></td>
              <td valign="bottom" class="noBtBorder"><p>262/032 (H23)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">-12</p></td>
            </tr>
            <tr>
              <td valign="bottom" class="noBtBorder"><p>-TOD-</p></td>
              <td valign="bottom" class="noBtBorder"><p>266/031 (H24)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">+8</p></td>
              <td valign="bottom" class="noBtBorder"><p>259/037 (H25)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">0</p></td>
              <td valign="bottom" class="noBtBorder"><p>259/037 (H25)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">0</p></td>
              <td valign="bottom" class="noBtBorder"><p>261/039 (H28)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">-6</p></td>
              <td valign="bottom" class="noBtBorder"><p>262/040 (H29)</p></td>
              <td valign="bottom" class="noBtBorder"><p align="center">-12</p></td>
            </tr> -->
                            <tr>
                                <td valign="bottom" class="tpBorder"></td>
                                <td colspan="2" valign="bottom" class="tpBorder" ng-repeat="item in navlogv2.avgWindTime track by $index"
                                    ng-if="$index%2!=0">
                                    <p align="center" style="white-space:pre-line"><strong> <span ng-bind="navlogv2.avgWindTime[$index+1]"></span>&nbsp;<br>
                                        </strong> <strong><span ng-bind="navlogv2.avgWindTime[$index]"></span></strong></p>
                                </td>
                                <!-- <td valign="bottom" class="tpBorder"></td>
              <td colspan="2" valign="bottom" class="tpBorder"><p align="center"><strong>1h12m (-0:01) 2698 lbs&nbsp;<br>
              </strong><strong>Avg WIND:</strong><strong>H9</strong></p></td>
              <td colspan="2" valign="bottom" class="tpBorder"><p align="center"><strong>1h13m (-0:01)2625 lbs&nbsp;<br>
              </strong><strong>Avg WIND:</strong><strong>H9</strong></p></td>
              <td colspan="2" valign="bottom" class="tpBorder"><p align="center"><strong>1h13m (0:00)2564 lbs&nbsp;<br>
              </strong><strong>Avg WIND:</strong><strong>H9</strong></p></td>
              <td colspan="2" valign="bottom" class="tpBorder"><p align="center"><strong>1h14m (+0:01)2509 lbs&nbsp;<br>
              </strong><strong>Avg WIND:</strong><strong>H10</strong></p></td>
              <td colspan="2" valign="bottom" class="tpBorder"><p align="center"><strong>1h15m (+0:01) 2494 lbs&nbsp;<br>
              </strong><strong>Avg WIND:</strong><strong>H10</strong></p></td> -->
                            </tr>
                        </table>
                    </div>
                    <p>&nbsp;</p>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top">&nbsp;</td>
            </tr>
        </table>
    </div>
    <!-- end -->
    <!-- third -->
    <div class="bodyContainer">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="bdDataTable">
            <tr>
                <td align="left" valign="top">
                    <p align="center"><strong><u>ATC FLIGHT PLAN</u></strong></p>
                    <p>
                        (FPL-<span ng-bind="atcFpl.callsign"></span>-<span ng-bind="atcFpl.flightRule"></span>N<br>
                        -CL30/M-SDFGHJ4J5RVWY/LB1<br>
                        -<span ng-bind="atcFpl.depAerodrome"></span><span ng-bind="atcFpl.etd"></span><br>
                        -N0<span ng-bind="atcFpl.speed"></span>F<span ng-bind="atcFpl.fLevel"></span> <span ng-bind="atcFpl.route"></span><br>
                        -<span ng-bind="atcFpl.dest"></span><span ng-bind="atcFpl.ete"></span> <span ng-bind="atcFpl.altnAirport"></span><br>
                        -PBN/A1B2B3C2D2D3L1O2 NAV/GPSRNAV DOF/<span ng-bind="atcFpl.dof"></span> REG/<span ng-bind="atcFpl.callsign"></span>
                        EET/<span ng-bind="atcFpl.fir"></span> SEL/DGFM OPR/JUPITER CAPITAL PVT LTD PER/B RMK/CREDIT
                        FACILITY AVAILABLE WITH AAI PIC SANJAY CHAUHAN MOB 9986792106 FO RAMAKRISHNA 9886792107 ALL
                        INDIANS ON BOARD E0629 PAX<span ng-bind="atcFpl.pax"></span>) </p>
                </td>
            </tr>
        </table>

    </div>

    <!-- end -->
</div>

       <!-- end -->
        </section>
    </main>
    @include('includes.new_footer',[])

    @include('includes.xml_reset',[])
</div>
@stop