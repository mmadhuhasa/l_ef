<!DOCTYPE html>
<head>
<title>FILE NAV LOG REQUEST</title>
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
  @php $data=Session::pull('navlog'.$navlog);@endphp
   @if($navlog == 3 || $navlog == 5)
    <div class="breakNow"></div>
    @endif
<div>
   <!--mainrow-->
   <div class="marginbottom margintop10" style="width:100%;background-color:#f1292b;">
      <p style="color:#fff;font-weight:bold;text-align:center;line-height:0.5;">NAV LOG {{$data['navlog_no']}}</p>
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
         <td style="width:50%;">DEP TIME: <span class="uppercase fontweight">{{$data['dep_time']}} UTC</span></td>
      </tr>
   </table>
   <table style="width:100%;">
      <tr class="margintop" style="width:100%;">
        
         <td style="width:50%;">TO: <span class="uppercase fontweight">{{$data['destination']}} <span class="uppercase fontweight">@if($data['dest_airport_name']!="")({{$data['dest_airport_name']}}) @endif</span></span></td>
      </tr>
   </table>
   <table style="width:100%;" class="margintop10">
      <tr class="margintop" style="width:100%;">
         <td style="width:50%;">PIC: <span class="uppercase fontweight">{{$data['pilot']}}</span></td>
         <td style="width:50%;">CO-PILOT: <span class="uppercase fontweight">{{$data['co_pilot']}}</span></td>
      </tr>
   </table>
   <table style="width:100%;">
   <tr style="width:100%;">
      <td style="width:33%;">MOBILE: <span class="uppercase fontweight">{{$data['mobile']}}</span></td>
      <td style="width:22%;">PAX: <span class="uppercase fontweight">{{$data['pax']}}</span></td>
      <td style="width:20%;">CARGO: <span class="uppercase fontweight">{{$data['load']}}</span></td>
      <td style="width:25%;">FUEL: <span class="uppercase fontweight">@if($data['fuel']!=0){{$data['fuel']}}
         @elseif($data['min_max']==2)MAX  
         @elseif($data['min_max']==1)MIN  
         @elseif($data['min_max']==3)NO REFUEL 
         @endif</span></td>
      <td style="width:10%;"></td>
   </tr>
   </table>
   @if(isset($data['cabin'])||isset($data['speed'])||$data['level1']!=""||isset($data['txtspeed']))
   <table style="width:100%;" class="margintop10">
   <tr style="width:100%;">
      @if(isset($data['speed']))
      <td  style=@if($data['level1']=='') 'width:17%';@elseif(!isset($data['cabin'])) 'width:20%'; @else 'width:24%'; @endif>SPEED: <span class="uppercase fontweight">{{$data['speed']}}</span></td>
      @endif
      @if(isset($data['txtspeed']) && $data['txtspeed']!='')
      <td  style=@if($data['level1']=='') 'width:17%';@elseif(!isset($data['cabin'])) 'width:20%'; @else 'width:24%'; @endif>SPEED: <span class="uppercase fontweight">{{$data['txtspeed']}}</span></td>
      @endif
      @if($data['level1']!="")
      <td style=@if(!isset($data['speed']))'width:17%'; @else 'width:16%'; @endif>LEVEL: <span class="uppercase fontweight">{{$data['level1']}}</span></td>
      @endif
      @if(isset($data['cabin']))
      <td style="width:10%;">CABIN: <span class="uppercase fontweight">{{$data['cabin']}}</span></td>
      @endif
     
     
      <td style="width:30%;"></td>
   </tr>
   </table>
  @endif
  @if($data['main_route']!="")
   <table style="width:100%;" class="margintop">
      <tr style="width:100%;" style="width:100%;">
         <td style="width:100%;">MAIN ROUTE: <span class="uppercase fontweight">{{$data['main_route']}}</span></td>
   </table>
 @endif
