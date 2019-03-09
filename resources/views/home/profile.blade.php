@extends('layouts.backend_layout',array('1'=>'1'))

@section('content')
<link rel="stylesheet" type="text/css" href="{{url('app/css/home/profile.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('app/css/home/fullcalendar.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('app/css/home/pilot_profile.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('app/css/home/monthly.css')}}">
<link rel="shortcut icon" href="../favicon.ico"> 
<link rel="stylesheet" type="text/css" href="{{url('app/css/home/default.css')}}" />
<link rel="stylesheet" type="text/css" href="{{url('app/css/home/component.css')}}" />
<script src="{{url('app/js/home/modernizr.custom.js')}}"></script>
<script src="{{url('app/js/navlog/moment.min.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.js"></script> 
<script src="{{url('app/js/home/home.js')}}"></script>    
<script src="{{url('app/js/home/fullcalendar.js')}}"></script>
<script src="{{url('app/js/home/monthly.js')}}"></script>
<script src="{{url('app/js/home/pilot_profile.js')}}"></script>
<div class="bg-overlay"></div>
@include('includes.new_header',[])
<div class="container cust-container" ng-app="eflight" ng-controller="profileCtrl" id="profile">
    @include('includes.watchhours_modal',[])
    @include('includes.stats_modal',[])
    <div class="md-modal md-effect-1" id="modal-1">
        <div class="md-content">
            <h3 ng-bind="modalObj.title"></h3>
            <span class="modal_close md-close" ng-click="hideModal()">

                <i class="fa fa-times-circle"></i>
            </span>
            <div>
                <div class="row">
                    <div class="col-xs-12" ng-if="showEventList">
                        <div ng-if="eventsList.length == 0" class="no-event-message">
                            No events available
                        </div>
                        <ul ng-if="eventsList.length != 0">
                            <li class="li-event" ng-repeat="val in eventsList" > <span ng-bind="val.name"></span> </li>
                        </ul>
                        <div >
                            <button ng-if="eventsList.length != 0 && (eventsList[0].name!='FLIGHTS' && eventsList[0].name!='LICENSE' && eventsList[0].name!='FDTL')" class="btn newbtn_blackv1 edit-button" ng-click="edit()"> EDIT </button>

                            <button ng-if="eventsList.length == 0 || (eventsList[0].name=='FLIGHTS' || eventsList[0].name=='LICENSE' || eventsList[0].name=='FDTL')" class="btn newbtnv1 save-btn" ng-click="addEvent()"> ADD  </button>
                        </div>
                    </div>
                    <div class="col-xs-12" ng-show="showEventInput">
                        <div ng-if="showErrMessage" class="profile-calendar-event-add-error-message animated  zoomIn custdelay">
                            Please choose one   
                        </div>
                        <div class="clear-fix"></div>
                        <label class="radio-inline checkbox-label"><input type="radio" ng-model="event" value="training">Training</label>
                        <label class="radio-inline checkbox-label"><input type="radio" ng-model="event" value="week off">Week Off</label>
                        <label class="radio-inline checkbox-label"><input type="radio" ng-model="event" value="leave">Leave</label>
                       <!--  <div class="checkbox">
                            <label class="checkbox-label"><input type="radio" ng-model="event" value="training" >Training</label>
                        </div>
                        <div class="checkbox">
                            <label class="checkbox-label"><input type="radio" ng-model="event" value="week off" >Week Off</label>
                        </div>
                        <div class="checkbox">
                            <label class="checkbox-label"><input type="radio" ng-model="event" value="leave" > Leave </label>
                        </div> -->
                        <div >
                            <button class="btn newbtnv1 save-btn" ng-click="saveEvent()"> SAVE </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="md-trigger hide" data-modal="modal-1"></button>

    <div class="row">
        <div class="col-md-12 p-0">
            <p class="profile_heading">Profile</p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-2 profile-img-section p-lr-0" >
            <img src="{{url('media/images/profile/self.png')}}" class="placeholder-img-profile" />
            <div class="profile-label-section">
                <span class="profile-label hide">
                    Name:
                </span>
                <span class="profile-label-value cursor-no-drop" ng-bind="profile.name">

                </span>
                <i class="fa fa-info stats-icon" aria-hidden="true" ng-click="statsiconclick()">
                        <span class="tooltip-stats">
                            STATS
                        </span>
                    </i>
            </div>
            <div class="profile-label-section">
                <span class="profile-label">
                    SUBSCRIPTION END DATE:
                </span>
                <span class="profile-label-value ">

                    31-June-2017 (+ 10 Days) 
                    
                    
                </span>
            </div>
          <!--   <p ng-bind="profile.name"></p>
            <p>Member since <span ng-bind="profile.created_at_moment"></span></p> -->
        </div>
        <div class="col-xs-5">

            <div class="profile-label-section">
                <span class="profile-label">
                    Operator:
                </span>
                <span class="profile-label-value cursor-no-drop" ng-bind="profile.operator">

                </span>
            </div>
            <div class="profile-label-section">
                <span class="profile-label">
                    callsign:
                </span>
                <span class="profile-label-value cursor-no-drop" ng-bind="profile.user_callsigns">

                </span>
            </div>
        </div>
        <div class="col-xs-5">
            <div class="profile-label-section">
                <span class="profile-label">
                    mobile:
                </span>
                <span class="profile-label-value cursor-no-drop" ng-bind="profile.mobile_number">

                </span>
            </div>
            <div class="profile-label-section">
                <span class="profile-label">
                    Email:
                </span>
                <span class="profile-label-value cursor-no-drop" ng-bind="profile.email">

                </span>
            </div>

        </div>
    </div>
    <div class="row" style="margin-top:-144px;">
        <div class="col-xs-2">

        </div>
        <div class="col-xs-10">
            <div class="col-md-12 content_box">
                <div class="col-md-4 title_text profile-label">Fave Notams Airport List</div>
                <div class="col-md-8 p-tb-5" >
                    <div class="col-md-2 col-xs-2 p-l-0">
                        <input type="text" maxlength="3" ng-disabled="!enableField.fav_notam_aiport" class="form-control uppercase fav-input" id="aero_code_fav_notam_airport" ng-model="aero_code_fav_notam_airport">
                    </div>
                    <div class="airport-strip">
                        <div class="airport-item" ng-repeat="val in aero_code_list_fav_notam_airport" >
                            <span ng-bind="val"></span>
                             <!-- <i class="fa fa-check text-success" ng-click=""></i> -->
                            <i class="fa fa-close" ng-if="enableField.fav_notam_aiport" ng-click="removeModal($index, 'airport')"></i>
                        </div>
                        <span  ng-if="enableField.fav_notam_aiport" >
                            <i class="fa fa-check icon-green" ng-click="savefavAerodrome('fav_aerodrome_notams', 'fav_notam_aiport')" ></i>
                            <i class="fa fa-times icon-red" ng-click="closeField('fav_notam_aiport')" ></i>
                        </span>
                    </div>
                </div>

                <span class="edit_icon"  ng-if="!enableField.fav_notam_aiport"><i class="fa fa-edit" ng-click="closeField('fav_notam_aiport')"></i></span>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top:-144px;">
        <div class="col-xs-2">

        </div>
        <div class="col-xs-10">
            <div class="col-md-12 content_box">
                <div class="col-md-4 title_text profile-label">Services</div>
                <div class="col-md-8 p-tb-5">
                    <div class="col-md-2  p-l-0"><label class="checkbox-style checkbox-inline"><input type="checkbox" ng-disabled="!enableField.services"  ng-model="profile.is_fpl_flag"  >FPL</label></div>
                    <div class="col-md-2"><label class="checkbox-style checkbox-inline"><input type="checkbox" ng-disabled="!enableField.services"  ng-model="profile.is_notams_flag" >NOTAMS</label></div>
                    <div class="col-md-3"><label class="checkbox-style checkbox-inline"><input type="checkbox" ng-disabled="!enableField.services"  ng-model="profile.is_weather_flag" >WEATHER</label></div>
                    <div class="col-md-5"><label class="checkbox-style checkbox-inline"><input type="checkbox" ng-disabled="!enableField.services"  ng-model="profile.is_runway_flag" >RUNWAY ANALYSIS</label></div>
                    <div class="col-md-2 p-l-0"><label class="checkbox-style checkbox-inline"><input type="checkbox" ng-disabled="!enableField.services" ng-model="profile.is_airports_flag" >AIRPORTS</label></div>
                    <div class="col-md-2"><label class="checkbox-style checkbox-inline"><input type="checkbox" ng-disabled="!enableField.services"  ng-model="profile.is_fdtl_flag" >FDTL</label></div>
                    <div class="col-md-3"><label class="checkbox-style checkbox-inline"><input type="checkbox" ng-disabled="!enableField.services"  ng-model="profile.is_navlog_flag">NAV LOG</label></div>
                    <div class="col-md-5"><label class="checkbox-style checkbox-inline"><input type="checkbox" ng-disabled="!enableField.services"  ng-model="profile.is_lr_flag" >LICENSE REMINDER</label></div>
                </div>
                <!-- <span class="edit_icon"  ng-if="!enableField.services" ng-click="editField('services')"><i class="fa fa-edit"></i></span> -->
                <span   ng-if="enableField.services" ><i class="fa fa-check icon-green" ng-click="saveCheckBoxField('services')" ></i><i class="fa fa-times icon-red" ng-click="closeField('services')" ></i></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-2">

        </div>
        <div class="col-xs-10">


            <div class="col-md-12 content_box ">
                <div class="col-md-4 title_text profile-label">CHANGE PASSWORD</div>
                <div class="col-md-7 p-tb-5 p-r-0"> <span ng-if="!enableField.password"> ******** </span> 
                    <div ng-if="enableField.password">
                        <div class="col-md-4 p-l-0">
                            <input type="password" class="form-control" ng-model="profile.current_password" placeholder="old password" >
                        </div>
                        <div class="col-md-4 p-l-0">
                            <input type="password" class="form-control" ng-model="profile.new_password" placeholder="new password">  
                        </div>
                        <div class="col-md-4 p-lr-0">
                            <input type="password" class="form-control" ng-model="profile.confirm_password" placeholder="confirm password" >
                        </div>
                    </div>
                </div>
                <span ng-if="!enableField.password" class="edit_icon"><i class="fa fa-edit" ng-click="editField('password')"></i></span>
                <span ng-if="enableField.password" ><i class="fa fa-check icon-green" ng-click="changePassword()" ></i><i class="fa fa-times icon-red" ng-click="closeField('password')" ></i></span>
            </div>
            <div class="col-md-12 content_box hide " ng-if="enableField.password">
                <div class="col-md-4 title_text profile-label">Current Password</div>
                <div class="col-md-5 p-tb-5 "> <input type="password" class="form-control" ng-model="profile.current_password" >  </div>
                <div class="col-md-4 title_text profile-label">New Password</div>
                <div class="col-md-5 p-tb-5 "> <input type="password" class="form-control" ng-model="profile.new_password" >  </div>
                <div class="col-md-4 title_text profile-label">Confirm Password</div>
                <div class="col-md-5 p-tb-5 "> <input type="password" class="form-control" ng-model="profile.confirm_password" >  </div>
                <!-- <span class="edit_icon"><i class="fa fa-edit"></i></span> -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 divider-line"></div>
    </div>
    <div class="row">
        <div class="col-md-12 sec_mar">
            <div class="col-md-8" id="mycalendar-parent">
                <div id='mycalendar'>
                </div>
            </div>
            <div class="col-md-4 p-r-0" id='calendar1-parent'>
                <div id='calendar1'>

                </div>
            </div>
        </div>
    </div>
    <div class="row stats-strip hide">
        <div class="dash-box-n">
            <p class="dash-box-n-value"><img class="plan-till-img" src="{{url('media/images/profile/plan-till-date.png')}}">150</p>
            <p class="dash-box-n-label">PLANS FILED TILL DATE</p>
        </div>
        <div class="dash-box-n">

            <p class="dash-box-n-value">
                <img class="eflight-img" src="{{url('media/images/profile/eflight-ops.png')}}">25</p>
            <p class="dash-box-n-label">BY EFLIGHT</p>
        </div>
        <div class="dash-box-n">
            <p class="dash-box-n-value"> <img class="eflight-img" src="{{url('media/images/profile/company-ops.png')}}">150</p>
            <p class="dash-box-n-label">BY COMPANY OPS</p>
        </div>
        <div class="dash-box-n">
            <p class="dash-box-n-value"><img class="eflight-img" src="{{url('media/images/profile/self.png')}}">150</p>
            <p class="dash-box-n-label">BY SELF</p>
        </div>
        <div class="dash-box-n">
            <p class="dash-box-n-value"><img class="mobileapp-img" src="{{url('media/images/profile/laptop.png')}}">150</p>
            <p class="dash-box-n-label">THRU LAPTOP</p>
        </div>
        <div class="dash-box-n">
            <p class="dash-box-n-value"><img class="mobileapp-img" src="{{url('media/images/mobile-icon1.png')}}">25</p>
            <p class="dash-box-n-label">THRU APP</p>
        </div>
    </div>  
    <div class="row stats-strip stats-strip2 hide">


        <div class="dash-box-n dash-box-n2">
            <p class="dash-box-n-value"><img class="month-img-icon" src="{{url('media/images/profile/domestic.png')}}">150</p>
            <p class="dash-box-n-label">THIS MONTH DOMESTIC</p>
        </div>
        <div class="dash-box-n dash-box-n2">
            <p class="dash-box-n-value"><img class="month-img-icon" src="{{url('media/images/profile/intl.png')}}">150</p>
            <p class="dash-box-n-label">THIS MONTH INTL</p>
        </div>
        <div class="dash-box-n dash-box-n2">
            <p class="dash-box-n-value"><img class="year-img-icon" src="{{url('media/images/profile/year01.png')}}">150</p>
            <p class="dash-box-n-label">THIS YEAR DOMESTIC</p>
        </div>
        <div class="dash-box-n dash-box-n2">
            <p class="dash-box-n-value"><img class="year-img-icon" src="{{url('media/images/profile/year01.png')}}">150</p>
            <p class="dash-box-n-label">THIS YEAR INTL</p>
        </div>
    </div>
    <div class="hide">
        <div class="row">
            <div class="col-xs-12">
                <div class="profile-tab " ng-click="changeTab(0)" ng-class="{'profile-tab-active':tabIndex[0]}" >
                    Basic information
                </div>
                <div class="profile-tab" ng-click="changeTab(1)" ng-class="{'profile-tab-active':tabIndex[1]}">
                    Duty Calendar
                </div>
                <div class="profile-tab" ng-click="changeTab(2)" ng-class="{'profile-tab-active':tabIndex[2]}">
                    Favourites
                </div>
                <div class="profile-tab" ng-click="changeTab(3)" ng-class="{'profile-tab-active':tabIndex[3]}">
                    STATS
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-md-12 p-r-0">
                <div class="col-md-12 profile_left_sec">
                    <div ng-if="tabIndex[0] == true">
                        <div class="col-md-12 content_box">
                            <div class="col-md-4 title_text">Name</div>
                            <div class="col-md-8 p-tb-5" ng-if="!enableField.name" ng-bind="profile.name">{{$name}}</div>
                            <div class="col-md-5 p-tb-5" ng-if="enableField.name">
                                <input type="text" class="form-control "  ng-model="profile.name" >
                            </div>

                            <span class="edit_icon" ng-if="!enableField.name" ng-click="editField('name')"><i class="fa fa-edit"></i></span>
                            <span  ng-if="enableField.name" ><i class="fa fa-check icon-green" ng-click="saveField('name','{{$id}}')" ></i><i class="fa fa-times icon-red" ng-click="closeField('name')"></i></span>
                        </div>
                        <div class="col-md-12 content_box">
                            <div class="col-md-4 title_text">Call Sign</div>
                            <div class="col-md-8 p-tb-5" ng-bind="profile.user_callsigns"></div>
                            <!-- <span class="edit_icon" ><i class="fa fa-edit"></i></span> -->
                        </div>
                        <div class="col-md-12 content_box">
                            <div class="col-md-4 title_text">Operator</div>
                            <div class="col-md-8 p-tb-5" ng-bind="profile.operator"></div>
                        </div>
                        <div class="col-md-12 content_box">
                            <div class="col-md-4 title_text">Designation</div>
                            <div class="col-md-8 p-tb-5" ng-if="!enableField.user_role_id" ng-bind="profile.user_roles[profile.user_role_id - 1]"></div>
                            <div class="col-md-5 p-tb-5" ng-if="enableField.user_role_id">
                                <select class="form-control user-roles" ng-model="profile.user_role_id">
                                    <option ng-repeat="val in profile.user_roles" value="<%$index+1%>" ng-bind="val"></option>
                                </select>
                            </div>
                            <span ng-if="!enableField.user_role_id" ng-click="editField('user_role_id')" class="edit_icon" ng-click="editField('user_role_id')"><i class="fa fa-edit"></i></span>
                            <span  ng-if="enableField.user_role_id" ><i class="fa fa-check icon-green" ng-click="saveField('user_role_id','{{$id}}')" ></i><i class="fa fa-times icon-red" ng-click="closeField('user_role_id')" ></i></span>
                        </div>
                        <div class="col-md-12 content_box">
                            <div class="col-md-4 title_text">Mobile</div>
                            <div class="col-md-8 p-tb-5" ng-if="!enableField.mobile_number" ng-bind="profile.mobile_number"></div>
                            <div class="col-md-5 p-tb-5" ng-show="enableField.mobile_number">
                                <input type="text" class="form-control numbers"  maxlength="10" ng-model="profile.mobile_number" id="mobile_number" data-toggle="popover" data-placement="top">
                            </div>
                            <span ng-if="!enableField.mobile_number" ng-click="editField('mobile_number')" class="edit_icon" ng-click="editField('mobile')"><i class="fa fa-edit"></i></span>
                            <span  ng-if="enableField.mobile_number" ><i class="fa fa-check icon-green" ng-click="saveField('mobile_number','{{$id}}')"></i><i class="fa fa-times icon-red" ng-click="closeField('mobile_number')"></i></span>
                        </div>
                        <div class="col-md-12 content_box">
                            <div class="col-md-4 title_text">Email Address</div>
                            <div class="col-md-8 p-tb-5" ng-if="!enableField.email" ng-bind="profile.email"></div>
                            <div class="col-md-5 p-tb-5" ng-show="enableField.email">
                                <input type="text" class="form-control"  ng-model="profile.email" id="email" data-toggle="popover" data-placement="top" ng-change="emailChange()">
                            </div>
                            <span ng-if="!enableField.email"  ng-click="editField('email')" class="edit_icon" ng-click="editField('email')"><i class="fa fa-edit"></i></span>
                            <span  ng-if="enableField.email" ><i class="fa fa-check icon-green" ng-click="saveField('email','{{$id}}')" ></i><i class="fa fa-times icon-red" ng-click="closeField('email')" ></i></span>
                        </div>
                        <div class="col-md-12 content_box">
                            <div class="col-md-4 title_text">Fpl Signature</div>
                            <div class="col-md-8 p-tb-5"><input type="file" class="hide" file-model="profile.file" ><button class="btn btn-upload" ng-click="uploadFile()">Choose file</button> <span ng-bind="selectedFile"></span>  </div>
                            <!-- <span class="edit_icon"><i class="fa fa-edit"></i></span> -->
                        </div>
                        <div class="col-md-12 content_box">
                            <div class="col-md-4 title_text">Services</div>
                            <div class="col-md-8 p-tb-5">
                                <div class="col-md-2  p-l-0"><label class="checkbox-style checkbox-inline"><input type="checkbox" ng-disabled="!enableField.services"  ng-model="profile.is_fpl_flag"  >FPL</label></div>
                                <div class="col-md-2"><label class="checkbox-style checkbox-inline"><input type="checkbox" ng-disabled="!enableField.services"  ng-model="profile.is_notams_flag" >NOTAMS</label></div>
                                <div class="col-md-3"><label class="checkbox-style checkbox-inline"><input type="checkbox" ng-disabled="!enableField.services"  ng-model="profile.is_weather_flag" >WEATHER</label></div>
                                <div class="col-md-5"><label class="checkbox-style checkbox-inline"><input type="checkbox" ng-disabled="!enableField.services"  ng-model="profile.is_runway_flag" >RUNWAY ANALYSIS</label></div>
                                <div class="col-md-2 p-l-0"><label class="checkbox-style checkbox-inline"><input type="checkbox" ng-disabled="!enableField.services" ng-model="profile.is_airports_flag" >AIRPORTS</label></div>
                                <div class="col-md-2"><label class="checkbox-style checkbox-inline"><input type="checkbox" ng-disabled="!enableField.services"  ng-model="profile.is_fdtl_flag" >FDTL</label></div>
                                <div class="col-md-3"><label class="checkbox-style checkbox-inline"><input type="checkbox" ng-disabled="!enableField.services"  ng-model="profile.is_navlog_flag">NAV LOG</label></div>
                                <div class="col-md-5"><label class="checkbox-style checkbox-inline"><input type="checkbox" ng-disabled="!enableField.services"  ng-model="profile.is_lr_flag" >LICENSE REMINDER</label></div>
                            </div>
                            <!-- <span class="edit_icon"  ng-if="!enableField.services" ng-click="editField('services')"><i class="fa fa-edit"></i></span> -->
                            <span   ng-if="enableField.services" ><i class="fa fa-check icon-green" ng-click="saveCheckBoxField('services')" ></i><i class="fa fa-times icon-red" ng-click="closeField('services')" ></i></span>
                        </div>
                        <div class="col-md-12 content_box ">
                            <div class="col-md-4 title_text">Subscription End Date</div>
                            <div class="col-md-8 p-tb-5 subscription-end-date">31-May-2017 (<span ><strong>+ 47 Days</strong></span>)</div>
                            <!-- <span class="edit_icon"><i class="fa fa-edit"></i></span> -->
                        </div>
                        <div class="col-md-12 content_box ">
                            <div class="col-md-4 title_text">CHANGE PASSWORD</div>
                            <div class="col-md-7 p-tb-5 "> ******** </div>
                            <span ng-if="!enableField.password" class="edit_icon"><i class="fa fa-edit" ng-click="editField('password')"></i></span>
                            <span ng-if="enableField.password" ><i class="fa fa-check icon-green" ng-click="changePassword()" ></i><i class="fa fa-times icon-red" ng-click="closeField('password')" ></i></span>

                        </div>
                        <div class="col-md-12 content_box " ng-if="enableField.password">
                            <div class="col-md-4 title_text">Current Password</div>
                            <div class="col-md-5 p-tb-5 "> <input type="password" class="form-control" ng-model="profile.current_password" >  </div>
                            <div class="col-md-4 title_text">New Password</div>
                            <div class="col-md-5 p-tb-5 "> <input type="password" class="form-control" ng-model="profile.new_password" >  </div>
                            <div class="col-md-4 title_text">Confirm Password</div>
                            <div class="col-md-5 p-tb-5 "> <input type="password" class="form-control" ng-model="profile.confirm_password" >  </div>
                            <!-- <span class="edit_icon"><i class="fa fa-edit"></i></span> -->
                        </div>
                    </div>
                    <div class="row" ng-show="tabIndex[1] == true">


                        <div class="col-md-12 sec_mar">
                            <div class="col-md-8" >
                                <div id='mycalendar'>

                                </div>
                            </div>
                            <div class="col-md-4" id='calendar1'></div>
                        </div>
                    </div>

                    <div ng-if="tabIndex[2] == true">
                        <div class="col-md-12 content_box">
                            <div class="col-md-4 title_text">Fave Notams Airport List</div>
                            <div class="col-md-8 p-tb-5" >
                                <div class="col-md-2 p-l-0">
                                    <input type="text" maxlength="3" ng-disabled="!enableField.fav_notam_aiport" class="form-control uppercase fav-input" id="aero_code_fav_notam_airport" ng-model="aero_code_fav_notam_airport">
                                </div>
                                <div class="airport-strip">
                                    <div class="airport-item" ng-repeat="val in aero_code_list_fav_notam_airport" >
                                        <span ng-bind="val"></span>
                                         <!-- <i class="fa fa-check text-success" ng-click=""></i> -->
                                        <i class="fa fa-close" ng-if="enableField.fav_notam_aiport" ng-click="removeModal($index, 'airport')"></i>
                                    </div>
                                    <span  ng-if="enableField.fav_notam_aiport" >
                                        <i class="fa fa-check icon-green" ng-click="savefavAerodrome('fav_aerodrome_notams', 'fav_notam_aiport')" ></i>
                                        <i class="fa fa-times icon-red" ng-click="closeField('fav_notam_aiport')" ></i>
                                    </span>
                                </div>
                            </div>

                            <span class="edit_icon"  ng-if="!enableField.fav_notam_aiport"><i class="fa fa-edit" ng-click="closeField('fav_notam_aiport')"></i></span>
                        </div>
                        <div class="col-md-12 content_box">
                            <div class="col-md-4 title_text">Fave Wx Airport List</div>
                            <div class="col-md-8 p-tb-5">
                                <div class="col-md-2 p-l-0">
                                    <input type="text" maxlength="3" ng-disabled="!enableField.aero_code_wx" class="form-control uppercase fav-input" id="aero_code_wx" ng-model="aero_code_wx">
                                </div>
                                <div class="airport-strip">
                                    <div class="airport-item" ng-repeat="val in aero_code_list_wx" >
                                        <span ng-bind="val"></span>
                                        <i class="fa fa-close" ng-if="enableField.aero_code_wx" ng-click="removeModal($index, 'wx')"></i>

                             <!-- <i class="fa fa-check text-success" ng-click=""></i> --> <!-- <i class="fa fa-close" ng-click="removeModal($index,'wx')"></i> --></div>
                                    <span  ng-if="enableField.aero_code_wx" >
                                        <i class="fa fa-check icon-green" ng-click="savefavAerodrome('fav_aerodrome_weather', 'aero_code_wx')" ></i>
                                        <i class="fa fa-times icon-red" ng-click="closeField('aero_code_wx')" ></i>
                                    </span>
                                </div>
                            </div>
                            <span class="edit_icon" ng-if="!enableField.aero_code_wx" ng-click="closeField('aero_code_wx')"><i class="fa fa-edit"></i></span>
                        </div>
                        <div class="col-md-12 content_box">
                            <div class="col-md-4 title_text">Fave Route Notams List</div>
                            <div class="col-md-8 p-tb-5">
                                <div class="col-md-2 p-l-0">
                                    <input type="text" maxlength="3" ng-disabled="!enableField.aero_code_fav_route"  class="form-control uppercase fav-input" id="aero_code_fav_route" ng-model="aero_code_fav_route">
                                </div>
                                <div class="airport-strip">
                                    <div class="airport-item" ng-repeat="val in aero_code_list_fav_route" > 
                                        <span ng-bind="val"></span>
                                        <i class="fa fa-close" ng-if="enableField.aero_code_fav_route" ng-click="removeModal($index, 'route')"></i>
                                    </div>
                                    <span  ng-if="enableField.aero_code_fav_route" >
                                        <i class="fa fa-check icon-green" ng-click="savefavAerodrome('fav_routes', 'aero_code_fav_route')" ></i>
                                        <i class="fa fa-times icon-red" ng-click="closeField('aero_code_fav_route')" ></i>
                                    </span>
                                </div>
                            </div>
                            <span class="edit_icon" ng-if="!enableField.aero_code_fav_route" ng-click="closeField('aero_code_fav_route')"><i class="fa fa-edit"></i></span>
                        </div>

                    </div>
                    <div ng-if="tabIndex[3] == true">
                        <div class="row stats-strip">
                            <div class="dash-box-n">
                                <p class="dash-box-n-value"><img class="plan-till-img" src="{{url('media/images/profile/plan-till-date.png')}}">150</p>
                                <p class="dash-box-n-label">PLANS FILED TILL DATE</p>
                            </div>
                            <div class="dash-box-n">

                                <p class="dash-box-n-value">
                                    <img class="eflight-img" src="{{url('media/images/profile/eflight-ops.png')}}">25</p>
                                <p class="dash-box-n-label">BY EFLIGHT</p>
                            </div>
                            <div class="dash-box-n">
                                <p class="dash-box-n-value"> <img class="eflight-img" src="{{url('media/images/profile/company-ops.png')}}">150</p>
                                <p class="dash-box-n-label">BY COMPANY OPS</p>
                            </div>
                            <div class="dash-box-n">
                                <p class="dash-box-n-value"><img class="eflight-img" src="{{url('media/images/profile/self.png')}}">150</p>
                                <p class="dash-box-n-label">BY SELF</p>
                            </div>
                            <div class="dash-box-n">
                                <p class="dash-box-n-value"><img class="mobileapp-img" src="{{url('media/images/profile/laptop.png')}}">150</p>
                                <p class="dash-box-n-label">THRU LAPTOP</p>
                            </div>
                        </div>  
                        <div class="row stats-strip">

                            <div class="dash-box-n">
                                <p class="dash-box-n-value"><img class="mobileapp-img" src="{{url('media/images/mobile-icon1.png')}}">25</p>
                                <p class="dash-box-n-label">THRU APP</p>
                            </div>
                            <div class="dash-box-n">
                                <p class="dash-box-n-value"><img class="month-img-icon" src="{{url('media/images/profile/domestic.png')}}">150</p>
                                <p class="dash-box-n-label">THIS MONTH DOMESTIC</p>
                            </div>
                            <div class="dash-box-n">
                                <p class="dash-box-n-value"><img class="month-img-icon" src="{{url('media/images/profile/intl.png')}}">150</p>
                                <p class="dash-box-n-label">THIS MONTH INTL</p>
                            </div>
                            <div class="dash-box-n">
                                <p class="dash-box-n-value"><img class="year-img-icon" src="{{url('media/images/profile/year01.png')}}">150</p>
                                <p class="dash-box-n-label">THIS YEAR DOMESTIC</p>
                            </div>
                            <div class="dash-box-n">
                                <p class="dash-box-n-value"><img class="year-img-icon" src="{{url('media/images/profile/year01.png')}}">150</p>
                                <p class="dash-box-n-label">THIS YEAR INTL</p>
                            </div>
                        </div> 
                    </div>



                </div>
            </div>
        </div>

    </div>
    <div class="row hide">
        <div class="col-md-offset-1 col-md-10 p-r-0">
            <div class="col-md-12 profile_left_sec">
                <div class="col-md-12 content_box">
                    <div class="col-md-4 title_text">Name</div>
                    <div class="col-md-8 p-tb-5" ng-if="!enableField.name" ng-bind="profile.name">{{$name}}</div>
                    <div class="col-md-5 p-tb-5" ng-if="enableField.name">
                        <input type="text" class="form-control "  ng-model="profile.name" >
                    </div>

                    <span class="edit_icon" ng-if="!enableField.name" ng-click="editField('name')"><i class="fa fa-edit"></i></span>
                    <span  ng-if="enableField.name" ><i class="fa fa-check icon-green" ng-click="saveField('name','{{$id}}')" ></i><i class="fa fa-times icon-red" ng-click="closeField('name')"></i></span>
                </div>
                <div class="col-md-12 content_box">
                    <div class="col-md-4 title_text">Call Sign</div>
                    <div class="col-md-8 p-tb-5" ng-bind="profile.user_callsigns"></div>
                    <!-- <span class="edit_icon" ><i class="fa fa-edit"></i></span> -->
                </div>
                <div class="col-md-12 content_box">
                    <div class="col-md-4 title_text">Operator</div>
                    <div class="col-md-8 p-tb-5" ng-bind="profile.operator"></div>
                </div>
                <div class="col-md-12 content_box">
                    <div class="col-md-4 title_text">Designation</div>
                    <div class="col-md-8 p-tb-5" ng-if="!enableField.user_role_id" ng-bind="profile.user_roles[profile.user_role_id - 1]"></div>
                    <div class="col-md-5 p-tb-5" ng-if="enableField.user_role_id">
                        <select class="form-control user-roles" ng-model="profile.user_role_id">
                            <option ng-repeat="val in profile.user_roles" value="<%$index+1%>" ng-bind="val"></option>
                        </select>
                    </div>
                    <span ng-if="!enableField.user_role_id" ng-click="editField('user_role_id')" class="edit_icon" ng-click="editField('user_role_id')"><i class="fa fa-edit"></i></span>
                    <span  ng-if="enableField.user_role_id" ><i class="fa fa-check icon-green" ng-click="saveField('user_role_id','{{$id}}')" ></i><i class="fa fa-times icon-red" ng-click="closeField('user_role_id')" ></i></span>
                </div>
                <div class="col-md-12 content_box">
                    <div class="col-md-4 title_text">Mobile</div>
                    <div class="col-md-8 p-tb-5" ng-if="!enableField.mobile_number" ng-bind="profile.mobile_number"></div>
                    <div class="col-md-5 p-tb-5" ng-show="enableField.mobile_number">
                        <input type="text" class="form-control numbers"  maxlength="10" ng-model="profile.mobile_number" id="mobile_number" data-toggle="popover" data-placement="top">
                    </div>
                    <span ng-if="!enableField.mobile_number" ng-click="editField('mobile_number')" class="edit_icon" ng-click="editField('mobile')"><i class="fa fa-edit"></i></span>
                    <span  ng-if="enableField.mobile_number" ><i class="fa fa-check icon-green" ng-click="saveField('mobile_number','{{$id}}')"></i><i class="fa fa-times icon-red" ng-click="closeField('mobile_number')"></i></span>
                </div>
                <div class="col-md-12 content_box">
                    <div class="col-md-4 title_text">Email Address</div>
                    <div class="col-md-8 p-tb-5" ng-if="!enableField.email" ng-bind="profile.email"></div>
                    <div class="col-md-5 p-tb-5" ng-show="enableField.email">
                        <input type="text" class="form-control"  ng-model="profile.email" id="email" data-toggle="popover" data-placement="top" ng-change="emailChange()">
                    </div>
                    <span ng-if="!enableField.email"  ng-click="editField('email')" class="edit_icon" ng-click="editField('email')"><i class="fa fa-edit"></i></span>
                    <span  ng-if="enableField.email" ><i class="fa fa-check icon-green" ng-click="saveField('email','{{$id}}')" ></i><i class="fa fa-times icon-red" ng-click="closeField('email')" ></i></span>
                </div>
                <div class="col-md-12 content_box">
                    <div class="col-md-4 title_text">Fpl Signature</div>
                    <div class="col-md-8 p-tb-5"><input type="file" class="hide" file-model="profile.file" ><button class="btn btn-upload" ng-click="uploadFile()">Choose file</button> <span ng-bind="selectedFile"></span>  </div>
                    <!-- <span class="edit_icon"><i class="fa fa-edit"></i></span> -->
                </div>
                <div class="col-md-12 content_box">
                    <div class="col-md-4 title_text">Services</div>
                    <div class="col-md-8 p-tb-5">
                        <div class="col-md-2  p-l-0"><label class="checkbox-style checkbox-inline"><input type="checkbox" ng-disabled="!enableField.services"  ng-model="profile.is_fpl_flag"  >FPL</label></div>
                        <div class="col-md-2"><label class="checkbox-style checkbox-inline"><input type="checkbox" ng-disabled="!enableField.services"  ng-model="profile.is_notams_flag" >NOTAMS</label></div>
                        <div class="col-md-3"><label class="checkbox-style checkbox-inline"><input type="checkbox" ng-disabled="!enableField.services"  ng-model="profile.is_weather_flag" >WEATHER</label></div>
                        <div class="col-md-5"><label class="checkbox-style checkbox-inline"><input type="checkbox" ng-disabled="!enableField.services"  ng-model="profile.is_runway_flag" >RUNWAY ANALYSIS</label></div>
                        <div class="col-md-2 p-l-0"><label class="checkbox-style checkbox-inline"><input type="checkbox" ng-disabled="!enableField.services" ng-model="profile.is_airports_flag" >AIRPORTS</label></div>
                        <div class="col-md-2"><label class="checkbox-style checkbox-inline"><input type="checkbox" ng-disabled="!enableField.services"  ng-model="profile.is_fdtl_flag" >FDTL</label></div>
                        <div class="col-md-3"><label class="checkbox-style checkbox-inline"><input type="checkbox" ng-disabled="!enableField.services"  ng-model="profile.is_navlog_flag">NAV LOG</label></div>
                        <div class="col-md-5"><label class="checkbox-style checkbox-inline"><input type="checkbox" ng-disabled="!enableField.services"  ng-model="profile.is_lr_flag" >LICENSE REMINDER</label></div>
                    </div>
                    <!-- <span class="edit_icon"  ng-if="!enableField.services" ng-click="editField('services')"><i class="fa fa-edit"></i></span> -->
                    <span   ng-if="enableField.services" ><i class="fa fa-check icon-green" ng-click="saveCheckBoxField('services')" ></i><i class="fa fa-times icon-red" ng-click="closeField('services')" ></i></span>
                </div>
                <div class="col-md-12 content_box ">
                    <div class="col-md-4 title_text">Subscription End Date</div>
                    <div class="col-md-8 p-tb-5 subscription-end-date">31-May-2017 (<span ><strong>+ 47 Days</strong></span>)</div>
                    <!-- <span class="edit_icon"><i class="fa fa-edit"></i></span> -->
                </div>
                <div class="col-md-12 content_box ">
                    <div class="col-md-4 title_text">CHANGE PASSWORD</div>
                    <div class="col-md-7 p-tb-5 "> ******** </div>
                    <span ng-if="!enableField.password" class="edit_icon"><i class="fa fa-edit" ng-click="editField('password')"></i></span>
                    <span ng-if="enableField.password" ><i class="fa fa-check icon-green" ng-click="changePassword()" ></i><i class="fa fa-times icon-red" ng-click="closeField('password')" ></i></span>

                </div>
                <div class="col-md-12 content_box " ng-if="enableField.password">
                    <div class="col-md-4 title_text">Current Password</div>
                    <div class="col-md-5 p-tb-5 "> <input type="password" class="form-control" ng-model="profile.current_password" >  </div>
                    <div class="col-md-4 title_text">New Password</div>
                    <div class="col-md-5 p-tb-5 "> <input type="password" class="form-control" ng-model="profile.new_password" >  </div>
                    <div class="col-md-4 title_text">Confirm Password</div>
                    <div class="col-md-5 p-tb-5 "> <input type="password" class="form-control" ng-model="profile.confirm_password" >  </div>
                    <!-- <span class="edit_icon"><i class="fa fa-edit"></i></span> -->
                </div>
                <div class="col-md-12 content_box">
                    <div class="col-md-4 title_text">Fave Notams Airport List</div>
                    <div class="col-md-8 p-tb-5" >
                        <div class="col-md-2 p-l-0">
                            <input type="text" maxlength="3" ng-disabled="!enableField.fav_notam_aiport" class="form-control uppercase fav-input" id="aero_code_fav_notam_airport" ng-model="aero_code_fav_notam_airport">
                        </div>
                        <div class="airport-strip">
                            <div class="airport-item" ng-repeat="val in aero_code_list_fav_notam_airport" >
                                <span ng-bind="val"></span>
                                 <!-- <i class="fa fa-check text-success" ng-click=""></i> -->
                                <i class="fa fa-close" ng-if="enableField.fav_notam_aiport" ng-click="removeModal($index, 'airport')"></i>
                            </div>
                            <span  ng-if="enableField.fav_notam_aiport" >
                                <i class="fa fa-check icon-green" ng-click="savefavAerodrome('fav_aerodrome_notams', 'fav_notam_aiport')" ></i>
                                <i class="fa fa-times icon-red" ng-click="closeField('fav_notam_aiport')" ></i>
                            </span>
                        </div>
                    </div>

                    <span class="edit_icon"  ng-if="!enableField.fav_notam_aiport"><i class="fa fa-edit" ng-click="closeField('fav_notam_aiport')"></i></span>
                </div>
                <div class="col-md-12 content_box">
                    <div class="col-md-4 title_text">Fave Wx Airport List</div>
                    <div class="col-md-8 p-tb-5">
                        <div class="col-md-2 p-l-0">
                            <input type="text" maxlength="3" ng-disabled="!enableField.aero_code_wx" class="form-control uppercase fav-input" id="aero_code_wx" ng-model="aero_code_wx">
                        </div>
                        <div class="airport-strip">
                            <div class="airport-item" ng-repeat="val in aero_code_list_wx" >
                                <span ng-bind="val"></span>
                                <i class="fa fa-close" ng-if="enableField.aero_code_wx" ng-click="removeModal($index, 'wx')"></i>

                             <!-- <i class="fa fa-check text-success" ng-click=""></i> --> <!-- <i class="fa fa-close" ng-click="removeModal($index,'wx')"></i> --></div>
                            <span  ng-if="enableField.aero_code_wx" >
                                <i class="fa fa-check icon-green" ng-click="savefavAerodrome('fav_aerodrome_weather', 'aero_code_wx')" ></i>
                                <i class="fa fa-times icon-red" ng-click="closeField('aero_code_wx')" ></i>
                            </span>
                        </div>
                    </div>
                    <span class="edit_icon" ng-if="!enableField.aero_code_wx" ng-click="closeField('aero_code_wx')"><i class="fa fa-edit"></i></span>
                </div>
                <div class="col-md-12 content_box">
                    <div class="col-md-4 title_text">Fave Route Notams List</div>
                    <div class="col-md-8 p-tb-5">
                        <div class="col-md-2 p-l-0">
                            <input type="text" maxlength="3" ng-disabled="!enableField.aero_code_fav_route"  class="form-control uppercase fav-input" id="aero_code_fav_route" ng-model="aero_code_fav_route">
                        </div>
                        <div class="airport-strip">
                            <div class="airport-item" ng-repeat="val in aero_code_list_fav_route" > 
                                <span ng-bind="val"></span>
                                <i class="fa fa-close" ng-if="enableField.aero_code_fav_route" ng-click="removeModal($index, 'route')"></i>
                            </div>
                            <span  ng-if="enableField.aero_code_fav_route" >
                                <i class="fa fa-check icon-green" ng-click="savefavAerodrome('fav_routes', 'aero_code_fav_route')" ></i>
                                <i class="fa fa-times icon-red" ng-click="closeField('aero_code_fav_route')" ></i>
                            </span>
                        </div>
                    </div>
                    <span class="edit_icon" ng-if="!enableField.aero_code_fav_route" ng-click="closeField('aero_code_fav_route')"><i class="fa fa-edit"></i></span>
                </div>

                <!-- <div class="row stats-strip">
                    <div class="dash-box">
                        <div>
                            <i class="fa fa-info-circle dash-box-icon"></i>
                            <div class="dash-box-label">Plans Filed Till Date</div>
                        </div>
                        <div class="dash-box-value">150</div>
                    </div>

                    <div class="dash-box">
                        <div>
                            <i class="fa fa-info-circle dash-box-icon"></i>
                            <div class="dash-box-label">By EFLIGHT</div>
                        </div>
                        <div class="dash-box-value">75</div>
                    </div>
                    <div class="dash-box">
                        <div>
                            <i class="fa fa-male dash-box-icon"></i>
                            <div class="dash-box-label">By Company OPS</div>
                        </div>
                        <div class="dash-box-value">50</div>
                    </div>
                    <div class="dash-box">
                        <div>
                            <i class="fa fa-user dash-box-icon"></i>
                            <div class="dash-box-label">By SELF</div>
                        </div>
                        <div class="dash-box-value">25</div>
                    </div>
                </div> -->
                <div class="row stats-strip">
                    <div class="dash-box-n">
                        <p class="dash-box-n-value"><img class="plan-till-img" src="{{url('media/images/profile/plan-till-date.png')}}">150</p>
                        <p class="dash-box-n-label">PLANS FILED TILL DATE</p>
                    </div>
                    <div class="dash-box-n">

                        <p class="dash-box-n-value">
                            <img class="eflight-img" src="{{url('media/images/profile/eflight-ops.png')}}">25</p>
                        <p class="dash-box-n-label">BY EFLIGHT</p>
                    </div>
                    <div class="dash-box-n">
                        <p class="dash-box-n-value"> <img class="eflight-img" src="{{url('media/images/profile/company-ops.png')}}">150</p>
                        <p class="dash-box-n-label">BY COMPANY OPS</p>
                    </div>
                    <div class="dash-box-n">
                        <p class="dash-box-n-value"><img class="eflight-img" src="{{url('media/images/profile/self.png')}}">150</p>
                        <p class="dash-box-n-label">BY SELF</p>
                    </div>
                    <div class="dash-box-n">
                        <p class="dash-box-n-value"><img class="mobileapp-img" src="{{url('media/images/profile/laptop.png')}}">150</p>
                        <p class="dash-box-n-label">THRU LAPTOP</p>
                    </div>
                </div>  
                <div class="row stats-strip">

                    <div class="dash-box-n">
                        <p class="dash-box-n-value"><img class="mobileapp-img" src="{{url('media/images/mobile-icon1.png')}}">25</p>
                        <p class="dash-box-n-label">THRU APP</p>
                    </div>
                    <div class="dash-box-n">
                        <p class="dash-box-n-value"><img class="month-img-icon" src="{{url('media/images/profile/domestic.png')}}">150</p>
                        <p class="dash-box-n-label">THIS MONTH DOMESTIC</p>
                    </div>
                    <div class="dash-box-n">
                        <p class="dash-box-n-value"><img class="month-img-icon" src="{{url('media/images/profile/intl.png')}}">150</p>
                        <p class="dash-box-n-label">THIS MONTH INTL</p>
                    </div>
                    <div class="dash-box-n">
                        <p class="dash-box-n-value"><img class="year-img-icon" src="{{url('media/images/profile/year01.png')}}">150</p>
                        <p class="dash-box-n-label">THIS YEAR DOMESTIC</p>
                    </div>
                    <div class="dash-box-n">
                        <p class="dash-box-n-value"><img class="year-img-icon" src="{{url('media/images/profile/year01.png')}}">150</p>
                        <p class="dash-box-n-label">THIS YEAR INTL</p>
                    </div>
                </div>  
                <div class="row stats-strip">

                </div>  
                <!--  <div class="col-md-12 content_box">
                     <div class="col-md-4 title_text">Plans Filed Till Date</div>
                     <div class="col-md-8 p-tb-5">150</div>
                 </div>
                 <div class="col-md-12 content_box">
                     <div class="col-md-4 title_text">By EFLIGHT</div>
                     <div class="col-md-8 p-tb-5">100</div>
                 </div>
                 <div class="col-md-12 content_box">
                     <div class="col-md-4 title_text">By Company OPS</div>
                     <div class="col-md-8 p-tb-5">100</div>
                 </div>
                 <div class="col-md-12 content_box">
                     <div class="col-md-4 title_text">By SELF</div>
                     <div class="col-md-8 p-tb-5">50</div>
                 </div>
                 <div class="col-md-12 content_box">
                     <div class="col-md-4 title_text">thru LAPTOP</div>
                     <div class="col-md-8 p-tb-5">90</div>
                 </div>
                 <div class="col-md-12 content_box">
                     <div class="col-md-4 title_text">thru APP</div>
                     <div class="col-md-8 p-tb-5">60</div>
                 </div>
                 <div class="col-md-12 content_box">
                     <div class="col-md-4 title_text">This Month Domestic</div>
                     <div class="col-md-8 p-tb-5">1000</div>
                 </div>
                 <div class="col-md-12 content_box">
                     <div class="col-md-4 title_text">This Month International</div>
                     <div class="col-md-8 p-tb-5">100</div>
                 </div>
                 <div class="col-md-12 content_box">
                     <div class="col-md-4 title_text">This Year Domestic</div>
                     <div class="col-md-8 p-tb-5">2000</div>
                 </div>
                 <div class="col-md-12 content_box">
                     <div class="col-md-4 title_text">This Year International</div>
                     <div class="col-md-8 p-tb-5">200</div>
                 </div> -->
            </div>
        </div>
    </div>
    <div id="profileModal" class="modal fade">
        <div class="modal-dialog modal-container">
            <section class="popupBody modal-body">

                <div class="user_login">
                    <div class="row align-center">
                        <div class="delete-text">Do you want to delete</div>
                        <div>
                            <button class="btn  newbtnv1" type="button" ng-click="remove('<% removalIndex %>', '<% removalType %>')">Yes</button>
                            <button class="btn  newbtn_blackv1" type="button" data-dismiss="modal">No</button>  
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<div class="md-overlay"></div><!-- the overlay element -->

<!-- classie.js by @desandro: https://github.com/desandro/classie -->
<script src="{{url('app/js/home/classie.js')}}"></script>
<script src="{{url('app/js/home/modalEffects.js')}}"></script>

<!-- for the blur effect -->
<!-- by @derSchepp https://github.com/Schepp/CSS-Filters-Polyfill -->
<script>
// this is important for IEs
    var polyfilter_scriptpath = '/js/';</script>
<script src="{{url('app/js/home/cssParser.js')}}"></script>
<script src="{{url('app/js/home/css-filters-polyfill.js')}}"></script>
@include('includes.new_footer',[])

<script type="text/javascript">
    $(document).ready(function () {
    $(".m-d .monthly-indicator-wrap").each(function (index) {
    var childrens = $(this).children();
    if (childrens.length != 0) {
    $(this).parent().addClass(childrens[0].classList[1]);
    }
    });
    });
</script>
@stop