@extends('layouts.notam_layout',array('1'=>'1'))
@section('content')
<link rel="stylesheet" type="text/css" href="{{url('/app/css/weather.css')}}">
        <script src="{{url('app/js/notams/multiDatePickerNotam.js')}}"></script>
<script src="{{url('app/js/navlog/jquery.growl.js')}}"></script>
<link rel="stylesheet" href="{{url('/app/css/navlog/jquery.growl.css')}}"/>

<style type="text/css">
    .ui-widget-content{
    border:none;
    }
    #progress_bar .ui-widget-header {
    background: repeating-linear-gradient( 45deg, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2) 10px, rgba(0, 0, 0, 0.3) 10px, rgba(0, 0, 0, 0.3) 20px );
    height: 15px;
    /*width: 100% !important;*/
    }
    .modal-body{
        padding: 0 20px;
    text-align: center;
    font-size: 14px;
    }
    #notam-pg-box .modal-container{
        /*background: none;*/
        box-shadow: none;
    }
    .modal-backdrop.in {
    opacity: 0.4;
}
        .ui-progressbar-value {
        background: url(http://www.netanimations.net/Animated-fighter-plane-fly-by.gif) no-repeat;
        border:none;
        }
        .ui-progressbar {
        height: 20px
        }


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
    .edited{
        color: #b14015 !important;
    }
    .to-date{
        text-align: left;
        text-transform: uppercase;
    }
    .map-img{
            width: 17px;
    margin-top: -10px;
    }
    .map-marker{
        height: 20px;
        text-align: center;
        font-size: 20px;
        cursor: pointer;
    }
    .margin-0{
        margin: 0;
    }
    .margin-b-5{
        margin-bottom: 5px;
    }
    .desc{
        text-align: justify;
        /*font-weight: bold;*/
        font-size: 14px;
        line-height: 1.2;
        margin-top:5px !important;
        white-space: pre-line; 
        font-family: monospace;
    }
    .time-strip{
        /*margin-top: 5px !important;*/
    }
    .height-strip{
        margin-top: 5px !important;
    }
    .container-notam{
        background: #fff;
        margin-bottom: 15px;
        width: 970px !important;
    }
    .raw-time{
        color: #00f;
        font-size: 13px;
            font-weight: bold;
            line-height: 1.3;
    }
    .formatted-time{
        color: #019b47;
        font-size: 13px;
        font-weight: bold;
        line-height: 1.3;
        text-transform: uppercase;
    }
    .aerodrome_name{
        padding: 4px;
        background:-webkit-gradient(linear, 0% 100%, 0% 0%, from(rgb(123, 122, 122)), color-stop(0.5, rgb(4, 4, 4)), to(rgb(167, 164, 164)));
        border-radius: 5px;
        clear: both;
        color: #fff;
        font-weight: bold;
        font-size: 14px;
        display: inline-block;
        width: 97%;
    }
    .aerodrome_name_width{
        width: 100%;
    }
    .qline{
        margin-left: 10px;
        float: right;
        font-size: 13px;
        cursor: pointer;
    }
    .col{
        width: 21%;
    }
    .p-l-0 {
        padding-left: 0;
    }
    .p-lr-15{
        padding-left: 15px;
        padding-right: 15px;
    }
    .p-lr-0 {
        padding-left: 0;
        padding-right: 0;
    }
    .p-r-0 {
        padding-right: 0;
    }
    .notam-number{
        position: relative;
        font-weight: bold;
    }
    .notam-number:hover .tooltip-edit{
        visibility: visible;
    }
    .qline-parent{
        width: auto;
        float: right;
    }
    .qline-parent:hover .tooltip-rawdata{
        visibility: visible;
        height: auto;
        left: auto;
        right: 0;
        z-index: 1;
    }
    .tooltip-rawdata{
        position: absolute;
            width: 539px;
        bottom: 20px;
        left: 4px;
        padding: 0px 24px;
        color: #000;
        border-radius: 4px;
        visibility: hidden;
        font-size: 14px;
        font-weight: normal;
        box-shadow: 0 0 1px 1px #888;
        background: #eee;
        height: 15px;
        line-height: 1.5;
    }
    .tooltip-edit{
        position: absolute;
        top: -13px;
        left: 4px;
        padding: 0px 11px;
        color: #eee;
        border-radius: 4px;
        visibility: hidden;
        font-size: 11px;
        font-weight: normal;
        box-shadow: 0 0 1px 1px #ccc;
        background: #333333;
        height: 15px;
        line-height: 1.5;
    }
    .edit-icon{
        text-decoration: none;
        cursor: pointer
    }
    .edit-icon:focus, .edit-icon:hover{
        color: #f1292b;
    }
    .inline-edit-textarea:focus{
     outline-color:#f1292b;
      outline-width: 2px;
        }
    .inline-edit-textarea{
        width: 100%;
        height: 133px;
        resize: none;
    }
    .update-btn{
        float: none;
        left: 44%;
        right: 0;
        position: absolute;
        margin: auto;
    }
    .editable{
        display: none;
    }
    #v_toTop {
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: none;
        background: url('../media/images/home/totop.png') no-repeat;
        width: 28px;
        height: 28px;
        cursor: pointer;
        z-index: 999999;
    }
    #v_toTop:hover {
        background: url('../media/images/home/totop2.png') no-repeat;
        width: 28px;
        height: 28px;
        cursor: pointer;
    }
    .excel-icon{
        width: 28px;
        display: inline-block;
        float: right;
        cursor: pointer;
        position: relative;
        display: inline-block;
    }
    .excel-icon-error{
        cursor: not-allowed;
    }
    .tooltip-excel.error{
        background: #f00 !important;
        width: 221px;
        top: -43px;
        left: -90px;
        color: #fff;

    }
    .tooltip-excel{
        position: absolute;
        top: -37px;
        left: -20px;
        padding: 4px 14px;
        color: #eee;
        border-radius: 4px;
        visibility: hidden;
        font-size: 11px;
        font-weight: normal;
        box-shadow: 0 0 1px 1px #ccc;
        background: #333333;
        line-height: 1.5;
        width: 67px;
        background-color: #ededed ;
        color: #f1292b;
        border: 1px solid #f1292b !important;
    }
    .excel-icon:hover .tooltip-excel{
        visibility: visible;
    }
    .airport-name-strip{
        display: inline-block;
    }
    .checkbox-label{
        font-size: 11px;
        margin-left: -5px;
        color: #f1292b;
        font-weight: bold;
    }
    .checkbox-label-email{
        color: #00f;
    }
    .day-of-week{
    cursor: pointer;
    }
    .date-picker-time{
        position: absolute;
        /*width: 490px;*/
        z-index: 9000;
        /*height: 240px;*/
        background: #fff;
        border: 1px solid #ccc;
        display: none;
        border-radius: 3px;
    }
    .date-picker-time .time-header{
        text-align: center;
        margin-left: -15px;
        font-weight: bold;
    }
    .date-picker-main{
        width: 13em;
        padding: 0;
        float: left;

    }
    .time-section{
        width: 200px;
        float: left;
        padding: 0 0 0 15px;
        position: relative;
    }
    .time-selection{
        color: #ff8c00;
        text-transform: uppercase;
    }
    .time-selection label{
       font-weight: bold;
    }
    .time-section .row{
        margin: 0px;
        margin-left: -6px;
    }
    .fancy-input{
        border: none;
        box-shadow: none;
        padding: 0px;
        border-radius: 0;
        height: 15px;
        font-weight: bold;
    }
    .fancy-input-div{
        border-bottom: 1px solid #ccc;
        width: 38%;
        margin: 0px 1.5%;
        padding: 0px;
    }
    .fancy-input:focus{
        border-bottom: none;
    border: none;
    outline: 0;
    box-shadow: none;
    }
    #daily-checkbox{
        font-size: 13px;
        margin-top: 10px;
    }
    .weekday-checkbox{
        display: block;
        margin: 3px auto auto auto !important;
    }
    #daily-checkbox input[type=checkbox]{
            margin-left: -15px;
    }
    .fancy-input-div.focused .floating-label{
        -moz-transform: scaleX(1);
        -ms-transform: scaleX(1);
        -o-transform: scaleX(1);
        -webkit-transform: scaleX(1);
        transform: scaleX(1);

        visibility: visible;
    }
    .fancy-input-div.error .floating-label{
        -moz-transform: scaleX(1);
        -ms-transform: scaleX(1);
        -o-transform: scaleX(1);
        -webkit-transform: scaleX(1);
        transform: scaleX(1);
        visibility: visible;
    }
    .fancy-input-div.hasvalue .floating-label{
        -moz-transform: scaleX(1);
        -ms-transform: scaleX(1);
        -o-transform: scaleX(1);
        -webkit-transform: scaleX(1);
        transform: scaleX(1);

        visibility: visible;
    }
    .fancy-input-div .floating-label:after{
        -moz-transform: scaleX(0);
        -ms-transform: scaleX(0);
        -o-transform: scaleX(0);
        -webkit-transform: scaleX(0);
        transform: scaleX(0);
        -moz-transition: 3.25s ease-in;
        -o-transition: 3.25s ease-in;
        -webkit-transition: 3.25s ease-in;
        transition: 3.25s ease-in;
        visibility: visible;
    }
    .fancy-input-div .floating-label{
        visibility: hidden;

    }
    .floating-label{
        font-size: 9px;
        visibility: visible;
        color: #f00;
        font-weight: bold;
        height: 17px;

    }
    .circle-icon{
        vertical-align: middle;
        font-size: 14px;
        padding-top: 12px;
        color: #f1292b;
    }
    .circle-icon-parent{
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px;
    }
    .fancy-input-div:after{
        content: '';
        position: absolute;
        left: 0;
        width: 100%;
        bottom: -2px;
        -moz-transform: scaleX(0);
        -ms-transform: scaleX(0);
        -o-transform: scaleX(0);
        -webkit-transform: scaleX(0);
        transform: scaleX(0);
        -moz-transition: 0.25s ease-in;
        -o-transition: 0.25s ease-in;
        -webkit-transition: 0.25s ease-in;
        transition: 0.25s ease-in;
        border-bottom: 2px solid #f1292b !important;
    }

    .fancy-input-div.focused:after{
        -moz-transform: scaleX(1);
        -ms-transform: scaleX(1);
        -o-transform: scaleX(1);
        -webkit-transform: scaleX(1);
        transform: scaleX(1);


    }
    .fancy-input-div.error:after{
        -moz-transform: scaleX(1);
        -ms-transform: scaleX(1);
        -o-transform: scaleX(1);
        -webkit-transform: scaleX(1);
        transform: scaleX(1);

    }


    /* btn code*/
    .search-btn-time{
        /*width: 40px;*/
        height: 24px;
        padding: 0px 3px;
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
        /*background: #555;*/
        background: #F26232;
        background: linear-gradient(to top, #fa9b5b, #F26232);
        background: #f1292b;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f37858', endColorstr='#f1292b');
        background: -webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b));
        background: -moz-linear-gradient(top, #f37858, #f1292b);
        z-index: 1;
        border-radius: 4px;
        margin-top:5px; 
    }
    .search-btn-time:hover:before {
        visibility: visible;
        width: 200%;
        left: -46%;
    }
    .search-btn-time:before {
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
        background: #555;
       /* background: #F26232;
        background: linear-gradient(to top, #fa9b5b, #F26232);
        background: #f1292b;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f37858', endColorstr='#f1292b');
        background: -webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b));
        background: -moz-linear-gradient(top, #f37858, #f1292b);*/

        z-index: -1;
        color:#fff;
    }
    .search-btn-time:hover{
        box-shadow: none !important;
    }

    /*end*/
    #notam-time-picker .modal_close{
        position: absolute;
        right: -5px;
        top: -10px;
        cursor: pointer;
        color: #f1292b;
        font-size: 26px;
        border-radius: 50%;
        background: #ffffff;
    }
    .week-days-select{
        height: 26px;
        padding: 0 4px;
        width: initial;
        color: #000 !important;
        border-color: #000;
    }
    .padd-0{
        padding: 0px !important;
    }
    .popover-content {
        font-family: 'pt_sansregular';
    }
    .popover{
        background-color: #ededed !important;
        color: #f1292b !important;
        border: 1px solid #f1292b !important;
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
    .down {
        transform: rotate(45deg);
        -webkit-transform: rotate(45deg);
    }
    .arrow_i {
      border: solid #333333;
      border-width: 0 3px 3px 0;
      display: inline-block;
      padding: 3px;
      position: absolute;
      top: 10px;
      left: 30px;
    }
    ::-webkit-input-placeholder { /* Chrome/Opera/Safari */
        font-size: 9px;  
    }
    ::-moz-placeholder { /* Firefox 19+ */
        font-size: 9px;  
    }
    :-ms-input-placeholder { /* IE 10+ */
        font-size: 9px;  
    }
    :-moz-placeholder { /* Firefox 18- */
        font-size: 9px;  
    }
</style>
<script type="text/javascript">

    function updateStatus(id, notam_no) {
    id = 'is_active_checkbox' + id;
    $.ajax({
    type: "POST",
            url: base_url + '/notamsops/updatestatus',
            data: {
            id: notam_no,
                    status: document.getElementById(id).checked?1:0
            },
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (result) {
            console.log(result);
            // location.reload();
            }
    });
    }
    function toggleEmailStatus(id, notam_no) {
    id = 'enable_email_checkbox' + id;
    $.ajax({
    type: "POST",
            url: base_url + '/notamsops/updateemailstatus',
            data: {
            id: notam_no,
                    status: document.getElementById(id).checked?1:0
            },
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (result) {
            console.log(result);
            // location.reload();
            }
    });
    }
    function inlineEdit(id) {
        var descVal = $('#desc' + id).val();
        $('#desc' + id).val(descVal.replace(/\<br\/\>/g, '\n'));
        $('.editable' + id).toggle();
        $('.non-editable' + id).toggle();
    }
    function updateNotams(id, notam_no) {
        $.ajax({
                type: "POST",
                url: base_url + '/notamsops/update?id=' + notam_no,
                data: {'desc': $('#desc' + id).val()
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (result) {
                    console.log(result);
                    $('.editable' + id).toggle();
                    $('.non-editable' + id).toggle();
                    $('.non-editable'+id).html($('#desc' + id).val());
                    // location.reload();
                }
        });
    }
     function pushNotamstoSuperVise(code,count,airport,fir){
        console.log(airport);
        if(fir!='NA')
            airport = fir;
        else 
            airport = code+" - "+airport;
        var closeProgress = false;
        var apiCompleted = false;
          $('#loader-div').modal({ backdrop: 'static', keyboard: false })
            $('#loader-div').modal('show');
            var progressbarVal=0;
            var interval = setInterval(function() {
            $("#loaderText").html("Updating Notams ...");

                progressbarVal = progressbarVal + 1;
                $("#progress_bar").progressbar({ value: progressbarVal });
                $("#percentage2").html(progressbarVal + " %");
                if (progressbarVal >= 99) {
                    clearInterval(interval);
                }
            }, 100);

            setTimeout(function() {
                    closeProgress = true;
                
                if(apiCompleted){
                   $('#loader-div').modal('hide');
                     var message = count+" NOTAMS UPLOADED TO ("+airport+")";
                    $.growl({title: '', location: 'tc', size: 'large', message: message});

                }
            }, 3000);

        $.ajax({
            type: "GET",
            url: base_url + '/notamsops/pushNotamtoLive?id='+code+'&count='+count+'&type=data',
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (result) {
                console.log(result);
                    apiCompleted = true;

                // location.reload();
                if(closeProgress){
                    var message = count+" NOTAMS UPLOADED TO ("+airport+")";
                    $.growl({title: '', location: 'tc', size: 'large', message: message});
                    console.log(message);
                  $('#loader-div').modal('hide');

                }
                
            
            }
        });
    }
</script>
<div id="loader-div" class="modal fade" style="display:none;" >
    <div class="modal-dialog modal-container">
    <section class="popupBody modal-body">

        <div class="user_login">
        <div class="row">
            <!-- <span class="fpl_loader"></span> -->
            <p id="" style="width:98%;text-align: center">
            <span class="fpl_loader1"><a href=""><span style="font-weight:bold" id="loaderText"> </span></span>
            <span id="progress_bar" ></span> <span id="percentage2" ></span>
            </p>
        </div>
        </div>
    </section>
    </div>
</div>

<div class="page" ng-app="notams" ng-controller="recentNotamsCtrl">
    @include('includes.new_fpl_header',[])
    <div id="notam-time-picker">
        <div class="date-picker-time row" ng-style="positionVarDatePicker">
            <div style="height:236px;">
                <multiple-date-picker-notam class="date-picker-main" sunday-first-day="true"  ng-model="selectedNotamDates" month="beginMonth"  disable-days-before="startAt" disable-days-after="endAt" disallow-back-past-months="disablePast" disallow-go-futur-months="disableFuture" month-changed="monthChanged"></multiple-date-picker-notam>
                <div class="time-section" ng-show="showTimeSection">
                    <span class="modal_close" ng-click="closeCalendar()"><i class="fa fa-times-circle"></i></span>
                    <div class="time-header">Time</div>
                    <div class="row time-selection">
                    <div class="checkbox col-xs-4 padd-0" id="daily-checkbox">
                        <label><input type="checkbox" ng-model="daily" ng-click="dailyClick()">Daily</label>
                    </div>
                     <div class="checkbox col-xs-8 padd-0" id="daily-checkbox">
                        <label><input type="checkbox" ng-model="specificDateOnly" ng-click="changeTypeToSpecificDate()">SPECIFIC DATE</label>
                   </div>
                    </div>
                    
                    <div class="row" ng-repeat="item in inputArr track by $index"  bs-popover>
                        <div class="col-xs-5 fancy-input-div" ng-class="{'focused':item[0] == true}"><div class="floating-label">START TIME UTC</div><input class="form-control fancy-input numeric" ng-model="notamTimeObj.notamTime[$index].start"  ng-change="onTimeInputChange('start<%$index+1%>')" maxlength="4"  placeholder="START TIME UTC" ng-click="onTimeFocus($index, 0)" ng-blur="onTimeBlur($index, 0)" onfocus="this.placeholder = ''" onblur="this.placeholder = 'START TIME UTC'" numeric="true" id="start<%$index+1%>" rel="popover" data-toggle="popover" data-placement="top"/></div>
                        <div class="col-xs-5 fancy-input-div" ng-class="{'focused':item[1] == true}"><div class="floating-label">END TIME UTC</div><input class="form-control fancy-input numeric" ng-model="notamTimeObj.notamTime[$index].end" ng-change="onTimeInputChange('end<%$index+1%>')" maxlength="4"  placeholder="END TIME UTC" ng-click="onTimeFocus($index, 1)" ng-blur="onTimeBlur($index, 1)" onfocus="this.placeholder = ''" onblur="this.placeholder = 'END TIME UTC'" numeric="true" id="end<%$index+1%>" rel="popover" data-toggle="popover" data-placement="top" /></div>
                        <div class="col-xs-2 circle-icon-parent"><i class="fa fa-minus-circle circle-icon" aria-hidden="true" ng-click="removeRow($index)" ng-if="$index!=0 "></i><i class="fa fa-plus-circle circle-icon" aria-hidden="true" ng-click="addMore()" ng-if="$index==0"></i></div>  
                    </div>
                    <div style="text-align: center;">
                        <button class="btn search-btn-time" ng-click="saveTiming()">SUBMIT</button>
                    </div>
                </div>

            </div>
            
            
        </div>

    </div>
    <main>
        <section class="bg-1 welcome infopage">
            <div class="container container-notam">
                @if($status=='success')	
                <div class="row">
                    <div class="wheather_sec">

                        <div class="p-l-15 p-10" style="font-weight: bold;color: black;padding-right: 15px;">
                            <div class="airport-name-strip">@if($airport!='NA')     {{$airport}}  <span class="p-l-25">{{count($notams_array)}} NOTAMS </span>
                                @endif
                            </div>


                        </div> 

                        <div class="p-lr-15">

                            <?php $i = 1; $aerodrome_name = 'aerodrome_name'; ?>
                            @foreach ($notams_array as $key)
                            @if($key['print_aerodrome']=='true')
                            @if($i==1)
                            <div class="aerodrome_name">{!! $key['aerodrome'] !!} - ({!! $key['aerodrome_name'] !!}) {!! $key['aerodrome_notam_count'] !!} Notams </div> 
                            <div ng-if="count==0" class="excel-icon" onclick="pushNotamstoSuperVise('{{$aero_code}}',@if($airport=='NA'){{$key['aerodrome_notam_count']}}@else{{count($notams_array)}} @endif,'{{$key[$aerodrome_name]}}','{{$airport}}')">
                                <span class="tooltip-excel">
                                <!-- <i class="arrow_i down"></i> -->

                                UPDATE</span>
                                <a >
                                    <img src="../media/sync.png"></a>
                            </div>
                            <div ng-if="count!=0" class="excel-icon excel-icon-error">
                                <span class="tooltip-excel error">
                                <!-- <i class="arrow_i down"></i> -->

                                FORMAT DATE & TIME DISPLAYED IN BLUE COLOR TO ENABLE UPLOAD.</span>
                                <a >
                                    <img src="../media/sync.png"></a>
                            </div>
                            
                            @else
                            <div class="aerodrome_name aerodrome_name_width">{!! $key['aerodrome'] !!} - ({!! $key['aerodrome_name'] !!}) {!! $key['aerodrome_notam_count'] !!} Notams </div> 
                            @endif
                            @endif
                            @if( $key['is_primary']==1)
                            <div class="notam-strip row">
                                <div class="col-sm-12 margin-0 p-l-0" >
                                    <div class="p-l-0 col-sm-2 notam-number">
                                         <a  class="edit-icon"  onclick="inlineEdit(<?php echo $i; ?>)"><!-- <i class="fa fa-pencil-square-o" aria-hidden="true"></i> -->{!! $key['notam_no'] !!} </a>
                                        <span class="tooltip-edit">EDIT</span>
                                    </div>
                                   <div class="col-sm-2" style="height: 20px;">
                                        <div class="checkbox" style="margin: 0px;">
                                            <label>
                                               <!--  @if($key['is_active']==1)
                                                <input type="checkbox" id="is_active_checkbox<?php echo $i; ?>" onchange="updateStatus(<?php echo $i; ?>, '{!!$key['notam_no']!!}')" checked>
                                                @else
                                                <input type="checkbox" id="is_active_checkbox<?php echo $i; ?>" onchange="updateStatus(<?php echo $i; ?>, '{!!$key['notam_no']!!}')">
                                                @endif
                                                <span class="checkbox-label"> PDF </span> -->
                                            </label> 
                                        </div>
                                    </div>
                                    <!-- <div class="col-sm-2" style="height: 20px;">
                                        <div class="checkbox" style="margin: 0px;">
                                          <label>
                                                @if($key['enable_email']==1)
                                                <input type="checkbox" id="enable_email_checkbox<?php echo $i; ?>" onchange="toggleEmailStatus(<?php echo $i; ?>, '{!!$key['notam_no']!!}')" checked>
                                                @else
                                                <input type="checkbox" id="enable_email_checkbox<?php echo $i; ?>" onchange="toggleEmailStatus(<?php echo $i; ?>, '{!!$key['notam_no']!!}')" >
                                                @endif
                                                <span class="checkbox-label checkbox-label-email"> EMAIL </span>
                                                
                                            </label>                                         </div>
                                    </div>  -->
                                      <div class="col-sm-3 p-lr-0 map-marker" >
                                        @if($key['enable_map']==true)

                                           <a target="_blank" href="{{url('/notamsops/latlong?id=')}}{{$key['id']}}"> <img class="map-img" src="{{url('media/map.png')}}"> </a>
                                        @endif
                                    </div>  
                                <div class=" col-sm-5 p-r-0 margin-0 p-l-0 qline-parent">
                                    <span class="qline">@if($key['decoded_qline']!="NA") CATEGORY: @else CATEGORY: @endif @if($key['decoded_qline']!="NA"){!! $key['decoded_qline'] !!} @else NA @endif </span>
                                     <span class="tooltip-rawdata">{!!  $key['raw_data'] !!}</span>
                                </div>

                                <div class="margin-0 col-sm-12 p-lr-0 desc non-editable non-editable<?php echo $i; ?>"> {!! $key['description'] !!} </div> 
                                <div class="row margin-0 desc editable editable<?php echo $i; ?>"> <textarea class="inline-edit-textarea" id="desc<?php echo $i; ?>">{!! $key['description'] !!} </textarea></div>  
                                <button class="editable editable<?php echo $i; ?> newbtnv1 update-btn" onclick="updateNotams(<?php echo $i; ?>, '{!! $key['notam_no'] !!}')">Update</button>
                                <div class=" col-sm-12 p-r-0 p-l-0" style="margin-top:10px;    line-height: 1.0;font-weight: bold;">
                                    <span class="to-date p-lr-0">  FROM: {!! $key['e_start_date_formatted'] !!}</span> 
                                    @if($key['e_end_date_formatted']=='31-Dec-9999')
                                    <span class="to-date p-lr-0">  TO: PERMANENT </span>
                                    @else
                                    <span class="to-date p-lr-0">  TO: {!! $key['e_end_date_formatted'] !!}</span>
                                    @endif
                                </div>
                                <div id="notam_timing_{!! $key['id'] !!}" >
                                @if($key['raw_time'])
                                <div class=" col-sm-12  p-l-0 margin-0 margin-b-5 time-strip raw-time @if( ($key['is_daily']  || $key['is_weekly']  || $key['is_date_specific'] )) edited @endif"  >RAW TIME: <span style="display:inline-block;">{!! $key['raw_time'] !!} </span> <i class="fa fa-clock-o" style="cursor: pointer;" aria-hidden="true" ng-click="loadDatePicker($event, '{!! $key['e_start_date_formatted'] !!}', '{!! $key['e_end_date_formatted'] !!}', '{!! $key['notam_no'] !!}', '{!! $key['id'] !!}','{!! $key['aerodrome'] !!}')"></i>
                                 </div> 
                                 @if( ($key['is_daily']  || $key['is_weekly']  || $key['is_date_specific'] ))
                                <div class=" col-sm-12  p-l-0 margin-0 margin-b-5 time-strip formatted-time" > FORMATTED TIME:
                                @foreach($key['formatted_time'] as $val)
                            <div style="/*    white-space: pre;
    display: inline-block;
    vertical-align: top*/"> 
                            {!! $val['time'] !!}<i class="fa fa-pencil" style="cursor: pointer;    padding-left: 5px;" aria-hidden="true" ng-click="loadDatePicker($event, '{!! $key['e_start_date_formatted'] !!}', '{!! $key['e_end_date_formatted'] !!}', '{!! $key['notam_no'] !!}', '{!! $val['notam_id'] !!}', '{!! $key['aerodrome'] !!}','edit','{!! $val['time'] !!}')"></i> 
     </div>
                                @endforeach
                                </div> 
                                @endif 
                                @else($key['time'] )
                                <div class=" col-sm-12  p-l-0 margin-0 margin-b-5 time-strip" style="line-height: 1.3;font-weight: bold;"> TIME: {!! $key['formatted_time'][0]['time'] !!}  <i class="fa fa-clock-o" style="cursor: pointer;" aria-hidden="true" ng-click="loadDatePicker($event, '{!! $key['e_start_date_formatted'] !!}', '{!! $key['e_end_date_formatted'] !!}', '{!! $key['notam_no'] !!}', '{!! $key['id'] !!}','{!! $key['aerodrome'] !!}')"></i>
                                 </div> 
                                  @endif
                                </div>
                                <!-- <div class=" margin-0 margin-b-5 height-strip">
                                    @if($key['height'])
                                    <div> HEIGHT: {!! $key['height'] !!} ALTITUDE: {!! $key['level'] !!}</div>	
                                    @endif	
                                </div> -->
                            </div>
                            </div>
                            @endif
                            <?php $i++; ?>
                            @endforeach
                        </div>		
                    </div>
                </div>
                @else
                <div class="row">
                    <div class="wheather_sec" style="padding: 20px;height:500px;">		    
                        <div class="p-l-15 p-10" style="font-weight: bold;color: black;text-align:center;">
                            Failed to fetch latest Notams. Would you like to view last stored Notams ?
                        </div>
                        <div class="row">
                            <div class="col-md-6  fpl_modal_text" style="text-align:right;">                       
                                <a href="{{url('/notamsops/list/VOBL/last')}}"><button type="button" class="btn newbtnv1 file-btn remove_dis file_the_plan" data-toggle="dismiss" name="flag" value="File" >Yes</button></a>
                            </div>
                            <div class="col-md-6  fpl_modal_text" style="text-align:left;">                       
                                <a href="{{url('/')}}"><button type="button" class="btn newbtnv1 file-btn remove_dis file_the_plan" data-toggle="dismiss" name="flag" value="File" >No</button></a>
                            </div>
                        </div>    
                    </div>	
                </div>	
                @endif			
            </div>

        </section>
    </main>   
    <div id='v_toTop'><span></span></div>

    @include('includes.new_footer',[])
    <script>
        $(window).scroll(function () {
        if ($(this).scrollTop()) {
        $('#v_toTop').fadeIn();
        } else {
        $('#v_toTop').fadeOut();
        }
        });
        $("#v_toTop").click(function () {
        $("html, body").animate({scrollTop: 0}, 500);
        });
    </script>
</div>
@stop