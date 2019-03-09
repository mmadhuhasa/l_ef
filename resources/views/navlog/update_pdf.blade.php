<!DOCTYPE html>
<head>
<title>Page Title</title>
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
.red{
  color: red;
}
</style>
<body style="font-family:monospace;">
<?php //dd($field);?>
@php $data=$navlog; @endphp
<div>
   <!--mainrow-->
   <div class="marginbottom margintop10" style="width:100%;background-color:#f1292b;">
      <p style="color:#fff;font-weight:bold;text-align:center;line-height:0.5;">NAV LOG 1</p>
   </div>
   <!--headeline close here-->
   <table style="width:100%;">
      <tr style="width:100%;">
         <td style="width:50%;">CALL SIGN: <span class="uppercase fontweight">{{$data->callsign}}</span></td>
         <td style="width:50%;">REGISTRATION: <span class="uppercase fontweight">{{$data->registration}}</span></td>
      </tr>
   </table>
   <table style="width:100%;">
      <tr style="width:100%;">
         <td style="width:50%;">DATE OF FLIGHT: <span class="uppercase fontweight">{{$data->flight_date}}</span></td>
         <td style="width:50%;">DEP TIME: <span class="uppercase fontweight">{{substr($data->dep_time,0,2)}}{{substr($data->dep_time,5,2)}} UTC</span></td>
      </tr>
   </table>
   <table style="width:100%;" class="margintop10">
      <tr class="margintop" style="width:100%;">
         <td style="width:50%;">FROM: <span class="uppercase fontweight">{{$data->departure}} <span class="uppercase fontweight">@if($data->dep_airport_name!="")({{$data->dep_airport_name}}) @endif</span></span></td>
         <td style="width:50%;">TO: <span class="uppercase fontweight">{{$data->destination}} <span class="uppercase fontweight">@if($data->dest_airport_name!="")({{$data->dest_airport_name}}) @endif</span></span></td>
      </tr>
   </table>
   <table style="width:100%;" class="margintop10">
      <tr class="margintop" style="width:100%;">
         <td style="width:50%;">PIC: <span class="uppercase fontweight @if(in_array('pilot',$field)) red @endif">{{$data->pilot}}</span></td>
         <td style="width:50%;">CO-PILOT: <span class="uppercase fontweight @if(in_array('co_pilot',$field)) red @endif">{{$data->co_pilot}}</span></td>
      </tr>
   </table>
   <table style="width:100%;">
   <tr style="width:100%;">
      <td style="width:33%;">MOBILE: <span class="uppercase fontweight @if(in_array('mobile',$field)) red @endif">{{$data->mobile}}</span></td>
      <td style="width:22%;">PAX: <span class="uppercase fontweight @if(in_array('pax',$field)) red @endif">{{$data->pax}}</span></td>
      <td style="width:20%;">CARGO: <span class="uppercase fontweight @if(in_array('load',$field)) red @endif">{{$data->load}}</span></td>
      <td style="width:25%;">FUEL: <span class="uppercase fontweight @if(in_array('fuel',$field)) red @endif @if(in_array('min_max',$field)) red @endif">@if($data->fuel!=0){{$data->fuel}}
         @elseif($data->min_max==2)MAX  
         @elseif($data->min_max==1)MIN  
         @elseif($data->min_max==3)NO REFUEL 
         @endif</span></td>
      <td style="width:10%;"></td>
   </tr>
   </table>
   @if(isset($data->cabin)||isset($data->speed)||$data->level1!="")
   <table style="width:100%;" class="margintop10">
   <tr style="width:100%;">
      @if(isset($data->cabin))
      <td style="width:30%;">CABIN: <span class="uppercase fontweight @if(in_array('cabin',$field)) red @endif">{{$data->cabin}}</span></td>
      @endif
      @if(isset($data->speed))
      <td style="width:20%;">SPEED: <span class="uppercase fontweight @if(in_array('speed',$field)) red @endif">{{$data->speed}}</span></td>
      @endif
      @if($data->level1!="")
      <td style="width:20%;">LEVEL: <span class="uppercase fontweight @if(in_array('level1',$field)) red @endif">{{$data->level1}}</span></td>
      @endif
      <td style="width:30%;"></td>
   </tr>
   </table>
  @endif
  @if($data->main_route!="")
   <table style="width:100%;" class="margintop">
      <tr style="width:100%;" style="width:100%;">
         <td style="width:100%;">MAIN ROUTE: <span class="uppercase fontweight @if(in_array('main_route',$field)) red @endif">{{$data->main_route}}</span></td>
   </table>
 @endif
