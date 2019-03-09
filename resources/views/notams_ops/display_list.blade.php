@extends('layouts.notam_layout',array('1'=>'1'))
@section('content')
<!-- <link rel="stylesheet" type="text/css" href="{{url('/app/css/navlog/common.css')}}"> -->

<style type="text/css">
    .notam-strip{
        width: 100%;
        margin: 7px 0px;
        padding: 7px 7px;
        border: 1px solid #d5d5d5;
        float: left;
        border-radius: 5px;
        font-size: 13px;
        font-family: 'pt_sansregular';
        background: #fff;
        margin-right: 0;
    }
    .to-date{
        text-align: right;
        text-transform: uppercase;
    }
    .margin-0{
        margin: 0;
    }
    .margin-b-5{
        margin-bottom: 5px;
    }
    .p-l-0 {
        padding-left:0;
    }
    .p-r-0 {
        padding-right:0;
    }
    .p-lr-0 {
        padding-left:0;
        padding-right:0;
    }
    .desc{
        text-align: justify;
        font-weight: bold;
        font-size: 14px;
        line-height: 1.2;
        margin-top:5px !important; 
    }
    .time-strip{
        line-height: 1.3;
    }
    .height-strip{
        margin-top: 5px !important;
    }
    .container-notam{
        background: #fff;
        margin-bottom: 15px;
        width: 900px !important;
    }
    .aerodrome_name{
        padding: 4px 4px 4px 15px;
        background: #a6a6a6;
        background: -moz-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        background: -webkit-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        background: -o-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        background: -ms-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        clear: both;
        color: #fff;
        font-weight: bold;
        font-size: 14px;
        margin-bottom: 10px;
    }
    .qline{
        margin-left: 10px;
        font-size: 13px;
        float: right;
    }
    .col{
        width: 21%;
    }
    .p-lr-15{
        padding-left: 15px;
        padding-right: 15px;
    }
    .p-l-10{
        padding-left: 10px;
    }
    .p-l-3{
        padding-left: 3px;
    }
    .p-r-3{
        padding-right: 3px;
    }
    #notam input[type=text]{
        height: 30px;
        text-align: left;
        text-transform: uppercase;
        font-weight: bold;
    }
    #notam input:focus{
        border: 1px solid #f1292b ;
    }
    .form-control{
        border: 1px solid #999 ;
    }

    .input-group-addon{
        /*position: absolute;*/
        top: 0px;
        right: 0;
    }
    .p-t-10{
        padding-top: 10px;
    }

    .search-btn{
        width: 40px;
        height: 30px;
        padding: 6px 3px;
        transition: all 0.25s ease;
        overflow: hidden;
        display: inline-block;
        margin-bottom: 0;
        color: #fff;
        font-size: 14px;
        line-height: 20px;
        font-weight: 300;
        text-transform: uppercase;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        border: none;
        background: #555;
        z-index: 1;
        border-radius: 0 4px 4px 0;
    }
    .search-btn:hover:before {
        visibility: visible;
        width: 200%;
        left: -46%;
    }
    .search-btn:before {
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
        /*background: #333;*/
        background: #F26232;
        background: linear-gradient(to top, #fa9b5b, #F26232);
        background: #f1292b;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f37858', endColorstr='#f1292b');
        background: -webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b));
        background: -moz-linear-gradient(top, #f37858, #f1292b);

        z-index: -1;
        color:#fff;
    }
    .search-btn:hover{
        box-shadow: none !important;
    }
    ::-webkit-input-placeholder {
        text-align:left;   
        font-size: 11px;
        text-transform:uppercase; 
        color:#666 !important;
    }

    :-moz-placeholder { /* Firefox 18- */
        text-align:left;  
        font-size: 11px;
        text-transform:uppercase; 
        color:#666 !important;
    }

    ::-moz-placeholder {  /* Firefox 19+ */
        text-align:left;  
        font-size: 11px;
        text-transform:uppercase; 
        color:#666 !important;
    }

    :-ms-input-placeholder {  
        text-align:left;   
        font-size: 11px;
        text-transform:uppercase;
        color:#666 !important;
    }
    #from-date-block{
        width: 40%;
    }
    #end-date-block{
        width: 40%;
        padding-left: 3px;
    }
    #from-time-block{
        width: 36%;
    }
    #from-time-block input[type=text]{
        text-align: center;
    }
    #end-time-block{
        width: 35%;
        padding-left: 3px;
    }
    #end-time-block input[type=text]{
        text-align: center;
    }
    #from-date-block .ui-datepicker-trigger {
        right: 20px;
    }
    #from-date-block .datepicker{
        font-size: 11px;
        text-align: left;
        padding-left: 12px;

    } 
    #end-date-block .datepicker{
        font-size: 11px;
        text-align: left;
        padding-left: 9px;

        text-align: left;
        padding-left: 12px; 
    } 
    .time-label-row{
        line-height: 1.2;
    }
    .ui-datepicker-trigger {
        right: 5px;
        height: 21px;
        top: 6px;
        position: absolute;
        z-index: 2;
        cursor: pointer;
        display: none;
    }
    .notam-input-with-searchbtn{
        border-radius: 4px 0px 0px 4px !important;
    }
    .popover-content {
        font-family: 'pt_sansregular';
    }

    .popover {
        width: 250px;
        background-color: #333;
        border: #eeeeee solid 2px;
        font-family: 'pt_sansregular';
        margin-top: 0px;
        text-align: center;
        color: white
    }
    #v_toTop {
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: none;
        background: url('media/images/home/totop.png') no-repeat;
        width: 28px;
        height: 28px;
        cursor: pointer;
        z-index: 999999;
    }
    #v_toTop:hover {
        background: url('media/images/home/totop2.png') no-repeat;
        width: 28px;
        height: 28px;
        cursor: pointer;
    }
    #v_toTop_mid {
        position: fixed;
        bottom: 90px;
        right: 58px;
        display: none;
        background: url('media/images/home/totop.png') no-repeat;
        width: 28px;
        height: 28px;
        cursor: pointer;
        z-index: 999999;
    }
    #v_toTop_mid:hover {
        background: url('media/images/home/totop2.png') no-repeat;
        width: 28px;
        height: 28px;
        cursor: pointer;
    }
    .utc-ist-radio-section{
        margin-left: -6px;
        text-align: center;
        margin-top: -3px;
        margin-bottom: 3px;
    }
    .title {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 30px;
        color: #fff;
        font-weight: 600;
        background: #a6a6a6;
        border-radius: 4px 4px 0px 0px;
        background: -moz-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        background: -webkit-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        background: -o-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        background: -ms-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6a6a6', endColorstr='#a6a6a6', GradientType=1 );
    }
    .label-filter{
        font-size: 11px;
        text-align: center;
        text-transform: uppercase;
    }
    .notam-form-section{ 
        box-shadow: 3px 3px 12px 0px #999;
        border-radius: 3px !important;
        padding-bottom: 23px;
    }

    .time-radio{
        font-size: 11px;
    }
    .radio-style{
        height: 55%;
        margin-left: -14px !important;
        margin-top: 5px !important;
    }

    .no-data{
        text-align: center;
        font-size: 16px;
        font-family: 'pt_sansregular';
        color: #f1292b;
    }
    .aero-code-tab{
        display: inline-block;
        width: 12%;
        text-align: center;
        padding: 3px;
        font-size: 14px;
        font-weight: normal;
        height: 25px;
        cursor: pointer;
        color: #000;
        background: #c9c9c9;
        border-right: 1px solid #fff;
        border-radius: 5px;
        margin-right:0.5%; 
        font-weight: bold;
    }
    .pdf-download{
        border-right: 0;
        margin-right:0; 
        float: right;
        width: auto;
        background: #fff;
        cursor: pointer;
        position: relative;
        vertical-align: middle;
    }
    .pdf-download .icon{
        color: #f1292b;
        font-size: 23px;
    }
    .tab-section{
        /*background: #c9c9c9;*/
        text-transform: uppercase;
        color: #fff;
        font-weight: bold;
        margin: 0 15px;
        border-radius: 5px;

    }
    .active-tab{
        background: #F26232;
        background: linear-gradient(to top, #fa9b5b, #F26232);
        background: #f1292b; /* for non-css3 browsers */
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f37858', endColorstr='#f1292b'); /* for IE */
        background: -webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b)); /* for webkit browsers */
        background: -moz-linear-gradient(top, #f37858, #f1292b); /* for firefox 3.6+ */
        border-radius: 5px;
        color: #fff;
    }
    .pdf-download:hover{
        background: transparent ;
    }
    .aero-code-tab:hover{
        background: #333;
        color: #fff;
    }
    .download-all{
        text-align: left;
        padding-left: 15px;
        vertical-align: middle;
        cursor: pointer;
        margin-top: 15px;
        font-size: 14px;
        text-transform: uppercase;
    }
    .download-all img{
        display: inline-block;
        width: 15px;
        cursor: pointer;
        margin-right: 3px;
        margin-top: -3px;
    }
    .pdf-download:hover .tooltip-save-all{
        visibility: visible;
    }

    .tooltip-save-all{
        width: 72px;
        position: absolute;
        left: -23px;
        bottom: 26px;
        padding: 0px 5px;
        color: #eee;
        border-radius: 4px;
        visibility: hidden;
        font-size: 10px;
        font-weight: normal;
        box-shadow: 0 0 1px 1px #ccc;
        background: #333333;
    }
    .tooltip-clear{
            width: 69px;
    position: absolute;
    left: -11px;
    bottom: 26px;
    padding: 0px 8px;
    color: #eee;
    border-radius: 4px;
    visibility: hidden;
    font-size: 10px;
    font-weight: normal;
    box-shadow: 0 0 1px 1px #ccc;
    background: #333333;
    z-index: 5;
    }
    .clear-text-parent:hover .tooltip-clear{
        visibility: visible;
    }
    .refresh-btn{
        border-radius: 4px;
        text-align: center;
        cursor: pointer;
    }
    .refresh-icon{
        color: #f1292b;
        font-size: 20px;
    }

