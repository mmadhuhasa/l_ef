<?php 
if (env('APP_ENV') != 'local') 
ini_set('memory_limit', '512M');
?>
@extends('layouts.notam_layout',array('1'=>'1'))
@section('content')
@push('watchhourcss') 
<link rel="stylesheet" type="text/css" href="{{url('/app/css/notams/watchhour.css')}}"></link> 
<link rel="stylesheet" type="text/css" href="{{url('/app/css/notams/watchhour_view.css')}}"></link> 
<link href="{{url('app/css/select2.min.css')}}" rel="stylesheet"/>
<script src="{{url('app/js/select2.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{url('app/css/notams/multipleDatePicker.css')}}"><link>
<link rel="stylesheet" type="text/css" href="{{url('app/css/notams/daterangepicker.css')}}"><link>
<link rel="stylesheet" type="text/css" href="{{url('app/plugins/datatables/media/css/jquery.dataTables.min.css')}}"><link>
<script src="{{url('app/js/notams/daterangepicker.js')}}"></script>
<script src="{{url('app/js/notams/watchhours.js')}}"></script>
<script src="{{url('app/js/notams/multipleDatePicker.js')}}"></script>
<script src="{{url('app/plugins/datatables/media/js/jquery.dataTables.js')}}" type="text/javascript"></script>
@endpush 
<style>