@if($data['alternate1']!="" ||$data['level2']!="" || $data['alternate1route']!=="") 
   <table style="width:100%;">
      <tr class="margintop" style="width:100%;">
       @if($data['alternate1']!="")
         <td style="width:50%;">ALTN 1:
              <span class="uppercase fontweight">{{$data['alternate1']}} 
               <span>@if($data['alt1_airport_name'] !="")({{$data['alt1_airport_name']}})@endif</span>
              </span>
         </td>
       @endif  
       @if($data['level2']!=""||$data['alternate1route']!="")
         <td style="width:50%;">
            @if($data['alternate1route']!="")
               ALTN 1 ROUTE:
            @endif 
            @if($data['level2']!="")
               <span>FL</span>
               <span style="margin-left:2px;" class="uppercase fontweight">{{$data['level2']}}</span>
            @endif 
            @if($data['alternate1route']!="")<span class="uppercase fontweight">{{$data['alternate1route']}}</span>
            @endif
        </td>
        @endif
      </tr>
   </table>
 @endif
 @if($data['remarks']!="" || $data['registration']!="")
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
 @if($data['alternate2']!="" ||$data['level3']!="" || $data['alternate2route']!=="") 
   <table style="width:100%;" class="margintop10" >
      <tr style="width:100%;">
         @if($data['alternate2']!="")
            <td style="width:50%;">ALTN 2: 
               <span class="uppercase fontweight">{{$data['alternate2']}} 
                  <span>@if($data['alt2_airport_name']!="")({{$data['alt2_airport_name']}})@endif</span>
                </span>
            </td>
         @endif
         @if($data['level3']!=""||$data['alternate2route']!="")
         <td style="width:50%;">
           @if($data['alternate2route']!="")
             ALTN 2 ROUTE:
           @endif 
           @if($data['level3']!="") 
            <span >FL</span>
            <span style="margin-left:2px;" class="uppercase fontweight">{{$data['level3']}}</span>
           @endif
           @if($data['alternate2route']!="")
             <span class="uppercase fontweight">{{$data['alternate2route']}}</span>
           @endif
          </td> 
         @endif 
      </tr>
   </table>
 @endif  
 @if($data['take_off_alternate']!="" ||$data['level4']!="" || $data['take_off_alternate_route']!=="") 
    <table style="width:100%;" class="margintop10">
      <tr style="width:100%;">
         @if($data['take_off_alternate']!="")
           <td style="width:50%;">T.OFF ALTN:
             <span class="uppercase fontweight">{{$data['take_off_alternate']}}<span>@if($data['toff_airport_name'] !="") ({{$data['toff_airport_name']}}) @endif</span>
              </span>
          </td>
         @endif  
         @if($data['level4']!=""||$data['take_off_alternate_route']!="")
         <td style="width:50%;">
           @if($data['take_off_alternate_route']!="")
            T. OFF ALTN ROUTE: 
           @endif 
            @if($data['level4']!="") 
             <span>FL</span>
             <span style="margin-left:2px;" class="uppercase fontweight">{{$data['level4']}}</span>
            @endif
           @if($data['take_off_alternate_route']!="")
             <span class="uppercase fontweight">{{$data['take_off_alternate_route']}}</span>
           @endif
         </td>
         @endif
      </tr>
   </table>
 @endif
 @if((isset($data['dest_place']) && $data['dest_place']!="") ||(isset($data['dept_lat']) && $data['dept_lat']!=""))
    <table style="width:100%;margin-top:10px;">
   </table>
 @endif  
 @if((isset($data['dest_place']) && $data['dest_place']!="")||(isset($data['dept_place']) && $data['dept_place']!=""))
   <table style="width:100%;">
      <tr class="margintop" style="width:100%;">
         @if(isset($data['dept_place']))<td style="width:50%;">DEP ZZZZ PLACE NAME: <span class="uppercase fontweight">{{$data['dept_place']}}</span></td>@endif
         @if(isset($data['dest_place']))<td style="width:50%;">DEST ZZZZ PLACE NAME: <span class="uppercase fontweight">{{$data['dest_place']}}</span></td>@endif
      </tr>
   </table>
  @endif
    @if((isset($data['dest_lat']) && $data['dest_lat']!="") ||(isset($data['dept_lat']) && $data['dept_lat']!=""))
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