</style>
<div class="page">
    @include('includes.new_fpl_header',[])
    <main>
        <section class="bg-1 welcome infopage" ng-app="navlog" ng-controller="notamsFilterCtrl">
            <div class="container container-notam" id="notam">
                <div class="row title marg-30">NOTAMS </div>
                <div class="row p-t-10 notam-form-section">
                    <div class="row time-label-row">
                        <div class="col-md-6 p-r-0">

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
                    
                    <div class="row">
                        <div class="col-md-6 p-r-0">
                            <div class="col-md-10 p-r-0">
                                <input type="text" class="form-control notam-input-with-searchbtn airportcodevalid" ng-model="notamsFilter.airportcode" id="airportcode" placeholder="Enter Airport or FIR ICAO Codes" data-toggle="popover" data-placement="top" maxlength="34" ></div><div class="col-md-2 p-l-0"><button class="btn search-btn" ng-click="filterNotams()">
                                <span class="glyphicon glyphicon-search"></span></button></div>
                        </div>
                        <div class="col-md-6 p-l-0" >
                            <div class="col-md-6 p-lr-0 ">
                                <div class="col-md-5 p-l-0 p-r-3" id="from-date-block"><input type="text" class="form-control datepicker" ng-model="notamsFilter.fromdate" id="fromdate"></div>
                                <div class="col-md-5 p-lr-0 " id="end-date-block"><input type="text" class="form-control notam-input-with-searchbtn datepicker to_datepicker" ng-model="notamsFilter.todate"  id="todate"></div>
                                <button class="btn search-btn" ng-click="filterNotams()"><span class="glyphicon glyphicon-search"></span></button>
                            </div>
                            <div class="col-md-6 p-lr-0 " style="    padding-left: 7px">
                                <div class="col-md-5 p-l-0 p-r-3" id="from-time-block"><input type="text" class="form-control " ng-model="notamsFilter.startTime" id="startTime" maxlength="4"></div>
                                <div class="col-md-5 p-lr-0 " id="end-time-block"><input type="text" class="form-control notam-input-with-searchbtn  " ng-model="notamsFilter.endTime" id="endTime" style="text-align:left; padding-left:5px;" style="text-align:left; padding-left:5px;"  maxlength="4"></div>
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
                            <div class="col-md-1 p-lr-0 clear-text-parent"><span ng-if="showResetBtn" class="tooltip-clear">CLEAR TEXT</span><div ng-if="showResetBtn" class="refresh-btn" ng-click="reset()"><span class="el el-refresh refresh-icon"></span></div></div>
                        </div>
                        <div class="col-md-6 p-l-0">
                            <div class="col-md-6 p-lr-0 ">
                            </div>
                            <div class="col-md-6 p-lr-0 utc-ist-radio-section">
                                <div class="col-md-5 p-lr-0 p-r-3 "> <label class="radio-inline time-radio" ><input type="radio" name="optradio" class="radio-style" checked>UTC</label>
                                </div>
                                <div class="col-md-4 p-lr-0 ">      <label class="radio-inline time-radio" ><input type="radio" name="optradio" class="radio-style" >IST</label>
                                </div>
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
                                <button class="btn search-btn" ng-click="filterNotams('routenotams')"><span class="glyphicon glyphicon-search"></span></button>
                            </div>

                        </div>
                        <div class="col-md-6 p-lr-0">
                            <div class="col-md-10 p-lr-0"><input type="text" class="form-control notam-input-with-searchbtn" placeholder="Search Notam Category"  ng-model="notamsFilter.notamCategory" id="notamCategory" data-toggle="popover" data-placement="top"></div>
                            <div class="col-xs-2 p-l-0"><button class="btn search-btn" ng-click="filterNotams()"><span class="glyphicon glyphicon-search"></span></button></div>
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
                                <div class="aero-code-tab"   ng-repeat="val in responseData.notams_array" ng-click="changeTab($index, val.aero_code)" ng-class="{'active-tab':tabContentFlagArr[$index] == true}"><% val.aero_code %> (<% val.result.length %>) <a ng-click="downloadNotams(val.aero_code)"><img style="display: inline-block;width: 14px;cursor: pointer;margin-top: -2px;" src="{{url('media/ananth/images/pdf.png')}}" class="img-responsive" alt="pdf"></a></div>
                                <div class="pdf-download" ng-if="responseData.notams_array.length > 1"><i class="fa fa-arrow-circle-o-down icon" ng-click="downloadAll()"></i><span class="tooltip-save-all">SAVE ALL PDF</span>

                                </div>

                            </div>
                            <div class="tab-content">
                                <div class="tab" id="<%val.aero_code%>" ng-repeat="val in responseData.notams_array" ng-class="{'hide':tabContentFlagArr[$index] == false}">

                                    
                                    <div class="notam-strip row" ng-repeat="item in val.result">
                                        <div  class="col-sm-5 margin-0 p-l-0">
                                            <div class="p-l-0 col-sm-1" ng-bind="item.notam_no">

                                            </div>
                                        </div>  
                                        <div class="col-sm-7 p-r-0 margin-0 p-l-0">
                                            <span class="qline"><span ng-if="item.decoded_qline != 'NA'">CATEGORY:</span><span ng-if="item.decoded_qline == 'NA'">&nbsp;</span> <span ng-if="item.decoded_qline != 'NA'" ng-bind="item.decoded_qline"></span>  </span>
                                        </div>
                                        <div class="col-sm-12  margin-0 desc p-lr-0" ng-bind="item.description">  </div>  
                                        <div class="col-sm-12  p-r-0 margin-0 p-l-0" style="margin-top:5px; line-height: 1.0;">
                                            <span class="to-date p-lr-0">  FROM:  <span ng-bind="item.e_start_date_formatted"></span></span> 
                                            <span class="to-date p-lr-0" ng-if="item.e_end_date_formatted == '31-Dec-9999'">  TO: PERMANENT </span>
                                            <span class="to-date p-lr-0" ng-if="item.e_end_date_formatted != '31-Dec-9999'">  TO: <span ng-bind="item.e_end_date_formatted"></span></span>
                                        </div>
                                        <div class="col-sm-12 margin-0 margin-b-5 time-strip p-l-0" ng-if="item.time">TIME: <span ng-bind="item.time"></span> </div>  
                                        <div class="col-sm-12 margin-0 margin-b-5 height-strip p-l-0" ng-if="item.height">
                                            <div> HEIGHT: <span ng-bind="item.height"></span> ALTITUDE: <span ng-bind="item.level"></span>
                                            </div>  
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="p-lr-15 hide" ng-repeat="val in responseData.notams_array" >

                            <div class="row aerodrome_name" ng-if="val.result">
                                <% val.airport %>  <span class="p-l-25"><% val.result.length %> NOTAMS </span>
                                <a href="{{url('notams/download')}}/<% val.aero_code %>"><img style="display: inline-block;width: 18px;" src="{{url('media/ananth/images/pdf.png')}}" class="img-responsive" alt="pdf"></a>
                            </div> 
                            <div ng-if="val.result.length == 0" class="no-data">
                                NO MATCHING RECORDS FOUND
                            </div>
                            <div class="notam-strip row" ng-repeat="item in val.result">
                                <div  class="col-sm-6 margin-0 p-l-0">
                                    <div class="p-l-0 col-sm-1" ng-bind="item.notam_no">

                                    </div>
                                    <!-- <div class="col-sm-10 p-r-0 margin-0">
                                        <span class="col-sm-6 to-date p-lr-0">	FROM:  <span ng-bind="item.e_start_date_formatted"></span></span> 
                                        <span class="col-sm-6 to-date p-lr-0" ng-if="item.e_end_date_formatted == '31-Dec-9999'">  TO: PERMANENT </span>
                                        <span class="col-sm-6 to-date p-lr-0" ng-if="item.e_end_date_formatted != '31-Dec-9999'">  TO: <span ng-bind="item.e_end_date_formatted"></span></span>
                                    </div> -->
                                </div>  
                                <div class="col-sm-6 p-r-0 margin-0 p-l-0">
                                    <span class="qline"><span ng-if="item.decoded_qline != 'NA'">CATEGORY:</span><span ng-if="item.decoded_qline == 'NA'">&nbsp;</span> <span ng-if="item.decoded_qline != 'NA'" ng-bind="item.decoded_qline"></span>  </span>
                                </div>
                                <div class="col-sm-12  margin-0 desc p-lr-0" ng-bind="item.description">  </div>  
                                <div class="col-sm-12  p-r-0 margin-0 p-l-0" style="margin-top:5px;">
                                    <span class="to-date p-lr-0">  FROM:  <span ng-bind="item.e_start_date_formatted"></span></span> 
                                    <span class="to-date p-lr-0" ng-if="item.e_end_date_formatted == '31-Dec-9999'">  TO: PERMANENT </span>
                                    <span class="to-date p-lr-0" ng-if="item.e_end_date_formatted != '31-Dec-9999'">  TO: <span ng-bind="item.e_end_date_formatted"></span></span>
                                </div>
                                <div class="col-sm-12 margin-0 margin-b-5 time-strip p-l-0" ng-if="item.time">TIME: <span ng-bind="item.time"></span> </div>  
                                <div class="col-sm-12 margin-0 margin-b-5 height-strip p-l-0" ng-if="item.height">
                                    <div> HEIGHT: <span ng-bind="item.height"></span> ALTITUDE: <span ng-bind="item.level"></span>
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
    </script>

    @include('includes.new_footer',[])
</div>
@stop