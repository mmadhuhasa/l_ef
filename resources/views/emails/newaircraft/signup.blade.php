<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body style="font-family:Courier; font-size:16px;">
<style>
.ii a[href] {
     color: black !important;
}
a {
  text-decoration: none !important; 
 }

@media screen and (max-width:500px){
  td{
    display:inline-block; width:100%;
  }
}
</style>
<?php  
    $data=Session::get('aircraft');
    //dd($data);
 ?>
    <div style="font-family:Courier; font-size:16px;margin-left:50px;margin-right: 50px">
      <table width="100%" border="0" cellspacing="4" cellpadding="0" style="font-family:Courier; font-size:16px;">
        <tr>
          <td align="left" valign="top" style="border-top:1px dashed #333333; padding:5px 0; font-family:"Courier New", Courier;">
          <table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td colspan="3" align="left" valign="top"><em>OPERATOR</em>: <strong>{{$data->operator}}</strong></td>
        </tr>
      <tr>
        <td width="38%" align="left" valign="top"><em>CALLSIGN</em>: <strong>{{$data->callsign}}</strong></td>
        <td colspan="2" align="left" valign="top"><em>AIRCRAFT TYPE</em>: <strong>{{$data->aircrafttype}}</strong></td>
        </tr>
      <tr>
        <td align="left" valign="top"><em>ENGINE</em>: <strong>{{$data->engine_type}}</strong></td>
        <td width="30%" align="left" valign="top"><em>UNITS</em>:<strong>@if($data->weight==1) {{"Kgs"}} @else {{"Lbs"}} @endif</strong></td>
        <td width="32%" align="left" valign="top"><em>CREDIT</em>: <strong>@if($data->credit_aai==1) {{"Yes"}} @else {{"No"}} @endif</strong></td>
      </tr>
    </table></td>
        </tr>
        <tr>
          <td align="left" valign="top" style="border-top:1px dashed #333333; padding:5px 0">
          <table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td width="53%" align="left" valign="top"><em>MAX PAX</em>: <strong>{{$data->pax}}</strong></td>
        <td width="47%" align="left" valign="top"><em>MAX FL</em>: <strong>{{$data->max_fl}}</strong></td>
      </tr>
      <tr>
        <td align="left" valign="top"><em>MAX FUEL</em>: <strong>{{$data->max_fuel}}</strong></td>
        <td align="left" valign="top"><em>TAXI FUEL</em>: <strong>{{$data->taxi_fuel}}</strong></td>
      </tr>
      <tr>
        <td align="left" valign="top"><em>MAX T.OFF</em>: <strong>{{$data->tow}}</strong></td>
        <td align="left" valign="top"><em>MAX LANDING</em>: <strong>{{$data->lw}}</strong></td>
      </tr>
      <tr>
        <td align="left" valign="top"><em>MAX ZFW</em>: <strong>{{$data->zfw}}</strong></td>
        <td align="left" valign="top"><em>BASIC WT</em>: <strong>{{$data->basic_wt}}</strong></td>
      </tr>
      <tr>
        <td align="left" valign="top"><em>HOLDING</em>: <strong>@if($data->holding==1) {{"30 mins"}} @else {{"45 mins"}} @endif</strong></td>
        <td align="left" valign="top">&nbsp;</td>
      </tr>
    </table>
    
          </td>
        </tr>
        <tr>
          <td align="left" valign="top" style="border-top:1px dashed #333333; padding:5px 0"><table width="100%" border="0" cellspacing="0" cellpadding="2">
            <tr>
              <td width="53%" align="left" valign="top"><em>EQUIPMENTS</em>: <strong>{{$data->equipments}}</strong></td>
              <td width="47%" align="left" valign="top"><em>TRANSPONDER</em>: <strong>{{$data->transponder}}</strong></td>
            </tr>
            <tr>
              <td align="left" valign="top"><em>PBN</em>: <strong>{{$data->pbn}}</strong></td>
              <td align="left" valign="top"><em>NAV</em>: <strong>@if($data->nav!="") {{$data->nav}}@endif</strong></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top">AIRCRAFT COLOR & MARKINGS: <strong>@if($data->aircraftcolor!="") {{$data->aircraftcolor}}@endif</strong></td>
            </tr>
            @php 
                  $e_radio =json_decode($data->emergency_radio);  
            @endphp
            <tr>
              <td align="left" valign="top"><em>EMERGENCY</em>:
              @if(count($e_radio)>0)
              <strong>
               @foreach($e_radio as $key=>$radio)
                {{substr($radio,0,1)}} @if($key != count($e_radio)-1) , @endif
                @endforeach
              </strong>
              @endif
            </td>
            @php 
                  $survival_equipment =json_decode($data->survival_equipment); 
                   
            @endphp
            <td align="left" valign="top"><em>SURVIVAL</em>:
            @if(isset($survival_equipment))
             <strong>
             @foreach($survival_equipment as $key => $equipment)
              {{substr($equipment,0,1)}} @if($key != count($survival_equipment)-1) , @endif
             @endforeach
             </strong>
             @endif
            </td>
            </tr>
            @php 
                  $jacket =json_decode($data->jacket);  
            @endphp
            <tr>
              <td align="left" valign="top"><em>JACKET</em>:
              @if(isset($jacket))
              <strong>
               @foreach($jacket as $key => $j)
                {{substr($j,0,1)}} @if($key != count($jacket)-1) , @endif
               @endforeach
              </strong>
              @endif
            </td>
              <td align="left" valign="top"><em>DINGHIES</em>: <strong>@if($data->dinghies_no!="") {{$data->dinghies_no}} ,@endif @if($data->dinghies_capacity!="") {{$data->dinghies_capacity}} ,@endif @if(isset($data->dhinges_cover)) {{"Yes"}} ,@endif @if($data->dinghies_color!="") {{$data->dinghies_color}} @endif</strong></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="top" style="border-top:1px dashed #333333;border-bottom:1px dashed #333333; padding:5px 0"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="53%" align="left" valign="top"><em>OPS MANAGER NAME</em>: <strong>{{$data->ops_manager}}</strong></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top"><em>OPS MANAGER EMAIL</em>: <strong>{{$data->ops_email_id}}</strong></td>
            </tr>
            <tr>
              <td width="47%" align="left" valign="top"><em>OPS MANAGER MOBILE</em>: <strong>{{$data->ops_mobile}}</strong></td>
            </tr>
            <tr>
              <td align="left" valign="top">&nbsp;</td>
              <td align="left" valign="top">&nbsp;</td>
            </tr>

            <tr>
              <td align="left" valign="top"><em>{{$data->designation1}} NAME</em>: <strong>{{$data->crew1}}</strong></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top"><em>{{$data->designation1}} EMAIL</em>: <strong>{{$data->email1}}</strong></td>
            </tr>
            <tr>
              <td align="left" valign="top"><em>{{$data->designation1}} MOBILE</em>: <strong>{{$data->mobile1}}</strong></td>
            </tr>
            <tr>
              <td align="left" valign="top">&nbsp;</td>
              <td align="left" valign="top">&nbsp;</td>
            </tr>
            <tr>
              <td align="left" valign="top"><em>{{$data->designation2}} NAME</em>: <strong>{{$data->crew2}}</strong></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top"><em>{{$data->designation2}} EMAIL</em>: <strong>{{$data->email2}}</strong></td>
            </tr>
            <tr>
              <td align="left" valign="top"><em>{{$data->designation2}} MOBILE</em>: <strong>{{$data->mobile2}}</strong></td>
            </tr>
            @if($data->crew3!="")
            <tr>
              <td align="left" valign="top">&nbsp;</td>
              <td align="left" valign="top">&nbsp;</td>
            </tr>
            @endif
             @if($data->crew3!="")  
            <tr>
              <td align="left" valign="top"><em>{{$data->designation3}} NAME</em>: <strong>{{$data->crew3}}</strong></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top"><em>{{$data->designation3}} EMAIL</em>: <strong>{{$data->email3}}</strong></td>
            </tr>
            <tr>
              <td align="left" valign="top"><em>{{$data->designation3}} MOBILE</em>: <strong>{{$data->mobile3}}</strong></td>
            </tr>
            @if($data->crew4!="")
            <tr>
              <td align="left" valign="top">&nbsp;</td>
              <td align="left" valign="top">&nbsp;</td>
            </tr>
            @endif
            @endif
             @if($data->crew4!="")  
            <tr>
              <td align="left" valign="top"><em>{{$data->designation4}} NAME</em>: <strong>{{$data->crew4}}</strong></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top"><em>{{$data->designation4}} EMAIL</em>: <strong>{{$data->email4}}</strong></td>
            </tr>
            <tr>
              <td align="left" valign="top"><em>{{$data->designation4}} MOBILE</em>: <strong>{{$data->mobile4}}</strong></td>
            </tr>
            @if($data->crew5!="")
            <tr>
              <td align="left" valign="top">&nbsp;</td>
              <td align="left" valign="top">&nbsp;</td>
            </tr>
            @endif
            @endif
             @if($data->crew5!="")  
            <tr>
              <td align="left" valign="top"><em>{{$data->designation5}} NAME</em>: <strong>{{$data->crew5}}</strong></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top"><em>{{$data->designation5}} EMAIL</em>: <strong>{{$data->email5}}</strong></td>
            </tr>
            <tr>
              <td align="left" valign="top"><em>{{$data->designation5}} MOBILE</em>: <strong>{{$data->mobile5}}</strong></td>
            </tr>
            @if($data->crew6!="")
            <tr>
              <td align="left" valign="top">&nbsp;</td>
              <td align="left" valign="top">&nbsp;</td>
            </tr>
            @endif
            @endif
             @if($data->crew6!="")  
            <tr>
              <td align="left" valign="top"><em>{{$data->designation6}} NAME</em>: <strong>{{$data->crew6}}</strong></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top"><em>{{$data->designation6}} EMAIL</em>: <strong>{{$data->email6}}</strong></td>
            </tr>
            <tr>
              <td align="left" valign="top"><em>{{$data->designation6}} MOBILE</em>: <strong>{{$data->mobile6}}</strong></td>
            </tr>
            @if($data->crew7!="")
            <tr>
              <td align="left" valign="top">&nbsp;</td>
              <td align="left" valign="top">&nbsp;</td>
            </tr>
            @endif
            @endif
             @if($data->crew7!="")  
            <tr>
              <td align="left" valign="top"><em>{{$data->designation7}} NAME</em>: <strong>{{$data->crew7}}</strong></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top"><em>{{$data->designation7}} EMAIL</em>: <strong>{{$data->email7}}</strong></td>
            </tr>
            <tr>
              <td align="left" valign="top"><em>{{$data->designation7}} MOBILE</em>: <strong>{{$data->mobile7}}</strong></td>
            </tr>
            @if($data->crew8!="")
            <tr>
              <td align="left" valign="top">&nbsp;</td>
              <td align="left" valign="top">&nbsp;</td>
            </tr>
            @endif
            @endif
             @if($data->crew8!="")  
            <tr>
              <td align="left" valign="top"><em>{{$data->designation8}} NAME</em>: <strong>{{$data->crew8}}</strong></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top"><em>{{$data->designation8}} EMAIL</em>: <strong>{{$data->email8}}</strong></td>
            </tr>
            <tr>
              <td align="left" valign="top"><em>{{$data->designation8}} MOBILE</em>: <strong>{{$data->mobile8}}</strong></td>
            </tr>
            @if($data->crew9!="")
            <tr>
              <td align="left" valign="top">&nbsp;</td>
              <td align="left" valign="top">&nbsp;</td>
            </tr>
            @endif
            @endif
             @if($data->crew9!="")  
            <tr>
              <td align="left" valign="top"><em>{{$data->designation9}} NAME</em>: <strong>{{$data->crew9}}</strong></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top"><em>{{$data->designation9}} EMAIL</em>: <strong>{{$data->email9}}</strong></td>
            </tr>
            <tr>
              <td align="left" valign="top"><em>{{$data->designation9}} MOBILE</em>: <strong>{{$data->mobile9}}</strong></td>
            </tr>
            <tr>
              <td align="left" valign="top">&nbsp;</td>
              <td align="left" valign="top">&nbsp;</td>
            </tr>
            @endif
          </table></td>
        </tr>
      </table>
  </div>
</body>
</html>