@extends('layouts.notam_layout',array('1'=>'1'))
@section('content')
<link rel="stylesheet" type="text/css" href="{{url('/app/css/weather.css')}}">
<style type="text/css">
    /* Common styles */
    .p-l-6{
        padding-left: 6px;
    }
    .p-r-6{
        padding-right: 6px;
    }

    /* End*/
    .notam-strip{
        width: 98%;
        margin: 7px 3px;
        padding: 7px 7px;
        border: 1px solid #ccc;
        float: left;
        box-shadow: -1px 1px 7px 2px #ccc;
        font-size: 12px;
        font-family: pt_sansregular;
        background: #fff;
    }
    .to-date{
        /*text-align: right;*/
    }
    .margin-0{
        margin: 0;
    }
    .margin-b-5{
        margin-bottom: 5px;
    }
    .fa-spinner{
        color: #f1292b;
        margin-left: 10px;
        display: none;
    }
    .desc{
        text-align: justify;
        font-style: italic;
        font-size: 13px;
    }
    .container-notam{
        background: #fff;
        margin-bottom: 15px;
        width: 825px !important;
        margin-top: 10px;
    }
    .fir-box{
        height: 30px;
        border: 1px solid #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        background: #333;
        border-radius: 5px;
        color: #fff;
    }
    .fir-box:hover{
        /*background: #f1292b;*/
        -moz-transition: 2s all ease;
        -o-transition: 2s all ease;
        -webkit-transition: 2s all ease;
        transition: 2s all ease;
        color: #fff;
    }
    .update-text{
        font-size: 12px;
        font-weight: normal;
        color: #000;
        text-align: center;
        font-style: italic;
        line-height: 1.4;
    }
    .update-content{
        font-size: 13px;
        padding-left: 4px;
        font-weight: bold;
        color: #f1292b;
        font-style: normal;
    }
    .updated-time{
        font-size: 11px;
        padding-left: 4px;
        font-weight: bold;
        font-style: normal;
    }
    .col{
        width: 21%;
    }
    a:focus, a:hover{
        color: #f1292b;
    }

    .cust_btn_v {
        width: 100%;
        /*margin-top:25px;*/
        transition: all 2s ease;
        overflow: hidden;
        position: relative;
        /*display: inline-block;
        margin-bottom: 0;
        color: #fff;*/
        /*font-size: 14px;*/
        /*line-height: 20px;*/
        /*font-weight: 300;*/
        text-transform: uppercase;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        /*border: none;*/
        /*background: #F26232;*/
        /* background: linear-gradient(to top, #fa9b5b, #F26232); */
        /*background: #f1292b;*/
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f37858', endColorstr='#f1292b');
        /* background: -webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b));
         background: -moz-linear-gradient(top, #f37858, #f1292b);
        */ z-index: 1;
        /*border-radius: 4px;*/
    }

    .cust_btn_v:hover:before {
        visibility: visible;
        width: 200%;
        left: -46%;
    }

    .cust_btn_v:before {
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
        background: #F26232;
        background: linear-gradient(to top, #fa9b5b, #F26232); 
        background: #f1292b;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f37858', endColorstr='#f1292b');
        background: -webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b));
        background: -moz-linear-gradient(top, #f37858, #f1292b);
        z-index: -1;
        color:#fff;
    }
    .cust_btn_v:hover {
        /*color: #333;*/
        font-weight: bold;
    }
    .airport-name-section{
        font-weight: normal;
        font-size: 12px;
        word-spacing: 1px;
    }

    .airport-notam-count{
        color: #f1292b;
    }
    .airport-notam-count:hover{
        /*border-bottom: 1px solid #f1292b;*/
    }
    .p-lr-0{
        padding-left:0px;
        padding-right: 0px; 
    }
    .p-lr-15{
        padding-left:15px;
        padding-right: 15px; 
    }
    .aero-code-item{
        width: 33.67px;
        display: inline-block;
        color: #000;
    }
    .aero-code-item-td{
        position: relative;
    }
    .aero-code-item-td:hover .tooltip-edit{
        visibility: visible;
    }
    .aero-code-item-td:hover .airport-notam-count{
        text-decoration: underline;
    }
    .tooltip-edit{
        position: absolute;
        left: 0;
        bottom: 17px;
        padding: 0px 9px;
        color: #eee;
        border-radius: 4px;
        visibility: hidden;
        font-size: 11px;
        font-weight: normal;
        box-shadow: 0 0 1px 1px #ccc;
        background: #333333;
        /* height: 15px; */
        /* line-height: 1.5; */

    }
    table{
        width: 100%;
    }
    p {
        margin: 0 0 10px;
    }
</style>
<script>
    $(function () {
        $('.fetch').click(function () {
            $('.fa-spinner').css('display', 'inline-block');
            $('.notify-bg').css('display', 'block');
            $('.notification-block .notfications').css('z-index', '1');
        })
        $('.notify-bg').click(function () {
            $('.fa-spinner').css('display', 'none');
            $('.notification-block .notfications').css('z-index', '999999');
        })
    });
