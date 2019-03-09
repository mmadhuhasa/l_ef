<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="font-size:14px;font-family:courier;">
  <h1 style="font-size:110%; text-align:center; text-decoration:underline; padding-bottom:30px">{{$title}} – WATCH HOURS</h1>
  <?php $count=1;?>
  <div style="margin-left: 130px ">
  @foreach($datalist as $data)
    @foreach($data as $key=>$d)

        <p style="font-weight:bold">{{$d['aerodrome']}} - {{$d['airport_name'][0]}}</p>
        <p style="font-weight:bold">
          <span style="font-weight:normal">{{substr($d['notams'],0,8)}}</span></p>
        <p>    <span >{{$d['start_date_formatted']}} to {{$d['end_date_formatted']}}</span>
        </p>
      <div style="width:100%;">
        <table width="270" border="0"  cellpadding="3" cellspacing="0" style="border:1px solid #bfbfbf; margin-bottom:30px;">
        <tr>
          <td width="94" align="left" valign="top"  style="border-bottom:1px solid #bfbfbf; border-right:1px solid #bfbfbf" scope="col"></td>
          <td width="85"  valign="top" style="border-bottom:1px solid #bfbfbf; border-right:1px solid #bfbfbf;font-weight: bold;"  scope="col">OPEN FROM</td>
          <td width="85"  valign="top" style="border-bottom:1px solid #bfbfbf; border-right:1px solid #bfbfbf;font-weight: bold;"  scope="col">CLOSES AT</td>
        </tr>
        @foreach($d['watchhours'] as $days=>$times)
        @php $count++; @endphp
        <tr @if($count%2==0) style="background:#f2f2f2" @endif>
          <td align="left" valign="top" style="border-bottom:1px solid #bfbfbf; border-right:1px solid #bfbfbf;" ><strong>{{strtoupper($days)}}</strong>
          </td>
          @foreach($times as $key=>$time)
          @if($key!=0 && $time!=" - ")
           </tr>
           <tr @if($count%2==0) style="background:#f2f2f2" @endif>
            <td style="border-bottom: 1px solid #bfbfbf;"></td>
          @endif
           @if($time!=" - ")
             @if($time=="CLOSED - CLOSED")
               <td align="left" valign="top" style="border-bottom:1px solid #bfbfbf; border-right:1px solid #bfbfbf" >CLOSED</td>
               <td align="left" valign="top" style="border-bottom:1px solid #bfbfbf; border-right:1px solid #bfbfbf" >CLOSED</td>
             @else
             <td align="left" valign="top" style="border-bottom:1px solid #bfbfbf; border-right:1px solid #bfbfbf" >{{substr($time,0,4)}} {{ App::make('App\Http\Controllers\Notams\WatchHoursController')->utc_to_ist1(substr($time,0,4)) }}</td>
             <td align="left" valign="top" style="border-bottom:1px solid #bfbfbf; border-right:1px solid #bfbfbf" >{{substr($time,7,4)}} {{ App::make('App\Http\Controllers\Notams\WatchHoursController')->utc_to_ist1(substr($time,7,4)) }}</td>
             @endif
           @endif
          @endforeach 
        </tr>
        @endforeach
      </table>
      </div>

      @endforeach
@endforeach
</div>
</body>
</html>