@if($data->alternate1!="" ||$data->level2="" || $data->alternate1route!=="") 
   <table style="width:100%;">
      <tr class="margintop" style="width:100%;">
       @if($data->alternate1!="")
         <td style="width:50%;">ALTN 1:
              <span class="uppercase fontweight @if(in_array('alternate1',$field)) red @endif">{{$data->alternate1}} 
               <span>@if($data->alt1_airport_name !="")({{$data->alt1_airport_name}})@endif</span>
              </span>
         </td>
       @endif  
       @if($data->level2!=""||$data->alternate1route!="")
         <td style="width:50%;">
            @if($data->alternate1route!="")
               ALTN 1 ROUTE:
            @endif 
            @if($data->level2!="")
               <span>FL</span>
               <span style="margin-left:2px;" class="uppercase fontweight @if(in_array('level2',$field)) red @endif">{{$data->level2}}</span>
            @endif 
            @if($data->alternate1route!="")<span class="uppercase fontweight @if(in_array('alternate1route',$field)) red @endif">{{$data->alternate1route}}</span>
            @endif
        </td>
        @endif
      </tr>
   </table>
 @endif
 @if($data->remarks!="")
   <table style="width:100%;margin-top:10px;">
      <tr style="width:100%;" style="width:100%;">
         <td style="width:100%;">REMARKS: <span class="uppercase fontweight @if(in_array('remarks',$field)) red @endif">{{$data->remarks}}</span></td>
   </table>
 @endif
 @if($data->alternate2!="" ||$data->level3!="" || $data->alternate2route!=="") 
   <table style="width:100%;" class="margintop10" >
      <tr style="width:100%;">
         @if($data->alternate2!="")
            <td style="width:50%;">ALTN 2: 
               <span class="uppercase fontweight @if(in_array('alternate2',$field)) red @endif">{{$data->alternate2}} 
                  <span>@if($data->alt2_airport_name!="")({{$data->alt2_airport_name}})@endif</span>
                </span>
            </td>
         @endif
         @if($data->level3!=""||$data->alternate2route!="")
         <td style="width:50%;">
           @if($data->alternate2route!="")
             ALTN 2 ROUTE:
           @endif 
           @if($data->level3!="") 
            <span >FL</span>
            <span style="margin-left:2px;" class="uppercase fontweight @if(in_array('level3',$field)) red @endif">{{$data->level3}}</span>
           @endif
           @if($data->alternate2route!="")
             <span class="uppercase fontweight @if(in_array('alternate2route',$field)) red @endif">{{$data->alternate2route}}</span>
           @endif
          </td> 
         @endif 
      </tr>
   </table>
 @endif  
 @if($data->take_off_alternate!="" ||$data->level4!="" || $data->take_off_alternate_route!=="") 
    <table style="width:100%;" class="margintop10">
      <tr style="width:100%;">
         @if($data->take_off_alternate!="")
           <td style="width:50%;">T.OFF ALTN:
             <span class="uppercase fontweight @if(in_array('take_off_alternate',$field)) red @endif">{{$data->take_off_alternate}}<span>@if($data->toff_airport_name !="") ({{$data->toff_airport_name}}) @endif</span>
              </span>
          </td>
         @endif  
         @if($data->level4!=""||$data->take_off_alternate_route!="")
         <td style="width:50%;">
           @if($data->take_off_alternate_route!="")
            T. OFF ALTN ROUTE: 
           @endif 
            @if($data->level4!="") 
             <span>FL</span>
             <span style="margin-left:2px;" class="uppercase fontweight @if(in_array('level4',$field)) red @endif">{{$data->level4}}</span>
            @endif
           @if($data->take_off_alternate_route!="")
             <span class="uppercase fontweight @if(in_array('take_off_alternate_route',$field)) red @endif">{{$data->take_off_alternate_route}}</span>
           @endif
         </td>
         @endif
      </tr>
   </table>
 @endif
 @if(isset($data->dest_place)||isset($data->dept_lat))
    <table style="width:100%;margin-top:10px;">
   </table>
 @endif  
 @if(isset($data->dest_place)||isset($data->dept_place))
   <table style="width:100%;">
      <tr class="margintop" style="width:100%;">
         @if(isset($data->dept_place))<td style="width:50%;">DEP ZZZZ PLACE NAME: <span class="uppercase fontweight">{{$data->dept_place}}</span></td>@endif
         @if(isset($data->dest_place))<td style="width:50%;">DEST ZZZZ PLACE NAME: <span class="uppercase fontweight">{{$data->dest_place}}</span></td>@endif
      </tr>
   </table>
  @endif
    @if(isset($data->dest_lat)||isset($data->dept_lat))
   <table style="width:100%;">
      <tr class="margintop" style="width:100%;">
         @if(isset($data->dept_lat))<td style="width:50%;">DEP ZZZZ LAT LONG: <span class="uppercase fontweight">{{$data->dept_lat}}</span></td>@endif
         @if(isset($data->dest_lat))<td style="width:50%;">DEST ZZZZ LAT LONG: <span class="uppercase fontweight">{{$data->dest_lat}}</span></td>@endif
      </tr>
   </table>
   @endif
</div>
<!--mainrow-->

</body>
</html>