</script>
<div class="page">
    @include('includes.new_fpl_header',[])
    <main>
        <section class="welcome infopage" ng-app="navlog" ng-controller="notamsCtrl">
            <div class="container container-notam">
                <div class="row">
                    <div class="wheather_sec">
                        <div class="p-l-15 p-10 col-xs-12" style="font-weight: bold;color: black">
                            <div class="col-xs-3 p-l-6 p-r-6">
                                <p class="fir-box cust_btn_v" ng-click="fetchNotamBasedOnFir('vi')">VIDF (DELHI REGION)</button>
                                <p class="update-text">NEW NOTAMS UPDATED:<a href="{{url('/notams/getrecentnotam?id=vi')}}&count=<%newlyAddedCountVi%>" target="_blank" class="update-content" ng-bind="newlyAddedCountVi"></a></p>
                                <p class="update-text">TOTAL NUMBER OF NOTAMS:<a href="{{url('/notams/getnotambyfir?id=vi')}}" target="_blank" class="update-content" ng-bind="totalCountVi"></a></p>
                                <p class="update-text">Last updated: <span class="updated-time" ng-bind="lastUpdatedTimeVi"></span></p>
                            </div>
                            <div class="col-xs-3 p-l-6 p-r-6">
                                <p type="button" class="fir-box cust_btn_v" ng-click="fetchNotamBasedOnFir('ve')"> VECF (KOLKATA REGION)</p>
                                <p class="update-text">NEW NOTAMS UPDATED:<a href="{{url('/notams/getrecentnotam?id=ve')}}&count=<%newlyAddedCountVe%>" target="_blank" class="update-content" ng-bind="newlyAddedCountVe"></a></p>
                                <p class="update-text">TOTAL NUMBER OF NOTAMS:<a href="{{url('/notams/getnotambyfir?id=ve')}}" target="_blank" class="update-content" ng-bind="totalCountVe"></a></p>
                                <p class="update-text">Last updated: <span class="updated-time" ng-bind="lastUpdatedTimeVe"></span></p>
                            </div>
                            <div class="col-xs-3 p-l-6 p-r-6">
                                <p type="button" class="fir-box cust_btn_v" ng-click="fetchNotamBasedOnFir('va')">VABF (MUMBAI REGION)</p>
                                <p class="update-text">NEW NOTAMS UPDATED:<a href="{{url('/notams/getrecentnotam?id=va')}}&count=<%newlyAddedCountVa%>" target="_blank" class="update-content" ng-bind="newlyAddedCountVa"></a></p>
                                <p class="update-text">TOTAL NUMBER OF NOTAMS:<a href="{{url('/notams/getnotambyfir?id=va')}}" target="_blank" class="update-content" ng-bind="totalCountVa"></a></p>
                                <p class="update-text">Last updated: <span class="updated-time" ng-bind="lastUpdatedTimeVa"></span></p>
                            </div>
                            <div class="col-xs-3 p-l-6 p-r-6">
                                <p type="button" class="fir-box cust_btn_v" ng-click="fetchNotamBasedOnFir('vo')">VOMF (CHENNAI REGION)</p>
                                <p class="update-text">NEW NOTAMS UPDATED:<a href="{{url('/notams/getrecentnotam?id=vo')}}&count=<%newlyAddedCountVo%>" target="_blank" class="update-content" ng-bind="newlyAddedCountVo"></a></p>
                                <p class="update-text">TOTAL NUMBER OF NOTAMS:<a href="{{url('/notams/getnotambyfir?id=vo')}}" target="_blank" class="update-content" ng-bind="totalCountVo"></a></p>
                                <p class="update-text">Last updated: <span class="updated-time" ng-bind="lastUpdatedTimeVo"></span></p>
                            </div>

                        </div>
                        <div class="p-l-15 p-10 col-xs-12" style="font-weight: bold;color: black;border-top:1px solid #ccc;">
                            <!-- <table>
                                <tr ng-repeat="item in individualAirportNotamCount" class="airport-name-section">
                                    <td class="aero-code-item-td" ng-if="val" ng-repeat="val in item track by $index">
                                      <span class="tooltip-edit" ng-bind="val.aero_name"></span> 
                                        
                                       <a class="airport-notam-count" target="_blank" href="{{url('/notams/getrecentnotam?id=')}}<%val.aerodrome%>&count=<%val.count%>">
                                           <span class="aero-code-item" ng-bind="val.aerodrome"></span>
                                           (<span ng-bind="val.count"></span>)
                                       </a>

                                    </td>
                                </tr>
                            </table> -->
                            <div class="row" style="padding: 0 15px;">
                                <div class="col-sm-1 airport-name-section" style="width:11.11%;padding: 0px;" ng-repeat="item in individualAirportNotamCount">
                                    <div ng-if="val" class="aero-code-item-td" ng-repeat="val in item track by $index">
                                        <span class="tooltip-edit" ng-bind="val.aero_name"></span> 
                                       <a class="airport-notam-count" target="_blank" href="{{url('/notams/getrecentnotam?id=')}}<%val.aerodrome%>&count=<%val.count%>">
                                        <span class="aero-code-item" ng-bind="val.aerodrome"></span>
                                        (<span ng-bind="val.count"></span>)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('includes.notams_modal',[])
    @include('includes.new_footer',[])
</div>
@stop