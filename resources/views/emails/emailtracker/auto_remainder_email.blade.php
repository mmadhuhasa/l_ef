@extends('emails.layout')
@section('container')
<style>
table {
font-family: arial, sans-serif;
border-collapse: collapse;
width: 100%;
}
td, th {
border: 1px solid #000;
padding: 4px;
font-size: 14px;
text-align:center;
}
th {
color:#f99200;
}
</style>
<?php $count=1;
 if($status=="URGENT")
    $status_color="#f1292b";
 elseif($status=="PENDING")
    $status_color="#f99200";

?>
<p style="color: #000;font-family: monospace;font-size: 15px;">Hello Ops Team,</p>
<p style="color: #000;font-family: monospace;font-size: 15px;font-weight:bold;">Following emails of clients are <span style="color: {{$status_color}};font-weight: bold;font-family: monospace;font-size: 15px">{{$status}}</span> to be actioned, please work on it ASAP,</p>
<table style="border-collapse: collapse;width: 85%;">
    <tr>
    <th style="color:{{$status_color}};border:1px solid #000;padding: 4px;font-size: 15px;text-align:center;font-family: monospace;" style="border: 1px solid #000;text-align:center;">Sl</th>
    <th style="color:{{$status_color}};border:1px solid #000;padding: 4px;font-size: 15px;text-align:center;font-family: monospace;" style="border: 1px solid #000;text-align:center;">CALL SIGN</th>
    <th style="color:{{$status_color}};border:1px solid #000;padding: 4px;font-size: 15px;text-align:center;font-family: monospace;" style="border: 1px solid #000;text-align:center;">EMAIL SUBJECT</th>
    <th style="color:{{$status_color}};border:1px solid #000;padding: 4px;font-size: 15px;text-align:center;font-family: monospace;" style="border: 1px solid #000;text-align:center;">EMAIL DATE</th>
    <th style="color:{{$status_color}};border:1px solid #000;padding: 4px;font-size: 15px;text-align:center;font-family: monospace;" style="border: 1px solid #000;text-align:center;">COMPLETE BY DATE & TIME</th>
  </tr>
    @foreach($results as $d)
     <?php  $current_date = date('Ymd'); 
     if($d->email_completed_by==$current_date)
       $row_color="#000";
     else
        $row_color="blue";
  ?>

  <tr>
    <td style="border: 1px solid #000;text-align:center;color:{{$row_color}};width: 4%;font-family: monospace;font-size: 15px;">{{$count++}}</td>
    <td style="border: 1px solid #000;text-align:center;color:{{$row_color}};width: 10%;font-family: monospace;font-size: 15px;">{{$d->callsign}}</td>
    <td style="border: 1px solid #000;text-align:center;color:{{$row_color}};width: 45%;font-family: monospace;font-size: 15px;">{{substr($d->subject,0,50)}}</td>
    <td style="border: 1px solid #000;text-align:center;color:{{$row_color}};width: 13%;font-family: monospace;font-size: 15px;">{{date('d-M-Y',strtotime($d->email_date))}}</td>
    <td style="border: 1px solid #000;text-align:center;color: {{$row_color}};width: 25%;font-family: monospace;font-size: 15px;">
      {{date('d-M-Y',strtotime($d->email_completed_by))}} {{substr($d->completed_time,0,2)}}:{{substr($d->completed_time,2,2)}} IST</td>
  </tr>
  @endforeach
</table>
<p style="color: #000;margin-top: 50px;font-size: 15px;font-family: monospace;">System Admin</p>
<p style="color:#f1292b;font-weight:bold;font-size: 15px;font-family: monospace;">EFLIGHT</p>
@stop
