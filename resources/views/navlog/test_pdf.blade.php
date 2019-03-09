<!DOCTYPE html>
<head>
<title>TEST PLAN REQUEST</title>
</head>
<style type="text/css">
  div.breakNow { page-break-inside:avoid; page-break-after:always; }
.uppercase {
    text-transform: uppercase;
}
.fontweight{
  font-weight:bold;
}
.margintop{
  margin-top:5px;
}
.margintop10{
  margin-top:10px;
}
.marginbottom{
  margin-bottom:10px;
}
</style>
<body style="font-family:Consolas, monaco, monospace;">
@for($navlog=1;$navlog<=$no_of_flight;$navlog++)
  @php $data=Session::pull('navlog'.$navlog); @endphp
   @if($navlog == 5)
    <div class="breakNow"></div>
    @endif
<div>
   <!--mainrow-->
   <div class="marginbottom margintop10" style="width:100%;background-color:#dcdcdc;">
      <p style="color:#333333;font-weight:bold;text-align:center;line-height:0.5;">TEST PLAN {{$data['navlog_no']}}</p>
   </div>
   <!--headeline close here-->
   <table style="width:100%;">
      <tr style="width:100%;">
         <td style="width:50%;">CALL SIGN: <span class="uppercase fontweight">{{$data['callsign']}}</span></td>
         <td style="width:50%;">DATE OF FLIGHT: <span class="uppercase fontweight">{{$data['flight_date']}}</span></td>
      </tr>
   </table>

   <table style="width:100%;">
      <tr style="width:100%;">
         <td style="width:50%;">FROM: <span class="uppercase fontweight">{{$data['departure']}} <span class="uppercase fontweight">@if($data['dep_airport_name']!="")({{$data['dep_airport_name']}}) @endif</span></span></td>
          @if($data['dep_time']!="")
            <td style="width:50%;">DEP TIME: <span class="uppercase fontweight">{{$data['dep_time']}} UTC</span></td>
          @endif
      </tr>
   </table>
   <table style="width:100%;">
      <tr class="margintop" style="width:100%;">
        
         <td style="width:50%;">TO: <span class="uppercase fontweight">{{$data['destination']}} <span class="uppercase fontweight">@if($data['dest_airport_name']!="")({{$data['dest_airport_name']}}) @endif</span></span></td>
      </tr>
   </table>
   

   <table style="width:100%;">
   <tr style="width:100%;">
      @if($data['pax']!='PAX')
      <td @if(($data['fuel']==0 && $data['min_max']=='')) style="width:30%;" @elseif($data['load']=='') style="width:35%;" @else style="width:15%;" @endif>PAX: <span class="uppercase fontweight">{{$data['pax']}}</span></td>
      @endif
      @if($data['load']!='')
      <td @if($data['pax']=='PAX') style="width:35%;" @else style="width:20%;" @endif>CARGO: <span class="uppercase fontweight">{{$data['load']}}</span></td>
      @endif
      @if($data['fuel']!=0 || $data['min_max']!='')
      <td style="width:25%;">FUEL: <span class="uppercase fontweight">@if($data['fuel']!=0){{$data['fuel']}}
              @elseif($data['min_max']==2)MAX  
              @elseif($data['min_max']==1)MIN  
              @elseif($data['min_max']==3)NO REFUEL 
              @endif  

         </span>
      </td>
      @endif
      <td style="width:10%;"></td>
   </tr>
   </table>
 @if($data['remarks']!="" || $data['registration']!="" )
   <table style="width:100%;margin-top:10px;">
      <tr style="width:100%;" style="width:100%;">
       @if($data['remarks']!="") 
         <td style="width:100%;">REMARKS: <span class="uppercase fontweight">{{$data['remarks']}}</span></td>
       @endif
       @if($data['registration']!=$data['callsign'])
         <td style="width:50%;">REGISTRATION: <span class="uppercase fontweight">{{$data['registration']}}</span></td>
       @endif
      </tr>   
   </table>
 @endif
 @if(isset($data['dest_place'])||isset($data['dept_lat']))
    <table style="width:100%;margin-top:10px;">
   </table>
 @endif  
 @if(isset($data['dest_place'])||isset($data['dept_place']))
   <table style="width:100%;">
      <tr class="margintop" style="width:100%;">
         @if(isset($data['dept_place']))<td style="width:50%;">DEP ZZZZ PLACE NAME: <span class="uppercase fontweight">{{$data['dept_place']}}</span></td>@endif
         @if(isset($data['dest_place']))<td style="width:50%;">DEST ZZZZ PLACE NAME: <span class="uppercase fontweight">{{$data['dest_place']}}</span></td>@endif
      </tr>
   </table>
  @endif
    @if(isset($data['dest_lat'])||isset($data['dept_lat']))
   <table style="width:100%;">
      <tr class="margintop" style="width:100%;">
         @if(isset($data['dept_lat']))<td style="width:50%;">DEP ZZZZ LAT LONG: <span class="uppercase fontweight">{{$data['dept_lat']}}</span></td>@endif
         @if(isset($data['dest_lat']))<td style="width:50%;">DEST ZZZZ LAT LONG: <span class="uppercase fontweight">{{$data['dest_lat']}}</span></td>@endif
      </tr>
   </table>
   @endif
</div>
<!--mainrow-->
@endfor
</body>
</html>