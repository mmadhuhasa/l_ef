@extends('layouts.notam_layout',array('1'=>'1'))
@section('content')
<link rel="stylesheet" type="text/css" href="{{url('/app/css/weather.css')}}">
@push('uploadnotamcss') 
        <link rel="stylesheet" type="text/css" href="{{url('/app/css/notams/uploadnotam.css')}}"></link> 
@endpush 
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
    @include('includes.new_header',[])
    <main>
        <section class="welcome infopage" ng-app="navlog" ng-controller="notamsCtrl">
            <div class="container container-notam">
                <div class="row">
                    <div class="wheather_sec">
                        <div class="p-l-15 p-10 col-xs-12" style="font-weight: bold;color: black">
                            <div class="col-xs-3 p-lr-0">
                                <input  id="upload_input_vi" class="hide" file-model="notamForm.vi"   type="file" />
                                <div class="row fir-row">
                                    <label class="checkbox-inline no-new-notam-checkbox"><input type="checkbox" ng-model="noNewNotam['vi']" ng-change="noNewNotamUpdate('vi')">&nbsp;</label>
                                    <p class="fir-box cust_btn_v"  >VIDF (DELHI REGION) </p><span ng-click="uploadFirNotams('vi')" class="upload-icon"><i class="fa fa-upload"></i></span>
                                </div>
                                
                                <p class="update-text">NEW NOTAMS UPDATED:<a href="{{url('/notams/getrecentnotam?id=vi')}}&count=<%newlyAddedCountVi%>" target="_blank" class="update-content" ng-bind="newlyAddedCountVi"></a></p>
                                <p class="update-text">OLD NOTAMS:<span  class="update-content" ><% totalCountVi-notUpdatedCountVi-newlyAddedCountVi %></span></p>
                                <!-- <p class="update-text">NOT UPDATED NOTAMS:<a href="{{url('/notams/updatepending?id=vi')}}" target="_blank" class="update-content" ng-bind="notUpdatedCountVi"></a></p> -->
                                <p class="update-text">TOTAL NUMBER OF NOTAMS:<a href="{{url('/notams/getnotambyfir?id=vi')}}" target="_blank" class="update-content" ng-bind="totalCountVi"></a></p>
                                <p class="update-text">Last updated: <span class="updated-time" ng-bind="lastUpdatedTimeVi"></span></p>
                            </div>
                            <div class="col-xs-3 p-lr-0">
                                <input  id="upload_input_ve" class="hide" file-model="notamForm.ve"  type="file"/>
                                <div class="row fir-row">
                                    <label class="checkbox-inline no-new-notam-checkbox"><input type="checkbox" ng-model="noNewNotam['ve']" ng-change="noNewNotamUpdate('ve')">&nbsp;</label>
                                    <p type="button" class="fir-box cust_btn_v"  > VECF (KOLKATA REGION) </p>
                                    <span class="upload-icon" ng-click="uploadFirNotams('ve')"><i class="fa fa-upload"></i></span>
                                </div>    
                                
                                <p class="update-text">NEW NOTAMS UPDATED:<a href="{{url('/notams/getrecentnotam?id=ve')}}&count=<%newlyAddedCountVe%>" target="_blank" class="update-content" ng-bind="newlyAddedCountVe"></a></p>
                                <p class="update-text">OLD NOTAMS:<span  class="update-content" ><%totalCountVe-notUpdatedCountVe-newlyAddedCountVe%></span></p>
                                <!-- <p class="update-text">NOT UPDATED NOTAMS:<a href="{{url('/notams/updatepending?id=ve')}}" target="_blank" class="update-content" ng-bind="notUpdatedCountVe"></a></p> -->
                                <p class="update-text">TOTAL NUMBER OF NOTAMS:<a href="{{url('/notams/getnotambyfir?id=ve')}}" target="_blank" class="update-content" ng-bind="totalCountVe"></a></p>
                                <p class="update-text">Last updated: <span class="updated-time" ng-bind="lastUpdatedTimeVe"></span></p>
                            </div>
                            <div class="col-xs-3 p-lr-0">
                                <input  id="upload_input_va" class="hide" file-model="notamForm.va"  type="file"/>
                                <div class="row fir-row">
                                    <label class="checkbox-inline no-new-notam-checkbox"><input type="checkbox" ng-model="noNewNotam['va']" ng-change="noNewNotamUpdate('va')">&nbsp;</label>
                                    <p type="button" class="fir-box cust_btn_v" >VABF (MUMBAI REGION) </p>
                                    <span class="upload-icon" ng-click="uploadFirNotams('va')"><i class="fa fa-upload"></i></span>
                                </div>
                                <p class="update-text">NEW NOTAMS UPDATED:<a href="{{url('/notams/getrecentnotam?id=va')}}&count=<%newlyAddedCountVa%>" target="_blank" class="update-content" ng-bind="newlyAddedCountVa"></a></p>
                                <p class="update-text">OLD NOTAMS:<span  class="update-content" ><%totalCountVa-notUpdatedCountVa-newlyAddedCountVa %></span></p>
                                <!-- <p class="update-text">NOT UPDATED NOTAMS:<a href="{{url('/notams/updatepending?id=va')}}" target="_blank" class="update-content" ng-bind="notUpdatedCountVa"></a></p> -->
                                <p class="update-text">TOTAL NUMBER OF NOTAMS:<a href="{{url('/notams/getnotambyfir?id=va')}}" target="_blank" class="update-content" ng-bind="totalCountVa"></a></p>
                                <p class="update-text">Last updated: <span class="updated-time" ng-bind="lastUpdatedTimeVa"></span></p>
                            </div>
                            <div class="col-xs-3 p-lr-0">
                                <input  id="upload_input_vo" class="hide" file-model="notamForm.vo"  type="file"/>
                                <div class="row fir-row">
                                    <label class="checkbox-inline no-new-notam-checkbox"><input type="checkbox" ng-model="noNewNotam['vo']" ng-change="noNewNotamUpdate('vo')">&nbsp;</label>
                                    <p type="button" class="fir-box cust_btn_v"  >VOMF (CHENNAI REGION) </p>
                                    <span class="upload-icon" ng-click="uploadFirNotams('vo')"><i class="fa fa-upload"></i></span>
                                </div>
                                <p class="update-text">NEW NOTAMS UPDATED:<a href="{{url('/notams/getrecentnotam?id=vo')}}&count=<%newlyAddedCountVo%>" target="_blank" class="update-content" ng-bind="newlyAddedCountVo"></a></p>
                                <p class="update-text">OLD NOTAMS:<span  class="update-content" ><% totalCountVo-notUpdatedCountVo-newlyAddedCountVo%></span></p>
                                <!-- <p class="update-text">NOT UPDATED NOTAMS:<a href="{{url('/notams/updatepending?id=vo')}}" target="_blank" class="update-content" ng-bind="notUpdatedCountVo"></a></p> -->
                                <p class="update-text">TOTAL NUMBER OF NOTAMS:<a href="{{url('/notams/getnotambyfir?id=vo')}}" target="_blank" class="update-content" ng-bind="totalCountVo"></a></p>
                                <p class="update-text">Last updated: <span class="updated-time" ng-bind="lastUpdatedTimeVo"></span></p>
                            </div>

                        </div>
                        <div class="p-l-15 p-10 col-xs-12" style="font-weight: bold;color: black;border-top:1px solid #ccc;">
                           <!--  <table>
                                <tr ng-repeat="item in individualAirportNotamCount" class="airport-name-section">
                                    <td class="aero-code-item-td" ng-if="val" ng-repeat="val in item track by $index">
                                      <span class="tooltip-edit" ng-bind="val.aero_name"></span> 
                                        <span class="aero-code-item" ng-bind="val.aerodrome"></span>
                                       <a class="airport-notam-count" target="_blank" href="{{url('/notams/getrecentnotam?id=')}}<%val.aerodrome%>&count=<%val.count%>">
                                        (<span ng-bind="val.count"></span>)</a>
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
                <div class="row" style="  display:none;  border: 1px solid #ccc;
    height: 100%;
    padding: 0 0px;float:left;">
                <div class="row" style="    border-bottom: 1px solid #ccc;
        background: -webkit-gradient(linear,left top,left bottom,from(#f1292b ),to(#f37858 ));color:#fff;  margin: 0 0 6px 0px;
    float: left; width: 100%;">
                    <div class="col-xs-8" style="height: 100%;
    padding: 8px;
    font-weight: bold;
    padding-left: 20px;">EFLIGHT | NEW NOTAM UPDATES</div>
                    <div class="col-xs-4"></div>
                </div>
                <div class="aerodrome_name">VIAG - (AGRA) 2 Notams </div>
                <div class="notam-strip row" >
                    <div>                                        <div  class="col-sm-5 margin-0 p-l-0">
                                            <div class="p-l-0 col-sm-1" > A1075/13

                                            </div>
                                        </div>  
                                        <div class="col-sm-7 p-r-0 margin-0 p-l-0">
                                            <span class="qline"><span ng-if="item.decoded_qline != 'NA'">CATEGORY:VOR/DME </span><span ng-if="item.decoded_qline == 'NA'">&nbsp;</span> <span ng-if="item.decoded_qline != 'NA'" ng-bind="item.decoded_qline"></span>  </span>
                                        </div>
                                        </div>

                                        <div class="col-sm-12  margin-0 desc p-lr-0 " >  DVOR/DME CORRECTION OF NAVIGATIONAL DATA AS PER GIVEN BELOW: DVOR CALL SIGN AGG FREQ 112.0MHZ COORDS 270901.67N 0775652.05E DME CH NO 57X TXN FREQ 1018MHZ RXN FREQ 1081MHZ DATE OF COMMISSIONING 9903220400. AMEND EAIP INDIA ENR SECTION 3.1 AND ENR 4.1 ACCORDINGLY</div>  
                                        <div class="col-sm-12  p-r-0 margin-0 p-l-0" style="margin-top:5px; line-height: 1.0;">
                                            <span class="to-date p-lr-0">  FROM: 12-DEC-2013 <span ng-bind="item.e_start_date_formatted"></span></span> 
                                            <span class="to-date p-lr-0" ng-if="item.e_end_date_formatted == '31-Dec-9999'">  TO: PERMANENT </span>
                                            <span class="to-date p-lr-0" ng-if="item.e_end_date_formatted != '31-Dec-9999'">  TO: PERMANENT<span ng-bind="item.e_end_date_formatted"></span></span>
                                        </div>
                                        <div class="col-sm-12 margin-0 margin-b-5 time-strip p-l-0" >TIME:  0000 - 2359 UTC (0000 - 2359 IST)<span ng-bind="item.time"></span> </div>  
                                        <div class="col-sm-12 margin-0 margin-b-5 height-strip p-l-0" ng-if="item.height">
                                            <div> HEIGHT: <span ng-bind="item.height"></span> ALTITUDE: <span ng-bind="item.level"></span>
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