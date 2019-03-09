@extends('layouts.notam_layout',array('1'=>'1'))
@section('content')
@push('supervisefiles')
<link rel="stylesheet" type="text/css" href="{{url('app/css/notams/supervise.css')}}">
<script src="{{url('app/js/notams/supervise.js')}}"></script>
@endpush
<div class="fakeloader" >
<!-- <i style="width:100%;text-align:center;padding-top:12px;color:#f1292b" class="fa-2x fa fa-spinner"></i> -->
</div>
<div class="bg-overlay"></div>

<div class="page">
    <!-- @include('includes.new_fpl_header',[]) -->
    @include('includes.new_header',[])
    <main>
        <section class=" welcome infopage" >

            <div class="container container-supervise" ng-app="eflight" ng-controller="superviseCtrl">
                @include('includes.alert_modal',[])
                <div ng-if="pageindex != 4">


                    <div class="row">
                        <div class="col-xs-12 fir-tab-section">
                            <div class="col-xs-3 fir-tab" ng-class="{'fir-tab-active':tabStatus[0]}">
                                VIDF
                            </div>
                            <i class="fa fa-arrow-right arrow-fir" ng-class="{'arrow-fir-active':tabStatus[0]}"></i>
                            <div class="col-xs-3 fir-tab" ng-class="{'fir-tab-active':tabStatus[1]}">
                                VECF
                            </div>
                            <i class="fa fa-arrow-right arrow-fir" ng-class="{'arrow-fir-active':tabStatus[1]}"></i>
                            <div class="col-xs-3 fir-tab" ng-class="{'fir-tab-active':tabStatus[2]}">
                                VABF
                            </div>
                            <i class="fa fa-arrow-right arrow-fir" ng-class="{'arrow-fir-active':tabStatus[2]}"></i>
                            <div class="col-xs-3 fir-tab" ng-class="{'fir-tab-active':tabStatus[3]}">
                                VOMF
                            </div>

                        </div>
                    </div>
                    <input type="hidden" id="count" value="{!! $last_visited !!}">
                    <div  >
                        <div class="row watch_hours_header_title">
                            <span ng-bind="region[fir]"></span> <span ng-bind="total_count"></span> NOTAMS @if(isset($VI)) {!! count($VI) !!} NOTAMS  @endif
                        </div>

                        <div class="notam-strip row" ng-repeat="item in resultArr">
                            <div  class="col-sm-5 margin-0 p-l-0">
                                <div class="p-l-0 col-sm-3 notam-no" ng-bind="item.notam_no" ng-click="inlineEdit($index)">

                                </div>
                             <!--    <div class="col-sm-2" style="height: 20px;">
                                    <div class="checkbox" style="margin: 0px;">
                                        <label>
                                            <input type="checkbox" ng-model="is_active_checkbox[$index]" ng-checked="item.is_active == 1" ng-click="updateStatus($index, item.notam_no)">
                                            <span class="checkbox-label">PDF</span>
                                        </label>
                                    </div>
                                </div> -->
                                <div class="col-sm-2" style="height: 20px;">
                                    <div class="checkbox" style="margin: 0px;">
                                        <label>
                                            <input type="checkbox" ng-model="enable_email_checkbox[$index]" ng-checked="item.enable_email == 1" ng-click="toggleEmailStatus($index, item.notam_no)" >
                                            <span class="checkbox-label checkbox-label-email"> EMAIL</span>
                                        </label>
                                    </div>
                                </div>
                                <!--  <div class="p-l-0 col-sm-1" ng-bind="item.aerodrome">
                                </div> -->
                            </div>  
                            <div class="col-sm-7 p-r-0 margin-0 p-l-0">
                                <span class="qline" ng-click="open_tooltip($index)">
                                    <span>CATEGORY:</span>

                                    <span ng-if="item.decoded_qline != 'NA'" ng-bind="item.decoded_qline"></span>
                                    <span ng-if="item.decoded_qline == 'NA'" ng-bind="item.decoded_qline">NA</span>
                                </span>
                                <div class="tooltip-raw-data" ng-class="{'visiblity-visible':tooltipFlag[$index] == true}">
                                    <i class="tooltip-raw-data-close fa fa-close" ng-click="close_tooltip($index)"></i>
                                    <span ng-bind-html="item.raw_data | unsafe"></span>
                                </div>
                            </div>

                            <div class="col-sm-12  p-r-0 margin-0 p-l-0" style="margin-top:5px; line-height: 1.0;font-weight:bold;">
                                <span class="to-date p-lr-0">  FROM:  <span ng-bind="item.e_start_date_formatted"></span></span> 
                                <span class="to-date p-lr-0" ng-if="item.e_end_date_formatted == '31-Dec-9999'">  TO: PERMANENT </span>
                                <span class="to-date p-lr-0" ng-if="item.e_end_date_formatted != '31-Dec-9999'">  TO: <span ng-bind="item.e_end_date_formatted"></span></span>
                            </div>
                            <div class="col-sm-12 margin-0  time-strip p-l-0" ng-if="item.formatted_time" ng-repeat="val in item.formatted_time"><span class="col-xs-3 p-lr-0" style="width:auto;white-space: pre;" ng-if="$index == 0">TIME : </span> <span class="col-xs-3 p-lr-0" style="width:auto;white-space: pre;" ng-if="$index != 0" ng-style="$index!=0 &&{'visibility': 'hidden'}">TIME : </span> <span ng-bind="val.time" class="time-content"></span> </div>  
                            <div class="col-sm-12 margin-0 margin-b-5 time-strip  p-l-0" ng-if="item.height">
                                <div> HEIGHT: <span ng-bind="item.height"></span> ALTITUDE: <span ng-bind="item.level"></span>
                                </div>  
                            </div>
                            <div class="col-sm-12  margin-0 desc p-lr-0 " ng-if="!enableDescriptionTextarea[$index]" ng-bind="item.description">  </div>
                            <div class="row margin-0 desc editable editable" ng-if="enableDescriptionTextarea[$index]"> <textarea class="inline-edit-textarea" id="desc" ng-model="desc[$index]" ng-init="desc[$index] = item.description"> </textarea></div>  
                            <button class="editable  newbtnv1 update-btn" ng-click="updateNotams($index, item)" ng-if="enableDescriptionTextarea[$index]">Update</button>

                        </div>

                        <div class="row" ng-if="showErrMessage">
                            <p class="col-md-12 align-center err-message" >No new notams updated since <span ng-bind="last_updatedTime"></span> </p>
                        </div>

                    </div>

                    <div class="row margin-0" >
                        <div class="col-xs-12 align-right p-lr-0">
                            <button class="btn newbtn_blackv1 previous-btn" ng-if="pageindex != 0" ng-click="prev()">Previous</button>
                            <button class="btn newbtnv1"  ng-click="next()">Next</button>
                            <!-- <button class="btn newbtnv1" ng-if="pageindex == 3" ng-click="submit()">Submit</button> -->
                        </div>
                    </div>
                </div>
                <div class="row confirmation-row" ng-if="pageindex == 4">
                    <div class="col-md-12 p-lr-5">
                        <div class="watch_hours_header_title">
                            CONFIRMATION
                        </div>
                    </div>
                    <div class="stats-block">

                      <!--   <div class="col-xs-12">
                            <div class="col-xs-6">VIDF Notams </div>
                            <div class="col-xs-6">: <span ng-bind="statsData['vi']"></span></div>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-xs-6">VECF Notams </div>
                            <div class="col-xs-6">: <span ng-bind="statsData['ve']"></span></div>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-xs-6">VOMF Notams </div>
                            <div class="col-xs-6">: <span ng-bind="statsData['vo']"></span></div>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-xs-6">VABF Notams </div>
                            <div class="col-xs-6">: <span ng-bind="statsData['va']"></span></div>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-xs-6">Notams description edited</div>
                            <div class="col-xs-6">: <span ng-bind="operationLog.editText.length"></span></div>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-xs-6">Notams PDF Enabled</div>
                            <div class="col-xs-6">: <span ng-bind="operationLog.editPdf.length"></span></div>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-xs-6">Notams Email Enabled</div>
                            <div class="col-xs-6">: <span ng-bind="operationLog.editEmail.length"></span></div>
                        </div> -->
                        <table class="table table-bordered">
                        <tr class="table-header-bg">
                            <th>FIR</th>
                            <th>PDF CHANGE COUNT</th>
                            <th>EMAIL CHANGE COUNT</th>
                            <th>DESCRIPTION CHANGE COUNT</th>
                        </tr>
                        <tr>
                            <td>VIDF Notams </td>
                            <td><span ng-bind="operationLog.vi.editPdf.length || 0"></span></td>
                            <td><span ng-bind="operationLog.vi.editEmail.length || 0"></span></td>
                            <td><span ng-bind="operationLog.vi.editText.length || 0"></span></td>
                        </tr>
                         <tr>
                            <td>VECF Notams </td>
                            <td><span ng-bind="operationLog.ve.editPdf.length || 0"></span></td>
                            <td><span ng-bind="operationLog.ve.editEmail.length || 0"></span></td>
                            <td><span ng-bind="operationLog.ve.editText.length || 0"></span></td>
                        </tr>
                         <tr>
                            <td>VOMF Notams </td>
                            <td><span ng-bind="operationLog.vo.editPdf.length || 0"></span></td>
                            <td><span ng-bind="operationLog.vo.editEmail.length || 0"></span></td>
                            <td><span ng-bind="operationLog.vo.editText.length || 0"></span></td>
                        </tr>
                         <tr>
                            <td>VABF Notams </td>
                            <td><span ng-bind="operationLog.va.editPdf.length || 0"></span></td>
                            <td><span ng-bind="operationLog.va.editEmail.length || 0"></span></td>
                            <td><span ng-bind="operationLog.va.editText.length || 0"></span></td>
                        </tr>
                        </table>
                        <div class="col-xs-12 submit-section">
                            <div class="col-xs-6"></div>
                            <div class="col-xs-6 button-block"><button class="btn newbtnv1"  ng-click="submit()">Submit</button></div>
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