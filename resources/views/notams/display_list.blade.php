<?php 
if (env('APP_ENV') != 'local') 
ini_set('memory_limit', '512M');
?>
@extends('layouts.notam_layout',array('1'=>'1'))
@section('content')
@push('notamcss') 
        <link rel="stylesheet" type="text/css" href="{{url('/app/css/notams/view.css')}}"></link> 
        <script src="{{url('app/js/notams/notamfilter.js')}}"></script>
        <link href="{{url('app/css/select2.min.css')}}" rel="stylesheet"/>
<script src="{{url('app/js/select2.min.js')}}"></script>
@endpush 
<style type="text/css">
    .searchBox input{
    border:1px solid #989898;
    border-radius:5px;
    display: inline-block;
    line-height: 21px;
    width: 100%;
    padding:0 40px 0 5px;
}

.searchBox input::placeholder {
    font-size: 11px;
  }
.searchBox .select2-container--default.select2-container--focus .select2-selection--multiple .select2-selection .select2-selection--multiple{
    border:0 !important;
}
.searchBox{
    float: left;
    width: 40%;
    position: relative;
}
span.select2-selection.select2-selection--multiple {
    border-radius: 4px 0px 0px 5px;
    border-color: #666;
    height: 30px;
    min-height: 30px;
}
</style>
<div class="page">
    <!-- @include('includes.new_fpl_header',[]) -->
    @include('includes.new_header',[])
    <main>
        <section class="bg-1 welcome infopage" ng-app="navlog" ng-controller="notamsFilterCtrl">
            <div class="container container-notam" id="notam">
                <div class="row title marg-30">NOTAMS </div>
                <div class="row p-t-10 notam-form-section">
                    <div class="row time-label-row">
                        <div class="col-md-6 p-r-0">
                          <!--   <div class="col-md-1 reset-label" ng-click="reset()"> <span ng-if="showResetBtn" >  Reset</span>
  </div> -->
                        </div>
                        <div class="col-md-6 p-l-0">
                            <div class="col-md-6 p-lr-0 ">
                                <div class="col-md-5 p-l-0 p-r-3 label-filter" >From date</div>
                                <div class="col-md-4 p-lr-0 label-filter" >To date</div>

                            </div>
                            <div class="col-md-6 p-lr-0" >
                                <div class="col-md-5 p-lr-0 p-r-3 label-filter">From Time</div>
                                <div class="col-md-4 p-lr-0 label-filter">To Time</div>

                            </div>  
                        </div>
                    </div>
                    @if(isset($airportcode))
                    <input type="text" id="airportcode_hidden" value="{!! $airportcode !!}" style="    display: none;"/>
                    @endif
                    @if(isset($fromdate))
                    <input type="text" id="fromdate_hidden" value="{!! $fromdate !!}" style="    display: none;"/>
                    @endif
                    @if(isset($todate))
                    <input type="text" id="todate_hidden" value="{!! $fromdate !!}" style="    display: none;"/>
                    @endif
                    @if(isset($startTime))
                    <input type="text" id="startTime_hidden" value="{!! $startTime !!}" style="    display: none;"/>
                    @endif
                    @if(isset($endTime))
                    <input type="text" id="endTime_hidden" value="{!! $endTime !!}" style="    display: none;"/>
                    @endif
                    
                    <div class="row">
                        <div class="col-md-6 p-r-0">
                        </select>
                            <div class="col-md-10 p-r-0" ng-show="showAdvanceSearch==false">
                               <select id="tag_list" name="code1[]" multiple class="form-control aerodrome-input" name="code1" placeholder="Aerodrome"  ng-model="notamsFilter.airportCodeArr" autocomplete="off" data-toggle="popover" data-placement="top"  max-length="4"> </select>
                            </div>
                            <div class="col-md-10 p-r-0" ng-show="showAdvanceSearch!=false">
                                <div class="col-md-6 p-lr-0">
                                    <input type="text" class="form-control" ng-model="notamsFilter.airportcode" id="airportcode1" data-toggle="popover" data-placement="top" maxlength="4" ng-change="onAirportCodeChangeOfRadialSearch()"  placeholder="Airport code">
                                </div>
                                <div class="col-md-6 p-r-0">
                                    <input type="text" class="form-control radius-input" ng-model="notamsFilter.radius" numeric id="radius" data-toggle="popover" data-placement="top" maxlength="4" placeholder="radius in NM" ng-change="onradiusChange()">
                                </div>
                                
                            </div>
                            <div class="col-md-2 p-l-0">
                                <button class="btn search-btn" ng-click="filterNotams()">
                                <span class="glyphicon glyphicon-search"></span></button>
                            </div>
                        </div>
                        <div class="col-md-6 p-lr-0" >
                            <div class="col-md-6 p-lr-0 ">
                                <div class="col-md-5 p-l-0 p-r-3" id="from-date-block"><input type="text" class="form-control datepicker" ng-model="notamsFilter.fromdate" id="fromdate" ng-disabled="disableFromDate" ng-click="datepickerClick()"></div>
                                <div class="col-md-5 p-lr-0 " id="end-date-block"><input type="text" class="form-control notam-input-with-searchbtn datepicker to_datepicker" ng-model="notamsFilter.todate"  id="todate" ng-disabled="disableToDate" ng-click="datepickerClick()"></div>
                                <button class="btn search-btn" ng-click="filterNotams()"><span class="glyphicon glyphicon-search"></span></button>
                            </div>
                            <div class="col-md-6 p-lr-0 " style="    padding-left: 7px">
                                <div class="col-md-5 p-l-0 p-r-3" id="from-time-block"><input type="text" class="form-control " ng-model="notamsFilter.startTime1" id="startTime1" maxlength="2" ng-disabled="disableStartTime">
                                <div style="display:inline-block;" class="slash">:</div>
                                </div>
                                 <div class="col-md-5 p-l-0 p-r-3" id="from-time-block_1"><input type="text" class="form-control " ng-model="notamsFilter.startTime2" id="startTime2" maxlength="2" ng-disabled="disableStartTime"></div>
                                <div class="col-md-5 p-lr-0 " id="end-time-block"><input type="text" class="form-control notam-input-with-searchbtn  " ng-model="notamsFilter.endTime1" id="endTime1" style="padding-left:5px;" style="text-align:left; padding-left:5px;"  maxlength="2" ng-disabled="disableEndTime">
                                <div style="display:inline-block;" class="slash">:</div></div>
                                <div class="col-md-5 p-lr-0 " id="end-time-block_1"><input type="text" class="form-control notam-input-with-searchbtn  " ng-model="notamsFilter.endTime2" id="endTime2" style="padding-left:5px;" style="text-align:left; padding-left:5px;"  maxlength="2" ng-disabled="disableEndTime"></div>
                                <button class="btn search-btn" ng-click="filterNotams()"><span class="glyphicon glyphicon-search"></span></button>
                            </div>
                            <!-- <div class="col-md-6 p-lr-0" style="margin-left: -6px;">
                                <div class="col-md-5 p-lr-0 p-r-3 p-l-10"><input type="text" class="form-control" ng-model="notamsFilter.startTime" id="startTime" data-toggle="popover" data-placement="top" maxlength="4" ></div>
                                <div class="col-md-4 p-lr-0 "><input type="text" class="form-control notam-input-with-searchbtn " ng-model="notamsFilter.endTime" id="endTime" data-toggle="popover" data-placement="top" maxlength="4" ></div>
                                <button class="btn search-btn" ng-click="filterNotams()"><span class="glyphicon glyphicon-search"></span></button>
                            </div>	 -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 p-r-0">
                            <div class="col-md-11 p-l-0"></div>
                            <div class="col-md-1 p-lr-0 clear-text-parent">@if(!isset($airportcode))<span ng-if="showResetBtn" class="tooltip-clear">CLEAR TEXT</span><div ng-if="showResetBtn" class="refresh-btn" ng-click="reset()"><span class="el el-refresh refresh-icon"></span></div>@endif</div>
                        </div>
                        <div class="col-md-6 p-lr-0">
                            <div class="col-md-6 p-lr-0 ">
                            </div>
                            <div class="col-md-6 p-lr-0 utc-ist-radio-section">
                                @if(!isset($airportcode))
                                <div class="col-md-5 p-lr-0 p-r-3 "> <label class="radio-inline time-radio" ><input type="radio"  class="radio-style" ng-model="notamsFilter.timeFormat" value="utc" checked>UTC</label>
                                </div>
                                <div class="col-md-4 p-lr-0 ">      <label class="radio-inline time-radio" ><input type="radio"  class="radio-style" ng-model="notamsFilter.timeFormat" value="ist">IST</label>
                                </div>
                                @else
                                &nbsp;
                                @endif
                            </div>  
                        </div>
                    </div>

                    <div class="row" >
                        <div class="col-md-6">
                            <div class="col-md-6 p-r-0">
                                <div class="col-md-9 p-lr-0"><input type="text" class="form-control notam-input-with-searchbtn notamnumber" placeholder="Search Notam number" ng-model="notamsFilter.notamNumber" id="notamNumber" data-toggle="popover" data-placement="top" maxlength="8" ng-blur="onNotamNumberBlur()"></div>
                                <button class="btn search-btn" ng-click="filterNotams()"><span class="glyphicon glyphicon-search"></span></button>
                            </div>
                            <div class="col-md-6 p-lr-0" style="margin-left: -4px;">
                                <div class="col-md-9 p-lr-0"><input type="text" class="form-control notam-input-with-searchbtn" placeholder="Check Route Notams"  ng-model="notamsFilter.routeNotams" id="routeNotams" data-toggle="popover" data-placement="top"></div>
                                <button class="btn search-btn" ng-click="filterNotams(routenotams)"><span class="glyphicon glyphicon-search"></span></button>
                            </div>

                        </div>
                        <div class="col-md-5 p-lr-0 notam-category-parent">
                            <div class="col-md-10 notam-category p-lr-0"><input type="text" class="form-control notam-input-with-searchbtn" placeholder="Search Notam Category"  ng-model="notamsFilter.notamCategory" id="notamCategory" data-toggle="popover" data-placement="top"></div>
                            <div class="col-xs-2 notam-category-btn p-l-0"><button class="btn search-btn" ng-click="filterNotams()"><span class="glyphicon glyphicon-search"></span></button></div>
                        </div>
                        <div class="col-md-1 p-lr-0 reset-btn-parent">
                            <button class="btn newbtnv1  reset-btn" ng-if="showResetBtn" ng-click="reset()">RESET</button>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="advance-search" >
                               <!--  <label class="radio-inline time-radio">
                                <input type="radio"  ng-model="notamsFilter.searchType" ng-click="searchTypeChange(notamsFilter.searchType)" value="normal"> Normal Search
                               </label>  --><!-- <label class="radio-inline time-radio"><input type="radio"  ng-model="notamsFilter.searchType"  ng-click="searchTypeChange(notamsFilter.searchType)" value="radial"> Radial Search</label> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dt_loading"><i style="width:100%;text-align:center;margin-top:18px;color:#f1292b" class="fa-2x fa fa-spinner fa-spin"></i></div>

                <div class="row" ng-if="responseData">

                    <div class="wheather_sec p-t-10">
                        <div class="tabs animated-slide-2">
                            <div ng-if="responseData.notams_array.length == 0" class="no-data">
                                        NO NOTAMS FOUND
                                    </div>
                            <div class="tab-section">
                                <div class="pdf-download" ng-if="showSaveAll">
                                    <img  src="{{url('/media/images/download-all.png')}}" ng-click="downloadAll()">
                                    <span class="tooltip-save-all">SAVE ALL</span>
                                </div>
                                <div class="tab-item" ng-class="{'m-l-0':responseData.notams_array.length==1}"   ng-repeat="val in responseData.notams_array" >
                                <div class="aero-code-tab"    ng-click="changeTab($index, val.aero_code)" ng-class="{'active-tab':tabContentFlagArr[$index] == true}"> <% val.aero_code %> (<% val.result.length %>) </div>
                                <div class="pdf-btn" ng-click="downloadNotams(val.aero_code)" ><img src="{{url('media/ananth/images/pdf.png')}}" class="img-responsive" alt="pdf"></div>
                                    
                                </div>
                                <!-- <div class="pdf-download" ng-if="showSaveAll"><i class="fa fa-arrow-circle-o-down icon" ng-click="downloadAll()"></i><span class="tooltip-save-all">SAVE ALL PDF</span>

                                </div> -->

                            </div>
                            <div class="tab-content">
                                <div class="tab" id="<%val.aero_code%>" ng-repeat="val in responseData.notams_array" ng-class="{'hide':tabContentFlagArr[$index] == false}">

                                    
                                    <div class="notam-strip row" ng-repeat="item in val.result">
                                        <div  class="col-sm-5 margin-0 p-l-0">
                                            <div class="p-l-0 col-sm-1 notam-no" ng-bind="item.notam_no">

                                            </div>
                                        </div>  
                                        <div class="col-sm-7 p-r-0 margin-0 p-l-0">
                                            <span class="qline"><span ng-if="item.decoded_qline != 'NA'">CATEGORY:</span><span ng-if="item.decoded_qline == 'NA'">&nbsp;</span> <span ng-if="item.decoded_qline != 'NA'" ng-bind="item.decoded_qline"></span>  </span>
                                        </div>
                                          
                                        <div class="col-sm-12  p-r-0 margin-0 p-l-0" style="margin-top:5px; line-height: 1.0;font-weight:bold;">
                                            <span class="to-date p-lr-0">  FROM:  <span ng-bind="item.e_start_date_formatted"></span></span> 
                                            <span class="to-date p-lr-0" ng-if="item.e_end_date_formatted == '31-Dec-9999'">  TO: PERMANENT </span>
                                            <span class="to-date p-lr-0" ng-if="item.e_end_date_formatted != '31-Dec-9999'">  TO: <span ng-bind="item.e_end_date_formatted"></span></span>
                                        </div>
                                        <div class="col-sm-12 margin-0  time-strip p-l-0" ng-if="item.formatted_time" ng-repeat="val in item.formatted_time"><span class="col-xs-3 p-lr-0" style="width:auto;white-space: pre;" ng-if="$index==0">TIME : </span> <span class="col-xs-3 p-lr-0" style="width:auto;white-space: pre;" ng-if="$index!=0" ng-style="$index!=0 &&{'visibility': 'hidden'}">TIME : </span> <span ng-bind="val.time" class="time-content"></span> </div>  
                                        <div class="col-sm-12 margin-0 margin-b-5 time-strip  p-l-0" ng-if="item.height">
                                            <div> HEIGHT: <span ng-bind="item.height"></span> ALTITUDE: <span ng-bind="item.level"></span>
                                            </div>  
                                        </div>
                                        <div class="col-sm-12  margin-0 desc p-lr-0 " ng-bind="item.description">  </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        
                        <!-- <div id='v_toTop_mid'><span></span></div>	 -->
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
        $(document).on('keypress','.select2-search__field',function(){
          var array=$("#tag_list").select2('val');
          if(array!=null){
             if(array.length>=7){
               return false;
             }
           }
       });
    </script>

    @include('includes.new_footer',[])
</div>
@stop