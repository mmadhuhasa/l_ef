@extends('layouts.notam_layout',array('1'=>'1'))
@section('content')
<link rel="stylesheet" type="text/css" href="{{url('/app/css/weather.css')}}">
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
        text-align: left;
        text-transform: uppercase;
    }
    .margin-0{
        margin: 0;
    }
    .margin-b-5{
        margin-bottom: 5px;
    }
    .desc{
        text-align: justify;
        font-weight: bold;
        font-size: 14px;
        line-height: 1.2;
        margin-top:5px !important; 
        white-space: pre-line;
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
    .aerodrome_name{
        padding: 4px;
        background:-webkit-gradient(linear, 0% 100%, 0% 0%, from(rgb(123, 122, 122)), color-stop(0.5, rgb(4, 4, 4)), to(rgb(167, 164, 164)));
        border-radius: 5px;
        clear: both;
        color: #fff;
        font-weight: bold;
        font-size: 14px;
    }
    .qline{
        margin-left: 10px;
        float: right;
        font-size: 13px;
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
    .inline-edit-textarea{
        width: 100%;
        height: 70px;
        resize: none;
    }
    .update-btn{
        float: right;
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
        width: 30px;
        display: inline-block;
        float: right;
        cursor: pointer;
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
        color: #01579B;
    }
</style>
<script type="text/javascript">

    function updateStatus(id,notam_no) {
        id='is_active_checkbox'+id;
         $.ajax({
            type: "POST",
            url: base_url + '/notams/updatestatus',
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
    function toggleEmailStatus(id,notam_no) {
        id='enable_email_checkbox'+id;
         $.ajax({
            type: "POST",
            url: base_url + '/notams/updateemailstatus',
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
        $('.editable' + id).toggle();
        $('.non-editable' + id).toggle();
    }
    function updateNotams(id, notam_no) {
        $.ajax({
            type: "POST",
            url: base_url + '/notams/update?id=' + notam_no,
            data: {'desc': $('#desc' + id).val()
            },
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (result) {
                console.log(result);
                location.reload();
            }
        });
    }
   
</script>
<div class="page">
    @include('includes.new_fpl_header',[])
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
                          <!-- <div class="excel-icon"><a href="{{url('notams/exportxls?id=')}}{{$aero_code}}"><img src="../media/excel_ico.png"></a></div> -->

                        </div> 
                        
                        <div class="p-lr-15">
                            <?php $i = 1; ?>
                            @foreach ($notams_array as $key)
                            @if($key['print_aerodrome']=='true')
                            <div class="aerodrome_name">{!! $key['aerodrome'] !!} - ({!! $key['aerodrome_name'] !!}) {!! $key['aerodrome_notam_count'] !!} Notams </div> 
                            @endif
                            <div class="notam-strip row">
                                <div class="col-sm-5 margin-0 p-l-0" >
                                    <div class="p-l-0 col-sm-2 notam-number">
                                         <a  class="edit-icon"  onclick="inlineEdit(<?php echo $i; ?>)"><!-- <i class="fa fa-pencil-square-o" aria-hidden="true"></i> -->{!! $key['notam_no'] !!} </a>
                                        <span class="tooltip-edit">EDIT</span>
                                    </div>
                                    <div class="col-sm-2" style="height: 20px;">
                                        <div class="checkbox" style="margin: 0px;">
                                            <label>
                                                @if($key['is_active']==1)
                                                <input type="checkbox" id="is_active_checkbox<?php echo $i;?>" onchange="updateStatus(<?php echo $i;?>,'{!!$key['notam_no']!!}')" checked>
                                                @else
                                                <input type="checkbox" id="is_active_checkbox<?php echo $i;?>" onchange="updateStatus(<?php echo $i;?>,'{!!$key['notam_no']!!}')">
                                                @endif
                                                <span class="checkbox-label">PDF</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2" style="height: 20px;">
                                        <div class="checkbox" style="margin: 0px;">
                                            <label>
                                                @if($key['enable_email']==1)
                                                <input type="checkbox" id="enable_email_checkbox<?php echo $i;?>" onchange="toggleEmailStatus(<?php echo $i;?>,'{!!$key['notam_no']!!}')" checked>
                                                @else
                                                <input type="checkbox" id="enable_email_checkbox<?php echo $i;?>" onchange="toggleEmailStatus(<?php echo $i;?>,'{!!$key['notam_no']!!}')" >
                                                @endif
                                               <span class="checkbox-label checkbox-label-email"> EMAIL</span>
                                            </label>
                                        </div>
                                    </div>

                                </div>  
                                <div class=" col-sm-7 p-r-0 margin-0 p-l-0">
                                    <span class="qline">@if($key['decoded_qline']!="NA") CATEGORY: @else &nbsp; @endif @if($key['decoded_qline']!="NA"){!! $key['decoded_qline'] !!}@endif </span>
                                </div>

                                <div class=" margin-0 col-sm-12 p-lr-0 desc non-editable non-editable<?php echo $i; ?>"> {!! $key['description'] !!} </div> 
                                <div class="row margin-0 desc editable editable<?php echo $i; ?>"> <textarea class="inline-edit-textarea" id="desc<?php echo $i; ?>">{!! $key['description'] !!} </textarea></div>  
                                <button class="editable editable<?php echo $i; ?> newbtnv1 update-btn" onclick="updateNotams(<?php echo $i; ?>, '{!! $key['notam_no'] !!}')">Update</button>
                                <div class=" col-sm-12 p-r-0 p-l-0" style="margin-top:5px;    line-height: 1.0;">
                                    <span class="to-date p-lr-0">  FROM: {!! $key['e_start_date_formatted'] !!}</span> 
                                    @if($key['e_end_date_formatted']=='31-Dec-9999')
                                    <span class="to-date p-lr-0">  TO: PERMANENT </span>
                                    @else
                                    <span class="to-date p-lr-0">  TO: {!! $key['e_end_date_formatted'] !!}</span>
                                    @endif
                                </div>
                                 @if( ($key['is_daily']  || $key['is_weekly']  || $key['is_date_specific'] ))
                                <div class=" col-sm-12  p-l-0 margin-0 margin-b-5 time-strip formatted-time" > FORMATTED TIME:
                                @foreach($key['formatted_time'] as $val)
                            <div style="/*    white-space: pre;
    display: inline-block;
    vertical-align: top*/"> 
                            {!! $val['time'] !!}
     </div>
                                @endforeach
                                </div> 
                                @endif 
                                {{--@if($key['formatted_time'])<div class=" col-sm-12  p-l-0 margin-0 margin-b-5 time-strip" style="line-height: 1.3;"> TIME: {!! $key['formatted_time'] !!}  </div> @else <div class=" col-sm-12  p-l-0 margin-0 margin-b-5 time-strip" style="line-height: 1.3;"> TIME: {!! $key['time'] !!}  </div> @endif--}}
                                <div class=" margin-0 margin-b-5 height-strip">
                                    @if($key['height'])
                                    <div> HEIGHT: {!! $key['height'] !!} ALTITUDE: {!! $key['level'] !!}</div>  
                                    @endif  
                                </div>
                            </div>
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
                                <a href="{{url('/notams/list/VOBL/last')}}"><button type="button" class="btn newbtnv1 file-btn remove_dis file_the_plan" data-toggle="dismiss" name="flag" value="File" >Yes</button></a>
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