.select2-results__message {
display:none !important;
}
select:focus {
outline: none;
} 
span.select2-selection.select2-selection--single {
outline: none;
}
.aerodrome-input_capitalize{
text-transform:uppercase;
} 
.font-bold {
font-weight: bold;
}
.text-center {
text-align: center;
}
.text_uppercase{
text-transform: uppercase;
}
.select2-selection__choice__remove{
float: right;
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
.style_plus_price {
box-shadow: none!important;
background: none!important;
color: #f1292b!important;
}
.tooltip_rel {position: relative;}
.tooltip_rel .fa {cursor:pointer; font-size:18px;}
.tooltip_cust {
position: absolute;
top: -28px;
left: -25px;
padding: 1px 11px;
color: #fff;
border-radius: 4px;
visibility: hidden;
font-size: 11px;
text-transform: capitalize;
font-weight: normal;
box-shadow: 0 0 1px 1px #ccc;
background: #333333;
z-index: 999999;
white-space: nowrap;
text-align: center;
}
.tooltip_tri_shape1, .tooltip_tri_shape2, .tooltip_tri_shape3 {
width: 0;
height: 0;
border-left: 5px solid transparent;
border-right: 5px solid transparent;
border-top: 6px solid #333;
position: absolute;
top: -6px;
right:3px;
z-index: 99999;
visibility: hidden;
}
.tooltip_rel:hover .tooltip_cust{visibility: visible;}
.tooltip_rel {
position: relative;
display: inline;
}
.tooltip_edit_position {
position: absolute;top: -28px;left:-50px;padding: 3px 11px;color: #fff;border-radius: 4px;visibility: hidden;font-size: 11px;font-weight: normal;
box-shadow: 0 0 1px 1px #ccc;background: #333333;white-space: nowrap;z-index: 20; text-transform: uppercase;
}
.tooltip_rel:hover .tooltip_edit_position, .tooltip_rel:hover .tooltip_tri_shape1, .tooltip_rel:hover .tooltip_tri_shape2, .tooltip_rel:hover .tooltip_tri_shape3{visibility: visible;}
.pencil_fuel_price:hover{
color: red;
text-decoration:none;
}
.hover_red{
color: red !important;
}
.hover_black{
color: black !important;
}
/*.edit_license, .viewhistory{
visibility: hidden;
}*/
.table-hover>tbody>tr:hover .edit_license {
visibility:visible;
}
/*.Add_row_fuel, .viewhistory{
visibility: hidden;
}*/
.table-hover>tbody>tr:hover .Add_row_fuel {
visibility:visible;
}

/*model open padding right*/
.test[style] {
padding-right:0;
}
.test.modal-open {
overflow: auto;
}
/*model open padding right*/
.select2-container--default.select2-container--open.select2-container--below .select2-selection--single, .select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
border-bottom: 0;
}
.select2-container--default.select2-container--focus .select2-selection--multiple {
border: 1px solid #999;
}
.animated {
animation-duration: 2s;
}
.animated.custdelay {
animation-iteration-count: 3;
-webkit-animation-iteration-count: 3;
}
#error_success{
text-align:center;
padding:7px;
font-weight: bold;
margin-top: 20px; 
color:red;
}
#success_message{
text-align:center;
padding:7px;
font-weight: bold;
margin-top: 20px;
}
.download-parent {
cursor: pointer;
}
.tooltip-download {
position: relative;
visibility: hidden;
background: #333;
color: #fff;
top: -24px;
right: 44px;
padding: 5px;
font-size: 10px;
border-radius: 3px;
cursor: default;
text-transform: uppercase;
width: 100px;
z-index: 10000;
}
.download-parent:hover .tooltip-download{
visibility: visible;
}
.select2-search__field{
  font-weight: bold;
}
.sf-menu ul{
z-index: 10000;  
}
.margin_left{
    margin-left: 261px;
}
.close_style_addairport {
    position: absolute;
    right: -5px;
    top: -10px;
    cursor: pointer;
    color: #ffffff;
    font-size: 26px;
    border-radius: 50%;
    background: #f1292b;
}
.table.dataTable.no-footer{
border-collapse: separate !important;
border-top: 1px solid #111;
border-right: 1px solid #111;
border-bottom: none;
}
.desk-plan{
color:#000!important;
}
#watchhours_info>thead>tr>th{
border:1px solid #fff;
border-right: 0px;
border-top: 0px;
border-bottom: 0px;
}
.desk-plan>thead>tr>th {font-size:13px;color: #ffffff;font-weight:bold;}

.desk-plan>tbody>tr>td {font-size: 14px;padding:0px!important;font-weight:bold;}
.dataTables_wrapper {margin-left:5px;margin-right:5px;}
.desk-plan tr:nth-child(odd) td{background: #ffffff;}
.desk-plan tr:nth-child(even) td{background: #eeeeee;}
.desk-plan tr:hover:nth-child(odd) td,.desk-plan tr:hover:nth-child(even) td {background: #fff;}
.desk-plan>thead>tr>th, .desk-plan>tbody>tr>td {padding:4px 1px 4px 1px;border:1px solid #333;text-transform: uppercase;}
.dataTables_wrapper .dataTables_paginate .paginate_button {padding:1px 8px;}
.dataTables_wrapper .dataTables_paginate .paginate_button {margin-left:10px;}
.dataTables_wrapper .dataTables_paginate{
padding-top:1em; 

}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
background: #333;color: #fff !important;}
.dataTables_wrapper .dataTables_paginate .previous {background: #333 !important;color: #fff !important;}
.dataTables_wrapper .dataTables_paginate .next {background: #333 !important;color: #fff !important;}
.dataTables_wrapper .dataTables_paginate .paginate_button {background:#ffffff; font-size:12px; border:none;border-radius:50%;}
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {background:#f1292b; font-size:12px; color:#f1f1f1 !important; border:none;}
.dataTables_wrapper .dataTables_info {font-size:12px;}
.top {margin-bottom:10px;}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {border:none;}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {background-color: #dedede !important; color:#f1292b !important;}
.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {background:#f1292b !important;}
.dataTables_wrapper .dataTables_paginate {padding-bottom:0.5em;}
.red_col{
  color: red;
  font-weight: bold;
}
#watchhours_info table:empty {display: none}
</style>
<div class="notify-bg-v"></div>
<div class="page">
    <!-- @include('includes.new_fpl_header',[]) -->
    @include('includes.new_header',[])
    <main>
      
        <section class="bg-1 welcome infopage" ng-app="navlog" ng-controller="watchHoursCtrl">
            @include('includes.watchhours_modal',[])
            <div class="container container-watchhours">
                <div class="row">
                        <div class="col-sm-5 aerodrome-form-section">
                            <div class="col-md-9" style="padding-right: 0;width: 71%;">
                                <select id="tag_list" name="code[]" multiple class="form-control aerodrome-input" name="code" placeholder="Aerodrome"  ng-model="notamsFilter.routeNotams" autocomplete="off" data-toggle="popover" data-placement="top"  max-length="4">
                                </select>
                            </div>
                            <button class="btn search-btn checkwatch" type="button"><span class="glyphicon glyphicon-search"></span></button>
                            <!--<a href="{{url('watchhours_pdf/all')}}"><img src="https://www.eflight.aero/media/ananth/images/pdf.png" class="img-responsive" alt="pdf" width="45px"></a>-->
                        
                        </div>
                
                        <div class="col-sm-5 aerodrome-form-section">
                            <div class="col-md-9" style="padding-right: 0;width:50%;">
                                <select  name="region_code" id="region_code" class="form-control aerodrome-input"  autocomplete="off" data-toggle="popover" data-placement="top"  max-length="4" style="color: black" >
                                  <option value="">CHOOSE ONE REGION</option>
                                  <option value="VA">VA</option>
                                  <option value="VE">VE</option>
                                  <option value="VI">VI</option>
                                  <option value="VO">VO</option>
                                </select>
                            </div>
                            <button class="btn search-btn" id="download_pdf" type="button"><span class="glyphicon glyphicon-search"></span></button> 
                        </div>
                </div>
                <div class="row">                
                    <div class="col-md-1 tooltip_rel style_plus_wrapper" style="width:3%;margin-left: 1%;">
                        <a data-toggle="modal" data-target="#AddAirport" style="cursor:pointer;" class="style_plus_price" id="add-fuel-airport">
                            <i class="fa fa-plus add_license"></i>
                        </a>
                        <span class="tooltip_cust">ADD AIRPORT</span>
                        <span class="tooltip_tri_shape1" style="right:3px;"></span>
                    </div>
                    <div class="col-md-1 tooltip_rel style_plus_wrapper" style="width:3%;margin-left: 1%;margin-right:5px;">
                        <a style="cursor:pointer;" class="style_plus_price" id="add-watch_hours">
                            <i class="fa fa-plus add_license"></i>
                        </a>
                        <span class="tooltip_cust">ADD WATCHHOURS</span>
                        <span class="tooltip_tri_shape1" style="right:3px;"></span>
                    </div>
                    <div class="col-md-1 tooltip_rel style_plus_wrapper" style="padding-right: 0;width: 4%;padding-left: 0;margin-left: 15px;">
                        <a href="javascript:void(0)" style="cursor:pointer;" id="pdf" class="style_plus_price">
                            <img src="https://www.eflight.aero/media/images/download-all.png" class="img-responsive modal_class" alt="">
                        </a>
                        <span class="tooltip_cust" >Download PDF</span>
                        <span class="tooltip_tri_shape1" style="right:27px;"></span>
                    </div>
               </div>             
                  <div class="col-md-8 animated infinite zoomIn hide success" id="error_success">
                  </div>
                  <div class="col-md-8" id="success_message">
                      <span class="success " ><span>
                      <a><i style="color:red" class="fa fa-spinner fa-spin"></i></a> Please wait ...
                      <p></p></span></span>
                  </div>
                  <div "class="row" id="watchhours_list""></div>
                  <div >
                     <div id="add_watchours" style="display: none" >
                      <div class="row watch-hours-row padd-0">
                          <div class="col-sm-12 header-title marg-30">ADD WATCH HOURS </div>
                          <div class="col-sm-12 watch-hours-row watch-hours-form " >
                              <div class="col-sm-2 col-md-2 dynamiclabel">
                                  <input class="watch-input" type="text" ng-change="onAerodatachange()" id="aerodrome" placeholder="Aerodrome" maxlength="3" ng-model="watchHours.aerodrome">
                                  <label>AERODROME</label>
                              </div>
                              <div class="col-sm-2 col-md-2 dynamiclabel">
                                  <input class="watch-input" type="text" placeholder="Notam number" maxlength="8" id="notamnumber" ng-model="watchHours.notamnumber">
                                  <label>NOTAM NUMBER</label>
                              </div>
                              <div class="col-sm-5 col-md-5 dynamiclabel">
                                  <!-- <input class="watch-input datepicker" type="text" placeholder="Start Date" ng-model="watchHours.startDate" > -->
                                  <input type="text" class="watch-input watch-input-date" ng-model="watchHours.daterange" ng-change="onDateChange()" name="daterange"  placeholder="From                    to"/>
                                  <label><span>FROM</span> <span class="to-date-label-span">TO</span></label>

                              </div>
                              <div class="col-sm-6 col-md-6 dynamiclabel">
                                  <textarea style="resize:none;" class="watch-input" type="text" placeholder="Notams" id="notams" ng-model="watchHours.notams"></textarea>
                                  <label>NOTAMS</label>
                              </div>
                              <div class="col-sm-2 col-md-2 load-btn-block">
                                  <button class="bt newbtnv1 load-btn" ng-click="load()">Create</button>
                              </div>
                          </div>    
                          <div class="row watch-hours-row form-section hide" >
                              <div class="col-sm-12 col-md-12 dynamiclabel">
                                  <input class="watch-input" type="text" ng-change="onAerodatachange()" id="aerodrome" placeholder="Aerodrome" maxlength="3" ng-model="watchHours.aerodrome">
                                  <label>AERODROME</label>
                              </div>
                              <div class="col-sm-12 col-md-12 dynamiclabel">
                                  <input class="watch-input" type="text" placeholder="Notam number" maxlength="10" id="notamnumber" ng-model="watchHours.notamnumber">
                                  <label>NOTAM NUMBER</label>
                              </div>
                              <div class="col-sm-12 col-md-12 dynamiclabel">
                                  <!-- <input class="watch-input datepicker" type="text" placeholder="Start Date" ng-model="watchHours.startDate" > -->
                                  <input type="text" class="watch-input watch-input-date" ng-model="watchHours.daterange" ng-change="onDateChange()" name="daterange"  placeholder="From                    to"/>
                                  <label><span>FROM</span> <span class="to-date-label-span">TO</span></label>

                              </div>
                              <div class="col-sm-12 col-md-3 load-btn-block">
                                  <button class="bt newbtnv1 load-btn" ng-click="load()">Create</button>
                              </div>

                          </div>

                          <div class="row watch-hours-row  previous-watch-hours col-md-12 watch-hours-form" >
                              <!-- No data available -->
                              <h6 class="previous-title">Previous Watch hours</h6>
                              <table class="table table-bordered">
                                  <tr class="table-header">
                                      <th>Airport</th>
                                      <th>Notam number</th>
                                      <th>Start Date</th>
                                      <th>End Date</th>
                                  </tr>
                                  <tr  ng-repeat="val in previousData">
                                      <td ng-bind="val.aerodrome"></td>
                                      <td ng-bind="val.notam_no"></td>
                                      <td ><% val.start_date_formatted%>  </td>
                                      <td ng-bind="val.end_date_formatted"></td>
                                  </tr>
                                  <tr  ng-if="!previousData || previousData.length == 0">
                                      <td colspan="4" >NO DATA AVAILABLE</td>
                                  </tr>
                              </table>
                          </div>
                      </div>
                      <div class="row watch-hours-row" ng-if="showCalendar" >
                          <div class="col-sm-12 header-title marg-30">
                              <div class="col-sm-6">
                                  DAYS AND TIME
                              </div>
                              <div class="col-sm-6">
                                  WATCH HOURS FOR <% watchHours.aerodrome %>
                              </div>
                          </div>
                          

                          <div id="alldays">
                              <!-- <h2 class="watch-hours-title">time</h2> -->
                              <div class="save-continue-btn">

                                  <button ng-if="!showSubmitBtn" class="btn newbtnv1 save-btn" ng-click="save()">Save and Continue</button>
                              </div>
                              <div class="prev save-continue-btn" ng-if="showPrev">
                                  <button class="btn newbtn_blackv1 " ng-click="prev()">Previous</button>
                              </div>
                              <div class="reset save-continue-btn">
                                  <button class="btn newbtnv1 " ng-click="reset()">Reset</button>
                              </div>
                              <div class="row type-selection-row">
                                  <input ng-if="pageIndex == 0" type="radio" id="radio1" name="radio-category_edit" ng-model="watchHours.type"  ng-change="changeType()" value="all"/>
                                  <label ng-if="pageIndex == 0" for="radio1" class="time-selection-label">ALL DAYS </label>

                                  <input type="radio" id="radio2" name="radio-category_edit" ng-model="watchHours.type"  ng-change="changeType()" value="specific" />
                                  <label for="radio2" class="time-selection-label">SPECIFIC DAYS</label>
                                  <input type="radio" id="radio3" name="category_edit" ng-model="watchHours.type"  ng-change="changeType()" value="closed" />
                                  <label for="radio3" class="time-selection-label">CLOSED</label>
                              </div>
                              <div class="col-md-7">
                                  <multiple-date-picker class="date-picker-main" days-allowed="daysAllowed" sunday-first-day="true"  ng-model="selectedNotamDates" month="beginMonth"  disable-days-before="startAt" disable-days-after="endAt" disallow-back-past-months="disablePast" disallow-go-futur-months="disableFuture" month-changed="monthChanged"></multiple-date-picker>

                              </div>
                              <div class="col-md-5">
                                  <div class="row timing-row" ng-repeat="val in timingArr" ng-if="watchHours.type != 'closed'">
                                      <div class="col-md-5 p-l-0 dynamiclabel form-input-block-time">
                                          <input class="watch-input" type="text" numeric id="start<%$index+1%>" placeholder="Start Time utc" ng-model="timingArr[$index].starttime" maxlength="4"  data-toggle="popover" data-placement="bottom" >
                                          <label> START TIME UTC </label> 
                                      </div>
                                      <div class="col-md-5 p-l-0 dynamiclabel form-input-block-time">
                                          <input class="watch-input" type="text" numeric id="end<%$index+1%>" placeholder="End Time utc" ng-model="timingArr[$index].endtime" maxlength="4"  data-toggle="popover" data-placement="bottom" >
                                          <label> END TIME UTC </label>   
                                      </div>
                                      <div>
                                          <i class="fa fa-plus plus-icon" ng-if="$index == 0" ng-click="addMore()"></i>
                                          <i class="fa fa-minus plus-icon"ng-if="$index != 0" ng-click="remove($index)"></i>
                                      </div>
                                  </div>
                                  <div class="row dynamiclabel" >
                                      <textarea class="form-control remark-input-textarea" placeholder="Remarks" ng-model="watchHours.remarks"></textarea>
                                      <label> REMARKS </label> 
                                  </div>
                              </div>
                              
                          </div>
                          <div id="result" class="result-section">
                              <!-- <h2 class="watch-hours-title">Watch Hours</h2> -->
                              <div class="watch-hours-output" ng-if="finalResultArr.length!=0">

                                  <div class="row item-strip" ng-repeat="item in finalResultArr track by $index">
                                      <div class="col-xs-3 item-strip-day-name">
                                          <span ng-bind="item.name"></span>
                                      </div>
                                      <div class="col-xs-6 item-strip-day-value  p-lr-0">
                                          <span class="time-item " ng-repeat="val in item.timing" ng-if="val.starttime=='0000' && val.endtime=='0000'">
                                              CLOSED
                                          </span>
                                          <span class="time-item " ng-repeat="val in item.timing" ng-if="val.starttime!='0000' || val.endtime!='0000'">
                                              <%val.starttime %> - <%val.endtime %> UTC ( <%val.starttimeIST %> - <%val.endtimeIST %> IST)
                                          </span>
                                      </div>
                                      <div class="col-xs-3 item-strip-day-value  p-lr-0">
                                          <span class="time-item " ng-repeat="val in item.timing" ng-if="val.starttime!='0000' || val.endtime!='0000'">
                                              <%item.remarks %>
                                          </span>
                                      </div>
                                  </div>
                                  <div class="submit-block">
                                      <button ng-if="showSubmitBtn" class="btn newbtnv1 " ng-click="submit()">Submit</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                     </div>
                     
                    <div class="container container-notam" id="edit_watchours" style="display: none;margin-left: -12px;">
                        <div class="row watch-hours-row padd-0">
                            <div class="col-sm-12 header-title marg-30">EDIT WATCH HOURS </div>
                            <div class="row watch-hours-row form-section" >
                                <div class="col-sm-12 col-md-12 dynamiclabel">
                                    <input type="hidden" id="record_id" value="434" >
                                    <input class="watch-input" type="text" ng-change="onAerodatachange()" id="aerodrome" placeholder="Aerodrome" maxlength="3" ng-model="edit_watchHours.aerodrome">
                                    <label>AERODROME</label>
                                </div>
                                <div class="col-sm-12 col-md-12 dynamiclabel">
                                    <input class="watch-input" type="text" placeholder="Notam number" maxlength="10" id="notamnumber" ng-model="edit_watchHours.notamnumber">
                                    <label>NOTAM NUMBER</label>
                                </div>
                                <div class="col-sm-12 col-md-12 dynamiclabel">
                                    <!-- <input class="watch-input datepicker" type="text" placeholder="Start Date" ng-model="watchHours.startDate" > -->
                                    <input type="text" class="watch-input watch-input-date" ng-model="
                                    edit_watchHours.daterange" ng-change="onEdit_DateChange()" name="daterange"  placeholder="From                    to"/>
                                    <label><span>FROM</span> <span class="to-date-label-span">TO</span></label>

                                </div>
                                <div class="col-sm-6 col-md-6 dynamiclabel">
                                  <textarea style="resize:none;" class="watch-input ng-pristine ng-valid ng-touched" type="text" placeholder="Notams" id="notams" ng-model="
                                  edit_watchHours.notams"></textarea>
                                  <label>NOTAMS</label>
                              </div>
                                <div class="col-sm-12 col-md-3 load-btn-block">
                                    <!-- <button class="bt newbtnv1 load-btn" ng-click="load()">Create</button> -->
                                </div>

                            </div>

                            <div class="row watch-hours-row form-section previous-watch-hours " >
                                <!-- No data available -->
                                <h6 class="previous-title">Previous Watch hours</h6>
                                <!--  <div class="row">
                                     <p ></p>
                                 </div> -->
                                <table class="table table-bordered">
                                    <tr class="table-header">
                                        <th>Airport</th>
                                        <th>Notam number</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                    </tr>
                                    <tr  ng-repeat="val in previousData">
                                        <td ng-bind="val.aerodrome"></td>
                                        <td ng-bind="val.notam_no"></td>
                                        <td ><% val.start_date_formatted%>  </td>
                                        <td ng-bind="val.end_date_formatted"></td>
                                    </tr>
                                    <tr  ng-if="!previousData || previousData.length == 0">
                                        <td colspan="4" >NO DATA AVAILABLE</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row watch-hours-row" ng-if="edit_showCalendar" >
                            <div class="col-sm-12 header-title marg-30">
                                <div class="col-sm-6">
                                    DAYS AND TIME
                                </div>
                                <div class="col-sm-6">
                                    WATCH HOURS FOR <% watchHours.aerodrome %>
                                </div>
                            </div>
                            

                            <div id="alldays">
                                <!-- <h2 class="watch-hours-title">time</h2> -->
                                <div class="save-continue-btn">

                                    <button ng-if="!showSubmitBtn" class="btn newbtnv1 save-btn" ng-click="
                                    edit_save()">Save and Continue</button>
                                </div>
                                <div class="prev save-continue-btn" ng-if="showPrev">
                                    <button class="btn newbtn_blackv1 " ng-click="prev()">Previous</button>
                                </div>
                                <div class="reset save-continue-btn">
                                    <button class="btn newbtnv1 " ng-click="reset()">Reset</button>
                                </div>
                                <div class="row type-selection-row">
                                    <input ng-if="pageIndex == 0" type="radio" id="radio1" name="radio-category" ng-model="edit_watchHours.type"  ng-change="Edit_changeType()" value="all"/>
                                    <label ng-if="pageIndex == 0" for="radio1" class="time-selection-label">ALL DAYS </label>

                                    <input type="radio" id="radio2" name="radio-category" ng-model="edit_watchHours.type"  ng-change="Edit_changeType()" value="specific" />
                                    <label for="radio2" class="time-selection-label">SPECIFIC DAYS</label>
                                    <input type="radio" id="radio3" name="radio-category" ng-model="edit_watchHours.type"  ng-change="Edit_changeType()" value="closed" />
                                    <label for="radio3" class="time-selection-label">CLOSED</label>
                                </div>
                                <div class="col-md-7">
                                    <multiple-date-picker class="date-picker-main" days-allowed="daysAllowed" sunday-first-day="true"  ng-model="selectedNotamDates" month="beginMonth"  disable-days-before="startAt" disable-days-after="endAt" disallow-back-past-months="disablePast" disallow-go-futur-months="disableFuture" month-changed="monthChanged"></multiple-date-picker>

                                </div>
                                <div class="col-md-5">
                                    <div class="row timing-row" ng-repeat="val in timingArr" ng-if="watchHours.type != 'closed'">
                                        <div class="col-md-5 p-l-0 dynamiclabel form-input-block-time">
                                            <input class="watch-input" type="text" numeric id="start<%$index+1%>" placeholder="Start Time utc" ng-model="timingArr[$index].starttime" maxlength="4"  data-toggle="popover" data-placement="bottom" >
                                            <label> START TIME UTC </label> 
                                        </div>
                                        <div class="col-md-5 p-l-0 dynamiclabel form-input-block-time">
                                            <input class="watch-input" type="text" numeric id="end<%$index+1%>" placeholder="End Time utc" ng-model="timingArr[$index].endtime" maxlength="4"  data-toggle="popover" data-placement="bottom" >
                                            <label> END TIME UTC </label>   
                                        </div>
                                        <div>
                                            <i class="fa fa-plus plus-icon" ng-if="$index == 0" ng-click="addMore()"></i>
                                            <i class="fa fa-minus plus-icon"ng-if="$index != 0" ng-click="remove($index)"></i>
                                        </div>
                                    </div>
                                    <div class="row dynamiclabel" >
                                        <textarea class="form-control remark-input-textarea" placeholder="Remarks" ng-model="edit_watchHours.remarks"></textarea>
                                        <label> REMARKS </label> 
                                    </div>
                    
                                </div>
                                
                            </div>
                            <div id="result" class="result-section">
                                <!-- <h2 class="watch-hours-title">Watch Hours</h2> -->
                                <div class="watch-hours-output">

                                    <div class="row item-strip" ng-repeat="item in finalResultArr track by $index">
                                        <div class="col-xs-4 item-strip-day-name">
                                            <span ng-bind="item.name"></span>
                                        </div>
                                        <div class="col-xs-4 item-strip-day-value  p-lr-0">
                                            <span class="time-item " ng-repeat="val in item.timing" ng-if="val.starttime=='0000' && val.endtime=='0000'">
                                                CLOSED
                                            </span>
                                            <span class="time-item " ng-repeat="val in item.timing" ng-if="val.starttime!='0000' || val.endtime!='0000'">
                                                <%val.starttime %> - <%val.endtime %>
                                            </span>
                                        </div>
                                        <div class="col-xs-4 item-strip-day-value  p-lr-0">
                                            <span class="time-item " ng-repeat="val in item.timing" ng-if="val.starttime=='0000' && val.endtime=='0000'">
                                                CLOSED
                                            </span>
                                            <span class="time-item " ng-repeat="val in item.timing" ng-if="val.starttime!='0000' || val.endtime!='0000'">
                                                <%val.starttimeIST %> - <%val.endtimeIST %>
                                            </span>
                                        </div>
                                    </div>
                                   <!--  <div class="row remarks-section">
                                        <div class="col-xs-2">
                                            Remarks
                                        </div>
                                        <div class="col-xs-10">
                                            <textarea class="form-control" ng-model="watchHours.remarks"></textarea>
                                        </div>

                                    </div> -->
                                    <div class="submit-block">
                                        <button ng-if="showSubmitBtn" class="btn newbtnv1 " ng-click="update()">Submit</button>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                     </div> 
                  </div>
                  <!-- close Add watch hours -->
            </div>
        
           
        </section>
    </main>     
    <script>
        $(document).ready(function() {
            $("#pdf").click(function(){
                 var url = "<?php echo URL::to('/'); ?>";
                 window.location = url + "/watchhours_pdf";   
            });
            $('#AddAirport, #ViewHistory, #AddFuelData').on('show.bs.modal', function (e) {
                $('body').addClass('test');
            });
            $("#download_pdf").click(function(){
              var url = "<?php echo URL::to('/'); ?>";
              var region=$('#region_code').val()
               if(region!="")
                window.location = url + "/watchhours_region_pdf?region="+region;   
            });

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
       $.ajax({
               url: base_url + "/watchhours_airport/search",
               success: function (data) {
                 $("#success_message").addClass('hide');
                 $("#watchhours_list").html(data);
                 if($("#watchhours_empty").length==1)
                   $("#pdf").addClass('hide');
                 else
                   $("#pdf").removeClass('hide');
               }
       });    
       $(document).ready(function(){
         
        $("#add-watch_hours").click(function(){
             //$("#watchhours_list").addClass('hide');
             //$("#add_watchours").removeClass('hide');
             $("#watchhours_list,#edit_watchours").hide();
             $("#add_watchours").show();
             //angular.element('#add_watchours').scope().startload();

        });
        
        $(".select2-search__field").addClass('aerodrome-input_capitalize');

        $("#code").keyup(function(event){
            if($(this).val().length>=4)
              closePopover('#code');
        });
        $("#name").keyup(function(event){
            if($(this).val().length>2)
              closePopover('#name');
        });
        $("#add-airport").submit(function(event){
              event.preventDefault();
             var bool = true;
             if ($("#code").val()=="" || $("#code").val().length<4) {
                 errorPopover('#code', 'Airport Codes (Min. & Max. 4)');
                 bool = false;
             }
             if ($("#name").val() =="" || $("#name").val().length<=2) {
                 errorPopover('#name', 'City is Required');
                 bool = false;
             }
              if(bool==false)
                 return false;
             $.ajax({
                 context : this,  
                 type: "POST",  
                 url: $(this).attr('action'),
                 headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                 dataType:"json",
                 data:$(this).serialize(),
                 success: function(result) {
                     if(result.success==false){
                        $.each(result.message, function(key,value){
                         errorPopover('#'+key,value);
                       });
                     }
                     if(result.success==true){
                       $("#AddAirport").modal('hide');
                       $("#code").val('');
                       $("#name").val('');
                       closePopover('#code');
                       closePopover('#name');
                       $("#error_success").html('Airport Code Added Successfully').removeClass('hide');
                       setTimeout(function(){ $("#error_success").addClass('hide'); }, 3000);

                     }
                 }
               });
        });
       });
        $('.select2-search__field').keyup(function(){
         console.log($(this).val());
        });
        $('#tag_list').select2({
            placeholder: "SEARCH UPTO 5 AIRPORTS WATCH HOURS",
            language: {
                 noResults: function (params) {
                return ;
                }
            },
            ajax: {
                url: '/watchhours_airport/find',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
        $(window).scroll(function () {
            if ($(this).scrollTop()) {
                $('#v_toTop').fadeIn();
                $('#v_toTop_mid').fadeIn();
            } else {
                $('#v_toTop_mid').fadeOut();
                $('#v_toTop').fadeOut();
            }
        });
        $("#v_toTop").click(function () {
            $("html, body").animate({scrollTop: 0}, 500);
        });
         $(document).on('click',".checkwatch", function(){
            var tag_list=$("#tag_list").select2('val');
            if((tag_list!=null && tag_list.length>5) ){
              $("#watchhours_message").modal();
              return false;
            }
            $("#success_message").removeClass('hide');
             $.ajax({
                     url: base_url + "/watchhours_airport/search",
                     data:{'code':tag_list},
                     success: function (data) {
                      setTimeout(function(){ 
                        $("#success_message").addClass('hide'); 
                        $("#watchhours_list").html(data);
                        $("#add_watchours,#edit_watchours").hide();
                        $("#watchhours_list").show();
                        if($("#watchhours_empty").length==1)
                          $("#pdf").addClass('hide');
                        else
                          $("#pdf").removeClass('hide');  

                        },1000);
                     }
             });
             // if(code != ""){
             //     window.location = base_url + "/watchhours?code="+code+"&check=all";
             // }
        });
        
        $(document).on('click',".delete_notam_pop", function(){
            var id = $(this).attr('data-id');
            $(".delete_watch_confirm").attr('watch-id', id);
            
            $("#deleteNotam").modal()
        });
         $(document).on('click',".delete_watch_confirm", function(e){
             e.preventDefault();
             var tag_list=$("#tag_list").select2('val');
            var id = $(this).attr('watch-id');
            $.ajax({
                type: "POST",
                url: base_url + "/delete_watch",
                dataType: "json",
                data: {'id': id},
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (data) {
                     /*var code = $("input[name='code']").val();
                     if(code != ""){
                         window.location = base_url + "/watchhours?code="+code;
                     }else{
                         window.location = base_url + "/watchhours";
                     }*/
                     $("#deleteNotam").modal('hide');
                     $("#success_message").removeClass('hide');
                      $.ajax({
                              url: base_url + "/watchhours_airport/search",
                              data:{'code':tag_list},
                              success: function (data) {
                               setTimeout(function(){ 
                                 $("#success_message").addClass('hide'); 
                                 $("#watchhours_list").html(data);
                                 $("#add_watchours,#edit_watchours").hide();
                                 $("#watchhours_list").show();
                                 if($("#watchhours_empty").length==1)
                                   $("#pdf").addClass('hide');
                                 else
                                   $("#pdf").removeClass('hide');
                                 
                                 },1000);
                                
                              }
                      });
                }
            });
         })

         $("#notamnumber").keypress(function(event){
              var notams=$(this).val();
              var notams_key_code=event.which || event.keyCode;
              if(notams.length==0)   
              {
                  if((notams_key_code>=32 && notams_key_code<=64)||(notams_key_code>=91 && notams_key_code<=96)||(notams_key_code>=123 && notams_key_code<=127))
                    return false;
              }
              if((notams.length>=1 && notams.length<=4)||(notams.length>=6 && notams.length<=7))
              {
                  if(notams_key_code==48||(notams_key_code>=49 && notams_key_code<=57))
                    return true;
                  else
                    return false;
              }
              if(notams.length==5)
              {
                $("#notamnumber").val($("#notamnumber").val()+'/');
                if((notams_key_code>=32 && notams_key_code<=126))
                  return false;
                }
         });
         $(document).on("click",".viewhistory",function()
         {   $("#watchhours_info_tbody").empty();
             var watchhoursid=$(this).attr('data-watchhours_id');

             viewhistory(watchhoursid)
         });    
         function viewhistory(watchhoursid)
         {
           $('#watchhours_info').DataTable( {
                      destroy: true,   
                     "serverSide": true,
                     "pageLength":10,
                     "lengthChange": false,
                     "aaSorting": [],
                     "searching": false,
                     "bInfo" : false,
                     "dom": '<"top"flp<"clear">>',
                     "aoColumns":[
                     {"bSortable": false},
                     {"bSortable": false},
                     {"bSortable": false},
                      {"bSortable": false},
                        
                 ],
                  "ajax":"/watchhours_viewhistory?watchhoursid="+watchhoursid,
             });
           //$(".dataTables_empty").attr('colspan',4);
         }
    </script>

    @include('includes.new_footer',[])
</div>
@stop