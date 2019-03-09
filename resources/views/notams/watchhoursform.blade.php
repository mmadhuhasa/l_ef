<?php 
 ini_set('memory_limit', '512M');
?>
@extends('layouts.notam_layout',array('1'=>'1'))
@section('content')
@push('watchhourcss') 
<link rel="stylesheet" type="text/css" href="{{url('/app/css/notams/watchhour.css')}}"></link> 
<link rel="stylesheet" type="text/css" href="{{url('app/css/notams/multipleDatePicker.css')}}"><link>
<link rel="stylesheet" type="text/css" href="{{url('app/css/notams/daterangepicker.css')}}"><link>
<script src="{{url('app/js/notams/daterangepicker.js')}}"></script>
<script src="{{url('app/js/notams/watchhours.js')}}"></script>
<script src="{{url('app/js/notams/multipleDatePicker.js')}}"></script>
@endpush 
<div class="page">
    <!-- @include('includes.new_fpl_header',[]) -->
    @include('includes.new_header',[])
    <main>
        <section class="bg-1 welcome infopage" ng-app="navlog" ng-controller="watchHoursCtrl">
            @include('includes.watchhours_modal',[])
            <div class="container container-notam">

                <div class="row watch-hours-row padd-0">
                    <div class="col-sm-12 header-title marg-30">WATCH HOURS </div>
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
                            <input ng-if="pageIndex == 0" type="radio" id="radio1" name="radio-category" ng-model="watchHours.type"  ng-change="changeType()" value="all"/>
                            <label ng-if="pageIndex == 0" for="radio1" class="time-selection-label">ALL DAYS </label>

                            <input type="radio" id="radio2" name="radio-category" ng-model="watchHours.type"  ng-change="changeType()" value="specific" />
                            <label for="radio2" class="time-selection-label">SPECIFIC DAYS</label>
                            <input type="radio" id="radio3" name="radio-category" ng-model="watchHours.type"  ng-change="changeType()" value="closed" />
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
                               <!--  <div class="col-xs-4 item-strip-day-value  p-lr-0">
                                    <span class="time-item " ng-repeat="val in item.timing" ng-if="val.starttime=='0000' && val.endtime=='0000'">
                                        CLOSED
                                    </span>
                                    <span class="time-item " ng-repeat="val in item.timing" ng-if="val.starttime!='0000' || val.endtime!='0000'">
                                       ( <%val.starttimeIST %> - <%val.endtimeIST %> IST)
                                    </span>
                                </div> -->
                                <div class="col-xs-3 item-strip-day-value  p-lr-0">
                                    <span class="time-item " ng-repeat="val in item.timing" ng-if="val.starttime!='0000' || val.endtime!='0000'">
                                        <%item.remarks %>
                                    </span>
                                </div>
                            </div>
                            <!-- <div class="row remarks-section">
                                <div class="col-xs-2">
                                    Remarks
                                </div>
                                <div class="col-xs-10">
                                    <textarea class="form-control" ng-model="watchHours.remarks"></textarea>
                                </div>

                            </div> -->
                            <div class="submit-block">
                                <button ng-if="showSubmitBtn" class="btn newbtnv1 " ng-click="submit()">Submit</button>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </section>
    </main>   
    <div id='v_toTop'><span></span></div>



    <script>
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
    </script>

    @include('includes.new_footer',[])
</div>
@stop