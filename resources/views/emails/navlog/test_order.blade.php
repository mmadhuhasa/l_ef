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
<p style="font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;color:#fff;padding:15px;font-size:14px;font-weight:bold;">{{$registration}} {{$title}}</p>
</div>
<div style="background:#fff;padding: 5px 15px 5px 15px;border-radius:5px;margin-bottom: 15px;">
<p style="font-size: 14px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">Hello <span style="color:#f1292b;font-weight:bold;">EFLIGHT</span> Ops Team,</p>
<p style="font-size: 14px;margin-top: 25px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">Kindly send TEST NAV LOG as per attached plan details at the earliest.</p>
@if($count_date==1)
<p style="font-size: 14px;font-weight:bold;margin-top: 25px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">FLIGHT DATE: <span>{{$dof}}</span></p>
@endif
@foreach($plans as $key=>$plan)
<p style="font-size: 14px;line-height: 0;font-weight:bold;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">PLAN # {{$key+1}}: {{$plan[0]}} to {{$plan[1]}} @if($count_date>1)({{$plan[2]}})@endif</p>
@endforeach
<p style="font-size: 14px;color:#404040;margin-top: 60px;margin-bottom:24px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">Thanks,</p>
<p style="font-weight:bold;color:#f1292b;font-size:14px;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">{{$username}}</p>
<p style="font-size: 14px;color:#404040;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">Requested Date & Time: {{date('d-M-Y')}} ({{date('H:i')}} IST)</p>
</div>
</div>

</body>
@stop
