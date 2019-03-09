@extends('emails.layout')
@section('container')
<?php date_default_timezone_set('Asia/Calcutta');?>
<style>
.wrapper{
    max-width:62%;
    margin: 0 auto;
}
.date_enter{
   margin-left:15px;
}
.time_enter{
   margin-left:15px;
}
@media only screen and (min-width : 320px) and (max-width : 767px) {
.wrapper{
    max-width:100%;
    margin: 0 auto;
}
.date_enter{
   margin-left:0px;
   line-height: 1.9;
}
.time_enter{
   margin-left:0px;
}
.greet{
   line-height: 1.5;
}
}
</style>
<body style="padding: 15px 25px 15px 25px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">
<div class="wrapper" style="background:#edf0f3;padding: 5px 15px 5px 15px;">
<div style="width:100%;background:#f1292b;border-radius:5px;background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858));">
<p style="font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;color:#fff;padding:15px;font-size:18px;font-weight:bold;">HANDLING ORDER</p>
</div>
<div style="background:#fff;padding: 5px 15px 5px 15px;border-radius:5px;margin-bottom: 15px;">
<p style="font-size:15px ;font-family: 'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;color: black;">
    Greetings from <span style="color: red;font-weight: bold">EFLIGHT</span>,<br/><br/>
    <span style="font-weight: bold">Ground Handling </span>for<span style="font-weight: bold"> {{$operator}}</span> aircraft <span style="font-weight: bold">{{$aircraft_callsign}}</span> is required at<span style="font-weight: bold"> {{$destination_aerodrome}} – {{$airport_name}}</span><span> for</span><span style="font-weight: bold"> {{$arrival_time}}</span> IST<span> arrival time on </span><span style="font-weight: bold">{{$date_of_flight}}</span>.
    <br/><br/>
    REMARKS: <span style="font-weight: bold">@if($remarks){{$remarks}}@else None @endif</span>
</p><br/>
<p style="font-size:15px ;font-family: 'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif; color: black;">
    <span style="color: #404040;">			 			
        Thanks, <br/> <br/> 
        <span style="color: red;font-weight: bold"> TEAM EFLIGHT </span><br/> 
        <span style="font-weight: bold">(+91) 9449485515  </span>  <span style="color: red;font-weight: bold"> (24 x 7 SUPPORT)</span><br/>
        <span style="font-weight: bold">(+91) 9886454717  </span>  <span style="color: red;font-weight: bold"> (ACCOUNTS)</span><br/>  
    </span>                                           
</p>
<br/>
<p style="font-size:15px ;font-family: 'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif; color: black;">
    <!-- <span style="color: #404040;">						
        <span style="font-weight: bold">Order by:</span> EFLIGHT OPS 12<span style="font-weight: bold;padding-left:15px;">Order date:<span style="font-weight:normal;">05-Mar-2018</span></span><span style="font-weight: bold;padding-left: 15px;">Order time:<span style="font-weight:normal;">18:49</span></span>		
        <br/>					
    </span>     -->
    <span style="color: #404040;">            
        <span style="font-weight: bold">Order by:</span> {!! $entered_by !!} <span style="font-weight: bold;padding-left: 60px;">Order date & Time:</span> {!!$entered_date !!} {!! $entered_time !!} IST            
        <br/>         
    </span>                                           
</p>
</div>
</div>
</body>
@stop
